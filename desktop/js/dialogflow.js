
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

 $('.bt_refuse').on('click',function(){
 	var key = $(this).closest('tr').attr('data-key');
 	actionRegister(key,'refuse');
 });

 $('.bt_accept').on('click',function(){
 	var key = $(this).closest('tr').attr('data-key');
 	actionRegister(key,'accept');
 });

 $('#bt_getConfigurationCode').on('click',function(){
 	getConfigurationCode();
 });

 function actionRegister(_key,_mode){
 	$.ajax({
 		type: "POST",
 		url: "plugins/dialogflow/core/ajax/dialogflow.ajax.php", 
 		data: {
 			action: "actionRegister",
 			mode: _mode,
 			key:  _key,
 		},
 		dataType: 'json',
 		error: function (request, status, error) {
 			handleAjaxError(request, status, error);
 		},
 		success: function (data) {
 			if (data.state != 'ok') {
 				$('#div_alert').showAlert({message: data.result, level: 'danger'});
 				return;
 			}
 			window.location.reload();
 		}
 	});
 }

 function getConfigurationCode(){
 	$.ajax({
 		type: "POST",
 		url: "plugins/dialogflow/core/ajax/dialogflow.ajax.php", 
 		data: {
 			action: "getConfigurationCode",
 		},
 		dataType: 'json',
 		error: function (request, status, error) {
 			handleAjaxError(request, status, error);
 		},
 		success: function (data) {
 			if (data.state != 'ok') {
 				$('#div_alert').showAlert({message: data.result, level: 'danger'});
 				return;
 			}
 			bootbox.confirm('{{Veuillez dire ou taper "configuration" et donner le code suivant : }} <span style="font-weight: bold ;">' + data.result.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") + '</span>, celui-ci est valable 5min ?', function (result) {});
 		}
 	});
 }
