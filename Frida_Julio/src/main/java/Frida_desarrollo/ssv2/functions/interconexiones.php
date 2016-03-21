<?php
header("Content-Type: text/html;charset=utf-8");
require 'conexion.php';
function tipoSiteSurvey($folio){
    $query = mysql_query("SELECT nuevo_adecuacion FROM zsite_survey WHERE folio = '".$folio."';");
    $query = mysql_fetch_array($query, MYSQL_BOTH);
    $query = $query[0];
    return $query;
}
function numbers(){
    $numbs = '';
    for($i = 101; $i <= 9999; $i++){
        if($i >= 101 && $i <= 999){
           $numbs .=  '<option value="0'.$i.'">0'.$i.'</option>';
        }
        else{
           $numbs .=  '<option value="'.$i.'">'.$i.'</option>'; 
        }
    }
    return $numbs;
}

function maxeq($folio){
    $query = mysql_query("SELECT COUNT('id') AS num FROM zss_equipos WHERE folio = '".$folio."';");
    $numequipos = mysql_result($query, 0, 0);
    return $numequipos;
}

function ubicacionEquipo($ub){
    if($ub != ''){
        $seq = array(' novalid','');
        $regexp = '/^([0-9]{2}|\+[A-Z0-9]{1}|0[A-Z]{1})\.(([^3CNY]{1})|CS[1-3]|N(|V)|Y[1-2])(10[1-9]|1[1-9][0-9]|[2-9][0-9]{2})(A|B)(0[1-9]|[1-9][0-9]){3}$/';
        $a = preg_match($regexp,$ub);
        return $seq[$a];
    }
    return '';    
}

function ubxeq($folio){
//	DETERMINAR SI ES TRANSPORTE O ACCESO
    $toa = mysql_query("SELECT rubro FROM zsite_survey WHERE folio='".$folio."'");
    $toa = mysql_fetch_array($toa,MYSQL_BOTH);
    $toa = $toa[0];
	/*	0 -> ninguno, 1 -> nuevo, 2 -> existente    */
    $selecteds;$equipos;$espacios;
	
    if($toa == 1 || $toa == 2){	//	TRANSPORTE
        $equipos = '<tr><td class="t">Nombre</td><td class="t">Equipo</td><td class="t" style="width:180px">Ubicacion</td><td class="t">Bastidor</td><td class="t">Espacio</td></tr>';
        $query = "SELECT zss_equipos.id,zss_equipos.nombre_equipo,ztecnologias.tipo_equipo,zss_equipos.ubicacion,zss_equipos.nuevoExistente,zss_equipos.espacio 
				  FROM ztecnologias,zss_equipos WHERE zss_equipos.folio='".$folio."' AND zss_equipos.id_tecnologia = ztecnologias.id";
        $result = mysql_query($query);
        $sz = mysql_num_rows($result);
        if($sz > 0){
            for($i = 0; $i < $sz; $i++){
                $eq = mysql_fetch_array($result);
                if($eq['nuevoExistente'] == 'Nuevo'){
                    $selecteds=array('','selected','');
                }
                else if($eq['nuevoExistente'] == 'Existente'){
                    $selecteds=array('','','selected');
                }
                else{
                    $selecteds=array('selected','','');
                }
                if($eq['espacio'] == 'Nuevo'){
                    $espacios=array('','selected','','');
                }
                else if($eq['espacio'] == 'Existente'){
                    $espacios=array('','','selected','');
                }
                else if($eq['espacio'] == 'Requiere Desmontaje'){
                    $espacios=array('','','','selected');
                }
                else{
                    $espacios=array('selected','','','');
                }
                $equipos .= '<tr style="height:22px"><td>'.$eq['nombre_equipo'].'</td><td>'.$eq['tipo_equipo'].'</td><td style="width:180px"><input type="text" class="other6" id="ubicacion_equipo'.$i.'" name="ubicacion_equipo'.$i.'" value="'.$eq['ubicacion'].'" onblur="ubicacion(this.id)"/><div class="help" onclick="popitup(\'ub_equipo.php?text=ubicacion_equipo'.$i.'&ub_tipo=repisa\')"></div></td><td><select name="nuevoEx'.$i.'"><option value="" '.$selecteds[0].'>Seleccionar</option><option value="Nuevo" '.$selecteds[1].'>Nuevo</option><option value="Existente" '.$selecteds[2].'>Existente</option></select></td><td><select name="espacio'.$i.'"><option value="" '.$espacios[0].'>Seleccionar</option><option value="Nuevo" '.$espacios[1].'>Nuevo</option><option value="Existente" '.$espacios[2].'>Existente</option><option value="Requiere Desmontaje" '.$espacios[3].'>Requiere Desmontaje</option></select><input type="hidden" name="idEq'.$i.'" value="'.$eq['id'].'"/></td></tr>';
            }
        }
    }
    else{// ACCESO
        $equipos = '<tr><td class="t" style="width:220px">Nombre</td><td class="t" style="width:130px">Tipo de trabajo</td><td class="t" style="width:150px">Ubicaci&oacute;n</td><td class="t">Bastidor</td><td class="t" style="width:100px">Puertos</td><td class="t" style="width:103px">Tarjetas</td><td class="t">Espacio</td></tr>';
	$query2 = "SELECT zss_equipos.id,zss_equipos.nombre_equipo,zss_equipos.tipo_trabajo,zss_equipos.ubicacion,zss_equipos.nuevoExistente,zss_equipos.puertos,zss_equipos.tarjetas,
			   zss_equipos.espacio,ztecnologias.puertos_tarjeta,ztecnologias.tarjetas_max FROM zss_equipos,ztecnologias WHERE zss_equipos.folio='".$folio."' AND 
			   zss_equipos.id_tecnologia=ztecnologias.id ORDER BY zss_equipos.id";
        $result2 = mysql_query($query2);
        $sz2 = mysql_num_rows($result2);
        if($sz2 > 0){
            for($j = 0; $j < $sz2; $j++){
                $d = mysql_fetch_array($result2);
                if($d['nuevoExistente'] == 'Nuevo'){
                    $selecteds=array('','selected','');
                }
                else if($d['nuevoExistente'] == 'Existente'){
                    $selecteds=array('','','selected');
                }
                else{
                    $selecteds=array('selected','','');
                }
                if($d['espacio'] == 'Nuevo'){
                    $espacios=array('','selected','','');
                }
                else if($d['espacio'] == 'Existente'){
                    $espacios=array('','','selected','');
                }
                else if($d['espacio'] == 'Requiere Desmontaje'){
                    $espacios=array('','','','selected');
                }
                else{
                    $espacios=array('selected','','','');
                }
                $attr = '';
                $red = ubicacionEquipo($d['ubicacion']);
                $equipos .= '<tr style="height:22px"><td>'.$d['nombre_equipo'].'</td><td>'.$d['tipo_trabajo'].'</td><td><input type="text" class="other8'.$red.'" id="ubicacion_equipo'.$j.'" name="ubicacion_equipo'.$j.'" value="'.$d['ubicacion'].'" onblur="repisa(this.id)"/><div class="help" onclick="popitup(\'ub_equipo.php?text=ubicacion_equipo'.$j.'&ub_tipo=repisa\')"></div></td><td><select name="nuevoEx'.$j.'" '.$attr.'><option value="" '.$selecteds[0].'>Seleccionar</option><option value="Nuevo" '.$selecteds[1].'>Nuevo</option><option value="Existente" '.$selecteds[2].'>Existente</option></select></td><td><input type="text" id="'.$d['puertos_tarjeta'].'|'.$d['tarjetas_max'].'" class="other9" name="puertosn'.$j.'" value="'.$d['puertos'].'"/></td><td><input type="text" class="other10" id="'.$d['puertos_tarjeta'].'|'.$d['tarjetas_max'].'" name="tarjetasn'.$j.'" value="'.$d['tarjetas'].'"/></td><td><select name="espacio'.$j.'" '.$attr.'><option value="" '.$espacios[0].'>Seleccionar</option><option value="Nuevo" '.$espacios[1].'>Nuevo</option><option value="Existente" '.$espacios[2].'>Existente</option><option value="Requiere Desmontaje" '.$espacios[3].'>Requiere Desmontaje</option></select></td><input type="hidden" name="idEq'.$j.'" value="'.$d['id'].'"/></tr>';
            }
        }
    }
    return $equipos;
}

