<?php
header("Content-Type: text/html;charset=utf-8");
include 'conexion.php';
print_r($_POST);
function cleanArray($vector){
    $countdown = 0;
    $nuvector = array();
    for($c = 0; $c < count($vector); $c++){
        if(!is_null($vector[$c])){
            $nuvector[$countdown] = $vector[$c];
            $countdown++;
        }
    }
    return $nuvector;
}
function ubequipos($ubicacion_x_equipo,$folio,$nuevoExistente){
    $id; $cont1 = 0;
    $query = "SELECT id FROM zss_equipos WHERE folio = '".$folio."';";
    $modelos = mysql_query($query, $conectar2);
    $sz = mysql_num_rows($modelos);
    if($sz > 0){
        for($b = 0; $b < $sz; $b++){
            $md = mysql_fetch_array($modelos);
            $id[$b] = $md['id'];
        }
    }
    for($c = 0; $c < count($id); $c++){
        $ubicacion = mysql_query("UPDATE zss_equipos SET 
            ubicacion = '".$ubicacion_x_equipo[$c]."', nuevoExistente = '".$nuevoExistente[$c]."' WHERE id = ".$id[$c].";");
    }
}
/*------------------------------------------------------------------
 * GUARDAR DATOS DE ESTADO GENERAL DE SITIO
 -------------------------------------------------------------------*/
function estadositio(
        $folio,
        $flag,
        $eg_tipotrabajo,
        $eg_coment_tipotrabajo,
        $eg_tipocentral,
        $eg_coment_tipocentral,
        $eg_tipodepiso,
        $eg_coment_tipodepiso,
        $eg_obracivil,
        $eg_coment_obracivil,
        $eg_tipomaniobra,
        $eg_coment_tipomaniobra,
        $eg_coment_can,
        $afo_bastidor_fibra,
        $afo_bastidor_fibra_espacio,
        $afo_tipo_bastidor_fibra,
        $afo_bastidor_marca,
        $afo_bloque_dfo,
        $afo_canaleta,
        $afo_canaleta_altura,
        $afo_canaleta_longitud,
        $afo_coment_canaleta,
        $afo_canaleta_tipo,
        $afo_canaleta_tipo_mt,
        $afo_canaleta_tipo_in,
        $afo_coment_canaleta_tipo,
        $afo_comentarios,
        $bfo_bastidor_fibra,
        $bfo_bastidor_fibra_espacio,
        $bfo_tipo_bastidor_fibra,
        $bfo_bastidor_marca,
        $bfo_bloque_dfo,
        $bfo_canaleta,
        $bfo_canaleta_altura,
        $bfo_canaleta_longitud,
        $bfo_coment_canaleta,
        $bfo_canaleta_tipo,
        $bfo_canaleta_tipo_mt,
        $bfo_canaleta_tipo_in,
        $bfo_coment_canaleta_tipo,
        $bfo_comentarios,
        $mp_dgral,
        $mp_disgral,
        $mp_ampvertical,
        $mp_spadisp,
        $mp_canaleta,
        $mp_canaleta_altura,
        $mp_canaleta_longitud,
        $mp_canaleta_coment,
        $mp_canaleta_tipo,
        $mp_canaleta_tipo_mt,
        $mp_canaleta_tipo_in,
        $mp_coment_canaleta_tipo,
        $mp_comentarios,        
        $cx_escalerilla_bdtd,
        $cx_escalerilla_bdtd_espacio,
        $cx_tipo_escalerilla_bdtd,
        $cx_canaleta,
        $cx_canaleta_altura,
        $cx_canaleta_longitud,
        $cx_escalerilla_coment,
        $cx_canaleta_tipo,
        $cx_canaleta_tipo_mt,
        $cx_canaleta_tipo_in,
        $cx_coment_canaleta_tipo,
        $cx_comentarios,        
        $gs_requiereGestion,
        $gs_tipoGestion,
        $gs_puertoRCDT,
        $gs_requiereSincronia,
        $gs_cnAddAlarmas,
        $gs_reqctoalim,
        $gs_canaleta,
        $gs_canaleta_altura,
        $gs_canaleta_longitud,
        $gs_canaleta_coment,
        $gs_canaleta_tipo,
        $gs_canaleta_tipo_mt,
        $gs_canaleta_tipo_in,
        $gs_coment_canaleta_tipo,
        $gs_comentarios,        
        $fz_tp_alimen,
        $fz_configplanta,
        $fz_longcabletierra,
        $fz_escalerilla_bdtd,
        $fz_cl_reqnucl,
        $fz_consumo,
        $fz_canaleta,
        $fz_canaleta_altura,
        $fz_canaleta_longitud,
        $fz_escalerilla_coment,
        $fz_canaleta_tipo,
        $fz_canaleta_tipo_mt,
        $fz_canaleta_tipo_in,
        $fz_coment_canaleta_tipo,
        $fz_comentarios,
        $pl_comentarios
        ){
    
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
    $query = mysql_query("UPDATE zsite_survey SET 
        eg_tipotrabajo = '".$eg_tipotrabajo."',
        eg_coment_tipotrabajo = \"".$eg_coment_tipotrabajo."\",
        eg_tipocentral = '".$eg_tipocentral."',
        eg_coment_tipocentral = \"".$eg_coment_tipocentral."\",
        eg_tipodepiso = '".$eg_tipodepiso."',
        eg_coment_tipodepiso = \"".$eg_coment_tipodepiso."\",
        eg_obracivil = '".$eg_obracivil."',
        eg_coment_obracivil = \"".$eg_coment_obracivil."\",
        eg_tipomaniobra = '".$eg_tipomaniobra."',
        eg_coment_tipomaniobra = \"".$eg_coment_tipomaniobra."\",
        eg_coment_can = \"".$eg_coment_can."\",
        afo_bastidor_fibra = '".$afo_bastidor_fibra."',
        afo_bastidor_fibra_espacio = '".$afo_bastidor_fibra_espacio."',
        afo_tipo_bastidor_fibra = '".$afo_tipo_bastidor_fibra."',
        afo_bastidor_marca = '".$afo_bastidor_marca."',
        afo_bloque_dfo = '".$afo_bloque_dfo."',
        afo_canaleta = '".$afo_canaleta."',
        afo_canaleta_altura = '".$afo_canaleta_altura."',
        afo_canaleta_longitud = '".$afo_canaleta_longitud."',
        afo_coment_canaleta = \"".$afo_coment_canaleta."\",
        afo_canaleta_tipo = '".$afo_canaleta_tipo."',
        afo_canaleta_tipo_mt = '".$afo_canaleta_tipo_mt."',
        afo_canaleta_tipo_in = '".$afo_canaleta_tipo_in."',
        afo_coment_canaleta_tipo = \"".$afo_coment_canaleta_tipo."\",
        afo_comentarios = \"".$afo_comentarios."\",
        bfo_bastidor_fibra = '".$bfo_bastidor_fibra."',
        bfo_bastidor_fibra_espacio = '".$bfo_bastidor_fibra_espacio."',
        bfo_tipo_bastidor_fibra = '".$bfo_tipo_bastidor_fibra."',
        bfo_bastidor_marca = '".$bfo_bastidor_marca."',
        bfo_bloque_dfo = '".$bfo_bloque_dfo."',
        bfo_canaleta = '".$bfo_canaleta."',
        bfo_canaleta_altura = '".$bfo_canaleta_altura."',
        bfo_canaleta_longitud = '".$bfo_canaleta_longitud."',
        bfo_coment_canaleta = \"".$bfo_coment_canaleta."\",
        bfo_canaleta_tipo = '".$bfo_canaleta_tipo."',
        bfo_canaleta_tipo_mt = '".$bfo_canaleta_tipo_mt."',
        bfo_canaleta_tipo_in = '".$bfo_canaleta_tipo_in."',
        bfo_coment_canaleta_tipo = \"".$bfo_coment_canaleta_tipo."\",
        bfo_comentarios = \"".$bfo_comentarios."\",
        mp_dgral = '".$mp_dgral."',
        mp_disgral = '".$mp_disgral."',
        mp_ampvertical = '".$mp_ampvertical."',
        mp_spadisp = '".$mp_spadisp."',
        mp_canaleta = '".$mp_canaleta."',
        mp_canaleta_altura = '".$mp_canaleta_altura."',
        mp_canaleta_longitud = '".$mp_canaleta_longitud."',
        mp_canaleta_coment = \"".$mp_canaleta_coment."\",
        mp_canaleta_tipo = '".$mp_canaleta_tipo."',
        mp_canaleta_tipo_mt = '".$mp_canaleta_tipo_mt."',
        mp_canaleta_tipo_in = '".$mp_canaleta_tipo_in."',
        mp_coment_canaleta_tipo = \"".$mp_coment_canaleta_tipo."\",
        mp_comentarios = \"".$mp_comentarios."\",            
        cx_escalerilla_bdtd = '".$cx_escalerilla_bdtd."',
        cx_escalerilla_bdtd_espacio = '".$cx_escalerilla_bdtd_espacio."',
        cx_tipo_escalerilla_bdtd = '".$cx_tipo_escalerilla_bdtd."',
        cx_canaleta = '".$cx_canaleta."',
        cx_canaleta_altura = '".$cx_canaleta_altura."',
        cx_canaleta_longitud = '".$cx_canaleta_longitud."',
        cx_escalerilla_coment = \"".$cx_escalerilla_coment."\",
        cx_canaleta_tipo = '".$cx_canaleta_tipo."',
        cx_canaleta_tipo_mt = '".$cx_canaleta_tipo_mt."',
        cx_canaleta_tipo_in = '".$cx_canaleta_tipo_in."',
        cx_coment_canaleta_tipo = \"".$cx_coment_canaleta_tipo."\",
        cx_comentarios = \"".$cx_comentarios."\",            
        gs_requieregestion = '".$gs_requiereGestion."',
        gs_tipogestion = '".$gs_tipoGestion."',
        gs_puertoRCDT = '".$gs_puertoRCDT."',
        gs_requieresincronia = '".$gs_requiereSincronia."',
        gs_cnaddalarmas = '".$gs_cnAddAlarmas."',
        gs_reqctoalim = '".$gs_reqctoalim."',
        gs_canaleta = '".$gs_canaleta."',
        gs_canaleta_altura = '".$gs_canaleta_altura."',
        gs_canaleta_longitud = '".$gs_canaleta_longitud."',
        gs_canaleta_coment = \"".$gs_canaleta_coment."\",
        gs_canaleta_tipo = '".$gs_canaleta_tipo."',
        gs_canaleta_tipo_mt = '".$gs_canaleta_tipo_mt."',
        gs_canaleta_tipo_in = '".$gs_canaleta_tipo_in."',
        gs_coment_canaleta_tipo = \"".$gs_coment_canaleta_tipo."\",
        gs_comentarios = \"".$gs_comentarios."\",            
        fz_tp_alimen = '".$fz_tp_alimen."',
        fz_configplanta = '".$fz_configplanta."',
        fz_longcabletierra = '".$fz_longcabletierra."',
        fz_escalerilla_bdtd = '".$fz_escalerilla_bdtd."',
        fz_cl_reqnucl = '".$fz_cl_reqnucl."',
        fz_consumo = '".$fz_consumo."',
        fz_canaleta = '".$fz_canaleta."',
        fz_canaleta_altura = '".$fz_canaleta_altura."',
        fz_canaleta_longitud = '".$fz_canaleta_longitud."',
        fz_escalerilla_coment =\"".$fz_escalerilla_coment."\",
        fz_canaleta_tipo = '".$fz_canaleta_tipo."',
        fz_canaleta_tipo_mt = '".$fz_canaleta_tipo_mt."',
        fz_canaleta_tipo_in = '".$fz_canaleta_tipo_in."',
        fz_coment_canaleta_tipo = \"".$fz_coment_canaleta_tipo."\",
        fz_comentarios = \"".$fz_comentarios."\",
        pl_comentarios = \"".$pl_comentarios."\",
        ".$fecha_captura."
        estatus = '".$estatus."'
        WHERE folio = '".$folio."';");
}
/*------------------------------------------------------------------
 * GUARDAR INTERCONEXIONES OPTICAS [BAJO Y ALTO ORDEN]
 -------------------------------------------------------------------*/
function interconexionesABFO($folio,$ab,$numero_equipos,$afo_id,$afo_mdl,$afo_ub,$afo_dfo,$afo_psrem,$afo_cox,$afo_fibra,$afo_condfo,$afo_bloquedfo,$afo_ljuno,$afo_ljdos){
    
    if($afo_id == 'n'){//GUARDA DATOS NUEVOS SOLAMENTE
        echo $numero_equipos;
        for($g = 0; $g < $numero_equipos; $g++){

            $nuinter = "INSERT INTO zinter_abfo VALUES (id,
                '".$folio."',
                ".$ab.",
                0,
                '".$afo_ub[$g]."',
                '".$afo_dfo[$g]."',
                '".$afo_psrem[$g]."',
                '".$afo_cox[$g]."',
                '".$afo_fibra[$g]."',
                '".$afo_condfo[$g]."',
                'Tx',
                '".$afo_bloquedfo[$g]."',
                '".$afo_ljuno[$g]."',
                '".$afo_ljdos[$g]."');";
        echo "</br>Nuevo:".$nuinter;
           // mysql_query($nuinter) or die(mysql_error());
        }        
    }
    else{

        $afo_id = cleanArray($afo_id);
        $tm1 = count($afo_id);
        //echo '<br/>';
        $tm2 = count($afo_mdl);
        //var_dump($tm1);
        //ACTUALIZAR ELEMENTOS EXISTENTES
        for($f = 0; $f < $tm1; $f++){
                $actintabof = "UPDATE zinter_abfo SET 
                ubicacion = '".$afo_ub[$f]."', 
                dfo = '".$afo_dfo[$f]."',
                posicion_remate = '".$afo_psrem[$f]."', 
                tipo_conector_equipo = '".$afo_cox[$f]."', 
                tipo_fibra = '".$afo_fibra[$f]."',
                tipo_conector_bdfo = '".$afo_condfo[$f]."',
                bloque_dfo = '".$afo_bloquedfo[$f]."',
                long_jumper_1 = '".$afo_ljuno[$f]."',
                long_jumper_2 = '".$afo_ljdos[$f]."' 
                WHERE id = ".$afo_id[$f]." AND alto_bajo = ".$ab.";"; 
                #echo '<br/>'. $actintabof;
                #mysql_query($actintabof);
        }
        for($z = $tm1; $z < $tm2; $z++){
                $nuinter2 = "INSERT INTO zinter_abfo(id,folio,alto_bajo,id_equipo,
                ubicacion,dfo,posicion_remate,tipo_conector_equipo,
                tipo_fibra,tipo_conector_bdfo,Tx_Rx,bloque_dfo,long_jumper_1,long_jumper_2)
                VALUES (id,
                '".$folio."',
                ".$ab.",
                ".$afo_mdl[$z].",
                '".$afo_ub[$z]."',
                '".$afo_dfo[$z]."',
                '".$afo_psrem[$z]."',
                '".$afo_cox[$z]."',
                '".$afo_fibra[$z]."',
                '".$afo_condfo[$z]."',
                'Tx',
                '".$afo_bloquedfo[$z]."'
                '".$afo_ljuno[$z]."',
                '".$afo_ljdos[$z]."');";
                echo '$nuinter2<br/>';
                mysql_query($nuinter2);
        }
    }
}
function interconexionesMP($folio,$numero_equipos,$mp_id,$mp_mod,$mp_vtc,$mp_nvl,$mp_tptab,$mp_lcabl){
    
    if($mp_id == 'n'){//GUARDA DATOS NUEVOS SOLAMENTE
        for($g = 0; $g < $numero_equipos; $g++){
            $nump = "INSERT INTO zinter_mp VALUES (id,
            '".$folio."',
            0,
            '".$mp_vtc[$g]."',
            '".$mp_nvl[$g]."',
            '".$mp_tptab[$g]."',
            ".$mp_lcabl[$g].");";
            mysql_query($nump);
        }        
    }
    else{
        $mp_id = cleanArray($mp_id);
        $tm1 = count($mp_id);
        $tm2 = count($mp_mod);
        for($i = 0; $i < $tm1; $i++){
            $query = "UPDATE zinter_mp SET vertical = '".$mp_vtc[$i]."', 
            nivel = '".$mp_nvl[$i]."', tipo_tablilla = '".$mp_tptab[$i]."', 
            long_cable = ".$mp_lcabl[$i]." WHERE id = ".$mp_id[$i];
            mysql_query($query);
        }
        for($j = $tm1; $j < $tm2; $j++){
            $nump = "INSERT INTO zinter_mp VALUES (id,
            '".$folio."',
            0,
            '".$mp_vtc[$j]."',
            '".$mp_nvl[$j]."',
            '".$mp_tptab[$j]."',
            ".$mp_lcabl[$j].");";
            mysql_query($nump);
        }
    }
}
function interconexionesCX($folio,$numero_equipos,$cx_id,$cx_mod,$cx_ub,$cx_ptab,$cx_lado,$cx_pcont,$cx_tcon,$cx_tcx,$cx_txrx,$cx_lcabl){
    
    if($cx_id == 'n'){//GUARDA DATOS NUEVOS SOLAMENTE
        for($j = 0; $j < $numero_equipos; $j++){
            $nump = "INSERT INTO zinter_cx VALUES (id,
            '".$folio."',
            ".$cx_mod[$j].",
            '".$cx_ub[$j]."',
            '".$cx_ptab[$j]."',
            '".$cx_lado[$j]."',
            '".$cx_pcont[$j]."',
            '".$cx_tcon[$j]."',
            '".$cx_tcx[$j]."',
            '".$cx_txrx[$j]."',
            ".$cx_lcabl[$j].");";
            mysql_query($nump);
        }        
    }
    else{
        $cx_id = cleanArray($cx_id);
        $tm1 = count($cx_id);
        $tm2 = count($cx_mod);
        for($i = 0; $i < $tm1; $i++){
            $updateCX = "UPDATE zinter_cx SET 
            ubicacion = '".$cx_ub[$i]."',
            pos_tablilla = '".$cx_ptab[$i]."',
            lado = '".$cx_lado[$i]."',
            pos_contacto = '".$cx_pcont[$i]."',
            tipo_conector = '".$cx_tcon[$i]."',
            tipo_coaxial = '".$cx_tcx[$i]."',
            tx_rx = '".$cx_txrx[$i]."',
            long_cable = ".$cx_lcabl[$i]." WHERE id = ".$cx_id[$i].";";
            mysql_query($updateCX);
        }
        for($j = $tm1; $j < $tm2; $j++){
            $nump = "INSERT INTO zinter_cx(id,folio,id_equipo,ubicacion,
            pos_tablilla,lado,pos_contacto,tipo_conector,tipo_coaxial,tx_rx,
            long_cable) VALUES (id,
            '".$folio."',
            ".$cx_mod[$j].",
            '".$cx_ub[$j]."',
            '".$cx_ptab[$j]."',
            '".$cx_lado[$j]."',
            '".$cx_pcont[$j]."',
            '".$cx_tcon[$j]."',
            '".$cx_tcx[$j]."',
            '".$cx_txrx[$j]."',
            ".$cx_lcabl[$j].");";
            mysql_query($nump);
        }
    }
}

