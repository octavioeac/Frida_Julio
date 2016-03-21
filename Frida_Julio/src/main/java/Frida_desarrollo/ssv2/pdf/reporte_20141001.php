<?php
header("Content-Type: text/html;charset=utf-8");
include 'Report.php';
include 'tcpdf/tcpdf.php';

$folio = $_GET['folio'];
//$folio = 'SS0120130625001';
//$folio = 'SS2520130617001';
//$folio= 'SS2520140828001'; //SESECAPAN
$reporte = new Report($folio);
$reporte->encabezado();
$datos = $reporte->headerData;
$reporte->datosGenerales();
$dg = $reporte->datosGenerales;
$cc = $reporte->ccemail();
$ub = $reporte->ubxeq();
$vz = $reporte->habilitada();


$file = array();

$instrucciones = $datos[15] != 'POR REALIZAR' ? '' : '<p><b>INSTRUCCIONES: </b>Marque con una <b><font color="red">X</font></b> la opci&oacute;n mas adecuada.</p>';

/*SECUENCIA DE TABLAS*/
$op = array('Nuevo','Ampliacion');
$dgt1 = Report::armarTabla($op,$dg[0],'TIPO DE TRABAJO',$dg[1]);
unset($op);
$op = array('Gabinete Outdoor','Contenedor','Central','Concentrador','Repetidor');
$dgt2 = Report::armarTabla($op,$dg[2],'TIPO DE CENTRAL',$dg[3]);
unset($op);
$op = array('Nuevo','Existente','Requiere Desmontaje');
$dgt3 = Report::armarTabla($op,$dg[4],'ESPACIO',$dg[5]);
unset($op);
$op = array('Piso Firme','Piso Falso','Plataforma');
$dgt4 = Report::armarTabla($op,$dg[6],'TIPO DE PISO EN EL SITIO',$dg[7]);
unset($op);
$op = array('Sala Nueva','Fila Nueva','Requiere Pasa Muros','Entre Piso','Ninguna');
$dgt5 = Report::armarTabla($op,$dg[8],'OBRA CIVIL',$dg[9]);

/*FIBRA ÓPTICA A Y B*/
unset($op);
$op = array('TYCO','ADC','OTRO');
$dgt7 = Report::armarTabla02($op,$dg[11],'MARCA');
unset($op);
$op = array('Tradicional','Alta Densidad','Mini DFO');
$dgt8 = Report::armarTabla02($op,$dg[12],'TIPO DE BASTIDOR DE FIBRAS');
unset($op);
$op = array('Existente','Nuevo');
$dgt6 = Report::armarTabla02($op,$dg[10],'BASTIDOR DE FIBRAS');
unset($op);

$op=array('Existente','Nuevo');
$dgt48=Report::armarTabla02($op,$dg[10],'COMBO / BLOQUE DFO');
unset($op);
$op=array('Existente','Nuevo');
$dgt49=Report::armarTabla02($op,$dg[10],'COMBO / BLOQUE DFO');
unset($op);

$dgt9=$reporte->armarTabla04('2','comentarios x');
unset($op);

//$reporte->folio = 'SS2520130617001';
$dgt11 = $reporte->abfo(1);
//$reporte->folio = 'SS0120130625001';
$dgt12 = Report::comentarios($dg[21]);

unset($op);
$op = array('Existente','Nuevo');
$dgt13 = Report::armarTabla02($op,$dg[22],'SE UTILIZARA BASTIDOR DE FIBRAS');
unset($op);
$op = array('TYCO','ADC','OTRO');
$dgt14 = Report::armarTabla02($op,$dg[23],'MARCA');
unset($op);
$op = array('Tradicional','Alta Densidad','Mini DFO');
$dgt15 = Report::armarTabla02($op,$dg[24],'TIPO DE BASTIDOR DE FIBRAS');

$dgt17 = $reporte->armarTabla04('3','comentarios x');
//$reporte->folio = 'SS2520130617001';
$dgt18 = $reporte->abfo(0);
//$reporte->folio = 'SS0120130625001';
$dgt19 = Report::comentarios($dg[33]);

/*MULTIPAR*/
unset($op);
$op = array('Existente','Nuevo');
$dgt20 = Report::armarTabla02($op,$dg[34],'SE UTILIZARA DISTRIBUIDOR GENERAL');
unset($op);
$op = array('7 y 9 un lado versablock','9 y 11.5 dos lados versablock','5 y 10 niveles portasystem','Exterior');
$dgt21 = Report::armarTabla02($op,$dg[35],'TIPO DE DISTRIBUIDOR GENERAL');
unset($op);

