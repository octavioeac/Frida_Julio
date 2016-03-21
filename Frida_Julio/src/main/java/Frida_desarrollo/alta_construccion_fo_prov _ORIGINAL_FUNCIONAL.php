<?php
//include("perfiles.php");
include("conexion.php");
//include("modulo_alta_fo_prov/select_contruccion_fo.php");
//include("modulo_alta_fo_prov/Generic_querys_GOD.php");
include("modulo_alta_fo_prov/components/components_html.php");
include("modulo_alta_fo_prov/components/Genericos_querys_mapper.php");
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /> <!-- compatibilidad ajax y jquery con explorer -->
<script type="text/javascript" src="Scripts/mootools-core-1.4.5-full-compat.js"></script>
<script type="text/javascript" src="Scripts/mootools-more-1.4.0.1.js"></script>
<link href="Scripts/validate.css" rel="stylesheet" type="text/css" /> <!-- pestañas -->
<!--<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>--->
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script>
var jq=jQuery.noConflict();
</script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-1.10.2"></script>
<script>
var jq2=jQuery.noConflict();
</script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/development-bundle/ui/jquery.ui.dialog.js"></script>


<script type="text/javascript" src="combosPhp/Jcombo.js"></script>
<script type='text/javascript' src='./js/myscripts.js'></script>
<script language="JavaScript" src="modulo_alta_fo_prov/JavaScript/funcion_busquedaArchivo.js"></script>
<script language="JavaScript" src="modulo_alta_fo_prov/JavaScript/Actualiza_terminar_JavaScripts.js"></script>
<script language="JavaScript" src="modulo_alta_fo_prov/JavaScript/Envia_Correo_JavaScript.js"></script>
<script language="JavaScript" src="modulo_alta_fo_prov/JavaScript/Compreuba_finalizacion_envioMail.js"></script>
<script language="JavaScript" src="modulo_alta_fo_prov/JavaScript/mandar_mail_nodo_acceso.js"></script>
<script type="text/javascript" src="js/datepickercontrol.js" ></script> <!-- calendario -->
<script type="text/javascript" src="./js/domtab.js"></script> <!-- pestañas -->
<script type="text/javascript" src="js/domtabResPes.js"></script> <!-- pestañas -->
<script type="text/javascript" src="modulo_alta_fo_prov/JavaScript/pop_up.js"></script>
<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.css">
<link href="css/styledem_dos.css" rel="stylesheet" type="text/css" media="screen" /> <!-- pestañas -->
<link href="./css/domtab2a.css" rel="stylesheet" type="text/css" /> <!-- pestañas -->
<link href="datepickercontrol.css" rel="stylesheet" type="text/css" /> <!-- calendario -->
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="modulo_alta_fo_prov/css/dialog_box.css" rel="stylesheet" type="text/css" /> 

<!--- Funcion para fecha para dias habiles -->
<script language="javascript" type="text/javascript">

function guardar_datos_2()
{
	MooTools.lang.setLanguage("es-ES"); //establece idioma de mensajes de error
	validate = new Form.Validator.Inline("solicita");
	if (validate.validate())
	{
		
		if (confirm('¿Desea guardar la informacion?'))
		{
			document.solicita.modificacion.value='1';
			document.solicita.validacion.value='1a';
	   		solicita.submit();
         }
	}
}

function guardar_datos()
{
	document.solicita.modificacion.value='1';
	   	if (confirm('¿Desea guardar la informacion?'))
		{
			var usuario_comp='<?=$_SESSION['usr']?>';
			if(usuario_comp!="CARSO" && usuario_comp!="KBTEL"){
				detona_mail();
				}
			 setTimeout(function () {
             // alert("Adios  Motools");
          solicita.submit();
    }, 2500); 
		
		}
	
}

function micorreo(){
	jq("#Correo_ele").click(explorador());
		}
		
/*var jq=jQuery.noConflict();*/
function fechahabil()
	{
		hoy = new Date();
		i=0;
		while (i<3)
			{
				hoy.setTime(hoy.getTime()+24*60*60*1000);
				if (hoy.getDay() !=6 && hoy.getDay()!=0)
				i++;
			}
	
		mes = hoy.getMonth()+1; if (mes<10) mes = '0'+mes;
		dia = hoy.getDate(); 	if (dia<10) dia = '0'+dia;
		fecha = hoy.getFullYear()+ '-' + mes + '-' + dia;
		
		document.getElementById("fecha").value=fecha;
		return fecha;
	}
</script>
<!--- Funcion para abrir la ventana de la ubicacion -->
<script language="javascript" type="text/javascript">

function popitup(url)
	{
		newwindow=window.open(url,'name','height=150,width=1100'); 
		if (window.focus) {newwindow.focus()}
		return false;
	}

function textCounter(field, countfield, maxlimit)
	{
		if (field.value.length > maxlimit) 		field.value = field.value.substring(0, maxlimit);
		else 		countfield.value = maxlimit - field.value.length;
	}
		
	function explorador(){
	jq("#envio_correo_mail").removeAttr("disabled");
	jq("#ui-id-1").css({"display":"none","top":"530px","left":"420px","width":"300px"});
	 jq("#correo_electronico").addClass("EmailContenedorExplorer").show();/*ESTILO IE8 */
		 	jq("#mail_plani").addClass("PantallaEmailM").show();
			  jq("#CALBUTTONfecha_sol_planificacion").hide();
      jq("#CALBUTTONfecha_rec_planificacion").hide();
	  jq("#CALBUTTONfecha_sol_permisossp").hide();
	  jq("#CALBUTTONfecha_rec_permiso").hide();
	  jq("#CALBUTTONfecha_entrega_esp_fo").hide();
	  jq("#CALBUTTONfecha_adecuaciones").hide();
	  jq("#CALBUTTONfecha_ent_50").hide();
  	  jq("#CALBUTTONfecha_en_fo").hide();
	  

	
	}
	
function busqueda_archivo_java()
{
       jq("B_mod").removeAttr("disabled");
	   var valor = jq("#estatus_planificacion").val();
       if(valor=="En Validacion Telmex" )
	   {
	                var usuario_gen='<?= $_SESSION['usr'] ?>';  
					if(usuario_gen=="KBTEL")
					{
					 busqueda_archivos('<?=$_REQUEST['ref_sisa_a']?>','<?=$_REQUEST['envia_punta']?>','<?=$_SESSION['usr']?>');
				     }
					 
	      if(usuario_gen!="KBTEL" && usuario_gen!="CARSO" )
					{
	actualiza_terminar_refSisa('<?=$_REQUEST['ref_sisa_a']?>','<?=$_REQUEST['envia_punta']?>','validada','1');
     				}
	   
	   }
	     if(valor!="En Validacion Telmex" )
	   {
	   if(usuario_gen!="KBTEL" && usuario_gen!="CARSO" )
					{
	actualiza_terminar_refSisa('<?=$_REQUEST['ref_sisa_a']?>','<?=$_REQUEST['envia_punta']?>','validada','0');
     				}
	   
	   }
	    if(valor=="Cambio Nodo De Acceso" ){
			valor = 'Cambio Nodo De Acceso';
			actualizar_estatus_nodo(valor);
		var pop_up="modulo_alta_fo_prov/pop_up_html/pop_up_html_CAMBIO_NODO.php";
		var name_id="estado_nodo"
		var funcion_name="update";
		var tabla="construccion_fo";
		//var json_stri='{"valor_72": "2","valor_8": "2"}';
		var ref_sisa='<?=$_REQUEST['ref_sisa_a']?>';
		var punta='<?=$_REQUEST['envia_punta']?>';

		pop_up_dialog(pop_up,name_id,funcion_name,ref_sisa,punta,tabla);

			}
	   
	     if(valor!="Cambio Nodo De Acceso" ){
 			valor = 'POR ELABORAR';
			actualizar_estatus_nodo(valor);
			}
	   
	   
}			
</script>
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
	.Estilo3 {font-size:8.5px;} <!-- select -->
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
					margin-top:50px;
               
}
iframe#iframe_Carga2 {
	background: #cae4ff !important; 
	}
	        
<![endif]-->
				   
</style>
</head>


<body style="background-color: transparent;">
<!--<body onload="document.getElementById('cargando').style. display='none';" onfocus="getTab()">-->
<!--<div class="div_Content" id="cargando" align="center"><img src="images/espere.gif" width="40" height="40" /><br />-->
<!--<font size="3" color="#616161">CARGANDO....</font></div>-->
<!--<font size="3" color="#666666">CARGANDO....</font></div>-->

<div id="wrap"><div id="header"><h1><a href="grid_pro_fo_com.php">F  R  I  D  A</a></h1><h2>Proyecto de Fibra Optica</h2></div></div><br />
<div style='position:absolute;top:0;left:90%;font-size:9px;font-weight:bold;'>Usuario: <?PHP echo $sess_nmb; ?><br>DD: <?php echo $sess_dd; ?></div>

<form id='solicita' name='solicita' method='post' enctype='multipart/form-data' >
<input type="hidden" name="fecha" id="fecha" value="<?= $fecha ?>" /> <!-- Contador de Fecha -->
<input type="hidden" name="tabSpan" id="tabSpan" value="<?=$tabSpan?>" />	<!-- NECESARIA PARA PESTAÑAS -->
<?php //echo "<br>alerta"; ?><input type='hidden' name='alerta' id='alerta' value='<?=$alerta?>' />
<?php //echo "<br>modificacion"; ?><input type='hidden' name='modificacion' id='modificacion' value='<?=$modificacion?>' /> <!-- Query -->
<?php //echo "<br>var_archivo"; ?><input type='hidden' name='var_archivo' id='var_archivo' value='<?=$var_archivo?>' /> <!-- Cargar archivo -->
<?php //echo "<br>validacion"; ?><input type='hidden' name='validacion' id='validacion' value='<?=$validacion?>' /> <!-- Validacion de Campos -->
<?php //echo "<br>comprobar"; ?><input type='hidden' name='comprobar' id='comprobar' value='<?=$comprobar?>' /> <!-- Comprobar PEP Y PEDIDO 45 -->
<?php //echo "<br>mailcorreo"; ?><input type='hidden' name='mailcorreo' id='mailcorreo' value='<?=$mailcorreo?>' /> <!-- Bandera para correos -->
<?php //echo "<br>var_tisel"; ?><input type='hidden' name='var_tisel' id='var_tisel' value='<?=$var_tisel?>' /> <!-- Variable para tipo sel  -->

<center>
<?php
// VARIABLES IMPORTANTES
$spanTipoTras='FO';

// QUERY GENERAL_a
$mysql_a = "select * from construccion_fo where ref_sisa='".$_REQUEST['ref_sisa_a']."' and punta='".$_REQUEST['envia_punta']."' ";
$query_a = mysql_query($mysql_a);
$array_a = mysql_fetch_array($query_a,MYSQL_ASSOC);

//LINEASSSSSS

/*$obj_select_ref_exist=dao_contruccion_fo_god::select_dinamic_query($_REQUEST['ref_sisa_a'], $_REQUEST['envia_punta'],"construccion_fo",$array_valore=array(
   "valor_1"=>$_REQUEST['ref_sisa_a']
      ));*/
$obj_select_ref_exist=Genericos_querys_mapper::generyc_mapper_querys(
"select",
$_REQUEST['ref_sisa_a'],
$_REQUEST['envia_punta'],
"construccion_fo",
 NULL,
 "array_asoc" ); 
  	  
//var_dump($obj_select_ref_exist);	  
//var_dump($obj_select_ref_exist);

if($obj_select_ref_exist==''){
echo "hola insercion";

$obj_select_inserta_cons=Genericos_querys_mapper::generyc_mapper_querys(
"insert",
$_REQUEST['ref_sisa_a'],
$_REQUEST['envia_punta'],
"construccion_fo",
$array_valo=array(
           "3"=>$_GET['tabla']
                  ),
"array_asoc");  	 


	}


// QUERY para guardar UIL_e
if ($array_a['ot_fo']=='' && mysql_num_rows($query_a)!='')
	{
		$query_e = mysql_query("select cons_ot from construccion_fo ");
		for ($a=0; $a<mysql_num_rows($query_e); $a++){$var_2[]= mysql_result($query_e,$a,'cons_ot'); if(mysql_result($query_e,$a,'cons_ot')!=''){$var_vc=$var_vc+1;}}

		$var_1 = substr((date(Y)), '-2')."".date(m); // Obtencion de Año y mes

		if ($var_vc!='')
			{
				$var_3 =(max($var_2))+1; // El maximo archivo mas uno
				$var_4 = strlen($var_3); // Longitud de maximo
				$var_5 = str_repeat('0',(4-$var_4)); // Optiene ceros restantes.
				$var_6 = $var_5."".$var_3; // Concatenar Valor de ultimos 4 digitos
				$var_7 = 'UIL-'.$var_1.'-'.$var_6;
			}
		else
			{ $var_6='0000'; $var_7= 'UIL-'.$var_1.'-'.$var_6;  }
		
		mysql_query("update construccion_fo set ot_fo='".$var_7."', cons_ot='".$var_6."', cons_ot_mes='".$var_1."'  where ref_sisa='".$_REQUEST['ref_sisa_a']."' and punta='".$_REQUEST['envia_punta']."'  ");
		echo "<script>document.solicita.submit();</script>";
	}

// COMPROBAR SI ESTAN DADOS DE ALTA en fibra_optica_ladaenlaces_b
$mysql_b = "select * from fibra_optica_ladenlaces where ref_sisa='".$_REQUEST['ref_sisa_a']."' and punta='".$_REQUEST['envia_punta']."'  ";
$query_b = mysql_query($mysql_b);
$num_b = mysql_num_rows($query_b);
$array_b = mysql_fetch_array($query_b,MYSQL_ASSOC);

