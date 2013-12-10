<?php
/*
 * @version		0.4
 * @date Crea	29/04/2013.
 * @date Modif	12/10/2013.
 * @package		lib_load.php
 * @contact		Chagry.fr - git@chagry.fr
 */

class load {
	
	/*
	 * Function auto().
	 * @param $className.
	 */ 
	public static function auto($className) {
	
		$demande = str_replace('_','/',$className).'.php';
		if (!is_file($demande)) throw new Exception('er-chargement-fichier');
		else require_once $demande;
	}
}
?>