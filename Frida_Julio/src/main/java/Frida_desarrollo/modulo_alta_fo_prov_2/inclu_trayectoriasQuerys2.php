<?php
include("../conexion.php");
$array_trabajo = array(
    "tipo_trabajo_1" => 'CLIENTE (TRABAJO)',
   "tipo_trabajo_2" => 'CENTRAL (TRABAJO)',
);
$array_respaldo = array(
    "tipo_respaldo_1" => 'CLIENTE (RESPALDO)',
    "tipo_respaldo_2" => 'CENTRAL (RESPALDO)',
);
//var_dump($array_trabajo);

function busca_ref(){
$query_busqueda="select * from fibra_optica_ladenlaces  where ref_sisa='".$_POST['ref_sisa_a']."' and punta='".$_POST['envia_punta']."'";
$resultado=mysql_query($query_busqueda);
if(mysql_num_rows($resultado)>=2){
	return true;
	}
else{
	return false;
	}
}


function inserta_referencias_cliente($tipo_trayec_cliente,$cable,$punta,$cliente_ubica,$tipo,$fo_cli_cap,$fo_clit_long,$tipo_jumper,$pedido45,$fo_cli_f,$refe_sisa,$indez,$cliente ){
$fo_cli_f_par=explode(" , ",$fo_cli_f );
$fo_cli_fa=$fo_cli_f_par[0];
$fo_cli_fb=$fo_cli_f_par[1];
$query_inserta ="insert into fibra_optica_ladenlaces ( tipo_trayec,cable,punta,ubicaciona,tipo_sel,cap_cable,longitud,tipo_jumper ,pedido45,fibra_a,fibra_b,ref_sisa,indez,cliente) values(";
if($tipo_trayec_cliente==""){$query_inserta .="null,"; }
else{$query_inserta .="'".$tipo_trayec_cliente."',";	}	
if($cable==""){$query_inserta .="null,";}
else{$query_inserta .="'".$cable."',";}		
if($punta==""){$query_inserta .="null,";}
else{$query_inserta .="'".$punta."',";}		
if($cliente_ubica==""){$query_inserta .="null,";}
else{$query_inserta .="'".$cliente_ubica."',";}	
if($tipo==""){$query_inserta .="null,";}
else{$query_inserta .="'".$tipo."',";}	
if($fo_cli_cap==""){$query_inserta .="null,";}
else{$query_inserta .="'".$fo_cli_cap."',";}
if($fo_clit_long==""){$query_inserta .="null,";}
else{$query_inserta .="'".$fo_clit_long."',";}
if($tipo_jumper==""){$query_inserta .="null,";}
else{$query_inserta .="'".$tipo_jumper."',";}
if($pedido45==""){$query_inserta .="null,";}
else{$query_inserta .="'".$pedido45."',";}
if($fo_cli_f==""){
	$query_inserta .="null,null,";
}
else{
$fo_cli_f_par=explode(" , ",$fo_cli_f );
$fo_cli_fa=$fo_cli_f_par[0];
$fo_cli_fb=$fo_cli_f_par[1];
	$query_inserta .="'".$fo_cli_fa."','".$fo_cli_fb."',";
	}
$query_inserta .="'".$refe_sisa."','".$indez."','".$cliente."')";

$resultado=mysql_query($query_inserta) or die(mysql_error());
//echo $resultado;


}


