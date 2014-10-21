<?php
$action = $_REQUEST['action'];
if(!$action){
	include("clases/consultas.class.php");
	$tpl->assign( "new",  'Publicar un nuevo Usuario');
	$tpl->assign( "msj",  'Por favor llene el siguiente formulario para publicar un usuario');
	$tpl->assign( "action",  'save_new');
	$tpl->assign( "obligatorio",  'obligatorio');
	$tpl->newBlock( "val_clave" );
	$modulo =new Consultas('modulos', 'id_mod');
	$modulo->fields = array (
		array ('private',	'id_mod', "''"),
		array ('public',    'nom_mod')
	);
	
	$mod = $modulo->getRecords();
	foreach($mod as $clave=>$valor){
		$tpl->newBlock( "perm" );
		$tpl->assign( "id_mod", $valor['id_mod'] );
		$tpl->assign( "nom_mod", $valor['nom_mod'] );
	}
}elseif($action == "save_new"){
	include("clases/usuarios.class.php");
	$user = new usuarios();
	$id_user = $user->agregar($_POST['nombre'], $_POST['login'], $_POST['clave'], $_POST['correo'], $_POST['permisos']);
	$tpl->newBlock( "cerrar" );
}elseif($action == "edt"){
	$tpl->assign( "new",  'Editar un Usuario');
	$tpl->assign( "msj",  'Por favor llene el siguiente formulario para editar al usuario');
	$tpl->assign( "action",  'save_edt');
	$tpl->assign( "id",  $_GET['id']);
	
	include("clases/usuarios.class.php");
	
	$user = new usuarios();
	$usuario = $user->consultar($_GET['id']);
	$modulo =new Consultas('modulos', 'id_mod');
	$modulo->fields = array (
		array ('private',	'id_mod', "''"),
		array ('public',    'nom_mod')
	);
	
	$mod = $modulo->getRecords();
	
	foreach($usuario as $clave=>$valor){
		if($clave == 0){
			$tpl->assign( "nom_usu", $valor['nom_usu'] );
			$tpl->assign( "log_usu", $valor['log_usu'] );
			$tpl->assign( "mail_usu", $valor['mail_usu'] );
		}else{
			$selected = 'selected="selected"';
			
			foreach($mod as $clv=>$vlr){
				$tpl->newBlock( "perm" );
				$tpl->assign( "id_mod", $vlr['id_mod'] );
				$tpl->assign( "nom_mod", $vlr['nom_mod'] );
				foreach($valor as $key=>$value){
					if($value['id_mod'] == $vlr['id_mod']){
						$tpl->assign( "selected", $selected );
					}
				}
			}
		}
	}
}elseif($action == "save_edt"){
	include("clases/usuarios.class.php");
	$user = new usuarios();
	$user->editar($_POST['id'], $_POST['nombre'], $_POST['login'], $_POST['clave'], $_POST['correo'], $_POST['permisos']);
	$tpl->newBlock( "cerrar" );
}
?>