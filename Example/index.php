<?php
/**
 * @version 0.5.0
 * @license MIT license
 * @link    https://chagry.com
 * @author  Grigori <git@chagry.com>
 * @package Example index.php
 */

define('PATH', dirname(__FILE__));
define('SL', DIRECTORY_SEPARATOR);
error_reporting(0);

/*
 * Import lib.
 */
require_once PATH.SL.'lib'.SL.'jsonRPC2Client.php';

// call API.
$call = new jsonRPC2Client("http://domain.com/api/");

?>

<!DOCTYPE html>
<html lang="en">
	<head>	
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
	</head>
	
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-left">
					<h1>Response</h1>
					<pre>
						<code>
							<?php print_r($call->demo_greetings('Daenerys', 'ru')); ?>
						</code>
					</pre>
				</div>
			</div>
		</div>
	</body>
</html>