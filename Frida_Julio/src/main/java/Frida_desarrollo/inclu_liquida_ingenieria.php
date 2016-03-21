<?php
include("conexion.php"); 
//include("modulo_alta_fo_prov/Generic_querys_GOD.php");
//include("modulo_alta_fo_prov/components/Genericos_querys_mapper.php");
// VISTA 
$querySL 	= "SELECT * FROM servicios_ladaenlaces_fo WHERE ref_sisa='".$_GET['ref_sisa_a']."'   ";
$resSL 		= mysql_query($querySL);
$rowSL 		= mysql_fetch_array($resSL);

/*
$SL_ip_analisis = $rowSL['ip_analisis']; 					$SL_supervisor_analisis = $rowSL['supervisor_analisis'];
$SL_ip_ingenieria = $rowSL['ip_ingenieria']; 				$SL_supervisor_ingenieria=$rowSL['supervisor_ingenieria'];

if ($_REQUEST['envia_punta']=='A')
	{
		$SL_ip_eq_acc = $rowSL['ip_eq_acc']; 				$SL_supervisor_eq_acc = $rowSL['supervisor_eq_acc'];
		$SL_ip_fibra_optica = $rowSL['ip_fibra_optica']; 	$SL_supervisor_fibra_optica = $rowSL['supervisor_fibra_optica'];
		$SL_aplica_colectora_acc = $rowSL['aplica_colectora_acc'];
	}
else 
	{
		$SL_ip_eq_acc = $rowSL['ip_eq_acc_b']; 				$SL_supervisor_eq_acc = $rowSL['supervisor_eq_acc_b'];
		$SL_ip_fibra_optica = $rowSL['ip_fibra_optica_b']; 	$SL_supervisor_fibra_optica = $rowSL['supervisor_fibra_optica_b'];
		$SL_aplica_colectora_acc = $rowSL['aplica_colectora_acc_b'];
	}

// Arreglo de telefonos por Responsable
$var_SL = array($SL_ip_analisis, $SL_supervisor_analisis, $SL_ip_ingenieria, $SL_supervisor_ingenieria, $SL_ip_eq_acc, $SL_supervisor_eq_acc, $SL_ip_fibra_optica, $SL_supervisor_fibra_optica );
for($i=0; $i<count($var_SL); $i++)
	{
		$queryTE    = "SELECT telefono, id_tecnico FROM cat_tecnicos WHERE nombre='".$var_SL[$i]."'  ";
		$resTE 		= mysql_query($queryTE);
		$rowTE 		= mysql_fetch_array($resTE);
		$TE_tele[$i]= $rowTE['telefono'];
	}
*/

// CONSULTA GENERAL
$conca_refe = $_GET['ref_sisa_a']."-".$_GET['envia_punta'];
$query_equA = "SELECT * FROM inventario_demarcadores WHERE nomof LIKE '%".$conca_refe."%'  ";
$res_equA 	= mysql_query($query_equA);

for ($i=0; $i<mysql_num_rows($res_equA); $i++)
	{
		$eq_tdemar = mysql_result($res_equA, $i, 'tipo_demarcador');
		$eq_uso_equipo = mysql_result($res_equA, $i, 'uso_equipo');
		$eq_clli_adva = mysql_result($res_equA, $i, 'clli_adva');
		$eq_id = mysql_result($res_equA, $i, 'id');
		$eq_tipo_equipo = mysql_result($res_equA, $i, 'tipo_equipo');
		$eq_proveedor = mysql_result($res_equA, $i, 'proveedor');
		$eq_release_eq = mysql_result($res_equA, $i, 'release_eq');
		$eq_ubicacion_demarcador = mysql_result($res_equA, $i, 'ubicacion_demarcador');
		$eq_conexion_rcdt = mysql_result($res_equA, $i, 'conexion_rcdt');
		$eq_switch = mysql_result($res_equA, $i, 'switch');
		$eq_num_cambio = mysql_result($res_equA, $i, 'num_cambio');
		$eq_pto = mysql_result($res_equA, $i, 'pto');
		$eq_velocidad = mysql_result($res_equA, $i, 'velocidad');
		
		if ($eq_conexion_rcdt=='CONEXION DIRECTA A RCDT')// Contador para saber si le corresponde informacion
					{$a='OK'; 	$ctrl_switch=$eq_switch;  $ctrl_num_cambio=$eq_num_cambio; 	$ctrl_pto=$eq_pto; 	$ctrl_velocidad=$eq_velocidad; }
		
		if ($eq_tdemar=='NDE' || $eq_tdemar=='NDE-N' || $eq_uso_equipo=='CENTRAL' ) // nde / nde-n = central -- tx // central 
			{ //echo "<br>___CENTRAL___<br><br>";
				$var_ctrl='OK'; // VARIABLA PARA SABER QUE EXISTE REGISTROS
				
				$clli_ctrl=$eq_clli_adva; 		$ctrl_id=$eq_id; 				$ctrl_tipequip=$eq_tipo_equipo; 			$ctrl_conexrcdt=$eq_conexion_rcdt;
				$ctrl_prov=$eq_proveedor; 		$ctrl_rele=$eq_release_eq; 		$ctrl_ubidema=$eq_ubicacion_demarcador;
				//echo "--".$eq_conexion_rcdt;
				$var_condicion="nomof";
				// VARIABLE PARA SEMAFORO -- cliente 
				$var_Sem_ctrl = " clli_adva='".$clli_ctrl."'  ";
			}
		
		if ($eq_tdemar=='DDE' || $eq_tdemar=='DDE-N' || $eq_uso_equipo=='CLIENTE') // dde / dde-n = cliente  // cliente 
			{ //echo "<br>___CLIENTE___<br><br>"; 
				$var_cte='OK'; // VARIABLA PARA SABER QUE EXISTE REGISTROS
			   $var_condicion="nombre_oficial_pisa";
				$clli_cte=$eq_clli_adva;  		$cte_id=$eq_id; 				$cte_tipequip=$eq_tipo_equipo; 				$cte_conexrcdt=$eq_conexion_rcdt;
				$cte_prov=$eq_proveedor;   		$cte_rele=$eq_release_eq; 		$cte_ubidema=$eq_ubicacion_demarcador;
				if ($eq_conexion_rcdt=='CONEXION DIRECTA A RCDT')// Contador para saber si le corresponde informacion
					{$b='OK'; 	$cte_switch=$eq_switch; 	$cte_num_cambio=$eq_num_cambio; 	$cte_pto=$eq_pto; 	$cte_velocidad=$eq_velocidad; }
					
				// PUERTO SERVICIO
				$queryInPDe3 = "SELECT * FROM inventario_puertos_demarcadores WHERE clli_adva='".$clli_cte."' AND nombre_oficial_pisa='".$_GET['ref_sisa_a']."'  ";
				$resInPDe3 	= mysql_query($queryInPDe3);
				$rowInPDe3 	= mysql_fetch_array($resInPDe3);
				$puerto_InPDe3=$rowInPDe3['puerto']; 	$tipo_puerto_InPDe3=$rowInPDe3['tipo_puerto'];
			
				// VARIABLE PARA SEMAFORO -- TX
				$var_Sem_cte = " clli_adva='".$clli_cte."'  "; 
			}

	
		if ($eq_tdemar=='COLECTORA')  // colectora
			{ //echo "<br>COLECTORA<br>"; 
				$var_cole='OK'; // VARIABLA PARA SABER QUE EXISTE REGISTROS
				
				$clli_cole=$eq_clli_adva; 		$cole_id=$eq_id; 				$cole_tipequip=$eq_tipo_equipo; 			$cole_conexrcdt=$eq_conexion_rcdt;
				$cole_prov=$eq_proveedor; 		$cole_rele=$eq_release_eq; 		$cole_ubidema=$eq_ubicacion_demarcador;
				
			
				// VARIABLE PARA SEMAFORO -- COLECTORA
				$var_Sem_cole = " clli_adva='".$clli_cole."'  ";
				$var_condicion="nomof";
			}
			
		if ($eq_conexion_rcdt=='CONEXION DIRECTA A RCDT')// Contador para saber si le corresponde informacion
			{$c='OK'; 	$cole_switch=$eq_switch; 	$cole_num_cambio=$eq_num_cambio; 	$cole_pto=$eq_pto; 	$cole_velocidad=$eq_velocidad; }
	}
	

