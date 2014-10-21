<?php
$action = $_POST['action'];
if(!$action){
	include("clases/usuarios.class.php");
	include("clases/seguridad.class.php");
	$tpl->newBlock( "header_interno" );
	$tpl->assign( "nom_modulo", "Usuarios" );
	$user = new usuarios();
	$perm = new seguridad();
	
	$perm_val = $perm->val_perm_usu($_SESSION['id_usu'], '1');
	
	if(!$perm_val){
		$tpl->gotoBlock( "_ROOT" );
		$tpl->newBlock( "validar" );
	}
}elseif($action == "val_log"){
	ob_start();
	session_start();
	include_once("../../clases/usuarios.class.php");
	$user = new usuarios();
	$valido = $user->validar($_POST['username'], $_POST['pass']);
	if($valido){
		$_SESSION['admin_log'] = true;
		$_SESSION['nom_usu'] = $valido['nom_usu'];		
		$_SESSION['id_usu'] = $valido['id_usu'];
		echo 1;
	}else{
		echo 0;
	}
}elseif($action == "logout"){
	ob_start();
	session_start();
	session_destroy();
}elseif($action == "borrar"){
	include("../../clases/usuarios.class.php");
	$user = new usuarios();
	if(is_numeric($_POST['id'])){
		$user->borrar($_POST['id']);
	}
}elseif($action == "cambiar"){
	ob_start();
	session_start();
	include("../../clases/usuarios.class.php");
	$user = new usuarios();
	$user->cambiar_pass($_SESSION['id_usu'], $_POST['pass']);
}
?>