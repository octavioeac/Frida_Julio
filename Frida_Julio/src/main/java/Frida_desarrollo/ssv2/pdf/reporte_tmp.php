<?php
include '../classes/Conn.php';
//include '../classes/TablaCanaleta.php';
include '../classes/CanaletasV4.php';
include ('../functions/conexion.php');
include ('tcpdf/tcpdf.php');
ini_set('error_reporting','E_ALL ^ E_NOTICE');

class PDF_SiteSurvey extends TCPDF {
	private $folio;
	private $pestana=array(); //Array ( [0] => 1 [1] => 2 [2] => 3 [3] => 4 [4] => 5 [5] => 6 [6] => 7 [7] => 8 )
	private $estilo;
	private $espacio;
	private $ds=array(); //DATOS GENERALES DEL SURVEY
	
	public function __construct($folio){
		parent::__construct();
		$this->folio=$folio;
		$this->estilo= '<style type="text/css">th{background-color:#72a6f3;color#000000;text-align:center;}.t{background-color:#cae4ff;text-align:center;}.c{text-align:center}.g{background-color:#e8e8e8}.gc{text-align:center;background-color:#e8e8e8}td{padding:3px;}</style>';
		$this->espacio= '<table height="10"><tr><td></td></tr></table>';
		$this->Habilitada();
		$this->SetFont('Helvetica','N',8);
		$this->SetCreator(PDF_CREATOR);
		$this->SetAuthor('FRIDA');
		$this->SetTitle('FRIDA - SITE SURVEY');
		$this->SetSubject('REPORTE SITE SURVEY');
		$this->SetHeaderData('telmex.png', '20', 'TELÉFONOS DE MÉXICO S.A.B. DE C.V.', "SITE SURVEY");
		$this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$this->SetHeaderMargin(PDF_MARGIN_HEADER);
		$this->SetFooterMargin(PDF_MARGIN_FOOTER);
		$this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$this->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$this->GeneraDocumento();
                
	}
	
