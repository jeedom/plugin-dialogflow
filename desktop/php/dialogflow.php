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

<legend>{{Compte dialogflow actif}}</legend>
<table class="table table-condensed table-bordered">
	<thead>
<tr>
	<th>
		{{Identifiant}}
	</th>
	<th>
		{{Date}}
	</th>
	<th>
		{{Action}}
	</th>
</tr>
	</thead>
	<tbody>
		<?php
$registers = config::byKey('registers', 'dialogflow');
foreach ($registers as $key => $register) {
	echo '<tr data-key="' . $key . '">';
	echo '<td>';
	echo $key;
	echo '</td>';
	echo '<td>';
	echo $register['date'];
	echo '</td>';
	echo '<td>';
	if ($register['accept'] == 1) {
		echo '<a class="btn btn-xs btn-danger bt_refuse"><i class="fa fa-time"></i> {{Refuser}}</a>';
	} else {
		echo '<a class="btn btn-xs btn-success bt_accept"><i class="fa fa-check"></i> {{Accepter}}</a>';
	}
	echo '</td>';
	echo '</tr>';
}
?>
	</tbody>
</table>

<?php include_file('desktop', 'dialogflow', 'js', 'dialogflow');?>
