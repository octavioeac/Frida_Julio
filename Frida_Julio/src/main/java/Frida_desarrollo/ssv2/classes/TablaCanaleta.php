<?php

/**
 * Description of TablaCanaleta
 *
 * @author HP435
 * 
 * Clase que devuelve la tabla de canaletas construida
 */
class TablaCanaleta extends Conn{
    
    private $ss_folio;
    private $data = array();
    private $tag;
    private $material = array('ALUMINIO','ACERO','CHAROLA','PLASTICO');
    private $nuoex = array('0'=>'','1'=>'NUEVA','2'=>'EXISTENTE');
    private $tabla = '';
    
    public function __construct($folio,$tag){
        parent::__construct();
        $this->ss_folio = $folio;
        $this->tag = $tag;
        $this->Datos();
        $this->Armar();
    }
    
    public function __get($object){
        if(property_exists($this, $object)) {
            return $this->$object;
        }
    }

    public function __set($object,$value){
        if(property_exists($this, $object)) {
            $this->$object = $value;
        }
    }
    
    private function Datos(){
        $query = "select aplica,material,nuevo_existente,altura,largo,pulgadas,bajante,comentarios from zcanaletas where folio='".$this->ss_folio."' and tag=".$this->tag;
        $result = mysql_query($query);
        while($d = mysql_fetch_row($result)){
            $this->data[] = $d;
        }
    }
    
    private function Armar(){
        for($i = 0; $i < 4; $i++){
            $this->tabla .= '<tr>';
            for($j = 0; $j < 7; $j++){
                if($j == 0){
                    $this->tabla .= '<td>   ';
                    $this->tabla .= $this->data[$i][$j] == 1 ? '<b>[X] ' : '';
                    $this->tabla .= $this->material[$this->data[$i][1]];
                    $this->tabla .= $this->data[$i][$j] == 1 ? '</b>' : '';
                    $this->tabla .= '</td>';
                }
                else if($j > 1){
                    $this->data[$i][$j] = $j == 2 ? $this->data[$i][$j] = $this->nuoex[$this->data[$i][$j]] : $this->data[$i][$j] = $this->data[$i][$j] == 0 ? '' : $this->data[$i][$j];
                    $this->tabla .= '<td class="c">';
                    $this->tabla .= $this->data[$i][$j];
                    $this->tabla .= '</td>';
                }
            }
            $this->tabla .= '</tr>';
        }
        $this->tabla .= '<tr><th colspan="6"><b>COMENTARIOS</b></th></tr><tr><td colspan="6">'.$this->data[0][7].'</td></tr>';
    }
}