<?php
/*
 * @version		0.4
 * @date Crea	26/04/2013.
 * @date Modif	23/11/2013.
 * @package		tmpl_mail.php
 * @contact		Chagry.fr - git@chagry.fr
 */

defined('CHAG') or die('Acces interdit');

class tmplMail {
	
	public static function start($e) {
		
		// add header.
		$tmp='<!DOCTYPE html>';
		$tmp.='<html>';
		$tmp.='<head>';
			$tmp.='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
			$tmp.='<meta http-equiv="Pragma" content="no-cache">';
			$tmp.='<link rel="stylesheet" href="'.config::sys('media').'css/bootstrap-email.min.css" type="text/css" />';
		$tmp.='</head>';
		$tmp.='<body>';
		
		$tmp.='<div class="container-fluid">';
			$tmp.='<div class="row-fluid">';
				$tmp.='<div class="span12">';
					
					$tmp.='<div class="row-fluid">';
						$tmp.='<div class="span6">';
							$tmp.='<p class="muted">Number command : '.$e['num'].'</p>';
							$tmp.='<small>'.$e['date'].'</small>';
						$tmp.='</div>';
						$tmp.='<div class="span6">';
							$tmp.='<p class="lead pull-right">Chagry sys mail</p>';
						$tmp.='</div>';
					$tmp.='</div>';
					
					$tmp.='<p class="lead muted">'.$e['sujet'].'<small class="pull-right">Delivery address - '.$e['add'].'</small></p>';
					$tmp.='<div class="well well-large">';
						$tmp.='<p class="lead">'.$e['code'].'</p>';
					$tmp.='</div>';
					
					$tmp.='<p class="muted pull-right">Chagry PHP & jQuery Framework for JSON RPC 2</p>';
					
				$tmp.='</div>';
			$tmp.='</div>';
		$tmp.='</div>';
			
		// Fin page.
		$tmp.='</body>';
		$tmp.='</html>';
		
		// Return template.
		return $tmp;
	}
}
?>