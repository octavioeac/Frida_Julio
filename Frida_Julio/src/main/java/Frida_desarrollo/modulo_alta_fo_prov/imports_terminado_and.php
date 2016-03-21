<?php
include 'Dao_busqueda_terminado_and.php';
$busquedaAnd_obj=new busqueda_terminado_and();
$var_objeto=$busquedaAnd_obj->encontrar_ref_sisa_and($_POST['ref_sisa_a'],$_POST['punta']);
//echo $var_objeto;
if($var_objeto==true){
$estado_a=1;	
		}
else{
	$estado_a=0;
	}
	echo $estado_a;

?>