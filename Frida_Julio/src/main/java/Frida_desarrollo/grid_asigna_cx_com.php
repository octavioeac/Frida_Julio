<?php 
include("conexion.php");
include_once("perfiles.php");
include ("phpmydatagrid.class.php");


$whereStr=$_SESSION['wadva1'];
if($whereStr<>'') $whereStr="and $whereStr";
if (!isset($id)) $id="%";

$objGrid = new datagrid;
$objGrid -> closeTags(true);  
$objGrid -> friendlyHTML();  
$objGrid -> methodForm("get");
$objGrid -> conectadb("$host", "$user", "$password", "$db");
$objGrid -> salt("Myc0defor5tr0ng3r-Pro3EctiOn");
$objGrid -> language("es");

if ($perfil=="Administrador" or $perfil=="Ingenieria DD") $objGrid->buttons(false,true,false,false,true);
else  $objGrid->buttons(false,true,false,false,true);

$objGrid -> setAction("upload", "abreOrdenes(\"%s\",\"%s\")");
$objGrid -> form('wcluster', true);
$objGrid -> searchby("ref_sisa, ref_sisa_con, prioridad, estatus_valcc_tx, cliente_sisa, cliente_comun, area, central, cm, area_b, central_b, cm_b");
$objGrid -> tabla("ladaenlaces");
$objGrid -> keyfield("ref_sisa");
$objGrid -> datarows(15);
$objGrid -> orderby("division, ref_sisa_con, ref_sisa", "ASC");
$objGrid -> where("(division LIKE '$sess_dd%' OR division_b LIKE '$sess_dd%') and (etapa_sisa<>'ECA' and etapa_sisa<>'CAN' and etapa_sisa<>'OBS' and etapa_sisa<>'OPE' and etapa_sisa<>'BAJ') and (ref_sisa not like 'FB2%' or (ref_sisa like 'FB2%' and cliente_sisa<>'GOBIERNO DEL DISTRITO FEDERAL')) and estatus_asignacion_cx='POR VALIDAR'     ");

if (!isset($_SESSION['arearesp']))     $_SESSION['arearesp']=$areares;
$arearesp=$_SESSION['arearesp'];




$objGrid -> FormatColumn("estatus_asignacion_cx", "ESTATUS ASIGNACION Y CONFIGURACION DE CX", 30, 30, 1, "80", "azul", "left","link:valida_proyec_acc(%s),ref_sisa");
$objGrid -> FormatColumn("ch_aproy", "ESTATUS ANALISIS DEL PROYECTO", 30, 30, 1, "80", "azul", "left");
$objGrid -> FormatColumn("aplica_ot_acc", "OTs DE ACCESO REQUERIDAS", 30, 30, 1, "90", "", "left");
$objGrid -> FormatColumn("aplica_ot_tx", "OTs DE TRANSPORTE REQUERIDAS", 30, 30, 1, "90", "", "left");

$objGrid -> FormatColumn("prioridad", "PRIORIDAD", 30, 30, 1, "80", "verde", "left");
$objGrid -> FormatColumn("etapa_sisa", "ETAPA SISA", 30, 30, 1, "80", "", "left");
$objGrid -> FormatColumn("ref_sisa", "REF.SISA DEL ENLACE", 30, 30, 1, "110", "amarillo", "left");
$objGrid -> FormatColumn("ref_sisa_con", "REF.SISA ENLACE CONCENTRADOR", 30, 30, 0, "110", "", "left");

$objGrid -> FormatColumn("fecha_alta_sisa", "FECHA ALTA SISA", 30, 30, 1, "120", "naranja", "left");
$objGrid -> FormatColumn("fecha_dd", "FECHA DUE DATE", 30, 30, 1, "120", "naranja", "left");

$objGrid -> FormatColumn("cliente_sisa", "CLIENTE SISA ", 30, 30, 1, "200", "", "left");  
$objGrid -> FormatColumn("cliente_comun", "CLIENTE COMUN", 30, 30, 1, "200", "", "left");  

