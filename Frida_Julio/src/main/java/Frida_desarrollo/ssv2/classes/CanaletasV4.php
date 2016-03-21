<?php

/**
 * Description of CanaletasV4
 *
 * @author HP435
 */
//include 'Conn.php';

class CanaletasV4 extends Conn{
    private $folio;
    private $tabla = array(2=>'<tr>',3=>'<tr>',4=>'<tr>',5=>'<tr>',6=>'<tr>',7=>'<tr>');
    private $material = array('','Aluminio','Acero','Charola','Plastico');
    private $titulos = array(' F.O. (Alto Orden hacia TX)',' F.O. (Bajo Órden Servicios)',' Multipar',' Coaxial',' Gestión y Sincronía',' Alimentación');
    private $nuex = array('','Nuevo','Existente');
	private $sat = array('','Si','No');
	private $ancho = array('','2 "','4 "','6 "','9 "','12 "','24 "');
    private $tabs = array();
    private $habilitadas = array();
    private $c = 2;
    private $t = 0;
    private $cadena = '';
    
    function __construct($folio){
        parent::__construct();
        $this->folio = $folio;
        $this->tags();
        $this->buildTable();
        $this->armar();
    }
    
    public function __get($object){
        if(property_exists($this, $object)) {
            return $this->$object;
        }
    }
    
    private function tags(){
        $query = "SELECT ztecnologias.tags FROM zss_equipos,ztecnologias WHERE zss_equipos.id_tecnologia=ztecnologias.id AND zss_equipos.folio='".$this->folio."'";
        $result = mysql_query($query);
        while($d = mysql_fetch_row($result)){
            $this->tabs[] = explode(',',$d[0]);
        }
        foreach($this->tabs as $value){
            $this->habilitadas = array_merge($this->habilitadas,$value);
        }
        $this->habilitadas = array_unique($this->habilitadas);
        sort($this->habilitadas);
    }
    
    private function buildTable(){
        $query = "select eg_afo_material,eg_afo_nuex,eg_afo_sat,eg_afo_altura,eg_afo_trayectoria,eg_afo_pulgadas,eg_afo_bajante,eg_afo_nobajante,
			eg_bfo_material,eg_bfo_nuex,eg_bfo_sat,eg_bfo_altura,eg_bfo_trayectoria,eg_bfo_pulgadas,eg_bfo_bajante,eg_bfo_nobajante,
			eg_mp_material,eg_mp_nuex,eg_mp_sat,eg_mp_altura,eg_mp_trayectoria,eg_mp_pulgadas,eg_mp_bajante,eg_mp_nobajante,
			eg_cx_material,eg_cx_nuex,eg_cx_sat,eg_cx_altura,eg_cx_trayectoria,eg_cx_pulgadas,eg_cx_bajante,eg_cx_nobajante,
			eg_gs_material,eg_gs_nuex,eg_gs_sat,eg_gs_altura,eg_gs_trayectoria,eg_gs_pulgadas,eg_gs_bajante,eg_gs_nobajante,
			eg_fz_material,eg_fz_nuex,eg_fz_sat,eg_fz_altura,eg_fz_trayectoria,eg_fz_pulgadas,eg_fz_bajante,eg_fz_nobajante
			from zsite_survey WHERE folio='".$this->folio."'";
        $result = mysql_query($query);
        $d = mysql_fetch_row($result);
		$x=8;
        foreach($d as $key => $value){
            if(($key % $x) == 0 && $key > 1){
                $this->tabla[$this->c] .= '</tr>';
                $this->c++;
            }
            if($key % $x == 0){
                $this->tabla[$this->c] .= '<td class="gc" align="left">'.$this->titulos[$this->t].'</td><td class="c">'.$this->material[$value].'</td>';
                $this->t++;
            }
            else if(($key - 1) % $x == 0){
                $this->tabla[$this->c] .= '<td class="c">'.$this->nuex[$value].'</td>';
            }
			elseif(($key - 2) % $x == 0){
                $this->tabla[$this->c] .= '<td class="c">'.$this->sat[$value].'</td>';
            }
			elseif(($key - 5) % $x == 0){
                $this->tabla[$this->c] .= '<td class="c">'.$this->ancho[$value].'</td>';
            }
			elseif(($key - 7) % $x == 0){
                $this->tabla[$this->c] .= '<td class="c">'.$this->ancho[$value].'</td>';
            }
			else{
                $this->tabla[$this->c] .= '<td class="c">'.$value.'</td>';
            }
        }
    }
    
    private function armar(){
        for($i = 0; $i < count($this->habilitadas)-1; $i++){
            $this->cadena .= $this->tabla[$this->habilitadas[$i]];
        }
    }
}

//$labels = new CanaletasV4('SS4520150129001');
//echo '<pre>';
//print_r($labels->habilitadas);
//echo '</pre>';
//echo '<table border="1">';
//echo $labels->cadena;
//echo '</table>';