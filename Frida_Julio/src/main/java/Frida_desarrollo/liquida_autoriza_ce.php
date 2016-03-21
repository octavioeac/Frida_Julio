<?php
include_once("perfiles.php");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<script type='text/javascript' src='./js/myscripts.js'></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<style type="text/css">
<!--

#pie {
text-align: center;
font-size: 11px;
color: #aaa;
margin-top: 40px;
padding-top: 10px;
padding-bottom: 10px;
}	

-->
</style>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>
<body>

<!--BROKER ---------------------------- IBM -->


<?php
echo " <input type='hidden' id='nom_cluster' name='nom_cluster' value=". $_REQUEST['nom_cluster'].">";
?>
<script>

 var JsonObject={"otId":$("#nom_cluster").val(), "tipoElemnto":"NODO"};
				    var JsonData=JSON.stringify(JsonObject);	 
					  $.ajax({
		          url:'http://10.105.59.73:8082/fridaSendARM/equipo',
          type:'POST',
         dataType:'json',
		 data:JsonData,
         contentType:'application/json',
           success: function(data){
             console.log(data);  
              
           }
		       });
    
</script>
<!--BROKER ---------------------------- IBM -->

<div id=espere style='position:absolute;top:50%;left:45%;visibility:hidden'><img src='./images/espere.gif' width=32 height=32></div> 

<div id="wrap">
<div id="header">
	<div id="logo">
		<h1><a href="inicio.php">F R I D A</a></h1>
		<h2>Autorizaci&oacute;n de Cluster</h2>
		<p>&nbsp;</p>
	  <p>&nbsp;</p>
    </div>
	<div id="rss"></div> 
  </div>
</div>

<div id="wrap">

<?php
require("conexion.php");
$liq=$_REQUEST['liq'];
$id_ot=$_REQUEST['id_ot'];
$num_ot_frida=$_REQUEST['num_ot_frida'];
$tecnico=$_REQUEST['tecnico'];
$personal=$_REQUEST['personal'];
$observ=$_REQUEST['observ'];
$tabla=$_REQUEST['tabla'];  
$nombre_oficial_pisa=$_REQUEST['nombre_oficial_pisa'];
$trafico=$_REQUEST['trafico'];
$videorequest=$_REQUEST['video'];
$fecha_prog1=$_REQUEST['fecha_prog1'];
$hora_prog1=$_REQUEST['hora_prog1'];
$videopost=$_POST['video'];
$numero_orden=$_POST['num_ot_frida'];
echo"<br>orden:$numero_orden";
echo"<br>t&eacute;cnico:$tecnico";

$txr_d = $_REQUEST['tx_real_d'];
$rxr_d = $_REQUEST['rx_real_d'];
$txr_a = $_REQUEST['tx_real_a'];
$rxr_a = $_REQUEST['rx_real_a'];
$s_id = $_REQUEST['id_reg_nodo'];

$causa_r = $_REQUEST['causa_r'];
$w_origen = $_REQUEST['w_origen'];



$telefono=mysql_result(mysql_query("SELECT telefono from cat_tecnicos where nombre='$sess_nmb'"),0,0);

if ($liq=="EJECUTADA CON PRUEBAS") $personal=$sess_nmb;

if ($personal=="") $personal=$sess_nmb;	

