<?php
    require 'functions/adecuacion/saveas.php';
    require 'functions/saver.php';
    require 'functions/guarda.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Datos Guardados Exitosamente</title>
    </head>
    <body>
        <?php
            $folio = $_POST['folio'];
            $flag = $_POST['flag'];
            $copias = $_POST['copias'];
            $emails = array();
            $enombres = array();
            $conta2 = 0;
            for($i = 1; $i <= $copias; $i++){
                if(isset($_POST['enombre'.$i])){
                    $enombres[$conta2] = trim($_POST['enombre'.$i]);
                    $emails[$conta2] = trim($_POST['ecorreo'.$i]);
                    $conta2++;
                }
            }
            mascorreos($folio, $emails, $enombres);
            /*-------------------------------
             DATOS DE ESTADO GENERAL DE SITIO
             --------------------------------*/
            $eg_tipotrabajo = trim($_POST['tipo_trabajo']);
            if($eg_tipotrabajo != 'Nuevo'){
                $eg_tipotrabajo = 'Ampliacion';
            }
            $eg_coment_tipotrabajo = trim($_POST['eg_tt_comt']);

            $eg_tipocentral = trim($_POST['tipo_central']);
            if($eg_tipocentral == 'Otro'){
                $eg_tipocentral = trim($_POST['9tceo']);
            }
            $eg_coment_tipocentral = trim($_POST['eg_tc_comt']);

            $eg_espacio = trim($_POST['espacio']);
            if($eg_espacio == 'Otro'){
                $eg_espacio = trim($_POST['9espo']);
            }
            $eg_coment_espacio = trim($_POST['eg_es_comt']);

            $eg_tipodepiso = trim($_POST['tipo_piso']);
            if($eg_tipodepiso == 'Otro'){
                $eg_tipodepiso = trim($_POST['9tpso']);
            }
            $eg_coment_tipodepiso = trim($_POST['eg_tp_comt']);

            $eg_obracivil = trim($_POST['obra_civil']);
            if($eg_obracivil == 'Otro'){
                $eg_obracivil = trim($_POST['9obco']);
            }
            $eg_coment_obracivil = trim($_POST['eg_oc_comt']);
            
            /*------------------------
             COMENTARIOS DE CATEGORIAS
             -------------------------*/
            $ad_justificacion = $_POST['justificacion_coment'];            
            $ad_alimentacion_comentarios = $_POST['infAlim_coment'];
            
            //DATOS DE INTER BDTD
            $a_ubicacion_bdtd = trim($_POST['aubdt']);
            $a_posicion_tablilla = trim($_POST['aptbl']);
            $a_lado = trim($_POST['alado']);
            $a_posicion_contacto = trim($_POST['apcnt']);
            $a_tipo_conector = trim($_POST['atcon']);
            $a_tipo_cable = trim($_POST['atcbl']);
            $a_longitud_cable = trim($_POST['alcbl']);
            
            $b_ubicacion_bdtd = trim($_POST['bubdt']);
            $b_posicion_tablilla = trim($_POST['bptbl']);
            $b_lado = trim($_POST['blado']);
            $b_posicion_contacto = trim($_POST['bpcnt']);
            $b_tipo_conector = trim($_POST['btcon']);
            $b_tipo_cable = trim($_POST['btcbl']);
            $b_longitud_cable = trim($_POST['blcbl']);
            
            $ad_bdtd_comentarios = $_POST['infBDTD_coment'];            
            $ad_cableado_comentarios = $_POST['infCable_coment'];            
            $ad_canaletasEscalerillas_comentarios = $_POST['infCA_coment'];            
            //DATOS DE INTER BDFO
            $a_ubicacion_bdfo = trim($_POST['abdfo']);
            $a_dfo = trim($_POST['a_dfo']);
            $a_posicion_remate = trim($_POST['aprmt']);
            $a_tipo_conector_equipo = trim($_POST['atcoe']);
            $a_tipo_fibra = trim($_POST['atfbr']);
            $a_cantidad_fibra = trim($_POST['acfbr']);
            $a_tipo_conector_lado_dfo = trim($_POST['atcld']);
            $a_qlongitud_cable = trim($_POST['alocl']);
            
            $b_ubicacion_bdfo = trim($_POST['bbdfo']);
            $b_dfo = trim($_POST['b_dfo']);
            $b_posicion_remate = trim($_POST['bprmt']);
            $b_tipo_conector_equipo = trim($_POST['btcoe']);
            $b_tipo_fibra = trim($_POST['btfbr']);
            $b_cantidad_fibra = trim($_POST['bcfbr']);
            $b_tipo_conector_lado_dfo = trim($_POST['btcld']);
            $b_qlongitud_cable = trim($_POST['blocl']);
            
            $ad_dfo_comentarios = $_POST['infDFO_coment'];            
            $ad_dg_comentarios = $_POST['infDG_coment'];            
            $ad_etiquetado_comentarios = $_POST['infEQ_coment'];            
            $ad_instalacionDesmontaje_comentarios = $_POST['infID_coment'];            
            $ad_obraCivil_comentarios = $_POST['infOC_coment'];            
            $ad_rda_comentarios = $_POST['infRDA_coment'];            
            $ad_tierra_comentarios = $_POST['infTR_coment'];            
            $ad_otrosMateriales_comentarios = $_POST['infOTS_coment'];            
            $pl_comentarios = trim($_POST['pl_final_coment']);
            /*--------------------------------------
             DATOS DE INTER BDTD [PUNTA A Y PUNTA B]
             ---------------------------------------*/            
            interbdtd($folio,'A',$a_ubicacion_bdtd,$a_posicion_tablilla,$a_lado,$a_posicion_contacto,$a_tipo_conector,$a_tipo_cable,$a_longitud_cable);
            interbdtd($folio,'B',$b_ubicacion_bdtd,$b_posicion_tablilla,$b_lado,$b_posicion_contacto,$b_tipo_conector,$b_tipo_cable,$b_longitud_cable);
            
            interdfo($folio,'A',$a_ubicacion_bdfo,$a_dfo,$a_posicion_remate,$a_tipo_conector_equipo,$a_tipo_fibra,$a_cantidad_fibra,$a_tipo_conector_lado_dfo,$a_qlongitud_cable);
            interdfo($folio,'B',$b_ubicacion_bdfo,$b_dfo,$b_posicion_remate,$b_tipo_conector_equipo,$b_tipo_fibra,$b_cantidad_fibra,$b_tipo_conector_lado_dfo,$b_qlongitud_cable);
            
            gardasitesurvey($folio,$eg_tipotrabajo,$eg_coment_tipotrabajo, 
            $eg_tipocentral,$eg_coment_tipocentral,$eg_espacio,$eg_coment_espacio, 
            $eg_tipodepiso,$eg_coment_tipodepiso,$eg_obracivil,$eg_coment_obracivil, 
            $ad_justificacion,$ad_alimentacion_comentarios,$ad_bdtd_comentarios, 
            $ad_cableado_comentarios,$ad_canaletasEscalerillas_comentarios,$ad_dfo_comentarios, 
            $ad_dg_comentarios,$ad_etiquetado_comentarios,$ad_instalacionDesmontaje_comentarios, 
            $ad_obraCivil_comentarios,$ad_rda_comentarios,$ad_tierra_comentarios, 
            $ad_otrosMateriales_comentarios,$pl_comentarios,$flag);
            
            if($flag == 0){
                echo 'Guardado';
            }
            else{
                correoss($folio,'A');
                $fecha_ejecucion = $_POST['fecha_ejecucion'];
                execute($folio, $fecha_ejecucion);
                echo 'Enviado a validaci&oacute;n';
                
            }
        ?>
    </body>
</html>