<?php
include("conexion.php");
include ("clases/Parametros_tablas.php");
include ("clases/Argumentos.php");

class Mysql_cambio_nodo{
	
	public static function select_nodo($query)
   {
	    $resultado_query= mysql_query($query);
        //$result=mysql_fetch_array($resultado_query);
            return $resultado_query;
	  	  
   }
   

   

   public static function select_cambio_nodo($ref_sisa,$punta,$tabla,$valores){
    $obj_valor=new Parametros_tablas;
	$obj_valor->ref_sisa_1=$ref_sisa;
	$obj_valor->punta_1=$punta;
    $obj_tabla=new Argumentos();
	//var_dump($obj_tabla->arrays);
	$numero=count($obj_tabla->arrays); 
	echo $numero;


	$query= "select ";
	for($i=1;$i<=$numero;$i++){
     if($i<$numero){
	$query.= $obj_tabla->arrays['columna_'.$i.''].",";	
		}
	 if($i==$numero){
	$query.= $obj_tabla->arrays['columna_'.$i.''];	
		}
		
		}
    $query.=" from ".$tabla." where ".$obj_tabla->ref_sisa."=".$obj_valor->ref_sisa_1." and ...<br>";
   // echo $query;
      
	  
//	var_dump($valores);
	  
     echo "<br>";
	 
	 
	 
	 
    $query_update ="update ".$tabla." set ";
    for($i=1;$i<=$numero;$i++)
	{
        if($i<$numero)
		{
			 if($valores['valor_'.$i.'']!="")
				{	 
					$query_update.= $obj_tabla->arrays['columna_'.$i.'']."='".$valores['valor_'.$i.'']."',";	
				}
		}
	 	if($i==$numero)
	    {
		      if($valores['valor_'.$i.'']!="")
			  {	
				$query_update.= $obj_tabla->arrays['columna_'.$i.'']."='".$valores['valor_'.$i.'']."'";	
			  }
		}
		
	}
    
	  $query_update.=" where ".$obj_tabla->ref_sisa."='".$obj_valor->ref_sisa_1."' and ...<br>";
   
   echo $query_update;
  
   }  
  
  
   public  function select_cambio_nodo_2($ref_sisa,$punta,$tabla,$valores){
    $obj_valor=new Parametros_tablas;
	$obj_valor->ref_sisa_1=$ref_sisa;
	$obj_valor->punta_1=$punta;
    $obj_tabla=new Argumentos();
	
   //var_dump($obj_tabla->arrays);
	$numero=count($obj_tabla->arrays); 
	echo $numero;
    
$numero_array=count($valores); 
	echo $numero_array;
	
	$query= "select ";
	for($i=1;$i<=$numero;$i++){
     if($i<$numero){
	$query.= $obj_tabla->arrays['columna_'.$i.''].",";	
		}
	 if($i==$numero){
	$query.= $obj_tabla->arrays['columna_'.$i.''];	
		}
		
		}
    $query.=" from ".$tabla." where ".$obj_tabla->ref_sisa."=".$obj_valor->ref_sisa_1." and ...<br>";
   // echo $query;
      
	  
	//var_dump($valores);
	  
     echo "<br>";
    $query_update ="update ".$tabla." set ";
    for($i=1;$i<=$numero;$i++)
	{
        if($i<$numero)
		{
			 if($valores['valor_'.$i.'']!="")
				{	 
					$query_update.=$obj_tabla->arrays['columna_'.$i.'']."='".$valores['valor_'.$i.'']."', ";	
				}
		}
	 	if($i==$numero)
	    {
		      if($valores['valor_'.$i.'']!="")
			  {	
				$query_update.= $obj_tabla->arrays['columna_'.$i.'']."='".$valores['valor_'.$i.'']."' ";	
			  }
		}
		
	}
    
	  $query_update.=" where ".$obj_tabla->ref_sisa."=".$obj_valor->ref_sisa_1." and ...<br>";
   
   echo $query_update;
  
   }  

  



   public function insert_cambio_nodo($ref_sisa,$punta,$tabla,$valores){
    $obj_valor=new Parametros_tablas;
	$obj_valor->ref_sisa_1=$ref_sisa;
	$obj_valor->punta_1=$punta;
    $obj_tabla=new Argumentos();
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
//  $resul= Mysql_cambio_nodo::select_nodo($query_udpate);
  //echo $resul;
	echo $query_udpate; 
  
	      
	   
	   }




   public  function select_cambio_nodo_3($ref_sisa,$punta,$tabla,$valores){
    $obj_valor=new Parametros_tablas;
	$obj_valor->ref_sisa_1=$ref_sisa;
	$obj_valor->punta_1=$punta;
    $obj_tabla=new Argumentos();
	$numero=count($obj_tabla->arrays); 
     echo "<br>";
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
   $query_udpate="update ".$tabla." set ".$cadena." where ".$obj_tabla->ref_sisa."='".$obj_valor->ref_sisa_1."'";
  $resul= Mysql_cambio_nodo::select_nodo($query_udpate);
  echo $resul;
	echo $query_udpate; 
  
   }  

  













}



$ref_sisa="D32-0708-0515";
$tabla="ladaenlaces";
$valores=array(
    "valor_11"=>"Prueba_1",
	"valor_28"=>"Prueba_1",
	"valor_3"=>"Prueba_1",
	"valor_234"=>"Prueba_1",
	"valor_125"=>"JULIO"
);

$valores_2=array(
    "valor_1"=>"Prueba_2",
	"valor_2"=>",Prueba_2",
	"valor_3"=>"ajshkashjhkj",
	"valor_4"=>"Prueba_2",
	"valor_5"=>"JULIO"
);

Mysql_cambio_nodo::select_cambio_nodo($ref_sisa, $punta, $tabla,$valores);
$objeto=new Mysql_cambio_nodo;
$objeto->select_cambio_nodo_2($ref_sisa, $punta, $tabla,$valores_2);

$valores_3=array(
    "valor_19"=>"Prueba_3",
	"valor_12"=>"",
	"valor_34"=>"",
	"valor_20"=>"Prueba_3",
	"valor_45"=>"JULIO",
	"valor_40"=>"SAL de UVAS",
	"valor_567"=>"SUPER"
);


/*$objeto_2=new Mysql_cambio_nodo;
$objeto_2->select_cambio_nodo_2($ref_sisa, $punta, $tabla,$valores_3);*/


/*$objeto_3=new Mysql_cambio_nodo;
$objeto_3->select_cambio_nodo_3($ref_sisa, $punta, $tabla,$valores_3);*/

/*
$n=580;
for($i=1;$i<=$n;$i++){
echo '"columna_'.$i.'"=>" <br>';
	}*/

$objeto_2=new Mysql_cambio_nodo;
$objeto_2->insert_cambio_nodo($ref_sisa, $punta, $tabla,$valores_3);
?>