$dgt23 = $reporte->armarTabla04('4','comentarios x');
//$reporte->folio = 'SS2520130617001';
$dgt24 = $reporte->multipar();
//$reporte->folio = 'SS0120130625001';
$dgt25 = Report::comentarios($dg[44]);

/*COAXIAL*/
unset($op);
$op = array('Existente','Nuevo');
$dgt26 = Report::armarTabla02($op,$dg[45],'SE UTILIZARA BDTD');
unset($op);
$op = array('Tradicional','Alta Densidad');
$dgt27 = Report::armarTabla02($op,$dg[46],'TIPO DE BDTD');


$dgt29 = $reporte->armarTabla04('5','comentarios x');
//$reporte->folio = 'SS2520130617001';
$dgt30 = $reporte->coaxial();
//$reporte->folio = 'SS0120130625001';
$dgt31 = Report::comentarios($dg[55]);

/*GESTION*/
unset($op);
$op = array('Si','No');
$dgt32 = Report::armarTabla02($op,$dg[56],'REQUIERE GESTION');
unset($op);
$op = array('En Banda','Fuera de Banda');
$dgt33 = Report::armarTabla02($op,$dg[57],'TIPO DE GESTION');
unset($op);
$op = array('Existente','Nuevo');
$dgt34 = Report::armarTabla02($op,$dg[58],'SE UTILIZARA PUERTO RCDT');
unset($op);
$op = array('Si','No');
$dgt35 = Report::armarTabla02($op,$dg[59],'REQUIERE SINCRONIA');
unset($op);
$op = array('Si','No');
$dgt36 = Report::armarTabla02($op,$dg[60],'REQUIERE CONEXION ADICIONAL DE ALARMAS');

$dgt38 = $reporte->armarTabla04('6','comentarios x');
//$reporte->folio = 'SS2520130617001';
$dgt39 = $reporte->gestionSincronia(0);
$dgt40 = $reporte->gestionSincronia(1);
//$reporte->folio = 'SS0120130625001';
$dgt41 = Report::comentarios($dg[69]);

/*FUERZA*/
unset($op);
$op = array('Planta','Distribuidor de Fuerza (GLT)','Remoto en Bastidor');
$dgt42 = Report::armarTabla02($op,$dg[70],'TIPO DE ALIMENTACIÓN');
$dgt44 = $reporte->armarTabla04('7','comentarios x');
//$reporte->folio = 'SS2520130617001';
$dgt45 = $reporte->fuerza();
//$reporte->folio = 'SS0120130625001';
$dgt46 = Report::comentarios($dg[82]);

/*ARCHIVOS Y PLANOS*/
$dgt47_1 = $reporte->archivos();
$dgt47_2 = $reporte->imagenes();

/*RESUMEN*/
$dgt50 = $reporte->resumen();

$pdf=new TCPDF();
$pdf->SetFont('Helvetica','N',8);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('FRIDA');
$pdf->SetTitle('FRIDA - SITE SURVEY');
$pdf->SetSubject('REPORTE SITE SURVEY');
$pdf->SetHeaderData('telmex.png', '20', 'TELÉFONOS DE MÉXICO S.A.B. DE C.V.', "SITE SURVEY");
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$style = '<style type="text/css">th{background-color:#72a6f3;color#000000;text-align:center;}.t{background-color:#cae4ff;text-align:center;}.c{text-align:center}.g{background-color:#e8e8e8}.gc{text-align:center;background-color:#e8e8e8}td{padding:3px;}</style>';
$space = '<table height="10"><tr><td></td></tr></table>';

$file[1] = <<<EOD
$style
$instrucciones
<table border="1">
    <tr><th colspan="5"><b>DATOS GENERALES</b></th></tr>
    <tr><td class="t" width="15%"><b>Divisional</b></td><td class="t" width="25%"><b>&Aacute;rea</b></td><td class="t" width="35%"><b>Central</b></td><td class="t" width="10%"><b>Siglas</b></td><td class="c" rowspan="3" width="15%"><b>Folio<br>$folio</b></td></tr>
    <tr><td class="c">$datos[0]</td><td class="c">$datos[1]</td><td class="c">$datos[3]</td><td class="c">$datos[2]</td></tr>
    <tr><td class="t"><b>Rubro</b></td><td class="t"><b>Tecnolog&iacute;a</b></td><td class="t" colspan="2"><b>Proveedor</b></td></tr>
    <tr><td class="c">$datos[16]</td><td class="c">$datos[17]</td><td class="c" colspan="2">$datos[18]</td><td class="c">$datos[15]</td></tr>
