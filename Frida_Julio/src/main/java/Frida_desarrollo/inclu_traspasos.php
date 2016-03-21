
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<?php 

$V_tipo_rtas = $spanTipoTras;
$V_tipo = $array_a['tipo'];
/*echo "<script> window.open('ot_FibraOptica.php?refSisa=".$_REQUEST['ref_sisa_a']."&prioridad=".$array_t['prioridad']."&lado=".$_REQUEST['envia_punta']."&tipo_tray=".$array_t['tipo']."   '); document.solicita.alerta.value='3'; document.solicita.validacion.value=''; document.solicita.submit(); </script>"; */

// CONSULTA TRANSPASOS
$query_trasA = "SELECT 
	consecutivo, longitud, fibra_a, fibra_b,
	fibra_a2, fibra_b2, tipo_conector_a, tipo_conector_b, proveedor,
	central_a, cm, ubicaciona, 
	central_b, cm_b, ubicacionb,
	tipo_trayec,tipo_fo,estatus_ot_tras,id, pedido45, tipo_trab1, tipo_trab2
FROM inventario_bdfo WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."' AND tipo_tras='".$V_tipo_rtas."' ORDER BY  consecutivo";
$res_trasA = mysql_query($query_trasA);



//fibra_a2, fibra_b2, tipo_conector_a, tipo_conector_b, proveedor
?>
<input name="consecutivo_B" type="hidden" value="<?=$consecutivo_B?>"/>
<input name="longitud_B" type="hidden" value="<?=$longitud_B?>"/>
<input name="tras_save" type="hidden" value="<?=$tras_save?>"/>
<input name="tras_del" type="hidden" value="<?=$tras_del?>"/>
<input name="tras_ot" type="hidden" value="<?=$tras_ot?>"/>
<input name="tras_update" type="hidden" value="<?=$tras_update?>"/>
<table class="fibraOptica"><a name="ancla_tras"></a>
	<?php if($array_a['tipo_fo']!='' && $sel_traspa=='') $sel_traspa=$array_a['tipo_fo'];?>
	<tr>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" colspan="6">
		Tipo
			<select name="tipo" id="tipo" onChange="document.solicita.modificacion.value='1a'; document.solicita.submit();">
				<?php if ($array_a['tipo']=='' && $tipo=='')$s='selected';else $s='';?><option value="" <?php echo $s;?>></option>
				<?php if ($array_a['tipo']=='1+1' || $tipo=='1+1')$s='selected';else $s='';?><option value="1+1" <?php echo $s;?>>1+1</option>
				<?php if ($array_a['tipo']=='1+0 TRABAJO' || $tipo=='1+0 TRABAJO')$s='selected';else $s='';?><option value="1+0 TRABAJO" <?php echo $s;?>>1+0 TRABAJO</option>
				<?php if ($array_a['tipo']=='1+0 RESPALDO' || $tipo=='1+0 RESPALDO')$s='selected';else $s='';?><option value="1+0 RESPALDO" <?php echo $s;?>>1+0 RESPALDO</option>
			</select>
		<?php 
			if($tipo!='' && $array_a['tipo']=='')
			{
				mysql_query("UPDATE construccion_fo SET tipo='".$tipo."' WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."'"); 
			}
		?>
		Tipo de Fibra:
		<select name="sel_traspa" id="sel_traspa" onchange="submit();">
			<?php
			if ($sel_traspa==''){$s='selected';}else $s=''; echo "<option value='' $s >---</option>";
			if ($sel_traspa=='MONOMODO'){$s='selected';}else $s=''; echo "<option value='MONOMODO' $s >MONOMODO</option>";
			if ($sel_traspa=='MULTIMODO'){$s='selected';}else $s=''; echo "<option value='MULTIMODO' $s >MULTIMODO</option>";
			?>
		</select>
		<?php
		if($array_a['tipo_fo']=='' && $sel_traspa!='')
			{ 
				mysql_query("UPDATE construccion_fo SET tipo_fo='".$sel_traspa."' WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."' ");
				echo "<script>submit();</script>";
			}
		if($array_a['tipo_fo']!='') $sel_traspa=$array_a['tipo_fo'];
		?>		</td>
	</tr>
	
	<tr><td colspan="19" class="tituloRojo">AGREGAR TRASPASO DE FIBRA OPTICA <?php echo $_REQUEST['ref_sisa_a'];?> PUNTA <?php echo $_REQUEST['envia_punta']; ?></td></tr>
	
	<tr>
		<td>&nbsp;</td>
		<td>No</td>
		<td></td>
		<td>Ubicacion</td>
		<td>F1,F2/Puertos</td>
		<td>&nbsp;</td>
		<td>Tipo de<br /> 
	    Conector</td>
		<!--<td><?php if ($_REQUEST['sel_tipo']=='CENTRAL'){?>Central<?PHP } elseif($_REQUEST['sel_tipo']=='CLIENTE'){?>Cliente<?PHP } ?></td>
		<td><?php if ($_REQUEST['sel_tipo']=='CENTRAL'){?>Cm<?PHP }?></td>-->
		<td></td>
		<td>Ubicacion</td>
		<!--<td>F1,F2/Puertos</td>-->
		<td>&nbsp;</td>
		<td>Tipo de<br /> 
	    Conector</td>
		<!--<td><?php if ($_REQUEST['sel_tipo']=='CENTRAL'){?>Central<?PHP } elseif($_REQUEST['sel_tipo']=='CLIENTE'){?>Cliente<?PHP } ?></td>
		<td><?php if ($_REQUEST['sel_tipo']=='CENTRAL'){?>Cm<?PHP }?></td>-->
		<td>Proveedor</td>
		<td>Longitud<br />(M)</td>
		<td>Pedido 45 </td>
		<td>&nbsp;</td>
		<td>Agregar/<br />Insertar</td>
	</tr>

	<tr>
	  	<td>
		<select name="sel_tipo" id="sel_tipo" onchange="submit();">
			<?php if ($_REQUEST['sel_tipo']==''){$s='selected';}else {$s='';}?><option value="" <?php echo $s;?>>--  --</option>
			<?php 
			if($tipo=='1+1' || $tipo=='1+0 TRABAJO')
			{
				  if ($_REQUEST['sel_tipo']=='CLIENTE(TRABAJO)'){$s='selected';}else {$s='';}?><option value="CLIENTE(TRABAJO)" <?php echo $s;?>>CLIENTE(TRABAJO)</option>
			<?php if ($_REQUEST['sel_tipo']=='CENTRAL(TRABAJO)'){$s='selected';}else {$s='';}?><option value="CENTRAL(TRABAJO)" <?php echo $s;?>>CENTRAL(TRABAJO)</option>
			<?php } 
			if($tipo=='1+1' || $tipo=='1+0 RESPALDO'){?>
			<?php if ($_REQUEST['sel_tipo']=='CLIENTE(RESPALDO)'){$s='selected';}else {$s='';}?><option value="CLIENTE(RESPALDO)" <?php echo $s;?>>CLIENTE(RESPALDO)</option>
			<?php if ($_REQUEST['sel_tipo']=='CENTRAL(RESPALDO)'){$s='selected';}else {$s='';}?><option value="CENTRAL(RESPALDO)" <?php echo $s;?>>CENTRAL(RESPALDO)</option>
			<?php } ?>
		</select>		</td>
		<td></td><td></td>
        <td><input type='text' id='ubicacionUno' name='ubicacionUno' onclick='return popitup("ubicacion_combos.php?text=ubicacionUno")' value='<?php if($_REQUEST['ubicacionUno']!=''){echo $_REQUEST['ubicacionUno'];}?>' size='9' readonly='readonly' /></td>
        <td>
		<?php
		//Consulta para CLLI
		if($sel_tipo!='')
		{
			if($sel_tipo=='CENTRAL(TRABAJO)' || $sel_tipo=='CENTRAL(RESPALDO)') $tipo_dem='NDE';
			elseif($sel_tipo=='CLIENTE(TRABAJO)' || $sel_tipo=='CLIENTE(RESPALDO)') $tipo_dem='DDE';
		
			$query_dato_clli =mysql_query( "SELECT * FROM inventario_demarcadores WHERE nomof LIKE '%".$_REQUEST['ref_sisa_a']."-A%'  AND tipo_demarcador='".$tipo_dem."'");
			$dato_clli=mysql_result($query_dato_clli,0,'clli_adva');
		   $query_dato_clli2  =mysql_query( "SELECT * FROM inventario_puertos_demarcadores WHERE clli_adva ='".$dato_clli."' AND lado='A' and nomof='".$_REQUEST['ref_sisa_a']."'");
			//echo "SELECT * FROM inventario_puertos_demarcadores WHERE clli_adva = '".$dato_clli."'  ";
			$dato_puerto=mysql_result($query_dato_clli2,0,'puerto');
		}
		echo "<input type='text' name='dato_puerto' id='dato_puerto' value='".$dato_puerto."'>";
		
		
		
		?>
		</td>
		<td>
		<select name='tipo_trab1' id='tipo_trab1'  />
			<?php
				if($tipo_trab1=='') $sel='selected'; else $sel='';echo "<option value='' $sel ></option>";
				if($tipo_trab1=='REPISA') $sel='selected'; else $sel='';echo "<option value='REPISA' $sel >REPISA</option>";
				if($tipo_trab1=='DFO') $sel='selected'; else $sel='';echo "<option value='DFO' $sel >DFO</option>";
				if($tipo_trab1=='BDTD') $sel='selected'; else $sel='';echo "<option value='BDTD' $sel >BDTD</option>";
				if($tipo_trab1=='GESTION') $sel='selected'; else $sel='';echo "<option value='GESTION' $sel >GESTION</option>";
				if($tipo_trab1=='PATCH PANEL') $sel='selected'; else $sel='';echo "<option value='PATCH PANEL' $sel >PATCH PANEL</option>";
			?>
		</select>		</td>
		<td>
			<select name="tipo_conectora" id="tipo_conectora" >
				<?php 
					//for($j=1;$j<15;$j++)$pto_tr[]="pto ".$j;
					
					if($tipo_conectora=='') $sel='selected'; else $sel=''; echo "<option value='' $sel></option>";
					if($tipo_conectora=='FC') $sel='selected'; else $sel=''; echo "<option value='FC' $sel>FC</option>";
					if($tipo_conectora=='SC') $sel='selected'; else $sel=''; echo "<option value='SC' $sel>SC</option>";
					if($tipo_conectora=='LC') $sel='selected'; else $sel=''; echo "<option value='LC' $sel>LC</option>";
					if($tipo_conectora!='')if($tipo_conectora=='UTP' || in_array($f1_a,$num_f)!==TRUE) $sel='selected'; else $sel=''; echo "<option value='UTP' $sel>UTP</option>";
				?>
			</select>		</td>
		<td></td>
		<!--<td>
		<?php 
		if ($_REQUEST['sel_tipo']=='CENTRAL(TRABAJO)' || $_REQUEST['sel_tipo']=='CENTRAL(RESPALDO)'){
			$fibraUno=$array_a['central_acceso'];
			$siglasUno=$array_a['sigcent'];
		} 
		elseif($_REQUEST['sel_tipo']=='CLIENTE(TRABAJO)' || $_REQUEST['sel_tipo']=='CLIENTE(RESPALDO)'){
			$fibraUno=$array_a['cliente_comun'];
		} 
		if ($_REQUEST['sel_tipo']=='CENTRAL(TRABAJO)' || $_REQUEST['sel_tipo']=='CENTRAL(RESPALDO)'){
			$cmUno=$array_a['cm']; 
		} 
		elseif($_REQUEST['sel_tipo']=='CLIENTE(TRABAJO)' || $_REQUEST['sel_tipo']=='CLIENTE(RESPALDO)'){
		 	$cmUno="N/A";
			
		 } 
		 ?>
		</td>-->
		<td><input type='text' id='ubicacionDos' name='ubicacionDos' onclick='return popitup("ubicacion_combos.php?text=ubicacionDos")' value='<?php if($_REQUEST['ubicacionDos']!=''){echo $_REQUEST['ubicacionDos'];}?>' size='9' readonly='readonly' /></td>
		<!--<td>
		</td>-->
		<td>
		<select name="tipo_trab2" id="tipo_trab2" >
			<?php
				if($tipo_trab2=='') $sel='selected'; else $sel='';echo "<option value='' $sel ></option>";
				if($tipo_trab2=='REPISA') $sel='selected'; else $sel='';echo "<option value='REPISA' $sel >REPISA</option>";
				if($tipo_trab2=='DFO') $sel='selected'; else $sel='';echo "<option value='DFO' $sel >DFO</option>";
				if($tipo_trab2=='BDTD') $sel='selected'; else $sel='';echo "<option value='BDTD' $sel >BDTD</option>";
				if($tipo_trab2=='GESTION') $sel='selected'; else $sel='';echo "<option value='GESTION' $sel >GESTION</option>";
				if($tipo_trab2=='PATCH PANEL') $sel='selected'; else $sel='';echo "<option value='PATCH PANEL' $sel >PATCH PANEL</option>";
			?>
		</select>		</td>
		<td>
			<select name="tipo_conectorb" id="tipo_conectorb" >
				<?php 
					if($tipo_conectorb=='')   $sel='selected'; else $sel=''; echo "<option value='' $sel></option>";
					if($tipo_conectorb=='FC') $sel='selected'; else $sel=''; echo "<option value='FC' $sel>FC</option>";
					if($tipo_conectorb=='SC') $sel='selected'; else $sel=''; echo "<option value='SC' $sel>SC</option>";
					if($tipo_conectorb=='LC') $sel='selected'; else $sel=''; echo "<option value='LC' $sel>LC</option>";
					if($tipo_conectorb!='')if($tipo_conectorb=='UTP' || in_array($f1_a,$num_f)!==TRUE) $sel='selected'; else $sel=''; echo "<option value='UTP' $sel>UTP</option>";
				?>
			</select>		</td>
		<!--<td>
		<?php 
			if ($_REQUEST['sel_tipo']=='CENTRAL(TRABAJO)' || $_REQUEST['sel_tipo']=='CENTRAL(RESPALDO)'){
				$fibraDos=$array_a['central_acceso'];
				$siglasDos=$array_a['sigcent'];
			}
			elseif($_REQUEST['sel_tipo']=='CLIENTE'){
				$fibraDos=$array_a['cliente_comun'];
			} 
		if ($_REQUEST['sel_tipo']=='CENTRAL(TRABAJO)' || $_REQUEST['sel_tipo']=='CENTRAL(RESPALDO)'){
		$cmDos=$array_a['cm'];
		} 
		elseif($_REQUEST['sel_tipo']=='CLIENTE'){
			$cmDos="N/A";
		} ?>
		</td>-->
		<td>
			<select name="proveedor_tras" id="proveedor_tras" >
				<?php 
					$query_prov=mysql_query("SELECT * FROM cat_proveedor WHERE tipo_trabajo LIKE 'TRASPASOS%'");
					if($proveedor_tras=='') $sel='selected'; else $sel=''; echo "<option value='' $sel></option>";
					while($row_prov = mysql_fetch_array($query_prov))
					{
						if($proveedor_tras==$row_prov['nombre_proveedor']) $sel='selected'; else $sel=''; 
						echo "<option value='".$row_prov['nombre_proveedor']."' $sel>".$row_prov['nombre_proveedor']."</option>";
					}
				?>
			</select>		</td>
		<td><input  type="text"  name="longitud_tras" id="longitud_tras" size="3" value="<?=$longitud_tras?>" /></td>
		<td><input  type="text"  name="pedido_tras" id="pedido_tras" size="10" value="<?=$pedido_tras?>" /></td>
		<td>&nbsp;</td>
		<td>	
		<img src="images/add.png" onclick="document.solicita.tras_save.value='1';submit();" />
		<img src="images/upload.png" onclick="window.open('cambio_estatus_ot.php?v=2&ref_sisa=<?php echo $_REQUEST['ref_sisa_a'];?>&longitud='+document.getElementById('longitud_tras').value+'&ubicacionA=<?php echo $ubicacionUno;?>&ubicacionB=<?php echo $ubicacionDos;?>&fibraA=<?php echo $dato_puerto;?>&fibraB=<?php echo $f1_a2;?>&cmUno=<?php echo $cmUno;?>&cmDos=<?php echo $cmDos?>&punta=<?php echo $_REQUEST['envia_punta'];?>&sel_tipo=<?php echo $sel_tipo;?>&tipo_tras=<?php echo $V_tipo_rtas;?>&tipo=<?php echo $array_a['tipo'];?>&conectora=<?php echo $tipo_conectora;?>&conectorb=<?php echo $tipo_conectorb; ?>&proveedor=<?php echo $proveedor_tras;?>&tipo_fo=<?php echo $array_a['tipo_fo'];?>&division=<?php echo $array_a['division'];?>&fibraUno=<?php echo $fibraUno; ?>&siglasUno=<?php echo $siglasUno; ?>&fibraDos=<?php echo $fibraDos; ?>&siglasDos=<?php echo $siglasDos;?>&pedido='+document.getElementById('pedido_tras').value+'&tipo_trab1=<?php echo $tipo_trab1;?>&tipo_trab2=<?php echo $tipo_trab2;?>','estatus','height=180,width=400');" />		</td>
		</tr>
		
		<tr><td colspan="19" class="titulo">Trayectos Cargados en la BD</td></tr>
		
		<?PHP
		$num_trasA = mysql_num_rows($res_trasA);
		for ($i=0; $i<$num_trasA; $i++){
		
		$B_cons = mysql_result($res_trasA,$i,'consecutivo'); 
		$B_enlace = mysql_result($res_trasA,$i,'tipo_trayec');
		$B_central_a = mysql_result($res_trasA,$i,'central_a');
		$B_central_b = mysql_result($res_trasA,$i,'central_a');
		$B_cm = mysql_result($res_trasA,$i,'cm');
		$B_cm_b = mysql_result($res_trasA,$i,'cm_b');
		
		$con_longitudB = 'longitud_update_'.$B_cons;
		$con_pedido= 'pedido_'.$B_cons;
		$con_ubiA= 'ubicaA_'.$B_cons;
		$con_ubiB= 'ubicaB_'.$B_cons;
		$con_conecA= 'conecA_'.$B_cons;
		$con_conecB= 'conecB_'.$B_cons;
		$con_prov= 'prov_'.$B_cons;
		$con_fibA= 'fibrasA_'.$B_cons;
		$con_fibB= 'fibrasB_'.$B_cons;
		$con_ttA= 'ttA_'.$B_cons;
		$con_ttB= 'ttB_'.$B_cons;
		
		//Ubicacion F1 F2 Tipo de Conector   Ubicacion F1 F2 Tipo de Conector  proveedor longitud
		?>
		<tr>
		<td align="right">
		<?php 
			if($$con_longitudB=='') $$con_longitudB=mysql_result($res_trasA,$i,'longitud');
			if($$con_pedido=='') $$con_pedido=mysql_result($res_trasA,$i,'pedido45');
			if($$con_ubiA=='') $$con_ubiA=mysql_result($res_trasA,$i,'ubicaciona');
			if($$con_ubiB=='') $$con_ubiB=mysql_result($res_trasA,$i,'ubicacionb');
			if($$con_conecA=='') $$con_conecA=mysql_result($res_trasA,$i,'tipo_conector_a');
			if($$con_conecB=='') $$con_conecB=mysql_result($res_trasA,$i,'tipo_conector_b');
			if($$con_prov=='') $$con_prov=mysql_result($res_trasA,$i,'proveedor');
			if($$con_fibA=='') $$con_fibA=mysql_result($res_trasA,$i,'fibra_a');
			//if($$con_fibB=='') $$con_fibB=mysql_result($res_trasA,$i,'fibra_a2')." , ".mysql_result($res_trasA,$i,'fibra_b2');
			if($$con_ttA=='') $$con_ttA=mysql_result($res_trasA,$i,'tipo_trab1');
			if($$con_ttB=='') $$con_ttB=mysql_result($res_trasA,$i,'tipo_trab2');
			
			
			if(mysql_result($res_trasA,$i,'estatus_ot_tras')!='LIQUIDADA')
			{
		?>
		<input name="orden_<? echo $B_cons;?>" type="checkbox" value="<? echo $B_cons;?>" /><?php } ?><input readonly="readonly" class="Estilo13" type="text" size="20" id="sel_tipoB" value="<?php echo $B_enlace; ?>"/>		</td>
		<td><input readonly="readonly" class="Estilo13" type="text" size="3"  id="<?php echo 'consB[$i]';?>" value="<? echo $B_cons;?>"/></td>
		<td><input name="text5" type="text" class="Estilo13" id="central1B" value="<?=$B_central_a?>" size="9" readonly="readonly" /></td>
		<td><input type='text' id="<?php echo $con_ubiA;?>" name="<?php echo $con_ubiA;?>" onclick='return popitup("ubicacion_combos.php?text=<?php echo $con_ubiA;?>")' value='<?php echo $$con_ubiA; ?>' size='9'  /></td>
		
		<td><input type="text" name="<?php echo $con_fibA;?>" id="<?php echo $con_fibA;?>" value="<?php echo $con_fibA;?>"></td>
		
		<td><input type='text' id="<?php echo $con_ttA;?>" name="<?php echo $con_ttA;?>" value='<?=$$con_ttA;?>' size='13' ></td>
		<td><input name="<? echo $con_conecA;?>" type="text" id="<? echo $con_conecA;?>" value="<?=$$con_conecA?>" size="3" /></td>
		<td><input name="text5" type="text" class="Estilo13" id="central2B" value="<?=$B_central_b?>" size="9" readonly="readonly" /></td>
		<td><input type='text' id="<?php echo $con_ubiB;?>" name="<?php echo $con_ubiB;?>" onclick='return popitup("ubicacion_combos.php?text=<?php echo $con_ubiB;?>")' value='<?php echo $$con_ubiB; ?>' size='9'  /></td>
		<!-- -->
		<td><input type='text' id="<?php echo $con_ttB;?>" name="<?php echo $con_ttB;?>" value='<?=$$con_ttB;?>' size='13' ></td>
		<td><input name="<? echo $con_conecB;?>" type="text"  id="<? echo $con_conecB;?>" value="<?=$$con_conecB?>" size="3" /></td>

		<td><input  type="text" name="<?php echo $con_prov; ?>" id="<?php echo $con_prov; ?>" value="<?=$$con_prov; ?>" size="20" /></td>
		<td><input name="<?php echo $con_longitudB; ?>" type="text" id="<?php echo $con_longitudB; ?>" value="<?=$$con_longitudB?>" size="3" /></td>
		<td><input name="<?php echo $con_pedido; ?>" type="text" id="<?php echo $con_pedido; ?>" value="<?=$$con_pedido?>" size="10" /></td>
		<td><a href="javascript:abrir_ventana('cambio_estatus_ot.php?id=<?php echo mysql_result($res_trasA,$i,'id');?>','350','250')" >
		<?php if(mysql_result($res_trasA,$i,'estatus_ot_tras')!='') echo "OT ".mysql_result($res_trasA,$i,'estatus_ot_tras'); ?>
		</a></td>
		<td>
		<!-- Modificar -->
		<?php 
		if(mysql_result($res_trasA,$i,'estatus_ot_tras')!='LIQUIDADA')
		{?>
		<img src="images/save.png" name="update" onclick="
		document.solicita.consecutivo_B.value='<? echo $B_cons; ?>';
		document.solicita.tras_update.value='1'; 
		submit();" />
		<!-- Borrar --->
		<img src="images/erase.png" name="del" onclick="document.solicita.consecutivo_B.value='<? echo $B_cons; ?>'; document.solicita.tras_del.value='1'; envia('ancla_tras');" /></td>
		<?php 
		}?>
		</tr>
	<?PHP
		} // FIN FOR
	?>
	<tr><td></td></tr>
	<tr>
			<td align="center" colspan="10">
			<input type="button" name="ordena_ot"  value="Generar OT" onclick="document.solicita.tras_ot.value='1';envia('ancla_tras');"/>			</td>
	</tr>
</table>
<?php
//if($_REQUEST['tras_save']=='1' || $_REQUEST['tras_save']=='2') //ALTA
if($_REQUEST['tras_save']=='1')
	{
		if($sel_tipo=='' || $longitud_tras=='' || $ubicacionUno=='' || $ubicacionDos=='' || $dato_puerto=='' || $f1_a2=='' || $tipo_conectora=='' || $tipo_conectorb=='' || $proveedor_tras=='' || $tipo_trab1=='' || $tipo_trab2=='')
		/*if($sel_tipo=='')*/ { echo "<script>document.solicita.tras_save.value='';alert('INFORMACION INCOMPLETA');document.solicita.submit();</script>";}
		else
		{
		
				$consecutivo=0;
				$cons="SELECT consecutivo+1 FROM inventario_bdfo WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."' AND tipo_tras='".$V_tipo_rtas."' ORDER BY consecutivo DESC limit 1";
				$res=mysql_query($cons);
				if(mysql_num_rows($res)>0)	$consecutivo=mysql_result($res,0,0);
				
				//$fib1=explode(" , ",$f1_a);
				//$fib2=explode(" , ",$f1_a2);
				
				$inserta="INSERT INTO inventario_bdfo(
						ref_sisa, consecutivo, longitud, 
						central_a, siglas_a, central_b, siglas_b, 
						ubicaciona, ubicacionb, fibra_a, fibra_b, 
						cm, cm_b, punta, tipo_trayec, tipo_tras, tipo_sel, estatus, 
						fibra_a2, fibra_b2, tipo_conector_a, tipo_conector_b, proveedor,
						tipo_fo,
						division, pedido45, tipo_trab1, tipo_trab2
							)VALUES( 
						'".$_REQUEST['ref_sisa_a']."', $consecutivo, '$longitud_tras',
						'$fibraUno', '$siglasUno' ,'$fibraDos', '$siglasDos', 
						'$ubicacionUno', '$ubicacionDos','".$dato_puerto."' , '',
						'$cmUno','$cmDos', '".$_REQUEST['envia_punta']."', '$sel_tipo', '".$V_tipo_rtas."', '".$array_a['tipo']."', 'DISPONIBLE',
						'', '', '$tipo_conectora', '$tipo_conectorb', '$proveedor_tras',
						'".$array_a['tipo_fo']."',
						'".$array_a['division']."', '$pedido_tras', '".$tipo_trab1."', '".$tipo_trab2."'
						)";
				mysql_query($inserta);
				
				if(mysql_affected_rows()>0)echo "<script>document.solicita.tras_save.value='';document.solicita.sel_tipo.value='';document.solicita.longitud_tras.value='';document.solicita.ubicacionUno.value='';document.solicita.ubicacionDos.value='';document.solicita.dato_puerto.value='';document.solicita.f1_a2.value='';document.solicita.tipo_conectora.value='';document.solicita.tipo_conectorb.value='';document.solicita.proveedor_tras.value='';document.solicita.pedido_tras.value='';document.solicita.tipo_trab1.value='';document.solicita.tipo_trab2.value='';alert('Registro correctamente Guardado'); document.solicita.submit(); </script>";
				
		}//else
		
	}//if save_tras


if($_REQUEST['tras_update']=='1') // MODIFICACIONES
	{
			$update_lon='longitud_update_'.$consecutivo_B;
			$update_p='pedido_'.$consecutivo_B;
			$update_ubiA='ubicaA_'.$consecutivo_B;
			$update_ubiB='ubicaB_'.$consecutivo_B;
			$update_prov='prov_'.$consecutivo_B;
			$update_fibA='fibrasA_'.$consecutivo_B;
			$update_fibB='fibrasB_'.$consecutivo_B;
			$update_conA='conecA_'.$consecutivo_B;
			$update_conB='conecB_'.$consecutivo_B;
			$update_ttA='ttA_'.$consecutivo_B;
			$update_ttB='ttB_'.$consecutivo_B;
			
			$up_dato_puerto='fibrasA_'.$consecutivo_B;
			//$up_fib1=explode(" , ",$$update_fibA);
			//$ip_fib2=explode(" , ",$$update_fibB);
			
  	 		$qUpdate="UPDATE inventario_bdfo SET 
						longitud='".$$update_lon."', pedido45='".$$update_p."' , ubicaciona='".$$update_ubiA."' , ubicacionb='".$$update_ubiB."', proveedor='".$$update_prov."', fibra_a='".$up_dato_puerto."', fibra_b='' , fibra_a2='', fibra_b2='', tipo_conector_a='".$$update_conA."', tipo_conector_b='".$$update_conB."', tipo_trab1='".$$update_ttA."', tipo_trab2='".$$update_ttB."'
					WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."' AND tipo_tras='".$V_tipo_rtas."' AND consecutivo='".$consecutivo_B."'  ";
		mysql_query($qUpdate);
		if(mysql_affected_rows()>0)echo "<script>alert('Registro correctamente Modificado'); document.solicita.tras_update.value=''; document.solicita.submit(); </script>";
	}


if($_REQUEST['tras_del']=='1') // BORRAR
	{
		$qDelete="DELETE FROM inventario_bdfo WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."' AND tipo_tras='".$V_tipo_rtas."' AND consecutivo='".$consecutivo_B."'  ";
		mysql_query($qDelete);
		if(mysql_affected_rows()>0)echo "<script>alert('Registro correctamente Eliminado'); document.solicita.tras_del.value=''; document.solicita.submit(); </script>";
	}

//===========Generación de OT===============
if($_REQUEST['tras_ot']=='1')
{
		
		include('folios_funcion.php');
		
		$sql_ot=mysql_query("SELECT 
						consecutivo, longitud, fibra_a, fibra_b,
						fibra_a2, fibra_b2, tipo_conector_a, tipo_conector_b, proveedor,
						central_a, cm, ubicaciona, 
						central_b, cm_b, ubicacionb,
						tipo_trayec,tipo_sel, estatus_ot_tras, folio, pedido45, tipo_trab1, tipo_trab2
		FROM inventario_bdfo WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."' AND tipo_tras='".$V_tipo_rtas."'");
		
		//Consulta de responsable
		$sql_resp=mysql_query("SELECT cat_resp_metro.RESPONSABLE FROM cat_resp_metro INNER JOIN centrales ON centrales.edificio = cat_resp_metro.central 
		WHERE centrales.sigcent='".$row_trasot['central_a']."'");
		
		$ban_val="todos";//Validar checklist de OTs		
				
		while($row_trasot = mysql_fetch_array($sql_ot))
		{
					$ot_tipo[]=''; $ot_prov[]='';
					$check_ot="orden_".$row_trasot['consecutivo'];
					
					if($$check_ot==$row_trasot['consecutivo'])
					{
							$ban_val="";
							
							if((in_array($row_trasot['tipo_trayec'],$ot_tipo)!==TRUE) || (in_array($row_trasot['proveedor'],$ot_prov)!==TRUE))//Valida tipo de trayecto y proveedor
									{
											$ot_tipo[]=$row_trasot['tipo_trayec'];
											$ot_prov[]=$row_trasot['proveedor'];
											
											if($row_trasot['estatus_ot_tras']!='LIQUIDADA' && $row_trasot['estatus_ot_tras']=='')
											{
											
													$folio=guarda_folio ($_REQUEST['ref_sisa_a'], '', $row_trasot['proveedor'], $row_trasot['central_a'], "TRASPASOS");
		
											
													mysql_query("UPDATE inventario_bdfo SET estatus_ot_tras='GENERADA', folio='$folio' WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."' AND tipo_tras='".$V_tipo_rtas."' AND consecutivo='".$row_trasot['consecutivo']."'");
													
													/*echo "UPDATE inventario_bdfo SET estatus_ot_tras='GENERADA', folio='$folio' WHERE ref_sisa='".$_REQUEST['ref_sisa_a']."' AND punta='".$_REQUEST['envia_punta']."' AND tipo_tras='".$V_tipo_rtas."' AND consecutivo='".$row_trasot['consecutivo']."'";*/
											}
											else 	$folio=$row_trasot['folio'];
													
													$ot_nombre=$_REQUEST['ref_sisa_a']."_TRA_".$folio;
													
													$query_arch =mysql_query("INSERT INTO bitacora_archivos (referencia, fecha, usuario, accion, trafico, opcion, nom_arch, observaciones ) VALUES('".$_REQUEST['ref_sisa_a']."', NOW(), '$sess_nmb', 'CARGA ARCHIVO', 'TRASPASO', 'LADO".$_REQUEST['envia_punta']."', '".$ot_nombre."', CONCAT('|', NOW(),', USUARIO: $sess_usr',', CARGA DE ARCHIVO', observaciones )  )"); 
													
													$sql_supervisores=mysql_query("SELECT nombre, supervisor, subgerente FROM cat_tecnicos WHERE nombre='".$sess_nmb."'");
													if(mysql_affected_rows()>0)
													{ $super_ot=mysql_result($sql_supervisores,0,'supervisor'); $subg_ot=mysql_result($sql_supervisores,0,'subgerente');}
													
													/*echo "--".*/$no_ot="'".$folio."'";
													$total_ots[]=$no_ot;
													
													$array_info_ot[$no_ot]['pedido45']=$row_trasot['pedido45'];
													$array_info_ot[$no_ot]['tipo_trayec']=$row_trasot['tipo_trayec'];
													$array_info_ot[$no_ot]['asignadaA']=$row_trasot['proveedor'];
													$array_info_ot[$no_ot]['cliente']=$row_trasot['central_a'];
													$array_info_ot[$no_ot]['descripcionTrabajo']=$row_trasot['consecutivo'];
													$array_info_ot[$no_ot]['observaciones']=$row_trasot['observaciones_tras'];
													$array_info_ot[$no_ot]['noOrden']=$folio;
													$array_info_ot[$no_ot]['punta']=$_REQUEST['envia_punta'];
													$array_info_ot[$no_ot]['ubicacionA']=$row_trasot['ubicaciona'];
													$array_info_ot[$no_ot]['ubicacionB']=$row_trasot['ubicacionb'];
													$array_info_ot[$no_ot]['conectorA']=$row_trasot['tipo_conector_a'];
													$array_info_ot[$no_ot]['conectorB']=$row_trasot['tipo_conector_b'];
													$array_info_ot[$no_ot]['fa']=$row_trasot['fibra_a'];
													$array_info_ot[$no_ot]['fa1']=$row_trasot['fibra_a'];
													$array_info_ot[$no_ot]['fb']=$row_trasot['fibra_b'];
													$array_info_ot[$no_ot]['fb1']=$row_trasot['fibra_b2'];
													$array_info_ot[$no_ot]['longitud']=$row_trasot['longitud'];
													$array_info_ot[$no_ot]['razonSocial']=$array_a['cliente_sisa'];
													$array_info_ot[$no_ot]['voBo']=$super_ot;
													$array_info_ot[$no_ot]['autorizacion']=$subg_ot;
													$array_info_ot[$no_ot]['tipo_trab1']=$row_trasot['tipo_trab1'];
													$array_info_ot[$no_ot]['tipo_trab2']=$row_trasot['tipo_trab2'];
													$array_info_ot[$no_ot]['total']=0;
													
												
									}//fin val
									else
									{
													$no_ot="'".$folio."'";
												
													$array_info_ot[$no_ot]['descripcionTrabajo'].=",".$row_trasot['consecutivo'];
													$array_info_ot[$no_ot]['ubicacionA'].=",".$row_trasot['ubicaciona'];
													$array_info_ot[$no_ot]['ubicacionB'].=",".$row_trasot['ubicacionb'];
													$array_info_ot[$no_ot]['conectorA'].=",".$row_trasot['tipo_conector_a'];
													$array_info_ot[$no_ot]['conectorB'].=",".$row_trasot['tipo_conector_b'];
													$array_info_ot[$no_ot]['fa'].=",".$row_trasot['fibra_a'];
													$array_info_ot[$no_ot]['fa1'].=",".$row_trasot['fibra_a'];
													$array_info_ot[$no_ot]['fb'].=",".$row_trasot['fibra_b'];
													$array_info_ot[$no_ot]['fb1'].=",".$row_trasot['fibra_b2'];
													$array_info_ot[$no_ot]['longitud'].=",".$row_trasot['longitud'];
													$array_info_ot[$no_ot]['tipo_trab1'].=",".$row_trasot['tipo_trab1'];
													$array_info_ot[$no_ot]['tipo_trab2'].=",".$row_trasot['tipo_trab2'];
													$array_info_ot[$no_ot]['total']=$array_info_ot[$no_ot]['total'] + 1;
									}
								
					}
				
				
		}
		
		
		
		if($ban_val=="todos")	{echo "<script>document.solicita.tras_ot.value='';alert('SELECCIONE UN REGISTRO'); document.solicita.submit()</script>";}
		else
		{
				$llamar_ot=count($total_ots);
				for($i=0;$i<$llamar_ot;$i++)
				{
						$no_ot=$total_ots[$i];//folio
						
						echo "<script> window.open('orden_tras.php?refSisa=".$_REQUEST['ref_sisa_a']."&pedido45=".$array_info_ot[$no_ot]['pedido45']."&domicilio=".$array_a['domicilio']."&responsable1=".$array_a['ipr_resp_fo']."&responsable2=".$array_a['supervisor_fo']."&division=".$array_a['division']."&pep=".$array_a['pep']."&asignadaA=".$array_info_ot[$no_ot]['asignadaA']."&cliente=".$array_info_ot[$no_ot]['cliente']."&tipoServicio=".$rowSL['tipo_proyecto'].",".$rowSL['tipo_transporte'].",".$rowSL['velocidad_transporte']."&descripcionTrabajo=".$array_info_ot[$no_ot]['descripcionTrabajo']."&observaciones=".$array_info_ot[$no_ot]['observaciones']."&noOrden=".$array_info_ot[$no_ot]['noOrden']."&punta=".$_REQUEST['envia_punta']."&ubicacionA=".$array_info_ot[$no_ot]['ubicacionA']."&ubicacionB=".$array_info_ot[$no_ot]['ubicacionB']."&conectorA=".$array_info_ot[$no_ot]['conectorA']."&conectorB=".$array_info_ot[$no_ot]['conectorB']."&fa=".$array_info_ot[$no_ot]['fa']."&fa1=".$array_info_ot[$no_ot]['fa1']."&fb=".$array_info_ot[$no_ot]['fb']."&fb1=".$array_info_ot[$no_ot]['fb1']."&longitud=".$array_info_ot[$no_ot]['longitud']."&tipo_trab1=".$array_info_ot[$no_ot]['tipo_trab1']."&tipo_trab2=".$array_info_ot[$no_ot]['tipo_trab2']."&total=".$array_info_ot[$no_ot]['total']."&tipo_trayec=".$array_info_ot[$no_ot]['tipo_trayec']."');</script>";
						
						
				}
		
		}
		
		echo "<script>document.solicita.tras_ot.value=''; document.solicita.submit();</script>";
}

//================GRAFICO TRASPASOS================
include('wp/prueba_trasp2.php');
//================================

//==================Cuenta fibras
/*function cont_fibras($f, $query_trasA ){

		//central_cliente  puerto_tx
		/*for($i=1;$i<97;$i++) 
		{
			$valor_f=$i+1;
			$vf=$i." , ".$valor_f;
			$num[]=$vf;
			$i=$valor_f;
		}
		
		for($i=1;$i<16;$i++) 
		{
			$vf="PTO ".$i;
			if(in_array($i,$num2)!==TRUE) $num[]=$vf;
		}
		
		for($i=1;$i<7;$i++) 
		{
			$vf="LAN ".$i;
			if(in_array($i,$num2)!==TRUE) $num[]=$vf;
		}
		
		for($i=1;$i<3;$i++) 
		{
			$vf="WAN ".$i;
			if(in_array($i,$num2)!==TRUE) $num[]=$vf;
		}
		
		return $num;
}*/
//====
?>

<!-- FUNCION PARA ABRIR LA VENTANA DE LA UBICACION -->
<script  language="javascript" type="text/javascript">
function popitup(url)
	{
		newwindow=window.open(url,'name','height=150,width=1100'); 
		if (window.focus) {newwindow.focus()}
		return false;
	}

function textCounter(field, countfield, maxlimit)
	{
		if (field.value.length > maxlimit) 	field.value = field.value.substring(0, maxlimit);
		else countfield.value = maxlimit - field.value.length;
	}
	
	function abrir_ventana(url) {

		window.open(url,'estatus','height=180,width=400') ;

}
</script>

<script type="text/javascript">
	function val_texto()
		{
			var campo = document.getElementById('longitud_tras').value;
			alert(campo);
			return campo;
			//document.getElementById('longitud_tras').value = campo;
		}
</script>


