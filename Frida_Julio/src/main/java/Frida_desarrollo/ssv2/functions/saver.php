<?php
header("Content-Type: text/html;charset=utf-8");
include 'conexion.php';
include 'classes/Mail.php';

function datetransform($fecha){
    $finaldate;
    $subdate = explode('-', $fecha);
    switch($subdate[1]){
        case '01': $subdate[1] = 'Enero'; break;
        case '02': $subdate[1] = 'Febrero'; break;
        case '03': $subdate[1] = 'Marzo'; break;
        case '04': $subdate[1] = 'Abril'; break;
        case '05': $subdate[1] = 'Mayo'; break;
        case '06': $subdate[1] = 'Junio'; break;
        case '07': $subdate[1] = 'Julio'; break;
        case '08': $subdate[1] = 'Agosto'; break;
        case '09': $subdate[1] = 'Septiembre'; break;
        case '10': $subdate[1] = 'Octubre'; break;
        case '11': $subdate[1] = 'Noviembre'; break;
        case '12': $subdate[1] = 'Diciembre'; break;
        default: $subdate[1] = 'Mes desconocido'; break;
    }
    $finaldate = $subdate[2].' de '.$subdate[1].' de '.$subdate[0];
    unset($subdate);
    return $finaldate;
}
function proveedores(){
    $proveedor = '';
    $query = "SELECT proveedor FROM ztecnologias WHERE id > 0 GROUP BY proveedor ORDER BY proveedor ASC";
    $prov = mysql_query($query);
    $max = mysql_num_rows($prov);
    if($max > 0){
        for($p = 0; $p < $max; $p++){
            $pr = mysql_fetch_array($prov);
            $proveedor .= '<option value="'.$pr['proveedor'].'">'.$pr['proveedor'].'</option>';
        }
    }
    return $proveedor;
}
function genfolio($division){
    $folio = '';
    //BUSCA ID DE DIVISIÓN
    $sqldiv = mysql_query("select cb_dd from siatel_areas where cb_ddnom='$division' GROUP BY cb_dd");
    $sqldiv = mysql_fetch_array($sqldiv,MYSQL_BOTH);
    $clave_div = $sqldiv[0];
    //$clave_div = mysql_result($sqldiv,0,0);
    
    //BUSCA EL ÚLTIMO ID
    $busca_id = mysql_query("SELECT MAX(id) AS id FROM zsite_survey;");
    $max_id = mysql_result($busca_id,0,0);
    
    //BUSCA FOLIO
    $busca_folio = mysql_query("SELECT folio FROM zsite_survey WHERE id = ".$max_id.";");
    $max_folio = mysql_result($busca_folio,0,0);
    
    $iden = substr($max_folio, -3);
    $fecha_folio = substr($max_folio, 4, 8);
    $fecha = date('Ymd');
    
    if($fecha_folio != $fecha){
	$folio .= 'SS'.$clave_div.$fecha.'001';
    }
    else{
        $iden = (int)$iden;
        $iden+=1;
        if($iden > 0 && $iden <= 9){                    
            $folio .= 'SS'.$clave_div.$fecha.'00'.$iden;
        }
        else if($iden > 9 && $iden <= 99){
            $folio .= 'SS'.$clave_div.$fecha.'0'.$iden;
        }
        else{
            $folio .= 'SS'.$clave_div.$fecha.$iden;
        }
    }
    return $folio;
}
#guarda pedidos
function guardapedido($folio,$pedido,$numpedido){

    #$pedido    = explode(',', $pedido); 
    echo $pedido."<= EJEMPLO DE PEDIDO UNO</br>";
    print_r($numpedido)."EJEMPLO DE PEDIDOS AGREAGDOS";exit();

    unset($arrDupl);  
    $arrDupl   = array();
    foreach ($pedido as $pedbusqueda) {
        $duplicado  = "SELECT folio,estatus FROM zsite_survey WHERE FIND_IN_SET('$pedido',pedido) AND estatus <> 'CANCELADO'";
        $exduplica  = mysql_query($duplicado);
        $numduplica = mysql_num_rows($exduplica);
        if($numduplica > 0){
            $rDuplica  = mysql_fetch_array($exduplica);
            $arrDupl[] = array("folioSS" => $rDuplica['folio'],"pedidoSS" => $pedbusqueda );   
        }
    }

   $resultDuplica = count($arrDupl);
   if($resultDuplica == 0){
        foreach ($pedido as $gpedido){
            
            $guardapedido = ("INSERT INTO zpedido (folio,pedido)
                               VALUES('".$folio."','".$gpedido."')");

        }

        $salida = 'OK';
   }else{

        $salida = $arrDupl; 
   }
  

}


function guardarss($folio,$tipoSiteSurvey,$plan,$rubro,$central,$ctnombre,$cttelefono,$ctemail,$ctmovil,$rsnombre,$rstelefono,$rsemail,$rsmovil,$cpnombre,$cptelefono,$cpemail,$cpmovil,$fecha_programada,$punto_reunion,$proveedor,$modelo,$pep,$version,$dir_div,$cpinombre,$cpitelefono,$cpimovil,$cpiemail,$pedido,$cpifonombre,$cpifotelefono,$cpifoemail,$cpifomovil,$cicranombre,$cicratelefono,$cicraemail,$cicramovil,$cconnombre,$ccontelefono,$cconemail,$cconmovil){
    $query = "INSERT INTO zsite_survey (id,folio,nuevo_adecuacion,rubro,id_central,plan,ctnombre,cttelefono,ctemail,ctmovil,rsnombre,rstelefono,rsemail,rsmovil,cpnombre,cptelefono,cpemail,cpmovil,fecha_solicitud,fecha_programada,estatus,punto_reunion,prove,tecno,pep,version,dir_div,cpinombre,cpitelefono,cpimovil,cpiemail,pedido,cpifonombre,cpifotelefono,cpifoemail,cpifomovil,cpicranombre,cpicratelefono,cpicraemail,cpicramovil,cconnombre,ccontelefono,cconmail,cconmovil) 
        VALUES (id, '".$folio."','".$tipoSiteSurvey."',".$rubro.",".$central.",'".$plan."','".$ctnombre."','".$cttelefono."','".$ctemail."','".$ctmovil."','".$rsnombre."','".$rstelefono."','".$rsemail."','".$rsmovil."','".$cpnombre."', '".$cptelefono."','".$cpemail."','".$cpmovil."',NOW(),'".$fecha_programada."','SOLICITADO',\"".$punto_reunion."\",'".$proveedor."','".$modelo."','".$pep."',".$version.",'".$dir_div."','".$cpinombre."','".$cpitelefono."','".$cpimovil."','".$cpiemail."','".$pedido."','".$cpifonombre."','".$cpifotelefono."','".$cpifoemail."','".$cpifomovil."','".$cicranombre."','".$cicratelefono."','".$cicraemail."','".$cicramovil."','".$cconnombre."','".$ccontelefono."','".$cconemail."','".$cconmovil."')";
   
    if(!mysql_query($query)){
        $salida = 'Error durante el guardado de datos, vuelva a intentar'.mysql_error();;
    }
    else {
        $salida = 'Programaci&oacute;n realizada correctamente';
       }  
    //echo $query;exit();
    return $salida;
    //mysql_query($query) or die(mysql_error());
}
function guardaemails($folio,$nombres,$cc){
    for($i = 0; $i < count($cc); $i++){
        $query = "INSERT INTO zccemails VALUES (id, '".$folio."', '".$nombres[$i]."', '".$cc[$i]."');";
        mysql_query($query);
    }
}
function guardareqs($noequipos, $folio, $modelos){
    for($c = 0; $c < $noequipos; $c++){
        $query = "INSERT INTO zss_equipos (id, folio, id_tecnologia,nombre_equipo,puertos,tarjetas,tipo_trabajo) VALUES (id,'".$folio."',".$modelos[$c].",'Equipo ".($c + 1)."','-','-','Repisa Nueva')";
        mysql_query($query);        
    }
}

function sendmail($folio,$central,$noequipos,$ctemail,$rsemail,$cpemail,$cc,$fecha_solicitud,$modelos){
    $division;$area;$siglas;$nsitio;$clli;$calle;$numero;$localidad;$ciudad;$estado;$cp;$longitud;$latitud;
    $original = array('°','�?','É','�?','Ó','Ú','á','é','í','ó','ú','Ñ','ñ');
    $nuevo = array('&deg;','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;','&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','&Ntilde;','&ntilde;');
    $fecha_solicitud = explode(' ',$fecha_solicitud);
    $hora = $fecha_solicitud[1];
    $fecha_solicitud[0] = datetransform($fecha_solicitud[0]);
    
    /*  COMIENZA DATOS DE INGENIERÍA PROYECTOS TELMEX, RESPONSABLE DE SITIO, PROVEEDOR Y PUNTO DE REUNION*/
    $contactos = '<br/><table border="1"><tr><th colspan="4">DATOS RESPONSABLE INGENIER&Iacute;A PROYECTO</th></tr>';
    $datos ="SELECT ctnombre,cttelefono,ctemail,ctmovil,rsnombre,rstelefono,rsemail,rsmovil,cpnombre,cptelefono,cpemail,cpmovil,punto_reunion FROM zsite_survey WHERE folio='".$folio."'";
    $datosResult = mysql_query($datos);
    $dsz = mysql_num_rows($datosResult);
    if($dsz > 0){
        
            $dd = mysql_fetch_array($datosResult);
            $contactos .= '<tr><td>'.$dd['ctnombre'].'</td><td>'.$dd['cttelefono'].'</td><td>'.$dd['ctemail'].'</td><td>'.$dd['ctmovil'].'</td></tr>';
			$contactos .= '<tr><th colspan="4">DATOS RESPONSABLE EN SITIO</th></tr>';
            $contactos .= '<tr><td>'.$dd['rsnombre'].'</td><td>'.$dd['rstelefono'].'</td><td>'.$dd['rsemail'].'</td><td>'.$dd['rsmovil'].'</td></tr>';
            $contactos .= '<tr><th colspan="4">DATOS CONTACTO PROVEEDOR</th></tr>';
            $contactos .= '<tr><td>'.$dd['cpnombre'].'</td><td>'.$dd['cptelefono'].'</td><td>'.$dd['cpemail'].'</td><td>'.$dd['cpmovil'].'</td></tr>';
            $contactos .= '<tr><th colspan="4">PUNTO DE REUNION</th></tr>';
            $contactos .= '<tr><td colspan="4">'.$dd['punto_reunion'].'</td></tr>';
        
    }
    $contactos .= '</table>';
    /*  FINALIZA DATOS DE TELMEX, PROVEEDOR Y PUNTO DE REUNION*/
    
    $datos_cen = "SELECT dir_div,area,sigcent,edificio,clli_edif,calle,num_ext,localidad,municipio,edo,c_p,latitud,longitud FROM centrales WHERE id_ctl = ".$central." ;";
    $data = mysql_query($datos_cen);
    for($a = 0; $a < 1; $a++){
        $dc = mysql_fetch_array($data);
        $division = str_replace($original, $nuevo, $dc['dir_div']);
        if($division == '' || $division == NULL){
            $division = 'N/A';
        }
        $area = str_replace($original, $nuevo, $dc['area']);
        if($area == '' || $area == NULL){
            $area = 'N/A';
        }
        $siglas = $dc['sigcent'];
        if($siglas == '' || $siglas == NULL){
            $siglas = 'N/A';
        }
        $nsitio = str_replace($original, $nuevo, $dc['edificio']);
        if($nsitio == '' || $nsitio == NULL){
            $nsitio = 'N/A';
        }
        $clli = $dc['clli_edif'];
        if($clli == '' || $clli == NULL){
            $clli = 'N/A';
        }
        $calle = str_replace($original, $nuevo, $dc['calle']);
        if($calle == '' || $calle == NULL){
            $calle = 'N/A';
        }
        $numero = $dc['num_ext'];
        if($numero == '' || $numero == NULL){
            $numero = 'N/A';
        }
        $localidad = str_replace($original, $nuevo, $dc['localidad']);
        if($localidad == '' || $localidad == NULL){
            $localidad = 'N/A';
        }
        $ciudad = str_replace($original, $nuevo, $dc['municipio']);
        if($ciudad == '' || $ciudad == NULL){
            $ciudad = 'N/A';
        }
        $estado = $dc['edo'];
        if($estado == '' || $estado == NULL){
            $estado = 'N/A';
        }
        $cp = $dc['c_p'];
        if($cp == '' || $cp == NULL){
            $cp = 'N/A';
        }
        $longitud = str_replace($original, $nuevo, $dc['latitud']);
        if($longitud == '' || $longitud == NULL){
            $longitud = 'N/A';
        }
        $latitud = str_replace($original, $nuevo, $dc['longitud']);
        if($latitud == '' || $latitud == NULL){
            $latitud = 'N/A';
        }
    }
    
//    $division = str_replace($original, $nuevo, $division);
//    $area = str_replace($original, $nuevo, $area);
//    $nsitio = str_replace($original, $nuevo, $nsitio);
//    $calle = str_replace($original, $nuevo, $calle);
//    $numero = str_replace($original, $nuevo, $numero);
//    $localidad = str_replace($original, $nuevo, $localidad);
//    $ciudad = str_replace($original, $nuevo, $ciudad);
//    $latitud = str_replace($original, $nuevo, $latitud);
//    $longitud = str_replace($original, $nuevo, $longitud);
    
    $equipos = '';
    for($e = 0; $e < $noequipos; $e++){
        //$equipos .= '<tr><td>'.$modelos[$e].'</td><td>'.$rubro.'</td><td>'.$proveedor.'</td><td>'.$tecnologia.'</td></tr>';
        $datatec = "SELECT rubro, proveedor, tecnologia, tipo_equipo FROM ztecnologias WHERE id = ".$modelos[$e]."";
        $datos = mysql_query($datatec);
        for($i = 0; $i < 1; $i++){
            $eqs = mysql_fetch_array($datos);
            $equipos .= '<tr><td>'.$eqs['tipo_equipo'].'</td><td>'.$eqs['rubro'].'</td><td>'.$eqs['proveedor'].'</td><td>'.$eqs['tecnologia'].'</td></tr>';
        }
    }
//    $concopia = '';
    $mimemail = new nomad_mimemail();
    $smtp_host	= "10.192.10.25";
    //$smtp_user	= "frida";
    $smtp_pass	= "Fridainfinitum";
    $mensaje = '<html><head><style type="text/css">body{font-family:Arial}h1{font-size:16pt}table{border-collapse:collapse}table tr th,table tr td{text-align:center;border-top:1px #fff solid;font-size:13px;padding:8px}table tr td{background:#E8EDFF;color:#669}table tr th{background:#B9C9FE;color:#039}span{color:#f00;font-weight:bold}h1#folio{color:#f00;float:right;margin:-39px 0 0}</style></head><body><h1>Alta de Site Survey</h1><h1 id="folio">FOLIO: '.$folio.'</h1><p>Se ha generado una fecha propuesta para la realizaci&oacute; del Site Survey en la Central <b>'.$nsitio.'.</b> con el siguiente folio <span>'.$folio.'</span>. Los datos de la central son los siguientes</p><table><tr><th>DIVISI&Oacute;N</th><th colspan="2">&Aacute;REA</th><th>SIGLAS</th></tr><tr><td>'.$division.'</td><td colspan="2">'.$area.'</td><td>'.$siglas.'</td></tr><tr><th>NOMBRE DEL SITIO</th><th>CLLI Central</th><th>CALLE</th><th>N&Uacute;MERO</th></tr><tr><td>'.$nsitio.'</td><td>'.$clli.'</td><td>'.$calle.'</td><td>'.$numero.'</td></tr><tr><th>LOCALIDAD</th><th>CIUDAD</th><th>ESTADO</th><th>C&Oacute;DIGO POSTAL</th></tr><tr><td>'.$localidad.'</td><td>'.$ciudad.'</td><td>'.$estado.'</td><td>'.$cp.'</td></tr><tr><th colspan="2">LATITUD</th><th colspan="2">LONGITUD</th></tr><tr><td colspan="2">'.$latitud.'</td><td colspan="2">'.$longitud.'</td></tr><tr><th>MODELO</th><th>RUBRO</th><th>PROVEEDOR</th><th>TECNOLOG&Iacute;A</th></tr>'.$equipos.'</table><br/>'.$contactos.'<p>La fecha propuesta es el '.$fecha_solicitud[0].' a las '.$hora.'</p><br/></body></html>';
//	, para confirmar o modificar la fecha, acceda al siguiente enlace:<br/><a href="http://frida/infinitum/ssv2/validar.php?f='.$folio.'&t=p">Validar fecha propuesta</a>	
//    print_r($datos);
    $mimemail->set_from("frida@telmex.com","FRIDA");
    //$mimemail->set_to("juliocvm243@gmail.com");
    $mimemail->set_to($cpemail);
    $max = count($cc);
    for($i = 0; $i < $max; $i++){
        $mimemail->add_cc($cc[$i]);
    }
	$mimemail->add_cc($ctemail);
    $mimemail->set_subject("Site Survey - Alta");
    $mimemail->set_html($mensaje);

    $mimemail->set_smtp_host($smtp_host);
    $mimemail->set_smtp_auth($smtp_user, $smtp_pass);

    if ($mimemail->send()){
        //echo "The MIME Mail has been sent";
    }
    else {
        //echo "An error has occurred, mail was not sent";
    }
    unset($mimemail);
/*--------------------------------------------------------------
 * CORREO PARA EL CONTACTO DE TELMEX, CON EL ENLACE PARA VALIDAR
 ---------------------------------------------------------------*/
    $mimemail = new nomad_mimemail();
    $mimemail->set_from("frida@telmex.com","FRIDA");
    $mimemail->set_to($rsemail);
    $mimemail->set_subject("Site Survey - Alta (Confirmar Fechas)");
    $mensaje2 = '<html><head><style type="text/css">body{font-family:Arial}h1{font-size:16pt}table{border-collapse:collapse}table tr th,table tr td{text-align:center;border-top:1px #fff solid;font-size:13px;padding:8px}table tr td{background:#E8EDFF;color:#669}table tr th{background:#B9C9FE;color:#039}span{color:#f00;font-weight:bold}h1#folio{color:#f00;float:right;margin:-39px 0 0}</style></head><body><h1>Confirmar Fecha de Site Survey</h1><h1 id="folio">FOLIO: '.$folio.'</h1><p>Se ha generado una fecha propuesta para la realizaci&oacute; del Site Survey en la Central <b>'.$nsitio.'.</b> con el siguiente folio <span>'.$folio.'</span>. Los datos de la central son los siguientes</p><table><tr><th>DIVISI&Oacute;N</th><th colspan="2">&Aacute;REA</th><th>SIGLAS</th></tr><tr><td>'.$division.'</td><td colspan="2">'.$area.'</td><td>'.$siglas.'</td></tr><tr><th>NOMBRE DEL SITIO</th><th>CLLI Central</th><th>CALLE</th><th>N&Uacute;MERO</th></tr><tr><td>'.$nsitio.'</td><td>'.$clli.'</td><td>'.$calle.'</td><td>'.$numero.'</td></tr><tr><th>LOCALIDAD</th><th>CIUDAD</th><th>ESTADO</th><th>C&Oacute;DIGO POSTAL</th></tr><tr><td>'.$localidad.'</td><td>'.$ciudad.'</td><td>'.$estado.'</td><td>'.$cp.'</td></tr><tr><th colspan="2">LATITUD</th><th colspan="2">LONGITUD</th></tr><tr><td colspan="2">'.$latitud.'</td><td colspan="2">'.$longitud.'</td></tr><tr><th>MODELO</th><th>RUBRO</th><th>PROVEEDOR</th><th>TECNOLOG&Iacute;A</th></tr>'.$equipos.'</table><br/>'.$contactos.'<p>La fecha propuesta es el '.$fecha_solicitud[0].' a las '.$hora.', para confirmar o modificar la fecha, acceda al siguiente enlace:<br/><a href="http://frida/infinitum/ssv2/validar.php?f='.$folio.'&t=t">Validar fecha propuesta</a></p></body></html>';
    $mimemail->set_html($mensaje2);
    $mimemail->set_smtp_host($smtp_host);
    $mimemail->set_smtp_auth($smtp_user, $smtp_pass);
    $mimemail->send();
    
}

function mailconfirm($folio){
    $equipos;
    $QueryDatosGenerales = mysql_query("SELECT centrales.dir_div,centrales.area,centrales.sigcent,centrales.edificio,centrales.clli_edif,centrales.calle,centrales.num_ext,centrales.localidad,centrales.municipio,centrales.edo,centrales.c_p,centrales.latitud,centrales.longitud,zsite_survey.ctnombre,zsite_survey.cttelefono,zsite_survey.ctemail,zsite_survey.ctmovil,zsite_survey.rsnombre,zsite_survey.rstelefono,zsite_survey.rsemail,zsite_survey.rsmovil,zsite_survey.cpnombre,zsite_survey.cptelefono,zsite_survey.cpemail,zsite_survey.cpmovil,zsite_survey.punto_reunion,DATE(zsite_survey.fecha_programada) fecha,TIME(zsite_survey.fecha_programada) hora,zsite_survey.rubro FROM centrales,zsite_survey WHERE zsite_survey.folio='".$folio."' AND centrales.id_ctl=zsite_survey.id_central");
    $DatosGenerales = mysql_fetch_row($QueryDatosGenerales);
    
    if($DatosGenerales[28] == 0){//TRANSPORTE
        //  DATOS DE EQUIPO
        $equipos = '<tr><th>NOMBRE</th><th>UBICACI&Oacute;N</th><th>PUERTOS</th><th>TARJETAS</th></tr>';
        $QueryEquipos = "SELECT nombre_equipo,ubicacion,puertos,tarjetas FROM zss_equipos WHERE folio='".$folio."'";
        $ResultEquipos = mysql_query($QueryEquipos);
        $sz = mysql_num_rows($ResultEquipos);
        if($sz > 0){
            for($i = 0; $i < $sz; $i++){
                $d = mysql_fetch_array($ResultEquipos);
                $equipos .= '<tr><td>'.$d['nombre_equipo'].'</td><td>'.$d['ubicacion'].'</td><td>'.$d['puertos'].'</td><td>'.$d['tarjetas'].'</td></tr>';
            }
        }
    }
    else{//  ACCESO
        $equipos = '<tr><th>RUBRO</th><th>PROVEEDOR</th><th>TECNOLOGIA</th><th>EQUIPO</th></tr>';
        $QueryEquipos = "SELECT ztecnologias.rubro,ztecnologias.proveedor,ztecnologias.tecnologia,ztecnologias.tipo_equipo FROM ztecnologias,zss_equipos WHERE ztecnologias.id=zss_equipos.id_tecnologia AND zss_equipos.folio='".$folio."'";
        $ResultEquipos = mysql_query($QueryEquipos);
        $sz = mysql_num_rows($ResultEquipos);
        if($sz > 0){
            for($i = 0; $i < $sz; $i++){
                $d = mysql_fetch_array($ResultEquipos);
                $equipos .= '<tr><td>'.$d['rubro'].'</td><td>'.$d['proveedor'].'</td><td>'.$d['tecnologia'].'</td><td>'.$d['tipo_equipo'].'</td></tr>';
            }
        }        
    }
    
    $direcciones = array($DatosGenerales[15],$DatosGenerales[19],$DatosGenerales[23]);
    
    $QueryDirecciones = "SELECT email FROM zccemails WHERE folio='".$folio."'";
    $ResultDirecciones = mysql_query($QueryDirecciones);
    $sz2 = mysql_num_rows($ResultDirecciones);
    $c=3;
    if($sz2 > 0){
        for($j = 0; $j < $sz2; $j++){
            $d2 = mysql_fetch_array($ResultDirecciones);
            $direcciones[$c] = $d2['email'];
            $c++;
        }
    }
    
    $mensaje = '<html><head><style type="text/css">body{font-family:Arial}h1{font-size:16pt}table{border-collapse:collapse}table tr th,table tr td{text-align:center;border-top:1px #fff solid;font-size:13px;padding:8px}table tr td{background:#E8EDFF;color:#669}table tr th{background:#B9C9FE;color:#039}span{color:#f00;font-weight:bold}h1#folio{color:#f00;float:right;margin:-39px 0 0}</style></head><body><p>La fecha de programacion para la realizaci&oacute; del Site Survey con el siguiente folio <b>'.$folio.'</b> en la Central <b>'.$DatosGenerales[3].'.</b> esta confirmada para el d&iacute;a '.datetransform($DatosGenerales[26]).' a las '.$DatosGenerales[27].'. Los datos de la central son los siguientes</p><table><tr><th>DIVISI&Oacute;N</th><th colspan="2">&Aacute;REA</th><th>SIGLAS</th></tr><tr><td>'.$DatosGenerales[0].'</td><td colspan="2">'.$DatosGenerales[1].'</td><td>'.$DatosGenerales[2].'</td></tr><tr><th>NOMBRE DEL SITIO</th><th>CLLI Central</th><th>CALLE</th><th>N&Uacute;MERO</th></tr><tr><td>'.$DatosGenerales[3].'</td><td>'.$DatosGenerales[4].'</td><td>'.$DatosGenerales[5].'</td><td>'.$DatosGenerales[6].'</td></tr><tr><th>LOCALIDAD</th><th>CIUDAD</th><th>ESTADO</th><th>C&Oacute;DIGO POSTAL</th></tr><tr><td>'.$DatosGenerales[7].'</td><td>'.$DatosGenerales[8].'</td><td>'.$DatosGenerales[9].'</td><td>'.$DatosGenerales[10].'</td></tr><tr><th colspan="2">LATITUD</th><th colspan="2">LONGITUD</th></tr><tr><td colspan="2">'.$DatosGenerales[11].'</td><td colspan="2">'.$DatosGenerales[12].'</td></tr><tr><th colspan="4">PUNTO DE REUNI&Oacute;N</th></tr><tr><td colspan="4">'.$DatosGenerales[25].'</td></tr>'.$equipos.'</table></br><table><tr><th colspan="4">DATOS COORDINADOR TELMEX</th></tr><tr><td><b>Nombre</b></td><td><b>Tel&eacute;fono</b></td><td><b>Correo Electr&oacute;nico</b></td><td><b>N&uacute;mero Celular</b></td></tr><tr><td>'.$DatosGenerales[13].'</td><td>'.$DatosGenerales[14].'</td><td>'.$DatosGenerales[15].'</td><td>'.$DatosGenerales[16].'</td></tr><tr><th colspan="4">DATOS RESPONSABLE SITIO</th></tr><tr><td><b>Nombre</b></td><td><b>Tel&eacute;fono</b></td><td><b>Correo Electr&oacute;nico</b></td><td><b>N&uacute;mero Celular</b></td></tr><tr><td>'.$DatosGenerales[17].'</td><td>'.$DatosGenerales[18].'</td><td>'.$DatosGenerales[19].'</td><td>'.$DatosGenerales[20].'</td></tr><tr><th colspan="4">DATOS PROVEEDOR</th></tr><tr><td><b>Nombre</b></td><td><b>Tel&eacute;fono</b></td><td><b>Correo Electr&oacute;nico</b></td><td><b>N&uacute;mero Celular</b></td></tr><tr><td>'.$DatosGenerales[21].'</td><td>'.$DatosGenerales[22].'</td><td>'.$DatosGenerales[23].'</td><td>'.$DatosGenerales[24].'</td></tr></table></body></html>';
    
    $correo = new Mail($direcciones,'Site Survey - Programado',$mensaje);
}

function rubro(){
    $rubro = '<option value>Seleccionar</option>';
    $query = "SELECT rubro FROM ztecnologias WHERE id > 0 GROUP BY rubro ORDER BY rubro ASC";
    $salida = mysql_query($query);
    $tam = mysql_num_rows($salida);
    if($tam > 0){
        for($a = 0; $a < $tam; $a++){
            $rb = mysql_fetch_array($salida);
            $rubro .= '<option value="'.$rb['rubro'].'">'.$rb['rubro'].'</option>';
        }
    }
    return $rubro;
}

function correoss($folio,$tipo){
    $ccemails = array();
    $correoTelmex;
    $correoProv;
    $correoRS;
    $ruta;
    if($tipo == 'N'){
        $ruta = 'formato';
    }
    else{
        $ruta = 'adecuacion';
    }
    $query = "SELECT email FROM zccemails WHERE folio = '".$folio."';";
    $correos = mysql_query($query);
    $max = mysql_num_rows($correos);
    if($max > 0){
        for($i = 0; $i < $max; $i++){
            $email = mysql_fetch_array($correos);
            $ccemails[$i] = $email['email'];
        }
    }
    
    $query2 = "SELECT ctemail, cpemail,rsemail FROM zsite_survey WHERE folio = '".$folio."';";
    $correos2 = mysql_query($query2);
    $max2 = mysql_num_rows($correos2);
    if($max2 > 0){
        for($j = 0; $j < $max2; $j++){
            $email2 = mysql_fetch_array($correos2);
            $correoTelmex = $email2['ctemail'];
            $correoProv = $email2['cpemail'];
            $correoRS = $email2['rsemail'];
        }
    }
    
    //CORREO PARA PROVEEDOR Y COPIAS
    $mimemail = new nomad_mimemail();
    $smtp_host	= "10.192.10.25";
    $smtp_pass	= "Fridainfinitum";
    $style='*{font-family:\'Arial\'}.header{background-color:#4c5a77;background-image:-webkit-linear-gradient(top,#5e6985,#3e4d6c);background-image:-moz-linear-gradient(top,#5e6985,#3e4d6c);background-image:-ms-linear-gradient(top,#5e6985,#3e4d6c);background-image:-o-linear-gradient(top,#5e6985,#3e4d6c);background-image:linear-gradient(top,#5e6985,#3e4d6c);filter:progid:DXImageTransform.Microsoft.Gradient(startColorstr=\'#5e6985\',endColorstr=\'#3e4d6c\');-webkit-box-shadow:0 9px 9px 0 rgba(50,50,50,0.3);-moz-box-shadow:0 9px 9px 0 rgba(50,50,50,0.3);box-shadow:0 9px 9px 0 rgba(50,50,50,0.3);-ms-filter:"progid:DXImageTransform.Microsoft.Shadow(Strength=9,Direction=180,Color=\'#999999\')";filter:progid:DXImageTransform.Microsoft.Shadow(Strength=9,Direction=180,Color=\'#999999\');border-left:1px #3d4569 solid;border-bottom:1px #3d4569 solid;border-right:1px #3d4569 solid;height:92px;width:100%;margin:0 auto 30px;text-align:left;padding:18px 0 0}.header h1{color:#fff;font-weight:100;letter-spacing:-2px;text-decoration:none;padding:0 0 0 3%;margin:0}.header h2{color:#E1C70E;font-size:19px;font-weight:100;letter-spacing:-1px;padding:0 0 0 3%;margin:5px 0 0}p{font-size:12pt;color:#414141}a{color:#08f}.f{font-weight:700;color:red}.m{float:left;width:100%;height:1px;background:#888;margin:0 0 20px}';
    $mensaje = '<html><head><style type="text/css">*{font-family:\'Arial\'}.header{background-color:#4c5a77;background-image:-webkit-linear-gradient(top,#5e6985,#3e4d6c);background-image:-moz-linear-gradient(top,#5e6985,#3e4d6c);background-image:-ms-linear-gradient(top,#5e6985,#3e4d6c);background-image:-o-linear-gradient(top,#5e6985,#3e4d6c);background-image:linear-gradient(top,#5e6985,#3e4d6c);filter:progid:DXImageTransform.Microsoft.Gradient(startColorstr=\'#5e6985\',endColorstr=\'#3e4d6c\');-webkit-box-shadow:0 9px 9px 0 rgba(50,50,50,0.3);-moz-box-shadow:0 9px 9px 0 rgba(50,50,50,0.3);box-shadow:0 9px 9px 0 rgba(50,50,50,0.3);-ms-filter:"progid:DXImageTransform.Microsoft.Shadow(Strength=9,Direction=180,Color=\'#999999\')";filter:progid:DXImageTransform.Microsoft.Shadow(Strength=9,Direction=180,Color=\'#999999\');border-left:1px #3d4569 solid;border-bottom:1px #3d4569 solid;border-right:1px #3d4569 solid;height:92px;width:100%;margin:0 auto 30px;text-align:left;padding:18px 0 0}.header h1{color:#fff;font-weight:100;letter-spacing:-2px;text-decoration:none;padding:0 0 0 3%;margin:0}.header h2{color:#E1C70E;font-size:19px;font-weight:100;letter-spacing:-1px;padding:0 0 0 3%;margin:5px 0 0}p{font-size:12pt;color:#414141}a{color:#08f}.f{font-weight:700;color:red}.m{float:left;width:100%;height:1px;background:#888;margin:0 0 20px}</style></head><body><div class="header"><h1>F R I D A</h1><h2>Site Survey</h2></div><p>El Site Survey con el siguiente folio <span class="f">'.$folio.'</span> se ha enviado a validaci&oacute;n con el <b>responsable el sitio</b>.</p></body></html>';
    $mimemail->set_from("frida@telmex.com","FRIDA");
    $mimemail->set_to($correoProv);
    for($k = 0; $k < count($ccemails); $k++){
        $mimemail->add_cc($ccemails[$k]);
    }
    $mimemail->set_subject("Site Survey - Por Validar (OPERACION)");
    $mimemail->set_html($mensaje);
    $mimemail->set_smtp_host($smtp_host);
    $mimemail->set_smtp_auth($smtp_user, $smtp_pass);
    $mimemail->send();
    
    //CORREO PARA RESPONSABLE EN SITIO
    unset($mimemail);
    unset($mensaje);
    $mimemail = new nomad_mimemail();
    $mensaje = '<html><head><style type="text/css">*{font-family:\'Arial\'}.header{background-color:#4c5a77;background-image:-webkit-linear-gradient(top,#5e6985,#3e4d6c);background-image:-moz-linear-gradient(top,#5e6985,#3e4d6c);background-image:-ms-linear-gradient(top,#5e6985,#3e4d6c);background-image:-o-linear-gradient(top,#5e6985,#3e4d6c);background-image:linear-gradient(top,#5e6985,#3e4d6c);filter:progid:DXImageTransform.Microsoft.Gradient(startColorstr=\'#5e6985\',endColorstr=\'#3e4d6c\');-webkit-box-shadow:0 9px 9px 0 rgba(50,50,50,0.3);-moz-box-shadow:0 9px 9px 0 rgba(50,50,50,0.3);box-shadow:0 9px 9px 0 rgba(50,50,50,0.3);-ms-filter:"progid:DXImageTransform.Microsoft.Shadow(Strength=9,Direction=180,Color=\'#999999\')";filter:progid:DXImageTransform.Microsoft.Shadow(Strength=9,Direction=180,Color=\'#999999\');border-left:1px #3d4569 solid;border-bottom:1px #3d4569 solid;border-right:1px #3d4569 solid;height:92px;width:100%;margin:0 auto 30px;text-align:left;padding:18px 0 0}.header h1{color:#fff;font-weight:100;letter-spacing:-2px;text-decoration:none;padding:0 0 0 3%;margin:0}.header h2{color:#E1C70E;font-size:19px;font-weight:100;letter-spacing:-1px;padding:0 0 0 3%;margin:5px 0 0}p{font-size:12pt;color:#414141}a{color:#08f}.f{font-weight:700;color:red}.m{float:left;width:100%;height:1px;background:#888;margin:0 0 20px}</style></head><body><div class="header"><h1>F R I D A</h1><h2>Site Survey</h2></div><p>El Site Survey con el siguiente folio <span class="f">'.$folio.'</span> se ha enviado para su validaci&oacute;n. De clic en el siguiente enlace para validar o rechazar el Site Survey.</p><a href="http://frida/infinitum/ssv2/formato.php?folio='.$folio.'&tv=1">http://frida/infinitum/ssv2/formato.php?folio='.$folio.'&tv=1</a></body></html>';
    $mimemail->set_from("frida@telmex.com","FRIDA");
    $mimemail->set_to($correoRS);
    $mimemail->set_subject("Site Survey - Por Validar (OPERACION)");
    $mimemail->set_html($mensaje);
    $mimemail->set_smtp_host($smtp_host);
    $mimemail->set_smtp_auth($smtp_user, $smtp_pass);
    $mimemail->send();
    
    //CORREO PARA CONTACTO TELMEX
//    
//    unset($mimemail);
//    unset($mensaje);
//    $mimemail = new nomad_mimemail();
//    $mensaje = '<html><head></head><body>El Site Survey con el siguiente folio <b style="color:#foo">'.$folio.'</b> se ha enviado a validaci&oacute;n.<br/><br/>Para validar o rechazar el Site Survey, siga el siguiente enlace <a href="http://frida/infinitum/ssv2/'.$ruta.'.php?folio='.$folio.'">http://frida/infinitum/ssv2/'.$ruta.'.php?folio='.$folio.'</a></body></html>';
//    $mimemail->set_from("frida@telmex.com","FRIDA");
//    $mimemail->set_to($correoTelmex);
//    $mimemail->set_subject("Site Survey - Por Validar");
//    $mimemail->set_html($mensaje);
//    $mimemail->set_smtp_host($smtp_host);
//    $mimemail->set_smtp_auth($smtp_user, $smtp_pass);
//    $mimemail->send();
}

function datosusuario($usuario){
    $salida = array();
    $datos = "SELECT * FROM usuarios WHERE login = '".$usuario."';";
    $regreso = mysql_query($datos);
    $mx = mysql_num_rows($regreso);
    if($mx > 0){
        for($i = 0; $i < $mx; $i++){
            $registro = mysql_fetch_array($regreso);
            $salida[0] = $registro['nombre'];
            $salida[1] = $registro['email'];
            $salida[2] = $registro['empresa'];      
           

        }
    }
    return $salida;
}

//  GUARDADO INICIAL DE ACCESO
function guardarEquiposNuevos($datos,$folio){
    for($i = 0; $i < count($datos); $i++){
        $insert = "INSERT INTO zss_equipos(id,folio,id_tecnologia,nombre_equipo,puertos,tarjetas,tipo_trabajo) VALUES(id,'".$folio."','".$datos[$i][1]."','".$datos[$i][0]."','".$datos[$i][2]."','".$datos[$i][3]."','".$datos[$i][4]."')";
        mysql_query($insert);
    }
}

function guardarEquiposExistentes($datos,$folio){
    for($i = 0; $i < count($datos[$i]); $i++){
        $insert = "INSERT INTO zss_equipos(id,folio,id_tecnologia,nombre_equipo,puertos,tarjetas,tipo_trabajo,ubicacion,nuevoExistente,espacio) VALUES(id,'".$folio."','".$datos[$i][1]."','".$datos[$i][0]."','".$datos[$i][2]."','".$datos[$i][3]."','".$datos[$i][4]."',(SELECT ubicacion FROM isam_unica WHERE nombre_oficial_pisa='".$datos[$i][0]."'),'Existente','Existente')";
        mysql_query($insert);
    }
}

//  ARMAR MENSAJE DE CORREO DE ACCESO
function correoAcceso($folio){
    $ruta = 'http://frida/infinitum/ssv2/validar.php?f='.$folio;
    $link = '<br/>Para validar o rechazar el Site Survey, siga el siguiente enlace <a href="'.$ruta.'">'.$ruta.'</a>';
    
    $equipos = '<tr><th>NOMBRE</th><th>TIPO DE TRABAJO</th><th>UBICACI&Oacute;N</th><th>PUERTOS</th><th>TARJETAS</th></tr>';
    //  DATOS GENERALES
    $QueryDatosGenerales = mysql_query("SELECT centrales.dir_div,centrales.area,centrales.sigcent,centrales.edificio,centrales.clli_edif,centrales.calle,centrales.num_ext,centrales.localidad,centrales.municipio,centrales.edo,centrales.c_p,centrales.latitud,centrales.longitud,zsite_survey.ctnombre,zsite_survey.cttelefono,zsite_survey.ctemail,zsite_survey.ctmovil,zsite_survey.rsnombre,zsite_survey.rstelefono,zsite_survey.rsemail,zsite_survey.rsmovil,zsite_survey.cpnombre,zsite_survey.cptelefono,zsite_survey.cpemail,zsite_survey.cpmovil,zsite_survey.punto_reunion,DATE(zsite_survey.fecha_programada) fecha,TIME(zsite_survey.fecha_programada) hora, zsite_survey.rubro FROM centrales,zsite_survey WHERE zsite_survey.folio='".$folio."' AND centrales.id_ctl=zsite_survey.id_central");
    $DatosGenerales = mysql_fetch_row($QueryDatosGenerales);
    
    //  DATOS DE EQUIPO
    $QueryEquipos = "SELECT nombre_equipo,tipo_trabajo,ubicacion,puertos,tarjetas FROM zss_equipos WHERE folio='".$folio."'";
    $ResultEquipos = mysql_query($QueryEquipos);
    $sz = mysql_num_rows($ResultEquipos);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $d = mysql_fetch_array($ResultEquipos);
            $equipos .= '<tr><td>'.$d['nombre_equipo'].'</td><td>'.$d['tipo_trabajo'].'</td><td>'.$d['ubicacion'].'</td><td>'.$d['puertos'].'</td><td>'.$d['tarjetas'].'</td></tr>';
        }
    }
    $mensaje = '<html><head><style type="text/css">body{font-family:Arial}h1{font-size:16pt}table{border-collapse:collapse}table tr th,table tr td{text-align:center;border-top:1px #fff solid;font-size:13px;padding:8px}table tr td{background:#e8edff;color:#669}table tr th{background:#b9c9fe;color:#039}span{color:#f00;font-weight:bold}h1#folio{color:#f00;float:right;margin:-39px 0 0}</style></head><body><h1>Validaci&oacute;n de Site Survey </h1><h1 id="folio">FOLIO: '.$folio.'</h1><p>Se ha generado una fecha propuesta para la realizaci&oacute; del Site Survey en la Central <b>'.$DatosGenerales[3].' </b>con el siguiente folio <span>'.$folio.'</span>. Los datos de la central son los siguientes</p><table><tr><th>DIVISI&Oacute;N</th><th colspan="3">&Aacute;REA</th><th>SIGLAS</th></tr><tr><td>'.$DatosGenerales[0].'</td><td colspan="3">'.$DatosGenerales[1].'</td><td>'.$DatosGenerales[2].'</td></tr><tr><th colspan="2">NOMBRE DEL SITIO</th><th>CLLI Central</th><th>CALLE</th><th>N&Uacute;MERO</th></tr><tr><td colspan="2">'.$DatosGenerales[3].'</td><td>'.$DatosGenerales[4].'</td><td>'.$DatosGenerales[5].'</td><td>'.$DatosGenerales[6].'</td></tr><tr><th colspan="2">LOCALIDAD</th><th>CIUDAD</th><th>ESTADO</th><th>C&Oacute;DIGO POSTAL</th></tr><tr><td colspan="2">'.$DatosGenerales[7].'</td><td>'.$DatosGenerales[8].'</td><td>'.$DatosGenerales[9].'</td><td>'.$DatosGenerales[10].'</td></tr><tr><th colspan="3">LATITUD</th><th colspan="2">LONGITUD</th></tr><tr><td colspan="3">'.$DatosGenerales[11].'</td><td colspan="2">-'.$DatosGenerales[12].'</td></tr><tr><th colspan="5">PUNTO DE REUNI&Oacute;N</th></tr><tr><td colspan="5">'.$DatosGenerales[25].'</td></tr>'.$equipos.'<tr><th colspan="5">DATOS COORDINADOR TELMEX</th></tr><tr><td colspan="2"><b>Nombre</b></td><td><b>Tel&eacute;fono</b></td><td><b>Correo Electr&oacute;nico</b></td><td><b>N&uacute;mero Celular</b></td></tr><tr><td colspan="2">'.$DatosGenerales[13].'</td><td>'.$DatosGenerales[14].'</td><td>'.$DatosGenerales[15].'</td><td>'.$DatosGenerales[16].'</td></tr><tr><th colspan="5">DATOS RESPONSABLE SITIO</th></tr><tr><td colspan="2"><b>Nombre</b></td><td><b>Tel&eacute;fono</b></td><td><b>Correo Electr&oacute;nico</b></td><td><b>N&uacute;mero Celular</b></td></tr><tr><td colspan="2">'.$DatosGenerales[17].'</td><td>'.$DatosGenerales[18].'</td><td>'.$DatosGenerales[19].'</td><td>'.$DatosGenerales[20].'</td></tr><tr><th colspan="5">DATOS PROVEEDOR</th></tr><tr><td colspan="2"><b>Nombre</b></td><td><b>Tel&eacute;fono</b></td><td><b>Correo Electr&oacute;nico</b></td><td><b>N&uacute;mero Celular</b></td></tr><tr><td colspan="2">'.$DatosGenerales[21].'</td><td>'.$DatosGenerales[22].'</td><td>'.$DatosGenerales[23].'</td><td>'.$DatosGenerales[24].'</td></tr></table><p>La fecha propuesta es el '.datetransform($DatosGenerales[26]).' a las '.$DatosGenerales[27].'</p><br/>'.$link.'</body></html>';
    $correoTelmex = new Mail(array($DatosGenerales[19]),'Validar fecha de realizacion Site Survey',$mensaje);
    
    //  COPIAS DE CORREO
    $link = '';
    $mensaje = '<html><head><style type="text/css">body{font-family:Arial}h1{font-size:16pt}table{border-collapse:collapse}table tr th,table tr td{text-align:center;border-top:1px #fff solid;font-size:13px;padding:8px}table tr td{background:#e8edff;color:#669}table tr th{background:#b9c9fe;color:#039}span{color:#f00;font-weight:bold}h1#folio{color:#f00;float:right;margin:-39px 0 0}</style></head><body><h1>Validaci&oacute;n de Site Survey </h1><h1 id="folio">FOLIO: '.$folio.'</h1><p>Se ha generado una fecha propuesta para la realizaci&oacute; del Site Survey en la Central <b>'.$DatosGenerales[3].' </b>con el siguiente folio <span>'.$folio.'</span>. Los datos de la central son los siguientes</p><table><tr><th>DIVISI&Oacute;N</th><th colspan="3">&Aacute;REA</th><th>SIGLAS</th></tr><tr><td>'.$DatosGenerales[0].'</td><td colspan="3">'.$DatosGenerales[1].'</td><td>'.$DatosGenerales[2].'</td></tr><tr><th colspan="2">NOMBRE DEL SITIO</th><th>CLLI Central</th><th>CALLE</th><th>N&Uacute;MERO</th></tr><tr><td colspan="2">'.$DatosGenerales[3].'</td><td>'.$DatosGenerales[4].'</td><td>'.$DatosGenerales[5].'</td><td>'.$DatosGenerales[6].'</td></tr><tr><th colspan="2">LOCALIDAD</th><th>CIUDAD</th><th>ESTADO</th><th>C&Oacute;DIGO POSTAL</th></tr><tr><td colspan="2">'.$DatosGenerales[7].'</td><td>'.$DatosGenerales[8].'</td><td>'.$DatosGenerales[9].'</td><td>'.$DatosGenerales[10].'</td></tr><tr><th colspan="3">LATITUD</th><th colspan="2">LONGITUD</th></tr><tr><td colspan="3">'.$DatosGenerales[11].'</td><td colspan="2">-'.$DatosGenerales[12].'</td></tr><tr><th colspan="5">PUNTO DE REUNI&Oacute;N</th></tr><tr><td colspan="5">'.$DatosGenerales[25].'</td></tr>'.$equipos.'<tr><th colspan="5">DATOS COORDINADOR TELMEX</th></tr><tr><td colspan="2"><b>Nombre</b></td><td><b>Tel&eacute;fono</b></td><td><b>Correo Electr&oacute;nico</b></td><td><b>N&uacute;mero Celular</b></td></tr><tr><td colspan="2">'.$DatosGenerales[13].'</td><td>'.$DatosGenerales[14].'</td><td>'.$DatosGenerales[15].'</td><td>'.$DatosGenerales[16].'</td></tr><tr><th colspan="5">DATOS RESPONSABLE SITIO</th></tr><tr><td colspan="2"><b>Nombre</b></td><td><b>Tel&eacute;fono</b></td><td><b>Correo Electr&oacute;nico</b></td><td><b>N&uacute;mero Celular</b></td></tr><tr><td colspan="2">'.$DatosGenerales[17].'</td><td>'.$DatosGenerales[18].'</td><td>'.$DatosGenerales[19].'</td><td>'.$DatosGenerales[20].'</td></tr><tr><th colspan="5">DATOS PROVEEDOR</th></tr><tr><td colspan="2"><b>Nombre</b></td><td><b>Tel&eacute;fono</b></td><td><b>Correo Electr&oacute;nico</b></td><td><b>N&uacute;mero Celular</b></td></tr><tr><td colspan="2">'.$DatosGenerales[21].'</td><td>'.$DatosGenerales[22].'</td><td>'.$DatosGenerales[23].'</td><td>'.$DatosGenerales[24].'</td></tr></table><p>La fecha propuesta es el '.datetransform($DatosGenerales[26]).' a las '.$DatosGenerales[27].'</p><br/>'.$link.'</body></html>';
    $direcciones = array($DatosGenerales[15],$DatosGenerales[23]);
    
    $QueryDirecciones = "SELECT email FROM zccemails WHERE folio='".$folio."'";
    $ResultDirecciones = mysql_query($QueryDirecciones);
    $sz2 = mysql_num_rows($ResultDirecciones);
    $c=2;
    if($sz2 > 0){
        for($j = 0; $j < $sz2; $j++){
            $d2 = mysql_fetch_array($ResultDirecciones);
            $direcciones[$c] = $d2['email'];
            $c++;
        }
    }
    $correo = new Mail($direcciones,'Site Survey - Alta',$mensaje);
}

