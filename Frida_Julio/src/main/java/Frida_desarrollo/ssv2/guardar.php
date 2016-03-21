<?php 
    require 'functions/guarda.php';
    require 'functions/saver.php';
    require 'functions/tildeReplace.php';
    include 'classes/Conn.php';
    include 'classes/Observaciones.php';

        $folio = $_POST['folio'];
        $flag = $_POST['flag'];
        $copias = $_POST['copias'];
        $usr = $_POST['usr'];
        $emails = array();
        $enombres = array();
        $conta2 = 0;
        $estatus_ss = $_POST['estatus_ss'];
        if($estatus_ss == 'POR REALIZAR'){
            $ob = new Observaciones($folio,2,$usr);
        }
        for($i = 1; $i <= $copias; $i++){
            if(isset($_POST['enombre'.$i])){
                $enombres[$conta2] = trim($_POST['enombre'.$i]);
                $emails[$conta2] = trim($_POST['ecorreo'.$i]);
                $conta2++;
            }
        }
        mascorreos($folio, $emails, $enombres);
/*-------------------------------------------
 * RECUPERAR  Y GUARDAR UBICACIÓN DE EQUIPOS
 --------------------------------------------*/
 
        $rubro=$_POST['rubro'];
        $nueq=$_POST['nueq'];
        if($rubro == 'TRANSPORTE'){
            for($i = 0; $i < $nueq; $i++){
                updateDatosPorEquipoTransporte($_POST['idEq'.$i],$_POST['ubicacion_equipo'.$i],$_POST['nuevoEx'.$i],$_POST['espacio'.$i]);
            }
        }
        else if($rubro == 'ACCESO'){
            for($i = 0; $i < $nueq; $i++){
                updateDatosPorEquipoAcceso($_POST['idEq'.$i],$_POST['ubicacion_equipo'.$i],$_POST['nuevoEx'.$i],$_POST['puertosn'.$i],$_POST['tarjetasn'.$i],$_POST['espacio'.$i]);
            }
        }
        
        
        //$hiddenafo = Si se agregaron nuevas interconexiones dinamicamente,
        //esta variable dara el total de las interconexiones que se realizarón.
        $hiddenafo = $_POST['tbfo'];
        $hiddenbfo = $_POST['tbdwfo'];
        $hiddenmp = $_POST['tbmp'];
        $hiddencx = $_POST['tbcx'];
        
/*---------------------------------------------
 * RECUPERAR DATOS DE ESTADO GENERAL DE SITIO
 ----------------------------------------------*/
        $eg_tipotrabajo = trim($_POST['tipo_trabajo']);
        if($eg_tipotrabajo != 'Nuevo'){
            $eg_tipotrabajo = 'Ampliacion';
        }
        $eg_coment_tipotrabajo = trim(tildeReplace($_POST['eg_tt_comt']));
        
        $eg_tipocentral = trim($_POST['tipo_central']);
        if($eg_tipocentral == 'Otro'){
            $eg_tipocentral = trim(tildeReplace($_POST['9tceo']));
        }
        $eg_coment_tipocentral = trim(tildeReplace($_POST['eg_tc_comt']));
        
//        $eg_espacio = trim($_POST['espacio']);
//        if($eg_espacio == 'Otro'){
//            $eg_espacio = trim($_POST['9espo']);
//        }
//        $eg_coment_espacio = trim($_POST['eg_es_comt']);
        
        $eg_tipodepiso = trim($_POST['tipo_piso']);
        if($eg_tipodepiso == 'Otro'){
            $eg_tipodepiso = trim(tildeReplace($_POST['9tpso']));
        }
        $eg_coment_tipodepiso = trim(tildeReplace($_POST['eg_tp_comt']));
        
        $eg_obracivil = trim($_POST['obra_civil']);
        if($eg_obracivil == 'Otro'){
            $eg_obracivil = trim(tildeReplace($_POST['9obco']));
        }
        $eg_coment_obracivil = trim(tildeReplace($_POST['eg_oc_comt']));
        
        $eg_tipomaniobra = trim($_POST['tipo_maniobra']);
        if($eg_tipomaniobra == 'Otro'){
            $eg_tipomaniobra = trim(tildeReplace($_POST['9tmro']));
        }
        $eg_coment_tipomaniobra = trim(tildeReplace($_POST['eg_tm_comt']));
        
/*-------------------------------------------
 * RECUPERAR  Y GUARDAR TABLA DE CANALETAS V4
 --------------------------------------------*/
        $sup = array('sfo','mfo','mmp','mcx','mgs','mft');
        //$sub = array('slc','nux','hei','len','inc','dwn');
        $db = array('afo','bfo','mp','cx','gs','fz');
        for($i = 0; $i < 6; $i++){
            mysql_query("UPDATE zsite_survey SET eg_".$db[$i]."_material=".$_POST[$sup[$i].'slc'].",eg_".$db[$i]."_nuex=".$_POST[$sup[$i].'nux'].",eg_".$db[$i]."_sat=".$_POST[$sup[$i].'sat'].",eg_".$db[$i]."_altura='".$_POST[$sup[$i].'hei']."',eg_".$db[$i]."_trayectoria='".$_POST[$sup[$i].'len']."',eg_".$db[$i]."_pulgadas='".$_POST[$sup[$i].'inc']."',eg_".$db[$i]."_bajante='".$_POST[$sup[$i].'dwn']."',eg_".$db[$i]."_nobajante='".$_POST[$sup[$i].'adw']."' WHERE folio='".$folio."'");
        }
        $eg_coment_can = trim(tildeReplace($_POST['eg_coment_can']));
