<?php  
header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL & ~E_NOTICE);
include '..\sesion.php';
include 'enlaces.php';
include('functions/conexion.php');
include('functions/tildeReplace.php');

include($link_grid);
$con=$conectar;

// $sess_empresa=$sess_empresa[];
$se=mysql_fetch_array(mysql_query("SELECT empresa FROM usuarios.seg_usuarios WHERE login='$sess_usr'"));
$sess_empresa=$se[0];
if($sess_empresa=='TELMEX' or $sess_empresa=='OMSASI' or $sess_empresa=='COMERTEL ARGOS' or $sess_empresa==null or $sess_empresa=='PROIT')$prov=""; else {$prov=" prove='$sess_empresa'"; $aux1=true;}
if($sess_dd=='%')$dd="";else {$dd=" AND dir_div like '$sess_dd'"; $aux1=true;}

if($aux1) $aux_sql1=" where ";

$base_path = "lib/";
include($base_path."inc/jqgrid_dist.php");

$sql = "SELECT id,capturar,folio,nuevo_adecuacion,rubro,dir_div,area,sigcent,edificio,prove,tecno,fecha_solicitud,fecha_programada,fecha_captura,fecha_ejecucion,
		fecha_validacion,estatus,descarga,plan,equipos,tarjetas,puertos,ctnombre,rsnombre,cpnombre,version,obra_civil,afo_canaleta,bfo_canaleta,mp_canaleta,cx_canaleta,
		gs_canaleta,fz_canaleta,afo_bastidor_fibra,bloque_dfo,bfo_bastidor_fibra,dfo,mp_dgral,mp_ampvertical,tablilla_nueva,cx_escalerilla_bdtd,gs_puertoRCDT,nuevo_existente 
		FROM infinitum_unica.grid_surveys $aux_sql1 $prov $dd";
$r=mysql_query($sql,$con);
# echo $sql;


while($c=mysql_fetch_array($r)){
	$variables['id'][]=$c[0];
	$variables['capturar'][]=$c[1];
	$variables['folio'][] = $c[2];
	// $variables['nuevo_adecuacion'][] = $c[3];
	$variables['rubro'][] = $c[4];
	$variables['dir_div'][] = $c[5];
	$variables['area'][] =  $c[6];
	$variables['sigcent'][] =  $c[7];
	$variables['edificio'][] = $c[8];
	$variables['prove'][] = $c[9];
	$variables['tecno'][] = $c[10];
	$variables['fecha_solicitud'][] = $c[11];
	$variables['fecha_programada'][] = $c[12];
	$variables['fecha_captura'][] = $c[13];
	$variables['fecha_ejecucion'][] = $c[14];
	$variables['fecha_validacion'][] = $c[15];
	$variables['estatus'][] = $c[16];
	$variables['descarga'][] = $c[17];
	$variables['plan'][] = $c[18];
	$variables['equipos'][] = $c[19];
	$variables['tarjetas'][] = $c[20];
	$variables['puertos'][] = $c[21];
	$variables['ctnombre'][] = tildeDecode($c[22]);
	$variables['rsnombre'][] = tildeDecode($c[23]);
	$variables['cpnombre'][] = tildeDecode($c[24]);
	$variables['version'][] = $c[25];
}			

