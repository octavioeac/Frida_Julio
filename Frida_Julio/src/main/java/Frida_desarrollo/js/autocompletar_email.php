<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<body>
<?php
include("conexion.php");
$query2 = "select ref_sisa from construccion_fo";
echo $query2;
$resultado = mysql_query($query2);
$roww=mysql_fetch_row($resultado);
echo $roww[0];

?>


</body>
</html>