/*------------------------------------------------------------------
 * RECUPERAR DATOS DE FIBRA ÓPTICA [ALTO ORDEN]
 -------------------------------------------------------------------*/
        $afo_bastidor_fibra = trim($_POST['fo_bastidor_fibra']);
        $afo_bastidor_fibra_espacio = $afo_bastidor_fibra == 'Nuevo' ? $_POST['fo_bastidor_fibra_espacio'] : 'No';
        $afo_tipo_bastidor_fibra = trim($_POST['fo_tipo_bastidor_fibra']);
        if($afo_tipo_bastidor_fibra == 'Otro'){
            $afo_tipo_bastidor_fibra = trim($_POST['9fobo']);
        }
        $afo_bastidor_marca = trim($_POST['fo_bastidor_marca']);
        $afo_bloque_dfo = $_POST['fo_bloque_dfo'];
        //TIPO DE BASTIDOR DE FIBRAS
        $afo_canaleta = trim($_POST['fo_canaleta']);
        $afo_canaleta_altura;$afo_canaleta_longitud;
        if($afo_canaleta == 'Existente'){
            $afo_canaleta_altura = trim($_POST['-foex']);
            $afo_canaleta_longitud = trim($_POST['-foexl']);
        }
        else{
           $afo_canaleta_altura = trim($_POST['-fonu']); 
           $afo_canaleta_longitud = trim($_POST['-fonul']);
        }
        $afo_coment_canaleta = trim(tildeReplace($_POST['fo_canaleta_coment']));
        
        //CANALETA DE BASTIDOR DE FIBRAS
        $afo_canaleta_tipo = trim($_POST['fo_canaleta_tipo']);
        
        $afo_canaleta_tipo_mt;
        $afo_canaleta_tipo_in;
        if($afo_canaleta_tipo == 'Aluminio'){
            $afo_canaleta_tipo_mt = trim($_POST['fo_canaleta_tipo_al_mt']);
            $afo_canaleta_tipo_in = trim($_POST['fo_canaleta_tipo_al_in']);
        }
        else if($afo_canaleta_tipo == 'Acero'){
            $afo_canaleta_tipo_mt = trim($_POST['fo_canaleta_tipo_fec_mt']);
            $afo_canaleta_tipo_in = trim($_POST['fo_canaleta_tipo_fec_in']);
        }
        else if($afo_canaleta_tipo == 'Charola'){
            $afo_canaleta_tipo_mt = trim($_POST['fo_canaleta_tipo_cuzn_mt']);
            $afo_canaleta_tipo_in = trim($_POST['fo_canaleta_tipo_cuzn_in']);
        }
        else if($afo_canaleta_tipo == 'Plástica'){
            $afo_canaleta_tipo_mt = trim($_POST['fo_canaleta_tipo_cho_mt']);
            $afo_canaleta_tipo_in = trim($_POST['fo_canaleta_tipo_cho_in']);
        }
        else{
            $afo_canaleta_tipo = trim($_POST['fo_canaleta_tipo_otro_name']);
            $afo_canaleta_tipo_mt = trim($_POST['fo_canaleta_tipo_otro_mt']);
            $afo_canaleta_tipo_in = trim($_POST['fo_canaleta_tipo_otro_in']);
        }
        $afo_coment_canaleta_tipo = trim(tildeReplace($_POST['fo_tipo_canaleta_coment']));
        
        //I N T E R C O N E X I O N E S [A L T O  O R D E N  F I B R A  O P T I C A]
        $afo_id;
        $afo_mdl;
        $afo_ub;
        $afo_dfo;
        $afo_cox;
        $afo_psrem;
        $afo_fibra;
        $afo_condfo;
//        $afo_txrx;
        $afo_bloquedfo;
        $afo_ljuno;
        $afo_ljdos;
        $ct1 = 0;
        
        for($d = 1; $d <= $hiddenafo; $d++){
            $afo_id[$ct1] = $_POST['fo_id'.$d];
            $afo_mdl[$ct1] = trim($_POST['fo_mod'.$d]);
            $afo_ub[$ct1] = trim($_POST['fo_ubeq'.$d]);
            $afo_dfo[$ct1] = trim($_POST['fo_dfo'.$d]);
            $afo_psrem[$ct1] = trim($_POST['_fo_ps_rmt'.$d]);
            if($afo_psrem[$ct1] == ''){
                //$afo_psrem[$ct1] = 'PEND.';
                $afo_psrem[$ct1] = '';
            }
            $afo_cox[$ct1] = trim($_POST['fo_tpcon_eq'.$d]);
            $afo_fibra[$ct1] = trim($_POST['fo_fibra'.$d]);
            $afo_condfo[$ct1] = trim($_POST['fo_tpconlado_eq'.$d]);
//            $afo_txrx[$ct1] = $_POST['fo_TxRx'.$d];
            $afo_bloquedfo[$ct1] = $_POST['fo_bloque_dfo'.$d];
            $afo_ljuno[$ct1] = trim($_POST['fo_ljump'.$d.'_1']);
            $afo_ljdos[$ct1] = trim($_POST['fo_ljump'.$d.'_2']);
            $ct1++;
        }
        //print_r($afo_id);
        //Determinar si el arreglo esta vácio [¬_¬]
        $countdown = 0;
        for($w = 0; $w < count($afo_id); $w++){
            if(!is_null($afo_id[$w])){
                $countdown++;
            }
        }
        //echo $countdown;
        if($countdown == 0){
            unset($afo_id);
            $afo_id = 'n';
        }
//        print_r($afo_id);
        $afo_comentarios = trim($_POST['fo_final_coment']);
