<?php
include 'interfaces_daos/Idao_update_nodo_acceso.php';
include("conexion.php");
class Query_update_Cambio_De_Nodo implements Idao_update_nodo_acceso
{
 private $estado;	
 public function __construct(){
   	$this->estado=null;
 }
public function setEstado_Nodo($estado){
  $this->estado=$estado;	
	} 

public function getEstado_Nodo(){
  return $this->estado;	
	}
 
public function Idao_nodo_acceso_update($query)
   {
	    echo $query."<br>";	
	    $resultado_query= mysql_query($query)or die("Error in query: $query. ".mysql_error());
        //echo $resultado_query;
	  	return $resultado_query;
   }


}
?>