for ($i=0;$i<=count($variables['id'])-1;$i++){ 
	$data[$i]['id']= $variables['id'][$i]; 
	$data[$i]['capturar']= $variables['capturar'][$i]; 
    $data[$i]['folio']= $variables['folio'][$i]; 
    // $data[$i]['nuevo_adecuacion'] = $variables['nuevo_adecuacion'][$i]; 
    $data[$i]['rubro'] = $variables['rubro'][$i]; 
    $data[$i]['dir_div'] = $variables['dir_div'][$i]; 
    $data[$i]['area'] = $variables['area'][$i]; 
    $data[$i]['sigcent'] = $variables['sigcent'][$i]; 
    $data[$i]['edificio'] = $variables['edificio'][$i];
	$data[$i]['prove'] = $variables['prove'][$i]; 
    $data[$i]['tecno'] = $variables['tecno'][$i]; 
    $data[$i]['fecha_solicitud'] = $variables['fecha_solicitud'][$i]; 
    $data[$i]['fecha_programada'] = $variables['fecha_programada'][$i]; 
    $data[$i]['fecha_captura'] = $variables['fecha_captura'][$i]; 
    $data[$i]['fecha_ejecucion'] = $variables['fecha_ejecucion'][$i]; 
    $data[$i]['fecha_validacion'] = $variables['fecha_validacion'][$i]; 
    $data[$i]['estatus'] = $variables['estatus'][$i]; 
    $data[$i]['descarga'] = $variables['descarga'][$i]; 
    $data[$i]['plan'] = $variables['plan'][$i]; 
    $data[$i]['equipos'] = $variables['equipos'][$i]; 
    $data[$i]['tarjetas'] = $variables['tarjetas'][$i]; 
    $data[$i]['puertos'] = $variables['puertos'][$i]; 
    $data[$i]['ctnombre'] = $variables['ctnombre'][$i]; 
    $data[$i]['rsnombre'] = $variables['rsnombre'][$i]; 
    $data[$i]['cpnombre'] = $variables['cpnombre'][$i]; 
    $data[$i]['version'] = $variables['version'][$i]; 
} 

if(count($data)!=0){
	$nd=array_unique($variables['dir_div']); 			sort($nd);	foreach($nd as $nd1){$nd2.=$nd1.":".$nd1.";";}	$nd3=substr($nd2,0,-1);
	$ar=array_unique($variables['area']); 	 			sort($ar);	foreach($ar as $ar1){$ar2.=$ar1.":".$ar1.";";}	$ar3=substr($ar2,0,-1);	
	$sg=array_unique($variables['sigcent']); 			sort($sg);	foreach($sg as $sg1){$sg2.=$sg1.":".$sg1.";";}	$sg3=substr($sg2,0,-1);
	$ed=array_unique($variables['edificio']);			sort($ed);	foreach($ed as $ed1){$ed2.=$ed1.":".$ed1.";";}	$ed3=substr($ed2,0,-1);	
	$fs=array_unique($variables['fecha_solicitud']);	sort($fs);	foreach($fs as $fs1){$fs2.=$fs1.":".$fs1.";";}	$fs3=substr($fs2,0,-1);
	$fp=array_unique($variables['fecha_programada']);	sort($fp);	foreach($fp as $fp1){$fp2.=$fp1.":".$fp1.";";}	$fp3=substr($fp2,0,-1);
	$fc=array_unique($variables['fecha_captura']);		sort($fc); 	foreach($fc as $fc1){$fc2.=$fc1.":".$fc1.";";}	$fc3=substr($fc2,0,-1);
	$fe=array_unique($variables['fecha_ejecucion']);	sort($fe);	foreach($fe as $fe1){$fe2.=$fe1.":".$fe1.";";}	$fe3=substr($fe2,0,-1);
	$fv=array_unique($variables['fecha_validacion']);	sort($fv);	foreach($fv as $fv1){$fv2.=$fv1.":".$fv1.";";}	$fv3=substr($fv2,0,-1);
	$es=array_unique($variables['estatus']);			sort($es);	foreach($es as $es1){$es2.=$es1.":".$es1.";";}	$es3=substr($es2,0,-1);
	$pr=array_unique($variables['prove']);				sort($pr);	foreach($pr as $pr1){$pr2.=$pr1.":".$pr1.";";}	$pr3=substr($pr2,0,-1);
	$tc=array_unique($variables['tecno']);				sort($tc);	foreach($tc as $tc1){$tc2.=$tc1.":".$tc1.";";}	$tc3=substr($tc2,0,-1);
	$rb=array_unique($variables['rubro']);				sort($rb); 	foreach($rb as $rb1){$rb2.=$rb1.":".$rb1.";";}	$rb3=substr($rb2,0,-1);
	$pl=array_unique($variables['plan']);				sort($pl); 	foreach($pl as $pl1){$pl2.=$pl1.":".$pl1.";";}	$pl3=substr($pl2,0,-1);
	$ct=array_unique($variables['ctnombre']);			sort($ct); 	foreach($ct as $ct1){$ct2.=$ct1.":".$ct1.";";}	$ct3=substr($ct2,0,-1);
	$rs=array_unique($variables['rsnombre']);			sort($rs); 	foreach($rs as $rs1){$rs2.=$rs1.":".$rs1.";";}	$rs3=substr($rs2,0,-1);
	$cp=array_unique($variables['cpnombre']);			sort($cp); 	foreach($cp as $cp1){$cp2.=$cp1.":".$cp1.";";}	$cp3=substr($cp2,0,-1);
	$vs=array_unique($variables['version']);			sort($vs); 	foreach($vs as $vs1){$vs2.=$vs1.":".$vs1.";";}	$vs3=substr($vs2,0,-1);
}

