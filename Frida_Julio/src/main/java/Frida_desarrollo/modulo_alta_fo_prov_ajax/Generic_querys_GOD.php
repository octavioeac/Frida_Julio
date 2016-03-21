<?php
include("conexion.php");
include ("clases/Parametros_construccion_fo.php");
//include ("clases/Parametros_tablas.php");
class dao_contruccion_fo_god{
	
	public static function querys_exec($query)
   {
	    //echo $query;
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
	//echo $query_select;
	$array_select=dao_contruccion_fo_god::querys_exec($query_select);
	
	   return $array_select;
  }  
  
  
  

  



   public function insert_dinamic_query($ref_sisa,$punta,$tabla,$valores){
    /*$obj_valor=new Parametros_tablas;
	$obj_valor->ref_sisa_1=$ref_sisa;
	$obj_valor->punta_1=$punta;*/
    $obj_tabla=new Parametros_construccion_fo();
	$obj_tabla->ref_sisa=$ref_sisa;
	$obj_tabla->punta=$punta;

	$numero=count($obj_tabla->arrays); 
    // echo "<br>";
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
//echo $query_udpate;
$array_select=dao_contruccion_fo_god::querys_exec_no_select($query_udpate);
	   return $array_select;
	      
	   
	   }




   public  function update_dinamic_query($ref_sisa,$punta,$tabla,$valores){
      $obj_tabla=new Parametros_construccion_fo();
	$numero=count($obj_tabla->arrays); 
    $hola= array();

    for($i=1;$i<=$numero;$i++)
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

    $resul= dao_contruccion_fo_god::querys_exec_no_select($query_udpate);

	
  
   }  





}






?>
