<?php
include('../MySQLClass.php');
class Resumen{
	public $meta;
	public $cargado;
	public $planificado;
	public $plva;
	public $pedido;
	public $grafo;
	public $ejercido;
	public $ejercido_1;
	function ResumenV($meta,$cargado,$planificado,$plva,$pedido,$grafo,$ejercido,$ejercido_1){			
		$this->$meta=$meta;
		$this->$cargado=$cargado;
		$this->$ejercido=$planificado;
		$this->$ejercido=$plva;
		$this->$ejercido=$pedido;
		$this->$ejercido=$grafo;
		$this->$ejercido=$ejercido;
		$this->$ejercido=$ejercido_1;
	}
	function Resumen(){
	}
	function carga_resumen_historico($dd, $sql){
		$conexion=new MySQLClass();
		$result=$conexion->Query($sql);
		$cumeta="";
		$cucargado="";
		$cuplanificado="";
		$cuplva="";
		$cupedido="";
		$cugrafo="";
		$cuejercido="";
		$cuejercido_1="";
		while($row=mysql_fetch_array($result)){
			extract($row);
			$mes=$row[2]-1;
			$date="$row[1],$mes,$row[3]";
			$cumeta.="[Date.UTC($date),$meta],";
			$cucargado.="[Date.UTC($date),$cargado],";
			$cuplanificado.="[Date.UTC($date),$planificado],";
			$cuplva.="[Date.UTC($date),$plva],";
			$cupedido.="[Date.UTC($date),$pedido],";
			$cugrafo.="[Date.UTC($date),$grafo],";
			$cuejercido.="[Date.UTC($date),$ejercido],";
			$cuejercido_1.="[Date.UTC($date),$ejercido_1],";
		}
		$meta= substr($cumeta, 0, -1);
		$cargado= substr($cucargado, 0, -1);
		$planificado= substr($cuplanificado, 0, -1);
		$plva= substr($cuplva, 0, -1);
		$pedido= substr($cupedido, 0, -1);
		$grafo= substr($cugrafo, 0, -1);
		$ejercido= substr($cuejercido, 0, -1);
		$ejercido_1= substr($cuejercido_1, 0, -1);
		$this->Resumen($cumeta,$cucargado,$cuplanificado,$cuplva,$cupedido,$cugrafo,$cuejercido,$cuejercido_1);
		$this->crear_respaldo($cumeta,$cucargado,$cuplanificado,$cuplva,$cupedido,$cugrafo,$cuejercido,$cuejercido_1,$dd);
		$conexion->Disconnect();
		return $datos=array($meta,$cargado,$planificado,$plva,$pedido,$grafo,$ejercido,$ejercido_1);
	}
	