$g = new jqgrid();  

$col = array(); 
$col["title"] = "ID"; 
$col["title1"] = "ID"; 
$col["name"] = "id"; 
// $col["dbname"] = "a.id"; 
$col["width"] = "20"; 
$col["editable"] = false;
$col["align"] = "center";
$col["hidden"] = true;
$col["search"] = false;
$col["sortable"] = false; 
$col["export"] = false; 
$cols[] = $col;

$col = array(); 
$col["title"] = ""; 
$col["title1"] = ""; 
$col["alternate"] = "h";
$col["name"] = "capturar"; 
$col["width"] = "20"; 
$col["editable"] = false;
$col["align"] = "center";
$col["search"] = false;
$col["sortable"] = false; 
$col["export"] = false; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="Folio" style="display: inline;">Folio</div>'; 
$col["title1"] = "FOLIO"; 
$col["name"] = "folio"; 
// $col["dbname"] = "a.folio"; 
$col["width"] = "80"; 
$col["editable"] = false;
$col["align"] = "left"; 
$col["search"] = true; 
//$col["link"] = "formato.php?folio={folio}";
$col["export"] = true; 
$cols[] = $col;

/* $col = array(); 
$col["title"] = "NVO/ADEC"; 
$col["title1"] = "ID"; 
$col["name"] = "nuevo_adecuacion"; 
$col["width"] = "40"; 
$col["editable"] = false;
$col["align"] = "left"; 
$col["search"] = true;
// $na_lookup = $g->get_dropdown_values("SELECT distinct a.nuevo_adecuacion as k,a.nuevo_adecuacion as v FROM infinitum_unica.zsite_survey a INNER JOIN 	
									  // infinitum_unica.centrales b ON a.id_central=b.id_ctl WHERE a.id_central=b.id_ctl $dd"); 
// $col["stype"] = "select"; 
// $str = ":Todos;".$na_lookup; 
// $col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true;
$cols[] = $col; */

$col = array(); 
$col["title"] = '<div title="Direcci&oacute;n Divisional" style="display: inline;">DD</div>';
$col["title1"] = "DD"; 
$col["name"] = "dir_div"; 
// $col["dbname"] = "a.dir_div"; 
$col["width"] = "65"; 
$col["editable"] = false;
$col["align"] = "left"; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;".$nd3; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";");
$col["export"] = true; 
$cols[] = $col; 

$col = array(); 
$col["title"] = '<div title="Area" style="display: inline;">Area</div>';
$col["title1"] = "AREA"; 
$col["name"] = "area"; 
$col["width"] = "120";  
$col["editable"] = false; 
$col["align"] = "left"; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;".$ar3; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";");
$col["export"] = true; 
$cols[] = $col; 

$col = array(); 
$col["title"] = '<div title="Sigla" style="display: inline;">Sigla</div>';
$col["title1"] = "SIGLA"; 
$col["name"] = "sigcent"; 
$col["width"] = "35"; 
$col["editable"] = false; 
$col["align"] = "left"; 
$col["search"] = true; 	
$col["stype"] = "select"; 
$str = ":Todo;".$sg3; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";");
$col["export"] = true; 
$cols[] = $col; 

$col = array(); 
$col["title"] = '<div title="Central" style="display: inline;">Central</div>';
$col["title1"] = "CENTRAL"; 
$col["name"] = "edificio"; 
$col["width"] = "140"; 
$col["editable"] = false; 
$col["align"] = "left"; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;".$ed3; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";");
$col["export"] = true; 
$cols[] = $col; 

