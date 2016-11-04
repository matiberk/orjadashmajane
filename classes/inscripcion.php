<?php 
class Inscripcion extends Base_Class{
	
	protected $table_attr = array(
		0 => "ID",
		3 => "Nombre",
		4 => "Apellido",
		5 => "Nacimiento",
		6 => "DNI",
		7 => "Direccion",
		8 => "Localidad",
		9 => "Edad",
		10 => "Telefono",
		11 => "Grupo",
		12 => "Email",
		13 => "Madrijim",
		14 => "Nombre Padres",
		15 => "Apellido Padres",
		16 => "DNI Padres",
		17 => "Email Padres",
		18 => "Celular Padres",
		19 => "Parentesco",
		20 => "Obra Social",
		21 => "Obra Social Plan",
		22 => "Numero de Socio",
		23 => "Obra Social Telefono",
		24 => "Alergias",
		25 => "Alergias Cuales",
		26 => "Dietas",
		27 => "Dietas Cuales",
		28 => "Vacunacion",
		29 => "Medicacion Regular",
		30 => "Medicacion Regular Cuales",
		31 => "Medicacion Contraindicada",
		32 => "Elementos Medicos",
		33 => "Elementos Medicos Cuales",
		34 => "Dolor Cabeza",
		35 => "Dolor Cabeza Dosis",
		36 => "Usar Paratropina",
		37 => "Paratropina Dosis",
		38 => "Observaciones"
	);
	
	protected $attr = array(
		0 => "id",
		1 => "id_majane",
		2 => "id_janij",
		3 => "nombre",
		4 => "apellido",
		5 => "nacimiento",
		6 => "dni",
		7 => "direccion",
		8 => "localidad",
		9 => "edad",
		10 => "telefono",
		11 => "grupo",
		12 => "email",
		13 => "madrijim",
		14 => "nombre_padres",
		15 => "apellido_padres",
		16 => "dni_padres",
		17 => "email_padres",
		18 => "celular_padres",
		19 => "parentesco",
		20 => "obra_social",
		21 => "obra_social_plan",
		22 => "numero_socio",
		23 => "obra_social_telefono",
		24 => "alergias",
		25 => "alergias_cuales",
		26 => "dietas",
		27 => "dietas_cuales",
		28 => "vacunacion",
		29 => "medicacion_regular",
		30 => "medicacion_regular_cuales",
		31 => "medicacion_contraindicada",
		32 => "elementos_medicos",
		33 => "elementos_medicos_cuales",
		34 => "dolor_cabeza",
		35 => "dolor_cabeza_dosis",
		36 => "usar_paratropina",
		37 => "usar_paratropina_dosis",
		38 => "observaciones",
		39 => "confirmado"
	);
	
	public function __construct(){
		parent::__construct();
		
		foreach($this->attr as $key => $value){
			$this->data[$value] = "";
		}
	}
	
	public function convertFromRequest($requestData){
		$generalInformation = $requestData["generalInformation"];
		$parentInformation = $requestData["parentInformation"];
		$medicalInformation = $requestData["medicalInformation"];
		
		foreach($generalInformation as $key => $value){
			$this->data[$key] = $value;
		}			
		
		foreach($parentInformation as $key => $value){
			$this->data[$key] = $value;
		}			
		
		foreach($medicalInformation as $key => $value){
			$this->data[$key] = $value;
		}			
		
		$this->data["id_majane"] = $requestData["majaneid"];
	}
	
	public function save(){
		$query = "INSERT INTO inscripcion_majane (id_majane, id_janij, nombre, apellido, nacimiento, dni, direccion, localidad, edad, telefono, grupo, email, madrijim, nombre_padres, apellido_padres, dni_padres, email_padres, celular_padres, parentesco, obra_social, obra_social_plan, numero_socio, obra_social_telefono, alergias, alergias_cuales, dietas, dietas_cuales, vacunacion, medicacion_regular, medicacion_regular_cuales, medicacion_contraindicada, elementos_medicos, elementos_medicos_cuales, dolor_cabeza, dolor_cabeza_dosis, usar_paratropina, usar_paratropina_dosis, observaciones, confirmado) VALUES (";
		$query.= $this->data["id_majane"];
		$query.= ",".$this->data["id_janij"];
		$query.= ",'".$this->data["nombre"]."'";
		$query.= ",'".$this->data["apellido"]."'";
		$query.= ",'".$this->data["nacimiento"]."'";
		$query.= ",'".$this->data["dni"]."'";
		$query.= ",'".$this->data["direccion"]."'";
		$query.= ",'".$this->data["localidad"]."'";
		$query.= ",".$this->data["edad"];
		$query.= ",'".$this->data["telefono"]."'";
		$query.= ",".$this->data["grupo"];
		$query.= ",'".$this->data["email"]."'";
		$query.= ",'".$this->data["madrijim"]."'";
		$query.= ",'".$this->data["nombre_padres"]."'";
		$query.= ",'".$this->data["apellido_padres"]."'";
		$query.= ",'".$this->data["dni_padres"]."'";
		$query.= ",'".$this->data["email_padres"]."'";
		$query.= ",'".$this->data["celular_padres"]."'";
		$query.= ",'".$this->data["parentesco"]."'";
		$query.= ",'".$this->data["obra_social"]."'";
		$query.= ",'".$this->data["obra_social_plan"]."'";
		$query.= ",'".$this->data["numero_socio"]."'";
		$query.= ",'".$this->data["obra_social_telefono"]."'";
		$query.= ",".$this->data["alergias"];
		$query.= ",'".$this->data["alergias_cuales"]."'";
		$query.= ",".$this->data["dietas"];		
		$query.= ",'".$this->data["dietas_cuales"]."'";
		$query.= ",".$this->data["vacunacion"];
		$query.= ",".$this->data["medicacion_regular"];
		$query.= ",'".$this->data["medicacion_regular_cuales"]."'";
		$query.= ",'".$this->data["medicacion_contraindicada"]."'";
		$query.= ",".$this->data["elementos_medicos"];
		$query.= ",'".$this->data["elementos_medicos_cuales"]."'";
		$query.= ",'".implode(",", $this->data["dolor_cabeza"])."'";
		$query.= ",'".$this->data["dolor_cabeza_dosis"]."'";
		$query.= ",".$this->data["usar_paratropina"];
		$query.= ",'".$this->data["usar_paratropina_dosis"]."'";
		$query.= ",'".$this->data["observaciones"]."'";
		$query.= ",0";
		$query.= ")";
		
		$this->execQuery($query);
	}
	
