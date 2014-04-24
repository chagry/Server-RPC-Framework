<?php
/**
 * @version 0.5.0
 * @license MIT license
 * @link    https://chagry.com
 * @author  Grigori <git@chagry.com>
 * @package lib_load.php
 */

class load {
	
	/*
	 * Function auto(). 0.4
	 * @param $className.
	 */ 
	public static function auto($className) {
	
		$demande = str_replace('_','/',$className).'.php';
		if (!is_file($demande)) throw new Exception('SERV-ERROR-NOT-FIND-FILE');
		else require_once $demande;
	}
}
?>