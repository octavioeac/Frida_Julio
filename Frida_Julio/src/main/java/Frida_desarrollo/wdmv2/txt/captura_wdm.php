<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>FRIDA | Alta WDM</title>
        <link rel="stylesheet" href="css/master.css"/>
        <link rel="stylesheet" href="css/ui/themes/frida/frida.min.css"/>
        <link rel="stylesheet" href="css/style.css"/>
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/jquery-ui-1.10.4.custom.min.js"></script>
        <script src="js/launcher.js"></script>
    </head>
    <body>
        <div class="header">
            <h1><a href="http://frida2/desarrollo/infinitum_v2/">F R I D A</a></h1>
            <h2>Alta WDM</h2>
        </div>
        <div class="wcont">
            <div class="cont900 down">
                <fieldset>
                    <legend>Informacion del WDM</legend>
                    <div class="row50">
                        <label>Proveedor</label>
                        <select id="proveedor" name="proveedor">
                            <option value="-">Seleccionar</option>
                        </select>
                    </div>
                    <div class="row50">
                        <label>Topologico</label>
                        <button class="dr">Crear Topologico Logico</button>
                    </div>
                    <div class="row50">
                        <label>Topologia WDM</label>
                        <select id="wdm" name="wdm" disabled></select>
                    </div>
                    <div class="row50">
                        <label>Anexos</label>
                        <button class="dr">Cargar Anexo</button>
                    </div>
                    <div class="row50">
                        <label>Nodo</label>
                        <select id="nodo" name="nodo" disabled></select>
                    </div>
                    <div class="row50">
                        <label>Estatus CNS del WDM</label>
                        <input type="text" id="estatuswdm" name="estatuswdm" readonly/>
                    </div>
                </fieldset>
            </div>
            <div class="cont900 down">
                <fieldset>
                    <legend>Informacion del Nodo</legend>
                    <div class="row50">
                        <label>Estatus CNS del Nodo</label>
                        <input type="text" id="estatusnodo" name="estatusnodo" readonly/>
                    </div>
                    <div class="row50">
                        <label>Modelo</label>
                        <input type="text"  id="modelo" name="modelo" readonly/>
                    </div>
                    <div class="row50">
                        <label>Repisa</label>
                        <input type="text"  id="repisa" name="repisa" readonly/>
                    </div>
                    <div class="row50">
                        <label>Release</label>
                        <input type="text"  id="release" name="release" readonly/>
                    </div>
                    <div class="row50">
                        <label>Nodo</label>
                        <input type="text"  id="nododos" name="nododos" readonly/>
                    </div>
                    <div class="row50">
                        <label>Ubicacion</label>
                        <input type="text"  id="ubicacion" name="ubicacion"/>
                    </div>
                    <div class="row50">
                        <label>CLLI</label>
                        <input type="text"  id="clli" name="clli" readonly/>
                    </div>
                    <div class="row50">
                        <label>IP</label>
                        <input type="text"  id="ip" name="ip"/>
                    </div>
                    <div class="row50">
                        <label>Siglas</label>
                        <input type="text"  id="siglas" name="siglas" readonly/>
                    </div>
                    <div class="row50">
                        <label>NEID</label>
                        <input type="text"  id="neid" name="neid"/>
                    </div>
                    <div class="row50">
                        <label>ID Nodo</label>
                        <input type="text"  id="idnodo" name="idnodo" readonly/>
                    </div>
                    <div class="row50">
                        <label>OT</label>
                        <button class="dr">OT</button>
                    </div>
                </fieldset>
            </div>
            <div class="cont900 down">
                <div class="lst">
                    <div class="one ttl">Alta tarjetas</div>
                    <div class="four">Repisa</div>
                    <div class="four">Modelo tarjeta</div>
                    <div class="four">Slot</div>
                    <div class="four c">Agregar/Borrar</div>
                    <div class="four"><select></select></div>
                    <div class="four"><select></select></div>
                    <div class="four"><select></select></div>
                    <div class="four"></div>
                    <div class="one ttl up">Tarjetas configuradas</div>
                </div>
                <div class="lst tarjetas"></div>
            </div>
            <div class="cont900 down">
                <div class="lst">
                    <div class="one ttl">Informacion de puertos</div>
                    <!--<div class="eight">Tipo de pto.</div>
                    <div class="eight">Ub. BDFO</div>
                    <div class="eight">Repisa</div>
                    <div class="eight">Remates</div>
                    <div class="eight">Conector</div>
                    <div class="eight">Longitud</div>
                    <div class="eight">Jumper</div>
                    <div class="eight">Lambda</div>
                    <div class="eight"><select></select></div>
                    <div class="eight"><input type="text"/></div>
                    <div class="eight"><input type="text"/></div>
                    <div class="eight"><input type="text"/></div>
                    <div class="eight"><select></select></div>
                    <div class="eight"><select></select></div>
                    <div class="eight"><select></select></div>
                    <div class="eight"><input type="checkbox"/></div>-->
                    <div class="six">Puerto L&oacute;gico</div>
                    <div class="six">Puerto F&iacute;sico</div>
                    <div class="six">Frecuencia Lambda</div>
                    <div class="six">Capacidad</div>
                    <div class="six">Alcance/Servicio</div>
                    <div class="six c">Agregar/Borrar</div>
                    <div class="six"><select></select></div>
                    <div class="six"><select></select></div>
                    <div class="six"><select></select></div>
                    <div class="six"><select></select></div>
                    <div class="six"><select></select></div>
                    <div class="six"></div>
                    <div class="one ttl up">Puertos Configurados</div>
                </div>
                <div class="lst puertos"></div>
            </div>
        </div>
    </body>
</html>