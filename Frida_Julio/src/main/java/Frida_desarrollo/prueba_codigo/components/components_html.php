<?php 
//include("imports/clases/Parametros_cat_construccion_fo.php");
include("../conexion.php");
include("imports/imports_parametros.php");
class html_components{
private $tabla;
private $name_component;
private $id_component;
private $estilo;
private $orden; 
private $js_function;     
private $cat_tipo;  

 
 
 
public function __construct(
       $table=NULL,
	   $name_componente=NULL,
       $id_componen=NULL,
	   $estilo=NULL,
	   $js_function=NULL,
	   $cat_tipo=NULL
	   ){
		$this->tabla=$table;
		$this->name_component=$name_componente;
		$this->id_component=$id_componen;
		$this->estilo=$estilo;	 
		$this->js_function=$js_function;	   
		$this->cat_tipo=$cat_tipo;	      
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





private static function select_column_html($table,$valores,$cat_tipo){
	 try{
	 $objeto_comp=new self;
	 $objeto_comp->tabla=$table;
	 $objeto_comp->cat_tipo=$cat_tipo;
	 $variable_serial="Parametros_".$objeto_comp->tabla;
//	 echo $variable_serial;
	  $obj_tabla=new $variable_serial;
     if(is_object($obj_tabla))
	 {
					
					$numero=count($obj_tabla->arrays); 
                	$comp_array= array();
		            		
	             			
					for($i=0;$i<=$numero;$i++)
					{
							 if($valores['valor_'.$i.'']!="")
								{	 
							   $comp_array[$i]="".$obj_tabla->arrays['columna_'.$i.'']."";
							   }
						
							 if($valores['valor_'.$i.'']=="")
								{	 
								$comp_array[$i]=NULL;
								}		
						
					}
				   $array_limpio=array_filter($comp_array);
				   $cadena=implode(",",$array_limpio);
                	
					if(count($valores)>=2){
					
					$query_select="select ".$cadena." from ".$objeto_comp->tabla;
					
					}
					else{
					$query_select="select ".$cadena." from ".$objeto_comp->tabla." ";	
						}
						//echo $query_select;
					$result=html_components::querys_exec_html($query_select,$valores,$objeto_comp->cat_tipo);	
					//var_dump($result);			
				    return $result; 
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

 
 
 
 
 
 
 
 
 
 public static function dinamic_select_combo(
 $tabla,
 $name_componente,
 $id_componente,
 $estilo,
 $valores,
 $js_function,
 $cat_tipo)
 {
  
	$objeto_html=new html_components();
    $objeto_html->tabla=$tabla;
	$objeto_html->estilo=$estilo;   
	$objeto_html->id_component=$id_componente;
	$objeto_html->name_component=$name_componente;
	$objeto_html->js_function=$js_function;
    $objeto_html->cat_tipo=$cat_tipo; 

	$array_funcion=html_components::select_column_html(
	                   $objeto_html->tabla,
					   $valores,
					   $objeto_html->cat_tipo        
	                   );


						      
$string_combo="<select class='".$objeto_html->estilo."'  name='".$objeto_html->name_component."' id='".$objeto_html->id_component."' "; 
if(!empty($objeto_html->js_function)){
$string_combo.=" onchange=".$objeto_html->js_function.">";
}
else{
$string_combo.=">";
}
$string_combo.='<option values=""> Seleccione </option>';
foreach($array_funcion as $opciones){
$string_combo.="<option value='".$opciones."'>".$opciones."</option>";
	}
$string_combo.="</select>"; 

		 return $string_combo;
		 
	 
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
	
	
	
 $tabla="cat_construccion_fo";
 $name_componente="hola";
 $id_componente="id_hola";
 $estilo="Estilo3";
  $js_class="combo_requerimiento()";
  $cat_tipo="dependencia construccion";

$combo_fo=html_components::dinamic_select_combo(
"cat_construccion_fo", //tabla a la que llegua $tabla
"tipo_req", //nombre del componente $name_componente
"tipo_req",  //id del componente $id_componente
"Estilo1",  //CSS que se desea 
$valores=array(
   "valor_1"=>"2",
   "valor_2"=>"1"
),   //columnas
NULL,//funciones $js_script
"Requerimiento");	 
echo $combo_fo;



?>