<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<body>
<?php
include("conexion.php");
$query2 = "select cons_requerid from construccion_fo where ref_sisa='C03-1401-0012'";
echo $query2;
$resultado = mysql_query($query2);
$roww=mysql_fetch_row($resultado);
echo $roww[0];

?>


</body>
</html>
