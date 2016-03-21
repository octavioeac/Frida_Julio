<?php
header('Content-type: application/json');

require 'conexion.php';
include 'tildeReplace.php';

function addesc($id,$descripcion,$op){
    
    $arr;
    $descripcion = tildeReplace($descripcion);
    if($op == 1){
        $id = mysql_query("SELECT MAX(id) m FROM zarchivos");
        $id = mysql_fetch_array($id, MYSQL_BOTH);
        $id = $id[0];
    }    
    $actdescr = 'UPDATE zarchivos SET descripcion = "'.$descripcion.'" WHERE id = '.$id.'';
    mysql_query($actdescr);
    
    $result = mysql_query("select id,descripcion from zarchivos where id = (SELECT MAX(id) from zarchivos)");
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $arr = mysql_fetch_row($result);
        }
    }
    $arr[1] = tildeDecode($arr[1]);
    return json_encode($arr);
}
$id = $_POST['id'];
$descripcion = $_POST['descripcion'];
$op = $_POST['op'];
echo addesc($id, $descripcion, $op);