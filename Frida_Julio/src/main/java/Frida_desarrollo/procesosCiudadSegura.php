<?php
header('Content-type: application/json');require 'conexion.php';session_start();
function autocompletar($cadena){
    $datos = array();
    $query = "select ref_sisa  from interconexiones_ce WHERE ref_sisa like '".$cadena."%' AND ref_sisa !='' 
    AND (tipo_Servicio = 'IDE' OR tipo_Servicio = 'RPV') ORDER BY ref_sisa LIMIT 20";
    $salida = mysql_query($query);
    $total = mysql_num_rows($salida);
    if($total > 0){
        for($i = 0; $i < $total; $i++){
            $data = mysql_fetch_array($salida);
            $datos[$i] = $data['ref_sisa'];
        }
    }
    $datos = json_encode($datos);
    return $datos;
}

function datos($interUninet){
    $datos = array();
    $query = "SELECT clli_equipo,estatus,id_interconexion,clli_equipo,dem.central,
        dem.ubicacion_demarcador,dem.ip_demarcador,dem.ot_instalacion_demarcador,
        dem.tipo_equipo,dem.proveedor,pto_troncal_d,ubicacion_bdfo,
        repisa_bdfo,contacto_bdfo,equipo_destino,no_cambio,pto_troncal_a,
        conector_a,hostname_destino,conexion_rcdt,tunel,switch,pto,velocidad,
        num_cambio,dem.division,dem.estado,dem.ciudad,dem.tipo_demarcador,dem.ref_sisa
        FROM interconexiones_ce inter 
        INNER JOIN inventario_demarcadores dem  on ( dem.clli_adva=clli_equipo)  
        WHERE inter.ref_sisa = '".$interUninet."' 
        AND (tipo_Servicio='IDE' OR tipo_Servicio='RPV')";
    $result = mysql_query($query);
    $dt = mysql_fetch_array($result);
    $datos['estatus'] = array($dt['estatus']);
    
    $datos['equipo'] = array(
        $dt['clli_equipo'],
        $dt['estado'],
        $dt['central'],
        $dt['tipo_demarcador'],
        $dt['ot_instalacion_demarcador'],
        $dt['proveedor'],
        $dt['division'],
        $dt['ciudad'],      
        $dt['ubicacion_demarcador'],
        $dt['ip_demarcador'],
        $dt['tipo_equipo'],
        $dt['ref_sisa']
    );
    $datos['puertoCliente'] = array(
        $dt['pto_troncal_d'],
        "",
        $dt['ubicacion_bdfo'],
        $dt['repisa_bdfo'],
        $dt['contacto_bdfo']
    );
    $datos['interconexion'] = array(
        $dt['id_interconexion'],
        $dt['hostname_destino'],
        $dt['equipo_destino'],
        $dt['pto_troncal_a'],
        $dt['conector_a']
    );
    $datos['rcdt'] = array(
        $dt['conexion_rcdt'],
        $dt['tunel'],
        $dt['switch'],
        $dt['pto'],
        $dt['velocidad'],
        $dt['no_cambio']
    );
    $datos['selectOptions'] = combo($dt['clli_equipo']);
    return json_encode($datos);    
}

function aplicadde($refSisa){
    $ndeCama="select ndeCamara from ciudad_segura where ref_sisa='".$refSisa."'";
    $res = mysql_query($ndeCama);
    $row = mysql_fetch_array($res); 
    $nde=$row['ndeCamara'];
    if($nde!='')        $whereNde=" and inv.tunel='".$nde."'";  
    
    $query = "select estatus_adva,estatus_adva_exp,replace (concat_ws('/',replace( repisat,'N/A','' ),replace( slot,'N/A','' ),puerto),'//','') as  puerto,
    contacto_bdfo,ubicacion_bdfo,repisa_bdfo,pu.id_puerto_fisico,pu.clli_adva,tunel,inv.division,inv.estado,inv.ciudad,inv.central,inv.ubicacion_demarcador,
    inv.tipo_demarcador,inv.ip_demarcador,inv.ot_instalacion_demarcador,inv.tipo_equipo,inv.proveedor,inv.ref_sisa,inv.conexion_rcdt,inv.tunel as tunel_rcdt,
    inv.switch,inv.pto,inv.velocidad,inv.num_cambio from inventario_demarcadores as inv 
    inner join inventario_puertos_demarcadores as pu on pu.clli_adva=inv.clli_adva and pu.nombre_oficial_pisa='".$refSisa."' ".$whereNde;   
    $resultado = mysql_query($query);
    $fl = mysql_fetch_array($resultado);    
    $salida['estatus'] = array(
        $fl['estatus_adva'],
        $fl['estatus_adva_exp']
    );
    $salida['equipo'] = array(
        $fl['clli_adva'],
        $fl['estado'],
        $fl['central'],
        $fl['tipo_demarcador'],
        $fl['ot_instalacion_demarcador'],
        $fl['proveedor'],
        $fl['division'],
        $fl['ciudad'],      
        $fl['ubicacion_demarcador'],
        $fl['ip_demarcador'],
        $fl['tipo_equipo'],
        $fl['ref_sisa']
    );
    $salida['puertoCliente'] = array(
        $fl['puerto'],
        $fl['id_puerto_fisico'],
        $fl['ubicacion_bdfo'],
        $fl['repisa_bdfo'],
        $fl['contacto_bdfo']
    );
    $salida['rcdt'] = array(
        $fl['conexion_rcdt'],
        $fl['tunel_rcdt'],
        $fl['switch'],
        $fl['pto'],
        $fl['velocidad'],
        $fl['num_cambio']
    );
    $salida['selectOptions'] = combo($fl['clli_adva']);
    return json_encode($salida);
}

function combo($aclli){
    $combo = array();
    $query = "SELECT ref_sisa_infra,clli_adva FROM inventario_infra where clli_adva2 = '".$aclli."' 
    AND servicio = 'CD SEGURA' AND tipo_conexion = 'ENLACE INFRA DEM'";
    $result02 = mysql_query($query);
    $mx = mysql_num_rows($result02);
    for($c = 0; $c < $mx; $c++){
        $data = mysql_fetch_array($result02);
        $combo["infra"][] = $data['ref_sisa_infra'];
        $combo["clli"][] = $data['clli_adva'];
    }
    return $combo;
}