// CONSULTA A TABLA QUE LE CORRESPONDE 
$queryInDe  = "SELECT * FROM inventario_demarcadores WHERE clli_adva='".$clli_ctrl."'   ";
$resInDe 	= mysql_query($queryInDe);
$rowInDe 	= mysql_fetch_array($resInDe);

//ESTATUS DEL SERVICIO
$queryTab = "SELECT * FROM ".$rowSL['tabla']." WHERE ref_sisa='".$_GET['ref_sisa_a']."'   ";
$resTab 	= mysql_query($queryTab);
$rowTab 	= mysql_fetch_array($resTab);

if ($_REQUEST['envia_punta']=='A'){$estatus_ctl = $rowTab['req_ctl_a'];  $estatus_ctrl = $rowTab['req_ctrl_a'];  $estatus_cole = $rowTab['tipo_colectora_acc'];}
else 							  {$estatus_ctl = $rowTab['req_ctl_b'];  $estatus_ctrl = $rowTab['req_ctrl_b'];  $estatus_cole = $rowTab['tipo_colectora_acc_b'];}

//MOSTRAR BOTON

if($estatus_cole=='N/A') $mostrar_boton1='';
else $mostrar_boton1='OK';


//PUERTOS
/*$var_In_A1 = " clli_adva='".$clli_ctrl."' AND nombre_oficial_pisa='".$clli_cte."'     "; // CLIENTE
$var_In_A2 = " clli_adva='".$clli_ctrl."' AND nombre_oficial_pisa='".$clli_cole."'    "; // CLIENTE, COLECTORA
$var_In_A3 = " clli_adva='".$clli_cte."' AND nombre_oficial_pisa='".$clli_ctrl."'     "; // TX
$var_In_A4 = " clli_adva='".$clli_cole."' AND (nombre_oficial_pisa='".$clli_ctrl."' OR nombre_oficial_pisa='') AND (uso_puerto='TX' OR uso_puerto='CLIENTE' )  "; //COLEC
*/
$var_In_A1 = " clli_adva='".$clli_ctrl."' AND (nomof LIKE '%".$ref_sisa_a."%' OR nomof ='') "; // CLIENTE
$var_In_A2 = " clli_adva='".$clli_ctrl."' AND (nomof  LIKE '%".$ref_sisa_a."%' OR nomof ='')  "; // CLIENTE, COLECTORA
$var_In_A3 = " clli_adva='".$clli_cte."' AND (nomof  LIKE '%".$ref_sisa_a."%' OR nomof ='')   "; // TX
$var_In_A4 = " clli_adva='".$clli_cole."' AND (nomof  LIKE '%".$ref_sisa_a."%' OR nomof ='') AND (uso_puerto='TX' OR uso_puerto='CLIENTE' )  "; //COLEC

$var_In_A= array($var_In_A1, $var_In_A2, $var_In_A3, $var_In_A4);
for ($i=0; $i<count($var_In_A); $i++)
	{
		$queryInPDe = "SELECT * FROM inventario_puertos_demarcadores WHERE ".$var_In_A[$i]."  ";
		$resInPDe 	= mysql_query($queryInPDe);
		
		for ($j=0; $j<mysql_num_rows($resInPDe); $j++)
			{
				$uso_puerto_a = mysql_result($resInPDe,$j,'uso_puerto');
				$puerto_a = mysql_result($resInPDe,$j,'puerto');
				$tipo_puerto_a = mysql_result($resInPDe,$j,'tipo_puerto');

				if ($i==0)
					{ // CLIENTE
						if ($uso_puerto_a=='CLIENTE' || $uso_puerto_a=='CLIENTE-PRIMARIO')
											{
											
											   if($ctrl_tipequip=='FSP 150GE-X')
											   {$puerto_tx=mysql_result($resInPDe,$j,'repisat')."-".mysql_result($resInPDe,$j,'slot')."-".$puerto_a; $tipo_puerto_tx=$tipo_puerto_a;}
											   $aplica_puerto_a1='OK';
											}
						elseif ($uso_puerto_a == 'CLIENTE-SECUNDARIO')
											{$puerto_txsec=$puerto_a;  $tipo_puerto_txsec=$tipo_puerto_a;}
					}
				if ($i==1)
					{/// CLIENTE, COLECTORA
						if ($uso_puerto_a=='TX' && mysql_num_rows($resInPDe)=='1')
											{$puerto_clicol=$puerto_a; $tipo_puerto_clicol=$tipo_puerto_a; $aplica_puerto_d1='OK';}
					}
				if ($i==2)
					{ // TX
						$puerto_cl;
						if ($uso_puerto_a=='TX' || $uso_puerto_a=='TX-PRIMARIO'){ $puerto_cl=$puerto_a;  $tipo_puerto_cl=$tipo_puerto_a;  $aplica_puerto_b1='OK'; }
						elseif ($uso_puerto_a == 'TX-SECUNDARIO')				{ $puerto_clsec=$puerto_a;  $tipo_puerto_clsec=$tipo_puerto_a;}
					}
				if ($i==3) 
					{ // COLECTORA
						if ($uso_puerto_a=='TX') 			{$puerto_col=$puerto_a; 	$tipo_puerto_col=$tipo_puerto_a;  $aplica_puerto_c1='OK';  } // hacia nube
						elseif ($uso_puerto_a == 'CLIENTE') {$puerto_colsec=$puerto_a; 	$tipo_puerto_colsec=$tipo_puerto_a;  } // hacia equipo
					}
			}
	}



