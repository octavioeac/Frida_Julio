<?php
class MySQLClass {
	var $HostName;
	var $UserName;
	var $Password;
	var $DataBase;
	var $Result;
	var $Link;

	#Constructor
	function MySQLClass( $HostNameini=null, $UserNameini=null, $Passwordini=null, $DataBaseini=null ) {
		if (($HostNameini!=null) and ($UserNameini!=null) and ($Passwordini!=null) and ($DataBaseini!=null) )
		{
			$this->HostName = $HostNameini;
			$this->UserName = $UserNameini;
			$this->Password = $Passwordini;
			$this->DataBase = $DataBaseini;
		 }
		 else 
		 {
		 	$this->HostName='ovaldezm2';
		 	$this->UserName='reportes';
		 	$this->Password='reportes';
		 	$this->DataBase='inversion';
		 }
		if(!$this->Link=mysql_connect($this->HostName,$this->UserName,$this->Password)) 
			die("No pudo conectarse con el servidor <b>$this->HostName:</b><br> ".mysql_error());
		if(!mysql_select_db($this->DataBase,$this->Link))
		 	die("No pudo seleccionarse la Base de Datos <b>$this->DataBase:</b><br> ".mysql_error());
		mysql_query ("SET NAMES 'utf8'");
	}//Constructor	

	#Desconecta de la base de datos
	function Disconnect () {
		@mysql_close($this->Link);
	}

	#Realiza una consulta
	function Query( $sql ) {
		if(!$result =mysql_query( $sql,$this->Link ))
			die("<br><br><b>La consulta:</b> [ $sql ] fall&oacute;:<br><b>".mysql_error())."</b>";
		return $result;
	}
	function Query1( $sql1 ) {
		if(!$result1 =mysql_query( $sql1,$this->Link ))
			die("<br><br><b>La consulta:</b> [ $sql ] fall&oacute;:<br><b>".mysql_error())."</b>";
		return $result1;
	}
			
	#Libera los datos
	function Free_Data ( $result ) {
		mysql_free_result( $result );
	}
			
	#Obtiene el numero de renglones contenidas en el resultado
	function Rows_Count ( $result) {
		return (@mysql_numrows( $result ));
		// con arroba evita mandar warning si es que no existen filas en el resultado del query
	}
			
	#Obtiene el numero de renglones afectados por la ultima consulta
	function AfectedRows(){
		return mysql_affected_rows($this->Link);
	}
}
?>