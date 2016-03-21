<?php

/* ---FUNCTION---------------------------------------------- */
function lista_archivos($nop)
{
	$ruta = getcwd() . "\\archivos\\-ce";
	$dir = opendir($ruta);
	$archivos = array();
	$arch_info = array();
	$arch_comp = array();
	
	while (($file = readdir($dir)) !== false){
		if ( strlen($file) >= 5 ){
			if ( substr($file,0,strlen($nop)) == $nop ){ array_push($archivos,$file); }
		}
	}
	
	closedir($dir);
	
	foreach ($archivos as $file){
		$info_file=stat("$ruta/$file");
		array_push($arch_info,$file,date ("d M Y  H:i:s",$info_file[9]),number_format($info_file[7]/1024));
		array_push($arch_comp,$arch_info);
		$arch_info = array();
	}
	
	$numf = 1;
	foreach ($arch_comp as $cluster){
		if ( $numf < 10 ){ $numfs = "0".$numf; }else{ $numfs = $numf; }
		if ( fmod($numf,2) == 1 ){ $bgcol = "#CCDFE0"; }else{ $bgcol = "#BACADC"; }
		
		echo "<tr bordercolor='#CAE4FF' bgcolor='".$bgcol."' class='Estilo2w'><td><a href='archivos/-ce/$cluster[0]'>".$numfs." - ".$cluster[0]."</a></td><td align='right'>".$cluster[1]."</td><td align='right'>".$cluster[2]."</td></tr>";
		$numf++;
	}
	
}	// FIN DE LA FUNCION lista_archivos()

?> 

<!-- -- NUEVA VENTANA-------------------------- -->
<script type="text/javascript">
	function abreVentana()
	{
		myWindow=window.open("","_blank","scrollbars=yes, location=yes, resizable=yes, width=820, height=500");
		
		myWindow.document.write("<title>Archivos Anexos al Cluster - <?php echo $nombre_oficial_pisa; ?></title>");
		myWindow.document.write("<link href='style.css' rel='stylesheet' type='text/css' media='screen' />");
		
		myWindow.document.write("<style type='text/css'>");
			myWindow.document.write(".Estilo1w {font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif; color: #000066; font-weight: bold; }");
			myWindow.document.write(".Estilo2w {font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif; color: #000066; }");
		myWindow.document.write("</style>");
		
		myWindow.document.write("<div id='wrap'>");
			myWindow.document.write("<div id='header'>");
				myWindow.document.write("<div id='logo'>");
					myWindow.document.write("<h1><a href='#'>F R I D A</a></h1>");
					myWindow.document.write("<h2>Archivos Anexos al Cluster - <?php echo $nombre_oficial_pisa; ?></h2>");
					myWindow.document.write("<p>&nbsp;</p>");
					myWindow.document.write("<p>&nbsp;</p>");
				myWindow.document.write("</div>");
			myWindow.document.write("<div id='rss'></div>");
		myWindow.document.write("</div>");
		
		myWindow.document.write("<table align='center' width='750' border='2' cellspacing='1' bordercolor='#999999' bgcolor='#CAE4FF'>");
		
			myWindow.document.write("<tr colspan='3' bordercolor='#CAE4FF' class='Estilo1w'><td>&nbsp;</td></tr>");
			myWindow.document.write("<tr bordercolor='#CAE4FF' class='Estilo1w'><td align='center'>Nombre del Archivo</td><td align='center'>Fecha</td><td align='center'>Tama&ntilde;o (kb)</td></tr>");
			myWindow.document.write("<tr colspan='3' bordercolor='#CAE4FF' class='Estilo1w'><td>&nbsp;</td></tr>");
		
			myWindow.document.write("<?php lista_archivos($nombre_oficial_pisa); ?>");
			
		myWindow.document.write("</table>");
		
		myWindow.document.write("<br><p align='center'><input type='button' name='bot_canex' value='Cerrar Ventana' onclick='window.close();'></p>");
		
	}
	
</script>
