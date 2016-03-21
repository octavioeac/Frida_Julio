<?php	
require("perfiles.php");
require("conexion.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type='text/javascript' src='./js/myscripts.js'></script>
		<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
		<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
		<style type="text/css">
		<!--
		#pie {
		text-align: center;
		font-size: 11px;
		color: #aaa;
		margin-top: 40px;
		padding-top: 10px;
		padding-bottom: 10px;
		}-->
		</style>
	</head>

	<body>
		<div id=espere style='position:absolute;top:50%;left:45%;visibility:hidden'><img src='./images/espere.gif' width=32 height=32></div> 
			<div id="wrap">
				<div id="header">
					<div id="logo">
						<h1><a href="grid_ordenes_se.php">F R I D A</a></h1><h2>Informaci&oacute;n</h2>
					</div>
					<div id="rss"></div> 
				</div>
			</div>
		<div id="wrap">

<?php

$liq 				= $_REQUEST['liq'];
$num_ot_frida   	= $_REQUEST['id_ot'];

$num_ot_frida   	= $_REQUEST['id_ot'];
$tecnico 			= $_REQUEST['tecnico'];
$personal 			= $_REQUEST['personal'];
$observ 			= $_REQUEST['observ'];
$tabla 				= $_REQUEST['tabla'];  
$id_tablaInv 		= $_REQUEST['id_tabla'];
$nombre_oficial_pisa = $_REQUEST['nombre_oficial_pisa'];
$trafico 			= $_REQUEST['trafico'];
$proveedor_tx 		= $_REQUEST['proveedor_tx'];
$id_nodo            = $_REQUEST['id_nodo'];
$causa_sel          = $_REQUEST['causa_sel'];
$num_intervencion   = $_REQUEST['num_intervencion'];
$num_ot_cambio      = $_REQUEST['num_ot_frida'];  
$motivoMig          = $_REQUEST['motivoMig'];
 

if ($liq=="EJECUTADA CON PRUEBAS") $personal=$sess_nmb;

