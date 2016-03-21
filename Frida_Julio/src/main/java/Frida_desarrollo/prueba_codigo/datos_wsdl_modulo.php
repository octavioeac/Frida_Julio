<?php

class prueba_wsdl 
{
	     private $imt;
		private $bastRemate;
		private $clliEdificio;
		private $clliSistema;
		private $contactoRemate;
		private $descripcionEdificio;
		private $descripcionSistema;
		private $dispositivo;
		private $fechaAsignacion;
		private $filaRemate;
		private $ladoFilaRemate;
		private $lserrores;
		private $moduloDip;
		private $opc;
		private $opertel;
		private $pisoRemate;
		private $razonSocial;
        private $referenciaSisa;
		private $repisaRemate;
 		private $salaRemate;
        private $serie;
		private $sestatus;
    	private $sigla;
	
	public function __construct(
	    $imt=NULL,
		$bastRemate=NULL,
		$clliEdificio=NULL,
		$clliSistema=NULL,
		$contactoRemate=NULL,
		$descripcionEdificio=NULL,
		$descripcionSistema=NULL,
		$dispositivo=NULL,
		$fechaAsignacion=NULL,
		$filaRemate=NULL,
		$ladoFilaRemate=NULL,
		$lserrores=NULL,
		$moduloDip=NULL,
		$opc=NULL,
		$opertel=NULL,
		$pisoRemate=NULL,
		$razonSocial=NULL,
    	$referenciaSisa=NULL,
		$repisaRemate=NULL,
		$salaRemate=NULL,
    	$serie=NULL,
		$sestatus=NULL,
    	$sigla=NULL
		){ 
		$this->imt=$imt;
		$this->bastRemate=$bastRemate;
		$clliEdificio->clliEdificio=$clliEdificio;
		$clliSistema->clliSistema=$clliSistemaimt;
		$this->contactoRemate=$contactoRemate;
		$this->descripcionEdificio=$descripcionEdificio;
		$this->descripcionSistema=$descripcionSistema;
		$this->dispositivo=$dispositivo;
		$this->fechaAsignacion=$fechaAsignacion;
		$this->filaRemate=$filaRemate;
		$this->ladoFilaRemate=$ladoFilaRemate;
		$this->lserrores=$lserrores;
		$this->moduloDip=$moduloDip;
		$this->opc=$opc;
		$this->opertel=$opertel;
		$this->pisoRemate=$pisoRemate;
		$this->razonSocial=$razonSocial;
		$this->referenciaSisa=$referenciaSisa;
		$this->repisaRemate=$repisaRemate;
		$this->salaRemate=$salaRemate;
		$this->serie=$serie;
		$this->sestatus=$sestatus;
		$this->sigla=$sigla;
		
		} 
	
