<?php
include("conexion.php");
include ("clases/Parametros_tablas.php");

class Mysql_cambio_nodo{
	
	public static function select_nodo($query,$tabla)
   {
	    $resultado_query= mysql_query($query);
        $result=mysql_fetch_array($resultado_query);
       if($tabla=="ladaenlaces"){
	   $datos_array=array
	   (
	    "cm"=>$result['central'],
	    "cm_b"=>$result['central_b']
	   );
	   }
	   if($tabla=="servicios_ide"){
	   $datos_array=array
	   (
	    "cm"=>$result['centralOrigen'],
	    "cm_b"=>$result['centralDestino']
	   );
	   }
	   if($tabla=="ciudad_segura"){
	   $datos_array=array
	   (
	    "cm"=>$result['centralCamara'],
	    "cm_b"=>$result['centralTrabajo']
	   );
	   }
	   
	   //var_dump($datos_array);
        return $datos_array;
		  
   }

   public static function select_cambio_nodo($ref_sisa,$punta,$tabla){
    $obj_tabla=new Parametros_tablas();
	$obj_tabla->ref_sisa_1=$ref_sisa;
	$obj_tabla->tabla_1=$tabla;

   	$query_sele="select * from ".$obj_tabla->tabla_1." where ref_sisa='".$obj_tabla->ref_sisa_1."'";
    $busqueda=Mysql_cambio_nodo::select_nodo($query_sele,$obj_tabla->tabla_1);
    

	
	
	
	$segundo_array=array(
        "cm"=>$busqueda['cm'],
 	    "cm_b"=>$busqueda['cm_b'],
    	"columna_a_ant"=>$obj_tabla->a_ant,
    	"columna_b_ant"=>$obj_tabla->b_ant
    ); 
	
	
	
	

  return $segundo_array;
   }  

  
}
//$ref_sisa="D32-0708-0515";
//$tabla="ciudad_segura";
//$objeto=Mysql_cambio_nodo::select_cambio_nodo($ref_sisa, $punta, $tabla);
//var_dump($objeto);


?>