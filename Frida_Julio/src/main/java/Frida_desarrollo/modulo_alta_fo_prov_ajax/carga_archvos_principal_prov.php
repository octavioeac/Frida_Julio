<?php
//include("../conexion.php");
//$_SESSION['usr']="admin";
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

 <script type="text/javascript" language="javascript">
//Hola como estas codigo archivoksdjksahdjsadh

function cargar(){
		jq.ajax(
				 {
					   url:"modulo_alta_fo_prov/tabla_archivos_referencia_sisa_fo_prov.php"	,
					   type:'post',
					   data:
				 { 
						"referencia_sisas":'<?=$_REQUEST['ref_sisa_a']?>',
						"envia_punt":'<?=$_REQUEST['envia_punta']?>'
				  },
				beforeSend:function(){
                jq(".tabla_dato_archivos").remove();
		        },
				success:function(respuesta) 
				{
				
				jq('#tabla_datos').append(respuesta);
										
				   }
		});
}


  function borrar_filas(id){
//	    alert(id);
	      var archivo_nom_2=jq("#ruta_"+id+"").val();
		 // alert(archivo_nom);
		var elemen_2 = archivo_nom_2.split("\\");
			//	alert(elemen_2);
		var num_2=elemen_2.length;
	//	alert(num_2);
		if(num_2==5){
		  var archi_cadena_2=elemen_2[4];
			}
		if(num_2==4){
		var archi_cadena_2=elemen_2[3];	
			}  
		//	alert(archi_cadena_2);
      	var entrar = confirm("Desea borrar el archivo: "+archi_cadena_2+"");
        if(entrar){	   
	   jq.ajax(
				 {
					   url:"modulo_alta_fo_prov/borrar_archivos_referencia_sisa_fo_prov.php"	,
					   type:'post',
					   data:
				 { 
						"referencia_sisas":'<?=$_REQUEST['ref_sisa_a']?>',
						"envia_punt":'<?=$_REQUEST['envia_punta']?>',
						"archivo":jq("#ruta_"+id+"").val()
				  },
				success:function(respuesta) 
				   {
				 alert(respuesta)	   
				 jq("#fila_borrar_"+id+"").remove();	  
					
				   }
		});
		}
   }
  
  
  
 
	 
 </script>          

</head>
<body>

   

    <table width='100%' border="2" align='center' cellspacing='1' bordercolor='#666666' bgcolor='#FFFFFF'>
             	<tr><td bordercolor="#FFFFFF" bgcolor="#FFFFFF">
  <iframe id="iframe_Carga_archivos" src="modulo_alta_fo_prov/tabla_carga_archivos_fo_prov.php?ref_sisa_a=<?=$_REQUEST['ref_sisa_a']?>&
 envia_punta=<?=$_REQUEST['envia_punta']?>" allowtransparency="allowtransparency" style=" width:100%; background-color:#CAE4FF;" height="43px"  scrolling="no" frameborder="0" onload="javascript:cargar();" ></iframe>
                </td></tr>
				<tr>
                
					</table>
          
            <table   width='100%' border="2" align='center' cellspacing='1' bordercolor='#666666' bgcolor='#FFFFFF'>
	        <tr><td bgcolor="#CAE4FF">
            </td>
            </tr>
			<tr><td bgcolor="#CAE4FF" align="center">
			<table id="tabla_datos" width='100%' border='2' align='center' cellspacing='1' bordercolor='#666666' bgcolor='#CAE4FF'>
				<tr bordercolor='#CAE4FF' bgcolor='#66CCFF'><td colspan="5" bordercolor='#FFFFFF' bgcolor='#72A6F3'><center><h4>Archivos Cargados</h4></center></td></tr>
				<tr bordercolor='#CAE4FF' bgcolor='#CAE4FF'>
					<td height="19" bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>No.</h5></center></td>
					<td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>Archivo</h5></center></td>
					<td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>Fecha</h5></center></td>
					<td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>Tama&#328;o</h5></center></td>
					<td bordercolor="#FFFFFF" bgcolor="#FFFFFF"><center><h5>Borrar</h5></center></td>
				</tr>
				 
			</table>
            </td>
            </tr>
            </table>
		
            
</body>
</html>            