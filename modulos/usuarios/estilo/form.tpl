<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/jquery.js"></script>
<script language="javascript" src="js/validaciones.js"></script>
<script>
$(document).ready(function() {
	function val_cmp(valor){
		var nomcamp = valor.attr('name');
		if(valor.val() != ''){
			$("#obg_"+nomcamp).fadeOut('slown');
			return true;
		}else{
			$("#obg_"+nomcamp).html('Este campo es requerido');
			$("#obg_"+nomcamp).fadeIn('slown');
			return false;
		}
	}
	function valMail(campo) {
		var valor = campo.val(), nomcamp = campo.attr('name');
		if (/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i.test(valor)){
			var valido = true;
			$("#obg_"+nomcamp).fadeOut('slown');
		} else {
			var valido = false;
			$("#obg_"+nomcamp).html('Formato de correo invalido');
			$("#obg_"+nomcamp).fadeIn('slown');
		}
		
		return valido;
	}
	$("form").submit(function(){
		var nombre = $('#nombre'), login = $('#login'), correo = $('#correo'), clave = $('#clave'), clave1 = $('#clave1'), 
		valido = true;
		val_cmp(nombre); val_cmp(login); valMail(correo); 
		<!-- START BLOCK : val_clave -->
		val_cmp(clave); 
		valido = valido && val_cmp(clave);
		<!-- END BLOCK : val_clave -->
		valido = valido && val_cmp(nombre);
		valido = valido && val_cmp(login);
		valido = valido && valMail(correo);
		if(clave.val() != clave1.val()){
			$("#obg_clave1").html('Ambas claves deben ser iguales');
			$("#obg_clave1").fadeIn('slown');
			valido = false;
		}
		if(valido){
			return true;
		}else{
			return false;
		}
	});
});
<!-- START BLOCK : cerrar -->
	window.parent.cerrar();
<!-- END BLOCK : cerrar -->
</script>
</head>

<body>
<div class="popconglow">
  <p>
   	<span class="titulo">{new}</span>
    <span class="pop">{msj}.</span>
  </p>
  <form id="form1" name="form1" method="post" enctype="multipart/form-data">
  	<label>Nombre
	<span class="subtitulo">Ingresa el nombre del usuario</span>	</label>
	<input name="nombre" type="text" id="nombre" value="{nom_usu}" class="obligatorio" />
    <span class="avisopop" id="obg_nombre"></span>
    <label>Login
	<span class="subtitulo">Coloca el login para inicio de sesion</span>	</label>
	<input name="login" type="text" id="login" value="{log_usu}" class="obligatorio" />
    <span class="avisopop" id="obg_login"></span>
    <label>Correo
	<span class="subtitulo">Coloca el e-mail del usuario</span>	</label>
	<input name="correo" type="text" id="correo" value="{mail_usu}" class="obligatorio" />
    <span class="avisopop" id="obg_correo"></span>
    <label>Contrase&ntilde;a
	<span class="subtitulo">Coloca la clave del usuario</span>	</label>
	<input name="clave" type="password" id="clave" class="{obligatorio}" />
    <span class="avisopop" id="obg_clave"></span>
    <label>Repetir Contrase&ntilde;a
	<span class="subtitulo">Coloca nuevamente la clave del usuario</span>	</label>
	<input name="clave1" type="password" id="clave1" />
    <span class="avisopop" id="obg_clave1"></span>
    <label>Permisos
	<span class="subtitulo">Seleccione uno o m&aacute;s</span>    </label>
    <select name="permisos[]" id="permisos" multiple="multiple" style="height:115px;">
    	<!-- START BLOCK : perm -->
    	<option value="{id_mod}" {selected}>{nom_mod}</option>
        <!-- END BLOCK : perm -->
    </select>
    <input type="hidden" name="action" value="{action}" />
    <input type="hidden" name="id" value="{id}" />
  <span class="titulo" style="text-align: center;"><input type="submit" name="button" id="button" value="Submit" /></span>
  </form>
</div>
</body>
</html>