function modelos($folio){
    $salida = '';;
    $modelos = "SELECT ztecnologias.id, ztecnologias.tipo_equipo FROM ztecnologias, zss_equipos WHERE zss_equipos.folio = '".$folio."' AND ztecnologias.id = zss_equipos.id_tecnologia;";
    $result = mysql_query($modelos);
    $nb = mysql_num_rows($result);
    if($nb > 0){
        for($j = 0; $j < $nb; $j++){
            $mdls = mysql_fetch_array($result);
            $salida .= '<option value="'.$mdls['id'].'">'.$mdls['tipo_equipo'].'</option>';
        }
    }
    return $salida;
}
function cabecera($folio,$tss){
    $headerdata = array();
    if($tss == 0){
        $query = "SELECT 
        zsite_survey.dir_div, 
        centrales.area, 
        centrales.sigcent, 
        centrales.edificio,
        DATE(zsite_survey.fecha_solicitud) AS fecha_solicitud,
        DATE(zsite_survey.fecha_programada) AS fecha_programada,
        DATE(zsite_survey.fecha_captura) AS fecha_captura,
        DATE(zsite_survey.fecha_ejecucion) AS fecha_ejecucion, 
        DATE(zsite_survey.fecha_validacion) AS fecha_validacion,
        zsite_survey.ctnombre,
        zsite_survey.cttelefono,
        zsite_survey.ctemail, 
        zsite_survey.cpnombre,
        zsite_survey.cptelefono,
        zsite_survey.cpemail,
        zsite_survey.estatus,
        zsite_survey.rubro,
        ztecnologias.tecnologia, 
        ztecnologias.proveedor,
        zsite_survey.ctmovil,
        zsite_survey.cpmovil,
        zsite_survey.rsnombre,
        zsite_survey.rstelefono,
        zsite_survey.rsmovil,
        zsite_survey.rsemail,
		zsite_survey.cpinombre,
        zsite_survey.cpitelefono,
        zsite_survey.cpimovil, 
        zsite_survey.cpiemail,
        zsite_survey.version
        FROM zsite_survey, ztecnologias, zss_equipos, centrales WHERE zsite_survey.folio = '".$folio."' AND zss_equipos.folio = zsite_survey.folio AND zss_equipos.id_tecnologia = ztecnologias.id AND centrales.id_ctl = zsite_survey.id_central
        GROUP BY zss_equipos.folio";
        $salida = mysql_query($query);
        $max = mysql_num_rows($salida);
        if($max > 0){
            for($h = 0; $h < $max; $h++){
                $datos = mysql_fetch_array($salida);
                $headerdata[0] = $datos['dir_div'];
                $headerdata[1] = $datos['area'];
                $headerdata[2] = $datos['sigcent'];
                $headerdata[3] = $datos['edificio'];
                $headerdata[4] = $datos['fecha_solicitud'];
                $headerdata[5] = $datos['fecha_programada'];
                $headerdata[6] = $datos['fecha_captura'];
                if($headerdata[6] == '0000-00-00' || $headerdata[6] == '' || $headerdata[6] == null){
                    $headerdata[6] = '';
                }
                $headerdata[7] = $datos['fecha_ejecucion'];
                if($headerdata[7] == '0000-00-00' || $headerdata[7] == '' || $headerdata[7] == null){
                    $headerdata[7] = '';
                }
                $headerdata[8] = $datos['fecha_validacion'];
                if($headerdata[8] == '0000-00-00' || $headerdata[8] == '' || $headerdata[8] == null){
                    $headerdata[8] = '';
                }
                $headerdata[9] = $datos['ctnombre'];
                $headerdata[10] = $datos['cttelefono'];
                $headerdata[11] = $datos['ctemail'];
                $headerdata[12] = $datos['cpnombre'];
                $headerdata[13] = $datos['cptelefono'];
                $headerdata[14] = $datos['cpemail'];
                $headerdata[15] = $datos['rubro'] == 1 ? 'TRANSPORTE' : 'ACCESO';
                $headerdata[16] = $datos['proveedor'];
                $headerdata[17] = $datos['estatus'];
                $headerdata[18] = $datos['tecnologia'];
                $headerdata[19] = $datos['ctmovil'];
                $headerdata[20] = $datos['cpmovil'];
                $headerdata[21] = $datos['rsnombre'];
                $headerdata[22] = $datos['rstelefono'];
                $headerdata[23] = $datos['rsmovil'];
                $headerdata[24] = $datos['rsemail'];
				$headerdata[25] = $datos['cpinombre'];
                $headerdata[26] = $datos['cpitelefono'];
                $headerdata[27] = $datos['cpimovil'];
                $headerdata[28] = $datos['cpiemail'];
                $headerdata[29] = $datos['version'];
            }
        }
    }
    else{
        $querytwo = "SELECT 
        centrales.dir_div, 
        centrales.area, 
        centrales.sigcent, 
        centrales.edificio,
        DATE(zsite_survey.fecha_solicitud) AS fecha_solicitud,
        DATE(zsite_survey.fecha_programada) AS fecha_programada,
        DATE(zsite_survey.fecha_captura) AS fecha_captura,
        DATE(zsite_survey.fecha_ejecucion) AS fecha_ejecucion, 
        DATE(zsite_survey.fecha_validacion) AS fecha_validacion,
        zsite_survey.fecha_ejecucion, 
        zsite_survey.fecha_validacion,
        zsite_survey.ctnombre,
        zsite_survey.cttelefono,
        zsite_survey.ctemail, 
        zsite_survey.cpnombre,
        zsite_survey.cptelefono,
        zsite_survey.cpemail,
        zsite_survey.estatus,
		zsite_survey.cpinombre,
        zsite_survey.cpitelefono,
        zsite_survey.cpimovil, 
        zsite_survey.cpiemail,
        zsite_survey.version
        FROM centrales, zsite_survey WHERE zsite_survey.folio = '".$folio."' AND centrales.id_ctl = zsite_survey.id_central";
        $salidatwo = mysql_query($querytwo);
        $sztwo = mysql_num_rows($salidatwo);
        if($sztwo > 0){
            for($i = 0; $i < $sztwo; $i++){
                $datos = mysql_fetch_array($salidatwo);
                $headerdata[0] = $datos['dir_div'];
                $headerdata[1] = $datos['area'];
                $headerdata[2] = $datos['sigcent'];
                $headerdata[3] = $datos['edificio'];
                $headerdata[4] = $datos['fecha_solicitud'];
                $headerdata[5] = $datos['fecha_programada'];
                $headerdata[6] = $datos['fecha_captura'];
                if($headerdata[6] == '0000-00-00' || $headerdata[6] == '' || $headerdata[6] == null){
                    $headerdata[6] = '';
                }
                $headerdata[7] = $datos['fecha_ejecucion'];
                if($headerdata[7] == '0000-00-00' || $headerdata[7] == '' || $headerdata[7] == null){
                    $headerdata[7] = '';
                }
                else{
                    $a = explode(' ', $headerdata[7]);
                    $headerdata[7] = $a[0];
                }
                $headerdata[8] = $datos['fecha_validacion'];
                if($headerdata[8] == '0000-00-00' || $headerdata[8] == '' || $headerdata[8] == null){
                    $headerdata[8] = '';
                }
                else{
                    $a = explode(' ', $headerdata[8]);
                    $headerdata[8] = $a[0];
                }
                $headerdata[9] = $datos['ctnombre'];
                $headerdata[10] = $datos['cttelefono'];
                $headerdata[11] = $datos['ctemail'];
                $headerdata[12] = $datos['cpnombre'];
                $headerdata[13] = $datos['cptelefono'];
                $headerdata[14] = $datos['cpemail'];
                $headerdata[15] = 'N/A';
                $headerdata[16] = 'N/A';
                $headerdata[17] = $datos['estatus'];
                $headerdata[18] = 'N/A';
                $headerdata[19] = $datos['version'];
            }
        }
        
    }
    return $headerdata;
}
function copiacorreo($folio){
    $copias = '';
    $query = "SELECT nombre, email FROM zccemails WHERE folio = '".$folio."';";
    $correos = mysql_query($query);
    $m = mysql_num_rows($correos);
    if($m > 0){
        $copias .= '<tr><td colspan="5">';
        for($a = 0; $a < $m; $a++){
            $mail = mysql_fetch_array($correos);
            $copias .= $mail['nombre'].', '.$mail['email'].';&nbsp;&nbsp;&nbsp;';
        }
        $copias .= '</td></tr>';
    }
    return $copias;
}
function intert01($folio,$ab,$tec){
    $pr;$tf;$tc;$dfo;
    $indice = $ab == 0 ? 'dwfo' : 'fo';
    $sm = $tec == 'GPON' && $ab == 0 ? 1 : 0;
    $gpon = array(
        array('maxlength="2"','onblur="remate(this.id)"'),
        array('','onblur="rematev2(this.id)"')
    );
    $cont = 1;
    $tabla = '';
    $query = "SELECT zss_equipos.nombre_equipo,zinter_abfo.id,zinter_abfo.ubicacion,zinter_abfo.dfo,zinter_abfo.posicion_remate,zinter_abfo.tipo_conector_equipo,zinter_abfo.tipo_fibra,zinter_abfo.tipo_conector_bdfo,zinter_abfo.bloque_dfo,zinter_abfo.long_jumper_1,zinter_abfo.long_jumper_2 FROM zinter_abfo,zss_equipos WHERE zinter_abfo.id_equipo=zss_equipos.id AND zinter_abfo.folio='".$folio."' AND zss_equipos.id_tecnologia!=0 AND zinter_abfo.alto_bajo=".$ab." ORDER BY zss_equipos.id ASC";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $data02 = mysql_fetch_array($result);
            
            if($data02['posicion_remate'] == 'FC'){$pr = array('','selected','','','');}
            else if($data02['posicion_remate'] == 'SC'){$pr = array('','','selected','','');}
            else if($data02['posicion_remate'] == 'LC'){$pr = array('','','','selected','');}
            else if($data02['posicion_remate'] == 'Otro'){$pr = array('','','','','selected');}
            else{$pr = array('selected','','','','');}
            
            if($data02['tipo_fibra']=='MM-SX'){$tf=array('','selected','','','','','');}
            else if($data02['tipo_fibra']=='MM-SR'){$tf=array('','','selected','','','','');}
            else if($data02['tipo_fibra']=='SM-LR'){$tf=array('','','','selected','','','');}
            else if($data02['tipo_fibra']=='SM-ZR'){$tf=array('','','','','selected','','');}
            else if($data02['tipo_fibra']=='SM-LX'){$tf=array('','','','','','selected','');}
            else if($data02['tipo_fibra']=='SM-ER'){$tf=array('','','','','','','selected');}
            else{$tf=array('selected','','','','','','');}
            
            if($data02['tipo_conector_bdfo']=='FC'){$tc=array('','selected','','','');}
            else if($data02['tipo_conector_bdfo']=='SC'){$tc=array('','','selected','','');}
            else if($data02['tipo_conector_bdfo']=='LC'){$tc=array('','','','selected','');}
            else if($data02['tipo_conector_bdfo']=='Otro'){$tc=array('','','','','selected');}
            else{$tc=array('selected','','','','');}
            
            if($data02['bloque_dfo']=='Nuevo'){$dfo=array('','selected','');}
            else if($data02['bloque_dfo']=='Existente'){$dfo=array('','','selected');}
            else{$dfo=array('selected','','');}
            
            $red = $ab == 1 ? ubicacionEquipo($data02['ubicacion']) : null;
            
            $tabla .= '<tr id="'.$cont.'"><input type="hidden" name="'.$indice.'_id'.$cont.'" value="'.$data02['id'].'"/>'
                . '<td>'.$data02['nombre_equipo'].'</td>'
                . '<td class="t" style="width:150px"><input type="text" class="foc2'.$red.'" id="'.$indice.'_ubeq'.$cont.'" name="'.$indice.'_ubeq'.$cont.'" value="'.$data02['ubicacion'].'" onblur="repisa(this.id)"/><div class="help" onclick="popitup(\'ub_equipo.php?text='.$indice.'_ubeq'.$cont.'&ub_tipo=repisa\')"></div></td>'
                . '<td class="t"><input type="text" id="_'.$indice.'_ps_rmt'.$cont.'" name="_'.$indice.'_ps_rmt'.$cont.'" class="foc3" '.$gpon[$sm][0].' value="'.$data02['tipo_conector_equipo'].'" '.$gpon[$sm][1].'/></td>'
                . '<td><select name="'.$indice.'_tpcon_eq'.$cont.'"><option value="" '.$pr[0].'>Seleccionar</option><option value="FC" '.$pr[1].'>FC</option><option value="SC" '.$pr[2].'>SC</option><option value="LC" '.$pr[3].'>LC</option><option value="Otro" '.$pr[4].'>Otro</option></select></td>'
                . '<td><select name="'.$indice.'_fibra'.$cont.'"><option value="" '.$tf[0].'>Seleccionar</option><option value="MM-SX" '.$tf[1].'>MM-SX</option><option value="MM-SR" '.$tf[2].'>MM-SR</option><option value="SM-LR" '.$tf[3].'>SM-LR</option><option value="SM-ZR" '.$tf[4].'>SM-ZR</option><option value="SM-LX" '.$tf[5].'>SM-LX</option><option value="SM-ER" '.$tf[6].'>SM-ER</option></select></td>'
                . '<td><select name="'.$indice.'_tpconlado_eq'.$cont.'"><option value="" '.$tc[0].'>Seleccionar</option><option value="FC" '.$tc[1].'>FC</option><option value="SC" '.$tc[2].'>SC</option><option value="LC" '.$tc[3].'>LC</option><option value="Otro" '.$tc[4].'>Otro</option></select></td>'
                . '<td><select name="'.$indice.'_bloque_dfo'.$cont.'"><option value="" '.$dfo[0].'>Seleccionar</option><option value="Nuevo" '.$dfo[1].'>Nuevo</option><option value="Existente" '.$dfo[2].'>Existente</option></select></td>'    
                //. '<td><input type="text" class="foc7" id="'.$indice.'_TxRx'.$cont.'" name="'.$indice.'_TxRx'.$cont.'" value="Tx/Rx" readonly/></td>'
                . '<td class="t" style="width:80px"><input type="text" class="foc4" name="'.$indice.'_ljump'.$cont.'_1" value="'.$data02['long_jumper_1'].'" /></td>'
                . '<td class="t" style="width:80px"><input type="text" class="foc5" name="'.$indice.'_ljump'.$cont.'_2" value="'.$data02['long_jumper_2'].'" /></td></tr>';
            $cont++;
        }
    }
    $tabla .= '<input type="hidden" name="tb'.$indice.'" value="'.$sz.'"/>';
    return $tabla;
}
/*function intert03($folio){
    $tabla = '';
    $contador = 1;
    $tt;
    $query = "SELECT zss_equipos.nombre_equipo,zinter_mp.id,zinter_mp.vertical,zinter_mp.nivel,zinter_mp.tipo_tablilla,zinter_mp.long_cable FROM zinter_mp,zss_equipos WHERE zinter_mp.id_equipo=zss_equipos.id AND zinter_mp.folio='".$folio."'";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $mp_data02 = mysql_fetch_array($result);
            
            if($mp_data02['tipo_tablilla']=='Portasystem'){$tt=array('','selected','');}
            else if($mp_data02['tipo_tablilla']=='Versablock'){$tt=array('','','selected');}
            else{$tt=array('selected','','');}
            
            $tabla .= '<tr><input type="hidden" name="mp_id'.$contador.'" value="'.$mp_data02['id'].'"/>'
                    . '<td>'.$mp_data02['nombre_equipo'].'</td>'
                    . '<td class="t"><input type="text" class="mp1" name="_mp_vtc'.$contador.'" value="'.$mp_data02['vertical'].'"/></td>'
                    . '<td class="t"><input type="text" class="mp3" name="_0mpnvl'.$contador.'" maxlength="3" value="'.$mp_data02['nivel'].'"/></td>'
                    . '<td><select name="mptptab'.$contador.'"><option value="" '.$tt[0].'>Seleccionar</option><option value="Portasystem" '.$tt[1].'>Portasystem</option><option value="Versablock" '.$tt[2].'>Versablock</option></select></td>'
                    . '<td><input type="text" class="mp4" name="mp_lcabl'.$contador.'" value="'.$mp_data02['long_cable'].'" /></td></tr>';
            $contador++;
        }
    }
    $tabla .= '<input type="hidden" name="tbmp" value="'.$sz.'"/>';
    return $tabla;
}*/

