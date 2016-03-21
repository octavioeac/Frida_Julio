<?php


$host="localhost";
//$host="10.105.60.130";
$user="infinitum";
$password="infinitum2008";
$db="infinitum_unica";
$conectar2= mysql_connect($host,$user,$password);
$conectar= mysql_connect($host,$user,$password);

//mysql_select_db("infinitum_unica",$conectar);
mysql_select_db($db,$conectar2);
mysql_query("SET NAMES 'utf8'");


?>
