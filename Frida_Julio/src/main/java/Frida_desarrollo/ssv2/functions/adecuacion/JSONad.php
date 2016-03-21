<?php
header('Content-type: application/json');
function JSONad($folio){
    require '../conexion.php';
    $json = array();
    $estadoGeneral = array();
    $infraestructura = array();
    $inters = array();
    $planos = array();
    $total;
    $total2;
    
    $query = "SELECT 
    eg_tipotrabajo, eg_coment_tipotrabajo,
    eg_tipocentral, eg_coment_tipocentral,
    eg_espacio, eg_coment_espacio,
    eg_tipodepiso, eg_coment_tipodepiso,
    eg_obracivil, eg_coment_obracivil,
    ad_justificacion, ad_alimentacion_comentarios,
    ad_bdtd_comentarios, ad_cableado_comentarios,
    ad_canaletasEscalerillas_comentarios,ad_dfo_comentarios,
    ad_dg_comentarios, ad_etiquetado_comentarios,
    ad_instalacionDesmontaje_comentarios,ad_obraCivil_comentarios,
    ad_rda_comentarios,ad_tierra_comentarios,
    ad_otrosMateriales_comentarios,pl_comentarios
    FROM zsite_survey WHERE folio = '".$folio."';";
    
    $result = mysql_query($query,$conectar2);
    $num = mysql_num_rows($result);
    if($num > 0){
        for($i = 0; $i < $num; $i++){
            $data = mysql_fetch_array($result);
            //TIPO DE TRABAJO
            $estadoGeneral['tipo_trabajo'] = $data['eg_tipotrabajo'];
            $estadoGeneral['eg_tt_coment'] = $data['eg_coment_tipotrabajo'];
            //TIPO DE CENTRAL
            if($data['eg_tipocentral'] != 'Gabinete Outdoor' && $data['eg_tipocentral'] != 'Contenedor' && $data['eg_tipocentral'] != 'Central' && $data['eg_tipocentral'] != 'Concentrador' && $data['eg_tipocentral'] != 'Repetidor' && $data['eg_tipocentral'] != ''){
                $estadoGeneral['tipo_central'] = 'Otro_'.$data['eg_tipocentral'];
            }
            else{
                $estadoGeneral['tipo_central'] = $data['eg_tipocentral'];
            }
            $estadoGeneral['eg_tc_coment'] = $data['eg_coment_tipocentral'];
            //ESPACIO
            if($data['eg_espacio'] != 'Nuevo' && $data['eg_espacio'] != 'Existente' && $data['eg_espacio'] != 'Requiere Desmontaje' && $data['eg_espacio'] != ''){
                $estadoGeneral['espacio'] = 'Otro_'.$data['eg_espacio'];
            }
            else{
                $estadoGeneral['espacio'] = $data['eg_espacio'];
            }
            $estadoGeneral['eg_es_coment'] = $data['eg_coment_espacio'];
            //TIPO DE PISO EN EL SITIO
            if($data['eg_tipodepiso'] != 'Piso Firme' && $data['eg_tipodepiso'] != 'Piso Falso' && $data['eg_tipodepiso'] != 'Plataforma' && $data['eg_tipodepiso'] != ''){
                $estadoGeneral['tipo_piso'] = 'Otro_'.$data['eg_tipodepiso'];
            }
            else{
                $estadoGeneral['tipo_piso'] = $data['eg_tipodepiso'];
            }
            $estadoGeneral['eg_tp_coment'] = $data['eg_coment_tipodepiso'];
            //OBRA CIVIL
            if($data['eg_obracivil'] != 'Sala Nueva' && $data['eg_obracivil'] != 'Fila Nueva' && $data['eg_obracivil'] != 'Requiere Pasa Muros' && $data['eg_obracivil'] != 'Entre Piso' && $data['eg_obracivil'] != 'Ninguna' && $data['eg_obracivil'] != ''){
                $estadoGeneral['obra_civil'] = 'Otro_'.$data['eg_obracivil'];
            }
            else{
                $estadoGeneral['obra_civil'] = $data['eg_obracivil'];
            }
            $estadoGeneral['eg_oc_coment'] = $data['eg_coment_obracivil'];
            /*------------------------------------------
             C O M E N T A R I O S   C A T E G O R I A S
             ------------------------------------------*/
            $infraestructura['justificacion_coment'] = $data['ad_justificacion'];
            $infraestructura['infAlim_coment'] = $data['ad_alimentacion_comentarios'];
            $infraestructura['infBDTD_coment'] = $data['ad_bdtd_comentarios'];
            $infraestructura['infCable_coment'] = $data['ad_cableado_comentarios'];
            $infraestructura['infCA_coment'] = $data['ad_canaletasEscalerillas_comentarios'];
            $infraestructura['infDFO_coment'] = $data['ad_dfo_comentarios'];
            $infraestructura['infDG_coment'] = $data['ad_dg_comentarios'];
            $infraestructura['infEQ_coment'] = $data['ad_etiquetado_comentarios'];
            $infraestructura['infID_coment'] = $data['ad_instalacionDesmontaje_comentarios'];
            $infraestructura['infOC_coment'] = $data['ad_obraCivil_comentarios'];
            $infraestructura['infRDA_coment'] = $data['ad_rda_comentarios'];
            $infraestructura['infTR_coment'] = $data['ad_tierra_comentarios'];
            $infraestructura['infOTS_coment'] = $data['ad_otrosMateriales_comentarios'];
            /*-----------
            P L A N O S
            ------------*/
            $planos['final_coment'] = $data['pl_comentarios'];
            /*--------------------------------------------
             C O M I E N Z A   I N T E R   B D T D   E   I N T E R   B D F O
             ---------------------------------------------*/
            
            //CONSULTAR SI LOS DATOS EXISTEN EN LAS TABLAS BDTD
            $query = "SELECT * FROM zinter_bdtd WHERE folio = '".$folio."';";
            $salida = mysql_query($query, $conectar2);
            $total = mysql_num_rows($salida);
            if($total > 0){
                for($i = 0; $i < $total; $i++){
                    $datos = mysql_fetch_array($salida);
                    $datos['punta'] = strtolower($datos['punta']);
                    $inters['_'.$datos['punta'].'ubdt'] = $datos['ubicacion_bdtd'];
                    $inters['_'.$datos['punta'].'ptbl'] = $datos['posicion_tablilla'];
                    $inters['_'.$datos['punta'].'lado'] = $datos['lado'];
                    $inters['_'.$datos['punta'].'pcnt'] = $datos['posicion_contacto'];
                    $inters['_'.$datos['punta'].'tcon'] = $datos['tipo_conector'];
                    $inters['_'.$datos['punta'].'tcbl'] = $datos['tipo_cable'];
                    $inters['_'.$datos['punta'].'lcbl'] = $datos['longitud_cable'];
                }
            }
            
            //CONSULTAR SI LOS DATOS EXISTEN EN LAS TABLAS BDFO
            $query2 = "SELECT * FROM zinter_bdfo WHERE folio = '".$folio."';";
            $salida2 = mysql_query($query2, $conectar2);
            $total2 = mysql_num_rows($salida2);
            if($total2 > 0){
                for($j = 0; $j < $total2; $j++){
                    $datos = mysql_fetch_array($salida2);
                    $datos['punta'] = strtolower($datos['punta']);
                    $inters['_'.$datos['punta'].'bdfo'] = $datos['ubicacion_bdfo'];
                    $inters['_'.$datos['punta'].'_dfo'] = $datos['dfo'];
                    $inters['_'.$datos['punta'].'prmt'] = $datos['posicion_remate'];
                    $inters['_'.$datos['punta'].'tcoe'] = $datos['tipo_conector_equipo'];
                    $inters['_'.$datos['punta'].'tfbr'] = $datos['tipo_fibra'];
                    $inters['_'.$datos['punta'].'cfbr'] = $datos['cantidad_fibra'];
                    $inters['_'.$datos['punta'].'tcld'] = $datos['tipo_conector_lado_dfo'];
                    $inters['_'.$datos['punta'].'locl'] = $datos['longitud_cable'];
                }
            }
            /*--------------------------------------------------------------
             F I N A L I Z A   I N T E R   B D T D   E   I N T E R   B D F O
             ---------------------------------------------------------------*/            
        }
        $json['estadoGeneral'] = $estadoGeneral;
        $json['infraestructura'] = $infraestructura;
        $json['inters'] = $inters;
        $json['planos'] = $planos;
        $json = json_encode($json);
        return $json;
    }
}
echo JSONad('SS4520130805001');
?>
