<?php
header("Content-Type: text/html;charset=utf-8");
function dsitio($dac){
    $dac = (int)$dac;
    $dates = ''; $indice;
    $original = array('&deg;','&ntilde;','&Ntilde;');
    $nuevo = array('°','ñ','Ñ');
    require 'conexion.php';
    //$part = explode('|', $dac);
    $query = "SELECT edificio,clli_edif,calle,num_ext,localidad,municipio,edo,c_p,latitud,longitud,siglas4 FROM centrales WHERE id_ctl = ".$dac;
    $datos = mysql_query($query);
    $max = mysql_num_rows($datos);
    if($max > 0){
        for($d = 0; $d < $max; $d++){
            $data = mysql_fetch_array($datos);
            if($data['edificio'] != '' || $data['edificio'] != NULL){
                $data['edificio'] = str_replace($original, $nuevo, $data['edificio']);
                $dates .= $data['edificio'].'+';
            }
            else{
                $dates .= 'N/A+';
            }
            if($data['clli_edif'] != '' || $data['clli_edif'] != NULL){
                $data['clli_edif'] = str_replace($original, $nuevo, $data['clli_edif']);
                $dates .= $data['clli_edif'].'+';
            }
            else{
                $dates .= 'N/A+';
            }
            if($data['calle'] != '' || $data['calle'] != NULL){
                $data['calle'] = str_replace($original, $nuevo, $data['calle']);
                $dates .= $data['calle'].'+';
            }
            else{
                $dates .= 'N/A+';
            }
            if($data['num_ext'] != '' || $data['num_ext'] != NULL){
                $data['num_ext'] = str_replace($original, $nuevo, $data['num_ext']);
                $dates .= $data['num_ext'].'+';
            }
            else{
                $dates .= 'N/A+';
            }
            if($data['localidad'] != '' || $data['localidad'] != NULL){
                $data['localidad'] = str_replace($original, $nuevo, $data['localidad']);
                $dates .= $data['localidad'].'+';
            }
            else{
                $dates .= 'N/A+';
            }
            if($data['municipio'] != '' || $data['municipio'] != NULL){
                $data['municipio'] = str_replace($original, $nuevo, $data['municipio']);
                $dates .= $data['municipio'].'+';
            }
            else{
                $dates .= 'N/A+';
            }
            if($data['edo'] != '' || $data['edo'] != NULL){
                $data['edo'] = str_replace($original, $nuevo, $data['edo']);
                $dates .= $data['edo'].'+';
            }
            else{
                $dates .= 'N/A+';
            }
            if($data['cp'] != '' || $data['cp'] != NULL){
                $data['cp'] = str_replace($original, $nuevo, $data['cp']);
                $dates .= $data['cp'].'+';
            }
            else{
                $dates .= 'N/A+';
            }
            if($data['latitud'] != '' || $data['latitud'] != NULL){
                $data['latitud'] = str_replace($original, $nuevo, $data['latitud']);
                $dates .= $data['latitud'].'+';
            }
            else{
                $dates .= 'N/A+';
            }
            if($data['longitud'] != '' || $data['longitud'] != NULL){
                $data['longitud'] = str_replace($original, $nuevo, $data['longitud']);
                $dates .= $data['longitud'].'+';
            }
            else{
                $dates .= 'N/A+';
            }
            if($data['siglas4'] != '' || $data['siglas4'] != NULL){
                $data['siglas4'] = str_replace($original, $nuevo, $data['siglas4']);
                $dates .= $data['siglas4'].'+';
            }
            else{
                $dates .= 'N/A+';
            }
            //$dates .= $data['edificio'].'+'.$data['clli_edif'].'+'.$data['calle'].'+'.$data['num_ext'].'+'.$data['localidad'].'+'.
                //$data['municipio'].'+'.$data['edo'].'+'.$data['cp'].'+'.$data['latitud'].'+'.$data['longitud'];
            
        }
    }
    return $dates;
}
$dac = trim($_POST['dac']);
echo dsitio($dac);
?>