$col = array(); 
$col["title"] = '<div title="Rubro" style="display: inline;">Rubro</div>';
$col["title1"] = "RUBRO"; 
$col["name"] = "rubro"; 
$col["width"] = "40"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;".$rb3; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";");
$col["export"] = true; 
$cols[] = $col; 

$col = array(); 
$col["title"] = '<div title="Proveedor" style="display: inline;">Prov.</div>';
$col["title1"] = "PROV."; 
$col["name"] = "prove"; 
$col["width"] = "90"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;".$pr3; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="Tecnolog&iacute;a" style="display: inline;">Tecnol.</div>';
$col["title1"] = "TECNOL."; 
$col["name"] = "tecno"; 
$col["width"] = "55"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;".$tc3; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="Solicitud" style="display: inline;">Sol.</div>';
$col["title1"] = "FECHA SOL."; 
$col["name"] = "fecha_solicitud"; 
$col["width"] = "55"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;".$fs3; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col; 

$col = array(); 
$col["title"] = '<div title="Programado" style="display: inline;">Prog.</div>';
$col["title1"] = "FECHA PROG."; 
$col["name"] = "fecha_programada"; 
$col["width"] = "55"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;".$fp3; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";");
$col["export"] = true; 
$cols[] = $col; 

$col = array(); 
$col["title"] = '<div title="Ejecuci&oacute;n" style="display: inline;">Ejec.</div>';
$col["title1"] = "FECHA EJEC."; 
$col["name"] = "fecha_ejecucion"; 
$col["width"] = "55"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;".$fe3; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col; 

$col = array(); 
$col["title"] = '<div title="Carga" style="display: inline;">Carga</div>';
$col["title1"] = "FECHA CARGA";  
$col["name"] = "fecha_captura";
$col["width"] = "55"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;".$fc3; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";");
$col["export"] = true; 
$cols[] = $col; 

$col = array(); 
$col["title"] = '<div title="Validaci&oacute;n" style="display: inline;">Valid.</div>';
$col["title1"] = "FECHA VALID."; 
$col["name"] = "fecha_validacion"; 
$col["width"] = "55"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;".$fv3; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";");
$col["export"] = true; 
$cols[] = $col; 

$col = array(); 
$col["title"] = '<div title="Estatus" style="display: inline;">Estatus</div>';
$col["title1"] = "ESTATUS"; 
$col["name"] = "estatus"; 
$col["width"] = "70"; 
$col["editable"] = false;
$col["align"] = "center";
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;".$es3; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";");
$col["export"] = true; 
$cols[] = $col; 

$col = array(); 
$col["title"] = "<img style=\"text-decoration:none; border-style:none; border-collapse:collapse;\" height=15 src=\"./img/pdf.png\">"; 
$col["title1"] = "PDF"; 
$col["name"] = "descarga"; 
$col["width"] = "16"; 
$col["editable"] = false;
$col["align"] = "center";
$col["search"] = false;
$col["sortable"] = false; 
$col["export"] = false; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="Plan" style="display: inline;">Plan</div>';
$col["title1"] = "PLAN"; 
$col["name"] = "plan"; 
// $col["dbname"] = "a.plan"; 
$col["width"] = "90"; 
$col["editable"] = false;
$col["align"] = "left";
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;".$pl3; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";");
$col["export"] = true; 
$cols[] = $col; 

$col = array(); 
$col["title"] = '<div title="Total equipos" style="display: inline;">Eqs.</div>';
$col["title1"] = "EQS."; 
$col["name"] = "equipos"; 
$col["width"] = "60"; 
$col["editable"] = false;
$col["search"] = false; 
$col["align"] = "center";
$col["export"] = true; 
$cols[] = $col; 

$col = array(); 
$col["title"] = '<div title="Total tarjetas" style="display: inline;">Tjs.</div>';
$col["title1"] = "TJS."; 
$col["name"] = "tarjetas"; 
$col["width"] = "60"; 
$col["editable"] = false;
$col["search"] = false;
$col["align"] = "center";
$col["export"] = true; 
$cols[] = $col;  

$col = array(); 
$col["title"] = '<div title="Total puertos" style="display: inline;">Pts.</div>';
$col["title1"] = "PTS."; 
$col["name"] = "puertos"; 
$col["width"] = "60"; 
$col["editable"] = false;
$col["search"] = false;
$col["align"] = "center";
$col["export"] = true; 
$cols[] = $col;  

