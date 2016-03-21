<?php
include 'clases/abs_parametros.php';
include 'Query_update_repisa_update_Imp.php';

class DAO_actualiza_ladaEnlaces extends abs_parametros{
 
 public function __construct(){
 
 }
  public  static function actualizar_ref_sisa_ladaEnlace($ref_sisa,$punta,$repisa,$tipo_trabajo){
 	    $parametros_sisa_repisa=new abs_parametros();
		$parametros_sisa_repisa->setRef_sisa($ref_sisa);
		$parametros_sisa_repisa->setPunta($punta);
	    $dao_obj=DAO_actualiza_ladaEnlaces::tipo_trabajo($tipo_trabajo);

		 if($parametros_sisa_repisa->getPunta()=="A"){
			$columna="repisa_a";
			}
		 if($parametros_sisa_repisa->getPunta()=="B"){
			$columna="repisa_b";
			}  
			$query="update fibra_optica_ladenlaces set ".$columna."='".$repisa."' 
			where ref_sisa='".strip_tags($parametros_sisa_repisa->getRef_sisa())."' 
			and 
			tipo_trayec='".$dao_obj."'";
		//echo $query;
			$query_limpio=(strip_tags($query));            
            $busqueda_terminar=new Query_update_terminar_Imp();
            $var=$busqueda_terminar->IQuery_general_repisa($query_limpio);
     		 if($var!=1){
				 $estado=false;
				 }
		     else{
				 $estado=true;
				 }
	   
      return $estado;
 	
 }
public static function tipo_trabajo($tipo_trabajo){
	$parametro_tipo_trabajo=new abs_parametros();
	$parametro_tipo_trabajo->setTipo_TRabajo($tipo_trabajo);
//	echo $parametro_tipo_trabajo->getTipo_TRabajo();
		switch ($parametro_tipo_trabajo->getTipo_TRabajo()) {
    case "fo_clit_ubi_1":
        $trabajo='CLIENTE (TRABAJO)';
        break;
    case "fo_cent_ubi_1":
         $trabajo='CENTRAL (TRABAJO)';
        break;
    case "fo_clir_ubi_1":
      $trabajo='CLIENTE (RESPALDO)';
        break;
	case "fo_cenr_ubi_1":
      $trabajo='CENTRAL (RESPALDO)';
        break;
	}
	return $trabajo;
		
	}



}


$obj_class=DAO_actualiza_ladaEnlaces::actualizar_ref_sisa_ladaEnlace($_POST['ref_sisa'],$_POST['punta'],$_POST['valor'],$_POST['id_elemento']);
/*if($obj_class==1){
	echo "actualice con exito";
}
else{
	echo "no hice nada";
	}
*/?>