<?php
require("conexion.php");
include ("perfiles.php");
$causa=$_GET['causa'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Validacion de Proyecto</title>
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv='Cache-Control' content='no-cache, mustrevalidate'>
<meta http-equiv='Expires' content='0'>
<meta http-equiv='Last-Modified' content='0'>
<meta http-equiv='Pragma' content='no-cache'>

<style type="text/css">
<!--
.Estilo1 {color: #000000}
h1 {
	color: #FF9900;
}
h2 {
	color: #993300;
	font-size: 12px;
	font-style: normal;
	line-height: normal;
}
-->
</style>
</head>
<body>
<div id="wrap">
<div id="header">
	<div id="logo">
		<h1>F R I D A</h1>
		<h2>Asignacion y Config de modulo CX </h2>
		<p>&nbsp;</p>
	  <p>&nbsp;</p>
    </div>
	<div id="rss"></div> 
  </div>
</div>
<?

echo "<form name='liquida' >";
echo "<input type='hidden' name='solicitar'>";
echo "<input type='hidden' name='liq'>";
echo "<input type='hidden' name='estado'>";
echo "<input type='hidden' name='observ'>";
echo "<input type='hidden' name='causa_sel'>";
echo "<input type='hidden' name='ref_sisa' value='".$_REQUEST['ref_sisa']."'>";
echo "<input type='hidden' name='val' value='".$_REQUEST['val']."'>";
?>
	<table width="825" border="3" cellspacing="5" bordercolor="#999999" bgcolor="#CAE4FF" align='center'>
   	<tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
	<tr bgcolor='#72A6F3'><td colspan='4'><font color="#000000"><h4>Referencia: <?= $ref_sisa?>, ARCHIVO A</h4></font></td></tr>
    <td width="268" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42"><strong><font color="#FF0000">ARCHIVOS ASOCIADOS</font></strong></td>
    <td width="163" bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp; </td>
    <td width="162" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">&nbsp;</td>
<?

		unset($archivos);
		unset($arch);
		unset($datf);
		$ruta = getcwd() . "\\archivos\\ladaenlaces";
		exec("dir /B /O$dir1$orden $ruta\\$ref_sisa*",$archivos);
		$arch=count($archivos);
		echo "<tr bgcolor=#80FF80><th></th><th><a href=#>Archivo</a></th><th><a href=#>Fecha</a></th><th><a href=#>Tamaño</a></th></tr>\n";
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
		<?
		echo '<table width="825" border="3" cellspacing="7" bordercolor="#999999" bgcolor="#E8E8E8" align="center">';
		$observa=mysql_query("select observaciones_asignacion_cx,observaciones_regproy_acc,observaciones_regproy_tx,prioridad,cliente_comun from ladaenlaces where ref_sisa='$ref_sisa'");				
		$observ2=mysql_fetch_array($observa);
		if($observ2[0]<>""||$observ2[1]<>""||$observ2[2]<>"")
		{		
			echo "<tr bgcolor='#8BB1E0'><td colspan='2'><h5>BITACORA</h5></td></tr>";	
			if($observ2[1]<>"")
			{	
				echo "<tr>";			 
				echo "<td  align='center' bordercolor='#CAE4FF' class='Estilo28'><b>Observaciones Registro de Proyecto TX: </b> </td>";
				echo "<td  align='center' bordercolor='#CAE4FF' class='Estilo28'><textarea rows='5' cols='30' readonly>$observ2[1]</textarea></td>";			
				echo "</tr>";
			}
			if($observ2[2]<>"")
			{	
				echo "<tr>";			 
				echo "<td  align='center' bordercolor='#CAE4FF' class='Estilo28'><b>Observaciones Registro de Proyecto Acceso: </b> </td>";
				echo "<td  align='center' bordercolor='#CAE4FF' class='Estilo28'><textarea rows='5' cols='30' readonly>$observ2[2]</textarea></td>";			
				echo "</tr>";
			}
			if($observ2[0]<>"")
			{	
				echo "<tr>";			 
				echo "<td  align='center' bordercolor='#CAE4FF' class='Estilo28'><b>Observaciones Asignacion y Config de modulo CX: </b> </td>";
				echo "<td  align='center' bordercolor='#CAE4FF' class='Estilo28'><textarea rows='5' cols='30' readonly>$observ2[0]</textarea></td>";			
				echo "</tr>";
			}
		}
		echo "<tr bgcolor='#8BB1E0'><td colspan='2'><h5>VALIDACION DE PROYECTO</h5></td></tr>";	
		echo "<tr>";					 
		echo "<td  align='center' bordercolor='#CAE4FF' class='Estilo28'><b>Observaciones:</b></td>";
		echo "<td  align='center' bordercolor='#CAE4FF' class='Estilo28'><textarea name='observ' rows='5' cols='30'>$observ</textarea></td>";			
		echo "</tr>";
		echo "<input type='hidden' name='optec' value='LIQUIDADA'>";
		echo "<tr>";	
		echo "<td align='center' colspan='4' bordercolor='#CAE4FF' class='Estilo28'><input type='button' $des name='button' id='button' value='Liquidar'  onclick='document.liquida.liq.value=\"LIQUIDADA\";document.liquida.estado.value=\"$optec\";document.liquida.solicitar.value=1;document.liquida.submit();'></td>";
		echo "</tr>";					 
		echo "</table>";
		if($solicitar==1)
		{
			$cons=mysql_query("select * from ladaenlaces where ref_sisa='$ref_sisa'");
			$cons_1=mysql_fetch_array($cons);
			$estatus_valcc_acc=$cons_1['estatus_valcc_acc'];
			$estatus_valcc_acc_b=$cons_1['estatus_valcc_acc_b'];
			$estatus_valcc_tx=$cons_1['estatus_valcc_tx'];
			$estatus_valida_constft_ld=$cons_1['estatus_valida_constft_ld'];
			if (($estatus_valcc_acc=='LIQUIDADA' || $estatus_valcc_acc=='NO REQUERIDA')||($estatus_valcc_acc_b=='LIQUIDADA' || $estatus_valcc_acc_b=='NO REQUERIDA')||($estatus_valcc_tx=='LIQUIDADA' || $estatus_valcc_tx=='NO REQUERIDA')||($estatus_valida_constft_ld=='LIQUIDADA' || $estatus_valida_constft_ld=='NO REQUERIDA'))
			{
				mysql_query("UPDATE ladaenlaces SET estatus_valida_activa='POR VALIDAR',fecha_sol_valida_activa=NOW() where ref_sisa='$ref_sisa'");
				mysql_query("UPDATE ladaenlaces SET estatus_asignacion_cx='LIQUIDADA',fecha_atn_asignacion_cx=NOW(),observaciones_asignacion_cx=CONCAT('|',NOW(),',USUARIO: $sess_usr',', OBSERVACIONES:-LIQUIDADA',' $observ',observaciones_asignacion_cx) where ref_sisa='$ref_sisa'");
			}
			else
				mysql_query("UPDATE ladaenlaces SET estatus_asignacion_cx='LIQUIDADA',fecha_atn_asignacion_cx=NOW(),observaciones_asignacion_cx=CONCAT('|',NOW(),',USUARIO: $sess_usr',', OBSERVACIONES:-LIQUIDADA',' $observ',observaciones_asignacion_cx) where ref_sisa='$ref_sisa'");
			echo "<script>alert(\"Se registro $ref_sisa con el Estatus: $liq\");close();opener.document.location.href=opener.document.location.href;</script>";
		}
		echo "</table>";
		echo "</form>";			

?>