function intert03($folio){
    $tabla = '';
    $c = 1;
    $select = '<select><option value="0">Seleccionar</option><option value="1">Portasystem</option><option value="2">Versablock</option></select>';
    //  CONSULTAR EQUIPOS ASOCIADOS
    $query = "SELECT id,nombre_equipo FROM zss_equipos where folio='".$folio."' AND tipo_trabajo='Repisa Nueva' ORDER BY id ASC";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $z = 1;
            $d = mysql_fetch_array($result);
            $query2 = "SELECT * FROM zinter_mp WHERE id_equipo = ".$d['id']." AND folio = '".$folio."' order by id";
            $result2 = mysql_query($query2);
            $sz2 = mysql_num_rows($result2);
            if($sz2 > 0){
                $sel;
                if(($sz2/2) == 8){
                    $sel = array('','selected','');
                }
                else if(($sz2/2) == 3){
                    $sel = array('','','selected');
                }
                else{
                    $sel = array('selected','','');
                }
                $tabla .= '<tr id="fl'.($i + 1).'"><input type="hidden" name="inmp'.($i + 1).'" value="'.($sz2/2).'"/><td rowspan="'.($sz2/2).'">'.$d['nombre_equipo'].'</td>'
                        . '<td rowspan="'.($sz2/2).'"><select name="slcmp'.($i + 1).'" disabled><option value="0" '.$sel[0].'>Seleccionar</option>'
						. '<option value="Portasystem" '.$sel[1].'>Portasystem</option><option value="Versablock" '.$sel[2].'>Versablock</option></select></td>';
                for($j = 0; $j < $sz2; $j++){
                    $d2 = mysql_fetch_array($result2);
                    if($j%2 == 0 && $j == 0){
                        $tabla .= '<td rowspan="'.($sz2/2).'"><input type="text" name="mp_lgcbl'.($i + 1).'" class="mp_lgcbl" value="'.$d2['long_cable'].'"/></td>'
                                . '<td style="height:22px"><input type="text" class="intmp1" name="IntMpNiv'.($i+1).'0'.$z.'" value="'.$d2['nivel'].'" onblur="nivel(this.name)"/></td>'
                                . '<td style="height:22px"><input type="text" class="intmp2" name="IntMpVer'.($i+1).'0'.$z.'" value="'.$d2['vertical'].'" onblur="vertical(this.name)"/></td>'
                                . '<td style="height:22px"><input type="text" class="intmp3" name="IntMpPto'.($i+1).'0'.$z.'" value="'.$d2['puertos'].'" onblur="puertos(this.name)"/></td>';
                    }
                    else if($j%2 != 0 && $j == 0){
                        $tabla .= '<td style="height:22px"><input type="text" class="intmp1" name="IntMpNiv'.($i+1).'1'.$z.'" value="'.$d2['nivel'].'" onblur="nivel(this.name)"/></td>'
                                . '<td style="height:22px"><input type="text" class="intmp2" name="IntMpVer'.($i+1).'1'.$z.'" value="'.$d2['vertical'].'" onblur="vertical(this.name)"/></td>'
                                . '<td style="height:22px"><input type="text" class="intmp3" name="IntMpPto'.($i+1).'1'.$z.'" value="'.$d2['puertos'].'" onblur="puertos(this.name)"/></td></tr>';
                    }
                    else if($j%2 == 0 && $j != 0){
                        $tabla .= '<tr>'
                                . '<td style="height:22px"><input type="text" class="intmp1" name="IntMpNiv'.($i+1).'0'.$z.'" value="'.$d2['nivel'].'" onblur="nivel(this.name)"/></td>'
                                . '<td style="height:22px"><input type="text" class="intmp2" name="IntMpVer'.($i+1).'0'.$z.'" value="'.$d2['vertical'].'" onblur="vertical(this.name)"/></td>'
                                . '<td style="height:22px"><input type="text" class="intmp3" name="IntMpPto'.($i+1).'0'.$z.'" value="'.$d2['puertos'].'" onblur="puertos(this.name)"/></td>';
                    }
                    else if($j%2 != 0 && $j != 0){
                        $tabla .= '<td style="height:22px"><input type="text" class="intmp1" name="IntMpNiv'.($i+1).'1'.$z.'" value="'.$d2['nivel'].'" onblur="nivel(this.name)"/></td>'
                                . '<td style="height:22px"><input type="text" class="intmp2" name="IntMpVer'.($i+1).'1'.$z.'" value="'.$d2['vertical'].'" onblur="vertical(this.name)"/></td>'
                                . '<td style="height:22px"><input type="text" class="intmp3" name="IntMpPto'.($i+1).'1'.$z.'" value="'.$d2['puertos'].'" onblur="puertos(this.name)"/></td></tr>';
                        $z++;
                    }
                }
                $z = 0;
            }
            else{
                $tabla .= '<tr id="fl'.($i + 1).'"><input type="hidden" name="inmp'.($i + 1).'" value="0"/>'
                        . '<td>'.$d['nombre_equipo'].'</td>'
                        . '<td><select name="slcmp'.($i + 1).'"><option value="0">Seleccionar</option><option value="Portasystem">Portasystem</option><option value="Versablock">Versablock</option></select></td>'
                        . '<td><input type="text" name="mp_lgcbl'.($i + 1).'" class="mp_lgcbl" value="'.$d2['long_cable'].'"/></td></tr>';
            }
        }
    }
    $tabla .= '<input type="hidden" name="tbmp" value="'.$sz.'"/>';
    return $tabla;    
}

