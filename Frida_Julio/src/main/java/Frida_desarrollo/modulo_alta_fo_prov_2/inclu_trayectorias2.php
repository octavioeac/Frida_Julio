<?php
include("../conexion.php");
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
<script type="text/javascript" src="../Scripts/mootools-core-1.4.5-full-compat.js"></script>
<script type="text/javascript" src="../Scripts/mootools-more-1.4.0.1.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.10.4.custom/development-bundle/ui/jquery.ui.dialog.js"></script>
<script type="text/javascript" src="../combosPhp/Jcombo.js"></script>
<script type='text/javascript' src='../js/myscripts.js'></script>
<script language="JavaScript" src="JavaScript/funcion_update_LadaEnlace_tray.js"></script>
<script type="text/javascript" src="../js/datepickercontrol.js" ></script> <!-- calendario -->
<script type="text/javascript" src="../js/domtab.js"></script> <!-- pestañas -->
<script type="text/javascript" src="../js/domtabResPes.js"></script> <!-- pestañas -->

<link href="../css/styledem_dos.css" rel="stylesheet" type="text/css" media="screen" /> <!-- pestañas -->
<link href="../css/domtab2a.css" rel="stylesheet" type="text/css" /> <!-- pestañas -->
<link href="../datepickercontrol.css" rel="stylesheet" type="text/css" /> <!-- calendario -->
<link href="../style.css" rel="stylesheet" type="text/css" media="screen" />

<style type="text/css"> 
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
    		 position:absolute !important;
				 bottom:auto;
				 top:expression(0+((e=document.documentElement.scrollTop)?e:document.body.scrollTop)+'px');
			 left:1px;
			 top:0px;
	         width:100%;
			 height:665px ; 
			 background: none;
			 box-shadow: 0px 0px 10px 4px rgba(2, 0, 0, 0.75);
             filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000,endColorstr=#99000000); 
             background:rgba(0,0,0,0.5); 
             padding-top:9%; 
        	 padding-left:30%;
		
				         }
             .PantallaEmailM{
				  background-color:#FFF;
				  filter:alpha(opacity=100);			 
				  opacity:1;
			      height: 400px;
				  width: 900px; 
				  margin-right: 453px;
				  box-shadow: 0px 0px 10px 4px rgba(2, 0, 0, 0.75);
                 -webkit-box-shadow: 0px 0px 10px 4px rgba(2, 0, 0, 0.75);
				}
</style>
</head>
<body style="background-color:#CAE4FF;">
<form action="" method="post" name="form_trayecto_fo" id="form_trayecto_fo">
<?php
 //echo "<br>campo_tray"; ?><input type='hidden' name='campo_tray' id='campo_tray' value='<?=$campo_tray?>' /> <!-- Campo dependiendo del trayecto  -->
 <?php
$query_principal_incial="select tipo from construccion_fo where ref_sisa='".$_REQUEST['ref_sisa_a']."' and punta='".$_REQUEST['envia_punta']."'"; 
$resultado_tipo_trayec_inicial=mysql_query($query_principal_incial);
$Row_2=mysql_fetch_assoc($resultado_tipo_trayec_inicial);
 ?>  

<script >
   
  function popitup(url)
	{
		newwindow=window.open(url,'name','height=150,width=1100'); 
		if (window.focus) {newwindow.focus()}
		return false;
	}
function valida()
{
//	alert("valida");
	MooTools.lang.setLanguage("es-ES"); //establece idioma de mensajes de error
	validate = new Form.Validator.Inline("form_trayecto_fo");
	if (validate.validate())
	{
		if (confirm('¿Desea guardar la informacion?'))
		{
	//alert("Es necesario llenar los campos");
	mandar();
		}
	}
}

