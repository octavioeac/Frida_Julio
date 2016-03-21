<?php
$host="10.94.143.194";
$user="accesos";
$password="GYOvY6TtmsW0oMOUTg";
$db="usuarios";
$conectar= mysql_connect($host,$user,$password);
mysql_select_db($db,$conectar);
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
if (mysqli_connect_error($conectService)){
	echo "Failed to connect to MySQL";
	mysqli_connect_error();
}
?>
