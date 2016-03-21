<?php
    session_start();
    include '../perfiles.php';
    include 'enlaces.php';
    require 'functions/conexion.php';
    require 'functions/saver.php';
    require 'functions/tildeReplace.php';
    include 'classes/Conn.php';
    include 'classes/Observaciones.php';
 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Programar de Instalaci&oacute;n Site Survey</title>
        <link rel="stylesheet" href="css/winone.css" type="text/css"/>
        <link rel="stylesheet" href="css/header.css" type="text/css"/>
        <link rel="stylesheet" href="css/cupertino/jquery-ui-1.10.3.custom.min.css" type="text/css"/>
        <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
        <link rel="stylesheet" href="css/jquery.timepicker.css" type="text/css"/>
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="js/jquery.validationEngine.js"></script>
        <script src="js/jquery.validationEngine-es.js"></script>
        <script src="js/jquery.timepicker.min.js"></script>
        <script src="js/startw1.js"></script>
        <!--[if IE]>
        <link rel="stylesheet" href="css/iessv2w1.css" type="text/css"/>
        <![endif]-->
    </head>
    <body>
        <div id="header">
            <h1><a href="<?php echo $ventana1; ?>">F R I D A</a></h1>
            <h2>Programación de Site Survey</h2>
        </div>
	<?php
        
        $registros = datosusuario($_SESSION['usr']);
        if(!isset($_POST['division']))
        {
        ?>
        <div id="container">
            <form id="winone" name="winone" method="post" action="ventana1.php">
                <input type="hidden" name="usr" value="<?php echo $_SESSION['usr']; ?>"/>
                <input type="hidden" name="noisivid" value="<?php echo $_SESSION['dirdiv']; ?>"/>
                <fieldset id="infgen">
                    <legend>Informaci&oacute;n General</legend>
                    <label>Plan: <span class="x">*</span></label>
                    <select id="plan" name="plan">
                        <option value="">Seleccionar</option>
                        <option value="Plan FTTH">Plan Broad Band FTTH</option>
                        <option value="Plan VDSL 2014 F1">Plan Broad Band VDSL</option>
                        <option value="Plan 2015">Plan 2015</option>
                    </select>
                    <br/><div style="clear:both"></div>
                    <label>Divisi&oacute;n<span class="x">*</span></label>
                    <select id="division" name="division" class="validate[required]">
                        <option value>Seleccionar</option>
                    </select>
                    <br/><div style="clear:both"></div>
                    <label>Central<span class="x">*</span></label>
                    <select id="central" name="central" class="validate[required]"></select>
                </fieldset>
                <fieldset id="datos">
                    <legend>Datos del Sitio</legend>
                    <label class="large">Nombre del Sitio</label><input type="text" class="des" id="nsitio" name="nsitio" readonly/>
                    <label class="large">Siglas</label><input type="text" class="des" id="siglas" name="siglas" readonly/>
                    <label class="large">&Aacute;rea</label><input type="text" class="des" id="area" name="area" readonly/>
                    <label class="large">CLLI de Central</label><input type="text" class="des" id="clli" name="clli" readonly/>
                    <label class="large">Calle</label><input type="text" id="calle" class="des" name="calle" readonly/>
                    <label class="large">N&uacute;mero</label><input type="text" class="des" id="numero" name="numero" readonly/>
                    <label class="large">Localidad</label><input type="text" class="des" id="localidad" name="localidad" readonly/>
                    <label class="large">Ciudad</label><input type="text" class="des" id="ciudad" name="ciudad" readonly/>
                    <label class="large">Estado</label><input type="text" class="des" id="estado" name="estado" readonly/>
                    <label class="large">C&oacute;digo Postal</label><input type="text" class="des" id="cp" name="cp" readonly/>
                    <label class="large">Latitud</label><input type="text" id="latitud" class="des" name="latitud" readonly/>
                    <label class="large">Longitud</label><input type="text" id="longitud" class="des" name="longitud" readonly/>
                </fieldset>
                <h3>Participantes</h3>
                <ul class="contc">
                    <li class="b">Responsable</li>
                    <li class="b">Nombre<span class="x">*</span></li>
                    <li class="b">E-mail<span class="x">*</span></li>
					<li class="b">Tel&eacute;fono</li>
                    <li class="b">Movil</li>
                    <li>Proyecto</li>
                    <li><input type="text" class="validate[required] text" name="notelmex" size="30"/></li>
					<li><input type="text" class="validate[required,custom[email]] text" name="mailtelmex" size="25"/></li>
                    <li><input type="text" class="validate[custom[phone]] text" name="teltelmex" maxlength="10" size="10"/></li>
                    <li><input type="text" class="validate[custom[phone]] text" name="celtelmex" maxlength="10" size="10"/></li>
                    <li class = "c-metro">Construcci&oacute;n</li>
                    <li class = "c-metro"><input type="text" class="validate[required] text" name="noconst" size="30"/></li>
                    <li class = "c-metro"><input type="text" class="validate[required,custom[email]] text" name="mailconst" size="25"/></li>
                    <li class = "c-metro"><input type="text" class="validate[custom[phone]] text" name="telconst" maxlength="10" size="10"/></li>
                    <li class = "c-metro"><input type="text" class="validate[custom[phone]] text" name="celconst" maxlength="10" size="10"/></li>
                    <li>ICRA</li>
                    <li><input type="text" class="validate" name="noicra" size="30"/></li>
                    <li><input type="text" class="validate[custom[email]] text" name="mailicra" size="25"/></li>
                    <li><input type="text" class="validate[custom[phone]] text" name="telicra" maxlength="10" size="10"/></li>
                    <li><input type="text" class="validate[custom[phone]] text" name="celicra" maxlength="10" size="10"/></li>
                    <li>Operación Y Mantto</li>
                    <li><input type="text" class="validate[required] text" name="noresitio" size="30"/></li>
					<li><input type="text" class="validate[required,custom[email]] text" name="mailresitio" size="25"/></li>
                    <li><input type="text" class="validate[custom[phone]] text" name="telresitio" maxlength="10" size="10"/></li>
                    <li><input type="text" class="validate[custom[phone]] text" name="celresitio" maxlength="10" size="10"/></li>
                    <li>Proveedor Equipo</li>
                    <li><input type="text" class="validate[required] text" name="noprov" size="30"/></li>
					<li><input type="text" class="validate[required,custom[email]] text" name="mailprov" size="25"/></li>
                    <li><input type="text" class="validate[custom[phone]] text" name="telprov" maxlength="10" size="10"/></li>
                    <li><input type="text" class="validate[custom[phone]] text" name="celprov" maxlength="10" size="10"/></li>
					<li>Proveedor Infraestructura</li>
                    <li><select name ="noprov_i" id = "noprov_i" class="validate"></select></li>
					<li><input type="text" class="validate[custom[email]] text" name="mailprov_i" size="25"/></li>
                    <li><input type="text" class="validate[custom[phone]] text" name="telprov_i" maxlength="10" size="10"/></li>
                    <li><input type="text" class="validate[custom[phone]] text" name="celprov_i" maxlength="10" size="10"/></li>
                    <li>Proveedor Infraestructura FO</li>
                    <li><select name ="noprov_ifo" id = "noprov_ifo" class="validate"></select></li>
                    <li><input type="text" class="validate[custom[email]] text" name="mailprov_ifo" size="25"/></li>
                    <li><input type="text" class="validate[custom[phone]] text" name="telprov_ifo" maxlength="10" size="10"/></li>
                    <li><input type="text" class="validate[custom[phone]] text" name="celprov_ifo" maxlength="10" size="10"/></li>
                </ul>           
                <div style="clear:both"></div>
                <div id="ctcnt"> 
                    <fieldset class="contact">
                        <legend class="hf">Fecha y Hora Propuesta</legend>
                        <label style="width:121px">Fecha Propuesta</label><!-- class="validate[required,custom[date]]" -->
                        <input style="margin-left:40px" type="text" id="datepicker" name="fecha_solicitud"/>
                    </fieldset>
                    <fieldset class="contact">
                        <legend class="hf">&nbsp;</legend>
                        <label style="width:121px">Hora Propuesta</label><!-- class="validate[required,custom[date]]" -->
                        <input style="margin-left:40px" type="text" id="timepicker" name="hora_solicitud"/>
                    </fieldset>
                </div>
                <fieldset class="pr">
                    <legend>Punto de Reuni&oacute;n</legend>
                    <textarea name="lugar" id="lugar"></textarea>
                </fieldset>
                <fieldset>
                    <legend>Enviar correo electr&oacute;nico con copia a:</legend>
                    <button id="agregar">Agregar Correo</button>
                    <div style="clear: both"></div>
                    <div id="campos">
                        <ul></ul>
                        <input type="hidden" id="emalis" name="emalis" value="0"/>
                        <input type="hidden" id="noemalis" name="noemalis" value=""/>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Datos Siatel</legend>
                    <label class="large">Elemento PEP  de Equipo<span class="x">*</span></label><input type="text" id="pep" name="pep" class="validate[required,custom[pep]]"/>
                </fieldset>                    
                <fieldset> 
                    <label class="large">Pedido <span class="x">*</span></label>
                    <input type="text" id="pedido" name="pedido" class="validate[required,custom[pedido]]"/>
                    <button id="agregarPedido">Agregar Pedido</button>  
                    <div style="clear: both"></div>
                    <div id="camposPedido">
                        <ul></ul>    

                    <input type="hidden" id="pedidos" name="pedidos" value="0"/>
                    <input type="hidden" id="nopedidos" name="nopedidos" value=""/>             

                    </div>
                </fieldset>
                <fieldset id="tss" style="display:none">
                    <legend>Tipo de Site Survey</legend>
                    <label>Asociado a equipo nuevo o ampliaci&oacute;n<span class="x">*</span></label><input type="radio" name="tipo_ss" value="N" checked="checked"/>
                    <div style="clear: both"></div>
                    <label>Adecuaciones de sala sin equipo asociado<span class="x">*</span></label><input type="radio" name="tipo_ss" value="A"/>
                </fieldset>
                <fieldset class="nu">
                    <legend>Repisa Nueva</legend>
                    <div class="two">
                        <label>Rubro:<span class="x">*</span></label>
                        <select id="rubro" name="rubro" class = "validate[required]" disabled>
                            <option value="">Seleccionar</option>
                            <option value="ACCESO">ACCESO</option>
                            <option value="TRANSPORTE">TRANSPORTE</option>
                            <option value="PROCESAMIENTO">PROCESAMIENTO</option>
                        </select>
                    </div>
                    <div class="two">
                        <label>Equipos a instalar: <span class="x">*</span></label>
                        <select id="noequipos" name="noequipos" class = "validate[required]" disabled><option value="">Seleccionar</option></select>
                    </div>
                    <div class="two">
                        <label>Proveedor: <span class="x">*</span></label>
                        <select id="proveedor" name="proveedor" class = "validate[required]"  disabled></select>
                    </div>
                    <div class="two">
                        <label>Tecnologia: <span class="x">*</span></label>
                        <select id="tecnologia" name="tecnologia"class = "validate[required]"  disabled></select>
                    </div>
                </fieldset>
                <input type="submit" id="enviar" name="enviar" value="Enviar Solicitud"/>
            </form>
            <script>
             /*$("#winone").validationEngine('attach',{
                    onValidationComplete: function(form, status){
                        if(status){
                            $('#enviar').attr('disabled','disabled');
                            //$('#enviar').val('Enviando solicitud');
                            //$("#winone").submit();
                            return true;
                        }
                    }
                });*/
            </script>
        </div>
        <?php
        }
        else{
            print_r($_POST);
            $rubro; $tecnologia; $ubicacion;
            $ct = 0;
            
            //$total = trim($_POST['ttl']);
            
            //INF GENERAL
            $division = trim($_POST['division']);
            //$area = trim($_POST['area']);
            $central = trim($_POST['central']);
            $central = (int)$central;
            $rubro = trim($_POST['rubro']);
            $plan = trim($_POST['plan']);
            
            //DATOS DEL SITIO
//            $nsitio = trim($_POST['nsitio']);
//            $clli = trim($_POST['clli']);
//            $calle = trim($_POST['calle']);
//            $numero = trim($_POST['numero']);
//            $localidad = trim($_POST['localidad']);
//            $ciudad = trim($_POST['ciudad']);
//            $estado = trim($_POST['estado']);
//            $cp = trim($_POST['cp']);
//            $latitud = trim($_POST['latitud']);
//            $longitud = trim($_POST['longitud']);
            $ctnombre = trim(tildeReplace($_POST['notelmex']));
            $cttelefono = trim($_POST['teltelmex']);
            $ctemail = trim($_POST['mailtelmex']);
            $ctmovil = trim($_POST['celtelmex']);
            
            $rsnombre = trim(tildeReplace($_POST['noresitio']));
            $rstelefono = trim($_POST['telresitio']);
            $rsemail = trim($_POST['mailresitio']);
            $rsmovil = trim($_POST['celresitio']);
            
            $cpnombre = trim(tildeReplace($_POST['noprov']));
            $cptelefono = trim($_POST['telprov']);
            $cpemail = trim($_POST['mailprov']);
            $cpmovil = trim($_POST['celprov']);
			
			$cpinombre = trim(tildeReplace($_POST['noprov_i']));
            $cpitelefono = trim($_POST['telprov_i']);
            $cpiemail = trim($_POST['mailprov_i']);
            $cpimovil = trim($_POST['celprov_i']);

            $cpifonombre = trim(tildeReplace($_POST['noprov_ifo']));
            $cpifotelefono = trim($_POST['telprov_ifo']);
            $cpifoemail = trim($_POST['mailprov_ifo']);
            $cpifomovil = trim($_POST['celprov_ifo']);

            #ICRA -CONSTRUCCION
            $cicranombre = trim(tildeReplace($_POST['noicra']));
            $cicratelefono = trim($_POST['telicra']);
            $cicraemail = trim($_POST['mailicra']);
            $cicramovil = trim($_POST['celicra']);

            $cconnombre = trim(tildeReplace($_POST['noconst']));
            $ccontelefono = trim($_POST['telconst']);
            $cconemail = trim($_POST['mailconst']);
            $cconmovil = trim($_POST['celconst']);



            
            $fecha_programada = trim($_POST['fecha_solicitud']);
            $fecha_programada .= ' '.trim($_POST['hora_solicitud']);
            $pep    = trim($_POST['pep']);
            $pedido = trim($_POST['pedido']);
            $noequipos = trim($_POST['noequipos']);
            $proveedor = trim($_POST['proveedor']);
            //$tecnologia = trim($_POST['tecnologia']);
            //$rubro = trim($_POST['rubro']);
            //EMAILS CON COPIA
            $ccemails = trim($_POST['emalis']);
            //$noccemails = trim($_POST['noemalis']);
            //$del = explode('|', $noccemails);
            $punto_reunion = trim(tildeReplace($_POST['lugar']));
            $usr = $_POST['usr'];
            $counter = 0;
            $cc = array();
            $nombres = array();
            //echo $ccemails;
            for($d = 1; $d <= $ccemails; $d++){
                if(($_POST['campo'.$d]) != null || ($_POST['campo'.$d]) != '' ){
                    $cc[$counter] = trim($_POST['campo'.$d]);
                    $nombres[$counter] = trim(tildeReplace($_POST['nombre'.$d]));
                    $counter++;
                }
            }
            //print_r($cc);
            //EMAILS QUE NO DEBEN RECOGERSE
            
            //TIPO DE SITE SURVEY
            $tipoSiteSurvey = $_POST['tipo_ss'];
//            if($tipoSiteSurvey == 0){
//                if($rubro == 'TRANSPORTE'){
//                    for($i = 1; $i <= $noequipos; $i++){
//                        $modelos[$ct] = trim($_POST['modelo'.$i]);
//                        $ct++;
//                    }
//                }
//            }
            
            //DATOS DE CADA EQUIPO
//            for($i = 1; $i <= $noequipos; $i++){
//                $modelos[$ct] = trim($_POST['modelo'.$i]);
//                $ct++;
//            }            
            
            $folio = genfolio($division);
            $nrubro = $rubro == 'TRANSPORTE' ? 1 : $rubro == 'PROCESAMIENTO' ? 2 : 0;
            $modelo = $nrubro == 0 ? $_POST['modelo'] : modeloTransporte($_POST['tecnologia']);


            #Array para validar pedidos
            $numpedido  = array();
            $contpedido = $_POST['pedidos'];
            for($h = 1; $hd <= $contpedido; $h++){
                if(($_POST['pedido'.$h]) != null || ($_POST['pedido'.$h]) != '' ){
                    $numpedido[$counter] = trim($_POST['pedido'.$d]);
                    $counter++;
                }
            }



            //$errorPedido = guardapedido($folio,$pedido,$numpedido);
            //if($errorPedido <> 'OK'){

            //}else{
                guardarss($folio,$tipoSiteSurvey,$plan,$nrubro,$central,$ctnombre,$cttelefono,$ctemail,$ctmovil,$rsnombre,$rstelefono,$rsemail,$rsmovil,$cpnombre,$cptelefono,$cpemail,$cpmovil,$fecha_programada,$punto_reunion,$proveedor,$modelo,$pep,1,$division,$cpinombre,$cpitelefono,$cpimovil,$cpiemail,$pedido,$cpifonombre,$cpifotelefono,$cpifoemail,$cpifomovil,$cicranombre,$cicratelefono,$cicraemail,$cicramovil,$cconnombre,$ccontelefono,$cconemail,$cconmovil);
            //}

            guardaemails($folio,$nombres,$cc);
            
            if($tipoSiteSurvey == 0){
                if($rubro == 'TRANSPORTE' || $rubro == 'PROCESAMIENTO'){
                    for($i = 1; $i <= $noequipos; $i++){
                        $modelos[$ct] = trim($_POST['modelo'.$i]);
                        $ct++;
                    }
                    guardareqs($noequipos, $folio, $modelos);
                    sendmail($folio,$central,$noequipos,$ctemail,$rsemail,$cpemail,$cc,$fecha_programada,$modelos);
                }
                else if($rubro == 'ACCESO'){
                    $model = $_POST['modelo'];
                    $matrix = array();
                    $c = 0;
                    for($i = 1; $i <= $noequipos; $i++){
                        $matrix[$c][0] = $_POST['nombreEq'.$i];
                        $matrix[$c][1] = $model;
                        $matrix[$c][2] = $_POST['puertos'.$i];
                        $matrix[$c][3] = $_POST['tarjetas'.$i];
                        $matrix[$c][4] = 'Repisa Nueva';
                        $c++;
                    }
                    guardarEquiposNuevos($matrix,$folio);
                    $id_eq = getId($folio);
                    agregarInterFO($id_eq,$folio,1);
                    $matrix = array();
                    $c = 0;
                    for($i = 1; $i <= $_POST['ttlex']; $i++){
                        $matrix[$c][0] = $_POST['nomEq'.$i];
                        $matrix[$c][1] = obtid($_POST['modeloEq'.$i],$_POST['claseRepEq'.$i],$_POST['cdgTarjetaEq'.$i]);
                        $matrix[$c][2] = $_POST['puertosEq'.$i];
                        $matrix[$c][3] = $_POST['tarjetasEq'.$i];
                        $matrix[$c][4] = 'Tarjetas Nuevas';
                        $c++;
                    }
                    for($i = 1; $i <= $_POST['ttlrt']; $i++){
                        $matrix[$c][0] = $_POST['nomQe'.$i];
                        $matrix[$c][1] = obtid($_POST['modeloQe'.$i],$_POST['claseRepQe'.$i],$_POST['cdgTarjetaQe'.$i]);
                        $matrix[$c][2] = $_POST['puertosQe'.$i];
                        $matrix[$c][3] = $_POST['tarjetasQe'.$i];
                        $matrix[$c][4] = 'Remplazo de tarjetas';
                        $c++;
                    }
                    guardarEquiposExistentes($matrix, $folio);
                    correoAcceso($folio);
                }
                $id_equipo = getId($folio);
                if($rubro == 'TRANSPORTE' || $rubro == 'PROCESAMIENTO'){
                    agregarInterFO($id_equipo,$folio,1);
                }
                //agregarInterFO_B($folio); EN CASO NECESARIO BORRAR EL IF DE ARRIBA Y DESCOMENTAR ESTA LINEA
                agregarInterFO($id_equipo,$folio,0);
                //agregarMP($folio);
                agregarCX($id_equipo,$folio);
                agregarGS($id_equipo,$folio,0);
                agregarGS($id_equipo,$folio,1);
                agregarFZ($id_equipo,$folio,0);
                agregarFZ($id_equipo,$folio,1);
                inicializarCanaletas($folio);
            }
            $ob = new Observaciones($folio,0,$usr);
            echo '<h2>';
            echo 'Su folio es <br/><span style="color:#00f">'.$folio.'</span><br/> guardelo, pues es importante para poder continuar con el proceso';
            echo '</h2>';
        }
            //echo dsitio('SUR-ACAPULCO-4O2');
        ?>
    </body>
</html>
