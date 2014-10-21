var oTable;
var modulo = $('.tablafea').attr('id');

function cerrar(){
	$.fancybox.close();
	oTable.fnReloadAjax();
}

function recarga(){
	oTable.fnReloadAjax();
}

$(document).ready(function() {
	var modulo = $('.tablafea').attr('id');
	oTable = $('#tabla_data').dataTable({
		"bJQueryUI": true,
		"bProcessing": true,
		"aaSorting": [[ 0, "desc" ]],
		"sPaginationType": "full_numbers",
		"aoColumnDefs": [{ "bSearchable": false, "bVisible": false, "aTargets": [ 0 ] }],
		"oLanguage": {
			"sUrl": "js/dataTables.spanish.txt"
		},
		"sAjaxSource": "modulos/" + modulo + "/data.php"
	});
	$(".nuevo").live("click", function(){
		jQuery.fancybox({
			'overlayShow'		: true,
			'hideOnOverlayClick': false,
			'transitionIn'		: 'elastic',
			'transitionOut'		: 'elastic',
			'width'				: 720,
			'height'			: 500,
			'autoScale'			: false,
			'type'				: 'iframe',
        	'href'         	 	: $(this).attr('href')
		});
		return false;
	});
	
	$(".borrar").live("click", function(){
		var brr = $(this).attr('rel'), id = $(this).attr('href'), dir = $(this).attr('rel2');
		$("#confirm_borrar").dialog({
			resizable: false,
			height:140,
			modal: true,
			buttons: {
				'Cancelar': function() {
					$(this).dialog('close');
				},
				'Eliminar': function() {
					$(this).dialog('close');
					$.ajax({
						type: "POST",
						url: dir,
						data: "action=borrar&id=" + id,
						success: function(msg){
							document.location.reload();
						}
					});
				}
			}
		});
		return false;
	});
	$("#cambiar_clave").click(function(){
		$("#cambiar_password").dialog({
			resizable: false,
			modal: true,
			buttons: {
				'Cancelar': function() {
					$(this).dialog('close');
				},
				'Cambiar': function() {
					if($('#cambio_clave').val() == $('#cambio_clave1').val()){
						$(this).dialog('close');
						$.ajax({
							type: "POST",
							url: "modulos/usuarios/index.php",
							data: "action=cambiar&pass=" + $('#cambio_clave').val()
						});
						$('#cambio_clave').val('');
						$('#cambio_clave1').val('');
					}else{
						alert("Las claves deben ser iguales");
					}
				}
			}
		});
		return false;
	});
});
