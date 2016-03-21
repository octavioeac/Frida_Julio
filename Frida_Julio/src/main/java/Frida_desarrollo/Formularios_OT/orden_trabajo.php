<?php 
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

session_start();
include('adodb/adodb.inc.php');
include('includes/connection.php');
include('libreria.php');
require("includes/functions.php");

$referencia = $_GET['referencia'];
$tabla = $_GET['tabla'];

if ($referencia != "" && $tabla != "")
{
	$SQL = "SELECT fol_ser, ref_sisa, fase, etapa_sisa, cliente_sisa, cliente_comun, fecha_dd FROM ".$tabla." 
WHERE ref_sisa = '".$referencia."'";
//echo $SQL;
	$RS = TraeRecordset($SQL);
	if (!$RS) die('1.- Error en DB!');
	
		$ser_n = $RS->fields(0);
		$ref_sisa = $RS->fields(1);
		$fase = $RS->fields(2);
		$etapa_sisa = $RS->fields(3);
		$cliente_sisa = $RS->fields(4);
		$cliente_comun = $RS->fields(5);
		$fecha_dd = $RS->fields(6);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Generaci&oacute;n de Orden de Trabajo</title>
     <style type="text/css">
     .combos_referencia
    {
        width: 200px;
        font-family:Verdana, Geneva, sans-serif;
        color:#666;
        font-size:12px;

    }
    .combos_ot
{
    width: 160px;
    font-family:Lucida Console;
    size: 10px;
    background-color:#FFF;
    color:#666;
    }

  .filas_tabla_responsables
    {
      padding: 3px;
      height: 25px;
      background-color:#FFF;
    }

    .combo
    {	
    width: 100px;
    font-family:Verdana, Geneva, sans-serif;
    color:#666;
    font-size:12px;
    }
    
    .texto_required {
        font-family:Verdana, Geneva, sans-serif;
        font-size:12px;
        color:#F60;
        
        }
.links{
    font-family:Verdana, Geneva, sans-serif;
    font-size:12px;
}
.links a {
    color:#666;
    text-decoration: none;
}
.links a:hover {
    color: #FDA041;
}
    .estilo1 {
    width: 80px;
    font-family:Verdana, Geneva, sans-serif;
    size: 12px;
    background-color:#FFF;
    color:#666;
    }
    .estilo2
    {
    color: #990000;
    font-weight: bold;
    }
    .estilo3 {
        font-family: Arial, Helvetica, sans-serif; 
        font-size: 11px; 
        color: #000; }
     </style>
<script type="text/javascript" src="scripts/mootools-core-1.4.5-full-compat.js"></script>
<script type="text/javascript" src="scripts/mootools-more-1.4.0.1.js"></script>
<script type="text/javascript" src="scripts_datepicker/datepicker/Source/Locale.es-ES-DatePicker.js"></script>
<script type="text/javascript" src="scripts_datepicker/datepicker/Source/Picker.js"></script>
<script type="text/javascript" src="scripts_datepicker/datepicker/Source/Picker.Attach.js"></script>
<script type="text/javascript" src="scripts_datepicker/datepicker/Source/Picker.Date.js"></script>
<link rel="stylesheet" type="text/css" href="scripts_datepicker/datepicker/Source/datepicker_vista/datepicker_vista.css"/>
<link rel="stylesheet" media="screen" type="text/css" href="css/ios.css" />
<script type="text/javascript">
	
		window.addEvent('domready', function() {	
		
		validate = new Form.Validator.Inline("form_OT");
			
			Locale.use('es-ES');
			new Date().format('db');
			var fecha_ini_prog = new Picker.Date($$('#Fecha_Inicio_Programada'), {
				pickerClass: 'datepicker_vista',
	//			timePicker: true,
				format: '%Y-%m-%d',
				positionOffset: {x: 5, y: 0},
				useFadeInOut: !Browser.ie,
				minDate: '2013-01-01'
			});
	
			var fecha_term_prog = new Picker.Date($$('#Fecha_Terminacion_Programada'), {
				pickerClass: 'datepicker_vista',
	//			timePicker: true,
				format: '%Y-%m-%d',
				positionOffset: {x: 5, y: 0},
				useFadeInOut: !Browser.ie,
				minDate: '2013-01-01'
			});
		$('responsable_A').addEvent('change',cambioCaja_A);
		$('responsable_B').addEvent('change',cambioCaja_B);
		$('descripcion_trabajo').addEvent('change',cambioCaja);
		$('guardar').addEvent('click',captura_ot);
	 });
function cambioCaja(){
    var val = $('descripcion_trabajo').value;
    if(val=="0")
	{
		$("OTRO").disabled = false;
		$("OTRO").set('value', '');
        $("OTRO").focus();
	}
}
function cambioCaja_A(){
    var val = $('responsable_A').value;
    if(val=="0")
	{
		$("OTRO_Resp_A").disabled = false;
		$("OTRO_Resp_A").set('value', '');
        $("OTRO_Resp_A").focus();
	}
}

function cambioCaja_B(){
    var val = $('responsable_B').value;
    if(val=="0")
	{
		$("OTRO_Resp_B").disabled = false;
		$("OTRO_Resp_B").set('value', '');
        $("OTRO_Resp_B").focus();
	}
}

function captura_ot(e)
{
	e.stop();
	e.stopPropagation();

	MooTools.lang.setLanguage("es-ES");
	validate = new Form.Validator.Inline("form_OT");
	if (validate.validate())
	{
		if (confirm('¿Desea guardar la informacion?'))
		{
			form_OT.submit();
		}
	}
}
</script>
</head>
<body>
<div align="center">
  <div id="page">
    <div id="page-padding">
	    <div id="content">
	      <div id="content-padding">
      <div align="center" id="formulario_generacion_ot">
        <!--<div align="justify">-->        
       
        <!-- start content -->
 
<form action="registro_ot.php" method="post" name="form_OT" id="form_OT">
<span class="Titulo_Gris"><strong>Generaci&oacute;n de Orden de Trabajo</strong></span><br /><br /><br />
        <fieldset>
        <legend><div style="color:#000099"><strong>Referencias</strong></div></legend>
                <!--<td><input name="Agregar" type="button" value="Agregar Referencia" /> </td>-->

<table width="600" id="tabla_referencias" border="0" class="Texto_Mediano_Gris" cellspacing="1" bgcolor="#CCCCCC">
  <tr bgcolor="#000099" class="Texto_Mediano_Blanco" style="font-weight:bold; text-align:center;">
    <td colspan="4">Referencias</td>
  </tr>
  <tr bgcolor="#FFFFFF" align="center">
  	<td align="left">&nbsp;&nbsp;Referencia 1:<span class="texto_required">*</span></td>
    <td><input type="text" name="referencia_1" id="referencia_1" style="width:150px" class="required validate-referencia-telmex" value="<?php echo $referencia; ?>" /></td>
  	<td align="left">&nbsp;&nbsp;Referencia 6:</td>
    <td><input type="text" id="referencia_6" style="width:150px" class="validate-referencia-telmex" value="" maxlength="13" tabindex="6" name="referencia[]"></td>
  </tr>
  <tr bgcolor="#FFFFFF" align="center">
  	<td align="left">&nbsp;&nbsp;Referencia 2:</td>
    <td><input type="text" id="referencia_2" style="width:150px" class="validate-referencia-telmex" value="" maxlength="13" tabindex="2" name="referencia[]"></td>
    <td align="left">&nbsp;&nbsp;Referencia 7:</td>
    <td><input type="text" id="referencia_7" style="width:150px" class="validate-referencia-telmex" value="" maxlength="13" tabindex="7" name="referencia[]"></td>
  </tr>
  <tr bgcolor="#FFFFFF" align="center">
  	<td align="left">&nbsp;&nbsp;Referencia 3:</td>
    <td><input type="text" id="referencia_3" style="width:150px" class="validate-referencia-telmex" value="" maxlength="13" tabindex="3" name="referencia[]"></td>
   	<td align="left">&nbsp;&nbsp;Referencia 8:</td>
    <td><input type="text" id="referencia_8" style="width:150px" class="validate-referencia-telmex" value="" maxlength="13" tabindex="8" name="referencia[]"></td>
  </tr>
  <tr bgcolor="#FFFFFF" align="center">
  	<td align="left">&nbsp;&nbsp;Referencia 4:</td>
    <td><input type="text" id="referencia_4" style="width:150px" class="validate-referencia-telmex" maxlength="13" tabindex="4" name="referencia[]"></td>
  	<td align="left">&nbsp;&nbsp;Referencia 9:</td>
    <td><input type="text" id="referencia_9" style="width:150px" class="validate-referencia-telmex" value="" maxlength="13" tabindex="9" name="referencia[]"></td>
  </tr>
  <tr bgcolor="#FFFFFF" align="center">
  	<td align="left">&nbsp;&nbsp;Referencia 5:</td>
    <td><input type="text" id="referencia_5" style="width:150px" class="validate-referencia-telmex" maxlength="13" tabindex="5" name="referencia[]"></td>
  	<td align="left">&nbsp;&nbsp;Referencia 10:</td>
    <td><input type="text" id="referencia_10" style="width:150px" class="validate-referencia-telmex" value="" maxlength="13" tabindex="10" name="referencia[]"></td>
  </tr>
</table>
<br />
        </fieldset>
    <br />
    <fieldset>
    <legend><div style="color:#000099"><strong>Datos Referencia</strong></div></legend><br />
    <table width="750" border="0" align="center" class="Texto_Mediano_Gris">
    <tr align="left">
        <td width="20%">Estado Servicio:</td>
        <td width="30%"><div id="edo_serv" style="font-weight:bold;"><?php echo $etapa_sisa; ?></div><input type="hidden" name="edo_serv_hidden" id="edo_serv_hidden" value="<?php echo $etapa_sisa; ?>" /></td>
        <td width="20%">Due Date:</td>
        <td width="30%"><div id="due_date" style="font-weight:bold;"><?php echo $fecha_dd; ?></div><input type="hidden" name="due_date_hidden" id="due_date_hidden" value="<?php echo $fecha_dd; ?>" /><input type="hidden" name="ser_n" id="ser_n" /> </td>
    </tr>  
    <tr align="left">
        <td>Subgerente:</td>
        <td><?php echo ImprimeCombo(18,'');?></td>
        <td>Tel&eacute;fono: </td>
        <td><div id="Tel_Sub" style="font-weight:bold;"></div><input type="text" name="Tel_Sub_hidden" id="Tel_Sub_hidden"/></td>
    </tr>  
    <tr align="left">
        <td>Supervisor: </td>
        <td><?php echo ImprimeCombo(19,'');?></td>
        <td>Tel&eacute;fono: </td>
        <td><div id="Tel_Sup" style="font-weight:bold;"></div><input type="text" name="Tel_Sup_hidden" id="Tel_Sup_hidden" /></td>
    </tr>  
    <tr align="left">
        <td>Elabor&oacute;: </td>
        <td><?php echo ImprimeCombo(20,'');?></td>
        <td>Tel&eacute;fono: </td>
        <td><div id="tel_IPE" style="font-weight:bold;"></div><input type="text" name="tel_IPE_hidden" id="tel_IPE_hidden" /></td>
      </tr>
 </table><!--<input type="text" name="buscar_ok" id="buscar_ok" style="opacity:0;" class="required" />--><br />
</fieldset>
<br />
		<fieldset>
        	<legend><div style="color:#000099"><strong>Punta A</strong></div></legend>
    <table width="950" border="0" class="Texto_Mediano_Gris">
  <tr align="left">
    <td>Cliente:<span class="texto_required">*</span></td>
    <td><input type="text" name="Cliente_A" id="Cliente_A" style="width: 200px" class="required" value="<?php echo $cliente_sisa; ?>" /></td>
    <td>Domicilio:<span class="texto_required">*</span></td>
    <td colspan="3"><textarea name="Direccion_A" id="Direccion_A" cols="32" rows="2" class="required" ></textarea></td>
  </tr>
  <tr align="left">
    <td>Responsable Cliente:<span class="texto_required">*</span></td>
    <td><input type="text" name="Responsable_Cliente_A" id="Responsable_Cliente_A" style="width: 200px" class="required" /></td>
    <td>Tel&eacute;fono Cliente:<span class="texto_required">*</span></td>
    <td><input type="text" name="Tel_cliente_A" id="Tel_cliente_A" style="width: 200px" class="required" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="left">
    <td width="107">Central A: </td>
    <td width="198"><?php echo ImprimeCombo(2,'');?></td>
    <td width="128">DD Punta A: </td>
    <td width="207"><input type="text" name="dd_A" id="dd_A" style="width: 200px" /></td>
    <td width="103">Jefe de Trasmision A: </td>
    <td width="198"><?php echo ImprimeCombo(16,'');?></td>
  </tr>
  <tr align="left">
    <td>Asignado A:</td>
    <td><?php echo ImprimeCombo(3,'');?></td>
    <td>Responsable Contratista A:<span class="texto_required">*</span></td>
    <td><?php echo ImprimeCombo(5,'');?></td>
    <td>Otro:</td>
    <td><input type="text" name="OTRO_Resp_A" id="OTRO_Resp_A" style="width: 200px" disabled="disabled" /></td>
  </tr>
</table><br />
</fieldset>
<br />
		<fieldset>
        	<legend><div style="color:#000099"><strong>Punta B</strong></div></legend>
    <table width="950" border="0" class="Texto_Mediano_Gris">
  <tr align="left">
    <td>Cliente:<span class="texto_required">*</span></td>
    <td><input type="text" name="Cliente_B" id="Cliente_B" style="width: 200px" class="required" /></td>
    <td>Domicilio:<span class="texto_required">*</span></td>
    <td colspan="3"><textarea name="Direccion_B" id="Direccion_B" cols="32" rows="2" class="required" ></textarea></td>
  </tr>
  <tr align="left">
    <td>Responsable Cliente:<span class="texto_required">*</span></td>
    <td><input type="text" name="Responsable_Cliente_B" id="Responsable_Cliente_B" style="width: 200px" class="required" /></td>
    <td>Tel&eacute;fono Cliente:<span class="texto_required">*</span></td>
    <td><input type="text" name="Tel_Cliente_B" id="Tel_Cliente_B" style="width: 200px" class="required" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="left">
    <td width="107">Central B:</td>
    <td width="198"><?php echo ImprimeCombo(6,'');?></td>
    <td width="128">DD Punta B: </td>
    <td width="207"><input type="text" name="dd_B" id="dd_B" style="width: 200px" /></td>
    <td width="103">Jefe de Trasmision B: </td>
    <td width="198"><?php echo ImprimeCombo(16,'');?></td>
  </tr>
  <tr align="left">
    <td>Asignado B:</td>
    <td><?php echo ImprimeCombo(7,$id_filial);?></td>
    <td>Responsable Contratista B:<span class="texto_required">*</span></td>
    <td><?php echo ImprimeCombo(9,'');?></td>
    <td>Otro:</td>
    <td><input type="text" name="OTRO_Resp_B" id="OTRO_Resp_B" style="width: 200px" disabled="disabled" /></td>
  </tr>
</table><br />
</fieldset><br />
     <fieldset>
      	<legend><div style="color:#000099"><strong>Detalle del Servicio</strong></div></legend>
        <br /> 
<table width="950" border="0" class="Texto_Mediano_Gris">
  <tr align="left">
    <td width="225">Descripci&oacute;n del Trabajo:<span class="texto_required">*</span></td>
    <td width="243"><?php echo ImprimeCombo(10,'');?></td>
    <td width="169">Prioridad:<span class="texto_required">*</span></td>
    <td width="205"><?php echo ImprimeCombo(13,'');?></td>
  </tr>
  <tr align="left">
    <td>Descripci&oacute;n Otro Trabajo:</td>
    <td><input type="text" name="OTRO" id="OTRO" style="width: 200px" disabled="disabled" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;<input type="checkbox" name="nocturno" id="nocturno" />&nbsp;Nocturno</td>
  </tr>
  <tr align="left">
    <td>Tipo de Trabajo:<span class="texto_required">*</span></td>
    <td><?php echo ImprimeCombo(14,'');?></td>
    <td>Fecha de Inicio Programada:<span class="texto_required">*</span></td>
    <td><input type="text" name="Fecha_Inicio_Programada" id="Fecha_Inicio_Programada" style="width: 200px" class="required" /></td>
  </tr>
  <tr align="left">
    <td>Tipo de Servicio:<span class="texto_required">*</span></td>
    <td><input type="text" name="str_Tipo_Servicio" id="str_Tipo_Servicio" style="width: 200px" class="required" /></td>
    <td>Fecha de Terminaci&oacute;n Programada:<span class="texto_required">*</span></td>
    <td><input type="text" name="Fecha_Terminacion_Programada" id="Fecha_Terminacion_Programada" style="width: 200px" class="required" /></td>
  </tr>
  <tr align="left">
    <td>Tipo de Enlace:<span class="texto_required">*</span></td>
    <td><?php echo ImprimeCombo(12,'');?></td>
    <td rowspan="3">Observaciones:</td>
    <td rowspan="3"><textarea name="str_Observaciones" id="str_Observaciones" cols="32" rows="3"></textarea></td>
  </tr>
  <tr align="left">
    <td>Tipo de Mercado:<span class="texto_required">*</span></td>
    <td><?php echo ImprimeCombo(11,'');?></td>
  </tr>
  <tr align="left">
    <td>Medio de Transmision:<span class="texto_required">*</span></td>
    <td><?php echo ImprimeCombo(15,'');?></td>
  </tr>
</table><br />

</fieldset><br />
<p align="left"><span class="texto_required">*</span> - Campos Requeridos</p>
<center>
    <input type="button" name="guardar" id="guardar" value="Guardar Datos" />
</center>
<br /><br />
</form>
      </div>
    </div>
    </div>
</div>
  </div>
</div>
</body>
</html>
<?php 
} else {
	echo "SIN REFERENCIA / TABLA";	
}
?>