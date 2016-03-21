<?php
include("../conexion.php");
if($_POST['archivo']!=""){
$datos_archivos=explode("\\", $_POST['archivo']);
$ruta_sin_blanco=ltrim($_POST['archivo']);
$ruta_sin_blanco_2=rtrim($ruta_sin_blanco);
//var_dump($datos_archivos);
if(count($datos_archivos)==5){
$numero=count($datos_archivos)-1;
//echo $numero;	
rtrim($nombre_archivo=$datos_archivos[$numero]);
//echo $nombre_archivo;
	}
if(count($datos_archivos)==4){
$numero=count($datos_archivos)-1;	
//echo $numero;
rtrim($nombre_archivo=$datos_archivos[$numero]);
//echo $nombre_archivo;	
	}
$bandera=file_exists($ruta_sin_blanco_2);
			if($bandera==true){
    $bandera_borrar=unlink($ruta_sin_blanco_2);
			       if( $bandera_borrar==true){
				    $borrar_archivo="delete from bitacora_archivos 
					where referencia='".$_POST['referencia_sisas']."' 
                    and opcion='LADO".$_POST['envia_punt']."'
                    and nom_arch='".$nombre_archivo."'";
					$borrar_file_query=mysql_query($borrar_archivo);
					//echo $borrar_archivo;
					if($borrar_file_query==1){
					       $bus_archivo="select * from bitacora_archivos 
					where referencia='".$_POST['referencia_sisas']."' 
                    and opcion='LADO".$_POST['envia_punt']."'
                    and nom_arch='".$nombre_archivo."'";
					$busc_file_query=mysql_query($borrar_archivo);
						 if($busc_file_query==true){
							echo "Exito al borrar el archivo ".$nombre_archivo." "; 	   	 
							 }  
						   else{
							    echo "Error al borrar el archivo ".$nombre_archivo." "; 	  
							   }
						   
						    
						}
		             
					   }	
				   else{
				       echo "Error al borrar el archivo ".$nombre_archivo." "; 	   
					   }
				   
				
				}
			else{
				echo "Error al borrar el archivo ".$nombre_archivo." ";
			
				}
				}
	
	
else{
	echo "Error al borrar el archivo ".$nombre_archivo." ";

}

?>