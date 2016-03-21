<?php
header("Content-Type: text/html;charset=utf-8");
$folio=array();
// $folio='SS4520150401005';
// $folio='SS4520150401006';
// $folio='SS2520150407005';
// $folio='SS2520150407006';
// $folio='SS2520150407007';
// $folio='SS2520150407008';
// $folio='SS2520150407009';
// $folio='SS2520150407010';
// $folio='SS2520150407011';
// $folio='SS2520150407013';
// $folio='SS2520150407014';
// $folio='SS2520150407027';
// $folio[]='SS2520150408001';
// $folio[]='SS2520150408002';
// $folio[]='SS2520150408003';
// $folio[]='SS2520150408004';
// $folio[]='SS2520150408005';
// $folio[]='SS2520150408006';
// $folio[]='SS2520150408007';
// $folio[]='SS2520150408008';
// $folio[]='SS2520150408009';
// $folio[]='SS2520150408010';
// $folio[]='SS2520150408011';
// $folio[]='SS2520150408012';
// $folio[]='SS2520150408013';
// $folio[]='SS2520150408014';
// $folio[]='SS2520150408015';
// $folio[]='SS4520150330017';
// $folio[]='SS4520150330020';
// $folio[]='SS4520150414001';
// $folio[]='SS4520150423002';


$folio = array('SS1720150210001',
'SS4520150309001',
'SS4520150317002',
'SS1720150317003',
'SS4520150324001',
'SS4520150324004',
'SS4520150325001',
'SS4520150325003',
'SS4520150409001',
'SS4520150601002',
'SS4520150601004',
'SS4520150601005',
'SS4520150601006',
'SS4520150601007',
'SS4520150601008',
'SS4520150601009',
'SS4520150804001',
'SS4520150804002',
'SS2520150902001');



function borrar_ss($folio){
    require 'conexion.php';
	mysql_query("delete from zarchivos where folio='$folio';");
	mysql_query("delete from zbitacora where folio='$folio';");
	mysql_query("delete from zcanaletas where folio='$folio';");
	mysql_query("delete from zcatalogo where folio='$folio';");
	mysql_query("delete from zccemails where folio='$folio';");
	mysql_query("delete from zelementos where folio='$folio';");
	mysql_query("delete from zinter_abfo where folio='$folio';");
	mysql_query("delete from zinter_bdfo where folio='$folio';");
	mysql_query("delete from zinter_bdtd where folio='$folio';");
	mysql_query("delete from zinter_cx where folio='$folio';");
	mysql_query("delete from zinter_fz where folio='$folio';");
	mysql_query("delete from zinter_gs where folio='$folio';");
	mysql_query("delete from zinter_mp where folio='$folio';");
	mysql_query("delete from zss_equipos where folio='$folio';");
	mysql_query("delete from zsite_survey where folio='$folio';");	
}
foreach($folio as $id=>$f){
	echo borrar_ss($f);
}
