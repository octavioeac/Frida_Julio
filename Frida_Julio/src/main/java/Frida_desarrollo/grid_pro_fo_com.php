
<?php 
include_once("perfiles.php");
include ("phpmydatagrid.class.php");
include("conexion.php");
if (!isset($id)) $id="%";

$objGrid = new datagrid;
$objGrid->closeTags(true);  
$objGrid->friendlyHTML();  
$objGrid->methodForm("get"); 
$objGrid -> conectadb("$host", "$user", "$password", "$db");

$objGrid->salt("Myc0defor5tr0ng3r-Pro3EctiOn");
$objGrid->language("es");
if ($perfil=="Administrador" or $perfil=="Ingenieria DD") $objGrid->buttons(false,true,false,false,false);
else $objGrid->buttons(false,true,false,false,false);

$objGrid -> setAction("edit", "ref_sisa(\"%s\")");
//$objGrid->form('analisis_proy_com', true);

//$objGrid -> setAction("upload", "abreOrden(\"%s\",\"%s\")");
$objGrid->searchby("prioridad,fase,ref_sisa,ref_sisa_con_interfaz,ch_aproy,estatus_valcorr,cliente_sisa,cliente_comun,area,central,cm,area_b,central_b,cm_b");

$objGrid->tabla ("servicios_ladaenlaces_fo");
$objGrid->keyfield("ref_sisa");
$objGrid->datarows(15);
$objGrid->orderby("division,ref_sisa_con_interfaz,ref_sisa", "ASC");

