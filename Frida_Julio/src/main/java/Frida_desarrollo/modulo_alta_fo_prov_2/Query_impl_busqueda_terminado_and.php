<?php
include 'interfaces_daos/Iquery.php';
include("conexion.php");
class Query_impl_busqueda_terminado_and implements IQuery
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
 
public function IQuery_general($query)
   {
        $resultado_query= mysql_query($query);
        $result=mysql_fetch_array($resultado_query);
     	$bandera= new Query_impl_busqueda_terminado_and();	    
	 			if($result['id']==''){
						$bandera->setEstado(NULL);
                      	}
					 else{
						 //echo "si".$result['id'];
						// echo $this->estado=$result['id'];
						 $bandera->setEstado($result['id']);
                      	
						 }
        //echo "rudo".$bandera->getEstado();      
      return $bandera->getEstado();	  
   }


}
?>