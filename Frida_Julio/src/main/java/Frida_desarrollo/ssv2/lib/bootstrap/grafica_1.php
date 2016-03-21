<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html> 
	<head> 
	<title>Admin de Gráficas de Inversión</title>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7,IE=Edge,chrome=1">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1, charset=utf-8">
	<script type="text/javascript" src="lib/jquery.min.js"></script>
	<script type="text/javascript" src="lib/js/highcharts.js"></script>
	<style type="text/css">
		html, body {
			margin: 0;			/* Remove body margin/padding */
			padding: 0;
	        font-size: 62.5%;
        } body {
			font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
			font-size: 13px;
			color: gray;
		} INPUT {
				vertical-align: middle;
				font-size: 13px;
		} a {
			color: gray;
		}
	</style>
	<?php
	//Lee los datos de la tabla seleccionada y genera el xml de la grafica, Al final redirecciona a la página que muestra la gráfica.
	include ("MySQLClass.php");	
	extract($_REQUEST);
	$ranio=$anio;
	$rdd=$d;
	class grafica{
		var $nueva;
		var $ameses;
		var $campos;
		var $consulta;
		var $series=array();
		var $puntos=array();
		var $enero;
		var $febrero;
		var $marzo;
		var $abril;
		var $mayo;
		var $junio;
		var $julio;
		var $agosto;
		var $septiembre;
		var $octubre;
		var $noviembre;
		var $diciembre;
		function grafica(){}
		//crea categorias
		//recibe un array de los diferentes items
		function crear_($consulta, $categorias, $nombred){
			$result = mysql_query($consulta,$con);
			$doc = new DOMDocument('1.0');
			$doc->formatOutput = true;
			$root = $doc->createElement('chart');
			$root = $doc->appendChild($root);
			$categories = $doc->createElement('categories');
			$categories = $root->appendChild($categories);
			foreach($categorias as $vcate){
				$item = $doc->createElement('item');
				$item = $categories->appendChild($item);
				$itemname = $doc->createTextNode($vcate);
				$itemname = $item->appendChild($itemname);
			}
			while($row = mysql_fetch_array($result)){
				extract($row);
				$seriesn = $doc->createElement('series');
				$seriesn = $root->appendChild($seriesn);
					$name = $doc->createElement('name');
					$name = $seriesn->appendChild($name);

						$seriesname = $doc->createTextNode($nombre. " ".$anio);
						$seriesname = $name->appendChild($seriesname);
							$data = $doc->createElement('data');
							$data = $seriesn->appendChild($data);
								$ameses=array($enero, $febrero, $marzo, $abril, $mayo, $junio, $julio, $agosto, $septiembre, $octubre, $noviembre, $diciembre);
								foreach($ameses as $v){
									$poit = $doc->createElement('point');
									$poit = $data->appendChild($poit);		
										$pointtext = $doc->createTextNode($v);
										$pointtext = $poit->appendChild($pointtext);
								}
			}
			return $doc->save("$nombred.xml");
		}
		/****Apartado para generación de graficas XML*/
		function acumulado_pormes(){
			$campos=array("Cargado", "Ejercido", "Meta");
			//consulta con los datos de la gráfica ya depositados
			$anioactual=date("Y");
			$anioanterior=date("Y")-1;
			$sql="SELECT * FROM tabla_graficas WHERE anio='".$anioanterior."' and id > 0 ";
			for($i=0; $i<sizeof($campos); $i++){
				if($i==0) 	$sql.="and (";
				if($i!=0||$i==sizeof($campos)-1) 	$sql.=" or ";
					$sql.=" nombre like '%".$campos[$i]."%' ";
			}	
			$sql.=")";
			$categorias=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			
			return $sql;
			
		}
	}
	$nombred="Acumulado";
	$conexion=new MySQLClass();	
	$sql="select maximo_y from limites where nombre ='$dd' ";
	$result=$conexion->Query($sql);
	$row=mysql_fetch_array($result);
	$limit=$row['maximo_y'];
	$anioactual=date("Y");
	$anioanterior=date("Y")-1;
	extract($_REQUEST);
	$dd=$d;
	if(isset($resp)&&$resp!=null){
		$consulta="SELECT * FROM tabla_graficas WHERE  id > 0 and (nombre='meta' or nombre='cargado' or nombre='planificado' or nombre='plva' or nombre='pedido' or nombre='grafo' or nombre='ejercido') and estatus='$resp' and anio='$anioactual'";
		$subtitulo="$nresp";
	}else if(isset($rubro)&&$rubro!=null){
		$consulta="SELECT * FROM tabla_graficas WHERE  id > 0 and (nombre='meta' or nombre='cargado' or nombre='planificado' or nombre='plva' or nombre='pedido' or nombre='grafo' or nombre='ejercido') and estatus='$rubro' and anio='$anioactual' ";
		$subtitulo="$nrubro";
	}else if(isset($dd)&&$dd!=null){
		
		if($anioactual==$anio){
			$consulta="SELECT * FROM tabla_graficas WHERE ((nombre='meta' or nombre='cargado' or nombre='planificado' or nombre='plva' or nombre='pedido' or nombre='grafo' or nombre='ejercido' ) and estatus='$dd') and (( anio='$anioactual'  or (anio='$anioanterior' and (nombre='ejercido')) and estatus='$dd'))"; 
		}else if($anioanterior==$anio){
			$consulta="SELECT * FROM tabla_graficas WHERE ((nombre='meta' or nombre='cargado' or nombre='planificado' or nombre='plva' or nombre='pedido' or nombre='grafo' or nombre='ejercido' ) and (estatus='$dd' and anio='$anioanterior') )"; 			
		}
		$subtitulo="$ndd";
	}else{
		$consulta="SELECT * FROM tabla_graficas WHERE  id > 0 and ((nombre='meta' or nombre='cargado' or nombre='planificado' or nombre='plva' or nombre='pedido' or nombre='grafo' or nombre='ejercido' ) and estatus='100') and ( anio='$anioactual'))  or (anio='$anioanterior' and nombre='ejercido' and estatus='100' )"; 
		$subtitulo="TELMEX";
	}
	
	$grafica="";
	$nombre="Gráfica de Inversión 2013 VS Ejercido 2012";
	$anioactual=date("Y");
	$titulo="Gráfica de Inversión 2013 VS Ejercido 2012";
	$ancho="900";
	$alto="500";
	$tipo="spline";
	$moneda="USD";
	$cambio="13.000";
	$vertical="Montos en miles de $moneda";
	$horizontal="Meses";
	$categorias="";
	$dd="100";
	$cadenas="1";
	$rubros="100";
	$especial="";
	$planta="NINGUNA";
	if($moneda=='USD'){$funcion='return "<b>"+this.x+"</b><br>"+this.series.name + "<br>$" + Highcharts.numberFormat(this.y, 2) +" miles de dolares<br>"+"$" + Highcharts.numberFormat((this.y)*('.$cambio.'), 2) +" miles de pesos<br>";';}
	else if($moneda!='USD'){$funcion='return "<b>"+this.x+"</b><br>"+this.series.name + "<br>$" + Highcharts.numberFormat(this.y, 2) +" miles de pesos<br>"+"$" + Highcharts.numberFormat(this.y/"'.$cambio.'", 2) +" miles de dolares<br>";';}
	$graficar = new grafica();
	$graficar->grafica();
	$graficar->acumulado_pormes();
	$grafica='
			<script type="text/javascript">
				$(function () {
					var chart;
					$(document).ready(function() {
						chart = new Highcharts.Chart({
							chart: {
								renderTo: "container",
								type: "'.$tipo.'"
							},
							title: {
								text: "'.$titulo.'",
								x:-20 //center
							},
							subtitle:{
								style:{
									fontSize: 16,
									fontWeight: "bold"
								},
								text: "'.$subtitulo.'",
								x:-20 //center
							},
							xAxis : {
								title: {
									text: "'.$horizontal.'"
								},
								categories : [';
								if($horizontal=="Meses"){
									$grafica.='"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"';
									$grafica.= '],
								min: 0,
								max: ';
								
									$grafica.='11';
								}else if($horizontal=="Semanas"){
									$grafica.='"01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53"';
									$grafica.= '],
								min: 0,
								max: ';
									$grafica.='52';
									$grafica.=',
									labels: {
										rotation: 90
									}';
								}
								$grafica.='
							},
							yAxis: {
								title: {
									text: "'.$vertical.'"
								},
								 labels: {
									formatter: function() {
										return "$ "+Highcharts.numberFormat(this.value, 0);
									}
								},
								min: 0';
								if($limit!=null){
									$grafica.=",max: $limit";
								}
								$grafica.='
							},
							tooltip: {
								formatter:function() {
									'.$funcion.'
								}
							},
							series: [';
							$result=$conexion->Query($consulta);
							while($row=mysql_fetch_array($result)){
								extract ($row);
								$grafica.="{name:'$nombre $anio',";
								$grafica.="data:[$enero, $febrero, $marzo, $abril, $mayo, $junio, $julio, $agosto, $septiembre, $octubre, $noviembre, $diciembre]},";
								if($nombre=="Ejercido"||$nombre=="Cargado"){
								}else{
									$grafica = substr($grafica, 0, -2);										
									$grafica.=",
										visible: false
									},";
								}
							}
							$conexion->Disconnect();
							$grafica = substr($grafica, 0, -1);	
							$grafica .=']
						   });
						});
					});
					';				
				echo $grafica;
			?>
		</script>
		<script>
			Highcharts.theme = {
			   colors: ["#000000","#4572A7","#5C4033","#80699B","#ED561B", '#DDDF00',"#8E2323", '#50B432', '#FFF263']
			}
			// Apply the theme
			var highchartsOptions = Highcharts.setOptions(Highcharts.theme);
		</script>
	</head>
	<body>
		<div id="contenido">
			<br>
			<div id="container" style="width:<?php echo $ancho ?>px; height: <?php echo $alto ?>px; margin: 0 auto;"></div>
		</div>
		<div>
			<?php
				echo "<iframe name='grafica' src='tabla_1.php?dd=".$rdd."&rubro=".$rubro."&resp=".$resp."&ndd=".$ndd."&nrubro=".$nrubro."&nresp=".$nresp."&anio=".$ranio."' frameborder=0 aling='bottom' scrolling=no width='100%' height='550' allowTransparency='true'>NO ACEPTA IFRAME TU EXPLORADOR</iframe>";
			?>
			
		</div>
	</body>
</html>
