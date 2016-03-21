<?php
header("Content-Type: text/html;charset=utf-8");
function eliminar($id){
    require 'conexion.php';
    //BUSCAR RUTA DE LA IMAGEN Y BORRAR LA IMAGEN
    $ruta = mysql_query("SELECT ruta FROM zarchivos WHERE id = ".$id.";");
    $ruta = mysql_fetch_array($ruta, MYSQL_BOTH);
    $ruta = $ruta[0];
    unlink($ruta);
    //ELIMINAR DE LA BASE DE DATOS
    $borrar = "DELETE FROM zarchivos WHERE id = ".$id.";";
    mysql_query($borrar);
}
$id = $_POST['id'];
eliminar($id);
?>