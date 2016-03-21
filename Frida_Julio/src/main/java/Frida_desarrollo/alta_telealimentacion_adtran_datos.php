<?
include("conexion.php");


$datos_central = $_POST['datos_central'];
$central_dsl = $_POST['central_dsl'];

$datos_area = $_POST['datos_area'];
##$datos_distrito = $_POST['datos_distrito'];

$area = $_POST['area'];
$edo = $_POST['edo'];
$siglas = $_POST['siglas'];

$ce_dsl = $_POST['ce_dsl'];
$nomof = $_POST['nomof'];
$nombre_oficial = $_POST['nombre_oficial'];

$tipo_tablilla = $_POST["tipo_tablilla"];

$centrales=$_POST['centrales'];

$nom_of_enc = $_POST['nom_of_enc'];


/*DATOS GUARDAR ALTA*/
$login=$_POST['login'];
$ubicacion=$_POST['ubicacion'];
$areas  = $_POST['areas'];
$nom_of3010 = $_POST['nom_of3010'];
$gabinete = $_POST['gabinete'];
$repisa = $_POST['repisa'];
$lpu = $_POST['lpu'];
$ip = $_POST['ip'];

//////////////////

$A_area = $_POST['A_area'];

$ip_val = $_POST['ip_val'];

$XXX = $_POST['XXX'];


/*DATOS MODIFICAR*/

$nom_of3010_enc = $_POST['nom_of_enc'];
$gabinete_enc = $_POST['gabinete_enc'];
$repisa_enc = $_POST['repisa_enc'];
$lpu_enc = $_POST['lpu_enc'];
$ip_enc = $_POST['ip_enc'];




$central_dslD = $_POST['central_dslD'];
$central_dsls = $_POST['central_dsls'];


$central_dslSS = $_POST['central_dslSS'];

$nomofProp = $_POST['nomofProp'];
//// AREA ***********************

if($datos_area!=''){

$a = mysql_query("SELECT '' as area union SELECT DISTINCT area from distritos_telealimentacion ORDER BY area");

	for ($i=0; $i < mysql_num_rows($a) ; $i++) { 
		$data['area'][$i]=mysql_result($a,$i);
	}
echo json_encode($data);
}


/***********************    ***********************/

