<?php
function MesAnio($time){
	$mes = date('F',$time);
	if($mes == "January"){
		$mes = "Enero";
	}elseif($mes == "February"){
		$mes = "Febrero";
	}elseif($mes == "March"){
		$mes = "Marzo";
	}elseif($mes == "April"){
		$mes = "Abril";
	}elseif($mes == "May"){
		$mes = "Mayo";
	}elseif($mes == "June"){
		$mes = "Junio";
	}elseif($mes == "July"){
		$mes = "Julio";
	}elseif($mes == "August"){
		$mes = "Agosto";
	}elseif($mes == "September"){
		$mes = "Septiembre";
	}elseif($mes == "October"){
		$mes = "Octubre";
	}elseif($mes == "November"){
		$mes = "Noviembre";
	}elseif($mes == "December"){
		$mes = "Diciembre";
	}
	return $mes;
}

function MesAnio2($dato){
	$mes = $dato;
	if($mes == "01"){
		$mes = "Enero";
	}elseif($mes == "02"){
		$mes = "Febrero";
	}elseif($mes == "03"){
		$mes = "Marzo";
	}elseif($mes == "04"){
		$mes = "Abril";
	}elseif($mes == "05"){
		$mes = "Mayo";
	}elseif($mes == "06"){
		$mes = "Junio";
	}elseif($mes == "07"){
		$mes = "Julio";
	}elseif($mes == "08"){
		$mes = "Agosto";
	}elseif($mes == "09"){
		$mes = "Septiembre";
	}elseif($mes == "10"){
		$mes = "Octubre";
	}elseif($mes == "11"){
		$mes = "Noviembre";
	}elseif($mes == "12"){
		$mes = "Diciembre";
	}
	return $mes;
}

function diaSemana($time){
	$dia = date('D',$time);
	if($dia == "Mon"){
		$dia = "Lunes";
	}elseif($dia == "Tue"){
		$dia = "Martes";
	}elseif($dia == "Wed"){
		$dia = "Miercoles";
	}elseif($dia == "Thu"){
		$dia = "Jueves";
	}elseif($dia == "Fri"){
		$dia = "Viernes";
	}elseif($dia == "Sat"){
		$dia = "Sabado";
	}elseif($dia == "Sun"){
		$dia = "Domingo";
	}
	return $dia;
}

function CadenaLimpia($event){
	@$contenido = eregi_replace("<[^>]*>","",$event);	
	return $contenido;
}

