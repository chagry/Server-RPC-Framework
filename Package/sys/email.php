<?php
/*
 * @version		0.5
 * @date Crea	26/04/2013.
 * @date Modif	12/02/2014.
 * @package		sys_email.php
 * @contact		Chagry.com - git@chagry.com
 */

defined('CHAG') or die('Acces interdit');

class email {

	/*
	 * @var $mailer    -> Définie la class phpMailer.
	 */
	private static $mailer = '';
	
	/*
	 * Function start. 0.4
	 */ 
	public static function start() {
		
		// Class phpmailer.
		load::auto('lib_class.phpmailer');
		
		// Instancier la class de librairie phpmailer.
		self::$mailer = new PHPmailer();
		
		// Utiliser le mail local.
		self::$mailer->IsMail();
		
		// Les mail sont en HTML.
		self::$mailer->IsHTML(true);
		
		// Les caracter encoding.
		self::$mailer->CharSet = "UTF-8";
		
		// Patch url class.
		self::$mailer->PluginDir = config::mail('pluginDir');
	}
	
	/*
	 * Function sendNow. 0.4
	 * @param e add destinataire.
	 * @param e sujet.
	 * @param e body fichier html.
	 * @param from. adresse expéditeur. if not, mail expéditeur config.
	 * @param fromName. name expéditeur. if not, name expéditeur config.
	 * @param addRetour. adresse retour en cas d'échec.
	 * @return boelien true/false. 
	 */
	public function sendNow($e, $from='', $fromName='', $addRetour='') {
	
		// Si la Var de l'expéditeur est vide.
		if(empty($from)) self::$mailer->From=config::mail('from');
		
		// // Si la Var de l'expéditeur n'est  pas vide.
		else self::$mailer->From=$from;
		
		// Si la Var nom de l'expéditeur est vide.
		if(empty($fromName)) self::$mailer->FromName=config::mail('fromName');
		
		// Si la Var nom de l'expéditeur n'est  pas vide.
		else self::$mailer->FromName=$fromName;
		
		// Si la Var de l'expéditeur est vide.
		if(!empty($addRetour)) self::$mailer->AddReplyTo($addRetour);
		
		// Ajout l'adress représente le destinataire.
		self::$mailer->AddAddress($e['add']);
		
		// le sujet du mail.
		self::$mailer->Subject=$e['sujet'];
		
		// Charger la class template.
		load::auto('tmpl_mail');	
		
		// Contient le corps du message à envoyer.
		self::$mailer->Body=tmplMail::start($e);
		
		// Envoi mail.
		if(self::$mailer->Send()) {	
			self::$mailer->ClearAddresses();
			return true;
		}

		// sinon ça retourne une réponse négative
		else {
			self::$mailer->ClearAddresses();
			return false;
		}
	}
}
?>