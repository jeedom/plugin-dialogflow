<?php

/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

/* * ***************************Includes********************************* */
require_once dirname(__FILE__) . '/../../../../core/php/core.inc.php';

class dialogflow extends eqLogic {
	/*     * *************************Attributs****************************** */

	/*     * ***********************Methode static*************************** */
	
		
	public static function postConfig_enableApikeyRotate($_value){
		$cron = cron::byClassAndFunction('dialogflow', 'rotateApiKey');
		if($_value == 1){
			if(!is_object($cron)){
				$cron = new cron();
			}
			$cron->setClass('dialogflow');
			$cron->setFunction('rotateApiKey');
			$cron->setLastRun(date('Y-m-d H:i:s'));
			$cron->setSchedule(rand(0,59).' '.rand(0,23).' * * *');
			$cron->save();
		}else{
			if(is_object($cron)){
				$cron->remove();
			}
		}
	}
	
	public static function rotateApiKey($_option = array()){
		config::save('api', config::genKey(), 'dialogflow');
		self::sendJeedomConfig();
	}

	public static function sendJeedomConfig() {
		$market = repo_market::getJsonRpc();
		if (!$market->sendRequest('gsh::configDialogflow', array('gsh::dialogflow::apikey' => jeedom::getApiKey('dialogflow'), 'gsh::url' => network::getNetworkAccess('external')))) {
			throw new Exception($market->getError(), $market->getErrorCode());
		}
	}
	
	public static function voiceAssistantInfo() {
		$market = repo_market::getJsonRpc();
		if (!$market->sendRequest('voiceAssistant::info')) {
			throw new Exception($market->getError(), $market->getErrorCode());
		}
		return $market->getResult();
	}

	/*     * *********************Méthodes d'instance************************* */

	/*     * **********************Getteur Setteur*************************** */
}

class dialogflowCmd extends cmd {
	/*     * *************************Attributs****************************** */

	/*     * ***********************Methode static*************************** */

	/*     * *********************Methode d'instance************************* */

	public function execute($_options = array()) {

	}

	/*     * **********************Getteur Setteur*************************** */
}
