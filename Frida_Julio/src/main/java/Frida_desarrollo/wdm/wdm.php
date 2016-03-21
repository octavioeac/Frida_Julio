<?php
include ("perfiles.php");
require("conexion.php");
//ini_set("memory_limit","550M");
$width=$_SESSION['width'];
$height=$_SESSION['height'];
$anchoimg=$_SESSION['anchoimg'];
$altoimg=$_SESSION['altoimg'];
$anchod=$_SESSION['anchod'];
$altod=$_SESSION['altod'];
$widthr=$_SESSION['widthr'];
$heightr=$_SESSION['heightr'];
$anchor=$_SESSION['anchor'];
$altor=$_SESSION['altor'];

$anchoa=$_SESSION['anchoa'];
$altoa=$_SESSION['altoa'];
$def=$_SESSION['def'];

$anchoaf2=$_SESSION['anchoaf2'];
$altoaf2=$_SESSION['altoaf2'];
$deff2=$_SESSION['deff2'];

$cwdm=$_SESSION['cwdm'];
$exportar=$_REQUEST['exportar'];


// Crear imagen	

$ruta = getcwd() . "/wdm";

putenv('GDFONTPATH=' . realpath('.'));

$equipo_azul = imagecreatefrompng("$ruta/equipo_azul.png");
$equipo_verde = imagecreatefrompng("$ruta/equipo_verde.png");
$equipo_amarillo = imagecreatefrompng("$ruta/equipo_amarillo.png");
$equipo_rojo = imagecreatefrompng("$ruta/equipo_rojo.png");
$equipo_naranja = imagecreatefrompng("$ruta/equipo_naranja.png");
$equipo_gestion = imagecreatefrompng("$ruta/equipo_gestion.png");
$nomenclatura = imagecreatefrompng("$ruta/nomeclatura_ce2.png");
$rcdt_azul = imagecreatefrompng("$ruta/rcdt_azul.png");
$rcdt_verde = imagecreatefrompng("$ruta/rcdt_verde.png");
$descargar = imagecreatefrompng("$ruta/floppy.png");
$repisa = imagecreatefrompng("$ruta/repisa.png");
$tarjeta = imagecreatefrompng("$ruta/tarjeta.png");
$puerto_gris = imagecreatefrompng("$ruta/puerto_gris.png");
$puerto_amarillo = imagecreatefrompng("$ruta/puerto_amarillo.png");
$puerto_verde = imagecreatefrompng("$ruta/puerto_verde.png");
$puerto_rojo = imagecreatefrompng("$ruta/puerto_rojo.png");
$cuadro_azul = imagecreatefrompng("$ruta/square.png");

$imgrcdt=$rcdt_azul;

$im  = imagecreatetruecolor($anchoimg,$altoimg);

// Colores
$fondo = imagecolorallocate($im, 255, 255, 200);
$color_texto = imagecolorallocate($im, 0, 0, 255);
$azul = imagecolorallocate($im, 0, 0, 255);
$negro = imagecolorallocate($im, 0, 0, 0);
$blanco = imagecolorallocate($im, 255, 255, 255);
$rojo = imagecolorallocate($im, 255, 0, 0);
$verde = imagecolorallocate($im, 0, 100, 0);
$amarillo = imagecolorallocate($im, 255, 255, 0);
$naranja = imagecolorallocate($im, 255, 140, 0);
$gris = imagecolorallocate($im, 156, 156, 156);

imagefilledrectangle($im, 0, 0, $anchoimg, $altoimg, $fondo);
imagestring($im, 3, 30, 0, "$wd" , $negro);
imagestring($im, 3, $anchoimg-120, 0, date('Y/m/d H:i'), $negro);

list($widthdes, $heightdes) = getimagesize("$ruta/floppy.png");
$anchodes=$widthdes*0.2;
$altodes=$heightdes*0.2;
if ($exportar<>1) imagecopyresampled($im, $descargar, 5, 0, 0, 0, $anchodes, $altodes, $widthdes, $heightdes);

list($widthnom, $heightnom) = getimagesize("$ruta/nomeclatura_ce2.png");
$anchonom=$widthnom*0.36;
$altonom=$heightnom*0.36;
//imagecopyresampled($im, $nomenclatura, 5, 20, 0, 0, $anchonom, $altonom, $widthnom, $heightnom);
imagecopyresampled($im, $nomenclatura, 20, 25, 0, 0, $anchonom, $altonom, $widthnom, $heightnom);


//************************NODOS********************************************
/*$sql = "SELECT clli_equipo
						FROM cat_wdm 
							WHERE wdm !='' 
								AND wdm='$wd'";*/
					


$sql = "SELECT clli_equipo, repisa FROM cat_wdm WHERE wdm !='' AND wdm='$wd' ORDER BY LENGTH(repisa),repisa";

$query = mysql_query($sql);

