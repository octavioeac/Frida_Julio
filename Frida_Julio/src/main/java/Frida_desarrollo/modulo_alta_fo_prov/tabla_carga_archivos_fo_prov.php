<?php
include("../perfiles.php");
include("../conexion.php");
//$_SESSION['usr']="admin";


?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /> <!-- compatibilidad ajax y jquery con explorer -->
<link href="../Scripts/validate.css" rel="stylesheet" type="text/css" /> <!-- pestañas -->
<!--<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>--->
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script>
var jq=jQuery.noConflict();
</script>
<script type="text/javascript" src="../js/jquery-ui-1.10.4.custom/js/jquery-1.10.2"></script>
<script>
var jq2=jQuery.noConflict();
</script>
<script type="text/javascript" src="../js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.10.4.custom/development-bundle/ui/jquery.ui.dialog.js"></script>
<script type="text/javascript" src="../combosPhp/Jcombo.js"></script>
<script type='text/javascript' src='../js/myscripts.js'></script>
<script type="text/javascript" src="../js/datepickercontrol.js" ></script> <!-- calendario -->
<script type="text/javascript" src="../js/domtab.js"></script> <!-- pestañas -->
<script type="text/javascript" src="../js/domtabResPes.js"></script> <!-- pestañas -->

<link href="../css/styledem_dos.css" rel="stylesheet" type="text/css" media="screen" /> <!-- pestañas -->
<link href="../css/domtab2a.css" rel="stylesheet" type="text/css" /> <!-- pestañas -->
<link href="../datepickercontrol.css" rel="stylesheet" type="text/css" /> <!-- calendario -->
<link href="../style.css" rel="stylesheet" type="text/css" media="screen" />

