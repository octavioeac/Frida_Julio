
<?php if ($pestana_opciones_material=='COBRE'){ // include ('inclu_liquida_lp.php'); ?>
		<input type="hidden" name="buscar" />
		<input type="hidden" name="buscarCb" />
		<input type="hidden" name="registrarTrayecto" />
		<input type="hidden" name="guardarTrayecto" />
		<input type="hidden" name="eliminarTrayecto" />
		<input type="hidden" name="saveTrayecto" />
		<input type="hidden" name="id" />
		<input type="hidden" name="liquidar" />
		
		<?PHP
		$refSisa = $_REQUEST['ref_sisa_a'];
		$lado 	 = $_REQUEST['envia_punta'];
		
		//************************** TRAE LA INFORMACION DE LA REFERENCIA **************************
		$queryDat 	= "SELECT * FROM servicios_ladaenlaces WHERE ref_sisa='$refSisa'";
		$resDat 	= mysql_query($queryDat);
		$rowDat 	= mysql_fetch_array($resDat);
		
		$etapaSisa 		= $rowDat['etapa_sisa'];
		$clienteSisa 	= $rowDat['cliente_sisa'];
		$clienteComun 	= $rowDat['cliente_comun'];
		$tabla 			= $rowDat['tabla'];
		if($lado=="A")	$domicilio = $rowDat['domicilio'];
		else			$domicilio = $rowDat['domicilio_b'];
		
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
		<table align="center"><tr><td align="right">
		<input type="button" name="link_asigna_cobre" value="ASIG. COBRE" onclick="window.open('liquida_lp.php?ref_sisa=<?php echo $_REQUEST['ref_sisa_a']; ?>&lado=<?php echo $_REQUEST['envia_punta'];?>&tabla=<?php echo $rowDat['tabla']; ?>&origen=liq_ingenieria');" />
		</td></tr></table>
		<table align="left">
			<tr align="center">
				<td colspan="8" class="Estilo2"   			bgcolor="#C5C5C5">DISTRITO</td>
				<td colspan="3" class="Estilo2" rowspan="2" bgcolor="#FFDDE3">DG</td>
			</tr>
			
			<tr align="center">
				<td colspan="1" class="Estilo2" rowspan="2" bgcolor="#F3F3F3">Distrito</td>
				<td colspan="3" class="Estilo2" 			bgcolor="#FFFFCC">Secundario</td>
				<td colspan="4" class="Estilo2" 			bgcolor="#FFFFCC">Principal</td>
			</tr>
			
			<tr bgcolor="#F3F3F3" align="center">
				<td class="Estilo2">Cable Secundario</td> 	<td class="Estilo2">Secundario</td> 	<td class="Estilo2">Par Secundario</td>
				<td class="Estilo2">Cable Primario</td> 	<td class="Estilo2">Strip</td> 			<td class="Estilo2">Par Strip</td>
				<td class="Estilo2">Distancia (m)</td> 		<td class="Estilo2">Clli Central</td> 	<td class="Estilo2" >Nombre Central</td>
				<td class="Estilo2">Siglas Central</td>
			</tr>
			
			<?PHP 
				$queryDatos2 = "SELECT distrito, secundario, par_secundario, strip, par_strip, clli_central, nombre_central, siglas_central, id, distancia, cable_secundario, cable_primario FROM inventario_cobre WHERE ref_sisa='$refSisa' AND lado='$lado' ORDER BY id";
				$resDatos2 	= mysql_query($queryDatos2);
				$numDatos2 	= mysql_num_rows($resDatos2);
				for($i=0;$i<$numDatos2;$i++)
					{ $rowDatos2=mysql_fetch_row($resDatos2);?>
						<tr>
							<td><input type="text" size="15" class='Estilo2' name="distrito2[]" 	  id="distrito2" 		value="<?=$rowDatos2[0]?>"   readonly></td>
							<td><input type="text" size="15" class='Estilo2' name="cbSecundario2[]"   id="cbSecundario2" 	value="<?=$rowDatos2[10]?>" ></td>
							<td><input type="text" size="15" class='Estilo2' name="secundario2[]" 	  id="secundario2" 		value="<?=$rowDatos2[1]?>"  ></td>
							<td><input type="text" size="15" class='Estilo2' name="par_secundario2[]" id="par_secundario2" 	value="<?=$rowDatos2[2]?>"  ></td>
							<td><input type="text" size="15" class='Estilo2' name="cbPrimario2[]" 	  id="cbPrimario2" 		value="<?=$rowDatos2[11]?>" ></td>
							<td><input type="text" size="15" class='Estilo2' name="strip2[]" 		  id="strip2" 			value="<?=$rowDatos2[3]?>"  ></td>
							<td><input type="text" size="15" class='Estilo2' name="par_strip2[]" 	  id="par_strip2" 		value="<?=$rowDatos2[4]?>"  ></td>
							<td><input type="text" size="15" class='Estilo2' name="distancia2[]" 	  id="distancia2" 		value="<?=$rowDatos2[9]?>"  ></td>
							<td><input type="text" size="15" class='Estilo2' name="clli_central2[]"   id="clli_central2" 	value="<?=$rowDatos2[5]?>"  readonly></td>
							<td><input type="text" size="15" class='Estilo2' name="nombre_central2[]" id="nombre_central2" 	value="<?=$rowDatos2[6]?>"  readonly></td>
							<td><input type="text" size="15" class='Estilo2' name="siglas_central2[]" id="siglas_central2" 	value="<?=$rowDatos2[7]?>"  readonly></td>
						</tr>
			<?  }?>
		</table>
<?PHP } ?>