function intert031($folio){
    $tabla = '';
    $c = 1;
    $select = '<select><option value="0">Seleccionar</option><option value="1">Portasystem</option><option value="2">Versablock</option></select>';
    //  CONSULTAR EQUIPOS ASOCIADOS
    $query = "SELECT id,nombre_equipo FROM zss_equipos where folio='".$folio."' AND tipo_trabajo!='Repisa Nueva' ORDER BY id ASC";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $z = 1;
            $d = mysql_fetch_array($result);
            $query2 = "SELECT * FROM zinter_mp WHERE id_equipo = ".$d['id']." AND folio = '".$folio."' order by id";
            $result2 = mysql_query($query2);
            $sz2 = mysql_num_rows($result2);
            if($sz2 > 0){
                $sel;
                if(($sz2/2) == 8){
                    $sel = array('','selected','');
                }
                else if(($sz2/2) == 3){
                    $sel = array('','','selected');
                }
                else{
                    $sel = array('selected','','');
                }
                $tabla .= '<tr><td rowspan="'.($sz2/2).'">'.$d['nombre_equipo'].'</td>'
                        . '<td rowspan="'.($sz2/2).'"><select id="'.$d['id'].'" name="hf_mtp_slcmp'.($i + 1).'"><option value="0" '.$sel[0].'>Seleccionar</option>'
						. '<option value="Portasystem" '.$sel[1].'>Portasystem</option><option value="Versablock" '.$sel[2].'>Versablock</option></select></td>';
                for($j = 0; $j < $sz2; $j++){
                    $d2 = mysql_fetch_array($result2);
                    if($j%2 == 0 && $j == 0){
                        $tabla .= '<td rowspan="'.($sz2/2).'"><input type="text" name="hf_mp_lgcbl'.($i + 1).'" class="mp_lgcbl" value="'.$d2['long_cable'].'"/></td>'
                                . '<td style="height:22px"><input type="text" class="intmp1" name="hf_mtp_nivel'.($i+1).'0'.$z.'" value="'.$d2['nivel'].'" onblur="nivel(this.name)"/></td>'
                                . '<td style="height:22px"><input type="text" class="intmp2" name="hf_mtp_vertical'.($i+1).'0'.$z.'" value="'.$d2['vertical'].'" onblur="vertical(this.name)"/></td>'
                                . '<td style="height:22px"><input type="text" class="intmp3" name="hf_mtp_puerto'.($i+1).'0'.$z.'" value="'.$d2['puertos'].'" onblur="puertos(this.name)" readonly/></td>';
                    }
                    else if($j%2 != 0 && $j == 0){
                        $tabla .= '<td style="height:22px"><input type="text" class="intmp1" name="hf_mtp_nivel'.($i+1).'1'.$z.'" value="'.$d2['nivel'].'" onblur="nivel(this.name)"/></td>'
                                . '<td style="height:22px"><input type="text" class="intmp2" name="hf_mtp_vertical'.($i+1).'1'.$z.'" value="'.$d2['vertical'].'" onblur="vertical(this.name)"/></td>'
                                . '<td style="height:22px"><input type="text" class="intmp3" name="hf_mtp_puerto'.($i+1).'1'.$z.'" value="'.$d2['puertos'].'" onblur="puertos(this.name)" readonly/></td></tr>';
                    }
                    else if($j%2 == 0 && $j != 0){
                        $tabla .= '<tr>'
                                . '<td style="height:22px"><input type="text" class="intmp1" name="hf_mtp_nivel'.($i+1).'0'.$z.'" value="'.$d2['nivel'].'" onblur="nivel(this.name)"/></td>'
                                . '<td style="height:22px"><input type="text" class="intmp2" name="hf_mtp_vertical'.($i+1).'0'.$z.'" value="'.$d2['vertical'].'" onblur="vertical(this.name)"/></td>'
                                . '<td style="height:22px"><input type="text" class="intmp3" name="hf_mtp_puerto'.($i+1).'0'.$z.'" value="'.$d2['puertos'].'" onblur="puertos(this.name)" readonly/></td>';
                    }
                    else if($j%2 != 0 && $j != 0){
                        $tabla .= '<td style="height:22px"><input type="text" class="intmp1" name="hf_mtp_nivel'.($i+1).'1'.$z.'" value="'.$d2['nivel'].'" onblur="nivel(this.name)"/></td>'
                                . '<td style="height:22px"><input type="text" class="intmp2" name="hf_mtp_vertical'.($i+1).'1'.$z.'" value="'.$d2['vertical'].'" onblur="vertical(this.name)"/></td>'
                                . '<td style="height:22px"><input type="text" class="intmp3" name="hf_mtp_puerto'.($i+1).'1'.$z.'" value="'.$d2['puertos'].'" onblur="puertos(this.name)" readonly/></td></tr>';
                        $z++;
                    }
                }
                $z = 0;
            }
            else{
                $tabla .= '<tr><td>'.$d['nombre_equipo'].'</td><td><select id="'.$d['id'].'" name="hf_mtp_slcmp'.($i + 1).'"><option value="0">Seleccionar</option><option value="Portasystem">Portasystem</option><option value="Versablock">Versablock</option></select></td><td><input type="text" name="hf_mp_lgcbl'.($i + 1).'" class="mp_lgcbl" /></td><td style="height:22px"><input type="text" name="hf_mtp_nivel'.($i+1).'01" class="intmp1" /></td><td style="height:22px"><input type="text" name="hf_mtp_vertical'.($i+1).'01" class="intmp2" /></td><td style="height:22px"><input type="text" name="hf_mtp_puerto'.($i+1).'01" class="intmp3" readonly/></td><td style="height:22px"><input type="text" name="hf_mtp_nivel'.($i+1).'11" class="intmp1" /></td><td style="height:22px"><input type="text" name="hf_mtp_vertical'.($i+1).'11" class="intmp2" /></td><td style="height:22px"><input type="text" name="hf_mtp_puerto'.($i+1).'11" class="intmp3" readonly/></td></tr>';
//                $tabla .= '<td style="height:22px"><input type="text" name="hf_mtp_nivel'.($i+1).'01" class="intmp1" value="'.$d['nivel'].'" /></td>'
//                        . '<td style="height:22px"><input type="text" name="hf_mtp_vertical'.($i+1).'01" class="intmp2" value="'.$d['vertical'].'"/></td>'
//                        . '<td style="height:22px"><input type="text" name="hf_mtp_puerto'.($i+1).'01" class="intmp3" value="'.$d['puertos'].'" readonly/></td></tr>';
            }
        }
    }
    $tabla .= '<input type="hidden" name="tbmpex" value="'.($sz).'"/>';
    return $tabla;
}

