<?php 
class Majane_Info extends Base_Class{
	
	protected $attr = array(
		0 => "id",
		1 => "id_majane",
		2 => "informacion",
		3 => "fecha"
	);
	
	protected $table_attr = array(
		0 => "ID",
		2 => "Informacion",
		3 => "Fecha"
	);
	
	public function save($info, $id_majane){
		$query = "INSERT INTO majane_infos (informacion,id_majane, fecha) VALUES ('".$info."',".$id_majane.", CURDATE())";
		$this->execQuery($query);
	}
	
	public function update($info, $info_id){
		$query = "UPDATE majane_infos set informacion = '".$info."' WHERE id = ".$info_id;
		$this->execQuery($query);
	}
	
	public function getInfoByFields($fields, $values, $valuesType){
		$infos =  $this->getInfosByFields($fields, $values, $valuesType);
		if(count($infos) > 0){
			return $infos[0];
		}
		
		return null;
	}
	
	public function getInfosByFields($fields, $values, $valuesType){
		$query = "SELECT * from majane_infos WHERE";
		
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
		
		$query .= " ORDER BY id DESC";
		
		$result = $this->execQuery($query);
		
		$infos = array();
		
		while ($info_row = mysqli_fetch_array($result, MYSQL_NUM)) {
			$info = new Majane_Info();
			$info->convertToClass($info_row);
			array_push($infos, $info);
		}
		
		return $infos;
	}
	
	public function getLastInfo($id_majane){
		$query = "SELECT * from majane_infos WHERE id_majane = ".$id_majane." ORDER BY id DESC LIMIT 1";

		$result = $this->execQuery($query);
		if ($result->num_rows > 0){
			$info = new Majane_Info();
			while ($info_row = mysqli_fetch_array($result, MYSQL_NUM)) {
				$info->convertToClass($info_row);
			}
			return $info;
		}
		
		return null;
	}
	
	public function isTableEditEnable(){
		return true;
	}
	
	public function getTableEditLink(){
		return "vermajaneinfo.php?info_id=".$this->data["id"]."&majane_id=".$this->data['id_majane'];
	}
}
?>