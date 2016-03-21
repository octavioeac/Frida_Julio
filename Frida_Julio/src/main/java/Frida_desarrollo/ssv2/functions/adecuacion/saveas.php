<?php
header("Content-Type: text/html;charset=utf-8");
function gardasitesurvey(
    $folio,
    $eg_tipotrabajo,
    $eg_coment_tipotrabajo,
    $eg_tipocentral,
    $eg_coment_tipocentral,
    $eg_espacio,
    $eg_coment_espacio,
    $eg_tipodepiso,
    $eg_coment_tipodepiso,
    $eg_obracivil,
    $eg_coment_obracivil,
    $ad_justificacion,
    $ad_alimentacion_comentarios,
    $ad_bdtd_comentarios,
    $ad_cableado_comentarios,
    $ad_canaletasEscalerillas_comentarios,
    $ad_dfo_comentarios,
    $ad_dg_comentarios,
    $ad_etiquetado_comentarios,
    $ad_instalacionDesmontaje_comentarios,
    $ad_obraCivil_comentarios,
    $ad_rda_comentarios,
    $ad_tierra_comentarios,
    $ad_otrosMateriales_comentarios,
    $pl_comentarios,
    $flag
    ){
    require '../conexion.php';
    $fecha_captura;
    $estatus;
    if($flag == 1){
        $fecha_captura = date('Y-m-d H:i:s');
        //fecha_captura = '".$fecha_captura."',
        $fecha_captura = "fecha_captura = '".date('Y-m-d H:i:s')."',";
        $estatus = 'POR VALIDAR';
    }
    else{
        $fecha_captura = '';
        $estatus = 'EN CAPTURA';
    }    
    $altaadecuacion = "UPDATE zsite_survey SET 
    eg_tipotrabajo = '".$eg_tipotrabajo."',
    eg_coment_tipotrabajo = \"".$eg_coment_tipotrabajo."\",
    eg_tipocentral = '".$eg_tipocentral."',
    eg_coment_tipocentral = \"".$eg_coment_tipocentral."\",
    eg_espacio = '".$eg_espacio."',
    eg_coment_espacio = \"".$eg_coment_espacio."\",
    eg_tipodepiso = '".$eg_tipodepiso."',
    eg_coment_tipodepiso = \"".$eg_coment_tipodepiso."\",
    eg_obracivil = '".$eg_obracivil."',
    eg_coment_obracivil = \"".$eg_coment_obracivil."\",
    ad_justificacion = \"".$ad_justificacion."\",
    ad_alimentacion_comentarios = \"".$ad_alimentacion_comentarios."\",
    ad_bdtd_comentarios = \"".$ad_bdtd_comentarios."\",
    ad_cableado_comentarios = \"".$ad_cableado_comentarios."\",
    ad_canaletasEscalerillas_comentarios = \"".$ad_canaletasEscalerillas_comentarios."\",
    ad_dfo_comentarios = \"".$ad_dfo_comentarios."\",
    ad_dg_comentarios = \"".$ad_dg_comentarios."\",
    ad_etiquetado_comentarios = \"".$ad_etiquetado_comentarios."\",
    ad_instalacionDesmontaje_comentarios = \"".$ad_instalacionDesmontaje_comentarios."\",
    ad_obraCivil_comentarios = \"".$ad_obraCivil_comentarios."\",
    ad_rda_comentarios = \"".$ad_rda_comentarios."\",
    ad_tierra_comentarios = \"".$ad_tierra_comentarios."\",
    ad_otrosMateriales_comentarios = \"".$ad_otrosMateriales_comentarios."\",
    pl_comentarios = \"".$pl_comentarios."\",
    ".$fecha_captura."
    estatus = '".$estatus."'
    WHERE folio = '".$folio."';
    ";    
    mysql_query($altaadecuacion);
}
function interbdtd($folio,$punta,$ubicacion_bdtd,$posicion_tablilla,$lado,$posicion_contacto,$tipo_conector,$tipo_cable,$longitud_cable){
    require '../conexion.php';
    $existe = mysql_query("SELECT folio FROM zinter_bdtd WHERE folio = '".$folio."' AND punta = '".$punta."';");
    $existe = mysql_fetch_array($existe, MYSQL_BOTH);
    $existe = $existe[0];
    if($existe == null){
        $nuevo = "INSERT INTO zinter_bdtd VALUES(id,'".$folio."','".$punta."','".$ubicacion_bdtd."','".$posicion_tablilla."',
        '".$lado."','".$posicion_contacto."','".$tipo_conector."','".$tipo_cable."','".$longitud_cable."')";
        mysql_query($nuevo);
    }
    else{
        $actualiza = "UPDATE zinter_bdtd SET 
        ubicacion_bdtd = '".$ubicacion_bdtd."',
        posicion_tablilla = '".$posicion_tablilla."',
        lado = '".$lado."',
        posicion_contacto = '".$posicion_contacto."',
        tipo_conector = '".$tipo_conector."',
        tipo_cable = '".$tipo_cable."',
        longitud_cable = '".$longitud_cable."' WHERE folio = '".$folio."' AND punta = '".$punta."';";
        mysql_query($actualiza);
    }
}
function interdfo($folio,$punta,$ubicacion_bdfo,$dfo,$posicion_remate,$tipo_conector_equipo,$tipo_fibra,$cantidad_fibra,$tipo_conector_lado_dfo,$longitud_cable){
    require '../conexion.php';
    $existe = mysql_query("SELECT folio FROM zinter_bdfo WHERE folio = '".$folio."' AND punta = '".$punta."';");
    $existe = mysql_fetch_array($existe, MYSQL_BOTH);
    $existe = $existe[0];
    if($existe == null){
        $nuevo = "INSERT INTO zinter_bdfo VALUES (id,'".$folio."','".$punta."','".$ubicacion_bdfo."',
        '".$dfo."','".$posicion_remate."','".$tipo_conector_equipo."','".$tipo_fibra."','".$cantidad_fibra."',
        '".$tipo_conector_lado_dfo."','".$longitud_cable."');";
        mysql_query($nuevo);
    }
    else{
        $actualiza = "UPDATE zinter_bdfo SET ubicacion_bdfo = '".$ubicacion_bdfo."',
        dfo = '".$dfo."', posicion_remate = '".$posicion_remate."', tipo_conector_equipo = '".$tipo_conector_equipo."',
        tipo_fibra = '".$tipo_fibra."', cantidad_fibra = '".$cantidad_fibra."', tipo_conector_lado_dfo = '".$tipo_conector_lado_dfo."',
        longitud_cable = '".$longitud_cable."' WHERE folio = '".$folio."' AND punta = '".$punta."';";
        mysql_query($actualiza);
    }
}
?>