function adatos($refSisaInfra,$clliCamara,$clliTrabajo,$clliRespaldo,$tipo){
/*  if($contador == 0){
        $_SESSION['v3'] = null;
        $_SESSION['v4'] = null;
        $_SESSION['v5'] = null;
    }*/ 
    if($refSisaInfra!=''){
        $query = "SELECT
        inf.clli_adva2,inf.clli_adva,nde.estado,nde.central,nde.tipo_demarcador,nde.ot_instalacion_demarcador,
        nde.proveedor,nde.division,nde.ciudad,nde.ubicacion_demarcador,nde.ip_demarcador,nde.tipo_equipo,nde.ref_sisa,
        conexion_rcdt,tunel,switch, pto,velocidad,num_cambio,ref_sisa_infra 
        FROM  inventario_infra inf
        inner join inventario_demarcadores nde on inf.clli_adva=nde.clli_adva where ref_sisa_infra='".$refSisaInfra."'";
    }else{
        if($tipo=="Camara") 
        $query = "SELECT '' clli_adva2,clli_adva,nde.estado,nde.central,nde.tipo_demarcador,nde.ot_instalacion_demarcador,
        nde.proveedor,nde.division,nde.ciudad,nde.ubicacion_demarcador,nde.ip_demarcador,nde.tipo_equipo,nde.ref_sisa,
        conexion_rcdt,tunel,switch, pto,velocidad,num_cambio,'' ref_sisa_infra
        FROM  inventario_demarcadores nde where clli_adva='".$clliCamara."'";
    }
    
    
    $resultset = mysql_query($query);
    $data = mysql_fetch_array($resultset);
    $Nde=$data['clli_adva'];
    $Dde=$data['clli_adva2'];
    
    $salida['equipo'] = array(
        $data['clli_adva'],
        $data['estado'],
        $data['central'],
        $data['tipo_demarcador'],
        $data['ot_instalacion_demarcador'],
        $data['proveedor'],
        $data['division'],
        $data['ciudad'],
        $data['ubicacion_demarcador'],
        $data['ip_demarcador'],
        $data['tipo_equipo'],
        $data['ref_sisa']
    );
    $salida['rcdt'] = array(
        $data['conexion_rcdt'],
        $data['tunel'],
        $data['switch'],
        $data['pto'],
        $data['velocidad'],
        $data['num_cambio']
    );
    
    $queryNDe="select 
    replace (concat_ws('/',replace( repisat,'N/A','' ),replace( slot,'N/A','' ),puerto),'//','')puerto,id_puerto_fisico,ubicacion_bdfo,repisa_bdfo,contacto_bdfo from inventario_puertos_demarcadores 
    where clli_adva='".$Nde."' and ref_sisa_infra='".$refSisaInfra."' order by uso_puerto ";
    
    $res=mysql_query($queryNDe);
    $data = mysql_fetch_array($res);
    
    $salida['ptoCliente'] = array(
        $data['puerto'],
        $data['id_puerto_fisico'],
        str_replace(chr(160),"",$data['ubicacion_bdfo']),
        $data['repisa_bdfo'],
        $data['contacto_bdfo'],
    );
    
    if (mysql_num_rows($res)>1) {
        mysql_data_seek($res, 1);
        $data = mysql_fetch_array($res);
    }else{
        $data=null;
    }
    
    $salida['ptoClienteRespaldo'] = array(
        $data['puerto'],
        $data['ubicacion_bdfo'],
        $data['contacto_bdfo'],
        $data['id_puerto_fisico'],
        $data['repisa_bdfo']
    );
    
    $queryDDe="select 
    replace (concat_ws('/',replace( repisat,'N/A','' ),replace( slot,'N/A','' ),puerto),'//','')puerto,id_puerto_fisico,ubicacion_bdfo,repisa_bdfo,contacto_bdfo from inventario_puertos_demarcadores 
    where clli_adva='".$Dde."' and ref_sisa_infra='".$refSisaInfra."' order by uso_puerto";
    
    $res=mysql_query($queryDDe);
    $data = mysql_fetch_array($res);
    
    $salida['ptoTransporte'] = array(
        $data['puerto'],
        $data['id_puerto_fisico'],
        $data['ubicacion_bdfo'],
        $data['repisa_bdfo'],
        $data['contacto_bdfo']
    );
    
    if (mysql_num_rows($res)>1) {
        mysql_data_seek($res, 1);
        $data = mysql_fetch_array($res);
    }else{
        $data=null;
    }
    
    $salida['ptoTransporteRespaldo'] = array(
        $data['puerto'],
        $data['ubicacion_bdfo'],
        $data['contacto_bdfo'],
        $data['id_puerto_fisico'],
        $data['repisa_bdfo']
    );    
    
    $queryInfra="select ref_sisa_infra,clli_adva from inventario_infra where servicio like '%CD SEGURA%' and tipo_conexion='ENLACE INFRA' and clli_adva ='".$Nde."' order by ref_sisa_infra";
    $resultado = mysql_query($queryInfra);
    while($row=mysql_fetch_array($resultado,MYSQL_BOTH)){
        $salida["infra"][]=$row["ref_sisa_infra"];
    }   
    return json_encode($salida);
}

