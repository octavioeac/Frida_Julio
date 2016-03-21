<?php
include_once("perfiles.php");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<script type='text/javascript' src='./js/myscripts.js'></script>
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

<div id=espere style='position:absolute;top:50%;left:45%;visibility:hidden'><img src='./images/espere.gif' width=32 height=32></div> 

<div id="wrap">
<div id="header">
	<div id="logo">
		<h1><a href="inicio.php">F R I D A</a></h1>
		<h2>Autorización de Topologico</h2>
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
$num_ot_frida=$_REQUEST['id_ot'];
$tecnico=$_REQUEST['tecnico'];
$personal=$_REQUEST['personal'];
$observ=$_REQUEST['observ'];
$tabla=$_REQUEST['tabla'];  
echo $tabla;
$nombre_oficial_pisa=$_REQUEST['nombre_oficial_pisa'];
$trafico=$_REQUEST['trafico'];
$videorequest=$_REQUEST['video'];
$fecha_prog1=$_REQUEST['fecha_prog1'];
$hora_prog1=$_REQUEST['hora_prog1'];
$videopost=$_POST['video'];
$numero_orden=$_POST['num_ot_frida'];
$causa_s=$_REQUEST['causa_sel'];
echo"<br>orden:$numero_orden";
//echo"<br>video post:$videopost";
echo"<br>tecnico:$tecnico";

if ( $_REQUEST['causa_sel'] == "" ){
	$causa_r2 = "";
}else{
	$causa_r2 = implode(";",$_REQUEST['causa_sel']);
}
//echo"<br>tabla:$tabla";
//echo"<br>id_tabla:$id_tabla";
//echo"<br>num_ot_frida:$num_ot_frida";

