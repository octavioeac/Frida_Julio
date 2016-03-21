<?php
include_once("clases/Parametros_view_ref_sisa.php");
include_once("clases/Parametros_servicios_l2.php");
include_once("clases/Parametros_servicios_ide.php");

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

   public function asociac_ref_sisa($ref_sisa_nueva){
	   $tabla_ref_sisa_nueva=asociar_desasociar_ref_sisa::busqueda_query($ref_sisa_nueva);
	   if($tabla_ref_sisa_nueva){
            $obj_metodo=new asociar_desasociar_ref_sisa();
             $ref_sisa_ant=$obj_metodo->update_des_ref_sisa($ref_sisa_nueva,$tabla_ref_sisa_nueva); 
			
			
			//$obj_metodo->updatePto($ref_sisa_nueva,$ref_sisa_vieja);
		//	$obj_metodo->updateOrdenes($ref_sisa_nueva,$ref_sisa_vieja,$tabla_ref_sisa_nueva);
		   
           $mensaje="Proceso Exitoso";  
			         
	    }
		else{
		$mensaje="Referencias no existen en la misma tabla"	;
			}
	   return $mensaje;
   
	   }

		
    public function updatePto($ref_sisa_vieja,$ref_sisa_nueva){
	$query = "update inventario_puertos_demarcadores set nombre_oficial_pisa='".$ref_sisa_nueva."' where nombre_oficial_pisa='".$ref_sisa_vieja."'and uso_puerto='SERVICIO' ";	
		//		echo $query."<br>";
				asociar_desasociar_ref_sisa::exec_query($query);
		}		
		
	
  public function updateOrdenes($ref_sisa_vieja,$ref_sisa_nueva,$tabla){
	  $query ="update ordenes set nombre_oficial_pisa='".$ref_sisa_nueva."',ref_sisa='".$ref_sisa_nueva."' where nombre_oficial_pisa='".$ref_sisa_vieja."' and tabla='".$tabla."' ";
//	  echo $query."<br>";
	  asociar_desasociar_ref_sisa::exec_query($query);
	  }   
	

public function tabla_cadena($tabla){
	 $clase="Parametros_".$tabla;
	 $obj_tabla=new $clase();
	 if($tabla=="servicios_ide"){
      $array_ide=array("1"=>"","6"=>"","7"=>"","8"=>"","9"=>"","11"=>"","13"=>"","14"=>"","21"=>"","56"=>"",					"64"=>"","10"=>"");
   }
   if($tabla=="servicios_l2"){
	   $array_ide=array("1"=>"","78"=>"","23"=>"","24"=>"","82"=>"","83"=>"","84"=>"","5"=>"","6"=>"","4"=>"","55"=>"","60"=>"");
	   }
   foreach ($array_ide as $key => $value) {
    if(is_int($key)){
		$cadena .= " ".$obj_tabla->arrays['columna_'.$key.''].",";	
		
		}
	}   
	
	$cadena=substr($cadena,0,strlen($cadena)-1);
	return $cadena;
	
	}	
	

	
public function update_des_ref_sisa($ref_sisa_nueva,$tabla){
		$queryRefAnterior="select ref_sisa_ant from ".$tabla." where ref_sisa='".$ref_sisa_nueva."'";
		$resultado=mysql_query($queryRefAnterior);
		$ref_sisa_anter=mysql_fetch_array($resultado);
		$ref_sisa_anterior=$ref_sisa_anter['ref_sisa_ant'];
		$query = "update ".$tabla." set ref_sisa_ant='',ref_sisa='".$ref_sisa_anterior."' , estatus_cns1='LIQUIDADA',estatus_cna='LIQUIDADA',tipo_movimiento='ALTA',folio_interred='' ,fecha_interred='',hora_interred='',fol_ser=(select fol_ser from altas_sisa where ser_l_ref='".$ref_sisa_anterior."' order by max(date(fecha)) limit 1)  where ref_sisa='".$ref_sisa_nueva ."' limit 1"; 
asociar_desasociar_ref_sisa::exec_query($query);
$cadena_query=asociar_desasociar_ref_sisa::tabla_cadena($tabla); 		
$query2="
		insert into ".$tabla." (".$cadena_query." ,fol_ser) select ".$cadena_query.",
			(select fol_ser from altas_sisa where ser_l_ref= ".$ref_sisa_nueva."  order by max(date(fecha))
			from ".$tabla." where ref_sisa ='".$ref_sisa_anterior."'";
echo $query2;	
asociar_desasociar_ref_sisa::exec_query($query2);
		return $ref_sisa_anterior;
	
		}
	}

$_POST['ref_nueva']="C00-1302-0007";	
$hola=asociar_desasociar_ref_sisa::asociac_ref_sisa($_POST['ref_nueva']);
echo $hola;
?>