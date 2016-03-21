<?php
header('Content-type: application/json');
include 'saver.php';
function NuevaInterconexion($folio,$tipo){
    $id_equipo = array(0);
    if($tipo == 'tbfo' || $tipo == 'tbdo'){
        $alto_bajo = $tipo == 'tbfo' ? 1 : 0;
        agregarInterFO($id_equipo,$folio,$alto_bajo);
    }
    else if($tipo == 'tbcx'){
        agregarCX($id_equipo,$folio);
    }
    else if($tipo == 'tbfz'){
        agregarFZ($id_equipo,$folio,0);
        agregarFZ($id_equipo,$folio,1);
    }
}

function getLastId($folio,$tipo,$id){
    $id;
    NuevaInterconexion($folio,$tipo);
    $subquery = array(
        'tbfo' => array('zinter_abfo',1),
        'tbdo' => array('zinter_abfo',1),
        'tbcx' => array('zinter_cx',1),
        'tbfz' => array('zinter_fz',2),
    );
    $query = "SELECT id FROM ".$subquery[$tipo][0]." WHERE folio='".$folio."' ORDER BY id DESC LIMIT ".$subquery[$tipo][1];
    $result = mysql_query($query);
    while($d = mysql_fetch_row($result)){
        $id[] = $d[0];
    }
    return json_encode($id);
}

function updateId($id,$tabla,$id_eq){
    $dato = explode('_',$tabla);
    $tables = array(
        'fo' => 'zinter_abfo',
        'dwfo' => 'zinter_abfo',
        'cx' => 'zinter_cx',
        'fz' => 'zinter_fz',
    );
    if($dato[0] == 'fz'){
        $ids = explode('_',$id);        
        for($i = 0; $i < count($ids); $i++){
            $update = "UPDATE ".$tables[$dato[0]]." SET id_equipo=".$id_eq." WHERE id=".$ids[$i];
            mysql_query($update);
        }
    }
    else{
        $update = "UPDATE ".$tables[$dato[0]]." SET id_equipo=".$id_eq." WHERE id=".$id;
        mysql_query($update);
    }
}

function deleteId($id,$type){
    $tables = array(
        'xbfo' => 'zinter_abfo',
        'xbdo' => 'zinter_abfo',
        'xbcx' => 'zinter_cx',
        'xbfz' => 'zinter_fz',
    );
    if($type != 'xbfz'){
        $delete = "DELETE FROM ".$tables[$type]." WHERE id = ".$id;
        mysql_query($delete);
    }
    else{
        $subid = explode('_',$id);
        for($i = 0; $i < 2; $i++){
            $delete = "DELETE FROM ".$tables[$type]." WHERE id = ".$subid[$i];
            mysql_query($delete);
        }
    }
}

if($tipo){
    $folio = $_GET['folio'];
    $tipo = $_GET['tipo'];
    echo getLastId($folio,$tipo);
}
else if($tabla){
    $id = $_GET['id'];
    $tabla = $_GET['tabla'];
    $id_eq = $_GET['id_eq'];
    echo updateId($id,$tabla,$id_eq);
}
else if($type){
    $id = $_GET['id'];
    $type = $_GET['type'];
    echo deleteId($id,$type);
}