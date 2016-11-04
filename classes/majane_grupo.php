<?php 
class Majane_Grupo extends Base_Class{
	
	protected $attr = array(
		0 => "id",
		1 => "id_majane",
		2 => "nombre",
		3 => "aclaracion"
	);
	
	protected $table_attr = array(
		0 => "ID",
		2 => "Nombre",
		3 => "Aclaracion"
	);
	
	public function getMajaneGroupByFields($fields, $values, $valuesType){
		$majane_groups = $this->getMajaneGroupsByFields($fields, $values, $valuesType);
		if (count($majane_groups) > 0 ){
			return $majane_groups[0];
		}
		
		return null;
	}
	
	public function getMajaneGroupsByFields($fields, $values, $valuesType){
		$query = "SELECT * from majane_grupo WHERE";
		
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
		
		$grupos = array();
		
		while ($grupo_row = mysqli_fetch_array($result, MYSQL_NUM)) {
			$grupo = new Majane_Grupo();
			$grupo->convertToClass($grupo_row);
			array_push($grupos, $grupo);
		}
		
		return $grupos;
	}
	public function parseDataToRow(){
		$parsedData = parent::parseDataToRow();
		
		if($this->data["id"] == 0){
			$parsedData["edit"] = "";	
			$parsedData["delete"] = "";
		}
		
		return $parsedData;
	}
	
	public function isTableEditEnable(){
		if($this->data["id"] == 0){
			return false;
		}
		return true;
	}
	
	public function isTableDeleteEnable(){
		if($this->data["id"] == 0){
			return false;
		}
		return true;
	}
	
	public function getTableEditLink(){
		return "vermajanegrupo.php?majane_id=".$this->data["id_majane"]."&grupo_id=".$this->data["id"];
	}
	
	public function getTableDeleteLink(){
		return "gruposmajane.php?majane_id=".$this->data["id_majane"]."&delete_id=".$this->data["id"];
	}
	
	public function getMadrijimGrupo($id_majane){
		$grupo_madrijim = new Majane_Grupo();
		$grupo_madrijim->data["id"] = 0;
		$grupo_madrijim->data["id_majane"] = $id_majane;
		$grupo_madrijim->data["nombre"] = "Madrijim";
		$grupo_madrijim->data["aclaracion"] = "Tzevet de Madrijim";
			
		return $grupo_madrijim;
	}
	
	public function delete($id){
		$query = "DELETE from majane_grupo WHERE id = ".$id;
		$this->execQuery($query);
	}
	
	public function save($nombre, $aclaracion, $id_majane){
		$query = "INSERT INTO majane_grupo (nombre, aclaracion, id_majane) VALUES ('".$nombre."', '".$aclaracion."', ".$id_majane.")";
		$this->execQuery($query);
	}
	
	public function update($nombre, $aclaracion, $grupo_id){
		$query = "UPDATE majane_grupo SET nombre = '".$nombre."', aclaracion = '".$aclaracion."' WHERE id = ".$grupo_id;
		echo $query;
		$this->execQuery($query);
	}
}
?>