<?php
header("Content-Type: text/html;charset=utf-8");
include ("perfiles.php");
include ("conexion.php");
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /> <!-- compatibilidad ajax y jquery con explorer -->

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type='text/javascript' src='./js/myscripts.js'></script>
<script type="text/javascript" src="js/datepickercontrol.js" ></script> <!-- calendario -->
<script type="text/javascript" src="./js/domtab.js"></script> <!-- pestañas -->
<script type="text/javascript" src="js/domtabResPes.js"></script> <!-- pestañas -->

<link href="css/styledem.css" media="screen" type="text/css"  rel="stylesheet"/>
<link href="./css/domtab2a.css" rel="stylesheet" type="text/css"></link> <!-- pestañas -->
<link href="datepickercontrol.css" rel="stylesheet" type="text/css" /> <!-- calendario -->
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />


<!-- INICIO CHECKBOX mostrar-->
<script type="text/javascript">
function showMe (it, box)
	{
		var vis = (box.checked) ? "block" : "none";
		document.getElementById(it).style.display = vis;
	}
</script>
<!-- FIN CHECKBOX mostrar-->

<!-- INICIO RECUPERAR VALORES -->
<script>
	function cambiarvalor(dato)
		{
			document.forms[0].reg_estatus_const_fo.value=dato;
			return true;
		}
</script>
<!-- FIN RECUPERAR VALORES -->