	public function isTableEditEnable(){
		return false;
	}
		
	public function getLastInscripcion($id_janij){
		$query = "SELECT * from inscripcion_majane WHERE id_janij = ".$id_janij." ORDER BY id DESC LIMIT 1";

		$result = $this->execQuery($query);
		if ($result->num_rows > 0){
			$inscripcion_majane = new Inscripcion();
			while ($inscripcion_row = mysqli_fetch_array($result, MYSQL_NUM)) {
				$inscripcion_majane->convertToClass($inscripcion_row);
			}
			return $inscripcion_majane;
		}
		
		return null;
	}
	
	public function getInscripcionesByFields($fields, $values, $valuesType){
		$query = "SELECT * from inscripcion_majane WHERE";
		
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
		
		$inscripciones = array();
		
		while ($inscripcion_row = mysqli_fetch_array($result, MYSQL_NUM)) {
			$inscripcion = new Inscripcion();
			$inscripcion->convertToClass($inscripcion_row);
			array_push($inscripciones, $inscripcion);
		}
		
		return $inscripciones;
	}
	
	public function getInscriptionByFields($fields, $values, $valuesType){
		$inscripciones = $this->getInscripcionesByFields($fields, $values, $valuesType);
		if (count($inscripciones) > 0){
			return $inscripciones[0];
		}
		return null;
	}
	
	public function confirmarInscripto(){
		$query = "UPDATE inscripcion_majane SET confirmado = 1 WHERE id = ".$this->data["id"];
		$this->execQuery($query);
		
                $from = "info@orjadashmajane.esy.es";
                $fromName = "Or-Jadash Majane Informaciones";

		$to      = $this->data["email"];
		$subject = 'Confirmacion de Inscripcion al Majane';
		$message = '
                <html>
                   <head>
                        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
                   <head>
                   <body>
                        <p>Se ha confirmado la inscripcion al majane de '.$this->data["nombre"].' '.$this->data["apellido"].' de manera exitosa</p>
                        <p>No te olvides de traer la autorizacion firmada para completar el proceso de inscripcion!</p>
                        <p>Y... A disfrutar de un gran majane!!!!!!!!!!!!
                   </body>
                </html>';

                $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                $headers .= "From: \"".$fromName."\" <".$from.">\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "X-Mailer: PHP/" . phpversion();

		mail($to, $subject, $message, $headers);
	}
	
	public function parseDataToRow(){
		$parsedData = parent::parseDataToRow();
		
		$parsedData["alergias"] = $this->getBoolValue($parsedData["alergias"]);
		$parsedData["dietas"] = $this->getBoolValue($parsedData["dietas"]);
		$parsedData["elementos_medicos"] = $this->getBoolValue($parsedData["elementos_medicos"]);
		$parsedData["vacunacion"] = $this->getBoolValue($parsedData["vacunacion"]);
		$parsedData["medicacion_regular"] = $this->getBoolValue($parsedData["medicacion_regular"]);
		$parsedData["usar_paratropina"] = $this->getBoolValue($parsedData["usar_paratropina"]);
		
		
		$parsedData["alergias_cuales"] = $this->getSpecifictValue($parsedData["alergias"], $parsedData["alergias_cuales"]);
		$parsedData["dietas_cuales"] = $this->getSpecifictValue($parsedData["dietas"], $parsedData["dietas_cuales"]);
		$parsedData["elementos_medicos_cuales"] = $this->getSpecifictValue($parsedData["elementos_medicos"], $parsedData["elementos_medicos_cuales"]);
		$parsedData["medicacion_regular_cuales"] = $this->getSpecifictValue($parsedData["medicacion_regular"], $parsedData["medicacion_regular_cuales"]);
		$parsedData["usar_paratropina_dosis"] = $this->getSpecifictValue($parsedData["usar_paratropina"], $parsedData["usar_paratropina_dosis"]);
		
		$majane = new Majane();
		$majane = $majane->getMajaneByFields(["id"], [$this->data["id_majane"]], ["int"]);
		$majaneGroups = $majane->getMajaneGroups();
		foreach($majaneGroups as $key => $majaneGroup){
			if($majaneGroup->data["id"] == $this->data["grupo"]){
				$parsedData["grupo"] = $majaneGroup->data["nombre"];
			}
		}	
		
		return $parsedData;
	}
	
	public function getBoolValue($value){
		if($value == "1"){
			return "Si";
		}
		
		return "No";
	}
	
	public function getSpecifictValue($boolValue, $specificValue){
		if($boolValue == "1"){
			return $specificValue;
		}
		
		return "-";
	}
}
?>	