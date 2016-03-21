<?php
include 'lastPDF.php';
$folio = $_GET['folio'];
$archivo = file_get_contents('http://10.94.143.193:8082/pdfmerge/servletPDF?file='.$folio);
if($archivo == 'Nulo' || $archivo == 'Archivo inexistente'){
    //echo 'ERROR En archivo PDF';
}
else{
    //echo lastPDF($archivo);
    lastPDF($archivo);
}