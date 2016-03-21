<?php
  include ("perfiles.php");
    require("conexion.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />

<script type="text/javascript" src="./js/domtab.js"></script>
<link rel="stylesheet" type="text/css" href="./css/domtab2a.css"></link>

<style type="text/css">
	<!--
	.Estilo2 {font-size: 10px}
	.Estilo3 {font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif; }
	.Estilo4 {color: #000099; font-weight: bold; }
	.Estilo6 {color: #000066; font-weight: bold; }
	.Estilo28 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
	.Estilo30 {font-size: 12px; color: #000066; }
	.Estilo31 {color: #000066; }
	.Estilo36 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000066; }
	.Estilo38 {color: #000066; font-weight: bold; }
	.Estilo40 {color: #0000FF; font-weight: bold; font-size: 14px; }
	.Estilo41 {font-size: 10px; }
	.Estilo42 {font-size: 9px; }
	.Estilo43 {font-size: 11px; }
	.Estilo44 {color: #003399; font-weight: bold; }
	.Estilo45 {font-size: 9; }
	.Estilo46 {color: #003399; font-weight: bold; font-size: 9; }
	-->
</style>

</head>
<body>

<div id=espere style='position:absolute;top:50%;left:45%;visibility:hidden'><img src='./images/espere.gif' width=32 height=32></div> 
<div id="wrap">
<div id="header">
	<div id="logo">
		<h1><a href="grid_ordenes_se.php?areares=1">F R I D A</a></h1>
		<h2>Autorizaci&oacute;n de Informaci&oacute;n de Cluster</h2>
		<p>&nbsp;</p>
	  <p>&nbsp;</p>
    </div>
	<div id="rss"></div> 
  </div>
</div>


<?php
//-----------------------------------------------------------------------------
// ---> Obtener informacion de la orden
    $indiceTabla = array(
        'cat_anillo'        => 'id'
    );
	
	$queryOrden = "SELECT id_ot,num_ot_frida, num_intervencion, nombre_oficial_pisa, trafico, tecnico, personal_valida, causa, date_format(fecha_val, '%Y/%m/%d') as fecha_val, personal, tabla, id_tabla, estatus, observaciones, observaciones_top FROM ordenes WHERE id_ot=" . $_GET['id_ot']  . " LIMIT 1";
	//echo $queryOrden;
	
	$result = mysql_query($queryOrden);                              
	$num_results = mysql_num_rows($result);
	
	if($num_results == 0){
	   echo "<h2 align='center'>No hay datos para ese folio.</h2>"; 
	   exit();
	}
	
    $rowOrden = mysql_fetch_array($result, MYSQL_ASSOC);
    
    $tecnico=$rowOrden['tecnico'];
    
    if($rowOrden['estatus']=='LIQUIDADA'){
       exit();    
    }
    else if($rowOrden['estatus']=='EN PROCESO'){
       $en_proceso = 1;
    }
	 else if($rowOrden['estatus']=='AUTORIZADA'){
       $en_proceso = 1;
    }
  else if($rowOrden['estatus']=='VALIDADA'){
        $query = "UPDATE ordenes SET estatus='ASIGNACION DE TECNICO' WHERE id_ot=${rowOrden['id_ot']}";
        mysql_query($query);
    }	
	 echo "<h2 align='center'>".$rowOrden['estatus']."</h2><br>"; 
	
	
    $queryTecnologia = "SELECT * FROM cat_anillo WHERE anillo='".$rowOrden['nombre_oficial_pisa']."' ORDER BY id";
	//echo"<br> $queryTecnologia";
	
	$result = mysql_query($queryTecnologia);
	$rowTecnologia = mysql_fetch_array($result, MYSQL_ASSOC);

//-----------------------------------------------------------------------------
// --> Relacion Datos - Campo Formulario
	$nombre_oficial_pisa			= $rowTecnologia['anillo'];
	$anillo								= $rowTecnologia['anillo'];
	$division							= $rowTecnologia['division'];
	$area								= $rowTecnologia['area'];
	$ospf								= $rowTecnologia['ospf'];
	$proveedor_tx						= $rowTecnologia['proveedor_tx'];
	$prov_tx_nodo					= $rowTecnologia['proveedor_tx'];
	
	$tecnologia						= $rowTecnologia['tecnologia'];
	$o_login								= $rowTecnologia['login'];
	$capacidad							= $rowTecnologia['capacidad'];
	$modelo_equipo_ce 					= $rowTecnologia['repadm_conxadsl'];
	
?>

<?php echo" <div style='position:absolute;top:0;left:90%;font-size:9px;font-weight:bold;'>Usuario: $sess_nmb<br>DD: $sess_dd</div> "; ?>

<div id="wrap">

	<table width="900" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
		<tr>
			<td bordercolor="#CAE4FF" colspan="6" class="Estilo3"><span class="Estilo28"><span class="Estilo4 Estilo30">GESTION CLUSTER</span></span></td>
		</tr>
		<tr>
			<td bordercolor="#CAE4FF" class="Estilo3"><span class="Estilo28 Estilo2">Cluster</span></td>
			<?php echo "<td bordercolor='#CAE4FF' class='Estilo28'><input name='campo' type='text' id='campo' readonly='readonly' value='$anillo' /></td> "; ?>
			<td bordercolor='#CAE4FF' class="Estilo3"><span class="Estilo28 Estilo2">DD</span></td>
			<?php echo "<td bordercolor='#CAE4FF' class='Estilo28'><input name='campo' type='text' id='campo' readonly='readonly' value='$division' /></td> "; ?>
			<td bordercolor='#CAE4FF' class="Estilo3"><span class="Estilo28 Estilo2">Area</span></td>
			<?php echo "<td bordercolor='#CAE4FF' class='Estilo28'><input name='campo' type='text' id='campo' readonly='readonly' value='$area' /></td> "; ?>
		</tr>
		<tr>
			<td bordercolor='#CAE4FF' class="Estilo3"><span class="Estilo28 Estilo2">OSPF</span></td>
            
         
            
			<?php echo "<td bordercolor='#CAE4FF' class='Estilo28'><input name='campo' type='text' id='campo' readonly='readonly' value='$ospf' /></td> "; ?>
			<td bordercolor='#CAE4FF' class="Estilo3"><span class="Estilo28 Estilo2">Tecnolog&iacute;a</span></td>
			<?php echo "<td bordercolor='#CAE4FF' class='Estilo28'><input name='campo' type='text' id='campo' readonly='readonly' value='$tecnologia' /></td> "; ?>
		</tr>
		<tr>
			<td colspan='2' bordercolor='#CAE4FF' class="Estilo3"><span class="Estilo28 Estilo2">Observaciones del &aacute;rea solicitante</span></td>
			<td colspan='4' bordercolor='#CAE4FF' class='Estilo28'>
				<?php echo "<textarea name='campo' rows='5' cols='60' readonly='readonly'>".$rowOrden['observaciones_top']."</textarea>"; ?>
			</td>
		</tr>
	</table>
	
	<!-- BOTON PARA DESPLEGAR LOS ARCHIVOS -->
	<?php
		include("listarch_ce.php");
		echo '<table width="900" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">';
			echo '<tr><td bordercolor="#CAE4FF" class="Estilo28">';
				echo '<td align="center"><input type="button" name="bot_anex" value="Desplegar Archivos Anexos del Cluster '.$nombre_oficial_pisa.'" onclick="abreVentana(\''.$nombre_oficial_pisa.'\');">';
			echo '</td></tr>';
		echo '</table>';
	?>
	<table width="900" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
		<tr>
			<td width="138" bordercolor="#CAE4FF" class="Estilo3"><span class="Estilo28 Estilo2">Login</span></td>
			<?php echo "<td bordercolor='#CAE4FF' class='Estilo28'><input name='campo' type='text' id='campo' readonly='readonly' value='$o_login' /></td> "; ?>
			<td width="135" bordercolor="#CAE4FF" class="Estilo28">Ancho de Banda</td>
			<?php echo "<td bordercolor='#CAE4FF' class='Estilo28'><input name='campo' type='text' id='campo' readonly='readonly' value='$capacidad' /></td> "; ?>
		</tr>
	</table>
	
	<!-- ******************** -->
	<!-- **** INICIO TABS            -->
	<!-- ******************** -->
	
	<div class="domtab">
		<ul class="domtabs">
			<li><a href="#NODOS" class="Estilo41">NODOS</a></li>
			<li><a href="#SECCIONES" class="Estilo41">SECCIONES</a></li>
		    <?if($modelo_equipo_ce <> 'ASR9010' && $modelo_equipo_ce <>  'ASR9006'){?>
			<li><a href="#TUNELES" class="Estilo41">TUNELES</a></li>
			<?}?>
			<li><a href="#RCDT" class="Estilo41">RCDT</a></li>
			<li><a href="#FIBRAOPTICA" class="Estilo41">TRANSMISION</a></li>
			<li><a href="#CNS" class="Estilo41">CNS</a></li>
			<li><a href="#BITACORAS" class="Estilo41">BITACORAS</a></li>
		</ul>
		
	<div>
		<a name="NODOS" id="NODOS"></a>
		
		<div style="position:relative;">
			<form id="lista_nodos" name="lista_nodos" method="post" action="actualiza_autoriza_ce.php" >
			
			<table width="900" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
				<tr>
					<td colspan="3" bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">NODOS DEL CLUSTER: <?php echo $anillo; ?></span></td>
				</tr>
				<tr>
					<td colspan="6" bordercolor="#CAE4FF" class="Estilo28">&nbsp;</td>
				</tr>
				<tr>
					<td width="20%" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Identificador de Nodo</div></td>
					<td width="9%" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">IP Sistema (L0)</div></td>
					<td width="18%" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Identificador Interfase Sistema</div></td>
					<td width="9%" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">IP Gesti&oacute;n (L1)</div></td>
					<td width="18%" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Identificador Interfase Gesti&oacute;n</div></td>
					<td width="12%" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Ubicaci&oacute;n del Nodo</div></td>
					<td width="14%" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Estatus</div></td>
				</tr>
				
				
				<?php
				
				$nodo_selected						= $_GET['nodo_sel'];
				$nom_central							= $_GET['nom_central_sel'];
				$tarjeta_selected					= $_GET['tarjeta_sel'];
				$subslot_selected					= $_GET['subslot_sel'];
				
				mysql_data_seek($result, 0);
				while ($rowTecnologia = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					$id_nodo							= $rowTecnologia['id_nodo'];
					$ip_sistema						= $rowTecnologia['ip_sistema'];
					$id_inter_sistema					= $rowTecnologia['id_inter_sistema'];
					$ip_gestion							= $rowTecnologia['ip_gestion'];
					$id_inter_gestion					= $rowTecnologia['id_inter_gestion'];
					$ubi_nodo_adm					= $rowTecnologia['ubi_nodo_adm'];
					$nom_adm_conex				= $rowTecnologia['nodo_adm_conex_adsl'];
					$edo_cns							= $rowTecnologia['estatus_cns'];
					
					echo "<tr>";
						echo "<td bordercolor='#CAE4FF'>";
						
						if($id_nodo == $nodo_selected){
							$sel_opc="checked='checked'";
						}else{
							$sel_opc="";
						}
							
						echo "<input type='radio' name='s_nodo' value='$id_nodo' $sel_opc onclick='document.lista_nodos.nodo_sel.value=\"$id_nodo\";document.lista_nodos.nom_central_sel.value=\"$nom_adm_conex\";document.lista_nodos.anillo_sel.value=\"$anillo\";document.lista_nodos.id_aut_sel.value=\"1\";document.lista_nodos.ot_sel.value=".$_GET['id_ot'].";submit();' />";
						
						echo "<input class='Estilo43' name='id_nodo' type='text' id='id_nodo' readonly='readonly' size='25' value='$id_nodo' /></td> ";
						echo "<td bordercolor='#CAE4FF'><input class='Estilo43' name='ip_sistema' type='text' id='ip_sistema' readonly='readonly' size='11' value='$ip_sistema' /></td> ";
						echo "<td bordercolor='#CAE4FF'><input class='Estilo43' name='id_inter_sistema' type='text' id='id_inter_sistema' readonly='readonly' size='25' value='$id_inter_sistema' /></td> ";
						echo "<td bordercolor='#CAE4FF'><input class='Estilo43' name='ip_gestion' type='text' id='ip_gestion' readonly='readonly' size='11' value='$ip_gestion' /></td> ";
						echo "<td bordercolor='#CAE4FF'><input class='Estilo43' name='id_inter_sistema' type='text' id='id_inter_sistema' readonly='readonly' size='25' value='$id_inter_gestion' /></td> ";
						echo "<td bordercolor='#CAE4FF'><input class='Estilo43' name='ubi_nodo_adm' type='text' id='ubi_nodo_adm' readonly='readonly' size='15' value='$ubi_nodo_adm' /></td> ";
						echo "<td bordercolor='#CAE4FF' align='center' >";
						
							$ar_estado=array('GESTIONADO','POR REVISAR','RECHAZADO','VALIDADA','INFORMACION');
							
							echo "<select name='n_edo_cns' class='Estilo43' onchange='document.lista_nodos.nvo_edo_cns.value=this.value;document.lista_nodos.nodo_sel.value=\"$id_nodo\";document.lista_nodos.anillo_sel.value=\"$anillo\";document.lista_nodos.ot_sel.value=\"".$_GET['id_ot']."\";document.lista_nodos.nom_central_sel.value=\"$nom_adm_conex\";document.lista_nodos.id_aut_sel.value=\"2\";submit();' >";
							
								for ( $aa=0; $aa < 5; $aa++ ){
									if ( $ar_estado[$aa]==trim($edo_cns) ){
										$selec_edo="selected";}else{$selec_edo='';}
									echo "<option value='$ar_estado[$aa]' $selec_edo >$ar_estado[$aa]</option>";
								}
							echo '</select>';
							
						echo "</td>";
						
					echo "</tr>";
				}
				
				echo "<input type='hidden' name='ot_sel' value='' />";
				echo "<input type='hidden' name='nodo_sel' value='' />";
				echo "<input type='hidden' name='anillo_sel' value='' />";
				echo "<input type='hidden' name='nom_central_sel' value='' />";
				echo "<input type='hidden' name='nvo_edo_cns' value='' />";
				echo "<input type='hidden' name='id_aut_sel' value='' />";
				
				?>
				<tr><td bordercolor="#CAE4FF">&nbsp;</td></tr>
				</table>
				
				<!-- ******************** -->
				<!-- ****  TARJETAS -->
				<!-- ******************** -->
				<table width="900" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
					
					<?php
						echo '<tr>';
				if ($prov_tx_nodo=='ALCATEL')
						{
							echo '<td colspan="4" bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">EQUIPAMIENTO DE TARJETAS DEL NODO: '.$nodo_selected.'</span></td>';
							echo '<td colspan="2" align="right" bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">Proveedor: '.$prov_tx_nodo.'</span></td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td colspan="4" bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">CENTRAL: '.$nom_central.'</span></td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td colspan="6" bordercolor="#CAE4FF" class="Estilo28">&nbsp;</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td width="16%" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Modelo de la Tarjeta</div></td>';
							echo '<td width="18%" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Posici&oacute;n de la Tarjeta</div></td>';
							echo '<td width="14%" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">M&oacute;dulo</div></td>';
							echo '<td width="16%" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Subslot</div></td>';
							echo '<td width="18%" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Puertos 1 GB</div></td>';
							echo '<td width="18%" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Puertos 10 GB</div></td>';
						}else{
							echo '<td colspan="3" bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">EQUIPAMIENTO DE TARJETAS DEL NODO: '.$nodo_selected.'</span></td>';
							echo '<td align="right" bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">Proveedor: '.$prov_tx_nodo.'</span></td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td colspan="4" bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">CENTRAL: '.$nom_central.'</span></td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td colspan="4" bordercolor="#CAE4FF" class="Estilo28">&nbsp;</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td width="20%" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Modelo de la Tarjeta</div></td>';
							echo '<td width="20%" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Posici&oacute;n de la Tarjeta</div></td>';
							echo '<td width="30%" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Puertos 1 GB</div></td>';
							echo '<td width="30%" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Puertos 10 GB</div></td>';
							echo '<td width="10%" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Puertos 100 GB</div></td>';

							
							//if($mod_tarjeta=='ASR9000v')
							//{
								echo '<td width="20%" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Equipo</div></td>';
								echo '<td width="10%" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Ubicaci&oacute;n</div></td>';
							//}
						}
						echo '</tr>';
					?>
					
					
					<?php
					$queryTarjetas_ce = "SELECT * FROM inventario_tarjetas_ce WHERE id_nodo='$nodo_selected' AND cluster='$anillo' ORDER BY repisat, posicion_tarjeta";
					$result_t = mysql_query($queryTarjetas_ce);
					
					
					$queryTecnologia2 = "SELECT * FROM cat_anillo WHERE id_nodo='$nodo_selected' AND anillo='$anillo'";
					//echo $queryTecnologia2;
					//echo $queryTarjetas_ce;
					
					$result_tec2 = mysql_query($queryTecnologia2);
					$rowTec2 = mysql_fetch_array($result_tec2, MYSQL_ASSOC);
					$nom_adm_conex = $rowTec2['nodo_adm_conex_adsl'];
					
					while ($rowTarjetas = mysql_fetch_array($result_t, MYSQL_ASSOC))
					{
						$modelo_tarjeta					= $rowTarjetas['modelo_tarjeta'];
						$posicion_tarjeta					= $rowTarjetas['posicion_tarjeta'];
						$modulo_tarjeta					= $rowTarjetas['modulo'];
						$subslot_tarjeta					= $rowTarjetas['subslot'];
						//$ptos_1gb						= $rowTarjetas['ptos_1gb'];
						//$ptos_10gb						= $rowTarjetas['ptos_10gb'];

						#Ubicacion del equipo Satelite
						$queryUbi2      = "SELECT ubi_nodo_adm FROM cat_anillo WHERE id_nodo='$modulo_tarjeta' AND anillo_pp='$anillo'";
						$rowUbi2        = mysql_fetch_array(mysql_query($queryUbi2), MYSQL_ASSOC);
						$ubi_tarjeta	= $rowUbi2['ubi_nodo_adm'];
						
						if ($prov_tx_nodo=='ALCATEL'){
							$queryTarjetasM_ce = "SELECT modelo_tarjeta, ptos_1gb, ptos_10gb FROM cat_tarjetas_ce WHERE modelo_tarjeta='$modelo_tarjeta' AND tipo_tarjeta='$modulo_tarjeta' LIMIT 1";
						}else{
							$queryTarjetasM_ce = "SELECT modelo_tarjeta, ptos_1gb, ptos_10gb FROM cat_tarjetas_ce WHERE modelo_tarjeta='$modelo_tarjeta' LIMIT 1";
							#Puerto de 100GB
							$sqlHundred = "SELECT ptos_100gb FROM cat_tarjetas_ce WHERE  modelo_tarjeta='$modelo_tarjeta' AND tipo_tarjeta='$modulo_tarjeta' ";
						}
						//echo $queryTarjetasM_ce;
						#echo $sqlHundred;
						$result_tm = mysql_query($queryTarjetasM_ce);
						$eHundred  = mysql_query($sqlHundred);
						$rHundred  = mysql_fetch_array($eHundred);
						
						$rowTarjetasM = mysql_fetch_array($result_tm, MYSQL_ASSOC);
						$ptos_1gb							= $rowTarjetasM['ptos_1gb'];
						$ptos_10gb							= $rowTarjetasM['ptos_10gb'];
						$ptos_100gb                         = $rHundred['ptos_100gb'];  
						
						echo "<tr>";
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='modelo_tarjeta' type='text' id='modelo_tarjeta' readonly='readonly' value='$modelo_tarjeta' /></td> ";
							
							echo "<td align='center' bordercolor='#CAE4FF'>";
							if ($posicion_tarjeta == $tarjeta_selected AND $subslot_tarjeta == $subslot_selected){
								$sel_tar="checked='checked'";
							}else{
								$sel_tar="";
							}
						
							echo "<input type='radio' name='s_tarjeta' value='$posicion_tarjeta' $sel_tar onclick='document.lista_nodos.id_aut_sel.value=\"3\";document.lista_nodos.tarjeta_sel.value=\"$posicion_tarjeta\";document.lista_nodos.subslot_sel.value=\"$subslot_tarjeta\";document.lista_nodos.nodo_sel.value=\"$nodo_selected\";document.lista_nodos.ot_sel.value=\"".$_GET['id_ot']."\";document.lista_nodos.nom_central_sel.value=\"$nom_adm_conex\";submit();' />";
							
							echo "<input class='Estilo43' name='posicion_tarjeta' type='text' id='posicion_tarjeta' readonly='readonly' value='$posicion_tarjeta' /></td> ";
							
							if ($prov_tx_nodo=='ALCATEL')
							{
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='mod_tarjeta' type='text' id='mod_tarjeta' readonly='readonly' value='$modulo_tarjeta' /></td> ";
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='slot_tarjeta' type='text' id='slot_tarjeta' readonly='readonly' value='$subslot_tarjeta' /></td> ";
								
								$ptos_1gb_r=$ptos_1gb;
								$ptos_10gb_r=$ptos_10gb;
								
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='ptos_1gb' type='text' id='ptos_1gb' readonly='readonly' size='25' value='$ptos_1gb_r' /></td> ";
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='ptos_10gb' type='text' id='ptos_10gb' readonly='readonly' size='25' value='$ptos_10gb_r' /></td> ";
								
							}else{
								$a_ptos=explode(",",$ptos_1gb);
								$ta_ptos = sizeof($a_ptos);
								$c_10G=0;
								$c_1G=0;
								$a_ptos_10G=array();
								$a_ptos_1G=array();
								
								for ( $p=0; $p<$ta_ptos; $p++ )
								{
									if (substr($a_ptos[$p], -1) == "G"){
										$a_ptos_10G[$c_10G]=substr($a_ptos[$p],0,strlen($a_ptos[$p])-1);
										$c_10G++;
									}else{
										$a_ptos_1G[$c_1G]=$a_ptos[$p];
										$c_1G++;
									}
								}
								
								$ptos_1gb_r=implode(",",$a_ptos_1G);
								$ptos_10gb_r=implode(",",$a_ptos_10G);
								
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='ptos_1gb' type='text' id='ptos_1gb' readonly='readonly' size='45' value='$ptos_1gb_r' /></td> ";
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='ptos_10gb' type='text' id='ptos_10gb' readonly='readonly' size='45' value='$ptos_10gb_r' /></td> ";
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='ptos_10gb' type='text' id='ptos_10gb' readonly='readonly' size='45' value='$ptos_100gb' /></td> ";

								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43'  type='text'  readonly='readonly' size='30' value='$modulo_tarjeta' /></td> ";
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43'  type='text'  readonly='readonly' size='12' value='$ubi_tarjeta' /></td> ";
							}
							
						echo "</tr>";
					}
					
					echo "<input type='hidden' name='tarjeta_sel' value='' />";
					echo "<input type='hidden' name='subslot_sel' value='' />";
					?>
					<tr><td bordercolor="#CAE4FF">&nbsp;</td></tr>
				</table>
				
				<!-- ******************** -->
				<!-- ****  PUERTOS -->
				<!-- ******************** -->
				<table width="900" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
				<tr>
					<td colspan="5" bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">PUERTOS EN LA TARJETA: <?php echo $tarjeta_selected; ?></span></td>
				</tr>
				<tr>
					<td colspan="5" bordercolor="#CAE4FF" class="Estilo28">&nbsp;</td>
				</tr>
				<tr>
				<!-- Puerto del Equipo Satelite por donde salen los puertod -->
				<?

				if($modelo_tarjeta == 'ASR9000v'){?>
					<td width="150" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Puerto del Satelite</div></td>

				<?}?>
					<td width="150" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Puerto</div></td>
					<td width="150" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Tipo de Puerto</div></td>
					<td width="150" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Ubicaci&oacute;n del BDFO</div></td>
					<td width="150" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Repisa</div></td>
					<td width="150" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">Contactos</div></td>
					<td width="150" bordercolor="#000066" bgcolor="#CCCCCC" class="Estilo41 Estilo28"><div style="background: #CCCCCC;" align="center" class="Estilo44">En Gesti&oacute;n</div></td>
				</tr>
				
				<?php

					$arr44 = array('0'=>'44G','1'=>'44G','2'=>'44G','3'=>'44G','4'=>'44G','5'=>'44G','6'=>'44G','7'=>'44G','8'=>'44G','9'=>'44G','10'=>'44G',
						            '11'=>'45G','12'=>'45G','13'=>'45G','14'=>'45G','15'=>'45G','16'=>'45G','17'=>'45G','18'=>'45G','19'=>'45G','20'=>'45G','21'=>'45G',
						            '22'=>'46G','23'=>'46G','24'=>'46G','25'=>'46G','26'=>'46G','27'=>'46G','28'=>'46G','29'=>'46G','30'=>'46G','31'=>'46G','32'=>'46G',
						            '33'=>'47G','34'=>'47G','35'=>'47G','36'=>'47G','37'=>'47G','38'=>'47G','39'=>'47G','40'=>'47G','41'=>'47G','42'=>'47G','43'=>'47G');
					
					
					$queryPuertos_ce = "SELECT * FROM inventario_puertos_ce WHERE id_nodo='$nodo_selected' AND posicion_tarjeta='$tarjeta_selected' AND cluster='$anillo' AND subslot='$subslot_selected'";
					//echo $queryPuertos_ce;
					$result_p = mysql_query($queryPuertos_ce);
					
					while ($rowPuertos = mysql_fetch_array($result_p, MYSQL_ASSOC))
					{
						$puerto_o							= $rowPuertos['puerto'];
						$ubi_bdfo							= $rowPuertos['ubicacion_bdfo'];
						$repisa_bdfo						= $rowPuertos['repisa_bdfo'];
						$contactos_bdfo					= $rowPuertos['contacto_bdfo'];
						$pto_gestion						= $rowPuertos['gestionada'];
						$tipo_pto							= $rowPuertos['tipo_puerto'];
						
						echo "<tr>";
						
						if (substr($puerto_o, -1) == "G"){
							$tam_pto=strlen($puerto_o);
							$puerto=substr($puerto_o,0,$tam_pto-1)." 10G";
						}else{
							$puerto=$puerto_o;
						}
						if($modelo_tarjeta == 'ASR9000v'){
						echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='corrpuerto' type='text' id='corrpuerto' readonly='readonly' value='".$arr44[$rowPuertos['puerto']]."' /></td> ";

						}
						
						echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='puerto' type='text' id='puerto' readonly='readonly' value='$puerto' /></td> ";
						
						echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='tipo_pto' type='text' id='tipo_pto' readonly='readonly' value='$tipo_pto' /></td> ";
						
						echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='ubi_bdfo' type='text' id='ubi_bdfo' readonly='readonly' value='$ubi_bdfo' /></td> ";
						echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='repisa_bdfo' type='text' id='repisa_bdfo' readonly='readonly' value='$repisa_bdfo' /></td> ";
						echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='contactos_bdfo' type='text' id='contactos_bdfo' readonly='readonly' value='$contactos_bdfo' /></td> ";
						
						if ( $pto_gestion == 'GESTIONADO' ){
							if($perfil != 'Tecnico cnsI'){

							echo "<td align='center' bordercolor='#CAE4FF'>";
								echo "<img border='0' src='images/light_green_1.png' alt='Gestionado' width='18' height='21' />";
								echo "<img border='0' src='images/light_yellow_0.png' alt='Pendiente' width='18' height='21'  onclick='document.lista_nodos.id_aut_sel.value=\"4\";document.lista_nodos.nodo_sel.value=\"$nodo_selected\";document.lista_nodos.tarjeta_sel.value=\"$tarjeta_selected\";document.lista_nodos.nvo_pto_actualiza.value=\"$puerto_o\";document.lista_nodos.anillo_sel.value=\"$anillo\";document.lista_nodos.subslot_sel.value=\"$subslot_selected\";document.lista_nodos.pto_gest.value=\"RECHAZADO\";document.lista_nodos.ot_sel.value=\"".$_GET['id_ot']."\";document.lista_nodos.nom_central_sel.value=\"$nom_adm_conex\";submit();' />";
								echo "<img border='0' src='images/light_red_0.png' alt='No Gestionado' width='18' height='21' onclick='document.lista_nodos.id_aut_sel.value=\"4\";document.lista_nodos.nodo_sel.value=\"$nodo_selected\";document.lista_nodos.tarjeta_sel.value=\"$tarjeta_selected\";document.lista_nodos.nvo_pto_actualiza.value=\"$puerto_o\";document.lista_nodos.anillo_sel.value=\"$anillo\";document.lista_nodos.subslot_sel.value=\"$subslot_selected\";document.lista_nodos.pto_gest.value=\"NO GESTIONADO\";document.lista_nodos.ot_sel.value=\"".$_GET['id_ot']."\";document.lista_nodos.nom_central_sel.value=\"$nom_adm_conex\";submit();' />";
							echo "</td>";

							}
							else{
							echo "<td align='center' bordercolor='#CAE4FF'>";
								echo "<img border='0' src='images/light_green_1.png' alt='Gestionado' width='18' height='21' />";
								echo "<img border='0' src='images/light_yellow_0.png' alt='Pendiente' width='18' height='21'  onclick='alert(\"Imposible Modificar : Puerto Gestionado\");' />";
								echo "<img border='0' src='images/light_red_0.png' alt='No Gestionado' width='18' height='21' onclick='alert(\"Imposible Modificar : Puerto Gestionado\");' />";
							echo "</td>";
							}
							
						}else if ( $pto_gestion == 'NO GESTIONADO' ){
							echo "<td align='center' bordercolor='#CAE4FF'>";
								echo "<img border='0' src='images/light_green_0.png' alt='Gestionado' width='18' height='21' onclick='document.lista_nodos.id_aut_sel.value=\"4\";document.lista_nodos.nodo_sel.value=\"$nodo_selected\";document.lista_nodos.tarjeta_sel.value=\"$tarjeta_selected\";document.lista_nodos.nvo_pto_actualiza.value=\"$puerto_o\";document.lista_nodos.anillo_sel.value=\"$anillo\";document.lista_nodos.subslot_sel.value=\"$subslot_selected\";document.lista_nodos.pto_gest.value=\"GESTIONADO\";document.lista_nodos.ot_sel.value=\"".$_GET['id_ot']."\";document.lista_nodos.nom_central_sel.value=\"$nom_adm_conex\";submit();' />";
								echo "<img border='0' src='images/light_yellow_0.png' alt='Pendiente' width='18' height='21' onclick='document.lista_nodos.id_aut_sel.value=\"4\";document.lista_nodos.nodo_sel.value=\"$nodo_selected\";document.lista_nodos.tarjeta_sel.value=\"$tarjeta_selected\";document.lista_nodos.nvo_pto_actualiza.value=\"$puerto_o\";document.lista_nodos.anillo_sel.value=\"$anillo\";document.lista_nodos.subslot_sel.value=\"$subslot_selected\";document.lista_nodos.pto_gest.value=\"RECHAZADO\";document.lista_nodos.ot_sel.value=\"".$_GET['id_ot']."\";document.lista_nodos.nom_central_sel.value=\"$nom_adm_conex\";submit();' />";
								echo "<img border='0' src='images/light_red_1.png' alt='No Gestionado' width='18' height='21' />";
							echo "</td>";
							
						}else{
							echo "<td align='center' bordercolor='#CAE4FF'>";
								echo "<img border='0' src='images/light_green_0.png' alt='Gestionado' width='18' height='21' onclick='document.lista_nodos.id_aut_sel.value=\"4\";document.lista_nodos.nodo_sel.value=\"$nodo_selected\";document.lista_nodos.tarjeta_sel.value=\"$tarjeta_selected\";document.lista_nodos.nvo_pto_actualiza.value=\"$puerto_o\";document.lista_nodos.anillo_sel.value=\"$anillo\";document.lista_nodos.subslot_sel.value=\"$subslot_selected\";document.lista_nodos.pto_gest.value=\"GESTIONADO\";document.lista_nodos.ot_sel.value=\"".$_GET['id_ot']."\";document.lista_nodos.nom_central_sel.value=\"$nom_adm_conex\";submit();' />";
								echo "<img border='0' src='images/light_yellow_1.png' alt='Pendiente' width='18' height='21' />";
								echo "<img border='0' src='images/light_red_0.png' alt='No Gestionado' width='18' height='21' onclick='document.lista_nodos.id_aut_sel.value=\"4\";document.lista_nodos.nodo_sel.value=\"$nodo_selected\";document.lista_nodos.tarjeta_sel.value=\"$tarjeta_selected\";document.lista_nodos.nvo_pto_actualiza.value=\"$puerto_o\";document.lista_nodos.anillo_sel.value=\"$anillo\";document.lista_nodos.subslot_sel.value=\"$subslot_selected\";document.lista_nodos.pto_gest.value=\"NO GESTIONADO\";document.lista_nodos.ot_sel.value=\"".$_GET['id_ot']."\";document.lista_nodos.nom_central_sel.value=\"$nom_adm_conex\";submit();' />";
							echo "</td>";
						}
						echo "</tr>";
					}
					
					echo "<input type='hidden' name='nvo_pto_actualiza' value='$nvo_pto_actualiza_selected' />";
					echo "<input type='hidden' name='pto_gest' value='$pto_gest_selected' />";
					
					?>
				
			</table>
				
			</form> 
			
		</div>
	</div>


	<div>
		<a name="SECCIONES" id="SECCIONES"></a>
		<!-- TABLA: SECCIONES_CE, LLAVE: ID_NODO -->
		
		<div style="position:relative;">
			
			<table width="900" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
			<form id="frm_secc_val_ce" name="secc_val_ce" method="post" action="liquida_autoriza_ce.php">
				<tr>
					<td bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">&nbsp;</span></td>
				</tr>
				<tr>
					<td bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">SECCIONES (OSPF)</span></td>
				</tr>
				<tr>
					<td bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">&nbsp;</span></td>
				</tr>
			</table>
			
			<table width="900" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
				<?php
				$querySeccion_ce_dist = "SELECT * FROM cat_anillo WHERE anillo='$anillo' AND tipo_cluster='DISTRIBUIDOR'";
				$result_sc = mysql_query($querySeccion_ce_dist);
				$result_scr = mysql_num_rows($result_sc);
				
				for ($veces=1; $veces<=$result_scr; $veces++)
				{
					$querySeccion_ce = "SELECT * FROM secciones_ce WHERE anillo='$anillo' AND MID(desc_nominter_troncal_d,1,5)='DIST$veces' AND MID(desc_nominter_troncal_d,7,4)!='RCDT'";
					$result_s = mysql_query($querySeccion_ce);
					while ($rowSeccion = mysql_fetch_array($result_s, MYSQL_ASSOC))
					{
						$s_id							= $rowSeccion['id'];
						$s_id_nodo						= $rowSeccion['id_nodo'];
						$s_id_nodo_d					= $rowSeccion['id_nodo_d'];
						$s_id_nodo_a					= $rowSeccion['id_nodo_a'];
						$s_pto_troncal_d				= $rowSeccion['pto_troncal_d'];
						$s_pto_troncal_a				= $rowSeccion['pto_troncal_a'];
						$s_ip_troncal_d					= $rowSeccion['ip_troncal_d'];
						$s_ip_troncal_a					= $rowSeccion['ip_troncal_a'];
						$s_nominter_troncal_d			= $rowSeccion['nominter_troncal_d'];
						$s_nominter_troncal_a			= $rowSeccion['nominter_troncal_a'];
						$s_desc_nominter_troncal_d		= $rowSeccion['desc_nominter_troncal_d'];
						$s_desc_nominter_troncal_a		= $rowSeccion['desc_nominter_troncal_a'];
						$s_id_pto_troncal_d				= $rowSeccion['id_pto_troncal_d'];
						$s_id_pto_troncal_a				= $rowSeccion['id_pto_troncal_a'];
						$s_mtu_d						= $rowSeccion['mtu_d'];
						$s_mtu_a						= $rowSeccion['mtu_a'];

						$s_tipo_puerto_d				= $rowSeccion['tipo_puerto_d'];
						$s_tipo_puerto_a				= $rowSeccion['tipo_puerto_a'];
						
						$s_tx_d							= $rowSeccion['tx_d'];
						$s_rx_d							= $rowSeccion['rx_d'];
						$s_tx_a							= $rowSeccion['tx_a'];
						$s_rx_a							= $rowSeccion['rx_a'];
							
						$num_agr						= substr($s_desc_nominter_troncal_d,9,2);
					
						if (substr($num_agr,1,1)=='-')
						{
							$s_num_agr=substr($num_agr,0,1);
						}else{
							$s_num_agr=$num_agr;
						}
						
						if ( $num_agr=="T2" ){
							$d_nodo="DISTRIBUIDOR 2";
						}else{
							$d_nodo="AGREGADOR $s_num_agr";
						}
						
						$queryPotd = mysql_query("SELECT * FROM cat_puertos_ce WHERE proveedor='$prov_tx_nodo' AND tipo_puerto='$s_tipo_puerto_d'");
						$queryPotencia_d = mysql_fetch_array($queryPotd, MYSQL_ASSOC);
						$tx_d=$queryPotencia_d['tx'];
						$rx_d=$queryPotencia_d['rx'];

						$queryPota = mysql_query("SELECT * FROM cat_puertos_ce WHERE proveedor='$prov_tx_nodo' AND tipo_puerto='$s_tipo_puerto_a'");
						$queryPotencia_a = mysql_fetch_array($queryPota, MYSQL_ASSOC);
						$tx_a=$queryPotencia_a['tx'];
						$rx_a=$queryPotencia_a['rx'];

						$queryRemd = mysql_query("SELECT * FROM inventario_puertos_ce WHERE cluster='$anillo' AND pto_troncal='$s_desc_nominter_troncal_d'");
						$queryRemate_d = mysql_fetch_array($queryRemd, MYSQL_ASSOC);
						$pos_d=$queryRemate_d['ubicacion_bdfo'];
						$rep_d=$queryRemate_d['repisa_bdfo'];
						$con_d=$queryRemate_d['contacto_bdfo'];
						$rem_d="$pos_d/$rep_d/$con_d";

						$queryRema = mysql_query("SELECT * FROM inventario_puertos_ce WHERE cluster='$anillo' AND pto_troncal='$s_desc_nominter_troncal_a'");
						$queryRemate_a = mysql_fetch_array($queryRema, MYSQL_ASSOC);
						$pos_a=$queryRemate_a['ubicacion_bdfo'];
						$rep_a=$queryRemate_a['repisa_bdfo'];
						$con_a=$queryRemate_a['contacto_bdfo'];
						$rem_a="$pos_a/$rep_a/$con_a";
						
						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" align="center" class="Estilo4 Estilo31">&nbsp;</td>';
						echo "</tr>";						
						echo "<tr>";

						if (strlen($s_nominter_troncal_a) == 26 AND strlen($s_nominter_troncal_d) == 26 ){
							echo '<td width="100" bordercolor="#CAE4FF" align="center" class="Estilo4 Estilo31">SECCION '.substr($s_nominter_troncal_d,24,2).'</td>';
						}else{
							echo '<td width="100" bordercolor="#CAE4FF" align="center" class="Estilo4 Estilo31">SECCION 01</td>';

						}
						
							//echo '<td width="55" bordercolor="#CAE4FF" align="center" class="Estilo4 Estilo31">&nbsp;</td>';
							//echo '<td width="55" bordercolor="#CAE4FF" align="center" class="Estilo4 Estilo31">ID: '.$s_id.'</td>';
							echo '<td width="150" bordercolor="#CAE4FF" align="center" class="Estilo4 Estilo31">&nbsp;</td>';
							echo '<td width="240" bordercolor="#CAE4FF" align="center" class="Estilo4 Estilo31">DISTRIBUIDOR '.$veces.'</td>';
							echo '<td width="240" bordercolor="#CAE4FF" align="center" class="Estilo4 Estilo31">'.$d_nodo.'</td>';
							echo '<td width="160" bordercolor="#CAE4FF" align="center" class="Estilo4 Estilo31">&nbsp;</td>';
							echo '<td width="55" bordercolor="#CAE4FF" align="center" class="Estilo4 Estilo31">&nbsp;</td>';
						echo "</tr>";
						
						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">Puerto Origen</td>';
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='pto_troncal_d' type='text' id='pto_troncal_d' size='35' readonly='readonly' value='$s_pto_troncal_d' /></td> ";
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='pto_troncal_a' type='text' id='pto_troncal_a' size='35' readonly='readonly' value='$s_pto_troncal_a' /></td> ";
						echo "</tr>";

						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">Tipo de Puerto</td>';
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='tipo_puerto_d' type='text' id='tipo_puerto_d' size='35' readonly='readonly' value='$s_tipo_puerto_d' /></td> ";
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='tipo_puerto_a' type='text' id='tipo_puerto_a' size='35' readonly='readonly' value='$s_tipo_puerto_a' /></td> ";
						echo "</tr>";

						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">Remate en BDFO</td>';
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='$rem_d' type='text' id='$rem_d' size='35' readonly='readonly' value='$rem_d' /></td> ";
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='$rem_a' type='text' id='$rem_a' size='35' readonly='readonly' value='$rem_a' /></td> ";
						echo "</tr>";

						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">TX Recomendada</td>';
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='tx_d' type='text' id='tx_d' size='35' readonly='readonly' value='$tx_d' /></td> ";
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='tx_a' type='text' id='tx_a' size='35' readonly='readonly' value='$tx_a' /></td> ";
						echo "</tr>";

						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">RX Operativa (Recomendada)</td>';
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='rx_d' type='text' id='rx_d' size='35' readonly='readonly' value='$rx_d' /></td> ";
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='rx_a' type='text' id='rx_a' size='35' readonly='readonly' value='$rx_a' /></td> ";
						echo "</tr>";

						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">TX Real</td>';
							echo '<td align="center" bordercolor="#CAE4FF" ><input type="text" class="Estilo43" name="txreal_d'.$s_id.'" id="txreal_d'.$s_id.'" size="35" value="'.$s_tx_d.'" /></td> ';
							echo '<td align="center" bordercolor="#CAE4FF" ><input type="text" class="Estilo43" name="txreal_a'.$s_id.'" id="txreal_a'.$s_id.'" size="35" value="'.$s_tx_a.'" /></td> ';
						echo "</tr>";

						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">RX Real</td>';
							echo "<td align='center' bordercolor='#CAE4FF'><input type='text' class='Estilo43' name='rxreal_d".$s_id."' id='rxreal_d".$s_id."' size='35' value='".$s_rx_d."' /></td> ";
							echo "<td align='center' bordercolor='#CAE4FF'><input type='text' class='Estilo43' name='rxreal_a".$s_id."' id='rxreal_a".$s_id."' size='35' value='".$s_rx_a."' /></td> ";
							
							echo '<td align="center" bordercolor="#CAE4FF" ><input type="submit" name="b_save'.$s_id.'" id="b_save'.$s_id.'" value="Guardar cambios" onclick="document.secc_val_ce.tx_real_d.value = document.getElementById(\'txreal_d'.$s_id.'\').value;document.secc_val_ce.tx_real_a.value = document.getElementById(\'txreal_a'.$s_id.'\').value;document.secc_val_ce.rx_real_d.value = document.getElementById(\'rxreal_d'.$s_id.'\').value;document.secc_val_ce.rx_real_a.value = document.getElementById(\'rxreal_a'.$s_id.'\').value;document.secc_val_ce.id_reg_nodo.value = \''.$s_id.'\';document.secc_val_ce.liq.value=\'SAVE_CAM'.$s_id.'\'" /></td>';
						echo "</tr>";

						
						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">Identificador del Puerto</td>';
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='id_pto_troncal_d' type='text' id='id_pto_troncal_d' size='35' readonly='readonly' value='$s_id_pto_troncal_d' /></td> ";
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='id_pto_troncal_a' type='text' id='id_pto_troncal_a' size='35' readonly='readonly' value='$s_id_pto_troncal_a' /></td> ";
						echo "</tr>";
						
						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">IP de Troncal</td>';
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='ip_troncal_d' type='text' id='ip_troncal_d' size='35' readonly='readonly' value='$s_ip_troncal_d' /></td> ";
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='ip_troncal_a' type='text' id='ip_troncal_a' size='35' readonly='readonly' value='$s_ip_troncal_a' /></td> ";
						echo "</tr>";
						
						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">Nombre de Interfase</td>';
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='s_nominter_troncal_d' type='text' id='s_nominter_troncal_d' size='35' readonly='readonly' value='$s_nominter_troncal_d' /></td> ";
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='s_nominter_troncal_a' type='text' id='s_nominter_troncal_a' size='35' readonly='readonly' value='$s_nominter_troncal_a' /></td> ";
						echo "</tr>";
						
						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">Descripci&oacute;n de Interfase</td>';
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='s_desc_nominter_troncal_d' type='text' id='s_desc_nominter_troncal_d' size='35' readonly='readonly' value='$s_desc_nominter_troncal_d' /></td> ";
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='s_desc_nominter_troncal_a' type='text' id='s_desc_nominter_troncal_a' size='35' readonly='readonly' value='$s_desc_nominter_troncal_a' /></td> ";
						echo "</tr>";
						
						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">MTU</td>';
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='s_mtu_d' type='text' id='s_mtu_d' size='35' readonly='readonly' value='$s_mtu_d' /></td> ";
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='s_mtu_a' type='text' id='s_mtu_a' size='35' readonly='readonly' value='$s_mtu_a' /></td> ";
						echo "</tr>";
						
						echo "<tr><td align='center' bordercolor='#CAE4FF'>&nbsp</td></tr>";
						//echo "</table>";
						
					}
					
				}
				
				//<td><input type="submit" name="button_save" id="button_save" value="Guardar cambios" onclick="document.secc_val_ce.liq.value='SAVE_CAM'" /></td>
				?>
				<table width="900" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
					<tr>
					
					<!- --------------------- -->
						<input type='hidden' name='tx_real_d'>
						<input type='hidden' name='rx_real_d'>
						<input type='hidden' name='tx_real_a'>
						<input type='hidden' name='rx_real_a'>
						<input type='hidden' name='id_reg_nodo'>

						<input type='hidden' name='id_ot' value="<?php echo $rowOrden['id_ot']; ?>">
						<input type='hidden' name='tabla' value="<?php echo $rowOrden['tabla']; ?>">
						<input type='hidden' name='nombre_oficial_pisa' value="<?php echo $rowOrden['nombre_oficial_pisa']; ?>">
						<input type='hidden' name='id_tabla' value="<?php echo $rowOrden['id_tabla']; ?>">
						<input type='hidden' name='trafico' value="<?php echo $rowOrden['trafico']; ?>">
						<input type='hidden' name='liq'>
						<input type='hidden' name='num_ot_frida' value="<?php echo $rowOrden['num_ot_frida']; ?>" />
                    

					
					</tr>
				</table>
						
				
				</form>
			</table>
			
		</div>
	</div>

	<?if($modelo_equipo_ce <> 'ASR9006' && $modelo_equipo_ce <>'ASR9010'){?>
	<div>
		<a name="TUNELES" id="TUNELES"></a>
		<!-- TABLA: TUNELES_CE, LLAVE: Nodo_P -->
		
		<div style="position:relative;">
					
			<?php
				
			if ($prov_tx_nodo=='ALCATEL' OR $prov_tx_nodo=='ALCATEL-LUCENT'){
				
			echo '<table width="813" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">';
				echo '<tr>';
					echo '<td colspan="11" bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">TUNELES (MPLS)</span></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td colspan="11" bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">&nbsp;</span></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td colspan="5" bordercolor="#000066" bgcolor="#CCCCCC" align="center" class="Estilo31 Estilo4">T&uacute;neles de Servicio HSI</td>';
					echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>';
					echo '<td colspan="5" bordercolor="#000066" bgcolor="#CCCCCC" align="center" class="Estilo31 Estilo4">T&uacute;neles de Servicio OAM</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td bordercolor="#000066" bgcolor="#FFFFCC" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Nodo</div></td>';
					echo '<td bordercolor="#000066" bgcolor="#FFFFCC" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Tipo</div></td>';
					echo '<td bordercolor="#000066" bgcolor="#FFFFCC" class="Estilo41 Estilo28"><div align="center" class="Estilo46">ID del SDP </div></td>';
					echo '<td bordercolor="#000066" bgcolor="#FFFFCC" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Nombre</div></td>';
					echo '<td bordercolor="#000066" bgcolor="#FFFFCC" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Descripcion</div></td>';
					
					echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp</td>';
					
					echo '<td bordercolor="#000066" bgcolor="#FFFFCC" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Nodo</div></td>';
					echo '<td bordercolor="#000066" bgcolor="#FFFFCC" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Tipo</div></td>';
					echo '<td bordercolor="#000066" bgcolor="#FFFFCC" class="Estilo41 Estilo28"><div align="center" class="Estilo46">ID del SDP </div></td>';
					echo '<td bordercolor="#000066" bgcolor="#FFFFCC" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Nombre</div></td>';
					echo '<td bordercolor="#000066" bgcolor="#FFFFCC" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Descripcion</div></td>';
				echo '</tr>';
				
				$queryTuneles_ce = "SELECT repisa FROM cat_anillo WHERE anillo='$anillo' AND repisa like '%AGR%' ORDER BY repisa ASC";
				$result_tu = mysql_query($queryTuneles_ce);
				
				while ($rowTuneles = mysql_fetch_array($result_tu, MYSQL_ASSOC))
				{
					$t_repisa						= $rowTuneles['repisa'];
					$t_repisa_s						=substr($t_repisa,0,3).substr($t_repisa,10);
					
					$queryTuneles2_ce = "SELECT * FROM tuneles_ce WHERE nodo_p='$t_repisa_s' AND nodo_s='DIST1' AND proveedor_tx='ALCATEL'";
					$result_tu2 = mysql_query($queryTuneles2_ce);
					
					$queryTuneles2a_ce = "SELECT * FROM tuneles_ce WHERE nodo_p='$t_repisa_s' AND nodo_s='DIST2' AND proveedor_tx='ALCATEL'";
					$result_tu2a = mysql_query($queryTuneles2a_ce);
					
					echo '<tr>';
					while ($rowTuneles2 = mysql_fetch_array($result_tu2, MYSQL_ASSOC))
					{
						$t2_nodo_p					=$rowTuneles2['nodo_p'];
						$t2_nodo_s					=$rowTuneles2['nodo_s'];
						$t2_id_sdp					=$rowTuneles2['id_sdp'];
						$t2_nombre					=$rowTuneles2['nombre'];
						$t2_descripcion				=$rowTuneles2['descripcion'];
						
						echo '<td rowspan="2" align="center" bordercolor="#000066" bgcolor="#FFFFCC" class="Estilo28 Estilo42">'.$t_repisa.'</td>';
						echo '<td align="center" bordercolor="#000066" bgcolor="#AAFFAA" class="Estilo28 Estilo42">DISTRIBUIDOR 1</td>';
						echo '<td align="center" bordercolor="#000066" bgcolor="#FFFFFF" class="Estilo28 Estilo42">'.$t2_id_sdp.'</td>';
						echo '<td align="center" bordercolor="#000066" bgcolor="#FFFFFF" class="Estilo28 Estilo42">'.$t2_nombre.'</td>';
						echo '<td align="center" bordercolor="#000066" bgcolor="#FFFFFF" class="Estilo28 Estilo42">'.$t2_descripcion.'</td>';
						echo '<td align="center" bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>';
					}
					echo '</tr>';
					
					echo '<tr>';
					while ($rowTuneles2a = mysql_fetch_array($result_tu2a, MYSQL_ASSOC))
					{
						$t2_nodo_p					=$rowTuneles2a['nodo_p'];
						$t2_nodo_s					=$rowTuneles2a['nodo_s'];
						$t2_id_sdp					=$rowTuneles2a['id_sdp'];
						$t2_nombre					=$rowTuneles2a['nombre'];
						$t2_descripcion				=$rowTuneles2a['descripcion'];
						
						echo '<td align="center" bordercolor="#000066" bgcolor="#AAFFAA" class="Estilo28 Estilo42">DISTRIBUIDOR 2</td>';
						echo '<td align="center" bordercolor="#000066" bgcolor="#FFFFFF" class="Estilo28 Estilo42">'.$t2_id_sdp.'</td>';
						echo '<td align="center" bordercolor="#000066" bgcolor="#FFFFFF" class="Estilo28 Estilo42">'.$t2_nombre.'</td>';
						echo '<td align="center" bordercolor="#000066" bgcolor="#FFFFFF" class="Estilo28 Estilo42">'.$t2_descripcion.'</td>';
						echo '<td align="center" bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>';
					}
					echo '</tr>';
				}
				
				echo '<tr>';
					echo '<td colspan="11" bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp</td>';
				echo '</tr>';
				
				$queryTuneles1_ce = "SELECT repisa FROM cat_anillo WHERE anillo='$anillo' AND repisa like '%DIST%' ORDER BY repisa ASC";
				$result_tu1 = mysql_query($queryTuneles1_ce);
				
				while ($rowTuneles1 = mysql_fetch_array($result_tu1, MYSQL_ASSOC))
				{
					$t_repisa						= $rowTuneles1['repisa'];
					$t_repisa_s						=substr($t_repisa,0,4).substr($t_repisa,13);
					
					$queryTuneles1a_ce = "SELECT * FROM tuneles_ce WHERE nodo_p='$t_repisa_s' AND proveedor_tx='ALCATEL'";
					$result_tu1a = mysql_query($queryTuneles1a_ce);
					
					while ($rowTuneles1a = mysql_fetch_array($result_tu1a, MYSQL_ASSOC))
					{
						$t2_nodo_p					=$rowTuneles1a['nodo_p'];
						if ( $rowTuneles1a['nodo_s'] == 'DIST1'){
							$t2_nodo_s = 'DISTRIBUIDOR 1';
						}else{
							$t2_nodo_s = 'DISTRIBUIDOR 2';
						}
						$t2_id_sdp					=$rowTuneles1a['id_sdp'];
						$t2_nombre					=$rowTuneles1a['nombre'];
						$t2_descripcion				=$rowTuneles1a['descripcion'];
						
						echo '<tr>';
							echo '<td align="center" bordercolor="#000066" bgcolor="#AAFFAA" class="Estilo28 Estilo42">'.$t_repisa.'</td>';
							echo '<td align="center" bordercolor="#000066" bgcolor="#AAFFAA" class="Estilo28 Estilo42">'.$t2_nodo_s.'</td>';
							echo '<td align="center" bordercolor="#000066" bgcolor="#FFFFFF" class="Estilo28 Estilo42">'.$t2_id_sdp.'</td>';
							echo '<td align="center" bordercolor="#000066" bgcolor="#FFFFFF" class="Estilo28 Estilo42">'.$t2_nombre.'</td>';
							echo '<td align="center" bordercolor="#000066" bgcolor="#FFFFFF" class="Estilo28 Estilo42">'.$t2_descripcion.'</td>';
							echo '<td colspan="6" align="center" bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>';
						echo '</tr>';
					}
				}
				
			}else{	// CUANDO EL PROVEEDOR-TX ES CISCO
			echo '<table width="550" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">';
				echo '<tr>';
					echo '<td colspan="6" bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">TUNELES (MPLS)</span></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td colspan="6" bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">&nbsp;</span></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td colspan="6" bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">&nbsp;</span></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td width="50" bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp</td>';
					echo '<td colspan="4" bordercolor="#000066" bgcolor="#CCCCCC" align="center" class="Estilo31 Estilo4">T&uacute;neles de Servicio HSI</td>';
					echo '<td width="50" bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp</td>';
					echo '<td width="100" bordercolor="#000066" bgcolor="#FFFFCC" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Agregador</div></td>';
					echo '<td width="100" bordercolor="#000066" bgcolor="#FFFFCC" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Distribuidor</div></td>';
					echo '<td width="150" bordercolor="#000066" bgcolor="#FFFFCC" class="Estilo41 Estilo28"><div align="center" class="Estilo46">ID Bridge Domain</div></td>';
					echo '<td width="100" bordercolor="#000066" bgcolor="#FFFFCC" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Aprovisionado</div></td>';
					echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp</td>';
				echo '</tr>';
				
				$queryTuneles_ce = "SELECT repisa FROM cat_anillo WHERE anillo='$anillo' AND repisa like '%AGR%' ORDER BY repisa ASC";
				$result_tu = mysql_query($queryTuneles_ce);
				
				while ($rowTuneles = mysql_fetch_array($result_tu, MYSQL_ASSOC))
				{
					$t_repisa						= $rowTuneles['repisa'];
					$t_repisa_s						=substr($t_repisa,0,3).substr($t_repisa,10);
					//$t_repisa						= $rowTuneles['nodo_p'];
					//$t_repisa_s						= $rowTuneles['nodo_p'];
					
					$queryTuneles2_ce = "SELECT * FROM tuneles_ce WHERE nodo_p='$t_repisa_s' AND nodo_s='DIST1' AND proveedor_tx='CISCO'";
					$result_tu2 = mysql_query($queryTuneles2_ce);
					
					$queryTuneles2a_ce = "SELECT * FROM tuneles_ce WHERE nodo_p='$t_repisa_s' AND nodo_s='DIST2' AND proveedor_tx='CISCO'";
					$result_tu2a = mysql_query($queryTuneles2a_ce);
					
					echo '<tr>';
					while ($rowTuneles2 = mysql_fetch_array($result_tu2, MYSQL_ASSOC))
					{
						$t2_nodo_p					=$rowTuneles2['nodo_p'];
						$t2_nodo_s					=$rowTuneles2['nodo_s'];
						$t2_id_sdp					=$rowTuneles2['id_sdp'];
						$t2_nombre					=$rowTuneles2['nombre'];
						$t2_descripcion				=$rowTuneles2['descripcion'];
						
						echo '<td align="center" bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>';
						echo '<td rowspan="2" align="center" bordercolor="#000066" bgcolor="#FFFFCC" class="Estilo28 Estilo42">'.$t_repisa.'</td>';
						echo '<td align="center" bordercolor="#000066" bgcolor="#AAFFAA" class="Estilo28 Estilo42">DIST1</td>';
						echo '<td align="center" bordercolor="#000066" bgcolor="#FFFFFF" class="Estilo28 Estilo42">'.$t2_id_sdp.'</td>';
						echo '<td align="center" bordercolor="#000066" bgcolor="#FFFFFF" class="Estilo28 Estilo42">&nbsp;</td>';
						echo '<td align="center" bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>';
					}
					echo '</tr>';
					
					echo '<tr>';
					while ($rowTuneles2a = mysql_fetch_array($result_tu2a, MYSQL_ASSOC))
					{
						$t2_nodo_p					=$rowTuneles2a['nodo_p'];
						$t2_nodo_s					=$rowTuneles2a['nodo_s'];
						$t2_id_sdp					=$rowTuneles2a['id_sdp'];
						$t2_nombre					=$rowTuneles2a['nombre'];
						$t2_descripcion				=$rowTuneles2a['descripcion'];
						
						echo '<td align="center" bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>';
						echo '<td align="center" bordercolor="#000066" bgcolor="#AAFFAA" class="Estilo28 Estilo42">DIST2</td>';
						echo '<td align="center" bordercolor="#000066" bgcolor="#FFFFFF" class="Estilo28 Estilo42">'.$t2_id_sdp.'</td>';
						echo '<td align="center" bordercolor="#000066" bgcolor="#FFFFFF" class="Estilo28 Estilo42">&nbsp;</td>';
						echo '<td align="center" bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>';
					}
					echo '</tr>';
				}
				
			} //fin del if de proveedor-tx
				
			?>
				
				<tr>
					<td colspan="11" bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp</td>
				</tr>
				
			</table>
		</div>
	</div>
	<?}?>


	<div>
		<a name="RCDT" id="RCDT"></a>
		
		
		<div style="position:relative;">
		
			<table width="813" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
				<tr>
					<td bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">&nbsp;</span></td>
				</tr>
				<tr>
					<td bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">CONEXION A RCDT</span></td>
				</tr>
				<tr>
					<td bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">&nbsp;</span></td>
				</tr>
			</table>
			
			<table width="813" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
	
				<?php
				
				$queryCx_ce = "SELECT * FROM secciones_ce WHERE anillo='$anillo' AND desc_nominter_troncal_d like '%RCDT%' order by desc_nominter_troncal_d";
				$result_cx = mysql_query($queryCx_ce);
				
				$distrib_n=1;
				while ($rowCx = mysql_fetch_array($result_cx, MYSQL_ASSOC))
					{
						$cx_id_nodo							= $rowCx['id_nodo'];
						$cx_pto_troncal_d					= $rowCx['pto_troncal_d'];
						$cx_ip_troncal_d						= $rowCx['ip_troncal_d'];
						$cx_id_pto_troncal_d				= $rowCx['id_pto_troncal_d'];
						$cx_mtu_d								= $rowCx['mtu_d'];
						
						$cx_pto_troncal_a					= $rowCx['pto_troncal_a'];
						$cx_ip_troncal_a						= $rowCx['ip_troncal_a'];
						$cx_id_pto_troncal_a				= $rowCx['id_pto_troncal_a'];
						$cx_mtu_a								= $rowCx['mtu_a'];
						
						$cx_nominter_troncal_d			= $rowCx['nominter_troncal_d'];
						$cx_nominter_troncal_a			= $rowCx['nominter_troncal_a'];
						$cx_desc_nominter_troncal_d	= $rowCx['desc_nominter_troncal_d'];
						$cx_desc_nominter_troncal_a	= $rowCx['desc_nominter_troncal_a'];
						$cx_vel_pto_d						= $rowCx['vel_pto_d'];
						$cx_ip_mascara_d					= $rowCx['ip_mascara_d'];
						
						$cx_no_cambio_rcdt				= $rowCx['no_cambio_rcdt'];
						$cx_prioridad_rcdt				= $rowCx['prioridad_rcdt'];
						
						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" align="center" class="Estilo4 Estilo31">&nbsp;</td>';
						echo "</tr>";
						
						echo "<tr>";
							echo '<td width="80" bordercolor="#CAE4FF" align="center" class="Estilo4 Estilo31">&nbsp;</td>';
							echo '<td width="150" bordercolor="#CAE4FF" align="center" class="Estilo4 Estilo31">&nbsp;</td>';
							echo '<td width="200" bordercolor="#CAE4FF" align="center" class="Estilo4 Estilo31">DISTRIBUIDOR '.$distrib_n.'</td>';
							echo '<td width="200" bordercolor="#CAE4FF" align="center" class="Estilo4 Estilo31">RCDT</td>';
							echo '<td width="90" bordercolor="#CAE4FF" align="center" class="Estilo4 Estilo31">&nbsp;</td>';
						echo "</tr>";
						
						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">Puerto Origen de Gesti&oacute;n</td>';
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='pto_troncal_d' type='text' id='pto_troncal_d' size='40' readonly='readonly' value='$cx_pto_troncal_d' /></td> ";
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='pto_troncal_a' type='text' id='pto_troncal_a' size='40' readonly='readonly' value='$cx_pto_troncal_a' /></td> ";
						echo "</tr>";
						
						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">IP Puerto Origen</td>';
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='ip_troncal_d' type='text' id='ip_troncal_d' size='40' readonly='readonly' value='$cx_ip_troncal_d' /></td> ";
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='ip_troncal_a' type='text' id='ip_troncal_a' size='40' readonly='readonly' value='$cx_ip_troncal_a' /></td> ";
						echo "</tr>";
						
						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">Identificador del Puerto</td>';
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='id_pto_troncal_d' type='text' id='id_pto_troncal_d' size='40' readonly='readonly' value='$cx_id_pto_troncal_d' /></td> ";
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='id_pto_troncal_a' type='text' id='id_pto_troncal_a' size='40' readonly='readonly' value='$cx_id_pto_troncal_a' /></td> ";
						echo "</tr>";
						
						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">Nombre de Interfase</td>';
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='nominter_troncal_d' type='text' id='s_nominter_troncal_d' size='40' readonly='readonly' value='$cx_nominter_troncal_d' /></td> ";
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='nominter_troncal_a' type='text' id='s_nominter_troncal_a' size='40' readonly='readonly' value='$cx_nominter_troncal_a' /></td> ";
						echo "</tr>";
						
						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">Descripci&oacute;n de Interfase</td>';
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='desc_nominter_troncal_d' type='text' id='s_desc_nominter_troncal_d' size='40' readonly='readonly' value='$cx_desc_nominter_troncal_d' /></td> ";
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='desc_nominter_troncal_a' type='text' id='s_desc_nominter_troncal_a' size='40' readonly='readonly' value='$cx_desc_nominter_troncal_a' /></td> ";
						echo "</tr>";
						
						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">MTU</td>';
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='mtu_d' type='text' id='mtu_d' size='40' readonly='readonly' value='$cx_mtu_d' /></td> ";
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='mtu_a' type='text' id='mtu_a' size='40' readonly='readonly' value='$cx_mtu_a' /></td> ";
						echo "</tr>";
						
						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">N&uacute;mero de Cambio RCDT</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='num_cambio_rcdt' type='text' id='num_cambio_rcdt' size='40' readonly='readonly' value='$cx_no_cambio_rcdt' /></td> ";
							echo "<td align='center' bordercolor='#CAE4FF'>&nbsp;</td> ";
						echo "</tr>";

						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">Prioridad RCDT</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='prioridad_rcdt' type='text' id='prioridad_rcdt' size='40' readonly='readonly' value='$cx_prioridad_rcdt' /></td> ";
							echo "<td align='center' bordercolor='#CAE4FF'>&nbsp;</td> ";
						echo "</tr>";

						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">Velocidad del Puerto</td>';
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='vel_pto_d' type='text' id='vel_pto_d' size='40' readonly='readonly' value='$cx_vel_pto_d' /></td> ";
							echo "<td align='center' bordercolor='#CAE4FF'>&nbsp;</td> ";
						echo "</tr>";
						
						echo "<tr>";
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">&nbsp;</td>';
							echo '<td bordercolor="#CAE4FF" class="Estilo43 Estilo28">IP M&aacute;scara</td>';
							echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='ip_mascara_d' type='text' id='ip_mascara_pto_d' size='40' readonly='readonly' value='$cx_ip_mascara_d' /></td> ";
							echo "<td align='center' bordercolor='#CAE4FF'>&nbsp;</td> ";
						echo "</tr>";
						
						echo "<tr><td align='center' bordercolor='#CAE4FF'>&nbsp</td></tr>";
						echo "</table>";
						echo '<table width="813" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">';
						
						$distrib_n++;
						
					}
					
				?>
				
			</table>
		</div>
	</div>
	
	
	<div>
		<a name="FIBRAOPTICA" id="FIBRAOPTICA"></a>
		
		<div style="position:relative;">
			
			<table width="900" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
				<tr><td bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">&nbsp;</span></td></tr>
				<tr><td bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">&nbsp;TRANSMISION</span></td></tr>
				<tr><td bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">&nbsp;</span></td></tr>
			</table>
				
			<?php
				
				$secc_a1=array();
				$secc_a2=array();
				$secc_array=array();
				
				$queryFO_ce = "SELECT * FROM fibra_optica_ce WHERE anillo='$anillo' ORDER BY seccion,trayectoria";
				//echo $queryFO_ce;
				
				$nva_secc = '';
				$nva_secc_tray = '';
				$result_fo = mysql_query($queryFO_ce);
				while ($rowFO = mysql_fetch_array($result_fo, MYSQL_ASSOC))
				{
					array_push($secc_array,$rowFO);
					if ( $nva_secc != ($rowFO['seccion']."-".$rowFO['trayectoria']) ){
						array_push($secc_a1,$rowFO['seccion'],$rowFO['trayectoria']);
						$nva_secc = $rowFO['seccion']."-".$rowFO['trayectoria'];
					}
				}
				$secc_a2=array_chunk($secc_a1,2);
				
				for ( $veces = 0; $veces < sizeof($secc_a2); $veces++ ){
					
					
					echo '<table width="813" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">';
					echo "<tr>";
						echo '<td colspan="16" align="center" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo4 Estilo31">&nbsp;</td>';
					echo "</tr>";
					
					//echo $secc_a2[$veces][1];
					//$lcampo = strlen($secc_a2[$veces][0]);
					//echo $secc_a2[$veces][0]."<br>";	
					//$idnumsecc = substr($secc_a2[$veces][0],$lcampo-3,1);
					if ( $secc_a2[$veces][1] == '0' or $secc_a2[$veces][1] == '1')
					{
						$numsecc = "01";
					}else
					{
						if($secc_a2[$veces][1]<10)	$numsecc = "0".$secc_a2[$veces][1];
						else						$numsecc = $secc_a2[$veces][1];
					}
					
					$a_elemFO = explode("-",$secc_a2[$veces][0]);
					if ( substr($a_elemFO[0],0,1) == "D" ){
						$elemento1_fo = "DISTRIBUIDOR ".substr($a_elemFO[0],4);
					}elseif(substr($a_elemFO[0],0,4) == "ASRV" ){
						$elemento2_fo = "ASRV ".substr($a_elemFO[0],-2,2);
					}else{
						$elemento1_fo = "AGREGADOR ".substr($a_elemFO[0],3);
					}
					if ( substr($a_elemFO[1],0,1) == "D" ){
						$elemento2_fo = "DISTRIBUIDOR ".substr($a_elemFO[1],4);
					}elseif(substr($a_elemFO[1],0,4) == "ASRV" ){
						$elemento2_fo = "ASRV ".substr($a_elemFO[1],-2,2);
					}else{
						$elemento2_fo = "AGREGADOR ".substr($a_elemFO[1],3);
					}
					if ( $secc_a2[$veces][1] != 0 ){
						$trays_fo = "  (Trayectoria ".$secc_a2[$veces][1].")";
					}else{
						$trays_fo = " ";
					}
					
					echo "<tr>";
						//echo '<td colspan="16" align="center" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo4 Estilo31">'.$elemento1_fo." - ".$elemento2_fo.' '.$trays_fo.'</td>';
						echo '<td colspan="16" align="center" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo4 Estilo31">'.$elemento1_fo.' - '.$elemento2_fo.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(SECCION '.$numsecc.')'.'</td>';
					echo "</tr>";
					echo '<tr>';
						echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Medio Tx</div></td>';
						echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Cable</div></td>';
						
						for ($y = 0; $y < sizeof($secc_array); $y++)
						{
							if ( $secc_array[$y]['seccion'] == $secc_a2[$veces][0] AND $secc_array[$y]['trayectoria'] == $secc_a2[$veces][1] ){
								if ( $secc_array[$y]['tipo_enlace'] == 'f' ){
									echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Longitud (Km)</div></td>';
									echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo41 Estilo28"><div align="center" class="Estilo46">No Fibras</div></td>';
									$y = sizeof($secc_array);
								}
							}
						}
						
						echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Central_A </div></td>';
						echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Piso</div></td>';
						echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Sala</div></td>';
						echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Fila</div></td>';
						echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Repisa</div></td>';
						echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Remate</div></td>';
						echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo41 Estilo28"><div align="center">&nbsp;</td>';
						echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Central_B</div></td>';
						echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Piso</div></td>';
						echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Sala</div></td>';
						echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Fila</div></td>';
						echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Repisa</div></td>';
						echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Remate</div></td>';
						
						for ($y = 0; $y < sizeof($secc_array); $y++)
						{
							if ( $secc_array[$y]['seccion'] == $secc_a2[$veces][0] AND $secc_array[$y]['trayectoria'] == $secc_a2[$veces][1] ){
								if ( $secc_array[$y]['tipo_enlace'] == 'r' ){
									echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Tipo Radio</div></td>';
									echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Banda</div></td>';
									echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Cap</div></td>';
									echo '<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo41 Estilo28"><div align="center" class="Estilo46">Prot</div></td>';
									$y = sizeof($secc_array);
								}
							}
						}
						
					echo '</tr>';
					
					
					for ($y = 0; $y < sizeof($secc_array); $y++)
					{
						if ( $secc_array[$y]['seccion'] == $secc_a2[$veces][0] AND $secc_array[$y]['trayectoria'] == $secc_a2[$veces][1] ){
							
							if ( $secc_array[$y]['tipo_enlace'] == 'f' ){ $fo_t_enlace = "Fibra Optica"; }else{ $fo_t_enlace = "Radio"; }
							echo '<tr>';
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='medio_tx' type='text' id='medio_tx' readonly='readonly' size='9' value='$fo_t_enlace' /></td> ";
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='cable' type='text' id='cable' readonly='readonly' size='4' value='".$secc_array[$y]['cable']."' /></td> ";
								if ( $secc_array[$y]['tipo_enlace'] == 'f' ){
									echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='cable' type='text' id='cable' readonly='readonly' size='4' value='".$secc_array[$y]['longitud']."' /></td> ";
									echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='cable' type='text' id='cable' readonly='readonly' size='4' value='".$secc_array[$y]['no_fibras']."' /></td> ";
								}
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' title='".$secc_array[$y]['central_a']."' name='cable' type='text' id='cable' readonly='readonly' size='4' value='".$secc_array[$y]['central_a']."' /></td> ";
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='cable' type='text' id='cable' readonly='readonly' size='4' value='".$secc_array[$y]['piso_a']."' /></td> ";
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='cable' type='text' id='cable' readonly='readonly' size='4' value='".$secc_array[$y]['sala_a']."' /></td> ";
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='cable' type='text' id='cable' readonly='readonly' size='4' value='".$secc_array[$y]['fila_a']."' /></td> ";
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='cable' type='text' id='cable' readonly='readonly' size='4' value='".$secc_array[$y]['repisa_a']."' /></td> ";
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='cable' type='text' id='cable' readonly='readonly' size='4' value='".$secc_array[$y]['remate_a']."' /></td> ";
								echo "<td align='center' bordercolor='#CAE4FF'>&nbsp;</td> ";
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' title='".$secc_array[$y]['central_b']."' name='cable' type='text' id='cable' readonly='readonly' size='4' value='".$secc_array[$y]['central_b']."' /></td> ";
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='cable' type='text' id='cable' readonly='readonly' size='4' value='".$secc_array[$y]['piso_b']."' /></td> ";
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='cable' type='text' id='cable' readonly='readonly' size='4' value='".$secc_array[$y]['sala_b']."' /></td> ";
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='cable' type='text' id='cable' readonly='readonly' size='4' value='".$secc_array[$y]['fila_b']."' /></td> ";
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='cable' type='text' id='cable' readonly='readonly' size='4' value='".$secc_array[$y]['repisa_b']."' /></td> ";
								echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='cable' type='text' id='cable' readonly='readonly' size='4' value='".$secc_array[$y]['remate_b']."' /></td> ";
								if ( $secc_array[$y]['tipo_enlace'] == 'r' ){
									echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='medio_tx' type='text' id='medio_tx' readonly='readonly' size='5' value='".$secc_array[$y]['tipo_radio']."' /></td> ";
									echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='medio_tx' type='text' id='medio_tx' readonly='readonly' size='5' value='".$secc_array[$y]['banda_operacion']."' /></td> ";
									echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='medio_tx' type='text' id='medio_tx' readonly='readonly' size='5' value='".$secc_array[$y]['capacidad_enlace']."' /></td> ";
									echo "<td align='center' bordercolor='#CAE4FF'><input class='Estilo43' name='medio_tx' type='text' id='medio_tx' readonly='readonly' size='5' value='".$secc_array[$y]['proteccion']."' /></td> ";
								}
							echo '</tr>';
						}
					}
				}
				
				echo "<tr>";
					echo '<td colspan="16" align="center" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo4 Estilo31">&nbsp;</td>';
				echo "</tr>";
			?>
			</table>
		</div>
	</div>
	
	<div>
		<a name="CNS" id="CNS"></a>
		
		<div style="position:relative;">

		<form id="frm_liquida_autoriza_cluster" name="liquida_autoriza_cluster" method="post" action="liquida_autoriza_ce.php">
			<table width="825" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#E8E8E8">
              <input type='hidden' name='id_ot' value="<?php echo $rowOrden['id_ot']; ?>" />
              <input type='hidden' name='tabla' value="<?php echo $rowOrden['tabla']; ?>" />
              <input type='hidden' name='id_tabla' value="<?php echo $rowOrden['id_tabla']; ?>" />
              
              <input type='hidden' name='liq' />
              <input type='hidden' name='causa_r' />
                   
                    <!-- BROKER ________IBM -->

						<input type='hidden' name='nom_cluster' value="<?php
						 echo $rowOrden['nombre_oficial_pisa'] ?>">
                       
                      
                     <!-- BROKER ________IBM -->
            
              <tr>
                <td bordercolor="#E8E8E8" class="Estilo28"><span class="Estilo6 Estilo47"><strong>CONTROL CNS</strong></span></td>
                <td bordercolor="#E8E8E8" class="Estilo28">&nbsp;</td>
                <td bordercolor="#E8E8E8">&nbsp;</td>
                <td bordercolor="#E8E8E8" class="Estilo28">&nbsp;</td>
                <td bordercolor="#E8E8E8" class="Estilo28">&nbsp;</td>
                <td bordercolor="#E8E8E8" class="Estilo28">&nbsp;</td>
              </tr>
              <tr>
                <td bordercolor="#E8E8E8" class="Estilo36">RF</td>
                <td bordercolor="#E8E8E8" class="Estilo28"></td>
                <td bordercolor="#E8E8E8"><span class="Estilo28">
                  <input readonly size="40" name="num_ot_frida" type="text" id="campo20" value="<?php echo $rowOrden['num_ot_frida']; ?>" />
                </span></td>
                <td bordercolor="#E8E8E8" class="Estilo28">&nbsp;</td>
                <td bordercolor="#E8E8E8" class="Estilo36">&nbsp;</td>
                <td bordercolor="#E8E8E8" class="Estilo28">&nbsp;</td>
              </tr>
              <tr>
                <td bordercolor="#E8E8E8" class="Estilo36">Personal que Valid&oacute;</td>
                <td bordercolor="#E8E8E8" class="Estilo28"></td>
                <td bordercolor="#E8E8E8"><span class="Estilo28">
                  <input name="personal_valida" size="40" readonly type="text" id="per_val" value="<?php echo $rowOrden['personal_valida']; ?>" />
                </span></td>
                <td bordercolor="#E8E8E8"></td>
                <td bordercolor="#E8E8E8" class="Estilo36">Fecha de Validaci&oacute;n</td>
                <td bordercolor="#E8E8E8" class="Estilo28"><input name="fecha_val" readonly type="text" id="fecha_val" value="<?php echo $rowOrden['fecha_val']; ?>" />
                </td>
                <td bordercolor="#E8E8E8" class="Estilo28"></td>
              </tr>
              <tr>
                <td width="153" bordercolor="#E8E8E8" class="Estilo36">Asignaci&oacute;n de T&eacute;cnico </td>
                <td width="118" bordercolor="#E8E8E8" class="Estilo28"></td>
                <td width="145" bordercolor="#E8E8E8"><span class="Estilo28">
                
				<?php
			    if(!$tecnico or $rowOrden['estatus']=='VALIDADA' or $rowOrden['estatus']=='ASIGNACION DE TECNICO' or $rowOrden['estatus']=='EJECUTADA SIN PRUEBAS' or $rowOrden['estatus']=='AUTORIZADA') 
				{
					echo "<input type=button onclick='window.location.href=\"agenda_cns1.php?nomof=$Nombre_Oficial_ADSL&id_ot=".$rowOrden['id_ot']."&id_tabla=".$rowOrden['id_tabla']."&tabla=".$rowOrden['tabla']."\";' value='Agendar Tecnico'>";														
					
				}
				if($tecnico<>'') echo "<input name='tecnico' readonly type='text' id='tecnico' value='".$rowOrden['tecnico']."'>\n";
				?>
			    
                </span></td>
                <?php if ($rowOrden['estatus']=="EJECUTADA CON PRUEBAS")
                {?>
                	<td width="105" bordercolor="#E8E8E8" class="Estilo28">&nbsp;</td>
                	<td width="96" bordercolor="#E8E8E8" class="Estilo36">Fecha de Ejecuci&oacute;n</td>
                	<td bordercolor="#E8E8E8" class="Estilo28"><input name="fecha_val" readonly type="text" id="fecha_ejec" value="<?php echo $rowOrden['fecha_ejec']; ?>" />
                	</td>
              		</tr>
              		<?php 
			    }else {
			           ?>
              <tr>
                <td width="96" bordercolor="#E8E8E8" class="Estilo36">Fecha de Programaci&oacute;n</td>
                <td width="118" bordercolor="#E8E8E8" class="Estilo28"></td>
                <td bordercolor="#E8E8E8" class="Estilo28"><input name="fecha_val" readonly type="text" id="fecha_prog1" value="<?php echo $rowOrden['fecha_prog1'].' '.$rowOrden['hora_prog1']; ?>" />
                    <?php } ?>
                </td>
              </tr>
              <tr>
                <td width="96" bordercolor="#E8E8E8" class="Estilo36">Personal que Liquida</td>
                <td width="105" bordercolor="#E8E8E8" class="Estilo28">&nbsp;</td>
                <td width="142" bordercolor="#E8E8E8" class="Estilo28"><?php 
			             if ($rowOrden['estatus']=="EJECUTADA CON PRUEBAS"  or $rowOrden['estatus']=="EJECUTADA SIN PRUEBAS") echo "<input type=text name=personal value='$sess_nmb' readonly>";
			             else echo "<input type=text name=personal value='' readonly>";
			            ?>
                </td>
                <td bordercolor="#E8E8E8"></td>
                <td bordercolor="#E8E8E8" class="Estilo36"><span class="Estilo28">Fecha de Liquidaci&oacute;n</span></td>
                <td bordercolor="#E8E8E8" class="Estilo28"><input name="fecha_liq" readonly type="text" id="fecha_liq" value="<?php echo $rowOrden['fecha_liq']; ?>" />
                </td>
              </tr>
              <tr>
                <table width="825" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
                  <tr>
                    <?
			
                    
			if ($rowOrden['estatus']=="VALIDADA" or $rowOrden['estatus']=="ASIGNACION DE TECNICO")
			{
				echo "<tr>";
					echo "<td align='center' bordercolor='#CAE4FF' class='Estilo28'>";
					echo "<input type='submit' name='button' id='button' value='Autorizar' title='Autorizar la Orden: Requiere Tecnico que Atendio' onclick='document.liquida_autoriza_cluster.liq.value=\"AUTORIZADA\"'></td>";
				echo "</tr><tr><td bordercolor='#CAE4FF' class='Estilo28'>&nbsp;</td><td colspan='3' bordercolor='#CAE4FF' class='Estilo28'>Causa de Rechazo:</td></tr>";
			}
						  
			if ($perfil=="Tecnico cnsI" or $perfil=='CNSI')
			{		
			      echo "<td align='center' bordercolor='#CAE4FF' class='Estilo28'>Resultado del trabajo efectuado:<br>";
					echo "<select name='optec' id='optec' onchange='check_opc()'>
					 <option value=''></option>
					 <option value='EJECUTADA CON PRUEBAS'>Ejecutado con &eacute;xito y con pruebas</option>
					 <option value='EJECUTADA SIN PRUEBAS'>Ejecutado con &eacute;xito y sin pruebas</option>
					 <option value='EJECUTADA SIN EXITO'>Ejecutado sin &eacute;xito</option>
					 </select><br><br>Causa de Rechazo<br>";
					
					//<!- --------------------- --> 
						$query="select id_causa,causa from cat_causas where tabla='cat_anillo' order by causa";
						$res2 = mysql_query($query);
						if ($row = mysql_fetch_array($res2)){ 

							echo '<select multiple="multiple" name="causa_sel[]" id="causa_sel">';
							echo '<option></option>';
							do { 
								echo '<option value= "'.$row["causa"].'">'.$row["causa"].'</option>';
							} while ($row = mysql_fetch_array($res2)); 
								echo '</select>';
							}
					echo '</td>';
					//<!- --------------------- -->
					
					//<!- --------------------- -->
					echo '<td width="96" bordercolor="#E8E8E8" class="Estilo28">Observaciones:</td>';
					echo '<td width="142" bordercolor="#E8E8E8" class="Estilo28"><textarea name="observ" rows="5" cols="30" onclick="document.liquida_autoriza_cluster.liq.value=\'SAVE_OBS\'"></textarea>';
					echo '<input type="submit" name="button_save" id="button_save" value="Guardar Observaciones" /></td>';
					//<!- --------------------- -->

					echo "<tr><td align='right' bordercolor='#E8E8E8' class='Estilo28'><input type='submit' name='env_button' id='env_button' value='Enviar' onclick='document.liquida_autoriza_cluster.liq.value=document.liquida_autoriza_cluster.optec.value;document.liquida_autoriza_cluster.causa_r.value=document.liquida_autoriza_cluster.causa_sel.value'></td></tr>";
			}
			
			echo "<script>if(document.getElementById(\"causa_sel\"))
			document.getElementById(\"causa_sel\").disabled=true</script>";
			
			?>
			
			<script type="text/javascript">
				
				function check_opc()
				{
					if (document.getElementById("optec").value=='')
					{
						document.getElementById("env_button").disabled=true;
						document.getElementById("button_save").disabled=false;
						document.getElementById("causa_sel").disabled=true;
					}else if (document.getElementById("optec").value=='EJECUTADA SIN EXITO')
					{
						document.getElementById("causa_sel").disabled=false;
					}else{
						document.getElementById("env_button").disabled=false;
						document.getElementById("button_save").disabled=true;
						document.getElementById("causa_sel").disabled=true;
					}
				}
			</script>
			
			<?php
			
			if ($perfil<>"Tecnico cnsI" and $perfil<>'CNSI')
			{
				echo "<tr><td align='center' bordercolor='#CAE4FF'><input type='submit' name='button' id='button' value='Rechazar' title='Rechazar la Orden: Requiere Personal que Liquida' onclick='document.liquida_autoriza_cluster.liq.value=\"RECHAZADA\"'></td>";
				
				echo "<td align='left' bordercolor='#CAE4FF' class='Estilo28'>";
					//<!- --------------------- --> 
						$query="select id_causa,causa from cat_causas where tabla='cat_anillo' order by causa";
						$res2 = mysql_query($query);
						if ($row = mysql_fetch_array($res2)){ 

							echo '<select multiple="multiple" name="causa_sel[]" id="causa_sel">';
							echo '<option></option>';
							do {
								echo '<option value= "'.$row["causa"].'">'.$row["causa"].'</option>';
							} while ($row = mysql_fetch_array($res2));
							
							echo '</select>';
							}
							
					echo '</td></tr>';
					//<!- --------------------- -->
					echo "<tr><td colspan='4' bordercolor='#CAE4FF' class='Estilo28'>&nbsp;</td></tr>";
				
				//<!- --------------------- -->
				echo '<td width="96" bordercolor="#CAE4FF" class="Estilo28">Observaciones:</td>';
				echo '<td width="142" bordercolor="#CAE4FF" class="Estilo28"><textarea name="observ" rows="5" cols="25" onclick="document.liquida_autoriza_cluster.liq.value=\'SAVE_OBS\'"></textarea>';
				echo '<td width="20" bordercolor="#CAE4FF" class="Estilo28">&nbsp;</td>';
				//<!- --------------------- -->

				if ($rowOrden['estatus']=="EJECUTADA CON PRUEBAS" or $rowOrden['estatus']=="EJECUTADA SIN PRUEBAS")
				{
			      echo "<td align='center' bordercolor='#CAE4FF' class='Estilo28'>";
					echo "<input type='submit' name='button' id='button' value='Liquidar' title='Liquidar la Orden: Requiere Tecnico que Atendio y Personal que Liquida' onclick='document.liquida_autoriza_cluster.liq.value=\"LIQUIDADA\"'></td>";
				}
			 		
			 		echo "</td></tr>";
			 		echo "<tr><td bordercolor='#CAE4FF'>&nbsp;</td>";
			 		echo '<td bordercolor="#CAE4FF"><input type="submit" name="button_save" id="button_save" value="Guardar Observaciones" /></td>';
			 		echo "<td bordercolor='#CAE4FF'>&nbsp;</td>";
			 		
			}	// fin perfir <> tecnico cns1
			?>
                  </tr>
                </table>
              </tr>
            </table>
            
            </form>
		</div>
	</div>
	
	<div>
		<a name="BITACORAS" id="BITACORAS"></a>
		
		<div style="position:relative;">
			
			<table width="900" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
				<tr>
					<td bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">&nbsp;</span></td>
				</tr>
				<tr>
					<td bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">BITACORAS</span></td>
				</tr>
				<tr>
					<td bordercolor="#CAE4FF" class="Estilo28"><span class="Estilo4 Estilo31">&nbsp;</span></td>
				</tr>
			</table>
			
			<table width="900" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
				<tr>
					<?php
					echo '<td bordercolor="#CAE4FF" class="Estilo28">';
					
					$datos_obs=explode("|",$rowOrden['observaciones']);
					$ta_datos=sizeof($datos_obs);
					
					for ( $tt=0; $tt<$ta_datos; $tt++)
					{
						if ( strlen($datos_obs[$tt] > 3) ){
							echo "<br>2010-".$datos_obs[$tt];
							echo "<hr />";
						}
					}
					
					echo '</td>';
					?>
				</tr>
				
			</table>
			
		</div>
	</div>
	
</div>
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>

<div id="content"></div>
<div style="clear: both;"> </div>

</body>
</html>