// VISTASERVICIOSL 
$querySL 	= "select * from servicios_ladaenlaces_fo where ref_sisa='".$_GET['ref_sisa_a']."'   ";
$resSL 		= mysql_query($querySL);
$rowSL 		= mysql_fetch_array($resSL);

$SL_ip_analisis = $rowSL['ip_analisis']; 					$SL_supervisor_analisis = $rowSL['supervisor_analisis'];
$SL_ip_ingenieria = $rowSL['ip_ingenieria']; 				$SL_supervisor_ingenieria=$rowSL['supervisor_ingenieria'];

if ($_REQUEST['envia_punta']=='A') {
		$SL_ip_eq_acc = $rowSL['ip_eq_acc']; 				$SL_supervisor_eq_acc = $rowSL['supervisor_eq_acc'];
		$SL_ip_fibra_optica = $rowSL['ip_fibra_optica']; 	$SL_supervisor_fibra_optica = $rowSL['supervisor_fibra_optica'];
} else {
		$SL_ip_eq_acc = $rowSL['ip_eq_acc_b']; 				$SL_supervisor_eq_acc = $rowSL['supervisor_eq_acc_b'];
		$SL_ip_fibra_optica = $rowSL['ip_fibra_optica_b']; 	$SL_supervisor_fibra_optica = $rowSL['supervisor_fibra_optica_b'];
	}

// CONSULTA A TABLA QUE LE CORRESPONDETab
$queryTab 	= "select * from ".$rowSL['tabla']." where ref_sisa='".$_GET['ref_sisa_a']."'";
$resTab 	= mysql_query($queryTab);
$rowTab 	= mysql_fetch_array($resTab);

// CONSULTA Delegaciones_k
$mysql_k = "select delegacion from cat_delegaciones ";
$query_k = mysql_query($mysql_k);

// CONSULTA Problematica_f
$mysql_f = "select rubro_fo FROM cat_construccion_fo where combo_fo='problematica' ";
$query_f = mysql_query($mysql_f);

// CONSULTA Supervisor Cons_d
$mysql_d = "select nombre from cat_tecnicos where area='RDA CARSO' && puesto='SUPERVISOR' ";
$query_d = mysql_query($mysql_d);

// CONSULTA Paquete_i
$mysql_i = "select paquete from cat_materiales where tipo_equipo='FO' group by paquete";
$query_i = mysql_query($mysql_i);

?>


<!------------------------------------------------------------------------------------------------------------------>
<!-- INICIOTABLA 1 -->
<table  width="900" height="71" border="3" cellspacing="1" bordercolor="#999999" bgcolor="#E8E8E8">



	<tr>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Referencia:</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type="text" id="refere_si" name="ref_sisa" size="30" value="<?=$_REQUEST['ref_sisa_a']?>" readonly='readonly' /></td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Punta:</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type="text" name="punta" size="1" value="<?=$_REQUEST['envia_punta']?>" readonly='readonly' /></td>
	</tr>
	
	<tr>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">&nbsp;</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">&nbsp;</td>
        <td bordercolor="#E8E8E8" align="left">Perfil:</td><td bordercolor="#E8E8E8" align="left">
        <input name="text" type='text' value="<?=$rowSL['perfil']?>" readonly="readonly" />
        <input type="hidden" value="<?=$_GET['tabla']?>" name="tabla" />
           <input type="hidden" value="RICARDRP@telmex.com" name="email_8" />
                <input type="hidden" value="JOSEGA@telmex.com" name="email_9" />
        </td>
	</tr>
	
	
	<tr>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Nodo de Acceso:</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input class="Estilo1" name="nodo_acc" type="text" id="nodo_acc" value="<?php if($_REQUEST['envia_punta']=='A') echo $rowSL['central']; elseif($_REQUEST['envia_punta']=='B') echo $rowSL['central_b']; ?>" /></td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Domicilio:</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input class="Estilo1" name="domicilio" type="text" id="domicilio" value="<?php if($_REQUEST['envia_punta']=='A') echo $rowSL['domicilio_a']; elseif($_REQUEST['envia_punta']=='B') echo $rowSL['domicilio_b']; ?>" /></td>
	</tr>
	
	<tr>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Cliente Sisa:</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type="text" name="clienteSisa" size="30" value="<?=$rowSL['cliente_sisa']?>" readonly='readonly' /></td>
		<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Cliente Comun:</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input type="text" name="clienteComun" size="30" value="<?=$rowSL['cliente_comun']?>" readonly='readonly' /></td>        
	</tr>
	
	<tr>
		<td bordercolor="#E8E8E8" align="left">Folio SISA:</td><td bordercolor="#E8E8E8" align="left"><input type='text' name="folSer" value="<?=$rowSL['folio_sisa']?>" readonly="readonly"></td>
		<td bordercolor="#E8E8E8" align="left">Estado Sisa:</td><td bordercolor="#E8E8E8" align="left"><input name="text2" type='text' value="<?=$rowSL['estado_sisa']?>" readonly="readonly" /></td>
	</tr>

	<tr>
	<td align="left" bordercolor="#E8E8E8">Fase Sisa:</td><td align="left" bordercolor="#E8E8E8"><input type="text" name="etapaSisa" size="15" value="<?=$rowSL['etapa_sisa']?>" readonly="readonly" /></td>
	<td bordercolor="#E8E8E8" align="left">Tipo de Proyecto:</td><td bordercolor="#E8E8E8" align="left"><input type='text' value="<?=$rowSL['tipo_movimiento']?>" readonly="readonly" /></td>
	</tr>
	<tr>
	<td bordercolor="#E8E8E8" align="left">Criticidad:</td><td bordercolor="#E8E8E8" align="left"><input type='text' value="<?=$rowSL['criticidad']?>" readonly="readonly" /></td>
	<td bordercolor="#E8E8E8" align="left">Alcance:</td><td bordercolor="#E8E8E8" align="left"><input type='text' value="<?=$rowSL['alcance']?>" readonly="readonly" /></td>
	</tr>
	<tr>
	<td bordercolor="#E8E8E8" align="left">Due Date:</td><td bordercolor="#E8E8E8" align="left"><input name="text3" type='text' value="<?=$rowSL['fecha_dd']?>" readonly="readonly" /></td>
	<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Fecha de solicitud:</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input class="Estilo1" name="fec_sol" type="text" id="fec_sol" value="<?php if($_REQUEST['envia_punta']=='A') echo $rowSL['fecha_sol_proyecto_fo']; elseif($_REQUEST['envia_punta']=='B') echo $rowSL['fecha_sol_proyecto_fo_b']; ?>" /></td>
	</tr>
 	<tr>
	<td bordercolor="#E8E8E8" align="left">Responsable Cliente:</td><td bordercolor="#E8E8E8" align="left"><input name="Responsable_Cliente" type='text' value="<?=$rowSL['responsable_cliente']?>" readonly="readonly" /></td>
	<td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left">Tel&eacute;fono Cliente:</td><td bordercolor="#E8E8E8" bgcolor="#E8E8E8" align="left"><input class="Estilo1" name="telefono_cliente" type="text" id="telefono_cliente"  value="<?=$rowSL['telefono_cliente']?>" readonly="readonly" /></td>
	</tr>   
    
</table>
<!-- FINTABLA 1 -->
<!------------------------------------------------------------------------------------------------------------------>





<!-------------------------------- INICIO PESTANAS DEL PROGRAMA --------------------------------> 
<div class="domtab">
	<ul class="domtabs">
		<li><a href="#pes_fo" id="lnk_fo" class="Estilo41">FIBRA OPTICA</a></li>
		<li><a href="#pes_equipami" id="lnk_equipami" class="Estilo41">EQUIPAMIENTO</a></li>
		<li><a href="#pes_bitac" id="lnk_bitac" class="Estilo41">BITACORA</a></li>
		<li><a href="#pes_topo" id="lnk_topo" class="Estilo41">TOPOLOGICO</a></li>
	
</ul>
<!-------------------------------- FIN PESTANAS DEL PROGRAMA -----------------------------------> 



<!--------------------------------------------------------------------------------------------- INICIO PESTANAS 1 -------------------------------------------> 
<!-- INICIOTABLA  -->
<div><a name="pes_fo" id="pes_fo"></a>
<br />
<table id="cuerpo_principal" width="110%" border="2" bordercolor='#666666' bgcolor='#CAE4FF' >
	<tr bgcolor="#999999"><td colspan="6" height="4"></td></tr>
    
    	<tr><td bordercolor="#CAE4FF" class="Estilo2" align="left" colspan="6">
	<?php 
	// Arreglo de telefonos por Responsable
	$var_SL = array($SL_ip_analisis, $SL_supervisor_analisis, $SL_ip_ingenieria, $SL_supervisor_ingenieria, $SL_ip_eq_acc, $SL_supervisor_eq_acc, $SL_ip_fibra_optica, $SL_supervisor_fibra_optica ); // variables
	$var_SLtit = array('Resp IPE Analisis: ', 'Resp Super Analisis: ', 'Resp IPE Ingenieria: ', 'Resp Super Ingenieria: ', 'Resp IPE Equipamiento: ', 'Resp Super Equipamiento: ', 'Resp IPR FO: ', 'Resp Super FO: '  ); // variables
	echo "<table>";
	for($i=0; $i<count($var_SL); $i++)
		{
			$queryTE = "select telefono, id_tecnico,email from cat_tecnicos where nombre='".$var_SL[$i]."'  ";
          //  echo $queryTE."hola como estas" ;
//			echo $var_SL[$i];
			$resTE 		= mysql_query($queryTE);
			$rowTE 		= mysql_fetch_array($resTE);
			$TE_tele[$i]= $rowTE['telefono'];
			$TE_email[$i]= $rowTE['email'];
			
			$a=$a+1; 
			if ($a==1){echo "<tr>";} // CONTADOR para iniciar tr
			if ($a==2){$a=0; echo "</tr>";} // CONTADOR para cortar tr
			
			echo "<td align='left' >".$var_SLtit[$i]."</td>";
			echo "<td align='left' ><input name='text5' type='text' id='text5' value='".$var_SL[$i]."' size='30' readonly='readonly' /></td>";
			echo "<td align='left' ><input type='text' name='textfield4' value='".$TE_tele[$i]."' size='15' readonly='readonly' /></td>";
 		    echo "<td align='left' ><input type='hidden' id='email_".$i."' name='email_".$i."' value='".$TE_email[$i]."' size='15' readonly='readonly' /></td>";
			
			echo "<td align='left' >".$var_SLtit[$i+1]."</td>";
			echo "<td align='left' ><input name='text5' type='text' id='text5' value='".$var_SL[$i+1]."' size='30' readonly='readonly' /></td>";
			echo "<td align='left' ><input type='text' name='textfield4' value='".$TE_tele[$i+1]."' size='15' readonly='readonly' /></td>";
			   $j=$i+1;
			   echo "<td align='left' ><input type='hidden' id='email_".$j."' value='".$TE_email[$i+1]."' size='15' readonly='readonly' />
			   </td>";
			
			
			$i= $i+1;
		}
	echo "</table>";
	?>
	</td></tr>
	
	<tr><td colspan="6" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo4" align="left"><a name="ancla_inf"></a>Informaci&oacute;n General</td></tr>
	
	<tr>
		<td width="17%" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Factibilidad:</td>
		<td width="16%" align="left" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2"><input class="Estilo1" name="factibilidad" type="text" id="factibilidad" value="<?php  if($_REQUEST['factibilidad']!=''){echo $_REQUEST['factibilidad'];}else{echo $array_a['factibilidad'];}?>" /></td>
		<td bordercolor="#CAE4FF" class="Estilo2">&nbsp;</td>
		<td bordercolor="#CAE4FF" class="Estilo2">&nbsp;</td>
		<td bordercolor="#CAE4FF" class="Estilo2">&nbsp;</td>
		<td bordercolor="#CAE4FF" class="Estilo2">&nbsp;</td>
	</tr>
	
	
	<tr>
		<?php   if($_REQUEST['envia_punta']=='A') $fecha1=$rowTab['fecha_asigna_ip_fibra']; elseif($_REQUEST['envia_punta']=='B') $fecha1=$rowTab['fecha_asigna_ip_fibra_b'];
				$fecha1=date('Y-m-d H:i:s', strtotime("$fecha1 + 14 days"));
		?>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Programada:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1"  readonly="readonly" name="fecha_programada" type="text" id="fecha_programada"  value="<?php if($_REQUEST['fecha_programada']!=''){echo $_REQUEST['fecha_programada'];}else{echo $fecha1;}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Tramo Afe: </td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" datepicker='true' name="fecha_tramo_afe" type="text" id="fecha_tramo_afe" value="<?php if($_REQUEST['fecha_tramo_afe']!=''){echo $_REQUEST['fecha_tramo_afe'];}else{echo $array_a['fecha_tramo_afe'];}?>" /></td>
		<!--<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Due Date: </td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" datepicker='true' name="fecha_dd" type="text" id="fecha_dd" value="<?php //if($_REQUEST['fecha_dd']!=''){echo $_REQUEST['fecha_dd'];}else{echo $array_a['fecha_dd'];}?>" /></td>-->
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Asignacion :</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left"><!--<input class="Estilo1" name="fecha_asignacion" type="text" id="fecha_asignacion" value="<?//=$array_a['fecha_asignacion']?>" readonly="readonly" />-->
		<input class="Estilo1" name="fecha_asignacion" type="text" id="fecha_asignacion" value="<?php if($_REQUEST['envia_punta']=='A') echo $rowTab['fecha_asigna_ip_fibra']; elseif($_REQUEST['envia_punta']=='B') echo $rowTab['fecha_asigna_ip_fibra_b'];?>" readonly="readonly" />
		</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Solicitud FO:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" name="fecha_solicitud_fo" type="text" id="fecha_solicitud_fo" value="<?=$array_a['fecha_solicitud_fo']?>" readonly="readonly" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2">&nbsp;</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2">&nbsp;</td>
	</tr>

	<tr>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Resp IPR:</td>
		<td align="left" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo3">
		<?PHP if ($_REQUEST['envia_punta']=='A') {$valor_ipr=$rowSL['ip_fibra_optica'];} else {$valor_ipr=$rowSL['ip_fibra_optica_b'];} ?>
		<input class="Estilo3" name="ipr_resp_fo" type="text" id="ipr_resp_fo" value="<? if ($array_a['ipr_resp_fo']==''){ echo $va_ipr_resp=$valor_ipr; }else {echo $va_ipr_resp=$array_a['ipr_resp_fo'];}?>" size="25" readonly="readonly" /></td>
		<td align="left" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" >Resp SUCOPE:</td>
		<td align="left" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" >
			<?php	
			// Consulta de CAT_TECNICO
			$mysql_l = "select sucope, email_sucope from cat_tecnicos where area='RDA CONSTRUCCION FO' group by sucope "; $query_l = mysql_query($mysql_l); // General
			$mysql_h = "select sucope from cat_tecnicos where area='RDA CONSTRUCCION FO' and nombre='".$va_ipr_resp."' LIMIT 1"; $query_h = mysql_query($mysql_h);//Particular
			if(mysql_num_rows($query_h)>0) $sucopeFO=mysql_result($query_h,0,0);
			?>
			<select class="Estilo3" name='sucope_fo' id='sucope_fo' >
				<?php if ($sucope_fo==''||$array_a['sucope_fo']==''){$s3='selected';}else {$s3='';}?><option value='' <?php echo $s3;?> >-- SUCOPE --</option>
				<?php
					for($j=0;$j<mysql_num_rows($query_l);$j++)
						{
							$suc_a=mysql_result($query_h,0,'sucope'); // Particular
							$suc_b=mysql_result($query_l,$j,'sucope'); // General
							$email_b=mysql_result($query_l,$j,'email_sucope'); // Email Sucope
	
							if (($suc_b==$suc_a && $sucope_fo=='') || ($array_a['sucope_fo']==$suc_b && $array_a['sucope_fo']!=''))
									{$s3='selected';  $sucope_fo=$suc_b;  $mail_sucope=$email_b;}
							elseif (($_REQUEST['sucope_fo']==$suc_b && $sucope_fo!='') || $sucopeFO==$suc_b)
									{$s3='selected';  $sucope_fo=$suc_b;  $mail_sucope=$email_b;}
							else 	{$s3='';}
							echo "<option value='".$suc_b."' $s3 >".$suc_b."</option>";
						}
				?>
			</select>		</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Supervisor FO:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">
		<?PHP if ($_REQUEST['envia_punta']=='A') {$valor_supervisor=$rowSL['supervisor_fibra_optica'];} else {$valor_supervisor=$rowSL['supervisor_fibra_optica_b'];} ?>
		<input class="Estilo3" name="supervisor_fo" type="text" id="supervisor_fo" value="<? if ($array_a['supervisor_fo']==''){ echo $valor_supervisor; }else {echo $array_a['supervisor_fo'];}?>" size="25" readonly="readonly" />		</td>
	</tr>
	<script language="javascript" type="text/javascript">
    jq("#sucope_fo").attr("disabled",true);
	    jq("#fecha_programada").attr("readonly",true);
			    jq("#fecha_programada").attr("readonly",true);
					    jq("#fecha_asignacion").attr("readonly",true);
						    jq("#ipr_resp_fo").attr("readonly","readonly");
        					    jq("#fecha_tramo_afe").attr("readonly",true);
							        jq("#fecha_solicitud_fo").attr("readonly",true);
                                       jq("#supervisor_fo").attr("readonly",true);	
									    jq("#factibilidad").attr("readonly",true);	
                                            jq("#fecha_tramo_afe").removeAttr("datepicker",false);

							

							
    </script>