if ($liq=="SAVE_OBS"){
	
	$est_n=mysql_result(mysql_query("SELECT estatus from ordenes WHERE id_ot='$id_ot' LIMIT 1"),0,0);

	    $indiceTabla = array(
	        'cat_anillo'     => 'id'
	    );
	if ( $w_origen == 'rf' ){
		$regreso='OBS';
		$query_save = "UPDATE ordenes SET estatus='$est_n', estatus_top='$est_ntop', estatus_pba='$est_npba', observaciones=CONCAT('|',NOW(),' Usuario:','$personal','.- OBSERVACIONES:','$observ\\n','.- ',observaciones) WHERE id_ot='$id_ot'";
	}else{
		$query_save = "UPDATE ordenes SET estatus='$est_n', estatus_top='$est_ntop', estatus_pba='$est_npba', observaciones=CONCAT('|',NOW(),' Supervisor:','$personal','.- Tel.:','$telefono','.- OBSERVACIONES:','$observ\\n','.- ',observaciones) WHERE id_ot='$id_ot'";
	}

	
	
	$query_save2 = "UPDATE " . $_POST['tabla'] . " SET num_ot_frida='" . $_POST['num_ot_frida'] . "', observaciones=CONCAT('|',NOW(),'Tecnico asignado: ','$tecnico','.- Tel.:','$telefono','.- OBSERVACIONES:','$observ\\n',observaciones)  WHERE " . $indiceTabla[$_POST['tabla']] . "=" . $_POST['id_tabla'];

	//echo "</br>".$query_save;
	//echo "</br>".$query_save2;
	
	$qgrid_n=mysql_query($query_save);
	$qgrid_n2=mysql_query($query_save2);
	
	
}elseif (substr($liq,0,8)=='SAVE_CAM'){
	/*
	echo "GUARDAR CAMBIOS, ID: ".substr($liq,8);
	echo "<br>liq=$liq";
	echo "<br>id_ot=$id_ot";
	echo "<br>num_ot_frida=$num_ot_frida";
	echo "<br>personal=$personal";
	echo "<br>$sess_nmb";
	echo "<br>causa=$causa";
	echo "<br>observ=$observ";
	echo "<br>tabla=$tabla";
	echo "<br>nombre_oficial_pisa=$nombre_oficial_pisa";
	echo "<br>trafico=$trafico";
	echo "<br>tx_d/real: ".$txr_d;
	echo "<br>tx_a/real: ".$txr_a;
	echo "<br>rx_d/real: ".$rxr_d;
	echo "<br>rx_a/real: ".$rxr_a;
	*/
	
	$query_gc = "UPDATE secciones_ce SET tx_d='".$txr_d."', rx_d='".$rxr_d."', tx_a='".$txr_a."', rx_a='".$rxr_a."' WHERE id='".$s_id."'";
	$q_gc=mysql_query($query_gc);
	$regreso="con";
	
	//echo "<br>".$query_gc;
	//echo "<br>".$regreso;
	
		
}else{if(!$num_ot_frida) 
	    $errorq.="ERROR: Falta numero de RF <br><br>";
	elseif($liq=="AUTORIZADA" and !$tecnico)
		$errorq.="ERROR: Falta Asignación del Tecnico <br><br>"; 
	elseif($liq=="LIQUIDADA" and !$tecnico)
		$errorq.="ERROR: No ha sido Autorizada la RF<br><br>"; 	
	elseif($liq=="LIQUIDADA" and !$personal)
		$errorq.="ERROR: Falta nombre del personal que Liquida <br><br>"; 		
	elseif($liq=="RECHAZADA" and !$personal)
		$errorq.="ERROR: Falta nombre del personal que Liquida como Rechazo<br><br>"; 		
	//elseif(!$tecnico)
	//    $errorq.="ERROR: Falta nombre del tecnico <br><br>"; 
	//elseif(!$personal)
	//    $errorq.="ERROR: Falta nombre del personal que liquida <br><br>"; 
	else {
	
	    if ($liq=="AUTORIZADA")
		  {
		    $query = "UPDATE ordenes SET tecnico='$tecnico', estatus='$liq'  WHERE id_ot='$id_ot'";
			   //echo "<br>$query";
		  }
		
	    if ($liq=="LIQUIDADA" or $liq=="EJECUTADA CON PRUEBAS")
		  {
		       $query = "UPDATE ordenes SET fecha_liq=NOW(), personal='$personal', estatus='$liq',observaciones=CONCAT('|',NOW(),'.- OBSERVACIONES: -$liq-','$observ\\n','.- ',observaciones),fecha_ejec=NOW()  WHERE id_ot='$id_ot'";
			    //echo "<br>$query";
		  }
	    if ($liq=="EJECUTADA SIN PRUEBAS")
		  {
		       $query = "UPDATE ordenes SET estatus='$liq',observaciones=CONCAT('|',NOW(),'.- OBSERVACIONES: -EJECUTADA SIN PRUEBAS-','$observ\\n','.- ',observaciones),fecha_ejec=NOW()  WHERE id_ot='$id_ot'";
			   //echo "<br>$query"; 
		  }

	    if ($liq=="EJECUTADA SIN EXITO")
		  {
			if ( $causa_r=='')
			{
				echo "<script>alert(\"Favor de especificar la causa de rechazo\")</script>";
				$band_r=1;

			}else{
		       	$query = "UPDATE ordenes SET causa='$causa_r', estatus='$liq', observaciones=CONCAT('|',NOW(),'.- OBSERVACIONES: -EJECUTADA SIN EXITO-Causa:','$causa_r-','$personal-','$observ\\n','.- ',observaciones),fecha_ejec=NOW()  WHERE id_ot='$id_ot'";
			   //echo "<br>$query"; 
			}
		  }
		//echo $query;
		if ($band_r != 1){
		    $qgrid=mysql_query($query);
		    if(!$qgrid) $errorq.="MySQL ERROR: ".mysql_error()." <br><br>";
	    }
		
	    //--> Actualizar tabla de tecnologia
	    $indiceTabla = array(
	        'cat_anillo'     => 'id'
	    );
	
	     echo"<br>$liq";
		 //echo"<br>$trafico";
			
	    	if ($liq=="AUTORIZADA")
			{
	  	     $query = "UPDATE " . $_POST['tabla'] . " SET num_ot_frida='" . $_POST['num_ot_frida'] . "', fecha_estatus_cns=NOW() ". " 
			 WHERE " . $indiceTabla[$_POST['tabla']] . "=" . $_POST['id_tabla'];		 
			 //echo"<br>$query";
			} 
			
			if ($liq=="EJECUTADA SIN EXITO")
			{
		     $query = "UPDATE " . $_POST['tabla'] . " SET num_ot_frida='" . $_POST['num_ot_frida'] . "', fecha_estatus_cns=NOW() ". ", observaciones=CONCAT('|',NOW(),'OBSERVACIONES: -EJECUTADA SIN EXITO-','$observ\\n',observaciones)  WHERE " . $indiceTabla[$_POST['tabla']] . "=" . $_POST['id_tabla'];
	//		 echo"<br>$query";
			} 
			
	    	if ($liq=="LIQUIDADA" or $liq=="EJECUTADA SIN PRUEBAS" or $liq=="EJECUTADA CON PRUEBAS")
			{
			   $query = "UPDATE " . $_POST['tabla'] . " SET num_ot_frida='" . $_POST['num_ot_frida'] . "', fecha_estatus_cns=NOW() ". ", observaciones=CONCAT('|',NOW(),'OBSERVACIONES: -EJECUTADA CON PRUEBAS-','$observ\\n',observaciones)  WHERE " . $indiceTabla[$_POST['tabla']] . "=" . $_POST['id_tabla'];
	//		 echo"<br>$query";
			} 
	
	    	if ($liq=="RECHAZADA")  
	    	{  
			   $query = "UPDATE " . $_POST['tabla'] . " SET num_ot_frida='" . $_POST['num_ot_frida'] . "', fecha_estatus_cns=NOW() ". ", observaciones=CONCAT('|',NOW(),' OBSERVACIONES: -RECHAZADA- ','$observ\\n',observaciones) WHERE " . $indiceTabla[$_POST['tabla']] . "=" . $_POST['id_tabla'];
		       $query2 = "UPDATE ordenes SET observaciones=CONCAT('|',NOW(),'.- OBSERVACIONES:','$observ\\n',observaciones) WHERE id_ot='$id_ot'";
	    	   $qgrid2=mysql_query($query2);

//				echo"<br>$query";
//				echo"<br>$query2";
//			    correo();
			}
		//echo $query;
	    $qgrid=mysql_query($query);
		//echo"<br>QGRID: $qgrid";

	    if(!$qgrid) $errorq.="MySQL ERROR: ".mysql_error()." <br><br>";    
	}
	
}

