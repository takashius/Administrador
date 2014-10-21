<?php
@$action = $_REQUEST['action'];
if(!$action){
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
	$bandera = 0;
	foreach($modulos as $clave=>$valor){
		$tpl->newBlock( "nav_top" );
		if($bandera != 0){$tpl->assign( "barra",  "|");}else{$bandera = 1;}
		$tpl->assign( "nom_mod",  $valor['nom_mod']);
		$tpl->assign( "url_mod",  $valor['url_mod']);
	}
	$bandera = 0;
	foreach($modulos as $clave=>$valor){
		$tpl->newBlock( "nav_bottom" );
		if($bandera != 0){$tpl->assign( "barra",  "|");}else{$bandera = 1;}
		$tpl->assign( "nom_mod",  $valor['nom_mod']);
		$tpl->assign( "url_mod",  $valor['url_mod']);
	}
}
?>