/*------------------------------------------------------------------
 * RECUPERAR DATOS DE FIBRA ÓPTICA [BAJO ORDEN]
 -------------------------------------------------------------------*/
        $bfo_bastidor_fibra = trim($_POST['dwfo_bastidor_fibra']);
        $bfo_bastidor_fibra_espacio = $bfo_bastidor_fibra == 'Nuevo' ? $_POST['dwfo_bastidor_fibra_espacio'] : 'No';
        $bfo_tipo_bastidor_fibra = trim($_POST['dwfo_tipo_bastidor_fibra']);
        if($bfo_tipo_bastidor_fibra == 'Otro'){
            $bfo_tipo_bastidor_fibra = trim($_POST['9dobo']);
        }
        $bfo_bastidor_marca = trim($_POST['dwfo_bastidor_marca']);
        $bfo_bloque_dfo = $_POST['dwfo_bloque_dfo'];
        //TIPO DE BASTIDOR DE FIBRAS
        $bfo_canaleta = trim($_POST['do_canaleta']);
        $bfo_canaleta_altura;$bfo_canaleta_longitud;
        if($bfo_canaleta == 'Existente'){
            $bfo_canaleta_altura = trim($_POST['-doex']);
            $bfo_canaleta_longitud = trim($_POST['-doexl']);
        }
        else{
           $bfo_canaleta_altura = trim($_POST['-donu']);
           $bfo_canaleta_longitud = trim($_POST['-donul']);
        }
        $bfo_coment_canaleta = trim(tildeReplace($_POST['dwfo_canaleta_coment']));
        
        //CANALETA DE BASTIDOR DE FIBRAS
        $bfo_canaleta_tipo = trim($_POST['do_canaleta_tipo']);
        
        $bfo_canaleta_tipo_mt;
        $bfo_canaleta_tipo_in;
        if($bfo_canaleta_tipo == 'Aluminio'){
            $bfo_canaleta_tipo_mt = trim($_POST['do_canaleta_tipo_al_mt']);
            $bfo_canaleta_tipo_in = trim($_POST['do_canaleta_tipo_al_in']);
        }
        else if($bfo_canaleta_tipo == 'Acero'){
            $bfo_canaleta_tipo_mt = trim($_POST['do_canaleta_tipo_fec_mt']);
            $bfo_canaleta_tipo_in = trim($_POST['do_canaleta_tipo_fec_in']);
        }
        else if($bfo_canaleta_tipo == 'Charola'){
            $bfo_canaleta_tipo_mt = trim($_POST['do_canaleta_tipo_cuzn_mt']);
            $bfo_canaleta_tipo_in = trim($_POST['do_canaleta_tipo_cuzn_in']);
        }
        else if($bfo_canaleta_tipo == 'Plástica'){
            $bfo_canaleta_tipo_mt = trim($_POST['do_canaleta_tipo_cho_mt']);
            $bfo_canaleta_tipo_in = trim($_POST['do_canaleta_tipo_cho_in']);
        }
        else{
            $bfo_canaleta_tipo = trim($_POST['do_canaleta_tipo_otro_name']);
            $bfo_canaleta_tipo_mt = trim($_POST['do_canaleta_tipo_otro_mt']);
            $bfo_canaleta_tipo_in = trim($_POST['do_canaleta_tipo_otro_in']);
        }
        
        $bfo_coment_canaleta_tipo = trim(tildeReplace($_POST['dwfo_tipo_canaleta_coment']));
        
        //I N T E R C O N E X I O N E S [B A J O  O R D E N  F I B R A  O P T I C A]
        $bfo_id;
        $bfo_mdl;
        $bfo_ub;
        $bfo_dfo;
        $bfo_cox;
        $bfo_psrem;
        $bfo_fibra;
        $bfo_condfo;
        $bfo_txrx;
        $bfo_bloquedfo;
        $bfo_ljuno;
        $bfo_ljdos;
        $ct2 = 0;
        for($d = 1; $d <= $hiddenbfo; $d++){
            $bfo_id[$ct2] = $_POST['dwfo_id'.$d];
            $bfo_mdl[$ct2] = trim($_POST['dwfo_mod'.$d]);
            $bfo_ub[$ct2] = trim($_POST['dwfo_ubeq'.$d]);
            $bfo_dfo[$ct2] = trim($_POST['dwfo_dfo'.$d]);
            $bfo_psrem[$ct2] = trim($_POST['_dwfo_ps_rmt'.$d]);
            if($bfo_psrem[$ct2] == ''){
                //$bfo_psrem[$ct2] = 'PEND.';
                $bfo_psrem[$ct2] = '';
            }
            $bfo_cox[$ct2] = trim($_POST['dwfo_tpcon_eq'.$d]);
            $bfo_fibra[$ct2] = trim($_POST['dwfo_fibra'.$d]);
            $bfo_condfo[$ct2] = trim($_POST['dwfo_tpconlado_eq'.$d]);
            //$bfo_txrx[$ct2] = $_POST['dwfo_TxRx'.$d];
            $bfo_bloquedfo[$ct2] = $_POST['dwfo_bloque_dfo'.$d];
            $bfo_ljuno[$ct2] = trim($_POST['dwfo_ljump'.$d.'_1']);
            $bfo_ljdos[$ct2] = trim($_POST['dwfo_ljump'.$d.'_2']);
            $ct2++;
        }
        //print_r($bfo_id);
        $countdown2 = 0;
        for($w = 0; $w < count($bfo_id); $w++){
            if(!is_null($bfo_id[$w])){
                $countdown2++;
            }
        }
        if($countdown2 == 0){
            unset($bfo_id);
            $bfo_id = 'n';
        }
        //print_r($bfo_id);
        $bfo_comentarios = trim($_POST['dwfo_final_coment']);

