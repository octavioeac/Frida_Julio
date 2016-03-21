<?php
ini_set("memory_limit","850M");
//error_reporting(E_NONE);
include ("perfiles.php");
require("conexion.php");
$fecha=date('d/m/Y');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<script type="text/javascript" src='js/jquery-1.9.1.js'></script>
<script type='text/javascript' src='./js/myscripts.js'></script>
<script type='text/javascript' src='./js/validar.js'></script>
<script type = "text/javascript" src = "./js/jquery-ui.js" ></script>
<link rel = "stylesheet" type = "text/css" href="style.css">
<link rel="stylesheet" href="css/ui/themes/smoothness/jquery-ui.css">

<script type="text/javascript" src="javaScriptBroker/funcionEquipo.js"></script>
<link rel="stylesheet" type="text/css" href="./datepickercontrol.css"/>
<script type="text/javascript" src="./datepickercontrol.js"></script>

<link rel="stylesheet" type="text/css" href="autocomp.css">
<script type="text/javascript" src="autocomp.js"></script>
<script>
  

		function rep(id){
	    var nom = $('#'+id).val();
	    if(nom !== ''){
			var regExpOb = /^[0-9][0-9][0-9][0-9]$/i;
			var rs = regExpOb.test(nom);
			if(!rs){
				alert('No valido.  Un ejemplo valido, por ejemplo, es: 0101');
				$('#'+id).val('');
			}
		}
	}


</script>
<style type="text/css">
<!--

#toPopup {
    font-family: "lucida grande",tahoma,verdana,arial,sans-serif;
    background: none repeat scroll 0 0 #FFFFFF;
    border: 10px solid #ccc;
    border-radius: 3px 3px 3px 3px;
    color: #333333;
    display: none;
    font-size: 14px;
    left: 125%;
    margin-left: -350px;
    position: fixed;
    top: 155%;
    width: 600px;
    z-index: 2;
    position: absolute;

}
 span.arrow {
                border-left: 5px solid transparent;
                border-right: 5px solid transparent;
                border-top: 7px solid #000000;
                display: block;
                height: 1px;
                left: 40px;
                position: relative;
                top: 3px;
                width: 1px;
            }
 div#popup_content {
                margin: 4px 7px;
            }
