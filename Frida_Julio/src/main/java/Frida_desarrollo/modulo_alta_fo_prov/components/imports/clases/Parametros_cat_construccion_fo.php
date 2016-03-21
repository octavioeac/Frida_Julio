<?php
class Parametros_cat_construccion_fo
{
    private $ref_sisa;
	private $punta;
	private $arrays=array();
	
	public function __construct(
	    $array_columna=array
		(
"columna_0"=>"id_fo", 
"columna_1"=>"combo_fo", 
"columna_2"=>"rubro_fo" 
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