/*------------------------------------------------------------------
 * RECUPERAR DATOS DE MULTIPAR [BAJO ORDEN]
 -------------------------------------------------------------------*/
        $mp_dgral = trim($_POST['mp_dgral']);
        $mp_disgral = trim($_POST['mp_disgral']);
        $mp_ampvertical = $_POST['mp_ampvertical'];
        $mp_spadisp = $mp_ampvertical == 'Si' ? $_POST['mp_spadisp'] : 'No';
        if($mp_disgral == 'Otro'){
            $mp_disgral = trim($_POST['9mpdo']);
        }
        $mp_canaleta = trim($_POST['mp_canaleta']);
        $mp_canaleta_altura;
        $mp_canaleta_longitud;
        if($mp_canaleta == 'Existente'){
            $mp_canaleta_altura = trim($_POST['-mpex']);
            $mp_canaleta_longitud = trim($_POST['-mpexl']);
        }
        else{
            $mp_canaleta_altura = trim($_POST['-mpnu']);
            $mp_canaleta_longitud = trim($_POST['-mpnul']);
        }
        $mp_canaleta_coment = trim($_POST['mp_canaleta_coment']);
        
        //CANALETA DE BASTIDOR DE FIBRAS
        $mp_canaleta_tipo = trim($_POST['mp_canaleta_tipo']);
        
        $mp_canaleta_tipo_mt;
        $mp_canaleta_tipo_in;
        if($mp_canaleta_tipo == 'Aluminio'){
            $mp_canaleta_tipo_mt = trim($_POST['mp_canaleta_tipo_al_mt']);
            $mp_canaleta_tipo_in = trim($_POST['mp_canaleta_tipo_al_in']);
        }
        else if($mp_canaleta_tipo == 'Acero'){
            $mp_canaleta_tipo_mt = trim($_POST['mp_canaleta_tipo_fec_mt']);
            $mp_canaleta_tipo_in = trim($_POST['mp_canaleta_tipo_fec_in']);
        }
        else if($mp_canaleta_tipo == 'Charola'){
            $mp_canaleta_tipo_mt = trim($_POST['mp_canaleta_tipo_cuzn_mt']);
            $mp_canaleta_tipo_in = trim($_POST['mp_canaleta_tipo_cuzn_in']);
        }
        else if($mp_canaleta_tipo == 'Plástica'){
            $mp_canaleta_tipo_mt = trim($_POST['mp_canaleta_tipo_cho_mt']);
            $mp_canaleta_tipo_in = trim($_POST['mp_canaleta_tipo_cho_in']);
        }
        else{
            $mp_canaleta_tipo = trim($_POST['mp_canaleta_tipo_otro_name']);
            $mp_canaleta_tipo_mt = trim($_POST['mp_canaleta_tipo_otro_mt']);
            $mp_canaleta_tipo_in = trim($_POST['mp_canaleta_tipo_otro_in']);
        }
        $mp_coment_canaleta_tipo = trim(tildeReplace($_POST['mp_tipo_canaleta_coment']));
        //I N T E R C O N E X I O N E S [B A J O  O R D E N  F I B R A  O P T I C A]
        /*  --- INTERCONEXIONES MULTIPAR    --- */
        //  Variables de inicio
        $interMP_datos = array();
        $e = 1;

        //Recuperar el numero de equipos
        $interMP_nueq = $_POST['tbmp'];

        //  Ciclo que va a recuperar el numero de interconexiones por equipo
        for($i = 1; $i <= $interMP_nueq; $i++){
            $interMP_inEq = $_POST['inmp'.$i];

            //  Ciclo que va a los datos de las interconexiones
            for($j = 1; $j <= $interMP_inEq; $j++){
                $interMP_datos[$i][$j][0] = $interMP_inEq == 3 ? 'Versablock' : 'Portasystem';
                $interMP_datos[$i][$j][1] = strtoupper($_POST['IntMpNiv'.$i.'0'.$j]);
                $interMP_datos[$i][$j][2] = $_POST['IntMpVer'.$i.'0'.$j];
                $interMP_datos[$i][$j][3] = $_POST['IntMpPto'.$i.'0'.$j];
                $interMP_datos[$i][$j][4] = strtoupper($_POST['IntMpNiv'.$i.'1'.$j]);
                $interMP_datos[$i][$j][5] = $_POST['IntMpVer'.$i.'1'.$j];
                $interMP_datos[$i][$j][6] = $_POST['IntMpPto'.$i.'1'.$j];
                $interMP_datos[$i][$j][7] = $_POST['mp_lgcbl'.$i];
            }
        }
		
		//  Verificar si se va a actualizar o a insertar
        $iorup = mysql_query("SELECT count(zinter_mp.id) t from zinter_mp,zss_equipos where zinter_mp.folio=zss_equipos.folio and zinter_mp.folio='".$folio."' and zinter_mp.id_equipo=zss_equipos.id and zss_equipos.tipo_trabajo='Repisa Nueva'");
        $iorup = mysql_fetch_array($iorup, MYSQL_BOTH);
        $iorup = $iorup[0];
		
        //  traer id de equipos asociados al folio
        $id = array();
        $equipos = "SELECT id FROM zss_equipos where folio = '".$folio."' AND id_tecnologia!=0 AND tipo_trabajo = 'Repisa Nueva' ORDER BY id ASC";
        $rresult = mysql_query($equipos);
        for($c = 0; $c < mysql_num_rows($rresult); $c++){
            $d = mysql_fetch_row($rresult);
            $id[$e] = $d[0];
            $e++;
        }
		
		if($iorup == 0){    //  INSERTAR DATOS
            for($i = 1; $i <= count($interMP_datos); $i++){
                for($j = 1; $j <= count($interMP_datos[$i]); $j++){
                    $query1 = "INSERT INTO zinter_mp (id,folio,id_equipo,pots_dsl,vertical,nivel,tipo_tablilla,puertos,long_cable) "
                    . "VALUES(id,'".$folio."',".$id[$i].",0,'".$interMP_datos[$i][$j][2]."','".$interMP_datos[$i][$j][1]."','".$interMP_datos[$i][$j][0]."','".$interMP_datos[$i][$j][3]."',".$interMP_datos[$i][$j][7].")";
                    mysql_query($query1);

                    $query2 = "INSERT INTO zinter_mp (id,folio,id_equipo,pots_dsl,vertical,nivel,tipo_tablilla,puertos,long_cable) "
                    . "VALUES(id,'".$folio."',".$id[$i].",1,'".$interMP_datos[$i][$j][5]."','".$interMP_datos[$i][$j][4]."','".$interMP_datos[$i][$j][0]."','".$interMP_datos[$i][$j][6]."',".$interMP_datos[$i][$j][7].")";
                    mysql_query($query2);
                }
            }
        }
        else{               //  ACTUALIZAR DATOS
            //  Buscar ids de interconexiones a actualizar
            $f = 1;
            $id = array();
            $buscaId = "select zinter_mp.id from zinter_mp,zss_equipos where zinter_mp.folio=zss_equipos.folio and zss_equipos.folio='".$folio."' and zss_equipos.tipo_trabajo='Repisa Nueva' and zinter_mp.id_equipo=zss_equipos.id order by zinter_mp.id";
            $RbuscaId = mysql_query($buscaId);
            $rsz = mysql_num_rows($RbuscaId);
            if($rsz > 0){
                for($i = 0; $i < $rsz; $i++){
                    $d1 = mysql_fetch_array($RbuscaId);
                    $id[$f] = $d1['id'];
                    $f++;
                }
            }
            $g = 1;
            //  Realizar update
            for($i = 1; $i <= count($interMP_datos); $i++){
                for($j = 1; $j <= count($interMP_datos[$i]); $j++){
                    $query1 = "UPDATE zinter_mp SET vertical='".$interMP_datos[$i][$j][2]."',nivel='".$interMP_datos[$i][$j][1]."',puertos='".$interMP_datos[$i][$j][3]."',long_cable=".$interMP_datos[$i][$j][7]." WHERE id = ".$id[$g];
                    mysql_query($query1);
                    $g++;
                    $query2 = "UPDATE zinter_mp SET vertical='".$interMP_datos[$i][$j][5]."',nivel='".$interMP_datos[$i][$j][4]."',puertos='".$interMP_datos[$i][$j][6]."',long_cable=".$interMP_datos[$i][$j][7]." WHERE id = ".$id[$g];
                    mysql_query($query2);
                    $g++;
                }
            }
        }
		//**********************************************************************************
		//**********************************************************************************
        /*  --- INTERCONEXIONES MULTIPAR PARA EQUIPOS EXISTENTES    --- */
        //  Variables de inicio
        $interMPEX_datos = array();
        $eEX = 1;
        $interMPEX_inEq;

        //Recuperar el numero de equipos
        $interMPEX_nueq = $_POST['tbmpex'];
        //  Ciclo que va a recuperar el numero de interconexiones por equipo
        for($i = 1; $i <= $interMPEX_nueq; $i++){
            $tpTablilla = $_POST['hf_mtp_slcmp'.$i];
            if($tpTablilla == 'Versablock'){
                $interMPEX_inEq = 3;
            }
            else if($tpTablilla == 'Portasystem'){
                $interMPEX_inEq = 8;
            }
            else{
                $interMPEX_inEq = 0;
            }
            //  Ciclo que va a los datos de las interconexiones
            for($j = 1; $j <= $interMPEX_inEq; $j++){
                $interMPEX_datos[$i][$j][0] = $tpTablilla;
                $interMPEX_datos[$i][$j][1] = strtoupper($_POST['hf_mtp_nivel'.$i.'0'.$j]);
                $interMPEX_datos[$i][$j][2] = $_POST['hf_mtp_vertical'.$i.'0'.$j];
                $interMPEX_datos[$i][$j][3] = $_POST['hf_mtp_puerto'.$i.'0'.$j];
                $interMPEX_datos[$i][$j][4] = strtoupper($_POST['hf_mtp_nivel'.$i.'1'.$j]);
                $interMPEX_datos[$i][$j][5] = $_POST['hf_mtp_vertical'.$i.'1'.$j];
                $interMPEX_datos[$i][$j][6] = $_POST['hf_mtp_puerto'.$i.'1'.$j];
                $interMPEX_datos[$i][$j][7] = $_POST['hf_mp_lgcbl'.$i];
            }
        }
        
        
        
        //  Verificar si se va a actualizar o a insertar
