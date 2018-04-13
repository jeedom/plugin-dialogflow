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

require_once dirname(__FILE__) . "/../../../../core/php/core.inc.php";
if (init('apikey') != '') {
	if (!jeedom::apiAccess(init('apikey'), 'dialogflow')) {
		echo __('Vous n\'etes pas autorisé à effectuer cette action. Clef API invalide. Merci de corriger la clef API sur votre page profils du market et d\'attendre 24h avant de réessayer.', __FILE__);
		die();
	} else {
		echo __('Configuration OK', __FILE__);
		die();
	}
}
header('Content-type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['lang']) && method_exists('translate', 'setLanguage') && str_replace('_', '-', strtolower(translate::getLanguage())) != $data['lang']) {
	if (strpos($data['lang'], 'en-') !== false) {
		translate::setLanguage('en_US');
	} elseif (strpos($data['lang'], 'fr-') !== false) {
		translate::setLanguage('fr_FR');
	}
}

if (!isset($data['apikey']) || !jeedom::apiAccess($data['apikey'], 'dialogflow')) {
	echo json_encode(array(
		'reply' => __('Vous n\'etes pas autorisé à effectuer cette action. Clef API invalide. Merci de corriger la clef API sur votre page profils du market et d\'attendre 24h avant de réessayer.', __FILE__),
	));
	die();
}
log::add('dialogflow', 'debug', 'Data : ' . json_encode($data));
$plugin = plugin::byId('dialogflow');
if (!$plugin->isActive()) {
	echo json_encode(array(
		'reply' => __('Plugin inactif', __FILE__),
	));
	die();
}
if (config::byKey('enableSecureMode', 'dialogflow', 0) == 1) {
	$registers = config::byKey('registers', 'dialogflow');
	if (!isset($registers[$data['hash']])) {
		$registers[$data['hash']] = array('date' => date('Y-m-d H:i:s'), 'accept' => 0);
		config::save('registers', $registers, 'dialogflow');
		echo json_encode(array(
			'reply' => __('Merci d\'aller sur la page du plugin dialogflow et d\'accepter le compte', __FILE__),
		));
		log::add('dialogflow', 'alert', __('Un nouvelle équipement dialogflow est en attente de validation. Veuillez aller sur la page du plugin et l\'accepter (ou pas).', __FILE__));
		die();
	} else if ($registers[$data['hash']]['accept'] != 1) {
		echo json_encode(array(
			'reply' => __('Compte non accepté. Merci d\'aller sur la page du plugin dialogflow et d\'accepter le compte', __FILE__),
		));
		die();
	}
}
if (trim($data['request']) == 'register') {
	echo json_encode(array(
		'reply' => 'ok',
	));
	die();
}
$params = array('plugin' => 'dialogflow', 'reply_cmd' => null);
echo json_encode(interactQuery::tryToReply(trim($data['request']), $params));
die();