function infraL2($refSisa,$infraCeCam,$infraCeTra,$infraCeRes){
    $sdp;
    $refs = array();
    $infrasola = array();   
    
    //OBTENER DATOS DE TRANSPORTE Y TRANSPORTE RESPALDO     
    
    $query02 = "SELECT estatus_adva_exp,estatus_infra,puerto_trans,contacto,ubicacion,repisa,id_puerto_fisico,
    puerto_trans_res,contacto_res,ubicacion_res,repisa_res,id_puerto_fisico_res,
    puerto_acceso,tipo_puerto_acceso,capacidad_puerto_acceso,ubicacion_bdfo_acceso,
    repisa_bdfo_acceso,contacto_bdfo_acceso,mod_tar_eth_acceso,id_puerto_fisico_acceso,
    puerto_acceso_res,capacidad_puerto_acceso_res,ubicacion_bdfo_acceso_res,
    repisa_bdfo_acceso_res,contacto_bdfo_acceso_res,mod_tar_eth_acceso_res,
    id_puerto_fisico_acceso_res,clli_adva,select_wdm,aplica_puerto_res FROM inventario_infra WHERE ref_sisa_infra = '".$refSisa."'";
        $result02 = mysql_query($query02);
        $data02 = mysql_fetch_array($result02);
            $infrasola['estatus'] = array(
                $data02['estatus_adva_exp'],
                $data02['estatus_infra']
            );
            $infrasola['ptoTransporte'] = array(
                $data02['puerto_trans'],
                $data02['id_puerto_fisico'],
                $data02['ubicacion'],
                $data02['repisa'],
                $data02['contacto']                
            );
            if($data02['puerto_trans_res'] == '' | $data02['puerto_trans_res'] == null | $data02['puerto_trans_res'] == 'null'){
                $data02['puerto_trans_res'] = '';
                $data02['id_puerto_fisico_res'] = '';
                $data02['ubicacion_res'] = '';
                $data02['repisa_res'] = '';
                $data02['contacto_res'] = '';
            }
            $infrasola['ptoTransporteRespaldo'] = array(
                $data02['puerto_trans_res'],
                $data02['ubicacion_res'],
                $data02['contacto_res'],
                $data02['id_puerto_fisico_res'],                
                $data02['repisa_res']               
            );
        //DATOS DE AGREGADOR
         $query3 = "SELECT cat_anillo.anillo AS anillo,cat_anillo.ospf,cat_anillo.nodo_adm_conex_adsl,
            cat_anillo.id_nodo,cat_anillo.proveedor_tx,cat_anillo.repadm_conxadsl,cat_anillo.clli_equipo,
            cat_anillo.ubi_nodo_adm,cat_anillo.ip_sistema,cat_anillo.clli_agr2 AS clli,inventario_infra.tipo_cluster,
            IF(cat_anillo.tipo_cluster='AGREGADOR 2',(SELECT cat_anillo.anillo FROM cat_anillo WHERE cat_anillo.anillo = anillo AND clli_equipo = clli),'') AS _anillo,
            IF(cat_anillo.tipo_cluster='AGREGADOR 2',(SELECT cat_anillo.ospf FROM cat_anillo WHERE cat_anillo.anillo = anillo AND clli_equipo = clli),'') AS _ospf,
            IF(cat_anillo.tipo_cluster='AGREGADOR 2',(SELECT cat_anillo.nodo_adm_conex_adsl FROM cat_anillo WHERE cat_anillo.anillo = anillo AND clli_equipo = clli),'') AS _nodo_adm_conex_adsl,
            IF(cat_anillo.tipo_cluster='AGREGADOR 2',(SELECT cat_anillo.id_nodo FROM cat_anillo WHERE cat_anillo.anillo = anillo AND clli_equipo = clli),'') AS _id_nodo,
            IF(cat_anillo.tipo_cluster='AGREGADOR 2',(SELECT cat_anillo.proveedor_tx FROM cat_anillo WHERE cat_anillo.anillo = anillo AND clli_equipo = clli),'') AS _proveedor_tx,
            IF(cat_anillo.tipo_cluster='AGREGADOR 2',(SELECT cat_anillo.repadm_conxadsl FROM cat_anillo WHERE cat_anillo.anillo = anillo AND clli_equipo = clli),'') AS _repadm_conxadsl,
            IF(cat_anillo.tipo_cluster='AGREGADOR 2',(SELECT cat_anillo.clli_equipo FROM cat_anillo WHERE cat_anillo.anillo = anillo AND clli_equipo = clli),'') AS _clli_equipo,
            IF(cat_anillo.tipo_cluster='AGREGADOR 2',(SELECT cat_anillo.ubi_nodo_adm FROM cat_anillo WHERE cat_anillo.anillo = anillo AND clli_equipo = clli),'') AS _ubi_nodo_adm,
            IF(cat_anillo.tipo_cluster='AGREGADOR 2',(SELECT cat_anillo.ip_sistema FROM cat_anillo WHERE cat_anillo.anillo = anillo AND clli_equipo = clli),'') AS _ip_sistema 
            FROM cat_anillo,inventario_infra WHERE inventario_infra.ref_sisa_infra = '".$refSisa."' 
            AND cat_anillo.clli_equipo = inventario_infra.clli_equipo AND inventario_infra.ref_sisa_infra != '';";
        $result03 = mysql_query($query3);
        $data03 = mysql_fetch_array($result03);
        $infrasola['tipoAgregador'] = $data03['tipo_cluster'];
        $infrasola['agregador'] = array(
            $data03['anillo'],
            $data03['nodo_adm_conex_adsl'],
            $data03['proveedor_tx'],
            $data03['clli_equipo'],
            $data03['ip_sistema'],
            $data03['ospf'],
            $data03['id_nodo'],
            $data03['repadm_conxadsl'],
            $data03['ubi_nodo_adm']
        );        
        $infrasola['agregadorSecundario'] = array(
            $data03['anillo'],
            $data03['_nodo_adm_conex_adsl'],
            $data03['_proveedor_tx'],
            $data03['_clli_equipo'],
            $data03['_ip_sistema'],
            $data03['ospf'],
            $data03['_id_nodo'],
            $data03['_repadm_conxadsl'],
            $data03['_ubi_nodo_adm']
        );
        if($data03['tipo_cluster'] == 'AGREGADOR 2'){
            $indice=0;
            $respaldo = $infrasola['agregador'];
            $infrasola['agregador'] = $infrasola['agregadorSecundario'];
            $infrasola['agregadorSecundario'] = $respaldo;
            unset($infrasola['agregadorSecundario'][0]);
            unset($infrasola['agregadorSecundario'][5]);
            $respaldo = $infrasola['agregadorSecundario'];
            $infrasola['agregadorSecundario']=array();
            for($j = 0;$j <= 8; $j++){
                if($respaldo[$j]){                  
                    $infrasola['agregadorSecundario'][$indice] = $respaldo[$j];
                    $indice++;
                }
            }
        }        
        $infrasola['ptoCliente'] = array(
            $data02['puerto_acceso'],
            $data02['capacidad_puerto_acceso'],
            $data02['ubicacion_bdfo_acceso'],
            $data02['repisa_bdfo_acceso'],
            $data02['contacto_bdfo_acceso'],
            $data02['id_puerto_fisico_acceso'],
            $data02['tipo_puerto_acceso'],
            $data02['mod_tar_eth_acceso'],
        );
        if($data02['puerto_acceso_res'] == '' | $data02['puerto_acceso_res'] == null | $data02['puerto_acceso_res'] == 'null'){
            $data02['id_puerto_fisico_acceso_res'] = '';
            $data02['repisa_bdfo_acceso_res'] = '';
            $data02['contacto_bdfo_acceso_res'] = '';
            $data02['tipo_puerto_acceso'] = '';
            $data02['capacidad_puerto_acceso_res'] = '';
            $data02['mod_tar_eth_acceso_res'] = '';
            
        }
        $infrasola['ptoClienteRespaldo'] = array(
            $data02['puerto_acceso_res'],
            $data02['capacidad_puerto_acceso_res'],
            $data02['ubicacion_bdfo_acceso_res'],
            $data02['repisa_bdfo_acceso_res'],  
            $data02['contacto_bdfo_acceso_res'],
            $data02['id_puerto_fisico_acceso_res'],         
            $data02['tipo_puerto_acceso'],
            $data02['mod_tar_eth_acceso_res']
        );
        $infrasola['aplicaPuertoRes'] = $data02['aplica_puerto_res'];
        $infrasola['aplicaWDM'] = $data02['select_wdm'];
        //WDM
        $query4 = "select 
            wdm,proveedor_tx_wdm,repadm_conxadsl_wdm,frec_wdm,longo_wdm,canal_wdm, 
            ancho_banda_wdm,pass_t,tlodu_wdm,tl_opvc_wdm,pass_r,rlodu_wdm,rlopvc_wdm,
            clli_equipo_wdm_b,nodo_adm_conex_adsl_wdm_b,ubicacion_bdfo_wdm_b,repisa_wdm_b,
            parfibras_bdfo_wdm_b,tar_wdm_b,ptoether_conxadsl_wdm_b,tipo_puerto_wdm_b,
            tlogico_wdm_b,rlogico_wdm_b,id_puerto_fisico_w_b,clli_equipo_wdm,nodo_adm_conex_adsl_wdm,
            ubicacion_bdfo_wdm,repisa_wdm,parfibras_bdfo_wdm,tar_wdm,ptoether_conxadsl_wdm,
            tipo_puerto_wdm,tlogico_wdm,rlogico_wdm,id_puerto_fisico_w ,
            ptoether_conxadsl_wdmRes,tipo_puerto_wdmRes,tlogico_wdmRes,id_puerto_fisico_wRes,ptoether_conxadsl_wdm_bRes,
            tipo_puerto_wdm_bRes,tlogico_wdm_bRes,id_puerto_fisico_w_bRes           
            from inventario_wdm_demarcadores where clli_adva='".$data02['clli_adva']."' 
            and ref_sisa_infra='".$refSisa."' and ref_sisa_infra != ''";
        $result04 = mysql_query($query4);
        $data04 = mysql_fetch_array($result04);
        $infrasola['wdm'] = array(
            $data04['wdm'],
            $data04['proveedor_tx_wdm'],
            $data04['repadm_conxadsl_wdm'],
            $data04['frec_wdm'],
            $data04['canal_wdm'],
            $data04['longo_wdm'],
            $data04['ancho_banda_wdm'],
            $data04['pass_t'],
            $data04['tlodu_wdm'],
            $data04['pass_r'],
            $data04['rlodu_wdm'],
            $data04['tl_opvc_wdm'],
            $data04['rlopvc_wdm'],
            $data04['clli_equipo_wdm_b'],
            $data04['ubicacion_bdfo_wdm_b'],            
            $data04['parfibras_bdfo_wdm_b'],
            $data04['tar_wdm_b'],
            $data04['ptoether_conxadsl_wdm_b'],
            $data04['tlogico_wdm_b'],
            $data04['id_puerto_fisico_w_b'],            
            $data04['ptoether_conxadsl_wdmRes'],
            $data04['tlogico_wdmRes'],
            $data04['id_puerto_fisico_wRes'],           
            $data04['nodo_adm_conex_adsl_wdm_b'],
            $data04['repisa_wdm_b'],
            $data04['tipo_puerto_wdm_b'],
            $data04['rlogico_wdm_b'],
            $data04['tipo_puerto_wdmRes'],
            $data04['clli_equipo_wdm'],
            $data04['ubicacion_bdfo_wdm'],
            $data04['parfibras_bdfo_wdm'],
            $data04['tar_wdm'],
            $data04['ptoether_conxadsl_wdm'],
            $data04['tlogico_wdm'],
            $data04['id_puerto_fisico_w'],
            $data04['ptoether_conxadsl_wdm_bRes'],
            $data04['tlogico_wdm_bRes'],
            $data04['id_puerto_fisico_w_bRes'],     
            $data04['nodo_adm_conex_adsl_wdm'],         
            $data04['repisa_wdm'],
            $data04['tipo_puerto_wdm'],
            $data04['rlogico_wdm'],
            $data04['tipo_puerto_wdm_bRes'],
        );
        //DISTRIBUIDOR
        for($l = 1; $l < 3; $l++){
            $query5 = "SELECT nodo_adm_conex_adsl,id_nodo,proveedor_tx,repadm_conxadsl,
                clli_equipo,ubi_nodo_adm,ip_sistema FROM cat_anillo WHERE anillo='".$data03['anillo']."' 
                AND tipo_cluster='distribuidor' AND repisa='distribuidor ".$l."'";
            $result05 = mysql_query($query5);
            $data05 = mysql_fetch_array($result05);
            $infrasola['distribuidor'.$l] = array(
                $data05['nodo_adm_conex_adsl'],
                $data05['proveedor_tx'],
                $data05['clli_equipo'],             
                $data05['ip_sistema'],
                $data05['id_nodo'],
                $data05['repadm_conxadsl'],
                $data05['ubi_nodo_adm']
            );
            $query6 = "SELECT * FROM interconexiones_ce where cluster='".$data03['anillo']."' 
                AND id_nodo='".$data05['id_nodo']."' AND id_nodo!='' 
                AND estatus='liquidada' AND tipo_servicio like 'L2'";
            $result06 = mysql_query($query6);
            $data06 = mysql_fetch_array($result06);
            $infrasola['interconexion'.$l] = array(
                $data06['id_interconexion'],
                $data06['ref_sisa'],
                $data06['pto_troncal_a'],
                $data06['tipo_servicio'],
                $data06['hostname_destino'],
                $data06['ip_wan_telmex']
            );          
        }
    $selIdNodo="select id_nodo,ref_sisa_infra,clli_equipo from inventario_infra where ref_sisa_infra in ('".$infraCeCam."','".$infraCeTra."','".$infraCeRes."') and ref_sisa_infra!='' ";
    $res=mysql_query($selIdNodo);
    while($row=mysql_fetch_array($res,MYSQL_BOTH)){
        $infras[$row["ref_sisa_infra"]]=$row["clli_equipo"];
    }   
    
    $querySdp="select nombre_sdp,id_nodo_a,id_nodo_b from inventario_sdp where nombre_sdp in ('".$infras[$infraCeCam]."-".$infras[$infraCeTra]."','".$infras[$infraCeTra]."-".$infras[$infraCeCam]."','".$infras[$infraCeCam]."-".$infras[$infraCeRes]."','".$infras[$infraCeRes]."-".$infras[$infraCeCam]."')";
    $resSdp=mysql_query($querySdp);
    while($row=mysql_fetch_array($resSdp,MYSQL_BOTH)){
        $sdp[]=$row["nombre_sdp"];
    }   

    $infrasola["sdp"]=$sdp;
    return json_encode($infrasola);
}