if ( $regreso=='' ){
	$liga_regreso="grid_ordenes_se.php?areares=1";
}else if ($regreso=='OBS'){
	$liga_regreso="grid_ordenes_se.php?areares=1";
}else{
	$liga_regreso="autoriza_captura_cluster.php?id_ot=".$id_ot;
}

if ($band_r != 1){
	if (strip_tags($errorq)=="") echo "<br><b>Datos almacenados correctamente. $mes </b><br><br>";
	else   echo "<font color=red><b>$errorq</b></font>";
}


echo '<FORM name="return" method="get" >';
if ( $regreso == 'OBS' )
{
	$liga_regreso="grid_ordenes_se.php?areares=1";
}else{
	echo '<INPUT type="button"  VALUE="Regresar" onclick="window.location.href=\''.$liga_regreso.'\'" >';
}

echo '<INPUT type="button"  VALUE="Regresar" onclick="window.location.href=\''.$liga_regreso.'\'" >';
echo '</FORM>';

?>

</div>
<div id="content"></div>
<div style="clear: both;"> </div>

</div>
</body>
</html>
<script>document.getElementById('espere').style.visibility='hidden';</script>


<?

function correo()
{
 global $indiceTabla,$tabla,$causa,$observ,$sess_nmb; 
 
 $tabla=$_POST['tabla'];
 $causa=$_POST['causa'];
 $observ=$_POST['observ'];

 $slogin=mysql_query("select division,ciudad2,anillo from $tabla where " . $indiceTabla[$_POST['tabla']] . "=" . $_POST['id_tabla']);
 $ddmail=mysql_result($slogin,0,0);
 $areamail=mysql_result($slogin,0,1);
 $nomof=mysql_result($slogin,0,2);
 
 //SUR
if ($ddmail=="SUR") 
	{
$to=array("cborja@telmex.com");
$cc=array("cborja@telmex.com","jsterrer@telmex.com","ltsantos@telmex.com");
 	}
	
 //NOROESTE
if ($ddmail=="NOROESTE");
	{
$to=array("cborja@telmex.com");
$cc=array("cborja@telmex.com","jsterrer@telmex.com","ltsantos@telmex.com");
 	}
// if ($areamail=="MEXICALI" or $areamail=="NOGALES" or $areamail=="TIJUANA")	$to=array("cborja@telmex.com");
   
//NORTE
 if ($ddmail=="NORTE");
	{
$to=array("cborja@telmex.com");
$cc=array("cborja@telmex.com","jsterrer@telmex.com","ltsantos@telmex.com");
 	}

//CENTRO
if ($ddmail=="CENTRO");
	{
$to=array("cborja@telmex.com");
$cc=array("cborja@telmex.com","jsterrer@telmex.com","ltsantos@telmex.com");
 	}

//METRO
if ($ddmail=="METRO");
	{
$to=array("cborja@telmex.com");
$cc=array("cborja@telmex.com","jsterrer@telmex.com","ltsantos@telmex.com");
 	}

 //$to[0]="jjayala@telmex.com";
// $cc=array("cborja@telmex.com","jsterrer@telmex.com","jjayala@telmex.com");
 
 include ("smtp.php"); 

  $html = "<HTML><HEAD></HEAD><BODY>";
  $html.="<h4>El usuario '$sess_nmb' rechazo la solicitud de gestion del Cluster: $nomof</h4>";
  $html.="<h4>La causa del rechazo fue: $causa</h4>";
  $html .= "<i>Observaciones: $observ</i>";
  $html .= "<br></BODY></HTML>";

  $subject	= "La solicitud de Gestion del Cluster $nomof fue rechazada por CNS I";
  include_once ('nomad_mimemail.inc.php');
  $mimemail = new nomad_mimemail();
  $mimemail->set_smtp_host($smtp_host);
  $mimemail->set_smtp_auth($smtp_user, $smtp_pass);

  $mimemail->set_to($to[0]);

  $mimemail->set_cc($cc[0]);
  for ($d=1;$d<count($cc);$d++) $mimemail->add_cc($cc[$d]);

  $mimemail->set_subject($subject);
  $mimemail->set_html($html);
  $mimemail->set_smtp_host($smtp_host);
  $mimemail->set_smtp_auth($smtp_user, $smtp_pass);
  if ($mimemail->send())	echo "Se envio correo al solicitante del Cluster.";
  else 			  		    echo "ERROR:  Mail No enviado";
  
 

}

