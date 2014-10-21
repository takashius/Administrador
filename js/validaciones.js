$(function(){	
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
	
	$('.obligatorio').blur(function(){
		var valor = $(this).val(), nomcamp = $(this).attr('name');
		if(valor == ''){
			$("#obg_"+nomcamp).html('Este campo es requerido');
			$("#obg_"+nomcamp).fadeIn('slown');
		}else{
			$("#obg_"+nomcamp).fadeOut('slown');
		}
		if(nomcamp == "correo"){
			var mail = $(this);
			valMail(mail);
		}
	});
});