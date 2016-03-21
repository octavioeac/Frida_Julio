<?php
//header("Content-Type: text/html;charset=utf-8");
include("functions/conexion.php");

$campo=isset($_GET['text'])?$_GET['text']:null;
$tipo=isset($_GET['ub_tipo'])?$_GET['ub_tipo']:null;

echo css();
echo ubicacion($tipo);
echo js($tipo,$campo);

function css(){
	$css='<style type="text/css">
		.Estilo1 {color: #000000}
		.Estilo42 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000066;}
		.Estilo48 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;}
		.Estilo49 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #000066; }
		.Estilo53 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #000000; }
		.Estilo57 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; font-weight: bold; color: #990000; }
		.Estilo70 {font-size: 12px; color: #000066; font-family: Verdana, Arial, Helvetica, sans-serif; background-color: #FFFFCC;font-weight: bold;}
		h1 {color: #FF9900;}
		h2 {color: #993300;font-size: 2px;font-style: normal;line-height: normal;}
		strong {color:#CC3300;}
		#tb {font-size: 11px;background-color: #CAE4FF;}
		#tb tr {text-align:left;border-color: #CAE4FF;}
		#tb th {text-align:center;}
		#tb td {border-collapse:collapse;text-align:center;}
		select {width:90px;}
		</style>';
	return $css;
}

function ubicacion($tipo){
	$html="";
	$html_combos='<td>'.piso().'</td>
        <td>'.sala().'</td>
        <td>'.grupo().'</td>
        <td>'.fila().'</td>';
	switch($tipo){
	case 'bastidor':
		$w=650;
		$cols=6;
		$titulo="Bastidor";
		$html_combos.='<td>'.lado().'</td><td>'.bastidor().'</td>';
		$html_aux01='<th rowspan="2">Lado</th><th rowspan="2">Bastidor</th>';
		$html_aux02='';
		$html_aux03='[Piso].[Sala][Grupo][Fila][Lado][Bastidor]';
	break;
	case 'glt':
		$w=600;
		$cols=5;
		$titulo="GLT";
		$html_combos.='<td>'.lado_glt().'</td>';
		$html_aux01='<th rowspan="2">Lado GLT</th>';
		$html_aux02='';
		$html_aux03='[Piso].[Sala][Grupo][Fila][Lado GLT]';
	break;
	case 'repisa':
		$w=825;
		$cols=8;
		$titulo="Repisa";
		$html_combos.='<td>'.lado().'</td><td>'.bastidor().'</td><td>'.repisa_y().'</td><td>'.repisa_x().'</td>';
		$html_aux01='<th rowspan="2">Lado</th><th rowspan="2">Bastidor</th><th colspan="2">Repisa</th>';
		$html_aux02='<th>Y</th><th>X</th>';
		$html_aux03='[Piso].[Sala][Grupo][Fila][Lado][Bastidor][Repisa Y][Repisa X]';
	break;
	case 'dfo':
		$w=825;
		$cols=8;
		$titulo="DFO";
		$html_combos.='<td>'.lado().'</td><td>'.bastidor().'</td><td>'.repisa_y().'</td><td>'.repisa_x().'</td>';
		$html_aux01='<th rowspan="2">Lado</th><th rowspan="2">Bastidor</th><th colspan="2">DFO</th>';
		$html_aux02='<th>Y</th><th>X</th>';
		$html_aux03='[Piso].[Sala][Grupo][Fila][Lado][Bastidor][DFO Y][DFO X]';
	break;
	default:
		$w=650;
		$cols=6;
		$titulo="Bastidor";
		$html_combos.='<td>'.lado().'</td><td>'.bastidor().'</td>';
		$html_aux01='<th rowspan="2">Lado</th><th rowspan="2">Bastidor</th>';
		$html_aux02='';
		$html_aux03='[Piso].[Sala][Grupo][Fila][Lado][Bastidor]';
	break;
	}
	$html.='<form><table width="'.$w.'" border="3" cellspacing="0" id="tb">';
	$html.= '<tr><td colspan="'.$cols.'" class="Estilo42"><strong>Informaci&oacute;n de Ubicaci&oacute;n de '.$titulo.'<strong></td></tr>';
	$html.= '<tr><th rowspan="2">Piso</th><th rowspan="2">Sala</th><th colspan="2">Fila</th>'.$html_aux01.'</tr>';
	$html.= '<tr><th>Grupo</th><th>Fila</th>'.$html_aux02.'</tr>';
	$html.= '<tr>'.$html_combos.'</tr>';
	$html.= '<tr><td colspan="'.$cols.'">&nbsp;</td></tr>';
	$html.= '<tr>';
	$html.= '<td class="Estilo42" colspan="'.$cols.'"><b>Formato:</b> '.$html_aux03.'&nbsp;';
	$html.= "<input type='text' readonly name='ubicacion' id='ubicacion' size='19' maxlength='19'>";
	$html.= "<input name='regresar' value='Enviar' type='button' onClick='valida();'>";
	$html.= '&nbsp;&nbsp;&nbsp;<input type="reset" value="Limpiar">';
	$html.= "</td>";
	$html.= "</tr></table></form>";
	return $html;
}

function js($t,$c){
$js_var="var piso = document.getElementById('piso').value;
	var sala = document.getElementById('sala').value;
	var grupo = document.getElementById('grupo').value;
	var fila = document.getElementById('fila').value;";
switch($t){
	case 'bastidor': 
		$js_aux01="var lado = document.getElementById('lado').value;
		var bastidor = document.getElementById('bastidor').value;";
		$js_aux02="+lado+bastidor;";
		$js_aux03="||lado==''||bastidor==''";
	break;
	case 'glt': 
		$js_aux01="var lado_glt = document.getElementById('lado_glt').value;";
		$js_aux02="+lado_glt;";
		$js_aux03="||lado_glt==''";
	break;
	case 'repisa'||'dfo': 
		$js_aux01="var lado = document.getElementById('lado').value;
		var bastidor = document.getElementById('bastidor').value;
		var repisa_y = document.getElementById('repisa_y').value;
		var repisa_x = document.getElementById('repisa_x').value;";
		$js_aux02="+lado+bastidor+repisa_y+repisa_x;";
		$js_aux03="||lado==''||bastidor==''||repisa_y==''||repisa_x==''";
	break;
	default: 
		$js_aux01="var lado = document.getElementById('lado').value;
		var bastidor = document.getElementById('bastidor').value;";
		$js_aux02="+lado+bastidor;";
		$js_aux03="||lado==''||bastidor==''";
	break;
}
$js="<script type=\"text/javascript\">
function concatena(){
	";
	$js.=$js_var.$js_aux01;
	$js.="var ubicacion=piso+\".\"+sala+grupo+fila".$js_aux02."
	document.getElementById('ubicacion').value=ubicacion;
}
function valida(){".$js_var.$js_aux01."
	if (piso==''||sala==''||grupo==''||fila==''$js_aux03){
		alert('Por favor, completa los campos');
	}
	else{
		opener.document.getElementById('".$c."').value=document.getElementById('ubicacion').value;
                var algo = opener.document.getElementById('".$c."');
                algo.className = algo.className + ' valid';
		cerrar();
	}
}

function cerrar(){
	var ventana= window.self;
		ventana.opener=window.self;
		ventana.close();
}

</script>";
return $js;
}

function select_nx2($arr,$ini,$extras){
	$n=count($arr); // $arr[$i]['valor'] ; $arr[$i]['descripcion'];
	$html='<select '.$extras.'>
	<option selected value="">---'.$ini.'---</option>';
	$sel='';
	for ($i=0;$i<$n;$i++){
		$html.= '<option '.$sel.' value="'.$arr[$i]['v'].'">'.$arr[$i]['v']." -> ".$arr[$i]['d'].'</option>';
	}
	$html.='</select>';
	return $html;
}

function select_nx1_num($a,$n,$ini,$extras){
	$html='<select '.$extras.'>
	<option selected value="">---'.$ini.'---</option>';
	$sel='';
	for	($i=$a; $i<=$n; $i++ ){
		$op=str_pad($i,strlen($n),"0",STR_PAD_LEFT);
		$html.='<option value="'.$op.'" '.$sel.'>'.$op.'</option>';
	} 
	$html.= '</select>';
	return $html;
}

function arreglo_nx2_mysql($res){
	$i=0;
	$a=array();
	while($x=mysql_fetch_array($res,MYSQL_NUM)){
		$a[$i]['v']=$x[0];
		$a[$i]['d']=$x[1];
		$i++;
	}
	return $a;
}

function piso(){
	// PISO
	$r=mysql_query("SELECT codigo,piso FROM `cat_pisos` ");
	//$n=mysql_num_rows($r);
	$a=arreglo_nx2_mysql($r);
	$html=select_nx2($a,'Piso','name="piso" id="piso" class="Estilo48" onchange="concatena();"');
	return $html;
}

function sala(){
	//SALA
	$r=mysql_query("SELECT codigo,tipo_sala FROM cat_salas order by aplica desc, sigla_sala asc ,num_sala asc");
	//$n=mysql_num_rows($r);
	$a=arreglo_nx2_mysql($r);
	$html=select_nx2($a,'Sala','name="sala" id="sala" class="Estilo48" onchange="concatena();"');
	return $html;
}

function grupo(){
	//GRUPO
	$html=select_nx1_num(1,9,'Grupo','name="grupo" id="grupo" class="Estilo48" onchange="concatena();"');
	return $html;
}

function fila(){
	//FILA
	$html=select_nx1_num(1,99,'Fila','name="fila" id="fila" class="Estilo48" onchange="concatena();"');
	return $html;
}

function bastidor(){
	// BASTIDOR
	$html=select_nx1_num(1,99,'Bastidor','name="bastidor" id="bastidor" class="Estilo48" onchange="concatena();"');
	return $html;
}

function lado(){
	$a=array();
	$a[0]=array('v'=>'A','d'=>'Lado A');
	$a[1]=array('v'=>'B','d'=>'Lado B');
	$html=select_nx2($a,'Lado','name="lado" id="lado" class="Estilo48" onchange="concatena();"');
	return $html;
}

function lado_glt(){
	$a=array();
	$a[0]=array('v'=>'I','d'=>'Izquierdo');
	$a[1]=array('v'=>'D','d'=>'Derecho');
	$html=select_nx2($a,'GLT','name="lado_glt" id="lado_glt" class="Estilo48" onchange="concatena();"');
	return $html;
}

function repisa_y(){
	// REPISA Y
	$html=select_nx1_num(1,99,'Y','name="repisa_y" id="repisa_y" class="Estilo48" onchange="concatena();"');
	return $html;
}

function repisa_x(){
	// REPISA X (MAGAZINE)
	$html=select_nx1_num(1,99,'X','name="repisa_x" id="repisa_x" class="Estilo48" onchange="concatena();"');
	return $html;
}

?>
