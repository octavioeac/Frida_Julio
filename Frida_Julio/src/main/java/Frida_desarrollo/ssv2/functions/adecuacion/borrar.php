<?php
header("Content-Type: text/html;charset=utf-8");
function borrar($id){
    require '../conexion.php';
    $borrar = "DELETE FROM zelementos WHERE id = ".$id.";";
    mysql_query($borrar);
}
$id = $_POST['id'];
echo borrar($id);
?>