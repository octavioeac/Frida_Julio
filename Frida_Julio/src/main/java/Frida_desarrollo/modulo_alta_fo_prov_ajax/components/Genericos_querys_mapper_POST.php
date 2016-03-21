<?php
include("../conexion.php");
include("imports/imports_parametros _POST.php");


class Genericos_querys_mapper{
private $tabla;
private $metodo;
public function __construct(
       $table=NULL,
	   $metodo=NULL
	   ){
		$this->tabla=$table;
		$this->metodo=$metodo;
		   }
 
	
	
	public static function querys_exec($query,$type_array)
   {
	//  echo $query;
        $resultado_query= mysql_query($query);
        $result=mysql_fetch_array($resultado_query);
		//var_dump($result);
		if($result==true){
		foreach ($result as $key => $value) {
		if($type_array=="array_asoc"){
		if(is_string($key)){
			$super_array[$key]=$value;
			}
		}
		if($type_array=="row"){
		if(is_int($key)){
			$super_array[$key]=$value;
			}
		}
		}
		    return $super_array;
		}
		else{
			return false;
			}
		
		
	
        
	  
   }
   
	public static function querys_exec_no_select($query)
   {
	    
        $resultado_query= mysql_query($query);
		
	  
   }
   

   public static function select_dinamic_query($ref_sisa,$punta,$tabla,$valores,$type_array){
      $objeto_comp=new self;
	 $objeto_comp->tabla=$tabla;
	$variable_serial="Parametros_".$objeto_comp->tabla."_1";
	 // $variable_serial="Parametros_".$objeto_comp->tabla;
     $obj_tabla=new $variable_serial;
	if($valores!=NULL){
	foreach ($valores as $key => $value) {
    if(is_int($key)){
		$cadena .= $obj_tabla->arrays['columna_'.$key.''].",";	
		}
	}
		$cadena_2 = substr($cadena, 0, -1);
	}
	
	else
	{
		$cadena_2="";
		}
    
	
	$query_select="select "; 
    
	if($valores!=NULL){     
    
	$query_select.=" ".$cadena_2." "; 
	}
	else{
	$query_select.=" * ";	
		}
	
	    $query_select.="from ".$tabla." ";
	          if($ref_sisa!="null"){
         	$query_select.="where ".$obj_tabla->ref_sisa."='".$ref_sisa."'";
        	}
	    else if($punta!="null"){
       $query_select.=" and ".$obj_tabla->punta."='".$punta."'";
	    }
	  else{
      $query_select.="where ".Genericos_querys_mapper::select_dinamic_query_aux($valores,$tabla);	  
		  
		  }
//	echo $query_select;
	$array_select=Genericos_querys_mapper::querys_exec($query_select,$type_array);
    //var_dump($array_select);
	   return $array_select;
  }  
  
  
   public static function select_dinamic_query_aux($valores,$tabla){
	 $objeto_comp=new self;
	 $objeto_comp->tabla=$tabla;
	$variable_serial="Parametros_".$objeto_comp->tabla."_1";
     $obj_tabla=new $variable_serial;
      $cadena_insert_campo=" ";
	 $cadena_values="";
	
	 foreach ($valores as $key => $value) {
    if(is_int($key)){
		$cadena_insert_campo.= $obj_tabla->arrays['columna_'.$key.'']." = '".trim($value)."',";
	
		}
	}
    	$cadena_insert_campo = substr($cadena_insert_campo, 0, -1);
		return $cadena_insert_campo;	
	   
	   
	   }

  



   public function insert_dinamic_query($ref_sisa,$punta,$tabla,$valores,$type_array){
	  // echo "HOLA insert";
	 $objeto_comp=new self;
	 $objeto_comp->tabla=$tabla;
	$variable_serial="Parametros_".$objeto_comp->tabla."_1";
	  //$variable_serial="Parametros_".$objeto_comp->tabla;
     $obj_tabla=new $variable_serial;
      $cadena_insert_campo=" ";
	 $cadena_values="";
  foreach ($valores as $key => $value) {
    if(is_int($key)){
		$cadena_insert_campo.= $obj_tabla->arrays['columna_'.$key.''].",";
		$cadena_insert_value.="'".trim($value)."',";	
		}
	}
    	$cadena_insert_campo = substr($cadena_insert_campo, 0, -1);
		$cadena_insert_value= substr($cadena_insert_value, 0, -1);
		
        if($punta==""){
		$query_udpate="insert into ".$tabla." (".$obj_tabla->ref_sisa.",".$cadena_insert_campo.") 
		values('".$ref_sisa."',".$cadena_insert_value.")" ;
		}
		else{
		$query_udpate="insert into ".$tabla." (".$obj_tabla->ref_sisa.",".$obj_tabla->punta.",".$cadena_insert_campo.") values('".$ref_sisa."','".$punta."',".$cadena_insert_value.")" ;
			
			}
	  
	  // echo $query_udpate;
	    $array_select=Genericos_querys_mapper::querys_exec_no_select($query_udpate);
	   return $array_select;
	      
	   
	   }




   public  function update_dinamic_query($ref_sisa,$punta,$tabla,$valores,$type_array){
		
	$cadena = "";   
         
	 $objeto_comp=new self;
	 $objeto_comp->tabla=$tabla;
	 $variable_serial="Parametros_".$objeto_comp->tabla."_1";
	// $variable_serial="Parametros_".$objeto_comp->tabla;
     $obj_tabla=new $variable_serial;
	foreach ($valores as $key => $value) {
    if(is_int($key)){
		$cadena .= $obj_tabla->arrays['columna_'.$key.'']."='".trim($value)."',";	
		}
	}

	$cadena_2 = substr($cadena, 0, -1);
 	$query_udpate="update ".$tabla." set ".utf8_decode($cadena_2)." where ".$obj_tabla->ref_sisa."='".$ref_sisa."'";
	if($punta!=""){
    $query_udpate.=" and ".$obj_tabla->punta."='".$punta."'";
	}
   
   //echo $query_udpate;
 $resul= Genericos_querys_mapper::querys_exec_no_select($query_udpate);
   
	
  
   }  
   
public static function generyc_mapper_querys($metodo,$ref_sisa,$punta,$tabla,$valores,$type_array){
	$obj_metod= new self;
	$obj_metod->metodo=$metodo;
	
	$obj_metod->tabla=$tabla;
	try{
	
	 $cadena_funcion=$obj_metod->metodo."_dinamic_query";
	// echo $cadena_funcion;

	
	if($obj_metod->metodo=="select"){
	$valor_return=$obj_metod->$cadena_funcion($ref_sisa,$punta,$obj_metod->tabla,$valores,$type_array);
	return $valor_return;
    	}else{
	$obj_metod->$cadena_funcion($ref_sisa,$punta,$obj_metod->tabla,$valores,$type_array);			
			}
	}
	
	
	catch(Exception $e){
		 echo $e;
		}
	
	}
 


}



$array_jso=Genericos_querys_mapper::generyc_mapper_querys(
$_POST['funcion_name'],
$_POST['ref_sisa'],
$_POST['punta'],
$_POST['tabla'],
$_POST,
$_POST['tipo_array']);

if($_POST['funcion_name']=="select"){
//header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT');
//header('Cache-Control: no-store, no-cache, must-revalidate');
//header('Cache-Control: no-store, no-cache');
//header('Cache-Control: post-check=0, pre-check=0', false);
//header('Pragma: no-cache');
//header('Content-type: application/json');

	$json_array=json_encode($array_jso);
echo strip_tags($json_array);
	}




?>
