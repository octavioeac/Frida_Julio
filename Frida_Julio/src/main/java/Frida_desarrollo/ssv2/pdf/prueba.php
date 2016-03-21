<?php
echo 'a';
header("Content-Type: text/html;charset=utf-8");
require '../functions/conexion.php';
$folio='SS1720150317003';

$ab='0';
$sql="SELECT a.nombre_equipo as equipo,b.tipo_equipo as modelo,c.* FROM zss_equipos a left join ztecnologias b on a.id_tecnologia = b.id left join zinter_gs c on a.id=c.id_equipo WHERE a.folio='".$folio."' AND c.gestionSincronia=$ab order by a.id asc;";
// echo $sql;
$result=mysql_query($sql);
$cadena ='<table border=1>';
while($renglon=mysql_fetch_assoc($result,MYSQL_BOTH)){
	$cadena .='<tr>';
	$cadena .= '<td class="c">'.$renglon['equipo'].'</td>';
	$cadena .= '<td class="c">'.$renglon['ubicacion_RCDT'].'</td>';
	$cadena .= '<td class="c">'.$renglon['numero_switch'].'</td>';
	$cadena .= '<td class="c">'.$renglon['puerto'].'</td>';
	$cadena .= '<td class="c">'.$renglon['cat_cable'].'</td>';
	$cadena .= '<td class="c">'.$renglon['long_cable'].'</td>';
	$cadena .= '<td class="c">'.$renglon['tipo_conector'].'</td>';
	$cadena .='</tr>';
}

echo $cadena;

?>