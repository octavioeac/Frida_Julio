<?php
include("conexion.php");
include ("clases/Parametros_fibra_optica_ladenlaces.php");
include ("clases/Parametros_tablas.php");
class select_fibra_optica_ladaenlaces{
	
	public static function querys_exec($query)
   {
	    $resultado_query= mysql_query($query);
        $result=mysql_fetch_array($resultado_query);
            return $result;
	  	  
   }
   

   

   public static function select_cambio_nodo($ref_sisa,$punta,$tabla,$valores,$tipo_trabajo){
	
    $obj_valor=new Parametros_tablas;
	$obj_valor->ref_sisa_1=$ref_sisa;
	$obj_valor->punta_1=$punta;
    $obj_tabla=new Parametros_fibra_optica_ladenlaces();
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
   
    $query_select="select ".$cadena." from ".$tabla." where ".$obj_tabla->ref_sisa."='".$obj_valor->ref_sisa_1."' and tipo_trayec='".$tipo_trabajo."'";
	$array_select=select_fibra_optica_ladaenlaces::querys_exec($query_select);
	   return $array_select;
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

	echo $query_udpate; 
  
	      
	   
	   }




   public  function update_cambio_nodo_3($ref_sisa,$punta,$tabla,$valores){
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
  $resul= select_fibra_optica_ladaenlaces::querys_exec($query_udpate);
  echo $resul;
	echo $query_udpate; 
  
   }  

  













}



$ref_sisa="D32-0708-0515";
$tabla="fibra_optica_ladenlaces";
$valores=array(
    "valor_43"=>"tipo_trayec",
	"valor_48"=>"cliente",
	"valor_5"=>"cable",
    "valor_6"=>"longitud",
	"valor_29"=>"ubicaciona",
	"valor_47"=>"cap_cable",
	"valor_6"=>"longitud",
	"valor_47"=>"cap_cable",
	"valor_46"=>"tipo_jumper",
	"valor_31"=>"fibra_a",
	"valor_30"=>"fibra_b",
	"valor_50"=>"pedido45"
	
);

/*$tipo_trabajo='CENTRAL (TRABAJO)';
$array_obj=select_fibra_optica_ladaenlaces::select_cambio_nodo($ref_sisa, $punta, $tabla,$valores,$tipo_trabajo);
var_dump($array_obj);
*/


?>