<?
header("Content-Type: text/html;charset=ISO-8859-1");
include ("perfiles.php");
include("conexion.php");
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.19.custom.min.js"></script>
<script type="text/javascript" src="js/domtabResPes.js"></script>
<link href="css/styledem.css" media="screen" type="text/css"  rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="./css/domtab2a.css"></link>
<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.19.custom.css" />


<!---------------------- FUNCION PARA ABRIR LA VENTANA DE LA UBICACION ------------------->
<script  language="javascript" type="text/javascript">
function textCounter(field, countfield, maxlimit) {
if (field.value.length > maxlimit) 
field.value = field.value.substring(0, maxlimit);
else 
countfield.value = maxlimit - field.value.length;
}
</script>

<title>TELMEX - FRIDA</title>
</head>
<body onfocus="getTab()">

<div id="wrap">
<div id="header">
<?
if($pag=="grid")		{$inicio='grid_estatus_demarcador.php';}
elseif($pag=="cdSegura"){$inicio='grid_gestion_clip.php';}
else					{$inicio='inicio.php';}
?>
<h1><a href="<?=$inicio?>">F  R  I  D  A</a></h1>
<h2>Gestion de Equipos Demarcadores</h2><p>
</div>
</div>

<div id="wrap">
<form name='alta_demarcador' method='post'>
<input type="hidden" name="tabSpan" id="tabSpan" value="<?=$tabSpan?>" />	<!---------- necesaria para las pestañas  							----->

<input type="hidden" name="buscar" />										<!---------- busca datos del clli en inventario_demarcadores  		----->
<input type="hidden" name="guardar">										<!---------- Registra el demarcador en el inventario				----->
<input type="hidden" name="cambio">											<!---------- Guarda cambios del demarcador   						----->
<input type="hidden" name="replicaDatos">									<!---------- Replicamos Datos para Clip-Clas   						----->
<input type="hidden" name="val_ref" />										<!---------- valida ref sisa   										----->

<input type="hidden" name="slot_duo" value='<?=$slot_duo?>'>				<!---------- ayuda para ver los slot disponibles  					----->
<input type="hidden" name="validTarj">										<!---------- Validar Tarjetas   									----->
<input type="hidden" name="bajatj">											<!---------- baja de la tarjeta   									----->
<input type="hidden" name="idTj">											<!---------- id de la tarjeta  para eliminarlo						----->

<input type="hidden" name="verpuertos">										<!---------- sirve para ver los puerTos    							----->
<input type="hidden" name="repPto">											<!---------- pasa la repisa para ver los puertos   					----->
<input type="hidden" name="slotPto">										<!---------- pasa la slot para ver los puertos   					----->
<input type="hidden" name="modPto">											<!---------- pasa la modelo de la tarjeta para ver los puertos  	----->
<input type="hidden" name="altapto">										<!---------- alta de los puertos   									----->

<input type="hidden" name="updpto">											<!---------- Update de los puertos   								----->
<input type="hidden" name="save">											<!---------- Save de los puertos   									----->
<input type="hidden" name="idupd">											<!---------- Id de los puertos   									----->
<input type="hidden" name="bajapto">										<!---------- Baja de los puertos   									----->

<input type="hidden" name="reservaCliente">									<!---------- Reserva el puerto del cliente en el equipo NDE			----->
<input type="hidden" name="reservaCliente2">								<!---------- Reserva el puerto SECUNDARIO del cliente en el equipo NDE	----->
<input type="hidden" name="reservaCliente3">								<!---------- Reserva el puerto SECUNDARIO del cliente en el equipo NDE	----->
<input type="hidden" name="reservatx">										<!---------- Reserva el puerto del transporte en el equipo DDE			----->
<input type="hidden" name="reservatx2">										<!---------- Reserva el puerto SECUNDARIO TX en el equipo DDE			----->
<input type="hidden" name="reservatx3">										<!---------- Reserva el puerto SECUNDARIO TX en el equipo DDE			----->
<input type="hidden" name="reservaServicio">								<!---------- Reserva el puerto del Servicio en el equipo DDE			----->

<input type="hidden" name="reservaDemarcador">								<!---------- Reserva el puerto del demarcador							----->	
<input type="hidden" name="reservaDemarcador2">								<!---------- Reserva el puerto del demarcador							----->	

<input type="hidden" name="solicitar">										<!---------- Solicita la Gestion del Equipo   						----->
<input type="hidden" name="solicitarDem">									<!---------- Solicita la Gestion wimax 			   					----->
<input type="hidden" name="validarDem">										<!---------- Solicita la Validacion del Equipo	   					----->
<input type="hidden" name="validarDemAmp">									<!---------- Solicita la Validacion de la Ampliacion del Equipo		----->
<input type="hidden" name="borrarEst">										<!---------- Solicitas Ampliacion del Demarcador    				----->
<input type="hidden" name="cambioEquipo">


<?
if($buscar==1)
{
	$clliCount=strlen($clli_adva); 
	if($clliCount<>'11'&&$clli_adva!="")
	{echo "<script>alert('CLLI Incorrecto');</script>";
	 $clli_adva=$ubicacion_demarcador=$ip_demarcador=$ot_instalacion_demarcador=$tipo_equipo=$proveedor=$tipo_demarcador=$division=$central=$ciudad=$estado
	 =$siglas=$ref_sisa=$conexion_rcdt=$select_wdm=$cluster="";}
	else 
	{
		$query_clli="select * from inventario_demarcadores where clli_adva='".trim($clli_adva)."' group by clli_adva";
		$result_clli=mysql_query($query_clli);
		$num_clli=mysql_num_rows($result_clli);
		$row_clli=mysql_fetch_array($result_clli,MYSQL_ASSOC);
		    
			$id							=$row_clli['id'];
			$ubicacion_demarcador		=$row_clli['ubicacion_demarcador'];
			$ip_demarcador				=$row_clli['ip_demarcador'];
			$ot_instalacion_demarcador	=$row_clli['ot_instalacion_demarcador'];
			$tipo_equipo				=$row_clli['tipo_equipo'];
			$proveedor					=$row_clli['proveedor'];
			$tipo_demarcador			=$row_clli['tipo_demarcador'];
			$division					=$row_clli['division'];
			$central					=$row_clli['central'];
			$ciudad						=$row_clli['ciudad'];
			$estado						=$row_clli['estado'];	
			$siglas						=$row_clli['siglas'];
			$clli_edif					=$row_clli['clli_edif'];	
			$ref_sisa					=$row_clli['ref_sisa'];
			$clfi						=$row_clli['clfi'];
			$conexion_rcdt				=$row_clli['conexion_rcdt'];
			$select_wdm					=$row_clli['select_wdm'];
			
			$cluster					=$row_clli['cluster'];
			$tipo_nodo_dist				=$row_clli['tipo_nodo_dist'];
			$nodo_adm_conex_adsl_dist	=$row_clli['nodo_adm_conex_adsl_dist'];
			$id_nodo_dist				=$row_clli['id_nodo_dist'];
			$proveedor_tx_dist			=$row_clli['proveedor_tx_dist'];
			$repadm_conxadsl_dist		=$row_clli['repadm_conxadsl_dist'];
			$clli_equipo_dist			=$row_clli['clli_equipo_dist'];
			$ubi_nodo_adm_dist			=$row_clli['ubi_nodo_adm_dist'];
			
			$tipo_nodo_acceso			=$row_clli['tipo_nodo_acceso'];
			$nodo_adm_conex_adsl_acceso	=$row_clli['nodo_adm_conex_adsl_acceso'];
			$id_nodo_acceso				=$row_clli['id_nodo_acceso'];
			$proveedor_tx_acceso		=$row_clli['proveedor_tx_acceso'];
			$repadm_conxadsl_acceso		=$row_clli['repadm_conxadsl_acceso'];
			$clli_equipo_acceso			=$row_clli['clli_equipo_acceso'];
			$ubi_nodo_adm_acceso		=$row_clli['ubi_nodo_adm_acceso'];
			
			$tipo_puerto_acceso			=$row_clli['tipo_puerto_acceso'];
			$puerto_acceso				=$row_clli['puerto_acceso'];
			$capacidad_puerto_acceso	=$row_clli['capacidad_puerto_acceso'];
			$ubicacion_bdfo_acceso		=$row_clli['ubicacion_bdfo_acceso'];
			$repisa_bdfo_acceso			=$row_clli['repisa_bdfo_acceso'];
			$contacto_bdfo_acceso		=$row_clli['contacto_bdfo_acceso'];
			$mod_tar_eth_acceso			=$row_clli['mod_tar_eth_acceso'];
			$id_puerto_acceso			=$row_clli['id_puerto_acceso'];


			$tunel						=$row_clli['tunel'];
			$tunelResp					=$row_clli['tunelResp'];
			$switc						=$row_clli['switch'];
			$velocidad					=$row_clli['velocidad'];
			$pto						=$row_clli['pto'];
			$num_cambio					=$row_clli['num_cambio'];
			$gestion					=$row_clli['gestionada'];
			$release					=$row_clli['release_eq'];
			$clase_servicio				=$row_clli['clase_servicio'];
			$anexo						=$row_clli['anexo_ot'];
			$ip_demarcador_gateway		=$row_clli['ip_gateway'];
			$aplica_traspasos			=$row_clli['aplica_traspasos'];
			$pto_cascada				=$row_clli['pto_cascada'];
			$cascada					=$row_clli['cascada'];
			$estatus_rcdt				=$row_clli['estatus_rcdt'];
			$aplicaSecundario			=$row_clli['aplicaSecundario'];
			$vlan						=$row_clli['vlan_gestion'];
			$id_equipo					=$row_clli['id_equipo'];
			$funcion_equipo				=$row_clli['funcion_equipo'];
			$topologia_equipo			=$row_clli['topologia_equipo'];
		
			$ch_ptodem					=$row_clli['ch_ptodem'];
			$ch_ptotx					=$row_clli['ch_ptotx'];
			$nombre_oficial_pisa		=$row_clli['nombre_oficial_pisa'];
			$interface					=$row_clli['interface'];
			
			$obsvExp					=$row_clli['observaciones_adva_exp'];
			$obsvCna					=$row_clli['observaciones_cna'];
			$obsvCns1					=$row_clli['observaciones_ptoext'];
			$obsvCns4					=$row_clli['observaciones_adva'];
			$obsvDD						=$row_clli['observaciones'];
			
			$cns1						=$row_clli['estatus_ptoext'];
			$cns4						=$row_clli['estatus_adva'];
			$estexp						=$row_clli['estatus_adva_exp'];
			$cna						=$row_clli['estatus_cna'];		
		
		if($num_clli==0)
		{$ubicacion_demarcador=$ip_demarcador=$ot_instalacion_demarcador=$tipo_equipo=$proveedor=$tipo_demarcador=$division=$central=$ciudad=$estado=$siglas=
		$ref_sisa=$conexion_rcdt=$select_wdm=$cluster=$funcion_equipo=$topologia_equipo="";}
	}
}

	$query_clli="select * from inventario_demarcadores where clli_adva='".trim($clli_adva)."' group by clli_adva";
	$result_clli=mysql_query($query_clli);
	$num_clli=mysql_num_rows($result_clli);
	$row_clli=mysql_fetch_array($result_clli);
		
		if(!isset($_POST['clase_servicio']))					$clase_servicio				=$row_clli['clase_servicio'];
		if(!isset($_POST['tunel']))								$tunel						=$row_clli['tunel'];
		if(!isset($_POST['tunelResp']))							$tunelResp					=$row_clli['tunelResp'];
		if(!isset($_POST['ref_sisa']))							$ref_sisa					=$row_clli['ref_sisa'];
		if(!isset($_POST['clfi']))								$clfi						=$row_clli['clfi'];
		if(!isset($_POST['tipo_equipo']))						$tipo_equipo				=$row_clli['tipo_equipo'];
		if(!isset($_POST['tipo_demarcador']))					$tipo_demarcador			=$row_clli['tipo_demarcador'];
		if(!isset($_POST['division']))							$division					=$row_clli['division'];
		if(!isset($_POST['central']))							$central					=$row_clli['central'];
		if(!isset($_POST['ciudad']))							$ciudad						=$row_clli['ciudad'];
		if(!isset($_POST['estado']))							$estado						=$row_clli['estado'];	
		if(!isset($_POST['siglas']))							$siglas						=$row_clli['siglas'];
		if(!isset($_POST['clli_edif']))							$clli_edif					=$row_clli['clli_edif'];	
		if(!isset($_POST['conexion_rcdt']))						$conexion_rcdt				=$row_clli['conexion_rcdt'];
		if(!isset($_POST['select_wdm']))						$select_wdm					=$row_clli['select_wdm'];
			
																$id							=$row_clli['id'];
		if(!isset($_POST['ubicacion_demarcador']))				$ubicacion_demarcador		=$row_clli['ubicacion_demarcador'];
		if(!isset($_POST['ip_demarcador']))						$ip_demarcador				=$row_clli['ip_demarcador'];
		if(!isset($_POST['ot_instalacion_demarcador']))			$ot_instalacion_demarcador	=$row_clli['ot_instalacion_demarcador'];
																$proveedor					=$row_clli['proveedor'];
		if(!isset($_POST['switc']))								$switc						=$row_clli['switch'];
		if(!isset($_POST['velocidad']))							$velocidad					=$row_clli['velocidad'];
		if(!isset($_POST['pto']))								$pto						=$row_clli['pto'];
		if(!isset($_POST['num_cambio']))						$num_cambio					=$row_clli['num_cambio'];
																$gestion					=$row_clli['gestionada'];
																$release					=$row_clli['release_eq'];
																$anexo						=$row_clli['anexo_ot'];
		if(!isset($_POST['ip_demarcador_gateway']))				$ip_demarcador_gateway		=$row_clli['ip_gateway'];
		if(!isset($_POST['aplica_traspasos']))					$aplica_traspasos			=$row_clli['aplica_traspasos'];
																$pto_cascada				=$row_clli['pto_cascada'];
		if(!isset($_POST['cascada']))							$cascada					=$row_clli['cascada'];
																$estatus_rcdt				=$row_clli['estatus_rcdt'];
		if(!isset($_POST['aplicaSecundario']))					$aplicaSecundario			=$row_clli['aplicaSecundario'];
		if(!isset($_POST['id_equipo']))							$id_equipo					=$row_clli['id_equipo'];
		if(!isset($_POST['funcion_equipo']))					$funcion_equipo				=$row_clli['funcion_equipo'];
		if(!isset($_POST['topologia_equipo']))					$topologia_equipo			=$row_clli['topologia_equipo'];
	
																$ch_ptodem					=$row_clli['ch_ptodem'];
																$ch_ptotx					=$row_clli['ch_ptotx'];
																$nombre_oficial_pisa		=$row_clli['nombre_oficial_pisa'];
																
		if(!isset($_POST['cluster']))							$cluster					=$row_clli['cluster'];
																$tipo_nodo_dist				=$row_clli['tipo_nodo_dist'];
																$nodo_adm_conex_adsl_dist	=$row_clli['nodo_adm_conex_adsl_dist'];
																$id_nodo_dist				=$row_clli['id_nodo_dist'];
																$proveedor_tx_dist			=$row_clli['proveedor_tx_dist'];
																$repadm_conxadsl_dist		=$row_clli['repadm_conxadsl_dist'];
																$clli_equipo_dist			=$row_clli['clli_equipo_dist'];
																$ubi_nodo_adm_dist			=$row_clli['ubi_nodo_adm_dist'];

		if(!isset($_POST['tipo_nodo_acceso']))					$tipo_nodo_acceso			=$row_clli['tipo_nodo_acceso'];
		if(!isset($_POST['nodo_adm_conex_adsl_acceso']))		$nodo_adm_conex_adsl_acceso	=$row_clli['nodo_adm_conex_adsl_acceso'];
																$id_nodo_acceso				=$row_clli['id_nodo_acceso'];
		if(!isset($_POST['proveedor_tx_acceso']))				$proveedor_tx_acceso		=$row_clli['proveedor_tx_acceso'];
		if(!isset($_POST['repadm_conxadsl_acceso']))			$repadm_conxadsl_acceso		=$row_clli['repadm_conxadsl_acceso'];
		if(!isset($_POST['clli_equipo_acceso']))				$clli_equipo_acceso			=$row_clli['clli_equipo_acceso'];
		if(!isset($_POST['ubi_nodo_adm_acceso']))				$ubi_nodo_adm_acceso		=$row_clli['ubi_nodo_adm_acceso'];																
				
																$tipo_puerto_acceso			=$row_clli['tipo_puerto_acceso'];
																$puerto_acceso				=$row_clli['puerto_acceso'];
																$capacidad_puerto_acceso	=$row_clli['capacidad_puerto_acceso'];
																$ubicacion_bdfo_acceso		=$row_clli['ubicacion_bdfo_acceso'];
																$repisa_bdfo_acceso			=$row_clli['repisa_bdfo_acceso'];
																$contacto_bdfo_acceso		=$row_clli['contacto_bdfo_acceso'];
																$mod_tar_eth_acceso			=$row_clli['mod_tar_eth_acceso'];
																$id_puerto_acceso			=$row_clli['id_puerto_acceso'];
		if(!isset($_POST['interface']))							$interface					=$row_clli['interface'];
		
																$obsvExp					=$row_clli['observaciones_adva_exp'];
																$obsvCna					=$row_clli['observaciones_cna'];
																$obsvCns1					=$row_clli['observaciones_ptoext'];
																$obsvCns4					=$row_clli['observaciones_adva'];
																$obsvDD						=$row_clli['observaciones'];
																
																$cns1						=$row_clli['estatus_ptoext'];
																$cns4						=$row_clli['estatus_adva'];
																$estexp						=$row_clli['estatus_adva_exp'];
																$cna						=$row_clli['estatus_cna'];		
																			
#-----------------------------------------> CONSULTAR INTERFAZ INFOCENTRO CUANDO EL DEMARCADOR SEA DDE O DDE-N
if($num_clli==0 and $clli_adva!="")
{
		
	//$wsdl = "http://10.192.2.74:8082/info_sise_int/webservices/sistemaFridaAdva?wsdl";				// SERVIDOR INFOCENTRO DESARROLLO
	$wsdl = "http://10.192.5.43/infocentro/webservices/sistemaFridaAdva?wsdl";				// SERVIDOR INFOCENTRO PRODUCCION

		include("SistemaAdvaConsRequest.php");	
		$adva = new SistemaAdvaConsRequest($clli_adva);
		try {
			$client = new SoapClient($wsdl, array('classmap' => array('arg0' => 'SistemaAdvaBajaRequest')));
			$result = $client->ConsultaClli(array('arg0' => $adva));
			$falla = false;
		} catch (SoapFault $fault) {
			$falla = true;
		}
	
		
		foreach($result->return as $indice => $valor){
			if(gettype($valor)=="string"||gettype($valor)=="array")
			$matriz[$indice]=$valor;
			if(gettype($valor)=="object"){
				foreach($valor as $subIndice => $subValor){
					if(gettype($subValor)=="array")
						$matriz[$indice]=$subValor;
					if(gettype($subValor)=="string")
						$matriz[$indice]=array($subValor);
				}
			}
			
		}
				
													$infoModelo				=trim($matriz['stipoEquipo']);
													$clli_edif				=trim($matriz['sclliEdificio']);
													//$division				=trim($matriz['sddSold']);
		if(!isset($_POST['ip_demarcador']))			$ip_demarcador			=trim($matriz['sdireccionIPEquipo']);
													$funcion_equipo			=trim($matriz['sfuncionEquipo']);
													$topologia_equipo		=trim($matriz['stopologiaEquipo']);
													$ubicacion_demarcador	=trim($matriz['subicacionEquipo']);
		
		$queryTeq="select tipo_equipo from cat_equipo where formato='ADVA' and cat_infocentro like '%$infoModelo%'";
		$resTeq=mysql_query($queryTeq);
		$rowTeq=mysql_fetch_row($resTeq);
		
		$tipo_equipo			=$rowTeq[0];
		
		$leyenda="LOS CAMPOS <font color=red>MODELO DEL EQUIPO,UBICACION DEL DEMARCADOR, FUNCION, TOPOLOGIA,IP DEL DEMARCADOR Y CLLI DEL EDIFICIO</font><br> SE GENERARA CON INFORMACION DE INFOCENTRO";

}	
	
//----------------------------------------> QUERYS PARA EXTRAER LOS ESTATUS DE CADA PROCESO EN ORDENES 
if($cns4=="EN ESPERA" || $cns4=="")						{$color_de="#F3F3F3";}
if($cns1=="EN ESPERA" || $cns1=="" ||  $cns1=="N/A")	{$color_pe="#F3F3F3";}
if($cna=="EN ESPERA" || $cna=="" ||  $cna=="N/A")		{$color_cna="#F3F3F3";}

if($cns1=="" && $cns4=="")								{$habBt="";$estilo='visibility:visible';}

if($tipo_demarcador!="CONVERTIDOR DE MEDIOS")
{
		if($conexion_rcdt=="PUERTO EXTENDIDO")
		{
			
			if($cns1=="LIQUIDADA" || $cns1=="EJECUTADA CON PRUEBAS" || $cns1=="EJECUTADA SIN PRUEBAS")
			{
					$color_pe='#A5DF00';
					$habBt="disabled";
					$estilo='visibility:hidden';
					$hab="disabled";
		
				
			//----------------------------------------- COMIENZA LOS ESTATUS DE CNS4 -----------------------------------------
				if($cns4=="LIQUIDADA" || $cns4=="EJECUTADA CON PRUEBAS" || $cns4=="EJECUTADA SIN PRUEBAS")
				{
					$leyenda="<font color=black>EL DEMARCADOR YA ESTA GESTIONADO (ESTATUS: $cns4)</font>";
					$color_de='#A5DF00';
					$habBt="";
					$estilo='visibility:visible';
					$hab="disabled";
		
				}
				elseif($cns4=="AUTORIZADA" || $cns4=="POR REVISAR" || $cns4=="VALIDADA" || $cns4=="EN VALIDACION" || $cns4=="EN PROCESO" || 
				$cns4=="ASIGNACION DE TECNICO")
				{
					$leyenda="<font color=red>BLOQUEADO: <font color=blue>ESTA EN EJECUCION POR CNS IV NO SE PUEDE MODIFICAR (ESTATUS: $cns4)</font>";
					$color_de='#F7FE2E';
					$habBt="disabled";
					$estilo='visibility:hidden';
					$hab="disabled";
		
				}
				elseif($cns4=="CANCELADA" || $cns4=="EJECUTADA SIN EXITO" || $cns4=="RECHAZADA")
				{
					$leyenda="<font color=red>ESTATUS: $cns4</font>";
					$color_de='#FE2E2E';
					$habBt="";
					$estilo='visibility:visible';
					$hab="";
				}
			}
			else
			{
			//----------------------------------------- COMIENZA LOS ESTATUS DE CNS1 ---------------------------------------------
				if($cns1=="AUTORIZADA" || $cns1=="POR REVISAR" || $cns1=="VALIDADA" || $cns1=="EN VALIDACION" || $cns1=="EN PROCESO" || 
				$cns1=="ASIGNACION DE TECNICO")
				{
					$leyenda="<font color=red>BLOQUEADO: <font color=blue>ESTA EN EJECUCION POR CNS I NO SE PUEDE MODIFICAR (ESTATUS: $cns1)</font>";
					$color_pe='#F7FE2E';
					$habBt="disabled";
					$estilo='visibility:hidden';
					$hab="disabled";
				}
				elseif($cns1=="CANCELADA" || $cns1=="EJECUTADA SIN EXITO" || $cns1=="RECHAZADA")
				{
					$leyenda="<font color=red>ESTATUS: $cns1</font>";
					$color_pe='#FE2E2E';
					$habBt="";
					$estilo='visibility:visible';
					$hab="";
				}
				
			}
			
		}else		
		{
			//----------------------------------------- COMIENZA LOS ESTATUS DE CNS4 -----------------------------------------------
				if($cns4=="LIQUIDADA" || $cns4=="EJECUTADA CON PRUEBAS" || $cns4=="EJECUTADA SIN PRUEBAS")
				{
					$leyenda="<font color=black>EL DEMARCADOR YA ESTA GESTIONADO (ESTATUS: $cns4)</font>";
					$color_de='#A5DF00';
					$habBt="";
					$estilo='visibility:visible';
					$hab="disabled";
				}
				elseif($cns4=="AUTORIZADA" || $cns4=="POR REVISAR" || $cns4=="VALIDADA" || $cns4=="EN VALIDACION" || $cns4=="EN PROCESO" || 
				$cns4=="ASIGNACION DE TECNICO")
				{
					$leyenda="<font color=red>BLOQUEADO: <font color=blue>ESTA EN EJECUCION POR CNS IV NO SE PUEDE MODIFICAR (ESTATUS: $cns4)</font>";
					$color_de='#F7FE2E';
					$habBt="disabled";
					$estilo='visibility:hidden';
					$hab="disabled";
				}
				elseif($cns4=="CANCELADA" || $cns4=="EJECUTADA SIN EXITO" || $cns4=="RECHAZADA" || $cns4=="ASISTENCIA A PRUEBAS")
				{
					$leyenda="<font color=red>ESTATUS: $cns4</font>";
					$color_de='#FE2E2E';
					$habBt="";
					$estilo='visibility:visible';
					$hab="";
				}
		}
}
else
{
			if($cns1=="LIQUIDADA" || $cns1=="EJECUTADA CON PRUEBAS" || $cns1=="EJECUTADA SIN PRUEBAS")
			{
					$color_pe='#A5DF00';
					$habBt="disabled";
					$estilo='visibility:hidden';
					$hab="disabled";
		
				
			//----------------------------------------- COMIENZA LOS ESTATUS DE CNS4 -----------------------------------------
				if($cns4=="LIQUIDADA" || $cns4=="EJECUTADA CON PRUEBAS" || $cns4=="EJECUTADA SIN PRUEBAS")
				{
					$leyenda="<font color=black>EL DEMARCADOR YA ESTA GESTIONADO (ESTATUS: $cns4)</font>";
					$color_de='#A5DF00';
					$habBt="";
					$estilo='visibility:visible';
					$hab="disabled";
		
				}
				elseif($cns4=="AUTORIZADA" || $cns4=="POR REVISAR" || $cns4=="VALIDADA" || $cns4=="EN VALIDACION" || $cns4=="EN PROCESO" || 
				$cns4=="ASIGNACION DE TECNICO")
				{
					$leyenda="<font color=red>BLOQUEADO: <font color=blue>ESTA EN EJECUCION POR CNS IV NO SE PUEDE MODIFICAR (ESTATUS: $cns4)</font>";
					$color_de='#F7FE2E';
					$habBt="disabled";
					$estilo='visibility:hidden';
					$hab="disabled";
		
				}
				elseif($cns4=="CANCELADA" || $cns4=="EJECUTADA SIN EXITO" || $cns4=="RECHAZADA" || $cns4=="ASISTENCIA A PRUEBAS")
				{
					$leyenda="<font color=red>ESTATUS: $cns4</font>";
					$color_de='#FE2E2E';
					$habBt="";
					$estilo='visibility:visible';
					$hab="";
				}
			}
			else
			{
			//----------------------------------------- COMIENZA LOS ESTATUS DE CNS1 ---------------------------------------------
				if($cns1=="AUTORIZADA" || $cns1=="POR REVISAR" || $cns1=="VALIDADA" || $cns1=="EN VALIDACION" || $cns1=="EN PROCESO" || 
				$cns1=="ASIGNACION DE TECNICO")
				{
					$leyenda="<font color=red>BLOQUEADO: <font color=blue>ESTA EN EJECUCION POR CNS I NO SE PUEDE MODIFICAR (ESTATUS: $cns1)</font>";
					$color_pe='#F7FE2E';
					$habBt="disabled";
					$estilo='visibility:hidden';
					$hab="disabled";
				}
				elseif($cns1=="CANCELADA" || $cns1=="EJECUTADA SIN EXITO" || $cns1=="RECHAZADA")
				{
					$leyenda="<font color=red>ESTATUS: $cns1</font>";
					$color_pe='#FE2E2E';
					$habBt="";
					$estilo='visibility:visible';
					$hab="";
				}
				
			}

}	
if($estexp=="RECHAZADA" or $estexp=="CAMBIO")
{
			$leyenda="<font color=red>ESTATUS: $estexp</font>";
			$color_exp='#FE2E2E';
			$habBt="";
			$estilo='visibility:visible';
			$hab="";
			$habVal="";			
}else if($estexp=="POR REVISAR")
{
			$leyenda="<font color=red>BLOQUEADO: <font color=blue>ESTA EN EJECUCION POR EXPLOTACION CORPORATIVA NO SE PUEDE MODIFICAR (ESTATUS: $estexp)</font>";
			$color_exp='#F7FE2E';
			$habBt="disabled";
			$estilo='visibility:hidden';
			$hab="disabled";
			$habVal="disabled";
}else if($estexp=="VALIDADA")
{
			$color_exp='#A5DF00';
			$hab="disabled";
			$habVal="disabled";
			$habtext="readOnly";
			
}elseif($estexp=="")
{
			$estilo='visibility:visible';
			$color_exp="#F3F3F3";
			//$hab="";
}	


if($gestion=="GESTIONADO")
{
	
	if($estexp=="RECHAZADA" or $estexp=="CAMBIO")
	{
				$leyenda="<font color=red>ESTATUS: $estexp</font>";
				$color_exp='#FE2E2E';
				$habValAmp="";			
	}else if($estexp=="POR REVISAR")
	{
				$leyenda="<font color=red>
				BLOQUEADO: <font color=blue>ESTA EN EJECUCION POR EXPLOTACION CORPORATIVA NO SE PUEDE MODIFICAR (ESTATUS: $estexp)</font>";
				$color_exp='#F7FE2E';
		
				$habValAmp="disabled";
	}else if(($cns4=="AUTORIZADA" || $cns4=="POR REVISAR" || $cns4=="VALIDADA" || $cns4=="EN VALIDACION" || $cns4=="EN PROCESO" || 
				$cns4=="ASIGNACION DE TECNICO") and $estexp=="VALIDADA")
	{
				$habValAmp="disabled";
	}			
	
				if($cns4=="LIQUIDADA" || $cns4=="EJECUTADA CON PRUEBAS" || $cns4=="EJECUTADA SIN PRUEBAS")
				{
					$leyenda="<font color=black>EL DEMARCADOR YA ESTA GESTIONADO (ESTATUS: $cns4)</font>";
					$color_de='#A5DF00';
					$habBtAmp="";
					$estilo='visibility:visible';
					$hab="disabled";
				}
				elseif($cns4=="AUTORIZADA" || $cns4=="POR REVISAR" || $cns4=="VALIDADA" || $cns4=="EN VALIDACION" || $cns4=="EN PROCESO" || 
				$cns4=="ASIGNACION DE TECNICO")
				{
					$leyenda="<font color=red>BLOQUEADO: <font color=blue>ESTA EN EJECUCION POR CNS IV NO SE PUEDE MODIFICAR (ESTATUS: $cns4)</font>";
					$color_de='#F7FE2E';
					$habBtAmp="disabled";
					$estilo='visibility:hidden';
					$hab="disabled";
				}
				elseif($cns4=="CANCELADA" || $cns4=="EJECUTADA SIN EXITO" || $cns4=="RECHAZADA" || $cns4=="ASISTENCIA A PRUEBAS")
				{
					$leyenda="<font color=red>ESTATUS: $cns4</font>";
					$color_de='#FE2E2E';
					$habBtAmp="";
					$estilo='visibility:visible';
					$hab="";
				}
	
	
	
		
}




$queryEstNde="select * from inventario_demarcadores where clli_adva='$tunel'";
$resEstNde=mysql_query($queryEstNde);
$rowEstNde=mysql_fetch_array($resEstNde);

		
#-----------------> BLOQUEA INPUT'S CUANDO YA ESTA REGISTRADO ( SOLO DATOS GENERALES )	
if($num_clli>0) $bloq="readOnly";
else			$bloq="";
#----------------------> CONTROL DE LOS BOTONES	
	
	if(	(($conexion_rcdt=="CONEXION DIRECTA A RCDT" and $anexo=="OK") or 
	    ($conexion_rcdt=="POR TUNEL" and $rowEstNde['gestionada']=="GESTIONADO" and $anexo=="OK" )) and $gestion=="NO GESTIONADO" and $estexp=="VALIDADA")
	{
		$habGest="visibility:visible";	$accion="document.alta_demarcador.solicitar.value=1;document.alta_demarcador.submit();";
	}
	elseif($anexo=="OK" and $ch_ptodem=="OK" and $ch_ptotx=="OK" and $tipo_demarcador=="CONVERTIDOR DE MEDIOS" and $estexp=="VALIDADA" 
	and $gestion=="NO GESTIONADO")
	{
		$habGest="visibility:visible";	$accion="document.alta_demarcador.solicitarDem.value=1;document.alta_demarcador.submit();";
	}else
	{	$habGest="visibility:hidden"; }
	

echo "<div style='position:absolute;top:0;left:80%;font-size:9px;font-weight:bold;'>Usuario: $sess_nmb<br>DD: $sess_dd</div>";
?>

<br />
<table class="tbGeneralBl">
	<tr height="4" align="center">	
    	<td bgcolor="<?=$color_exp?>" 	title="<?=$estexp?>">	EXPLOTACION CORP.		</td>
        <td bgcolor="<?=$color_pe?>" 	title="<?=$cns1?>">		CONFIG TX (CNS I)		</td>
        <td bgcolor="<?=$color_de?>" 	title="<?=$cns4?>">		CONFIG ACCESO (CNS IV)	</td>
    </tr>
    <tr><td>&nbsp;</td></tr>	
    <tr><td colspan="4" align="center"><strong><?=$leyenda?></strong></td></tr>
</table>


