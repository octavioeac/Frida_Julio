<?php
include 'clases/abs_parametros.php';
include 'Query_impl.php';

class busqueda_archvoDao extends abs_parametros{
 
 public function __construct(){
 
 }
  public function encontrar_ref_sisa($ref_sisa,$punta,$trafico){
 	    $parametros_sisa=new abs_parametros();
 	    $parametros_sisa->setRef_sisa($ref_sisa);
 	    $parametros_sisa->setTrafico($trafico);
			$query="select * from bitacora_archivos 
			where referencia='".strip_tags($parametros_sisa->getRef_sisa())."' 
			and 
			trafico='".$parametros_sisa->getTrafico()."'";
			$query_limpio=(strip_tags($query));            
            $busqueda=new Query_imp();
            $var=$busqueda->IQuery_general($query_limpio);
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
$trafico="PROYECTO_FO";
$punta="";
$hola = new busqueda_archvoDao();
if($hola->encontrar_ref_sisa($ref,$punta,$trafico)==1 && $_SESSION['usr']=="KBTEL"){
	echo "Si tengo datos";
	}
else{
	echo "No tengo datos";
	}*/

?>