function inserta_referencias_central($tipo_trayec_central,$cable,$punta,$central_ubica,$tipo,$pedido45,$fo_cen_f,$refe_sisa,$indes,$cliente ){
$query_inserta="insert into fibra_optica_ladenlaces ( tipo_trayec,cable,punta,ubicaciona,tipo_sel,pedido45,fibra_a,fibra_b,ref_sisa,indez,cliente) values(";
if($tipo_trayec_central==""){
	$query_inserta .="null,";
 }
else{
	$query_inserta .="'".$tipo_trayec_central."',";	
	}	
if($cable==""){$query_inserta .="null,";}
else{$query_inserta .="'".$cable."',";}		
if($punta==""){$query_inserta .="null,";}
else{$query_inserta .="'".$punta."',";}		
if($central_ubica==""){$query_inserta .="null,";}
else{$query_inserta .="'".$central_ubica."',";}	
if($tipo==""){$query_inserta .="null,";}
else{$query_inserta .="'".$tipo."',";}	
if($pedido45==""){$query_inserta .="null,";}
else{$query_inserta .="'".$pedido45."',";}
if($fo_cen_f==""){
	$query_inserta .="null,null,";
}
else{
$fo_cen_f_par=explode(" , ",$fo_cen_f );
$fo_cent_fa=$fo_cen_f_par[0];
$fo_cent_fb=$fo_cen_f_par[1];
	$query_inserta .="'".$fo_cent_fa."','".$fo_cent_fb."',";
	}
$query_inserta .="'".$refe_sisa."','".$indes."','".$cliente."')";

$resultado=mysql_query($query_inserta) or die(mysql_error());
//echo $resultado;

}

function borra_registro($ref_sisa,$punta,$indetificador){
$query_borrar="delete from fibra_optica_ladenlaces where ref_sisa='".$ref_sisa."'and punta='".$punta."' and indez='".$indetificador."'"; 	
$resultado=mysql_query($query_borrar) or die(mysql_error());
//echo $resultado;
//echo $query_borrar;
	}

function busca_registro($ref_sisa,$punta,$indetificador){
$query_buscar="select * from  fibra_optica_ladenlaces where ref_sisa='".$ref_sisa."' and punta='".$punta."' and indez='".$indetificador."'"; 	
$resultado_busqueda=mysql_query($query_buscar)or die(mysql_error());
//echo $query_buscar;
$Row = mysql_fetch_assoc($resultado_busqueda);
//var_dump($Row);
if($Row==true){
//echo "encontre resultado";
return true;
}
if($Row==false){	
//echo "No encontre nada";
return false;
	}
}


function actualiza_referencias_central($tipo_trayec_central,$cable,$punta,$central_ubica,$tipo,$pedido45,$fo_cen_f,$refe_sisa,$index,$cliente ){
$query_inserta="update fibra_optica_ladenlaces SET ";
if($cable==""){$query_inserta .="cable=null,";}
else{$query_inserta .="cable='".$cable."',";}		
if($central_ubica==""){$query_inserta .="ubicaciona=null,";}
else{$query_inserta .="ubicaciona='".$central_ubica."',";}	
if($tipo==""){$query_inserta .="tipo_sel=null,";}
else{$query_inserta .="tipo_sel='".$tipo."',";}	
if($pedido45==""){$query_inserta .="pedido45=null,";}
else{$query_inserta .="pedido45='".$pedido45."',";}

if($cliente==""){$query_inserta .="cliente=null,";}
else{$query_inserta .="cliente='".$cliente."',";}

if($fo_cen_f==""){
	$query_inserta .="fibra_a=null,fibra_b=null";
}
else{
$fo_cen_f_par=explode(" , ",$fo_cen_f );
$fo_cent_fa=$fo_cen_f_par[0];
$fo_cent_fb=$fo_cen_f_par[1];
	$query_inserta .="fibra_a='".$fo_cent_fa."',fibra_b='".$fo_cent_fb."'";
	}
$query_inserta .=" where ref_sisa='".$refe_sisa."' and punta='".$punta."' and tipo_trayec='".$tipo_trayec_central."'";
$resultado=mysql_query($query_inserta) or die(mysql_error());


//echo $resultado;

}