function updateDatosPorEquipoTransporte($id,$ubicacion,$nuex,$espacio){
    $update = "UPDATE zss_equipos SET ubicacion='".$ubicacion."',nuevoExistente='".$nuex."',espacio='".$espacio."' WHERE id =".$id;
    
    mysql_query($update) or die(mysql_error());
   
}
function updateDatosPorEquipoAcceso($id,$ubicacion,$nuex,$puertos,$tarjetas,$espacio){
    $update = "UPDATE zss_equipos SET ubicacion='".$ubicacion."',nuevoExistente='".$nuex."',puertos='".$puertos."',tarjetas='".$tarjetas."',espacio='".$espacio."' WHERE id =".$id;
    mysql_query($update) or die(mysql_error());   

}
//updatedatosPorEquipoTransporte(281,'hola','hola2','hola3');
function obtid($modelo,$clase_repisa,$cod_tarjeta){
    $id = mysql_query("SELECT id FROM ztecnologias where tipo_equipo = '".$modelo."' AND clase_repisa = '".$clase_repisa."' and cod_tarjeta = '".$cod_tarjeta."'");
    $id = mysql_fetch_array($id, MYSQL_BOTH);
    return $id[0];
}
function getId($folio){
    $id = array();
    $query = "SELECT id FROM zss_equipos where folio='".$folio."'";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $d = mysql_fetch_array($result);
            $id[$i] = $d['id'];
        }
    }
    return $id;
}

