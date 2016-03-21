<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>F R I D A | Solicitud de Puertos</title>
        <link rel="stylesheet" href="css/master.css"/>
        <link rel="stylesheet" href="css/ui/themes/frida/frida.min.css"/>
        <script src="js/jquery-1.11.0.min.js"></script>
        <script src="js/jquery-ui-1.10.4.custom.min.js"></script>
        <script src="js/get.js"></script>
        <script src="js/carrier_broker_v2.js"></script>
        <style>#cbPtoTp{max-width:208px} .header{background-image:url('images/header1.jpg');width:800px;border:none}</style>
        <!--[if IE]>
            <style>select{width:206px}</style>
        <![endif]-->
    </head>
    <body>
        <div class="header">
            <h1><a href="inicio.php">F R I D A</a></h1>
            <h2>Solicitud de Puertos</h2>
        </div>
        <div class="wcont">
            <div class="cont900">
                <fieldset>
                    <legend>INFORMACION DEL CLUSTER - AGREGADOR</legend>
                    <div class="row50">
                        <label>Tipo de Nodo</label>
                        <select id="tipoNodo" name="tipoNodo">
                            <option value="-">Seleccionar</option>
                            <option value="Agregador">Agregador</option>
                            <option value="NDE">NDE</option>
                        </select>
                    </div>
                    <div class="row50"></div>                    
                    <div class="row50">
                        <label>Cluster</label>
                        <!--<input type="text" id="cluster" name="cluster"/>-->
                        <select id="cluster" name="cluster" disabled="disabled">
                            <option value="">Seleccionar</option>
                        </select>
                    </div>
                    <div class="row50">
                        <label  id="py"></label>
                        <!--<input type="text" class="uppercase" maxlength="25" id="id_nodo" name="id_nodo"/>-->
                        <select id="id_nodo" name="id_nodo" disabled="disabled"></select>
                        </div>
                    <div class="row50">
                        <label>Siglas Central</label><input type="text" class="uppercase" id="central" name="central" readonly="readonly"/>
                    </div>
                    <div class="row50"><label>Nombre Central</label><input type="text" id="nodo" name="nodo" readonly="readonly"/></div>
                    <div class="row50"><label>Proveedor</label>
                        <input type="text" id="proveedor" name="proveedor" readonly="readonly"/>
                        <!--<select id="proveedor" name="proveedor">
                            <option value="">Seleccionar</option>
                            <option value="ALCATEL">ALCATEL</option>
                            <option value="CISCO">CISCO</option>
                        </select>-->
                    </div>
                    <div class="row50"><label>Modelo</label><input type="text" id="modelo" name="modelo" readonly="readonly"/></div>
                    <div class="row100"></div>
                    <div class="row50">
                         <label>Tipo de Puerto (requerido)</label>
                         <select id="cbPtoTp" name="cbPtoTp" disabled></select>
                    </div>
                    <div class="row50"></div>
                    <div class="row50"><label>Tipo de Servicio</label>
                        <select id="tp_pto_req" name="tp_pto_req" disabled="disabled"></select>
                    </div>
                    <div class="row50"></div>
                    <div class="row50"><label>No. de Puertos</label>
                        <select id="no_pto_req" name="no_pto_req" disabled="disabled">
                            <option value="-">Seleccionar</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                    <div class="row50"><label>Puertos</label>
                        <select id="pto_req" name="pto_req" disabled="disabled">
                            <option value="-">Seleccionar</option>
                            <option value="Primary">Primary</option>
                            <option value="Secondary">Secondary</option>
                        </select>
                    </div>
                    <div class="row50"><label id="xna"></label><input type="text" class="uppercase" id="ref_sisa" name="ref_sisa" maxlength="13"/></div>                    
                    <div class="row50"></div>
                    <div class="row50"><button id="solicitar" name="solicitar">Solicitar Puerto</button></div>
                </fieldset>
            </div>
        </div>
        <input type="hidden" id="refsisa" name="refsisa" value=""/>
        <input type="hidden" id="nombreDispositivo" name="nombreDispositivo" value=""/>
        <input type="hidden" id="nombreDistribuidor" name="nombreDistribuidor" value=""/>
        <input type="hidden" id="centralName" name="centralName" value=""/>
        <input type="hidden" id="portType" name="portType" value="Agregador"/>
        <input type="hidden" id="serviceName" name="serviceName" value=""/>
        <input type="hidden" id="serviceType" name="serviceType" value=""/>
        <input type="hidden" id="serviceClass" name="serviceClass" value=""/>
        <input type="hidden" id="noOfPorts" name="noOfPorts" value=""/>
    </body>
</html>