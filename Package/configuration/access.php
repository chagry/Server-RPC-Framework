<?php
/*
 * @version		0.5
 * @date Crea	06/05/2013.
 * @date Modif	12/02/2014.
 * @package		configuration_access.php
 * @contact		Chagry.com - git@chagry.com
 */

defined('CHAG') or die('Acces interdit');

class access {

	public static function start() {
	
		/*
		 * acl -> addRole.
		 * @var $Role.  
		 */
		acl::addRole('guest');
		acl::addRole('membre');
		//--> Enter your role. acl::addRole('admin');
		
		/*
		 * acl  -> addRegle fot controleur.
		 * @var $controleur.
		 * @var $action.
		 * @var $Role.
		 */
		acl::addRegle('login', 'identification', 'guest');
		acl::addRegle('login', 'forgotCodePin', 'guest');
		acl::addRegle('login', 'inscription', 'guest');
		acl::addRegle('login', 'connexion', 'guest');
		acl::addRegle('login', 'editMail', 'membre');
		acl::addRegle('login', 'historique', 'membre');
	}
}
?>