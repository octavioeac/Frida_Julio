<?php
header("Content-Type: text/html;charset=utf-8");
function candel($categoria){
    require '../conexion.php';
    $salida = '<table id="elementos">';
    $query = "SELECT folio, descripcionCorta, descripcionLarga, unidad, propiedad FROM zcatalogo WHERE categoria LIKE '%".$categoria."%';";
    
    $result = mysql_query($query, $conectar2);
    $mxn = mysql_num_rows($result);
    if($mxn){
        for($i = 0; $i < $mxn; $i++){
            $dscripts = mysql_fetch_array($result);
            $original = array('"','\'','ñ','Ñ','á','é','í','ó','ú','Á','É','Í','Ó','Ú');
            $nuevo = array('&quot;','&#39;','&ntilde;','&Ntilde;','&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;');
            $dscripts['descripcionLarga'] = str_replace($original, $nuevo, $dscripts['descripcionLarga']);
            $dscripts['descripcionCorta'] = str_replace($original, $nuevo, $dscripts['descripcionCorta']);
            if($categoria == 'CANALETA/ESCALERILLA'){
                $salida .= '<tr><td class="radio"><input type="radio" id="'.$dscripts['folio'].'" class="radio" name="op" value="'.$dscripts['descripcionCorta'].'" onclick="d(\'c'.$dscripts['unidad'].'_'.$dscripts['propiedad'].'\')"/></td>
                    <td class="cont" id="-'.$dscripts['folio'].'" title="'.$dscripts['descripcionLarga'].'">'.$dscripts['descripcionCorta'].'</td>
                    <td class="unidad">'.$dscripts['unidad'].'</td>
                </tr>';
            }
            else if($categoria == 'DG'){
                $salida .= '<tr><td class="radio"><input type="radio" id="'.$dscripts['folio'].'" class="radio" name="op" value="'.$dscripts['descripcionCorta'].'" onclick="d(\'d'.$dscripts['unidad'].'_'.$dscripts['propiedad'].'\')"/></td>
                    <td class="cont" id="-'.$dscripts['folio'].'" title="'.$dscripts['descripcionLarga'].'">'.$dscripts['descripcionCorta'].'</td>
                    <td class="unidad">'.$dscripts['unidad'].'</td>
                </tr>';
            }
            else{
                $salida .= '<tr><td class="radio"><input type="radio" id="'.$dscripts['folio'].'" class="radio" name="op" value="'.$dscripts['descripcionCorta'].'" onclick="d(\'|'.$dscripts['unidad'].'_'.$dscripts['propiedad'].'\')"/></td>
                    <td class="cont" id="-'.$dscripts['folio'].'" title="'.$dscripts['descripcionLarga'].'">'.$dscripts['descripcionCorta'].'</td>
                    <td class="unidad">'.$dscripts['unidad'].'</td>
                </tr>';
            }
        }
    }
    else{
        $salida .= '<p>No existen descripciones para esta categor&iacute;a</p>';
    }
    $salida .= '</table>';
    return $salida;
}
$categoria = $_POST['categoria'];
echo candel($categoria);
?>