function subirImg($nombreForm, $directorio, $tipo=0, $anchoMin=0, $altoMin=0, $anchoGr=0, $altoGr=0){
	####################################################################
	####################################################################
	####	FUNCION PARA SUBIR IMAGENES AL SERVIDOR					####
	####	$archivo: Nombre que la imagen tendra una vez guardada	####
	####	$nombreForm: Nombre que tiene el campo de formulario	####
	####	$directorio: Directorio donde se va a guardar la imagen	####
	####	$tipo: Las opciones de subida: 							####
	####		1.- Con miniatura de medidas estricta 				####
	####		2.- Con miniatura de relacion de aspecto			####
	####		0.- Sin miniatura									####
	####	$anchoMin: Ancho de las imagenes miniatura				####
	####	$altoMin: Alto de las imagenes miniatura				####
	####	$anchoGr: Ancho de las imagenes grandes					####
	####	$altoGr: Alto de las imagenes grandes					####			
	####################################################################
	####################################################################
	$archivo = md5(uniqid(rand(), true));
	$nom_foto = substr($archivo, 2, 15);
	$extension = explode(".", $_FILES[$nombreForm]['name']);
	$ext = end($extension);
	$nombre =$nom_foto.".".$ext;
	if (move_uploaded_file(@$_FILES[$nombreForm]['tmp_name'], $directorio.$nombre)){
		$url= $nombre;
		if(strtoupper($ext) == "JPG" || strtoupper($ext) == "JPEG"){
			$grande = imagecreatefromjpeg($directorio.$nombre);
		}else if(strtoupper($ext) == "GIF"){
			$grande = imagecreatefromgif($directorio.$nombre);
		}else if(strtoupper($ext) == "PNG"){
			$grande = imagecreatefrompng($directorio.$nombre);
		}else if(strtoupper($ext) == "BMP"){
			$grande = imagecreatefromwbmp($directorio.$nombre);
		}
		$ancho4 = imagesx($grande);
		$alto4 = imagesy($grande);
		$size = getimagesize($directorio.$nombre);
		$width=$size[0];
		$height=$size[1]; 
		if($altoGr == "0"){
			if($width > $anchoGr){
				$newwidth = $anchoGr;
			}else{
				$newwidth = $width;
			}
			$newheight=$height*$newwidth/$width;
		}elseif($anchoGr == "0"){
			if($height > $altoGr){
				$newheight = $altoGr;
			}else{
				$newheight = $height;
			}
			$newwidth = $width*$newheight/$height;
		}else{
			$newwidth = $anchoGr;
			$newheight=$height*$newwidth/$width;
			if($newheight > $altoGr){
				$newheight = $altoGr;
				$newwidth=$width*$newheight/$height;
			}
		}
		if($anchoGr != '0' or $altoGr != '0'){
			$redimension = imagecreatetruecolor($newwidth,$newheight);
			imagecopyresampled($redimension,$grande,0,0,0,0,$newwidth,$newheight,$ancho4,$alto4);
			if(strtoupper($ext) == "JPG" || strtoupper($ext) == "JPEG"){
				imagejpeg($redimension,$directorio.$nombre,100);	
			}else if(strtoupper($ext) == "GIF"){
				imagegif($redimension,$directorio.$nombre);
			}else if(strtoupper($ext) == "PNG"){
				imagepng($redimension,$directorio.$nombre,0);
			}else if(strtoupper($ext) == "BMP"){
				imagewbmp($redimension,$directorio.$nombre);
			}
		}
		
		if($tipo == "1"){
			if(strtoupper($ext) == "JPG" || strtoupper($ext) == "JPEG"){
				$original = imagecreatefromjpeg($directorio.$nombre);
			}else if(strtoupper($ext) == "GIF"){
				$original = imagecreatefromgif($directorio.$nombre);
			}else if(strtoupper($ext) == "PNG"){
				$original = imagecreatefrompng($directorio.$nombre);
			}else if(strtoupper($ext) == "BMP"){
				$original = imagecreatefromwbmp($directorio.$nombre);
			}
			$ancho = imagesx($original);
			$alto = imagesy($original);
			if($altoMin == "0"){
				$newwidth = $anchoMin;
				$newheight=$height*$newwidth/$width;
			}elseif($anchoMin == "0"){
				$newheight=$altoMin;
				$newwidth = $width*$newheight/$height;
			}else{
				$newwidth 	= $anchoMin;
				$newheight	= $altoMin;
			}
			$thumb = imagecreatetruecolor($newwidth,$newheight);
			imagecopyresampled($thumb,$original,0,0,0,0,$newwidth,$newheight,$ancho,$alto);	
			$nombrethumb = "thumb_".$nombre;
			if(strtoupper($ext) == "JPG" || strtoupper($ext) == "JPEG"){
				imagejpeg($thumb,$directorio.$nombrethumb,100);	
			}else if(strtoupper($ext) == "GIF"){
				imagegif($thumb,$directorio.$nombrethumb);
			}else if(strtoupper($ext) == "PNG"){
				imagepng($thumb,$directorio.$nombrethumb,0);
			}else if(strtoupper($ext) == "BMP"){
				imagewbmp($thumb,$directorio.$nombrethumb);
			}
		}elseif($tipo == 2){
			if(strtoupper($ext) == "JPG" || strtoupper($ext) == "JPEG"){
				$original = imagecreatefromjpeg($directorio.$nombre);
			}else if(strtoupper($ext) == "GIF"){
				$original = imagecreatefromgif($directorio.$nombre);
			}else if(strtoupper($ext) == "PNG"){
				$original = imagecreatefrompng($directorio.$nombre);
			}else if(strtoupper($ext) == "BMP"){
				$original = imagecreatefromwbmp($directorio.$nombre);
			}
			$ancho = imagesx($original);
			$alto = imagesy($original);
			if($altoMin == "0"){
				$newwidth = $anchoMin;
				$newheight=$height*$newwidth/$width;
			}elseif($anchoMin == "0"){
				$newheight=$altoMin;
				$newwidth = $width*$newheight/$height;
			}else{
				$newheight=$altoMin;
				$newwidth = $width*$newheight/$height;
				if($newwidth < $anchoMin){
					$newwidth = $anchoMin;
					$newheight=$height*$newwidth/$width;
				}
			}
			
			$thumb = imagecreatetruecolor($newwidth,$newheight);
			imagecopyresampled($thumb,$original,0,0,0,0,$newwidth,$newheight,$ancho,$alto);	
			$nombrethumb = "thumb_".$nombre;
			if(strtoupper($ext) == "JPG" || strtoupper($ext) == "JPEG"){
				imagejpeg($thumb,$directorio.$nombrethumb,100);	
			}else if(strtoupper($ext) == "GIF"){
				imagegif($thumb,$directorio.$nombrethumb);
			}else if(strtoupper($ext) == "PNG"){
				imagepng($thumb,$directorio.$nombrethumb,0);
			}else if(strtoupper($ext) == "BMP"){
				imagewbmp($thumb,$directorio.$nombrethumb);
			}
		}
		return $url;
	}else{
		$url="";
		return $url;
	}
}

