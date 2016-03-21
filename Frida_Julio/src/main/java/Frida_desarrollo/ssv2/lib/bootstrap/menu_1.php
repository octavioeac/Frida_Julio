<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html> 
	<head> 
		<title>Admin de Gráficas de Inversión</title>
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7,IE=Edge,chrome=1">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1, charset=utf-8">
		<title>jQuery UI Menubar - Default demo</title>
		<link rel="stylesheet" href="lib/js/jquery.ui.core.css" />
		<link rel="stylesheet" href="lib/js/jquery.ui.accordion.css" />
		<link rel="stylesheet" href="lib/js/jquery.ui.autocomplete.css" />
		<link rel="stylesheet" href="lib/js/jquery.ui.button.css" />
		<link rel="stylesheet" href="lib/js/jquery.ui.datepicker.css" />
		<link rel="stylesheet" href="lib/js/jquery.ui.dialog.css" />
		<link rel="stylesheet" href="lib/js/jquery.ui.menu.css" />
		<link rel="stylesheet" href="lib/js/jquery.ui.menubar.css" />
		<link rel="stylesheet" href="lib/js/jquery.ui.selectable.css" />
		<link rel="stylesheet" href="lib/js/jquery.ui.slider.css" />
		<link rel="stylesheet" href="lib/js/jquery.ui.tabs.css" />
		<link rel="stylesheet" href="lib/js/jquery.ui.theme.css" />
		<script src="lib/js/jquery-1.9.1.js"></script>
		<script src="lib/js/jquery.ui.core.js"></script>
		<script src="lib/js/jquery.ui.widget.js"></script>
		<script src="lib/js/jquery.ui.position.js"></script>
		<script src="lib/js/jquery.ui.button.js"></script>
		<script src="lib/js/jquery.ui.menu.js"></script>
		<script src="lib/js/jquery.ui.menubar.js"></script>
		<script>
			$(function() {
				function select(event, ui) {
				$("<div/>").text("Selected: " + ui.item.text()).appendTo("#log");
				if (ui.item.text() == 'Quit') {
					$(this).menubar('destroy');
				}
			}
			$("#bar1").menubar({
				position: {
					within: $("#demo-frame").add(window).first()
				},
				select: select
			});

			$(".menubar-icons").menubar({
				autoExpand: true,
				menuIcon: true,
				buttons: true,
				position: {
					within: $("#demo-frame").add(window).first()
				},
				select: select
			});

			$("#bar3").menubar({
				position: {
					within: $("#demo-frame").add(window).first()
				},
				select: select,
				items: ".menubarItem",
				menuElement: ".menuElement"
			});
		});
		</script>
		<style>
			#bar2 { margin: 0 0 4em; }
		</style>
	</head>
	<body>

		<div class="demo">
			<ul id="bar2" class="menubar-icons">
				<li>
					<a href="#2013">Inversión 2013</a>
					<ul>
						<li>
							<a>Local</a>
							<ul>
								<li><a href="grafica_1.php?d=15&ndd=Centro&anio=2013" target="grafica">Centro</a></li>
								<li><a href="grafica_1.php?d=45&ndd=Metro&anio=2013" target="grafica">Metro</a></li>
								<li><a href="grafica_1.php?d=10&ndd=Noroeste&anio=2013" target="grafica">Noroeste</a></li>
								<li><a href="grafica_1.php?d=01&ndd=Norte&anio=2013" target="grafica">Norte</a></li>
								<li><a href="grafica_1.php?d=25&ndd=Sur&anio=2013" target="grafica">Sur</a></li>
								<li><a href="grafica_1.php?d=17&ndd=Telnor&anio=2013" target="grafica">Telnor</a></li>
							</ul>
						</li>
						<li>
							<a>Larga Distancia</a>
							<ul>
								<li><a href="grafica_1.php?d=60&ndd=SORD Norte&anio=2013" target="grafica">SORD Norte</a></li>
								<li><a href="grafica_1.php?d=70&ndd=SORD Sur&anio=2013" target="grafica">SORD Sur</a></li>
								<li><a href="grafica_1.php?d=79&ndd=SORD Corp&anio=2013" target="grafica">SORD Corp</a></li>
								<li><a href="grafica_1.php?d=90&ndd=Corporativo&anio=2013" target="grafica">Corporativo</a></li>
							</ul>
						</li>
						<li><a href="grafica_1.php?d=100&ndd=TELMEX&anio=2013" target="grafica">TELMEX</a></li>	
					</ul>
				</li>
				<li>
					<a href="#2012">Inversión 2012</a>
					<ul>
						<li>
							<a>Local</a>
							<ul>
								<li><a href="grafica_1.php?anio=2012&d=15&ndd=Centro&anio=2012" target="grafica">Centro</a></li>
								<li><a href="grafica_1.php?d=45&ndd=Metro&anio=2012" target="grafica">Metro</a></li>
								<li><a href="grafica_1.php?d=10&ndd=Noroeste&anio=2012" target="grafica">Noroeste</a></li>
								<li><a href="grafica_1.php?d=01&ndd=Norte&anio=2012" target="grafica">Norte</a></li>
								<li><a href="grafica_1.php?d=25&ndd=Sur&anio=2012" target="grafica">Sur</a></li>
								<li><a href="grafica_1.php?d=17&ndd=Telnor&anio=2012" target="grafica">Telnor</a></li>
							</ul>
						</li>
						<li>
							<a>Larga Distancia</a>
							<ul>
								<li><a href="grafica_1.php?d=60&ndd=SORD Norte&anio=2012" target="grafica">SORD Norte</a></li>
								<li><a href="grafica_1.php?d=70&ndd=SORD Sur&anio=2012" target="grafica">SORD Sur</a></li>
							</ul>
						</li>
						<li><a href="grafica_1.php?d=100&ndd=TELMEX&anio=2012" target="grafica">TELMEX</a></li>
					</ul>
				</li>
				<li>
					<a href="#Edit">Historico Diario</a>
					<ul>
						<li>
							<a>Local</a>
							<ul>
								<li><a href="Resumen.php?dd=15" target="grafica">Centro</a></li>
								<li><a href="Resumen.php?dd=45" target="grafica">Metro</a></li>
								<li><a href="Resumen.php?dd=10" target="grafica">Noroeste</a></li>
								<li><a href="Resumen.php?dd=01" target="grafica">Norte</a></li>
								<li><a href="Resumen.php?dd=25" target="grafica">Sur</a></li>
								<li><a href="Resumen.php?dd=17" target="grafica">Telnor</a></li>
							</ul>
						</li>
						<li>
							<a>Larga Distancia</a>
							<ul>
								<li><a href="Resumen.php?dd=60" target="grafica">SORD Norte</a></li>
								<li><a href="Resumen.php?dd=70" target="grafica">SORD Sur</a></li>
								<li><a href="Resumen.php?dd=79" target="grafica">SORD Corp</a></li>
								<li><a href="Resumen.php?dd=90" target="grafica">Corporativo</a></li>
							</ul>
						</li>
						<li><a href="Resumen.php?dd=100" target="grafica">TELMEX</a></li>
			<!--			<li class="ui-state-disabled"><a href="#">Paste</a></li>-->
					</ul>
				</li>
				<li>
					<a href="#View">Inversion Anual</a>
					<ul>
						<li>
							<a href="#Rubros">Rubros</a>
							<ul>
								<li><a href="grafica_1.php?rubro=RD&nrubro=ACCESO - RDA/RNSP" target="grafica">ACCESO - RDA/RNSP</a></li>
								<li><a href="grafica_1.php?rubro=PE&nrubro=PLANTA EXTERNA" target="grafica">PLANTA EXTERNA</a></li>
								<li><a href="grafica_1.php?rubro=CO&nrubro=PROYECTOS CORP" target="grafica">PROYECTOS CORP</a></li>
								<li><a href="grafica_1.php?rubro=AC&nrubro=ACESO - INFINITUM" target="grafica">ACESO - INFINITUM</a></li>
								<li><a href="grafica_1.php?rubro=DT&nrubro=ACESO - INFINITUM DT" target="grafica">ACESO - INFINITUM DT</a></li>
								<li><a href="grafica_1.php?rubro=CX&nrubro=CONMUTACION" target="grafica">CONMUTACION</a></li>
								<li><a href="grafica_1.php?rubro=FZ&nrubro=FUERZA Y CLIMA" target="grafica">FUERZA Y CLIMA</a></li>
								<li><a href="grafica_1.php?rubro=TX&nrubro=TRANSPORTE" target="grafica">TRANSPORTE</a></li>
								<li><a href="grafica_1.php?rubro=LD&nrubro=LARGA DISTANCIA" target="grafica">LARGA DISTANCIA</a></li>
							</ul>
						</li>
						<li>
							<a href="#Responsables">Responsables</a>
							<ul>
								<li><a href="grafica_1.php?resp=WEH&nresp=WISTANO ESTRADA HERRERA" target="grafica">WEH</a></li>
								<li><a href="grafica_1.php?resp=EGP&nresp=EDUARDO GUEVARA POBLANO" target="grafica">EGP</a></li>
								<li><a href="grafica_1.php?resp=MNM&nresp=MAURICIO NAVARRO MADARIAGA" target="grafica">MNM</a></li>
								<li><a href="grafica_1.php?resp=CHP&nresp=CARLOS HERRERA PATIÑO" target="grafica">CHP</a></li>
								<li><a href="grafica_1.php?resp=MOV&nresp=MIGUEL ORDUÑO VALDEZ" target="grafica">MOV</a></li>
								<li><a href="grafica_1.php?resp=HTL&nresp=HECTOR TORRES LOPEZ" target="grafica">HTL</a></li>
							</ul>
						</li>
						<li>
							<a href="#Proveedores 2012">Proveedores 2012</a>
							<ul>
								<li>
									<a href="tabla_proveedores.php?name=ADTRAN&anio=2012" target="grafica">ADTRAN</a>
									<ul>
										<li>
											<a>Local</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=15&name=ADTRAN Centro&anio=2012" target="grafica">Centro</a></li>
												<li><a href="tabla_proveedores.php?d=45&ndd=ADTRAN Metro&anio=2012" target="grafica">Metro</a></li>
												<li><a href="tabla_proveedores.php?d=10&ndd=ADTRAN Noroeste&anio=2012" target="grafica">Noroeste</a></li>
												<li><a href="tabla_proveedores.php?d=01&ndd=ADTRAN Norte&anio=2012" target="grafica">Norte</a></li>
												<li><a href="tabla_proveedores.php?d=25&ndd=ADTRAN Sur&anio=2012" target="grafica">Sur</a></li>
												<li><a href="tabla_proveedores.php?d=17&ndd=ADTRAN Telnor&anio=2012" target="grafica">Telnor</a></li>
											</ul>
										</li>
										<li>
											<a>Larga Distancia</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=60&ndd=ADTRAN SORD Norte&anio=2012" target="grafica">SORD Norte</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a href="tabla_proveedores.php?name=ALCATEL-LUCENT&anio=2012" target="grafica">ALCATEL-LUCENT</a>
									<ul>
										<li>
											<a>Local</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=15&name=ALCATEL-LUCENT Centro&anio=2012" target="grafica">Centro</a></li>
												<li><a href="tabla_proveedores.php?d=45&ndd=ALCATEL-LUCENT Metro&anio=2012" target="grafica">Metro</a></li>
												<li><a href="tabla_proveedores.php?d=10&ndd=ALCATEL-LUCENT Noroeste&anio=2012" target="grafica">Noroeste</a></li>
												<li><a href="tabla_proveedores.php?d=01&ndd=ALCATEL-LUCENT Norte&anio=2012" target="grafica">Norte</a></li>
												<li><a href="tabla_proveedores.php?d=25&ndd=ALCATEL-LUCENT Sur&anio=2012" target="grafica">Sur</a></li>
												<li><a href="tabla_proveedores.php?d=17&ndd=ALCATEL-LUCENT Telnor&anio=2012" target="grafica">Telnor</a></li>
											</ul>
										</li>
										<li>
											<a>Larga Distancia</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=60&ndd=ADTRAN SORD Norte&anio=2012" target="grafica">SORD Norte</a></li>
												<li><a href="tabla_proveedores.php?d=70&ndd=ADTRAN SORD Sur&anio=2012" target="grafica">SORD Sur</a></li>
												<li><a href="tabla_proveedores.php?d=79&ndd=ADTRAN SORD Corp&anio=2012" target="grafica">SORD Corp</a></li>
												<li><a href="tabla_proveedores.php?d=90&ndd=ADTRAN Corporativo&anio=2012" target="grafica">Corporativo</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a href="tabla_proveedores.php?name=HUAWEI&anio=2012" target="grafica">HUAWEI</a>
									<ul>
										<li>
											<a>Local</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=15&name=HUAWEI Centro&anio=2012" target="grafica">Centro</a></li>
												<li><a href="tabla_proveedores.php?d=45&ndd=HUAWEI Metro&anio=2012" target="grafica">Metro</a></li>
												<li><a href="tabla_proveedores.php?d=10&ndd=HUAWEI Noroeste&anio=2012" target="grafica">Noroeste</a></li>
												<li><a href="tabla_proveedores.php?d=01&ndd=HUAWEI Norte&anio=2012" target="grafica">Norte</a></li>
												<li><a href="tabla_proveedores.php?d=25&ndd=HUAWEI Sur&anio=2012" target="grafica">Sur</a></li>
												<li><a href="tabla_proveedores.php?d=17&ndd=HUAWEI Telnor&anio=2012" target="grafica">Telnor</a></li>
											</ul>
										</li>
										<li>
											<a>Larga Distancia</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=60&ndd=HUAWEI SORD Norte&anio=2012" target="grafica">SORD Norte</a></li>
												<li><a href="tabla_proveedores.php?d=70&ndd=HUAWEI SORD Sur&anio=2012" target="grafica">SORD Sur</a></li>
												<li><a href="tabla_proveedores.php?d=79&ndd=HUAWEI SORD Corp&anio=2012" target="grafica">SORD Corp</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a href="tabla_proveedores.php?name=PSS&anio=2012" target="grafica">PSS</a>
									<ul>
										<li>
											<a>Local</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=15&name=PSS Centro&anio=2012" target="grafica">Centro</a></li>
												<li><a href="tabla_proveedores.php?d=45&ndd=PSS Metro&anio=2012" target="grafica">Metro</a></li>
												<li><a href="tabla_proveedores.php?d=10&ndd=PSS Noroeste&anio=2012" target="grafica">Noroeste</a></li>
												<li><a href="tabla_proveedores.php?d=01&ndd=PSS Norte&anio=2012" target="grafica">Norte</a></li>
												<li><a href="tabla_proveedores.php?d=25&ndd=PSS Sur&anio=2012" target="grafica">Sur</a></li>
												<li><a href="tabla_proveedores.php?d=17&ndd=PSS Telnor&anio=2012" target="grafica">Telnor</a></li>
											</ul>
										</li>
										<li>
											<a>Larga Distancia</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=60&ndd=PSS SORD Norte&anio=2012" target="grafica">SORD Norte</a></li>
												<li><a href="tabla_proveedores.php?d=70&ndd=PSS SORD Sur&anio=2012" target="grafica">SORD Sur</a></li>
												<li><a href="tabla_proveedores.php?d=79&ndd=PSS SORD Corp&anio=2012" target="grafica">SORD Corp</a></li>
												<li><a href="tabla_proveedores.php?d=90&ndd=PSS Corporativo&anio=2012" target="grafica">Corporativo</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a href="tabla_proveedores.php?name=CISCO&anio=2012" target="grafica">CISCO</a>
									<ul>
										<li>
											<a>Local</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=15&name=CISCO Centro&anio=2012" target="grafica">Centro</a></li>
												<li><a href="tabla_proveedores.php?d=45&ndd=CISCO Metro&anio=2012" target="grafica">Metro</a></li>
												<li><a href="tabla_proveedores.php?d=10&ndd=CISCO Noroeste&anio=2012" target="grafica">Noroeste</a></li>
												<li><a href="tabla_proveedores.php?d=01&ndd=CISCO Norte&anio=2012" target="grafica">Norte</a></li>
												<li><a href="tabla_proveedores.php?d=25&ndd=CISCO Sur&anio=2012" target="grafica">Sur</a></li>
												<li><a href="tabla_proveedores.php?d=17&ndd=CISCO Telnor&anio=2012" target="grafica">Telnor</a></li>
											</ul>
										</li>
										<li>
											<a>Larga Distancia</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=60&ndd=CISCO SORD Norte&anio=2012" target="grafica">SORD Norte</a></li>
												<li><a href="tabla_proveedores.php?d=70&ndd=CISCO SORD Sur&anio=2012" target="grafica">SORD Sur</a></li>
												<li><a href="tabla_proveedores.php?d=79&ndd=CISCO SORD Corp&anio=2012" target="grafica">SORD Corp</a></li>
												<li><a href="tabla_proveedores.php?d=90&ndd=CISCO Corporativo&anio=2012" target="grafica">Corporativo</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a href="tabla_proveedores.php?name=CIENA&anio=2012" target="grafica">CIENA</a>
									<ul>
										<li>
											<a>Local</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=15&name=CIENA Centro&anio=2012" target="grafica">Centro</a></li>
												<li><a href="tabla_proveedores.php?d=45&ndd=CIENA Metro&anio=2012" target="grafica">Metro</a></li>
												<li><a href="tabla_proveedores.php?d=10&ndd=CIENA Noroeste&anio=2012" target="grafica">Noroeste</a></li>
												<li><a href="tabla_proveedores.php?d=01&ndd=CIENA Norte&anio=2012" target="grafica">Norte</a></li>
												<li><a href="tabla_proveedores.php?d=25&ndd=CIENA Sur&anio=2012" target="grafica">Sur</a></li>
												<li><a href="tabla_proveedores.php?d=17&ndd=CIENA Telnor&anio=2012" target="grafica">Telnor</a></li>
											</ul>
										</li>
										<li>
											<a>Larga Distancia</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=60&ndd=CIENA SORD Norte&anio=2012" target="grafica">SORD Norte</a></li>
												<li><a href="tabla_proveedores.php?d=70&ndd=CIENA SORD Sur&anio=2012" target="grafica">SORD Sur</a></li>
												<li><a href="tabla_proveedores.php?d=79&ndd=CIENA SORD Corp&anio=2012" target="grafica">SORD Corp</a></li>
												<li><a href="tabla_proveedores.php?d=90&ndd=CIENA Corporativo&anio=2012" target="grafica">Corporativo</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a href="tabla_proveedores.php?name=NEC&anio=2012" target="grafica">NEC</a>
									<ul>
										<li>
											<a>Local</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=15&name=NEC Centro&anio=2012" target="grafica">Centro</a></li>
												<li><a href="tabla_proveedores.php?d=45&ndd=NEC Metro&anio=2012" target="grafica">Metro</a></li>
												<li><a href="tabla_proveedores.php?d=10&ndd=NEC Noroeste&anio=2012" target="grafica">Noroeste</a></li>
												<li><a href="tabla_proveedores.php?d=01&ndd=NEC Norte&anio=2012" target="grafica">Norte</a></li>
												<li><a href="tabla_proveedores.php?d=25&ndd=NEC Sur&anio=2012" target="grafica">Sur</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a href="tabla_proveedores.php?name=TALKPOOL&anio=2012" target="grafica">TALKPOOL</a>
									<ul>
										<li>
											<a>Local</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=15&name=TALKPOOL Centro&anio=2012" target="grafica">Centro</a></li>
												<li><a href="tabla_proveedores.php?d=45&ndd=TALKPOOL Metro&anio=2012" target="grafica">Metro</a></li>
												<li><a href="tabla_proveedores.php?d=10&ndd=TALKPOOL Noroeste&anio=2012" target="grafica">Noroeste</a></li>
												<li><a href="tabla_proveedores.php?d=01&ndd=TALKPOOL Norte&anio=2012" target="grafica">Norte</a></li>
												<li><a href="tabla_proveedores.php?d=25&ndd=TALKPOOL Sur&anio=2012" target="grafica">Sur</a></li>
												<li><a href="tabla_proveedores.php?d=17&ndd=TALKPOOL Telnor&anio=2012" target="grafica">Telnor</a></li>
											</ul>
										</li>
										<li>
											<a>Larga Distancia</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=60&ndd=TALKPOOL SORD Norte&anio=2012" target="grafica">SORD Norte</a></li>
												<li><a href="tabla_proveedores.php?d=70&ndd=TALKPOOL SORD Sur&anio=2012" target="grafica">SORD Sur</a></li>
												<li><a href="tabla_proveedores.php?d=79&ndd=TALKPOOL SORD Corp&anio=2012" target="grafica">SORD Corp</a></li>
												<li><a href="tabla_proveedores.php?d=90&ndd=TALKPOOL Corporativo&anio=2012" target="grafica">Corporativo</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a href="tabla_proveedores.php?name=TYCO-ADC&anio=2012" target="grafica">TYCO-ADC</a>
									<ul>
										<li>
											<a>Local</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=15&name=TYCO-ADC Centro&anio=2012" target="grafica">Centro</a></li>
												<li><a href="tabla_proveedores.php?d=45&ndd=TYCO-ADC Metro&anio=2012" target="grafica">Metro</a></li>
												<li><a href="tabla_proveedores.php?d=10&ndd=TYCO-ADC Noroeste&anio=2012" target="grafica">Noroeste</a></li>
												<li><a href="tabla_proveedores.php?d=01&ndd=TYCO-ADC Norte&anio=2012" target="grafica">Norte</a></li>
												<li><a href="tabla_proveedores.php?d=25&ndd=TYCO-ADC Sur&anio=2012" target="grafica">Sur</a></li>
												<li><a href="tabla_proveedores.php?d=17&ndd=TYCO-ADC Telnor&anio=2012" target="grafica">Telnor</a></li>
											</ul>
										</li>
										<li>
											<a>Larga Distancia</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=60&ndd=TYCO-ADC SORD Norte&anio=2012" target="grafica">SORD Norte</a></li>
												<li><a href="tabla_proveedores.php?d=70&ndd=TYCO-ADC SORD Sur&anio=2012" target="grafica">SORD Sur</a></li>
												<li><a href="tabla_proveedores.php?d=79&ndd=TYCO-ADC SORD Corp&anio=2012" target="grafica">SORD Corp</a></li>
												<li><a href="tabla_proveedores.php?d=90&ndd=TYCO-ADC Corporativo&anio=2012" target="grafica">Corporativo</a></li>
											</ul>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						<li>
							<a href="#Proveedores 2013">Proveedores 2013</a>
							<ul>
								<li>
									<a href="tabla_proveedores.php?name=ADTRAN&anio=2013" target="grafica">ADTRAN</a>
									<ul>
										<li>
											<a>Local</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=15&name=ADTRAN Centro&anio=2013" target="grafica">Centro</a></li>
												<li><a href="tabla_proveedores.php?d=45&ndd=ADTRAN Metro&anio=2013" target="grafica">Metro</a></li>
												<li><a href="tabla_proveedores.php?d=10&ndd=ADTRAN Noroeste&anio=2013" target="grafica">Noroeste</a></li>
												<li><a href="tabla_proveedores.php?d=01&ndd=ADTRAN Norte&anio=2013" target="grafica">Norte</a></li>
												<li><a href="tabla_proveedores.php?d=25&ndd=ADTRAN Sur&anio=2013" target="grafica">Sur</a></li>
												<li><a href="tabla_proveedores.php?d=17&ndd=ADTRAN Telnor&anio=2013" target="grafica">Telnor</a></li>
											</ul>
										</li>
										<li>
											<a>Larga Distancia</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=60&ndd=ADTRAN SORD Norte&anio=2013" target="grafica">SORD Norte</a></li>
												<li><a href="tabla_proveedores.php?d=70&ndd=ADTRAN SORD Sur&anio=2013" target="grafica">SORD Sur</a></li>
												<li><a href="tabla_proveedores.php?d=79&ndd=ADTRAN SORD Corp&anio=2013" target="grafica">SORD Corp</a></li>
												<li><a href="tabla_proveedores.php?d=90&ndd=ADTRAN Corporativo&anio=2013" target="grafica">Corporativo</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a href="tabla_proveedores.php?name=ALCATEL-LUCENT&anio=2013" target="grafica">ALCATEL-LUCENT</a>
									<ul>
										<li>
											<a>Local</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=15&name=ALCATEL-LUCENT Centro&anio=2013" target="grafica">Centro</a></li>
												<li><a href="tabla_proveedores.php?d=45&ndd=ALCATEL-LUCENT Metro&anio=2013" target="grafica">Metro</a></li>
												<li><a href="tabla_proveedores.php?d=10&ndd=ALCATEL-LUCENT Noroeste&anio=2013" target="grafica">Noroeste</a></li>
												<li><a href="tabla_proveedores.php?d=01&ndd=ALCATEL-LUCENT Norte&anio=2013" target="grafica">Norte</a></li>
												<li><a href="tabla_proveedores.php?d=25&ndd=ALCATEL-LUCENT Sur&anio=2013" target="grafica">Sur</a></li>
												<li><a href="tabla_proveedores.php?d=17&ndd=ALCATEL-LUCENT Telnor&anio=2013" target="grafica">Telnor</a></li>
											</ul>
										</li>
										<li>
											<a>Larga Distancia</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=60&ndd=ADTRAN SORD Norte&anio=2013" target="grafica">SORD Norte</a></li>
												<li><a href="tabla_proveedores.php?d=70&ndd=ADTRAN SORD Sur&anio=2013" target="grafica">SORD Sur</a></li>
												<li><a href="tabla_proveedores.php?d=79&ndd=ADTRAN SORD Corp&anio=2013" target="grafica">SORD Corp</a></li>
												<li><a href="tabla_proveedores.php?d=90&ndd=ADTRAN Corporativo&anio=2013" target="grafica">Corporativo</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a href="tabla_proveedores.php?name=HUAWEI&anio=2013" target="grafica">HUAWEI</a>
									<ul>
										<li>
											<a>Local</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=15&name=HUAWEI Centro&anio=2013" target="grafica">Centro</a></li>
												<li><a href="tabla_proveedores.php?d=45&ndd=HUAWEI Metro&anio=2013" target="grafica">Metro</a></li>
												<li><a href="tabla_proveedores.php?d=10&ndd=HUAWEI Noroeste&anio=2013" target="grafica">Noroeste</a></li>
												<li><a href="tabla_proveedores.php?d=01&ndd=HUAWEI Norte&anio=2013" target="grafica">Norte</a></li>
												<li><a href="tabla_proveedores.php?d=25&ndd=HUAWEI Sur&anio=2013" target="grafica">Sur</a></li>
												<li><a href="tabla_proveedores.php?d=17&ndd=HUAWEI Telnor&anio=2013" target="grafica">Telnor</a></li>
											</ul>
										</li>
										<li>
											<a>Larga Distancia</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=60&ndd=HUAWEI SORD Norte&anio=2013" target="grafica">SORD Norte</a></li>
												<li><a href="tabla_proveedores.php?d=70&ndd=HUAWEI SORD Sur&anio=2013" target="grafica">SORD Sur</a></li>
												<li><a href="tabla_proveedores.php?d=79&ndd=HUAWEI SORD Corp&anio=2013" target="grafica">SORD Corp</a></li>
												<li><a href="tabla_proveedores.php?d=90&ndd=HUAWEI Corporativo&anio=2013" target="grafica">Corporativo</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a href="tabla_proveedores.php?name=PSS&anio=2013" target="grafica">PSS</a>
									<ul>
										<li>
											<a>Local</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=15&name=PSS Centro&anio=2013" target="grafica">Centro</a></li>
												<li><a href="tabla_proveedores.php?d=45&ndd=PSS Metro&anio=2013" target="grafica">Metro</a></li>
												<li><a href="tabla_proveedores.php?d=10&ndd=PSS Noroeste&anio=2013" target="grafica">Noroeste</a></li>
												<li><a href="tabla_proveedores.php?d=01&ndd=PSS Norte&anio=2013" target="grafica">Norte</a></li>
												<li><a href="tabla_proveedores.php?d=25&ndd=PSS Sur&anio=2013" target="grafica">Sur</a></li>
												<li><a href="tabla_proveedores.php?d=17&ndd=PSS Telnor&anio=2013" target="grafica">Telnor</a></li>
											</ul>
										</li>
										<li>
											<a>Larga Distancia</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=79&ndd=PSS SORD Corp&anio=2013" target="grafica">SORD Corp</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a href="tabla_proveedores.php?name=CISCO&anio=2013" target="grafica">CISCO</a>
									<ul>
										<li>
											<a>Local</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=15&name=CISCO Centro&anio=2013" target="grafica">Centro</a></li>
												<li><a href="tabla_proveedores.php?d=45&ndd=CISCO Metro&anio=2013" target="grafica">Metro</a></li>
												<li><a href="tabla_proveedores.php?d=01&ndd=CISCO Norte&anio=2013" target="grafica">Norte</a></li>
												<li><a href="tabla_proveedores.php?d=25&ndd=CISCO Sur&anio=2013" target="grafica">Sur</a></li>
												<li><a href="tabla_proveedores.php?d=17&ndd=CISCO Telnor&anio=2013" target="grafica">Telnor</a></li>
											</ul>
										</li>
										<li>
											<a>Larga Distancia</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=60&ndd=CISCO SORD Norte&anio=2013" target="grafica">SORD Norte</a></li>
												<li><a href="tabla_proveedores.php?d=70&ndd=CISCO SORD Sur&anio=2013" target="grafica">SORD Sur</a></li>
												<li><a href="tabla_proveedores.php?d=79&ndd=CISCO SORD Corp&anio=2013" target="grafica">SORD Corp</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a href="tabla_proveedores.php?name=CIENA&anio=2013" target="grafica">CIENA</a>
									<ul>
										<li>
											<a>Local</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=15&name=CIENA Centro&anio=2013" target="grafica">Centro</a></li>
												<li><a href="tabla_proveedores.php?d=45&ndd=CIENA Metro&anio=2013" target="grafica">Metro</a></li>
												<li><a href="tabla_proveedores.php?d=01&ndd=CIENA Norte&anio=2013" target="grafica">Norte</a></li>
												<li><a href="tabla_proveedores.php?d=25&ndd=CIENA Sur&anio=2013" target="grafica">Sur</a></li>
												<li><a href="tabla_proveedores.php?d=17&ndd=CIENA Telnor&anio=2013" target="grafica">Telnor</a></li>
											</ul>
										</li>
										<li>
											<a>Larga Distancia</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=60&ndd=CIENA SORD Norte&anio=2013" target="grafica">SORD Norte</a></li>
												<li><a href="tabla_proveedores.php?d=70&ndd=CIENA SORD Sur&anio=2013" target="grafica">SORD Sur</a></li>
												<li><a href="tabla_proveedores.php?d=79&ndd=CIENA SORD Corp&anio=2013" target="grafica">SORD Corp</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a href="tabla_proveedores.php?name=NEC&anio=2013" target="grafica">NEC</a>
									<ul>
										<li>
											<a>Local</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=15&name=NEC Centro&anio=2013" target="grafica">Centro</a></li>
												<li><a href="tabla_proveedores.php?d=45&ndd=NEC Metro&anio=2013" target="grafica">Metro</a></li>
												<li><a href="tabla_proveedores.php?d=10&ndd=NEC Noroeste&anio=2013" target="grafica">Noroeste</a></li>
												<li><a href="tabla_proveedores.php?d=01&ndd=NEC Norte&anio=2013" target="grafica">Norte</a></li>
												<li><a href="tabla_proveedores.php?d=25&ndd=NEC Sur&anio=2013" target="grafica">Sur</a></li>
												<li><a href="tabla_proveedores.php?d=17&ndd=NEC Telnor&anio=2013" target="grafica">Telnor</a></li>
											</ul>
										</li>
										<li>
											<a>Larga Distancia</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=60&ndd=NEC SORD Norte&anio=2013" target="grafica">SORD Norte</a></li>
												<li><a href="tabla_proveedores.php?d=70&ndd=NEC SORD Sur&anio=2013" target="grafica">SORD Sur</a></li>
												<li><a href="tabla_proveedores.php?d=79&ndd=NEC SORD Corp&anio=2013" target="grafica">SORD Corp</a></li>
												<li><a href="tabla_proveedores.php?d=90&ndd=NEC Corporativo&anio=2013" target="grafica">Corporativo</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a href="tabla_proveedores.php?name=TALKPOOL&anio=2013" target="grafica">TALKPOOL</a>
									<ul>
										<li>
											<a>Local</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=15&name=TALKPOOL Centro&anio=2013" target="grafica">Centro</a></li>
												<li><a href="tabla_proveedores.php?d=45&ndd=TALKPOOL Metro&anio=2013" target="grafica">Metro</a></li>
												<li><a href="tabla_proveedores.php?d=10&ndd=TALKPOOL Noroeste&anio=2013" target="grafica">Noroeste</a></li>
												<li><a href="tabla_proveedores.php?d=01&ndd=TALKPOOL Norte&anio=2013" target="grafica">Norte</a></li>
												<li><a href="tabla_proveedores.php?d=25&ndd=TALKPOOL Sur&anio=2013" target="grafica">Sur</a></li>
												<li><a href="tabla_proveedores.php?d=17&ndd=TALKPOOL Telnor&anio=2013" target="grafica">Telnor</a></li>
											</ul>
										</li>
										<li>
											<a>Larga Distancia</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=60&ndd=TALKPOOL SORD Norte&anio=2013" target="grafica">SORD Norte</a></li>
												<li><a href="tabla_proveedores.php?d=70&ndd=TALKPOOL SORD Sur&anio=2013" target="grafica">SORD Sur</a></li>
												<li><a href="tabla_proveedores.php?d=79&ndd=TALKPOOL SORD Corp&anio=2013" target="grafica">SORD Corp</a></li>
												<li><a href="tabla_proveedores.php?d=90&ndd=TALKPOOL Corporativo&anio=2013" target="grafica">Corporativo</a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a href="tabla_proveedores.php?name=TYCO-ADC&anio=2013" target="grafica">TYCO-ADC</a>
									<ul>
										<li>
											<a>Local</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=15&name=TYCO-ADC Centro&anio=2013" target="grafica">Centro</a></li>
												<li><a href="tabla_proveedores.php?d=45&ndd=TYCO-ADC Metro&anio=2013" target="grafica">Metro</a></li>
												<li><a href="tabla_proveedores.php?d=10&ndd=TYCO-ADC Noroeste&anio=2013" target="grafica">Noroeste</a></li>
												<li><a href="tabla_proveedores.php?d=01&ndd=TYCO-ADC Norte&anio=2013" target="grafica">Norte</a></li>
												<li><a href="tabla_proveedores.php?d=25&ndd=TYCO-ADC Sur&anio=2013" target="grafica">Sur</a></li>
												<li><a href="tabla_proveedores.php?d=17&ndd=TYCO-ADC Telnor&anio=2013" target="grafica">Telnor</a></li>
											</ul>
										</li>
										<li>
											<a>Larga Distancia</a>
											<ul>
												<li><a href="tabla_proveedores.php?d=60&ndd=TYCO-ADC SORD Norte&anio=2013" target="grafica">SORD Norte</a></li>
												<li><a href="tabla_proveedores.php?d=70&ndd=TYCO-ADC SORD Sur&anio=2013" target="grafica">SORD Sur</a></li>
												<li><a href="tabla_proveedores.php?d=79&ndd=TYCO-ADC SORD Corp&anio=2013" target="grafica">SORD Corp</a></li>
											</ul>
										</li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</body>
</html>
