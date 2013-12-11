<?php
/*
 * @version		0.4
 * @date Crea	26/04/2013.
 * @date Modif	24/11/2013.
 * @package		controleur_login.php
 * @contact		Chagry.fr - git@chagry.fr
 */

defined('CHAG') or die('Acces interdit');

class login {
	
	/*
	 * Function identification. 0.4
	 */ 
	public static function identification($e='') {
		
		// Recup mail.
		$eMail=filtre::base(base64_decode($e));
		
		// Var return. Array.
		$tmp=Array();
		
		// Valide mail.
		if(valide::email($eMail)) {
			
			// setup fonction model.
			$tmpUser=dbSys::getUser(array('email' => $eMail));
			
			//if user in db.
			if(!empty($tmpUser)) {
				
				// Verif if user bloker or not.
				if($tmpUser['block']==0) {
				
					// new session.
					$tmpIdSess=session::news($tmpUser['id']);
					
					// Cripte & return id session.
					$tmp['session']=crp::crypte($tmpIdSess,$tmpUser['password']);
				}
				
				// if user bloker.
				else {
					sleep(2);
					throw new Exception('SERV-ERROR-USER-BLACKLISTED');
				}
			}
			
			// if not user db.
			else {
				sleep(2);
				throw new Exception('LOGIN-ERROR-MAIL-INVALID');
			}
		}
		
		// if mail non valide.
		else {
			sleep(2);
			throw new Exception('LOGIN-ERROR-INVALID-MAIL');
		}
		
		// return result.
		return $tmp;
	}
	
	/*
	 * Function connexion. 0.4
	 */ 
	public static function connexion($e='', $c='', $l='') {
		
		// Recup session.
		$tmpIdSess=filtre::base($e);
		
		// Date Actuel.
		$dateNew = new DateTime();
		
		// Var return. Array.
		$tmp=Array();
		
		// Valide id session.
		if(valide::strMd5($tmpIdSess)) {
			
			// setup verif session.
			session::control($tmpIdSess);
			
			// Decripte mail & verifier.
			if(user::email()==crp::decrypte($c,user::password())) {
				
				// Prepa requet.
				$req=array('lastvisitedate' => $dateNew->getTimestamp(),
					'id' => user::id()
				);
				
				// Modif last visite user.
				dbSys::setLastVisitDateUser($req);
				
				// langue actu.
				$tmpLang=user::lang();
				
				// Langue recu.
				$langue=crp::decrypte($l, user::password());
				
				// Verif langue.
				if($langue != user::lang()) {
					
					// Langue api.
					$apiLangue=explode(',', config::sys('lang'));
						
					// Verif langue recu.
					if(in_array($langue, $apiLangue)) {
					
						// new code secu.
						$req=array(
							'lang' => $langue,
						    'id' => user::id()
						);
						
						// Set to db.			
						dbSys::setNewLangue($req);
						
						// langue actu.
						$tmpLang=$langue;
						
						// Archive parametre.
						$arch=json_encode(
							array(
								'before' => user::lang(),
								'after' => $langue
						));
						
						// Enregistre log.
						archive::acte('EditLangue', $arch, user::id(), session::id());
					}
				}
				
				// Prepa info user.
				$tmpUser=json_encode(
					array(
						'email' => user::email(),
						'verif' => user::verif(),
						'registerdate' => user::registerdate(),
						'lastvisitedate' => user::lastvisitedate(),
						'role' => user::role(),
						'lang' => $tmpLang
				));
				
				// Return info user.
				$tmp['user']=crp::crypte($tmpUser,user::password());
				
				// Return le id session.
				$tmp['session']=crp::crypte(session::id(),user::password());
				
				// Add 30mn new date.
				$dateFuture = $dateNew->getTimestamp()+1800;
				
				// Prepart requet.
				$req=array('date' => $dateFuture,
					'sid' => session::id());
				
				// Valide et prolange session.
				dbSys::setTimeSession($req, 'valide');
				
				// Enregistre log.
				archive::acte('DEF-LOGIN', $tmpUser, user::id(), session::id());
			}
			
			// Password non valide.
			else {
				sleep(2);
				throw new Exception('LOGIN-ERROR-INVALID-CODE');
			}
		}
		
		// mail non valide.
		else {
			sleep(2);
			throw new Exception('LOGIN-ERROR-INVALID-CODE-OR-SESSION');
		}
		
		// return result.
		return $tmp;
	}
	