$col = array(); 
$col["title"] = '<div title="Responsable de Proyecto" style="display: inline;">Proyecto</div>';
$col["title1"] = "RESP. PROYECTO"; 
$col["name"] = "ctnombre"; 
$col["width"] = "160"; 
$col["editable"] = false; 
$col["align"] = "left"; 
$col["hidden"] = true; 
$col["search"] = true; 
// $col["stype"] = "select"; 
// $str = ":Todo;".$ct3; 
// $col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";");
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="Responsable en Sitio" style="display: inline;">Sitio</div>';
$col["title1"] = "RESP. SITIO"; 
$col["name"] = "rsnombre"; 
$col["width"] = "160"; 
$col["editable"] = false; 
$col["align"] = "left";
$col["hidden"] = true;  
$col["search"] = true; 
// $col["stype"] = "select"; 
// $str = ":Todo;".$rs3; 
// $col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";");
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="Responsable Proveedor" style="display: inline;">Proveedor</div>';
$col["title1"] = "RESP. PROV."; 
$col["name"] = "cpnombre"; 
$col["width"] = "160"; 
$col["editable"] = false; 
$col["align"] = "left";
$col["hidden"] = true;  
$col["search"] = true; 
// $col["stype"] = "select"; 
// $str = ":Todo;".$cp3; 
// $col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";");
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="Versi&oacute;n" style="display: inline;">Versi&oacute;n</div>';
$col["title1"] = "VERSION"; 
$col["name"] = "version"; 
$col["width"] = "35"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["hidden"] = true; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;".$vs3; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="OBRA CIVIL" style="display: inline;">OC</div>';
$col["title1"] = "OBRA CIVIL"; 
$col["name"] = "obra_civil"; 
$col["width"] = "70"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["hidden"] = false; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;SI:SI;NO:NO"; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="CANALETA FIBRA OPTICA (AO)" style="display: inline;">FO(AO)</div>';
$col["title1"] = "CANALETA FIBRA OPTICA (AO)"; 
$col["name"] = "afo_canaleta"; 
$col["width"] = "70"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["hidden"] = false; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;SI:SI;NO:NO"; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="CANALETA FIBRA OPTICA (BO)" style="display: inline;">FO(BO)</div>';
$col["title1"] = "CANALETA FIBRA OPTICA (BO)"; 
$col["name"] = "bfo_canaleta"; 
$col["width"] = "70"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["hidden"] = false; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;SI:SI;NO:NO"; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="CANALETA MULTIPAR" style="display: inline;">MP</div>';
$col["title1"] = "CANALETA MULTIPAR"; 
$col["name"] = "mp_canaleta"; 
$col["width"] = "70"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["hidden"] = false; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;SI:SI;NO:NO"; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="CANALETA COAXIAL" style="display: inline;">CX</div>';
$col["title1"] = "CANALETA COAXIAL"; 
$col["name"] = "cx_canaleta"; 
$col["width"] = "70"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["hidden"] = false; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;SI:SI;NO:NO"; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="CANALETA GESTION/SINCRONIA" style="display: inline;">GS</div>';
$col["title1"] = "CANALETA GESTION/SINCRONIA"; 
$col["name"] = "gs_canaleta"; 
$col["width"] = "70"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["hidden"] = false; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;SI:SI;NO:NO"; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="CANALETA ALIMENTACION" style="display: inline;">FZ</div>';
$col["title1"] = "CANALETA ALIMENTACION"; 
$col["name"] = "fz_canaleta"; 
$col["width"] = "70"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["hidden"] = false; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;SI:SI;NO:NO"; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="BASTIDOR DE FIBRAS (AO)" style="display: inline;">BF(AO)</div>';
$col["title1"] = "BASTIDOR DE FIBRAS (AO)"; 
$col["name"] = "afo_bastidor_fibra"; 
$col["width"] = "70"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["hidden"] = false; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;SI:SI;NO:NO"; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="BLOQUE DFO (AO)" style="display: inline;">B.DFO (AO)</div>';
$col["title1"] = "BLOQUE DFO (AO)"; 
$col["name"] = "bloque_dfo"; 
$col["width"] = "70"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["hidden"] = false; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;SI:SI;NO:NO"; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="BASTIDOR DE FIBRAS (BO)" style="display: inline;">BF(BO)</div>';
$col["title1"] = "BASTIDOR DE FIBRAS (BO)"; 
$col["name"] = "bfo_bastidor_fibra"; 
$col["width"] = "70"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["hidden"] = false; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;SI:SI;NO:NO"; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="BLOQUE DFO (BO)" style="display: inline;">B.DFO (BO)</div>';
$col["title1"] = "BLOQUE DFO (BO)"; 
$col["name"] = "dfo"; 
$col["width"] = "70"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["hidden"] = false; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;SI:SI;NO:NO"; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="DISTRIBUIDOR GENERAL" style="display: inline;">DG</div>';
$col["title1"] = "DISTRIBUIDOR GENERAL"; 
$col["name"] = "mp_dgral"; 
$col["width"] = "70"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["hidden"] = false; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;SI:SI;NO:NO"; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="AMPLIACION VERTICALES" style="display: inline;">AMP. VERT.</div>';
$col["title1"] = "AMPLIACION VERTICALES"; 
$col["name"] = "mp_ampvertical"; 
$col["width"] = "70"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["hidden"] = false; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;SI:SI;NO:NO"; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="TABLILLAS" style="display: inline;">TABLILLAS</div>';
$col["title1"] = "TABLILLAS"; 
$col["name"] = "tablilla_nueva"; 
$col["width"] = "70"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["hidden"] = false; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;SI:SI;NO:NO"; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="BDTD" style="display: inline;">BDTD</div>';
$col["title1"] = "BDTD"; 
$col["name"] = "cx_escalerilla_bdtd"; 
$col["width"] = "70"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["hidden"] = false; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;SI:SI;NO:NO"; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="RCDT" style="display: inline;">RCDT</div>';
$col["title1"] = "RCDT"; 
$col["name"] = "gs_puertoRCDT"; 
$col["width"] = "70"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["hidden"] = false; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;SI:SI;NO:NO"; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = '<div title="POSICIONES DE ALIMENTACION" style="display: inline;">POS. FZ</div>';
$col["title1"] = "POSICIONES DE ALIMENTACION"; 
$col["name"] = "nuevo_existente"; 
$col["width"] = "70"; 
$col["editable"] = false; 
$col["align"] = "center"; 
$col["hidden"] = false; 
$col["search"] = true; 
$col["stype"] = "select"; 
$str = ":Todo;SI:SI;NO:NO"; 
$col["searchoptions"] = array("value" => $str, "separator" => ":", "delimiter" => ";"); 
$col["export"] = true; 
$cols[] = $col;