	public function setMeta($meta){
		$this->$meta=$meta;
	}
	public function setCargado($cargado){
		$this->$cargado=$cargado;
	}
	public function setPlanificado($planificado){
		$this->$planificado=$planificado;
	}
	public function setPlva($plva){
		$this->$plva=$plva;
	}
	public function setPedido($pedido){
		$this->$pedido=$pedido;
	}
	public function setGrafo($grafo){
		$this->$grafo=$grafo;
	}
	public function setEjercido($ejercido){
		$this->$ejercido=$ejercido;
	}
	public function setEjercido_1($ejercido_1){
		$this->$ejercido_1=$ejercido_1;
	}
	public function getMeta(){
		return $this->$meta;
	}
	public function getCargado(){
		return $this->$cargado;
	}
	public function getPlanificado(){
		return $this->$planificado;
	}
	public function getPlva(){
		return $this->$plva;
	}
	public function getPedido(){
		return $this->$pedido;
	}
	public function getGrafo(){
		return $this->$grafo;
	}
	public function getEjercido(){
		return $this->$ejercido;
	}
	public function getEjercido_1(){
		return $this->$ejercido_1;
	}
	function crear_respaldo($cumeta,$cucargado,$cuplanificado,$cuplva,$cupedido,$cugrafo,$cuejercido,$cuejercido_1,$dd){
		$archivo = "resumen.txt"; // (o cual sea el nombre)
		$manejador = fopen($archivo,"w"); //la a es para no reemplazar el texto existente
		fwrite($manejador, "/** $dd	**/\n");
		fwrite($manejador, "data[0]=[$cumeta];\n");
		fwrite($manejador, "data[1]=[$cucargado];\n");
		fwrite($manejador, "data[2]=[$cuplanificado];\n");
		fwrite($manejador, "data[3]=[$cuplva];\n");
		fwrite($manejador, "data[4]=[$cupedido];\n");
		fwrite($manejador, "data[5]=[$cugrafo];\n");
		fwrite($manejador, "data[6]=[$cuejercido];\n");
		fwrite($manejador, "data[7]=[$cuejercido_1];\n");
		fclose($manejador);
		return $archivo;
	}
}
extract($_REQUEST);
$cambio=13.3824;
$mil=$cambio/1000;
if($dd!=null&&$dd!='100'){
	function dd($dd,$mil){
		$resumen= new Resumen();
		$anioactual=date("Y");
		$sql="SELECT distinct fecha, substring(fecha,1,4) as d, substring(fecha,6,2) as m, substring(fecha,9,2) as y, (sum(meta)/1000) as meta, (sum(cargado)/$mil) as cargado, (sum(planificado_m)/$mil) as planificado, (sum(plva_m)/$mil) as plva, (sum(pedido_m)/$mil) as pedido, (sum(grafo_m)/$mil) as grafo, (sum(ejercido_tot)/$mil) as ejercido, (sum(ejercido_tot)/$mil) as ejercido_1 FROM resumen_inversion_h WHERE YEAR(fecha)='$anioactual' AND dd='$dd' group by fecha;";
		return $resumen->carga_resumen_historico($dd,$sql);
	}
	$datos=dd($dd,$mil);
}else if($dd=='100'){
	function anual($mil){
		$resumen= new Resumen();
		$anioactual=date("Y");
		$sql="SELECT distinct fecha, substring(fecha,1,4) as d, substring(fecha,6,2) as m, substring(fecha,9,2) as y, (sum(meta)/1000) as meta, (sum(cargado)/$mil) as cargado, (sum(planificado_m)/$mil) as planificado, (sum(plva_m)/$mil) as plva, (sum(pedido_m)/$mil) as pedido, (sum(grafo_m)/$mil) as grafo, (sum(ejercido_tot)/$mil) as ejercido, (sum(ejercido_tot)/$mil) as ejercido_1 FROM resumen_inversion_h WHERE YEAR(fecha)='$anioactual' group by fecha;";
		return $resumen->carga_resumen_historico($dd,$sql);
	}
	$datos=anual($mil);
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7,IE=Edge,chrome=1">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1, charset=utf-8">

		<title>Grafica Historico de Inversion</title>
		<script type="text/javascript" src="lib/js/stock/jquery.min.js"></script>
		
		<script type="text/javascript">
			var data = new Array();
			<?php
		$i=0;
		foreach($datos as $data){?>
			data[<?php echo $i;?>]=[<?php
			echo $data;
			?>];<?php
			$i++;
		}
			?>
			$(function() {
				var seriesOptions = [],
				// yAxisOptions = [],        
				seriesCounter = 0,   
				//names = ['031_135','181_999','000_000', '001_030','NO_JUST','136_150','151_165','166_180','NO_CREEC','001_045'];,'17','25','45','60','70','79','90','LD'
				names = ['Meta','Cargado','Planificado','PLVA','Pedido','Grafo','Ejercido','Ejercido 2012'];
				// colors = Highcharts.getOptions().colors;
				$.each(names, function(i, name) {
					seriesOptions[i] = {
						name: name,
						type: 'spline',
						data: data[i],
						lineWidth : 1,
						marker : {
							enabled : true,
							radius : 2
						},
						dataGrouping: {
							enabled: false
						}
					}  
					seriesCounter++;
					if (seriesCounter == names.length) {
						createChart();
					}
				});
				// create the chart when all data is loaded
				function createChart() {
					chart = new Highcharts.StockChart({
						chart: {
							renderTo: 'container',
							zoomType: 'xy'
						},
						colors: [
							"#000000","#4572A7","#5C4033","#80699B","#ED561B", '#DDDF00',"#8E2323", '#50B432', '#FFF263'
						],
						rangeSelector : {
							selected : 5
						},
						title: {
							name: 'Historico Inversion'
						},
						xAxis: {
							//min: Date.UTC(2011, 9, 17),
							events:{
								// afterSetExtremes:function(){
								//     chart1.xAxis[0].setExtremes(this.min,this.max);
								// }
							},
							//min: Date.UTC(2011, 9, 17),
							//max: Date.UTC(2013, 1, 8),
							// range: Date.UTC(2011, 9, 17) - Date.UTC(2012, 01, 8),
							ordinal: false,
							endOnTick: false,
							startOnTick: false
						},
						yAxis:{
							title:{
								text:'Montos en miles de USD'
							},
							min: 0,
							labels: {
								formatter: function() {
								//	return '';
								return (this.value > 0 ? '' : '') + '$'+Highcharts.numberFormat(this.value, 2) + '';//aqui para la izq modificar
								}
							}
						},
						tooltip: {
							
							pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b> ${point.y} </b> <br/>'
						},
						scrollbar: {
							barBackgroundColor: 'gray',
							barBorderRadius: 7,
							barBorderWidth: 0,
							buttonBackgroundColor: 'gray',
							buttonBorderWidth: 0,
							buttonBorderRadius: 7,
							trackBackgroundColor: 'none',
							trackBorderWidth: 1,
							trackBorderRadius: 8,
							trackBorderColor: '#CCC'
						},
						navigator: {
							xAxis: {
								type: 'datetime',
								//min: Date.UTC(2011, 9, 17),
								//max: Date.UTC(2013, 1, 8),
								//range: Date.UTC(2011, 9, 17) - Date.UTC(2012, 01, 8),
								ordinal: false,
								endOnTick: false,
								startOnTick: false
							}
						},
						series: seriesOptions
					});
				}
			});  
		</script>
	</head>
	<body>
		<script src="lib/js/stock/highstock.js"></script>
		<script src="lib/js/stock/exporting.js"></script>
		<?php
		$combodd=Array('01'=>'Norte','10'=>'Noroeste','15'=>'Centro','17'=>'Telnor','25'=>'Sur','45'=>'Metro','60'=>'LD Norte','70'=>'LD Sur','79'=>'LD Corp','90'=>'Corp','100'=>'TELMEX');
		if($dd=='01')
			$div=' Norte';
		else if($dd=='10')
			$div=' Noroeste';
		else if($dd=='15')
			$div=' Centro';
		else if($dd=='17')
			$div=' Telnor';
		else if($dd=='25')
			$div=' Sur';
		else if($dd=='45')
			$div=' Metro';
		else if($dd=='60')
			$div=' LD Norte';
		else if($dd=='70')
			$div=' LD Sur';
		else if($dd=='79')
			$div=' LD Corp';
		else if($dd=='90')
			$div=' Corp';
		else if($dd=='100')
			$div=' TELMEX';									
		echo "<center>$div<center>";
		echo "<form name='test' method='POST' action='Resumen.php'  >
		";
		?><select name='dd' style='display: block;'onChange='this.form.submit();'><?php
				foreach($combodd as $valor=>$nombre){
					echo " <option value='$valor' ";
					if($dd==$valor){
						echo "selected";
					}else if($dd==null){
						$anual=true;
					}
					echo ">$nombre</option> ";
				}
		echo "</select> ";
		echo "<input type='hidden' name='id' value='$id'/>
		
		</form>
		";
		?>
		<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
	</body>
</html>
<?php ?>