function actualiza_referencias_cliente(&$tipo_trayec_cliente,$cable,$punta,$cliente_ubica,$tipo,$fo_cli_cap,$fo_clit_long,$tipo_jumper,$pedido45,$fo_cli_f,$refe_sisa,$index,$cliente ){
$fo_cli_f_par=explode(" , ",$fo_cli_f );
$fo_cli_fa=$fo_cli_f_par[0];
$fo_cli_fb=$fo_cli_f_par[1];
$query_inserta="update fibra_optica_ladenlaces SET ";
         if($cable==""){$query_inserta .="cable=null,";}
else{$query_inserta .="cable='".$cable."',";}		
     if($cliente_ubica==""){$query_inserta .="ubicaciona=null,";}
else{$query_inserta .="ubicaciona='".$cliente_ubica."',";}	

     if($tipo==""){$query_inserta .="tipo_sel=null,";}
else{$query_inserta .="tipo_sel='".$tipo."',";}	

     if($fo_cli_cap==""){$query_inserta .="cap_cable=null,";}
else{$query_inserta .="cap_cable='".$fo_cli_cap."',";}

     if($fo_clit_long==""){$query_inserta .="longitud=null,";}
else{$query_inserta .="longitud='".$fo_clit_long."',";}


     if($tipo_jumper==""){$query_inserta .="tipo_jumper=null,";}
else{$query_inserta .="tipo_jumper='".$tipo_jumper."',";}

     if($pedido45==""){$query_inserta .="pedido45=null,";}
else{$query_inserta .="pedido45='".$pedido45."',";}

     if($cliente==""){$query_inserta .="cliente=null,";}
else{$query_inserta .="cliente='".$cliente."',";}

if($fo_cli_f==""){
	$query_inserta .="fibra_a=null,fibra_b=null" ;
}
else{
$fo_cli_f_par=explode(" , ",$fo_cli_f );
$fo_cli_fa=$fo_cli_f_par[0];
$fo_cli_fb=$fo_cli_f_par[1];
	$query_inserta .="fibra_a='".$fo_cli_fa."',fibra_b='".$fo_cli_fb."'";
	}
$query_inserta .=" where ref_sisa='".$refe_sisa."' and punta='".$punta."' and tipo_trayec='".$tipo_trayec_cliente."'";
$resultado=mysql_query($query_inserta) or die(mysql_error());
//echo $resultado;
}
$busca_registros=busca_ref($_POST);


