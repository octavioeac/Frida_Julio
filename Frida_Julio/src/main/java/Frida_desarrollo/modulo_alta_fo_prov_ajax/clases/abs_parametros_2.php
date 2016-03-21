<?php
 class  abs_parametros_2{
	private $ref_sisa;
	private $punta;
	private $trafico;
	private $tipo_sel;
	private $repisa;
	private $tipo_trabajo;
	private $cambio_nodo;
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

public function setTrafico($trafico){
	$this->trafico=$trafico;
}

public function getTrafico(){
	return $this->trafico;
	
}

public function setTipo_Sel($tipo_sele){
	$this->tipo_sel=$tipo_sele;
	}

public function getTipo_Sel(){
    return $this->tipo_sel;
}
 public function setRepisa($repisa_punta){
	 $this->repisa=$repisa_punta;
	 } 
 
 public function getRepisa(){
	 return $this->repisa;
	 }

 public function setTipo_TRabajo($tipo_trab){
	 $this->tipo_trabajo=$tipo_trab;
	 }
	 
 public function getTipo_TRabajo(){
	 return $this->tipo_trabajo;
	 }
 
 public function setTipo_nodo($cambio_nodo){
	  $this->cambio_nodo=$cambio_nodo;
	  }
 public function get_Tipo_nodo(){
	 return $this->cambio_nodo;
	 }
 
 }
 
 
 
 ?>