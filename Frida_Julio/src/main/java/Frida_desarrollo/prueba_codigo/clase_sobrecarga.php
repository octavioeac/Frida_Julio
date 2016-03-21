<?php
class Mi_clase_magica{
	private $nombre;
	private $pass;
	private $user; 
	function __construct($pass, $nombre, $user) {
		$this->nombre = $nombre;
		$this->pass = $pass;
		$this->eusermail = $user;
	}
	

	public function __set($var,$valor){
		if(property_exists(__CLASS__, $var)){
		$this->var=$valor;
			
		}
		else{
		echo "No existe el parametro";	
			
		} 
		
	}
	

public function __get($var){
	if (property_exists(__CLASS__, $var)) {
		return $this->$var;
	}
	return NULL;
	
}
	
	
	
} 

$obj = new Mi_clase_magica(1, "objeto1", "prueba1@ejemplo.com");
$obj->nombre = "nombre cambiado";
var_dump(property_exists("Mi_clase_magica", 'pass'));
echo $obj->nombre;//nombre cambiado

?>