//____________ SEMAFORO _________
// ARREGLO PARA SEMAFORO
$var_Sem_A= array($var_Sem_ctrl, $var_Sem_cte, $var_Sem_cole );
for ($i=0; $i<count($var_Sem_A); $i++)
	{
		if ($var_Sem_A[$i]!='') 
			{
				$querySemPDe = "SELECT estatus_alta, estatus_ap, estatus_val_sup, estatus_proveedor, estatus_cm, estatus_cna, estatus_ptoext, estatus_adva, estatus_adva_exp FROM inventario_demarcadores WHERE ".$var_Sem_A[$i]."  ";
				$resSemPDe 	= mysql_query($querySemPDe);
				$rowSemPDe= mysql_num_rows($resSemPDe);
				if ($rowSemPDe=='0'){$variablerowSem='0';} else {$variablerowSem=$rowSemPDe;}
				
				for ($j=0; $j<$variablerowSem; $j++)
					{
						$estatus_alta_S[] = mysql_result($resSemPDe,$j,'estatus_alta'); 				$estatus_ap_S[] = mysql_result($resSemPDe,$j,'estatus_ap');
						//$ot_infra_S = mysql_result($resSemPDe,$j,'ot_infra'); 						$estatus_val_sup_S = mysql_result($resSemPDe,$j,'estatus_val_sup');
						$estatus_proveedor_S[] = mysql_result($resSemPDe,$j,'estatus_proveedor'); 	$estatus_cm_S[] = mysql_result($resSemPDe,$j,'estatus_cm');
						$estatus_cna_S[] = mysql_result($resSemPDe,$j,'estatus_cna'); 				$estatus_ptoext_S[] = mysql_result($resSemPDe,$j,'estatus_ptoext');
						$estatus_adva_S[] = mysql_result($resSemPDe,$j,'estatus_adva');				$estatus_expcorp_S[] = mysql_result($resSemPDe,$j,'estatus_adva_exp');	
					}
			}
	}

/* ___ SEMAFORO -- COLORES ___ 	#FFFFB7 -- AMARILLO 		#A5DF00 -- VERDE 		#F3F3F3 -- GRIS 		#FF97A2 -- ROJO CLARO 		#FE2E2E -- ROJO  */
$color=array(
				"POR VALIDAR"=>'#FFFFB7', "POR REVISAR"=>'#FFFFB7', "VALIDADA"=>'#FFFFB7', "ASIGNACION DE TECNICO"=>'#FFFFB7', "AUTORIZADA"=>'#FFFFB7',
				"LIQUIDADA"=>'#A5DF00', "EJECUTADA CON PRUEBAS"=>'#A5DF00', "EJECUTADA SIN PRUEBAS"=>'#A5DF00', "OK"=>'#A5DF00', 
				""=>'#F3F3F3', "N/A"=>'#F3F3F3', "EN ESPERA"=>'#F3F3F3', 
				"PROVIENE DE RECHAZO"=>'#FF97A2', 
				"EJECUTADA SIN EXITO"=>'#FE2E2E', 
			);

/*$valor_busqueda_liquida=Genericos_querys_mapper::generyc_mapper_querys(
"select",
$_GET['ref_sisa_a'],
$_GET['envia_punta'],
"construccion_equipo",
$valores=array(
         "12"=>"1",
		 "14"=>"1"
         ),
"array_asoc"
);*/

$query_inputs="select * from construccion_equipo where ref_sisa='".$_GET['ref_sisa_a']."' and punta='".$_GET['envia_punta']."'";
$resula=mysql_query($query_inputs);
$valor_busqueda_liquida=mysql_fetch_array($resula);

?>

<!-- INICIO TRANSPORTE  -->
<table id="tbGeneral">
<tr>
    <td align='left'>Construcci&oacute;n estatus <input type="text" readonly="readonly" value="<?=$valor_busqueda_liquida['const_estatus']?>" />
    </td>
     <td align='left'>Proyecto estatus:<input type="text" readonly="readonly" value="<?=$valor_busqueda_liquida['proyecto_estatus']?>" />
    </td>
    </tr>

	<?php
		$mysql_Tras = "SELECT * FROM inventario_servicios_tx WHERE ref_sisa='".$_GET['ref_sisa_a']."' AND punta='".$_GET['envia_punta']."'  ";
		$query_Tras = mysql_query($mysql_Tras);
		$rowTras = mysql_fetch_array($query_Tras,MYSQL_ASSOC);
		
	?>
	<?php 
	if($rowSL['tipo_transporte']=='ETH/SDH' || $rowSL['tipo_transporte']=='SDH')
	{
	?>
	<tr class="tituloRojo1"><td colspan='6' align='left'>EQUIPO TRANSPORTE</td></tr>
	
	<tr >
<td align='left'>Clli Equipo</td><td align='left'><input name='tx_clli_cole' type='text' value='<?=$rowTras['clli_puerto']?>' size='15' readonly="readonly" /></td>
		<td align='left'>Puerto</td><td align='left'><input name='tx_puerto' type='text' value='<?=$rowTras['tx_puerto']?>' size='15' readonly="readonly" /></td>
		<td align='left'>Remates</td><td align='left'><input name='tx_remates' type='text' value='<?=$rowTras['tx_remates']?>' size='15' readonly="readonly" /></td>
	</tr>
	<?php } ?>
</table>
<!-- FIN TRANSPORTE -->



