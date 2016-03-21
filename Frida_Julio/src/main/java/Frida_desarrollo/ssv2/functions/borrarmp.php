<?php
include 'conexion.php';
function borrarmp($folio,$iden,$idEquipo){
    $query = array(
        "delete from zinter_mp where id in(select id from(select mp.id from zinter_mp mp,zss_equipos eq where mp.folio='".$folio."' and mp.folio=eq.folio and eq.tipo_trabajo='Repisa Nueva' and mp.id_equipo=eq.id) a)",
        "delete from zinter_mp where folio = '".$folio."' and id_equipo = ".$idEquipo
    );
    $delete = $query[$iden];
    mysql_query($delete);
}
$folio = $_POST['folio'];
$iden = $_POST['iden'];
$idEquipo = $_POST['idEquipo'];
borrarmp($folio,$iden,$idEquipo);