<?
require_once 'dbconexion.class.php';


class Equipo{
	private $db;	

	public function __construct(){
		$this->db = new Conecta('localhost','infinitum','infinitum2008','infinitum_unica');
	
	}	

	public function anilloProveedor($proveedor,$wdm){
		$sqlQuery = "SELECT wdm,ospf,proveedor_tx FROM cat_wdm WHERE tecnologia like '%WDM' 
		                    and proveedor_tx='".$proveedor."' GROUP BY wdm ORDER BY wdm ASC";
		$catWdm   = $this->db->consulta($sqlQuery);

		while($rowc = mysql_fetch_array($catWdm)){
			
			if($wdm==$rowc["wdm"]."|".$rowc["ospf"] || $rowc["wdm"]==$otroWdm) $selcd="selected";
				       else $selcd="";      
			$opc.= "<option $selcd value= '".$rowc["wdm"]."|".$rowc["ospf"]."'>".$rowc["wdm"]."/".$rowc["proveedor_tx"]."</option>";
				
		}

		return "<select name='wdm' id='wdmt' onchange='document.wdm.ido.value=\"\";
						document.wdm.idd.value=\"\";document.wdm.tipoequipo.value=\"\";
						document.wdm.flagProvee.value=\"1\";submit();'>
					<option value=''>-.SELECCIONE WDM.-</option>
					$opc
				</select>";
	}
	public function infoEquipo($id){		
		$sqlQuery = "SELECT * from cat_wdm where id='$id'";
			$result = $this->db->consulta($sqlQuery);
		return $result;
	}
	#Verificar el estatus del WDM en la tabla de ordenes y  bloquearlo
	public function estatusWdm($wd){
		$sqlQuery    = "SELECT estatus from ordenes where nombre_oficial_pisa='$wd'";

		$qestatcnswd = $this->db->consulta($sqlQuery);

		if (mysql_num_rows($qestatcnswd)>0) {
			$estatcnswd = mysql_result($qestatcnswd,0,0);
		}
		else{
			$estatcnswd = "";		}

       
		return $estatcnswd;


	}
	public function estatusNodo($wd,$id,$idd,$ido){
		$sqlQuery = "SELECT estatus from ordenes where nombre_oficial_pisa like '$wd-%' and id_tabla IN ('$id','$idd','$ido')";
		$qestatcnsnodo = $this->db->consulta($sqlQuery);
		if (mysql_num_rows($qestatcnsnodo)>0) $estatcnsnodo=mysql_result($qestatcnsnodo,0,0);
        else $estatcnsnodo="";
        return $estatcnsnodo;
	}
	public function repisa($provee,$repadm_conxadsl){

		$sqlQuery = "SELECT num_repisas
		                FROM cat_tarjetas_wdm 
				    		WHERE proveedor = '".$provee."'
				    			AND   equipo = '".$repadm_conxadsl."'";

		$repTarjeta = $this->db->consulta($sqlQuery);
		if(mysql_num_rows($repTarjeta)>0){

			$numRepisas = explode(',',@mysql_result($repTarjeta,0,0));
			for($i = 0; $i< count($numRepisas) ; $i ++){

				$opcRepisa.= "<option value = '".'0'.$numRepisas[$i]."'>".'0'.$numRepisas[$i]."</option>";
			}

		}

		return "<td><select name='repisat' title='Seleccionar la Repisa' onchange='document.wdm.tipoequipo.value='a';submit();''>
				    <option>--REPISA--</option>
				    $opcRepisa
				 </select></td>";



	}


	
}




?>