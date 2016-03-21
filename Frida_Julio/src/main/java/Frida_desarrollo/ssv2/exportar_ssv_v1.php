<?php
// unlink("prueba_vicky.xlsx");
error_reporting(E_ALL);
ini_set('display_errors',TRUE);
ini_set('display_startup_errors',TRUE);
date_default_timezone_set('Europe/London');
require_once '/lib/PHPEXCEL/Classes/PHPExcel.php';
require_once dirname(__FILE__).'/lib/PHPEXCEL/Classes/PHPExcel/IOFactory.php';

function cellColor($cells,$color){
	global $objPHPExcel;
	$objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array('type'=>PHPExcel_Style_Fill::FILL_SOLID,'startcolor'=>array('rgb'=>$color)));
}
function validation($cells,$title,$elementos,$tipo){
	global $objPHPExcel;
	$objValidation = $objPHPExcel->getActiveSheet()->getCell($cells)->getDataValidation(); 
	$objValidation->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
	$objValidation->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_STOP);
	$objValidation->setAllowBlank(false);
	$objValidation->setShowInputMessage(true);
	$objValidation->setShowErrorMessage(true);
	$objValidation->setShowDropDown(true);
	$objValidation->setErrorTitle('Error');
	$objValidation->setError('El valor que intenta ingresar, no se encuentra en la lista de seleccion.');
	$objValidation->setPromptTitle($title);
	$objValidation->setPrompt('Seleccione un elemento de la lista.');
	if($tipo=='cadena')	$objValidation->setFormula1('"'.$elementos.'"'); else	$objValidation->setFormula1($elementos); 
}

require 'functions/tildeReplace.php';
require 'functions/interconexiones.php';
require 'functions/saver.php';

// $folio='SS4520150129002';
// $folio='SS4520150325003'; //acceso ericsson
// $folio='SS1720150210001'; //transporte
// $folio='SS1720150317003';
// $folio='SS4520150325005';
// $folio='SS6020150227001';
// $folio='SS4520150129001';
// $folio='SS4520150129003';
// $folio='SS4520150325014';
// $folio='SS4520150129007';
$folio='SS4520150129001';
$datos=cabecera($folio,0);

