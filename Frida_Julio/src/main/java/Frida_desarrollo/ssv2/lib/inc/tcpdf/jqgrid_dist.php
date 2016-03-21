<?php
/**
 * PHP Grid Component
 *
 * @author Abu Ghufran <gridphp@gmail.com> - http://www.phpgrid.org
 * @version 1.4.7 (b2)
 * @license: see license.txt included in package
 */
 
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ini_set("display_errors","off");

class jqgrid
{
	// Par�metros del grid
	var $options = array();
	// Seleccionar la consulta para mostrar los datos
	var $select_command;
	// Nombre de la tabla de la bd utilizada para a�adir, actualizar y borrar
	var $table;
	// Acciones permitidas en el grid
	var $actions;
	// Variable de datos condicionales CSS
	var $conditional_css;
	// Mostrar error del servidor
	var $debug;
	//identificador de conexi�n a la bd - no se utiliza ahora, @todo: por la necesidad de integrar adodb lib
	var $con;
	var $db_driver;
		
	// Eventos de devoluci�n de llamada
	var $events;
	
	/**
	 *Contructor para configurar par�metros predeterminados
	 */
	function jqgrid($db_conf = null)
	{
		if (!isset($_SESSION) || !is_array($_SESSION))
			session_start();

		$this->db_driver = "mysql";
		$this->debug = 1;
		
		// Utilizar la capa de adodb para soportar bds mysql
		if ($db_conf)
		{
			// Establecer la BD
			include("adodb/adodb.inc.php");
			$driver = $db_conf["type"];
			$this->con = ADONewConnection($driver); # eg. 'mysql,oci8(for oracle),mssql,postgres,sybase' 
			$this->con->SetFetchMode(ADODB_FETCH_ASSOC);
			$this->con->debug = 0;
	
			$this->con->Connect($db_conf["server"], $db_conf["user"], $db_conf["password"], $db_conf["database"]);
	
			// Cambiar la codificaci�n de la bd - para caracteres de ascenso (si es necesario) 
			if ($db_conf["type"] == "mysql")
				$this->con->Execute("SET NAMES 'utf8'");
		
			$this->db_driver = $db_conf["type"];
		}
		$grid["datatype"] = "json";
		$grid["rowNum"] = 20;
		$grid["width"] = 500;
		$grid["height"] = 250;
		$grid["rowList"] = array(10,20,30);
		$grid["viewrecords"] = true;
		$grid["shrinkToFit"] = true;
		$grid["scrollbars"] = true;
		$grid["export"]["range"] = "filtered";
		$grid["grouping"] = true;
		$grid["groupingView"] = array(); 
  		
		$protocol = ( ($_SERVER['HTTPS'] == "on" || $_SERVER["SERVER_PORT"] == "443" ) ? "https" : "http");
		$grid["url"] = "$protocol://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
		
		// Pasar par�metros al subgrid si existe
		$s = (strstr($grid["url"], "?")) ? "&":"?";
		if (isset($_REQUEST["rowid"]) && isset($_REQUEST["subgrid"]))
			$grid["url"] .= $s."rowid=".$_REQUEST["rowid"]."&subgrid=".$_REQUEST["subgrid"];

		$grid["editurl"] = $grid["url"];
		$grid["cellurl"] = $grid["url"];
		
		// Desplazamiento virtual, para conjuntos de datos grandes
		$grid["scroll"] = 0;
		$grid["sortable"] = true;
		$grid["cellEdit"] = false;

		// Si se solicita una exportaci�n especifica
		if (isset($_GET["export_type"]) && ($_GET["export_type"] == "xlsx" || $_GET["export_type"] == "excel"))
			$grid["export"]["format"] = "excel";
		else if (isset($_GET["export_type"]) && $_GET["export_type"] == "pdf")
			$grid["export"]["format"] = "pdf";

		// Opciones de exportaci�n PDF predeterminados
		$grid["export"]["paper"] = "a4";
		$grid["export"]["orientation"] = "landscape";
		
		$grid["add_options"] = array("recreateForm" => true, "closeAfterAdd"=>true, "errorTextFormat"=> "function(r){ return r.responseText;}");																				
		$grid["edit_options"] = array("recreateForm" => true, "closeAfterEdit"=>true, "errorTextFormat"=> "function(r){ return r.responseText;}");
		$grid["delete_options"] = array("errorTextFormat"=> "function(r){ return r.responseText;}");
		
		$this->options = $grid;	
		
		$this->actions["showhidecolumns"] = false;
		$this->actions["inlineadd"] = false;
		$this->actions["search"] = "";
		$this->actions["export"] = false;
	}
	/**
	 * Funci�n de ayuda para analizar arreglo
	 */
	private function strip($value)
	{
		if(get_magic_quotes_gpc() != 0)
		{
			if(is_array($value))  
				if ( array_is_associative($value) )
				{
					foreach( $value as $k=>$v)
						$tmp_val[$k] = stripslashes($v);
					$value = $tmp_val; 
				}				
				else  
					for($j = 0; $j < sizeof($value); $j++)
						$value[$j] = stripslashes($value[$j]);
			else
				$value = stripslashes($value);
		}
		return $value;
	}	
	
	/**
	 * Busqueda Avanzada de la clausula del fabricante
	 */
	private function construct_where($s)
	{
		$qwery = "";
		//['eq','ne','lt','le','gt','ge','bw','bn','in','ni','ew','en','cn','nc']
		$qopers = array(
					  'eq'=>" = ",
					  'ne'=>" <> ",
					  'lt'=>" < ",
					  'le'=>" <= ",
					  'gt'=>" > ",
					  'ge'=>" >= ",
					  'bw'=>" LIKE ",
					  'bn'=>" NOT LIKE ",
					  'in'=>" IN ",
					  'ni'=>" NOT IN ",
					  'ew'=>" LIKE ",
					  'en'=>" NOT LIKE ",
					  'cn'=>" LIKE " ,
					  'nc'=>" NOT LIKE " );
		if ($s) {
			$jsona = json_decode($s,true);
			if(is_array($jsona))
			{
				$gopr = $jsona['groupOp'];
				$rules = $jsona['rules'];
				$i =0;
				foreach($rules as $key=>$val) 
				{
					# Nombres de los campos de la tabla para solucionar conflictos (alias utilizado en la p�gina, propiedad dbname)
					foreach($this->options["colModel"] as $link_c)
					{
						if ($val['field'] == $link_c["name"] && !empty($link_c["dbname"]))
						{
							$val['field'] = $link_c["dbname"];
							break;
						}
					}
					$field = $val['field'];
					$op = $val['op'];
					$v = $val['data'];
					if(isset($v) && isset($op))
					{
						$i++;
						// ToSql en este caso es absolutamente necesario
						$v = $this->to_sql($field,$op,$v);
			
						if ($i == 1) $qwery = " AND ";
						else $qwery .= " " .$gopr." ";
						switch ($op) {
							// si es necesaria otra cosa
							case 'in' :
							case 'ni' :
								$qwery .= $field.$qopers[$op]." (".$v.")";
								break;
							default:
								$qwery .= $field.$qopers[$op].$v;
						}
					}
				}
			}
		}
		return $qwery;
		
	}	