function agregarInterFO($id,$folio,$ab){
    for($i = 0; $i < count($id); $i++){
        $insert = "INSERT INTO zinter_abfo(id,folio,alto_bajo,id_equipo,Tx_Rx) VALUES(id,'".$folio."',".$ab.",".$id[$i].",'Tx/Rx')";
        mysql_query($insert);
    }
}

function agregarInterFO_B($folio){
    $query = "select id,nombre_equipo from zss_equipos WHERE folio='".$folio."' AND tipo_trabajo!='Repisa Nueva'";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $d = mysql_fetch_array($result);
            $insert = "INSERT INTO zinter_abfo(id,folio,alto_bajo,id_equipo,ubicacion,Tx_Rx) VALUES(id,'".$folio."',1,".$d['id'].",(SELECT ubibdfo_dslam FROM isam_unica WHERE nombre_oficial_pisa='".$d['nombre_equipo']."'),'Tx/Rx')";
            mysql_query($insert);
        }
    }
}

function agregarMP($folio){
    $query = "SELECT id FROM zss_equipos WHERE folio='".$folio."' AND tipo_trabajo!='Repisa Nueva'";
    $result = mysql_query($query);
    $sz = mysql_num_rows($result);
    if($sz > 0){
        for($i = 0; $i < $sz; $i++){
            $d = mysql_fetch_array($result);
            $insert = "INSERT INTO zinter_mp(id,folio,id_equipo,pots_dsl) VALUES(id,'".$folio."',".$d['id'].",0)";
            mysql_query($insert);
            $insert2 = "INSERT INTO zinter_mp(id,folio,id_equipo,pots_dsl) VALUES(id,'".$folio."',".$d['id'].",1)";
            mysql_query($insert2);
        }
    }
}

