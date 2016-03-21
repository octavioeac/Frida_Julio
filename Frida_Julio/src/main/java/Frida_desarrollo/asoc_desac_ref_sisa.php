<?php
//include ("perfiles.php");
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
<script type='text/javascript' src='./js/myscripts.js'></script>
<script type="text/javascript" src="asoc_desac_ref_sisa/js/asocia_ref_sisa.js"></script>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
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

<body onload="document.getElementById('cargando').style. display='none';">
<div class="div_Content" id="cargando" align="center"><img src="images/espere.gif" width="40" height="40" /><br />
<font size="3" color="#616161">CARGANDO....</font></div>

<div id="wrap"><div id="header"><h1><a href="grid_asigna_cx_com.php">F  R  I  D  A</a></h1><h2>Asignacion y Config de modulo CX </h2></div></div><br />
<div style='position:absolute;top:0;left:90%;font-size:9px;font-weight:bold;'>Usuario: <?PHP echo $sess_nmb; ?><br>DD: <?php echo $sess_dd; ?></div>
<br />
<div align="center">
<table width="825" border="3" cellspacing="5" bordercolor="#999999" bgcolor="#E8E8E8" align='center'>
	<tr>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Referencia vieja</td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type="text" name="ref_sisa_vieja" size="25" value="" id="ref_sisa_vieja" /></td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Referencia nueva </td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type="text" name="ref_sisa_nueva" size="25" value="" id="ref_sisa_nueva" /></td>
	</tr>


	<tr>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"></td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type="button" id="asoc" value="Asociar" onclick="javascript:asocia_ref_sisa();"  /></td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type="button" id="des" value="Desasociar" /></td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"></td>
	</tr>
    </table>
</div>
</body>
</html>