function mandar()
{
      
       var tipo_trab=jq("#tipo").val();
       if(tipo_trab=="1+1")
	   {
	    //alert("hola1");
	     	      jq.ajax({
   	        url:'inclu_trayectoriasQuerys2.php',
	        type:'post',
	        data: {
						"tipo":jq("#tipo").val(),
						 "ref_sisa_a":'<?=$_REQUEST['ref_sisa_a']?>',
						"envia_punta":'<?=$_REQUEST['envia_punta']?>',
					   "fo_cli_cliente_1":jq("#fo_clit_cliente").val(),
					   "fo_cli_cable_1":jq("#fo_clit_cable").val(),//
					   "fo_cli_ubi_1":jq("#fo_clit_ubi").val(),//
					   "fo_cli_cap_1":jq("#fo_clit_cap").val(),//
					   "fo_clit_long_1":jq("#fo_clit_long").val(),//
					   "fo_cli_jump_1":jq("#fo_clit_jump").val(),//
					   "fo_cli_ped_1":jq("#fo_clit_ped").val(),//
					   "tipo_trayec_cliente_1":'CLIENTE (TRABAJO)',//
					   "fo_cli_f_1":jq("#fo_clit_f").val(),//Fin cliente	Trabajo//
					   "fo_cen_central_1":jq("#fo_cent_central").val(),
					   "fo_cen_cable_1":jq("#fo_cent_cable").val(),//
					   "fo_cen_ubi_1":jq("#fo_cent_ubi").val(),//
					   "fo_cen_ped_1":jq("#fo_cent_ped").val(),//
					   "tipo_trayec_central_1":'CENTRAL (TRABAJO)',//
					   "fo_cen_f_1":jq("#fo_cent_f").val(),//Fin central	TRabajo
					   "fo_cli_cliente_2":jq("#fo_clir_cliente").val(),
					   "fo_cli_cable_2":jq("#fo_clir_cable").val(),//
					   "fo_cli_ubi_2":jq("#fo_clir_ubi").val(),//
					   "fo_cli_cap_2":jq("#fo_clir_cap").val(),
					   "fo_clit_long_2":jq("#fo_clir_long").val(),//
					   "fo_cli_jump_2":jq("#fo_clir_jump").val(),//
						"fo_cli_ped_2":jq("#fo_clir_ped").val(),//
					   "tipo_trayec_cliente_2":'CLIENTE (RESPALDO)',//
					   "fo_cli_f_2":jq("#fo_clir_f").val(),//Fin cliente	Respaldo//
					   "fo_cen_central_2":jq("#fo_cenr_central").val(),
					   "fo_cen_cable_2":jq("#fo_cenr_cable").val(),//
					   "fo_cen_ubi_2":jq("#fo_cenr_ubi").val(),//
					   "fo_cen_ped_2":jq("#fo_cenr_ped").val(),//
					   "tipo_trayec_central_2":'CENTRAL (RESPALDO)',//				   
					   "fo_cen_f_2":jq("#fo_cenr_f").val(),//
					   "fo_cons_1":"T",//
					   "fo_cons_2":"R"
	              },
	              success:function(respuesta)
				  {
					    alert(respuesta);
                  		var elementos=["fo_clit_ubi_1","fo_cent_ubi_1","fo_clir_ubi_1","fo_cenr_ubi_1"];
						update_LadaEnlace_tray(elementos,'<?=$_REQUEST['ref_sisa_a']?>','<?=$_REQUEST['envia_punta']?>');
		           }
	            }); 	
            
	    }
		if(tipo_trab=="1+0 TRABAJO")
		{
	   // alert("hola2");
	     	      jq.ajax({
   	        url:'inclu_trayectoriasQuerys2.php',
	        type:'post',
	        data: {
						"tipo":jq("#tipo").val(),
					   "ref_sisa_a":'<?=$_REQUEST['ref_sisa_a']?>',
					   "envia_punta":'<?=$_REQUEST['envia_punta']?>',
						"fo_cli_cliente_1":jq("#fo_clit_cliente").val(),
					   "fo_cli_cable_1":jq("#fo_clit_cable").val(),//
					   "fo_cli_ubi_1":jq("#fo_clit_ubi").val(),//
					   "fo_cli_cap_1":jq("#fo_clit_cap").val(),//
					   "fo_clit_long_1":jq("#fo_clit_long").val(),//
					   "fo_cli_jump_1":jq("#fo_clit_jump").val(),//
					   "fo_cli_ped_1":jq("#fo_clit_ped").val(),//
					   "tipo_trayec_cliente_1":'CLIENTE (TRABAJO)',//
					   "fo_cli_f_1":jq("#fo_clit_f").val(),//Fin cliente	Trabajo//
					   "fo_cen_central_1":jq("#fo_cent_central").val(),
					   "fo_cen_cable_1":jq("#fo_cent_cable").val(),//
					   "fo_cen_ubi_1":jq("#fo_cent_ubi").val(),//
					   "fo_cen_ped_1":jq("#fo_cent_ped").val(),//
					   "tipo_trayec_central_1":'CENTRAL (TRABAJO)',//
					   "fo_cen_f_1":jq("#fo_cent_f").val(),//Fin central	TRabajo
						"fo_cons_1":"T",//
					   "fo_cons_2":"R"
				   },
	              success:function(respuesta)
				  {
                  		alert(respuesta)
						var elementos=["fo_clit_ubi_1","fo_cent_ubi_1"];
						update_LadaEnlace_tray(elementos,'<?=$_REQUEST['ref_sisa_a']?>','<?=$_REQUEST['envia_punta']?>');
		           }
	            }); 	
            
	    }
		if(tipo_trab=="1+0 RESPALDO")
		{
	    //alert("hola3");
	     	      jq.ajax({
   	        url:'inclu_trayectoriasQuerys2.php',
	        type:'post',
	        data: {
						"tipo":jq("#tipo").val(),
					   "ref_sisa_a":'<?=$_REQUEST['ref_sisa_a']?>',
					   "envia_punta":'<?=$_REQUEST['envia_punta']?>',
					   "fo_cli_cliente_2":jq("#fo_clir_cliente").val(),
					   "fo_cli_cable_2":jq("#fo_clir_cable").val(),//
					   "fo_cli_ubi_2":jq("#fo_clir_ubi").val(),//
					   "fo_cli_cap_2":jq("#fo_clir_cap").val(),
					   "fo_clit_long_2":jq("#fo_clir_long").val(),//
					   "fo_cli_jump_2":jq("#fo_clir_jump").val(),//
						"fo_cli_ped_2":jq("#fo_clir_ped").val(),//
					   "tipo_trayec_cliente_2":'CLIENTE (RESPALDO)',//
					   "fo_cli_f_2":jq("#fo_clir_f").val(),//Fin cliente	Respaldo//
					   "fo_cen_central_2":jq("#fo_cenr_central").val(),
					   "fo_cen_cable_2":jq("#fo_cenr_cable").val(),//
					   "fo_cen_ubi_2":jq("#fo_cenr_ubi").val(),//
					   "fo_cen_ped_2":jq("#fo_cenr_ped").val(),//
					   "tipo_trayec_central_2":'CENTRAL (RESPALDO)',//				   
					   "fo_cen_f_2":jq("#fo_cenr_f").val(),//
						"fo_cons_1":"T",//
					   "fo_cons_2":"R"
				   },
	              success:function(respuesta)
				  {
                  		alert(respuesta)
						 
                  		var elementos=["fo_clir_ubi_1","fo_cenr_ubi_1"];
						update_LadaEnlace_tray(elementos,'<?=$_REQUEST['ref_sisa_a']?>','<?=$_REQUEST['envia_punta']?>');
		          }
	            }); 	
	    }
}
</script>

