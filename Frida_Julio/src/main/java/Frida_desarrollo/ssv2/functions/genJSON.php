<?php
header('Content-type: application/json');
include 'tildeReplace.php';
require 'conexion.php';
function genJSON($folio){
//    $json = 'hola';
//    $json = '{"estadoGeneral":{';
    $json = array();
    $estadoGeneral = array();
    $opticoAltoOrden = array();
    $opticoBajoOrden = array();
    $multipar = array();
    $coaxial = array();
    $gestionSincronia = array();
    $fuerza = array();
    $planos = array();
    $foal;$folg;$fotcanm;$fotcani;
    
    
    $app_mp_disgral = mysql_query("select count(mp.id) q from zinter_mp mp,zss_equipos eq where mp.folio='".$folio."' and mp.folio=eq.folio and eq.tipo_trabajo='Repisa Nueva' and mp.id_equipo=eq.id");
    $app_mp_disgral = mysql_fetch_array($app_mp_disgral,MYSQL_BOTH);
    $app_mp_disgral = $app_mp_disgral[0];
    $query = "SELECT * FROM zsite_survey WHERE folio = '".$folio."';";
    $resultset = mysql_query($query);
    $nmb = mysql_num_rows($resultset);
    if($nmb > 0){
        for($i = 0; $i < $nmb; $i++){
            $data = mysql_fetch_array($resultset);
            $estadoGeneral['tipo_trabajo'] = $data['eg_tipotrabajo'];
            $estadoGeneral['eg_tt_coment'] = tildeDecode($data['eg_coment_tipotrabajo']);
            //TIPO DE CENTRAL
            if($data['eg_tipocentral']!='Gabinete Outdoor'&&$data['eg_tipocentral']!='Contenedor'&&$data['eg_tipocentral']!='Central'&&$data['eg_tipocentral']!='Concentrador'&&$data['eg_tipocentral']!='Repetidor'&&$data['eg_tipocentral']!=''){
               $data['eg_tipocentral'] = 'Otro_'.tildeDecode($data['eg_tipocentral']); 
            }
            $estadoGeneral['tipo_central'] = $data['eg_tipocentral'];
            $estadoGeneral['eg_tc_coment'] = tildeDecode($data['eg_coment_tipocentral']);
            //ESPACIO
//            if($data['eg_espacio']!='Nuevo'&&$data['eg_espacio']!='Existente'&&$data['eg_espacio']!='Requiere Desmontaje'){
//                $data['eg_espacio'] = 'Otro_'.$data['eg_espacio'];
//            }
//            $estadoGeneral['espacio'] = $data['eg_espacio'];
//            $estadoGeneral['eg_es_coment'] = $data['eg_coment_espacio'];
            //TIPO DE PISO EN EL SITIO
            if($data['eg_tipodepiso']!='Piso Firme'&&$data['eg_tipodepiso']!='Piso Falso'&&$data['eg_tipodepiso']!='Plataforma'&&$data['eg_tipodepiso']!=''){
               $data['eg_tipodepiso'] = 'Otro_' .tildeDecode($data['eg_tipodepiso']);
            }
            $estadoGeneral['tipo_piso'] = $data['eg_tipodepiso'];
            $estadoGeneral['eg_tp_coment'] = tildeDecode($data['eg_coment_tipodepiso']);
            //OBRA CIVIL
            if($data['eg_obracivil']!='Sala Nueva'&&$data['eg_obracivil']!='Fila Nueva'&&$data['eg_obracivil']!='Requiere Pasa Muros'&&$data['eg_obracivil']!='Entre Piso'&&$data['eg_obracivil']!='Ninguna'&&$data['eg_obracivil']!=''){
               $data['eg_obracivil'] = 'Otro_'.tildeDecode($data['eg_obracivil']); 
            }
            $estadoGeneral['obra_civil'] = $data['eg_obracivil'];
            $estadoGeneral['eg_oc_coment'] = tildeDecode($data['eg_coment_obracivil']);
            //TIPO DE MANIOBRA
            if($data['eg_tipomaniobra']!='Polipasto'&&$data['eg_tipomaniobra']!='Poleas y lazos'&&$data['eg_tipomaniobra']!='Maniobra simple'){
               $data['eg_tipomaniobra'] = 'Otro_'.tildeDecode($data['eg_tipomaniobra']); 
            }
            $estadoGeneral['tipo_maniobra'] = $data['eg_tipomaniobra'];
            $estadoGeneral['eg_tm_coment'] = tildeDecode($data['eg_coment_tipomaniobra']);
            $estadoGeneral['eg_coment_can'] = tildeDecode($data['eg_coment_can']);
/*-----------------------------
O P T I C O  A L T O  O R D E N
 ------------------------------*/
            $opticoAltoOrden['fo_bastidor_fibra'] = $data['afo_bastidor_fibra'];
            $opticoAltoOrden['fo_bastidor_fibra_espacio'] = $data['afo_bastidor_fibra_espacio'];
            if($data['afo_tipo_bastidor_fibra']!='Tradicional'&&$data['afo_tipo_bastidor_fibra']!='Alta Densidad'&&$data['afo_tipo_bastidor_fibra']!='Mini DFO'&&$data['afo_tipo_bastidor_fibra']!=''){
               $data['afo_tipo_bastidor_fibra'] = 'Otro_'.tildeDecode($data['afo_tipo_bastidor_fibra']); 
            }
            $opticoAltoOrden['fo_tipo_bastidor_fibra'] = $data['afo_tipo_bastidor_fibra'];
            $opticoAltoOrden['fo_bastidor_marca'] = $data['afo_bastidor_marca'];
            $opticoAltoOrden['fo_bloque_dfo'] = $data['afo_bloque_dfo'];
//            $opticoAltoOrden['fo_canaleta'] = $data['afo_canaleta'];
//            if($data['afo_canaleta']=='Existente'){
//                $foal = '-foex';
//                $folg = '-foexl';
//            }
//            else{
//                $foal = '-fonu';
//                $folg = '-fonul';
//            }
//            $opticoAltoOrden[$foal] = $data['afo_canaleta_altura'];
//            $opticoAltoOrden[$folg] = $data['afo_canaleta_longitud'];
//            $opticoAltoOrden['fo_canaleta_coment'] = $data['afo_coment_canaleta'];
//            if($data['afo_canaleta_tipo']!='Aluminio'&&$data['afo_canaleta_tipo']!='Acero'&&$data['afo_canaleta_tipo']!='Charola'&&$data['afo_canaleta_tipo']!='Plástica'){
//                $data['afo_canaleta_tipo'] = 'Otro_'.$data['afo_canaleta_tipo'];
//            }
//            $opticoAltoOrden['fo_canaleta_tipo'] = $data['afo_canaleta_tipo'];
//            switch($data['afo_canaleta_tipo']){
//                case 'Aluminio':
//                    $fotcanm = '-fo_canaleta_tipo_al_mt';
//                    $fotcani = '-fo_canaleta_tipo_al_in';
//                break;
//                case 'Acero':
//                    $fotcanm = '-fo_canaleta_tipo_fec_mt';
//                    $fotcani = '-fo_canaleta_tipo_fec_in';
//                break;
//                case 'Charola':
//                    $fotcanm = '-fo_canaleta_tipo_cuzn_mt';
//                    $fotcani = '-fo_canaleta_tipo_cuzn_in';
//                break;
//                case 'Plástica':
//                    $fotcanm = '-fo_canaleta_tipo_cho_mt';
//                    $fotcani = '-fo_canaleta_tipo_cho_in';
//                break;
//                default:
//                    $fotcanm = '-fo_canaleta_tipo_otro_mt';
//                    $fotcani = '-fo_canaleta_tipo_otro_in';
//                break;
//            }
//            $opticoAltoOrden[$fotcanm] = $data['afo_canaleta_tipo_mt'];
//            $opticoAltoOrden[$fotcani] = $data['afo_canaleta_tipo_in'];
//            $opticoAltoOrden['fo_tipo_canaleta_coment'] = $data['afo_coment_canaleta_tipo'];
            $opticoAltoOrden['fo_final_coment'] = tildeDecode($data['afo_comentarios']);
/*-----------------------------
O P T I C O  B A J O  O R D E N
 ------------------------------*/
            $opticoBajoOrden['dwfo_bastidor_fibra'] = $data['bfo_bastidor_fibra'];
            $opticoBajoOrden['dwfo_bastidor_fibra_espacio'] = $data['bfo_bastidor_fibra_espacio'];
            if($data['bfo_tipo_bastidor_fibra'] != 'Tradicional' && $data['bfo_tipo_bastidor_fibra'] != 'Alta Densidad' && $data['bfo_tipo_bastidor_fibra']!='Mini DFO' && $data['bfo_tipo_bastidor_fibra']!=''){
               $data['bfo_tipo_bastidor_fibra'] = 'Otro_'.tildeDecode($data['bfo_tipo_bastidor_fibra']); 
            }
            $opticoBajoOrden['dwfo_tipo_bastidor_fibra'] = $data['bfo_tipo_bastidor_fibra'];
            $opticoBajoOrden['dwfo_bastidor_marca'] = $data['bfo_bastidor_marca'];
            $opticoBajoOrden['dwfo_bloque_dfo'] = $data['bfo_bloque_dfo'];
//            $opticoBajoOrden['do_canaleta'] = $data['bfo_canaleta'];
//            if($data['do_canaleta']=='Existente'){
//                $foal = '-doex';
//                $folg = '-doexl';
//            }
//            else{
//                $foal = '-donu';
//                $folg = '-donul';
//            }
//            $opticoBajoOrden[$foal] = $data['bfo_canaleta_altura'];
//            $opticoBajoOrden[$folg] = $data['bfo_canaleta_longitud'];
//            $opticoBajoOrden['dwfo_canaleta_coment'] = $data['bfo_coment_canaleta'];
//            if($data['bfo_canaleta_tipo']!='Aluminio'&&$data['bfo_canaleta_tipo']!='Acero'&&$data['bfo_canaleta_tipo']!='Charola'&&$data['bfo_canaleta_tipo']!='Plástica'&&$data['bfo_canaleta_tipo']!=''){
//                $data['bfo_canaleta_tipo'] = 'Otro_'.$data['bfo_canaleta_tipo'];
//            }
//            $opticoBajoOrden['do_canaleta_tipo'] = $data['bfo_canaleta_tipo'];
//            switch($data['bfo_canaleta_tipo']){
//                case 'Aluminio':
//                    $fotcanm = '-do_canaleta_tipo_al_mt';
//                    $fotcani = '-do_canaleta_tipo_al_in';
//                break;
//                case 'Acero':
//                    $fotcanm = '-do_canaleta_tipo_fec_mt';
//                    $fotcani = '-do_canaleta_tipo_fec_in';
//                break;
//                case 'Charola':
//                    $fotcanm = '-do_canaleta_tipo_cuzn_mt';
//                    $fotcani = '-do_canaleta_tipo_cuzn_in';
//                break;
//                case 'Plástica':
//                    $fotcanm = '-do_canaleta_tipo_cho_mt';
//                    $fotcani = '-do_canaleta_tipo_cho_in';
//                break;
//                default:
//                    $fotcanm = '-do_canaleta_tipo_otro_mt';
//                    $fotcani = '-do_canaleta_tipo_otro_in';
//                break;
//            }
//            $opticoBajoOrden[$fotcanm] = $data['bfo_canaleta_tipo_mt'];
//            $opticoBajoOrden[$fotcani] = $data['bfo_canaleta_tipo_in'];
//            $opticoBajoOrden['dwfo_tipo_canaleta_coment'] = $data['bfo_coment_canaleta_tipo'];
            $opticoBajoOrden['dwfo_final_coment'] = $data['bfo_comentarios'];
/*----------------
M U L T I P A R
 ----------------*/
            $multipar['mp_dgral'] = $data['mp_dgral'];
            $multipar['mp_ampvertical'] = $data['mp_ampvertical'];
            $multipar['mp_spadisp'] = $data['mp_spadisp'];
            if($app_mp_disgral > 0){
                if($data['mp_disgral']!='7 y 9 un lado versablock'&&$data['mp_disgral']!='9 y 11.5 dos lados versablock'&&$data['mp_disgral']!='5 y 10 niveles portasystem'&&$data['mp_disgral']!=''){
                    $multipar['mp_disgral'] = 'Otro_'.$data['mp_disgral'];
                }
                else{
                    $multipar['mp_disgral'] = $data['mp_disgral'];
                }
            }
//            $multipar['mp_canaleta'] = $data['mp_canaleta'];
//            if($data['mp_canaleta']=='Existente'){
//                $foal = '-mpex';
//                $folg = '-mpexl';
//            }
//            else{
//                $foal = '-mpnu';
//                $folg = '-mpnul';
//            }
//            $multipar[$foal] = $data['mp_canaleta_altura'];
//            $multipar[$folg] = $data['mp_canaleta_longitud'];
//            $multipar['mp_canaleta_coment'] = $data['mp_canaleta_coment'];
//            if($data['mp_canaleta_tipo']!='Aluminio'&&$data['mp_canaleta_tipo']!='Acero'&&$data['mp_canaleta_tipo']!='Charola'&&$data['mp_canaleta_tipo']!='Plástica'){
//                $data['mp_canaleta_tipo'] = 'Otro_'.$data['mp_canaleta_tipo'];
//            }
//            $multipar['mp_canaleta_tipo'] = $data['mp_canaleta_tipo'];
//            switch($data['mp_canaleta_tipo']){
//                case 'Aluminio':
//                    $fotcanm = '-mp_canaleta_tipo_al_mt';
//                    $fotcani = '-mp_canaleta_tipo_al_in';
//                break;
//                case 'Acero':
//                    $fotcanm = '-mp_canaleta_tipo_fec_mt';
//                    $fotcani = '-mp_canaleta_tipo_fec_in';
//                break;
//                case 'Charola':
//                    $fotcanm = '-mp_canaleta_tipo_cuzn_mt';
//                    $fotcani = '-mp_canaleta_tipo_cuzn_in';
//                break;
//                case 'Plástica':
//                    $fotcanm = '-mp_canaleta_tipo_cho_mt';
//                    $fotcani = '-mp_canaleta_tipo_cho_in';
//                break;
//                default:
//                    $fotcanm = '-mp_canaleta_tipo_otro_mt';
//                    $fotcani = '-mp_canaleta_tipo_otro_in';
//                break;
//            }
//            $multipar[$fotcanm] = $data['mp_canaleta_tipo_mt'];
//            $multipar[$fotcani] = $data['mp_canaleta_tipo_in'];
//            $multipar['mp_tipo_canaleta_coment'] = $data['mp_coment_canaleta_tipo'];
            $multipar['mp_final_coment'] = tildeDecode($data['mp_comentarios']);
/*----------------
C O A X I A L
 ----------------*/
            $coaxial['cx_escalerilla_bdtd'] = $data['cx_escalerilla_bdtd'];
            $coaxial['cx_escalerilla_bdtd_espacio'] = $data['cx_escalerilla_bdtd_espacio'];
            if($data['cx_tipo_escalerilla_bdtd']!='Tradicional'&&$data['cx_tipo_escalerilla_bdtd']!='Alta Densidad'&&$data['cx_tipo_escalerilla_bdtd']!='Mini DFO'&&$data['cx_tipo_escalerilla_bdtd']!=''){
                $multipar['cx_tipo_escalerilla_bdtd'] = 'Otro_'.tildeDecode($data['cx_tipo_escalerilla_bdtd']);
            }
            else{
                $multipar['cx_tipo_escalerilla_bdtd'] = $data['cx_tipo_escalerilla_bdtd'];
            }
//            $coaxial['cx_canaleta'] = $data['cx_canaleta'];
//            if($data['cx_canaleta']=='Existente'){
//                $foal = '-cxex';
//                $folg = '-cxexl';
//            }
//            else{
//                $foal = '-cxnu';
//                $folg = '-cxnul';
//            }
//            $coaxial[$foal] = $data['cx_canaleta_altura'];
//            $coaxial[$folg] = $data['cx_canaleta_longitud'];
//            $coaxial['cx_escalerilla_coment'] = $data['cx_escalerilla_coment'];
//            $coaxial['cx_canaleta_tipo'] = $data['cx_canaleta_tipo'];
//            switch($data['cx_canaleta_tipo']){
//                case 'Aluminio':
//                    $fotcanm = '-cx_canaleta_tipo_al_mt';
//                    $fotcani = '-cx_canaleta_tipo_al_in';
//                break;
//                case 'Acero':
//                    $fotcanm = '-cx_canaleta_tipo_fec_mt';
//                    $fotcani = '-cx_canaleta_tipo_fec_in';
//                break;
//                case 'Charola':
//                    $fotcanm = '-cx_canaleta_tipo_cuzn_mt';
//                    $fotcani = '-cx_canaleta_tipo_cuzn_in';
//                break;
//                case 'Plástica':
//                    $fotcanm = '-cx_canaleta_tipo_cho_mt';
//                    $fotcani = '-cx_canaleta_tipo_cho_in';
//                break;
//                default:
//                    $fotcanm = '-cx_canaleta_tipo_otro_mt';
//                    $fotcani = '-cx_canaleta_tipo_otro_in';
//                break;
//            }
//            $coaxial[$fotcanm] = $data['cx_canaleta_tipo_mt'];
//            $coaxial[$fotcani] = $data['cx_canaleta_tipo_in'];
//            $coaxial['cx_tipo_escalerilla_coment'] = $data['cx_coment_canaleta_tipo'];
            $coaxial['cx_final_coment'] = tildeDecode($data['cx_comentarios']);
/*----------------------------------
G E S T I Ó N  Y  S I N C R O N Í A
 -----------------------------------*/
            $gestionSincronia['gs_reqgstion'] = $data['gs_requieregestion'];
            $gestionSincronia['gs_tipogstion'] = $data['gs_tipogestion'];
            $gestionSincronia['gs_rctd'] = $data['gs_puertoRCDT'];
            $gestionSincronia['gs_reqsincronia'] = $data['gs_requieresincronia'];
            $gestionSincronia['gs_reqalarmas'] = $data['gs_cnaddalarmas'];
            $gestionSincronia['gs_reqctoalim'] = $data['gs_reqctoalim'];
//            $gestionSincronia['gs_canaleta'] = $data['gs_canaleta'];
//            if($data['gs_canaleta']=='Existente'){
//                $foal = '-gsex';
//                $folg = '-gsexl';
//            }
//            else{
//                $foal = '-gsnu';
//                $folg = '-gsnul';
//            }
//            $gestionSincronia[$foal] = $data['gs_canaleta_altura'];
//            $gestionSincronia[$folg] = $data['gs_canaleta_longitud'];
//            $gestionSincronia['gs_canaleta_coment'] = $data['gs_canaleta_coment'];
//            $gestionSincronia['gs_canaleta_tipo'] = $data['gs_canaleta_tipo'];
//            switch($data['cx_canaleta_tipo']){
//                case 'Aluminio':
//                    $fotcanm = '-gs_canaleta_tipo_al_mt';
//                    $fotcani = '-gs_canaleta_tipo_al_in';
//                break;
//                case 'Acero':
//                    $fotcanm = '-gs_canaleta_tipo_fec_mt';
//                    $fotcani = '-gs_canaleta_tipo_fec_in';
//                break;
//                case 'Charola':
//                    $fotcanm = '-gs_canaleta_tipo_cuzn_mt';
//                    $fotcani = '-gs_canaleta_tipo_cuzn_in';
//                break;
//                case 'Plástica':
//                    $fotcanm = '-gs_canaleta_tipo_cho_mt';
//                    $fotcani = '-gs_canaleta_tipo_cho_in';
//                break;
//                default:
//                    $fotcanm = '-gs_canaleta_tipo_otro_mt';
//                    $fotcani = '-gs_canaleta_tipo_otro_in';
//                break;
//            }
//            $gestionSincronia[$fotcanm] = $data['gs_canaleta_tipo_mt'];
//            $gestionSincronia[$fotcani] = $data['gs_canaleta_tipo_in'];
//            $gestionSincronia['gs_tipo_canaleta_coment'] = $data['gs_coment_canaleta_tipo'];
            $gestionSincronia['gs_final_coment'] = tildeDecode($data['gs_comentarios']);
/*-------------------------------------
A L I M E N T A C I Ó N  Y F U E R Z A
 --------------------------------------*/
            if($data['fz_tp_alimen']!='Planta'&&$data['fz_tp_alimen']!='Distribuidor de Fuerza (GLT)'&&$data['fz_tp_alimen']!='Remoto en Bastidor'&&$data['fz_tp_alimen']!=''){
                $fuerza['fz_tp_alimen'] = 'Otro_'.tildeDecode($data['fz_tp_alimen']);
            }
            else{
                $fuerza['fz_tp_alimen'] = $data['fz_tp_alimen'];
            }
            $fuerza['-fz_configplanta'] = $data['fz_configplanta'];
            $fuerza['-fz_longcabletierra'] = $data['fz_longcabletierra'];
            $fuerza['fz_cact'] = $data['fz_consumo'];
            if($data['fz_escalerilla_bdtd']!='Tierra general de piso'&&$data['fz_escalerilla_bdtd']!='Tierra general de sala'&&$data['fz_escalerilla_bdtd']!='Tierra de fila'&&$data['fz_escalerilla_bdtd']!='Tierra en repisa'&&$data['fz_escalerilla_bdtd']!=''){
                $fuerza['fz_escalerilla_bdtd'] = 'Otro_'.tildeDecode($data['fz_escalerilla_bdtd']);
            }
            else{
                $fuerza['fz_escalerilla_bdtd'] = $data['fz_escalerilla_bdtd'];
            }
            $fuerza['cl_reqnucl'] = $data['fz_cl_reqnucl'];
//            $fuerza['fz_canaleta'] = $data['fz_canaleta'];
//            if($data['fz_canaleta']=='Existente'){
//                $foal = '-fzex';
//                $folg = '-fzexl';
//            }
//            else{
//                $foal = '-fznu';
//                $folg = '-fznul';
//            }
//            $fuerza[$foal] = $data['fz_canaleta_altura'];
//            $fuerza[$folg] = $data['fz_canaleta_longitud'];
//            $fuerza['fz_escalerilla_coment'] = $data['fz_escalerilla_coment'];
//            $fuerza['fz_canaleta_tipo'] = $data['fz_canaleta_tipo'];
//            switch($data['fz_canaleta_tipo']){
//                case 'Aluminio':
//                    $fotcanm = '-fz_canaleta_tipo_al_mt';
//                    $fotcani = '-fz_canaleta_tipo_al_in';
//                break;
//                case 'Acero':
//                    $fotcanm = '-fz_canaleta_tipo_fec_mt';
//                    $fotcani = '-fz_canaleta_tipo_fec_in';
//                break;
//                case 'Charola':
//                    $fotcanm = '-fz_canaleta_tipo_cuzn_mt';
//                    $fotcani = '-fz_canaleta_tipo_cuzn_in';
//                break;
//                case 'Plástica':
//                    $fotcanm = '-fz_canaleta_tipo_cho_mt';
//                    $fotcani = '-fz_canaleta_tipo_cho_in';
//                break;
//                default:
//                    $fotcanm = '-fz_canaleta_tipo_otro_mt';
//                    $fotcani = '-fz_canaleta_tipo_otro_in';
//                break;
//            }
//            $fuerza[$fotcanm] = $data['fz_canaleta_tipo_mt'];
//            $fuerza[$fotcani] = $data['fz_canaleta_tipo_in'];
//            $fuerza['fz_tipo_escalerilla_coment'] = $data['fz_coment_canaleta_tipo'];
            $fuerza['fz_final_coment'] = tildeDecode($data['fz_comentarios']);
/*-----------
P L A N O S
 ------------*/
            $planos['pl_final_coment'] = tildeDecode($data['pl_comentarios']);
        }
    }
    $json['estadoGeneral'] = $estadoGeneral;
    $json['opticoAltoOrden'] = $opticoAltoOrden;
    $json['opticoBajoOrden'] = $opticoBajoOrden;
    $json['multipar'] = $multipar;
    $json['coaxial'] = $coaxial;
    $json['gestionSincronia'] = $gestionSincronia;
    $json['fuerza'] = $fuerza;
    $json['planos'] = $planos;
    $json = json_encode($json);
    //$estadoGeneral = json_encode($estadoGeneral);
    return $json;
}
//$folio = $_GET['f'];
$folio = $_POST['folio'];
echo genJSON($folio);
?>
