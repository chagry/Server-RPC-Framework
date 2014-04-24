<?php
/**
 * @version 0.5.0
 * @license MIT license
 * @link    https://chagry.com
 * @author  Grigori <git@chagry.com>
 * @package sys_user.php
 */

defined('CHAG') or die('Acces interdit');

class user {
	
	/**
	 * @var $Info  -> array user info.
	 * @access  private
	 */
	private static $info = array();
	
	/**
	 * Function __callStatic.
	 * @param   string $name key of array info user.
	 * @return  string value of user.
	 * @access  public
	 * @static
	 */
	public static function __callStatic($name, $e) {
		
		// if info in array.
		if(array_key_exists($name, self::$info)) return self::$info[$name];
		
		// else return null.
		else return '';
	}
	
	/**
	 * Function noGuest.
	 * @return  boolean
	 * @access  public
	 * @static
	 */ 
	public static function noGuest() {
	
		// if user id.
		if(self::$info!='' && self::$info!=array()) return true;
		
		// else not user.
		else return false;
	}
	 
	/**
	 * Function noGuest.
	 * @param   array $e user info.
	 * @access  public
	 * @static
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
			else throw new Exception('SERV-ERROR-USER-BLACKLISTED');
		}
	}
}
?>