<!-- INICIO EQUIPO COLECTORA -->
<?PHP if($var_cole=='OK'){ // mostrar la colectora ?>
<table class="tbGeneralBl">
<tr>
    <td align='left'>Construcci&oacute;n estatus <input type="text" readonly="readonly" value="<?=$valor_busqueda_liquida['const_estatus']?>" />
    </td>
     <td align='left'>Proyecto estatus:<input type="text" readonly="readonly" value="<?=$valor_busqueda_liquida['proyecto_estatus']?>" />
    </td>
    </tr>
    
    <tr height="4" align="center">	
    
	<?PHP 
	$color_cole[0]=$color[$estatus_alta_S[2]];  $color_cole[3]=$color[$estatus_val_sup_S[2]];      $color_cole[6]=$color[$estatus_ptoext_S[2]];
	$color_cole[1]=$color[$estatus_ap_S[2]];    $color_cole[4]=$color[$estatus_proveedor_S[2]];    $color_cole[7]=$color[$estatus_adva_S[2]];
	$color_cole[2]=$color[$ot_infra_S[2]];	   $color_cole[5]=$color[$estatus_cna_S[2]];          $color_cole[8]=$color[$estatus_cm_S[2]];
	 $color_cole[9]=$color[$estatus_expcorp_S[2]];
	
			
		 	for($p=0;$p<9;$p++){
				if($color_cole[$p]=="#A5DF00"){ $limite=$p;	$p=9;}	
			}
			
			while($limite>0)
			{
				$limite=$limite-1;
				if($color_cole[$limite]=="#F3F3F3") $color_cole[$limite]='#A5DF00';
			}
	
	
	if($rowSL['tabla']!='ciudad_segura'){?>
		<td bgcolor="<?=$color_cole[0]?>" 		title="<?=$estatus_alta_S[2]?>">PROYECTO </td>
		<!--<td bgcolor="<?=$color_cole[1]?>" 		title="<?=$estatus_ap_S[2]?>">ASIGNACION PUERTOS </td>
		<td bgcolor="<?=$color_cole[2]?>" 			title="<?=$ot_infra_S[2]?>">OT INFRA</td>
		<td bgcolor="<?=$color_cole[3]?>" 	title="<?=$estatus_val_sup_S[2]?>">VALIDACION SUPERVISOR</td>
		<td bgcolor="<?=$color_cole[4]?>" 	title="<?=$estatus_proveedor_S[2]?>">EJECUCION PROVEEDOR</td>
		<td bgcolor="<?=$color_cole[5]?>" 		title="<?=$estatus_cna_S[2]?>">CONFIG TX CD SEG(CNA)</td>-->
		<td bgcolor="<?=$color_cole[9]?>" 	title="<?=$estatus_expcorp_S[2]?>">EXP. CORP.</td>
		<td bgcolor="<?=$color_cole[8]?>" 	title="<?=$estatus_ptoext_S[2]?>">CONFIG TX &nbs</td>
		<td bgcolor="<?=$color_cole[7]?>" 		title="<?=$estatus_adva_S[2]?>">CONFIG ACCESO (CNS IV)</td>
		<!--<td bgcolor="<?=$color_cole[8]?>" 		title="<?=$estatus_cm_S[2]?>">RECEPCION O&M </td>-->
	<?php }
	elseif($rowSL['tabla']=='ciudad_segura'){	?>	
		<td bgcolor="<?=$color_cole[0]?>" 		title="<?=$estatus_alta_S[2]?>">PROYECTO </td>
		<td bgcolor="<?=$color_cole[3]?>" 	title="<?=$estatus_val_sup_S[2]?>">VALIDACION SUPERVISOR</td>
		<td bgcolor="<?=$color_cole[6]?>" 	title="<?=$estatus_ptoext_S[2]?>">CONFIG TX &nbsp;&nbsp;(CNS I)</td>
		<td bgcolor="<?=$color_cole[7]?>" 		title="<?=$estatus_adva_S[2]?>">CONFIG ACCESO (CNS IV)</td>
	<?php
	}
	?>
	</tr>
</table>
<table id="tbGeneral">
	<tr class="tituloRojo1"><td colspan="4" align="left">COLECTORA</td></tr>
	
	<tr>
		<td>Proyecto:</td>
		<?php echo "Tabla ".$rowSL['tabla']!='ciudad_segura';  ?>
		<td colspan="2"><input name="text6" type="text" id="text6" value="<?=$estatus_cole?>" size="30" readonly='readonly' />
		<?php if ($mostrar_boton1=='OK' && $rowSL['tabla']!='ciudad_segura')
		{	
			if($clli_cole!='') $envia_clli='clliadva='.$clli_cole.'&'; else $envia_clli='';
			$coca_vinculo_a = $_REQUEST['ref_sisa_a']."-".$_REQUEST['envia_punta']; ?><input type="button" name="Submit" value="Inventario" onclick="window.open('altas_demarcador.php?<?php echo $envia_clli;?>id_equipo=<?php echo $cole_id; ?>&refEnv=<?php echo $_REQUEST['ref_sisa_a'] ?>&lado=<?php echo $_REQUEST['envia_punta']; ?>&medioAcceso=<?php echo  $rowSL['material']; ?>&pag=pequ')" />
		<?PHP } ?></td>
		<td></td>
	</tr>
	
	<tr>
		<td>Clli Equipo</td>
		<td colspan="2"><input name="text6" type="text" id="text7" value="<?=$clli_cole?>" size="30" readonly='readonly' /></td>
		<td></td>
	</tr>

	<tr>
		<td>-Modelo del Equipo</td><td><input name="text6" type="text" id="text8" value="<?=$cole_tipequip?>" size="30" readonly='readonly' /></td>
		<td>-Proveedor del Equipo</td><td><input name="text6" type="text" id="text9" value="<?=$cole_prov?>" size="30" readonly='readonly' /></td>
	</tr>

	<tr>
		<td>-Ubicacion</td><td><input name="text6" type="text" id="text10" value="<?=$cole_ubidema?>" size="30" readonly='readonly' /></td>
		<td>-Release</td><td><input name="text6" type="text" id="text11" value="<?=$cole_rele?>" size="30" readonly='readonly' /></td>
	</tr>
	
	<tr>
		<td>-Conexion RCDT</td><td><input name="text6" type="text" id="text10" value="<?=$cole_conexrcdt?>" size="30" readonly='readonly' /></td>
		<td></td><td></td>
	</tr>
	
	<tr bgcolor="#999999"><td colspan="4" height="4"></td></tr>
	
	<tr class="tituloRojo1"><td colspan="4" align="left">Informacion del Puerto Cliente</td></tr>
	
	<tr>
		<td>Puerto Colectora TX </td><td><input name="text6" type='text' id='text12' value='<?=$puerto_col?>' size='30' readonly='readonly'></td>
		<?php //if ($aplica_puerto_c1!='OK') {?><td>Puerto Colectora Central </td><td><input name="text6" type='text' id='text13' value='<?=$puerto_colsec?>' size='30' readonly='readonly'></td><?PHP //} ?>
	</tr>
	
	<tr>
		<td>Tipo Puerto</td><td><input name="text6" type="text" id='text14' value='<?=$tipo_puerto_col?>' size="30" readonly='readonly' /></td>
		<?php //if ($aplica_puerto_c1!='OK') {?><td>Tipo Puerto</td><td><input name="text6" type="text" id='text15' value='<?=$tipo_puerto_colsec?>' size="30" readonly='readonly' /></td><?PHP //} ?>
	</tr>
	
	<tr bgcolor="#999999"><td colspan="4" height="4"></td></tr>
	
	<?php if ($c=='OK'){?>
	<tr>
		<td>-Switch</td><td><input name="cole_switch" type="text" id="cole_switch" value="<?=$cole_switch?>" size="30" readonly='readonly' /></td>
		<td>-Num Cambios</td><td><input name="text62" type="text" id="text62" value="<?=$cole_num_cambio?>" size="30" readonly='readonly' /></td>
	</tr>
	
	<tr>
		<td>-Puerto</td><td><input name="text63" type="text" id="text63" value="<?=$cole_pto?>" size="30" readonly='readonly' /></td>
		<td>-Velocidad</td><td><input name="text622" type="text" id="text622" value="<?=$cole_velocidad?>" size="30" readonly='readonly' /></td>
	</tr>
	<?php } ?>

</table>
<?PHP } ?>
<!-- FIN EQUIPO COLECTORA -->