<style type="text/css"> 
<!--
	<!-- equipamiento -->
	.tituloRojo1 {font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #F00; text-align:center;}
	#tbGeneral,#tbResp{width:900px; background-color:#CAE4FF; border:solid; table-layout:900px;border:#999999 solid 3px; color:#000066; text-align: left;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #000066;}
	.tbGeneralBl {width:900px; table-layout:900px;border:solid 3px; text-align: left;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;}
	#tbGeneral2 {width:900px; background-color:#eee; border:solid; table-layout:900px;border:#999999 solid 3px; color:#000066; text-align: left;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #000066;}

	<!-- pestañas -->
	.tituloRojo {font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #F00; text-align:center;}	
	.fibraOptica {background-color:#CAE4FF; border:solid; table-layout:900px;border:#999999 solid; color:#000066; text-align: left;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #000066;}
	.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #000066; text-align:left;}
	input[type='text']{font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #000066;}
	img[name='update'],img[name='delete'],.insert{cursor:pointer;}
	
	.Estilo4 {color:#003399; font-weight:bold; font-size:11px; } <!-- Titulos -->
	.Estilo1 {font-size:9px;} <!-- Input -->
	.Estilo2 {font-size:10px;} <!-- Textos -->
	.Estilo5 {color: #330099; font-weight: bold; }
	.Estilo41 {font-size: 10px; } <!-- Pestañas -->
	.Estilo10 {	font-size:12px;  color:#000066;  font-family:Verdana,Arial,Helvetica,sans-serif;  font-weight:bold;}
	.Estilo11 { font-family:Verdana,Arial,Helvetica,sans-serif;  font-size:10px;  font-weight:bold;  color: #009;}
	.Estilo12 { font-family:Verdana,Arial,Helvetica,sans-serif;  font-size:11px;  font-weight:bold;  color: #CC0000;}
	.Estilo13 { background-color:#EEEEEE; }
	.Estilo6 {font-size:15px; color:#333399; font-weight:bold;}
	.Estilo7 {font-size:11px; color:#000066;}

	<!-- cargador -->
	.div_Content{ width:400px; height:500px; position:fixed; top:100%; left:65%; margin-left:-350px; margin-top:-350px; background:url() center no-repeat transparent; }
-->
</style>
</head>
<body onload="document.getElementById('cargando').style. display='none';" onfocus="getTab()">
<div class="div_Content" id="cargando" align="center"><img src="images/espere.gif" width="40" height="40" /><br />
<font size="3" color="#616161">CARGANDO....</font></div>

<?php
// CONSULTA vista -- servicios_ladaenlaces_equ
$querySL 	= "SELECT * FROM servicios_ladaenlaces_equ WHERE ref_sisa='".$_GET['ref_sisa_a']."'   ";
$resSL 		= mysql_query($querySL);
$rowSL 		= mysql_fetch_array($resSL);
?>

<div id="wrap"><div id="header"><h1><a href="<?php if($rowSL['tabla']=='ciudad_segura') echo "grid_regproy_acc_com_cc.php"; else echo "grid_regproy_acc_com.php"; ?>">F  R  I  D  A</a></h1><h2>Proyecto de Equipamiento </h2></div></div>
<div style='position:absolute;top:0;left:90%;font-size:9px;font-weight:bold;'>Usuario: <?PHP echo $sess_nmb; ?><br>DD: <?php echo $sess_dd; ?></div>


<form name='solicita' method='post' enctype='multipart/form-data' >
<input type="hidden" name="tabSpan" id="tabSpan" value="<?=$tabSpan?>" />	<!-- NECESARIA PARA PESTAÑAS -->
<?php //echo "<br>band_ipr"; ?><input type='hidden' name='band_ipr' id='band_ipr' value='<?=$band_ipr?>' /> <!-- Bandera para IPR-->
<?php //echo "<br>modificacion"; ?><input type='hidden' name='modificacion' id='modificacion' value='<?=$modificacion?>' /> <!-- Query -->
<?php //echo "<br>validacion"; ?><input type='hidden' name='validacion' id='validacion' value='<?=$validacion?>' /> <!-- Query -->
<?php //echo "<br>var_archivo_co"; ?><input type='hidden' name='var_archivo_co' id='var_archivo_co' value='<?=$var_archivo_co?>' /> <!-- Carga archivos -->
<?php //echo "<br>var_archivo"; ?><input type='hidden' name='var_archivo' id='var_archivo' value='<?=$var_archivo?>' /> <!-- Cargar archivo ANEXOS -->


<center>
<?php
// VARIABLES IMPORTANTES
$spanTipoTras='FO';
$form_fecha = date("Y-m-d"); // FECHA ACTUAL

// CONSULTA vista -- servicios_ladaenlaces_equ
$querySL 	= "SELECT * FROM servicios_ladaenlaces_equ WHERE ref_sisa='".$_GET['ref_sisa_a']."'   ";
$resSL 		= mysql_query($querySL);
$rowSL 		= mysql_fetch_array($resSL);

$SL_ip_analisis = $rowSL['ip_analisis']; 					$SL_supervisor_analisis = $rowSL['supervisor_analisis'];
$SL_ip_ingenieria = $rowSL['ip_ingenieria']; 				$SL_supervisor_ingenieria=$rowSL['supervisor_ingenieria'];

if ($_REQUEST['envia_punta']=='A')
	{
		$SL_ip_eq_acc = $rowSL['ip_eq_acc']; 				$SL_supervisor_eq_acc = $rowSL['supervisor_eq_acc'];
		$SL_ip_fibra_optica = $rowSL['ip_fibra_optica']; 	$SL_supervisor_fibra_optica = $rowSL['supervisor_fibra_optica'];
		$la_area = $rowSL['area']; 							$la_central = $rowSL['central'];
	}
else
	{
		$SL_ip_eq_acc = $rowSL['ip_eq_acc_b']; 				$SL_supervisor_eq_acc = $rowSL['supervisor_eq_acc_b'];
		$SL_ip_fibra_optica = $rowSL['ip_fibra_optica_b']; 	$SL_supervisor_fibra_optica = $rowSL['supervisor_fibra_optica_b'];
		$la_area = $rowSL['area_b']; 						$la_central = $rowSL['central_b'];
	}
	
//ESTATUS DEL SERVICIO
$queryTab = "SELECT * FROM ".$rowSL['tabla']." WHERE ref_sisa='".$_GET['ref_sisa_a']."'   ";
$resTab 	= mysql_query($queryTab);
$rowTab 	= mysql_fetch_array($resTab);

// Variables del tipo de material dependiendo de la punta
if ($_REQUEST['envia_punta']=='A'){$tipo_material=$rowSL['material'];} 		else{$tipo_material=$rowSL['material_b'];}
// Condicion para mostrar pestañas y mandar variables topologico
if ($tipo_material=='FIBRA'){$pes_fibra='PES_FIBRA'; $material_topol='fo';} 	elseif ($tipo_material=='COBRE'){$pes_cobre='PES_COBRE'; $material_topol='cu';}

// Cuando ya esta liquidado 
if($rowSL['estatus_proyecto_fo']=='LIQUIDADA'){echo "<script>window.location.href='grid_regproy_acc_com.php';</script>";}

// CONSULTA -- construccion_fo
$mysql_a = "SELECT * FROM construccion_fo WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."' ";
$query_a = mysql_query($mysql_a);
$array_a = mysql_fetch_array($query_a,MYSQL_ASSOC);

// CONSULTA -- construccion_equipo
$mysql_d = "SELECT * FROM construccion_equipo WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."'   ";
$query_d = mysql_query($mysql_d);
$array_d = mysql_fetch_array($query_d,MYSQL_ASSOC);

// INSERT construccion_equipo NUEVO REGISTRO
if(mysql_num_rows($query_d)=='') 
	{
		$query_nuevo ="INSERT INTO construccion_equipo (ref_sisa, punta, area, central_acceso, tabla, cliente_sisa, cliente_comun, tipo_movimiento, etapa_sisa ) VALUES('".$_REQUEST['ref_sisa_a']."', '".$_REQUEST['envia_punta']."', '".$la_area."', '".$la_central."', '".$rowSL['tabla']."', '".$rowSL['cliente_sisa']."', '".$rowSL['cliente_comun']."', '".$rowSL['tipo_movimiento']."', '".$rowSL['etapa_sisa']."')"; 
		mysql_query($query_nuevo);
		echo "<script>document.solicita.submit();</script>";
	}

//////////////////////////////////////
// CONSULTA -- inventario_demarcadores
$GEN_conca_refe = $_GET['ref_sisa_a']."-".$_GET['envia_punta'];
$GEN_query_equA = "SELECT tipo_demarcador,clli_adva FROM inventario_demarcadores WHERE nomof LIKE '%".$GEN_conca_refe."%'  ";
$GEN_res_equA 	= mysql_query($GEN_query_equA);

for ($i=0; $i<mysql_num_rows($GEN_res_equA); $i++)
	{
		$GE_eq_tdemar = mysql_result($GEN_res_equA, $i, 'tipo_demarcador');
		$GE_eq_clli_adva = mysql_result($GEN_res_equA, $i, 'clli_adva');
		
		if ($GE_eq_tdemar=='NDE' || $GE_eq_tdemar=='NDE-N') {$GE_clli_ctrl=$GE_eq_clli_adva;}  // nde / nde-n = central -- tx
		if ($GE_eq_tdemar=='DDE' || $GE_eq_tdemar=='DDE-N') {$GE_clli_cte=$GE_eq_clli_adva;}  // dde / dde-n = cliente 
	}
	
// PUERTO CLIENTE
$GE_queryInPDe1 = "SELECT uso_puerto, puerto FROM inventario_puertos_demarcadores WHERE clli_adva='".$GE_clli_ctrl."' AND nombre_oficial_pisa='".$GE_clli_cte."'  ";
$GE_resInPDe1 	= mysql_query($GE_queryInPDe1);
for ($j=0; $j<mysql_num_rows($GE_resInPDe1); $j++)
	{
		$GE_uso_puerto_a = mysql_result($GE_resInPDe1,$j,'uso_puerto'); 		$GE_puerto_a = mysql_result($GE_resInPDe1,$j,'puerto');
		if ($GE_uso_puerto_a == 'CLIENTE' || $GE_uso_puerto_a == 'CLIENTE-PRIMARIO') 	{ $GE_puerto_tx=$GE_puerto_a;}
		elseif ($GE_uso_puerto_a == 'CLIENTE-SECUNDARIO') 								{ $GE_puerto_txsec=$GE_puerto_a;}
	}

// PUERTO TX
$GE_queryInPDe2 = "SELECT uso_puerto, puerto FROM inventario_puertos_demarcadores WHERE clli_adva='".$GE_clli_cte."' AND nombre_oficial_pisa='".$GE_clli_ctrl."' ";
$GE_resInPDe2 	= mysql_query($GE_queryInPDe2);
for ($j=0; $j<mysql_num_rows($GE_resInPDe2); $j++)
	{
		$GE_uso_puerto_b = mysql_result($GE_resInPDe2,$j,'uso_puerto'); 	$GE_puerto_b = mysql_result($GE_resInPDe2,$j,'puerto');
		if ($GE_uso_puerto_b == 'TX' || $GE_uso_puerto_b == 'TX-PRIMARIO') 	{$GE_puerto_cl=$GE_puerto_b;}
		elseif ($GE_uso_puerto_b == 'TX-SECUNDARIO') 						{$GE_puerto_clsec=$GE_puerto_b;}
	}

// Mostrar Boton de Inventario solo para equipamiento esta variable es para archivo inclu_liquida_ingenieria.php
$mostrar_boton1='OK';

?>


<!-- INICIO -- TABLA 1 -->
<br />
<table width="900" height="71" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#E8E8E8">
	<tr>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Referencia:</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type="text" name="ref_sisa" size="30" value="<?=$_REQUEST['ref_sisa_a']?>" readonly='readonly' /></td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Punta:</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type="text" name="punta" size="1" value="<?=$_REQUEST['envia_punta']?>" readonly='readonly' /></td>
	</tr>
	
	<tr>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Cliente Sisa:</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type="text" name="clienteSisa" size="30" value="<?=$rowSL['cliente_sisa']?>" readonly='readonly' /></td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Cliente Comun:</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type="text" name="clienteComun" size="30" value="<?=$rowSL['cliente_comun']?>" readonly='readonly' /></td>        
	</tr>

	<tr>
      <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Tipo Transporte: </td>
	  <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type="text" name="tip_tra" size="20" value="<?=$rowSL['tipo_transporte']?>" readonly='readonly' /></td>
	  <td bordercolor="#E8E8E8" align="left">Perfil:</td>
	  <td bordercolor="#E8E8E8" align="left"><input name="text" type='text' value="<?=$rowSL['perfil']?>" size="20" readonly="readonly" /></td>
	</tr>
	
	<tr>
		<td bordercolor="#E8E8E8" align="left">Folio SISA:</td><td bordercolor="#E8E8E8" align="left"><input name="folSer" type='text' value="<?=$rowSL['folio_sisa']?>" size="20" readonly="readonly"></td>
		<td bordercolor="#E8E8E8" align="left">Estado Sisa:</td><td bordercolor="#E8E8E8" align="left"><input name="text2" type='text' value="<?=$rowSL['estado_sisa']?>" size="20" readonly="readonly" /></td>
	</tr>

	<tr>
		<td align="left" bordercolor="#E8E8E8">Fase Sisa:</td><td align="left" bordercolor="#E8E8E8"><input type="text" name="etapaSisa" size="20" value="<?=$rowSL['etapa_sisa']?>" readonly="readonly" /></td>
		<td bordercolor="#E8E8E8" align="left">Tipo de Proyecto:</td><td bordercolor="#E8E8E8" align="left"><input type='text' value="<?=$rowSL['tipo_movimiento']?>" size="20" readonly="readonly" /></td>
	</tr>
	
	<tr>
		<td bordercolor="#E8E8E8" align="left">Criticidad:</td><td bordercolor="#E8E8E8" align="left"><input type='text' value="<?=$rowSL['criticidad']?>" size="20" readonly="readonly" /></td>
		<td bordercolor="#E8E8E8" align="left">Alcance:</td><td bordercolor="#E8E8E8" align="left"><input type='text' value="<?=$rowSL['alcance']?>" size="20" readonly="readonly" /></td>
	</tr>
	
	<tr>
		<td bordercolor="#E8E8E8" align="left">Due Date:</td><td bordercolor="#E8E8E8" align="left"><input name="text3" type='text' value="<?=$rowSL['fecha_dd']?>" size="20" readonly="readonly" /></td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">&nbsp;</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">&nbsp;</td>
	</tr>
</table>
<!-- FIN -- TABLA 1 -->





<!-------------------------------- INICIO PESTANAS DEL PROGRAMA --------------------------------> 
<div class="domtab">
	<ul class="domtabs">
		<li><a href="#pes_seg" id="lnk_seg" class="Estilo41">SEGUIMIENTO</a></li>
		<li><a href="#pes_tras" id="lnk_tras" class="Estilo41">TRASPASOS</a></li>
		<?PHP if ($pes_cobre=='PES_COBRE'){ ?><li><a href="#pes_cobre" id="lnk_cobre" class="Estilo41">COBRE</a></li><?PHP } ?>
		<?PHP if ($pes_fibra=='PES_FIBRA'){ ?><li><a href="#pes_fo" id="lnk_fo" class="Estilo41">FO</a></li><?PHP } ?>
		<li><a href="#pes_equipami" id="lnk_equipami" class="Estilo41">EQUIPAMIENTO</a></li>
		<li><a href="#pes_bitac" id="lnk_bitac" class="Estilo41">BITACORA</a></li>
		<li><a href="#pes_topo" id="lnk_topo" class="Estilo41">TOPOLOGICO</a></li>
	</ul>
<!-------------------------------- FIN PESTANAS DEL PROGRAMA --------------------------------> 





<div><?php //INICIO PESTAÑA 1 -- SEGUIMIENTO ?>
<a name="pes_seg" id="link_seg"></a>
<table width="100%" border="2" bordercolor='#666666' bgcolor='#CAE4FF' >
	<tr><td width="21%" bordercolor="#CAE4FF" class="Estilo2" align="left" colspan="6">
	<?php 
	// Arreglo de telefonos por Responsable
	$var_SL = array($SL_ip_analisis, $SL_supervisor_analisis, $SL_ip_ingenieria, $SL_supervisor_ingenieria, $SL_ip_eq_acc, $SL_supervisor_eq_acc, $SL_ip_fibra_optica, $SL_supervisor_fibra_optica ); // variables
	$var_SLtit = array('Resp IP Analisis: ', 'Resp Super Analisis: ', 'Resp IP Ingenieria: ', 'Resp Super Ingenieria: ', 'Resp IPR Equipamiento: ', 'Resp Super Equipamiento: ', 'Resp IP FO: ', 'Resp Super FO: '  ); // variables
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
			echo "<td align='left' ><input name='text5' type='text' id='text5' value='".$var_SL[$i]."' size='25' readonly='readonly' /></td>";
			echo "<td align='left' ><input type='text' name='textfield4' value='".$TE_tele[$i]."' size='15' readonly='readonly' /></td>";
			echo "<td align='left' >".$var_SLtit[$i+1]."</td>";
			echo "<td align='left' ><input name='text5' type='text' id='text5' value='".$var_SL[$i+1]."' size='25' readonly='readonly' /></td>";
			echo "<td align='left' ><input type='text' name='textfield4' value='".$TE_tele[$i+1]."' size='15' readonly='readonly' /></td>";
			
			$i= $i+1;
		}
	echo "</table>";
	?>
	</td></tr>

<?php if ($tipo_material=='COBRE' && $rowSL['tipo_transporte']=='CETH'){ // INICIO DE ANEXOS COBRE  ?>
	<tr><td bordercolor="#CAE4FF" class="Estilo2" align="left" colspan="6">&nbsp;</td></tr>
	<tr bgcolor="#999999"><td colspan="6" height="4"></td></tr>
	<tr><td bordercolor="#CAE4FF" class="Estilo2" align="left" colspan="6">
		<!-- INICIO CARGA DE ARCHIVO -->
		<table width="100%">
			<tr>
				<td bordercolor="#CAE4FF" class="Estilo2" align="left" colspan="2">
				<?php echo "<h3> REQUISITOS:</h3>\n <h5> 1) REMPLAZAR: Para reemplazar necesita generar nuevamente la OT.</h5>\n";?>
				</td>
			</tr>
			
			<tr>
			<td bordercolor="#CAE4FF" class="Estilo2" align="center"><input type='button' name='button' id='button' value='Generar OT' onclick="document.solicita.var_archivo_co.value='CARGA_ARCHIVO_OT'; <?php echo "window.open('otCobre/otcobrex.php?refsisa=".$_REQUEST['ref_sisa_a']."&lado=".$_REQUEST['envia_punta']."');";?> document.solicita.submit(); "></td>
			<td bgcolor="#CAE4FF" align="center">
			<table width='90%' border='2' align='center' cellspacing='1' bordercolor='#666666' bgcolor='#CAE4FF'>
				<tr bordercolor='#CAE4FF' bgcolor='#66CCFF'><td colspan="5" bordercolor='#FFFFFF' bgcolor='#72A6F3'><center><h4>Archivos Cargados</h4></center></td></tr>
			
				<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>
					<td height="19" bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>No.</h5></center></td>
					<td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>Archivo</h5></center></td>
					<td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>Fecha</h5></center></td>
					<td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>Tama&#328;o</h5></center></td>
				</tr>
				
				<?php
				// Consulta de Archivos
				$ruta_otcobre = getcwd()."\\archivos\\OTs\\OT_cobre";
				$nom_otcobre = $_REQUEST['ref_sisa_a']."-OT-COBRE-LADO".$_REQUEST['envia_punta'];
				exec ("dir /B /O$dir1$orden \"$ruta_otcobre\\".$nom_otcobre."*\"",$archivos_otcobre);
				$arch_otcobre=count($archivos_otcobre); 	$colores_ot_cobre=array("#ccdfe0","#bacadc");
				for ($ar=0;$ar<$arch_otcobre;$ar++)
					{
						$arr=$ar+1; 	$color=$colores_ot_cobre[$ar%2];
						$datf_otcobre=stat("archivos/OTs/OT_cobre/$archivos_otcobre[$ar]");
				
						echo "<tr bgcolor=$color>
								<td>$arr</td>
								<td>"."<a href='archivos/OTs/OT_cobre/$archivos_otcobre[$ar]' target='_blank'>$archivos_otcobre[$ar]</a>"."</td>
								<td>".date ("F d Y H:i:s",$datf_otcobre[9])."</td>
								<td style='text-align:right'>".number_format($datf_otcobre[7])."</td>
							  </tr>";
					}
				?>
			</table>
			</td>
		</tr></table>
		<!-- FIN CARGA DE ARCHIVO -->
	</td></tr>
<?php } // FIN DE ANEXOS COBRE  ?>

	<tr bgcolor="#999999"><td colspan="6" height="4"></td></tr>
	<tr><td bordercolor="#CAE4FF" class="Estilo2" align="left" colspan="6">&nbsp;</td></tr>
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2" align="right">Estatus Equipamiento: </td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left"><?php if ($array_d['estatus_ingenieria']!='TERMINADO'){ ?><input type="submit" name="B_liqu2" id="B_liqu2" value="Terminado" onclick="<?php echo "var respuesta=confirm('Esta seguro de Terminar Equipamiento'); if(respuesta){document.solicita.modificacion.value='4'; document.solicita.submit();}"; ?>" /><?PHP } else {echo "<input name='text5' type='text' id='text5' value='TERMINADO' size='25' readonly='readonly' />";} ?></td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left"></td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left"><?PHP if ($rowSL['tabla']!='ladaenlaces'){?><input type='button' <?php echo $des; ?> name='button' id='button' value='Liquidar' onclick="document.solicita.validacion.value='1'; document.solicita.submit()"><?php }?></td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="center"></td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left"></td>
	</tr>

<?php 
if( ($rowTab['estatus_regproy_acc']=='POR ELABORAR'&&$_REQUEST['envia_punta']=='A') || ($rowTab['estatus_regproy_acc_b']=='POR ELABORAR'&&$_REQUEST['envia_punta']=='B') ){ // INICIO ladaenlaces RECHAZO   ?>
	<tr>					 
		<td align='left' bordercolor='#CAE4FF' bgcolor="#CAE4FF" class='Estilo2'>Observaciones:</td>
		<td align='left' bordercolor='#CAE4FF' bgcolor="#CAE4FF" class='Estilo2' colspan="5"><textarea name='observ' rows='3' cols='60'><?=$observ?></textarea></td>			
	</tr>
	
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
					if($rowSL['estatus_asigna_lp']=='LIQUIDADA')
					{
						if ($_REQUEST['regresa']=='MOD_LP_A') {$sele4='selected';}else {$sele4='';} echo "<option $sele4 value='MOD_LP_A'>ASIGNACION LP (LADO A)</option>";
					}
					if($rowSL['estatus_asigna_lp_b']=='LIQUIDADA')
					{
						if ($_REQUEST['regresa']=='MOD_LP_B') {$sele4='selected';}else {$sele4='';} echo "<option $sele4 value='MOD_LP_B'>ASIGNACION LP (LADO B)</option>";
					}
					echo "</select>";
   			echo "</td>
				 </tr>";
		}
	?>
	<tr>
		<td  align='center' bordercolor='#CAE4FF' bgcolor="#CAE4FF" class='Estilo28' colspan="6">
		
			<table width='80%' border="2" align='center' cellspacing='1' bordercolor='#666666' bgcolor='#FFFFFF'>
				<tr><td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><h5>Carga Archivo: </h5></td></tr>
				<tr>
					<td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><input type='hidden' name='MAX_FILE_SIZE' value='100000000' />
					<select class="Estilo1"  name="var_arch_a" id="var_arch_a" onchange="envia('pes_seg');" >
					<?php if ($var_arch_a==''){$s='selected';}else {$s='';}?><option value="" <?php echo $s;?>>---</option>
					<?php if ($var_arch_a=='OT_ACC'){$s='selected';}else {$s='';}?><option value="OT_ACC" <?php echo $s;?>>OT ANEXO</option>
					</select>
					<?php if ($var_arch_a!='') { ?>
					<input name='userfile' type='file' id='carga' onchange='LimitAttach(this,1)' />
					<input type='button' name='cargar' onclick="document.solicita.var_archivo.value='1'; envia('pes_seg');" value='Enviar'>
					<?php } ?>
						<?php
						//Carga de Archivos
						if ($var_archivo=='1')
						{
						if ($var_arch_a=='') {echo "<script>alert('Tipo de Archivo vacio. Corrobore informacion'); document.solicita.var_archivo.value=''; envia('ancla_cons');</script>";}
						else
							{
								if ($var_arch_a=='OT_ACC') { $ruta = getcwd()."\\archivos\\ladaenlaces"; }
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
						echo "<script>alert('Archivo ".$con_nombre." dado de alta correctamente.'); document.solicita.var_archivo.value='';  document.solicita.var_arch_a.value=''; envia('pes_seg'); </script>";
						}
						else
						{
						$query_arch_up ="UPDATE bitacora_archivos SET fecha=NOW(), usuario='$sess_nmb', accion='CARGA ARCHIVO', nom_arch='".$con_nombre."', observaciones=CONCAT('|', NOW(),', USUARIO: $sess_usr',', CARGA DE ARCHIVO', observaciones ) WHERE referencia='".$_REQUEST['ref_sisa_a']."' AND opcion='LADO".$_REQUEST['envia_punta']."' AND trafico='".$var_arch_a."'   "; 
						mysql_query($query_arch_up);
						echo "<script>alert('Archivo ".$con_nombre." dado de alta correctamente.'); document.solicita.var_archivo.value='';  document.solicita.var_arch_a.value=''; envia('pes_seg'); </script>";													
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
		
		</td>
		
	<tr>
	<tr>
		<td  align='center' bordercolor='#CAE4FF' bgcolor="#CAE4FF" class='Estilo28' colspan="6">
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
				//$ruta = getcwd()."\\archivos\\Proyectos_fo";
				//$ruta_B = getcwd()."\\archivos\\OTs\\OT_fo";
				$ruta = getcwd()."\\archivos\\ladaenlaces";
				$ruta_B = getcwd()."\\archivos\\ladaenlaces";
				
				/*$nom_arch1 = $_REQUEST['ref_sisa_a']."_PROYECTO_FO_LADO".$_REQUEST['envia_punta'];
				$nom_arch2 = $_REQUEST['ref_sisa_a']."_MEMTECNICA_FO_LADO".$_REQUEST['envia_punta'];
				$nom_arch3 = $_REQUEST['ref_sisa_a']."_OT_MISCELANEOS_LADO".$_REQUEST['envia_punta'];
				$nom_arch4 = $_REQUEST['ref_sisa_a']."_TRAB_PELIGROSO_LADO".$_REQUEST['envia_punta'];
				$nom_arch5 = $_REQUEST['ref_sisa_a']."-OT-PROYECTOFO-LADO".$_REQUEST['envia_punta'];*/
				$nom_arch6 = $_REQUEST['ref_sisa_a']."_OT_ACC_LADO".$_REQUEST['envia_punta'];

				/*exec ("dir /B /O$dir1$orden \"$ruta\\".$nom_arch1."*\"",$archivos);
				exec ("dir /B /O$dir1$orden \"$ruta\\".$nom_arch2."*\"",$archivos);
				exec ("dir /B /O$dir1$orden \"$ruta\\".$nom_arch3."*\"",$archivos);
				exec ("dir /B /O$dir1$orden \"$ruta\\".$nom_arch4."*\"",$archivos);
				exec ("dir /B /O$dir1$orden \"$ruta_B\\".$nom_arch5."*\"",$archivos);*/
				exec ("dir /B /O$dir1$orden \"$ruta_B\\".$nom_arch6."*\"",$archivos);
				//echo "<br>$dir1$orden \"$ruta_B\\".$nom_arch6."*\"";
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
				if(substr_count($_REQUEST['archiv_os'],'-OT-PROYECTOFO-LADO')=='1' || substr_count($_REQUEST['archiv_os'],'_OT_ACC_LADO') )	
				{
				$var_punta_a = 'LADO'.$array_a['punta'];
				$ruta_B = getcwd()."\\archivos\\ladaenlaces";
				exec ("del \"$ruta_B\\".$_REQUEST['archiv_os']."\"");
				}
				else
				{
				$var_punta_a = $array_a['punta'];
				$ruta = getcwd()."\\archivos\\ladaenlaces";
				exec ("del \"$ruta\\".$_REQUEST['archiv_os']."\"");
				}
				
				$query_arch_ba ="UPDATE bitacora_archivos SET fecha=NOW(), usuario='$sess_nmb', accion='ELIMINADO', nom_arch='', observaciones=CONCAT('|', NOW(),', USUARIO: $sess_usr',', ARCHIVO ELIMINADO', observaciones ) WHERE referencia='".$array_a['ref_sisa']."' AND opcion='".$var_punta_a."' AND nom_arch='".$_REQUEST['archiv_os']."'   "; 
				mysql_query($query_arch_ba);
				
				echo "<script>alert('Archivo dado de Baja: ".$_REQUEST['archiv_os']." satisfactorio. '); document.solicita.borrar.value=''; document.solicita.archiv_os.value='';  document.solicita.submit(); </script>";
				} 
				?>
			</table>
		</td>
	</tr>
	<tr><!-- document.solicita.estado.value='$optec';  -->
		<td colspan="3" align='center' bordercolor='#CAE4FF' bgcolor="#CAE4FF" class='Estilo28'><input type='button' <?php //echo $des1; ?> name='button' id='button' value='Rechazar'  onclick="document.solicita.validacion.value='RECHAZO'; document.solicita.submit();"></td>
	<!--
		<td colspan="3" align='center' bordercolor='#CAE4FF' bgcolor="#CAE4FF" class='Estilo28'><input type='button' <?php //echo $des; ?> name='button' id='button' value='Liquidar' onclick="document.solicita.validacion.value='1'; document.solicita.submit()"></td>-->
	</tr>
<?PHP } // FIN ladaenlaces RECHAZO?>

</table>
</div><?php //FIN PESTAÑA 1 ?>





<div><?php //INICIO PESTAÑA 1 -- SEGUIMIENTO ?>
<a name="pes_tras" id="link_tras"></a>
<table width="100%" border="2" bordercolor='#666666' bgcolor='#CAE4FF' >
	<tr align="left" bordercolor="#000000"><td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left"><div align="left"><?php  include('inclu_traspasos.php')?></div></td></tr>
</table>
</div><?php //FIN PESTAÑA 1 ?>





<?PHP if ($pes_cobre=='PES_COBRE'){ ?>
<!-- INICIO -- COBRE -->
<div>
<a name="pes_cobre" id="lnk_cobre"></a>
<table width="100%" border="2" bordercolor='#666666' bgcolor='#CAE4FF' >
	<tr><td bordercolor="#CAE4FF" class="Estilo2"><?php // include ('inclu_liquida_lp.php'); ?>
		<?php $pestana_opciones_material='COBRE'; include ('inclu_pes_materiales.php'); ?>
	</td></tr>
</table>
</div>
<!-- FIN -- COBRE -->
<?PHP } ?>


<?PHP if ($pes_fibra=='PES_FIBRA'){ ?>
<!-- INICIO -- FO -->
<div>
<a name="pes_fo" id="lnk_fo"></a>
<table width="100%" border="2" bordercolor='#666666' bgcolor='#CAE4FF' >
	<tr><td bordercolor="#CAE4FF" class="Estilo2"><?php // include ('inclu_alta_construccion_fo.php'); ?>
		<?php $pestana_opciones_material='FIBRA OPTICA'; include ('inclu_pes_materiales.php'); ?>
	</td></tr>
</table>
</div>
<!-- FIN -- FO -->
<?PHP } ?>





<div><!-- INICIO PESTAÑA 5 -- EQUIPAMIENTO -->
<a name="pes_equipami" id="lnk_equipami"></a>
<table width="100%" border="2" bordercolor='#666666' bgcolor='#CAE4FF' >
	<tr><td bordercolor="#CAE4FF" class="Estilo2"><?php if($rowSL['tabla']=='ciudad_segura') include ('inclu_liquida_ingenieria_cc.php'); else include ('inclu_liquida_ingenieria.php'); ?></td></tr>
</table>
</div> <!-- FIN PESTAÑA 5 -->




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





<div><!-- INICIO PESTAÑA 6 -- TOPOLOGICO -->
<a name="pes_topo" id="lnk_topo"></a>
<table width="100%" border="2" bordercolor='#666666' bgcolor='#CAE4FF' >
	<tr><td colspan="2" align="left" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo4">Topologico</td></tr>
	<tr><td colspan="2" align="left" bordercolor="#CAE4FF" bgcolor="#CAE4FF">De clic en la imagen para ampliar</td></tr>
	<tr><td bordercolor="#CAE4FF" class="Estilo2">
		<img style="cursor:pointer;" src="wp/tester.php?r=<?php echo $_REQUEST['ref_sisa_a']; ?>&l=<?php echo $_REQUEST['envia_punta']; ?>&t=<?PHP echo $material_topol; ?>" width="900" onClick="window.open(this.src,'popup','width=1200,height=600,scrollbars=yes');">
	</td></tr>
</table>
</div><!-- FIN PESTAÑA 6 -->



</div> <!-- FIN DE PESTAÑAS -->
</center>
<?php
if($_REQUEST['validacion']=='1') // VALIDACION PARA LIQUIDAR
	{
		$faltan_datos="";
		if($rowSL['tabla']!='ciudad_segura') {
			if (trim($array_a['validacion_ot'])=='') 			$faltan_datos.="Debe indicar y guardar La OT \\n";
		}
		if ($faltan_datos<>"") echo "<script>alert('$faltan_datos'); document.solicita.validacion.value='';</script>"; 
		if ($faltan_datos=="") 
			{ 
				$error=""; 
				echo "<script>document.solicita.modificacion.value='3'; document.solicita.validacion.value=''; document.solicita.submit(); </script>"; 
			}
	}


if($_REQUEST['modificacion']=='2') // Guardar cambios Generales
	{
		$sol_mod_1="UPDATE construccion_fo SET estatus_const_fo='".$reg_estatus_const_fo."' WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."'   ";     mysql_query($sol_mod_1);
		echo "<script>alert('Modificaciones dadas de alta correctamente'); document.solicita.modificacion.value='';  document.solicita.submit(); </script>";
	}


if($_REQUEST['modificacion']=='3') // Guardar LIQUIDACION
	{
		//correo(); // Envia correo al SUCOPE sobre liquidacion
		
		if ($rowSL['tipo_transporte']=='ETH/SDH')
			{
				if($_REQUEST['envia_punta']=='A'){$campos = "estatus_regproy_acc='LIQUIDADA', fecha_atn_regproy_acc=NOW(), estatus_valcc_acc='POR VALIDAR', fecha_sol_constf=NOW()  "; }
				elseif($_REQUEST['envia_punta']=='B'){$campos= "estatus_regproy_acc_b='LIQUIDADA', fecha_atn_regproy_acc_b=NOW(), estatus_valcc_acc_b='POR VALIDAR', fecha_sol_constf_b=NOW()  "; }
			}
		elseif($rowSL['tipo_transporte']=='SDH')
			{
				if($_REQUEST['envia_punta']=='A'){$campos = "estatus_regproy_acc='LIQUIDADA', fecha_atn_regproy_acc=NOW(), estatus_elabora_ot_enru='POR VALIDAR', fecha_sol_elabora_ot_enru=NOW()  "; }
				elseif($_REQUEST['envia_punta']=='B'){$campos= "estatus_regproy_acc_b='LIQUIDADA', fecha_atn_regproy_acc_b=NOW(), estatus_elabora_ot_enru_b='POR VALIDAR', fecha_sol_elabora_ot_enru_b=NOW()  "; }
			}
		elseif($rowSL['tipo_transporte']=='CETH')
			{
				if ($ambos=='' && $_REQUEST['envia_punta']=='A' && ($rowSL['estatus_regproy_acc_b']=='LIQUIDADA' || $rowSL['estatus_regproy_acc_b']=='NO REQUERIDA'))
						{$variable_a='OK';}
				elseif ($ambos=='' && $_REQUEST['envia_punta']=='B' && ($rowSL['estatus_regproy_acc']=='LIQUIDADA' || $rowSL['estatus_regproy_acc']=='NO REQUERIDA'))
						{$variable_b='OK';}

				if($_REQUEST['envia_punta']=='A') 			{$campos = "estatus_regproy_acc='LIQUIDADA', fecha_atn_regproy_acc=NOW()"; }
				elseif($_REQUEST['envia_punta']=='B') 		{$campos = "estatus_regproy_acc_b='LIQUIDADA', fecha_atn_regproy_acc_b=NOW()"; }
				if($variable_a=='OK' || $variable_b=='OK') 	{$campos2 = ", estatus_config_logica='POR VALIDAR', fecha_sol_config_logica=NOW()";}
			}
		
		$sol_mod_4= "UPDATE ".$rowSL['tabla']." SET $campos $campos2 WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' ";
		mysql_query($sol_mod_4);

		echo "<script>alert('Liquidacion dada de alta correctamente'); document.solicita.mailcorreo.value=''; document.solicita.modificacion.value=''; document.solicita.submit(); </script>";
	}


if($_REQUEST['modificacion']=='4') // Guardar TERMINADO DE EQUIPAMIENTO
	{
		$sol_mod_4= "UPDATE construccion_equipo SET estatus_ingenieria='TERMINADO', fecha_estatus_ingenieria=NOW() WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."'     ";
		mysql_query($sol_mod_4);
		echo "<script>alert('Equipamiento Terminado'); document.solicita.modificacion.value=''; document.solicita.submit(); </script>";
	}


if($_REQUEST['var_archivo_co']=='CARGA_ARCHIVO_OT') // VALIDACION PARA LIQUIDAR
	{
		$mysql_arc_bit = "SELECT * FROM bitacora_archivos WHERE referencia='".$_REQUEST['ref_sisa_a']."' AND opcion='LADO".$_REQUEST['envia_punta']."' AND trafico='OT COBRE'  ";
		$query_arc_bit = mysql_query($mysql_arc_bit);
		$con_nombre_co = $_REQUEST['ref_sisa_a']."-OT-COBRE-LADO".$_REQUEST['envia_punta'];
						
		if (mysql_num_rows($query_arc_bit)=='')
		{
			$query_arch ="INSERT INTO bitacora_archivos (referencia, fecha, usuario, accion, trafico, opcion, nom_arch, observaciones ) VALUES('".$_REQUEST['ref_sisa_a']."', NOW(), '$sess_nmb', 'CARGA ARCHIVO', 'OT COBRE', 'LADO".$_REQUEST['envia_punta']."', '".$con_nombre_co."', CONCAT('|', NOW(),', USUARIO: $sess_usr',', CARGA DE ARCHIVO', observaciones )  )"; 
			mysql_query($query_arch);
			echo "<script>alert('Archivo ".$con_nombre_co." dado de alta correctamente.'); document.solicita.var_archivo_co.value='';  document.solicita.submit(); </script>";
		} else {
			$query_arch_up ="UPDATE bitacora_archivos SET fecha=NOW(), usuario='$sess_nmb', accion='CARGA ARCHIVO', nom_arch='".$con_nombre_co."', observaciones=CONCAT('|', NOW(),', USUARIO: $sess_usr',', CARGA DE ARCHIVO', observaciones ) WHERE referencia='".$_REQUEST['ref_sisa_a']."' AND opcion='LADO".$_REQUEST['envia_punta']."' AND trafico='OT COBRE'   "; 
			mysql_query($query_arch_up);
			echo "<script>alert('Archivo OT COBRE dado de alta correctamente.'); document.solicita.var_archivo_co.value='';  document.solicita.submit(); </script>";													
		}
	}


if($_REQUEST['validacion']=='RECHAZO') // Guardar cambios Generales
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
				
				if($_REQUEST['envia_punta']=='A')$variable_rechazo_up.=",estatus_regproy_acc='EJECUTADA SIN EXITO'";
				else $variable_rechazo_up.=",estatus_regproy_acc_b='EJECUTADA SIN EXITO'";
				
				if($rowSL['estatus_ingenieria']=='LIQUIDADA') $variable_rechazo_up.=",estatus_ingenieria='PROVIENE DE RECHAZO'";
				elseif($rowSL['estatus_proyecto_fo']!='NO REQUERIDA' && $_REQUEST['envia_punta']=='A') $variable_rechazo_up.=",estatus_proyecto_fo='PROVIENE DE RECHAZO'";
				elseif($rowSL['estatus_proyecto_fo_b']!='NO REQUERIDA' && $_REQUEST['envia_punta']!='A') $variable_rechazo_up.=",estatus_proyecto_fo_b='PROVIENE DE RECHAZO'";
					
			}
		
		// INGENIERIA
		if ($regresa=='MOD_INGENIERIA')
			{
				$variable_rechazo_up="estatus_ingenieria='POR ELABORAR";
				
				if($_REQUEST['envia_punta']=='A')$variable_rechazo_up.=",estatus_regproy_acc='EJECUTADA SIN EXITO'";
				else $variable_rechazo_up.=",estatus_regproy_acc_b='EJECUTADA SIN EXITO'";
				
				if($rowSL['estatus_proyecto_fo']!='NO REQUERIDA' && $_REQUEST['envia_punta']=='A')   $variable_rechazo_up.=",estatus_proyecto_fo='PROVIENE DE RECHAZO'";
				elseif($rowSL['estatus_proyecto_fo_b']!='NO REQUERIDA' && $_REQUEST['envia_punta']!='A') $variable_rechazo_up.=",estatus_proyecto_fo_b='PROVIENE DE RECHAZO'";
					
			}
			
		// LP LADO A
		if ($regresa=='MOD_LP_A')
			{
				$variable_rechazo_up="estatus_asigna_lp='POR ELABORAR'";
				
				if($_REQUEST['envia_punta']=='A')$variable_rechazo_up.=",estatus_regproy_acc='EJECUTADA SIN EXITO'";
				else $variable_rechazo_up.=",estatus_regproy_acc_b='EJECUTADA SIN EXITO'";
				
				if($rowSL['estatus_proyecto_fo']!='NO REQUERIDA')   $variable_rechazo_up.=",estatus_proyecto_fo='PROVIENE DE RECHAZO'";
			}
			
		// LP LADO B
		if ($regresa=='MOD_LP_B')
			{
				$variable_rechazo_up="estatus_asigna_lp_b='POR ELABORAR'";
				
				if($_REQUEST['envia_punta']=='A')$variable_rechazo_up.=",estatus_regproy_acc='EJECUTADA SIN EXITO'";
				else $variable_rechazo_up.=",estatus_regproy_acc_b='EJECUTADA SIN EXITO'";
				
				if($rowSL['estatus_proyecto_fo_b']!='NO REQUERIDA') $variable_rechazo_up.=",estatus_proyecto_fo_b='PROVIENE DE RECHAZO'";	
			}
			
		$sol_rec_anal_A = "UPDATE ".$rowSL['tabla']." SET observaciones_regproy_acc=CONCAT('|',NOW(),',USUARIO: $sess_nmb',', OBSERVACIONES:-EJECUTADA SIN EXITO EN ETAPA DE EQUIPAMIENTO-Causa:',' $causas_ori', ' $observ',observaciones_regproy_acc), observaciones_servicio_gral=CONCAT('|',NOW(),',USUARIO: $sess_nmb',', OBSERVACIONES:-EJECUTADA SIN EXITO EN ETAPA DE EQUIPAMIENTO-Causa:',' $causas_ori', ' $observ',observaciones_servicio_gral), ".$variable_rechazo_up."  WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' "; 
		mysql_query($sol_rec_anal_A);
	}

?>
</form>
</body>
</html>
<!-- INICIO ANCLA -->
<script language="javascript">
function envia(direccion)
	{
		var d=direccion;
		var d1=document.solicita.action;
		document.solicita.action=d1+"#"+d;
		document.solicita.submit();
	}
</script>
<!-- FIN ANCLA -->

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

<!-- INICIO -- Extenciones de Carga de Archivos -->
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
<!-- FIN -- Extenciones de Carga de Archivos -->
