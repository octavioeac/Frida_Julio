<?php
function lastPDF($archivo){
    $origen = '../../Archivos/'.$archivo;
    $destino = 'G:\\Archivos\\SiteSurvey\\'.$archivo;
    if(rename($origen,$destino)){
        unlink($origen);
        return $archivo;
    }
    return 'ERROR En archivo PDF';
}