<style type="text/css"> 
<!--[if lte IE 6]>  
	.tituloRojo1 {font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #F00; text-align:center;}
	#tbGeneral,#tbResp{width:900px; background-color:#CAE4FF; border:solid; table-layout:900px;border:#999999 solid 3px; color:#000066; text-align: left;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #000066;}
	.tbGeneralBl {width:900px; table-layout:900px;border:solid 3px; text-align: left;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;}
	#tbGeneral2 {width:900px; background-color:#eee; border:solid; table-layout:900px;border:#999999 solid 3px; color:#000066; text-align: left;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #000066;}

	.tituloRojo {font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #F00; text-align:center;}	
	.fibraOptica {background-color:#CAE4FF; border:solid; table-layout:900px;border:#999999 solid; color:#000066; text-align: left;font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #000066;}
	.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; color: #000066; text-align:left;}
	input[type='text']{font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #000066;}
	img[name='update'],img[name='delete'],.insert{cursor:pointer;}

	.Estilo1 {font-size:9px;} <!-- Input -->
	.Estilo2 {font-size:10px;} <!-- Textos -->
	.Estilo3 {font-size:8.5px;} <!-- Select -->
	.Estilo4 {color:#003399; font-weight:bold; font-size:11px; } <!-- Titulos -->
	.Estilo5 {color: #330099; font-weight: bold; }
	.Estilo41 {font-size: 10px; } <!-- Pestañas -->
	.Estilo10 {	font-size:12px;  color:#000066;  font-family:Verdana,Arial,Helvetica,sans-serif;  font-weight:bold;}
	.Estilo11 { font-family:Verdana,Arial,Helvetica,sans-serif;  font-size:10px;  font-weight:bold;  color: #009;}
	.Estilo12 { font-family:Verdana,Arial,Helvetica,sans-serif;  font-size:11px;  font-weight:bold;  color: #CC0000;}
	.Estilo13 { background-color:#EEEEEE; }
	
	.div_Content{ width:400px; height:500px; position:fixed; top:100%; left:65%; margin-left:-350px; margin-top:-350px; background:url() center no-repeat transparent; }
-->
     .EmailContenedor{
    		 position:fixed ;
	         top:0px;
			 left:2px;
			 width:1800px;
			 height:665px ; 
			 background: none;
             filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000,endColorstr=#99000000); 
             background:rgba(0,0,0,0.5); 
        	 padding-top: 170px;
        	 padding-right:400px;
				         }

      
  
    .EmailContenedorExplorer{
             position:fixed ;
        	 background-color:transparent;
			 top:0px;
			 left:2px;
			 width:1800px;
			 height:665px ;
			 text-align:center;
			 filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000,endColorstr=#99000000); 
             background:rgba(0,0,0,0.2); 
			            
		  	 }
			 
			 
             .PantallaEmailM{
			       height: 400px;
				    width : 400px;
				    left: 100px;
   			    margin-right : 1200px;
					margin-left:380px;
					margin-top:70px;
               
}

	        
				   
</style>
<script type="text/javascript" language="javascript">


</script>
</head>
<body>
<!--	<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">-->
   

    <table width='100%'  align='center' cellspacing='1' >
             	<tr>
                <td  ><h5>Carga Archivo: </h5>
                </td>
                </tr>
				<tr>
                <td  >
                   <select class="Estilo1"  name="var_arch_a" id="var_arch_a" >
                    <option value="" >-- Tipo Archivo --</option>
                    <?php
					if($_SESSION['usr'] =="KBTEL"){
						
							$query_carga_archivos="select * from cat_construccion_fo where rubro_fo='PROYECTO_FO'";
							$resultado_carga_archivos=mysql_query($query_carga_archivos);
							$Row_carga_archivos=mysql_fetch_assoc($resultado_carga_archivos);
							echo "<option value='".$Row_carga_archivos['rubro_fo']."'>".$Row_carga_archivos['rubro_fo']."
					    </option>";		
					}
				   if($_SESSION['usr'] =="CARSO"){
					        $query_carga_archivos="select * from cat_construccion_fo where rubro_fo='MEMTECNICA_FO'";
							$resultado_carga_archivos=mysql_query($query_carga_archivos);
							$Row_carga_archivos=mysql_fetch_assoc($resultado_carga_archivos);
							$query_carga_archivos_2="select * from cat_construccion_fo where rubro_fo='PROTOCOLO 9'";
							$resultado_carga_archivos_2=mysql_query($query_carga_archivos_2);
							$Row_carga_archivos_2=mysql_fetch_assoc($resultado_carga_archivos_2);
				    	   echo "<option value='".$Row_carga_archivos['rubro_fo']."'>".$Row_carga_archivos['rubro_fo']."</option>";
						   echo "<option value='".$Row_carga_archivos_2['rubro_fo']."'>".$Row_carga_archivos_2['rubro_fo']."
					    </option>";		
						}
					 if($_SESSION['usr'] !="CARSO" && $_SESSION['usr'] !="KBTEL"){
					$query_carga_archivos="select rubro_fo from cat_construccion_fo where combo_fo='var_arch_a'";
					$resultado_carga_archivos=mysql_query($query_carga_archivos);
				    while ($row_carga_archivo=mysql_fetch_row($resultado_carga_archivos)) {
                         echo "<option value='".$row_carga_archivo[0]."'>".$row_carga_archivo[0]."</option>";
}						}	
					?>
					</select>
                    </td>
                    <td>
  <form action="cargar_archivos_ref_sisa_prov.php?referencia_sisas=<?=$_REQUEST['ref_sisa_a']?>&
 envia_punta=<?=$_REQUEST['envia_punta']?>" method="post" id="formulario" enctype="multipart/form-data" name="form1">
 
 <label for="files" id="label">Archivo:</label>
  <input type="file" name="archivo" id="archivo"  />
  <input type="submit" name="subir" id="subir" value="Subir"  onclick="comprueba_extension(this.form, this.form.archivo.value)"/>
 </form>                    
 </td>
                    <?php
					                 $query_combo_carga_archivos="select bandera_archivos from construccion_fo
				  where ref_sisa='".$_REQUEST['ref_sisa_a']."'
						  and punta='".$_REQUEST['envia_punta']."'";
							$resultado_combo_carga_archivos=mysql_query($query_combo_carga_archivos);
							$Row_combo_carga_archivos=mysql_fetch_assoc($resultado_combo_carga_archivos);

					?>
                    <script> 
                   
                  jq("#archivo").hide();
				  jq("#subir").hide();
    			   jq("#label").hide();
				 jq("#var_arch_a").change(function(){
					  var valor = jq("#var_arch_a option:selected").val();
				     	jq.ajax(
			          {
			         url:"achivo_carga_referencia_combo.php"	,
			         type:'post',
	                 beforeSend:function(){
						 jq("#subir").attr("disabled","disabled");
						 },
					 data:
					      { 
					       "valor":valor,
					       "referencia_sisas":'<?=$_REQUEST['ref_sisa_a']?>',
						    "envia_punt":'<?=$_REQUEST['envia_punta']?>'
			        	  },
		         	 success:function(respuesta) 
					        {
							 jq("#subir").removeAttr("disabled"); 	
					         jq("#archivo").show();
							 jq("#subir").show();
							 jq("#label").show();
										
				            }
				      } );
					  
			        
				});
			   var combo_archivos='<?=$Row_combo_carga_archivos['bandera_archivos'];?>';
			   jq("#var_arch_a option:eq(0)").attr("selected","selected");
			     
function comprueba_extension(formulario, archivo) { 

   extensiones_permitidas = new Array(".txt",".ppt",".dwg", ".dxf", ".doc", ".pdf", ".pptx", ".docx", ".rar", ".zip" , ".csv" , ".xls" , ".xlsx" ); 
  // caractes_no_permitidos=  new Array("á", "é", "ó", "ú", "�", "?", "É", "¿" , "Ó" , "Ú",  "Á" ,"-" ,"{" ,"}" , "$" ,"=" , "<" , ">"); 
   mierror = ""; 
   if (!archivo) 
   { 
    mierror = "No has seleccionado ning\u00fan archivo"; 
	//alert("No has seleccionado ningun archvo")
	jq("#formulario").submit(function(e){
			e.preventDefault();
			});
   }
   else{ 
      extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase(); 
       permitida = false; 
	    for (var i = 0; i < extensiones_permitidas.length; i++) { 
         if (extensiones_permitidas[i] == extension) { 
         permitida = true; 
         break; 
         } 
	    } 
		
		
      if (!permitida) { 
         mierror = "Comprueba la extensi\u00f3n de los archivos a subir. \nS\u00f3lo se pueden subir archivos con extensiones: " + extensiones_permitidas.join(); 
      	jq("#formulario").submit(function(e){
			e.preventDefault();
			});
		}
		else
		{ 
		
	
        //alert ("Todo correcto. Voy a submitir el formulario."); 
         formulario.submit(); 
         return 1; 
      	} 
   } 
   //si estoy aqui es que no se ha podido submitir 
   alert (mierror); 
   return 0; 
}




</script> 


		</tr>		

			</table>
          
        
            
</body>
</html>            