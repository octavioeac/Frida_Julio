<?php
include 'conexion.php';
function buscar($folio,$tipo){
    $json = array();
    $fechas = array('t' => 'fecha_programada_proveedor','p' => 'fecha_programada');
    $textos = array('t' => 'El proveedor ', 'p' => 'TELMEX ');
    $kzg = array('p' => 'fecha_programada_proveedor','t' => 'fecha_programada');
    
    $validado = mysql_query("select estatus from zsite_survey where folio = '".$folio."'");
    $validado = mysql_fetch_array($validado,MYSQL_BOTH);
    $validado = $validado[0];
    
    $json['estado'] = $validado;
    
    $fsol = mysql_query("SELECT date(".$kzg[$tipo].") FROM zsite_survey WHERE folio = '".$folio."'");
    $fsol = mysql_fetch_array($fsol,MYSQL_BOTH);
    $fsol = $fsol[0];
    $json['fecha_solicitud'] = $fsol;
	
	$hsol = mysql_query("SELECT TIME(".$kzg[$tipo].") FROM zsite_survey WHERE folio = '".$folio."'");
    $hsol = mysql_fetch_array($hsol,MYSQL_BOTH);
    $hsol = $hsol[0];
    $json['hora_solicitud'] = $hsol;
     
    $otraFecha = mysql_query("SELECT DATE(".$fechas[$tipo].") FROM zsite_survey WHERE folio = '".$folio."'");
    $otraFecha = mysql_fetch_array($otraFecha,MYSQL_BOTH);
    $otraFecha = $otraFecha[0];
    if($otraFecha == null)
        $otraFecha = $textos[$tipo].'no ha propuesto fecha';
    else{
        $otraFecha = 'La fecha que ha propuesto '.$textos[$tipo].' es para el día '.$otraFecha;
        $otraHora = mysql_query("SELECT TIME(".$fechas[$tipo].") FROM zsite_survey WHERE folio = '".$folio."'");
        $otraHora = mysql_fetch_array($otraHora,MYSQL_BOTH);
        $otraHora = $otraHora[0];
        $otraFecha .= ' a las '.$otraHora;
    }
    $json['estatus'] = $otraFecha;
    
    $punto_reunion = mysql_query("SELECT punto_reunion FROM zsite_survey WHERE folio='".$folio."'");
    $punto_reunion = mysql_fetch_array($punto_reunion,MYSQL_BOTH);
    $punto_reunion = $punto_reunion[0];
    
    $json['punto_reunion'] = $punto_reunion;
    
    if($tipo == 't'){
        $ntc_telmex="SELECT ctnombre,cttelefono,ctemail FROM zsite_survey WHERE folio='".$folio."'";
        $result_ntc_telmex = mysql_query($ntc_telmex);
        $numsz = mysql_num_rows($result_ntc_telmex);
        if($numsz > 0){
            for($c = 0; $c < $numsz; $c++){
                $dt = mysql_fetch_array($result_ntc_telmex);
                $json['n_telmex']=$dt['ctnombre'];
                $json['t_telmex']=$dt['cttelefono'];
                $json['c_telmex']=$dt['ctemail'];
            }
        }
    }
    
    return json_encode($json);
}

function guardaFecha($datos){
    /*
     0 => folio
     1 => tipo
     2 => fecha
     3 => hora
     4 => nombre telmex
     5 => telefono telmex
     6 => email telmex
     */
    $fechas = array('t' => 'fecha_programada','p' => 'fecha_programada_proveedor');
    $fechasprime = array('p' => 'fecha_programada','t' => 'fecha_programada_proveedor');
    //OBTENER FECHA DE CONTRAPARTE.
    $contraFecha = mysql_query("SELECT DATE(".$fechasprime[$datos[1]].") FROM zsite_survey WHERE folio = '".$datos[0]."'");
    $contraFecha = mysql_fetch_array($contraFecha,MYSQL_BOTH);
    $contraFecha = $contraFecha[0];
    
    $part = $contraFecha == $datos[2] ? ",estatus='POR REALIZAR'" : '';
    
    
    $update = "UPDATE zsite_survey SET ".$fechas[$datos[1]]." = '".$datos[2]." ".$datos[3]."' ".$part." WHERE folio = '".$datos[0]."'";
    mysql_query($update);
    
    if($datos[1] == 't'){
        $arr=array();
        $ntc_telmex="SELECT ctnombre,cttelefono,ctemail FROM zsite_survey WHERE folio='".$datos[0]."'";
        $result_ntc_telmex = mysql_query($ntc_telmex);
        $numsz = mysql_num_rows($result_ntc_telmex);
        if($numsz > 0){
            for($c = 0; $c < $numsz; $c++){
                $dt = mysql_fetch_array($result_ntc_telmex);
                $arr[0]=$dt['ctnombre'];
                $arr[1]=$dt['cttelefono'];
                $arr[2]=$dt['ctemail'];
            }
        }
        if($datos[6] != $arr[2]){
            $insert="INSERT INTO zccemails VALUES(id,'".$datos[0]."','".$arr[0]."','".$arr[2]."')";
            mysql_query($insert);
            
            $updatedos="UPDATE zsite_survey SET ctnombre='".$datos[4]."',cttelefono='".$datos[5]."',ctemail='".$datos[6]."' WHERE folio='".$datos[0]."'";
            mysql_query($updatedos);
        }
    }
    
    $r = 'success';
    return json_encode($r);
}
//echo buscar('SS4520140815001','t');
if($folio){
    $folio = $_POST['folio'];
    $tipo = $_POST['tipo'];
    echo buscar($folio, $tipo);
}
else if($datos){
    $datos = $_POST['datos'];
    echo guardaFecha($datos);
}
?>