//        $iorupEX = mysql_query("SELECT count(zinter_mp.id) t from zinter_mp,zss_equipos where zinter_mp.folio=zss_equipos.folio and zinter_mp.folio='".$folio."' and zinter_mp.id_equipo=zss_equipos.id and zss_equipos.tipo_trabajo!='Repisa Nueva'");
//        $iorupEX = mysql_fetch_array($iorupEX, MYSQL_BOTH);
//        $iorupEX = $iorupEX[0];
        
        
        //  traer id de equipos asociados al folio
        $idEX = array();
        $equiposEX = "SELECT id FROM zss_equipos where folio = '".$folio."' AND tipo_trabajo != 'Repisa Nueva' ORDER BY id ASC";
        $rresultEX = mysql_query($equiposEX);
        for($c = 0; $c < mysql_num_rows($rresultEX); $c++){
            $d = mysql_fetch_row($rresultEX);
            $idEX[$eEX] = $d[0];
            $eEX++;
        }
        
        //  BORRAR DATOS
        foreach($idEX as $value){
            $delete = "delete from zinter_mp where folio='".$folio."' and id_equipo=".$value;
            mysql_query($delete);
        }
        
//        if($iorupEX == 0){    //  INSERTAR DATOS
            for($i = 1; $i <= count($interMPEX_datos); $i++){
                for($j = 1; $j <= count($interMPEX_datos[$i]); $j++){
                    $query1 = "INSERT INTO zinter_mp (id,folio,id_equipo,pots_dsl,vertical,nivel,tipo_tablilla,puertos,long_cable) "
                    . "VALUES(id,'".$folio."',".$idEX[$i].",0,'".$interMPEX_datos[$i][$j][2]."','".$interMPEX_datos[$i][$j][1]."','".$interMPEX_datos[$i][$j][0]."','".$interMPEX_datos[$i][$j][3]."',".$interMPEX_datos[$i][$j][7].")";
                    mysql_query($query1);
                    $query2 = "INSERT INTO zinter_mp (id,folio,id_equipo,pots_dsl,vertical,nivel,tipo_tablilla,puertos,long_cable) "
                    . "VALUES(id,'".$folio."',".$idEX[$i].",1,'".$interMPEX_datos[$i][$j][5]."','".$interMPEX_datos[$i][$j][4]."','".$interMPEX_datos[$i][$j][0]."','".$interMPEX_datos[$i][$j][6]."',".$interMPEX_datos[$i][$j][7].")";
                    mysql_query($query2);
                }
            }
