<?php
/*
 * @version		0.4
 * @date Crea	26/04/2013.
 * @date Modif	04/12/2013.
 * @package		sys_archive.php
 * @contact		Chagry.fr - git@chagry.fr
 */
 
defined('CHAG') or die('Acces interdit');

class archive {

	/*
	 * Function acte. 0.4
	 * @param $a   	  action.
	 * @param $p   	  parametres.
	 */ 
	public static function acte($a='', $p='', $u='', $s='') {
	
		// req.
		$req=(
			array(
				'sid' => ($s!='')? $s : session::id(),
				'date' => date("U"),
				'usip' => config::server('usip'),
				'userid' => ($u!='')? $u : session::userId(),
				'action' => $a,
				'parametre' => $p
			)
		);
		
		// add in db.
		dbSys::setNewActeInArchive($req);
	}
	
	/*
	 * Function sys. 0.4
	 * @param $a	action.
	 * @param $p	parametres.
	 * @param $u	User id.
	 */ 
	public static function sys($a='', $p='', $u='') {
	
		// Execution de la requet.
		$req=(
			array(
				'sid' => 0,
				'date' => date("U"),
				'usip' => 'system',
				'userid' => $u,
				'action' => $a,
				'parametre' => $p
			)
		);
		
		// add in db.
		dbSys::setNewActeInArchive($req);
	}
}
?>