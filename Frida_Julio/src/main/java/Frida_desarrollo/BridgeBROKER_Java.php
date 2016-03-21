<?PHP

require("conexion.php");
$ot_frida=$_GET['nuOt'];
$movimiento=$_GET['movimiento'];
$cadena="insert into brokerPrueba(nu_ot_frida,movimiento) values(".$ot_frida.",".$movimiento.")";

$h=mysql_query($cadena);





?>