<?php
$mysql_o = "select tipo_trayec, cliente, cable, ubicaciona, cap_cable, longitud, tipo_jumper, fibra_a, fibra_b, pedido45  from fibra_optica_ladenlaces where ref_sisa='".$_REQUEST['ref_sisa_a']."' and punta='".$_REQUEST['envia_punta']."' and tipo_sel='".$Row_12['tipo']."' and tipo_tras='".$spanTipoTras."'   ";
$query_o = mysql_query($mysql_o);
$num_o = mysql_num_rows($query_o);

for ($i=0; $i<$num_o; $i++)
	{
		$o_tipo_trayec = mysql_result($query_o,$i,'tipo_trayec');
		$conca_ti_tra .= $o_tipo_trayec.', '; // VARIABLE IMPORTANTE - SABER QUE REGISTROS TENEMOS EN LA BASE
        echo $tipo_trayec;
		mysql_result($query_o,$i,'cliente');

		if ($o_tipo_trayec=='CLIENTE (TRABAJO)')
			{
				$v_cliT_cliente = mysql_result($query_o,$i,'cliente');
				var_dump($v_cliT_cliente);
				$v_cliT_cable = mysql_result($query_o,$i,'cable');
				$v_cliT_ubi = mysql_result($query_o,$i,'ubicaciona');
				$v_cliT_capcable = mysql_result($query_o,$i,'cap_cable');
				$v_cliT_long = mysql_result($query_o,$i,'longitud');
				$v_cliT_jumper = mysql_result($query_o,$i,'tipo_jumper');
				$v_cliT_f1 = mysql_result($query_o,$i,'fibra_a');
				$v_cliT_f2 = mysql_result($query_o,$i,'fibra_b');
				$v_cliT_pe45 = mysql_result($query_o,$i,'pedido45');
			}

		if ($o_tipo_trayec=='CLIENTE (RESPALDO)')
			{
				$v_cliR_cliente = mysql_result($query_o,$i,'cliente');
				$v_cliR_cable = mysql_result($query_o,$i,'cable');
				$v_cliR_ubi = mysql_result($query_o,$i,'ubicaciona');
				$v_cliR_capcable = mysql_result($query_o,$i,'cap_cable');
				$v_cliR_long = mysql_result($query_o,$i,'longitud');
				$v_cliR_jumper = mysql_result($query_o,$i,'tipo_jumper');
				$v_cliR_f1 = mysql_result($query_o,$i,'fibra_a');
				$v_cliR_f2 = mysql_result($query_o,$i,'fibra_b');
				$v_cliR_pe45 = mysql_result($query_o,$i,'pedido45');
			}

		if ($o_tipo_trayec=='CENTRAL (TRABAJO)')
			{
				$v_cenT_cable = mysql_result($query_o,$i,'cable');
				$v_cenT_ubi = mysql_result($query_o,$i,'ubicaciona');
				$v_cenT_f1 = mysql_result($query_o,$i,'fibra_a');
				$v_cenT_f2 = mysql_result($query_o,$i,'fibra_b');
				$v_cenT_pe45 = mysql_result($query_o,$i,'pedido45');
			}
		
		if ($o_tipo_trayec=='CENTRAL (RESPALDO)')
			{
				$v_cenR_cable = mysql_result($query_o,$i,'cable');
				$v_cenR_ubi = mysql_result($query_o,$i,'ubicaciona');
				$v_cenR_f1 = mysql_result($query_o,$i,'fibra_a');
				echo "fibra_a: ".$v_cenR_f1."<br>";
				$v_cenR_f2 = mysql_result($query_o,$i,'fibra_b');
				$v_cenR_pe45 = mysql_result($query_o,$i,'pedido45');
			}
	}
	
	
//echo "hola".$v_cliT_cliente;


?>



<table width="100%" border="1" cellspacing="1" bordercolor="#999999" bgcolor="#E8E8E8" id="tabla_trayectos">
	<tr>
		<td colspan="9" bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">
		<p><div style="color:#CC0000;font-family:Verdana,Arial,Helvetica,sans-serif;  font-size:11px;  font-weight:bold;" align="center">AGREGAR TRAYECTO DE FIBRA OPTICA <?php echo $_REQUEST['ref_sisa_a'] ; ?> PUNTA <? echo $_REQUEST['envia_punta'];?></div></p>
		<div align="left"><p bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo58">
		Tipo
        <select name="tipo" id="tipo">
		   <option value=" "></option>
			<?php
		 $query = "select * from trayecto_fibra_optica where fo_componente_trayecto_fibra_optica='tipo_f' order by fo_nombre_trayecto_fibra_optica DESC";
     	$result = mysql_query($query);
      while ($row=mysql_fetch_row($result)) 
      { 
             echo '<option value="'.$row[1].'">'.$row[1].'</option>'; 
       } 
		 
         ?>
         
         
         
      </select>   
      
      
		</p></div>
        </td>
	</tr>


       
    
  <script>
 
 function par_fibras_trabajo(){
	 jq("#fo_clit_cable").addClass("required");
     jq("#fo_clit_cliente").addClass("required");
	 jq("#fo_clit_ubi").addClass("required");
	 jq("#fo_clit_cap").addClass("required");
	 jq("#fo_clit_long").addClass("required");
	 jq("#fo_clit_jump").addClass("required");
	 jq("#fo_clit_ped").addClass("required");
	 jq("#fo_clit_f").addClass("required");
	 jq("#fo_cent_central").addClass("required");
	 jq("#fo_cent_cable").addClass("required");
	 jq("#fo_cent_ubi").addClass("required");
	 jq("#fo_cent_ped").addClass("required");
	 jq("#fo_cent_f").addClass("required");
	 }

 function par_fibras_respaldo(){
	 jq("#fo_clir_cable").addClass("required");
     jq("#fo_clir_cliente").addClass("required");
	 jq("#fo_clir_ubi").addClass("required");
	 jq("#fo_clir_cap").addClass("required");
	 jq("#fo_clir_long").addClass("required");
	 jq("#fo_clir_jump").addClass("required");
	 jq("#fo_clir_ped").addClass("required");
	 jq("#fo_clir_f").addClass("required");
	 jq("#fo_cenr_central").addClass("required");
	 jq("#fo_cenr_cable").addClass("required");
	 jq("#fo_cenr_ubi").addClass("required");
	 jq("#fo_cenr_ped").addClass("required");
	 jq("#fo_cenr_f").addClass("required");
	 	 
	 }

