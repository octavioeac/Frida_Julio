<?php
$string_html='
<table  width="900" height="71" border="3" cellspacing="1" id="tabla_ajax" bordercolor="#999999" bgcolor="#E8E8E8">
	<tr>
        <td>
        </td>
        
	    <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        Referencia:
        </td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" id="refere_si" name="ref_sisa" size="30" value=" "  />
        </td>
        <td>
        </td>
		</tr>
	<tr>
    
    <td>
    </td>
     <td>
    </td>
      <td>
        <input type="button" id="datos_wsdl_naca" value="Consulta" onclick="javaScript:alert_hola();" /> 
        </td>
  
         <td>
    </td>
     <td>
    </td>
    </tr>
	  
	
	<tr>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Bast. Remate</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input class="Estilo1" name="bastRemate" type="text" id="bastRemate" value="" readonly="readonly" />
        </td>
	   <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Clli. Edificio:</td>
       <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
       <input class="Estilo1" name="clliEdificio" type="text" id="clliEdificio"  value="" readonly="readonly" /></td>
	</tr>
	
	<tr>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Clli. Sistema:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
    
        </td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Contacto Remate:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="contactoRemate"  id="contactoRemate" size="30" value=""  /></td>
    </tr>
	
	 <tr>
         <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Descripcion Edificio:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="descripcionEdificio" id="descripcionEdificio" size="30" value=""  />
        </td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Descripcion Sistema:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="descripcionSistema"  id="descripcionSistema" size="30" value=""  />
        </td>
    </tr>
 <tr>
         <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Dispositivo :</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="dispositivo" id="dispositivo" size="30" value=""  />
        </td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Fecha Asignacion:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="fechaAsignacion"  id="fechaAsignacion" size="30" value=""  />
        </td>
 </tr>
	 <tr>
         <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Fila Remate:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="filaRemate" id="filaRemate" size="30" value=""  />
        </td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">imt:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="imt"  id="imt" size="30" value=""  />
        </td>
 </tr>
		 <tr>
         <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Lado Fila Remate:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="ladoFilaRemate" id="ladoFilaRemate" size="30" value=""  />
        </td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Lserrores:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="lserrores"  id="lserrores" size="30" value=""  />
        </td>
 </tr>
 		 <tr>
         <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">ModuloDip:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="moduloDip" id="moduloDip" size="30" value=""  />
        </td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Opc:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="opc"  id="opc" size="30" value=""  />
        </td>
 </tr>
	
    		 <tr>
         <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Opertel:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="opertel" id="opertel" size="30" value=""  />
        </td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Razon social:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="razonSocial"  id="razonSocial" size="30" value=""  />
        </td>
 </tr>
	   		 <tr>
         <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Repisa Remate:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="repisaRemate" id="repisaRemate" size="30" value=""  />
        </td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Sala Remate:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="salaRemate"  id="salaRemate" size="30" value=""  />
        </td>
 </tr>
	 	
        	 <tr>
         <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Serie:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="serie" id="serie" size="30" value=""  />
        </td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Sestatus:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="sestatus"  id="sestatus" size="30" value=""  />
        </td>
 </tr>
 <tr>
         <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Sigla:</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
        <input type="text" name="sigla" id="sigla" size="30" value=""  />
        </td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">&nbsp;</td>
        <td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
      
        </td>
 </tr>
</table>

';
echo $string_html;
 ?>