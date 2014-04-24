<?php
/**
 * @version 0.5.0
 * @license MIT license
 * @link    https://chagry.com
 * @author  Grigori <git@chagry.com>
 * @package index.php
 */

define('CHAG', 1);
define('PATH', dirname(__FILE__));
define('SL', DIRECTORY_SEPARATOR);

/*
 * Error reporting: add comment from testing Environment.
 */
error_reporting(0);

/*
 * Import lib.
 */
require_once PATH.SL.'lib'.SL.'crp.php';
require_once PATH.SL.'lib'.SL.'load.php';
require_once PATH.SL.'lib'.SL.'util.php';
require_once PATH.SL.'lib'.SL.'valide.php';
require_once PATH.SL.'lib'.SL.'jsonRPC2Client.php';
require_once PATH.SL.'lib'.SL.'jsonRPC1Client.php';
require_once PATH.SL.'sys'.SL.'app.php';
require_once PATH.SL.'sys'.SL.'db.php';
require_once PATH.SL.'sys'.SL.'session.php';
require_once PATH.SL.'sys'.SL.'user.php';
require_once PATH.SL.'sys'.SL.'acl.php';
require_once PATH.SL.'sys'.SL.'email.php';
require_once PATH.SL.'sys'.SL.'archive.php';
require_once PATH.SL.'sys'.SL.'config.php';
require_once PATH.SL.'model'.SL.'dbSys.php';
require_once PATH.SL.'configuration'.SL.'params.php';
require_once PATH.SL.'configuration'.SL.'access.php';

// Start api.
app::start();

?>