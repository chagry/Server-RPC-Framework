<?php
/*
 * @version		0.4
 * @date Crea	26/04/2013.
 * @date Modif	04/10/2013.
 * @package		sys_session.php
 * @contact		Chagry.fr - git@chagry.fr
 */

defined('CHAG') or die('Acces interdit');

class session {
	
	/*
	 * @var $idSess.
	 * @var $UserId.
	 */
	private static $idSess = '';
	private static $UserId = 0;
	
	/*
	 * Function Id(). 0.4
	 */ 
	public static function id() {
	
		return self::$idSess;
	}
	
	/*
	 * Function userId(). 0.4
	 */ 
	public static function userId() {
	
		return self::$UserId;
	}
	
	/*
	 * Function start(). 0.4
	 * @param $e -> id session.
	 */ 
	public static function start($e='') {
	
		// if id session not null.
		if($e!='') self::control($e);
	}
	
	/*
	 * Function news(). 0.4
	 * @param $e -> user id.
	 */ 
	public static function news($e='') {
	
		// New id session.
		$idSess = md5(rand(0,320000000));
		
		try {
		
			// New Date.
			$dateNew = new DateTime();
			
			// Delete session expire.
			dbSys::deleteSessionByDate(array('dateSup' => $dateNew->getTimestamp()));
			
			// Add 2mn new date.
			$dateFuture = $dateNew->getTimestamp()+120;
			
			// Req.
			$req=array('sid' => $idSess,
						'date' => $dateFuture,
						'userid' => $e);
			
			// db.
			dbSys::setNewSession($req);
		}
		
		catch (Exception $e) { throw new Exception('er-session-connecter'); }
		
		return $idSess;
	}
	
	/*
	 * Function control(). 0.4
	 * @param $e -> id session.
	 */ 
	public static function control($e='') {
	
		try {
		
			// New Date.
			$dateNew = new DateTime();
			
			// db.
			$tmpUser=dbSys::getSession(array('sid' => $e));
			
			// Date session.
			$dateSess=$tmpUser['date'];
			
			// if expire date.
			if(!empty($tmpUser) && $dateSess > $dateNew->getTimestamp()) {
				
				// self.
				self::$idSess=$tmpUser['sid'];
				self::$UserId=$tmpUser['id'];
				
				// Start user class.
				user::start($tmpUser);
				
				// Add 30mn new date.
				$dateFuture = $dateNew->getTimestamp()+1800;
				
				// req.
				$req=array('date' => $dateFuture,
							'sid' => $tmpUser['sid']);
				
				// db.
				dbSys::setTimeSession($req);
			}
			
			// Exception.
			else throw new Exception('session-expire-connecter');
		}
		
		// Exception.
		catch (Exception $e) { throw new Exception('session-expire-connecter'); }
		
		return $idSess;
	}
}
?>