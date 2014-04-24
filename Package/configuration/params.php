<?php
/**
 * @version 0.5.0
 * @license MIT license
 * @link    https://chagry.com
 * @author  Grigori <git@chagry.com>
 * @package configuration_params.php
 */

defined('CHAG') or die('Acces interdit');

class params {
	
	public static function start() {
	
		/*
		 * sys.
		 */
		config::addParams('sys', 'off', 1);
		config::addParams('sys', 'lang', 'en,fr,de,ru');
		config::addParams('sys', 'path', 'http://domain.com/api/');
		config::addParams('sys', 'media', 'http://domaine.com/api/public/');
		config::addParams('sys', 'support', 'mail@domain.com');
		config::addParams('sys', 'tmpSession', 1800);
		config::addParams('sys', 'crossDomain', 0);
		
		/*
		 * db.
		 */
		config::addParams('db', 'host', 'mysql.domain.com');
		config::addParams('db', 'user', 'user');
		config::addParams('db', 'pass', 'pass');
		config::addParams('db', 'db', 'nameDb');
		
		/*
		 * mail.
		 */
		config::addParams('mail', 'from', 'no-reply@domain.com');
		config::addParams('mail', 'fromName', 'Name expidit');
		config::addParams('mail', 'pluginDir', 'lib/');
		//config::addParams('mail', 'smtpAct', '');
		//config::addParams('mail', 'host', '');
		//config::addParams('mail', 'SmtpAuth', false);
		//config::addParams('mail', 'Username', '');
		//config::addParams('mail', 'Password', '');
		
		/*
		 * server.
		 */
		config::addParams('server', 'usagent', util::filtre($_SERVER['HTTP_USER_AGENT']));
		config::addParams('server', 'usip', util::filtre($_SERVER['REMOTE_ADDR']));
		config::addParams('server', 'serlang', util::filtre($_SERVER['HTTP_ACCEPT_LANGUAGE']));
	}
}
?>