<script>
$(document).ready(function() {
	$(".cerrar-sesion").click(function(){
		$.ajax({
			type: "POST",
			url: "modulos/usuarios/index.php",
			data: "action=logout",
			success: function(msj){
				document.location.href = "../admin/";
			}
		});
	});
});
</script>
<div id="cambiar_password" title="Cambiar Clave" style="display:none;">
	<form>
    	<span style="float:left; margin-bottom:10px;">
		<label for="cambio_clave">Contrase&ntilde;a</label>
		<input type="password" name="cambio_clave" id="cambio_clave" value="" style="width:270px;" class="text ui-widget-content ui-corner-all" />
        </span>
        <span style="float:left; margin-bottom:10px;">
        <label for="cambio_clave1">Repetir contrase&ntilde;a</label>
		<input type="password" name="cambio_clave1" id="cambio_clave1" value="" style="width:270px;" class="text ui-widget-content ui-corner-all" />
        </span>
	</form>
</div>
<div class="cerrar-sesion" style="cursor:pointer;"><img src="images/cross.png" border="0" align="absmiddle" /> Cerrar Sesi&oacute;n</div>
  <div class="usuario"><strong>{nom_usu_sis}</strong><br />
    <a href="#" id="cambiar_clave">Cambiar contrase&ntilde;a</a></div>