<script>
$(document).ready(function() {
	$("#login").submit(function(){
		$("#img_ajax").fadeIn('fast');
		var username = $('#username').val(), pass = $('#pass').val();
		$.ajax({
			type: "POST",
			url: "modulos/usuarios/index.php",
			data: "username=" + username + "&pass=" + pass + "&action=val_log",
			success: function(msj){console.log(msj);
				if(msj == 1){
					document.location.reload();
				}else{
					$("#log_error").fadeIn('slown');
					$("#img_ajax").fadeOut('slown');
					setTimeout("$(\"#log_error\").fadeOut('slow')",5000);	
				}
			}
		});
		return false;
	});
});
</script>

<div class="cuerpo2">
    <div id="log_error">
        Usuario o Contrase&ntilde;a inv&aacute;lidos
    </div>
  <div class="cuerpo2" id="img_ajax">
  	<img src="images/ajax-loader.gif" border="0" alt="Cargando" title="Cargando" style="margin-top:95px;" />
  </div>
  <div class="loginbox">
    <span>Iniciar sesi&oacute;n</span>
    <form name="login" id="login">  
    	<input name="username" id="username" class="status" value="Usuario" type="text"/>  
        <input name="pass_txt" id="pass_txt" class="status" value="Contrase&ntilde;a" type="text"/>
        <input name="pass" id="pass" class="status" value="" type="password" style="display:none;" />
        <input value="Entrar" type="submit" class="btnlogin"/> 
    </form>  
  </div>
</div>