<?php
include 'clases/abs_parametros.php';
include 'Query_impl _Tipo_Trayectoria.php';

class busqueda_tipo_trayect extends abs_parametros{
 
 public function __construct(){
 
 }
  public static function encontrar_trayectoria_ref_sisa($ref_sisa,$punta,$trafico){
 	    $parametros_sisa=new abs_parametros();
 	    $parametros_sisa->setRef_sisa($ref_sisa);
        $parametros_sisa->setPunta($punta); 
			$query="select * from fibra_optica_ladenlaces 
			where ref_sisa='".strip_tags($parametros_sisa->getRef_sisa())."' 
			and 
			punta='".$parametros_sisa->getPunta()."'";
			$query_limpio=(strip_tags($query));            
            $busqueda=new Query_imp_trayectoria();
            $var=$busqueda->IQuery_general($query_limpio);
			// echo $var;
		    return $var;
 	
 }
	
	
}
/*$ref_2="1401-0012"."</br>";
$ref="C03-1401-0012"."</br>";
$trafico="PROYECTO_FO";
$punta="A";
 $obj_trafico_tipo=busqueda_tipo_trayect::encontrar_trayectoria_ref_sisa($ref,$punta,$trafico);
echo $obj_trafico_tipo;

*/
?>