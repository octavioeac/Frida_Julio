<?php
include 'interfaces_daos/Iquery.php';
include("conexion.php");
class Query_imp_trayectoria implements IQuery
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
	   //echo $query;
        $resultado_query= mysql_query($query);
        //$result=mysql_fetch_array($resultado_query);
		//var_dump($result);
		while($result=mysql_fetch_array($resultado_query)){
             $a=$result['tipo_sel'];
			}
			//var_dump($a);
          	$bandera= new Query_imp_trayectoria();	
     		$bandera->setEstado($a);
	/*	      			if($a==''){
						$bandera->setEstado(NULL);
                      	}
					 else{
						 $bandera->setEstado($a);
						 echo $bandera;
                      	 }
     *///echo "rudo".$bandera->getEstado();      
      return $bandera->getEstado();	  
   }


}
?>