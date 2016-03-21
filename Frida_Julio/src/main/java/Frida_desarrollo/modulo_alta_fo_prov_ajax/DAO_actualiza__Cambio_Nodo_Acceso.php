<?php
include 'clases/abs_parametros_2.php';
include 'Query_update_Cambio_De_Nodo.php';
include 'Dao_select__cambio_nodo.php';
class DAO_actualiza_cambio_nodo extends abs_parametros_2{
 
 public function __construct(){
 
 }
  public  static function actualizar_ref_sisa_Acceso_Nodo($ref_sisa,$tabla,$punta){
 	    $parametros_sisa_repisa=new abs_parametros_2();
		$parametros_sisa_repisa->setRef_sisa($ref_sisa);
		$parametros_sisa_repisa->setPunta($punta);
         $columnas_tabla=Mysql_cambio_nodo::select_cambio_nodo($parametros_sisa_repisa->getRef_sisa(),
		 $parametros_sisa_repisa->getPunta(),
		 $tabla);
		if($tabla!="adva"){
		
    $query="update ".$tabla." set ch_aproy='POR ELABORAR', estatus_proyecto_fo";
	if ($parametros_sisa_repisa->getPunta()=="B")
	{
		$query.="_b";
	}
	$query.="='CAMBIO NODO ACCESO' ,"
	.$columnas_tabla['columna_a_ant']."='".$columnas_tabla['cm']."',"
    .$columnas_tabla['columna_b_ant']."='".$columnas_tabla['cm_b']."'
	 where ref_sisa='".strip_tags($parametros_sisa_repisa->getRef_sisa())."'";
			$query_limpio=(strip_tags($query));            
            $busqueda_terminar=new Query_update_Cambio_De_Nodo();
            $var=$busqueda_terminar->Idao_nodo_acceso_update($query_limpio);
     		 if($var!=1){
				 $estado=false;
				 }
		     else{
				 $estado=true;
				 }
		}
      return $estado;
 	
 }

}



/*$ref_sisa='D32-0708-0515';
$punta="A";
$tablas="ciudad_segura";


$obj_class=DAO_actualiza_cambio_nodo::actualizar_ref_sisa_Acceso_Nodo($ref_sisa,$tablas,$punta);
*/

?>