//        }
//        else{               //  ACTUALIZAR DATOS
//            //  Buscar ids de interconexiones a actualizar
//            $f = 1;
//            $id = array();
//            $buscaId = "select zinter_mp.id from zinter_mp,zss_equipos where zinter_mp.folio=zss_equipos.folio and zss_equipos.folio='".$folio."' and zss_equipos.tipo_trabajo!='Repisa Nueva' and zinter_mp.id_equipo=zss_equipos.id order by zinter_mp.id";
//            $RbuscaId = mysql_query($buscaId);
//            $rsz = mysql_num_rows($RbuscaId);
//            if($rsz > 0){
//                for($i = 0; $i < $rsz; $i++){
//                    $d1 = mysql_fetch_array($RbuscaId);
//                    $id[$f] = $d1['id'];
//                    $f++;
//                }
//            }
//            $g = 1;
//            //  Realizar update
//            for($i = 1; $i <= count($interMPEX_datos); $i++){
//                for($j = 1; $j <= count($interMPEX_datos[$i]); $j++){
//                    $query1 = "UPDATE zinter_mp SET vertical='".$interMPEX_datos[$i][$j][2]."',nivel='".$interMPEX_datos[$i][$j][1]."',puertos='".$interMPEX_datos[$i][$j][3]."',long_cable=".$interMPEX_datos[$i][$j][7]." WHERE id = ".$id[$g];
//                    mysql_query($query1);
//                    $g++;
//                    $query2 = "UPDATE zinter_mp SET vertical='".$interMPEX_datos[$i][$j][5]."',nivel='".$interMPEX_datos[$i][$j][4]."',puertos='".$interMPEX_datos[$i][$j][6]."',long_cable=".$interMPEX_datos[$i][$j][7]." WHERE id = ".$id[$g];
//                    mysql_query($query2);
//                    $g++;
//                }
//            }
//        }
/*------------------------------------------------------------------
 * RECUPERAR DATOS DE COAXIAL [BAJO ORDEN]
 -------------------------------------------------------------------*/
        $cx_escalerilla_bdtd = trim($_POST['cx_escalerilla_bdtd']);
        $cx_escalerilla_bdtd_espacio = $cx_escalerilla_bdtd == 'Nuevo' ? $_POST['cx_escalerilla_bdtd_espacio'] : 'No';
        $cx_tipo_escalerilla_bdtd = trim($_POST['cx_tipo_escalerilla_bdtd']);
        if($cx_tipo_escalerilla_bdtd == 'Otro'){
            $cx_tipo_escalerilla_bdtd = trim($_POST['9cxdo']);
        }
        
        $cx_canaleta = trim($_POST['cx_canaleta']);
        $cx_canaleta_altura;$cx_canaleta_longitud;
        if($cx_canaleta == 'Existente'){
            $cx_canaleta_altura = trim($_POST['-cxex']);
            $cx_canaleta_longitud = trim($_POST['-cxexl']);
        }
        else{
            $cx_canaleta_altura = trim($_POST['-cxnu']);
            $cx_canaleta_longitud = trim($_POST['-cxnul']);
        }
        $cx_escalerilla_coment = trim($_POST['cx_escalerilla_coment']);
        
        //CANALETA DE BASTIDOR DE FIBRAS
        $cx_canaleta_tipo = trim($_POST['cx_canaleta_tipo']);
        
        $cx_canaleta_tipo_mt;
        $cx_canaleta_tipo_in;
        if($cx_canaleta_tipo == 'Aluminio'){
            $cx_canaleta_tipo_mt = trim($_POST['cx_canaleta_tipo_al_mt']);
            $cx_canaleta_tipo_in = trim($_POST['cx_canaleta_tipo_al_in']);
        }
        else if($cx_canaleta_tipo == 'Acero'){
            $cx_canaleta_tipo_mt = trim($_POST['cx_canaleta_tipo_fec_mt']);
            $cx_canaleta_tipo_in = trim($_POST['cx_canaleta_tipo_fec_in']);
        }
        else if($cx_canaleta_tipo == 'Charola'){
            $cx_canaleta_tipo_mt = trim($_POST['cx_canaleta_tipo_cuzn_mt']);
            $cx_canaleta_tipo_in = trim($_POST['cx_canaleta_tipo_cuzn_in']);
        }
        else if($cx_canaleta_tipo == 'Plástica'){
            $cx_canaleta_tipo_mt = trim($_POST['cx_canaleta_tipo_cho_mt']);
            $cx_canaleta_tipo_in = trim($_POST['cx_canaleta_tipo_cho_in']);
        }
        else{
            $cx_canaleta_tipo = trim($_POST['cx_canaleta_tipo_otro_name']);
            $cx_canaleta_tipo_mt = trim($_POST['cx_canaleta_tipo_otro_mt']);
            $cx_canaleta_tipo_in = trim($_POST['cx_canaleta_tipo_otro_in']);
        }
        $cx_coment_canaleta_tipo = trim(tildeReplace($_POST['cx_tipo_escalerilla_coment']));
        
        //I N T E R C O N E X I O N E S [B A J O  O R D E N  C A B L E  C O A X I A L]
        $cx_id;
        $cx_mod;
        $cx_ub;
        $cx_ptab;
        $cx_lado;
        $cx_pcont;
        $cx_tcon;
        $cx_tcx;
        $cx_txrx;
        $cx_lcabl;
        $ct4 = 0;
        for($d = 1; $d <= $hiddencx; $d++){
            $cx_id[$ct4] = $_POST['cx_id'.$d];
            $cx_mod[$ct4] = trim($_POST['cx_mod'.$d]);
            $cx_ub[$ct4] = trim($_POST['cx_ubeq'.$d]);
            $cx_ptab[$ct4] = trim($_POST['cxubeq'.$d]);
//            if($cx_ptab[$ct4] == ''){
//                $cx_ptab[$ct4] = 'PEND.';
//            }
            $cx_lado[$ct4] = trim($_POST['cx_lado'.$d]);
            $cx_pcont[$ct4] = trim($_POST['_cxld'.$d]);
            if($cx_pcont[$ct4] == ''){
                //$cx_pcont[$ct4] = 'PEND.';
                $cx_pcont[$ct4] = '';
            }
            $cx_tcon[$ct4] = trim($_POST['cx_ld'.$d]);
            $cx_tcx[$ct4] = trim($_POST['cx_cx'.$d]);
            $cx_txrx[$ct4] = $_POST['cx_TrRx'.$d];
            $cx_lcabl[$ct4] = trim($_POST['cx_lcable'.$d]);
            $ct4++;
        }
        $countdown4 = 0;
        for($w = 0; $w < count($cx_id); $w++){
            if(!is_null($cx_id[$w])){
                $countdown4++;
            }
        }
        if($countdown4 == 0){
            unset($cx_id);
            $cx_id = 'n';
        }
        
        $cx_comentarios = trim($_POST['cx_final_coment']);
