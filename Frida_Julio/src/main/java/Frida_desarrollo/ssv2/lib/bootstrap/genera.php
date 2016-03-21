<?PHP

include("smtp.php");
include('nomad_mimemail.inc.php');

$ruta="\\appserv\\www\\desarrollo\inversion\inversion\lib\bootstrap\\";
$adjunto="prueba1.pdf";
$imagen="prueba1.jpg";
$to=ARRAY("hfl.itzel@hotmail.com");
$subject="Envío de correo de prueba ($smtp_host)";
$html="<HTML><HEAD><meta http-equiv=Content-Type content=\"text/html; charset=iso-8859-1\"></HEAD><BODY><font style=Arial size=4 color=red> X RESPONDE ESTE MENSAJE SI LO RECIBISTE <br>... CORREO DE PRUEBA $smtp_host...<br><img src=\"$imagen\" border=\"0\"></img></font></BODY></HTML>";

$mimemail = new nomad_mimemail();
$mimemail->set_smtp_host($smtp_host);
$mimemail->set_smtp_auth($smtp_user, $smtp_pass);
$mimemail->set_to($to[0]);
for ($d=1;$d<count($to);$d++) $mimemail->add_to($to[$d]);
if($cc!=null){
                $mimemail->set_cc($cc[0]);
                for ($d=1;$d<count($cc);$d++) $mimemail->add_cc($cc[$d]);
}
$mimemail->set_subject($subject);
$mimemail->set_html($html);
if ($adjunto!=null){
                $mimemail->add_attachment($ruta.$adjunto,$adjunto);
                $mimemail->add_attachment($ruta.$imagen,$imagen);
}
if ($mimemail->send())                echo "El Mail ($subject) fue enviado correctamente<BR>";
else echo "ERROR:  Mail ($subject) No enviado<BR>";
?>