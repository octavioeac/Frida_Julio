<?php
class Parametros_cat_tecnicos
{
    private $ref_sisa;
	private $punta;
	private $arrays=array();
	
	public function __construct(
	    $array_columna=array
		(
"columna_0"=>"id_tecnico", 
"columna_1"=>"nombre", 
"columna_2"=>"area", 
"columna_3"=>"puesto", 
"columna_4"=>"iniciales", 
"columna_5"=>"telefono", 
"columna_6"=>"email", 
"columna_7"=>"email_sucope", 
"columna_8"=>"supervisor", 
"columna_9"=>"sucope", 
"columna_10"=>"goa", 
"columna_11"=>"subgerente", 
"columna_12"=>"division" 
   ),
		$ref_sisa="ref_sisa",
		$punta="punta"	
	                             )
		{
		$this->arrays=$array_columna;
		$this->ref_sisa=$ref_sisa;
		$this->punta=$punta;
     	}
 
 
    public function __set($parametro,$valor)
	{
 	      if (property_exists($this, $parametro)) 
		  {
 		$this->$parametro = $valor;
 	      }
 	else{
 		echo "Imposible encotrar parametro";
 		 }
	}
 

    public function __get($parametro)
	{
 	 	if (property_exists($this, $parametro)) 
		{
 		return $this->$parametro;
 		}
	 	else
		{
 		echo "no existe propiedad";
 		}
 	}
 
 
 
}

?>