<?php

include ("conexion.php");

/*datos requeridos:
siglas= siglas de la central ($siglas)
area= area de la central   ($area)
tipo de equipo  ($tipeq)
repisa  ($repisa) ***SOLO PARA NAMS***
*/
//**********Nombre Oficial***************************

//$s=isset($_REQUEST['siglas'])?$_REQUEST['siglas']:null;
//$a=isset($_REQUEST['area'])?$_REQUEST['area']:null;
//$t=isset($_REQUEST['tipeq'])?$_REQUEST['tipeq']:null;
//$r=isset($_REQUEST['repisa'])?$_REQUEST['repisa']:null;
//
//echo nombre_oficial_acceso($s,$a,$t,$r);

function nombre_oficial_acceso($siglas,$area,$tipeq,$repisa=null){
	if ($siglas!=null and $area!=null and $tipeq!=null){
	$tabla="";
	$tipeqport=" (equipo not like 'NAMS%') ";
	$tipeqcat=" (equipo not like 'NAM%' and equipo NOT LIKE '%TBA%') ";
	$tipeqgrid=" (tipo_equipo not like 'NAM%') ";

	if ($tipeq=="NAM-ALCATEL") {$tipeqport=" (equipo like 'NAMS-A') ";$tipeqcat=" (equipo like 'NAM-A%') ";$tipeqgrid=" (tipo_equipo like 'NAM-A%') ";}
	if ($tipeq=="NAM-LUCENT")  {$tipeqport=" (equipo like 'NAMS-L') ";$tipeqcat=" (equipo like 'NAM-L%') ";$tipeqgrid=" (tipo_equipo not like 'NAM-L%') ";}


	$qnomof.="SELECT concat('CAT-',equipo),nombre_oficial_pisa from cat_nombres_oficiales where siglas_central='$siglas' and area='$area' and $tipeqcat group by nombre_oficial_pisa ";
	$qnomof.="UNION SELECT 'GHWI',nombre_oficial_pisa from huawei_unica where siglas_central='$siglas'  and area='$area' group by nombre_oficial_pisa ";
	$qnomof.="UNION SELECT 'GISAM',nombre_oficial_pisa from isam_unica where siglas_central='$siglas'   and area='$area' group by nombre_oficial_pisa ";
	$qnomof.="UNION SELECT 'GATM',nombre_oficial_pisa from equipos_atm where siglas_central='$siglas'   and area='$area' and $tipeqgrid group by nombre_oficial_pisa ";
	$qnomof.="UNION SELECT 'GEDA',nombre_oficial_pisa from edas2530_unica where siglas_central='$siglas' and area='$area' group by nombre_oficial_pisa ";
	$qnomof.=" order by nombre_oficial_pisa";


	$nomof = mysql_query($qnomof);
	$numno = mysql_num_rows($nomof);

	$s=0;



	for ($s=0;$s<$numno;$s++)
	{
	  $tno=mysql_result($nomof,$s,0);
	  $no=mysql_result($nomof,$s,1);

	  if($tipeq<>"NAM-ALCATEL" and $tipeq<>"NAM-LUCENT") $cons[$s]=substr($no,strrpos($no,"-")+1)+1;
	  else												 $cons[$s]=substr($no,3,2);
	  
	}

	//***********Campo para Asignar nombre oficial************************

	$nom_of="";
	$repisa=sprintf("%02s",$repisa);

	if (trim($no)<>"")
	{
	  if($tipeq<>"NAM-ALCATEL" and $tipeq<>"NAM-LUCENT" and $tipeq<>"NAM-HUAWEI" and $tipeq<>"")
	  {
		rsort ($cons);
		reset($cons);
		$nom_of=substr($no,0,strrpos($no,"-")+1).$cons[0]; 
	  }
	  if($tipeq=="NAM-ALCATEL" or $tipeq=="NAM-LUCENT" or $tipeq=="NAM-HUAWEI")
	  {
		$nom_of=substr($no,0,3).$repisa.substr($no,5,5);
		$parte1=substr($no,0,3);
		
		
	  }
	}

	else
	{
		if($tipeq<>"NAM-ALCATEL" and $tipeq<>"NAM-LUCENT" and $tipeq<>"NAM-HUAWEI" and $tipeq<>"")
		{
		   $datosedo=mysql_query("SELECT edo, edificio from centrales where sigcent='$siglas' and area='$area'");
		   $edo=mysql_result($datosedo,0,0);
		   $edo=ereg_replace(" ","",$edo);
		   $ctl=mysql_result($datosedo,0,1);
		   $ctl=ereg_replace(" DE ","",$ctl);
		   $ctl=ereg_replace(" DEL ","",$ctl);
		   $ctl=ereg_replace(" LA ","",$ctl);
		   $ctl=ereg_replace(" EL ","",$ctl);
		   $ctl=ereg_replace(" LOS ","",$ctl);
		   $ctl=ereg_replace(" LAS ","",$ctl);
		   $ctl=ereg_replace("\(","",$ctl);
		   $ctl=ereg_replace("\)","",$ctl);
		   $ctl=ereg_replace(" ","",$ctl);
		   $ctl=ereg_replace("�","N",$ctl);
		  
		   if(strlen($ctl)>14) $ctl=substr($ctl,0,14);
		   if(strlen($ctl)>10 and $tipeq=="HUAWEI") $ctl=substr($ctl,0,10);
			   $nom_of=$edo."-".$ctl."-1";
		}

		if($tipeq=="NAM-ALCATEL" or $tipeq=="NAM-LUCENT" or $tipeq=="NAM-HUAWEI")
		{
		   $datossig=mysql_query("SELECT sigcent,nombre_corto_host from centrales where sigcent='$siglas' and area='$area'");
		   $sig=mysql_result($datossig,0,0);
			   $host=mysql_result($datossig,0,1);

		   if($tipeq=="NAM-ALCATEL") $sep="-";
		   if($tipeq=="NAM-LUCENT") $sep="_";
		   if($tipeq=="NAM-HUAWEI") $sep="_";

		   $nom_of=$sig.$repisa.$sep."$host";
		   $nom_of=ereg_replace(" ","",$nom_of);
		}	
	}
	return $nom_of;
	}
	else die ("PARAMETROS INVALIDOS");
}
?>