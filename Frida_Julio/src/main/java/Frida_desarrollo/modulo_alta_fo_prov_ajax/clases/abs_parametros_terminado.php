<?php
 class  abs_parametros_terminado{
	private $ref_sisa;
	private $punta;
    private $terminado;
	
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

public function setTerminado($terminado){
	$this->terminado=$terminado;
	}
public function getTerminado(){
	return $this->terminado;
	}

 }
 ?>