<!-- INICIO EQUIPO CENTRAL -->
<br /><br />
<table class="tbGeneralBl">
	<tr height="4" align="center">	
	<?php 
	$color_central[0]=$color[$estatus_alta_S[0]];  $color_central[3]=$color[$estatus_val_sup_S[0]];      $color_central[6]=$color[$estatus_ptoext_S[0]];
	$color_central[1]=$color[$estatus_ap_S[0]];    $color_central[4]=$color[$estatus_proveedor_S[0]];    $color_central[7]=$color[$estatus_adva_S[0]];
	$color_central[2]=$color[$ot_infra_S[0]];	   $color_central[5]=$color[$estatus_cna_S[0]];          $color_central[8]=$color[$estatus_cm_S[0]];
	$color_central[9]=$color[$estatus_expcorp_S[0]];
			
		 	for($p=0;$p<9;$p++){
				if($color_central[$p]=="#A5DF00"){ $limite=$p;	$p=9;}	
				//echo "<br>LIMITE".$color_central[$p];	
			}
			
			while($limite>0)
			{
				//echo "<br>LIMITE".$limite."--".$color_central[$limite];
				$limite=$limite-1;
				if($color_central[$limite]=="#F3F3F3") $color_central[$limite]='#A5DF00';
			}
	
	
	if($rowSL['tabla']!='ciudad_segura'){
			
	?>
		 <td bgcolor="<?=$color_central[0]?>" 		title="<?=$estatus_alta_S[0]?>">PROYECTO </td>
		<!-- <td bgcolor="<?=$color_central[1]?>" 		title="<?=$estatus_ap_S[0]?>">ASIGNACION PUERTOS </td>
		<td bgcolor="<?=$color_central[2]?>" 		title="<?=$ot_infra_S[0]?>">OT INFRA</td>
		<td bgcolor="<?=$color_central[3]?>" 	    title="<?=$estatus_val_sup_S[0]?>">VALIDACION SUPERVISOR</td>
		<td bgcolor="<?=$color_central[4]?>" 	    title="<?=$estatus_proveedor_S[0]?>">EJECUCION PROVEEDOR</td>
		
		<td bgcolor="<?=$color_central[5]?>" 		title="<?=$estatus_cna_S[0]?>">CONFIG TX CD SEG(CNA)</td>-->
		
		<td bgcolor="<?=$color_central[6]?>" 	    title="<?=$estatus_expcorp_S[0]?>">EXP. CORP.</td>
		<td bgcolor="<?=$color_central[6]?>" 	    title="<?=$estatus_ptoext_S[0]?>">CONFIG TX &nbsp;&nbsp;(CNS I)</td>
		<td bgcolor="<?=$color_central[7]?>" 		title="<?=$estatus_adva_S[0]?>">CONFIG ACCESO (CNS IV)</td>
		<!--<td bgcolor="<?=$color_central[8]?>" 		title="<?=$estatus_cm_S[0]?>">RECEPCION O&M </td>-->
	<?php }
	elseif($rowSL['tabla']=='ciudad_segura')
	{
	?>
		<td bgcolor="<?=$color_central[0]?>" 		title="<?=$estatus_alta_S[0]?>">PROYECTO </td>
		<td bgcolor="<?=$color_central[3]?>" 	title="<?=$estatus_val_sup_S[0]?>">VALIDACION SUPERVISOR</td>
		<td bgcolor="<?=$color_central[6]?>" 	title="<?=$estatus_ptoext_S[0]?>">CONFIG TX &nbsp;&nbsp;(CNS I)</td>
		<td bgcolor="<?=$color_central[7]?>" 		title="<?=$estatus_adva_S[0]?>">CONFIG ACCESO (CNS IV)</td>
	<?php } ?>
	</tr>
</table>

