<?php
function correo_pedidos_aviso($to,$subj,$html,$adj,$ruta_main){
	include("../../smtp.php");
	include_once('../../nomad_mimemail.inc.php');
	$mimemail = new nomad_mimemail();
	$mimemail->set_smtp_host($smtp_host);
	$mimemail->set_smtp_auth($smtp_user, $smtp_pass);
	$mimemail->set_to($to[0]);
	for ($d=1;$d<count($to);$d++) $mimemail->add_to($to[$d]);
  	$mimemail->set_subject($subj);
	$mimemail->set_html($html);
	if ($adj!=null){
		$mimemail->add_attachment($adj['ruta'],$adj['nombre']);
	}
	if ($mimemail->send())	echo "El Mail ($subj) fue enviado correctamente<BR>";
		else echo "ERROR:  Mail ($subj) No enviado<BR>";
}
include('../functions/conexion.php');
include('../lib/PDFMerger/PDFMerger.php');
error_reporting(E_ALL);
setlocale(LC_ALL,'es_MX'); 

$folio=$_GET["folio"];
$file_tem=$_GET['file_tem'];
$file_final=$_GET['file_final'];

$pdf = new PDFMerger;
$ruta_archivos="G:/Archivos/SiteSurvey/";
$sql=mysql_query("SELECT nombre FROM zarchivos WHERE folio='$folio' AND TRIM(tipo)='application/pdf'");
$x='$pdf->addPDF(\''.$file_tem.'\',\'all\')';
while($files=mysql_fetch_array($sql)){	$x.='->addPDF(\''.$ruta_archivos.$files[0].'\',\'all\')'; }
$x.='->merge(\'file\',\''.$ruta_archivos.$file_final.'\');';
eval($x);
unlink($file_tem);

