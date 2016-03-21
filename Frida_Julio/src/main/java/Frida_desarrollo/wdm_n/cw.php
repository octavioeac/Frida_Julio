<?php
require 'wdm2.class.php';
require 'perfiles.php';

#creacion del objeto
error_reporting(0);
$equipo = new Equipo();
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/cw.css">	
		<!-- <link rel="stylesheet" href="js/bootstrap/css/bootstrap.min">-->
		<script type = "text/javascript" src = "./js/jquery-1.9.1" ></script>
		<link href="../style.css" rel="stylesheet" type="text/css" media="screen" />
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
		</br>
<?

$muestraTarj = 'display:none';
$resultado=0;
if (isset($_REQUEST['rf'])) 		$rf=$_REQUEST['rf'];	else $rf="";
if (isset($_REQUEST['provee']))		$selPro=$_REQUEST['provee']; else $selPro="";
if (isset($_REQUEST['exportar'])) 	$exportar=$_REQUEST['exportar']; 	else $exportar=0;
if (isset($_REQUEST['tipoequipo'])) $tipoequipo=$_REQUEST['tipoequipo'];	else $tipoequipo="";
if (isset($_REQUEST['solcns'])) 	$solcns=$_REQUEST['solcns'];	else $solcns="";
if (isset($_REQUEST['siglas'])) 	$siglas=$_REQUEST['siglas'];	else $siglas="";
if (isset($_REQUEST['repisa'])) 	$repisa=$_REQUEST['repisa'];	else $repisa="";
if (isset($_REQUEST['id'])) 		$id=$_REQUEST['id'];	else $id="";
if (isset($_REQUEST['ido']))		$ido=$_REQUEST['ido'];	else $ido="";
if (isset($_REQUEST['idd'])) 		$idd=$_REQUEST['idd'];	else $idd="";
if (isset($_REQUEST['wdm'])) 		$wdm=$_REQUEST['wdm'];	else $wdm="";
if (isset($_REQUEST['altanodo'])) 	$altanodo=$_REQUEST['altanodo'];	else $altanodo="";
if (isset($_REQUEST['altaseccion']))$altaseccion=$_REQUEST['altaseccion'];	else $altaseccion="";
if (isset($_REQUEST['altarcdt'])) 	$altarcdt=$_REQUEST['altarcdt'];	else $altarcdt="";
if (isset($_REQUEST['cambioreg'])) 	$cambioreg=$_REQUEST['cambioreg'];	else $cambioreg="";
if (isset($_REQUEST['cambionodo'])) $cambionodo=$_REQUEST['cambionodo'];	else $cambionodo="";
if (isset($_REQUEST['upfo'])) 		$upfo=$_REQUEST['upfo'];	else $upfo="";
if (isset($_REQUEST['clliagrf2'])) 	$clliagrf2=$_REQUEST['clliagrf2'];	else $clliagrf2="";
if (isset($_REQUEST['trayectoria']))$trayectoria=$_REQUEST['trayectoria'];	else $trayectoria=0;
if (isset($_REQUEST['tipoenlace'])) $tipoenlace=$_REQUEST['tipoenlace'];	else $tipoenlace="f";
if (isset($_REQUEST['altatj'])) 	$altatj=$_REQUEST['altatj'];	else $altatj="";
if (isset($_REQUEST['uppto'])) 		$uppto=$_REQUEST['uppto'];	else $uppto="";
if (isset($_REQUEST['ptow'])) 		$ptow=$_REQUEST['ptow'];	else $ptow="";
if (isset($_REQUEST['otro'])) 		$otroWdm=$_REQUEST['otro'];	else $otroWdm="";
if (isset($_REQUEST['clli_equipo']))$clli_equipo=$_REQUEST['clli_equipo'];	else $clli_equipo="";
if (isset($_REQUEST['resultado']))
{
	$resultado = $_REQUEST['resultado'];
}

$wd=substr($wdm,0,strpos($wdm,"|"));
$id_nodo_new=$wd."-".$clli_equipo."-".$repisa;

if (!isset($tipoequipo) or $tipoequipo=="")							{$vereq="display:none";$vertarj="display:none";$verptos= "display:none";$verenl="display:none";$verrcdt="display:none";}
if (substr($tipoequipo,0,1)=="d" or substr($tipoequipo,0,1)=="a")				{$vereq="";$verenl="display:none";$verrcdt="display:none";}
if (substr($tipoequipo,0,1)=="e")								{$vereq="display:none";$verenl="";$verrcdt="display:none";}
if (substr($tipoequipo,3,1)=="r")								{$vereq="display:none";$verenl="display:none";$verrcdt="";}
if ($solcns=="")										{$verobscns="display:none";$verobscnsnd="display:none";}
if ($solcns==1)											{$verobscns="";$verobscnsnd="display:none";}
if ($solcns==2)											{$verobscnsnd="";$verobscns="display:none";}