function reqdatos($ref_sisa){
    $query = "SELECT * FROM ciudad_segura WHERE ref_sisa = '$ref_sisa'";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result, MYSQLI_ASSOC);
    $datos = array(
        'tipo_movimiento' => $row['tipo_movimiento'],
        'anchoBanda' => $row['anchoBanda'],
        'ref_sisa' => trim($ref_sisa),
        'enlace_aso' => $row['ref_sisa_proteccion'],
        'criticidad' => $row['criticidad'],
        'cliente_sisa' => $row['cliente_sisa'],
        'cliente_comun' => $row['cliente_comun'],
        'divisionCamara' => $row['divisionCamara'],
        'centralOrigen' => $row['centralCamara'],
        'centralTrabajo' => $row['centralTrabajo'],
        'centralRespaldo' => $row['centralRespaldo'],
        'c_vlan_gestion_trabajo' => $row['c_vlan_trabajo'],
        's_vlan_tx' => $row['s_vlan'],
        'x_vlan_trabajo' => $row['x_vlan_trabajo'],
        'c_vlan_gestion_respaldo' => $row['c_vlan_respaldo'],
        'x_vlan_respaldo' => $row['x_vlan_respaldo'],       
        'valInfraOrigen' => $row['infra_camara'],
        'valInfraTrab' => $row['infra_trabajo'],
        'valInfraResp' => $row['infra_respaldo'],
        'valCamara' => $row['camara_trabajo'],
        'valTrabajo' => $row['trabajo'],
        'valRespaldo' => $row['respaldo'],
        'interconexion_trabajo' => $row['interconexion_trabajo'],
        'interconexion_respaldo' => $row['interconexion_respaldo'],
        '_observacionesbaja' => $row['observaciones'],
        'longitud' => $row['longitud'],
        'latitud' => $row['latitud'],
        'estatus_cns1_tra'=>$row['estatus_cns1_tra'],
        'estatus_cna_tra'=>$row['estatus_cna_tra'],
        'estatus_cns1_res'=>$row['estatus_cns1_res'],
        'estatus_cna_res'=>$row['estatus_cna_res'],
        'id'=>$row['id'],
        'fol_ser'=>$row['fol_ser'],
        'ndeCamara'=>$row['ndeCamara']
    );
    $queryNde="select clli_adva from inventario_demarcadores where tipo_demarcador='NDE'  and (clase_Servicio='CD SEGURA' or clase_servicio='') order by clli_adva ";
    $result = mysql_query($queryNde);   
    while ( $row = mysql_fetch_array($result, MYSQLI_ASSOC) ){
        $datos["nde"][]=$row["clli_adva"];
    }   
    return json_encode($datos);    
}

