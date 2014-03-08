<?php
/*
 * @version		0.5
 * @date Crea	29/04/2013.
 * @date Modif	28/02/2014.
 * @package		lib_valide.php
 * @contact		Chagry.com - git@chagry.com
 */

class valide
{
	/*
	 * Function email(). 0.5
	 * @param. mail.
	 * @return boolean TRUE or FALSE. 
	 */
	public static function email($str='')
	{
		// RegEx.
		$tmp = false;
		
		// Control.
		if(filter_var($str, FILTER_VALIDATE_EMAIL)) $tmp = true;
		else $tmp = false;
		
		// Return.
		return $tmp;
	}
	
	/*
	 * Function strMd5(). 0.4
	 * @param. String md5.
	 * @return boolean TRUE or FALSE. 
	 */
	public static function strMd5($str='')
	{
		// RegEx.
		$Syntaxe = '#^[a-f0-9]{32}$#' ;
		$tmp = false;
		
		// Control.
		if(preg_match($Syntaxe,$str)) $tmp = true;
		else $tmp = false;
		
		// Return.
		return $tmp;
	}
	
	/*
	 * Function strSha1(). 0.4
	 * @param. String Sha1.
	 * @return boolean TRUE or FALSE. 
	 */
	public static function strSha1($str='')
	{
		// RegEx.
		$Syntaxe = '#^[a-f0-9]{40}$#' ;
		$tmp = false;
		
		// Control.
		if(preg_match($Syntaxe,$str)) $tmp = true;
		else $tmp = false;
		
		// Return.
		return $tmp;
	}
	
	/*
	 * Function url(). 0.5
	 * @param. String url.
	 * @return boolean TRUE or FALSE. 
	 */
	public static function url($str='')
	{
		// RegEx.
		$tmp = false;
		
		// Control.
		if(filter_var($str, FILTER_VALIDATE_URL)) $tmp = true;
		else $tmp = false;
		
		// Return.
		return $tmp;
	}
	
	/*
	 * Function domain(). 0.5
	 * @param. String url.
	 * @return boolean TRUE or FALSE. 
	 */
	public static function domain($str='')
	{
		//valid chars check
		$Syntaxe = '#^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i';
		//overall length check
		$Syntaxe1 = '#^.{1,253}$';
		//length of each label
		$Syntaxe2 = '#^[^\.]{1,63}(\.[^\.]{1,63})*$';
		
		$tmp = false;
		
		// Control.
		if(preg_match($Syntaxe,$str) && preg_match($Syntaxe1,$str) && preg_match($Syntaxe2,$str)) $tmp = true;
		else $tmp = false;
		
		// Return.
		return $tmp;
	}
	
	/*
	 * Function ip(). 0.5
	 * @param. String ip.
	 * @return boolean TRUE or FALSE. 
	 */
	public static function ip($str='')
	{
		// RegEx.
		$tmp = false;
		
		// Control.
		if(filter_var($str, FILTER_VALIDATE_IP)) $tmp = true;
		else $tmp = false;
		
		// Return.
		return $tmp;
	}
	
	/*
	 * Function floats(). 0.5
	 * @param. String float.
	 * @return boolean TRUE or FALSE. 
	 */
	public static function floats($str='')
	{
		// RegEx.
		$tmp = false;
		
		// Control.
		if(filter_var($str, FILTER_VALIDATE_FLOAT)) $tmp = true;
		else $tmp = false;
		
		// Return.
		return $tmp;
	}
	
	/*
	 * Function ints(). 0.5
	 * @param. String int.
	 * @return boolean TRUE or FALSE. 
	 */
	public static function ints($str='')
	{
		// RegEx.
		$tmp = false;
		
		// Control.
		if(filter_var($str, FILTER_VALIDATE_INT)) $tmp = true;
		else $tmp = false;
		
		// Return.
		return $tmp;
	}
	
	/*
	 * Function alpha(). 0.5
	 * @param. String alpha.
	 * @return boolean TRUE or FALSE. 
	 */
	public static function alpha($str='')
	{
		// RegEx.
		$Syntaxe = '#^[a-zA-Z]+$#' ;
		$tmp = false;
		
		// Control.
		if(preg_match($Syntaxe,$str)) $tmp = true;
		else $tmp = false;
		
		// Return.
		return $tmp;
	}
	
	/*
	 * Function alpha_numeric(). 0.5
	 * @param. String alpha_numeric.
	 * @return boolean TRUE or FALSE. 
	 */
	public static function alpha_numeric($str='')
	{
		// RegEx.
		$Syntaxe = '#^[a-zA-Z0-9]+$#' ;
		$tmp = false;
		
		// Control.
		if(preg_match($Syntaxe,$str)) $tmp = true;
		else $tmp = false;
		
		// Return.
		return $tmp;
	}
	
	/*
	 * Function numeric(). 0.5
	 * @param. String numeric.
	 * @return boolean TRUE or FALSE. 
	 */
	public static function numeric($str='')
	{
		// RegEx.
		$Syntaxe = '#^[0-9]+$#' ;
		$tmp = false;
		
		// Control.
		if(preg_match($Syntaxe,$str)) $tmp = true;
		else $tmp = false;
		
		// Return.
		return $tmp;
	}
	
	/*
	 * Function btc(). 0.5
	 * @param. String btc.
	 * @return boolean TRUE or FALSE. 
	 */
	public static function btc($str='')
	{
		$tmp = false;
		// decodeToBase58 Input Address
		$decodedAddress = util::base58_decode($str);
		// encodeToHexFormat Decoded Address
		$hexEncodedAddress = util::encodeHex($decodedAddress);
		// appendHexZeros Hex Encoded Check
		$hexEncodedAddress = util::appendHexZeros($str, $hexEncodedAddress);
		
		//Remove last 8 characters from Hexencoded string
		$encodedAddress = substr($hexEncodedAddress, 0, strlen($hexEncodedAddress) - 8);
		//Convert to binary
		$binaryAddress = pack("H*" , $encodedAddress);
		//Hash(Hash(Value))
		$hashedAddress = strtoupper(hash("sha256", hash("sha256", $binaryAddress, true)));
		
		//Return the beginning checksum of the address
		$checkSumAddress = substr($hashedAddress, 0 ,8);
		$ValidCheckSum = substr($hexEncodedAddress, -8);
		
		// Control.
		if($checkSumAddress == $ValidCheckSum) $tmp = true;
		else $tmp = false;
		
		// Return.
		return $tmp;
	}
}
?>