<?php if ($pestana_opciones_material=='FIBRA OPTICA'){ // include ('inclu_alta_construccion_fo.php'); ?>
	<?php	
	// VARIABLES IMPORTANTES
	$spanTipoTras_FO='FO';
	
	// QUERY GENERAL
	$mysql_a = "SELECT * FROM construccion_fo WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."' ";
	$query_a = mysql_query($mysql_a);
	$array_a = mysql_fetch_array($query_a,MYSQL_ASSOC);
	
	// INFORMACION DE FIBRAS
	$mysql_b = "SELECT * FROM fibra_optica_ladenlaces WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."'  ";
	$query_b = mysql_query($mysql_b);
	$array_b = mysql_fetch_array($query_b,MYSQL_ASSOC);
	?>

	<table width="100%" bordercolor='#CAE4FF' bgcolor='#CAE4FF' >
		<tr>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Resp IPR:</td>
			<td align="left" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo3"><input class="Estilo3" name="ipr_resp_fo" type="text" id="ipr_resp_fo" value="<?=$array_a['ipr_resp_fo']?>" size="25" readonly="readonly" /></td>
			<td align="left" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" >Resp SUCOPE:</td>
			<td align="left" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" ><input class="Estilo3" name="sucope_fo" type="text" id="sucope_fo" value="<?=$array_a['sucope_fo']?>" size="25" readonly="readonly" /></td>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Supervisor FO:</td>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo3" name="supervisor_fo" type="text" id="supervisor_fo" value="<?=$array_a['supervisor_fo']?>" size="25" readonly="readonly" /></td>
		</tr>
	
		<tr>
		<td align="left" bordercolor="#CAE4FF" class="Estilo2">PES:</td>
		<td align="left" bordercolor="#CAE4FF" class="Estilo2"><input class="Estilo3" name="pes" type="text" id="pes" value="<?=$array_a['pes']?>" readonly="readonly" /></td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">NCO/ROF:</td>
		<td bordercolor="#CAE4FF" align="left"><input class="Estilo3" name="nco" type="text" id="nco" value="<?=$array_a['nco']?>" readonly="readonly" /></td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Anillo:</td>
		<td bordercolor="#CAE4FF" align="left"><input class="Estilo3" name="anillo_rof" type="text" id="anillo_rof" value="<?=$array_a['anillo_rof']?>" readonly="readonly" /></td>
		</tr>
		
		<tr>
			<td bordercolor="#CAE4FF" class="Estilo2" align="left">Longitud Trabajo:</td>
			<td bordercolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo3" name="longitud_trab" type="text" id="longitud_trab" value="<?=$array_a['longitud_trab']?>" readonly="readonly" /></td>
			<td height="24" bordercolor="#CAE4FF" class="Estilo2" align="left">Atenuacion Trabajo: </td>
			<td bordercolor="#CAE4FF" align="left"><input class="Estilo3" name="atenuacion_trab" type="text" id="atenuacion_trab" value="<?=$array_a['atenuacion_trab']?>" readonly="readonly" /></td>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
		</tr>
		
		<tr>
			<td bordercolor="#CAE4FF" class="Estilo2" align="left">Longitud Respaldo:</td>
			<td bordercolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo3" name="longitud_resp" type="text" id="longitud_resp" value="<?=$array_a['longitud_resp']?>" readonly="readonly" /></td>
			<td bordercolor="#CAE4FF" class="Estilo2" align="left">Atenuacion Respaldo: </td>
			<td bordercolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo3" name="atenuacion_resp" type="text" id="atenuacion_resp" value="<?=$array_a['atenuacion_resp']?>" readonly="readonly" /></td>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
		</tr>

		<!-- INICIO de FO -->
		<tr ><td colspan="6"><!-- bgcolor="#999999" -->
			<table width="100%" border="2" bordercolor='#666666' bgcolor='#CAE4FF'>
				<tr>
					<td colspan="12" bordercolor="#CAE4FF" bgcolor="#CAE4FF"><p><div style="color:#CC0000;font-family:Verdana,Arial,Helvetica,sans-serif;  font-size:11px;  font-weight:bold;" align="center">AGREGAR TRAYECTO DE FIBRA OPTICA <?php echo $_REQUEST['ref_sisa_a'] ; ?> PUNTA <? echo $_REQUEST['envia_punta'];?></div></p></td>
				</tr>
				
				<tr>
					<td colspan="12" bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left" class="Estilo2" >Tipo<input id="tipo" name="tipo" type="text" size="15" value="<?=$array_a['tipo']?>" readonly="readonly" /></td>
				</tr>
				
				<?php
				// INFORMACION DE TRAYECTORIA
				$mysql_o = "SELECT central_a, cliente,tipo_trayec,  cable, ubicaciona, cap_cable, longitud, tipo_jumper, repisa_a, remate_a, fibra_a, fibra_b, pedido45  FROM fibra_optica_ladenlaces WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."' AND tipo_sel='".$array_a['tipo']."' AND tipo_tras='".$spanTipoTras_FO."'   ";
				$query_o = mysql_query($mysql_o);
				$num_o = mysql_num_rows($query_o);
				
				for ($i=0; $i<$num_o; $i++)
					{
						$o_tt = mysql_result($query_o,$i,'tipo_trayec'); 
						
						if ($o_tt=='CLIENTE (TRABAJO)' || $o_tt=='CENTRAL (TRABAJO)'){$VT_A='OK';}
						if ($o_tt=='CLIENTE (RESPALDO)' || $o_tt=='CENTRAL (RESPALDO)'){$VR_A='OK';}
						
						if ($o_tt=='CLIENTE (TRABAJO)' || $o_tt=='CLIENTE (RESPALDO)'){$VCL_A='OK'; $VCN_A='';}
						if ($o_tt=='CENTRAL (TRABAJO)' || $o_tt=='CENTRAL (RESPALDO)'){$VCN_A='OK'; $VCL_A='';}
				?>
				<tr>
					<td width="25%" align="center" bgcolor="#CAE4FF" class="Estilo10"><? echo $o_tt ?></td>
					<td width="10%" align="center" bgcolor="#CAE4FF" class="Estilo58"><?php if($VCL_A=='OK'){echo "Cliente"; }elseif($VCN_A=='OK'){echo "Central";}?><br /><input id="A" name="A" type="text" class="Estilo3" size="9" value="<?php if($VCN_A=='OK'){echo mysql_result($query_o,$i,'central_a');} elseif($VCL_A=='OK'){echo mysql_result($query_o,$i,'cliente');} ?>" /></td>
					<td width="8%" align="center" bgcolor="#CAE4FF" class="Estilo58">Nombre Cable<br /><input id="B" name="B" type="text" class="Estilo3" size="9" value="<?=mysql_result($query_o,$i,'cable')?>" /></td>
					<td width="7%" align="center" bgcolor="#CAE4FF" class="Estilo58">Ubicacion<br /><input type='text' id='C' name='C' class="Estilo3" value='<?=mysql_result($query_o,$i,'ubicaciona')?>' size='11' readonly='readonly'></td>
					<td width="7%" align="center" bgcolor="#CAE4FF" class="Estilo58"><?PHP if ($VCL_A=='OK'){ ?> Cap Cable<br /><input type='text' id='D' name='D' class="Estilo3" value='<?=mysql_result($query_o,$i,'cap_cable')?>' size='3' readonly='readonly'><?php } else { echo "&nbsp;"; }?></td>
					<td width="7%" align="center" bgcolor="#CAE4FF" class="Estilo58"><?PHP if ($VCL_A=='OK'){ ?>Long (M)<br /><input name="E" type="text" id="E" size="3" class="Estilo3" value="<?=mysql_result($query_o,$i,'longitud')?>"/><?php } else { echo "&nbsp;"; }?></td>
					<td width="10%" align="center" bgcolor="#CAE4FF" class="Estilo58"><?PHP if ($VCL_A=='OK'){ ?>Tipo FO<br /><input name="F" type="text" id="F" size="9" class="Estilo3" value="<?=mysql_result($query_o,$i,'tipo_jumper')?>"/><?php } else { echo "&nbsp;"; }?></td>
					<td width="8%" align="center" bgcolor="#CAE4FF" class="Estilo58">Repisa<br /><input name="G" type="text" id="G" size="3" class="Estilo3" value="<?=mysql_result($query_o,$i,'repisa_a')?>" /></td>
					<td width="9%" align="center" bgcolor="#CAE4FF" class="Estilo58">Remate<br /><input name="H" type="text" id="H" size="3" class="Estilo3" value="<?=mysql_result($query_o,$i,'remate_a')?>" /></td>
					<td width="9%" align="center" bgcolor="#CAE4FF" class="Estilo58">Remate<br /><input name="K" type="text" id="K" size="9" class="Estilo3" value="<?=mysql_result($query_o,$i,'pedido45')?>" /></td>
					<td width="8%" align="center" bgcolor="#CAE4FF" class="Estilo58">F1<br /><input name="I" type="text" id="I" size="3" class="Estilo3" value="<?=mysql_result($query_o,$i,'fibra_a')?>" /></td>
					<td width="8%" align="center" bgcolor="#CAE4FF" class="Estilo58">F2<br /><input name="J" type="text" id="J" size="3" class="Estilo3" value="<?=mysql_result($query_o,$i,'fibra_b')?>" /></td>
				</tr>
				<?php		
					}
				?>
			</table>
		</td></tr>
		<!-- FIN de FO -->
		
		<tr><td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo4" align="left" colspan='6'>&nbsp;</td></tr>
		<tr>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">FO Construccion Estatus: </td>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left"><input class="Estilo3" name="estatus_const_fo" type="text" id="estatus_const_fo" value="<?=$array_a['estatus_const_fo']?>" readonly="readonly" /></td>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Problematica:</td>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo3" name="dependencia_construccion" type="text" id="dependencia_construccion" value="<?=$array_a['dependencia_construccion']?>" readonly="readonly" /></td>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Supervisor Cons:</td>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left"><input class="Estilo3" name="supervisor_const" type="text" id="supervisor_const" value="<?=$array_a['supervisor_const']?>" readonly="readonly" /></td>
		</tr>
		
		<tr>
			<td bordercolor="#CAE4FF" class="Estilo2" align="left">Fecha Remate FO: </td>
			<td bordercolor="#CAE4FF" align="left"><input class="Estilo3" name="fecha_remate_fo" type="text" id="fecha_remate_fo" value="<?=$array_a['fecha_remate_fo']?>" readonly="readonly" /></td>
			<td bordercolor="#CAE4FF" class="Estilo2" align="left">Fecha Entrega FO:</td>
			<td bordercolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo3" name="fecha_en_fo" type="text" id="fecha_en_fo" value="<?=$array_a['fecha_en_fo']?>" readonly="readonly" /></td>
			<td bordercolor="#CAE4FF" class="Estilo2">&nbsp;</td>
			<td bordercolor="#CAE4FF" class="Estilo2">&nbsp;</td>
		</tr>

		<tr><td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo4" align="left" colspan='6'>&nbsp;</td></tr>
		<tr bgcolor="#999999"><td colspan="6" height="4"></td></tr>
		
		<!-- INICIO PESTAÑA -- ANEXOS -->
		<table width="100%"><tr><td bgcolor="#CAE4FF" align="center">
			<table width='80%' border='2' align='center' cellspacing='1' bordercolor='#666666' bgcolor='#CAE4FF'>
				<tr bordercolor='#CAE4FF' bgcolor='#66CCFF'><td colspan="5" bordercolor='#FFFFFF' bgcolor='#72A6F3'><center><h4>Archivos Cargados</h4></center></td></tr>
	
				<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>
					<td height="19" bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>No.</h5></center></td>
					<td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>Archivo</h5></center></td>
					<td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>Fecha</h5></center></td>
					<td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>Tama&#328;o</h5></center></td>
				</tr>
				
				<?php 
				// Consulta de Archivos
				$ruta = getcwd()."\\archivos\\Proyectos_fo";
				$ruta_B = getcwd()."\\archivos\\OTs\\OT_fo";
				
				$nom_arch1 = $_REQUEST['ref_sisa_a']."_PROYECTO_FO_LADO".$_REQUEST['envia_punta'];
				$nom_arch2 = $_REQUEST['ref_sisa_a']."_MEMTECNICA_FO_LADO".$_REQUEST['envia_punta'];
				$nom_arch3 = $_REQUEST['ref_sisa_a']."_OT_MISCELANEOS_LADO".$_REQUEST['envia_punta'];
				$nom_arch4 = $_REQUEST['ref_sisa_a']."_TRAB_PELIGROSO_LADO".$_REQUEST['envia_punta'];
				$nom_arch5 = $_REQUEST['ref_sisa_a']."-OT-PROYECTOFO-LADO".$_REQUEST['envia_punta'];
				$nom_arch6 = $_REQUEST['ref_sisa_a']."_OT_ANEXO_LADO".$_REQUEST['envia_punta'];
				
				exec ("dir /B /O$dir1$orden \"$ruta\\".$nom_arch1."*\"",$archivos);
				exec ("dir /B /O$dir1$orden \"$ruta\\".$nom_arch2."*\"",$archivos);
				exec ("dir /B /O$dir1$orden \"$ruta\\".$nom_arch3."*\"",$archivos);
				exec ("dir /B /O$dir1$orden \"$ruta\\".$nom_arch4."*\"",$archivos);
				exec ("dir /B /O$dir1$orden \"$ruta_B\\".$nom_arch5."*\"",$archivos);
				exec ("dir /B /O$dir1$orden \"$ruta_B\\".$nom_arch6."*\"",$archivos);
				
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
				</tr>";
				}
				?>
			</table>
		</td></tr></table>
		<!-- FIN PESTAÑA -- ANEXOS -->
		
	</table>
	
<?PHP } // FIN FIBRA OPTICA ?>





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
