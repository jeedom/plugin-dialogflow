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
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['apikey']) || !jeedom::apiAccess($data['apikey'], 'dialogflow')) {
	echo json_encode(array(
		'reply' => __('Vous n\'etes pas autorisé à effectuer cette action', __FILE__),
	));
	die();
}
log::add('dialogoflow', 'debug', 'Data : ' . json_encode($data));
if (!netMatch('107.178.232.*', getClientIp()) && !netMatch('107.178.237.*', getClientIp()) && !netMatch('107.178.238.*', getClientIp())) {
	echo json_encode(array(
		'reply' => __('IP client non autorisée : ', __FILE__) . getClientIp(),
	));
	die();
}
$plugin = plugin::byId('dialogflow');
if (!$plugin->isActive()) {
	echo json_encode(array(
		'reply' => __('Plugin inactif', __FILE__),
	));
	die();
}
header('Content-type: application/json');
$params = array('plugin' => 'dialogflow', 'reply_cmd' => null);
echo json_encode(interactQuery::tryToReply(trim($data['request']), $params));
die();