function guardaDatos($datos){
    $salida;

    $guarda = "UPDATE ciudad_segura SET tipo_movimiento = '".$datos[1]."',
        clase_servicio = '".$datos[2]."',
        anchoBanda = '".$datos[3]."',
        perfil_qos = '".$datos[4]."',
        ref_sisa_proteccion = '".$datos[5]."',
        criticidad = '".$datos[6]."',
        cliente_sisa = '".$datos[7]."',
        cliente_comun = '".$datos[8]."',
        divisionCamara = '".$datos[9]."',
        centralCamara = '".$datos[10]."',
        centralTrabajo = '".$datos[11]."',
        centralRespaldo = '".$datos[12]."',
        c_vlan_trabajo = '".$datos[13]."',
        x_vlan_trabajo = '".$datos[14]."',
        c_vlan_respaldo = '".$datos[15]."',
        x_vlan_respaldo = '".$datos[16]."',
        s_vlan = '".$datos[17]."',
        interconexion_trabajo = '".$datos[18]."',
        interconexion_respaldo = '".$datos[19]."',
        infra_camara = '".$datos[20]."',
        infra_trabajo = '".$datos[21]."',
        infra_respaldo = '".$datos[22]."',
        camara_trabajo = '".$datos[23]."',
        trabajo = '".$datos[24]."',
        infra_l2_trabajo = '".$datos[25]."',
        camara_respaldo = '".$datos[26]."',
        respaldo = '".$datos[27]."',
        infra_l2_respaldo = '".$datos[28]."',
        observaciones = '".$datos[29]."',
        latitud = '".$datos[35]."',
        longitud = '".$datos[36]."',
        ndeCamara= '".$datos[37]."'
        WHERE ref_sisa = '".$datos[0]."'"; 
    !(mysql_query($guarda)) ? $salida = 'Algo salio mal, intente nuevamente' : $salida = 'Datos guardados correctamente';

    return json_encode($salida);
}
function ordenes($datos,$fieldEstatus,$estatus,$pref,$cns,$tpo){
    
    $num_ot_frida="RF-CDS-".date('dmY')."-".rand(10000, 99999);
    $generaot="REPLACE INTO ordenes  (cns,fecha_val,personal_valida,fecha_solicitud,tipo_trabajo,tipo_producto,nombre_oficial_pisa,num_ot_frida,fecha_cns2,estatus,tabla,id_tabla,trafico,tipo_equipo,observaciones,ref_sisa,division) VALUES ('".$cns."',NOW(),'Validacion Automatica',NOW(),'".$pref."','".$pref."','".$datos[0]."','$num_ot_frida',NOW(),'".$estatus."','ciudad_segura','".$datos[30]."','".$pref."','CIUDAD SEGURA ".$tpo."',CONCAT(' |',NOW()),'".$datos[0]."','METRO')";  
    mysql_query($generaot); 

    $mysql_Update="UPDATE ciudad_segura SET  ".$fieldEstatus."='".$estatus."',num_ot_frida='".$num_ot_frida."' where ref_sisa='".$datos[0]."'";
    !(mysql_query($mysql_Update)) ? $salida = 'Algo salio mal, intente nuevamente' : $salida = 'Datos guardados correctamente';
    return json_encode($salida);
}

function interTroncal($idNodoA,$idNodoB){
    $chunksA = explode("-",$idNodoA);
    $chunksB = explode("-",$idNodoB);
    $prefA = $chunksA[1];
    $prefB = $chunksB[1];
    $query = "select  replace (concat_ws('/',repisat,posicion_tarjeta,replace( subslot,'N/A','' ),puerto),'//','/') as puerto,contacto_bdfo,ubicacion_bdfo,repisa_bdfo from inventario_puertos_ce where id_nodo='".$idNodoA."' and pto_troncal like '".$prefA."-".$prefB."-%' ";
    $res=mysql_query($query);
    $row = mysql_fetch_row($res);
    if(mysql_num_rows($res)>0)      $array = array($row[0],$row[1],$row[2],$row[3]);
    else                            $array = array("","","","");
    return $array;
}

function regresaTroncal($conjuntoPuertos){
    $totalPuertos = array();
    /*---------C?MARA--------
     * AGREGADOR 1? NIVEL = 0
     * AGREGADOR 2? NIVEL = 1
     * DISTRIBUIDOR 1     = 2
     * DISTRIBUIDOR 2     = 3
     * --------TRABAJO-------
     * AGREGADOR          = 4
     * DISTRIBUIDOR 1     = 5
     * DISTRIBUIDOR 2     = 6
     * --------RESPALDO------
     * AGREGADOR          = 7
     * DISTRIBUIDOR 1     = 8
     * DISTRIBUIDOR 2     = 9
     */
    //C?MARA
    $totalPuertos['CMRag1_CMRds1'] = interTroncal($conjuntoPuertos[0],$conjuntoPuertos[2]);
    $totalPuertos['CMRds1_CMRag1'] = interTroncal($conjuntoPuertos[2],$conjuntoPuertos[0]);
    if($conjuntoPuertos[1] != ''){
        $totalPuertos['CMRag2_CMRag1'] = interTroncal($conjuntoPuertos[1],$conjuntoPuertos[0]);
        $totalPuertos['CMRag1_CMRag2'] = interTroncal($conjuntoPuertos[0],$conjuntoPuertos[1]);
    }
    $totalPuertos['CMRag1_CMRds2'] = interTroncal($conjuntoPuertos[0],$conjuntoPuertos[3]);
    $totalPuertos['CMRds2_CMRag1'] = interTroncal($conjuntoPuertos[3],$conjuntoPuertos[0]);
    //TRABAJO
    $totalPuertos['TBJag1_TBJds1'] = interTroncal($conjuntoPuertos[4],$conjuntoPuertos[5]);
    $totalPuertos['TBJds1_TBJag1'] = interTroncal($conjuntoPuertos[5],$conjuntoPuertos[4]);
    $totalPuertos['TBJds2_TBJag1'] = interTroncal($conjuntoPuertos[6],$conjuntoPuertos[4]);
    $totalPuertos['TBJag1_TBJds2'] = interTroncal($conjuntoPuertos[4],$conjuntoPuertos[6]);
    //RESPALDO
    $totalPuertos['RSPag1_RSPds1'] = interTroncal($conjuntoPuertos[7],$conjuntoPuertos[8]);
    $totalPuertos['RSPds1_RSPag1'] = interTroncal($conjuntoPuertos[8],$conjuntoPuertos[7]);
    $totalPuertos['RSPds2_RSPag1'] = interTroncal($conjuntoPuertos[9],$conjuntoPuertos[7]);
    $totalPuertos['RSPag1_RSPds2'] = interTroncal($conjuntoPuertos[7],$conjuntoPuertos[9]);
    return json_encode($totalPuertos);
}

function combocausas($tipoCausa){
    $datos = array();
    $orden = array(1=>'adva',2=>'ptoext_ce');
    $query = "select id_causa,causa from cat_causas where tabla='".$orden[$tipoCausa]."' order by causa";
    $resultado = mysql_query($query);
    $max = mysql_num_rows($resultado);
    if($max > 0){
        for($i = 0; $i < $max; $i++){
            $dt = mysql_fetch_array($resultado);
            $datos[] = $dt['causa'];
        }
    }
    return json_encode($datos);
}

