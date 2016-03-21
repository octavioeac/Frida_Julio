<?
include("../conexion.php");
//$_SESSION['usr']="admin";
$query_buscar=
"select nom_arch,fecha,size_archivo,trafico FROM bitacora_archivos 
where referencia='".$_POST['referencia_sisas']."' 
and opcion='LADO".$_POST['envia_punt']."'";
$resultado_query= mysql_query($query_buscar)or die(mysql_error());

$cadena_html ="";

      $i=1; 
 while ($row_query_tabla=mysql_fetch_row($resultado_query)) {
	 
	   if ($row_query_tabla[3]=='OT_ANEXO')
							  { 	
   		                          	$ruta_2 = "1"; 
									$path = "../archivos/OTs/OT_fo/"; 
								    $path_absoluto="G:\\archivos\\OTs\\OT_fo\\";  
							  }
 if ($row_query_tabla[3]!='OT_ANEXO')						 
								{ 
									$ruta_2 = "2";
									$path = "../archivos/Proyectos_fo/"; 
									$path_absoluto="G:\\archivos\\Proyectos_fo\\";
								}			


$cadena_html .= "<tr  class='tabla_dato_archivos'  id='fila_borrar_archivo_".$i."' bgcolor='#ccdfe0'>";
$cadena_html .= "<td class='fila_archivo_".$i."' >".$i."</td>";
$cadena_html .= "<td style=\"text-align:center\">
<input type=\"hidden\" id='A_ruta_archivo_".$i."' 
type=\"text\" value=\" ".$path.$row_query_tabla[0]." \">
<input type=\"hidden\" id='ruta_archivo_".$i."' 
type=\"text\" value=\" ".$path_absoluto.$row_query_tabla[0]." \">
<span id='".$i."'  style='text-decoration:underline; color:#0000CC; font-size:16px;'>
<a href='descarga_archivos_referencia_sisa_fo_prov.php?ruta=".$row_query_tabla[0]."&ruta2=".$ruta_2."'>".$row_query_tabla[0]."
</a>
</span>
</td>";
$cadena_html .= "<td style=\"text-align:center\">".$row_query_tabla[1]."</td>";
$cadena_html .= "<td style=\"text-align:center\">".$row_query_tabla[2]."</td>";
$cadena_html .= "<td value=\"".$ruta_2.$row_query_tabla[0]."\" 
id='archivo_".$i."' class='borrar' onclick=\"javascript:borrar_filas(id);\" style='text-align:center;'>
<span style='text-decoration:underline; color:#0000CC; font-size:16px;'>Borrar</span>
</td>";
$cadena_html .= "</tr>";
      $i++; 
}
$cadena_html .="";
echo $cadena_html;
?>