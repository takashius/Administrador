<?php
class seguridad{
	private $prem_usu;
	private $prem_prov;
	
	public function __construct(){
		include_once('consultas.class.php');
		$this->prem_usu = new Consultas('per_mod_usu', 'id_per');
		$this->prem_usu->fields = array (
			array ('private',	'id_per', "''"),
			array ('public',    'id_mod'),
			array ('public',    'id_usu'),
			array ('public',    'visible')
		);
		$this->prem_prov = new Consultas('per_mod_prov', 'id_per');
		$this->prem_prov->fields = array (
			array ('private',	'id_per', "''"),
			array ('public',    'id_mod'),
			array ('public',    'id_prov'),
			array ('public',    'visible')
		);
	}
	
	public function val_perm_usu($id_usu, $mod){
		$where = "id_usu=$id_usu AND id_mod = '$mod'";
		$permiso = $this->prem_usu->getRecords($where);
		if($permiso[0]['visible'] == '1'){
			return true;
		}else{
			return false;
		}
	}
}
?>