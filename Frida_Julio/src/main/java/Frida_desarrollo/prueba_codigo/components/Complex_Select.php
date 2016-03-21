<?php 
//include("imports/clases/Parametros_cat_construccion_fo.php");
include("../conexion.php");
include("imports/imports_parametros.php");
class html_components{
private $tabla;

 
 
 
public function __construct(
       $table=NULL
	   ){
		$this->tabla=$table;
		   }
 
 	private static function querys_exec_html($query,$valores,$cat_tipo)
   {
	    try{
					$resultado_query= mysql_query($query);
			        $array_prep=array();
					$i=0;
					//echo count($valores);
					if(count($valores)>=2){
					if(!empty($cat_tipo))
					{
					 $total_filas=mysql_num_rows($resultado_query);
					 for($i=0;$i<=$total_filas;$i++){
                    	 $info_fila=mysql_fetch_row($resultado_query);
						  if($info_fila!=NULL){
						 $array_prep[$i]=implode(',',$info_fila);
						  }
						 }
					$numer=count($array_prep);
           			$cadena_search=preg_quote($cat_tipo);
						for ($h=0; $h<=($numer-1);$h++)
						{
							  if(!eregi($cadena_search,$array_prep[$h]))
							  {
								  $array_prep[$h]=NULL;	  
							  }
							  else{
								 $cadena_2=$cat_tipo.",";
								 $array_prep[$h]=str_replace($cadena_2,"",$array_prep[$h]);
								  }
						}
								
						$array_limpio_select=array_filter($array_prep);				
							 sort($array_limpio_select,SORT_STRING);
											
					} 
					}
     			 else{
						 $array_limpio_select=mysql_fetch_row($resultado_query);
						 $numero=count($array_limpio_select);
						 for($k=0;$k<=$numero-1;$k++){
							 $array_limpio_select[$k]=str_replace(",","",$array_limpio_select[$k]); 
							 }
						   //var_dump($array_limpio_select);
					 }
				  
	               return $array_limpio_select;			  
					
		        			  
		}
		catch(Exception $e)
				{
				echo $e->getMessage();
				return NULL;
				}
	  	  
   }





public static function select_column($table,$valores){
	 try{
   	 $objeto_comp=new self;
	 $objeto_comp->tabla=$table;
	 $variable_serial="Parametros_".$objeto_comp->tabla;
	//echo $variable_serial;
	  $obj_tabla=new $variable_serial;
     if(is_object($obj_tabla))
	 {
	    $array_complex=array();
		$numero=count($obj_tabla->arrays); 
	  for($i=1;$i<=$numero;$i++)
	{
			 if($valores['valor_'.$i.'']!="")
				{	 
               $array_complex[$i]=$objeto_comp->tabla.".".$obj_tabla->arrays['columna_'.$i.'']."";
			   }
		
             if($valores['valor_'.$i.'']=="")
				{	 
                $array_complex[$i]=NULL;;
				
				}		
				
				
		
	}
	return $array_complex;			
     }
  else{
	  echo "Error en la creacion del objeto revisa el nombre del parametro ";	  
	  }
	 }
				catch(Exception $e)
				{
				echo $e->getMessage();
				}
		
				
	}

 
 
 public static function dinamic_simplex_select(){
	 echo "HOLA SELECT SIMPLE";

	 }
 
 
 
 
 
 
 public static function dinamic_select($array_structure)
 {

  		 $cont=0;
		 $array_select=array();
		foreach($array_structure as $tabla => $valores){
		$cadena_array[$cont]=html_components::select_column($tabla,$valores);
         $array_limpio[$cont]=array_filter($cadena_array[$cont]);   
			$cont++;
			}
     var_dump($array_limpio);
	 
	 
		
		
		

	 
	 } 
 
 
  
 
 
 
 
  public function __set($parametro,$valor)
	{
 	      if (property_exists($this, $parametro)) 
		  {
 		$this->$parametro = $valor;
 	      }
 	else{
 		echo "Imposible encotrar parametro";
 		 }
	}
 

    public function __get($parametro)
	{
 	 	if (property_exists($this, $parametro)) 
		{
 		return $this->$parametro;
 		}
	 	else
		{
 		echo "no existe propiedad";
 		}
 	}
 
 
	
	}

	

$array_structure=array(
"cat_construccion_fo"=>array("valor_1"=>"0", //1 order_by
                "valor_2"=>"1",  //2 Group_by
				"valor_1"=>"1"), //0 Nada.
"cat_proveedor"=>array("valor_1"=>"0",
                       "valor_2"=>"1",
					   "valor_10"=>"2")
);

$num=count($select_complejo);
$num_2=count($select_complejo['tabla_2']);
//echo $num_2;
$hola_2=html_components::dinamic_select($array_structure);



?>