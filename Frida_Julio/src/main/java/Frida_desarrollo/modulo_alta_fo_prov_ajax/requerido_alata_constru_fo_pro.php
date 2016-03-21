<?php 
include("../conexion.php");
echo $_POST['envio'];
echo $_POST['refere'];
if($_POST['envio']=="No_Requerido"){
$queryReque="update construccion_fo set cons_requerid='".$_POST['envio']."' where ref_sisa='".$_POST['refere']."'";
echo $queryReque;
$result = mysql_query($queryReque) or die("problema con el query");
echo $result;
}else{
$queryReque="update construccion_fo set cons_requerid='Requerido' where ref_sisa='".$_POST['refere']."'";
echo $queryReque;
$result = mysql_query($queryReque) or die("problema con el query");
echo $result;
	
	}



?>