<br />
<table id="tbGeneral"> 
    <? if($gestion!="GESTIONADO"){?>
    <tr>
        <td><? if($num_clli!=0 and $anexo=="OK"){?>
        <input type='button'  value='Solicitar Validacion' class="EstiloBto" <?=$habVal?>
        onclick='document.alta_demarcador.validarDem.value=1;document.alta_demarcador.submit();'>
		<? }elseif($num_clli!=0 and $conexion_rcdt=="POR TUNEL" and $clase_servicio=="CD SEGURA"){?>
        <input type='button'  value='Solicitar Validacion' class="EstiloBto" <?=$habVal?>
        onclick='document.alta_demarcador.validarDem.value=1;document.alta_demarcador.submit();'>		
		<? }?></td>      
        <td><input type='button'  value='Solicitar Gestion' onclick='<?=$accion?>' class="EstiloBto" <?=$habBt?> style=" <?=$habGest?>"></td>
        <td>
		<? if($num_clli==0){?>
        <input type='button' name='alta' onClick='validar()' value='Registro del Equipo' class="EstiloBto" />
        <? }elseif($gestion!="GESTIONADO"){ ?>
        <input type='button' onClick='document.alta_demarcador.cambio.value=1;document.alta_demarcador.submit();' value='Guardar Cambios' class="EstiloBto" 
		<?=$habBt?>/><? }?>
        </td>
        <td><? if($num_clli!=0){?>
        <input name='anexos' type='button' title='Cargar Anexos del Demarcador' style="height:20px; width:130px;" value='Cargar Anexo'  class="EstiloBto"
        onclick='window.open("carga_anexo_adva.php?clli_adva=<?=$clli_adva?>","_blank","toolbar=0,height=1000,scrollbars=yes" );' <?=$habBt?>/>
		<input type='button' name='ot' value='Generar OT' class="EstiloBto"
        onclick='window.open("ot_infrasisa.php?clli_adva=<?=$clli_adva?>&central=<?=$central?>","_blank","toolbar=0,height=500,width=1000,scrollbars=yes" );'<?=$habBt?>/>
		<? }?></td>
    </tr>
    <? }else{?>
    <tr>
    	<td>&nbsp;</td>
        <? if(($cns4=="" or $cns4=="RECHAZADA" or $cns4=="EJECUTADA SIN EXITO") and $estexp=="VALIDADA"){?>
        <td><input type='button'  value='Solicitar Ampliacion' onclick='document.alta_demarcador.solicitar.value=1;submit();' class="EstiloBto" <?=$habBtAmp?>>
        </td>
		<? }else{?>
        <td><input type='button'  value='Solicitar Ampliacion' onclick='document.alta_demarcador.borrarEst.value=1;submit();' 
        class="EstiloBto" <?=$habValAmp?>></td>
		<? }?>  
        <td><input name='anexos' type='button' title='Cargar Anexos del Demarcador' style="height:20px; width:130px;" value='Cargar Anexo' class="EstiloBto"
        onclick='window.open("carga_anexo_adva.php?clli_adva=<?=$clli_adva?>","_blank","toolbar=0,height=1000,scrollbars=yes" );' <?=$habBt?>/>
		<input type='button' name='ot' value='Generar OT' class="EstiloBto" <?=$habBt?>
        onclick='window.open("ot_infrasisa.php?clli_adva=<?=$clli_adva?>&central=<?=$central?>","_blank","toolbar=0,height=500,width=1000,scrollbars=yes" );'/>
        </td>
    </tr>
    <? }?>
    <tr>
        <td>Clli del Demarcador</td>
        <td >
        <input type="text" name="clli_adva" value="<?=$clli_adva?>" size="30" maxlength="11" onChange='document.alta_demarcador.buscar.value=1;' 
        onBlur='if(document.alta_demarcador.buscar.value==1)submit();'  wrap=physical 
        onKeyDown="textCounter(this.form.clli_adva,this.form.remLen,11);" 
        onKeyUp="textCounter(this.form.clli_adva,this.form.remLen,11);" 
        onkeypress="if(event.keyCode==32)event.returnValue=false" class="tituloAzul"> 
        <input readonly type=hidden name=remLen size=3 maxlength=3 value="11">
        </td>
        <? if(($estexp=="" or $estexp=="RECHAZADA" or $estexp=="CAMBIO") and $num_clli>0){?>
        <td>Cambiar Modelo de Equipo</td>
        <td><input type='button'  value='Cambio de Modelo' class="EstiloBto" 
        onclick='document.alta_demarcador.cambioEquipo.value=1;document.alta_demarcador.submit();'></td><? }?>
    </tr>
    <tr bgcolor="#999999"><td colspan="4" height="4"></td></tr>
    <tr><td class="tituloRojo1" colspan="4">Conexion a RCDT</td></tr>

    <tr>
        <td>Tipo de Conexion</td>
        <td>
        <? if($estexp=="POR REVISAR" or $estexp=="VALIDADA" or $gestion=="GESTIONADO"){?>
        <input name="conexion_rcdt" type="text" size="30" value="<?=$conexion_rcdt?>" readonly/>
        <? }else{?>
        <select name="conexion_rcdt"  onchange="submit();"><option value=""></option>
            <?	
                $a=array("CONEXION DIRECTA A RCDT","POR TUNEL","PUERTO EXTENDIDO","CASCADA");
                for($i=0;$i<count($a);$i++)
                {
                   if($conexion_rcdt==$a[$i])
                   { $sele3="selected";}
                   else {$sele3="";}
                   echo "<option $sele3 value='$a[$i]'>".$a[$i]."</option>";
                }?></select>
        <? }?>            
        </td>
        <td>Anexo OT Cargado:</td>
        <td class="tituloRojo1"><input type="text" value="<?=$anexo?>" readonly class="fondoGris"/></td>
    </tr> 
    <? if($conexion_rcdt=="PUERTO EXTENDIDO" and $tipo_demarcador!="CONVERTIDOR DE MEDIOS"){?>
	<tr>
        <td>Aplica Wdm</td>
        <td>
            <select  name='select_wdm' onchange='submit()' <?=$hab?>>
            <?			
             $a=array("NO","SI");
             for($i=0;$i<count($a);$i++)
             {
               if($select_wdm==$a[$i])	{$sele5="selected";}
               else 					{$sele5="";}
               echo "<option $sele5 value='$a[$i]'>".$a[$i]."</option>";
             }?>
            </select>
        </td>
        <td>Aplica Traspasos</td>
        <td><select  name='aplica_traspasos' onchange='submit()' <?=$hab?>>
            <?			
             $a=array("NO","SI");
             for($i=0;$i<count($a);$i++)
             {
               if($aplica_traspasos==$a[$i]){$sele5="selected";}
               else 						{$sele5="";}
               echo "<option $sele5 value='$a[$i]'>".$a[$i]."</option>";
             }?>
            </select>
        </td>
	</tr>
	<tr>        
		<td>Aplica Puerto de Respaldo</td>
		<td><select name="aplicaSecundario" onchange="submit();" <?=$hab?> >
        <?			
             $b=array("NO","SI");
             for($i=0;$i<count($b);$i++)
             {
               if($aplicaSecundario==$b[$i]){$sele7="selected";}
               else 						{$sele7="";}
               echo "<option $sele7 value='$b[$i]'>".$b[$i]."</option>";
             }?>
      	</select></td>
    </tr>
	<? }?>    
	<? if($conexion_rcdt=="CASCADA"){?> 
    <tr>
        <td>Clli Demarcador a Conectar</td>
        <td><input name="cascada" type="text" id="cascada" title="Por cascada a: "  value="<?=$cascada?>" size="30" 
              onblur="this.value=this.value.toUpperCase();submit();" onkeyup="this.value=this.value.toUpperCase()" <?=$hab?>/>
        </td>
        <td>Puerto</td>
        <td><input name="pto_cascada" type="text" id="PuertoCascada" title="Por Cascada a: "  value="STACK PORTS "  size="30" readonly/>
        </td>
    </tr>
    <? }?>
    <tr>
        <td>Clase de Servicio</td>
        <td><select name="clase_servicio"  onchange="submit();" <?=$hab?>><option value=""></option>
            <?	
				$a=array("IDE","L2","RPV","IDE/RPV","IDE/RPV/L2","NEXTEL","TELCEL","WIMAX","CD SEGURA");
                for($i=0;$i<count($a);$i++)
                {
                   if($clase_servicio==$a[$i])
                   { $sele3="selected";}
                   else {$sele3="";}
                   echo "<option $sele3 value='$a[$i]'>".$a[$i]."</option>";
        
                }?>
             </select>    
        </td>
    </tr> 
    <tr bgcolor="#999999"><td colspan="4" height="4"></td></tr>
    <tr><td class="tituloRojo1" colspan="4">Informacion del Equipo</td></tr>
    <tr>
        <td>Tipo Demarcador</td>
        <td>
            <? if($num_clli>0){?>
        	<input name="tipo_demarcador" type="text" size="30" value="<?=$tipo_demarcador?>" readonly/>
        	<? }else{?>
            <select  name='tipo_demarcador' onchange="submit();"><option value=''></option>
            <? 
             if($conexion_rcdt=="PUERTO EXTENDIDO"||$conexion_rcdt=="CONEXION DIRECTA A RCDT")$f=array("DDE","NDE","DDE-N","NDE-N","CONVERTIDOR DE MEDIOS");
             if($conexion_rcdt=="POR TUNEL")$f=array("DDE","DDE-N");
             if($conexion_rcdt=="CASCADA")$f=array("NDE");
                
             for($i=0;$i<count($f);$i++)
             {
               if($tipo_demarcador==$f[$i])	{ $sele2="selected";}
               else {$sele2="";}
               echo "<option $sele2 value='$f[$i]'>".$f[$i]."</option>";
             }?></select>
             <? }?>            
        </td>
    </tr>

    <tr>
        <td>Modelo del Equipo</td>
        <td>
         <input name="tipo_equipo" type="text" size="30" value="<?=$tipo_equipo?>" readonly class="fondoGris"/>
         <?
            $query="select proveedor,aplica_tarjetas,release_eq,modelo_corto,vlan_gestion from cat_equipo 
			where formato='ADVA' and tipo_equipo='$tipo_equipo' group by tipo_equipo";
            //echo $query;
            $res_query= mysql_query($query);
            $num_query=mysql_num_rows($res_query);
            $row_query=mysql_fetch_row($res_query);
                
            $proveedor				=$row_query[0];
            $aplica_tarjeta			=$row_query[1];
            $release				=$row_query[2];
            $modCorto				=$row_query[3];
            $vlan					=$row_query[4];
         ?>		  
        </td>
        <td>Proveedor</td>
        <td><input type='text' name='proveedor' value='<?=$proveedor?>'   size='30' readOnly class="fondoGris"></td>
    </tr>

    <tr>
        <? if($conexion_rcdt=="PUERTO EXTENDIDO" or ($conexion_rcdt=="POR TUNEL" and $clase_servicio=="CD SEGURA")){?>
        <td>Ref. Sisa Infra</td>  
        <td><input  type='text' name='ref_sisa' value='<?=$ref_sisa?>'  onChange='document.alta_demarcador.val_ref.value=1;submit();' size='29' 
        class="Estilo58" <?=$bloq?>/></td>
   		<? }?>
        <? if($conexion_rcdt=="POR TUNEL" and $clase_servicio=="CD SEGURA"){?>
        <td>CLFI</td>  
        <td><input  type='text' name='clfi' value='<?=$clfi?>'  size='29'  class="Estilo58" <?=$hab?>/></td>
   		<? }?>
        
        
    </tr>
	<tr>
        <td>Vlan Gestion</td>
        <td><input type='text' name='vlan' value='<?=$vlan?>'   size='30' readOnly class="fondoGris"></td>
        <td>Release</td>
        <td><input type='text' name='release' value='<?=$release?>'   size='30' readOnly class="fondoGris"></td>
    </tr>
    <tr>
        <td>Ubicacion del Demarcador</td>
        <td><input type='text'  name='ubicacion_demarcador' id='ubicacion_demarcador' value='<?=$ubicacion_demarcador?>' size='30' readonly class="fondoGris">
        </td>
        <td>OT Instalacion Demarcador</td>
        <td><input type='text' name='ot_instalacion_demarcador' value='<?=$ot_instalacion_demarcador?>' size='30' <?=$hab?>></td>
    </tr>
    
    <tr>
        <td>Funcion del Demarcador</td>
        <td><input type='text'  name='funcion_equipo' id='funcion_equipo' value='<?=$funcion_equipo?>' size='30' maxlength='19'  readonly class="fondoGris"></td>
        <td>Topologia del Demarcador</td>
        <td><input type='text' name='topologia_equipo' value='<?=$topologia_equipo?>' size='30' readonly class="fondoGris"></td>
    </tr>
    
    <tr>
        <td>IP del Demarcador</td>
        <td><input type='text' name='ip_demarcador' value='<?=$ip_demarcador?>' size='30' <?=$habtext?> /></td>
        <? if(($tipo_equipo=="TELLABS 7305"||$tipo_equipo=="TELLABS 7325"||$tipo_equipo=="TELLABS 7345")&&$tipo_equipo<>""){?>
        <td>IP del Gateway</td>
        <td><input type='text' name='ip_demarcador_gateway' value='<?=$ip_demarcador_gateway?>' size='30' <?=$hab?>></td>
        <? }?>
    </tr>
	<? if(($tipo_equipo=="TELLABS 7305" or $tipo_equipo=="TELLABS 7325" or $tipo_equipo=="TELLABS 7345")&&$tipo_equipo<>""and $division<>""){?>
    <tr>
        <td>Id Equipo</td>
        <td><input type='text' name='id_equipo2' value='<?=$id_equipo?>'   size='30' readOnly class="fondoGris"></td>
    </tr><? }?>
    <tr bgcolor="#999999"><td colspan="4" height="4"></td></tr>
    <tr><td class="tituloRojo1" colspan="4">Datos Generales</td></tr>
    <tr>
        <td>Division</td>
        <td><? if($num_clli>0) {?>
                <input type='text'  name='division' id='division' value='<?=$division?>' size='30' readonly>
        	<? } else {
					$query_division="select dir_div from centrales group by dir_div";
					$res_division=mysql_query($query_division);
					$num_division=mysql_num_rows($res_division);
			?>
                    <select name='division' onchange='submit();'><option value=''></option>
                    <? 
                     for($i=0;$i<$num_division;$i++)
                     {
                       $row_division=mysql_fetch_array($res_division);
                       if($division==$row_division['dir_div'])	{$seleDiv="selected";}
                       else 									{$seleDiv="";}
                       echo "<option $seleDiv value='".$row_division['dir_div']."'>".$row_division['dir_div']."</option>";
                    }?></select>
         <? }?>        
        </td>
        <td>Estado</td>
        <td>
        <? if($num_clli>0) {?>
        <input type='text'  name='estado' id='Estado' value='<?=$estado?>' size='30' readonly>
   		<? } else {?>
			<?
            $query_edo="select edo from centrales where dir_div='$division' group by edo order by edo ";
            //echo $query_edo;	
            $res_edo = mysql_query($query_edo);	
            $num_edo=mysql_num_rows($res_edo);?>     
            <select name='estado' onchange='submit();'><option value=''></option>
            <? 
             for($i=0;$i<$num_edo;$i++)
             {
			   $row_edo=mysql_fetch_array($res_edo);
               if($estado==$row_edo['edo']){ $seleEdo="selected";}
               else {$seleEdo="";}
               echo "<option $seleEdo value='".$row_edo['edo']."'>".$row_edo['edo']."</option>";
            }?></select>
        <? }?></td>
    </tr>

    <tr>
        <td>Ciudad</td>
        <td>
        <? if($num_clli>0) {?>
        <input type='text'  name='ciudad' id='ciudad' value='<?=$ciudad?>' size='30' readonly>
   		<? } else {?>
			<?
            $query_ciudad="select area from centrales where edo='$estado' and dir_div='$division' group by area order by area ";
            //echo $query_ciudad;
            $res_ciudad = mysql_query($query_ciudad);		
            $num_ciudad=mysql_num_rows($res_ciudad);?>     
            <select name='ciudad' onchange='submit();'><option value=''></option>
            <? 
             for($i=0;$i<$num_ciudad;$i++)
             {
			   $row_ciudad=mysql_fetch_array($res_ciudad);
               if($ciudad==$row_ciudad['area']){ $seleCiud="selected";}
               else {$seleCiud="";}
               echo "<option $seleCiud value='".$row_ciudad['area']."'>".$row_ciudad['area']."</option>";
            }?></select>
        <? }?></td>
        
        <td>Central</td>
        <td><?
            if ($tipo_demarcador=="NDE" || $tipo_demarcador=="NDE-N" || $tipo_demarcador=="CONVERTIDOR DE MEDIOS")
            {?>
                <? if($num_clli>0) {?>
                    <input type='text'  name='central' id='central' value='<?=$central?>' size='30' readonly>
                <? } else {
                         $query_central="select edificio from centrales where area='$ciudad' and edo='$estado' and dir_div='$division' order by edificio asc ";
                         //echo $query_central;
                         $res_central=mysql_query($query_central);
                         $num_central=mysql_num_rows($res_central);
                    ?>	 
                    <select name='central' onchange='submit();'><option value=''></option>
                    <? 
                     for($i=0;$i<$num_central;$i++)
                     {
                       $row_central=mysql_fetch_array($res_central);
                       if($central==$row_central['edificio']){ $seleCtrl="selected";}
                       else {$seleCtrl="";}
                       echo "<option $seleCtrl value='".$row_central['edificio']."'>".$row_central['edificio']."</option>";
                     }?></select>
				<? }?>
            <? }else{?>
                <input type='text'  name='central' value='<?=$central?>' size='30' <?=$hab?>>
            <? }?>
        </td>
    </tr>
    <tr>
        <td>Clli Edificio</td>
        <td><input type='text' name='clli_edif' value='<?=$clli_edif?>'   size='30' readOnly class="fondoGris"></td>
        <? if ($tipo_demarcador=="NDE" || $tipo_demarcador=="NDE-N" || $tipo_demarcador=="CONVERTIDOR DE MEDIOS"){?>
        <td>Siglas</td>
        <td>
        <? if($num_clli>0) {?>
        <input type='text'  name='siglas' id='siglas' value='<?=$siglas?>' size='30' readonly>
   		<? } else {?>
		<?
        $query_siglas="select sigcent from centrales  where dir_div = '$division' AND edo= '$estado' AND area='$ciudad' AND edificio = '$central'";
        //echo $query_siglas;
        $res_siglas =mysql_query($query_siglas);		
        $numSiglas = mysql_num_rows($res_siglas);?>
        <select name='siglas'>
            <? 
             for($i=0;$i<$numSiglas;$i++)
             {
			   $rowSiglas=mysql_fetch_array($res_siglas);
               if($siglas==$rowSiglas['sigcent'])	{$seleSig="selected";}
               else 								{$seleSig="";}
               echo "<option $seleSig value='".$rowSiglas['sigcent']."'>".$rowSiglas['sigcent']."</option>";
            }?></select>
        <? }?></td>       
    	<? }?>
    </tr>          
	<? if($num_clli>0){?>
    <tr bgcolor="#999999"><td colspan="4" height="4"></td></tr>
    <tr><td class="tituloRojo1" colspan="4">Observaciones del Solicitante</td></tr>
    <tr>
        <td>Observaciones</td>
        <td colspan="3"><textarea name='descrip' id='descrip' rows='5' cols='50'></textarea></td>
    </tr><? }?>
</table>
<!--------------------------------  PESTA├ّAS DEL PROGRAMA ---> 
<div class='domtab'>
	<ul  class='domtabs'>
        <? if($conexion_rcdt=="CONEXION DIRECTA A RCDT") $menu="RCDT";
		   if($conexion_rcdt=="CONEXION DIRECTA A RCDT" and $tipo_demarcador=="CONVERTIDOR DE MEDIOS") $menu="TRANSPORTE";
		   if($conexion_rcdt=="PUERTO EXTENDIDO"  or $conexion_rcdt=="") $menu="TRANSPORTE";
		   if($conexion_rcdt=="POR TUNEL"||$conexion_rcdt=="CASCADA") $menu="DEMARCADORES";	
		?>
        <li><a href='#tx_dem1'    id='lnk_tx'   	class='Estilo41'><?=$menu?>			 	</a></li>
        <? if($tipo_demarcador=="CONVERTIDOR DE MEDIOS" and $conexion_rcdt=="CONEXION DIRECTA A RCDT"){?>
        <li><a href='#tx_dem2'    id='lnk_tx2'   	class='Estilo41'>RCDT		 			</a></li><? }?>
        <li><a href='#equ_dem2'   id='lnk_eq'   	class='Estilo41'>EQUIPAMIENTO		 	</a></li>
        <li><a href='#equOcupado' id='lnk_eqOcup'   class='Estilo41'>OCUPACION				</a></li>
        <li><a href='#bitac'   	  id='lnk_bitac'    class='Estilo41'>BITACORA		 		</a></li>

    </ul>
