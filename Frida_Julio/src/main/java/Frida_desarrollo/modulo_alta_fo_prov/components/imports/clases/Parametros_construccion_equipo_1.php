<?php
class Parametros_construccion_equipo_1
{
    private $ref_sisa;
	private $punta;
	private $arrays=array();
	
	public function __construct(
	    $array_columna=array
		(
"columna_0"=>"id_construccion", 
"columna_1"=>"ref_sisa", 
"columna_2"=>"punta", 
"columna_3"=>"area", 
"columna_4"=>"central_acceso", 
"columna_5"=>"tabla", 
"columna_6"=>"cliente_sisa", 
"columna_7"=>"cliente_comun", 
"columna_8"=>"tipo_movimiento", 
"columna_9"=>"etapa_sisa", 
"columna_10"=>"estatus_ingenieria", 
"columna_11"=>"fecha_estatus_ingenieria", 
"columna_12"=>"const_estatus", 
"columna_13"=>"fecha_const", 
"columna_14"=>"proyecto_estatus", 
"columna_15"=>"fecha_proyecto" 
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