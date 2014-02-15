<?php
/*
 * @version		0.5
 * @date Crea	06/05/2013.
 * @date Modif	12/02/2014.
 * @package		configuration_params.php
 * @contact		Chagry.com - git@chagry.com
 */

defined('CHAG') or die('Acces interdit');

class params {
	
	public static function start() {
	
		/*
		 * sys.
		 */
		config::addParams('sys', 'off', 1);
		config::addParams('sys', 'lang', 'en,fr');
		config::addParams('sys', 'path', 'http://domain.com/doc/');
		config::addParams('sys', 'media', 'http://domaine.com/doc/public/');
		config::addParams('sys', 'support', 'mail@domain.com');
		config::addParams('sys', 'tmpSession', 1800);
		
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
		config::addParams('mail', 'smtpAct', '');
		config::addParams('mail', 'host', '');
		config::addParams('mail', 'SmtpAuth', false);
		config::addParams('mail', 'Username', '');
		config::addParams('mail', 'Password', '');
		
		/*
		 * server.
		 */
		config::addParams('server', 'usagent', util::filtre($_SERVER['HTTP_USER_AGENT']));
		config::addParams('server', 'usip', util::filtre($_SERVER['REMOTE_ADDR']));
		config::addParams('server', 'serlang', util::filtre($_SERVER['HTTP_ACCEPT_LANGUAGE']));
	}
}
?>