</div>
<? if($tipo_demarcador=="CONVERTIDOR DE MEDIOS" and $conexion_rcdt=="CONEXION DIRECTA A RCDT"){?>
<div>
<a name="tx_dem2" id="tx_dem2"></a>
   <table id='tbGeneral'>
     <tr class="tituloRojo1">
          <td colspan="4">Informacion del Nodo de Acceso</td>
     </tr>
     <tr>
          <td>Switch</td>
          <td><input name="switc" type="text"  title="Switch" value="<?=$switc?>" size="30" <?=$hab?>/></td>
          <td>Puerto</td>
          <td><input name="pto" value="<?=$pto?>" type="text"  title="Puerto" size="30" <?=$hab?>/></td>
     </tr>
	 <tr>
          <td>Velocidad</td>
          <td><select name="velocidad" <?=$hab?>>
           <? $vel=array("100MB","10MB");
			for($i=0;$i<count($vel);$i++)
			{
			   if($velocidad==$vel[$i])	{ $sele3="selected";}
			   else 					{$sele3="";}
			   echo "<option $sele3 value='$vel[$i]'>".$vel[$i]."</option>";
			}?></select></td>
          <td>No Cambio</td>
          <td><input name="num_cambio" value="<?=$num_cambio?>" type="text" id="num_cambio" title="No de Cambio" size="30" <?=$hab?>/></td>
     </tr>
   </table>
</div>
<? }?>
<div>
<a name="tx_dem1" id="tx_dem1"></a>
<!------------------------------------------------- TRANSPORTE CUANDO SEA CONEXION DIRECTA A RCDT -------------------------------------->     
<? if($conexion_rcdt=="CONEXION DIRECTA A RCDT" and $tipo_demarcador!="CONVERTIDOR DE MEDIOS"){ ?>
   <table id='tbGeneral'>
     <tr class="tituloRojo1">
          <td colspan="4">Informacion del Nodo de Acceso</td>
     </tr>
     <tr>
          <td>Switch</td>
          <td><input name="switc" type="text"  title="Switch" value="<?=$switc?>" size="30" <?=$hab?>/></td>
          <td>Puerto</td>
          <td><input name="pto" value="<?=$pto?>" type="text"  title="Puerto" size="30" <?=$hab?>/></td>
     </tr>
	 <tr>
          <td>Velocidad</td>
          <td><select name="velocidad" <?=$hab?>>
           <?	
			$vel=array("100MB","10MB");
			for($i=0;$i<count($vel);$i++)
			{
			   if($velocidad==$vel[$i])
			   { $sele3="selected";}
			   else {$sele3="";}
			   echo "<option $sele3 value='$vel[$i]'>".$vel[$i]."</option>";
			}?>
              </select></td>
          <td>No Cambio</td>
          <td><input name="num_cambio" value="<?=$num_cambio?>" type="text" id="num_cambio" title="No de Cambio" size="30" <?=$hab?>/></td>
     </tr>
   </table>
<? if(($tipo_demarcador=="DDE" or $tipo_demarcador=="DDE-N") and $tipo_equipo=="FSP 150GE-X" and $clase_servicio=="TELCEL"){?>
<br />
<table class="tbGeneral">
	<tr class="tituloRojo1"><td colspan="4">Informacion del Puerto del Cliente</td></tr>
    <tr>
            <td>Puerto Cliente</td>
            <td>
           	<select  name='pto_clt_serv' onchange="submit();"><option value=''>Selecciona Puerto ---></option>
				<?
					   $query_ptoreqA="select replace(concat_ws('/',replace(repisat,'N/A',''),replace(slot,'N/A',''),puerto),'//','' ) as puerto,
					   tipo_puerto,nombre_oficial_pisa,contacto_bdfo,ubicacion_bdfo,repisa_bdfo 
					   from inventario_puertos_demarcadores 
					   where clli_adva='$clli_adva'  and (estatus='DISPONIBLE' or (estatus='RESERVADO' and tipo_servicio='SERVICIO')) 
					   order by length(puerto),puerto";
                   //echo $query_ptoreqA;
                   $res_ptoreqA= mysql_query($query_ptoreqA);
                   $num_ptoreqA=mysql_num_rows($res_ptoreqA);
                            
                   if($num_ptoreqA>0)
                     {
                       for($i=0;$i<$num_ptoreqA;$i++)
                          {
							$row_ptoreqA=mysql_fetch_row($res_ptoreqA);
                            if($pto_clt_serv==$row_ptoreqA[0])
                              {
								   $selepto="selected";
							  	   $tipoPuertoCliente2				=$row_ptoreqA[1];
								   $refServicio						=$row_ptoreqA[2];
								   $contactoCliente2				=$row_ptoreqA[3];
								   $ubicacionCliente2				=$row_ptoreqA[4];
								   $repisaCliente2					=$row_ptoreqA[5];
							  }
                            else 
                              {$selepto="";}
                            echo "<option $selepto value='".$row_ptoreqA[0]."'>".$row_ptoreqA[0]."</option>";
							
							if($refServicio!="") {$btoBloq="disabled";}
							else				 {$btoBloq="";}
                          }
                     }
                 ?>
            </select>
            </td>
	</tr>
    <tr>
            <td>Tipo Puerto</td>
            <td><input type="text" size="30" value="<?=$tipoPuertoCliente2?>" readonly class="fondoGris"/></td>
    </tr>	
	<tr>
            <td>Ref Sisa (Servicio)</td>
            <td><input type="text" size="30" name="refSisaPto" value="<?=$refServicio?>"/></td>
    </tr>	
    <tr>  
            <td>Contacto Bdfo</td>
            <td><input name='contacto_bdfoRx22' type='text' size='30' id='Contacto BdfoRx22'  value='<?=$contactoCliente2?>' readonly class="fondoGris"/> </td>
    </tr>
    <tr>
          	<td>Ubicacion Bdfo</td>
            <td><input name='ubicacion_bdfoRx22' type='text' size='30' id='Ubicacion BdfoRx22'  value='<?=$ubicacionCliente2?>' readonly class="fondoGris"/> </td>
    </tr>
    <tr>
           	<td>Repisa Bdfo</td>
            <td><input name='repisa_bdfoRx22' type='text' size='30'    id='Repisa BdfoRx22'  value='<?=$repisaCliente2?>' readonly class="fondoGris"/> </td>
    </tr>
	<? if($num_clli>0){?>
    <tr>
            <td colspan="2" align="center">
            <input type="button" value="Reserva Puerto Servicio" onclick="document.alta_demarcador.reservaServicio.value=1;submit();" class="Estilo57"
            <?=$btoBloq?>/></td>
    </tr><? }?>
</table>
<? }?>
<? }?>
<!------------------------------------------------- TRANSPORTE CUANDO SEA CASCADA --------------------------------------------->     
<? if($conexion_rcdt=="CASCADA"){ ?>    
	 <? $query_nde="select ubicacion_demarcador,ip_demarcador,ot_instalacion_demarcador,tipo_demarcador,tipo_equipo,proveedor,ref_sisa
	 				from inventario_demarcadores where clli_adva='$cascada'";
		//echo $query_nde;			
		$res_nde=mysql_query($query_nde);
		$row_nde=mysql_fetch_row($res_nde);			
  	 ?>
	<table id='tbGeneral'>
         <tr class="tituloRojo1">
          <td colspan="4">Informacion del Equipo <?=$row_nde[3]?></td>
         </tr>
         <tr>
          <td>Por Cascada a:</td>
          <td colspan="2"><input  type="text"  title="Por Cascada a:"  value="<?=$cascada?>" size="30" readonly/></td>
         </tr>

        <tr>
            <td>Ubicacion del Demarcador</td>
            <td><input type='text' name='ubicacion_demarcador2' id='ubicacion_demarcador2' value='<?=$row_nde[0]?>' size='30' maxlength='19' readonly ></td>
        </tr>
        <tr>
            <td>IP del Demarcador</td>
            <td><input type='text' name='ip_demarcador2' value='<?=$row_nde[1]?>' size='30' readonly></td>
            <td>OT Instalacion Demarcador</td>
            <td><input type='text' name='ot_instalacion_demarcador2' value='<?=$row_nde[2]?>' size='30' readonly></td>
        </tr>
        <tr>
            <td>Tipo Demarcador</td>
            <td><input type='text' name='tipo_demarcador2' value='<?=$row_nde[3]?>' size='30' readonly></td>
        </tr>
        <tr>
            <td>Modelo del Equipo</td>
            <td><input type='text' name='tipo_equipo2' value='<?=$row_nde[4]?>' size='30' readonly></td>
            <td>Proveedor</td>
            <td><input type='text' name='proveedor2' value='<?=$row_nde[5]?>'   size='30' readOnly></td>
        </tr>
	</table>
<? }?>
<!------------------------------------------------- TRANSPORTE CUANDO SEA PUERTO EXTENDIDO 		--------------------------------------------->     
<? if($conexion_rcdt=="PUERTO EXTENDIDO"  and $tipo_demarcador!="CONVERTIDOR DE MEDIOS"){ ?>
  <table id='tbGeneral'>
     <tr>
          <td>Cluster</td>
          <td colspan="3">
          <?
			$query_cluster="SELECT anillo FROM cat_anillo WHERE tecnologia='CARRIER ETHERNET' and division='$division' GROUP BY anillo ORDER BY anillo ASC";
            $res_cluster = mysql_query($query_cluster);		
            if ($row_cluster = mysql_fetch_array($res_cluster))
            { ?>
                <select name='cluster' onchange='submit()' title='Seleccionar el Cluster' <?=$hab?>><option value=''></option>
                    <?	do { 
                            if($cluster==$row_cluster["anillo"]) $selno="selected";
                            else 								 $selno="";	
                            echo "<option $selno value= '".$row_cluster["anillo"]."'>".$row_cluster["anillo"]." </option>";
                            } while ($row_cluster = mysql_fetch_array($res_cluster)); ?>
                </select>			
            <? }?>
          </td>
	 </tr>
          <tr bgcolor="#999999"><td colspan="4" height="4"></td></tr> 
     <tr class="tituloRojo1"><td colspan="4">Nodo de Acceso</td></tr>    
     <tr>
          <td>Tipo Nodo</td>
          <td colspan="3"><select name='tipo_nodo_acceso'  onchange='submit();' <?=$hab?>><option value=""></option>
            <?	
            //if($tipo_demarcador=="DDE" || $tipo_demarcador=="NDE") 
			$a=array("AGREGADOR","AGREGADOR 2","DISTRIBUIDOR");
            //else  $a=array();
            for($i=0;$i<count($a);$i++)
               {
                if($tipo_nodo_acceso==$a[$i]) { $sele7="selected";}
                else 						  {$sele7="";}
                echo "<option $sele7 value='$a[$i]'>".$a[$i]."</option>";
               } ?>
               </select>
          </td>
      </tr>
      <tr>
           <td>Nodo </td>
           <td><?
               $query_nacc="select nodo_adm_conex_adsl from cat_anillo where anillo='$cluster' and tipo_cluster='$tipo_nodo_acceso' 
               group by nodo_adm_conex_adsl order by nodo_adm_conex_adsl ASC";
			   //echo"<br>$query_nacc";
               $res_nacc = mysql_query($query_nacc);		
            if ($row = mysql_fetch_array($res_nacc))
               { ?>
                <select name= 'nodo_adm_conex_adsl_acceso' class='Estilo48' onchange='submit()' title='Seleccionar el Nodo de Acceso' <?=$hab?>>
                <option value=''></option>
                    <?	do { 
                                if($nodo_adm_conex_adsl_acceso==$row["nodo_adm_conex_adsl"]) $selno_nacc="selected";
                                else $selno_nacc="";
                                    echo "<option $selno_nacc value= '".$row["nodo_adm_conex_adsl"]."'>".$row["nodo_adm_conex_adsl"]." </option>";
                            } while ($row = mysql_fetch_array($res_nacc)); ?>
                </select>		
            <?	}				       
                $dat_nacc=mysql_query("select id_nodo, ubi_nodo_adm, clli_equipo, repadm_conxadsl,proveedor_tx,repisa from cat_anillo where anillo='$cluster' 
                and nodo_adm_conex_adsl='$nodo_adm_conex_adsl_acceso' and tipo_cluster like '$tipo_nodo_acceso%' 
				group by clli_equipo, ubi_nodo_adm,repadm_conxadsl");
               // echo"<br>select id_nodo, ubi_nodo_adm, clli_equipo, repadm_conxadsl,proveedor_tx,repisa from cat_anillo where anillo='$cluster' and nodo_adm_conex_adsl='$nodo_adm_conex_adsl_acceso' and tipo_cluster like '$tipo_nodo_acceso%' group by clli_equipo, ubi_nodo_adm,repadm_conxadsl";
                $datos_nacc = mysql_fetch_array($dat_nacc);
                $clli_equipo_acceso=$datos_nacc['clli_equipo'];
                $repisa_acceso=$datos_nacc['repisa'];
                $repadm_conxadsl_acceso=$datos_nacc['repadm_conxadsl'];
                $id_nodo_acceso=$datos_nacc['id_nodo'];
                $proveedor_tx_acceso=$datos_nacc['proveedor_tx'];		
                $ubi_nodo_adm_acceso=$datos_nacc['ubi_nodo_adm'];		
                //$mod_tar_eth_acceso="ASIGNADO";	?></td>
            <td>Id Nodo</td>
            <td><input type='text' size='30' value='<?=$id_nodo_acceso?>' readonly class="fondoGris" ></td>
       </tr>
       <tr>
            <td>Proveedor </td>
            <td><input name="proveedor_tx_acceso" type="text"  id="proveedor_tx_acceso" title="Proveedor" value="<?=$proveedor_tx_acceso?>" readonly size="30" class="fondoGris"/>
            </td>
            <td>Modelo</td>
            <td><input name="repadm_conxadsl_acceso" type="text" size="30"  id="repadm_conxadsl_acceso" title="Modelo del ADM" 
            value="<?=$repadm_conxadsl_acceso?>" readonly class="fondoGris"/></td>	       
       </tr>
       <tr>
            <td>CLLI</td>
            <td><input name="clli_equipo_acceso" type="text"  id="clli_equipo_acceso" title="CLLI del Nodo de Acceso" value="<?=$clli_equipo_acceso?>" readonly 
            size="30" class="fondoGris"/></td>
            <td>Ubicacion</td>
            <td><input name="ubi_nodo_adm_acceso" type="text"  id="ubi_nodo_adm_acceso" title="Ubicacion del Nodo de Acceso" 
            value="<?=$ubi_nodo_adm_acceso?>" readonly size="30" class="fondoGris"/></td>
       </tr>
</table>
<br />
<? if(($tipo_demarcador=="DDE" or $tipo_demarcador=="DDE-N") and $tipo_equipo=="FSP 150GE-X"){?>
<table class="tbGeneral">
	<tr class="tituloRojo1"><td colspan="4">Informacion del Puerto del Cliente</td></tr>
    <tr>
            <td>Puerto Cliente</td>
            <td>
           	<select  name='pto_clt_serv' onchange="submit();"><option value=''>Selecciona Puerto ---></option>
				<?
					   $query_ptoreqA="select replace(concat_ws('/',replace(repisat,'N/A',''),replace(slot,'N/A',''),puerto),'//','' ) as puerto,
					   tipo_puerto,nombre_oficial_pisa,contacto_bdfo,ubicacion_bdfo,repisa_bdfo 
					   from inventario_puertos_demarcadores 
					   where clli_adva='$clli_adva'  and (estatus='DISPONIBLE' or (estatus='RESERVADO' and tipo_servicio='SERVICIO')) 
					   order by length(puerto),puerto";
                   //echo $query_ptoreqA;
                   $res_ptoreqA= mysql_query($query_ptoreqA);
                   $num_ptoreqA=mysql_num_rows($res_ptoreqA);
                            
                   if($num_ptoreqA>0)
                     {
                       for($i=0;$i<$num_ptoreqA;$i++)
                          {
							$row_ptoreqA=mysql_fetch_row($res_ptoreqA);
                            if($pto_clt_serv==$row_ptoreqA[0])
                              {
								   $selepto="selected";
							  	   $tipoPuertoCliente2				=$row_ptoreqA[1];
								   $refServicio						=$row_ptoreqA[2];
								   $contactoCliente2				=$row_ptoreqA[3];
								   $ubicacionCliente2				=$row_ptoreqA[4];
								   $repisaCliente2					=$row_ptoreqA[5];
							  }
                            else 
                              {$selepto="";}
                            echo "<option $selepto value='".$row_ptoreqA[0]."'>".$row_ptoreqA[0]."</option>";
							
							if($refServicio!="") {$btoBloq="disabled";}
							else				 {$btoBloq="";}
                          }
                     }
                 ?>
            </select>
            </td>
	</tr>
    <tr>
            <td>Tipo Puerto</td>
            <td><input type="text" size="30" value="<?=$tipoPuertoCliente2?>" readonly class="fondoGris"/></td>
    </tr>	
	<tr>
            <td>Ref Sisa (Servicio)</td>
            <td><input type="text" size="30" name="refSisaPto" value="<?=$refServicio?>"/></td>
    </tr>	
    <tr>  
            <td>Contacto Bdfo</td>
            <td><input name='contacto_bdfoRx22' type='text' size='30' id='Contacto BdfoRx22'  value='<?=$contactoCliente2?>' readonly class="fondoGris"/> </td>
    </tr>
    <tr>
          	<td>Ubicacion Bdfo</td>
            <td><input name='ubicacion_bdfoRx22' type='text' size='30' id='Ubicacion BdfoRx22'  value='<?=$ubicacionCliente2?>' readonly class="fondoGris"/> </td>
    </tr>
    <tr>
           	<td>Repisa Bdfo</td>
            <td><input name='repisa_bdfoRx22' type='text' size='30'    id='Repisa BdfoRx22'  value='<?=$repisaCliente2?>' readonly class="fondoGris"/> </td>
    </tr>
	<? if($num_clli>0){?>
    <tr>
            <td colspan="2" align="center">
            <input type="button" value="Reserva Puerto Servicio" onclick="document.alta_demarcador.reservaServicio.value=1;submit();" class="Estilo57"
            <?=$btoBloq?>/></td>
    </tr><? }?>
</table>
<? }?>
<? if(($tipo_demarcador=="DDE" or $tipo_demarcador=="DDE-N") and $tipo_equipo=="FSP 150CC-825"){?>
<table class="tbGeneral">
	<tr class="tituloRojo1"><td colspan="4">Informacion del Puerto del Cliente</td></tr>
    <tr>
            <td>Puerto Cliente</td>
            <td>
            <? $queryBusc="select replace(concat_ws('/',replace(repisat,'N/A',''),replace(slot,'N/A',''),puerto),'//','' ) as puerto,
					   tipo_puerto,nombre_oficial_pisa,contacto_bdfo,ubicacion_bdfo,repisa_bdfo 
					   from inventario_puertos_demarcadores where clli_adva='$clli_adva' and tipo_servicio='SERVICIO'";
			   $resBusc=mysql_query($queryBusc);$numBusc=mysql_num_rows($resBusc);$rowBusc=mysql_fetch_row($resBusc);
			   if($numBusc>0){   
								   $PuertoCliente2					=$rowBusc[0];
								   $tipoPuertoCliente2				=$rowBusc[1];
								   $refServicio						=$rowBusc[2];
								   $contactoCliente2				=$rowBusc[3];
								   $ubicacionCliente2				=$rowBusc[4];
								   $repisaCliente2					=$rowBusc[5];
							if($refServicio!="") {$btoBloq="disabled";}
							else				 {$btoBloq="";}
			?>
            <input name='pto_clt_serv' type="text" size="30" value="<?=$PuertoCliente2?>" readonly/>
            <? }else{?>
           	<select  name='pto_clt_serv' onchange="submit();"><option value=''>Selecciona Puerto ---></option>
				<?

					   $query_ptoreqA="select replace(concat_ws('/',replace(repisat,'N/A',''),replace(slot,'N/A',''),puerto),'//','' ) as puerto,
					   tipo_puerto,nombre_oficial_pisa,contacto_bdfo,ubicacion_bdfo,repisa_bdfo 
					   from inventario_puertos_demarcadores 
					   where clli_adva='$clli_adva'  and (estatus='DISPONIBLE' or (estatus='RESERVADO' and tipo_servicio='SERVICIO')) and puerto like '%LAN%'
					   order by length(puerto),puerto";
                   //echo $query_ptoreqA;
                   $res_ptoreqA= mysql_query($query_ptoreqA);
                   $num_ptoreqA=mysql_num_rows($res_ptoreqA);
                            
                   if($num_ptoreqA>0)
                     {
                       for($i=0;$i<$num_ptoreqA;$i++)
                          {
							$row_ptoreqA=mysql_fetch_row($res_ptoreqA);
                            if($pto_clt_serv==$row_ptoreqA[0])
                              {
								   $selepto="selected";
							  	   $tipoPuertoCliente2				=$row_ptoreqA[1];
								   $refServicio						=$row_ptoreqA[2];
								   $contactoCliente2				=$row_ptoreqA[3];
								   $ubicacionCliente2				=$row_ptoreqA[4];
								   $repisaCliente2					=$row_ptoreqA[5];
							  }
                            else 
                              {$selepto="";}
                            echo "<option $selepto value='".$row_ptoreqA[0]."'>".$row_ptoreqA[0]."</option>";
							
							if($refServicio!="") {$btoBloq="disabled";}
							else				 {$btoBloq="";}
                          }
                     }
                 ?>
            </select>
            <? }?>
            </td>
	</tr>
    <tr>
            <td>Tipo Puerto</td>
            <td><input type="text" size="30" value="<?=$tipoPuertoCliente2?>" readonly class="fondoGris"/></td>
    </tr>	
	<tr>
            <td>Ref Sisa (Servicio)</td>
            <td><input type="text" size="30" name="refSisaPto" value="<?=$refServicio?>"/></td>
    </tr>	
    <tr>  
            <td>Contacto Bdfo</td>
            <td><input name='contacto_bdfoRx22' type='text' size='30' id='Contacto BdfoRx22'  value='<?=$contactoCliente2?>' readonly class="fondoGris"/> </td>
    </tr>
    <tr>
          	<td>Ubicacion Bdfo</td>
            <td><input name='ubicacion_bdfoRx22' type='text' size='30' id='Ubicacion BdfoRx22'  value='<?=$ubicacionCliente2?>' readonly class="fondoGris"/> </td>
    </tr>
    <tr>
           	<td>Repisa Bdfo</td>
            <td><input name='repisa_bdfoRx22' type='text' size='30'    id='Repisa BdfoRx22'  value='<?=$repisaCliente2?>' readonly class="fondoGris"/> </td>
    </tr>
	<? if($num_clli>0){?>
    <tr>
            <td colspan="2" align="center">
            <input type="button" value="Reserva Puerto Servicio" onclick="document.alta_demarcador.reservaServicio.value=1;submit();" class="Estilo57"/></td>
    </tr><? }?>
</table>
<? }?>
<? }?> 
<!------------------------------------------------- TRANSPORTE CUANDO SEA CONVERTIDOR DE MEDIOS --------------------------------------------->     
<? if(($conexion_rcdt=="PUERTO EXTENDIDO" or $conexion_rcdt=="CONEXION DIRECTA A RCDT") and $tipo_demarcador=="CONVERTIDOR DE MEDIOS"){ ?>
  <table id='tbGeneral'>
     <tr>
          <td>Cluster</td>
          <td colspan="3"><input name="cluster" type="text"  id="cluster" title="Cluster" value="<?=$cluster?>" readonly  size="30"/></td>
	 </tr>
     <tr bgcolor="#999999"><td colspan="4" height="4"></td></tr>
     <tr class="tituloRojo1"><td colspan="4">Nodo de Distribuidor</td></tr>    
     <tr>
          <td>Distribuidor</td>
          <td colspan="3"><input name="tipo_nodo_dist" type="text"  id="tipo_nodo_dist" title="Distribuidor" value="<?=$tipo_nodo_dist?>" readonly  size="30"/>
          </td>
      </tr>    
      <tr>
           <td>Nodo Distribuidor</td>
          <td><input name="nodo_adm_conex_adsl_dist" type="text"  id="nodo_adm_conex_adsl_dist" title="Nodo Distribuidor" value="<?=$nodo_adm_conex_adsl_dist?>"
           readonly  size="30"/></td>
            <td>Id Nodo Distribuidor</td>
            <td><input type='text' size='30' value='<?=$id_nodo_dist?>' readonly ></td>
       </tr>    
       <tr>
            <td>Proveedor </td>
            <td><input name="proveedor_tx_dist" type="text"  id="proveedor_tx_dist" title="Proveedor" value="<?=$proveedor_tx_dist?>" readonly size="30"/>
            </td>
            <td>Modelo</td>
            <td><input name="repadm_conxadsl_dist" type="text" size="30"  id="repadm_conxadsl_dist" title="Modelo del ADM" 
            value="<?=$repadm_conxadsl_dist?>" readonly /></td>	       
       </tr>
       <tr>
            <td>CLLI</td>
            <td><input name="clli_equipo_dist" type="text"  id="clli_equipo_dist" title="CLLI del Nodo de Acceso" value="<?=$clli_equipo_dist?>" readonly 
            size="30"/></td>
            <td>Ubicacion</td>
            <td><input name="ubi_nodo_adm_dist" type="text"  id="ubi_nodo_adm_dist" title="Ubicacion del Nodo de Acceso" 
            value="<?=$ubi_nodo_adm_dist?>" readonly size="30"/></td>
       </tr>
     <tr bgcolor="#999999"><td colspan="4" height="4"></td></tr> 
     <tr class="tituloRojo1"><td colspan="4">Nodo de Acceso</td></tr>  
          <tr>
          <td>Tipo Nodo</td>
          <td colspan="3"><input name="tipo_nodo_acceso" type="text"  id="tipo_nodo_acceso" title="Tipo Nodo" 
            value="<?=$tipo_nodo_acceso?>" readonly size="30"/></td>
      </tr>
      <tr>
           <td>Nodo </td>
          <td><input name="nodo_adm_conex_adsl_acceso" type="text"  id="nodo_adm_conex_adsl_acceso" title="Nodo" 
            value="<?=$nodo_adm_conex_adsl_acceso?>" readonly size="30"/></td>
            <td>Id Nodo</td>
            <td><input type='text' size='30' value='<?=$id_nodo_acceso?>' readonly ></td>
       </tr>
       <tr>
            <td>Proveedor </td>
            <td><input name="proveedor_tx_acceso" type="text"  id="proveedor_tx_acceso" title="Proveedor" value="<?=$proveedor_tx_acceso?>" readonly size="30"/>
            </td>
            <td>Modelo</td>
            <td><input name="repadm_conxadsl_acceso" type="text" size="30"  id="repadm_conxadsl_acceso" title="Modelo del ADM" 
            value="<?=$repadm_conxadsl_acceso?>" readonly /></td>	       
       </tr>
       <tr>
            <td>CLLI</td>
            <td><input name="clli_equipo_acceso" type="text"  id="clli_equipo_acceso" title="CLLI del Nodo de Acceso" value="<?=$clli_equipo_acceso?>" readonly 
            size="30"/></td>
            <td>Ubicacion</td>
            <td><input name="ubi_nodo_adm_acceso" type="text"  id="ubi_nodo_adm_acceso" title="Ubicacion del Nodo de Acceso" 
            value="<?=$ubi_nodo_adm_acceso?>" readonly size="30"/></td>
       </tr>
              <tr bgcolor="#999999"><td colspan="4" height="4"></td></tr>    
       <tr>
            <td>Tipo de Puerto Requerido</td>
            <td><input type="text"  value="<?=$tipo_puerto_acceso?>" readonly="readonly"/></td>
       </tr>
       <tr>
            <td>Puerto</td>
            <td><input   name="puerto_acceso" type="text" id="puerto_acceso" title="Puerto asignado" value="<?=$puerto_acceso?>" size="30" readOnly /></td>
            <td>Tipo de Puerto</td>
            <td><input  type="text"  id="tipo_puerto_acceso" title="Tipo de Puerto" value="<?=$tipo_puerto_acceso?>" size="30" readOnly/></td>
      </tr>
	  <tr>
            <td>Velocidad de Puerto (GB) </td>
            <td><input name="capacidad_puerto_acceso"   type="text"   id="capacidad_puerto_acceso" title="Velocidad del Puerto" 
            value="<?=$capacidad_puerto_acceso?>" readOnly size="30"/></td>
      </tr>
	  <tr>
            <td>Remate en BDFO </td>
            <td><input size="17" name="ubicacion_bdfo_acceso"  readOnly type="text"  id="ubicacion_bdfo_acceso" title="Ubicacion" 
            value="<?=$ubicacion_bdfo_acceso?>"/>
            <input size="5" name="repisa_bdfo_acceso"  readOnly  type="text"  id="repisa_bdfo_acceso" title="Repisa" value="<?=$repisa_bdfo_acceso?>"/>
            <input size="5" name="contacto_bdfo_acceso"  readOnly  type="text" id="contacto_bdfo_acceso" title="Contacto" value="<?=$contacto_bdfo_acceso?>"/></td>
            <td>Modelo de Tarjeta</td>
            <td><input name="mod_tar_eth_acceso" readOnly type="text"  id="mod_tar_eth_acceso" title="Modelo de Tarjeta" size="30" 
            value="<?=$mod_tar_eth_acceso?>" />
            </td>
      </tr> 
      <tr>
            <td>Id Puerto Fisico</td>
            <td colspan="3"><input name="id_puerto_acceso"  type="text" class="Estilo48" id="id_puerto_acceso" title="Id Pto" size="75" 
            value="<?=$id_puerto_acceso?>" readOnly/>
            </td>            
      </tr>
  </table> 
<br />
<table id="tbGeneral">      
      <tr class="tituloRojo1"><td colspan="4">Puerto Convertidor - Agregador</td></tr>
      <tr>
      		<td>Puerto Transporte</td>
            <td>   
            <? 	
				$nom2=$clli_adva."_WIMAX";	
				$queryPtoDemR="select replace(concat_ws('/',replace(repisat,'N/A',''),replace(slot,'N/A',''),puerto),'//','' ) as puerto,
				contacto_bdfo,ubicacion_bdfo,repisa_bdfo,id_puerto_fisico  from inventario_puertos_demarcadores 
				where clli_adva='$clli_adva'  and (nombre_oficial_pisa='$nom2' or nombre_oficial_pisa='$nombre_oficial_pisa') and tipo_servicio='WIMAX'  
				and uso_puerto='TX'	order by length(puerto),puerto";
				$resPtoDemR=mysql_query($queryPtoDemR);
				$numPtoDemR=mysql_num_rows($resPtoDemR);
				$rowPtoDemR=mysql_fetch_row($resPtoDemR);
				
			if($numPtoDemR==0)
			{ 		
					$queryPtoDem="select replace(concat_ws('/',replace(repisat,'N/A',''),replace(slot,'N/A',''),puerto),'//','' ) as puerto,
					contacto_bdfo,ubicacion_bdfo,repisa_bdfo,id_puerto_fisico  from inventario_puertos_demarcadores 
					where clli_adva='$clli_adva'  and estatus='DISPONIBLE'   order by length(puerto),puerto";
					$resPtoDem=mysql_query($queryPtoDem);
					$numPtoDem=mysql_num_rows($resPtoDem);
			?>
                    <select name='puerto_dem' onchange='submit()'><option value=''></option> 
                    <?	while ($rowPtoDem = mysql_fetch_array($resPtoDem))
                        { 
                           if($puerto_dem==$rowPtoDem[0]) 
                           {
                               $sele_01="selected";
                               $contacto_dem	=$rowPtoDem[1];	
                               $ubicacion_dem	=$rowPtoDem[2];	
                               $repisa_dem		=$rowPtoDem[3];	
                               $id_puerto_dem	=$rowPtoDem[4];
							   $most2="";
                           }
                           else 						  $sele_01="";
                           echo "<option $sele_01 value='".$rowPtoDem[0]."'>".$rowPtoDem[0]." </option>";
                        }  ?>
                    </select>	
            <? }else{      
					$puerto_dem			=$rowPtoDemR[0];	
					$contacto_dem		=$rowPtoDemR[1];	
                    $ubicacion_dem		=$rowPtoDemR[2];	
                    $repisa_dem			=$rowPtoDemR[3];	
                    $id_puerto_dem		=$rowPtoDemR[4];
  				    $most2="disabled";
	        ?>		
					<input type="text" name="puerto_dem" value="<?=$puerto_dem?>" readonly="readonly" size="30"/>			

			 <? }?>
            </td>
      </tr>
      <tr>
      		<td>Contacto Bdfo </td>
            <td><input type="text" name="contacto_dem" value="<?=$contacto_dem?>" readonly="readonly" size="30"/></td>
      </tr>
      <tr>
      		<td>Ubicacion Bdfo </td>
            <td><input type="text" name="ubicacion_dem" value="<?=$ubicacion_dem?>" readonly="readonly" size="30"/></td>
      </tr>
      <tr>
      		<td>Repisa Bdfo </td>
            <td><input type="text" name="repisa_dem" value="<?=$repisa_dem?>" readonly="readonly" size="30"/></td>
      </tr>
      <tr>
      		<td>Id Puerto Fisico </td>
            <td colspan="3"><input type="text" name="id_puerto_dem" value="<?=$id_puerto_dem?>" readonly="readonly" size="70"/></td>
      </tr>
      <? if($perfil!="Consulta" and $perfil!="IP Explotacion Corporativa Instalaciones"){?>
		  <? if($num_clli>0) {?>
          <tr>
                <td colspan="4" align="center"><input type="button" value="Reserva de puerto Convertidor"  class="Estilo58" <? echo $most2;?>
                onclick="document.alta_demarcador.reservaDemarcador.value=1;document.alta_demarcador.submit();" /></td>
          </tr> 
           <? }?>
       <? }?>
       
       
       <tr bgcolor="#999999"><td colspan="4" height="4"></td></tr>    
      <tr><td colspan="4">&nbsp;</td></tr>
      <tr class="tituloRojo1"><td colspan="4">Puerto Convertidor - Wimax</td></tr>
      <tr>
      		<td>Puerto Transporte</td>
            <td>   
            <? 	
				$nom2=$clli_adva."_WIMAX";	
				$queryPtoDemR2="select replace(concat_ws('/',replace(repisat,'N/A',''),replace(slot,'N/A',''),puerto),'//','' ) as puerto,
				contacto_bdfo,ubicacion_bdfo,repisa_bdfo,id_puerto_fisico  from inventario_puertos_demarcadores 
				where clli_adva='$clli_adva'  and (nombre_oficial_pisa='$nom2' or nombre_oficial_pisa='$nombre_oficial_pisa') and tipo_servicio='WIMAX'  
				and uso_puerto='CLIENTE'  order by length(puerto),puerto";
				$resPtoDemR2=mysql_query($queryPtoDemR2);
				$numPtoDemR2=mysql_num_rows($resPtoDemR2);
				$rowPtoDemR2=mysql_fetch_row($resPtoDemR2);
				
			if($numPtoDemR2==0)
			{ 		
					$queryPtoDem2="select replace(concat_ws('/',replace(repisat,'N/A',''),replace(slot,'N/A',''),puerto),'//','' ) as puerto,
					contacto_bdfo,ubicacion_bdfo,repisa_bdfo,id_puerto_fisico  from inventario_puertos_demarcadores 
					where clli_adva='$clli_adva'  and estatus='DISPONIBLE'   order by length(puerto),puerto";
					$resPtoDem2=mysql_query($queryPtoDem2);
					$numPtoDem2=mysql_num_rows($resPtoDem2);
			?>
                    <select name='puerto_dem2' onchange='submit()'><option value=''></option> 
                    <?	while ($rowPtoDem2 = mysql_fetch_array($resPtoDem2))
                        { 
                           if($puerto_dem2==$rowPtoDem2[0]) 
                           {
                               $sele_01="selected";
                               $contacto_dem2	=$rowPtoDem2[1];	
                               $ubicacion_dem2	=$rowPtoDem2[2];	
                               $repisa_dem2		=$rowPtoDem2[3];	
							   $most3="";
                           }
                           else 						  $sele_01="";
                           echo "<option $sele_01 value='".$rowPtoDem2[0]."'>".$rowPtoDem2[0]." </option>";
                        }  ?>
                    </select>	
            <? }else{      
					$puerto_dem2		=$rowPtoDemR2[0];	
					$contacto_dem2		=$rowPtoDemR2[1];	
                    $ubicacion_dem2		=$rowPtoDemR2[2];	
                    $repisa_dem2		=$rowPtoDemR2[3];	
  				    $most3="disabled";
	        ?>		
					<input type="text" name="puerto_dem2" value="<?=$puerto_dem2?>" readonly="readonly" size="30"/>			

			 <? }?>
            </td>
      </tr>
      <tr>
      		<td>Contacto Bdfo </td>
            <td><input type="text" name="contacto_dem2" value="<?=$contacto_dem2?>" readonly="readonly" size="30"/></td>
      </tr>
      <tr>
      		<td>Ubicacion Bdfo </td>
            <td><input type="text" name="ubicacion_dem2" value="<?=$ubicacion_dem2?>" readonly="readonly" size="30"/></td>
      </tr>
      <tr>
      		<td>Repisa Bdfo </td>
            <td><input type="text" name="repisa_dem2" value="<?=$repisa_dem2?>" readonly="readonly" size="30"/></td>
      </tr>
      <? if($perfil!="Consulta" and $perfil!="IP Explotacion Corporativa Instalaciones"){?>
		  <? if($num_clli>0) {?>
          <tr>
                <td colspan="4" align="center"><input type="button" value="Reserva de puerto Convertidor"  class="Estilo58" <? echo $most3;?>
                onclick="document.alta_demarcador.reservaDemarcador2.value=1;document.alta_demarcador.submit();" /></td>
          </tr> 
           <? }?>
	   <? }?>
	 </table>
   
<? }?> 
<!------------------------------------------------- TRANSPORTE CUANDO SEA POR TUNEL 			--------------------------------------------->     
<?	if ($conexion_rcdt=="POR TUNEL" and $num_clli!=0){?>
<table class="tbGeneral">
	<tr class="tituloRojo1">
    	<td colspan="4">Informacion del Puerto del Servicio</td>
    </tr>
    <?
		if($tipo_equipo<>"1521 CLIP")
		{
			if($aplica_tarjeta=="SI")	{$comquery=" and (uso_puerto='SERVICIO' or uso_puerto='')";}
			else						{$comquery="and puerto like '%LAN%'";}
		}else
		{$comquery="and puerto like 'Ethernet 10/100 Mbps Base TX%'"; }
        
		$queryPtoServ="select replace(concat_ws('/',replace(repisat,'N/A',''),replace(slot,'N/A',''),puerto),'//','' ) as puerto,
		tipo_puerto,nombre_oficial_pisa,contacto_bdfo,ubicacion_bdfo,repisa_bdfo,criticidad
        from inventario_puertos_demarcadores where clli_adva='$clli_adva' $comquery order by length(puerto),puerto";
		$resPtoServ=mysql_query($queryPtoServ);
        $numPtoServ=mysql_num_rows($resPtoServ);
	?>
    <tr>
    	<td>Puerto del Servicio</td>
        <td><select  name='pto_clt_serv' onchange="submit();"><option value=''>Selecciona Puerto ---></option>
        <?         
		for($i=0;$i<$numPtoServ;$i++)
        {
		    $rowPtoServ=mysql_fetch_row($resPtoServ);
            if($pto_clt_serv==$rowPtoServ[0])
            {
				$selepto		="selected";
				$tipoPuertoServ	=$rowPtoServ[1];
				$refSisaPto1	=$rowPtoServ[2];
				$contactoServ	=$rowPtoServ[3];
				$ubicacionServ	=$rowPtoServ[4];
				$repisaServ		=$rowPtoServ[5];	
				$criticidad		=$rowPtoServ[6];
			}
            else 
            {
				$selepto		="";
			}
            echo "<option $selepto value='".$rowPtoServ[0]."'>".$rowPtoServ[0]."</option>";
		 	if($refSisaPto1!="") 	{$btoRef="disabled";$inpRef="readOnly";}
			else				 	{$btoRef="";$inpRef="";}
        }?></select></td>
    </tr>
    
    <tr>
    	<td><strong>Ref Sisa (Servicio)</strong></td>
        <td colspan="3"><input type="text" size="30" name="refSisaPto" value="<?=$refSisaPto1?>" <?=$inpRef?>/></td>
    </tr>
    <?
			if($criticidad=="3" or $criticidad=="3C" or $criticidad=="3B" or $criticidad=="C3") 	{$aplicaRespaldo="SI";$sec="visibility:visible";}
			elseif(($criticidad=="4" or $criticidad=="") and $clase_servicio=="NEXTEL") 			{$aplicaRespaldo="SI";$sec="visibility:visible";}
			elseif(($criticidad=="4" or $criticidad=="") and $clase_servicio=="CD SEGURA" and $tipo_equipo<>'FSP 150CC GE112') 	
																									{$aplicaRespaldo="SI";$sec="visibility:visible";}
			elseif(($criticidad=="4" or $criticidad=="") and $clase_servicio=="CD SEGURA" and $tipo_equipo=='FSP 150CC GE112') 	
																									{$aplicaRespaldo="NO";$sec="visibility:hidden";}			
			elseif($criticidad=="4" and $clase_servicio<>"NEXTEL") 									{$aplicaRespaldo="NO";$sec="visibility:hidden";}
			elseif($criticidad=="2") 																{$aplicaRespaldo="NO";$sec="visibility:hidden";}
			elseif($criticidad=="")																	{$aplicaRespaldo="NO";$sec="visibility:hidden";}
	?>            
    <tr>
    	<td>Criticidad</td>
        <td><input type="text" size="15" name="criticidad" value="<?=$criticidad?>" readonly class="fondoGris"/></td>
    	<td>Aplica Respaldo</td>
        <td><input type="text" size="15" name="aplicaRespaldo" value="<?=$aplicaRespaldo?>" readonly class="fondoGris"/></td>
    </tr>
	<tr>  
        <td>Tipo Puerto</td>
        <td><input name='tipoPuertoServ' type="text" size="30" id='tipoPuertoServ' value="<?=$tipoPuertoServ?>" readonly class="fondoGris"/></td>
    	<td>Ubicacion Bdfo</td>
        <td><input name='ubicacionServ' type='text' size='30' id='ubicacionServ'  value='<?=$ubicacionServ?>' readonly class="fondoGris"/></td>
    </tr>
    <tr>
        <td>Repisa Bdfo</td>
        <td><input name='repisaServ' type='text' size='30'    id='repisaServ'  value='<?=$repisaServ?>' readonly class="fondoGris"/></td>
        <td>Contacto Bdfo</td>
        <td><input name='contactoServ' type='text' size='30' id='contactoServ'  value='<?=$contactoServ?>' readonly class="fondoGris"/></td>
    </tr>
    <? if($num_clli>0){ ?>
    <tr>
        <td colspan="4" align="center">
        <input type="button" value="Reserva Puerto Servicio" onclick="document.alta_demarcador.reservaServicio.value=1;submit();" class="Estilo57"
        <?=$btoRef?>/></td>
    </tr>
    <? }?>    
</table><br />



<? if($refSisaPto1!=""){
	$queryExist="select * from inventario_demarcadores where clli_adva='$clli_adva'";
	$resExist=mysql_query($queryExist);
	$rowExist=mysql_fetch_array($resExist);		
	
	$queryPtoExist	="select * from inventario_puertos_demarcadores where clli_adva='$tunel' and nombre_oficial_pisa='$clli_adva'";
	$resPtoExist	=mysql_query($queryPtoExist);
	$numPtoExist	=mysql_num_rows($resPtoExist);
	
	if($clase_servicio=="CD SEGURA")
	{
		$qServ="select * from ciudad_segura where ref_sisa='$refSisaPto1'";
		$rServ=mysql_query($qServ);
		$rServ=mysql_fetch_array($rServ);	
		$tunel=$rServ['ndeCamara'];
		$actCamp="readOnly";
		if($rServ['ndeCamara']==""){$leyendaNde="ESTE SERVICIO NO TIENE EQUIPO NDE ASIGNADO";}
		
	}else
	{
		if($numPtoExist!=0)		{$actCamp="readOnly";}	
		else					{$actCamp="";}					
	}
?>
<table id="tbGeneral2">
	<tr class="tituloRojo1"><td colspan="4">Informacion del Equipo NDE/N</td></tr>
	<tr>
		<td><strong>Clli Demarcador a Conectar</strong></td>
		<td><input name="tunel" type="text" id="tunel" title="Por Tunel a: (Demarcador conexion a RCDT)"  value="<?=$tunel?>" size="30" 
             onblur="this.value=this.value.toUpperCase();submit();" onkeyup="this.value=this.value.toUpperCase()" <?=$actCamp?>/></td>
	</tr>
	<!----------------------------------------------- INFORMACION DEL EQUIPO DEMARCADOR TX 		--------------------------------------------->
 	<? 
			$query_nde="select ubicacion_demarcador,ip_demarcador,ot_instalacion_demarcador,tipo_demarcador,tipo_equipo,proveedor,gestionada,vlan_gestion,
			clase_servicio,central  from inventario_demarcadores where clli_adva='$tunel'";
			//echo $query_nde;			
            $res_nde=mysql_query($query_nde);
            $row_nde=mysql_fetch_row($res_nde);	
                
            $ubicacion_demarcador2					=$row_nde[0];	
            $ip_demarcador2							=$row_nde[1];	
            $ot_instalacion_demarcador2				=$row_nde[2];	
            $tipo_demarcador2						=$row_nde[3];	
            $tipo_equipo2							=$row_nde[4];	
            $proveedor2								=$row_nde[5];	
            $gestNde2								=$row_nde[6];	
            $vlan2									=$row_nde[7];	
			$clase_servicio2						=$row_nde[8];
			$central2								=$row_nde[9];
                
            $queryDat="select modelo_corto,aplica_tarjetas from cat_equipo where formato='ADVA' and tipo_equipo='".$tipo_equipo2."' group by tipo_equipo";
            $resDat=mysql_query($queryDat);
            $rowDat=mysql_fetch_row($resDat);	
            $modCorto2			=$rowDat[0];		
            $aplica_tarjeta2	=$rowDat[1];
			
			    if($gestNde2!="GESTIONADO" and $gestNde2!="")
				{$leyendaNde="EL EQUIPO NO ESTA GESTIONADO";}
				elseif($clase_servicio2!="CD SEGURA" and $clase_servicio=="CD SEGURA" and $tipo_equipo=="1531 CLAS")
				{$leyendaNde="EL EQUIPO $tipo_equipo2 NO ES PERMITIDO PARA CIUDAD SEGURA"; }
        ?>
	<tr>
		<td>Ubicacion del Demarcador</td>
		<td><input type='text' name='ubicacion_demarcador2' id='ubicacion_demarcador2' value='<?=$ubicacion_demarcador2?>' size='30' maxlength='19' 
		readonly ></td>
		<td>Clase Servicio</td>
		<td><input type='text' name='clase_servicio2' id='clase_servicio2' value='<?=$clase_servicio2?>' size='30' maxlength='19' 
		readonly ></td>        
	</tr>
	<tr>
		<td>IP del Demarcador</td>
		<td><input type='text' name='ip_demarcador2' value='<?=$ip_demarcador2?>' size='30' readonly></td>
		<td>OT Instalacion Demarcador</td>
		<td><input type='text' name='ot_instalacion_demarcador2' value='<?=$ot_instalacion_demarcador2?>' size='30' readonly></td>
	</tr>
	<tr>
		<td>Tipo Demarcador</td>
		<td><input type='text' name='tipo_demarcador2' value='<?=$tipo_demarcador2?>' size='30' readonly></td>
		<td>Modelo del Equipo</td>
		<td><input type='text' name='tipo_equipo2' value='<?=$tipo_equipo2?>' size='30' readonly></td>
	</tr>
	<tr>
		<td>Proveedor</td>
		<td><input type='text' name='proveedor2' value='<?=$proveedor2?>'   size='30' readOnly></td>
		<td>Vlan</td>
		<td><input type='text' name='vlan2' value='<?=$vlan2?>'   size='30' readOnly></td>
	</tr>
    <tr>
    	<td>Central</td>
        <td><input type='text' name='central2' value='<?=$central2?>'   size='30' readOnly></td>
    </tr>
    <tr bgcolor="#E5E5E5"><td colspan="4" class="tituloRojo1"><?=$leyendaNde?></td></tr>
    
   	<tr bgcolor="#999999"><td colspan="4" height="4"></td></tr>    
    <? if($tipo_equipo2!="1531 CLAS" and $tipo_equipo2!=""){ ?>
	<tr>
		<td>Puerto Central al Cliente Primario</td>
		<td>
		<?
		$query_ptoCl="select replace(concat_ws('/',replace(repisat,'N/A',''),replace(slot,'N/A',''),puerto),'//','' ) as puerto,
		tipo_puerto,contacto_bdfo,ubicacion_bdfo,repisa_bdfo
		from inventario_puertos_demarcadores where nombre_oficial_pisa='$clli_adva' and nombre_oficial_pisa!='' and clli_adva='$tunel' 
		and (uso_puerto='CLIENTE' or uso_puerto='CLIENTE-PRIMARIO') order by length(puerto),puerto";
		$res_ptoCl=mysql_query($query_ptoCl);
		$row_ptoCl=mysql_fetch_row($res_ptoCl);
		$num_ptoCl=mysql_num_rows($res_ptoCl);
                
		if($num_ptoCl!=0)
			{
               echo "<input type='text' size='30' name='puertoRx' value='".$row_ptoCl[0]."' readonly>";	
			   $tipoPuertoCliente				=$row_ptoCl[1];
			   $contactoCliente					=$row_ptoCl[2];
			   $ubicacionCliente				=$row_ptoCl[3];
			   $repisaCliente					=$row_ptoCl[4];	
			   $bton="disabled";		
			}
		else 
            { 
			   echo "<select  name='puertoRx' onchange='submit();'><option value=''></option>";

               $query_ptoreqA="select  replace(concat_ws('/',replace(repisat,'N/A',''),replace(slot,'N/A',''),puerto),'//','' ) as puerto,
			   tipo_puerto,contacto_bdfo,ubicacion_bdfo,repisa_bdfo,ref_sisa from inventario_puertos_demarcadores 
			   where clli_adva='$tunel' and (estatus='DISPONIBLE' or (estatus='RESERVADO' and ref_sisa!=''))  and nombre_oficial_pisa=''
               order by length(puerto),puerto";
               //echo $query_ptoreqA;
               $res_ptoreqA= mysql_query($query_ptoreqA);
               $num_ptoreqA=mysql_num_rows($res_ptoreqA);
                        
                   if($num_ptoreqA>0)
                     {
						 $bton="";
						 for($i=0;$i<$num_ptoreqA;$i++)
                            {
						      $row_ptoCl=mysql_fetch_row($res_ptoreqA);
                              if($puertoRx==$row_ptoCl[0])
                                {
								  $selepto="selected";
								  $tipoPuertoCliente				=$row_ptoCl[1];
								  $contactoCliente					=$row_ptoCl[2];
								  $ubicacionCliente					=$row_ptoCl[3];
								  $repisaCliente					=$row_ptoCl[4];			
								}
                               else 
                                {$selepto="";}
							   if($row_ptoCl[5]!="") $ptoCliente=$row_ptoCl[0]."***".$row_ptoCl[5];
							   else					 $ptoCliente=$row_ptoCl[0];
								   
                               echo "<option $selepto value='".$row_ptoCl[0]."'>".$ptoCliente."</option>";
                        	 }
                       }
					echo "</select>";
                 }?></td>
		<td style=" <?=$sec?>">Puerto Central al Cliente Secundario</td>
		<td style=" <?=$sec?>">
		<?
		$query_ptoCl2="select replace(concat_ws('/',replace(repisat,'N/A',''),replace(slot,'N/A',''),puerto),'//','' ) as puerto,
		tipo_puerto,contacto_bdfo,ubicacion_bdfo,repisa_bdfo
		from inventario_puertos_demarcadores where nombre_oficial_pisa='$clli_adva' and nombre_oficial_pisa!='' and clli_adva='$tunel' 
		and uso_puerto='CLIENTE-SECUNDARIO' order by length(puerto),puerto";
		$res_ptoCl2=mysql_query($query_ptoCl2);
		$row_ptoCl2=mysql_fetch_row($res_ptoCl2);
		$num_ptoCl2=mysql_num_rows($res_ptoCl2);
                
		if($num_ptoCl2!=0)
		{
            echo "<input type='text' size='30' name='puertoRxSec' value='".$row_ptoCl2[0]."' readonly>";	
		    $tipoPuertoClienteSec				=$row_ptoCl2[1];
		    $contactoClienteSec					=$row_ptoCl2[2];
			$ubicacionClienteSec					=$row_ptoCl2[3];
			$repisaClienteSec					=$row_ptoCl2[4];	
			$bton2="disabled";		
		}
		else 
		{ 
			echo "<select  name='puertoRxSec' onchange='submit();'>";

            $query_ptoreqA2="select  replace(concat_ws('/',replace(repisat,'N/A',''),replace(slot,'N/A',''),puerto),'//','' ) as puerto,
			tipo_puerto,contacto_bdfo,ubicacion_bdfo,repisa_bdfo,ref_sisa 
			from inventario_puertos_demarcadores 
			where clli_adva='$tunel' and (estatus='DISPONIBLE' or (estatus='RESERVADO' and ref_sisa!='')) and nombre_oficial_pisa=''
            order by length(puerto),puerto";
			$res_ptoreqA2=mysql_query($query_ptoreqA2);
			$num_ptoreqA2=mysql_num_rows($res_ptoreqA2);
                        
			echo "<option value=''></option>";
			if($num_ptoreqA2>0)
			{
				$bton2="";
				for($i=0;$i<$num_ptoreqA2;$i++)
				{
					 $row_ptoCl2=mysql_fetch_row($res_ptoreqA2);
                     if($puertoRxSec==$row_ptoCl2[0])
                     {
									   $selepto2="selected";
								   	   $tipoPuertoClienteSec				=$row_ptoCl2[1];
									   $contactoClienteSec					=$row_ptoCl2[2];
									   $ubicacionClienteSec					=$row_ptoCl2[3];
									   $repisaClienteSec					=$row_ptoCl2[4];			
								   }
                                   else 
                                   {$selepto2="";}
								   
								   if($row_ptoCl2[5]!="")	$ptoClienteSec=$row_ptoCl2[0]."***".$row_ptoCl2[5];
								   else						$ptoClienteSec=$row_ptoCl2[0];
								   
                                   echo "<option $selepto2 value='".$row_ptoCl2[0]."'>".$ptoClienteSec."</option>";
                        	   }
                       }
					echo "</select>";
               	}?> </td> 
	</tr>
	<tr>
		<td>Tipo Puerto</td>
		<td><input type="text" size="30" value="<?=$tipoPuertoCliente?>" readonly/></td>
		<td style=" <?=$sec?>">Tipo Puerto</td>
		<td style=" <?=$sec?>"><input type="text" size="30" value="<?=$tipoPuertoClienteSec?>" readonly/></td>
	</tr>        
	<tr>
		<td>Contacto BDFO</td>
		<td><input type="text" size="30" value="<?=$contactoCliente?>" readonly/></td>
		<td style=" <?=$sec?>">Contacto BDFO</td>
		<td style=" <?=$sec?>"><input type="text" size="30" value="<?=$contactoClienteSec?>" readonly/></td>
	</tr>
	<tr>
		<td>Ubicacion Bdfo</td>
		<td><input type="text" size="30" value="<?=$ubicacionCliente?>" readonly/></td>
		<td style=" <?=$sec?>">Ubicacion Bdfo</td>
		<td style=" <?=$sec?>"><input type="text" size="30" value="<?=$ubicacionClienteSec?>" readonly/></td>
	</tr>
	<tr>
		<td>Repisa BDFO</td>
		<td><input type="text" size="30" value="<?=$repisaCliente?>" readonly/></td>
		<td style=" <?=$sec?>">Repisa BDFO</td>
		<td style=" <?=$sec?>"><input type="text" size="30" value="<?=$repisaClienteSec?>" readonly/></td>
	</tr>
	<tr>
		<td colspan="2" align="center">
		<input type="button" value="Reserva Puerto Primario" onclick="document.alta_demarcador.reservaCliente.value=1;submit();" class="Estilo57"
		<?=$bton?>/></td>
		<td colspan="2" align="center" style=" <?=$sec?>">
		<input type="button" value="Reserva Puerto Secundario" onclick="document.alta_demarcador.reservaCliente2.value=1;submit();" 
		class="Estilo57" <?=$bton2?>/></td>
	</tr>
    <? }elseif($tipo_equipo2=="1531 CLAS" and $clase_servicio=="CD SEGURA" and $clase_servicio2=="CD SEGURA"){?>
	<tr>
		<td>Pares Central al Cliente (Disponibles)</td>
		<td>
		<?
		$query_ptoCl="select puerto,slot,repisat from inventario_puertos_demarcadores where clli_adva='$tunel' and estatus='DISPONIBLE' 
 		and puerto!='Universal I/O slot Port 1 (WAN)' order by length(puerto),puerto";
		$res_ptoCl= mysql_query($query_ptoCl);
		if ($row = mysql_fetch_array($res_ptoCl)){ ?>
		<select multiple="multiple" name="puertosRx[]" id="puertoRx" size="4" style="width:200px;">
        	<? do { echo '<option value= "'.$row["puerto"].'">'.$row["puerto"].'</option>';
                  } while ($row = mysql_fetch_array($res_ptoCl)); ?>
        </select><? }?></td>
		<td>Pares Central al Cliente (Reservados)</td>
		<td>
		<? 
		$query_conex="select puerto from inventario_puertos_demarcadores where nombre_oficial_pisa='$clli_adva' 
 		and nombre_oficial_pisa!='' and clli_adva='$tunel' and uso_puerto='CLIENTE' order by length(puerto),puerto";
		$res_conex=mysql_query($query_conex);
		$num_conex=mysql_num_rows($res_conex);
		for($i=0;$i<$num_conex;$i++)
            {
             $row_conex=mysql_fetch_row($res_conex);
             echo "<input type='text' name='puertoRx[]' value='".$row_conex[0]."' size=30 readonly><br>";
			}?></td>
	</tr>
    <tr>
        <td colspan="4" align="center">
        <input type="button" value="Reserva Pares" onclick="document.alta_demarcador.reservaCliente.value=1;submit();" class="Estilo57" <?=$hab?>/></td>
    </tr>
    <? }elseif($tipo_equipo2=="1531 CLAS" and $clase_servicio!="CD SEGURA" and $clase_servicio2!="CD SEGURA"){?>
	<tr>
		<td>Pares Central al Cliente (Disponibles)</td>
		<td>
		<?
		$query_ptoCl="select puerto,slot,repisat from inventario_puertos_demarcadores where clli_adva='$tunel' and estatus='DISPONIBLE' 
 		and puerto!='Universal I/O slot Port 1 (WAN)' order by length(puerto),puerto";
		$res_ptoCl= mysql_query($query_ptoCl);
		if ($row = mysql_fetch_array($res_ptoCl)){ ?>
		<select multiple="multiple" name="puertosRx[]" id="puertoRx" size="4" style="width:200px;">
        	<? do { echo '<option value= "'.$row["puerto"].'">'.$row["puerto"].'</option>';
                  } while ($row = mysql_fetch_array($res_ptoCl)); ?>
        </select><? }?></td>
		<td>Pares Central al Cliente (Reservados)</td>
		<td>
		<? 
		$query_conex="select puerto from inventario_puertos_demarcadores where nombre_oficial_pisa='$clli_adva' 
 		and nombre_oficial_pisa!='' and clli_adva='$tunel' and uso_puerto='CLIENTE' order by length(puerto),puerto";
		$res_conex=mysql_query($query_conex);
		$num_conex=mysql_num_rows($res_conex);
		for($i=0;$i<$num_conex;$i++)
            {
             $row_conex=mysql_fetch_row($res_conex);
             echo "<input type='text' name='puertoRx[]' value='".$row_conex[0]."' size=30 readonly><br>";
			}?></td>
	</tr>
    <tr>
        <td colspan="4" align="center">
        <input type="button" value="Reserva Pares" onclick="document.alta_demarcador.reservaCliente.value=1;submit();" class="Estilo57" <?=$hab?>/></td>
    </tr>
    <? }?>
</table>
<br />
<table class="tbGeneral">
	<? if($tipo_equipo!="1521 CLIP"){?>
    <tr class="tituloRojo1">
      <td colspan="4">Informacion del Equipo DDE/N</td></tr>
    <tr>
        <td>Puerto Cliente a la Central Primario</td>
        <td><?
                    $query_pto_advaA="select replace(concat_ws('/',replace(repisat,'N/A',''),replace(slot,'N/A',''),puerto),'//','' ) as puerto,
					tipo_puerto,contacto_bdfo,ubicacion_bdfo,repisa_bdfo 
					from inventario_puertos_demarcadores where nombre_oficial_pisa='$tunel' 
                    and nombre_oficial_pisa!=''  and clli_adva='$clli_adva' and (uso_puerto='TX' or uso_puerto='TX-PRIMARIO' )
					order by length(puerto),puerto";
                    //echo $query_pto_advaA;
                    $res_pto_advaA=mysql_query($query_pto_advaA);
                    $row_pto_advaA=mysql_fetch_row($res_pto_advaA);
                    $num_pto_advaA=mysql_num_rows($res_pto_advaA);
                    
                    if($num_pto_advaA!=0)
                    {
                        echo "<input type='text' size='30' name='puerto_trans' value='".$row_pto_advaA[0]."' readonly>";
								   $tipoPuertoTx			=$row_pto_advaA[1];
								   $contactoTx				=$row_pto_advaA[2];
								   $ubicacionTx				=$row_pto_advaA[3];
								   $repisaTx				=$row_pto_advaA[4];
								   $bton2="disabled";
                    }else
					{             
					   echo "<select  name='puerto_trans' onchange='submit();'><option value=''></option>";
                       $query_ptoreqA="select replace(concat_ws('/',replace(repisat,'N/A',''),replace(slot,'N/A',''),puerto),'//','' ) as puerto,
					   tipo_puerto,contacto_bdfo,ubicacion_bdfo,repisa_bdfo  from inventario_puertos_demarcadores 
   					   where clli_adva='$clli_adva' and estatus='DISPONIBLE' order by length(puerto),puerto";
                       //echo $query_ptoreqA;
                       $res_ptoreqA= mysql_query($query_ptoreqA);
                       $num_ptoreqA=mysql_num_rows($res_ptoreqA);
                            
                       if($num_ptoreqA>0)
                         {
						   $bton2="";
                           for($i=0;$i<$num_ptoreqA;$i++)
                              {
							    $row_ptoreqA=mysql_fetch_row($res_ptoreqA);
                                if($puerto_trans==$row_ptoreqA[0])
                                  {
									   $selepto="selected";
									   $tipoPuertoTx			=$row_ptoreqA[1];
									   $contactoTx				=$row_ptoreqA[2];
									   $ubicacionTx				=$row_ptoreqA[3];
									   $repisaTx				=$row_ptoreqA[4];
								   }
                                else 
                                   {$selepto="";}
                                echo "<option $selepto value='".$row_ptoreqA[0]."'>".$row_ptoreqA[0]."</option>";
                            
                               }
                         }
						echo "</select>";
                    }
             ?>
            </td>
            <td style=" <?=$sec?>">Puerto Cliente a la Central Secundario</td>
            <td style=" <?=$sec?>">
				<?
                    $query_pto_advaA2="select replace(concat_ws('/',replace(repisat,'N/A',''),replace(slot,'N/A',''),puerto),'//','' ) as puerto,
					tipo_puerto,contacto_bdfo,ubicacion_bdfo,repisa_bdfo 
					from inventario_puertos_demarcadores where nombre_oficial_pisa='$tunel' 
                    and nombre_oficial_pisa!=''  and clli_adva='$clli_adva' and uso_puerto='TX-SECUNDARIO' order by length(puerto),puerto";
                    //echo $query_pto_advaA2;
                    $res_pto_advaA2=mysql_query($query_pto_advaA2);
                    $row_pto_advaA2=mysql_fetch_row($res_pto_advaA2);
                    $num_pto_advaA2=mysql_num_rows($res_pto_advaA2);
                    
                    if($num_pto_advaA2!=0)
                    {
                        echo "<input type='text' size='30' name='puerto_trans2' value='".$row_pto_advaA2[0]."' readonly>";
								   $tipoPuertoTx2			=$row_pto_advaA2[1];
								   $contactoTx2				=$row_pto_advaA2[2];
								   $ubicacionTx2			=$row_pto_advaA2[3];
								   $repisaTx2				=$row_pto_advaA2[4];
								   $bton3="disabled";
                    }else
					{             
					
						echo "<select  name='puerto_trans2' onchange='submit();'><option value=''></option>";

                            $query_ptoreqA2="select replace(concat_ws('/',replace(repisat,'N/A',''),replace(slot,'N/A',''),puerto),'//','' ) as puerto,
							tipo_puerto,contacto_bdfo,ubicacion_bdfo,repisa_bdfo  
							from inventario_puertos_demarcadores 
							where clli_adva='$clli_adva' and estatus='DISPONIBLE'
                            order by length(puerto),puerto";
                            //echo $query_ptoreqA2;
                            $res_ptoreqA2= mysql_query($query_ptoreqA2);
                            $num_ptoreqA2=mysql_num_rows($res_ptoreqA2);
                            
                            if($num_ptoreqA2>0)
                               {
									$bton3="";
                                    for($i=0;$i<$num_ptoreqA2;$i++)
                                    {
									   $row_ptoreqA2=mysql_fetch_row($res_ptoreqA2);
                                       if($puerto_trans2==$row_ptoreqA2[0])
                                       {
										   $selepto="selected";
									   	   $tipoPuertoTx2				=$row_ptoreqA2[1];
										   $contactoTx2					=$row_ptoreqA2[2];
										   $ubicacionTx2				=$row_ptoreqA2[3];
										   $repisaTx2					=$row_ptoreqA2[4];
									   }
                                       else 
                                       {$selepto="";}
                                       echo "<option $selepto value='".$row_ptoreqA2[0]."'>".$row_ptoreqA2[0]."</option>";
                                    }
                                }
						echo "</select>";
                    }
             ?>
            </td>            
	</tr> 
    <tr>
        <td>Tipo Puerto</td>
        <td><input type="text" size="30" value="<?=$tipoPuertoTx?>" readonly/></td>
        <td style=" <?=$sec?>">Tipo Puerto</td>
        <td style=" <?=$sec?>"><input type="text" size="30" value="<?=$tipoPuertoTx2?>" readonly/></td>
	</tr>	
	<tr>  
        <td>Contacto Bdfo</td>
        <td><input name='contacto_bdfo' type='text' size='30' id='Contacto Bdfo'  value='<?=$contactoTx?>' readonly /> </td>
		<td style=" <?=$sec?>">Contacto Bdfo</td>
		<td style=" <?=$sec?>"><input name='contacto_bdfo' type='text' size='30' id='Contacto Bdfo'  value='<?=$contactoTx2?>' readonly /> </td>
   	</tr>
	<tr>
        <td>Ubicacion Bdfo</td>
        <td><input name='ubicacion_bdfo' type='text' size='30' id='Ubicacion Bdfo'  value='<?=$ubicacionTx?>' readonly /> </td>
		<td style=" <?=$sec?>">Ubicacion Bdfo</td>
		<td style=" <?=$sec?>"><input name='ubicacion_bdfo' type='text' size='30' id='Ubicacion Bdfo'  value='<?=$ubicacionTx2?>' readonly /> </td>
	</tr>
	<tr>
        <td>Repisa Bdfo</td>
        <td><input name='repisa_bdfo' type='text' size='30'    id='Repisa Bdfo'  value='<?=$repisaTx?>' readonly /> </td>
        <td style=" <?=$sec?>">Repisa Bdfo</td>
        <td style=" <?=$sec?>"><input name='repisa_bdfo' type='text' size='30'    id='Repisa Bdfo'  value='<?=$repisaTx2?>' readonly /> </td>
	</tr>
	<? if($rowExist['tunel']!=""){ ?>
    <tr>
        <td colspan="2" align="center">
        <input type="button" value="Reserva Puerto Primario" onclick="document.alta_demarcador.reservatx.value=1;submit();" class="Estilo57" <?=$bton2?>/></td>
        <td colspan="2" align="center" style=" <?=$sec?>">
        <input type="button" value="Reserva Puerto Secundario" onclick="document.alta_demarcador.reservatx2.value=1;submit();" class="Estilo57" <?=$bton3?>/>
        </td>
	</tr><? }?>
	<? }elseif($clase_servicio=="CD SEGURA" and $clase_servicio2=="CD SEGURA" and $tipo_equipo=="1521 CLIP"){?>
    <tr>
		<td>Pares Cliente a la Central (Disponibles)</td>
		<td>
		<? $query_ptotx="select puerto from inventario_puertos_demarcadores where clli_adva='$clli_adva' and estatus='DISPONIBLE'  
		and puerto not like 'Ethernet 10/100 Mbps Base TX%' order by length(puerto),puerto";
        $res_ptotx= mysql_query($query_ptotx);
        
		if ($row = mysql_fetch_array($res_ptotx))
        { ?>
          <select multiple="multiple" name="puertotrans[]" id="puerto_trans" size="4" style="width:220px;">
          <? do { 
                 echo '<option value= "'.$row["puerto"].'">'.$row["puerto"].'</option>';
                } while ($row = mysql_fetch_array($res_ptotx)); ?>
          </select><? }?></td>
		<td>Pares Cliente a la Central (Reservados)</td>   
		<td>
		<? 
		$query_conex="select puerto from inventario_puertos_demarcadores where nombre_oficial_pisa='$tunel' 
		and nombre_oficial_pisa!='' and clli_adva='$clli_adva' and uso_puerto='TX' order by length(puerto),puerto";
		$res_conex=mysql_query($query_conex);
		$num_conex=mysql_num_rows($res_conex);
		for($i=0;$i<$num_conex;$i++)
		{
			$row_conex=mysql_fetch_row($res_conex);
			echo "<input type='text' name='puerto_trans[]' value='".$row_conex[0]."' size=30 readonly><br>";
		}?></td>
	</tr>   
	<? if($rowExist['tunel']!=""){ ?>
    <tr>
		<td colspan="4" align="center">
        <input type="button" value="Reserva Pares" onclick="document.alta_demarcador.reservatx.value=1;submit();" class="Estilo57" <?=$hab?>/></td>
	</tr><? }?>      
	<? }elseif($clase_servicio!="CD SEGURA" and $clase_servicio2!="CD SEGURA" and $tipo_equipo=="1521 CLIP"){?>
    <tr>
		<td>Pares Cliente a la Central (Disponibles)</td>
		<td>
		<? $query_ptotx="select puerto from inventario_puertos_demarcadores where clli_adva='$clli_adva' and estatus='DISPONIBLE'  
		and puerto not like 'Ethernet 10/100 Mbps Base TX%' order by length(puerto),puerto";
        $res_ptotx= mysql_query($query_ptotx);
        
		if ($row = mysql_fetch_array($res_ptotx))
        { ?>
          <select multiple="multiple" name="puertotrans[]" id="puerto_trans" size="4" style="width:220px;">
          <? do { 
                 echo '<option value= "'.$row["puerto"].'">'.$row["puerto"].'</option>';
                } while ($row = mysql_fetch_array($res_ptotx)); ?>
          </select><? }?></td>
		<td>Pares Cliente a la Central (Reservados)</td>   
		<td>
		<? 
		$query_conex="select puerto from inventario_puertos_demarcadores where nombre_oficial_pisa='$tunel' 
		and nombre_oficial_pisa!='' and clli_adva='$clli_adva' and uso_puerto='TX' order by length(puerto),puerto";
		$res_conex=mysql_query($query_conex);
		$num_conex=mysql_num_rows($res_conex);
		for($i=0;$i<$num_conex;$i++)
		{
			$row_conex=mysql_fetch_row($res_conex);
			echo "<input type='text' name='puerto_trans[]' value='".$row_conex[0]."' size=30 readonly><br>";
		}?></td>
	</tr>   
	<? if($rowExist['tunel']!=""){ ?>
    <tr>
		<td colspan="4" align="center">
        <input type="button" value="Reserva Pares" onclick="document.alta_demarcador.reservatx.value=1;submit();" class="Estilo57" <?=$hab?>/></td>
	</tr><? }?>     
    <? }?>
</table>        
<? }?>    

<? }?> 
</div>
<!----------------------------------------------------------- COMINENZA EQUIPAMIENTO  ------------------------------------------------------------->
<div>
<a name="equ_dem2" id="equ_dem2"></a>
<!----------------------------------------------------------- COMINENZA TABLA DE TARJETAS  -------------------------------------------------------->
<? if ($aplica_tarjeta=='SI') {?>
    <table id='tbGeneral'>
		<tr class="tituloRojo1">
            	<td colspan="4">Alta de Tarjetas</td>
        </tr>
		<tr>
                <td>Repisa</td>
                <td>Modelo Tarjeta</td>
                <td>Slot</td>
                <td>Controles</td>
        </tr>
		<tr>
                <td><select name='repisat'><option value=''></option>
                <?	$a=array("01","02","03","04","05","06","07");
                    for($i=0;$i<count($a);$i++)
                    {
                        if($repisat==$a[$i])	{ $sele_repisat="selected";}
                        else 					{$sele_repisat="";}
                        echo "<option $sele_repisat value='$a[$i]'>".$a[$i]."</option>";
                    }?>
                    </select></td>
                <td>
                <?	$query_modtj="select tipo_tarjeta from cat_puertos_ce where tipo_equipo='$tipo_equipo' and tipo_tarjeta!=''  
                    group by tipo_tarjeta order by tipo_tarjeta ASC";
                    //echo $query_modtj;
                    $res_modtj = mysql_query($query_modtj);		
                    if ($row = mysql_fetch_array($res_modtj))
                    { ?>
                      <select name='modelo_tarjeta' onchange='submit()'><option value=''></option>
                    <?	do { 
                            if($modelo_tarjeta==$row["tipo_tarjeta"]) $sele_modtj="selected";
                            else 									  $sele_modtj="";
                            echo "<option $sele_modtj value= '".$row["tipo_tarjeta"]."'>".$row["tipo_tarjeta"]." </option>";
                            } while ($row = mysql_fetch_array($res_modtj)); ?>
                        </select>			
                <?	} ?></td>
                <td>
                <?	$query_slot="select slot from cat_tarjetas_ce where equipo='$tipo_equipo' and modelo_tarjeta='$modelo_tarjeta' and slot!=''
                    group by slot order by length(slot),slot";
                    //echo $query_slot;
                    $res_slot = mysql_query($query_slot);	
                    $querytjc="SELECT slot from inventario_tarjetas_demarcadores where clli_adva='$clli_adva'  order by slot";			
                    //echo $querytjc;
                    $tjsl_cargadas=mysql_query($querytjc);	?>									 
                             
                    <select name='slot' onchange='valTj();submit();' id='slot'><option value=''></option>
                    <?	for ($tjc=0;$tjc<mysql_num_rows($tjsl_cargadas);$tjc++)
                        {
                            $matriz=explode("-",mysql_result($tjsl_cargadas,$tjc,0));
                            if(count($matriz)>1)
                                {
                                    $tjslc[]=$matriz[0]."-".$matriz[1];						
                                    $tjslc[]=$matriz[2]."-".$matriz[3];
                                }
                            else
                                {
                                    $tjslc[]=mysql_result($tjsl_cargadas,$tjc,0);
                                }
                                
                        }
                        if ($row = mysql_fetch_array($res_slot))
                        {
                        do { 
                                if($slot==$row["slot"]) $selrep="selected";
                                else 					$selrep="";
                                if(!in_array($row["slot"],$tjslc)) 
                                echo "<option $selrep value= '".$row["slot"]."'>".$row["slot"]."</option>\n";
                            } while ($row = mysql_fetch_array($res_slot)); 
                        }		?>	
                    </select></td>
                 <td><img src='images/add.png' title='AGREGAR NUEVO REGISTRO' onclick="document.alta_demarcador.validTarj.value=1;submit();" 
                 style=" <?=$estilo?>"></td>
	      </tr>
		 <!--------------------------------------------------------- TARJETAS CONFIGURADAS --------------------------------------------------->					
	 	 <tr class="tituloRojo1"><td colspan=5>Tarjetas Configuradas</td></tr>
		<?	$query_tarjetas="select * from inventario_tarjetas_demarcadores where clli_adva='$clli_adva'  order by slot ";
			$res_tarjetas=mysql_query($query_tarjetas);
			$num_tarjetas=mysql_num_rows($res_tarjetas);		
					
			$pto_gestion="SELECT slot,gestionada from inventario_puertos_demarcadores
			where  clli_adva='$clli_adva' and  (gestionada='GESTIONADO' or estatus='RESERVADO' or estatus='OCUPADO')";
			$res_gestion=mysql_query($pto_gestion);
			$num_gestion=mysql_num_rows($res_gestion);
			
				 
			for($i=0;$i<$num_tarjetas;$i++)
			{
						$row=mysql_fetch_array($res_tarjetas);
						if($repPto==$row['repisat'] and  $modPto==$row['modelo_tarjeta'] and $slotPto==$row['slot'] )  
						$clase="Estilo70";
						else 
						$clase="Estilo42";
		?>					 
        <tr class='<?=$clase?>' title='Click para ver los puertos de esta tarjeta' onmouseover='this.className="Estilo70";'
        onmouseout='this.className="<?=$clase?>";' 
        onclick='document.alta_demarcador.verpuertos.value=1;
            	 document.alta_demarcador.repPto.value="<?=$row['repisat']?>";
                 document.alta_demarcador.slotPto.value="<?=$row['slot']?>";
                 document.alta_demarcador.modPto.value="<?=$row['modelo_tarjeta']?>";
                 document.alta_demarcador.submit()'>
                 <td><?=$row['repisat']?></td>
                 <td><?=$row['modelo_tarjeta']?></td>
                 <td><?=$row['slot']?></td>
                 <?					   
                 $aux=0;
                     for($j=0;$j<$num_gestion;$j++)
                        {
                         if(mysql_result($res_gestion,$j,0)==$row['slot'] and $aux==0)
                            {
							  echo "<td>P. GEST.</td>";	
                              $aux=1;
                            }
                        }
				?>	
                <td>
                	<? if($aux==0){?>
                	<img src='images/erase.png' onclick='document.alta_demarcador.bajatj.value=1;
                    document.alta_demarcador.idTj.value="<?=$row['id']?>";document.alta_demarcador.submit();' style=" <?=$estilo?>">
					<? }?>
                </td>
        </tr>
		<?	}?>			
	</table>
<?  }?>
<!--------------------------------------------------------- MUESTRA PUERTOS DEL EQUIPO --------------------------------------------------->
<? if(($verpuertos==1 and $aplica_tarjeta=="SI") or ($num_clli>0 and $aplica_tarjeta!="SI")){
	if($aplica_tarjeta=='NO'){$repPto="N/A";$slotPto="N/A";}	
?>					
	<br />
    <? if($tipo_equipo=="1531 CLAS" or $tipo_equipo=="1521 CLIP"){?>
    <table id="tbPto">
		<tr class="tituloRojo1"><td colspan=14>Informacion de Puertos </td></tr>
		<tr align="center">
             <td colspan='4' bgcolor="#F0F0F0"><strong>Pares / Puerto</strong></td>
             <td colspan='6' bgcolor="#E0E0E0"><strong>Remate en Distrito/DG</strong></td>
             <td colspan='4' bgcolor="#F0F0F0"><strong>Controles</strong></td>
		</tr>							  
		<tr>
             <td>Repisa</td><td>Slot</td><td>Puerto</td><td>Tipo Puerto</td>
             <td>DG/Distrito</td><td>Repisa</td><td>Contacto/Par</td><td>Tipo Conector</td>
             <td>Longitud (Metros)</td><td>Tipo Jumper/Cable</td>
             <td>Servicios</td><td>Estatus</td><td>Gestionado</td><td>Agregar/Borrar</td>
		</tr>
        <tr>
        	 <td><input type='hidden' value='<?=$modPto?>'  readonly size='4' name='modPto1'>
                 <input type='text'   value='<?=$repPto?>'  readonly size='4' name='repPto1'></td>
             <td><input type='text'   value='<?=$slotPto?>' readonly size='4' name='slotPto1' ></td>
			 <td><?
                $query_p="select nombre_puerto,capacidad_puerto from cat_puertos_ce where tipo_equipo='$tipo_equipo' 
                 		 group by nombre_puerto	order by length(nombre_puerto),nombre_puerto";
                $res_p = mysql_query($query_p);  
                                        
                $querypto="select puerto from inventario_puertos_demarcadores where clli_adva='$clli_adva' and slot='$slotPto' order by puerto";
                $res_pto_asig=mysql_query($querypto);
                //echo $querypto;
                if(mysql_num_rows($res_pto_asig)>0)
                {
                    for($j=0;$j<mysql_num_rows($res_pto_asig);$j++)
                   	$pto_asig[$j]=mysql_result($res_pto_asig,$j,0);
                }?>
                <select name='puerto' 
                onChange='
                document.alta_demarcador.verpuertos.value=1;document.alta_demarcador.tipo_equipo.value="<?=$tipo_equipo?>";
                document.alta_demarcador.modPto.value="<?=$modPto?>";document.alta_demarcador.slotPto.value="<?=$slotPto?>";
                document.alta_demarcador.repPto.value="<?=$repPto?>";submit();'><option value=''></option>
                <? 
                        for($i=0;$i<mysql_num_rows($res_p);$i++) 
						{ 
                            $row = mysql_fetch_array($res_p);
								
							if($puerto==$row["nombre_puerto"]) 	$selpl9="selected";
	                        else 								$selpl9="";
                                
                            if(count($pto_asig)>0)
                            {
								if (!in_array($row["nombre_puerto"], $pto_asig))
								{echo "<option $selpl9 value='".$row["nombre_puerto"]."'>".$row["nombre_puerto"]."</option>";}
							}
                            else
                            {echo "<option $selpl9 value='".$row["nombre_puerto"]."'>".$row["nombre_puerto"]."</option>";}
                         } 
                    ?>
                </select>
            </td>
            <td><?
                $query_tpw="select tipo_puerto from cat_puertos_ce where tipo_equipo='$tipo_equipo'  and nombre_puerto='$puerto' group by tipo_puerto 
                order by tipo_puerto ASC";
                //echo $query_tpw;
                $res_tpw = mysql_query($query_tpw);
                if ($row = mysql_fetch_array($res_tpw))
                { ?>
                    <select name='tipo_puertoPri' 
                    onChange='
                    document.alta_demarcador.verpuertos.value=1;document.alta_demarcador.tipo_equipo.value="<?=$tipo_equipo?>";
                    document.alta_demarcador.modPto.value="<?=$modPto?>";document.alta_demarcador.slotPto.value="<?=$slotPto?>";
                    document.alta_demarcador.repPto.value="<?=$repPto?>";submit();'><option value=''></option>
                <?    do {  
                            if($tipo_puertoPri==$row["tipo_puerto"]) 	$selp20="selected";
                            else 										$selp20="";
                            echo "<option $selp20 value='".$row["tipo_puerto"]."'>".$row["tipo_puerto"]."</option>";
                        } while ($row = mysql_fetch_array($res_tpw)); ?>
                    </select>		
              <? }?>
            </td>	
            <td><input name='ubicacion_bdfo1' type='text'  title='Ubicacion del Puerto' size='18' /></td>
            <td><input name='repisa_bdfo1'    type='text'  title='Repisa del Puerto'    size='10' /></td>
            <td><input name='contacto_bdfo1'  type='text'  title='Contacto del Puerto'  size='10' /></td>
            <td><?
              	$queryConec="select tipo_conector from cat_puertos_ce where tipo_equipo='$tipo_equipo'  and nombre_puerto='$puerto'
                and tipo_puerto='$tipo_puertoPri' group by tipo_conector order by tipo_conector ASC";
                $resConec = mysql_query($queryConec);
				if ($rowConect = mysql_fetch_array($resConec))
                {?>
                   <select name='tipo_conector1'>
                 <?   do {  
                            if($tipo_conector1==$rowConect["tipo_conector"])	$selpConect="selected";
                            else 										$selpConect="";
                            echo "<option $selpConect value='".$rowConect["tipo_conector"]."'>".$rowConect["tipo_conector"]."</option>";
                        } while ($rowConect = mysql_fetch_array($resConec)); ?>
                    </select>
                <? }?> </td>
           <td><select name='long_jumper1'><option value=''></option>
                <? for ($jl=1;$jl<=5000;$jl++){echo "<option value='$jl'>$jl</option>";}?>
               </select></td>
           <td><?
                $query_tjum="select tipo_jumper from cat_puertos_ce where tipo_equipo='$tipo_equipo'  and nombre_puerto='$puerto'
                and tipo_puerto='$tipo_puertoPri' group by tipo_jumper order by tipo_jumper ASC";
                //echo $query_tcon;
                $res_tjum = mysql_query($query_tjum);
                if ($row = mysql_fetch_array($res_tjum))
                { ?>
                    <select name='tipo_jumper1'>
                 <?   do {  
                            if($tipo_jumper==$row["tipo_jumper"])	$selp20="selected";
                            else 									$selp20="";
                            echo "<option $selp20 value='".$row["tipo_jumper"]."'>".$row["tipo_jumper"]."</option>";
                        } while ($row = mysql_fetch_array($res_tjum)); ?>
                    </select>
               <? }?>
           </td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td >&nbsp;</td>
           <td><img src='images/add.png' 
           onClick='document.alta_demarcador.verpuertos.value=1;
           document.alta_demarcador.tipo_equipo.value="<?=$tipo_equipo?>";document.alta_demarcador.modPto.value="<?=$modPto?>";
           document.alta_demarcador.slotPto.value="<?=$slotPto?>";document.alta_demarcador.repPto.value="<?=$repPto?>"; 
           validPuerto();' style="<?=$estilo?>"></td>
		</tr>
		<!------------------------- MUESTRA PUERTOS DEL EQUIPO CONFIGURADOS		--------------------------------------------->
		<tr class="tituloRojo1"><td colspan=14><br>Pares Configurados</td></tr>
       	<!-------------------------	REPLICA	DE DATOS							--------------------------------------------->
        <? if($estexp!="VALIDADA" and ($tipo_equipo=="1531 CLAS" or $tipo_equipo=="1521 CLIP")) {?>
        <tr bgcolor="#E0E0E0">
           <td colspan="4" class="tituloAzul">Replica de Informacion para Puertos</td>
		   <td><input name='replicaUbicacion' type='text'  title='Replica de la Ubicacion' size='18'  onkeyup="this.value=this.value.toUpperCase()" 
                onblur="this.value=this.value.toUpperCase()"/></td>
		   <td><input name='replicaRepisa' type='text'  title='Replica de la Repisa' size='6' onkeyup="this.value=this.value.toUpperCase()"
                onblur="this.value=this.value.toUpperCase()"/></td>
           <td><input name='replicaContacto' type='text'  title='Contacto del Puerto' size='6' maxlength="5" 
                onkeypress="if(event.keyCode<45||event.keyCode>57)event.returnValue=false;"/></td>
		   <td><? $conect=array("RJ-45","COBRE");?>
            <select name='replicaConector'><option value=''></option>
            <? for($b=0;$b<count($conect);$b++) { echo "<option  value='".$conect[$b]."'>".$conect[$b]."</option>"; }?>
            </select></td>
            <td><select name='replicaLong'><option value=''></option>
            <? for ($s=1;$s<=5000;$s++) {echo "<option value='$s'>$s</option>";}?></select></td>
            <td><? $jumper=array("UTP","MULTIPAR 20 PARES");?>
            <select name='replicaJumper'><option value=''></option>
            <? for($a=0;$a<count($jumper);$a++)
               { echo "<option value='".$jumper[$a]."'>".$jumper[$a]."</option>"; }?></select></td>
            <td colspan="3">&nbsp;</td>
            <td><input type="button" name="replicaBoton" value="Replica Datos" onclick="document.alta_demarcador.verpuertos.value=1;
               document.alta_demarcador.replicaDatos.value=1;submit();" style=" <?=$estilo?> " class="EstiloBto"/></td>
		</tr>
    	<? }?> 
       	<!-------------------------	PARES DATOS DE ALTA EN EL INVENTARIO			--------------------------------------------->
	 <?	$query_puertos="select * from inventario_puertos_demarcadores where clli_adva='$clli_adva' and repisat='$repPto' and slot='$slotPto' 
        order by length(puerto),puerto";
		//echo $query_puertos;
		$res_puertos=mysql_query($query_puertos);
		$num_puertos=mysql_num_rows($res_puertos);
 		
		for($i=0;$i<$num_puertos;$i++)
		{
			 $row=mysql_fetch_array($res_puertos);					
		?>
		<tr>
			<td><input name='repArr'  type='text'  title='Repisa' size='4' value='<?=$row['repisat']?>' readonly/></td>
			<td><input name='slotArr' type='text'  title='Slot'   size='4' value='<?=$row['slot']?>'    readonly/></td>
			<td><input name='ptoArr'  type='text'  title='Puerto' size='35' value='<?=$row['puerto']?>'  readonly/></td>
			<td>
            <?
			$query_tpuerto="select tipo_puerto from cat_puertos_ce where tipo_equipo='$tipo_equipo' and nombre_puerto='".$row['puerto']."'
			group by tipo_puerto order by tipo_puerto ASC";
			$res_tpuerto = mysql_query($query_tpuerto);
			$num_tpuerto=mysql_num_rows($res_tpuerto);?>
		   	<select name='tipo_puerto[]'>
			<?	 for($b=0;$b<$num_tpuerto;$b++)
			        { 
					 $row_tpuerto=mysql_fetch_array($res_tpuerto);
					  if($row_tpuerto["tipo_puerto"]==$row["tipo_puerto"]) 	$selp90="selected";
                      else 													$selp90="";
                      echo "<option $selp90 value='".$row_tpuerto["tipo_puerto"]."'>".$row_tpuerto["tipo_puerto"]."</option>";
					}
			?></select>
            </td>
			<td><input name='ubicacion_bdfo[]' type='text'  title='Ubicacion del Puerto' size='18' value='<?=$row['ubicacion_bdfo']?>' 
            onkeyup="this.value=this.value.toUpperCase()" onblur="this.value=this.value.toUpperCase()"/></td>
			<td><input name='repisa_bdfo[]' type='text'     title='Repisa del Puerto'    size='6' value='<?=$row['repisa_bdfo']?>' /></td>
			<td><input name='contacto_bdfo[]' type='text'   title='Contacto del Puerto'  size='6' value='<?=$row['contacto_bdfo']?>' /></td>
			<td>
            <? 
			/*$qConector="select tipo_conector from cat_puertos_ce where tipo_equipo='$tipo_equipo' and nombre_puerto='".$row['puerto']."'
			group by tipo_conector order by tipo_conector ASC";
			$rConector=mysql_query($qConector);
			$nConector=mysql_num_rows($rConector);*/?>
            <!--<select name='tipo_conector[]'>-->
			<?	/* for($b=0;$b<$nConector;$b++)
			        { 
					  $rwConector=mysql_fetch_array($rConector);
					  if($rwConector["tipo_conector"]==$row["tipo_conector"]) 	$selprConector="selected";
                      else 														$selprConector="";
                      echo "<option $selprConector value='".$rwConector["tipo_conector"]."'>".$rwConector["tipo_conector"]."</option>";
					}*/
			?><!--</select>-->
            <?  $conect=array("RJ-45","COBRE","LC/FC","LC/SC");?>
            <select name='tipo_conector[]'><option value=''></option>
               <?   for($b=0;$b<count($conect);$b++)
			        { 
					  if($conect[$b]==$row["tipo_conector"]) $selp20="selected";
                      else $selp20="";
                      echo "<option $selp20 value='".$conect[$b]."'>".$conect[$b]."</option>";
                    }?>
            </select></td>
			<td><select name='long_jumper[]'><option value=''></option>
            <? for ($s=1;$s<=5000;$s++) {
			   if($s==$row['long_jumper']) 	$selpLon="selected";
               else 						$selpLon="";
			   echo "<option $selpLon value='".$s."'>".$s."</option>";
			 }?></select></td>
		    <td>
          	<? 
			/*$qJumper="select tipo_jumper from cat_puertos_ce where tipo_equipo='$tipo_equipo' and nombre_puerto='".$row['puerto']."'
			group by tipo_jumper order by tipo_jumper ASC";
			$rJumper=mysql_query($qJumper);
			$nJumper=mysql_num_rows($rJumper);*/?>
			<!-- <select name='tipo_jumper[]'>-->			
			<?	 /*for($b=0;$b<$nJumper;$b++)
			        { 
					  $rwJumper=mysql_fetch_array($rJumper);
					  if($rwJumper["tipo_jumper"]==$row["tipo_jumper"]) 	$selprJumper="selected";
                      else 													$selprJumper="";
                      echo "<option $selprJumper value='".$rwJumper["tipo_jumper"]."'>".$rwJumper["tipo_jumper"]."</option>";
					}*/
			?><!-- </select>-->
			<? $jumper=array("UTP","MULTIPAR 20 PARES","MONOMODO","MULTIMODO");?>
          	<select name='tipo_jumper[]'><option value=''></option>
               <?   for($a=0;$a<count($jumper);$a++)
			        { 
                      if($jumper[$a]==$row["tipo_jumper"]) $selp20="selected";
                      else $selp20="";
                      echo "<option $selp20 value='".$jumper[$a]."'>".$jumper[$a]."</option>";
                    }?>
            </select>            
            </td>          
			<td bgcolor="#F0F0F0"><strong><?=$row['nombre_oficial_pisa']?></strong></td>
			<td bgcolor="#F0F0F0"><strong><?=$row['estatus']?></strong></td>
			<td bgcolor="#F0F0F0"><strong><?=$row['gestionada']?></strong></td>
            <td align="center">
			<? if($row['estatus']=="DISPONIBLE"){?>
    		<img src='images/save.png'  
            onclick='document.alta_demarcador.updpto.value=1; document.alta_demarcador.save.value="<?=$i?>";
            document.alta_demarcador.idupd.value="<?=$row['id']?>"; document.alta_demarcador.verpuertos.value=1;
            document.alta_demarcador.tipo_equipo.value="<?=$tipo_equipo?>";document.alta_demarcador.modPto.value="<?=$modPto?>";
            document.alta_demarcador.slotPto.value="<?=$slotPto?>"; document.alta_demarcador.repPto.value="<?=$repPto?>";
            document.alta_demarcador.submit();' style="<?=$estilo?>"> &nbsp;&nbsp;
            <? if($tipo_equipo=="1521 CLIP" or $row['puerto']=="Universal I/O slot Port 1 (WAN)" or $row['puerto']=="Universal I/O slot Port 2 (WAN)") {?>
            <img src='images/erase.png' 
            onclick='document.alta_demarcador.bajapto.value=1;document.alta_demarcador.idupd.value="<?=$row['id']?>";
            document.alta_demarcador.verpuertos.value=1;document.alta_demarcador.tipo_equipo.value="<?=$tipo_equipo?>";
            document.alta_demarcador.modPto.value="<?=$modPto?>";document.alta_demarcador.slotPto.value="<?=$slotPto?>";
            document.alta_demarcador.repPto.value="<?=$repPto?>";document.alta_demarcador.submit();' style="<?=$estilo?>">
            <?  }?>  
            <? }?>             
            </td>
		</tr>
        <? }?>               
    </table>  
    <? }else{?>
        <table id="tbPtoFo">
		<tr class="tituloRojo1"><td colspan=18>Informacion de Puertos </td></tr>
		<tr align="center">
             <td colspan='5' bgcolor="#F0F0F0"><strong>Puerto</strong></td>
             <td colspan='9' bgcolor="#E0E0E0"><strong>Remate DFO</strong></td>
             <td colspan='4' bgcolor="#F0F0F0"><strong>Controles</strong></td>
		</tr>							  
		<tr>
             <td>Repisa</td><td>Slot</td><td>Puerto</td><td>Tipo Puerto</td><td>Tipo Conector</td>
             <td>Ubicacion/Bastidor</td><td>Repisa</td><td>Punto de Monitoreo</td><td>Contacto</td>
             <td>Tipo BDFO/Gabinete</td>
             <td>Tipo DFO/Tablilla</td>
             <td>Tipo Conector</td>
             <td>Longitud (Metros)</td>
             <td>Tipo Jumper</td>
             <td>Servicios</td><td>Estatus</td><td>Gestionado</td><td>Agregar/Borrar</td>
		</tr>
        <tr>
        	 <td><input type='hidden' value='<?=$modPto?>'  readonly size='4' name='modPto1'>
                 <input type='text'   value='<?=$repPto?>'  readonly size='4' name='repPto1'></td>
             <td><input type='text'   value='<?=$slotPto?>' readonly size='15' name='slotPto1' ></td>
             <td><?
			 	if($aplica_tarjeta=="SI")
				{
					$query_p="select nombre_puerto,capacidad_puerto from cat_puertos_ce where tipo_equipo='$tipo_equipo' and tipo_tarjeta='$modPto' 
		            group by  nombre_puerto order by length(nombre_puerto),nombre_puerto";	
				}else
				{
                	$query_p="select nombre_puerto,capacidad_puerto from cat_puertos_ce where tipo_equipo='$tipo_equipo' 
                 	group by nombre_puerto	order by length(nombre_puerto),nombre_puerto";
				}
                $res_p = mysql_query($query_p);  
                                        
                $querypto="select puerto from inventario_puertos_demarcadores where clli_adva='$clli_adva' and slot='$slotPto' order by puerto";
                $res_pto_asig=mysql_query($querypto);
                //echo $querypto;
                                                
                if(mysql_num_rows($res_pto_asig)>0)
                {
                    for($j=0;$j<mysql_num_rows($res_pto_asig);$j++)
                   	$pto_asig[$j]=mysql_result($res_pto_asig,$j,0);
                }?>
                <select name='puerto' 
                onChange='
                document.alta_demarcador.verpuertos.value=1;document.alta_demarcador.tipo_equipo.value="<?=$tipo_equipo?>";
                document.alta_demarcador.modPto.value="<?=$modPto?>";document.alta_demarcador.slotPto.value="<?=$slotPto?>";
                document.alta_demarcador.repPto.value="<?=$repPto?>";submit();'><option value=''></option>
                <? 
                        for($i=0;$i<mysql_num_rows($res_p);$i++) 
						{ 
                            $row = mysql_fetch_array($res_p);
								
								
								if($puerto==$row["nombre_puerto"]) 
                                $selpl9="selected";
                                else $selpl9="";
                                
                                if(count($pto_asig)>0)
                                {
									if($tipo_equipo=="TELLABS 7305")
									{
										
										if(in_array("Port 2 (P2)-WAN", $pto_asig))
										{
											if (!in_array($row["nombre_puerto"], $pto_asig) and $row["nombre_puerto"]!="Port 2 (P2)-LAN")
											{echo "<option $selpl9 value='".$row["nombre_puerto"]."'>".$row["nombre_puerto"]."</option>";}
										}else
										if(in_array("Port 2 (P2)-LAN", $pto_asig))
										{
											if (!in_array($row["nombre_puerto"], $pto_asig) and $row["nombre_puerto"]!="Port 2 (P2)-WAN")
											{echo "<option $selpl9 value='".$row["nombre_puerto"]."'>".$row["nombre_puerto"]."</option>";}
										}else
										{
											if (!in_array($row["nombre_puerto"], $pto_asig))
											{echo "<option $selpl9 value='".$row["nombre_puerto"]."'>".$row["nombre_puerto"]."</option>";}
										}
										
									}elseif($tipo_equipo=="FSP 150CC-GE112")
									{
										
										if(in_array("E1000-WAN-2", $pto_asig))
										{
											if (!in_array($row["nombre_puerto"], $pto_asig) and $row["nombre_puerto"]!="E1000-LAN-2")
											{echo "<option $selpl9 value='".$row["nombre_puerto"]."'>".$row["nombre_puerto"]."</option>";}
										}else
										if(in_array("E1000-LAN-2", $pto_asig))
										{
											if (!in_array($row["nombre_puerto"], $pto_asig) and $row["nombre_puerto"]!="E1000-WAN-2")
											{echo "<option $selpl9 value='".$row["nombre_puerto"]."'>".$row["nombre_puerto"]."</option>";}
										}else
										{
											if (!in_array($row["nombre_puerto"], $pto_asig))
											{echo "<option $selpl9 value='".$row["nombre_puerto"]."'>".$row["nombre_puerto"]."</option>";}
										}
									}
									else
									{
										if (!in_array($row["nombre_puerto"], $pto_asig))
								    	{echo "<option $selpl9 value='".$row["nombre_puerto"]."'>".$row["nombre_puerto"]."</option>";}
									}
								}
                                else
                                {echo "<option $selpl9 value='".$row["nombre_puerto"]."'>".$row["nombre_puerto"]."</option>";}
                         } 
                    ?>
                </select>
            </td>
            <td><?
                $query_tpw="select tipo_puerto from cat_puertos_ce where tipo_equipo='$tipo_equipo'  and nombre_puerto='$puerto' group by tipo_puerto 
                order by tipo_puerto ASC";
                //echo $query_tpw;
                $res_tpw = mysql_query($query_tpw);
                if ($row = mysql_fetch_array($res_tpw))
                { ?>
                    <select name='tipo_puertoPri' 
                    onChange='
                    document.alta_demarcador.verpuertos.value=1;document.alta_demarcador.tipo_equipo.value="<?=$tipo_equipo?>";
                    document.alta_demarcador.modPto.value="<?=$modPto?>";document.alta_demarcador.slotPto.value="<?=$slotPto?>";
                    document.alta_demarcador.repPto.value="<?=$repPto?>";submit();'><option value=''>
                <?    do {  
                            if($tipo_puertoPri==$row["tipo_puerto"]) 	$selp20="selected";
                            else 										$selp20="";
                            echo "<option $selp20 value='".$row["tipo_puerto"]."'>".$row["tipo_puerto"]."</option>";
                        } while ($row = mysql_fetch_array($res_tpw)); ?>
                    </select>		
              <? }?>
            </td>
            <td><?
              	$queryConec="select tipo_conector from cat_puertos_ce where tipo_equipo='$tipo_equipo'  and nombre_puerto='$puerto'
                and tipo_puerto='$tipo_puertoPri' group by tipo_conector order by tipo_conector ASC";
                $resConec = mysql_query($queryConec);
				if ($rowConect = mysql_fetch_array($resConec))
                {?>
                   <select name='tipo_conector1'>
                 <?   do {  
                            if($tipo_conector1==$rowConect["tipo_conector"])	$selpConect="selected";
                            else 										$selpConect="";
                            echo "<option $selpConect value='".$rowConect["tipo_conector"]."'>".$rowConect["tipo_conector"]."</option>";
                        } while ($rowConect = mysql_fetch_array($resConec)); ?>
                    </select>
            <? }?> </td>            	
            <td><input name='ubicacion_bdfo1' type='text'  title='Ubicacion del Puerto' size='18' /></td>
            <td><input name='repisa_bdfo1'    type='text'  title='Repisa del Puerto'    size='10' /></td>
            <td><? $pmon=array("N/A","01","02","03","04","05","06","07","08");?>
            <select name='p_monitoreo1'><? for($a=0;$a<count($pmon);$a++){ echo "<option value='".$pmon[$a]."'>".$pmon[$a]."</option>"; }?></select></td>
            <td><input name='contacto_bdfo1'  type='text'  title='Contacto del Puerto'  size='10' /></td>
            <td>
			<? $qBdfo= "select distinct nombre_def_nodo from infinitum_unica.cat_frida_amdocs 
			where modelo_frida ='tipo_bdfo_amdocs' AND tabla_frida='inventario_puertos_ce' order by nombre_def_nodo";
 			$rBdfo=mysql_query($qBdfo) ;	            
			if ($rwBdfo = mysql_fetch_array($rBdfo))
                { ?>
                 <select name='tipo_bdfo1'>
                 <?   do {  
                            if($tipo_bdfo1==$rwBdfo["nombre_def_nodo"])	$selpBdfo="selected";
                            else 										$selpBdfo="";
                            echo "<option $selpBdfo value='".$rwBdfo["nombre_def_nodo"]."'>".$rwBdfo["nombre_def_nodo"]."</option>";
                        } while ($rwBdfo = mysql_fetch_array($rBdfo)); ?>
                 </select>
               <? }?></td>
            <td>
			<? $qDfo= "select distinct nombre_def_nodo from infinitum_unica.cat_frida_amdocs 
			where modelo_frida ='tipo_dfo_amdocs' AND tabla_frida='inventario_puertos_ce' order by nombre_def_nodo";
 			$rDfo=mysql_query($qDfo) ;	            
			if ($rwDfo = mysql_fetch_array($rDfo))
                { ?>
                 <select name='tipo_dfo1'>
                 <?   do {  
                            if($tipo_dfo1==$rwDfo["nombre_def_nodo"])	$selpDfo="selected";
                            else 												$selpDfo="";
                            echo "<option $selpDfo value='".$rwDfo["nombre_def_nodo"]."'>".$rwDfo["nombre_def_nodo"]."</option>";
                        } while ($rwDfo = mysql_fetch_array($rDfo)); ?>
                 </select>
               <? }?></td>            
           <td><? $conectorDfo=array("LC","SC","FC","RJ-45");?>
            <select name='tipo_conectorDfo1'><option value=''></option>
            <? for($a=0;$a<count($conectorDfo);$a++){ echo "<option value='".$conectorDfo[$a]."'>".$conectorDfo[$a]."</option>"; }?></select></td>
           <td><select name='long_jumper1'><option value=''></option>
                <? for ($jl=1;$jl<=5000;$jl++){echo "<option value='$jl'>$jl</option>";}?>
               </select></td>
           <td><?
                $query_tjum="select tipo_jumper from cat_puertos_ce where tipo_equipo='$tipo_equipo'  and nombre_puerto='$puerto'
                and tipo_puerto='$tipo_puertoPri' group by tipo_jumper order by tipo_jumper ASC";
                //echo $query_tcon;
                $res_tjum = mysql_query($query_tjum);
                if ($row = mysql_fetch_array($res_tjum))
                { ?>
                    <select name='tipo_jumper1'>
                 <?   do {  
                            if($tipo_jumper==$row["tipo_jumper"])	$selp20="selected";
                            else 									$selp20="";
                            echo "<option $selp20 value='".$row["tipo_jumper"]."'>".$row["tipo_jumper"]."</option>";
                        } while ($row = mysql_fetch_array($res_tjum)); ?>
                    </select>
               <? }?>
           </td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td >&nbsp;</td>
           <td><img src='images/add.png' 
           onClick='document.alta_demarcador.verpuertos.value=1;
           document.alta_demarcador.tipo_equipo.value="<?=$tipo_equipo?>";document.alta_demarcador.modPto.value="<?=$modPto?>";
           document.alta_demarcador.slotPto.value="<?=$slotPto?>";document.alta_demarcador.repPto.value="<?=$repPto?>"; 
           validPuerto();' style="<?=$estilo?>"></td>
		</tr>  
		<tr class="tituloRojo1"><td colspan=14><br>Puertos Configurados</td></tr>
       	<!-------------------------	REPLICA	DE DATOS							--------------------------------------------->
        <? if($estexp!="VALIDADA") {?>
        <tr bgcolor="#E0E0E0">
           <td colspan="5" class="tituloAzul">Replica de Informacion para Puertos</td>
			<td><input name='replicaUbicacion' type='text'  title='Replica de la Ubicacion' size='18'  onkeyup="this.value=this.value.toUpperCase()" 
                onblur="this.value=this.value.toUpperCase()"/></td>
			<td><input name='replicaRepisa' type='text'  title='Replica de la Repisa' size='10' onkeyup="this.value=this.value.toUpperCase()"
                onblur="this.value=this.value.toUpperCase()"/></td>
            <td>&nbsp;</td>    
            <td><input name='replicaContacto' type='text'  title='Contacto del Puerto' size='10' maxlength="5" 
                onkeypress="if(event.keyCode<45||event.keyCode>57)event.returnValue=false;"/></td>
            <td>
			<? $qBdfoR= "select distinct nombre_def_nodo from infinitum_unica.cat_frida_amdocs 
			where modelo_frida ='tipo_bdfo_amdocs' AND tabla_frida='inventario_puertos_ce' order by nombre_def_nodo";
 			$rBdfoR=mysql_query($qBdfoR) ; ?>
            <select name='replicaBdfo'>
            <?   do {  
                       echo "<option value='".$rwBdfoR["nombre_def_nodo"]."'>".$rwBdfoR["nombre_def_nodo"]."</option>";
                    } while ($rwBdfoR = mysql_fetch_array($rBdfoR)); ?>
                 </select></td>
            <td>
			<? $qDfoR= "select distinct nombre_def_nodo from infinitum_unica.cat_frida_amdocs 
			where modelo_frida ='tipo_dfo_amdocs' AND tabla_frida='inventario_puertos_ce' order by nombre_def_nodo";
 			$rDfoR=mysql_query($qDfoR); ?>
            <select name='replicaDfo'>
            <?   do {  
                       echo "<option value='".$rwDfoR["nombre_def_nodo"]."'>".$rwDfoR["nombre_def_nodo"]."</option>";
                    } while ($rwDfoR = mysql_fetch_array($rDfoR)); ?>
                 </select></td>
			<td><? $conectDfo=array("LC","SC","FC","RJ-45");?>
            <select name='replicaConectorDfo'><option value=''></option>
            <? for($b=0;$b<count($conectDfo);$b++) { echo "<option  value='".$conectDfo[$b]."'>".$conectDfo[$b]."</option>"; }?>
            </select></td>
            <td><select name='replicaLong'><option value=''></option>
            <? for ($s=1;$s<=5000;$s++) {echo "<option value='$s'>$s</option>";}?></select></td>
            <td><? $jumper=array("MONOMODO","MULTIMODO","UTP");?>
            <select name='replicaJumper'><option value=''></option>
            <? for($a=0;$a<count($jumper);$a++)
               { echo "<option value='".$jumper[$a]."'>".$jumper[$a]."</option>"; }?></select></td>
            <td colspan="3">&nbsp;</td>
            <td><input type="button" name="replicaBoton" value="Replica Datos" onclick="document.alta_demarcador.verpuertos.value=1;
               document.alta_demarcador.replicaDatos.value=1;submit();" Style=" <?=$estilo?> " class="EstiloBto"/></td>
		</tr>
    	<? }?>         
       	<!-------------------------	PARES DATOS DE ALTA EN EL INVENTARIO			--------------------------------------------->
	 <?	$query_puertos="select * from inventario_puertos_demarcadores where clli_adva='$clli_adva' and repisat='$repPto' and slot='$slotPto' 
        order by length(puerto),puerto";
		//echo $query_puertos;
		$res_puertos=mysql_query($query_puertos);
		$num_puertos=mysql_num_rows($res_puertos);
 		
		for($i=0;$i<$num_puertos;$i++)
		{
			 $row=mysql_fetch_array($res_puertos);					
		?>
		<tr>
			<td><input name='repArr'  type='text'  title='Repisa' size='4' value='<?=$row['repisat']?>' readonly/></td>
			<td><input name='slotArr' type='text'  title='Slot'   size='15' value='<?=$row['slot']?>'    readonly/></td>
			<td><input name='ptoArr'  type='text'  title='Puerto' size='25' value='<?=$row['puerto']?>'  readonly/></td>
			<td>
            <?
			$query_tpuerto="select tipo_puerto from cat_puertos_ce where tipo_equipo='$tipo_equipo' and nombre_puerto='".$row['puerto']."'
			group by tipo_puerto order by tipo_puerto ASC";
			$res_tpuerto = mysql_query($query_tpuerto);
			$num_tpuerto=mysql_num_rows($res_tpuerto);?>
		   	<select name='tipo_puerto[]'>
			<?	 for($b=0;$b<$num_tpuerto;$b++)
			        { 
					 $row_tpuerto=mysql_fetch_array($res_tpuerto);
					  if($row_tpuerto["tipo_puerto"]==$row["tipo_puerto"]) 	$selp90="selected";
                      else 													$selp90="";
                      echo "<option $selp90 value='".$row_tpuerto["tipo_puerto"]."'>".$row_tpuerto["tipo_puerto"]."</option>";
					}
			?></select></td>
            <td>
            <? 
			$qConector="select tipo_conector from cat_puertos_ce where tipo_equipo='$tipo_equipo' and nombre_puerto='".$row['puerto']."'
			group by tipo_conector order by tipo_conector ASC";
			$rConector=mysql_query($qConector);
			$nConector=mysql_num_rows($rConector);?>
            <select name='tipo_conector[]'>
			<?	 for($b=0;$b<$nConector;$b++)
			        { 
					  $rwConector=mysql_fetch_array($rConector);
					  if($rwConector["tipo_conector"]==$row["tipo_conector"]) 	$selprConector="selected";
                      else 														$selprConector="";
                      echo "<option $selprConector value='".$rwConector["tipo_conector"]."'>".$rwConector["tipo_conector"]."</option>";
					}
			?></select></td>			
			<td><input name='ubicacion_bdfo[]' type='text'  title='Ubicacion del Puerto' size='18' value='<?=$row['ubicacion_bdfo']?>' 
            onkeyup="this.value=this.value.toUpperCase()" onblur="this.value=this.value.toUpperCase()"/></td>
			<td><input name='repisa_bdfo[]' type='text'     title='Repisa del Puerto'    size='10' value='<?=$row['repisa_bdfo']?>' /></td>
           <td><? $pmont=array("N/A","01","02","03","04","05","06","07","08");?>
            <select name='p_monitoreo[]'>
            <? for($a=0;$a<count($pmont);$a++){
			   if($pmont[$a]==$row["p_monitoreo"]) 	$selpPm="selected";
               else 								$selpPm="";
			   echo "<option $selpPm value='".$pmont[$a]."'>".$pmont[$a]."</option>";}?></select></td>
			<td><input name='contacto_bdfo[]' type='text'   title='Contacto del Puerto'  size='10' value='<?=$row['contacto_bdfo']?>' /></td>
            <td>
            <? 
			$qtBdfo="select distinct nombre_def_nodo from infinitum_unica.cat_frida_amdocs 
 			where modelo_frida ='tipo_bdfo_amdocs' AND tabla_frida='inventario_puertos_ce' order by nombre_def_nodo";
			$rtBdfo=mysql_query($qtBdfo);
			$ntBdfo=mysql_num_rows($rtBdfo);?>
            <select name='tipo_bdfo[]'><option value=""></option>
			<?	 for($b=0;$b<$ntBdfo;$b++)
			        { 
					  $rwtBdfo=mysql_fetch_array($rtBdfo);
					  if($rwtBdfo["nombre_def_nodo"]==$row["tipo_bdfo"]) 	$selptBdfo="selected";
                      else 															$selptBdfo="";
                      echo "<option $selptBdfo value='".$rwtBdfo["nombre_def_nodo"]."'>".$rwtBdfo["nombre_def_nodo"]."</option>";
					}
			?></select></td> 
			<td>
            <? 
			$qtDfo="select distinct nombre_def_nodo from infinitum_unica.cat_frida_amdocs 
 			where modelo_frida ='tipo_dfo_amdocs' AND tabla_frida='inventario_puertos_ce' order by nombre_def_nodo";
			$rtDfo=mysql_query($qtDfo);
			$ntDfo=mysql_num_rows($rtDfo);?>
            <select name='tipo_dfo[]'><option value=""></option>
			<?	 for($b=0;$b<$ntDfo;$b++)
			        { 
					  $rwtDfo=mysql_fetch_array($rtDfo);
					  if($rwtDfo["nombre_def_nodo"]==$row["tipo_dfo"]) 	$selptDfo="selected";
                      else 														$selptDfo="";
                      echo "<option $selptDfo value='".$rwtDfo["nombre_def_nodo"]."'>".$rwtDfo["nombre_def_nodo"]."</option>";
					}
			?></select></td> 			
           <td><?
		    $conectorDfo=array("LC","SC","FC","RJ-45");?>
            <select name='tipo_conectorDfo[]'><option value=''></option>
            <? for($a=0;$a<count($conectorDfo);$a++){
			   if($conectorDfo[$a]==$row["tipo_conector_dfo"]) 	$selpCDfo="selected";
               else 											$selpCDfo="";
			   echo "<option $selpCDfo value='".$conectorDfo[$a]."'>".$conectorDfo[$a]."</option>"; 
			}?></select></td>
			<td><select name='long_jumper[]'><option value=''></option>
            <? for ($s=1;$s<=5000;$s++) {
			   if($s==$row['long_jumper']) 	$selpLon="selected";
               else 						$selpLon="";
			   echo "<option $selpLon value='".$s."'>".$s."</option>";
			 }?></select></td>
		    <td>
          	<? 
			$qJumper="select tipo_jumper from cat_puertos_ce where tipo_equipo='$tipo_equipo' and nombre_puerto='".$row['puerto']."'
			group by tipo_jumper order by tipo_jumper ASC";
			$rJumper=mysql_query($qJumper);
			$nJumper=mysql_num_rows($rJumper);?>
          	<select name='tipo_jumper[]'>
			<?	 for($b=0;$b<$nJumper;$b++)
			        { 
					  $rwJumper=mysql_fetch_array($rJumper);
					  if($rwJumper["tipo_jumper"]==$row["tipo_jumper"]) 	$selprJumper="selected";
                      else 													$selprJumper="";
                      echo "<option $selprJumper value='".$rwJumper["tipo_jumper"]."'>".$rwJumper["tipo_jumper"]."</option>";
					}
			?></select></td>          
			<td bgcolor="#F0F0F0"><strong><?=$row['nombre_oficial_pisa']?></strong></td>
			<td bgcolor="#F0F0F0"><strong><?=$row['estatus']?></strong></td>
			<td bgcolor="#F0F0F0"><strong><?=$row['gestionada']?></strong></td>
            <td align="center">
				 <? if ($row['estatus']=="DISPONIBLE")
                  {?>
                        <img src='images/save.png'  
                        onclick='
                        document.alta_demarcador.updpto.value=1;
                        document.alta_demarcador.save.value="<?=$i?>";
                        document.alta_demarcador.idupd.value="<?=$row['id']?>";
                        document.alta_demarcador.verpuertos.value=1;
                        document.alta_demarcador.tipo_equipo.value="<?=$tipo_equipo?>";
                        document.alta_demarcador.modPto.value="<?=$modPto?>";
                        document.alta_demarcador.slotPto.value="<?=$slotPto?>";
                        document.alta_demarcador.repPto.value="<?=$repPto?>";
                        document.alta_demarcador.submit();' style="<?=$estilo?>"> &nbsp;&nbsp;
                        
                        <img src='images/erase.png' 
                        onclick='
                        document.alta_demarcador.bajapto.value=1;
                        document.alta_demarcador.idupd.value="<?=$row['id']?>";
                        document.alta_demarcador.verpuertos.value=1;
                        document.alta_demarcador.tipo_equipo.value="<?=$tipo_equipo?>";
                        document.alta_demarcador.modPto.value="<?=$modPto?>";
                        document.alta_demarcador.slotPto.value="<?=$slotPto?>";
                        document.alta_demarcador.repPto.value="<?=$repPto?>";
                        document.alta_demarcador.submit();' style="<?=$estilo?>">
					<? }?>	
			</td>	
		</tr>
		<? }?>        
    </table> 
    <? }?> 
<? }?>    
</div>
<!-------------------------------- OCUPACION --->
<div>
<a name="equOcupado" id="equOcupado"></a>
<?
	if($aplica_tarjeta=="SI") 	$comOrd="order by slot,length(puerto),puerto";	
	else						$comOrd="order by length(puerto),puerto";						
	$queryOcupacion="select * from inventario_puertos_demarcadores where clli_adva='$clli_adva' and estatus in ('OCUPADO','RESERVADO') $comOrd";
	$resOcupacion=mysql_query($queryOcupacion);
	$numOcupacion=mysql_num_rows($resOcupacion);
?>

	<table id='tbGeneral'>
    <tr bgcolor="#F0F0F0">
             <td>Repisa</td><td>Slot</td><td>Puerto</td><td>Tipo Puerto</td>
             <td>Ubicacion/Bastidor</td><td>Repisa</td><td>Contacto</td>
             <td>Servicios</td><td>Estatus</td>            
    </tr>
    <? 
	for($i=0;$i<$numOcupacion;$i++)
	{
	$rowOcupacion=mysql_fetch_array($resOcupacion);	
	echo "<tr>";
		echo"
			<td>".$rowOcupacion['repisat']."</td>
			<td>".$rowOcupacion['slot']."</td>
			<td>".$rowOcupacion['puerto']."</td>
			<td>".$rowOcupacion['tipo_puerto']."</td>
			<td>".$rowOcupacion['ubicacion_bdfo']."</td>
			<td>".$rowOcupacion['repisa_bdfo']."</td>
			<td>".$rowOcupacion['contacto_bdfo']."</td>
			<td>".$rowOcupacion['nombre_oficial_pisa']."</td>
			<td>".$rowOcupacion['estatus']."</td>
		";	
	echo "</tr>";
	}
	?>    
    </table>
</div>

<!-------------------------------- BITACORA --->
<div>
<a name="bitac" id="bitac"></a>	
	<table class="tbGeneral">
    			<tr>
    			  <td class="tituloRojo1">Observaciones Demarcador</td></tr>
                <tr>
					<td>
					<?
					$datos_obsDD=explode("|",$obsvDD);
					$ta_datosDD=sizeof($datos_obsDD);
					
					for ( $tt=0; $tt<$ta_datosDD; $tt++)
					{
						if ( strlen($datos_obsDD[$tt] > 3) ){echo "<br>".$datos_obsDD[$tt];echo "<hr />";}
					}?>
					</td>
				</tr>
    			<tr bgcolor="#999999"><td colspan="4" height="4"></td></tr>
                <tr><td class="tituloRojo1">Observaciones Explotacion</td></tr>
				<tr>
					<td>
					<?
					$datos_obs=explode("|",$obsvExp);
					$ta_datos=sizeof($datos_obs);
					
					for ( $tt=0; $tt<$ta_datos; $tt++)
					{
						if ( strlen($datos_obs[$tt] > 3) ){echo "<br>".$datos_obs[$tt];echo "<hr />";}
					}
					?>
					</td>
				</tr>
                <tr bgcolor="#999999"><td colspan="4" height="4"></td></tr>
                <tr><td class="tituloRojo1">Observaciones CNS I</td></tr>
                <tr>
					<td>
					<?
					$datos_obsCns1=explode("|",$obsvCns1);
					$ta_datosCns1=sizeof($datos_obsCns1);
					
					for ( $tt=0; $tt<$ta_datosCns1; $tt++)
					{
						if ( strlen($datos_obsCns1[$tt] > 3) ){echo "<br>".$datos_obsCns1[$tt];echo "<hr />";}
					}
					?>
					</td>
				</tr>
    			<tr bgcolor="#999999"><td colspan="4" height="4"></td></tr>
                <tr><td class="tituloRojo1">Observaciones CNS IV</td></tr>    
                <tr>
					<td>
					<?
					$datos_obsCns4=explode("|",$obsvCns4);
					$ta_datosCns4=sizeof($datos_obsCns4);
					
					for ( $tt=0; $tt<$ta_datosCns4; $tt++)
					{
						if ( strlen($datos_obsCns4[$tt] > 3) ){echo "<br>".$datos_obsCns4[$tt];echo "<hr />";}
					}
					?>
					</td>
				</tr>
	</table>
</div>
<?
//------------------------------------------------>     BLOQUE DE QUERY'S   <-----------------------------------------------------------------------// 
//-------------------------------------------------> CREAR EL REGISTRO EN INVENTARIO DEMARCADORES 
if($guardar==1)
{
	

	if($tipo_demarcador=="CONVERTIDOR DE MEDIOS")
	{
		if($conexion_rcdt=="POR TUNEL")
		{$select_wdm=$cluster=$tipo_nodo_acceso=$nodo_adm_conex_adsl_acceso=$id_nodo_acceso=$proveedor_tx_acceso=$repadm_conxadsl_acceso=$clli_equipo_acceso=$ubi_nodo_adm_acceso=$puerto_req=$puerto_acceso=$tipo_puerto_acceso=$capacidad_puerto_acceso=$ubicacion_bdfo_acceso=$repisa_bdfo_acceso=$contacto_bdfo_acceso=$mod_tar_eth_acceso=$switc=$pto=$velocidad=$num_cambio=$cascada=$pto_cascada="N/A";}
		elseif($conexion_rcdt=="PUERTO EXTENDIDO")			
		{$switc=$pto=$velocidad=$num_cambio=$tunel=$cascada=$pto_cascada="N/A";}
		elseif($conexion_rcdt=="CONEXION DIRECTA A RCDT")			
		{$select_wdm=$tunel=$cascada=$pto_cascada="N/A";}
		elseif($conexion_rcdt=="CASCADA")
		{$select_wdm=$cluster=$tipo_nodo_acceso=$nodo_adm_conex_adsl_acceso=$id_nodo_acceso=$proveedor_tx_acceso=$repadm_conxadsl_acceso=$clli_equipo_acceso=$ubi_nodo_adm_acceso=$puerto_req=$puerto_acceso=$tipo_puerto_acceso=$capacidad_puerto_acceso=$ubicacion_bdfo_acceso=$repisa_bdfo_acceso=$contacto_bdfo_acceso=$mod_tar_eth_acceso=$switc=$pto=$velocidad=$num_cambio=$tunel="N/A";}
	}
	else
	{	
		if($conexion_rcdt=="POR TUNEL")
		{$select_wdm=$cluster=$tipo_nodo_acceso=$nodo_adm_conex_adsl_acceso=$id_nodo_acceso=$proveedor_tx_acceso=$repadm_conxadsl_acceso=$clli_equipo_acceso=$ubi_nodo_adm_acceso=$puerto_req=$puerto_acceso=$tipo_puerto_acceso=$capacidad_puerto_acceso=$ubicacion_bdfo_acceso=$repisa_bdfo_acceso=$contacto_bdfo_acceso=$mod_tar_eth_acceso=$switc=$pto=$velocidad=$num_cambio=$cascada=$pto_cascada="N/A";}
		elseif($conexion_rcdt=="PUERTO EXTENDIDO")			
		{$switc=$pto=$velocidad=$num_cambio=$tunel=$cascada=$pto_cascada="N/A";}
		elseif($conexion_rcdt=="CONEXION DIRECTA A RCDT")			
		{$select_wdm=$cluster=$tipo_nodo_acceso=$nodo_adm_conex_adsl_acceso=$id_nodo_acceso=$proveedor_tx_acceso=$repadm_conxadsl_acceso=$clli_equipo_acceso=$ubi_nodo_adm_acceso=$puerto_req=$puerto_acceso=$tipo_puerto_acceso=$capacidad_puerto_acceso=$ubicacion_bdfo_acceso=$repisa_bdfo_acceso=$contacto_bdfo_acceso=$mod_tar_eth_acceso=$tunel=$cascada=$pto_cascada="N/A";}
		elseif($conexion_rcdt=="CASCADA")
		{$select_wdm=$cluster=$tipo_nodo_acceso=$nodo_adm_conex_adsl_acceso=$id_nodo_acceso=$proveedor_tx_acceso=$repadm_conxadsl_acceso=$clli_equipo_acceso=$ubi_nodo_adm_acceso=$puerto_req=$puerto_acceso=$tipo_puerto_acceso=$capacidad_puerto_acceso=$ubicacion_bdfo_acceso=$repisa_bdfo_acceso=$contacto_bdfo_acceso=$mod_tar_eth_acceso=$switc=$pto=$velocidad=$num_cambio=$tunel="N/A";}
	}
	//---------------------------------------------> RESERVA INVENTARIO DE ID PARA TELLABS 
	if($tipo_equipo=='TELLABS 7325' or $tipo_equipo=='TELLABS 7345' or $tipo_equipo=='TELLABS 7305')
	{
            $queryRango="select id_equipo from inventario_id where division='$division' and estatus='DISPONIBLE' order by id_equipo ASC";		
			$resRango=mysql_query($queryRango);
			$rowRango=mysql_fetch_array($resRango);
			$id_equipo=$rowRango['id_equipo'];
		
			$queryTe="update inventario_id set nombre_oficial_pisa='$clli_adva',fecha_asignacion=NOW(),estatus='OCUPADO' 
			where id_equipo='$id_equipo' and division='$division'";			
			mysql_query($queryTe);		
	}
	
	//---------------------------------------------> REGISTRO DEL DEMARCADOR
	if($tipo_equipo=='1521 CLIP' or $tipo_equipo=='ALBIS 1416 NTU')	$ip_demarcador="N/A";
	else 															$ip_demarcador=trim($ip_demarcador);
	$tunel=trim($tunel);
	
	if($conexion_rcdt=="PUERTO EXTENDIDO" or ($conexion_rcdt=="POR TUNEL" and $clase_servicio=="CD SEGURA"))	{$ref_sisa=trim($ref_sisa);}
	else																										{$ref_sisa=$clli_adva;}
	
	$query_insdatos="insert into inventario_demarcadores
			(clli_adva,clase_servicio,division,central,ciudad,estado,siglas,clli_edif,ubicacion_demarcador,ip_demarcador,ot_instalacion_demarcador,no_repisa,		
			tipo_demarcador,tipo_equipo,proveedor,ref_sisa,select_wdm,cluster,conexion_rcdt,tipo_nodo_acceso,nodo_adm_conex_adsl_acceso,
			id_nodo_acceso,proveedor_tx_acceso,repadm_conxadsl_acceso,clli_equipo_acceso,ubi_nodo_adm_acceso,puerto_req,puerto_acceso,
			tipo_puerto_acceso,capacidad_puerto_acceso,ubicacion_bdfo_acceso,repisa_bdfo_acceso,contacto_bdfo_acceso,mod_tar_eth_acceso,switch,
			pto,velocidad,num_cambio,tunel,tecnologia,estatus_adva,login,fecha_alta,fecha_operacion,num_ot_frida,observaciones,release_eq,ip_gateway,
			aplica_traspasos,pto_cascada,cascada,aplicaSecundario,vlan_gestion,gestionada,id_equipo,funcion_equipo,topologia_equipo,
			tipo_nodo_dist,nodo_adm_conex_adsl_dist,id_nodo_dist,proveedor_tx_dist,repadm_conxadsl_dist,clli_equipo_dist,ubi_nodo_adm_dist,trabajo,clfi)
			values
			('$clli_adva','$clase_servicio','$division','$central','$ciudad','$estado','$siglas','$clli_edif','$ubicacion_demarcador','$ip_demarcador',
			'$ot_instalacion_demarcador','$no_repisa','$tipo_demarcador','$tipo_equipo','$proveedor','$ref_sisa','$select_wdm','$cluster','$conexion_rcdt',
			'$tipo_nodo_acceso','$nodo_adm_conex_adsl_acceso','$id_nodo_acceso','$proveedor_tx_acceso','$repadm_conxadsl_acceso','$clli_equipo_acceso',
			'$ubi_nodo_adm_acceso','$puerto_req','$puerto_acceso','$tipo_puerto_acceso','$capacidad_puerto_acceso','$ubicacion_bdfo_acceso',
			'$repisa_bdfo_acceso','$contacto_bdfo_acceso','$mod_tar_eth_acceso','$switc','$pto','$velocidad','$num_cambio','$tunel','',
			'','$sess_usr',NOW(),'','','','$release','$ip_demarcador_gateway','$aplica_traspasos','$pto_cascada','$cascada','$aplicaSecundario','$vlan',
			'NO GESTIONADO','$id_equipo','$funcion_equipo','$topologia_equipo','$tipo_nodo_dist','$nodo_adm_conex_adsl_dist','$id_nodo_dist',
			'$proveedor_tx_dist','$repadm_conxadsl_dist','$clli_equipo_dist','$ubi_nodo_adm_dist','ALTA','$clfi')";		
	//echo $query_insdatos;
	mysql_query($query_insdatos);
	//---------------------------------------------> SI ES PUERTO EXTENDIDO GUARDA EN TABLA DE INVENTARIO INFRA 
	if($conexion_rcdt=="PUERTO EXTENDIDO" and ($tipo_demarcador=='NDE' or $tipo_demarcador=='NDE-N' or $tipo_demarcador=='DDE' or $tipo_demarcador=='DDE-N'))
	{		
		$query_gr1="replace into inventario_infra 	
		(ref_sisa_infra,servicio,cluster,nodo_adm_conex_adsl,clli_equipo,tipo_cluster,id_nodo,division,estado,ciudad,login,clli_adva,
		select_wdm,fecha_alta,trafico,vlan_gestion,tipo_demarcador,lado,aplica_traspasos,modelo_adva,tipo_conexion,aplica_puerto_res)
		values 					
		('$ref_sisa','$clase_servicio','$cluster','$nodo_adm_conex_adsl_acceso','$clli_equipo_acceso','$tipo_nodo_acceso','$id_nodo_acceso','$division',
		'$estado','$ciudad','$sess_usr','$clli_adva','$select_wdm',NOW(),'inventario_infra','$vlan',
		'$tipo_demarcador','$tipo_nodo_acceso','$aplica_traspasos','$tipo_equipo','ENLACE PTO EXT','$aplicaSecundario')";
		mysql_query($query_gr1);
	}
	//---------------------------------------------> SI ES POR TUNEL  GUARDA EN TABLA DE INVENTARIO INFRA 
	if($conexion_rcdt=="POR TUNEL" and $clase_servicio=="CD SEGURA")
	{

			$queryCd="replace into inventario_infra 
			(ref_sisa_infra,cluster,nodo_adm_conex_adsl,tipo_cluster,clli_equipo,id_nodo,
			clli_adva,central_adva,modelo_adva,tipo_demarcador,vlan_gestion,
			clli_adva2,central_adva2,modelo_adva2,tipo_demarcador2,vlan_gestion2,
			fecha_alta,login,servicio,trafico,tipo_conexion,aplica_puerto_res,lado,select_wdm,celfi)
			values
			('$ref_sisa','N/A','N/A','N/A','N/A','N/A',
			'$tunel','$central2','$tipo_equipo2','$tipo_demarcador2','$vlan2',
			'$clli_adva','$central','$tipo_equipo','$tipo_demarcador','$vlan',
			NOW(),'$sess_usr','$clase_servicio','inventario_infra','ENLACE INFRA DEM','NO','N/A','N/A','$clfi')";
			mysql_query($queryCd);				
	}
	//--------------------------------------------->  INSERTA TODOS LOS PARES DEL EQUIPO CLAS 
	if ($tipo_equipo=='1531 CLAS')
	{
		$query_ptoclas="select nombre_puerto,tipo_puerto,capacidad_puerto from cat_puertos_ce where tipo_equipo='1531 CLAS' 
		and nombre_puerto!='Universal I/O slot Port 1 (WAN)' and nombre_puerto!='Universal I/O slot Port 2 (WAN)' 
		order by length(nombre_puerto),nombre_puerto";
		$res_ptoclas=mysql_query($query_ptoclas);
		$num_ptoclas=mysql_num_rows($res_ptoclas);
						
		for($i=0;$i<$num_ptoclas;$i++)
		{
			$row=mysql_fetch_array($res_ptoclas);
			//echo $row['tipo_puerto']."<br>";
						
			$qaltaptoclas="insert into inventario_puertos_demarcadores 
						   (clli_adva,division,tipo_equipo,modelo_tarjeta,repisat,posicion_tarjeta,slot,puerto,tipo_puerto,capacidad_puerto,ubicacion_bdfo,
						   repisa_bdfo,contacto_bdfo,fecha_alta,login,estatus,gestionada,tipo_jumper,long_jumper,tipo_conector) 
						   values 
						   ('$clli_adva','$division','$tipo_equipo','$modelo_tarjeta3','N/A','N/A','N/A','".$row['nombre_puerto']."','".$row['tipo_puerto']."',
							'".$row['capacidad_puerto']."','$ubicacion_bdfo','$repisa_bdfo','$contacto_bdfo',NOW(),
							'".$sess_usr."','DISPONIBLE','NO GESTIONADO','N/A','$long_jumper','$tipo_conector')";
			//echo $qaltaptoclas;
		   mysql_query($qaltaptoclas);
		}
	}
	//--------------------------------------------->  INSERTA TODOS LOS PARES DEL EQUIPO CLIP 
	if ($tipo_equipo=='1521 CLIP')
	{		
		$query_ptoclip="select nombre_puerto,tipo_puerto,capacidad_puerto from cat_puertos_ce where tipo_equipo='1521 CLIP' and puerto='PAIRS 1-4 (WAN)'
		and nombre_puerto!='Ethernet 10/100 Mbps Base TX (LAN)'";
		//echo $query_ptoclip;
		$res_ptoclip=mysql_query($query_ptoclip);
		$num_ptoclip=mysql_num_rows($res_ptoclip);
						
		for($i=0;$i<$num_ptoclip;$i++)
		{
			$row=mysql_fetch_array($res_ptoclip);
			//echo $row['tipo_puerto']."<br>";
							
			$qaltaptoclip="insert into inventario_puertos_demarcadores 
		                  (clli_adva,division,tipo_equipo,modelo_tarjeta,repisat,posicion_tarjeta,slot,puerto,tipo_puerto,capacidad_puerto,
						   ubicacion_bdfo,repisa_bdfo,contacto_bdfo,fecha_alta,login,estatus,gestionada,tipo_jumper,long_jumper,tipo_conector) 
						  values 
						  ('$clli_adva','$division','$tipo_equipo','$modelo_tarjeta3','N/A','N/A','N/A','".$row['nombre_puerto']."','".$row['tipo_puerto']."',
						   '".$row['capacidad_puerto']."','$ubicacion_bdfo','$repisa_bdfo','$contacto_bdfo',NOW(),
						   '".$sess_usr."','DISPONIBLE','NO GESTIONADO','N/A','$long_jumper','$tipo_conector')";
		    //echo $qaltaptoclip;
			mysql_query($qaltaptoclip);
		}
	}
	//--------------------------------------------->  INSERTA TODOS LOS PARES DEL EQUIPO 825 
	if ($tipo_equipo=='FSP 150CC-825')
	{		
		$query_pto825="select nombre_puerto,tipo_puerto,capacidad_puerto from cat_puertos_ce where tipo_equipo='FSP 150CC-825' group by nombre_puerto
		order by length(nombre_puerto),nombre_puerto";
		//echo $query_pto825;
		$res_pto825=mysql_query($query_pto825);
		$num_pto825=mysql_num_rows($res_pto825);
						
		for($i=0;$i<$num_pto825;$i++)
		{
			$row=mysql_fetch_array($res_pto825);
			//echo $row['tipo_puerto']."<br>";
							
			$qaltapto825="insert into inventario_puertos_demarcadores 
		                  (clli_adva,division,tipo_equipo,modelo_tarjeta,repisat,posicion_tarjeta,slot,puerto,tipo_puerto,capacidad_puerto,
						  fecha_alta,login,estatus,gestionada) 
						  values 
						  ('$clli_adva','$division','$tipo_equipo','$modelo_tarjeta3','N/A','N/A','N/A','".$row['nombre_puerto']."','".$row['tipo_puerto']."',
						   '".$row['capacidad_puerto']."',NOW(),'".$sess_usr."','DISPONIBLE','NO GESTIONADO')";
		    //echo $qaltapto825;
			//mysql_query($qaltapto825);
		}
	}
	//--------------------------------------------->  INSERTA TODOS LOS PARES DEL EQUIPO 206 
	if ($tipo_equipo=='FSP 150CC-GE206')
	{		
		$query_pto206="select nombre_puerto,tipo_puerto,capacidad_puerto from cat_puertos_ce where tipo_equipo='FSP 150CC-GE206' group by nombre_puerto
		order by length(nombre_puerto),nombre_puerto";
		//echo $query_pto206;
		$res_pto206=mysql_query($query_pto206);
		$num_pto206=mysql_num_rows($res_pto206);
						
		for($i=0;$i<$num_pto206;$i++)
		{
			$row=mysql_fetch_array($res_pto206);
			//echo $row['tipo_puerto']."<br>";
							
			$qaltapto206="insert into inventario_puertos_demarcadores 
		                  (clli_adva,division,tipo_equipo,modelo_tarjeta,repisat,posicion_tarjeta,slot,puerto,tipo_puerto,capacidad_puerto,
						  fecha_alta,login,estatus,gestionada) 
						  values 
						  ('$clli_adva','$division','$tipo_equipo','$modelo_tarjeta3','N/A','N/A','N/A','".$row['nombre_puerto']."','".$row['tipo_puerto']."',
						   '".$row['capacidad_puerto']."',NOW(),'".$sess_usr."','DISPONIBLE','NO GESTIONADO')";
		    //echo $qaltapto206;
			//mysql_query($qaltapto206);
		}
	}
	//--------------------------------------------->  INSERTA TODOS LOS PARES DEL EQUIPO TELLABS 7325 
	if ($tipo_equipo=='TELLABS 7325')
	{		
		$query_pto7325="select nombre_puerto,tipo_puerto,capacidad_puerto from cat_puertos_ce where tipo_equipo='TELLABS 7325' group by nombre_puerto
		order by length(nombre_puerto),nombre_puerto";
		//echo $query_pto7325;
		$res_pto7325=mysql_query($query_pto7325);
		$num_pto7325=mysql_num_rows($res_pto7325);
						
		for($i=0;$i<$num_pto7325;$i++)
		{
			$row=mysql_fetch_array($res_pto7325);
			//echo $row['tipo_puerto']."<br>";
							
			$qaltapto7325="insert into inventario_puertos_demarcadores 
		                  (clli_adva,division,tipo_equipo,modelo_tarjeta,repisat,posicion_tarjeta,slot,puerto,tipo_puerto,capacidad_puerto,
						  fecha_alta,login,estatus,gestionada) 
						  values 
						  ('$clli_adva','$division','$tipo_equipo','N/A','N/A','N/A','N/A','".$row['nombre_puerto']."','".$row['tipo_puerto']."',
						   '".$row['capacidad_puerto']."',NOW(),'".$sess_usr."','DISPONIBLE','NO GESTIONADO')";
		    //echo $qaltapto7325;
			//mysql_query($qaltapto7325);
		}
	}	
	//---------------------------------------------> SOLICITAMOS DATOS A RCDT 
	$query_rcdt="replace into rcdt_equipos 
		(clli, cliente, division, nombre_central,  ciudad, estado, tipo_demarcador, edo_act, tabla, proveedor, tipo_equipo,ref_sisa, 
		nombre_oficial_pisa, conexion_rcdt, tipo_nodo_acceso, cluster, login, nombre_login, fech_solicitud)
		values 
		('$clli_adva','$clase_servicio','$division','$central','$ciudad','$estado','$tipo_demarcador','ALTA','DEMARCADOR','$proveedor',
		'$tipo_equipo','$ref_sisa','$ref_sisa','$conexion_rcdt','$tipo_nodo_acceso','$cluster','$sess_usr','$sess_nmb', NOW())";
	//echo $query_rcdt;
	mysql_query($query_rcdt);
	
	
	if (mysql_affected_rows()!=-1)	$mensaje='Se Registro Exitosamente el Equipo';
	else 							$mensaje='Ya existe el Equipo';

	if($aplica_tarjeta=="SI"){		
	echo "<script>alert('".$mensaje."');document.alta_demarcador.guardar.value=0;document.alta_demarcador.submit();</script>";}
	else{
	echo "<script>alert('".$mensaje."');
	document.alta_demarcador.guardar.value=0;document.alta_demarcador.verpuertos.value=1;document.alta_demarcador.submit();</script>";}
}
//-------------------------------------------------> CAMBIOS DE INVENTARIO DEMARCADORES 
if($cambio==1)
{
	if($tipo_demarcador=="CONVERTIDOR DE MEDIOS")
	{
		if($conexion_rcdt=="POR TUNEL")
		{$select_wdm=$cluster=$tipo_nodo_acceso=$nodo_adm_conex_adsl_acceso=$id_nodo_acceso=$proveedor_tx_acceso=$repadm_conxadsl_acceso=$clli_equipo_acceso=$ubi_nodo_adm_acceso=$puerto_req=$puerto_acceso=$tipo_puerto_acceso=$capacidad_puerto_acceso=$ubicacion_bdfo_acceso=$repisa_bdfo_acceso=$contacto_bdfo_acceso=$mod_tar_eth_acceso=$switc=$pto=$velocidad=$num_cambio=$cascada=$pto_cascada="N/A";}
		else
		if($conexion_rcdt=="PUERTO EXTENDIDO")			
		{$switc=$pto=$velocidad=$num_cambio=$tunel=$cascada=$pto_cascada="N/A";}
		else
		if($conexion_rcdt=="CONEXION DIRECTA A RCDT")			
		{$select_wdm=$tunel=$cascada=$pto_cascada="N/A";}
		else
		if($conexion_rcdt=="CASCADA")
		{$select_wdm=$cluster=$tipo_nodo_acceso=$nodo_adm_conex_adsl_acceso=$id_nodo_acceso=$proveedor_tx_acceso=$repadm_conxadsl_acceso=$clli_equipo_acceso=$ubi_nodo_adm_acceso=$puerto_req=$puerto_acceso=$tipo_puerto_acceso=$capacidad_puerto_acceso=$ubicacion_bdfo_acceso=$repisa_bdfo_acceso=$contacto_bdfo_acceso=$mod_tar_eth_acceso=$switc=$pto=$velocidad=$num_cambio=$tunel="N/A";}
	}
	else
	{	
		if($conexion_rcdt=="POR TUNEL")
		{$select_wdm=$cluster=$tipo_nodo_acceso=$nodo_adm_conex_adsl_acceso=$id_nodo_acceso=$proveedor_tx_acceso=$repadm_conxadsl_acceso=$clli_equipo_acceso=$ubi_nodo_adm_acceso=$puerto_req=$puerto_acceso=$tipo_puerto_acceso=$capacidad_puerto_acceso=$ubicacion_bdfo_acceso=$repisa_bdfo_acceso=$contacto_bdfo_acceso=$mod_tar_eth_acceso=$switc=$pto=$velocidad=$num_cambio=$cascada=$pto_cascada="N/A";}
		else
		if($conexion_rcdt=="PUERTO EXTENDIDO")			
		{$switc=$pto=$velocidad=$num_cambio=$tunel=$cascada=$pto_cascada=$puerto_req=$puerto_acceso=$tipo_puerto_acceso=$capacidad_puerto_acceso=$ubicacion_bdfo_acceso=$repisa_bdfo_acceso=$contacto_bdfo_acceso=$mod_tar_eth_acceso=$id_puerto_acceso="N/A";}
		else
		if($conexion_rcdt=="CONEXION DIRECTA A RCDT")			
		{$select_wdm=$cluster=$tipo_nodo_acceso=$nodo_adm_conex_adsl_acceso=$id_nodo_acceso=$proveedor_tx_acceso=$repadm_conxadsl_acceso=$clli_equipo_acceso=$ubi_nodo_adm_acceso=$puerto_req=$puerto_acceso=$tipo_puerto_acceso=$capacidad_puerto_acceso=$ubicacion_bdfo_acceso=$repisa_bdfo_acceso=$contacto_bdfo_acceso=$mod_tar_eth_acceso=$tunel=$cascada=$pto_cascada="N/A";}
		else
		if($conexion_rcdt=="CASCADA")
		{$select_wdm=$cluster=$tipo_nodo_acceso=$nodo_adm_conex_adsl_acceso=$id_nodo_acceso=$proveedor_tx_acceso=$repadm_conxadsl_acceso=$clli_equipo_acceso=$ubi_nodo_adm_acceso=$puerto_req=$puerto_acceso=$tipo_puerto_acceso=$capacidad_puerto_acceso=$ubicacion_bdfo_acceso=$repisa_bdfo_acceso=$contacto_bdfo_acceso=$mod_tar_eth_acceso=$switc=$pto=$velocidad=$num_cambio=$tunel="N/A";}
	}


#-----------------------------------------  CAMBIO DE CONEXION SI SE REQUIERE --------------------------------------------------------------------------------
$queryDatos="select conexion_rcdt,ref_sisa from inventario_demarcadores where clli_adva='$clli_adva'";
$resDatos=mysql_query($queryDatos);
$rowDatos=mysql_fetch_row($resDatos);

$conexAct	=$rowDatos[0];
$refSisaAct	=$rowDatos[1];

if($conexion_rcdt=="PUERTO EXTENDIDO" or $conexion_rcdt=="CONEXION DIRECTA A RCDT")
{
	if($conexAct!=$conexion_rcdt)
	{
		if($conexAct=="CONEXION DIRECTA A RCDT" and $conexion_rcdt=="PUERTO EXTENDIDO")
		{
			//------------------------------------------- SI ES PUERTO EXTENDIDO GUARDA EN TABLA DE INVENTARIO INFRA -------------------------------------------
				$query_gr1="insert into inventario_infra 	
				(ref_sisa_infra,servicio,cluster,nodo_adm_conex_adsl,clli_equipo,tipo_cluster,id_nodo,division,estado,ciudad,login,clli_adva,
				select_wdm,fecha_alta,trafico,vlan_gestion,tipo_demarcador,lado,aplica_traspasos,modelo_adva,tipo_conexion,aplica_puerto_res)
				values 					
				('$ref_sisa','$clase_servicio','$cluster','$nodo_adm_conex_adsl_acceso','$clli_equipo_acceso','$tipo_nodo_acceso','$id_nodo_acceso','$division',
				'$estado','$ciudad','$sess_usr','$clli_adva','$select_wdm',NOW(),'inventario_infra','$vlan',
				'$tipo_demarcador','$tipo_nodo_acceso','$aplica_traspasos','$tipo_equipo','ENLACE PTO EXT','$aplicaSecundario')";
				mysql_query($query_gr1);
		}
		elseif($conexAct=="PUERTO EXTENDIDO" and $conexion_rcdt=="CONEXION DIRECTA A RCDT")
		{
				$query_gr1="delete from inventario_infra where ref_sisa_infra='$refSisaAct' and clli_adva='$clli_adva'";
				mysql_query($query_gr1);
				$query_gr2="update inventario_demarcadores set clase_servicio='' where clli_adva='$clli_adva'";
				mysql_query($query_gr2);	
		}
	}
}
#-----------------------------------------  PROCESO NORMAL --------------------------------------------------------------------------------------------------
	$ip_demarcador=trim($ip_demarcador);
	$query_act="update inventario_demarcadores set 
			    clase_servicio='$clase_servicio',division='$division',central='$central',ciudad='$ciudad',estado='$estado',siglas='$siglas',clli_edif='$clli_edif',
			    ubicacion_demarcador='$ubicacion_demarcador',ip_demarcador='$ip_demarcador',ot_instalacion_demarcador='$ot_instalacion_demarcador',
				no_repisa='$no_repisa',tipo_demarcador='$tipo_demarcador',tipo_equipo='$tipo_equipo',proveedor='$proveedor',id_equipo='$id_equipo',
		        ref_sisa='$ref_sisa',select_wdm='$select_wdm',cluster='$cluster',conexion_rcdt='$conexion_rcdt',
				tipo_nodo_acceso='$tipo_nodo_acceso',nodo_adm_conex_adsl_acceso='$nodo_adm_conex_adsl_acceso',id_nodo_acceso='$id_nodo_acceso',
				proveedor_tx_acceso='$proveedor_tx_acceso',repadm_conxadsl_acceso='$repadm_conxadsl_acceso',clli_equipo_acceso='$clli_equipo_acceso',
				ubi_nodo_adm_acceso='$ubi_nodo_adm_acceso',puerto_req='$puerto_req',
   			    puerto_acceso='$puerto_acceso',tipo_puerto_acceso='$tipo_puerto_acceso',capacidad_puerto_acceso='$capacidad_puerto_acceso',
				ubicacion_bdfo_acceso='$ubicacion_bdfo_acceso',repisa_bdfo_acceso='$repisa_bdfo_acceso',
			    contacto_bdfo_acceso='$contacto_bdfo_acceso',mod_tar_eth_acceso='$mod_tar_eth_acceso',switch='$switc',pto='$pto',
				velocidad='$velocidad',num_cambio='$num_cambio',tunel='$tunel',id_puerto_fisico='$id_puerto_fisico',release_eq='$release',
				ip_gateway='$ip_demarcador_gateway',aplica_traspasos='$aplica_traspasos',pto_cascada='$pto_cascada',cascada='$cascada',
				aplicaSecundario='$aplicaSecundario',vlan_gestion='$vlan',funcion_equipo='$funcion_equipo',topologia_equipo='$topologia_equipo',
				tipo_nodo_dist='$tipo_nodo_dist',nodo_adm_conex_adsl_dist='$nodo_adm_conex_adsl_dist',id_nodo_dist='$id_nodo_dist',
				proveedor_tx_dist='$proveedor_tx_dist',repadm_conxadsl_dist='$repadm_conxadsl_dist',clli_equipo_dist='$clli_equipo_dist',
				ubi_nodo_adm_dist='$ubi_nodo_adm_dist',clfi='$clfi' where clli_adva='$clli_adva'";
				//echo $query_act;
	mysql_query($query_act);
	//------------------------------------------- SI ES PUERTO EXTENDIDO GUARDA EL TABLA DE INVENTARIO INFRA -------------------------------------------
	if($conexion_rcdt=="PUERTO EXTENDIDO" and ($tipo_demarcador=='NDE' or $tipo_demarcador=='NDE-N' or $tipo_demarcador=='DDE' or $tipo_demarcador=='DDE-N'))
	{
		
		$queryInfra	="select * from inventario_infra where ref_sisa_infra='$ref_sisa' and clli_adva='$clli_adva'";
		$resInfra	=mysql_query($queryInfra);
		$numInfra	=mysql_num_rows($resInfra);
		
		if($numInfra==0)


		{
//			if($tipo_demarcador=="NDE" or $tipo_demarcador=="NDE-N")											$trafico="ENLACE PTO EXT";
//			elseif(($tipo_demarcador=="DDE" or $tipo_demarcador=="DDE-N") and $tipo_equipo=="FSP 150GE-X")		$trafico="ENLACE PTO EXT";
//			else																								$trafico="ENLACE PTO EXT SERV";

			$query_gr1="insert into inventario_infra 	
			(ref_sisa_infra,servicio,cluster,nodo_adm_conex_adsl,clli_equipo,tipo_cluster,id_nodo,division,estado,ciudad,login,clli_adva,
			select_wdm,fecha_alta,trafico,vlan_gestion,tipo_demarcador,lado,aplica_traspasos,modelo_adva,tipo_conexion,aplica_puerto_res)
			values 					
			('$ref_sisa','$clase_servicio','$cluster','$nodo_adm_conex_adsl_acceso','$clli_equipo_acceso','$tipo_nodo_acceso','$id_nodo_acceso','$division',
			'$estado','$ciudad','$sess_usr','$clli_adva','$select_wdm',NOW(),'inventario_infra','$vlan',
			'$tipo_demarcador','$tipo_nodo_acceso','$aplica_traspasos','$tipo_equipo','ENLACE PTO EXT','$aplicaSecundario')";
			mysql_query($query_gr1);	
		}
		else
		{
//			if($tipo_demarcador=="NDE" or $tipo_demarcador=="NDE-N")											$trafico="ENLACE PTO EXT";
//			elseif(($tipo_demarcador=="DDE" or $tipo_demarcador=="DDE-N") and $tipo_equipo=="FSP 150GE-X")		$trafico="ENLACE PTO EXT";
//			else																								$trafico="ENLACE PTO EXT SERV";

			$query_gr1="update inventario_infra set 
			servicio='$clase_servicio',
			cluster='$cluster',nodo_adm_conex_adsl='$nodo_adm_conex_adsl_acceso',clli_equipo='$clli_equipo_acceso',tipo_cluster='$tipo_nodo_acceso',
			id_nodo='$id_nodo_acceso',
			division='$division',estado='$estado',ciudad='$ciudad',
			clli_adva='$clli_adva',select_wdm='$select_wdm',trafico='inventario_infra',vlan_gestion='$vlan',tipo_demarcador='$tipo_demarcador',
			lado='$tipo_nodo_acceso',aplica_traspasos='$aplica_traspasos',tipo_conexion='ENLACE PTO EXT',modelo_adva='$tipo_equipo'
			where ref_sisa_infra='$ref_sisa'";
			mysql_query($query_gr1);
		}
	}
	//---------------------------------------------> SI ES POR TUNEL  GUARDA EN TABLA DE INVENTARIO INFRA 
	if($conexion_rcdt=="POR TUNEL" and $clase_servicio=="CD SEGURA")
	{


		$queryInfra	="select * from inventario_infra where ref_sisa_infra='$ref_sisa' and clli_adva='$clli_adva'";
		$resInfra	=mysql_query($queryInfra);
		$numInfra	=mysql_num_rows($resInfra);
		
		if($numInfra==0)
		{
			$queryCd="replace into inventario_infra 
			(ref_sisa_infra,cluster,nodo_adm_conex_adsl,tipo_cluster,clli_equipo,id_nodo,
			clli_adva,central_adva,modelo_adva,tipo_demarcador,vlan_gestion,
			clli_adva2,central_adva2,modelo_adva2,tipo_demarcador2,vlan_gestion2,
			fecha_alta,login,servicio,trafico,tipo_conexion,aplica_puerto_res,lado,select_wdm,celfi)
			values
			('$ref_sisa','N/A','N/A','N/A','N/A','N/A',
			'$tunel','$central2','$tipo_equipo2','$tipo_demarcador2','$vlan2',
			'$clli_adva','$central','$tipo_equipo','$tipo_demarcador','$vlan',
			NOW(),'$sess_usr','$clase_servicio','inventario_infra','ENLACE INFRA DEM','NO','N/A','N/A','$clfi')";
			mysql_query($queryCd);				
		}
	}
	
	if($descrip!="")
	{
		$updObser="update inventario_demarcadores set 
		observaciones=CONCAT(' |',NOW(),' (Usuario: ','$sess_nmb), ','Observaciones: ','$descrip\\n',observaciones)
		where clli_adva='$clli_adva'";
		mysql_query($updObser);
	}
	
	$mensaje='Se actualizo el Equipo';
	echo "<script>alert('".$mensaje."');document.alta_demarcador.cambio.value=0;document.alta_demarcador.submit();</script>";
} 
//-------------------------------------------------> VALIDAR REFERENCIA SISA  	
if($val_ref==1)
{
	if($clase_servicio!='L2' && $ref_sisa!='')
	{
		$query_ref="select ref_sisa from inventario_demarcadores where ref_sisa='$ref_sisa' and ref_sisa!='N/A'";
		$res_ref=mysql_query($query_ref);
		$num_ref=mysql_num_rows($res_ref);
		//echo $num_ref;
		if($num_ref>0)
		echo "<script>alert('Ya Existe la Referencia Sisa: '+ '".$ref_sisa."');document.alta_demarcador.ref_sisa.value=''</script>";
	}
}
//-------------------------------------------------> CAMBIO DE MODELO DE EQUIPO CON INFOCENTRO
if($cambioEquipo==1)
{
		
	//$wsdl = "http://10.192.2.74:8082/info_sise_int/webservices/sistemaFridaAdva?wsdl";				// SERVIDOR INFOCENTRO DESARROLLO
	$wsdl = "http://10.192.5.43/infocentro/webservices/sistemaFridaAdva?wsdl";				// SERVIDOR INFOCENTRO PRODUCCION

		include("SistemaAdvaConsRequest.php");	
		$adva = new SistemaAdvaConsRequest($clli_adva);
		try {
			$client = new SoapClient($wsdl, array('classmap' => array('arg0' => 'SistemaAdvaBajaRequest')));
			$result = $client->ConsultaClli(array('arg0' => $adva));
			$falla = false;
		} catch (SoapFault $fault) {
			$falla = true;
		}
	
		
		foreach($result->return as $indice => $valor){
			if(gettype($valor)=="string"||gettype($valor)=="array")
			$matriz[$indice]=$valor;
			if(gettype($valor)=="object"){
				foreach($valor as $subIndice => $subValor){
					if(gettype($subValor)=="array")
						$matriz[$indice]=$subValor;
					if(gettype($subValor)=="string")
						$matriz[$indice]=array($subValor);
				}
			}
			
		}
				
		$infoModelo				=trim($matriz['stipoEquipo']);
		
		$queryTeq="select tipo_equipo from cat_equipo where formato='ADVA' and cat_infocentro like '%$infoModelo%'";
		$resTeq=mysql_query($queryTeq);
		$rowTeq=mysql_fetch_row($resTeq);
		
		$modEqupInfo			=$rowTeq[0];
		
		
		$qPtoDem="select * from inventario_puertos_demarcadores where clli_adva='$clli_adva'";
		$rPtoDem=mysql_query($qPtoDem);
		$nPtoDem=mysql_num_rows($rPtoDem);
		
					if($tipo_equipo==$modEqupInfo)				$faltan_datos.="No Aplica Cambio de Modelo\\n";
		if($tipo_equipo!=$modEqupInfo)
		{
					if($nPtoDem!=0)								$faltan_datos.="Para Realizar el Cambio debe Eliminar los Puertos\\n";
		}
		
		
		if ($faltan_datos<>"") 
		{ echo "<script>alert('$faltan_datos');document.alta_demarcador.cambioEquipo.value=0;document.alta_demarcador.submit();</script>";}
		else
		{
			
			$updateEquipo="update inventario_demarcadores set tipo_equipo='".trim($modEqupInfo)."' where clli_adva='$clli_adva'";
			mysql_query($updateEquipo);
			echo "<script>alert('Cambio Realizado ...');
			document.alta_demarcador.cambioEquipo.value=0;document.alta_demarcador.buscar.value=1;
			document.alta_demarcador.submit();document.alta_demarcador.submit();</script>";

		}
}
//-------------------------------------------------> VALIDA LOS CAMPOS LLENOS DE LAS TARJETAS
if($validTarj==1)
{
	if($repisat=="" || $modelo_tarjeta=="" || $slot=="")
	echo "<script>alert('Falta Datos');</script>";
	else
	{
		if($tipo_equipo=="ALBIS 1416 LTU")
		{
			$qalta="insert into inventario_tarjetas_demarcadores (clli_adva,repisat,modelo_tarjeta,slot,fecha_alta, login, estatus) 
			VALUES ('$clli_adva','$repisat','$modelo_tarjeta','$slot_duo', NOW(),'".$sess_usr."','POR REVISAR')";
			//echo $qalta;
			mysql_query($qalta);
			echo "<script>document.alta_demarcador.validTarj.value=0;document.alta_demarcador.submit();</script>";
	
		}
		else
		{	
			$cadena="tipo_equipo=$tipo_equipo&&clliAdva=$clli_adva&&repisat=$repisat&&modeloTarjeta=".rawurlencode($modelo_tarjeta)."&&slot=$slot_duo&&division=$division&&pag=altas_demarcador";
			echo "<script>window.open('puertos_demarcadores.php?".$cadena."','_blank','toolbar=0,height=400,scrollbars=yes,width=1000' );</script>";
		}
	}
}
//-------------------------------------------------> BAJA DE LAS TARJETAS DEL EQUIPO 
if ($bajatj==1)
{
	
		$qTj="select repisat,modelo_tarjeta,slot from inventario_tarjetas_demarcadores where id=$idTj";
		$resTj=mysql_query($qTj);
		$rowTj=mysql_fetch_row($resTj);
	
		$qbaja2="delete  from inventario_puertos_demarcadores where clli_adva='$clli_adva' and repisat='".$rowTj[0]."' and modelo_tarjeta='".$rowTj[1]."' 
		and slot='".$rowTj[2]."' ";
		//echo "Baja de Puertos de la Tarjeta: ".$qbaja2;
		mysql_query($qbaja2);
		  
		$qbaja="delete  from inventario_tarjetas_demarcadores where clli_adva='$clli_adva' and id='$idTj'";
		//echo "Baja de Tarjetas: ".$qbaja."<br>";
		mysql_query($qbaja);

		echo "<script>document.alta_demarcador.bajatj.value=0;document.alta_demarcador.submit();</script>";
}
//-------------------------------------------------> ALTA DE LOS PUERTOS DEL EQUIPO 
if ($altapto==1)
{       
if($aplica_tarjeta=="NO")
$modPto="N/A";

$query_cap="select capacidad_puerto from cat_puertos_ce where tipo_equipo='$tipo_equipo' and nombre_puerto='$puerto'";
$res_cap=mysql_query($query_cap);
$row_cap=mysql_fetch_array($res_cap);
$capacidad_puerto=$row_cap['capacidad_puerto'];

$qaltapto="insert into inventario_puertos_demarcadores 			
          (clli_adva,division,tipo_equipo,modelo_tarjeta,repisat,slot,puerto,tipo_puerto,capacidad_puerto,
		   ubicacion_bdfo,repisa_bdfo,contacto_bdfo,fecha_alta,login,estatus,gestionada,tipo_jumper,long_jumper,tipo_conector,tipo_bdfo,
		   tipo_dfo,tipo_conector_dfo,p_monitoreo) 
		  values 
		  ('$clli_adva','$division','$tipo_equipo','$modPto','$repPto','$slotPto','$puerto','$tipo_puertoPri',
		   '$capacidad_puerto','$ubicacion_bdfo1','$repisa_bdfo1','$contacto_bdfo1',NOW(),'".$sess_usr."','DISPONIBLE',
		   'NO GESTIONADO','$tipo_jumper1','$long_jumper1','$tipo_conector1','$tipo_bdfo1','$tipo_dfo1','$tipo_conectorDfo1','$p_monitoreo1')";
		  //echo $qaltapto;
		  mysql_query($qaltapto);
		  
		if($aplica_tarjeta=="NO")
		{
			echo "<script>document.alta_demarcador.altapto.value=0;
			document.alta_demarcador.modPto.value='$modPto';
			document.alta_demarcador.slotPto.value='$slotPto';
			document.alta_demarcador.repPto.value='$repPto';
			document.alta_demarcador.submit();</script>";
		}
		else
		{
			echo "<script>document.alta_demarcador.altapto.value=0;
			document.alta_demarcador.modPto.value='$modPto';
			document.alta_demarcador.slotPto.value='$slotPto';
			document.alta_demarcador.repPto.value='$repPto';
			document.alta_demarcador.verpuertos.value=1;document.alta_demarcador.submit();</script>";
		}
}
//-------------------------------------------------> ACTUALIZACION DE LOS PUERTOS DEL EQUIPO 
if ($updpto==1)
{       	

$qupdpto="UPDATE inventario_puertos_demarcadores set tipo_puerto='$tipo_puerto[$save]',
    ubicacion_bdfo='$ubicacion_bdfo[$save]',repisa_bdfo='$repisa_bdfo[$save]',contacto_bdfo='$contacto_bdfo[$save]',
	tipo_jumper='$tipo_jumper[$save]',long_jumper='$long_jumper[$save]',tipo_conector='$tipo_conector[$save]',
	tipo_dfo ='$tipo_dfo[$save]',tipo_bdfo='$tipo_bdfo[$save]',tipo_conector_dfo='$tipo_conectorDfo[$save]',p_monitoreo='$p_monitoreo[$save]' 
	where id='$idupd'";
	//echo $qupdpto; 
    mysql_query($qupdpto);
	
	if($aplica_tarjeta=="NO")
	{
		echo "<script>document.alta_demarcador.updpto.value=0;
		document.alta_demarcador.modPto.value='$modPto';
		document.alta_demarcador.slotPto.value='$slotPto';
		document.alta_demarcador.repPto.value='$repPto';
		document.alta_demarcador.submit();</script>";
	}
	else
	{
		echo "<script>document.alta_demarcador.updpto.value=0;document.alta_demarcador.verpuertos.value=1;
		document.alta_demarcador.modPto.value='$modPto';
		document.alta_demarcador.slotPto.value='$slotPto';
		document.alta_demarcador.repPto.value='$repPto';
		document.alta_demarcador.submit();</script>";
	}

}
//-------------------------------------------------> ELIMINACION DE LOS PUERTOS DEL EQUIPO 
if ($bajapto==1)
{       
		$qdelpto="delete from inventario_puertos_demarcadores where  id='$idupd'";
		//echo $qdelpto;
		mysql_query($qdelpto);

	if($aplica_tarjeta=="NO")
	{
		echo "<script>document.alta_demarcador.bajapto.value=0;
		document.alta_demarcador.modPto.value='$modPto';
		document.alta_demarcador.slotPto.value='$slotPto';
		document.alta_demarcador.repPto.value='$repPto';
		document.alta_demarcador.submit();</script>";
	}
	else
	{
		echo "<script>document.alta_demarcador.bajapto.value=0;document.alta_demarcador.verpuertos.value=1;
		document.alta_demarcador.modPto.value='$modPto';
		document.alta_demarcador.slotPto.value='$slotPto';
		document.alta_demarcador.repPto.value='$repPto';
		document.alta_demarcador.submit();</script>";
	}
}
//-------------------------------------------------> QUERY PARA REPLICAR DATOS DE LOS PUERTOS 
if($replicaDatos==1)
{
	if($replicaTipo!="")
	$campos[]="tipo_puerto='".$replicaTipo."'";
	if($replicaUbicacion!="")
	$campos[]="ubicacion_bdfo='".$replicaUbicacion."'";
	if($replicaRepisa!="")
	$campos[]="repisa_bdfo='".$replicaRepisa."'";
	if($replicaConector!="")
	$campos[]="tipo_conector='".$replicaConector."'";
	if($replicaLong!="")
	$campos[]="long_jumper='".$replicaLong."'";
	if($replicaJumper!="")
	$campos[]="tipo_jumper='".$replicaJumper."'";	
	if($replicaBdfo!="")
	$campos[]="tipo_bdfo='".$replicaBdfo."'";
	if($replicaDfo!="")
	$campos[]="tipo_dfo='".$replicaDfo."'";
	if($replicaConectorDfo!="")
	$campos[]="tipo_conector_dfo='".$replicaConectorDfo."'";
	
	
	if($replicaContacto!="" && count($campos)!=0)
	{
		$queryPto2="select puerto from inventario_puertos_demarcadores where clli_adva='$clli_adva' order by length(puerto),puerto";
		$resPto2=mysql_query($queryPto2);
		$numPto2=mysql_num_rows($resPto2);
		
		for($i=0;$i<$numPto2;$i++)
		{
			$rowPto2=mysql_fetch_row($resPto2);	
					
			#if($tipo_equipo=="1531 CLAS")	
			#$contacto=intval($replicaContacto)."-".(intval($replicaContacto)+1);	
			#else	
			$contacto=intval($replicaContacto);	
			$where = implode(',', $campos);
			
			if($tipo_equipo=="1531 CLAS")
			{			
				$queryReplCont="update inventario_puertos_demarcadores  set contacto_bdfo='".$contacto."',$where 
				where clli_adva='$clli_adva' and puerto='".$rowPto2[0]."' and puerto<>'Universal I/O slot Port 1 (WAN)'";
				//echo $queryReplCont."<br>";
				mysql_query($queryReplCont);
			}else
			{
				$queryReplCont="update inventario_puertos_demarcadores  set contacto_bdfo='".$contacto."',$where 
				where clli_adva='$clli_adva' and puerto='".$rowPto2[0]."'";
				//echo $queryReplCont."<br>";
				mysql_query($queryReplCont);
			}
			
			#if($tipo_equipo=="1531 CLAS")
			#$replicaContacto+=2;
			#else
			$replicaContacto+=1;
		}
	}elseif($replicaContacto!="" && count($campos)==0)
	{
		$queryPto2="select puerto from inventario_puertos_demarcadores where clli_adva='$clli_adva' order by length(puerto),puerto";
		$resPto2=mysql_query($queryPto2);
		$numPto2=mysql_num_rows($resPto2);
		
		for($i=0;$i<$numPto2;$i++)
		{
			$rowPto2=mysql_fetch_row($resPto2);	
			
			#if($tipo_equipo=="1531 CLAS")	
			#$contacto=intval($replicaContacto)."-".(intval($replicaContacto)+1);	
			#else	
			$contacto=intval($replicaContacto);
			
			if($tipo_equipo=="1531 CLAS")
			{
				$queryReplCont="update inventario_puertos_demarcadores  set contacto_bdfo='".$contacto."' 
				where clli_adva='$clli_adva' and puerto='".$rowPto2[0]."' and puerto<>'Universal I/O slot Port 1 (WAN)'";
				//echo $queryReplCont."<br>";
				mysql_query($queryReplCont);
			}else
			{
				$queryReplCont="update inventario_puertos_demarcadores  set contacto_bdfo='".$contacto."' 
				where clli_adva='$clli_adva' and puerto='".$rowPto2[0]."'";
				//echo $queryReplCont."<br>";
				mysql_query($queryReplCont);
			}
			#if($tipo_equipo=="1531 CLAS")
			#$replicaContacto+=2;
			#else
			$replicaContacto+=1;
		}
	}elseif(count($campos)>0&&$replicaContacto=="")
	{
			$where = implode(',', $campos);
				
			if($tipo_equipo=="1531 CLAS")
			{	
				$queryReplica="update inventario_puertos_demarcadores  set $where where clli_adva='$clli_adva' and puerto<>'Universal I/O slot Port 1 (WAN)'";
				//echo $queryReplica."<br>";
				mysql_query($queryReplica);
			}else
			{	
				$queryReplica="update inventario_puertos_demarcadores  set $where where clli_adva='$clli_adva'";
				//echo $queryReplica."<br>";
				mysql_query($queryReplica);
			}
	}
	else
	{echo "<script>alert('Campos no Seleccionados');</script>";}

	echo "<script>document.alta_demarcador.replicaDatos.value=0;document.alta_demarcador.submit();</script>";
}
//-------------------------------------------------> RESERVA PUERTO DEL CLIENTE NDE 
if($reservaCliente==1)
{
		
		if($clase_servicio=="IDE"||$clase_servicio=="RPV"||$clase_servicio=="IDE/RPV")			$tabla="servicios_ide";
		if($clase_servicio=="L2" or $clase_servicio=="NEXTEL" or $clase_servicio=="TELCEL")		$tabla="servicios_l2";
		if($clase_servicio=="CD SEGURA")														$tabla="ciudad_segura";


		if($aplicaSecundario=="SI")	$usoPto="CLIENTE-PRIMARIO";
		else						$usoPto="CLIENTE";
			
		if($tipo_equipo2!="1531 CLAS")
		{
			if($puertoRx!="")
			{
				
				$query_act="update inventario_demarcadores set tunel='".trim($tunel)."' where clli_adva='$clli_adva'";
				//echo $query_act;
				mysql_query($query_act);
				
				$id_puerto_fisico_pto="AL-".$clli_adva."-".$tipo_demarcador."-".$modCorto."-".$puerto_trans;
				if($aplica_tarjeta2=="SI")
				{
					$ptoA=explode("/",$puertoRx);	
					$repisa		=$ptoA[0];
					$slot		=$ptoA[1];
					$puertoTA	=$ptoA[2];		
					
					if($clase_servicio=="CD SEGURA")
					{
						$query_invptoRx="update inventario_puertos_demarcadores set 
						id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',tabla='$tabla',uso_puerto='$usoPto',
						nombre_oficial_pisa='$clli_adva',tipo_servicio='GESTION',
						ref_sisa_infra='$ref_sisa',nomof=CONCAT('$refSisaPto1',',','$ref_sisa',',',nomof) 
						where clli_adva='$tunel' and repisat='$repisa' and slot='$slot' and puerto='$puertoTA'";
					}else
					{
						$query_invptoRx="update inventario_puertos_demarcadores set 
						id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',tabla='$tabla',uso_puerto='$usoPto',
						nombre_oficial_pisa='$clli_adva',tipo_servicio='GESTION' 
						where clli_adva='$tunel' and repisat='$repisa' and slot='$slot' and puerto='$puertoTA'";
						
					}
				}
				else
				{
					if($clase_servicio=="CD SEGURA")
					{
						$query_invptoRx="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',
						tabla='$tabla',uso_puerto='$usoPto',nombre_oficial_pisa='$clli_adva',tipo_servicio='GESTION',
						ref_sisa_infra='$ref_sisa',nomof=CONCAT('$refSisaPto1',',','$ref_sisa',',',nomof)	 
						where clli_adva='$tunel' and puerto='$puertoRx'";
					}
					else
					{
						$query_invptoRx="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',
						tabla='$tabla',uso_puerto='$usoPto',nombre_oficial_pisa='$clli_adva',tipo_servicio='GESTION'	 
						where clli_adva='$tunel' and puerto='$puertoRx'";
						
					}
				}		
				//echo $query_invptoRx;	
				mysql_query($query_invptoRx);
				
				if($clase_servicio=="CD SEGURA")
				{

					$queryNomof="select * from inventario_demarcadores where clli_adva='$tunel'";
					$resNomof=mysql_query($queryNomof);
					$rowNomof=mysql_fetch_array($resNomof);
					
					$nomO=explode(",",$rowNomof['nomof']);
					$refS=$refSisaPto1."-A";
					if (!in_array($refS,$nomO))
					{
						$queryNom="update inventario_demarcadores set nomof=CONCAT('$refSisaPto1','-A,',nomof) where clli_adva='$tunel'";
						mysql_query($queryNom);	
					}	
					
					$queryCd="update inventario_infra set
					clli_adva='$tunel',central_adva='$central2',modelo_adva='$tipo_equipo2',tipo_demarcador='$tipo_demarcador2',vlan_gestion='$vlan2',
					clli_adva2='$clli_adva',central_adva2='$central',modelo_adva2='$tipo_equipo',tipo_demarcador2='$tipo_demarcador',vlan_gestion2='$vlan'
					where ref_sisa_infra='$ref_sisa'";
					//echo $queryCd;
					mysql_query($queryCd);				
					
									
				}
				echo "<script>alert('Puerto Primario Reservado');document.alta_demarcador.reservaCliente.value=0;document.alta_demarcador.submit();</script>";
			}else
			{echo "<script>alert('Falta Puerto Primario');</script>";}
		}
		else
		{
			
			if($puertosRx!="")
			{
				$query_act="update inventario_demarcadores set tunel='".trim($tunel)."' where clli_adva='$clli_adva'";
				//echo $query_act;
				mysql_query($query_act);
				
				$ptoTx=implode("|",$puerto_trans);
				$id_puerto_fisico_pto="AL-".$clli_adva."-".$tipo_demarcador."-".$modCorto."-".$ptoTx;
				for($i=0;$i<count($puertosRx);$i++)
				{
					if($clase_servicio=="CD SEGURA")
					{
					$query_invptoRx="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',
							tabla='$tabla',nombre_oficial_pisa='$clli_adva',uso_puerto='$usoPto',tipo_servicio='GESTION',lado='A',
							ref_sisa_infra='$ref_sisa',nomof=CONCAT('$refSisaPto1',',','$ref_sisa',',',nomof)	
							where clli_adva='$tunel' and puerto='$puertosRx[$i]'";
							//echo $query_invptoRx;
							mysql_query($query_invptoRx);
					}else
					{
					$query_invptoRx="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',
							tabla='$tabla',nombre_oficial_pisa='$clli_adva',uso_puerto='$usoPto',tipo_servicio='GESTION'	
							where clli_adva='$tunel' and puerto='$puertosRx[$i]'";
							//echo $query_invptoRx;
							mysql_query($query_invptoRx);						
					}
				}
				
				if($clase_servicio=="CD SEGURA")
				{
					
					$queryNomof="select * from inventario_demarcadores where clli_adva='$tunel'";
					$resNomof=mysql_query($queryNomof);
					$rowNomof=mysql_fetch_array($resNomof);
					
					$nomO=explode(",",$rowNomof['nomof']);
					$refS=$refSisaPto1."-A";
					if (!in_array($refS,$nomO))
					{
						$queryNom="update inventario_demarcadores set nomof=CONCAT('$refSisaPto1','-A,',nomof) where clli_adva='$tunel'";
						mysql_query($queryNom);	
					}	
					
					$queryCd="update inventario_infra set
					clli_adva='$tunel',central_adva='$central2',modelo_adva='$tipo_equipo2',tipo_demarcador='$tipo_demarcador2',vlan_gestion='$vlan2',
					clli_adva2='$clli_adva',central_adva2='$central',modelo_adva2='$tipo_equipo',tipo_demarcador2='$tipo_demarcador',vlan_gestion2='$vlan'
					where ref_sisa_infra='$ref_sisa'";
					//echo $queryCd;
					mysql_query($queryCd);				
				}

			echo "<script>alert('Pares Reservados');document.alta_demarcador.reservaCliente.value=0;document.alta_demarcador.submit();</script>";
			}else
			{echo "<script>alert('Falta Seleccionar Pares');</script>";}
		}
}
//-------------------------------------------------> RESERVA PUERTO SECUNDARIO DEL CLIENTE NDE 
if($reservaCliente2==1)
{
	
	if($clase_servicio=="IDE"||$clase_servicio=="RPV"||$clase_servicio=="IDE/RPV")			$tabla="servicios_ide";
	if($clase_servicio=="L2" or $clase_servicio=="NEXTEL" or $clase_servicio=="TELCEL")		$tabla="servicios_l2";
	if($clase_servicio=="CD SEGURA")														$tabla="ciudad_segura";
	
	if($puertoRxSec!="")
	{	
			$id_puerto_fisico_pto="AL-".$clli_adva."-".$tipo_demarcador."-".$modCorto."-".$puerto_trans2;
			if($aplica_tarjeta2=="SI")
			{
				$ptoA=explode("/",$puertoRxSec);	
				$repisa			=$ptoA[0];
				$slot			=$ptoA[1];
				$puertoTA		=$ptoA[2];		
					
				if($clase_servicio=="CD SEGURA")
				{
					$query_invptoRx="update inventario_puertos_demarcadores set 
					id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',tabla='$tabla',uso_puerto='CLIENTE-SECUNDARIO',
					nombre_oficial_pisa='$clli_adva',tipo_servicio='GESTION',
					ref_sisa_infra='$ref_sisa',nomof=CONCAT('$refSisaPto1',',','$ref_sisa',',',nomof) 
					where clli_adva='$tunel' and repisat='$repisa' and slot='$slot' and puerto='$puertoTA'";
				}else
				{
					$query_invptoRx="update inventario_puertos_demarcadores set 
					id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',tabla='$tabla',uso_puerto='CLIENTE-SECUNDARIO',
					nombre_oficial_pisa='$clli_adva',tipo_servicio='GESTION' 
					where clli_adva='$tunel' and repisat='$repisa' and slot='$slot' and puerto='$puertoTA'";
				}
			}
			else
			{
				if($clase_servicio=="CD SEGURA")
				{
					$query_invptoRx="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',
					tabla='$tabla',uso_puerto='CLIENTE-SECUNDARIO',nombre_oficial_pisa='$clli_adva',tipo_servicio='GESTION',
					ref_sisa_infra='$ref_sisa',nomof=CONCAT('$refSisaPto1',',','$ref_sisa',',',nomof)	 
					where clli_adva='$tunel' and puerto='$puertoRxSec'";
				}else
				{
					$query_invptoRx="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',
					tabla='$tabla',uso_puerto='CLIENTE-SECUNDARIO',nombre_oficial_pisa='$clli_adva',tipo_servicio='GESTION'	 
					where clli_adva='$tunel' and puerto='$puertoRxSec'";
				}
			}			
			mysql_query($query_invptoRx);	
				
			if($clase_servicio=="CD SEGURA")
				{

					$queryNomof="select * from inventario_demarcadores where clli_adva='$tunel'";
					$resNomof=mysql_query($queryNomof);
					$rowNomof=mysql_fetch_array($resNomof);
					
					$nomO=explode(",",$rowNomof['nomof']);
					$refS=$refSisaPto1."-A";
					if (!in_array($refS,$nomO))
					{
						$queryNom="update inventario_demarcadores set nomof=CONCAT('$refSisaPto1','-A,',nomof) where clli_adva='$tunel'";
						mysql_query($queryNom);	
					}					
				}
		echo "<script>alert('Puerto Secundario Reservado');document.alta_demarcador.reservaCliente2.value=0;document.alta_demarcador.submit();</script>";
	}
	else
	{echo "<script>alert('Falta Puerto Secundario');</script>>";}
}
//-------------------------------------------------> RESERVA PUERTO RESPALDO DEL CLIENTE NDE 
if($reservaCliente3==1)
{
	
	if($clase_servicio=="IDE"||$clase_servicio=="RPV"||$clase_servicio=="IDE/RPV")			$tabla="servicios_ide";
	if($clase_servicio=="L2" or $clase_servicio=="NEXTEL" or $clase_servicio=="TELCEL")		$tabla="servicios_l2";
	if($clase_servicio=="CD SEGURA")														$tabla="ciudad_segura";
					
			if($puertoRxR!="")
			{
				$query_act="update inventario_demarcadores set tunelResp='$tunelResp' where clli_adva='$clli_adva'";
				//echo $query_act;
				mysql_query($query_act);

				$id_puerto_fisico_pto="AL-".$clli_adva."-".$tipo_demarcador."-".$modCorto."-".$puerto_transR;
				if($aplica_tarjeta3=="SI")
				{
					$ptoA=explode("/",$puertoRxR);	
					$repisa		=$ptoA[0];
					$slot		=$ptoA[1];
					$puertoTA	=$ptoA[2];		
							
					$query_invptoRx="update inventario_puertos_demarcadores set 
					id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',tabla='$tabla',uso_puerto='CLIENTE',
					nombre_oficial_pisa='$clli_adva',tipo_servicio='RESPALDO' 
					where clli_adva='$tunelResp' and repisat='$repisa' and slot='$slot' and puerto='$puertoTA'";	
				}
				else
				{
					$query_invptoRx="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',
					tabla='$tabla',uso_puerto='CLIENTE',nombre_oficial_pisa='$clli_adva',tipo_servicio='RESPALDO'	 
					where clli_adva='$tunelResp' and puerto='$puertoRxR'";
				}		
				//echo $query_invptoRx;	
				mysql_query($query_invptoRx);	
				
				
				if($puerto_transR!="")
				{
					$id_puerto_fisico_pto1="AL-".$tunelResp."-".$tipo_demarcador3."-".$modCorto3."-".$puertoRxR;
					if($aplica_tarjeta=="SI")
					{
						$ptoA=explode("/",$puerto_transR);	
						$repisa		=$ptoA[0];
						$slot		=$ptoA[1];
						$puertoTA	=$ptoA[2];		
								
						$query_invptoTx2="update inventario_puertos_demarcadores set 
						id_puerto_fisico='$id_puerto_fisico_pto1' where clli_adva='$clli_adva' and repisat='$repisa' and slot='$slot' and puerto='$puertoTA'";	
					}
					else
					{
						$query_invptoTx2="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto1'
						where clli_adva='$clli_adva' and puerto='$puerto_transR'";
					}
					//echo $query_invptoA;
					mysql_query($query_invptoTx2);
				}
				
				echo "<script>alert('Puerto del Cliente Reservado');document.alta_demarcador.reservaCliente3.value=0;document.alta_demarcador.submit();</script>";
			}
			else
			{echo "<script>alert('Falta Puerto del equipo NDE');</script>>";}
}
//-------------------------------------------------> RESERVA PUERTO DEL TRANSPORTE  DDE 
if($reservatx==1)
{
	if($clase_servicio=="IDE"||$clase_servicio=="RPV"||$clase_servicio=="IDE/RPV")			$tabla="servicios_ide";
	if($clase_servicio=="L2" or $clase_servicio=="NEXTEL" or $clase_servicio=="TELCEL")		$tabla="servicios_l2";
	if($clase_servicio=="CD SEGURA")														$tabla="ciudad_segura";
		
	if($aplicaSecundario=="SI")	$usoPto="TX-PRIMARIO";
	else						$usoPto="TX";
		
		if($tipo_equipo!="1521 CLIP")
		{
			if($puerto_trans!="")
			{
				$id_puerto_fisico_pto="AL-".$tunel."-".$tipo_demarcador2."-".$modCorto2."-".$puertoRx;
				if($aplica_tarjeta=="SI")
				{
					$ptoA=explode("/",$puerto_trans);	
					$repisa		=$ptoA[0];
					$slot		=$ptoA[1];
					$puertoTA	=$ptoA[2];		
					
					if($clase_servicio=="CD SEGURA")
				    {
						$query_invptoTx2="update inventario_puertos_demarcadores set 
						id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',tabla='$tabla',uso_puerto='$usoPto',tipo_servicio='GESTION',
						nombre_oficial_pisa='$tunel',
						ref_sisa_infra='$ref_sisa',nomof=CONCAT('$refSisaPto1',',','$ref_sisa',',',nomof)
						where clli_adva='$clli_adva' and repisat='$repisa' and slot='$slot' and puerto='$puertoTA'";
					}else
					{
						$query_invptoTx2="update inventario_puertos_demarcadores set 
						id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',tabla='$tabla',uso_puerto='$usoPto',tipo_servicio='GESTION',
						nombre_oficial_pisa='$tunel' where clli_adva='$clli_adva' and repisat='$repisa' and slot='$slot' and puerto='$puertoTA'";
					}
						
				}
				else
				{
					if($clase_servicio=="CD SEGURA")
				    {
						$query_invptoTx2="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',
						tabla='$tabla',uso_puerto='$usoPto',nombre_oficial_pisa='$tunel',tipo_servicio='GESTION',
						ref_sisa_infra='$ref_sisa',nomof=CONCAT('$refSisaPto1',',','$ref_sisa',',',nomof)
						where clli_adva='$clli_adva' and puerto='$puerto_trans'";
					}else
					{
						$query_invptoTx2="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',
						tabla='$tabla',uso_puerto='$usoPto',nombre_oficial_pisa='$tunel',tipo_servicio='GESTION'
						where clli_adva='$clli_adva' and puerto='$puerto_trans'";
					}
				}
				//echo $query_invptoA;
				mysql_query($query_invptoTx2);
				
				if($clase_servicio=="CD SEGURA")
				{

					$queryNomof="select * from inventario_demarcadores where clli_adva='$clli_adva'";
					$resNomof=mysql_query($queryNomof);
					$rowNomof=mysql_fetch_array($resNomof);
					
					$nomO=explode(",",$rowNomof['nomof']);
					$refS=$refSisaPto1."-A";
					
					if(!in_array($refS,$nomO))
					{
						$queryNom="update inventario_demarcadores set nomof=CONCAT('$refSisaPto1','-A,',nomof) where clli_adva='$clli_adva'";
						mysql_query($queryNom);	
					}					
				}				
				
				echo "<script>alert('Puerto Primario Reservado');document.alta_demarcador.reservatx.value=0;document.alta_demarcador.submit();</script>";
			}else
			{echo "<script>alert('Falta Puerto Primario');</script>";}
		}else
		{
			if($puertotrans!="")
			{
				$ptosCl=implode("|",$puertoRx);
				$id_puerto_fisico_pto="AL-".$tunel."-".$tipo_demarcador2."-".$modCorto2."-".$ptosCl;
				for($i=0;$i<count($puertotrans);$i++)
				{
					if($clase_servicio=="CD SEGURA")
					{
					$query_invptoTx="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',
							tabla='$tabla',nombre_oficial_pisa='$tunel',uso_puerto='$usoPto',tipo_servicio='GESTION',lado='A',
							ref_sisa_infra='$ref_sisa',nomof=CONCAT('$refSisaPto1',',','$ref_sisa',',',nomof)	
							where clli_adva='$clli_adva' and puerto='$puertotrans[$i]'";
							//echo $query_invptoTx;
							mysql_query($query_invptoTx);
					}else
					{
					$query_invptoTx="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',
							tabla='$tabla',nombre_oficial_pisa='$tunel',uso_puerto='$usoPto',tipo_servicio='GESTION'	
							where clli_adva='$clli_adva' and puerto='$puertotrans[$i]'";
							//echo $query_invptoTx;
							mysql_query($query_invptoTx);
					}
				}
				
				if($clase_servicio=="CD SEGURA")
				{

					$queryNomof="select * from inventario_demarcadores where clli_adva='$clli_adva'";
					$resNomof=mysql_query($queryNomof);
					$rowNomof=mysql_fetch_array($resNomof);
					
					$nomO=explode(",",$rowNomof['nomof']);
					$refS=$refSisaPto1."-A";
					
					if(!in_array($refS,$nomO))
					{
						$queryNom="update inventario_demarcadores set nomof=CONCAT('$refSisaPto1','-A,',nomof) where clli_adva='$clli_adva'";
						mysql_query($queryNom);	
					}					
				}
				
				echo "<script>alert('Pares Reservados');document.alta_demarcador.reservatx.value=0;document.alta_demarcador.submit();</script>";
			}else
			{echo "<script>alert('Falta Seleccionar Pares');</script>";}

		}
}
//-------------------------------------------------> RESERVA PUERTO SECUNDARIO DEL TRANSPORTE  DDE 
if($reservatx2==1)
{
	if($clase_servicio=="IDE"||$clase_servicio=="RPV"||$clase_servicio=="IDE/RPV")			$tabla="servicios_ide";
	if($clase_servicio=="L2" or $clase_servicio=="NEXTEL" or $clase_servicio=="TELCEL")		$tabla="servicios_l2";
	if($clase_servicio=="CD SEGURA")														$tabla="ciudad_segura";			
		
	if($puerto_trans2!="")
	{	
		
			$id_puerto_fisico_pto="AL-".$tunel."-".$tipo_demarcador2."-".$modCorto2."-".$puertoRxSec;
		    if($aplica_tarjeta=="SI")
			{
				$ptoA=explode("/",$puerto_trans2);	
				$repisa				=$ptoA[0];
				$slot				=$ptoA[1];
				$puertoTA			=$ptoA[2];		
				
				if($clase_servicio=="CD SEGURA")
				{		
					$query_invptoTx2="update inventario_puertos_demarcadores set 
					id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',tabla='$tabla',uso_puerto='TX-SECUNDARIO',tipo_servicio='GESTION',
					nombre_oficial_pisa='$tunel',ref_sisa_infra='$ref_sisa',nomof=CONCAT('$refSisaPto1',',','$ref_sisa',',',nomof)
					where clli_adva='$clli_adva' and repisat='$repisa' and slot='$slot' and puerto='$puertoTA'";
				}else
				{
					$query_invptoTx2="update inventario_puertos_demarcadores set 
					id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',tabla='$tabla',uso_puerto='TX-SECUNDARIO',tipo_servicio='GESTION',
					nombre_oficial_pisa='$tunel' where clli_adva='$clli_adva' and repisat='$repisa' and slot='$slot' and puerto='$puertoTA'";				
				}
			}
			else
			{
				if($clase_servicio=="CD SEGURA")
				{		
					$query_invptoTx2="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',
					tabla='$tabla',uso_puerto='TX-SECUNDARIO',nombre_oficial_pisa='$tunel',tipo_servicio='GESTION',
					ref_sisa_infra='$ref_sisa',nomof=CONCAT('$refSisaPto1',',','$ref_sisa',',',nomof)
					where clli_adva='$clli_adva' and puerto='$puerto_trans2'";
				}else
				{
					$query_invptoTx2="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',
					tabla='$tabla',uso_puerto='TX-SECUNDARIO',nombre_oficial_pisa='$tunel',tipo_servicio='GESTION'
					where clli_adva='$clli_adva' and puerto='$puerto_trans2'";	
				}
			}
			//echo $query_invptoA;
			mysql_query($query_invptoTx2);
			
			if($clase_servicio=="CD SEGURA")
			{

					$queryNomof="select * from inventario_demarcadores where clli_adva='$clli_adva'";
					$resNomof=mysql_query($queryNomof);
					$rowNomof=mysql_fetch_array($resNomof);
					
					$nomO=explode(",",$rowNomof['nomof']);
					$refS=$refSisaPto1."-A";
					
					if(!in_array($refS,$nomO))
					{
						$queryNom="update inventario_demarcadores set nomof=CONCAT('$refSisaPto1','-A,',nomof) where clli_adva='$clli_adva'";
						mysql_query($queryNom);	
					}					
			}			
			
		    echo "<script>alert('Puerto Secundario Reservado');document.alta_demarcador.reservatx2.value=0;document.alta_demarcador.submit();</script>";
	}else
	{echo "<script>alert('Falta Puerto Secundario');</script>";}	
}
//-------------------------------------------------> RESERVA PUERTO DEL TRANSPORTE RESPALDO DDE 
if($reservatx3==1)
{
	if($clase_servicio=="IDE"||$clase_servicio=="RPV"||$clase_servicio=="IDE/RPV")			$tabla="servicios_ide";
	if($clase_servicio=="L2" or $clase_servicio=="NEXTEL" or $clase_servicio=="TELCEL")		$tabla="servicios_l2";
	if($clase_servicio=="CD SEGURA")														$tabla="ciudad_segura";
		
				
			if($puerto_transR!="")
			{
				$id_puerto_fisico_pto="AL-".$tunelResp."-".$tipo_demarcador3."-".$modCorto3."-".$puertoRxR;
				if($aplica_tarjeta=="SI")
				{
					$ptoA=explode("/",$puerto_transR);	
					$repisa		=$ptoA[0];
					$slot		=$ptoA[1];
					$puertoTA	=$ptoA[2];		
							
					$query_invptoTx2="update inventario_puertos_demarcadores set 
					id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',tabla='$tabla',uso_puerto='TX',tipo_servicio='RESPALDO',
					nombre_oficial_pisa='$tunelResp' where clli_adva='$clli_adva' and repisat='$repisa' and slot='$slot' and puerto='$puertoTA'";	
				}
				else
				{
					$query_invptoTx2="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',
						tabla='$tabla',uso_puerto='TX',nombre_oficial_pisa='$tunelResp',tipo_servicio='RESPALDO'
						where clli_adva='$clli_adva' and puerto='$puerto_transR'";
				}
				//echo $query_invptoA;
				mysql_query($query_invptoTx2);


				if($puertoRxR!="")
				{
					$id_puerto_fisico_pto1="AL-".$clli_adva."-".$tipo_demarcador."-".$modCorto."-".$puerto_transR;
					if($aplica_tarjeta3=="SI")
					{
						$ptoA=explode("/",$puertoRxR);	
						$repisa		=$ptoA[0];
						$slot		=$ptoA[1];
						$puertoTA	=$ptoA[2];		
								
						$query_invptoRx="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto1' 
						where clli_adva='$tunelResp' and repisat='$repisa' and slot='$slot' and puerto='$puertoTA'";	
					}
					else
					{
						$query_invptoRx="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto1' 
						where clli_adva='$tunelResp' and puerto='$puertoRxR'";
					}		
					//echo $query_invptoRx;	
					mysql_query($query_invptoRx);
				}

				echo "<script>alert('Puerto del Tx Reservado');document.alta_demarcador.reservatx3.value=0;document.alta_demarcador.submit();</script>";
			}else
			{echo "<script>alert('Falta Puerto Trasnporte');</script>";}
}
//-------------------------------------------------> RESERVA PUERTO DEL SERVICIO  DDE 
if($reservaServicio==1)
{
	if($clase_servicio=="IDE"||$clase_servicio=="RPV"||$clase_servicio=="IDE/RPV")			$tabla="servicios_ide";
	if($clase_servicio=="L2" or $clase_servicio=="NEXTEL" or $clase_servicio=="TELCEL")		$tabla="servicios_l2";
	if($clase_servicio=="CD SEGURA")														$tabla="ciudad_segura";
	
	if($pto_clt_serv!="" and $refSisaPto!="")
	{
		
			if(($criticidad=="3B" or $criticidad=="3") and $tipo_equipo=="1521 CLIP")
			{echo "<script>alert('La Criticidad $criticidad de esta Ref. No es Valida');</script>";}
			else
			{
				$queryCrti="select * from serviciosInform where ref_sisa='$refSisaPto'";
				$resCrti=mysql_query($queryCrti);
				$rowCrti=mysql_fetch_array($resCrti);
				$crit=$rowCrti['criticidad'];	
							
				if($aplica_tarjeta=="SI")
				{
					$ptoA=explode("/",$pto_clt_serv);	
					$repisa		=$ptoA[0];
					$slot		=$ptoA[1];
					$puertoTA	=$ptoA[2];	
					
					$queryCltServ="update inventario_puertos_demarcadores set 
					id_puerto_fisico='',estatus='RESERVADO',tabla='$tabla',uso_puerto='SERVICIO',tipo_servicio='SERVICIO',fecha_asignacion=NOW(),
					nombre_oficial_pisa='$refSisaPto',criticidad='$crit' 
					where clli_adva='$clli_adva' and repisat='$repisa' and slot='$slot' and puerto='$puertoTA'";	
					//echo $query_invptoA;
				}
				else
				{
					$queryCltServ="update inventario_puertos_demarcadores set id_puerto_fisico='',estatus='RESERVADO',fecha_asignacion=NOW(),
					tabla='$tabla',nombre_oficial_pisa='$refSisaPto',uso_puerto='SERVICIO',tipo_servicio='SERVICIO',criticidad='$crit'
					where clli_adva='$clli_adva' and puerto='$pto_clt_serv'";
				}
				//echo $queryCltServ;
				mysql_query($queryCltServ);	
				echo "<script>alert('Puerto del Servicio Reservado');document.alta_demarcador.reservaServicio.value=0;document.alta_demarcador.submit();</script>";
			}
	}
	else
	{echo "<script>alert('Falta Ref. Sisa del Servicio');</script>";}
}
//-------------------------------------------------> RESERVA PUERTOS DE ACCESO 
if($reservaDemarcador==1)
{
	if($puerto_dem=="")
	{echo "<script>alert('Faltas Puerto');</script>";}
	else
	{	
		$nomofDem=$clli_adva."_WIMAX";
		$id_puerto_fisico_pto="AL-".$id_nodo_acceso."-".$puerto_acceso;
		
		$queryPtoDemarcador="update inventario_puertos_demarcadores set
		id_puerto_fisico='$id_puerto_fisico_pto',estatus='RESERVADO',tabla='inventario_demarcadores',				
		uso_puerto='TX',nombre_oficial_pisa='$nomofDem',tipo_servicio='WIMAX'	 
		where clli_adva='$clli_adva' and puerto='$puerto_dem'";
		mysql_query($queryPtoDemarcador);
		
		$queryPtoDemarcador2="update inventario_demarcadores set ch_ptodem='OK'	 where clli_adva='$clli_adva' ";
		mysql_query($queryPtoDemarcador2);
		
		$mensaje="Se asigno el Puerto:".$puerto_dem.".";
		echo "<script>alert('".$mensaje."');document.alta_demarcador.reservaDemarcador.value=0;document.alta_demarcador.submit();</script>";
	}
}
//-------------------------------------------------> RESERVA PUERTOS DE ACCESO 
if($reservaDemarcador2==1)
{
	if($puerto_dem2=="")
	{echo "<script>alert('Faltas Puerto');</script>";}
	else
	{	
		$nomofDem=$clli_adva."_WIMAX";
		
		$queryPtoDemarcador="update inventario_puertos_demarcadores set
		estatus='RESERVADO',tabla='inventario_demarcadores',				
		uso_puerto='CLIENTE',nombre_oficial_pisa='$nomofDem',tipo_servicio='WIMAX'	 
		where clli_adva='$clli_adva' and puerto='$puerto_dem2'";
		mysql_query($queryPtoDemarcador);
		
		
		$mensaje="Se asigno el Puerto:".$puerto_dem2.".";
		echo "<script>alert('".$mensaje."');document.alta_demarcador.reservaDemarcador2.value=0;document.alta_demarcador.submit();</script>";
	}
}
//-------------------------------------------------> BORRA EL ESTATUS PARA SOLICITAR AMPLIACION
if($borrarEst==1)
{
		$query_estatus="update inventario_demarcadores set estatus_adva_exp='',estatus_adva='' where clli_adva='$clli_adva'";
		//echo $query_estatus;
		mysql_query($query_estatus);
		echo "<script>document.alta_demarcador.borrarEst.value=0;document.alta_demarcador.validarDemAmp.value=1;document.alta_demarcador.submit();</script>";
}
//-------------------------------------------------> QUERYS PARA VALIDAR DEMARCADORES 
if($validarDemAmp==1)
{
		$query_estatus="update inventario_demarcadores set estatus_adva_exp='POR REVISAR',trabajo='AMPLIACION',fecha_sol_exp=NOW(),
		observaciones_adva_exp=CONCAT(' |',NOW(),' (Usuario: ','$sess_nmb), ','Solicitud de Validacion. ','$descrip\\n',observaciones_adva_exp)
		where clli_adva='$clli_adva'";
		//echo $query_estatus;
		mysql_query($query_estatus);
		
		$mensaje='Se Envio la Solicitud de Validacion de Ampliacion';
		echo "<script>alert('".$mensaje."');document.alta_demarcador.validarDemAmp.value=0;document.alta_demarcador.submit();</script>";
}

if($validarDem==1)
{
	if($tipo_demarcador=="CONVERTIDOR DE MEDIOS")
	{
		$id_puerto_fisico_pto="AL-".$id_nodo_acceso."-".$puerto_acceso;
		$queryUp1="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto'  where clli_adva='$clli_adva'
		and puerto='$puerto_dem'";
		mysql_query($queryUp1);
		
		$id_puerto_acceso="AL-".$clli_adva."-".$modCorto."-".$tipo_equipo."-".$puerto_dem; 
		$queryUp2="update inventario_demarcadores set id_puerto_acceso='$id_puerto_acceso' where clli_adva='$clli_adva'";	
		mysql_query($queryUp2);
			
		if($descrip!="")
		{
			$query_estatus="update inventario_demarcadores set estatus_adva_exp='POR REVISAR',fecha_sol_exp=NOW(),
			observaciones_adva_exp=CONCAT(' |',NOW(),' (Usuario: ','$sess_nmb), ','Solicitud de Validacion. ','$descrip\\n',observaciones_adva_exp),
			observaciones=CONCAT(' |',NOW(),' (Usuario: ','$sess_nmb), ','Observaciones: ','$descrip\\n',observaciones)
			where clli_adva='$clli_adva'";
		}else
		{
			$query_estatus="update inventario_demarcadores set estatus_adva_exp='POR REVISAR',fecha_sol_exp=NOW(),
			observaciones_adva_exp=CONCAT(' |',NOW(),' (Usuario: ','$sess_nmb), ','Solicitud de Validacion. ','$descrip\\n',observaciones_adva_exp)
			where clli_adva='$clli_adva'";
		}
			//echo $query_estatus;
			mysql_query($query_estatus);
			$mensaje='Se Envio la Solicitud de Validacion';
			echo "<script>alert('".$mensaje."');document.alta_demarcador.validarDem.value=0;document.alta_demarcador.submit();</script>";
	}
	else
	{
		if($ip_demarcador=="")
		{echo "<script>alert('Faltan IP del Demarcador');</script>";}
		elseif($conexion_rcdt=="CONEXION DIRECTA A RCDT" and ($num_cambio=="PENDIENTE" or $num_cambio=="pendiente" or $num_cambio=="N/A" or $switc=="" or $pto=="" 
		or $num_cambio==""))
		{echo "<script>alert('Falta Datos de RCDT');</script>";}	
		elseif($conexion_rcdt=="POR TUNEL" and $tipo_equipo=="1521 CLIP" and ($puertoRx=="" or $puerto_trans==""))
		{echo "<script>alert('Falta Puertos a Asignar');</script>";}	
		elseif($conexion_rcdt=="POR TUNEL" and $tipo_equipo!="1521 CLIP" and ($puertoRx=="" or $puerto_trans==""))
		{echo "<script>alert('Falta Puertos a Asignar');</script>";}		
		else
		{
				//------------> PUERTO CLIENTE
					if($puertoRx!="")
					{	
							if($tipo_equipo2=="1531 CLAS")
							{
								$ptoTx=implode("|",$puerto_trans);
								$id_puerto_fisico_pto="AL-".$clli_adva."-".$tipo_demarcador."-".$modCorto."-".$ptoTx;
								for($i=0;$i<count($puertoRx);$i++)
								{
									$query_invptoRx="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto'
											where clli_adva='$tunel' and puerto='$puertoRx[$i]'";
											//echo $query_invptoRx;
											mysql_query($query_invptoRx);
								}
							}
							else
							{
								$id_puerto_fisico_pto="AL-".$clli_adva."-".$tipo_demarcador."-".$modCorto."-".$puerto_trans;
								if($aplica_tarjeta2=="SI")
								{
									$ptoA=explode("/",$puertoRx);	
									$repisa=$ptoA[0];
									$slot=$ptoA[1];
									$puertoTA=$ptoA[2];		
												
									$query_invptoRx="update inventario_puertos_demarcadores set 
									id_puerto_fisico='$id_puerto_fisico_pto'
									where clli_adva='$tunel' and repisat='$repisa' and slot='$slot' and puerto='$puertoTA'";	
									//echo $query_invptoA;
								}
								else
								{
									$query_invptoRx="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto'
									where clli_adva='$tunel' and puerto='$puertoRx'";
									 //echo $query_invptoA;
								}			
									mysql_query($query_invptoRx);	
							}
					}
					//------------> PUERTO CLIENTE SECUNDARIO
					if($puertoRxSec!="")
					{	
							$id_puerto_fisico_pto="AL-".$clli_adva."-".$tipo_demarcador."-".$modCorto."-".$puerto_trans2;
							if($aplica_tarjeta2=="SI")
							{
								$ptoA=explode("/",$puertoRxSec);	
								$repisa=$ptoA[0];
								$slot=$ptoA[1];
								$puertoTA=$ptoA[2];		
								
								$query_invptoRx="update inventario_puertos_demarcadores set 
								id_puerto_fisico='$id_puerto_fisico_pto'
								where clli_adva='$tunel' and repisat='$repisa' and slot='$slot' and puerto='$puertoTA'";	
								//echo $query_invptoA;
							}
							else
							{
								$query_invptoRx="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto'
								where clli_adva='$tunel' and puerto='$puertoRxSec'";
								//echo $query_invptoA;
							}			
								mysql_query($query_invptoRx);	
					}
					//---------------------->PUERTO TRANSPORTE
					if($puerto_trans!="" or $puertotrans!="")
					{	
							if($tipo_equipo=="1521 CLIP")
							{
								$ptosCl=implode("|",$puertoRx);
								$id_puerto_fisico_pto="AL-".$tunel."-".$tipo_demarcador2."-".$modCorto2."-".$ptosCl;
								for($i=0;$i<count($puertotrans);$i++)
								{
									$query_invptoTx="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto'
									where clli_adva='$clli_adva' and puerto='$puertotrans[$i]'";
									//echo $query_invptoTx;
									mysql_query($query_invptoTx);
								}
							}
							else
							{			
								$id_puerto_fisico_pto="AL-".$tunel."-".$tipo_demarcador2."-".$modCorto2."-".$puertoRx;
								if($aplica_tarjeta=="SI")
								{
									$ptoA=explode("/",$puerto_trans);	
									$repisa=$ptoA[0];
									$slot=$ptoA[1];
									$puertoTA=$ptoA[2];		
												
									$query_invptoTx2="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto'
									where clli_adva='$clli_adva' and repisat='$repisa' and slot='$slot' and puerto='$puertoTA'";	
									//echo $query_invptoA;
								}
								else
								{
									$query_invptoTx2="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto'
									where clli_adva='$clli_adva' and puerto='$puerto_trans'";
								}
									mysql_query($query_invptoTx2);
							}
					}
					//---------------------->PUERTO TRANSPORTE SECUNDARIO
					if($puerto_trans2!="")
					{	
							$id_puerto_fisico_pto="AL-".$tunel."-".$tipo_demarcador2."-".$modCorto2."-".$puertoRxSec;
							if($aplica_tarjeta=="SI")
							{
								$ptoA=explode("/",$puerto_trans2);	
								$repisa=$ptoA[0];
								$slot=$ptoA[1];
								$puertoTA=$ptoA[2];		
												
										$query_invptoTx2="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto'
										where clli_adva='$clli_adva' and repisat='$repisa' and slot='$slot' and puerto='$puertoTA'";	
										//echo $query_invptoA;
									}
									else
									{
										$query_invptoTx2="update inventario_puertos_demarcadores set id_puerto_fisico='$id_puerto_fisico_pto'
											where clli_adva='$clli_adva' and puerto='$puerto_trans2'";
									}
									mysql_query($query_invptoTx2);
					}
					
				if($conexion_rcdt=="POR TUNEL" and $clase_servicio=="CD SEGURA")
				{
					if($descrip!="")
					{
						$query_estatus="update inventario_demarcadores set estatus_adva_exp='VALIDADA',fecha_sol_exp=NOW(),anexo_ot='OK',
						observaciones_adva_exp=CONCAT(' |',NOW(),' (Usuario: ','$sess_nmb),','Solicitud de Validacion. ','$descrip\\n',observaciones_adva_exp),
						observaciones=CONCAT(' |',NOW(),' (Usuario: ','$sess_nmb), ','Observaciones: ','$descrip\\n',observaciones)
						where clli_adva='$clli_adva'";
					}else
					{
						$query_estatus="update inventario_demarcadores set estatus_adva_exp='VALIDADA',fecha_sol_exp=NOW(),anexo_ot='OK',
						observaciones_adva_exp=CONCAT(' |',NOW(),' (Usuario: ','$sess_nmb),','Solicitud de Validacion. ','$descrip\\n',observaciones_adva_exp)
						where clli_adva='$clli_adva'";
					}
						//echo $query_estatus;
						mysql_query($query_estatus);
				}else{
					
					if($descrip!="")
					{
						$query_estatus="update inventario_demarcadores set estatus_adva_exp='POR REVISAR',fecha_sol_exp=NOW(),
						observaciones_adva_exp=CONCAT(' |',NOW(),' (Usuario: ','$sess_nmb),','Solicitud de Validacion. ','$descrip\\n',observaciones_adva_exp),
						observaciones=CONCAT(' |',NOW(),' (Usuario: ','$sess_nmb), ','Observaciones: ','$descrip\\n',observaciones)
						where clli_adva='$clli_adva'";
					}else
					{
						$query_estatus="update inventario_demarcadores set estatus_adva_exp='POR REVISAR',fecha_sol_exp=NOW(),
						observaciones_adva_exp=CONCAT(' |',NOW(),' (Usuario: ','$sess_nmb),','Solicitud de Validacion. ','$descrip\\n',observaciones_adva_exp)
						where clli_adva='$clli_adva'";
					}
						//echo $query_estatus;
						mysql_query($query_estatus);
				}				
			
			//---------------------------------------------> SI ES POR TUNEL  GUARDA EN TABLA DE INVENTARIO INFRA 
			if($conexion_rcdt=="POR TUNEL" and $clase_servicio=="CD SEGURA")
			{
		
					$queryCd="update inventario_infra set
					clli_adva='$tunel',central_adva='$central2',modelo_adva='$tipo_equipo2',tipo_demarcador='$tipo_demarcador2',vlan_gestion='$vlan2',
					clli_adva2='$clli_adva',central_adva2='$central',modelo_adva2='$tipo_equipo',tipo_demarcador2='$tipo_demarcador',vlan_gestion2='$vlan'
					where ref_sisa_infra='$ref_sisa'";
					//echo $queryCd;
					mysql_query($queryCd);				
			}			
									
			echo "<script>alert('Se Envio la Solicitud de Validacion');document.alta_demarcador.validarDem.value=0;
			document.alta_demarcador.submit();</script>";
			}
	}
}
//-------------------------------------------------> QUERYS PARA INSERTAR EN ORDENES 
if($solicitar==1)
{
	
			//---------------------------------------  QUERY QUE INSERTA DEMARCADOR  EN ORDENES -----------------------------------		
					//**Inserta en la Tabla de "ordenes"
					$dat_id=mysql_query("select id from inventario_demarcadores where clli_adva='$clli_adva'"); // RECUPERA EL id  PARA INSERTARLO EN "ORDENES"
					$datos_id = mysql_fetch_array($dat_id);
					$id_tabla_ad=$datos_id['id'];
					//echo $id_tabla_ad;
											
					if($tipo_demarcador=='DDE' or $tipo_demarcador=='NDE')	$enlace='Infra RB';
					else													$enlace='Infra RNC';
					
					
					if($division=="TELNOR") 	$cnsOrd="CSG";
					else						$cnsOrd="CNS IV";
											
					$num_ot_frida="RF-ADV-".date('dmY')."-".rand(10000, 99999);
					$generaot="replace into ordenes 
							  (cns,fecha_solicitud, tipo_producto, fecha_val, personal_valida, num_ot_frida, estatus, tabla, id_tabla, division,
							  area, nombre_oficial_pisa, ref_sisa,  nombre_adva_a,  no_reps, tipo_trabajo, tipo_equipo, trafico, observaciones) 
							  values
							  ('$cnsOrd',NOW(), '$clase_servicio', NOW(), 'Validacion Automatica', 
							  '$num_ot_frida','VALIDADA','inventario_demarcadores','$id_tabla_ad','$division','$ciudad','$ref_sisa','$ref_sisa', '$central', 
							  '$proveedor','GESTION $enlace','$tipo_equipo','GESTION $enlace',
							   CONCAT(' |',NOW(),' (Usuario: ','$sess_nmb), ','Solicitud de Gestion. ','$descrip\\n','$observ_cns'))";			
					//echo $generaot;
					mysql_query($generaot);
					
					if($gestion=="GESTIONADO") 	{$qcom="";$msj="Solicitud de Ampliacion.";}
					else						{$qcom="estatus_ptoext='N/A',";$msj="Solicitud de Gestion.";}				
					
					if($descrip!="")
					{						
						$query_estatus="update inventario_demarcadores set ".$qcom."estatus_adva='VALIDADA',
						observaciones_adva=CONCAT(' |',NOW(),' (Usuario: ','$sess_nmb), ','$msj Observaciones:','$descrip\\n',observaciones_adva),
						observaciones=CONCAT(' |',NOW(),' (Usuario: ','$sess_nmb), ','Observaciones: ','$descrip\\n',observaciones)
						where clli_adva='$clli_adva'";
					}else
					{
						$query_estatus="update inventario_demarcadores set ".$qcom."estatus_adva='VALIDADA',						
						observaciones_adva=CONCAT(' |',NOW(),' (Usuario: ','$sess_nmb), ','$msj Observaciones:','$descrip\\n',observaciones_adva)
 						where clli_adva='$clli_adva'";
					}
					//echo $query_estatus;					
					mysql_query($query_estatus);
					 
		echo "<script>alert('Se Realizo la Solicitud');document.alta_demarcador.solicitar.value=0;document.alta_demarcador.submit();</script>";
}
//-------------------------------------------------> SOLICITA GESTION DEL CONVERTIDOR DE MEDIOS
if($solicitarDem==1)
{

				if($cns1=="LIQUIDADA" || $cns1=="EJECUTADA CON PRUEBAS" || $cns1=="EJECUTADA SIN PRUEBAS")
						{					
							// RECUPERA EL id DE "inventario_demarcadores" 	PARA INSERTARLO EN "ORDENES"
							$dat_id=mysql_query("select id from inventario_demarcadores where clli_adva='$clli_adva'"); 
							$datos_id = mysql_fetch_array($dat_id);
							$id_tabla_ad=$datos_id['id'];

							//-------------  QUERY QUE INSERTA DEMARCADOR  EN ORDENES ------------------------------------------------------------------
							$num_ot_frida="RF-ADV-".date('dmY')."-".rand(10000, 99999);
							$generaot="replace into ordenes 
									   (cns,fecha_solicitud, tipo_producto, fecha_val, personal_valida, num_ot_frida, estatus, tabla, id_tabla, division, area, 
									   nombre_oficial_pisa,ref_sisa,  nombre_adva_a,  no_reps, tipo_trabajo, tipo_equipo, trafico, observaciones) 
									   values 
									   ('CNS IV',NOW(), '$clase_servicio', NOW(), 'Validacion Automatica',
									   '$num_ot_frida','VALIDADA','inventario_demarcadores','$id_tabla_ad','$division','$ciudad',
									   '$clli_adva','$ref_sisa', '$central','$proveedor','ALTA CONV MEDIOS','$tipo_equipo','ALTA CONV MEDIOS', 
									   CONCAT(' |',NOW(),' (Usuario: ','$sess_nmb), ','Solicitud de Gestion. ','$descrip\\n','$observ'))";
							//echo $generaot;
							mysql_query($generaot);
							//-------------  QUERY´S PARA ACTUALIZAR LOS ESTATUS DE LA TABLA DE INVENTARIOS_DEMARCADORES --------------------------------
							$query_estatus="update inventario_demarcadores set estatus_adva='VALIDADA',
							observaciones_adva=CONCAT(' |',NOW(),': (Usuario: ','$sess_usr), ','$sess_nmb',' - Solicitud de Gestion. ',observaciones_adva)
							where clli_adva='$clli_adva'";
							//echo $query_estatus;
							mysql_query($query_estatus);
							
							echo "<script>alert('SOLICITUD ENVIADA...');document.alta_demarcador.solicitarDem.value=0;document.alta_demarcador.submit();</script>";
				
								
						}else
						{

							// RECUPERA EL id DE "inventario_demarcadores" 	PARA INSERTARLO EN "ORDENES"
							$dat_id=mysql_query("select id from inventario_demarcadores where clli_adva='$clli_adva'"); 
							$datos_id = mysql_fetch_array($dat_id);
							$id_tabla_ad=$datos_id['id'];
							$num_ot_frida="RF-ADV-".date('dmY')."-".rand(10000, 99999);
							
							//-------------  QUERY QUE INSERTA DEMARCADOR  EN ORDENES CNS I------------------------------------------------------------------
							$generaot1="replace into ordenes 
									   (cns,fecha_solicitud, tipo_producto, fecha_val, personal_valida, num_ot_frida, estatus, tabla, id_tabla, division, area, 
									   nombre_oficial_pisa,ref_sisa,  nombre_adva_a,  no_reps, tipo_trabajo, tipo_equipo, trafico, observaciones) 
									   values 
									   ('CNS I',NOW(), '$clase_servicio', NOW(), 'Validacion Automatica',
									   '$num_ot_frida','POR REVISAR','inventario_demarcadores','$id_tabla_ad','$division','$ciudad',
									   '$clli_adva','$ref_sisa', '$central','$proveedor','ALTA CONV MEDIOS CETH','$tipo_equipo','ALTA CONV MEDIOS CETH', 
									   CONCAT(' |',NOW(),' (Usuario: ','$sess_nmb), ','Solicitud de Gestion. ','$observaciones\\n','$observ'))";
							//echo $generaot1;
							mysql_query($generaot1);							
							//-------------  QUERY QUE INSERTA DEMARCADOR  EN ORDENES  CNS IV ---------------------------------------------------------------
							$generaot4="replace into ordenes 
									   (cns,fecha_solicitud, tipo_producto, fecha_val, personal_valida, num_ot_frida, estatus, tabla, id_tabla, division, area, 
									   nombre_oficial_pisa,ref_sisa,  nombre_adva_a,  no_reps, tipo_trabajo, tipo_equipo, trafico, observaciones) 
									   values 
									   ('CNS IV',NOW(), '$clase_servicio', NOW(), 'Validacion Automatica',
									   '$num_ot_frida','EN ESPERA','inventario_demarcadores','$id_tabla_ad','$division','$ciudad',
									   '$clli_adva','$ref_sisa', '$central','$proveedor','ALTA CONV MEDIOS','$tipo_equipo','ALTA CONV MEDIOS', 
									   CONCAT(' |',NOW(),' (Usuario: ','$sess_nmb), ','Solicitud de Gestion. ','$observaciones\\n','$observ'))";
							//echo $generaot4;
							mysql_query($generaot4);							
							
							
							//-------------  QUERY´S PARA ACTUALIZAR LOS ESTATUS DE LA TABLA DE INVENTARIOS_DEMARCADORES --------------------------------
							$query_estatus="update inventario_demarcadores set estatus_ptoext='POR REVISAR',estatus_adva='EN ESPERA',
							observaciones=CONCAT(' | ',NOW(),' (Usuario: ','$sess_nmb), ','Observacion:','$descrip\\n',observaciones) 
							where clli_adva='$clli_adva'";
							//echo $query_estatus;
							mysql_query($query_estatus);
							
							
							echo "<script>alert('SOLICITUD ENVIADA...');document.alta_demarcador.solicitarDem.value=0;document.alta_demarcador.submit();</script>";
				
						}
}
?>



</form>
</div>
</body>
</html>
<script type="text/javascript">
<!-------------------------------------------------- FUNCION PARA EL SUBMIT DE LAS PESTA├ّAS --------------------------------------->
var onceTime=0;
function getTab(){
	if(onceTime==0){
		var arrLink=document.getElementsByTagName("a");	
		var idLink;
		for(a=0;a< arrLink.length;a++){
			if(arrLink[a].href!='' && arrLink[a].href.match(/#(\w.+)/)!=null ){
				arrHref=arrLink[a].href.match(/#(\w.+)/)[1];
				if(arrHref==document.alta_demarcador.tabSpan.value){
					idLink=arrLink[a].id;
					break;
				}
			}
		}
		if(idLink!=undefined)
			domtab.showTab( document.getElementById(idLink).click());
	}
	onceTime++;
}
<!----------------------------------------------------- VALIDA CAMPOS PARA DAR DE ALTA EL DEMARCADOR ----------------------------------------->
function validar()
{
	if(document.alta_demarcador.clli_adva.value=="")
	{alert("Falta Clli del Demarcador");}	
	else 
	if(document.alta_demarcador.conexion_rcdt.value==""||
	(document.alta_demarcador.conexion_rcdt.value=="POR TUNEL"&&document.alta_demarcador.clase_servicio.value!="CD SEGURA"&&(document.alta_demarcador.clase_servicio.value==""))||
	(document.alta_demarcador.conexion_rcdt.value=="POR TUNEL"&&document.alta_demarcador.clase_servicio.value=="CD SEGURA"&&(document.alta_demarcador.ref_sisa.value==""))||
	
	(document.alta_demarcador.conexion_rcdt.value=="PUERTO EXTENDIDO"&&document.alta_demarcador.tipo_demarcador.value!="CONVERTIDOR DE MEDIOS"&&(document.alta_demarcador.ref_sisa.value==""||document.alta_demarcador.select_wdm.value==""||document.alta_demarcador.aplica_traspasos.value==""||typeof(eval(document.alta_demarcador.cluster))=="undefined"||document.alta_demarcador.cluster.value==""||document.alta_demarcador.tipo_nodo_acceso.value==""||document.alta_demarcador.nodo_adm_conex_adsl_acceso.value==""))||
	(document.alta_demarcador.conexion_rcdt.value=="CASCADA"&&(document.alta_demarcador.pto_cascada.value==""||
	 document.alta_demarcador.cascada.value==""))
	)
	{alert("Falta Informacion de Conexion RCDT");}
	else 
	if(document.alta_demarcador.tipo_demarcador.value==""||document.alta_demarcador.tipo_equipo.value==""||
	document.alta_demarcador.release.value==""||document.alta_demarcador.ubicacion_demarcador.value==""||
	document.alta_demarcador.ot_instalacion_demarcador.value=="")
	{alert("Falta Informacion del Equipo");}	
	else 
	if(document.alta_demarcador.division.value==""||document.alta_demarcador.estado.value==""||document.alta_demarcador.ciudad.value==""||
	document.alta_demarcador.central.value=="")
	{alert("Falta Informacion de Datos Generales");}
	else
	{document.alta_demarcador.guardar.value=1;document.alta_demarcador.submit();}
//alert(document.alta_demarcador.clase_servicio.value);
}
<!-------------------------------------------------------- FUNCION PARA CHECAR LAS TARJETAS DISPONIBLES -------------------------->
function valTj()
{
    var tjta=document.alta_demarcador.modelo_tarjeta.value;
	var sl2=document.alta_demarcador.slot.value;
	if(tjta=="GE-10S")
	{
		if(sl2=="LC-05")
		{document.alta_demarcador.slot_duo.value=sl2+'-'+"LC-06";}
		else
		if(sl2=="LC-11")
		{document.alta_demarcador.slot_duo.value=sl2+'-'+"LC-12";}
		else
		if(sl2=="LC-17")
		{document.alta_demarcador.slot_duo.value=sl2+'-'+"LC-18";}
		else
		if(sl2=="LC-23")
		{document.alta_demarcador.slot_duo.value=sl2+'-'+"LC-24";}
		else
		{
			var sl=document.alta_demarcador.slot.selectedIndex;
			sl=sl+1;
			var slots=document.alta_demarcador.slot.options[sl].value;
			document.alta_demarcador.slot_duo.value=sl2+'-'+slots;
		}
	}
	else
	{document.alta_demarcador.slot_duo.value=sl2;}

}
<!------------------------------------------------------ VALIDA LOS CAMPOS LLENOS DE LAS PUERTOS --------------------------------------------->
function validPuerto()
{
	if( document.alta_demarcador.puerto.value!="")
	{
		document.alta_demarcador.altapto.value=1;
		document.alta_demarcador.buscar.value=1;
		document.alta_demarcador.submit();
	}
	else
	{ alert("Faltan Datos A Registrar"); }

}

</script>