<?php
//include "../perfiles.php";
include "interfaces_daos/IenviaCorreo.php";
include "clases/Abs_parametos_nodo.php";
include "clases/Parametros_Datos_mail.php";
require 'PHPMailer-master/PHPMailer-master/PHPMailerAutoload.php';

//$_POST['usuarios_default']="octavio.avarezdelcastillo@gmail.com";
class Implements_Envia_correo extends Abs_parametros_nodo  implements Envia_correo{
	 
	 public static function alt_bodys($mi_array_datos_mail){
 	$objeto_alt_bodys=new Abs_parametros_nodo();
 	$objeto_alt_bodys->cliente_comun=$mi_array_datos_mail['cliente_comun'];
 	$objeto_alt_bodys->domicilio=$mi_array_datos_mail['domicilio'];
 	$objeto_alt_bodys->nodo_acceso=$mi_array_datos_mail['nodo_acceso'];
 	$objeto_alt_bodys->anillo_ref1=$mi_array_datos_mail['anillo_ref1'];
 	$objeto_alt_bodys->estatus_plan=$mi_array_datos_mail['estatus_planifi'];
	$objeto_alt_bodys->observacion=utf8_decode($mi_array_datos_mail['observacion']);
	$objeto_alt_bodys->anillo_sugerido=$mi_array_datos_mail['nodo_sugerido'];
 	$altbodys="La planificacion del Cliente:".	$objeto_alt_bodys->cliente_comun." con domicilio:". $objeto_alt_bodys->domicilio."; Nodo Acceso:".$objeto_alt_bodys->nodo_acceso."; Anillo:". $objeto_alt_bodys->anillo_ref1." con estatus ".$objeto_alt_bodys->estatus_plan."";
	 	return $altbodys;
 	
 }
  public static function subjet_armado($mi_array_datos_mail){
  $objeto_subject=new Abs_parametros_nodo();
 	  $objeto_subject->ref_sisa=$mi_array_datos_mail['ref_sisa'];
 	  $objeto_subject->punta=$mi_array_datos_mail['punta'];
 	  $objeto_subject->nodo_acceso=strval($mi_array_datos_mail['nodo_acceso']);
 	  $objeto_subject->estatus_plan=$mi_array_datos_mail['estatus_planifi'];
 	  $objeto_subject->cliente_comun=$mi_array_datos_mail['cliente_comun'];
      $cadena_subject="Planificación "
 			.$objeto_subject->ref_sisa.", ";
			if($objeto_subject->cliente_comun!=""){
			$cadena_subject.="".$objeto_subject->cliente_comun.",";
			}
			if($objeto_subject->nodo_acceso!=""){
			$cadena_subject.="".$objeto_subject->nodo_acceso.", estatus ";
			}
 		    $cadena_subject.="".$objeto_subject->estatus_plan.".";  
    return $cadena_subject;
 }		
	
	
	public function envia_correo_cambio_nodo($subject,$mi_array_datos_mail,$altody,$mis_usuarios_array){
  
	$obj_mail=new Parametros_Datos_mail();
	$obj_mail->Subject=$subject;  
	$obj_mail->alto_body=$altody;  
    $objeto_correo=new Abs_parametros_nodo();
 	$objeto_correo->cliente_comun=$mi_array_datos_mail['cliente_comun'];
 	$objeto_correo->domicilio=$mi_array_datos_mail['domicilio'];
 	$objeto_correo->nodo_acceso=$mi_array_datos_mail['nodo_acceso'];
 	$objeto_correo->anillo_ref1=$mi_array_datos_mail['anillo_ref1'];
 	$objeto_correo->estatus_plan=$mi_array_datos_mail['estatus_planifi'];
	$objeto_correo->observacion=utf8_encode($mi_array_datos_mail['observacion']);
	$objeto_correo->anillo_sugerido=$mi_array_datos_mail['nodo_sugerido'];
	//echo $objeto_correo->estatus_plan;
	
     $mail = new PHPMailer(true);
	 $mail->isSMTP();
	 try{
	 $mail->Host = "10.192.10.25";
$mail->SMTPDebug=2;
$mail->Username = "frida@telmexomsasi.com";             
$mail->Password="Fridainfinitum";   
$mail->From = "frida@telmexomsasi.com";
$mail->FromName = "FRIDA";
$mail->Subject= $obj_mail->Subject;
       
 	    	foreach($mis_usuarios_array as $remitente){
				if($remitente!="")
				{
	            $mail->AddAddress($remitente);
				}
 	 		}



 	 	 	$body  ='
			<html>
<head>
<meta http-equiv="content-type" charset="iso-8859-1" />
<style>
.Estilo4 {color:#003399; font-weight:bold; font-size:15px;}
.Estilo1 {color:#003399; font-weight:bold; font-size:20px; } 
.Estilo2 {font-size:12px;}
</style>
</head>
<body>
			<p style="margin:0px; padding:0px; font-family:Verdana, Geneva, sans-serif;" align="left">Saludos:</br>
informo que la planificaci&oacute;n esta en estatus:'.strip_tags($objeto_correo->estatus_plan).'</br>
</p>
  <h3 style="margin:0px; padding:0px; font-family:Verdana, Geneva, sans-serif;"  class="Estilo1">Detalles: </h3>
 <table width="50%" bordercolor="#CAE4FF" cellpadding="4" cellspacing="1" border="1" bgcolor="#FFFFFF">
 <colgroup>
             <tr bordercolor="#CAE4FF">
                <td bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo4">Cliente</b></td>
               <td bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo4">Domicilio</b></td>
               <td bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo4">Nodo Acceso</b></td>
                <td bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo4">Anillo</b></td>
				  <td bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo4">Nodo sugerido</b></td>
             </tr>
 	
             <tr bordercolor="#CAE4FF" >
                   <td bgcolor="#FFFFFF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo2">'.strip_tags($objeto_correo->cliente_comun).'</b></td>
           <td bgcolor="#FFFFFF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo2">'.strip_tags($objeto_correo->domicilio).'</b></td>
                   <td bgcolor="#FFFFFF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo2">'.strip_tags($objeto_correo->nodo_acceso).'</b></td>
                   <td bgcolor="#FFFFFF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo2">'.strip_tags($objeto_correo->anillo_ref1).'</b></td>
 	  
	   <td bgcolor="#FFFFFF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo2">'.strip_tags($mi_array_datos_mail['nodo_sugerido']).'</b></td>
             </tr>
  </colgroup> 
   	   <tr bordercolor="#CAE4FF"   >
	  <td colspan=10 style="width:100%" bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo4">Observaciones:</b></td>
	 </tr>
	 <tr bordercolor="#CAE4FF" >
	  <td colspan=10 bgcolor="#FFFFFF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo2">
<pre><span>
'.$objeto_correo->observacion.'
</span>
<pre>
</td>
</tr>
</table> 
</body>
</html>
';
         $mail->AddBCC("ealarcon@telmex.com");
		// $mail->AddBCC("octavio.avarezdelcastillo@gmail.com");
          $mail->AddBCC("cborja@telmexomsasi.com");
         $mail->AddBCC("ricardrp@telmex.com");
         $mail->AddBCC("josega@telmexomsasi.com");
         $mail->Body =strval($body);
         $mail->AltBody =$obj_mail->alto_body;
         $mail->Send();
      	echo "Mensaje Enviado";
	    }
	
	catch(phpMailerException $e){
		echo $e->errorMessage();
	     }
	
		}
}





/*
$ref_sisa="D32-0708-0515";
$punta="A";
$nodo_acceso="12123";
$estatus_planifi="hola_estatus";
$cliente_comun="cliente";
$domicilio="calle falsa 123";
$anillo_ref1="anillo zdkasjdljs";

$usuario_2="josefinosasaeew@gmail.com";
$usuario_3="josefinosasaeewsdasasassldnsjdk@gmail.com";
$usuario_1="octavio.avarezdelcastillo@gmail.com";
$mi_array_datos_mail=array(
           "ref_sisa"=>$ref_sisa,
		   "punta"=>$punta,
		   "nodo_acceso"=>$nodo_acceso,
		   "cliente_comun"=>$cliente_comun,
		   "domicilio"=>$domicilio,
		   "estatus_planifi"=>$estatus_planifi,
		   "anillo_ref1"=>$anillo_ref1
		   );
  for($i=0;$i<10;$i++) 
  { 
    $email='$usuario_'.$i; 
    eval("\$email = \"$email\";"); 
    $mis_usuarios_array[$i] = $email; 
  } 
$obj=new Implements_Envia_correo();
$obj->envia_correo_cambio_nodo(
Implements_Envia_correo::subjet_armado($mi_array_datos_mail),
$mi_array_datos_mail,
Implements_Envia_correo::alt_bodys($mi_array_datos_mail),		
$mis_usuarios_array);*/
//var_dump($_SESSION);
//var_dump($_SESSION['refresher']);
//if (!isset($_SESSION['refresher']))    {
//    $_SESSION['refresher'] = 2;
//	echo "HOLA CORREO";
//}
//elseif ($_SESSION['refresher'] <= 0)    {
//    $_SESSION['refresher'] = 1;
//
//
//
//}
//else    {
//$_SESSION['refresher']--;
//
//
//
//}
//$_SESSION['refresher']+1; 
?>