	/**
	 * Busqueda avanzada, hacer compatible la busqueda del operador sql 
	 */
	private function to_sql($field, $oper, $val) 
	{
		//mysql_real_escape_string es mejor
		if($oper=='bw' || $oper=='bn') return "'" . addslashes($val) . "%'";
		else if ($oper=='ew' || $oper=='en') return "'%" . addcslashes($val) . "'";
		else if ($oper=='cn' || $oper=='nc') return "'%" . addslashes($val) . "%'";
		else return "'" . addslashes($val) . "'";
	}
	
	/**
	 * Set para controlador de eventos
	 */
	function set_events($arr)
	{
		$this->events = $arr;
	}

	/**
	 * Obtener valores desplegables para seleccionar men�s desplegables
	 */	
	function get_dropdown_values($sql)
	{
		$str = array();

		$result = $this->execute_query($sql);

		if ($this->con)
		{
			$arr = $result->GetRows();
			
			foreach($arr as $rs)
				$str[] = $rs["k"].":".$rs["v"];
		}
		else
		{
			while($rs = mysql_fetch_array($result,MYSQL_ASSOC))
			{
				$str[] = $rs["k"].":".$rs["v"];
			}
		}
				
		$str = implode($str,";");
		return $str;
	}
	
	/**
	 * Setter para permitir acciones (a�adir/editar/borrar/autofiltro etc)
	 */
	function set_actions($arr)
	{
		if (empty($arr))
			$arr = array();		
			
		if (empty($this->actions))
			$this->actions = array();
			
		// Para el array add_option
		foreach($arr as $k=>$v)
			if (is_array($v))
			{
				if (!isset($this->actions[$k]))
					$this->actions[$k] = array();
					
				$arr[$k] = array_merge($arr[$k],$this->actions[$k]);
			}		
			
		$this->actions = array_merge($this->actions,$arr);
	}
	
	/**
	 * Setter para el las opciones de personalizaci�n del grid
	 */
	function set_options($options)
	{
		if (empty($arr))
			$arr = array();

		if (empty($this->options))
			$this->options = array();

		// Para la exportaci�n como matriz de fusi�n
		foreach($options as $k=>$v)
			if (is_array($v))
			{
				if (!isset($this->options[$k]))
					$this->options[$k] = array();
					
				$options[$k] = array_merge($this->options[$k],$options[$k]);
			}
			
		$this->options = array_merge($this->options,$options);
	}

	function set_conditional_css($params)
	{
		$this->conditional_css = $params;
	}

	/**
	 * Generar autom�ticamente las columnas de cuadr�cula
	 */
	function set_columns($cols = null)
	{
		if (!$this->table && !$this->select_command) die("Por favor, especifique nombre de tabla o seleccione el comando");
		
		// Si s�lo est� definida la tabla, seleccione SQL para hacerlo
		if (!$this->select_command && $this->table)
			$this->select_command = "SELECT * FROM ".$this->table;

		// Anadir clausula where si no esta presente -- fijar a la funci�n de b�squeda
		if (stristr($this->select_command,"WHERE") === false)
		{
			// Colocar por grupo en la posici�n adecuada en sql
			if (($p = stripos($this->select_command,"GROUP BY")) !== false)
			{
				$start = substr($this->select_command,0,$p);
				$end = substr($this->select_command,$p);
				$this->select_command = $start." WHERE 1=1 ".$end;
			}
			else
				$this->select_command .= " WHERE 1=1";
		}

		// Hacer una l�nea simple en sql con espacios extra
		$this->select_command = preg_replace("/(\r|\n)/"," ",$this->select_command);
		$this->select_command = preg_replace("/[ ]+/"," ",$this->select_command);

		// Obtener los nombres de columna de SQL ejecutando Nulled sql
		$sql = $this->select_command . " LIMIT 1 OFFSET 0";
		
		$sql = $this->prepare_sql($sql,$this->db_driver);
		
		$result = $this->execute_query($sql);

		if ($this->con)
		{
			$arr = $result->FetchRow();
			foreach($arr as $k=>$rs)
				$f[] = $k;
		}
		else
		{		
			$numfields = mysql_num_fields($result);
			for ($i=0; $i < $numfields; $i++) // Encabezado
			{
				$f[] = mysql_field_name($result, $i);
			}
		}
		//Si las columnas del gris no estan definidas, sql las crea
		if (!$cols)
		{
			foreach($f as $c)
			{
				$col["title"] = ucwords(str_replace("_"," ",$c));
				$col["name"] = $c;
				$col["index"] = $c;
				$col["editable"] = true;
				$col["editoptions"] = array("size"=>20);
				$g_cols[] = $col;
			}
		}
		
		if (!$cols)
			$cols = $g_cols;

		// Indice attr es imprescindible para jqGrid, para a�adir en la matriz
		for($i=0;$i<count($cols);$i++)
		{
			$cols[$i]["name"] = $cols[$i]["name"];
			$cols[$i]["index"] = $cols[$i]["name"];
			
			if (isset($cols[$i]["formatter"]) && $cols[$i]["formatter"] == "date" && empty($cols[$i]["formatoptions"]))
				$cols[$i]["formatoptions"] = array("srcformat"=>'Y-m-d',"newformat"=>'Y-m-d');
			
			if (isset($cols[$i]["formatter"]) && $cols[$i]["formatter"] == "date")
				$cols[$i]["editoptions"]["dataInit"] = "function(o){link_dtpicker(o);}";
		}

		//pr($cols);
		$this->options["colModel"] = $cols;
		foreach($cols as $c)
		{
			$this->options["colNames"][] = $c["title"];		
		}
	}

	/**
	 * Funci�n com�n para las operaciones en la bd
	 */
	function execute_query($sql,$return="")
	{
		if ($this->con)
		{
			$ret = $this->con->Execute($sql);
			if (!$ret)
			{
				if ($this->debug)
					phpgrid_error("No se pud� ejecutar la consulta. ".$this->con->ErrorMsg()." - $sql");
				else
					phpgrid_error("Algunos problemas ocurridos en esta operaci�n, Contacte al soporte t�cnico para obtener ayuda.");
			}

			if ($return == "insert_id")
				return $this->con->Insert_ID();
		}
		else
		{
			$ret = mysql_query($sql);
			if (!$ret)
			{
				if ($this->debug)
					phpgrid_error("No se pud� ejecutar la consulta.".mysql_error()." - $sql");		
				else
					phpgrid_error("Algunos problemas ocurridos en esta operaci�n, Contacte al soporte t�cnico para obtener ayuda.");			
			}

			if ($return == "insert_id")
				return mysql_insert_id();
		}

		return $ret;
	}

