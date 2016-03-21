<?php
$uploadFile="uploadArchivosTemp/".$_POST['Archivo_a_borrar'];	
unlink($uploadFile);

?>