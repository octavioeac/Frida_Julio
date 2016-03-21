<?php
include("../conexion.php");
echo $_POST['valor'];
echo $_POST['referencia_sisas'];
echo $_POST['envia_punt'];
$query_bandera="update construccion_fo set bandera_archivos='".$_POST['valor']."' 
where ref_sisa='".$_POST['referencia_sisas']."' and punta='".$_POST['envia_punt']."'";
$resultado= mysql_query($query_bandera)or die(mysql_error());

?>