<?php
/**
 * @version 0.5.0
 * @license MIT license
 * @link    https://chagry.com
 * @author  Grigori <git@chagry.com>
 * @package controleur_btc.php
 */

defined('CHAG') or die('Acces interdit');

class btc {
	
	/**
	 * Function infos info of blockChain.
	 * @return	 array "btc blockChain info"
	 * @access	 public
	 * @static
	 */
	public static function infos() {
		
		// Upload btc price blockChain.
		$pr = file_get_contents('https://blockchain.info/ticker');
		$cr = file_get_contents('https://blockchain.info/charts/market-price?timespan=1year&format=json');
		
		// If valide infos.
		if($pr) {
			
			// @var array return.
			$tmp=Array();
			
			// Add price for return.
			$tmp['prices']=json_decode($pr,true);
			$tmp['history']=json_decode($cr,true);
			
			// Return array.
			return $tmp;
		}
					
		// else not btc.
		else throw new Exception('BTC-ERR-SERVER-UNAVAILABLE');
	}
	
	/**
	 * Function news blockChain info price.
	 * @return	 array btc + value.
	 * @access	 public
	 * @static
	 */
	public static function news() {
		
		// Upload btc price blockChain.
		$pr = file_get_contents('https://blockchain.info/ticker');
		
		// If valide infos.
		if($pr) {
			
			// @var array return.
			$tmp=Array();
			
			// Add price for return.
			$tmp=json_decode($pr,true);
			
			// Return array.
			return $tmp;
		}
					
		// else not btc.
		else throw new Exception('BTC-ERR-SERVER-UNAVAILABLE');
	}
}
?>