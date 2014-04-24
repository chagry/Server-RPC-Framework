<?php
/**
 * @version 0.5.0
 * @license MIT license
 * @link    https://chagry.com
 * @author  Grigori <git@chagry.com>
 * @package model_dbMo.php
 */

defined('CHAG') or die('Acces interdit');

class dbMo {
	
	/**
	 * Function getGreet.
	 * @param   array $e code langue "en".
	 * @return  array greet db
	 * @access  public
	 * @static
	 */
	public static function getGreet($e) {
	
		try {
		
			// query SQL.
			$req = db::go('SELECT * FROM dem_greet WHERE lang=:lang');
			
			// Execute query.
			$req->execute($e);
			
			// data db.
			$dataTmp = $req->fetch();
    	
    		// close query SQL.
			$req->closeCursor();
			
			// return result.
			return $dataTmp;
		}
	
		catch(Exception $e) { throw new Exception('SERV-ERROR-DATABASE'); }
	}
}

?>