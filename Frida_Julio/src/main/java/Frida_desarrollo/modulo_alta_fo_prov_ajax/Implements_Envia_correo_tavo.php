<?php
//include "interfaces_daos/IenviaCorreo.php";
include "clases/Abs_parametos_nodo.php";
include "clases/Parametros_Datos_mail.php";
require 'PHPMailer-master/PHPMailer-master/PHPMailerAutoload.php';

$_POST['usuarios_default']="octavio.avarezdelcastillo@gmail.com";
$_POST['usuarios_default']="enriquealarconchew@yahoo.com";
class Implements_Envia_correo extends Abs_parametros_nodo  implements Envia_correo{
	 public static function alt_bodys($mi_array_datos_mail){
 	$objeto_alt_bodys=new Abs_parametros_nodo();
 	$objeto_alt_bodys->cliente_comun=$mi_array_datos_mail['cliente_comun'];
 	$objeto_alt_bodys->domicilio=$mi_array_datos_mail['domicilio'];
 	$objeto_alt_bodys->nodo_acceso=$mi_array_datos_mail['nodo_acceso'];
 	$objeto_alt_bodys->anillo_ref1=$mi_array_datos_mail['anillo_ref1'];
 	$objeto_alt_bodys->estatus_plan=$mi_array_datos_mail['estatus_planifi'];
 	$altbodys="La planificaci�n\n
Cliente:".	$objeto_alt_bodys->cliente_comun."\n
Domicilio:". $objeto_alt_bodys->domicilio."\n
Nodo Acceso:".$objeto_alt_bodys->nodo_acceso."\n
Anillo:". $objeto_alt_bodys->anillo_ref1."\n"."est� ".$objeto_alt_bodys->estatus_plan."";
 	 	return $albodys;
 	
 }
  public static function subjet_armado($mi_array_datos_mail){
  $objeto_subject=new Abs_parametros_nodo();
 	  $objeto_subject->ref_sisa=$mi_array_datos_mail['ref_sisa'];
 	  $objeto_subject->punta=$mi_array_datos_mail['punta'];
 	  $objeto_subject->nodo_acceso=$mi_array_datos_mail['nodo_acceso'];
 	  $objeto_subject->estatus_plan=$mi_array_datos_mail['estatus_planifi'];
 	  $objeto_subject->cliente_comun=$mi_array_datos_mail['cliente_comun'];

 	$cadena_subject="Planificaci�n "
 			.$objeto_subject->ref_sisa.", "
 			.$objeto_subject->cliente_comun.","
 		    .$objeto_subject->nodo_acceso." estatus "
 		     .$objeto_subject->estatus_plan.".";  
//	echo $cadena_subject;	 
    return $cadena_subject;
 }		
	
	
	public function envia_correo_cambio_nodo($subject,$mi_array_datos_mail,$albody){

    
	$obj_mail=new Parametros_Datos_mail();
	$obj_mail->Subject=$subject;  
	$obj_mail->alto_body=$albody;  
	
	$objeto_correo=new Abs_parametros_nodo();
 	$objeto_correo->cliente_comun=$mi_array_datos_mail['cliente_comun'];
 	$objeto_correo->domicilio=$mi_array_datos_mail['domicilio'];
 	$objeto_correo->nodo_acceso=$mi_array_datos_mail['nodo_acceso'];
 	$objeto_correo->anillo_ref1=$mi_array_datos_mail['anillo_ref1'];
 	$objeto_correo->estatus_plan=$mi_array_datos_mail['estatus_planifi'];
	
	 $mail = new PHPMailer(true);
	 $mail->isSMTP();
	 try{
	 $mail->Host = "10.192.10.25";
$mail->SMTPDebug=2;
//$mail->SMTPAuth = true;      
$mail->Username = "frida@telmexomsasi.com";             
$mail->Password="Fridainfinitum";   
$mail->From = "frida@telmexomsasi.com";
$mail->FromName = "FRIDA";
$mail->Subject= $obj_mail->Subject;
 	 	
 	 	if($_POST['usuarios_default']!=""){
 	 		$num_usariosMail=$_POST['usuarios_default'];
 	 		$num_usariosMailArray=explode(",",$num_usariosMail);
 	 		foreach($num_usariosMailArray as $remitente){
 	 			$mail->AddAddress($remitente);
 	 		}
 	 	}
 	 	 	$body  ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CORREO</title>
<style>
.Estilo4 {color:#003399; font-weight:bold; font-size:15px;}
.Estilo1 {color:#003399; font-weight:bold; font-size:20px; }
.Estilo2 {font-size:12px;}
</style>
</head>

<body>
<p style="margin:0px; padding:0px;font-family:Verdana, Geneva, sans-serif" align="left">Saludos:</br>
informo que la planificaci&oacute;n esta en estatus:'.strip_tags($objeto_correo->estatus_plan).'</br>
</p>
  <h3 style="margin:0px; padding:0px;font-family:Verdana, Geneva, sans-serif"  class="Estilo1">Detalles: </h3>
 <table width="50%"  bordercolor="#CAE4FF" cellpadding="4" cellspacing="1" border="1"  bordercolor="#666666" bgcolor="#FFFFFF">
             <tr  bordercolor="#CAE4FF" >
                <td  bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif" class="Estilo4">Cliente</b></td>
               <td  bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif" class="Estilo4">Domicilio</b></td>
               <td  bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif" class="Estilo4">Nodo Acceso</b></td>
                <td  bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif" class="Estilo4">Anillo</b></td>
             </tr>
 	
             <tr  bordercolor="#CAE4FF" >
                   <td  bgcolor="#FFFFFF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif" class="Estilo2">'.strip_tags($objeto_correo->cliente_comun).'</b></td>
           <td  bgcolor="#FFFFFF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif" class="Estilo2">'.strip_tags($objeto_correo->domicilio).'</b></td>
                   <td  bgcolor="#FFFFFF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif" class="Estilo2">'.strip_tags($objeto_correo->nodo_acceso).'</b></td>
                   <td  bgcolor="#FFFFFF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif" class="Estilo2">'.strip_tags($objeto_correo->anillo_ref1).'</b></td>
 	
             </tr>
 	
 	
 	
			    
 	
     </table>
</body>
</html>';
 	 	 	echo strval($body);
       
	   $mail->Body =strval($body);
//   	$mail->AltBody =$obj_mail->alto_body;
       $mail->Send();
// 	 	echo "Mensaje Enviado";
	 	
	 	
	    }
	
	catch(phpMailerException $e){
		echo $e->errorMessage();
	     }
	
		}


		
	

 

 
		
}


$ref_sisa="D32-0708-0515";
$punta="A";
$nodo_acceso="12123";
$estatus_planifi="hola_estatus";
$cliente_comun="cliente";
$domicilio="calle falsa 123";
$anillo_ref1="anillo zdkasjdljs";



$mi_array_datos_mail=array(
           "ref_sisa"=>$ref_sisa,
		   "punta"=>$punta,
		   "nodo_acceso"=>$nodo_acceso,
		   "cliente_comun"=>$cliente_comun,
		   "domicilio"=>$domicilio,
		   "estatus_planifi"=>$estatus_planifi,
		   "anillo_ref1"=>$anillo_ref1
		   );
		   

$a=Implements_Envia_correo::subjet_armado($mi_array_datos_mail);
$c=Implements_Envia_correo::alt_bodys($mi_array_datos_mail);		

$obj=new Implements_Envia_correo();
$obj->envia_correo_cambio_nodo($a,$mi_array_datos_mail,$c);




?>