$objGrid -> FormatColumn("infra_1", "ACONDICIONAMIENTO DEL SITE", 30, 30, $ingdd, "120", "", "left","select::OK_OK:N/A_N/A");
$objGrid -> FormatColumn("infra_2", "ACOMETIDA FO/", 30, 30, $ingdd, "120", "", "left","select::OK_OK:N/A_N/A");
$objGrid -> FormatColumn("infra_3", "EQUIPO NTU/ADVA/TX", 30, 30, $ingdd, "120", "", "left","select::OK_OK:");

$objGrid -> FormatColumn("area", "AREA", 30, 30, 1, "100", "", "left");
$objGrid -> FormatColumn("central", "CENTRAL A", 30, 30, 1, "100", "amarillo", "left");
$objGrid -> FormatColumn("cm", "CM", 30, 30, 1, "100", "", "left");

$objGrid -> FormatColumn("area_b", "AREA", 30, 30, 1, "100", "", "left");
$objGrid -> FormatColumn("central_b", "CENTRAL B", 30, 30, 1, "100", "amarillo", "left");
$objGrid -> FormatColumn("cm_b", "CM", 30, 30, 1, "100", "", "left");

$objGrid -> FormatColumn("observaciones_asigna_lp", "OBSERVACIONES CONSTRUCCION TRASPASOS FISICOS (LADO A)", 30, 30, 1, "300", "amarillo", "left","textarea");




if (!isset($_REQUEST["DG_ajaxid"])){ // If we intercept an AJAX request from page 
									 // then do not display data below	
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'.
		 '<html xmlns="http://www.w3.org/1999/xhtml">'.
		 '<head>'.
		 '<meta http-equiv="Content-Type" content="text/html; charset=$charset" />'.
		 '<meta name="description" content="Site description" />'.
		 '<meta name="revisit-after" content="8 days" />'.
		 '<meta name="keywords" content="keywords for site" />'.
		 '<meta http-equiv="Pragma" content="no-cache" />'.
		 '<meta name="robots" content="all" />'.
		 '<link rel="shortcut icon" href="images/guru.ico" />'.
		 '<meta http-equiv="Content-Script-Type" content="type" />'.
		 '<link type="text/css" rel="stylesheet" href="./css/stylex.css" />'.
		 '<title>F R I D A</title>';
$objGrid -> setHeader(); 
?>
<script type='text/javascript' src='./js/myscripts.js'></script>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />

<script type='text/javascript'>
	function abreOrden(ref_sisa)
		{// window.open('carga_archivos_acceso?id=' + intRow + '&tec=adva'+ '&tipo=adva');
		window.open('carga_archivos_cx.php?ref_sisa=' + ref_sisa,"historial_resp","toolbar=0,directories=0,status=1,menubar=0,scrollbars=1,width=750%,height=380%,left=20%"); }
	
	function resizeFrame(f)
		{ //f.style.height = f.contentWindow.document.body.offsetHeight + "px";
		}
	
	function estatus(id)
		{ window.open('estatus_adva.php?id=' + id,'estatus'); }
	
	function valida_proyec_acc (ref_sisa)
		{ window.open('liquida_asigna_cx_com.php?ref_sisa=' + ref_sisa + '&val=1' ,"historial_resp"); }
		//{ window.open('liquida_asigna_cx.php?ref_sisa=' + ref_sisa + '&val=1' ,"historial_resp","toolbar=0,directories=0,status=1,menubar=0,scrollbars=1,width=950%,height=380%,left=20%"); }
		
	function ref_sisa(ref_sisa)
		{ window.open('bitacora_ladaenlaces.php?ref_sisa=' + ref_sisa,"historial_resp","toolbar=0,directories=0,status=1,menubar=0,scrollbars=1,width=970%,height=520%,left=30%"); }
</script>

</head>
<body>
<div id="wrap"><div id="header"><h1><a href="inicio.php">F R I D A</a></h1><h2>Asignacion de modulo CX</h2><p></div></div>
<div style='position:absolute;top:0;left:90%;font-size:9px;font-weight:bold;'>Usuario: <?php echo $sess_nmb;?><br>DD: <?php echo $sess_dd;?></div>
<?php
$tabla="adva_top";
$formato="top";
$camposexport="campos_gridtop";

    } // if (!isset($_REQUEST["DG_ajaxid"])) end interception, until here, script wont be processed when DG_ajaxid is set
		$objGrid -> ajax('silent');
		$objGrid -> grid();
		$objGrid -> desconectar();
?>
</body>
</html>