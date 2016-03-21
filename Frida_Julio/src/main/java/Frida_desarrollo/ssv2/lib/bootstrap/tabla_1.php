<?php  
/** 
 * PHP Grid Component 
 * 
 * @author Abu Ghufran <gridphp@gmail.com> - http://www.phpgrid.org 
 * @version 1.4.6 
 * @license: see license.txt included in package 
 */ 
	$base_path = "lib/";
	//$base_path = strstr(realpath("."),"demos",true)."lib/"; 
	include($base_path."inc/jqgrid_dist.php"); 
	$g = new jqgrid();       			 
	$col = array(); 
	$col["title"] = "ID"; 
	$col["name"] = "id"; 
	
	$col["editable"] = false; // Esta columna no es editable
	$col["align"] = "left"; // Centrar datos
	$col["search"] = false; 
	$col["search"] = false; 
	$col["hidden"] = true; 
	$col["export"] = false; // Habilita/deshabilita la columna para incluirla o no al exportar 
	$cols[] = $col; 

	$col = array(); 
	$col["title"] = "Nombre"; 
	$col["name"] = "nombre"; 
	$col["editable"] = true; 
	
	$col["editable"] = false; // Esta columna no es editable
	$col["align"] = "right"; // Centrar datos
	$col["search"] = true; 
	$col["export"] = true; // Habilita/deshabilita la columna para incluirla o no al exportar 
	$cols[] = $col; 

	$col = array(); 
	$col["title"] = ""; 
	$col["name"] = "anio"; 
	$col["formatter"] = "Date";
	$col["formatoptions"] = array("srcformat"=>'Y',"newformat"=>'Y');
	
	$col["hidden"] = false; 
	$col["editable"] = false; // Esta columna es editable
	$col["align"] = "left"; // Centrar datos
	$col["search"] = true; 
	$col["export"] = true; // Habilita/deshabilita la columna para incluirla o no al exportar 
	$cols[] = $col; 
	$col = array(); 
	$col["title"] = "Enero"; 
	$col["name"] = "enero"; 
	$col["editable"] = false; // Esta columna no es editable
	$col["align"] = "right"; 
	$col["sorttype"] = 'number';
	$col["formatter"] = 'number';
	$col["search"] = true; 
	$col["export"] = true; // Habilita/deshabilita la columna para incluirla o no al exportar 
	$cols[] = $col; 

	$col = array(); 
	$col["title"] = "Febrero"; 
	$col["name"] = "febrero"; 
	$col["editable"] = false; // Esta columna es editable
	$col["align"] = "right"; 
	$col["sorttype"] = 'number';
	$col["formatter"] = 'number';
	$col["search"] = true; 
	$col["export"] = true; // Habilita/deshabilita la columna para incluirla o no al exportar 
	$cols[] = $col; 

	$col = array(); 
	$col["title"] = "Marzo"; 
	$col["name"] = "marzo"; 
	$col["editable"] = false; // Esta columna es editable
	$col["align"] = "right"; // Centrar datos
	$col["sorttype"] = 'number';
	$col["formatter"] = 'number';
	$col["search"] = true; 
	$col["export"] = true; // Habilita/deshabilita la columna para incluirla o no al exportar 
	$cols[] = $col; 
	$col = array(); 
	$col["title"] = "Abril"; 
	$col["name"] = "abril"; 
	$col["editable"] = false; // Esta columna es editable
	$col["align"] = "right"; // Centrar datos
	$col["sorttype"] = 'number';
	$col["formatter"] = 'number';
	$col["search"] = true; 
	$col["export"] = true; // Habilita/deshabilita la columna para incluirla o no al exportar 
	$cols[] = $col; 
	$col = array(); 
	$col["title"] = "Mayo"; 
	$col["name"] = "mayo"; 
	$col["editable"] = false; // Esta columna es editable
	$col["align"] = "right"; // Centrar datos
	$col["sorttype"] = 'number';
	$col["formatter"] = 'number';
	$col["search"] = true; 
	$col["export"] = true; // Habilita/deshabilita la columna para incluirla o no al exportar 
	$cols[] = $col; 
	$col = array(); 
	$col["title"] = "Junio"; 
	$col["name"] = "junio"; 
	$col["editable"] = false; // Esta columna es editable
	$col["align"] = "right"; // Centrar datos
	$col["sorttype"] = 'number';
	$col["formatter"] = 'number';
	$col["search"] = true; 
	$col["export"] = true; // Habilita/deshabilita la columna para incluirla o no al exportar 
	$cols[] = $col; 
	$col = array(); 
	$col["title"] = "Julio"; 
	$col["name"] = "julio";
	$col["editable"] = false; // Esta columna es editable
	$col["align"] = "right"; // Centrar datos
	$col["sorttype"] = 'number';
	$col["formatter"] = 'number';
	$col["search"] = true; 
	$col["export"] = true; // Habilita/deshabilita la columna para incluirla o no al exportar 
	$cols[] = $col; 
	$col = array(); 
	$col["title"] = "Agosto"; 
	$col["name"] = "agosto"; 
	$col["editable"] = false; // Esta columna es editable
	$col["align"] = "right"; // Centrar datos
	$col["sorttype"] = 'number';
	$col["formatter"] = 'number';
	$col["search"] = true; 
	$col["export"] = true; // Habilita/deshabilita la columna para incluirla o no al exportar 
	$cols[] = $col; 
	$col = array(); 
	$col["title"] = "Septiembre"; 
	$col["name"] = "septiembre"; 
	$col["editable"] = false; // Esta columna es editable
	$col["align"] = "right"; // Centrar datos
	$col["sorttype"] = 'number';
	$col["formatter"] = 'number';
	$col["search"] = true; 
	$col["export"] = true; // Habilita/deshabilita la columna para incluirla o no al exportar 
	$cols[] = $col; 
	$col = array(); 
	$col["title"] = "Octubre"; 
	$col["name"] = "octubre"; 
	$col["autowidth"] = true; 
	$col["editable"] = false; // Esta columna es editable
	$col["align"] = "right"; // Centrar datos
	$col["sorttype"] = 'number';
	$col["formatter"] = 'number';
	$col["search"] = true; 
	$col["export"] = true; // Habilita/deshabilita la columna para incluirla o no al exportar 
	$cols[] = $col; 
	$col = array(); 
	$col["title"] = "Noviembre"; 
	$col["name"] = "noviembre"; 
	$col["editable"] = false; // Esta columna es editable
	$col["align"] = "right"; // Centrar datos
	$col["sorttype"] = 'number';
	$col["formatter"] = 'number';
	$col["search"] = true; 
	$col["export"] = true; // Habilita/deshabilita la columna para incluirla o no al exportar 
	$cols[] = $col; 
	$col = array(); 
	$col["title"] = "Diciembre"; 
	$col["name"] = "diciembre"; 
	$col["editable"] = false; // Esta columna es editable
	$col["align"] = "right"; // Centrar datos
	$col["sorttype"] = 'number';
	$col["formatter"] = 'number';
	$col["search"] = true; 
	$col["export"] = true; // Habilita/deshabilita la columna para incluirla o no al exportar 
	$cols[] = $col; 
	// Exportar a archivos xls
	// Parámetros para exportar a excel- Rango podría ser "todos" o "filtrado"
	$grid["export"] = array("format"=>"excel", "filename"=>$titulo, "sheetname"=>"Inversión"); 
	// Exportar datos filtrados o todos los datos 
	$grid["export"]["range"] = "all"; // o Todos - "all" 
	$grid["autowidth"] = true; 
	$grid["loadtext"] = true;
	$grid["viewrecords"] = false;
	$grid["rowList"] = false;
	$grid["pgbuttons"] = false;
	$grid["pgtext"] = false;
	$grid["pginput"] = false;
	$grid["direction"] = "right";	
	
	include 'MySQLClass.php';
	$conexion=new MySQLClass();
	$anioactual=date("Y");
	$anioanterior=date("Y")-1;
	extract($_REQUEST);
	if(isset($resp)&&$resp!=null){
		$consulta="SELECT * FROM tabla_graficas WHERE  id > 0 and (nombre='meta' or nombre='cargado' or nombre='planificado' or nombre='plva' or nombre='pedido' or nombre='grafo' or nombre='ejercido') and estatus='$resp' and anio='$anioactual'";
		$grid["caption"]="$nresp";
	}else if(isset($rubro)&&$rubro!=null){
		$consulta="SELECT * FROM tabla_graficas WHERE  id > 0 and (nombre='meta' or nombre='cargado' or nombre='planificado' or nombre='plva' or nombre='pedido' or nombre='grafo' or nombre='ejercido') and estatus='$rubro' and anio='$anioactual' ";
		$grid["caption"]="$nrubro";
	}else if(isset($dd)&&$dd!=null){
		
		if($anioactual==$anio){
			$consulta="SELECT * FROM tabla_graficas WHERE ((nombre='meta' or nombre='cargado' or nombre='planificado' or nombre='plva' or nombre='pedido' or nombre='grafo' or nombre='ejercido' ) and estatus='$dd') and (( anio='$anioactual'  or (anio='$anioanterior' and (nombre='ejercido')) and estatus='$dd'))"; 
		}else if($anioanterior==$anio){
			$consulta="SELECT * FROM tabla_graficas WHERE ((nombre='meta' or nombre='cargado' or nombre='planificado' or nombre='plva' or nombre='pedido' or nombre='grafo' or nombre='ejercido' ) and (estatus='$dd' and anio='$anioanterior') )"; 			
		}
		$grid["caption"]="$ndd";
	}else{
		$consulta="SELECT * FROM tabla_graficas WHERE  id > 0 and ((nombre='meta' or nombre='cargado' or nombre='planificado' or nombre='plva' or nombre='pedido' or nombre='grafo' or nombre='ejercido' ) and estatus='100') and ( anio='$anioactual'))  or (anio='$anioanterior' and nombre='ejercido' and estatus='100' )"; 
		$grid["caption"]="TELMEX";
	}

	
	
	$g->set_options($grid); 
	$g->set_actions(array(     
			"add"=>false, // Habilitar/Deshabilitar AÑADIR 
			"edit"=>false, // Habilitar/Deshabilitar EDITAR
			"delete"=>false, // Habilitar/Deshabilitar BORRAR
			"rowactions"=>false, // Mostrar/Ocultar columna ACTIONS Editar/Borrar/Guardar 
			"showhidecolumns"=>false,
			"export"=>true, // Mostrar/Ocultar Opción Exportar a Excel 
			"autofilter" => false, // Mostrar/Ocultar Barra autofiltro para la búsqueda
			// "search" => "simple" // Vista simple / Condición múltiple de búsqueda de campo (por ejemplo simple or advance) 
		)  
	); 
	// Puede proporcionar consultas SQL personalizadas para mostrar los datos  
	$g->select_command = $consulta; 
	// Esta tabla de la bd se utiliza para agregar, editar, eliminar
	$g->table = "tabla_graficas"; 
	// Pasar las columnas configuradas al grid
	$g->set_columns($cols); 
	// Generar la salida del grid, con el nombre del grid único como "list1"
	$out = $g->render("list1"); 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html> 
	<head> 
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7,IE=Edge,chrome=1">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-88609-1, charset=utf-8">
		<title>Gráfica de Inversión</title>
    <link rel="stylesheet" type="text/css" media="screen" href="lib/js/themes/frida_gris/jquery-ui.custom.css"></link>     
    <link rel="stylesheet" type="text/css" media="screen" href="lib/js/jqgrid/css/ui.jqgrid.css"></link>     
    <script src="lib/js/jquery.min.js" type="text/javascript"></script> 
    <script src="lib/js/jqgrid/js/i18n/grid.locale-es.js" type="text/javascript"></script> 
    <script src="lib/js/jqgrid/js/jquery.jqGrid.min_consulta.js" type="text/javascript"></script>     
    <script src="lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script> 
	</head> 
	<body> 
		<div id="tabla" style="width: 100%; height:100%; margin: 0 auto;"> 
			<br> <center>
			<?php 
				echo $out;
			?> 
		</div> 
	</body> 
</html>