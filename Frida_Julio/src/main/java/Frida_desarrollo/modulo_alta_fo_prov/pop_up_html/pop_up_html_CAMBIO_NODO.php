<?php
$string_html='
<form class="formEditName" id="formEditName"  name="formEditName" method="post">
<table  width="900" height="71" id="tabla_ajax" >
	<tr>
	<td class="Estilo58">
     Nodo Sugerido:	
	</td>
	</tr>
 <tr>
 	<tr>
	<td align="left">
    <input type="text" id="suger_nodo" name="suger_nodo" style="width: 10%; height: 99%;" value="">
	</td>
	</tr>
     <tr>

	 <td class="Estilo58"  colspan="2">
	 Observaciones:
	 </td>	
      </tr>
 <tr>
      <td style="width: 99%; height: 99%;">
<textarea id="observaciones1" name="observaciones1" class="Estilo2" style="width: 99%; height: 99%; resize:none;" cols="10" rows="10"></textarea>
      </td>
 </tr>
  <tr>
            <td style="width: 99%; height: 99%;">
    	      </td>

 </tr>
</table>
<form>
';
echo $string_html;
 ?>