<?php
header("Content-Type: text/html;charset=utf-8");
function tipofolio($folio){
    require 'conexion.php';
    $estatus = mysql_query("SELECT estatus FROM zsite_survey WHERE folio = '".$folio."';");
    $estatus = mysql_fetch_array($estatus, MYSQL_BOTH);
    $estatus = $estatus[0];
    return $estatus;
}
$folio = $_POST['folio'];
echo tipofolio($folio);
?>