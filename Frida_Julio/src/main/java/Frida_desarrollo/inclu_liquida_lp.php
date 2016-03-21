<input type=hidden name="buscar">
<input type=hidden name="buscarCb">
<input type="hidden" name="registrarTrayecto" />
<input type="hidden" name="guardarTrayecto" />
<input type="hidden" name="eliminarTrayecto" />
<input type="hidden" name="saveTrayecto" />
<input type="hidden" name="id" />
<input type="hidden" name="liquidar" />

<?PHP
$refSisa=$_REQUEST['ref_sisa_a'];
$lado=$_REQUEST['envia_punta'];

//************************** TRAE LA INFORMACION DE LA REFERENCIA **************************
$queryDat 	= "SELECT * FROM servicios_ladaenlaces WHERE ref_sisa='$refSisa'";
$resDat 	= mysql_query($queryDat);
$rowDat 	= mysql_fetch_array($resDat);

$etapaSisa 		= $rowDat['etapa_sisa'];
$clienteSisa 	= $rowDat['cliente_sisa'];
$clienteComun 	= $rowDat['cliente_comun'];
$tabla 			= $rowDat['tabla'];
if($lado=="A")		$domicilio = $rowDat['domicilio'];
else				$domicilio = $rowDat['domicilio_b'];

//************************** SI YA EXISTE LA REFERENCIA Y EL DISTRITO LO RETRAE **************************
$queryDatos	= "SELECT distrito, clli_central, nombre_central, siglas_central FROM inventario_cobre WHERE ref_sisa='$refSisa' AND lado='$lado'";
$resDatos	= mysql_query($queryDatos);
$rowDatos	= mysql_fetch_row($resDatos);
$numDatos	= mysql_num_rows($resDatos);

if($numDatos>=1)
	{
		$bloqueo 	='readonly class="fondoGris""'; 		$distrito 	=$rowDatos[0]; 				$clli_central 	=$rowDatos[1];
		$nombre_central 	=$rowDatos[2]; 					$siglas_central 	=$rowDatos[3];
	}
if($buscarCb==1)
	{
		$query_cen 	= "SELECT * FROM centrales WHERE clli_edif='$clli_central'";
		$res_cen 	= mysql_query($query_cen);
		$row_dat_cen= mysql_fetch_array($res_cen);
		$num_cen 	= mysql_num_rows($res_cen);
		
		$nombre_central=$row_dat_cen['edificio'];
		$siglas_central=$row_dat_cen['sigcent'];
	}
?>

<br />
<table  class="tbCobre">
	<tr align="center">
		<td colspan="8"  			bgcolor="#C5C5C5">DISTRITO</td>
		<td colspan="3" rowspan="2" bgcolor="#FFDDE3">DG</td>
	</tr>
	
	<tr align="center">
		<td colspan="1" rowspan="2" bgcolor="#F3F3F3">Distrito</td>
		<td colspan="3" 			bgcolor="#FFFFCC">Secundario</td>
		<td colspan="4" 			bgcolor="#FFFFCC">Principal</td>
	</tr>
	
	<tr bgcolor="#F3F3F3">
		<td>Cable Secundario</td>  <td>Secundario</td>  <td>Par Secundario</td>  <td>Cable Primario</td>  <td>Strip</td>  <td>Par Strip</td>  <td>Distancia (m)</td>
		<td>Clli Central</td>  <td>Nombre Central</td>  <td>Siglas Central</td>
	</tr>
	<?PHP 
		$queryDatos2 = "SELECT distrito, secundario, par_secundario, strip, par_strip, clli_central, nombre_central, siglas_central, id, distancia, cable_secundario, cable_primario FROM inventario_cobre WHERE ref_sisa='$refSisa' AND lado='$lado' ORDER BY id";
		$resDatos2 	= mysql_query($queryDatos2);
		$numDatos2 	= mysql_num_rows($resDatos2);
		for($i=0;$i<$numDatos2;$i++)
			{
				$rowDatos2=mysql_fetch_row($resDatos2);
	?>
	<tr>
		<td><input type="text" name="distrito2[]" 		id="distrito2" 			value="<?=$rowDatos2[0]?>"   size="15" readonly></td>
		<td><input type="text" name="cbSecundario2[]" 	id="cbSecundario2" 		value="<?=$rowDatos2[10]?>"  size="15" ></td>
		<td><input type="text" name="secundario2[]" 	id="secundario2" 		value="<?=$rowDatos2[1]?>"   size="15" ></td>
		<td><input type="text" name="par_secundario2[]" id="par_secundario2" 	value="<?=$rowDatos2[2]?>"   size="15"  ></td>
		<td><input type="text" name="cbPrimario2[]" 	id="cbPrimario2" 		value="<?=$rowDatos2[11]?>"  size="15" ></td>
		<td><input type="text" name="strip2[]" 			id="strip2" 			value="<?=$rowDatos2[3]?>"   size="15"  ></td>
		<td><input type="text" name="par_strip2[]" 		id="par_strip2" 		value="<?=$rowDatos2[4]?>"   size="15"  ></td>
		<td><input type="text" name="distancia2[]" 		id="distancia2" 		value="<?=$rowDatos2[9]?>"   size="15"  ></td>
		<td><input type="text" name="clli_central2[]" 	id="clli_central2" 		value="<?=$rowDatos2[5]?>"   size="15"  readonly></td>
		<td><input type="text" name="nombre_central2[]" id="nombre_central2" 	value="<?=$rowDatos2[6]?>"   size="15"  readonly></td>
		<td><input type="text" name="siglas_central2[]" id="siglas_central2" 	value="<?=$rowDatos2[7]?>"   size="15"  readonly></td>
	</tr>
	<?  }?>
	</table>