function par_fibras_respaldo_quitarvalidar(){
	 jq("#fo_clir_cable").removeClass("required");
     jq("#fo_clir_cliente").removeClass("required");
	 jq("#fo_clir_ubi").removeClass("required");
	 jq("#fo_clir_cap").removeClass("required");
	 jq("#fo_clir_long").removeClass("required");
	 jq("#fo_clir_jump").removeClass("required");
	 jq("#fo_clir_ped").removeClass("required");
	 jq("#fo_clir_f").removeClass("required");
	 jq("#fo_cenr_central").removeClass("required");
	 jq("#fo_cenr_cable").removeClass("required");
	 jq("#fo_cenr_ubi").removeClass("required");
	 jq("#fo_cenr_ped").removeClass("required");
	 jq("#fo_cenr_f").removeClass("required");
	 }

function par_fibras_trabajo_quitarvalidar(){
	 jq("#fo_clit_cable").removeClass("required");
     jq("#fo_clit_cliente").removeClass("required");
	 jq("#fo_clit_ubi").removeClass("required");
	 jq("#fo_clit_cap").removeClass("required");
	 jq("#fo_clit_long").removeClass("required");
	 jq("#fo_clit_jump").removeClass("required");
	 jq("#fo_clit_ped").removeClass("required");
	 jq("#fo_clit_f").removeClass("required");
	 jq("#fo_cent_central").removeClass("required");
	 jq("#fo_cent_cable").removeClass("required");
	 jq("#fo_cent_ubi").removeClass("required");
	 jq("#fo_cent_ped").removeClass("required");
	 jq("#fo_cent_f").removeClass("required");
	 
	 }

function par_fibra_trabajo_validate_one(){
	 jq("#fo_clit_cable").removeClass("required validation-failed");
     jq("#fo_clit_cliente").removeClass("required validation-failed");
	 jq("#fo_clit_ubi").removeClass("required validation-failed");
	 jq("#fo_clit_cap").removeClass("required validation-failed");
	 jq("#fo_clit_long").removeClass("required validation-failed");
	 jq("#fo_clit_jump").removeClass("required validation-failed");
	 jq("#fo_clit_ped").removeClass("required validation-failed");
	 jq("#fo_clit_f").removeClass("required validation-failed");
	  jq("#fo_cent_central").removeClass("required validation-failed");
	 jq("#fo_cent_cable").removeClass("required validation-failed");
	 jq("#fo_cent_ubi").removeClass("required validation-failed");
	 jq("#fo_cent_ped").removeClass("required validation-failed");
	 jq("#fo_cent_f").removeClass("required validation-failed");
	 jq("div").remove(".validation-advice");
	}
    
function par_fibra_respaldo_validate_one(){
	 jq("#fo_clir_cable").removeClass("required validation-failed");
     jq("#fo_clir_cliente").removeClass("required validation-failed");
	 jq("#fo_clir_ubi").removeClass("required validation-failed");
	 jq("#fo_clir_cap").removeClass("required validation-failed");
	 jq("#fo_clir_long").removeClass("required validation-failed");
	 jq("#fo_clir_jump").removeClass("required validation-failed");
	 jq("#fo_clir_ped").removeClass("required validation-failed");
	 jq("#fo_clir_f").removeClass("required validation-failed");
	   jq("#fo_cenr_central").removeClass("required validation-failed");
	 jq("#fo_cenr_cable").removeClass("required validation-failed");
	 jq("#fo_cenr_ubi").removeClass("required validation-failed");
	 jq("#fo_cenr_ped").removeClass("required validation-failed");
	 jq("#fo_cenr_f").removeClass("required validation-failed");
	 jq("div").remove(".validation-advice");
	}

 
  </script>  
    
   <?php
$query_anillo="select * from construccion_fo where ref_sisa='".$_REQUEST['ref_sisa_a']."' and punta='".$_REQUEST['envia_punta']."'"; 
$resultado_anillo=mysql_query($query_anillo);
$Row_anillo=mysql_fetch_assoc($resultado_anillo);
 ?>       

<?php // if($array_a['tipo']=='1+1' || $array_a['tipo']=='1+0 TRABAJO' ){ 
$query_cliente_trabajo="select cliente,cable"

