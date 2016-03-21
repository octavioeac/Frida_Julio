<?php
header("Content-Type: text/html;charset=utf-8");
function rechazo($folio){
    require 'conexion.php';
    $rechazo = mysql_query("SELECT causa_rechazo FROM zsite_survey WHERE folio = '".$folio."';");
    $rechazo = mysql_fetch_array($rechazo, MYSQL_BOTH);
    $rechazo = $rechazo[0];
    return $rechazo;
}
$folio = $_POST['folio'];
echo rechazo($folio);
?>
