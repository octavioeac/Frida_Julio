<?php 
function Send_Mail($script,$campo,$valor)
{
  require ('PHPMailer-master/PHPMailer-master/PHPMailerAutoload.php');

  $mail = new PHPMailer(true);
  $mail->IsSMTP();
  //$mail->Mailer = "smtp";

  $mail->Host = "10.192.10.25";

  $mail->Username = "frida@telmexomsasi.com"; 
  $mail->Password = "Fridainfinitum";

  $mail->From = "frida@telmexomsasi.com";
  $mail->FromName = "FRIDA";
  $mail->Subject = "FRIDA Desarrollo: Inyeccion de Codigo en Script: ".$script."";

  $mail->AddAddress("ealarcon@telmex.com");
  $mail->AddAddress("cborja@telmexomsasi.com");
  
 // $mail->AddBCC("enriquealarconchew@yahoo.com");

  $mail->Body = "Script: ".$script."<br> Campo: ".$campo."<br> Valor: ".$valor;

  $mail->AltBody = "Script: ".$script.", Campo: ".$campo.", Valor: ".$valor;

  $exito = $mail->Send();
  $intentos=1; 

  while ((!$exito) && ($intentos < 5)) {
	sleep(5);
     	$exito = $mail->Send();
     	$intentos++;	
   }
}

function Analyse_Value($contents)
{
	if (preg_match('/(base64_system|shell_|exec|php_)/i',$contents))//|eval|
    {
        return true;
    }
	elseif (preg_match('/(insert|update|delete|values|VALUES|INSERT|UPDATE|DELETE|-- |--|\`|\'|\"|alert|script|javascript|vbscript)/i', $contents))
    {
        return true;
    }	
	elseif (preg_match('/(onload|onresize|onunload|onclick|ondblclick|onmousedown|onmouseup|onmouseover|onmousemove|onmouseout|ondragstart|ondrag|ondragenter|ondragleave|ondragover|ondrop|ondragend|onkeydown|onkeypress|onkeyup|onload|onunload|onabort|onerror|onresize|onscroll|onselect|onchange|onsubmit|onreset|onfocus|onblur|prompt)/i', $contents))
    {
        return true;
    }	
    elseif (preg_match("#&\#x([0-9a-f]+);#i", $contents))
    {
        return true;
    }
    elseif (preg_match('#&\#([0-9]+);#i', $contents))
    {
        return true;
    }
    elseif (preg_match("#([a-z]*)=([\`\'\"]*)script:#iU", $contents))
    {
        return true;
    }
    elseif (preg_match("#([a-z]*)=([\`\'\"]*)javascript:#iU", $contents))
    {
        return true;
    }
    elseif (preg_match("#([a-z]*)=([\'\"]*)vbscript:#iU", $contents))
    {
        return true;
    }
    elseif (preg_match("#(<[^>]+)style=([\`\'\"]*).*expression\([^>]*>#iU", $contents))
    {
        return true;
    }
    elseif (preg_match("#(<[^>]+)style=([\`\'\"]*).*behaviour\([^>]*>#iU", $contents))
    {
        return true;
    }
    elseif (preg_match("#</*(applet|link|style|script|iframe|frame|frameset|html|body|title|div|p|form)[^>]*>#i", $contents))
    {
        return true;
    }
    else
    {
        return false;
    }
}

preg_match('@^(?:http://)?([^/]+)@i',$_SERVER['HTTP_REFERER'], $contents);
$host = $contents[1];

if ($host = "frida" || $host = "frida2" || $host = "10.94.143.195" || $host = "10.105.59.73")
{
	if ($_SERVER['REQUEST_METHOD'] === 'POST')
	{
		if (isset($_POST))
		{
			//$i = 0;
			foreach ($_POST AS $key=>$value)
			{
				//$valor = str_replace("'","",$value);
				//echo $i.".- ".$value."<br>\n";
				if (Analyse_Value($value))
				{
					//session_unset();
					$script = $_SERVER['SCRIPT_NAME'];
					$campo = $key;
					$valor = $value;
					$Send_Mail = Send_Mail($script,$campo,$valor);
					//exit('Se detect&oacute; intento de inyecci&oacute;n de c&oacute;digo.');
				} //else {
					//echo "does not match<br>\n";					
				//}
				//$i++;
			}
		}
	}
	if ($_SERVER['REQUEST_METHOD'] === 'GET')
	{
		if (isset($_GET))
		{
			//$i = 0;
			foreach ($_GET AS $key=>$value)
			{
				//$valor = str_replace("'","",$value);
				//echo $i.".- ".$value."<br>\n";
				if (Analyse_Value($value))
				{
					$script = $_SERVER['SCRIPT_NAME'];
					$campo = $key;
					$valor = $value;
					$Send_Mail = Send_Mail($script,$campo,$valor);
					//exit('Se detect&oacute; intento de inyecci&oacute;n de c&oacute;digo.');
				} //else {
					//echo "does not match<br>\n";					
				//}
				//$i++;
			}
		}
	}
}

?>