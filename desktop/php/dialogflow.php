<?php
if (!isConnect('admin')) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
$plugin = plugin::byId('dialogflow');
?>
<br/>
<div class="alert alert-info">{{Ce plugin ne necessite aucune configuration}}</div>
<?php include_file('desktop', 'dialogflow', 'js', 'dialogflow');?>
