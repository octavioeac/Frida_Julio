<?php
//include("../conexion.php");
//include("imports/imports_parametros.php");


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
	    //echo $query;
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
		
		
		//var_dump($super_array);
        
	  
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
	
	$query_select.="from ".$tabla." where ".$obj_tabla->ref_sisa."='".$ref_sisa."'";
	if($punta!=""){
    $query_select.=" and ".$obj_tabla->punta."='".$punta."'";
	}
	
	//echo $query_select;
	$array_select=Genericos_querys_mapper::querys_exec($query_select,$type_array);

	   return $array_select;
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
   
   echo $query_udpate;
 $resul= Genericos_querys_mapper::querys_exec_no_select($query_udpate);
   
	
  
   }  
   
public static function generyc_mapper_querys($metodo,$ref_sisa,$punta,$tabla,$valores,$type_array){
	$obj_metod= new self;
	$obj_metod->metodo=$metodo;
	
	$obj_metod->tabla=$tabla;
	try{
	
	 $cadena_funcion=$obj_metod->metodo."_dinamic_query";
	// echo $cadena_funcion;
	$obj_metod->$cadena_funcion($ref_sisa,$punta,$obj_metod->tabla,$valores,$type_array);
	
	if($obj_metod->metodo=="select"){
	$valor_return=$obj_metod->$cadena_funcion($ref_sisa,$punta,$obj_metod->tabla,$valores,$type_array);
	return $valor_return;
    	}
	}
	
	
	catch(Exception $e){
		 echo $e;
		}
	
	}
 


}


/*Genericos_querys_mapper::generyc_mapper_querys(
"select",
"C03-1401PRUEBA_10",
"A",
"construccion_fo",
$valores=array(
         "80"=>"4",
         "81"=>"1")
	                                           );
*/





?>
