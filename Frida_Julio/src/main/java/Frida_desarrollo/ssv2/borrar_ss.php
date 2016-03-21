<?php
	/*'SS1720150210001',
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
'SS2520150902001',
*/
	include 'functions/conexion.php';
	$folios = array('SS4520151127001',
'SS4520151127002',
'SS6020151209001'
);
echo print_r($folios,true);
	for($i = 0; $i < count($folios); $i++){
		$query01 = "delete from zsite_survey where folio = '".$folios[$i]."'";
		mysql_query($query01);
		$query02 = "delete from zss_equipos where folio = '".$folios[$i]."'";
		mysql_query($query02);
		$query03 = "delete from zccemails where folio = '".$folios[$i]."'";
		mysql_query($query03);
		$query04 = "delete from zinter_abfo where folio = '".$folios[$i]."'";
		mysql_query($query04);
		$query05 = "delete from zinter_mp where folio = '".$folios[$i]."'";
		mysql_query($query05);
		$query06 = "delete from zinter_cx where folio = '".$folios[$i]."'";
		mysql_query($query06);
		$query07 = "delete from zinter_gs where folio = '".$folios[$i]."'";
		mysql_query($query07);
		$query08 = "delete from zinter_fz where folio = '".$folios[$i]."'";
		mysql_query($query08);
		$query09 = "delete from zbitacora where folio = '".$folios[$i]."'";
		mysql_query($query09);
		$query10 = "delete from zarchivos where folio = '".$folios[$i]."'";
		mysql_query($query10);
	}