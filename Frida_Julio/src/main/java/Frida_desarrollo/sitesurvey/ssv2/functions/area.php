<?php
function area ($zona){
    $naams = '<option value>Seleccionar</option>';
    require 'conexion.php';
    $zona = trim($_POST['zona']);
    $query = "SELECT area FROM centrales WHERE dir_div = '".$zona."' GROUP BY area ORDER BY area ASC";
    $areas = mysql_query($query,$conectar2);
    $max = mysql_num_rows($areas);
    if($max > 0){
        for($a = 0; $a < $max; $a++){
            $nombre = mysql_fetch_array($areas);
            $naams .= '<option value="'.$nombre['area'].'">'.$nombre['area'].'</option>';
        }
    }
    return $naams;
}
$zona = trim($_POST['zona']);
echo area($zona);
?>