function interconexionesGS($folio,$gs,$numero_equipos,$g_mod,$g_ubRCDT,$g_nswitch,$g_puerto,$g_catcable,$g_lcable,$g_tcon){
    
    $idGS;
    $existeFolioGS = "SELECT folio FROM zinter_gs WHERE folio = '".$folio."' AND gestionSincronia = ".$gs." GROUP BY folio";
    $resultadogs = mysql_query($existeFolioGS);
    $tm = mysql_num_rows($resultadogs);
    if($tm > 0){
        $buscaIDgs = "SELECT id FROM zinter_gs WHERE folio = '".$folio."' AND gestionSincronia = ".$gs." ORDER BY id ASC";
        $returnID = mysql_query($buscaIDgs);
        $sz = mysql_num_rows($returnID);
        if($sz > 0){
            for($w = 0; $w < $sz; $w++){
                $idsgs = mysql_fetch_array($returnID);
                $idGS[$w] = $idsgs['id'];
            }
        }
        for($w = 0; $w < $numero_equipos; $w++){
            $actualizar = "UPDATE zinter_gs SET 
            ubicacion_RCDT = '".$g_ubRCDT[$w]."',
            numero_switch = '".$g_nswitch[$w]."',
            puerto = '".$g_puerto[$w]."',
            cat_cable = '".$g_catcable[$w]."',
            long_cable = ".$g_lcable[$w].",
            tipo_conector = '".$g_tcon[$w]."' WHERE id = ".$idGS[$w]." AND gestionSincronia = ".$gs;
            $actualizar.'<br/>';
            $updateGS = mysql_query($actualizar);
        }
    }
    else{
        for($j = 0; $j < $numero_equipos; $j++){
        $altaGS = mysql_query("INSERT INTO zinter_gs VALUES (id, 
        '".$folio."', 
        ".$gs.", 
        ".$g_mod[$j].", 
        '".$g_ubRCDT[$j]."', 
        '".$g_nswitch[$j]."', 
        '".$g_puerto[$j]."',
        '".$g_catcable[$j]."', 
        ".$g_lcable[$j].",
        '".$g_tcon[$j]."');");            
        }
    }
}
function interconexionesFZ($folio,$fz,$numero_equipos,$fz_t_id,$fz_mod,$fz_t_ubalim,$fz_t_break,$fz_t_fusible,$fz_t_calibre,$fz_t_fuerza,$fz_t_cable,$fz_t_zapata,$fz_t_nuex){
    
    $existFolioFZ = "SELECT folio FROM zinter_fz WHERE folio = '".$folio."' AND trabajo_respaldo = ".$fz." GROUP BY folio";
    $resultfz = mysql_query($existFolioFZ);
    $sz = mysql_num_rows($resultfz);
    if($sz > 0){
        $idfz;
        $buscaidfz = "SELECT id FROM zinter_fz WHERE folio = '".$folio."' AND trabajo_respaldo = ".$fz." ORDER BY id";
        $salidaid = mysql_query($buscaidfz);
        $tm = mysql_num_rows($salidaid);
        if($tm > 0){
            for($i = 0; $i < $tm; $i++){
                $ifz = mysql_fetch_array($salidaid);
                $idfz[$i] = $ifz['id'];
            }
        }
        for($x = 0; $x < $numero_equipos; $x++){
            if(isset($idfz[$x])){
                $actualizar = "UPDATE zinter_fz SET
                ub_alimen = '".$fz_t_ubalim[$x]."',
                pf_breaker = '".$fz_t_break[$x]."',
                cap_fusible = '".$fz_t_fusible[$x]."',
                calibre = '".$fz_t_calibre[$x]."',
                l_cable = '".$fz_t_fuerza[$x]."',
                c_cable = '".$fz_t_cable[$x]."',
                t_zapata = '".$fz_t_zapata[$x]."',
                nuevo_existente = '".$fz_t_nuex[$x]."'
                WHERE folio = '".$folio."' AND trabajo_respaldo = ".$fz." AND id = ".$idfz[$x];
                //echo '<br/>';
                mysql_query($actualizar);
            }
            else{
                $altaFZ = "insert into zinter_fz VALUES(id,'".$folio."',".$fz.",".$fz_mod[$i].",null,'".$fz_t_ubalim[$i]."','".$fz_t_nuex[$x]."','".$fz_t_break[$i]."','".$fz_t_fusible[$i]."','".$fz_t_calibre[$i]."','".$fz_t_fuerza[$i]."','".$fz_t_cable[$i]."','".$fz_t_zapata[$i]."')";
                mysql_query($altaFZ);
            }
        }
    }
    else{
        for($i = 0; $i < $numero_equipos; $i++){
            $altaFZ = mysql_query("INSERT INTO zinter_fz VALUES (id, 
                '".$folio."', 
                ".$fz.",
                '".$fz_mod[$i]."', 
                '".$fz_t_ubalim[$i]."', 
                '".$fz_t_break[$i]."', 
                '".$fz_t_fusible[$i]."',
                '".$fz_t_calibre[$i]."', 
                '".$fz_t_fuerza[$i]."', 
                '".$fz_t_cable[$i]."', 
                '".$fz_t_zapata[$i]."');");
        }
    }
}
function execute($folio,$fecha_ejecucion){
    $fecha = "UPDATE zsite_survey SET fecha_ejecucion = '".$fecha_ejecucion."' WHERE folio = '".$folio."'";
    mysql_query($fecha);
}
function mascorreos($folio,$emails,$enombres){
    for($i = 0; $i < (count($emails)); $i++){
        $query = "INSERT INTO zccemails VALUES (id,'".$folio."','".$enombres[$i]."','".$emails[$i]."');";
        mysql_query($query);
    }
    return FALSE;
}
/*
$query = mysql_query("UPDATE zsite_survey SET 
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
        afo_bastidor_fibra = '".$afo_bastidor_fibra."',
        afo_tipo_bastidor_fibra = '".$afo_tipo_bastidor_fibra."',
        afo_bastidor_marca = '".$afo_bastidor_marca."',
        afo_canaleta = '".$afo_canaleta."',
        afo_canaleta_altura = '".$afo_canaleta_altura."',
        afo_canaleta_longitud = '".$afo_canaleta_longitud."',
        afo_coment_canaleta = \"".$afo_coment_canaleta."\",
        afo_canaleta_tipo = '".$afo_canaleta_tipo."',
        afo_canaleta_tipo_mt = '".$afo_canaleta_tipo_mt."',
        afo_canaleta_tipo_in = '".$afo_canaleta_tipo_in."',
        afo_coment_canaleta_tipo = \"".$afo_coment_canaleta_tipo."\",
        afo_comentarios = \"".$afo_comentarios."\",
        bfo_bastidor_fibra = '".$bfo_bastidor_fibra."',
        bfo_tipo_bastidor_fibra = '".$bfo_tipo_bastidor_fibra."',
        bfo_bastidor_marca = '".$bfo_bastidor_marca."',
        bfo_canaleta = '".$bfo_canaleta."',
        bfo_canaleta_altura = '".$bfo_canaleta_altura."',
        bfo_canaleta_longitud = '".$bfo_canaleta_longitud."',
        bfo_coment_canaleta = \"".$bfo_coment_canaleta."\",
        bfo_canaleta_tipo = '".$bfo_canaleta_tipo."',
        bfo_canaleta_tipo_mt = '".$bfo_canaleta_tipo_mt."',
        bfo_canaleta_tipo_in = '".$bfo_canaleta_tipo_in."',
        bfo_coment_canaleta_tipo = \"".$bfo_coment_canaleta_tipo."\",
        bfo_comentarios = \"".$bfo_comentarios."\",
        mp_dgral = '".$mp_dgral."',
        mp_disgral = '".$mp_disgral."',
        mp_canaleta = '".$mp_canaleta."',
        mp_canaleta_altura = '".$mp_canaleta_altura."',
        mp_canaleta_longitud = '".$mp_canaleta_longitud."',
        mp_canaleta_coment = \"".$mp_canaleta_coment."\",
        mp_canaleta_tipo = '".$mp_canaleta_tipo."',
        mp_canaleta_tipo_mt = '".$mp_canaleta_tipo_mt."',
        mp_canaleta_tipo_in = '".$mp_canaleta_tipo_in."',
        mp_coment_canaleta_tipo = \"".$mp_coment_canaleta_tipo."\",
        mp_comentarios = \"".$mp_comentarios."\",            
        cx_escalerilla_bdtd = '".$cx_escalerilla_bdtd."',
        cx_tipo_escalerilla_bdtd = '".$cx_tipo_escalerilla_bdtd."',
        cx_canaleta = '".$cx_canaleta."',
        cx_canaleta_altura = '".$cx_canaleta_altura."',
        cx_canaleta_longitud = '".$cx_canaleta_longitud."',
        cx_escalerilla_coment = \"".$cx_escalerilla_coment."\",
        cx_canaleta_tipo = '".$cx_canaleta_tipo."',
        cx_canaleta_tipo_mt = '".$cx_canaleta_tipo_mt."',
        cx_canaleta_tipo_in = '".$cx_canaleta_tipo_in."',
        cx_coment_canaleta_tipo = \"".$cx_coment_canaleta_tipo."\",
        cx_comentarios = \"".$cx_comentarios."\",            
        gs_requieregestion = '".$gs_requiereGestion."',
        gs_tipogestion = '".$gs_tipoGestion."',
        gs_puertoRCDT = '".$gs_puertoRCDT."',
        gs_requieresincronia = '".$gs_requiereSincronia."',
        gs_cnaddalarmas = '".$gs_cnAddAlarmas."',
        gs_canaleta = '".$gs_canaleta."',
        gs_canaleta_altura = '".$gs_canaleta_altura."',
        gs_canaleta_longitud = '".$gs_canaleta_longitud."',
        gs_canaleta_coment = \"".$gs_canaleta_coment."\",
        gs_canaleta_tipo = '".$gs_canaleta_tipo."',
        gs_canaleta_tipo_mt = '".$gs_canaleta_tipo_mt."',
        gs_canaleta_tipo_in = '".$gs_canaleta_tipo_in."',
        gs_coment_canaleta_tipo = \"".$gs_coment_canaleta_tipo."\",
        gs_comentarios = \"".$gs_comentarios."\",            
        fz_tp_alimen = '".$fz_tp_alimen."',
        fz_configplanta = '".$fz_configplanta."',
        fz_escalerilla_bdtd = '".$fz_escalerilla_bdtd."',
        fz_consumo = '".$fz_consumo."',
        fz_canaleta = '".$fz_canaleta."',
        fz_canaleta_altura = '".$fz_canaleta_altura."',
        fz_canaleta_longitud = '".$fz_canaleta_longitud."',
        fz_escalerilla_coment =\"".$fz_escalerilla_coment."\",
        fz_canaleta_tipo = '".$fz_canaleta_tipo."',
        fz_canaleta_tipo_mt = '".$fz_canaleta_tipo_mt."',
        fz_canaleta_tipo_in = '".$fz_canaleta_tipo_in."',
        fz_coment_canaleta_tipo = \"".$fz_coment_canaleta_tipo."\",
        fz_comentarios = \"".$fz_comentarios."\",
        pl_comentarios = \"".$pl_comentarios."\",
        ".$fecha_captura."
        estatus = '".$estatus."'
        WHERE folio = '".$folio."';");
 *  */