function datosOrdenes($id){
    $queryOrden = "SELECT nombre_oficial_pisa,personal_valida,tecnico,num_ot_frida, nombre_oficial_pisa, trafico,  tabla, id_tabla, estatus,fecha_val,fecha_prog1,date_format(fecha_liq, '%Y/%m/%d') as fecha_liq,num_intervencion  FROM ordenes WHERE id_ot!='' and  id_ot=".$id . " LIMIT 1";
    $result = mysql_query($queryOrden);                              
    $rowOrden = mysql_fetch_array($result, MYSQL_ASSOC);
    $datos = array(
        'personal_valida' => $rowOrden['personal_valida'],
        'tecnico' => $rowOrden['tecnico'],
        'estatus' => $rowOrden['estatus'],
        'trafico' => $rowOrden['trafico'],
        'tabla' => $rowOrden['tabla'],
        'nombre_oficial_pisa' => $rowOrden['nombre_oficial_pisa'],
        'id_tabla' => $rowOrden['id_tabla'],
        'ot' => $rowOrden['num_ot_frida'],
        'fecha_val' => $rowOrden['fecha_val'],
        'fecha_prog1' => $rowOrden['fecha_prog1'],
        'fecha_liq' => $rowOrden['fecha_liq'],
        'num_intervencion' => $rowOrden['num_intervencion']
    );
    
    $p=explode(' ',$rowOrden['trafico']);
    $p=array_reverse($p);
    
    if($rowOrden['trafico']=="CONF VLAN CIUDAD SEGURA TRABAJO"||$rowOrden['trafico']=="CONF VLAN CIUDAD SEGURA RESPALDO"){
        $array_ob=array("CONF VLAN CIUDAD SEGURA TRABAJO"=>"observaciones_cns1_tra","CONF VLAN CIUDAD SEGURA RESPALDO"=>"observaciones_cns1_res");
        $obser=$array_ob[$rowOrden['trafico']];
    }else{  
        if($p[0]=="TRABAJO")            $obser="observaciones_cna_tra";
        else                            $obser="observaciones_cna_res";
    }   
    $query_ob="select ".$obser." from ciudad_segura where ref_sisa='".$rowOrden['nombre_oficial_pisa']."'";
    $result = mysql_query($query_ob);                              
    $rowA = mysql_fetch_array($result, MYSQL_BOTH);
    $datos["obser"]= $rowA[0];
    
    if($rowOrden['estatus'] == "POR REVISAR"){
        $query = "UPDATE ordenes SET estatus='EN VALIDACION' WHERE id_ot!='' and id_ot=" .$id ;
        mysql_query($query);
        if($rowOrden['trafico'] == "CONF VLAN CIUDAD SEGURA TRABAJO"){
            $query = "UPDATE ciudad_segura SET estatus_cns1_tra='EN VALIDACION' WHERE id=" .$rowOrden['id_tabla'] ;
        }
        if($rowOrden['trafico']=="CONF VLAN CIUDAD SEGURA RESPALDO"){
            $query = "UPDATE ciudad_segura SET estatus_cns1_res='EN VALIDACION' WHERE id=" .$rowOrden['id_tabla'];
        }
        mysql_query($query);            
    }
    if($rowOrden['estatus'] == "VALIDADA"){
        $query = "UPDATE ordenes SET estatus='ASIGNACION DE TECNICO' WHERE id_ot!='' and id_ot=" .$id ;
        mysql_query($query);
        if($rowOrden['trafico']=="CONF VLAN CIUDAD SEGURA TRABAJO"  ){
            $query = "UPDATE ciudad_segura SET estatus_cns1_tra='ASIGNACION DE TECNICO' WHERE id=" .$rowOrden['id_tabla'] ;
        }
        if($rowOrden['trafico']=="CONF VLAN CIUDAD SEGURA RESPALDO" ){
            $query = "UPDATE ciudad_segura SET estatus_cns1_res='ASIGNACION DE TECNICO' WHERE id=" .$rowOrden['id_tabla'];
        }
        if($rowOrden['trafico']=="ALTA CIUDAD SEGURA TRABAJO"  ){
            $query = "UPDATE ciudad_segura SET estatus_cna_tra='ASIGNACION DE TECNICO' WHERE id=" .$rowOrden['id_tabla'] ;
        }
        if($rowOrden['trafico']=="ALTA CIUDAD SEGURA RESPALDO" ){
            $query = "UPDATE ciudad_segura SET estatus_cna_res='ASIGNACION DE TECNICO' WHERE id=" .$rowOrden['id_tabla'];
        }
        mysql_query($query);            
    }
    return json_encode($datos);
}

function correo_liq_cs($refeSisa,$divisionOrgen,$divisionDestino,$clienteComun,$clienteSisa,$trafico,$to,$cc){
    include ("smtp.php");
    include_once ('nomad_mimemail.inc.php');
    $html = "<html><head></head><body>";
    $html.="<h4>Se Liquidaron las Pruebas RFC del Servicio de CIUDAD SEGURA con referencia: ".$refeSisa." de la DD Origen ".$divisionOrgen." y DD Destino ".$divisionDestino.".<br>
    Con Cliente Comun: ".$clienteComun." y Cliente Sisa: ".$clienteSisa."</h4>";
    $html .= "<br></body></html>";
    $subject = "Liquidacion de Pruebas RFC de CIUDAD SEGURA con referencia ".$refeSisa." por CNA ";  
    $mimemail = new nomad_mimemail();
    $mimemail->set_smtp_host($smtp_host);
    $mimemail->set_smtp_auth($smtp_user, $smtp_pass);
    for ($d=0;$d<count($to);$d++)
        $mimemail->add_to($to[$d]);
    for ($d=0;$d<count($cc);$d++)
        $mimemail->add_cc($cc[$d]);     
    $mimemail->set_subject($subject);
    $mimemail->set_html($html);
    $mimemail->set_smtp_host($smtp_host);
    $mimemail->set_smtp_auth($smtp_user, $smtp_pass);
    if($mimemail->send())
        return "Se env?o correo al responsable del proyecto.";
    else
        return "ERROR:  Mail No enviado"; 
}
function rechazoOrdenes($idOrd,$obser,$mot_rech,$personal,$estatus,$field_cns,$field_obser,$referencia,$register2,$folSer,$c_vlan){
    $telefono="SELECT telefono from cat_tecnicos where nombre='".$personal."'";
    $resultTel = mysql_query($telefono);                              
    $rowTel = mysql_fetch_array($resultTel, MYSQL_ASSOC);
    if($estatus=="RECHAZADA"||$estatus=="EJECUTADA SIN EXITO"){
        $causa="causa='".implode(",",$mot_rech)."' ,";
        $motivo="'CAUSA ".$estatus.":','".implode(",",$mot_rech)."',";
    }else{
        $motivo="'CAUSA ".$estatus.":',";
    }
    $conv=array("VALIDADA"=>"VALIDADA","RECHAZADA"=>"RECHAZADA","EJECUTADA CON PRUEBAS"=>"LIQUIDADA","EJECUTADA SIN PRUEBAS"=>"LIQUIDADA",
    "EJECUTADA SIN EXITO"=>"RECHAZADA","EN VALIDACION"=>"EN VALIDACION","ASIGNACION DE TECNICO"=>"ASIGNACION DE TECNICO","EN ESPERA"=>"EN ESPERA",
    "AUTORIZADA"=>"AUTORIZADA");
    
    $query = "UPDATE ordenes SET fecha_val=NOW(), personal_valida='".$personal."', ".$causa."  estatus='".$estatus."', estatus_top='".$estatus."',observaciones=CONCAT('|',NOW(),' Supervisor:','".$personal."','.- Tel.:.".$rowTel["telefono"]."- OBSERVACIONES:-".$estatus."-','".$obser."',observaciones) WHERE id_ot!='' and  id_ot=".$idOrd;
    mysql_query($query);
    $query2 = "UPDATE ciudad_segura SET ".$field_cns."='".$conv[$estatus]."', ".$field_obser."=CONCAT('|',NOW(),': (Usuario: ','".$personal."), ','".$personal."',".$motivo."' OBSERVACIONES: -".$conv[$estatus]."-','".$obser."',".$field_obser.")  WHERE ref_sisa = '".$referencia."'";
    mysql_query($query2);
    
/*    if(($estatus=="EJECUTADA CON PRUEBAS"||$estatus=="EJECUTADA SIN PRUEBAS")&& $register2!=''){
        $field=array("ALTA CIUDAD SEGURA TRABAJO"=>"estatus_cna_tra","ALTA CIUDAD SEGURA RESPALDO"=>"estatus_cna_res");     
        $query = "UPDATE ordenes SET  estatus='VALIDADA', estatus_top='VALIDADA',fecha_val=NOW() WHERE ref_sisa = '".$referencia."' and trafico='".$register2."'";
        mysql_query($query);        
        $query2 = "UPDATE ciudad_segura SET ".$field[$register2]."='VALIDADA'   WHERE ref_sisa = '".$referencia."'";
        mysql_query($query2);       
    }*/
    $a=mysql_query("select id,ref_sisa from ciudad_segura where ref_sisa='".$referencia."' and estatus_cna_tra='LIQUIDADA' and estatus_cna_res='LIQUIDADA' ");
    if(mysql_num_rows($a)>0){
        $res=mysql_query("select * from tarea_frida where referencia='".$referencia."'");
        if(mysql_num_rows($res)>0){
            include("wsdlInicioFrida.php");
            $wsdl="http://10.192.3.85:9083/wsSisaInsFridaWeb/services/WsSisaInsFrida/wsdl/WsSisaInsFrida.wsdl";     
            $fecha              =date(Y).date(m).date(d).date(h).date(i).date(s);           
            $objetoTermino          =new terminoFirda("", "0000", "", $fecha, $folSer,"TERMINO-FRIDA", "", $referencia, "","SERVICIOS PRIVADOS ETHERNET", $c_vlan, "", "", "");
            $termino = new wsdlInicioFrida($objetoTermino);
        //  var_dump($termino);
            $client = new SoapClient($wsdl);
            $result = $client->wsSisaInsFridaTerminoFrida($termino);
        //  var_dump($result);
            if($result->wsSisaInsFridaTerminoFridaReturn->codigo_error =="0000") {
                $queryDelTareaFrida="DELETE FROM tarea_frida WHERE referencia='".$referencia."'";
                $delTareaFrida=mysql_query($queryDelTareaFrida);        
            }
        }
        correo_liq_cs($referencia,"METRO","METRO","GOBIERNO DEL DISTRITO FEDERAL","GOBIERNO DEL DISTRITO FEDERAL",$trafico,array("MHHERNAN@TELMEX.COM","LAURARUG@TELMEX.COM","RCENRIQU@TELMEXOMSASI.COM","FCRUZALE@REDUNO.COM.MX","MTGUSTAV@TELMEX.COM","DBAZALDU@TELMEX.COM","JERODRIG@TELMEX.COM"),array("EARRIAGA@TELMEX.COM","MCTELCEL@TELMEX.COM","JHPOSADA@TELMEX.COM","APLATA@TELMEX.COM","JMVERA@TELMEX.COM","APMAYA@TELMEXOMSASI.COM","JRMOLINA@TELMEXOMSASI.COM","noc.implementacion@gmail.com","edsonsb@telmexmail.com","CBORJA@TELMEXOMSASI.COM","LSANTOS@TELMEX.COM","MGUZMAN@TELMEX.COM"));
        //correo_liq_cs('CB8-1301-0007','METRO','METRO','TELEFONOS DE MEXICO','TELEFONOS DE MEXICO','ALTA SERVICIO L2',array("emvargas@telmex.com","emvargas@telmex.com"),array("emvargas@telmex.com","emvargas@telmex.com"));
    }   
    return json_encode(array($query,$query2));
}