<!-- ////////////////////////////////////////////////////////////////////////////////////////FININFORMACION GENERAL  -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->



<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////-- ancla_planif  -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////INICIOPLANIFICACION  -->
	<tr bgcolor="#999999"><td colspan="6" height="4"></td></tr>
	<tr class="constru"><td colspan="2" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo4" align="left"><a name="ancla_cons"></a>Planificaci&oacute;n</td>
        <td id="con_plan" colspan="2"   bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo4">Requiere Planificaci&oacute;n</td>
       <td id="con_plan2" class="Estilo2">  <input  id="no_requerido_plan" name="requeri_forma_plani" type="checkbox" value="No_Requerido" />No

           </td>
    </tr>
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Requerimiento:</td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">
     <?php  
	 
 $combo_fo=html_components::dinamic_select_combo(
"cat_construccion_fo", //tabla a la que llegua $tabla
"tipo_req", //nombre del componente $name_componente
"tipo_req",  //id del componente $id_componente
"Estilo1",  //CSS que se desea 
$valores=array(
   "valor_1"=>"2",
   "valor_2"=>"1"
),   //columnas
"combo_requerimiento();", //funciones $js_script
"Requerimiento",//REQUERIMIENTOS
NULL, //OPERADOR LOGICO  $operador=array("1"=>"and","2"=>"or") de acuerdo a la posicio del operador en el query
NULL, //<option>  --'MENSAJE A MOSTRAR '--  </option> ejemplo "HOLA COMBO"
NULL  //valor en  select campo from tabla where valor_1='' and valor_2='SUPERVISOR' "
); 	
echo $combo_fo;

?>
		
        <script>
		jq2('#tipo_req option[value="'+'<?=$array_a["tipo_req"] ?>'+'"]').prop('selected', true);
		</script>
        
        
		</td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Planificador:</td>
		<td bordercolor="#CAE4FF" align="left">
			<select class="Estilo1" name="planificador" id="planificador">
				<?PHP if (($array_a['planificador']==''&&$planificador=='')||($planificador=='')) {$sele2="selected";}else {$sele2="";} ?>
					<option <?PHP echo $sele2; ?> value=''>-- Planificador --</option>";
				<?php
				$a_planif=array("ADC", "CARSO", "NO REQUIERE" );
				for($i=0;$i<count($a_planif);$i++)
					{
						if (($array_a['planificador']==$a_planif[$i]&&$planificador=='')||($planificador==$a_planif[$i])) {$sele2="selected";}else {$sele2="";} 
						echo "<option $sele2 value='$a_planif[$i]'>".$a_planif[$i]."</option>";
					}
				?>
			</select>
		</td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Edo. Acometida:</td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">
			<select class="Estilo1" name="edo_acometida" id="edo_acometida">
				<?php if(($array_a['edo_acometida']==''&&$edo_acometida=='')||($edo_acometida=='')){$s='selected';}else {$s='';}?>
				<option value="" <?php echo $s;?>>-- Edo Acometida --</option>
				<?php if (($array_a['edo_acometida']=='No. REQ ADECUACION'&&$edo_acometida=='')||($edo_acometida=='No. REQ ADECUACION')){$s='selected';}else {$s='';}?>
				<option value="No. REQ ADECUACION" <?php echo $s;?>>No. REQ ADECUACION</option>
				<?php if(($array_a['edo_acometida']=='No. REQ PLANIFICACION'&&$edo_acometida=='')||($edo_acometida=='No. REQ PLANIFICACION')){$s='selected';}else {$s='';}?>
				<option value="No. REQ PLANIFICACION" <?php echo $s;?>>No. REQ PLANIFICACION</option>
				<?php if(($array_a['edo_acometida']=='OK'&&$edo_acometida=='')||($edo_acometida=='OK')){$s='selected';}else {$s='';}?>
				<option value="OK" <?php echo $s;?>>OK</option>
				<?php if(($array_a['edo_acometida']=='PENDIENTE'&&$edo_acometida=='')||($edo_acometida=='PENDIENTE')){$s='selected';}else {$s='';}?>
				<option value="PENDIENTE" <?php echo $s;?>>PENDIENTE</option>
				<?php if(($array_a['edo_acometida']=='PENDIENTE VISITA'&&$edo_acometida=='')||($edo_acometida=='PENDIENTE VISITA')){$s='selected';}else {$s='';}?>
				<option value="PENDIENTE VISITA" <?php echo $s;?>>PENDIENTE VISITA</option>
			</select>		</td>
	</tr>
	<script>
jq2('#edo_acometida option[value="<?=$array_a['edo_acometida']?>"]').prop('selected', true);
	