.Estilo28 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
#pie {
text-align: center;
font-size: 11px;
color: #aaa;
margin-top: 40px;
padding-top: 10px;
padding-bottom: 10px;
}	
.Estilo42 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000066; }
.Estilo48 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #000066; }
.Estilo49 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #000066; }
.Estilo53 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #000000; }
.Estilo57 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #990000; }
.Estilo58 {font-size: 10px; color: #000066; font-family: Verdana, Arial, Helvetica, sans-serif;}
.Estilo70 {	font-size: 12px; color: #000066; font-family: Verdana, Arial, Helvetica, sans-serif; background-color: #FFFFCC;
	font-weight: bold;
}
-->
</style>

</head>
<script>

	function ubica(){
		window.open("ubicaNodo.php",'Ubicacion','height=150,width=1100');
	}

</script>


<body>


<div id="wrap">
<div






 id="header">
	<div id="logo">
		<h1><a href="inicio.php">F R I D A</a></h1>
		<h2>Alta de Clusters</h2>
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
if (isset($_REQUEST['cluster'])) $cluster=$_REQUEST['cluster'];	else $cluster="";
if (isset($_REQUEST['altanodo'])) $altanodo=$_REQUEST['altanodo'];	else $altanodo="";
if (isset($_REQUEST['altaseccion'])) $altaseccion=$_REQUEST['altaseccion'];	else $altaseccion="";
if (isset($_REQUEST['altarcdt'])) $altarcdt=$_REQUEST['altarcdt'];	else $altarcdt="";
if (isset($_REQUEST['cambioreg'])) $cambioreg=$_REQUEST['cambioreg'];	else $cambioreg="";
if (isset($_REQUEST['cambionodo'])) $cambionodo=$_REQUEST['cambionodo'];	else $cambionodo="";
if (isset($_REQUEST['try'])) $try=$_REQUEST['try'];	else $try="";
if (isset($_REQUEST['upfo'])) $upfo=$_REQUEST['upfo'];	else $upfo="";
if (isset($_REQUEST['clliagrf2'])) $clliagrf2=$_REQUEST['clliagrf2'];	else $clliagrf2="";
if (isset($_REQUEST['trayectoria'])) $trayectoria=$_REQUEST['trayectoria'];
if (isset($_REQUEST['medio_tx']))   $medio_tx = $_REQUEST['medio_tx'];else $medio_tx="f";
if (isset($_REQUEST['tipoenlace'])) $tipoenlace=$_REQUEST['tipoenlace'];	else $tipoenlace="f";



//if(substr($tipoequipo,1,1)<>"a") {$tipoenlace="f";}

if (!isset($tipoequipo) or $tipoequipo=="")							{$vereq="display:none";$verenl="display:none";$verrcdt="display:none";}
if (substr($tipoequipo,0,1)=="d" or substr($tipoequipo,0,1)=="a")	{$vereq="";$verenl="display:none";$verrcdt="display:none";}
if (substr($tipoequipo,0,1)=="e")									{$vereq="display:none";$verenl="";$verrcdt="display:none";}
if (substr($tipoequipo,3,1)=="r")									{$vereq="display:none";$verenl="display:none";$verrcdt="";}
if ($solcns=="")												{$verobscns="display:none";$verobscnsnd="display:none";}
if ($solcns==1)													{$verobscns="";$verobscnsnd="display:none";}
if ($solcns==2)													{$verobscnsnd="";$verobscns="display:none";}

echo "<form name='cluster' method='post'>";
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
echo "<input type = hidden name = medio_tx value = $medio_tx>";
echo "<input type = hidden name = valida_ip";
echo "<input type = hidden name = ip_g>";

/*B R O K E R  --- - -- -  I B M  INICIO */
$armBroker=$_REQUEST['ArmBrokerCluster'];
echo "<input type = hidden id=ArmBrokerCluster name = ArmBrokerCluster value = $armBroker>";
echo "<input type = hidden name = ArmBrokerBandera value = $ArmBrokerBandera>";
if($_REQUEST['ArmBrokerBandera']==8&&$_REQUEST['ArmBrokerCluster']!=null){
echo "<script>
var id_cluste_limpio=$('#ArmBrokerCluster').val();
 var JsonObject={\"idEquipo\": $('#ArmBrokerCluster').val(),
                     \"movimiento\":\"ALTA\"
                    };
					 var JsonData=JSON.stringify(JsonObject);
					  $.ajax({
		          url:'http://10.105.59.73:8082/fridaSendARM/equipo',
          type: \"POST\",
         dataType:\"json\",
		 data:JsonData,
         contentType:\"application/json\",
           success: function(data){
             console.log(data);  
              
           }
		       });
			   </script>
			   ";
	}
/*B R O K E R  --- - -- -  I B M  FIN */
//echo"<br>subslot: $subslot<br>";
//echo"<br>slot: $slot<br>";



if ($cambionodo!=3)
{
	$ref_sisa_e="";
	$ip_troncal_d="";
	$ip_troncal_a="";
}
if (!isset($rf))
{
    $rf="RF-CLU-".date('dmY')."-".rand(10000, 99999);
}

//echo "$altanodo=$altaseccion=$altarcdt=$solcns=$altatj=$uppto=$upfo";

$clust=substr($cluster,0,strpos($cluster,"|"));


$qestatcnsclust=mysql_query("SELECT estatus from ordenes where nombre_oficial_pisa='$clust'");
if (mysql_num_rows($qestatcnsclust)>0) $estatcnsclust=mysql_result($qestatcnsclust,0,0);
else $estatcnsclust="";
$congelarcluster=array('AUTORIZADA', 'POR REVISAR', 'VALIDADA', 'EN VALIDACION', 'EN PROCESO', 'ASIGNACION DE TECNICO');

if (in_array($estatcnsclust,$congelarcluster) and ($sess_usr<>"JTELLEZ" and $sess_usr<>"DMONZALV" and $sess_usr<>"VVDELRIO" and $sess_usr<>"CUALVARA" and $perfil<>"Administrador")){
	$congelar=1;
	$leyendacong="<br><b><font color=red>CLUSTER BLOQUEADO POR CNS NO SE PUEDE MODIFICAR</font></b>";
	if($altanodo=="1" or $altaseccion=="1" or $altarcdt=="1" or $solcns=="1" or $solcns=="2" or $altatj=="altatj" or substr($altatj,0,6)=="bajatj" or substr($uppto,0,1)=="a" or substr($uppto,0,1)=="b" or substr($upfo,0,1)=="a" or substr($upfo,0,1)=="b") $avisocns=1;
	$altanodo=$altaseccion=$altarcdt=$solcns=$altatj=$uppto=$upfo="C";
}
else{
	$congelar=0;
	$leyendacong="";
	$avisocns=0;
}

$qestatcnsnodo=mysql_query("SELECT estatus from ordenes where nombre_oficial_pisa like '$clust-%' and id_tabla IN ('$id','$idd','$ido')");
if (mysql_num_rows($qestatcnsnodo)>0) $estatcnsnodo=mysql_result($qestatcnsnodo,0,0);
else $estatcnsnodo="";
$acongelarnodo=array('AUTORIZADA', 'POR REVISAR', 'VALIDADA', 'EN VALIDACION', 'EN PROCESO', 'ASIGNACION DE TECNICO');

if (in_array($estatcnsnodo,$acongelarnodo) and ($sess_usr<>"JTELLEZ" and $sess_usr<>"DMONZALV" and $sess_usr<>"VVDELRIO" and $sess_usr<>"CUALVARA" and $perfil<>"Administrador")){
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


	if (substr($tipoequipo,0,1)=="a" or substr($tipoequipo,0,1)=="d")	//Alta de DISTRIBUIDORES y AGREGADORES.
	{
		$faltan_datos="";
		if (trim($clli_equipo)=='')		$faltan_datos.="Debe indicar el CLLI del Equipo\\n";
//		if (trim($ref_sisa)=='')		$faltan_datos.="Debe indicar la Referencia SISA\\n";
		if (trim($ip_sistema)=='')		$faltan_datos.="Debe indicar la IP Sistema (L0)\\n";
		if (trim($ip_gestion)=='' and $sess_usr<>"JTELLEZ" and $sess_usr<>"DMONZALV" and $sess_usr<>"VVDELRIO" and $sess_usr<>"CUALVARA" and $perfil<>"Administrador") $faltan_datos.="Debe indicar la IP Gestin (L1)\\n";
		if (trim($ubi_nodo_adm)=='' and $sess_usr<>"JTELLEZ" and $sess_usr<>"DMONZALV" and $sess_usr<>"VVDELRIO" and $sess_usr<>"CUALVARA" and $perfil<>"Administrador" and strlen($ubi_nodo_adm)<14)		$faltan_datos.="Debe indicar la Ubicación del Nodo\\n";
//		if (trim($version_nodo)=='')	$faltan_datos.="Debe indicar el Release del Nodo\\n";
		
		$validaiP  = mysql_query("SELECT ip_sistema  FROM cat_anillo WHERE ip_sistema = '$ip_sistema' AND clli_equipo != '$clli_equipo'");
		if(mysql_num_rows($validaiP)>0){
			$faltan_datos.="Esta IP ($ip_sistema) ya ha sido asignada";
		}

	
		if ($faltan_datos<>"") echo "<script>alert('$faltan_datos');</script>";
    
		if ($faltan_datos=="")
		{
		      	$error="";
			// Actualiza la Tabla "cat_anillo"
			$qmod="UPDATE cat_anillo SET login='$sess_usr', fecha_alta=NOW(), clli_equipo='$clli_equipo', ref_sisa='$ref_sisa', repisa='$repisa', id_nodo='$id_nodo', ubi_nodo_adm='$ubi_nodo_adm', ip_sistema='$ip_sistema', id_inter_sistema='$id_inter_sistema', ip_gestion='$ip_gestion', id_inter_gestion='$id_inter_gestion', inter_gest='$inter_gest', ospf='$ospf', version_nodo='$version_nodo', remate_cd1='$remate_cd1', long_cable1='$long_cable1', cal_cable_1='$cal_cable_1', bdcd_1='$bdcd_1', cap_break1='$cap_break1', anexo_ot='$anexo_ot', remate_cd2='$remate_cd2', long_cable2='$long_cable2', cal_cable_2='$cal_cable_2', bdcd_2='$bdcd_2', cap_break2='$cap_break2',  pdu1_cap_break1='$pdu1_cap_break1', pdu1_pos_break1='$pdu1_pos_break1', pdu1_pos_break2='$pdu1_pos_break2', pdu2_cap_break1='$pdu2_cap_break1', pdu2_pos_break1='$pdu2_pos_break1', pdu2_pos_break2='$pdu2_pos_break2', pdu3_cap_break1='$pdu3_cap_break1', pdu3_pos_break1='$pdu3_pos_break1', pdu3_pos_break2='$pdu3_pos_break2' WHERE id='$id'";
			mysql_query($qmod);

			$clust=substr($cluster,0,strpos($cluster,"|"));
			$qospf="UPDATE cat_anillo SET ospf='$ospf' WHERE anillo='$clust'";
			mysql_query($qospf);


			$datoscd=explode(".",$ospf);
			$datreg=$datoscd[0];
			$datcd=$datoscd[1];
			$conscd=$datoscd[3];
			mysql_query("UPDATE cat_ciudades set consecutivo=$conscd where region='$datreg' and cod_ciudad='$datcd' and consecutivo<$conscd");
		}
	}
}

if ($altaseccion=="1")
{
	if (substr($tipoequipo,0,1)=="e")	//Alta de SECCIONES
	{

		$faltan_datose="";
		
		if (trim($combo_pto_troncal_d)=='')		$faltan_datose.="Debe indicar el Puerto origen Troncal\\n";
		if (trim($combo_pto_troncal_a)=='')		$faltan_datose.="Debe indicar el Puerto destino Troncal\\n";
		
		if (trim($id_pto_troncal_d)=='')		$faltan_datose.="Debe indicar la Identificacion del Puerto Troncal \\n";
		if (trim($id_pto_troncal_a)=='')		$faltan_datose.="Debe indicar la Identificacion del Puerto Troncal \\n";						
		
		if (trim($nominter_troncal_d)=='')		$faltan_datose.="Debe indicar el Nombre de Interfase Troncal \\n";
		if (trim($nominter_troncal_a)=='')		$faltan_datose.="Debe indicar el Nombre de Interfase Troncal \\n";		
		
		if (trim($desc_nominter_troncal_d)=='')	$faltan_datose.="Debe indicar la Descripcion de la Interfase Troncal \\n";
		if (trim($desc_nominter_troncal_a)=='')	$faltan_datose.="Debe indicar la Descripcion de la Interfase Troncal \\n";		

		if (trim($ip_troncal_d)=='')			$faltan_datose.="Debe indicar la IP Interfase Troncal \\n";
		if (trim($ip_troncal_a)=='')			$faltan_datose.="Debe indicar la IP Interfase Troncal \\n";		
		
		if (trim($mtu_d)=='')					$faltan_datose.="Debe indicar la MTU \\n";
		if (trim($mtu_a)=='')					$faltan_datose.="Debe indicar la MTU \\n";	

//		if(trim($medio_tx)=='')				     $faltan_datose.="Debe indicar el Enlace\\n";
		
		//if (trim($ref_sisa_e)=='')			$faltan_datose.="Debe indicar la Referencia SISA\\n";				

		if ($faltan_datose<>"") echo "<script>alert('$faltan_datose');</script>";
		
		if ($faltan_datose=="")
		{
		      	$error="";
      	
			// Actualiza la Tabla "secciones_ce"
			$clust=substr($cluster,0,strpos($cluster,"|"));
			$datnodoo=mysql_query("SELECT anillo, id_nodo, proveedor_tx  from cat_anillo where id='$ido'");
			$enanillo=mysql_result($datnodoo,0,0);
			$enidnodo=mysql_result($datnodoo,0,1);
			$prov_orig=mysql_result($datnodoo,0,2);

			$datnodod=mysql_query("SELECT anillo, id_nodo  from cat_anillo where id='$idd'");
			$enidnodd=mysql_result($datnodod,0,1);
			
			$pto_troncal_d=$combo_pto_troncal_d;
			$pto_troncal_a=$combo_pto_troncal_a;
			$pto_troncal_d=str_replace(" 10G", "", $pto_troncal_d);
			$pto_troncal_a=str_replace(" 10G", "", $pto_troncal_a);
			$pto_troncal_d=substr($pto_troncal_d,strpos($pto_troncal_d,"--")+2);
			$pto_troncal_a=substr($pto_troncal_a,strpos($pto_troncal_a,"--")+2);

			if($prov_orig=="ALCATEL")	$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/', subslot+0, '/', if(instr(puerto,'G'),CONCAT(substr(puerto,1,instr(puerto,'G')-1), ' 10G'),puerto))";
			if($prov_orig=="CISCO")		$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/', if(instr(puerto,'G'),CONCAT(substr(puerto,1,instr(puerto,'G')-1), ' 10G'),puerto)) ";
			$qptoreservo=mysql_query("UPDATE inventario_puertos_ce set estatus='DISPONIBLE', pto_troncal=''                         where cluster='$clust' and (pto_troncal='$desc_nominter_troncal_d' or pto_troncal='$desc_nominter_troncal_a')");
			$qptoreservo=mysql_query("UPDATE inventario_puertos_ce set estatus='RESERVADO',  pto_troncal='$desc_nominter_troncal_d' where cluster='$clust' and id_nodo='$enidnodo' and $rssp='$combo_pto_troncal_d'");
			$qptoreservd=mysql_query("UPDATE inventario_puertos_ce set estatus='RESERVADO',  pto_troncal='$desc_nominter_troncal_a' where cluster='$clust' and id_nodo='$enidnodd' and $rssp='$combo_pto_troncal_a'");

			$tipoptod=mysql_result(mysql_query("SELECT tipo_puerto from inventario_puertos_ce where cluster='$clust' and pto_troncal='$desc_nominter_troncal_d'"),0,0);
			$tipoptoa=mysql_result(mysql_query("SELECT tipo_puerto from inventario_puertos_ce where cluster='$clust' and pto_troncal='$desc_nominter_troncal_a'"),0,0);
					
			$qenl="REPLACE INTO secciones_ce (anillo, id_nodo_d, pto_troncal_d, ip_troncal_d, id_pto_troncal_d, nominter_troncal_d, desc_nominter_troncal_d, mtu_d, id_nodo_a, pto_troncal_a, ip_troncal_a, id_pto_troncal_a, nominter_troncal_a, desc_nominter_troncal_a, mtu_a, ref_sisa_e,tipo_puerto_d,tipo_puerto_a,trayectoria,medio_tx)
			                VALUES ('$enanillo','$enidnodo','$pto_troncal_d','$ip_troncal_d','$id_pto_troncal_d','$nominter_troncal_d','$desc_nominter_troncal_d','$mtu_d', '$enidnodd', '$pto_troncal_a','$ip_troncal_a','$id_pto_troncal_a','$nominter_troncal_a','$desc_nominter_troncal_a','$mtu_a','$ref_sisa_e','$tipoptod','$tipoptoa',$trayectoria,'$medio_tx')";
			mysql_query($qenl);
			//echo $qenl;
			
		}
	}

}

//echo $trayectoria;
if ($altarcdt=="1")
{
	if (substr($tipoequipo,0,1)=="e")	//Alta de SECCIONES
	{

		$faltan_datosrcdt="";
		
		if (trim($combo_pto_troncal_dr)=='')		$faltan_datosrcdt.="Debe indicar el Puerto origen Troncal\\n";
		if (trim($pto_troncal_ar)=='')				$faltan_datosrcdt.="Debe indicar el Puerto destino Troncal\\n";
		
		if (trim($id_pto_troncal_dr)=='')			$faltan_datosrcdt.="Debe indicar la Identificacion del Puerto Troncal \\n";
		if (trim($id_pto_troncal_ar)=='')			$faltan_datosrcdt.="Debe indicar la Identificacion del Puerto Troncal \\n";	
		
		if (trim($nominter_troncal_dr)=='')			$faltan_datosrcdt.="Debe indicar el Nombre de Interfase Troncal \\n";
		if (trim($nominter_troncal_ar)=='')			$faltan_datosrcdt.="Debe indicar el Nombre de Interfase Troncal \\n";		
		
		if (trim($desc_nominter_troncal_dr)=='')	$faltan_datosrcdt.="Debe indicar la Descripcion de la Interfase Troncal \\n";
		if (trim($desc_nominter_troncal_ar)=='')	$faltan_datosrcdt.="Debe indicar la Descripcion de la Interfase Troncal \\n";		
								
		if (trim($ip_troncal_dr)=='')				$faltan_datosrcdt.="Debe indicar la IP Interfase Troncal \\n";
		if (trim($ip_troncal_ar)=='')				$faltan_datosrcdt.="Debe indicar la IP Interfase Troncal \\n";		


		if (trim($ip_mascara_dr)=='')				$faltan_datosrcdt.="Debe indicar la Mascara \\n";
		if (trim($vel_pto)=='')						$faltan_datosrcdt.="Debe indicar la Velocidad del Puerto \\n";				
		if (trim($central_rcdt)=='')				$faltan_datosrcdt.="Debe indicar la Central RCDT \\n";
		
		if ($faltan_datosrcdt<>"") echo "<script>alert('$faltan_datosrcdt');</script>";
    
		if ($faltan_datosrcdt=="")
		{
		      	$error="";
      	
			// Actualiza la Tabla "secciones_ce"
			$clust=substr($cluster,0,strpos($cluster,"|"));
			$datnodoo=mysql_query("SELECT anillo, id_nodo, proveedor_tx  from cat_anillo where id='$ido'");
			$enanillo=mysql_result($datnodoo,0,0);
			$enidnodo=mysql_result($datnodoo,0,1);
			$prov_orig=mysql_result($datnodoo,0,2);

			$pto_troncal_dr=$combo_pto_troncal_dr;
			$pto_troncal_dr=str_replace(" 10G", "", $pto_troncal_dr);
			$pto_troncal_dr=substr($pto_troncal_dr,strpos($pto_troncal_dr,"--")+2);

			$desc_nominter_troncal_dr1=substr($desc_nominter_troncal_dr,0,10);
			$tipoptod=mysql_result(mysql_query("SELECT tipo_puerto from inventario_puertos_ce where cluster='$clust' and pto_troncal='$desc_nominter_troncal_dr1'"),0,0);

			$qenl="REPLACE INTO secciones_ce (anillo, id_nodo_d, pto_troncal_d, ip_troncal_d, vel_pto_d, ip_mascara_d, id_pto_troncal_d, nominter_troncal_d, desc_nominter_troncal_d, mtu_d, id_nodo_a, pto_troncal_a, ip_troncal_a, id_pto_troncal_a, nominter_troncal_a, desc_nominter_troncal_a, mtu_a, ref_sisa_e,hostname_a,no_cambio_rcdt,prioridad_rcdt,tipo_puerto_d,remate_rcdt,long_cable_rcdt)
			                VALUES ('$enanillo','$enidnodo','$pto_troncal_dr','$ip_troncal_dr', '$vel_pto', '$ip_mascara_dr', '$id_pto_troncal_dr','$nominter_troncal_dr','$desc_nominter_troncal_dr','NA', '$enidnodo', '$pto_troncal_ar','$ip_troncal_ar','$id_pto_troncal_ar','$nominter_troncal_ar','$desc_nominter_troncal_ar','NA','NA','$hostname_rcdt','$no_cambio_rcdt','$prioridad_rcdt','$tipoptod','$remate_rcdt','$long_cable_rcdt')";
			mysql_query($qenl);
			//echo $qenl;

			if (strstr($enidnodo,"DIST1"))
			{
				if($prioridad_rcdt=="PRIMARIO") $prioridad_rcdt2="SECUNDARIO";
				else $prioridad_rcdt2="PRIMARIO";
				mysql_query("UPDATE secciones_ce set prioridad_rcdt='$prioridad_rcdt2' where anillo='$clust' and id_nodo_d like '%DIST2%'  and id_pto_troncal_d like '%RCDT%'");
			}

			if($prov_orig=="ALCATEL")	$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/', subslot+0, '/', if(instr(puerto,'G'),CONCAT(substr(puerto,1,instr(puerto,'G')-1), ' 10G'),puerto))";
			if($prov_orig=="CISCO")		$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/', if(instr(puerto,'G'),CONCAT(substr(puerto,1,instr(puerto,'G')-1), ' 10G'),puerto))";

			$qptoreservo=mysql_query("UPDATE inventario_puertos_ce set estatus='DISPONIBLE', pto_troncal=''                          where cluster='$clust' and pto_troncal='$desc_nominter_troncal_dr'");
			$qptoreservo=mysql_query("UPDATE inventario_puertos_ce set estatus='RESERVADO',  pto_troncal='$desc_nominter_troncal_dr' where cluster='$clust' and id_nodo='$enidnodo' and $rssp='$combo_pto_troncal_dr'");
		}
	}
}

// *** Solicitud a CNS de Gestion de CLUSTER y Nodos ***
if (($solcns==1 and trim($obscns)<>"") or ($solcns==2 and trim($obscnsnd)<>""))
{
	$clust=substr($cluster,0,strpos($cluster,"|"));
	if($solcns==1) $qdatos_orden="SELECT id, division, ospf, proveedor_tx from cat_anillo where anillo='$clust' and repisa='DISTRIBUIDOR 1'";
	if($solcns==2)
	{
		if(substr($tipoequipo,0,3)=='af2') $qdatos_orden="SELECT t1.id, t1.division, t1.ospf, t1.proveedor_tx, t1.repisa as repf2, t2.repisa as repf1, t1.mpls   from cat_anillo as t1 inner join cat_anillo as t2 on t1.anillo=t2.anillo and  t1.clli_agr2=t2.clli_equipo where t1.anillo='$clust' and t1.id='$id'";
		else $qdatos_orden="SELECT id, division, ospf, proveedor_tx,repisa,mpls from cat_anillo where anillo='$clust' and id='$id'";
	}
	
	//echo $qdatos_orden;
		
	$datos_orden=mysql_query($qdatos_orden);		
	if ($roworden = mysql_fetch_array($datos_orden));

	$obs_orden=mysql_query("SELECT observaciones,observaciones_top,num_ot_frida from ordenes where nombre_oficial_pisa like '$clust%' and tabla='cat_anillo' and id_tabla='".$roworden['id']."'");

	if ($rowobs_orden = mysql_fetch_array($obs_orden))
	{
		$rowobsorden=str_replace("'","\'",$rowobs_orden['observaciones_top']);
		$rowobsorden1=str_replace("'","\'",$rowobs_orden['observaciones']);
		$rf=$rowobs_orden['num_ot_frida'];
	}
	
	if (trim($rf)=="" and $solcns==1) $rf="RF-CLU-".date('dmY')."-".rand(10000, 99999);
	if (trim($rf)=="" and $solcns==2) $rf="RF-CND-".date('dmY')."-".rand(10000, 99999);
	
	if($solcns==2)
	{
		if(substr($tipoequipo,0,3)=='af2')	$repnd="AGR".trim(substr($roworden['repf1'],-2))."-AGR".trim(substr($roworden['repf2'],-2));
		else					$repnd="AGR".trim(substr($roworden['repisa'],-2));
	}
	
	
	$tiempo=date('Y-m-d h:i');
	if ($solcns==1) $qcns="REPLACE INTO ordenes (fecha_solicitud, cns, num_ot_frida, estatus, tabla, id_tabla, division, area, nombre_oficial_pisa, no_reps, tipo_trabajo, tipo_equipo, trafico, observaciones_top, observaciones) VALUES (now(), 'CNS I', '$rf','POR REVISAR','cat_anillo','".$roworden['id']."','".$roworden['division']."','".$roworden['ospf']."','$clust','".$roworden['proveedor_tx']."','ALTA CLUSTER',  'CLUSTER','CLUSTER', CONCAT('|$tiempo Usuario: ','(','$sess_usr',') ','$sess_nmb',' - ','$obscns\\n','".$rowobsorden."'),'".$rowobsorden1."')";
//	if ($solcns==1) $qcns="REPLACE INTO ordenes (num_ot_frida, estatus, tabla, id_tabla, division, area, nombre_oficial_pisa, no_reps, tipo_trabajo, tipo_equipo, trafico, observaciones_top, observaciones) VALUES ('$rf','POR REVISAR','cat_anillo','".$roworden['id']."','".$roworden['division']."','".$roworden['ospf']."','$clust','".$roworden['proveedor_tx']."','ALTA CLUSTER',  'CLUSTER','CLUSTER', CONCAT('|$tiempo Usuario: ','(','$sess_usr',') ','$sess_nmb',' - ','$obscns\\n','".$rowobsorden."'),'".$rowobsorden1."')";

	if ($solcns==2) 
	{   
		if($roworden['mpls']=='OK') $mjmpl = 'Nodo con configuracion de MPLS-TE con load-share'; else $mjmpl = '';
		$qcns="REPLACE INTO ordenes (fecha_solicitud, cns, num_ot_frida, estatus, tabla, id_tabla, division, area, nombre_oficial_pisa, no_reps, tipo_trabajo, tipo_equipo, trafico, observaciones_top, observaciones) VALUES (now(), 'CNS I', '$rf','POR REVISAR','cat_anillo','".$roworden['id']."','".$roworden['division']."','".$roworden['ospf']."','".$clust."-".$repnd."','".$roworden['proveedor_tx']."','CAMBIO CLUSTER','CLUSTER','NODO CLUSTER', CONCAT('|$tiempo Usuario: ','(','$sess_usr',') ','$sess_nmb',' - $mjmpl - ','$obscnsnd\\n','".$rowobsorden."'),'".$rowobsorden1."')";
//		$qcns="REPLACE INTO ordenes (num_ot_frida, estatus, tabla, id_tabla, division, area, nombre_oficial_pisa, no_reps, tipo_trabajo, tipo_equipo, trafico, observaciones_top, observaciones) VALUES ('$rf','POR REVISAR','cat_anillo','".$roworden['id']."','".$roworden['division']."','".$roworden['ospf']."','".$clust."-".$repnd."','".$roworden['proveedor_tx']."','CAMBIO CLUSTER','CLUSTER','NODO CLUSTER', CONCAT('|$tiempo Usuario: ','(','$sess_usr',') ','$sess_nmb',' - ','$obscnsnd\\n','".$rowobsorden."'),'".$rowobsorden1."')";
		#echo $qcns;
		mysql_query("UPDATE cat_anillo set estatus_cns='POR REVISAR' where id=".$roworden['id'] and estatus_cns<>'GESTIONADO');
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


<!-- //##################################################################CLUSTER######################################################################################### -->

<div id="infcluster" style='margin: 0 auto;width :950px;'>
  <table width="950" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td width="268" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo49">INFORMACION DEL CLUSTER </td>
      
      
      
      <td width="181" bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
      <td width="144" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28">&nbsp;</td>
      <td class="Estilo28"><input class='Estilo57' type="button" name="cns" id="cns" value="Solicitar Gestion de CLUSTER" onclick='document.cluster.solcns.value=1;document.cluster.ArmBrokerBandera.value=bandera();document.cluster.ArmBrokerCluster.value=obterCluster();submit();'></td>
 <script>
function obterCluster(){
    
	
	var id_nodo=$('#clusterId option:selected').val()
var n = id_nodo.indexOf("|");
var m = id_nodo.length
var id_cluste_limpio=id_nodo.slice(0, n-1) 
	 return id_cluste_limpio;
	 }
function bandera(){
var nuevabandera;
        var bandera=$('#ArmBrokerBandera').val();
	if($('#ArmBrokerBandera').val()==null){
	 nuevabandera=8;
		}	
    	return nuevabandera  
	}	 
	 
 </script>     
      <td class="Estilo28" style='<?=$verobscns?>'><textarea class='Estilo28' name='obscns' id='obscns'></textarea></td>
 
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">Cluster</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <?php
//				$query_d="SELECT anillo,ospf FROM cat_anillo WHERE tecnologia='CARRIER ETHERNET' GROUP BY anillo ORDER BY anillo ASC";
				$query_d="SELECT anillo,ospf FROM cat_anillo WHERE tecnologia='CARRIER ETHERNET' and (division like '$sess_dd' ) GROUP BY anillo ORDER BY anillo ASC";

//				echo $query_d;
				$res_d = mysql_query($query_d);
										
				if ($rowc = mysql_fetch_array($res_d)){ 
				echo "<select name='cluster' id='clusterId' onchange='document.cluster.ido.value=\"\";document.cluster.trayectoria.value=0;document.cluster.ArmBrokerBandera.value=0;document.cluster.idd.value=\"\";document.cluster.tipoequipo.value=\"\";submit();'><option value=''>";
				do {  
				       if($cluster==$rowc["anillo"]."|".$rowc["ospf"]) $selcd="selected";
				       else $selcd="";
				       
				       echo "<option $selcd value= '".$rowc["anillo"]."|".$rowc["ospf"]."'>".$rowc["anillo"]."</option>";
				} while ($rowc = mysql_fetch_array($res_d)); 
				echo '</select>';			
				}	
				
				$ospf=$region="";
				if (trim($cluster<>'')) {$region='';$ospf=substr($cluster,strpos($cluster,"|")+1);$clust=substr($cluster,0,strpos($cluster,"|"));}	
			?>
			
	</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">Topolog&iacute;a</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28">


        <?php if ($congelar<>"1") {?>
        <input name="creatop" type="button" class="Estilo49" id="button" title='Opcion para generar el archivo topolgico' onclick="window.open('crea_topologico.php?cluster=<?=$clust?>&congelar=<?=$congelar?>');" value="Crea Topol&oacute;gico Logico" />
        <?php }?>
        <input name="topologia" readonly type="text" class="Estilo48" id="topologia" title='Topología del Cluster' value="<?=$topologia?>" size="5"/>
        <?php if ($congelar<>"1") {?>
        <input name="anexos"  type="button" class="Estilo49" id="button" title='Opcion para cargar anexos del Nodo' onclick="window.open('carga_archivos_ce?tec=ce&tipo=anexo&id=<?=$id?>&cluster=<?=$clust?>&congelar=<?=$congelar?>');" value="Cargar Anexo" /><!-- , '_blank','toolbar=0,height=1000,scrollbars=yes'-->
        <?php }?>

      </td></tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">Region
      
      
        <?php

				$datosanillo=mysql_query("SELECT region,ciudad from cat_anillo where anillo='$clust'");

				if (mysql_num_rows($datosanillo)>0)
  				{
				  $region=mysql_result($datosanillo,0,0);
  				  $idcd=mysql_result($datosanillo,0,1);   

  				  if(!is_numeric($idcd))    
  				  {
  				    $datcd=mysql_query("SELECT cod_ciudad from cat_ciudades where ciudad='$idcd'");
  				    if(mysql_num_rows($datcd)>0)$idcd=mysql_result($datcd,0,0);
  				  }
  				  
  				  if(is_numeric($idcd))
  				  {
  				  	$idreg=mysql_result(mysql_query("SELECT region from cat_regiones where entidad='$region'"),0,0);
	  				  $datcd=mysql_query("SELECT ciudad,consecutivo from cat_ciudades where region='$idreg' and cod_ciudad='$idcd'");
	  				  $ciudad=mysql_result($datcd,0,0);
	  				  $consecutivo=mysql_result($datcd,0,1)+1;
	  				  if ($ospf=="") $ospf="$idreg.$idcd.1.$consecutivo";
	  				  echo "<script>document.cluster.ospf.value='$ospf';</script>";
	  			  }
				}

				if (trim($cluster=='')){
				$query_d="select region,entidad from cat_regiones group by entidad order by entidad ASC";
				$res_d = mysql_query($query_d);
										
				if ($row = mysql_fetch_array($res_d)){ 
/*				echo "<select name='region' onchange='document.cluster.cambioreg.value=0;submit()'><option value=''>";
				do {  
				       if($region==$row["region"]) $selcd="selected";
				       else $selcd="";
				       
				       //echo "<option $selcd value= '".$row["region"]."'>".$row["entidad"]."</option>";
				} while ($row = mysql_fetch_array($res_d)); 
				echo '</select>';			*/
				}
				}

				echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo28'>$region</td>";
				echo "</td>";
				echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF'>Ciudad";
				echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo28'>$ciudad</td>";
		
				if (trim($cluster=='')){
				if ($cambioreg==0) $cod_ciudad='';
				$query_d="select cod_ciudad,ciudad from cat_ciudades where region='$region' group by cod_ciudad order by cod_ciudad ASC";
				$res_d = mysql_query($query_d);
										
				if ($row = mysql_fetch_array($res_d)){ 
				echo "<select name='cod_ciudad' onchange='submit()'><option value=''>";
				do {  
				       if($cod_ciudad==$row["cod_ciudad"]) $selcd="selected";
				       else $selcd="";
				       
				       echo "<option $selcd value= '".$row["cod_ciudad"]."'>".$row["ciudad"]."</option>";
				} while ($row = mysql_fetch_array($res_d)); 
				echo '</select>';			
				}		
				}

			?>
      </td>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">      
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">Area <strong>OSPF</strong></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="ospf" readonly value="<?=$ospf?>" type="text" id="ospf" title='OSPF'/></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">Estatus CNS del Cluster</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="estatus_cns" readonly type="text" id="estatus_cns" title='Estatus del Custer' value="<?=$estatcnsclust?>"/><?=$leyendacong?></td>
    </tr>
  </table><br>
</div>
  
  
  
<!-- //##################################################################NODOS######################################################################################### -->
  
<?
		$datos_nodo=mysql_query("SELECT * from cat_anillo where id='$id'");
		
		$cllitxt="";
		
		if($cambionodo==1 or $cambionodo==2)
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
		}
  
  		$tip=$abrev="";
		if(substr($tipoequipo,0,1)=="d")	{$tip="DISTRIBUIDOR";$tip2="DISTRIBUIDOR";$abrev="DIST";}
		if(substr($tipoequipo,0,1)=="a")	{$tip="AGREGADOR";$tip2="AGREGADOR";$abrev="AGR";}
		if(substr($tipoequipo,0,3)=="af2")	{$tip="AGREGADOR";$tip2="AGREGADOR 2";$abrev="AGR";}		

		$rep_sql=mysql_query("select repisa from cat_anillo where anillo='$clust' and repisa like '$tip%' and tipo_cluster='$tip2' order by substr(repisa,locate(' ',repisa)+1)+0");
		$linrep=mysql_num_rows($rep_sql);

		if ($linrep>0)
		{
			$nuevarepisa=mysql_result($rep_sql,$linrep-1,0);
			$repcon=substr($nuevarepisa,-2)+1;
			$nuevarepisa=trim(substr($nuevarepisa,0,-2))." ".$repcon;
			
		}
		elseif(substr($tipoequipo,0,3)=="af2") $nuevarepisa="$tip 11";
		else $nuevarepisa="$tip 1";

		$id_nodo='';
		if (isset($clli_equipo))
		{
			if(substr($nuevarepisa,-1)=="X") $repcons=10;
			else $repcons=trim(substr($nuevarepisa,-2));
			if($proveedor=="ALCATEL") $mod=substr($repadm_conxadsl,0,4);
			if($proveedor=="CISCO")   $mod=trim(substr($repadm_conxadsl,2,3));
			if($proveedor=="CISCO" && $repadm_conxadsl == 'ASR9006')   $mod=trim(substr($repadm_conxadsl,3,4));
			if($proveedor=="CISCO" && $repadm_conxadsl == 'ASR9010')   $mod=trim(substr($repadm_conxadsl,3,4)); 
			$id_nodo="$clli_equipo-".$abrev.$repcons."-".$mod;
			$id_inter_sistema="sistema-$clli_equipo-".$abrev.$repcons;
			$id_inter_gestion="$clli_equipo-".$abrev.$repcons;
			$inter_gest="gestion-$clli_equipo-".$abrev.$repcons;
		}	
			
			
		if ($datosnodo['repisa']<>"")
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
			$mpls   = $datosnodo['mpls'];
			
		}	


		


		echo "<script>document.cluster.repisa.value='$nuevarepisa';</script>";
		echo "<script>document.cluster.topologia.value='".$datosnodo['topologia']."';</script>";
		//echo "<script>document.cluster.estatus_cns.value='".$datosnodo['estatus_cns']."';</script>";		
?>


<div id="infequipo" style="margin: 0 auto;width :950px;<?=$vereq?>"> 
  <table width="950" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td width="234" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo49" colspan=4>INFORMACION DEL NODO </td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">Estatus CNS del Nodo</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="estatus_cns" readonly type="text" id="estatus_cns" title='Estatus del Nodo' value="<?=$estatcnsnodo?>"/></td>
      
      <?if($mpls== 'OK'){?>
      <td class="Estilo28" colspan='2'><label style ='color:#E10000;font-weight:bold;'>Nodo con configuraci&oacute;n de MPLS-TE con load-share</label></td>
      <?}else{?>
      <td class="Estilo28">&nbsp;</td>
      <td class="Estilo28">&nbsp;</td>
      <?}?>
      <td class="Estilo28" style='<?=$verobscns?>'>&nbsp;</td>
    </tr>

    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">Proveedor</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><?=$proveedor?></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">Modelo</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><?=$repadm_conxadsl?></td>
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
      <?php
      
       if ($congelar<>"1" and $congelarnodo<>"1") {?>
		<input name="cargaot" type="button" class="Estilo49" id="button" title='Opcion para cargar la OT (Grafo) del Nodo' onclick="window.open('carga_archivos_ce?tec=ce&tipo=ot&id=<?=$id?>&cluster=<?=$clust?>&congelar=<?=$congelar?>&congelarnodo=<?=$congelarnodo?>');" value="Cargar OT" />
      <?php }?>

		<input name="ot_nodo" readonly type="text" class="Estilo48" id="ot_nodo" title='OT del Nodo' value="<?=$datosnodo['ot_nodo']?>" size="5"/>

      <?php if ($congelar<>"1" and $congelarnodo<>"1") {?>
		<input name="cargaotamp" type="button" class="Estilo49" id="button" title='Opcion para cargar la OT de Ampliacin del Nodo' onclick="window.open('carga_archivos_ce?tec=ce&tipo=otamp&id=<?=$id?>&cluster=<?=$clust?>&congelar=<?=$congelar?>&congelarnodo=<?=$congelarnodo?>');" value="Cargar AMP." />

      <?php }?>
		
        <?php
        
         //if ($congelar<>"1"  and $congelarnodo<>"1") echo "<input name='creaot' type='button' class='Estilo49' id='button' title='Opcion para generar el Anexo de la OT (Grafo) del Nodo'   onclick=\"window.open('crea_orden_cluster_pdf.php?clli_equipo=$clli_equipo&congelar=$congelar&congelarnodo=$congelarnodo');\" value='Genera Anexo OT' />";
       ?>

    </td>
    </tr>
    
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">Identificador de Nodo </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="id_nodo" type="text" class="Estilo48" id="id_nodo" title='Identificador de Nodo' size="28" value="<?=$id_nodo?>" readonly/></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">Ubicacion del Nodo </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="ubi_nodo_adm" type="text" class="Estilo48" id="ubi_nodo_adm" title='Ubicacion del Nodo' value="<?=$ubi_nodo_adm?>" size="28" onclick="ubica()" /></td>
    </tr>
    <tr>
    	<td></td>
    	<td></td>
    	<td></td>
    	<td>
       
		
		 </td>
    </tr>
    
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">Id interfase  de Sistema</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="id_inter_sistema" type="text" class="Estilo48" id="id_inter_sistema" title='Id interfase Logica de Sistema' size="28" value="<?=$id_inter_sistema?>" readonly/></td>
      
      <?php
      $readonlyL0="readonly";
      if(strtoupper($sess_usr)=="JTELLEZ" or strtoupper($sess_usr)=="DMONZALV" or strtoupper($sess_usr)=="VVDELRIO" or strtoupper($sess_usr)=="CUALVARA" or strtoupper($sess_usr)=="JJAYALA" or $perfil=="Administrador") $readonlyL0="";
      ?>
      
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">IP Sistema (L0)</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="ip_sistema" type="text" class="Estilo48" id="ip_sistema" title='IP Sistema (L0)' value="<?=$ip_sistema?>" size="28" <?=$readonlyL0?> /></td>
    </tr>
    
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">Id interfase  de Gestion </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="id_inter_gestion" type="text" class="Estilo48" id="id_inter_gestion" title='Id interfase Logica de Gestion' size="28" value="<?=$id_inter_gestion?>" readonly/></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">IP Gestion (L1)</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="ip_gestion" type="text" class="Estilo48" id="ip_gestion" title='IP Gestion (L1)' value="<?=$ip_gestion?>" size="28"/></td>
    </tr>
    
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td class="Estilo42">Nombre interfase  de Gestion</td>
      <td class="Estilo28"><input name="inter_gest" type="text" class="Estilo48" id="inter_gest" title='Nombre interfase Logica de Gestion' size="28" value="<?=$inter_gest?>" readonly/></td>
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
      <td class="Estilo28">&nbsp;</td>
      <td class="Estilo42">&nbsp;</td>
      <td class="Estilo28"><input class='Estilo57' type="button" name="guardar" id="button" value="Guardar Datos del Nodo" onclick='document.cluster.altanodo.value=1;submit();' /></td>
    </tr>
	<?php
	if ($nuevarepisa<>"DISTRIBUIDOR 1" AND $nuevarepisa<>"DISTRIBUIDOR 2") {
	?>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td class="Estilo42">&nbsp;</td>
      <td class="Estilo28">&nbsp;</td>
      <td class="Estilo28">&nbsp;</td>
      <td class="Estilo28"><input class='Estilo57' type="button" name="cnsnd" id="cnsnd" value="Solicitar Gestion de NODO" onclick='document.cluster.solcns.value=2;submit();ArmEquipo();'></td>
      <td class="Estilo28" style='<?=$verobscnsnd?>'><textarea class='Estilo28' name='obscnsnd' id='obscnsnd'></textarea></td> 
    </tr>
	<?php
	}
	?>
	
  </table>
  <p><br>
     
 
    <!-- ############################################TARJETAS Y PUERTOS ##########################################################################--> 
    
    <?php



if ($altatj=="altatj")
{
	$faltan_datostj="";
	if (trim($repisat)=='')				$faltan_datostj.="Debe seleccionar la repisa\\n";	
	if (trim($modelo_tarjeta)=='')		$faltan_datostj.="Debe seleccionar el Modelo de la Tarjeta\\n";
	if (trim($slot)=='')				$faltan_datostj.="Debe seleccionar la Posicion de la Tarjeta (Slot en la Repisa)\\n";

	if ($faltan_datostj<>"") echo "<script>alert('$faltan_datostj');</script>";

	if ($faltan_datostj=="")
	{
		$error="";
		$qalta="INSERT INTO inventario_tarjetas_ce (cluster, id_nodo, modelo_tarjeta, repisat, posicion_tarjeta, modulo, subslot, fecha_alta, login, num_ot_frida, estatus) VALUES ('$clust', '$id_nodo', '$modelo_tarjeta', '$repisat', '$slot', '$tipo_tarjeta', '$subslot', NOW(),'".$sess_usr."','$rf','POR REVISAR')";
		//echo $qalta;
		mysql_query($qalta);
	}
}


if (substr($altatj,0,6)=="bajatj")
{
	$idtj=substr($altatj,strpos($altatj,"-",7)+1);
	$qbajatj=mysql_query("SELECT id_nodo, repisat, posicion_tarjeta, subslot,modulo,modelo_tarjeta from inventario_tarjetas_ce where id='$idtj'");
	$idnodobajatj=mysql_result($qbajatj,0,0);
	$repbajatj=mysql_result($qbajatj,0,1);
	$slotbajatj=mysql_result($qbajatj,0,2);
	$subslotbajatj=mysql_result($qbajatj,0,3);
	$modulobjtj = mysql_result($qbajatj, 0,4);
	$modbjtj    = mysql_result($qbajatj, 0,5);

	if($modbjtj == 'ASR9000v'){
		#Limpiar el puerto del Agregador en el cual estaba conectado el Satelite
		mysql_query("UPDATE  inventario_puertos_ce SET pto_troncal = '', estatus = 'DISPONIBLE' 
			            WHERE  cluster='$clust' and id_nodo='$idnodobajatj'  and repisat='$repbajatj'AND pto_troncal LIKE '%ASRV".$slotbajatj."%'");
		
		#Eliminar el equipo de cat_anillo
		mysql_query("DELETE FROM cat_anillo WHERE  anillo_pp='$clust' AND tecnologia = 'SATELITE' and id_nodo = '$modulobjtj' ");
	}
		
	mysql_query("DELETE FROM inventario_tarjetas_ce where id='$idtj'");
	mysql_query("DELETE FROM inventario_puertos_ce where cluster='$clust' and id_nodo='$idnodobajatj' and repisat='$repbajatj' and posicion_tarjeta='$slotbajatj' and subslot='$subslotbajatj'");


}
    
	
	    
	if ($datosnodo['proveedor_tx']=='ALCATEL' or $datosnodo['proveedor_tx']=='CISCO')
{
	echo "<table width='950' border='3' cellspacing='1' bordercolor='#999999' bgcolor='#CAE4FF'>\n";
	echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>\n";
	echo "<td colspan=6 class='Estilo49'>ALTA TARJETAS</td></tr>\n";

	if($repadm_conxadsl == 'ASR9010' || $repadm_conxadsl == 'ASR9006'){
		echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>\n";
		echo "<td class='Estilo53'></td>\n";
		echo "<td class='Estilo53'></td>\n";
		echo "<td class='Estilo53'> </td>\n";
		echo "<td class='Estilo53'></td>\n";
        echo "<td class='Estilo53'></td>\n";	
        $clusterName = substr($cluster,0,strpos($cluster,"|"));
		
		echo "<td class='Estilo53'><input type = 'button' value = 'Equipos ASR9000v' OnClick = 'window.open(\"cascadea_equipo.php?id_nodo=$id_nodo&cluster=$clusterName\",\"Cascadea\",\"height=500,width=1100,scrollbars=yes,resizable=yes\");'></td>\n";
		
		echo "</tr>\n";
	}

      
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
	$query="select modelo_tarjeta from cat_tarjetas_ce where proveedor='".$datosnodo['proveedor_tx']."' and equipo like '%".substr($datosnodo['repadm_conxadsl'],0,4)."%'  and modelo_tarjeta  != 'ASR9000v'group by modelo_tarjeta order by modelo_tarjeta ASC";
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
				$query="select slot from cat_tarjetas_ce where proveedor='".$datosnodo['proveedor_tx']."'  and equipo like '%".substr($datosnodo['repadm_conxadsl'],0,4)."%' and modelo_tarjeta like '$modelo_tarjeta' group by slot order by slot";

				$res = mysql_query($query);	

				if($proveedor=="CISCO") $cuentasubslot=1;
				if($proveedor=="ALCATEL") $cuentasubslot=2;
				if($proveedor=="ALCATEL" or $repadm_conxadsl=="7750 SR") $cuentasubslot=3;

				$querytjc="SELECT posicion_tarjeta,count(posicion_tarjeta) from inventario_tarjetas_ce where cluster='$clust' and id_nodo='$id_nodo' and repisat='$repisat' group by posicion_tarjeta having count(posicion_tarjeta)=$cuentasubslot order by posicion_tarjeta";
				$tjsl_cargadas=mysql_query($querytjc);
				for ($tjc=0;$tjc<mysql_num_rows($tjsl_cargadas);$tjc++) $tjslc[$tjc]=mysql_result($tjsl_cargadas,$tjc,0);
				
				echo "<select name='slot' onchange='submit()'>\n<option value=''></option>\n";
				if ($row = mysql_fetch_array($res)){ 
				do { 
                                       	if($slot==$row["slot"]) $selrep="selected";
					else $selrep="";
					if(!in_array($row["slot"],$tjslc) or $row["slot"]==$slots) echo "<option $selrep value= '".$row["slot"]."'>".$row["slot"]."</option>\n";
     				       	
				} while ($row = mysql_fetch_array($res)); 
				}			
				echo "</select>\n\n";
				
			?>
    </td>


<?php
	if (($datosnodo['proveedor_tx']=='ALCATEL' and substr($tipoequipo,0,3)<>"af2") or $repadm_conxadsl=="7450 ESS7")
        {
		if($subslot2<>"") $subslot=$subslot2;
		$s1=$s2="";
		if ($subslot=="1") $s1="selected";
		if ($subslot=="2") $s2="selected";
		
		echo "<td class='Estilo28'> \n";
		echo "<select name='subslot' title='Subslot:' onchange='submit();'> \n";
		echo "<option value=' '></option> \n";
		echo "<option value='01' $s1>01</option> \n";
		echo "<option value='02' $s2>02</option> \n";		
		echo "</select></td> \n";
	}
	
	
	if ($repadm_conxadsl=="7750 SR")
        {

		if($subslot2<>"") $subslot=$subslot2;
		$s1=$s2="";
		if ($subslot=="1") $s1="selected";
		if ($subslot=="3") $s2="selected";
		if ($subslot=="5") $s3="selected";
		
		echo "<td class='Estilo28'> \n";
		echo "<select name='subslot' title='Subslot:' onchange='submit();'> \n";
		echo "<option value=' '></option> \n";
		echo "<option value='01' $s1>01</option> \n";
		echo "<option value='03' $s2>03</option> \n";		
		echo "<option value='05' $s3>05</option> \n";				
		echo "</select></td> \n";
	}
	
	if (($datosnodo['proveedor_tx']=='CISCO' or substr($tipoequipo,0,3)=="af2") and $repadm_conxadsl<>"7750 SR" and $repadm_conxadsl<>"7450 ESS7" and !strstr($repadm_conxadsl,"7210")) 
	{
		echo "<td class='Estilo28'>&nbsp</td>";
		echo "<input type=hidden name=subslot value='N/A'>";
	}

	if (strstr($repadm_conxadsl,"7210")) 
	{
		echo "<td class='Estilo28'>&nbsp</td>";
		echo "<input type=hidden name=subslot value='01'>";
	}
	
?>
	  
	  
<?php

	if ($datosnodo['proveedor_tx']=='ALCATEL' and $repadm_conxadsl<>"7750 SR") 
	{
	
		if($tipo_tarjeta2<>"") $tipo_tarjeta=$tipo_tarjeta2;
		$query="select tipo_tarjeta from cat_tarjetas_ce where proveedor='".$datosnodo['proveedor_tx']."'  and equipo like '%".substr($datosnodo['repadm_conxadsl'],0,4)."%' and modelo_tarjeta='$modelo_tarjeta' and slot='$slot' group by tipo_tarjeta order by tipo_tarjeta ASC";
		//echo"<br>query:$query";
		$rest = mysql_query($query);						
		echo "<td class='Estilo28'>";
		echo "<select name='tipo_tarjeta' onchange='submit()'>\n<option value=''></option>\n";
		if ($row = mysql_fetch_array($rest)){
			do { 
				if($tipo_tarjeta==$row["tipo_tarjeta"]) $seltt="selected";
				else $seltt="";
				echo "<option $seltt value='".$row["tipo_tarjeta"]."'>".$row["tipo_tarjeta"]."</option>\n";
			} while ($row = mysql_fetch_array($rest)); 
		}			
		echo "</select></td>\n\n";	
	}

	if ($datosnodo['proveedor_tx']=='ALCATEL' and $repadm_conxadsl=="7750 SR") 
	{
	
		if($tipo_tarjeta2<>"") $tipo_tarjeta=$tipo_tarjeta2;
		$query="select tipo_tarjeta from cat_tarjetas_ce where proveedor='".$datosnodo['proveedor_tx']."'  and equipo like '%".substr($datosnodo['repadm_conxadsl'],0,4)."%' and modelo_tarjeta='$modelo_tarjeta' and slot='$slot' and subslot='$subslot' group by tipo_tarjeta order by tipo_tarjeta ASC";
		$rest = mysql_query($query);						
		echo "<td class='Estilo28'>";
		echo "<select name='tipo_tarjeta' onchange='submit()'>\n<option value=''></option>\n";
		if ($row = mysql_fetch_array($rest)){
			do { 
				if($tipo_tarjeta==$row["tipo_tarjeta"]) $seltt="selected";
				else $seltt="";
				echo "<option $seltt value='".$row["tipo_tarjeta"]."'>".$row["tipo_tarjeta"]."</option>\n";
			} while ($row = mysql_fetch_array($rest)); 
		}			
		echo "</select></td>\n\n";	
	}

	
	if ($datosnodo['proveedor_tx']=='CISCO') 
	{
		echo "<td class='Estilo28'>&nbsp</td>";
		echo "<input type=hidden name=tipo_tarjeta value='N/A'>";
	}
	
?>
	  
         <td width='40px' align='center'><img src='images/add.png' onclick='document.cluster.altatj.value="altatj";document.cluster.submit();'></td></tr>

    </tr>
    
    
<?php

//##################TARJETAS CONFIGURADOS##########################

	$tj_cargadas=mysql_query("SELECT * from inventario_tarjetas_ce where cluster='$clust' and id_nodo='$id_nodo' order by repisat, posicion_tarjeta, subslot");

	echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo49'><td colspan=6><br>TARJETAS CONFIGURADAS</td></tr>\n";

	if ($tj_carga = mysql_fetch_array($tj_cargadas))
	{ 
		$ntj=0;
		do {  
			if($repisat==$tj_carga['repisat'] and  $tipo_tarjeta==$tj_carga['modulo'] and $slot==$tj_carga['posicion_tarjeta'] and $subslot==$tj_carga['subslot'])  $clase="Estilo70";
			else $clase="Estilo42";
			
			$idtj=$tj_carga['id'];
			echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='$clase' title='Click para ver los puertos de esta tarjeta' onmouseover='this.className=\"Estilo70\";' onmouseout='this.className=\"$clase\";' onclick='document.cluster.verpuertos.value=1;document.cluster.repisat2.value=\"".$tj_carga['repisat']."\";document.cluster.modelo_tarjeta2.value=\"".$tj_carga['modelo_tarjeta']."\";document.cluster.slot2.value=\"".$tj_carga['posicion_tarjeta']."\";document.cluster.subslot2.value=\"".$tj_carga['subslot']."\";document.cluster.tipo_tarjeta2.value=\"".$tj_carga['modulo']."\";document.cluster.submit()'>\n";
			echo "<td>".$tj_carga['repisat']."</td>\n";
			echo "<td>".$tj_carga['modelo_tarjeta']."</td>\n";
			echo "<td>".$tj_carga['posicion_tarjeta']."</td>\n";
			
			if ($datosnodo['proveedor_tx']=="ALCATEL")
			{
				echo "<td>".$tj_carga['subslot']."</td>\n";
				echo "<td>".$tj_carga['modulo']."</td>\n";
			}
			if ($datosnodo['proveedor_tx']=="CISCO" && ($repadm_conxadsl <> 'ASR9010' && $repadm_conxadsl <> 'ASR9006' ))
			{
				echo "<td>&nbsp</td>\n";
				echo "<td>&nbsp</td>\n";
			}
			if ($datosnodo['proveedor_tx']=="CISCO" && ($repadm_conxadsl == 'ASR9010' || $repadm_conxadsl == 'ASR9006' ))
			{
				echo "<td>&nbsp</td>\n";
				echo "<td>".$tj_carga['modulo']."</td>\n";
			}

			$pto_gestion=mysql_query("SELECT gestionada from inventario_puertos_ce where cluster='$clust' and id_nodo='$id_nodo' and  repisat='".$tj_carga['repisat']."' and posicion_tarjeta='".$tj_carga['posicion_tarjeta']."' and subslot='".$tj_carga['subslot']."' and gestionada='GESTIONADO' order by puerto");
			$ptogest=mysql_num_rows($pto_gestion);
			if($ptogest==0) echo "<td width='60px' align=center bordercolor='#CAE4FF' bgcolor='#CAE4FF' ><img src='images/erase.png' onclick='document.cluster.altatj.value=\"bajatj-$ntj-$idtj\";document.cluster.submit();'></td></tr>\n\n";
			else echo "<td width='60px' align=center bordercolor='#CAE4FF' bgcolor='#CAE4FF' >P. GEST.</td></tr>\n\n";
			$ntj++;     		
		} while ($tj_carga = mysql_fetch_array($tj_cargadas));
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
if($modelo_tarjeta == 'A9K-2X100GE-TR'){$capacidad_puerto=100;$puerto_ngb="ptos_100gb";}

if(strstr($ptogb,"G")) {$capacidad_puerto=10;$puerto_ngb="ptos_1gb";}
if($modelo_tarjeta == 'A9K-2X100GE-TR') {$capacidad_puerto=100;$puerto_ngb="ptos_100gb";}


if(strlen($uppto)>1)
{
	$upidpto=substr($uppto,strpos($uppto,"-",2)+1);
	$npto=substr($uppto,2,strpos($uppto,"-",2)-2);	
}

if (substr($uppto,0,1)=="a")
{
	if(strlen($uppto)==1)
	{
		$faltan_datospto="";
		if (trim($ptogb)=='')	$faltan_datospto.="Debe seleccionar el Puerto\\n";		
		if (trim($pto_tipo)=='')	$faltan_datospto.="Debe seleccionar el Tipo de Puerto del Puerto\\n";
		if (trim($pto_ubicacion)=='')	$faltan_datospto.="Debe seleccionar la Ubicacin del Puerto\\n";
		if (trim($pto_repisa)=='')	$faltan_datospto.="Debe seleccionar la Repisa del Puerto\\n";
		if (trim($pto_contacto)=='')	$faltan_datospto.="Debe seleccionar el Contacto del Puerto\\n";
		if (trim($tipo_bdfo_amdocs)=='')	$faltan_datospto.="Debe seleccionar el tipo de BDFO\\n";
		if (trim($tipo_dfo_amdocs)=='')	$faltan_datospto.="Debe seleccionar el tipo de DFO\\n";
		if (trim($jmp_tipo)=='')	$faltan_datospto.="Debe seleccionar el tipo de Conector del Jumper optico\\n";
		if (trim($jmp_long)=='')	$faltan_datospto.="Debe seleccionar la longitud del Jumper ptico\\n";
		if (trim($jmp_cnct)=='')	$faltan_datospto.="Debe seleccionar el tipo de Jumper ptico\\n";


		$altapto="REPLACE INTO inventario_puertos_ce (cluster, id_nodo, repisat, posicion_tarjeta, subslot, puerto, tipo_puerto, ubicacion_bdfo, repisa_bdfo, contacto_bdfo, tipo_jumper, long_jumper, tipo_conector,capacidad_puerto, fecha_alta,login,gestionada,estatus,tipo_bdfo_amdocs,tipo_dfo_amdocs) 
		VALUES ('$clust', '$id_nodo', '$repisat', '$slot','$subslot','$ptogb','$pto_tipo','$pto_ubicacion','$pto_repisa','$pto_contacto','$jmp_tipo','$jmp_long','$jmp_cnct','$capacidad_puerto',NOW(),'".$sess_usr."','NO GESTIONADO','DISPONIBLE','$tipo_bdfo_amdocs','$tipo_dfo_amdocs')";
		//echo $altapto;
	}
    /*
	echo"<br>uppto:$uppto<br>";
	$long_jorge=strlen($uppto);
	echo"<br>longitud:$long_jorge";
	$pto_jorge=$ptogb_up[$npto];
	echo"<br>pto_jorge :$pto_jorge";
	*/
	if(strlen($uppto)>1)
	{
               	$faltan_datospto="";
	        if (trim($pto_tipo_up[$npto])=='')	$faltan_datospto.="Debe seleccionar el Tipo de Puerto del Puerto\\n";
	       	if (trim($pto_ubicacion_up[$npto])=='')	$faltan_datospto.="Debe seleccionar la Ubicacin del Puerto\\n";
	        if (trim($pto_repisa_up[$npto])=='')	$faltan_datospto.="Debe seleccionar la Repisa del Puerto\\n";
	        if (trim($pto_contacto_up[$npto])=='')	$faltan_datospto.="Debe seleccionar el Contacto del Puerto\\n";
		$altapto="UPDATE inventario_puertos_ce set puerto='$ptogb_up[$npto]',tipo_puerto='$pto_tipo_up[$npto]'
						,ubicacion_bdfo='$pto_ubicacion_up[$npto]',repisa_bdfo='$pto_repisa_up[$npto]'
						,contacto_bdfo='$pto_contacto_up[$npto]',tipo_jumper='$jmp_tipo_up[$npto]',long_jumper='$jmp_long_up[$npto]'
						,tipo_conector='$jmp_cnct_up[$npto]',tipo_bdfo_amdocs='$tipo_bdfo_up[$npto]'
						,tipo_dfo_amdocs='$tipo_dfo_up[$npto]'  
				where cluster='$clust' and id='$upidpto'";		
		//echo"<br>$altapto";
	}	
		
	if ($faltan_datospto<>"")	echo "<script>alert('$faltan_datospto');</script>";
	if ($faltan_datospto=="")	mysql_query($altapto);
	$pto_tipo="";
}


if (substr($uppto,0,1)=="b")
{
	if(strlen($uppto)>1)   $bajapto="DELETE from inventario_puertos_ce where cluster='$clust' and id='$upidpto'";	
	mysql_query($bajapto);
	//echo $bajapto;
}
	
//###############################TABLA ALTA PUERTOS##############################################
	if ($verpuertos==1) $verptos="x";
	else $verptos="style='display:none'";

	
	echo "<div id='infpuertos' $verptos style='margin: 0 auto;width :950px;'>";
	echo "<table width='950' border='3' cellspacing='1' bordercolor='#999999' bgcolor='#CAE4FF'>\n";
	echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'><td colspan=14 width='221' class='Estilo49'>INFORMACION DE PUERTOS $capacidad_puerto GB</td></tr>\n\n";

	echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>\n";
	echo "<td rowspan=2 class='Estilo53'>Repisa TJ</td>\n";
	echo "<td rowspan=2 class='Estilo53'>Slot</td>\n";
	echo "<td rowspan=2 class='Estilo53'>Subslot</td>\n";
	echo "<td rowspan=2 class='Estilo53'>Puerto</td>\n";
	echo "<td rowspan=2 class='Estilo53'>Tipo Puerto</td>\n";
	echo "<td colspan=5 class='Estilo53' align=center>Remate en BDFO</td>\n";
	echo "<td colspan=3 class='Estilo53' align=center>Jumper Optico</td>\n";
	echo "<td rowspan=2 class='Estilo53'>Servicio</td>\n";
	echo "<td colspan=1 class='Estilo53'>Ocupaci&oacute;n</td>\n";
	echo "<td colspan=1 class='Estilo53'>Valor</td>\n";
	echo "<td rowspan=2 class='Estilo53'>Estatus</td>\n";
	echo "<td rowspan=2 class='Estilo53'>Gestionado</td>\n";
	echo "<td rowspan=2 class='Estilo53'>Agregar/Borrar</td></tr>\n\n";

	echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>\n";
	echo "<td class='Estilo53'>Ubicacion</td>\n";
	echo "<td class='Estilo53'>Repisa</td>\n";
	echo "<td class='Estilo53'>Contacto</td>";
	echo "<td class='Estilo53'>Tipo BDFO</td>";
	echo "<td class='Estilo53'>Tipo DFO</td>";
	echo "<td class='Estilo53'>Tipo Conector</td>\n";
	echo "<td class='Estilo53'>Longitud</td>\n";
	echo "<td class='Estilo53'>Tipo Jumper</td>\n";
	
	echo "<td class='Estilo53'>Percentil</td>";
	echo "<td class='Estilo53'>Percentil</td>";
	echo "</tr>\n";

	#echo $modelo_tarjeta."  ".$slot;


	
   #$query="SELECT $puerto_ngb from cat_tarjetas_ce where equipo like '%".substr($datosnodo['repadm_conxadsl'],0,4)."%' and modelo_tarjeta='$modelo_tarjeta' and tipo_tarjeta='$tipo_tarjeta' and slot='$slot' group by $puerto_ngb order by $puerto_ngb";


	$query="SELECT $puerto_ngb from cat_tarjetas_ce where modelo_tarjeta='$modelo_tarjeta' and tipo_tarjeta='$tipo_tarjeta' and slot='$slot' group by $puerto_ngb order by $puerto_ngb";
	
	

	$res = mysql_query($query);
	

	if(mysql_num_rows($res)>0)	$ptosvalidos=explode(",",mysql_result($res,0,0));
	else 				$ptosvalidos=array(0);

	if($modelo_tarjeta == 'ASR9000v' AND ($repadm_conxadsl == 'ASR9006' || $repadm_conxadsl == 'ASR9010')){
		#Verifica cuantos puertos troncales existen
		$cNodo    = explode('-',$id_nodo);
		$bPuertos = mysql_query("SELECT * FROM inventario_puertos_ce WHERE id_nodo = '".$id_nodo."'
		                           AND posicion_tarjeta = '$slot'
		                           AND pto_troncal LIKE '".'ASRV'.$slot.'-'.$cNodo[1]."%' ");

		
		$ptosvalidos = array();

		$numPuertos = mysql_num_rows($bPuertos);
		while($rPuertos = mysql_fetch_array($bPuertos)){

			if($rPuertos['puerto'] == '44G'){
				array_push($ptosvalidos, '0','1','2','3','4','5','6','7','8','9','10');
			}
			elseif($rPuertos['puerto'] == '45G'){
				array_push($ptosvalidos, '11','12','13','14','15','16','17','18','19','20','21');
			}
			elseif($rPuertos['puerto'] == '46G'){
				array_push($ptosvalidos, '22','23','24','25','26','27','28','29','30','31','32');
			}
			elseif($rPuertos['puerto'] == '47G') {
				array_push($ptosvalidos, '33','34','35','36','37','38','39','40','41','42','43');
			}



		}

		array_push($ptosvalidos, '44G','45G','46G','47G');

		
		
		

	}

	$pto_carga1="";
	$pto_cargados=mysql_query("SELECT * from inventario_puertos_ce where cluster='$clust' and id_nodo='$id_nodo' and  repisat='$repisat' and posicion_tarjeta='$slot' and subslot='$subslot' order by replace(puerto,'G','')+0");
    //echo"<br>SELECT * from inventario_puertos_ce where cluster='$clust' and id_nodo='$id_nodo' and  repisat='$repisat' and posicion_tarjeta='$slot' and subslot='$subslot' order by replace(puerto,'G','')+0";
	for($j=0;$j<mysql_num_rows($pto_cargados);$j++) 
	{
		$pto_carga[$j]=mysql_result($pto_cargados,$j,6);
		$pto_carga1.=$pto_carga[$j].",";
	}
	if (substr($uppto,0,1)=="a")
	{
		$pto_carga1=substr($pto_carga1,0,-1);
		mysql_query("UPDATE inventario_tarjetas_ce set $puerto_ngb='$pto_carga1' where id_nodo='$id_nodo'");
	}
	
	echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>\n";
	echo "<td class='Estilo53'>$repisat</td>\n";	
	echo "<td class='Estilo53'>$slot</td>\n";
	echo "<td class='Estilo53'>$subslot</td>\n";	

	if(substr($tipoequipo,0,3)=="af2") $refresh="onchange='document.cluster.verpuertos.value=1;document.cluster.repisat2.value=\"".$tj_carga['repisat']."\";document.cluster.modelo_tarjeta2.value=\"".$tj_carga['modelo_tarjeta']."\";document.cluster.slot2.value=\"$slot2\";document.cluster.subslot2.value=\"".$tj_carga['subslot']."\";document.cluster.tipo_tarjeta2.value=\"".$tj_carga['modulo']."\";document.cluster.submit()'";
	else $refresh='';

	echo "<td><select name='ptogb' style='width:90px;' $refresh>";
	echo "<option style='display:none' value=''></option>";

	foreach ($ptosvalidos as $pto){ 
		if($pto==$ptogb) $selptog="selected";
		else $selptog="";
		$pto1=$pto; 
		if((strstr($pto,"G")) && $modelo_tarjeta!= 'A9K-2X100GE-TR') {$pto1=str_replace("G","",$pto1)." 10G";}
		elseif($modelo_tarjeta== 'A9K-2X100GE-TR') {$pto1=$pto1." 100G";}
		elseif($modelo_tarjeta == 'ASR9000v'){
			#identificar los puertos que salen por cada conexion del satelite
		}
		
		if(!in_array($pto,$pto_carga)) echo "<option $selptog value= '".$pto."'>".$pto1."</option>";
	} 
	echo "</select></td>\n";

	$xels=$xell=$xele=$xelz=$xelt=$xelsG=$xellG=$xeleG=$xelzG=$xellr4="";
	if ($pto_tipo=="SFP 1Gige SX") $xels="selected";
	if ($pto_tipo=="SFP 1Gige LX") $xell="selected";
	if ($pto_tipo=="SFP 1Gige EX") $xele="selected";
	if ($pto_tipo=="SFP 1Gige LEX") $xelex="selected";
	if ($pto_tipo=="SFP 1Gige ZX") $xelz="selected";	
	if ($pto_tipo=="SFP 1Gige T")  $xelt="selected";	
	if ($pto_tipo=="SFP 1Gige EZX") $xelezx="selected";
	
	if ($pto_tipo=="XFP 10Gige SR") $xelsG="selected";
	if ($pto_tipo=="XFP 10Gige LR") $xellG="selected";
	if ($pto_tipo=="XFP 10Gige ER") $xeleG="selected";
	if ($pto_tipo=="XFP 10Gige ZR") $xelzG="selected";	
	if ($pto_tipo=="XFP 10Gige EZR") $xelzrG="selected";	
	if ($pto_tipo=="XFP 10Gige T")   $xeltG="selected";	
	if ($pto_tipo=="CFP 100Gige LR4")   $xellr4="selected";

	if ($pto_tipo=="SFP+ 10GBASE SR")   $xelsps="selected";
	if ($pto_tipo=="SFP+ 10GBASE LR")   $xelspl="selected";
	if ($pto_tipo=="SFP+ 10GBASE ER")   $xelspr="selected";
	if ($pto_tipo=="SFP+ 10GBASE ZR")   $xelspz="selected";
	



	
	
	echo "<td><select name='pto_tipo' title='Tipo de Puerto'>\n";
	$combotippto="<option value=' '></option>\n";
 	$combotipptoup=$combotippto;
 	
 	if ($datosnodo['proveedor_tx']=="ALCATEL")
	{

		if($capacidad_puerto==1)
		{
			$combotippto.="<option value='SFP 1Gige SX'  $xels>SFP 1Gige SX</option>\n";
			$combotippto.="<option value='SFP 1Gige LX'  $xell>SFP 1Gige LX</option>\n";
			$combotippto.="<option value='SFP 1Gige EX'  $xele>SFP 1Gige EX</option>\n";
			$combotippto.="<option value='SFP 1Gige LEX' $xelex>SFP 1Gige LEX</option>\n";
			$combotippto.="<option value='SFP 1Gige T'   $xelt>SFP 1Gige T</option>\n";
			$combotippto.="<option value='SFP 1Gige ZX'  $xelz>SFP 1Gige ZX</option>\n";
			$combotippto.="<option value='SFP 1Gige EZX' $xelezx>SFP 1Gige EZX</option>\n";
			//if(substr($tipoequipo,0,3)=="af2") echo "<option value='XFP 10Gige ER' $xeleG>XFP 10Gige ER</option>";
		}
		
		if($capacidad_puerto==10)
		{
			$combotippto.="<option value='XFP 10Gige SR'  $xelsG>XFP 10Gige SR</option>\n";
			$combotippto.="<option value='XFP 10Gige LR'  $xellG>XFP 10Gige LR</option>\n";
			$combotippto.="<option value='XFP 10Gige ER'  $xeleG>XFP 10Gige ER</option>\n";
			$combotippto.="<option value='XFP 10Gige ZR'  $xelzG>XFP 10Gige ZR</option>\n";
			$combotippto.="<option value='XFP 10Gige T'   $xeltG>XFP 10Gige T</option>\n";			
			$combotippto.="<option value='XFP 10Gige EZR' $xelzrG>XFP 10Gige EZR</option>\n";
		}
	
		$combotipptoup.="<option value='SFP 1Gige SX'  $xels>SFP 1Gige SX</option>\n";
		$combotipptoup.="<option value='SFP 1Gige LX'  $xell>SFP 1Gige LX</option>\n";
		$combotipptoup.="<option value='SFP 1Gige EX'  $xele>SFP 1Gige EX</option>\n";
		$combotipptoup.="<option value='SFP 1Gige LEX' $xelex>SFP 1Gige LEX</option>\n";
		$combotipptoup.="<option value='SFP 1Gige T'   $xelt>SFP 1Gige T</option>\n";
		$combotipptoup.="<option value='SFP 1Gige ZX'  $xelz>SFP 1Gige ZX</option>\n";
		$combotipptoup.="<option value='SFP 1Gige EZX' $xelezx>SFP 1Gige EZX</option>\n";
		
		$combotipptoup.="<option value='XFP 10Gige SR'  $xelsG>XFP 10Gige SR</option>\n";
		$combotipptoup.="<option value='XFP 10Gige LR'  $xellG>XFP 10Gige LR</option>\n";
		$combotipptoup.="<option value='XFP 10Gige ER'  $xeleG>XFP 10Gige ER</option>\n";
		$combotipptoup.="<option value='XFP 10Gige ZR'  $xelzG>XFP 10Gige ZR</option>\n";
		$combotipptoup.="<option value='XFP 10Gige T'   $xeltG>XFP 10Gige T</option>\n";			
		$combotipptoup.="<option value='XFP 10Gige EZR' $xelzrG>XFP 10Gige EZR</option>\n";


	}

	
	if ($datosnodo['proveedor_tx']=="CISCO")
	{
		//if($capacidad_puerto==1)
		if($capacidad_puerto == 100){
			$combotippto.="<option value='CFP 100Gige LR4' $xellr4>CFP 100Gige LR4</option>\n";
		}
		$combotippto.="<option value='SFP 1Gige SX' $xels>SFP 1Gige SX</option>\n";
		$combotippto.="<option value='SFP 1Gige LX' $xell>SFP 1Gige LX</option>\n";
		$combotippto.="<option value='SFP 1Gige ZX' $xelz>SFP 1Gige ZX</option>\n";
		$combotippto.="<option value='SFP 1Gige T'  $xelt>SFP 1Gige T</option>\n";
		//if($capacidad_puerto==10)
		$combotippto.="<option value='XFP 10Gige SR' $xelsG>XFP 10Gige SR</option>\n";
		$combotippto.="<option value='XFP 10Gige LR' $xellG>XFP 10Gige LR</option>\n";
		$combotippto.="<option value='XFP 10Gige ER' $xeleG>XFP 10Gige ER</option>\n";
		$combotippto.="<option value='XFP 10Gige ZR' $xelzG>XFP 10Gige ZR</option>\n";

		$combotippto.="<option value='SFP+ 10GBASE SR' $xelsps>SFP+ 10GBASE SR</option>\n";
		$combotippto.="<option value='SFP+ 10GBASE LR' $xelspl>SFP+ 10GBASE LR</option>\n";
		$combotippto.="<option value='SFP+ 10GBASE ER' $xelspr>SFP+ 10GBASE ER</option>\n";
		$combotippto.="<option value='XFP 10Gige ZR' $xelspz>SFP+ 10GBASE ZR</option>\n";

		



		$combotipptoup=$combotippto;
	}
	$combotippto.="</select></td>\n\n";
	$combotipptoup.="</select></td>\n\n";
	echo $combotippto;
	echo "<td><input name='pto_ubicacion' type='text' class='Estilo42' id='pto_ubicacion' title='Ubicacion del Puerto' size='9' onblur = 'ubicacion(this.id);'/></td>\n";
	echo "<td><input name='pto_repisa'    type='text' class='Estilo42' id='pto_repisa'    title='Repisa del Puerto'    size='9' onblur = 'rep(this.id);'/></td>\n";
	echo "<td><input name='pto_contacto'  type='text' class='Estilo42' id='pto_contacto'  title='Contacto del Puerto'  size='9' /></td>\n";

	/////COMBO TIPO_BDFO//////////////


	echo "<td><select name='tipo_bdfo_amdocs'>";
		echo "<option value=' '></option>";
	$query = "select distinct nombre_def_nodo from infinitum_unica.cat_frida_amdocs 
 			where modelo_frida ='tipo_bdfo_amdocs' 
 			AND tabla_frida='inventario_puertos_ce'";
 		$result = mysql_query($query) ;	
		$i=0;
		while ($row=mysql_fetch_row($result)) 
		{ 
		echo "<option  value='".$row[$i]."'>".$row[$i]."</option>"; 

		} 
		echo "</select>"; 
		

		 
	/////COMBO TIPO_DFO/////////
	
	echo "<td><select name='tipo_dfo_amdocs'>";
	echo "<option value=' '></option>";
	echo "<option value=' '></option>";
	$query = "select distinct nombre_def_nodo from infinitum_unica.cat_frida_amdocs 
		where modelo_frida ='tipo_dfo_amdocs' AND tabla_frida='inventario_puertos_ce' ";
	$result = mysql_query($query) ;
	$i=0;
	while ($row=mysql_fetch_row($result)){
	echo "<option value='".$row[$i]."''>".$row[$i]."</option>"; 	
	}
	echo "</select>"; 
	


	echo "<td><select name='jmp_tipo' title='Tipo de jumper Optico'>";
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

	//echo "<td><input name='jmp_tipo'  type='text' class='Estilo42' id='jmp_tipo'  title='Tipo de jumper ptico'  size='9' /></td>\n";
	//echo "<td><input name='jmp_long'  type='text' class='Estilo42' id='jmp_long'  title='Longitud del jumpero ptico'  size='9' /></td>\n";
	//echo "<td><input name='jmp_cnct'  type='text' class='Estilo42' id='jmp_cnct'  title='Tipo de conector del jumper ptico'  size='9' /></td>\n";
	
	echo "<td>&nbsp</td>";
	echo "<td>&nbsp</td>";
	echo "<td>&nbsp</td>";
	echo "<td>&nbsp</td>";
	echo "<td>&nbsp</td>";
	echo "<td width='40px' align='center'><img src='images/add.png' onclick='document.cluster.uppto.value=\"a\";document.cluster.verpuertos.value=1;document.cluster.slot2.value=\"".$slot2."\";document.cluster.submit();'></td></tr>\n\n";
	
	//##################PUERTOS CONFIGURADOS##########################
	
	echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo49'><td colspan=14><br>PUERTOS CONFIGURADOS</td></tr>";
	//echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'><td class='Estilo53'>Slot</td><td class='Estilo53'>Subslot</td><td class='Estilo53'>Puerto</td><td class='Estilo53'>Tipo Puerto</td><td class='Estilo53'>Ubicacin</td><td class='Estilo53'>Repisa</td><td class='Estilo53'>Contacto</td><td class='Estilo53'>Actualizar/Borrar</td></tr>\n\n";

	if(mysql_num_rows($pto_cargados)>0) mysql_data_seek($pto_cargados, 0);
	if ($pto_carga = mysql_fetch_array($pto_cargados)){ 
	$npto=0;	
	
		do {  
			$idpto=$pto_carga['id'];
			echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>\n";
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>".$pto_carga['repisat']."</td>\n";
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>".$pto_carga['posicion_tarjeta']."</td>\n";
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>".$pto_carga['subslot']."</td>\n";
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='ptogb_up[]'         type='text' class='Estilo48' id='ptogb_up'         size=10 value='".$pto_carga['puerto']."' readonly></td>\n";

			echo "<td><select name='pto_tipo_up[]' title='Tipo de Puerto:'>";
			$combotipptoup1=str_replace("'".$pto_carga['tipo_puerto']."'", "'".$pto_carga['tipo_puerto']."' selected", $combotipptoup);
			echo $combotipptoup1;
			
			//echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='pto_tipo_up[]'      type='text' class='Estilo48' id='pto_tipo_up'      size=15 value='".$pto_carga['tipo_puerto']."'></td>\n";
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='pto_ubicacion_up[]' type='text' class='Estilo48' id='pto_ubicacion_up' size=12 value='".$pto_carga['ubicacion_bdfo']."' onblur = 'ubicacion(this.id)'></td>\n";
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='pto_repisa_up[]'    type='text' class='Estilo48' id='pto_repisa_up'    size=10 value='".$pto_carga['repisa_bdfo']."'  onblur = 'rep(this.id)'></td>\n";
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='pto_contacto_up[]'  type='text' class='Estilo48' id='pto_contacto_up'  size=10 value='".$pto_carga['contacto_bdfo']."'></td>\n";
			//echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='tipo_bdfo_amdocs_up[]'  type='text' class='Estilo48' id='tipo_bdfo_amdocs_up'          size=10 value='".$pto_carga['tipo_bdfo_amdocs']."' readonly ></td>\n";
			//echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='tipo_dfo_amdocs_up[]'  type='text' class='Estilo48' id='tipo_dfo_amdocs_up'          size=10 value='".$pto_carga['tipo_dfo_amdocs']."' readonly ></td>\n";
			//echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='jmp_long_up[]'  type='text' class='Estilo48' id='jmp_long_up'          size=10 value='".$pto_carga['long_jumper']."' readonly ></td>\n";
			//echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='jmp_cnct_up[]'  type='text' class='Estilo48' id='jmp_cnct_up'          size=10 value='".$pto_carga['tipo_conector']."' readonly ></td>\n";									


			
			echo "<td><select name='tipo_bdfo_up[]'>";
			echo "<option value=' '></option>";
			$query = "select distinct nombre_def_nodo from infinitum_unica.cat_frida_amdocs 
 			where modelo_frida ='tipo_bdfo_amdocs' 
 			AND tabla_frida='inventario_puertos_ce'";
 			$result = mysql_query($query) ;	
				$i=0;
				while ($row=mysql_fetch_array($result)) 
				{ 
				$valBdfo=$row[$i];
			 	$selBdfo = ($valBdfo == $pto_carga['tipo_bdfo_amdocs'])? 'selected="selected"':'';
				echo "<option value= '$valBdfo' $selBdfo >$valBdfo</option>\n";	
				} 
				echo "</select></td>";
				
		 
			
			echo "<td><select name='tipo_dfo_up[]'>;";
			echo "<option value=' '></option>";
			$query = "select distinct nombre_def_nodo from infinitum_unica.cat_frida_amdocs 
			where modelo_frida ='tipo_dfo_amdocs' AND tabla_frida='inventario_puertos_ce' ";
			$result = mysql_query($query) ;
			$i=0;
			while ($row=mysql_fetch_row($result)){
				$valDfo=$row[$i];
				$selDfo=($valDfo == $pto_carga['tipo_dfo_amdocs'])?'selected="selected"':'';
				echo "<option value='$valDfo' $selDfo >$valDfo</option>\n";
			}		
			echo "</select>"; 

				

			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='jmp_tipo_up[]'  type='text' class='Estilo48' id='jmp_tipo_up'          size=10 value='".$pto_carga['tipo_jumper']."' readonly ></td>\n";


			echo "<td><select name='jmp_long_up[]' title='Longitud del jumper óptico'>";
			echo "<option value=' '></option>";
			for ($jl=0;$jl<count($jmplong);$jl++)
			{
				$valjmplong=$jmplong[$jl];
				if($pto_carga['long_jumper']==$valjmplong)	$selffup="selected";
				else $selffup="";
				echo "<option value='$valjmplong' $selffup>$valjmplong</option>\n";
			}
			echo "</select></td>\n";
			
						
			$sljmpupmu=$sljmpupmo=$sljmpuput="";
			if($pto_carga['tipo_conector']=='MULTIMODO')	$sljmpupmu="selected";
			if($pto_carga['tipo_conector']=='MONOMODO')	$sljmpupmo="selected";
			if($pto_carga['tipo_conector']=='UTP')		$sljmpuput="selected";
			
			echo "<td><select name='jmp_cnct_up[]' title='Tipo de conector del jumper ptico'>";
			echo "<option value=' '></option>";
			echo "<option value='MULTIMODO' $sljmpupmu>MULTIMODO</option>\n";
			echo "<option value='MONOMODO'  $sljmpupmo>MONOMODO</option>\n";
			echo "<option value='UTP'       $sljmpuput>UTP</option>\n";	
			echo "</select></td>\n";
			if($pto_carga['nombre_oficial_pisa']!= ''){
				echo "<td bordercolor='#CAE4FF' bgcolor = '#CAE4FF' class = 'Estilo42'><input type= 'text' name = 'serv' value ='".$pto_carga['nombre_oficial_pisa']."' size = '35px' readonly></td>";
			}
			elseif($pto_carga['pto_troncal']!='' && $pto_carga['nombre_oficial_pisa']==''){
				echo "<td bordercolor='#CAE4FF' bgcolor = '#CAE4FF' class = 'Estilo42'><input type = 'text' name = 'serv' value = '".$pto_carga['pto_troncal']."' size = '35px' readonly></td>";
			}
			elseif($pto_carga['nombre_oficial_pisa'] == '' && $pto_carga['pto_troncal']==''){
				echo "<td bordercolor='#CAE4FF' bgcolor = '#CAE4FF' class = 'Estilo42'><input type = 'text' name = 'serv' value = '' size = '35px' readonly></td>";

			}
			//---------------------Semaforos de Saturación

				$percentil = mysql_query("SELECT id,semaforo,util_perc FROM percentil 
				                             WHERE id_nodo = '$id_nodo'
				                                AND slot = '".$pto_carga['posicion_tarjeta']."'
								                AND subslot = '".$pto_carga['subslot']."'
				                                AND puerto = '".$pto_carga['puerto']."' +0
				                                AND tipo = '6'");
				
		
				
				$rowPerc   = mysql_fetch_array($percentil);
				$semaforo  = $rowPerc['semaforo'];
				$idPercent = $rowPerc['id'];
				$util_perc = $rowPerc['util_perc'];


				
				/*
					A
					R
					S
					V

				*/
					if($semaforo == 'A'){
						echo "<td width='10px' height='10px' align=center bordercolor='#CAE4FF' bgcolor='#CAE4FF' ><center><img src='images/A.png' width='20px' height='20px' alt = 'Amarillo' onclick = 'loadPopup($idPercent)'></center></td>";						
					}
					elseif($semaforo == 'R'){
					   	echo "<td width='10px' height='10px' align=center bordercolor='#CAE4FF' bgcolor='#CAE4FF' ><center><img src='images/R.png' width='20px' height='20px' alt = 'Rojo' onclick = 'loadPopup($idPercent)'></center></td>";						
	
					}
					elseif($semaforo == 'S'){
						echo "<td width='10px' height='10px'  align=center bordercolor='#CAE4FF' bgcolor='#CAE4FF' ><center><img src='images/S.png' width='20px' height='20px' alt = 'Saturado' onclick = 'loadPopup($idPercent)'></center></td>";						

					}
					elseif($semaforo == 'V'){
						echo "<td width='10px' height='10px' align=center bordercolor='#CAE4FF' bgcolor='#CAE4FF' ><center><img src='images/V.png' width='20px' height='20px' alt = 'Verde' onclick = 'loadPopup($idPercent)'></center></td>";						

					}
					else{
						echo "<td width='10px' height='10px' align=center bordercolor='#CAE4FF' bgcolor='#CAE4FF' ><center><img src='images/G.png' width='20px' height='20px' alt = 'Sin Informacion' onclick = 'loadPopup($idPercent)'></center></td>";						

					}
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>".$util_perc."</td>\n";
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>".$pto_carga['estatus']."</td>\n";
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>".$pto_carga['gestionada']."</td>\n";
	      		if ($pto_carga['gestionada'] == "NO GESTIONADO"  and ($pto_carga['estatus']=="DISPONIBLE" or $pto_carga['estatus']=="RESERVADO")) echo "<td width='60px' align=center bordercolor='#CAE4FF' bgcolor='#CAE4FF' ><img src='images/save.png' onclick='document.cluster.uppto.value=\"a-$npto-$idpto\";document.cluster.submit();'>&nbsp &nbsp<img src='images/erase.png' onclick='document.cluster.uppto.value=\"b-$npto-$idpto\";document.cluster.submit();'></td></tr>";
	      		elseif($pto_carga['gestionada'] == "NO GESTIONADO" && $pto_carga['estatus'] == 'OCUPADO' && ($repadm_conxadsl == 'ASR9010' || $repadm_conxadsl == 'ASR9006')) echo "<td width='60px' align=center bordercolor='#CAE4FF' bgcolor='#CAE4FF' ><img src='images/save.png' onclick='document.cluster.uppto.value=\"a-$npto-$idpto\";document.cluster.submit();'>&nbsp &nbsp<img src='images/erase.png' onclick='document.cluster.uppto.value=\"b-$npto-$idpto\";document.cluster.submit();'></td></tr>";
	      		else  echo "<td width='60px' align=center bordercolor='#CAE4FF' bgcolor='#CAE4FF' >&nbsp</td></tr>";
			$npto++;     		
		} while ($pto_carga = mysql_fetch_array($pto_cargados));
	} 
	echo "</table><br></div>\n\n";
}	 
?>      
  
  
  
</div>
  
  
  
  

  <?php
  
//##################################################################SECCIONES#########################################################################################
  			
  	if(substr($tipoequipo,0,1)=="e")
  	{
  		if($cambionodo==1 or $cambionodo==2)
		{ 
			if ($cambionodo==1)
			$trayectoria=1;
			$traysel=$trayectoria;
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
			$medio_tx = "";
			
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
		
  		if(substr($tipoequipo,3,1)=="a") {$origen="DISTRIBUIDOR ".substr($tipoequipo,2,1);$destino="AGREGADOR ".substr($tipoequipo,4,2);}
  		if(substr($tipoequipo,3,1)=="d") {$origen="DISTRIBUIDOR ".substr($tipoequipo,2,1);$destino="DISTRIBUIDOR ".substr($tipoequipo,4,2);}
  		if(substr($tipoequipo,3,1)=="r") {$origen="DISTRIBUIDOR ".substr($tipoequipo,2,1);$destino="RCDT ".substr($tipoequipo,4,2);}
		if(substr($tipoequipo,1,1)=="a") {$origen="AGREGADOR ".substr($tipoequipo,2,strpos($tipoequipo,"a",3)-2);$destino="AGREGADOR ".substr($tipoequipo,strpos($tipoequipo,"a",3)+1,2);}  		
  	
	  	$dorig=mysql_query("SELECT anillo,id_nodo,clli_equipo,repisa,repadm_conxadsl,proveedor_tx from cat_anillo where id='$ido'");
		$ddest=mysql_query("SELECT anillo,id_nodo,clli_equipo,repisa,repadm_conxadsl,proveedor_tx from cat_anillo where id='$idd'");
  	
		$anillo_orig=mysql_result($dorig,0,0);
		$idnodo_orig=mysql_result($dorig,0,1);
		$cllieq_orig=mysql_result($dorig,0,2);
		$repisa_orig=mysql_result($dorig,0,3);
		if (substr($tipoequipo,3,1)=="d" or substr($tipoequipo,1,1)=="d")	$repisa_orig="DIST".trim(substr($repisa_orig,-2));
		else $repisa_orig="AGR".trim(substr($repisa_orig,-2));

		
		$modelo_orig=mysql_result($dorig,0,4);
		$prov_orig=mysql_result($dorig,0,5);
		if($prov_orig=="ALCATEL") $mod_orig=substr($modelo_orig,0,4);
		if($prov_orig=="CISCO" and strlen($modelo_orig)>2)   $mod_orig=trim(substr($modelo_orig,2,3));
		if($prov_orig=="CISCO" and strlen($modelo_orig)==2)   $mod_orig=substr($modelo_orig,0,2);


		if (substr($tipoequipo,3,1)<>"r")
		{
			$anillo_dest=mysql_result($ddest,0,0);
			$idnodo_dest=mysql_result($ddest,0,1); 	 
			$cllieq_dest=mysql_result($ddest,0,2);  	
			$repisa_dest=mysql_result($ddest,0,3);
			if (substr($tipoequipo,3,1)=="d")	$repisa_dest="DIST".trim(substr($repisa_dest,-2));
			else $repisa_dest="AGR".trim(substr($repisa_dest,-2));
			$modelo_dest=mysql_result($ddest,0,4);
			$prov_dest=mysql_result($ddest,0,5);
			if($prov_dest=="ALCATEL") $mod_dest=substr($modelo_dest,0,4);
			if($prov_dest=="CISCO" and strlen($modelo_dest)>2)   $mod_dest=trim(substr($modelo_dest,2,3));
			if($prov_dest=="CISCO" and strlen($modelo_dest)==2)   $mod_dest=substr($modelo_dest,0,2);
		}

  		//echo "$anillo_orig-$idnodo_orig-$cllieq_orig-$anillo_dest-$idnodo_dest-$cllieq_dest";
  	
		$pto_troncal_d=$combo_pto_troncal_d;
		$pto_troncal_a=$combo_pto_troncal_a;
		$pto_troncal_d=str_replace(" 10G", "", $pto_troncal_d);
		$pto_troncal_a=str_replace(" 10G", "", $pto_troncal_a);
		
		$pto_troncal_d=substr($pto_troncal_d,strpos($pto_troncal_d,"--")+2);
		$pto_troncal_a=substr($pto_troncal_a,strpos($pto_troncal_a,"--")+2);
		
		if($trayectoria=="0" or $trayectoria=="") $trayectoria=1;
		
	  	$id_pto_troncal_d="al-$cllieq_dest-$repisa_dest-$mod_dest-$pto_troncal_a-".sprintf("%02s",$trayectoria);
  		$id_pto_troncal_a="al-$cllieq_orig-$repisa_orig-$mod_orig-$pto_troncal_d-".sprintf("%02s",$trayectoria);

	  	$nominter_troncal_d="$cllieq_orig-$cllieq_dest-".sprintf("%02s",$trayectoria);
  		$nominter_troncal_a="$cllieq_dest-$cllieq_orig-".sprintf("%02s",$trayectoria);

  		$desc_nominter_troncal_d="$repisa_orig-$repisa_dest-10G-".sprintf("%02s",$trayectoria);
  		$desc_nominter_troncal_a="$repisa_dest-$repisa_orig-10G-".sprintf("%02s",$trayectoria);

		if($trayectoria=="1")
		{
	  		$id_pto_troncal_d=substr($id_pto_troncal_d,0,-3);
	  		$id_pto_troncal_a=substr($id_pto_troncal_a,0,-3);

		  	$nominter_troncal_d=substr($nominter_troncal_d,0,-3);
  			$nominter_troncal_a=substr($nominter_troncal_a,0,-3);
	
	  		$desc_nominter_troncal_d=substr($desc_nominter_troncal_d,0,-3);
	  		$desc_nominter_troncal_a=substr($desc_nominter_troncal_a,0,-3);
		
		}


		if (substr($tipoequipo,1,1)=="a")
		{
		  	//$nominter_troncal_d.="-".sprintf("%02s",$trayectoria);
  			//$nominter_troncal_a.="-".sprintf("%02s",$trayectoria);

	  		//$desc_nominter_troncal_d.="-".sprintf("%02s",$trayectoria);
  			//$desc_nominter_troncal_a.="-".sprintf("%02s",$trayectoria);
		}

		if (substr($tipoequipo,3,1)=="r")
		{
			$anillo_dest="NA";
			$idnodo_dest="NA";
			$cllieq_dest="NA";
			$repisa_dest="NA";
			
			$pto_troncal_dr=$combo_pto_troncal_dr;
			$pto_troncal_dr=str_replace(" 10G", "", $pto_troncal_dr);
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

  		$consorig=substr($tipoequipo,2,strpos($tipoequipo,"a",3)-2);
  		$tiporig=strtoupper(substr($tipoequipo,1,1));
	  	if($tiporig=="A") $tiporig="AGR";
	  	if($tiporig=="D") $tiporig="DIST";
  		
	  	$consdest=substr($tipoequipo,strpos($tipoequipo,"a",3)+1);
	  	$tipdest=strtoupper(substr($tipoequipo,strpos($tipoequipo,"a",3),1));
	  	if (substr($tipoequipo,3,1)=="d")  {$tipdest="D";$consdest=substr($tipoequipo,4,1);}
	  	if (substr($tipoequipo,3,1)=="r")  {$tipdest="R";$consdest="";}
	  	if($tipdest=="A") $tipdest="AGR";
	  	if($tipdest=="D") $tipdest="DIST";
	  	if($tipdest=="R") $tipdest="RCDT";

//	  		 echo  	 	"select repisa,secciones_ce.id from cat_anillo inner join secciones_ce on cat_anillo.anillo=secciones_ce.anillo where cat_anillo.id='$ido' and (desc_nominter_troncal_d like '$tiporig$consorig-$tipdest$consdest-%' or desc_nominter_troncal_d like '$tiporig$consorig-$tipdest$consdest')  and (trayectoria='0' or trayectoria='1')";
		//if ($trayectoria=="1") 	 	$altaenl=mysql_query("select repisa,secciones_ce.id from cat_anillo inner join secciones_ce on cat_anillo.anillo=secciones_ce.anillo where cat_anillo.id='$ido' and desc_nominter_troncal_d like '$tiporig$consorig-$tipdest$consdest%' and (trayectoria='$trayectoria' or trayectoria='0')"); 
		//echo "TRAY:$trayectoria--CN:$cambionodo<br>--select repisa,secciones_ce.id from cat_anillo inner join secciones_ce on cat_anillo.anillo=secciones_ce.anillo where cat_anillo.id='$ido' and (desc_nominter_troncal_d like '$tiporig$consorig-$tipdest$consdest-%' or desc_nominter_troncal_d like '$tiporig$consorig-$tipdest$consdest')  and (trayectoria='0' or trayectoria='1')";
		if ($trayectoria=='1')
		 				{$altaenl=mysql_query("select repisa,secciones_ce.id from cat_anillo inner join secciones_ce on cat_anillo.anillo=secciones_ce.anillo where cat_anillo.id='$ido' and (desc_nominter_troncal_d like '$tiporig$consorig-$tipdest$consdest-%' or desc_nominter_troncal_d like '$tiporig$consorig-$tipdest$consdest')  and (trayectoria='0' or trayectoria='1')");}
		else
		 				{$altaenl=mysql_query("select repisa,secciones_ce.id from cat_anillo inner join secciones_ce on cat_anillo.anillo=secciones_ce.anillo where cat_anillo.id='$ido' and desc_nominter_troncal_d like '$tiporig$consorig-$tipdest$consdest-%' and trayectoria='$trayectoria'");}
//echo "$tipoequipo--$consdest--select repisa,secciones_ce.id from cat_anillo inner join secciones_ce on cat_anillo.anillo=secciones_ce.anillo where cat_anillo.id='$ido' and (desc_nominter_troncal_d like '$tiporig$consorig-$tipdest$consdest-%' or desc_nominter_troncal_d like '$tiporig$consorig-$tipdest$consdest')  and (trayectoria='0' or trayectoria='1')";
		if (mysql_num_rows($altaenl)>0 and ($cambionodo==1 or $cambionodo==2))
		{
			$idenl=mysql_result($altaenl,0,1);
			$datos_enlace=mysql_query("SELECT * from secciones_ce where id='$idenl'");
			$rowe = mysql_fetch_array($datos_enlace);
	       // echo"<br>SELECT * from secciones_ce where id='$idenl'";
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

			if($rowe['medio_tx'] != '')
				$medio_tx = $rowe['medio_tx'];
			else{
				$medio_tx = $_REQUEST['medio_tx'];
			}



			if (strlen($hostname_rcdt)>0)	$central_rcdt=substr($hostname_rcdt,4,strpos($hostname_rcdt,"_",4)-4);
			
			$ref_sisa_e=$rowe['ref_sisa_e'];
			
			if($prov_orig=="ALCATEL")	{$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/', subslot+0, '/', if(instr(puerto,'G'),CONCAT(substr(puerto,1,instr(puerto,'G')-1), ' 10G'),puerto)) ";$repslotsubpto="repisa--slot/subslot/puerto";}
			if($prov_orig=="CISCO")		{$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/', if(instr(puerto,'G'),CONCAT(substr(puerto,1,instr(puerto,'G')-1), ' 10G'),puerto)) ";$repslotsubpto="repisa--slot/puerto";}

			$qcombo_pto_troncal_d=mysql_query("SELECT $rssp as ptoorig from inventario_puertos_ce where cluster='$clust' and pto_troncal='$desc_nominter_troncal_d'");
			
//			echo "SELECT $rssp as ptoorig from inventario_puertos_ce where cluster='$clust' and pto_troncal='$desc_nominter_troncal_d'";
			if (mysql_num_rows($qcombo_pto_troncal_d)>0)	$combo_pto_troncal_d=mysql_result($qcombo_pto_troncal_d,0,0);
			$qcombo_pto_troncal_a=mysql_query("SELECT $rssp as ptodest from inventario_puertos_ce where cluster='$clust' and pto_troncal='$desc_nominter_troncal_a'");

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
				

				$prioridad_rcdt=$rowe['prioridad_rcdt'];	
				$qcombo_pto_troncal_dr=mysql_query("SELECT $rssp as ptoorig from inventario_puertos_ce where cluster='$clust' and pto_troncal='$desc_nominter_troncal_dr'");
				if (mysql_num_rows($qcombo_pto_troncal_dr)>0)	$combo_pto_troncal_dr=mysql_result($qcombo_pto_troncal_dr,0,0);
			}
		}
		
		if (trim($ip_troncal_d)=="" or substr(trim($ip_troncal_d),0,3)<>172 or trim($ip_troncal_d)=='PENDIENTE')
		{
	      
	      $tray="-".sprintf("%02s",$trayectoria);
	      $tray0=$tray;
              if($trayectoria == "1" )  $tray0="";
               //else $tray="";
			$ip_troncal_ce=mysql_query("SELECT ip_troncal_d, ip_troncal_a from ip_troncal_ce where anillo='$clust' and (desc_nominter_troncal_d='$repisa_orig-$repisa_dest$tray' or desc_nominter_troncal_d='$repisa_orig-$repisa_dest$tray0') ");
		       	                  //echo "SELECT ip_troncal_d, ip_troncal_a from ip_troncal_ce where anillo='$clust' and (desc_nominter_troncal_d='$repisa_orig-$repisa_dest$tray' or desc_nominter_troncal_d='$repisa_orig-$repisa_dest$tray0')";
			
			if (mysql_numrows($ip_troncal_ce)>0)
			{
				$ip_troncal_d=mysql_result($ip_troncal_ce,0,0);
				if (trim($ip_troncal_a)=="" or substr(trim($ip_troncal_a),0,3)<>172) $ip_troncal_a=mysql_result($ip_troncal_ce,0,1);
			}
		}
		
	}
		//		echo $ip_troncal_d;
		//echo $ip_troncal_a;

  ?>
  
  <div id="infenlace" style="margin: 0 auto;width :950px;<?=$verenl?>;">

  <table width="950" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo49" colspan=4>INFORMACION DE LA SECCI&Oacute;N</td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td width="199" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">ORIGEN</td>
      <td width="200" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42"><?=$origen?></td>
      <td width="199" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">DESTINO</td>
      <td width="200" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42"><?=$destino?></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Puerto origen Troncal (Fisico)</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">
      
<?php


	//echo "**$combo_pto_troncal_d**";
	if($prov_orig=="ALCATEL")	{$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/', subslot+0, '/', if(instr(puerto,'G'),CONCAT(substr(puerto,1,instr(puerto,'G')-1), ' 10G'),puerto)) ";$repslotsubpto="repisa--slot/subslot/puerto";}

	if($prov_orig=="CISCO")		{$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/',                 if(instr(puerto,'G'),CONCAT(substr(puerto,1,instr(puerto,'G')-1), ' 10G'),puerto)) ";$repslotsubpto="repisa--slot/puerto";}
	
	$desc_nominter_troncal_d0=$desc_nominter_troncal_d;
  	if($trayectoria=="1" and substr(substr($desc_nominter_troncal_d,-3),0,1)=="-") $desc_nominter_troncal_d0=substr($desc_nominter_troncal_d,0,-3);
  	$qpto_orig=mysql_query("SELECT $rssp as ptoorig from inventario_puertos_ce where cluster='$clust' and ((id_nodo='$idnodo_orig' and estatus='DISPONIBLE') or pto_troncal IN ('$desc_nominter_troncal_d','$desc_nominter_troncal_d0','$desc_nominter_troncal_d0-01')) order by repisat, posicion_tarjeta, subslot, puerto");

  	 //echo "SELECT $rssp as ptoorig from inventario_puertos_ce where cluster='$clust' and ((id_nodo='$idnodo_orig' and estatus='DISPONIBLE') or pto_troncal IN ('$desc_nominter_troncal_d','$desc_nominter_troncal_d0','$desc_nominter_troncal_d0-01')) order by repisat, posicion_tarjeta, subslot, puerto";	
//  if ($sess_usr=="admin") echo "SELECT $rssp as ptoorig from inventario_puertos_ce where cluster='$clust' and ((id_nodo='$idnodo_orig' and estatus='DISPONIBLE') or (pto_troncal='$desc_nominter_troncal_d' or pto_troncal='$desc_nominter_troncal_d0')) order by repisat, posicion_tarjeta, subslot, puerto";

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
			if ($sess_usr=="admin") echo "$ptoorig\n";
		}
		while ($rowpto_orig = mysql_fetch_array($qpto_orig)); 
		
		echo "</select>($repslotsubpto)";
	}	
   
echo "</td>";
?>     

       
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Puerto origen Troncal (Fisico)</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">
      
 
<?php

	//if($prov_orig=="ALCATEL" and strstr($id_pto_troncal_d,"7210"))	{$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/1/', if(instr(puerto,'G'),CONCAT(substr(puerto,1,instr(puerto,'G')-1), ' 10G'),puerto)) ";$repslotsubpto="repisa--slot/subslot/puerto";}
	$desc_nominter_troncal_a0=$desc_nominter_troncal_a;
	if($trayectoria=="1" and substr(substr($desc_nominter_troncal_a,-3),0,1)=="-") $desc_nominter_troncal_a0=substr($desc_nominter_troncal_a,0,-3);
	$qpto_dest=mysql_query("SELECT $rssp as ptodest from inventario_puertos_ce where cluster='$clust' and ((id_nodo='$idnodo_dest' and estatus='DISPONIBLE') or pto_troncal IN ('$desc_nominter_troncal_a','$desc_nominter_troncal_a0','$desc_nominter_troncal_a0-01')) order by repisat, posicion_tarjeta, subslot, puerto");
	//if ($sess_usr=="admin") echo "SELECT $rssp as ptodest from inventario_puertos_ce where cluster='$clust' and ((id_nodo='$idnodo_dest' and estatus='DISPONIBLE') or (pto_troncal='$desc_nominter_troncal_a' or pto_troncal='$desc_nominter_troncal_a0')) order by repisat, posicion_tarjeta, subslot, puerto";
	
	
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
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Identificacion del Puerto Troncal </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="id_pto_troncal_d"  readonly type="text" class="Estilo48" id="id_pto_troncal_d" title='Identificacion del Puerto Troncal' value="<?=$id_pto_troncal_d?>" size="35" /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Identificacion del Puerto Troncal</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="id_pto_troncal_a" type="text" readonly class="Estilo48" id="id_pto_troncal_a" title='Identificacion del Puerto Troncal' value="<?=$id_pto_troncal_a?>" size="35" /></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Nombre de Interfase Troncal </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="nominter_troncal_d" type="text" readonly class="Estilo48" id="nominter_troncal_d" title='Nombre de Interfase Troncal' value="<?=$nominter_troncal_d?>" size="35" /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Nombre de Interfase Troncal </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="nominter_troncal_a" type="text" readonly class="Estilo48" id="nominter_troncal_a" title='Nombre de Interfase Troncal' value="<?=$nominter_troncal_a?>" size="35" /></td>
    </tr>
	
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Descripcion de la Interfase Troncal </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="desc_nominter_troncal_d" type="text" readonly class="Estilo48" id="desc_nominter_troncal_d" title='Descripcion de la Interfase Troncal' value="<?=$desc_nominter_troncal_d?>" size="35" /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Descripcion de la Interfase Troncal </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="desc_nominter_troncal_a" type="text" readonly class="Estilo48" id="desc_nominter_troncal_a" title='Descripcion de la Interfase Troncal' value="<?=$desc_nominter_troncal_a?>" size="35" /></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">IP Interfase Troncal</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="ip_troncal_d" type="text" class="Estilo48" id="ip_troncal_d" title='IP Interfase Troncal' value="<?=$ip_troncal_d?>" size="24" readonly/></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">IP Interfase Troncal</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="ip_troncal_a" type="text" class="Estilo48" id="ip_troncal_a" title='IP Interfase Troncal'  value="<?=$ip_troncal_a?>" size="24" readonly/></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">MTU</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="mtu_d" type="text" class="Estilo48" id="mtu_d" title='MTU' value="<?=$mtu_d?>" size="24" /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">MTU</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo28"><input name="mtu_a" type="text" class="Estilo48" id="mtu_a" title='MTU' value="<?=$mtu_a?>" size="24" /></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Referencia SISA/OT</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input name="ref_sisa_e" type="text" class="Estilo48" id="ref_sisa_e" title='Referencia SISA/OT' value="<?=$ref_sisa_e?>"/></td>
	  	
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Secci&oacute;n<?php

	$nominter_troncal_ats=substr(trim($nominter_troncal_a),0,-3);

	$qtray=mysql_query("SELECT trayectoria from secciones_ce where anillo='$clust' and id_nodo_d='$idnodo_orig' and nominter_troncal_a like '$nominter_troncal_ats%' order by desc_nominter_troncal_d ");
	$ctray=mysql_num_rows($qtray);
	echo "<select name=tray onchange='document.cluster.trayectoria.value=this.value;document.cluster.cambionodo.value=2;submit();'>";

	if ($ctray>0)
	{
			$trn=0;
			for($tr=0;$tr<$ctray;$tr++)
			{
				$trv=mysql_result($qtray,$tr,0);
				$traysel="";			
				if($trv==0) $trv=1;
				if($trv==$trayectoria) {$traysel="selected";$trn=1;}
				if ($cambionodo==3)
					echo "<option value='$trv' selected $traysel>$trv</option>\n";
				else
					echo "<option value='$trv' $traysel>$trv</option>\n";
			}
			if($trn==0) echo "<option value='$trayectoria' selected>$trayectoria</option>\n";
	}
	else echo "<option value='1'>1</option>\n";
	echo "</select>\n";

	$medio = mysql_query("SELECT medio_tx from secciones_ce 
							where anillo='$clust' and id_nodo_d='$idnodo_orig' 
							and nominter_troncal_a like '$nominter_troncal_ats%'
							and trayectoria = '$trayectoria' 
							order by desc_nominter_troncal_d ");
	$resultMedio = mysql_fetch_array($medio);
	$bdMedio     = $resultMedio['medio_tx'];


if(mysql_num_rows($medio)!=0){
	if($bdMedio == 'f'){
		$fselect = "selected";
		$radio = "disabled";
		$medio_tx = 'f';
		$tipoenlace = 'f';
		echo "<script>document.cluster.medio_tx.value = '$bdMedio';</script>";
	}
	if($bdMedio == 'r'){
		$rselect = "selected";
		$radio = "disabled"; 
		$medio_tx = 'r';
		$tipoenlace = 'r';
		echo "<script>document.cluster.medio_tx.value = '$bdMedio';</script>";

	}
	if($bdMedio == 'w')$wselect = "selected";
	if($bdMedio == ''){$radio = ''; $bdMedio = $medio_tx;}
	



}
if($_REQUEST['medio_tx'] != ''){
	
	if($_REQUEST['medio_tx'] == 'f')$fselect = "selected";
	if($_REQUEST['medio_tx'] == 'r')$rselect = "selected";
	if($_REQUEST['medio_tx'] == 'w')$wselect = "selected";
	
}

if($bdMedio == '' && $_REQUEST['medio_tx'] == ''){$tipoenlace =="f";}
//echo $medio_tx;
//echo $fselect;
//echo $bdMedio;
	echo "<label>Enlace</label>";
	echo "<select name = 'medio_tx'   onchange = 'document.cluster.cambionodo.value=2;submit();'>";
	echo "<option value = '' ></option>";
	echo "<option value = 'f' $fselect $radio>Fibra</option>";
	echo "<option value = 'r' $rselect $radio>Radio</option>";
	//echo "<option value = 'w' $wselect>WDM</option>";
	echo "</selected>";
?>
 </td>
  <td class="Estilo48"><input class='Estilo57' type="button" name="nueva" id="button" value="Nueva Secci&oacute;n" onclick='document.cluster.trayectoria.value="<?=$tr+1?>";submit();'></td>	   
   </tr>
   <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td colspan=4 align=center class="Estilo48"><input class='Estilo57' type="button" name="guardar" id="button" value="Guardar Datos de la Secci&oacute;n" onclick='document.cluster.trayectoria.value=document.cluster.tray.value;document.cluster.altaseccion.value=1;document.cluster.cambionodo.value=3;submit();'></td>

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
      <td width="199" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">ORIGEN</td>
      <td width="200" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42"><?=$origen?></td>
      <td width="199" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42">DESTINO</td>
      <td width="200" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo42"><?=$destino?></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Prioridad a RCDT </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF"><span class="Estilo28">
        
	<?php
		$p1=$p2="";
		if ($prioridad_rcdt=="PRIMARIO")   {$p1="selected";$prioridad_rcdt2="SECUNDARIO";}
		if ($prioridad_rcdt=="SECUNDARIO") {$p2="selected";$prioridad_rcdt2="PRIMARIO";}
	?>
	<?php
	if(strstr($desc_nominter_troncal_dr,"DIST1"))
	{
	
	?>	
	
	
        <select name="prioridad_rcdt" class="Estilo48" title='Seleccionar la prioridad hacia RCDT' onchange="submit();">
          <option value=" "></option>
          <option value="PRIMARIO"   <?=$p1?>>PRIMARIO</option>
          <option value="SECUNDARIO" <?=$p2?>>SECUNDARIO</option>
        </select>
        

      <?php
	}
	
	else
	{
	echo "<input type=hidden name=prioridad_rcdt value='$prioridad_rcdt'>";
	echo "$prioridad_rcdt";
	
	
	}      
        ?>
        
      </span>
      </td>
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
      <td width="205" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo49">
      
	<?php
	
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
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Puerto origen Troncal (Fisico)</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">      
      
      
<?php

	if($prov_orig=="ALCATEL")	{$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/', subslot+0, '/', if(instr(puerto,'G'),CONCAT(substr(puerto,1,instr(puerto,'G')-1), ' 10G'),puerto)) ";$repslotsubpto="repisa/slot/subslot/puerto";}
	if($prov_orig=="CISCO")		{$rssp="CONCAT(repisat, '--', posicion_tarjeta+0, '/', if(instr(puerto,'G'),CONCAT(substr(puerto,1,instr(puerto,'G')-1), ' 10G'),puerto)) ";$repslotsubpto="repisa/slot/puerto";}
	$desc_nominter_troncal_dr1=substr($desc_nominter_troncal_dr,0,10);	
  	$qpto_origr=mysql_query("SELECT $rssp as ptoorigr from inventario_puertos_ce where cluster='$clust' and ((id_nodo='$idnodo_orig' and estatus='DISPONIBLE') or (pto_troncal like '$desc_nominter_troncal_dr1%')) order by repisat, posicion_tarjeta, subslot, puerto");
   	//if ($sess_usr=="admin") echo "SELECT $rssp as ptoorigr from inventario_puertos_ce where cluster='$clust' and ((id_nodo='$idnodo_orig' and estatus='DISPONIBLE') or (pto_troncal='$desc_nominter_troncal_dr1')) order by repisat, posicion_tarjeta, subslot, puerto";

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
       
      
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Puerto origen Troncal (Fisico)</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input size=35 name="pto_troncal_ar" type="text" class="Estilo48" id="pto_troncal_ar" title='Puerto origen Troncal (Fisico)' onchange='submit()' value="<?=$pto_troncal_ar?>" /></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Nombre de Interfase Troncal</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input name="nominter_troncal_dr" type="text" readonly class="Estilo48" id="nominter_troncal_dr" title='Nombre de Interfase Troncal' value="<?=$nominter_troncal_dr?>" size="35" /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Nombre de Interfase Troncal </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input name="nominter_troncal_ar" type="text" readonly class="Estilo48" id="nominter_troncal_ar" title='Nombre de Interfase Troncal' value="<?=$nominter_troncal_ar?>" size="35" /></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Descripcion de la Interfase Troncal</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input name="desc_nominter_troncal_dr" type="text" readonly class="Estilo48" id="desc_nominter_troncal_dr" title='Descripcion de la Interfase Troncal' value="<?=$desc_nominter_troncal_dr?>" size="35" /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Descripcion de la Interfase Troncal </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input name="desc_nominter_troncal_ar" type="text" readonly class="Estilo48" id="desc_nominter_troncal_ar" title='Descripcion de la Interfase Troncal' value="<?=$desc_nominter_troncal_ar?>" size="35" /></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">IP Interfase Ethernet </td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input size=35 name="ip_troncal_dr" type="text" class="Estilo48" id="ip_troncal_dr" title='IP Interfase Ethernet' value="<?=$ip_troncal_dr?>" /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">IP Interfase Gateway</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input size=35 name="ip_troncal_ar" type="text" class="Estilo48" id="ip_troncal_ar" title='IP Interfase Gateway' value="<?=$ip_troncal_ar?>" /></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><span class="Estilo48">Velocidad de Puerto Ethernet</span></td>
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
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input size=35 name="id_pto_troncal_dr" type="text" class="Estilo48" id="id_pto_troncal_dr" title='Identificacion Puerto Ethernet' value="<?=$id_pto_troncal_dr?>" readonly/></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Identificacion Puerto Ethernet</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input size=35 name="id_pto_troncal_ar" type="text" class="Estilo48" id="id_pto_troncal_ar" title='Identificacion Puerto Ethernet' value="<?=$id_pto_troncal_ar?>" readonly/></td>
    </tr>
    <tr bordercolor="#CAE4FF" bgcolor="#CAE4FF">
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">&nbsp;</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">&nbsp;</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Remate de  RCDT</td>
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
      <td class="Estilo48"><input class='Estilo57' type="button" name="guardar" id="button" value="Guardar Datos de RCDT" onclick='document.cluster.altarcdt.value=1;submit();' /></td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48">Hostname RCDT</td>
      <td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo48"><input name="hostname_rcdt" type="text" class="Estilo48" id="hostname_rcdt" title='Hostname RCDT' value="<?=$hostname_rcdt?>" readonly/></td>
    </tr>
  </table>
  <br>
</div> 




  
<!-- ###################################################FIBRA OPTICA############################################################# -->

<?php

//-------------->pruebas enlaces por radio

$selfo=$selra="";


	if($bdMedio != ''){
		if($bdMedio == "f"){$selfo="checked";$tipoenlace  = $bdMedio;$medio_tx = $bdMedio;}
		if($bdMedio == "r"){$selra="checked";$tipoenlace  = $bdMedio;$medio_tx = $bdMedio;}
		if($bdMedio == "w"){$selwd="checked";$tipoenlace  = $bdMedio;$medio_tx = $bdMedio;}
		
	}
	elseif ($medio_tx!= '') {
		    if($medio_tx == "f"){$selfo="checked";$tipoenlace = $medio_tx;$bdMedio = $medio_tx;}
			if($medio_tx == "r"){$selra="checked";$tipoenlace = $medio_tx;$bdMedio = $medio_tx;}
			if($medio_tx == "w"){$selwd="checked";$tipoenlace = $medio_tx;$bdMedio = $medio_tx;}
			
	}
	elseif($bdMedio =='' && $medio_tx == ''){
		$tipoenlace = 'f';
	}


//-------------->fin radio

if(substr($tipoequipo,1,1)=="a" || substr($tipoequipo,1,1) == "d") $nivel="f2";
else $nivel="";

if(!isset($desc_nominter_troncal_d)) $desc_nominter_troncal_d="";

if($desc_nominter_troncal_d<>"" or ($upfo<>"" and $desc_nominter_troncal_d<>""))$seccion=substr($desc_nominter_troncal_d,0,strpos($desc_nominter_troncal_d,"-",6));
if ($trayectoria=='1' or $trayectoria=='0' or $trayectoria=='')
		$tipoenl=mysql_query("SELECT tipo_enlace from fibra_optica_ce where anillo='$clust' and seccion='$seccion' and (trayectoria='0' or  trayectoria='1') group by tipo_enlace");
		else
		$tipoenl=mysql_query("SELECT tipo_enlace from fibra_optica_ce where anillo='$clust' and seccion='$seccion' and trayectoria='$trayectoria'  group by tipo_enlace");
//if($trayectoria != '0' && $trayectoria != '' ) $seccion = $seccion.'-0'.$trayectoria;
if(mysql_num_rows($tipoenl)>0) $tipoenlace=mysql_result($tipoenl,0,0);

if(strlen($upfo)>1)
{
	$upidfo=substr($upfo,strpos($upfo,"-",2)+1);
	$nfo=substr($upfo,2,strpos($upfo,"-",2)-2);	
}


if (substr($upfo,0,1)=="a")
{
	$qconsfo=mysql_query("select max(consecutivo) from fibra_optica_ce where anillo='$clust' and seccion='$seccion' and trayectoria=$trayectoria");
	if(mysql_num_rows($qconsfo)>0) $consfo=mysql_result($qconsfo,0,0)+1;
	else $consfo = 1;
	
	$faltan_datosfo="";

	if(strlen($upfo)==1)
	{
		
		if($tipoenlace=="f" and ($cable=="" or $longitud=="" or $no_fibras1=="" or $no_fibras2=="" or $central_a=="" or $piso_a=="" or $sala_a=="" or $fila_a=="" or $repisa_a=="" or $remate_a=="" or $central_b=="" or $piso_b=="" or $sala_b=="" or $fila_b=="" or $repisa_b=="" or $remate_b=="")) $faltan_datosfo="1";
		if($tipoenlace=="r" and ($cable=="" or $tip_radio=="" or $ban_radio=="" or $cap_radio=="" or $pro_radio=="" or $central_a=="" or $piso_a=="" or $sala_a=="" or $fila_a=="" or $repisa_a=="" or $central_b=="" or $piso_b=="" or $sala_b=="" or $fila_b=="" or $repisa_b=="")) $faltan_datosfo="1";		
		$sigctrla=explode("-",$central_a);
		$siglasa=$sigctrla[0];
		$centrala=$sigctrla[1];
		$sigctrlb=explode("-",$central_b);
		$siglasb=$sigctrlb[0];
		$centralb=$sigctrlb[1];
		if($tipoenlace=="f") $altafo="REPLACE INTO fibra_optica_ce (anillo,id_nodo,consecutivo,seccion,cable,longitud,central_a,siglas_a,central_b,siglas_b,no_fibras,piso_a,sala_a,fila_a,repisa_a,remate_a, piso_b,sala_b,fila_b,repisa_b,remate_b,trayectoria,tipo_enlace) values('$clust','', '$consfo', '$seccion','$cable','$longitud','$centrala', '$siglasa', '$centralb', '$siglasb','$no_fibras1,$no_fibras2','$piso_a','$sala_a','$fila_a','$repisa_a','$remate_a','$piso_b','$sala_b','$fila_b','$repisa_b','$remate_b',$trayectoria,'f')";
		if($tipoenlace=="r") $altafo="REPLACE INTO fibra_optica_ce (anillo,id_nodo,consecutivo,seccion,cable,central_a,siglas_a,central_b,siglas_b,piso_a,sala_a,fila_a,repisa_a,remate_a, piso_b,sala_b,fila_b,repisa_b,remate_b,trayectoria,tipo_enlace,tipo_radio,banda_operacion,capacidad_enlace,proteccion) values('$clust','', '$consfo', '$seccion','$cable','$centrala', '$siglasa', '$centralb', '$siglasb','$piso_a','$sala_a','$fila_a','$repisa_a','$remate_a','$piso_b','$sala_b','$fila_b','$repisa_b','$remate_b',$trayectoria,'r','$tip_radio','$ban_radio','$cap_radio','$pro_radio')";		
	}

	if(strlen($upfo)>1) //-------->Si ya existen datos
	{

		if($tipoenlace=="f" and ($cableup[$nfo]=="" or $longitudup[$nfo]=="" or $fibra1up[$nfo]=="" or $fibra2up[$nfo]=="" or $central_aup[$nfo]=="" or $piso_aup[$nfo]=="" or $sala_aup[$nfo]=="" or $fila_aup[$nfo]=="" or $repisa_aup[$nfo]=="" or $remate_aup[$nfo]=="" or $central_bup[$nfo]=="" or $piso_bup[$nfo]=="" or $sala_bup[$nfo]=="" or $fila_bup[$nfo]=="" or $repisa_bup[$nfo]=="" or $remate_bup[$nfo]=="")) $faltan_datosfo="1";
		if($tipoenlace=="r" and ($cableup[$nfo]=="" or $tip_radioup[$nfo]=="" or $ban_radioup[$nfo]=="" or $cap_radioup[$nfo]=="" or $pro_radioup[$nfo]=="" or $central_aup[$nfo]=="" or $piso_aup[$nfo]=="" or $sala_aup[$nfo]=="" or $fila_aup[$nfo]=="" or $repisa_aup[$nfo]==""  or $central_bup[$nfo]=="" or $piso_bup[$nfo]=="" or $sala_bup[$nfo]=="" or $fila_bup[$nfo]=="" or $repisa_bup[$nfo]=="")) $faltan_datosfo="1";
		$sigctrla=explode("-",$central_aup[$nfo]);
		$siglasa=$sigctrla[0];
		$centrala=$sigctrla[1];
		$sigctrlb=explode("-",$central_bup[$nfo]);
		$siglasb=$sigctrlb[0];
		$centralb=$sigctrlb[1];
		if($tipoenlace=="f") $altafo="UPDATE fibra_optica_ce set cable='$cableup[$nfo]', longitud='$longitudup[$nfo]', central_a='$centrala', siglas_a='$siglasa', central_b='$centralb', siglas_b='$siglasb', no_fibras='$fibra1up[$nfo],$fibra2up[$nfo]', piso_a='$piso_aup[$nfo]', sala_a='$sala_aup[$nfo]', fila_a='$fila_aup[$nfo]', repisa_a='$repisa_aup[$nfo]', remate_a='$remate_aup[$nfo]', piso_b='$piso_bup[$nfo]', sala_b='$sala_bup[$nfo]', fila_b='$fila_bup[$nfo]', repisa_b='$repisa_bup[$nfo]', remate_b='$remate_bup[$nfo]' where id='$upidfo'";
		if($tipoenlace=="r") $altafo="UPDATE fibra_optica_ce set cable='$cableup[$nfo]', central_a='$centrala', siglas_a='$siglasa', central_b='$centralb', siglas_b='$siglasb', piso_a='$piso_aup[$nfo]', sala_a='$sala_aup[$nfo]', fila_a='$fila_aup[$nfo]', repisa_a='$repisa_aup[$nfo]', remate_a='$remate_aup[$nfo]', piso_b='$piso_bup[$nfo]', sala_b='$sala_bup[$nfo]', fila_b='$fila_bup[$nfo]', repisa_b='$repisa_bup[$nfo]', remate_b='$remate_bup[$nfo]', tipo_radio='$tip_radioup[$nfo]', banda_operacion='$ban_radioup[$nfo]', capacidad_enlace='$cap_radioup[$nfo]', proteccion='$pro_radioup[$nfo]' where id='$upidfo'";
	}

	if(trim($faltan_datosfo)=="")
	{
		mysql_query($altafo);
		$cable=$longitud=$no_fibras1=$no_fibras2=$central_a=$piso_a=$sala_a=$fila_a=$repisa_a=$remate_a=$central_b=$piso_b=$sala_b=$fila_b=$repisa_b=$remate_b=$tip_radio=$ban_radio=$cap_radio=$pro_radio="";
		//echo $altafo;
	}
	else echo "<script>alert('Debe indicar todos los datos del enlace')</script>";
}

if (substr($upfo,0,1)=="b")
{
	if(strlen($upfo)>1)   $bajafo="DELETE from fibra_optica_ce where id='$upidfo'";	
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


//exit();
	
if($tipoenlace=="r"){$tamdiv=1300; $tituloEnlace = 'Agregar Trayecto de Radio';}
if($tipoenlace=="f"){$tamdiv=1200; $tituloEnlace = 'Agregar Trayecto de Fibra Optica';}
if($tipoenlace=="w"){$tamdiv=1200; $tituloEnlace = 'Agregar Trayecto de WDM';}


echo "<div id='infenlace' style='margin: 0 auto;width :".$tamdiv."px;$verenl;'>";

echo "<table width='1100' border='3' cellspacing='1' bordercolor='#999999' bgcolor='#CAE4FF'>";
echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>";
echo "	<td colspan='20' bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo49' colspan=1>$tituloEnlace</td>";
echo "</tr>";

if ($nivel=="f2"){



	$selfo=$selra="";

	if($bdMedio != ''){
		if($bdMedio == "f"){$selfo="checked";$tipoenlace  = $bdMedio;$medio_tx = $bdMedio;}
		if($bdMedio == "r"){$selra="checked";$tipoenlace  = $bdMedio;$medio_tx = $bdMedio;}
		if($bdMedio == "w"){$selwd="checked";$tipoenlace  = $bdMedio;$medio_tx = $bdMedio;}
		
	}
	elseif ($medio_tx!= '') {
		    if($medio_tx == "f"){$selfo="checked";$tipoenlace = $medio_tx;$bdMedio = $medio_tx;}
			if($medio_tx == "r"){$selra="checked";$tipoenlace = $medio_tx;$bdMedio = $medio_tx;}
			if($medio_tx == "w"){$selwd="checked";$tipoenlace = $medio_tx;$bdMedio = $medio_tx;}
			
	}
	elseif($bdMedio =='' && $medio_tx == ''){
		$tipoenlace = 'f';
	}
	

	$tipoenl=mysql_query("SELECT tipo_enlace from fibra_optica_ce where anillo='$clust' and seccion='$seccion' and trayectoria='$trayectoria' group by tipo_enlace");
	$radio="";
	if(mysql_num_rows($tipoenl)>0 or $bdMedio != '') $radio="disabled";
	echo "<tr>\n";
	echo "<td colspan=2><input type=radio name=tipoenlace value='f' onchange='submit();' $selfo $radio>Fibra Optica</td>\n";
	echo "<td colspan=2><input type=radio name=tipoenlace value='r' onchange='submit();' $selra $radio>Radio</td>\n";
	echo "<td colspan=2><input type=radio name=tipoenlace value='w' onchange='submit();' $selwd $radio>WDM</td>\n";	
	if ($tipoenlace=="r") echo "<td><input name='radio'  type='button' class='Estilo49' id='button' title='Opcion para cargar datos de radio' onclick=\"window.open('carga_archivos_ce?tec=ce&tipo=radio&id=$id&cluster=$clust&congelar=$congelar');\" value='Cargar Datos Radio' /></td>";
	echo "<td colspan=15>&nbsp</td>\n";
	echo "</tr>\n";
}

echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo49' style='text-align:center'>";

if ($tipoenlace=="r")
{
	echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>No</td>";
	echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Topolgico</td>";
	echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Tipo de Radio</td>";
	echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Banda Op.</td>";
	echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Cap. Enlace</td>";
	echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Proteccin (n+m)</td>";
} 

if ($tipoenlace=="f")
{
	echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>No</td>";
	echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Cable</td>";
	echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Longitud (Km)</td>";
	echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>F1</td>";
	echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>F2</td>";
}

if ($tipoenlace=="w")
{
	echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'></td>";
	echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>WDM</td>";
	echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Nodo</td>";
	echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Repisa</td>";
	echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Slot</td>";
	echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Puerto</td>";	
}  

if ($tipoenlace=="r" or $tipoenlace=="f")
{
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
}
	echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo53'>Agregar/Borrar</td>";
echo "    </tr>";
    

if ($tipoenlace=="f")
{

	echo "    <tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>";
	echo "    <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'></td>";
	echo "    <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='cable' type='text' class='Estilo48' id='cable' title='Numero de Cable' size='10' value='$cable' onchange='submit();' /></td>";
	echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='longitud' type='text' class='Estilo48' id='longitud' title='Longitud del Cable' size='10' value='$longitud' /></td>";

	//Busca las fibras que ya estan en la BD para que no se usen de nuevo
	$qfibras_bd=mysql_query("SELECT no_fibras from fibra_optica_ce where anillo='$clust' and cable='$cable' and seccion='$seccion';");
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
	
}

if ($tipoenlace=="r")
{

	$selpdh=$selsdh="";
	if($tip_radio=="HIB") $selpdh="selected";
	if($tip_radio=="ETH") $selsdh="selected";
	//if($tip_radio == "IP")$selip = "selected"
	
	echo "    <tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>";
	echo "    <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'></td>";
	echo "    <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='cable' type='text' class='Estilo48' id='cable' title='Numero de Cable' size='10' value='$cable' onchange='submit();' /></td>";
	echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>\n";
	echo "<select name='tip_radio' class='Estilo48'  style='width:80px;' title='Tipo de Radio'>\n";
	echo "<option value=''></option>";
	echo "<option value='HIB' $selpdh>HIBRIDO</option>";
	echo "<option value='ETH' $selsdh>ETHERNET</option>";
	/*echo "<option value='PDH' $selpdh>PDH</option>";
	echo "<option value='SDH' $selsdh>SDH</option>";*/
	echo "</select></td>";	
	
	echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>\n";
	echo "<select name='ban_radio' class='Estilo48'  style='width:60px;' title='Banda de Operacin' onchange='submit();'>\n";
	echo "<option value=''></option>";
	$qbanda=mysql_query("SELECT banda from radio group by banda order by banda");
	for($b=0;$b<mysql_num_rows($qbanda);$b++)
	{
		$banda=mysql_result($qbanda,$b,0);
		if($banda==$ban_radio) $selban="selected";
		else $selban="";
		echo "<option value='$banda' $selban>$banda</option>";
	}
	echo "</select></td>";	
	
	echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>\n";
	echo "<input type = 'text' name = 'cap_radio' class='Estilo48' >";
	echo "</td>";
	/*echo "<select name='cap_radio' class='Estilo48'  style='width:60px;' title='Capacidad del Enlace'>\n";
	echo "<option value=''></option>";
	$qcap=mysql_query("SELECT capacidad from radio where banda=$ban_radio group by capacidad order by capacidad");
	for($b=0;$b<mysql_num_rows($qcap);$b++)
	{
		$cap=mysql_result($qcap,$b,0);
		if($cap==$cap_radio) $selcap="selected";
		else $selcap="";
		echo "<option value='$cap' $selcap>$cap</option>";
	}
	echo "</select></td>";	*/

	echo "      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='pro_radio' type='text' class='Estilo48' id='pro_radio' title='Proteccin (n+m)'      size='6' value='$pro_radio' /></span></td>\n";

}


if ($tipoenlace=="w")
{

	echo "    <tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>";
	echo "    <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'></td>";
	echo "    <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'></td>";
	echo "    <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'></td>";
	echo "    <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'></td>";
	echo "    <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'></td>";
	echo "    <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'></td>";

}

if ($tipoenlace=="r" or $tipoenlace=="f")
{

echo "	
      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input id='input_a1' name='central_a' type='text' class='input' class='Estilo48' title='Central A'  size='15' maxlength='15' value='' readonly /></td>
      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='piso_a' type='text' class='Estilo48' id='piso_a' title='Piso'  size='6' value='$piso_a' /></td>
      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='sala_a' type='text' class='Estilo48' id='sala_a' title='Sala'  size='6' value='$sala_a' /></td>
      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='fila_a' type='text' class='Estilo48' id='fila_a' title='Fila'  size='6' value='$fila_a' /></span></td>
      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='repisa_a' type='text' class='Estilo48' id='repisa_a' title='Repisa'  size='6' value='$repisa_a' /></td>
      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='remate_a' type='text' class='Estilo48' id='remate_a' title='Remate'  size='8' value='$remate_a' /></td>
      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF'>&nbsp;</td>
      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input id='input_b1' name='central_b' type='text' class='input' class='Estilo48' title='Central B'  size='15' maxlength='15' readonly /></td>
      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='piso_b' type='text' class='Estilo48' id='piso_b' title='Piso' size='6' value='$piso_b' /></td>
      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='sala_b' type='text' class='Estilo48' id='sala_b' title='Sala' size='6' value='$sala_b' /></td>
      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='fila_b' type='text' class='Estilo48' id='fila_b' title='Fila' size='6' value='$fila_b' /></td>
      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='repisa_b' type='text' class='Estilo48' id='repisa_b' title='Repisa' size='6' value='$repisa_b' /></td>
      <td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'><input name='remate_b' type='text' class='Estilo48' id='remate_b' title='Remate' size='8' value='$remate_b' /></td>";
}     

echo "<td width='40px' align=center bordercolor='#CAE4FF' bgcolor='#CAE4FF' ><img src='images/add.png' onclick='document.cluster.upfo.value=\"a\";document.cluster.submit();'></td></tr>";

  

//################Muestra los tramos de fo cargados en la BD ###################################################################################

echo "<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo49'><td colspan=20><br>TRAYECTOS CARGADOS EN LA BD</td></tr>";
	
if ($trayectoria=='1' or $trayectoria=='0' or $trayectoria=='')
{
	$tramosfo=mysql_query("SELECT * from fibra_optica_ce where anillo='$clust' and seccion='$seccion' and (trayectoria='1' or trayectoria='0') order by consecutivo,cable");
	//echo "SELECT * from fibra_optica_ce where anillo='$clust' and seccion='$seccion' and (trayectoria='1' or trayectoria='0') order by consecutivo,cable";
}
else
{
	$tramosfo=mysql_query("SELECT * from fibra_optica_ce where anillo='$clust' and seccion like '$seccion%' and trayectoria='$trayectoria' order by consecutivo,cable");
	//echo "SELECT * from fibra_optica_ce where anillo='$clust' and seccion like '$seccion%' and trayectoria='$trayectoria' order by consecutivo,cable";
}

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
			/*if($rowfo['tipo_radio']=="PDH") $selpdhup="selected";
			if($rowfo['tipo_radio']=="SDH") $selsdhup="selected";*/
			
			if($rowfo['tipo_radio']=="HIB") $selpdhup="selected";
			if($rowfo['tipo_radio']=="ETH") $selsdhup="selected";
			
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>\n";
			echo "<select name='tip_radioup[]' class='Estilo48'  style='width:80px;' title='Tipo de Radio'>\n";
			echo "<option value=''></option>";
			/*echo "<option value='PDH' $selpdhup>PDH</option>";
			echo "<option value='SDH' $selsdhup>SDH</option>";*/
			echo "<option value='HIB' $selpdhup>HIBRIDO</option>";
			echo "<option value='ETH' $selsdhup>ETHERNET</option>";
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
			$capEnlace = $rowfo['capacidad_enlace'];
			echo "<td bordercolor='#CAE4FF' bgcolor='#CAE4FF' class='Estilo42'>\n";
			echo "<input name = 'cap_radioup[]' value = '$capEnlace' class='Estilo48'>";
			echo "</td>";
			/*echo "<select name='cap_radioup[]' class='Estilo48'  style='width:60px;' title='Capacidad del Enlace'>\n";
			echo "<option value=''></option>";
			$qcapup=mysql_query("SELECT capacidad from radio where banda=".$rowfo['banda_operacion']." group by capacidad order by capacidad");
			for($b=0;$b<mysql_num_rows($qcapup);$b++)
			{
				$capup=mysql_result($qcapup,$b,0);
				if($capup==$rowfo['capacidad_enlace']) $selcapup="selected";
				else $selcapup="";
				echo "<option value='$capup' $selcapup>$capup</option>";
			}
			echo "</select></td>";*/

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
      		echo "<td width='40px' align=center bordercolor='#CAE4FF' bgcolor='#CAE4FF' ><img src='images/save.png' onclick='document.cluster.upfo.value=\"a-$nfo-$idfo\";document.cluster.submit();'>&nbsp &nbsp<img src='images/erase.png' onclick='document.cluster.upfo.value=\"b-$nfo-$idfo\";document.cluster.submit();'></td>";
		$nfo++;     		
	} while ($rowfo = mysql_fetch_array($tramosfo)); 
	 
	}	 
 
 
 ?>   
    
  </table><br>
</div>


<!-- ###################################################IMAGEN############################################################# -->

<?php

if ($clust=="") exit; 
$qdist=mysql_query("select siglas_central,repisa,tipo_cluster,id,nodo_adm_conex_adsl from cat_anillo where anillo='$clust' and tipo_cluster='DISTRIBUIDOR'  order by repisa;");

$ldist=mysql_num_rows($qdist);

$sd1=mysql_result($qdist,0,0);
$rd1=mysql_result($qdist,0,1);
$idd1=mysql_result($qdist,0,3);
$nodod1=mysql_result($qdist,0,4);

$sd2=mysql_result($qdist,1,0);
$rd2=mysql_result($qdist,1,1);
$idd2=mysql_result($qdist,1,3);
$nodod2=mysql_result($qdist,1,4);

if($rd1=="") $rd1="NO ASIGNADO";
if($rd2=="") $rd2="NO ASIGNADO";


//*************************AGREGADORES FASE 1 ****************************************************

$qagr=mysql_query("select siglas_central,repisa,tipo_cluster,id ,nodo_adm_conex_adsl from cat_anillo where anillo='$clust' and repisa like 'AGREGADOR%' and tipo_cluster='AGREGADOR' and fase_ceth NOT LIKE '2%' order by substr(repisa,locate(' ',repisa)+1)+0;");
$lagr=mysql_num_rows($qagr);

$qagrsa=mysql_query("select siglas_central,repisa,tipo_cluster,id,nodo_adm_conex_adsl from cat_anillo where anillo='$clust' and repisa like '' and tipo_cluster='AGREGADOR' and fase_ceth NOT LIKE '2%' order by nodo_adm_conex_adsl;");
$lagrsa=mysql_num_rows($qagrsa);
$j=0;

for($i=0;$i<$lagr;$i++)
{
	$sigagr[$j]=mysql_result($qagr,$i,0);
	$repagr[$j]=mysql_result($qagr,$i,1);
	$idagr[$j]=mysql_result($qagr,$i,3);
	$nodoagr[$j]=mysql_result($qagr,$i,4);
	$j++;
} 

for($i=0;$i<$lagrsa;$i++)
{
	$sigagr[$j]=mysql_result($qagrsa,$i,0);
	$repagr[$j]=mysql_result($qagrsa,$i,1);
	$idagr[$j]=mysql_result($qagrsa,$i,3);	
	$nodoagr[$j]=mysql_result($qagrsa,$i,4);
	$j++;
} 

$cagr=count($sigagr);
$_SESSION['cagr']=$cagr;

//*************************AGREGADORES FASE 2****************************************************
$qagrf2=mysql_query("select t1.siglas_central,t1.repisa,t1.tipo_cluster,t1.id ,t1.nodo_adm_conex_adsl,t1.clli_agr2,t2.repisa,t2.id from cat_anillo as t1 inner join cat_anillo as t2 on t1.anillo=t2.anillo and t1.clli_agr2=t2.clli_equipo where t1.anillo='$clust' and t1.tipo_cluster='AGREGADOR 2' order by t1.clli_agr2,t1.repisa,t1.nodo_adm_conex_adsl");
$lagrf2=mysql_num_rows($qagrf2);

#echo "select t1.siglas_central,t1.repisa,t1.tipo_cluster,t1.id ,t1.nodo_adm_conex_adsl,t1.clli_agr2,t2.repisa,t2.id from cat_anillo as t1 inner join cat_anillo as t2 on t1.anillo=t2.anillo and t1.clli_agr2=t2.clli_equipo where t1.anillo='$clust' and t1.tipo_cluster='AGREGADOR 2' order by t1.clli_agr2,t1.repisa,t1.nodo_adm_conex_adsl";
//$qagrsaf2=mysql_query("select t1.siglas_central,t1.repisa,t1.tipo_cluster,t1.id ,t1.nodo_adm_conex_adsl,t1.clli_agr2,t2.repisa from cat_anillo as t1 inner join cat_anillo as t2 on t1.anillo=t2.anillo and t1.clli_agr2=t2.clli_equipo where t1.anillo='$clust' and t1.repisa like '' and t1.tipo_cluster='AGREGADOR 2' order by t2.clli_agr2,t2.nodo_adm_conex_adsl;");
//$lagrsaf2=mysql_num_rows($qagrsaf2);

$lagrf2t=0;
$qagrf2t=mysql_query("select max(af2) from ( select clli_agr2,count(clli_agr2) as af2 from cat_anillo where anillo='$clust' and tipo_cluster='AGREGADOR 2' group by clli_agr2) as tmp ;");
$lagrf2t=mysql_result($qagrf2t,0,0);
$j=0;
//$sigagrf2=$repagrf2=$idagrf2=$nodoagrf2=$nodof1="";

for($i=0;$i<$lagrf2;$i++)
{
	$sigagrf2[$j]=mysql_result($qagrf2,$i,0);
	$repagrf2[$j]=mysql_result($qagrf2,$i,1);
	$idagrf2[$j]=mysql_result($qagrf2,$i,3);
	$nodoagrf2[$j]=mysql_result($qagrf2,$i,4);
	$clliagf2[$j]=mysql_result($qagrf2,$i,5);
	$nodof1[$j]=trim(substr(mysql_result($qagrf2,$i,6),9));
	$idagrf1[$j]=mysql_result($qagrf2,$i,7);
	$j++;
} 

/*
for($i=0;$i<$lagrsaf2;$i++)
{
	$sigagrf2[$j]=mysql_result($qagrsaf2,$i,0);

	$repagrf2[$j]=mysql_result($qagrsaf2,$i,1);
	$idagrf2[$j]=mysql_result($qagrsaf2,$i,3);	
	$nodoagrf2[$j]=mysql_result($qagrsaf2,$i,4);
	$clliagf2[$j]=mysql_result($qagrsaf2,$i,5);	
	$nodof1[$j]=trim(substr(mysql_result($qagrsaf2,$i,6),9));
	$j++;
} 
*/

$cagrf2=$lagrf2+$lagrsaf2;
$_SESSION['cagrf2']=$cagrf2;


//******************************************************************************************************

$ruta = getcwd() . "/cluster";

$filename="$ruta/equipo_azul.png";
list($width, $height) = getimagesize($filename);

$filename="$ruta/rcdt_azul.png";
list($widthr, $heightr) = getimagesize($filename);

$anchoimg=1400;
$altoimg=800+($lagrf2t*100);
$anchod=$width*2.5;
$altod=$height*1.5;
$anchor=$widthr*1;

$altor=$heightr*1;

$xd1=$anchoimg/4;
$yd1=$altoimg*0.15;
$xd2=$anchoimg-$xd1-$anchod;
$yd1=140;
$yd2=$yd1;

$anchoa=$width;
$altoa=$height;
$xa=floor($anchoimg/($cagr+1)-$anchoa);
//$ya=$altoimg*0.7;
$ya=560;
//$def=floor(($anchoimg-$xa-$anchoa)/$cagr);
$def=floor(($anchoimg-$xa)/$cagr);

if($cagrf2>0)
{
	$anchoaf2=$width*0.7;
	$altoaf2=$height*0.7;
	$yaf2=$ya+200;
	$xaf2=$xa;
	$deff2=floor(($altoimg-$yaf2)/$cagrf2);
	$_SESSION['anchoaf2']=$anchoaf2;
	$_SESSION['altoaf2']=$altoaf2;
	$_SESSION['deff2']=$deff2;
}

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

#echo "cluster.php?muestra=1&clust=$clust&idd1=$idd1&idd2=$idd2&exportar=$exportar";
echo "<center><img src='cluster.php?muestra=1&clust=$clust&idd1=$idd1&idd2=$idd2&exportar=$exportar' usemap='#cluster'></center>\n\n";
echo "<map name='cluster'>\n";
echo "<area shape='rect' coords='0, 0, 150, 20' alt='Exportar Topolgico' title='Exportar Topolgico' OnClick='document.cluster.exportar.value=\"1\";document.cluster.id.value=\"$idd1\";document.cluster.submit();' href='#'>\n";

if ($exportar==1)
{
	echo "<script>document.cluster.exportar.value=2;document.cluster.submit();</script>";
}
if ($exportar==2)
{
	//$rutadest = getcwd() . "\\Archivos\\-ce";
	$rutadest = "G:\\archivos\\ce";
	$archivo=$clust."-TOP-FISICO.jpg";
	echo "<script>document.cluster.exportar.value=0;ex=window.open('exporta_cluster.php?archivo=$archivo','exporta');</script>";
} 


$xd11a=$xd11+15;
$xd12a=$xd12-15;
$yd12a=$yd12-15;

$xd21a=$xd21+15;
$xd22a=$xd22-15;
$yd22a=$yd22-15;

echo "<area shape='rect' coords='$xd11a, $yd11, $xd12a, $yd12a' alt='Distribuidor 1' title='Distribuidor 1' OnClick='document.cluster.tipoequipo.value=\"d1\";document.cluster.siglas.value=\"$sd1\";document.cluster.id.value=\"$idd1\";document.cluster.ido.value=\"\";document.cluster.idd.value=\"\";document.cluster.cambionodo.value=1;document.cluster.submit();' href='#'>\n";
echo "<area shape='rect' coords='$xd21a, $yd21, $xd22a, $yd22a' alt='Distribuidor 2' title='Distribuidor 2' OnClick='document.cluster.tipoequipo.value=\"d2\";document.cluster.siglas.value=\"$sd2\";document.cluster.id.value=\"$idd2\";document.cluster.ido.value=\"\";document.cluster.idd.value=\"\";document.cluster.cambionodo.value=1;document.cluster.submit();' href='#'>\n";


$xd11b=$xd12;
$yd11b=$yd11+($altod*.5)-5;
$xd12c=$xd12+10;
$yd12c=$yd11+($altod*.5)+5;
echo "<area shape='rect' coords='$xd11b, $yd11b, $xd12c, $yd12c' alt='Sección Distribuidor 1 - Distribuidor 2' title='Sección Distribuidor 1 - Distribuidor 2' OnClick='document.cluster.tipoequipo.value=\"ed1d2\";document.cluster.ido.value=\"$idd1\";document.cluster.idd.value=\"$idd2\";document.cluster.cambionodo.value=1;document.cluster.submit();' href='#'>\n";


$xd21b=$xd21-7;
$yd21b=$yd21+($altod*.5)-5;
$xd22c=$xd21+3;
$yd22c=$yd21+($altod*.5)+5;
if ($rd1<>"NO ASIGNADO" and $rd2<>"NO ASIGNADO") echo "<area shape='rect' coords='$xd21b, $yd21b, $xd22c, $yd22c' alt='Sección Distribuidor 1 - Distribuidor 2' title='Sección Distribuidor 1 - Distribuidor 2' OnClick='document.cluster.tipoequipo.value=\"ed1d2\";document.cluster.ido.value=\"$idd1\";document.cluster.idd.value=\"$idd2\";document.cluster.cambionodo.value=1;document.cluster.submit();' href='#'>\n";



$xr11a=$xr1+$anchor-5;
$yr11a=$yr1+($altor*.5)-5;
$xr12a=$xr1+$anchor+5;
$yr12a=$yr1+($altor*.5)+5;

$xr11b=$xd1-5;
$yr11b=$yd1+($altod*.5)-5;
$xr12b=$xd1+5;
$yr12b=$yd1+($altod*.5)+5;

if ($rd1<>"NO ASIGNADO") echo "<area shape='rect' coords='$xr11b, $yr11b, $xr12b, $yr12b' alt='Sección Distribuidor 1 - RCDT 1' title='Sección Distribuidor 1 - RCDT 1' OnClick='document.cluster.tipoequipo.value=\"ed1r1\";document.cluster.ido.value=\"$idd1\";document.cluster.idd.value=\"$idd1\";document.cluster.cambionodo.value=1;document.cluster.submit();' href='#'>\n";
if ($rd1<>"NO ASIGNADO") echo "<area shape='rect' coords='$xr11a, $yr11a, $xr12a, $yr12a' alt='Sección Distribuidor 1 - RCDT 1' title='Sección Distribuidor 1 - RCDT 1' OnClick='document.cluster.tipoequipo.value=\"ed1r1\";document.cluster.ido.value=\"$idd1\";document.cluster.idd.value=\"$idd1\";document.cluster.cambionodo.value=1;document.cluster.submit();' href='#'>\n";


$xr21a=$xr2-5;
$yr21a=$yr2+($altor*.5)-5;
$xr22a=$xr2+5;
$yr22a=$yr2+($altor*.5)+5;

$xr21b=$xd2+$anchod;
$yr21b=$yd2+($altod*.5)-5;
$xr22b=$xd2+$anchod+10;
$yr22b=$yd2+($altod*.5)+5;

if ($rd2<>"NO ASIGNADO") echo "<area shape='rect' coords='$xr21b, $yr21b, $xr22b, $yr22b' alt='Sección Distribuidor 2 - RCDT 2' title='Sección Distribuidor 2 - RCDT 2' OnClick='document.cluster.tipoequipo.value=\"ed2r2\";document.cluster.ido.value=\"$idd2\";document.cluster.idd.value=\"$idd1\";document.cluster.cambionodo.value=1;document.cluster.submit();' href='#'>\n";
if ($rd2<>"NO ASIGNADO") echo "<area shape='rect' coords='$xr21a, $yr21a, $xr22a, $yr22a' alt='Sección Distribuidor 2 - RCDT 2' title='Sección Distribuidor 2 - RCDT 2' OnClick='document.cluster.tipoequipo.value=\"ed2r2\";document.cluster.ido.value=\"$idd2\";document.cluster.idd.value=\"$idd1\";document.cluster.cambionodo.value=1;document.cluster.submit();' href='#'>\n";

//Agregadores fase 1
for ($a=0;$a<$cagr;$a++)
{
	
	$n=$a+1;
	$xa1=$xa+($a*$def);
	$ya1=$ya;
	$xa2=$xa1+$anchoa;
	$ya2=$ya1+$altoa;
	if ($repagr[$a]=="") $rep="NO ASIGNADO";
	else $rep=$repagr[$a];
	$_SESSION["agr$a"]="$sigagr[$a]|$rep|$xa1|$ya1|$xa2|$ya2|$nodoagr[$a]|$idagr[$a]";
	
	$ya1a=$ya1+10;
	$ya2a=$ya2+10;	
	
        echo "<area shape='rect' coords='$xa1, $ya1a, $xa2, $ya2' alt='Agregador $n' title='Agregador $n' OnClick='document.cluster.tipoequipo.value=\"a$n\";document.cluster.siglas.value=\"$sigagr[$a]\";document.cluster.id.value=\"$idagr[$a]\";document.cluster.ido.value=\"\";document.cluster.idd.value=\"\";document.cluster.cambionodo.value=1;document.cluster.submit();' href='#'>\n";

	$xed11=floor($xd1+10+($a*$anchod*0.8/($cagr+1)));
	$yed11=$yd1+$altod-5;
	$xed12=floor($xd1+15+($a*$anchod*0.8/($cagr+1)));
	$yed12=$yd1+$altod+5;

	$xed21=floor($xd2+10+($a*$anchod*0.8/($cagr+1)));
	$yed21=$yd2+$altod-5;
	$xed22=floor($xd2+15+($a*$anchod*0.8/($cagr+1)));
	$yed22=$yd2+$altod+5;

	if ($rep<>"NO ASIGNADO") echo "<area shape='rect' coords='$xed11, $yed11, $xed12, $yed12' alt='Sección Distribuidor 1 - Agregador $n' title='Sección Distribuidor 1 - Agregador $n' OnClick='document.cluster.tipoequipo.value=\"ed1a$n\";document.cluster.trayectoria.value=\"1\";document.cluster.ido.value=\"$idd1\";document.cluster.idd.value=\"$idagr[$a]\";document.cluster.cambionodo.value=1;document.cluster.submit();' href='#'>\n";
	if ($rep<>"NO ASIGNADO") echo "<area shape='rect' coords='$xed21, $yed21, $xed22, $yed22' alt='Sección Distribuidor 2 - Agregador $n' title='Sección Distribuidor 2 - Agregador $n' OnClick='document.cluster.tipoequipo.value=\"ed2a$n\";document.cluster.trayectoria.value=\"1\";document.cluster.ido.value=\"$idd2\";document.cluster.idd.value=\"$idagr[$a]\";document.cluster.cambionodo.value=1;document.cluster.submit();' href='#'>\n";

	$xea11=$xa1+($anchoa/2)-15;
	$yea11=$ya1-6;
	$xea12=$xa1+($anchoa/2)-5;
	$yea12=$ya1-1;

	$xea21=$xa1+($anchoa/2)+10;
	$yea21=$ya1-6;
	$xea22=$xa1+($anchoa/2)+20;

	$yea22=$ya1-1;

      	if ($rep<>"NO ASIGNADO") echo "<area shape='rect' coords='$xea11, $yea11, $xea12, $yea12' alt='Sección Distribuidor 1 - Agregador $n' title='Sección Distribuidor 1 - Agregador $n' OnClick='document.cluster.tipoequipo.value=\"ed1a$n\";document.cluster.trayectoria.value=\"1\";document.cluster.ido.value=\"$idd1\";document.cluster.idd.value=\"$idagr[$a]\";document.cluster.cambionodo.value=1;document.cluster.submit();' href='#'>\n";
	if ($rep<>"NO ASIGNADO") echo "<area shape='rect' coords='$xea21, $yea21, $xea22, $yea22' alt='Sección Distribuidor 2 - Agregador $n' title='Sección Distribuidor 2 - Agregador $n' OnClick='document.cluster.tipoequipo.value=\"ed2a$n\";document.cluster.trayectoria.value=\"1\";document.cluster.ido.value=\"$idd2\";document.cluster.idd.value=\"$idagr[$a]\";document.cluster.cambionodo.value=1;document.cluster.submit();' href='#'>\n";
}

//Agregadores fase 2

$nodof1[]=0;
$aa=0;

for ($a=0;$a<$cagrf2;$a++)
{

	$n=$a+1;
	$xaf21=$xa+(($nodof1[$a]-1)*$def);
	$yaf21=$yaf2+($aa*100);
	$xaf22=$xaf21+$anchoaf2;
	$yaf22=$yaf21+$altoaf2;
	
	if ($repagrf2[$a]=="") $repf2="NO ASIGNADO";
	else $repf2=$repagrf2[$a];
	$repf2a=trim(substr($repf2,-2));


	$_SESSION["agrf2$a"]="$sigagrf2[$a]|$repf2|$xaf21|$yaf21|$xaf22|$yaf22|$nodoagrf2[$a]|$idagrf2[$a]|$nodof1[$a]|$aa";
	
	$xaf21a=$xaf21+5;
	$xaf22a=$xaf22-5;
        echo "<area shape='rect' coords='$xaf21a, $yaf21, $xaf22a, $yaf22' alt='$repf2 (2o Nivel)' title='$repf2 (2o nivel)' OnClick='document.cluster.tipoequipo.value=\"af2$n\";document.cluster.siglas.value=\"$sigagrf2[$a]\";document.cluster.id.value=\"$idagrf2[$a]\";document.cluster.ido.value=\"\";document.cluster.idd.value=\"\";document.cluster.clliagrf2.value=\"$clliagf2[$a]\";document.cluster.cambionodo.value=1;document.cluster.submit();' href='#'>\n";

	$xeaf211=$xaf21-10;
	$yeaf211=$yaf21+($altoaf2/2)-5;
	$xeaf212=$xaf21;
	$yeaf212=$yaf21+($altoaf2/2)+5;

	$xeaf221=$xaf21+$anchoaf2;
	$yeaf221=$yaf21+($altoaf2/2)-5;
	$xeaf222=$xaf21+$anchoaf2+10;
	$yeaf222=$yaf21+($altoaf2/2)+5;

      	if ($repf2<>"NO ASIGNADO") echo "<area shape='rect' coords='$xeaf211, $yeaf211, $xeaf212, $yeaf212' alt='T1 AGREGADOR ".$nodof1[$a]." (F1)  - ".$repf2." (F2)' title='T1 AGREGADOR ".$nodof1[$a]." (F1)  - ".$repf2." (F2)' OnClick='document.cluster.tipoequipo.value=\"ea".$nodof1[$a]."a".$repf2a."\";document.cluster.ido.value=\"$idagrf1[$a]\";document.cluster.idd.value=\"$idagrf2[$a]\";document.cluster.trayectoria.value=\"1\";document.cluster.cambionodo.value=1;document.cluster.submit();' href='#'>\n";
	if ($repf2<>"NO ASIGNADO") echo "<area shape='rect' coords='$xeaf221, $yeaf221, $xeaf222, $yeaf222' alt='T2 AGREGADOR ".$nodof1[$a]." (F1)  - ".$repf2." (F2)' title='T2 AGREGADOR ".$nodof1[$a]." (F1)  - ".$repf2." (F2)' OnClick='document.cluster.tipoequipo.value=\"ea".$nodof1[$a]."a".$repf2a."\";document.cluster.ido.value=\"$idagrf1[$a]\";document.cluster.idd.value=\"$idagrf2[$a]\";document.cluster.trayectoria.value=\"2\";document.cluster.cambionodo.value=2;document.cluster.submit();' href='#'>\n";

	if ($nodof1[$a]<>$nodof1[$a+1]) $aa=0;
	else $aa++;

}


echo "</map>";

if ($avisocns==1) echo "<script>alert('El CLUSTER  está en proceso por CNS I.\\nNo puede ser modificado por el momento');</script>";
if ($avisocnsnodo==1) echo "<script>alert('El NODO está en proceso por CNS I.\\nNo puede ser modificado por el momento');</script>";

#print_r($_SESSION);
/*
970 $uppto=$_REQUEST['uppto'];
1801 $upfo=$_REQUEST['upfo'];
1806 	$upfo=$_REQUEST['upfo'];
*/


?>

</form>

<!-- Información de Saturación -->
<script language="javascript">
		 function loadPopup(recID){
    $("#pop").empty();
    $("#pop").load("semaforoCeth.php",{recID:recID},function(){
       $("#pop").dialog({ 
            width: 590,  
            height: 350,
            show: "scale",
            hide: "scale",
            resizable: "false",
            position: "center",
            modal: "true"
        }); 
    });
}
	
		</script>
 <!-- Semaforos de Saturación -->
<div id = 'pop'></div>

</body>
</html>

