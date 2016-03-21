<?php
class jar_invocation{
	private $file_jar;
	private $args;
	private $Device_name;
    private $distributorDevice;	
	private $CentralName;
	private $PortType;
	private $ServiceName;
	private $ServiceType;
	private $serviceClass;
	private $noOfPort; 

	public function __construct($file_jar=NULL,$args=NULL){
		$this->file_jar=$file_jar;
		$this->args=$args;
		}
	
     public static function  jar_exec($files_jar,$args){
		 $para_obj=new self;
		 $para_obj->file_jar=$files_jar;
		 $para_obj->args=$args;
		  
		 $datos_duros=implode(" ",$args);
		 echo $datos_duros;
        if (function_exists('exec')){
                $ruta_jar="C:\\Sun\\AppServer\j2eetutorial14\exmples\jms\simple";
				$direc_jar=$ruta_jar."\\".$para_obj->file_jar." ";
				//echo "java -jar ".$direc_jar." ".$args." 2>&1";
			//	exec("appclient -client ".$direc_jar." ".$datos_duros." ",$output);
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


$array_datos=array(
 "Device_name"=>"1",
 "distributorDevice"=>"1",
 "CentralName"=>"1",
 "PortType"=>"1",
 "ServiceName"=>"1",
 "ServiceType"=>"1",
 "serviceClass"=>"1",
 "noOfPort"=>"1",
);

jar_invocation::jar_exec("SimpleProducer.jar",$array_datos);


	
?>