for ($a=0;$a<$cwdm;$a++)
{

	$colorenl=$colorl1=$colorl2=$colorlr=$azul;
	$secc1=$secc2=$fo1=$fo2=0;
	

	$datosn=explode("|",$_SESSION["wdm$a"]);
	$sa=$datosn[0];
	$ra=$datosn[1];	
	$xa=$datosn[2];
	$ya=$datosn[3];
	$na=$datosn[6];
	$ia=$datosn[7];
	$ipgestag=$datosn[8];
	$idnodoag=$datosn[9];
	$estatcnsag=$datosn[10];
	$neidwdm=$datosn[11];
	
	
	

	$x=$a+1;
	$n=$a+1;
	$nn=$a+2;
	if($a==$cwdm-1) $n=0;
	if($a==$cwdm-1) $nn=1;
	$datosnn=explode("|",$_SESSION["wdm$n"]);
	$xan=$datosnn[2];
	$ipgestn=$datosnn[8];
	$idnodoagn=$datosnn[9];

	$am=$a-1;
	if($a==0) $am=$cwdm-1;
	$nm=$a;
	if($a==0) $nm=$cwdm;
	$datosnm=explode("|",$_SESSION["wdm$am"]);
	$ipgestm=$datosnm[8];
	$idnodoagm=$datosnm[9];

	if($na<>"")	$nsa="$na ($sa)";
	else		$nsa=$sa;

	if ($ra1<>"")		$color=$verde;
	else			$color=$azul;

	$tjag=$ptag=$bwag=0;
	$qtjag=mysql_query("select count(posicion_tarjeta) from inventario_tarjetas_wdm where wdm='$wd' and id_nodo='$idnodoag' and id_nodo<>''");
	if (mysql_num_rows($qtjag)>0)	$tjag=mysql_result($qtjag,0,0);

	$qptag=mysql_query("select count(posicion_tarjeta),sum(capacidad_puerto) from inventario_puertos_wdm where wdm='$wd' and id_nodo='$idnodoag' and id_nodo<>''");
	if (mysql_num_rows($qptag)>0)	{$ptag=mysql_result($qptag,0,0);$bwag=mysql_result($qptag,0,1)+0;}
	/*
	$qptagma=mysql_query("select count(posicion_tarjeta),sum(capacidad_puerto) from inventario_puertos_wdm where wdm='$wd' and id_nodo='$idnodoagm' and wdm_destino='WDM $x'");
	if (mysql_num_rows($qptagma)>0)	$ptagma=mysql_result($qptagma,0,0);
	$qptagna=mysql_query("select count(posicion_tarjeta),sum(capacidad_puerto) from inventario_puertos_wdm where wdm='$wd' and id_nodo='$idnodoagn' and wdm_destino='WDM $x'");
	if (mysql_num_rows($qptagna)>0)	$ptagna=mysql_result($qptagna,0,0);

	$qptagam=mysql_query("select count(posicion_tarjeta),sum(capacidad_puerto) from inventario_puertos_wdm where wdm='$wd' and id_nodo='$idnodoag' and wdm_destino='WDM $nm'");
	if (mysql_num_rows($qptagam)>0)	$ptagam=mysql_result($qptagam,0,0);
	$qptagan=mysql_query("select count(posicion_tarjeta),sum(capacidad_puerto) from inventario_puertos_wdm where wdm='$wd' and id_nodo='$idnodoag' and wdm_destino='WDM $nn'");
	if (mysql_num_rows($qptagan)>0)	$ptagan=mysql_result($qptagan,0,0);
	*/

	$qptagma=mysql_query("select count(posicion_tarjeta),sum(capacidad_puerto) from inventario_puertos_wdm where wdm='$wd' and id_nodo='$idnodoagm' and wdm_destino like '%$x%'");
	if (mysql_num_rows($qptagma)>0)	$ptagma=mysql_result($qptagma,0,0);
	$qptagna=mysql_query("select count(posicion_tarjeta),sum(capacidad_puerto) from inventario_puertos_wdm where wdm='$wd' and id_nodo='$idnodoagn' and wdm_destino like '%$x%'");
	if (mysql_num_rows($qptagna)>0)	$ptagna=mysql_result($qptagna,0,0);

	$qptagam=mysql_query("select count(posicion_tarjeta),sum(capacidad_puerto) from inventario_puertos_wdm where wdm='$wd' and id_nodo='$idnodoag' and wdm_destino like '%$nm%'");
	if (mysql_num_rows($qptagam)>0)	$ptagam=mysql_result($qptagam,0,0);
	$qptagan=mysql_query("select count(posicion_tarjeta),sum(capacidad_puerto) from inventario_puertos_wdm where wdm='$wd' and id_nodo='$idnodoag' and wdm_destino like '%$nn%'");
	if (mysql_num_rows($qptagan)>0)	$ptagan=mysql_result($qptagan,0,0);

	//if($a==4) imagestring($im, 3, 10, 300, "select count(posicion_tarjeta),sum(capacidad_puerto) from inventario_puertos_wdm where wdm='$wd' and id_nodo='$idnodoag' and wdm_destino='WDM $nm'",$negro);
	
	$secc1=mysql_num_rows(mysql_query("select repisa from cat_wdm inner join secciones_wdm on cat_wdm.wdm=secciones_wdm.wdm where cat_wdm.id='$ia' and desc_nominter_troncal_d like 'WDM$nm-WDM$x%'"));
	$secc2=mysql_num_rows(mysql_query("select repisa from cat_wdm inner join secciones_wdm on cat_wdm.wdm=secciones_wdm.wdm where cat_wdm.id='$ia' and desc_nominter_troncal_d like 'WDM$x-WDM$nn%'"));

	$qdirfo1=mysql_query("select siglas_a from cat_wdm inner join fibra_optica_wdm on cat_wdm.wdm=fibra_optica_wdm.wdm where cat_wdm.id='$ida' and seccion like 'WDM$nm-WDM$x%' order by consecutivo limit 1;");
	$qdirfo2=mysql_query("select siglas_a from cat_wdm inner join fibra_optica_wdm on cat_wdm.wdm=fibra_optica_wdm.wdm where cat_wdm.id='$ida' and seccion like 'WDM$x-WDM$nn%' order by consecutivo limit 1;");

	$dirfo1=$dirfo2="";
	if(mysql_num_rows($qdirfo1)>0) $dirfo1=mysql_result($qdirfo1,0,0);
	if(mysql_num_rows($qdirfo2)>0) $dirfo2=mysql_result($qdirfo2,0,0);
		
	if($dirfo1==$sa)	{$dirf1="asc"; $inifo1=1;$finfo1=0;}
	else			{$dirf1="desc";$inifo1=0;$finfo1=1;}

	if($dirfo2==$sa)	{$dirf2="asc"; $inifo2=1;$finfo2=0;}
	else			{$dirf2="desc";$inifo2=0;$finfo2=1;}

	$datfo1=mysql_query("select seccion,siglas_a,cable from cat_wdm inner join fibra_optica_wdm on cat_wdm.wdm=fibra_optica_wdm.wdm where cat_wdm.id='$ia' and seccion like 'WDM$nm-WDM$x%' order by consecutivo $dirf1;");
	$fo1=mysql_num_rows($datfo1);

	$datfo2=mysql_query("select seccion,siglas_a,cable from cat_wdm inner join fibra_optica_wdm on cat_wdm.wdm=fibra_optica_wdm.wdm where cat_wdm.id='$ia' and seccion like 'WDM$x-WDM$nn%' order by consecutivo $dirf1;");
	$fo2=mysql_num_rows($datfo2);
	
	if ($secc1>0)	{$colorl1=$naranja;}	
	if ($secc2>0)	{$colorenl=$naranja;$colorl2=$naranja;}
	if ($fo1>0)	{$colorl1=$verde;}
	if ($fo2>0)	{$colorenl=$verde;$colorl2=$verde;}


	if(trim($ipgestag)=="")								$imgag=$equipo_azul;
	if(trim($ipgestag)<>"")								$imgag=$equipo_amarillo;
	if(trim($neidwdm)<>"")								$imgag=$equipo_amarillo;
	if(trim($ipgestag)<>"" and trim($tjag)>0)			$imgag=$equipo_naranja;
	if(trim($tjag)>0 and trim($ptag)>0)	$imgag=$equipo_verde; //trim($ipgestag)<>"" and 
	if(trim($estatcnsag=="GESTIONADO"))				$imgag=$equipo_gestion;
	if(trim($estatcnsag=="RECHAZADO"))				$imgag=$equipo_rojo;

	/*****************************************************************/
	$cllis[] =  mysql_result($query,$a,0);
	$caracter = '-';
	$posicion[] = strpos($cllis[$a], $caracter);
	$suma = 0;
	if($posicion[$a]){
		$buscaRepetido[$a] = substr($cllis[$a], 0, $posicion[$a]);

		//$data['clli_repetido'][$i] = $cllis[$i];

		$repetido = "SELECT wdm FROM cat_wdm WHERE clli_equipo like '%".$buscaRepetido[$a]."%'";
		$queryRepetido = mysql_query($repetido);

		$rowsRepetido = mysql_num_rows($queryRepetido);

		for ($y=0; $y<$rowsRepetido; $y++){
			imagecopyresampled($im, $cuadro_azul, $xa+$suma, $ya-25, 0, 0, 10, 10, 7, 7);
			$suma+=13;
		}
	}	

	imagecopyresampled($im, $imgag, $xa, $ya, 0, 0, $anchoa, $altoa, $width, $height);							//Equipos agregadores
	imagestring($im, 3, ($xa+2), $ya+($altoa*1.2), "$nsa", $negro);										//Siglas agregadores
	imagestring($im, 3, ($xa+2), $ya+($altoa*1.6), "$ra", $negro);									//Repisa agregadores
	imagestring($im, 3, ($xa+2), $ya+($altoa*2.0), "T:$tjag P:$ptag BW:$bwag", $negro);							//Datos agregadores	
	
	$enlr=mysql_num_rows(mysql_query("select repisa from cat_wdm inner join secciones_wdm on cat_wdm.wdm=secciones_wdm.wdm where cat_wdm.id='$ia' and desc_nominter_troncal_d like 'WDM$n-RCDT%';"));
	if(trim($ipgestag)<>"" and trim($tjag)>0 and trim($ptag)>0)
	{
		if ($enlr>0) $colorlr=$verde;
		imagefilledrectangle($im,  $xa-5+($anchoa/2), $ya-5, $xa+5+($anchoa/2), $ya+5, $colorlr);						//Cuadro de link del WDM a RCDT
		imagesetthickness($im, 1);
		if ($enlr>0) imageline($im, $xa+($anchoa/2), $ya-25, $xa+($anchoa/2), $ya-5, $verde);
		imagestring($im, 3, $xa-10+($anchoa/2), $ya-40, "RCDT", $azul);
	}
	
	imagesetthickness($im, 2);
	if(trim($ipgestag)<>"" and trim($ptagma)>0 and trim($ptagam)>0 and $ipgestm<>"")	imagefilledrectangle($im,  $xa, $ya+($altoa/2)-5, $xa-7, $ya+($altoa/2)+5, $colorl1);					//Cuadro de link del WDM N al WDM N1
	if(trim($ipgestag)<>"" and trim($ptagan)>0 and trim($ptagna)>0 and $ipgestn<>"")	imagefilledrectangle($im,  $xa+$anchoa+1, $ya+($altoa/2)-5, $xa+$anchoa+8, $ya+($altoa/2)+5, $colorl2);			//Cuadro de link del WDM N a WDM N1
	if($secc2>0 and $a<$cwdm-1)	imageline($im, $xa+$anchoa+9, $ya+($altoa/2), $xan, $ya+($altoa/2), $colorenl);														//Linea de seccion entre WDM N y WDM N1
	if($fo2>0)    imagestring($im, 3, $xa+$anchoa+3, $ya+($altoa/2)-20, "$fo2", $negro);															//Cantidad de tramos de fo
			
}