if ($liq=='SAVE_OBS'){
	
	$query_save =" UPDATE ordenes SET observaciones=CONCAT('|',NOW(),', USUARIO: $sess_usr',', OBSERVACIONES: $observ\\n',observaciones) WHERE id_ot='$num_ot_frida'";
	$cambios    =mysql_query("UPDATE inventario_puertos_ce_cambios SET observaciones_cambio = CONCAT('|',NOW(),', USUARIO: $sess_usr',', OBSERVACIONES: $observ\\n',observaciones_cambio)
								WHERE num_ot_cambio = '$num_ot_cambio'"); 
	//echo $query_save;
	$qgrid_n=mysql_query($query_save);
	
	
}elseif(!$num_ot_frida) 
    $errorq.="ERROR: Falta numero de RF <br><br>";
elseif($liq=="AUTORIZADA" and !$tecnico)
	$errorq.="ERROR: Falta Asignación del Tecnico <br><br>"; 
elseif($liq=="LIQUIDADA" and !$tecnico)
	$errorq.="ERROR: No ha sido Autorizada la RF<br><br>"; 	
elseif($liq=="LIQUIDADA" and !$personal)
	$errorq.="ERROR: Falta nombre del personal que Liquida <br><br>"; 		
elseif($liq=="RECHAZADA" and !$personal)
	$errorq.="ERROR: Falta nombre del personal que Liquida como Rechazo<br><br>";
elseif($liq=="RECHAZADA" or $liq=='EJECUTADA SIN EXITO')
{
	if ($_POST['causa_sel']!=''){

	foreach ($causa_sel as $causa) {
		$causas .= $causa . ". ";
	}
	 $queryR = "UPDATE  ordenes SET causa = '$causas', estatus='$liq',fecha_ejec = NOW(),fecha_liq = NOW(), observaciones=CONCAT('|',NOW(),', USUARIO: $sess_usr',', OBSERVACIONES: $observ\\n',observaciones) WHERE id_ot = $num_ot_frida";
	 mysql_query($queryR);
	 $cambios = mysql_query("UPDATE inventario_puertos_ce_cambios SET estatus_cns = '$liq', observaciones_cambio = CONCAT('|',NOW(),', USUARIO: $sess_usr',', OBSERVACIONES: $observ\\n',observaciones_cambio), fecha_liquidacion_cambio = NOW()
		 							where num_ot_cambio = '$num_ot_cambio'");
	
	 #regresa estatus **
	 $bPuerto = mysql_query("SELECT * FROM inventario_puertos_ce_cambios WHERE num_ot_cambio = '$num_ot_cambio'");
	 while($rPuerto = mysql_fetch_array($bPuerto)){

	 	   $backStatus = mysql_query("UPDATE inventario_puertos_ce 
	 	   	                               SET gestionada = '".$rPuerto['gestionada']."'
	 	   	                               WHERE id = '".$rPuerto['id']."'");
	 }		
	}
	else	{echo "<script> alert('Seleccione las Causas de Rechazo.');  window.location.href='autoriza_captura_seccion.php?id_ot=$id_ot'; </script>"; }
} 		
else {

    if ($liq=="AUTORIZADA")
	  {
	    $query = "UPDATE ordenes SET tecnico='$tecnico', estatus='$liq', observaciones = CONCAT('|',NOW(),', USUARIO: $sess_usr',', OBSERVACIONES: $observ\\n',observaciones)  WHERE id_ot='$num_ot_frida'";
		
		$cambios = mysql_query("UPDATE inventario_puertos_ce_cambios SET estatus_cns = '$liq', observaciones_cambio = 'CONCAT('|',NOW(),', USUARIO: $sess_usr',', OBSERVACIONES: $observ\\n',observaciones_cambio)'
	 								where num_ot_cambio= '$num_ot_cambio'");
  
		
	  }	 
   /*if(($liq == "LIQUIDADA" && $totGest != 0) || ($liq == "EJECUTADA SIN PRUEBAS" && $totGest != 0) || ($liq == "EJECUTADA CON PRUEBAS" && $totGest != 0) ){
			echo "<script> alert('Todos los puertos deben estar GESTIONADOS para liquidar.');  window.location.href='autoriza_captura_bajaPuerto.php?id_ot=$id_ot'; </script>";
	}*/
	
  	if ($liq=="LIQUIDADA" or $liq=="EJECUTADA CON PRUEBAS"  or$liq == "EJECUTADA SIN PRUEBAS" ){

  		  $queryL = mysql_query("UPDATE ordenes SET fecha_liq=NOW(), personal='$personal', estatus='$liq',observaciones=CONCAT('|',NOW(),', USUARIO: $sess_usr',', OBSERVACIONES: $observ\\n',observaciones) ,fecha_ejec=NOW()  WHERE id_ot='$num_ot_frida'");
  		
		 //---------------->Actualiza Fecha en Inventario Puertos Ce Cambios

		
		$fechaL = mysql_query("UPDATE inventario_puertos_ce_cambios SET estatus_cns= '$liq',fecha_liquidacion_cambio = NOW(), observaciones_cambio = CONCAT('|',NOW(),', USUARIO: $sess_usr',', OBSERVACIONES: $observ\\n',observaciones_cambio)WHERE num_ot_cambio = '$num_ot_cambio'  ");
		
		//if($queryL){

			$cuentaPto = explode(',', $motivoMig);


			foreach ($cuentaPto as $numTroncales){

				$paresPtos = explode('-', $numTroncales);
			    $parOrigen  = $paresPtos[0];
				$parDestino = $paresPtos[1];

				$nOrigen     = mysql_query("SELECT id_nodo,cluster,pto_troncal FROM inventario_puertos_ce WHERE id = '".$parOrigen."'");
				$rOrigen     = mysql_fetch_array($nOrigen);
				$nodo_origen = $rOrigen['id_nodo'];
				$cluster_o   = $rOrigen['cluster'];
				$troncal_origen   = $rOrigen['pto_troncal'];

				$nDestino     = mysql_query("SELECT id_nodo,cluster,pto_troncal FROM inventario_puertos_ce WHERE id = '".$parDestino."'");
				$rDestino     = mysql_fetch_array($nDestino);
				$nodo_destino = $rDestino['id_nodo'];
				$troncal_destino = $rDestino['pto_troncal'];
				
				$cortaNodo    = explode('-',$nodo_origen);
				$cortaDos     = explode('-',$nodo_destino);

				$troncalUno   = $cortaNodo[1].'-'.$cortaDos[1];
				$troncalDos   = $cortaDos[1].'-'.$cortaNodo[1];

				#libera los puertos de las secciones de ambos lados de la conexion
				$backUno = mysql_query("UPDATE inventario_puertos_ce 
	 	   	                               SET gestionada = 'GESTIONADO',
	 	   	                               estatus = 'DISPONIBLE',
	 	   	                               pto_troncal = '',
	 	   	                               nombre_oficial_pisa_ant = '".$troncal_origen."'
	 	   	                               WHERE id = '".$parOrigen."'");
			
				$backUno = mysql_query("UPDATE inventario_puertos_ce 
 	   	                               SET gestionada = 'GESTIONADO',
 	   	                               estatus = 'DISPONIBLE',
 	   	                               pto_troncal = '',
 	   	                               nombre_oficial_pisa_ant = '".$troncal_destino."'
 	   	                               WHERE id = '".$parDestino."'");
				
				#Guarda respaldo de secciones
				$rspSeccion = mysql_query("INSERT INTO secciones_ce_mig
					                          SELECT * FROM secciones_ce_mig
					                          WHERE anillo = '$cluster_o'
					                          AND desc_nominter_troncal_d = '".$troncal_origen."'");
		
				
				#Elimina registro de secciones_ce

				$dltSeccion = mysql_query("DELETE FROM secciones_ce  WHERE anillo = '$cluster_o'
					                          AND desc_nominter_troncal_d = '".$troncal_origen."'");

	
			}
				#cuenta secciones restantes del nodo origen
				$arrSecciones = array("01","02","03","04"); #Secciones posibles.
				$sqlCuenta = mysql_query("SELECT pto_troncal FROM inventario_puertos_ce WHERE cluster = '".$cluster_o."'
					                          AND pto_troncal LIKE '".$troncalUno."%' ORDER BY  pto_troncal ASC");
				$cuentaTroncal = mysql_num_rows($sqlCuenta);
				
				while($rCuenta = mysql_fetch_array($sqlCuenta)){

					  $modTroncal = explode('-', $rCuenta['pto_troncal']);
					  if(sizeof($modTroncal) == 3){
					  	$conTroncal = '01';
					  	$tdestino   = $modTroncal[1].'-'.$modTroncal[0].'-'.$modTroncal[2];
					  }else{
					  	$conTroncal = $modTroncal[3];
					  	$tdestino   = $modTroncal[1].'-'.$modTroncal[0].'-'.$modTroncal[2].'-'.$modTroncal[3];
					  }
					#corta el arreglo de acuerdo al numero de secciones restantes 
					$arrSecciones = array_slice($arrSecciones, 0,$cuentaTroncal);

					foreach ($arrSecciones as $reEtiq) {
						# comparamos el consecutivo actual para saber si se re- etiqueta o no
						if($reEtiq != $conTroncal){

							#Reetiquetado en inventario puertos ce
							$nuevoTroncal = $modTroncal[0].'-'.$modTroncal[1].'-'.$modTroncal[2].'-'.$reEtiq;
							$ndestinos     = explode('-',$tdestino);
							$nuevodestino = $ndestinos[0].'-'.$ndestinos[1].'-'.$ndestinos[2].'-'.$reEtiq;

							$origenT = mysql_query("UPDATE inventario_puertos_ce
							                         SET pto_troncal = '".$nuevoTroncal."'
							                             WHERE id_nodo = '".$nodo_origen."'
							                             AND pto_troncal = '".$rCuenta['pto_troncal']."'");

							$destinoT = mysql_query("UPDATE inventario_puertos_ce
						                               SET  pto_troncal = '".$nuevodestino."'
						                                    WHERE id_nodo = '".$nodo_destino."'
						                                    AND pto_troncal = '".$tdestino."'");
							#Re-etiqueta la seccion 

							$seccion   =mysql_query("UPDATE secciones_ce
								                        SET desc_nominter_troncal_d = '".$nuevoTroncal."',
								                            desc_nominter_troncal_a = '".$nuevodestino."',
								                            trayectoria = '".str_replace('0', '', $reEtiq)."'
								                        WHERE anillo = '".$cluster_o."'
								                              AND id_nodo_d  = '".$nodo_origen."'
								                              AND id_nodo_a  = '".$nodo_destino."'
								                              AND desc_nominter_troncal_d = '".$rCuenta['pto_troncal']."'");
					

						}
					}
				}
			



			


}
   if ($liq=="EJECUTADA SIN PRUEBAS"  or $liq=="EJECUTADA SIN EXITO")
	  {
	       $query = "UPDATE ordenes SET estatus='$liq',observaciones=CONCAT('|',NOW(),', USUARIO: $sess_usr',', OBSERVACIONES: $observ\\n',observaciones),fecha_ejec=NOW()  WHERE id_ot='$num_ot_frida'";
//		   echo "<br>$query"; 
	     $queryM =mysql_query("UPDATE inventario_puertos_ce_cambios  SET  estatus_cns ='$liq', observaciones_cambio = CONCAT('|',NOW(),', USUARIO: $sess_usr',', OBSERVACIONES: $observ\\n',observaciones_cambio)  WHERE num_ot_cambio = $num_ot_frida");		 

	  }

    $qgrid=mysql_query($query);
}


if(!$queryL){
	
$errorq.="MYSQL_ERROR : ".mysql_error()."<br><br>";
}
   
    //@$qgrid=mysql_query($query);
    //if(!$qgrid) $errorq.="MySQL ERROR: ".mysql_error()." <br><br>";    

if (strip_tags($errorq)=="") echo "<br><b>Datos almacenados correctamente. $mes </b><br><br>";
else   echo "<font color=red><b>$errorq</b></font>";

?>
<FORM name="return" method="get" action="grid_autoriza_cluster.php?areares=1">
<INPUT type="submit"  VALUE='Regresar' >
</FORM> 
</div>
<div id="content"></div>
<div style="clear: both;"> </div>

</div>
</body>
</html>
<script>document.getElementById('espere').style.visibility='hidden';</script>