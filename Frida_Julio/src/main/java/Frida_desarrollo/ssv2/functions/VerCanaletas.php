<?php
header('Content-type:application/json');
include 'conexion.php';

/*function VerCanaletas($folio,$tag){
    $info = array();$com;
    $query = "SELECT * FROM zcanaletas WHERE folio='".$folio."' AND tag=".$tag;
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $d = mysql_fetch_array($result);
            $info[$d['material']]=array();
            $info[$d['material']]=array($d['aplica'],$d['nuevo_existente'],$d['altura'],$d['largo'],$d['pulgadas'],$d['bajante']);
            if($d['comentarios'] != '' || $d['comentarios'] != 'null' || $d['comentarios'] != null){
                $info[$d['material']][6] = $d['comentarios'];
            }
        }
    }
    return json_encode($info);
    //return $info;
}
$folio = $_POST['folio'];
$tag = $_POST['tag'];
echo VerCanaletas($folio,$tag);*/
function VerCanaletas($folio){
    $info = array();
    $query = "select eg_afo_material,eg_afo_nuex,eg_afo_sat,eg_afo_altura,eg_afo_trayectoria,eg_afo_pulgadas,eg_afo_bajante,eg_afo_nobajante,eg_bfo_material,eg_bfo_nuex,eg_bfo_sat,eg_bfo_altura,eg_bfo_trayectoria,eg_bfo_pulgadas,eg_bfo_bajante,eg_bfo_nobajante,eg_mp_material,eg_mp_nuex,eg_mp_sat,eg_mp_altura,eg_mp_trayectoria,eg_mp_pulgadas,eg_mp_bajante,eg_mp_nobajante,eg_cx_material,eg_cx_nuex,eg_cx_sat,eg_cx_altura,eg_cx_trayectoria,eg_cx_pulgadas,eg_cx_bajante,eg_cx_nobajante,eg_gs_material,eg_gs_nuex,eg_gs_sat,eg_gs_altura,eg_gs_trayectoria,eg_gs_pulgadas,eg_gs_bajante,eg_gs_nobajante,eg_fz_material,eg_fz_nuex,eg_fz_sat,eg_fz_altura,eg_fz_trayectoria,eg_fz_pulgadas,eg_fz_bajante,eg_fz_nobajante from zsite_survey WHERE folio='".$folio."'";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        $info = mysql_fetch_row($result);
    }
    return json_encode($info);
}
$folio = $_POST['folio'];
echo VerCanaletas($folio);
//$arr = VerCanaletas('SS4520140929001',2);
//echo '<pre>';
//print_r($arr);
//echo '<pre>';