/*------------------------------------------------------------------
 * RECUPERAR DATOS DE GESTIÓN Y SINCRONÍA
 -------------------------------------------------------------------*/
        $gs_requiereGestion = trim($_POST['gs_reqgstion']);
        $gs_tipoGestion = trim($_POST['gs_tipogstion']);
        $gs_puertoRCDT = trim($_POST['gs_rctd']);
        $gs_requiereSincronia = trim($_POST['gs_reqsincronia']);
        $gs_cnAddAlarmas = trim($_POST['gs_reqalarmas']);
        $gs_reqctoalim = $_POST['gs_reqctoalim'];
        
        $gs_canaleta = trim($_POST['gs_canaleta']);
        $gs_canaleta_altura;$gs_canaleta_longitud;
        if($gs_canaleta == 'Existente'){
            $gs_canaleta_altura = trim($_POST['-gsex']);
            $gs_canaleta_longitud = trim($_POST['-gsexl']);
        }
        else{
            $gs_canaleta_altura = trim($_POST['-gsnu']);
            $gs_canaleta_longitud = trim($_POST['-gsnul']);
        }
        $gs_canaleta_coment = trim($_POST['gs_canaleta_coment']);
        
        //CANALETA DE BASTIDOR DE FIBRAS
        $gs_canaleta_tipo = trim($_POST['gs_canaleta_tipo']);
        
        $gs_canaleta_tipo_mt;
        $gs_canaleta_tipo_in;
        if($gs_canaleta_tipo == 'Aluminio'){
            $gs_canaleta_tipo_mt = trim($_POST['gs_canaleta_tipo_al_mt']);
            $gs_canaleta_tipo_in = trim($_POST['gs_canaleta_tipo_al_in']);
        }
        else if($gs_canaleta_tipo == 'Acero'){
            $gs_canaleta_tipo_mt = trim($_POST['gs_canaleta_tipo_fec_mt']);
            $gs_canaleta_tipo_in = trim($_POST['gs_canaleta_tipo_fec_in']);
        }
        else if($gs_canaleta_tipo == 'Charola'){
            $gs_canaleta_tipo_mt = trim($_POST['gs_canaleta_tipo_cuzn_mt']);
            $gs_canaleta_tipo_in = trim($_POST['gs_canaleta_tipo_cuzn_in']);
        }
        else if($gs_canaleta_tipo == 'Plástica'){
            $gs_canaleta_tipo_mt = trim($_POST['gs_canaleta_tipo_cho_mt']);
            $gs_canaleta_tipo_in = trim($_POST['gs_canaleta_tipo_cho_in']);
        }
        else{
            $gs_canaleta_tipo = trim($_POST['gs_canaleta_tipo_otro_name']);
            $gs_canaleta_tipo_mt = trim($_POST['gs_canaleta_tipo_otro_mt']);
            $gs_canaleta_tipo_in = trim($_POST['gs_canaleta_tipo_otro_in']);
        }
        $gs_coment_canaleta_tipo = trim(tildeReplace($_POST['gs_tipo_canaleta_coment']));
        
        $gs_comentarios = trim($_POST['gs_final_coment']);
        
        //I N T E R C O N E X I O N E S [B A J O  O R D E N  G E S T I Ó N  Y  S I N C R O N Í A]
        $g_mod;         $s_mod;
        $g_ubRCDT;      $s_ubRCDT;
        $g_nswitch;     $s_nswitch;
        $g_puerto;      $s_puerto;
        $g_catcable;    $s_catcable;   
        $g_lcable;      $s_lcable;
        $g_tcon;        $s_tcon;
        $ct5 = 0;
        $hiddengs = $_POST['tbgs'];
        $hiddensc = $_POST['tbsn'];
        for($d = 1; $d <= $hiddengs; $d++){
            $g_mod[$ct5] = $_POST['gs_mod'.$d];
            $s_mod[$ct5] = $_POST['sn_mod'.$d];
            
            $g_ubRCDT[$ct5] = trim($_POST['gs_ubeq'.$d]);
            $s_ubRCDT[$ct5] = trim($_POST['sn_ubeq'.$d]);
            
            $g_nswitch[$ct5] = trim($_POST['gs_sw'.$d]);
            $s_nswitch[$ct5] = trim($_POST['sn_sw'.$d]);
            
            $g_puerto[$ct5] = trim($_POST['gs_pt'.$d]);
            $s_puerto[$ct5] = trim($_POST['sn_pt'.$d]);
            
            $g_catcable[$ct5] = trim($_POST['gs_catc'.$d]);
            $s_catcable[$ct5] = trim($_POST['sn_catc'.$d]);
            
            $g_lcable[$ct5] = trim($_POST['gs_longc'.$d]);
            $s_lcable[$ct5] = trim($_POST['sn_longc'.$d]);
            
            $g_tcon[$ct5] = trim($_POST['gs_tcont'.$d]);
            $s_tcon[$ct5] = trim($_POST['sn_tcont'.$d]);
            $ct5++;
        }
//        print_r($s_mod);
//        print_r($s_ubRCDT);
//        print_r($s_nswitch);
//        print_r($s_puerto);
//        print_r($s_catcable);
//        print_r($s_lcable);
//        print_r($s_tcon);
/*------------------------------------------------------------------
 * RECUPERAR DATOS DE FUERZA
 -------------------------------------------------------------------*/
        //$fz_tp_alimen = $_POST['fz_tp_alimen'];
        $fz_tp_alimen = $_POST['fz_tp_alimen'] == 'Otro' ? trim($_POST['9fzao']) : $_POST['fz_tp_alimen'];
        $fz_configplanta = $_POST['fz_configplanta'];
        $fz_longcabletierra = $_POST['fz_longcabletierra'];
        $fz_escalerilla_bdtd = $_POST['fz_escalerilla_bdtd'];
        $fz_cl_reqnucl = $_POST['cl_reqnucl'];
        if($fz_escalerilla_bdtd == 'Otro'){
            $fz_escalerilla_bdtd = trim($_POST['9fzeo']);
        }
        $fz_consumo = trim($_POST['fz_cact']);
        
        $fz_canaleta = trim($_POST['fz_canaleta']);
        $fz_canaleta_altura;$fz_canaleta_longitud;
        if($fz_canaleta == 'Existente'){
            $fz_canaleta_altura = trim($_POST['-fzex']);
            $fz_canaleta_longitud = trim($_POST['-fzexl']);
        }
        else{
            $fz_canaleta_altura = trim($_POST['-fznu']);
            $fz_canaleta_longitud = trim($_POST['-fznul']);
        }
        $fz_escalerilla_coment = trim($_POST['fz_escalerilla_coment']);
        
        $fz_canaleta_tipo = $_POST['fz_canaleta_tipo'];
        $fz_canaleta_tipo_mt;
        $fz_canaleta_tipo_in;
        if($fz_canaleta_tipo == 'Aluminio'){
            $fz_canaleta_tipo_mt = trim($_POST['fz_canaleta_tipo_al_mt']);
            $fz_canaleta_tipo_in = trim($_POST['fz_canaleta_tipo_al_in']);
        }
        else if($fz_canaleta_tipo == 'Acero'){
            $fz_canaleta_tipo_mt = trim($_POST['fz_canaleta_tipo_fec_mt']);
            $fz_canaleta_tipo_in = trim($_POST['fz_canaleta_tipo_fec_in']);
        }
        else if($fz_canaleta_tipo == 'Charola'){
            $fz_canaleta_tipo_mt = trim($_POST['fz_canaleta_tipo_cuzn_mt']);
            $fz_canaleta_tipo_in = trim($_POST['fz_canaleta_tipo_cuzn_in']);
        }
        else if($fz_canaleta_tipo == 'Plástica'){
            $fz_canaleta_tipo_mt = trim($_POST['fz_canaleta_tipo_cho_mt']);
            $fz_canaleta_tipo_in = trim($_POST['fz_canaleta_tipo_cho_in']);
        }
        else{
            $fz_canaleta_tipo = trim($_POST['fz_canaleta_tipo_otro_name']);
            $fz_canaleta_tipo_mt = trim($_POST['fz_canaleta_tipo_otro_mt']);
            $fz_canaleta_tipo_in = trim($_POST['fz_canaleta_tipo_otro_in']);
        }
        $fz_coment_canaleta_tipo = trim(tildeReplace($_POST['fz_tipo_escalerilla_coment']));        
        $fz_comentarios = trim($_POST['fz_final_coment']);
        //I N T E R C O N E X I O N E S  -  F U E R Z A
        $fz_mod;
        $fz_t_id;       $fz_r_id;
        $fz_t_ubalim;   $fz_r_ubalim;
        $fz_t_nuex;     $fz_r_nuex;
        $fz_t_glt;      $fz_r_glt;
        $fz_t_break;    $fz_r_break;
        $fz_t_fusible;  $fz_r_fusible;
        $fz_t_calibre;  $fz_r_calibre;
        $fz_t_fuerza;   $fz_r_fuerza;
        $fz_t_cable;    $fz_r_cable;
        $fz_t_zapata;   $fz_r_zapata;
        $ct6 = 0;
        $numfz = $_POST['tbfz'];
        for($d = 1; $d <= $numfz; $d++){
            $fz_t_id[$ct6] = $_POST['fzt_id'.$d];
            $fz_r_id[$ct6] = $_POST['fzr_id'.$d];
            
            $fz_mod[$ct6] = $_POST['fz_mod'.$d];
            
            $fz_t_ubalim[$ct6] = trim($_POST['fzt_ubal'.$d]);
            $fz_r_ubalim[$ct6] = trim($_POST['fzr_ubal'.$d]);
            
            $fz_t_break[$ct6] = trim($_POST['fzt_break'.$d]);
            $fz_r_break[$ct6] = trim($_POST['fzr_break'.$d]);
            
            $fz_t_fusible[$ct6] = trim($_POST['fzt_capfus'.$d]);
            $fz_r_fusible[$ct6] = trim($_POST['fzr_capfus'.$d]);
            
            $fz_t_calibre[$ct6] = trim($_POST['fzt_calibre'.$d]);
            $fz_r_calibre[$ct6] = trim($_POST['fzr_calibre'.$d]);
            
            $fz_t_fuerza[$ct6] = trim($_POST['fzt_lcbl'.$d]);
            $fz_r_fuerza[$ct6] = trim($_POST['fzr_lcbl'.$d]);
            
            $fz_t_cable[$ct6] = trim($_POST['fzt_cntcb'.$d]);
            $fz_r_cable[$ct6] = trim($_POST['fzr_cntcb'.$d]);
            
            $fz_t_zapata[$ct6] = trim($_POST['fzt_tzapt'.$d]);
            $fz_r_zapata[$ct6] = trim($_POST['fzr_tzapt'.$d]);
            
            $fz_t_nuex[$ct6] = trim($_POST['fzt_nuex'.$d]);
            $fz_r_nuex[$ct6] = trim($_POST['fzr_nuex'.$d]);
            
            $ct6++;
        }
        