</table>
$space
<table border="1">
    <tr><td class="t"><b>Fecha Solicitud</b></td><td class="t"><b>Fecha Programada</b></td><td class="t"><b>Fecha Ejecuci&oacute;n</b></td><td class="t"><b>Fecha Captura</b></td><td class="t"><b>Fecha Validaci&oacute;n</b></td></tr>
    <tr><td class="c">$datos[4]</td><td class="c">$datos[5]</td><td class="c">$datos[7]</td><td class="c">$datos[6]</td><td class="c">$datos[8]</td></tr>
</table>
$space
<table border="1">
	<tr><th colspan="5"><b>CONTACTOS</b></th></tr>
    <tr><td class="t" width="20%"><b>Rol</b></td><td class="t" width="25%"><b>Nombre</b></td><td class="t" width="15%"><b>Tel.</b></td><td class="t" width="15%"><b>M&oacute;vil</b></td><td class="t" width="25%"><b>Correo</b></td></tr>
	<tr><td> Coordinador Telmex</td><td> $datos[9]</td><td class="c">$datos[10]</td><td class="c">$datos[24]</td><td class="c">$datos[11]</td></tr>
	<tr><td> Responsable en Sitio</td><td> $datos[19]</td><td class="c">$datos[20]</td><td class="c">$datos[22]</td><td class="c">$datos[21]</td></tr>
	<tr><td> Contacto Proveedor</td><td> $datos[12]</td><td class="c">$datos[13]</td><td class="c">$datos[25]</td><td class="c">$datos[14]</td></tr>
</table>
$cc
$space
$ub
$space
<table border="1">
    <tr><th colspan="3"><b>ESTADO GENERAL DE SITIO</b></th></tr>
    <tr><td colspan="3" class="g">EDIFICACI&Oacute;N</td></tr>
    $dgt1
    $dgt2
    $dgt4
    $dgt5
</table>
EOD;

$file[2] = <<<EOD
    $style
    <table border="1">
        <tr><th colspan="2"><b>CONEXI&Oacute;N ALTO ORDEN (&Oacute;PTICO)</b></th></tr>
        <tr><td colspan="2" class="gc">BASTIDOR DE FIBRAS</td></tr>
        <tr>
            <td><table border="1">$dgt7</table></td>
            <td><table border="1">$dgt8</table></td>
        </tr>
    </table>
    <table border="1">
		<tr>
            <td><table border="1">$dgt6</table></td>
            <td><table border="1">$dgt48</table></td>
        </tr>
    </table>
    $space
    <table border="1">
		<tr><td colspan="6" class="gc">CANALETA / ESCALERILLA (DEL EQUIPO HACIA RED DE TRANSPORTE)</td></tr>
        $dgt9
    </table>
    $space
    $space
    <table border="1">
        <tr><td colspan="10" class="gc">TRASPASOS / REMATES &Oacute;PTICOS</td></tr>
        <tr><th colspan="10">TABLA DE TRASPASOS / REMATES &Oacute;PTICOS</th></tr>
        <tr>
            <td class="t" width="18%"> <br>Equipo</td>
            <td class="t" width="18%">Ubicaci&oacute;n<br>bastidor<br>fibras</td>
            <td class="t" width="8%"> <br>DFO</td>
            <td class="t" width="8%">Posici&oacute;n<br>de<br>Remate</td>
            <td class="t" width="8%">Conector<br>lado<br>Equipo</td>
            <td class="t" width="8%">Tipo<br>de<br>Fibra</td>
            <td class="t" width="8%">Conector<br>lado<br>DFO</td>
            <td class="t" width="8%"> <br>Tx / Rx</td>
            <td class="t" width="8%">Longitud<br>Jumpers<br>Ruta 1</td>
            <td class="t" width="8%">Longitud<br>Jumpers<br>Ruta 2<br>(opcional)</td>
        </tr>
        $dgt11
    </table>
    $dgt12
EOD;