function intert04($folio){
    $tabla = '';
    $contador=1;
    $lado;$tcon;$tcx;$txrx;
    $query = "SELECT zss_equipos.nombre_equipo,zinter_cx.id,zinter_cx.ubicacion,zinter_cx.pos_tablilla,zinter_cx.lado,zinter_cx.pos_contacto,zinter_cx.tipo_conector,zinter_cx.tipo_coaxial,zinter_cx.tx_rx,zinter_cx.long_cable FROM zinter_cx,zss_equipos WHERE zinter_cx.id_equipo=zss_equipos.id AND zinter_cx.folio='".$folio."' ORDER BY zinter_cx.id ASC";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $cx_data02 = mysql_fetch_array($result);
            
            if($cx_data02['lado']=='A'){$lado = array('','selected','');}
            else if($cx_data02['lado']=='B'){$lado = array('','','selected');}
            else{$lado = array('selected','','');}
            
            if($cx_data02['tipo_conector']=='BNC Hembra'){$tcon=array('','selected','');}
            else if($cx_data02['tipo_conector']=='BNC Macho'){$tcon=array('','','selected');}
            else{$tcon=array('selected','','');}
            
            if($cx_data02['tipo_coaxial']=='Coaxial'){$tcx=array('','selected','');}
            else if($cx_data02['tipo_coaxial']=='Micro Coaxial'){$tcx=array('','','selected');}
            else{$tcx=array('selected','','');}
            
            if($cx_data02['tx_rx']=='Tx'){$txrx=array('','selected','');}
            else if($cx_data02['tx_rx']=='Rx'){$txrx=array('','','selected');}
            else{$txrx=array('selected','','');}
            
            $tabla .= '<tr><input type="hidden" name="cx_id'.$contador.'" value="'.$cx_data02['id'].'"/>'
                    . '<td>'.$cx_data02['nombre_equipo'].'</td>'
                    . '<td class="t"><input class="cx1" type="text" id="cx_ubeq'.$contador.'" name="cx_ubeq'.$contador.'" value="'.$cx_data02['ubicacion'].'" onblur="ubicacion(this.id)"/><div class="help" onclick="popitup(\'ub_equipo.php?text=cx_ubeq'.$contador.'\')"></div></td>'
                    . '<td class="t"><input class="cx2" type="text" name="cxubeq'.$contador.'" value="'.$cx_data02['pos_tablilla'].'" maxlength="4"/></td>'
                    . '<td><select name="cx_lado'.$contador.'"><option value="" '.$lado[0].'>-</option><option value="A"'.$lado[1].'>A</option><option value="B"'.$lado[2].'>B</option></select></td>'
                    . '<td class="t"><input class="cx4" type="text" name="_cxld'.$contador.'" maxlength="5" value="'.$cx_data02['pos_contacto'].'"/></td>'
                    . '<td><select class="cx3" name="cx_ld'.$contador.'"><option value="" '.$tcon[0].'>Seleccionar</option><option value="BNC Hembra"'.$tcon[1].'>BNC Hembra</option><option value="BNC Macho"'.$tcon[2].'>BNC Macho</option></select></td>'
                    . '<td><select class="cx5" name="cx_cx'.$contador.'"><option value="" '.$tcx[0].'>Seleccionar</option><option value="Coaxial"'.$tcx[1].'>Coaxial</option><option value="Micro Coaxial"'.$tcx[2].'>Micro Coaxial</option></select></td>'
                    . '<td><select name="cx_TrRx'.$contador.'"><option value="" '.$txrx[0].'>Seleccionar</option><option value="Tx"'.$txrx[1].'>Tx</option><option value="Rx"'.$txrx[2].'>Rx</option></select></td>'
                    . '<td class="t"><input class="cx6" type="text" name="cx_lcable'.$contador.'" value="'.$cx_data02['long_cable'].'"/></td>'
                    . '</tr>';
            $contador++;
        }
    }
    $tabla .= '<input type="hidden" name="tbcx" value="'.$sz.'"/>';
    return $tabla;
}
function square(){
    $square = '';
    $abc = array('L','K','J','I','H','G','F','E','D','C','B','A');
    $c = 0;
    $square.= '<div class="ct"><div id="nivel">N<br/>I<br/>V<br/>E<br/>L<br/></div>';
    for($i = 0; $i < 108; $i++){
        if($i == 0 || ($i%9)==0){
            $square.= '<div class="letter">'.$abc[$c].'</div>';
            $c++;
        }
        else{
            $square.= '<div class="square"></div>';
        }
    }
    $square.= '<div id="vertical">VERTICAL</div><div id="parentesis">';
    for($j = 1; $j < 9; $j++){
        $square.= '<div class="inter">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</div>';
    }
    $square.= '</div></div>';
    return $square;
}
function intert05($folio,$gs){
    $tabla = '';
    $indice=$gs==0?'gs':'sn';
    $contador=1;
    $query = "SELECT zinter_gs.id,zss_equipos.nombre_equipo,zinter_gs.ubicacion_RCDT,zinter_gs.numero_switch,zinter_gs.puerto,zinter_gs.cat_cable,zinter_gs.long_cable,zinter_gs.tipo_conector FROM zinter_gs,zss_equipos WHERE zinter_gs.id_equipo=zss_equipos.id AND zinter_gs.folio='".$folio."' AND zss_equipos.id_tecnologia!=0 AND zinter_gs.gestionSincronia=".$gs." ORDER BY zinter_gs.id ASC";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $gs_data02 = mysql_fetch_array($result);
            $tabla .= '<tr style="height:22px"><td>'.$gs_data02['nombre_equipo'].'</td>'
                    . '<td class="t"><input class="sg1" type="text" id="'.$indice.'_ubeq'.$contador.'" name="'.$indice.'_ubeq'.$contador.'" value="'.$gs_data02['ubicacion_RCDT'].'" onblur="ubicacion(this.id)"/><div class="help" onclick="popitup(\'ub_equipo.php?text='.$indice.'_ubeq'.$contador.'\')"></div></td>'
                    . '<td class="t"><input class="sg2" type="text" name="'.$indice.'_sw'.$contador.'" value="'.$gs_data02['numero_switch'].'"/></td>
                    <td class="t"><input class="sg3" type="text" name="'.$indice.'_pt'.$contador.'" value="'.$gs_data02['puerto'].'"/></td>
                    <td class="t"><input class="sg4" type="text" name="'.$indice.'_catc'.$contador.'" value="'.$gs_data02['cat_cable'].'"/></td>
                    <td class="t"><input class="sg5" type="text" name="'.$indice.'_longc'.$contador.'" value="'.$gs_data02['long_cable'].'"/></td>
                    <td class="t"><input class="sg6" type="text" name="'.$indice.'_tcont'.$contador.'" value="'.$gs_data02['tipo_conector'].'"/></td></tr>';
            $contador++;
        }
        $tabla .= '<input type="hidden" name="tb'.$indice.'" value="'.$sz.'"/>';
    }
    return $tabla;
}
function intert06($folio){
    $par=0;
    $impar=1;
    $c=0;
    $tabla='';
    $x='r';
    $tr='';
    $datos;
    $trabajo = "SELECT zss_equipos.nombre_equipo,zinter_fz.id,zinter_fz.trabajo_respaldo,zinter_fz.ub_alimen,zinter_fz.nuevo_existente,zinter_fz.pf_breaker,zinter_fz.cap_fusible,zinter_fz.calibre,zinter_fz.l_cable,zinter_fz.c_cable,zinter_fz.t_zapata FROM zss_equipos,zinter_fz WHERE zss_equipos.id=zinter_fz.id_equipo AND zinter_fz.folio='".$folio."' AND zss_equipos.id_tecnologia!=0 AND zinter_fz.trabajo_respaldo = 0 ORDER BY zss_equipos.id";
    $result = mysql_query($trabajo);
    while($d = mysql_fetch_row($result)){
        $datos[$par] = $d;
        $par += 2;
    }
    $respaldo = "SELECT zss_equipos.nombre_equipo,zinter_fz.id,zinter_fz.trabajo_respaldo,zinter_fz.ub_alimen,zinter_fz.nuevo_existente,zinter_fz.pf_breaker,zinter_fz.cap_fusible,zinter_fz.calibre,zinter_fz.l_cable,zinter_fz.c_cable,zinter_fz.t_zapata FROM zss_equipos,zinter_fz WHERE zss_equipos.id=zinter_fz.id_equipo AND zinter_fz.folio='".$folio."' AND zss_equipos.id_tecnologia!=0 AND zinter_fz.trabajo_respaldo = 1 ORDER BY zss_equipos.id";
    $result = mysql_query($respaldo);
    while($d = mysql_fetch_row($result)){
        $datos[$impar] = $d;
        $impar += 2;
    }
    for($i = 0; $i < count($datos); $i++){
        $nuex;
        $glt;
        $calibre;
        $fusible;
        $zapata;
        if($i%2 == 0){
            $x='t';
            $tr = 'Trabajo';
            $c++;
            $tabla .= '<input type="hidden" name="fz_id'.$c.'" value="'.$datos[$i][1].'_'.$datos[($i+1)][1].'"><tr class="aov'.$c.'"><td rowspan="2">'.$datos[$i][0].'</td>';
        }else{
            $tabla .= '<tr class="aov'.$c.'">';
        }
        if($datos[$i][4] == 'Nuevo'){
            $nuex = array('','selected','');
        }
        else if($datos[$i][4] == 'Existente'){
            $nuex = array('','','selected');
        }
        else{
            $nuex = array('selected','','');
        }
        //  FUSIBLE
        if($datos[$i][6] == '3 AMP'){
            $fusible = array('','selected','','','','','','','','','','','','');
        }
        else if($datos[$i][6] == '4 AMP'){
            $fusible = array('','','selected','','','','','','','','','','','');
        }
        else if($datos[$i][6] == '5 AMP'){
            $fusible = array('','','','selected','','','','','','','','','','');
        }
        else if($datos[$i][6] == '6 AMP'){
            $fusible = array('','','','','selected','','','','','','','','','');
        }
        else if($datos[$i][6] == '8 AMP'){
            $fusible = array('','','','','','selected','','','','','','','','');
        }
        else if($datos[$i][6] == '10 AMP'){
            $fusible = array('','','','','','','selected','','','','','','','');
        }
        else if($datos[$i][6] == '15 AMP'){
            $fusible = array('','','','','','','','selected','','','','','','');
        }
        else if($datos[$i][6] == '16 AMP'){
            $fusible = array('','','','','','','','','selected','','','','','');
        }
        else if($datos[$i][6] == '30 AMP'){
            $fusible = array('','','','','','','','','','selected','','','','');
        }
        else if($datos[$i][6] == '32 AMP'){
            $fusible = array('','','','','','','','','','','selected','','','');
        }
        else if($datos[$i][6] == '40 AMP'){
            $fusible = array('','','','','','','','','','','','selected','','');
        }
        else if($datos[$i][6] == '60 AMP'){
            $fusible = array('','','','','','','','','','','','','selected','');
        }
        else if($datos[$i][6] == '100 AMP'){
            $fusible = array('','','','','','','','','','','','','','selected');
        }
        else{
            $fusible = array('selected','','','','','','','','','','','','','');
        }
        //  CALIBRE
        if($datos[$i][7] == '1/0 AWG'){
            $calibre = array('','selected','','','','','');
        }
        else if($datos[$i][7] == '2 AWG'){
            $calibre = array('','','selected','','','','');
        }
        else if($datos[$i][7] == '4 AWG'){
            $calibre = array('','','','selected','','','');
        }
        else if($datos[$i][7] == '6 AWG'){
            $calibre = array('','','','','selected','','');
        }
        else if($datos[$i][7] == '8 AWG'){
            $calibre = array('','','','','','selected','');
        }
        else if($datos[$i][7] == '10 AWG'){
            $calibre = array('','','','','','','selected');
        }
        else{
            $calibre = array('selected','','','','','','');
        }
        //  ZAPATA
        if($datos[$i][10] == 'Tornillo Opresor'){
            $zapata = array('','selected','','');
        }
        else if($datos[$i][10] == 'Zapata de un ojillo'){
            $zapata = array('','','selected','');
        }
        else if($datos[$i][10] == 'Zapata de dos ojillos'){
            $zapata = array('','','','selected');
        }
        else{
            $zapata = array('selected','','','');
        }
        //********************************
        //CONSTRUCCION DE TABLA
        //********************************
        $tabla .= '<td style="width:70px">'.$tr.'</td>'
        //v1. '<td class="t" style="height:22px"><input type="text" class="fz2" id="fz'.$x.'_ubal'.$c.'" name="fz'.$x.'_ubal'.$c.'" value="'.$fz['ub_alimen'].'" onblur="glt(this.id)"/><div class="help" onclick="popitup(\'ub_equipo.php?text=fz'.$x.'_ubal'.$c.'&ub_tipo=glt\')"></div></td>'
        //v2. '<td class="t" style="height:22px"><input type="text" class="fz2" id="fz'.$x.'_ubal'.$c.'" name="fz'.$x.'_ubal'.$c.'" value="'.$datos[$i][3].'"/></td>'
        . '<td class="t" style="height:22px"><input type="text" class="fz2" id="fz'.$x.'_ubal'.$c.'" name="fz'.$x.'_ubal'.$c.'" value="'.$datos[$i][3].'" /><div class="help" onclick="popitup(\'ub_equipo.php?text=fz'.$x.'_ubal'.$c.'&ub_tipo=glt\')"></div></td>'
        . '<td><select name="fz'.$x.'_nuex'.$c.'"><option value="" '.$nuex[0].'>Seleccionar</option><option value="Nuevo" '.$nuex[1].'>Nuevo</option><option value="Existente" '.$nuex[2].'>Existente</option></select></td>'
        . '<td class="t" style="height:22px"><input type="text" class="fz3" name="fz'.$x.'_break'.$c.'" value="'.$datos[$i][5].'"/></td>'
        . '<td class="t" style="height:22px;width:100px"><select name="fz'.$x.'_capfus'.$c.'"><option value="Seleccionar" '.$fusible[0].'>Seleccionar</option><option value="3 AMP" '.$fusible[1].'>3 AMP</option><option value="4 AMP" '.$fusible[2].'>4 AMP</option><option value="5 AMP" '.$fusible[3].'>5 AMP</option><option value="6 AMP" '.$fusible[4].'>6 AMP</option><option value="8 AMP" '.$fusible[5].'>8 AMP</option><option value="10 AMP" '.$fusible[6].'>10 AMP</option><option value="15 AMP" '.$fusible[7].'>15 AMP</option><option value="16 AMP" '.$fusible[8].'>16 AMP</option><option value="30 AMP" '.$fusible[9].'>30 AMP</option><option value="32 AMP" '.$fusible[10].'>32 AMP</option><option value="40 AMP" '.$fusible[11].'>40 AMP</option><option value="60 AMP" '.$fusible[12].'>60 AMP</option><option value="100 AMP" '.$fusible[13].'>100 AMP</option></select></td>'
        . '<td class="t" style="height:22px;width:110px"><select name="fz'.$x.'_calibre'.$c.'"><option value="Seleccionar" '.$calibre[0].'>Seleccionar</option><option value="1/0 AWG" '.$calibre[1].'>1/0 AWG</option><option value="2 AWG" '.$calibre[2].'>2 AWG</option><option value="4 AWG" '.$calibre[3].'>4 AWG</option><option value="6 AWG" '.$calibre[4].'>6 AWG</option><option value="8 AWG" '.$calibre[5].'>8 AWG</option><option value="10 AWG" '.$calibre[6].'>10 AWG</option></select></td>'
        . '<td class="t" style="height:22px"><input type="text" class="fz6" name="fz'.$x.'_lcbl'.$c.'" value="'.$datos[$i][8].'"/></td>'
        . '<td class="t" style="height:22px"><input type="text" class="fz7" name="fz'.$x.'_cntcb'.$c.'" value="'.$datos[$i][9].'"/></td>'
        . '<td class="t" style="height:22px;width:140px"><select name="fz'.$x.'_tzapt'.$c.'"><option value="Seleccionar" '.$zapata[0].'>Seleccionar</option><option value="Tornillo Opresor" '.$zapata[1].'>Tornillo Opresor</option><option value="Zapata de un ojillo" '.$zapata[2].'>Zapata de un ojillo</option><option value="Zapata de dos ojillos" '.$zapata[3].'>Zapata de dos ojillos</option></select></td></tr>';
        $tr = 'Respaldo';
        $x='r';
    }
    $tabla .= '<input type="hidden" value="'.$c.'" name="tbfz"/>';
    return $tabla;
    
    
}
function intert06_1($numeq){
    $intabla06_1 = '';
    for($i = 1; $i <= ($numeq * 2); $i++){
        $intabla06_1 .= '<tr><td style="width:140px"></td><td style="width:50px">AMP</td><td style="width:10px;border:none">'.$i.'</td></tr>';
    }
    return $intabla06_1;
}
/*------------------------------------------------------
 T R A E R   A R C H I V O S   D E   S I T E S U R V E Y
 -------------------------------------------------------*/
