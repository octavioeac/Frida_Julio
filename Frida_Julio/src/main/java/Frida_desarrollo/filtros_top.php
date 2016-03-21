<form method="post" name="tele">
<input type=hidden name=cambiodd value=0>

<center>
<table width="800" border="0" cellpadding='2' cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF" style='margin: 20px 0px 20px 0px;'>
    <tr>
      <td colspan="5" bordercolor="#CAE4FF"><div align="center" class="Estilo1">Seleccionar y definir el criterio de b&uacute;squeda </div></td>
    </tr>

    
<?php

$fdd=$_POST['fdd'];
$festado=$_POST['festado'];
$fciudad=$_POST['fciudad'];
$frsisa=$_POST['frsisa'];
$frsisac=$_POST['frsisac'];
$cambiodd=$_POST['cambiodd'];


if ($cambiodd==1) $festado=$fciudad=$frsisa=$frsisac="";
if ($cambiodd==2) $fciudad=$frsisa=$frsisac="";
if ($cambiodd==3) $frsisa=$frsisac="";


$where[] = "division like '%". $fdd ."%'"; //
//$where[] = "ciudad like '%". $fciudad ."%'"; //
//$where[] = "estado like '%". $festado ."%'"; //
//$where[] = "ref_sisa_con like '%". $frsisac ."%'"; //
$where[] = "ref_sisa like '%". $frsisa ."%'"; //

$whereStr = '';

if ($wheregrid<>'') $whereg = "and $wheregrid";

if(count($where)> 0)
$whereStr = implode(' AND ', $where);

$_SESSION['wadva1']="$whereStr $whereg";


	//**Combo dd****
	$sqldd="SELECT division from adva where division like '$sess_dd%' $whereg group by division order by division";
	$dds=mysql_query($sqldd);
	$lindd=mysql_num_rows($dds);
	for ($i=0;$i<$lindd;$i++)
	{
	 $dat=mysql_result($dds,$i,0);
	 $sdd="";
	 if ($dat=="$fdd") $sdd="selected";
	 $combodd.="<option value='$dat' $sdd>$dat</option>";
	}

   echo "<tr><td>División</td>
   <td><select name=fdd onchange='document.tele.cambiodd.value=1;submit()'>
			<option value='%'>Todas</option>
			$combodd;
			</select>   
   </td>";


	//**Combo Estado****
	$sqlestado="SELECT estado from adva where division like '%$fdd%' $whereg group by estado order by estado";
	$estados=mysql_query($sqlestado);
	$linestado=mysql_num_rows($estados);
	for ($i=0;$i<$linestado;$i++)
	{
	 $dat=mysql_result($estados,$i,0);
	 $sestado="";
	 if ($dat=="$festado") $sestado="selected";
	 $comboestado.="<option value='$dat' $sestado>$dat</option>";
	}

   echo "<tr><td>Estado</td>
   <td><select name=festado onchange='document.tele.cambiodd.value=2;submit()'>
			<option value='%'>Todas</option>
			$comboestado;
			</select>   
   </td>";

	//**Combo Ciudad***
	$sqlciudad="SELECT ciudad from adva where division like '%$fdd%' $whereg group by ciudad order by ciudad";
	$ciudads=mysql_query($sqlciudad);
	$linciudad=mysql_num_rows($ciudads);
	for ($i=0;$i<$linciudad;$i++)
	{
	 $dat=mysql_result($ciudads,$i,0);
	 $sciudad="";
	 if ($dat=="$fciudad") $sciudad="selected";
	 $combociudad.="<option value='$dat' $sciudad>$dat</option>";
	}

   echo "<tr><td>Ciudad</td>
   <td><select name=fciudad onchange='document.tele.cambiodd.value=3;submit()'>
			<option value='%'>Todas</option>
			$combociudad;
			</select>   
   </td>";
	

	//**Combo Referencia SISA****
	$sqlrsisa="SELECT ref_sisa from adva where division like '$fdd' and ref_sisa_con like '%$frsisa%' $whereg group by ref_sisa order by ref_sisa";
	$rsisas=mysql_query($sqlrsisa);
	$linrsisa=mysql_num_rows($rsisas);
	for ($i=0;$i<$linrsisa;$i++)
	{
	 $dat=mysql_result($rsisas,$i,0);
	 $srsisa="";
	 if ($dat=="$frsisa") $srsisa="selected";
	 $comborsisa.="<option value='$dat' $srsisa>$dat</option>";
	}

   echo "<tr><td>Referencia SISA Enlace</td>
   <td><select name=frsisa onchange='document.tele.cambiodd.value=3;submit();'>
			<option value=''>Todas</option>
			$comborsisa;
			</select>   
   </td>";

	//**Combo Referencia SISA Concentrador****
	$sqlrsisac="SELECT ref_sisa_con from adva where division like '$fdd' and ref_sisa_con like '%$frsisac%' $whereg group by ref_sisa_con order by ref_sisa_con";
	$rsisacs=mysql_query($sqlrsisac);
	$linrsisac=mysql_num_rows($rsisacs);
	for ($i=0;$i<$linrsisac;$i++)
	{
	 $dat=mysql_result($rsisacs,$i,0);
	 $srsisac="";
	 if ($dat=="$frsisac") $srsisac="selected";
	 $comborsisac.="<option value='$dat' $srsisac>$dat</option>";
	}

   echo "<tr><td>Referencia SISA Enlace Concentrador</td>
   <td><select name=frsisac onchange='document.tele.cambiodd.value=3;submit();'>
			<option value=''>Todas</option>
			$comborsisac;
			</select>   
   </td>";

 
?>

    <tr>
        <td colspan="5"><div align="center">
            <input type="submit" name="buscar" value="Buscar" />
            <input type="button" name="Limpiar Filtros" value="Limpiar Filtros" onClick="
									document.tele.fdd.options[ 0 ].selected = true;
									document.tele.fciudad.options[ 0 ].selected = true;
									document.tele.festado.options[ 0 ].selected = true;
									document.tele.frsisa.options[ 0 ].selected = true;
									document.tele.frsisac.options[ 0 ].selected = true;" />
			</form>
			<?php echo "<form name='exportar' method='post' action='grid_export_html.php'>";
      echo "<input type='hidden' name='tabla' value='".$tabla."'>";//nombre del grid donde estan los campos 
      echo "<input type='submit' name='submit' value='Exportar grid'/>";
	  echo "</form>";		?>
	  
			<? 
			/*echo "<form name='exportar' method='post' action='grid_export_new.php'>";
      echo "<input type='hidden' name='archivo' value='grid_estatus_topologico.php'>";//nombre del grid donde estan los campos 
      echo "<input type='hidden' name='sesion' value='wadva1'>";//nombre de la sesion donde estan los filtros
      echo "<input type='submit' name='submit' value='Exportar '/>";
	  echo "</form>";*/
			
		?>
				
        </div></td>
    </tr>
</table>
</center>

<?php

if ($cambiodd==1 or $cambiodd==2 or $cambiodd==3) echo "<script>document.tele.submit();</script>";
?>