if($area!='' && $siglas==''){
	
		$a = mysql_query("SELECT '' as siglas_central union SELECT DISTINCT siglas_central from distritos_telealimentacion where area='".$area."' ORDER BY siglas_central");

		for ($i=0; $i < mysql_num_rows($a) ; $i++) { 
			$data['siglas_central'][$i]=mysql_result($a,$i);
		}

		$b= mysql_query("SELECT 'CENTRAL' as central,'SIGLAS' as siglas_central union 
		SELECT central,siglas_central from distritos_telealimentacion where area='".$area."' GROUP BY central,siglas_central");

		for ($i=0; $i <mysql_num_rows($b) ; $i++) {  
					$data['central_dsl'][$i] = mysql_result($b,$i,0)." , ".mysql_result($b,$i,1);
				}
	 echo json_encode($data);
}


/**************** SIGLAS CENTRALES ************************/
 
if($area!='' && $siglas!=''){
	

	$b= mysql_query("SELECT central,siglas_central from distritos_telealimentacion where area='".$area."' and siglas_central='".$siglas."' GROUP BY central,siglas_central");

		for ($i=0; $i <mysql_num_rows($b) ; $i++) {  
					$data['central_dsls'][$i] = mysql_result($b,$i,0)." , ".mysql_result($b,$i,1);
		}

	echo json_encode($data);
}




/****************  CENTRALES   ***************************/

if($ce_dsl!=''){


	list($Carea,$central,$a_sigcent) = explode(",",$ce_dsl);

$a = mysql_query("SELECT area from distritos_telealimentacion where central=trim('$central') and siglas_central=trim('$a_sigcent')");
	$a_area = mysql_result($a,0);

$b = mysql_query("SELECT division, area,siglas_central,central  from distritos_telealimentacion where siglas_central=trim('$a_sigcent') 
	and area ='$a_area' and central='".$central."' GROUP BY central");
	

		$nom_camp = array('Division','Area','Siglas Central','Central');

		for ($i=0; $i <mysql_num_rows($b) ; $i++) { 
			for ($j=0; $j < mysql_num_fields($b); $j++) { 
				$data[$nom_camp[$j]]= mysql_result($b,$i,$j);
			}
			
		}

if(trim($Carea) == 'MORELOS'){
	$data['Estado'] = 'MOR';
}else
if(trim($Carea) == 'SOTELO'){
	$data['Estado'] = 'EDO';
}else{
	$c = mysql_query("SELECT edo from centrales where area='".trim($Carea)."' and sigcent=trim('$a_sigcent')");
	$data['Estado'] = mysql_result($c,0);
}



echo json_encode($data);	
}






/******************  AL SELECCIONAR CENTRAL RECOMIENDA NOMOF3010  **************************/
if($nomof!='' && $A_area!=''){

	
	$queryNum.= "SELECT min(numero)  from (";

			for ($i=1; $i <100 ; $i++) { 
				$queryNum.="SELECT ".$i." numero union ";
			}

			$queryNum = substr($queryNum,0,-6).") as n left join (
			SELECT 
			cast(substring( nombre_oficial_3010  ,-2 ) as signed   ) n, nombre_oficial_3010
			 from telealimentacion_adtran_interna where nombre_oficial_3010 like '".$nomof."%' and area='".$A_area."'
			group by nombre_oficial_3010 
			 ) b on numero=n
			where n is null ";

			$RqueryNum = mysql_query($queryNum);
					
		$data['nomof_3010'] = $nomof."-FUERZA-".str_pad(mysql_result($RqueryNum,0), 2, "0", STR_PAD_LEFT);

		$b = mysql_query("SELECT gabinete_adtran,repisa_adtran from(
							SELECT gabinete_adtran,repisa_adtran from telealimentacion_adtran_interna where nombre_oficial_3010 like '".$nomof."%' and area='".$A_area."' GROUP BY gabinete_adtran,repisa_adtran union
							SELECT gabinete_adtran,repisa_adtran from telealimentacion_adtran where nombre_oficial_3010 like '".$nomof."%'   GROUP BY gabinete_adtran,repisa_adtran) as query_gab");

// echo "SELECT gabinete_adtran,repisa_adtran from(
// 							SELECT gabinete_adtran,repisa_adtran from telealimentacion_adtran_interna where nombre_oficial_3010 like '".$nomof."%' and area='".$A_area."' GROUP BY gabinete_adtran,repisa_adtran union
// 							SELECT gabinete_adtran,repisa_adtran from telealimentacion_adtran where nombre_oficial_3010 like '".$nomof."%'   GROUP BY gabinete_adtran,repisa_adtran) as query_gab";
// exit();
		$repisa_ocupadas = array();	

		if(mysql_num_rows($b)!=0){
		$data['gabinete']=mysql_result($b,0,0);

				for ($i=0; $i <mysql_num_rows($b) ; $i++) { 
					$repisa_ocupadas[]= mysql_result($b,$i,1);
				}
		}

		$repisa_nueva = array();

		for ($i=1; $i < 9 ; $i++) { 
			$repisa_nueva[]=$i;
		}

		$data['repisas'] = array_diff($repisa_nueva, $repisa_ocupadas); 


		/**** UBICACION ***/

		# SALA

		$querySal = mysql_query("SELECT codigo,tipo_sala FROM cat_salas");


		for ($i=0; $i <mysql_num_rows($querySal) ; $i++) { 
		    $data["sala"][$i] = mysql_result($querySal,$i,0).",".mysql_result($querySal,$i,1);
		}

		#PISO

		$queryPis = mysql_query("SELECT piso,codigo FROM cat_pisos");


		for ($i=0; $i <mysql_num_rows($queryPis) ; $i++) { 
		    $data["piso"][$i] = mysql_result($queryPis,$i,0)." - ".mysql_result($queryPis,$i,1);
		}





	echo json_encode($data);
}


/********    **********/

if($central_dslD!='' or $central_dsls!=''){

	if($central_dslD!=''){
		list($cd,$sc)=explode(",",$central_dslD);
	}elseif($central_dsls!=''){
		list($cd,$sc)=explode(",",$central_dsls);
	}


	$b = mysql_query("SELECT '' as distrito union SELECT DISTINCT distrito from distritos_telealimentacion where siglas_central='".trim($sc)."' ORDER BY distrito");

			if(mysql_num_rows($b)!=0){

				for ($i=0; $i <mysql_num_rows($b) ; $i++) { 
					$data['distrito'][$i] = mysql_result($b,$i,0);
				}
				
			}	

echo json_encode($data);
}




/******    *******/
if($central_dslSS!=''){

		list($cd,$sc)=explode(",",$central_dslSS);

	$b = mysql_query("SELECT '' as distrito union SELECT DISTINCT distrito from distritos_telealimentacion where siglas_central='".trim($sc)."' ORDER BY distrito");

			if(mysql_num_rows($b)!=0){

				for ($i=0; $i <mysql_num_rows($b) ; $i++) { 
					$data['distrito'][$i] = mysql_result($b,$i,0);
				}
				
			}	

echo json_encode($data);
}




/*********** GABINETE REPISA LPU **************/

if($gabinete!='' && $repisa!='' && $lpu!=''){
	

list($e,$siglas_insert)=explode("-",$nom_of3010);


$c = mysql_query("SELECT edo,clli_edif from centrales where area='".$areas."' and sigcent=trim('".$siglas_insert."')");
	$edo_r = mysql_result($c,0,0);
	$clli_e_r = mysql_result($c,0,1);
			
$respaldo = "INSERT INTO telealimentacion_adtran_3010
(login,fecha_alta,proveedor,division,estado,area,nombre_central,siglas_central,nombre_oficial_pisa,direccion_ip,ch_resp,ch_estatus_cns2,ubicacion,clli_edificio)
SELECT '".$login."' as login,now() as fecha_alta,'ADTRAN' as proveedor,division,'".$edo_r."' as estado,area,central,siglas_central,'".$nom_of3010."' as nombre_oficial_3010,
'".$ip."' as direccion_ip,'CNS II' as ch_resp,'CONFIGURAR' as ch_estatus_cns2,'".trim($ubicacion)."' as ubicacion,'".trim($clli_e_r)."' as clli_edificio 
from distritos_telealimentacion where siglas_central='".$siglas_insert."' and area='".$areas."' group by siglas_central,area";



mysql_query($respaldo);


			for ($u=1; $u < 9; $u++) { 
				for ($k=1; $k <5 ; $k++) { 
	
				$sql_insert = "INSERT INTO telealimentacion_adtran_interna(division,area,nombre_central,siglas_central,nombre_oficial_3010,lpu_adtran,par_cable_adtran,direccion_ip,gabinete_adtran,repisa_adtran,tipo_tablilla,ubicacion)
					SELECT division,area,central,siglas_central,'".$nom_of3010."' as nombre_oficial_3010,".$u." as lpu_adtran, ".$k." as par_cable_adtran,
					'".$ip."' as direccion_ip,'".$gabinete."' as gabinete_adtran,'".$repisa."' as repisa_adtran,'".$tipo_tablilla."' as tipo_tablilla, '".trim($ubicacion)."' as ubicacion 
					from distritos_telealimentacion where siglas_central='".$siglas_insert."' and area='".$areas."' group by siglas_central";
				
				mysql_query($sql_insert);
				}
			}
	

	for ($i=0; $i <count($lpu) ; $i++) { 

				for ($j=1; $j <=4 ; $j++) { 

						$b = "UPDATE telealimentacion_adtran_interna set login='".$login."',fecha_alta=now(),proveedor='adtran',
						vertical_pos='".$_POST['vertical_pos_'.$lpu[$i]]."',nivel_pos='".$_POST['nivel_pos_'.$lpu[$i]]."',pin_pos='".$_POST['pin_pos_'.$lpu[$i]."_".$j]."',
						vertical_neg='".$_POST['vertical_neg_'.$lpu[$i]]."',nivel_neg='".$_POST['nivel_neg_'.$lpu[$i]]."',pin_neg='".$_POST['pin_neg_'.$lpu[$i]."_".$j]."', 
						equipo_adtran='TBA',distrito='".$_POST['distrito_'.$lpu[$i]]."',tipo_tablilla='".$tipo_tablilla."',estado='".$e."' 
						where siglas_central='".$siglas_insert."' and area='".$areas."' and nombre_oficial_3010='".$nom_of3010."' and 
						lpu_adtran='".$lpu[$i]."' and par_cable_adtran='".$j."'";
				 
				 mysql_query($b);
	
				}				
	}
	
	###############PUERTO LOGICO###############################3
	$log=mysql_query("SELECT lpu_adtran from telealimentacion_adtran_interna where  nombre_oficial_3010='".$nom_of3010."'");

	  while ($logico=mysql_fetch_array($log)) {
	  	$ee=$logico[0];
	  	
		  for ($i=0; $i<=$ee;  $i++) { 
		  
			  $d=$ee+($ee-1);
			  	mysql_query("UPDATE telealimentacion_adtran_interna set lpu_adtran_logico='$d' where lpu_adtran=".$ee." and nombre_oficial_3010='".$nom_of3010."'");
		  }
	  

	  }

echo "Se ha dado de alta correctamente";
}


/*  CENTRALES A_AREA  */


if($centrales!='' && $A_area!=''){

	list($ce,$se)=explode(",",$centrales);


$c = mysql_query("SELECT edo from centrales where area='".$A_area."' and sigcent=trim('".$se."')");
	$a_edo = mysql_result($c,0);

$a = mysql_query("SELECT nombre_oficial_3010 from telealimentacion_adtran_interna where nombre_oficial_3010 like '".trim($a_edo)."-".trim($se)."%'  
	and area='".$A_area."' and (equipo_adtran is null or equipo_adtran='') GROUP BY nombre_oficial_3010");

	if(mysql_num_rows($a)!=''){

	
			for ($i=0; $i < mysql_num_rows($a) ; $i++) { 
				$data['nom3010'][$i]= mysql_result($a,$i,0);
			}	


		echo json_encode($data);	
	}else{
		echo json_encode("VACIO");
	}
	
}


/*   */

if($XXX!=''){

list($cd,$sc)=explode(",",$XXX);

	$b = mysql_query("SELECT '' as distrito union SELECT DISTINCT distrito from distritos_telealimentacion where siglas_central='".trim($sc)."' ORDER BY distrito");

			if(mysql_num_rows($b)!=0){

				for ($i=0; $i <mysql_num_rows($b) ; $i++) { 
					$data['distrito'][$i] = mysql_result($b,$i,0);
				}
				
			}	

echo json_encode($data);	
}


/***************   ****************************/

if($nom_of_enc!='' && $gabinete_enc=='' ){

	$a = "SELECT gabinete_adtran,repisa_adtran,direccion_ip,lpu_adtran,tipo_tablilla from telealimentacion_adtran_interna where nombre_oficial_3010 
	like '%".$nom_of_enc."%' and   (equipo_adtran is null or equipo_adtran='') GROUP BY gabinete_adtran,repisa_adtran,lpu_adtran";

	$a = "SELECT gabinete_adtran,repisa_adtran,direccion_ip,lpu_adtran,tipo_tablilla from telealimentacion_adtran_interna where 
	nombre_oficial_3010 = '".$nom_of_enc."' and  (equipo_adtran is null or equipo_adtran='') GROUP BY gabinete_adtran,repisa_adtran,lpu_adtran";

	

	$b = mysql_query($a);
	
	if(mysql_num_rows($b)!=0){
		$data['gabinete'] = mysql_result($b,0,0);
		$data['repisa'] = mysql_result($b,0,1);
		$data['ip'] = mysql_result($b,0,2);
		$data['tipo_tablilla'] = mysql_result($b,0,4);


		for ($i=0; $i <mysql_num_rows($b) ; $i++) { 
			$data['lpu'][$i] = mysql_result($b,$i,3);
		}
		
	}
	
	$sql_pin = "SELECT DISTINCT pin_pos from telealimentacion_adtran_interna where nombre_oficial_3010 ='".$nom_of_enc."' and (pin_neg is not null or pin_pos='') order by pin_pos";
	$sqlPin = mysql_query($sql_pin);

	for ($i=0; $i <mysql_num_rows($sqlPin) ; $i++) { 
			$data['pinDis'][$i] = intval(mysql_result($sqlPin,$i,0));
		}
	echo json_encode($data);
}



if($nom_of3010_enc!='' && $gabinete_enc!='' && $repisa_enc!='' && $lpu_enc!=''){
	
	list($e,$s)=explode("-",$nom_of3010_enc);

	for ($i=0; $i <count($lpu_enc) ; $i++) { 

				for ($j=1; $j <=4 ; $j++) { 

						$b = "UPDATE telealimentacion_adtran_interna set login='".$login."',fecha_alta=now(),proveedor='adtran',
						vertical_pos='".$_POST['vertical_pos_'.$lpu_enc[$i]]."',nivel_pos='".$_POST['nivel_pos_'.$lpu_enc[$i]]."',pin_pos='".$_POST['pin_pos_'.$lpu_enc[$i]."_".$j]."',
						vertical_neg='".$_POST['vertical_neg_'.$lpu_enc[$i]]."',nivel_neg='".$_POST['nivel_neg_'.$lpu_enc[$i]]."',pin_neg='".$_POST['pin_neg_'.$lpu_enc[$i]."_".$j]."', 
						equipo_adtran='TBA',estado='".$e."',distrito='".$_POST['distrito_'.$lpu_enc[$i]]."'
						where siglas_central='".$s."' and area='".$areas."' and nombre_oficial_3010='".$nom_of3010_enc."' and 
						lpu_adtran='".$lpu_enc[$i]."' and par_cable_adtran='".$j."'";
				
					mysql_query($b);
				}				
	}

echo "Se han guardado los cambios correctamente";

}



if($nomofProp!=''){

	$sqlNumExist = "SELECT nombre_oficial_3010 from telealimentacion_adtran_interna where nombre_oficial_3010= '".$nomofProp."' GROUP BY nombre_oficial_3010";
	
	$NumExist = mysql_query($sqlNumExist);


	if(mysql_num_rows($NumExist)!=''){
		$existe = "Existe";
	}else{
		$existe = "No existe";
	}


	echo json_encode($existe);
}






?>


