<?php
/*
 * @version		0.5
 * @date Crea	29/04/2013.
 * @date Modif	12/02/2014.
 * @package		lib_util.php
 * @contact		Chagry.com - git@chagry.com
 */

class util {

	/*
	 * Function filtre(). 0.5
	 * @param. String.
	 * @return $str.
	 */
	public static function filtre($str='') {
	
		/*
		 * strip_tags.
		 * rtrim.
		 * ltrim.
		 */
		$str = strip_tags($str);
		$str = rtrim($str);
		$str = ltrim($str);
		return $str;
	}
	
	/*
	 * Function rands(). 0.5
	 * @param. nuber.
	 * @return $number aleo. 
	 */
	public static function rands($e=6) {
		
		// Boucle nb.
		$nps = '';
		for($i=0;$i<$e;$i++)
		{
			$nps .= mt_rand(1, 9);
		}
		
		// Return number.
		return $nps;
	}
	
	/*
	 * Function appendHexZeros(). 0.5
	 * @param. add.
	 * @return $hexEncodedAddress. 
	 */
	public static function appendHexZeros($inputAddress, $hexEncodedAddress) {
		
		//Append Zeros where nessecary
		for ($i = 0; $i < strlen($inputAddress) && $inputAddress[$i] == "1"; $i++) {
			$hexEncodedAddress = "00" . $hexEncodedAddress;
		}
		if (strlen($return) % 2 != 0) {
			$hexEncodedAddress = "0" . $hexEncodedAddress;
		}
		
		// Return result.
		return $hexEncodedAddress;
	}
	
	/*
	 * Function encodeHex(). 0.5
	 * @param. add.
	 * @return encodeHex. 
	 */
	public static function encodeHex($dec) {
		
		$chars="0123456789ABCDEF";
		$return="";
		while (bccomp($dec,0)==1){
			$dv=(string)bcdiv($dec,"16",0);
			$rem=(integer)bcmod($dec,"16");
			$dec=$dv;
			$return=$return.$chars[$rem];
		}
		
		// Return result.
		return strrev($return);
	}
	
	/*
	 * Function base58_decode(). 0.5
	 * @param. add.
	 * @return base58_decode. 
	 */
	public static function base58_decode($base58) {
		
		$origbase58 = $base58;
		//Define vairables
		$base58chars = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";
		$return = "0";
		
		for ($i = 0; $i < strlen($base58); $i++) {
			$current = (string) strpos($base58chars, $base58[$i]);
			$return = (string) bcmul($return, "58", 0);
			$return = (string) bcadd($return, $current, 0);
		}
		
		// Return result.
		return $return;
	}
}
?>