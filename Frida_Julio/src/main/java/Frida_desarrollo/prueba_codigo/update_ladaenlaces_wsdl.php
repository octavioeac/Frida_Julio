<?
//include("../conexion.php");
include("clases/Parametros_ladaenlaces.php");
class update_ladaenclaes_wsdl{
	
	public static function update_ladaenlaces_wsdl($query)
   {
	    $resultado_query= mysql_query($query);
        return $resultado_query;
	  	  
   }
   
     public static function update_liquida_wsdl($ref_sisa,$punta,$tabla,$valores){
       $obj_tabla=new Parametros_ladaenlaces();
	   $numero=count($obj_tabla->arrays); 
       $obj_tabla->ref_sisa=$ref_sisa;
	   $array_update= array();

    for($i=1;$i<=$numero;$i++)
	{
			 if($valores['valor_'.$i.'']!="")
				{	 
               $array_update[$i]="".$obj_tabla->arrays['columna_'.$i.'']."='".$valores['valor_'.$i.'']."'";
			   }
		
             if($valores['valor_'.$i.'']=="")
				{	 
                $array_update[$i]=NULL;;
				}		
		
	}
   $array_limpio=array_filter($array_update);
   $cadena=implode(",",$array_limpio);
   $query_udpate="update ".$tabla." set ".$cadena." where ".$obj_tabla->arrays['columna_3']."='".$obj_tabla->ref_sisa."'";
   $resul= update_ladaenclaes_wsdl::update_ladaenlaces_wsdl($query_udpate);
  echo $resul;
	echo $query_udpate; 
  
   }  
 
}
$ref_sisa="D32-0708-0515";
$punta=NULL;
$tabla="ladaenlaces";
$valores=array(
"valor_503"=>"hola_1",
"valor_554"=>"hola_2",
"valor_553"=>"hola_3"
);
update_ladaenclaes_wsdl::update_liquida_wsdl($ref_sisa,$punta,$tabla,$valores);



?>