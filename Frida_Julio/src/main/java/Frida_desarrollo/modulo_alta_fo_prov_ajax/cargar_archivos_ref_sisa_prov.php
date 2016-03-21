<?php
include("../conexion.php");
$ref = $_REQUEST['referencia_sisas'];
$pt = $_REQUEST['envia_punta'];

$query_buscar="select bandera_archivos from construccion_fo where ref_sisa='".$_REQUEST['referencia_sisas']."' 
and punta='".$_REQUEST['envia_punta']."'";
$resultado_query= mysql_query($query_buscar)or die(mysql_error());
$resultado_Row=mysql_fetch_assoc($resultado_query);
$bandera_archivos=$resultado_Row['bandera_archivos'];

     $max_size = 103000000;       
      $miarchivo="cargar_archivos_ref_sisa_prov.php";
	$archivo=$_FILES["archivo"]['name'];
     if($archivo !="")
	 {
		 // var_dump($_FILES);
//		  $ruta = "uploadArchivosTemp/"; 
							  if ($bandera_archivos=='OT_ANEXO')
							  { 
   		                           $ruta_A = "../archivos/OTs/OT_fo/"; 
								   $ruta="G:\\archivos\\OTs\\OT_fo\\";
							  }
		    					  if ($bandera_archivos!='OT_ANEXO')	 
								{ 
     							  $ruta = "../archivos/Proyectos_fo/"; 
								  $ruta="G:\\archivos\\Proyectos_fo\\";
								}					
						
						if (is_uploaded_file($_FILES['archivo']['tmp_name']))
						{
								$noarch  = strtr($_FILES['archivo']['name'], "Ã¡Ã©Ã­Ã³ÃºÃ±", "aeioun");
								$noarch  = strtr($noarch, "áéíóúñ�?É�?ÓÚÑ ", "aeiounAEIOUN-");
								$separa1 = explode(".",$noarch);
								$noarch  = trim($separa1[1]);		
								$con_a =$_REQUEST['referencia_sisas'].'_'.$bandera_archivos.'_LADO'.$_REQUEST['envia_punta'];
								$con_nombre = $con_a.".".$noarch;
								$nombre_archivo="$ruta/$con_nombre";
								//echo $nombre_archivo;
								move_uploaded_file($_FILES['archivo']['tmp_name'],"$nombre_archivo");		
					   	$mysql_arc_bit = "select * from bitacora_archivos where referencia='".$_REQUEST['referencia_sisas']."' and opcion='LADO".$_REQUEST['envia_punta']."' and trafico='".$bandera_archivos."'    ";
						$query_arc_bit = mysql_query($mysql_arc_bit);
						
						if (mysql_num_rows($query_arc_bit)=='')
						{
						$query_arch ="insert into bitacora_archivos 
						(referencia, fecha, usuario, accion, trafico, opcion, nom_arch, observaciones, size_archivo ) 
						VALUES('".$_REQUEST['referencia_sisas']."', NOW(), '$sess_nmb', 'CARGA ARCHIVO', '".$bandera_archivos."', 
						'LADO".$_REQUEST['envia_punta']."', '".$con_nombre."', CONCAT('|', NOW(),', USUARIO: $sess_usr',',
						 CARGA DE ARCHIVO', observaciones ),'".$_FILES['archivo']['size']." Kb' )"; 
						mysql_query($query_arch);
						echo "<script>
						alert('Archivo ".$con_nombre." dado de alta correctamente.');
						 location.href = 'tabla_carga_archivos_fo_prov.php?ref_sisa_a=".$ref."&envia_punta=".$pt."';
						  </script>";
						}
						else
						{
						$query_arch_up ="update bitacora_archivos set fecha=NOW(), 
						usuario='$sess_nmb',
						 accion='CARGA ARCHIVO',
						 nom_arch='".$con_nombre."', 
						observaciones=concat('|', now(),', USUARIO: $sess_usr',', CARGA DE ARCHIVO', observaciones ),
						 size_archivo='".$_FILES['archivo']['size']." Kb' 
						where referencia='".$_REQUEST['referencia_sisas']."' and opcion='LADO".$_REQUEST['envia_punta']."'
						 and trafico='".$bandera_archivos."'   "; 
						 //echo $query_arch_up;
						mysql_query($query_arch_up);
						echo "<script>
						alert('Archivo ".$con_nombre." actualizado correctamente.'); 
						location.href = 'tabla_carga_archivos_fo_prov.php?ref_sisa_a=".$ref."&envia_punta=".$pt."';
						</script>";													
						}		
					     /*	echo "<script type=\"text/javascript\">alert(\"Archivo ".$_FILES['name']." subido con exito\");
							location.href = \"http://frida2/desarrollo/infinitum_v2/tabla_carga_archivos_fo_prov.php\";
								</script>";  */
	                    }
						
	 }
		else
		{
		echo "<script type=\"text/javascript\">alert(\"Archivo vacio\");
		location.href = 'tabla_carga_archivos_fo_prov.php?ref_sisa_a=".$ref."&envia_punta=".$pt."';
		</script>";  
			
		}	 
			 



?>