//echo"<br>liq:".$liq;
if ($liq=="SAVE_OBS"){
	
	//echo "Pers:".$personal;
	//echo "</br>EDO-".$liq;
	
	$est_n=mysql_result(mysql_query("SELECT estatus from ordenes WHERE id_ot='$num_ot_frida' LIMIT 1"),0,0);
	$est_ntop=mysql_result(mysql_query("SELECT estatus_top from ordenes WHERE id_ot='$num_ot_frida' LIMIT 1"),0,0);
	$est_npba=mysql_result(mysql_query("SELECT estatus_pba from ordenes WHERE id_ot='$num_ot_frida' LIMIT 1"),0,0);

	    $indiceTabla = array(
	        'adva_ce'     => 'id'
	    );
	
	//echo "</br>E1:".$est_n;
	//echo "</br>E2:".$est_ntop;
	//echo "</br>E3:".$est_npba;
	$query_save = "UPDATE ordenes SET estatus='$est_n', estatus_top='$est_ntop', estatus_pba='$est_npba', observaciones_top=CONCAT(' |',NOW(),'$observ') WHERE id_ot='$num_ot_frida'";
	$query_save2 = "UPDATE " . $_POST['tabla'] . " SET observaciones_top=CONCAT(' |',NOW(),'Tecnico asignado: ','$tecnico','.- Tel.:','$telefono','.- OBSERVACIONES:','$observ\\n',observaciones_top)  WHERE " . $indiceTabla[$_POST['tabla']] . "=" . $_POST['id_tabla'];
	
	
	//echo "</br>".$query_save;
	
	$qgrid_n=mysql_query($query_save);
	$qgrid_n2=mysql_query($query_save2);
		
}else{
	
	
	if ($liq=="EJECUTADA CON PRUEBAS") $personal=$sess_nmb;
	
	if(!$num_ot_frida) 
	    $errorq.="ERROR: Falta numero de RF <br><br>";
	elseif($liq=="AUTORIZADA" and !$tecnico)
		$errorq.="ERROR: Falta Asignación del Tecnico <br><br>"; 
	elseif($liq=="LIQUIDADA" and !$tecnico)
		$errorq.="ERROR: No ha sido Autorizada la RF<br><br>"; 	
	elseif($liq=="LIQUIDADA" and !$personal)
		$errorq.="ERROR: Falta nombre del personal que Liquida <br><br>"; 		
	elseif($liq=="RECHAZADA" and !$personal)
		$errorq.="ERROR: Falta nombre del personal que Liquida como Rechazo<br><br>"; 
	elseif($liq=="RECHAZADA" and !$causa_s)
		$errorq.="ERROR: Falta especificar la causa del rechazo<br><br>"; 

	//elseif(!$tecnico)
	//    $errorq.="ERROR: Falta nombre del tecnico <br><br>"; 
	//elseif(!$personal)
	//    $errorq.="ERROR: Falta nombre del personal que liquida <br><br>"; 
	else {
	
	    if ($liq=="AUTORIZADA")
		  {
		    $query = "UPDATE ordenes SET tecnico='$tecnico', estatus='$liq', estatus_top='$liq'  WHERE id_ot='$num_ot_frida'";
			   //echo "<br>$query";
		  }
		
	    if ($liq=="LIQUIDADA" or $liq=="EJECUTADA CON PRUEBAS")
		  {
		       $query = "UPDATE ordenes SET fecha_liq=NOW(), personal='$personal', estatus='$liq', estatus_top='$liq', fecha_ejec=NOW(), observaciones_top='$observ',fecha_ejec=NOW()  WHERE id_ot='$num_ot_frida'";
			    //echo "<br>$query";
		  }
	    if ($liq=="VENTANA CLIENTE")
		  {
		       $query = "UPDATE ordenes SET fecha_liq=NOW(), personal='$personal', estatus='$liq', estatus_top='$liq', fecha_ejec=NOW(),
			    observaciones_top='$observ',fecha_ejec=NOW()  WHERE id_ot='$num_ot_frida'";
			    //echo "<br>$query";
		  }		  
	    if ($liq=="EJECUTADA SIN PRUEBAS"  or $liq=="EJECUTADA SIN EXITO")
		  {
		       $query = "UPDATE ordenes SET estatus_top='$liq', estatus='$liq ', fecha_ejec=NOW(), observaciones_top='$observ', fecha_ejec=NOW() WHERE id_ot='$num_ot_frida'";
	//		   echo "<br>$query"; 
		  }
	
	    $qgrid=mysql_query($query);
	
	    //if(!$qgrid) $errorq.="MySQL ERROR: ".mysql_error()." <br><br>";
		
	    //--> Actualizar tabla de tecnologia
	    $indiceTabla = array(
	        'adva_ce'     => 'id'
	    );
	
	     //echo"<br>$liq";
		 
		 
	//     echo"<br>$trafico";
	             $queryobs = "SELECT  observaciones_top FROM adva_ce WHERE " . $indiceTabla[$_POST['tabla']] . "=" . $_POST['id_tabla'];		
				 $observa_top=mysql_result(mysql_query($queryobs),0,0); 
				// echo"<br>queryobs:$queryobs";
			
	    	if ($liq=="AUTORIZADA")
			{
	  	     $query = "UPDATE " . $_POST['tabla'] . " SET estatus_top='AUTORIZADA " ."', fecha_estatus_top=NOW() ". ", observaciones_top=CONCAT(' | $liq ',NOW(),'.- OBSERVACIONES: AUTORIZADA','$observ\\n',observaciones_top) WHERE " . $indiceTabla[$_POST['tabla']] . "=" . $_POST['id_tabla'];		 
	//		 echo"<br>$query";
			} 
			
			if($liq=="VENTANA CLIENTE")
			{
				$query = "UPDATE " . $_POST['tabla'] . " SET estatus_top='VENTANA CLIENTE" ."', fecha_estatus_top=NOW() ". ", 
				observaciones_top=CONCAT(' | $liq ',NOW(),'.- OBSERVACIONES: VENTANA CLIENTE','$observ\\n',observaciones_top) 
				WHERE " . $indiceTabla[$_POST['tabla']] . "=" . $_POST['id_tabla'];			
			}
			
			if ($liq=="EJECUTADA SIN EXITO")
			{
		     $query = "UPDATE " . $_POST['tabla'] . " SET  estatus_top='RECHAZADA " ."', fecha_estatus_top=NOW() ". ", observaciones_top=CONCAT(' | $liq ',NOW(),' CAUSA: $causa_r2,','Tecnico asignado: ','$tecnico','.- Tel.:','$telefono','.- OBSERVACIONES: EJECUTADA SIN EXITO','$observ\\n',observaciones_top)  WHERE " . $indiceTabla[$_POST['tabla']] . "=" . $_POST['id_tabla'];
	//		 echo"<br>$query";
			   correo();
			  
			} 
			
	    	if ($liq=="LIQUIDADA" or $liq=="EJECUTADA SIN PRUEBAS" or $liq=="EJECUTADA CON PRUEBAS")
			{
			   $query = "UPDATE " . $_POST['tabla'] . " SET estatus_top='LIQUIDADA', ch_cns_top='OK " ."', fecha_estatus_top=NOW() ". ", observaciones_top=CONCAT(' | $liq ',NOW(),'Tecnico asignado: ','$tecnico','.- Tel.:','$telefono','.- OBSERVACIONES:','$observ\\n',observaciones_top)  WHERE " . $indiceTabla[$_POST['tabla']] . "=" . $_POST['id_tabla'];
			   $query_get="SELECT ref_sisa FROM ADVA_CE WHERE " . $indiceTabla[$_POST['tabla']] . "=" . $_POST['id_tabla'];
			   $ref_sisa=mysql_result(mysql_query($query_get),0,0);
			   $query_get2="SELECT id_ot FROM ordenes WHERE ref_sisa='$ref_sisa' AND num_ot_frida LIKE 'RF-PBA-%' AND tabla='adva_ce'";
			   $id_ot_pba=mysql_result(mysql_query($query_get2),0,0);
			   $query_get2B="SELECT trafico FROM adva_ce WHERE " . $indiceTabla[$_POST['tabla']] . "=" . $_POST['id_tabla'];
			   $id_ot_pbaB=mysql_result(mysql_query($query_get2B),0,0);
			//   echo "leidy:$query_get2B";
			   if($id_ot_pba<>"" && $id_ot_pbaB<>"BAJA GESTION TOPOLOGICO")
			   {
			       $query_up_pba="UPDATE ordenes SET estatus='VALIDADA' where id_ot='$id_ot_pba'";
			       //echo "<br>query_up_pba: $query_up_pba";
			       mysql_query($query_up_pba);
			   }
			   
			   $traf="SELECT trafico,tipo_solicitud from ordenes where ref_sisa='$ref_sisa' and  tabla='adva_ce' and num_ot_frida like '%RF-BTOP-%'";
			   $trafi=mysql_query($traf);
			   while ($resulta = mysql_fetch_array($trafi))
		        {
		         $trafico1=$resulta[0];	
				   $tipo_solicitud=$resulta[1];	
				
				 echo $trafico1;
				 echo $tipo_solicitud;
				// echo $liq;
				 }
				
				  }
			   if ($trafico1== 'BAJA GESTION TOPOLOGICO')
			{
			  			 
	          correo2();
	          bajavlan();
			}
	
	    	if ($liq=="RECHAZADA")  
	    	{  
			   $query = "UPDATE " . $_POST['tabla'] . " SET estatus_top='RECHAZADA " ."', fecha_estatus_top=NOW() ". ", observaciones_top=CONCAT(' | $liq ',NOW(),' CAUSA: $causa_r2,','Tecnico asignado: ','$tecnico','.- Tel.:','$telefono','.- OBSERVACIONES:','$observ\\n',observaciones_top)  WHERE " . $indiceTabla[$_POST['tabla']] . "=" . $_POST['id_tabla'];
	//			echo"<br>$query";
			    correo();
				
			}
	//Descomentar las siguientes 2 lineas para que el update funcione
		 //echo $query;
	    $qgrid=mysql_query($query);
	    //if(!$qgrid) $errorq.="MySQL ERROR: ".mysql_error()." <br><br>";    
	}
	
}


