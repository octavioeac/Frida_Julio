<?php
//	$host = '10.105.59.73';
//	$user = 'frida_oalvarez';
//	$pass = 'fridaoctavio123';
//	$remote_file = '/archivozip/SampleData.zip';
	$nombre_archivo_local="http://colaboracion/telmex/ku/SUMTRO/avance/Reportes%20de%20Altas%20y%20Bajas%20de%20Ladaenlaces%20Pendiente/ALTAS%20BAJAS%20PENDIENTES%20140423%200000%20hrs.zip";
//	$local_file = $_SERVER['DOCUMENT_ROOT'] . '/documentoserver/'.$nombre_archivo_local;

echo file_exists($nombre_archivo_local);
//var_dump($local_file);
//var_dump($_SERVER['HTTP_HOST']);
//$conn = @ftp_connect($host);

//	if (!$conn)
//	{
//		echo 'Error al tratar de conectar con ' . $host . "\n";
//		exit();
//	}
	
//$login = @ftp_login($conn, $user, $pass);

//	if($login==true)
//	{
//		echo 'Conectado con ' . $host . "\n";	
//		echo 'Conectado con el usuario ' . $user . "\n";
//		if(ftp_get($conn,$local_file,$remote_file,FTP_BINARY))
//		{
	
	
	
	
	
	
	
/*	
			$enzipado = new ZipArchive();
			$enzipado->open($nombre_archivo_local); //nombre del archivo
			$extraido = $enzipado->extractTo("descomprimir/");
				if($extraido == TRUE)
				{
					for ($x = 0; $x < $enzipado->numFiles; $x++)
					{
						$archivo = $enzipado->statIndex($x);
						// var_dump($archivo['name']);
						$extension=".xls";
						$extension2=".xlsx";
							if(strstr($archivo['name'],$extension)||strstr($archivo['name'],$extension2))
							{
								echo "extensión java encontrada";
								echo 'Extraido: '.$archivo['name'].'</br>';
							}
						// echo 'Extraido: '.$archivo['name'].'</br>';
					}
					echo $enzipado->numFiles ." archivos descomprimidos en total";
				} else {
					echo 'Ocurrió un error y el archivo no se pudó descomprimir';
				}
*/				
				
				
				
				
				
				
		//} else {
//			echo "no se descargo";
//		}
//	}
//	if (!$login)
//	{
//		echo 'Error al intentar acceder con el usuario ' . $user;
//		ftp_quit($conn);
//		exit(); 
//	}
?>