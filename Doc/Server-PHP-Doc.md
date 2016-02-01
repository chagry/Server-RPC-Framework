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
|**SERV_ERROR_NOT_FIND_FILE**|Error loading the execution file.|Erreur lors du chargement du fichier d'exécution.|
|**SERV_ERROR_DATABASE**|Cannot connect to the SQL database. Error in the data.|Impossible de se connecter à la base SQL. Erreur dans les données.|
|**SERV_ERROR_INVALID_PARAM_OR_METHODE**|Incorrect methods or settings. Error in the access data.|Méthodes ou Paramètres incorrects. Erreur dans les données d'accès.|
|**SERV_ERROR_CONNECT_MYSQL**|MySQL server connection impossible. Error in the access data.|Connexion au serveur MySQL impossible. Erreur dans les données d'accès.|
|**SERV_ERROR_OFFLINE_MESSAGE**|The application is currently down for maintenance. Sorry for the inconvenience.|L'application est actuellement indisponible pour cause de maintenance. Désolé pour le désagrément.|

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
|**filtre($e)**|$e = string for filter|string filtered - strip_tags, rtrim, ltrim|
|**rands($e)**|$e = int length number you want|random number with length = param|
|**base58_decode($e)**|$e = string base 58|string decoded|
|**base58_encode($e)**|$e = string for encoding|string base 58|
|**encodeHex($e)**|$e = string for encoding|string encode Hex|
|**toBTC($e)**|$e = Satoshi value (int)|Return it as a string formatted with 8 decimals|
|**toSatoshi($e)**|$e = BTC value (float)|Return Satoshi value (int)|

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

# Configuration

[![Chagry Framework](http://img.youtube.com/vi/SJ4HTEo7uL4/0.jpg)](http://www.youtube.com/watch?v=SJ4HTEo7uL4)

***

# Base de données

[![Chagry Framework](http://img.youtube.com/vi/q6LKKZLx45c/0.jpg)](http://www.youtube.com/watch?v=q6LKKZLx45c)

*sql file*

```sql
--
-- Structure de la table `dem_greet`
--
CREATE TABLE IF NOT EXISTS `dem_greet` (
  `lang` varchar(2) NOT NULL DEFAULT 'en',
  `mess` varchar(155) NOT NULL,
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `dem_greet`
--
INSERT INTO `dem_greet` (`lang`, `mess`) VALUES
('en', 'Hello'),
('fr', 'Bonjour'),
('de', 'Hallo'),
('ru', 'Здравствуйте');
```

*Example file* `model/dbs.php`

```php
/**
 * @version 0.6.0
 * @license MIT license
 * @link    https://chagry.com
 * @author  Grigori <git@chagry.com>
 * @package model_dbs.php
 */

defined('CHAG') or die('Acces interdit');

class dbs {
	
	/**
	 * Function getGreet.
	 * @param   array $e code langue "en".
	 * @return  array greet db
	 * @access  public
	 * @static
	 */
	public static function getGreet($e) {
	
		try {
		
			// query SQL.
			$req = db::go('SELECT * FROM dem_greet WHERE lang=:lang');
			
			// Execute query.
			$req->execute($e);
			
			// data db.
			$dataTmp = $req->fetch();
    	
    		// close query SQL.
			$req->closeCursor();
			
			// return result.
			return $dataTmp;
		}
	
		catch(Exception $e) { throw new Exception('SERV-ERROR-DATABASE'); }
	}
}
```

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
	 * @param   string $l the code langue.
	 * @return  string Message "hello $e"
	 * @access  public
	 * @static
	 */
	public static function greetings($e='', $l='') {
		
		// Valide var or send error.
		if(!valide::alpha($e)) throw new Exception('GREET-VAR-NOT-VALIDE');
		if(!valide::alpha($l)) throw new Exception('LANG-VAR-NOT-VALIDE');
		
		// query.
		$tmpGreet = dbs::getGreet(array('lang' => $l));
		
		// Valide return db rep.
		if(empty($tmpGreet)) throw new Exception('NOT-LANG-IN-DB');
		
		// @var array return.
		$tmp=Array();
		
		// Add var greet in array.
		$tmp['greet'] = $tmpGreet['mess'].' '.util::filtre($e);
		$tmp['lang'] = $tmpGreet['lang'];
		
		// Return array.
		return $tmp;
	}
}
```

**call**

```php
// call.
$call->demo_greetings('Daenerys Targaryen', 'ru');
```

**Server Return**

```json
(
    [greet] => Здравствуйте Daenerys Targaryen
    [lang] => ru
)
```

***

# Contribution

You can also help us translating the documentation in other languages.