	/*
	 * Function historique. 0.4
	 */ 
	public static function historique($c='') {
		
		// Var de retour. Array.
		$tmp=Array('historique'=>Array(), 'chart'=>Array());
		
		// Decript mail & verifier.
		if('control'==crp::decrypte($c,user::password())) {
			
			// Get historique to db.			
			$tmpHistoire = dbSys::getHistorique(array('id' => user::id()));
			foreach ($tmpHistoire as $key => $value) {
				
				// Var historique.
				$tmp['historique'][]=Array(
					'date' => $value['date'],
					'usip' => $value['usip'],
					'action' => $value['action']
				);
				
				// If key existe. Increment le nombre.
				if(array_key_exists($value['action'], $tmp['chart'])) $tmp['chart'][$value['action']]++;
				
				// Else add action in array.
				else $tmp['chart'][$value['action']]=1;
			}
		}
		
		// Password non valide.
		else throw new Exception('LOGIN-ERROR-INVALID-CODE-OR-SESSION');
		
		// Retourner le resulta.
		return $tmp;
	}
	
	/*
	 * Function inscription. 0.4
	 */ 
	public static function inscription($m='', $l='') {
		
		// Date Actuel.
		$dateNew = new DateTime();
		
		// Recup mail.
		$eMail=filtre::base(base64_decode($m));
		
		// Recup langue.
		$langue=filtre::base(base64_decode($l));
		
		// Var return. Array.
		$tmp=Array();
		
		// Valide cle.
		if(valide::email($eMail)) {
			
			// setup fonction model.
			$tmpUser=dbSys::getUser(array('email' => $eMail));
			
			//if user not in db.
			if(empty($tmpUser)) {
					
				// Langue api.
				$apiLangue=explode(',', config::sys('lang'));
				
				// Verif langue.
				$tmpLang=(in_array($langue, $apiLangue))? $langue : $apiLangue[0];
				
				// Password
				$pass=filtre::rands(6);
				// Cles de cryptage.
				$cles=md5(filtre::rands(8));
				// Password crypter.
				$passCrypte=crp::crypte($pass, $cles);
					
				// Prepa requet.
				$req=array('email' => $eMail,
					'password' => sha1($pass),
					'rdate' => $dateNew->getTimestamp(),
					'role' => 'membre',
					'lang' => $tmpLang
				);
				
				// new db user.
				dbSys::setNewUser($req);
					
				// fonction model.
				$tmpUser=dbSys::getUser(array('email' => $eMail));
					
				//if user in db.
				if(!empty($tmpUser)) {
					 
					// Numero camande.
					$num=$dateNew->getTimestamp().'-'.filtre::rands(8).'-'.filtre::rands(3);
					
					/*
					 * Prepa donnes mail 1.
					 * @param add destinataire.
					 * @param sujet.
					 * @param body. html fichier.
					 */
					$mail1=array(
						'add' => $tmpUser['email'],
						'sujet' => 'Pin codes encrypting',
						'date' => $dateNew->format('D d F Y - H:i'),
						'code' => $passCrypte,
						'num' => $num
					);
					
					$mail2=array(
						'add' => $tmpUser['verif'],
						'sujet' => 'Key for decrypting',
						'date' => $dateNew->format('D d F Y - H:i'),
						'code' => $cles,
						'num' => $num
					);
					
					// Start email.
					email::start();
					
					// Boucle envois mail.
					$complet=0;
					while($complet<2)
					{
						if($complet==0) {
							
							/*
							 * Function sendNow.
							 * @param from. adresse expéditeur. if not, mail expéditeur config.
							 * @param fromName. name expéditeur. if not, name expéditeur config.
							 * @param addRetour. adresse retour en cas d'échec.
							 * @return boelien true/false. 
							 */
							if(email::sendNow($mail1)) $complet=1;
						}
						
						if($complet==1) {
							
							/*
							 * Function sendNow.
							 * @param from. adresse expéditeur. if not, mail expéditeur config.
							 * @param fromName. name expéditeur. if not, name expéditeur config.
							 * @param addRetour. adresse retour en cas d'échec.
							 * @return boelien true/false. 
							 */
							if(email::sendNow($mail2)) $complet=2;
						}
					}
					
					// Enregistre log.
					archive::acte('DEF-SIGNUP', json_encode($req), $tmpUser['id'], '0');
						    
					// return reponse.
					$tmp['valide']='ok';
		    	}
				
				// if user erreur.
				else throw new Exception('LOGIN-ERROR-REGISTRATION-FAILED');
			}
			
			// if user not in db.
			else throw new Exception('LOGIN-ERROR-MAIL-MESSAGE');
		}
		
		// if mail non valide.
		else throw new Exception('LOGIN-ERROR-INVALID-MAIL');
		
		// return result.
		return $tmp;
	}
	
