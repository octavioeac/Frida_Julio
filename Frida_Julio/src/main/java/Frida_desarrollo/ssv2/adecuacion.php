<?php 
    session_start();
    require 'functions/interconexiones.php';
    require 'functions/saver.php';
    require 'functions/adecuacion/tablas.php';
    $folio = $_SESSION['folio'];
    $numeq = maxeq($folio);
    $datos = cabecera($folio,1);
    $modelos = modelos($folio);
    $ancho = '';
    for($i=2;$i<=20;$i+=2){
        $ancho .= '<option value="'.$i.'">'.$i.'</option>';
    }
    $files = getfiles($folio);
    if($datos[6] != ''){
        $datos[6] = datetransform($datos[6]);
    }
    if($datos[7] != ''){
        $datos[7] = datetransform($datos[7]);
    }
    if($datos[8] != ''){
        $datos[8] = datetransform($datos[8]);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Adecuaci&oacute;n De Sala Site Survey</title>
        <link rel="stylesheet" href="css/ssv2nu.css" type="text/css"/>
        <link rel="stylesheet" href="css/header.css" type="text/css"/>
        <link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css" type="text/css"/>
        <link rel="stylesheet" href="css/widths.css" type="text/css"/>
        <link rel="stylesheet" href="css/datepicker.css" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="shadowbox/shadowbox.css">
        <script type="text/javascript" src="shadowbox/shadowbox.js"></script>
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/AjaxUpload.2.0.min.js"></script>
        <script src="js/jqueryuiall/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="js/startad.js"></script>
        <style>
            .ui-dialog .ui-dialog-titlebar-close{background-color:transparent;background-image:url('img/close.png');background-position:0 0;background-repeat:no-repeat;border:none;width:16px;height:16px}
            
        </style>
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
        <div id="dialog">
            <div class="contenedor">
                <fieldset>
                    <legend>Seleccione una descripci&oacute;n</legend>
                    <div class="desc"></div>
                </fieldset>
                <fieldset id="datos">
                    <legend>Datos adicionales</legend>
                    <div class="field">
                        <label>Cantidad</label>
                        <input type="text" name="cantidad"/>
                    </div>
                    <div class="field">
                        <label id="titulo"></label>
                        <select name="cantidad" id="cantidad">
                            <option value="-">Seleccionar</option>
                        </select>
                    </div>
                </fieldset>
                <button id="cerrar">Agregar</button>
            </div>
        </div>
        <div id="descripcion">
            <label>Agregar descripción</label>
            <textarea name="dscr" id="dscr"></textarea>
            <button id="adddscr" name="adddscr">Agregar</button>
        </div>
        <div id="header">
            <h1><a href="../inicio.php">F R I D A</a></h1>
            <h2>Formato De Captura Para Adecuaciones Site Survey</h2>
        </div>
        <form name="guardado" id="guardado" method="post" action="guardado.php">
            <div id="ejecucion">
                <label>Fecha de ejecución</label>
                <input type="text" id="datepicker" name="execute_date"/>
                <input type="submit" name="enviara" id="enviara" value="Enviar a validaci&oacute;n"/>
            </div>
            <div id="main">
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
                        <td class="h"><?php echo $datos[7] ?></td>
                        <td class="h"><?php echo $datos[8] ?></td>
                    </tr>
                </table>
                <table id="end">
                    <tr>
                        <td class="t">CONTACTO TELMEX</td>
                        <td class="t">CONTACTO PROVEEDOR</td>
                    </tr>
                    <tr>
                        <td class="h"><?php echo $datos[9].', '.$datos[10].', '.$datos[11]; ?></td>
                        <td class="h"><?php echo $datos[12].', '.$datos[13].', '.$datos[14]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="t">CON COPIA PARA</td>
                    </tr>
                    <?php echo copiacorreo($folio) ?>
                </table>
                <table id="email">
                    <tr>
                        <td colspan="5" class="t">AGREGAR MÁS DIRECCIONES DE CORREO ELECTRONICO <div id="addmail">Agregar</div></td>
                    </tr>
                </table>
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1">ESTADO GRAL.<br/>DE SITIO</a></li>
                        <li><a href="#tabs-2">INFRAESTRUCTURA<br/>&nbsp;</a></li>
                        <li><a href="#tabs-3">PLANOS<br/>&nbsp;</a></li>
                    </ul>
                    <div id="tabs-1">
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
                            <tr>
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
                            </tr>
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
                        </table>
                    </div>
                    <div id="tabs-2">
                        <div class="conttwo">
                            <h2>ADECUACI&Oacute;N DE INFRAESTRUCTURA</h2>
                            <table style="margin-bottom:30px">
                                <tr><th>JUSTIFICACI&Oacute;N CRECIMIENTO DE INFRAESTRUCTURA</th></tr>
                                <tr><td><textarea id="justificacion_coment" name="justificacion_coment"></textarea></td></tr>
                            </table>
                            <!--    ALIMENTACION    -->
                            <h2>ALIMENTACI&Oacute;N<div class="ag" id="0"><h3>Agregar</h3></div></h2>
                            <?php echo tablas($folio,0); ?>
                            <table style="margin:-11px 0 20px">
                                <tr>
                                    <th>COMENTARIOS</th>
                                </tr>
                                <tr>
                                    <td><textarea id="infAlim_coment" name="infAlim_coment"></textarea></td>
                                </tr>
                            </table>
                            <div style="width:1000px;height:1px;background:#aaa;border-bottom:1px #ccc solid;margin:0 0 19px"></div>
                            <!--    BDTD    -->
                            <h2>BDTD<div class="ag" id="1"><h3>Agregar</h3></div></h2>
                            <?php echo tablas($folio,1); ?>
                            <table style="margin-top:-11px">
                                <tr>
                                    <th class="t" colspan="8">UBICACI&Oacute;N INTER BDTD</th>
                                </tr>
                                <tr>
                                    <td class="t">Punta</td>
                                    <td class="t">Ubicaci&oacute;n BDTD</td>
                                    <td class="t">Posici&oacute;n Tablilla</td>
                                    <td class="t">Lado</td>
                                    <td class="t">Posición Contacto</td>
                                    <td class="t">Tipo Conector</td>
                                    <td class="t">Tipo de Cable</td>
                                    <td class="t">Long. de Cable</td>
                                </tr>
                                <tr>
                                    <td class="t2">A</td>
                                    <td class="t2"><input type="text" name="aubdt" class="c1"/></td>
                                    <td class="t2"><input type="text" name="aptbl" class="c2"/></td>
                                    <td class="t2"><input type="text" name="alado" class="c3"/></td>
                                    <td class="t2"><input type="text" name="apcnt" class="c4"/></td>
                                    <td class="t2"><input type="text" name="atcon" class="c5"/></td>
                                    <td class="t2"><input type="text" name="atcbl" class="c6"/></td>
                                    <td class="t2"><input type="text" name="alcbl" class="c7"/></td>
                                </tr>
                                <tr>
                                    <td class="t2">B</td>
                                    <td class="t2"><input type="text" id="bubdt" name="bubdt" class="c1"/></td>
                                    <td class="t2"><input type="text" id="bptbl" name="bptbl" class="c2"/></td>
                                    <td class="t2"><input type="text" id="blado" name="blado" class="c3"/></td>
                                    <td class="t2"><input type="text" id="bpcnt" name="bpcnt" class="c4"/></td>
                                    <td class="t2"><input type="text" id="btcon" name="btcon" class="c5"/></td>
                                    <td class="t2"><input type="text" id="btcbl" name="btcbl" class="c6"/></td>
                                    <td class="t2"><input type="text" id="blcbl" name="blcbl" class="c7"/></td>
                                </tr>
                            </table>
                            <table style="margin:-11px 0 20px">
                                <tr>
                                    <th>COMENTARIOS</th>
                                </tr>
                                <tr>
                                    <td><textarea id="infBDTD_coment" name="infBDTD_coment"></textarea></td>
                                </tr>
                            </table>
                            <div style="width:1000px;height:1px;background:#aaa;border-bottom:1px #ccc solid;margin:0 0 19px"></div>
                            <!--    CABLEADO    -->
                            <h2>CABLEADO<div class="ag" id="2"><h3>Agregar</h3></div></h2>
                            <?php echo tablas($folio,2); ?>
                            <table style="margin:-11px 0 20px">
                                <tr>
                                    <th>COMENTARIOS</th>
                                </tr>
                                <tr>
                                    <td><textarea id="infCable_coment" name="infCable_coment"></textarea></td>
                                </tr>
                            </table>
                            <div style="width:1000px;height:1px;background:#aaa;border-bottom:1px #ccc solid;margin:0 0 19px"></div>
                            <!--    CANALETAS Y/O ESCALERILLAS    -->
                            <h2>CANALETAS Y/O ESCALERILLAS<div class="ag" id="3"><h3>Agregar</h3></div></h2>
                            <?php echo tablas($folio,3); ?>
                            <table style="margin:-11px 0 20px">
                                <tr>
                                    <th>COMENTARIOS</th>
                                </tr>
                                <tr>
                                    <td><textarea id="infCA_coment" name="infCA_coment"></textarea></td>
                                </tr>
                            </table>
                            <div style="width:1000px;height:1px;background:#aaa;border-bottom:1px #ccc solid;margin:0 0 19px"></div>
                            <!--    DFO    -->
                            <h2>DFO<div class="ag" id="4"><h3>Agregar</h3></div></h2>
                            <?php echo tablas($folio,4); ?>
                            <table style="margin-top:-11px">
                                <tr>
                                    <th class="t" colspan="9">UBICACI&Oacute;N INTER BDFO</th>
                                </tr>
                                <tr>
                                    <td class="t">Punta</td>
                                    <td class="t">Ubicaci&oacute;n BDFO</td>
                                    <td class="t" style="width:50px">DFO</td>
                                    <td class="t">Posici&oacute;n de Remate</td>
                                    <td class="t">Tipo Conector Equipo</td>
                                    <td class="t">Tipo De Fibra</td>
                                    <td class="t">Cantidad de Fibras</td>
                                    <td class="t">Tipo Conector lado DFO</td>
                                    <td class="t">Long. de Cable</td>
                                </tr>
                                <tr>
                                    <td class="t2">A</td>
                                    <td class="t2"><input type="text" name="abdfo" class="c8"/></td>
                                    <td class="t2"><input type="text" name="a_dfo" class="c9"/></td>
                                    <td class="t2"><input type="text" name="aprmt" class="ca"/></td>
                                    <td class="t2"><input type="text" name="atcoe" class="cb"/></td>
                                    <td class="t2"><input type="text" name="atfbr" class="cc"/></td>
                                    <td class="t2"><input type="text" name="acfbr" class="cd"/></td>
                                    <td class="t2"><input type="text" name="atcld" class="ce"/></td>
                                    <td class="t2"><input type="text" name="alocl" class="cf"/></td>
                                </tr>
                                <tr>
                                    <td class="t2">B</td>
                                    <td class="t2"><input type="text" id="bbdfo" name="bbdfo" class="c8"/></td>
                                    <td class="t2"><input type="text" id="b_dfo" name="b_dfo" class="c9"/></td>
                                    <td class="t2"><input type="text" id="bprmt" name="bprmt" class="ca"/></td>
                                    <td class="t2"><input type="text" id="btcoe" name="btcoe" class="cb"/></td>
                                    <td class="t2"><input type="text" id="btfbr" name="btfbr" class="cc"/></td>
                                    <td class="t2"><input type="text" id="bcfbr" name="bcfbr" class="cd"/></td>
                                    <td class="t2"><input type="text" id="btcld" name="btcld" class="ce"/></td>
                                    <td class="t2"><input type="text" id="blocl" name="blocl" class="cf"/></td>
                                </tr>
                            </table>
                            <table style="margin:-11px 0 20px">
                                <tr>
                                    <th>COMENTARIOS</th>
                                </tr>
                                <tr>
                                    <td><textarea id="infDFO_coment" name="infDFO_coment"></textarea></td>
                                </tr>
                            </table>
                            <div style="width:1000px;height:1px;background:#aaa;border-bottom:1px #ccc solid;margin:0 0 19px"></div>
                            <!--    DG    -->
                            <h2>DG<div class="ag" id="5"><h3>Agregar</h3></div></h2>
                            <?php echo tablas($folio,5); ?>
                            
                            <table style="margin:-11px 0 20px">
                                <tr>
                                    <th>COMENTARIOS</th>
                                </tr>
                                <tr>
                                    <td><textarea id="infDG_coment" name="infDG_coment"></textarea></td>
                                </tr>
                            </table>
                            <div style="width:1000px;height:1px;background:#aaa;border-bottom:1px #ccc solid;margin:0 0 19px"></div>
                            <!--    ETIQUETADO    -->
                            <h2>ETIQUETADO<div class="ag" id="6"><h3>Agregar</h3></div></h2>
                            <?php echo tablas($folio,6); ?>
                            <table style="margin:-11px 0 20px">
                                <tr>
                                    <th>COMENTARIOS</th>
                                </tr>
                                <tr>
                                    <td><textarea id="infEQ_coment" name="infEQ_coment"></textarea></td>
                                </tr>
                            </table>
                            <div style="width:1000px;height:1px;background:#aaa;border-bottom:1px #ccc solid;margin:0 0 19px"></div>
                            <!--    INSTALACION/DESMONTAJE    -->
                            <h2>INSTALACION / DESMONTAJE<div class="ag" id="7"><h3>Agregar</h3></div></h2>
                            <?php echo tablas($folio,7); ?>
                            <table style="margin:-11px 0 20px">
                                <tr>
                                    <th>COMENTARIOS</th>
                                </tr>
                                <tr>
                                    <td><textarea id="infID_coment" name="infID_coment"></textarea></td>
                                </tr>
                            </table>
                            <div style="width:1000px;height:1px;background:#aaa;border-bottom:1px #ccc solid;margin:0 0 19px"></div>
                            <!--    OBRA CIVIL    -->
                            <h2>OBRA CIVIL<div class="ag" id="8"><h3>Agregar</h3></div></h2>
                            <?php echo tablas($folio,8); ?>                            
                            <table style="margin:-11px 0 20px">
                                <tr>
                                    <th>COMENTARIOS</th>
                                </tr>
                                <tr>
                                    <td><textarea id="infOC_coment" name="infOC_coment"></textarea></td>
                                </tr>
                            </table>
                            <div style="width:1000px;height:1px;background:#aaa;border-bottom:1px #ccc solid;margin:0 0 19px"></div>
                            <!--    RDA    -->
                            <h2>RDA<div class="ag" id="9"><h3>Agregar</h3></div></h2>
                            <?php echo tablas($folio,9); ?>
                            <table style="margin:-11px 0 20px">
                                <tr>
                                    <th>COMENTARIOS</th>
                                </tr>
                                <tr>
                                    <td><textarea id="infRDA_coment" name="infRDA_coment"></textarea></td>
                                </tr>
                            </table>
                            <div style="width:1000px;height:1px;background:#aaa;border-bottom:1px #ccc solid;margin:0 0 19px"></div>
                            <!--    TIERRA    -->
                            <h2>TIERRA<div class="ag" id="10"><h3>Agregar</h3></div></h2>
                            <?php echo tablas($folio,10); ?>
                            <table style="margin:-11px 0 20px">
                                <tr>
                                    <th>COMENTARIOS</th>
                                </tr>
                                <tr>
                                    <td><textarea id="infTR_coment" name="infTR_coment"></textarea></td>
                                </tr>
                            </table>
                            <div style="width:1000px;height:1px;background:#aaa;border-bottom:1px #ccc solid;margin:0 0 19px"></div>
                            <!--    OTROS MATERIALES    -->
                            <h2>OTROS MATERIALES<div class="ag" id="11"><h3>Agregar</h3></div></h2>
                            <?php echo tablas($folio,11); ?>
                            <table style="margin:-11px 0 20px">
                                <tr>
                                    <th>COMENTARIOS</th>
                                </tr>
                                <tr>
                                    <td><textarea id="infOTS_coment" name="infOTS_coment"></textarea></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div id="tabs-3">
                        <div class="conttwo">
                            <h2>AGREGAR ARCHIVOS</h2>
                            <div class="contplanos">
                                <!--<div id="upload_button">Subir Archivo</div>-->
                                <button id="upload_button" name="upload_button">Subir Archivo</button>
                                <div id="ld"><img src="img/load.gif"/></div>
                                <ul id="zip"><?php echo $files[0]; ?></ul>
                            </div>
                            <div style="clear:both"></div>
                            <h2>AGREGAR IMAGENES</h2>
                            <div class="contplanos">
                                <!--<div id="upload_image">Subir Archivo</div>-->
                                <button id="upload_image" name="upload_image">Subir Imagen</button>
                                <div id="ld2"><img src="img/load.gif"/></div>
                                <ul id="image"><?php echo $files[1]; ?></ul>
                            </div>
                                <div style="clear:both"></div>
                                <div class="COMENTARIOS">
                                <table>
                                    <tr><th>COMENTARIOS</th></tr>
                                    <tr>
                                        <td>
                                            <textarea id="final_coment" name="pl_final_coment"></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="nueq" name="nueq" value="<?php echo $numeq ?>"/>
                <input type="hidden" id="folio" name="folio" value="<?php echo $folio ?>"/>
                <input type="hidden" id="fecha_ejecucion" name="fecha_ejecucion" value="<?php echo $datos[7] ?>"/>
                <input type="hidden" id="flag" name="flag" value="0"/>
                <input type="hidden" id="copias" name="copias" value="0"/>
                <input type="submit" id="save" name="save" value="Guardar y continuar"/>
                <input type="submit" id="enviar" name="enviar" value="Enviar a validacion"/>                
            </div>
        </form>
    </body>
</html>