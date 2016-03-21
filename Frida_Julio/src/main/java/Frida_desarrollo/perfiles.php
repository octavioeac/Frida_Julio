<?php
include ("sesion.php");
if (trim($sess_usr)=="")
{
  session_destroy();
  echo "<script>open('http://frida2/desarrollo/infinitum_v2/index.php','_parent');</script>";
}

$perfil=$sess_npf;

// 0=Escritura y 1=Solo Lectura
$ingdd=$cns1adm=$cons=$ingcorp=$expic=$exptx=$expacc=$expins=$unin=$cns1=$cns2=$alcat=$eric=$huaw=$ingdd=$expdd=$rcdt=$prov=$valnomof=$valclli=$valclantx=$valvlanacc=$ctrlnomofg=$adva=$car=$cns1V=$csg=1;

if ($perfil=="Administrador" or $perfil=="Administrador TBA"  or $perfil=="Corporativo")	$admin=$ingcorp=$expic=$exptx=$expacc=$expins=$unin=$cns1=$cns2=$alcat=$eric=$huaw=$ingdd=$expdd=$rcdt=$prov=$valnomof=$valclli=$valclantx=$valvlanacc=$ctrlnomofg=$adva=$car=$$cns1V=$csg=$cns3adm=$cns3=$cns3tec=0;
//if ($perfil=="Ingenieria Corporativa")							$
//=0;
if ($perfil=="Explotación Corporativa Integración y Control")	$expic=0;
if ($perfil=="Explotación Corporativa Transporte")				$exptx=0;
if ($perfil=="Explotación Corporativa Acceso")		$expacc=0;
if ($perfil=="Explotacion Corporativa Instalaciones")			$expins=$ingdd=0;
if ($perfil=="Uninet")											$unin=0;
if ($perfil=="CNSI")											$cns1=0;
if ($perfil=="Tecnico cnsI")									$cns1=0;
if ($perfil=="Tecnico cnsIV")									$cns1V=0;
if ($perfil=="Tecnico csg")										$csg=0;

//if ($perfil=="CNSI adm")									    $ingdd=$cns1=$cns1adm=0;
if ($perfil=="CNSI adm")									    $cns1=$cns1adm=0;
if ($perfil=="CNSII")											$cns2=0;
if ($perfil=="Alcatel")											$alcat=0;
if ($perfil=="Ericsson")										$eric=0;
if ($perfil=="Huawei")											$huaw=0;
if ($perfil=="Ingenieria DD")							    	$ingdd=0;
if ($perfil=="Ingenieria DD adm")							   	$ingdd=$adva=0;
if ($perfil=="Explotación DD") 									$expdd=0;
if ($perfil=="RCDT") 											$rcdt=0;
if ($perfil=="Proveedor") 										$prov=0;
if ($perfil=="Valida nombre oficial") 							$valnomof=$ctrlnomofg=0;
if ($perfil=="Valida clli isam") 							    $valclli=$ctrlnomofg=0;
if ($perfil=="Valida vlan tx") 									$valclantx=0;
if ($perfil=="Valida vlan acceso") 								$valvlanacc=0;
if ($perfil=="Consulta")										$ingdd=$cons=1;
if ($perfil=="ADVA")											$adva=$ingdd=0;
if ($perfil=="CAR")												$car=0;
if ($perfil=="AdministradorME") 								$adminme=0;
if ($perfil=="TELCEL")											$telcel=0;

if ($perfil=="CM/COPE")											$cm=0;
if ($perfil=="Red Dorsal adm")									$rdadmin=$rding=$rdexp=$rdom=0;
if ($perfil=="Red Dorsal Ingenieria")							$rding=0;
if ($perfil=="Red Dorsal Explotacion")							$rdexp=0;
if ($perfil=="Red Dorsal OM")									$rdom=0;

if ($perfil=="CNSIII adm")										$cns3adm=$cns3=$cns3tec=0;
if ($perfil=="CNSIII")											$cns3=0;
if ($perfil=="Tecnico cnsIII")									$cns3tec=0;


?>
