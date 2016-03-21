<?php
include("../conexion_bas_user.php");
$query = "select email from seg_usuarios";
   	$result = mysql_query($query);
	//var_dump($result);
	$contador=0;
	 $contad=mysql_num_rows($result);
$usuarios="";
       while ($row=mysql_fetch_row($result)) 
      { 
		  $usuarios .="'".$row[0];
		  if($contador<($contad-1)){
			  		  $usuarios .="',";
			  }
			  else{
				    $usuarios .="'";
				  }
		  $contador++;
		  
       }
 
 
$html='<div id="correo_electronico" align="center" >
<div id="mail_plani" align="center" >

<table width="100%" bordercolor="#666666" border="2" bgcolor="#CAE4FF">
     <tr>
<td class="Estilo4" bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF" >
<h3>Mensaje Nuevo</h3>
    </td>
     </tr>
<tr>
<td class="Estilo4" bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF" >
RICARDRP@telmex.com,JOSEGA@telmex.com,osanchezch@ccicsa.com.mx,<br>
savera@ccicsa.com.mx,jjgonzalezh@ccicsa.com.mx
<!--<p class="Estilo4">octavio.avarezdelcastillo@gmail.com,enriquealarconchew@yahoo.com</p>-->
    </td>
     </tr>
     <tr >
<td class="Estilo4" bgcolor="#FFFFFF" align="left" bordercolor="#FFFFFFF">
<div >
    <label class="Estilo2">Para:</label>
	<input style:"resize:"vertical;" value="" id="mails" size="100%">
	</div></td>
     </tr>
<script>
	jq("#autoco").hide();
</script>
      <tr>
<td class="Estilo4" bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF" >
<p><textarea class="Estilo2" id="cuerpo_correo"  rows="10" cols="10" style="width: 99%; height: 185px; resize:none" > </textarea></p>
       </tr>
<tr>
   <td class="Estilo4" bgcolor="#CAE4FF" align="left" bordercolor="#CAE4FF" >  
    <iframe id="iframe_Carga" src="modulo_alta_fo_prov_ajax/Carga_ServidorPhp.php" allowtransparency="allowtransparency" style=" width:100%; background-color:#CAE4FF;" height="110px"  scrolling="no" frameborder="0"></iframe>
</td>
</tr>
   <tr>
    <td class="Estilo4" bgcolor="#CAE4FF" align="center" bordercolor="#CAE4FF" bordercolor="#CAE4FF" >
<input id="envio_correo_mail" type="button" value="Enviar" onclick="javascript:Envio_cuerpoMail();" />
</td>
        </tr>
  </table>
</div>
</div>
<script>
var lista_de_correos=['.$usuarios.']
jq2(function() {
    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    jq2( "#mails" )
      .autocomplete({
        minLength: 0,
        source: function( request, response ) {
          response( jq2.ui.autocomplete.filter(
            lista_de_correos, extractLast( request.term ) ) );
        },
        focus: function() {
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( ", " );
          return false;
        }
      });
  });

</script>'
;
echo $html;

?>