	/**
   	 * Generar matriz JSON para la renderizaci�n del grid
	 * @ Param $ grid_id ID �nico para la red
	 */
	function render($grid_id)
	{
		// Llamar al grid por primera vez (sin ajax), pero especificar llamadas sobre ajax
		$is_ajax = isset($_REQUEST["nd"]) || isset($_REQUEST["oper"]) || isset($_REQUEST["export"]);
		if ($is_ajax && $_REQUEST["grid_id"] != $grid_id)
			return;

		$append_by = (strpos($this->options["url"],"?") === false) ? "?" : "&";

		$this->options["url"] .= $append_by."grid_id=$grid_id";
		$this->options["editurl"] .= $append_by."grid_id=$grid_id";
		$this->options["cellurl"] .= $append_by."grid_id=$grid_id";
		
		if (isset($_REQUEST["subgrid"]))
			$grid_id .= "_".$_REQUEST["subgrid"];
			
		// Generar nombres de las columnas, si no estan definidas
		if (!$this->options["colNames"])
			$this->set_columns();

			
		// Administrar los archivos subidos
		foreach($this->options["colModel"] as $col)
		{
			if ($col["edittype"] == "file")
			{	
				$this->require_upload_ajax = 1;
				
				$this->options["add_options"]["onInitializeForm"] = "function(formid) 
											{
													jQuery(formid).attr('method','POST');
													jQuery(formid).attr('action','');
													jQuery(formid).attr('enctype','multipart/form-data');
											}";	
											
				$this->options["add_options"]["recreateForm"] = true;
																	
				$this->options["add_options"]["afterSubmit"] = "function(r,d) { 
																	ajaxFileUpload('".$col["name"]."','".$this->options["url"]."'); 
																	return [true,'','']; 
																	}";
																	
				$this->options["edit_options"]["afterSubmit"] = "function(formid) { 
																	ajaxFileUpload('".$col["name"]."','".$this->options["url"]."'); 
																	return [true,'','']; 
																	}";
				break;
			}
		}
		// Administrar los archivos subidos
		if (count($_FILES))
		{
			$files = array_keys($_FILES);
			$fileElementName = $files[0];
			
			if(!empty($_FILES[$fileElementName]['error']))
			{
				switch($_FILES[$fileElementName]['error'])
				{
					case '1':
						$error = 'El archivo subido excede la directiva upload_max_filesize en php.ini';
						break;
					case '2':
						$error = 'El archivo subido excede la directiva MAX_FILE_SIZE que se especific� en el formulario HTML';
						break;
					case '3':
						$error = 'El archivo subido fue s�lo parcialmente cargado';
						break;
					case '4':
						$error = 'El archivo no fue subido.';
						break;

					case '6':
						$error = 'Falta una carpeta temporal';
						break;
					case '7':
						$error = 'No se pudo escribir el archivo en el disco';
						break;
					case '8':
						$error = 'Carga de archivos detenido por extensi�n';
						break;
					case '999':
					default:
						$error = 'C�digo de error no disponible';
				}
			}
			elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none')
			{
				$error = 'El archivo no fue subido..';
			}
			else 
			{
				foreach($this->options["colModel"] as $col)
				{
					if ($col["edittype"] == "file" && $col["name"] == $fileElementName)
					{
						$tmp_name = $_FILES[$fileElementName]["tmp_name"];
						$name = $_FILES[$fileElementName]["name"];
						
						$uploads_dir = $col["upload_dir"];
						
						if (move_uploaded_file($tmp_name, "$uploads_dir/$name"))
							$msg = "Archivo cargado";
						else
							$error = "No se puede mover a la carpeta deseada uploads_dir $ / $ nombre ";
							
						break;
					}
				}
			}
			
			echo "{";
			echo				"error: '" . $error . "',\n";
			echo				"msg: '" . $msg . "'\n";
			echo "}";			
			die;
		}
		
		if (isset($_POST['oper']))
		{
			$op = $_POST['oper'];
			$data = $_POST;
			$id = $data['id'];
			$pk_field = $this->options["colModel"][0]["index"];
			
			// manejar operaciones CRUD en el grid
			switch($op)
			{
				case "add":
					unset($data['id']);
					unset($data['oper']);
					
					$update_str = array();

					// custom onupdate event execution
					if (!empty($this->events["on_insert"]))
					{
						$func = $this->events["on_insert"][0];
						$obj = $this->events["on_insert"][1];
						$continue = $this->events["on_insert"][2];
						
						if ($obj)
							call_user_method($func,$obj,array($pk_field => $id, "params" => &$data));
						else
							call_user_func($func,array($pk_field => $id, "params" => &$data));
						
						if (!$continue)
							break;
					}
					
					foreach($data as $k=>$v)
					{
						// remove any table alias from query - obseleted
						if (strstr($k,"::") !== false)
							list($tmp,$k) = explode("::",$k);
						$k = addslashes($k);
						$v = addslashes($v);
						$fields_str[] = "$k";
						$values_str[] = "'$v'";
					}
					
					$insert_str = "(".implode(",",$fields_str).") VALUES (".implode(",",$values_str).")";
					
					$sql = "INSERT INTO {$this->table} $insert_str";

					$insert_id = $this->execute_query($sql,"insert_id");

					// custom onupdate event execution
					if (!empty($this->events["on_after_insert"]))
					{
						$func = $this->events["on_after_insert"][0];
						$obj = $this->events["on_after_insert"][1];
						$continue = $this->events["on_after_insert"][2];
						
						if ($obj)
							call_user_method($func,$obj,array($pk_field => $insert_id, "params" => &$data));
						else
							call_user_func($func,array($pk_field => $insert_id, "params" => &$data));
						
						if (!$continue)
							break;
					}
					
					// for inline row addition, return insert id to update PK of grid (e.g. order_id#33)
					if ($id == "new_row")
						die($pk_field."#".$insert_id);
					break;
					
				case "edit":
					//pr($_POST);
					unset($data['id']);
					unset($data['oper']);
					
					$update_str = array();

					// custom onupdate event execution
					if (!empty($this->events["on_update"]))
					{
						$func = $this->events["on_update"][0];
						$obj = $this->events["on_update"][1];
						$continue = $this->events["on_update"][2];
						
						if ($obj)
							call_user_method($func,$obj,array($pk_field => $id, "params" => &$data));
						else
							call_user_func($func,array($pk_field => $id, "params" => &$data));
						
						if (!$continue)
							break;
					}

					foreach($data as $k=>$v)
					{
						// remove any table alias from query - obseleted
						if (strstr($k,"::") !== false)
							list($tmp,$k) = explode("::",$k);
							
						$k = addslashes($k);
						$v = addslashes($v);
						$update_str[] = "$k='$v'";
					}
					
					$update_str = "SET ".implode(",",$update_str);
					
					if (strstr($pk_field,"::") !== false)
					{
						$pk_field = explode("::",$pk_field);
						$pk_field = $pk_field[1];
					}

					$sql = "UPDATE {$this->table} $update_str WHERE $pk_field = '$id'";
					$this->execute_query($sql);
				break;			
				
				case "del":
					
					// obseleted
					if (strstr($pk_field,"::") !== false)
					{
						$pk_field = explode("::",$pk_field);
						$pk_field = $pk_field[1];
					}
					
					// custom onupdate event execution
					if (!empty($this->events["on_delete"]))
					{
						$func = $this->events["on_delete"][0];
						$obj = $this->events["on_delete"][1];
						$continue = $this->events["on_delete"][2];
						if ($obj)
							call_user_method($func,$obj,array($pk_field => $id));
						else
							call_user_func($func,array($pk_field => $id));
						
						if (!$continue)
							break;
					}
					
					$id = "'".implode("','",explode(",",$id))."'";
					$sql = "DELETE FROM {$this->table} WHERE $pk_field IN ($id)";

					$this->execute_query($sql);
				break;
			}
			
			die;
		}
		
		// apply search conditions (where clause)
		$wh = "";
		
		if (!isset($_REQUEST['_search']))
			$_REQUEST['_search'] = "";
		
		$searchOn = $this->strip($_REQUEST['_search']);
		if($searchOn=='true') 
		{
			$fld = $this->strip($_REQUEST['searchField']);
			
			$cols = array();
			foreach($this->options["colModel"] as $col)
				$cols[] = $col["index"];

			// quick search bar
			if (!$fld)
			{
				$searchstr = $this->strip($_REQUEST['filters']);
				$wh = $this->construct_where($searchstr);
			}
			// search popup form, simple one -- not used anymore
			else
			{
				if(in_array($fld,$cols)) 
				{	
					$fldata = $this->strip($_REQUEST['searchString']);
					$foper = $this->strip($_REQUEST['searchOper']);
					// costruct where
					$wh .= " AND ".$fld;
					switch ($foper) {					
						case "eq":
							if(is_numeric($fldata)) {
								$wh .= " = ".$fldata;
							} else {
								$wh .= " = '".$fldata."'";
							}
							break;
						case "ne":
							if(is_numeric($fldata)) {
								$wh .= " <> ".$fldata;
							} else {
								$wh .= " <> '".$fldata."'";
							}
							break;
						case "lt":
							if(is_numeric($fldata)) {
								$wh .= " < ".$fldata;
							} else {
								$wh .= " < '".$fldata."'";
							}
							break;
						case "le":
							if(is_numeric($fldata)) {
								$wh .= " <= ".$fldata;
							} else {
								$wh .= " <= '".$fldata."'";
							}
							break;
						case "gt":
							if(is_numeric($fldata)) {
								$wh .= " > ".$fldata;
							} else {
								$wh .= " > '".$fldata."'";
							}
							break;
						case "ge":
							if(is_numeric($fldata)) {
								$wh .= " >= ".$fldata;
							} else {
								$wh .= " >= '".$fldata."'";
							}
							break;
						case "ew":
							$wh .= " LIKE '%".$fldata."'";
							break;
						case "en":
							$wh .= " NOT LIKE '%".$fldata."'";
							break;
						case "cn":
							$wh .= " LIKE '%".$fldata."%'";
							break;
						case "nc":
							$wh .= " NOT LIKE '%".$fldata."%'";
							break;
						case "in":
							$wh .= " IN (".$fldata.")";
							break;
						case "ni":
							$wh .= " NOT IN (".$fldata.")";
							break;
						case "bw":
						default:
							$fldata .= "%";
							$wh .= " LIKE '".$fldata."'";
							break;
					}
				}
			}
			// setting to persist where clause in export option
			$_SESSION["jqgrid_filter"] = $wh;
		}
		elseif($searchOn=='false') 
		{
			$_SESSION["jqgrid_filter"] = '';
		}
		
		// generate main json
		if (isset($_GET['page']))
		{
			$page = $_GET['page']; // get the requested page
			$limit = $_GET['rows']; // get how many rows we want to have into the grid
			$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
			$sord = $_GET['sord']; // get the direction
			
			if(!$sidx) $sidx = 1;
			if(!$limit) $limit = 20;

			$sidx = str_replace("::",".",$sidx);
			
			// if export option is requested
			if (isset($_GET["export"]))
			{
				$arr = array();

				// by default export all
				$export_where = "";
				if ($this->options["export"]["range"] == "filtered")
					$export_where = $_SESSION["jqgrid_filter"];

				$limit_sql= "";
				if ($this->options["export"]["paged"] == "1")
				{
					$offset = $limit*$page - $limit; // do not put $limit*($page - 1)
					if ($offset<0) $offset = 0;
					$limit_sql = "LIMIT $limit OFFSET $offset";
				}
				
				if (($p = stripos($this->select_command,"GROUP BY")) !== false)
				{
					$start = substr($this->select_command,0,$p);
					$end = substr($this->select_command,$p);
					$SQL = $start.$export_where.$end." ORDER BY $sidx $sord $limit_sql";
				}
				else
					$SQL = $this->select_command.$export_where." ORDER BY $sidx $sord $limit_sql";

				$result = $this->execute_query($SQL);

				// export only selected columns
				$cols_not_to_export = array();
				if ($this->options["colModel"])
				{
					foreach ($this->options["colModel"] as $c)
						if ($c["export"] === false)
							$cols_not_to_export[] = $c["name"];
				}
				
				foreach ($this->options["colModel"] as $c)
					$header[$c["name"]] = $c["title"];
				$arr[] = $header;
				
				if ($this->con)
					$arr = $result->GetRows();
				else
				{
					while($row = mysql_fetch_array($result,MYSQL_ASSOC))
					{
						foreach($header as $k=>$v)
							$export_data[$k] = $row[$k];
							
						$arr[] = $export_data;
					}
				}

				if (!empty($cols_not_to_export))
				{
					$export_arr = array();
					foreach($arr as $arr_item)
					{
						foreach($arr_item as $k=>$i)
						{						
							if (in_array($k, $cols_not_to_export))
							{
								unset($arr_item[$k]);
							}
						}
						$export_arr[] = $arr_item;
					}	
					$arr = $export_arr;
				}
				
				if (!$this->options["export"]["filename"])
					$this->options["export"]["filename"] = $grid_id;
					
				if (!$this->options["export"]["sheetname"])
					$this->options["export"]["sheetname"] = ucwords($grid_id). " Sheet";
					
				if ($this->options["export"]["format"] == "pdf")
				{
					$html = "";
					
					// if customized pdf render is defined, use that
					if (!empty($this->events["on_render_pdf"]))
					{	
						$func = $this->events["on_render_pdf"][0];
						$obj = $this->events["on_render_pdf"][1];
						if ($obj)
							$html = call_user_method($func,$obj,array("grid" => $this, "data" => $arr));
						else
							$html = call_user_func($func,array("grid" => $this, "data" => $arr));
					}
					else
					{
						$html .= "<h1>".$this->options["export"]["heading"]."</h1>";
						$html .= '<table border="1" cellpadding="4" cellspacing="0">';
						
						$i = 0;
						foreach($arr as $v)
						{
							$shade = ($i++ % 2) ? 'bgcolor="#efefef"' : '';
							$html .= "<tr>";
							foreach($v as $d)
							{
								// bold header
								if  ($i == 1)
									$html .= "<td bgcolor=\"blue\"><strong>$d</strong></td>";
								else
									$html .= "<td $shade>$d</td>";
							}
							$html .= "</tr>";
						}
						$html .= "</table>";
					}

					$html = utf8_encode($html);

					$orientation = $this->options["export"]["orientation"];
					if ($orientation == "landscape")
						$orientation = "L";
					else
						$orientation = "P";

					$paper = $this->options["export"]["paper"];

					// Using opensource TCPdf lib
					// for more options visit http://www.tcpdf.org/examples.php

					require_once('tcpdf/config/lang/eng.php');
					require_once('tcpdf/tcpdf.php');

					// create new PDF document
					$pdf = new TCPDF($orientation, PDF_UNIT, $paper, true, 'UTF-8', false);

					// set document information
					$pdf->SetCreator("www.phpgrid.org");
					$pdf->SetAuthor('www.phpgrid.org');
					$pdf->SetTitle('TCPDF Example 002');
					$pdf->SetSubject($this->options["caption"]);
					$pdf->SetKeywords('www.phpgrid.org');

					// remove default header/footer
					$pdf->setPrintHeader(false);
					$pdf->setPrintFooter(false);

					// set default monospaced font
					$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
					$pdf->setFontSubsetting(false);

					//set margins
					$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

					//set auto page breaks
					$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

					//set image scale factor
					$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

					// set some language dependent data:

					// lines for rtl pdf generation
					if ($this->options["direction"] == "rtl")
					{
						$lg = Array();
						$lg['a_meta_charset'] = 'UTF-8';
						$lg['a_meta_dir'] = 'rtl';
						$lg['a_meta_language'] = 'fa';
						$lg['w_page'] = 'page';
					}
					$pdf->setLanguageArray($lg);

					// To set your custom font
					// $fontname = $pdf->addTTFfont('/path-to-font/DejaVuSans.ttf', 'TrueTypeUnicode', '', 32);

					// set font http://www.tcexam.org/doc/code/classTCPDF.html#afd56e360c43553830d543323e81bc045
					$pdf->SetFont('helvetica', '', 12);

					// add a page
					$pdf->AddPage();

					// output the HTML content
					$pdf->writeHTML($html, true, false, true, false, '');

					//Close and output PDF document
					$pdf->Output($this->options["export"]["filename"].".pdf", 'I');
					die;
				}
				else
				{
					$html = "";
					$html .= "<table border='0' cellpadding='2' cellspacing='2'>";
					$i = 0;
					foreach($arr as $v)
					{
						$html .= "<tr>";
						foreach($v as $d)
							$html .= "<td>$d</td>";
						$html .= "</tr>";
					}
					$html .= "<table>";

					// Convert to UTF-16LE
					$output = mb_convert_encoding($html, 'UTF-16LE', 'UTF-8'); 

					// Prepend BOM
					$output = "\xFF\xFE" . $output;

					header('Pragma: public');
					header("Content-type: application/x-msexcel"); 
					header('Content-Disposition: attachment;  filename="'.$this->options["export"]["filename"].'.xls"');

					echo $output;	
				}
				die;
			}
			
			// make count query
			if (($p = stripos($this->select_command,"GROUP BY")) !== false)
			{
				$sql_count = preg_replace("/SELECT (.*) FROM/i","SELECT 1 as c FROM",$this->select_command);
				$p = stripos($sql_count,"GROUP BY");
				$start_q = substr($sql_count,0,$p);
				$end_q = substr($sql_count,$p);
				$sql_count = "SELECT count(*) as c FROM ($start_q $wh $end_q) o";
			}
			else
			{
				$sql_count = $this->select_command.$wh;
				$sql_count = "SELECT count(*) as c FROM (".$sql_count.") table_count";
			}
			# print_r($sql_count);
			$result = $this->execute_query($sql_count);

			if ($this->con)
			{
				$row = $result->FetchRow();
			}
			else
			{
				$row = mysql_fetch_array($result,MYSQL_ASSOC);
			}

			$count = $row['c'];
			
			// fix for oracle, alias in capitals
			if (empty($count)) 
				$count = $row['C'];

			if( $count > 0 ) {
				$total_pages = ceil($count/$limit);
			} else {
				$total_pages = 0;
			}

			if ($page > $total_pages) $page=$total_pages;
			$start = $limit*$page - $limit; // do not put $limit*($page - 1)
			if ($start<0) $start = 0;
	
			$responce = new stdClass();
			$responce->page = $page;
			$responce->total = $total_pages;
			$responce->records = $count;

			if (($p = stripos($this->select_command,"GROUP BY")) !== false)
			{
				$start_q = substr($this->select_command,0,$p);
				$end_q = substr($this->select_command,$p);
				$SQL = "$start_q $wh $end_q ORDER BY $sidx $sord LIMIT $limit OFFSET $start";
			}
			else
			{
				$SQL = $this->select_command.$wh." ORDER BY $sidx $sord LIMIT $limit OFFSET $start";
			}

			$SQL = $this->prepare_sql($SQL,$this->db_driver);
			
			$result = $this->execute_query($SQL);

			if ($this->con)
			{
				$rows = $result->GetRows();
				
				// simulate artificial paging for mssql
				if (count($rows) > $limit)
					$rows = array_slice($rows,count($rows) - $limit);
			}
			else
			{
				$rows = array();
				while($row = mysql_fetch_array($result,MYSQL_ASSOC))
					$rows[] = $row;
			}

			// custom on_data_display event execution
			if (!empty($this->events["on_data_display"]))
			{
				$func = $this->events["on_data_display"][0];
				$obj = $this->events["on_data_display"][1];
				$continue = $this->events["on_data_display"][2];
				
				if ($obj)
					call_user_method($func,$obj,array("params" => &$rows));
				else
					call_user_func($func,array("params" => &$rows));
				
				if (!$continue)
					break;
			}
			
			foreach ($rows as $row)	
			{
				// apply php level formatter for image url 30.12.10
				foreach($this->options["colModel"] as $c)
				{
					$col_name = $c["name"];
					
					if (isset($c["default"]) && !isset($row[$col_name]))
						$row[$col_name] = $c["default"];

					// link data in grid to any given url
					if (!empty($c["default"]))
					{
						// replace any param in link e.g. http://domain.com?id={id} given that, there is a $col["name"] = "id" exist
						foreach($this->options["colModel"] as $link_c)
						{
							$link_col_key = str_replace(".","::",$link_c["name"]);
							$link_row_data = urlencode($row[$link_col_key]);
							$c["default"] = str_replace("{".$link_c["name"]."}", $link_row_data, $c["default"]);
						}

						$r = true;
						if (!empty($c["condition"]))
							eval("\$r = ".$c["condition"].";");

						$row[$col_name] = ( $r ? $c["default"] : '');						
					}
					
					// link data in grid to any given url
					if (!empty($c["link"]))
					{
						// replace any param in link e.g. http://domain.com?id={id} given that, there is a $col["name"] = "id" exist
						foreach($this->options["colModel"] as $link_c)
						{
							$link_col_key = str_replace(".","::",$link_c["name"]);
							$link_row_data = urlencode($row[$link_col_key]);
							$c["link"] = str_replace("{".$link_c["name"]."}", $link_row_data, $c["link"]);
						}
						
						if (!empty($c["linkoptions"]))
							$attr = $c["linkoptions"];

						$row[$col_name] = "<a $attr href='{$c["link"]}'>{$row[$col_name]}</a>";
					}

					// render row data as "src" value of <img> tag
					if (isset($c["formatter"]) && $c["formatter"] == "image")
					{
						$attr = array();
						foreach($c["formatoptions"] as $k=>$v)
							$attr[] = "$k='$v'";
						
						$attr = implode(" ",$attr);
						$row[$col_name] = "<img $attr src='".$row[$col_name] ."'>";
					}
						
					// show masked data in password
					if (isset($c["formatter"]) && $c["formatter"] == "password")
						$row[$col_name] = "*****";
										
				}

				foreach($row as $k=>$r)
					$row[$k] = stripslashes($row[$k]);

				$responce->rows[] = $row;
			}
			
			echo json_encode($responce);
			die;
		}		
		
		// few overides - pagination fixes
		$this->options["pager"] = '#'.$grid_id."_pager";
		$this->options["jsonReader"] = array("repeatitems" => false, "id" => "0");

		// allow/disallow edit,del operations
		if ( ($this->actions["edit"] === false && $this->actions["delete"] === false) || $this->options["cellEdit"] === true)
			$this->actions["rowactions"] = false;
			
		if ($this->actions["rowactions"] !== false)
		{
			// CRUD operation column
			$f = false;
			$defined = false;
			foreach($this->options["colModel"] as &$c)
			{
				if ($c["name"] == "act")
				{
					$defined = &$c;
				}
					
				if (!empty($c["width"]))
				{
					$f = true;
				}
			}
			
			// width adjustment for row actions column
			if ($f)
				$action_column = array("name"=>"act", "align"=>"center", "index"=>"act", "width"=>"40", "sortable"=>false, "search"=>false);
			else
				$action_column = array("name"=>"act", "align"=>"center", "index"=>"act", "width"=>"60", "sortable"=>false, "search"=>false);

			if (!$defined)
			{
				$this->options["colNames"][] = "Acciones";
				$this->options["colModel"][] = $action_column;
			}
			else
				$defined = array_merge($action_column,$defined);
		}		

		$out = json_encode_jsfunc($this->options);
		$out = substr($out,0,strlen($out)-1);

		// create Edit/Delete - Save/Cancel column in grid
		if ($this->actions["rowactions"] !== false)
		{
			$edit_link = "";
			if ($this->actions["edit"] !== false)
				$edit_link = "<a title=\"Edit this row\" href=\"javascript:void(0);\" onclick=\"jQuery(\'#$grid_id\').editRow(\''+cl+'\',true); jQuery(this).parent().hide(); jQuery(this).parent().next().show(); \">Editar</a>";

			$del_link = "";
			if ($this->actions["delete"] !== false)
				$del_link = "<a title=\"Delete this row\" href=\"javascript:void(0);\" onclick=\"jQuery(\'#$grid_id\').delGridRow(\''+cl+'\'); \">Eliminar</a>";

			if ($this->actions["edit"] !== false && $this->actions["delete"] !== false)
				$edit_link .= " | ";

			$out .= ",'gridComplete': function(){
						var ids = jQuery('#$grid_id').jqGrid('getDataIDs');
						for(var i=0;i < ids.length;i++){
							var cl = ids[i];
							
							be = '$edit_link'; 
							de = '$del_link';
							
							se = ' <a title=\"Save this row\" href=\"javascript:void(0);\" onclick=\"if (jQuery(\'#$grid_id\').saveRow(\''+cl+'\')) { jQuery(this).parent().hide(); jQuery(this).parent().prev().show(); }\">Guardar</a>'; 
							ce = ' | <a title=\"Restore this row\" href=\"javascript:void(0);\" onclick=\"jQuery(\'#$grid_id\').restoreRow(\''+cl+'\'); jQuery(this).parent().hide(); jQuery(this).parent().prev().show();\">Cancelar</a>'; 
							
							if (ids[i] == 'new_row')
							{
								se = ' <a title=\"Save this row\" href=\"javascript:void(0);\" onclick=\"jQuery(\'#{$grid_id}_ilsave\').click(); \">Guardar</a>'; 
								ce = ' | <a title=\"Restore this row\" href=\"javascript:void(0);\" onclick=\"jQuery(\'#{$grid_id}_ilcancel\').click(); jQuery(this).parent().hide(); jQuery(this).parent().prev().show();\">Cancelar</a>'; 
								jQuery('#$grid_id').jqGrid('setRowData',ids[i],{act:'<span style=display:none id=\"edit_row_{$grid_id}_'+cl+'\">'+be+de+'</span>'+'<span id=\"save_row_{$grid_id}_'+cl+'\">'+se+ce+'</span>'});
							}
							else
							jQuery('#$grid_id').jqGrid('setRowData',ids[i],{act:'<span id=\"edit_row_{$grid_id}_'+cl+'\">'+be+de+'</span>'+'<span style=display:none id=\"save_row_{$grid_id}_'+cl+'\">'+se+ce+'</span>'});
						}	
					}";

			/*
			// theme buttons -- not looking good
			$out .= ",'gridComplete': function(){
						var ids = jQuery('#$grid_id').jqGrid('getDataIDs');
						for(var i=0;i < ids.length;i++){
							var cl = ids[i];
							be = ' <a style=\"padding:0 0.5em;padding-left:1.6em;font-weight:normal;\" class=\"fm-button fm-button-icon-left ui-state-default ui-corner-all\" title=\"Edit this row\" onclick=\"jQuery(\'#$grid_id\').editRow('+cl+',true); jQuery(this).parent().hide(); jQuery(this).parent().next().show(); \">Edit <span class=\"ui-icon ui-icon-pencil\"></span></a>'; 
							de = ' <a style=\"padding:0 0.5em;padding-left:1.6em;font-weight:normal;\" class=\"fm-button fm-button-icon-left ui-state-default ui-corner-all\" title=\"Delete this row\" onclick=\"jQuery(\'#$grid_id\').delRowData('+cl+'); \">Delete <span class=\"ui-icon ui-icon-close\"></span></a>';

							se = ' <a style=\"padding:0 0.5em;padding-left:1.6em;font-weight:normal;\" class=\"fm-button fm-button-icon-left ui-state-default ui-corner-all\" title=\"Save this row\" onclick=\"jQuery(\'#$grid_id\').saveRow('+cl+'); jQuery(this).parent().hide(); jQuery(this).parent().prev().show();\">Save <span class=\"ui-icon ui-icon-disk\"></span></a>'; 
							ce = ' <a style=\"padding:0 0.5em;padding-left:1.6em;font-weight:normal;\" class=\"fm-button fm-button-icon-left ui-state-default ui-corner-all\" title=\"Restore this row\" href=\"javascript:void(0);\" onclick=\"jQuery(\'#$grid_id\').restoreRow('+cl+'); jQuery(this).parent().hide(); jQuery(this).parent().prev().show();\">Cancel <span class=\"ui-icon ui-icon-cancel\"></span></a>'; 
							
							jQuery('#$grid_id').jqGrid('setRowData',ids[i],{act:'<div style=\"white-space:nowrap;float:left\" id=\"edit_row_'+cl+'\">'+be+de+'</div>'+'<div style=\"white-space:nowrap;float:left;display:none;\" id=\"save_row_'+cl+'\">'+se+ce+'</div>'});
						}	
					}";
			*/
		}					
		
		// double click editing option
		if ($this->actions["edit"] !== false && $this->options["cellEdit"] !== true)
		{
			$out .= ",'ondblClickRow':function(id)
						{
							if(id && id!==lastSel){ 
								jQuery('#$grid_id').restoreRow(lastSel); 
								
								// disabled previously edit icons
								jQuery('#edit_row_{$grid_id}_'+lastSel).show();
								jQuery('#save_row_{$grid_id}_'+lastSel).hide();								
								
								lastSel=id; 								
							}
							
							jQuery('#$grid_id').editRow(id, true, function(){}, function(){
																					jQuery('#edit_row_{$grid_id}_'+id).show();
																					jQuery('#save_row_{$grid_id}_'+id).hide();
																					return true;
																				},null,null,function(){
																				
																				// force reload grid after inline save
																				// jQuery('#$grid_id').jqGrid().trigger('reloadGrid');
																				
																				},null,
																				function(){
																					jQuery('#edit_row_{$grid_id}_'+id).show();
																					jQuery('#save_row_{$grid_id}_'+id).hide();
																					return true;
																				}
														); 
							
							jQuery('#edit_row_{$grid_id}_'+id).hide();
							jQuery('#save_row_{$grid_id}_'+id).show();
						}";
		}
		
		// if subgrid is there, enable subgrid feature
		if (isset($this->options["subgridurl"]) && $this->options["subgridurl"] != '') 
		{
			// we pass two parameters
			// subgrid_id is a id of the div tag created within a table
			// the row_id is the id of the row
			// If we want to pass additional parameters to the url we can use
			// the method getRowData(row_id) - which returns associative array in type name-value
			// here we can easy construct the following
					
			$pass_params = "false";
			if (!empty($this->options["subgridparams"]))
				$pass_params = "true";
				
			$out .= ",'subGridRowExpanded': function(subgridid, id) 
											{ 
												var data = {subgrid:subgridid, rowid:id};
												
												if('$pass_params' == 'true') {
													var anm= '".$this->options["subgridparams"]."';
													anm = anm.split(',');
													var rd = jQuery('#".$grid_id."').jqGrid('getRowData', id);
													if(rd) {
														for(var i=0; i<anm.length; i++) {
															if(rd[anm[i]]) {
																data[anm[i]] = rd[anm[i]];
															}
														}
													}
												}
												jQuery('#'+jQuery.jgrid.jqID(subgridid)).load('".$this->options["subgridurl"]."',data);
											}";				
		}

		// on error
		$out .= ",'loadError': function(xhr,status, err) { 
					try 
					{
						jQuery.jgrid.info_dialog(jQuery.jgrid.errors.errcap,'<div class=\"ui-state-error\">'+ xhr.responseText +'</div>', 
													jQuery.jgrid.edit.bClose,{buttonalign:'right'});
					} 
					catch(e) { alert(xhr.responseText);}
				}
				";
			
		// on row selection operation
		$out .= ",'onSelectRow': function(ids) { ";
				if (isset($this->options["detail_grid_id"]) && $this->options["detail_grid_id"] != '') 
				{		
					$detail_grid_id	= $this->options["detail_grid_id"];
					$detail_url= "?grid_id=". $this->options["detail_grid_id"];

					$out .= "
	
					if(ids == null) 
					{
						ids=0;
						if(jQuery('#".$detail_grid_id."').jqGrid('getGridParam','records') >0 )
						{
							jQuery('#".$detail_grid_id."').jqGrid('setGridParam',{url:'".$detail_url."&id='+ids,page:1});
							jQuery('#".$detail_grid_id."').trigger('reloadGrid');
						}
					} 
					else 
					{
						jQuery('#".$detail_grid_id."').jqGrid('setGridParam',{url:'".$detail_url."&id='+ids,page:1});
						jQuery('#".$detail_grid_id."').trigger('reloadGrid');			
					}
					";
				};	
		// closing of select row events
		$out .= "}";

		// on row selection operation
		$out .= ",'loadComplete': function(ids) { ";
		$out .= "if(ids.rows) jQuery.each(ids.rows,function(i){";

				if (count($this->conditional_css))
				{
					foreach ($this->conditional_css as $value) 
					{
						if ($value["op"] == "cn")
						{
							$out .= "
								if (this.{$value[column]}.toLowerCase().indexOf('{$value[value]}'.toLowerCase()) != -1)
							 	{
							 		jQuery('tr.jqgrow:eq('+i+')').removeClass('ui-widget-content').css({{$value[css]}});
							 	}";
						}
						else if ($value["op"] == "eq")
						{
							$out .= "
								if (this.{$value[column]}.toLowerCase() == '{$value[value]}'.toLowerCase())
							 	{
							 		jQuery('tr.jqgrow:eq('+i+')').removeClass('ui-widget-content').css({{$value[css]}});
							 	}";
						}
					}
				}
		$out .= "});";

		// closing of select row events
		$out .= "}";
		
		// closing of param list
		$out .= "}";
		
		// Geneate HTML/JS code
		ob_start();
		?>
			<table id="<?php echo $grid_id?>"></table> 
			<div id="<?php echo $grid_id."_pager"?>"></div> 

			<script>
			jQuery(document).ready(function(){
				<?php echo $this->render_js($grid_id,$out);?>
			});	
			</script>	
		<?php
		return ob_get_clean();
	}
	
	/**
	 * JS code related to grid rendering
	 */
	function render_js($grid_id,$out)
	{
	?>
		var lastSel;
		
		var grid_<?php echo $grid_id?> = jQuery("#<?php echo $grid_id?>").jqGrid(<?php echo $out?>);
		
		jQuery("#<?php echo $grid_id?>").jqGrid('navGrid','#<?php echo $grid_id."_pager"?>',
				{
					edit: <?php echo ($this->actions["edit"] === false)?"false":"true"?>,
					add: <?php echo ($this->actions["add"] === false)?"false":"true"?>,
					del: <?php echo ($this->actions["delete"] === false)?"false":"true"?>
				},
				<?php echo json_encode_jsfunc($this->options["edit_options"])?>,
				<?php echo json_encode_jsfunc($this->options["add_options"])?>,
				<?php echo json_encode_jsfunc($this->options["delete_options"])?>,
				{
					multipleSearch:<?php echo ($this->actions["search"] == "advance")?"true":"false"?>, 
					sopt:['eq','ne','lt','le','gt','ge','bw','bn','in','ni','ew','en','cn','nc','nu','nn']
				}
				);
		
				
		<?php if ($this->actions["inlineadd"] !== false) { ?>
		jQuery('#<?php echo $grid_id?>').jqGrid('inlineNav','#<?php echo $grid_id."_pager"?>',{"addtext":"Inline","edit":false,"save":true,"cancel":true,
		"addParams":{"aftersavefunc":function (id, res)
		{
			// set returned pk in new row of grid
			res = res.responseText.split("#");
			try {
				$(this).jqGrid('setCell', id, res[0], res[1]);
				$("#"+id, "#"+this.p.id).removeClass("jqgrid-new-row").attr("id",res[1] );
			} catch (asr) {}
			
			// but reload grid, to work properly
			jQuery('#<?php echo $grid_id?>').trigger("reloadGrid",[{page:1}]);
		}},"editParams":{"aftersavefunc":function (id, res)
		{
			// set returned pk in new row of grid
			res = res.responseText.split("#");
			try {
				$(this).jqGrid('setCell', id, res[0], res[1]);
				$("#"+id, "#"+this.p.id).removeClass("jqgrid-new-row").attr("id",res[1] );
			} catch (asr) {}

			// but reload grid, to work properly			
			jQuery('#<?php echo $grid_id?>').trigger("reloadGrid",[{page:1}]);
		}}});
		<?php } ?>
			
		<?php if ($this->actions["autofilter"] !== false) { ?>
		// auto filter
		jQuery("#<?php echo $grid_id?>").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false}); 
		<?php } ?>

		<?php if ($this->actions["showhidecolumns"] !== false) { ?>
		// show/hide columns
		jQuery("#<?php echo $grid_id?>").jqGrid('navButtonAdd',"#<?php echo $grid_id."_pager"?>",{caption:"Columnas",title:"Ocultar/Mostrar Columnas", buttonicon :'ui-icon-note',
			onClickButton:function(){
				jQuery("#<?php echo $grid_id?>").jqGrid('setColumns'); 
			} 
		});
		<?php } ?>
		
		<?php if ($this->actions["export"] === true) { $order_by = "&sidx=".$this->options["sortname"]."&sord=".$this->options["sortorder"]; ?>
		// Export to what is defined in file
		jQuery("#<?php echo $grid_id?>").jqGrid('navButtonAdd',"#<?php echo $grid_id."_pager"?>",{caption:"Exportar",title:"Exportar a Excel", buttonicon :'ui-icon-extlink',
			onClickButton:function(){
				if ("<?php echo $this->options["url"]?>".indexOf("?") != -1)
					location.href = "<?php echo $this->options["url"]?>" + "&export=1&page=1<?php echo $order_by?>";
				else
					location.href = "<?php echo $this->options["url"]?>" + "?export=1&page=1<?php echo $order_by?>";
			} 
		});
		<?php } ?>
			
		<?php if (isset($this->actions["export_excel"]) && $this->actions["export_excel"] === true) { ?>
		// Export to excel
		jQuery("#<?php echo $grid_id?>").jqGrid('navButtonAdd',"#<?php echo $grid_id."_pager"?>",{caption:"Excel",title:"Export to Excel", buttonicon :'ui-icon-extlink',
			onClickButton:function(){
				if ("<?php echo $this->options["url"]?>".indexOf("?") != -1)
					location.href = "<?php echo $this->options["url"]?>" + "&export=1&page=1&export_type=excel<?php echo $order_by?>";
				else
					location.href = "<?php echo $this->options["url"]?>" + "?export=1&page=1&export_type=excel<?php echo $order_by?>";
			} 
		});
		<?php } ?>
			
		<?php if (isset($this->actions["export_pdf"]) && $this->actions["export_pdf"] === true) { ?>
		// Export to pdf
		jQuery("#<?php echo $grid_id?>").jqGrid('navButtonAdd',"#<?php echo $grid_id."_pager"?>",{caption:"PDF",title:"Export to PDF", buttonicon :'ui-icon-extlink',
			onClickButton:function(){
				if ("<?php echo $this->options["url"]?>".indexOf("?") != -1)
					location.href = "<?php echo $this->options["url"]?>" + "&export=1&page=1&export_type=pdf<?php echo $order_by?>";
				else
					location.href = "<?php echo $this->options["url"]?>" + "?export=1&page=1&export_type=pdf<?php echo $order_by?>";
			} 
		});		
		<?php } ?>
				
		function link_dtpicker(el)
		{
				setTimeout(function(){
					if(jQuery.ui) 
					{ 
						if(jQuery.ui.datepicker) 
						{ 
							jQuery(el).after('<button>Calendar</button>').next().button({icons:{primary: 'ui-icon-calendar'}, text:false}).css({'font-size':'69%'}).click(function(e){jQuery(el).datepicker('show');return false;});
							jQuery(el).datepicker({"disabled":false,"dateFormat":"yy-mm-dd"});
							jQuery('.ui-datepicker').css({'font-size':'69%'});
						} 
					}
				},100);
		}
		
		<?php if ($this->require_upload_ajax) { ?>
		function ajaxFileUpload(field,upload_url)
		{
			//starting setting some animation when the ajax starts and completes
			jQuery("#loading")
			.ajaxStart(function(){
				jQuery(this).show();
			})
			.ajaxComplete(function(){
				jQuery(this).hide();
			});
			
			/*
			prepareing ajax file upload
			url: the url of script file handling the uploaded files
						fileElementId: the file type of input element id and it will be the index of  $_FILES Array()
			dataType: it support json, xml
			secureuri:use secure protocol
			success: call back function when the ajax complete
			error: callback function when the ajax failed
			*/
			jQuery.ajaxFileUpload
			(
				{
					url:upload_url, 
					secureuri:false,
					fileElementId:field,
					dataType: 'json',
					success: function (data, status)
					{
						if(typeof(data.error) != 'undefined')
						{
							if(data.error != '')
							{
								alert(data.error);
							}else
							{
								alert(data.msg);
							}
						}
					},
					error: function (data, status, e)
					{
						alert(e);
					}
				}
			)
			return false;
		}  	
		<?php } ?>
		
		jQuery("#<?php echo $grid_id?>").jqGrid('gridResize',{});
		jQuery("#<?php echo $grid_id?>").jqGrid('setFrozenColumns');		
	<?php
	}

	function prepare_sql($sql,$db)
	{
		if (strpos($db,"mssql") !== false)
		{
			$sql = preg_replace("/SELECT (.*) LIMIT ([0-9]+) OFFSET ([0-9]+)/i","select top ($2+$3) $1",$sql);
			#pr($sql,1);
		}
		else if (strpos($db,"oci8") !== false)
		{
			$sql = preg_match("/(.*) LIMIT ([0-9]+) OFFSET ([0-9]+)/i",$sql,$matches);
		
			$query = $matches[1];
			$limit = $matches[2];
			$offest = $matches[3];

			$offset_min = $offest;
			$offset_max = $offest + $limit;
			
			$sql = "
				SELECT *
				FROM ($query) a
				WHERE rownum BETWEEN $offset_min AND $offset_max
			";			
		}
		return $sql;
	}
}

