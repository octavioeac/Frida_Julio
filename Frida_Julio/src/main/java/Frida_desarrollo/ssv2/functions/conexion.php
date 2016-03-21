<?php
//include_once("../ANALYSE_DATA.php");

/*$host="10.94.143.194";
$user="infinitum";
$password="infinitum2008";
$db="infinitum_unica";
$conectar= mysql_connect($host,$user,$password);
mysql_select_db($db,$conectar);
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
*/
#Desarrollo
$host="localhost";
//$host="10.105.59.73";
$user="infinitum";
$password="infinitum2008";
$db="infinitum_unica";
$conectar2= mysql_connect($host,$user,$password);
$conectar= mysql_connect($host,$user,$password);

mysql_select_db($db,$conectar);
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");



/*************************************/
//$conectService=mysqli_connect($host,$user,$password,$db);
//if (mysqli_connect_error($conectService)){
//	echo "Failed to connect to MySQL";
//	mysqli_connect_error();
//}
/***************************************/