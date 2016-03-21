<?php
class Parametros_siatel_str_ztmps08t003_pedido_1
{
    private $ref_sisa;
	private $punta;
	private $arrays=array();
	
	public function __construct(
	    $array_columna=array
		(
"columna_0"=>"pdcebe", 
"columna_1"=>"pddiv", 
"columna_2"=>"pdcodfam", 
"columna_3"=>"pdllave", 
"columna_4"=>"pddoccomp", 
"columna_5"=>"pdpos46", 
"columna_6"=>"pdpep", 
"columna_7"=>"pdpe45", 
"columna_8"=>"pdpos45", 
"columna_9"=>"pdliber", 
"columna_10"=>"pdborrado", 
"columna_11"=>"pdult_mod", 
"columna_12"=>"pdf_entreg", 
"columna_13"=>"pddescmat", 
"columna_14"=>"pdmat", 
"columna_15"=>"pdprov", 
"columna_16"=>"pdnomprov", 
"columna_17"=>"pdnum_nec", 
"columna_18"=>"pdunidade1", 
"columna_19"=>"pdunimed", 
"columna_20"=>"pdvalneto1", 
"columna_21"=>"pdmoneda", 
"columna_22"=>"pdtipocam1", 
"columna_23"=>"pdsolped", 
"columna_24"=>"pdposped", 
"columna_25"=>"pddocmat1", 
"columna_26"=>"pdcant1", 
"columna_27"=>"pdtipo1", 
"columna_28"=>"pddocmat2", 
"columna_29"=>"pdcant2", 
"columna_30"=>"pdtipo2", 
"columna_31"=>"pddocmat3", 
"columna_32"=>"pdcant3", 
"columna_33"=>"pdtipo3", 
"columna_34"=>"pddocmat4", 
"columna_35"=>"pdcant4", 
"columna_36"=>"pdtipo4", 
"columna_37"=>"pddocmat5", 
"columna_38"=>"pdcant5", 
"columna_39"=>"pdtipo5", 
"columna_40"=>"pddocmat6", 
"columna_41"=>"pdcant6", 
"columna_42"=>"pdtipo6", 
"columna_43"=>"pddocmat7", 
"columna_44"=>"pdcant7", 
"columna_45"=>"pdtipo7", 
"columna_46"=>"pddocmat8", 
"columna_47"=>"pdcant8", 
"columna_48"=>"pdtipo8", 
"columna_49"=>"pddocmat9", 
"columna_50"=>"pdcant9", 
"columna_51"=>"pdtipo9", 
"columna_52"=>"pddocmat10", 
"columna_53"=>"pdcant10", 
"columna_54"=>"pdtipo10", 
"columna_55"=>"pddocmat11", 
"columna_56"=>"pdcant11", 
"columna_57"=>"pdtipo11", 
"columna_58"=>"pddocmat12", 
"columna_59"=>"pdcant12", 
"columna_60"=>"pdtipo12", 
"columna_61"=>"pddocmat13", 
"columna_62"=>"pdcant13", 
"columna_63"=>"pdtipo13", 
"columna_64"=>"pddocmat14", 
"columna_65"=>"pdcant14", 
"columna_66"=>"pdtipo14", 
"columna_67"=>"pddocmat15", 
"columna_68"=>"pdcant15", 
"columna_69"=>"pdtipo15", 
"columna_70"=>"pddocmat16", 
"columna_71"=>"pdcant16", 
"columna_72"=>"pdtipo16", 
"columna_73"=>"pddocmat17", 
"columna_74"=>"pdcant17", 
"columna_75"=>"pdtipo17", 
"columna_76"=>"pddocmat18", 
"columna_77"=>"pdcant18", 
"columna_78"=>"pdtipo18", 
"columna_79"=>"pddocmat19", 
"columna_80"=>"pdcant19", 
"columna_81"=>"pdtipo19", 
"columna_82"=>"pddocmat20", 
"columna_83"=>"pdcant20", 
"columna_84"=>"pdtipo20" 
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