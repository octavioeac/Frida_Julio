<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html> 
	<head> <title>Admin de Gráficas de Inversión</title>
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7,IE=Edge,chrome=1">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1, charset=utf-8">
		<link rel="stylesheet" type="text/css" href="../js_css/style.css" media="screen"></link>
	</head>
	<body>
	<div id="wrap">
		<div id="header">
			<h1><a href="../inicio.php">F R I D A (Desarrollo - INVERSIÓN)</a></h1>
			<h2>Facilidades Red Infinitum Datos de Acceso</h2>
			<h3>INVERSIÓN</h3>
		</div>
	</div>
		<div id="panel">
			<!-- 3. Add the container -->
			<div>
				<?php
					echo "
					<div name='menu' aling='top' width='100%' height='70px' >";
						include 'menu_1.php' ;	
					echo "</div>
					<div>";
					extract($_REQUEST);
					echo "<iframe name='grafica' src=\"grafica_1.php?d=$dd&rubro=$rubro&resp=$resp&ndd=$ndd&nrubro=$nrubro&nresp=$nresp&anio=$anio&limit=$limit\" frameborder=0 aling='center' scrolling=no width='100%' height='1350' style='overflow: hidden;'  allowTransparency='true'></iframe>	";
				?>
			</div>
		</div>
	</body> 
</html>