$grid["rowNum"] = 100;
$grid["sortname"] = "id"; 
$grid["sortorder"] = "ASC";
$grid["caption"] = "Seguimiento a Site Surveys"; 
$grid["height"] = "350";  
$grid["autowidth"] = false;
$grid["forceFit"] = false;
$grid["shrinkToFit"] = false;
$grid["hiddengrid"] = false;
$grid["multiselect"] = false;
$grid["footerrow"] = false;
$grid["rowList"] = false;
$grid["resizable"] = true;

$grid["altRows"] = true; 
$grid["altclass"] = "myAltRowClass"; 

$grid["export"] = array("format"=>"excel","filename"=>"Site Surveys","sheetname"=>"Surveys","range"=>"filtered"); 

$g->set_options($grid); 

$g->set_actions(array(     
                        "add"=>false, 
                        "edit"=>false, 
                        "delete"=>false, 
                        "rowactions"=>false, 
					    "showhidecolumns"=>true,
                        "export"=>true,  
                        "autofilter" => true,						
						"search" => "advance"
                      )  
                ); 					

$g->select_command = $sql;	
					
if(count($data)!=0){	
	$g->set_columns($cols);
	$out = $g->render("list1");
}
 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html> 
<head> 
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="lib/js/themes/frida_gris/jquery-ui.custom.css"></link>     
    <link rel="stylesheet" type="text/css" media="screen" href="lib/js/jqgrid/css/ui.jqgrid.css"></link>     
    <script src="lib/js/jquery.min.js" type="text/javascript"></script> 
	<link rel="stylesheet" type="text/css" href="<?php echo $style_grid;?>" media="screen"></link>
    <script src="lib/js/jqgrid/js/i18n/grid.locale-es.js" type="text/javascript"></script> 
    <script src="lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>     
    <script src="lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script> 
