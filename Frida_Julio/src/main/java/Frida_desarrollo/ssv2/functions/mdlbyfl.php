<?php
/*
 * Extrae los modelos de todos los equipos dependiendo su folio
 */
header("Content-Type: text/html;charset=utf-8");
include 'conexion.php';
function mdlbyfl($folio){
    $options = '<option value="">Seleccionar</option>';
    $query = "SELECT id,nombre_equipo FROM zss_equipos WHERE folio = '".$folio."' ORDER BY id ASC";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $request = mysql_fetch_array($result);
            $options .= '<option value="'.$request['id'].'">'.$request['nombre_equipo'].'</option>';
        }
    }
    return $options;
}
$folio = $_POST['folio'];
echo mdlbyfl($folio);
