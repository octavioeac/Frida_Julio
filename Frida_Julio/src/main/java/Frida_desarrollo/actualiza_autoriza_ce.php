<?php
include_once("perfiles.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type='text/javascript' src='./js/myscripts.js'></script>
	<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
	<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body>

<div id=espere style='position:absolute;top:50%;left:45%;visibility:hidden'><img src='./images/espere.gif' width=32 height=32></div> 

<div id="wrap">
	<div id="header">
		<div id="logo">
			<h1><a href="inicio.php">F R I D A</a></h1>
			<h2>Actualizaci&oacute;n de Cluster</h2>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
		</div>
	</div>
</div>

<div id="wrap">

<?php
require("conexion.php");

	//$pagina="http://frida/infinitum/autoriza_captura_cluster.php";
	$pagina="http://frida2/desarrollo/infinitum_v2/autoriza_captura_cluster.php";

	$id_autoriza=$_REQUEST['id_aut_sel'];

	$ot_selected=$_REQUEST['ot_sel'];
	$anillo_selected=$_REQUEST['anillo_sel'];
	$nodo_selected=$_REQUEST['nodo_sel'];
	$tarjeta_selected=$_REQUEST['tarjeta_sel'];
	$subslot_selected=$_REQUEST['subslot_sel'];
	$nvo_edo_cns_sel=$_REQUEST['nvo_edo_cns'];
	$nom_central=$_REQUEST['nom_central_sel'];
	$nvo_pto=$_REQUEST['nvo_pto_actualiza'];
	$pto_gestion=$_REQUEST['pto_gest'];
	$pto_act=$_REQUEST['pto_actualiza'];
	
	/*
	echo "<br>".$id_autoriza;

	echo "<br>".$ot_selected;
	echo "<br>".$anillo_selected;
	echo "<br>".$nodo_selected;
	echo "<br>".$tarjeta_selected;
	echo "<br>".$subslot_selected;
	echo "<br>".$nvo_edo_cns_sel;
	echo "<br>".$nom_central;
	echo "<br>".$nvo_pto;
	echo "<br>".$pto_gestion;
	echo "<br>".$pto_act;
	*/
	
	if ( $id_autoriza=='1' ){
		
		echo '<script type="text/javascript">';
			echo '{';
				echo 'window.location.replace("'.$pagina.'?id_ot='.$ot_selected.'&nodo_sel='.$nodo_selected.'&nom_central_sel='.$nom_central.'")';
			echo '}';
		echo '</script>';
		
	}elseif ( $id_autoriza=='2' ){
		
		$query_edo = "UPDATE cat_anillo SET estatus_cns='".$nvo_edo_cns_sel."' WHERE anillo='".$anillo_selected."' AND id_nodo='".$nodo_selected."'";
		$result_edo = mysql_query($query_edo);
		//echo $query_edo;
		
		echo '<script type="text/javascript">';
			echo '{';
				echo 'window.location.replace("'.$pagina.'?id_ot='.$ot_selected.'&nodo_sel='.$nodo_selected.'&nom_central_sel='.$nom_central.'")';
			echo '}';
		echo '</script>';
		
	}elseif ( $id_autoriza=='3' ){
		
		echo '<script type="text/javascript">';
			echo '{';
				echo 'window.location.replace("'.$pagina.'?id_ot='.$ot_selected.'&nodo_sel='.$nodo_selected.'&nom_central_sel='.$nom_central.'&tarjeta_sel='.$tarjeta_sel.'&subslot_sel='.$subslot_selected.'")';
			echo '}';
		echo '</script>';
		
	}elseif ( $id_autoriza=='4' ){		// CAMBIO DE ESTADO EN LOS PUERTOS
		
		$query_Prev = "SELECT estatus FROM inventario_puertos_ce WHERE puerto='".$nvo_pto."' AND id_nodo='$nodo_selected' AND posicion_tarjeta='$tarjeta_selected'";
		echo "<br><br>".$query_prev;
		
		$result_pre = mysql_query($query_Prev);
		$rowPre = mysql_fetch_array($result_pre, MYSQL_ASSOC);
		$estatus_pre = $rowPre['estatus'];
		
		
		if ( $subslot_selected == 'N/A' ){
			$campo_ss = '';
		}else{
			$campo_ss = "AND subslot='$subslot_selected'";
		}
		
		if ( $estatus_pre == 'RESERVADO' AND $pto_gestion == 'GESTIONADO' AND substr($nvo_pto, -1) == "G"){
			
			$queryNvo_EdoPuertos_ce = "UPDATE inventario_puertos_ce SET estatus='OCUPADO', gestionada='$pto_gestion' WHERE puerto='".$nvo_pto."' AND cluster='$anillo_selected' AND id_nodo='$nodo_selected' AND posicion_tarjeta='$tarjeta_selected' $campo_ss";
		}else{
				$queryNvo_EdoPuertos_ce = "UPDATE inventario_puertos_ce SET gestionada='$pto_gestion' WHERE puerto='".$nvo_pto."' AND cluster='$anillo_selected' AND id_nodo='$nodo_selected' AND posicion_tarjeta='$tarjeta_selected' $campo_ss";
		}
		
		//echo $queryNvo_EdoPuertos_ce;
		$result_ep = mysql_query($queryNvo_EdoPuertos_ce);
		
		echo '<script type="text/javascript">';
			echo '{';
				echo 'window.location.replace("'.$pagina.'?id_ot='.$ot_selected.'&nodo_sel='.$nodo_selected.'&nom_central_sel='.$nom_central.'&tarjeta_sel='.$tarjeta_sel.'&subslot_sel='.$subslot_selected.'")';
			echo '}';
		echo '</script>';
		
	}else{
		echo "Solo: ".$id_autoriza;
	}
	
?>

</div>
</body>
</html>