?>
<!-- INICIO CLIENTE TRABAJO  -->
			<tr id="cliente_nco_trabajo">
		
        
        
        
        		<td width="25%" align="center" bgcolor="#CAE4FF" class="Estilo10">CLIENTE - NCO (TRABAJO)
                </td>
				<td width="10%" align="center" bgcolor="#CAE4FF" class="Estilo58">Cliente<br />
                        
                
                <input id="fo_clit_cliente" class="required" name="fo_clit_cliente" type="text" size="9" value="<?=$_REQUEST['cliente_comun'];?>" /></td>
				<td width="10%" align="center" bgcolor="#CAE4FF" class="Estilo58">Nombre Cable<br />
                
                
                
                <input id="fo_clit_cable" class="required" name="fo_clit_cable" type="text" size="9" value="<?=$Row_anillo['anillo_rof'];?>" /></td>
				<td width="7%" align="center" bgcolor="#CAE4FF" class="Estilo58">Ubicacion<br />
                
                <input type='text' class="required" id='fo_clit_ubi' name='fo_clit_ubi' onClick='return popitup("../ubicacion_combos.php?text=fo_clit_ubi")' value='<? $v_cliT_ubi; ?>' size='19' maxlength='19' readonly='readonly'>
                  <input type='hidden' class="required" id='fo_clit_ubi_1' name='fo_clit_ubi_1' value='<? $v_cliT_ubi; ?>' size='19' maxlength='19' readonly='readonly'> 
                </td>
				<td width="7%" align="center" bgcolor="#CAE4FF" class="Estilo58">Cap Cable <br />
				
                
                
                
                                  
                    <select id="fo_clit_cap" class="required" name="fo_clit_cap">
							  <option value="" selected>Seleccione</option>
        			<?php
		 $query = "select * from trayecto_fibra_optica where fo_componente_trayecto_fibra_optica='fo_clit_cap_num'";
     	$result = mysql_query($query);
      while ($row=mysql_fetch_row($result)) 
      { 
             echo '<option value="'.$row[1].'">'.$row[1].'</option>'; 
       } 
		 
         ?>
      </select>   
         <script>
        	  jq("#fo_clit_cap option:eq(0)").attr("selected","selected");
	          jq("#fo_clit_cap").change(function(){
               var valor2 = jq("#fo_clit_cap option:selected").val();
			   jq("#fo_clit_cap option:eq(0)").removeAttr("selected");
			   jq2("#fo_clit_cap option:contains("+valor2+")").attr("selected","selected");
            // alert("hola_1");
  		
				});
		</script>	
				</td>
				
                
                
                
                
                <td width="7%" align="center" bgcolor="#CAE4FF" class="Estilo58">Long-pes(M)<br />
				  <input name="fo_clit_long" class="required" type="text" id="fo_clit_long" size="3" value="<? echo $v_cliT_long; ?>"/></td>
				<td width="10%" align="center" bgcolor="#CAE4FF" class="Estilo58">Tipo FO<br /> 
					<select class="required" id="fo_clit_jump" name="fo_clit_jump">
				<option value="" selected>Seleccione</option>
        			<?php
		 $query = "select * from trayecto_fibra_optica where fo_componente_trayecto_fibra_optica='Tipo_FO'";
     	$result = mysql_query($query);
      while ($row=mysql_fetch_row($result)) 
      { 
             echo '<option value="'.$row[1].'">'.$row[1].'</option>'; 
       } 
		 
         ?>
      </select>  
        <script>
        	 /* jq("#fo_clit_jump option:eq(0)").attr("selected","selected");
	          jq("#fo_clit_jump").change(function(){
               var valor = jq("#fo_clir_jump option:selected").val();
			   jq("#fo_clit_jump option:eq(0)").removeAttr("selected");
			   jq2("#fo_clit_jump option:contains("+valor+")").attr("selected","selected");
             //alert("hola");
  		
		});*/
		</script> 			</td>
                    
                    
                    
                    
				<td width="9%" align="center" bgcolor="#CAE4FF" class="Estilo58">Pedido45<br />
                <!--
                <input name="fo_clit_ped" type="text" id="fo_clit_ped" size="9" value="<php if($_REQUEST['fo_clit_ped']!=''){echo $_REQUEST['fo_clit_ped'];}else{echo $v_cliT_pe45;}?>" onchange="document.solicita.comprobar.value='PEDIDO45_TRAY'; document.solicita.campo_tray.value='fo_clit_ped'; document.solicita.submit();" />-->
                
                
                <input name="fo_clit_ped"  class="required" type="text" id="fo_clit_ped" size="9" value="<? echo $v_cliT_pe45; ?>"  />
                
                
                </td>
				<td width="8%" align="center" bgcolor="#CAE4FF" class="Estilo58">F1 , F2 <br />
<!--				<select name="fo_clit_f" id="fo_clit_f" onChange="envia('ancla_cons');">-->
                <select name="fo_clit_f" id="fo_clit_f" class="required">
				</select>
        <script>
		jq("#fo_clit_cap").change(
		function(){
        jq("#fo_clit_f").find('option').remove().end();
		var par_de_fibra_inicial=jq("#fo_clit_cap").val();
		var par_de_fibra_final=	(par_de_fibra_inicial/2);

				var cont_impar=1;
	            var cont_par=2;
	jq("#fo_clit_f").append("<option value=''>---</option>");			
      for(cont=1; cont<=par_de_fibra_final; cont++){
jq("#fo_clit_f").append("<option value='"+cont_impar+" , "+cont_par+" '> "+cont_impar+" , "+cont_par+" </option>");
	cont_impar=cont_impar+2;
	cont_par=cont_par+2;
	   }
	});
		//jq("#fo_clir_cap").change(
function agrega_opciones(){
			jq("#fo_clir_f").find('option').remove().end();
			var par_de_fibra_inicial=jq("#fo_clir_cap").val();
			var par_de_fibra_final=	(par_de_fibra_inicial/2);
			var cont_impar=1;
			var cont_par=2;
			
			jq("#fo_clir_f").append("<option value=''>---</option>");
				
      for(cont=1; cont<=par_de_fibra_final; cont++){
			jq("#fo_clir_f").append("<option value='"+cont_impar+" , "+cont_par+" '> "+cont_impar+" , "+cont_par+" </option>");
			cont_impar=cont_impar+2;
			cont_par=cont_par+2;
	   }
}
		</script>        
                
                
			  </td>
			</tr>
