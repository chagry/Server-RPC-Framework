<?php
/**
 * @version 0.6.0
 * @license MIT license
 * @link    http://chagry.com
 * @author  Grigori <git@chagry.com>
 * @package Example index.php
 */

// error_reporting(0);

/*
 * Import lib.
 */
require_once 'jsonRPC2Client.php';

// call API.
$call = new jsonRPC2Client("http://DOMAIN.COM/DOC/");

?>

<!DOCTYPE html>
<html lang="en">
	<body>
		<pre>
			<code>
				<?php print_r($call->COTROLEUR_FONCTION()); ?>
			</code>
		</pre>
	</body>
</html>