<?php
include 'interfaces_daos/Idao_update_liquidacion.php';
include("conexion.php");
class Query_update_terminar_Imp implements Idao_update_liq
{
 private $estado;	
 public function __construct(){
   	$this->estado=null;
 }
public function setEstado($estado){
  $this->estado=$estado;	
	} 

public function getEstado(){
  return $this->estado;	
	}
 
public function Idao_update_liquidacion($query,$terminar)
   {
	    $resultado_query= mysql_query($query);
	  	return $resultado_query;
   }


}
?>