if($perfil=="Administrador" or $perfil=="Supervisor FO")
{
	$objGrid->where(" 
	(division like '%$sess_dd%' or division_b like '%$sess_dd%') 
	and (etapa_sisa<>'ECA' and etapa_sisa<>'CAN' and etapa_sisa<>'OBS' and etapa_sisa<>'OPE' and etapa_sisa<>'BAJ')");
}elseif($perfil=="IP FO")
{
	$objGrid->where(" 
	(division like '%$sess_dd%' or division_b like '%$sess_dd%') 
	and (etapa_sisa<>'ECA' and etapa_sisa<>'CAN' and etapa_sisa<>'OBS' and etapa_sisa<>'OPE' and etapa_sisa<>'BAJ') 
	and (ip_fibra_optica='$sess_nmb' or ip_fibra_optica_b='$sess_nmb')");
}
$fechaval = date("Y-m-d H;i");
if (!isset($_SESSION['arearesp']))     $_SESSION['arearesp']=$areares;
$arearesp=$_SESSION['arearesp'];

$objGrid -> FormatColumn("prioridad", "PRIORIDAD", 30, 30, 1, "80", "verde", "left");
$objGrid -> FormatColumn("fase", "FASE", 30, 30, 1, "80", "verde", "left");

$objGrid -> FormatColumn("estatus_proyecto_fo", "ESTATUS FO (LADO A)", 30, 30, 1, "120", "amarillo", "left","link:valida_punta_a(%s%s%s),ref_sisa,estatus_proyecto_fo,tabla");

if($perfil=="Supervisor Analisis"||$perfil=="Administrador"){
    $objGrid -> FormatColumn("ip_fibra_optica", "TECNICO (LADO A)", 30, 30, 1, "180", "azul", "left","link:reasignaA(%s%s%s),ref_sisa,estatus_proyecto_fo,tabla");
}
else{
    $objGrid -> FormatColumn("ip_fibra_optica", "TECNICO (LADO A)", 30, 30, 1, "180", "azul", "left");
}

$objGrid -> FormatColumn("fecha_sol_proyecto_fo", "FECHA DE SOLICITUD LADO A", 30, 30, 1, "130", "", "left");
$objGrid -> FormatColumn("estatus_proyecto_fo_b", "ESTATUS FO (LADO B)", 30, 30, 1, "120", "amarillo", "left","link:valida_punta_b(%s%s%s),ref_sisa,estatus_proyecto_fo_b,tabla");

if($perfil=="Supervisor Analisis"||$perfil=="Administrador"){
    $objGrid -> FormatColumn("ip_fibra_optica_b", "TECNICO (LADO B)", 30, 30, 1, "180", "azul", "left","link:reasignaB(%s%s%s),ref_sisa,estatus_proyecto_fo_b,tabla");
}
else{
    $objGrid -> FormatColumn("ip_fibra_optica_b", "TECNICO (LADO B)", 30, 30, 1, "180", "azul", "left");
}

$objGrid -> FormatColumn("fecha_sol_proyecto_fo_b", "FECHA DE SOLICITUD LADO B", 30, 30, 1, "130", "", "left");

$objGrid -> FormatColumn("aplica_ot_acc", "APLICA ACCESO", 30, 30, 1, "70", "rosa", "left");
$objGrid -> FormatColumn("ref_sisa", "REF.SISA DEL ENLACE", 30, 30, 1, "110", "rosa", "left");
$objGrid -> FormatColumn("ref_sisa_con_interfaz", "REF.SISA CONCENTRADOR", 30, 30, 1, "110", "", "left");
$objGrid -> FormatColumn("etapa_sisa", "ETAPA SISA", 30, 30, 1, "80", "", "left");
$objGrid -> FormatColumn("fecha_alta", "FECHA ALTA", 30, 30, 1, "120", "", "left");
$objGrid -> FormatColumn("fecha_dd", "FECHA DUE DATE", 30, 30, 1, "120", "", "left");
$objGrid -> FormatColumn("tipo_transporte", "TECNOLOGIA", 30, 30, 1, "90", "", "left");
$objGrid -> FormatColumn("cliente_sisa", "CLIENTE SISA ", 30, 30, 1, "200", "", "left");  
$objGrid -> FormatColumn("cliente_comun", "CLIENTE COMUN", 30, 30, 1, "200", "", "left"); 
 
$objGrid -> FormatColumn("siglas_central", "SIGLAS NODO A", 30, 30, 1, "100", "", "left");
$objGrid -> FormatColumn("central", "CENTRAL A", 30, 30, 1, "100", "", "left");
$objGrid -> FormatColumn("domicilio_a", "DOMICILIO A", 30, 30, 1, "300", "", "left");
$objGrid -> FormatColumn("division", "DIVISION A", 30, 30, 1, "100", "", "left");

$objGrid -> FormatColumn("siglas_central_b", "SIGLAS NODO B", 30, 30, 1, "100", "", "left");
$objGrid -> FormatColumn("central_b", "CENTRAL B", 30, 30, 1, "100", "", "left");
$objGrid -> FormatColumn("domicilio_b", "DOMICILIO B", 30, 30, 1, "300", "", "left");
$objGrid -> FormatColumn("division_b", "DIVISION B", 30, 30, 1, "100", "", "left");

$objGrid -> FormatColumn("observaciones_proyecto_fo", "OBSERVACIONES FO (LADO A)", 30, 30, 1, "300", "amarillo", "left","textarea");
$objGrid -> FormatColumn("observaciones_proyecto_fo_b", "OBSERVACIONES FO LADO B", 30, 30, 1, "300", "amarillo", "left","textarea");
$objGrid -> FormatColumn("supervisor_fibra_optica", "SUPERVISOR", 30, 30, 1, "150", "azul", "left");
$objGrid -> FormatColumn("supervisor_fibra_optica_b", "SUPERVISOR", 30, 30, 1, "150", "azul", "left");
$objGrid -> FormatColumn("tabla", "REF FRIDA", 30, 30, 1, "90", "", "left");


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

<link href="style.css" rel="stylesheet" type="text/css" media="screen" />


<script type='text/javascript'>

function resizeFrame(f) {
//f.style.height = f.contentWindow.document.body.offsetHeight + "px";
}

function ref_sisa(ref_sisa){
	window.open('bitacora_ladaenlaces_com.php?ref_sisa=' + ref_sisa,"historial_resp","toolbar=0,directories=0,status=1,menubar=0,scrollbars=1,width=970%,height=520%,left=30%");
}

function valida_punta_a (ref_sisa,estatus,tabla) 
{ 
	if(estatus!="NO REQUERIDA" && estatus!="LIQUIDADA")
	{
		if (estatus=="POR ASIGNAR")	
			{window.location.href='asigna_tecnico.php?ref_sisa='+ref_sisa+'&lado='+'A'+'&etapa='+'fo'+'&pag='+'grid_pro_fo_com.php'+'&tabla='+tabla;}
		else
			{window.location.href='alta_construccion_fo.php?ref_sisa_a='+ref_sisa+'&envia_punta=A';}
	}
} 

function valida_punta_b (ref_sisa,estatus,tabla) 
{ 
	if(estatus!="NO REQUERIDA" && estatus!="LIQUIDADA")
	{
		if (estatus=="POR ASIGNAR")	
			{window.location.href='asigna_tecnico.php?ref_sisa='+ref_sisa+'&lado='+'B'+'&etapa='+'fo'+'&pag='+'grid_pro_fo_com.php'+'&tabla='+tabla;}
		else
			{window.location.href='alta_construccion_fo.php?ref_sisa_a='+ref_sisa+'&envia_punta=B';}

	}
} 
function reasignaA(ref_sisa,estatus,tabla){
    window.location.href='asigna_tecnico.php?ref_sisa='+ref_sisa+'&lado='+'A'+'&reasig='+'SI'+'&etapa='+'fo'+'&pag='+'grid_pro_fo_com.php'+'&tabla='+tabla;
}
function reasignaB(ref_sisa,estatus,tabla){
    window.location.href='asigna_tecnico.php?ref_sisa='+ref_sisa+'&lado='+'B'+'&reasig='+'SI'+'&etapa='+'fo'+'&pag='+'grid_pro_fo_com.php'+'&tabla='+tabla;
}	
</script>


</head>
<body>

<div id="wrap">
<div id="header">
<h1><a href="inicio.php">F R I D A</a></h1>

<h2>Proyecto de Construccion de FO</h2><p>
</div></div>

<? 

//echo magic_quote(strtoupper("000.06"));
//	  include ('filtros_top.php');
		$_SESSION['gd_pro_fo']="(estatus_proyecto_fo in ('POR ASIGNAR','POR ELABORAR','LIQUIDADA') or estatus_proyecto_fo_b in ('POR ASIGNAR','POR ELABORAR','LIQUIDADA')) and (division like '%$sess_dd%' or division_b like '%$sess_dd%') and (etapa_sisa<>'ECA' and etapa_sisa<>'CAN' and etapa_sisa<>'OBS' and etapa_sisa<>'OPE' and etapa_sisa<>'BAJ')";
		
		
		echo "<form name='exportar' method='post' action='grid_export_new.php'>";
		echo "<input type='hidden' name='archivo' value='grid_pro_fo_com.php'>";//nombre del grid donde estan los campos 
		echo "<input type='hidden' name='sesion' value='gd_pro_fo'>";//nombre de la sesion donde estan los filtros
		echo "<input type='submit' name='submit' value='Exportar Grid'/>";
		echo "</form>";
		
    } // if (!isset($_REQUEST["DG_ajaxid"])) end interception, until here, script wont be processed when DG_ajaxid is set
		$objGrid -> ajax('silent');
		$objGrid -> grid();
		$objGrid -> desconectar();
echo "<div style='position:absolute;top:0;left:90%;font-size:9px;font-weight:bold;'>Usuario: $sess_nmb<br>DD: $sess_dd</div>";
?>
		</td>
		<td style="width:5%">&nbsp;</td>
	  </tr>
	</table><br />
	<?php // echo myfooter(); // print or insert your own footer ?>
    
</body>
</html>