<?php 
//include 'functions/funcion_nombre_oficial_acceso.php';
//include 'functions/funcion_alta_clli_infocentro.php';
include 'classes/Conn.php';
include 'classes/Datos.php';
include 'classes/ValidarSS.php';
include 'classes/Mail.php';
include 'classes/Observaciones.php';
include 'classes/MergePDF.php';
//include '../../sesion.php';

$folio = $_POST['folio'];
$flag = $_POST['flag'];
$tpval = $_POST['tpval'];
$usr = $_POST['usr'];

$validarss = new ValidarSS($folio,$flag,$tpval,$usr);
header('Location:grid_surveys.php');

//if($flag == 1 && $tpval == 2){
//    //PROCESO POSTERIOR A VALIDACIÓN
//    $nombre_oficial_pisa = array();
//    $clli = array();
//
//    $data = new Datos($folio);
//    for($i = 0; $i < count($data->datos); $i++){
//        $nombre_oficial_pisa[$i] = nombre_oficial_acceso($data->datos[$i][2],$data->datos[$i][1],$data->datos[$i][12],null);
//        $data->altaNomof($nombre_oficial_pisa[$i],$sess_usr,$i);
//        $data->actualizaNombre($nombre_oficial_pisa[$i],$data->datos[$i][25]);
//        $clli[$i] = alta_clli_vdsl($data->datos[$i][0],$data->datos[$i][2],$nombre_oficial_pisa[$i],$data->datos[$i][8],$data->datos[$i][16],$data->datos[$i][6],$data->datos[$i][9],$data->datos[$i][13],$data->datos[$i][22]." ".$nombre_oficial_pisa[$i]);
//    }
//
//
//    /*  ALTA DE TARJETAS */
//    $data->equipos();
//    $data->altaRanuras();
//    $data->altaTarjetas();
//}
//header('Location:grid_surveys.php');
