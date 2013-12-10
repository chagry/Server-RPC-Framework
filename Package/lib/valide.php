<?php
/*
 * @version		0.4
 * @date Crea	29/04/2013.
 * @date Modif	12/10/2013.
 * @package		lib_valide.php
 * @contact		Chagry.fr - git@chagry.fr
 */

class valide
{
	/*
	 * Function email().
	 * @param. mail.
	 * @return boolean TRUE or FALSE. 
	 */
	public static function email($str='')
	{
		// RegEx.
		$Syntaxe = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,5}$#' ;
		$tmp = false;
		
		if(preg_match($Syntaxe,$str)) $tmp = true;
		else $tmp = false;
		
		// Return.
		return $tmp;
	}
	
	/*
	 * Function strMd5().
	 * @param. String md5.
	 * @return boolean TRUE or FALSE. 
	 */
	public static function strMd5($str='')
	{
		// RegEx
		$Syntaxe = '#^[a-f0-9]{32}$#' ;
		$tmp = false;
		
		if(preg_match($Syntaxe,$str)) $tmp = true;
		else $tmp = false;
		
		// Return.
		return $tmp;
	}
	
	/*
	 * Function strSha1().
	 * @param. String Sha1.
	 * @return boolean TRUE or FALSE. 
	 */
	public static function strSha1($str='')
	{
		// RegEx
		$Syntaxe = '#^[a-f0-9]{40}$#' ;
		$tmp = false;
		
		if(preg_match($Syntaxe,$str)) $tmp = true;
		else $tmp = false;
		
		// Return.
		return $tmp;
	}
}
?>