function actualiza_fo_prov($refe_si,$punt,$tip){
$quer_actualizar="update construccion_fo set tipo='".$tip."' where ref_sisa='".$refe_si."' and punta='".$punt."'";	
$resultado_actalizar_fo=mysql_query($quer_actualizar) or die(mysql_error());
//echo $resultado_actalizar_fo;
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////
      
            if($busca_registros!=1){

if($_POST['tipo']=='1+0 TRABAJO'){
$inicio=1;
$final=1;
$tipo_1="1+0 TRABAJO";
$actualiza_fo_prov=actualiza_fo_prov($_POST['ref_sisa_a'],$_POST['envia_punta'],$tipo_1);	
echo "ALTA DE REF_SISA: ".$_POST['ref_sisa_a']." CON TIPO 1+0 TRABAJO"; 
	}

if($_POST['tipo']=='1+0 RESPALDO'){
$inicio=2;
$final=2;
$tipo_1="1+0 RESPALDO";
$actualiza_fo_prov=actualiza_fo_prov($_POST['ref_sisa_a'],$_POST['envia_punta'],$tipo_1);	
echo "ALTA DE REF_SISA:".$_POST['ref_sisa_a']." CON TIPO 1+0 RESPALDO"; 
  	}

if($_POST['tipo']=='1+1'){
$inicio=1;
$final=2;	
$tipo_1="1+1";
$actualiza_fo_prov=actualiza_fo_prov($_POST['ref_sisa_a'],$_POST['envia_punta'],$tipo_1);	
echo "ALTA DE REF_SISA:".$_POST['ref_sisa_a']." CON TIPO: 1+1"; 
	
	}
for($j=$inicio; $j<= $final;$j++){
$metodo_inserta_cliente=inserta_referencias_cliente($_POST['tipo_trayec_cliente_'.$j.''],$_POST['fo_cli_cable_'.$j.''],$_POST['envia_punta'],$_POST['fo_cli_ubi_'.$j.''],$_POST['tipo'],$_POST['fo_cli_cap_'.$j.''],$_POST['fo_clit_long_'.$j.'']
,$_POST['fo_cli_jump_'.$j.''],$_POST['fo_cli_ped_'.$j.''],$_POST['fo_cli_f_'.$j.''],$_POST['ref_sisa_a'],$_POST['fo_cons_'.$j.''],$_POST['fo_cli_cliente_'.$j.'']);

$metodo_inserta_central=inserta_referencias_central($_POST['tipo_trayec_central_'.$j.''],$_POST['fo_cen_cable_'.$j.''],$_POST['envia_punta'],$_POST['fo_cen_ubi_'.$j.''],$_POST['tipo'],$_POST['fo_cen_ped_'.$j.''],$_POST['fo_cen_f_'.$j.''],$_POST['ref_sisa_a'],$_POST['fo_cons_'.$j.''],$_POST['fo_cen_central_'.$j.'']);


}

             }
		
if($busca_registros==1){	
		
	 if($_POST['tipo']=='1+0 TRABAJO'){
$metodo_busqueda_trabajo=busca_registro($_POST['ref_sisa_a'],$_POST['envia_punta'],$_POST['fo_cons_1']);
//var_dump($metodo_busqueda_trabajo);
				if($metodo_busqueda_trabajo==true){
				//echo "Si hay trabajo";	
				$j=1;
				$metodo_actualiza_cliente=actualiza_referencias_cliente($_POST['tipo_trayec_cliente_'.$j.''],$_POST['fo_cli_cable_'.$j.''],$_POST['envia_punta'],$_POST['fo_cli_ubi_'.$j.''],$_POST['tipo'],$_POST['fo_cli_cap_'.$j.''],$_POST['fo_clit_long_'.$j.'']
				,$_POST['fo_cli_jump_'.$j.''],$_POST['fo_cli_ped_'.$j.''],$_POST['fo_cli_f_'.$j.''],$_POST['ref_sisa_a'],$_POST['fo_cons_'.$j.''],$_POST['fo_cli_cliente_'.$j.'']);
				$metodo_actualiza_central=actualiza_referencias_central($_POST['tipo_trayec_central_'.$j.''],$_POST['fo_cen_cable_'.$j.''],$_POST['envia_punta'],$_POST['fo_cen_ubi_'.$j.''],$_POST['tipo'],$_POST['fo_cen_ped_'.$j.''],$_POST['fo_cen_f_'.$j.''],$_POST['ref_sisa_a'],$_POST['fo_cons_'.$j.''],$_POST['fo_cen_central_'.$j.'']);
				$h=2;
				$metodo_borra_respaldo=borra_registro($_POST['ref_sisa_a'],$_POST['envia_punta'],$_POST['fo_cons_'.$h.'']);		  
				}
       if($metodo_busqueda_trabajo==false){
		 //echo "NO hay TRABAJO" ; 
       $h=2;
       $metodo_borra_respaldo=borra_registro($_POST['ref_sisa_a'],$_POST['envia_punta'],$_POST['fo_cons_'.$h.'']);		  
       $j=1;	   
       $metodo_inserta_cliente=inserta_referencias_cliente($_POST['tipo_trayec_cliente_'.$j.''],$_POST['fo_cli_cable_'.$j.''],$_POST['envia_punta'],$_POST['fo_cli_ubi_'.$j.''],$_POST['tipo'],$_POST['fo_cli_cap_'.$j.''],$_POST['fo_clit_long_'.$j.'']
       ,$_POST['fo_cli_jump_'.$j.''],$_POST['fo_cli_ped_'.$j.''],$_POST['fo_cli_f_'.$j.''],$_POST['ref_sisa_a'],$_POST['fo_cons_'.$j.''],$_POST['fo_cli_cliente_'.$j.'']);
       $metodo_inserta_central=inserta_referencias_central($_POST['tipo_trayec_central_'.$j.''],$_POST['fo_cen_cable_'.$j.''],$_POST['envia_punta'],$_POST['fo_cen_ubi_'.$j.''],$_POST['tipo'],$_POST['fo_cen_ped_'.$j.''],$_POST['fo_cen_f_'.$j.''],$_POST['ref_sisa_a'],$_POST['fo_cons_'.$j.''],$_POST['fo_cen_central_'.$j.'']);
	   }
echo "ACTUALIZACION DE REF_SISA:".$_POST['ref_sisa_a']." CON TIPO 1+0 TRABAJO"; 
$tipo_1="1+0 TRABAJO";     
$actualiza_fo_prov=actualiza_fo_prov($_POST['ref_sisa_a'],$_POST['envia_punta'],$tipo_1);	
	 }  

	  
	  if($_POST['tipo']=='1+0 RESPALDO'){
$metodo_busqueda_respaldo=busca_registro($_POST['ref_sisa_a'],$_POST['envia_punta'],$_POST['fo_cons_2']);
//var_dump($metodo_busqueda_respaldo);
               if($metodo_busqueda_respaldo==true){
				//echo "SI hay RESPALDO";   
				$j=2;
				$metodo_actualiza_cliente=actualiza_referencias_cliente($_POST['tipo_trayec_cliente_'.$j.''],$_POST['fo_cli_cable_'.$j.''],$_POST['envia_punta'],$_POST['fo_cli_ubi_'.$j.''],$_POST['tipo'],$_POST['fo_cli_cap_'.$j.''],$_POST['fo_clit_long_'.$j.'']
				,$_POST['fo_cli_jump_'.$j.''],$_POST['fo_cli_ped_'.$j.''],$_POST['fo_cli_f_'.$j.''],$_POST['ref_sisa_a'],$_POST['fo_cons_'.$j.''],$_POST['fo_cli_cliente_'.$j.'']);
				$metodo_actualiza_central=actualiza_referencias_central($_POST['tipo_trayec_central_'.$j.''],$_POST['fo_cen_cable_'.$j.''],$_POST['envia_punta'],$_POST['fo_cen_ubi_'.$j.''],$_POST['tipo'],$_POST['fo_cen_ped_'.$j.''],$_POST['fo_cen_f_'.$j.''],$_POST['ref_sisa_a'],$_POST['fo_cons_'.$j.''],$_POST['fo_cen_central_'.$j.'']);
				$h=1;
				$metodo_borra_respaldo=borra_registro($_POST['ref_sisa_a'],$_POST['envia_punta'],$_POST['fo_cons_'.$h.'']);		  
			   }
	           if($metodo_busqueda_respaldo==false){
				$h=1;
       $metodo_borra_respaldo=borra_registro($_POST['ref_sisa_a'],$_POST['envia_punta'],$_POST['fo_cons_'.$h.'']);		  
       $j=2;	   
       $metodo_inserta_cliente=inserta_referencias_cliente($_POST['tipo_trayec_cliente_'.$j.''],$_POST['fo_cli_cable_'.$j.''],$_POST['envia_punta'],$_POST['fo_cli_ubi_'.$j.''],$_POST['tipo'],$_POST['fo_cli_cap_'.$j.''],$_POST['fo_clit_long_'.$j.'']
       ,$_POST['fo_cli_jump_'.$j.''],$_POST['fo_cli_ped_'.$j.''],$_POST['fo_cli_f_'.$j.''],$_POST['ref_sisa_a'],$_POST['fo_cons_'.$j.''],$_POST['fo_cli_cliente_'.$j.'']);
       $metodo_inserta_central=inserta_referencias_central($_POST['tipo_trayec_central_'.$j.''],$_POST['fo_cen_cable_'.$j.''],$_POST['envia_punta'],$_POST['fo_cen_ubi_'.$j.''],$_POST['tipo'],$_POST['fo_cen_ped_'.$j.''],$_POST['fo_cen_f_'.$j.''],$_POST['ref_sisa_a'],$_POST['fo_cons_'.$j.''],$_POST['fo_cen_central_'.$j.'']);
				}
$tipo_1="1+0 RESPALDO";
$actualiza_fo_prov=actualiza_fo_prov($_POST['ref_sisa_a'],$_POST['envia_punta'],$tipo_1);	
echo "ACTUALIZACION DE REF_SISA:".$_POST['ref_sisa_a']." CON TIPO 1+0 RESPALDO";      	  
	  }
	 
	  if($_POST['tipo']=='1+1'){
$query_busqueda_par="select * from fibra_optica_ladenlaces where ref_sisa='".$_POST['ref_sisa_a']."' and punta='".$_POST['envia_punta']."' and tipo_sel='".$_POST['tipo']."'";
$resultado_busqueda_par=mysql_query($query_busqueda_par)or die(mysql_error());
$Rows = mysql_fetch_assoc($resultado_busqueda_par);
 			 if($Rows==true){
          for($j=1; $j<= 2;$j++){  
		 $metodo_actualiza_cliente=actualiza_referencias_cliente($_POST['tipo_trayec_cliente_'.$j.''],$_POST['fo_cli_cable_'.$j.''],$_POST['envia_punta'],$_POST['fo_cli_ubi_'.$j.''],$_POST['tipo'],$_POST['fo_cli_cap_'.$j.''],$_POST['fo_clit_long_'.$j.'']
				,$_POST['fo_cli_jump_'.$j.''],$_POST['fo_cli_ped_'.$j.''],$_POST['fo_cli_f_'.$j.''],$_POST['ref_sisa_a'],$_POST['fo_cons_'.$j.''],$_POST['fo_cli_cliente_'.$j.'']);
		 $metodo_actualiza_central=actualiza_referencias_central($_POST['tipo_trayec_central_'.$j.''],$_POST['fo_cen_cable_'.$j.''],$_POST['envia_punta'],$_POST['fo_cen_ubi_'.$j.''],$_POST['tipo'],$_POST['fo_cen_ped_'.$j.''],$_POST['fo_cen_f_'.$j.''],$_POST['ref_sisa_a'],$_POST['fo_cons_'.$j.''],$_POST['fo_cen_central_'.$j.'']);
		 }
			 		 
			  }
             if($Rows==false){
$query_busqueda_respaldo="select * from fibra_optica_ladenlaces where ref_sisa='".$_POST['ref_sisa_a']."' and punta='".$_POST['envia_punta']."' and tipo_sel='1+0 RESPALDO'";
$resultado_busqueda_respaldo=mysql_query($query_busqueda_respaldo)or die(mysql_error());
$Rows_respaldo = mysql_fetch_assoc($resultado_busqueda_respaldo);
            if($Rows_respaldo==true){
			$tipo="1+1";
			$j=2; 
			 $metodo_actualiza_cliente=actualiza_referencias_cliente($_POST['tipo_trayec_cliente_'.$j.''],$_POST['fo_cli_cable_'.$j.''],$_POST['envia_punta'],$_POST['fo_cli_ubi_'.$j.''],$tipo,$_POST['fo_cli_cap_'.$j.''],$_POST['fo_clit_long_'.$j.'']
				,$_POST['fo_cli_jump_'.$j.''],$_POST['fo_cli_ped_'.$j.''],$_POST['fo_cli_f_'.$j.''],$_POST['ref_sisa_a'],$_POST['fo_cons_'.$j.''],$_POST['fo_cli_cliente_'.$j.'']);
		 $metodo_actualiza_central=actualiza_referencias_central($_POST['tipo_trayec_central_'.$j.''],$_POST['fo_cen_cable_'.$j.''],$_POST['envia_punta'],$_POST['fo_cen_ubi_'.$j.''],$tipo,$_POST['fo_cen_ped_'.$j.''],$_POST['fo_cen_f_'.$j.''],$_POST['ref_sisa_a'],$_POST['fo_cons_'.$j.''],$_POST['fo_cen_central_'.$j.'']);
		 	}
            if($Rows_respaldo==false){
			$tipo="1+1";
			$j=2; 
	   $metodo_inserta_cliente=inserta_referencias_cliente($_POST['tipo_trayec_cliente_'.$j.''],$_POST['fo_cli_cable_'.$j.''],$_POST['envia_punta'],$_POST['fo_cli_ubi_'.$j.''],$_POST['tipo'],$_POST['fo_cli_cap_'.$j.''],$_POST['fo_clit_long_'.$j.'']
       ,$_POST['fo_cli_jump_'.$j.''],$_POST['fo_cli_ped_'.$j.''],$_POST['fo_cli_f_'.$j.''],$_POST['ref_sisa_a'],$_POST['fo_cons_'.$j.''],$_POST['fo_cli_cliente_'.$j.'']);
       $metodo_inserta_central=inserta_referencias_central($_POST['tipo_trayec_central_'.$j.''],$_POST['fo_cen_cable_'.$j.''],$_POST['envia_punta'],$_POST['fo_cen_ubi_'.$j.''],$_POST['tipo'],$_POST['fo_cen_ped_'.$j.''],$_POST['fo_cen_f_'.$j.''],$_POST['ref_sisa_a'],$_POST['fo_cons_'.$j.''],$_POST['fo_cen_central_'.$j.'']);
			}


$query_busqueda_trabajo="select * from fibra_optica_ladenlaces where ref_sisa='".$_POST['ref_sisa_a']."' and punta='".$_POST['envia_punta']."' and tipo_sel='1+0 TRABAJO'";
$resultado_busqueda_trabajo=mysql_query($query_busqueda_trabajo)or die(mysql_error());
$Rows_trabajo = mysql_fetch_assoc($resultado_busqueda_trabajo);		  
if($Rows_trabajo==true){
			$tipo="1+1";
			$j=1; 
			 $metodo_actualiza_cliente=actualiza_referencias_cliente($_POST['tipo_trayec_cliente_'.$j.''],$_POST['fo_cli_cable_'.$j.''],$_POST['envia_punta'],$_POST['fo_cli_ubi_'.$j.''],$tipo,$_POST['fo_cli_cap_'.$j.''],$_POST['fo_clit_long_'.$j.'']
				,$_POST['fo_cli_jump_'.$j.''],$_POST['fo_cli_ped_'.$j.''],$_POST['fo_cli_f_'.$j.''],$_POST['ref_sisa_a'],$_POST['fo_cons_'.$j.''],$_POST['fo_cli_cliente_'.$j.'']);
		 $metodo_actualiza_central=actualiza_referencias_central($_POST['tipo_trayec_central_'.$j.''],$_POST['fo_cen_cable_'.$j.''],$_POST['envia_punta'],$_POST['fo_cen_ubi_'.$j.''],$tipo,$_POST['fo_cen_ped_'.$j.''],$_POST['fo_cen_f_'.$j.''],$_POST['ref_sisa_a'],$_POST['fo_cons_'.$j.''],$_POST['fo_cen_central_'.$j.'']);
		 	}
            if($Rows_trabajo==false){
			$tipo="1+1";
			$j=1; 
	   $metodo_inserta_cliente=inserta_referencias_cliente($_POST['tipo_trayec_cliente_'.$j.''],$_POST['fo_cli_cable_'.$j.''],$_POST['envia_punta'],$_POST['fo_cli_ubi_'.$j.''],$_POST['tipo'],$_POST['fo_cli_cap_'.$j.''],$_POST['fo_clit_long_'.$j.'']
       ,$_POST['fo_cli_jump_'.$j.''],$_POST['fo_cli_ped_'.$j.''],$_POST['fo_cli_f_'.$j.''],$_POST['ref_sisa_a'],$_POST['fo_cons_'.$j.''],$_POST['fo_cli_cliente_'.$j.'']);
       $metodo_inserta_central=inserta_referencias_central($_POST['tipo_trayec_central_'.$j.''],$_POST['fo_cen_cable_'.$j.''],$_POST['envia_punta'],$_POST['fo_cen_ubi_'.$j.''],$_POST['tipo'],$_POST['fo_cen_ped_'.$j.''],$_POST['fo_cen_f_'.$j.''],$_POST['ref_sisa_a'],$_POST['fo_cons_'.$j.''],$_POST['fo_cen_central_'.$j.'']);
			}
	 
			  }




echo "ACTUALIZACION DE REF_SISA:".$_POST['ref_sisa_a']." CON TIPO 1+1";      
$tipo_1="1+1";
$actualiza_fo_prov=actualiza_fo_prov($_POST['ref_sisa_a'],$_POST['envia_punta'],$tipo_1);		  
		  } 
	  
	  
}
		
?>