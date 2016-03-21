<?php
//include("perfiles.php");
//include("conexion.php");
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /> <!-- compatibilidad ajax y jquery con explorer -->
<link href="Scripts/validate.css" rel="stylesheet" type="text/css" /> <!-- pestañas -->
<!--<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>--->
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script>
var jq=jQuery.noConflict();
</script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-1.10.2"></script>
<script>
var jq2=jQuery.noConflict();
</script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/development-bundle/ui/jquery.ui.dialog.js"></script>
<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.css">
<style type="text/css"> 
<!--[if lte IE 6]>  
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
	.Estilo3 {font-size:8.5px;} <!-- select -->
	.Estilo4 {color:#003399; font-weight:bold; font-size:11px; } <!-- Titulos -->
	.Estilo5 {color: #330099; font-weight: bold; }
	.Estilo41 {font-size: 10px; } <!-- Pestañas -->
	.Estilo10 {	font-size:12px;  color:#000066;  font-family:Verdana,Arial,Helvetica,sans-serif;  font-weight:bold;}
	.Estilo11 { font-family:Verdana,Arial,Helvetica,sans-serif;  font-size:10px;  font-weight:bold;  color: #009;}
	.Estilo12 { font-family:Verdana,Arial,Helvetica,sans-serif;  font-size:11px;  font-weight:bold;  color: #CC0000;}
	.Estilo13 { background-color:#EEEEEE; }
	
	.div_Content{ width:400px; height:500px; position:fixed; top:100%; left:65%; margin-left:-350px; margin-top:-350px; background:url() center no-repeat transparent; }
-->
     .EmailContenedor{
    		 position:fixed ;
	         top:0px;
			 left:2px;
			 width:1800px;
			 height:665px ; 
			 background: none;
             filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000,endColorstr=#99000000); 
             background:rgba(0,0,0,0.5); 
        	 padding-top: 170px;
        	 padding-right:400px;
				         }

      
  
    .EmailContenedorExplorer{
             position:fixed ;
        	 background-color:transparent;
			 top:0px;
			 left:2px;
			 width:1800px;
			 height:665px ;
			 text-align:center; 
             filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000,endColorstr=#99000000); 
             background:rgba(0,0,0,0.2); 
		  	 }
			 
			 
             .PantallaEmailM{
			       height: 400px;
				    width : 400px;
				    left: 100px;
   			    margin-right : 1200px;
					margin-left:380px;
					margin-top:50px;
               
}
  
</style>
</head>
<body >
<div id="wrap">
<div id="header">
<h1>F  R  I  D  A</h1>
<h2>WSDL</h2>
</div>
</div>
<br />
<div style='position:absolute;top:0;left:90%;font-size:9px;font-weight:bold;'>Usuario: <?PHP echo $sess_nmb; ?><br>DD: 
</div>
<center>

<table  width="900" height="71" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#E8E8E8">
	<tr>
        <td>
        </td>
        
	    <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        Referencia:
        </td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" id="refere_si" name="ref_sisa" size="30" value=""  />
        </td>
        <td>
        </td>
		</tr>
	<tr>
    
    <td>
    </td>
     <td>
    </td>
      <td  bordercolor="#E8E8E8" bgcolor="#E8E8E8">
        <input type="button" id="datos_wsdl" value="Consulta" /> 
        </td>
                <script>
        jq("#datos_wsdl").click(function(){
   		var ref_sis=jq("#refere_si").val();
		//alert(ref_sis);
		envia_datos_wsdl(ref_sis);

		});
        </script>
         <td>
    </td>
     <td>
    </td>
    </tr>
	  
	
	<tr>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Bast. Remate</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input name="bastRemate" type="text" id="bastRemate" value="" readonly="readonly" />
        </td>
	   <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Clli. Edificio:</td>
       <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
       <input name="clliEdificio" type="text" id="clliEdificio"  value="" readonly="readonly" /></td>
	</tr>
	
	<tr>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Clli. Sistema:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="clliSistema" id="clliSistema" size="30" value="" readonly='readonly' />
        </td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Contacto Remate:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="contactoRemate"  id="contactoRemate" size="30" value="" readonly='readonly' /></td>
    </tr>
	
	 <tr>
         <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Descripcion Edificio:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="descripcionEdificio" id="descripcionEdificio" size="30" value="" readonly='readonly' />
        </td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Descripcion Sistema:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="descripcionSistema"  id="descripcionSistema" size="30" value="" readonly='readonly' />
        </td>
    </tr>
 <tr>
         <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Dispositivo :</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="dispositivo" id="dispositivo" size="30" value="" readonly='readonly' />
        </td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Fecha Asignacion:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="fechaAsignacion"  id="fechaAsignacion" size="30" value="" readonly='readonly' />
        </td>
 </tr>
	 <tr>
         <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Fila Remate:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="filaRemate" id="filaRemate" size="30" value="" readonly='readonly' />
        </td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">imt:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="imt"  id="imt" size="30" value="" readonly='readonly' />
        </td>
 </tr>
		 <tr>
         <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Lado Fila Remate:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="ladoFilaRemate" id="ladoFilaRemate" size="30" value="" readonly='readonly' />
        </td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Sigla:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
         <input type="text" name="sigla" id="sigla" size="30" value="" readonly='readonly' />
        </td>
 </tr>
 		 <tr>
         <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">ModuloDip:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="moduloDip" id="moduloDip" size="30" value="" readonly='readonly' />
        </td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Opc:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="opc"  id="opc" size="30" value="" readonly='readonly' />
        </td>
 </tr>
	
    		 <tr>
         <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Opertel:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="opertel" id="opertel" size="30" value="" readonly='readonly' />
        </td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Razon social:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="razonSocial"  id="razonSocial" size="30" value="" readonly='readonly' />
        </td>
 </tr>
	   		 <tr>
         <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Repisa Remate:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="repisaRemate" id="repisaRemate" size="30" value="" readonly='readonly' />
        </td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Sala Remate:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="salaRemate"  id="salaRemate" size="30" value="" readonly='readonly' />
        </td>
 </tr>
	 	
        	 <tr>
         <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Serie:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="serie" id="serie" size="30" value="" readonly='readonly' />
        </td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Sestatus:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="sestatus"  id="sestatus" size="30" value="" readonly='readonly' />
        </td>
 </tr>

</table>
<script>
clearInputs();
</script>
</center>
</body>
</html>
 

	    