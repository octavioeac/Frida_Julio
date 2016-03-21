<?php
include 'interfaces_daos/Iquery_repisa_punta.php';
include("conexion.php");
class Query_update_terminar_Imp implements Iquery_repisa_punta
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
 
 public function IQuery_general($query){
	 return $query;
	 }
 
public function IQuery_general_repisa($query)
   {
	    $resultado_query= mysql_query($query);
	  	return $resultado_query;
   }


}
?>