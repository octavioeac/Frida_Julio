<?php
include("../perfiles.php");
require 'PHPMailer-master/PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer(true);
$mail->isSMTP();
try{	
$mail->Host = "10.192.10.25";
$mail->SMTPDebug=2;
//$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = "frida@telmex.com";                            // SMTP username
$mail->Password="Fridainfinitum";   
$mail->From = "frida@telmex.com";
$mail->FromName = "FRIDA";
$mail->Subject = "Planificación ".$_POST['referencia_sisa'].", ".$_POST['cliente_comun'].", ".$_POST['nodo_acceso']."estatus liquidado .";
if($_POST['usuarios_default']!=""){
$num_usariosMail=$_POST['usuarios_default'];
$num_usariosMailArray=explode(",",$num_usariosMail);
foreach($num_usariosMailArray as $remitente){
$mail->AddAddress($remitente);
	}
	}
if($_POST['direccion_mails']!=null){

$num_usariosMailCopia=$_POST['direccion_mails'];
if(strpos($num_usariosMailCopia,", ")!=false){
$num_usariosMailCopiaArray=explode(",",substr_replace($num_usariosMailCopia, "" ,strlen($num_usariosMailCopia)-2));
var_dump($num_usariosMailCopiaArray);
//echo "caso1";
foreach($num_usariosMailCopiaArray as $copiaDestinatario){
$mail->AddCC($copiaDestinatario);	
	}	
	}
	

if(strpos($num_usariosMailCopia,"m ")!=false){
$num_usariosMailCopiaArray=explode(",",substr_replace($num_usariosMailCopia, "" ,strlen($num_usariosMailCopia)-1));
var_dump($num_usariosMailCopiaArray);
//echo "caso2";
foreach($num_usariosMailCopiaArray as $copiaDestinatario){
	
$mail->AddCC($copiaDestinatario);	

	}	
	}
if(strpos($num_usariosMailCopia,"m")!=false){
$num_usariosMailCopiaArray=explode(" ",substr_replace($num_usariosMailCopia, "" ,strlen($num_usariosMailCopia)-1));
var_dump($num_usariosMailCopiaArray);
//echo "caso3";
foreach($num_usariosMailCopiaArray as $copiaDestinatario){
	
$mail->AddCC($copiaDestinatario);	

	}	
	}



	}//fin de if de if($_POST['direccion_mails']!=null)
	
$body  = '<html>
<head>
<meta http-equiv="content-type" charset="iso-8859-1" />
<style>
.Estilo4 {color:#003399; font-weight:bold; font-size:15px;}
.Estilo1 {color:#003399; font-weight:bold; font-size:20px; } 
.Estilo2 {font-size:12px;}
</style>
</head>
<body>
<p style="margin:0px; padding:0px;font-family:Verdana, Geneva, sans-serif" align="left">Saludos:</br>
informo que la planificaci&oacute;n esta terminada</br>
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
                   <td  bgcolor="#FFFFFF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif" class="Estilo2">'. $_POST['cliente_comun'].'</b></td>
           <td  bgcolor="#FFFFFF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif" class="Estilo2">'.$_POST['domicilio'].'</b></td>
                   <td  bgcolor="#FFFFFF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif" class="Estilo2">'.$_POST['nodo_acceso'].'</b></td>
                   <td  bgcolor="#FFFFFF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif" class="Estilo2">'.$_POST['anillo_ref1'].'</b></td>
                    
             </tr>
                    

			 
			          
                    
     </table>
</body>
</html>';

$mail->Body = $body;

$altbodys="La planificación\n
Cliente:". $_POST['cliente_comun']."\n
Domicilio:". $_POST['domicilio']."\n
Nodo Acceso:". $_POST['nodo_acceso']."\n
Anillo:". $_POST['anillo_ref1']."\n"."está terminada";
if($decodificado!=null){
$altbodys .=$decodificado;
	}
$altbodys .="";
$mail->AltBody = $altbodys ;
$mail->Send();
echo "Mensaje Enviado";
}
catch(phpMailerException $e){
	echo $e->errorMessage();
	}
	
	
	
	
/*		
"El texto es:".$_POST['texto_observacion']." existe</br>";	   
 		echo "El fichero ".$_POST['fileNom']." existe</br>";	
		echo $_POST['usuario_mail']."</br>" ;
		echo $_POST['anillo_ref1']."</br>" ;
				echo $_POST['nodo_acceso']."</br>" ;
                 
		
		
		}	
				
	else{
		
		echo "Error";
		}			*/
					
			
	
	
	
	
	


?>