<table id="tbGeneral">
	<tr class="tituloRojo1"><td colspan="4" align="left">EQUIPO CENTRAL</td></tr>

	<tr>
		<td>Proyecto:</td>
		<td colspan="2">
		    <?php if($clli_ctrl!='') $envia_clli='clliadva='.$clli_ctrl.'&'; else $envia_clli=''; ?>
			<input name="text" type="text" id="text" value="<?=$estatus_ctrl?>" size="30" readonly='readonly' />
			<?php if ($mostrar_boton1=='OK' && $rowSL['tabla']!='ciudad_segura'){$coca_vinculo_a = $_REQUEST['ref_sisa_a']."-".$_REQUEST['envia_punta']; ?><input type="submit" name="button" value="Inventario" onclick="window.open('altas_demarcador.php?<?php echo $envia_clli;?>id_equipo=<?php echo $ctrl_id; ?>&refEnv=<?php echo $_REQUEST['ref_sisa_a'] ?>&lado=<?php echo $_REQUEST['envia_punta']; ?>&medioAcceso=<?php echo  $rowSL['material']; ?>&pag=pequ')" /><?PHP } 
			elseif($rowSL['tabla']=='ciudad_segura'){$coca_vinculo_a = $_REQUEST['ref_sisa_a']."-".$_REQUEST['envia_punta']; ?>
			<input type="button" name="Submit" value="Inventario" onclick="window.open('altas_demarcador.php?<?php echo $envia_clli;?>id_equipo=<?php echo $ctrl_id; ?>&refEnv=<?php echo $_REQUEST['ref_sisa_a'] ?>&lado=<?php echo $_REQUEST['envia_punta'] ?>&pag=pequ')" />
		<?php } ?>
		</td>
		<td></td>
	</tr>

	<tr>
		<td>Clli Equipo</td><td colspan="2"><input type="text" size="30" id="clli_equ_ctrl" value="<?=$clli_ctrl?>" readonly='readonly' /></td>
		<td></td>        
	</tr>

	
	<?php
	if($estatus_ctrl=='Equipo Nuevo')
	{
		$query_modelo=mysql_query("SELECT modelo_ctrl_".$envia_punta." FROM ".$rowSL['tabla']." WHERE ref_sisa='".$_GET['ref_sisa_a']."'");
		//echo "SELECT modelo_ctrl_".$envia_punta." FROM ".$rowSL['tabla']." WHERE ref_sisa='".$_GET['ref_sisa_a']."'";
		$ctrl_tipequip=mysql_result($query_modelo,0,0);
		$query_prov=mysql_query("SELECT proveedor FROM cat_equipo WHERE tipo_equipo='".$ctrl_tipequip."'");
		$ctrl_prov=mysql_result($query_prov,0,0);
	}
	?>
	<tr>
		<td>-Modelo del Equipo</td><td><input type="text" size="30" id="tipo_equipo" value="<?=$ctrl_tipequip?>" readonly='readonly' /></td>
		<td>-Proveedor del Equipo</td><td><input type="text" size="30" id="proveedor" value="<?=$ctrl_prov?>" readonly='readonly' /></td>
	</tr>
	
	<tr>
		<td>-Ubicacion</td><td><input type="text" size="30" id="ubicacion_demarcador" value="<?=$ctrl_ubidema?>" readonly='readonly' /></td>
		<td>-Release</td><td><input type="text" size="30" id="release_eq" value="<?=$ctrl_rele?>" readonly='readonly' /></td>
	</tr>

	<tr>
		<td>-Conexion RCDT</td><td><input type="text" size="30" id="ubicacion_demarcador" value="<?=$ctrl_conexrcdt?>" readonly='readonly' /></td>
		<td></td><td></td>
	</tr>

<?php if ($aplica_puerto_d1=='OK'){?>
	<tr bgcolor="#999999"><td colspan="4" height="4"></td></tr>
	
	<tr class="tituloRojo1"><td colspan="4" align="left">Informacion del Puerto Cliente Colectora</td></tr>
	
	<tr>
		<td>Puerto Cliente Colectora</td><td><input type='text' size='30' id='puerto_tx' value='<?=$puerto_clicol?>' readonly='readonly' ></td>
		<td></td><td></td>
	</tr>
	
	<tr>
		<td>Tipo Puerto</td><td><input type="text" size="30" id='tipo_puerto_tx' value='<?=$tipo_puerto_clicol?>' readonly='readonly' /></td>
		<td></td><td></td>
	</tr>
<?PHP } ?> 
	<tr bgcolor="#999999"><td colspan="4" height="4"></td></tr>
	
	<tr class="tituloRojo1"><td colspan="4" align="left">Informacion del Puerto Cliente</td></tr>
	
	<tr>
		<!--<td>Puerto Cliente</td><td><input type='text' size='30' id='puerto_tx' value='<?=$puerto_tx?>' readonly='readonly' ></td>-->
		<?php if ($aplica_puerto_a1!='OK') {?><td>Puerto Cliente Secundario</td><td><input type='text' size='30' id='puerto_txsec' value='<?=$puerto_txsec?>' readonly='readonly' ></td><?PHP } ?>
	</tr>
	
	<tr>
		<td>Tipo Puerto</td><td><input type="text" size="30" id='tipo_puerto_tx' value='<?=$tipo_puerto_tx?>' readonly='readonly' /></td>
		<?php if ($aplica_puerto_a1!='OK') {?><td>Tipo Puerto</td><td><input type="text" size="30" id='tipo_puerto_txsec' value='<?=$tipo_puerto_txsec?>' readonly='readonly' /></td><?PHP } ?>
	</tr> 
	
	<tr bgcolor="#999999"><td colspan="4" height="4"></td></tr>
	
	<?php if ($a=='OK'){?>
	<tr>
		<td>-Switch</td><td><input name="text6" type="text" id="text10" value="<?=$ctrl_switch?>" size="30" readonly='readonly' /></td>
		<td>-Num Cambios</td><td><input name="text62" type="text" id="text62" value="<?=$ctrl_num_cambio?>" size="30" readonly='readonly' /></td>
	</tr>
	
	<tr>
		<td>-Puerto</td><td><input name="text63" type="text" id="text63" value="<?=$ctrl_pto?>" size="30" readonly='readonly' /></td>
		<td>-Velocidad</td><td><input name="text622" type="text" id="text622" value="<?=$ctrl_velocidad?>" size="30" readonly='readonly' /></td>
	</tr>
	<?php } ?>
	
	<?php
	//============Puertos
		$sql_puertos_id = "SELECT puerto,ubicacion_bdfo,repisa_bdfo,contacto_bdfo, repisat, slot FROM inventario_puertos_demarcadores WHERE clli_adva='".$GE_clli_ctrl."' AND nombre_oficial_pisa='".$GE_clli_cte."' AND nomof LIKE '%".$_REQUEST['ref_sisa_a']."%'   ";
		$sql_puertos_cobre=mysql_query($sql_puertos_id);
	if(mysql_num_rows($sql_puertos_cobre)>0){
	?>
	<tr bgcolor="#999999"><td colspan="4" height="4"></td></tr>
	<tr class="tituloRojo1"> <td colspan="4" align="left" bordercolor="#999999">Puertos</td> </tr>
			<tr>
			<td align="left" bgcolor="#999999">Puerto</td><td bgcolor="#999999">Ubicaci&oacute;n</td><td bgcolor="#999999">Repisa</td><td bgcolor="#999999">Contacto</td>
			<tr>
			<?php
				
				
				for($i=0;$i<mysql_num_rows($sql_puertos_cobre);$i++)
				{
					if($ctrl_tipequip='FSP 150GE-X') $pto_ctrl=mysql_result($sql_puertos_cobre,$i,'repisat')."-".mysql_result($sql_puertos_cobre,$i,'slot')."-".mysql_result($sql_puertos_cobre,$i,0);
					else $pto_ctrl=mysql_result($sql_puertos_cobre,$i,0);
					
					echo "<tr><td bordercolor='#999999'><input type='text' value='".$pto_ctrl."' readonly='readonly' size='40'></td>";
					echo "<td bordercolor='#999999'><input type='text' value='".mysql_result($sql_puertos_cobre,$i,1)."' readonly='readonly' ></td>";
					echo "<td bordercolor='#999999'><input type='text' value='".mysql_result($sql_puertos_cobre,$i,2)."' readonly='readonly' size='10'></td>";
					echo "<td bordercolor='#999999'><input type='text' value='".mysql_result($sql_puertos_cobre,$i,3)."' readonly='readonly' size='10'></td></tr>";
				}
	}
	?>