//**********************DIBUJA LAS REPISAS*****************************

if(substr($tipoequipo,0,1)=="a")
{

	$rep=substr($tipoequipo,-1)-1;
	$datosn=explode("|",$_SESSION["wdm$rep"]);
	$idnodoag=$datosn[9];

	list($widthrep, $heightrep) = getimagesize("$ruta/repisa.png");
	$anchorep=$widthrep*0.7;
	$altorep=$heightrep*0.7;
	
	
	$qrepisas=mysql_query("select repisat from inventario_tarjetas_wdm where wdm='$wd' and id_nodo='$idnodoag' and id_nodo<>'' group by repisat order by repisat");
	$numrep=mysql_num_rows($qrepisas);
	
	for($r==0;$r<$numrep;$r++)
	{
	
		if($r==0)
		{
			$xrepisa=($anchoimg/4)-($anchorep/2);
			$yrepisa=320;
		}
		if($r==1)
		{
			$xrepisa=($anchoimg-$anchorep-35);
			$yrepisa=320;
		}
		if($r==2)
		{
			$xrepisa=($anchoimg/4)-($anchorep/2);
			$yrepisa=620;
		}
		if($r==3)
		{
			$xrepisa=($anchoimg-$anchorep-35);
			$yrepisa=620;
		}
		
		$tjag=$ptag=$bwag=0;
		$nrepisa=$r+1;
		$nrepisa="0".$nrepisa;
		
		imagestring($im, 3, $xrepisa, $yrepisa-12, "Repisa $nrepisa", $negro);
		imagecopyresampled($im, $repisa, $xrepisa, $yrepisa, 0, 0, $anchorep, $altorep, $widthrep, $heightrep);
	

				
		$qtjag=mysql_query("select modelo_tarjeta,repisat,posicion_tarjeta from inventario_tarjetas_wdm where wdm='$wd' and id_nodo='$idnodoag' and id_nodo<>'' and repisat='$nrepisa' order by repisat,posicion_tarjeta");
		$numtar=mysql_num_rows($qtjag);
	
		for($t=0;$t<$numtar;$t++)
		{
			$mod=mysql_result($qtjag,$t,0);
			$repisat=mysql_result($qtjag,$t,1);
			$slot=mysql_result($qtjag,$t,2);		
			list($widthtar, $heighttar) = getimagesize("$ruta/tarjeta.png");	
			$anchotar=$widthtar*0.233;
			$altotar=$heighttar*0.215;
			$xtjn=$xrepisa+103;
			$xtjp=$xrepisa+106+$anchotar;
			if($slot==1) {$xtj=$xtjn;$ytj=$yrepisa+$altorep-($altotar*1)-7;}
			if($slot==2) {$xtj=$xtjp;$ytj=$yrepisa+$altorep-($altotar*1)-7;}
			if($slot==3) {$xtj=$xtjn;$ytj=$yrepisa+$altorep-($altotar*2)-7;}
			if($slot==4) {$xtj=$xtjp;$ytj=$yrepisa+$altorep-($altotar*2)-7;}
			if($slot==5) {$xtj=$xtjn;$ytj=$yrepisa+$altorep-($altotar*3)-7;}
			if($slot==6) {$xtj=$xtjp;$ytj=$yrepisa+$altorep-($altotar*3)-7;}
			if($slot==7) {$xtj=$xtjn;$ytj=$yrepisa+$altorep-($altotar*4)-7;}
			if($slot==8) {$xtj=$xtjp;$ytj=$yrepisa+$altorep-($altotar*4)-7;}
			imagecopyresampled($im, $tarjeta, $xtj, $ytj, 0, 0, $anchotar, $altotar, $widthtar, $heighttar);
			imagettftext($im, 10, 90, $xtj+27, $ytj+$altotar-12, $negro, 'arial.ttf', "$mod");
			
			
			$qpto=mysql_query("select puertos from cat_tarjetas_wdm where modelo_tarjeta='$mod' and equipo='OptiX OSN1800II'");
			$ptos=explode(",",mysql_result($qpto,0,0));
			$numpto=count($ptos);		

			$qptoc=mysql_query("select puerto,gestionada from inventario_puertos_wdm where wdm='$wd' and id_nodo='$idnodoag' and id_nodo<>'' and repisat='$repisat' and posicion_tarjeta='$slot'");
			$puertosc=array('','','','','','','','','','');
			$gestionc=array('','','','','','','','','','');
			for($p=0;$p<mysql_num_rows($qptoc);$p++) {$puertosc[$p]=mysql_result($qptoc,$p,0);$gestionc[$p]=mysql_result($qptoc,$p,1);}
			
			for($p=0;$p<$numpto;$p++)
			{
				$puert=$ptos[$p];
				$puer=substr($puert,0,-1);
				list($widthpto, $heightpto) = getimagesize("$ruta/puerto_gris.png");	
				$anchopto=$widthpto*0.2;
				$altopto=$heightpto*0.2;
				
				if(substr($puert,-1)=="C") $xpt=$xtj+20+($puer*160/$numpto);
				if(substr($puert,-1)=="L") $xpt=$xtj+$anchotar-105+($puer*30);
				if(substr($puert,-1)=="A") $xpt=$xtj+20+(1*160/5);
	
				if(in_array($puert,$puertosc))
				{
					$puerto=$puerto_amarillo;
					$gestion=$gestionc[array_search("$puert", $puertosc)];
				}
				else $puerto=$puerto_gris;
				if($gestion=="GESTIONADO") $puerto=$puerto_verde;
				if($gestion=="RECHAZADO")  $puerto=$puerto_rojo;

				imagecopyresampled($im, $puerto, $xpt, $ytj+($altotar/4), 0, 0, $anchopto, $altopto, $widthpto, $heightpto);
				imagestring($im, 3, $xpt, $ytj+($altotar/4)-12, "$puert", $negro);
			}
		}
	}
}