	/*
	 * Function forgotCodePin. 0.4
	 */ 
	public static function forgotCodePin($e='') {
		
		// Recup mail.
		$eMail=filtre::base(base64_decode($e));
		
		// Date Actuel.
		$dateNew = new DateTime();
		
		// Var return. Array.
		$tmp=Array();
		
		// Valide cle.
		if(valide::email($eMail)) {
			
			// fonction model.
			$tmpUser=dbSys::getUser(array('email' => $eMail));
			
			//if user not in db.
			if(!empty($tmpUser)) {
				
				// Password
				$pass=filtre::rands(6);
				// Cles cryptage.
				$cles=md5(filtre::rands(8));
				// Password crypter.
				$passCrypte=crp::crypte($pass, $cles);
				
				// new code secu.
				$req=array(
					'password' => sha1($pass),
					'id' => $tmpUser['id']
				);
				
				// Set to db.			
				dbSys::setNewCodePin($req);
				
				// Numero camande.
				$num=$dateNew->getTimestamp().'-'.filtre::rands(8).'-'.filtre::rands(3);
					
				/*
				 * Preparation donnes mail 1.
				 * @param add destinataire.
				 * @param sujet.
				 * @param body. html fichier.
				 */
				$mail1=array(
					'add' => $tmpUser['email'],
					'sujet' => 'Pin codes encrypting',
					'date' => $dateNew->format('D d F Y - H:i'),
					'code' => $passCrypte,
					'num' => $num
				);
				
				$mail2=array(
					'add' => $tmpUser['verif'],
					'sujet' => 'Key for decrypting',
					'date' => $dateNew->format('D d F Y - H:i'),
					'code' => $cles,
					'num' => $num
				);
				
				// Start email.
				email::start();
					
				// Boucle envois mail.
				$complet=0;
				while($complet<2)
				{
					if($complet==0) {
							
						/*
						 * Function sendNow.
						 * @param from. adresse expéditeur. if not, mail expéditeur config.
						 * @param fromName. name expéditeur. if not, name expéditeur config.
						 * @param addRetour. adresse retour en cas d'échec.
						 * @return boelien true/false. 
						 */
						if(email::sendNow($mail1)) $complet=1;
					}
						
					if($complet==1) {
							
						/*
						 * Function sendNow.
						 * @param from. adresse expéditeur. if not, mail expéditeur config.
						 * @param fromName. name expéditeur. if not, name expéditeur config.
						 * @param addRetour. adresse retour en cas d'échec.
						 * @return boelien true/false. 
						 */
						if(email::sendNow($mail2)) $complet=2;
					}
				}
				
				// Enregistre log.
				archive::acte('DEF-CODE-PIN-RESET', json_encode($req), $tmpUser['id'], '0');
				
				// return reponse.
				$tmp['valide']='ok';
			}
			
			// user in db.
			else throw new Exception('LOGIN-ERROR-MAIL-INVALID');
		}
		
		// if mail non valide.
		else throw new Exception('LOGIN-ERROR-INVALID-MAIL');
		
		// return result.
		return $tmp;
	}
	
	/*
	 * Function editMail. 0.4
	 */ 
	public static function editMail($e='', $c='') {
		
		// Recup mail.
		$eMail=crp::decrypte($e, user::password());
		$eConf=crp::decrypte($c, user::password());
		
		// Var return. Array.
		$req=Array();
		
		// Valide mail.
		if(valide::email($eMail)) {
			
			// switch sur config.
			switch ($eConf) {
				case 'principal':
					
					// fonction model.
					$tmpUser=dbSys::getUser(array('email' => $eMail));
					
					//if user in db.
					if(empty($tmpUser)) {
						
						// new code secu.
						$req=array(
							'email' => $eMail,
							'id' => user::id()
						);
						
						// Set to db.			
						dbSys::setNewMailUser($req, true);
					}
					
					// if not unser in db.
					else throw new Exception('LOGIN-ERROR-MAIL-MESSAGE');
					break;
					
				case 'security':
					
					// new code secu.
					$req=array(
						'email' => $eMail,
						'id' => user::id()
					);
					
					// Set to db.			
					dbSys::setNewMailUser($req, false);
					break;
					
				default:
					throw new Exception('LOGIN-ERROR-MAIL-UNKNOWN-PARAM');
			}
		}
		
		// if mail non valide.
		else throw new Exception('LOGIN-ERROR-INVALID-MAIL');
		
		// Enregistre log.
		archive::acte('modif-mail-'.$eConf, json_encode($req));
		
		// add info for archive
		$req['date']=date("U");
		$req['action']='modif-mail-'.$eConf;
		$req['usip']=config::server('usip');
		$req['config']=$eConf;
		
		// Return result.
		return $req;
	}
}

?>