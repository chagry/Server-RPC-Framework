<?php
/*
 * @version		0.4
 * @date Crea	26/04/2013.
 * @date Modif	01/12/2013.
 * @package		model_dbSys.php
 * @contact		Chagry.fr - git@chagry.fr
 */

defined('CHAG') or die('Acces interdit');

class dbSys {
	
	/*
	 * Function getUser. 0.4
	 * @Param $e mail user.
	 * return Array() -> champs user.
	 */
	public static function getUser($e=array()) {
	
		try {
		
			// requête SQL.
			$req = db::go('SELECT * FROM sys_user WHERE email=:email');
			
			// Exécut requête.
			$req->execute($e);
			
			// Récup donnes db.
			$arrTmp = $req->fetch();
		
			// close requête SQL.
			$req->closeCursor();
			
			// return result.
			return $arrTmp;
		}
	
		catch(Exception $e) { throw new Exception('er-base-de-donnee'); }
	}
	
	/*
	 * Function setLastVisitDateUser. 0.4
	 * @Param $e date & id user.
	 */ 
	public static function setLastVisitDateUser($e=array()) {
	
		try {
		
			// requête SQL.
			$req = db::go('UPDATE sys_user SET lastvisitedate=:lastvisitedate WHERE id=:id');
			
			// Exécut requête.
			$req->execute($e);
		
			// close requête SQL.
			$req->closeCursor();
		}
	
		catch(Exception $e) { throw new Exception('er-base-de-donnee'); }
	}
	
	/*
	 * Function getHistorique. 0.4
	 * @Param $e id user.
	 */ 
	public static function getHistorique($e=array()) {
	
		try {
		
			// requête SQL.
			$req = db::go('SELECT * FROM sys_log WHERE userid=:id LIMIT 100');
			
			// Exécut requête.
			$req->execute($e);
			
			// Récup donnes db.
			$arrTmp = $req->fetchAll();
    	
    		// close requête SQL.
			$req->closeCursor();
			
			// return result.
			return $arrTmp;
		}
	
		catch(Exception $e) { throw new Exception('er-base-de-donnee'); }
	}
	
	/*
	 * Function setNewCodePin. Modif user. 0.4
	 * @Param $e code pin & id user.
	 */ 
	public static function setNewCodePin($e=array()) {
	
		try {
		
			// requête SQL.
			$req = db::go('UPDATE sys_user SET password=:password WHERE id=:id');
			
			// Exécut requête.
			$req->execute($e);
		
			// close requête SQL.
			$req->closeCursor();
		}
	
		catch(Exception $e) { throw new Exception('er-base-de-donnee'); }
	}
	
	/*
	 * Function setNewLangue. 0.4
	 * @Param $e langue & id user.
	 */ 
	public static function setNewLangue($e=array()) {
	
		try {
		
			// requête SQL.
			$req = db::go('UPDATE sys_user SET lang=:lang WHERE id=:id');
			
			// Exécut requête.
			$req->execute($e);
		
			// close requête SQL.
			$req->closeCursor();
		}
	
		catch(Exception $e) { throw new Exception('er-base-de-donnee'); }
	}
	
	/*
	 * Function setNewMailUser. Modif user. 0.4
	 * @Param $e mail & id user.
	 * @Param $c if true mail if flase verif.
	 */ 
	public static function setNewMailUser($e=array(), $c='') {
	
		try {
			// if true adr principal.
			if($c) $req = db::go('UPDATE sys_user SET email=:email WHERE id=:id');
			// if no adr verif.
			else $req = db::go('UPDATE sys_user SET verif=:email WHERE id=:id');
			
			// Exécut requête.
			$req->execute($e);
		
			// close requête SQL.
			$req->closeCursor();
		}
	
		catch(Exception $e) { throw new Exception('er-base-de-donnee'); }
	}
	
	/*
	 * getSession. 0.4
	 * @Param $e id session.
	 * return Array() -> champs session join user.
	 */ 
	public static function getSession($e=array()) {
	
		try {
		
			// requête SQL.
			$req = db::go(
				'SELECT s.sid, s.date, s.valide, u.id, u.email, u.password, u.block, u.verif, u.registerdate, u.lastvisitedate, u.role, u.lang
				FROM sys_session s
				INNER JOIN sys_user u
				ON s.userid = u.id
				WHERE s.sid=:sid'
			);
			
			// Exécut requête.
			$req->execute($e);
			
			// Récup donnes db.
			$arrTmp = $req->fetch();
		
			// Close requête SQL.
			$req->closeCursor();
			
			// return result.
			return $arrTmp;
		}
	
		catch(Exception $e) { throw new Exception('er-base-de-donnee'); }
	}
	
	/*
	 * setTimeSession. 0.4
	 * @Param $e date & id session.
	 * @Param $c if valide activer session.
	 */ 
	public static function setTimeSession($e=array(), $c='') {
	
		try {
		
			// requête SQL.
			$req = db::go('UPDATE sys_session SET date=:date WHERE sid=:sid');
			
			// $c if valide activer session.
			if($c=='valide') $req = db::go('UPDATE sys_session SET date=:date, valide=1 WHERE sid=:sid');
			
			// Exécut requête.
			$req->execute($e);
		
			// close requête SQL.
			$req->closeCursor();
		}
	
		catch(Exception $e) { throw new Exception('er-base-de-donnee'); }
	}
	
	/*
	 * deletSessionByDate. 0.4
	 * @Param $e date & id session.
	 */ 
	public static function deleteSessionByDate($e=array()) {
	
		try {
		
			// requête SQL.
			$req = db::go('DELETE FROM sys_session WHERE date <= :dateSup');
			
			// Exécut requête.
			$req->execute($e);
		
			// Close requête SQL.
			$req->closeCursor();
		}
	
		catch(Exception $e) { throw new Exception('er-base-de-donnee'); }
	}
	
	/*
	 * setNewSession. 0.4
	 * @Param $e la date, le id session, id user.
	 */ 
	public static function setNewSession($e=array()) {
	
		try {
		
			// requête SQL.
			$req = db::go('INSERT INTO sys_session VALUES(:sid, :date, :userid, 0)');
			
			// Exécut requête.
			$req->execute($e);
		
			// Close requête SQL.
			$req->closeCursor();
		}
	
		catch(Exception $e) { throw new Exception('er-base-de-donnee'); }
	}
	
	/*
	 * Function setNewActeInArchive. 0.4
	 * @Param $e date, id session, id user, Action, Parametre.
	 */
	public static function setNewActeInArchive($e=array()) {
	
		try {
		
			// requête SQL.
			$req = db::go('INSERT INTO sys_log VALUES(:sid, :date, :usip, :userid, :action, :parametre)');
			
			// Exécut requête.
			$req->execute($e);
		
			// close requête SQL.
			$req->closeCursor();
		}
	
		catch(Exception $e) { throw new Exception('er-base-de-donnee'); }
	}
	
	/*
	 * Function setNewUser. new user. 0.4
	 * @Param $e array info user.
	 */ 
	public static function setNewUser($e=array()) {
	
		try {
		
			// requête SQL.
			$req = db::go('INSERT INTO sys_user VALUES("", :email, :password, 0, :email, :rdate, 0, :role, :lang)');
			
			// Exécut requête.
			$req->execute($e);
		
			// close requête SQL.
			$req->closeCursor();
		}
	
		catch(Exception $e) { throw new Exception('er-base-de-donnee'); }
	}
}
?>