<?php
/**
 * @version 0.5.0
 * @license MIT license
 * @link    https://chagry.com
 * @author  Grigori <git@chagry.com>
 * @package configuration_access.php
 */

defined('CHAG') or die('Acces interdit');

class access {

	public static function start() {
	
		/*
		 * acl -> addRole.
		 * @param $Role.  
		 */
		acl::addRole('guest');
		acl::addRole('membre');
		//--> Enter your role. acl::addRole('admin');
		
		/*
		 * acl  -> addRegle fot controleur.
		 * @param $controleur.
		 * @param $action.
		 * @param $Role.
		 */
		acl::addRegle('login', 'identification', 'guest');
		acl::addRegle('login', 'forgotCodePin', 'guest');
		acl::addRegle('login', 'inscription', 'guest');
		acl::addRegle('login', 'connexion', 'guest');
		acl::addRegle('login', 'editMail', 'membre');
		acl::addRegle('login', 'historique', 'membre');
		
		acl::addRegle('btc', 'news', 'guest');
		acl::addRegle('btc', 'infos', 'guest');
		acl::addRegle('btc', 'address', 'guest');
		
		// Delete prod.
		acl::addRegle('demo', 'greetings', 'guest');
	}
}
?>