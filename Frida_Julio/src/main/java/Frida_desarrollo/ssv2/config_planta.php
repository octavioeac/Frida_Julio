<?php 
    include("functions/conexion.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <style>
            body{font-family:Arial;margin:0;padding:0}
            h2{color:#000;font-size:12px}            
            table{background:#cae4ff;border:3px #999 solid;}
            table tr th{color:#c30;font-size:12px;font-weight:bold}
            table tr td{text-align:center;font-size:12px}
            table tr td.h{text-align:left;padding:10px 0 0}
        </style>
        <script src="js/jquery-1.9.1.min.js"></script>
        <script>
            //function devalor()
            $(document).ready(function(){
                var r,c,p,d,i,n,b;
                $('#rectificador').change(function(){
                    r = $(this).val();
                    if(r !== ''){
                        $('#configuracion').val(r);
                    }
                });
                $('#convertidor').change(function(){
                    c = $(this).val();
                    if(c !== ''){
                        $('#configuracion').val(r+'+'+c);
                    }
                });
                $('#capacidadPlanta').change(function(){
                    p = $(this).val();
                    if(p !== ''){
                        p = p+'+C';
                        $('#configuracion').val(r+'+'+c+'+'+p);
                    }
                });
                $('#distribucion').change(function(){
                    d = $(this).val();
                    if(d !== ''){
                        $('#configuracion').val(r+'+'+c+'+'+p+'+'+d);
                    }
                });
                $('#inversores').change(function(){
                    i = $(this).val();
                    if(i !== ''){
                        $('#configuracion').val(r+'+'+c+'+'+p+'+'+d+'+'+i);
                    }
                });
                $('#inversores').change(function(){
                    i = $(this).val();
                    if(i !== ''){
                        $('#configuracion').val(r+'+'+c+'+'+p+'+'+d+'+'+i);
                    }
                });
                $('#nobateria').change(function(){
                    n = $(this).val();
                    if(n !== ''){
                        $('#configuracion').val(r+'+'+c+'+'+p+'+'+d+'+'+i+'+'+n);
                    }
                });
                $('#catbateria').change(function(){
                    b = $(this).val();
                    if(b !== ''){
                        $('#configuracion').val(r+'+'+c+'+'+p+'+'+d+'+'+i+'+'+n+'x'+b);
                    }
                });
                $('#enviar').click(function(){
                    var conf = $('#configuracion').val();
                    //opener.document.getElementById('fz_cact').value=conf;
                    $('#fz_configplanta',opener.document).val(conf);
                    window.close();
                });
            });
        </script>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <table>
            <tr>
                <th>Configuraci&oacute;n de la Planta</th>
            </tr>
            <tr>
                <td>Rectificador</td>
                <td>Convertidor</td>
                <td>Capacidad de Planta</td>
                <td>Control</td>
                <td>Distribuci&oacute;n</td>
                <td>Inversores</td>
                <td colspan="2">B&aacute;teria</td>
            </tr>
            <tr>
                <td>
                    <select id="rectificador" name="rectificador">
                        <option value>---Rectificador---</option>
                        <?php 
                            for($i = 1; $i < 1000; $i++){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <select id="convertidor" name="convertidor">
                        <option>---Convertidor---</option>
                        <?php 
                            for($j = 1; $j < 100; $j++){
                                echo '<option value="'.$j.'">'.$j.'</option>';
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <select id="capacidadPlanta" name="capacidadPlanta">
                        <option>---Capacidad de Planta---</option>
                        <option value="33">33</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="400">400</option>
                    </select>
                </td>
                <td>
                    C
                </td>
                <td>
                    <select id="distribucion" name="distribucion">
                        <option>---Distribuci&oacute;n---</option>
                        <?php 
                            for($j = 1; $j < 100; $j++){
                                echo '<option value="'.$j.'">'.$j.'</option>';
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <select id="inversores" name="inversores">
                        <option>---Inversores---</option>
                        <?php 
                            for($j = 1; $j < 100; $j++){
                                echo '<option value="'.$j.'">'.$j.'</option>';
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <select id="nobateria" name="nobateria">
                        <option>---B&aacute;teria---</option>
                        <?php 
                            for($j = 1; $j < 100; $j++){
                                echo '<option value="'.$j.'">'.$j.'</option>';
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <select id="catbateria" name="catbateria">
                        <option>---Cat. b&aacute;teria---</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                        <option value="1000">1000</option>
                        <option value="2000">2000</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="h" colspan="8">Configuraci&oacute;n de la Planta</td>
            </tr>
            <tr>
                <td colspan="2"><h2>R + C + Cap. + Ctrl + D + Inv + Bat</h2></td>
                <td colspan="2"><input style="width:200px" type="text"  id="configuracion" name="configuracion" readonly/></td>
                <td><input type="submit" id="enviar" name="enviar" value="Enviar" /></td>
            </tr>
        </table>
    </body>
</html>
