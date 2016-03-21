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
	$numero=count($obj_tabla->arrays); 
     echo "<br>";
  $hola= array();
  $hola_2= array();
    for($i=1;$i<=$numero;$i++)
	{
			  
			 if($valores['valor_'.$i.'']!="")
				{	 
               $hola[$i]="".$obj_tabla->arrays['columna_'.$i.'']."";
 			   $hola_2[$i]="'".$valores['valor_'.$i.'']."'";
			   
			   }
		
             if($valores['valor_'.$i.'']=="")
				{	 
                $hola[$i]=NULL;;
				}		
		
	}
   $array_insert_campo=array_filter($hola);
   $cadena_insert_campo=implode(",",$array_insert_campo);
   $array_insert_value=array_filter($hola_2);
   $cadena_insert_value=implode(",",$array_insert_value);
   $query_udpate="insert into ".$tabla." (".$cadena_insert_campo.") values(".$cadena_insert_value.")" ;

$array_select=dao_contruccion_fo::querys_exec_no_select($query_udpate);
	   return $array_select;
	      
	   
	   }




   public  function update_dinamic_query($ref_sisa,$punta,$tabla,$valores){
    var_dump($valores);
    $obj_tabla=new Parametros_construccion_fo();
	$numero=count($obj_tabla->arrays); 
    $hola= array();

    for($i=0;$i<=$numero;$i++)
	{
			 if($valores['valor_'.$i.'']!="")
				{	 
               $hola[$i]="".$obj_tabla->arrays['columna_'.$i.'']."='".$valores['valor_'.$i.'']."'";
			   }
		
             if($valores['valor_'.$i.'']=="")
				{	 
                $hola[$i]=NULL;;
				}		
		
	
	
	
	
	
	}

   $array_limpio=array_filter($hola);
   $cadena=implode(",",$array_limpio);
   $query_udpate="update ".$tabla." set ".$cadena." where ".$obj_tabla->ref_sisa."='".$ref_sisa."'";

    $resul= dao_contruccion_fo::querys_exec_no_select($query_udpate);
   
	
  
   }  
   
   
   public static function clean_string($cadena_clean){
  $a = explode(',', utf8_decode($cadena_clean));

    foreach ($a as $result) {
    $b = explode('-', $result);
    $array[$b[0]] = $b[1];
     }
	     return $array;
	   }
   


}





 



$valores = dao_contruccion_fo::clean_string($_POST["json_string"]);
$cadena_funcion=$_POST['funcion_name']."_dinamic_query";
$obj_gener=new dao_contruccion_fo();
$obj_gener->$cadena_funcion($_POST['ref_sisa'],$_POST['punta'],$_POST['tabla'],$valores);




?>
