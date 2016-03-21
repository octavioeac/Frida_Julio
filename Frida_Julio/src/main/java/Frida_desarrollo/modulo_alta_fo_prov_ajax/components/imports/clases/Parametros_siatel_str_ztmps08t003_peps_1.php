<?php
class Parametros_siatel_str_ztmps08t003_peps_1
{
    private $ref_sisa;
	private $punta;
	private $arrays=array();
	
	public function __construct(
	    $array_columna=array
		(
"columna_0"=>"ppsoc", 
"columna_1"=>"ppdiv", 
"columna_2"=>"ppdef_proy", 
"columna_3"=>"ppproyecto", 
"columna_4"=>"ppn_modif", 
"columna_5"=>"ppllave2", 
"columna_6"=>"pppep", 
"columna_7"=>"ppnivel", 
"columna_8"=>"ppdesc", 
"columna_9"=>"ppclase", 
"columna_10"=>"pprubro", 
"columna_11"=>"ppcodlugar", 
"columna_12"=>"ppcentral", 
"columna_13"=>"ppcent_cos", 
"columna_14"=>"ppuni", 
"columna_15"=>"ppfpc", 
"columna_16"=>"ppfei", 
"columna_17"=>"ppfet", 
"columna_18"=>"ppfpi", 
"columna_19"=>"ppfpt", 
"columna_20"=>"ppfri", 
"columna_21"=>"ppfrt", 
"columna_22"=>"ppsiglas", 
"columna_23"=>"ppcebe", 
"columna_24"=>"ppcod_fam", 
"columna_25"=>"pppos_im", 
"columna_26"=>"pstatus", 
"columna_27"=>"estatus_gra", 
"columna_28"=>"pedido_listo" 
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