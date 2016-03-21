<?php
class Parametros_fibra_optica_ladenlaces_1
{
    private $ref_sisa;
	private $punta;
	private $arrays=array();
	
	public function __construct(
	    $array_columna=array
		(
"columna_0"=>"id", 
"columna_1"=>"ref_sisa", 
"columna_2"=>"id_nodo", 
"columna_3"=>"consecutivo", 
"columna_4"=>"seccion", 
"columna_5"=>"cable", 
"columna_6"=>"longitud", 
"columna_7"=>"central_a", 
"columna_8"=>"siglas_a", 
"columna_9"=>"central_b", 
"columna_10"=>"siglas_b", 
"columna_11"=>"no_fibras", 
"columna_12"=>"piso_a", 
"columna_13"=>"sala_a", 
"columna_14"=>"fila_a", 
"columna_15"=>"repisa_a", 
"columna_16"=>"remate_a", 
"columna_17"=>"piso_b", 
"columna_18"=>"sala_b", 
"columna_19"=>"fila_b", 
"columna_20"=>"repisa_b", 
"columna_21"=>"remate_b", 
"columna_22"=>"trayectoria", 
"columna_23"=>"tipo_enlace", 
"columna_24"=>"tipo_radio", 
"columna_25"=>"banda_operacion", 
"columna_26"=>"capacidad_enlace", 
"columna_27"=>"proteccion", 
"columna_28"=>"no_seccion", 
"columna_29"=>"ubicaciona", 
"columna_30"=>"fibra_b", 
"columna_31"=>"fibra_a", 
"columna_32"=>"ubicacionb", 
"columna_33"=>"cm_b", 
"columna_34"=>"cm", 
"columna_35"=>"estatus_a", 
"columna_36"=>"observaciones_a", 
"columna_37"=>"fecha_solicitud_a", 
"columna_38"=>"fecha_atencion_a", 
"columna_39"=>"estatus_b", 
"columna_40"=>"observaciones_b", 
"columna_41"=>"fecha_solicitud_b", 
"columna_42"=>"fecha_atencion_b", 
"columna_43"=>"tipo_trayec", 
"columna_44"=>"punta", 
"columna_45"=>"tipo_sel", 
"columna_46"=>"tipo_jumper", 
"columna_47"=>"cap_cable", 
"columna_48"=>"cliente", 
"columna_49"=>"tipo_tras", 
"columna_50"=>"pedido45", 
"columna_51"=>"tipo_cliente", 
"columna_52"=>"indez" 
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