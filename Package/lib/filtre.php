<?php
/*
 * @version		0.4
 * @date Crea	29/04/2013.
 * @date Modif	12/10/2013.
 * @package		lib_filtre.php
 * @contact		Chagry.fr - git@chagry.fr
 */

class filtre {

	/*
	 * Function base().
	 * @param. String.
	 * @return $str. 
	 */
	public static function base($str='') {
	
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
	 * Function rands().
	 * @param. nuber.
	 * @return $number. 
	 */
	public static function rands($e=6) {
		$nps = '';
		
		for($i=0;$i<$e;$i++)
		{
			$nps .= mt_rand(1, 9);
		}
		
		// Return number.
		return $nps;
	}
}
?>