<?php  
header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL & ~E_NOTICE);
include 'enlaces.php';
include('functions/conexion.php');

include($link_grid);
$con=$conectar;

$base_path = "lib/";
include($base_path."inc/jqgrid_dist.php");

$campos_tabla=array(0=>array("ban_edicion"=>"ct","det"=>""

ctnombre,ctemail,cttelefono,ctmovil","rsnombre,rsemail,rstelefono,rsmovil","cpnombre,cpemail,cptelefono,cpmovil");

$campos = array(0=>array("name"=>"id","title"=> "ID","tamano"=>"30","editable"=>false,"hidden"=>true),
			    1=>array("name"=>"ban_edicion","title"=> "BAN_EDICION","tama�o"=>"30","editable"=>false,"hidden"=>true),
				2=>array("name"=>"nombre","title"=> "NOMBRE","tama�o"=>"260""editable"=>true,"hidden"=>false),
				3=>array("name"=>"mail","title"=> "MAIL","tama�o"=>"200","editable"=>true,"hidden"=>false),
				4=>array("name"=>"telefono","title"=> "TELEFONO","tama�o"=>"100","editable"=>true,"hidden"=>false),
				5=>array("name"=>"movil","title"=> "MOVIL","tama�o"=>"100","editable"=>true,"hidden"=>false));

$g = new jqgrid();       

for($i=0;$i<count($campos);$i++){
	$col = array(); 
	$col["title"] = $campos[$i]['title']; 
	$col["name"] = $campos[$i]['name']; 
	$col["width"] = $campos[$i]['tama�o'];
	$col["editable"] = $campos[$i]['editable'];
	$col["hidden"] = $campos[$i]['hidden'];
	$col["align"] = "left"; 
	$col["search"] = false; 
}

$grid["rowNum"] = 100;
$grid["sortname"] = "sociedad DESC,nombre_divisiones"; 
$grid["sortorder"] = "ASC";
$grid["caption"] = "Contactos"; 
$grid["autowidth"] = true;
$grid["height"] = "";  
$grid["forceFit"] = false;
$grid["rowList"] = false;
$grid["hiddengrid"] = false;
$grid["multiselect"] = false;
$grid["footerrow"] = true;

$grid["altRows"] = true; 
$grid["altclass"] = "myAltRowClass"; 

// $grid["export"] = array("format"=>"excel", "filename"=>"Resumen Operativo - $titulo", "sheetname"=>"Resumen Operativo - $titulo"); 
// $grid["export"]["range"] = "filtered";

$g->set_options($grid); 

$g->set_actions(array(     
						"add"=>false, 
						"edit"=>true, 
						"delete"=>true, 
						"rowactions"=>false, 
						"showhidecolumns"=>true,
						"export"=>true,  
						"autofilter" => false 
					  )  
				); 				
	 
$g->set_columns($cols); 
$out = $g->render("list1"); 
echo '
<!DOCTYPE HTML>
<html> 
<head> 
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="lib/js/themes/frida_gris/jquery-ui.custom.css"></link>     
    <link rel="stylesheet" type="text/css" media="screen" href="lib/js/jqgrid/css/ui.jqgrid.css"></link>     
    <!--<link rel="stylesheet" href="css/header.css" type="text/css"/>-->
    <script src="lib/js/jquery.min.js" type="text/javascript"></script> 
	<link rel="stylesheet" type="text/css" href="<?php echo $style_grid;?>" media="screen"></link>
    <script src="lib/js/jqgrid/js/i18n/grid.locale-es.js" type="text/javascript"></script> 
    <script src="lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>     
    <script src="lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script> 
</head>'; 
?> 
<body> 
	<style>	.myAltRowClass { background-color: #E4F1FF; background-image: none; }	</style>
	<div>
	<center>
	<?php 
		echo $out."
	</div>
</body> 
</html>";	
?>