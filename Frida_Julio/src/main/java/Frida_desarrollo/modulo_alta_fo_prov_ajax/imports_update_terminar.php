<?php
include 'DAO_actualiza_terminar.php';
$busqueda_terminar=new DAO_actualiza_terminar(); 
$busqueda_terminar->actualizar_ref_sisa_terminar($_POST['ref_sisa_a'],$_POST['envia_punta'],$_POST['termina'],$_POST['valor']);
if($busqueda_terminar==true){
$estado_a=1;	
		}
else{
	$estado_a=0;
	}
	echo $estado_a;

?>