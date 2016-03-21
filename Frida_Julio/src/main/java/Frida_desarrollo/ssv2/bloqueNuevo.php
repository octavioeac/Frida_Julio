<!--
To change this template, choose Tools | Templates
and open the template in the editor. | 18 Julio 2013
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Agregar Bloque</title>
        <style>
            body{
                width:640px;
                height:480px;
                font-family:Arial;
            }
            .contenedor{
                width:600px;
                height:100px;
                border:2px #999 solid;
                background:#cae4ff;
                padding:10px;
            }
            .contenedor fieldset{
                border:1px #006 solid;
                margin:0;
                padding:10px;
            }
            .contenedor fieldset legend{
                color:#006;
                font-weight:bold;
                font-size:13px;
            }
            .contenedor fieldset label,.contenedor fieldset input,.contenedor fieldset select{
                display:block;
            }
            .contenedor fieldset label{
                margin:0;
                padding:0;
                font-size:13px;
            }
        </style>
    </head>
    <body>
        <div class="contenedor">
            <fieldset>
                <legend>Seleccione una categor&iacute;a</legend>
                <label>Categor&iacute;a</label>
                <select>
                    <option value="-">Seleccionar</option>
                    <option value="ESCALERILLA">Escalerilla</option>
                    <option value="CANALETA">Canaleta</option>
                    <option value="BASTIDOR">Bastidor</option>
                </select>
            </fieldset>
        </div>
    </body>
</html>
