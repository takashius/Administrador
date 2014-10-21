<?php
ob_start();
session_start();
error_reporting(0);
include("clases/class.TemplatePower.inc.php" );
if(@$_GET['pag']){
	$tpl = new TemplatePower( "modulos/$_GET[mod]/estilo/$_GET[pag].tpl" );
}else{
	$tpl = new TemplatePower( "modulos/$_GET[mod]/estilo/form.tpl" );
}
include( "clases/funciones.php" );

$tpl->prepare();

if(@$_GET['pag']){
	include("modulos/$_GET[mod]/$_GET[pag].php");
}else{
	include("modulos/$_GET[mod]/form.php");
}

$tpl->printToScreen();
ob_end_flush();
?>