function recuperarCanaleta($tag){
    $labels = array(2=>'afo',3=>'bfo',4=>'mtp',5=>'cxl',6=>'gys',7=>'fza');
    $cnAFO = array();
    for($i = 0; $i < 4; $i++){
        if(isset($_POST[$labels[$tag].'k'.$i])){
            $cnAFO[$i][0] = $_POST[$labels[$tag].'k'.$i];   //  checkbox
            $cnAFO[$i][1] = $_POST[$labels[$tag].'s'.$i];   //  nuevo/existente
            $cnAFO[$i][2] = $_POST[$labels[$tag].'he'.$i] == '' ? 0 : $_POST[$labels[$tag].'he'.$i];  //  altura
            $cnAFO[$i][3] = $_POST[$labels[$tag].'lg'.$i] == '' ? 0 : $_POST[$labels[$tag].'lg'.$i];  //  largo
            $cnAFO[$i][4] = $_POST[$labels[$tag].'in'.$i];  //  pulgadas
            $cnAFO[$i][5] = $_POST[$labels[$tag].'dw'.$i];  //  bajante
        }
        else{
            $cnAFO[$i][0] = 0;
            $cnAFO[$i][1] = 0;
            $cnAFO[$i][2] = 0;
            $cnAFO[$i][3] = 0;
            $cnAFO[$i][4] = 0;
            $cnAFO[$i][5] = 0;
        }
        if($i == 0){
            $cnAFO[$i][6] = addslashes($_POST[$labels[$tag].'cm']);     //  comentarios
        }
    }
    return $cnAFO;
}
function guardarCanaleta($folio,$tag,$arr){
    for($i = 0; $i < 4; $i++){
        $com = $i == 0 ? ',comentarios="'.$arr[$i][6].'"' : '';
        $update = "UPDATE zcanaletas SET aplica=".$arr[$i][0].",nuevo_existente=".$arr[$i][1].",altura=".$arr[$i][2].",largo=".$arr[$i][3].",pulgadas=".$arr[$i][4].",bajante=".$arr[$i][5].$com." WHERE folio='".$folio."' AND material=".$i." AND tag=".$tag;
        mysql_query($update);
    }
}