# In PHP 5.2 or higher we don't need to bring this in
if (!function_exists('json_encode')) 
{
	require_once 'JSON.php';
	function json_encode($arg)
	{
		global $services_json;
		if (!isset($services_json)) {
			$services_json = new Services_JSON();
		}
		return $services_json->encode($arg);
	}

	function json_decode($arg)
	{
		global $services_json;
		if (!isset($services_json)) {
			$services_json = new Services_JSON();
		}
		return $services_json->decode($arg);
	}
}

/**
 * Common function to display errors
 */
if (!function_exists('phpgrid_error'))
{
	function phpgrid_error($msg)	
	{
		header('HTTP/1.1 500 Internal Server Error');
		die($msg);	
	}
}

/**
 * Internal debug function
 */
if (!function_exists('phpgrid_pr'))
{
	function phpgrid_pr($arr, $exit=0)
	{
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
		
		if ($exit)
			die;
	}
}

/**
 * Function to encode JS function reference from PHP array
 * http://www.php.net/manual/en/function.json-encode.php#105749
 */
function json_encode_jsfunc($input=array(), $funcs=array(), $level=0)
{
	foreach($input as $key=>$value)
	{
		if (is_array($value))
		{
			$ret = json_encode_jsfunc($value, $funcs, 1);
			$input[$key]=$ret[0];
			$funcs=$ret[1];
		}
		else
		{
			if (substr($value,0,8)=='function')
			{
				$func_key="#".uniqid()."#";
				$funcs[$func_key]=$value;
				$input[$key]=$func_key;
			}
		}
	}
  	if ($level==1)
	{
		return array($input, $funcs);
	}
  	else
	{
		$input_json = json_encode($input);
	  	foreach($funcs as $key=>$value)
		{
			$input_json = str_replace('"'.$key.'"', $value, $input_json);
		}
	  	return $input_json;
	}
}