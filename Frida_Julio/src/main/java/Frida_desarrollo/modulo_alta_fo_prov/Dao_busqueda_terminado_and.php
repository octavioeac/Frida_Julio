<?php
include 'clases/abs_parametros_terminado_select.php';
include 'Query_impl_busqueda_terminado_and.php';

class busqueda_terminado_and extends abs_parametros_terminado_and{
 
 public function __construct(){
 
 }
  public function encontrar_ref_sisa_and($ref_sisa,$punta){
 	    $parametros_sisa_and=new abs_parametros_terminado_and();
 	    $parametros_sisa_and->setRef_sisa($ref_sisa);
		$parametros_sisa_and->setPunta($punta);
			$query="select * from construccion_fo  where ref_sisa=
			'".strip_tags($parametros_sisa_and->getRef_sisa())."' 
			and 
			punta='".$parametros_sisa_and->getPunta()."' and ref_liquidada='0' and ref_validacion_Telmex='0'";
			
			$query_limpio=(strip_tags($query));            
            $busqueda_and=new Query_impl_busqueda_terminado_and();
            $var=$busqueda_and->IQuery_general($query_limpio);
			 //echo "Hola_var".$var;
			 if($var==""){
				 $estado=false;
				 }
		     else{
				 $estado=true;
				 }
	   
      return $estado;
 	
 }
	
	
}
/*$ref_2="1401-0012"."</br>";
$ref="C03-1401-0012"."</br>";
$punta="A";
$hola = new busqueda_terminado_and();
if($hola->encontrar_ref_sisa_and($ref,$punta)==1){
	echo "Si tengo datos";
	}
else{
	echo "No tengo datos";
	}
*/
?>