function correo_liq($ref,$cns,$tmp,$to,$cc,$lado){
     include ("smtp.php");
    include_once ('nomad_mimemail.inc.php');
    $html = "<html><head></head><body>";
    $html.="<h4>Se Agendaron :".$tmp."(".$cns.") de Ciudad Segura por CNA<br>";
    $html .= "<br>La referencia: ".$ref." lado ".$lado."</body></html>";
    $subject = "".$tmp."  de : ".$ref." por ".$cns." ";  
    $mimemail = new nomad_mimemail();
    $mimemail->set_smtp_host($smtp_host);
    $mimemail->set_smtp_auth($smtp_user, $smtp_pass);
    for ($d=0;$d<count($to);$d++)
        $mimemail->add_to($to[$d]);
    for ($d=0;$d<count($cc);$d++)
        $mimemail->add_cc($cc[$d]);     
    $mimemail->set_subject($subject);
    $mimemail->set_html($html);
    $mimemail->set_smtp_host($smtp_host);
    $mimemail->set_smtp_auth($smtp_user, $smtp_pass);
    if($mimemail->send())
        return "Se env?o correo al responsable del proyecto.";
    else
        return "ERROR:  Mail No enviado"; 
}

function guardarJSON($json,$rf){
$rf=trim($rf);
    file_put_contents('ciudadSegura/json/'.$rf.'.json', json_encode($json));
    return(json_encode('archivo guardado correctamente'));
}

function sacarFoto($ruta,$refsisa){
    exec('D:\xampp\htdocs\infinitum\inversion\phantomjs D:\xampp\htdocs\infinitum\js\exportTopologicCS.js '.$ruta.' '.$refsisa.'');
    
}

function prueba($cns,$tmp, $ref, $id_tabla, $tpo, $observaciones, $clli_dde_cam){
    $num_ot_frida = "RF-CDS-".date('dmY')."-".rand(10000, 99999);
    
        //  QUERY QUE HACE REPLACE EN ORDENES
    $replace = "REPLACE INTO ordenes (cns,fecha_val,personal_valida,fecha_solicitud,tipo_trabajo,tipo_producto,nombre_oficial_pisa,num_ot_frida,fecha_cns2,estatus,tabla,id_tabla,trafico,tipo_equipo,observaciones,ref_sisa,division) VALUES ('".$cns."',NOW(),'Validacion Automatica',NOW(),'".$tmp." ".$tpo."','".$tmp." ".$tpo."','".$ref."','".$num_ot_frida."',NOW(),'VALIDADA','ciudad_segura','".$id_tabla."','".$tmp." ".$tpo."','CIUDAD SEGURA ".$tpo."',CONCAT(' |',NOW()),'".$ref."','METRO')";
    mysql_query($replace);  
}

/*-------------
  R E Q U E S T
 --------------*/
