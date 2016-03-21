<?php 
    session_start();
    include '../perfiles.php';
    require 'functions/interconexiones.php';
    require 'functions/saver.php';
	$atras='javascript:window.history.back(1);';
	@$folio=isset($_POST['folio'])?$_POST['folio']:$_GET['folio'];
        $tipoValidacion;
        $bandera = 0;
    if(!isset($_POST['folio']) and !isset($_GET['folio']) ){
        header('Location: index.php');
    }
    else{
        $folio = trim(strtoupper($folio));
        $_SESSION['folio'] = $folio;
        $numeq = maxeq($folio);
        $datos = cabecera($folio,0);
        $modelos = modelos($folio);
        if(tipoSiteSurvey($folio) == 'A'){
            header('Location: adecuacion.php');
        }
    else if(isset($_REQUEST['tv'])){
        $tipoValidacion = $_REQUEST['tv'];
        if($tipoValidacion == 1 && $datos[17] != 'POR VALIDAR'){
            //header('Location: grid_surveys.php');
            $bandera = 1;
        }
        else if($tipoValidacion == 2 && $datos[17] != 'VALIDADO OPERACION'){
            //header('Location: grid_surveys.php');
            $bandera = 1;
        }
        else if($tipoValidacion == 2 && $datos[17] == 'VALIDADO OPERACION'){
            //header('Location: grid_surveys.php');
            $bandera = 2;
        }
    }
    else if(!isset($_REQUEST['tv']) && $datos[17] == 'POR VALIDAR' || $datos[17] == 'VALIDADO OPERACION'){
        //header('Location: grid_surveys.php');
        $bandera = 1;
    }
    //$numeros = numbers();
    $numeros = '<option value="0101">0101</option><option value="0102">0102</option>';
    $files = getfiles($folio);
    if($datos[6] != ''){
        $datos[6] = datetransform($datos[6]);
    }
    if($datos[7] != ''){
        $dateExec = datetransform($datos[7]);
    }
    if($datos[8] != ''){
        $datos[8] = datetransform($datos[8]);
    }
    $colspan = $datos[15] == 'TRANSPORTE' ? 5 : 7;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="pragma" content="no-cache">
        <title>Formato de captura SiteSurvey</title>
        <link rel="stylesheet" href="css/ssv2nu.css" type="text/css"/>
        <link rel="stylesheet" href="css/header.css" type="text/css"/>
        <link href="css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/datepicker.css" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="shadowbox/shadowbox.css">
        <script type="text/javascript" src="shadowbox/shadowbox.js"></script>
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/jqueryuiall/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="js/AjaxUpload.2.0.min.js"></script>
        <script src="js/start.js"></script>
        <script src="js/validator.js"></script>
        <script src='js/css_browser_selector.js'></script>
        <script type="text/javascript">
            $(function(){
                $(document).tooltip();
            });
            Shadowbox.init({
                continuous:false
            });
        </script>
        <!--[if IE]>
        <link rel="stylesheet" href="css/iessv2.css" type="text/css"/>
        <![endif]-->
    </head>
    <body>
        <div id="descripcion" class="ventana">
            <label>Agregar descripci&oacute;n</label>
            <textarea name="dscr" id="dscr"></textarea>
            <button id="adddscr" name="adddscr">Agregar</button>
        </div>
        <div id="header">
            <h1><a href="<?php echo $atras?>">F R I D A</a></h1>
            <h2>Formato De Captura Site Survey</h2>
        </div>
        <form name="guardar" id="guardar" method="post" action="guardar.php">
            <div id="ejecucion" class="ventana">
                <label>Fecha de ejecuci&oacute;n</label>
                <input type="text" id="datepicker" name="execute_date"/>
                <input type="submit" name="enviara" id="enviara" value="Subir fecha"/>
            </div>
            <div id="rechazo" class="ventana">
                <label>Causa de rechazo</label>
                <textarea name="causa_rechazo" id="causa_rechazo"></textarea>
                <button id="send" name="send">Rechazar Site Survey</button>
            </div>
            <div id="bitacora" class="ventana">
                <div class="ctable"></div>
                <label>Observaciones</label>
                <textarea name="txt_bitacota" id="txt_bitacora"></textarea>
                <button id="sendBit" name="sendBit">Actualizar Bitacora</button>
            </div>
        <div id="main">
            <button id="exportPDF" name="exportPDF">Exportar</button>
            <button id="openBit" name="openBit">Bit&aacute;cota</button>
            <div class="clear"></div>
            <table>
                <tr>
                    <th colspan="6">DATOS GENERALES</th>
                </tr>
                <tr>
                    <td class="h" rowspan="4" style="width:200px"><img src="img/logo.png" alt="TELMEX"/></td>
                    <td class="t">DD</td>
                    <td class="t">&Aacute;REA</td>
                    <td class="t">CENTRAL</td>
                    <td class="t" style="width:9%">SIGLAS</td>
                    <td class="h" rowspan="4" style="width:16%"><?php echo '<b style="color:#f00;font-size:17px">'.$folio.'</b><br/><br/><div id="'.$datos[17].'" class="estatus">'.$datos[17].'</div>' ?></td>
                </tr>
                <tr>
                    <td class="h"><?php echo $datos[0] ?></td>
                    <td class="h"><?php echo $datos[1] ?></td>
                    <td class="h"><?php echo $datos[3] ?></td>
                    <td class="h"><?php echo $datos[2] ?></td>
                </tr>
                <tr>
                    <td class="t">RUBRO</td>
                    <td class="t">TECNOLOGIA</td>
                    <td class="t" colspan="2">PROVEEDOR</td>
                </tr>
                <tr>
                    <td class="h"><?php echo $datos[15] ?></td>
                    <td class="h"><?php echo $datos[18] ?></td>
                    <td class="h" colspan="2"><?php echo $datos[16] ?></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td class="t">FECHA DE SOLICITUD</td>
                    <td class="t">FECHA PROGRAMADA</td>
                    <td class="t">FECHA DE CAPTURA</td>
                    <td class="t">FECHA DE EJECUCI&Oacute;N</td>
                    <td class="t">FECHA DE VALIDACI&Oacute;N</td>
                </tr>
                <tr>
                    <td class="h"><?php echo datetransform($datos[4]) ?></td>
                    <td class="h"><?php echo datetransform($datos[5]) ?></td>
                    <td class="h"><?php echo $datos[6] ?></td>
                    <td class="h"><?php echo $dateExec ?></td>
                    <td class="h"><?php echo $datos[8] ?></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td class="t">ROL</td>
                    <td class="t">NOMBRE</td>
                    <td class="t">TEL&Eacute;FONO</td>
                    <td class="t">M&Oacute;VIL</td>
                    <td class="t">CORREO</td>
                </tr>
                <tr>
                    <td>Responsable Proyectos Telmex</td>
                    <td><?php echo $datos[9]?></td>
                    <td><?php echo $datos[10]?></td>
                    <td><?php echo $datos[19]?></td>
                    <td><?php echo $datos[11]?></td>
                </tr>
                <tr>
                    <td>Responsable en Sitio (Operaci&oacute;n)</td>
                    <td><?php echo $datos[21]?></td>
                    <td><?php echo $datos[22]?></td>
                    <td><?php echo $datos[23]?></td>
                    <td><?php echo $datos[24]?></td>
                </tr>
                <tr>
                    <td>Responsable Contacto Proveedor</td>
                    <td><?php echo $datos[12]?></td>
                    <td><?php echo $datos[13]?></td>
                    <td><?php echo $datos[20]?></td>
                    <td><?php echo $datos[14]?></td>
                </tr>
                <tr>
                    <td colspan="5" class="t">DISTRIBUCI&Oacute;N DE COPIAS</td>
                </tr>
                <?php echo copiacorreo($folio) ?>
            </table>
            <table id="email">
                <tr>
                    <td colspan="5" class="t">AGREGAR M&Aacute;S DIRECCIONES DE CORREO ELECTR&Oacute;NICO <div id="addmail">Agregar</div></td>
                </tr>
            </table>
            <div id="tabs">
                <ul>
                    <li><a href="#tabs-1">ESTADO GRAL.<br/>DE SITIO</a></li>
                    <li><a href="#tabs-2">ALTO ORDEN<br/>(&Oacute;PTICO)</a></li>
                    <li><a href="#tabs-3">BAJO ORDEN<br/>(&Oacute;PTICO)</a></li>
                    <li><a href="#tabs-4">BAJO ORDEN<br/>(MULTIPAR)</a></li>
                    <li><a href="#tabs-5">BAJO ORDEN<br/>(COAXIAL)</a></li>
                    <li><a href="#tabs-6">GESTI&Oacute;N Y<br/>SINCRONIA</a></li>
                    <li><a href="#tabs-7">ALIMENTACI&Oacute;N<br/>Y TIERRAS</a></li>
                    <li><a href="#tabs-8">PLANOS<br/>Y FOTOS</a></li>
                </ul>
                <div id="tabs-1">
                    <table>
                        <tr>
                            <th colspan="<?php echo $colspan ?>">UBICACI&Oacute;N DE EQUIPOS</th>
                        </tr>
                        <?php echo ubxeq($folio); ?>
                    </table>
                    
                    <!--C A N A L E T A S   E N   S U   V E R S I Ó N   4-->
                    <ul class="can">
                        <li class="th">CANALETAS / ESCALERILLAS</li>
                        <li class="blu">CABLE</li>
                        <li class="blu">TIPO</li>
                        <li class="blu">NVO. / EXIS.</li>
                        <li class="blu">SATURADO</li>
                        <li class="blu al">ALTURA</li>
                        <li class="blu">LARGO</li>
                        <li class="blu">ANCHO</li>
                        <li class="blu">No. BAJANTES</li>
                        <li class="blu">ANCHO BAJANTES</li>
                        <!--ALTO ORDEN FO-->
                        <li class="sky sfo">FIBRA OPTICA (AO)</li>
                        <li class="sfo">
                            <select name="sfoslc">
                                <option value="0">Seleccionar</option>
                                <option value="1">Aluminio</option>
                                <option value="2">Acero</option>
                                <option value="3">Charola</option>
                                <option value="4">Plastico</option>
                            </select>
                        </li>
                        <li class="sfo">
                            <select name="sfonux">
                                <option value="0">Seleccionar</option>
                                <option value="1">Nuevo</option>
                                <option value="2">Existente</option>
                            </select>
                        </li>
                        <li class="sfo">
                            <select name="sfosat">
                                <option value="0">Seleccionar</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                            </select>
                        </li>
                        <li class="al sfo"><input type="text" name="sfohei" /></li>
                        <li class="sfo"><input type="text" name="sfolen" /></li>
                        <li class="sfo">
                            <select name="sfoinc">
                                <option value="0">Seleccionar</option>
                                <option value="1">2"</option>
                                <option value="2">4"</option>
                                <option value="3">6"</option>
                                <option value="4">9"</option>
                                <option value="5">12"</option>
                                <option value="6">24"</option>
                            </select>
                        </li>
                        <li class="sfo"><input type="text" name="sfodwn" /></li>
                        <li class="sfo">
                            <select name="sfoadw">
                                <option value="0">Seleccionar</option>
                                <option value="1">2"</option>
                                <option value="2">4"</option>
                                <option value="3">6"</option>
                                <option value="4">9"</option>
                                <option value="5">12"</option>
                                <option value="6">24"</option>
                            </select>
                        </li>
                        <!--BAJO ORDEN FO-->
                        <li class="sky mfo">FIBRA OPTICA (BO)</li>
                        <li class="mfo">
                            <select name="mfoslc">
                                <option value="0">Seleccionar</option>
                                <option value="1">Aluminio</option>
                                <option value="2">Acero</option>
                                <option value="3">Charola</option>
                                <option value="4">Plastico</option>
                            </select>
                        </li>
                        <li class="mfo">
                            <select name="mfonux">
                                <option value="0">Seleccionar</option>
                                <option value="1">Nuevo</option>
                                <option value="2">Existente</option>
                            </select>
                        </li>
                        <li class="mfo">
                            <select name="mfosat">
                                <option value="0">Seleccionar</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                            </select>
                        </li>
                        <li class="al mfo"><input type="text" name="mfohei" /></li>
                        <li class="mfo"><input type="text" name="mfolen" /></li>
                        <li class="mfo">
                            <select name="mfoinc">
                                <option value="0">Seleccionar</option>
                                <option value="1">2"</option>
                                <option value="2">4"</option>
                                <option value="3">6"</option>
                                <option value="4">9"</option>
                                <option value="5">12"</option>
                                <option value="6">24"</option>
                            </select>
                        </li>
                        <li class="mfo"><input type="text" name="mfodwn" /></li>
                        <li class="mfo">
                            <select name="mfoadw">
                                <option value="0">Seleccionar</option>
                                <option value="1">2"</option>
                                <option value="2">4"</option>
                                <option value="3">6"</option>
                                <option value="4">9"</option>
                                <option value="5">12"</option>
                                <option value="6">24"</option>
                            </select>
                        </li>
                        <!--MULTIPAR-->
                        <li class="sky mmp">MULTIPAR</li>
                        <li class="mmp">
                            <select name="mmpslc">
                                <option value="0">Seleccionar</option>
                                <option value="1">Aluminio</option>
                                <option value="2">Acero</option>
                                <option value="3">Charola</option>
                                <option value="4">Plastico</option>
                            </select>
                        </li>
                        <li class="mmp">
                            <select name="mmpnux">
                                <option value="0">Seleccionar</option>
                                <option value="1">Nuevo</option>
                                <option value="2">Existente</option>
                            </select>
                        </li>
                        <li class="mmp">
                            <select name="mmpsat">
                                <option value="0">Seleccionar</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                            </select>
                        </li>
                        <li class="al mmp"><input type="text" name="mmphei" /></li>
                        <li class="mmp"><input type="text" name="mmplen" /></li>
                        <li class="mmp">
                            <select name="mmpinc">
                                <option value="0">Seleccionar</option>
                                <option value="1">2"</option>
                                <option value="2">4"</option>
                                <option value="3">6"</option>
                                <option value="4">9"</option>
                                <option value="5">12"</option>
                                <option value="6">24"</option>
                            </select>
                        </li>
                        <li class="mmp"><input type="text" name="mmpdwn" /></li>
                        <li class="mmp">
                            <select name="mmpadw">
                                <option value="0">Seleccionar</option>
                                <option value="1">2"</option>
                                <option value="2">4"</option>
                                <option value="3">6"</option>
                                <option value="4">9"</option>
                                <option value="5">12"</option>
                                <option value="6">24"</option>
                            </select>
                        </li>
                        <!--COAXIAL-->
                        <li class="sky mcx">COAXIAL</li>
                        <li class="mcx">
                            <select name="mcxslc">
                                <option value="0">Seleccionar</option>
                                <option value="1">Aluminio</option>
                                <option value="2">Acero</option>
                                <option value="3">Charola</option>
                                <option value="4">Plastico</option>
                            </select>
                        </li>
                        <li class="mcx">
                            <select name="mcxnux">
                                <option value="0">Seleccionar</option>
                                <option value="1">Nuevo</option>
                                <option value="2">Existente</option>
                            </select>
                        </li>
                        <li class="mcx">
                            <select name="mcxsat">
                                <option value="0">Seleccionar</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                            </select>
                        </li>
                        <li class="al mcx"><input type="text" name="mcxhei" /></li>
                        <li class="mcx"><input type="text" name="mcxlen" /></li>
                        <li class="mcx">
                            <select name="mcxinc">
                                <option value="0">Seleccionar</option>
                                <option value="1">2"</option>
                                <option value="2">4"</option>
                                <option value="3">6"</option>
                                <option value="4">9"</option>
                                <option value="5">12"</option>
                                <option value="6">24"</option>
                            </select>
                        </li>
                        <li class="mcx"><input type="text" name="mcxdwn" /></li>
                        <li class="mcx">
                            <select name="mcxadw">
                                <option value="0">Seleccionar</option>
                                <option value="1">2"</option>
                                <option value="2">4"</option>
                                <option value="3">6"</option>
                                <option value="4">9"</option>
                                <option value="5">12"</option>
                                <option value="6">24"</option>
                            </select>
                        </li>
                        <!--GESTION Y SINCRONIA-->
                        <li class="sky mgs">GESTi&Oacute;N/SINCRON&Iacute;A</li>
                        <li class="mgs">
                            <select name="mgsslc">
                                <option value="0">Seleccionar</option>
                                <option value="1">Aluminio</option>
                                <option value="2">Acero</option>
                                <option value="3">Charola</option>
                                <option value="4">Plastico</option>
                            </select>
                        </li>
                        <li class="mgs">
                            <select name="mgsnux">
                                <option value="0">Seleccionar</option>
                                <option value="1">Nuevo</option>
                                <option value="2">Existente</option>
                            </select>
                        </li>
                        <li class="mgs">
                            <select name="mgssat">
                                <option value="0">Seleccionar</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                            </select>
                        </li>
                        <li class="al mgs"><input type="text" name="mgshei" /></li>
                        <li class="mgs"><input type="text" name="mgslen" /></li>
                        <li class="mgs">
                            <select name="mgsinc">
                                <option value="0">Seleccionar</option>
                                <option value="1">2"</option>
                                <option value="2">4"</option>
                                <option value="3">6"</option>
                                <option value="4">9"</option>
                                <option value="5">12"</option>
                                <option value="6">24"</option>
                            </select>
                        </li>
                        <li class="mgs"><input type="text" name="mgsdwn" /></li>
                        <li class="mgs">
                            <select name="mgsadw">
                                <option value="1">2"</option>
                                <option value="2">4"</option>
                                <option value="3">6"</option>
                                <option value="4">9"</option>
                                <option value="5">12"</option>
                                <option value="6">24"</option>
                            </select>
                        </li>
                        <!--ALIMENTACION Y TIERRAS-->
                        <li class="sky mft">ALIMENTACI&Oacute;N</li>
                        <li class="mft">
                            <select name="mftslc">
                                <option value="0">Seleccionar</option>
                                <option value="1">Aluminio</option>
                                <option value="2">Acero</option>
                                <option value="3">Charola</option>
                                <option value="4">Plastico</option>
                            </select>
                        </li>
                        <li class="mft">
                            <select name="mftnux">
                                <option value="0">Seleccionar</option>
                                <option value="1">Nuevo</option>
                                <option value="2">Existente</option>
                            </select>
                        </li>
                        <li class="mft">
                            <select name="mftsat">
                                <option value="0">Seleccionar</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                            </select>
                        </li>
                        <li class="al mft"><input type="text" name="mfthei" /></li>
                        <li class="mft"><input type="text" name="mftlen" /></li>
                        <li class="mft">
                            <select name="mftinc">
                                <option value="0">Seleccionar</option>
                                <option value="1">2"</option>
                                <option value="2">4"</option>
                                <option value="3">6"</option>
                                <option value="4">9"</option>
                                <option value="5">12"</option>
                                <option value="6">24"</option>
                            </select>
                        </li>
                        <li class="mft"><input type="text" name="mftdwn" /></li>
                        <li class="mft">
                            <select name="mftadw">
                                <option value="0">Seleccionar</option>
                                <option value="1">2"</option>
                                <option value="2">4"</option>
                                <option value="3">6"</option>
                                <option value="4">9"</option>
                                <option value="5">12"</option>
                                <option value="6">24"</option>
                            </select>
                        </li>
                        <li class="th skyb">COMENTARIOS</li>
                        <li class="txt"><textarea name="eg_coment_can" id="eg_coment_can"></textarea></li>
                    </ul>
                    
                    <table>
                <tr><th colspan="3" >ESTADO GENERAL DE SITIO</th></tr>
                <tr><th class="sub" colspan="1" >EDIFICACI&Oacute;N</th></tr>
                <!-- TIPO DE TRABAJO -->
                <tr>
                    <th>TIPO DE TRABAJO</th>
                    <th></th>
                    <th>COMENTARIOS</th>
                </tr>
                <tr>
                    <td>NUEVO</td>
                    <td class="t"><input type="radio" name="tipo_trabajo" value="Nuevo"/></td>
                    <td rowspan="2"><textarea id="eg_tt_coment" name="eg_tt_comt"></textarea></td>
                </tr>
                <tr>
                    <td>AMPLIACI&Oacute;N</td>
                    <td class="t"><input type="radio" name="tipo_trabajo" value="Ampliacion"/></td>
                </tr>
                <!-- TIPO DE CENTRAL -->
                <tr>
                    <th>TIPO DE CENTRAL</th>
                    <th></th>
                    <th>COMENTARIOS</th>
                </tr>
                <tr>
                    <td>GABINETE OUTDOOR</td>
                    <td class="t"><input type="radio" id="9tce1" name="tipo_central" value="Gabinete Outdoor"/></td>
                    <td rowspan="6"><textarea id="eg_tc_coment" name="eg_tc_comt"></textarea></td>
                </tr>
                <tr>
                    <td>CONTENEDOR</td>
                    <td class="t"><input type="radio" id="9tce2" name="tipo_central" value="Contenedor"/></td>
                </tr>
                <tr>
                    <td>CENTRAL</td>
                    <td class="t"><input type="radio" id="9tce3" name="tipo_central" value="Central"/></td>
                </tr>
                <tr>
                    <td>CONCENTRADOR</td>
                    <td class="t"><input type="radio" id="9tce4" name="tipo_central" value="Concentrador"/></td>
                </tr>
                <tr>
                    <td>REPETIDOR</td>
                    <td class="t"><input type="radio" id="9tce5" name="tipo_central" value="Repetidor"/></td>
                </tr>
                <tr>
                    <td>OTRO <input type="text" id="tipo_central_ot" class="other" name="9tceo" value="Especificar..." disabled/></td>
                    <td class="t"><input type="radio" id="9tceo" name="tipo_central" value="Otro"/></td>
                </tr>
                <!-- ESPACIO -->
                <!--<tr>
                    <th>ESPACIO</th>
                    <th></th>
                    <th>COMENTARIOS</th>
                </tr>
                <tr>
                    <td>NUEVO</td>
                    <td class="t"><input type="radio" id="9esp1" name="espacio" value="Nuevo"/></td>
                    <td rowspan="4"><textarea id="eg_es_coment" name="eg_es_comt"></textarea></td>
                </tr>
                <tr>
                    <td>EXISTENTE</td>
                    <td class="t"><input type="radio" id="9esp2" name="espacio" value="Existente"/></td>
                </tr>
                <tr>
                    <td>REQUIERE DESMONTAJE</td>
                    <td class="t"><input type="radio" id="9esp3" name="espacio" value="Requiere Desmontaje"/></td>
                </tr>
                <tr>
                    <td>OTRO <input type="text" id="espacio_ot" class="other" name="9espo" value="Especificar..." disabled/></td>
                    <td class="t"><input type="radio" id="9espo" name="espacio" value="Otro"/></td>
                </tr>-->
                <!-- TIPO DE PISO EN SITIO -->
                <tr>
                    <th>TIPO DE PISO EN EL SITIO</th>
                    <th></th>
                    <th>COMENTARIOS</th>
                </tr>
                <tr>
                    <td>PISO FIRME</td>
                    <td class="t"><input type="radio" id="9tps1" name="tipo_piso" value="Piso Firme"/></td>
                    <td rowspan="4"><textarea id="eg_tp_coment" name="eg_tp_comt"></textarea></td>
                </tr>
                <tr>
                    <td>PISO FALSO</td>
                    <td class="t"><input type="radio" id="9tps2" name="tipo_piso" value="Piso Falso"/></td>
                </tr>
                <tr>
                    <td>PLATAFORMA</td>
                    <td class="t"><input type="radio" id="9tps3" name="tipo_piso" value="Plataforma"/></td>
                </tr>
                <tr>
                    <td>OTRO <input type="text" id="tipo_piso_ot" class="other" name="9tpso" value="Especificar..." disabled/></td>
                    <td class="t"><input type="radio" id="9tpso" name="tipo_piso" value="Otro"/></td>
                </tr>
                <!-- OBRA CIVIL -->
                <tr>
                    <th>OBRA CIVIL</th>
                    <th></th>
                    <th>COMENTARIOS</th>
                </tr>
                <tr>
                    <td>SALA NUEVA</td>
                    <td class="t"><input type="radio" id="9obc1" name="obra_civil" value="Sala Nueva"/></td>
                    <td rowspan="6"><textarea id="eg_oc_coment" name="eg_oc_comt"></textarea></td>
                </tr>
                <tr>
                    <td>FILA NUEVA</td>
                    <td class="t"><input type="radio" id="9obc2" name="obra_civil" value="Fila Nueva"/></td>
                </tr>
                <tr>
                    <td>REQUIERE PASA MUROS</td>
                    <td class="t"><input type="radio" id="9obc3" name="obra_civil" value="Requiere Pasa Muros"/></td>
                </tr>
                <tr>
                    <td>ENTRE PISO</td>
                    <td class="t"><input type="radio" id="9obc4" name="obra_civil" value="Entre Piso"/></td>
                </tr>
                <tr>
                    <td>NINGUNA</td>
                    <td class="t"><input type="radio" id="9obc5" name="obra_civil" value="Ninguna"/></td>
                </tr>
                <tr>
                    <td>OTRO <input type="text" id="obra_civil_ot" class="other" name="9obco" value="Especificar..." disabled/></td>
                    <td class="t"><input type="radio" id="9obco" name="obra_civil" value="Otro"/></td>
                </tr>
                <!--TIPO DE MANIOBRA-->
                <tr>
                    <th>TIPO DE MANIOBRA</th>
                    <th></th>
                    <th>COMENTARIOS</th>
                </tr>
                <tr>
                    <td>POLIPASTO</td>
                    <td class="t"><input type="radio" id="9tmr2" name="tipo_maniobra" value="Polipasto"/></td>
                    <td rowspan="4"><textarea id="eg_tm_coment" name="eg_tm_comt"></textarea></td>
                </tr>
                <tr>
                    <td>POLEAS Y LAZOS</td>
                    <td class="t"><input type="radio" id="9tmr3" name="tipo_maniobra" value="Poleas y lazos"/></td>
                </tr>
                <tr>
                    <td>MANIOBRA SIMPLE</td>
                    <td class="t"><input type="radio" id="9tmr4" name="tipo_maniobra" value="Maniobra simple"/></td>
                </tr>
                <tr>
                    <td>OTRO <input type="text" id="tipo_maniobra_ot" class="other" name="9tmro" value="Especificar..." disabled/></td>
                    <td class="t"><input type="radio" id="9tmro" name="tipo_maniobra" value="Otro"/></td>
                </tr>
            </table>
                </div>
                <div id="tabs-2">
                    <div class="conttwo">
                        <div class="lf">
                            <h2>BASTIDOR DE FIBRAS</h2>
                            <div class="l" id="a1">
                                <table>
                                    <th colspan="2">SE UTILIZAR&Aacute; BASTIDOR DE FIBRAS</th>
                                    <tr>
                                        <td>EXISTENTE</td>
                                        <td class="t"><input type="radio" class="bastidorfo" name="fo_bastidor_fibra" value="Existente"/></td>
                                    </tr>
                                    <tr>
                                        <td>NUEVO</td>
                                        <td class="t"><input type="radio" class="bastidorfo" name="fo_bastidor_fibra" value="Nuevo"/></td>
                                    </tr>
                                </table>
                                <table id="tpesfo">
                                    <tr><th colspan="2">ESPACIO DISPONIBLE</th></tr>
                                    <tr>
                                        <td>SI</td>
                                        <td class="t"><input type="radio" name="fo_bastidor_fibra_espacio" value="Si"/></td>
                                    </tr>
                                    <tr>
                                        <td>NO</td>
                                        <td class="t"><input type="radio" name="fo_bastidor_fibra_espacio" value="No"/></td>
                                    </tr>
                                </table>
                                <table>
                                    <th colspan="2">TIPO DE BASTIDOR DE FIBRAS</th>
                                    <tr>
                                        <td>TRADICIONAL</td>
                                        <td class="t"><input type="radio" id="9fob1" name="fo_tipo_bastidor_fibra" value="Tradicional"/></td>
                                    </tr>
                                    <tr>
                                        <td>ALTA DENSIDAD</td>
                                        <td class="t"><input type="radio" id="9fob2" name="fo_tipo_bastidor_fibra" value="Alta Densidad"/></td>
                                    </tr>
                                    <tr>
                                        <td>MINI DFO</td>
                                        <td class="t"><input type="radio" id="9fob3" name="fo_tipo_bastidor_fibra" value="Mini DFO"/></td>
                                    </tr>
                                    <tr>
                                        <td>OTRO <input id="fo_tipo_bastidor_fibra_ot" type="text" class="other3" name="9fobo" value="Especificar..." disabled/></td>
                                        <td class="t"><input type="radio" id="9fobo" name="fo_tipo_bastidor_fibra" value="Otro"/></td>
                                    </tr>
                                </table>
                                
                            </div>
                            <div class="l" id="a2">
                                <table>
                                    <th colspan="2">MARCA</th>
                                    <tr>
                                        <td>TYCO</td>
                                        <td class="t"><input type="radio" name="fo_bastidor_marca" value="TYCO"/></td>
                                    </tr>
                                    <tr>
                                        <td>ADC</td>
                                        <td class="t"><input type="radio" name="fo_bastidor_marca" value="ADC"/></td>
                                    </tr>
                                </table>
                                <br/>
                                <!--<table>
                                    <th colspan="2">COMBO / BLOQUE DFO</th>
                                    <tr>
                                        <td>EXISTENTE</td>
                                        <td class="t"><input type="radio" name="fo_bloque_dfo" value="Existente"/></td>
                                    </tr>
                                    <tr>
                                        <td>NUEVO</td>
                                        <td class="t"><input type="radio" name="fo_bloque_dfo" value="Nuevo"/></td>
                                    </tr>
                                </table>-->
                            </div>
                            <div style="clear:both"></div>
                            <!--<h2>CANALETAS / ESCALERILLA</h2>
                            <table>
                                <tr>
                                    <th>TIPO DE CANALETA</th>
                                    <th></th>
                                    <th>NUEVO EXISTENTE</th>
                                    <th>ALTURA AL BASTIDOR</th>
                                    <th>LARGO TRAYECTORIA</th>
                                    <th>PULGADAS</th>
                                    <th>BAJANTES REQUERIDAS</th>
                                </tr>
                                <tr>
                                    <td>ALUMINIO</td>
                                    <td><input type="checkbox" name="afok0" value="1"/></td>
                                    <td><select name="afos0" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                    <td><input type="text" class="kz1" name="afohe0" value="" onblur="decimal(this.name,this.value)" disabled/></td>
                                    <td><input type="text" class="kz2" name="afolg0" value="" disabled/></td>
                                    <!--<td><input type="text" class="kz3" name="afoin0" value="" disabled/></td>
                                    <td>
                                        <select name="afoin0" disabled>
                                            <option value="0">0</option>
                                            <option value="4">4</option>
                                            <option value="6">6</option>
                                            <option value="12">12</option>
                                            <option value="24">24</option>
                                            <option value="36">36</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="kz4" name="afodw0" value="" disabled/></td>
                                    <td>
                                        <select name="afodw0" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ACERO</td>
                                    <td><input type="checkbox" name="afok1" value="1"/></td>
                                    <td><select name="afos1" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                    <td><input type="text" class="kz1" name="afohe1" value="" disabled/></td>
                                    <td><input type="text" class="kz2" name="afolg1" value="" disabled/></td>
                                    <td><input type="text" class="kz3" name="afoin1" value="" disabled/></td>
                                    <td>
                                        <select name="afoin1" disabled>
                                            <option value="0">0</option>
                                            <option value="16">16</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="kz4" name="afodw1" value="" disabled/></td>
                                    <td>
                                        <select name="afodw1" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>CHAROLA</td>
                                    <td><input type="checkbox" name="afok2" value="1"/></td>
                                    <td><select name="afos2" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                    <td><input type="text" class="kz1" name="afohe2" value="" disabled/></td>
                                    <td><input type="text" class="kz2" name="afolg2" value="" disabled/></td>
                                    <td><input type="text" class="kz3" name="afoin2" value="" disabled/></td>
                                    <td>
                                        <select name="afoin2" disabled>
                                            <option value="0">0</option>
                                            <option value="8">8</option>
                                            <option value="16">16</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="kz4" name="afodw2" value="" disabled/></td>
                                    <td>
                                        <select name="afodw2" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PL&Aacute;STICA</td>
                                    <td><input type="checkbox" name="afok3" value="1"/></td>
                                    <td><select name="afos3" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                    <td><input type="text" class="kz1" name="afohe3" value="" disabled/></td>
                                    <td><input type="text" class="kz2" name="afolg3" value="" disabled/></td>
                                    <td><input type="text" class="kz3" name="afoin3" value="" disabled/></td>
                                    <td>
                                        <select name="afoin3" disabled>
                                            <option value="0">0</option>
                                            <option value="2">2</option>
                                            <option value="6">6</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="kz4" name="afodw3" value="" disabled/></td>
                                    <td>
                                        <select name="afodw3" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr><th colspan="8">COMENTARIOS</th></tr>
                                <tr>
                                    <td colspan="8"><textarea id="afocm" name="afocm"></textarea></td>
                                </tr>
                            </table>-->
                            <div style="clear:both"></div>
                        </div>
                        <!--<div class="rf">
                            <div class="ct1">
                                <img src="img/ss_img/opticoAO.jpg" alt="BDFO"/>
                            </div>
                            <h3>RACK LAYOUT BDFO</h3>
                        </div>-->
                        <div style="clear:both"></div>
                        <h2>TRASPASOS / REMATES &Oacute;PTICOS</h2>
                            <table id="tbfo"><!--Tabla Fibra Optica-->
                                <tr><th colspan="9">TABLA DE TRASPASOS / REMATES &Oacute;PTICOS (HACIA TX)</th></tr>
                                <tr>
                                    <td class="h" style="width:100px">Equipo / Modelo</td>
                                    <td class="h" style="width:120px">Ubicaci&oacute;n Bastidor Fibras</td>
                                    <td class="h">Posici&oacute;n de Remate</td>
                                    <td class="h">Tipo Conector Equipo</td>
                                    <td class="h" style="width:80px">Tipo De Fibra</td>
                                    <td class="h">Tipo Conector lado DFO</td>
                                    <td class="h" style="width:94px">Bloque DFO</td>
                                    <td class="h">Long. de Jumpers Trayectoria 1</td>
                                    <td class="h">Long. de Jumpers Trayectoria 2</td>
                                </tr>
                                
                             <?php echo intert01($folio,1,$datos[18]) ?>
                            </table>
                        <button name="afointer" style="color:#f00" class="interx" id="afointer" value="xbfo">Eliminar Remate</button>
                        <button name="xfointer" class="interx" id="xfointer" value="tbfo">Agregar Remate</button>
                        <div style="clear:both"></div>
                        <!--<div class="scsa">
                            <h2>Recuadro 1</h2>
                            <!--<h2>Imagen 1</h2>
                            <img src="img/ss_img/photo.jpg" alt="photo"/>
                        </div>
                        <div class="scsa">
                            <h2>Recuadro 2</h2>
                            <h2>Imagen 2</h2>
                            <img src="img/ss_img/photo.jpg" alt="photo"/>
                        </div>
                        <div class="scsa">
                            <h2>Recuadro 3</h2>
                            <h2>Imagen 3</h2>
                            <img src="img/ss_img/photo.jpg" alt="photo"/>
                        </div>-->
                        <div style="clear:both"></div>
                        <div class="comentarios">
                            <table>
                                <tr><th>COMENTARIOS</th></tr>
                                <tr>
                                    <td>
                                        <textarea id="fo_final_coment" name="fo_final_coment"></textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="tabs-3">
                    <div class="conttwo">
                        <div class="lf">
                            <h2>BASTIDOR DE FIBRAS</h2>
                            <div class="l" id="a1">
                                <table>
                                    <th colspan="2">SE UTILIZAR&Aacute; BASTIDOR DE FIBRAS</th>
                                    <tr>
                                        <td>EXISTENTE</td>
                                        <td class="t"><input type="radio" class="bastidordwfo"  name="dwfo_bastidor_fibra" value="Existente"/></td>
                                    </tr>
                                    <tr>
                                        <td>NUEVO</td>
                                        <td class="t"><input type="radio" class="bastidordwfo" name="dwfo_bastidor_fibra" value="Nuevo"/></td>
                                    </tr>
                                </table>
                                <table id="tpesdwfo">
                                    <tr><th colspan="2">ESPACIO DISPONIBLE</th></tr>
                                    <tr>
                                        <td>SI</td>
                                        <td class="t"><input type="radio" name="dwfo_bastidor_fibra_espacio" value="Si"/></td>
                                    </tr>
                                    <tr>
                                        <td>NO</td>
                                        <td class="t"><input type="radio" name="dwfo_bastidor_fibra_espacio" value="No"/></td>
                                    </tr>
                                </table>
                                <table>
                                    <th colspan="2">TIPO DE BASTIDOR DE FIBRAS</th>
                                    <tr>
                                        <td>TRADICIONAL</td>
                                        <td class="t"><input type="radio" id="9dob1" name="dwfo_tipo_bastidor_fibra" value="Tradicional"/></td>
                                    </tr>
                                    <tr>
                                        <td>ALTA DENSIDAD</td>
                                        <td class="t"><input type="radio" id="9dob2" name="dwfo_tipo_bastidor_fibra" value="Alta Densidad"/></td>
                                    </tr>
                                    <tr>
                                        <td>MINI DFO</td>
                                        <td class="t"><input type="radio" id="9dob3" name="dwfo_tipo_bastidor_fibra" value="Mini DFO"/></td>
                                    </tr>
                                    <tr>
                                        <td>OTRO <input type="text" id="dwfo_tipo_bastidor_fibra_ot" class="other3" name="9dobo" value="Especificar..." disabled/></td>
                                        <td class="t"><input type="radio" id="9dobo" name="dwfo_tipo_bastidor_fibra" value="Otro"/></td>
                                    </tr>
                                </table>
                                
                            </div>
                            <div class="l" id="a2">
                                <table>
                                    <th colspan="2">MARCA</th>
                                    <tr>
                                        <td>TYCO</td>
                                        <td class="t"><input type="radio" name="dwfo_bastidor_marca" value="TYCO"/></td>
                                    </tr>
                                    <tr>
                                        <td>ADC</td>
                                        <td class="t"><input type="radio" name="dwfo_bastidor_marca" value="ADC"/></td>
                                    </tr>
                                </table>
                                <br/>
                                <!--<table>
                                    <th colspan="2">COMBO / BLOQUE DFO</th>
                                    <tr>
                                        <td>EXISTENTE</td>
                                        <td class="t"><input type="radio" name="dwfo_bloque_dfo" value="Existente"/></td>
                                    </tr>
                                    <tr>
                                        <td>NUEVO</td>
                                        <td class="t"><input type="radio" name="dwfo_bloque_dfo" value="Nuevo"/></td>
                                    </tr>
                                </table>-->
                            </div>
                            <div style="clear:both"></div>
                            <!--<h2>CANALETAS / ESCALERILLA</h2>
                            <table>
                                <tr>
                                    <th>TIPO DE CANALETA</th>
                                    <th></th>
                                    <th>NUEVO EXISTENTE</th>
                                    <th>ALTURA AL BASTIDOR</th>
                                    <th>LARGO TRAYECTORIA</th>
                                    <th>PULGADAS</th>
                                    <th>BAJANTES REQUERIDAS</th>
                                </tr>
                                <tr>
                                    <td>ALUMINIO</td>
                                    <td><input type="checkbox" name="bfok0" value="1"/></td>
                                    <td><select name="bfos0" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                    <td><input type="text" class="kz1" name="bfohe0" value="" disabled/></td>
                                    <td><input type="text" class="kz2" name="bfolg0" value="" disabled/></td>
                                    <td><input type="text" class="kz3" name="bfoin0" value="" disabled/></td>
                                    <td>
                                        <select name="bfoin0" disabled>
                                            <option value="0">0</option>
                                            <option value="4">4</option>
                                            <option value="6">6</option>
                                            <option value="12">12</option>
                                            <option value="24">24</option>
                                            <option value="36">36</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="kz4" name="bfodw0" value="" disabled/></td>
                                    <td>
                                        <select name="bfodw0" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ACERO</td>
                                    <td><input type="checkbox" name="bfok1" value="1"/></td>
                                    <td><select name="bfos1" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                    <td><input type="text" class="kz1" name="bfohe1" value="" disabled/></td>
                                    <td><input type="text" class="kz2" name="bfolg1" value="" disabled/></td>
                                    <td><input type="text" class="kz3" name="bfoin1" value="" disabled/></td>
                                    <td>
                                        <select name="bfoin1" disabled>
                                            <option value="0">0</option>
                                            <option value="16">16</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="kz4" name="bfodw1" value="" disabled/></td>
                                    <td>
                                        <select name="bfodw1" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>CHAROLA</td>
                                    <td><input type="checkbox" name="bfok2" value="1"/></td>
                                    <td><select name="bfos2" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                    <td><input type="text" class="kz1" name="bfohe2" value="" disabled/></td>
                                    <td><input type="text" class="kz2" name="bfolg2" value="" disabled/></td>
                                    <td><input type="text" class="kz3" name="bfoin2" value="" disabled/></td>
                                    <td>
                                        <select name="bfoin2" disabled>
                                            <option value="0">0</option>
                                            <option value="8">8</option>
                                            <option value="16">16</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="kz4" name="bfodw2" value="" disabled/></td>
                                    <td>
                                        <select name="bfodw2" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PLASTICA</td>
                                    <td><input type="checkbox" name="bfok3" value="1"/></td>
                                    <td><select name="bfos3" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                    <td><input type="text" class="kz1" name="bfohe3" value="" disabled/></td>
                                    <td><input type="text" class="kz2" name="bfolg3" value="" disabled/></td>
                                    <td><input type="text" class="kz3" name="bfoin3" value="" disabled/></td>
                                    <td>
                                        <select name="bfoin3" disabled>
                                            <option value="0">0</option>
                                            <option value="2">2</option>
                                            <option value="6">6</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="kz4" name="bfodw3" value="" disabled/></td>
                                    <td>
                                        <select name="bfodw3" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr><th colspan="8">COMENTARIOS</th></tr>
                                <tr>
                                    <td colspan="8"><textarea id="bfocm" name="bfocm"></textarea></td>
                                </tr>
                            </table>-->
                            <div style="clear:both"></div>
                        </div>
                        <!--<div class="rf">
                            <div class="ct1">
                                <img src="img/ss_img/opticoBO.png" alt="BDFO"/>
                            </div>
                            <h3>RACK LAYOUT BDFO</h3>
                        </div>-->
                        <div style="clear:both"></div>
                        <h2>TRASPASOS / REMATES &Oacute;PTICOS</h2>
                            <table id="tbdo">
                                <tr><th colspan="9">TABLA DE TRASPASOS / REMATES &Oacute;PTICOS (HACIA SERVICIOS)</th></tr>
                                <tr>
                                    <td class="h" style="width:100px">Equipo / Modelo</td>
                                    <td class="h" style="width:120px">Ubicaci&oacute;n Bastidor Fibras</td>
                                    <td class="h">Posici&oacute;n de Remate</td>
                                    <td class="h">Tipo Conector Equipo</td>
                                    <td class="h" style="width:80px">Tipo De Fibra</td>
                                    <td class="h">Tipo Conector lado DFO</td>
                                    <td class="h" style="width:94px">Bloque DFO</td>
                                    <td class="h">Long. de Jumpers Trayectoria 1</td>
                                    <td class="h">Long. de Jumpers Trayectoria 2</td>
                                </tr>
                             <?php echo intert01($folio,0,$datos[18]) ?>
                            </table>
                            <button name="afointer" style="color:#f00" class="interx" id="afointer" value="xbdo">Eliminar Remate</button>
                        <button name="xfointer" class="interx" id="xfointer" value="tbdo">Agregar Remate</button>
                        <div style="clear:both"></div>
                        <!--<div class="scsa">
                            <h2>Recuadro 1</h2>
                            <h2>Imagen 1</h2>
                            <img src="img/ss_img/photo.jpg" alt="photo"/>
                        </div>
                        <div class="scsa">
                            <h2>Recuadro 2</h2>
                            <h2>Imagen 2</h2>
                            <img src="img/ss_img/photo.jpg" alt="photo"/>
                        </div>
                        <div class="scsa">
                            <h2>Recuadro 3</h2>
                            <h2>Imagen 3</h2>
                            <img src="img/ss_img/photo.jpg" alt="photo"/>
                        </div>-->
                        <div style="clear:both"></div>
                        <div class="comentarios">
                            <table>
                                <tr><th>COMENTARIOS</th></tr>
                                <tr>
                                    <td>
                                        <textarea id="dwfo_final_coment" name="dwfo_final_coment"></textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="tabs-4">
                    <div class="conttwo">
                        <div class="lf">
                            <div class="l" id="a1" style="width:240px">
                                <h2>DISTRIBUIDOR GENERAL</h2>
                                <table>
                                    <th colspan="2">SE UTILIZAR&Aacute; DISTRIBUIDOR GENERAL</th>
                                    <tr>
                                        <td>EXISTENTE</td>
                                        <td class="t"><input type="radio" name="mp_dgral" value="Existente"/></td>
                                    </tr>
                                    <tr>
                                        <td>NUEVO</td>
                                        <td class="t"><input type="radio" name="mp_dgral" value="Nuevo"/></td>
                                    </tr>
                                </table>
                                <br/>
                                <table>
                                    <tr>
                                        <th colspan="2">TIPO DE DISTRIBUIDOR GENERAL</th>
                                    </tr>
                                    <tr>
                                        <td>7 Y 9 UN LADO VERSABLOCK</td>
                                        <td class="t"><input type="radio" id="9mpd1" name="mp_disgral" value="7 y 9 un lado versablock"/></td>
                                    </tr>
                                    <tr>
                                        <td>9 Y 11.5 DOS LADOS VERSABLOCK</td>
                                        <td class="t"><input type="radio" id="9mpd2" name="mp_disgral" value="9 y 11.5 dos lados versablock"/></td>
                                    </tr>
                                    <tr>
                                        <td>5 Y 10 NIVELES PORTASYSTEM</td>
                                        <td class="t"><input type="radio" id="9mpd2" name="mp_disgral" value="5 y 10 niveles portasystem"/></td>
                                    </tr>
                                    <!--<tr>
                                        <td>EXTERIOR</td>
                                        <td class="t"><input type="radio" id="9mpd3" name="mp_disgral" value="Exterior"/></td>
                                    </tr>-->
                                    <tr>
                                        <!--<td>OTRO<input type="text" id="mp_tipo_bastidor_fibra_ot" name="9mpdo" class="other4" name="9mpdo" value="Especificar..." disabled/></td>
                                        <td class="t"><input type="radio" id="9mpdo" name="mp_disgral" value="Otro" /></td>-->
                                    </tr>
                                </table>                                
                            </div>
                            <div class="l" id="a2" style="width:398px">
                                <table>
                                    <tr>
                                        <th colspan="2">REQUIERE AMPLIACI&Oacute;N DE VERTICALES</th>
                                    </tr>
                                    <tr>
                                        <td>SI</td>
                                        <td class="t"><input type="radio" class="bastidormp" name="mp_ampvertical" value="Si"/></td>
                                    </tr>
                                    <tr>
                                        <td>NO</td>
                                        <td class="t"><input type="radio" class="bastidormp" name="mp_ampvertical" value="No"/></td>
                                    </tr>
                                </table>
                                <table id="spdsp">
                                    <tr><th colspan="2">ESPACIO DISPONIBLE</th></tr>
                                    <tr>
                                        <td>SI</td>
                                        <td class="t"><input type="radio" name="mp_spadisp" value="Si"/></td>
                                    </tr>
                                    <tr>
                                        <td>NO</td>
                                        <td class="t"><input type="radio" name="mp_spadisp" value="No"/></td>
                                    </tr>
                                </table>
<!--                                <button name="afointer" style="color:#f00" class="interx" id="afointer" value="xbmp">Eliminar Remate</button>
                                <button name="xfointer" class="interx" id="xfointer" value="tbmp">Agregar Remate</button>-->
                            </div>
                            <div style="clear:both"></div>
                            <!--<h2>CANALETAS / ESCALERILLA</h2>
                                <table>
                                    <tr>
                                        <th>TIPO DE CANALETA</th>
                                        <th></th>
                                        <th>NUEVO EXISTENTE</th>
                                        <th>ALTURA AL BASTIDOR</th>
                                        <th>LARGO TRAYECTORIA</th>
                                        <th>PULGADAS</th>
                                        <th>BAJANTES REQUERIDAS</th>
                                    </tr>
                                    <tr>
                                        <td>ALUMINIO</td>
                                        <td><input type="checkbox" name="mtpk0" value="1"/></td>
                                        <td><select name="mtps0" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                        <td><input type="text" class="kz1" name="mtphe0" value="" disabled/></td>
                                        <td><input type="text" class="kz2" name="mtplg0" value="" disabled/></td>
                                        <td><input type="text" class="kz3" name="mtpin0" value="" disabled/></td>
                                        <td>
                                            <select name="mtpin0" disabled>
                                                <option value="0">0</option>
                                                <option value="4">4</option>
                                                <option value="6">6</option>
                                                <option value="12">12</option>
                                                <option value="24">24</option>
                                                <option value="36">36</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="kz4" name="mtpdw0" value="" disabled/></td>
                                        <td>
                                        <select name="mtpdw0" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td>ACERO</td>
                                        <td><input type="checkbox" name="mtpk1" value="1"/></td>
                                        <td><select name="mtps1" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                        <td><input type="text" class="kz1" name="mtphe1" value="" disabled/></td>
                                        <td><input type="text" class="kz2" name="mtplg1" value="" disabled/></td>
                                        <td><input type="text" class="kz3" name="mtpin1" value="" disabled/></td>
                                        <td>
                                            <select name="afoin1" disabled>
                                                <option value="0">0</option>
                                                <option value="16">16</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="kz4" name="mtpdw1" value="" disabled/></td>
                                        <td>
                                            <select name="mtpdw1" disabled>
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CHAROLA</td>
                                        <td><input type="checkbox" name="mtpk2" value="1"/></td>
                                        <td><select name="mtps2" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                        <td><input type="text" class="kz1" name="mtphe2" value="" disabled/></td>
                                        <td><input type="text" class="kz2" name="mtplg2" value="" disabled/></td>
                                        <td><input type="text" class="kz3" name="mtpin2" value="" disabled/></td>
                                        <td>
                                            <select name="mtpin2" disabled>
                                                <option value="0">0</option>
                                                <option value="8">8</option>
                                                <option value="16">16</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="kz4" name="mtpdw2" value="" disabled/></td>
                                        <td>
                                        <select name="mtpdw2" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td>PLASTICA</td>
                                        <td><input type="checkbox" name="mtpk3" value="1"/></td>
                                        <td><select name="mtps3" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                        <td><input type="text" class="kz1" name="mtphe3" value="" disabled/></td>
                                        <td><input type="text" class="kz2" name="mtplg3" value="" disabled/></td>
                                        <td><input type="text" class="kz3" name="mtpin3" value="" disabled/></td>
                                        <td>
                                            <select name="mtpin3" disabled>
                                                <option value="0">0</option>
                                                <option value="2">2</option>
                                                <option value="6">6</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="kz4" name="mtpdw3" value="" disabled/></td>
                                        <td>
                                            <select name="mtpdw3" disabled>
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr><th colspan="8">COMENTARIOS</th></tr>
                                    <tr>
                                        <td colspan="8"><textarea id="mtpcm" name="mtpcm"></textarea></td>
                                    </tr>
                                </table>-->
                            <h2>DISTRIBUIDOR GENERAL</h2>
                                <table id="tbmp">
                                    <tr>
                                        <th colspan="9">TABLA DE REMATES EQUIPOS NUEVOS</th>
                                    </tr>
                                    <tr><td colspan="3" class="t"></td><td colspan="3" class="t">POTS</td><td colspan="3" class="t">DSL</td></tr>
                                    <tr>
                                        <td class="h" style="width:130px">Equipo</td>
                                        <td class="h" style="width:119px">Tipo tablilla</td>
                                        <td class="h" style="width:90px">Long. Cable</td>
                                        <td class="h">Nivel</td>
                                        <td class="h">Vertical</td>
                                        <td class="h">Puerto</td>
                                        <td class="h">Nivel</td>
                                        <td class="h">Vertical</td>
                                        <td class="h">Puerto</td>
                                    </tr>
<!--                                    <tr>
                                        <td class="h">Equipo/Modelo</td>
                                        <td class="h">Vertical</td>
                                        <td class="h">Nivel</td>
                                        <td class="h">Tipo de tablilla</td>
                                        <td class="h">Long.<br/>de Cable</td>
                                    </tr>-->
                                    <?php echo intert03($folio) ?>
                                </table>
                            <table>
                                <tr>
                                    <th colspan="9">TABLA DE REMATES EQUIPOS EXISTENTES</th>
                                </tr>
                                <tr><td colspan="3" class="t"></td><td colspan="3" class="t">POTS</td><td colspan="3" class="t">DSL</td></tr>
                                <tr>
                                    <td class="h" style="width:130px">Equipo</td>
                                    <td class="h" style="width:119px">Tipo tablilla</td>
                                    <td class="h" style="width:90px">Long. Cable</td>
                                    <td class="h">Nivel</td>
                                    <td class="h">Vertical</td>
                                    <td class="h">Puerto</td>
                                    <td class="h">Nivel</td>
                                    <td class="h">Vertical</td>
                                    <td class="h">Puerto</td>
                                </tr>
                                <?php echo intert031($folio) ?>
                            </table>
                            <!--<ul class="intermp">
                                <li class="_2 t">Equipo 1</li><li class="_2">
                                    <select name="mptptab0">
                                        <option value="0">Seleccionar</option>
                                        <option value="1">Portasystem</option>
                                        <option value="2">Versablock</option>
                                    </select>
                                </li>
                                <li class="_2 st">POST</li>
                                <li class="_2 st">DSL</li>
                                <li class="_6 tt">Vertical</li>
                                <li class="_6 tt">Nivel</li>
                                <li class="_6 tt">Puertos</li>
                                <li class="_6 tt">Vertical</li>
                                <li class="_6 tt">Nivel</li>
                                <li class="_6 tt">Puertos</li>
                                <li class="_2 t">Equipo 2</li>
                                <li class="_2">
                                    <select name="mptptab1">
                                        <option value="0">Seleccionar</option>
                                        <option value="1">Portasystem</option>
                                        <option value="2">Versablock</option>
                                    </select>
                                </li>
                                <li class="_2 st">POST</li>
                                <li class="_2 st">DSL</li>
                                <li class="_6 tt">Vertical</li>
                                <li class="_6 tt">Nivel</li>
                                <li class="_6 tt">Puertos</li>
                                <li class="_6 tt">Vertical</li>
                                <li class="_6 tt">Nivel</li>
                                <li class="_6 tt">Puertos</li>
                                <li class="_2 t">Equipo 3</li>
                                <li class="_2">
                                    <select name="mptptab2">
                                        <option value="0">Seleccionar</option>
                                        <option value="1">Portasystem</option>
                                        <option value="2">Versablock</option>
                                    </select>
                                </li>
                                <li class="_2 st">POST</li>
                                <li class="_2 st">DSL</li>
                                <li class="_6 tt">Vertical</li>
                                <li class="_6 tt">Nivel</li>
                                <li class="_6 tt">Puertos</li>
                                <li class="_6 tt">Vertical</li>
                                <li class="_6 tt">Nivel</li>
                                <li class="_6 tt">Puertos</li>
                            </ul>-->                      
                            <div style="clear:both"></div>
                            <!--TABLA-->
                                <?php //echo square(); ?>
                        </div>
                        <!--<div class="rf">
                            <div class="box">
                                <h2>Recuadro 1</h2>
                                <h2>IMAGEN 1</h2>
                                <img alt="photo" src="img/ss_img/photo.jpg">
                            </div>
                            <div class="box">
                                <h2>Recuadro 2</h2>
                                <h2>IMAGEN 2</h2>
                                <img alt="photo" src="img/ss_img/photo.jpg">
                            </div>
                            <div class="box">
                                <h2>Recuadro 3</h2>
                                <h2>IMAGEN 3</h2>
                                <img alt="photo" src="img/ss_img/photo.jpg">
                            </div>
                        </div>-->
                        <div style="clear:both"></div>                        
                        <div class="comentarios">
                            <table>
                                <tr><th>COMENTARIOS</th></tr>
                                <tr>
                                    <td>
                                        <textarea id="mp_final_coment" name="mp_final_coment"></textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="tabs-5">
                    <div class="conttwo">
                        <div class="lf">
                            <div class="l" id="a1">
                                <h2>BASTIDOR TRONCALES DIGITALES</h2>
                                <table>
                                    <th colspan="2">SE UTILIZAR&Aacute; BDTD</th>
                                    <tr>
                                        <td>EXISTENTE</td>
                                        <td class="t"><input type="radio" class="bastidorcx" name="cx_escalerilla_bdtd" value="Existente"/></td>
                                    </tr>
                                    <tr>
                                        <td>NUEVO</td>
                                        <td class="t"><input type="radio" class="bastidorcx" name="cx_escalerilla_bdtd" value="Nuevo"/></td>
                                    </tr>
                                </table>
                                <table id="tpescx">
                                    <tr><th colspan="2">ESPACIO DISPONIBLE</th></tr>
                                    <tr>
                                        <td>SI</td>
                                        <td class="t"><input type="radio" name="cx_escalerilla_bdtd_espacio" value="Si"/></td>
                                    </tr>
                                    <tr>
                                        <td>NO</td>
                                        <td class="t"><input type="radio" name="cx_escalerilla_bdtd_espacio" value="No"/></td>
                                    </tr>
                                </table>
                                <table>
                                    <th colspan="2">TIPO DE BDTD</th>
                                    <tr>
                                        <td>TRADICIONAL</td>
                                        <td class="t"><input id="9cxd1" type="radio" id="9cxd1" name="cx_tipo_escalerilla_bdtd" value="Tradicional"/></td>
                                    </tr>
                                    <tr>
                                        <td>ALTA DENSIDAD</td>
                                        <td class="t"><input type="radio" id="9cxd2" name="cx_tipo_escalerilla_bdtd" value="Alta Densidad"/></td>
                                    </tr>
<!--                                    <tr>
                                        <td>MINI DFO</td>
                                        <td class="t"><input type="radio" id="9cxd3" name="cx_tipo_escalerilla_bdtd" value="Mini DFO"/></td>
                                    </tr>-->
                                    <tr>
                                        <td>OTRO <input type="text" id="cx_tipo_escalerilla_bdtd_ot" class="other3" name="9cxdo" value="Especificar..." disabled/></td>
                                        <td class="t"><input type="radio" id="9cxdo" name="cx_tipo_escalerilla_bdtd" value="Otro"/></td>
                                    </tr>
                                </table>
                                
                            </div>
                            <div style="clear:both"></div>
                            <!--<h2>CANALETAS / ESCALERILLA</h2>
                                <table>
                                    <tr>
                                        <th>TIPO DE CANALETA</th>
                                        <th></th>
                                        <th>NUEVO EXISTENTE</th>
                                        <th>ALTURA AL BASTIDOR</th>
                                        <th>LARGO TRAYECTORIA</th>
                                        <th>PULGADAS</th>
                                        <th>BAJANTES REQUERIDAS</th>
                                    </tr>
                                    <tr>
                                        <td>ALUMINIO</td>
                                        <td><input type="checkbox" name="cxlk0" value="1"/></td>
                                        <td><select name="cxls0" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                        <td><input type="text" class="kz1" name="cxlhe0" value="" disabled/></td>
                                        <td><input type="text" class="kz2" name="cxllg0" value="" disabled/></td>
                                        <td><input type="text" class="kz3" name="cxlin0" value="" disabled/></td>
                                        <td>
                                            <select name="cxlin0" disabled>
                                                <option value="0">0</option>
                                                <option value="4">4</option>
                                                <option value="6">6</option>
                                                <option value="12">12</option>
                                                <option value="24">24</option>
                                                <option value="36">36</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="kz4" name="cxldw0" value="" disabled/></td>
                                        <td>
                                        <select name="cxldw0" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td>ACERO</td>
                                        <td><input type="checkbox" name="cxlk1" value="1"/></td>
                                        <td><select name="cxls1" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                        <td><input type="text" class="kz1" name="cxlhe1" value="" disabled/></td>
                                        <td><input type="text" class="kz2" name="cxllg1" value="" disabled/></td>
                                        <td><input type="text" class="kz3" name="cxlin1" value="" disabled/></td>
                                        <td>
                                            <select name="cxlin1" disabled>
                                                <option value="0">0</option>
                                                <option value="16">16</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="kz4" name="cxldw1" value="" disabled/></td>
                                        <td>
                                        <select name="cxldw1" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td>CHAROLA</td>
                                        <td><input type="checkbox" name="cxlk2" value="1"/></td>
                                        <td><select name="cxls2" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                        <td><input type="text" class="kz1" name="cxlhe2" value="" disabled/></td>
                                        <td><input type="text" class="kz2" name="cxllg2" value="" disabled/></td>
                                        <td><input type="text" class="kz3" name="cxlin2" value="" disabled/></td>
                                        <td>
                                            <select name="cxlin2" disabled>
                                                <option value="0">0</option>
                                                <option value="8">8</option>
                                                <option value="16">16</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="kz4" name="cxldw2" value="" disabled/></td>
                                        <td>
                                        <select name="cxldw2" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td>PLASTICA</td>
                                        <td><input type="checkbox" name="cxlk3" value="1"/></td>
                                        <td><select name="cxls3" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                        <td><input type="text" class="kz1" name="cxlhe3" value="" disabled/></td>
                                        <td><input type="text" class="kz2" name="cxllg3" value="" disabled/></td>
                                        <td><input type="text" class="kz3" name="cxlin3" value="" disabled/></td>
                                        <td>
                                            <select name="cxlin3" disabled>
                                                <option value="0">0</option>
                                                <option value="6">6</option>
                                                <option value="2">2</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="kz4" name="cxldw3" value="" disabled/></td>
                                        <td>
                                            <select name="cxldw3" disabled>
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr><th colspan="8">COMENTARIOS</th></tr>
                                    <tr>
                                        <td colspan="8"><textarea id="cxlcm" name="cxlcm"></textarea></td>
                                    </tr>
                                </table>-->
                            <div style="clear:both"></div>
                        </div>
                        <!--<div class="rf">
                            <div class="ct1">
                                <img src="img/ss_img/coaxial.jpg" alt="BDTD"/>
                            </div>
                            <h3>RACK LAYOUT BDFO</h3>
                        </div>-->
                        <div style="clear:both"></div>
                        <h2>TRASPASOS / REMATES</h2>
                            <table id="tbcx">
                                <tr><th colspan="9">TABLA DE TRASPASOS / REMATES</th></tr>
                                <tr>
                                    <td class="h">Equipo/Modelo</td>
                                    <td class="h" style="width:100px">Ubicaci&oacute;n BDTD</td>
                                    <td class="h">Posici&oacute;n Tablilla</td>
                                    <td style="width:50px" class="h">Lado</td>
                                    <td class="h">Posici&oacute;n Contacto</td>
                                    <td class="h">Tipo Conector</td>
                                    <td class="h">Tipo Coaxial</td>
                                    <td class="h">Tx / Rx</td>
                                    <td class="h">Long. de Cable</td>
                                </tr>
                                <?php echo intert04($folio) ?>
                            </table>
                            <button name="cxinter" style="color:#f00" class="interx" id="cxinter" value="xbcx">Eliminar Remate</button>
                            <button name="xcxinter" class="interx" id="xcxinter" value="tbcx">Agregar Remate</button>
                            <div style="clear:both"></div>
                        <!--<div class="scsa">
                            <h2>Recuadro 1</h2>
                            <h2>Imagen 1</h2>
                            <img src="img/ss_img/photo.jpg" alt="photo"/>
                        </div>
                        <div class="scsa">
                            <h2>Recuadro 2</h2>
                            <h2>Imagen 2</h2>
                            <img src="img/ss_img/photo.jpg" alt="photo"/>
                        </div>
                        <div class="scsa">
                            <h2>Recuadro 3</h2>
                            <h2>Imagen 3</h2>
                            <img src="img/ss_img/photo.jpg" alt="photo"/>
                        </div>-->
                        <div style="clear:both"></div>
                        <div class="comentarios">
                            <table>
                                <tr><th>COMENTARIOS</th></tr>
                                <tr>
                                    <td>
                                        <textarea id="cx_final_coment" name="cx_final_coment"></textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="tabs-6">
                    <div class="conttwo">
                        <div class="lf">
                            <h2>GESTI&Oacute;N</h2>
                            <table>
                                <tr>
                                    <th colspan="2">REQUIERE GESTI&Oacute;N</th>
                                    <th colspan="2">TIPO DE GESTI&Oacute;N</th>
                                    <th colspan="2">SE UTILIZAR&Aacute; PUERTO RCDT</th>
                                </tr>
                                <tr>
                                    <td>SI</td><td class="t"><input type="radio" name="gs_reqgstion" value="Si"/></td>
                                    <td>EN BANDA</td><td class="t"><input type="radio" name="gs_tipogstion" value="En Banda"/></td>
                                    <td>EXISTENTE</td><td class="t"><input type="radio" name="gs_rctd" value="Existente"/></td>
                                </tr>
                                <tr>
                                    <td>NO</td><td class="t"><input type="radio" name="gs_reqgstion" value="No"/></td>
                                    <td>FUERA DE BANDA</td><td class="t"><input type="radio" name="gs_tipogstion" value="Fuera de Banda"/></td>
                                    <td>NUEVO</td><td class="t"><input type="radio" name="gs_rctd" value="Nuevo"/></td>
                                </tr>
                            </table>
                                <div style="clear:both"></div>
                                <h2>SINCRON&Iacute;A</h2>
                                <table>
                                    <tr>
                                        <th colspan="4">REQUIERE SINCRON&Iacute;A</th>
                                    </tr>
                                    <tr>
                                        <td>SI</td>
                                        <td class="t"><input type="radio" name="gs_reqsincronia" value="Si"/></td>
                                    </tr>
                                    <tr>
                                        <td>NO</td>
                                        <td class="t"><input type="radio" name="gs_reqsincronia" value="No"/></td>
                                    </tr>
                                </table>
                                <h2>ALARMAS</h2>
                                <table>
                                    <tr><th colspan="2">REQUIERE CONEXI&Oacute;N ADICIONAL DE ALARMAS</th></tr>
                                    <tr>
                                        <td>SI</td>
                                        <td class="t"><input type="radio" name="gs_reqalarmas" value="Si"/></td>
                                    </tr>
                                    <tr>
                                        <td>NO</td>
                                        <td class="t"><input type="radio" name="gs_reqalarmas" value="No"/></td>
                                    </tr>
                                </table>
                                <h2>CIRCUITO DE ALIMENTACI&Oacute;N</h2>
                                <table>
                                    <tr><th colspan="2">REQUIERE CIRCUITO DE ALIMENTACI&Oacute;N</th></tr>
                                    <tr>
                                        <td>SI</td>
                                        <td class="t"><input type="radio" name="gs_reqctoalim" value="Si"/></td>
                                    </tr>
                                    <tr>
                                        <td>NO</td>
                                        <td class="t"><input type="radio" name="gs_reqctoalim" value="No"/></td>
                                    </tr>
                                </table>
                                <div style="clear:both"></div>
                            <!--<h2>CANALETAS / ESCALERILLA</h2>
                            <table>
                                <tr>
                                    <th>TIPO DE CANALETA</th>
                                    <th></th>
                                    <th>NUEVO EXISTENTE</th>
                                    <th>ALTURA AL BASTIDOR</th>
                                    <th>LARGO TRAYECTORIA</th>
                                    <th>PULGADAS</th>
                                    <th>BAJANTES REQUERIDAS</th>
                                </tr>
                                <tr>
                                    <td>ALUMINIO</td>
                                    <td><input type="checkbox" name="gysk0" value="1"/></td>
                                    <td><select name="gyss0" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                    <td><input type="text" class="kz1" name="gyshe0" value="" disabled/></td>
                                    <td><input type="text" class="kz2" name="gyslg0" value="" disabled/></td>
                                    <td><input type="text" class="kz3" name="gysin0" value="" disabled/></td>
                                    <td>
                                        <select name="gysin0" disabled>
                                            <option value="0">0</option>
                                            <option value="4">4</option>
                                            <option value="6">6</option>
                                            <option value="12">12</option>
                                            <option value="24">24</option>
                                            <option value="36">36</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="kz4" name="gysdw0" value="" disabled/></td>
                                    <td>
                                        <select name="gysdw0" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ACERO</td>
                                    <td><input type="checkbox" name="gysk1" value="1"/></td>
                                    <td><select name="gyss1" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                    <td><input type="text" class="kz1" name="gyshe1" value="" disabled/></td>
                                    <td><input type="text" class="kz2" name="gyslg1" value="" disabled/></td>
                                    <td><input type="text" class="kz3" name="gysin1" value="" disabled/></td>
                                    <td>
                                        <select name="gysin1" disabled>
                                            <option value="0">0</option>
                                            <option value="16">16</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="kz4" name="gysdw1" value="" disabled/></td>
                                    <td>
                                        <select name="afodw3" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>CHAROLA</td>
                                    <td><input type="checkbox" name="gysk2" value="1"/></td>
                                    <td><select name="gyss2" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                    <td><input type="text" class="kz1" name="gyshe2" value="" disabled/></td>
                                    <td><input type="text" class="kz2" name="gyslg2" value="" disabled/></td>
                                    <td><input type="text" class="kz3" name="gysin2" value="" disabled/></td>
                                    <td>
                                        <select name="gysin2" disabled>
                                            <option value="0">0</option>
                                            <option value="8">8</option>
                                            <option value="16">16</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="kz4" name="gysdw2" value="" disabled/></td>
                                    <td>
                                        <select name="gysdw2" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PLASTICA</td>
                                    <td><input type="checkbox" name="gysk3" value="1"/></td>
                                    <td><select name="gyss3" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                    <td><input type="text" class="kz1" name="gyshe3" value="" disabled/></td>
                                    <td><input type="text" class="kz2" name="gyslg3" value="" disabled/></td>
                                    <td><input type="text" class="kz3" name="gysin3" value="" disabled/></td>
                                    <td>
                                        <select name="gysin3" disabled>
                                            <option value="0">0</option>
                                            <option value="2">2</option>
                                            <option value="6">6</option>
                                        </select>
                                    </td>
                                    <td><input type="text" class="kz4" name="gysdw3" value="" disabled/></td>
                                    <td>
                                        <select name="gysdw3" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr><th colspan="8">COMENTARIOS</th></tr>
                                <tr>
                                    <td colspan="8"><textarea id="gyscm" name="gyscm"></textarea></td>
                                </tr>
                            </table>-->
                            <div style="clear:both"></div>
                            <h2>UBICACIONES RCDT</h2>
                            <table id="tbgs">
                                <tr><th colspan="9">GESTI&Oacute;N</th></tr>
                                <tr>
                                    <td class="h">Equipo/Modelo</td>
                                    <td class="h">Ubicaci&oacute;n RCDT</td>
                                    <td class="h">N&uacute;mero Switch</td>
                                    <td class="h">Puerto</td>
                                    <td class="h">Categor&iacute;a Cable</td>
                                    <td class="h">Long. de Cable</td>
                                    <td class="h">Tipo Conector</td>
                                </tr>                               
                                <?php echo intert05($folio,0) ?>
                                <tr><th colspan="9">SINCRON&iacute;A</th></tr>
                                <tr>
                                    <td class="h">Equipo/Modelo</td>
                                    <td class="h">Ubicaci&oacute;n RCDT</td>
                                    <td class="h">N&uacute;mero Switch</td>
                                    <td class="h">Puerto</td>
                                    <td class="h">Categor&iacute;a Cable</td>
                                    <td class="h">Long. de Cable</td>
                                    <td class="h">Tipo Conector</td>
                                </tr>
                                <?php echo intert05($folio,1) ?>
                            </table>
                        </div>
                        <!--<div class="rf">
                            <div class="ct1">
                                <img src="img/ss_img/coaxial.jpg" alt="BDTD"/>
                            </div>
                            <h3>RACK LAYOUT BDFO</h3>
                        </div>-->
                        <div style="clear:both"></div>
                        <!--<div class="scsa">
                            <h2>Recuadro 1</h2>
                            <h2>Imagen 1</h2>
                            <img src="img/ss_img/photo.jpg" alt="photo"/>
                        </div>
                        <div class="scsa">
                            <h2>Recuadro 2</h2>
                            <h2>Imagen 2</h2>
                            <img src="img/ss_img/photo.jpg" alt="photo"/>
                        </div>
                        <div class="scsa">
                            <h2>Recuadro 3</h2>
                            <h2>Imagen 3</h2>
                            <img src="img/ss_img/photo.jpg" alt="photo"/>
                        </div>-->
                        <div style="clear:both"></div>
                        <div class="comentarios">
                            <table>
                                <tr><th>COMENTARIOS</th></tr>
                                <tr>
                                    <td>
                                        <textarea id="gs_final_coment" name="gs_final_coment"></textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="tabs-7">
                    <div class="conttwo">
                        <div class="lf">
                            <h2>ALIMENTACI&Oacute;N</h2>
                            <div class="l" id="a1">
                                <table>
                                    <th colspan="2">TIPO DE ALIMENTACI&Oacute;N</th>
                                    <tr>
                                        <td>PLANTA</td>
                                        <td class="t"><input type="radio" id="9fza1" name="fz_tp_alimen" value="Planta"/></td>
                                    </tr>
                                    <tr>
                                        <td>DISTRIBUIDOR DE FUERZA (GLT)</td>
                                        <td class="t"><input type="radio" id="9fza2" name="fz_tp_alimen" value="Distribuidor de Fuerza (GLT)"/></td>
                                    </tr>
                                    <tr>
                                        <td>REMOTO EN BASTIDOR (PDU)</td>
                                        <td class="t"><input type="radio" id="9fza3" name="fz_tp_alimen" value="Remoto en Bastidor"/></td>
                                    </tr>
                                    <tr>
                                        <td>OTRO <input type="text" id="fz_tp_alimen_ot" class="other5" name="9fzao" value="Especificar..." disabled/></td>
                                        <td class="t"><input type="radio" id="9fzao" name="fz_tp_alimen" value="Otro"/></td>
                                    </tr>
                                </table>
                                <h2>TIERRAS</h2>
                                <table>
                                    <th colspan="2">TIPO DE TIERRA</th>
                                    <tr>
                                        <td>TIERRA GENERAL DE PISO</td>
                                        <td class="t"><input type="radio" id="9fze1" name="fz_escalerilla_bdtd" value="Tierra general de piso"/></td>
                                    </tr>
                                    <tr>
                                        <td>TIERRA GENERAL DE SALA</td>
                                        <td class="t"><input type="radio" id="9fze2" name="fz_escalerilla_bdtd" value="Tierra general de sala"/></td>
                                    </tr>
                                    <tr>
                                        <td>TIERRA DE FILA</td>
                                        <td class="t"><input type="radio" id="9fze3" name="fz_escalerilla_bdtd" value="Tierra de fila"/></td>
                                    </tr>
                                    <tr>
                                        <td>TIERRA EN REPISA</td>
                                        <td class="t"><input type="radio" id="9fze4" name="fz_escalerilla_bdtd" value="Tierra en repisa"/></td>
                                    </tr>
                                    <tr>
                                        <td>OTRO <input type="text" class="other7" name="9fzeo" value="Especificar..." disabled/></td>
                                        <td class="t"><input type="radio" id="9fzeo" name="fz_escalerilla_bdtd" value="Otro"/></td>
                                    </tr>
                                </table>                                
                            </div>
                            <div class="l" id="a2">
                                <table style="margin-bottom:30px">
                                    <tr><th colspan="2">CONFIGURACI&Oacute;N DE LA PLANTA</th></tr>
                                    <tr>
                                        <td class="t"><input type="text" class="fz0" id="fz_configplanta" name="fz_configplanta" onClick="popup('config_planta.php', 974, 136);"/></td>
                                    </tr>
                                </table>
                                <table style="margin-bottom:30px">
                                    <tr><th colspan="2">LONGITUD DE CABLE DE TIERRA</th></tr>
                                    <tr>
                                        <td class="t"><input type="text" class="fz0" id="fz_longcabletierra" name="fz_longcabletierra"/></td>
                                    </tr>
                                </table>
                                <div style="clear:both"></div>
                                <!--<table>
                                    <tr>
                                        <th colspan="2">CONSUMO ACTUAL</th>
                                    </tr>
                                    <tr>
                                        <td><input type="text" id="fz_cact" class="fz0" name="fz_cact"/></td>
                                    </tr>
                                </table>-->
                                <input type="hidden" id="fz_cact" name="fz_cact" value="N/A"/>
                            </div>
                            <div style="clear:both"></div>
                            <h2>CLIMA</h2>
                            <table>
                                <tr><th colspan="2">REQUIERE CLIMA NUEVO</th></tr>
                                <tr>
                                    <td>REDISTRIBUCI&Oacute;N DE DUCTOS</td>
                                    <td class="t"><input type="radio" name="cl_reqnucl" value="Redistribucion de ductos"/></td>
                                </tr>
                                <tr>
                                    <td>AMPLIACI&Oacute;N</td>
                                    <td class="t"><input type="radio" name="cl_reqnucl" value="ampliacion"/></td>
                                </tr>
                                <tr>
                                    <td>NINGUNO</td>
                                    <td class="t"><input type="radio" name="cl_reqnucl" value="Ninguno"/></td>
                                </tr>
                            </table>
                            <div style="clear:both"></div>
                            <!--<h2>CANALETAS / ESCALERILLA</h2>
                            <table>
                                    <tr>
                                        <th>TIPO DE CANALETA</th>
                                        <th></th>
                                        <th>NUEVO EXISTENTE</th>
                                        <th>ALTURA AL BASTIDOR</th>
                                        <th>LARGO TRAYECTORIA</th>
                                        <th>PULGADAS</th>
                                        <th>BAJANTES REQUERIDAS</th>
                                    </tr>
                                    <tr>
                                        <td>ALUMINIO</td>
                                        <td><input type="checkbox" name="fzak0" value="1"/></td>
                                        <td><select name="fzas0" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                        <td><input type="text" class="kz1" name="fzahe0" value="" disabled/></td>
                                        <td><input type="text" class="kz2" name="fzalg0" value="" disabled/></td>
                                        <td><input type="text" class="kz3" name="fzain0" value="" disabled/></td>
                                        <td>
                                            <select name="fzain0" disabled>
                                                <option value="0">0</option>
                                                <option value="4">4</option>
                                                <option value="6">6</option>
                                                <option value="12">12</option>
                                                <option value="24">24</option>
                                                <option value="36">36</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="kz4" name="fzadw0" value="" disabled/></td>
                                        <td>
                                        <select name="fzadw0" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td>ACERO</td>
                                        <td><input type="checkbox" name="fzak1" value="1"/></td>
                                        <td><select name="fzas1" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                        <td><input type="text" class="kz1" name="fzahe1" value="" disabled/></td>
                                        <td><input type="text" class="kz2" name="fzalg1" value="" disabled/></td>
                                        <td><input type="text" class="kz3" name="fzain1" value="" disabled/></td>
                                        <td>
                                            <select name="fzain1" disabled>
                                                <option value="0">0</option>
                                                <option value="16">16</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="kz4" name="fzadw1" value="" disabled/></td>
                                        <td>
                                            <select name="fzadw1" disabled>
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>CHAROLA</td>
                                        <td><input type="checkbox" name="fzak2" value="1"/></td>
                                        <td><select name="fzas2" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                        <td><input type="text" class="kz1" name="fzahe2" value="" disabled/></td>
                                        <td><input type="text" class="kz2" name="fzalg2" value="" disabled/></td>
                                        <td><input type="text" class="kz3" name="fzain2" value="" disabled/></td>
                                        <td>
                                            <select name="fzain2" disabled>
                                                <option value="0">0</option>
                                                <option value="8">8</option>
                                                <option value="16">16</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="kz4" name="fzadw2" value="" disabled/></td>
                                        <td>
                                        <select name="fzadw2" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td>PLASTICA</td>
                                        <td><input type="checkbox" name="fzak3" value="1"/></td>
                                        <td><select name="fzas3" disabled><option value="0">Seleccionar</option><option value="1">Nuevo</option><option value="2">Existente</option></select></td>
                                        <td><input type="text" class="kz1" name="fzahe3" value="" disabled/></td>
                                        <td><input type="text" class="kz2" name="fzalg3" value="" disabled/></td>
                                        <td><input type="text" class="kz3" name="fzain3" value="" disabled/></td>
                                        <td>
                                            <select name="fzain3" disabled>
                                                <option value="0">0</option>
                                                <option value="2">2</option>
                                                <option value="6">6</option>                                                
                                            </select>
                                        </td>
                                        <td><input type="text" class="kz4" name="fzadw3" value="" disabled/></td>
                                        <td>
                                        <select name="fzadw3" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </td>
                                    </tr>
                                    <tr><th colspan="8">COMENTARIOS</th></tr>
                                    <tr>
                                        <td colspan="8"><textarea id="fzacm" name="fzacm"></textarea></td>
                                    </tr>
                                </table>-->                            
                        </div>
                        <!--<div class="rf">
                            <div class="ct1">
                                <div class="conttable"></div>
                            </div>
                            <h3>PANEL DE FUERZA</h3>
                        </div>-->
                        <div style="clear:both"></div>
                        <h2>ALIMENTACI&Oacute;N</h2>
                            <table id="tbfz">
                                <tr><th colspan="10">TABLA DE POSICIONES DE ALIMENTACI&Oacute;N</th></tr>
                                <tr>
                                    <td class="h">Equipo/Modelo</td>
                                    <td class="h" style="width:70px">Tipo Consumo Fuerza</td>
                                    <td class="h">Ubicaci&oacute;n Alimentaci&oacute;n</td>
                                    <td class="h">Nuevo/Existente</td>
                                    <td class="h">P. de Fusible o Breaker</td>
                                    <td class="h">Capacidad de Fusible</td>
                                    <td class="h">Calibre de Cable</td>
                                    <td class="h">Long. del Cable de Fza.</td>
                                    <td class="h">Cant. de Cables</td>
                                    <td class="h">Tipo de Zapata</td>
                                </tr>
                                <tr>
                                    <?php echo intert06($folio) ?>
                            </table>
                        <button name="afointer" style="color:#f00" class="interx" id="afointer" value="xbfz">Eliminar Remate</button>
                        <button name="xfointer" class="interx" id="xfointer" value="tbfz">Agregar Remate</button>
                        <!--<div class="scsa">
                            <h2>Recuadro 1</h2>
                            <h2>Imagen 1</h2>
                            <img src="img/ss_img/photo.jpg" alt="photo"/>
                        </div>
                        <div class="scsa">
                            <h2>Recuadro 2</h2>
                            <h2>Imagen 2</h2>
                            <img src="img/ss_img/photo.jpg" alt="photo"/>
                        </div>
                        <div class="scsa">
                            <h2>Recuadro 3</h2>
                            <h2>Imagen 3</h2>
                            <img src="img/ss_img/photo.jpg" alt="photo"/>
                        </div>-->
                        <div style="clear:both"></div>
                        <div class="comentarios">
                            <table>
                                <tr><th>COMENTARIOS</th></tr>
                                <tr>
                                    <td>
                                        <textarea id="fz_final_coment" name="fz_final_coment"></textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="tabs-8">
                    <div class="conttwo">
                            <h2>AGREGAR PLANOS</h2>
                            <div class="contplanos">
                                <button id="check_loader" name="check_loader">Subir Archivo .PDF</button>
                                <fieldset class="check">
                                    <legend>Datos Generales de Archivo</legend>
                                    <div class="fa">
                                        <input type="checkbox" name="tplan1" value="Plano de sala"/>
                                        <label>Plano de sala</label>
                                    </div>
                                    <div class="fa">
                                        <input type="checkbox" name="tplan2" value="Plano de trayectoria"/>
                                        <label>Plano de trayectoria</label>
                                    </div>
                                    <div class="fa">
                                        <label>Descripci&oacute;n <span class="red">*</span></label>
                                    </div>
                                    <textarea id="dscript" name="dscript"></textarea>
                                    <div class="fa"><button id="upload_button" name="upload_button" disabled>Subir Archivo (unicamente .PDF)</button></div>
                                </fieldset>
                                <div id="ld"><img src="img/load.gif"/></div>
                                <ul id="zip">
                                    <?php echo $files[0]; ?>
                                </ul>
                            </div>
                            <div style="clear:both"></div>
                            <h2>AGREGAR IMAGENES</h2>
                            <div class="contplanos">
                                <!--<div id="upload_image">Subir Archivo</div>-->
                                <button id="image_loader" name="image_loader">Subir Imagen</button>
                                <fieldset class="checkimg">
                                    <legend>Descripci&oacute;n de imagen</legend>
<!--                                    <div class="fa">
                                        <input type="checkbox" name="tplan1" value="Plano de sala"/>
                                        <label>Plano de sala</label>
                                    </div>
                                    <div class="fa">
                                        <input type="checkbox" name="tplan2" value="Plano de trayectoria"/>
                                        <label>Plano de trayectoria</label>
                                    </div>
                                    <div class="fa">
                                        <label>Descripci&oacute;n <span class="red">*</span></label>
                                    </div>-->
                                    <textarea id="dscriptimg" name="dscriptimg"></textarea>
                                    <div class="fa"><button id="upload_image" name="upload_image">Cargar Imagen</button></div>
                                </fieldset>
                                <div id="ld2"><img src="img/load.gif"/></div>
                                <ul id="image">
                                    <?php echo $files[1]; ?>
                                </ul>
                            </div>
                                <div style="clear:both"></div>
                                <div class="COMENTARIOS">
                                <table>
                                    <tr><th>COMENTARIOS</th></tr>
                                    <tr>
                                        <td>
                                            <textarea id="pl_final_coment" name="pl_final_coment"></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
            <input type="hidden" id="bandera" name="bandera" value="<?php echo $bandera ?>"/>
            <input type="hidden" id="nueq" name="nueq" value="<?php echo $numeq ?>"/>
            <input type="hidden" id="folio" name="folio" value="<?php echo $folio ?>"/>
            <input type="hidden" id="estatus_ss" name="estatus_ss" value="<?php echo $datos[17] ?>"/>
            <input type="hidden" id="flag" name="flag" value="0"/>
            <input type="hidden" id="tpval" name="tpval" value="<?php echo $tipoValidacion ?>"/>
            <input type="hidden" id="copias" name="copias" value="0"/>
            <input type="hidden" id="rubro" name="rubro" value="<?php echo $datos[15] ?>"/>
            <input type="hidden" id="fecha_ejecucion" name="fecha_ejecucion" value="<?php echo $datos[7] ?>"/>
            <input type="hidden" id="tecnologia" name="tecnologia" value="<?php echo $datos[18] ?>"/>
            <input type="hidden" id="usr" name="usr" value="<?php echo $_SESSION['usr'] ?>"/>
            <input type="submit" id="save" name="save" value="Guardar y continuar"/>
            <input type="submit" id="enviar" name="enviar" value="Enviar a validacion"/>
        </div>
        </form>
        <script src="js/UploadFile.js"></script>
        <script>
            if($('#bandera').val() == 1){
                $('button,#save,#enviar').hide();
                $('#exportPDF').attr('disabled','disabled');
                alert('El Site Survey esta en modo de solo lectura');
            }
        </script>
    </body>
</html>
<?php
    }