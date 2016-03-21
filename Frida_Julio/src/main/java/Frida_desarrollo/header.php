<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<script>

function startTime() {
    var today = new Date();
    var yyyy = today.getFullYear().toString();
    var mm = (today.getMonth()+1).toString(); // getMonth() is zero-based
    var dd  = today.getDate().toString();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    mm  = checkTime(mm);
    dd  = checkTime(dd);
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('reloj').innerHTML = yyyy + '/' + mm + '/' + dd + " " + h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

</script>

<link href="style.css" rel="stylesheet" type="text/css" media="screen" />

<?php

if(!isset($inicio)) $inicio = "href='inicio.php'";

?>

<body onload="startTime()">

<div id="wrap">
	<div id="header">
	        <div id="logo">
			<h1><a <?=$inicio?>>F R I D A</a></h1>
			<h2><?=$titulo_modulo?></h2>
	                <p>&nbsp;</p>
        		<p>&nbsp;</p>
		</div>
	</div>
	<div style='position:absolute;top:0;left:90%;font-size:9px;font-weight:bold;'>
		<div style=row>Usuario: <?=$sess_nmb?></div>
		<div style=row>DD: <?=$sess_dd?></div>
                <div style=row>Perfil: <?=$perfil?></div>
		<div id='reloj' style='font-size:11px;font-weight:bold;'></div>
	</div>
</div>

</body>
