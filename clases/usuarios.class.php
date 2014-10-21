<?php
class usuarios{
	private $db;
	private $modulo;
	private $modulos;
	public $table;
	public $tId;
	
	public function __construct(){
		include('consultas.class.php');
		$this->table = "usuarios";
		$this->tId = "id_usu";
		$this->db = new Consultas($this->table, $this->tId);
		$this->db->fields = array (
			array ('private',	'id_usu', "''"),
			array ('public',    'nom_usu'),
			array ('public',    'log_usu'),
			array ('public',    'mail_usu'),
			array ('image',    'pas_usu'),
			array ('private',   'fec_usu',  'now()')
		);
		$this->modulos = new Consultas('per_mod_usu', 'id_per');
		$this->modulos->fields = array (
			array ('private',	'id_per', "''"),
			array ('public',    'id_mod'),
			array ('public',    'id_usu'),
			array ('public',    'visible'),
			array ('system',   "(SELECT nom_mod FROM ".$this->db->prefijo."modulos WHERE id_mod=".$this->db->prefijo."per_mod_usu.id_mod) AS nom_mod")
		);
		$this->modulo = new Consultas('modulos', 'id_mod');
		$this->modulo->fields = array (
			array ('private',	'id_mod', "''"),
			array ('public',    'nom_mod'),
			array ('public',    'url_mod'),
			array ('public',    'img_mod')
		);
	}
	
	public function validar($log, $pass){
		$where = "`log_usu` = '$log'";
		$user = $this->db->getRecords($where);
		if($user[0]['pas_usu'] == md5($pass)){
			return $user[0];
		}else{
			return false;
		}
	}
	
	public function listar($where = false){
		return $this->db->getRecords($where);
	}
	
	public function agregar($nom, $log, $pas, $mail, $permisos){
		$data[] = $nom;
		$data[] = $log;
		$data[] = $mail;
		$data[] = md5($pas);
		$this->db->insertRecord($data);
		$id_usu = $this->db->return_id();
		for ($i=0;$i<count($permisos);$i++){     
			$per[] = $permisos[$i];
			$per[] = $id_usu;
			$per[] = '1';
			$this->modulos->insertRecord($per); 
			$per = "";
		}
		return $id_usu;
	}
	
	public function consultar($id){
		$result = $this->db->getRecord($id);
		$permisos = $this->modulos->getRecords("id_usu = $id AND visible=1");
		$result[1] = $permisos;
		return $result;
	}
	
	public function editar($id, $nom, $log, $pas, $mail, $permisos){
		$data[] = $nom;
		$data[] = $log;
		$data[] = $mail;
		if($pas){$pas = md5($pas);}
		$data[] = $pas;
		$this->db->updateRecord($id,$data);
		$data = "";
		$mod = $this->modulo->getRecords();
		$activar = array();
		foreach($mod as $clave=>$valor){
			$temp = true;
			$per = $this->modulos->getRecords("id_usu = $id AND id_mod = ".$valor['id_mod']);
			foreach($per as $clv=>$vlr){
				foreach($permisos as $c=>$v){
					if($v == $valor['id_mod']){
						$activar[] = $v;
						$data[] = '';
						$data[] = '';
						$data[] = "1";
						$this->modulos->updateRecord($vlr['id_per'],$data);
						$data = "";
						$temp = false;
					}
				}
				if($temp){
					$desactivar[] = $vlr['id_mod'];
					$data[] = '';
					$data[] = '';
					$data[] = "0";
					$this->modulos->updateRecord($vlr['id_per'],$data);
					$data = "";
				}
			}
		}
		foreach($permisos as $clv=>$vlr){
			$temp = true;
			foreach($activar as $c=>$v){
				if($v == $vlr){
					$temp = false;
				}
			}
			if($temp){
				$nuevo[] = $vlr;
				$data[] = $vlr;
				$data[] = $id;
				$data[] = "1";
				$this->modulos->insertRecord($data); 
				$data = "";
			}
		}
	}
	
	public function borrar($id){
		$this->db->deleteRecord($id);
		$this->modulos->deleteRecords("id_usu=$id");
	}
	
	public function cambiar_pass($id, $pass){
		$data[] = '';
		$data[] = '';
		$data[] = md5($pass);
		$data[] = '';
		$this->db->updateRecord($id,$data);
	}
}
?>