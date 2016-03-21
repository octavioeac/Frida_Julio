<?php
	error_reporting(E_ALL & ~E_NOTICE);
	include 'MySQLClass.php';
	$conexion=new MySQLClass();
	extract($_REQUEST);
	if(isset($ndd))
		$name=$ndd;
	$consulta="SELECT numero,nombre,valor FROM semanal_tabla WHERE numero between 1 and 53 AND anio ='$anio'";
	if(isset($name)&&$name!=null)
		$consulta.=" AND nombre='$name'";
	$base_path = "lib/";
	include($base_path."inc/jqgrid_dist.php"); 
	$g = new jqgrid();       
	$col = array(); 
	$col["title"] = "S"; 
	$col["name"] = "numero"; 
	$col["width"] = "20"; 
	$col["editable"] = false; 
	$col["align"] = "right"; 
	$col["search"] = false; 
	$col["export"] = true;
	$cols[] = $col;
	$col = array(); 
	$col["title"] = "Proveedor"; 
	$col["name"] = "nombre"; 
	$col["width"] = "110"; 
	$col["editable"] = false;
	$col["align"] = "left"; 
	$col["search"] = false; 
	$col["export"] = true; 
	$cols[] = $col; 
	$col = array(); 
	$col["title"] = "Monto"; 
	$col["name"] = "valor"; 
	$col["width"] = "80"; 
	$col["editable"] = false;
	$col["align"] = "right";
	$col["search"] = false; 
	$col["export"] = true;
	$col["sorttype"] = 'number';
	$col["formatter"] = 'number';
	$cols[] = $col;	
	$grid["sortname"] = 'id'; 
	$grid["sortorder"] = "asc"; 
	$grid["caption"] = "$name"; 
	$grid["width"] = 300;
	$grid["height"] = true;  
	$grid["forceFit"] = true;
	$grid["rowNum"] = 10;
	$grid["hiddengrid"] = true;
	$grid["multiselect"] = false;
	$grid["viewrecords"] = true;
	$grid["rowList"] = array(10,20,30);
	$grid["pgbuttons"] = true;
	$grid["pgtext"] = true;
	$grid["pginput"] = false;
	$grid["export"] = array("format"=>"excel", "filename"=>"Reporte_inversion", "sheetname"=>"Reporte"); 
	$grid["export"]["range"] = "filtered"; 
	$g->set_options($grid); 
	$g->set_actions(array("add"=>false, "edit"=>false, "delete"=>false,"rowactions"=>false,"showhidecolumns"=>false,"export"=>true,"autofilter" => false));
	$g->select_command = $consulta;
	$g->set_columns($cols);  
	$out= $g->render("list1");
	$consulta="SELECT numero,nombre,valor FROM semanal_tabla WHERE numero between 0 and 54 AND anio ='$anio'";
	if(isset($name)&&$name!=null)
		$consulta.=" AND nombre='$name'";
	// $g1 = new jqgrid();       
	// $g1->set_options($grid); 
	// $g1->set_actions(array("add"=>false, "edit"=>false, "delete"=>false,"rowactions"=>false,"showhidecolumns"=>false,"export"=>true,"autofilter" => false));
	// $g1->select_command = "SELECT numero,nombre,valor FROM semanal_tabla WHERE numero between 1 and 53 AND nombre='ALCATEL-LUCENT' AND anio ='2012'";
	// $g1->set_columns($cols);  
	// $out1= $g1->render("list2");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html> 
	<head> 
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7,IE=Edge,chrome=1">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-88609-1, charset=utf-8">
		<link rel="stylesheet" type="text/css" media="screen" href="lib/js/themes/frida_gris/jquery-ui.custom.css"></link>     
		<link rel="stylesheet" type="text/css" media="screen" href="lib/js/jqgrid/css/ui.jqgrid.css"></link>     
		<script src="lib/js/jquery.min.js" type="text/javascript"></script> 
		<script src="lib/js/jqgrid/js/i18n/grid.locale-es.js" type="text/javascript"></script> 
		<script src="lib/js/jqgrid/js/jquery.jqGrid.min_consulta.js" type="text/javascript"></script>     
		<script src="lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script> 
	</head> 
	<body> 
		<?php
			$conexion=new MySQLClass();
			$m="select maximo_y from limites where ";
			
			if(isset($name)&&$name!=null)
				$m.=" nombre='$name'";
			$result=$conexion->Query($m);
			$row=mysql_fetch_array($result);
			$limit=$row['maximo_y'];
			$conexion->Disconnect();
			echo "
				<div>
					<iframe name='grafica' src=\"grafica_2.php?name=".$name."&limit=".$limit."&anio=".$anio."&consulta=".$consulta."\" frameborder=0 aling='center' scrolling=no width='100%' height='550'></iframe>
				</div>
			";
		?>
		<center>
		<?php
			echo $out;		?>
		<?php
			// echo $out1;		?>
	</body> 
</html> 