<?php
include 'interfaces_daos/Iquery.php';
include("conexion.php");
class Query_imp implements IQuery
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
     	$bandera= new Query_imp();	    
	 			if($result['trafico']==''){
						$bandera->setEstado(NULL);
                      	}
					 else{
						// echo "si".$result['trafico'];
						 //echo $this->estado=$result['trafico'];
						 $bandera->setEstado($result['trafico']);
                      	
						 }
        //echo "rudo".$bandera->getEstado();      
      return $bandera->getEstado();	  
   }


}
?>