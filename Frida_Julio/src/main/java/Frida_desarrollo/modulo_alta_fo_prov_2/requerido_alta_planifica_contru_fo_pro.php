<?php 
include("../conexion.php");
//$_POST['refere']="C03-1401-0012";
//$_POST['envio']="requeridasasaso";
echo $_POST['envio2'];
echo $_POST['refere'];
if($_POST['envio2']=="No_Requerido"){
$queryReque="update construccion_fo set planifi_requerid='".$_POST['envio2']."' where ref_sisa='".$_POST['refere']."'";
echo $queryReque;
$result = mysql_query($queryReque) or die("problema con el query");
echo $result;
}else{
$queryReque="update construccion_fo set planifi_requerid='Requerido' where ref_sisa='".$_POST['refere']."'";
echo $queryReque;
$result = mysql_query($queryReque) or die("problema con el query");
echo $result;
	
	}