</table>
<!-- FIN EQUIPO CENTRAL -->



<!-- INICIO EQUIPO CLIENTE -->
<br /><br />
<table class="tbGeneralBl">
<?php 
    $color_cliente[0]=$color[$estatus_alta_S[1]];  $color_cliente[3]=$color[$estatus_val_sup_S[1]];      $color_cliente[6]=$color[$estatus_ptoext_S[1]];
	$color_cliente[1]=$color[$estatus_ap_S[1]];    $color_cliente[4]=$color[$estatus_proveedor_S[1]];    $color_cliente[7]=$color[$estatus_adva_S[1]];
	$color_cliente[2]=$color[$ot_infra_S[1]];	   $color_cliente[5]=$color[$estatus_cna_S[1]];          $color_cliente[8]=$color[$estatus_cm_S[1]];
	$color_cliente[9]=$color[$estatus_expcorp_S[1]];
			
		 	for($p=0;$p<9;$p++){
				if($color_cliente[$p]=="#A5DF00"){ $limite=$p;	$p=9;}		
			}
			
			while($limite>0)
			{
				$limite=$limite-1;
				if($color_cliente[$limite]=="#F3F3F3") $color_cliente[$limite]='#A5DF00';
			}


if($rowSL['tabla']!='ciudad_segura'){ ?>
	<tr height="4" align="center">	<!-- 2s -->
		<td bgcolor="<?=$color_cliente[0]?>" 		title="<?=$estatus_alta_S[1]?>">PROYECTO </td>
		<!--<td bgcolor="<?=$color_cliente[1]?>" 		title="<?=$estatus_ap_S[1]?>">ASIGNACION PUERTOS </td>
		<td bgcolor="<?=$color_cliente[2]?>" 			title="<?=$ot_infra_S[1]?>">OT INFRA</td>
		<td bgcolor="<?=$color_cliente[3]?>" 	title="<?=$estatus_val_sup_S[1]?>">VALIDACION SUPERVISOR</td>
		<td bgcolor="<?=$color_cliente[4]?>" 	title="<?=$estatus_proveedor_S[1]?>">EJECUCION PROVEEDOR</td>
		
		<td bgcolor="<?=$color_cliente[5]?>" 		title="<?=$estatus_cna_S[1]?>">CONFIG TX CD SEG(CNA)</td>-->
		<td bgcolor="<?=$color_cliente[9]?>" 	title="<?=$estatus_expcorp_S[1]?>">EXP. CORP.</td>
		<td bgcolor="<?=$color_cliente[6]?>" 	title="<?=$estatus_ptoext_S[1]?>">CONFIG TX &nbsp;&nbsp;(CNS I)</td>
		<td bgcolor="<?=$color_cliente[7]?>" 		title="<?=$estatus_adva_S[1]?>">CONFIG ACCESO (CNS IV)</td>
		<!--<td bgcolor="<?=$color_cliente[8]?>" 		title="<?=$estatus_cm_S[1]?>">RECEPCION O&M </td>-->
	<?php } 
	elseif($rowSL['tabla']=='ciudad_segura'){
	?>
		<td bgcolor="<?=$color_cliente[0]?>" 		title="<?=$estatus_alta_S[1]?>">PROYECTO </td>
		<td bgcolor="<?=$color_cliente[3]?>" 	title="<?=$estatus_val_sup_S[1]?>">VALIDACION SUPERVISOR</td>
		<td bgcolor="<?=$color_cliente[6]?>" 	title="<?=$estatus_ptoext_S[1]?>">CONFIG TX &nbsp;&nbsp;(CNS I)</td>
		<td bgcolor="<?=$color_cliente[7]?>" 		title="<?=$estatus_adva_S[1]?>">CONFIG ACCESO (CNS IV)</td>
	<?php } ?>
	</tr>
</table>