if (strip_tags($errorq)=="") echo "<br><b>Datos almacenados correctamente. $mes </b><br><br>";
else   echo "<font color=red><b>$errorq</b></font>";

?>
<FORM name="return" method="get" action="grid_autliq_adva_A.php?areares=1">
<INPUT type="submit"  VALUE='Regresar' >
</FORM> 
</div>
<div id="content"></div>
<div style="clear: both;"> </div>

</div>
</body>
</html>
<script>document.getElementById('espere').style.visibility='hidden';</script>


<?php

function correo()
{
 global $indiceTabla,$tabla,$causa,$observ,$sess_nmb,$ref_sisa; 
 
  global $indiceTabla,$tabla,$causa,$observ,$sess_nmb; 
 
 $tabla=$_POST['tabla'];
 $causa=$_POST['causa'];
 $observ=$_POST['observ'];

 $slogin=mysql_query("select division,ref_sisa from $tabla where " . $indiceTabla[$_POST['tabla']] . "=" . $_POST['id_tabla']);
 
 $ddmail=mysql_result($slogin,0,0);
 $nomof=mysql_result($slogin,0,1);
 //echo "leidy:$slogin";
 //SUR
if ($ddmail=="SUR") 
	{
		//$to=array("cborja@telmex.com","jsterrer@telmex.com");
	    //$cc=array("cborja@telmex.com","jsterrer@telmex.com");
	 $to=array("mctelcel@telmex.com","rhramos@telmex.com","jabeytia@telmex.com");
	 $cc=array("EGGONZAL@TELMEX.COM","LCARREON@TELMEX.COM","OGARCIA@TELMEX.COM","LMLARA@TELMEX.COM","JMVERA@TELMEX.COM","SBAEZ@TELMEX.COM","DFESCAMI@TELMEX.COM","MSFAJARD@TELMEX.COM","JBVENEGA@TELMEX.COM","JCHAPAG@TELMEX.COM","JCORONAD@TELMEX.COM","JGALEMAN@TELMEX.COM","HQUIJANO@TELMEX.COM","GTAMEZ@TELMEX.COM","joseo@telmex.com","earriaga@telmex.com","cborja@telmex.com","jsterrer@telmex.com","rhramos@telmex.com","JLPASTRA@telmex.com","APMAYA@telmex.com","GGAVILES@TELMEX.COM","JMORA@telmex.com");
 	}
	
 //NOROESTE
if ($ddmail=="NOROESTE")
{
	    //$to=array("cborja@telmex.com","jsterrer@telmex.com");
	    //$cc=array("cborja@telmex.com","jsterrer@telmex.com");
	   $to=array("mctelcel@telmex.com","joseo@telmex.com");
	   $cc=array("EGGONZAL@TELMEX.COM","LCARREON@TELMEX.COM","OGARCIA@TELMEX.COM","LMLARA@TELMEX.COM","JMVERA@TELMEX.COM","SBAEZ@TELMEX.COM","DFESCAMI@TELMEX.COM","MSFAJARD@TELMEX.COM","JBVENEGA@TELMEX.COM","JCHAPAG@TELMEX.COM","JCORONAD@TELMEX.COM","JGALEMAN@TELMEX.COM","HQUIJANO@TELMEX.COM","GTAMEZ@TELMEX.COM","joseo@telmex.com","earriaga@telmex.com","cborja@telmex.com","jsterrer@telmex.com","JLPASTRA@telmex.com","APMAYA@telmex.com","GGAVILES@TELMEX.COM","JMORA@telmex.com","EMONTANO@telmex.com","RAVICTOR@telmex.com","GLEON@telmex.com","MFERRA@telmex.com","BMBORBON@telmex.com","RURBY@telmex.com","JTORRES@telmex.com","ACTEQUID@telmex.com","VALENZUJ@telmex.com","CPGAMEZ@telmex.com","FMPEREZ@telmex.com","JPEREZB@telmex.com","JTARANGO@telmex.com","CRIVERA@telmex.com","FESPINO@telmex.com","LOFERNAN@telmex.com","JHNINO@telmex.com","HPALACIO@telmex.com","FMMIJARE@telmex.com","GLEON@telmex.com","FGESCUDE@telmex.com","GFGOMEZ@telmex.com","LCGARCIA@telmex.com","JTARANGO@telmex.com","CRIVERA@telmex.com","FESPINO@telmex.com","LOFERNAN@telmex.com","JHNINO@telmex.com","HPALACIO@telmex.com","FMMIJARE@telmex.com","HGGARCIA@telmex.com","RLUNAM@telmex.com","JSANDOVA@telmex.com");
}   
   
//NORTE
 if ($ddmail=="NORTE")
	{
	  //$to=array("cborja@telmex.com","jsterrer@telmex.com");
	  //$cc=array("cborja@telmex.com","jsterrer@telmex.com");
	
	  $to=array("mctelcel@telmex.com","javimtz@telmex.com"," NRLOERA@telmex.com","JMORTEGA@telmex.com","HGGARCIA@telmex.com","RLUNAM@telmex.com","JSANDOVA@telmex.com","GGMARTIN@telmex.com","EBBARON@telmex.com");
	  $cc=array("EGGONZAL@TELMEX.COM","LCARREON@TELMEX.COM","OGARCIA@TELMEX.COM","LMLARA@TELMEX.COM","JMVERA@TELMEX.COM","SBAEZ@TELMEX.COM","DFESCAMI@TELMEX.COM","MSFAJARD@TELMEX.COM","JBVENEGA@TELMEX.COM","JCHAPAG@TELMEX.COM","JCORONAD@TELMEX.COM","JGALEMAN@TELMEX.COM","HQUIJANO@TELMEX.COM","GTAMEZ@TELMEX.COM","joseo@telmex.com","earriaga@telmex.com","cborja@telmex.com","jsterrer@telmex.com","JLPASTRA@telmex.com","APMAYA@telmex.com","GGAVILES@TELMEX.COM","JMORA@telmex.com");
 	}

//CENTRO
if ($ddmail=="CENTRO")
	{
	   //$to=array("cborja@telmex.com","jsterrer@telmex.com");
	   //$cc=array("cborja@telmex.com","jsterrer@telmex.com");
	   $to=array("mctelcel@telmex.com","priosg@telmex.com","CDOMINGU@TELMEX.COM","FRCORTES@TELMEX.COM","GQVALENZ@TELMEX.COM","AECARDEN@TELMEX.COM","SSANTANA@TELMEX.COM","FANARANJ@TELMEX.COM","EBERNAL@TELMEX.COM","JTOSTADO@TELMEX.COM","MGROSALE@TELMEX.COM","BRAVOM@TELMEX.COM","ATORRESA@TELMEX.COM","AALCOCER@TELMEX.COM");
	   $cc=array("EGGONZAL@TELMEX.COM","LCARREON@TELMEX.COM","OGARCIA@TELMEX.COM","LMLARA@TELMEX.COM","JMVERA@TELMEX.COM","SBAEZ@TELMEX.COM","DFESCAMI@TELMEX.COM","MSFAJARD@TELMEX.COM","JBVENEGA@TELMEX.COM","JCHAPAG@TELMEX.COM","JCORONAD@TELMEX.COM","JGALEMAN@TELMEX.COM","HQUIJANO@TELMEX.COM","GTAMEZ@TELMEX.COM","joseo@telmex.com","earriaga@telmex.com","cborja@telmex.com","jsterrer@telmex.com","JLPASTRA@telmex.com","APMAYA@telmex.com","GGAVILES@TELMEX.COM","JMORA@telmex.com","jghernan@telmex.com","RMPARTID@telmex.com","FMICHEL@telmex.com","APCAMPOS@telmex.com","ESALGADO@telmex.com","ACROBLES@telmex.com","AYALAFJ@telmex.com","APCAMPOS@telmex.com","ESALGADO@telmex.com","AYALAFJ@telmex.com","BCAGUILE@telmex.com","FCORTES@telmex.com","PCANO@telmex.com","JBARBA@telmex.com","priosg@telmex.com","EXPDDC4@TELMEX.COM","EXPDDC6@TELMEX.COM","ACCALDER@TELMEX.COM","JOMELGOZ@TELMEX.COM","MARIOMR@TELMEX.COM","JGUERRERL@TELMEX.COM","HGGUTIER@TELMEX.COM","DACOSTA@TELMEX.COM");
    }

//METRO
if ($ddmail=="METRO")
	{
	
	   //$to=array("cborja@telmex.com","jsterrer@telmex.com");
	   //$cc=array("cborja@telmex.com","jsterrer@telmex.com");
	   $to=array("mctelcel@telmex.com","asbautis@telmex.com","cmontes@telmex.com","ogarcia@telmex.com","alejanhh@telmex.com","cosio@telmex.com","imaldona@telmex.com","aaheras@telmex.com","sestrada@telmex.com","FEDERIDC@telmex.com","MSMARTIN@telmex.com","GSCHARTU@telmex.com","NFLORES@telmex.com","DLRAMIRE@telmex.com","RLMATIAS@telmex.com", "PCALLEJA@telmex.com", "ACGUEVAR@telmex.com", "LRMONTAN@telmex.com", "MOTANEZ@telmex.com", "RBUSTAMA@telmex.com", "OTSANCHE@telmex.com");
	   $cc=array("EGGONZAL@TELMEX.COM","LCARREON@TELMEX.COM","OGARCIA@TELMEX.COM","LMLARA@TELMEX.COM","JMVERA@TELMEX.COM","SBAEZ@TELMEX.COM","DFESCAMI@TELMEX.COM","MSFAJARD@TELMEX.COM","JBVENEGA@TELMEX.COM","JCHAPAG@TELMEX.COM","JCORONAD@TELMEX.COM","JGALEMAN@TELMEX.COM","HQUIJANO@TELMEX.COM","GTAMEZ@TELMEX.COM","joseo@telmex.com","earriaga@telmex.com","cborja@telmex.com","jsterrer@telmex.com","fernanrm@telmex.com","JLPASTRA@telmex.com","APMAYA@telmex.com","GGAVILES@TELMEX.COM","JMORA@telmex.com","JRZAMORA@telmex.com","jhrevelo@telmex.com","jsterrer@telmex.com","asbautis@telmex.com","cmontes@telmex.com","ogarcia@telmex.com","alejanhh@telmex.com","cosio@telmex.com","imaldona@telmex.com","aaheras@telmex.com","sestrada@telmex.com","FEDERIDC@telmex.com","MSMARTIN@telmex.com","GSCHARTU@telmex.com","NFLORES@telmex.com","DLRAMIRE@telmex.com","RLMATIAS@telmex.com", "PCALLEJA@telmex.com", "ACGUEVAR@telmex.com", "LRMONTAN@telmex.com", "MOTANEZ@telmex.com", "RBUSTAMA@telmex.com", "OTSANCHE@telmex.com", "IGUTIERR@telmex.com", "IGMARTIN@telmex.com", "JODELGAD@telmex.com");
 	}
 
 include ("smtp.php"); 

  $html = "<HTML><HEAD></HEAD><BODY>";
  $html.="<h4>El usuario '$sess_nmb' Rechazo  el Topologico para la referencia:$nomof   </h4>";
  $html .= "<i>Observaciones: $observ</i>";
  $html .= "<br></BODY></HTML>";

$subject	= "El Topologico (CETH) para la referencia:$nomof fue rechazado por CNA";
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
  if ($mimemail->send())	echo "Se envío correo al responsable del proyecto.";
  else 			  		    echo "ERROR:  Mail No enviado";
  
 

 

}



