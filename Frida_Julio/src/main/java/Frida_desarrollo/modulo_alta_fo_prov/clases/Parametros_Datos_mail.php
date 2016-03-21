<?php

class Parametros_Datos_mail{
      private $Host;
      private $Username;
      private $Password;
      private $From;
      private $FromNAme;
      private $Subject;
	  private $alto_body;
	
      public function __construct(
      		$Host="30.45.67.83",
      		$Username="frida@telmex.com",
      		$Password="Fridainfinitum",   
            $From = "frida@telmex.com",
            $FromName = "FRIDA"
       ){
      	$this->Host=$Host;
      	$this->Username=$Username;
      	$this->Password=$Password;
      	$this->From=$From;
      	$this->FromNAme=$FromName;
		
      }
   
      
	public function __set($propiedad,$valor){
	 if (property_exists($this, $propiedad)) {
            $this->$propiedad = $valor;
        }
        else{
        echo "Imposible encotrar parametro";	
        	
        }
	}
	
	
	public function __get($propiedad){
	if (property_exists($this, $propiedad)) {
                return $this->$propiedad;
            }
            else{
            echo "no existe propiedad";	
            }
	}
            


}



?>