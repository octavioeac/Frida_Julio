<?php
//header("Content-Type: text/html;charset=utf-8");
//include ("perfiles.php");
include("conexion.php");
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /> <!-- compatibilidad ajax y jquery con explorer -->

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="combosPhp/Jcombo.js"></script>
<script type='text/javascript' src='./js/myscripts.js'></script>
<script type="text/javascript" src="js/datepickercontrol.js" ></script> <!-- calendario -->
<script type="text/javascript" src="./js/domtab.js"></script> <!-- pestañas -->
<script type="text/javascript" src="js/domtabResPes.js"></script> <!-- pestañas -->

<link href="css/styledem_dos.css" rel="stylesheet" type="text/css" media="screen" /> <!-- pestañas -->
<link href="./css/domtab2a.css" rel="stylesheet" type="text/css" /> <!-- pestañas -->
<link href="datepickercontrol.css" rel="stylesheet" type="text/css" /> <!-- calendario -->
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />

<!--- Funcion para fecha para dias habiles -->
<script>
function fechahabil()
	{
		hoy = new Date();
		i=0;
		while (i<3)
			{
				hoy.setTime(hoy.getTime()+24*60*60*1000);
				if (hoy.getDay() !=6 && hoy.getDay()!=0)
				i++;
			}
	
		mes = hoy.getMonth()+1; if (mes<10) mes = '0'+mes;
		dia = hoy.getDate(); 	if (dia<10) dia = '0'+dia;
		fecha = hoy.getFullYear()+ '-' + mes + '-' + dia;
		
		document.getElementById("fecha").value=fecha;
		return fecha;
	}
</script>
<!--- Funcion para abrir la ventana de la ubicacion -->
<script  language="javascript" type="text/javascript">
function popitup(url)
	{
		newwindow=window.open(url,'name','height=150,width=1100'); 
		if (window.focus) {newwindow.focus()}
		return false;
	}

function textCounter(field, countfield, maxlimit)
	{
		if (field.value.length > maxlimit) 		field.value = field.value.substring(0, maxlimit);
		else 		countfield.value = maxlimit - field.value.length;
	}
		

        

</script>

