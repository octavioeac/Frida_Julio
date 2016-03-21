<?php  
header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL & ~E_NOTICE);
include 'enlaces.php';
include('functions/conexion.php');

include($link_grid);
$con=$conectar;
$pl=$_GET['plan'];
$pv=$_GET['prove'];
if(isset($pl) and $pl!="" and $pl!="0") $pln="AND a.plan='".$pl."'"; else $pln="";

$empresa=mysql_fetch_array(mysql_query("SELECT empresa FROM usuarios.seg_usuarios WHERE login='$sess_usr'"));
if($empresa[0]=='TELMEX' or $empresa[0]=='OMSASI' or $empresa[0]=='COMERTEL ARGOS' or $empresa[0]==null or $empresa[0]=='PROIT'){
	if(isset($pv) and $pv!="" and $pv!="0") $pve="AND a.prove='".$pv."'"; else $pve="";
}else{
	$pve="AND a.prove='".$empresa[0]."'";
	$pve1="AND a.prove='".$empresa[0]."'";
	$pv=$empresa[0];
}

if($sess_dd=='%')$dd="";else $dd=" AND a.dir_div='$sess_dd'";

$base_path = "lib/";
include($base_path."inc/jqgrid_dist.php");

$sql = "SELECT a.dir_div,SUM(IF(a.estatus='SOLICITADO',1,0)) solicitado,
	    SUM(IF(a.estatus='EN CAPTURA',1,0)) en_captura,
	    SUM(IF(a.estatus='POR VALIDAR',1,0)) por_validar,
	    SUM(IF(a.estatus='VALIDADO OPERACION',1,0)) validado_oper,
	    SUM(IF(a.estatus='VALIDADO',1,0)) validado,COUNT(*) total
	    FROM infinitum_unica.zsite_survey a WHERE estatus<>'CANCELADO' $pln $dd $pve GROUP BY a.dir_div";
$r=mysql_query($sql,$con);

while($c=mysql_fetch_array($r)){
	$variables['dir_div'][]=$c[0];
	$variables['solicitado'][]=$c[1];
	$variables['en_captura'][] = $c[2];
	$variables['por_validar'][]=$c[3];
	$variables['validado_oper'][] = $c[4];
	$variables['validado'][] = $c[5];
	$variables['total'][] = $c[6];
}			

for($i=0;$i<=count($variables['dir_div'])-1;$i++){ 
	$data[$i]['dir_div']= $variables['dir_div'][$i]; 
	$data[$i]['solicitado']= $variables['solicitado'][$i]; 
    $data[$i]['en_captura']= $variables['en_captura'][$i]; 
    $data[$i]['por_validar'] = $variables['por_validar'][$i]; 
    $data[$i]['validado_oper'] = $variables['validado_oper'][$i]; 
    $data[$i]['validado'] = $variables['validado'][$i]; 
    $data[$i]['total'] = $variables['total'][$i]; 
} 

$g = new jqgrid();       

$col = array(); 
$col["title"] = "ID"; 
$col["title1"] = "ID"; 
$col["name"] = "id"; 
$col["width"] = "30"; 
$col["editable"] = false;
$col["align"] = "center";
$col["hidden"] = true;
$col["search"] = false;
$col["sortable"] = false; 
$col["export"] = false; 
$cols[] = $col;

$col = array(); 
$col["title"] = 'DIVISION'; 
$col["title1"] = "DIVISION"; 
$col["name"] = "dir_div"; 
$col["dbname"] = "a.dir_div"; 
$col["width"] = "100"; 
$col["editable"] = false;
$col["align"] = "left"; 
$col["search"] = false; 
$col["export"] = true; 
$cols[] = $col;

$col = array(); 
$col["title"] = 'SOLICITADO';
$col["title1"] = "SOLICITADO"; 
$col["name"] = "solicitado"; 
$col["width"] = "120"; 
$col["editable"] = false;
$col["align"] = "center"; 
$col["search"] = false; 
$col["export"] = true; 
$col["sorttype"] = 'number';
$col["formatter"] = 'number';
$col["formatoptions"] = array("thousandsSeparator" => ",","decimalSeparator" => ".","decimalPlaces" => '0');
$cols[] = $col; 

$col = array(); 
$col["title"] = 'EN CAPTURA';
$col["title1"] = "EN CAPTURA"; 
$col["name"] = "en_captura"; 
$col["width"] = "120"; 
$col["editable"] = false;
$col["align"] = "center"; 
$col["search"] = false; 
$col["export"] = true; 
$col["sorttype"] = 'number';
$col["formatter"] = 'number';
$col["formatoptions"] = array("thousandsSeparator" => ",","decimalSeparator" => ".","decimalPlaces" => '0');
$cols[] = $col; 

$col = array(); 
$col["title"] = 'POR VALIDAR';
$col["title1"] = "POR VALIDAR"; 
$col["name"] = "por_validar"; 
$col["width"] = "120"; 
$col["editable"] = false;
$col["align"] = "center"; 
$col["search"] = false; 
$col["export"] = true; 
$col["sorttype"] = 'number';
$col["formatter"] = 'number';
$col["formatoptions"] = array("thousandsSeparator" => ",","decimalSeparator" => ".","decimalPlaces" => '0');
$cols[] = $col; 

$col = array(); 
$col["title"] = 'VALIDADO OPERACION';
$col["title1"] = "VALIDADO OPERACION"; 
$col["name"] = "validado_oper"; 
$col["width"] = "140"; 
$col["editable"] = false;
$col["align"] = "center"; 
$col["search"] = false; 
$col["export"] = true; 
$col["sorttype"] = 'number';
$col["formatter"] = 'number';
$col["formatoptions"] = array("thousandsSeparator" => ",","decimalSeparator" => ".","decimalPlaces" => '0');
$cols[] = $col; 