<!-- FIN CLIENTE TRABAJO  -->
<!-- INICIO CENTRAL TRABAJO  -->
			<tr id="central_nco_trabajo">
				<td align="center" bgcolor="#CAE4FF" class="Estilo10">CENTRAL - NCO (TRABAJO) </td>
				<td align="center" bgcolor="#CAE4FF" class="Estilo58">Central<br />
                <input name="fo_cent_central" type="text" id="fo_cent_central" size="9" value="<?=$_REQUEST['central'];?>" />
                
                </td>
				
                <td width="8%" align="center" bgcolor="#CAE4FF" class="Estilo58">Nombre Cable<br />
                
                <input id="fo_cent_cable" name="fo_cent_cable" type="text" size="9" value="<?=$Row_anillo['anillo_rof'];?>" />
                
                
                </td>
				<td align="center" bgcolor="#CAE4FF" class="Estilo58">Ubicacion<br />
                <input type='text' id='fo_cent_ubi' name='fo_cent_ubi' onClick='return popitup("../ubicacion_combos.php?text=fo_cent_ubi")' value='<? echo $v_cenT_ubi;?>' size='19' maxlength='19' readonly='readonly'>
               <input type='hidden' id='fo_cent_ubi_1' name='fo_cent_ubi_1' value='<? echo $v_cenT_ubi;?>' size='19' maxlength='19' readonly='readonly'> 
                </td>
				<td colspan="3" align="center" bgcolor="#CAE4FF" class="Estilo58">&nbsp;</td>
				<td align="center" bgcolor="#CAE4FF" class="Estilo58">Pedido45<br />
                
                
              <!--  <input name="fo_cent_ped" type="text" id="fo_cent_ped" size="9" value="<php if($_REQUEST['fo_cent_ped']!=''){echo $_REQUEST['fo_cent_ped'];}else{echo $v_cenT_pe45;}?>" onchange="document.solicita.comprobar.value='PEDIDO45_TRAY'; document.solicita.campo_tray.value='fo_cent_ped'; document.solicita.submit();" />-->
              
                               <input name="fo_cent_ped" type="text" id="fo_cent_ped" size="9" value="<? echo $v_cenT_pe45;?>" />
                
                </td>
				
                
                
                <td align="center" bgcolor="#CAE4FF" class="Estilo58">F1, F2<br />
				
                
                <!--<select name="fo_cent_f" id="fo_cent_f" onChange="envia('ancla_cons');">-->
                   <select name="fo_cent_f" id="fo_cent_f">
					<?php 
						$num_f= cont_fibras('fo_cent_f', $query_o, '97');
						$cc_cenT = $v_cenT_f1." , ".$v_cenT_f2;
						if ($fo_cent_f=='---' || $fo_cent_f==''){$s='selected';}else {$s='';} echo "<option value='' ".$s.">---</option>";
						for($j=0;$j<count($num_f);$j++){if(($fo_cent_f==$num_f[$j] && $fo_cent_f!='') || ($num_f[$j]==$cc_cenT && $fo_cent_f=='')){$s='selected';}else{$s='';}echo "<option value='".$num_f[$j]."' ".$s.">".$num_f[$j]."</option>";}
					?>
				</select>
			</td>
			</tr>
            
            
            
<!-- FIN CENTRAL TRABAJO  -->
<?php //} if($array_a['tipo']=='1+1' || $array_a['tipo']=='1+0 RESPALDO' ){ ?>
<!-- INICIO CLIENTE RESPALDO  -->
			<tr id="cliente_nco_respaldo">
				<td width="25%" align="center" bgcolor="#CAE4FF" class="Estilo10">CLIENTE - NCO (RESPALDO)</td>
				<td width="10%" align="center" bgcolor="#CAE4FF" class="Estilo58">Cliente<br />
                <input id="fo_clir_cliente" name="fo_clir_cliente" type="text" size="9" value="<?=$_REQUEST['cliente_comun']?>" />
                
                
                </td>
				<td width="8%" align="center" bgcolor="#CAE4FF" class="Estilo58">Nombre Cable<br />
                
                <input id="fo_clir_cable" name="fo_clir_cable" type="text" size="9" value="<?=$Row_anillo['anillo_rof'];?>" />
                
                </td>
				<td width="7%" align="center" bgcolor="#CAE4FF" class="Estilo58">Ubicacion<br />
                <input type='text' id='fo_clir_ubi' name='fo_clir_ubi' onClick='return popitup("../ubicacion_combos.php?text=fo_clir_ubi")' value='<? echo $v_cliR_ubi; ?>' size='19' maxlength='19' readonly='readonly'>
              <input  id='fo_clir_ubi_1' name='fo_clir_ubi_1' type="hidden" value='<? echo $v_cliR_ubi; ?>' size='19' maxlength='19' readonly='readonly'>    
                
                </td>
				<td width="7%" align="center" bgcolor="#CAE4FF" class="Estilo58">Cap Cable<br />

				                    <select id="fo_clir_cap" name="fo_clir_cap" onChange="javascript:agrega_opciones();">
						  <option value="" selected>Seleccione</option>
        			<?php
		 $query = "select * from trayecto_fibra_optica where fo_componente_trayecto_fibra_optica='fo_clit_cap_num'";
     	$result = mysql_query($query);
      while ($row=mysql_fetch_row($result)) 
      { 
             echo '<option value="'.$row[1].'">'.$row[1].'</option>'; 
       } 
		 
         ?>
      </select>   
         <script>
		 
        	  jq("#fo_clir_cap option:eq(0)").attr("selected","selected");
	          jq("#fo_clir_cap").change(function(){
               var valor = jq("#fo_clir_cap option:selected").val();
			   jq("#fo_clir_cap option:eq(0)").removeAttr("selected");
			   jq2("#fo_clir_cap option:contains("+valor+")").attr("selected","selected");
//alert("hola");
  		
		});
		</script>			</td>
                    
                    
                    
                    
				<td width="7%" align="center" bgcolor="#CAE4FF" class="Estilo58">Long-pes(M)<br />
			    <input name="fo_clir_long" type="text" id="fo_clir_long" size="3" value="<? echo $v_cliR_long;?>"/></td>
				<td width="10%" align="center" bgcolor="#CAE4FF" class="Estilo58">Tipo FO<br /> 
        
                    <select id="fo_clir_jump" name="fo_clir_jump">
					<option value="" selected>Seleccione</option>
        			<?php
		 $query = "select * from trayecto_fibra_optica where fo_componente_trayecto_fibra_optica='Tipo_FO'";
     	$result = mysql_query($query);
      while ($row=mysql_fetch_row($result)) 
      { 
             echo '<option value="'.$row[1].'">'.$row[1].'</option>'; 
       } 
		 
         ?>
      </select>  
        <script>
        	  jq("#fo_clir_jump option:eq(0)").attr("selected","selected");
	          jq("#fo_clir_jump").change(function(){
               var valor = jq("#fo_clir_jump option:selected").val();
			   jq("#fo_clir_jump option:eq(0)").removeAttr("selected");
			   jq2("#fo_clir_jump option:contains("+valor+")").attr("selected","selected");
             //alert("hola");
  		
		});
		</script> 
	
                    
                    
                    
                    
                    	</td>
				<td width="9%" align="center" bgcolor="#CAE4FF" class="Estilo58">Pedido45<br />
                
               <!-- <input name="fo_clir_ped" type="text" id="fo_clir_ped" size="9" value="<php if($_REQUEST['fo_clir_ped']!=''){echo $_REQUEST['fo_clir_ped'];}else{echo $v_cliR_pe45;}?>" onchange="document.solicita.comprobar.value='PEDIDO45_TRAY'; document.solicita.campo_tray.value='fo_clir_ped'; document.solicita.submit();" />-->
                <input name="fo_clir_ped" type="text" id="fo_clir_ped" size="9" value="<? echo $v_cliR_pe45; ?>" />
                
                </td>
                
                
                
                
				<td width="8%" align="center" bgcolor="#CAE4FF" class="Estilo58">F1, F2<br />
				
                <select name="fo_clir_f" id="fo_clir_f"></select>
    <script>
		 
        	  jq("#fo_clit_cap option:eq(0)").attr("selected","selected");
	          jq("#fo_clit_cap").change(function(){
               var valor = jq("#fo_clit_cap option:selected").val();
			   jq("#fo_clit_cap option:eq(0)").removeAttr("selected");
			   jq2("#fo_clit_cap option:contains("+valor+")").attr("selected","selected");
//alert("hola");
  		
		});
		</script>		
				</td>
			</tr>