<table id="tbGeneral2">
	<tr class="tituloRojo1"><td colspan="4" align="left">EQUIPO CLIENTE</td></tr>

	<tr>
		<td>Proyecto:</td>
		<td colspan="2">
			<input name="text2" type="text" id="text2" value="<?=$estatus_ctl?>" size="30" readonly='readonly' />
			<?php if ($mostrar_boton1=='OK' && $rowSL['tabla']!='ciudad_segura')
			{ 
				if($clli_cte!='') $envia_clli='clliadva='.$clli_cte.'&'; else $envia_clli='';
				$coca_vinculo_a = $_REQUEST['ref_sisa_a']."-".$_REQUEST['envia_punta'];
				if($cte_id!='')
				{
			    ?>
					<input type="button" name="Submit" value="Inventario" onclick="window.open('altas_demarcador.php?<?php echo $envia_clli;?>id_equipo=<?php echo $cte_id; ?>&refEnv=<?php echo $_REQUEST['ref_sisa_a'] ?>&lado=<?php echo $_REQUEST['envia_punta']; ?>&medioAcceso=<?php echo  $rowSL['material']; ?>&pag=pequ')" />  <?PHP } 
				else
				{ ?>
					<input type="button" name="Submit" value="Inventario" onclick="window.open('altas_demarcador.php?<?php echo $envia_clli;?>refEnv=<?php echo $_REQUEST['ref_sisa_a']; ?>&lado=<?php echo $_REQUEST['envia_punta']; ?>&pag=pequ')" />  
		  <?PHP }
			}	?>
					
		</td>
	    <td>&nbsp;</td>
	</tr>
	
	<tr>
		<td>-Domicilio del Cliente</td>
		<td colspan="3"><textarea cols="50" rows="3" id="domicilio_a" readonly='readonly'><?php if ($_REQUEST['envia_punta']=='A'){ echo $rowSL['domicilio_a'];} else {echo $rowSL['domicilio_b'];}?></textarea></td>
	</tr>
	
	<tr>
		<td>-Clli Equipo</td><td colspan="2"><input type="text" size="30" id="clli_equipo_cte" value="<?=$clli_cte?>" readonly='readonly' /></td>
		<td></td>
	</tr>
	<?php
	if($estatus_ctl=='Equipo Nuevo')
	{
		$query_modelo=mysql_query("SELECT modelo_ctl_".$envia_punta." FROM ".$rowSL['tabla']." WHERE ref_sisa='".$_GET['ref_sisa_a']."'");
		//echo "SELECT modelo_ctl_".$envia_punta." FROM ".$rowSL['tabla']." WHERE ref_sisa='".$_GET['ref_sisa_a']."'";
		$cte_tipequip=mysql_result($query_modelo,0,0);
		$query_prov=mysql_query("SELECT proveedor FROM cat_equipo WHERE tipo_equipo='".$cte_tipequip."'");
		$cte_prov=mysql_result($query_prov,0,0);
	}
	?>
	<tr>
		<td>-Modelo del Equipo</td><td><input type="text" size="30" id="tipo_equipo" value="<?=$cte_tipequip?>" readonly='readonly' /></td>
		<td>-Proveedor del Equipo</td><td><input type="text" size="30" id="proveedor" value="<?=$cte_prov?>" readonly='readonly' /></td>
	</tr>

	<tr>
		<td>-Ubicacion</td><td><input type="text" size="30" id="ubicacion_demarcador" value="<?=$cte_ubidema?>" readonly='readonly' /></td>
		<td>-Release</td><td><input type="text" size="30" id="release_eq" value="<?=$cte_rele?>" readonly='readonly' /></td>
	</tr>

	<tr>
		<td>-Conexion RCDT</td><td><input type="text" size="30" id="ubicacion_demarcador" value="<?=$cte_conexrcdt?>" readonly='readonly' /></td>
		<td></td><td></td>
	</tr>
	
	<tr bgcolor="#999999"><td colspan="4" height="4"></td></tr>    
	
	<tr class="tituloRojo1"><td colspan="4" align="left">Informacion del Puerto TX</td></tr>
	
	<tr>
		<td>Puerto Transporte</td><td><input type='text' size='30' id='puerto_cl' value='<?=$puerto_cl?>' readonly='readonly' ></td>
		<?php if ($aplica_puerto_b1!='OK') {?><td>Puerto Transporte Secundario</td><td><input type='text' size='30' id='puerto_clsec' value='<?=$puerto_clsec?>' readonly='readonly' ></td><?PHP } ?>
	</tr>

	<tr>
		<td>Tipo Puerto</td><td><input type="text" size="30" id='tipo_puerto_cl' value="<?=$tipo_puerto_cl?>" readonly='readonly' /></td>
		<?php if ($aplica_puerto_b1!='OK') {?><td>Tipo Puerto</td><td><input type="text" size="30" id='tipo_puerto_clsec' value="<?=$tipo_puerto_clsec?>" readonly='readonly' /></td><?PHP } ?>
	</tr>	
	
	<tr bgcolor="#999999"><td colspan="4" height="4"></td></tr>
	
	<tr class="tituloRojo1"><td colspan="2">Informacion del Puerto del Servicio</td><td colspan="2">&nbsp;</td></tr>
	
	<tr>
		<!--<td>Puerto Servicio</td><td><input type='text' size='30' id='' value='<?=$puerto_InPDe3?>' readonly='readonly'></td>-->
		<td>&nbsp;</td><td>&nbsp;</td>
	</tr>

	<tr>
		<td>Tipo Puerto</td><td><input type="text" size="30" id='' value="<?=$tipo_puerto_InPDe3?>" readonly='readonly' /></td>
		<td>&nbsp;</td><td>&nbsp;</td>
	</tr>
	
	<tr bgcolor="#999999"><td colspan="4" height="4"></td></tr>
	
	<?php if ($b=='OK'){?>
	<tr>
		<td>-Switch</td><td><input name="text6" type="text" id="text10" value="<?=$cte_switch?>" size="30" readonly='readonly' /></td>
		<td>-Num Cambios</td><td><input name="text62" type="text" id="text62" value="<?=$cte_num_cambio?>" size="30" readonly='readonly' /></td>
	</tr>
	
	<tr>
		<td>-Puerto</td><td><input name="text63" type="text" id="text63" value="<?=$cte_pto?>" size="30" readonly='readonly' /></td>
		<td>-Velocidad</td><td><input name="text622" type="text" id="text622" value="<?=$cte_velocidad?>" size="30" readonly='readonly' /></td>
	</tr>
	<?php } ?>	
	
	<?php
	$sql_puertos_id = "SELECT puerto,ubicacion_bdfo,repisa_bdfo,contacto_bdfo,repisat, slot FROM inventario_puertos_demarcadores WHERE clli_adva='".$GE_clli_cte."' AND nomof LIKE '%".$_REQUEST['ref_sisa_a']."%'";	
	$sql_puertos_cobre=mysql_query($sql_puertos_id);
	if(mysql_num_rows($sql_puertos_cobre)>0){
	?>
	<tr bgcolor="#999999"><td colspan="4" height="4"></td></tr>
	<tr class="tituloRojo1"> <td colspan="4" align="left" bordercolor="#999999">Puertos</td> </tr>
			<tr>
			<td align="left" bgcolor="#999999">Puerto</td><td bgcolor="#999999">Ubicaci&oacute;n</td><td bgcolor="#999999">Repisa</td><td bgcolor="#999999">Contacto</td>
			<tr>
			<?php
				
				
				for($i=0;$i<mysql_num_rows($sql_puertos_cobre);$i++)
				{
					if($ctl_tipequip='FSP 150GE-X') $pto_ctl=mysql_result($sql_puertos_cobre,$i,'repisat')."-".mysql_result($sql_puertos_cobre,$i,'slot')."-".mysql_result($sql_puertos_cobre,$i,0);
					else $pto_ctl=mysql_result($sql_puertos_cobre,$i,0);
					
					echo "<tr><td bordercolor='#999999'><input type='text' value='".$pto_ctl."' readonly='readonly' size='40' ></td>";
					echo "<td bordercolor='#999999'><input type='text' value='".mysql_result($sql_puertos_cobre,$i,1)."' readonly='readonly' ></td>";
					echo "<td bordercolor='#999999'><input type='text' value='".mysql_result($sql_puertos_cobre,$i,2)."' readonly='readonly' size='10'></td>";
					echo "<td bordercolor='#999999'><input type='text' value='".mysql_result($sql_puertos_cobre,$i,3)."' readonly='readonly' size='10' ></td></tr>";
				}
		
	}		
	?>
</table>
<!-- FIN EQUIPO CIENTE -->