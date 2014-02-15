<?php
/*
 * @version		0.5
 * @date Crea	26/04/2013.
 * @date Modif	12/02/2014.
 * @package		sys_db.php
 * @contact		Chagry.com - git@chagry.com
 */

defined('CHAG') or die('Acces interdit');

class db {

	/*
	 * @var $go -> class PDO.
	 */
	private static $go ='';
	
	/*
	 * Function connect(). 0.4
	 * @param $dbcon.
	 * @return new PDO.
	 */
	public static function connect($dbcon) {
	
		// if not PDO.
		if(self::$go=='') {
			
			try {
			
				// Option error PDO.
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				// Conexion.
				self::$go = new PDO('mysql:host='.$dbcon['host'].';dbname='.$dbcon['db'],$dbcon['user'],$dbcon['pass'], $pdo_options);
			}
			
			// Exception.
			catch(Exception $e) { throw new Exception('SERV-ERROR-CONNECT-MYSQL'); }
		}
	}
	
	/*
	 * Function go(). 0.4
	 * @param $prepa.
	 * @return new PDO.
	 */
	public static function go($prepa) {
	
		// if PDO.
		if(self::$go=='') self::connect(config::db());
		// Return
		return self::$go->prepare($prepa);
	}
}
?>