?>
<form name='wdm' method='post'>
			<input type = 'hidden' name = 'flagProvee'>
			<input type='hidden' name='cambioreg' value=1>
			<input type='hidden' name='tipoequipo' value=<?$tipoequipo?>>
			<input type='hidden' name='siglas' value=<?$siglas?>>
			<input type='hidden' name='repisa' value=<?$repisa?>>
			<input type='hidden' name='id' value=<?$id?>>
			<input type='hidden' name='ido' value=<?$ido?>>
			<input type='hidden' name='idd' value=<?$idd?>>
			<input type='hidden' name='cambionodo'>
			<input type='hidden' name='ospf'>

			<input type='hidden' name='altanodo'>
			<input type='hidden' name='altatj'>
			<input type='hidden' name='uppto'>

			<input type='hidden' name='altaseccion'>			
			<input type='hidden' name='upfo'>

			<input type='hidden' name='verpuertos'>
			<input type='hidden' name='repisat2'>
			<input type='hidden' name='modelo_tarjeta2'>
			<input type='hidden' name='slot2'>
			<input type='hidden' name='subslot2'>
			<input type='hidden' name='tipo_tarjeta2'>
			<input type='hidden' name='solcns'>
			<input type='hidden' name='exportar'>
			<input type='hidden' name='clliagrf2'>
			<input type='hidden' name='trayectoria' value=<?$trayectoria?>>
			<input type='hidden' name='frec'>
			<input type='hidden' name='topologico'>

<?
/*Estatus CNS Del WDM*/

$wd=substr($wdm,0,strpos($wdm,"|"));
if($wd != ''){
	$estatcnswd = $equipo->estatusWdm($wd); 
	
$congelarwdm = array('AUTORIZADA', 'POR REVISAR', 'VALIDADA', 'EN VALIDACION', 'EN PROCESO', 'ASIGNACION DE TECNICO');
		
	if (in_array($estatcnswd,$congelarwdm)){
		$congelar=1;
		$leyendacong="<br><b><font color=red>WDM BLOQUEADO POR CNS NO SE PUEDE MODIFICAR</font></b>";
			
	if($altanodo=="1" or $altaseccion=="1" or $solcns=="1" or $solcns=="2" or $altatj=="altatj" or substr($altatj,0,6)=="bajatj" or substr($uppto,0,1)=="a" or substr($uppto,0,1)=="b" or substr($upfo,0,1)=="a" or substr($upfo,0,1)=="b"){
		$avisocns=1;
		} 
	$altanodo=$altaseccion=$altarcdt=$solcns=$altatj=$uppto=$upfo="C";
	}
	else{
	$congelar=0;
	$leyendacong="";		
	$avisocns=0;
	}

/*Estatus CNS del NODO WDM*/
#mysql_query("SELECT estatus from ordenes where nombre_oficial_pisa like '$wd-%' and id_tabla IN ('$id','$idd','$ido')");
$qestatcnsnodo = $equipo->estatusNodo($wd,$id,$idd,$ido);
#echo "SELECT estatus from ordenes where nombre_oficial_pisa like '$wd-%' and id_tabla IN ('$id','$idd','$ido')";
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

}

####### Actualizar BD
if ($altanodo=="1")
{

		$ref_sisa=$ip_sistema=$version_nodo=$id_inter_sistema=$id_inter_gestion=$inter_gest=$anexo_ot=$ospf="-";
		$faltan_datos="";
		if (trim($clli_equipo)=='')		$faltan_datos.="Debe indicar el CLLI del Equipo\\n";
		if (trim($ref_sisa)=='')		$faltan_datos.="Debe indicar la Referencia SISA\\n";
		if (trim($ip_sistema)=='')		$faltan_datos.="Debe indicar la IP Sistema (L0)\\n";
		if (trim($ip_gestion)=='')		$faltan_datos.="Debe indicar la IP del Nodo\\n";
		if (trim($ubi_nodo_adm)=='')	$faltan_datos.="Debe indicar la Ubicacin del Nodo\\n";
		if (trim($version_nodo)=='')	$faltan_datos.="Debe indicar el Release del Nodo\\n";
		if (trim($modelo)=='')			$faltan_datos.="Debe indicar el Modelo\\n";
		
	
		if ($faltan_datos<>"") echo "<script>alert('$faltan_datos');</script>";
    
		if ($faltan_datos=="")
		{
		      	$error="";
			// Actualiza la Tabla "cat_wdm"
			$qmod="UPDATE cat_wdm SET login='$sess_usr', fecha_alta=NOW(), clli_equipo='$clli_equipo', ref_sisa='$ref_sisa', repadm_conxadsl='$modelo',id_nodo='$id_nodo', ubi_nodo_adm='$ubi_nodo_adm', ip_sistema='$ip_sistema', id_inter_sistema='$id_inter_sistema', ip_gestion='$ip_gestion', id_inter_gestion='$id_inter_gestion', inter_gest='$inter_gest', ospf='$ospf', version_nodo='$version_nodo', remate_cd1='$remate_cd1', long_cable1='$long_cable1', cal_cable_1='$cal_cable_1', bdcd_1='$bdcd_1', cap_break1='$cap_break1', anexo_ot='$anexo_ot', remate_cd2='$remate_cd2', long_cable2='$long_cable2', cal_cable_2='$cal_cable_2', bdcd_2='$bdcd_2', cap_break2='$cap_break2',  pdu1_cap_break1='$pdu1_cap_break1', pdu1_pos_break1='$pdu1_pos_break1', pdu1_pos_break2='$pdu1_pos_break2', pdu2_cap_break1='$pdu2_cap_break1', pdu2_pos_break1='$pdu2_pos_break1', pdu2_pos_break2='$pdu2_pos_break2', pdu3_cap_break1='$pdu3_cap_break1', pdu3_pos_break1='$pdu3_pos_break1', pdu3_pos_break2='$pdu3_pos_break2' WHERE id='$id'";
			mysql_query($qmod);
			
		}
}

 echo" <div style='position:absolute;top:0;left:90%;font-size:9px;font-weight:bold;'>Usuario: $sess_nmb<br>DD: $sess_dd</div> ";



