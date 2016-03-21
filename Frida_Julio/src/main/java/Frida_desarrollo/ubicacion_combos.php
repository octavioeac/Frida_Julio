<?
header("Content-Type: text/html;charset=utf-8");
include("conexion.php");
?>
<html>
<head>
<script src="js/jquery-1.10.2.min.js"></script>
<script>
	$(function(){
		$('#regresar').attr('disabled','disabled');
		//alert('No se permiten campos vacios');
		$('select').change(function(){
			if(($('#piso').val()) != '' && ($('#sala').val()) != '' && ($('#fila').val()) != '' && ($('#piso').val()) != '' && ($('#lado').val()) != '' && ($('#bastidor').val()) != '' && ($('#repisa1').val()) != ''){
				$('#regresar').removeAttr('disabled');
			}
			else{
				$('#regresar').attr('disabled','disabled');
				//alert('No se permiten campos vacios');
			}
		});
	});
</script>
</head>
<body>
<style type="text/css">
.Estilo28 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo1 {color: #000000}
.Estilo49 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #000066; }
.Estilo53 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #000000; }
.Estilo57 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; font-weight: bold; color: #990000; }

.Estilo42 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000066; }
.Estilo70 {	font-size: 12px; color: #000066; font-family: Verdana, Arial, Helvetica, sans-serif; background-color: #FFFFCC;font-weight: bold;}

h1 {
	color: #FF9900;
}
h2 {
	color: #993300;
	font-size: 2px;
	font-style: normal;
	line-height: normal;
}
tr {
text-align:left;}

strong {
color:#CC3300;
}

#tb{
font-size: 11px;

}
#sala {width:350px;}
-->
</style>


<?
$campo=$_GET['text'];
//echo $campo;
//************************************************** QUERY'S PARA FORMAR LA UBICACION *****************************************************************************
	// SALA
	$catsala=mysql_query("SELECT codigo,tipo_sala FROM cat_salas ");
	$numsala=mysql_num_rows($catsala);
	// PISO
	$catpiso=mysql_query("SELECT piso,codigo FROM `cat_pisos` ");
	$numpiso=mysql_num_rows($catpiso);
	

echo "<table width='825' border='3' cellspacing='1' bordercolor='#999999' bgcolor='#CAE4FF' id='tb'>";
echo '<tr bordercolor="#CAE4FF" bgcolor="#CAE4FF"><td width="268" colspan="4" class="Estilo42"><strong>Informacion del Equipo<strong></td></tr>';
	
echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>";
    //PISO
	echo "<td><select name='piso' id='piso' class='Estilo48' onchange='concatena()' >";
	echo "<option selected value=''>---Piso---</option>";
	$selpiso='';
	
	for ($e=0;$e<$numpiso;$e++)
	{
	   $edif=mysql_result($catpiso,$e,0)." - ".mysql_result($catpiso,$e,1);  
	   echo "<option $selpiso value='".mysql_result($catpiso,$e,1)."'>$edif</option>";
	}
	echo "</select>&nbsp;&nbsp;";
		//SALA 
	echo "<td><select name='sala' class='Estilo48' id='sala'  onchange='concatena()' >";
	echo "<option selected value=''>---Sala---</option>";
	$selsala='';
	for ($e=0;$e<$numsala;$e++)
	{
	   $edif=mysql_result($catsala,$e,0)." , ".mysql_result($catsala,$e,1);  
	   echo "<option $selsala value='".mysql_result($catsala,$e,0)."'>$edif</option>";
	}
	echo "</select></td>";

	//GRUPO
	echo "<td>&nbsp;"; 
    //FILA
	echo "<select name='fila' id='fila' class='Estilo48' class='Estilo48' onchange='concatena()' >";
	if ($fila=='') $selec='selected'; else $selec='';
	echo "<option value='' $selec>-Fila-</option>";
	if ($fila=='fila') $selec='selected'; else $selec='';
	for	($contador=0; $contador < 1000; $contador++ ){
		echo "<option value='$contador' $selec>$contador</option>";
		} 
	echo "</select></td>"; 
	//LADO
	echo "<td><select name='lado' id='lado' class='Estilo48'  onchange='concatena()' >";
	if ($lado=='') $selec='selected'; else $selec='';
	echo "<option value='' $selec>- Lado- </option>";
	if ($lado=='ladoa') $selec='selected'; else $selec='';
	echo "<option value='A' $selec>Lado A</option>";
	if ($lado=='ladob') $selec='selected'; else $selec='';
	echo "<option value='B' $selec>Lado B</option>";
	if ($lado=='ladox') $selec='selected'; else $selec='';
	echo "<option value='X' $selec>Lado X</option>";
	if ($lado=='ladoh') $selec='selected'; else $selec='';
	echo "<option value='H' $selec>Lado H</option>";
	echo "</select></td>"; 
	//BASTIDOR
	echo "<td><select name='bastidor' id='bastidor' class='Estilo48' class='Estilo48' onchange='concatena()' >";
	if ($bastidor=='') $selec='selected'; else $selec='';
	echo "<option value='' $selec>-Bastidor-</option>";
	if ($bastidor=='bastidor') $selec='selected'; else $selec='';
	for	($contador=0; $contador < 100; $contador++ )
	    {
		echo "<option value='$contador' $selec>$contador</option>";
		} 
	echo "</select>&nbsp;";
	//REPISA
	echo "<select name='repisa1' id='repisa1' class='Estilo48' class='Estilo48'  onchange='concatena()' >";
	if ($repisa1=='') $selec='selected'; else $selec='';
	echo "<option value='' $selec>-Repisa-</option>";
	if ($repisa1=='repisa1') $selec='selected'; else $selec='';
	for	($contador=101; $contador < 10000; $contador++ )
	{	
	  // echo "<option value='0$contador' $selec>0$contador</option>";
	   $contador=str_pad($contador,4,"0",STR_PAD_LEFT);
	   $con= substr($contador,-2);	
	   echo "<option value='$contador' $selec>$contador</option>";
	   if($con==99)
	   {$contador=$contador+1;}  

	}
	echo "</select></td>";  
echo "</tr>";


echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>";
		echo "<td class='Estilo42'>Ubicacion del Demarcador (Piso.Sala.Grupo.Fila.Lado.Bastidor.Repisa)&nbsp;</td>";
		echo "<td><input type='text' readonly name='ubicacion_demarcador1' id='ubicacion_demarcador1' size='19' maxlength='19'  ></td>";
echo "<td><input type='hidden' readonly name='ubicacion_demarcador2' id='ubicacion_demarcador2' size='19' maxlength='19'  ></td>";
				
//echo "<td><input id='regresar' name='regresar' value='Enviar' type='button' onClick='opener.document.getElementById(\"$campo\").value=document.getElementById(\"ubicacion_demarcador1\").value;cerrar()'></td>";
echo "<td><input id='regresar' name='regresar' value='Enviar' type='button' onClick='cerrar()'></td>";

echo "</tr>";


?>

<script type="text/javascript">
function concatena()
{
var piso = document.getElementById('piso').value;
var sala = document.getElementById('sala').value;
//var grupo = document.getElementById('grupo').value;
var fila = document.getElementById('fila').value;
var lado = document.getElementById('lado').value;
var bastidor = document.getElementById('bastidor').value;
var repisa1 = document.getElementById('repisa1').value;

if(fila<=9)
fila =0+document.getElementById('fila').value;

if(bastidor<=9)
bastidor =0+document.getElementById('bastidor').value;
var ubicacion=piso+"."+sala+fila+lado+bastidor+repisa1;
var ubicacion_2=repisa1;
document.getElementById('ubicacion_demarcador1').value=ubicacion;
document.getElementById('ubicacion_demarcador2').value=ubicacion_2;

//alert(ubicacion);

}





function cerrar()

{
opener.document.getElementById('<?=$campo?>').value=document.getElementById('ubicacion_demarcador1').value;
opener.document.getElementById('<?=$campo."_1";?>').value=document.getElementById('ubicacion_demarcador2').value;
var ventana= window.self;
ventana.opener=window.self;
ventana.close();


}

</script>
</html>