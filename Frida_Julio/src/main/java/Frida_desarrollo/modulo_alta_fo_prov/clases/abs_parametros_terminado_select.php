<?php
 class  abs_parametros_terminado_and{
	private $ref_sisa;
	private $punta;
  
	
public function setRef_sisa($refsisa){
	$this->ref_sisa=$refsisa;	
}	

public function getRef_sisa(){
	return $this->ref_sisa;
}
	
public function setPunta($punta_ref){
   $this->punta=$punta_ref;
}

public function getPunta(){
	return $this->punta;
	
}

 }
 ?>