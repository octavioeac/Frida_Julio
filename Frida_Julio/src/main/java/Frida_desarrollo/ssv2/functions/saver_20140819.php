<?php
header("Content-Type: text/html;charset=utf-8");
require 'conexion.php';
function datetransform($fecha){
    $finaldate;
    $subdate = explode('-', $fecha);
    switch ($subdate[1]){
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
    require 'conexion.php';
    $query = "SELECT proveedor FROM ztecnologias GROUP BY proveedor ORDER BY proveedor ASC";
    $prov = mysql_query($query,$conectar2);
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
    $sqldiv = mysql_query("select cb_dd from siatel_areas where cb_ddnom='$division'");
    $clave_div = mysql_result($sqldiv,0,0);
    
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
function guardarss($folio,$tipoSiteSurvey,$central,$ctnombre,$cttelefono,$ctemail,$cpnombre,$cptelefono,$cpemail,$fecha_solicitud){
    require 'conexion.php';
    $query = "INSERT INTO zsite_survey (id, folio, nuevo_adecuacion, id_central, ctnombre, cttelefono, ctemail, cpnombre, cptelefono, cpemail, fecha_solicitud, estatus) 
        VALUES (id, '".$folio."', '".$tipoSiteSurvey."', ".$central.", '".$ctnombre."', '".$cttelefono."', '".$ctemail."', '".$cpnombre."', '".$cptelefono."', '".$cpemail."', '".$fecha_solicitud."', 'SOLICITADO');";
//    if(!mysql_query($query)){
//        $salida = 'Error durante el guardado de datos, vuelva a intentar';
//    }
//    else {
//        $salida = 'Programaci&oacute;n realizada correctamente';
//       }  
    mysql_query($query) or die(mysql_error());
}
function guardaemails($folio,$nombres,$cc){
    for($i = 0; $i < count($cc); $i++){
        $query = "INSERT INTO zccemails VALUES (id, '".$folio."', '".$nombres[$i]."', '".$cc[$i]."');";
        mysql_query($query);
    }
}
function guardareqs($noequipos, $folio, $modelos){
    for($c = 0; $c < $noequipos; $c++){
        $query = "INSERT INTO zss_equipos (id, folio, id_tecnologia) VALUES (id, '".$folio."', ".$modelos[$c].");";
        mysql_query($query);        
    }
}
function sendmail($folio,$central,$noequipos,$ctemail,$cpemail,$cc,$fecha_solicitud,$modelos){
    include ('nomad_mimemail.inc.php');
    require 'conexion.php';
    $division;$area;$siglas;$nsitio;$clli;$calle;$numero;$localidad;$ciudad;$estado;$cp;$longitud;$latitud;
    $original = array('°','Á','É','Í','Ó','Ú','á','é','í','ó','ú','Ñ','ñ');
    $nuevo = array('&deg;','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;','&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','&Ntilde;','&ntilde;');
    $fecha_solicitud = datetransform($fecha_solicitud);
    
    $datos_cen = "SELECT dir_div,area,sigcent,edificio,clli_edif,calle,num_ext,localidad,municipio,edo,c_p,latitud,longitud FROM centrales WHERE id_ctl = ".$central." ;";
    $data = mysql_query($datos_cen, $conectar2);
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
        $datatec = "SELECT rubro, proveedor, tecnologia, tipo_equipo FROM ztecnologias WHERE id = ".$modelos[$e].";";
        $datos = mysql_query($datatec, $conectar2);
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
    $mensaje = '<html><head><style type="text/css">body{font-family:Arial}h1{font-size:16pt}table{border-collapse:collapse}table tr th,table tr td{text-align:center;border-top:1px #fff solid;font-size:13px;padding:8px}table tr td{background:#E8EDFF;color:#669}table tr th{background:#B9C9FE;color:#039}span{color:#f00;font-weight:bold}h1#folio{color:#f00;float:right;margin:-39px 0 0}</style></head><body><h1>Validaci&oacute;n de Site Survey</h1><h1 id="folio">FOLIO: '.$folio.'</h1><p>Se ha generado una fecha propuesta para la realizaci&oacute; del Site Survey en la Central <b>'.$nsitio.'.</b> con el siguiente folio <span>'.$folio.'</span>. Los datos de la central son los siguientes</p><table><tr><th>DIVISI&Oacute;N</th><th colspan="2">&Aacute;REA</th><th>SIGLAS</th></tr><tr><td>'.$division.'</td><td colspan="2">'.$area.'</td><td>'.$siglas.'</td></tr><tr><th>NOMBRE DEL SITIO</th><th>CLLI Central</th><th>CALLE</th><th>N&Uacute;MERO</th></tr><tr><td>'.$nsitio.'</td><td>'.$clli.'</td><td>'.$calle.'</td><td>'.$numero.'</td></tr><tr><th>LOCALIDAD</th><th>CIUDAD</th><th>ESTADO</th><th>C&Oacute;DIGO POSTAL</th></tr><tr><td>'.$localidad.'</td><td>'.$ciudad.'</td><td>'.$estado.'</td><td>'.$cp.'</td></tr><tr><th colspan="2">LATITUD</th><th colspan="2">LONGITUD</th></tr><tr><td colspan="2">'.$latitud.'</td><td colspan="2">'.$longitud.'</td></tr><tr><th>MODELO</th><th>RUBRO</th><th>PROVEEDOR</th><th>TECNOLOG&Iacute;A</th></tr>'.$equipos.'</table><p>La fecha propuesta es el '.$fecha_solicitud.'</p></body></html>';
//    print_r($datos);
    $mimemail->set_from("frida@telmex.com","FRIDA");
    //$mimemail->set_to("juliocvm243@gmail.com");
    $mimemail->set_to($cpemail);
    $max = count($cc);
    for($i = 0; $i < $max; $i++){
        $mimemail->add_cc($cc[$i]);
    }

    $mimemail->set_subject("Validar fecha de realizacion Site Survey");
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
    $mimemail->set_to($ctemail);
    $mimemail->set_subject("Validar fecha de realizacion Site Survey");
    $mensaje2 = '<html><head><style type="text/css">body{font-family:Arial}h1{font-size:16pt}table{border-collapse:collapse}table tr th,table tr td{text-align:center;border-top:1px #fff solid;font-size:13px;padding:8px}table tr td{background:#E8EDFF;color:#669}table tr th{background:#B9C9FE;color:#039}span{color:#f00;font-weight:bold}h1#folio{color:#f00;float:right;margin:-39px 0 0}</style></head><body><h1>Validaci&oacute;n de Site Survey</h1><h1 id="folio">FOLIO: '.$folio.'</h1><p>Se ha generado una fecha propuesta para la realizaci&oacute; del Site Survey en la Central <b>'.$nsitio.'.</b> con el siguiente folio <span>'.$folio.'</span>. Los datos de la central son los siguientes</p><table><tr><th>DIVISI&Oacute;N</th><th colspan="2">&Aacute;REA</th><th>SIGLAS</th></tr><tr><td>'.$division.'</td><td colspan="2">'.$area.'</td><td>'.$siglas.'</td></tr><tr><th>NOMBRE DEL SITIO</th><th>CLLI Central</th><th>CALLE</th><th>N&Uacute;MERO</th></tr><tr><td>'.$nsitio.'</td><td>'.$clli.'</td><td>'.$calle.'</td><td>'.$numero.'</td></tr><tr><th>LOCALIDAD</th><th>CIUDAD</th><th>ESTADO</th><th>C&Oacute;DIGO POSTAL</th></tr><tr><td>'.$localidad.'</td><td>'.$ciudad.'</td><td>'.$estado.'</td><td>'.$cp.'</td></tr><tr><th colspan="2">LATITUD</th><th colspan="2">LONGITUD</th></tr><tr><td colspan="2">'.$latitud.'</td><td colspan="2">'.$longitud.'</td></tr><tr><th>MODELO</th><th>RUBRO</th><th>PROVEEDOR</th><th>TECNOLOG&Iacute;A</th></tr>'.$equipos.'</table><p>La fecha propuesta es el '.$fecha_solicitud.', para confirmar o modificar la fecha, acceda al siguiente enlace:<br/><a href="http://frida/infinitum/ssv2/validar.php?f='.$folio.'">Validar fecha propuesta</a></p></body></html>';
    $mimemail->set_html($mensaje2);
    $mimemail->set_smtp_host($smtp_host);
    $mimemail->set_smtp_auth($smtp_user, $smtp_pass);
    $mimemail->send();
    
}
function mailconfirm($fecha, $nsitio, $folio){
    require 'conexion.php';
    include ('nomad_mimemail.inc.php');
    $original = array('°','Á','É','Í','Ó','Ú','á','é','í','ó','ú','Ñ','ñ');
    $nuevo = array('&deg;','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;','&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','&Ntilde;','&ntilde;');
    
    $nsitio = str_replace($original, $nuevo, $nsitio);
    $fecha = datetransform($fecha);
    
    $query = mysql_query("SELECT ctemail, cpemail FROM zsite_survey WHERE folio = '".$folio."';");
    $emailtelmex = mysql_result($query,0,0);
    $emailprovee = mysql_result($query,0,1);
    
    $mimemail = new nomad_mimemail();
    $smtp_host	= "10.192.10.25";
    //$smtp_user	= "frida";
    $smtp_pass	= "Fridainfinitum";
    $mensaje = '<html><head></head><body>Fecha de programaci&oacute;n para la realizaci&oacute;n del Site Survey en la central <b>'.$nsitio.'</b> esta confirmada para el d&iacute;a <b>'.$fecha.'</b>.<br/>Su folio para acceder al formato de captura es <b>'.$folio.'</b><br/><br/></body></html>';
    $mimemail->set_from("frida@telmex.com","FRIDA");
    //$mimemail->set_to("juliocvm243@gmail.com");
    $mimemail->set_to($emailtelmex);
    $mimemail->add_cc($emailprovee);
    $mails = "SELECT email FROM zccemails WHERE folio = '".$folio."';";
    $resultset = mysql_query($mails, $conectar2);
    $sz = mysql_num_rows($resultset);
    if($sz > 0){
        for($r = 0; $r < $sz; $r++){
            $correo = mysql_fetch_array($resultset);
            $mimemail->add_cc($correo['email']);
        }
    }
    $mimemail->set_subject("Confirmacion de fecha");
    $mimemail->set_html($mensaje);

    $mimemail->set_smtp_host($smtp_host);
    $mimemail->set_smtp_auth($smtp_user, $smtp_pass);

    if ($mimemail->send()){
        //echo "The MIME Mail has been sent";
    }
    else {
        //echo "An error has occurred, mail was not sent";
    }
}
function rubro(){
    require 'conexion.php';
    $rubro = '<option value>Seleccionar</option>';
    $query = "SELECT rubro FROM ztecnologias GROUP BY rubro ORDER BY rubro ASC;";
    $salida = mysql_query($query, $conectar2);
    $tam = mysql_num_rows($salida);
    if($tam > 0){
        for($a = 0; $a < $tam; $a++){
            $rb = mysql_fetch_array($salida);
            $rubro .= '<option value="'.$rb['rubro'].'">'.$rb['rubro'].'</option>';
        }
    }
    return $rubro;
}
function division($division){
    require 'conexion.php';
    $division = strtoupper($division);
    $div = '';
    $query = "SELECT dir_div FROM centrales GROUP BY dir_div ORDER BY dir_div ASC";
    $centrales = mysql_query($query, $conectar2);
    for($i = 0; $i < mysql_num_rows($centrales); $i++){
        $cn = mysql_fetch_array($centrales);
        if($division == '' | $division == '%'){
            $div .= '<option value="'.$cn['dir_div'].'">'.$cn['dir_div'].'</option>';            
        }
        else{
            if($division == $cn['dir_div']){
                $div .= '<option value="'.$cn['dir_div'].'">'.$cn['dir_div'].'</option>';
            }
            else{
                $div .= '<option value="'.$cn['dir_div'].'" disabled>'.$cn['dir_div'].'</option>';
            }
        }
                
    }
    return $div;
}
function correoss($folio,$tipo){
    require 'conexion.php';
    include 'nomad_mimemail.inc.php';
    $ccemails = array();
    $correoTelmex;
    $correoProv;
    $ruta;
    if($tipo == 'N'){
        $ruta = 'formato';
    }
    else{
        $ruta = 'adecuacion';
    }
    $query = "SELECT email FROM zccemails WHERE folio = '".$folio."';";
    $correos = mysql_query($query,$conectar2);
    $max = mysql_num_rows($correos);
    if($max > 0){
        for($i = 0; $i < $max; $i++){
            $email = mysql_fetch_array($correos);
            $ccemails[$i] = $email['email'];
        }
    }
    
    $query2 = "SELECT ctemail, cpemail FROM zsite_survey WHERE folio = '".$folio."';";
    $correos2 = mysql_query($query2, $conectar2);
    $max2 = mysql_num_rows($correos2);
    if($max2 > 0){
        for($j = 0; $j < $max2; $j++){
            $email2 = mysql_fetch_array($correos2);
            $correoTelmex = $email2['ctemail'];
            $correoProv = $email2['cpemail'];
        }
    }
    
    //CORREO PARA PROVEEDOR Y COPIAS
    $mimemail = new nomad_mimemail();
    $smtp_host	= "10.192.10.25";
    $smtp_pass	= "Fridainfinitum";
    $mensaje = '<html><head></head><body>El Site Survey con el siguiente folio <b style="color:#foo">'.$folio.'</b> se ha enviado a validaci&oacute;n exitosamente.</body></html>';
    $mimemail->set_from("frida@telmex.com","FRIDA");
    $mimemail->set_to($correoProv);
    for($k = 0; $k < count($ccemails); $k++){
        $mimemail->add_cc($ccemails[$k]);
    }
    $mimemail->set_subject("Nueva solicitud de validación Site Survey");
    $mimemail->set_html($mensaje);
    $mimemail->set_smtp_host($smtp_host);
    $mimemail->set_smtp_auth($smtp_user, $smtp_pass);
    $mimemail->send();
    
    //CORREO PARA CONTACTO TELMEX
    unset($mimemail);
    unset($mensaje);
    $mimemail = new nomad_mimemail();
    $mensaje = '<html><head></head><body>El Site Survey con el siguiente folio <b style="color:#foo">'.$folio.'</b> se ha enviado a validaci&oacute;n exitosamente.<br/><br/>Para validar o rechazar el Site Survey, siga el siguiente enlace <a href="http://frida/infinitum/ssv2/'.$ruta.'.php?folio='.$folio.'">http://frida/infinitum/ssv2/'.$ruta.'.php?folio='.$folio.'</a></body></html>';
    $mimemail->set_from("frida@telmex.com","FRIDA");
    $mimemail->set_to($correoTelmex);
    $mimemail->set_subject("Nueva solicitud de validación Site Survey");
    $mimemail->set_html($mensaje);
    $mimemail->set_smtp_host($smtp_host);
    $mimemail->set_smtp_auth($smtp_user, $smtp_pass);
    $mimemail->send();
}
function validar($folio,$flag){
/*-------------------------------------
V A L I D A D O   O   R E C H A Z A D O
---------------------------------------*/
    require 'conexion.php';
    include 'nomad_mimemail.inc.php';
    $estatus;
    $fecha = date('Y-m-d H:i:s');
    $correos = array();
    if($flag == 1){
        $estatus = 'VALIDADO';
    }
    else{
        $estatus = 'RECHAZADO';
    }
    $query = "UPDATE zsite_survey SET estatus = '".$estatus."', fecha_validacion = '".$fecha."' WHERE folio = '".$folio."';";
    mysql_query($query);
    
    //ENVIO DE CORREO A TODOS LOS INVOLUCRADOS.
    $emails = "SELECT ctemail, cpemail, causa_rechazo FROM zsite_survey WHERE folio = '".$folio."';";
    $salida = mysql_query($emails,$conectar2);
    $max = mysql_num_rows($salida);
    if($max > 0){
        for($i = 0; $i < $max; $i++){
            $data = mysql_fetch_array($salida);
            $correos[0] = $data['ctemail'];
            $correos[1] = $data['cpemail'];
            $rechazo = $data['causa_rechazo'];
        }
    }
    $ccemails = "SELECT email FROM zccemails WHERE folio = '".$folio."';";
    $exit = mysql_query($ccemails, $conectar2);
    $mx2 = mysql_num_rows($exit);
    if($mx2 > 0){
        $c = 2;
        for($j = 0; $j < $mx2; $j++){
            $data2 = mysql_fetch_array($exit);
            $correos[$c] = $data2['email'];
            $c++;
        }
    }
    if($rechazo != null || $rechazo != ''){
        $rechazo = ' por el siguiente motivo '.$rechazo.' ';
    }
    else{
        $rechazo = '';
    }
    $mimemail = new nomad_mimemail();
    $smtp_host	= "10.192.10.25";
    $smtp_pass	= "Fridainfinitum";
    $mensaje = '<html><head><style type="text/css">body{font-family:Arial}</style></head><body>El Site Survey con el siguiente folio <b style="color:#foo">'.$folio.'</b> fue '.$estatus.'</br>'.$rechazo.'</body></html>';
    $mimemail->set_from("frida@telmex.com","FRIDA");
    $mimemail->set_to($correos[0]);
    for($k = 1; $k < count($correos); $k++){
        $mimemail->add_cc($correos[$k]);
    }
    if($flag == 1){
        $mimemail->set_subject("Site Survey validado exitosamente");
    }
    else{
        $mimemail->set_subject("Site Survey rechazado");
    }
    $mimemail->set_html($mensaje);
    $mimemail->set_smtp_host($smtp_host);
    $mimemail->set_smtp_auth($smtp_user, $smtp_pass);
    $mimemail->send();
    
    return $estatus;
}
function datosusuario($usuario){
    require 'conexion.php';
    $salida = array();
    $datos = "SELECT * FROM usuarios.seg_usuarios WHERE login = '".$usuario."';";
    $regreso = mysql_query($datos, $conectar2);
    $mx = mysql_num_rows($regreso);
    if($mx > 0){
        for($i = 0; $i < $mx; $i++){
            $registro = mysql_fetch_array($regreso);
            $salida[0] = $registro['nombre'];
            //$salida[1] = $registro['dd'];
            $salida[1] = $registro['email'];
        }
    }
    return $salida;
}