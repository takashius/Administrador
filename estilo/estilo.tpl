<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>{nom_web} - Administrador</title>
<link rel="stylesheet" type="text/css" media="screen" href="css/estilos.css" />
<link rel="stylesheet" type="text/css" media="screen" href="js/fancybox/jquery.fancybox-1.3.4.css" />

<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.ajax.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="js/dataTables.fnReloadAjax.js"></script>
<script type="text/javascript" language="javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" language="javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" language="javascript" src="js/funciones.js"></script>
<script type="text/javascript" language="javascript" src="js/focus_form.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="css/smoothness_a/jquery-ui-1.8.4.custom.css" />
<!-- START BLOCK : validar -->
 <script>
 alert('No tiene permiso para acceder a este modulo');
 document.location.href = "../admin/";
 </script>
<!-- END BLOCK : validar -->
</head>

<body>
<div class="header_top">
  <div class="dominio"><a href="../index.php">{url_web}</a></div>
  <div class="titulo_adm">Administrador de Contenidos</div>
  <!-- INCLUDE BLOCK : menu_login -->
</div>
<div class="header2">
	<a href="../admin/"><img src="images/logo.png" border="0" /></a>
    <!-- START BLOCK : header_ppl -->
    <span>{fecha_sis}</span>
    <!-- END BLOCK : header_ppl -->
    <!-- START BLOCK : header_interno -->
    <span class="txt11"><a onclick="history.go(-1)" style="cursor: pointer;"><img src="images/arrow_left.png" border="0" /> Volver</a></span><br /><br />
    <span class="txtcategorias">{nom_modulo}</span>
    <!-- END BLOCK : header_interno -->
</div>
<!-- INCLUDE BLOCK : menu -->
<!-- INCLUDE BLOCK : contenido -->
<!-- INCLUDE BLOCK : menu_footer -->
<div class="footer">
	<span style="float: left; padding: 0 0 0 10px;">&copy; {anio_sis}. <strong>{nom_web}</strong> RIF: {rif_cliente}. Todos los Derechos Reservados.</span>
    <span style="float: right; padding: 0 10px 0 0;">Desarrollado por: <a href="http://www.erdesarrollo.com/" target="_blank"><strong>ErDesarrollo</strong></a></span></div>
</body>
</html>
