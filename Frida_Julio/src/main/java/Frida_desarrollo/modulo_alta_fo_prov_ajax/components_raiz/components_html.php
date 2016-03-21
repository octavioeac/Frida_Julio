<?php 
//include("imports/clases/Parametros_cat_construccion_fo.php");
//include("../conexion.php");
include("imports/imports_parametros.php");
class html_components{
private $tabla;
private $name_component;
private $id_component;
private $estilo;
private $orden; 
private $js_function;     
private $cat_tipo;  
private $operador_logico;
private $mensaje;
 
 
 
public function __construct(
       $table=NULL,
	   $name_componente=NULL,
       $id_componen=NULL,
	   $estilo=NULL,
	   $js_function=NULL,
	   $cat_tipo=NULL,
	   $operador_logico=NULL,
	   $mensaje="Seleccione "
	   ){
		$this->tabla=$table;
		$this->name_component=$name_componente;
		$this->id_component=$id_componen;
		$this->estilo=$estilo;	 
		$this->js_function=$js_function;	   
		$this->cat_tipo=$cat_tipo;	      
		$this->operador_logico=$operador_logico;
		$this->mensaje=$mensaje;
		   }
 
 	private static function querys_exec_html($query,$valores,$cat_tipo,$valor_comparar)
   {
	    try{
					
					if($valor_comparar==NULL){
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
     			if($cat_tipo==NULL){
						 
						 $array_limpio_select=mysql_fetch_row($resultado_query);
						  $numero=count($array_limpio_select);
						 for($k=0;$k<=$numero-1;$k++){
							 $array_limpio_select[$k]=str_replace(",","",$array_limpio_select[$k]); 
							 }
							 sort($array_limpio_select,SORT_STRING);
							 
					 }
					    return $array_limpio_select;			  
					}
			 
			 
			 
			   else{
				  $result=mysql_query($query);
                
				 for($j=0;$j<mysql_num_rows($result);$j++)
				{
				$var_sup_const[$j]=mysql_result($result,$j);
				}
                sort($var_sup_const,SORT_STRING);
				   return $var_sup_const;
	              			   
				   }		
					
					
	            
					
		        			  
		}
		catch(Exception $e)
				{
				echo $e->getMessage();
				return NULL;
				}
	  	  
   }





private static function select_column_html($table,$valores,$cat_tipo,$operador_log,$valor_comparar){
	 try{
	 $objeto_comp=new self;
	 $objeto_comp->tabla=$table;
	 $objeto_comp->cat_tipo=$cat_tipo;
	 $objeto_comp->operador_logico=$operador_logico;
	 //echo $objeto_comp->operador_logico;
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
                	
					//echo $cadena;
					
		$auxili_selec=html_components::select_auxiliar_column_html($table,$cat_tipo,$operador_log,$valor_comparar);
		
							
					
					
					
					if(count($valores)>=2){
					
						if($auxili_selec==""){
					$query_select="select ".$cadena." from ".$objeto_comp->tabla;
						}
						else{
					$query_select="select ".$cadena." from ".$objeto_comp->tabla." where ".$auxili_selec;		
							}
					}
					else{
					  if($auxili_selec==""){
					$query_select="select ".$cadena." from ".$objeto_comp->tabla." ";	
						}
						else{
					$query_select="select ".$cadena." from ".$objeto_comp->tabla." where ".$auxili_selec;		
							}
						}
					//	echo $query_select;
					
	
					$result=html_components::querys_exec_html($query_select,$valores,$objeto_comp->cat_tipo,$valor_comparar);	
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

 
 
 private static function select_auxiliar_column_html($table,$cat_tipo,$operador_log,$valor_comparar){
	 try{
	 $objeto_comp=new self;
	 $objeto_comp->tabla=$table;
	 $objeto_comp->cat_tipo=$cat_tipo;
	 $objeto_comp->operador_logico=$operador_logico;
	 $variable_serial="Parametros_".$objeto_comp->tabla;
    $obj_tabla=new $variable_serial;
     if(is_object($obj_tabla))
	 {
					
					$numero=count($obj_tabla->arrays); 
                	$comp_array= array();
		            		
	             			
					
					
					for($i=0;$i<=$numero;$i++)
					{
							 if($valor_comparar['valor_'.$i.'']!="")
								{	 
							   
				   $comp_array[$i]="".$obj_tabla->arrays['columna_'.$i.'']."='".$valor_comparar['valor_'.$i.'']."' ";
							   }
						
							 if($valor_comparar['valor_'.$i.'']=="")
								{	 
								$comp_array[$i]=NULL;
								}		
						
					}
				   
				  	
				   
				   
				   $array_limpio=array_filter($comp_array);
				 $numero_array_count=count($array_limpio);
					 $cont=1;
					 $array_reseteado=array();
					foreach($array_limpio as $valor){
						$array_reseteado[$cont]=$valor;
						$cont++;
						}
					//var_dump($array_reseteado);	
						
				  $numero_2=count($array_reseteado);
				   $comp_array_2=array();
				   
				   for($m=1;$m<=$numero_2;$m++)
					{
							if($array_reseteado[$m]!="")
								{	 
							
							 if($m<=1)   
				          $comp_array_2[$m]=$array_reseteado[$m];
						        
						   else{
							   
						 $comp_array_2[$m]="".$operador_log[$m-1]." ".$array_reseteado[$m]; 			
								
								} 
							  }
					}
					
			$cadena_aux=implode("",$comp_array_2);
		     return $cadena_aux;
				
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
 $cat_tipo,
 $operador_logico,
 $mensaje,
 $valor_comparar)
 {
  
	$objeto_html=new html_components();
    $objeto_html->tabla=$tabla;
	$objeto_html->estilo=$estilo;   
	$objeto_html->id_component=$id_componente;
	$objeto_html->name_component=$name_componente;
	$objeto_html->js_function=$js_function;
    $objeto_html->cat_tipo=$cat_tipo; 
	$objeto_html->operador_logico=$operador_logico;
    if($mensaje!=NULL){
	$objeto_html->mensaje=$mensaje; 
	}
	$array_funcion=html_components::select_column_html(
	                   $objeto_html->tabla,
					   $valores,
					   $objeto_html->cat_tipo,
					   $operador_logico,
					   $valor_comparar
					   );


						      
$string_combo="<select class='".$objeto_html->estilo."'  name='".$objeto_html->name_component."' id='".$objeto_html->id_component."' "; 
if(!empty($objeto_html->js_function)){
$string_combo.=" onchange=".$objeto_html->js_function.">";
}
else{
$string_combo.=">";
}


$string_combo.='<option value="">  --'.$objeto_html->mensaje.'--  </option>';
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
	
	

/* $combo_cat_tecnic=html_components::dinamic_select_combo(
"cat_tecnicos", //tabla a la que llegua $tabla
"supervisor_const", //nombre del componente $name_componente
"supervisor_const",  //id del componente $id_componente
"Estilo1",  //CSS que se desea 
$valores=array(
   "valor_1"=>"lleno"
   ),   //columnas
NULL, //funciones $js_script
NULL,//REQUERIMIENTOS
$operador=array(
"1"=>"and"
), //OPERADOR LOGICO
"supervisor_const", //<option>  --'MENSAJE A MOSTRAR '--  </option>
$valor_comparar=array(
   "valor_2"=>"RDA CARSO",
   "valor_3"=>"SUPERVISOR"
    //valor en  select campo from tabla where valor_1='' and valor_2='SUPERVISOR' "
)
); 	//nuevas opción o sin opción 


echo $combo_cat_tecnic;






 $combo_cat_fo=html_components::dinamic_select_combo(
"cat_construccion_fo", //tabla a la que llegua $tabla
"supervisor_const", //nombre del componente $name_componente
"supervisor_const",  //id del componente $id_componente
"Estilo1",  //CSS que se desea 
$valores=array(
  "valor_1"=>"2",
   "valor_2"=>"1"
   ),   //columnas
NULL, //funciones $js_script
"Requerimiento",//REQUERIMIENTOS
NULL, //OPERADOR LOGICO
NULL, //<option>  --'MENSAJE A MOSTRAR '--  </option>
NULL  //valor en  select campo from tabla where valor_1='' and valor_2='SUPERVISOR' "
); 	//nuevas opción o sin opción 
echo $combo_cat_fo;
*/

				

?>