function ObtenerNavegador($user_agent) {
	$navegadores = array(
	  'Opera' => 'Opera',
	  'Mozilla Firefox'=> '(Firebird)|(Firefox)',
	  'Galeon' => 'Galeon',
	  'Mozilla'=>'Gecko',
	  'MyIE'=>'MyIE',
	  'Lynx' => 'Lynx',
	  'Netscape' => '(Mozilla/4\.75)|(Netscape6)|(Mozilla/4\.08)|(Mozilla/4\.5)|(Mozilla/4\.6)|(Mozilla/4\.79)',
	  'Konqueror'=>'Konqueror',
	  'Internet Explorer 8' => '(MSIE 8\.[0-9]+)',
	  'Internet Explorer 7' => '(MSIE 7\.[0-9]+)',
	  'Internet Explorer 6' => '(MSIE 6\.[0-9]+)',
	  'Internet Explorer 5' => '(MSIE 5\.[0-9]+)',
	  'Internet Explorer 4' => '(MSIE 4\.[0-9]+)',
	);
	foreach($navegadores as $navegador=>$pattern){
       if (eregi($pattern, $user_agent))
       return $navegador;
    }
	return 'Desconocido';
}

function formatofecha($fecha, $tipo=1){
	if($tipo == 1){
		$fec = explode("/", $fecha);
		if(!$fec[2]){
			$fec = explode("-", $fecha);
		}
		list($dia, $mes, $anio) = $fec;
		if(strlen($anio) == 2){
			$anio = "20".$anio;
		}
		$formato = $anio."-".$mes."-".$dia;
	}
	return $formato;
}

function fechaFormato($fecha, $tipo = 1){
	$tiempo = explode(" ", $fecha);
	$fec = $tiempo[0];
	$tmp = $tiempo[1];
	$fec = explode("-", $fec);
	$fectime = mktime(0,0,0,$fec[1],$fec[2],$fec[0]);
	if($tipo == 1){
		$dia = diaSemana($fectime);
		$mes = MesAnio($fectime);
		$formato = "$dia $fec[2]/$mes/$fec[0]";
	}elseif($tipo == 2){
		$dia = diaSemana($fectime);
		$mes = MesAnio($fectime);
		$formato = "$dia $fec[2]/$mes/$fec[0] a las $tmp";
	}elseif($tipo == 3){
		$dia = diaSemana($fectime);
		$mes = MesAnio($fectime);
		$formato = "$dia, $fec[2] de $mes de $fec[0]";
	}elseif($tipo == 4){
		$dia = diaSemana($fectime);
		$mes = MesAnio($fectime);
		$formato = "$fec[2]/$fec[1]/$fec[0]";
	}
	return $formato;
}

function introText($texto, $cantidad=100){
	$texto = CadenaLimpia($texto);
	return substr($texto, 0, $cantidad);
}

function formatoImg($cadena, $id){
	$cadena = str_replace("ñ", "n", $cadena);
	$cadena = str_replace("á", "a", $cadena);
	$cadena = str_replace("é", "e", $cadena);
	$cadena = str_replace("í", "i", $cadena);
	$cadena = str_replace("ó", "o", $cadena);
	$cadena = str_replace("ú", "u", $cadena);
	$cadena = str_replace("Ñ", "N", $cadena);
	$cadena = str_replace("Á", "A", $cadena);
	$cadena = str_replace("É", "E", $cadena);
	$cadena = str_replace("Í", "I", $cadena);
	$cadena = str_replace("Ó", "O", $cadena);
	$cadena = str_replace("Ú", "U", $cadena);
	$cadena = str_replace(" ", "_", $cadena);
	$cadena .= "-$id";
	return $cadena;
}
?>
