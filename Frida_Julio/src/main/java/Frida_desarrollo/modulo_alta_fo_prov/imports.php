<?php
include 'busqueda_archvoDao.php';
$busqueda_obj=new busqueda_archvoDao();
if($_POST['usr']=="CARSO"){
$trafico="PROTOCOLO 9";	
}
if($_POST['usr']=="KBTEL"){
$trafico="PROYECTO_FO";
}

$var_objeto=$busqueda_obj->encontrar_ref_sisa($_POST['ref_sisa_a'],$_POST['envia_punta'],$trafico);
if($var_objeto==true){
$estado_a=1;	
		}
else{
	$estado_a=0;
	}
	echo $estado_a;

?>