function getfiles($folio){
    $salida = array();
    $imagenes = '';
    $zip = '';
    $query = "SELECT * FROM zarchivos WHERE folio = '".$folio."';";
    $result = mysql_query($query);
    $max = mysql_num_rows($result);
    if($max > 0){
        for($i = 0; $i < $max; $i++){
            $files = mysql_fetch_array($result);
            $patron = '/^image/';
            if(preg_match($patron, $files['tipo']) == 0){
                //En caso de que sea ZIP
                $desc = '';
                if($files['descripcion'] != '-'){
                    $desc = ' title="'.$files['descripcion'].'" ';
                }
                //$zip .= '<li id="f'.$files['id'].'"><div class="nm"><a id="'.$files['id'].'" href="'.$files['ruta'].'"'.$desc.'>'.$files['nombre'].'</a></div><div class="fmt">ZIP</div><div class="dl" onclick="dt(\'f'.$files['id'].'\')"></div><div class="dsc" onclick="addesc('.$files['id'].')"></div></li>';
                $zip .= '<li id="f'.$files['id'].'"><div class="nm"><a id="'.$files['id'].'" href="'.$files['ruta'].'"'.$desc.'>'.$files['nombre'].'</a></div><div class="fmt">ZIP</div><div class="dl" onclick="dt(\'f'.$files['id'].'\')"></div></li>';
            }
            else{
                //En caso de ser imagen
                $desc = '';
                if($files['descripcion'] != '-'){
                    $desc = ' title="'.$files['descripcion'].'" ';
                }
                $imagenes .= '<li id="'.$files['id'].'"><a href="'.$files['ruta'].'" rel="shadowbox[Mixed];"><img id="'.$files['id'].'" src="'.$files['ruta'].'"'.$desc.'></a><div class="dt" onclick="dt(\''.$files['id'].'\')"></div></li>';
                //$imagenes .= '<li id="'.$files['id'].'"><a href="'.$files['ruta'].'" rel="shadowbox[Mixed];"><img id="'.$files['id'].'" src="'.$files['ruta'].'"'.$desc.'></a><div class="dt" onclick="dt(\''.$files['id'].'\')"></div><div class="dsc" onclick="addesc('.$files['id'].')"></div></li>';
            }
        }
    }
    $salida[0] = $zip;
    $salida[1] = $imagenes;
    return $salida;
}
//echo intert03('SS2520140828001');
