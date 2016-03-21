<?php
class Parametros_tablas{
	private $ref_sisa_1;
	private $punta_1;
	private $tabla_1;
       
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
