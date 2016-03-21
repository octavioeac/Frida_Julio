

<?PHP
class Padre{
	 private $parametro;
     private $parameto_2;
	
	 function __construct($parametro="HUE"){
		 $this->parametro=$parametro;
		 }
	 	 function padre_function(){
	 return "mamador";
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
function padre_function(){
	 return "mamadoita";
	 }
	 
	 
	}


class hija extends Padre {
function padre_function(){
	 return "mamadota";
	 }
}

class oper_suma{
	    private $a1;
		private $b1;
		function operacion_suma($a,$b){
		return $a+$b;
		}
	}

class oper_resta{
	    private $a1;
		private $b1;
		function operacion_resta($a,$b){
		return $a-$b;
		}
	}
class oper_multi{
	    private $a1;
		private $b1;
		function operacion_multi($a,$b){
		return $a*$b;
		}
	}
$arreglo=array("1"=>"suma","2"=>"resta","3"=>"multi");
for($i=1;$i<=count($arreglo);$i++){
    $cadena="oper_".$arreglo[$i];
	$objeto_dinamico=new $cadena();
//	var_dump($objeto_dinamico);
	$cadena2="operacion_".$arreglo[$i];
//	echo $cadena2;
	echo $objeto_dinamico->$cadena2(2,4)."<br>";
	
	}




//$a=array ("nivel1"=>1,"nivel2"=>2,"nivel3"=>3,"nivel4"=>4,"nivel5"=>5);
//$a=array (1=>100,2=>200,3=>300,4=>400,5=>500);
$nivel1=1;
$hola="nivel1";
echo $$hola;
$pa=new Padre();
$hika=new hija();

echo $pa->padre_function();
echo $hika->padre_function();






?>