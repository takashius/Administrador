<?php
include("clases/consultas.class.php");
@$action = $_REQUEST['action'];
if(!$action){
	$tpl->newBlock( "header_ppl" );
	$tpl->assign( "fecha_sis",  fechaFormato(date('Y-m-d'), 3));
	
	$sql = new Consultas('modulos', 'id_mod');
	$consulta = "SELECT 
					`{$sql->prefijo}per_mod_usu`.`id_per`, 
					`{$sql->prefijo}modulos`.`nom_mod`, 
					`{$sql->prefijo}modulos`.`url_mod`, 
					`{$sql->prefijo}modulos`.`img_mod`
				FROM 
					`{$sql->prefijo}modulos` , 
					`{$sql->prefijo}usuarios` , 
					`{$sql->prefijo}per_mod_usu` 
				WHERE 
					`{$sql->prefijo}usuarios`.`id_usu` =  '$_SESSION[id_usu]' AND 
					`{$sql->prefijo}usuarios`.`id_usu` =  `{$sql->prefijo}per_mod_usu`.`id_usu` AND 
					`{$sql->prefijo}modulos`.`id_mod` =  `{$sql->prefijo}per_mod_usu`.`id_mod` AND 
					`{$sql->prefijo}per_mod_usu`.`visible` =  '1' 
				ORDER BY 
					`{$sql->prefijo}per_mod_usu`.`orden`";
	$modulos = $sql->sql_direct($consulta);
	foreach($modulos as $clave=>$valor){
		$tpl->newBlock( "modulo" );
		$tpl->assign( "nom_mod",  $valor['nom_mod']);
		$tpl->assign( "id_mod",  $valor['id_per']);
		$tpl->assign( "img_mod",  $valor['img_mod']);
		$tpl->assign( "url_mod",  $valor['url_mod']);
	}
}elseif($action == "ordenar"){
	session_start();
	include("../clases/consultas.class.php");
	$mod = $_POST['mod'];
	$bandera = 1;
	
	if($mod){
		foreach($mod as $valor){
			$data = '';
			$sql = new Consultas('per_mod_usu', 'id_per');
			if($_SESSION['prov']){$sql = new Consultas('per_mod_prov', 'id_per');}
			$sql->fields = array (
				array ('private',	'id_per', "''"),
				array ('public',    'orden')
			);
			$data[]=$bandera;
			$sql->updateRecord ($valor,$data);
			//echo $valor." - ";
			$bandera ++;
		}
	}
}
?>