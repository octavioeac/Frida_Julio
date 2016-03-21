<?php
	include ("..\..\sesion.php");
	require("..\..\conexion.php");
	include("..\..\SistemaFridaBean.php");					// Objeto para enviar
	//include("..\..\smtp.php");
	//include_once ('..\..\nomad_mimemail.inc.php');

/*$dd	= isset($_REQUEST['dd'])?$_REQUEST['dd']:null; //dd
$si	= isset($_REQUEST['si'])?$_REQUEST['si']:null; //siglas
$nm	= isset($_REQUEST['nm'])?$_REQUEST['nm']:null; //nombre oficial
$pr	= isset($_REQUEST['pr'])?$_REQUEST['pr']:null; //proveedor 
$ub	= isset($_REQUEST['ub'])?$_REQUEST['ub']:null; //ubicación*/

// if ($dd==null or $si==null or $nm==null or $pr==null) die ("PARAMETROS INVALIDOS");
// else {
	/*echo alta_clli_vdsl($dd,$si,$nm,$pr,$ub);*/
// }

function alta_clli_vdsl($dd,$siglas,$nom_of,$prov,$ubic,$clli,$tipo,$tabla,$fun){
	//DATOS REQUERIDOS INTERFACE INFOCENTRO
	#$clli		= $_REQUEST['clli'];					/* $clli_edificio = clli de la central*/
	$clli_sis	= '';							/* $clli_sis = */
	$mail		= 'cborja@telmex.com';					/* # $mail = es constante cborja@telmex.com*/
	#$dd			= 'METRO';								/*$dd = division*/
	#$nom_of		= 'MEX-MADRID-27';						/* nombre oficial pisa del equipo*/
	//$fun		= "VDSL ".$nom_of;						/*$fun = funcion del equipo cuando no se especifica una funcion por parte del usuario, se pone el nombre oficial pisa del equipo*/
	#$prov		= 'ALCATEL';							/*$prov = proveedor del equipo como es conocido por infocentro que sale del catalogo: cat_equipo, campo: proveedor*/
	// switch ($prov){
		// case 'ALCATEL': $tipo="ISAM 7302"; break;
		// case 'HUAWEI': $tipo="MA5006X"; break;
	// }
	#$tipo		= 'ISAM 7302';							/*$tipo = tipo de equipo como es conocido por infocentro informacion  que sale del catalogo: cat_equipo, campo: cat_infocentro*/
	$top		= 'PTO-PTO_';							/*$top = tipo_topologia es un tipo de topologia reconocida por infocentro siempre es constante ='PTO-PTO_'*/
	#$ubic		= "00.T103A101001";						/*$ubic = ubicacion del equipo ipdslam*/
	
	//DATOS REQUERIDOS FRIDA
	//$area		= $_REQUEST['area'];					/*$area = area de la central*/
	#$tabla		= "isam_unica";							/*$tabla = tabla de frida en donde reside el equipo para isam 7302 tabla= isam_unica*/
	//$login		= $_SESSION['usr'];					/* es el login del usuario que dio de alta al equipo*/
	$login='admin';
	$jerarquia	= '';									/*jerarquia simempre es empty string*/
	
	$row_ctl = mysql_fetch_array(mysql_query("select area,clli_edif from centrales where dir_div='$dd' and sigcent='$siglas';"),MYSQL_ASSOC);
	$clli=$row_ctl['clli_edif'];
	$area=$row_ctl['area'];
	
	$row_correo = mysql_fetch_array(mysql_query("SELECT now() AS fecha, email FROM usuarios WHERE login ='$login'"), MYSQL_ASSOC);
	$mail_usuario = strtolower($row_correo['email']);
	$fecha_sol = $row_correo['fecha'];

	if ( $area == "TIJUANA" OR $area == "MEXICALI" OR $area == "ENSENADA")	$dd = "TELNOR";
	
	switch ($dd){
		case 'METRO':		$mail = "rodasj@serviciostmx.com";	break;
		case 'NORTE':		$mail = "hdelgado@telmex.com";		break;
		case 'OCCIDENTE':	$mail = "rodasj@serviciostmx.com";	break;
		case 'SUR':		$mail = "rodasj@serviciostmx.com";	break;
		case 'TELNOR':		$mail = "osgo@telnor.com";			break;
		default: break;
	}
	
	
	// *************************
	// WSDL SERVIDOR INFOCENTRO PRODUCCION
	// $wsdl = "http://10.192.5.43/infocentro/webservices/sistemaFrida?wsdl";
	// WSDL SERVIDOR INFOCENTRO DESARROLLO
	$wsdl = "http://10.192.2.74:8082/info_amdocs/webservices/sistemaFrida?wsdl";
	
	// *************************
	// FORMATO DE LA CLASE SistemaFridaBean(sclliEdificio, sclliSsistema, scorreoUsuario, sddSold, sfuncionEquipo, snombreOficial, sproveedorEquipo, stipoEquipo, stopologiaEquipo, subicacionEquipo)

	$datos = new SistemaFridaBean($clli, $clli_sis, $mail, $dd, $fun, $nom_of, $prov, $tipo, $top, $ubic);

	$client = new SoapClient($wsdl, array('classmap' => array('arg0' => 'SistemaFridaBean')));
	$result = $client->AltaClli(array('arg0' => $datos));

	$mail="dbortoli@telmex.com";
	if ( $result->return->sestatus == "" ){
		correo($clli, $dd, $tipo, $prov, $ubic, $fun, $top, $mail, "error", "", "", "", "");
		$mensaje = "Error de Conexi&oacute;n!!";
		$estilo = "Estilo3a";
	}elseif ($result->return->sestatus == "EXITO"){
		$mensaje = "SOLICITUD EXITOSA";
		$estilo = "Estilo3";
		
		$n_clli = $result->return->sclliSistema;
		$n_funcion = $result->return->sDescripcion;
		$n_ubica = $result->return->subicacionEquipo;
		$n_nom_of = $result->return->snombreOficial;
		$n_tipo_eq = $result->return->stipoEquipo;
		
		correo($clli,$dd,$tipo,$prov,$ubic,$fun,$top,$mail,"exito",$mail_usuario,$n_clli,$n_funcion,$n_ubica,$fecha_sol,$n_nom_of);
		
		switch($tabla){
			case "telealimentacion_adtran_3010":
				$query = "UPDATE $tabla set ch_clli = 'OK', clli = '$n_clli' WHERE nombre_oficial_pisa = '$nom_of'";
			break;
			case "gpon":
				if($jerarquia=="repisa") $query = "UPDATE $tabla set ch_clli = 'OK', clli_tba = '$n_clli' WHERE nombre_oficial_pisa = '$nom_of'";
				if($jerarquia=="puerto") $query = "UPDATE $tabla set ch_clli = 'OK', clli_pto = '$n_clli' WHERE nom_of_equi_agreg = '$nom_of'";
			break;
			case "isam7330":
				$query = "UPDATE $tabla set ch_clli = 'OK', clli_tba = '$n_clli' WHERE nombre_oficial_pisa = '$nom_of'";
			break;
			case "adtran":
				if($jerarquia=="agregador"){
					$query = "UPDATE $tabla set ch_clli = 'OK', clli_tba = '$n_clli' WHERE nombre_oficial_pisa = '$nom_of'";
					mysql_query("UPDATE $tabla set  clli_agr = '$n_clli' WHERE nom_of_equi_agreg = '$nom_of'");
				}
				elseif($jerarquia=="host"){
					$query = "UPDATE $tabla set ch_clli = 'OK', clli_tba = '$n_clli' WHERE nombre_oficial_pisa = '$nom_of'";
				}   
				elseif($jerarquia=="cliente"){
					$query = "UPDATE $tabla set ch_clli = 'OK', clli_cliente = '$n_clli' WHERE nombre_oficial_adsl = '$nom_of'";
				}
			break;
			case "isam_unica":
			case "edas2530":
			case "huawei_unica":
			case "wimax":
			case "equipos_atm":
				$query = "UPDATE $tabla set ch_clli = 'OK', clli_isam = '$n_clli' WHERE nombre_oficial_pisa = '$nom_of'";
			break;
			default: //caso de error donde no se especifica tabla
			break;
		}
		$res = mysql_query($query);
		$query_2= "UPDATE cat_nombres_oficiales set estatus_clli = '$fecha_sol', clli = '$n_clli' WHERE nombre_oficial_pisa = '$nom_of'";
		$res_2 = mysql_query($query_2);
		$query_log = "INSERT INTO log_infocentro VALUES ('','$fecha_sol','$dd','$clli','$n_clli','$login','$mail_usuario','$n_funcion','$n_nom_of','$n_tipo_eq','$n_ubica','$top')";
		$res_log = mysql_query($query_log);
		return $n_clli;
	}else if ( $result->return->sestatus == "ERROR" ) {
		$mensaje = "ERROR - SOLICITUD NO EXITOSA";
		return $mensaje;
	}
}
	
