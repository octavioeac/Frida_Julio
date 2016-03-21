<?php
header("Content-Type: text/html;charset=utf-8");
function tecnologia($provrub){
    $tech = '<option value>Seleccionar</option>';
    $part = explode('|', $provrub);
    //echo $prov;
    require 'conexion.php';
    $query = "SELECT tecnologia FROM ztecnologias WHERE rubro ='".$part[1]."' AND proveedor = '".$part[0]."' GROUP BY tecnologia ORDER BY tecnologia ASC;";
    $tecnologia = mysql_query($query,$conectar2);
    $max = mysql_num_rows($tecnologia);
    if($max > 0){
        for($p = 0; $p < $max; $p++){
            $tec = mysql_fetch_array($tecnologia);
            $tech .= '<option value="'.$tec['tecnologia'].'">'.$tec['tecnologia'].'</option>';
        }
    }
    return $tech;
}
$prov = trim($_POST['provrub']);
echo tecnologia($prov);
?>
