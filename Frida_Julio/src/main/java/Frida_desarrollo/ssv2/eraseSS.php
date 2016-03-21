<?php
	include 'functions/conexion.php';
	$folio = array(
		'SS0120151124002',
		'SS0120151124003',
		'SS0120151124008',
		'SS0120151124010',
		'SS0120151124012',
		'SS0120151124015',
		'SS0120151124017',
		'SS0120151124019',
		'SS0120151124020',
		'SS0120151124022',
		'SS0120151124025',
		'SS0120151124027',
		'SS0120151124030',
		'SS0120151124032',
		'SS0120151124034',
		'SS0120151124037',
		'SS0120151124039',
		'SS0120151124041',
		'SS0120151124043',
		'SS0120151125004',
		'SS0120151125005',
		'SS0120151125006',
		'SS0120151125007',
		'SS0120151125008',
		'SS0120151125009',
		'SS0120151125010',
		'SS0120151125011',
		'SS1020151124001',
		'SS1020151124004',
		'SS1020151124005',
		'SS1020151124006',
		'SS1020151124007',
		'SS1020151124009',
		'SS1020151124011',
		'SS1020151124021',
		'SS1020151124023',
		'SS1020151124024',
		'SS1020151124026',
		'SS1020151124028',
		'SS1020151124029',
		'SS1020151124031',
		'SS1020151124033',
		'SS1020151124035',
		'SS1020151124036',
		'SS1020151124038',
		'SS1020151124040',
		'SS1020151124042',
		'SS1020151125001',
		'SS1020151125002',
		'SS1020151125003',
		'SS4520151124013',
		'SS4520151124014',
		'SS4520151124016',
		'SS4520151124018'
	);
	foreach($folio as $f){
		mysql_query("delete from zsite_survey where folio = '".$f."'");
		mysql_query("delete from zss_equipos where folio = '".$f."'");
		mysql_query("delete from zinter_abfo where folio = '".$f."'");
		mysql_query("delete from zinter_mp where folio = '".$f."'");
		mysql_query("delete from zinter_cx where folio = '".$f."'");
		mysql_query("delete from zinter_gs where folio = '".$f."'");
		mysql_query("delete from zinter_fz where folio = '".$f."'");
		mysql_query("delete from zbitacora where folio = '".$f."'");
		mysql_query("delete from zarchivos where folio = '".$f."'");
		mysql_query("delete from zccemails where folio = '".$f."'");
	}