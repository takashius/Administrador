<?php
ob_start();
session_start();
error_reporting(0);
include_once("clases/config.php");
include("clases/class.TemplatePower.inc.php" );
$tpl = new TemplatePower( "estilo/estilo.tpl" );
include( "clases/funciones.php" );
if(!@$_SESSION['admin_log']){
	$tpl->assignInclude( "contenido", "estilo/login.tpl" );
}else{
	$tpl->assignInclude( "menu_login", "estilo/menu_login.tpl" );
	if(!@$_GET['mod']){
		$tpl->assignInclude( "contenido", "estilo/menu_ppl.tpl" );
	}else{
		$tpl->assignInclude( "menu", "estilo/menu.tpl" );
		$tpl->assignInclude( "contenido", "modulos/$_GET[mod]/estilo/index.tpl" );
		$tpl->assignInclude( "menu_footer", "estilo/menu_footer.tpl" );
	}
}
$tpl->prepare();

////*****CONFIGURACION*****////
$tpl->assign( "url_web",  $URL_WEB);
$tpl->assign( "nom_web",  $NOM_WEB);
$tpl->assign( "anio_sis",  $ANIO_SIS);
$tpl->assign( "rif_cliente",  $RIF_CLIENTE);
if(@$_SESSION['admin_log']){	$tpl->assign( "nom_usu_sis",  $_SESSION['nom_usu']);}
////*****CONFIGURACION*****////

if(@$_SESSION['admin_log']){
	if(!@$_GET['mod']){
		include('modulos/menu_ppl.php');
	}else{
		include("modulos/$_GET[mod]/index.php");
		include('modulos/menu.php');
	}
}else{
	$tpl->newBlock( "header_ppl" );
	$tpl->assign( "fecha_sis",  fechaFormato(date('Y-m-d'), 3));
}

$tpl->printToScreen();
ob_end_flush();
?>
