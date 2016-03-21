<?php
$archivo = $_GET["ruta"];
switch ($_GET["ruta2"]){
	case 1 :
		$path = "archivos/OTs/OT_fo/"; 
	break;
	case 2 :
		$path = "archivos/Proyectos_fo/";
	break;
}			
$ruta = $path.$archivo;

$datos_archivos=explode("/", $ruta);

$ruta=trim($ruta);

	if(count($datos_archivos)==4){
				$numero=count($datos_archivos)-1;
				//echo $numero;
				rtrim($nombre_archivo=$datos_archivos[$numero]);
				//echo $nombre_archivo;
	}


	if(count($datos_archivos)==3){
				$numero=count($datos_archivos)-1;	
				//echo $numero;
				rtrim($nombre_archivo=$datos_archivos[$numero]);
				//echo $nombre_archivo;	
	 }

$direccion_1 = $ruta;
$direccion_1_localizar=substr($direccion_1,1);
$direccion_2=str_replace("/", "\\", $direccion_1);

if (file_exists($direccion_2)) {
$ext=explode(".", $nombre_archivo);
//echo $nombre_archivo;
//echo $ext[1];
//switch(trim($ext[1]))  
//{
//  case "pdf": $ctype="application/pdf"; break;
//  case "exe": $ctype="application/octet-stream"; break;
//  case "zip": $ctype="application/zip"; break; 
//  case "txt": $ctype="application/txt"; break;
//  case "rar": $ctype="application/rar"; break;
//  case "doc": $ctype="application/msword"; break;
//  case "xls": $ctype="application/vnd.ms-excel"; break;
//  case "csv": $ctype="application/vnd.ms-excel"; break;
//  case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
//  case "pptx": $ctype="application/vnd.openxmlformats-officedocument.presentationml.presentation"; break;
//  case "docx": $ctype="application/vnd.openxmlformats-officedocument.wordprocessingml.document"; break;
//  case "docx": $ctype="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"; break;
//  default: $ctype
//}
 //echo $ctype; 
//
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=".$nombre_archivo);
header("Content-Transfer-Encoding: binary");
readfile($direccion_2);

}
else{
	//echo "error en  la ruta";
	}

?>