//*****************ENVIO DE CORREO *********************
function correo($clli,$dd,$tipo,$prov,$ubic,$fun,$top,$mail,$estado,$correo_usu,$new_clli,$new_funcion,$new_ubica,$fecha_s,$new_nom_of){
	setlocale(LC_TIME, "esp_Esp");
	if ( $estado == 'error' ){
		$to = array("dbortoli@telmex.com");
		//$to = array("rodasj@serviciostmx.com");
		//$cc = array("mariarr@telmex.com","jsterrer@telmex.com");
		$subject = "FRIDA INFOCENTRO: Solicitud de CLLI no Exitosa";
		$html = "<HTML><HEAD>";
		$html .= "<style type='text/css'>";
		$html .= "<!--";
		$html .= ".Estilo1 { color: #000000; font-family: Arial; font-weight: bold; font-size: 14px; }";
		$html .= ".Estilo2 { font-family: Arial; font-size: 12px; }";
		$html .= "p { color: black; font-family: Arial; font-size: 14px; }";
		$html .= "-->";
		$html .= "</style></HEAD><BODY><img src='image.gif' border='0'><hr>";
		if ( $estado == 'error' ){
			$html .= "<p><u><b><i>Ingeniero(s):</i></b><br></u></p>";
			$html .= "<p>Por este medio solicitamos su apoyo para la verificaci&oacute;n de la solicitud del CLLI adjunto, ya que por problemas de comunicaci&oacute;n no se obtuvo respuesta autom&aacute;tica alguna.</p>";
			$html .= "<br><table border='1' cellspacing='2' bordercolor='#999999' align='center'>";
			$html .= "<tr bgcolor='#CAE4FF' class='Estilo1' align='center'><td>CLLI</td><td>Divisi&oacute;n</td><td>Tipo</td><td>Proveedor</td><td>Ubicaci&oacute;n</td><td>Funci&oacute;n</td><td>Topolog&iacute;a</td><td>Correo usuario</td></tr>";
			$html .= "<tr bgcolor='#FFFFFF' class='Estilo2'><td>$clli</td><td>$dd</td><td>$tipo</td><td>$prov</td><td>$ubic</td><td>$fun</td><td>$top</td><td>$mail</td></tr>";
			$html .= "</table>";
			$html .= "<br><p>Gracias por su apoyo y quedamos en espera de su informaci&oacute;n.</p>";
		}else{
			$html .= "<p><u><b><i>Ingeniero(s):</i></b><br></u></p>";
			$html .= "<p>Se notifica que el sistema solicitado para dar de alta en INFOCENTRO de forma autom&aacute;tica se ha procesado con &eacute;xito, el sistema se enlista a continuaci&oacute;n:</p>";
			$html .= "<br><table border='1' cellspacing='2' bordercolor='#999999' align='center'>";
			$html .= "<tr bgcolor='#CAE4FF' class='Estilo1' align='center'><td>Usuario</td><td>Fecha Sol</td><td>C&oacute;digo Loc cl</td><td>C&oacute;digo Edo cl</td><td>C&oacute;digo Edif cl</td><td>C&oacute;digo Sis cl</td><td>Clli</td><td>Nombre Oficial</td><td>Descripci&oacute;n</td><td>Ubicaci&oacute;n</td><td>Estatus</td></tr>";
			$html .= "<tr bgcolor='#FFFFFF' class='Estilo2'><td>$correo_usu</td><td>$fecha_s</td><td>".substr($new_clli,0,4)."</td><td>".substr($new_clli,4,2)."</td><td>".substr($new_clli,6,2)."</td><td>".substr($new_clli,8,3)."</td><td>$new_clli</td><td>$new_nom_of</td><td>$new_funcion</td><td>$new_ubica</td><td>PROCESADO</td></tr>";
			$html .= "</table>";
		}
		$html .= "<br><p>Saludos cordiales</p>";
		$html .= "<br>";
		$html .= "<br></BODY></HTML>";
		
		$mimemail = new nomad_mimemail();
		$mimemail->set_smtp_host($smtp_host);
		$mimemail->set_smtp_auth($smtp_user, $smtp_pass);
		$mimemail->set_to($to[0]);
		for ($d=1;$d<count($to);$d++) $mimemail->add_to($to[$d]);
		if($cc!=null){
			$mimemail->set_cc($cc[0]);
			for ($d=1;$d<count($cc);$d++) $mimemail->add_cc($cc[$d]);
		}
		$mimemail->set_subject($subject);
		$mimemail->set_html($html);
		$mimemail->add_attachment("images/logo.gif", "image.gif");	//logo de encabezado TELMEX
			
		if ($mimemail->send()){
			//echo "El MIME Mail fue enviado correctamente";
		}else{
			//echo "ERROR:  Mail No enviado";
		}
	}
}?>
