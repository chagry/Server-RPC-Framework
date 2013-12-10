<?php
/*
 * @version		0.4
 * @date Crea	26/04/2013.
 * @date Modif	04/10/2013.
 * @package		sys_acl.php
 * @contact		Chagry.fr - git@chagry.fr
 */

defined('CHAG') or die('Acces interdit');

class acl {

	/*
	 * @var private $listACL.
	 */
	private static $listRegle =array();
	private static $listRole =array();
	
	/*
	 * Function addRole(). 0.4
	 * @param $r -> role.
	 */ 
	public static function addRole($r) {
	
		// Add role.
		self::$listRole[]=filtre::base($r);
	}
	
	/*
	 * Function addRegle(). 0.4
	 * @var $controleur.
	 * @var $action.
	 * @var $role.
	 */ 
	public static function addRegle($c, $a, $r) {
	
		// Add regle.
		self::$listRegle[filtre::base($c)][filtre::base($a)]=filtre::base($r);
	}
	
	/*
	 * Function isAllowed(). 0.4
	 * @var $controleur.
	 * @var $action.
	 */ 
	public static function isAllowed($c, $a) {
	
		// Role user func.
		$userRole = self::roleUser();
		
		// Regle controleur func.
		$aliasRegle = self::regle($c, $a);
		
		// if role & regle ok func.
		if(!self::compart($userRole, $aliasRegle)){
		
			// if user connect.
			if(user::noGuest()) throw new Exception('SERV-ERROR-ACCESS-DENIED');
			
			// else user not connect.
			else throw new Exception('SERV-ERROR-ACCESS-NO-CONNECT');
		}
	}
	
	/*
	 * Function roleUser(). 0.4
	 */ 
	private static function roleUser() {
		
		// return user role.
		if(user::noGuest()) return user::role();
		
		// else return guest role.
		else return 'guest';
	}
	
	/*
	 * Function regle(). 0.4
	 * @var $controleur.
	 * @var $action.
	 */ 
	private static function regle($c, $a)
	{
		// if controleur exist.
		if(array_key_exists($c, self::$listRegle)) {
			
			// if action exist.
			if(array_key_exists($a, self::$listRegle[$c])) {
			
				// if role is ok.
				if(in_array(self::$listRegle[$c][$a], self::$listRole)) return self::$listRegle[$c][$a];
				
				// Exception.
				else throw new Exception('SERV-ERROR-INVALID-ROLE');
			}
			
			// Exception.
			else throw new Exception('SERV-ERROR-INVALID-ACTION');	
		}
		
		// Exception.
		else throw new Exception('SERV-ERROR-INVALID-CONTROLLER');
	}
	
	/*
	 * Function compart(). 0.4
	 * @param $e role.
	 * @param $a regle.
	 * @return boolean TRUE or FALSE.
	 */ 
	private static function compart($e, $a)
	{
		$tmp = false;
		
		// level role.
		$levelRole = array_search($e, self::$listRole);
		
		// level regle.
		$levelRegle = array_search($a, self::$listRole);
		
		// if ok return true.
		if($levelRole>=$levelRegle) $tmp = true;
		
		// not return false.
		return $tmp;
	}
}
?>