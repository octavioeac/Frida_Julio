<?php
include("../conexion.php");
$quer_actualizar="update construccion_fo set tipo='' where ref_sisa='".$_POST['ref_sisa_a']."' and punta='".$_POST['envia_punta']."'";	
$resultado_actalizar_fo=mysql_query($quer_actualizar) or die(mysql_error());
$quer_borrafibras="delete from fibra_optica_ladenlaces where ref_sisa='".$_POST['ref_sisa_a']."'and punta='".$_POST['envia_punta']."'";
$resultado_borrar_fibras=mysql_query($quer_borrafibras) or die(mysql_error());
echo "EL PROYECTO REFERENCIA SISA :".$_POST['ref_sisa_a']." NO ES REQUERIDO TRAYECTO DE FIBRA";