/* $original = array('°','??','É','??','Ó','Ú','á','é','í','ó','ú','Ñ','ñ');
$nuevo = array('&deg;','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;','&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','&Ntilde;','&ntilde;');
			  
$QueryDatosGenerales = mysql_query("SELECT a.dir_div,a.area,a.sigcent,a.edificio,a.clli_edif,a.calle,a.num_ext,a.localidad,a.municipio,a.edo,a.c_p,a.latitud,
									a.longitud,b.ctnombre,b.cttelefono,b.ctemail,b.ctmovil,b.rsnombre,b.rstelefono,b.rsemail,b.rsmovil,b.cpnombre,b.cptelefono,
									b.cpemail,b.cpmovil,b.punto_reunion,DATE(b.fecha_programada) fecha,TIME(b.fecha_programada) hora,b.rubro,b.estatus 
									FROM centrales a,zsite_survey b	WHERE b.folio='".$folio."' AND a.id_ctl=b.id_central");
$DatosGenerales = mysql_fetch_row($QueryDatosGenerales);			  

$equipos = '<tr><th>NOMBRE</th><th>TIPO DE TRABAJO</th><th>UBICACI&Oacute;N</th><th>PUERTOS</th><th>TARJETAS</th></tr>';
$QueryEquipos = "SELECT nombre_equipo,tipo_trabajo,ubicacion,puertos,tarjetas FROM zss_equipos WHERE folio='".$folio."'";
$ResultEquipos = mysql_query($QueryEquipos);
$sz = mysql_num_rows($ResultEquipos);
if($sz>0){
	for($i=0;$i<$sz;$i++){
		$d = mysql_fetch_array($ResultEquipos);
		$equipos.= '<tr><td>'.$d['nombre_equipo'].'</td><td>'.$d['tipo_trabajo'].'</td><td>'.$d['ubicacion'].'</td><td>'.$d['puertos'].'</td><td>'.$d['tarjetas'].'</td></tr>';
	}
}

$html="<HTML><HEAD><meta http-equiv='Content-Type' content='text/html; charset=utf-8'/> 
				   <style type='text/css'>body{font-family:Arial}h1{font-size:16pt}table{border-collapse:collapse}
					   table tr th,table tr td{text-align:center;border-top:1px #fff solid;font-size:13px;padding:8px}
					   table tr td{background:#E8EDFF;color:#669}table tr th{background:#B9C9FE;color:#039}span{color:#f00;font-weight:bold}
					   h1#folio{color:#f00;float:right;margin:-39px 0 0}
				   </style>
			  </HEAD>
			<BODY>";
$html.="Adjunto al presente el Reporte General Site Survey $folio<br><br>";
$html.='<h1>Validaci&oacute;n de Site Survey </h1><h1 id="folio">FOLIO: '.$folio.' <BR>ESTATUS: '.$DatosGenerales[29].'</h1><BR><p>Se ha validado la informaci&oacuten del Site Survey en la Central 
		<b>'.$DatosGenerales[3].'</b> con el siguiente folio <span>'.$folio.'</span>. Los datos de la central son los siguientes</p>
		<table>
				<tr><th>DIVISI&Oacute;N</th><th colspan="3">&Aacute;REA</th><th>SIGLAS</th></tr>
				<tr><td>'.$DatosGenerales[0].'</td><td colspan="3">'.$DatosGenerales[1].'</td><td>'.$DatosGenerales[2].'</td></tr>
				<tr><th colspan="2">NOMBRE DEL SITIO</th><th>CLLI Central</th><th>CALLE</th><th>N&Uacute;MERO</th></tr>
				<tr><td colspan="2">'.$DatosGenerales[3].'</td><td>'.$DatosGenerales[4].'</td><td>'.$DatosGenerales[5].'</td><td>'.$DatosGenerales[6].'</td></tr>
				<tr><th colspan="2">LOCALIDAD</th><th>CIUDAD</th><th>ESTADO</th><th>C&Oacute;DIGO POSTAL</th></tr>
				<tr><td colspan="2">'.$DatosGenerales[7].'</td><td>'.$DatosGenerales[8].'</td><td>'.$DatosGenerales[9].'</td><td>'.$DatosGenerales[10].'</td></tr>
				<tr><th colspan="3">LATITUD</th><th colspan="2">LONGITUD</th></tr>
				<tr><td colspan="3">'.$DatosGenerales[11].'</td><td colspan="2">-'.$DatosGenerales[12].'</td></tr>
				<tr><th colspan="5">DATOS COORDINADOR TELMEX</th></tr>
				<tr><td colspan="2"><b>Nombre</b></td><td><b>Tel&eacute;fono</b></td><td><b>Correo Electr&oacute;nico</b></td><td><b>N&uacute;mero Celular</b></td></tr>
				<tr><td colspan="2">'.$DatosGenerales[13].'</td><td>'.$DatosGenerales[14].'</td><td>'.$DatosGenerales[15].'</td><td>'.$DatosGenerales[16].'</td></tr>
				<tr><th colspan="5">DATOS RESPONSABLE SITIO</th></tr>
				<tr><td colspan="2"><b>Nombre</b></td><td><b>Tel&eacute;fono</b></td><td><b>Correo Electr&oacute;nico</b></td><td><b>N&uacute;mero Celular</b></td></tr>
				<tr><td colspan="2">'.$DatosGenerales[17].'</td><td>'.$DatosGenerales[18].'</td><td>'.$DatosGenerales[19].'</td><td>'.$DatosGenerales[20].'</td></tr>
				<tr><th colspan="5">DATOS PROVEEDOR</th></tr>
				<tr><td colspan="2"><b>Nombre</b></td><td><b>Tel&eacute;fono</b></td><td><b>Correo Electr&oacute;nico</b></td><td><b>N&uacute;mero Celular</b></td></tr>
				<tr><td colspan="2">'.$DatosGenerales[21].'</td><td>'.$DatosGenerales[22].'</td><td>'.$DatosGenerales[23].'</td><td>'.$DatosGenerales[24].'</td></tr>
		</table>';
		
	 	$correos=array(0=>array('nombre'=>'ctnombre','email'=>'ctemail','tabla'=>'zsite_survey'),
					   1=>array('nombre'=>'rsnombre','email'=>'rsemail','tabla'=>'zsite_survey'),
					   2=>array('nombre'=>'cpnombre','email'=>'cpemail','tabla'=>'zsite_survey'),
					   3=>array('nombre'=>'nombre','email'=>'email','tabla'=>'zccemails'));

		for($i=0;$i<count($correos);$i++){
			$sql=mysql_query("SELECT ".$correos[$i]['nombre'].",".$correos[$i]['email']." FROM ".$correos[$i]['tabla']." WHERE folio='$folio'");
			while($dat=mysql_fetch_array($sql)){
				$correos1.= strtolower(trim($dat[1])).";";
				$correos2.= mb_strtoupper(trim($dat[0]),'UTF-8')."(".strtolower(trim($dat[1]))."); ";
			}
		}		
		$html.="<br><table width='50%'>
					<tr>
						<td colspan=3 style='background-color:#dedede; color:black'>
							<p style='font-size:11px; font-weight: bold;'>Enviado a: </p><p style='font-size:11px;'>$correos2</p>
						</td>
					</tr>
				</table><font size='3 px' color=white>Script: ssv2/pdf/unir.pdf.php</font>
			</BODY>
		</HTML>"; 
		$correos1=explode(";",$correos1);
		$correos1=array_unique(array_values(array_diff($correos1, array(''))));
		
		for($i=0;$i<count($correos1);$i++){
			$to=ARRAY($correos1[$i]);
			$adj['ruta'] = $ruta_archivos.$file_final;
			$adj['nombre'] = $file_final;
			$subj="Site Survey - Validación";
			if (file_exists($adj['ruta']))correo_pedidos_aviso($to,$subj,$html,$adj,$ruta_archivos);
				else echo "No existe el archivo {$adj['ruta']}<BR>"; 
		} */
		 
		// header('Content-type: application/pdf'); 
		// header('Content-Disposition: inline; filename="'.$ruta_archivos.$file_final.'"');
		// readfile($ruta_archivos.$file_final);  
?>
