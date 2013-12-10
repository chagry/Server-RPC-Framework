<?php
/*
 * @version		0.4
 * @date Crea	26/04/2013.
 * @date Modif	04/10/2013.
 * @package		sys_user.php
 * @contact		Chagry.fr - git@chagry.fr
 */

defined('CHAG') or die('Acces interdit');

class user {
	
	/*
	 * @var private $Info  -> array user info. 0.4
	 */
	private static $info = array();
	
	/*
	 * Function __callStatic. Retourn info user. 0.4
	 * @var $e	 -> info.
	 */ 
	public static function __callStatic($name, $e) {
		
		// if info in array.
		if(array_key_exists($name, self::$info)) return self::$info[$name];
		
		// else return null.
		else return '';
	}
	
	/*
	 * Function noGuest(). Return true or false. 0.4
	 */ 
	public static function noGuest() {
	
		// if user id.
		if(self::$info!='' && self::$info!=array()) return true;
		
		// else not user.
		else return false;
	}
	
	/*
	 * Function start(). 0.4
	 * @var $e	-> array user info.
	 */ 
	public static function start($e='') {
		
		// if user connect.
		if(session::userId()!=0 && $e!='') {
			
			// if user not bloked.
			if($e['block']==0) {
				
				self::$info=array(
					'email' => $e['email'],
					'id' => $e['id'],
					'verif' => $e['verif'],
					'password' => $e['password'],
					'registerdate' => $e['registerdate'],
					'lastvisitedate' => $e['lastvisitedate'],
					'role' => $e['role'],
					'lang' => $e['lang']
				);
			}
			
			// else user bloked.
			else throw new Exception('compte-bloque-contact');
		}
	}
}
?>