/*
//**************DIBUJA LA MATRIZ DE FRECUENCIAS************************
if(substr($tipoequipo,0,2)=="ed")
{
	
	$tecnologia=mysql_result(mysql_query("SELECT tecnologia from cat_wdm where wdm='$wd'"),0,0);
	$lamq=mysql_query("SELECT frecuencia from lambda where tipo='$tecnologia' and frecuencia>=(select min(frecuencia) from inventario_puertos_wdm where wdm='$wd' and puerto like '_C' and frecuencia>0 order by frecuencia) and frecuencia<=(select max(frecuencia) from inventario_puertos_wdm where wdm='$wd' and puerto like '_C' and frecuencia>0 order by frecuencia)");	
	$clam=mysql_num_rows($lamq);
//imagestring($im, 3, 100, 400, $tecnologia, $colorft);		



	//$frecorig=mysql_query("select concat(substr(desc_nominter_troncal_d,4,1),'-',frecuencia) as t,pto_troncal_d,frecuencia,lambda,tarjeta_cliente,id_nodo_d from secciones_wdm inner join inventario_puertos_wdm on secciones_wdm.wdm=inventario_puertos_wdm.wdm and secciones_wdm.id_nodo_d=inventario_puertos_wdm.id_nodo  where secciones_wdm.wdm='$wd' and substr(secciones_wdm.pto_troncal_d,1,2)=inventario_puertos_wdm.repisat and substr(secciones_wdm.pto_troncal_d,4,1)=inventario_puertos_wdm.posicion_tarjeta and puerto like '%C' order by desc_nominter_troncal_d");
	//$cfreco=mysql_num_rows($frecorig);
	//$frecdest=mysql_query("select concat(substr(desc_nominter_troncal_a,4,1),'-',frecuencia) as t,pto_troncal_a,frecuencia,lambda,tarjeta_cliente,id_nodo_a from secciones_wdm inner join inventario_puertos_wdm on secciones_wdm.wdm=inventario_puertos_wdm.wdm and secciones_wdm.id_nodo_a=inventario_puertos_wdm.id_nodo  where secciones_wdm.wdm='$wd' and substr(secciones_wdm.pto_troncal_a,1,2)=inventario_puertos_wdm.repisat and substr(secciones_wdm.pto_troncal_a,4,1)=inventario_puertos_wdm.posicion_tarjeta and puerto like '%C' order by desc_nominter_troncal_a");
	//$cfrecd=mysql_num_rows($frecdest);

	$frecorig=mysql_query("select concat(substr(t1.pto_troncal,4,1),'-',t2.frecuencia) as t,concat(t2.repisat,'/',t2.posicion_tarjeta,'/',t2.puerto) as pto, substr(t1.pto_troncal,9,1) as dest, t2.tarjeta_cliente as tjc, t2.id_nodo as idnd from inventario_puertos_wdm as t1 inner join inventario_puertos_wdm as t2 on t1.id_nodo=t2.id_nodo and t1.repisat=t2.repisat and t1.posicion_tarjeta=t2.posicion_tarjeta where t1.wdm='$wd' and t1.tipo_puerto='N/A()' and t1.puerto like '%L' and t2.puerto like '%C' and substr(t1.pto_troncal,4,1)<substr(t1.pto_troncal,9,1) order by t1.pto_troncal");
	$cfreco=mysql_num_rows($frecorig);

	$frecdest=mysql_query("select concat(substr(t1.pto_troncal,4,1),'-',t2.frecuencia) as t,concat(t2.repisat,'/',t2.posicion_tarjeta,'/',t2.puerto) as pto, substr(t1.pto_troncal,9,1) as dest, t2.tarjeta_cliente as tjc, t2.id_nodo as idnd from inventario_puertos_wdm as t1 inner join inventario_puertos_wdm as t2 on t1.id_nodo=t2.id_nodo and t1.repisat=t2.repisat and t1.posicion_tarjeta=t2.posicion_tarjeta where t1.wdm='$wd' and t1.tipo_puerto='N/A()' and t1.puerto like '%L' and t2.puerto like '%C' and substr(t1.pto_troncal,4,1)>substr(t1.pto_troncal,9,1) order by t1.pto_troncal");
	$cfrecd=mysql_num_rows($frecdest);


	for($f=0;$f<$cfreco;$f++) $fro[]=mysql_result($frecorig,$f,0);
	for($f=0;$f<$cfrecd;$f++) $frd[]=mysql_result($frecdest,$f,0);	
	
	for ($a=0;$a<$cwdm;$a++)
	{
		$datosn=explode("|",$_SESSION["wdm$a"]);
		$xa=$datosn[2];
		$ya=$datosn[3];
		$ia=$datosn[7];
		$n=$a+1;
		
		for($lam=0;$lam<$clam;$lam++)
		{
		
			$frec=mysql_result($lamq,$lam,0);
			$b=$a+1;
			$nodofrec="$b-$frec";
			$ptofo=$ptofd="";
			$pto1=$pto2="";
			$tjclienteo=$tjcliented=$modtjco=$modtjcd="";
			$colorfo=$colorfd=$colorft=$gris;
			
			$ptofo=array_search($nodofrec,$fro);
			$ptofd=array_search($nodofrec,$frd);
			if($ptofo!==false) {$colorfo=$azul;$pto1=mysql_result($frecorig,$ptofo,1);}
			if($ptofd!==false) {$colorfd=$azul;$pto2=mysql_result($frecdest,$ptofd,1);}
			if($ptofo!==false or  $ptofd!==false)  $colorft=$verde;
			if($ptofo!==false and $ptofd!==false) $colorft=$azul;


			
			if($ptofo!==false) 
			{
				$tjclienteo=substr(mysql_result($frecorig,$ptofo,3),0,4);
				$idnodoo=mysql_result($frecorig,$ptofo,4);
				$modtjclienteo=mysql_query("select modelo_tarjeta from inventario_tarjetas_wdm where wdm='$wd' and id_nodo='$idnodoo' and concat(repisat,'-',posicion_tarjeta)='$tjclienteo'");
				if(mysql_num_rows($modtjclienteo)>0) $modtjco=mysql_result($modtjclienteo,0,0);
			}
			if($ptofd!==false) 
			{
				$tjcliented=substr(mysql_result($frecdest,$ptofd,3),0,4);
				$idnodod=mysql_result($frecdest,$ptofd,4);
				$modtjcliented=mysql_query("select modelo_tarjeta from inventario_tarjetas_wdm where wdm='$wd' and id_nodo='$idnodod' and concat(repisat,'-',posicion_tarjeta)='$tjcliented'");
				if(mysql_num_rows($modtjcliented)>0) $modtjcd=mysql_result($modtjcliented,0,0);
			}

			
			if($cwdm>=5)
			{
				$defy=35;
				$defx=0;
				$defy1=160;
			}
			
			if($cwdm<5)
			{
				$defy=20;
				$defx=45;
				$defy1=173;
			}
			
			imagestring($im, 2, $xa-$defx,  $ya+$defy1+($lam*$defy), "$pto2", $colorfd);			//Puerto
			imageline($im, $xa, $ya+180+($lam*$defy), $xa+5, $ya+175+($lam*$defy), $colorfd);			//Linea de flecha
			imageline($im, $xa, $ya+180+($lam*$defy), $xa+5, $ya+185+($lam*$defy), $colorfd);			//Linea de flecha		
			imageline($im, $xa, $ya+180+($lam*$defy), $xa+40, $ya+180+($lam*$defy), $colorfd);			//Linea
			if($modtjcd=='LSX' and $modtjco=='LSX') imagefilledellipse  ($im, $xa+40, $ya+180+($lam*$defy), 6, 6, $colorfd );	//Circulo traspaso
			
			imagestring($im, 3, $xa+50, $ya+173+($lam*$defy), "$frec", $colorft);				//Frecuencia
			
			if($modtjcd=='LSX' and $modtjco=='LSX') imagefilledellipse  ($im, $xa+100, $ya+180+($lam*$defy), 6, 6, $colorfo );	//Circulo traspaso
			imageline($im, $xa+100, $ya+180+($lam*$defy), $xa+140, $ya+180+($lam*$defy), $colorfo);		//Linea
			imageline($im, $xa+140, $ya+180+($lam*$defy), $xa+135, $ya+175+($lam*$defy), $colorfo);		//Linea de flecha
			imageline($im, $xa+140, $ya+180+($lam*$defy), $xa+135, $ya+185+($lam*$defy), $colorfo);		//Linea de flecha
			imagestring($im, 2, $xa+100+$defx, $ya+$defy1+($lam*$defy), "$pto1", $colorfo);			//Puerto
			
		}
		
	}



}

//**************DIBUJA EL DETALLE DE UNA FRECUENCIA************************

if(substr($tipoequipo,0,2)=="el")
{

	$frecdet=substr($tipoequipo,2);
	
	for ($a=0;$a<$cwdm;$a++)
	{
		$b=$a+1;
		$n=$a+1;
		$nn=$a+2;
		if($a==$cwdm-1) $nn=$cwdm;
		$am=$n-1;
		if($a==0) $am=$cwdm;

		$datosn=explode("|",$_SESSION["wdm$a"]);
		$xa=$datosn[2];
		$ya=$datosn[3];
		
		//$frecorig=mysql_query("select desc_nominter_troncal_d,pto_troncal_d,frecuencia,lambda,puerto,tarjeta_cliente,id_nodo_d from secciones_wdm inner join inventario_puertos_wdm on secciones_wdm.wdm=inventario_puertos_wdm.wdm and secciones_wdm.id_nodo_d=inventario_puertos_wdm.id_nodo  where secciones_wdm.wdm='$wd' and substr(secciones_wdm.pto_troncal_d,1,2)=inventario_puertos_wdm.repisat and substr(secciones_wdm.pto_troncal_d,4,1)=inventario_puertos_wdm.posicion_tarjeta and puerto like '%C' and frecuencia='$frecdet' and desc_nominter_troncal_d like 'WDM$b%' order by desc_nominter_troncal_d");
		//$cfreco=mysql_num_rows($frecorig);
		//$frecdest=mysql_query("select desc_nominter_troncal_a,pto_troncal_a,frecuencia,lambda,puerto,tarjeta_cliente,id_nodo_a from secciones_wdm inner join inventario_puertos_wdm on secciones_wdm.wdm=inventario_puertos_wdm.wdm and secciones_wdm.id_nodo_a=inventario_puertos_wdm.id_nodo  where secciones_wdm.wdm='$wd' and substr(secciones_wdm.pto_troncal_a,1,2)=inventario_puertos_wdm.repisat and substr(secciones_wdm.pto_troncal_a,4,1)=inventario_puertos_wdm.posicion_tarjeta and puerto like '%C' and frecuencia='$frecdet' and desc_nominter_troncal_a like '%-WDM$b%' order by desc_nominter_troncal_a");
		//$cfrecd=mysql_num_rows($frecdest);

		$frecorig=mysql_query("select concat(substr(t1.id_nodo,16,1),'-',t2.frecuencia) as t,concat(t2.repisat,'/',t2.posicion_tarjeta,'/',t2.puerto) as pto, substr(t1.wdm_destino,5,1) as dest, t2.tarjeta_cliente as tjc, t2.id_nodo as idnd from inventario_puertos_wdm as t1 inner join inventario_puertos_wdm as t2 on t1.id_nodo=t2.id_nodo and t1.repisat=t2.repisat and t1.posicion_tarjeta=t2.posicion_tarjeta where t1.wdm='$wd' and t1.tipo_puerto='N/A()' and t1.puerto like '%L' and t2.puerto like '%C' and substr(t1.wdm_destino,5,1)='$nn' and t2.frecuencia='$frecdet' and t2.id_nodo like '%WDM$n%' order by t1.pto_troncal");
		$cfreco=mysql_num_rows($frecorig);
	
		$frecdest=mysql_query("select concat(substr(t1.id_nodo,16,1),'-',t2.frecuencia) as t,concat(t2.repisat,'/',t2.posicion_tarjeta,'/',t2.puerto) as pto, substr(t1.wdm_destino,5,1) as dest, t2.tarjeta_cliente as tjc, t2.id_nodo as idnd from inventario_puertos_wdm as t1 inner join inventario_puertos_wdm as t2 on t1.id_nodo=t2.id_nodo and t1.repisat=t2.repisat and t1.posicion_tarjeta=t2.posicion_tarjeta where t1.wdm='$wd' and t1.tipo_puerto='N/A()' and t1.puerto like '%L' and t2.puerto like '%C' and substr(t1.wdm_destino,5,1)='$am' and t2.frecuencia='$frecdet' and t2.id_nodo like '%WDM$n%' order by t1.pto_troncal");
		$cfrecd=mysql_num_rows($frecdest);
		
		//imagestring($im, 3, 130+($a*250), 280, "$n $cfrecd --", $verde);
	
		$fdptotr=$fdptotm=$fdptotc=$idnodod=$fdrepm=$fdslotm=$fdrepl=$fdslotl=$fdmodtarm=$fdmodtarl="";
		for ($fd=0;$fd<$cfreco;$fd++)
		{
			$fdptotr=mysql_result($frecorig,$fd,1);
			$fdptotm=substr($fdptotr,0,5).mysql_result($frecorig,$fd,1);
			$fdptotc=strtr(mysql_result($frecorig,$fd,3),"-","/");
			$fdidnodod=mysql_result($frecorig,$fd,4);
			$fdrepm=substr($fdptotr,0,2);
			$fdslotm=substr($fdptotr,3,1);
			$fdrepl=substr($fdptotc,0,2);
			$fdslotl=substr($fdptotc,3,1);
			
			$fdmodtarm=mysql_result(mysql_query("select modelo_tarjeta from inventario_tarjetas_wdm where wdm='$wd' and repisat='$fdrepm' and posicion_tarjeta='$fdslotm' and id_nodo='$fdidnodod'"),0,0);
			if($fdptotc<>"") $fdmodtarl=mysql_result(mysql_query("select modelo_tarjeta from inventario_tarjetas_wdm where wdm='$wd' and repisat='$fdrepl' and posicion_tarjeta='$fdslotl' and id_nodo='$fdidnodod'"),0,0);
		
		}
		
		$faptotr=$faptotm=$faptotc=$idnodod=$farepm=$faslotm=$farepl=$faslotl=$famodtarm=$famodtarl="";
		for ($fa=0;$fa<$cfrecd;$fa++)
		{
			$faptotr=mysql_result($frecdest,$fa,1);
			$faptotm=substr($faptotr,0,5).mysql_result($frecdest,$fa,1);
			$faptotc=strtr(mysql_result($frecdest,$fa,3),"-","/");
			$faidnodod=mysql_result($frecdest,$fa,4);
			$farepm=substr($faptotr,0,2);
			$faslotm=substr($faptotr,3,1);
			$farepl=substr($faptotc,0,2);
			$faslotl=substr($faptotc,3,1);
			
			$famodtarm=mysql_result(mysql_query("select modelo_tarjeta from inventario_tarjetas_wdm where wdm='$wd' and repisat='$farepm' and posicion_tarjeta='$faslotm' and id_nodo='$faidnodod'"),0,0);
			if($faptotc<>"")  $famodtarl=mysql_result(mysql_query("select modelo_tarjeta from inventario_tarjetas_wdm where wdm='$wd' and repisat='$farepl' and posicion_tarjeta='$faslotl' and id_nodo='$faidnodod'"),0,0);							
		
		}		
			$sep=70;
			$atj=35;
			imagefilledrectangle($im,  $xa-25+($sep*0), $ya+180, $xa-25+$atj+($sep*0), $ya+380, $verde);
			imagefilledrectangle($im,  $xa-25+($sep*1), $ya+180, $xa-25+$atj+($sep*1), $ya+380, $naranja);
			imagefilledrectangle($im,  $xa-25+($sep*2), $ya+180, $xa-25+$atj+($sep*2), $ya+380, $verde);
			
			//imageline($im, $xa-$atj-$sep+($sep*0), $ya+280, $xa-25+($sep*0), $ya+280, $verde);		//Linea troncal
			imageline($im, $xa-25+($sep*0)-$sep+$atj, $ya+280, $xa-25+($sep*0), $ya+280, $azul);		//Linea MRx a WDM N-1
			imageline($im, $xa-25+($sep*1)-$sep+$atj, $ya+280, $xa-25+($sep*1), $ya+280, $azul);		//Linea MRx a LQM
			imageline($im, $xa-25+($sep*2)-$sep+$atj, $ya+280, $xa-25+($sep*2), $ya+280, $azul);		//Linea LQM a MRx
			imageline($im, $xa-25+($sep*2)+$atj, $ya+280, $xa-20+($sep*2)+$sep, $ya+280, $azul);		//Linea MRx a WDM N+1
									
			imagettftext($im, 8, 90, $xa-15+($sep*0), $ya+240, $blanco, 'arial.ttf', "$faptotr");		//Puerto tarjeta MRx al WDM N-1
			imagettftext($im, 8, 90, $xa-15+($sep*1), $ya+240, $blanco, 'arial.ttf', "$faptotc");		//Puerto tarjeta LQM al WDM N-1
			//imagettftext($im, 8, 90, $xa-15+($sep*2), $ya+240, $blanco, 'arial.ttf', "$fdptotm");

			//imagettftext($im, 8, 90, $xa+10+($sep*0), $ya+350, $blanco, 'arial.ttf', "$faptotm");
			imagettftext($im, 8, 90, $xa+10+($sep*1), $ya+350, $blanco, 'arial.ttf', "$fdptotc");		//Puerto tarjeta LQM al WDM N+1
			imagettftext($im, 8, 90, $xa+10+($sep*2), $ya+350, $blanco, 'arial.ttf', "$fdptotr");		//Puerto tarjeta MRx al WDM N+1

			imagestring($im, 2, $xa-15+($sep*1), $ya+180, "$famodtarl", $blanco);				//Modelo tarjeta LQM/LSX al WDM N-1
			imagestring($im, 2, $xa-15+($sep*1), $ya+360, "$fdmodtarl", $blanco);				//Modelo tarjeta LQM/LSX al WDM N+1
			
			imagestring($im, 2, $xa-15+($sep*0), $ya+270, "$famodtarm", $blanco);				//Modelo tarjeta MRx al WDM N-1
			imagestring($im, 2, $xa-15+($sep*2), $ya+270, "$fdmodtarm", $blanco);				//Modelo tarjeta MRx al WDM N+1
			
//			imageline($im, $xa-25+$atj+($sep*1), $ya+280, $xa-25+$atj+($sep*1), $ya+280, $verde);		//Linea
//			imageline($im, $xa-25+$atj+($sep*2), $ya+280, $xa-25+$atj+($sep*2), $ya+280, $verde);		//Linea
												
//			imagestring($im, 2, $xa-65+($sep*0), $ya+260, "$faptotr", $verde);
//			imagestring($im, 2, $xa-20+$atj+($sep*0), $ya+300, "$faptotm", $verde);
//			imagestring($im, 2, $xa-65+($sep*1), $ya+260, "$faptotc", $naranja);
//			imagestring($im, 2, $xa-20+$atj+($sep*1), $ya+300, "$fdptotc", $naranja);
//			imagestring($im, 2, $xa-65+($sep*2), $ya+260, "$fdptotm", $verde);
//			imagestring($im, 2, $xa-20+$atj+($sep*2), $ya+300, "$fdptotr", $verde);
			
		
	}
}*/
if ($exportar==1)
{
	$rutaWdm="Archivos/diagramas/".$wd.".png";	
	imagejpeg($im,$rutaWdm);
	echo "<script>
	window.open(\"exportar_wdm.php?wd=$wd\");
	self.close();
	</script>";
}

header('Content-type: image/png');
imagepng($im);
imagedestroy ($im);
?>

