<?php
class descomprimir_zip{
	var $archivo_local;
	function deszipar($archivo){
$enzipado = new ZipArchive();
$enzipado->open($archivo);
$path=$_SERVER['HTTP_HOST']."/documentoserver/";
$extraido = $enzipado->extractTo($path);
/* Si el archivo se extrajo correctamente listamos los nombres de los
 * archivos que contenia de lo contrario mostramos un mensaje de error
*/
if($extraido == TRUE){
 for ($x = 0; $x < $enzipado->numFiles; $x++) {
 $archivo = $enzipado->statIndex($x);
 echo 'Extraido: '.$archivo['name'].'</br>';
 }
 echo $enzipado->numFiles ." archivos descomprimidos en total";
}
else {
 'Ocurrió un error y el archivo no se pudó descomprimir';
}
}
	
	
	}


?>