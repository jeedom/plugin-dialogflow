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

require_once dirname(__FILE__) . '/../../../core/php/core.inc.php';
include_file('core', 'authentification', 'php');
if (!isConnect()) {
	include_file('desktop', '404', 'php');
	die();
}
?>
<form class="form-horizontal">
	<fieldset>
		<?php
		if(strpos(network::getNetworkAccess('external'),'https://') == -1){
			echo '<div class="alert alert-danger">{{Attention votre connexion externe ne semble pas etre en https, ce plugin nécessite ABSOLUMENT une connexion https. Si vous ne savez pas comment faire vous pouvez souscrire à un service pack power pour utiliser le service de DNS Jeedom}}</div>';
		}
		?>
		<div class="form-group">
			<?php
			try {
				$info =	dialogflow::voiceAssistantInfo();
				echo '<label class="col-lg-3 control-label">{{Abonnement aux service assistants vocaux}}</label>';
				echo '<div class="col-lg-9">';
				if(isset($info['limit']) && $info['limit'] != -1 && $info['limit'] != ''){
					echo '<div>{{Votre abonnement aux services assistants vocaux finit le }}'.$info['limit'].'.';
					echo ' {{Pour le prolonger, allez}} <a href="https://www.jeedom.com/market/index.php?v=d&p=profils#services" target="_blank">{{ici}}</a>';
				}else if($info['limit'] == -1){
					echo '<div>{{Votre abonnement aux services assistants vocaux est illimité.}}';
				}else{
					echo '<div class="alert alert-warning">{{Votre abonnement aux services assistants vocaux est finit.}}';
					echo ' {{Pour vous réabonner, allez}} <a href="https://www.jeedom.com/market/index.php?v=d&p=profils#services" target="_blank">{{ici}}</a>';
				}
				echo '</div>';
				echo '</div>';
			} catch (\Exception $e) {
				echo '<div class="alert alert-danger">'.$e->getMessage().'</div>';
			}
			?>
		</div>
		<div class="form-group">
			<label class="col-lg-3 control-label">{{Envoyer configuration au market}}</label>
			<div class="col-lg-2">
				<a class="btn btn-default" id="bt_sendConfigToMarket"><i class="fa fa-paper-plane" aria-hidden="true"></i> {{Envoyer}}</a>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">{{Activer la rotation de la clef api}}</label>
			<div class="col-sm-2">
				<input type="checkbox" class="configKey" data-l1key="enableApikeyRotate" />
			</div>
		</div>
	</fieldset>
</form>

<script>
$('#bt_sendConfigToMarket').on('click', function () {
	$.ajax({
		type: "POST",
		url: "plugins/dialogflow/core/ajax/dialogflow.ajax.php",
		data: {
			action: "sendConfig",
		},
		dataType: 'json',
		error: function (request, status, error) {
			handleAjaxError(request, status, error);
		},
		success: function (data) { // si l'appel a bien fonctionné
			if (data.state != 'ok') {
				$('#div_alert').showAlert({message: data.result, level: 'danger'});
				return;
			}
			$('#div_alert').showAlert({message: '{{Configuration envoyée avec succès}}', level: 'success'});
		}
	});
});
</script>
