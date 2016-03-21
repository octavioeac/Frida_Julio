<table width="100%" border="2" bordercolor='#666666' bgcolor='#CAE4FF' >
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
	
	<table width="100%" border="2" bordercolor='#666666' bgcolor='#CAE4FF' >
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
			<td align="left" bordercolor="#CAE4FF" class="Estilo2"><input class="Estilo1" name="pes" type="text" id="pes" value="<?=$array_a['pes']?>" readonly="readonly" /></td>
			<td bordercolor="#CAE4FF" class="Estilo2" align="left">NCO/ROF:</td>
			<td bordercolor="#CAE4FF" align="left"><input class="Estilo1" name="nco" type="text" id="nco" value="<?=$array_a['nco']?>" readonly="readonly" /></td>
			<td bordercolor="#CAE4FF" class="Estilo2" align="left">Anillo:</td>
			<td bordercolor="#CAE4FF" align="left"><input class="Estilo1" name="anillo_rof" type="text" id="anillo_rof" value="<?=$array_a['anillo_rof']?>" readonly="readonly" /></td>
		</tr>
		
		<tr>
			<td bordercolor="#CAE4FF" class="Estilo2" align="left">Longitud Trabajo:</td>
			<td bordercolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" name="longitud_trab" type="text" id="longitud_trab" value="<?=$array_a['longitud_trab']?>" readonly="readonly" /></td>
			<td height="24" bordercolor="#CAE4FF" class="Estilo2" align="left">Atenuacion Trabajo: </td>
			<td bordercolor="#CAE4FF" align="left"><input class="Estilo1" name="atenuacion_trab" type="text" id="atenuacion_trab" value="<?=$array_a['atenuacion_trab']?>" readonly="readonly" /></td>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
		</tr>
		
		<tr>
			<td bordercolor="#CAE4FF" class="Estilo2" align="left">Longitud Respaldo:</td>
			<td bordercolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" name="longitud_resp" type="text" id="longitud_resp" value="<?=$array_a['longitud_resp']?>" readonly="readonly" /></td>
			<td bordercolor="#CAE4FF" class="Estilo2" align="left">Atenuacion Respaldo: </td>
			<td bordercolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" name="atenuacion_resp" type="text" id="atenuacion_resp" value="<?=$array_a['atenuacion_resp']?>" readonly="readonly" /></td>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
		</tr>
		  
		<tr bgcolor="#999999">
			<td colspan="6">
			<!-- INICIO de FO -->
			<table width="100%">
				<tr>
					<td colspan="12" bordercolor="#CAE4FF" bgcolor="#CAE4FF"><p><div style="color:#CC0000;font-family:Verdana,Arial,Helvetica,sans-serif;  font-size:11px;  font-weight:bold;" align="center">AGREGAR TRAYECTO DE FIBRA OPTICA <?php echo $_REQUEST['ref_sisa_a'] ; ?> PUNTA <? echo $_REQUEST['envia_punta'];?></div></p></td>
				</tr>
				<tr>
					<td colspan="12" bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left">Tipo<input id="tipo" name="tipo" type="text" size="15" value="<?=$array_a['tipo']?>" readonly="readonly" /></td>
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
					<td width="10%" align="center" bgcolor="#CAE4FF" class="Estilo58"><?php if($VCL_A=='OK'){echo "Cliente"; }elseif($VCN_A=='OK'){echo "Central";}?><br /><input id="A" name="A" type="text" size="9" value="<?php if($VCN_A=='OK'){echo mysql_result($query_o,$i,'central_a');} elseif($VCL_A=='OK'){echo mysql_result($query_o,$i,'cliente');} ?>" /></td>
					<td width="8%" align="center" bgcolor="#CAE4FF" class="Estilo58">Nombre Cable<br /><input id="B" name="B" type="text" size="9" value="<?=mysql_result($query_o,$i,'cable')?>" /></td>
					<td width="7%" align="center" bgcolor="#CAE4FF" class="Estilo58">Ubicacion<br /><input type='text' id='C' name='C' value='<?=mysql_result($query_o,$i,'ubicaciona')?>' size='11' readonly='readonly'></td>
					<td width="7%" align="center" bgcolor="#CAE4FF" class="Estilo58"><?PHP if ($VCL_A=='OK'){ ?> Cap Cable<br /><input type='text' id='D' name='D' value='<?=mysql_result($query_o,$i,'cap_cable')?>' size='3' readonly='readonly'><?php } else { echo "&nbsp;"; }?></td>
					<td width="7%" align="center" bgcolor="#CAE4FF" class="Estilo58"><?PHP if ($VCL_A=='OK'){ ?>Long (M)<br /><input name="E" type="text" id="E" size="3" value="<?=mysql_result($query_o,$i,'longitud')?>"/><?php } else { echo "&nbsp;"; }?></td>
					<td width="10%" align="center" bgcolor="#CAE4FF" class="Estilo58"><?PHP if ($VCL_A=='OK'){ ?>Tipo FO<br /><input name="F" type="text" id="F" size="9" value="<?=mysql_result($query_o,$i,'tipo_jumper')?>"/><?php } else { echo "&nbsp;"; }?></td>
					<td width="8%" align="center" bgcolor="#CAE4FF" class="Estilo58">Repisa<br /><input name="G" type="text" id="G" size="3" value="<?=mysql_result($query_o,$i,'repisa_a')?>" /></td>
					<td width="9%" align="center" bgcolor="#CAE4FF" class="Estilo58">Remate<br /><input name="H" type="text" id="H" size="3" value="<?=mysql_result($query_o,$i,'remate_a')?>" /></td>
					<td width="9%" align="center" bgcolor="#CAE4FF" class="Estilo58">Remate<br /><input name="K" type="text" id="K" size="9" value="<?=mysql_result($query_o,$i,'pedido45')?>" /></td>
					<td width="8%" align="center" bgcolor="#CAE4FF" class="Estilo58">F1<br /><input name="I" type="text" id="I" size="3" value="<?=mysql_result($query_o,$i,'fibra_a')?>" /></td>
					<td width="8%" align="center" bgcolor="#CAE4FF" class="Estilo58">F2<br /><input name="J" type="text" id="J" size="3" value="<?=mysql_result($query_o,$i,'fibra_b')?>" /></td>
				</tr>
				<?php		
					}
				?>
						
				<tr><td colspan="10" bgcolor="#CAE4FF"></td></tr>
			</table>
			<!-- FIN de FO -->		</td>
		</tr>
	
		<tr><td colspan="6" bordercolor="#CAE4FF" bgcolor="#CAE4FF"></td></tr>
		
		<tr>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">FO Construccion Estatus: </td>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left"><input class="Estilo1" name="estatus_const_fo" type="text" id="estatus_const_fo" value="<?=$array_a['estatus_const_fo']?>" readonly="readonly" /></td>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Problematica:</td>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" name="dependencia_construccion" type="text" id="dependencia_construccion" value="<?=$array_a['dependencia_construccion']?>" readonly="readonly" /></td>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Supervisor Cons:</td>
			<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left"><input class="Estilo1" name="supervisor_const" type="text" id="supervisor_const" value="<?=$array_a['supervisor_const']?>" readonly="readonly" /></td>
		</tr>
		
		<tr>
			<td bordercolor="#CAE4FF" class="Estilo2" align="left">Fecha Remate FO: </td>
			<td bordercolor="#CAE4FF" align="left"><input class="Estilo1" name="fecha_remate_fo" type="text" id="fecha_remate_fo" value="<?=$array_a['fecha_remate_fo']?>" readonly="readonly" /></td>
			<td bordercolor="#CAE4FF" class="Estilo2" align="left">Fecha Entrega FO:</td>
			<td bordercolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" name="fecha_en_fo" type="text" id="fecha_en_fo" value="<?=$array_a['fecha_en_fo']?>" readonly="readonly" /></td>
			<td bordercolor="#CAE4FF" class="Estilo2">&nbsp;</td>
			<td bordercolor="#CAE4FF" class="Estilo2">&nbsp;</td>
		</tr>
		<tr bgcolor="#999999"><td colspan="6" height="4"></td></tr>
		
		<tr><td colspan="6" bordercolor="#CAE4FF" bgcolor="#CAE4FF">
			
		</td></tr>
	</table>
</table>
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
