<?php
class jar_invocation{
	private $file_jar;
	private $args;
		
	public function __construct($file_jar=NULL,$args=NULL){
		$this->file_jar=$file_jar;
		$this->args=$args;
		}
	
     public static function  jar_exec($files_jar,$args){
		 $para_obj=new self;
		 $para_obj->file_jar=$files_jar;
		 $para_obj->args=$args;
        if (function_exists('exec')){
				$dir=(__FILE__);

				$dir_array=explode("\\", $dir);
				$num_array=count($dir_array);
					if($dir_array[$num_array-1])
					{
					  $dir_array[$num_array-1]=NULL;
					}
				$array_limpio=array_filter($dir_array);
				$cadena_path=implode("\\",$array_limpio);
				
				$parame_gener=$cadena_path."\\clases_dao";
				
				$direc_jar=$cadena_path."\\".$para_obj->file_jar." ";
				//echo "java -jar ".$direc_jar." ".$args." 2>&1";
				exec("java -jar ".$direc_jar." ".$args." 2>&1",$output);
               
			    $cadenita=(string)$output[0];
				echo $cadenita;
				return $cadenita;
			   
		}
		else{
				echo "no existe";
		    }
	
    }

	public function __set($propiedad,$valor){
	 if (property_exists($this, $propiedad)) {
            $this->$propiedad = $valor;
        }
        else{
        echo "Imposible encotrar parametro";	
        	
        }
	}
	
	
	public function __get($propiedad){
	if (property_exists($this, $propiedad)) {
                return $this->$propiedad;
            }
            else{
            echo "no existe propiedad";	
            }
	}
   




}

$parametro=array(
 "parametro_0"=>"C01-1402-0048",
 "parametro_1"=>"C01-1303-0015",
 "parametro_2"=>"F10-0704-0012"
);


//$jasper=jar_invocation::jar_exec("Json_daos_2.jar","C01-1402-0048");
/*$arra_general=array();
for($i=0;$i<=(count($parametro)-1);$i++){
	sleep(2);
 $arra_general[$i]=jar_invocation::jar_exec("Json_daos_2.jar",$parametro["parametro_".$i]);

	}*/

$jasper=jar_invocation::jar_exec("Hola_java.jar","F10-0704-0012");

//echo $diccionario_jason;//

//var_dump($jasper);

$info = array('café', 'marrón', 'cafeína');

// Listando todas las variables
list($drink, $color, $power) = $info;
//echo "El $drink es $color y la $power lo hace especial.\n";


	
?>


