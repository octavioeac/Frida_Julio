<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html> 
	<head> 
	<title>Admin de Gráficas de Inversión</title>
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7,IE=Edge,chrome=1">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-88609-1, charset=utf-8">
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
	include 'MySQLClass.php';
	extract($_REQUEST);
	class grafica{
		var $series=array();
		var $puntos=array();
		function grafica(){
		}
		//recibe un array de los diferentes items
		function crear_($consulta, $categorias, $named){
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
						$seriesname = $doc->createTextNode($name. " ".$anio);
						$seriesname = $name->appendChild($seriesname);
							$data = $doc->createElement('data');
							$data = $seriesn->appendChild($data);
								foreach($row as $v){
									$poit = $doc->createElement('point');
									$poit = $data->appendChild($poit);		
										$pointtext = $doc->createTextNode($v);
										$pointtext = $poit->appendChild($pointtext);
								}
			}
			return $doc->save("$named.xml");
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
	if(isset($consulta)){
		extract($_REQUEST);
		$conexion=new MySQLClass();
		$result1=$conexion->Query($consulta);
		$grafica="";
		if(isset($name)&&$name!=null)
			$subtitulo="$name";
		$name="Gráfica de Proveedores $anio";
		$anioactual=date("Y");
		$titulo="Gráfica de Proveedores $anio";
		$ancho="1000";
		$alto="500";
		$tipo="spline";
		$moneda="USD";
		$cambio="13.3824";
		$vertical="Montos en $moneda";
		$horizontal="Semanas";
		$categorias="";
		$dd="100";
		$series="1";
		$cadenas="1";
		$rubros="100";
		$especial="";
		$planta="NINGUNA";
		$ceros="1";
		$estatus="1";
		if($moneda=='USD'){$funcion='return "<b>"+this.x+"</b><br>"+this.series.name + "<br>$" + Highcharts.numberFormat(this.y, 2) +" dolares<br>"+"$" + Highcharts.numberFormat((this.y)*('.$cambio.'), 2) +" pesos<br>";';}
		else if($moneda!='USD'){$funcion='return "<b>"+this.x+"</b><br>"+this.series.name + "<br>$" + Highcharts.numberFormat(this.y, 2) +" pesos <br>"+"$" + Highcharts.numberFormat(this.y/"'.$cambio.'", 2) +" dolares<br>";';}
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
								if(isset($limit)){
									
										$grafica.=",max: $limit";
								}else{
									
									$sql="Select maximo_y as y, maximo_x as x from limites where (maximo_x is not null) and id_grafica='$id';";
									$result=$conexion->Query($sql);
									while($r=mysql_fetch_array($result))
										extract($r);
										if($r==true){
											$grafica.=",max: $y";
										}
								}
								$grafica.='
							},
							tooltip: {
								formatter:function() {
									'.$funcion.'
								}
							},
							series: [';
							$row1=mysql_fetch_array($result1);
							$name=$row1['nombre'];
							$grafica.="{name:'$name',";
							$grafica.="data:[
								";
							while($row2=mysql_fetch_array($result1)){								
									$grafica.=$row2['valor'].",";
							}
							$conexion->Disconnect();
							$grafica = substr($grafica, 0, -1);	
							$grafica.="
							]}";
							$grafica .=']
						   });
						});
					});
					';				
				echo $grafica;
				}else{
					echo "Fallo la consulta!";
				}
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
	</body>
</html>