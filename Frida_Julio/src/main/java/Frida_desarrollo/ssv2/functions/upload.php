<?php
require 'conexion.php';
require '../enlaces.php';
$uploaddir = $ruta_archivo;
$flag = 0;
$folio = $_POST['folio'];
$type = $_POST['tipo'];
$tipo = $_FILES['userfile']['type'];
$type = (int) $type;
$nombre = $_FILES['userfile']['name'];
$description = $type == 1 ? 'Fotos de Central' : '';

//$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
$original = array(' ', 'á', 'é', 'í', 'ó', 'ú','&','ñ','Ñ','Á','É','Í','Ó','Ú');
$nuevo = array('_', 'a', 'e', 'i', 'o', 'u','and','n','N','A','E','I','O','U');
$uploadfile = str_replace($original,$nuevo,$uploadfile);
$nombre = str_replace($original,$nuevo,$nombre);
$nombre = $folio.'_'.$nombre;
$uploadfile = $uploaddir.$nombre;
if(!file_exists($uploadfile)){
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)){
        $flag = 1;
    }
    else {
        $flag = 0;
    }
}
else{
    $i = 0;
    do{
        $alt = rand(000,999);
        $nombre = str_replace('.','-'.$alt.'.',$nombre);
        $uploadfile = $uploaddir.$nombre;
        if(!file_exists($uploadfile)){
            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)){
                $i = 0;
                $flag = 1;
            }
            else{
                $i = 1;
                $flag = 0;
            }
        }
    }
    while($i > 0);
}
//GUARDAR EN LA BASE DE DATOS application/x-zip-compressed
if($flag == 1){
    $dir_file_def = '../../../anexos/SiteSurvey/'.$nombre;
    $uploadfile = substr($uploadfile, 3);
    $altafile = "INSERT INTO zarchivos VALUES (id,'".$folio."',(select version from zsite_survey where folio='".$folio."'),'".$nombre."','".$dir_file_def."','".$tipo."',\"".$description."\")";
    mysql_query($altafile);
}
//CONSULTAR ULTIMO FOLIO
$max = mysql_query("SELECT MAX(id) FROM zarchivos;");
$max = mysql_fetch_array($max, MYSQL_BOTH);
$max = $max[0];
//SALIDA
if($type == 0){
    //$salida = '<li id="f'.$max.'"><div class="nm"><a id="'.$max.'" href="../Archivos/sitesurvey/'.$nombre.'">'.$nombre.'</a></div><div class="fmt">ZIP</div><div class="dl" onclick="dt(\'f'.$max.'\')"></div><div class="dsc" onclick="addesc('.$max.')"></div></li>';
    echo $salida = '<li id="f'.$max.'"><div class="nm"><a id="'.$max.'" href="../../anexos/SiteSurvey/'.$nombre.'">'.$nombre.'</a></div><div class="fmt">ZIP</div><div class="dl" onclick="dt(\'f'.$max.'\')"></div></li>';
}
else{
    //$salida = '<li id="i'.$max.'"><a rel="shadowbox[Mixed];" href="../../Archivos/sitesurvey/'.$nombre.'"><img id="'.$max.'" src="../Archivos/sitesurvey/'.$nombre.'"/></a><div class="dt" onclick="dt(\'i'.$max.'\')"></div><div class="dsc" onclick="addesc('.$max.')"></div></li>';
    echo $salida = '<li id="i'.$max.'"><a rel="shadowbox[Mixed];" href="../../anexos/SiteSurvey/'.$nombre.'"><img id="'.$max.'" src="../../anexos/SiteSurvey/'.$nombre.'"/></a><div class="dt" onclick="dt(\'i'.$max.'\')"></div></li>';
}