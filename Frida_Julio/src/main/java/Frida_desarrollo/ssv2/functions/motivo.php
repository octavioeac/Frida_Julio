<?php
function motivo($folio,$razon,$tpval){
    require 'conexion.php';
    $queries = array(
        1 => "UPDATE zsite_survey SET causa_rechazo=\"".$razon."\",causa_rechazo_rs=\"".$razon."\",estatus='RECHAZADO',estatus_rs='RECHAZADO',fecha_validacion=NOW(),fecha_validacion_rs=NOW() WHERE folio = '".$folio."'",
        2 => "UPDATE zsite_survey SET causa_rechazo = \"".$razon."\",estatus = 'RECHAZADO',fecha_validacion=NOW() WHERE folio = '".$folio."'"
    );
    
    mysql_query($queries[$tpval]);
    return FALSE;
}
$folio = $_POST['folio'];
$razon = $_POST['razon'];
$tpval = $_POST['tpval'];
echo motivo($folio, $razon, $tpval);
?>