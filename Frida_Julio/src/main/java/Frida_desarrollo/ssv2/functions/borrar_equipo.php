<?php
header("Content-Type: text/html;charset=utf-8");
$f='SS4520150326006';
$id='613'; //tabla zss_equipos
function borrar_equipo($folio,$id_equipo){
    require 'conexion.php';
	mysql_query("delete from zinter_abfo where folio='$folio' and id_equipo='$id_equipo';");
	mysql_query("delete from zinter_bdfo where folio='$folio' and id_equipo='$id_equipo';");
	mysql_query("delete from zinter_bdtd where folio='$folio' and id_equipo='$id_equipo';");
	mysql_query("delete from zinter_cx where folio='$folio' and id_equipo='$id_equipo';");
	mysql_query("delete from zinter_fz where folio='$folio' and id_equipo='$id_equipo';");
	mysql_query("delete from zinter_gs where folio='$folio' and id_equipo='$id_equipo';");
	mysql_query("delete from zinter_mp where folio='$folio' and id_equipo='$id_equipo';");
	mysql_query("delete from zss_equipos where folio='$folio' and id=$id_equipo;");
	echo "Folio ". $folio.", Equipo ". $id_equipo;
}
echo borrar_equipo($f,$id);
