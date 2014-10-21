<?php
include("../../clases/usuarios.class.php");
include("../../clases/config.php");
$user = new usuarios();

$aColumns = array( 'id_usu', 'nom_usu', 'log_usu' );
$sTable = $PREF_DB.$user->table;
$sId = $user->tId;

$sql = "SELECT COUNT($sId) from $sTable";
$res = mysql_query($sql);
$res = mysql_fetch_array($res);
$iTotal = $res[0];

$sLimit = "";
if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' ){
	$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
		mysql_real_escape_string( $_GET['iDisplayLength'] );
}

$sOrder = "";
if ( isset( $_GET['iSortCol_0'] ) ){
	$sOrder = "ORDER BY  ";
	for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ ){
		if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" ){
			$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
		}
	}
	
	$sOrder = substr_replace( $sOrder, "", -2 );
	if ( $sOrder == "ORDER BY" ){
		$sOrder = "";
	}
}

$sWhere = "";
if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" ){
	$sWhere = "WHERE (";
	for ( $i=0 ; $i<count($aColumns) ; $i++ ){
		$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
	}
	$sWhere = substr_replace( $sWhere, "", -3 );
	$sWhere .= ')';
}

for ( $i=0 ; $i<count($aColumns) ; $i++ ){
	if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' ){
		if ( $sWhere == "" ){
			$sWhere = "WHERE ";
		}else{
			$sWhere .= " AND ";
		}
		$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
	}
}

if($sWhere){
	$sWhere .= " AND id_usu != 1";
}else{
	$sWhere = "WHERE id_usu != 1";
}

if(!$sOrder){
	//$sOrder = "ORDER BY nom_usu asc";
}

$sql = "SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))." FROM   $sTable $sWhere $sOrder $sLimit";
$result = mysql_query( $sql ) or die(mysql_error());

$sql = "SELECT FOUND_ROWS()";
$res = mysql_query( $sql ) or die(mysql_error());
$res = mysql_fetch_array($res);
$iFilteredTotal = $res[0];

$output = array(
	"aaData" => array()
);$p = 0;
while ( $aRow = mysql_fetch_array( $result ) ){
	$row = array();
	for ( $i=0 ; $i<count($aColumns) ; $i++ ){
		if ( $aColumns[$i] == "$sId" ){
			$id = $aRow[ $aColumns[$i] ];
			$row[] = $aRow[ $aColumns[$i] ];
		}else if ( $aColumns[$i] != ' ' ){
			$row[] = $aRow[ $aColumns[$i] ];
		}
	}
	$row[] = '<center><a href="pop.php?action=edt&mod=usuarios&id='.$id.'" class="iframe nuevo"><img src="images/page_white_edit.png" border="0" alt="Editar" title="Editar" /></a></center>';
	$row[] = '<center><a href="'.$id.'" class="borrar" rel="'.$p.'" rel2="modulos/usuarios/index.php"><img src="images/delete.png" border="0" alt="Eliminar" title="Eliminar" /></a></center>'; $p ++;
	$output['aaData'][] = $row;
}
//print_r($output);
echo json_encode( $output );
?>
