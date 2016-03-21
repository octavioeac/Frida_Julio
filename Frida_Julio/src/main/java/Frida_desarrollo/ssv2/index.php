<?php
    session_start();
    unset($_SESSION['folio']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Formato de captura Site Survey</title>
        <link rel="stylesheet" href="css/wintwo.css" type="text/css"/>
        <link rel="stylesheet" href="css/header.css" type="text/css"/>
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/startw2.js"></script>
        <script>
            
        </script>
        <!--[if IE]>
        <style type="text/css">
        .cont{height:290px}
        </style>
        <![endif]-->
    </head>
    <body>
        <div id="header">
            <h1><a href="../inicio.php#site">F R I D A</a></h1>
            <h2>Acceso al formato de captura Site Survey</h2>
        </div>
        <form id="entrar" name="entrar" method="post" action="formato.php">
            <div class="cont">
                <fieldset>
                    <legend>Ingrese su folio</legend>
                    <label>Folio: </label>
                    <input type="text" id="folio" name="folio"/>
                    <button type="submit" id="entr" name="Entrar">Entrar</button>
                </fieldset>
                <span class="aviso"></span>
            </div>
        </form>
    </body>
</html>