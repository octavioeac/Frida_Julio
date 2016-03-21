<?php
//$host="localhost";
$host="10.105.59.73";
$user="infinitum";
$password="infinitum2008";
$db="infinitum_unica";
//$conectar2= mysql_connect($host,$user,$password);
$conectar= mysql_connect($host,$user,$password);

//mysql_select_db("infinitum_unica",$conectar);
mysql_select_db($db,$conectar);

/*$conectService=mysqli_connect($host,$user,$password,$db);
if (mysqli_connect_error($conectService)){
	echo "Failed to connect to MySQL";
	mysqli_connect_error();	
}*/
 
?>