</script>
    
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Delegacion:</td>
		<td bordercolor="#CAE4FF" align="left">
		<select class="Estilo3"  name='delegacion' id='delegacion'>
		<?php if ($delegacion==''||$array_a['delegacion']==''){$s1='selected';}else {$s1='';}?><option value='' <?php echo $s1;?> >-- Delegacion --</option>
		<?php for($j=0;$j<mysql_num_rows($query_k);$j++)
		{
		$var_deleg=strtoupper(mysql_result($query_k,$j,'delegacion'));
		if (($array_a['delegacion']==$var_deleg&&$delegacion=='')||($delegacion==$var_deleg)){$s1='selected';}else {$s1='';}
		echo "<option value='".$var_deleg."' $s1>".$var_deleg."</option>";
		}
		?>
		</select>		</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2">&nbsp;</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
		<td bordercolor="#CAE4FF" class="Estilo2">&nbsp;</td>
		<td bordercolor="#CAE4FF">&nbsp;</td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Sol. Planificaci&oacute;n:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left"><input class="Estilo1" datepicker='true' name="fecha_sol_planificacion" type="text" id="fecha_sol_planificacion" value="<?php if($_REQUEST['fecha_sol_planificacion']!=''){echo $_REQUEST['fecha_sol_planificacion'];}else{echo $array_a['fecha_sol_planificacion'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Rec Planificaci&oacute;n: </td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left"><input class="Estilo1" datepicker='true' name="fecha_rec_planificacion" type="text" id="fecha_rec_planificacion" value="<?php if($_REQUEST['fecha_rec_planificacion']!=''){echo $_REQUEST['fecha_rec_planificacion'];}else{echo $array_a['fecha_rec_planificacion'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Sol. Permiso SSP:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left"><input class="Estilo1" datepicker='true' name="fecha_sol_permisossp" type="text" id="fecha_sol_permisossp" value="<?php if($_REQUEST['fecha_sol_permisossp']!=''){echo $_REQUEST['fecha_sol_permisossp'];}else{echo $array_a['fecha_sol_permisossp'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Rec Permiso:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left"><input class="Estilo1" datepicker='true' name="fecha_rec_permiso" type="text" id="fecha_rec_permiso" value="<?php if($_REQUEST['fecha_rec_permiso']!=''){echo $_REQUEST['fecha_rec_permiso'];}else{echo $array_a['fecha_rec_permiso'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Estatus Planificaci&oacute;n</td>
        
        
        
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF"><?php
		 $query = "select * from cat_construccion_fo where combo_fo='Planificacion' order by rubro_fo";
echo "<select class='Estilo1'  name='estatus_planificacion' id='estatus_planificacion' onchange='busqueda_archivo_java();'>";
       echo "<option value='0' selected>Seleccione</option>";
   	$result = mysql_query($query);
      while ($row=mysql_fetch_row($result)) 
      { 
	  	if(($_SESSION['usr'] =="CARSO" || $_SESSION['usr'] =="KBTEL") && $row[2] == "Rechazado")
		{

		} else {
             echo '<option value="'.$row[2].'">'.$row[2].'</option>'; 
		}
       } 
echo "</select>"; 
		 
         ?>
         
         <script>
 var myText = '<?=$array_a['estatus_planificacion'] ?>';
// alert(myText);
jq2('#estatus_planificacion option[value="'+'<?=$array_a['estatus_planificacion'] ?>'+'"]').prop('selected', true);
		 </script>
            </td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left" >Fecha Entrega esp FO:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left" class="Estilo2"><input class="Estilo1" datepicker='true' name="fecha_entrega_esp_fo" type="text" id="fecha_entrega_esp_fo" value="<?php if($_REQUEST['fecha_entrega_esp_fo']!=''){echo $_REQUEST['fecha_entrega_esp_fo'];}else{echo $array_a['fecha_entrega_esp_fo'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Adecuaciones Clientes: </td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left" class="Estilo2"><input class="Estilo1" datepicker='true' name="fecha_adecuaciones" type="text" id="fecha_adecuaciones" value="<?php if($_REQUEST['fecha_adecuaciones']!=''){echo $_REQUEST['fecha_adecuaciones'];}else{echo $array_a['fecha_adecuaciones'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF"><input type="button" id="Correo_ele" value="Solicitar Planificaci&oacute;n" onclick='javascript:micorreo();'/>
        </td>
        
	</tr>
    
    <script>
		
		/*Planificacion checkbox*/
 jq("#no_requerido_plan").attr('checked',false);
 	jq("#Correo_ele").removeAttr("disabled");	
		 jq("#no_requerido_plan").click(function(){
	if(jq("#no_requerido_plan").is(':checked')){
	     		jq("#Correo_ele").attr("disabled","disabled");	
		jq("#tipo_req").attr("disabled",true);
		jq("#planificador").attr("disabled",true);
	    jq("#edo_acometida").attr("disabled",true);
        jq("#delegacion").attr("disabled",true);
		
		jq("#fecha_sol_planificacion").removeAttr("datepicker").attr("disabled",true).removeAttr("isdatepicker").attr("value",""); 
	    jq("#CALBUTTONfecha_sol_planificacion").hide();
		   
		
		 jq("#fecha_rec_planificacion").removeAttr("datepicker").attr("disabled",true).removeAttr("isdatepicker").attr("value","");  
		 jq("#CALBUTTONfecha_rec_planificacion").hide();
		   
		
		jq("#fecha_sol_permisossp").removeAttr("datepicker").attr("disabled",true).removeAttr("isdatepicker").attr("value","");  
		jq("#CALBUTTONfecha_sol_permisossp").hide();
		   
		
   
		jq("#fecha_rec_permiso").removeAttr("datepicker").attr("disabled",true).removeAttr("isdatepicker").attr("value","");  
		 jq("#CALBUTTONfecha_rec_permiso").hide();
		   
     	
		
		jq("#fecha_entrega_esp_fo").removeAttr("datepicker").attr("disabled",true).removeAttr("isdatepicker").attr("value","");  
		   jq("#CALBUTTONfecha_entrega_esp_fo").hide();
		   
	    
		jq("#fecha_adecuaciones").removeAttr("datepicker").attr("disabled",true).removeAttr("isdatepicker").attr("value","");  
		jq("#CALBUTTONfecha_adecuaciones").hide();		   
		   		
			jq("#estatus_planificacion").attr("disabled",true);
		jq("#no_requerido_plan").attr("value","No_Requerido");
		     jq.ajax({
   	 url:'modulo_alta_fo_prov/requerido_alta_planifica_contru_fo_pro.php',
	 type:'post',
	 data: {'envio2':jq("#no_requerido_plan").val(),
	        'refere':refe=jq("#refere_si").val()
	 },
	 beforeSend:function(){
        var hola2=jq("#no_requerido_plan").val();
		//alert(hola2)
		 },
	success:function(respuesta){

   //alert(respuesta)
		 }
	 });      

		  }
else{
	jq("#Correo_ele").removeAttr("disabled");	
jq("#tipo_req").removeAttr("disabled");
		jq("#planificador").removeAttr("disabled");
	    jq("#edo_acometida").removeAttr("disabled");
        jq("#delegacion").removeAttr("disabled");

jq("#fecha_sol_planificacion").attr("datepicker",true).removeAttr("disabled").attr("isdatepicker",true); 
		   jq("#CALBUTTONfecha_sol_planificacion").show();
	
	jq("#fecha_sol_planificacion").attr("datepicker",true).removeAttr("disabled").attr("isdatepicker",true); 
		   jq("#CALBUTTONfecha_sol_planificacion").show();
		   
		   jq("#fecha_rec_planificacion").attr("datepicker",true).removeAttr("disabled").attr("isdatepicker",true); 
		   jq("#CALBUTTONfecha_rec_planificacion").show();
		   
		   jq("#fecha_sol_permisossp").attr("datepicker",true).removeAttr("disabled").attr("isdatepicker",true); 
		   jq("#CALBUTTONfecha_sol_permisossp").show();	   
		   
		   
		   jq("#fecha_rec_permiso").attr("datepicker",true).removeAttr("disabled").attr("isdatepicker",true); 
		   jq("#CALBUTTONfecha_rec_permiso").show();	   
		   
		   jq("#fecha_entrega_esp_fo").attr("datepicker",true).removeAttr("disabled").attr("isdatepicker",true); 
		   jq("#CALBUTTONfecha_entrega_esp_fo").show();	   
		   
		   jq("#fecha_adecuaciones").attr("datepicker",true).removeAttr("disabled").attr("isdatepicker",true); 
		   jq("#CALBUTTONfecha_adecuaciones").show();	   
		       
	  jq("#estatus_planificacion").removeAttr("disabled");

		jq("#no_requerido_plan").attr("value",null);
     jq.ajax({
   	 url:'modulo_alta_fo_prov/requerido_alta_planifica_contru_fo_pro.php',
	 type:'post',
	 data: {'envio':jq("#no_requerido_plan").val(),
	        'refere':refe=jq("#refere_si").val()
	 },
	success:function(respuesta){
//   alert(respuesta)
		 }
	 });      

		  }


		});
	</script>
    
<!-- ////////////////////////////////////////////////////////////////////////////////////////FINPLANIFICACION  -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->



<!-- ////////////////////////////////////////////////////////////////////////////////////////INICIOPROYECTOS  -->
	<tr class="proyectos" bgcolor="#999999"><td colspan="6" height="4"></td></tr>
	<tr class="proyectos"><td colspan="6" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo4" align="left"><a name="ancla_proy"></a>Proyectos</td></tr>
	
	<tr class="proyectos">
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">PEP:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left">
		<!--<input class="Estilo1" name="pep_a" type="text" id="pep_a" value="<?php //if($_REQUEST['pep_a']!=''){echo $_REQUEST['pep_a'];}else{echo $array_a['pep'];}?>"  onchange="document.solicita.comprobar.value='PEP'; document.solicita.submit();" />-->
		<input class="Estilo1 required" name="pep_a" type="text" id="pep_a" value="<?php if($_REQUEST['pep_a']!=''){echo $_REQUEST['pep_a'];}else{echo $array_a['pep'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Pedido 45:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">
		<!--<input class="Estilo1" name="pedido45_a" type="text" id="pedido45_a" value="<?php //if($_REQUEST['pedido45_a']!=''){echo $_REQUEST['pedido45_a'];}else{echo $array_a['pedido45'];}?>" onchange="document.solicita.comprobar.value='PEDIDO45'; document.solicita.submit();" />-->
		<input class="Estilo1" name="pedido45_a" type="text" id="pedido45_a" value="<?php if($_REQUEST['pedido45_a']!=''){echo $_REQUEST['pedido45_a'];}else{echo $array_a['pedido45'];}?>"  />
		</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Estatus OT FO:</td>
		<td height="23" bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left">
        
   <?php
/* $combo_fo_proy_es=html_components::dinamic_select_combo(
"cat_construccion_fo", //tabla a la que llegua $tabla
"fo_proy_es", //nombre del componente $name_componente
"fo_proy_es",  //id del componente $id_componente
"Estilo1",  //CSS que se desea 
$valores=array(
   "valor_1"=>"2",
   "valor_2"=>"1"
),   //columnas
NULL,
"estatus_ot");*/


 $combo_fo_proy_es=html_components::dinamic_select_combo(
"cat_construccion_fo", //tabla a la que llegua $tabla
"fo_proy_es", //nombre del componente $name_componente
"fo_proy_es",  //id del componente $id_componente
"Estilo1",  //CSS que se desea 
$valores=array(
   "valor_1"=>"2",
   "valor_2"=>"1"
),   //columnas
NULL, //funciones $js_script
"estatus_ot",//REQUERIMIENTOS
NULL, //OPERADOR LOGICO
NULL, //<option>  --'MENSAJE A MOSTRAR '--  </option>
NULL  //valor en  select campo from tabla where valor_1='' and valor_2='SUPERVISOR' "
); 	//nuevas opción o sin opción 
	 //funciones $js_script
echo $combo_fo_proy_es;
		
		
		/*
		 $query = "select * from cat_construccion_fo where combo_fo='estatus_ot'";
  echo "<select class='Estilo1' name='fo_proy_es' id='fo_proy_es'>";
       echo "<option value='0'>Seleccione</option>";
   	$result = mysql_query($query);
      while ($row=mysql_fetch_row($result)) 
      { 
       echo '<option value="'.$row[2].'">'.$row[2].'</option>'; 
       } 
echo "</select>"; */
         ?>
<script>
var parametro = "<?=$array_a["fo_proy_es"]?>";
var tipo_req="<?=$array_a["tipo_req"]?>";
if (parametro == "") { parametro = "En elaboracion de OT"; }
// alert(myText);
jq2('#fo_proy_es option[value="'+parametro+'"]').prop('selected', true);

//jq2('#tipo_req option[value="'+tipo_req+'"]').prop('selected', true);
</script>

        
         <!--COMBO estatus_ot-->
	</tr>
	
	<tr class="proyectos">
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Entrega OT:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left"><input class="Estilo1" name="fecha_ent_ot" type="text" id="fecha_ent_ot" value="<?php echo $array_a['fecha_ent_ot'];?>" datepicker="true" datepicker_format="YYYY-MM-DD" maxlength="10" isdatepicker="true" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha OT OK:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" name="fecha_proyecto" type="text" id="fecha_proyecto" value="<?=$array_a['fecha_proyecto'];?>" datepicker="true" datepicker_format="YYYY-MM-DD" maxlength="10" isdatepicker="true"/></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">&nbsp;</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
	</tr>

	<tr class="proyectos">
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Fecha Ent 50:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left"><input class="Estilo1" datepicker='true' name="fecha_ent_50" type="text" id="fecha_ent_50" value="<?php if($_REQUEST['fecha_ent_50']!=''){echo $_REQUEST['fecha_ent_50'];}else{echo $array_a['fecha_ent_50'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Problematica en Sitio:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" name="dependencia_proyecto" type="text" id="dependencia_proyecto" value="<?php if($_REQUEST['dependencia_proyecto']!=''){echo $_REQUEST['dependencia_proyecto'];}else{echo $array_a['dependencia_proyecto'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Constructor:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left">
			<select class="Estilo1" name="constructor" id="constructor" >
				<?php if (($array_a['constructor']==''&&$constructor=='')||($constructor=='')){$s='selected';}else {$s='';}?>
				<option value="" <?php echo $s;?>>-- Constructor --</option>
				<?php if (($array_a['constructor']=='ADC'&&$constructor=='')||($constructor=='ADC')){$s='selected';}else {$s='';}?>
				<option value="ADC" <?php echo $s;?>>ADC</option>
				<?php if (($array_a['constructor']=='CARSO'&&$constructor=='')||($constructor=='CARSO')){$s='selected';}else {$s='';}?>
				<option value="CARSO" <?php echo $s;?>>CARSO</option>
			</select>		</td>
	</tr>

	<tr class="proyectos">
		<td bordercolor="#CAE4FF" class="Estilo2" align="left"></td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left"></td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left"></td>
		<td bordercolor="#CAE4FF" align="left"></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">&nbsp;</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
	</tr>
<!-- ////////////////////////////////////////////////////////////////////////////////////////FINPROYECTOS  -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////-- ancla_cons  -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////INICIOCONSTRUCCION  -->
	<tr bgcolor="#999999"><td colspan="6" height="4"></td></tr>
	<tr class="constru"><td colspan="2" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo4" align="left"><a name="ancla_cons"></a>Construcci&oacute;n</td>
        <td id="con" colspan="2"   bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo4">Requiere Construcci&oacute;n</td>
       <td id="con2" class="Estilo2">  <input  id="no_requerido" name="requeri_forma" type="checkbox" value="No_Requerido" />No

           </td>
    </tr>
    
	
	<tr class="constru">
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">PES:</td>
		<td bordercolor="#CAE4FF" class="Estilo2 required" align="left"><input class="Estilo1 required" name="pes" type="text" id="pes" value="<?php if($_REQUEST['pes']!=''){echo $_REQUEST['pes'];}else{echo $array_a['pes'];}?>" /></td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">NCO/ROF:</td>
		<td bordercolor="#CAE4FF" align="left"><input class="Estilo1" name="nco" type="text" id="nco" value="<?php if($_REQUEST['nco']!=''){echo $_REQUEST['nco'];}else{echo $array_a['nco'];}?>" /></td>
		<td bordercolor="#CAE4FF" class="Estilo2 required" align="left">Anillo:</td>
		<td bordercolor="#CAE4FF" align="left"><input class="Estilo1 required" name="anillo_rof" type="text" id="anillo_rof" value="<?php if($_REQUEST['anillo_rof']!=''){echo $_REQUEST['anillo_rof'];}else{echo $array_a['anillo_rof'];}?>" /></td>
	</tr>
	
	<tr class="constru">
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Longitud Trabajo:</td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" name="longitud_trab" type="text" id="longitud_trab" value="<?php if($_REQUEST['longitud_trab']!=''){echo $_REQUEST['longitud_trab'];}else{echo $array_a['longitud_trab'];}?>" /></td>
		<td height="24" bordercolor="#CAE4FF" class="Estilo2" align="left">Atenuacion Trabajo: </td>
		<td bordercolor="#CAE4FF" align="left"><input class="Estilo1" name="atenuacion_trab" type="text" id="atenuacion_trab" value="<?php if($_REQUEST['atenuacion_trab']!=''){echo $_REQUEST['atenuacion_trab'];}else{echo $array_a['atenuacion_trab'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
	</tr>

	<tr class="constru">
		<td bordercolor="#CAE4FF" class="Estilo2 required" align="left">Longitud Respaldo:</td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" name="longitud_resp" type="text" id="longitud_resp" value="<?php if($_REQUEST['longitud_resp']!=''){echo $_REQUEST['longitud_resp'];}else{echo $array_a['longitud_resp'];}?>" /></td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Atenuacion Respaldo: </td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" name="atenuacion_resp" type="text" id="atenuacion_resp" value="<?php if($_REQUEST['atenuacion_resp']!=''){echo $_REQUEST['atenuacion_resp'];}else{echo $array_a['atenuacion_resp'];}?>" /></td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF">&nbsp;</td>
	</tr>
	<tr bgcolor="#999999"><td colspan="6">
      <iframe id="iframe_Carga2" src="modulo_alta_fo_prov/inclu_trayectorias2.php?ref_sisa_a=<?=$_REQUEST['ref_sisa_a']?>&envia_punta=<?=$_REQUEST['envia_punta']?>&anillo_rof=<?=$_REQUEST['anillo_rof']?>&cliente_comun=<?=$rowSL['cliente_comun']?>&central=<?= $rowSL['central']?>"  style=" width:100%; background-color:#CAE4FF;" height="372px"  scrolling="no" frameborder="0" AllowTransparency></iframe>
    </td></tr>

	<tr><td colspan="6" bordercolor="#CAE4FF" bgcolor="#CAE4FF"></td></tr>

	<tr>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">FO Construccion Estatus: </td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left">
	

         <?php
/*		 $query = "select * from cat_construccion_fo where combo_fo='estatus construccion'";
  echo "<select class='Estilo1' name='estatus_const_fo' id='estatus_const_fo'>";
       echo "<option value='0' selected>Seleccione</option>";
   	$result = mysql_query($query);
      while ($row=mysql_fetch_row($result)) 
      { 
       echo '<option value="'.$row[2].'">'.$row[2].'</option>'; 
       } 
echo "</select>"; */

$combo_estatus_const_fo=html_components::dinamic_select_combo(
"cat_construccion_fo", //tabla a la que llegua $tabla
"estatus_const_fo", //nombre del componente $name_componente
"estatus_const_fo",  //id del componente $id_componente
"Estilo1",  //CSS que se desea 
$valores=array(
  "valor_1"=>"2",
   "valor_2"=>"1"
   ),   //columnas
NULL, //funciones $js_script
"estatus construccion",//REQUERIMIENTOS
NULL, //OPERADOR LOGICO
NULL, //<option>  --'MENSAJE A MOSTRAR '--  </option>
NULL  //valor en  select campo from tabla where valor_1='' and valor_2='SUPERVISOR' "
); 	//nuevas opción o sin opción 



	 //funciones $js_script
echo $combo_estatus_const_fo;
/*$obj_select_fo_estatus=dao_contruccion_fo_god::select_dinamic_query($_REQUEST['ref_sisa_a'], $_REQUEST['envia_punta'], "construccion_fo",$array_valores=array(
   "valor_44"=>"1",
    "valor_45"=>"1"
   ));*/
   
$obj_select_fo_estatus=Genericos_querys_mapper::generyc_mapper_querys(
"select",
$_REQUEST['ref_sisa_a'],
$_REQUEST['envia_punta'],
"construccion_fo",
$valores=array(
         "44"=>"1",
         "45"=>"1"),
"array_asoc"
);  
   
         ?>
         
             	 <script>
       jq2('#estatus_const_fo option[value="<?=$obj_select_fo_estatus['estatus_const_fo']?>"]').prop('selected', true);
	     jq("#estatus_const_fo").change(function(){
		jq("#B_mod").removeAttr("disabled");
  var valor = jq("#estatus_const_fo").val();
           
		       if(valor!="FO Terminada" )
			   {
		        var usr_li='<?= $_SESSION['usr'] ?>';  
		           if(usr_li!="KBTEL" && usr_li!="CARSO" )
					{
				  	  
					actualiza_terminar_refSisa('<?=$_REQUEST['ref_sisa_a']?>','<?=$_REQUEST['envia_punta']?>','liquidada','0');
					  
					}
			   
		       }
		 
		 if(valor=="FO Terminada" )
		 {
	                var usuario_carso='<?= $_SESSION['usr'] ?>';  
					if(usuario_carso=="CARSO")
					{
					 busqueda_archivos('<?=$_REQUEST['ref_sisa_a']?>','<?=$_REQUEST['envia_punta']?>','<?=$_SESSION['usr']?>');
				    }
				   	if(usuario_carso!="KBTEL" && usuario_carso!="CARSO" )
					{
				  	  
					actualiza_terminar_refSisa('<?=$_REQUEST['ref_sisa_a']?>','<?=$_REQUEST['envia_punta']?>','liquidada','1');
					  
					}
  
		 }
                    if(valor=="FO En Construccion con Dependencias" )
					{
                  	  jq("#dependencia_construccion").removeAttr("disabled");
				jq2('#dependencia_construccion option[value="<?=$obj_select_fo_estatus['dependencia_construccion']?>"]').prop('selected', true);					  
                    } 
						else
						{
						jq("#dependencia_construccion option:eq(0)").attr("selected","selected");
						  jq("#dependencia_construccion").attr("disabled",true);
						  
						}
  		

		});


 </script>  
    
        </td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Dependencias:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">
			<?php
		 $query = "select * from cat_construccion_fo where combo_fo='dependencia construccion'";
echo "<select class='Estilo3'  name='dependencia_construccion' id='dependencia_construccion'>";
       echo "<option value='' selected>Seleccione</option>";
   	$result = mysql_query($query);
      while ($row=mysql_fetch_row($result)) 
      { 
	   
      echo '<option value="'.$row[2].'">'.$row[2].'</option>'; 
       } 
echo "</select>"; 

		 
         ?>
         
   <script>
 var  valor_cambio="<?=$obj_select_fo_estatus['estatus_const_fo']?>";
      if(valor_cambio=="FO En Construccion con Dependencias" )
					{
                  	  jq("#dependencia_construccion").removeAttr("disabled");
jq2('#dependencia_construccion option[value="<?=$obj_select_fo_estatus['dependencia_construccion']?>"]').prop('selected', true);
										  
                    } 
						else
						{
						 jq("#dependencia_construccion option:eq(0)").attr("selected","selected");
						  jq("#dependencia_construccion").attr("disabled",true);
						  
						}
  		
   
   </script>      
            
            	</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo2" align="left">Supervisor Cons:</td>
		<td bordercolor="#CAE4FF" bgcolor="#CAE4FF" align="left">
		<?php 
		
 $combo_cat_tecnic=html_components::dinamic_select_combo(
"cat_tecnicos", //tabla a la que llegua $tabla
"supervisor_const", //nombre del componente $name_componente
"supervisor_const",  //id del componente $id_componente
"Estilo1",  //CSS que se desea 
$valores=array(
   "valor_1"=>"lleno"
   ),   //columnas
NULL, //funciones $js_script
NULL,//REQUERIMIENTOS
$operador=array(
"1"=>"and"
), //OPERADOR LOGICO
"supervisor_const", //<option>  --'MENSAJE A MOSTRAR '--  </option>
$valor_comparar=array(
   "valor_2"=>"RDA CARSO",
   "valor_3"=>"SUPERVISOR"
    //valor en  select campo from tabla where valor_1='' and valor_2='SUPERVISOR' "
)
); 	//nuevas opción o sin opción 

//echo $combo_cat_tecnic;

		?>	
        <input type='text' name='supervisor_const' id='supervisor_const' value=''>
        </td>
        <script>
		var valor_superviso_const='<?=$array_a['supervisor_const']?>';
	    jq("#supervisor_const").val(valor_superviso_const);
        </script>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Fecha Remate FO: </td>
		<td bordercolor="#CAE4FF" align="left"><input class="Estilo1" datepicker='true' name="fecha_remate_fo" type="text" id="fecha_remate_fo" value="<?php echo $array_a['fecha_remate_fo'];?>" readonly="readonly" /></td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Fecha Entrega FO:</td>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left"><input class="Estilo1" datepicker='true' name="fecha_en_fo" type="text" id="fecha_en_fo" value="<?php if($_REQUEST['fecha_en_fo']!=''){echo $_REQUEST['fecha_en_fo'];}else{echo $array_a['fecha_en_fo'];}?>" /></td>
		<td bordercolor="#CAE4FF" class="Estilo2">&nbsp;</td>
		<td bordercolor="#CAE4FF" class="Estilo2">&nbsp;</td>
	</tr>

	<tr bgcolor="#999999"><td colspan="6" height="4"></td></tr>
	
	<tr><td colspan="6" bordercolor="#CAE4FF" bgcolor="#CAE4FF">
	<?php  include('modulo_alta_fo_prov/carga_archvos_principal_prov.php') ?>
	</td></tr>
<!-- ////////////////////////////////////////////////////////////////////////////////////////FINCONSTRUCCION  -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


	<tr bgcolor="#999999"><td colspan="6" height="4"></td></tr>
	<tr><td colspan="6" bordercolor="#CAE4FF" class="Estilo4" align="left"><a name="ancla_com"></a>Comentarios</td></tr>
	
	<tr><td colspan="6" bordercolor="#CAE4FF" align="center">
		<table width="43%">
			<tr>
			<td align="center" bordercolor="#CAE4FF" class="Estilo2">Observaciones</td>
			<td align="center" bordercolor="#CAE4FF" class="Estilo2">Bitacora</td>
			</tr>
			
			<tr>
			<td align="center" bordercolor="#CAE4FF"><textarea name="observaciones" cols="40" rows="5" id="observaciones"><?php if($_REQUEST['observaciones']!=''){echo $_REQUEST['observaciones'];}?></textarea></td>
			<td align="center" bordercolor="#CAE4FF">
			<textarea name="bitacora_observ" id="bitacora_observ" cols="40" rows="5" readonly="readonly"><?php
			$datos_obs=explode("|",$array_a['observaciones']);
			$ta_datos=sizeof($datos_obs);
			for ($tt=0;$tt<$ta_datos;$tt++){echo $datos_obs[$tt]."\n";}
			?></textarea></td> 
			</tr>
		</table>
	</td></tr>

	<tr><td colspan="6" bordercolor="#CAE4FF">&nbsp;</td></tr>
	<tr><td colspan="6" align="center" bordercolor="#CAE4FF">
			<input type='button' name='B_mod' id='B_mod' value='Guardar' onclick='javascript:guardar_datos();' />
		<?php  if(trim($array_a['validacion_ot'])=='OK'&&$array_a['estatus_const_fo']!='LIQUIDADA'){ ?>
			&nbsp;&nbsp;<input type="submit" name="B_liqu" id="B_liqu" value="Liquidar" onclick='document.solicita.validacion.value=2;' />
		<?php  } ?>
	</td></tr>
      


</table>
<!-- FINTABLA  -->



<!-- INICIO -- TABLA  -->
<br/>
<table id="informacion_OT" width='990px' bordercolor='#666666' bgcolor='#CAE4FF' border="2" >		
	<tr><td colspan="4" bordercolor="#CAE4FF" class="Estilo4" align="left"><a name="ancla_inf_ot"></a>Informacion de OT</td></tr>
	<tr>
		<td bordercolor="#CAE4FF" align="left"></td>
		<td colspan="3" bordercolor="#CAE4FF" align="left"></td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Num OT: </td>
		<td colspan="3" bordercolor="#CAE4FF" align="left"><strong><? echo $array_a['ot_fo'];?></strong></td>
	</tr>
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Prioridad:</td>
		<td colspan="3" bordercolor="#CAE4FF" align="left">
			<select class="Estilo1"  name="prioridad" id="prioridad" >
			<?php if (($array_a['prioridad']=='' && $prioridad=='')||($prioridad=='')){$s='selected';}else {$s='';}?>
			<option value="" <?php echo $s;?>>-- Prioridad --</option>
			<?php if (($array_a['prioridad']=='NORMAL' && $prioridad=='')|| ($prioridad=='NORMAL')){$s='selected';}else {$s='';}?>
			<option value="NORMAL" <?php echo $s;?>>NORMAL</option>
			<?php if (($array_a['prioridad']=='URGENTE'&&$prioridad=='')||($prioridad=='URGENTE')){$s='selected';}else {$s='';}?>
			<option value="URGENTE" <?php echo $s;?>>URGENTE</option>
			<?php if (($array_a['prioridad']=='PROGRAMA'&&$prioridad=='')||($prioridad=='PROGRAMA')){$s='selected';}else {$s='';}?>
			<option value="PROGRAMA" <?php echo $s;?>>PROGRAMA</option>
			</select>
		</td>
	</tr>
	<?php if($paquete_cons=='' && $array_a['paquete_cons']!='') $paquete_cons==$array_a['paquete_cons']; ?>
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Paquete:</td>
		<td colspan="3" bordercolor="#CAE4FF" align="left">
			<select class="Estilo1"  name='paquete_cons' id='paquete_cons' onchange="submit();" >
			<?php if ($paquete_cons==''){$s1='selected';}else {$s1='';}?>
			<option value='' <?php echo $s1;?> >-- Paquete --</option>
			<?php for($j=0;$j<mysql_num_rows($query_i);$j++)
			{
				$var_paquete=mysql_result($query_i,$j,'paquete');
				if ($paquete_cons==$var_paquete){$s1='selected';}else {$s1='';}
				echo "<option value='".$var_paquete."' $s1>".$var_paquete."</option>";
			}
			?>
			</select>
		</td>
	</tr>
	
	<?php if($array_a['paquete_cons']!='' || $paquete_cons!='') {  ?>
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left"></td>
		<td colspan="3" bordercolor="#CAE4FF" align="left">
			<?php 
			if($array_a['paquete_cons']!='' && $paquete_cons==''){$cons_paquete = $array_a['paquete_cons']; } else {$cons_paquete = $paquete_cons; }
			$mysql_j = "select paquete, cantidad, descripcion from cat_materiales where tipo_equipo='FO' and paquete='".$cons_paquete."' order by consecutivo ASC";
			$query_j = mysql_query($mysql_j);
			?>
			<table border="2" bordercolor="#666666">
				<tr>
					<td align="center" bordercolor="#999999" bgcolor="#00E6E6" class="Estilo2"><span class="Estilo5">&nbsp;No. PAQUETE&nbsp;</span></td>
					<td align="center" bordercolor="#999999" bgcolor="#00E6E6" class="Estilo2"><span class="Estilo5">&nbsp;CANTIDADES&nbsp;</span></td>
					<td align="center" bordercolor="#999999" bgcolor="#00E6E6" class="Estilo2"><span class="Estilo5">&nbsp;DESCRIPCION DE PAQUETE&nbsp;</span></td>
				</tr>
			
				<tr bgcolor="#FFFFFF">
					<td rowspan="<?php echo mysql_num_rows($query_j)+1;?>" bordercolor="#999999" class="Estilo2" align="center" ><strong><?php echo "Paquete ".$cons_paquete;  ?></strong></td>
				</tr>
				<?php
				for ($b=0; $b<mysql_num_rows($query_j); $b++)
				{ echo "<tr bgcolor='#FFFFFF'><td >&nbsp;&nbsp;&nbsp;".mysql_result($query_j,$b,'cantidad')."&nbsp;&nbsp;</td><td >&nbsp;&nbsp;&nbsp;".mysql_result($query_j,$b,'descripcion')."&nbsp;&nbsp;</td></tr>"; }
				?>
			</table>
		</td>
	</tr>
	<?php } ?>
	
	<tr>
		<td width="146" bordercolor="#CAE4FF" class="Estilo2" align="left">Nota: </td>
		<td colspan="3" bordercolor="#CAE4FF" align="left">
		<?php 
		if ($array_a['nota']=='' && $nota==''){$var_nota='PARA INICIAR LA CONST. DE PROYECTO, VERIFICAR QUE LAS FIBRAS ASIGNADAS CIERREN EN ANILLO Y CHECAR LA HERMETICIDAD DEL CIERRE ANTES Y DESPUES DE DERIVAR. LA ENTREGA DE LA MEMORIA TECNICA Y LAS UNIDADES DE CONSTRUCCION DEBEN ENTREGARSE ANTES DE CONCLUIR EL PROYECTO';}
		elseif ($array_a['nota']!='' && $nota==''){$var_nota=$array_a['nota'];}
		else {$var_nota=$nota;}
		?>
		<textarea name="nota" cols="80" rows="5" id="nota"><?=$var_nota?></textarea>
		</td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2" align="left">Observaciones: </td>
		<td colspan="3" bordercolor="#CAE4FF" align="left">
		<?php if ($array_a['observaciones_ot']!=''&&$observaciones_ot==''){$var_obser_ot=$array_a['observaciones_ot'];} else{$var_obser_ot=$observaciones_ot;}?>
		<textarea name="observaciones_ot" cols="80" rows="5" id="observaciones_ot"><?=$var_obser_ot?></textarea>
		</td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" class="Estilo2"  align="left">Responsable Cliente:</td>
		<td width="" bordercolor="#CAE4FF"  align="left"><input class="Estilo1" name="responsable_cliente" type="text" id="responsable_cliente" value="<?php if($_REQUEST['responsable_cliente']!=''){echo $_REQUEST['responsable_cliente'];}else{echo $array_a['responsable_cliente'];}?>" /></td>
		<td width="" bordercolor="#CAE4FF" class="Estilo2"  align="left">Telefono:</td>
		<td width="" bordercolor="#CAE4FF"  align="left"><input class="Estilo1" name="telefono_cliente" type="text" id="telefono_cliente" value="<?php if($_REQUEST['telefono_cliente']!=''){echo $_REQUEST['telefono_cliente'];}else{echo $array_a['telefono_cliente'];}?>" /></td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" >&nbsp;</td>
		<td bordercolor="#CAE4FF" ></td>
		<td bordercolor="#CAE4FF" ></td>
		<td bordercolor="#CAE4FF" ></td>
	</tr>
	
	<tr>
		<td bordercolor="#CAE4FF" >&nbsp;</td>
		<td colspan="3" bordercolor="#CAE4FF" align="center"><input type="submit" name="gen_ot" value="Generar OT" onclick="javascript:guardar_datos_2();" />
		<!--<input type="submit" name="gen_ot" value="Generar OT" onclick="document.solicita.modificacion.value='1'; document.solicita.submit();" />-->
		</td>
	</tr>

	<tr>
		<td bordercolor="#CAE4FF" >&nbsp;</td>
		<td bordercolor="#CAE4FF" ></td>
		<td bordercolor="#CAE4FF" ></td>
		<td bordercolor="#CAE4FF" ></td>
	</tr>
</table>



<!-- INICIOTABLA  -->
<br/>


<!-- INICIO PESTAÑA DOS -->
<table id="pes_equipami" width="100%" border="2" bordercolor='#666666' bgcolor='#CAE4FF' >
	<tr><td bordercolor="#CAE4FF" class="Estilo2"><?php include ('inclu_liquida_ingenieria.php'); ?></td></tr>
</table>
 <!-- FIN PESTAÑA DOS -->






<!--<a name="pes_bitac" id="lnk_bitac"></a>-->
<table id="pestaña_bitacora" width="100%" border="2" bordercolor='#666666' bgcolor='#CAE4FF' >
	<tr>
		<?php // Corresponden al campo de la vista donde se muestra la informacion general del servicio
		echo "<td bordercolor='#CAE4FF' class='Estilo28' align='left' >";
			$datos_obs=explode("|",$rowSL['observaciones_servicio']);
			$ta_datos=sizeof($datos_obs);
			for ($tt=0; $tt<$ta_datos; $tt++) {  if(strlen($datos_obs[$tt]>3)){echo "<br> ".$datos_obs[$tt];echo "<hr />";}   }
		echo '</td>';
		?>
	</tr>
</table>

<!-- INICIO PESTAÑA CUATRO -->
<table  id="pes_topo" width="100%" border="2" bordercolor='#666666' bgcolor='#CAE4FF' >
	<tr><td colspan="2" align="left" bordercolor="#CAE4FF" bgcolor="#CAE4FF" class="Estilo4">Topologico</td></tr>
	<tr><td bordercolor="#CAE4FF" class="Estilo2">
		<img src="wp/tester.php?r=<?php echo $_REQUEST['ref_sisa_a']; ?>&l=<?php echo $_REQUEST['envia_punta']; ?>&t=fo" width="900"/>
	</td></tr>
</table>


<!-- FIN PESTAÑA TRES -->


<script>
jq("#pestaña_bitacora").hide();
jq("#pes_topo").hide();
jq("#pes_equipami").hide();

jq("#lnk_fo").click(function(){
jq("#pestaña_bitacora").hide();
jq("#pes_topo").hide();
 jq("#cuerpo_principal").show(); 
 jq("#informacion_OT").show();
 jq("#pes_equipami").hide();
 
 
	});

jq("#lnk_bitac").click(function(){
	//	alert("hola pestaña bitacora");
 jq("#pestaña_bitacora").show(); 
 jq("#cuerpo_principal").hide(); 
  jq("#informacion_OT").hide();
 jq("#pes_topo").hide();
 jq("#pes_equipami").hide();
	});

jq("#lnk_topo").click(function(){
	jq("#pes_topo").show();
	 jq("#pestaña_bitacora").hide(); 
 jq("#cuerpo_principal").hide(); 
  jq("#pes_equipami").hide();
  jq("#informacion_OT").hide();
	});
	
jq("#lnk_equipami").click(function(){
 jq("#pes_equipami").show();	
 jq("#pes_topo").hide();
 jq("#informacion_OT").hide();
 jq("#pestaña_bitacora").hide(); 
 jq("#cuerpo_principal").hide(); 
  
	});


          jq("#no_actualiza").removeAttr("value","0000-00-00");
     jq("#no_requerido").attr('checked',false);
     jq("#no_requerido").click(function(){
	if(jq("#no_requerido").is(':checked')){
        jq("#CALBUTTONfecha_en_fo").hide();
 jq("#pes").attr("readonly",true).removeClass("validation-failed").removeClass("required");
jq("#nco").attr("readonly",true).removeClass("validation-failed").removeClass("required");
jq("#anillo_rof").attr("readonly",true).removeClass("validation-failed").removeClass("required");
jq("#longitud_trab").attr("readonly",true).removeClass("validation-failed").removeClass("required");
jq("#atenuacion_trab").attr("readonly",true).removeClass("validation-failed").removeClass("required");
jq("#longitud_resp").attr("readonly",true).removeClass("validation-failed").removeClass("required");
jq("#atenuacion_resp").attr("readonly",true).removeClass("validation-failed").removeClass("required");
jq("#estatus_const_fo").attr("disabled",true);
jq("#dependencia_construccion").attr("disabled",true);
jq("#supervisor_const").attr("disabled",true); 
jq("#fecha_remate_fo").attr("readonly",true); 
jq("#fecha_en_fo").removeAttr("datepicker").attr("readonly",true).removeAttr("datepicker_format"); 


jq("div").remove(".validation-advice");
jq("#no_requerido").attr("value","No_Requerido");
 jq.ajax({
   	 url:'modulo_alta_fo_prov/requerido_alata_constru_fo_pro.php',
	 type:'post',
	 data: {'envio':jq("#no_requerido").val(),
	        'refere':refe=jq("#refere_si").val()
	 },
	success:function(respuesta){
//   alert(respuesta)
		 }
	 });      

		}  
	  else{
/* PAr de fibras*/
		  jq("#CALBUTTONfecha_en_fo").show();		
		   jq("#pes").removeAttr("readonly").addClass("Estilo1 required");
jq("#nco").removeAttr("readonly").addClass("Estilo1 required");
jq("#anillo_rof").removeAttr("readonly").addClass("Estilo1 required");
jq("#longitud_trab").removeAttr("readonly").addClass("Estilo1 required");
jq("#atenuacion_trab").removeAttr("readonly").addClass("Estilo1 required");
jq("#longitud_resp").removeAttr("readonly").addClass("Estilo1 required");
jq("#atenuacion_resp").removeAttr("readonly").addClass("Estilo1 required");
jq("#estatus_const_fo").removeAttr("disabled");
jq("#dependencia_construccion").attr("disabled",true);
jq("#supervisor_const").attr("disabled",true); 
jq("#fecha_remate_fo").removeAttr("readonly");
jq("#fecha_en_fo").removeAttr("readonly").attr("datepicker",true).attr("datepicker_format","YYYY-MM-DD");		
jq("div").remove(".validation-advice");
jq("#no_requerido").attr("value",null);
     jq.ajax({
   	 url:'modulo_alta_fo_prov/requerido_alata_constru_fo_pro.php',
	 type:'post',
	 data: {'envio':jq("#no_requerido").val(),
	        'refere':refe=jq("#refere_si").val()
	 },
	success:function(respuesta){
//   alert(respuesta)
		 }
	 });      

		  }


		});
	
	
    </script>

		
<?php  
$query2 = "select cons_requerid from construccion_fo where ref_sisa='".$_REQUEST['ref_sisa_a']."'"; //corregir esto que
//echo $query2;
$resultado = mysql_query($query2);
//echo $resultado;
$roww=mysql_fetch_row($resultado);
//echo $roww[0];
?>

<script>
	var rol = '<?= $_SESSION['usr'] ?>';
	if(rol=="CARSO"){
jq("#Correo_ele").hide();
jq("#con_plan").hide();
jq("#con_plan2").hide();
jq("#con").hide();
jq("#con2").hide();
//jq("#no_requerido").hide();
var  queryRe='<?=$roww[0]?>';		
if(queryRe=="No_Requerido"){
	//alert(queryRe);
//jq("#no_requerido").attr("disabled",true);
jq("#pes").attr("readonly",true).removeClass("required");
jq("#longitud_trab").attr("readonly",true).removeClass("required");
jq("#longitud_resp").attr("readonly",true).removeClass("required");
jq("#nco").attr("readonly",true).removeClass("required");
jq("#atenuacion_trab").attr("readonly",true).removeClass("required");
jq("#atenuacion_resp").attr("readonly",true).removeClass("required");
jq("#anillo_rof").attr("readonly",true).removeClass("required");
jq("#estatus_const_fo").attr("disabled",true);
jq("#dependencia_construccion").attr("disabled",true);
jq("#supervisor_const").attr("disabled",true); 
jq("#fecha_remate_fo").attr("readonly",true); 
jq("#fecha_en_fo").removeAttr("datepicker").attr("readonly",true).removeAttr("datepicker_format"); 

	}
	
	
	
	

jq("#planificador").attr("disabled",true);
jq("#edo_acometida").attr("disabled",true);
jq("#delegacion").attr("disabled",true);
jq("#fecha_sol_planificacion").removeAttr("datepicker").attr("readonly",true);
jq("#fecha_rec_planificacion").removeAttr("datepicker").attr("readonly",true);
jq("#fecha_sol_permisossp").removeAttr("datepicker").attr("readonly",true);
jq("#fecha_rec_permiso").removeAttr("datepicker").attr("readonly",true);
jq("#fecha_entrega_esp_fo").removeAttr("datepicker").attr("readonly",true);
jq("#fecha_adecuaciones").removeAttr("datepicker").attr("readonly",true);
jq("#estatus_planificacion").attr("disabled",true);
/*PROYECTOS*/
jq("#pep_a").attr("readonly",true);
jq("#pedido45_a").attr("readonly",true);
jq("#fo_proy_es").attr("readonly",true);
jq("#fecha_ent_ot").attr("readonly",true);
jq("#fecha_proyecto").attr("readonly",true);
jq("#fecha_ent_50").removeAttr("datepicker").attr("readonly",true);
jq("#dependencia_proyecto").attr("readonly",true);
jq("#constructor").attr("disabled",true);
/*PROYECTOS*/
    	  jq("#dependencia_construccion").attr("disabled",true);
       	  jq("#dependencia_construccion option:eq(0)").attr("selected","selected");
	jq("#estatus_const_fo").change(function(){
  var valor = jq("#estatus_const_fo").val();
 
  if(valor=="FO En Construccion con Dependencias" ){
    	  jq("#dependencia_construccion").removeAttr("disabled");
   } else{
         // jq("#dependencia_construccion option:eq(0)").attr("selected","selected");
     	  jq("#dependencia_construccion").attr("disabled",true);
  }
  		
		});
	}
else{
	}
</script>
<?php
$query3 = "select planifi_requerid from construccion_fo where ref_sisa='".$_REQUEST['ref_sisa_a']."'"; //corregir esto que
//echo $query3;
$resultado3 = mysql_query($query3);
$rowKBTEL=mysql_fetch_row($resultado3);
//echo $rowKBTEL[0];
?>
<script>
if(rol=="KBTEL"){
jq("#Correo_ele").hide();
jq("#estatus_planificacion").removeAttr("disabled");
jq("#con_plan").hide();
jq("#con_plan2").hide();
jq("#planificador").attr("disabled",true);
jq("#edo_acometida").attr("disabled",true);
jq("#delegacion").attr("disabled",true);
jq("#fecha_sol_planificacion").removeAttr("datepicker").attr("readonly",true);
jq("#fecha_rec_planificacion").removeAttr("datepicker").attr("readonly",true);
jq("#fecha_sol_permisossp").removeAttr("datepicker").attr("readonly",true);
/*CONSTRUCCIÓN*/
jq("#pes").attr("readonly",true);
jq("#nco").attr("readonly",true);
jq("#anillo_rof").attr("readonly",true);
jq("#longitud_trab").attr("readonly",true);
jq("#atenuacion_trab").attr("readonly",true);
jq("#longitud_resp").attr("readonly",true);
jq("#atenuacion_resp").attr("readonly",true);
/**/
jq("#fecha_rec_permiso").removeAttr("datepicker").attr("readonly",true);
jq("#fecha_entrega_esp_fo").removeAttr("datepicker").attr("readonly",true);
jq("#fecha_adecuaciones").removeAttr("datepicker").attr("readonly",true);
/*jq("#estatus_planificacion").attr("disabled",true);*/
/*PROYECTOS*/
jq("#pep_a").attr("readonly",true);
jq("#pedido45_a").attr("readonly",true);
jq("#fo_proy_es").attr("readonly",true);
jq("#fecha_ent_ot").attr("readonly",true);
jq("#fecha_proyecto").attr("readonly",true);
jq("#fecha_ent_50").removeAttr("datepicker").attr("readonly",true);
jq("#dependencia_proyecto").attr("readonly",true);
jq("#constructor").attr("disabled",true);
jq("#estatus_const_fo").attr("disabled",true);
/*PROYECTOS*/
jq("#dependencia_construccion").attr("disabled",true);
jq("#supervisor_const").attr("disabled",true);
jq("#fecha_remate_fo").attr("readonly",true);
jq("#fecha_en_fo").removeAttr("datepicker").attr("readonly",true);
jq("#con").hide();
jq("#con2").hide();
 jq("#pes").attr("readonly",true).removeClass("validation-failed").removeClass("required");
jq("#nco").attr("readonly",true).removeClass("validation-failed").removeClass("required");
jq("#anillo_rof").attr("readonly",true).removeClass("validation-failed").removeClass("required");
jq("#longitud_trab").attr("readonly",true).removeClass("validation-failed").removeClass("required");
jq("#atenuacion_trab").attr("readonly",true).removeClass("validation-failed").removeClass("required");
jq("#longitud_resp").attr("readonly",true).removeClass("validation-failed").removeClass("required");
jq("#atenuacion_resp").attr("readonly",true).removeClass("validation-failed").removeClass("required");
jq("#estatus_const_fo").attr("disabled",true);
jq("#dependencia_construccion").attr("disabled",true);
jq("#supervisor_const").attr("disabled",true); 
jq("#fecha_remate_fo").attr("readonly",true); 
jq("#fecha_en_fo").removeAttr("datepicker").attr("readonly",true).removeAttr("datepicker_format"); 
var  queryResultado='<?=$rowKBTEL[0]?>';
//alert(queryResultado);
if(queryResultado=="No_Requerido"){
//	alert(queryRe);

jq("#estatus_planificacion").attr("disabled",true);	
		}	
	

	}
else{
	}
if(rol!="KBTEL" && rol!="CARSO"){
//	alert("HOLA COMO ESTAS USUARIO");
	
	}

</script>







</div> <!-- FIN DE DIV DE PESTAÑAS -->

<?php

include("modulo_alta_fo_prov/Dao_tipo_trayectoria_selec.php");
include("modulo_alta_fo_prov/DAO_actualiza__Cambio_Nodo_Acceso.php");	
include("modulo_alta_fo_prov/Implements_Envia_correo.php");	
//////OT SIN VALIDAR
if($_REQUEST['validacion']=='1')
{
		if ($faltan_datos=="") 
					{ 
						$error=""; 
						$sol_val_1A = "update construccion_fo set fecha_proyecto=NOW() where ref_sisa='".$_REQUEST['ref_sisa_a']."' and punta='".$_REQUEST['envia_punta']."'  "; 
						mysql_query($sol_val_1A); 
		
						echo "<script> window.open('ot_FibraOptica.php?refSisa=".$_REQUEST['ref_sisa_a']."&prioridad=".$array_a['prioridad']."&lado=".$_REQUEST['envia_punta']."&tipo_tray=".$array_a['tipo']."   '); document.solicita.alerta.value='3'; document.solicita.validacion.value=''; document.solicita.submit(); </script>"; 
					}
}

if($_REQUEST['validacion']=='2') // VALIDACION PARA LIQUIDAR
	{
		$faltan_datos="";
		if (trim($array_a['validacion_ot'])=='') 			$faltan_datos.="Debe indicar y guardar La OT \\n";
		if ($faltan_datos<>"") echo "<script>alert('$faltan_datos'); document.solicita.validacion.value='';</script>"; 
		if ($faltan_datos=="") 
			{ 
				$error=""; 
				echo "<script> document.solicita.mailcorreo.value='$mail_sucope'; document.solicita.modificacion.value='4'; document.solicita.validacion.value=''; document.solicita.submit(); </script>"; 
			}
	}

if($_REQUEST['comprobar']!='') // Comprobar PEP Y PEDIDO 45 
	{
		if ($_REQUEST['comprobar']=='PEP' )
			{
		
				// Query General
				$mysql_p = "select pppep from siatel_str_ztmps08t003_peps where pppep='".$pep_a."'  ";
				$query_p = mysql_query($mysql_p);
				$num_p = mysql_num_rows($query_p);
		
				if ($num_p>0)
				{echo "<script>alert('Numero de PEP Satisfactorio');  document.solicita.comprobar.value=''; document.solicita.submit();</script>";}
				else
				{echo "<script>alert('Numero de PEP no se encuentre registrado. Verifique informacion');  document.solicita.comprobar.value=''; document.solicita.submit();</script>";}
			}
		elseif ($_REQUEST['comprobar']=='PEDIDO45' )
			{
				// Query General
				$mysql_pd = "select pdpe45 from siatel_str_ztmps08t003_pedido where pdpe45='".$pedido45_a."'  ";
				$query_pd = mysql_query($mysql_pd);
				$num_pd = mysql_num_rows($query_pd);
		
				if ($num_pd>0)
				{echo "<script>alert('Numero de PEDIDO 45 Satisfactorio');  document.solicita.comprobar.value=''; document.solicita.submit();</script>";}
				else
				{echo "<script>alert('Numero de PEDIDO 45 no se encuentre registrado. Verifique informacion');  document.solicita.comprobar.value=''; document.solicita.submit();</script>";}
			}
		elseif ($_REQUEST['comprobar']=='PEDIDO45_TRAY' )
			{
				// Query General
				$mysql_pd = "select pdpe45 from siatel_str_ztmps08t003_pedido where pdpe45='".$$campo_tray."'  ";
				$query_pd = mysql_query($mysql_pd);
				$num_pd = mysql_num_rows($query_pd);
 
				if ($num_pd==0)
				{echo "<script> alert('Numero de PEDIDO 45 no se encuentre registrado. Verifique informacion'); document.solicita.".$campo_tray.".value=''; </script>";}
				echo "<script> document.solicita.comprobar.value='';  document.solicita.campo_tray.value='';  document.solicita.submit(); </script>";
			}
	}
	
if($_REQUEST['alerta']=='3') // Despues de Abrir OT 
	{ echo "<script>alert('OT creada Correctamente.'); document.solicita.alerta.value='';  document.solicita.submit(); </script>";} 

if($_REQUEST['alerta']=='4') // Alerta Asignacion de IPR
	{ echo "<script> var respuesta=confirm('Esta seguro que desea Asignar como IPR a: ".$ipr_resp_fo."  ?'); if(respuesta){ fechahabil();  document.solicita.modificacion.value='3'; document.solicita.alerta.value=''; document.solicita.submit();  } </script>";	} // Asignar IPR

if($_REQUEST['modificacion']=='1') // Guardar cambios Gnerales
	{

		if ($observaciones!='') {$valida_observa= ", observaciones=CONCAT('|', NOW(),', USUARIO: $sess_usr',', OBSERVACIONES: $observaciones',observaciones )";}
		
				
 $obj_trafico_tipo=busqueda_tipo_trayect::encontrar_trayectoria_ref_sisa($_REQUEST['ref_sisa_a'],$_REQUEST['envia_punta'],'');//instanciando clase estatica
//echo $obj_trafico_tipo;
		$sol_mod_1="
			update construccion_fo set
					
					tipo_req='".$tipo_req."', edo_acometida='".$edo_acometida."', 
					factibilidad='".$factibilidad."', fecha_programada='".$fecha_programada."', ipr_resp_fo='".$ipr_resp_fo."', 
					fecha_tramo_afe='".$fecha_tramo_afe."', sucope_fo='".$sucope_fo."', 
					fecha_dd='".$fecha_dd."', supervisor_fo='".$supervisor_fo."', 
					
					planificador='".$planificador."', delegacion='".$delegacion."', fecha_sol_planificacion='".$fecha_sol_planificacion."', 
					fecha_rec_planificacion='".$fecha_rec_planificacion."', fecha_sol_permisossp='".$fecha_sol_permisossp."', 
					fecha_rec_permiso='".$fecha_rec_permiso."', fecha_entrega_esp_fo='".$fecha_entrega_esp_fo."', fecha_adecuaciones='".$fecha_adecuaciones."',
					
					pep='".$pep."', fecha_elab_ot='".$fecha_elab_ot."', recibe_ot='".$recibe_ot."', fecha_ent_50='".$fecha_ent_50."', pedido45='".$pedido45."',
					dependencia_proyecto='".$dependencia_proyecto."', fo_proy_es='".$fo_proy_es."', constructor='".$constructor."',                    
					 estatus_planificacion='".$estatus_planificacion."',
					tipo='".$obj_trafico_tipo."',
						fecha_ent_ot='".$fecha_ent_ot."',
						fecha_remate_fo='".$fecha_remate_fo."', 
						fecha_proyecto='".$fecha_proyecto."',
					
					estatus_const_fo='".$estatus_const_fo."', dependencia_construccion='".$dependencia_construccion."', fecha_en_fo='".$fecha_en_fo."',
					supervisor_const='".$supervisor_const."', 
					
					prioridad='".$prioridad."', paquete_cons='".$paquete_cons."', nco='".$nco."', anillo_rof='".$anillo_rof."', longitud_trab='".$longitud_trab."', 
					longitud_resp='".$longitud_resp."', pes='".$pes."', atenuacion_resp='".$atenuacion_resp."', atenuacion_trab='".$atenuacion_trab."'
					
					".$valida_observa.",

					nota='".$nota."', observaciones_ot='".$observaciones_ot."', responsable_cliente='".$responsable_cliente."', telefono_cliente='".$telefono_cliente."'
			where ref_sisa='".$_REQUEST['ref_sisa_a']."' and punta='".$_REQUEST['envia_punta']."'
			";
		$query = mysql_query($sol_mod_1);
		
		if ($query)
		{
			if ($estatus_planificacion == "Cambio Nodo De Acceso")
			{
 $obj_class_dao=DAO_actualiza_cambio_nodo::actualizar_ref_sisa_Acceso_Nodo($_REQUEST['ref_sisa_a'],$tabla,
 $_REQUEST['envia_punta']);



   
 
/* $obj_consr=new dao_contruccion_fo_god();
 $array_class=$obj_consr->select_dinamic_query($_REQUEST['ref_sisa_a'],NULL,"construccion_fo",$valor=array(
   "valor_80"=>"2",
   "valor_81"=>"1"
));*/

$array_class=Genericos_querys_mapper::generyc_mapper_querys(
"select",$_REQUEST['ref_sisa_a'],
$_REQUEST['envia_punta'],
"construccion_fo",
 $valor=array(
         "80"=>"2",
         "81"=>"1"
),
 "array_asoc" );  	

$observacio=htmlentities(utf8_decode($array_class['observaciones_cambio']));
$mi_array_datos_mail=array(
           "ref_sisa"=>$_REQUEST['ref_sisa_a'],
		   "punta"=>$_REQUEST['envia_punta'],
		   "nodo_acceso"=>$nodo_acc,
		   "cliente_comun"=>$rowSL['cliente_comun'],
		   "domicilio"=>$domicilio,
		   "estatus_planifi"=>$estatus_planificacion,
		   "anillo_ref1"=>$nco,
		   "observacion"=>$observacio,
		   "nodo_sugerido"=>$array_class['nodo_sugerido']
		   );
/*  for($i=0;$i<9;$i++) //numero de usuarios IPR  y supervisores name="mail_$i"hp
  { 
    $email='$mail'.$i; 
    eval("\$email = \"$email\";"); 
    $mis_usuarios_array[$i] = $email; 
  } */

	$obj=new Implements_Envia_correo();
$obj->envia_correo_cambio_nodo(
Implements_Envia_correo::subjet_armado($mi_array_datos_mail),
$mi_array_datos_mail,
Implements_Envia_correo::alt_bodys($mi_array_datos_mail),		
$mis_usuarios_array);
			}
		}
		
		//echo $sol_mod_1;
		
		if ($_REQUEST['validacion']=='1a'){echo "<script>document.solicita.modificacion.value=''; document.solicita.observaciones.value=''; document.solicita.validacion.value='1'; document.solicita.submit(); </script>";}
		else 							{echo "<script>alert('Modificaciones dadas de alta correctamente'); document.solicita.modificacion.value=''; document.solicita.observaciones.value=''; document.solicita.submit(); </script>";}
	}


if($_REQUEST['modificacion']=='3') // Guardar Asignacion de IPR
	{
		correo(); // Envia correo al IPR sobre Asignacion de IPR
		$sol_mod_3A= "update construccion_fo SET supervisor_fo='$supervisor_fo', ipr_resp_fo='$ipr_resp_fo', sucope_fo='$sucope_fo', fecha_asignacion=now(), fecha_ent_ot='$fecha' where ref_sisa='".$_REQUEST['ref_sisa_a']."' and punta='".$_REQUEST['envia_punta']."'  ";
		mysql_query($sol_mod_3A);

		echo "<script>alert('Asignacion de IPR dada de Alta Correctamente'); document.solicita.mailcorreo.value=''; document.solicita.modificacion.value=''; document.solicita.submit(); </script>";
	}


if($_REQUEST['modificacion']=='4') // Guardar LIQUIDACION
	{
		//correo(); // Envia correo al SUCOPE sobre liquidacion
	
		if($_REQUEST['envia_punta']=='A') { $campos = "estatus_proyecto_fo='LIQUIDADA', fecha_atn_proyecto_fo=NOW()"; }
		elseif($_REQUEST['envia_punta']=='B') { $campos= "estatus_proyecto_fo_b='LIQUIDADA', fecha_atn_proyecto_fo_b=NOW()"; }
		
		$sol_mod_4= "update ".$rowSL['tabla']." set $campos where ref_sisa='".$_REQUEST['ref_sisa_a']."' ";
			mysql_query($sol_mod_4);
		$sol_mod_4A= "update construccion_fo set estatus_const_fo='LIQUIDADA', fecha_remate_fo=now() where ref_sisa='".$_REQUEST['ref_sisa_a']."' and punta='".$_REQUEST['envia_punta']."'  ";
			mysql_query($sol_mod_4A);

		echo "<script>alert('Liquidacion dada de alta correctamente'); document.solicita.mailcorreo.value=''; document.solicita.modificacion.value=''; document.solicita.submit(); </script>";
	}

?>

</center>
</form>


<!--- Correo ELECTRÓNICO--->
<div id="correo_electronico" align="center" >
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
<td class="Estilo4" bgcolor="#FFFFFF" align="left" bordercolor="#FFFFFFF"><?php include('modulo_alta_fo_prov/autocompletar_email.php') ?></td>
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
    <iframe id="iframe_Carga" src="modulo_alta_fo_prov/Carga_ServidorPhp.php" allowtransparency="allowtransparency" style=" width:100%; background-color:#CAE4FF;" height="110px"  scrolling="no" frameborder="0"></iframe>
</td>
</tr>
   <tr>
    <td class="Estilo4" bgcolor="#CAE4FF" align="center" bordercolor="#CAE4FF" bordercolor="#CAE4FF" >
<input id="envio_correo_mail" type="button" value="Enviar" onclick="javascript:Envio_cuerpoMail();" /><input type="button" value="Cerrar" onclick="javascript:Cerrar_Mail();"/>
</td>
        </tr>
  </table>
</div>
</div>
<script type="text/javascript">
    
      	 jq("#destinatarios").attr('checked',false);
jq("#destinatarios").click(
function(){
	if(jq("#destinatarios").is(':checked')){
	jq("#autoco").show();}
	else{
		jq("#autoco").hide();
		}
	});

jq("#correo_electronico").hide();
	jq("#mail_plani").hide();
	/*funcion para insetar estilos de acuerdo al explorador)*/

function Envio_cuerpoMail(){
<?php 
$usuarios_fijos="osanchezch@ccicsa.com.mx,savera@ccicsa.com.mx,jjgonzalezh@ccicsa.com.mx,briciocr@ccicsa.com.mx,camunoz@ccicsa.com.mx,ezarate@ccicsa.com.mx,RICARDRP@telmex.com,JOSEGA@telmex.com";
//$usuarios_fijos="osanchezch@ccicsa.com.mx,savera@ccicsa.com.mx,jjgonzalezh@ccicsa.com.mx,briciocr@ccicsa.com.mx,
//camunoz@ccicsa.com.mx,ezarate@ccicsa.com.mx,RICARDRP@telmex.com,JOSEGA@telmex.com"
?>
     
	 jq.ajax({
   	 url:'modulo_alta_fo_prov/cargarArchivos.php',
	 type:'post',
	 data: {"cliente_comun":'<?=$rowSL['cliente_comun']?>',
	         "referencia_sisa":'<?=$_REQUEST['ref_sisa_a']?>',
			 "domicilio":'<?=$rowSL['domicilio_a']?>',
	        "anillo_ref1":jq("#nco").val(),
  			"nodo_acceso":'<?php if($_REQUEST['envia_punta']=='A') echo $rowSL['central']; elseif($_REQUEST['envia_punta']=='B') echo $rowSL['central_b'];?>',
			"direccion_mails":jq("#mails").val(),
			"texto_observacion":jq("#cuerpo_correo").val(),
			"usuarios_default":'<?=$usuarios_fijos?>',
			"file_Name":jq("#iframe_Carga").contents().find('#nombre_archivoAdjunto').html()
	 },
	 beforeSend:function(){
		 jq("#envio_correo_mail").attr("disabled","disabled");	 
		 },
	success:function(respuesta){
//alert(respuesta)
  		 },
	complete:function(){
	   alert("Correo enviado");
	   jq("#correo_electronico").hide();
	jq("#mail_plani").hide();
		jq("#mails").each(function(){
		jq(this).removeClass("ui-autocomplete-input").val('').addClass("ui-autocomplete-input");
		});
		jq("#cuerpo_correo").each(function(){
		jq(this).val('');
		});	
		jq("#iframe_Carga").contents().find('#informacion_archivo').html(function(){
	  jq("informacion_archivo").remove();

	  });
		
		}	 
	 });      

  	} 		

function Cerrar_Mail(){
  var Arhivo_cerrar= jq("#iframe_Carga").contents().find('#nombre_archivoAdjunto').html();
    
					
	var cuerpo=jq("#cuerpo_correo").val();
	if(cuerpo!=""){
	  			
	var entrar = confirm("Si sale de esta pagina se perdera su mail");
	if(entrar){
        jq("#mails").each(function(){
		jq(this).removeClass("ui-autocomplete-input").val('').addClass("ui-autocomplete-input");
		});
	jq("#cuerpo_correo").each(function(){
		jq(this).val('');
		});	
			if(Arhivo_cerrar!=null){

			jq.ajax(
			{
			  url:"modulo_alta_fo_prov/borrarArchivoServer.php"	,
			  type:'post',
	        data:{"Archivo_a_borrar":Arhivo_cerrar},
			 success:function(respuesta){
				
				 }
				}
			);
			}		
		jq("#iframe_Carga").contents().find('#informacion_archivo').html(function(){
	  jq("informacion_archivo").remove();

	  });	
		
			jq("#autoco").hide();
jq("#correo_electronico").hide();
	jq("#mail_plani").hide();
		 jq("#destinatarios").attr('checked',false);
	  jq("#CALBUTTONfecha_sol_planificacion").show();
      jq("#CALBUTTONfecha_rec_planificacion").show();
	  jq("#CALBUTTONfecha_sol_permisossp").show();
	  jq("#CALBUTTONfecha_rec_permiso").show();
	  jq("#CALBUTTONfecha_entrega_esp_fo").show();
	  jq("#CALBUTTONfecha_adecuaciones").show();
	  jq("#CALBUTTONfecha_ent_50").show();
  	  jq("#CALBUTTONfecha_en_fo").show();	
	
		
		}
	else{
		self.close();
		
		}
	  		}
	else{
//			alert("cuerpo vacio");	
	jq("#mails").each(function(){
		jq(this).removeClass("ui-autocomplete-input").val('').addClass("ui-autocomplete-input");
		});
	jq("#cuerpo_correo").each(function(){
		jq(this).val('');
		});	
	if(Arhivo_cerrar!=null){
//			alert("Agur");
			jq.ajax(
			{
			  url:"modulo_alta_fo_prov/borrarArchivoServer.php"	,
			  type:'post',
	        data:{"Archivo_a_borrar":Arhivo_cerrar},
			 success:function(respuesta){
				// alert(respuesta);
				 }
				}
			);
			}
		jq("#iframe_Carga").contents().find('#informacion_archivo').html(function(){
	  jq("informacion_archivo").remove();

	  });
			jq("#autoco").hide();
jq("#correo_electronico").hide();
	jq("#mail_plani").hide();
		 jq("#destinatarios").attr('checked',false);
	  jq("#CALBUTTONfecha_sol_planificacion").show();
      jq("#CALBUTTONfecha_rec_planificacion").show();
	  jq("#CALBUTTONfecha_sol_permisossp").show();
	  jq("#CALBUTTONfecha_rec_permiso").show();
	  jq("#CALBUTTONfecha_entrega_esp_fo").show();
	  jq("#CALBUTTONfecha_adecuaciones").show();
	  jq("#CALBUTTONfecha_ent_50").show();
  	  jq("#CALBUTTONfecha_en_fo").show();	
	
	
		}
		
	} 		


		
</script>

<!--- Final Correo ELECTRÓNICO--->

</body>
<!-- Extenciones de Carga de Archivos -->
<script>

function valida_sec()  { window.close(); opener.document.location.href=opener.document.location.href; } 
</script>

<!-- ANCLA -->
<script language="javascript">
function envia(direccion)
	{
		var d=direccion;
		var d1=document.solicita.action;
		document.solicita.action=d1+"#"+d;
		document.solicita.submit();
	}
</script>

<!-- FUNCION PARA ABRIR LA VENTANA DE LA UBICACION -->
<script  language="javascript" type="text/javascript">
function popitup(url)
	{
		newwindow=window.open(url,'name','height=150,width=1100'); 
		if (window.focus) {newwindow.focus()}
		return false;
	}

function textCounter(field, countfield, maxlimit)
	{
		if (field.value.length > maxlimit) 	field.value = field.value.substring(0, maxlimit);
		else countfield.value = maxlimit - field.value.length;
	}
</script>

<!-- ENVIAR CORREO -->

<!-- INICIO PESTAÑAS -->
<script type="text/javascript">
	var onceTime=0;
	function getTab()
	{
		if(onceTime==0)
			{
				var arrLink=document.getElementsByTagName("a");	
				var idLink;

				for(a=0;a<arrLink.length;a++)
					{
						if(arrLink[a].href!='' && arrLink[a].href.match(/#(\w.+)/)!=null )
							{
								arrHref=arrLink[a].href.match(/#(\w.+)/)[1];
								if(arrHref==document.solicita.tabSpan.value) { idLink=arrLink[a].id;  break; }
							}
					}
				if(idLink!=undefined) 	domtab.showTab( document.getElementById(idLink).click());
			}
		onceTime++;
	}
</script>
<!-- FIN PESTAÑAS -->
<?php


?>
<!-- INICIO - EVITAR SUBMIT -->
<script type="text/javascript">

function detona_mail(){
	var anillo_ref1=jq("#nco").val();
    <?php $usuarios_fijos_2="osanchezch@ccicsa.com.mx,savera@ccicsa.com.mx,jjgonzalezh@ccicsa.com.mx,briciocr@ccicsa.com.mx,camunoz@ccicsa.com.mx,ezarate@ccicsa.com.mx,RICARDRP@telmex.com,JOSEGA@telmex.com";?>
   var nodo_aceeso='<?php 
   if($_REQUEST['envia_punta']=='A')
   echo $rowSL['central']; 
   elseif($_REQUEST['envia_punta']=='B') 
   echo $rowSL['central_b'];
   ?>';
Comprueba_finalizacion_envioMail('<?=$_REQUEST['ref_sisa_a']?>','<?=$_REQUEST['envia_punta']?>','<?=$rowSL[      'cliente_comun']?>','<?=$rowSL['domicilio_a']?>',anillo_ref1,nodo_aceeso,'<?=$usuarios_fijos_2?>');
	}	


	function combo_requerimiento()
		{
			//alert("HOLA ALOHA");
			var tipo_req2 = document.getElementById('tipo_req').value;
			var planificador = document.getElementById('planificador').value;
			
			if (tipo_req2=='AMPLIACION'){document.getElementById('planificador').value='NO REQUIERE';} 
		}
		
	
		
</script>
</html>>>>>>>