$col = array(); 
$col["title"] = 'VALIDADO';
$col["title1"] = "VALIDADO"; 
$col["name"] = "validado"; 
$col["width"] = "120"; 
$col["editable"] = false;
$col["align"] = "center"; 
$col["search"] = false; 
$col["export"] = true; 
$col["sorttype"] = 'number';
$col["formatter"] = 'number';
$col["formatoptions"] = array("thousandsSeparator" => ",","decimalSeparator" => ".","decimalPlaces" => '0');
$cols[] = $col; 

$col = array(); 
$col["title"] = 'TOTAL';
$col["title1"] = "TOTAL"; 
$col["name"] = "total"; 
$col["width"] = "120"; 
$col["editable"] = false;
$col["align"] = "center"; 
$col["search"] = false; 
$col["export"] = true; 
$col["sorttype"] = 'number';
$col["formatter"] = 'number';
$col["formatoptions"] = array("thousandsSeparator" => ",","decimalSeparator" => ".","decimalPlaces" => '0');
$cols[] = $col; 

$grid["rowNum"] = 100;
$grid["sortname"] = "id"; 
$grid["sortorder"] = "ASC";
$grid["caption"] = "Resumen Site Surveys"; 
$grid["width"] = "900";
$grid["height"] = "";  
$grid["forceFit"] = false;
$grid["shrinkToFit"] = false;
$grid["hiddengrid"] = false;
$grid["multiselect"] = false;
$grid["footerrow"] = true;
$grid["rowList"] = false;
// $grid["resizable"] = true;

$grid["altRows"] = true; 
$grid["altclass"] = "myAltRowClass"; 

$grid["export"] = array("format"=>"excel","filename"=>"Resumen Site Survey","sheetname"=>"Resumen Site Survey","range"=>"filtered"); 

$g->set_options($grid); 

$g->set_actions(array(     
                        "add"=>false, 
                        "edit"=>false, 
                        "delete"=>false, 
                        "rowactions"=>false, 
					    "showhidecolumns"=>true,
                        "export"=>true,  
                        "autofilter" => false,						
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
<script>
	var opts = {
		'loadComplete': function () {
			var grid = $("#list1"),
			dir_div = grid.jqGrid('getCol', 'dir_div', false, 'sum');
			grid.jqGrid('footerData','set',{dir_div: 'TOTAL:' });
			solicitado = grid.jqGrid('getCol', 'solicitado', false, 'sum');
			grid.jqGrid('footerData','set',{solicitado: solicitado });	
			en_captura = grid.jqGrid('getCol', 'en_captura', false, 'sum');
			grid.jqGrid('footerData','set',{en_captura: en_captura });
			por_validar = grid.jqGrid('getCol', 'por_validar', false, 'sum');
			grid.jqGrid('footerData','set',{por_validar: por_validar });
			validado_oper = grid.jqGrid('getCol', 'validado_oper', false, 'sum');
			grid.jqGrid('footerData','set',{validado_oper: validado_oper });
			validado = grid.jqGrid('getCol', 'validado', false, 'sum');
			grid.jqGrid('footerData','set',{validado: validado });
			total = grid.jqGrid('getCol', 'total', false, 'sum');
			grid.jqGrid('footerData','set',{total: total });
		}
	};
</script>
<body> 
<style>
    body{background:#fff}
	.ui-jqgrid tr.jqgrow td{ vertical-align: top; white-space: normal;	}
    .myAltRowClass{background-color:#E4F1FF;background-image:none;}
</style>
<div id="header">
    <h1><a href="<?php echo $link_site; ?>">F R I D A</a></h1>
	<h2>Facilidades Red Infinitum Datos de Acceso</h2>
    <h3>ESTATUS DE SITE SURVEY</h3>
</div>
	<?php 	echo "<div style='position:absolute;top:0;left:70%;font-size:9px;font-weight:bold;'>Usuario: $sess_nmb<br>DD: $sess_dd</div>";	 ?>
	<br>
	<div>
	<center>
	<?php 
		$sql1="SELECT plan FROM infinitum_unica.zsite_survey WHERE plan<>'' GROUP BY plan ORDER BY plan"; 
		$res1=mysql_query($sql1);
		if($pl=='0') $select="selected"; else $select="";
		$plan="<select name='plan' onChange='this.form.submit();' style='width:350px'>
			   <option value='0' $select>Todos</option>";
		while($p = mysql_fetch_array($res1)){
			if($pl==$p[0]) $select1="selected"; else $select1="";
			$plan.="<option value='$p[0]' $select1>$p[0]</option>";	}
		$plan.="</select>";
		
		$sql1_p="SELECT prove FROM infinitum_unica.zsite_survey a WHERE prove<>'' $pve1 GROUP BY prove ORDER BY prove"; 
		$res1_p=mysql_query($sql1_p);
		if($pv=='0') $select_p="selected"; else $select_p="";
		$prove="<select name='prove' onChange='this.form.submit();' style='width:350px'>
			    <option value='0' $select_p>Todos</option>";
		while($prv = mysql_fetch_array($res1_p)){
			if($pv==$prv[0]) $select1_p="selected"; else $select1_p="";
			$prove.="<option value='$prv[0]' $select1_p>$prv[0]</option>";	
		}
		$prove.="</select>";
		
		echo "<form name=form1 id=form1 method=get action='resumen_site_surveys.php'>";
				echo "<font size=2><b>Plan:".$plan."     Proveedor:".$prove."</b></font>";
		echo "</form><br>";
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
</body> 
</html> 