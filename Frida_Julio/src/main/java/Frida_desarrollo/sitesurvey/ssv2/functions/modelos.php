<?php
header("Content-Type: text/html;charset=utf-8");
function modelo($provrubtec){
    $models = '<option value>Seleccionar</option>';
    $part = explode('|', $provrubtec);
    //echo $prov;
    require 'conexion.php';
    $query = "SELECT id, tipo_equipo FROM ztecnologias WHERE rubro ='".$part[1]."' AND proveedor = '".$part[0]."' AND tecnologia = '".$part[2]."' GROUP BY tipo_equipo ORDER BY tipo_equipo ASC;";
    $modelos = mysql_query($query,$conectar2);
    $max = mysql_num_rows($modelos);
    if($max > 0){
        for($p = 0; $p < $max; $p++){
            $mdl = mysql_fetch_array($modelos);
            $models .= '<option value="'.$mdl['id'].'">'.$mdl['tipo_equipo'].'</option>';
        }
    }
    return $models;
}
$provrubtec = trim($_POST['mod']);
echo modelo($provrubtec);
?>