function correo2()
{
 global $indiceTabla,$tabla,$causa,$observ,$sess_nmb; 
 
 $tabla=$_POST['tabla'];
 $causa=$_POST['causa'];
 $observ=$_POST['observ'];

 $slogin=mysql_query("select division,ref_sisa from $tabla where " . $indiceTabla[$_POST['tabla']] . "=" . $_POST['id_tabla']);
 
 $ddmail=mysql_result($slogin,0,0);
 $nomof=mysql_result($slogin,0,1);
 
 //SUR
if ($ddmail=="SUR") 
	{
//	$to=array("cborja@telmex.com","jsterrer@telmex.com");
//	    $cc=array("cborja@telmex.com","jsterrer@telmex.com");
	 $to=array("mctelcel@telmex.com","rhramos@telmex.com","jabeytia@telmex.com");
	 $cc=array("joseo@telmex.com","earriaga@telmex.com","cborja@telmex.com","jsterrer@telmex.com","rhramos@telmex.com","JLPASTRA@telmex.com","APMAYA@telmex.com","GGAVILES@TELMEX.COM","JMORA@telmex.com");
 	}
	
 //NOROESTE
if ($ddmail=="NOROESTE")
{
	  //$to=array("cborja@telmex.com","jsterrer@telmex.com");
	  //$cc=array("cborja@telmex.com","jsterrer@telmex.com");
	   $to=array("mctelcel@telmex.com","joseo@telmex.com");
	   $cc=array("joseo@telmex.com","earriaga@telmex.com","cborja@telmex.com","jsterrer@telmex.com","JLPASTRA@telmex.com","APMAYA@telmex.com","GGAVILES@TELMEX.COM","JMORA@telmex.com","EMONTANO@telmex.com","RAVICTOR@telmex.com","GLEON@telmex.com","MFERRA@telmex.com","BMBORBON@telmex.com","RURBY@telmex.com","JTORRES@telmex.com","ACTEQUID@telmex.com","VALENZUJ@telmex.com","CPGAMEZ@telmex.com","FMPEREZ@telmex.com","JPEREZB@telmex.com","JTARANGO@telmex.com","CRIVERA@telmex.com","FESPINO@telmex.com","LOFERNAN@telmex.com","JHNINO@telmex.com","HPALACIO@telmex.com","FMMIJARE@telmex.com","GLEON@telmex.com","FGESCUDE@telmex.com","GFGOMEZ@telmex.com","LCGARCIA@telmex.com","JTARANGO@telmex.com","CRIVERA@telmex.com","FESPINO@telmex.com","LOFERNAN@telmex.com","JHNINO@telmex.com","HPALACIO@telmex.com","FMMIJARE@telmex.com","HGGARCIA@telmex.com","RLUNAM@telmex.com","JSANDOVA@telmex.com");
}   
   
//NORTE
 if ($ddmail=="NORTE")
	{
	//$to=array("cborja@telmex.com","jsterrer@telmex.com");
	//$cc=array("cborja@telmex.com","jsterrer@telmex.com");
	
	$to=array("mctelcel@telmex.com","javimtz@telmex.com"," NRLOERA@telmex.com","JMORTEGA@telmex.com","HGGARCIA@telmex.com","RLUNAM@telmex.com","JSANDOVA@telmex.com","GGMARTIN@telmex.com","EBBARON@telmex.com");
	$cc=array("joseo@telmex.com","earriaga@telmex.com","cborja@telmex.com","jsterrer@telmex.com","JLPASTRA@telmex.com","APMAYA@telmex.com","GGAVILES@TELMEX.COM","JMORA@telmex.com");
 	}

//CENTRO
if ($ddmail=="CENTRO")
	{
	 //$to=array("cborja@telmex.com","jsterrer@telmex.com");
	 //$cc=array("cborja@telmex.com","jsterrer@telmex.com");
	 $to=array("mctelcel@telmex.com","priosg@telmex.com","CDOMINGU@TELMEX.COM","FRCORTES@TELMEX.COM","GQVALENZ@TELMEX.COM","AECARDEN@TELMEX.COM","SSANTANA@TELMEX.COM","FANARANJ@TELMEX.COM","EBERNAL@TELMEX.COM","JTOSTADO@TELMEX.COM","MGROSALE@TELMEX.COM","BRAVOM@TELMEX.COM","ATORRESA@TELMEX.COM","AALCOCER@TELMEX.COM");
	 $cc=array("joseo@telmex.com","earriaga@telmex.com","cborja@telmex.com","jsterrer@telmex.com","JLPASTRA@telmex.com","APMAYA@telmex.com","GGAVILES@TELMEX.COM","JMORA@telmex.com","jghernan@telmex.com","RMPARTID@telmex.com","FMICHEL@telmex.com","APCAMPOS@telmex.com","ESALGADO@telmex.com","ACROBLES@telmex.com","AYALAFJ@telmex.com","APCAMPOS@telmex.com","ESALGADO@telmex.com","AYALAFJ@telmex.com","BCAGUILE@telmex.com","FCORTES@telmex.com","PCANO@telmex.com","JBARBA@telmex.com","priosg@telmex.com","EXPDDC4@TELMEX.COM","EXPDDC6@TELMEX.COM","ACCALDER@TELMEX.COM","JOMELGOZ@TELMEX.COM","MARIOMR@TELMEX.COM","JGUERRERL@TELMEX.COM","HGGUTIER@TELMEX.COM","DACOSTA@TELMEX.COM");
    }

//METRO
if ($ddmail=="METRO")
	{
	
	//$to=array("cborja@telmex.com","jsterrer@telmex.com");
	//$cc=array("cborja@telmex.com","jsterrer@telmex.com");
	 $to=array("mctelcel@telmex.com","asbautis@telmex.com","cmontes@telmex.com","ogarcia@telmex.com","alejanhh@telmex.com","cosio@telmex.com","imaldona@telmex.com","aaheras@telmex.com","sestrada@telmex.com","FEDERIDC@telmex.com","MSMARTIN@telmex.com","GSCHARTU@telmex.com","NFLORES@telmex.com","DLRAMIRE@telmex.com","RLMATIAS@telmex.com", "PCALLEJA@telmex.com", "ACGUEVAR@telmex.com", "LRMONTAN@telmex.com", "MOTANEZ@telmex.com", "RBUSTAMA@telmex.com", "OTSANCHE@telmex.com");
	 $cc=array("joseo@telmex.com","earriaga@telmex.com","cborja@telmex.com","jsterrer@telmex.com","fernanrm@telmex.com","JLPASTRA@telmex.com","APMAYA@telmex.com","GGAVILES@TELMEX.COM","JMORA@telmex.com","JRZAMORA@telmex.com","jhrevelo@telmex.com","jsterrer@telmex.com","asbautis@telmex.com","cmontes@telmex.com","ogarcia@telmex.com","alejanhh@telmex.com","cosio@telmex.com","imaldona@telmex.com","aaheras@telmex.com","sestrada@telmex.com","FEDERIDC@telmex.com","MSMARTIN@telmex.com","GSCHARTU@telmex.com","NFLORES@telmex.com","DLRAMIRE@telmex.com","RLMATIAS@telmex.com", "PCALLEJA@telmex.com", "ACGUEVAR@telmex.com", "LRMONTAN@telmex.com", "MOTANEZ@telmex.com", "RBUSTAMA@telmex.com", "OTSANCHE@telmex.com", "IGUTIERR@telmex.com", "IGMARTIN@telmex.com", "JODELGAD@telmex.com");
 	}
 
 include ("smtp.php"); 

  $html = "<HTML><HEAD></HEAD><BODY>";
  $html.="<h4>El usuario '$sess_nmb' Liquido la solicitud de baja de el Topologico para la referencia: $nomof</h4>";
  $html .= "<i>Observaciones: $observ</i>";
  $html .= "<br></BODY></HTML>";

  $subject	= "La solicitud de baja para de el Topologico  para la referencia: $nomof fue liquidada por CNA";
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
  if ($mimemail->send())	echo "Se envío correo al responsable del proyecto.";
  else 			  		    echo "ERROR:  Mail No enviado";
  
 

}