<style type="text/css"> 
<!--
	.tituloRojo1 {font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #F00; text-align:center;}
	#tbGeneral,#tbResp{width:900px; background-color:#CAE4FF; border:solid; table-layout:900px;border:#999999 solid 3px; color:#000066; text-align: left;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #000066;}
	.tbGeneralBl {width:900px; table-layout:900px;border:solid 3px; text-align: left;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;}
	#tbGeneral2 {width:900px; background-color:#eee; border:solid; table-layout:900px;border:#999999 solid 3px; color:#000066; text-align: left;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #000066;}

	.tituloRojo {font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #F00; text-align:center;}	
	.fibraOptica {background-color:#CAE4FF; border:solid; table-layout:900px;border:#999999 solid; color:#000066; text-align: left;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #000066;}
	.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #000066; text-align:left;}
	input[type='text']{font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #000066;}
	img[name='update'],img[name='delete'],.insert{cursor:pointer;}

	.Estilo1 {font-size:9px;} <!-- Input -->
	.Estilo2 {font-size:10px;} <!-- Textos -->
	.Estilo3 {font-size:8.5px;} <!-- Select -->
	.Estilo4 {color:#003399; font-weight:bold; font-size:11px; } <!-- Titulos -->
	.Estilo5 {color: #330099; font-weight: bold; }
	.Estilo41 {font-size: 10px; } <!-- Pestañas -->
	.Estilo10 {	font-size:12px;  color:#000066;  font-family:Verdana,Arial,Helvetica,sans-serif;  font-weight:bold;}
	.Estilo11 { font-family:Verdana,Arial,Helvetica,sans-serif;  font-size:10px;  font-weight:bold;  color: #009;}
	.Estilo12 { font-family:Verdana,Arial,Helvetica,sans-serif;  font-size:11px;  font-weight:bold;  color: #CC0000;}
	.Estilo13 { background-color:#EEEEEE; }
	
	.div_Content{ width:400px; height:500px; position:fixed; top:100%; left:65%; margin-left:-350px; margin-top:-350px; background:url() center no-repeat transparent; }
-->
</style>
</head>

<body onload="document.getElementById('cargando').style. display='none';" onfocus="getTab()">
<div class="div_Content" id="cargando" align="center"><img src="images/espere.gif" width="40" height="40" /><br />
<font size="3" color="#616161">CARGANDO....</font></div>
<!--<font size="3" color="#666666">CARGANDO....</font></div>-->

<div id="wrap"><div id="header"><h1><a href="grid_pro_fo_com.php">F  R  I  D  A</a></h1><h2>Proyecto de Fibra Optica</h2></div></div><br />
<div style='position:absolute;top:0;left:90%;font-size:9px;font-weight:bold;'>Usuario: <?PHP echo $sess_nmb; ?><br>DD: <?php echo $sess_dd; ?></div>

<form id='solicita' name='solicita' method='post' enctype='multipart/form-data' >
<input type="hidden" name="fecha" id="fecha" value="<?= $fecha ?>" /> <!-- Contador de Fecha -->
<input type="hidden" name="tabSpan" id="tabSpan" value="<?=$tabSpan?>" />	<!-- NECESARIA PARA PESTAÑAS -->
<?php //echo "<br>alerta"; ?><input type='hidden' name='alerta' id='alerta' value='<?=$alerta?>' />
<?php //echo "<br>modificacion"; ?><input type='hidden' name='modificacion' id='modificacion' value='<?=$modificacion?>' /> <!-- Query -->
<?php //echo "<br>var_archivo"; ?><input type='hidden' name='var_archivo' id='var_archivo' value='<?=$var_archivo?>' /> <!-- Cargar archivo -->
<?php //echo "<br>validacion"; ?><input type='hidden' name='validacion' id='validacion' value='<?=$validacion?>' /> <!-- Validacion de Campos -->
<?php //echo "<br>comprobar"; ?><input type='hidden' name='comprobar' id='comprobar' value='<?=$comprobar?>' /> <!-- Comprobar PEP Y PEDIDO 45 -->
<?php //echo "<br>mailcorreo"; ?><input type='hidden' name='mailcorreo' id='mailcorreo' value='<?=$mailcorreo?>' /> <!-- Bandera para correos -->
<?php //echo "<br>var_tisel"; ?><input type='hidden' name='var_tisel' id='var_tisel' value='<?=$var_tisel?>' /> <!-- Variable para tipo sel  -->

<center>
<?php
// VARIABLES IMPORTANTES
$spanTipoTras='FO';

// QUERY GENERAL -- _a
$mysql_a = "SELECT * FROM construccion_fo WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."' ";
$query_a = mysql_query($mysql_a);
$array_a = mysql_fetch_array($query_a,MYSQL_ASSOC);

// QUERY para guardar UIL -- _e
if ($array_a['ot_fo']=='' && mysql_num_rows($query_a)!='')
	{
		$query_e = mysql_query("SELECT cons_ot FROM construccion_fo ");
		for ($a=0; $a<mysql_num_rows($query_e); $a++){$var_2[]= mysql_result($query_e,$a,'cons_ot'); if(mysql_result($query_e,$a,'cons_ot')!=''){$var_vc=$var_vc+1;}}

		$var_1 = substr((date(Y)), '-2')."".date(m); // Obtencion de Año y mes

		if ($var_vc!='')
			{
				$var_3 =(max($var_2))+1; // El maximo archivo mas uno
				$var_4 = strlen($var_3); // Longitud de maximo
				$var_5 = str_repeat('0',(4-$var_4)); // Obtiene ceros restantes.
				$var_6 = $var_5."".$var_3; // Concatenar Valor de ultimos 4 digitos
				$var_7 = 'UIL-'.$var_1.'-'.$var_6;
			}
		else
			{ $var_6='0000'; $var_7= 'UIL-'.$var_1.'-'.$var_6;  }
		
		mysql_query("UPDATE construccion_fo SET ot_fo='".$var_7."', cons_ot='".$var_6."', cons_ot_mes='".$var_1."'  WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."'  ");
		echo "<script>document.solicita.submit();</script>";
	}

// COMPROBAR SI ESTAN DADOS DE ALTA en fibra_optica_ladaenlaces -- _b
$mysql_b = "SELECT * FROM fibra_optica_ladenlaces WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."'  ";
$query_b = mysql_query($mysql_b);
$num_b = mysql_num_rows($query_b);
$array_b = mysql_fetch_array($query_b,MYSQL_ASSOC);

// VISTA -- SERVICIO -- SL 
$querySL 	= "SELECT * FROM servicios_ladaenlaces_fo WHERE ref_sisa='".$_GET['ref_sisa_a']."'   ";
$resSL 		= mysql_query($querySL);
$rowSL 		= mysql_fetch_array($resSL);

$SL_ip_analisis = $rowSL['ip_analisis']; 					$SL_supervisor_analisis = $rowSL['supervisor_analisis'];
$SL_ip_ingenieria = $rowSL['ip_ingenieria']; 				$SL_supervisor_ingenieria=$rowSL['supervisor_ingenieria'];

if ($_REQUEST['envia_punta']=='A') {
		$SL_ip_eq_acc = $rowSL['ip_eq_acc']; 				$SL_supervisor_eq_acc = $rowSL['supervisor_eq_acc'];
		$SL_ip_fibra_optica = $rowSL['ip_fibra_optica']; 	$SL_supervisor_fibra_optica = $rowSL['supervisor_fibra_optica'];
} else {
		$SL_ip_eq_acc = $rowSL['ip_eq_acc_b']; 				$SL_supervisor_eq_acc = $rowSL['supervisor_eq_acc_b'];
		$SL_ip_fibra_optica = $rowSL['ip_fibra_optica_b']; 	$SL_supervisor_fibra_optica = $rowSL['supervisor_fibra_optica_b'];
	}

// CONSULTA A TABLA QUE LE CORRESPONDE -- Tab
$queryTab 	= "SELECT * FROM ".$rowSL['tabla']." WHERE ref_sisa='".$_GET['ref_sisa_a']."'   ";
$resTab 	= mysql_query($queryTab);
$rowTab 	= mysql_fetch_array($resTab);

// CONSULTA Delegaciones -- _k
$mysql_k = "SELECT delegacion FROM cat_delegaciones ";
$query_k = mysql_query($mysql_k);

// CONSULTA Problematica -- _f
$mysql_f = "SELECT rubro_fo FROM cat_construccion_fo WHERE combo_fo='problematica' ";
$query_f = mysql_query($mysql_f);

// CONSULTA Supervisor Cons -- _d
$mysql_d = "SELECT nombre FROM cat_tecnicos WHERE area='RDA CARSO' && puesto='SUPERVISOR' ";
$query_d = mysql_query($mysql_d);

// CONSULTA Paquete -- _i
$mysql_i = "SELECT paquete FROM cat_materiales WHERE tipo_equipo='FO' GROUP BY paquete";
$query_i = mysql_query($mysql_i);

?>


<!------------------------------------------------------------------------------------------------------------------>
<!-- INICIO -- TABLA 1 -->
<table width="900" height="71" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#E8E8E8">
	<tr>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Referencia:</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type="text" name="ref_sisa" size="30" value="<?=$_REQUEST['ref_sisa_a']?>" readonly='readonly' /></td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Punta:</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type="text" name="punta" size="1" value="<?=$_REQUEST['envia_punta']?>" readonly='readonly' /></td>
	</tr>
	
	<tr>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">&nbsp;</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">&nbsp;</td>
		<td bordercolor="#E8E8E8" align="left">Perfil:</td><td bordercolor="#E8E8E8" align="left"><input name="text" type='text' value="<?=$rowSL['perfil']?>" readonly="readonly" /></td>
	</tr>
	
	
	<tr>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Nodo de Acceso:</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input class="Estilo1" name="nodo_acc" type="text" id="nodo_acc" value="<?php if($_REQUEST['envia_punta']=='A') echo $rowSL['central']; elseif($_REQUEST['envia_punta']=='B') echo $rowSL['central_b']; ?>" /></td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Domicilio:</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input class="Estilo1" name="domicilio" type="text" id="domicilio" value="<?php if($_REQUEST['envia_punta']=='A') echo $rowSL['domicilio_a']; elseif($_REQUEST['envia_punta']=='B') echo $rowSL['domicilio_b']; ?>" /></td>
	</tr>
	
	<tr>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Cliente Sisa:</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type="text" name="clienteSisa" size="30" value="<?=$rowSL['cliente_sisa']?>" readonly='readonly' /></td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Cliente Comun:</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type="text" name="clienteComun" size="30" value="<?=$rowSL['cliente_comun']?>" readonly='readonly' /></td>        
	</tr>
	
	<tr>
		<td bordercolor="#E8E8E8" align="left">Folio SISA:</td><td bordercolor="#E8E8E8" align="left"><input type='text' name="folSer" value="<?=$rowSL['folio_sisa']?>" readonly="readonly"></td>
		<td bordercolor="#E8E8E8" align="left">Estado Sisa:</td><td bordercolor="#E8E8E8" align="left"><input name="text2" type='text' value="<?=$rowSL['estado_sisa']?>" readonly="readonly" /></td>
	</tr>

	<tr>
	<td align="left" bordercolor="#E8E8E8">Fase Sisa:</td><td align="left" bordercolor="#E8E8E8"><input type="text" name="etapaSisa" size="15" value="<?=$rowSL['etapa_sisa']?>" readonly="readonly" /></td>
	<td bordercolor="#E8E8E8" align="left">Tipo de Proyecto:</td><td bordercolor="#E8E8E8" align="left"><input type='text' value="<?=$rowSL['tipo_movimiento']?>" readonly="readonly" /></td>
	</tr>
	<tr>
	<td bordercolor="#E8E8E8" align="left">Criticidad:</td><td bordercolor="#E8E8E8" align="left"><input type='text' value="<?=$rowSL['criticidad']?>" readonly="readonly" /></td>
	<td bordercolor="#E8E8E8" align="left">Alcance:</td><td bordercolor="#E8E8E8" align="left"><input type='text' value="<?=$rowSL['alcance']?>" readonly="readonly" /></td>
	</tr>
	<tr>
	<td bordercolor="#E8E8E8" align="left">Due Date:</td><td bordercolor="#E8E8E8" align="left"><input name="text3" type='text' value="<?=$rowSL['fecha_dd']?>" readonly="readonly" /></td>
	<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Fecha de solicitud:</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input class="Estilo1" name="fec_sol" type="text" id="fec_sol" value="<?php if($_REQUEST['envia_punta']=='A') echo $rowSL['fecha_sol_proyecto_fo']; elseif($_REQUEST['envia_punta']=='B') echo $rowSL['fecha_sol_proyecto_fo_b']; ?>" /></td>
	</tr>
</table>
<!-- FIN -- TABLA 1 -->
<!------------------------------------------------------------------------------------------------------------------>





<!-------------------------------- INICIO PESTANAS DEL PROGRAMA --------------------------------> 
<div class="domtab">
	<ul class="domtabs">
		<li><a href="#pes_fo" id="lnk_fo" class="Estilo41">FIBRA OPTICA</a></li>
		<li><a href="#pes_equipami" id="lnk_equipami" class="Estilo41">EQUIPAMIENTO</a></li>
		<li><a href="#pes_bitac" id="lnk_bitac" class="Estilo41">BITACORA</a></li>
		<li><a href="#pes_topo" id="lnk_topo" class="Estilo41">TOPOLOGICO</a></li>
</ul>
<!-------------------------------- FIN PESTANAS DEL PROGRAMA -----------------------------------> 



<!--------------------------------------------------------------------------------------------- INICIO PESTANAS 1 -------------------------------------------> 
<!-- INICIO -- TABLA  -->
<div><a name="pes_fo" id="pes_fo"></a>
<br />
<table width="110%" border="2" bordercolor='#666666' bgcolor='#CAE4FF' >
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////-- ancla_inf  -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////INICIO -- INFORMACION GENERAL  -->
	<tr><td bordercolor="#CAE4FF" class="Estilo2" align="left" colspan="6">
	<?php 
	// Arreglo de telefonos por Responsable
	$var_SL = array($SL_ip_analisis, $SL_supervisor_analisis, $SL_ip_ingenieria, $SL_supervisor_ingenieria, $SL_ip_eq_acc, $SL_supervisor_eq_acc, $SL_ip_fibra_optica, $SL_supervisor_fibra_optica ); // variables
	$var_SLtit = array('Resp IPE Analisis: ', 'Resp Super Analisis: ', 'Resp IPE Ingenieria: ', 'Resp Super Ingenieria: ', 'Resp IPE Equipamiento: ', 'Resp Super Equipamiento: ', 'Resp IPR FO: ', 'Resp Super FO: '  ); // variables
	echo "<table>";
	for($i=0; $i<count($var_SL); $i++)
		{
			$queryTE = "SELECT telefono, id_tecnico FROM cat_tecnicos WHERE nombre='".$var_SL[$i]."'  ";
			$resTE 		= mysql_query($queryTE);
			$rowTE 		= mysql_fetch_array($resTE);
			$TE_tele[$i]= $rowTE['telefono'];
			
			$a=$a+1; 
			if ($a==1){echo "<tr>";} // CONTADOR para iniciar tr
			if ($a==2){$a=0; echo "</tr>";} // CONTADOR para cortar tr
			
			echo "<td align='left' >".$var_SLtit[$i]."</td>";
			echo "<td align='left' ><input name='text5' type='text' id='text5' value='".$var_SL[$i]."' size='30' readonly='readonly' /></td>";
			echo "<td align='left' ><input type='text' name='textfield4' value='".$TE_tele[$i]."' size='15' readonly='readonly' /></td>";
			echo "<td align='left' >".$var_SLtit[$i+1]."</td>";
			echo "<td align='left' ><input name='text5' type='text' id='text5' value='".$var_SL[$i+1]."' size='30' readonly='readonly' /></td>";
			echo "<td align='left' ><input type='text' name='textfield4' value='".$TE_tele[$i+1]."' size='15' readonly='readonly' /></td>";
			
			$i= $i+1;
		}
	echo "</table>";
	?>
	</td></tr>

	<tr><td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo4" align="left" colspan='6'>&nbsp;</td></tr>
	<tr bgcolor="#999999"><td colspan="6" height="4"></td></tr>
	
	<tr><td colspan="6" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo4" align="left"><a name="ancla_inf"></a>Informaci&oacute;n General</td></tr>
	
	<tr>
		<td width="17%" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Factibilidad:</td>
		<td width="16%" align="left" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2"><input class="Estilo1" name="factibilidad" type="text" id="factibilidad" value="<?php  if($_REQUEST['factibilidad']!=''){echo $_REQUEST['factibilidad'];}else{echo $array_a['factibilidad'];}?>" /></td>
		<td bordercolor="#CAE4FF" class="Estilo2">&nbsp;</td>
		<td bordercolor="#CAE4FF" class="Estilo2">&nbsp;</td>
		<td bordercolor="#CAE4FF" class="Estilo2">&nbsp;</td>
		<td bordercolor="#CAE4FF" class="Estilo2">&nbsp;</td>
	</tr>
	
	
	<tr>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Programada:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" datepicker='true' readonly="readonly" name="fecha_programada" type="text" id="fecha_programada"  value="<?php if($_REQUEST['fecha_programada']!=''){echo $_REQUEST['fecha_programada'];}else{echo $array_a['fecha_programada'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Tramo Afe: </td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" datepicker='true' name="fecha_tramo_afe" type="text" id="fecha_tramo_afe" value="<?php if($_REQUEST['fecha_tramo_afe']!=''){echo $_REQUEST['fecha_tramo_afe'];}else{echo $array_a['fecha_tramo_afe'];}?>" /></td>
		<!--<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Due Date: </td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" datepicker='true' name="fecha_dd" type="text" id="fecha_dd" value="<?php //if($_REQUEST['fecha_dd']!=''){echo $_REQUEST['fecha_dd'];}else{echo $array_a['fecha_dd'];}?>" /></td>-->
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Asignacion:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" name="fecha_asignacion" type="text" id="fecha_asignacion" value="<?=$array_a['fecha_asignacion']?>" readonly="readonly" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Solicitud FO:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" name="fecha_solicitud_fo" type="text" id="fecha_solicitud_fo" value="<?=$array_a['fecha_solicitud_fo']?>" readonly="readonly" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2">&nbsp;</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2">&nbsp;</td>
	</tr>

	<tr>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Resp IPR:</td>
		<td align="left" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo3">
		<?PHP if ($_REQUEST['envia_punta']=='A') {$valor_ipr=$rowSL['ip_fibra_optica'];} else {$valor_ipr=$rowSL['ip_fibra_optica_b'];} ?>
		<input class="Estilo3" name="ipr_resp_fo" type="text" id="ipr_resp_fo" value="<? if ($array_a['ipr_resp_fo']==''){ echo $va_ipr_resp=$valor_ipr; }else {echo $va_ipr_resp=$array_a['ipr_resp_fo'];}?>" size="25" readonly="readonly" />		</td>
		<td align="left" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" >Resp SUCOPE:</td>
		<td align="left" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" >
			<?php	
			// Consulta de CAT_TECNICO
			$mysql_l = "SELECT sucope, email_sucope FROM cat_tecnicos WHERE area='RDA CONSTRUCCION FO' GROUP BY sucope "; $query_l = mysql_query($mysql_l); // General
			$mysql_h = "SELECT sucope FROM cat_tecnicos WHERE area='RDA CONSTRUCCION FO' AND nombre='".$va_ipr_resp."' LIMIT 1"; $query_h = mysql_query($mysql_h);//Particular
			?>
			<select class="Estilo3" name='sucope_fo' id='sucope_fo' >
				<?php if ($sucope_fo==''||$array_a['sucope_fo']==''){$s3='selected';}else {$s3='';}?><option value='' <?php echo $s3;?> >-- SUCOPE --</option>
				<?php
					for($j=0;$j<mysql_num_rows($query_l);$j++)
						{
							$suc_a=mysql_result($query_h,0,'sucope'); // Particular
							$suc_b=mysql_result($query_l,$j,'sucope'); // General
							$email_b=mysql_result($query_l,$j,'email_sucope'); // Email Sucope
	
							if (($suc_b==$suc_a && $sucope_fo=='') || ($array_a['sucope_fo']==$suc_b && $array_a['sucope_fo']!=''))
									{$s3='selected';  $sucope_fo=$suc_b;  $mail_sucope=$email_b;}
							elseif ($_REQUEST['sucope_fo']==$suc_b && $sucope_fo!='')
									{$s3='selected';  $sucope_fo=$suc_b;  $mail_sucope=$email_b;}
							else 	{$s3='';}
							echo "<option value='".$suc_b."' $s3 >".$suc_b."</option>";
						}
				?>
			</select>		</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Supervisor FO:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">
		<?PHP if ($_REQUEST['envia_punta']=='A') {$valor_supervisor=$rowSL['supervisor_fibra_optica'];} else {$valor_supervisor=$rowSL['supervisor_fibra_optica_b'];} ?>
		<input class="Estilo3" name="supervisor_fo" type="text" id="supervisor_fo" value="<? if ($array_a['supervisor_fo']==''){ echo $valor_supervisor; }else {echo $array_a['supervisor_fo'];}?>" size="25" readonly="readonly" />		</td>
	</tr>
<!-- ////////////////////////////////////////////////////////////////////////////////////////FIN -- INFORMACION GENERAL  -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->



<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////-- ancla_planif  -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////INICIO -- PLANIFICACION  -->
	<tr bgcolor="#999999"><td colspan="6" height="4"></td></tr>
	<tr><td colspan="6" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo4" align="left"><a name="ancla_planif"></a>Planificaci&oacute;n</td></tr>
	
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Requerimiento:</td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">
			<select class="Estilo1" name="tipo_req" id="tipo_req" onchange="combo_requerimiento();">
			<?php if (($array_a['tipo_req']==''&&$tipo_req=='')||($tipo_req=='')) {$sele2="selected";}else {$sele2="";} ?>
					<option <?php echo $sele2;?> value=''>-- Requerimiento --</option>
			<?php
				$a=array("AMPLIACION", "ANILLO", "CABLE NUEVO", "ANILLO NUEVO", "CABLE NUEVO/INTER BDFO MONOMODO", "CABLE NUEVO/INTER BDFO MULTIMODO",  "TIPO DIRECTO", "AMPLIACION DE FIBRAS", "INTER BDFO MONOMODO", "INTER BDFO MULTIMODO", "INFRAESTRUCTURA", "ASIGNACION DE FIBRAS", "PRUEBAS OPTICAS", "MOVIMIENTO DE CABLE", "CANALIZACION", "NO REQUIERE" );
				for($i=0;$i<count($a);$i++)
				{
					if (($array_a['tipo_req']==$a[$i]&&$tipo_req=='')||($tipo_req==$a[$i])) {$sele2="selected";}else {$sele2="";} 
						echo "<option $sele2 value='$a[$i]'>".$a[$i]."</option>";
				}
			?>
			</select>
		</td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Planificador:</td>
		<td bordercolor="#CAE4FF" align="left">
			<select class="Estilo1" name="planificador" id="planificador">
				<?PHP if (($array_a['planificador']==''&&$planificador=='')||($planificador=='')) {$sele2="selected";}else {$sele2="";} ?>
					<option <?PHP echo $sele2; ?> value=''>-- Planificador --</option>";
				<?php
				$a_planif=array("ADC", "CARSO", "NO REQUIERE" );
				for($i=0;$i<count($a_planif);$i++)
					{
						if (($array_a['planificador']==$a_planif[$i]&&$planificador=='')||($planificador==$a_planif[$i])) {$sele2="selected";}else {$sele2="";} 
						echo "<option $sele2 value='$a_planif[$i]'>".$a_planif[$i]."</option>";
					}
				?>
			</select>
		</td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Edo. Acometida:</td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">
			<select class="Estilo1" name="edo_acometida" id="edo_acometida">
				<?php if(($array_a['edo_acometida']==''&&$edo_acometida=='')||($edo_acometida=='')){$s='selected';}else {$s='';}?>
				<option value="" <?php echo $s;?>>-- Edo Acometida --</option>
				<?php if (($array_a['edo_acometida']=='No. REQ ADECUACION'&&$edo_acometida=='')||($edo_acometida=='No. REQ ADECUACION')){$s='selected';}else {$s='';}?>
				<option value="No. REQ ADECUACION" <?php echo $s;?>>No. REQ ADECUACION</option>
				<?php if(($array_a['edo_acometida']=='No. REQ PLANIFICACION'&&$edo_acometida=='')||($edo_acometida=='No. REQ PLANIFICACION')){$s='selected';}else {$s='';}?>
				<option value="No. REQ PLANIFICACION" <?php echo $s;?>>No. REQ PLANIFICACION</option>
				<?php if(($array_a['edo_acometida']=='OK'&&$edo_acometida=='')||($edo_acometida=='OK')){$s='selected';}else {$s='';}?>
				<option value="OK" <?php echo $s;?>>OK</option>
				<?php if(($array_a['edo_acometida']=='PENDIENTE'&&$edo_acometida=='')||($edo_acometida=='PENDIENTE')){$s='selected';}else {$s='';}?>
				<option value="PENDIENTE" <?php echo $s;?>>PENDIENTE</option>
				<?php if(($array_a['edo_acometida']=='PENDIENTE VISITA'&&$edo_acometida=='')||($edo_acometida=='PENDIENTE VISITA')){$s='selected';}else {$s='';}?>
				<option value="PENDIENTE VISITA" <?php echo $s;?>>PENDIENTE VISITA</option>
			</select>		</td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Delegacion:</td>
		<td bordercolor="#CAE4FF" align="left">
		<select class="Estilo3"  name='delegacion' id='delegacion'>
		<?php if ($delegacion==''||$array_a['delegacion']==''){$s1='selected';}else {$s1='';}?><option value='' <?php echo $s1;?> >-- Delegacion --</option>
		<?php for($j=0;$j<mysql_num_rows($query_k);$j++)
		{
		$var_deleg=strtoupper(mysql_result($query_k,$j,'delegacion'));
		if (($array_a['delegacion']==$var_deleg&&$delegacion=='')||($delegacion==$var_deleg)){$s1='selected';}else {$s1='';}
		echo "<option value='".$var_deleg."' $s1>".$var_deleg."</option>";
		}
		?>
		</select>		</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2">&nbsp;</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
		<td bordercolor="#CAE4FF" class="Estilo2">&nbsp;</td>
		<td bordercolor="#CAE4FF">&nbsp;</td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Sol. Planificaci&oacute;n:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left"><input class="Estilo1" datepicker='true' name="fecha_sol_planificacion" type="text" id="fecha_sol_planificacion" value="<?php if($_REQUEST['fecha_sol_planificacion']!=''){echo $_REQUEST['fecha_sol_planificacion'];}else{echo $array_a['fecha_sol_planificacion'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Rec Planificaci&oacute;n: </td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left"><input class="Estilo1" datepicker='true' name="fecha_rec_planificacion" type="text" id="fecha_rec_planificacion" value="<?php if($_REQUEST['fecha_rec_planificacion']!=''){echo $_REQUEST['fecha_rec_planificacion'];}else{echo $array_a['fecha_rec_planificacion'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Sol. Permiso SSP:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left"><input class="Estilo1" datepicker='true' name="fecha_sol_permisossp" type="text" id="fecha_sol_permisossp" value="<?php if($_REQUEST['fecha_sol_permisossp']!=''){echo $_REQUEST['fecha_sol_permisossp'];}else{echo $array_a['fecha_sol_permisossp'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Rec Permiso:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left"><input class="Estilo1" datepicker='true' name="fecha_rec_permiso" type="text" id="fecha_rec_permiso" value="<?php if($_REQUEST['fecha_rec_permiso']!=''){echo $_REQUEST['fecha_rec_permiso'];}else{echo $array_a['fecha_rec_permiso'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left" >Fecha Entrega esp FO:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left" class="Estilo2"><input class="Estilo1" datepicker='true' name="fecha_entrega_esp_fo" type="text" id="fecha_entrega_esp_fo" value="<?php if($_REQUEST['fecha_entrega_esp_fo']!=''){echo $_REQUEST['fecha_entrega_esp_fo'];}else{echo $array_a['fecha_entrega_esp_fo'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Adecuaciones Clientes: </td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left" class="Estilo2"><input class="Estilo1" datepicker='true' name="fecha_adecuaciones" type="text" id="fecha_adecuaciones" value="<?php if($_REQUEST['fecha_adecuaciones']!=''){echo $_REQUEST['fecha_adecuaciones'];}else{echo $array_a['fecha_adecuaciones'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
	</tr>
<!-- ////////////////////////////////////////////////////////////////////////////////////////FIN -- PLANIFICACION  -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////-- ancla_proy  -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////INICIO -- PROYECTOS  -->
	<tr bgcolor="#999999"><td colspan="6" height="4"></td></tr>
	<tr><td colspan="6" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo4" align="left"><a name="ancla_proy"></a>Proyectos</td></tr>
	
	<tr>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">PEP:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left">
		<!--<input class="Estilo1" name="pep_a" type="text" id="pep_a" value="<?php //if($_REQUEST['pep_a']!=''){echo $_REQUEST['pep_a'];}else{echo $array_a['pep'];}?>"  onchange="document.solicita.comprobar.value='PEP'; document.solicita.submit();" />-->
		<input class="Estilo1" name="pep_a" type="text" id="pep_a" value="<?php if($_REQUEST['pep_a']!=''){echo $_REQUEST['pep_a'];}else{echo $array_a['pep'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Pedido 45:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">
		<!--<input class="Estilo1" name="pedido45_a" type="text" id="pedido45_a" value="<?php //if($_REQUEST['pedido45_a']!=''){echo $_REQUEST['pedido45_a'];}else{echo $array_a['pedido45'];}?>" onchange="document.solicita.comprobar.value='PEDIDO45'; document.solicita.submit();" />-->
		<input class="Estilo1" name="pedido45_a" type="text" id="pedido45_a" value="<?php if($_REQUEST['pedido45_a']!=''){echo $_REQUEST['pedido45_a'];}else{echo $array_a['pedido45'];}?>"  />
		</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">FO Proyecto Es:</td>
		<td height="23" bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left"><input class="Estilo1" name="fo_proy_es" type="text" id="fo_proy_es" value="<?php if($_REQUEST['fo_proy_es']!=''){echo $_REQUEST['fo_proy_es'];}else{echo $array_a['fo_proy_es'];}?>" /></td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Elab OT:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left"><input class="Estilo1" datepicker='true' name="fecha_elab_ot" type="text" id="fecha_elab_ot" value="<?php if($_REQUEST['fecha_elab_ot']!=''){echo $_REQUEST['fecha_elab_ot'];}else{echo $array_a['fecha_elab_ot'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Entrega OT:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" name="fecha_ent_ot" type="text" id="fecha_ent_ot" value="<?php echo $array_a['fecha_ent_ot'];?>" readonly="readonly" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">&nbsp;</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
	</tr>

	<tr>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Recibe OT:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left"><input class="Estilo1" name="recibe_ot" type="text" id="recibe_ot" value="<?php if($_REQUEST['recibe_ot']!=''){echo $_REQUEST['recibe_ot'];}else{echo $array_a['recibe_ot'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Problematica en Sitio:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" name="dependencia_proyecto" type="text" id="dependencia_proyecto" value="<?php if($_REQUEST['dependencia_proyecto']!=''){echo $_REQUEST['dependencia_proyecto'];}else{echo $array_a['dependencia_proyecto'];}?>" />co</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Constructor:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left">
			<select class="Estilo1" name="constructor" id="constructor" >
				<?php if (($array_a['constructor']==''&&$constructor=='')||($constructor=='')){$s='selected';}else {$s='';}?>
				<option value="" <?php echo $s;?>>-- Constructor --</option>
				<?php if (($array_a['constructor']=='ADC'&&$constructor=='')||($constructor=='ADC')){$s='selected';}else {$s='';}?>
				<option value="ADC" <?php echo $s;?>>ADC</option>
				<?php if (($array_a['constructor']=='CARSO'&&$constructor=='')||($constructor=='CARSO')){$s='selected';}else {$s='';}?>
				<option value="CARSO" <?php echo $s;?>>CARSO</option>
			</select>		</td>
	</tr>

	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Fecha Ent 50:</td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" datepicker='true' name="fecha_ent_50" type="text" id="fecha_ent_50" value="<?php if($_REQUEST['fecha_ent_50']!=''){echo $_REQUEST['fecha_ent_50'];}else{echo $array_a['fecha_ent_50'];}?>" /></td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Fecha OT OK:</td>
		<td bordercolor="#CAE4FF" align="left"><input class="Estilo1" name="fecha_proyecto" type="text" id="fecha_proyecto" value="<?=$array_a['fecha_proyecto'];?>" readonly="readonly" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">&nbsp;</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
	</tr>
<!-- ////////////////////////////////////////////////////////////////////////////////////////FIN -- PROYECTOS  -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////-- ancla_cons  -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////INICIO -- CONSTRUCCION  -->
	<tr bgcolor="#999999"><td colspan="6" height="4"></td></tr>
	<tr><td colspan="6" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo4" align="left"><a name="ancla_cons"></a>Construcci&oacute;n</td></tr>
	
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">PES:</td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" name="pes" type="text" id="pes" value="<?php if($_REQUEST['pes']!=''){echo $_REQUEST['pes'];}else{echo $array_a['pes'];}?>" /></td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">NCO/ROF:</td>
		<td bordercolor="#CAE4FF" align="left"><input class="Estilo1" name="nco" type="text" id="nco" value="<?php if($_REQUEST['nco']!=''){echo $_REQUEST['nco'];}else{echo $array_a['nco'];}?>" /></td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Anillo:</td>
		<td bordercolor="#CAE4FF" align="left"><input class="Estilo1" name="anillo_rof" type="text" id="anillo_rof" value="<?php if($_REQUEST['anillo_rof']!=''){echo $_REQUEST['anillo_rof'];}else{echo $array_a['anillo_rof'];}?>" /></td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Longitud Trabajo:</td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" name="longitud_trab" type="text" id="longitud_trab" value="<?php if($_REQUEST['longitud_trab']!=''){echo $_REQUEST['longitud_trab'];}else{echo $array_a['longitud_trab'];}?>" /></td>
		<td height="24" bordercolor="#CAE4FF" class="Estilo2" align="left">Atenuacion Trabajo: </td>
		<td bordercolor="#CAE4FF" align="left"><input class="Estilo1" name="atenuacion_trab" type="text" id="atenuacion_trab" value="<?php if($_REQUEST['atenuacion_trab']!=''){echo $_REQUEST['atenuacion_trab'];}else{echo $array_a['atenuacion_trab'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Longitud Respaldo:</td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" name="longitud_resp" type="text" id="longitud_resp" value="<?php if($_REQUEST['longitud_resp']!=''){echo $_REQUEST['longitud_resp'];}else{echo $array_a['longitud_resp'];}?>" /></td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Atenuacion Respaldo: </td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" name="atenuacion_resp" type="text" id="atenuacion_resp" value="<?php if($_REQUEST['atenuacion_resp']!=''){echo $_REQUEST['atenuacion_resp'];}else{echo $array_a['atenuacion_resp'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
	</tr>
	
	<tr bgcolor="#999999"><td colspan="6"><a name="ancla_trayectoria"></a><?php include('inclu_trayectorias.php') ?></td></tr>

	<tr><td colspan="6" bordercolor="#CAE4FF" bgcolor="#CAE4FF"></td></tr>

	<tr>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">FO Construccion Estatus: </td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left">
	
         <?php
		 $query = "select * from cat_construccion_fo where combo_fo='estatus construccion'";
  echo "<select class='Estilo1' name='estatus_const_fo' id='estatus_const_fo'>";
       echo "<option value='0' selected>Seleccione</option>";
   	$result = mysql_query($query);
      while ($row=mysql_fetch_row($result)) 
      { 
       echo "<option id=".$row[0]." value=".$row[0].">".$row[2]."</option>\n"; 
       } 
echo "</select>"; 
		 
         ?>
    
       

        
        
        </td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Dependencias:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">
			<?php
		 $query = "select * from cat_construccion_fo where combo_fo='dependencia construccion'";
echo "<select class='Estilo3'  name='dependencia_construccion' id='dependencia_construccion'>";
       echo "<option value='0' selected>Seleccione</option>";
   	$result = mysql_query($query);
      while ($row=mysql_fetch_row($result)) 
      { 
       echo "<option id=".$row[0]." value=".$row[0].">".$row[2]."</option>\n"; 
       } 
echo "</select>"; 
		 
         ?>
            
    	 <script>
     	  $("#dependencia_construccion").attr("disabled",true);
       	  $("#dependencia_construccion option:eq(0)").attr("selected","selected");
	$("#estatus_const_fo").change(function(){
  var valor = $("#estatus_const_fo").val();
  if(valor==24 ){
    	  $("#dependencia_construccion").removeAttr("disabled");
   } else{
          $("#dependencia_construccion option:eq(0)").attr("selected","selected");
     	  $("#dependencia_construccion").attr("disabled",true);
  }
  		
		});


 </script>        
            	</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Supervisor Cons:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left">
			<select class="Estilo1"  name='supervisor_const' id='supervisor_const'>
				<?php if ($supervisor_const==''||$array_a['supervisor_const']==''){$s1='selected';}else {$s1='';}?>
				<option value='' <?php echo $s1;?> >-- Supervisor Cons --</option>
				<?php for($j=0;$j<mysql_num_rows($query_d);$j++)
				{
				$var_sup_const=mysql_result($query_d,$j,'nombre');
				if (($array_a['supervisor_const']==$var_sup_const&&$supervisor_const=='')||($supervisor_const==$var_sup_const)){$s1='selected';}else {$s1='';}
				echo "<option value='".$var_sup_const."' $s1>".$var_sup_const."</option>";
				}
				?>
			</select>		</td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Fecha Remate FO: </td>
		<td bordercolor="#CAE4FF" align="left"><input class="Estilo1" name="fecha_remate_fo" type="text" id="fecha_remate_fo" value="<?php echo $array_a['fecha_remate_fo'];?>" readonly="readonly" /></td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Fecha Entrega FO:</td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" datepicker='true' name="fecha_en_fo" type="text" id="fecha_en_fo" value="<?php if($_REQUEST['fecha_en_fo']!=''){echo $_REQUEST['fecha_en_fo'];}else{echo $array_a['fecha_en_fo'];}?>" /></td>
		<td bordercolor="#CAE4FF" class="Estilo2">&nbsp;</td>
		<td bordercolor="#CAE4FF" class="Estilo2">&nbsp;</td>
	</tr>

	<tr bgcolor="#999999"><td colspan="6" height="4"></td></tr>
	
	<tr><td colspan="6" bordercolor="#CAE4FF" bgcolor="#CAE4FF">
		<table width="100%">
			<tr><td bgcolor="#CAE4FF" align="center">
			<table width='80%' border="2" align='center' cellspacing='1' bordercolor='#666666' bgcolor='#FFFFFF'>
				<tr><td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><h5>Carga Archivo: </h5></td></tr>
				<tr>
					<td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><input type='hidden' name='MAX_FILE_SIZE' value='100000000' />
					<select class="Estilo1"  name="var_arch_a" id="var_arch_a" onchange="envia('ancla_cons');" >
					<?php if ($var_arch_a==''){$s='selected';}else {$s='';}?><option value="" <?php echo $s;?>>-- Tipo Archivo --</option>
					<?php if ($var_arch_a=='PROYECTO_FO'){$s='selected';}else {$s='';}?><option value="PROYECTO_FO" <?php echo $s;?>>PROYECTO FO</option>
					<?php if ($var_arch_a=='MEMTECNICA_FO'){$s='selected';}else {$s='';}?><option value="MEMTECNICA_FO" <?php echo $s;?>>MEMORIA TECNICA FO</option>
					<?php if ($var_arch_a=='OT_MISCELANEOS'){$s='selected';}else {$s='';}?><option value="OT_MISCELANEOS" <?php echo $s;?>>OT MISCELANEOS </option>
					<?php if ($var_arch_a=='TRAB_PELIGROSO'){$s='selected';}else {$s='';}?><option value="TRAB_PELIGROSO" <?php echo $s;?>>PERMISOS TRABAJO PELIGROSO</option>
					<?php if ($var_arch_a=='REPORTE_VISITA'){$s='selected';}else {$s='';}?><option value="REPORTE_VISITA" <?php echo $s;?>>REPORTE DE VISITA</option>
					<?php if ($var_arch_a=='OT_ANEXO'){$s='selected';}else {$s='';}?><option value="OT_ANEXO" <?php echo $s;?>>OT ANEXO</option>
					</select>
					<?php if ($var_arch_a!='') { ?>
					<input name='userfile' type='file' id='carga' onchange='LimitAttach(this,1)' />
					<input type='button' name='cargar' onclick="document.solicita.var_archivo.value='1'; envia('ancla_cons');" value='Enviar'>
					<?php } ?>
						<?php
						//Carga de Archivos
						if ($var_archivo=='1')
						{
						if ($var_arch_a=='') {echo "<script>alert('Tipo de Archivo vacio. Corrobore informacion'); document.solicita.var_archivo.value=''; envia('ancla_cons');</script>";}
						else
							{
								if ($var_arch_a=='OT_ANEXO') { $ruta = getcwd()."\\archivos\\OTs\\OT_fo"; }
								else 						 { $ruta = getcwd()."\\archivos\\Proyectos_fo"; }
						if($_FILES['userfile']['tmp_name']<>'')
						{
						if (is_uploaded_file($_FILES['userfile']['tmp_name']))
						{
						$noarch  = strtr($_FILES['userfile']['name'], "Ã¡Ã©Ã­Ã³ÃºÃ±", "aeioun");
						$noarch  = strtr($noarch, "áéíóúñÁÉÍÓÚÑ ", "aeiounAEIOUN-");
						$separa1 = explode(".",$noarch);
						$noarch  = trim($separa1[1]);

						$con_a =$_REQUEST['ref_sisa_a'].'_'.$var_arch_a.'_LADO'.$_REQUEST['envia_punta'];
						$con_nombre = $con_a.".".$noarch;
						$nombre_archivo="$ruta/$con_nombre";
						move_uploaded_file($_FILES['userfile']['tmp_name'],"$nombre_archivo");
						
						$mysql_arc_bit = "SELECT * FROM bitacora_archivos WHERE referencia='".$_REQUEST['ref_sisa_a']."' AND opcion='LADO".$_REQUEST['envia_punta']."' AND trafico='".$var_arch_a."'    ";
						$query_arc_bit = mysql_query($mysql_arc_bit);
						
						if (mysql_num_rows($query_arc_bit)=='')
						{
						$query_arch ="INSERT INTO bitacora_archivos (referencia, fecha, usuario, accion, trafico, opcion, nom_arch, observaciones ) VALUES('".$_REQUEST['ref_sisa_a']."', NOW(), '$sess_nmb', 'CARGA ARCHIVO', '".$var_arch_a."', 'LADO".$_REQUEST['envia_punta']."', '".$con_nombre."', CONCAT('|', NOW(),', USUARIO: $sess_usr',', CARGA DE ARCHIVO', observaciones )  )"; 
						mysql_query($query_arch);
						echo "<script>alert('Archivo ".$con_nombre." dado de alta correctamente.'); document.solicita.var_archivo.value='';  document.solicita.var_arch_a.value=''; envia('ancla_cons'); </script>";
						}
						else
						{
						$query_arch_up ="UPDATE bitacora_archivos SET fecha=NOW(), usuario='$sess_nmb', accion='CARGA ARCHIVO', nom_arch='".$con_nombre."', observaciones=CONCAT('|', NOW(),', USUARIO: $sess_usr',', CARGA DE ARCHIVO', observaciones ) WHERE referencia='".$_REQUEST['ref_sisa_a']."' AND opcion='LADO".$_REQUEST['envia_punta']."' AND trafico='".$var_arch_a."'   "; 
						mysql_query($query_arch_up);
						echo "<script>alert('Archivo ".$con_nombre." dado de alta correctamente.'); document.solicita.var_archivo.value='';  document.solicita.var_arch_a.value=''; envia('ancla_cons'); </script>";													
						}
						}
						else	
						{	echo "Error al cargar el archivo: " . $_FILES['userfile']['name'];	}
						}
						}
						}
						?>					</td>
				</tr>
			</table>
			</td></tr>
			
			<tr><td bgcolor="#CAE4FF"></td></tr>
			
			<tr><td bgcolor="#CAE4FF" align="center">
			<table width='80%' border='2' align='center' cellspacing='1' bordercolor='#666666' bgcolor='#CAE4FF'>
				<tr bordercolor='#CAE4FF' bgcolor='#66CCFF'><td colspan="5" bordercolor='#FFFFFF' bgcolor='#72A6F3'><center><h4>Archivos Cargados</h4></center></td></tr>
				<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>
					<td height="19" bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>No.</h5></center></td>
					<td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>Archivo</h5></center></td>
					<td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>Fecha</h5></center></td>
					<td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>Tama&#328;o</h5></center></td>
					<td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>Borrar</h5></center></td>
				</tr>
				
				<?php 
				// Consulta de Archivos
				$ruta = getcwd()."\\archivos\\Proyectos_fo";
				$ruta_B = getcwd()."\\archivos\\OTs\\OT_fo";
				
				$nom_arch1 = $_REQUEST['ref_sisa_a']."_PROYECTO_FO_LADO".$_REQUEST['envia_punta'];
				$nom_arch2 = $_REQUEST['ref_sisa_a']."_MEMTECNICA_FO_LADO".$_REQUEST['envia_punta'];
				$nom_arch3 = $_REQUEST['ref_sisa_a']."_OT_MISCELANEOS_LADO".$_REQUEST['envia_punta'];
				$nom_arch4 = $_REQUEST['ref_sisa_a']."_TRAB_PELIGROSO_LADO".$_REQUEST['envia_punta'];
				$nom_arch5 = $_REQUEST['ref_sisa_a']."-OT-PROYECTOFO-LADO".$_REQUEST['envia_punta'];
				$nom_arch6 = $_REQUEST['ref_sisa_a']."_OT_ANEXO_LADO".$_REQUEST['envia_punta'];

				exec ("dir /B /O$dir1$orden \"$ruta\\".$nom_arch1."*\"",$archivos);
				exec ("dir /B /O$dir1$orden \"$ruta\\".$nom_arch2."*\"",$archivos);
				exec ("dir /B /O$dir1$orden \"$ruta\\".$nom_arch3."*\"",$archivos);
				exec ("dir /B /O$dir1$orden \"$ruta\\".$nom_arch4."*\"",$archivos);
				exec ("dir /B /O$dir1$orden \"$ruta_B\\".$nom_arch5."*\"",$archivos);
				exec ("dir /B /O$dir1$orden \"$ruta_B\\".$nom_arch6."*\"",$archivos);
				
				$arch=count($archivos);
				$colores=array("#ccdfe0","#bacadc");
				for ($ar=0;$ar<$arch;$ar++)
				{
				$arr=$ar+1;
				$color=$colores[$ar%2];
				
				$var_ex_nom3=explode('.',$archivos[$ar]);
				if($var_ex_nom3[0]==$nom_arch5 || $var_ex_nom3[0]==$nom_arch6)
					{ 
						$datf_B=stat("archivos/OTs/OT_fo/$archivos[$ar]");
						$var_link = "<a href='archivos/OTs/OT_fo/$archivos[$ar]'>$archivos[$ar]</a>"; 
						$var_date = date ("F d Y H:i:s",$datf_B[9]);
						$var_tam  = number_format($datf_B[7]);
					}
				else
					{ 
						$datf=stat("archivos/Proyectos_fo/$archivos[$ar]");
						$var_link = "<a href='archivos/Proyectos_fo/$archivos[$ar]'>$archivos[$ar]</a>"; 
						$var_date = date ("F d Y H:i:s",$datf[9]);
						$var_tam  = number_format($datf[7]);
					}
				
				echo "<tr bgcolor=$color>
				<td>$arr</td>
				<td>".$var_link."</td>
				<td>".$var_date."</td>
				<td style='text-align:right'>".$var_tam."</td>
				<td>";
				echo "<a onClick='respuesta=confirm(\"Esta seguro de eliminar el archivo: $archivos[$ar]\"); if(respuesta==true){ 
				document.solicita.borrar.value=\"1\"; document.solicita.archiv_os.value=\"$archivos[$ar]\"; document.solicita.submit();
				}' >Borrar</a>";
				echo "</td>
				</tr>";
				}
				?>
				<input type="hidden" name="borrar" value="<?=$borrar?>" />
				<input type="hidden" name="archiv_os" value="<?=$archiv_os?>" />
				<?php
				if ($_REQUEST['borrar']==1)
				{
				if(substr_count($_REQUEST['archiv_os'],'-OT-PROYECTOFO-LADO')=='1' || substr_count($_REQUEST['archiv_os'],'_OT_ANEXO_LADO') )	
				{
				$var_punta_a = 'LADO'.$array_a['punta'];
				$ruta_B = getcwd()."\\archivos\\OTs\\OT_fo";
				exec ("del \"$ruta_B\\".$_REQUEST['archiv_os']."\"");
				}
				else
				{
				$var_punta_a = $array_a['punta'];
				$ruta = getcwd()."\\archivos\\Proyectos_fo";
				exec ("del \"$ruta\\".$_REQUEST['archiv_os']."\"");
				}
				
				$query_arch_ba ="UPDATE bitacora_archivos SET fecha=NOW(), usuario='$sess_nmb', accion='ELIMINADO', nom_arch='', observaciones=CONCAT('|', NOW(),', USUARIO: $sess_usr',', ARCHIVO ELIMINADO', observaciones ) WHERE referencia='".$array_a['ref_sisa']."' AND opcion='".$var_punta_a."' AND nom_arch='".$_REQUEST['archiv_os']."'   "; 
				mysql_query($query_arch_ba);
				
				echo "<script>alert('Archivo dado de Baja: ".$_REQUEST['archiv_os']." satisfactorio. '); document.solicita.borrar.value=''; document.solicita.archiv_os.value='';  document.solicita.submit(); </script>";
				} 
				?>
			</table>
			</td></tr>
		</table>
	</td></tr>
<!-- ////////////////////////////////////////////////////////////////////////////////////////FIN -- CONSTRUCCION  -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////-- ancla_com  -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////INICIO -- COMENTARIOS  -->
	<tr bgcolor="#999999"><td colspan="6" height="4"></td></tr>
	<tr><td colspan="6" bordercolor="#CAE4FF" class="Estilo4" align="left"><a name="ancla_com"></a>Comentarios</td></tr>
	
	<tr><td colspan="6" bordercolor="#CAE4FF" align="center">
		<table width="43%">
			<tr>
			<td align="center" bordercolor="#CAE4FF" class="Estilo2">Observaciones</td>
			<td align="center" bordercolor="#CAE4FF" class="Estilo2">Bitacora</td>
			</tr>
			<tr>
			<td align="center" bordercolor="#CAE4FF"><textarea name="observaciones" cols="40" rows="5" id="observaciones"><?php if($_REQUEST['observaciones']!=''){echo $_REQUEST['observaciones'];}?></textarea></td>
			<td align="center" bordercolor="#CAE4FF">
			<textarea name="bitacora_observ" id="bitacora_observ" cols="40" rows="5" readonly="readonly"><?php
			$datos_obs=explode("|",$array_a['observaciones']);
			$ta_datos=sizeof($datos_obs);
			for ($tt=0;$tt<$ta_datos;$tt++){echo $datos_obs[$tt]."\n";}
			?></textarea></td> 
			</tr>
			<!-- ////////////////////////////////////////////////////////////////////////////////////////INICIO -- RECHAZOS  -->
			<tr>								 
				<td align='left' bordercolor='#CAE4FF' bgcolor="#CAE4FF" class='Estilo2'>Resultado del trabajo efectuado:</td>
				<td align='left' bordercolor='#CAE4FF' bgcolor="#CAE4FF" class='Estilo2' colspan="5">
					<select name='optec' onchange='document.solicita.submit()'>
						<option value=''></option>
						<?php 
						$a=array("LIQUIDADA", "EJECUTADA SIN EXITO");
						for($i=0;$i<count($a);$i++) {if($optec==$a[$i]){$sele2="selected";}else {$sele2="";} echo "<option $sele2 value='$a[$i]'>".$a[$i]."</option>";}
						?>
					</select>
				</td>
			</tr>	
		
			<?php 
			// HABILITAR BOTONES
			if ($optec=='EJECUTADA SIN EXITO' && $_REQUEST['regresa']!=''){$des="disabled";} else{$des="";}
			if ($optec=='LIQUIDADA'){$des1="disabled";} else{$des1="";}
			
			if ($optec=='EJECUTADA SIN EXITO') // SELECT 1
				{
					echo "<tr>
							<td align='right' bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo2'>Causa de Rechazo</td>
							<td align='left' bordercolor='#CAE4FF' bgcolor='#CAE4FF' colspan='5'>";
								$sql = mysql_query("SELECT causa FROM cat_causas WHERE tabla='ptoext_ce' ORDER BY causa");
								while($sql3=mysql_fetch_array($sql)) { $combo2.="<option value='".$sql3[0]."'>".$sql3[0]."</option>"; }
								$sql2=mysql_num_rows($sql);
								echo "<select multiple name='usuarios[]'><h2>'</h2>$combo2;</select>";
					  echo '</td>
						</tr>';
		
					echo "<tr>
							<td align='right' bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo2'>Regresar a :</td>
							<td align='left' bordercolor='#CAE4FF' bgcolor='#CAE4FF' colspan='5'>";
							echo "<select name='regresa' id='regresa' onchange='document.solicita.submit()' >";
							if ($_REQUEST['regresa']=='') 				{$sele4='selected';}else {$sele4='';} echo "<option $sele4 value=''>-- Etapa --</option>";
							if ($_REQUEST['regresa']=='MOD_ANALISIS') 	{$sele4='selected';}else {$sele4='';} echo "<option $sele4 value='MOD_ANALISIS'>ANALISIS DE PROYECTO</option>";
							if ($_REQUEST['regresa']=='MOD_INGENIERIA') {$sele4='selected';}else {$sele4='';} echo "<option $sele4 value='MOD_INGENIERIA'>DEFINICIO DE INGENIERIA</option>";
							echo "</select>";
					echo "</td>
						 </tr>";
				}
				//====FIN RECHAZOS===
			?>
		</table>
	</td></tr>
<!-- ////////////////////////////////////////////////////////////////////////////////////////FIN -- COMENTARIOS  -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////-- ancla_com  -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////INICIO -- BOTON  -->
	<tr><td colspan="6" bordercolor="#CAE4FF">&nbsp;</td></tr>
	<tr><td colspan="6" align="center" bordercolor="#CAE4FF">
			<input type='submit' name='B_mod' id='B_mod' value='Guardar' onclick='document.solicita.modificacion.value=1;' />
	<?php if ($optec=='EJECUTADA SIN EXITO' && $_REQUEST['regresa']!=''){ ?>
			<input type='submit' name='B_rec' id='B_rec' value='Rechazar' onclick='document.solicita.modificacion.value=5;' />
	<?php  } ?>
		<?php  if(trim($array_a['validacion_ot'])=='OK'&&$array_a['estatus_const_fo']!='LIQUIDADA'){ ?>
			&nbsp;&nbsp;<input type="submit" name="B_liqu" id="B_liqu" value="Liquidar" onclick='document.solicita.validacion.value=2;' />
		<?php  } ?>
	</td></tr>
<!-- ////////////////////////////////////////////////////////////////////////////////////////FIN -- BOTON  -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
</table>
<!-- FIN -- TABLA  -->





<!-- INICIO -- TABLA  -->
<br/>
<table width='990px' bordercolor='#666666' bgcolor='#CAE4FF' border="2" >		
	<tr><td colspan="4" bordercolor="#CAE4FF" class="Estilo4" align="left"><a name="ancla_inf_ot"></a>Informacion de OT</td></tr>
	<tr>
		<td bordercolor="#CAE4FF" align="left"></td>
		<td colspan="3" bordercolor="#CAE4FF" align="left"></td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Num OT: </td>
		<td colspan="3" bordercolor="#CAE4FF" align="left"><strong><? echo $array_a['ot_fo'];?></strong></td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Prioridad:</td>
		<td colspan="3" bordercolor="#CAE4FF" align="left">
			<select class="Estilo1"  name="prioridad" id="prioridad" >
			<?php if (($array_a['prioridad']==''&&$prioridad=='')||($prioridad=='')){$s='selected';}else {$s='';}?>
			<option value="" <?php echo $s;?>>-- Prioridad --</option>
			<?php if (($array_a['prioridad']=='NORMAL'&&$prioridad=='')||($prioridad=='NORMAL')){$s='selected';}else {$s='';}?>
			<option value="NORMAL" <?php echo $s;?>>NORMAL</option>
			<?php if (($array_a['prioridad']=='URGENTE'&&$prioridad=='')||($prioridad=='URGENTE')){$s='selected';}else {$s='';}?>
			<option value="URGENTE" <?php echo $s;?>>URGENTE</option>
			<?php if (($array_a['prioridad']=='PROGRAMA'&&$prioridad=='')||($prioridad=='PROGRAMA')){$s='selected';}else {$s='';}?>
			<option value="PROGRAMA" <?php echo $s;?>>PROGRAMA</option>
			</select>
		</td>
	</tr>
	<?PHP //ECHO $array_a['paquete_cons'];?>
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Paquete:</td>
		<td colspan="3" bordercolor="#CAE4FF" align="left">
			<select class="Estilo1"  name='paquete_cons' id='paquete_cons' onchange="envia('ancla_inf_ot');" >
			<?php if ($paquete_cons==''||$array_a['paquete_cons']==''){$s1='selected';}else {$s1='';}?>
			<option value='' <?php echo $s1;?> >-- Paquete --</option>
			<?php for($j=0;$j<mysql_num_rows($query_i);$j++)
			{
			$var_paquete=mysql_result($query_i,$j,'paquete');
			if (($array_a['paquete_cons']==$var_paquete&&$paquete_cons=='')||($paquete_cons==$var_paquete)){$s1='selected';}else {$s1='';}
			echo "<option value='".$var_paquete."' $s1>".$var_paquete."</option>";
			}
			?>
			</select>
		</td>
	</tr>
	
	<?php if($array_a['paquete_cons']!='' || $paquete_cons!='') {  ?>
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left"></td>
		<td colspan="3" bordercolor="#CAE4FF" align="left">
			<?php 
			if($array_a['paquete_cons']!='' && $paquete_cons==''){$cons_paquete = $array_a['paquete_cons']; } else {$cons_paquete = $paquete_cons; }
			$mysql_j = "SELECT paquete, cantidad, descripcion FROM cat_materiales WHERE tipo_equipo='FO' AND paquete='".$cons_paquete."' ORDER BY consecutivo ASC";
			$query_j = mysql_query($mysql_j);
			?>
			<table border="2" bordercolor="#666666">
				<tr>
					<td align="center" bordercolor="#999999" bgcolor="#00E6E6" class="Estilo2"><span class="Estilo5">&nbsp;No. PAQUETE&nbsp;</span></td>
					<td align="center" bordercolor="#999999" bgcolor="#00E6E6" class="Estilo2"><span class="Estilo5">&nbsp;CANTIDADES&nbsp;</span></td>
					<td align="center" bordercolor="#999999" bgcolor="#00E6E6" class="Estilo2"><span class="Estilo5">&nbsp;DESCRIPCION DE PAQUETE&nbsp;</span></td>
				</tr>
			
				<tr bgcolor="#FFFFFF">
					<td rowspan="<?php echo mysql_num_rows($query_j)+1;?>" bordercolor="#999999" class="Estilo2" align="center" ><strong><?php echo "Paquete ".$cons_paquete;  ?></strong></td>
				</tr>
				<?php
				for ($b=0; $b<mysql_num_rows($query_j); $b++)
				{ echo "<tr bgcolor='#FFFFFF'><td >&nbsp;&nbsp;&nbsp;".mysql_result($query_j,$b,'cantidad')."&nbsp;&nbsp;</td><td >&nbsp;&nbsp;&nbsp;".mysql_result($query_j,$b,'descripcion')."&nbsp;&nbsp;</td></tr>"; }
				?>
			</table>
		</td>
	</tr>
	<?php } ?>
	
	<tr>
		<td width="146" bordercolor="#CAE4FF" class="Estilo2" align="left">Nota: </td>
		<td colspan="3" bordercolor="#CAE4FF" align="left">
		<?php 
		if ($array_a['nota']=='' && $nota==''){$var_nota='PARA INICIAR LA CONST. DE PROYECTO, VERIFICAR QUE LAS FIBRAS ASIGNADAS CIERREN EN ANILLO Y CHECAR LA HERMETICIDAD DEL CIERRE ANTES Y DESPUES DE DERIVAR. LA ENTREGA DE LA MEMORIA TECNICA Y LAS UNIDADES DE CONSTRUCCION DEBEN ENTREGARSE ANTES DE CONCLUIR EL PROYECTO';}
		elseif ($array_a['nota']!='' && $nota==''){$var_nota=$array_a['nota'];}
		else {$var_nota=$nota;}
		?>
		<textarea name="nota" cols="80" rows="5" id="nota"><?=$var_nota?></textarea>
		</td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Observaciones: </td>
		<td colspan="3" bordercolor="#CAE4FF" align="left">
		<?php if ($array_a['observaciones_ot']!=''&&$observaciones_ot==''){$var_obser_ot=$array_a['observaciones_ot'];} else{$var_obser_ot=$observaciones_ot;}?>
		<textarea name="observaciones_ot" cols="80" rows="5" id="observaciones_ot"><?=$var_obser_ot?></textarea>
		</td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2"  align="left">Responsable Cliente:</td>
		<td width="" bordercolor="#CAE4FF"  align="left"><input class="Estilo1" name="responsable_cliente" type="text" id="responsable_cliente" value="<?php if($_REQUEST['responsable_cliente']!=''){echo $_REQUEST['responsable_cliente'];}else{echo $array_a['responsable_cliente'];}?>" /></td>
		<td width="" bordercolor="#CAE4FF" class="Estilo2"  align="left">Telefono:</td>
		<td width="" bordercolor="#CAE4FF"  align="left"><input class="Estilo1" name="telefono_cliente" type="text" id="telefono_cliente" value="<?php if($_REQUEST['telefono_cliente']!=''){echo $_REQUEST['telefono_cliente'];}else{echo $array_a['telefono_cliente'];}?>" /></td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" >&nbsp;</td>
		<td bordercolor="#CAE4FF" ></td>
		<td bordercolor="#CAE4FF" ></td>
		<td bordercolor="#CAE4FF" ></td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" >&nbsp;</td>
		<td colspan="3" bordercolor="#CAE4FF" align="center"><input type="submit" name="gen_ot" value="Generar OT" onclick="document.solicita.modificacion.value='1'; document.solicita.validacion.value='1a'; document.solicita.submit();" />
		<!--<input type="submit" name="gen_ot" value="Generar OT" onclick="document.solicita.modificacion.value='1'; document.solicita.submit();" />-->
		</td>
	</tr>

	<tr>
		<td bordercolor="#CAE4FF" >&nbsp;</td>
		<td bordercolor="#CAE4FF" ></td>
		<td bordercolor="#CAE4FF" ></td>
		<td bordercolor="#CAE4FF" ></td>
	</tr>
</table>
<!-- FIN -- TABLA 3 -->
<!------------------------------------------------------------------------------------------------------------------>
</div> <!-- FIN PESTAÑA UNO -->





<div><!-- INICIO PESTAÑA DOS -->
<a name="pes_equipami" id="pes_equipami"></a>
<table width="100%" border="2" bordercolor='#666666' bgcolor='#CAE4FF' >
	<tr><td bordercolor="#CAE4FF" class="Estilo2"><?php include ('inclu_liquida_ingenieria.php'); ?></td></tr>
</table>
</div> <!-- FIN PESTAÑA DOS -->





<div><!-- INICIO PESTAÑA TRES -->
<a name="pes_bitac" id="lnk_bitac"></a>
<table width="100%" border="2" bordercolor='#666666' bgcolor='#CAE4FF' >
	<tr>
		<?php // Corresponden al campo de la vista donde se muestra la informacion general del servicio
		echo "<td bordercolor='#CAE4FF' class='Estilo28' align='left' >";
			$datos_obs=explode("|",$rowSL['observaciones_servicio']);
			$ta_datos=sizeof($datos_obs);
			for ($tt=0; $tt<$ta_datos; $tt++) {  if(strlen($datos_obs[$tt]>3)){echo "<br> ".$datos_obs[$tt];echo "<hr />";}   }
		echo '</td>';
		?>
	</tr>
</table>
</div><!-- FIN PESTAÑA TRES -->





<div><!-- INICIO PESTAÑA CUATRO -->
<a name="pes_topo" id="pes_topo"></a>
<table width="100%" border="2" bordercolor='#666666' bgcolor='#CAE4FF' >
	<tr><td colspan="2" align="left" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo4">Topologico</td></tr>
	<tr><td bordercolor="#CAE4FF" class="Estilo2">
		<img src="wp/tester.php?r=<?php echo $_REQUEST['ref_sisa_a']; ?>&l=<?php echo $_REQUEST['envia_punta']; ?>&t=fo" width="900"/>
	</td></tr>
</table>
</div><!-- FIN PESTAÑA CUATRO -->






</div> <!-- FIN DE DIV DE PESTAÑAS -->

<?php
/*if($_REQUEST['validacion']=='1') // VALIDACION PARA OT
	{
		$faltan_datos="";

		if (trim($array_a['paquete_cons'])=='') 			$faltan_datos.="Debe indicar y guardar el PAQUETE CONS \\n";
		if (trim($array_a['nco'])=='') 						$faltan_datos.="Debe indicar y guardar el NCO/RFO \\n";
		if (trim($array_a['anillo_rof'])=='') 				$faltan_datos.="Debe indicar y guardar el ANILLO ROF \\n";
		if (trim($array_a['pes'])=='') 						$faltan_datos.="Debe indicar y guardar el PES \\n";
		if (trim($array_a['supervisor_const'])=='') 		$faltan_datos.="Debe indicar y guardar el SUPERVISOR CONS \\n";
		if (trim($array_a['estatus_const_fo'])=='') 		$faltan_datos.="Debe indicar y guardar el FO CONSTRUCCION ESTATUS \\n";
		if (trim($array_a['dependencia_construccion'])=='') $faltan_datos.="Debe indicar y guardar el PROBLEMATICA CONSTRUCCION \\n";
		if (trim($array_a['fecha_en_fo'])=='') 				$faltan_datos.="Debe indicar y guardar el FECHA ENTREGA FO \\n";
		if (trim($array_a['prioridad'])=='') 				$faltan_datos.="Debe indicar y guardar el PRIORIDAD \\n";
		if (trim($array_a['responsable_cliente'])=='') 		$faltan_datos.="Debe indicar y guardar el RESPONSABLE CLIENTE \\n";
		if (trim($array_a['telefono_cliente'])=='') 		$faltan_datos.="Debe indicar y guardar el TELEFONO CLIENTE\\n";
		if (trim($tray_vacio)!='') 							$faltan_datos.="Debe completar Trayectorias\\n";

		if ($faltan_datos<>"") echo "<script>alert('$faltan_datos'); document.solicita.validacion.value='';</script>"; 
		if ($faltan_datos=="") 
			{ 
				$error=""; 
				$sol_val_1A = "UPDATE construccion_fo SET fecha_proyecto=NOW() WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."'  "; 
				mysql_query($sol_val_1A); 

				echo "<script> window.open('ot_FibraOptica.php?refSisa=".$_REQUEST['ref_sisa_a']."&prioridad=".$array_a['prioridad']."&lado=".$_REQUEST['envia_punta']."&tipo_tray=".$array_a['tipo']."   '); document.solicita.alerta.value='3'; document.solicita.validacion.value=''; document.solicita.submit(); </script>"; 
			}
	}*/

//////OT SIN VALIDAR
if($_REQUEST['validacion']=='1')
{
		if ($faltan_datos=="") 
					{ 
						$error=""; 
						$sol_val_1A = "UPDATE construccion_fo SET fecha_proyecto=NOW() WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."'  "; 
						mysql_query($sol_val_1A); 
		
						echo "<script> window.open('ot_FibraOptica.php?refSisa=".$_REQUEST['ref_sisa_a']."&prioridad=".$array_a['prioridad']."&lado=".$_REQUEST['envia_punta']."&tipo_tray=".$array_a['tipo']."   '); document.solicita.alerta.value='3'; document.solicita.validacion.value=''; document.solicita.submit(); </script>"; 
					}
}

if($_REQUEST['validacion']=='2') // VALIDACION PARA LIQUIDAR
	{
		$faltan_datos="";
		if (trim($array_a['validacion_ot'])=='') 			$faltan_datos.="Debe indicar y guardar La OT \\n";
		if ($faltan_datos<>"") echo "<script>alert('$faltan_datos'); document.solicita.validacion.value='';</script>"; 
		if ($faltan_datos=="") 
			{ 
				$error=""; 
				echo "<script> document.solicita.mailcorreo.value='$mail_sucope'; document.solicita.modificacion.value='4'; document.solicita.validacion.value=''; document.solicita.submit(); </script>"; 
			}
	}

if($_REQUEST['comprobar']!='') // Comprobar PEP Y PEDIDO 45 
	{
		if ($_REQUEST['comprobar']=='PEP' )
			{
				// Query General
				$mysql_p = "SELECT pppep FROM siatel_str_ztmps08t003_peps WHERE pppep='".$pep_a."'  ";
				$query_p = mysql_query($mysql_p);
				$num_p = mysql_num_rows($query_p);
		
				if ($num_p>0)
				{echo "<script>alert('Numero de PEP Satisfactorio');  document.solicita.comprobar.value=''; document.solicita.submit();</script>";}
				else
				{echo "<script>alert('Numero de PEP no se encuentre registrado. Verifique informacion');  document.solicita.comprobar.value=''; document.solicita.submit();</script>";}
			}
		elseif ($_REQUEST['comprobar']=='PEDIDO45' )
			{
				// Query General
				$mysql_pd = "SELECT pdpe45 FROM siatel_str_ztmps08t003_pedido WHERE pdpe45='".$pedido45_a."'  ";
				$query_pd = mysql_query($mysql_pd);
				$num_pd = mysql_num_rows($query_pd);
		
				if ($num_pd>0)
				{echo "<script>alert('Numero de PEDIDO 45 Satisfactorio');  document.solicita.comprobar.value=''; document.solicita.submit();</script>";}
				else
				{echo "<script>alert('Numero de PEDIDO 45 no se encuentre registrado. Verifique informacion');  document.solicita.comprobar.value=''; document.solicita.submit();</script>";}
			}
		elseif ($_REQUEST['comprobar']=='PEDIDO45_TRAY' )
			{
				// Query General
				$mysql_pd = "SELECT pdpe45 FROM siatel_str_ztmps08t003_pedido WHERE pdpe45='".$$campo_tray."'  ";
				$query_pd = mysql_query($mysql_pd);
				$num_pd = mysql_num_rows($query_pd);
 
				if ($num_pd==0)
				{echo "<script> alert('Numero de PEDIDO 45 no se encuentre registrado. Verifique informacion'); document.solicita.".$campo_tray.".value=''; </script>";}
				echo "<script> document.solicita.comprobar.value='';  document.solicita.campo_tray.value='';  document.solicita.submit(); </script>";
			}
	}
	
if($_REQUEST['alerta']=='3') // Despues de Abrir OT 
	{ echo "<script>alert('OT creada Correctamente.'); document.solicita.alerta.value='';  document.solicita.submit(); </script>";} 

if($_REQUEST['alerta']=='4') // Alerta Asignacion de IPR
	{ echo "<script> var respuesta=confirm('Esta seguro que desea Asignar como IPR a: ".$ipr_resp_fo."  ?'); if(respuesta){ fechahabil();  document.solicita.modificacion.value='3'; document.solicita.alerta.value=''; document.solicita.submit();  } </script>";	} // Asignar IPR

if($_REQUEST['modificacion']=='1') // Guardar cambios Generales
	{
		if ($observaciones!='') {$valida_observa= ", observaciones=CONCAT('|', NOW(),', USUARIO: $sess_usr',', OBSERVACIONES: $observaciones',observaciones )";}
		$sol_mod_1="
			UPDATE construccion_fo SET
					
					tipo_req='".$tipo_req."', edo_acometida='".$edo_acometida."', 
					factibilidad='".$factibilidad."', fecha_programada='".$fecha_programada."', ipr_resp_fo='".$ipr_resp_fo."', 
					fecha_tramo_afe='".$fecha_tramo_afe."', sucope_fo='".$sucope_fo."', 
					fecha_dd='".$fecha_dd."', supervisor_fo='".$supervisor_fo."', 
					
					planificador='".$planificador."', delegacion='".$delegacion."', fecha_sol_planificacion='".$fecha_sol_planificacion."', 
					fecha_rec_planificacion='".$fecha_rec_planificacion."', fecha_sol_permisossp='".$fecha_sol_permisossp."', 
					fecha_rec_permiso='".$fecha_rec_permiso."', fecha_entrega_esp_fo='".$fecha_entrega_esp_fo."', fecha_adecuaciones='".$fecha_adecuaciones."',
					
					pep='".$pep."', fecha_elab_ot='".$fecha_elab_ot."', recibe_ot='".$recibe_ot."', fecha_ent_50='".$fecha_ent_50."', pedido45='".$pedido45."',
					dependencia_proyecto='".$dependencia_proyecto."', fo_proy_es='".$fo_proy_es."', constructor='".$constructor."', 

					tipo='".$tipo."',
					
					estatus_const_fo='".$estatus_const_fo."', dependencia_construccion='".$dependencia_construccion."', fecha_en_fo='".$fecha_en_fo."',
					supervisor_const='".$supervisor_const."', 
					
					prioridad='".$prioridad."', paquete_cons='".$paquete_cons."', nco='".$nco."', anillo_rof='".$anillo_rof."', longitud_trab='".$longitud_trab."', 
					longitud_resp='".$longitud_resp."', pes='".$pes."', atenuacion_resp='".$atenuacion_resp."', atenuacion_trab='".$atenuacion_trab."'
					
					".$valida_observa.",

					nota='".$nota."', observaciones_ot='".$observaciones_ot."', responsable_cliente='".$responsable_cliente."', telefono_cliente='".$telefono_cliente."'
			WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."'
			";
		mysql_query($sol_mod_1);
		
		if ($_REQUEST['validacion']=='1a'){echo "<script>document.solicita.modificacion.value=''; document.solicita.observaciones.value=''; document.solicita.validacion.value='1'; document.solicita.submit(); </script>";}
		else 							{echo "<script>alert('Modificaciones dadas de alta correctamente'); document.solicita.modificacion.value=''; document.solicita.observaciones.value=''; document.solicita.submit(); </script>";}
	}


if($_REQUEST['modificacion']=='3') // Guardar Asignacion de IPR
	{
		correo(); // Envia correo al IPR sobre Asignacion de IPR
		$sol_mod_3A= "UPDATE construccion_fo SET supervisor_fo='$supervisor_fo', ipr_resp_fo='$ipr_resp_fo', sucope_fo='$sucope_fo', fecha_asignacion=NOW(), fecha_ent_ot='$fecha' WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."'  ";
		mysql_query($sol_mod_3A);

		echo "<script>alert('Asignacion de IPR dada de Alta Correctamente'); document.solicita.mailcorreo.value=''; document.solicita.modificacion.value=''; document.solicita.submit(); </script>";
	}


if($_REQUEST['modificacion']=='4') // Guardar LIQUIDACION
	{
		//correo(); // Envia correo al SUCOPE sobre liquidacion
	
		if($_REQUEST['envia_punta']=='A') { $campos = "estatus_proyecto_fo='LIQUIDADA', fecha_atn_proyecto_fo=NOW()"; }
		elseif($_REQUEST['envia_punta']=='B') { $campos= "estatus_proyecto_fo_b='LIQUIDADA', fecha_atn_proyecto_fo_b=NOW()"; }
		
		$sol_mod_4= "UPDATE ".$rowSL['tabla']." SET $campos WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' ";
			mysql_query($sol_mod_4);
		$sol_mod_4A= "UPDATE construccion_fo SET estatus_const_fo='LIQUIDADA', fecha_remate_fo=NOW() WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."'  ";
			mysql_query($sol_mod_4A);

		echo "<script>alert('Liquidacion dada de alta correctamente'); document.solicita.mailcorreo.value=''; document.solicita.modificacion.value=''; document.solicita.submit(); </script>";
	}

?>

</center>
<?php
//====================RECHAZOS=============================
if($_REQUEST['modificacion']==5) // Guardar cambios Generales
	{ // observaciones_servicio_gral
		// CAUSAS DE RECHAZO
		$d=0;
		for($i=0;$i<$sql2;$i++){  if($usuarios[$i]==""){$d=$d+1;}if($usuarios[$i]<>""){$causas.= $usuarios[$i].', ';}  }
		$causas_ori=substr($causas,0,-1);
		$causas_ori=$causas_ori.'.';

		//ANALISIS
		if ($regresa=='MOD_ANALISIS')
			{
				$variable_rechazo_up="ch_proy='POR ELABORAR'";
				
				if($_REQUEST['envia_punta']=='A')$variable_rechazo_up.=",estatus_proyecto_fo='EJECUTADA SIN EXITO', estatus_regproy_acc='PROVIENE DE RECHAZO'";
				else $variable_rechazo_up.=$variable_rechazo_up.=",estatus_proyecto_fo_b='EJECUTADA SIN EXITO', estatus_regproy_acc_b='PROVIENE DE RECHAZO'";
				
				if($rowSL['estatus_ingenieria']=='LIQUIDADA') $variable_rechazo_up.=",estatus_ingenieria='PROVIENE DE RECHAZO'";
				elseif($rowSL['estatus_proyecto_fo']!='NO REQUERIDA' && $_REQUEST['envia_punta']=='A') $variable_rechazo_up.=",estatus_proyecto_fo='PROVIENE DE RECHAZO'";
				elseif($rowSL['estatus_proyecto_fo_b']!='NO REQUERIDA' && $_REQUEST['envia_punta']!='A') $variable_rechazo_up.=",estatus_proyecto_fo_b='PROVIENE DE RECHAZO'";
					
			}
		
		// INGENIERIA
		if ($regresa=='MOD_INGENIERIA')
			{
				$variable_rechazo_up="estatus_ingenieria='POR ELABORAR'";
				
				if($_REQUEST['envia_punta']=='A')$variable_rechazo_up.=",estatus_regproy_acc='EJECUTADA SIN EXITO'";
				else $variable_rechazo_up.=",estatus_regproy_acc_b='EJECUTADA SIN EXITO'";
				
				if($rowSL['estatus_proyecto_fo']!='NO REQUERIDA' && $_REQUEST['envia_punta']=='A')   $variable_rechazo_up.=",estatus_proyecto_fo='PROVIENE DE RECHAZO'";
				elseif($rowSL['estatus_proyecto_fo_b']!='NO REQUERIDA' && $_REQUEST['envia_punta']!='A') $variable_rechazo_up.=",estatus_proyecto_fo_b='PROVIENE DE RECHAZO'";
					
			}
			
			
		$sol_rec_anal_A = "UPDATE ".$rowSL['tabla']." SET observaciones_regproy_acc=CONCAT('|',NOW(),',USUARIO: $sess_nmb',', OBSERVACIONES:-EJECUTADA SIN EXITO EN ETAPA DE FIBRA OPTICA-Causa:',' $causas_ori', ' $observ',observaciones_regproy_acc), observaciones_servicio_gral=CONCAT('|',NOW(),',USUARIO: $sess_nmb',', OBSERVACIONES:-EJECUTADA SIN EXITO EN ETAPA DE FIBRA OPTICA-Causa:',' $causas_ori', ' $observ',observaciones_servicio_gral), ".$variable_rechazo_up."  WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' "; 
		mysql_query($sol_rec_anal_A);
	}
//=========================
?>

</form>
</body>
</html>
<!-- Extenciones de Carga de Archivos -->
<script>
function LimitAttach(tField,iType)
	{ 
		file=tField.value; 
		if (iType==1)
			{	
				extArray = new Array(".csv",".gif",".jpg",".png",".xls",".xlsx",".doc",".zip",".ppt",".pps",".txt"); 	} 
				allowSubmit = false; 
				if (!file) return; 
				while (file.indexOf("\\") != -1) file = file.slice(file.indexOf("\\") + 1); ext = file.slice(file.indexOf(".")).toLowerCase(); 
				for (var i = 0; i < extArray.length; i++) { if (extArray[i] == ext) { allowSubmit = true; break; }  }
				
				if (allowSubmit) {	document.getElementById('enviar').style.visibility="visible";	}
				else
					{ 
						alert("Usted sólo puede subir archivos con extensiones " + (extArray.join(" ")) + "\nPor favor seleccione un nuevo archivo"); 
						document.getElementById('enviar').style.visibility="hidden";
					}
			}  
function valida_sec()  { window.close(); opener.document.location.href=opener.document.location.href; } 
</script>

<!-- ANCLA -->
<script language="javascript">
function envia(direccion)
	{
		var d=direccion;
		var d1=document.solicita.action;
		document.solicita.action=d1+"#"+d;
		document.solicita.submit();
	}
</script>

<!-- FUNCION PARA ABRIR LA VENTANA DE LA UBICACION -->
<script  language="javascript" type="text/javascript">
function popitup(url)
	{
		newwindow=window.open(url,'name','height=150,width=1100'); 
		if (window.focus) {newwindow.focus()}
		return false;
	}

function textCounter(field, countfield, maxlimit)
	{
		if (field.value.length > maxlimit) 	field.value = field.value.substring(0, maxlimit);
		else countfield.value = maxlimit - field.value.length;
	}
</script>

<!-- ENVIAR CORREO -->
<?PHP 
function correo()
	{
		global $causa,$observ,$sess_nmb,$mailcorreo;
//		$tabla='cat_wdm';
//		$observ=$_POST['observ'];

			$to=array($_REQUEST['mailcorreo']);

//			$to=array("jsterrer@telmex.com","lena-90-15@hotmail.com");
//			$cc=array("jsterrer@telmex.com","lena-90-15@hotmail.com");
		
		include ("smtp.php"); 
		$html = "<HTML><HEAD></HEAD><BODY>";
		$html.="<h4>El usuario '$sess_nmb' rechazo la Validacion de Gestion del Puerto Extendido para la referencia: $nomof</h4>";
//		$html.="<h4>La causa del rechazo fue: $causa</h4>";
//		$html.= "<i>Observaciones: $observ</i>";
		$html.= "<br></BODY></HTML>";
		
		$subject	= "PRUEBA CORREO";
		include_once ('nomad_mimemail.inc.php');
		$mimemail = new nomad_mimemail();
		$mimemail->set_smtp_host($smtp_host);
		$mimemail->set_smtp_auth($smtp_user, $smtp_pass);
		
		$mimemail->set_to($to[0]);
		$mimemail->set_cc($cc[0]);
		for ($d=1;$d<count($cc);$d++) $mimemail->add_cc($cc[$d]);
		
		$mimemail->set_subject($subject);
		$mimemail->set_html($html);
		$mimemail->set_smtp_host($smtp_host);
		$mimemail->set_smtp_auth($smtp_user, $smtp_pass);
		if ($mimemail->send())	echo "Se envío correo al responsable del proyecto.";
		else 			  		echo "ERROR:  Mail No enviado";
	}
?>

<!-- INICIO PESTAÑAS -->
<script type="text/javascript">
	var onceTime=0;
	function getTab()
	{
		if(onceTime==0)
			{
				var arrLink=document.getElementsByTagName("a");	
				var idLink;

				for(a=0;a<arrLink.length;a++)
					{
						if(arrLink[a].href!='' && arrLink[a].href.match(/#(\w.+)/)!=null )
							{
								arrHref=arrLink[a].href.match(/#(\w.+)/)[1];
								if(arrHref==document.solicita.tabSpan.value) { idLink=arrLink[a].id;  break; }
							}
					}
				if(idLink!=undefined) 	domtab.showTab( document.getElementById(idLink).click());
			}
		onceTime++;
	}
</script>
<!-- FIN PESTAÑAS -->

<!-- INICIO - EVITAR SUBMIT -->
<script type="text/javascript">
	function combo_requerimiento()
		{
			var tipo_req2 = document.getElementById('tipo_req').value;
			var planificador = document.getElementById('planificador').value;
			
			if (tipo_req2=='AMPLIACION'){document.getElementById('planificador').value='NO REQUIERE';} 
		}
</script>
<!-- FIN EVITAR SUBMIT -->>>