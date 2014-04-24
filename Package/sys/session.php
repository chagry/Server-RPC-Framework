<?php
/**
 * @version 0.5.0
 * @license MIT license
 * @link    https://chagry.com
 * @author  Grigori <git@chagry.com>
 * @package sys_session.php
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
		$idSess = md5(util::rands(15));
		
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
		
		catch (Exception $e) { throw new Exception('SERV-ERROR-SESSION'); }
		
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
				
				// Add config time session.
				$dateFuture = $dateNew->getTimestamp()+config::sys('tmpSession');
				
				// req.
				$req=array('date' => $dateFuture,
							'sid' => $tmpUser['sid']);
				
				// db.
				dbSys::setTimeSession($req);
			}
			
			// Exception.
			else throw new Exception('SERV-ERROR-SESSION-EXPIRE');
		}
		
		// Exception.
		catch (Exception $e) { throw new Exception('SERV-ERROR-SESSION-EXPIRE'); }
		
		return $idSess;
	}
}
?>