$dat = mysql_fetch_array(mysql_query("SELECT b.rubro,b.tags,a.estatus FROM infinitum_unica.zsite_survey a,infinitum_unica.ztecnologias b 
		 							  WHERE a.folio='".$folio."' AND a.tecno = b.id"));
$estatus=$dat[2];
// IF(strpos($dat[2],"VALID")) $estatus="Hola"; else echo "Adios";
$rubro=$dat[0];
$tags=explode(",",str_replace(",8","","0,".$dat[1]));	
$array_borrar=array();
if($rubro=='ACCESO'){ $r="AX"; array_push($array_borrar,2); }else{ $r="TX"; array_push($array_borrar,1); }
					
$sheets=array(0=>array('validacion'=>'DG','name'=>'DATOS GENERALES','cable'=>'N/A','campos'=>'N/A'),	
 			  1=>array('validacion'=>"EGS($r)",'name'=>"ESTADO GRAL. DE SITIO ($r)",'cable'=>'N/A','campos'=>'N/A'),
			  2=>array('validacion'=>'AO(O)','name'=>'A.O. (ÓPTICO)','cable'=>'FIBRA OPTICA (AO)','campos'=>'afo'),	
			  3=>array('validacion'=>'BO(O)','name'=>'B.O. (ÓPTICO)','cable'=>'FIBRA OPTICA (BO)','campos'=>'bfo'),				 
			  4=>array('validacion'=>'BO(M)','name'=>'B.O. (MULTIPAR)','cable'=>'MULTIPAR','campos'=>'mp'),			
			  5=>array('validacion'=>'BO(C)','name'=>'B.O. (COAXIAL)','cable'=>'COAXIAL','campos'=>'cx'),				 
			  6=>array('validacion'=>'GYS','name'=>'GESTIÓN Y SINCRONÍA','cable'=>'GESTIÓN/SINCRONÍA','campos'=>'gs'),
			  7=>array('validacion'=>'AYT','name'=>'ALIMENTACIÓN Y TIERRAS','cable'=>'ALIMENTACIÓN','campos'=>'fz'));			  

$objPHPExcel = PHPExcel_IOFactory::load("Site Survey formato.xlsx");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
$l=0;
for($t=0;$t<count($tags);$t++){
	for($s=0;$s<9;$s++){
		$objPHPExcel->setActiveSheetIndex($s);
		$validacion = $objPHPExcel->getActiveSheet()->getCell('A1')->getValue();
		if($validacion==$sheets[$tags[$t]]['validacion']){	
			if($sheets[$tags[$t]]['cable']!='N/A'){ 
				$can_esc[$l]['campos']=$sheets[$tags[$t]]['campos']; 
				$can_esc[$l]['cable']=$sheets[$tags[$t]]['cable']; 
				$l++; 
			}
		}
	}
}

$styleArray = array('font'=>array('bold' => true),'alignment' => array('wrap'=> true,
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER));

$styleArray1 = array('font'=>array('normal' => true),'alignment' => array('wrap'=> true,
					 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER));
$styleArray2 = array('font'=>array('normal' => true),'alignment' => array('wrap'=> true,
					 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER));
					
$border=array('borders'=>array('top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
							   'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
$border1=array('borders'=>array('top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
							   'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)));
$border11=array('borders'=>array('top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
							   'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)));							   
$border2=array('borders'=>array('top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
								'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
$border3=array('borders'=>array('top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
								'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));	
$border33=array('borders'=>array('top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
								'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));	
$border4=array('borders'=>array('top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
								'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)));									
							   
for($t=0;$t<count($tags);$t++){
	for($s=0;$s<9;$s++){
		$objPHPExcel->setActiveSheetIndex($s);
		$validacion = $objPHPExcel->getActiveSheet()->getCell('A1')->getValue();
		if($validacion==$sheets[$tags[$t]]['validacion']){
			if($validacion=="DG"){
				//DATOS GENERALES
				$objPHPExcel->setActiveSheetIndex($s);
				if($datos[4]=='') $datos[4]=$datos[4]; else $datos[4]=datetransform($datos[4]);
				if($datos[5]=='') $datos[5]=$datos[5]; else $datos[5]=datetransform($datos[5]);
				if($datos[6]=='') $datos[6]=$datos[6]; else $datos[6]=datetransform($datos[6]);
				if($datos[7]=='') $datos[7]=$datos[7]; else $datos[7]=datetransform($datos[7]);
				if($datos[8]=='') $datos[8]=$datos[8]; else $datos[8]=datetransform($datos[8]);
				$copias="";
				$query = "SELECT nombre,email FROM infinitum_unica.zccemails WHERE folio = '".$folio."'";
				$correos = mysql_query($query);
				$m = mysql_num_rows($correos);
				if($m>0)	for($a=0;$a<$m;$a++){	$mail = mysql_fetch_array($correos);	$copias.=tildeDecode($mail['nombre']).','.$mail['email'].';';	}
				$copias=explode(";",$copias);
				$copias=array_filter($copias);
				$objPHPExcel->getActiveSheet()->setCellValue('A6', "$folio")        				  ->setCellValue('A7', "$datos[17]")          	
											  ->setCellValue('B4', "$datos[0]")                       ->setCellValue('C4', "$datos[1]")    					 
											  ->setCellValue('D4', "$datos[3]")          			  ->setCellValue('E4', "$datos[2]")
											  ->setCellValue('B6', "$datos[15]")   				      ->setCellValue('C6', "$datos[18]")          
											  ->setCellValue('D6', "$datos[16]")                      ->setCellValue('A9', "$datos[4]")    					 
											  ->setCellValue('B9', "$datos[5]")           			  ->setCellValue('C9', "$datos[6]")
											  ->setCellValue('D9', "$datos[7]")           			  ->setCellValue('E9', "$datos[8]")
											  ->setCellValue('A12', "Responsable Proyectos Telmex")   ->setCellValue('A13', utf8_encode("Responsable en Sitio (Operación)"))          
											  ->setCellValue('A14', "Responsable Contacto Proveedor") ->setCellValue('B12', tildeDecode("$datos[9]"))		 
											  ->setCellValue('C12', "$datos[10]")         			  ->setCellValue('D12', "$datos[19]")
											  ->setCellValue('E12', "$datos[11]")					  ->setCellValue('B13', tildeDecode("$datos[21]"))           
											  ->setCellValue('C13', "$datos[22]")					  ->setCellValue('D13', "$datos[23]")
											  ->setCellValue('E13', "$datos[24]") 					  ->setCellValue('B14', tildeDecode("$datos[12]"))
											  ->setCellValue('C14', "$datos[13]")					  ->setCellValue('D14', "$datos[20]")
											  ->setCellValue('E14', "$datos[14]");
												$j=5;
												for($i=0;$i<count($copias);$i++){
													$nombre_mail=explode(",",$copias[$i]);
													$objPHPExcel->getActiveSheet()->setCellValue("H".$j, "$nombre_mail[0]")->setCellValue("I".$j, "$nombre_mail[1]");
													$j++;
												}							
				$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PHPExcel');
				$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
				$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
				$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
				$objPHPExcel->getActiveSheet()->getProtection()->setInsertColumns(true);
				$objPHPExcel->getActiveSheet()->getProtection()->setDeleteRows(true);
				$objPHPExcel->getActiveSheet()->getProtection()->setDeleteColumns(true);
				$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);
			}
			if($validacion=="EGS(AX)" and $rubro=="ACCESO"){
				//ESTADO GRAL. DE SITIO (AX)
				$objPHPExcel->setActiveSheetIndex($s);
				$sql=mysql_query("SELECT a.id,a.nombre_equipo,a.tipo_trabajo,a.ubicacion,a.nuevoExistente,a.puertos,a.tarjetas,a.espacio FROM infinitum_unica.zss_equipos a,
								  infinitum_unica.ztecnologias b WHERE a.folio='$folio' AND a.id_tecnologia=b.id ORDER BY a.id");
				$j=6;
				while($dat=mysql_fetch_array($sql)){
					$objPHPExcel->getActiveSheet()->setCellValue("A".$j, "$dat[0]")	  ->setCellValue("B".$j, "$dat[1]")	  ->setCellValue("C".$j, "$dat[2]")
												  ->setCellValue("D".$j, "$dat[3]")	  ->setCellValue("E".$j, "$dat[4]")	  ->setCellValue("F".$j, "$dat[5]")
												  ->setCellValue("H".$j, "$dat[6]")	  ->setCellValue("J".$j, "$dat[7]");
					$j++;
				}	
				$j=$j-1;
				
				for($i=6;$i<21;$i++){	
					validation('C'.$i,'Tipo de Trabajo:','LISTAS!$B$2:$B$4',''); 
					validation('E'.$i,'Bastidor:','LISTAS!$A$2:$A$4','');
					validation('J'.$i,'Espacio:','LISTAS!$F$2:$F$5','');
				}
				$objPHPExcel->getActiveSheet()->mergeCells('B22:J22');
				cellColor('B22:J22','5F99F1');
				$objPHPExcel->getActiveSheet()->getStyle('B22:J22')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
				$objPHPExcel->getActiveSheet()->getRowDimension('22')->setRowHeight(24);
				$objPHPExcel->getActiveSheet()->setCellValue('B22', "CANALETAS / ESCALERILLAS");
				$objPHPExcel->getActiveSheet()->getStyle('A22:J22')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle("A22:J22")->getFont()->setName('Arial')->setSize(12);
				$objPHPExcel->getActiveSheet()->setCellValue('B23', "CABLE")	->setCellValue('C23', "TIPO")		  ->setCellValue('D23', "NVO. / EXIS.")
											  ->setCellValue('E23', "SATURADO")	->setCellValue('F23', "ALTURA")		  ->setCellValue('G23', "LARGO")
											  ->setCellValue('H23', "ANCHO")	->setCellValue('I23', "No. BAJANTES") ->setCellValue('J23', "ANCHO BAJANTES");
				$objPHPExcel->getActiveSheet()->getStyle("B23:J23")->getFont()->setName('Arial')->setSize(9);							  
				cellColor('B23:J23','CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('B23:J23')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle('B23:J23')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				for($i=0;$i<count($can_esc);$i++){
					$ii=$i+24;
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$ii,utf8_encode($can_esc[$i]['cable']));
					$sql=mysql_query("SELECT eg_".$can_esc[$i]['campos']."_material,eg_".$can_esc[$i]['campos']."_nuex,eg_".$can_esc[$i]['campos']."_sat,
									  eg_".$can_esc[$i]['campos']."_altura,eg_".$can_esc[$i]['campos']."_trayectoria,eg_".$can_esc[$i]['campos']."_pulgadas,
									  eg_".$can_esc[$i]['campos']."_bajante,eg_".$can_esc[$i]['campos']."_nobajante,eg_coment_can,eg_tipotrabajo,
									  eg_coment_tipotrabajo,eg_tipocentral,eg_coment_tipocentral,eg_tipodepiso,eg_coment_tipodepiso,eg_obracivil,
									  eg_coment_obracivil,eg_tipomaniobra,eg_coment_tipomaniobra,folio FROM infinitum_unica.zsite_survey WHERE folio='".$folio."'");
					while($dat=mysql_fetch_array($sql)){
						$eg_coment_can=tildeDecode($dat[8]);
						$eg_coment_tipotrabajo=tildeDecode($dat[10]);
						$eg_coment_tipocentral=tildeDecode($dat[12]);
						$eg_coment_tipodepiso=tildeDecode($dat[14]);
						$eg_coment_obracivil=tildeDecode($dat[16]);
						$eg_coment_tipomaniobra=tildeDecode($dat[18]);
						switch($dat[0]){
							case 0: $dat[0]="Seleccionar";	break;	
							case 1: $dat[0]="Aluminio";		break;	
							case 2: $dat[0]="Acero";		break;	
							case 3: $dat[0]="Charola";		break;
							case 4: $dat[0]="Plastico";		break;
						}
						switch($dat[1]){
							case 0: $dat[1]="Seleccionar";	break; 	
							case 1: $dat[1]="Nuevo";		break;  
							case 2: $dat[1]="Existente";	break;
						}
						switch($dat[2]){
							case 0: $dat[2]="Seleccionar";	break;  
							case 1: $dat[2]="Si";	  		break;	
							case 2: $dat[2]="No";			break;
						}	
						switch($dat[5]){
							case 0: $dat[5]='Seleccionar';	break;	
							case 1: $dat[5]='2"';			break;	
							case 2: $dat[5]='4"';			break;	
							case 3: $dat[5]='6"';			break;
							case 4: $dat[5]='9"';			break;	
							case 5: $dat[5]='12"';			break;	
							case 6: $dat[5]='24"';			break;
						}
						switch($dat[7]){
							case 0: $dat[7]='Seleccionar';	break;	
							case 1: $dat[7]='2"';			break;	
							case 2: $dat[7]='4"';			break;	
							case 3: $dat[7]='6"';			break;
							case 4: $dat[7]='9"';			break;	
							case 5: $dat[7]='12"';			break;	
							case 6: $dat[7]='24"';			break;
						}	
						switch($dat[9]){
							case 'Nuevo': $eg_tipotrabajo='NUEVO';						break;	
							case 'Ampliacion': $eg_tipotrabajo='AMPLIACION';			break;	
							case '': $eg_tipotrabajo='Seleccione...';					break;	
						}
						$esp_tipocentral="";
						switch(true){
							case ($dat[11]=='Babinete Outdoor'): $eg_tipocentral='GABINETE OUTDOOR';	break;	
							case ($dat[11]=='Contenedor'): $eg_tipocentral='CONTENEDOR';				break;	
							case ($dat[11]=='Central'): $eg_tipocentral='CENTRAL';						break;	
							case ($dat[11]=='Concentrador'): $eg_tipocentral='CONCENTRADOR';			break;	
							case ($dat[11]=='Repetidor'): $eg_tipocentral='REPETIDOR';					break;		
							case ($dat[11]==''): 
								$eg_tipocentral='Seleccione...';						
								$esp_tipocentral='=IF(B'.($ii+9).'="OTRO","Especificar...","")';
								break;	
							case ($dat[11]!='Babinete Outdoor' and $dat[11]!='Contenedor' and $dat[11]!='Central' and $dat[11]!='Concentrador' and $dat[11]!='Repetidor' 
								  and $dat[11]!=''):
								$eg_tipocentral='OTRO';						
								$esp_tipocentral=$dat[11];
								break;	  
						}
						$esp_tipodepiso="";
						switch(true){
							case ($dat[13]=='Piso Firme'): $eg_tipodepiso='PISO FIRME';					break;	
							case ($dat[13]=='Piso Falso'): $eg_tipodepiso='PISO FALSO';					break;	
							case ($dat[13]=='Plataforma'): $eg_tipodepiso='PLATAFORMA';					break;	
							case ($dat[13]==''): 
								$eg_tipodepiso='Seleccione...';				
								$esp_tipodepiso='=IF(B'.($ii+11).'="OTRO","Especificar...","")';
								break;	
							case ($dat[13]!='Piso Firme' and $dat[13]!='Piso Falso' and $dat[13]!='Plataforma' and $dat[13]!=''):
								$eg_tipodepiso='OTRO';				
								$esp_tipodepiso=$dat[13];
								break;	
						}
						$esp_obracivil="";
						switch(true){
							case ($dat[15]=='Sala Nueva'): $eg_obracivil='SALA NUEVA';					break;	
							case ($dat[15]=='Fila Nueva'): $eg_obracivil='FILA NUEVA';					break;	
							case ($dat[15]=='Requiere Pasa Muros'): $eg_obracivil='REQUIERE PASA MUROS';break;	
							case ($dat[15]=='Entre Piso'): $eg_obracivil='ENTRE PISO';					break;	
							case ($dat[15]=='Ninguna'): $eg_obracivil='NINGUNA';						break;	
							case ($dat[15]==''): 
								$eg_obracivil='Seleccione...';						
								$esp_obracivil='=IF(B'.($ii+13).'="OTRO","Especificar...","")';
								break;
							case ($dat[15]!='Sala Nueva' and $dat[15]!='Fila Nueva' and $dat[15]!='Requiere Pasa Muros' and $dat[15]!='Entre Piso' and $dat[15]!='Ninguna'
								  and $dat[15]!='' ):
								$eg_obracivil='OTRO';						
								$esp_obracivil=$dat[15];
								break;	
						}
						$esp_tipomaniobra="";
						switch(true){
							case ($dat[17]=='Maniobra simple'): $eg_tipomaniobra='MANIOBRA SIMPLE';		break;	
							case ($dat[17]=='Polipasto'): $eg_tipomaniobra='POLIPASTO'; 				break;	
							case ($dat[17]=='Poleas y Lazos'): $eg_tipomaniobra='POLEAS Y LAZOS';		break;	
							case ($dat[17]==''): 
								$eg_tipomaniobra='Seleccione...';						
								$esp_tipomaniobra='=IF(B'.($ii+15).'="OTRO","Especificar...","")';
								break;	
							case ($dat[17]!='Maniobra simple' and $dat[17]!='Polipasto' and $dat[17]!='Poleas y Lazos' and $dat[17]!=''):
								$eg_tipomaniobra='OTRO';						
								$esp_tipomaniobra=$dat[17];
								break;
						}
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$ii,"$dat[0]")		  ->setCellValue('D'.$ii,"$dat[1]")		  ->setCellValue('E'.$ii,"$dat[2]")
													  ->setCellValue('F'.$ii,"$dat[3]")		  ->setCellValue('G'.$ii,"$dat[4]")		  ->setCellValue('H'.$ii,"$dat[5]")
													  ->setCellValue('I'.$ii,"$dat[6]")		  ->setCellValue('J'.$ii,"$dat[7]")		  ->setCellValue('K'.$ii,"$dat[19]");
					}
					//BORDES
					$objPHPExcel->getActiveSheet()->getStyle('B'.$ii)->applyFromArray($border);		cellColor('B'.$ii,'D8D8D8');
					$objPHPExcel->getActiveSheet()->getStyle('C'.$ii)->applyFromArray($border);		$objPHPExcel->getActiveSheet()->getStyle('D'.$ii)->applyFromArray($border);	
					$objPHPExcel->getActiveSheet()->getStyle('E'.$ii)->applyFromArray($border);		$objPHPExcel->getActiveSheet()->getStyle('F'.$ii)->applyFromArray($border);	
					$objPHPExcel->getActiveSheet()->getStyle('G'.$ii)->applyFromArray($border);		$objPHPExcel->getActiveSheet()->getStyle('H'.$ii)->applyFromArray($border);	
					$objPHPExcel->getActiveSheet()->getStyle('I'.$ii)->applyFromArray($border);		$objPHPExcel->getActiveSheet()->getStyle('J'.$ii)->applyFromArray($border);
					//VALIDACION
					validation('C'.$ii,'TIPO:','LISTAS!$D$2:$D$6','');
					validation('D'.$ii,'NVO. / EXIS.:','LISTAS!$A$2:$A$4','');
					validation('E'.$ii,'SATURADO:','LISTAS!$E$2:$E$4','');
					validation('H'.$ii,'ANCHO:','LISTAS!$C$2:$C$6','');
					validation('J'.$ii,'ANCHO BAJANTES:','LISTAS!$C$2:$C$6','');
					$objPHPExcel->getSheetByName('LISTAS')->setSheetState(PHPExcel_Worksheet::SHEETSTATE_HIDDEN);
				}
				$objPHPExcel->getActiveSheet()->mergeCells('B'.($ii+1).':J'.($ii+1));
				cellColor('B'.($ii+1).':J'.($ii+1),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+1).':J'.($ii+1))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
				$objPHPExcel->getActiveSheet()->getRowDimension('22')->setRowHeight(24);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+1), "COMENTARIOS");
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+2),"$eg_coment_can");
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+2))->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+1))->getFont()->setName('Arial')->setSize(9);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+1))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->mergeCells('B'.($ii+2).':J'.($ii+2));
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+2).':J'.($ii+2))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getRowDimension($ii+2)->setRowHeight(100);
				$objPHPExcel->getActiveSheet()->mergeCells('B'.($ii+4).':J'.($ii+4));
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+4).':J'.($ii+4))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
				cellColor('B'.($ii+4).':J'.($ii+4),'5F99F1');
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+4).':J'.($ii+4))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getRowDimension(($ii+4))->setRowHeight(24);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+4), "ESTADO GENERAL DE SITIO");
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+4).':J'.($ii+4))->getFont()->setName('Arial')->setSize(12);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+5),utf8_encode("EDIFICACIÓN"));
				cellColor('B'.($ii+5),'D8D8D8');
				$objPHPExcel->getActiveSheet()->mergeCells('C'.($ii+5).':J'.($ii+5));
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+5))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+5))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+5).':J'.($ii+5))->applyFromArray($border);

				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+6),"TIPO DE TRABAJO");
				cellColor('B'.($ii+6),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+6))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+6))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($ii+6),"COMENTARIOS");
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($ii+7),"$eg_coment_tipotrabajo");
				$objPHPExcel->getActiveSheet()->mergeCells('C'.($ii+6).':J'.($ii+6));
				cellColor('C'.($ii+6).':J'.($ii+6),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+6).':J'.($ii+6))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+6).':J'.($ii+6))->applyFromArray($styleArray);
				validation('B'.($ii+7),'TIPO DE TRABAJO:','LISTAS!$G$2:$G$4','');
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+7),$eg_tipotrabajo);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+7))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->mergeCells('C'.($ii+7).':J'.($ii+7));
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+7))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+7).':J'.($ii+7))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getRowDimension($ii+7)->setRowHeight(40);
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+7))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+7))->getAlignment()->setWrapText(true);
				
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+8),"TIPO DE CENTRAL");
				cellColor('B'.($ii+8),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+8))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+8))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($ii+8),"COMENTARIOS");
				$objPHPExcel->getActiveSheet()->setCellValue('D'.($ii+9),"$eg_coment_tipocentral");
				$objPHPExcel->getActiveSheet()->mergeCells('C'.($ii+8).':J'.($ii+8));
				cellColor('C'.($ii+8).':J'.($ii+8),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+8).':J'.($ii+8))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+8).':J'.($ii+8))->applyFromArray($styleArray);
				validation('B'.($ii+9),'TIPO DE CENTRAL:','LISTAS!$H$2:$H$8','');
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+9),$eg_tipocentral);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+9).':J'.($ii+9))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->mergeCells('D'.($ii+9).':J'.($ii+9));
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+9))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($ii+9),"$esp_tipocentral");
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+9))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getRowDimension($ii+9)->setRowHeight(40);
				$objPHPExcel->getActiveSheet()->getStyle('D'.($ii+9).':J'.($ii+9))->applyFromArray($border);
				
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+10),"TIPO DE PISO EN EL SITIO");
				cellColor('B'.($ii+10),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+10))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+10))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($ii+10),"COMENTARIOS");
				$objPHPExcel->getActiveSheet()->setCellValue('D'.($ii+11),"$eg_coment_tipodepiso");
				$objPHPExcel->getActiveSheet()->mergeCells('C'.($ii+10).':J'.($ii+10));
				cellColor('C'.($ii+10).':J'.($ii+10),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+10).':J'.($ii+10))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+10).':J'.($ii+10))->applyFromArray($styleArray);
				validation('B'.($ii+11),'TIPO DE PISO EN EL SITIO:','LISTAS!$I$2:$I$6','');
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+11),$eg_tipodepiso);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+11).':J'.($ii+11))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->mergeCells('D'.($ii+11).':J'.($ii+11));
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+11))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($ii+11),"$esp_tipodepiso");
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+11))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getRowDimension($ii+11)->setRowHeight(40);
				$objPHPExcel->getActiveSheet()->getStyle('D'.($ii+11).':J'.($ii+11))->applyFromArray($border);
				
			 	$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+12),"OBRA CIVIL");
				cellColor('B'.($ii+12),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+12))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+12))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($ii+12),"COMENTARIOS");
				$objPHPExcel->getActiveSheet()->setCellValue('D'.($ii+13),"$eg_coment_obracivil");
				$objPHPExcel->getActiveSheet()->mergeCells('C'.($ii+12).':J'.($ii+12));
				cellColor('C'.($ii+12).':J'.($ii+12),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+12).':J'.($ii+12))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+12).':J'.($ii+12))->applyFromArray($styleArray);
				validation('B'.($ii+13),'OBRA CIVIL:','LISTAS!$J$2:$J$8','');
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+13),$eg_obracivil);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+13).':J'.($ii+13))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->mergeCells('D'.($ii+13).':J'.($ii+13));
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+13))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($ii+13),'=IF(B'.($ii+13).'="OTRO","Especificar...","")');
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+13))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getRowDimension($ii+13)->setRowHeight(40);
				$objPHPExcel->getActiveSheet()->getStyle('D'.($ii+13).':J'.($ii+13))->applyFromArray($border);
				
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+14),"TIPO DE MANIOBRA");
				cellColor('B'.($ii+14),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+14))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+14))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($ii+14),"COMENTARIOS");
				$objPHPExcel->getActiveSheet()->setCellValue('D'.($ii+15),"$eg_coment_tipomaniobra");
				$objPHPExcel->getActiveSheet()->mergeCells('C'.($ii+14).':J'.($ii+14));
				cellColor('C'.($ii+14).':J'.($ii+14),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+14).':J'.($ii+14))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+14).':J'.($ii+14))->applyFromArray($styleArray);
				validation('B'.($ii+15),'TIPO DE MANIOBRA:','LISTAS!$K$2:$K$6','');
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+15),$eg_tipomaniobra);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+15).':J'.($ii+15))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->mergeCells('D'.($ii+15).':J'.($ii+15));
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+15))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($ii+15),"$esp_tipomaniobra");
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+15))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getRowDimension($ii+15)->setRowHeight(40);
				$objPHPExcel->getActiveSheet()->getStyle('D'.($ii+15).':J'.($ii+15))->applyFromArray($border); 
				
				$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PHPExcel');
				$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
				$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
				$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
				$objPHPExcel->getActiveSheet()->getProtection()->setInsertColumns(true);
				$objPHPExcel->getActiveSheet()->getProtection()->setDeleteRows(true);
				$objPHPExcel->getActiveSheet()->getProtection()->setDeleteColumns(true);
				$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);
				if(!strpos($estatus,"VALID")){	
					$objPHPExcel->getActiveSheet()->getStyle("B6:J".$j)->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);	
					$objPHPExcel->getActiveSheet()->getStyle('C24:J'.$ii)->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);	
					$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+2))->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);	
					$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+7).':J'.($ii+7))->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
					$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+9).':J'.($ii+9))->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
					$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+11).':J'.($ii+11))->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
					$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+13).':J'.($ii+13))->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
					$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+15).':J'.($ii+15))->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
				}
			}
			if($validacion=="EGS(TX)" and $rubro=="TRANSPORTE"){ 	
				//ESTADO GRAL. DE SITIO (TX)
				$objPHPExcel->setActiveSheetIndex($s);
				$sql=mysql_query("SELECT b.id,b.nombre_equipo,a.tipo_equipo,b.ubicacion,b.nuevoExistente,b.espacio FROM infinitum_unica.ztecnologias a,
								  infinitum_unica.zss_equipos b WHERE b.folio='".$folio."' AND b.id_tecnologia = a.id");
				$j=6;
				while($dat=mysql_fetch_array($sql)){
					switch($dat[4]){	case '': $dat[4]='Seleccionar';		break;	}
					switch($dat[5]){	case '': $dat[5]='Seleccionar';		break;	}
					$objPHPExcel->getActiveSheet()->setCellValue("A".$j,"$dat[0]")->setCellValue("B".$j,"$dat[1]")->setCellValue("C".$j,"$dat[2]")
												  ->setCellValue("D".$j,"$dat[3]")->setCellValue("F".$j,"$dat[4]")->setCellValue("H".$j,"$dat[5]");
					$j++;
				}	
				
				for($i=6;$i<21;$i++){	
					validation('F'.$i,'Bastidor:','LISTAS!$A$2:$A$4',''); 
					validation('H'.$i,'Espacio:','LISTAS!$F$2:$F$5','');
				}
				$objPHPExcel->getActiveSheet()->mergeCells('B22:J22');
				cellColor('B22:J22','5F99F1');
				$objPHPExcel->getActiveSheet()->getStyle('B22:J22')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
				$objPHPExcel->getActiveSheet()->getRowDimension('22')->setRowHeight(24);
				$objPHPExcel->getActiveSheet()->setCellValue('B22', "CANALETAS / ESCALERILLAS");
				$objPHPExcel->getActiveSheet()->getStyle('A22:J22')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle("A22:J22")->getFont()->setName('Arial')->setSize(12);
				$objPHPExcel->getActiveSheet()->setCellValue('B23', "CABLE")	->setCellValue('C23', "TIPO")		  ->setCellValue('D23', "NVO. / EXIS.")
											  ->setCellValue('E23', "SATURADO")	->setCellValue('F23', "ALTURA")		  ->setCellValue('G23', "LARGO")
											  ->setCellValue('H23', "ANCHO")	->setCellValue('I23', "No. BAJANTES") ->setCellValue('J23', "ANCHO BAJANTES");
				$objPHPExcel->getActiveSheet()->getStyle("B23:J23")->getFont()->setName('Arial')->setSize(9);							  
				cellColor('B23:J23','CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('B23:J23')->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle('B23:J23')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				
				for($i=0;$i<count($can_esc);$i++){
					$ii=$i+24;
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$ii,utf8_encode($can_esc[$i]['cable']));
					$sql=mysql_query("SELECT eg_".$can_esc[$i]['campos']."_material,eg_".$can_esc[$i]['campos']."_nuex,eg_".$can_esc[$i]['campos']."_sat,
									  eg_".$can_esc[$i]['campos']."_altura,eg_".$can_esc[$i]['campos']."_trayectoria,eg_".$can_esc[$i]['campos']."_pulgadas,
									  eg_".$can_esc[$i]['campos']."_bajante,eg_".$can_esc[$i]['campos']."_nobajante,eg_coment_can,eg_tipotrabajo,
									  eg_coment_tipotrabajo,eg_tipocentral,eg_coment_tipocentral,eg_tipodepiso,eg_coment_tipodepiso,eg_obracivil,
									  eg_coment_obracivil,eg_tipomaniobra,eg_coment_tipomaniobra,folio FROM infinitum_unica.zsite_survey WHERE folio='$folio'");
					while($dat=mysql_fetch_array($sql)){
						$eg_coment_can=tildeDecode($dat[8]);
						$eg_coment_tipotrabajo=tildeDecode($dat[10]);
						$eg_coment_tipocentral=tildeDecode($dat[12]);
						$eg_coment_tipodepiso=tildeDecode($dat[14]);
						$eg_coment_obracivil=tildeDecode($dat[16]);
						$eg_coment_tipomaniobra=tildeDecode($dat[18]);
						switch($dat[0]){
							case 0: $dat[0]="Seleccionar";	break;	
							case 1: $dat[0]="Aluminio";		break;	
							case 2: $dat[0]="Acero";		break;	
							case 3: $dat[0]="Charola";		break;
							case 4: $dat[0]="Plastico";		break;
						}
						switch($dat[1]){
							case 0: $dat[1]="Seleccionar";	break; 	
							case 1: $dat[1]="Nuevo";		break;  
							case 2: $dat[1]="Existente";	break;
						}
						switch($dat[2]){
							case 0: $dat[2]="Seleccionar";	break;  
							case 1: $dat[2]="Si";	  		break;	
							case 2: $dat[2]="No";			break;
						}	
						switch($dat[5]){
							case 0: $dat[5]='Seleccionar';	break;	
							case 1: $dat[5]='2"';			break;	
							case 2: $dat[5]='4"';			break;	
							case 3: $dat[5]='6"';			break;
							case 4: $dat[5]='9"';			break;	
							case 5: $dat[5]='12"';			break;	
							case 6: $dat[5]='24"';			break;
						}
						switch($dat[7]){
							case 0: $dat[7]='Seleccionar';	break;	
							case 1: $dat[7]='2"';			break;	
							case 2: $dat[7]='4"';			break;	
							case 3: $dat[7]='6"';			break;
							case 4: $dat[7]='9"';			break;	
							case 5: $dat[7]='12"';			break;	
							case 6: $dat[7]='24"';			break;
						}	
						switch($dat[9]){
							case 'Nuevo': $eg_tipotrabajo='NUEVO';						break;	
							case 'Ampliacion': $eg_tipotrabajo='AMPLIACION';			break;	
							case '': $eg_tipotrabajo='Seleccione...';					break;	
						}
						$esp_tipocentral="";
						switch(true){
							case ($dat[11]=='Babinete Outdoor'): $eg_tipocentral='GABINETE OUTDOOR';	break;	
							case ($dat[11]=='Contenedor'): $eg_tipocentral='CONTENEDOR';				break;	
							case ($dat[11]=='Central'): $eg_tipocentral='CENTRAL';						break;	
							case ($dat[11]=='Concentrador'): $eg_tipocentral='CONCENTRADOR';			break;	
							case ($dat[11]=='Repetidor'): $eg_tipocentral='REPETIDOR';					break;	
							case ($dat[11]==''): 
								$eg_tipocentral='Seleccione...';
								$esp_tipocentral='=IF(B'.($ii+9).'="OTRO","Especificar...","")';
								break;	
							case ($dat[11]!='Babinete Outdoor' and $dat[11]!='Contenedor' and $dat[11]!='Central' and $dat[11]!='Concentrador' and $dat[11]!='Repetidor'
								  and $dat[11]!=''):  
								  $eg_tipocentral='OTRO';
								  $esp_tipocentral=$dat[11];
								  break;	
						}
						$esp_tipodepiso="";
						switch(true){
							case ($dat[13]=='Piso Firme'): $eg_tipodepiso='PISO FIRME';					break;	
							case ($dat[13]=='Piso Falso'): $eg_tipodepiso='PISO FALSO';					break;	
							case ($dat[13]=='Plataforma'): $eg_tipodepiso='PLATAFORMA';					break;	
							case ($dat[13]==''): 
								$eg_tipodepiso='Seleccione...';
								$esp_tipodepiso='=IF(B'.($ii+11).'="OTRO","Especificar...","")';
								break;	
							case ($dat[13]!='Piso Firme' and $dat[13]!='Piso Falso' and $dat[13]!='Plataforma' and $dat[13]!=''):
								$eg_tipodepiso='OTRO';
								$esp_tipodepiso=$dat[13];
								break;	
						}
						$esp_obracivil="";
						switch(true){
							case ($dat[15]=='Sala Nueva'): $eg_obracivil='SALA NUEVA';					break;	
							case ($dat[15]=='Fila Nueva'): $eg_obracivil='FILA NUEVA';					break;	
							case ($dat[15]=='Requiere Pasa Muros'): $eg_obracivil='REQUIERE PASA MUROS';break;	
							case ($dat[15]=='Entre Piso'): $eg_obracivil='ENTRE PISO';					break;	
							case ($dat[15]=='Ninguna'): $eg_obracivil='NINGUNA';						break;	
							case ($dat[15]==''): 
								$eg_obracivil='Seleccione...';							
								$esp_obracivil='=IF(B'.($ii+13).'="OTRO","Especificar...","")';
								break;	
							case ($dat[15]!='Sala Nueva' and $dat[15]!='Fila Nueva' and $dat[15]!='Requiere Pasa Muros' and $dat[15]!='Entre Piso' and $dat[15]!='Ninguna' 
								  and $dat[15]!=''):
								$eg_obracivil='OTRO';							
								$esp_obracivil=$dat[15];
								break;	
						}
						$esp_tipomaniobra="";
						switch(true){
							case ($dat[17]=='Maniobra simple'): $eg_tipomaniobra='MANIOBRA SIMPLE';		break;	
							case ($dat[17]=='Polipasto'): $eg_tipomaniobra='POLIPASTO'; 				break;	
							case ($dat[17]=='Poleas y Lazos'): $eg_tipomaniobra='POLEAS Y LAZOS';		break;	
							case ($dat[17]==''): 
								$eg_tipomaniobra='Seleccione...';						
								$esp_tipomaniobra='=IF(B'.($ii+15).'="OTRO","Especificar...","")';
								break;	
							case ($dat[17]!= 'Maniobra simple' and $dat[17]!='Polipasto' and $dat[17]!='Poleas y Lazos' and $dat[17]!=''):
								$eg_tipomaniobra='OTRO';						
								$esp_tipomaniobra=$dat[17];
								break;
						}
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$ii,"$dat[0]")		  ->setCellValue('D'.$ii,"$dat[1]")		  ->setCellValue('E'.$ii,"$dat[2]")
													  ->setCellValue('F'.$ii,"$dat[3]")		  ->setCellValue('G'.$ii,"$dat[4]")		  ->setCellValue('H'.$ii,"$dat[5]")
													  ->setCellValue('I'.$ii,"$dat[6]")		  ->setCellValue('J'.$ii,"$dat[7]")		  ->setCellValue('K'.$ii,"$dat[19]");
					}
					//BORDES
					$objPHPExcel->getActiveSheet()->getStyle('B'.$ii)->applyFromArray($border);		cellColor('B'.$ii,'D8D8D8');
					$objPHPExcel->getActiveSheet()->getStyle('C'.$ii)->applyFromArray($border);		$objPHPExcel->getActiveSheet()->getStyle('D'.$ii)->applyFromArray($border);	
					$objPHPExcel->getActiveSheet()->getStyle('E'.$ii)->applyFromArray($border);		$objPHPExcel->getActiveSheet()->getStyle('F'.$ii)->applyFromArray($border);	
					$objPHPExcel->getActiveSheet()->getStyle('G'.$ii)->applyFromArray($border);		$objPHPExcel->getActiveSheet()->getStyle('H'.$ii)->applyFromArray($border);	
					$objPHPExcel->getActiveSheet()->getStyle('I'.$ii)->applyFromArray($border);		$objPHPExcel->getActiveSheet()->getStyle('J'.$ii)->applyFromArray($border);
					//VALIDACION
					validation('C'.$ii,'TIPO:','LISTAS!$D$2:$D$6','');
					validation('D'.$ii,'NVO. / EXIS.:','LISTAS!$A$2:$A$4','');
					validation('E'.$ii,'SATURADO:','LISTAS!$E$2:$E$4','');
					validation('H'.$ii,'ANCHO:','LISTAS!$C$2:$C$6','');
					validation('J'.$ii,'ANCHO BAJANTES:','LISTAS!$C$2:$C$6','');
					$objPHPExcel->getSheetByName('LISTAS')->setSheetState(PHPExcel_Worksheet::SHEETSTATE_HIDDEN);
				}
				$objPHPExcel->getActiveSheet()->mergeCells('B'.($ii+1).':J'.($ii+1));
				cellColor('B'.($ii+1).':J'.($ii+1),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+1).':J'.($ii+1))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
				$objPHPExcel->getActiveSheet()->getRowDimension('22')->setRowHeight(24);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+1), "COMENTARIOS");
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+2),"$eg_coment_can");
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+2))->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+1))->getFont()->setName('Arial')->setSize(9);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+1))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->mergeCells('B'.($ii+2).':J'.($ii+2));
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+2).':J'.($ii+2))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getRowDimension($ii+2)->setRowHeight(100);
				$objPHPExcel->getActiveSheet()->mergeCells('B'.($ii+4).':J'.($ii+4));
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+4).':J'.($ii+4))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
				cellColor('B'.($ii+4).':J'.($ii+4),'5F99F1');
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+4).':J'.($ii+4))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getRowDimension(($ii+4))->setRowHeight(24);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+4), "ESTADO GENERAL DE SITIO");
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+4).':J'.($ii+4))->getFont()->setName('Arial')->setSize(12);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+5),utf8_encode("EDIFICACIÓN"));
				cellColor('B'.($ii+5),'D8D8D8');
				$objPHPExcel->getActiveSheet()->mergeCells('C'.($ii+5).':J'.($ii+5));
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+5))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+5))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+5).':J'.($ii+5))->applyFromArray($border);

				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+6),"TIPO DE TRABAJO");
				cellColor('B'.($ii+6),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+6))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+6))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($ii+6),"COMENTARIOS");
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($ii+7),"$eg_coment_tipotrabajo");
				$objPHPExcel->getActiveSheet()->mergeCells('C'.($ii+6).':J'.($ii+6));
				cellColor('C'.($ii+6).':J'.($ii+6),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+6).':J'.($ii+6))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+6).':J'.($ii+6))->applyFromArray($styleArray);
				validation('B'.($ii+7),'TIPO DE TRABAJO:','LISTAS!$G$2:$G$4','');
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+7),$eg_tipotrabajo);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+7))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->mergeCells('C'.($ii+7).':J'.($ii+7));
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+7))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+7).':J'.($ii+7))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getRowDimension($ii+7)->setRowHeight(40);
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+7))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+7))->getAlignment()->setWrapText(true);
				
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+8),"TIPO DE CENTRAL");
				cellColor('B'.($ii+8),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+8))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+8))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($ii+8),"COMENTARIOS");
				$objPHPExcel->getActiveSheet()->setCellValue('D'.($ii+9),"$eg_coment_tipocentral");
				$objPHPExcel->getActiveSheet()->mergeCells('C'.($ii+8).':J'.($ii+8));
				cellColor('C'.($ii+8).':J'.($ii+8),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+8).':J'.($ii+8))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+8).':J'.($ii+8))->applyFromArray($styleArray);
				validation('B'.($ii+9),'TIPO DE CENTRAL:','LISTAS!$H$2:$H$8','');
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+9),$eg_tipocentral);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+9).':J'.($ii+9))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->mergeCells('D'.($ii+9).':J'.($ii+9));
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+9))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($ii+9),"$esp_tipocentral");
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+9))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getRowDimension($ii+9)->setRowHeight(40);
				$objPHPExcel->getActiveSheet()->getStyle('D'.($ii+9).':J'.($ii+9))->applyFromArray($border);
				
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+10),"TIPO DE PISO EN EL SITIO");
				cellColor('B'.($ii+10),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+10))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+10))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($ii+10),"COMENTARIOS");
				$objPHPExcel->getActiveSheet()->setCellValue('D'.($ii+11),"$eg_coment_tipodepiso");
				$objPHPExcel->getActiveSheet()->mergeCells('C'.($ii+10).':J'.($ii+10));
				cellColor('C'.($ii+10).':J'.($ii+10),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+10).':J'.($ii+10))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+10).':J'.($ii+10))->applyFromArray($styleArray);
				validation('B'.($ii+11),'TIPO DE PISO EN EL SITIO:','LISTAS!$I$2:$I$6','');
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+11),$eg_tipodepiso);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+11).':J'.($ii+11))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->mergeCells('D'.($ii+11).':J'.($ii+11));
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+11))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($ii+11),"$esp_tipodepiso");
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+11))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getRowDimension($ii+11)->setRowHeight(40);
				$objPHPExcel->getActiveSheet()->getStyle('D'.($ii+11).':J'.($ii+11))->applyFromArray($border);
				
			 	$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+12),"OBRA CIVIL");
				cellColor('B'.($ii+12),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+12))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+12))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($ii+12),"COMENTARIOS");
				$objPHPExcel->getActiveSheet()->setCellValue('D'.($ii+13),"$eg_coment_obracivil");
				$objPHPExcel->getActiveSheet()->mergeCells('C'.($ii+12).':J'.($ii+12));
				cellColor('C'.($ii+12).':J'.($ii+12),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+12).':J'.($ii+12))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+12).':J'.($ii+12))->applyFromArray($styleArray);
				validation('B'.($ii+13),'OBRA CIVIL:','LISTAS!$J$2:$J$8','');
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+13),$eg_obracivil);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+13).':J'.($ii+13))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->mergeCells('D'.($ii+13).':J'.($ii+13));
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+13))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($ii+13),"$esp_obracivil");
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+13))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getRowDimension($ii+13)->setRowHeight(40);
				$objPHPExcel->getActiveSheet()->getStyle('D'.($ii+13).':J'.($ii+13))->applyFromArray($border);
				
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+14),"TIPO DE MANIOBRA");
				cellColor('B'.($ii+14),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+14))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+14))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($ii+14),"COMENTARIOS");
				$objPHPExcel->getActiveSheet()->setCellValue('D'.($ii+15),"$eg_coment_tipomaniobra");
				$objPHPExcel->getActiveSheet()->mergeCells('C'.($ii+14).':J'.($ii+14));
				cellColor('C'.($ii+14).':J'.($ii+14),'CAE4FF');
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+14).':J'.($ii+14))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+14).':J'.($ii+14))->applyFromArray($styleArray);
				validation('B'.($ii+15),'TIPO DE MANIOBRA:','LISTAS!$K$2:$K$6','');
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii+15),$eg_tipomaniobra);
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+15).':J'.($ii+15))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objPHPExcel->getActiveSheet()->mergeCells('D'.($ii+15).':J'.($ii+15));
				$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+15))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($ii+15),"$esp_tipomaniobra");
				$objPHPExcel->getActiveSheet()->getStyle('C'.($ii+15))->applyFromArray($border);
				$objPHPExcel->getActiveSheet()->getRowDimension($ii+15)->setRowHeight(40);
				$objPHPExcel->getActiveSheet()->getStyle('D'.($ii+15).':J'.($ii+15))->applyFromArray($border);
				
				$j=$j-1;
				$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PHPExcel');
				$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
				$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
				$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
				$objPHPExcel->getActiveSheet()->getProtection()->setDeleteRows(true);
				$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);
				if(!strpos($estatus,"VALID")){	
					$objPHPExcel->getActiveSheet()->getStyle("B6:J".$j)->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);	
					$objPHPExcel->getActiveSheet()->getStyle('C24:J'.$ii)->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
					$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+2))->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);	
					$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+7).':J'.($ii+7))->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);	
					$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+9).':J'.($ii+9))->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);	
					$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+11).':J'.($ii+11))->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);	
					$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+13).':J'.($ii+13))->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);	
					$objPHPExcel->getActiveSheet()->getStyle('B'.($ii+15).':J'.($ii+15))->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);	
				}
			}
			if($validacion=="AO(O)"){
				//ALTO ORDEN (ÓPTICO)
				$objPHPExcel->setActiveSheetIndex($s);
				
				$sql=mysql_query("SELECT afo_bastidor_fibra,afo_bastidor_marca,afo_tipo_bastidor_fibra,afo_comentarios FROM infinitum_unica.zsite_survey WHERE folio='$folio'");
				$dat=mysql_fetch_array($sql);
				$i=5;
				validation('B'.$i,'SE URILIZARA BASTIDOR DE FIBRAS:','LISTAS!$A$2:$A$4','');
				validation('E'.$i,'MARCA:','LISTAS!$L$2:$L$4','');
				validation('G'.$i,'TIPO DE BASTIDOR DE FIBRAS:','LISTAS!$M$2:$M$6','');
				$objPHPExcel->getActiveSheet()->setCellValue("B".$i,"$dat[0]")->setCellValue("E".$i,"$dat[1]")->setCellValue("G".$i,"$dat[2]")->setCellValue("H".$i,'=IF(G5'.$i.'="OTRO","Especificar...","")');
				$objPHPExcel->getActiveSheet()->getStyle('B'.$i.':I'.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				
				$j=$i+5;
				$k=$i+5;
				$sql1=mysql_query("SELECT b.nombre_equipo,a.ubicacion,a.tipo_conector_equipo,a.posicion_remate,a.tipo_fibra,a.tipo_conector_bdfo,
								    a.bloque_dfo,a.long_jumper_1,a.long_jumper_2 FROM infinitum_unica.zinter_abfo a,infinitum_unica.zss_equipos b
									WHERE a.id_equipo=b.id AND a.folio='".$folio."' AND b.id_tecnologia!=0 AND a.alto_bajo='1' ORDER BY b.id ASC");
				while($dat1=mysql_fetch_array($sql1)){
					$objPHPExcel->getActiveSheet()->setCellValue("A".$j,"$dat1[0]")->setCellValue("B".$j,"$dat1[1]")->setCellValue("C".$j,"$dat1[2]")->setCellValue("D".$j,"$dat1[3]")
												  ->setCellValue("E".$j,"$dat1[4]")->setCellValue("F".$j,"$dat1[5]")->setCellValue("G".$j,"$dat1[6]")->setCellValue("H".$j,"$dat1[7]")
												  ->setCellValue("I".$j,"$dat1[8]");
					$j++;
				}
				for($i=$k;$i<25;$i++){	
					validation('D'.$i,'TIPO CONECTOR EQUIPO:','LISTAS!$N$2:$N$6','');		
					validation('E'.$i,'TIPO DE FIBRA:','LISTAS!$O$2:$O$8','');
					validation('F'.$i,'TIPO CONECTOR LADO DFO:','LISTAS!$N$2:$N$6','');		
					validation('G'.$i,'BLOQUE DFO:','LISTAS!$A$2:$A$4','');
				}
				$j=$i+2;
				$objPHPExcel->getActiveSheet()->setCellValue("A".$j,"$dat[3]");
				$objPHPExcel->getActiveSheet()->getStyle("A".$j.":I".$j)->applyFromArray($styleArray1);
			}
			if($validacion=="BO(O)"){
				//BAJO ORDEN (ÓPTICO)
				$objPHPExcel->setActiveSheetIndex($s);
				
				$sql=mysql_query("SELECT bfo_bastidor_fibra,bfo_bastidor_marca,bfo_tipo_bastidor_fibra,bfo_comentarios FROM infinitum_unica.zsite_survey WHERE folio='$folio'");
				$dat=mysql_fetch_array($sql);
				$i=5;
				validation('B'.$i,'SE URILIZARA BASTIDOR DE FIBRAS:','LISTAS!$A$2:$A$4','');
				validation('E'.$i,'MARCA:','LISTAS!$L$2:$L$4','');
				validation('G'.$i,'TIPO DE BASTIDOR DE FIBRAS:','LISTAS!$M$2:$M$6','');
				$objPHPExcel->getActiveSheet()->setCellValue("B".$i,"$dat[0]")->setCellValue("E".$i,"$dat[1]")->setCellValue("G".$i,"$dat[2]")->setCellValue("H".$i,'=IF(G5'.$i.'="OTRO","Especificar...","")');
				$objPHPExcel->getActiveSheet()->getStyle('B'.$i.':I'.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				
				$j=$i+5;
				$k=$i+5;
				$sql1=mysql_query("SELECT b.nombre_equipo,a.ubicacion,a.tipo_conector_equipo,a.posicion_remate,a.tipo_fibra,a.tipo_conector_bdfo,
								    a.bloque_dfo,a.long_jumper_1,a.long_jumper_2 FROM infinitum_unica.zinter_abfo a,infinitum_unica.zss_equipos b
									WHERE a.id_equipo=b.id AND a.folio='".$folio."' AND b.id_tecnologia!=0 AND a.alto_bajo='0' ORDER BY b.id ASC");
				while($dat1=mysql_fetch_array($sql1)){
					$objPHPExcel->getActiveSheet()->setCellValue("A".$j,"$dat1[0]")->setCellValue("B".$j,"$dat1[1]")->setCellValue("C".$j,"$dat1[2]")->setCellValue("D".$j,"$dat1[3]")
												  ->setCellValue("E".$j,"$dat1[4]")->setCellValue("F".$j,"$dat1[5]")->setCellValue("G".$j,"$dat1[6]")->setCellValue("H".$j,"$dat1[7]")
												  ->setCellValue("I".$j,"$dat1[8]");
					$j++;
				}
				for($i=$k;$i<25;$i++){	
					validation('D'.$i,'TIPO CONECTOR EQUIPO:','LISTAS!$N$2:$N$6','');		
					validation('E'.$i,'TIPO DE FIBRA:','LISTAS!$O$2:$O$8','');
					validation('F'.$i,'TIPO CONECTOR LADO DFO:','LISTAS!$N$2:$N$6','');		
					validation('G'.$i,'BLOQUE DFO:','LISTAS!$A$2:$A$4','');
				}
				$j=$i+2;
				$objPHPExcel->getActiveSheet()->setCellValue("A".$j,"$dat[3]");
				$objPHPExcel->getActiveSheet()->getStyle("A".$j.":I".$j)->applyFromArray($styleArray1);
			}
			if($validacion=="BO(M)"){
				//BAJO ORDEN (MULTIPAR)
				$objPHPExcel->setActiveSheetIndex($s);
				
				$sql=mysql_query("SELECT mp_dgral,mp_ampvertical,mp_disgral,mp_comentarios FROM infinitum_unica.zsite_survey WHERE folio='$folio'");
				$dat=mysql_fetch_array($sql);
				$i=5;
				validation('B'.$i,'SE URILIZARA DISTRIBUIDOR GENERAL:','LISTAS!$A$2:$A$4','');
				validation('E'.$i,'REQUIERE AMPLIACION DE VERTICALES:','LISTAS!$L$2:$L$4','');
				validation('G'.$i,'TIPO DE DISTRIBUIDOR GENERAL:','LISTAS!$P$2:$P$5','');
				$objPHPExcel->getActiveSheet()->setCellValue("B".$i,"$dat[0]")->setCellValue("E".$i,"$dat[1]")->setCellValue("G".$i,"$dat[2]")->setCellValue("H".$i,'=IF(G5'.$i.'="OTRO","Especificar...","")');
				$objPHPExcel->getActiveSheet()->getStyle('B'.$i.':I'.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				
				$sql1 = "SELECT GROUP_CONCAT(DISTINCT b.pots_dsl) p,GROUP_CONCAT(DISTINCT nombre_equipo) ne,GROUP_CONCAT(DISTINCT b.tipo_tablilla) tt,
					     GROUP_CONCAT(DISTINCT b.long_cable) lc,GROUP_CONCAT(b.nivel ORDER BY b.id) nv,GROUP_CONCAT(b.vertical ORDER BY b.id) v,
					     GROUP_CONCAT(b.puertos ORDER BY b.id) pt,count(a.nombre_equipo) cne FROM infinitum_unica.zss_equipos a LEFT JOIN infinitum_unica.zinter_mp b 
					     ON a.id=b.id_equipo WHERE a.folio='".$folio."' AND a.tipo_trabajo='Repisa Nueva' GROUP BY b.pots_dsl,a.nombre_equipo";				   
				$sql2=mysql_query("SELECT ne,tt,lc,cne FROM ($sql1) a GROUP BY ne");
				$ii=$i+5;
				if(mysql_num_rows($sql2)>0){
					while($dat1=mysql_fetch_array($sql2)){
						$j=($ii-1)+$dat1[3];
						$objPHPExcel->getActiveSheet()->mergeCells('A'.($ii).':A'.($j));
						$objPHPExcel->getActiveSheet()->setCellValue('A'.($ii),"$dat1[0]");
						$objPHPExcel->getActiveSheet()->getStyle("A".$ii.":I".$j)->applyFromArray($styleArray1);
						$objPHPExcel->getActiveSheet()->getStyle("A".$ii.":A".$j)->applyFromArray($border1);
						$objPHPExcel->getActiveSheet()->mergeCells('B'.$ii.':B'.$j);
						$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii),"$dat1[1]");
						$objPHPExcel->getActiveSheet()->getStyle("B".$ii.":B".$j)->applyFromArray($styleArray1);
						$objPHPExcel->getActiveSheet()->getStyle("B".$ii.":B".$j)->applyFromArray($border2);
						validation('B'.$ii,'TIPO TABLILLA:','LISTAS!$Q$2:$Q$4','');		
						$objPHPExcel->getActiveSheet()->mergeCells('C'.$ii.':C'.$j);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$ii,"$dat1[2]");
						$objPHPExcel->getActiveSheet()->getStyle("C".$ii.":C".$j)->applyFromArray($styleArray1);
						$objPHPExcel->getActiveSheet()->getStyle("C".$ii.":C".$j)->applyFromArray($border2);
						$ii=$ii+$dat1[3];
					}				
					$sql3=mysql_query($sql1);
				
					$ii=$i+5;
					$i=$i+5;
					while($dat2=mysql_fetch_array($sql3)){
						$b=explode(",",$dat2[0]);
						for($x=0;$x<count($b);$x++){
							$nivel=explode(",",$dat2[4]);
							$vertical=explode(",",$dat2[5]);
							$puertos=explode(",",$dat2[6]);
							if($b[$x]=='0'){
								for($y=0;$y<$dat2[7];$y++){
									$objPHPExcel->getActiveSheet()->setCellValue('D'.$i,"$nivel[$y]");
									$objPHPExcel->getActiveSheet()->setCellValue('E'.$i,"$vertical[$y]");
									$objPHPExcel->getActiveSheet()->setCellValue('F'.$i,"$puertos[$y]");
									$objPHPExcel->getActiveSheet()->getStyle("D".$i.":F".$i)->applyFromArray($styleArray2);
									if($y==($dat2[7]-1)){
										$objPHPExcel->getActiveSheet()->getStyle("D".$i)->applyFromArray($border1);
										$objPHPExcel->getActiveSheet()->getStyle("E".$i)->applyFromArray($border2);
										$objPHPExcel->getActiveSheet()->getStyle("F".$i)->applyFromArray($border3);
									}else{
										$objPHPExcel->getActiveSheet()->getStyle("D".$i)->applyFromArray($border11);
										$objPHPExcel->getActiveSheet()->getStyle("E".$i)->applyFromArray($border);
										$objPHPExcel->getActiveSheet()->getStyle("F".$i)->applyFromArray($border33);
									}
									$i++;
								}
							}else{
								for($y=0;$y<$dat2[7];$y++){
									$objPHPExcel->getActiveSheet()->setCellValue('G'.$ii,"$nivel[$y]");
									$objPHPExcel->getActiveSheet()->setCellValue('H'.$ii,"$vertical[$y]");
									$objPHPExcel->getActiveSheet()->setCellValue('I'.$ii,"$puertos[$y]");
									$objPHPExcel->getActiveSheet()->getStyle("G".$ii.":I".$ii)->applyFromArray($styleArray2);
									if($y==($dat2[7]-1)){
										$objPHPExcel->getActiveSheet()->getStyle("G".$ii)->applyFromArray($border1);
										$objPHPExcel->getActiveSheet()->getStyle("H".$ii)->applyFromArray($border2);
										$objPHPExcel->getActiveSheet()->getStyle("I".$ii)->applyFromArray($border3);
									}else{
										$objPHPExcel->getActiveSheet()->getStyle("G".$ii)->applyFromArray($border11);
										$objPHPExcel->getActiveSheet()->getStyle("H".$ii)->applyFromArray($border);
										$objPHPExcel->getActiveSheet()->getStyle("I".$ii)->applyFromArray($border33);
									}
									$ii++;
								}
							}
						}
					}
				}
				$ii=$ii+1;
				$objPHPExcel->getActiveSheet()->getStyle('A'.$ii.':I'.$ii)->applyFromArray($border4);
				cellColor('A'.$ii.':I'.$ii,'5F99F1');
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$ii.':I'.$ii);
				$objPHPExcel->getActiveSheet()->getStyle("A".$ii)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$ii)->getFont()->setBold(true)->setName('Calibri')->setSize(9);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$ii,"TABLA DE REMATES EQUIPOS EXISTENTES");
				$ii=$ii+1;
				$objPHPExcel->getActiveSheet()->getStyle('A'.$ii.':C'.$ii)->applyFromArray($border4);
				cellColor('A'.$ii.':I'.$ii,'D8D8D8');
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$ii.':C'.$ii);
				$objPHPExcel->getActiveSheet()->getStyle("A".$ii)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$ii)->getFont()->setBold(true)->setName('Calibri')->setSize(9);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$ii.':F'.$ii)->applyFromArray($border4);
				$objPHPExcel->getActiveSheet()->mergeCells('D'.$ii.':F'.$ii);
				$objPHPExcel->getActiveSheet()->getStyle("D".$ii)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$ii)->getFont()->setBold(true)->setName('Calibri')->setSize(9);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$ii,"POTS");
				$objPHPExcel->getActiveSheet()->getStyle('G'.$ii.':I'.$ii)->applyFromArray($border4);
				$objPHPExcel->getActiveSheet()->mergeCells('G'.$ii.':I'.$ii);
				$objPHPExcel->getActiveSheet()->getStyle("G".$ii)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$ii)->getFont()->setBold(true)->setName('Calibri')->setSize(9);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$ii,"DSL");
				$ii=$ii+1;
				cellColor('A'.$ii.':I'.$ii,'CAE4FF');
				$array_l=array(0=>array('letra'=>'A','valor'=>'Equipo'),1=>array('letra'=>'B','valor'=>'Tipo tablilla'),2=>array('letra'=>'C','valor'=>'Long. Cable'),
							   3=>array('letra'=>'D','valor'=>'Nivel'),4=>array('letra'=>'E','valor'=>'Vertical'),5=>array('letra'=>'F','valor'=>'Puerto'),
							   6=>array('letra'=>'G','valor'=>'Nivel'),7=>array('letra'=>'H','valor'=>'Vertical'),8=>array('letra'=>'I','valor'=>'Puerto'));
				for($l=0;$l<count($array_l);$l++){	
					$objPHPExcel->getActiveSheet()->getStyle($array_l[$l]['letra'].$ii)->applyFromArray($border4);
					$objPHPExcel->getActiveSheet()->getStyle($array_l[$l]['letra'].$ii)->applyFromArray($styleArray);
					$objPHPExcel->getActiveSheet()->getStyle($array_l[$l]['letra'].$ii)->getFont()->setBold(true)->setName('Calibri')->setSize(9);
					$objPHPExcel->getActiveSheet()->setCellValue($array_l[$l]['letra'].$ii,$array_l[$l]['valor']);
				}
				$ii=$ii+1;
				$sql11 = "SELECT GROUP_CONCAT(DISTINCT b.pots_dsl) p,GROUP_CONCAT(DISTINCT nombre_equipo) ne,GROUP_CONCAT(DISTINCT b.tipo_tablilla) tt,
					     GROUP_CONCAT(DISTINCT b.long_cable) lc,GROUP_CONCAT(b.nivel ORDER BY b.id) nv,GROUP_CONCAT(b.vertical ORDER BY b.id) v,
					     GROUP_CONCAT(b.puertos ORDER BY b.id) pt,count(a.nombre_equipo) cne FROM infinitum_unica.zss_equipos a LEFT JOIN infinitum_unica.zinter_mp b 
					     ON a.id=b.id_equipo WHERE a.folio='".$folio."' AND a.tipo_trabajo!='Repisa Nueva' GROUP BY b.pots_dsl,a.nombre_equipo";				   
				$sql22=mysql_query("SELECT ne,tt,lc,cne FROM ($sql11) a GROUP BY ne");
				if(mysql_num_rows($sql22)>0){
					while($dat11=mysql_fetch_array($sql22)){
						$j=($ii-1)+$dat11[3];
						$objPHPExcel->getActiveSheet()->mergeCells('A'.($ii).':A'.($j));
						$objPHPExcel->getActiveSheet()->setCellValue('A'.($ii),"$dat11[0]");
						$objPHPExcel->getActiveSheet()->getStyle("A".$ii.":I".$j)->applyFromArray($styleArray1);
						$objPHPExcel->getActiveSheet()->getStyle("A".$ii.":A".$j)->applyFromArray($border1);
						$objPHPExcel->getActiveSheet()->mergeCells('B'.$ii.':B'.$j);
						$objPHPExcel->getActiveSheet()->setCellValue('B'.($ii),"$dat11[1]");
						$objPHPExcel->getActiveSheet()->getStyle("B".$ii.":B".$j)->applyFromArray($styleArray1);
						$objPHPExcel->getActiveSheet()->getStyle("B".$ii.":B".$j)->applyFromArray($border2);
						validation('B'.$ii,'TIPO TABLILLA:','LISTAS!$Q$2:$Q$4','');		
						$objPHPExcel->getActiveSheet()->mergeCells('C'.$ii.':C'.$j);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$ii,"$dat11[2]");
						$objPHPExcel->getActiveSheet()->getStyle("C".$ii.":C".$j)->applyFromArray($styleArray1);
						$objPHPExcel->getActiveSheet()->getStyle("C".$ii.":C".$j)->applyFromArray($border2);
						$ii=$ii+$dat11[3];
					}				
					$sql33=mysql_query($sql11);
				
					$ii=$i+1;
					$i=$i+1;
					while($dat22=mysql_fetch_array($sql33)){
						$b=explode(",",$dat22[0]);
						for($x=0;$x<count($b);$x++){
							$nivel=explode(",",$dat22[4]);
							$vertical=explode(",",$dat22[5]);
							$puertos=explode(",",$dat22[6]);
							if($b[$x]=='0'){
								for($y=0;$y<$dat22[7];$y++){
									$objPHPExcel->getActiveSheet()->setCellValue('D'.$i,"$nivel[$y]");
									$objPHPExcel->getActiveSheet()->setCellValue('E'.$i,"$vertical[$y]");
									$objPHPExcel->getActiveSheet()->setCellValue('F'.$i,"$puertos[$y]");
									$objPHPExcel->getActiveSheet()->getStyle("D".$i.":F".$i)->applyFromArray($styleArray2);
									if($y==($dat22[7]-1)){
										$objPHPExcel->getActiveSheet()->getStyle("D".$i)->applyFromArray($border1);
										$objPHPExcel->getActiveSheet()->getStyle("E".$i)->applyFromArray($border2);
										$objPHPExcel->getActiveSheet()->getStyle("F".$i)->applyFromArray($border3);
									}else{
										$objPHPExcel->getActiveSheet()->getStyle("D".$i)->applyFromArray($border11);
										$objPHPExcel->getActiveSheet()->getStyle("E".$i)->applyFromArray($border);
										$objPHPExcel->getActiveSheet()->getStyle("F".$i)->applyFromArray($border33);
									}
									$i++;
								}
							}else{
								for($y=0;$y<$dat22[7];$y++){
									$objPHPExcel->getActiveSheet()->setCellValue('G'.$ii,"$nivel[$y]");
									$objPHPExcel->getActiveSheet()->setCellValue('H'.$ii,"$vertical[$y]");
									$objPHPExcel->getActiveSheet()->setCellValue('I'.$ii,"$puertos[$y]");
									$objPHPExcel->getActiveSheet()->getStyle("G".$ii.":I".$ii)->applyFromArray($styleArray2);
									if($y==($dat22[7]-1)){
										$objPHPExcel->getActiveSheet()->getStyle("G".$ii)->applyFromArray($border1);
										$objPHPExcel->getActiveSheet()->getStyle("H".$ii)->applyFromArray($border2);
										$objPHPExcel->getActiveSheet()->getStyle("I".$ii)->applyFromArray($border3);
									}else{
										$objPHPExcel->getActiveSheet()->getStyle("G".$ii)->applyFromArray($border11);
										$objPHPExcel->getActiveSheet()->getStyle("H".$ii)->applyFromArray($border);
										$objPHPExcel->getActiveSheet()->getStyle("I".$ii)->applyFromArray($border33);
									}
									$ii++;
								}
							}
						}
					}
				}
				$ii=$ii+1;
				cellColor('A'.$ii.':I'.$ii,'5F99F1');
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$ii.':I'.$ii);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$ii.':I'.$ii)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$ii.':I'.$ii)->getFont()->setBold(true)->setName('Calibri')->setSize(9);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$ii,"COMENTARIOS");
				$objPHPExcel->getActiveSheet()->getStyle('A'.$ii.':I'.$ii)->applyFromArray($border4);
				$ii=$ii+1;
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$ii.':I'.$ii);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$ii.':I'.$ii)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$ii.':I'.$ii)->getFont()->setBold(true)->setName('Calibri')->setSize(9);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$ii.':I'.$ii)->applyFromArray($border4);
				$objPHPExcel->getActiveSheet()->getRowDimension($ii)->setRowHeight(100);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$ii,"$dat[3]");
			}
			if($validacion=="BO(C)"){
				//BAJO ORDEN (COAXIAL)
				$objPHPExcel->setActiveSheetIndex($s);
				
				$sql=mysql_query("SELECT cx_escalerilla_bdtd,cx_escalerilla_bdtd_espacio,cx_tipo_escalerilla_bdtd,cx_comentarios FROM infinitum_unica.zsite_survey 
								  WHERE folio='$folio'");
				$dat=mysql_fetch_array($sql);
				$i=5;
				validation('B'.$i,'SE URILIZARA BASTIDOR BDTD:','LISTAS!$A$2:$A$4','');
				validation('E'.$i,'ESPACIO DISPONIBLE:','LISTAS!$E$2:$E$4','');
				validation('H'.$i,'TIPO DE BDTD:','LISTAS!$R$2:$R$5','');
				$objPHPExcel->getActiveSheet()->setCellValue("B".$i,"$dat[0]")->setCellValue("E".$i,"$dat[1]")->setCellValue("H".$i,"$dat[2]")->setCellValue("I".$i,'=IF(H'.$i.'="OTRO","Especificar...","")');
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':I'.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

				$j=$i+5;
				$k=$i+5;
				$sql1=mysql_query("SELECT b.nombre_equipo,a.ubicacion,a.pos_tablilla,a.lado,a.pos_contacto,a.tipo_conector,a.tipo_coaxial,a.tx_rx,a.long_cable 
								   FROM infinitum_unica.zinter_cx a,infinitum_unica.zss_equipos b WHERE a.id_equipo=b.id AND a.folio='".$folio."' ORDER BY a.id ASC");
				while($dat1=mysql_fetch_array($sql1)){
					$objPHPExcel->getActiveSheet()->setCellValue("A".$j,"$dat1[0]")->setCellValue("B".$j,"$dat1[1]")->setCellValue("C".$j,"$dat1[2]")->setCellValue("D".$j,"$dat1[3]")
												  ->setCellValue("E".$j,"$dat1[4]")->setCellValue("F".$j,"$dat1[5]")->setCellValue("G".$j,"$dat1[6]")->setCellValue("H".$j,"$dat1[7]")
												  ->setCellValue("I".$j,"$dat1[8]");
					$j++;
				}
				for($i=$k;$i<25;$i++){	
					validation('C'.$i,'POSICION TABLILLA:','LISTAS!$S$2:$S$4','');		
					validation('F'.$i,'TIPO DE CONECTOR:','LISTAS!$T$2:$T$4','');
					validation('G'.$i,'TIPO COAXIAL:','LISTAS!$U$2:$U$4','');		
					validation('H'.$i,'TX / RX:','LISTAS!$V$2:$V$4','');
				}
				$j=$i+2;
				$objPHPExcel->getActiveSheet()->setCellValue("A".$j,"$dat[3]");
				$objPHPExcel->getActiveSheet()->getStyle("A".$j.":I".$j)->applyFromArray($styleArray1); 
			}
			if($validacion=="GYS"){
				//GESTION Y SINCRONIA
				$objPHPExcel->setActiveSheetIndex($s);
				
				$sql=mysql_query("SELECT gs_requieregestion,gs_tipogestion,gs_puertoRCDT,gs_comentarios,gs_requieresincronia,gs_cnaddalarmas,gs_reqctoalim 
								  FROM infinitum_unica.zsite_survey WHERE folio='$folio'");
				$dat=mysql_fetch_array($sql);
				$i=5;
				validation('B'.$i,'REQUIERE GESTION:','LISTAS!$E$2:$E$4','');
				validation('D'.$i,'TIPO DE GESTION:','LISTAS!$W$2:$W$4','');
				validation('G'.$i,'SE UTILIZARA PUERTO RCDT:','LISTAS!$E$2:$E$4','');
				$objPHPExcel->getActiveSheet()->setCellValue("B".$i,"$dat[0]")->setCellValue("D".$i,"$dat[1]")->setCellValue("G".$i,"$dat[2]");
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':G'.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$i=$i+3;
				validation('B'.$i,'REQUIERE SINCRONIA:','LISTAS!$E$2:$E$4','');
				validation('D'.$i,'REQUIERE CONEXION ADICIONAL DE ALARMAS:','LISTAS!$E$2:$E$4','');
				validation('G'.$i,'REQUIERE CIRCUITO DE ALIMENTACION:','LISTAS!$E$2:$E$4','');
				$objPHPExcel->getActiveSheet()->setCellValue("B".$i,"$dat[4]")->setCellValue("D".$i,"$dat[5]")->setCellValue("G".$i,"$dat[6]");
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':G'.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				
				$j=$i+5;
				$sql1=mysql_query("SELECT b.nombre_equipo,a.ubicacion_RCDT,a.numero_switch,a.puerto,a.cat_cable,a.long_cable,a.tipo_conector
								   FROM infinitum_unica.zinter_gs a,infinitum_unica.zss_equipos b WHERE a.id_equipo=b.id AND a.folio='".$folio."' 
								   AND b.id_tecnologia!=0 AND a.gestionSincronia='0' ORDER BY a.id ASC");
				while($dat1=mysql_fetch_array($sql1)){
					$objPHPExcel->getActiveSheet()->setCellValue("A".$j,"$dat1[0]")->setCellValue("B".$j,"$dat1[1]")->setCellValue("C".$j,"$dat1[2]")->setCellValue("D".$j,"$dat1[3]")
												  ->setCellValue("E".$j,"$dat1[4]")->setCellValue("F".$j,"$dat1[5]")->setCellValue("G".$j,"$dat1[6]");
					$j++;
				}
				$j=$i-5+28;
				$sql1=mysql_query("SELECT b.nombre_equipo,a.ubicacion_RCDT,a.numero_switch,a.puerto,a.cat_cable,a.long_cable,a.tipo_conector
								   FROM infinitum_unica.zinter_gs a,infinitum_unica.zss_equipos b WHERE a.id_equipo=b.id AND a.folio='".$folio."' 
								   AND b.id_tecnologia!=0 AND a.gestionSincronia='1' ORDER BY a.id ASC");
				while($dat1=mysql_fetch_array($sql1)){
					$objPHPExcel->getActiveSheet()->setCellValue("A".$j,"$dat1[0]")->setCellValue("B".$j,"$dat1[1]")->setCellValue("C".$j,"$dat1[2]")->setCellValue("D".$j,"$dat1[3]")
												  ->setCellValue("E".$j,"$dat1[4]")->setCellValue("F".$j,"$dat1[5]")->setCellValue("G".$j,"$dat1[6]");
					$j++;
				}
				$j=$i-5+45;
				$objPHPExcel->getActiveSheet()->setCellValue("A".$j,"$dat[3]");
				$objPHPExcel->getActiveSheet()->getStyle("A".$j.":I".$j)->applyFromArray($styleArray1);  
			}
			if($validacion=="AYT"){
				//ALIMENTACION Y TIERRAS
				$objPHPExcel->setActiveSheetIndex($s);
				
				$sql=mysql_query("SELECT fz_tp_alimen,fz_configplanta,fz_longcabletierra,fz_comentarios,fz_escalerilla_bdtd,fz_cl_reqnucl 
								  FROM infinitum_unica.zsite_survey WHERE folio='$folio'");
				$dat=mysql_fetch_array($sql);
				$i=6;
				validation('A'.$i,'TIPO DE ALIMENTACION::','LISTAS!$X$2:$X$6','');
				validation('F'.$i,'TIPO DE TIERRA:','LISTAS!$Y$2:$Y$7','');
				validation('I'.$i,'REQUIERE CLIMA NUEVO:','LISTAS!$Z$2:$Z$5','');
				
				$objPHPExcel->getActiveSheet()->setCellValue("A".$i,"$dat[0]")->setCellValue("C".$i,"$dat[1]")->setCellValue("E".$i,"$dat[2]")
											  ->setCellValue("F".$i,"$dat[4]")->setCellValue("I".$i,"$dat[5]");

				$j=$i+5;
				$l=$i+37;
				$i=$i+5;
				$sql1=mysql_query("SELECT GROUP_CONCAT(DISTINCT b.nombre_equipo),GROUP_CONCAT(a.id ORDER BY a.trabajo_respaldo),
								   GROUP_CONCAT(a.trabajo_respaldo ORDER BY a.trabajo_respaldo),GROUP_CONCAT(a.ub_alimen ORDER BY a.trabajo_respaldo),
								   GROUP_CONCAT(a.nuevo_existente ORDER BY a.trabajo_respaldo),GROUP_CONCAT(a.pf_breaker ORDER BY a.trabajo_respaldo),
								   GROUP_CONCAT(a.cap_fusible ORDER BY a.trabajo_respaldo),GROUP_CONCAT(a.calibre ORDER BY a.trabajo_respaldo),
								   GROUP_CONCAT(a.l_cable ORDER BY a.trabajo_respaldo),GROUP_CONCAT(a.c_cable ORDER BY a.trabajo_respaldo),
								   GROUP_CONCAT(a.t_zapata ORDER BY a.trabajo_respaldo) FROM infinitum_unica.zinter_fz a,infinitum_unica.zss_equipos b 
								   WHERE b.id=a.id_equipo AND a.folio='".$folio."' AND b.id_tecnologia!=0 GROUP BY b.nombre_equipo ORDER BY b.nombre_equipo");
				while($dat1=mysql_fetch_array($sql1)){
					$objPHPExcel->getActiveSheet()->setCellValue("A".$i,"$dat1[0]");
					$num_id=explode(",",$dat1[1]);
					$dat_C=explode(",",$dat1[3]);
					$dat_D=explode(",",$dat1[4]);
					$dat_E=explode(",",$dat1[5]);
					$dat_F=explode(",",$dat1[6]);
					$dat_G=explode(",",$dat1[7]);
					$dat_H=explode(",",$dat1[8]);
					$dat_I=explode(",",$dat1[9]);
					$dat_J=explode(",",$dat1[10]);
					for($k=0;$k<count($num_id);$k++){
						$objPHPExcel->getActiveSheet()->setCellValue("C".$j,"$dat_C[$k]")->setCellValue("D".$j,"$dat_D[$k]")->setCellValue("E".$j,"$dat_E[$k]")
													  ->setCellValue("F".$j,"$dat_F[$k]")->setCellValue("G".$j,"$dat_G[$k]")->setCellValue("H".$j,"$dat_H[$k]")
													  ->setCellValue("I".$j,"$dat_I[$k]")->setCellValue("J".$j,"$dat_J[$k]");
						$j++;
					}
					$i=$i+2;
				}
				$objPHPExcel->getActiveSheet()->setCellValue("A".$l,"$dat[3]");
				$objPHPExcel->getActiveSheet()->getRowDimension($l)->setRowHeight(140);
				$objPHPExcel->getActiveSheet()->getStyle("A".$l.":J".$l)->applyFromArray($styleArray1);  
			}
		}
	}
}	

$kk=0;
for($s=0;$s<8;$s++){
	if(in_array($s,$tags)){		$active="";
	}else{
		if($kk==0)	array_push($array_borrar,$s);	else	array_push($array_borrar,$s-$kk);
		$kk++;
	}
}
 
$objPHPExcel->setActiveSheetIndex(0);
//PARA ELIMINAR HOJAS
for($i=0;$i<count($array_borrar);$i++){		$objPHPExcel->removeSheetByIndex($array_borrar[$i]); } 


$objWriter->save(str_replace('.php','.xlsx',__FILE__));  

// $objPHPExcel->getActiveSheet()->getProtection()->setPassword('PHPExcel');
// $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
// $objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
// $objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
// $objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);
// $objPHPExcel->getActiveSheet()->getStyle('B1')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

?>