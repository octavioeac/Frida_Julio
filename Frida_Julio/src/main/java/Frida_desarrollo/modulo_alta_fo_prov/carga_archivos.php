<?php
include ("../perfiles.php");
include ("../conexion.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;" />


<script type='text/javascript' src='./js/dgscripts.js'></script>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<style type="text/css">
<!--
.Estilo7 {color: #000066}
.Estilo8 {
	color: #000066;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.Estilo9 {
	color: #000066;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.Estilo10 {color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; }
.Estilo12 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #000066;
	font-weight: bold;
}
.Estilo14 {
	color: #000066;
	font-weight: bold;
	font-size: 14px;
}
.Estilo15 {
	font-size: 14px;
	color: #000000;
}
-->
</style>
</head>
<body>

<div id="wrap">
<div id="header">
<h1><a href="#">F  R  I  D  A</a></h1>

<h2>CARGA DE ARCHIVOS DE PROYECTOS</h2><p>
</div></div>



<? 

$tec=$_REQUEST['tec'];
$id=$_REQUEST['id'];


if ($tec=="tbas_180") {$nomof=mysql_result(mysql_query("select nom_of_equi_agreg from $tec where id_tba='$id'"),0,0);$nid="id_tba";}
if ($tec=="isam_unica" or $tec=="huawei_unica" or $tec=="edas2530_unica" or $tec=="equipos_atm")	 {$nomof=mysql_result(mysql_query("select nombre_oficial_pisa from $tec where id_tba='$id'"),0,0);$nid="id_dslam";}
if ($tec=="adva" or $tec=="adva_ce") {$nomof=mysql_result(mysql_query("select ref_sisa from $tec where id='$id'"),0,0);$nid="id";}


echo "<form enctype='multipart/form-data' method='post' name='sube'>";
echo "<input type='hidden' name='MAX_FILE_SIZE' value='5000000'>";


//if ($tec=="adva") 
//	{
//	if ($sess_usr=="joseo")  
//		{	echo "<h3>  REQUISITOS:</h3>\n";
//			echo "<h5>1) Los archivos deben de tener un maximo de 5MB, preferentemente comprimidos.</h5>\n";
//		    echo "<h5><p><br>Cargar Archivo: <input name='userfile' type='file' id='carga' onchange='LimitAttach(this,0)'>";
//		    echo "<input type='submit' value='Enviar' id='enviar'>";
//		}
//	}
//else
//	{
	echo "<h3>  REQUISITOS:</h3>\n";
	echo "<h5>1) Los archivos deben de tener un maximo de 5MB, preferentemente comprimidos.</h5>\n";
	echo "<h5><p><br>Cargar Archivo: <input name='userfile' type='file' id='carga' onchange='LimitAttach(this,0)'>";
	echo "<input type='submit' value='Enviar' id='enviar'>";
//    }



//echo "<input type='button' value='Borrar' id='borrar' onclick='document.datos.borrar.value=1;document.datos.submit();'>";
echo "</form>";

if ($tec='ADVA') {$ruta = getcwd() . "\\archivos";}
if ($tec='ADVA_CE') {$ruta = getcwd() . "\\archivos\\topologicos_ce";}

$arch2=strtolower($_FILES['userfile']['name']);

if($_FILES['userfile']['tmp_name']<>'')
{

  if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
      $noarch=strtr($_FILES['userfile']['name'], "√°√©√≠√≥√∫√±", "aeioun");
      $noarch=strtr($noarch, "·ÈÌÛ˙Ò¡…Õ”⁄—", "aeiounAEIOU—");
      move_uploaded_file($_FILES['userfile']['tmp_name'], "$ruta/$nomof--$noarch");
      if ($tec=="tbas_180") mysql_query("UPDATE $tec set ch_matriz_traf_top='OK' where nom_of_equi_agreg='$nomof'");
      if ($tec=="isam_unica" or $tec=="huawei_unica" or $tec=="edas2530_unica" or $tec=="equipos_atm")  mysql_query("UPDATE $tec set ch_matriz_traf_top='OK' where nombre_oficial_pisa='$nomof'");
  } else {
      echo "Error al cargar el archivo: " . $_FILES['userfile']['name'];
  }
}

if (!isset($dir)) $dir="";
if (!isset($dir1)) $dir1="-";

if ($dir=="")  $dir1="-";
if ($dir=="-") $dir1="";



echo "<form name=datos>\n";
echo "<input type=hidden name=orden value=$orden>\n";
echo "<input type=hidden name=dir value=$dir1>\n";
echo "<input type=hidden name=borrar>\n";
echo "<input type=hidden name=tec value='$tec'>\n";
echo "<input type=hidden name=id value='$id'>\n";
echo "</form>\n";
//unset($archivos);

if ($borrar<>"")
{
//echo "<br>$borrar";
//echo "<br>$ruta";
echo "<br>$ruta\\$borrar";

  exec ("del $ruta\\$borrar");
  echo "<script>document.datos.borrar.value='';</script>";
}

echo "<br><p><h3>Archivos cargados del proyecto: $nomof</h3>";
unset($archivos);
exec("dir /B /O$dir1$orden $ruta\\$nomof*",$archivos);
$arch=count($archivos);

echo "<br><table border=1>\n";
echo "<tr bgcolor=#80FF80><th></th><th><a href=# onclick='document.datos.orden.value=\"N\";document.datos.submit();'>Archivo</a></th><th><a href=# onclick='document.datos.orden.value=\"D\";document.datos.submit();'>Fecha</a></th><th><a href=# onclick='document.datos.orden.value=\"S\";document.datos.submit();'>TamaÒo</a></th></tr>\n";

$colores=array("#ccdfe0","#bacadc");

for ($ar=0;$ar<$arch;$ar++)
{
        $arr=$ar+1;
        $color=$colores[$ar%2];
        $datf=stat("$ruta/$archivos[$ar]");
        echo "<tr bgcolor=$color>";
        echo "<td>$arr</td>\n";
        echo "<td><a href='archivos/$archivos[$ar]'>$archivos[$ar]</a></td>\n";
        echo "<td>".date ("F d Y H:i:s",$datf[9])."</td>\n";
        echo "<td style='text-align:right'>".number_format($datf[7])."</td>\n";
		echo "<td><a href=# ondblclick='document.datos.borrar.value=\"$archivos[$ar]\";document.datos.submit();'>Borrar</a></td></tr>";  
}

echo "</table>\n";
echo "</body>\n";
echo "</html>\n";

?>


<script>

function LimitAttach(tField,iType)
{ 
    file=tField.value; 
    if (iType==1)
    { 
        extArray = new Array(".csv"); 
    } 
    allowSubmit = false; 
    if (!file) return; 
    while (file.indexOf("\\") != -1) file = file.slice(file.indexOf("\\") + 1); 
    ext = file.slice(file.indexOf(".")).toLowerCase(); 
    for (var i = 0; i < extArray.length; i++)
    { 
        if (extArray[i] == ext)
        { 
            allowSubmit = true; 
            break; 
        } 
    } 

    if (allowSubmit)
    { 
    document.getElementById('enviar').style.visibility="visible";
    }
    else
    { 
        alert("Usted sÛlo puede subir archivos con extensiones " + (extArray.join(" ")) + "\nPor favor seleccione un nuevo archivo"); 
        document.getElementById('enviar').style.visibility="hidden";
    } 
}  
</script>
