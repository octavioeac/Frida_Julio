<?
/**
 * 
 * Clase de conexion DBMYSQL
 *
 * @author Nub
 * @link nub
 * .
 */
class Conecta{
	private  $host ;
	private  $user ;
	private  $pass ;
	private  $name ;
	//private static $conexion;



	public function __construct($dbhost,$dbuser,$dbpass,$dbname){

		$this->host = $dbhost;
		$this->user = $dbuser;
		$this->pass = $dbpass;
		$this->name = $dbname;
		$this->inicia();
	}
	public function __destruct(){
		$this->conexion = mysql_close();
	}

	private function inicia(){
		$this->conexion = mysql_connect($this->host,$this->user,$this->pass) or die("Imposible Conectar".mysql_error());
		mysql_select_db($this->name,$this->conexion) or die("No se ha podido seleccionar la base de datos".mysql_error());

	}
	public function consulta($sqlQuery){
		$result = mysql_query($sqlQuery,$this->conexion) OR die("Ha ocurrido un error:".mysql_error());
		return $result;
	}

	public function fetch_array($sqlResult){
		$fetch = mysql_fetch_array($sqlResult);
		return $fetch;
	}
	
	

}
?>