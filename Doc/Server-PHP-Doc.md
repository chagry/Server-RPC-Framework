![logo](http://chagry.com/img/css/logo-menu.png)

***

# Doc Server PHP
Documentation for Server PHP framework.

* Creating custom API with JSON RPC 2 protocol.
* Ask your API with a simple query json RPC.
* Retrieve and process the JSON string characters.

***

# Introduction

[![Chagry Framework](http://img.youtube.com/vi/4ZF-uqE7JCg/0.jpg)](http://www.youtube.com/watch?v=4ZF-uqE7JCg)

***

# Installation

[![Chagry Framework](http://img.youtube.com/vi/QuZG4Lp1Y5k/0.jpg)](http://www.youtube.com/watch?v=QuZG4Lp1Y5k)

***

# First controller

[![Chagry Framework](http://img.youtube.com/vi/JFlsXa_gycg/0.jpg)](http://www.youtube.com/watch?v=JFlsXa_gycg)

*Example file* `controleur/demo.php`

```php
/**
 * @version 0.6.0
 * @license MIT license
 * @link    http://chagry.com
 * @author  Grigori <git@chagry.com>
 * @package controleur_demo.php
 */

defined('CHAG') or die('Acces interdit');

class demo {
	
	/**
	 * Function greetings first function for demo class.
	 * @param   string $e the name of client.
	 * @return  string Message "hello $e"
	 * @access  public
	 * @static
	 */
	public static function greetings($e='') {
		
		// @var array return.
		$tmp=Array();
		
		// Add var greet in array.
		$tmp['greet']='Hello '.$e;
		
		// Return array.
		return $tmp;
	}
}
```

*Error framework*

| Code Error | EN | FR |
|----------|--------|--------|
|**SERV-ERROR-NOT-FIND-FILE**|Error loading the execution file.|Erreur lors du chargement du fichier d'exécution.|
|**SERV-ERROR-DATABASE**|Cannot connect to the SQL database. Error in the data.|Impossible de se connecter à la base SQL. Erreur dans les données.|
|**SERV-ERROR-INVALID-PARAM-OR-METHODE**|Incorrect methods or settings. Error in the access data.|Méthodes ou Paramètres incorrects. Erreur dans les données d'accès.|
|**SERV-ERROR-CONNECT-MYSQL**|MySQL server connection impossible. Error in the access data.|Connexion au serveur MySQL impossible. Erreur dans les données d'accès.|
|**SERV-ERROR-OFFLINE-MESSAGE**|The application is currently down for maintenance. Sorry for the inconvenience.|L'application est actuellement indisponible pour cause de maintenance. Désolé pour le désagrément.|

*Example file* `Example/index.php`

```php
// Init call API.
$call = new jsonRPC2Client("http://domain.com/api/");

// call.
$call->demo_greetings('Daenerys Targaryen');
```

**Server Return**

```json
(
    [greet] => Hello Daenerys Targaryen
)
```

***

# Class Util

[![Chagry Framework](http://img.youtube.com/vi/cesfI9G3XXk/0.jpg)](http://www.youtube.com/watch?v=cesfI9G3XXk)

*Example use*

```php
$tmp = util::rands(6);

// $tmp = 375397
```

| Function | Params | Return |
|----------|--------|--------|
|**filtre()**|string for filter|string filtered - strip_tags, rtrim, ltrim|
|**rands()**|int length number you want|random number with length = param|
|**base58_decode()**|string base 58|string decoded|
|**base58_encode()**|string for encoding|string base 58|
|**encodeHex()**|string for encoding|string encode Hex|
|**toBTC()**|Satoshi value (int)|Return it as a string formatted with 8 decimals|
|**toSatoshi()**|BTC value (float)|Return Satoshi value (int)|

***

# Class Valide

[![Chagry Framework](http://img.youtube.com/vi/7HFhwi7ZO1s/0.jpg)](http://www.youtube.com/watch?v=7HFhwi7ZO1s)

*Example use*

```php
$tmp = valide::email('dde@sfrti');
// $tmp = false

if(!valide::alpha('sdfjh23423zefze')) throw new Exception('VAR-MESSAGE-ERROR');
// Send error.
```
| Function | Params |
|----------|--------|
|**email($e)**|$e = mail|
|**strMd5($e)**|$e = string md5|
|**strSha1($e)**|$e = string sha1|
|**url($e)**|$e = string url|
|**domain($e)**|$e = string domain|
|**ip($e)**|$e = string ip|
|**floats($e)**|$e = float|
|**ints($e)**|$e = int|
|**alpha($e)**|$e = string|
|**alpha_numeric($e)**|$e = string|
|**txt($e)**|$e = string|
|**numeric($e)**|$e = int|
|**btc($e)**|$e = string address bitcoin|
|**btc_key($e)**|$e = string key bitcoin|
|**btc_sign($e, $m, $s)**|$e = address bitcoin, $m = message, $s = sign|

*Example file* `controleur/demo.php`

```php
/**
 * @version 0.6.0
 * @license MIT license
 * @link    http://chagry.com
 * @author  Grigori <git@chagry.com>
 * @package controleur_demo.php
 */

defined('CHAG') or die('Acces interdit');

class demo {
	
	/**
	 * Function greetings first function for demo class.
	 * @param   string $e the name of client.
	 * @return  string Message "hello $e"
	 * @access  public
	 * @static
	 */
	public static function greetings($e='') {
		
		// Valide var or send error.
		if(!valide::alpha($e)) throw new Exception('GREET-VAR-NOT-VALIDE');
		
		// @var array return.
		$tmp=Array();
		
		// Add var greet in array.
		$tmp['greet']='Hello '.$e;
		
		// Return array.
		return $tmp;
	}
}
```

***

# Contribution

You can also help us translating the documentation in other languages.