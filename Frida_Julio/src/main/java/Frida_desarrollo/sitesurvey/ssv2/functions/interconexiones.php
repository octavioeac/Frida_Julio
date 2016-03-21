<?php
header("Content-Type: text/html;charset=utf-8");
function tipoSiteSurvey($folio){
    require 'conexion.php';
    $query = mysql_query("SELECT nuevo_adecuacion FROM zsite_survey WHERE folio = '".$folio."'");
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
    require 'conexion.php';
    $query = mysql_query("SELECT COUNT('id') AS num FROM zss_equipos WHERE folio = '".$folio."';");
    $numequipos = mysql_result($query, 0, 0);
    return $numequipos;
}
function ubxeq($folio){
    require 'conexion.php';
    $equipos = '';
    $query = "SELECT ztecnologias.tipo_equipo, zss_equipos.ubicacion, zss_equipos.nuevoExistente FROM ztecnologias,zss_equipos WHERE zss_equipos.folio = '".$folio."' AND zss_equipos.id_tecnologia = ztecnologias.id;";
    $resultst = mysql_query($query,$conectar2);
    $mx = mysql_num_rows($resultst);
    if($mx > 0){
        for($i = 1; $i <= $mx; $i++){
            $eq = mysql_fetch_array($resultst);
            if($eq['nuevoExistente'] == 'Nuevo'){
                $nuex = '<td>Nuevo</td>
            <td class="t"><input type="radio" name="nuevoEx'.$i.'" value="Nuevo" checked/></td>
            <td>Existente</td>
            <td  class="t"><input type="radio" name="nuevoEx'.$i.'" value="Existente"/></td>';
            }
            else if($eq['nuevoExistente'] == 'Existente'){
                $nuex = '<td>Nuevo</td>
            <td class="t"><input type="radio" name="nuevoEx'.$i.'" value="Nuevo"/></td>
            <td>Existente</td>
            <td  class="t"><input type="radio" name="nuevoEx'.$i.'" value="Existente" checked/></td>';
            }
            else{
                $nuex = '<td>Nuevo</td>
            <td class="t"><input type="radio" name="nuevoEx'.$i.'" value="Nuevo"/></td>
            <td>Existente</td>
            <td  class="t"><input type="radio" name="nuevoEx'.$i.'" value="Existente"/></td>';
            }
            $equipos .= '<tr style="height:22px"><td>'.$eq['tipo_equipo'].'</td><td><input type="text" class="other6" id="ubicacion_equipo'.$i.'" name="ubicacion_equipo'.$i.'" value="'.$eq['ubicacion'].'" onblur="popitup(this.id);" /></td>
            <td>
            <table class="int"><tr>'.$nuex.'</tr></table>
            </td>
            </tr>';
        }
    }
    return $equipos;
}
function modelos($folio){
    $salida = '';
    require 'conexion.php';
    $modelos = "SELECT ztecnologias.id, ztecnologias.tipo_equipo FROM ztecnologias, zss_equipos WHERE zss_equipos.folio = '".$folio."' AND ztecnologias.id = zss_equipos.id_tecnologia";
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
    require 'conexion.php';
    $headerdata = array();
    if($tss == 0){
        $query = "SELECT 
        centrales.dir_div, 
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
        ztecnologias.rubro,
        ztecnologias.tecnologia, 
        ztecnologias.proveedor
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
                $headerdata[15] = $datos['rubro'];
                $headerdata[16] = $datos['proveedor'];
                $headerdata[17] = $datos['estatus'];
                $headerdata[18] = $datos['tecnologia'];
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
        zsite_survey.estatus
        FROM centrales, zsite_survey WHERE zsite_survey.folio = '".$folio."' AND centrales.id_ctl = zsite_survey.id_central";
        $salidatwo = mysql_query($querytwo,$conectar2);
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
            }
        }
        
    }
    return $headerdata;
}
function copiacorreo($folio){
    require 'conexion.php';
    $copias = '';
    $query = "SELECT nombre, email FROM zccemails WHERE folio = '".$folio."';";
    $correos = mysql_query($query, $conectar2);
    $m = mysql_num_rows($correos);
    if($m > 0){
        $copias .= '<tr><td colspan="2">';
        for($a = 0; $a < $m; $a++){
            $mail = mysql_fetch_array($correos);
            $copias .= $mail['nombre'].', '.$mail['email'].';&nbsp;&nbsp;&nbsp;';
        }
        $copias .= '</td></tr>';
    }
    return $copias;
}
function intert01($numeq,$numeros,$folio,$ab){
    require 'conexion.php';
    $indice = '';
    if($ab == 1){
        $indice = 'fo';
    }
    else{
        $indice = 'dwfo';
    }
    $intabla01 = '';
    $modelos = array();
    $id = array();
    $tipoConector = array(0 => 'FC', 1 => 'SC', 2 => 'LC', 3 => 'Otro');
    $tipoFibra = array(0 => 'MM-SX', 1 => 'MM-SR', 2 => 'SM-LR', 3 => 'SM-ZR', 4 => 'SM-LX', 5 => 'SM-ER');
    $txRx = array(0 => 'Tx', 1 => 'Rx');
    $cont = 1;
    //BUSCAR LOS ID DE LOS MODELOS INTERCONECTADOS
    $reqidymdl = "SELECT ztecnologias.id, ztecnologias.tipo_equipo FROM ztecnologias, zinter_abfo WHERE zinter_abfo.folio = '".$folio."'  AND zinter_abfo.alto_bajo = ".$ab." AND ztecnologias.id = zinter_abfo.id_modelo GROUP BY ztecnologias.tipo_equipo";
    $resultado01 = mysql_query($reqidymdl, $conectar2);
    $sz01 = mysql_num_rows($resultado01);
    if($sz01 > 0){
        for($a = 0;  $a < $sz01; $a++){
            $data01 = mysql_fetch_array($resultado01);
            $id[$a] = $data01['id'];
            $modelos[$a] = $data01['tipo_equipo'];
        }
        //BUSCAR DATOS DE INTERCONEXIÓN CORRESPONDIENTES AL FOLIO
        $reqinter = "SELECT * FROM zinter_abfo WHERE folio = '".$folio."' AND alto_bajo = ".$ab.";";
        $resultado02 = mysql_query($reqinter,$conectar2);
        $sz02 = mysql_num_rows($resultado02);
        if($sz02 > 0){
            for($b = 0;  $b < $sz02; $b++){
                $data02 = mysql_fetch_array($resultado02);
                $intabla01 .= '<tr><input type="hidden" name="'.$indice.'_id'.$cont.'" value="'.$data02['id'].'"/><td><select name="'.$indice.'_mod'.$cont.'">';
                for($c = 0; $c < count($id); $c++){
                    if($id[$c] == $data02['id_modelo']){
                        $intabla01 .= '<option value="'.$id[$c].'" selected>'.$modelos[$c].'</option>';
                    }
                    else{
                        $intabla01 .= '<option value="'.$id[$c].'">'.$modelos[$c].'</option>';
                    }
                }
                $intabla01 .= '</select></td>';
                $intabla01 .= '<td class="t"><input type="text" class="foc2" id="'.$indice.'_ubeq'.$cont.'" name="'.$indice.'_ubeq'.$cont.'" value="'.$data02['ubicacion'].'" onblur="popitup(this.id);"/></td>';
                $intabla01 .= '<td class="t" style="width:52px"><input type="text" class="foc6" name="'.$indice.'_dfo'.$cont.'" maxlength="4" value="'.$data02['dfo'].'"/></td>';
                if($data02['tipo_conector_equipo']=='PEND.'){
                    $intabla01 .= '<td class="t"><input type="text" name="_'.$indice.'_ps_rmt'.$cont.'" class="foc3" maxlength="5" value="'.$data02['tipo_conector_equipo'].'" disabled /><input class="ck1" type="checkbox" name="'.$indice.'_ps_rmt'.$cont.'" value="0" checked /></td>';
                }
                else{
                    $intabla01 .= '<td class="t"><input type="text" name="_'.$indice.'_ps_rmt'.$cont.'" class="foc3" maxlength="5" value="'.$data02['tipo_conector_equipo'].'" /><input class="ck1" type="checkbox" name="'.$indice.'_ps_rmt'.$cont.'" value="1"/></td>';
                }
                $intabla01 .= '<td><select name="'.$indice.'_tpcon_eq'.$cont.'">';
                for($d = 0; $d < count($tipoConector); $d++){
                    if($tipoConector[$d] == $data02['posicion_remate']){
                        $intabla01 .= '<option value="'.$tipoConector[$d].'" selected>'.$tipoConector[$d].'</option>';
                    }
                    else{
                        $intabla01 .= '<option value="'.$tipoConector[$d].'">'.$tipoConector[$d].'</option>';
                    }
                }
                $intabla01 .= '</select></td>';
                $intabla01 .= '<td><select name="'.$indice.'_fibra'.$cont.'">';
                for($e = 0; $e < count($tipoFibra); $e++){
                    if($tipoFibra[$e] == $data02['tipo_fibra']){
                        $intabla01 .= '<option value="'.$tipoFibra[$e].'" selected>'.$tipoFibra[$e].'</option>';
                    }
                    else{
                        $intabla01 .= '<option value="'.$tipoFibra[$e].'">'.$tipoFibra[$e].'</option>';
                    }
                }
                $intabla01 .= '</select></td>';
                $intabla01 .= '<td><select name="'.$indice.'_tpconlado_eq'.$cont.'">';
                for($g = 0; $g < count($tipoConector); $g++){
                    if($tipoConector[$g] == $data02['tipo_conector_bdfo']){
                        $intabla01 .= '<option value="'.$tipoConector[$g].'" selected>'.$tipoConector[$g].'</option>';
                    }
                    else{
                        $intabla01 .= '<option value="'.$tipoConector[$g].'">'.$tipoConector[$g].'</option>';
                    }
                }
                $intabla01 .= '</select></td><td><select name="'.$indice.'_TxRx'.$cont.'">';
                for($h = 0; $h < count($txRx); $h++){
                    if($txRx[$h] == $data02['Tx_Rx']){
                        $intabla01 .= '<option value="'.$txRx[$h].'" selected>'.$txRx[$h].'</option>';
                    }
                    else{
                        $intabla01 .= '<option value="'.$txRx[$h].'">'.$txRx[$h].'</option>';
                    }
                }
                $intabla01 .= '</select></td>';
                $intabla01 .= '<td class="t"><input type="text" class="foc4" name="'.$indice.'_ljump'.$cont.'_1" value="'.$data02['long_jumper_1'].'" /></td>
                <td class="t"><input type="text" class="foc5" name="'.$indice.'_ljump'.$cont.'_2" value="'.$data02['long_jumper_2'].'" /></td></tr>';
                $cont++;
            }
            $intabla01 .= '<input type="hidden" name="tb'.$indice.'" value="'.$sz02.'"/>';
        }
    }
    else{
        for($i = 1; $i <= $numeq; $i++){
            $intabla01 .= '<tr><td class="t"><select name="'.$indice.'_mod'.$i.'">'.modelos($folio).'</select></td>
            <td class="t"><input type="text" class="foc2" id="'.$indice.'_ubeq'.$i.'" name="'.$indice.'_ubeq'.$i.'" onblur="popitup(this.id);"/></td>
            <td class="t" style="width:52px"><input type="text" class="foc6" name="'.$indice.'_dfo'.$i.'" maxlength="4"/></td>
            <td class="t"><input type="text" name="_'.$indice.'_ps_rmt'.$i.'" class="foc3" maxlength="5"/><input class="ck1" type="checkbox" name="'.$indice.'_ps_rmt'.$i.'" value="1"/></td>
            <td class="t"><select name="'.$indice.'_tpcon_eq'.$i.'"><option value="FC">FC</option><option value="SC">SC</option><option value="LC">LC</option><option value="Otro">Otro</option></select></td>
            <td class="t"><select name="'.$indice.'_fibra'.$i.'"><option value="MM-SX">MM-SX</option><option value="MM-SR">MM-SR</option><option value="SM-LR">SM-LR</option><option value="SM-ZR">SM-ZR</option><option value="SM-LX">SM-LX</option><option value="SM-ER">SM-ER</option></select></td>
            <td class="t"><select name="'.$indice.'_tpconlado_eq'.$i.'"><option value="FC">FC</option><option value="SC">SC</option><option value="LC">LC</option><option value="Otro">Otro</option></select></td>
            <td class="t"><select name="'.$indice.'_TxRx'.$i.'"><option value="Tx">Tx</option><option value="Rx">Rx</option></select></td>
            <td class="t"><input type="text" class="foc4" name="'.$indice.'_ljump'.$i.'_1"/></td>
            <td class="t"><input type="text" class="foc5" name="'.$indice.'_ljump'.$i.'_2"/></td>
            </tr>';           
        }
        $intabla01 .= '<input type="hidden" name="tb'.$indice.'" value="'.$numeq.'"/>';//<input type="hidden" name="notb'.$indice.'" value=""/>
    }
    return $intabla01;
}
function intert03($folio,$numeq,$numeros,$modelos){
    require 'conexion.php';
    //DECLARAR VARIABLES A UTILIZAR
    $intabla03 = '';
    $mp_modelosUtilizados = array();
    $mp_ids = array();
    $contador = 1;
    $tipoTablilla = array(0 => 'Portasystem', 1 => 'Versablock');
    
    //BUSCAR IDS DE MODELOS INTERCONEXTADOS
    $mp_idequipo = "SELECT ztecnologias.id, ztecnologias.tipo_equipo FROM ztecnologias, zinter_mp WHERE zinter_mp.folio = '".$folio."'  AND ztecnologias.id = zinter_mp.id_modelo GROUP BY ztecnologias.tipo_equipo;";
    $mp_resultset = mysql_query($mp_idequipo, $conectar2);
    $mp_sz01 = mysql_num_rows($mp_resultset);
    if($mp_sz01 > 0){
        for($i = 0; $i < $mp_sz01; $i++){
            $mp_data01 = mysql_fetch_array($mp_resultset);
            $mp_ids[$i] = $mp_data01['id'];
            $mp_modelosUtilizados[$i] = $mp_data01['tipo_equipo'];
        }
        
        //BUSCAR DATOS DE INTERCONEXION CORRESPONDIENTES AL FOLIO
        $mp_reqint = "SELECT * FROM zinter_mp WHERE folio = '".$folio."';";
        $mp_resultset02 = mysql_query($mp_reqint, $conectar2);
        $mp_sz02 = mysql_num_rows($mp_resultset02);
        if($mp_sz02 > 0){
            for($j = 0; $j < $mp_sz02; $j++){
                $mp_data02 = mysql_fetch_array($mp_resultset02);
                $intabla03 .= '<tr><input type="hidden" name="mp_id'.$contador.'" value="'.$mp_data02['id'].'"/><td><select name="mp_mod'.$contador.'" style="width:103%">';
                for($k = 0; $k < count($mp_ids); $k++){
                    if($mp_ids[$k] == $mp_data02['id_modelo']){
                        $intabla03 .= '<option value="'.$mp_ids[$k].'" selected>'.$mp_modelosUtilizados[$k].'</option>';
                    }
                    else{
                        $intabla03 .= '<option value="'.$mp_ids[$k].'">'.$mp_modelosUtilizados[$k].'</option>';
                    }
                }
                $intabla03 .= '</select></td>';
                if($mp_data02['vertical'] == 'PEND.'){
                    $intabla03 .= '<td style="width:75px;background:#cae4ff"><input type="text" class="mp1" name="_mp_vtc'.$contador.'" value="PEND." disabled/><input class="ck5" type="checkbox" name="mp_vtc'.$contador.'" checked/></td>';
                }
                else{
                    $intabla03 .= '<td style="width:75px;background:#cae4ff"><input type="text" class="mp1" name="_mp_vtc'.$contador.'" value="'.$mp_data02['vertical'].'"/><input class="ck5" type="checkbox" name="mp_vtc'.$contador.'"/></td>';
                }
                if($mp_data02['nivel'] == 'PEND.'){
                    $intabla03 .= '<td style="background:#cae4ff"><input type="text" class="mp3" name="_0mpnvl'.$contador.'" maxlength="3" value="PEND." disabled/>
                        <input type="checkbox" class="ck4" name="0mpnvl'.$contador.'" checked/></td>';
                }
                else{
                    $intabla03 .= '<td style="background:#cae4ff"><input type="text" class="mp3" name="_0mpnvl'.$contador.'" value="'.$mp_data02['nivel'].'" maxlength="3"/>
                        <input type="checkbox" class="ck4" name="0mpnvl'.$contador.'"/></td>';
                }
                $intabla03 .= '<td><select name="mptptab'.$contador.'">';
                for($l = 0; $l < count($tipoTablilla); $l++){
                    if($tipoTablilla[$l] == $mp_data02['tipo_tablilla']){
                        $intabla03 .= '<option value="'.$tipoTablilla[$l].'" selected>'.$tipoTablilla[$l].'</option>';
                    }
                    else{
                        $intabla03 .= '<option value="'.$tipoTablilla[$l].'">'.$tipoTablilla[$l].'</option>';
                    }
                }
                $intabla03 .= '</select></td>';
                $intabla03 .= '<td><input type="text" class="mp4" name="mp_lcabl'.$contador.'" value="'.$mp_data02['long_cable'].'" /></td></tr>';
                $contador++;
            }
            $intabla03 .= '<input type="hidden" name="tbmp" value="'.$mp_sz02.'"/>';
        }
    }
    else{
        for($i = 1; $i <= $numeq; $i++){
            $intabla03 .= '<tr>
            <td><select name="mp_mod'.$i.'" style="width:103%">'.$modelos.'</select></td>
            <td style="width:75px;background:#cae4ff"><input type="text" class="mp1" name="_mp_vtc'.$i.'"/><input class="ck5" type="checkbox" name="mp_vtc'.$i.'"/></td>
            <td style="background:#cae4ff"><input type="text" class="mp3" name="_0mpnvl'.$i.'" maxlength="3"/><input type="checkbox" class="ck4" name="0mpnvl'.$i.'"/></td>
            <td><select name="mptptab'.$i.'"><option value="Portasystem">Portasystem</option><option value="Versablock">Versablock</option></select></td>
            <td><input type="text" class="mp4" name="mp_lcabl'.$i.'"/></td>
        </tr>';
        }
        $intabla03 .= '<input type="hidden" name="tbmp" value="'.$numeq.'"/>';
    }
    return $intabla03;
}
function intert04($folio,$numeq,$modelos){
    require 'conexion.php';
    $num = '<option value="1">1</option>';
    $intabla04 = '';
    $lado = array(0 => 'A', 1 => 'B');
    $tipoConector = array(0 => 'BNC Hembra', 1 => 'BNC Macho');
    $tipoCoaxial = array(0 => 'Coaxial', 1 => 'Micro Coaxial');
    $txRx = array(0 => 'Tx', 1 => 'Rx');
    
    $contador = 1;
    $cx_ids = array();
    $cx_modelos = array();
    
    //BUSCAR LOS ID Y MODELOS DE LOS MODELOS INTERCONECTADOS
    $cx_buscaIDyModelo = "SELECT ztecnologias.id, ztecnologias.tipo_equipo FROM ztecnologias, zinter_cx WHERE zinter_cx.folio = '".$folio."' AND ztecnologias.id = zinter_cx.id_modelo;";
    $cx_resultset01 = mysql_query($cx_buscaIDyModelo, $conectar2);
    $cx_sz01 = mysql_num_rows($cx_resultset01);
    if($cx_sz01 > 0){
        for($i = 0; $i < $cx_sz01; $i++){
            $cx_data01 = mysql_fetch_array($cx_resultset01);
            $cx_ids[$i] = $cx_data01['id'];
            $cx_modelos[$i] = $cx_data01['tipo_equipo'];
        }
        
        //BUSCAR DATOS DE INTERCONEXIÓN CORRESPONDIENTES AL FOLIO
        $cx_reqint = "SELECT * FROM zinter_cx WHERE folio = '".$folio."'";
        $cx_resultset02 = mysql_query($cx_reqint, $conectar2);
        $cx_sz02 = mysql_num_rows($cx_resultset02);
        if($cx_sz02 > 0){
            for($j = 0; $j < $cx_sz02; $j++){
                $cx_data02 = mysql_fetch_array($cx_resultset02);
                $intabla04 .= '<tr><input type="hidden" name="cx_id'.$contador.'" value="'.$cx_data02['id'].'"/><td class="t"><select name="cx_mod'.$contador.'">';
                for($k = 0; $k < count($cx_ids); $k++){
                    if($cx_ids[$k] == $cx_data02['id_modelo']){
                        $intabla04 .= '<option value="'.$cx_ids[$k].'" selected>'.$cx_modelos[$k].'</option>';
                    }
                    else{
                        $intabla04 .= '<option value="'.$cx_ids[$k].'">'.$cx_modelos[$k].'</option>';
                    }
                }
                $intabla04 .= '</select></td><td class="t"><input class="cx1" type="text" id="cx_ubeq'.$contador.'" name="cx_ubeq'.$contador.'" maxlength="5" value="'.$cx_data02['ubicacion'].'" onblur="popitup(this.id);"/></td>';
                $intabla04 .= '<td><input class="cx2" type="text" name="cxubeq'.$contador.'" value="'.$cx_data02['pos_tablilla'].'" maxlength="4"/></td>';
                
                $intabla04 .= '<td style="width:50px" class="t"><select name="cx_lado'.$contador.'">';
                for($l = 0; $l < count($lado); $l++){
                    if($cx_data02['lado'] == $lado[$l]){
                        $intabla04 .= '<option value="'.$lado[$l].'" selected>'.$lado[$l].'</option>';
                    }
                    else{
                        $intabla04 .= '<option value="'.$lado[$l].'">'.$lado[$l].'</option>';
                    }
                }
                $intabla04 .= '</select></td>';
                if($cx_data02['pos_contacto'] == 'PEND.'){
                    $intabla04 .= '<td class="t"><input class="cx4" type="text" name="_cxld'.$contador.'" maxlength="5" value="PEND." disabled/><input type="checkbox" name="cxld'.$contador.'" class="ck3" checked/></td></td>';
                }
                else{
                    $intabla04 .= '<td class="t"><input class="cx4" type="text" name="_cxld'.$contador.'" maxlength="5" value="'.$cx_data02['pos_contacto'].'" /><input type="checkbox" name="cxld'.$contador.'" class="ck3"/></td></td>';
                }
                    $intabla04 .= '<td class="t"><select class="cx3" name="cx_ld'.$contador.'">';
                    for ($m = 0; $m < count($tipoConector); $m++){
                        if($cx_data02['tipo_conector'] == $tipoConector[$m]){
                            $intabla04 .= "<option value='".$tipoConector[$m]."' selected>".$tipoConector[$m]."</option>";
                        }
                        else{
                            $intabla04 .= "<option value='".$tipoConector[$m]."'>".$tipoConector[$m]."</option>";
                        }
                    }
                    $intabla04 .= '</select></td>';
                    $intabla04 .= '<td class="t"><select class="cx5" name="cx_cx'.$contador.'">';
                    for($n = 0; $n < count($tipoCoaxial); $n++){
                        if($cx_data02['tipo_coaxial'] == $tipoCoaxial[$n]){
                            $intabla04 .= "<option value='".$tipoCoaxial[$n]."' selected>".$tipoCoaxial[$n]."</option>";
                        }
                        else{
                            $intabla04 .= "<option value='".$tipoCoaxial[$n]."'>".$tipoCoaxial[$n]."</option>";
                        }
                    }
                    $intabla04 .= '</select></td>';
                    $intabla04 .= '<td><select name="cx_TrRx'.$contador.'" style="width:103%">';
                    for($o = 0; $o < count($txRx); $o++){
                        if($cx_data02['tx_rx'] == $txRx[$o]){
                            $intabla04 .= '<option value="'.$txRx[$o].'" selected>'.$txRx[$o].'</option>';
                        }
                        else{
                            $intabla04 .= '<option value="'.$txRx[$o].'">'.$txRx[$o].'</option>';
                        }
                    }
                    $intabla04 .= '</select></td>';
                    $intabla04 .= '<td class="t"><input class="cx6" type="text" name="cx_lcable'.$contador.'" value="'.$cx_data02['long_cable'].'"/></td></tr>';
                $contador++;
            }
            $intabla04 .= '<input type="hidden" name="tbcx" value="'.$cx_sz02.'"/>';
        }
    }
    else{
        
        for($i = 1; $i <= $numeq; $i++){
            $intabla04 .= '<tr><td class="t"><select name="cx_mod'.$i.'">'.$modelos.'</select></td>
            <td class="t" style="width:86px"><input class="cx1" type="text" id="cx_ubeq'.$i.'" name="cx_ubeq'.$i.'" maxlength="5" onblur="popitup(this.id)"/></td>
            <td class="t"><input class="cx22" type="text" name="cxubeq'.$i.'" maxlength="4"/></td>
            <td style="width:50px" class="t"><select name="cx_lado'.$i.'"><option value="A">A</option><option value="B">B</option></select></td>
            <td class="t"><input class="cx4" type="text" name="_cxld'.$i.'" maxlength="5"/><input type="checkbox" name="cxld'.$i.'" class="ck3"/></td>
            <td class="t"><select class="cx3" name="cx_ld'.$i.'"><option value="BNC Hembra">BNC Hembra</option><option value="BNC Macho">BNC Macho</option></select></td>
            <td class="t"><select class="cx5" name="cx_cx'.$i.'"><option value="Coaxial">Coaxial</option><option value="Micro Coaxial">Micro Coaxial</option></select></td>
            <td class="t"><select style="width:103%" name="cx_TxRx'.$i.'"><option value="Tx">Tx</option><option value="Rx">Rx</option></select></td>
            <td class="t"><input class="cx6" type="text" name="cx_lcable'.$i.'"/></td></tr>';
        }
        $intabla04 .= '<input type="hidden" name="tbcx" value="'.$numeq.'"/>';
    }
    return $intabla04;
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
function intert05($folio,$numeq,$modelos,$gs){
    require 'conexion.php';
    $indice = '';
    $gs_id = array();
    $gs_modelos = array();
    if($gs == 0){
        $indice = 'gs';
    }
    else{
        $indice = 'sn';
    } 
    //echo $indice;
    $intabla05 = '';
    $contador = 1;
    
    //BUSCAR ID Y MODELOS INTERCONECTADOS
    $gs_IdyModelos = "SELECT ztecnologias.id, ztecnologias.tipo_equipo FROM ztecnologias, zinter_gs WHERE zinter_gs.folio = '".$folio."'  AND zinter_gs.gestionSincronia = ".$gs." AND ztecnologias.id = zinter_gs.id_modelo;";
    $gs_resultset01 = mysql_query($gs_IdyModelos, $conectar2);
    $gs_sz01 = mysql_num_rows($gs_resultset01);
    if($gs_sz01 > 0){
        for($i = 0; $i < $gs_sz01; $i++){
            $gs_data01 = mysql_fetch_array($gs_resultset01);
            $gs_id[$i] = $gs_data01['id'];
            $gs_modelos[$i] = $gs_data01['tipo_equipo'];
        }
        
        //BUSCAMOS DATOS DE INTERCONEXION CORRESPONDIENTES AL FOLIO
        $gs_reqint = "SELECT * FROM zinter_gs WHERE folio = '".$folio."' AND gestionSincronia = ".$gs.";";
        $gs_resultset02 = mysql_query($gs_reqint, $conectar2);
        $gs_sz02 = mysql_num_rows($gs_resultset02);
        if($gs_sz02){
            for($j = 0; $j < $gs_sz02; $j++){
                $gs_data02 = mysql_fetch_array($gs_resultset02);
                $intabla05 .= '<tr><td class="t"><select name="'.$indice.'_mod'.$contador.'">';
                for($k = 0; $k < count($gs_id); $k++){
                    if($gs_id[$k] == $gs_data02['id_modelo']){
                        $intabla05 .= '<option value="'.$gs_id[$k].'" selected>'.$gs_modelos[$k].'</option>';
                    }
                    else{
                        $intabla05 .= '<option value="'.$gs_id[$k].'">'.$gs_modelos[$k].'</option>';
                    }
                }
                $intabla05 .= '</select></td><td class="t"><input class="sg1" type="text" id="'.$indice.'_ubeq'.$contador.'" name="'.$indice.'_ubeq'.$contador.'" value="'.$gs_data02['ubicacion_RCDT'].'" onblur="popitup(this.id);"/></td>
                    <td class="t"><input class="sg2" type="text" name="'.$indice.'_sw'.$contador.'" value="'.$gs_data02['numero_switch'].'"/></td>
                    <td class="t"><input class="sg3" type="text" name="'.$indice.'_pt'.$contador.'" value="'.$gs_data02['puerto'].'"/></td>
                    <td class="t"><input class="sg4" type="text" name="'.$indice.'_catc'.$contador.'" value="'.$gs_data02['cat_cable'].'"/></td>
                    <td class="t"><input class="sg5" type="text" name="'.$indice.'_longc'.$contador.'" value="'.$gs_data02['long_cable'].'"/></td>
                    <td class="t"><input class="sg6" type="text" name="'.$indice.'_tcont'.$contador.'" value="'.$gs_data02['tipo_conector'].'"/></td></tr>';
                $contador++;
            }
        }
    }
    else{
        for($i = 1; $i <= $numeq; $i++){
            $intabla05 .= '<tr>
            <td class="t"><select name="'.$indice.'_mod'.$i.'">'.$modelos.'</select></td>
            <td class="t"><input class="sg1" type="text" id="'.$indice.'_ubeq'.$i.'" name="'.$indice.'_ubeq'.$i.'" onclick="popitup(this.id);"/></td>
            <td class="t"><input class="sg2" type="text" name="'.$indice.'_sw'.$i.'"/></td>
            <td class="t"><input class="sg3" type="text" name="'.$indice.'_pt'.$i.'"/></td>
            <td class="t"><input class="sg4" type="text" name="'.$indice.'_catc'.$i.'"/></td>
            <td class="t"><input class="sg5" type="text" name="'.$indice.'_longc'.$i.'"/></td>
            <td class="t"><input class="sg6" type="text" name="'.$indice.'_tcont'.$i.'"/></td></tr>';
        }
    }
    return $intabla05;
}
function intert06($folio,$numeq,$modelos){
    require 'conexion.php';
    $intabla06 = '';
    $fzIdTrabajo = array();
    $fzIdRespaldo = array();
    $fzIDS = array();
    $fzModelos = array();
    $contador = 0;
    $fzBuscaIds = "SELECT id FROM zinter_fz WHERE folio = '".$folio."';";
    $fzResultSet01 = mysql_query($fzBuscaIds, $conectar2);
    $fzsz01 = mysql_num_rows($fzResultSet01);
    if($fzsz01 > 0){
        for($i = 0; $i < $fzsz01; $i++){
            $fzData01 = mysql_fetch_array($fzResultSet01);
            if($i < ($fzsz01/2)){
                $fzIdTrabajo[$contador] = $fzData01['id'];
                $contador++;
                if($contador == (($fzsz01/2))){
                    $contador = 0;
                }
            }
            else{
                $fzIdRespaldo[$contador] = $fzData01['id'];
                $contador++;
            }
        }
        //RECUPERAR IDS Y MODELOS UTILIZADO PARA LAS INTERCONEXIONES
        $fzReqIdyMdl = "SELECT ztecnologias.id, ztecnologias.tipo_equipo FROM ztecnologias, zss_equipos WHERE zss_equipos.folio = '".$folio."' AND zss_equipos.id_tecnologia = ztecnologias.id GROUP BY ztecnologias.tipo_equipo;";
        $fzResultSet03 = mysql_query($fzReqIdyMdl, $conectar2);
        $fzsz03 = mysql_num_rows($fzResultSet03);
        if($fzsz03 > 0){
            for($l = 0; $l < $fzsz03; $l++){
                $fzData03 = mysql_fetch_array($fzResultSet03);
                $fzIDS[$l] = $fzData03['id'];
                $fzModelos[$l] = $fzData03['tipo_equipo'];
            }
        }
        $contador = 0;
        $contador2 = 0;
        $ixt = 1;
        $ixr = 1;
        for($j = 0; $j < $fzsz01; $j++){
            if($j%2 == 0 || $j == 0){
                $fzDatos = "SELECT * FROM zinter_fz WHERE id = ".$fzIdTrabajo[$contador].";";
                //echo $fzDatos.'< >'.$contador.'<br/>';
                $fzResultSet02 = mysql_query($fzDatos, $conectar2);
                $fzsz02 = mysql_num_rows($fzResultSet02);
                if($fzsz02 > 0){
                    for($k = 0; $k < $fzsz02; $k++){
                        $fzData02 = mysql_fetch_array($fzResultSet02);
                        $intabla06 .= '<tr><input type="hidden" name="fzt_id'.$ixt.'" value="'.$fzData02['id'].'"/><td rowspan="2"><select name="fz_mod'.$ixt.'">';
                        for($m = 0; $m < count($fzIDS); $m++){
                            if($fzIDS[$m] == $fzData02['id_modelo']){
                                $intabla06 .= '<option value="'.$fzIDS[$m].'" selected>'.$fzModelos[$m].'</option>';
                            }
                            else{
                                $intabla06 .= '<option value="'.$fzIDS[$m].'">'.$fzModelos[$m].'</option>';
                            }
                        }
                        $intabla06 .= '</select></td><td class="h2">Trabajo</td>
                        <td class="h"><input type="text" class="fz2" id="fzt_ubal'.$ixt.'" name="fzt_ubal'.$ixt.'" value="'.$fzData02['ub_alimen'].'" onblur="popitup(this.id);"/></td>
                        <td class="h"><input type="text" class="fz3" name="fzt_break'.$ixt.'" value="'.$fzData02['pf_breaker'].'"/></td>
                        <td class="h"><input type="text" class="fz4" name="fzt_capfus'.$ixt.'" value="'.$fzData02['cap_fusible'].'"/></td>
                        <td class="h"><input type="text" class="fz5" name="fzt_calibre'.$ixt.'" value="'.$fzData02['calibre'].'"/></td>
                        <td class="h"><input type="text" class="fz6" name="fzt_lcbl'.$ixt.'" value="'.$fzData02['l_cable'].'"/></td>
                        <td class="h"><input type="text" class="fz7" name="fzt_cntcb'.$ixt.'" value="'.$fzData02['c_cable'].'"/></td>
                        <td class="h"><input type="text" class="fz8" name="fzt_cntcb'.$ixt.'" value="'.$fzData02['t_zapata'].'"/></td></tr>';  
                        $ixt++;
                    }
                }
                $contador++;
            }
            else{
                $fzDatos = "SELECT * FROM zinter_fz WHERE id = ".$fzIdRespaldo[$contador2].";";
                //echo $fzDatos.'br/>'.$contador.'<br/>';
                $fzResultSet02 = mysql_query($fzDatos, $conectar2);
                $fzsz02 = mysql_num_rows($fzResultSet02);
                if($fzsz02 > 0){
                    for($k = 0; $k < $fzsz02; $k++){
                        $fzData02 = mysql_fetch_array($fzResultSet02);
                        $intabla06 .= '<tr><input type="hidden" name="fzr_id'.$ixr.'" value="'.$fzData02['id'].'"/><td class="h2">Respaldo</td>
                        <td class="h"><input type="text" class="fz2" id="fzr_ubal'.$ixr.'" name="fzr_ubal'.$ixr.'" value="'.$fzData02['ub_alimen'].'" onblur="popitup(this.id);"/></td>
                        <td class="h"><input type="text" class="fz3" name="fzr_break'.$ixr.'" value="'.$fzData02['pf_breaker'].'"/></td>
                        <td class="h"><input type="text" class="fz4" name="fzr_capfus'.$ixr.'" value="'.$fzData02['cap_fusible'].'"/></td>
                        <td class="h"><input type="text" class="fz5" name="fzr_calibre'.$ixr.'" value="'.$fzData02['calibre'].'"/></td>
                        <td class="h"><input type="text" class="fz6" name="fzr_lcbl'.$ixr.'" value="'.$fzData02['l_cable'].'"/></td>
                        <td class="h"><input type="text" class="fz7" name="fzr_cntcb'.$ixr.'" value="'.$fzData02['c_cable'].'"/></td>
                        <td class="h"><input type="text" class="fz8" name="fzr_cntcb'.$ixr.'" value="'.$fzData02['t_zapata'].'"/></td></tr>';
                        $ixr++;
                    }
                }
                $contador2++;
            }
        }
    }
    else{
        for($i = 1; $i <= $numeq; $i++){
            $intabla06 .= '<td rowspan="2">
                <select name="fz_mod'.$i.'">'.$modelos.'</select>
            </td>
            <td class="h2">Trabajo</td>
            <td class="h"><input type="text" class="fz2" id="fzt_ubal'.$i.'" name="fzt_ubal'.$i.'" onblur="popitup(this.id);"/></td>
            <td class="h"><input type="text" class="fz3" name="fzt_break'.$i.'"/></td>
            <td class="h"><input type="text" class="fz4" name="fzt_capfus'.$i.'"/></td>
            <td class="h"><input type="text" class="fz5" name="fzt_calibre'.$i.'"/></td>
            <td class="h"><input type="text" class="fz6" name="fzt_lcbl'.$i.'"/></td>
            <td class="h"><input type="text" class="fz7" name="fzt_cntcb'.$i.'"/></td>
            <td class="h"><input type="text" class="fz8" name="fzt_cntcb'.$i.'"/></td>
        </tr>
        <tr>
            <td class="h2">Respaldo</td>
            <td class="h"><input type="text" class="fz2" id="fzr_ubal'.$i.'" name="fzr_ubal'.$i.'" onblur="popitup(this.id);"/></td>
            <td class="h"><input type="text" class="fz3" name="fzr_break'.$i.'"/></td>
            <td class="h"><input type="text" class="fz4" name="fzr_capfus'.$i.'"/></td>
            <td class="h"><input type="text" class="fz5" name="fzr_calibre'.$i.'"/></td>
            <td class="h"><input type="text" class="fz6" name="fzr_lcbl'.$i.'"/></td>
            <td class="h"><input type="text" class="fz7" name="fzr_cntcb'.$i.'"/></td>
            <td class="h"><input type="text" class="fz8" name="fzr_cntcb'.$i.'"/></td>
        </tr>';
        }
    }
    return $intabla06;
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
    require 'conexion.php';
    $salida = array();
    $imagenes = '';
    $zip = '';
    $query = "SELECT * FROM zarchivos WHERE folio = '".$folio."';";
    $result = mysql_query($query,$conectar2);
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
                $zip .= '<li id="f'.$files['id'].'"><div class="nm"><a id="'.$files['id'].'" href="'.$files['ruta'].'"'.$desc.'>'.$files['nombre'].'</a></div><div class="fmt">ZIP</div><div class="dl" onclick="dt(\'f'.$files['id'].'\')"></div><div class="dsc" onclick="addesc('.$files['id'].')"></div></li>';
            }
            else{
                //En caso de ser imagen
                $desc = '';
                if($files['descripcion'] != '-'){
                    $desc = ' title="'.$files['descripcion'].'" ';
                }
                $imagenes .= '<li id="'.$files['id'].'"><a href="'.$files['ruta'].'" rel="shadowbox[Mixed];"><img id="'.$files['id'].'" src="'.$files['ruta'].'"'.$desc.'></a><div class="dt" onclick="dt(\''.$files['id'].'\')"></div><div class="dsc" onclick="addesc('.$files['id'].')"></div></li>';
            }
        }
    }
    $salida[0] = $zip;
    $salida[1] = $imagenes;
    return $salida;
}
?>