<?php
$titulo_modulo = "Libera Puerto de Enlaces Troncales";
include "perfiles.php";
include_once "header.php";
include "conexion.php";

$id_ot = $_GET['id_ot']; 

$queryOrden= "SELECT * FROM ordenes WHERE id_ot='$id_ot'";
$result= mysql_query($queryOrden);
$rowOrden= mysql_fetch_array($result);

$num_ot_frida		=$rowOrden['num_ot_frida'];
$nombre_oficial_pisa=$rowOrden['nombre_oficial_pisa'];
$trafico			=$rowOrden['trafico'];
$personal_valida	=$rowOrden['personal_valida'];
$causa				=$rowOrden['causa'];
$personal			=$rowOrden['personal'];
$tabla				=$rowOrden['tabla'];
$id_tabla			=$rowOrden['id_tabla'];
$estatus			=$rowOrden['estatus'];
$observaciones		=$rowOrden['observaciones'];
$division			=$rowOrden['division'];
$area				=$rowOrden['area'];
$id_ot				=$rowOrden['id_ot'];
$tecnico			=$rowOrden['tecnico'];
$tipo_trabajo		=$rowOrden['tipo_trabajo'];
$tipo_producto		=$rowOrden['tipo_producto'];
$motivo_mig         =$rowOrden['motivo_mig'];
$num_intervencion   =$rowOrden['num_intervencion'];

$arrMot     = explode(',',$motivo_mig);
$arrOrigen  = explode('-',$arrMot[0]);

$qDatos = mysql_query("SELECT cluster,id_nodo FROM inventario_puertos_ce WHERE id = '".$arrOrigen[0]."'");
$rDatos = mysql_fetch_array($qDatos);
$cluster = $rDatos['cluster'];
$id_nodo = $rDatos['id_nodo'];



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html" />
	<meta charset = "UTF-8"/>
	<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/ui/themes/smoothness/jquery-ui.css"type="text/css" media="screen" >
	<link rel="stylesheet" type="text/css" href="./css/domtab2a.css" type="text/css" media="screen" ></link>
	<script type="text/javascript" src="js/domtabResPes.js"></script>
	<script type = "text/javascript" src = "./js/jquery-1.9.1" ></script>
	<script type = "text/javascript" src = "./js/jquery-ui.js" ></script>



