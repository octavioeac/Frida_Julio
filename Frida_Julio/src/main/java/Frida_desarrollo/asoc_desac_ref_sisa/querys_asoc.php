<?php
include_once("clases/Parametros_view_ref_sisa.php");
include("../conexion.php");
class asociar_desasociar_ref_sisa{

    public static function exec_query($query){
		$resultado=mysql_query($query);
		}
	
	public static function busqueda_query($ref_sisa){
	     $obj_parametro=new Parametros_view_ref_sisa();
		 $query="select ".$obj_parametro->arrays['columna_0']." from view_ref_sisa where ".$obj_parametro->arrays['columna_1']."='".$ref_sisa."'";
		 $resultado_query= mysql_query($query);
		 $result=mysql_fetch_array($resultado_query);
       	 if(($result['tabla']=='servicios_l2')||($result['tabla']=='servicios_ide')){
			$tabla=$result['tabla'];
			 }
			 else{
		    $tabla="";		
				 }
			 return $tabla;	 
		}

   public function asociac_ref_sisa($ref_sisa_vieja,$ref_sisa_nueva){
	   $tabla_ref_sisa_nueva=asociar_desasociar_ref_sisa::busqueda_query($ref_sisa_nueva);
	   $tabla_ref_sisa_vieja=asociar_desasociar_ref_sisa::busqueda_query($ref_sisa_vieja);
	   if($tabla_ref_sisa_vieja==$tabla_ref_sisa_nueva){
            $obj_metodo=new asociar_desasociar_ref_sisa();
			$obj_metodo->delete_ref_sisa($ref_sisa_vieja,$ref_sisa_nueva,$tabla_ref_sisa_nueva);
			$obj_metodo->assoc_ref_update($ref_sisa_vieja,$ref_sisa_nueva,$tabla_ref_sisa_nueva);
			$obj_metodo->updatePto($ref_sisa_vieja,$ref_sisa_nueva);
		$obj_metodo->updateOrdenes($ref_sisa_vieja,$ref_sisa_nueva,$tabla_ref_sisa_nueva);
		   
           $mensaje="Proceso Exitoso";  
			         
	    }
		else{
		$mensaje="Referencias no existen en la misma tabla"	;
			}
	   return $mensaje;
   
	   }
    public function assoc_ref_update($ref_sisa_vieja,$ref_sisa_nueva,$tabla){

  $query = "update ".$tabla." set ref_sisa_ant='".$ref_sisa_vieja."',ref_sisa='".$ref_sisa_nueva."' , estatus_cns1='CAMBIO ANCHO BANDA',tipo_movimiento='CAMBIO ANCHO DE BANDA',folio_interred='' ,fecha_interred='',hora_interred='',fol_ser=(select fol_ser from altas_sisa where ser_l_ref='".$ref_sisa_nueva."' order by max(date(fecha)) limit 1)  where ref_sisa='".$ref_sisa_vieja ."' limit 1"; 
	asociar_desasociar_ref_sisa::exec_query($query);
		}
		
    public function updatePto($ref_sisa_vieja,$ref_sisa_nueva){
	$query = "update inventario_puertos_demarcadores set nombre_oficial_pisa='".$ref_sisa_nueva."' where nombre_oficial_pisa='".$ref_sisa_vieja."'and uso_puerto='SERVICIO' ";	
				asociar_desasociar_ref_sisa::exec_query($query);
		}		
		
 public function delete_ref_sisa($ref_sisa_vieja,$ref_sisa_nueva,$tabla){
	$query="delete from ".$tabla."  where  ref_sisa='".$ref_sisa_nueva."'  limit 1";    
					asociar_desasociar_ref_sisa::exec_query($query);
	 } 		
  public function updateOrdenes($ref_sisa_vieja,$ref_sisa_nueva,$tabla){
	  $query ="update ordenes set nombre_oficial_pisa='".$ref_sisa_nueva."',ref_sisa='".$ref_sisa_nueva."' where nombre_oficial_pisa='".$ref_sisa_vieja."' and tabla='".$tabla."' ";
	  asociar_desasociar_ref_sisa::exec_query($query);
	  }   
	
	
	
	}
	
//$_POST['ref_vieja']="C00-1302-0006";
//$_POST['ref_nueva']="C00-1302-0007";


$hola=asociar_desasociar_ref_sisa::asociac_ref_sisa($_POST['ref_vieja'],$_POST['ref_nueva']);
echo $hola;
?>