$file[3] = <<<EOD
    $style
    <table border="1">
        <tr><th colspan="2"><b>CONEXION BAJO ORDEN (&Oacute;PTICO)</b></th></tr>
        <tr><td colspan="2" class="gc">BASTIDOR DE FIBRAS</td></tr>
        <tr>
            <td><table border="1">$dgt14</table></td>
            <td><table border="1">$dgt15</table></td>
		</tr>
		<tr>
            <td><table border="1">$dgt13</table></td>
            <td><table border="1">$dgt49</table></td>
        </tr>
    </table>
	$space
    <table border="1">
	<tr><td colspan="6" class="gc">CANALETA / ESCALERILLA (DEL EQUIPO HACIA RED DE ACCESO)</td></tr>
        $dgt17
    </table>
    $space
    <table border="1">
        <tr><td colspan="10" class="gc">TRASPASOS / REMATES &Oacute;PTICOS</td></tr>
        <tr><th colspan="10">TABLA DE TRASPASOS / REMATES &Oacute;PTICOS</th></tr>
        <tr>
            <td class="t" width="18%"> <br>Equipo</td>
            <td class="t" width="18%">Ubicaci&oacute;n<br>bastidor<br>fibras</td>
            <td class="t" width="8%"> <br>DFO</td>
            <td class="t" width="8%">Posici&oacute;n<br>de<br>Remate</td>
            <td class="t" width="8%">Conector<br>lado<br>Equipo</td>
            <td class="t" width="8%">Tipo<br>de<br>Fibra</td>
            <td class="t" width="8%">Conector<br>lado<br>DFO</td>
            <td class="t" width="8%"> <br>Tx / Rx</td>
            <td class="t" width="8%">Longitud<br>Jumpers<br>Ruta 1</td>
            <td class="t" width="8%">Longitud<br>Jumpers<br>Ruta 2<br>(opcional)</td>
        </tr>
        $dgt18
    </table>
    $dgt19
EOD;

$file[4] = <<<EOD
    $style
    <table border="1">
        <tr><th colspan="2"><b>CONEXI&Oacute;N BAJO ORDEN (MULTIPAR)</b></th></tr>
        <tr><td colspan="2" class="gc">DISTRIBUIDOR GENERAL</td></tr>
        $dgt20
        $dgt21
    </table>
    $space
    <table border="1">
	<tr><td colspan="6" class="gc">CANALETA / ESCALERILLA (DEL EQUIPO HACIA EL DG)</td></tr>
        $dgt23
    </table>
    $space
    <table border="1">
        $dgt24
    </table>
    $space
    $dgt25
EOD;

$file[5] = <<<EOD
    $style
    <table border="1">
        <tr><th colspan="2"><b>COAXIAL</b></th></tr>
        <tr><td colspan="2" class="gc">BASTIDOR TRONCALES DIGITALES</td></tr>
        $dgt26
        $dgt27
    </table>
    $space
    <table border="1">
	<tr><td colspan="6" class="gc">CANALETA / ESCALERILLA</td></tr>
        $dgt29
    </table>
    $space
    <table border="1">
        <tr><td colspan="9" class="gc">TRASPASOS</td></tr>
        <tr><th colspan="9">TABLA DE TRASPASOS</th></tr>
        <tr>
            <td class="t">Equipo / Modelo</td><td class="t">Ubicacion BDTD</td>
            <td class="t">Posicion Tablilla</td><td class="t">Lado</td>
            <td class="t">Posicion Contacto</td><td class="t">Tipo Conector</td>
            <td class="t">Tipo Coaxial</td><td class="t">Transmicion / Recepcion</td>
            <td class="t">Long. de Cable</td>
        </tr>
        $dgt30
    </table>
    $space
    $dgt31
EOD;

