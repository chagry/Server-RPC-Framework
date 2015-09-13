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

Follow the steps for installing the API on the server

**Required**

* Apache 2 +
* PHP Version 5.4 +
* MySQL 5.5 +

API integration testing with [Infomaniak](http://www.infomaniak.com/) hosting.

**Download**

1. Download the [Repository GitHub Server](https://github.com/chagry/Server-RPC-Framework)
2. Unzip files directly and copy the folder `Package` in your server.
3. Rename the folder `Package` to `api` in your server.

**Database**

1. Create a MySQL database on your hosting account.
2. In phpMyAdmin, select your database from the list on the left.
3. Click on "Import" from the top set of tabs.
4. Choose file in the folder `Sql` of Repository GitHub.
5. Import the file in your db.

This runs the SQL file and updates the database as specified in your SQL file.

**htaccess file**

`htaccess.txt` file is a directory-level configuration for Apache web server.

1. Rename htaccess.txt to .htaccess

If you're using https.

* Edit the block https in your htaccess file.
 
**params file**

Edit the settings API.

*Example file `configuration/params.php`*

```php
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
```

**index file optional**

* Error reporting: add comment from testing Environment.

*Example file `index.php` (Line 17)*

```php
// error_reporting(0);
```

***

# Utilize
Process for creating your first API.

1. Create your first Controller.
	* in the folder `controleur`, add new file `demo.php`
2. In this file, you create the class of controller.
3. In this class you add new public static function + one param $e string: the name of user.
4. In this function you add one array.
5. Now see, if $e is nonempty.
	* If empty, throw new error.
6. Add var greet in array.
7. Return var array.

*Example file `controleur/demo.php`*

```php
/**
 * @version 0.5.0
 * @license MIT license
 * @link    https://chagry.com
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
		
		// if empty name. Stop API.
		if(!$e) throw new Exception('DEMO-ERROR-USER-EMPTY');
		
		// Add var greet in array.
		$tmp['greet']='Hello '.$e;
		
		// Return array.
		return $tmp;
	}
}
```

Finally, edit the file `configuration/access.php`.

* Add this line to access.

*Example file `configuration/access.php`*

```php
acl::addRegle('demo', 'greetings', 'guest');
```

**API is ready to operate.**

Now that the API is ready, We want to test. For this see the folder `Example`

1. install file to an empty folder in your local server's web directory.
2. Edit this line.

*Example file `Example/index.php` (Line 20)*

```php
// call API.
$call = new jsonRPC2Client("http://domain.com/api/");
```

To call your new function, use the bottom line.

```php
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

# Database
Management model and database. For this example, we will use the controleur demo and the db.

* create a new table in your database or copy this code in sql from the top set of tabs.


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

Now that the table is ready. We'll start by creating your first model.

**Process for creating your first model.**

1. Create your first model.
	* in the folder `model`, add new file `dbMo.php`
2. In this file, you create the class of model.
3. In this class you add new public static function.
4. In this function you add your sql prepa.
5. Execute query.
7. Return var result.

*Example file `model/dbMo.php`*

```php
/**
 * @version 0.5.0
 * @license MIT license
 * @link    https://chagry.com
 * @author  Grigori <git@chagry.com>
 * @package model_dbMo.php
 */

defined('CHAG') or die('Acces interdit');

class dbMo {
	
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

Now that the model is ready. We'll editing your controller.

1. load class model in your Controller.
	*  `load::auto('model_dbMo')`
2. transform a array the list of language in config.
	* `explode(',', config::sys('lang'))`
3. checks whether the language is part of language used by the API.
	* if not, default langue 'en'.
5. Setup query.
	* `array('lang' => $tmpLang)`
6. query.
	* `dbMo::getGreet($req)`
7. Return var array.

*Example file `controleur/demo.php`*

```php
class demo {
	
	/**
	 * Function greetings first function for demo class.
	 * @param	 string $e the name of client.
	 * @param	 string $eL the code langue of client.
	 * @return	 string Message "hello $e"
	 * @access	 public
	 * @static
	 */
	public static function greetings($e='', $l='') {
		
		// if empty name. Stop API.
		if(!$e) throw new Exception('DEMO-ERROR-USER-EMPTY');
		
		// Class model dbMo.
		load::auto('model_dbMo');
		
		// Langue api.
		$apiLangue=explode(',', config::sys('lang'));
						
		// if langue valid.
		if(in_array($l, $apiLangue)) $tmpLang=$l;
		// Else langue default en.
		else $tmpLang='en';
		
		// Prepart query.
		$req=array('lang' => $tmpLang);
				
		// query.
		$tmpGreet=dbMo::getGreet($req);
		
		// @var array return.
		$tmp=Array();

		// Add var greet in array.
		$tmp['greet']=$tmpGreet['mess'].' '.util::filtre($e);
		$tmp['lang']=$tmpGreet['lang'];
		
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

# Class util
Provides additional features that you can use in your controller.

*Example use*

```php
$tmp = util::rands(6);

// $tmp = 375397
```

**Function**

| Function | Params | Return |
|----------|--------|--------|
|**filtre()**|string for filter|string filtered|
|**rands()**|int length number you want|random number with length = param|
|**base58_decode()**|string base 58|string decoded|
|**base58_encode()**|string for encoding|string base 58|
|**encodeHex()**|string for encoding|string encode Hex|

***

# Class valide
Provides additional features that you can use in your controller.

*Example use*

```php
$tmp = valide::email('dde@sfrti');

// $tmp = false
```

**Function**

| Function | Params | Return | Description |
|----------|--------|--------|-------------|
|**email()**|string|boolean TRUE/FALSE|Description|
|**strMd5()**|string|boolean TRUE/FALSE|Description|
|**strSha1()**|string|boolean TRUE/FALSE|Description|
|**url()**|string|boolean TRUE/FALSE|Description|
|**ip()**|string|boolean TRUE/FALSE|Description|
|**domain()**|string|boolean TRUE/FALSE|Description|
|**floats()**|numeric|boolean TRUE/FALSE|Description|
|**ints()**|int|boolean TRUE/FALSE|Description|
|**alpha()**|string|boolean TRUE/FALSE|Description|
|**alpha_numeric()**|string|boolean TRUE/FALSE|Description|
|**numeric()**|numeric|boolean TRUE/FALSE|Description|
|**btc()**|string|boolean TRUE/FALSE|Bitcoin adresse|

***

# To Follow. End 2016

***

# Contribution

You can also help us translating the documentation in other languages.