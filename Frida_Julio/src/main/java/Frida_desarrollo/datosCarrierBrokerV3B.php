<?php
include 'conexionT.php';

//function autocompletar($id_nodo,$tipoServicio){
function autocompletar($tipoServicio){
    $datos = array();
    //'HSI' => "SELECT nombre_oficial_pisa FROM asigna_puertos WHERE nombre_oficial_pisa LIKE '%".$id_nodo."%' AND mod_tar_eth LIKE '%ASIGNAR%' AND(tabla='adtran' OR tabla='edas2530_unica' OR tabla='huawei_unica' OR tabla='isam7330' OR tabla='isam_unica' OR tabla='tbas_180') LIMIT 10",
    $queries = array(
        'HSI' => "SELECT nombre_oficial_pisa FROM asigna_puertos WHERE mod_tar_eth NOT LIKE '%ASIGNAR%' AND(tabla='edas2530_unica' OR tabla='huawei_unica' OR tabla='isam_unica') LIMIT 50",
        'GPON' => "SELECT nombre_oficial_pisa FROM asigna_puertos WHERE mod_tar_eth NOT LIKE '%ASIGNAR%' AND tabla='gpon' LIMIT 50",
        'SDH' => "SELECT clli_adva FROM inventario_puertos_demarcadores WHERE estatus = 'OCUPADO' GROUP BY clli_adva ORDER BY clli_adva ASC LIMIT 50"
    );
    $result = mysql_query($queries[$tipoServicio]);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $d = mysql_fetch_row($result);
            $datos[$i] = $d[0];
        }
    }
    return json_encode($datos);
}

function getPuertos($tipoNodo, $proveedor, $equipo){
    $puertos = array();
    $tecnologia = '';
    $subquery = '';
    if($tipoNodo == 'Agregador'){
        $tecnologia = 'CARRIER ETHERNET';
        $subquery = 'and capacidad_puerto = 1';
    }
    else{
        $tecnologia = 'ADVA';
        $subquery = 'and tipo_equipo = \''.$equipo.'\'';
    }
    //$query = "select tipo_puerto from cat_puertos_ce where tecnologia = '".$tecnologia."' AND proveedor='".$proveedor."' AND tipo_equipo = '".$equipo."' GROUP BY tipo_puerto";
    $query = "select tipo_puerto from cat_puertos_ce where tecnologia = '".$tecnologia."' AND proveedor='".$proveedor."' ".$subquery." GROUP BY tipo_puerto";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz ; $i++){
            $d = mysql_fetch_array($result);
            $puertos[$i] = $d['tipo_puerto'];
        }
    }
    return $puertos;
}

function puertosAsignadosSDH($clliAdva){
    $datos;
    $query = "select replace(concat_ws('/',replace( repisat,'N/A','' ),replace( slot,'N/A','' ),puerto),'//','') as  puerto from inventario_puertos_demarcadores where clli_adva = '".$clliAdva."' and estatus = 'OCUPADO'";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $d = mysql_fetch_array($result);
            $datos[$i] = $d['puerto'];
        }
    }
    return $datos;
}

function datos($idNodo,$tp,$tipoAgregador){
    $datos;
    $inx = ($tp == 'HSI' | $tp == 'GPON') ? 0 : 1;
    $queries = array(
        "SELECT asigna_puertos.siglas_central,asigna_puertos.nombre_central,a.proveedor_tx,asigna_puertos.repadm_conxadsl,CONCAT(asigna_puertos.slotadm_conxadsl,'/',asigna_puertos.ptoether_conxadsl) puerto,a.id_nodo,asigna_puertos.anillo_gigatelmex,b.id_nodo AS id_nodo_dist,asigna_puertos.tecnol_eq_isam,asigna_puertos.tabla FROM asigna_puertos LEFT JOIN cat_anillo a ON a.clli_equipo=asigna_puertos.cllieq_adm_conxadsl LEFT JOIN cat_anillo b ON b.clli_equipo=asigna_puertos.cllieq_adm_conxuni_hsi WHERE asigna_puertos.nombre_oficial_pisa='".$idNodo."'",
        "SELECT siglas,central,proveedor,tipo_equipo,'PUERTO' FROM inventario_demarcadores WHERE clli_adva='".$idNodo."'"
    );
    $result = mysql_query($queries[$inx]);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        $datos[0] = mysql_fetch_row($result);
    }
    if($inx == 1){
        $datos[1] = puertosAsignadosSDH($idNodo);
    }
    return json_encode($datos);
}

if($tipoServicio){
    //$id_nodo = $_POST['id_nodo'];
    $tipoServicio = $_POST['tipoServicio'];
    //echo autocompletar($id_nodo,$tipoServicio);
    echo autocompletar($tipoServicio);
}
else if($idNodo){
    $idNodo = $_POST['idNodo'];
    $tp = $_POST['tp'];
    $tipoAgregador = $_POST['tipoAgregador'];
    echo datos($idNodo,$tp,$tipoAgregador);
}