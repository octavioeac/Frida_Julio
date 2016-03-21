<?php
header('Content-type: application/json');

include 'conexion.php';
include 'tildeReplace.php';

function historicoBitacora($folio){
    $bit;
    $query = "select DATE(fecha)fecha,TIME(fecha)hora,usuario,version,observaciones from zbitacora where folio='".$folio."' ORDER BY id ASC";
    $result = mysql_query($query);
    while($d = mysql_fetch_row($result)){
        $d[4] = tildeDecode($d[4]);
        $bit[] = $d;
    }
    return json_encode($bit);
}

$folio = $_GET['folio'];
echo historicoBitacora($folio);