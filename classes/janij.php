<?php 
class Janij extends Base_Class{
	
	protected $attr = array(
		0 => "id",
		1 => "nombre",
		2=> "apellido",
		3 => "dni"
	);
	
	public function getJanijByFields($fields, $values, $valuesType){
		$query = "SELECT * from janij WHERE";
		
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
		if ($result){
			$janij = new Janij();
			while ($janij_row = mysqli_fetch_array($result, MYSQL_NUM)) {
				$janij->convertToClass($janij_row);
			}
			return $janij;
		}
		
		return null;
	}
	
	public function createJanij($dni, $userName, $userLastName){
		$query = "INSERT INTO janij (dni, nombre, apellido) values(".$dni.", '".$userName."', '".$userLastName."')";
		$result = $this->execQuery($query);
		
		if ($result){
			$newJanij = new Janij();
			$newJanij = $this->getJanijByFields(["dni"], [$dni], ["int"]);
			return $newJanij;
		}
		
		return null;
	}
}
?>