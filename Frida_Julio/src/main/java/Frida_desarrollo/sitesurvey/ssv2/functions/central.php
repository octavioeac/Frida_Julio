<?php
header("Content-Type: text/html;charset=utf-8");
function central($areadiv){
    $centrals = '<option value>Seleccionar</option>';
    require 'conexion.php';
    $parts = explode('|', $areadiv);
    $query = "SELECT id_ctl, sigcent, edificio FROM centrales WHERE dir_div = '".$parts[0]."' AND area = '".$parts[1]."' ORDER BY sigcent ASC;";
    $centrales = mysql_query($query,$conectar2);
    $max = mysql_num_rows($centrales);
    if($max > 0){
        for($c = 0; $c < $max; $c++){
            $central = mysql_fetch_array($centrales);
            $centrals .= '<option value="'.$central['id_ctl'].'">'.$central['edificio'].' - '.$central['sigcent'].'</option>';
        }
    }
    return $centrals;
}
$areadiv = trim($_POST['areadiv']);
echo central($areadiv);
?>
