<?php
include('conexion.php');

function guarda_folio ($sisa, $cliente, $proveedor, $ctrl_acceso, $entidad)
{
		$year=date("y");
		$mes=date("m");
		$sql_num=mysql_query("SELECT SUBSTRING(folio, 10, 4) AS consecutivo FROM consecutivos_ots ORDER BY consecutivo DESC");
				
		if(mysql_num_rows($sql_num)>0)
		{
			$consecutivo=mysql_result($sql_num,0,0);
			$consecutivo=$consecutivo+1;
			
			$i = 4 - strlen($consecutivo); 
			for($m = 0 ; $m < $i;$m++) 
			{ 
				$cero .= 0;
			} 
			
			$consecutivo=$cero.$consecutivo;
		}
		else  $consecutivo="0001";
		
		$folio="RDA-".$year.$mes."-".$consecutivo;
				
		//===Guarda registro
		$query_insert="INSERT INTO consecutivos_ots
		(year_act, ot, folio, referencia_sisa, cliente, direccion, ctrl_acceso, trabajo, proveedor, descripcion_trab, fecha, elaboro, observaciones, tipo_proy, entidad, estatus) VALUES 
		('".date('Y')."', '', '$folio', '$sisa', '$cliente', '$direccion', '$ctrl_acceso', '$trabajo', '$proveedor', '$descripcion', '".date('y-m-d h:i:s')."', 
		'$elaboro', '$observaciones', '$tipo_proy', '$entidad', 'GENERADA')";
			
		mysql_query($query_insert);
		
		return $folio;
		
}

?>