if($cadena){
    echo autocompletar($cadena);
}
if($interUninet){
    echo datos($interUninet);
}
if(isset($iUninet)){
    echo aplicadde($iUninet);
}
if($refSisa){
    echo aplicadde($refSisa);
}
if(isset($refSisaInfra)||isset($clliCamara)){
    echo adatos($refSisaInfra,$clliCamara,$clliTrabajo,$clliRespaldo,$tipo);
//    echo json_encode(array("hola"));
}
if($refSisa1){
    echo infraL2($refSisa1,$infCamara,$infTrabajo,$infRespaldo);
}
if($ref_sisa){
    echo reqdatos($ref_sisa);
}
if($guardar=="guardar"){
    echo guardaDatos($datos);
}
if($guardar=="solGestTraCns1"||$guardar=="solGestTraCna"||$guardar=="solGestResCns1"||$guardar=="solGestResCna"){
    guardaDatos($datos);
    if($guardar=="solGestTraCns1")
        echo   ordenes($datos,"estatus_cns1_tra","POR REVISAR","CONF VLAN CIUDAD SEGURA TRABAJO","CNS I","TRABAJO");
    if($guardar=="solGestTraCna")       
        echo   ordenes($datos,"estatus_cna_tra","VALIDADA","ALTA CIUDAD SEGURA TRABAJO","CNA","TRABAJO");
    if($guardar=="solGestResCns1")      
        echo   ordenes($datos,"estatus_cns1_res","POR REVISAR","CONF VLAN CIUDAD SEGURA RESPALDO","CNS I","RESPALDO");
    if($guardar=="solGestResCna")       
        echo   ordenes($datos,"estatus_cna_res","VALIDADA","ALTA CIUDAD SEGURA RESPALDO","CNA","RESPALDO");
}
if($conjuntoPuertos){
    echo regresaTroncal($conjuntoPuertos);
}
if($tipoCausa){
    echo combocausas($tipoCausa);
}
if($idOrdenes){
    echo datosOrdenes($idOrdenes);
}
if($estatus){
    $clli_dde_cam = $_POST['clli_dem_cam'];
    if($reg=="CONF VLAN CIUDAD SEGURA TRABAJO")
    echo rechazoOrdenes($idOrd,$obser,$mot_rech,$personal,$estatus,"estatus_cns1_tra","observaciones_cns1_tra",$ref,"ALTA CIUDAD SEGURA TRABAJO",$folSer,$c_vlan);
    if($reg=="CONF VLAN CIUDAD SEGURA RESPALDO")
    echo rechazoOrdenes($idOrd,$obser,$mot_rech,$personal,$estatus,"estatus_cns1_res","observaciones_cns1_res",$ref,"ALTA CIUDAD SEGURA RESPALDO",$folSer,$c_vlan);
    
    if($reg=="ALTA CIUDAD SEGURA TRABAJO"){
        $tmp = $estatus;
        $estatus = preg_match('/ASISTENCIA A PRUEBAS (TX|ACC) CS/',$estatus) == 1 ? 'EN ESPERA' : $estatus;

        echo rechazoOrdenes($idOrd,$obser,$mot_rech,$personal,$estatus,"estatus_cna_tra","observaciones_cna_tra",$ref,"",$folSer,$c_vlan);
        if($estatus == 'EN ESPERA'){
            $cns = preg_match('/TX/',$tmp) == 1 ? 'CNS I' : 'CNS IV';              
            prueba($cns, $tmp, $ref, $id_tabla, 'TRABAJO', $obser, $clli_dde_cam);
            $to=array("emvargas@telmex.com","custom_90@hotmail.com");
            $cc=array("emvargas@telmex.com","custom_90@hotmail.com");
            $_SESSION["cont"]++;
            if($_SESSION["cont"]==1)
            correo_liq($ref,$cns,$tmp,$to,$cc,"Trabajo");

        }
    }
    if($reg=="ALTA CIUDAD SEGURA RESPALDO"){
        $tmp = $estatus;
        $estatus = preg_match('/ASISTENCIA A PRUEBAS (TX|ACC) CS/',$estatus) == 1 ? 'EN ESPERA' : $estatus;
        echo rechazoOrdenes($idOrd,$obser,$mot_rech,$personal,$estatus,"estatus_cna_res","observaciones_cna_res",$ref,"",$folSer,$c_vlan);
        
        if($estatus == 'EN ESPERA'){
            $cns = preg_match('/TX/',$tmp) == 1 ? 'CNS I' : 'CNS IV';
            prueba($cns, $tmp, $ref, $id_tabla, 'RESPALDO', $obser, $clli_dde_cam);
            $to=array("emvargas@telmex.com","custom_90@hotmail.com");
            $cc=array("emvargas@telmex.com","custom_90@hotmail.com");
           $_SESSION["cont"]++;
            if($_SESSION["cont"]==1)
            correo_liq($ref,$cns,$tmp,$to,$cc,"Respaldo");
        }
    }
        if($reg == 'ASISTENCIA A PRUEBAS TX CS TRABAJO' | $reg == 'ASISTENCIA A PRUEBAS ACC CS TRABAJO'){
            rechazoOrdenes($idOrd,$obser,$mot_rech,$personal,$estatus,"estatus_cna_tra","observaciones_cna_tra",$ref,"",$folSer,$c_vlan);
            $id_ot = mysql_query("select id_ot from ordenes where trafico = 'ALTA CIUDAD SEGURA TRABAJO' AND nombre_oficial_pisa ='".$ref."'");
            $id_ot = mysql_fetch_array($id_ot, MYSQL_BOTH);
            $id_ot = $id_ot[0];
            $altestatus = 'AUTORIZADA';                     
            if($reg == 'ASISTENCIA A PRUEBAS ACC CS TRABAJO' & $estatus == 'EJECUTADA SIN EXITO'){
                $altestatus = 'EN ESPERA';
                //  QUERY QUE ACTUALIZA EN inventario_demarcadores
                $update = "UPDATE inventario_demarcadores SET estatus_adva = 'ASISTENCIA A PRUEBAS',estatus_adva_exp = 'RECHAZADA',gestionada = 'NO GESTIONADO',observaciones = CONCAT(observaciones,'|','".$observaciones."'),observaciones_adva_exp = CONCAT(observaciones_adva_exp,'|','".$observaciones."') WHERE clli_adva = '".$clli_dde_cam."'";
                mysql_query($update);
                $up = "UPDATE ordenes SET causa_pba = '".$clli_dde_cam."' WHERE id_ot = ".$id_ot;
                mysql_query($up);
            }
            echo rechazoOrdenes($id_ot,$obser,$mot_rech,$personal,$altestatus,"estatus_cna_tra","observaciones_cna_tra",$ref,"",$folSer,$c_vlan);

        }
        if($reg == 'ASISTENCIA A PRUEBAS TX CS RESPALDO' | $reg == 'ASISTENCIA A PRUEBAS ACC CS RESPALDO'){
            rechazoOrdenes($idOrd,$obser,$mot_rech,$personal,$estatus,"estatus_cna_res","observaciones_cna_res",$ref,"",$folSer,$c_vlan);
            $id_ot = mysql_query("select id_ot from ordenes where trafico = 'ALTA CIUDAD SEGURA RESPALDO' AND nombre_oficial_pisa ='".$ref."'");
            $id_ot = mysql_fetch_array($id_ot, MYSQL_BOTH);
            $id_ot = $id_ot[0];
            $altestatus = 'AUTORIZADA';
            if($reg == 'ASISTENCIA A PRUEBAS ACC CS RESPALDO' & $estatus == 'EJECUTADA SIN EXITO'){
                $altestatus = 'EN ESPERA';
                //  QUERY QUE ACTUALIZA EN inventario_demarcadores
                $update = "UPDATE inventario_demarcadores SET estatus_adva = 'ASISTENCIA A PRUEBAS',estatus_adva_exp = 'RECHAZADA',gestionada = 'NO GESTIONADO',observaciones = CONCAT(observaciones,'|','".$observaciones."'),observaciones_adva_exp = CONCAT(observaciones_adva_exp,'|','".$observaciones."') WHERE clli_adva = '".$clli_dde_cam."'";
                mysql_query($update);
                $up = "UPDATE ordenes SET causa_pba = '".$clli_dde_cam."' WHERE id_ot = ".$id_ot;
                mysql_query($up);
            }
            echo rechazoOrdenes($id_ot,$obser,$mot_rech,$personal,$altestatus,"estatus_cna_res","observaciones_cna_res",$ref,"",$folSer,$c_vlan);
        }
}
if($refeSisa){
    //echo correo_liq($refeSisa,$divisionOrgen,$divisionDestino,$clienteComun,$clienteSisa,$trafico,$to,$cc);
}
if($json){
    $json = $_POST['json'];
    $rf = $_POST['rf'];
    $ruta = $_POST['ruta'];
    guardarJSON($json,$rf);
    sacarFoto($ruta,$rf);
}


?>