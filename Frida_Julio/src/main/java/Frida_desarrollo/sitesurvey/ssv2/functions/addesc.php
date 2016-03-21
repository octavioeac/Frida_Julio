<?php
header("Content-Type: text/html;charset=utf-8");
function addesc($id,$descripcion){
    require 'conexion.php';
    $actdescr = 'UPDATE zarchivos SET descripcion = "'.$descripcion.'" WHERE id = '.$id.';';
    mysql_query($actdescr);
}
$id = $_POST['id'];
$descripcion = $_POST['descripcion'];
echo addesc($id, $descripcion);
?>