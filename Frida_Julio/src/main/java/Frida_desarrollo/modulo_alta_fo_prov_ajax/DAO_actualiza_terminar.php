<?php
include 'clases/abs_parametros_terminado.php';
include 'Query_update_terminar_Imp.php';

class DAO_actualiza_terminar extends abs_parametros_terminado{
 
 public function __construct(){
 
 }
  public function actualizar_ref_sisa_terminar($ref_sisa,$punta,$terminar,$valor){
 	    $parametros_sisa_terminar=new abs_parametros_terminado();
 	    $parametros_sisa_terminar->setRef_sisa($ref_sisa);
		$parametros_sisa_terminar->setTerminado($terminar);
		$parametros_sisa_terminar->setPunta($punta);
		 if($terminar=="liquidada"){
			$columna="ref_liquidada";
			}
		 if($terminar=="validada"){
			$columna="ref_validacion_Telmex";
			}  
			$query="update construccion_fo set ".$columna."='".$valor."' 
			where ref_sisa='".strip_tags($parametros_sisa_terminar->getRef_sisa())."' 
			and 
			punta='".$parametros_sisa_terminar->getPunta()."'";
			echo $query;
			$query_limpio=(strip_tags($query));            
            $busqueda_terminar=new Query_update_terminar_Imp();
            $var=$busqueda_terminar->Idao_update_liquidacion($query_limpio,$termina);
			 if($var!=1){
				 $estado=false;
				 }
		     else{
				 $estado=true;
				 }
	   
      return $estado;
 	
 }
	
	
}//
//$ref_2="1401-0012"."</br>";
//$ref="C03-1401-0012"."</br>";
//$terminar="liquidada";
//$terminar_2="validada";
//$punta="A";
//$valor="1";
//$hola = new DAO_actualiza_terminar();
//$hola->actualizar_ref_sisa_terminar($ref_2,$punta,$terminar_2,$valor);
//print_r($hola);
?>