$file[6] = <<<EOD
    $style
    <table border="1">
        <tr><th colspan="2"><b>GESTI&Oacute;N Y SINCRON&Iacute;A</b></th></tr>
        <tr><td colspan="2" class="gc">GESTI&Oacute;N</td></tr>
        $dgt32
        $dgt33
        $dgt34
    </table>
    $space
    <table border="1">
        <tr><td colspan="2" class="gc">SINCRON&Iacute;A</td></tr>
        $dgt35
    </table>
    $space
    <table border="1">
        <tr><td colspan="2" class="gc">ALARMAS</td></tr>
        $dgt36
    </table>
    $space
    <table border="1">
	<tr><td colspan="6" class="gc">CANALETA / ESCALERILLA (DEL EQUIPO HACIA GESTI&Oacute;N / SINCRON&Iacute;A)</td></tr>
        $dgt38
    </table>
    $space
    <table border="1">
        <tr><td colspan="7" class="gc">TRASPASOS</td></tr>
        <tr><th colspan="7">TABLA DE REMATES GESTI&Oacute;N</th></tr>
        <tr>
            <td class="t">Equipo / Modelo</td>
            <td class="t">Ubicaci&oacute;n RCDT</td>
            <td class="t">N&uacute;mero Switch</td>
            <td class="t">Puerto</td>
            <td class="t">Categor&iacute;a Cable</td>
            <td class="t">Long. de Cable</td>
            <td class="t">Tipo Conector</td>
        </tr>
        $dgt39
        <tr><th colspan="7">TABLA DE REMATES SINCRONIA</th></tr>
        <tr>
            <td class="t">Equipo / Modelo</td>
            <td class="t">Ubicaci&oacute;n RCDT</td>
            <td class="t">N&uacute;mero Switch</td>
            <td class="t">Puerto</td>
            <td class="t">Categor&iacute;a Cable</td>
            <td class="t">Long. de Cable</td>
            <td class="t">Tipo Conector</td>
        </tr>
        $dgt40
        $space
        $dgt41
    </table>
    $space
EOD;

$file[7] = <<<EOD
    $style
    <table border="1">
        <tr><th colspan="2"><b>ALIMENTACI&Oacute;N Y TIERRAS</b></th></tr>
        <tr><td colspan="2" class="gc">ALIMENTACI&Oacute;N</td></tr>
        $dgt42
    </table>
    <table border="1">
        <tr><th>CONFIGURACION DE LA PLANTA</th><th>CONSUMO ACTUAL</th></tr>
        <tr><td class="c">$dg[71]</td><td class="c">$dg[73]</td></tr>
    </table>
    $space
    <table border="1">
	<tr><td colspan="6" class="gc">CANALETA / ESCALERILLA (DEL EQUIPO HACIA ALIMENTACI&Oacute;N)</td></tr>
        $dgt44
    </table>
    $space
    <table border="1">
        <tr><td colspan="9" class="gc">TRASPASOS</td></tr>
        <tr><th colspan="9">TABLA DE TRASPASOS</th></tr>
        <tr>
            <td class="t">Equipo / Modelo</td><td class="t">Tipo Consumo Fuerza</td>
            <td class="t">Ubicación Alimentaci&oacute;n</td><td class="t">P. de Fusible o Breaker</td>
            <td class="t">Capacidad de Fusible</td><td class="t">Calibre de Cable</td>
            <td class="t">Long. del Cable de Fza.</td><td class="t">Cant. de Cables</td>
            <td class="t">Tipo de Zapata</td>
        </tr>
        $dgt45
    </table>
    $space
    $dgt46
EOD;

$file[8] = <<<EOD
    $style
	<table border="1">
        <tr><th colspan="2"><b>REPORTE FOTOGR&Aacute;FICO</b></th></tr>
    </table>
    $dgt47_1
	$dgt47_2
EOD;

$pdfresumen=<<<EOD
    $style
	<table border="1">
        <tr><th colspan="2"><b>RESUMEN</b></th></tr>
    </table>
	$dgt50
EOD;

 for($i = 0; $i < count($vz); $i++){
     $pdf->AddPage();
     $pdf->writeHTML($file[$vz[$i]], true, false, false, false, '');
 }
 
// $pdf->addPage();
// $pdf->setEqualColumns(2, null);
// $pdf->selectColumn(0);
// $cadena='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>1</div>';
// $cadena.='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>2</div>';
// $cadena.='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>3</div>';
// $pdf->writeHTML($cadena, true, false, true, false, 'J');
// $pdf->Ln();

// $pdf->selectColumn(1);
// $cadena='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>4</div>';
// $cadena.='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>5</div>';
// $cadena.='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>6</div>';
// $pdf->writeHTML($cadena, true, false, true, false, 'J');
// $pdf->Ln();

// $pdf->addPage();
// $pdf->setEqualColumns(2, null);
// $pdf->selectColumn(0);
// $cadena='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>1</div>';
// $cadena.='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>2</div>';
// $cadena.='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>3</div>';
// $pdf->writeHTML($cadena, true, false, true, false, 'J');
// $pdf->Ln();

// $pdf->selectColumn(1);
// $cadena='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>4</div>';
// $cadena.='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>5</div>';
// $cadena.='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>6</div>';
// $pdf->writeHTML($cadena, true, false, true, false, 'J');
// $pdf->Ln();

$pdf->Output();
?>