<style type = 'text/css'>
	.contenedor{font-size: 12px;font-family: Arial,Verdana;background:#cae4ff;border: 1px #999 solid;margin:0 auto;padding:10px 0;height: auto;width:900px; margin-top: 5px}
	.Estilo41{font-size: 9px;}
	div.domtab,#cintilla,#dvcns{margin:0 auto;padding:10px 0;height: auto;}
	table{margin:0 auto;padding:10px 0;height: auto;}/*background-color:#cae4ff*/

	#information{width: 900px;}
	.contenedor input[type = 'text']{width: 250px;}
	.rojo{color:red;font-weight: bold;}
	
</style>
<script type = 'text/javascript'>
	var onceTime=0;
		function getTab(){
			if(onceTime==0){
				var arrLink=document.getElementsByTagName("a");	
				var idLink;
				for(a=0;a< arrLink.length;a++){
					if(arrLink[a].href!='' && arrLink[a].href.match(/#(\w.+)/)!=null ){
						arrHref=arrLink[a].href.match(/#(\w.+)/)[1];
						if(arrHref==document.solicita_migra.tabSpan.value){
							idLink=arrLink[a].id;
							break;
						}
					}
				}
				if(idLink!=undefined)
					domtab.showTab( document.getElementById(idLink).click());
			}
			onceTime++;
		}

		
	</script>
</head>
<body>
<?




$num_results = mysql_num_rows($result);
if($num_results==0){
	echo "<h2 align='center'>No hay datos para ese RF</h2>";	
	exit();		
}
 if($estatus=='LIQUIDADA'){
       //echo "<h2 align='center'>La orden ha sido Liquidada</h2>"; 
       exit();    
    }
	
elseif($estatus=='VALIDADA')
	{	

		mysql_query("UPDATE ordenes SET estatus='ASIGNACION DE TECNICO' WHERE id_ot='".$id_ot."' "); 
		mysql_query("UPDATE inventario_puertos_ce_cambios SET estatus_cns='ASIGNACION DE TECNICO'
		                 WHERE num_ot_cambio='".$num_ot_frida."' "); 

		echo "<script> window.location.href='autoriza_captura_seccion.php?id_ot=$id_ot'; </script>";		
	}
elseif($estatus=='EN PROCESO'){
        $en_proceso = 1;
    }
elseif($estatus=='AUTORIZADA'){
        $en_proceso = 1;
    }

echo "<h2 align='center'>".$estatus."</h2><br>"; 

?>
<form id="principal" name="principal">
	<div class = 'contenedor'>
       
        	<table id = 'information'>
        		<tr>
        			<td>Cluster</td>
        			<td ><input type = 'text' name = 'cluster' value = '<?=$cluster?>' readonly></td>
        			
        		<tr>
        			<td>Id. Nodo</td>
        			<td><input type = 'text' name = 'cluster' value = '<?=$id_nodo?>' readonly></td>
        		</tr>
        		
        		<tr>
        			<td>Observaciones</td>
        			<td><textarea cols = '50' rows = '3' ><?echo $observaciones?></textarea></td>
        		</tr>
        	</table>
        </div>
</form>	

</td>
</tr>
</table>

<div id = "tab">
 <div class = "domtab" name ="domtab">
	<ul class ="domtabs">
		<li><a href="#puertos" class="Estilo41">PUERTOS</a></li>
    	<li><a href="#bitacora" class="Estilo41">BITACORA</a></li>
		<li><a href="#cns" class="Estilo41">CNS</a></li>
	</ul>
 </div>	
 </div>
 	 <div>
          <a name="puertos" id="puertos"></a>
          <table width  = '900' bordercolor="#999999" bgcolor="#CAE4FF" border ="1" >
			<thead>
				<tr bgcolor="#AAAAAA" style = "text-transform:uppercase;">
					<td>ENLACE</td>
					<td>PUERTO ORIGEN</td>
					<td>NODO ORIGEN</td>
					<td>PUERTO DESTINO</td>
					<td>NODO DESTINO</td>								
				</tr>
			</thead>
			<tbody>
				
					<?
						foreach ($arrMot as $ptosValidos) {
							
							$arrPto = explode('-', $ptosValidos);
							$qOrigen = mysql_query("SELECT * FROM inventario_puertos_ce WHERE id = '".$arrPto[0]."'");
							$rOrigen = mysql_fetch_array($qOrigen);

							$qDestino = mysql_query("SELECT * FROM inventario_puertos_ce WHERE id = '".$arrPto[1]."'");
							$rDestino = mysql_fetch_array($qDestino);

							echo "<tr bgcolor='#FFFFD9'>";
							echo "<td>".$rOrigen['pto_troncal']."</td>";
							if($rOrigen['subslot'] == '' ||$rOrigen['subslot'] == 'N/A'){
							echo "<td>".$rOrigen['repisat'].'/'.$rOrigen['posicion_tarjeta'].'/'.$rOrigen['puerto']."</td>";
							}else{
							echo "<td>".$rOrigen['repisat'].'/'.$rOrigen['posicion_tarjeta'].'/'.$rOrigen['subslot'].'/'.$rOrigen['puerto']."</td>";
							}
							echo "<td>".$rOrigen['id_nodo']."</td>";

							if($rDestino['subslot'] == '' ||$rDestino['subslot'] == 'N/A'){
							echo "<td>".$rDestino['repisat'].'/'.$rDestino['posicion_tarjeta'].'/'.$rDestino['puerto']."</td>";
							}else{
							echo "<td>".$rDestino['repisat'].'/'.$rDestino['posicion_tarjeta'].'/'.$rDestino['subslot'].'/'.$rDestino['puerto']."</td>";
							}
							echo "<td>".$rDestino['id_nodo']."</td>";

							echo "</tr>";
						}

					?>
				
				</tbody>
			</table>	

        </div>

		<div >
		 <a name="cns" id="cns"></a>

			<form id="liq_auto_baja" name="liquida_baja_puerto" method="post" action="liquida_autoriza_seccion.php">
		    <table width="900" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#E8E8E8">
    		<input type='hidden' name='id_ot' value="<?php echo $id_ot; ?>" />
		    <input type='hidden' name='tabla' value="<?php echo $tabla; ?>" />
		    <input type='hidden' name='id_tabla' value="<?php echo $id_tabla; ?>" />
		    <input type='hidden' name='tecnico' value="<?php echo $tecnico; ?>" />
		    <input type='hidden' name='proveedor_tx' value="<?php echo $no_reps; ?>" />
		  	<input type='hidden' name='observ' value="<?php echo $observ; ?>" />		    
		    <input type='hidden' name='liq' value= "<?php echo $liq; ?>"/>
		    <input type='hidden' name='id_nodo' value='<?php echo $id_nodo;?>' />
		    <input type='hidden' name = 'num_intervencion' value = '<?php echo $num_intervencion;?>'/>
		    <input type='hidden' name='num_ot_frida' value='<?php echo $num_ot_frida;?>' />
		    <input type = 'hidden' name = 'motivoMig' value = '<?echo $motivo_mig     ?>'>
		    
		   


      	  

   <tr>
 
      <td bordercolor="#E8E8E8" class="Estilo28"><span class="Estilo6 Estilo47"><strong>CONTROL CNS</strong></span></td>
      <td bordercolor="#E8E8E8" class="Estilo28">&nbsp;</td>
      <td bordercolor="#E8E8E8">&nbsp;</td>
      <td bordercolor="#E8E8E8" class="Estilo28">&nbsp;</td>
      <td bordercolor="#E8E8E8" class="Estilo28">&nbsp;</td>
      <td bordercolor="#E8E8E8" class="Estilo28">&nbsp;</td>
   </tr>
   <tr>
      <td bordercolor="#E8E8E8" class="Estilo42">RF</td>
      <td bordercolor="#E8E8E8" class="Estilo28"></td>
      <td bordercolor="#E8E8E8"><span class="Estilo28">
        <input readonly size="40px" name="num_ot_frida" type="text" id="campo20" value="<?php echo $num_ot_frida?>" />
      </span></td>
      <td bordercolor="#E8E8E8" class="Estilo28">&nbsp;</td>
      <td bordercolor="#E8E8E8" class="Estilo42">No Intervencion</td>
      <td bordercolor="#E8E8E8" class="Estilo28"><input name="num_intervencion" readonly type="text" id="campo21" 
      value="<?php echo $num_intervencion; ?>" /></td>
    </tr>
    <tr>
      <td bordercolor="#E8E8E8" class="Estilo42">Personal que Valido</td>
      <td bordercolor="#E8E8E8" class="Estilo28"></td>
      <td bordercolor="#E8E8E8"><span class="Estilo28">
        <input name="personal_valida" size="40" readonly type="text" id="per_val" value="<?php echo $rowOrden['personal_valida']; ?> "/>
      </span></td>
      <td bordercolor="#E8E8E8"></td>
      <td bordercolor="#E8E8E8" class="Estilo42">Fecha de Validacion</td>
      <td bordercolor="#E8E8E8" class="Estilo28"><input name="fecha_val" readonly type="text" id="fecha_val" value="<?php echo $rowOrden['fecha_val']; ?>" />
      </td>
      <td bordercolor="#E8E8E8" class="Estilo28"></td>
    </tr>
    <tr>
      <td width="153" bordercolor="#E8E8E8" class="Estilo42">Asignacion de Tecnico </td>
      <td width="118" bordercolor="#E8E8E8" class="Estilo28"></td>
      <td width="145" bordercolor="#E8E8E8"><span class="Estilo28">
        <?php
        
		if($perfil!="Tecnico cnsI" and ( $rowOrden['estatus']=='VALIDADA' or $rowOrden['estatus']=='ASIGNACION DE TECNICO' or $rowOrden['estatus']=='EJECUTADA SIN PRUEBAS' or $rowOrden['estatus']=='AUTORIZADA')) 
			{
				echo "<input type=button onclick='window.location.href=\"agenda_cns1.php?nomof=".$rowOrden['nombre_oficial_pisa']."&num_ot_frida=".$rowOrden['num_ot_frida']."&id_ot=".$rowOrden['id_ot']."&id_tabla=".$rowOrden['id_tabla']."&tabla=".$rowOrden['tabla']."\";' value='Agendar Tecnico'>";														
							
			}
		
		if($tecnico<>'') echo "<input name='tecnico' readonly type='text' id='tecnico' value='".$rowOrden['tecnico']."'>\n";
	    ?>
      </span></td>
      <?php if ($rowOrden['estatus']=="EJECUTADA CON PRUEBAS") {?>
      <td width="105" bordercolor="#E8E8E8" class="Estilo28">&nbsp;</td>
      <td width="96" bordercolor="#E8E8E8" class="Estilo42">Fecha de Ejecucion</td>
      <td bordercolor="#E8E8E8" class="Estilo28"><input name="fecha_val" readonly type="text" id="fecha_ejec" value="<?php echo $rowOrden['fecha_ejec']; ?>" />
      </td>
    </tr>
    <?php 
			           }
			           else {
			           ?>
    <tr>

      <td width="96" bordercolor="#E8E8E8" class="Estilo42">Fecha de Programacion</td>
      <td width="118" bordercolor="#E8E8E8" class="Estilo28"></td>
      <td bordercolor="#E8E8E8" class="Estilo28"><input name="fecha_val" readonly type="text" id="fecha_prog1" value="<?php echo $rowOrden['fecha_prog1'].' '.$rowOrden['hora_prog1']; ?>" />
          <?php } ?>
      </td>
    </tr>
    <tr>
      <td width="96" bordercolor="#E8E8E8" class="Estilo42">Personal que Liquida</td>
      <td width="105" bordercolor="#E8E8E8" class="Estilo28">&nbsp;</td>
      <td width="142" bordercolor="#E8E8E8" class="Estilo28">
	  <?php

			             if ($rowOrden['estatus']=="EJECUTADA CON PRUEBAS"  or $rowOrden['estatus']=="EJECUTADA SIN PRUEBAS" 
						 or $rowOrden['estatus']=="ASIGNACION DE TECNICO")
						  echo "<input type=text name=personal value='$sess_nmb' readonly>";
			             else 
						 echo "<input type=text name=personal value='$sess_nmb' readonly>";
			            ?>
      </td>
      <td bordercolor="#E8E8E8"></td>
      <td bordercolor="#E8E8E8" class="Estilo42"><span class="Estilo28">Fecha de Liquidacion</span></td>
      <td bordercolor="#E8E8E8" class="Estilo28"><input name="fecha_liq" readonly type="text" id="fecha_liq" value="<?php echo $rowOrden['fecha_liq']; ?>" />
      </td>
    </tr>
    <tr>
      <table width="900" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#CAE4FF">
            
      
        <tr>
          <?
			
			if ($rowOrden['estatus']=="VALIDADA" or $rowOrden['estatus']=="ASIGNACION DE TECNICO")
			{
					echo "<td align='center' bordercolor='#CAE4FF' class='Estilo28'>";
					echo "<input type='submit' name='button' id='button' value='Autorizar' title='Autorizar la Orden: Requiere Tecnico que Atendio' onclick='document.liquida_baja_puerto.liq.value=\"AUTORIZADA\";'></td>";
			}
						  
			if ($perfil=="Tecnico cnsI" )
			{		
			      echo "<td align='center' bordercolor='#CAE4FF' class='Estilo28'>Resultado del trabajo efectuado:<br>";
					echo "<select name='optec' id='optec' onchange='check_opc()'>
					 <option value=''></option>
					 <option value='EJECUTADA CON PRUEBAS'>Ejecutado con exito y con pruebas</option>
					 <option value='EJECUTADA SIN PRUEBAS'>Ejecutado con exito y sin pruebas</option>
					 <option value='EJECUTADA SIN EXITO'>Ejecutado sin exito</option>
					 </select><br><br>Causa de Rechazo<br>";
					 //<!- --------------------- --> 
						$query="select id_causa,causa from cat_causas where tabla='cat_anillo' order by causa";
						$res2 = mysql_query($query);
						if ($row = mysql_fetch_array($res2)){ 

							echo '<select multiple="multiple" name="causa_sel[]" id="causa_sel">';
							echo '<option></option>';
							do { 
								echo '<option value= "'.$row["causa"].'">'.$row["causa"].'</option>';
							} while ($row = mysql_fetch_array($res2)); 
								echo '</select>';
							}
					echo '</td>';
					//<!- --------------------- -->
					//<!- --------------------- -->
					echo '<td width="96" bordercolor="#E8E8E8" class="Estilo28">Observaciones:</td>';
					echo '<td width="122" bordercolor="#E8E8E8" class="Estilo28"><textarea name="observ" rows="5" cols="30" onclick="document.liquida_baja_puerto.liq.value=\'SAVE_OBS\';"></textarea>';
					echo '<input type="submit" name="button_save" id="button_save" value="Guardar Observaciones" /></td></tr>';
					//<!- --------------------- -->

					echo "<tr>
					<td  bordercolor='#E8E8E8' class='Estilo28' align='center'><input type='submit' name='button' id='env_button' value='Enviar' onclick='document.liquida_baja_puerto.liq.value=document.liquida_baja_puerto.optec.value;holaMundo()'></td>";
                    echo "<td><input type='submit' name='button' id='button' value='Rechazar' title='Rechazar la Orden: Requiere Personal que Liquida' onclick='document.liquida_baja_puerto.liq.value=\"RECHAZADA\"'></td>";
					echo "</tr>";
					
			}
			
		?>

			
			
			<script type="text/javascript">
			
			//document.getElementById("env_button").disabled=true;
			//document.getElementById("causa_sel").disabled=true;
			
			function check_opc()
			{
				if (document.getElementById("optec").value=='')
				{
					document.getElementById("env_button").disabled=true;
					document.getElementById("button_save").disabled=false;
					document.getElementById("causa_sel").disabled=true;
				}
					else if (document.getElementById("optec").value=='EJECUTADA SIN EXITO')
					{
						document.getElementById("causa_sel").disabled=false;
					document.getElementById("env_button").disabled=false;
					}

			else{
					document.getElementById("env_button").disabled=false;
					document.getElementById("button_save").disabled=true;
				}
			}
			</script>

			<?php
			
			if ($perfil != "Tecnico cnsI"  )
			{		  
			      echo "<td align='center' bordercolor='#CAE4FF' class='Estilo28'>";
			 		echo "<input type='submit' name='button' id='button' value='Rechazar' title='Rechazar la Orden: Requiere Personal que Liquida' onclick='document.liquida_baja_puerto.liq.value=\"RECHAZADA\"'></td>";

				//<!- --------------------- --> 
						$query="select id_causa,causa from cat_causas where tabla='cat_anillo' order by causa";
						$res2 = mysql_query($query);
						if ($row = mysql_fetch_array($res2)){ 

							echo '<td bordercolor="#CAE4FF"><select multiple="multiple" name="causa_sel[]" id="causa_sel">';
							echo '<option></option>';
							do { 
								echo '<option value= "'.$row["causa"].'">'.$row["causa"].'</option>';
							} while ($row = mysql_fetch_array($res2)); 
								echo '</select>';
							}
					
					//<!- --------------------- -->
					echo '</td><tr>';

				//<!- --------------------- -->
				echo '<td width="10" bordercolor="#E8E8E8" class="Estilo28">Observaciones:</td>';
				echo '<td width="122" bordercolor="#E8E8E8" class="Estilo28"><textarea name="observ" rows="5" cols="30" onclick="document.liquida_baja_puerto.liq.value=\'SAVE_OBS\'"></textarea>';
				echo '<input type="submit" name="button_save" id="button_save" value="Guardar Observaciones" />';
				//<!- --------------------- -->


				
			     echo "<td align='center' bordercolor='#CAE4FF' class='Estilo28'>";
				echo "<input type='submit' name='button' id='button' value='Liquidar' title='Liquidar la Orden: Requiere Tecnico que Atendio y Personal que Liquida' onclick='document.liquida_baja_puerto.liq.value=\"LIQUIDADA\"'></td>";
				
			}
			?>
        </tr>
      </table>
    </tr>
  </table>
  
</form>
		</div>
	 <div>
          <a name="bitacora" id="bitacora"></a>
          <table width  = '900' bordercolor="#999999" bgcolor="#CAE4FF" border ="1">
				<tr bordercolor="#CAE4FF">
				<?php
				echo "<td style ='border:#CAE4FF;'>";
				$datos_obs=explode("|",$observaciones);
				$ta_datos=sizeof($datos_obs);
				
				for ( $tt=0; $tt<$ta_datos; $tt++)
					{
					if ( strlen($datos_obs[$tt] > 3))
						{
						echo "<br>2010-".$datos_obs[$tt];
						echo "<hr />";
						}
					}
				echo "</td>";
				?>
				</tr>
			</table>

        </div>
</div>
</body>
</html>