function agregarCX($id,$folio){
    for($i = 0; $i < count($id); $i++){
        $insert = "INSERT INTO zinter_cx(id,folio,id_equipo) VALUES(id,'".$folio."',".$id[$i].")";
        mysql_query($insert);
    }
}

function agregarGS($id,$folio,$gs){
    for($i = 0; $i < count($id); $i++){
        $insert = "INSERT INTO zinter_gs (id,folio,id_equipo,gestionSincronia) VALUES (id,'".$folio."',".$id[$i].",".$gs.")";
        mysql_query($insert);
    }
}

function agregarFZ($id,$folio,$tr){
    for($i = 0; $i < count($id); $i++){
        $insert = "INSERT INTO zinter_fz(id,folio,id_equipo,trabajo_respaldo) VALUES(id,'".$folio."',".$id[$i].", ".$tr.")";
        mysql_query($insert);
    }
}

function inicializarCanaletas($folio){
    for($i = 2; $i < 8; $i++){
        for($j = 0; $j < 4; $j++){
            $insert = "INSERT INTO zcanaletas (id,folio,tag,aplica,material) VALUES(id,'".$folio."',".$i.",0,".$j.")";
            mysql_query($insert);
        }
    }
}

function modeloTransporte($transporte){
    $modelo = mysql_query("select id from ztecnologias where tecnologia = '".$transporte."' LIMIT 0,1");
    $modelo = mysql_fetch_array($modelo,MYSQL_BOTH);
    return $modelo[0];
}
//$folio = 'SS4520140929001';
//$id_equipo = getId($folio);
/*agregarInterFO($id_equipo,$folio,1);
agregarInterFO($id_equipo,$folio,0);
agregarCX($id_equipo,$folio);
agregarGS($id_equipo,$folio,0);
agregarGS($id_equipo,$folio,1);*/
//agregarFZ($id_equipo,$folio,0);
//agregarFZ($id_equipo,$folio,1);
//inicializarCanaletas($folio);