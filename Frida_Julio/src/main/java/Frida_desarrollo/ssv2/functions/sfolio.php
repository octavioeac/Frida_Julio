<?php
function sfolio($folio){
    require 'conexion.php';
    $flag = 0;
    $folioexist = mysql_query("SELECT folio FROM zsite_survey WHERE folio = '".$folio."';");
    if(mysql_num_rows($folioexist) <= 0){
        $flag = 0;
    }
    else{
        $fechavalida = mysql_query("SELECT fecha_programada FROM zsite_survey WHERE folio = '".$folio."';");
        $fecha = mysql_result($fechavalida, 0, 0);
        if($fecha == null || $fecha == ''){
            $flag = 1;
        }
        else{
            $foliocapturado = mysql_query("SELECT estatus FROM zsite_survey WHERE folio = '".$folio."';");
            $estatus = mysql_result($foliocapturado, 0, 0);
            if($estatus != 'POR REALIZAR' && $estatus == 'EN CAPTURA'){
                $flag = 3;
            }
            else{
                $flag = 2;
            }
        }
    }
    return $flag;
}
$folio = trim($_POST['folio']);
//$folio = 'hola';
echo sfolio($folio);
?>
