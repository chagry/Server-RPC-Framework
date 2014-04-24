<?php
/**
 * @version 0.5.0
 * @license MIT license
 * @link    https://chagry.com
 * @author  Grigori <git@chagry.com>
 * @package sys_app.php
 */

defined('CHAG') or die('Acces interdit');

class app
{
	/**
	 * Function start function server JSON RPC.
	 * @access  public
	 * @static
	 */ 
	public static function start() {
		
		// checks if a JSON-RCP request has been received.        
		if($_SERVER['REQUEST_METHOD']!='POST'||empty($_SERVER['CONTENT_TYPE'])||!preg_match('/application\/json/i',$_SERVER['CONTENT_TYPE'])) {
			
			// Load.
			load::auto('tmpl_html');
			// class html startTmpl.
			html::startTmpl();
		}
		
		// checks if a JSON-RCP request received.
		else {
			
			// reads the input data.
			$request =json_decode(file_get_contents('php://input'), true);
			
			// class Params start().
			params::start();
			
			// Gestion error.
			try {
				
				// Si app-maintenance.
				if(config::sys('off')!=1) {
					
					// Exception.
					throw new Exception('SERV-ERROR-OFFLINE-MESSAGE');
				}
				
				// method post.
				$reqConMethod = explode('_', $request['method']);
					
				// Controleur.
				$control=util::filtre($reqConMethod[0]);
					
				// Action.
				$action=util::filtre($reqConMethod[1]);
				
				// Session.
				$tmpSess=(!valide::strMd5($reqConMethod[2]))? '' : util::filtre($reqConMethod[2]);
				
				// Start session.
				session::start($tmpSess);
				
				// Start access.
				access::start();
				
				// Load.
				load::auto('controleur_'.$control);
				
				// Control access level.
				acl::isAllowed($control, $action);
				
				// forward_static_call_array.
				if ($result = @forward_static_call_array(array($control, $action), $request['params'])) {
				
					// Succes. Array.
					$response = array ('id' => $request['id'],
									'result' => $result,
									'jsonrpc' => $request['jsonrpc'],
									'error' => NULL);
				}
				
				// Exception.
				else throw new Exception('SERV-ERROR-INVALID-PARAM-OR-METHODE');
			}
			
			catch (Exception $e) {
			
				// JSON RPC Error. Array.
				$response = array ('id' => $request['id'],
								'result' => NULL,
								'jsonrpc' => $request['jsonrpc'],
								'error' => $e->getMessage());
			}
			
			// output the response.
			header('content-type: text/javascript');
			
			// If cross Domain true.
			if(config::sys('crossDomain')==1) header('Access-Control-Allow-Origin: *');
			
			// Print request.
			print json_encode($response);
		}
	}
}
?>