<?php
header('Content-type: application/json');
include '../../conexion.php';
function habilitada($folio){
    $tags = array();
    $habilitadas = array();    
    $query = "SELECT ztecnologias.tags FROM zss_equipos,ztecnologias WHERE zss_equipos.id_tecnologia=ztecnologias.id AND zss_equipos.folio='".$folio."'";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0;$i < $sz; $i++){
            $d = mysql_fetch_array($result);
            $tags[$i] = explode(',',$d['tags']);
        }
    }    
    for($i = 0; $i < count($tags); $i++){
        $habilitadas = array_merge($habilitadas, $tags[$i]);
    }
    $habilitadas = array_unique($habilitadas);
    sort($habilitadas);    
    return json_encode($habilitadas);
}
$folio = $_POST['folio'];
echo $hab = habilitada($folio);