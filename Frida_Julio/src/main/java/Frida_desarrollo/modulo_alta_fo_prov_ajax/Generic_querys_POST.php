<?php
include("conexion.php");
include ("clases/Parametros_construccion_fo.php");
include ("clases/Parametros_tablas.php");
class dao_contruccion_fo{
	
	public static function querys_exec($query)
   {
	    echo $query;
        $resultado_query= mysql_query($query);

        $result=mysql_fetch_array($resultado_query);
            return $result;
	  
   }
   
	public static function querys_exec_no_select($query)
   {
	    
        $resultado_query= mysql_query($query);
		
	  
   }
   

   public static function select_dinamic_query($ref_sisa,$punta,$tabla,$valores){
  
    $obj_tabla=new Parametros_construccion_fo();
	$numero=count($obj_tabla->arrays); 
     echo "<br>";
    $hola= array();

    for($i=1;$i<=$numero;$i++)
	{
			 if($valores['valor_'.$i.'']!="")
				{	 
               $hola[$i]="".$obj_tabla->arrays['columna_'.$i.'']."";
			   }
		
             if($valores['valor_'.$i.'']=="")
				{	 
                $hola[$i]=NULL;
				}		
		
	}
   $array_limpio=array_filter($hola);
   $cadena=implode(",",$array_limpio);
   
    $query_select="select ".$cadena." from ".$tabla." where ".$obj_tabla->ref_sisa."='".$ref_sisa."'";
	echo $query_select;
	$array_select=dao_contruccion_fo::querys_exec($query_select);
	
	   return $array_select;
  }  
  
  
  

  



   public function insert_dinamic_query($ref_sisa,$punta,$tabla,$valores){
    $obj_valor=new Parametros_tablas;
	$obj_valor->ref_sisa_1=$ref_sisa;
	$obj_valor->punta_1=$punta;
    $obj_tabla=new Parametros_construccion_fo();
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
        $query_udpate="insert into ".$tabla." (".$cadena_insert_campo.") values(".$cadena_insert_value.")" ;
        $array_select=dao_contruccion_fo::querys_exec_no_select($query_udpate);
	   return $array_select;
	      
	   
	   }




   public  function update_dinamic_query($ref_sisa,$punta,$tabla,$valores){
 
	$cadena = "";   
       $obj_tabla=new Parametros_construccion_fo();
	foreach ($valores as $key => $value) {
    if(is_int($key)){
		$cadena .= $obj_tabla->arrays['columna_'.$key.'']."='".trim($value)."',";	
		}
	}

	$cadena_2 = substr($cadena, 0, -1);
 	$query_udpate="update ".$tabla." set ".utf8_decode($cadena_2)." where ".$obj_tabla->ref_sisa."='".$ref_sisa."'";
   echo $query_udpate;
    $resul= dao_contruccion_fo::querys_exec_no_select($query_udpate);
   
	
  
   }  
   
 


}


$cadena_funcion=$_POST['funcion_name']."_dinamic_query";
$obj_gener=new dao_contruccion_fo();
$obj_gener->$cadena_funcion($_POST['ref_sisa'],$_POST['punta'],$_POST['tabla'],$_POST);




?>