<!-- FIN CLIENTE RESPALDO  -->
<!-- INICIO CENTRAL RESPALDO  -->
			<tr id="central_nco_respaldo">
				<td align="center" bgcolor="#CAE4FF" class="Estilo10">CENTRAL - NCO (RESPALDO) </td>
				<td align="center" bgcolor="#CAE4FF" class="Estilo58">Central<br />
                
                
                <input name="fo_cenr_central" type="text" id="fo_cenr_central" size="9" value="<?=$_REQUEST['central'];?>"  />
                
                
                </td>
				<td width="8%" align="center" bgcolor="#CAE4FF" class="Estilo58">Nombre Cable<br />
                <input id="fo_cenr_cable"  name="fo_cenr_cable" type="text" size="9" value="<?=$Row_anillo['anillo_rof'];?>" /></td>
				<td align="center" bgcolor="#CAE4FF" class="Estilo58">Ubicacion<br />
                <input type='text' id='fo_cenr_ubi' name='fo_cenr_ubi' onClick='return popitup("../ubicacion_combos.php?text=fo_cenr_ubi")' value='<? echo $v_cenR_ubi; ?>' size='19' maxlength='19' readonly='readonly'>
  <input type='hidden' id='fo_cenr_ubi_1' name='fo_cenr_ubi_1' value='<? echo $v_cenR_ubi; ?>' size='19' maxlength='19' readonly='readonly'>              
                
                </td>
				<td colspan="3" align="center" bgcolor="#CAE4FF" class="Estilo58">&nbsp;</td>
				<td align="center" bgcolor="#CAE4FF" class="Estilo58">Pedido45<br />
                <!--<input name="fo_cenr_ped" type="text" id="fo_cenr_ped" size="9" value="<php if($_REQUEST['fo_cenr_ped']!=''){echo $_REQUEST['fo_cenr_ped'];}else{echo $v_cenR_pe45;}?>" onchange="document.solicita.comprobar.value='PEDIDO45_TRAY'; document.solicita.campo_tray.value='fo_cenr_ped'; document.solicita.submit();" />
                -->
                
                <input name="fo_cenr_ped" type="text" id="fo_cenr_ped" size="9" value="<? echo $v_cenR_pe45;?>" />
                
                </td>
				<td align="center" bgcolor="#CAE4FF" class="Estilo58">F1, F2<br />
				<!--<select name="fo_cenr_f" id="fo_cenr_f" onChange="envia('ancla_cons');">-->
                <select name="fo_cenr_f" id="fo_cenr_f">
					<?php 
					$num_f= cont_fibras('fo_cenr_f', $query_o, '97');
					$cc_cenR = $v_cenR_f1." , ".$v_cenR_f2;
					if ($fo_cenr_f=='---' || $fo_cenr_f==''){$s='selected';}else {$s='';} echo "<option value='' ".$s.">---</option>";
					for($j=0;$j<count($num_f);$j++){if(($fo_cenr_f==$num_f[$j] && $fo_cenr_f!='') || ($num_f[$j]==$cc_cenR && $fo_cenr_f=='')){$s='selected';}else{$s='';}echo "<option value='".$num_f[$j]."' ".$s.">".$num_f[$j]."</option>";}
					?>
				</select>
				</td>
			</tr>
<!-- FIN CENTRAL RESPALDO  -->
<?PHP //} ?>
			<tr><td colspan="9" bgcolor="#CAE4FF" align="center">

<input type="button" id="submit2" value="Guardar" onClick="javascript:valida();" />
						
		
            </td></tr>
        </table>
 
  <?php include("Dao_tipo_trayectoria_selec.php");
 $obj_trafico_tipo=strip_tags(busqueda_tipo_trayect::encontrar_trayectoria_ref_sisa($_REQUEST['ref_sisa_a'],$_REQUEST['envia_punta'],''));