	public static function wsdl($ref_sisa,$wsdl){
	                 	 try {
							 
					
							      
					$cliente= new SoapClient( $wsdl,array('features' => SOAP_SINGLE_ELEMENT_ARRAYS));                                         $para=array(
					 "arg0"=>$ref_sisa);
					 
					 $para_2=array(
					 "arg0"=>array(
					      "referenciaSisa"=>$ref_sisa
						  )
						  );
					
                      
				    $result=$cliente->ConsultaReferenciaSisa($para_2);
				    $datos_obtener=prueba_wsdl::xml2array($result);
					
		$obj_clave=new prueba_wsdl();
		$obj_clave->bastRemate=$datos_obtener['bastRemate'];
		$obj_clave->clliEdificio=$datos_obtener['clliEdificio'];
		$obj_clave->clliSistema=$datos_obtener['clliSistema'];
		$obj_clave->contactoRemate=$datos_obtener['contactoRemate'];
		$obj_clave->descripcionEdificio=$datos_obtener['descripcionEdificio'];
		$obj_clave->descripcionSistema=$datos_obtener['descripcionSistema'];
		$obj_clave->dispositivo=$datos_obtener['dispositivo'];
		$obj_clave->fechaAsignacion=$datos_obtener['fechaAsignacion'];
		$obj_clave->filaRemate=$datos_obtener['filaRemate'];
		$obj_clave->imt=$datos_obtener['imt'];
		$obj_clave->ladoFilaRemate=$datos_obtener['ladoFilaRemate'];
		$obj_clave->lserrores=(array)$datos_obtener['lserrores'];
		$obj_clave->moduloDip=$datos_obtener['moduloDip'];
		$obj_clave->opc=$datos_obtener['opc'];
		$obj_clave->opertel=$datos_obtener['opertel'];
		$obj_clave->pisoRemate=$datos_obtener['pisoRemate'];
		$obj_clave->razonSocial=$datos_obtener['razonSocial'];
        $obj_clave->referenciaSisa=$datos_obtener['referenciaSisa'];
		$obj_clave->repisaRemate=$datos_obtener['repisaRemate'];
 		$obj_clave->salaRemate=$datos_obtener['salaRemate'];
        $obj_clave->serie=$datos_obtener['serie'];
		$obj_clave->sestatus=$datos_obtener['sestatus'];
    	$obj_clave->sigla=$datos_obtener['sigla'];
					
					
					if(count($obj_clave->lserrores)==0){
						$obj_clave->lserrores=NULL;
						}
      
										  $respuesta_wsdl=array(
										     "bastRemate"=>trim($obj_clave->bastRemate),
                                			"clliEdificio"=>trim($obj_clave->clliEdificio),
											"clliSistema"=>trim($obj_clave->clliSistema),
											"contactoRemate"=>trim($obj_clave->contactoRemate),
											"descripcionEdificio"=>rtrim($obj_clave->descripcionEdificio),
											"descripcionSistema"=>rtrim($obj_clave->descripcionSistema),
											"dispositivo"=>trim($obj_clave->dispositivo),
											"fechaAsignacion"=>trim($obj_clave->fechaAsignacion),
											"filaRemate"=>trim($obj_clave->filaRemate),
											"imt"=>trim($obj_clave->imt),
											"ladoFilaRemate"=>trim($obj_clave->ladoFilaRemate),
											"lserrores"=>$obj_clave->lserrores,
											"moduloDip"=>trim($obj_clave->moduloDip),
											"opc"=>trim($obj_clave->opc),
											"opertel"=>trim($obj_clave->opertel),
											"pisoRemate"=>trim($obj_clave->pisoRemate),
											"razonSocial"=>rtrim($obj_clave->razonSocial),
											"referenciaSisa"=>trim($obj_clave->referenciaSisa),
											"repisaRemate"=>trim($obj_clave->repisaRemate),
											"salaRemate"=>trim($obj_clave->salaRemate),
											"serie"=>trim($obj_clave->serie),
											"sestatus"=>trim($obj_clave->sestatus),
											"sigla"=>trim($obj_clave->sigla)   
					  					                 );
														 
							
										
									
								$obj_limpiar=new prueba_wsdl();
                                $obj_limpi_array=$obj_limpiar->limpia_array($respuesta_wsdl);	
								return $obj_limpi_array;
					
	   								} 
									catch ( SoapFault $fault ) {

					        		}
									
	                     }
			
public static function xml2array($xml) {
   foreach ($xml as $element) {
    $e = get_object_vars($element);
	}

  return $e;
}

	
	
	public function limpia_array($mi_array)
	{
		
		foreach($mi_array as $item =>$value)
		{
    		   if(is_string($value)){
					 if($value=='' || $value=='ERROR'){
							if(is_string($value)){   
							$mi_array[$item]=NULL;
							 }
					 }
				if(is_array($value)){
					echo "HOLA ARRAY";
					$num_value=count($value);
					echo $num_value;
					}	 
		       }
												
		
		}
		
		return $mi_array;									
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
header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
header('Content-type: application/json');
$wsdl="http://10.192.2.74:8082/infofrida/webservices/sistemaFridaRedTroncal?wsdl";
//$_POST['referencia_sisa']="TKS-1211-0295";
//$_POST['referencia_sisa']="TKS-9810-0063";

$obj_json=prueba_wsdl::wsdl($_POST['referencia_sisa'],$wsdl);
$json_array=json_encode($obj_json);
echo strip_tags($json_array);
							   	










 ?>
