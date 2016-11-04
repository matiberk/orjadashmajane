<?php
class Hanala extends Base_Class{
	
	protected $attr = array(
		0 => "id",
		1 => "usuario",
		2 => "password"
	);
	
	public function getHanalaByField($fields, $values, $valuesType){
		$query = "SELECT * from hanala WHERE";
		
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
			$hanala = new Hanala();
			while ($hanala_row = mysqli_fetch_array($result, MYSQL_NUM)) {
				$hanala->convertToClass($hanala_row);
			}
			return $hanala;
		}
		
		return null;
	}
}
?>