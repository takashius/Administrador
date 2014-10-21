<?php
include_once("sqlserv.php");
class Consultas {
	/** Link: Resource de la Base de datos */
	private $link;
	/** Nombre de la tabla */
	public $table;
	/** definicion de campos de la tabla
	** @code: $instance->fields =array (	array (fieldName, class, defaultValue), ...	);
	fieldName: nombre del campo en la tabla
	class: tipo de campo (public, private, system)
	*/
	public $fields;
	/** Nombre del Campo Id de la tabla*/
	public $campoId;
	/** Prefijo de las tablas*/
	public $prefijo;
	/** Si es verdadero los métodos de esta clase devuelven un recurso MySQL; si no, una matriz asociativa */
	private $returnSQLResult =true;
	/**
	** $table Nombre de la tabla que se manejará por esta instancia
	*/
	public function __construct ($table, $campoId){
		include("config.php");
		$this->table =$table;
		$this->campoId =$campoId;
		$this->prefijo =$PREF_DB;
		$this->fields =array ();
		$this->link = conect($servidor,$usuario,$clave,$bd);
	}

////////		Public Methods

	/** Devuelve los registros de la tabla
	* @param $where_str: Cadena=''. Condición para filtrar resultados.
	* @param $order_str: Cadena=''. Campo sobre el que se ordenarán los registros.
	* @param $count: Entero =false . Número de registros a devolver. Si es false, toda la tabla
	* @param $start: Entero =0. Indica a partir de qué registros se devuelven datos, por default 0.
	*/
	public function getRecords ($where_str=false, $order_str=false, $count=false, $start=0){
		$where =$where_str ? "WHERE $where_str" : "";
		$order =$order_str ? "ORDER BY $order_str" : "";
		$limit = $count ? "LIMIT $start, $count" : "";
		$campos =$this->getAllFields ();
		$query ="SELECT $campos FROM {$this->prefijo}{$this->table} $where $order $limit"; //echo $query."<br><br>";
		$consQ =mysql_query ($query);
		//return $this->returnSQLResult ? mysql_query ($query) : $this->sql ($query);
		$resultado =array ();
		while (@$consF =mysql_fetch_assoc ($consQ))
        	array_push ($resultado, $consF);
		return $resultado;
	}
	/** Devuelve un registro de la tabla
	* @param $id: Entero. Id del registro a devolver.
	*/
	public function getRecord ($id){
		return $this->getRecords ("{$this->campoId}=$id", false, 1);
	}
	public function insertRecord ($data){
		$campos =$this->getTableFields ();
		$sysData =$this->getDefaultValues ();
		if($sysData){
			$sysData .= ",";
		}
		$data =implode ("', '", $data);
		$query ="INSERT INTO {$this->prefijo}{$this->table} ($campos) VALUES ($sysData '$data')"; //echo $query."<br>";
		mysql_query ($query);
		return $this->validateOperation();
	}
	public function return_id(){
		return mysql_insert_id($this->link);
	}
	
	public function updateRecord ($id, $data){
		$campos =$this->getEditableFields (true);
		$fotos =$this->getImageFields (true);
		$datos =array ();
		foreach ($campos as $ind => $campo){
			$current_data =$data[$ind];
			array_push ($datos, "$campo='$current_data'"); 
		}
		foreach ($fotos as $i => $campo){
			$ind ++;
			$current_data =$data[$ind];
			if($current_data != ""){
				array_push ($datos, "$campo='$current_data'"); 
			}
		}
		$datos =implode (", ", $datos);
		$query = "UPDATE {$this->prefijo}{$this->table} SET $datos WHERE {$this->campoId}=$id"; //echo $query."<br>";
		mysql_query ( $query );
		return $this->validateOperation ();
	}
	public function deleteRecord ($id){
		mysql_query ("DELETE FROM {$this->prefijo}{$this->table} WHERE {$this->campoId}=$id"); //echo $mysql_query."<br>";
		return $this->validateOperation ();
	}
	
	public function deleteRecords ($where){
		mysql_query ("DELETE FROM {$this->prefijo}{$this->table} WHERE $where"); //echo $mysql_query."<br>";
		return $this->validateOperation ();
	}	
	public function numPag ($where_str=false, $count=0){
		$where =$where_str ? "WHERE $where_str" : "";
		$query ="SELECT COUNT({$this->campoId}) FROM {$this->prefijo}{$this->table} $where"; //echo $query;
		$consQ =mysql_query ($query);
		$row = mysql_fetch_array($consQ);
		$resultado = ceil($row[0] / $count);
		return $resultado;
	}
	public function sql_direct($consulta){
		$consQ =mysql_query ($consulta);
		$resultado =array ();
		while ($consF =mysql_fetch_assoc ($consQ))
        	array_push ($resultado, $consF);
		return $resultado;
	}

////////		Private Methods

	private function getFieldsByType ($type=''){
		$return =array ();
		$types =explode ('|', $type);
		foreach ($this->fields as $field){
			$includeField =false;
			foreach ($types as $t){
				if ($field[0] == $t){
					array_push ($return, $field);
				}
			}
		}
		return $return;
	}
	private function getNameFields ($type){
		$return =array ();
		$fields =$this->getFieldsByType ($type);
		foreach ($fields as $field){
			array_push ($return, $field[1]);
		}
		return $return;
	}
	private function getEditableFields ($asArray=false){
		$return =$this->getNameFields ('public');
		return $asArray ? $return : implode (', ', $return);
	}
	private function getImageFields ($asArray=false){
		$return =$this->getNameFields ('image');
		return $asArray ? $return : implode (', ', $return);
	}
	private function getTableFields ($asArray=false){
		$temp =$this->getNameFields ('private');
		foreach($temp as $r)$return[] = $r;
		$temp =$this->getNameFields ('public');
		foreach($temp as $r)$return[] = $r;
		$temp =$this->getNameFields ('image');
		foreach($temp as $r)$return[] = $r;
		return $asArray ? $return : implode (', ', $return);
	}
	private function getAllFields ($asArray=false){
		$return =$this->getNameFields ('public|private|system|image');
		return $asArray ? $return : implode (', ', $return);
	}
	private function getDefaultValues ($asArray=false){
		$return =array ();
		$fields =$this->getFieldsByType ('private');
		foreach ($fields as $field){
			array_push ($return, $field[2]);
		}
		return $asArray ? $return : implode (', ', $return);
	}
	private function validateOperation (){
		return mysql_error()=='' ? true : false;
	}
	private function sql ($consulta){
		$consQ =mysql_query (mysql_real_escape_string ($consulta));
		$resultado =array ();
		if ($consQ){
			while ($consF =mysql_fetch_assoc ($consQ))
				array_push ($resultado, $consF);
		}
		return $resultado;
	}
}?>
