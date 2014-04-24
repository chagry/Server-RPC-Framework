<?php
/**
 * @version 0.5.0
 * @license MIT license
 * @link    https://chagry.com
 * @author  Grigori <git@chagry.com>
 * @package controleur_demo.php
 */

defined('CHAG') or die('Acces interdit');

class demo {
	
	/**
	 * Function greetings first function for demo class.
	 * @param	 string $e the name of client.
	 * @param	 string $l the code langue of client.
	 * @return	 string Message "hello $e"
	 * @access	 public
	 * @static
	 */
	public static function greetings($e='', $l='') {
		
		// if empty name. Stop API.
		if(!$e) throw new Exception('DEMO-ERROR-USER-EMPTY');
		
		// Class model dbMo.
		load::auto('model_dbMo');
		
		// Langue api.
		$apiLangue=explode(',', config::sys('lang'));
						
		// if langue valid.
		if(in_array($l, $apiLangue)) $tmpLang=$l;
		// Else langue default en.
		else $tmpLang='en';
		
		// Prepart query.
		$req=array('lang' => $tmpLang);
				
		// query.
		$tmpGreet=dbMo::getGreet($req);
		
		// @var array return.
		$tmp=Array();

		// Add var greet in array.
		$tmp['greet']=$tmpGreet['mess'].' '.util::filtre($e);
		$tmp['lang']=$tmpGreet['lang'];
		
		// Return array.
		return $tmp;
	}
}
?>