?>

		
		<div id = 'infwdm'>
		<div class = 'cinta'><center><label class = 'tituloPrincipal'>Informaci&oacute;n del WDM</label></center></div>
			<div class = 'field'>
				<label>Proveedor</label>
				<?php
					
					$proveedores=array("HUAWEI", "NEC", "CIENA", "CISCO", "ALCATEL LUCENT", "ALCATEL");
				    echo "<select id='provee' name='provee' onchange='javascript:
					submit();
					'>
				    <option value=''>-.SELECCIONE PROVEEDOR.-</option>";
					foreach($proveedores as $pr){
						if($provee==$pr)$selected="selected='selected'"; else $selected="";
							echo"<option $selected value='$pr'>$pr</option>";
					}
					echo"</select>";
					?>
								
				<label>Anexos</label>
				<?php if ($congelarnodo<>"1") {?>
				<button  style = 'width:25%'name = "anexos" title='Opcion para cargar anexos del Nodo' onclick="window.open('../../carga_archivos_wdm?tec=wdm&tipo=anexo&id=<?=$id?>&wdm=<?=$wd?>&congelar=<?=$congelarnodo?>');">Cargar Anexo</button>

                <?php }?>
			</div>
			<div class = 'field'>
				<label>WDM</label>
				<?php
		    	
		    	$infow = $equipo->anilloProveedor($provee,$wdm);		    	
		    	echo $infow;
				
				$ospf=$region="";
				if (trim($wdm<>'')){
					$region='';$ospf=substr($wdm,strpos($wdm,"|")+1);$wd=substr($wdm,0,strpos($wdm,"|"));
				}	
				echo $rowc["wdm"];

				if($resultado!=0){
					$resultado=0;
					//echo $resultado;
				?>
					<script type="text/javascript">
					setTimeout(tiempo,100);
					</script>
				<?php
				}
				
				


			?>
			<label>Estatus CNS</label>
				<input name="estatus_cns" readonly type="text" id="estatus_cns" title='Estatus del WDM' value="<?=$estatcnsnodo?>"/><?echo $leyendacongnodo?>
			</div>

		</div></br>
			
		<!-- Información del nodo Seleccionado -->

        <?
		if($wd=="") exit();
		else{
			//echo ("SELECT * from cat_wdm where id='$id'");
			$datos_nodo = $equipo->infoEquipo($id);

		}
		$cllitxt="";
		
		
		if($cambionodo==1){
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
		
		$limpia=mysql_query("SELECT * from cat_wdm limit 1");
		$numcol=mysql_num_fields($limpia);
		$ip_gestion="";		
		$rl=0;
		
		for($rl=0;$rl<$numcol;$rl++)
		{
			$cmplimp=mysql_field_name($limpia, $rl);
			$datosnodo[$cmplimp]='';
		}
	
		
		
		if (mysql_num_rows($datos_nodo)>0)		{
			$datosnodo = mysql_fetch_array($datos_nodo);
			$clli_equipo=$datosnodo['clli_equipo'];
			$proveedor=$datosnodo['proveedor_tx'];
			$repadm_conxadsl=$datosnodo['repadm_conxadsl'];
			$cllitxt="readonly";
			$division=$datosnodo['division'];
			$ip_sistema=$datosnodo['ip_sistema'];
			$nuevarepisa=$datosnodo['repisa'];
			$nodoAdm=$datosnodo['nodo_adm_conex_adsl'];
			$id_nodo='';
		
			$tip="";
			$abrev="WDM";
			
			if($clli_equipo<>"")
			{
				$repcons=trim(substr($nuevarepisa,-2));
				if($proveedor=="HUAWEI") $mod=substr($repadm_conxadsl,6);
				$id_nodo="$clli_equipo-".$abrev.$repcons."-".$mod;
				$id_inter_sistema="sistema-$clli_equipo-".$abrev.$repcons;
				$id_inter_gestion="$clli_equipo-".$abrev.$repcons;
				$inter_gest="gestion-$clli_equipo-".$abrev.$repcons;
			}
				
			
			if ($datosnodo['ip_gestion']<>""||$datosnodo['neid']<>"")
			{
				$siglas=$datosnodo['siglas_central'];
				$nuevarepisa=$datosnodo['repisa'];
				$clli_equipo=$datosnodo['clli_equipo'];
				$tecnologia=$datosnodo['tecnologia'];
				$ref_sisa=$datosnodo['ref_sisa'];		
				$id_nodo=$datosnodo['id_nodo'];		
					
				$id_inter_sistema=$datosnodo['id_inter_sistema'];	
				$ip_sistema=$datosnodo['ip_sistema'];
				$id_inter_gestion=$datosnodo['id_inter_gestion'];
				$ip_gestion=$datosnodo['ip_gestion'];
				$inter_gest=$datosnodo['inter_gest'];
				$version_nodo=$datosnodo['version_nodo'];
				$anexo_ot=$datosnodo['anexo_ot'];
				$neid=$datosnodo['neid'];
	
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
		    $ubi_nodo_adm=$datosnodo['ubi_nodo_adm'];
            $clli_equipo=$datosnodo['clli_equipo'];
		    $version_nodo=$datosnodo['version_nodo'];
            $tecnologia=$datosnodo['tecnologia'];
				
			echo "<input type=hidden name='tecnologiaEquipo' value='".$tecnologia."'>";	
			echo "<script>document.wdm.repisa.value='$nuevarepisa';</script>";
			echo "<script>document.wdm.topologico.value='".$datosnodo['topologico']."';</script>";
			//echo "<script>document.wdm.estatus_cns.value='".$datosnodo['estatus_cns']."';</script>";		
		}


?>



					
        <div id="infequipo" style="<?=$vereq?>"> 
        	<div class = 'cinta'><center><label class = 'tituloPrincipal'>Informaci&oacute;n del Nodo</label></center></div>
	        <div class = 'field'>
	        	<label>Estatus CNS del Nodo</label>
	        	<input name="estatus_cns" readonly type ="text" id="estatus_cns" title='Estatus del WDM' value="<?=$datosnodo['estatus_cns']?>"/>
	        </div>
	        <div class = 'field'>
	        	<label>Proveedor</label>
	        	<input name="tdProveedor" readonly type ="text" id="tdProveedor" title='Proveedor' value="<?=$proveedor?>"/>
	        	<label>Modelo</label>
                <input name="modelo" type="text"  id="modelo" title='modelo' value="<?=$repadm_conxadsl?>" size="28" readonly/>      
   	        </div>
   	        <div class = 'field'>
	        	<label>Repisa</label>
	        	<input name="repisaNodo" readonly type ="text" id="repisaNodo" title='Repisa' value="<?=$nuevarepisa?>"/>
	        	<label>Release</label>
                <input name="version_nodo" size=10 type="text"  id="version_nodo" title='Indicar la version del Nodo' value="<?=$version_nodo?>" readonly/>
    	    </div>
    	     <div class = 'field'>
	        	<label>CLLI</label>
                <input name="clli_equipo" type="text"  id="clli_equipo" title='CLLI del Equipo' size="28" onchange='submit()' value="<?=$clli_equipo?>" <?=$cllitxt?>/>	   	    
            </div>
            <div class = 'field'>
	        	<label>Nodo</label>
	        	<input name="nomNodo" readonly type ="text" id="nomNodo" title='Nodo' value="<?=$nodoAdm?>"/>
	        	<label>OT</label>
	        	<?php if ($congelar<>"1" and $congelarnodo<>"1") {?>
				<input name="cargaot" type="button" class="Estilo49" id="cargaot" style="width:75px;margin:0;" title='Opcion para cargar la OT (Grafo) del Nodo' onclick="window.open('carga_archivos_wdm?tec=wdm&tipo=ot&id=<?=$id?>&wdm=<?=$wd?>&congelar=<?=$congelar?>&congelarnodo=<?=$congelarnodo?>');" value="Cargar OT" />
		      	<?php }?>
				<input name="ot_nodo" readonly type="text"  id="ot_nodo" style="margin:0;"title='OT del Nodo' value="<?=$datosnodo['ot_nodo']?>" size="5"/>

		        <?php if ($congelar<>"1" and $congelarnodo<>"1") {?>
				<input name="cargaotamp" type="button" class="Estilo49" id="cargaotamp" style="width:120px;margin:0;" title='Opcion para cargar la OT de Ampliacin del Nodo' onclick="window.open('carga_archivos_wdm?tec=wdm&tipo=otamp&id=<?=$id?>&wdm=<?=$wd?>&congelar=<?=$congelar?>&congelarnodo=<?=$congelarnodo?>');" value="Cargar AMP." />

                <?php }?>
				
    	    </div>
    	    <div class = 'field'>
	        	<label>Siglas</label>
	        	<input name="siglas" type="text"  id="siglas" title='Siglas del Nodo' value="<?=$siglas?>" size="28" readonly/>
	        	<label>Ubicaci&oacute;n</label>
                <input name="ubi_nodo_adm" type="text"  id="ubi_nodo_adm" title='Ubicacion del Nodo' value="<?=$ubi_nodo_adm?>" size="28" readonly/>    	   
            </div>
           <div class = 'field'>
	        	<label>Identificador de Nodo</label>
                <input name="id_nodo" type="text"  id="id_nodo" title='Identificador de Nodo' size="28" value="<?=$id_nodo?>" readonly/>	        	
                <label>Ip del Nodo</label>
                <input name="ip_gestion" type="text"  id="ip_gestion" title='IP del Nodo' value="<?=$ip_gestion?>" size="28" readonly/>
            </div>
            <div class = 'field'>
	        	<label>NEID del nodo</label>
                <input name="neid" type="text"  id="neid" title='NEID del Nodo' value="<?=$neid?>" size="28" readonly/>
                <label></label>
                <input class='solC' type="button" name="cnsnd" id="cnsnd" value="Solicitar Gestion de NODO" onclick='document.wdm.solcns.value=2
      	       ;document.wdm.submit();document.wdm.submit()'>
            </div>
             <div class = 'field'>
	        	<center></center>
             </div>
             <div class = 'field' style='<?=$verobscnsnd?>'>
	        	<textarea  name='obscnsnd' id='obscnsnd'></textarea>
            </div>

              <?php

		       	 $id_nodo_m = explode('-',$id_nodo);
		       	 $id_nodo_m[0];

		       	 $fndclli_equipo = strpos($clli_equipo,'-');
		       	 //echo  $fndclli_equipo;

		       	 if($fndclli_equipo===fALSE){ 
		       	 	$clli_equipo;
		       	 } else {
		       	 	$clli_equipo = explode('-',$clli_equipo);
		       	 	$clli_equipo = $clli_equipo[0];
		       	 }
		       	 
		       	if($clli_equipo==$id_nodo_m[0]){

		       	if($repadm_conxadsl==""||$version_nodo==""||$ubi_nodo_adm==""||($ip_gestion==""&&$neid=="")){?>
		       		<div id = 'faltaDatoNodo'>
			       		<label class="alertaFalta">Faltan datos del nodo</label><br />
			       		<label>Aseg&uacute;rese de que el nodo est&eacute; gestionado.</label>
		       		</div>
		       	<?php
		       	}else{
			     $muestraTarj = 'display:block';
				}

				}else{
					echo '<div id = "faltaDatoNodo">
		       		<center><label class="alertaFalta">Clli e Identificador del Nodo incorrectos</label><br />
		       		<label class="alertaFalta">Aseg&uacute;rese que sean iguales</label></center>
		       		</div>';
				}


	   ?>

        </div><br>
        <!-- Informacion de Nodos y Tarjetas -->

        <?
       if ($altatj=="altatj"){
			$faltan_datostj="";
			if (trim($repisat)=='')			$faltan_datostj.="Debe seleccionar la repisa\\n";	
			if (trim($modelo_tarjeta)=='')	$faltan_datostj.="Debe seleccionar el Modelo de la Tarjeta\\n";
			if (trim($slot)=='')			$faltan_datostj.="Debe seleccionar la Posicin de la Tarjeta (Slot en la Repisa)\\n";

			if ($faltan_datostj<>"") echo "<script>alert('$faltan_datostj');</script>";

			if ($faltan_datostj==""){
				$error="";
				//$qalta="INSERT INTO inventario_tarjetas_wdm(topologia_wdm_origen, clli_nodo_origen, tarjeta, repisa, slot,fecha_alta, login_alta) 
				///					VALUES ('$wd', '$clli_equipo', '$modelo_tarjeta', '$repisat', '$slot', NOW(),'".$sess_usr."')";
				//echo $qalta;
				$qalta="INSERT INTO inventario_tarjetas_wdm
				(wdm, id_nodo, modelo_tarjeta, repisat, posicion_tarjeta, modulo, subslot,
				 fecha_alta, login, num_ot_frida, estatus)
				  VALUES ('$wd', '$id_nodo', '$modelo_tarjeta', 
				  	'$repisat', '$slot', '$tipo_tarjeta', '$subslot', NOW(),'".$sess_usr."','$rf','POR REVISAR')";

				mysql_query($qalta);
			}
		}


		if (substr($altatj,0,6)=="bajatj"){
			$idtj=substr($altatj,strpos($altatj,"-",7)+1);
			$qbajatj=mysql_query("SELECT id_nodo, repisat, posicion_tarjeta, subslot from inventario_tarjetas_wdm where id='$idtj'");
			$idnodobajatj=mysql_result($qbajatj,0,0);
			$repbajatj=mysql_result($qbajatj,0,1);
			$slotbajatj=mysql_result($qbajatj,0,2);
			$subslotbajatj=mysql_result($qbajatj,0,3);
			mysql_query("DELETE FROM inventario_tarjetas_wdm where id='$idtj'");
			mysql_query("DELETE FROM inventario_puertos_wdm where wdm='$wd' and id_nodo='$idnodobajatj' and repisat='$repbajatj' and posicion_tarjeta='$slotbajatj' and subslot='$subslotbajatj'");
			mysql_query("UPDATE inventario_puertos_wdm set tarjeta_cliente='' where wdm='$wd' and id_nodo='$idnodobajatj' and tarjeta_cliente like '$repbajatj-$slotbajatj-$subslotbajatj%'");
		}

		if(trim($ip_gestion)=="" or substr($tipoequipo,0,1)=="e") {$vertarj="display:none";$verptos = "display:none";}
		else {$vertarj="";$verptos = "";}




        ?>
   		<div id = 'divTituloRepisa' style = '<?echo $vertarj?>'>
        	<div class = 'cinta'><center><label class = 'tituloPrincipal'>Alta Tarjetas</label></center></div>
	         
	        <!--Tabla de Tarjetas --> 
	        <div class = 'field'>
	        	<label><strong>Alta de Tarjetas</strong></label>
	        </div></br>
	        <div class = 'field'>
	        	<table id = 'trj'>
	        		<thead>
	        			<tr>
				        	<th>Repisa</th>
				        	<th>Slot</th>
				        	<th>Subslot</th>
				        	<th>Modelo</th>				        	
				         	<th>Agregar/Borrar</th>
				        </tr>
				    </thead>
				    <tbody>
				    	<tr>
				    		<?
				    		#Repisa
				    		if($repisat2<>"") $repisat = $repisat2;
				    		/*$tr = $equipo->repisa($provee,$repadm_conxadsl);
				    		echo $tr;*/

				    		$repTarjeta = mysql_query("SELECT num_repisas
										                 FROM cat_tarjetas_wdm 
												    		WHERE proveedor = '".$provee."'
												    			AND   equipo = '".$repadm_conxadsl."'");
				    		echo "<td><center><select name='repisat' title='Seleccionar la Repisa' onchange='document.wdm.tipoequipo.value=\"a\";document.wdm.id.value=\"$id\";submit();'>
				    		          <option>--REPISA--</option>";

				    		if(mysql_num_rows($repTarjeta)>0){

							$numRepisas = explode(',',@mysql_result($repTarjeta,0,0));
								for($i = 0; $i< count($numRepisas) ; $i ++){

									if($repisat == $numRepisas[$i]) $selRep ="selected";
									else $selRep = "";
									echo "<option value = '".$numRepisas[$i]."'  $selRep>".$numRepisas[$i]."</option>";
								}

				    		}
				    		echo "</select></center></td>";

				    		#Modelo de Tarjeta         
							if($modelo_tarjeta2<>"") $modelo_tarjeta=$modelo_tarjeta2;
							$query="SELECT modelo_tarjeta 
							           FROM cat_tarjetas_wdm 
							           WHERE proveedor='".$datosnodo['proveedor_tx']."' 
							           and equipo =  '".$datosnodo['repadm_conxadsl']."'
							           group by modelo_tarjeta order by modelo_tarjeta ASC";
						    $res = mysql_query($query);						
						    
							echo "<td>";
							echo "<center><select name='modelo_tarjeta' onchange='document.wdm.tipoequipo.value=\"a\";document.wdm.id.value=\"$id\";submit()'>\n<option value=''>--MODELO--</option>\n";
							if ($row = mysql_fetch_array($res)){
								do { 
									if($modelo_tarjeta==$row["modelo_tarjeta"]) $selmt="selected";
									else $selmt="";
						     			echo "<option $selmt value= '".$row["modelo_tarjeta"]."'>".$row["modelo_tarjeta"]."</option>\n";
								} while ($row = mysql_fetch_array($res)); 
							}			
							echo "</select></center></td>";

							#SLOT 
							if($slot2<>"") $slot=$slot2;
				            $query = "SELECT  slot 
				                        FROM  cat_tarjetas_wdm 
				                        WHERE proveedor='".$datosnodo['proveedor_tx']."'  
				                        and equipo = '".$datosnodo['repadm_conxadsl']."' 
				                        and modelo_tarjeta like '$modelo_tarjeta' 
				                        group by slot order by slot";

				            $res = mysql_query($query);	

				            #Solo aplica en caso de que NUNCA aplique el subslot.
				            $cuentasubslot = 1;

				            $querytjc = "SELECT slot,count(slot)
				                           FROM inventario_tarjetas_wdm_finalmzo2015 
				                           WHERE topologia_wdm_origen='$wd' 
				                           AND clli_nodo_origen = '".$datosnodo['clli_equipo']."' 
				                           AND  repisa ='$repisat' 
				                           GROUP BY  slot having count(slot) = $cuentasubslot 
				                           ORDER BY slot";


				    		$tjsl_cargadas = mysql_query($querytjc);
							for ($tjc=0;$tjc<mysql_num_rows($tjsl_cargadas);$tjc++) $tjslc[$tjc]=mysql_result($tjsl_cargadas,$tjc,0);
							
							echo "<td><center><select name='slot' onchange='document.wdm.tipoequipo.value=\"a\";document.wdm.id.value=\"$id\";submit()'>\n<option value=''>--SLOT--</option>\n";
							if ($row = mysql_fetch_array($res)){
								$numSlot = explode(',',$row['slot']); 
								for($i = 0; $i < count($numSlot) ; $i++){
									if($slot == $numSlot[$i]) $selrep="selected";
									else $selrep="";
									
									if(!in_array($numSlot[$i],$tjslc) or $numSlot[$i]==$slots) echo "<option $selrep value= '".$numSlot[$i]."'>".$numSlot[$i]."</option>\n";
							
      						}
					 		     	
								
							}			
							echo "</select></center></td>\n\n";
				    		?>
					 
					   
					    
					    	
					    	<td><center>
					    		<select>
					    			<option value = ''>--SUBSLOT--</option>
					    		</select>
					    	</center></td>
					    	<td><center><img src='../images/add.png' onclick='document.wdm.altatj.value="altatj";document.wdm.submit();'></center></td>
				        </tr>
				    </tbody>
		        </table>

		        <!--  Tarjetas Configuradas -->
		        <?
		        $tj_cargadas=mysql_query("SELECT
														*
										FROM
											inventario_tarjetas_wdm
										WHERE
											wdm = '$wd'
										AND id_nodo = '".$id_nodo."'
										ORDER BY
											repisat,
											posicion_tarjeta
											 + 0");
		       
		    
		        ?>
		        <br><label><strong>Tarjetas Configuradas</strong></label>
		        <br>
		
		        <table id = 'trj' >
	        		<thead>
	        			<tr>
				        	<th>Repisa</th>
				            <th>Slot</th>
				        	<th>Subslot</th>
				        	<th>Modelo</th>				        		        	
				         	<th>Agregar/Borrar</th>
				        </tr>
				    </thead>
				    <tbody>
				    	
				    		<?
				    			while($rt = mysql_fetch_array($tj_cargadas)){
				    				echo "<tr title='Click para ver los puertos de esta tarjeta' 
													onmouseover='this.className=\"over\";'
													onmouseout='this.className=\"out\";'
													onclick='document.wdm.verpuertos.value=1;
													document.wdm.repisat2.value=\"".$rt['repisat']."\";
													document.wdm.modelo_tarjeta2.value=\"".$rt['modelo_tarjeta']."\";
													document.wdm.slot2.value=\"".$rt['posicion_tarjeta']."\";
													document.wdm.subslot2.value=\"".$rt['subslot']."\";
													document.wdm.tipoequipo.value=\"a\";
													document.wdm.id.value=\"$id\";
													document.wdm.submit()' 
				    				><td><center>".$rt['repisat']."</center></td>";
				    				echo "<td><center>".$rt['posicion_tarjeta']."</center></td>";
				    				echo "<td><center>".$rt['subslot']."</center></td>";
				    				echo "<td><center>".$rt['modelo_tarjeta']."</center></td>";   				
				    				
				    				if($rt['gestionada'] == "GESTIONADA"){
				    				echo "<td><center>P. GEST.</center></td>";
				    				}else{
				    				echo "<td><center>NO GEST.</center></td>";	
				    				}

				    			}
				    		?>
				    	
				    </tbody>
				</table>

					
	     
   		    </div>
   	    </div></br>

   	    <!--  Tabla de Puertos -->
   	    <? //if($verpuertos == 1){
	   	    //$verptos = 'display:block';
	   	//}else{
	   	//	$verptos = 'display:none';
   	    //}?>
   	     <div id = 'infpuertos' style = '<?echo $verptos?>'>
	   	    	<div class = 'field'>
	        		<label class = 'tituloPrincipal'><center><strong>Informaci&oacute;n de Puertos</strong></center></label>
	       		</div></br>
	
	   	</div>

	   	<!-- RCDT -->
	   	
		<!-- Imagen -->
<div id='imagen'>
<?php

if ($wd=="") exit; 

//$qwdm=mysql_query("select siglas_central,repisa,tipo_wdm,id ,nodo_adm_conex_adsl,ip_gestion,id_nodo,estatus_cns from cat_wdm where wdm='$wd' and repisa like 'WDM%' order by substr(repisa,locate(' ',repisa)+1)+0;");
$qwdm=mysql_query("SELECT siglas_central,repisa,tipo_wdm,cat_wdm.id ,nodo_adm_conex_adsl,ip_gestion,cat_wdm.id_nodo,estatus_cns,count(posicion_tarjeta) as ptos , cat_wdm.neid FROM cat_wdm left join inventario_puertos_wdm on cat_wdm.id_nodo=inventario_puertos_wdm.id_nodo where cat_wdm.wdm='$wd' and repisa like '%WDM%' group by siglas_central,repisa,tipo_wdm,cat_wdm.id ,nodo_adm_conex_adsl,ip_gestion,cat_wdm.id_nodo,estatus_cns order by substr(repisa,locate(' ',repisa)+1)+0");
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
	$neidwdm[$j]=mysql_result($qwdm,$i,9);
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
$altoimg=900;
if(substr($tipoequipo,0,1)=="e") $altoimg=900;
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


echo "<center><img src='wdm.php?muestra=1&wd=$wd&exportar=$exportar&tipoequipo=$tipoequipo' usemap='#wdm'></center>\n\n";
echo "<map name='wdm'>";
echo "<area shape='rect'  href='#' coords='10, 10, 40, 40' alt='Exportar Topolgico' title='Exportar Topolgico' 
OnClick='crearImagen=window.open(\"wdm.php?wd=$wd&exportar=1\",\"\",\"width=50,height=50\");'>";



$sql6 = "SELECT clli_equipo, repisa FROM cat_wdm WHERE wdm !='' AND wdm='$wd' ORDER BY LENGTH(repisa),repisa";								

$query6 = mysql_query($sql6);	

for ($a=0;$a<$cwdm;$a++)
{
	$n=$a+1;
	$m=$a-1;
	if($a==0) $m=$cwdm-1;
	//if($a==$cwdm-1) $n=0;

	$n0=$a+1;
	$n1=$n0-1;
	$n2=$n0+1;
	if($n0==$cwdm) $n2=1;
	if($n0==1)     $n1=$cwdm;



	$xa1=$xa+($a*$def);
	$ya1=$ya;
	$xa2=$xa1+$anchoa;
	$ya2=$ya1+$altoa;
	if ($repwdm[$a]=="") $rep="NO ASIGNADO";
	else $rep=$repwdm[$a];
	 $_SESSION["wdm$a"]="$sigwdm[$a]|$rep|$xa1|$ya1|$xa2|$ya2|$nodowdm[$a]|$idwdm[$a]|$ipgwdm[$a]|$idnwdm[$a]|$cnswdm[$a]|$neidwdm[$a]";
	//echo $_SESSION["wdm$a"];

	/****** Nodos repetidos *************/
	$cllis[] =  mysql_result($query6,$a,0);
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
			$wdmRep[$y] =  mysql_result($queryRepetido,$y,0);
			$coorx = $xa1+$suma;
			$coory = $ya1a-33;
			$coorx2 = $xa2-65+$suma;
			$coory2 = $ya2-65;
			echo "<area shape='rect' coords='$coorx, $coory, $coorx2, $coory2' alt='$wdmRep[$y]' id='cuadroAzul' title='$wdmRep[$y]' onclick='abrirNueva(\"".$wdmRep[$y]."\")' href='#'>\n";
			$suma+=12;
		}
	}
	
	$ya1a=$ya1+10;
	$ya2a=$ya2+10;	
	
        echo "<area shape='rect' coords='$xa1, $ya1a, $xa2, $ya2' alt='Nodo WDM $n' title='Nodo WDM $n' OnClick='document.wdm.tipoequipo.value=\"a$n\";document.wdm.siglas.value=\"$sigwdm[$a]\";document.wdm.id.value=\"$idwdm[$a]\";document.wdm.ido.value=\"\";document.wdm.idd.value=\"\";document.wdm.cambionodo.value=1;document.wdm.submit();' href='#'>\n";

	$xwnwa1=$xa1;
	$ywnwa1=$ya1+($altoa/2)-5;
	$xwnwa2=$xa1-7;
	$ywnwa2=$ya1+($altoa/2)+5;
	if(trim($ipgwdm[$a])<>"" and trim($ipgwdm[$m])<>"" and trim($ptowdm[$a])>0 and trim($ptowdm[$m])>0) echo "<area shape='rect' coords='$xwnwa1, $ywnwa1, $xwnwa2, $ywnwa2' alt='Secci&oacute;n WDM $n1 - WDM $n0' title='Secci&oacute;n WDM $n1 - WDM $n0' OnClick='document.wdm.tipoequipo.value=\"ed".$n1."d$n0\";document.wdm.id.value=\"$idwdm[$a]\";document.wdm.ido.value=\"$idwdm[$m]\";document.wdm.idd.value=\"$idwdm[$a]\";document.wdm.trayectoria.value=\"01\";document.wdm.cambionodo.value=1;document.wdm.submit();' href='#'>\n";    //Cuadro izquierdo

	$xwawn1=$xa1+$anchoa+1;
	$ywawn1=$ya1+($altoa/2)-5;
	$xwawn2=$xa1+$anchoa+8;
	$ywawn2=$ya1+($altoa/2)+5;
	if(trim($ipgwdm[$a])<>"" and trim($ipgwdm[$n])<>"" and trim($ptowdm[$a])>0 and trim($ptowdm[$n])>0) echo "<area shape='rect' coords='$xwawn1, $ywawn1, $xwawn2, $ywawn2' alt='Secci&oacute;n WDM $n0 - WDM $n2' title='Secci&oacute;n WDM $n0 - WDM $n2' OnClick='document.wdm.tipoequipo.value=\"ed".$n0."d$n2\";document.wdm.id.value=\"$idwdm[$a]\";document.wdm.ido.value=\"$idwdm[$a]\";document.wdm.idd.value=\"$idwdm[$n]\";document.wdm.trayectoria.value=\"01\";document.wdm.cambionodo.value=1;document.wdm.submit();' href='#'>\n";    //Cuadro derecho


	$xwr1=$xa1-5+($anchoa/2);
	$ywr1=$ya1-5;
	$xwr2=$xa1+5+($anchoa/2);
	$ywr2=$ya1+5;
	if(trim($ipgwdm[$a])<>"") echo "<area shape='rect' coords='$xwr1, $ywr1, $xwr2, $ywr2' alt='Secci&oacute;n WDM $n - RCDT' title='Secci&oacute;n WDM $n - RCDT' OnClick='document.wdm.tipoequipo.value=\"ed".$n."r1\";document.wdm.id.value=\"$idwdm[$a]\";document.wdm.ido.value=\"$idwdm[$a]\";document.wdm.idd.value=\"$idwdm[$a]\";document.wdm.cambionodo.value=1;document.wdm.submit();' href='#'>\n";


	if($cwdm>=5) $defy=35;
	if($cwdm<=4) $defy=20;
	
	if($a==0 and substr($tipoequipo,0,2)=="ed")
	{
		$frecmaxmin=mysql_query("SELECT frecuencia from lambda where tipo='$tecnologia' and frecuencia>=(select min(frecuencia) from inventario_puertos_wdm where wdm='$wd' and puerto like '_C' and frecuencia>0 order by frecuencia) and frecuencia<=(select max(frecuencia) from inventario_puertos_wdm where wdm='$wd' and puerto like '_C' and frecuencia>0 order by frecuencia)");
		$lfrecmm=mysql_num_rows($frecmaxmin);

		for($lam=0;$lam<$lfrecmm;$lam++)
		{
			$frecd=mysql_result($frecmaxmin,$lam,0);
			$xlam1=$xa1+40;
			$ylam1=$ya+173+($lam*$defy);
			$xlam2=$xa1+100;
			$ylam2=$ya+183+($lam*$defy);
			
			echo "<area shape='rect' coords='$xlam1, $ylam1, $xlam2, $ylam2' alt='Ver Detalle $frecd' title='Ver Detalle $frecd' OnClick='document.wdm.tipoequipo.value=\"el".$frecd."\";document.wdm.submit();' href='#'>\n";    //Link para detalle de lambda
		}
	}


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

if ($avisocns==1) echo "<script>alert('El WDM  esta en proceso por CNS I.\\nNo puede ser modificado por el momento');</script>";
if ($avisocnsnodo==1) echo "<script>alert('El NODO esta en proceso por CNS I.\\nNo puede ser modificado por el momento');</script>";



?>
</div>

	</form>
	</body>
</html>