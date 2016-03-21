<html>
<head>
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script>
var jq=jQuery.noConflict();

</script>
<link rel='stylesheet' href='../style.css'>
<style>
.font-archivo{
	font-family:"Arial Rounded MT Bold","Helvetica Rounded",Arial,sans-serif;
	color:#858585;
	font-size:10;
	padding:0;
	text-shadow:1px 2px 2px #A1A1A1;
	}
	.datos-archivo{
	font-family:"Arial Rounded MT Bold","Helvetica Rounded",Arial,sans-serif;
	color:#858585;
	font-size:9;
	padding:0;
	text-shadow:1px 2px 2px #A1A1A1;

	}
	.Estilo4 {color:#003399; font-weight:bold; font-size:11px; } <!-- Titulos -->
</style>
</head>
<center>
<body style="margin:0px; padding:0px; overflow:hidden; background-color:#CAE4FF" >

    <table  bordercolor="#CAE4FF" width="20%" bgcolor="#CAE4FF" >
      <tr>
         <form id="sendArchivo" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" >

         <td>
           
           <table width="100%"  bordercolor="#CAE4FF" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
             <tr  bordercolor="#CAE4FF" >
                <b class="Estilo4">Ajuntar archivo:</b><td  bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF"><input id="adjunta" type="file" name="fileup" onClick="javascript:ArchivoFile();"/>
                           <td  border="0" bgcolor="#CAE4FF" align="left" >
                <input id="BorrarArchivos" value="Borrar archivos" type="button"/></td>

        <td  bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left" >
                <input type="submit" name='submit' value="Adjuntar" id="subida_archivo"/></td>
             
             </tr>
                     </form>
     </table>
     <table  width="20%" bordercolor="#CAE4FF" bgcolor="#CAE4FF">
                  <tr>
<td bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF" width="100%" id="cargador"><img id="loader_serv" src="imagenesCargador/ajax-loader2.gif" style="background-color:none; width:540%; line-height:20px; height:20px" ></td>
             </tr>
     </table>
     
  <?php
    $uploadpath = 'uploadArchivosTemp/';       
    $max_size = 103000000;       
    $allowtype = array('doc', 'pdf', 'docx', 'xlsx', 'pptx', 'ppt', 'rar', 'zip', 'txt', 'dwg' , 'dxf');        // allowed extensions

    if ( isset( $_FILES['fileup'] ) && strlen( $_FILES['fileup']['name'] ) > 1 ) {
       $uploadpath = $uploadpath . basename( $_FILES['fileup']['name'] );               // gets the file name
       $sepext = explode('.', strtolower( $_FILES['fileup']['name'] ) );
       $type = end($sepext);       // gets extension
       list ( $width, $height ) = getimagesize( $_FILES['fileup']['tmp_name'] );       // gets image width and height
       $err = '';         // to store the errors

       // Checks if the file has allowed type, size, width and height (for images)

       if ( !in_array($type, $allowtype)) $err .= '<div id="informacion_archivo">El archivo: <b>'. $_FILES['fileup']['name']. '</b> No es una extensi&oacute;n valida.</div>';
       if ( $_FILES['fileup']['size'] > $max_size*1000) $err .= '<div id="informacion_archivo"><br/>Maximum file size must be: '. $max_size. ' KB.</div>';

       // If no errors, upload the image, else, output the errors

       if ( $err == '' ) {
          $i = 1;
          while ( file_exists( $uploadpath ) ) {
              //get filename without suffix
              $rootname = basename($_FILES['fileup']['name'], $type );
              $uploadpath = "uploadArchivosTemp/".$rootname."_$i." . $type;
              $i++;
			           }

          if ( move_uploaded_file( $_FILES['fileup']['tmp_name'], $uploadpath ) ) {
              echo "<div align='center' id='informacion_archivo'>";
			  echo '<p align="left" class="font-archivo">Archivo Cargado</p>';    
  			  echo "<table id='informacio_general'>
			  <tr>";
              echo '<td colspan="1" align="left"><b class="datos-archivo">Archivo:</br></b><b id="nombre_archivoAdjunto" value="'.basename( $_FILES['fileup']['name']).'" class="datos-archivo">'.basename( $_FILES['fileup']['name']).'</b></td>';
              echo '<td align="center"><b class="datos-archivo">Tipo de archivo:</br>'. $_FILES['fileup']['type'] .'</b></td>';
              echo '<td><b class="datos-archivo">Tama&ntilde;o:</br>'. number_format($_FILES['fileup']['size']/1024, 3, '.', '') .'KB</b></td>';
			    echo '<td><b class="datos-archivo" id="nomb_archivo" style="display:none;">'.$ArchivoPosfijo.'</td>';
            //  echo '<br/><br/>File path: <input type="text" value="http://'.$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['REQUEST_URI']), '\\/').'/'.$uploadpath.'" readonly>';
              echo '</tr>
			  </table></div>'			  ;
          } else echo '<div id="informacion_archivo"><table id="informacio_general"><b  class="datos-archivo">Incapaz de subir el archivo</b>';
       } else echo '<b class="datos-archivo"></table>'.$err.'</b>';
    }
echo '</div>';
?>
<script>

jq("#loader_serv").hide();
jq("#subida_archivo").hide();
jq("#BorrarArchivos").hide();

function ArchivoFile(){
	jq("input:file").change(function(){
		var filename=jq(this).val();
		if(filename!=""){
jq("#BorrarArchivos").show();
	jq("#BorrarArchivos").click(
	function(){
		//jq("#adjunta").reset();
		jq("#subida_archivo").hide();
jq("#BorrarArchivos").hide();
		});
			
  jq("#subida_archivo").show();
 jq("#subida_archivo").click(function(){
        	 
  jq("#loader_serv").show();

  
/*    jq.ajax({
   	 url:'cargarArchivos.php',
	 type:'post',
	 data:{'fileNom':jq("input:file").val(),
		  	 },
	success:function(respuesta){
   alert(respuesta);
		 }
	 });      */
  			
		});
		
			}//fin del if
			  
		});
	}


	
</script>

</body>
</center>
</html>
