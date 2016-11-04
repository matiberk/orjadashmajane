<?php 
class Majane extends Base_Class{
	
	protected $attr = array(
		0 => "id",
		1 => "lugar",
		2 => "titulo",
		3 => "subtitulo",
		4 => "descripcion",
		5 => "fecha_desde",
		6 => "fecha_hasta",
		7 => "abierto"
	);
	
	protected $table_attr = array(
		0 => "ID",
		1 => "Lugar",
		2 => "Titulo",
		3 => "Subtitulo",
		5 => "Desde",
		6 => "Hasta",
		7 => "Abierto"
	);
	
	public function getAllMajanot(){
		$query = "SELECT * from majane";
		
		$result = $this->execQuery($query);
		
		$majanot = array();
		
		while ($majane_row = mysqli_fetch_array($result, MYSQL_NUM)) {
			$majane = new Majane();
			$majane->convertToClass($majane_row);
			array_push($majanot, $majane);
		}
		
		return $majanot;
	}
	
	public function getMajanotByFields($fields, $values, $valuesType){
		$query = "SELECT * from majane WHERE";
		
		foreach($fields as $key => $field){
			if ($valuesType[$key] == "string"){
				$query.= " ".$field." = '".$values[$key]."'";
			}else{
				$query.= " ".$field." = ".$values[$key];
			}
			
			if (($key + 1) < count($fields)){
				$query.= " AND";
			}
		}
		
		$result = $this->execQuery($query);
		
		$majanot = array();
		
		while ($majane_row = mysqli_fetch_array($result, MYSQL_NUM)) {
			$majane = new Majane();
			$majane->convertToClass($majane_row);
			array_push($majanot, $majane);
		}
		
		return $majanot;
	}
		
	public function getMajaneByFields($fields, $values, $valuesType){
		$majanot = $this->getMajanotByFields($fields, $values, $valuesType);
		if(count($majanot) > 0){
			return $majanot[0];
		}
		
		return null;
	}
	
	public function getMajaneGroups(){
		$query = "SELECT * from majane_grupo WHERE id_majane = ".$this->data["id"];
		$result = $this->execQuery($query);
		$grupos = array();
		
		while ($grupo_row = mysqli_fetch_array($result, MYSQL_NUM)) {
			$grupo = new Majane_Grupo();
			$grupo->convertToClass($grupo_row);
			array_push($grupos, $grupo);
		}
			
		$grupo_madrijim = new Majane_Grupo();
		$grupo_madrijim = $grupo_madrijim->getMadrijimGrupo($this->data["id"]);
		
		array_push($grupos, $grupo_madrijim);
		
		return $grupos;
	}
	
	public function parseDataToRow(){
		$parsedData = parent::parseDataToRow();
		
		if ($this->data["abierto"] == 1){
			$parsedData["abierto"] = "SI";
		}else{
			$parsedData["abierto"] = "NO";
		}
		
		return $parsedData;
	}
	
	public function isTableEditEnable(){
		return true;
	}
	
	public function getTableEditLink(){
		return "vermajane.php?majane_id=".$this->data["id"];
	}
	
	public function save($lugar, $titulo, $subtitulo, $descripcion, $fecha_desde, $fecha_hasta){
		$query = "INSERT INTO majane (lugar, titulo, subtitulo, descripcion, fecha_desde, fecha_hasta, abierto) VALUES ('".$lugar."', '".$titulo."', '".$subtitulo."', '".$descripcion."', '".$fecha_desde."', '".$fecha_hasta."', 1)";
		$this->execQuery($query);
	}
	
	public function update($id, $lugar, $titulo, $subtitulo, $descripcion, $fecha_desde, $fecha_hasta, $abierto){
		$query = "UPDATE majane SET lugar = '".$lugar."', titulo = '".$titulo."', subtitulo = '".$subtitulo."', descripcion = '".$descripcion."', fecha_desde = '".$fecha_desde."', fecha_hasta = '".$fecha_hasta."', abierto = ".$abierto." WHERE id = ".$id;
		$this->execQuery($query);
	}
}
?>