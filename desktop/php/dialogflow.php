<?php
if (!isConnect('admin')) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
$plugin = plugin::byId('dialogflow');
?>
<br/>
<?php if (config::byKey('enableSecureMode', 'dialogflow', 0) == 0) {
	echo '<div class="alert alert-info">{{Vous n\'etes pas en mode sécurisé, vous n\'avez donc pas à gérer les connexions}}</div>';
} else {
	?>
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
			echo '<a class="btn btn-xs btn-warning bt_refuse"><i class="fa fa-times"></i> {{Refuser}}</a>';
		} else {
			echo '<a class="btn btn-xs btn-success bt_accept"><i class="fa fa-check"></i> {{Accepter}}</a>';
		}
		echo ' <a class="btn btn-xs btn-danger bt_remove"><i class="fa fa-trash"></i> {{Supprimer}}</a>';
		echo '</td>';
		echo '</tr>';
	}
	?>
	</tbody>
</table>
<?php }?>

<?php include_file('desktop', 'dialogflow', 'js', 'dialogflow');?>