function bajavlan()
{
 $motivo=$_POST['motivo'];
 //$observ=$_POST['observ'];
 $observ=$_REQUEST['observ'];
 $buscatexto=$_POST['buscatexto'];
 global $buscatexto,$sess_usr, $result1,$motivo,$id,$division,$estado,$area,$ciudad,$ref_sisa,$ref_sisa_con,$nombre_adva_a,$nombre_adva_b,$estatus_top,$query3,$num_ot_frida,$observ;
		
	
 $tipo ="SELECT id,division,ref_sisa,ref_sisa_con,estatus_cns1,tipo_topologico from vlan_servicio where ref_sisa='$ref_sisa'";
 $tipo1=mysql_query($tipo);


 while ($resulta = mysql_fetch_array($tipo1))
		{
		
		    $id=$resulta[0];
		    $division=$resulta[1];
			$ref_sisa=$resulta[2];
			$ref_sisa_con=$resulta[3];	
			$estatus_cns1=$resulta[4];
			$tipo_topologico=$resulta[5];
		}
		
$qrespg="INSERT INTO vlan_servicio_baja SELECT '' as id_baja,'$sess_usr' as login_baja ,now() as fecha_baja,'Solicitud de baja de Servicio VLAN' as motivo_baja, vlan_servicio.* from vlan_servicio where id='$id' and ref_sisa='$ref_sisa'";
	    mysql_query($qrespg);
		//echo"<br>qrespg:$qrespg";
		 
		 $qdatosag="Select id_tabla from ordenes WHERE  num_ot_frida like '%RF-BVLS-%' and ref_sisa='$ref_sisa'";
		//echo"<br>qdatosag:$qdatosag";
		$rqdatosag=mysql_query($qdatosag);
		$id_tabla=mysql_result($rqdatosag,0,0);	
		
		
				//echo"<br>estatus:$estatus";
		/************************************************************************
		            BUSCA EL REGISTRO EN LA TABLA  ORDENES
		*************************************************************************/	
			
	//echo $tipo2 ="SELECT estatus,tabla,num_ot_frida,tipo_trabajo from ordenes where nombre_oficial_pisa='$buscatexto' and id_tabla='$id' and tabla='vlan_servicio' and num_ot_frida like '%RF-VLS-%'";
	 $tipo2 ="SELECT estatus,tabla,num_ot_frida,tipo_trabajo,id_tabla from ordenes where ref_sisa='$ref_sisa' and num_ot_frida like '%RF-BVLS-%'";
	
	$tipo3=mysql_query($tipo2);

	while ($resulta = mysql_fetch_array($tipo3))
		{
		$estatus=$resulta[0];
		$tabla=$resulta[1];
		$num_ot_frida=$resulta[2];
		$tipo_trabajo=$resulta[3];
		$id_tabla=$resulta[4];
		
		}
		
    // echo $tipo2;
	  echo $query1=mysql_query("UPDATE vlan_servicio set  num_ot_frida='$num_ot_frida', observaciones_cns1=CONCAT('|',NOW(),' USUARIO: $sess_usr,','MOTIVO:Solicitud de baja de Vlan servicio, ','OBSERVACIONES: $observ',  observaciones_cns1),estatus_cns1='POR REVISAR' where ref_sisa='$ref_sisa'");
	   $query2=mysql_query("UPDATE adva_ce set  num_ot_frida='$num_ot_frida',observaciones_vlanserv=CONCAT('|',NOW(),' USUARIO: $sess_usr,','MOTIVO:Solicitud de baja de Vlan servicio, ','OBSERVACIONES: $observ', observaciones_vlanserv),ch_vlan_serv_est='POR REVISAR',tipo_trabajo='BAJA VLAN SERVICIO TELCEL',trafico='BAJA VLAN SERVICIO TELCEL' where ref_sisa='$ref_sisa'");
	   $query3=mysql_query("UPDATE ordenes set  estatus='POR REVISAR', tabla='vlan_servicio', id_tabla='$id', division='$division', estado='$estado', area='$area', ciudad='$ciudad', nombre_oficial_pisa='$ref_sisa', tipo_trabajo='BAJA VLAN SERVICIO', tipo_producto='TELCEL', trafico='BAJA VLAN SERVICIO TELCEL', nombre_adva_a= '$nombre_adva_a', nombre_adva_b='$nombre_adva_b', ref_sisa_con='$ref_sisa_con', ref_sisa='$ref_sisa', tipo_equipo='$tipo_topologico' where nombre_oficial_pisa='$ref_sisa'  and num_ot_frida like '%RF-BVLS-%'");		
				
		                               
//echo"<br>query1:$query1";
	
	
			echo "<script> alert('Se ha enviado la solicitud de baja de  Vlan Servicio\\n\\n ')</script>"; 
	
	
	
	}
	