/*------------------------------------------------------------------
 * RECUPERAR COMENTARIOS DE PLANOS
 -------------------------------------------------------------------*/
        $pl_comentarios = trim($_POST['pl_final_coment']);
/*------------------------------------------------------------------
 * GUARDADO DE DATOS
 -------------------------------------------------------------------*/
        //GUARDAR UBICACION
        //ubequipos($ubicacion_x_equipo,$folio,$nuevoExistente);
        //GUARDAR DATOS ESTADO DE SITIO
        estadositio(
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
                );
        
            //  COMIENZA GUARDADO DE TABLA DE CANALETAS
                for($w = 2; $w < 8; $w++){
                    $arr = recuperarCanaleta($w);
                    guardarCanaleta($folio,$w,$arr);
                }
            //  FINALIZA GUARDADO DE TABLA DE CANALETAS
            //1 = ALTO ORDEN    0 = BAJO ORDEN
            interconexionesABFO($folio,1,$hiddenafo,$afo_id,$afo_mdl,$afo_ub,$afo_dfo,$afo_cox,$afo_psrem,$afo_fibra,$afo_condfo,$afo_bloquedfo,$afo_ljuno,$afo_ljdos);
            interconexionesABFO($folio,0,$hiddenbfo,$bfo_id,$bfo_mdl,$bfo_ub,$bfo_dfo,$bfo_cox,$bfo_psrem,$bfo_fibra,$bfo_condfo,$bfo_bloquedfo,$bfo_ljuno,$bfo_ljdos);
            interconexionesMP($folio,$hiddenmp,$mp_id,$mp_mod,$mp_vtc,$mp_nvl,$mp_tptab,$mp_lcabl);
            interconexionesCX($folio,$hiddencx,$cx_id,$cx_mod,$cx_ub,$cx_ptab,$cx_lado,$cx_pcont,$cx_tcon,$cx_tcx,$cx_txrx,$cx_lcabl);
            //0 = GESTIÓN   1 = SINCRONÍA
            interconexionesGS($folio,0,$hiddengs,$g_mod,$g_ubRCDT,$g_nswitch,$g_puerto,$g_catcable,$g_lcable,$g_tcon);
            interconexionesGS($folio,1,$hiddensc,$s_mod,$s_ubRCDT,$s_nswitch,$s_puerto,$s_catcable,$s_lcable,$s_tcon);
            //0 = TRABAJO   1 = RESPALDO
            interconexionesFZ($folio,0,$numfz,$fz_t_id, $fz_mod, $fz_t_ubalim, $fz_t_break, $fz_t_fusible, $fz_t_calibre, $fz_t_fuerza, $fz_t_cable, $fz_t_zapata, $fz_t_nuex);
            interconexionesFZ($folio,1,$numfz,$fz_r_id, $fz_mod, $fz_r_ubalim, $fz_r_break, $fz_r_fusible, $fz_r_calibre, $fz_r_fuerza, $fz_r_cable, $fz_r_zapata, $fz_r_nuex);
            $fecha_ejecucion = $_POST['fecha_ejecucion'];
            execute($folio,$fecha_ejecucion);
            if($flag == 0){
                header ("Location:formato.php?folio=".$folio);
            }
            else{
                correoss($folio,'N');
                $ob = new Observaciones($folio,3,$usr);
                header ("Location: grid_surveys.php");
                //echo 'Enviado a validaci&oacute;n';
            }
            