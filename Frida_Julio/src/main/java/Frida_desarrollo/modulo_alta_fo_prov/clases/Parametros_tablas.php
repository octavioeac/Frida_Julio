<?php
class Parametros_tablas{
	private $ref_sisa_1;
	private $punta_1;
	private $tabla_1;
	private $cm_1;
	private $cm_b_1;
	private $a_ant;
	private $b_ant;
    
 
	
	public function __construct(
		$a_ant="siglas_a_ant",
		$b_ant="siglas_b_ant"
		){
		$this->a_ant=$a_ant;	
		$this->b_ant=$b_ant;
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
