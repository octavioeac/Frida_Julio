<?php

 	 	 	$body  ='<p style="margin:0px; padding:0px; font-family:Verdana, Geneva, sans-serif;" align="left">Saludos:</br>
informo que la planificaci&oacute;n esta en estatus:'.strip_tags($objeto_correo->estatus_plan).'</br>
</p>
  <h3 style="margin:0px; padding:0px; font-family:Verdana, Geneva, sans-serif;"  class="Estilo1">Detalles: </h3>
 <table width="50%" bordercolor="#CAE4FF" cellpadding="4" cellspacing="1" border="1" bgcolor="#FFFFFF">
 <colgroup>
             <tr bordercolor="#CAE4FF">
                <td bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo4">Cliente</b></td>
               <td bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo4">Domicilio</b></td>
               <td bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo4">Nodo Acceso</b></td>
                <td bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo4">Anillo</b></td>
				  <td bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo4">Nodo sugerido</b></td>
             </tr>
 	
             <tr bordercolor="#CAE4FF" >
                   <td bgcolor="#FFFFFF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo2">'.strip_tags($objeto_correo->cliente_comun).'</b></td>
           <td bgcolor="#FFFFFF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo2">'.strip_tags($objeto_correo->domicilio).'</b></td>
                   <td bgcolor="#FFFFFF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo2">'.strip_tags($objeto_correo->nodo_acceso).'</b></td>
                   <td bgcolor="#FFFFFF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo2">'.strip_tags($objeto_correo->anillo_ref1).'</b></td>
 	  
	   <td bgcolor="#FFFFFF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo2">'.strip_tags($mi_array_datos_mail['nodo_sugerido']).'</b></td>
             </tr>
  </colgroup> 
   	   <tr bordercolor="#CAE4FF"   >
	  <td colspan=10 style="width:100%" bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo4">Observaciones:</b></td>
	 </tr>
	 <tr bordercolor="#CAE4FF" >
	  <td colspan=10 bgcolor="#FFFFFF" align="left" bordercolor="#CAE4FF"><b style="font-family:Verdana, Geneva, sans-serif;" class="Estilo2">
<pre><span>
'.$objeto_correo->observacion.'
</span>
<pre>
</td>
</tr>

</table> 
';
echo $body;
?>