<?php
if (!isConnect('admin')) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
$plugin = plugin::byId('dialogflow');
?>
<br/>
<div class="alert alert-info">{{Vous n'avez aucun équipement à créer pour ce plugin.}} <br/>
	{{Vous devez juste dans google assisant <strong>lancer Jeedom</strong> (en tapant Jeedom). Puis taper <strong>"configuration"</strong>, il vous demandera :}}<br/>
	- <strong>{{URL}}</strong> : <?php echo network::getNetworkAccess('external') ?><br/>
	- <strong>{{APIKEY}}</strong> :  <?php echo jeedom::getApiKey('dialogflow') ?><br/>
</div>
