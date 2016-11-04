<?php 
class Base_Class extends Data_Base_Conn{	
	public function __construct(){
	}
	
	public function execQuery($query){
		$this->DB_CONNECTION = mysqli_connect($this->server, $this->server_user, $this->server_password);
		$this->conn = mysqli_select_db($this->DB_CONNECTION, $this->DB_NAME) or die(mysqli_error($this->DB_CONNECTION));
		$this->DB_CONNECTION->set_charset("utf8");
		
		return mysqli_query($this->DB_CONNECTION,$query);
		
		mysqli_close();
	}
	
	public function convertToClass($row){
		foreach($row as $key => $value){
			$attr_name = $this->attr[$key];
			$this->data[$attr_name] = $value;
		}
	}
	
	public function getAttributesList(){
		return $this->attr;
	}
	
	public function getTableAttributesList(){
		return $this->table_attr;
	}
	
	public function parseDataToRow(){
		$parsedData = array();
		foreach($this->table_attr as $key => $table_attr){
			$parsedData[$this->attr[$key]] = $this->data[$this->attr[$key]];
		}
		
		if ($this->isTableEditEnable()){
			$parsedData["edit"] = "<a href='".$this->getTableEditLink()."' class='editLink'>Editar</a>";
		}
		
		if ($this->isTableDeleteEnable()){
			$parsedData["delete"] = "<a href='".$this->getTableDeleteLink()."' class='deleteLink'>Eliminar</a>";
		}
		
		return $parsedData;
	}
	
	public function isTableEditEnable(){
		return true;
	}
	
	public function isTableDeleteEnable(){
		return false;
	}
}
?>