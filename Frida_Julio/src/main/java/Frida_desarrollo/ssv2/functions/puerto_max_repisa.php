<?php
header('Content-type: application/json');
include 'conexion.php';

function puerto_max_repisa($folio,$divisor){
    $query = "select CEIL((puertos_tarjeta * tarjetas_max)/".$divisor.") puertos_max_repisa,(puertos_tarjeta * tarjetas_max) maximo from ztecnologias where id =(select id_tecnologia from zss_equipos WHERE folio='".$folio."' GROUP BY id_tecnologia)";
    $result = mysql_query($query);
    $d = mysql_fetch_row($result);
    return json_encode($d);
}

$folio = $_GET['folio'];
$divisor = $_GET['divisor'];
echo puerto_max_repisa($folio,$divisor);