</head> 
<body> 
<style>
    body{background:#fff}
	.ui-jqgrid tr.jqgrow td{ vertical-align: top; white-space: normal;	}
    .myAltRowClass{background-color:#E4F1FF;background-image:none;}
	.ColTable tr{display: block; float: left; width: 100px;}
</style>
<div id="header">
    <h1><a href="<?php echo $link_site; ?>">F R I D A</a></h1>
	<h2>Facilidades Red Infinitum Datos de Acceso</h2>
    <h3>ESTATUS DE SITE SURVEY</h3>
</div>
<script type="text/javascript"> 
var opts ={
	'loadComplete': function(){	
		var grid = $("#list1");
		grid.jqGrid('destroyGroupHeader',false);
		grid.jqGrid('setGroupHeaders',{
			useColSpanStyle: true,
			groupHeaders: [
				{startColumnName: 'id',numberOfColumns: 25,titleText:''},
				{startColumnName: 'obra_civil',numberOfColumns: 17,titleText:'INFRAESTRUCTURA ADICIONAL'}
			]
		});
		grid.jqGrid('setGroupHeaders',{
			useColSpanStyle: true,
			groupHeaders: [
				{startColumnName: 'fecha_solicitud',numberOfColumns: 5,titleText:'FECHAS'},
				{startColumnName: 'tarjetas',numberOfColumns: 2,titleText:'ACCESO'},
				{startColumnName: 'afo_canaleta',numberOfColumns: 6,titleText:'CANALETAS'},
				{startColumnName: 'afo_bastidor_fibra',numberOfColumns: 2,titleText:'ALTO ORDEN'},
				{startColumnName: 'bfo_bastidor_fibra',numberOfColumns: 2,titleText:'BAJO ORDEN'},
				{startColumnName: 'mp_dgral',numberOfColumns: 3,titleText:'MULTIPAR'},
				{startColumnName: 'cx_escalerilla_bdtd',numberOfColumns: 1,titleText:'COAXIAL'},
				{startColumnName: 'gs_puertoRCDT',numberOfColumns: 1,titleText:'G/S'},
				{startColumnName: 'nuevo_existente',numberOfColumns: 1,titleText:'FZ'}
			]
		});
	<?php for($i=2;$i<count($campos);$i++){
			echo $campos[$i]["name"]."= grid.jqGrid('getCol',"."'".$campos[$i]['name']."'".", false, 'sum');";
			echo "grid.jqGrid('footerData','set',{".$campos[$i]['name'].": ".$campos[$i]['name']."});";
		 }
	?>
	}
};
</script>
	<?php 	echo "<div style='position:absolute;top:0;left:70%;font-size:9px;font-weight:bold;'>Usuario: $sess_nmb<br>DD: $sess_dd<br>$sess_empresa</div>";	 ?>
	<br>
	<div>
	<center>
	<?php 

	if(count($data)!=0){
		echo $out;
		echo "<script type='text/javascript'> 
					jQuery(document).ready(function(){ 
						jQuery('#list1').jqGrid('navButtonAdd', '#list1_pager',  
						{ 
							'caption'      : 'Actualizar',  
							'buttonicon'   : 'ui-icon-extlink',  
							'onClickButton': function() 
							{ 
							   javascript:location.reload();
							} 
						}); 
					}); 
			  </script>"; 
	}else{
		echo "<center><table style='border:1px solid #d0aa2b; border-collapse:collapse; font-size:12px; text-align:left;' cellpadding='20'>
							<tr>
								<td><img src='http://frida/infinitum/ssv2/lib/js/themes/frida_gris/images/i.jpg' width=50 height=50></td>
								<td>No se encontraron datos asociados a la busqueda.</td>
							</tr>
					  </table>
			 </center>";
	}
	?>
	</center>
	</div>
	<br><div>
		<strong>
			<label><p>Nota:</p></label>
			<label><p>N/A  =>  No Aplica</p></label>
			<label><p>Req  =>  Requiere</p></label>
		</strong>
	</div>
</body> 
</html> 