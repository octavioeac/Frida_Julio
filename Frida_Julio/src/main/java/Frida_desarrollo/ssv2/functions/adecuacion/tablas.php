<?php
header("Content-Type: text/html;charset=utf-8");
function tablas($folio,$seccion){
    require '../conexion.php';
    $tipo = array(0=>'a',1=>'b',2=>'m',3=>'d',4=>'e',5=>'f',6=>'g',7=>'h',8=>'i',9=>'j',10=>'k',11=>'l');
    $tabla = '<table id="'.$tipo[$seccion].'"><tr><td class="t" style="width:70px">C&Oacute;DIGO</td>
            <td class="t">DESCRIPCI&Oacute;N CORTA</td>
            <td class="t" style="width:70px">CANTIDAD</td>
            <td class="t" style="width:70px">UNIDAD</td>';
    if($seccion == 3){
        $tabla .= '<td class="t" style="width:70px">ANCHO</td>';
    }
    else if($seccion == 5){
        $tabla .= '<td class="t" style="width:70px">NIVEL</td>';
    }
    $tabla .= '<td class="t" style="width:16px"><img src="img/erase.png" alt="borrar"/></td>';
    
    $total = mysql_query("SELECT COUNT(id) AS totla FROM zelementos WHERE folio='".$folio."' AND seccion=".$seccion.";");
    $total = mysql_fetch_array($total, MYSQL_BOTH);
    $total = $total[0];
    if($total > 0){
        $c=1;
        $query = "SELECT zelementos.id, zelementos.codigo_catalogo, zcatalogo.descripcionCorta, 
            zcatalogo.descripcionLarga, zelementos.cantidad, zcatalogo.unidad, 
            zelementos.tipo FROM zelementos, zcatalogo 
            WHERE zelementos.folio = '".$folio."' AND zelementos.seccion = ".$seccion." 
            AND zelementos.codigo_catalogo = zcatalogo.nuevo_folio;";
        $resultset = mysql_query($query, $conectar2);
        for($i = 0; $i < mysql_num_rows($resultset); $i++){
            $data = mysql_fetch_array($resultset);
            $data['descripcionLarga'] = str_replace('"','',$data['descripcionLarga']);
            $tabla .= '<tr id="'.$tipo[$seccion].$c.'"><td>'.$data['codigo_catalogo'].'</td>
                <td title="'.$data['descripcionLarga'].'">'.$data['descripcionCorta'].'</td>
                <td>'.$data['cantidad'].'</td><td>'.$data['unidad'].'</td>';
            if($seccion == 3 || $seccion == 5){
                $tabla .= '<td>'.$data['tipo'].'</td>';
            }
            $tabla .= '<td><img class="del" src="img/erase.png" onclick="sup(\''.$tipo[$seccion].$c.'|'.$data['id'].'\')"/></td></tr>';
            $c++;
        }
        $tabla.= '</table><input type="hidden" name="c'.$tipo[$seccion].'" value="'.$c.'"/>';
    }
    return $tabla;
}
function tbdtd($folio){
    require '../conexion.php';
    $tabla = '';
    $existe = "SELECT COUNT(folio) FROM zinter_bdtd WHERE folio='".$folio."';";
    $salida = mysql_num_rows($existe,$conectar2);
    $num = mysql_num_rows($salida);
    if($num > 0){
        
    }
}
?>