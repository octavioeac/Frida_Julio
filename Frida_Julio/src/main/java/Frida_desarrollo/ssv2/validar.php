<?php
    session_start();
    include '../perfiles.php';
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
        <title>Validaci&oacute;n de fecha Site Survey</title>
        <link rel="stylesheet" href="css/cupertino/jquery-ui-1.10.3.custom.min.css" type="text/css"/>
        <link rel="stylesheet" href="css/wintwo.css" type="text/css"/>
        <link rel="stylesheet" href="css/header.css" type="text/css"/>
        <link rel="stylesheet" href="css/jquery.timepicker.css" type="text/css"/>
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="js/jquery.timepicker.min.js"></script>
        <script>
            $(function(){
                $('#timepicker').timepicker({scrollDefault:'now',timeFormat:'H:i:s'});
                $( "#datepicker" ).datepicker({
                    inline:true,
                    dateFormat:'yy-mm-dd',
                    closeText: 'Cerrar',
                    prevText: '&#x3c;Ant',
                    nextText: 'Sig&#x3e;',
                    currentText: 'Hoy',
                    monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
                    dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
                    dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
                    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;']
                });
            });
        </script>
        <!--[if IE]>
        <style type="text/css">
            .cont fieldset legend,.cont fieldset input{margin:0 0 5px -7px}
        </style>
        <![endif]-->
    </head>
    <body>
        <div id="header">
            <h1><a href="../inicio.php#site">F R I D A</a></h1>
            <h2>Confirmar fecha de realizaci&oacute;n Site Survey</h2>
        </div>
        <?php
        if(!isset($_GET['f'])){
            if(!isset($_POST['fecha_aprobada'])){
                ?>
                <div class="cont">
                    <h1>Fecha de realizaci&oacute;n Site Survey</h1>
                    <span class="aviso2">
                        <div id="error">No hay fecha por validar, revise la ruta de acceso.</div>
                    </span>
                </div>
                <?php
            }
            else {
                $nu_date = $_POST['fecha_aprobada'];
                $nu_hour = $_POST['hora_aprobada'];
                $sitio = $_POST['nsitio'];
                $folio = $_POST['folio'];
				
                $vj_nombre = $_POST['hct_nombre'];
                $vj_telefono = $_POST['hct_telefono'];
                $vj_email = $_POST['hct_email'];
                $id_ctl = $_POST['id_ctl'];
                $nv_nombre = trim(tildeReplace($_POST['ct_nombre']));
                $nv_telefono = trim($_POST['ct_telefono']);
                $nv_email = trim($_POST['ct_email']);
                $usr = $_POST['usr'];
				
                /*	CAMBIO DE CORREO ELECTRONICO	*/
                $query = "UPDATE zsite_survey SET fecha_programada = '".$nu_date." ".$nu_hour."', estatus = 'POR REALIZAR' WHERE folio = '".$folio."'";
                $ob = new Observaciones($folio,1,$usr);
                if(!mysql_query($query)){
                ?>
                <div class="cont">
                    <h1>Fecha de realizaci&oacute;n Site Survey</h1>
                    <span class="aviso">
                        <div id="error">Error durante la programaci&oacute;n, intente de nuevo.</div>
                    </span>
                </div>
                <?php
                }
                else{
                    if($vj_email != $nv_email){
                        $insert="INSERT INTO zccemails VALUES(id,'".$folio."','".$vj_nombre."','".$vj_email."')";
                        mysql_query($insert);

                        $updatedos="UPDATE zsite_survey SET ctnombre='".$nv_nombre."',cttelefono='".$nv_telefono."',ctemail='".$nv_email."' WHERE folio='".$folio."'";
                        mysql_query($updatedos);
                    }
                    $nu_date .= ' '.$nu_hour;
                    mailconfirm($folio);
                ?>
                <div class="cont">
                    <h1>Fecha de realizaci&oacute;n Site Survey</h1>
                    <span class="aviso2">
                        <div id="success">Site Survey programado exitosamente</div>
                    </span>
                </div>
                <?php
                }
            }
        }
        else{
        $folio = trim($_GET['f']);
        $busca_fecha = mysql_query("SELECT centrales.edificio,date(zsite_survey.fecha_solicitud),date(zsite_survey.fecha_programada),time(zsite_survey.fecha_programada),zsite_survey.punto_reunion,zsite_survey.ctnombre,zsite_survey.cttelefono,zsite_survey.ctemail,zsite_survey.id_central,zsite_survey.estatus FROM zsite_survey, centrales where zsite_survey.folio = '".$folio."' AND centrales.id_ctl = zsite_survey.id_central;");
            if(mysql_num_rows($busca_fecha) > 0){
                $nsitio = mysql_result($busca_fecha,0,0);
                $fecha_solicitud = mysql_result($busca_fecha,0,1);
                $fecha_programada = mysql_result($busca_fecha,0,2);
                $hora_solicitud = mysql_result($busca_fecha,0,3);
                $punto_reunion = mysql_result($busca_fecha,0,4);
                $ct_nombre = mysql_result($busca_fecha,0,5);
                $ct_telefono = mysql_result($busca_fecha,0,6);
                $ct_email = mysql_result($busca_fecha,0,7);
                $id_ctl = mysql_result($busca_fecha,0,8);
                $estatus = mysql_result($busca_fecha,0,9);
                if($estatus == 'SOLICITADO'){
                //if($fecha_programada == NULL || $fecha_programada == '0000-00-00'){
                    if(!isset($_POST['fecha_aprobada'])){
                    //echo 'La fecha que propuso el proveedor es la siguiente: '.$fecha_solicitud;
                ?>
                <div class="cont">
<!--                    <h1>Fecha de realizaci&oacute;n Site Survey</h1>-->
                    <form name="validar" method="post" action="validar.php">
                        <fieldset>
                            <legend>Fecha de realizaci&oacute;n Site Survey</legend>
                            <label style="width:500px;margin:0 0 10px 2px">Para cambiar la fecha propuesta, de clic en la caja de texto y elija otra fecha.</label>
                            <div style="clear:both"></div>
                            <label>Fecha: </label><input id="datepicker" type="text" name="fecha_aprobada" value="<?php echo $fecha_programada ?>"/>
                            <label>Hora: </label><input id="timepicker" type="text" name="hora_aprobada" value="<?php echo $hora_solicitud ?>"/>
                            <button type="submit" name="Enviar">Confirmar Fecha</button>
                            <div style="clear:both"></div>
                            <textarea id="punto_reunion" style="float:left;width:100%;margin:20px 0 0"><?php echo $punto_reunion ?></textarea>
                            <input type="hidden" name="folio" value="<?php echo $folio ?>"/>
                            <input type="hidden" name="nsitio" value="<?php echo $nsitio ?>"/>
                            <input type="hidden" name="usr" value="<?php echo $_SESSION['usr'] ?>"/>
                        </fieldset>
                        <div style="clear:both"></div>
                        <fieldset style="margin-top:80px">
                            <legend>Modificar contacto</legend>
                            <label style="width:120px">Nombre: </label><input type="text" name="ct_nombre" value="<?php echo $ct_nombre?>"/>
                            <div style="clear:both"></div>
                            <label style="width:120px">Telefono: </label><input type="text" name="ct_telefono" value="<?php echo $ct_telefono?>"/>
                            <div style="clear:both"></div>
                            <label style="width:120px">Correo Electronico: </label><input type="text" name="ct_email" value="<?php echo $ct_email?>"/>
                            <input type="hidden" name="hct_nombre" value="<?php echo $ct_nombre?>"/>
                            <input type="hidden" name="hct_telefono" value="<?php echo $ct_telefono?>"/>
                            <input type="hidden" name="hct_email" value="<?php echo $ct_email?>"/>
                            <input type="hidden" name="id_ctl" value="<?php echo $id_ctl?>"/>
                        </fieldset>
                    </form>
                </div>
                <?php
                    }
                    else{
                        echo 'fecha';
                    }
                }
                else{
                    ?>
                    <div class="cont">
                        <h1>Fecha de realizaci&oacute;n Site Survey</h1>
                        <span class="aviso">
                            <div id="alert" style="height:40px;width:485px;margin:65px auto 0 -360px">La fecha ya fue validada. La realizaci&oacute;n del Site Survey fue programada para el <?php echo datetransform($fecha_programada) ?></div>
                        </span>
                    </div>
                    <?php
                }
            }
            else{
                ?>
                <div class="cont">
                    <h1>Fecha de realizaci&oacute;n Site Survey</h1>
                    <div id="error">El folio al que intenta acceder no existe.</div>
                </div>
                <?php
            }
        }
        ?>
    </body>
</html>