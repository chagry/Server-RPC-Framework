<?php
/*
 * @version		0.5
 * @date Crea	26/04/2013.
 * @date Modif	11/04/2014.
 * @package		tmpl_html.php
 * @contact		Chagry.com - git@chagry.com
 */

defined('CHAG') or die('Acces interdit');

class html {
	
	public static function startTmpl() {
		
		// header.
		$tmp='<!DOCTYPE html>';
		$tmp.='<html>';
		$tmp.='<head>';
			$tmp.='<link rel="shortcut icon" href="public/img/favicon.png" />';
			$tmp.='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
			$tmp.='<meta http-equiv="Pragma" content="no-cache">';
			$tmp.='<link rel="stylesheet" href="public/css/defaut.css" type="text/css" />';
			$tmp.='<title>Chagry RPC Sys</title>';
		$tmp.='</head>';
		$tmp.='<body>';
		
			$tmp.='<img src="public/img/logo.png">';
			
		$tmp.='</body>';
		$tmp.='</html>';
		
		// print.
		print($tmp);
	}
}
?>