// echo $obj_trafico_tipo;
 ?>
     <script>
	   var val_tipo="<?=$obj_trafico_tipo?>";
		    if(val_tipo=="1+1")
			 {
          document.getElementById("tipo").selectedIndex=1;
		 jq("#cliente_nco_respaldo").show();
				  jq("#central_nco_respaldo").show();
				  jq("#cliente_nco_trabajo").show();
				  jq("#central_nco_trabajo").show();
				   jq("#cliente_nco_respaldo").show();
				  
     		 }
			if(val_tipo=="1+0 TRABAJO")
			{
				 document.getElementById("tipo").selectedIndex=2;
            	  jq("#cliente_nco_trabajo").show();
     			  jq("#central_nco_trabajo").show();
  	 			  jq("#central_nco_respaldo").hide();
				  jq("#cliente_nco_respaldo").hide();
 				   par_fibras_respaldo();
				   par_fibras_trabajo_quitarvalidar();
			 }
			if(val_tipo=="1+0 RESPALDO")
			{
			 document.getElementById("tipo").selectedIndex=3;
			 jq("#cliente_nco_respaldo").show();
				  jq("#central_nco_respaldo").show();
				  jq("#cliente_nco_trabajo").hide();
				  jq("#central_nco_trabajo").hide();
				   jq("#submit2").removeAttr("disabled"); 
                   par_fibras_trabajo_quitarvalidar();
				   par_fibra_respaldo_validate_one();
                   par_fibra_trabajo_validate_one();
				   par_fibras_respaldo();
				  
			}	 	 
		 	 
		jq("#tipo").change(function(){
					// alert(val_tipo);
		    	   var valor = jq("#tipo option:selected").val();

				  if(valor=="1+0 TRABAJO"){
  				 jq("#cliente_nco_respaldo").hide();
				  jq("#central_nco_respaldo").hide();
				  jq("#cliente_nco_trabajo").css();
				  jq("#cliente_nco_trabajo").show();
				  jq("#central_nco_trabajo").show();
				
 				  jq("#submit2").removeAttr("disabled"); 
                   par_fibras_respaldo_quitarvalidar();
				   par_fibra_respaldo_validate_one();
                   par_fibra_trabajo_validate_one();
				   par_fibras_trabajo();
				
				  
				   				  }
    			  if(valor=="1+0 RESPALDO"){
				  jq("#cliente_nco_respaldo").show();
				  jq("#central_nco_respaldo").show();
				  jq("#cliente_nco_trabajo").hide();
				  jq("#central_nco_trabajo").hide();
				   jq("#submit2").removeAttr("disabled"); 
                   par_fibras_trabajo_quitarvalidar();
				   par_fibra_respaldo_validate_one();
                   par_fibra_trabajo_validate_one();
				   par_fibras_respaldo();
				  }
				  if(valor=="1+1"){
				  jq("#cliente_nco_respaldo").show();
				  jq("#central_nco_respaldo").show();
				  jq("#cliente_nco_trabajo").show();
				  jq("#central_nco_trabajo").show();
   				  //jq(".respaldo").hide();
    			  jq("#submit2").removeAttr("disabled"); 
				   par_fibra_respaldo_validate_one();
                   par_fibra_trabajo_validate_one();
				   par_fibras_respaldo();
				   par_fibras_trabajo();
				   			  

				  }
				   if(valor==" "){
			      jq("#cliente_nco_respaldo").hide();
				  jq("#central_nco_respaldo").hide();
				  jq("#cliente_nco_trabajo").hide();
				  jq("#central_nco_trabajo").hide();
   				  jq(".respaldo").hide();
				  jq.ajax({
   	        url:'actualiza_nulo_tipo_trayecto.php',
	        type:'post',
	         data: {
				   "ref_sisa_a":'<?=$_REQUEST['ref_sisa_a']?>',
				   "envia_punta":'<?=$_REQUEST['envia_punta']?>'
			      },
	              success:function(respuesta){
                  alert(respuesta)
		           }
	            }); 	           
				 
				 jq("#submit2").attr("disabled", "disabled");  
				  }			  
			 
	      
			   });
			   
			/*     var tipo_trabajo="<?=$Row_2['tipo']?>";
              if(tipo_trabajo=="1+0 TRABAJO"){
				 // alert("TRABAJO");
			     jq("#cliente_nco_trabajo").show();
			     jq("#central_nco_trabajo").show();
				  jq("#cliente_nco_respaldo").hide();
				  jq("#central_nco_respaldo").hide();
				   par_fibras_trabajo();
				   par_fibras_respaldo_quitarvalidar();
			  }
			  if(tipo_trabajo=="1+0 RESPALDO"){
			       //alert("hola_respaldo");
				  jq("#cliente_nco_trabajo").show();
     			  jq("#central_nco_trabajo").show();
  	 			  jq("#cliente_nco_trabajo").hide();
				  jq("#central_nco_trabajo").hide();
 				   par_fibras_respaldo();
				   par_fibras_trabajo_quitarvalidar();
             }
             if(tipo_trabajo=="1+1"){
			      alert("1+1");
				   jq("#cliente_nco_respaldo").show();
				   jq("#central_nco_respaldo").show();
				 jq("#cliente_nco_trabajo").show();
			     jq("#central_nco_trabajo").show();
				   
				      par_fibras_respaldo();
					  par_fibras_trabajo();
                   
                   }*/
  
		</script>
<?php
function cont_fibras($f, $query_trasA, $c_fin)
	{
		for($i=1;$i<$c_fin;$i++) 
			{
				$valor_f=$i+1;
				$vf=$i." , ".$valor_f;
				$num[]=$vf;
				$i=$valor_f;
			}
		return $num;
	}
?>
</form>
</body>
</html>