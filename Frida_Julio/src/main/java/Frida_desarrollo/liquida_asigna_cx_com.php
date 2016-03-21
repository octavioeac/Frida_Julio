<?php
//include ("perfiles.php");
include ("conexion.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Validacion de Proyecto</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /> <!-- compatibilidad ajax y jquery con explorer -->

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script>
var jq=jQuery.noConflict();
</script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-1.10.2"></script>
<script>
var jq2=jQuery.noConflict();
</script>
<script type="text/javascript" src="liquida_asigna_cx_com/js/envia_datos_wsdl_modulo.js"></script>
<script type='text/javascript' src='./js/myscripts.js'></script>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />


<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/development-bundle/ui/jquery.ui.dialog.js"></script>



<script type="text/javascript" src="combosPhp/Jcombo.js"></script>
<script type='text/javascript' src='./js/myscripts.js'></script>
<script type="text/javascript" src="js/datepickercontrol.js" ></script> <!-- calendario -->
<script type="text/javascript" src="./js/domtab.js"></script> <!-- pestanas -->
<script type="text/javascript" src="js/domtabResPes.js"></script> <!-- pestanas -->
<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.css">
<link href="css/styledem_dos.css" rel="stylesheet" type="text/css" media="screen" /> <!-- pestanas -->
<link href="./css/domtab2a.css" rel="stylesheet" type="text/css" /> <!-- pestanas -->
<link href="datepickercontrol.css" rel="stylesheet" type="text/css" /> <!-- calendario -->
<link href="liquida_asigna_cx_com/css/dialog_box.css" rel="stylesheet" type="text/css" /> 
<script type="text/javascript" src="liquida_asigna_cx_com/js/pop_up.js"></script>



<!--- Funcion para abrir la ventana de la ubicacion -->
<script  language="javascript" type="text/javascript">
function popitup(url)
	{
		newwindow=window.open(url,'name','height=150,width=1100'); 
		if (window.focus) {newwindow.focus()}
		return false;
	}


function textCouter(field, countfield, maxlimit)
	{ if (field.value.length > maxlimit){field.value = field.value.substring(0, maxlimit);} else {countfield.value = maxlimit - field.value.length;} }
</script>

<style type="text/css"> 
<!--
	.Estilo1 {color:#000000}
	.Estilo2 {color:#000000; font-weight:bold; font-size:11px; }
	.Estilo3 {background-color:#D9D9D9}  Input -->
	.Estilo4a {color:#000000; font-weight:bold; font-size:13px; } <!-- Titulos -->
	h1 { color: #FF9900; }
	h2 { color: #993300; font-size: 12px; font-style: normal; line-height: normal; }
-->
</style>
</head>

<body onload="document.getElementById('cargando').style. display='none';" onfocus="getTab()">
<div class="div_Content" id="cargando" align="center"><img src="images/espere.gif" width="40" height="40" /><br />
<font size="3" color="#616161">CARGANDO....</font></div>

<div id="wrap"><div id="header"><h1><a href="grid_asigna_cx_com.php">F  R  I  D  A</a></h1><h2>Asignacion y Config de modulo CX </h2></div></div><br />
<div style='position:absolute;top:0;left:90%;font-size:9px;font-weight:bold;'>Usuario: <?PHP echo $sess_nmb; ?><br>DD: <?php echo $sess_dd; ?></div>

<?php
$ref_sisa = $_REQUEST['ref_sisa'];

// CONSULTA -- 1
$mysql_Lad = "SELECT 
						observaciones_asignacion_cx, observaciones_regproy_acc, observaciones_regproy_tx, prioridad, cliente_comun, 
						cliente_sisa, etapa_sisa, estado_sisa, criticidad, tipo_movimiento, 
						estatus_valcc_acc, estatus_valcc_acc_b, estatus_valcc_tx, estatus_valida_constft_ld,
						num_modulo, posicion_central, remates
			FROM ladaenlaces WHERE ref_sisa='".$ref_sisa."'";
$query_Lad = mysql_query($mysql_Lad);
$cons_1 = mysql_fetch_array($query_Lad);

// CONSULTA -- 2
$mysql_AsNum = "SELECT num_inicial, host FROM asigna_numeracion WHERE ref_sisa='".$ref_sisa."'";
$query_AsNum = mysql_query($mysql_AsNum);
$row_AsNum = mysql_fetch_array($query_AsNum);


?>

<form name='liquida' method="post" >
<input type='hidden' name='solicitar'>

<!--  INICIO -- INFORMATIVO -->
<br />
<table width="825" border="3" cellspacing="5" bordercolor="#999999" bgcolor="#E8E8E8" align='center'>
	<tr>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Referencia</td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type="text" name="ref_sisa" size="25" value="<?=$_REQUEST['ref_sisa']?>" readonly /></td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"></td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"></td>
	</tr>
	
	<tr>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Cliente Sisa</td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type="text" name="clienteSisa" size="25" value="<?=$cons_1['cliente_sisa']?>" readonly /></td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Cliente Comun</td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type="text" name="clienteComun" size="25" value="<?=$cons_1['cliente_comun']?>" readonly /></td>        
	</tr>
	
	<tr>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Fase Sisa</td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type="text" name="etapaSisa" size="25" value="<?=$cons_1['etapa_sisa']?>" readonly /></td> 
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Estado SISA:</td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input name="text2" type='text' size="25" value="<?=$cons_1['estado_sisa']?>" readonly="readonly" /></td>
	</tr>
	
	<tr>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Criticidad:</td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type='text' size="25" value="<?=$cons_1['criticidad']?>" readonly /></td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Tipo de Proyecto:</td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type='text' size="25" value="<?=$rowSL['tipo_movimiento']?>" readonly /></td>
	</tr>
</table>
<!-- FIN -- INFORMATIVO -->





<!-- INICIO -- ARCHIVOS -->
<br />
<table width="825" border="3" cellspacing="5" bordercolor="#999999" bgcolor="#CAE4FF" align='center'>
	<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'><td colspan='5' bordercolor='#96BCF5' bgcolor='#8BB1E0' class='Estilo4a'>Archivos cargados del proyecto: <?PHP echo $ref_sisa; ?>, ARCHIVO A</td></tr>

	<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>
		<td height="19" bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>No.</h5></center></td>
		<td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>Archivo</h5></center></td>
		<td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>Fecha</h5></center></td>
		<td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>Tama&#328;o</h5></center></td>
	</tr>

		<?php
		unset($archivos);
		unset($arch);
		unset($datf);
		$ruta = getcwd()."\\archivos\\ladaenlaces";
		exec("dir /B /O$dir1$orden $ruta\\$ref_sisa*",$archivos);
		$arch=count($archivos);
		$colores=array("#ccdfe0","#bacadc");
		for ($ar=0;$ar<$arch;$ar++)
			{
				$arr=$ar+1;
				$color=$colores[$ar%2];
				$datf=stat("$ruta/$archivos[$ar]");
				echo "<tr bgcolor=$color>";
				echo "<td>$arr</td>\n";
				echo "<td><a href='archivos/ladaenlaces/$archivos[$ar]'>$archivos[$ar]</a></td>\n";
				echo "<td>".date ("F d Y H:i:s",$datf[9])."</td>\n";
				echo "<td style='text-align:right'>".number_format($datf[7])."</td></tr>\n";
			}
		?>
</table>
<!-- FIN -- ARCHIVOS -->





<!-- INICIO -- 1 -->
<br />
<table width="825" border="3" cellspacing="7" bordercolor="#999999" bgcolor="#CAE4FF" align="center">
	<tr>
		<td bordercolor='#CAE4FF'>Numero Grupo: </td>
		<td bordercolor='#CAE4FF'><input type="text" name="textfield" class="Estilo3" readonly="readonly" value="<?=$row_AsNum['num_inicial']?>" /></td>
		<td bordercolor='#CAE4FF'>Host: </td>
		<td bordercolor='#CAE4FF'><input type="text" name="textfield2" class="Estilo3" readonly="readonly" value="<?=$row_AsNum['host']?>" /></td>
		<td bordercolor='#CAE4FF'></td>
		<td bordercolor='#CAE4FF'></td>
	</tr>
	
	<tr> 
		<td bordercolor='#CAE4FF'>Numero Modulo: </td>
		<td bordercolor='#CAE4FF'><input type="text" id="a_num_modulo" name="a_num_modulo" value="<?php if($_REQUEST['a_num_modulo']!=''){echo $_REQUEST['a_num_modulo'];}else{echo $cons_1['num_modulo'];}?>" /></td>
		<td bordercolor='#CAE4FF'>Posicion Central: </td>
		<td bordercolor='#CAE4FF'><input type='text' id='a_posicion_central' name='a_posicion_central' onClick='return popitup("ubicacion_combos.php?text=a_posicion_central")' value='<?php if($_REQUEST['a_posicion_central']!=''){echo $_REQUEST['a_posicion_central'];}else{echo $cons_1['posicion_central'];}?>' size='19' maxlength='19' readonly='readonly'></td>
		<td bordercolor='#CAE4FF'>Remates: </td>
		<td bordercolor='#CAE4FF'><input type="text" id="a_remates" name="a_remates" value="<?php if($_REQUEST['a_remates']!=''){echo $_REQUEST['a_remates'];}else{echo $cons_1['remates'];}?>" /></td>
	</tr>
 <tr>
        <td><td> 
        <script>
var ref_sis='<?=$_REQUEST['ref_sisa']?>';
		//var ref_sis='TKS-1211-0295';
		</script>
   		<td bordercolor='#CAE4FF'><input type="button"  id="datos_wsdl" value="Valida" onclick="javascript:envia_datos_wsdl_modulo(ref_sis);"/> </td>   
       <td><td> 
        <td  bordercolor='#CAE4FF'>
        <input type="button" id="datos_wsdl_2" value="Consulta" /> 
        </td>
                
				<script>
        jq("#datos_wsdl_2").hide();
		var pop_up="liquida_asigna_cx_com/pop_up_html/pop_up_html_WSDL_CONSULTA.php";
		var name_id="estado_nodo"
		var ref_sisa='<?=$_REQUEST['ref_sisa']?>';
		jq("#datos_wsdl_2").click(function(){
   				pop_up_dialog(pop_up,name_id,ref_sisa);
		});
        </script>
         <td>

 </tr>    
 
</table>
<!-- FIN -- 1 -->
<script>
limpia_input();
</script>




<!-- INICIO -- OBSERVACIONES -->
<br />
<table width="825" border="3" cellspacing="7" bordercolor="#999999" bgcolor="#CAE4FF" align="center">
	<?php
	if($cons_1['observaciones_asignacion_cx']<>"" || $cons_1['observaciones_regproy_acc']<>"" || $cons_1['observaciones_regproy_tx']<>"")
		{
			echo "<tr bgcolor='#8BB1E0'><td colspan='2'><h5>BITACORA</h5></td></tr>";
			
			if($cons_1['observaciones_regproy_acc']<>"")
				{
					echo "<tr>
							<td align='left' bordercolor='#CAE4FF'><b>Observaciones Registro de Proyecto TX: </b></td>
							<td align='left' bordercolor='#CAE4FF'><textarea rows='4' cols='50' readonly='readonly'>".$cons_1['observaciones_regproy_acc']."</textarea></td>
						  </tr>";
				}
			
			if($cons_1['observaciones_regproy_tx']<>"")
				{
					echo "<tr>
							<td align='left' bordercolor='#CAE4FF'><b>Observaciones Registro de Proyecto Acceso: </b></td>
							<td align='left' bordercolor='#CAE4FF'><textarea rows='4' cols='50' readonly='readonly'>".$cons_1['observaciones_regproy_tx']."</textarea></td>
						  </tr>";
				}

			if($cons_1['observaciones_asignacion_cx']<>"")
				{
					echo "<tr>
							<td align='left' bordercolor='#CAE4FF'><b>Observaciones Asignacion y Config de modulo CX: </b></td>
							<td align='left' bordercolor='#CAE4FF'><textarea rows='4' cols='50' readonly='readonly'>".$cons_1['observaciones_asignacion_cx']."</textarea></td>
						  </tr>";
				}
		}
	?>
	
	<tr bgcolor='#8BB1E0'><td colspan='2'><h5>VALIDACION DE PROYECTO</h5></td></tr>
	
	<tr>
		<td  align='left' bordercolor='#CAE4FF'><b>Observaciones: </b></td>
		<td  align='left' bordercolor='#CAE4FF'><textarea name='observ' rows='5' cols='50'><?=$_REQUEST['observ'];?></textarea></td>
	</tr>
	
	<tr>
		<td align='center' colspan='2' bordercolor='#CAE4FF'><input type='button' name='button' id='button' value='Liquidar' onclick='document.liquida.solicitar.value=1; document.liquida.submit();'></td>
	</tr>
</table>
<!-- FIN -- OBSERVACIONES -->
<script>
jq("#button").attr("disabled","disabled");	
</script>


<?php
// LIQUIDACION DE SERVICIO
//include("liquida_asigna_cx_com/update_ladaenlaces_wsdl.php");
if($_REQUEST['solicitar']==1)
	{
		$faltan_datos="";
		if (trim($observ)=='') 				$faltan_datos.="Debe indicar las Observaciones \\n";
		if (trim($a_num_modulo)=='') 		$faltan_datos.="Debe indicar el Numero de Modulo \\n";
		if (trim($a_posicion_central)=='') 	$faltan_datos.="Debe indicar la Posicion Central \\n";
		if (trim($a_remates)=='') 			$faltan_datos.="Debe indicar el Remate \\n";
		if ($faltan_datos<>"") echo "<script>alert('$faltan_datos'); document.liquida.solicitar.value='';</script>"; 
		if ($faltan_datos=="") 
			{ 
				$error=""; 

				mysql_query("UPDATE ladaenlaces SET estatus_asignacion_cx='LIQUIDADA', ch_aproy='POR ELABORAR', num_modulo='".$a_num_modulo."', posicion_central='".$a_posicion_central."', remates='".$a_remates."', observaciones_asignacion_cx=CONCAT('|',NOW(),',USUARIO: $sess_usr',', OBSERVACIONES:-LIQUIDADA',' $observ',observaciones_asignacion_cx) WHERE ref_sisa='".$ref_sisa."'");
				
				echo "<script>alert('Se liquido correctamente'); document.liquida.solicitar.value=''; close();</script>";
				
				/*
				$estatus_valcc_acc=$cons_1['estatus_valcc_acc'];
				$estatus_valcc_acc_b=$cons_1['estatus_valcc_acc_b'];
				$estatus_valcc_tx=$cons_1['estatus_valcc_tx'];
				$estatus_valida_constft_ld=$cons_1['estatus_valida_constft_ld'];
		
				if (($estatus_valcc_acc=='LIQUIDADA' || $estatus_valcc_acc=='NO REQUERIDA')||($estatus_valcc_acc_b=='LIQUIDADA' || $estatus_valcc_acc_b=='NO REQUERIDA')||($estatus_valcc_tx=='LIQUIDADA' || $estatus_valcc_tx=='NO REQUERIDA')||($estatus_valida_constft_ld=='LIQUIDADA' || $estatus_valida_constft_ld=='NO REQUERIDA'))
					{
						mysql_query("UPDATE ladaenlaces SET estatus_valida_activa='POR VALIDAR', fecha_sol_valida_activa=NOW() WHERE ref_sisa='$ref_sisa'");
						mysql_query("UPDATE ladaenlaces SET estatus_asignacion_cx='LIQUIDADA', fecha_atn_asignacion_cx=NOW(), observaciones_asignacion_cx=CONCAT('|',NOW(),',USUARIO: $sess_usr',', OBSERVACIONES:-LIQUIDADA',' $observ',observaciones_asignacion_cx) WHERE ref_sisa='$ref_sisa'");
					}
				else
					{
						mysql_query("UPDATE ladaenlaces SET estatus_asignacion_cx='LIQUIDADA', fecha_atn_asignacion_cx=NOW(), observaciones_asignacion_cx=CONCAT('|',NOW(),',USUARIO: $sess_usr',', OBSERVACIONES:-LIQUIDADA',' $observ',observaciones_asignacion_cx) WHERE ref_sisa='$ref_sisa'");
						echo "<script>alert(\"Se registro $ref_sisa con el Estatus: $liq\"); close(); opener.document.location.href=opener.document.location.href;</script>";
					}
				*/
			}
	}

?>
</form>
</body>
</html>