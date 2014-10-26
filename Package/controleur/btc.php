<?php
/**
 * @version 0.5.0
 * @license MIT license
 * @link    https://chagry.com
 * @author  Grigori <git@chagry.com>
 * @package controleur_btc.php
 */

defined('CHAG') or die('Acces interdit');

class btc {
	
	/**
	 * Function infos info of blockChain.
	 * @return	 array "btc blockChain info"
	 * @access	 public
	 * @static
	 */
	public static function infos() {
		
		// Upload btc price blockChain.
		$pr = file_get_contents('https://blockchain.info/ticker');
		$cr = file_get_contents('https://blockchain.info/charts/market-price?timespan=1year&format=json');
		
		// If valide infos.
		if($pr) {
			
			// @var array return.
			$tmp=Array();
			
			// Add price for return.
			$tmp['prices']=json_decode($pr,true);
			$tmp['history']=json_decode($cr,true);
			
			// Return array.
			return $tmp;
		}
					
		// else not btc.
		else throw new Exception('BTC-ERR-SERVER-UNAVAILABLE');
	}
	
	/**
	 * Function news blockChain info price.
	 * @return	 array btc + value.
	 * @access	 public
	 * @static
	 */
	public static function news() {
		
		// Upload btc price blockChain.
		$pr = file_get_contents('https://blockchain.info/ticker');
		
		// If valide infos.
		if($pr) {
			
			// @var array return.
			$tmp=Array();
			
			// Add price for return.
			$tmp=json_decode($pr,true);
			
			// Return array.
			return $tmp;
		}
					
		// else not btc.
		else throw new Exception('BTC-ERR-SERVER-UNAVAILABLE');
	}
	
	/**
	 * Function address blockChain info address.
	 * @param	 string $e the address btc.
	 * @return	 array btc + value.
	 * @access	 public
	 * @static
	 */
	public static function address($e='') {
		
		$adr = util::filtre($e);
		
		// If valide btc adresse.
		if(valide::btc($adr)) {
			
			// Upload btc price blockChain.
			$pr = file_get_contents('https://blockchain.info/rawaddr/'.$adr);
			
			// If valide infos.
			if($pr) {
				
				// @var array return.
				$tmp=Array();
				
				// Add price for return.
				$tmpReq=json_decode($pr,true);
				
				// Info adr btc.
				$tmp['hash160']=$tmpReq['hash160'];
				$tmp['address']=$tmpReq['address'];
				$tmp['n_tx']=$tmpReq['n_tx'];
				$tmp['total_received']=$tmpReq['total_received'];
				$tmp['total_sent']=$tmpReq['total_sent'];
				$tmp['final_balance']=$tmpReq['final_balance'];
				
				// Each tx blockchain.
				foreach ($tmpReq['txs'] as $k => $v) {
					
					// Var compta.
					$som = 0;
					$type = 0;
					$out = 0;
					$in = 0;
					
					// Each inputs (out)
					foreach ($v['inputs'] as $k1 => $v1) {
						
						// If key existe. Increment le nombre.
						if($v1['prev_out']['addr'] == $adr) $out = $v1['prev_out']['value'];
					}
					
					// Each out (in)
					foreach ($v['out'] as $k2 => $v2) {
						
						// If key existe. Increment le nombre.
						if($v2['addr'] == $adr) $in = $v2['value'];
					}
					
					// If in or out.
					if($in >= $out) {
						
						// Somme tx.
						$som = $in-$out;
						$type = 1;
					}
					
					// else tx out.
					else $som = $out-$in;
					
					// Var historique.
					$tmp['txs'][]=Array(
						'time' => $v['time'],
						'block_height' => $v['block_height'],
						'tx_index' => $v['tx_index'],
						'hash' => $v['hash'],
						'relayed_by' => $v['relayed_by'],
						'result' => $v['result'],
						'ver' => $v['ver'],
						'vin_sz' => $v['vin_sz'],
						'vout_sz' => $v['vout_sz'],
						'som' => $som,
						'type' => $type,
						'size' => $v['size']
					);
					
					// If key existe. Increment le nombre.
					if(array_key_exists($value['action'], $tmp['chart'])) $tmp['chart'][$value['action']]++;
					
					// Else add action in array.
					else $tmp['chart'][$value['action']]=1;
				}
				
				// Return array.
				return $tmp;
			}
			
			// else not btc.
			else throw new Exception('BTC-ERR-SERVER-UNAVAILABLE');
		}
					
		// else not btc.
		else throw new Exception('BTC-ERR-SERVER-UNAVAILABLE');
	}
}
?>