<?php
include 'classes/CapturaWDM.php';

$datos = new CapturaWDM();
if($proveedor){
    $datos->proveedor = $_POST['proveedor'];
    echo $datos->getWDM();
}
else if($wdm){
    $datos->wdm = $_POST['wdm'];
    $datos->proveedor = $_POST['prov'];
    echo $datos->getNodos();
}
else if($nodo){
    $datos->nodo = $_POST['nodo'];
    $datos->wdm = $_POST['nwdm'];
    $datos->proveedor = $_POST['pro'];
    echo $datos->getDatos();
}
else if($repisa){
    $datos->repisa = $_POST['repisa'];
    $datos->slot = $_POST['slot'];
    $datos->wdm = $_POST['twdm'];
    $datos->clli = $_POST['clli'];
    echo $datos->getPuertos();
}
else{
    echo $datos->getProveedores();
}