	public function Footer() { //Sobreescribe la función defaul Footer para agregar la fecha del documento al pie de página
		$cur_y = $this->y;
		$this->SetTextColorArray($this->footer_text_color);
		//set style for cell border
		@$line_width = (0.85 / $this->k);
		$this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => $this->footer_line_color));
		//print document barcode
		$barcode = $this->getBarcode();
		if (!empty($barcode)) {
			$this->Ln($line_width);
			$barcode_width = round(($this->w - $this->original_lMargin - $this->original_rMargin) / 3);
			$style = array(
				'position' => $this->rtl?'R':'L',
				'align' => $this->rtl?'R':'L',
				'stretch' => false,
				'fitwidth' => true,
				'cellfitalign' => '',
				'border' => false,
				'padding' => 0,
				'fgcolor' => array(0,0,0),
				'bgcolor' => false,
				'text' => false
			);
			$this->write1DBarcode($barcode, 'C128', '', $cur_y + $line_width, '', (($this->footer_margin / 3) - $line_width), 0.3, $style, '');
		}
		$w_page = isset($this->l['w_page']) ? $this->l['w_page'].' ' : '';
		if (empty($this->pagegroups)) {
			$pagenumtxt = 'Estatus del documento: '.$this->ds['estatus'].' - Fecha de Descarga: '.date("Y.m.d").' - Página '.$w_page.$this->getAliasNumPage().' de '.$this->getAliasNbPages();
		} else {
			$pagenumtxt = 'Estatus del documento: '.$this->ds['estatus'].' - Fecha de Descarga'.date("Y.m.d").' - Página '.$w_page.$this->getPageNumGroupAlias().' de '.$this->getPageGroupAlias();
		}
		$this->SetY($cur_y);
		//Print page number
		if ($this->getRTL()) {
			$this->SetX($this->original_rMargin);
			$this->Cell(0, 0, $pagenumtxt, 'T', 0, 'L');
		} else {
			$this->SetX($this->original_lMargin);
			$this->Cell(0, 0, $this->getAliasRightShift().$pagenumtxt, 'T', 0, 'R');
		}
	}
	
	private function Habilitada(){
		$tags=array();
        $habilitadas = array();
        $query = "SELECT ztecnologias.tags FROM zss_equipos,ztecnologias WHERE zss_equipos.id_tecnologia=ztecnologias.id AND zss_equipos.folio='".$this->folio."'";
        $result = mysql_query($query);
        $sz = mysql_num_rows($result);
        if($sz > 0){
            for($i = 0;$i < $sz; $i++){
                $d = mysql_fetch_array($result);
                $tags[$i] = explode(',',$d['tags']);
            }
        }    
        for($i = 0; $i < count($tags); $i++){
            $habilitadas = array_merge($habilitadas, $tags[$i]);
        }
        $habilitadas = array_unique($habilitadas);
        sort($habilitadas);  
		$this->pestana=$habilitadas;
    }
	
	private function GeneraDocumento(){
		$arr=$this->pestana;
		$this->DatosGenerales();
		$arr[]='r';
		foreach($arr as $id=>$val){ //GENERA CADA SECCIÓN DEL DOCUMENTO
			switch($val){
				case '1': 	$this->PagEstadoGeneral();		break;
				case '2': 	$this->PagAltoOrdenOptico();	break;
				case '3': 	$this->PagBajoOrdenOptico();	break;
				case '4':	$this->PagBajoOrdenMultipar();	break;
				case '5':	$this->PagBajoOrdenCoaxial();	break;
				case '6':	$this->PagGestion();			break;
				case '7':	$this->PagAlimentacion();		break;
				case '8':	$this->PagReporteFotografico();
							//$this->PagPlanos();
				break;
				case '9':	$this->PagRadios(); break;
				case 'r':	$this->PagResumen();	break;
				default: break;
			}
		}
	}
	
	private function PagEstadoGeneral(){
		$labels = new CanaletasV4($this->folio);
                $this->addPage();
		$this->FondoPreliminar();
		$cadena=$this->estilo.
			$this->instrucciones.
			'<table border="1">
			<tr><th colspan="5"><b>DATOS GENERALES</b></th></tr>
			<tr><td class="t" width="15%"><b>Divisional</b></td><td class="t" width="25%"><b>&Aacute;rea</b></td><td class="t" width="35%"><b>Central</b></td><td class="t" width="10%"><b>Siglas</b></td><td class="c" rowspan="3" width="15%"><b>Folio<br>'.$this->folio.'</b></td></tr>
			<tr><td class="c">'.$this->ds['dir_div'].'</td><td class="c">'.$this->ds['area'].'</td><td class="c">'.$this->ds['edificio'].'</td><td class="c">'.$this->ds['sigcent'].'</td></tr>
			<tr><td class="t"><b>Rubro</b></td><td class="t"><b>Tecnolog&iacute;a</b></td><td class="t" colspan="2"><b>Proveedor</b></td></tr>
			<tr><td class="c">'.$this->ds['rubro_f'].'</td><td class="c">'.$this->ds['tecnologia'].'</td><td class="c" colspan="2">'.$this->ds['prove'].'</td><td class="c">'.$this->ds['estatus'].'</td></tr>
			</table>'.
			$this->espacio.
			'<table border="1">
			<tr><td class="t"><b>Fecha Solicitud</b></td><td class="t"><b>Fecha Programada</b></td><td class="t"><b>Fecha Ejecuci&oacute;n</b></td><td class="t"><b>Fecha Captura</b></td><td class="t"><b>Fecha Validaci&oacute;n</b></td></tr>
			<tr><td class="c">'.$this->ds['fecha_solicitud_f'].'</td><td class="c">'.$this->ds['fecha_programada_f'].'</td><td class="c">'.$this->ds['fecha_ejecucion_f'].'</td><td class="c">'.$this->ds['fecha_captura_f'].'</td><td class="c">'.$this->ds['fecha_validacion_f'].'</td></tr>
			</table>'.
			$this->espacio.
			'<table border="1">
			<tr><th colspan="5"><b>CONTACTOS</b></th></tr>
			<tr><td class="t" width="20%"><b>Rol</b></td><td class="t" width="25%"><b>Nombre</b></td><td class="t" width="15%"><b>Tel.</b></td><td class="t" width="15%"><b>M&oacute;vil</b></td><td class="t" width="25%"><b>Correo</b></td></tr>
			<tr><td> Coordinador Telmex</td><td> '.$this->ds['ctnombre'].'</td><td class="c">'.$this->ds['cttelefono'].'</td><td class="c">'.$this->ds['ctmovil'].'</td><td class="c">'.$this->ds['ctemail'].'</td></tr>
			<tr><td> Responsable en Sitio</td><td> '.$this->ds['rsnombre'].'</td><td class="c">'.$this->ds['rstelefono'].'</td><td class="c">'.$this->ds['rsmovil'].'</td><td class="c">'.$this->ds['rsemail'].'</td></tr>
			<tr><td> Contacto Proveedor</td><td> '.$this->ds['cpnombre'].'</td><td class="c">'.$this->ds['cptelefono'].'</td><td class="c">'.$this->ds['cpmovil'].'</td><td class="c">'.$this->ds['cpemail'].'</td></tr>
			</table>'.
			$this->ccemail().
			$this->espacio.
			$this->ubxeq().
			$this->espacio.
                        '<table border="1">'
                        . '<tr><th colspan="7"><b>CANALETAS / ESCALERILLAS</b></th></tr>'
                        . '<tr><td class="t"><b>PESTAÑA</b></td><td class="t"><b>MATERIAL</b></td><td class="t"><b>NUEVO / EXISTENTE</b></td><td class="t"><b>ALTURA AL BASTIDOR</b></td>'
                        . '<td class="t"><b>LARGO TRAYECTORIA</b></td><td class="t"><b>PULGADAS</b></td><td class="t"><b>BAJANTE REQUERIDA</b></td></tr>'
                        . $labels->cadena
                        . '</tr></table>'.
                        $this->espacio.
			'<table border="1">
			<tr><th colspan="3"><b>ESTADO GENERAL DE SITIO</b></th></tr>
			<tr><td colspan="3" class="g">EDIFICACI&Oacute;N</td></tr>'.
			$this->ArmarTabla01(array('Nuevo','Ampliacion'),$this->ds['eg_tipotrabajo'],'TIPO DE TRABAJO',$this->ds['eg_coment_tipotrabajo']).
			$this->ArmarTabla01(array('Gabinete Outdoor','Contenedor','Central','Concentrador','Repetidor'),$this->ds['eg_tipocentral'],'TIPO DE CENTRAL',$this->ds['eg_coment_tipocentral']).
			$this->ArmarTabla01(array('Piso Firme','Piso Falso','Plataforma'),$this->ds['eg_tipodepiso'],'TIPO DE PISO EN EL SITIO',$this->ds['eg_coment_tipodepiso']).
			$this->ArmarTabla01(array('Sala Nueva','Fila Nueva','Requiere Pasa Muros','Entre Piso','Ninguna'),$this->ds['eg_obracivil'],'OBRA CIVIL',$this->ds['eg_coment_obracivil']).
                        $this->ArmarTabla01(array('Polipasto','Poleas y lazos','Maniobra simple'),$this->ds['eg_tipomaniobra'],'TIPO DE MANIOBRA',$this->ds['eg_coment_tipomaniobra']).
			'</table>'.$this->espacio;
		//echo $cadena;
		$this->EscribeHTML($cadena);
	}
	
	private function PagAltoOrdenOptico(){
                        //$canafo = new TablaCanaleta($this->folio,2);
                        
			$this->addPage();
			$cadena = $this->estilo.
			'<table border="1">
			<tr><th colspan="2"><b>CONEXI&Oacute;N ALTO ORDEN (&Oacute;PTICO)</b></th></tr>
			<tr><td colspan="2" class="gc">BASTIDOR DE FIBRAS</td></tr>
			<tr>
            <td><table border="1">'.$this->ArmarTabla02(array('TYCO','ADC','OTRO'),$this->ds['afo_bastidor_marca'],'MARCA').'</table></td>
            <td><table border="1">'.$this->ArmarTabla02(array('Tradicional','Alta Densidad','Mini DFO'),$this->ds['afo_tipo_bastidor_fibra'],'TIPO DE BASTIDOR DE FIBRAS').'</table></td>
			</tr>
			</table>
			<table border="1">
			<tr>
			<td><table border="1">'.$this->ArmarTabla02(array('Existente','Nuevo'),$this->ds['afo_bastidor_fibra'],'BASTIDOR DE FIBRAS').'</table></td>
            <td><table border="1">'.$this->ArmarTabla02(array('Existente','Nuevo'),$this->ds['afo_bloque_dfo'],'COMBO / BLOQUE DFO').'</table></td>
			</tr>
			</table>'.
			$this->espacio.
			/*'<table border="1">
			<tr><td colspan="6" class="gc">CANALETA / ESCALERILLA (DEL EQUIPO HACIA RED DE TRANSPORTE)</td></tr>
                        <tr>
                            <td class="t">Tipo</td>
                            <td class="t">Existente o<br>Nueva</td>
                            <td class="t">Altura<br>al bastidor<br>(mts)</td>
                            <td class="t">Longitud<br>Trayectorias<br>(mts)</td>
                            <td class="t">Ancho<br>(pulgadas)</td>
                            <td class="t">Bajantes<br>Requeridas</td></tr>'.
			$canafo->tabla.
			'</table>'.*/
			$this->espacio.$this->espacio.
			'<table border="1">
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
			</tr>'.
			$this->abfo(1).
			'</table>'.
			$this->ArmarTabla05($this->ds['afo_comentarios']);
		//echo $cadena;
		$this->EscribeHTML($cadena);
	}
	
	private function PagBajoOrdenOptico(){
            //$canbfo = new TablaCanaleta($this->folio,3);
		$this->addPage();
		$cadena = $this->estilo.
			'<table border="1">
			<tr><th colspan="2"><b>CONEXI&Oacute;N BAJO ORDEN (&Oacute;PTICO)</b></th></tr>
			<tr><td colspan="2" class="gc">BASTIDOR DE FIBRAS</td></tr>
			<tr>
            <td><table border="1">'.$this->ArmarTabla02(array('TYCO','ADC','OTRO'),$this->ds['bfo_bastidor_marca'],'MARCA').'</table></td>
            <td><table border="1">'.$this->ArmarTabla02(array('Tradicional','Alta Densidad','Mini DFO'),$this->ds['bfo_tipo_bastidor_fibra'],'TIPO DE BASTIDOR DE FIBRAS').'</table></td>
			</tr>
			</table>
			<table border="1">
			<tr>
			<td><table border="1">'.$this->ArmarTabla02(array('Existente','Nuevo'),$this->ds['bfo_bastidor_fibra'],'BASTIDOR DE FIBRAS').'</table></td>
            <td><table border="1">'.$this->ArmarTabla02(array('Existente','Nuevo'),$this->ds['bfo_bloque_dfo'],'COMBO / BLOQUE DFO').'</table></td>
			</tr>
			</table>'.
			$this->espacio.
			/*'<table border="1">
			<tr><td colspan="6" class="gc">CANALETA / ESCALERILLA (DEL EQUIPO HACIA RED DE ACCESO)</td></tr><tr>
                            <tr><td class="t">Tipo</td>
                            <td class="t">Existente o<br>Nueva</td>
                            <td class="t">Altura<br>al bastidor<br>(mts)</td>
                            <td class="t">Longitud<br>Trayectorias<br>(mts)</td>
                            <td class="t">Ancho<br>(pulgadas)</td>
                            <td class="t">Bajantes<br>Requeridas</td></tr>'.
			$canbfo->tabla.
			'</table>'.*/
			$this->espacio.$this->espacio.
			'<table border="1">
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
			</tr>'.
			$this->abfo(0).
			'</table>'.
			$this->ArmarTabla05($this->ds['bfo_comentarios']);
		//echo $cadena;
		$this->EscribeHTML($cadena);
	}
	
	private function PagBajoOrdenMultipar(){
            //$canmtp = new TablaCanaleta($this->folio,4);
		$this->addPage();
		$cadena=$this->estilo.
			'<table border="1">
			<tr><th colspan="2"><b>CONEXI&Oacute;N BAJO ORDEN (MULTIPAR)</b></th></tr>
			<tr><td colspan="2" class="gc">DISTRIBUIDOR GENERAL</td></tr>
			<tr>
			<td><table border="1">'.$this->ArmarTabla02(array('Existente','Nuevo'),$this->ds['mp_dgral'],'SE UTILIZARA DISTRIBUIDOR GENERAL').'</table></td>
			<td><table border="1">'.$this->ArmarTabla02(array('Si','No'),$this->ds['mp_ampvertical'],'REQUIERE AMPLIACI&Oacute;N DE VERTICALES').'</table></td>
			</tr>
			</table>'.
			'<table border="1">
			<tr>
			<td><table border="1">'.$this->ArmarTabla02(array('7 y 9 un lado versablock','9 y 11.5 dos lados versablock','5 y 10 niveles portasystem','Exterior'),$this->ds['mp_disgral'],'TIPO DE DISTRIBUIDOR GENERAL').'</table></td>
			<td>&nbsp;</td>
			</tr>
			</table>'.
			$this->espacio.
			/*'<table border="1">
			<tr><td colspan="6" class="gc">CANALETA / ESCALERILLA (DEL EQUIPO HACIA EL DG)</td></tr>
                            <tr><td class="t">Tipo</td>
                            <td class="t">Existente o<br>Nueva</td>
                            <td class="t">Altura<br>al bastidor<br>(mts)</td>
                            <td class="t">Longitud<br>Trayectorias<br>(mts)</td>
                            <td class="t">Ancho<br>(pulgadas)</td>
                            <td class="t">Bajantes<br>Requeridas</td></tr>'.
                        $canmtp->tabla.
			'</table>'.*/
			$this->espacio.
			'<table border="1">'.
			$this->Multipar().
			'</table>'.
			$this->espacio.
			$this->ArmarTabla05($this->ds['mp_comentarios']);
		//echo $cadena;
		$this->EscribeHTML($cadena);
	}
	
	private function PagBajoOrdenCoaxial(){
            //$cancxl = new TablaCanaleta($this->folio,5);
		$this->addPage();
		$cadena=$this->estilo.
			'<table border="1">
			<tr><th colspan="2"><b>COAXIAL</b></th></tr>
			<tr><td colspan="2" class="gc">BASTIDOR TRONCALES DIGITALES</td></tr>'.
			$this->ArmarTabla02(array('Existente','Nuevo'),$this->ds['cx_escalerilla_bdtd'],'SE UTILIZARA BDTD').
			$this->ArmarTabla02(array('Tradicional','Alta Densidad'),$this->ds['cx_tipo_escalerilla_bdtd'],'TIPO DE BDTD').
			'</table>'.
			$this->espacio.
			/*'<table border="1">
			<tr><td colspan="6" class="gc">CANALETA / ESCALERILLA</td></tr>
                            <tr><td class="t">Tipo</td>
                            <td class="t">Existente o<br>Nueva</td>
                            <td class="t">Altura<br>al bastidor<br>(mts)</td>
                            <td class="t">Longitud<br>Trayectorias<br>(mts)</td>
                            <td class="t">Ancho<br>(pulgadas)</td>
                            <td class="t">Bajantes<br>Requeridas</td></tr>'.
                        $cancxl->tabla.
			'</table>'.*/
			$this->espacio.
			'<table border="1">
			<tr><td colspan="9" class="gc">TRASPASOS</td></tr>
			<tr><th colspan="9">TABLA DE TRASPASOS</th></tr>
			<tr>
			<td class="t">Equipo / Modelo</td><td class="t">Ubicacion BDTD</td>
			<td class="t">Posicion Tablilla</td><td class="t">Lado</td>
			<td class="t">Posicion Contacto</td><td class="t">Tipo Conector</td>
			<td class="t">Tipo Coaxial</td><td class="t">Transmicion / Recepcion</td>
			<td class="t">Long. de Cable</td>
			</tr>'.
			$this->Coaxial().
			'</table>'.
			$this->espacio.
			$this->ArmarTabla05($this->ds['cx_comentarios']);
		//echo $cadena;
		$this->EscribeHTML($cadena);
	}
	
	private function PagGestion(){
            //$cangys = new TablaCanaleta($this->folio,6);
		$this->addPage();
		$cadena = $this->estilo.
			'<table border="1">
			<tr><th colspan="2"><b>GESTI&Oacute;N Y SINCRON&Iacute;A</b></th></tr>
			<tr><td colspan="2" class="gc">GESTI&Oacute;N</td></tr>'.
			$this->ArmarTabla02(array('Si','No'),$this->ds['gs_requieregestion'],'REQUIERE GESTION').
			$this->ArmarTabla02(array('En Banda','Fuera de Banda'),$this->ds['gs_tipogestion'],'TIPO DE GESTION').
			$this->ArmarTabla02(array('Existente','Nuevo'),$this->ds['gs_puertoRCDT'],'SE UTILIZARA PUERTO RCDT').
			'</table>'.
			$this->espacio.
			'<table border="1">
			<tr><td colspan="2" class="gc">SINCRON&Iacute;A</td></tr>'.
			$this->ArmarTabla02(array('Si','No'),$this->ds['gs_requieresincronia'],'REQUIERE SINCRONIA').
			'</table>'.
			$this->espacio.
			'<table border="1">
			<tr><td colspan="2" class="gc">ALARMAS</td></tr>'.
			$this->ArmarTabla02(array('Si','No'),$this->ds['gs_cnaddalarmas'],'REQUIERE CONEXION ADICIONAL DE ALARMAS').
			'</table>'.
			$this->espacio.
			/*'<table border="1">
			<tr><td colspan="6" class="gc">CANALETA / ESCALERILLA (DEL EQUIPO HACIA GESTI&Oacute;N / SINCRON&Iacute;A)</td></tr>
                            <tr><td class="t">Tipo</td>
                            <td class="t">Existente o<br>Nueva</td>
                            <td class="t">Altura<br>al bastidor<br>(mts)</td>
                            <td class="t">Longitud<br>Trayectorias<br>(mts)</td>
                            <td class="t">Ancho<br>(pulgadas)</td>
                            <td class="t">Bajantes<br>Requeridas</td></tr>'.
                        $cangys->tabla.
			'</table>'.*/
			$this->espacio.
			'<table border="1">
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
			</tr>'.
			
			$this->gestionSincronia(0).
			'<tr><th colspan="7">TABLA DE REMATES SINCRONIA</th></tr>
			<tr>
            <td class="t">Equipo / Modelo</td>
            <td class="t">Ubicaci&oacute;n RCDT</td>
            <td class="t">N&uacute;mero Switch</td>
            <td class="t">Puerto</td>
            <td class="t">Categor&iacute;a Cable</td>
            <td class="t">Long. de Cable</td>
            <td class="t">Tipo Conector</td>
			</tr>'.
			$this->gestionSincronia(1).
			$this->espacio.
			$this->ArmarTabla05($this->ds['gs_comentarios']).
			'</table>'.
			$this->espacio;
		//echo $cadena;
		$this->EscribeHTML($cadena);
	}
	
	private function PagAlimentacion(){
            //$canali = new TablaCanaleta($this->folio,7);
		$this->addPage();
		$cadena =$this->estilo.
			'<table border="1">
			<tr><th colspan="2"><b>ALIMENTACI&Oacute;N Y TIERRAS</b></th></tr>
			<tr><td colspan="2" class="gc">ALIMENTACI&Oacute;N</td></tr>'.
			$this->ArmarTabla02(array('Planta','Distribuidor de Fuerza (GLT)','Remoto en Bastidor'),$this->ds['fz_tp_alimen'],'TIPO DE ALIMENTACIÓN').
			'</table>
			<table border="1">
			<tr><th>CONFIGURACION DE LA PLANTA</th><th>CONSUMO ACTUAL</th></tr>
			<tr><td class="c">'.$this->ds['fz_configplanta'].'</td><td class="c">'.$this->ds['fz_consumo'].'</td></tr>
			</table>'.
			$this->espacio.
                        '<table border="1">'
                        . '<tr><td colspan="2" class="gc">TIERRAS</td></tr>'
                        . $this->ArmarTabla02(array('Tierra general de piso','Tierra general de sala','Tierra de fila','Tierra en repisa'),$this->ds['fz_escalerilla_bdtd'],'TIPO DE TIERRA')
                        . '</table>'.
			/*'<table border="1">
			<tr><td colspan="6" class="gc">CANALETA / ESCALERILLA (DEL EQUIPO HACIA ALIMENTACI&Oacute;N)</td></tr>
                            <tr><td class="t">Tipo</td>
                            <td class="t">Existente o<br>Nueva</td>
                            <td class="t">Altura<br>al bastidor<br>(mts)</td>
                            <td class="t">Longitud<br>Trayectorias<br>(mts)</td>
                            <td class="t">Ancho<br>(pulgadas)</td>
                            <td class="t">Bajantes<br>Requeridas</td></tr>'.
                        $canali->tabla.
			'</table>'.*/
			$this->espacio.
			'<table border="1">
			<tr><td colspan="9" class="gc">TRASPASOS</td></tr>
			<tr><th colspan="9">TABLA DE TRASPASOS</th></tr>
			<tr>
            <td class="t">Equipo / Modelo</td><td class="t">Tipo Consumo Fuerza</td>
            <td class="t">Ubicación Alimentaci&oacute;n</td><td class="t">P. de Fusible o Breaker</td>
            <td class="t">Capacidad de Fusible</td><td class="t">Calibre de Cable</td>
            <td class="t">Long. del Cable de Fza.</td><td class="t">Cant. de Cables</td>
            <td class="t">Tipo de Zapata</td>
			</tr>'.
			$this->Fuerza().
			'</table>'.
			$this->espacio.
			$this->ArmarTabla05($this->ds['fz_comentarios']);
		//echo $cadena;
		$this->EscribeHTML($cadena);
	}
	
	private function PagPlanos(){
		$this->addPage();
		$cadena=$this->estilo.
			'<table border="1">
			<tr><th colspan="2"><b>PLANOS</b></th></tr>
			</table>';
		$this->EscribeHTML($cadena);
	}
	
	private function PagReporteFotografico(){
		$query = "SELECT * FROM zarchivos where folio = '".$this->folio."' and tipo like 'image%' ORDER BY tipo,id";
        $result = mysql_query($query);
        $n = mysql_num_rows($result);
        if($n > 0){
			$enc=$this->estilo.'<table border="1" width="310"><tr><th colspan="2"><b>REPORTE FOTOGR&Aacute;FICO</b></th></tr></table>'.$this->espacio;
			$this->setEqualColumns(2, null);
			$i=0;
			while($i<$n){
				$d=mysql_fetch_array($result,MYSQL_ASSOC);
				$aux=($i%2==0)?0:1;
				$cadena='';
				if($i%6==0 or $i==0){
					$this->addPage();
					$this->selectColumn($aux);$cadena=$enc;
				}else{
					if($i%3==0 or $i==0){
						$this->selectColumn($aux);$cadena=$enc;
					}
					else {}
				}
				$cadena.='<div><img border="1" width="310" height="200" src="http://frida/anexos/SiteSurvey/'.$d['nombre'].'"/>'.$d['descripcion'].'</div>'.$this->espacio;
				//echo $cadena;
				$this->EscribeHTML($cadena);
				$i++;
			}
			$this->resetColumns();
		}
		/**/
		// $this->addPage();
		// $cadena=$this->estilo.
		// '<table border="1">
		// <tr><th colspan="2"><b>REPORTE FOTOGR&Aacute;FICO</b></th></tr>
		// </table>';
		// $this->setEqualColumns(2, null);
		// $this->selectColumn(0);
		// $cadena.='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>1</div>';
		// $cadena.='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>2</div>';
		// $cadena.='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>3</div>';
		// $this->writeHTML($cadena);
		// $this->Ln();

		// $this->selectColumn(1);
		// $cadena=$this->estilo.
		// '<table border="1">
		// <tr><th colspan="2"><b>REPORTE FOTOGR&Aacute;FICO</b></th></tr>
		// </table>';
		// $cadena.='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>4</div>';
		// $cadena.='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>5</div>';
		// $cadena.='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>6</div>';
		// $this->writeHTML($cadena);
		// $this->Ln();

		// $this->addPage();
		// $this->setEqualColumns(2, null);
		// $this->selectColumn(0);
		// $cadena='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>1</div>';
		// $cadena.='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>2</div>';
		// $cadena.='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>3</div>';
		// $this->writeHTML($cadena, true, false, true, false, 'J');
		// $this->Ln();

		// $this->selectColumn(1);
		// $cadena='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>4</div>';
		// $cadena.='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>5</div>';
		// $cadena.='<div border="1"><img border="1" width="320" height="200" src="../../../Archivos/sitesurvey/prueba1.jpg"/>6</div>';
		// $this->writeHTML($cadena, true, false, true, false, 'J');
		// $this->Ln();
		// $this->resetColumns();
		//echo $cadena;
	}
	
	private function PagResumen(){
		$this->addPage();
		$n=mysql_fetch_array(mysql_query("SELECT a.folio,
			count(*) as c_nuevos,
			sum(a.puertos) as puertos,
			sum(a.tarjetas) as tarjetas,
			group_concat(distinct concat(a.nombre_equipo,' ( ',d.clli_isam,' )') order by a.nombre_equipo separator ', ') as nombres_equipos,
			group_concat( distinct b.tipo_equipo separator ', ') as tipo_equipo,
			b.cod_tarjeta
			from zss_equipos a
			inner join zsite_survey c on a.folio=c.folio 
			inner join ztecnologias b on c.tecno=b.id
			left join isam_unica d on a.nombre_equipo=d.nombre_oficial_pisa 
			where 
			a.folio='$this->folio' 
			and a.tipo_trabajo='Repisa Nueva'
			group by a.folio"),MYSQL_ASSOC);
		$t=mysql_fetch_array(mysql_query("SELECT a.folio,count(*) as c_nuevos,sum(a.puertos) as puertos,sum(a.tarjetas) as tarjetas,group_concat( distinct a.nombre_equipo order by a.nombre_equipo separator ', ') as nombres_equipos,group_concat( distinct b.tipo_equipo separator ', ') as tipo_equipo,b.cod_tarjeta from zss_equipos  a, ztecnologias b, zsite_survey c where a.folio='$this->folio' and a.tipo_trabajo='Tarjetas Nuevas' and c.tecno=b.id and a.folio=c.folio group by a.folio"),MYSQL_ASSOC);
		$b=mysql_fetch_array(mysql_query("select ceil(count(*)/3) as bastidores from zss_equipos where tipo_trabajo='Repisa Nueva' and nuevoexistente='Nuevo' and folio='$this->folio'"),MYSQL_ASSOC);
		$pots=mysql_fetch_array(mysql_query("SELECT group_concat(distinct concat(a.vertical,a.nivel) order by a.vertical,a.nivel separator ', ') as dg from zinter_mp a,zss_equipos b where a.folio='$this->folio' and a.pots_dsl=0 and a.id_equipo=b.id and b.tipo_trabajo='Repisa Nueva' group by a.folio"),MYSQL_ASSOC);
		$dsl=mysql_fetch_array(mysql_query("SELECT group_concat(distinct concat(a.vertical,a.nivel) order by a.vertical,a.nivel separator ', ') as dg from zinter_mp a,zss_equipos b where a.folio='$this->folio' and a.pots_dsl=1 and a.id_equipo=b.id and b.tipo_trabajo='Repisa Nueva' group by a.folio"),MYSQL_ASSOC);
		$tab=mysql_fetch_array(mysql_query("select (SELECT count(*) from zinter_mp a,zss_equipos b where a.folio='$this->folio' and a.tipo_tablilla='Versablock' and a.id_equipo=b.id and b.tipo_Trabajo='Repisa Nueva' group by a.folio) v, (SELECT count(*) from zinter_mp a,zss_equipos b where a.folio='$this->folio' and a.tipo_tablilla='Portasystem' and a.id_equipo=b.id and b.tipo_Trabajo='Repisa Nueva' group by a.folio) p"),MYSQL_ASSOC);
		$dfo=mysql_fetch_array(mysql_query("select (select group_concat(distinct right(a.ubicacion,4) separator ', ') from zinter_abfo a,zss_equipos b where a.folio='$this->folio' and a.id_equipo=b.id and b.tipo_Trabajo='Repisa Nueva' group by a.folio) a, (select group_concat(distinct left(a.ubicacion,length(a.ubicacion)-4) separator ', ') from zinter_abfo a,zss_equipos b where a.folio='$this->folio' and a.id_equipo=b.id and b.tipo_Trabajo='Repisa Nueva' group by a.folio) b "),MYSQL_ASSOC);
		$fz=mysql_fetch_array(mysql_query("select (select group_concat(distinct a.ub_alimen separator ', ') from zinter_fz a,zss_equipos b where a.folio='$this->folio' and a.id_equipo=b.id and b.tipo_Trabajo='Repisa Nueva' group by a.folio) b, (select group_concat(distinct a.pf_breaker separator ', ') from zinter_fz a,zss_equipos b where a.folio='$this->folio' and a.id_equipo=b.id and b.tipo_Trabajo='Repisa Nueva' group by a.folio) a "),MYSQL_ASSOC);
		//$clli=mysql_fetch_array(mysql_query("select (select group_concat(distinct a.ub_alimen separator ', ') from zinter_fz a,zss_equipos b where a.folio='$this->folio' and a.id_equipo=b.id and b.tipo_Trabajo='Repisa Nueva' group by a.folio) b, (select group_concat(distinct a.pf_breaker separator ', ') from zinter_fz a,zss_equipos b where a.folio='$this->folio' and a.id_equipo=b.id and b.tipo_Trabajo='Repisa Nueva' group by a.folio) a "),MYSQL_ASSOC);
		$tab_aux="";
		if($tab['v']>0) $tab_aux=$tab['v']." TABLILLAS VERSABLOCK (256ps) ";
		if($tab['p']>0) $tab_aux.=$tab['p']." TABLILLAS PORTASYSTEM (100ps) ";
		$t_puertos=$n['puertos']+$t['puertos'];
		$a="<br>&nbsp;";
		$a2="<br>".$a;
		$a3="<br>".$a2;
		//$this->resetColumns();
		$cadena=$this->estilo.
			'<table border="1">
			<tr><th colspan="1"><b>RESUMEN</b></th></tr>
			<tr><td height="870"><br><b>'.$a.$this->ds['edificio'].'</b>'.
			$a2.'INSTALACIÓN EQUIPO DE '.$this->ds['rubro_f'].', TECNOLOGÍA '.$this->ds['tecnologia'].' ('.$n['tipo_equipo'].')'.
			$a.'PROGRAMA: '.strtoupper($this->ds['plan']).
			$a3.'<b>SÍRVASE EFECTUAR LOS SIGUIENTES TRABAJOS:</b>';
		if($this->ds['rubro_f']=='ACCESO'){
			$cadena.=$a3.'I.- AMPLIACION DE '.$t_puertos.' PUERTOS DSL/POTS, DE ACUERDO A LO SIGUIENTE:'.
			$a2.'1) SUMINISTRO E INSTALACION DE '.$t['tarjetas'].' TARJETAS '.$t['cod_tarjeta'].', CORRESPONDIENTE A '.$t['puertos'].' PUERTOS DSL/POTS, POR AMPLIACIÓN DE NODO(S) EXISTENTES:'.
			$a.$t['nombres_equipos'].
			$a2.'2) INSTALACIÓN Y CONEXIÓN DE '.$n['puertos'].' PUERTOS DSL/POTS PARA NODO(S) NUEVO(S) A INSTALARSE EN INTERIOR DE SALA INDICADA SEGÚN TABLA DE UBICACIÓN DE EQUIPOS, CONSIDERANDO:'.
			$a.'-BASTIDOR(ES): '.$b['bastidores'].
			$a.'-REPISA(S): '.$n['c_nuevos'].
			$a.'-TARJETA(S): '.$n['tarjetas'].' '.$n['cod_tarjeta'].
			$a.'-NODO(CLLI): '.$n['nombres_equipos'].
			$a2.'3) REMATAR REPISA(S) EN D.G.VIA '.$tab_aux.' CON POSICIONES:'.
			$a.'POTS: '.$pots['dg'].
			$a.'DSL: '.$dsl['dg'].
			$a.'VER TABLA DE REMATES EN DG';
		}
		elseif($this->ds['rubro_f']=='TRANSPORTE'){
			$cadena.=$a3.'I.- AMPLIACION DE NODO DE '.$this->ds['rubro_f'].' '.$n['tipo_equipo'].', DE ACUERDO A LO SIGUIENTE:'.
			$a2.'1) SUMINISTRO E INSTALACION DE '.$t['tarjetas'].' TARJETAS '.$t['cod_tarjeta'].', CORRESPONDIENTE A '.$t['puertos'].' PUERTOS DSL/POTS, POR AMPLIACIÓN DE NODO(S) EXISTENTES:'.
			$a.$t['nombres_equipos'].
			$a2.'2) INSTALACIÓN Y CONEXIÓN DE '.$n['puertos'].' PUERTOS DSL/POTS PARA NODO(S) NUEVO(S) A INSTALARSE EN INTERIOR DE SALA INDICADA SEGÚN TABLA DE UBICACIÓN DE EQUIPOS, CONSIDERANDO:'.
			$a.'-BASTIDOR(ES): '.$b['bastidores'].
			$a.'-REPISA(S): '.$n['c_nuevos'].
			$a.'-TARJETA(S): '.$n['tarjetas'].' '.$n['cod_tarjeta'].
			$a.'-NODO(CLLI): '.$n['nombres_equipos'].
			$a2.'3) REMATAR REPISA(S) EN D.G.VIA '.$tab_aux.' CON POSICIONES:'.
			$a.'POTS: '.$pots['dg'].
			$a.'DSL: '.$dsl['dg'].
			$a.'VER TABLA DE REMATES EN DG';
		}
		$cadena.=$a2.'4) REMATE DE FIBRA ÓPTICA:'.
			$a.'BASTIDOR(ES): '.$dfo['b'].
			$a.'DFO(S):'.$dfo['a'].
			$a.'VER TABLA DE REMATES ÓPTICOS ALTO ORDEN'.
			$a2.'5) ALIMENTACION '.strtoupper($this->ds['fz_tp_alimen']).': '.
			$a.'BASTIDOR(ES) EN '.$fz['b'].
			$a.'POSICION(ES): '.$fz['a'].
			$a.'VER TABLA DE ALIMENTACIÓN'.
			$a2.'6) CONEXIONES A TIERRA:'.
			$a.'ATERRIZAR REPISA DE ACUERDO NORMA VIGENTE TELMEX.'.
			$a2.'7) ETIQUETADO DE TODO EL CABLEADO A INSTALAR DE ACUERDO A LAS NORMAS OFICIALES VIGENTES DE TELMEX.'.
			$a3.'II.- FAVOR DE DEJAR EL AREA DE TRABAJO LIBRE DE RESIDUOS Y BASURA AL TERMINO DE LAS ACTIVIDADES.'.
			$a2.'NOTA: EN CASO DE MODIFICACIÓN Y/O CAMBIO EN LAS CONDICIONES DESCRITAS PARA ESTOS TRABAJOS, FAVOR DE COMUNICARSE A INGENIERÍA'.
			'</td></tr></table>';
			
/*$cadena="OTN BAJIO 135F640WH001 U4T

1.- DESCRIPCIÒN DEL TRABAJO A REALIZAR:

1.1.- INSTALACION  Y  CONEXIÓN  DEL EQUIPO  MARCA  HUAWEI,
MODELO: OPTIX  OSN  8800  V100R006  COMO  EXPANSION
AL ANILLO BAJIO OTN 135F640WH001 DE ACUERDO AL PMI 2014.		
CLLI: CELYGJCEO0R.
NOTA: EL SUMINISTRO DEL EQUIPO ESTA AMPARADO CON EL GRAFO: 330000105982.
				

2.- DATOS DE LA UBICACIÒN  DEL EQUIPO:
					
2.1.-INSTALAR  EL  EQUIPO  MARCA: HUAWEI, MODELO: OPTIX  OSN  8800,
EN LA FILA: 204, LADO: B, POSICION: 21, COMO  SE  INDICA EN  EL  PLANO
DE SALA ( CELYGJCE.01.X ), EN EL 1er. PISO DE LA SALA PTTI
DE LA CENTRAL CELAYA \"CELAYA\",GTO., CON  REPISAS  Y  TARJETAS  COMO
SE INDICA EN EL FRENTE  DE  BASTIDOR DEL PROVEEDOR ( ANEXO: 1 ).		
	
2.2.-SUMINISTRO E INSTALACION DE UNA BAJADA EXPRESS 4X4 CON TAPA DE
2 ORIFICIOS, CON MANGUERA CORRUGADA Y CANALETA  CUADRADA DE  2X2
MARCA: ADC.

2.3.-REALIZAR LA  INTERCONEXION ENTRE BASTIDORES CON JUMPER OPTICO ( 10 MTS ).

3.- REMATE DE ALIMENTACIÒN: 					

3.1.-EL  EQUIPO  OSN  8800  DE  HUAWEI  REQUIERE DE  4  LINEAS  DE
ALIMENTACION  DE -48 V, 2 DE TRABAJO Y 2 DE RESPALDO, QUE  SE  TOMARAN
DE LA SIGUIENTE MANERA:
CONECTE LA ALIMENTACIÓN DE TRABAJO EN DOS FUSIBLES DE 60 AMP. INSTALADOS
EN  LA  POSICIÓN:2 y 3, DE LA DISTRIBUCION DE C.D DE LA PLANTA MEI (ANEXO:2),
INSTALADO  EN  SALA  DE  FUERZA P.B  Y  LA ALIMENTACIÓN DE RESPALDO SE
CONECTARÁ EN DOS FUSIBLES DE 60 AMP.INSTALADOS  EN  LA  POSICION: 25 y 26, DE
LA  DISTRIBUCION  DE  C.D. DE  LA  PLANTA  MEI ( ANEXO:3 ), INSTALADO EN SALA
DE FUERZA DEL 2o. PISO.
UTILIZAR  CABLES  CALIBRE  2 AWG ( TRABAJO )  COLOR  ROJO  PARA (+)  Y
NEGRO  PARA (-), CON 22 MTS. DE LONGITUD, ASI COMO ZAPATAS EN TAB. DE DISTRIB.
DE C.D., UBICADO EN P.B. Y CABLES CALIBRE 2 AWG ( RESPALDO ) COLOR ROJO (+)  Y
NEGRO PARA (-), CON  30 MTS. DE  LONGITUD.
UTILIZANDO  TRAYECTORIAS DE ALIMENTACION EXISTENTES.
NOTA: OPERACION  Y  MANTENIMIENTO SUMINISTRARA E INSTALARA
DICHOS  FUSIBLES  DE  60  AMP.
									
3.2.-ATERRIZAR  EL  EQUIPO  A  LA  BARRA DE TIERRA DE LA FILA CON CABLE
CALIBRE 6 AWG COLOR VERDE,UTILIZANDO ZAPATA PONCHABLE DOBLE OJILLO CAÑON
LARGO Y FUNDA TRANSPARENTE TERMOCONTRACTIL.			
								
4.- REMATE DE CABLEADOS:
					
4.1.-REMATE  JUMPER  OPTICO  MONOMODO PARA TARJETA SLH-41, 8 STM-1 y 8 STM-4,
SLOT 1, CON CONECTORES LC DEL LADO DEL EQUIPO HUAWEI, CON REVESTIMIENTO
COLOR AMARILLO Y UNA LONGITUD DE 16 MTS DESDE EL EQUIPO OPTIX OSN 8800,
HASTA EL BDFO DE ALTA DENSIDAD-2,MODULO:0206,POSICIONES DE 21 A LA 36 (STM-1),
Y POSICIONES DE 37 A LA 52 ( STM-4 ) VER  ANEXO:4 ( REMATES DE F.O. ) CON
CONECTORES SC DEL LADO DEL BDFO-AD-2, UBICADO  EN  LA  FILA: 202, LADO:A,
POSICION: 21, VER PLANO DE SALA ( CELYGTCE.01.X ).	

4.2.-INTERCONEXION  DE BASTIDORES  CON  CABLE  UTP  Y  CONECTORES RJ-45
PARA  GESTION.

5.- SISTEMA RADIANTE:

NO APLICA.					
					
6.- SUJETESE A LAS SIGUIENTES NORMAS Y PROCEDIMIENTOS:
				
             METODO NORMATIVO DE CONSTRUCCION DEL EQUIPO OPTIX OSN 8800
             REF. HWMEX201100808.
TMX/N/XI/95  NORMA Y ESPECIFICACIÓN PARA EL SISTEMA DE TIERRAS PARA LA PLANTA
             DE TELEFONOS DE MÉXICO S.A.B. DE C.V.
N/05/003     NORMA PARA IDENTIFICAR LA UBICACIÓN FÍSICA DEL EQUIPO DE
             TRANSMISIÓN INSTALADO EN LA PLANTA TELEFÓNICA.
N/05/002     NORMA PARA LA CODIFICACIÓN Y ETIQUETADO EN CABLES COAXIALES,
             DE F.O., CABLES DE ALIMENTACIÓN, CABLES SINCRONÍA Y UTP.
N/05/017     NORMA PARA LA DISTRIBUCIÓN Y EXPLOTACIÓN DE BASTIDORES
             DE FIBRA ÓPTICA DE ALTA DENSIDAD.
N/05/097     NORMA DE CONSTRUCCIÓN Y USO DE JUMPER ÓPTICO.
N/05/105     NORMA PARA EL MANEJO DE CABLES DE FIBRA OPTICA Y JUMPERS OPTICOS.
G/02/001     GUIA TECNICA PARA LA INSTALACION DE EQUIPOS EN SALAS DE CLIENTES
             Y  EN  SALAS  DE  EDIFICIOS  TELMEX.
B/02/021     BOLETIN PARA ASIGNAR CODIGO DE COLORES PARA CABLEADOS DE
             CORRIENTE DIRECTA, CORRIENTE ALTERNA Y CLIMA.
					
7.- LISTA DE ANEXOS:					

CELYGJCE.01.X    PLANO DE SALA.
ANEXO:1          FTE. DEL BASTIDOR DEL EQUIPO HUAWEI OSN 8800.
ANEXO:2          FTE. TAB. DE DISTRICUCION C.D. MEI P.B.
ANEXO:3          FTE. TAB. DE DISTRICUCION C.D. MEI 2o. PISO.
ANEXO:4          REMATES DE F.O..
";*/
		
		
		
		$this->SetAutoPageBreak(false, 0);
		$this->EscribeHTML($cadena);
	}
	
	private function PagRadios(){
		$this->addPage();
		$cadena=$this->estilo.
			'<table border="1">
			<tr><th colspan="2"><b>RADIOS</b></th></tr>
			</table>';
		$this->EscribeHTML($cadena);
	}
	
	private function DatosGenerales(){
        $query = "SELECT a.*,if(a.rubro=0,'ACCESO','TRANSPORTE') as rubro_f,DATE(a.fecha_solicitud) AS fecha_solicitud_f,DATE(a.fecha_programada) AS fecha_programada_f,DATE(a.fecha_captura) AS fecha_captura_f,DATE(a.fecha_ejecucion) AS fecha_ejecucion_f,DATE(a.fecha_validacion) AS fecha_validacion_f,b.dir_div,b.area,b.sigcent,b.edificio,c.tecnologia FROM zsite_survey a , centrales b, ztecnologias c WHERE a.folio='{$this->folio}' AND a.id_central=b.id_ctl and a.tecno=c.id;";
        $result = mysql_query($query);
		$arr = mysql_fetch_array($result,MYSQL_ASSOC);
		$n=count($arr);
		if($n>0)
		foreach($arr as $id=>$val){
			$arr[$id] = $this->Normaliza($val);
			$this->ds[$id]=!empty($arr[$id])?$arr[$id]:'N/A';
		}
		//echo "<pre>".print_r($this->ds,true)."</pre>";
    }
	
	private function Normaliza($cadena){
        $originales =  'ÀÿÂÃÄÅÆÇÈÉÊËÌÿÎÿÿÑÒÓÔÕÖØÙÚÛÜÿÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        //$cadena = utf8_decode($cadena);
        //$cadena = strtr($cadena, utf8_decode($originales), $modificadas);
        //$cadena = strtolower($cadena);
        //$cadena = ereg_replace("[^A-Za-z0-9]", " ", $cadena);
        $cadena = str_replace(array('"','\''),array('',''),$cadena);
        return utf8_encode($cadena);
    }
	
	private function ArmarTabla01($opciones,$select,$titulo,$comentarios){
		$comentarios = $comentarios == 'N/A' ? '' : $comentarios;
        $sz = count($opciones);
        $cadena = '<tr><th colspan="2" width="35%"><b>'.$titulo.'</b></th><th width="%65"><b>COMENTARIOS</b></th></tr>';
        $r = 0;$c=0;
        foreach($opciones as $val){
            if($val != $select){
                $r++;
            }
        }
        if($r == $sz && $select != 'N/A'){
            $r++;
        }
        else{
            $r = $sz;
        }
        for($i = 0; $i < $sz; $i++){
            $row = $i == 0 ? '<td rowspan="'.$r.'  width="65%""> '.$comentarios.'</td>' : '';
            if($opciones[$i] == $select){
                $x = 'X';
                $c++;
            }
            else{
                $x = '';
            }
            $cadena .= '<tr><td width="30%">'.strtoupper($opciones[$i]).'</td><td class="t" width="5%"><b>'.$x.'</b></td>'.$row.'</tr>';
            $c++;
        }
        $cadena .= $c == $sz && $select != 'N/A' ? '<tr><td>OTRO: <b>'.strtoupper($select).'</b></td><td class="t"><b>X</b></td></tr>' : '';
        return $cadena;
    }

	private function ArmarTabla02($opciones,$select,$titulo){
		$sz = count($opciones);
        $c=0;
        $cadena = '<tr><th colspan="2">'.$titulo.'</th></tr>';
        foreach($opciones as $val){
            if($val == $select){
                $x = 'X';
            }
            else{
                $x = '';
                $c++;
            }
            $cadena .= '<tr><td>'.strtoupper($val).'</td><td class="t"><b>'.$x.'</b></td></tr>';
            if($c == $sz && $select != 'N/A'){
                $cadena .= '<tr><td><b>OTRO: '.strtoupper($val).'</b></td><td class="t"><b>'.$x.'</b></td></tr>';
            }
        }
        return $cadena;
	}
	
	private function ArmarTabla04($tag,$comentarios){
		$result=mysql_query("select * from zcanaletas where folio='".$this->folio."' and tag='".$tag."'");
		$cadena = '<tr><td class="t">Tipo</td><td class="t">Existente o<br>Nueva</td><td class="t">Altura<br>al bastidor<br>(mts)</td><td class="t">Longitud<br>Trayectoria<br>(mts)</td><td class="t">Ancho<br>(pulgadas)</td><td class="t">Bajantes<br>Requeridas</td></tr>';
		while($arr=mysql_fetch_array($result,MYSQL_ASSOC)){
			$cadena.='<tr><td>  [ '.$this->cn_aplica($arr['aplica']).' ] '.$this->cn_tipo($arr['material']).'</td><td> '.$this->cn_existe($arr['nuevo_existente']).'</td><td align="center">'.$this->normaliza($arr['altura']).'</td><td align="center">'.$this->normaliza($arr['largo']).'</td><td align="center">'.$this->normaliza($arr['pulgadas']).'</td><td align="center">'.$this->normaliza($arr['bajante']).'</td></tr>';
		}
		$comentarios = $comentarios == 'N/A' ? '' : $comentarios;
		
		$cadena.='<tr><th colspan="6">COMENTARIOS</th></tr>';
		$cadena.='<tr><td colspan="6" height="100"> '.$comentarios.'</td></tr>';
		return $cadena;
	}
	
	private function ArmarTabla05($comentarios){
        $comentarios = $comentarios == 'N/A' ? '' : $comentarios;
        return $cadena = '<table border="1"><tr><th><b>COMENTARIOS</b></th></tr><tr><td height="100">'.$comentarios.'</td></tr></table>';
    }
	
	private function ccemail(){
        $cadena = '';
        $query = "SELECT nombre,email FROM zccemails WHERE folio='".$this->folio."'";
        $result = mysql_query($query);
        $sz = mysql_num_rows($result);
        if($sz > 0){
            $cadena = '<table border="1"><tr><td class="t"><b>DISTRIBUCI&Oacute;N DE COPIAS</b></td></tr><tr><td> ';
            for($i = 0; $i < $sz; $i++){
                $d = mysql_fetch_array($result);
                $coma = ($i < $sz - 1) ? ', ' : '';
				$d['nombre'] = $this->normaliza($d['nombre']);
                $cadena .= $d['nombre'].' '.$d['email'].$coma;
            }
            $cadena .= '</td></tr></table>';
        }
        return $cadena;
    }
	
	private function ubxeq(){
        $cadena = '';
        $query = "SELECT ztecnologias.tipo_equipo, zss_equipos.ubicacion,zss_equipos.nuevoExistente,zss_equipos.nombre_equipo,zss_equipos.puertos,zss_equipos.tarjetas,zss_equipos.espacio FROM ztecnologias,zss_equipos WHERE zss_equipos.folio='".$this->folio."' AND zss_equipos.id_tecnologia = ztecnologias.id";
        $result = mysql_query($query);
        $sz = mysql_num_rows($result);
        if($sz > 0){
            $cadena = '<table border="1"><tr><th colspan="7"><b>UBICACI&Oacute;N DE EQUIPOS</b></th></tr>
			<tr><td class="t" width="15%"><b>Modelo</b></td>
			<td class="t" width="20%"><b>No. Repisa</b></td>
			<td class="t" width="15%"><b>Ubicaci&oacute;n</b></td>
			<td class="t" width="15%"><b>Bastidor<BR>Nuevo/Existente</b></td>
			<td class="t" width="8%"><b>Puertos</b></td>
			<td class="t" width="8%"><b>Tarjetas</b></td>
			<td class="t" width="19%"><b>Espacio</b></td></tr>';
            for($i = 0; $i < $sz; $i++){
			$a = $i;
			$a++;
                $d = mysql_fetch_row($result);
                $cadena .= '<tr><td align="center"> '.$d[0].'</td><td align="center"> '.$d[3].'</td><td align="center"> '.$d[1].'</td><td align="center"> '.$d[2].'</td><td align="center"> '.$d[4].'</td><td align="center"> '.$d[5].'</td><td> '.$d[6].'</td></tr>';
            }
            $cadena .= '</table>';
        }
        return $cadena;
    }

	private function abfo($ab){
        $cadena='';
        $arr = array();
		
		$total = mysql_query("SELECT count(ztecnologias.tipo_equipo) as total FROM ztecnologias,zss_equipos WHERE zss_equipos.folio='".$this->folio."' AND zss_equipos.id_tecnologia = ztecnologias.id");
        $total = mysql_fetch_array($total,MYSQL_BOTH);
        $total = $total[0];
		
        $query = "SELECT ztecnologias.id,ztecnologias.tipo_equipo FROM ztecnologias,zinter_abfo WHERE zinter_abfo.folio='".$this->folio."'  AND zinter_abfo.alto_bajo=".$ab." AND ztecnologias.id=zinter_abfo.id_modelo";
        $result = mysql_query($query);
        $sz = mysql_num_rows($result);
        if($sz > 0){
            for($i = 0; $i < $sz; $i++){
                $d = mysql_fetch_array($result);
                $arr[$i][0] = $d['tipo_equipo'];
            }
        }
		else{
			$subquery = "SELECT ztecnologias.tipo_equipo as equipo FROM ztecnologias,zss_equipos WHERE zss_equipos.folio='".$this->folio."' AND zss_equipos.id_tecnologia = ztecnologias.id";
			$subresult = mysql_query($subquery);
			$subsz = mysql_num_rows($subresult);
			if($subsz > 0){
				for($i = 0; $i < $subsz; $i++){
					$subd = mysql_fetch_array($subresult);
					$arr[$i][0] = $subd['equipo'];
				}
			}
		}
        $query2 = "SELECT * FROM zinter_abfo WHERE folio = '".$this->folio."' AND alto_bajo=".$ab;
        $result2 = mysql_query($query2);
        $sz2 = mysql_num_rows($result2);
        if($sz2 > 0){
            for($i = 0; $i < $sz2; $i++){
                $d2 = mysql_fetch_array($result2);
                $arr[$i][1] = $d2['ubicacion'];
                $arr[$i][2] = $d2['dfo'];
                $arr[$i][3] = $d2['tipo_conector_equipo'];
                $arr[$i][4] = $d2['posicion_remate'];
                $arr[$i][5] = $d2['tipo_fibra'];
                $arr[$i][6] = $d2['tipo_conector_bdfo'];
                $arr[$i][7] = $d2['Tx_Rx'];
                $arr[$i][8] = $d2['long_jumper_1'];
                $arr[$i][9] = $d2['long_jumper_2'];
            }
        }
        for($i = 0; $i < $total; $i++){
            $cadena .='<tr>';
            for($j = 0; $j < 10; $j++){
                $cadena .= '<td class="c">'.$arr[$i][$j].'</td>';
            }
            $cadena .='</tr>';
        }
        return $cadena;
    }

	private	function cn_aplica($x){
		switch($x){
			case 0: $x=""; break;
			case 1: $x="X"; break;
			default: $x=""; break;
		}
		return $x;
	}
	
	private function cn_tipo($t){
		switch($t){
			case 0: $t="ALUMINIO"; break;
			case 1: $t="ACERO"; break;
			case 2: $t="CHAROLA"; break;
			case 3: $t="PLÁSTICA"; break;
			default: $t=""; break;
		}
		return $t;
	}
	
	private function cn_existe($e){
		switch($e){
			case 0: $e=""; break;
			case 1: $e="EXISTENTE"; break;
			case 2: $e="NUEVA"; break;
			default: $e=""; break;
		}
		return $e;
	}

	private function Multipar(){
        $tabla = '<tr><td  class="gc" colspan="9">DISTRIBUIDOR GENERAL</td></tr><tr><th colspan="9">TABLA DE REMATES</th></tr><tr><td class="t" colspan="3"></td><td class="t" colspan="3">POTS</td><td class="t" colspan="3">DSL</td></tr><tr><td class="c">Equipo</td><td class="c">Tipo tablilla</td><td class="c">Longitud de Cable</td><td class="c">Nivel</td><td class="c">Vertical</td><td class="c">Puerto</td><td class="c">Nivel</td><td class="c">Vertical</td><td class="c">Puerto</td></tr>';
        $query = "SELECT id,nombre_equipo FROM zss_equipos where folio = '".$this->folio."' AND id_tecnologia != 0";
        $result = mysql_query($query);
        $sz = mysql_num_rows($result);
        if($sz > 0){
            for($i = 0; $i < $sz; $i++){
                $z = 1;
                $d = mysql_fetch_array($result);
                $query2 = "SELECT * FROM zinter_mp WHERE id_equipo=".$d['id']." AND folio='".$this->folio."' order by id";
                $result2 = mysql_query($query2);
                $sz2 = mysql_num_rows($result2);
                if($sz2 > 0){
                    $sel = ($sz2/2) == 8 ? 'Portasystem' : 'Versablock';
                    $tabla .= '<tr><td rowspan="'.($sz2/2).'">'.$d['nombre_equipo'].'</td><td rowspan="'.($sz2/2).'">'.$sel.'</td><td rowspan="'.($sz2/2).'">'.$d['long_cable'].'</td>';
                    for($j = 0; $j < $sz2; $j++){
                        $d2 = mysql_fetch_array($result2);
                        if($j%2 == 0 && $j == 0){
                            $tabla .= '<td class="c">'.$d2['nivel'].'</td>'
                                . '<td class="c">'.$d2['vertical'].'</td>'
                                . '<td  class="c">'.$d2['puertos'].'</td>';
                        }
                        else if($j%2 != 0 && $j == 0){
                            $tabla .= '<td class="c">'.$d2['nivel'].'</td>'
                                . '<td class="c">'.$d2['vertical'].'</td>'
                                . '<td class="c">'.$d2['puertos'].'</td></tr>';
                        }
                        else if($j%2 == 0 && $j != 0){
                            $tabla .= '<tr>'
                                . '<td class="c">'.$d2['nivel'].'</td>'
                                . '<td class="c">'.$d2['vertical'].'</td>'
                                . '<td class="c">'.$d2['puertos'].'</td>';
                        }
                        else if($j%2 != 0 && $j != 0){
                            $tabla .= '<td class="c">'.$d2['nivel'].'</td>'
                                . '<td class="c">'.$d2['vertical'].'</td>'
                                . '<td class="c">'.$d2['puertos'].'</td></tr>';
                        }
                    }
                }
                else{
                    $tabla .= '<tr><td class="c">'.$d['nombre_equipo'].'</td><td class="c"></td><td class="c"></td><td class="c"></td><td class="c"></td><td class="c"></td><td class="c"></td><td class="c"></td></tr>';
                }
            }
        }        
        return $tabla;
    }
	
	private function Coaxial(){
		$cadena='';
        $arr = array();
		
		$total = mysql_query("SELECT count(ztecnologias.tipo_equipo) as total FROM ztecnologias,zss_equipos WHERE zss_equipos.folio='".$this->folio."' AND zss_equipos.id_tecnologia = ztecnologias.id");
		$total = mysql_fetch_array($total,MYSQL_BOTH);
		$total = $total[0];
		
        $query = "SELECT ztecnologias.id, ztecnologias.tipo_equipo FROM ztecnologias, zinter_cx WHERE zinter_cx.folio = '".$this->folio."' AND ztecnologias.id = zinter_cx.id_modelo";
        $result = mysql_query($query);
        $sz = mysql_num_rows($result);
        if($sz > 0){
            for($i = 0; $i < $sz; $i++){
                $d = mysql_fetch_array($result);
                $arr[$i][0] = $d['tipo_equipo'];
            }
        }
		else{
			$subquery = "SELECT ztecnologias.tipo_equipo as equipo FROM ztecnologias,zss_equipos WHERE zss_equipos.folio='".$this->folio."' AND zss_equipos.id_tecnologia = ztecnologias.id";
			$subresult = mysql_query($subquery);
			$subsz = mysql_num_rows($subresult);
			if($subsz > 0){
				for($i = 0; $i < $subsz; $i++){
					$subd = mysql_fetch_array($subresult);
					$arr[$i][0] = $subd['equipo'];
				}
			}
		}
        $query2 = "SELECT * FROM zinter_cx WHERE folio = '".$this->folio."'";
        $result2 = mysql_query($query2);
        $sz2 = mysql_num_rows($result2);
        if($sz2 > 0){
            for($i = 0; $i < $sz2; $i++){
                $d2 = mysql_fetch_array($result2);
                $arr[$i][1] = $d2['ubicacion'];
                $arr[$i][2] = $d2['pos_tablilla'];
                $arr[$i][3] = $d2['lado'];
                $arr[$i][4] = $d2['pos_contacto'];
                $arr[$i][5] = $d2['tipo_conector'];
                $arr[$i][6] = $d2['tipo_coaxial'];
                $arr[$i][7] = $d2['tx_rx'];
                $arr[$i][8] = $d2['long_cable'];
            }
        }
        
        for($i = 0; $i < $total; $i++){
            $cadena .='<tr>';
            for($j = 0; $j < 9; $j++){
                $cadena .= '<td class="c">'.$arr[$i][$j].'</td>';
            }
            $cadena .='</tr>';
        }
        return $cadena;
	}
	
	private function GestionSincronia($gs){
        $arr = array();
		
		$total = mysql_query("SELECT count(ztecnologias.tipo_equipo) as total FROM ztecnologias,zss_equipos WHERE zss_equipos.folio='".$this->folio."' AND zss_equipos.id_tecnologia = ztecnologias.id");
		$total = mysql_fetch_array($total,MYSQL_BOTH);
		$total = $total[0];
		
        $query = "SELECT ztecnologias.id, ztecnologias.tipo_equipo FROM ztecnologias, zinter_gs WHERE zinter_gs.folio = '".$this->folio."'  AND zinter_gs.gestionSincronia = ".$gs." AND ztecnologias.id = zinter_gs.id_modelo";
        $result = mysql_query($query);
        $sz = mysql_num_rows($result);
        if($sz > 0){
            for($i = 0; $i < $sz; $i++){
                $d = mysql_fetch_array($result);
                $arr[$i][0] = $d['tipo_equipo'];
            }
        }
		else{
			$subquery = "SELECT ztecnologias.tipo_equipo as equipo FROM ztecnologias,zss_equipos WHERE zss_equipos.folio='".$this->folio."' AND zss_equipos.id_tecnologia = ztecnologias.id";
			$subresult = mysql_query($subquery);
			$subsz = mysql_num_rows($subresult);
			if($subsz > 0){
				for($i = 0; $i < $subsz; $i++){
					$subd = mysql_fetch_array($subresult);
					$arr[$i][0] = $subd['equipo'];
				}
			}
		}
		$query2 = "SELECT * FROM zinter_gs WHERE folio = '".$this->folio."' AND gestionSincronia = ".$gs."";
        $result2 = mysql_query($query2);
        $sz2 = mysql_num_rows($result2);
        if($sz2 > 0){
            for($i = 0; $i < $sz2; $i++){
                $d2 = mysql_fetch_array($result2);
                $arr[$i][1] = $d2['ubicacion_RCDT'];
                $arr[$i][2] = $d2['numero_switch'];
                $arr[$i][3] = $d2['puerto'];
                $arr[$i][4] = $d2['cat_cable'];
                $arr[$i][5] = $d2['long_cable'];
                $arr[$i][6] = $d2['tipo_conector'];
            }
        }
        
        for($i = 0; $i < $total; $i++){
            $cadena .='<tr>';
            for($j = 0; $j < 7; $j++){
                $cadena .= '<td class="c">'.$arr[$i][$j].'</td>';
            }
            $cadena .='</tr>';
        }
        return $cadena;
    }
    
    private function Fuerza(){
        $cadena = '';
        $arr = array();
        $arr2 = array();
		
		$total = mysql_query("SELECT count(ztecnologias.tipo_equipo) as total FROM ztecnologias,zss_equipos WHERE zss_equipos.folio='".$this->folio."' AND zss_equipos.id_tecnologia = ztecnologias.id");
		$total = mysql_fetch_array($total,MYSQL_BOTH);
		$total = $total[0];
		
        $query = "SELECT ztecnologias.id, ztecnologias.tipo_equipo FROM ztecnologias, zss_equipos WHERE zss_equipos.folio = '".$this->folio."' AND zss_equipos.id_tecnologia = ztecnologias.id";
        $result = mysql_query($query);
        $sz = mysql_num_rows($result);
        if($sz > 0){
            for($i = 0; $i < $sz; $i++){
                $d = mysql_fetch_array($result);
                $arr[$i] = $d['tipo_equipo'];
            }
        }
		else{
			$subquery = "SELECT ztecnologias.tipo_equipo as equipo FROM ztecnologias,zss_equipos WHERE zss_equipos.folio='".$this->folio."' AND zss_equipos.id_tecnologia = ztecnologias.id";
			$subresult = mysql_query($subquery);
			$subsz = mysql_num_rows($subresult);
			if($subsz > 0){
				for($i = 0; $i < $total; $i++){
					$subd = mysql_fetch_array($subresult);
					$arr[$i] = $subd['equipo'];
				}
			}
		}
		
        $query2 = "SELECT id,folio,trabajo_respaldo,id_modelo,ub_alimen,pf_breaker,cap_fusible,calibre,l_cable,c_cable,t_zapata FROM zinter_fz WHERE folio = '".$this->folio."' ORDER BY id_modelo";
        $result2 = mysql_query($query2);
        $sz2 = mysql_num_rows($result2);
        if($sz2 > 0){
            for($i = 0; $i < $sz2; $i++){
                $d2 = mysql_fetch_array($result2);
                $arr2[$i][0] = $d2['ub_alimen'];
                $arr2[$i][1] = $d2['pf_breaker'];
                $arr2[$i][2] = $d2['cap_fusible'];
                $arr2[$i][3] = $d2['calibre'];
                $arr2[$i][4] = $d2['l_cable'];
                $arr2[$i][5] = $d2['c_cable'];
                $arr2[$i][6] = $d2['t_zapata'];
            }
        }
        for($i = 0; $i < count($arr); $i++){
                $cadena .= '<tr><td rowspan="2" class="c">'.$arr[$i].'</td>';
                $cadena .='<td class="c">Trabajo</td>';
                $cadena .='<td class="c">'.$arr2[$i][0].'</td>';
                $cadena .='<td class="c">'.$arr2[$i][1].'</td>';
                $cadena .='<td class="c">'.$arr2[$i][2].'</td>';
                $cadena .='<td class="c">'.$arr2[$i][3].'</td>';
                $cadena .='<td class="c">'.$arr2[$i][4].'</td>';
                $cadena .='<td class="c">'.$arr2[$i][5].'</td>';
                $cadena .='<td class="c">'.$arr2[$i][6].'</td>';
                $cadena .= '</tr>';
                $a = $total + $i;
                //$a++;
                $cadena .='<tr><td class="c">Respaldo</td>';
                $cadena .='<td class="c">'.$arr2[$a][0].'</td>';
                $cadena .='<td class="c">'.$arr2[$a][1].'</td>';
                $cadena .='<td class="c">'.$arr2[$a][2].'</td>';
                $cadena .='<td class="c">'.$arr2[$a][3].'</td>';
                $cadena .='<td class="c">'.$arr2[$a][4].'</td>';
                $cadena .='<td class="c">'.$arr2[$a][5].'</td>';
                $cadena .='<td class="c">'.$arr2[$a][6].'</td></tr>';
            
        }
        return $cadena;
    }
	
	private function EscribeHTML($cadena){
		$this->writeHTML($cadena, true, false, false, false, '');
	}
	
	private function FondoPreliminar(){
		if($this->ds['estatus']!='VALIDADO'){
			// $bMargen=$this->getBreakMargin();
			// $auto_page_break=$this->getAutoPageBreak();
			// $this->SetAutoPageBreak(false,0);
			// $img_file='../img/preliminar.jpg';
			// $this->Image($img_file,100,50,150,200,'','','',false,300,false,false,0);
			// $this->SetAutoPageBreak($auto_page_break,$bMargen);
			// $this->setPageMark();
		}
	}
}

$folio= isset($_REQUEST['folio'])?$_REQUEST['folio']:null;
//$folio= 'SS2520140828001'; //SESECAPAN

if ($folio==null) echo "Error, folio nulo";
else{
    $query = "select * from zsite_survey where folio='$folio'";
    $r=mysql_query($query);
    if(mysql_num_rows($r)==0){
         echo "Error, folio no existe";
    }
    else{
        // $pdf=new PDF_SiteSurvey($folio);
        // $pdf->Output('ReporteSiteSurvey_'.$folio.'.pdf','I');
		
        $pdf=new PDF_SiteSurvey($folio);
        $output_PDF_tem='G:\\Archivos\\SiteSurvey\\ReporteSiteSurvey_'.$folio.'_tem.pdf';
        //$output_PDF='ReporteSiteSurvey_'.$folio.'.pdf';
        $pdf->Output($output_PDF_tem,'F');
        echo 'listo';
        //header("Location:unir_pdf.php?folio=$folio&file_tem=$output_PDF_tem&file_final=$output_PDF");
        //include("Location:http://10.94.143.193:8082/pdfmerge/servletPDF?file=".$folio);
		
		/*Output Parameters
		$name	(string) The name of the file when saved. Note that special characters are removed and blanks characters are replaced with the underscore character.
		$dest	(string) Destination where to send the document. It can take one of the following values:

        I: send the file inline to the browser (default). The plug-in is used if available. The name given by name is used when one selects the "Save as" option on the link generating the PDF.
        D: send to the browser and force a file download with the name given by name.
        F: save to a local server file with the name given by name.
        S: return the document as a string (name is ignored).
        FI: equivalent to F + I option
        FD: equivalent to F + D option
        E: return the document as base64 mime multi-part email attachment (RFC 2045)
		*/
	}
}

/*
header("Content-Type: text/html;charset=utf-8");
include 'Report.php';
include 'tcpdf/tcpdf.php';
$instrucciones = $datos[15] != 'POR REALIZAR' ? '' : '<p><b>INSTRUCCIONES: </b>Marque con una <b><font color="red">X</font></b> la opci&oacute;n mas adecuada.</p>';

*/