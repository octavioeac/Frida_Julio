<?PHP
include('functions/conexion.php');

$foto="inversion.foto";
$bd="inversion.";

$prov=array(0=>array('nombre'=>'ALCATEL-LUCENT','mat_repisa'=>'3031622','mat_tarjeta'=>'2087742'),
			1=>array('nombre'=>'HUAWEI','mat_repisa'=>'3031771','mat_tarjeta'=>'2090712'));
for($i=0;$i<count($prov);$i++){			
	$sql=mysql_query("SELECT sigla_cent,GROUP_CONCAT(DISTINCT MATERIA_PL) FROM $foto WHERE estatus LIKE '%PLVA%' AND (materia_pl LIKE '%".$prov[$i]['mat_repisa']."%' OR 
					  materia_pl LIKE '%".$prov[$i]['mat_tarjeta']."%') AND (sigla_cent<>'' AND sigla_cent IS NOT NULL) GROUP BY sigla_cent 
					  ORDER BY GROUP_CONCAT(DISTINCT materia_pl)");
	while($dat=mysql_fetch_array($sql)){
		$sql1=mysql_query("SELECT * FROM $bd.zsite_survey a INNER JOIN $bd.centrales b ON a.id_central=b.id_ctl WHERE b.sigcent='$dat[0]'");
		
		// echo $dat[0].mysql_num_rows($sql1)."<br>";
		if(strpos($dat[1],$prov[$i]['mat_repisa'])!==false and strpos($dat[1],$prov[$i]['mat_tarjeta'])===false){
			// echo $prov[$i]['nombre']."->".$dat[0]."- $dat[1] Solo Equipo<br>";
			// $materia="1";
						   
		}else if(strpos($dat[1],$prov[$i]['mat_repisa'])===false and strpos($dat[1],$prov[$i]['mat_tarjeta'])!==false){
			// echo $prov[$i]['nombre']."->".$dat[0]."- $dat[1] Solo tarjeteria<br>";
			// $materia="2";
			
		}else if(strpos($dat[1],$prov[$i]['mat_repisa'])!==false and strpos($dat[1],$prov[$i]['mat_tarjeta'])!==false){
			// echo $prov[$i]['nombre']."->".$dat[0]."- $dat[1] Los dos<br>";
			// $materia="3";
		}
		// for($j=0;$j<count($materia);$j++){
			
			// $sql1=mysql_query("SELECT siglas FROM $foto WHERE estatus LIKE '%PLVA%' $materia[$j] AND sigla_cent='".."' GROUP BY sigla_cent 
						       // ORDER BY GROUP_CONCAT(DISTINCT materia_pl)");
		// }
		
	}
}

// function 

/* if(){

}


mysql_query("UPDATE infinitum_unica.zss_equipos SET ss
			 pep_repisa='3L-450805280-C008',
			 pedido='9500282565',
			 fecha_carga_pep=NOW()
			 WHERE folio='$folio'"); */
		
/* //folio,id_equipo,tipo_trabajo,pep_tarjeta,pedido,fecha_carga_pep	
$k=1;		
$id_equipos=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT(id) FROM infinitum_unica.zss_equipos WHERE folio='$folio'"));
$id_equipos1=explode(",",$id_equipos[0]);
$num_equipos=count($id_equipos1);		
for($i=0;$i<$num_equipos;$i++){
	for($j=0;$j<16;$j++){
		if($k<=91){
			mysql_query("INSERT INTO infinitum_unica.z_tarjetas (folio,id_equipo,tipo_trabajo,pep_tarjeta,pedido,fecha_carga_pep)
			VALUES('$folio','$id_equipos1[$i]','TARJETA NUEVA','3L-450805248-C004','9500282107',NOW())");
		}else{
			mysql_query("INSERT INTO infinitum_unica.z_tarjetas (folio,id_equipo,tipo_trabajo,pep_tarjeta,pedido,fecha_carga_pep)
						 VALUES('','$id_equipos1[$i]','','','','')");
		}
		$k++;
	}
}  */			 
?>