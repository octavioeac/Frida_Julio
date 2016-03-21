<?php
header("Content-Type: text/html;charset=utf-8");
function guardarNuevo($folio,$codcat,$seccion,$cantidad,$tipo){
    require '../conexion.php';
    $alta = "INSERT INTO zelementos VALUES (id,'".$codcat."','".$folio."','".$seccion."','".$cantidad."','".$tipo."');";
    mysql_query($alta);
    $max = mysql_query("SELECT MAX(id) AS id FROM zelementos");
    $max = mysql_fetch_array($max, MYSQL_BOTH);
    $max = $max[0];
    return $max;
}
$folio = $_POST['folio'];
$codcat = $_POST['codcat'];
$seccion = $_POST['seccion'];
$cantidad = $_POST['cantidad'];
$tipo = $_POST['tipo'];
echo guardarNuevo($folio,$codcat,$seccion,$cantidad,$tipo);
?>
