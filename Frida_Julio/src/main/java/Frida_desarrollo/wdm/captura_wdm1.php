<?php
ini_set("memory_limit","550M");
//error_reporting(E_NONE);
//error_reporting(E_ALL);


include ("perfiles.php");
require("conexion.php");
$fecha=date('d/m/Y');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<script type='text/javascript' src='./js/myscripts.js'></script>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />


<link rel="stylesheet" type="text/css" href="./datepickercontrol.css" />
<script type="text/javascript" src="./datepickercontrol.js"></script>

<link rel="stylesheet" type="text/css" href="autocomp.css">
<script type="text/javascript" src="autocomp.js"></script>

<style type="text/css">
<!--
.Estilo28 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;}
#pie {text-align: center;font-size: 11px;color: #aaa;margin-top: 40px;padding-top: 10px;padding-bottom: 10px;}	
.Estilo42 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000066; }
.Estilo48 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #000066; }
.Estilo49 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #000066; }
.Estilo53 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #000000; }
.Estilo57 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #990000; }
.Estilo58 {font-size: 10px; color: #000066; font-family: Verdana, Arial, Helvetica, sans-serif;}
.Estilo70 {font-size: 12px; color: #000066; font-family: Verdana, Arial, Helvetica, sans-serif; background-color: #FFFFCC;font-weight: bold;}
-->
</style>

</head>
<body>


<div id="wrap">
<div id="header">
	<div id="logo">
		<h1><a href="inicio.php">F R I D A</a></h1>
		<h2>Alta de WDM</h2>
		<p>&nbsp;</p>
	  <p>&nbsp;</p>
    </div>
  </div>
</div>


<?php

if (isset($_REQUEST['rf'])) $rf=$_REQUEST['rf'];	else $rf="";
if (isset($_REQUEST['exportar'])) $exportar=$_REQUEST['exportar']; 	else $exportar=0;
if (isset($_REQUEST['tipoequipo'])) $tipoequipo=$_REQUEST['tipoequipo'];	else $tipoequipo="";
if (isset($_REQUEST['solcns'])) $solcns=$_REQUEST['solcns'];	else $solcns="";
if (isset($_REQUEST['siglas'])) $siglas=$_REQUEST['siglas'];	else $siglas="";
if (isset($_REQUEST['repisa'])) $repisa=$_REQUEST['repisa'];	else $repisa="";
if (isset($_REQUEST['id'])) $id=$_REQUEST['id'];	else $id="";
if (isset($_REQUEST['ido'])) $ido=$_REQUEST['ido'];	else $ido="";
if (isset($_REQUEST['idd'])) $idd=$_REQUEST['idd'];	else $idd="";
if (isset($_REQUEST['wdm'])) $wdm=$_REQUEST['wdm'];	else $wdm="";
if (isset($_REQUEST['altanodo'])) $altanodo=$_REQUEST['altanodo'];	else $altanodo="";
if (isset($_REQUEST['altaseccion'])) $altaseccion=$_REQUEST['altaseccion'];	else $altaseccion="";
if (isset($_REQUEST['altarcdt'])) $altarcdt=$_REQUEST['altarcdt'];	else $altarcdt="";
if (isset($_REQUEST['cambioreg'])) $cambioreg=$_REQUEST['cambioreg'];	else $cambioreg="";
if (isset($_REQUEST['cambionodo'])) $cambionodo=$_REQUEST['cambionodo'];	else $cambionodo="";
if (isset($_REQUEST['upfo'])) $upfo=$_REQUEST['upfo'];	else $upfo="";
if (isset($_REQUEST['clliagrf2'])) $clliagrf2=$_REQUEST['clliagrf2'];	else $clliagrf2="";
if (isset($_REQUEST['trayectoria'])) $trayectoria=$_REQUEST['trayectoria'];	else $trayectoria=0;
if (isset($_REQUEST['tipoenlace'])) $tipoenlace=$_REQUEST['tipoenlace'];	else $tipoenlace="f";

if(substr($tipoequipo,1,1)<>"a") {$trayectoria=0;$tipoenlace="f";}

if (!isset($tipoequipo) or $tipoequipo=="")							{$vereq="display:none";$vertarj="display:none";$verenl="display:none";$verrcdt="display:none";}
if (substr($tipoequipo,0,1)=="d" or substr($tipoequipo,0,1)=="a")				{$vereq="";$verenl="display:none";$verrcdt="display:none";}
if (substr($tipoequipo,0,1)=="e")								{$vereq="display:none";$verenl="";$verrcdt="display:none";}
if (substr($tipoequipo,3,1)=="r")								{$vereq="display:none";$verenl="display:none";$verrcdt="";}
if ($solcns=="")										{$verobscns="display:none";$verobscnsnd="display:none";}
if ($solcns==1)											{$verobscns="";$verobscnsnd="display:none";}
if ($solcns==2)											{$verobscnsnd="";$verobscns="display:none";}

echo "<form name='wdm' method='post'>";
echo "<input type=hidden name=cambioreg value=1>";
echo "<input type=hidden name=tipoequipo value=$tipoequipo>";
echo "<input type=hidden name=siglas value=$siglas>";
echo "<input type=hidden name=repisa value=$repisa>";
echo "<input type=hidden name=id value=$id>";
echo "<input type=hidden name=ido value=$ido>";
echo "<input type=hidden name=idd value=$idd>";
echo "<input type=hidden name=cambionodo>";
echo "<input type=hidden name=ospf>";

echo "<input type=hidden name=altanodo>";
echo "<input type=hidden name=altatj>";
echo "<input type=hidden name=uppto>";

echo "<input type=hidden name=altaseccion>";
echo "<input type=hidden name=altarcdt>";
echo "<input type=hidden name=upfo>";

echo "<input type=hidden name=verpuertos>";
echo "<input type=hidden name=repisat2>";
echo "<input type=hidden name=modelo_tarjeta2>";
echo "<input type=hidden name=slot2>";
echo "<input type=hidden name=subslot2>";
echo "<input type=hidden name=tipo_tarjeta2>";
echo "<input type=hidden name=solcns>";
echo "<input type=hidden name=exportar>";
echo "<input type=hidden name=clliagrf2>";
echo "<input type=hidden name=trayectoria value=$trayectoria>";
echo "<input type=hidden name=frec>";

if (!isset($rf))
{
    $rf="RF-WDM-".date('dmY')."-".rand(10000, 99999);
}

//echo "$altanodo=$altaseccion=$altarcdt=$solcns=$altatj=$uppto=$upfo";

$wd=substr($wdm,0,strpos($wdm,"|"));


$qestatcnswd=mysql_query("SELECT estatus from ordenes where nombre_oficial_pisa='$wd'");
if (mysql_num_rows($qestatcnswd)>0) $estatcnswd=mysql_result($qestatcnswd,0,0);
else $estatcnswd="";
$congelarwdm=array('AUTORIZADA', 'POR REVISAR', 'VALIDADA', 'EN VALIDACION', 'EN PROCESO', 'ASIGNACION DE TECNICO');

if (in_array($estatcnswd,$congelarwdm)){
	$congelar=1;
	$leyendacong="<br><b><font color=red>WDM BLOQUEADO POR CNS NO SE PUEDE MODIFICAR</font></b>";
	if($altanodo=="1" or $altaseccion=="1" or $altarcdt=="1" or $solcns=="1" or $solcns=="2" or $altatj=="altatj" or substr($altatj,0,6)=="bajatj" or substr($uppto,0,1)=="a" or substr($uppto,0,1)=="b" or substr($upfo,0,1)=="a" or substr($upfo,0,1)=="b") $avisocns=1;
	$altanodo=$altaseccion=$altarcdt=$solcns=$altatj=$uppto=$upfo="C";
}
else{
	$congelar=0;
	$leyendacong="";
	$avisocns=0;
}

$qestatcnsnodo=mysql_query("SELECT estatus from ordenes where nombre_oficial_pisa like '$wd-%' and id_tabla IN ('$id','$idd','$ido')");
if (mysql_num_rows($qestatcnsnodo)>0) $estatcnsnodo=mysql_result($qestatcnsnodo,0,0);
else $estatcnsnodo="";
$congelarnodo=array('AUTORIZADA', 'POR REVISAR', 'VALIDADA', 'EN VALIDACION', 'EN PROCESO', 'ASIGNACION DE TECNICO');

if (in_array($estatcnsnodo,$congelarnodo)){
	$congelarnodo=1;
	$leyendacongnodo="<br><b><font color=red>NODO BLOQUEADO POR CNS NO SE PUEDE MODIFICAR</font></b>";
	if($altanodo=="1" or $altaseccion=="1" or $altarcdt=="1" or $solcns=="1" or $solcns=="2" or $altatj=="altatj" or substr($altatj,0,6)=="bajatj" or substr($uppto,0,1)=="a" or substr($uppto,0,1)=="b" or substr($upfo,0,1)=="a" or substr($upfo,0,1)=="b") $avisocnsnodo=1;
	$altanodo=$altaseccion=$altarcdt=$solcns=$altatj=$uppto=$upfo="C";
}
else{
	$congelarnodo=0;
	$leyendacongnodo="";
	$avisocnsnodo=0;
}


//########################################ACTUALIZA BD###########################################################################################


if ($altanodo=="1")
{


		$faltan_datos="";
		if (trim($clli_equipo)=='')		$faltan_datos.="Debe indicar el CLLI del Equipo\\n";
//		if (trim($ref_sisa)=='')		$faltan_datos.="Debe indicar la Referencia SISA\\n";
//		if (trim($ip_sistema)=='')		$faltan_datos.="Debe indicar la IP Sistema (L0)\\n";
		if (trim($ip_gestion)=='')		$faltan_datos.="Debe indicar la IP del Nodo\\n";
		if (trim($ubi_nodo_adm)=='')	$faltan_datos.="Debe indicar la Ubicacin del Nodo\\n";
//		if (trim($version_nodo)=='')	$faltan_datos.="Debe indicar el Release del Nodo\\n";
		
	
		if ($faltan_datos<>"") echo "<script>alert('$faltan_datos');</script>";
    
		if ($faltan_datos=="")
		{
		      	$error="";
			// Actualiza la Tabla "cat_wdm"
			$qmod="UPDATE cat_wdm SET login='$sess_usr', fecha_alta=NOW(), clli_equipo='$clli_equipo', ref_sisa='$ref_sisa', repadm_conxadsl='$modelo',id_nodo='$id_nodo', ubi_nodo_adm='$ubi_nodo_adm', ip_sistema='$ip_sistema', id_inter_sistema='$id_inter_sistema', ip_gestion='$ip_gestion', id_inter_gestion='$id_inter_gestion', inter_gest='$inter_gest', ospf='$ospf', version_nodo='$version_nodo', remate_cd1='$remate_cd1', long_cable1='$long_cable1', cal_cable_1='$cal_cable_1', bdcd_1='$bdcd_1', cap_break1='$cap_break1', anexo_ot='$anexo_ot', remate_cd2='$remate_cd2', long_cable2='$long_cable2', cal_cable_2='$cal_cable_2', bdcd_2='$bdcd_2', cap_break2='$cap_break2',  pdu1_cap_break1='$pdu1_cap_break1', pdu1_pos_break1='$pdu1_pos_break1', pdu1_pos_break2='$pdu1_pos_break2', pdu2_cap_break1='$pdu2_cap_break1', pdu2_pos_break1='$pdu2_pos_break1', pdu2_pos_break2='$pdu2_pos_break2', pdu3_cap_break1='$pdu3_cap_break1', pdu3_pos_break1='$pdu3_pos_break1', pdu3_pos_break2='$pdu3_pos_break2' WHERE id='$id'";
			mysql_query($qmod);
			
			$wd=substr($wdm,0,strpos($wdm,"|"));
			$qospf="UPDATE cat_wdm SET ospf='$ospf' WHERE wdm='$wd'";
			mysql_query($qospf);


			$datoscd=explode(".",$ospf);
			$datreg=$datoscd[0];
			$datcd=$datoscd[1];
			$conscd=$datoscd[3];
			mysql_query("UPDATE cat_ciudades set consecutivo=$conscd where region='$datreg' and cod_ciudad='$datcd' and consecutivo<$conscd");
		}
}

if ($altaseccion=="1")
{
	if (substr($tipoequipo,0,1)=="e")	//Alta de SECCIONES
	{

		$faltan_datose="";
		
		if (trim($combo_pto_troncal_d)=='')		$faltan_datose.="Debe indicar el Puerto origen\\n";
		if (trim($combo_pto_troncal_a)=='')		$faltan_datose.="Debe indicar el Puerto destino\\n";
		
		if (trim($id_pto_troncal_d)=='')		$faltan_datose.="Debe indicar la Identificacion del Puerto origen \\n";
		if (trim($id_pto_troncal_a)=='')		$faltan_datose.="Debe indicar la Identificacion del Puerto destino\\n";						
		
		if (trim($nominter_troncal_d)=='')		$faltan_datose.="Debe indicar el Nombre de Interfase origen \\n";
		if (trim($nominter_troncal_a)=='')		$faltan_datose.="Debe indicar el Nombre de Interfase destino \\n";		
		
		if (trim($desc_nominter_troncal_d)=='')		$faltan_datose.="Debe indicar la Descripcion de la Interfase origen \\n";
		if (trim($desc_nominter_troncal_a)=='')		$faltan_datose.="Debe indicar la Descripcion de la Interfase destino \\n";		

		//if (trim($ip_troncal_d)=='')			$faltan_datose.="Debe indicar la IP del Nodo \\n";
		//if (trim($ip_troncal_a)=='')			$faltan_datose.="Debe indicar la IP del Nodo \\n";		
		
		//if (trim($mtu_d)=='')					$faltan_datose.="Debe indicar la MTU \\n";
		//if (trim($mtu_a)=='')					$faltan_datose.="Debe indicar la MTU \\n";		
		
		//if (trim($ref_sisa_e)=='')			$faltan_datose.="Debe indicar la Referencia SISA\\n";				

		if ($faltan_datose<>"") echo "<script>alert('$faltan_datose');</script>";
		
		if ($faltan_datose=="")
		{
		      	$error="";
      	
			// Actualiza la Tabla "secciones_wdm"
			$wd=substr($wdm,0,strpos($wdm,"|"));
			$datnodoo=mysql_query("SELECT wdm, id_nodo, proveedor_tx  from cat_wdm where id='$ido'");
			$enwdm=mysql_result($datnodoo,0,0);
			$enidnodo=mysql_result($datnodoo,0,1);
			$prov_orig=mysql_result($datnodoo,0,2);

			$datnodod=mysql_query("SELECT wdm, id_nodo  from cat_wdm where id='$idd'");
			$enidnodd=mysql_result($datnodod,0,1);
			
			$pto_troncal_d=$combo_pto_troncal_d;
			$pto_troncal_a=$combo_pto_troncal_a;
			$pto_troncal_d=str_replace(" 10G", "", $pto_troncal_d);
			$pto_troncal_a=str_replace(" 10G", "", $pto_troncal_a);
			$pto_troncal_d=substr($pto_troncal_d,strpos($pto_troncal_d,"--")+2);
			$pto_troncal_a=substr($pto_troncal_a,strpos($pto_troncal_a,"--")+2);

			if($prov_orig=="ALCATEL")	$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/', subslot+0, '/', if(instr(puerto,'G'),CONCAT(substr(puerto,1,instr(puerto,'G')-1), ' 10G'),puerto))";
			if($prov_orig=="CISCO")		$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/', if(instr(puerto,'G'),CONCAT(substr(puerto,1,instr(puerto,'G')-1), ' 10G'),puerto)) ";
			if($prov_orig=="HUAWEI")	$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/', puerto) ";
			$qptoreservo=mysql_query("UPDATE inventario_puertos_wdm set estatus='DISPONIBLE', pto_troncal=''                         where wdm='$wd' and (pto_troncal='$desc_nominter_troncal_d' or pto_troncal='$desc_nominter_troncal_a')");
			$qptoreservo=mysql_query("UPDATE inventario_puertos_wdm set estatus='RESERVADO',  pto_troncal='$desc_nominter_troncal_d' where wdm='$wd' and id_nodo='$enidnodo' and $rssp='$combo_pto_troncal_d'");
			$qptoreservd=mysql_query("UPDATE inventario_puertos_wdm set estatus='RESERVADO',  pto_troncal='$desc_nominter_troncal_a' where wdm='$wd' and id_nodo='$enidnodd' and $rssp='$combo_pto_troncal_a'");

			$tipoptod=mysql_result(mysql_query("SELECT tipo_puerto from inventario_puertos_wdm where wdm='$wd' and pto_troncal='$desc_nominter_troncal_d'"),0,0);
			$tipoptoa=mysql_result(mysql_query("SELECT tipo_puerto from inventario_puertos_wdm where wdm='$wd' and pto_troncal='$desc_nominter_troncal_a'"),0,0);
					
			$qenl="REPLACE INTO secciones_wdm (wdm, id_nodo_d, pto_troncal_d, ip_troncal_d, id_pto_troncal_d, nominter_troncal_d, desc_nominter_troncal_d, mtu_d, id_nodo_a, pto_troncal_a, ip_troncal_a, id_pto_troncal_a, nominter_troncal_a, desc_nominter_troncal_a, mtu_a, ref_sisa_e,tipo_puerto_d,tipo_puerto_a,trayectoria)
			                VALUES ('$enwdm','$enidnodo','$pto_troncal_d','$ip_troncal_d','$id_pto_troncal_d','$nominter_troncal_d','$desc_nominter_troncal_d','$mtu_d', '$enidnodd', '$pto_troncal_a','$ip_troncal_a','$id_pto_troncal_a','$nominter_troncal_a','$desc_nominter_troncal_a','$mtu_a','$ref_sisa_e','$tipoptod','$tipoptoa',$trayectoria)";
			mysql_query($qenl);
			//echo $qenl;
			
		}
	}

}


if ($altarcdt=="1")
{
	if (substr($tipoequipo,0,1)=="e")	//Alta de SECCIONES
	{

		$faltan_datosrcdt="";
		
		if (trim($combo_pto_troncal_dr)=='')			$faltan_datosrcdt.="Debe indicar el Puerto origen\\n";
		if (trim($pto_troncal_ar)=='')				$faltan_datosrcdt.="Debe indicar el Puerto destino\\n";
		
		if (trim($id_pto_troncal_dr)=='')			$faltan_datosrcdt.="Debe indicar la Identificacion del Puerto origen \\n";
		if (trim($id_pto_troncal_ar)=='')			$faltan_datosrcdt.="Debe indicar la Identificacion del Puerto destino \\n";	
		
		if (trim($nominter_troncal_dr)=='')			$faltan_datosrcdt.="Debe indicar el Nombre de Interfase origen \\n";
		if (trim($nominter_troncal_ar)=='')			$faltan_datosrcdt.="Debe indicar el Nombre de Interfase destino \\n";		
		
		if (trim($desc_nominter_troncal_dr)=='')		$faltan_datosrcdt.="Debe indicar la Descripcion de la Interfase origen \\n";
		if (trim($desc_nominter_troncal_ar)=='')		$faltan_datosrcdt.="Debe indicar la Descripcion de la Interfase destino \\n";		
								
//		if (trim($ip_troncal_dr)=='')				$faltan_datosrcdt.="Debe indicar la IP del Nodo \\n";
//		if (trim($ip_troncal_ar)=='')				$faltan_datosrcdt.="Debe indicar la IP del Nodo \\n";		


		if (trim($ip_mascara_dr)=='')				$faltan_datosrcdt.="Debe indicar la Mascara \\n";
		if (trim($vel_pto)=='')						$faltan_datosrcdt.="Debe indicar la Velocidad del Puerto \\n";				
		if (trim($central_rcdt)=='')				$faltan_datosrcdt.="Debe indicar la Central RCDT \\n";
		
		if ($faltan_datosrcdt<>"") echo "<script>alert('$faltan_datosrcdt');</script>";
    
		if ($faltan_datosrcdt=="")
		{
		      	$error="";
      	
			// Actualiza la Tabla "secciones_wdm"
			$wd=substr($wdm,0,strpos($wdm,"|"));
			$datnodoo=mysql_query("SELECT wdm, id_nodo, proveedor_tx  from cat_wdm where id='$ido'");
			$enwdm=mysql_result($datnodoo,0,0);
			$enidnodo=mysql_result($datnodoo,0,1);
			$prov_orig=mysql_result($datnodoo,0,2);
			
			$pto_troncal_dr=$combo_pto_troncal_dr;
			$pto_troncal_dr=trim(strtr($pto_troncal_dr,"CL", "  "));
			$pto_troncal_dr=substr($pto_troncal_dr,strpos($pto_troncal_dr,"--")+2);			
			
			$tipoptod=mysql_result(mysql_query("SELECT tipo_puerto from inventario_puertos_wdm where wdm='$wd' and pto_troncal='$desc_nominter_troncal_dr'"),0,0);
			$qenl="REPLACE INTO secciones_wdm (wdm, id_nodo_d, pto_troncal_d, ip_troncal_d, vel_pto_d, ip_mascara_d, id_pto_troncal_d, nominter_troncal_d, desc_nominter_troncal_d, mtu_d, id_nodo_a, pto_troncal_a, ip_troncal_a, id_pto_troncal_a, nominter_troncal_a, desc_nominter_troncal_a, mtu_a, ref_sisa_e,hostname_a,no_cambio_rcdt,prioridad_rcdt,tipo_puerto_d,remate_rcdt,long_cable_rcdt)
			                VALUES ('$enwdm','$enidnodo','$pto_troncal_dr','$ip_troncal_dr', '$vel_pto', '$ip_mascara_dr', '$id_pto_troncal_dr','$nominter_troncal_dr','$desc_nominter_troncal_dr','NA', '$enidnodo', '$pto_troncal_ar','$ip_troncal_ar','$id_pto_troncal_ar','$nominter_troncal_ar','$desc_nominter_troncal_ar','NA','NA','$hostname_rcdt','$no_cambio_rcdt','$prioridad_rcdt','$tipoptod','$remate_rcdt','$long_cable_rcdt')";
			mysql_query($qenl);
			//echo $qenl;

			if($prov_orig=="HUAWEI")	$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/', puerto)";

			$qptoreservo=mysql_query("UPDATE inventario_puertos_wdm set estatus='DISPONIBLE', pto_troncal=''                          where wdm='$wd' and pto_troncal='$desc_nominter_troncal_dr'");
			$qptoreservo=mysql_query("UPDATE inventario_puertos_wdm set estatus='RESERVADO',  pto_troncal='$desc_nominter_troncal_dr' where wdm='$wd' and id_nodo='$enidnodo' and $rssp='$combo_pto_troncal_dr'");
		}
	}
}

// *** Solicitud a CNS de Gestion de WDM y Nodos ***
if (($solcns==1 and trim($obscns)<>"") or ($solcns==2 and trim($obscnsnd)<>""))
{
	$wd=substr($wdm,0,strpos($wdm,"|"));
	if($solcns==1) $qdatos_orden="SELECT id, division, ospf, proveedor_tx from cat_wdm where wdm='$wd' and repisa='WDM 1'";
	if($solcns==2)
	{
		if(substr($tipoequipo,0,3)=='af2') $qdatos_orden="SELECT t1.id, t1.division, t1.ospf, t1.proveedor_tx, t1.repisa as repf2, t2.repisa as repf1 from cat_wdm as t1 inner join cat_wdm as t2 on t1.wdm=t2.wdm and  t1.clli_agr2=t2.clli_equipo where t1.wdm='$wd' and t1.id='$id'";
		else $qdatos_orden="SELECT id, division, ospf, proveedor_tx,repisa from cat_wdm where wdm='$wd' and id='$id'";
	}
	
	//echo $qdatos_orden;
		
	$datos_orden=mysql_query($qdatos_orden);		
	if ($roworden = mysql_fetch_array($datos_orden));

	$obs_orden=mysql_query("SELECT observaciones,observaciones_top,num_ot_frida from ordenes where nombre_oficial_pisa like '$wd%' and tabla='cat_wdm' and id_tabla='".$roworden['id']."'");

	if ($rowobs_orden = mysql_fetch_array($obs_orden))
	{
		$rowobsorden=str_replace("'","\'",$rowobs_orden['observaciones_top']);
		$rowobsorden1=str_replace("'","\'",$rowobs_orden['observaciones']);
		$rf=$rowobs_orden['num_ot_frida'];
	}
	
	if (trim($rf)=="" and $solcns==1) $rf="RF-WDM-".date('dmY')."-".rand(10000, 99999);
	if (trim($rf)=="" and $solcns==2) $rf="RF-WND-".date('dmY')."-".rand(10000, 99999);
	
	if($solcns==2)
	{
		$repnd="WDM".trim(substr($roworden['repisa'],-2));
	}
	
	
	$tiempo=date('Y-m-d h:i');
	if ($solcns==1) $qcns="REPLACE INTO ordenes (num_ot_frida, estatus, tabla, id_tabla, division, area, nombre_oficial_pisa, no_reps, tipo_trabajo, tipo_equipo, trafico, observaciones_top, observaciones) VALUES ('$rf','POR REVISAR','cat_wdm','".$roworden['id']."','".$roworden['division']."','".$roworden['ospf']."','$wd','".$roworden['proveedor_tx']."','ALTA WDM',  'WDM','WDM', CONCAT('|$tiempo Usuario: ','(','$sess_usr',') ','$sess_nmb',' - ','$obscns\\n','".$rowobsorden."'),'".$rowobsorden1."')";
	if ($solcns==2) 
	{
		$qcns="REPLACE INTO ordenes (num_ot_frida, estatus, tabla, id_tabla, division, area, nombre_oficial_pisa, no_reps, tipo_trabajo, tipo_equipo, trafico, observaciones_top, observaciones) VALUES ('$rf','POR REVISAR','cat_wdm','".$roworden['id']."','".$roworden['division']."','".$roworden['ospf']."','".$wd."-".$repnd."','".$roworden['proveedor_tx']."','CAMBIO WDM','WDM','NODO WDM', CONCAT('|$tiempo Usuario: ','(','$sess_usr',') ','$sess_nmb',' - ','$obscnsnd\\n','".$rowobsorden."'),'".$rowobsorden1."')";
		mysql_query("UPDATE cat_wdm set estatus_cns='POR REVISAR' where id=".$roworden['id'] and estatus_cns<>'GESTIONADO');
	}
	//echo "<br>$qcns";
	mysql_query($qcns);
	$verobscns="display:none";
	$verobscnsnd="display:none";

}


?>


<?php
 echo" <div style='position:absolute;top:0;left:90%;font-size:9px;font-weight:bold;'>Usuario: $sess_nmb<br>DD: $sess_dd</div> ";
 
  ?>


<!-- //##################################################################WDM######################################################################################### -->

<div id="infwdm" style='margin: 0 auto;width :950px;'>
  <table width="950" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td width="194" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo49">INFORMACION DEL WDM </td>
      <td width="165" bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
      <td width="106" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28">&nbsp;</td>
      <td width="248" class="Estilo28"><input class='Estilo57' type="button" name="cns" id="cns" value="Solicitar Gestion de WDM" onclick='document.wdm.solcns.value=1;submit();'></td>
      <td width="205" class="Estilo28" style='<?=$verobscns?>'><textarea name='obscns' cols="40" class='Estilo28' id='obscns'></textarea></td>
      
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">WDM</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <?php
				$query_d="SELECT wdm,ospf FROM cat_wdm WHERE tecnologia='WDM' and division like '$sess_dd' GROUP BY wdm ORDER BY wdm ASC";

				$res_d = mysql_query($query_d);
										
				if ($rowc = mysql_fetch_array($res_d)){ 
				echo "<select name='wdm' onchange='document.wdm.ido.value=\"\";document.wdm.idd.value=\"\";document.wdm.tipoequipo.value=\"\";submit();'><option value=''>";
				do {  
				       if($wdm==$rowc["wdm"]."|".$rowc["ospf"]) $selcd="selected";
				       else $selcd="";
				       
				       echo "<option $selcd value= '".$rowc["wdm"]."|".$rowc["ospf"]."'>".$rowc["wdm"]."</option>";
				} while ($rowc = mysql_fetch_array($res_d)); 
				echo '</select>';			
				}	
				
				$ospf=$region="";
				if (trim($wdm<>'')) {$region='';$ospf=substr($wdm,strpos($wdm,"|")+1);$wd=substr($wdm,0,strpos($wdm,"|"));}	
			?>
			
	</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">Topología</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28">


        <?php if ($congelar<>"1") {?>
        <input name="creatop" type="button" class="Estilo49" id="button" title='Opcion para generar el archivo topolgico' onclick="window.open('crea_topologico.php?wdm=<?=$wd?>&congelar=<?=$congelar?>');" value="Crea Topolgico Logico" />
        <?php }?>
        <input name="topologia" readonly type="text" class="Estilo48" id="topologia" title='Topologia del WDM' value="<?=$topologia?>" size="5"/>
        <?php if ($congelar<>"1") {?>
        <input name="anexos"  type="button" class="Estilo49" id="button" title='Opcion para cargar anexos del Nodo' onclick="window.open('carga_archivos_wdm?tec=wdm&tipo=anexo&id=<?=$id?>&wdm=<?=$wd?>&congelar=<?=$congelar?>');" value="Cargar Anexo" />
        <?php }?>

      </td></tr>

	<tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td width="194" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo49"><span class="Estilo42">Ciudad</span></td>
      <td width="165" bordercolor="#CAE4FF" bgcolor="#CAE4FF"><span class="Estilo28">
        <input name="ciudad" readonly type="text" id="ciudad" title='Ciudad' value="<?=$ciudad?>"/>
      </span></td>
      <td width="248" class="Estilo28"><span class="Estilo42">Estatus CNS del WDM</span></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="estatus_cns" readonly type="text" id="estatus_cns" title='Estatus del WDM' value="<?=$estatcnswd?>"/><?=$leyendacong?></td>
    </tr>

	
  </table>
  <p><br>
    </p>
</div>
  
  
  
<!-- //##################################################################NODOS######################################################################################### -->
  
<?
		$datos_nodo=mysql_query("SELECT * from cat_wdm where id='$id'");
		$cllitxt="";
		
		if($cambionodo==1)
		{
			$ubi_nodo_adm="";
			$ip_sistema="";
			$ip_gestion="";		
			$version_nodo="";
			$remate_cd1="";
			$long_cable1="";
			$cal_cable_1="";
			$bdcd_1="";
			$cap_break1="";			
			$remate_cd2="";
			$long_cable2="";
			$cal_cable_2="";
			$bdcd_2="";
			$cap_break2="";			
			$pdu1_cap_break1="";
			$pdu1_pos_break1="";
			$pdu1_pos_break2="";
			$pdu2_cap_break1="";
			$pdu2_pos_break1="";
			$pdu2_pos_break2="";
			$pdu3_cap_break1="";
			$pdu3_pos_break1="";
			$pdu3_pos_break2="";
			
		}
		
		
		if (mysql_num_rows($datos_nodo)>0)
		{
			$datosnodo = mysql_fetch_array($datos_nodo);
			$clli_equipo=$datosnodo['clli_equipo'];
			$proveedor=$datosnodo['proveedor_tx'];
			$repadm_conxadsl=$datosnodo['repadm_conxadsl'];
			$cllitxt="readonly";
			$division=$datosnodo['division'];
			$ip_sistema=$datosnodo['ip_sistema'];
			$nuevarepisa=$datosnodo['repisa'];			
			$id_nodo='';
		
			if($clli_equipo<>"")
			{
				$repcons=trim(substr($nuevarepisa,-2));
				if($proveedor=="HUAWEI") $mod=substr($repadm_conxadsl,6);
								
				$id_nodo="$clli_equipo-".$abrev.$repcons."-".$mod;
				$id_inter_sistema="sistema-$clli_equipo-".$abrev.$repcons;
				$id_inter_gestion="$clli_equipo-".$abrev.$repcons;
				$inter_gest="gestion-$clli_equipo-".$abrev.$repcons;
			}
		}		
			
		if ($datosnodo['ip_gestion']<>"")
		{
			$siglas=$datosnodo['siglas_central'];
			$nuevarepisa=$datosnodo['repisa'];
			$clli_equipo=$datosnodo['clli_equipo'];
			$ref_sisa=$datosnodo['ref_sisa'];		
			$id_nodo=$datosnodo['id_nodo'];		
			$ubi_nodo_adm=$datosnodo['ubi_nodo_adm'];		
			$id_inter_sistema=$datosnodo['id_inter_sistema'];	
			$ip_sistema=$datosnodo['ip_sistema'];
			$id_inter_gestion=$datosnodo['id_inter_gestion'];
			$ip_gestion=$datosnodo['ip_gestion'];
			$inter_gest=$datosnodo['inter_gest'];
			$version_nodo=$datosnodo['version_nodo'];
			$anexo_ot=$datosnodo['anexo_ot'];

			$remate_cd1=$datosnodo['remate_cd1'];
			$long_cable1=$datosnodo['long_cable1'];
			$cal_cable_1=$datosnodo['cal_cable_1'];
			$bdcd_1=$datosnodo['bdcd_1'];
			$cap_break1=$datosnodo['cap_break1'];
			
			$remate_cd2=$datosnodo['remate_cd2'];
			$long_cable2=$datosnodo['long_cable2'];
			$cal_cable_2=$datosnodo['cal_cable_2'];
			$bdcd_2=$datosnodo['bdcd_2'];
			$cap_break2=$datosnodo['cap_break2'];
			
			$pdu1_cap_break1=$datosnodo['pdu1_cap_break1'];
			$pdu1_pos_break1=$datosnodo['pdu1_pos_break1'];
			$pdu1_pos_break2=$datosnodo['pdu1_pos_break2'];
			$pdu2_cap_break1=$datosnodo['pdu2_cap_break1'];
			$pdu2_pos_break1=$datosnodo['pdu2_pos_break1'];
			$pdu2_pos_break2=$datosnodo['pdu2_pos_break2'];
			$pdu3_cap_break1=$datosnodo['pdu3_cap_break1'];
			$pdu3_pos_break1=$datosnodo['pdu3_pos_break1'];
			$pdu3_pos_break2=$datosnodo['pdu3_pos_break2'];
			
		}	

		echo "<script>document.wdm.repisa.value='$nuevarepisa';</script>";
		echo "<script>document.wdm.topologia.value='".$datosnodo['topologia']."';</script>";
		//echo "<script>document.wdm.estatus_cns.value='".$datosnodo['estatus_cns']."';</script>";		
?>


<div id="infequipo" style="margin: 0 auto;width :950px;<?=$vereq?>"> 
  <table width="950" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td width="234" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo49" colspan=4>INFORMACION DEL NODO </td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">Estatus CNS del Nodo</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="estatus_cns" readonly type="text" id="estatus_cns" title='Estatus del WDM' value="<?=$datosnodo['estatus_cns']?>"/></td>
      <td class="Estilo28">&nbsp;</td>
      <td class="Estilo28">&nbsp;</td>
      <td class="Estilo28" style='<?=$verobscns?>'>&nbsp;</td>
    </tr>

    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">Proveedor</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><?=$proveedor?></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">Modelo</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28">
      <?php
      $selmod1=$selmod2="";
      if($repadm_conxadsl=="OptiX OSN1800I")  $selmod1="selected";
      if($repadm_conxadsl=="OptiX OSN1800II") $selmod2="selected";        
      echo "<select name=modelo>\n";
      echo "<option value=''></option>\n";
      echo "<option value='OptiX OSN1800I'  $selmod1>OptiX OSN1800I</option>\n";
      echo "<option value='OptiX OSN1800II' $selmod2>OptiX OSN1800II</option>\n";            
      echo "</select>\n";
      ?>      
      </td>
    </tr>
        <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">Repisa</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><?=$nuevarepisa?></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">Release</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><span class="Estilo48">
        <input name="version_nodo" size=10 type="text" class="Estilo48" id="version_nodo" title='Indicar la version del Nodo' value="<?=$version_nodo?>"/>
      </span></td>
    </tr>
    
        <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
          <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">CLLI</td>
          <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="clli_equipo" type="text" class="Estilo48" id="clli_equipo" title='CLLI del Equipo' size="28" onchange='submit()' value="<?=$clli_equipo?>" <?=$cllitxt?>/></td>
          <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">Siglas</td>
          <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><?=$siglas?></td>
        </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">&nbsp;</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28">&nbsp;        </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">OT</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28">
      <?php if ($congelar<>"1" and $congelarnodo<>"1") {?>
		<input name="cargaot" type="button" class="Estilo49" id="button" title='Opcion para cargar la OT (Grafo) del Nodo' onclick="window.open('carga_archivos_wdm?tec=wdm&tipo=ot&id=<?=$id?>&wdm=<?=$wd?>&congelar=<?=$congelar?>&congelarnodo=<?=$congelarnodo?>');" value="Cargar OT" />
      <?php }?>

		<input name="ot_nodo" readonly type="text" class="Estilo48" id="ot_nodo" title='OT del Nodo' value="<?=$datosnodo['ot_nodo']?>" size="5"/>

      <?php if ($congelar<>"1" and $congelarnodo<>"1") {?>
		<input name="cargaotamp" type="button" class="Estilo49" id="button" title='Opcion para cargar la OT de Ampliacin del Nodo' onclick="window.open('carga_archivos_wdm?tec=wdm&tipo=otamp&id=<?=$id?>&wdm=<?=$wd?>&congelar=<?=$congelar?>&congelarnodo=<?=$congelarnodo?>');" value="Cargar AMP." />

      <?php }?>
		
        <?php
         //if ($congelar<>"1"  and $congelarnodo<>"1") echo "<input name='creaot' type='button' class='Estilo49' id='button' title='Opcion para generar el Anexo de la OT (Grafo) del Nodo'   onclick=\"window.open('crea_orden_wdm_pdf.php?clli_equipo=$clli_equipo&congelar=$congelar&congelarnodo=$congelarnodo');\" value='Genera Anexo OT' />";
       ?>

    </td>
    </tr>
    
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">Identificador de Nodo </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="id_nodo" type="text" class="Estilo48" id="id_nodo" title='Identificador de Nodo' size="28" value="<?=$id_nodo?>" readonly/></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">Ubicacion del Nodo </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="ubi_nodo_adm" type="text" class="Estilo48" id="ubi_nodo_adm" title='Ubicacion del Nodo' value="<?=$ubi_nodo_adm?>" size="28"/></td>
    </tr>
    
    
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">IP del Nodo</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="ip_gestion" type="text" class="Estilo48" id="ip_gestion" title='IP del Nodo' value="<?=$ip_gestion?>" size="28"/></td>
      <td class="Estilo42">&nbsp;</td>
      <td class="Estilo28">&nbsp;</td>
    </tr>
    
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td class="Estilo42"><span class="Estilo49">REM. DE ALIM. PLANTA 1 </span></td>
      <td class="Estilo28">&nbsp;</td>
      <td class="Estilo42">&nbsp;</td>
      <td class="Estilo28">&nbsp;</td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td class="Estilo42">Ubic. Bast Distribuidor C.D. V1 </td>
      <td class="Estilo28"><input name="remate_cd1" type="text" class="Estilo48" id="remate_cd1" title='Ubicacion del Bastidor Distribuidor de CD' value="<?=$remate_cd1?>" size="28"/></td>
      <td class="Estilo42">Long. cable alimentacion</td>
      <td class="Estilo28"><input name="long_cable1" type="text" class="Estilo48" id="long_cable1" title='Longitud del cable' value="<?=$long_cable1?>" size="28"/></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td class="Estilo42">Calibre del cable </td>
      <td class="Estilo28"><input name="cal_cable_1" type="text" class="Estilo48" id="cal_cable_1" title='Calibre del cable' value="<?=$cal_cable_1?>" size="28"/></td>
      <td class="Estilo42">Cap. de Breakers</td>
      <td class="Estilo28"><input name="cap_break1" type="text" class="Estilo48" id="cap_break1" title='Capacidad de Breakers' value="<?=$cap_break1?>" size="28"/></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td class="Estilo42">Pos. Breakers BDCD</td>
      <td class="Estilo28"><input name="bdcd_1" type="text" class="Estilo48" id="bdcd_1" title='Posicion de Breakers BDCD' value="<?=$bdcd_1?>" size="28"/></td>
      <td class="Estilo42">&nbsp;</td>
      <td class="Estilo28">&nbsp;</td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td class="Estilo42"><span class="Estilo49">REM. DE ALIM. PLANTA 2 </span></td>
      <td class="Estilo28">&nbsp;</td>
      <td class="Estilo42">&nbsp;</td>
      <td class="Estilo28">&nbsp;</td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td class="Estilo42">Ubic. Bast Distribuidor C.D. V2 </td>
      <td class="Estilo28"><input name="remate_cd2" type="text" class="Estilo48" id="remate_cd2" title='Ubicacion del Bastidor Distribuidor de CD' value="<?=$remate_cd2?>" size="28"/></td>
      <td class="Estilo42">Long. cable alimentacion</td>
      <td class="Estilo28"><input name="long_cable2" type="text" class="Estilo48" id="long_cable2" title='Longitud del cable' value="<?=$long_cable2?>" size="28"/></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td class="Estilo42">Calibre del cable</td>
      <td class="Estilo28"><input name="cal_cable_2" type="text" class="Estilo48" id="cal_cable_2" title='Calibre del cable' value="<?=$cal_cable_2?>" size="28"/></td>
      <td class="Estilo42">Cap. de Breakers</td>
      <td class="Estilo28"><input name="cap_break2" type="text" class="Estilo48" id="cap_break2" title='Capacidad de Breakers' value="<?=$cap_break2?>" size="28"/></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td class="Estilo42">Pos. Breakers BDCD</td>
      <td class="Estilo28"><input name="bdcd_2" type="text" class="Estilo48" id="bdcd_2" title='Posicion de Breakers BDCD' value="<?=$bdcd_2?>" size="28"/></td>
      <td class="Estilo42">&nbsp;</td>
      <td class="Estilo28">&nbsp;</td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td class="Estilo42"><span class="Estilo49">REM. DE ALIM. PDU/PDF EQUIPOS</span></td>
      <td class="Estilo28"><span class="Estilo42">Cap. de Breakers Equipos</span></td>
      <td class="Estilo42">Pos. Breakers BDCD V1</td>
      <td class="Estilo28"><span class="Estilo42">Pos. Breakers BDCD V2</span></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td class="Estilo42">Repisa 1 <span class="Estilo28">
      </span></td>
      <td class="Estilo28"><input name="pdu1_cap_break1" type="text" class="Estilo48" id="pdu1_cap_break1" title='Capacidad de Breakers' value="<?=$pdu1_cap_break1?>" size="28"/></td>
      <td class="Estilo42"><span class="Estilo28">
        <input name="pdu1_pos_break1" type="text" class="Estilo48" id="pdu1_pos_break1" title='Posicion de Breakers' value="<?=$pdu1_pos_break1?>" size="28"/>
      </span></td>
      <td class="Estilo28"><span class="Estilo42">
        <input name="pdu1_pos_break2" type="text" class="Estilo48" id="pdu1_pos_break2" title='Posicion de Breakers' value="<?=$pdu1_pos_break2?>" size="28"/>
      </span></td>
    </tr>
    <tr bordercolor="#CAE4FF">
      <td class="Estilo42">Repisa 2 <span class="Estilo28">
      </span></td>
      <td class="Estilo28"><input name="pdu2_cap_break1" type="text" class="Estilo48" id="pdu2_cap_break1" title='Capacidad de Breakers' value="<?=$pdu2_cap_break1?>" size="28"/></td>
      <td class="Estilo42"><span class="Estilo28">
        <input name="pdu2_pos_break1" type="text" class="Estilo48" id="pdu2_pos_break1" title='Posicion de Breakers' value="<?=$pdu2_pos_break1?>" size="28"/>
      </span></td>
      <td class="Estilo28"><span class="Estilo42">
        <input name="pdu2_pos_break2" type="text" class="Estilo48" id="pdu2_pos_break2" title='Posicion de Breakers' value="<?=$pdu2_pos_break2?>" size="28"/>
      </span></td>
    </tr>
    <tr bordercolor="#CAE4FF">
      <td class="Estilo42">Repisa 3 <span class="Estilo28">
      </span></td>
      <td class="Estilo28"><input name="pdu3_cap_break1" type="text" class="Estilo48" id="pdu3_cap_break1" title='Capacidad de Breakers' value="<?=$pdu3_cap_break1?>" size="28"/></td>
      <td class="Estilo42"><span class="Estilo28">
        <input name="pdu3_pos_break1" type="text" class="Estilo48" id="pdu3_pos_break1" title='Posicion de Breakers' value="<?=$pdu3_pos_break1?>" size="28"/>
      </span></td>
      <td class="Estilo28"><span class="Estilo42">
        <input name="pdu3_pos_break2" type="text" class="Estilo48" id="pdu3_pos_break2" title='Posicion de Breakers' value="<?=$pdu3_pos_break2?>" size="28"/>
      </span></td>
    </tr>

    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td class="Estilo42">&nbsp;</td>
      <td class="Estilo28"><input class='Estilo57' type="button" name="guardar" id="button" value="Guardar Datos del Nodo" onclick='document.wdm.altanodo.value=1;submit();' /></td>
      <td class="Estilo28"><input class='Estilo57' type="button" name="cnsnd" id="cnsnd" value="Solicitar Gestin de NODO" onclick='document.wdm.solcns.value=2;submit();'></td>
      <td class="Estilo28" style='<?=$verobscnsnd?>'><textarea class='Estilo28' name='obscnsnd' id='obscnsnd'></textarea></td> 
    </tr></table>
<p><br>  
</div>
    <!-- ############################################TARJETAS Y PUERTOS ##########################################################################--> 
    
    <?php


if ($altatj=="altatj")
{
	$faltan_datostj="";
	if (trim($repisat)=='')			$faltan_datostj.="Debe seleccionar la repisa\\n";	
	if (trim($modelo_tarjeta)=='')		$faltan_datostj.="Debe seleccionar el Modelo de la Tarjeta\\n";
	if (trim($slot)=='')			$faltan_datostj.="Debe seleccionar la Posicin de la Tarjeta (Slot en la Repisa)\\n";

	if ($faltan_datostj<>"") echo "<script>alert('$faltan_datostj');</script>";

	if ($faltan_datostj=="")
	{
		$error="";
		$qalta="INSERT INTO inventario_tarjetas_wdm (wdm, id_nodo, modelo_tarjeta, repisat, posicion_tarjeta, modulo, subslot, fecha_alta, login, num_ot_frida, estatus) VALUES ('$wd', '$id_nodo', '$modelo_tarjeta', '$repisat', '$slot', '$tipo_tarjeta', '$subslot', NOW(),'".$sess_usr."','$rf','POR REVISAR')";
		//echo $qalta;
		mysql_query($qalta);
	}
}


if (substr($altatj,0,6)=="bajatj")
{
	$idtj=substr($altatj,strpos($altatj,"-",7)+1);
	$qbajatj=mysql_query("SELECT id_nodo, repisat, posicion_tarjeta, subslot from inventario_tarjetas_wdm where id='$idtj'");
	$idnodobajatj=mysql_result($qbajatj,0,0);
	$repbajatj=mysql_result($qbajatj,0,1);
	$slotbajatj=mysql_result($qbajatj,0,2);
	$subslotbajatj=mysql_result($qbajatj,0,3);
	mysql_query("DELETE FROM inventario_tarjetas_wdm where id='$idtj'");
	mysql_query("DELETE FROM inventario_puertos_wdm where wdm='$wd' and id_nodo='$idnodobajatj' and repisat='$repbajatj' and posicion_tarjeta='$slotbajatj' and subslot='$subslotbajatj'");
}
if(trim($ip_gestion)=="" or substr($tipoequipo,0,1)=="e") $vertarj="display:none";
else $vertarj="";

echo "<div id='inftarjetas' style='margin: 0 auto;width :950px;$vertarj'>";
if ($datosnodo['proveedor_tx']=='HUAWEI')
{
	echo "<table width='950' border='3' cellspacing='1' bordercolor='#999999' bgcolor='#CAE4FF'>\n";
	echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>\n";
	echo "<td colspan=6 class='Estilo49'>ALTA TARJETAS</td></tr>\n";
      
	echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>\n";
	echo "<td class='Estilo53'>Repisa</td>\n";
	echo "<td class='Estilo53'>Modelo Tarjeta </td>\n";	
	echo "<td class='Estilo53'>Slot</td>\n";
	if ($datosnodo['proveedor_tx']=='ALCATEL') echo "<td class='Estilo53'>Subslot</td>\n";
	if ($datosnodo['proveedor_tx']=='ALCATEL') echo "<td class='Estilo53'>Modulo</td>\n";
	if ($datosnodo['proveedor_tx']=='CISCO') echo "<td class='Estilo53'>&nbsp</td>\n";
	if ($datosnodo['proveedor_tx']=='CISCO') echo "<td class='Estilo53'>&nbsp</td>\n";
	echo "<td class='Estilo53'>Agregar/Borrar</td></tr>\n\n";
	

	$r1=$r2=$r3="";
	if($repisat2<>"") $repisat=$repisat2;
	if ($repisat=="1") $r1="selected";
	if ($repisat=="2") $r2="selected";
	if ($repisat=="3") $r3="selected";
	if ($repisat=="4") $r4="selected";
?>
    
</p>
  <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td>
        <select name="repisat" title='Seleccionar la Repisa' onchange="submit();">
          <option value=" "></option>
          <option value="01" <?=$r1?>>01</option>
          <option value="02" <?=$r2?>>02</option>
          <option value="03" <?=$r3?>>03</option>
          <option value="04" <?=$r4?>>04</option>          
        </select>
      </td>
      
<?php
        
	if($modelo_tarjeta2<>"") $modelo_tarjeta=$modelo_tarjeta2;
	$query="select modelo_tarjeta from cat_tarjetas_wdm where proveedor='".$datosnodo['proveedor_tx']."' and equipo like '%".substr($datosnodo['repadm_conxadsl'],0,4)."%' group by modelo_tarjeta order by modelo_tarjeta ASC";
	$res = mysql_query($query);	

	echo "<td class='Estilo28'>";
	echo "<select name='modelo_tarjeta' onchange='submit()'>\n<option value=''></option>\n";
	if ($row = mysql_fetch_array($res)){
		do { 
			if($modelo_tarjeta==$row["modelo_tarjeta"]) $selmt="selected";
			else $selmt="";
     			echo "<option $selmt value= '".$row["modelo_tarjeta"]."'>".$row["modelo_tarjeta"]."</option>\n";
		} while ($row = mysql_fetch_array($res)); 
	}			
	echo "</select></td>\n\n";
?>
      
            
      <td class="Estilo28">
        <?php
        			if($slot2<>"") $slot=$slot2;
				$query="select slot from cat_tarjetas_wdm where proveedor='".$datosnodo['proveedor_tx']."'  and equipo like '%".substr($datosnodo['repadm_conxadsl'],0,4)."%' and modelo_tarjeta like '$modelo_tarjeta' group by slot order by slot";
				$res = mysql_query($query);	
				if(mysql_num_rows($res)>0) $slotq=explode(",",mysql_result($res,0,0));
				$tjsl_cargadas=mysql_query("SELECT posicion_tarjeta from inventario_tarjetas_wdm where wdm='$wd' and id_nodo='$id_nodo' and repisat='$repisat' order by posicion_tarjeta");
				for ($tjc=0;$tjc<mysql_num_rows($tjsl_cargadas);$tjc++) $tjslc[$tjc]=mysql_result($tjsl_cargadas,$tjc,0);
	
				echo "<select name='slot' onchange='submit()'>\n<option value=''></option>\n";

				foreach($slotq as $row){
                                       if($slot==$row) $selrep="selected";
				       else $selrep="";
				       if(!in_array($row,$tjslc) or $row==$slot)  echo "<option $selrep value= '".$row."'>".$row."</option>\n";
				}			
				echo "</select>\n\n";
				
			?>
    </td>
         <td width='40px' align='center'><img src='images/add.png' onclick='document.wdm.altatj.value="altatj";document.wdm.submit();'></td></tr>
    </tr>
    
    
<?php

//##################TARJETAS CONFIGURADOS##########################

	$tj_cargadas=mysql_query("SELECT * from inventario_tarjetas_wdm where wdm='$wd' and id_nodo='$id_nodo' order by repisat, posicion_tarjeta, subslot");
	echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo49'><td colspan=6><br>TARJETAS CONFIGURADAS</td></tr>\n";
	
	if ($tj_carga = mysql_fetch_array($tj_cargadas))
	{ 
		$ntj=0;
		do {  
			if($repisat==$tj_carga['repisat'] and  $tipo_tarjeta==$tj_carga['modulo'] and $slot==$tj_carga['posicion_tarjeta'] and $subslot==$tj_carga['subslot'])  $clase="Estilo70";
			else $clase="Estilo42";
			
			$idtj=$tj_carga['id'];
			echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='$clase' title='Click para ver los puertos de esta tarjeta' onmouseover='this.className=\"Estilo70\";' onmouseout='this.className=\"$clase\";' onclick='document.wdm.verpuertos.value=1;document.wdm.repisat2.value=\"".$tj_carga['repisat']."\";document.wdm.modelo_tarjeta2.value=\"".$tj_carga['modelo_tarjeta']."\";document.wdm.slot2.value=\"".$tj_carga['posicion_tarjeta']."\";document.wdm.subslot2.value=\"".$tj_carga['subslot']."\";document.wdm.tipo_tarjeta2.value=\"".$tj_carga['modulo']."\";document.wdm.submit()'>\n";
			echo "<td>".$tj_carga['repisat']."</td>\n";
			echo "<td>".$tj_carga['modelo_tarjeta']."</td>\n";
			echo "<td>".$tj_carga['posicion_tarjeta']."</td>\n";
			
			if ($datosnodo['proveedor_tx']=="ALCATEL")
			{
				echo "<td>".$tj_carga['subslot']."</td>\n";
				echo "<td>".$tj_carga['modulo']."</td>\n";
			}
			if ($datosnodo['proveedor_tx']=="CISCO")
			{
				echo "<td>&nbsp</td>\n";
				echo "<td>&nbsp</td>\n";
			}
			$pto_gestion=mysql_query("SELECT gestionada from inventario_puertos_wdm where wdm='$wd' and id_nodo='$id_nodo' and  repisat='".$tj_carga['repisat']."' and posicion_tarjeta='".$tj_carga['posicion_tarjeta']."' and subslot='".$tj_carga['subslot']."' and gestionada='GESTIONADO' order by puerto");
			$ptogest=mysql_num_rows($pto_gestion);
			if($ptogest==0) echo "<td width='60px' align=center bordercolor='#CAE4FF' bgcolor='#CAE4FF' ><img src='images/erase.png' onclick='document.wdm.altatj.value=\"bajatj-$ntj-$idtj\";document.wdm.submit();'></td></tr>\n\n";
			else echo "<td width='60px' align=center bordercolor='#CAE4FF' bgcolor='#CAE4FF' >P. GEST.</td></tr>\n\n";
			$ntj++;     		
		} while ($tj_carga = mysql_fetch_array($tj_cargadas));
	} 
}
?>   
   
  </table><br>



<!-- ###################### Tabla de puertos  ##############################-->

   
<?php

//***************Graba datos de puertos*********************************

$puerto_ngb="ptos_1gb";
$capacidad_puerto=1;

if(strstr($tipo_tarjeta,"1Ge"))  {$capacidad_puerto=1; $puerto_ngb="ptos_1gb";}
if(strstr($tipo_tarjeta,"10Ge")) {$capacidad_puerto=10;$puerto_ngb="ptos_10gb";}
if(strstr($ptow,"G")) {$capacidad_puerto=10;$puerto_ngb="ptos_1gb";}


if(strlen($uppto)>1)
{
	$upidpto=substr($uppto,strpos($uppto,"-",2)+1);
	$npto=substr($uppto,2,strpos($uppto,"-",2)-2);	
}

if (substr($uppto,0,1)=="a")
{

	if(strlen($uppto)==1)
	{

		if($frec<>"")	$capacidad_puerto=$frec;

		$faltan_datospto="";
		if (trim($ptow)=='' or trim($ptow)==0)	$faltan_datospto.="Debe seleccionar el Puerto\\n";		
		if (trim($pto_tipo)=='')	$faltan_datospto.="Debe seleccionar el Tipo de Puerto del Puerto\\n";
		//if (trim($pto_ubicacion)=='')	$faltan_datospto.="Debe seleccionar la Ubicacin del Puerto\\n";
		//if (trim($pto_repisa)=='')	$faltan_datospto.="Debe seleccionar la Repisa del Puerto\\n";
		//if (trim($pto_contacto)=='')	$faltan_datospto.="Debe seleccionar el Contacto del Puerto\\n";
		//if (trim($jmp_tipo)=='')	$faltan_datospto.="Debe seleccionar el tipo de Conector del Jumper ptico\\n";
		//if (trim($jmp_long)=='')	$faltan_datospto.="Debe seleccionar la longitud del Jumper ptico\\n";
		//if (trim($jmp_cnct)=='')	$faltan_datospto.="Debe seleccionar el tipo de Jumper ptico\\n";
		$altapto="REPLACE INTO inventario_puertos_wdm (wdm, id_nodo, repisat, posicion_tarjeta, subslot, puerto, tipo_puerto, ubicacion_bdfo, repisa_bdfo, contacto_bdfo, tipo_jumper, long_jumper, tipo_conector,capacidad_puerto, tipo_mod, lambda, frecuencia, fecha_alta,login,gestionada,estatus) VALUES ('$wd', '$id_nodo', '$repisat', '$slot','$subslot','$ptow','$pto_tipo','$pto_ubicacion','$pto_repisa','$pto_contacto','$jmp_tipo','$jmp_long','$jmp_cnct','$capacidad_puerto','$mod_tipo','$lambda','$frec',NOW(),'".$sess_usr."','NO GESTIONADO','DISPONIBLE')";	
		
	
	}

	if(strlen($uppto)>1)
	{
               	$faltan_datospto="";
	        if (trim($pto_tipo_up[$npto])=='')	$faltan_datospto.="Debe seleccionar el Tipo de Puerto del Puerto\\n";
	       	if (trim($pto_ubicacion_up[$npto])=='')	$faltan_datospto.="Debe seleccionar la Ubicacin del Puerto\\n";
	        if (trim($pto_repisa_up[$npto])=='')	$faltan_datospto.="Debe seleccionar la Repisa del Puerto\\n";
	        if (trim($pto_contacto_up[$npto])=='')	$faltan_datospto.="Debe seleccionar el Contacto del Puerto\\n";
		$altapto="UPDATE inventario_puertos_wdm set puerto='$ptow_up[$npto]',tipo_puerto='$pto_tipo_up[$npto]',ubicacion_bdfo='$pto_ubicacion_up[$npto]',repisa_bdfo='$pto_repisa_up[$npto]',contacto_bdfo='$pto_contacto_up[$npto]',tipo_jumper='$jmp_tipo_up[$npto]',long_jumper='$jmp_long_up[$npto]',tipo_conector='$jmp_cnct_up[$npto]'  where wdm='$wd' and id='$upidpto'";		
	}	
		
	if ($faltan_datospto<>"")	echo "<script>alert('$faltan_datospto');</script>";
	if ($faltan_datospto=="")	mysql_query($altapto);
	//$pto_tipo="";
	//echo $altapto;
}


if (substr($uppto,0,1)=="b")
{
	if(strlen($uppto)>1)   $bajapto="DELETE from inventario_puertos_wdm where wdm='$wd' and id='$upidpto'";	
	mysql_query($bajapto);
	//echo $bajapto;
}
echo "</div>";

//###############################TABLA ALTA PUERTOS##############################################


if ($verpuertos==1) $verptos="";
else $verptos="style='display:none'";
echo "<div id='infpuertos' $verptos style='margin: 0 auto;width :950px;'>";
	
if(strstr($modelo_tarjeta,'MR') or strstr($modelo_tarjeta,'LQM') or strstr($modelo_tarjeta,'LSX')) 
{
	
	$pto_carga1="";
	$pto_cargados=mysql_query("SELECT * from inventario_puertos_wdm where wdm='$wd' and id_nodo='$id_nodo' and  repisat='$repisat' and posicion_tarjeta='$slot' order by puerto");

	$j=0;
	if ($row = mysql_fetch_array($pto_cargados)){
		do { 
			$pto_carga[$j]=$row['puerto'];
			$pto_carga1.=$pto_carga[$j].",";
			$lam_carga[$j]=$row['lambda'];
			$lam_carga1.=$lam_carga[$j].",";
			//echo $lam_carga[$j];
			//echo "-";
			$j++;
		} while ($row = mysql_fetch_array($pto_cargados)); 
	}		

	$rowspan='';$colspan='colspan=10';
	if((strstr($modelo_tarjeta,'LQM') and strstr($ptow,'C')) or (strstr($modelo_tarjeta,'LSX') and strstr($ptow,'C')) or (strstr($modelo_tarjeta,'MR') and strstr($ptow,'L'))) {$rowspan='rowspan=2';$colspan='colspan=13';}
	echo "<table width='950' border='3' cellspacing='1' bordercolor='#999999' bgcolor='#CAE4FF'>\n";
	echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'><td $colspan width='221' class='Estilo49'>INFORMACION DE PUERTOS</td></tr>\n\n";



	echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>\n";
	echo "<td $rowspan class='Estilo53'>Repisa</td>\n";
	echo "<td $rowspan class='Estilo53'>Slot</td>\n";
	echo "<td $rowspan class='Estilo53'>Puerto</td>\n";
	echo "<td $rowspan class='Estilo53'>Tipo Puerto</td>\n";
	
	if((strstr($modelo_tarjeta,'LQM') and strstr($ptow,'L')) or (strstr($modelo_tarjeta,'LSX') and strstr($ptow,'L')) or (strstr($modelo_tarjeta,'MR') and strstr($ptow,'C')))
	{
		echo "<td class='Estilo53'>Tipo Mod.</td>\n";
		echo "<td class='Estilo53'>Lambda</td>\n";
		echo "<td class='Estilo53'>Frecuencia</td>\n";
	}
	
	if((strstr($modelo_tarjeta,'LQM') and strstr($ptow,'C')) or (strstr($modelo_tarjeta,'LSX') and strstr($ptow,'C')) or (strstr($modelo_tarjeta,'MR') and strstr($ptow,'L')))
	{
		echo "<td colspan=3 class='Estilo53' align=center>Remate en BDFO</td>\n";
		echo "<td colspan=3 class='Estilo53' align=center>Jumper Optico</td>\n";
	}

	echo "<td $rowspan class='Estilo53'>Estatus</td>\n";
	echo "<td $rowspan class='Estilo53'>Gestionado</td>\n";
	echo "<td $rowspan class='Estilo53'>Agregar/Borrar</td></tr>\n\n";
		
	if((strstr($modelo_tarjeta,'LQM') and strstr($ptow,'C')) or (strstr($modelo_tarjeta,'LSX') and strstr($ptow,'C')) or (strstr($modelo_tarjeta,'MR') and strstr($ptow,'L')))
	{
		echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>\n";
		echo "<td class='Estilo53'>Ubicacion</td>\n";
		echo "<td class='Estilo53'>Repisa</td>\n";
		echo "<td class='Estilo53'>Contacto</td>";
		echo "<td class='Estilo53'>Tipo Conector</td>\n";
		echo "<td class='Estilo53'>Longitud</td>\n";
		echo "<td class='Estilo53'>Tipo Jumper</td>\n";
		echo "</tr>\n";
	}
		
	echo "<tr>";
	echo "<td>$repisat</td>\n\n";
	echo "<td>$slot</td>\n\n";
	
	$query="select puertos from cat_tarjetas_wdm where proveedor='".$datosnodo['proveedor_tx']."'  and equipo like '%".substr($datosnodo['repadm_conxadsl'],0,4)."%' and modelo_tarjeta like '$modelo_tarjeta' group by puertos order by puertos";
	$res = mysql_query($query);	
	if(mysql_num_rows($res)>0) $slotq=explode(",",mysql_result($res,0,0));

	echo "<td><select name='ptow' onchange='document.wdm.verpuertos.value=1;document.wdm.submit();'>\n<option value=''></option>\n";
	foreach($slotq as $row){
		if(!in_array($row,$pto_carga))
		{
			if($ptow==$row) $selptow="selected";
			else $selptow="";
			echo "<option $selptow value= '".$row."'>".$row."</option>\n";
		}	
	}
	echo "</select></td>\n\n";
	
	
	$ptow1=substr($ptow,1,1);
	$modtar=substr($modelo_tarjeta,0,3);
	$query="select concat(tipo_puerto,' (',alcance,')') as pto_tipo from cat_puertos_wdm where tipo_modulo like '$ptow1%' and tipo_tarjeta='$modtar' order by tipo_puerto,alcance";
	$res = mysql_query($query);

	echo "<td><select name='pto_tipo'>\n";
	echo "<option value=''></option>\n";
	
	if ($row = mysql_fetch_array($res)){
		do { 
			if($pto_tipo==$row["pto_tipo"]) $seltpto="selected";
			else $seltpto="";
     			echo "<option $seltpto value= '".$row["pto_tipo"]."'>".$row["pto_tipo"]."</option>\n";
		} while ($row = mysql_fetch_array($res)); 
	}			
	echo "</select></td>\n";	
	
	
	if((strstr($modelo_tarjeta,'LQM') and strstr($ptow,'L')) or (strstr($modelo_tarjeta,'LSX') and strstr($ptow,'L')) or (strstr($modelo_tarjeta,'MR') and strstr($ptow,'C')))
	{
		$selcwdm=$seldwdm="";
		if($mod_tipo=="CWDM") $selcwdm="selected";
		if($mod_tipo=="DWDM") $seldwdm="selected";
		
		echo "<td><select name='mod_tipo' title='Tipo de Modulación' onchange='document.wdm.verpuertos.value=1;document.wdm.submit();'>\n";
		echo "<option value=' '></option>\n";
		echo "<option value='CWDM' $selcwdm>CWDM</option>\n";
		echo "<option value='DWDM' $seldwdm>DWDM</option>\n";	
		echo "</select></td>\n";
	
		$query="SELECT lambda,frecuencia from lambda where tipo='$mod_tipo' order by lambda";
		$res = mysql_query($query);
		$frec='';
	
		echo "<td><select name='lambda' onchange='document.wdm.verpuertos.value=1;document.wdm.submit();'>\n";
		echo "<option value=''></option>\n";
	
		if ($row = mysql_fetch_array($res)){
			do { 
		     		if(!in_array($row["lambda"],$lam_carga))
		     		{
					if($lambda==$row["lambda"]) {$sellam="selected";$frec=$row["frecuencia"];}
					else $sellam="";
	     				echo "<option $sellam value= '".$row["lambda"]."'>".$row["lambda"]."</option>\n";
		     		}
			} while ($row = mysql_fetch_array($res)); 
		}			
		echo "</select></td>\n\n";
	
		echo "<td>$frec</td>\n\n";
		echo "<td>&nbsp</td>";
		echo "<td>&nbsp</td>";
		echo "<td width='40px' align='center'><img src='images/add.png' onclick='document.wdm.uppto.value=\"a\";document.wdm.verpuertos.value=1;document.wdm.frec.value=\"$frec\";document.wdm.submit();'></td></tr>\n\n";
	}
	
	
	if((strstr($modelo_tarjeta,'LQM') and strstr($ptow,'C')) or (strstr($modelo_tarjeta,'LSX') and strstr($ptow,'C')) or (strstr($modelo_tarjeta,'MR') and strstr($ptow,'L')))
	{
		echo "<td><input name='pto_ubicacion' type='text' class='Estilo42' id='pto_ubicacion' title='Ubicacion del Puerto' size='9' /></td>\n";
		echo "<td><input name='pto_repisa'    type='text' class='Estilo42' id='pto_repisa'    title='Repisa del Puerto'    size='9' /></td>\n";
		echo "<td><input name='pto_contacto'  type='text' class='Estilo42' id='pto_contacto'  title='Contacto del Puerto'  size='9' /></td>\n";

		echo "<td><select name='jmp_tipo' title='Tipo de jumper ptico'>";
		echo "<option value=' '></option>";
		echo "<option value='FC/FC'>FC/FC</option>\n";
		echo "<option value='FC/SC'>FC/SC</option>\n";
		echo "<option value='FC/LC'>FC/LC</option>\n";
		echo "<option value='SC/FC'>SC/FC</option>\n";
		echo "<option value='SC/SC'>SC/SC</option>\n";
		echo "<option value='SC/LC'>SC/LC</option>\n";
		echo "<option value='LC/FC'>LC/FC</option>\n";			
		echo "<option value='LC/SC'>LC/SC</option>\n";
		echo "<option value='LC/LC'>LC/LC</option>\n";
		echo "<option value='RJ45'>RJ45</option>\n";
		echo "</select></td>\n";
	
		$jmplong=array(2,3,4,5,6,7,8,9,10,12,13,14,15,16,17,18,20,22,24,25,26,28,30,32,34,35,36,38,40,42,44,45,46,48,50);
		echo "<td><select name='jmp_long' title='Longitud del jumper ptico'>";
		echo "<option value=' '></option>";
		
		for ($jl=0;$jl<count($jmplong);$jl++)
		{
			$valjmplong=$jmplong[$jl];
			echo "<option value='$valjmplong' $selff>$valjmplong</option>\n";
		}
		echo "</select></td>\n";
	
		echo "<td><select name='jmp_cnct' title='Tipo de conector del jumper ptico'>";
		echo "<option value=' '></option>";
		echo "<option value='MULTIMODO'>MULTIMODO</option>\n";
		echo "<option value='MONOMODO' >MONOMODO</option>\n";
		echo "<option value='UTP' >UTP</option>\n";	
		echo "</select></td>\n";

	
		echo "<td>&nbsp</td>";
		echo "<td>&nbsp</td>";
		echo "<td width='40px' align='center'><img src='images/add.png' onclick='document.wdm.uppto.value=\"a\";document.wdm.verpuertos.value=1;document.wdm.submit();'></td></tr>\n\n";

	}
	echo "</table><br>\n\n";
	//##################PUERTOS CONFIGURADOS##########################


	$pto_carga1="";
	$pto_cargados=mysql_query("SELECT id,repisat,posicion_tarjeta,puerto,tipo_puerto,concat(ubicacion_bdfo,'/',repisa_bdfo,'/',contacto_bdfo,'/',tipo_jumper,'/',long_jumper,'/',tipo_conector) as datbdfo, concat(lambda,'/',frecuencia) as datlamb, estatus,gestionada from inventario_puertos_wdm where wdm='$wd' and id_nodo='$id_nodo' and  repisat='$repisat' and posicion_tarjeta='$slot' order by puerto");

	for($j=0;$j<mysql_num_rows($pto_cargados);$j++) 
	{
		$pto_carga[$j]=mysql_result($pto_cargados,$j,6);
		$pto_carga1.=$pto_carga[$j].",";
	}
	if (substr($uppto,0,1)=="a")
	{
		$pto_carga1=substr($pto_carga1,0,-1);
		mysql_query("UPDATE inventario_tarjetas_wdm set $puerto_ngb='$pto_carga1' where id_nodo='$id_nodo'");
	}

	echo "<table width='950' border='3' cellspacing='1' bordercolor='#999999' bgcolor='#CAE4FF'>\n";
	echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo49'><td colspan=8><br>PUERTOS CONFIGURADOS</td></tr>";
	echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>\n";
	echo "<td class='Estilo53'>Repisa</td>\n";
	echo "<td class='Estilo53'>Slot</td>\n";
	echo "<td class='Estilo53'>Puerto</td>\n";
	echo "<td class='Estilo53'>Tipo Puerto</td>\n";
	echo "<td class='Estilo53'>Datos BDFO y/o Lambda</td>\n";
	echo "<td class='Estilo53'>Estatus</td>\n";
	echo "<td class='Estilo53'>Gestionado</td>\n";
	echo "<td class='Estilo53'></td>\n";
	echo "</tr>";
	
	if(mysql_num_rows($pto_cargados)>0) mysql_data_seek($pto_cargados, 0);
	if ($pto_carga = mysql_fetch_array($pto_cargados)){ 
	$npto=0;	
	
		do {  
			$idpto=$pto_carga['id'];
			echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>";
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>".$pto_carga['repisat']."</td>\n";
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>".$pto_carga['posicion_tarjeta']."</td>\n";
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>".$pto_carga['puerto']."</td>\n";
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>".$pto_carga['tipo_puerto']."</td>\n";
			if(strlen($pto_carga['datbdfo'])>10) echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>".$pto_carga['datbdfo']."</td>\n";
			else                                 echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>".$pto_carga['datlamb']."</td>\n";
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>".$pto_carga['estatus']."</td>\n";
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>".$pto_carga['gestionada']."</td>\n";
	      		if ($pto_carga['gestionada']<>"GESTIONADO") echo "<td width='60px' align=center bordercolor='#CAE4FF' bgcolor='#CAE4FF' ><img src='images/save.png' onclick='document.wdm.uppto.value=\"a-$npto-$idpto\";document.wdm.submit();'>&nbsp &nbsp<img src='images/erase.png' onclick='document.wdm.uppto.value=\"b-$npto-$idpto\";document.wdm.verpuertos.value=1;document.wdm.submit();'></td></tr>";
	      		else  echo "<td width='60px' align=center bordercolor='#CAE4FF' bgcolor='#CAE4FF' >&nbsp</td></tr>";
			$npto++;     		
		} while ($pto_carga = mysql_fetch_array($pto_cargados));
	} 
	echo "</table><br>\n\n";
}
echo "</div>\n";
?>      

  <?php
  
//##################################################################SECCIONES#########################################################################################

  	if(substr($tipoequipo,0,1)=="e")
  	{
  		if($cambionodo==1)
		{
			$pto_troncal_d="";
			$combo_pto_troncal_d="";
			$id_pto_troncal_d="";
			$nominter_troncal_d="";
			$desc_nominter_troncal_d="";
			$ip_troncal_d="";
			$mtu_d="1564";
			
			$pto_troncal_a="";
			$combo_pto_troncal_a="";
			$id_pto_troncal_a="";
			$nominter_troncal_a="";
			$desc_nominter_troncal_a="";
			$ip_troncal_a="";
			$mtu_a="1564";
			$ref_sisa_e="";
			
			$pto_troncal_dr="";
			$combo_pto_troncal_dr="";
			$id_pto_troncal_dr="";
			$nominter_troncal_dr="";
			$desc_nominter_troncal_dr="";
			$ip_troncal_dr="";
			
			$pto_troncal_ar="";
			$combo_pto_troncal_ar="";
			$id_pto_troncal_ar="";
			$nominter_troncal_ar="";
			$desc_nominter_troncal_ar="";
			$ip_troncal_ar="";
			$ip_mascara_dr="255.255.255.252";
			
			$hostname_rcdt="";
			$central_rcdt="";
			$vel_pto="";
			$remate_rcdt="";
			$long_cable_rcdt="";
			
			$no_cambio_rcdt="";
			
			$cable="";
			$longitud="";
			$no_fibras1="";
			$no_fibras2="";			
			$central_a="";
			$piso_a="";
			$sala_a="";
			$fila_a="";
			$repisa_a="";
			$remate_a="";
			$central_b="";	
			$piso_b="";
			$sala_b="";
			$fila_b="";
			$repisa_b="";
			$remate_b="";
		}
  		if(substr($tipoequipo,3,1)=="d") {$origen="WDM ".substr($tipoequipo,2,1);$destino="WDM ".substr($tipoequipo,4,2);}
  		if(substr($tipoequipo,3,1)=="r") {$origen="WDM ".substr($tipoequipo,2,1);$destino="RCDT ".substr($tipoequipo,4,2);}
 	
	  	$dorig=mysql_query("SELECT wdm,id_nodo,clli_equipo,repisa,repadm_conxadsl,proveedor_tx from cat_wdm where id='$ido'");
		$ddest=mysql_query("SELECT wdm,id_nodo,clli_equipo,repisa,repadm_conxadsl,proveedor_tx from cat_wdm where id='$idd'");

		$wdm_orig=mysql_result($dorig,0,0);
		$idnodo_orig=mysql_result($dorig,0,1);
		$cllieq_orig=mysql_result($dorig,0,2);
		$repisa_orig=mysql_result($dorig,0,3);

		if (substr($tipoequipo,3,1)=="d" or substr($tipoequipo,1,1)=="d")	$repisa_orig="WDM".trim(substr($repisa_orig,-2));
		
		$modelo_orig=mysql_result($dorig,0,4);
		$prov_orig=mysql_result($dorig,0,5);
		$mod_orig=substr($modelo_orig,0,4);
		
		if($prov_orig=="ALCATEL") $mod_orig=substr($modelo_orig,0,4);
		if($prov_orig=="CISCO" and strlen($modelo_orig)>2)   $mod_orig=trim(substr($modelo_orig,2,3));
		if($prov_orig=="CISCO" and strlen($modelo_orig)==2)   $mod_orig=substr($modelo_orig,0,2);
		if($prov_orig=="HUAWEI") $mod_orig=substr($modelo_orig,6);


		if (substr($tipoequipo,3,1)<>"r")
		{
			$wdm_dest=mysql_result($ddest,0,0);
			$idnodo_dest=mysql_result($ddest,0,1); 	 
			$cllieq_dest=mysql_result($ddest,0,2);  	
			$repisa_dest=mysql_result($ddest,0,3);
			if (substr($tipoequipo,3,1)=="d")	$repisa_dest="WDM".trim(substr($repisa_dest,-2));
			else $repisa_dest="AGR".trim(substr($repisa_dest,-2));
			$modelo_dest=mysql_result($ddest,0,4);
			$prov_dest=mysql_result($ddest,0,5);
			if($prov_dest=="ALCATEL") $mod_dest=substr($modelo_dest,0,4);
			if($prov_dest=="CISCO" and strlen($modelo_dest)>2)   $mod_dest=trim(substr($modelo_dest,2,3));
			if($prov_dest=="CISCO" and strlen($modelo_dest)==2)   $mod_dest=substr($modelo_dest,0,2);
		}

  		//echo "$wdm_orig-$idnodo_orig-$cllieq_orig-$wdm_dest-$idnodo_dest-$cllieq_dest";
  	
		$pto_troncal_d=$combo_pto_troncal_d;
		$pto_troncal_a=$combo_pto_troncal_a;
		$pto_troncal_d=trim(strtr($pto_troncal_d,"CL", "  "));
		$pto_troncal_a=trim(strtr($pto_troncal_a,"CL", "  "));
		
		$pto_troncal_d=substr($pto_troncal_d,strpos($pto_troncal_d,"--")+2);
		$pto_troncal_a=substr($pto_troncal_a,strpos($pto_troncal_a,"--")+2);

	  	$id_pto_troncal_d="al-$cllieq_dest-$repisa_dest-$mod_dest-$pto_troncal_a";
  		$id_pto_troncal_a="al-$cllieq_orig-$repisa_orig-$mod_orig-$pto_troncal_d";
  	
	  	$nominter_troncal_d="$cllieq_orig-$cllieq_dest";
  		$nominter_troncal_a="$cllieq_dest-$cllieq_orig";  	

  		$desc_nominter_troncal_d="$repisa_orig-$repisa_dest";
  		$desc_nominter_troncal_a="$repisa_dest-$repisa_orig";


		if (substr($tipoequipo,1,1)=="a")
		{
		  	$nominter_troncal_d.="-".sprintf("%02s",$trayectoria);
  			$nominter_troncal_a.="-".sprintf("%02s",$trayectoria);

	  		$desc_nominter_troncal_d.="-".sprintf("%02s",$trayectoria);
  			$desc_nominter_troncal_a.="-".sprintf("%02s",$trayectoria);
		}

		if (substr($tipoequipo,3,1)=="r")
		{
			$wdm_dest="NA";
			$idnodo_dest="NA";
			$cllieq_dest="NA";
			$repisa_dest="NA";
			
			$pto_troncal_dr=$combo_pto_troncal_dr;
			$pto_troncal_dr=trim(strtr($pto_troncal_dr,"CL", "  "));
			$pto_troncal_dr=substr($pto_troncal_dr,strpos($pto_troncal_dr,"--")+2);			
			
			$cllieq_dest="RCDT";
			$veldesc=substr($vel_pto,0,-1);
		  	$id_pto_troncal_dr="al-RCDT-GEST-$equipo_rcdt$num_equipo_rcdt-$modelo_eq_rcdt-$pto_troncal_ar";
  			$desc_nominter_troncal_dr="$repisa_orig-RCDT-$veldesc";
		  	$nominter_troncal_dr="$cllieq_orig-$cllieq_dest";

	  		$id_pto_troncal_ar="al-$cllieq_orig-$repisa_orig-$mod_orig-$pto_troncal_dr";
	  		$desc_nominter_troncal_ar="RCDT-$repisa_orig-$veldesc";
	  		$nominter_troncal_ar="$cllieq_dest-$cllieq_orig";  	
	  		
	  		$hostname_rcdt="CTL_".$central_rcdt."_".$equipo_rcdt."_".$num_equipo_rcdt;
		}  		

  		$consorig=substr($tipoequipo,2,1);
  		$tiporig=strtoupper(substr($tipoequipo,1,1));
	  	if($tiporig=="A") $tiporig="AGR";
	  	if($tiporig=="D") $tiporig="WDM";
  		
	  	$consdest=substr($tipoequipo,4);
	  	$tipdest=strtoupper(substr($tipoequipo,3,1));
	  	if (substr($tipoequipo,3,1)=="r")  $consdest="";
	  	if($tipdest=="A") $tipdest="AGR";
	  	if($tipdest=="D") $tipdest="WDM";
	  		  	 	
	 	$altaenl=mysql_query("select repisa,secciones_wdm.id from cat_wdm inner join secciones_wdm on cat_wdm.wdm=secciones_wdm.wdm where cat_wdm.id='$ido' and desc_nominter_troncal_d like '$tiporig$consorig-$tipdest$consdest%' and trayectoria=$trayectoria;");

		if (mysql_num_rows($altaenl)>0 and $cambionodo==1)
		{
			$idenl=mysql_result($altaenl,0,1);
			$datos_enlace=mysql_query("SELECT * from secciones_wdm where id='$idenl'");
			
			$rowe = mysql_fetch_array($datos_enlace);
	
			$pto_troncal_d=$rowe['pto_troncal_d'];
			$id_pto_troncal_d=$rowe['id_pto_troncal_d'];
			$nominter_troncal_d=$rowe['nominter_troncal_d'];
			$desc_nominter_troncal_d=$rowe['desc_nominter_troncal_d'];
			$ip_troncal_d=$rowe['ip_troncal_d'];
			$mtu_d=$rowe['mtu_d'];
			
			$pto_troncal_a=$rowe['pto_troncal_a'];
			$id_pto_troncal_a=$rowe['id_pto_troncal_a'];
			$nominter_troncal_a=$rowe['nominter_troncal_a'];
			$desc_nominter_troncal_a=$rowe['desc_nominter_troncal_a'];
			$ip_troncal_a=$rowe['ip_troncal_a'];
			$mtu_a=$rowe['mtu_a'];	
			$no_cambio_rcdt=$rowe['no_cambio_rcdt'];
			
			$ip_mascara_dr=$rowe['ip_mascara_d'];	
			$vel_pto=$rowe['vel_pto_d'];
			$hostname_rcdt=$rowe['hostname_a'];
			
			$remate_rcdt=$rowe['remate_rcdt'];
			$long_cable_rcdt=$rowe['long_cable_rcdt'];

			if (strlen($hostname_rcdt)>0)	$central_rcdt=substr($hostname_rcdt,4,strpos($hostname_rcdt,"_",4)-4);
			
			$ref_sisa_e=$rowe['ref_sisa_e'];
			
			if($prov_orig=="ALCATEL")	{$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/', subslot+0, '/', if(instr(puerto,'G'),CONCAT(substr(puerto,1,instr(puerto,'G')-1), ' 10G'),puerto)) ";$repslotsubpto="repisa--slot/subslot/puerto";}
			if($prov_orig=="CISCO")		{$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/', if(instr(puerto,'G'),CONCAT(substr(puerto,1,instr(puerto,'G')-1), ' 10G'),puerto)) ";$repslotsubpto="repisa--slot/puerto";}
			if($prov_orig=="HUAWEI")	{$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/', puerto) ";$repslotsubpto="repisa/slot/puerto";}			

			$qcombo_pto_troncal_d=mysql_query("SELECT $rssp as ptoorig from inventario_puertos_wdm where wdm='$wd' and pto_troncal='$desc_nominter_troncal_d'");
			if (mysql_num_rows($qcombo_pto_troncal_d)>0)	$combo_pto_troncal_d=mysql_result($qcombo_pto_troncal_d,0,0);
			$qcombo_pto_troncal_a=mysql_query("SELECT $rssp as ptodest from inventario_puertos_wdm where wdm='$wd' and pto_troncal='$desc_nominter_troncal_a'");

			if (mysql_num_rows($qcombo_pto_troncal_a)>0)	$combo_pto_troncal_a=mysql_result($qcombo_pto_troncal_a,0,0);
		
			if (substr($tipoequipo,3,1)=="r")
			{
				$pto_troncal_dr=$pto_troncal_d;
				$pto_troncal_ar=$pto_troncal_a;
				$ip_troncal_dr=$ip_troncal_d;
				$ip_troncal_ar=$ip_troncal_a;	
				$id_pto_troncal_dr=$id_pto_troncal_d;
				$id_pto_troncal_ar=$id_pto_troncal_a;	
				$nominter_troncal_dr=$nominter_troncal_d;
				$nominter_troncal_ar=$nominter_troncal_a;
				$desc_nominter_troncal_dr=$desc_nominter_troncal_d;
				$desc_nominter_troncal_ar=$desc_nominter_troncal_a;

				$equipo_rcdt=substr($id_pto_troncal_dr,13,2);
				$num_equipo_rcdt=substr($id_pto_troncal_dr,15,2);
				$modelo_eq_rcdt=substr($id_pto_troncal_dr,18,4);

				$no_cambio_rcdt=$no_cambio_rcdt;
				
				$qcombo_pto_troncal_dr=mysql_query("SELECT $rssp as ptoorig from inventario_puertos_wdm where wdm='$wd' and pto_troncal='$desc_nominter_troncal_dr'");
				if (mysql_num_rows($qcombo_pto_troncal_dr)>0)	$combo_pto_troncal_dr=mysql_result($qcombo_pto_troncal_dr,0,0);
			}
		}
		
/*
		if (trim($ip_troncal_d)=="" or substr(trim($ip_troncal_d),0,3)<>172 or trim($ip_troncal_d)=='PENDIENTE')
		{
                        if($trayectoria==1 or $trayectoria==2)  $tray="-".sprintf("%02s",$trayectoria);
                        else $tray="";
			$ip_troncal_wdm=mysql_query("SELECT ip_troncal_d,ip_troncal_a from ip_troncal_wdm where wdm='$wd' and desc_nominter_troncal_d like '$repisa_orig-$repisa_dest$tray%'");
			if (mysql_numrows($ip_troncal_wdm)>0)
			{
				$ip_troncal_d=mysql_result($ip_troncal_wdm,0,0);
				if (trim($ip_troncal_a)=="" or substr(trim($ip_troncal_a),0,3)<>172) $ip_troncal_a=mysql_result($ip_troncal_wdm,0,1);
			}
		}
*/		
	}

  ?>
  
  <div id="infenlace" style="margin: 0 auto;width :950px;<?=$verenl?>;">

  <table width="950" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo49" colspan=4>INFORMACION DE LA SECCIÓN</td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td width="199" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">ORIGEN</td>
      <td width="200" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42"><?=$origen?></td>
      <td width="199" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">DESTINO</td>
      <td width="200" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42"><?=$destino?></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Puerto origen</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">
      
<?php


	if($proveedor=="HUAWEI")	{$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/', puerto) ";$repslotsubpto="repisa/slot/puerto";}	
	
  	$qpto_orig=mysql_query("SELECT $rssp as ptoorig from inventario_puertos_wdm where wdm='$wd' and puerto like '%L' and lambda=0 and ((id_nodo='$idnodo_orig' and estatus='DISPONIBLE') or (pto_troncal='$desc_nominter_troncal_d')) order by repisat, posicion_tarjeta, subslot, puerto");

	if ($rowpto_orig = mysql_fetch_array($qpto_orig))
	{ 
		echo "<select name='combo_pto_troncal_d' id='combo_pto_troncal_d' onchange='submit()'>";
		echo "<option value=''></option>";
		do 
		{  
			$selptoorig="";
			$ptoorig=$rowpto_orig["ptoorig"];
			if ($ptoorig==$combo_pto_troncal_d) $selptoorig="selected";
			echo "<option value='".$ptoorig."' $selptoorig>".$ptoorig."</option>";
		}
		while ($rowpto_orig = mysql_fetch_array($qpto_orig)); 
		
		echo "</select>($repslotsubpto)";
	}	
   
echo "</td>";
?>     

       
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Puerto origen</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">
      
 
<?php

	$qpto_dest=mysql_query("SELECT $rssp as ptodest from inventario_puertos_wdm where wdm='$wd' and puerto like '%L' and lambda=0 and ((id_nodo='$idnodo_dest' and estatus='DISPONIBLE') or (pto_troncal='$desc_nominter_troncal_a')) order by repisat, posicion_tarjeta, subslot, puerto");

	if ($rowpto_dest = mysql_fetch_array($qpto_dest))
	{ 
		echo "<select name='combo_pto_troncal_a' id='combo_pto_troncal_a' onchange='submit()'>";
		echo "<option value=''></option>";
		do 
		{  
			$selptodest="";
			$ptodest=$rowpto_dest["ptodest"];
			if ($ptodest==$combo_pto_troncal_a) $selptodest="selected";
			echo "<option value='".$ptodest."' $selptodest>".$ptodest."</option>";
		}
		while ($rowpto_dest = mysql_fetch_array($qpto_dest)); 
		
		echo "</select>($repslotsubpto)</td> ";
	}
?>        
    
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Identificacion del Puerto </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="id_pto_troncal_d"  readonly type="text" class="Estilo48" id="id_pto_troncal_d" title='Identificacion del Puerto' value="<?=$id_pto_troncal_d?>" size="35" /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Identificacion del Puerto</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="id_pto_troncal_a" type="text" readonly class="Estilo48" id="id_pto_troncal_a" title='Identificacion del Puerto' value="<?=$id_pto_troncal_a?>" size="35" /></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Nombre de Interfase </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="nominter_troncal_d" type="text" readonly class="Estilo48" id="nominter_troncal_d" title='Nombre de Interfase' value="<?=$nominter_troncal_d?>" size="35" /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Nombre de Interfase </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="nominter_troncal_a" type="text" readonly class="Estilo48" id="nominter_troncal_a" title='Nombre de Interfase' value="<?=$nominter_troncal_a?>" size="35" /></td>
    </tr>
	
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Descripcion de la Interfase </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="desc_nominter_troncal_d" type="text" readonly class="Estilo48" id="desc_nominter_troncal_d" title='Descripcion de la Interfase' value="<?=$desc_nominter_troncal_d?>" size="35" /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Descripcion de la Interfase </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="desc_nominter_troncal_a" type="text" readonly class="Estilo48" id="desc_nominter_troncal_a" title='Descripcion de la Interfase' value="<?=$desc_nominter_troncal_a?>" size="35" /></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Referencia SISA/OT</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input name="ref_sisa_e" type="text" class="Estilo48" id="ref_sisa_e" title='Referencia SISA/OT' value="<?=$ref_sisa_e?>"/></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">&nbsp;</td>
      <td class="Estilo48"><input class='Estilo57' type="button" name="guardar" id="button" value="Guardar Datos de la Sección" onclick='document.wdm.altaseccion.value=1;submit();'></td>
    </tr>
  </table><br>
</div>  
  
<!-- ########################################ENLACE RCDT#################################### -->
 
<div id="infenlacercdt" style="margin: 0 auto;width :950px;<?=$verrcdt?>;">

  <table width="950" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo49">CONEXION A RCDT</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">&nbsp;</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28">&nbsp;</td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td width="199" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo49">ORIGEN</td>
      <td width="200" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42"><?=$nuevarepisa?></td>
      <td width="199" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo49">DESTINO</td>
      <td width="200" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42"><?=RCDT?></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF"><span class="Estilo28"></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Equipo Destino (RCDT)</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><?php
			$e1=$e2="";
			if ($equipo_rcdt=="SW") $e1="selected";
			if ($equipo_rcdt=="AC") $e2="selected";
		?>
          <select name="equipo_rcdt" class="Estilo48" title='Seleccionar el Tipo de Equipo de RCDT' onchange="submit();">
            <option value=" "></option>
            <option value="SW" <?=$e1?>>Switch</option>
            <option value="AC" <?=$e2?>>Router</option>
          </select>
          <span class="Estilo48">N&uacute;mero:</span> <span class="Estilo49">
          <?php
		$optneq="<option value=' '></option>";
      		for($neq=1;$neq<=99;$neq++)
      		{
      			$numeq=sprintf("%02s",$neq);
      			$selneq="";
      			if ($num_equipo_rcdt==$numeq) $selneq="selected";
			$optneq.="<option value='$numeq' $selneq>$numeq</option>";
      		}  
	?>
          <select name="num_equipo_rcdt" title='Seleccionar el Numero del Equipo de RCDT' onchange="submit();">
            <?echo $optneq;?>
          </select>
        </span></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td width="192" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo49">&nbsp;</td>
      <td width="209" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo49">&nbsp;</td>
      <td width="192" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Modelo del Equipo </td>
      <td width="205" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo49"><?php
	
//	$modSW=array(2950,1924,3550,3560,2960,2924,6506,5505,4503,3750);
	$modSW=array(3300);
	$modAC=array(3845,3745,3660,3620,2811,2600,2509);
//	$modAC=array("4945", "2008", "2016", "2024");
	$modAC=array("4945", "NE20");
		
	$modsa="mod$equipo_rcdt";
	$modsa=$$modsa;
	echo "<select name='modelo_eq_rcdt' id='modelo_eq_rcdt' title='Seleccionar el Modelo del Equipo de RCDT' onchange='submit();'>";
	echo "<option value=' '></option>";
	$selmodr="";
	
	for ($mr=0;$mr<count($modsa);$mr++)
	{
		$selmodr="";
		if($modsa[$mr]==$modelo_eq_rcdt) $selmodr="selected";
		echo "<option value='".$modsa[$mr]."' $selmodr>".$modsa[$mr]."</option>";
	}
	echo "</select>"
	?>
      </td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Puerto origen</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><?php

	if($proveedor=="ALCATEL")	{$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/', subslot+0, '/', if(instr(puerto,'G'),CONCAT(substr(puerto,1,instr(puerto,'G')-1), ' 10G'),puerto)) ";$repslotsubpto="repisa/slot/subslot/puerto";}
	if($proveedor=="HUAWEI")	{$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/', puerto) ";$repslotsubpto="repisa/slot/puerto";}
	if($proveedor=="HUAWEI")	{$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/', puerto) ";$repslotsubpto="repisa/slot/puerto";}
	
  	$qpto_origr=mysql_query("SELECT $rssp as ptoorigr from inventario_puertos_wdm where wdm='$wd' and ((id_nodo='$idnodo_orig' and estatus='DISPONIBLE') or (pto_troncal='$desc_nominter_troncal_dr')) order by repisat, posicion_tarjeta, subslot, puerto");

	if ($rowpto_origr = mysql_fetch_array($qpto_origr))
	{ 
		echo "<select name='combo_pto_troncal_dr' id='combo_pto_troncal_dr' onchange='submit()'>";
		echo "<option value=''></option>";
		do 
		{  
			$selptoorigr="";
			$ptoorigr=$rowpto_origr["ptoorigr"];
			if ($ptoorigr==$combo_pto_troncal_dr) $selptoorigr="selected";
			echo "<option value='".$ptoorigr."' $selptoorigr>".$ptoorigr."</option>";
		}
		while ($rowpto_origr = mysql_fetch_array($qpto_origr)); 
		echo "</select>($repslotsubpto)</td> ";
	}	
    
?>
      </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Puerto origen</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input size="35" name="pto_troncal_ar" type="text" class="Estilo48" id="pto_troncal_ar" title='Puerto origen' onchange='submit()' value="<?=$pto_troncal_ar?>" /></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Nombre de Interfase</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input name="nominter_troncal_dr" type="text" readonly class="Estilo48" id="nominter_troncal_dr" title='Nombre de Interfase' value="<?=$nominter_troncal_dr?>" size="35" /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Nombre de Interfase </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input name="nominter_troncal_ar" type="text" readonly class="Estilo48" id="nominter_troncal_ar" title='Nombre de Interfase' value="<?=$nominter_troncal_ar?>" size="35" /></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Descripcion de la Interfase</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input name="desc_nominter_troncal_dr" type="text" readonly class="Estilo48" id="desc_nominter_troncal_dr" title='Descripcion de la Interfase' value="<?=$desc_nominter_troncal_dr?>" size="35" /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Descripcion de la Interfase </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input name="desc_nominter_troncal_ar" type="text" readonly class="Estilo48" id="desc_nominter_troncal_ar" title='Descripcion de la Interfase' value="<?=$desc_nominter_troncal_ar?>" size="35" /></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">IP Interfase GNE </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input size="35" name="ip_troncal_dr" type="text" class="Estilo48" id="ip_troncal_dr" title='IP Interfase Ethernet' value="<?=$ip_troncal_dr?>" /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">IP Interfase Gateway</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input size="35" name="ip_troncal_ar" type="text" class="Estilo48" id="ip_troncal_ar" title='IP Interfase Gateway' value="<?=$ip_troncal_ar?>" /></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Velocidad de Puerto Ethernet</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><span class="Estilo28">
        <?php
			$e1=$e2="";
			if ($vel_pto=="10MB")  $v1="selected";
			if ($vel_pto=="100MB") $v2="selected";
		?>
        <select name="vel_pto" class="Estilo48" title='Seleccionar la Velocidad del puerto' onchange='submit();'>
          <option value="100MB" <?=$v2?>>100 MB</option>
          <option value="10MB"  <?=$v1?>>10 MB</option>
        </select>
      </span></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">&nbsp;</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">&nbsp;</td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">IP Mascara </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input size="35" name="ip_mascara_dr" type="text" class="Estilo48" id="ip_mascara_dr" title='IP Mascara' value="<?=$ip_mascara_dr?>" /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Numero de Cambio de RCDT </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input size="35" name="no_cambio_rcdt" type="text" class="Estilo48" id="no_cambio_rcdt" title='Numero de Cambio proporcionado por RCDT' value="<?=$no_cambio_rcdt?>" /></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Identificacion Puerto Ethernet </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input size="35" name="id_pto_troncal_dr" type="text" class="Estilo48" id="id_pto_troncal_dr" title='Identificacion Puerto Ethernet' value="<?=$id_pto_troncal_dr?>" readonly/></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Identificacion Puerto Ethernet</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input size="35" name="id_pto_troncal_ar" type="text" class="Estilo48" id="id_pto_troncal_ar" title='Identificacion Puerto Ethernet' value="<?=$id_pto_troncal_ar?>" readonly/></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">&nbsp;</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">&nbsp;</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Remate de RCDT</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input name="remate_rcdt" type="text" class="Estilo48" id="remate_rcdt" title='Remate de RCDT' onchange='submit()'; value="<?=$remate_rcdt?>" /></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">&nbsp;</td>
      <td class="Estilo48">&nbsp;</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Longitud del cable de gestion </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input name="long_cable_rcdt" type="text" class="Estilo48" id="long_cable_rcdt" title='Longitud del cable de gestion' value="<?=$long_cable_rcdt?>" /></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">&nbsp;</td>
      <td class="Estilo48">&nbsp;</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Central RCDT</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input name="central_rcdt" type="text" class="Estilo48" id="central_rcdt" title='Central RCDT' onchange='submit()'; value="<?=$central_rcdt?>" /></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">&nbsp;</td>
      <td class="Estilo48"><input class='Estilo57' type="button" name="guardar" id="button" value="Guardar Datos de RCDT" onclick='document.wdm.altarcdt.value=1;submit();' /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Hostname RCDT</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input name="hostname_rcdt" type="text" class="Estilo48" id="hostname_rcdt" title='Hostname RCDT' value="<?=$hostname_rcdt?>" readonly/></td>
    </tr>
  </table>
  <p><br>
</div> 

 
<!-- ###################################################FIBRA OPTICA############################################################# -->

<?php

$nivel="";

if(!isset($desc_nominter_troncal_d)) $desc_nominter_troncal_d="";
if($desc_nominter_troncal_d<>""  ) $seccion=substr($desc_nominter_troncal_d,0,9);

$tipoenl=mysql_query("SELECT tipo_enlace from fibra_optica_wdm where wdm='$wd' and seccion='$seccion' and trayectoria=$trayectoria group by tipo_enlace");
if(mysql_num_rows($tipoenl)>0) $tipoenlace=mysql_result($tipoenl,0,0);

if(strlen($upfo)>1)
{
	$upidfo=substr($upfo,strpos($upfo,"-",2)+1);
	$nfo=substr($upfo,2,strpos($upfo,"-",2)-2);	
}


if (substr($upfo,0,1)=="a")
{
	$qconsfo=mysql_query("select max(consecutivo) from fibra_optica_wdm where wdm='$wd' and seccion='$seccion' and trayectoria='$trayectoria'");
	if(mysql_num_rows($qconsfo)>0) $consfo=mysql_result($qconsfo,0,0)+1;
	else $consfo=1;
	
	$faltan_datosfo="";

	if(strlen($upfo)==1)
	{
		if($tipoenlace=="f" and ($cable=="" or $longitud=="" or $no_fibras1=="" or $no_fibras2=="" or $central_a=="" or $piso_a=="" or $sala_a=="" or $fila_a=="" or $repisa_a=="" or $remate_a=="" or $central_b=="" or $piso_b=="" or $sala_b=="" or $fila_b=="" or $repisa_b=="" or $remate_b=="")) $faltan_datosfo="1";
		if($tipoenlace=="r" and ($cable=="" or $tip_radio=="" or $ban_radio=="" or $cap_radio=="" or $pro_radio=="" or $central_a=="" or $piso_a=="" or $sala_a=="" or $fila_a=="" or $repisa_a=="" or $remate_a=="" or $central_b=="" or $piso_b=="" or $sala_b=="" or $fila_b=="" or $repisa_b=="" or $remate_b=="")) $faltan_datosfo="1";		
		$sigctrla=explode("-",$central_a);
		$siglasa=$sigctrla[0];
		$centrala=$sigctrla[1];
		$sigctrlb=explode("-",$central_b);
		$siglasb=$sigctrlb[0];
		$centralb=$sigctrlb[1];
		if($tipoenlace=="f") $altafo="REPLACE INTO fibra_optica_wdm (wdm,id_nodo,consecutivo,seccion,cable,longitud,central_a,siglas_a,central_b,siglas_b,no_fibras,piso_a,sala_a,fila_a,repisa_a,remate_a, piso_b,sala_b,fila_b,repisa_b,remate_b,trayectoria,tipo_enlace) values('$wd','', '$consfo', '$seccion','$cable','$longitud','$centrala', '$siglasa', '$centralb', '$siglasb','$no_fibras1,$no_fibras2','$piso_a','$sala_a','$fila_a','$repisa_a','$remate_a','$piso_b','$sala_b','$fila_b','$repisa_b','$remate_b',$trayectoria,'f')";
		if($tipoenlace=="r") $altafo="REPLACE INTO fibra_optica_wdm (wdm,id_nodo,consecutivo,seccion,cable,central_a,siglas_a,central_b,siglas_b,piso_a,sala_a,fila_a,repisa_a,remate_a, piso_b,sala_b,fila_b,repisa_b,remate_b,trayectoria,tipo_enlace,tipo_radio,banda_operacion,capacidad_enlace,proteccion) values('$wd','', '$consfo', '$seccion','$cable','$centrala', '$siglasa', '$centralb', '$siglasb','$piso_a','$sala_a','$fila_a','$repisa_a','$remate_a','$piso_b','$sala_b','$fila_b','$repisa_b','$remate_b',$trayectoria,'r','$tip_radio','$ban_radio','$cap_radio','$pro_radio')";		
	}
	if(strlen($upfo)>1)
	{
		if($tipoenlace=="f" and ($cableup[$nfo]=="" or $longitudup[$nfo]=="" or $fibra1up[$nfo]=="" or $fibra2up[$nfo]=="" or $central_aup[$nfo]=="" or $piso_aup[$nfo]=="" or $sala_aup[$nfo]=="" or $fila_aup[$nfo]=="" or $repisa_aup[$nfo]=="" or $remate_aup[$nfo]=="" or $central_bup[$nfo]=="" or $piso_bup[$nfo]=="" or $sala_bup[$nfo]=="" or $fila_bup[$nfo]=="" or $repisa_bup[$nfo]=="" or $remate_bup[$nfo]=="")) $faltan_datosfo="1";
		if($tipoenlace=="r" and ($cableup[$nfo]=="" or $tip_radioup[$nfo]=="" or $ban_radioup[$nfo]=="" or $cap_radioup[$nfo]=="" or $pro_radioup[$nfo]=="" or $central_aup[$nfo]=="" or $piso_aup[$nfo]=="" or $sala_aup[$nfo]=="" or $fila_aup[$nfo]=="" or $repisa_aup[$nfo]=="" or $remate_aup[$nfo]=="" or $central_bup[$nfo]=="" or $piso_bup[$nfo]=="" or $sala_bup[$nfo]=="" or $fila_bup[$nfo]=="" or $repisa_bup[$nfo]=="" or $remate_bup[$nfo]=="")) $faltan_datosfo="1";
		$sigctrla=explode("-",$central_aup[$nfo]);
		$siglasa=$sigctrla[0];
		$centrala=$sigctrla[1];
		$sigctrlb=explode("-",$central_bup[$nfo]);
		$siglasb=$sigctrlb[0];
		$centralb=$sigctrlb[1];
		if($tipoenlace=="f") $altafo="UPDATE fibra_optica_wdm set cable='$cableup[$nfo]', longitud='$longitudup[$nfo]', central_a='$centrala', siglas_a='$siglasa', central_b='$centralb', siglas_b='$siglasb', no_fibras='$fibra1up[$nfo],$fibra2up[$nfo]', piso_a='$piso_aup[$nfo]', sala_a='$sala_aup[$nfo]', fila_a='$fila_aup[$nfo]', repisa_a='$repisa_aup[$nfo]', remate_a='$remate_aup[$nfo]', piso_b='$piso_bup[$nfo]', sala_b='$sala_bup[$nfo]', fila_b='$fila_bup[$nfo]', repisa_b='$repisa_bup[$nfo]', remate_b='$remate_bup[$nfo]' where id='$upidfo'";
		if($tipoenlace=="r") $altafo="UPDATE fibra_optica_wdm set cable='$cableup[$nfo]', central_a='$centrala', siglas_a='$siglasa', central_b='$centralb', siglas_b='$siglasb', piso_a='$piso_aup[$nfo]', sala_a='$sala_aup[$nfo]', fila_a='$fila_aup[$nfo]', repisa_a='$repisa_aup[$nfo]', remate_a='$remate_aup[$nfo]', piso_b='$piso_bup[$nfo]', sala_b='$sala_bup[$nfo]', fila_b='$fila_bup[$nfo]', repisa_b='$repisa_bup[$nfo]', remate_b='$remate_bup[$nfo]', tipo_radio='$tip_radioup[$nfo]', banda_operacion='$ban_radioup[$nfo]', capacidad_enlace='$cap_radioup[$nfo]', proteccion='$pro_radioup[$nfo]' where id='$upidfo'";
	}

	if($faltan_datosfo=="")
	{
		mysql_query($altafo);
		$cable=$longitud=$no_fibras1=$no_fibras2=$central_a=$piso_a=$sala_a=$fila_a=$repisa_a=$remate_a=$central_b=$piso_b=$sala_b=$fila_b=$repisa_b=$remate_b=$tip_radio=$ban_radio=$cap_radio=$pro_radio="";
		//echo $altafo;
	}
	else echo "<script>alert('Debe indicar todos los datos del enlace');</script>";
}

if (substr($upfo,0,1)=="b")
{
	if(strlen($upfo)>1)   $bajafo="DELETE from fibra_optica_wdm where id='$upidfo'";	
	mysql_query($bajafo);
}




	if(!isset($central_a)) $central_a="";
	if(!isset($central_b)) $central_b="";
	if (trim($central_a)=="") $central_a="Buscar central A...";
	if (trim($central_b)=="") $central_b="Buscar central B...";
		
	$centa="<input type='text' id='input_a' class='input'  onfocus=\"this.value='';asignaVariables('input_a','lista_a');if(document.getElementById('lista_a').childNodes[0]!=null && this.value!='') { filtraLista(this.value); formateaLista(this.value); reiniciaSeleccion(); document.getElementById('lista_a').style.display='block'; }\"  
	                                                       onblur=\"if(v==1) document.getElementById('lista_a').style.display='none';\"  
	                                                       onkeyup=\"if(navegaTeclado(event)==1) {clearTimeout(ultimoIdentificador); ultimoIdentificador=setTimeout('rellenaLista()', 1000); }\" 
	                                                       class='Estilo48' title='Siglas de la Central A'  size='15' maxlength='15' value='$central_a' name='central_a1'/>
		<div id='lista_a' class='lista1' onmouseout='v=1;' onmouseover='v=0;'></div>";
	
	$centb="<input type='text' id='input_b' class='input'  onfocus=\"this.value='';asignaVariables('input_b','lista_b');if(document.getElementById('lista_b').childNodes[0]!=null && this.value!='') { filtraLista(this.value); formateaLista(this.value); reiniciaSeleccion(); document.getElementById('lista_b').style.display='block'; }\"  
	                                                       onblur=\"if(v==1) document.getElementById('lista_b').style.display='none';\"  
	                                                       onkeyup=\"if(navegaTeclado(event)==1) {clearTimeout(ultimoIdentificador); ultimoIdentificador=setTimeout('rellenaLista()', 1000); }\" 
	                                                       class='Estilo48' title='Siglas de la Central B'  size='15' maxlength='15' value='$central_b' name='central_b1'/>
		<div id='lista_b' class='lista1' onmouseout='v=1;' onmouseover='v=0;'></div>";


if($tipoenlace=="r") $tamdiv=1300;
if($tipoenlace=="f") $tamdiv=1200;

echo "<div id='infenlace' style='margin: 0 auto;width :".$tamdiv."px;$verenl;'>";

echo "<table width='1100' border='3' cellspacing='1' bordercolor='#999999' bgcolor='#CAE4FF'>";
echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>";
echo "	<td colspan='20' bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo49' colspan=1>AGREGAR TRAYECTO DE FIBRA OPTICA</td>";
echo "</tr>";
echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo49' style='text-align:center'>";
echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>No</td>";
echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Cable</td>";
echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Longitud (Km)</td>";
echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>F1</td>";
echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>F2</td>";
echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>$centa</td>";
echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Piso</td>";
echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Sala</td>";
echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Fila</td>";
echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Repisa</td>";
echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Remate</td>";
echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF'></td>"; 
echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>$centb</td>";
echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Piso</td>";
echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Sala</td>";
echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Fila</td>";
echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Repisa</td>";
echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Remate</td>";
echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Agregar/Borrar</td>";
echo "    </tr>";
    
echo "    <tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>";
echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'></td>";
echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='cable' type='text' class='Estilo48' id='cable' title='Numero de Cable' size='10' value='$cable' onchange='submit();' /></td>";



echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='longitud' type='text' class='Estilo48' id='longitud' title='Longitud del Cable' size='10' value='$longitud' /></td>";

//Busca las fibras que ya estan en la BD para que no se usen de nuevo
$qfibras_bd=mysql_query("SELECT no_fibras from fibra_optica_wdm where wdm='$wd' and cable='$cable' and seccion='$seccion';");
if(mysql_num_rows($qfibras_bd)>0)
{
	for($k=0;$k<mysql_num_rows($qfibras_bd);$k++)
	{
		$fibras_bd=explode(",",mysql_result($qfibras_bd,$k,0));
		$f1_bd=$fibras_bd[0];
		$f2_bd=$fibras_bd[1];
		$f_bd[]=$fibras_bd[0];
		$f_bd[]=$fibras_bd[1];
	}
}


echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>";
echo "<select name='no_fibras1' class='Estilo48' style='width:40px;text-align:right;' title='No de Fibra 1:' onchange='submit();'>";
echo "<option value=''></option>";

for ($f=1;$f<=96;$f++)
{
	$sf1="";
	if($f==$no_fibras2) continue;		//No nuestra la fibra seleccionada en F2
	if(in_array($f,$f_bd)) continue;	//No muestra las fibras ya usadas
	if($f==$no_fibras1) $sf1="selected";
	echo "<option value='$f' $sf1>$f</option>";
}	
echo "</select></td>";

echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>";
echo "<select name='no_fibras2' class='Estilo48' style='width:40px;text-align:right;' title='No de Fibra 2:' onchange='submit();'>";
echo "<option value=''></option>";

for ($f=1;$f<=96;$f++)
{
	$sf2="";
	if($f==$no_fibras1) continue;		//No nuestra la fibra seleccionada en F1	
	if(in_array($f,$f_bd)) continue;	//No muestra las fibras ya usadas
	if($f==$no_fibras2) $sf2="selected";
	echo "<option value='$f' $sf2>$f</option>";
}	
echo "</select></td>";	
	



?>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42"><input id='input_a1' name="central_a" type="text" class='input' class="Estilo48" title='Central A'  size="15" maxlength="15" value='' readonly /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42"><input name="piso_a" type="text" class="Estilo48" id="piso_a" title='Piso'  size="6" value='<?=$piso_a?>' /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42"><input name="sala_a" type="text" class="Estilo48" id="sala_a" title='Sala'  size="6" value='<?=$sala_a?>' /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42"><input name="fila_a" type="text" class="Estilo48" id="fila_a" title='Fila'  size="6" value='<?=$fila_a?>' /></span></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42"><input name="repisa_a" type="text" class="Estilo48" id="repisa_a" title='Repisa'  size="6" value='<?=$repisa_a?>' /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42"><input name="remate_a" type="text" class="Estilo48" id="remate_a" title='Remate'  size="8" value='<?=$remate_a?>' /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42"><input id='input_b1' name="central_b" type="text" class='input' class="Estilo48" title='Central B'  size="15" maxlength="15" readonly /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42"><input name="piso_b" type="text" class="Estilo48" id="piso_b" title='Piso' size="6" value='<?=$piso_b?>' /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42"><input name="sala_b" type="text" class="Estilo48" id="sala_b" title='Sala' size="6" value='<?=$sala_b?>' /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42"><input name="fila_b" type="text" class="Estilo48" id="fila_b" title='Fila' size="6" value='<?=$fila_b?>' /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42"><input name="repisa_b" type="text" class="Estilo48" id="repisa_b" title='Repisa' size="6" value='<?=$repisa_b?>' /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42"><input name="remate_b" type="text" class="Estilo48" id="remate_b" title='Remate' size="8" value='<?=$remate_b?>' /></td>
      <td width="40px" align=center bordercolor="#CAE4FF" bgcolor="#CAE4FF" ><img src='images/add.png' onclick="document.wdm.upfo.value='a';document.wdm.submit();"></td>
    </tr>
    
    
 <?php

//################Muestra los tramos de fo cargados en la BD ###################################################################################

	echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo49'><td colspan=20><br>TRAYECTOS CARGADOS EN LA BD</td></tr>";
	$tramosfo=mysql_query("SELECT * from fibra_optica_wdm where wdm='$wd' and seccion='$seccion' and trayectoria=$trayectoria order by consecutivo,cable");
	if ($rowfo = mysql_fetch_array($tramosfo)){ 
	$nfo=0;	
	do {  
		$fibra1=substr($rowfo['no_fibras'],0,strpos($rowfo['no_fibras'],","));
		$fibra2=substr($rowfo['no_fibras'],strpos($rowfo['no_fibras'],",")+1);	
		$idfo=$rowfo['id'];

		echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>";
		echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='consecutivoup[]' type='text' class='Estilo48' id='consecutivoup' size=10 value=".$rowfo['consecutivo']." readonly></td>";
		echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='cableup[]' type='text' class='Estilo48' id='cableup' size=10 value=".$rowfo['cable']."></td>";
		
		
		if ($tipoenlace=="f")
		{
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='longitudup[]' type='text' class='Estilo48' id='longitudup' size=10 value=".$rowfo['longitud']."></td>";
		
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>";
			echo "<select name='fibra1up[]' class='Estilo48' style='width:40px;text-align:right;' title='No de Fibra 1:'>";
			echo "<option value=''></option>";
			for ($f=1;$f<=96;$f++)
			{
				$sfup="";
				if ($fibra1==$f) $sfup="selected";						
				echo "<option value='$f' $sfup>$f</option>";
			}	
			echo "</select></td>";
			
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>";
			echo "<select name='fibra2up[]' class='Estilo48' style='width:40px;text-align:right;' title='No de Fibra 2:'>";
			echo "<option value=''></option>";
			for ($f=1;$f<=96;$f++)
			{
				$sfup="";
				if ($fibra2==$f) $sfup="selected";						
				echo "<option value='$f' $sfup>$f</option>";
			}	
			echo "</select></td>";
		}
		
		if ($tipoenlace=="r")
		{

			$selpdhup=$selsdhup="";
			if($rowfo['tipo_radio']=="PDH") $selpdhup="selected";
			if($rowfo['tipo_radio']=="SDH") $selsdhup="selected";
			
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>\n";
			echo "<select name='tip_radioup[]' class='Estilo48'  style='width:60px;' title='Tipo de Radio'>\n";
			echo "<option value=''></option>";
			echo "<option value='PDH' $selpdhup>PDH</option>";

			echo "<option value='SDH' $selsdhup>SDH</option>";
			echo "</select></td>";	
			
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>\n";
			echo "<select name='ban_radioup[]' class='Estilo48'  style='width:60px;' title='Banda de Operacin' onchange='submit();'>\n";
			echo "<option value=''></option>";
			$qbandaup=mysql_query("SELECT banda from radio group by banda order by banda");
			for($b=0;$b<mysql_num_rows($qbandaup);$b++)

			{
				$bandaup=mysql_result($qbandaup,$b,0);
				if($bandaup==$rowfo['banda_operacion']) $selbanup="selected";
				else $selbanup="";
				echo "<option value='$bandaup' $selbanup>$bandaup</option>";
			}
			echo "</select></td>";	
			
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>\n";
			echo "<select name='cap_radioup[]' class='Estilo48'  style='width:60px;' title='Capacidad del Enlace'>\n";
			echo "<option value=''></option>";
			$qcapup=mysql_query("SELECT capacidad from radio where banda=".$rowfo['banda_operacion']." group by capacidad order by capacidad");
			for($b=0;$b<mysql_num_rows($qcapup);$b++)
			{
				$capup=mysql_result($qcapup,$b,0);
				if($capup==$rowfo['capacidad_enlace']) $selcapup="selected";
				else $selcapup="";
				echo "<option value='$capup' $selcapup>$capup</option>";
			}
			echo "</select></td>";	

			echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='pro_radioup[]' type='text' class='Estilo48' id='pro_radioup' title='Proteccin (n+m)'      size='6' value='".$rowfo['proteccion']."' /></span></td>\n";
		
		}
		
		echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='central_aup[]' type='text' class='Estilo48' id=central_aup' size=15 value='".$rowfo['siglas_a']."-".$rowfo['central_a']."' readonly></td>";
		echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='piso_aup[]' type='text' class='Estilo48' id=pisa_aup' size=6 value='".$rowfo['piso_a']."'></td>";
		echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='sala_aup[]' type='text' class='Estilo48' id=sala_aup' size=6 value='".$rowfo['sala_a']."'></td>";						
		echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='fila_aup[]' type='text' class='Estilo48' id=fila_aup' size=6 value='".$rowfo['fila_a']."'></td>";
		echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='repisa_aup[]' type='text' class='Estilo48' id=repisa_aup' size=6 value='".$rowfo['repisa_a']."'></td>";
		echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='remate_aup[]' type='text' class='Estilo48' id=remate_aup' size=8 value='".$rowfo['remate_a']."'></td>";		
		echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'></td>";
		echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='central_bup[]' type='text' class='Estilo48' id=central_bup' size=15 value='".$rowfo['siglas_b']."-".$rowfo['central_b']."' readonly></td>";
		echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='piso_bup[]' type='text' class='Estilo48' id=pisa_bup' size=6 value='".$rowfo['piso_b']."'></td>";
		echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='sala_bup[]' type='text' class='Estilo48' id=sala_bup' size=6 value='".$rowfo['sala_b']."'></td>";						
		echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='fila_bup[]' type='text' class='Estilo48' id=fila_bup' size=6 value='".$rowfo['fila_b']."'></td>";
		echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='repisa_bup[]' type='text' class='Estilo48' id=repisa_bup' size=6 value='".$rowfo['repisa_b']."'></td>";
		echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='remate_bup[]' type='text' class='Estilo48' id=remate_bup' size=8 value='".$rowfo['remate_b']."'></td>";		
      		echo "<td width='40px' align=center bordercolor='#CAE4FF' bgcolor='#CAE4FF' ><img src='images/save.png' onclick='document.wdm.upfo.value=\"a-$nfo-$idfo\";document.wdm.submit();'>&nbsp &nbsp<img src='images/erase.png' onclick='document.wdm.upfo.value=\"b-$nfo-$idfo\";document.wdm.submit();'></td>";
		$nfo++;     		
	} while ($rowfo = mysql_fetch_array($tramosfo)); 
	 
	}	 
 
 
 ?>   
    
  </table><br>
</div>

<!-- ###################################################IMAGEN############################################################# -->

<?php

if ($wd=="") exit; 

//$qwdm=mysql_query("select siglas_central,repisa,tipo_wdm,id ,nodo_adm_conex_adsl,ip_gestion,id_nodo,estatus_cns from cat_wdm where wdm='$wd' and repisa like 'WDM%' order by substr(repisa,locate(' ',repisa)+1)+0;");
$qwdm=mysql_query("select siglas_central,repisa,tipo_wdm,cat_wdm.id ,nodo_adm_conex_adsl,ip_gestion,cat_wdm.id_nodo,estatus_cns,count(posicion_tarjeta) as ptos from cat_wdm left join inventario_puertos_wdm on cat_wdm.id_nodo=inventario_puertos_wdm.id_nodo where cat_wdm.wdm='$wd' and repisa like 'WDM%' group by siglas_central,repisa,tipo_wdm,cat_wdm.id ,nodo_adm_conex_adsl,ip_gestion,cat_wdm.id_nodo,estatus_cns order by substr(repisa,locate(' ',repisa)+1)+0");
$lwdm=mysql_num_rows($qwdm);
$j=0;

for($i=0;$i<$lwdm;$i++)
{
	$sigwdm[$j]=mysql_result($qwdm,$i,0);
	$repwdm[$j]=mysql_result($qwdm,$i,1);
	$idwdm[$j]=mysql_result($qwdm,$i,3);
	$nodowdm[$j]=mysql_result($qwdm,$i,4);
	$ipgwdm[$j]=mysql_result($qwdm,$i,5);
	$idnwdm[$j]=mysql_result($qwdm,$i,6);
	$cnswdm[$j]=mysql_result($qwdm,$i,7);
	$ptowdm[$j]=mysql_result($qwdm,$i,8);
	$j++;
} 

$cwdm=count($sigwdm);
$_SESSION['cwdm']=$cwdm;


$ruta = getcwd() . "/wdm";
$filename="$ruta/equipo_azul.png";
list($width, $height) = getimagesize($filename);

$filename="$ruta/rcdt_azul.png";
list($widthr, $heightr) = getimagesize($filename);

$anchoimg=1400;
$altoimg=600;
$anchod=$width*2.5;
$altod=$height*1.5;
$anchor=$widthr*1;

$altor=$heightr*1;

$xd1=$anchoimg/4;
$yd1=$altoimg*0.15;
$xd2=$anchoimg-$xd1-$anchod;
$yd1=170;
$yd2=$yd1;

$anchoa=$width;
$altoa=$height;
$xa=floor($anchoimg/($cwdm+1)-$anchoa);
$ya=120;
$def=floor(($anchoimg-$xa)/$cwdm);


$_SESSION['width']=$width;
$_SESSION['height']=$height;
$_SESSION['anchoimg']=$anchoimg;
$_SESSION['altoimg']=$altoimg;
$_SESSION['anchod']=$anchod;
$_SESSION['altod']=$altod;
$_SESSION['anchoa']=$anchoa;
$_SESSION['altoa']=$altoa;
$_SESSION['def']=$def;
$_SESSION['widthr']=$widthr;
$_SESSION['heightr']=$heightr;
$_SESSION['anchor']=$anchor;
$_SESSION['altor']=$altor;

$xd11=$xd1;
$yd11=$yd1;
$xd12=$xd1+$anchod;
$yd12=$yd1+$altod;
$xr1=$anchoimg*0.125;
$yr1=$yd1-20;
$_SESSION['d1']="$sd1|$rd1|$xd1|$yd1|$xd12|$yd12|$xr1|$yr1|$nodod1|$idd1";

$xd21=$xd2;
$yd21=$yd2;
$xd22=$xd2+$anchod;
$yd22=$yd2+$altod;
$xr2=($anchoimg*0.875)-$anchor;
$yr2=$yd2-20;
$_SESSION['d2']="$sd2|$rd2|$xd2|$yd2|$xd22|$yd22|$xr2|$yr2|$nodod2|$idd2";

echo "<center><img src='wdm.php?muestra=1&wd=$wd&idd1=$idd1&idd2=$idd2&exportar=$exportar' usemap='#wdm'></center>\n\n";
echo "<map name='wdm'>\n";
echo "<area shape='rect' coords='0, 0, 150, 20' alt='Exportar Topolgico' title='Exportar Topolgico' OnClick='document.wdm.exportar.value=\"1\";document.wdm.id.value=\"$idd1\";document.wdm.submit();' href='#'>\n";

if ($exportar==1)
{
	echo "<script>document.wdm.exportar.value=2;document.wdm.submit();</script>";
}
if ($exportar==2)
{
	$rutadest = getcwd() . "/archivos/wdm";
	$archivo=$wd."-TOP-FISICO.jpg";
	echo "<script>document.wdm.exportar.value=0;ex=window.open('exporta_wdm.php?archivo=$archivo','exporta');</script>";
} 


$xd11a=$xd11+15;
$xd12a=$xd12-15;
$yd12a=$yd12-15;

$xd21a=$xd21+15;
$xd22a=$xd22-15;
$yd22a=$yd22-15;

$xd11b=$xd12;
$yd11b=$yd11+($altod*.5)-5;
$xd12c=$xd12+10;
$yd12c=$yd11+($altod*.5)+5;

$xd21b=$xd21-7;
$yd21b=$yd21+($altod*.5)-5;
$xd22c=$xd21+3;
$yd22c=$yd21+($altod*.5)+5;

$xr11a=$xr1+$anchor-5;
$yr11a=$yr1+($altor*.5)-5;
$xr12a=$xr1+$anchor+5;
$yr12a=$yr1+($altor*.5)+5;

$xr11b=$xd1-5;
$yr11b=$yd1+($altod*.5)-5;
$xr12b=$xd1+5;
$yr12b=$yd1+($altod*.5)+5;

//NODOS

for ($a=0;$a<$cwdm;$a++)
{
	$n=$a+1;
	$m=$a-1;
	$n2=$a+2;
	$xa1=$xa+($a*$def);
	$ya1=$ya;
	$xa2=$xa1+$anchoa;
	$ya2=$ya1+$altoa;
	if ($repwdm[$a]=="") $rep="NO ASIGNADO";
	else $rep=$repwdm[$a];
	$_SESSION["wdm$a"]="$sigwdm[$a]|$rep|$xa1|$ya1|$xa2|$ya2|$nodowdm[$a]|$idwdm[$a]|$ipgwdm[$a]|$idnwdm[$a]|$cnswdm[$a]";
	//echo $_SESSION["wdm$a"];
	
	$ya1a=$ya1+10;
	$ya2a=$ya2+10;	
	
        echo "<area shape='rect' coords='$xa1, $ya1a, $xa2, $ya2' alt='Nodo WDM $n' title='Nodo WDM $n' OnClick='document.wdm.tipoequipo.value=\"a$n\";document.wdm.siglas.value=\"$sigwdm[$a]\";document.wdm.id.value=\"$idwdm[$a]\";document.wdm.ido.value=\"\";document.wdm.idd.value=\"\";document.wdm.cambionodo.value=1;document.wdm.submit();' href='#'>\n";

	$xwnwa1=$xa1;
	$ywnwa1=$ya1+($altoa/2)-5;
	$xwnwa2=$xa1-7;
	$ywnwa2=$ya1+($altoa/2)+5;
	if($a>0 and     trim($ipgwdm[$a])<>"" and trim($ipgwdm[$m])<>"" and trim($ptowdm[$a])>0 and trim($ptowdm[$m])>0) echo "<area shape='rect' coords='$xwnwa1, $ywnwa1, $xwnwa2, $ywnwa2' alt='Sección WDM $a - WDM $n'  title='Sección WDM $a - WDM $n' OnClick='document.wdm.tipoequipo.value=\"ed".$a."d$n\";document.wdm.id.value=\"$idwdm[$a]\";document.wdm.ido.value=\"$idwdm[$m]\";document.wdm.idd.value=\"$idwdm[$a]\";document.wdm.cambionodo.value=1;document.wdm.submit();' href='#'>\n";

	$xwawn1=$xa1+$anchoa+1;
	$ywawn1=$ya1+($altoa/2)-5;
	$xwawn2=$xa1+$anchoa+8;
	$ywawn2=$ya1+($altoa/2)+5;
	if($n<$cwdm and trim($ipgwdm[$a])<>"" and trim($ipgwdm[$n])<>"" and trim($ptowdm[$a])>0 and trim($ptowdm[$n])>0) echo "<area shape='rect' coords='$xwawn1, $ywawn1, $xwawn2, $ywawn2' alt='Sección WDM $n - WDM $n2' title='Sección WDM $n - WDM $n2' OnClick='document.wdm.tipoequipo.value=\"ed".$n."d$n2\";document.wdm.id.value=\"$idwdm[$a]\";document.wdm.ido.value=\"$idwdm[$a]\";document.wdm.idd.value=\"$idwdm[$n]\";document.wdm.cambionodo.value=1;document.wdm.submit();' href='#'>\n";


	$xwr1=$xa1-5+($anchoa/2);
	$ywr1=$ya1-5;
	$xwr2=$xa1+5+($anchoa/2);
	$ywr2=$ya1+5;
	if(trim($ipgwdm[$a])<>"") echo "<area shape='rect' coords='$xwr1, $ywr1, $xwr2, $ywr2' alt='Sección WDM $n - RCDT' title='Sección WDM $n - RCDT' OnClick='document.wdm.tipoequipo.value=\"ed".$n."r1\";document.wdm.id.value=\"$idwdm[$a]\";document.wdm.ido.value=\"$idwdm[$a]\";document.wdm.idd.value=\"$idwdm[$a]\";document.wdm.cambionodo.value=1;document.wdm.submit();' href='#'>\n";

	$xed11=floor($xd1+10+($a*$anchod*0.8/($cwdm+1)));
	$yed11=$yd1+$altod-5;
	$xed12=floor($xd1+15+($a*$anchod*0.8/($cwdm+1)));
	$yed12=$yd1+$altod+5;

	$xed21=floor($xd2+10+($a*$anchod*0.8/($cwdm+1)));
	$yed21=$yd2+$altod-5;
	$xed22=floor($xd2+15+($a*$anchod*0.8/($cwdm+1)));
	$yed22=$yd2+$altod+5;

	$xea11=$xa1+($anchoa/2)-15;
	$yea11=$ya1-6;
	$xea12=$xa1+($anchoa/2)-5;
	$yea12=$ya1-1;

	$xea21=$xa1+($anchoa/2)+10;
	$yea21=$ya1-6;
	$xea22=$xa1+($anchoa/2)+20;

	$yea22=$ya1-1;

}


echo "</map>";

if ($avisocns==1) echo "<script>alert('El WDM  está en proceso por CNS I.\\nNo puede ser modificado por el momento');</script>";
if ($avisocnsnodo==1) echo "<script>alert('El NODO está en proceso por CNS I.\\nNo puede ser modificado por el momento');</script>";

?>

</form>
</body>
</html>



