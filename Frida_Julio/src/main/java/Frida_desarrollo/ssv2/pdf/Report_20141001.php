<?php
/**
 * Clase que consulta los datos necesarios para la generación de un PDF
 *
 * @author HP435
 */

ini_set('memory_limit','256M');
ini_set('error_reporting','E_ALL ^ E_NOTICE');
//include './Conn.php';
include '../../../Conn.php';

class Report extends Conn{
    private $folio;
    public $headerData = array();
    private $datosGenerales;
    private $style = '<style type="text/css">th{background-color:#72a6f3}</style>';
    
    
    public function __construct($folio) {
        parent::__construct();
        $this->folio = $folio;
    }
    
    public function __get($obj){
        if (property_exists($this, $obj)) {
            return $this->$obj;
        }
    }
    
    public function __set($obj,$value){
        if(property_exists($this, $obj)) {
            $this->$obj = $value;
        }
        else{
            echo "Imposible encotrar parametro";       
        }
    }
	
    /**/
	private function normaliza($cadena){
        $originales =  'ÀÿÂÃÄÅÆÇÈÉÊËÌÿÎÿÿÑÒÓÔÕÖØÙÚÛÜÿÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        //$cadena = utf8_decode($cadena);
        //$cadena = strtr($cadena, utf8_decode($originales), $modificadas);
        //$cadena = strtolower($cadena);
        //$cadena = ereg_replace("[^A-Za-z0-9]", " ", $cadena);
        $cadena = str_replace(array('"','\''),array('',''),$cadena);
        return utf8_encode($cadena);
    }
    
    /**/
	public function habilitada(){
        $tags = array();
        $habilitadas = array();
        $query = "SELECT ztecnologias.tags FROM zss_equipos,ztecnologias WHERE zss_equipos.id_tecnologia=ztecnologias.id AND zss_equipos.folio='".$this->folio."'";
        $result = mysql_query($query);
        $sz = mysql_num_rows($result);
        if($sz > 0){
            for($i = 0;$i < $sz; $i++){
                $d = mysql_fetch_array($result);
                $tags[$i] = explode(',',$d['tags']);
            }
        }    
        for($i = 0; $i < count($tags); $i++){
            $habilitadas = array_merge($habilitadas, $tags[$i]);
        }
        $habilitadas = array_unique($habilitadas);
        sort($habilitadas);    
        return $habilitadas;
    }
    
	/**/
    public static function armarTabla($opciones,$select,$titulo,$comentarios){
		$comentarios = $comentarios == 'N/A' ? '' : $comentarios;
        $sz = count($opciones);
        $cadena = '<tr><th colspan="2" width="35%"><b>'.$titulo.'</b></th><th width="%65"><b>COMENTARIOS</b></th></tr>';
        $r = 0;$c=0;
        foreach($opciones as $val){
            if($val != $select){
                $r++;
            }
        }
        if($r == $sz && $select != 'N/A'){
            $r++;
        }
        else{
            $r = $sz;
        }
        for($i = 0; $i < $sz; $i++){
            $row = $i == 0 ? '<td rowspan="'.$r.'  width="65%""> '.$comentarios.'</td>' : '';
            if($opciones[$i] == $select){
                $x = 'X';
                $c++;
            }
            else{
                $x = '';
            }
            $cadena .= '<tr><td width="30%">'.strtoupper($opciones[$i]).'</td><td class="t" width="5%"><b>'.$x.'</b></td>'.$row.'</tr>';
            $c++;
        }
        $cadena .= $c == $sz && $select != 'N/A' ? '<tr><td>OTRO: <b>'.strtoupper($select).'</b></td><td class="t"><b>X</b></td></tr>' : '';
        return $cadena;
    }
    
	/**/
    public static function armarTabla02($opciones,$select,$titulo){
        $sz = count($opciones);
        $c=0;
        $cadena = '<tr><th colspan="2">'.$titulo.'</th></tr>';
        foreach($opciones as $val){
            if($val == $select){
                $x = 'X';
            }
            else{
                $x = '';
                $c++;
            }
            $cadena .= '<tr><td>'.strtoupper($val).'</td><td class="t"><b>'.$x.'</b></td></tr>';
            if($c == $sz && $select != 'N/A'){
                $cadena .= '<tr><td><b>OTRO: '.strtoupper($val).'</b></td><td class="t"><b>'.$x.'</b></td></tr>';
            }
        }
        return $cadena;
    }
    
	
    public static function armarTabla03($opciones,$select,$altura,$longitud,$comentarios,$titulo){
		$comentarios = $comentarios == 'N/A' ? '' : $comentarios;
        $sz = count($opciones);
        $cadena = '<tr><th><b>'.$titulo[0].'</b></th><th><b></b></th><th><b>ALTURA (mts.)</b></th><th><b>'.$titulo[1].'</b></th><th><b>COMENTARIOS</b></th></tr>';
        $r = 0;$c=0;
        foreach($opciones as $val){
            if($val != $select){
                $r++;
            }
        }
        if($r == $sz && $select != 'N/A'){
            $r++;
        }
        else{
            $r = $sz;
        }
        for($i = 0; $i < $sz; $i++){
            $row = $i == 0 ? '<td rowspan="'.$r.'">'.$comentarios.'</td>' : '';
            if($opciones[$i] == $select){
                $cadena .= '<tr><td>'.strtoupper($select).'</td><td class="t"><b>X</b></td><td class="c"><b>'.$longitud.'</b></td><td class="c"><b>'.$altura.'</b></td>'.$row.'</tr>';
            }
            else{
                $cadena .= '<tr><td>'.strtoupper($opciones[$i]).'</td><td class="t"></td><td></td><td></td>'.$row.'</tr>';
                $c++;
            }
        }
        if($c == $sz && $select != 'N/A'){
            $cadena .= '<tr><td>OTRO: <b>'.strtoupper($select).'</b></td><td class="t"><b>X</b></td><td class="c"><b>'.$longitud.'</b></td><td class="c"><b>'.$altura.'</b></td>'.$row.'</tr>';
        }
        return $cadena;
    }
	
	/**/
	function armarTabla04($tag,$comentarios){
		$result=mysql_query("select * from zcanaletas where folio='".$this->folio."' and tag='".$tag."'");
		$cadena = '<tr><td class="t">Tipo</td><td class="t">Existente o<br>Nueva</td><td class="t">Altura<br>al bastidor<br>(mts)</td><td class="t">Longitud<br>Trayectoria<br>(mts)</td><td class="t">Ancho<br>(pulgadas)</td><td class="t">Bajantes<br>Requeridas</td></tr>';
		while($arr=mysql_fetch_array($result,MYSQL_ASSOC)){
			$cadena.='<tr><td>  [ '.$this->cn_aplica($arr['aplica']).' ] '.$this->cn_tipo($arr['material']).'</td><td> '.$this->cn_existe($arr['nuevo_existente']).'</td><td align="center">'.$this->normaliza($arr['altura']).'</td><td align="center">'.$this->normaliza($arr['largo']).'</td><td align="center">'.$this->normaliza($arr['pulgadas']).'</td><td align="center">'.$this->normaliza($arr['bajante']).'</td></tr>';
		}
		$comentarios = $comentarios == 'N/A' ? '' : $comentarios;
		
		$cadena.='<tr><th colspan="6">COMENTARIOS</th></tr>';
		$cadena.='<tr><td colspan="6" height="100"> '.$comentarios.'</td></tr>';
		return $cadena;
	}
	
	/**/
	function cn_tipo($t){
		switch($t){
			case 0: $t="ALUMINIO"; break;
			case 1: $t="ACERO"; break;
			case 2: $t="CHAROLA"; break;
			case 3: $t="PLÁSTICA"; break;
			default: $t=""; break;
		}
		return $t;
	}
	
	/**/
	function cn_aplica($x){
		switch($x){
			case 0: $x=""; break;
			case 1: $x="X"; break;
			default: $x=""; break;
		}
		return $x;
	}

	/**/
	function cn_existe($e){
            switch($e){
                case 0: $e=""; break;
                case 1: $e="EXISTENTE"; break;
                case 2: $e="NUEVA"; break;
                default: $e=""; break;
            }
            return $e;
	}
	
	/**/
    public static function comentarios($comentarios){
        $comentarios = $comentarios == 'N/A' ? '' : $comentarios;
        return $cadena = '<table border="1"><tr><th><b>COMENTARIOS</b></th></tr><tr><td height="100">'.$comentarios.'</td></tr></table>';
    }

	/**/	
    function encabezado(){
		$original = array('°','ÿ','É','ÿ','Ó','Ú','á','é','í','ó','ú','Ñ','ñ');
		$nuevo = array('&deg;','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;','&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','&Ntilde;','&ntilde;');
        $query = "SELECT centrales.dir_div,centrales.area,centrales.sigcent,centrales.edificio,DATE(zsite_survey.fecha_solicitud) AS fecha_solicitud,DATE(zsite_survey.fecha_programada) AS fecha_programada,DATE(zsite_survey.fecha_captura) AS fecha_captura,DATE(zsite_survey.fecha_ejecucion) AS fecha_ejecucion,DATE(zsite_survey.fecha_validacion) AS fecha_validacion,zsite_survey.ctnombre,zsite_survey.cttelefono,zsite_survey.ctemail,zsite_survey.cpnombre,zsite_survey.cptelefono,zsite_survey.cpemail,zsite_survey.estatus,ztecnologias.rubro,ztecnologias.tecnologia,ztecnologias.proveedor,zsite_survey.rsnombre,zsite_survey.rstelefono,zsite_survey.rsemail,zsite_survey.rsmovil,zsite_survey.ctmovil,zsite_survey.cpmovil FROM zsite_survey, ztecnologias, zss_equipos, centrales WHERE zsite_survey.folio='".$this->folio."' AND zss_equipos.folio = zsite_survey.folio AND zss_equipos.id_tecnologia = ztecnologias.id AND centrales.id_ctl = zsite_survey.id_central GROUP BY zss_equipos.folio";
        $result = mysql_query($query);
		$arr = mysql_fetch_row($result);
		
		$n=count($arr);
		for($i = 0; $i <= $n; $i++){
			$arr[$i] = $this->normaliza($arr[$i]);
			$this->headerData[$i] = !empty($arr[$i]) ? $arr[$i] : 'N/A';
		}
        //$this->headerData = mysql_fetch_array($result);             
    }
    
	/**/
	function datosGenerales(){
        $query = "SELECT eg_tipotrabajo,eg_coment_tipotrabajo,eg_tipocentral,eg_coment_tipocentral,eg_espacio,eg_coment_espacio,eg_tipodepiso,eg_coment_tipodepiso,eg_obracivil,eg_coment_obracivil,afo_bastidor_fibra,afo_bastidor_marca,afo_tipo_bastidor_fibra,afo_canaleta,afo_canaleta_altura,afo_canaleta_longitud,afo_coment_canaleta,afo_canaleta_tipo,afo_canaleta_tipo_mt,afo_canaleta_tipo_in,afo_coment_canaleta_tipo,afo_comentarios,bfo_bastidor_fibra,bfo_bastidor_marca,bfo_tipo_bastidor_fibra,bfo_canaleta,bfo_canaleta_altura,bfo_canaleta_longitud,bfo_coment_canaleta,bfo_canaleta_tipo,bfo_canaleta_tipo_mt,bfo_canaleta_tipo_in,bfo_coment_canaleta_tipo,bfo_comentarios,mp_dgral,mp_disgral,mp_canaleta,mp_canaleta_altura,mp_canaleta_longitud,mp_canaleta_coment,mp_canaleta_tipo,mp_canaleta_tipo_mt,mp_canaleta_tipo_in,mp_coment_canaleta_tipo,mp_comentarios,cx_escalerilla_bdtd,cx_tipo_escalerilla_bdtd,cx_canaleta,cx_canaleta_altura,cx_canaleta_longitud,cx_escalerilla_coment,cx_canaleta_tipo,cx_canaleta_tipo_mt,cx_canaleta_tipo_in,cx_coment_canaleta_tipo,cx_comentarios,gs_requieregestion,gs_tipogestion,gs_puertoRCDT,gs_requieresincronia,gs_cnaddalarmas,gs_canaleta,gs_canaleta_altura,gs_canaleta_longitud,gs_canaleta_coment,gs_canaleta_tipo,gs_canaleta_tipo_mt,gs_canaleta_tipo_in,gs_coment_canaleta_tipo,gs_comentarios,fz_tp_alimen,fz_configplanta,fz_escalerilla_bdtd,fz_consumo,fz_canaleta,fz_canaleta_altura,fz_canaleta_longitud,fz_escalerilla_coment,fz_canaleta_tipo,fz_canaleta_tipo_mt,fz_canaleta_tipo_in,fz_coment_canaleta_tipo,fz_comentarios FROM zsite_survey WHERE folio='".$this->folio."'";
        $result = mysql_query($query);
		$arr = mysql_fetch_row($result);
		for($i = 0; $i < 83; $i++){
			$arr[$i] = $this->normaliza($arr[$i]);
			$this->datosGenerales[$i]=!empty($arr[$i])?$arr[$i]:'N/A';
		}
    }

	/**/
    function ccemail(){
        $cadena = '';
        $query = "SELECT nombre,email FROM zccemails WHERE folio='".$this->folio."'";
        $result = mysql_query($query);
        $sz = mysql_num_rows($result);
        if($sz > 0){
            $cadena = '<table border="1"><tr><td class="t"><b>DISTRIBUCI&Oacute;N DE COPIAS</b></td></tr><tr><td> ';
            for($i = 0; $i < $sz; $i++){
                $d = mysql_fetch_array($result);
                $coma = ($i < $sz - 1) ? ', ' : '';
				$d['nombre'] = $this->normaliza($d['nombre']);
                $cadena .= $d['nombre'].' '.$d['email'].$coma;
            }
            $cadena .= '</td></tr></table>';
        }
        return $cadena;
    }
    
	/**/
    function ubxeq(){
        $cadena = '';
        $query = "SELECT ztecnologias.tipo_equipo, zss_equipos.ubicacion,zss_equipos.nuevoExistente,zss_equipos.nombre_equipo,zss_equipos.puertos,zss_equipos.tarjetas,zss_equipos.espacio FROM ztecnologias,zss_equipos WHERE zss_equipos.folio='".$this->folio."' AND zss_equipos.id_tecnologia = ztecnologias.id";
        $result = mysql_query($query);
        $sz = mysql_num_rows($result);
        if($sz > 0){
            $cadena = '<table border="1"><tr><th colspan="7"><b>UBICACI&Oacute;N DE EQUIPOS</b></th></tr>
			<tr><td class="t" width="15%"><b>Modelo</b></td>
			<td class="t" width="20%"><b>No. Repisa</b></td>
			<td class="t" width="15%"><b>Ubicaci&oacute;n</b></td>
			<td class="t" width="15%"><b>Bastidor<BR>Nuevo/Existente</b></td>
			<td class="t" width="8%"><b>Puertos</b></td>
			<td class="t" width="8%"><b>Tarjetas</b></td>
			<td class="t" width="19%"><b>Espacio</b></td></tr>';
            for($i = 0; $i < $sz; $i++){
			$a = $i;
			$a++;
                $d = mysql_fetch_row($result);
                $cadena .= '<tr><td align="center"> '.$d[0].'</td><td align="center"> '.$d[3].'</td><td align="center"> '.$d[1].'</td><td align="center"> '.$d[2].'</td><td align="center"> '.$d[4].'</td><td align="center"> '.$d[5].'</td><td> '.$d[6].'</td></tr>';
            }
            $cadena .= '</table>';
        }
        return $cadena;
    }
    
	/**/
    function abfo($ab){
        $cadena='';
        $arr = array();
		
		$total = mysql_query("SELECT count(ztecnologias.tipo_equipo) as total FROM ztecnologias,zss_equipos WHERE zss_equipos.folio='".$this->folio."' AND zss_equipos.id_tecnologia = ztecnologias.id");
        $total = mysql_fetch_array($total,MYSQL_BOTH);
        $total = $total[0];
		
        $query = "SELECT ztecnologias.id,ztecnologias.tipo_equipo FROM ztecnologias,zinter_abfo WHERE zinter_abfo.folio='".$this->folio."'  AND zinter_abfo.alto_bajo=".$ab." AND ztecnologias.id=zinter_abfo.id_modelo";
        $result = mysql_query($query);
        $sz = mysql_num_rows($result);
        if($sz > 0){
            for($i = 0; $i < $sz; $i++){
                $d = mysql_fetch_array($result);
                $arr[$i][0] = $d['tipo_equipo'];
            }
        }
		else{
			$subquery = "SELECT ztecnologias.tipo_equipo as equipo FROM ztecnologias,zss_equipos WHERE zss_equipos.folio='".$this->folio."' AND zss_equipos.id_tecnologia = ztecnologias.id";
			$subresult = mysql_query($subquery);
			$subsz = mysql_num_rows($subresult);
			if($subsz > 0){
				for($i = 0; $i < $subsz; $i++){
					$subd = mysql_fetch_array($subresult);
					$arr[$i][0] = $subd['equipo'];
				}
			}
		}
        $query2 = "SELECT * FROM zinter_abfo WHERE folio = '".$this->folio."' AND alto_bajo=".$ab;
        $result2 = mysql_query($query2);
        $sz2 = mysql_num_rows($result2);
        if($sz2 > 0){
            for($i = 0; $i < $sz2; $i++){
                $d2 = mysql_fetch_array($result2);
                $arr[$i][1] = $d2['ubicacion'];
                $arr[$i][2] = $d2['dfo'];
                $arr[$i][3] = $d2['tipo_conector_equipo'];
                $arr[$i][4] = $d2['posicion_remate'];
                $arr[$i][5] = $d2['tipo_fibra'];
                $arr[$i][6] = $d2['tipo_conector_bdfo'];
                $arr[$i][7] = $d2['Tx_Rx'];
                $arr[$i][8] = $d2['long_jumper_1'];
                $arr[$i][9] = $d2['long_jumper_2'];
            }
        }
        for($i = 0; $i < $total; $i++){
            $cadena .='<tr>';
            for($j = 0; $j < 10; $j++){
                $cadena .= '<td class="c">'.$arr[$i][$j].'</td>';
            }
            $cadena .='</tr>';
        }
        return $cadena;
    }
	
	function canaletas($tag){		
		
		
	}
    
	/**/
    function multipar(){
        $tabla = '<tr><td  class="gc" colspan="8">DISTRIBUIDOR GENERAL</td></tr><tr><th colspan="8">TABLA DE REMATES</th></tr><tr><td class="t" colspan="2"></td><td class="t" colspan="3">POTS</td><td class="t" colspan="3">DSL</td></tr><tr><td class="c">Equipo</td><td class="c">Tipo tablilla</td><td class="c">Nivel</td><td class="c">Vertical</td><td class="c">Puerto</td><td class="c">Nivel</td><td class="c">Vertical</td><td class="c">Puerto</td></tr>';
        $query = "SELECT id,nombre_equipo FROM zss_equipos where folio = '".$this->folio."' AND id_tecnologia != 0";
        $result = mysql_query($query);
        $sz = mysql_num_rows($result);
        if($sz > 0){
            for($i = 0; $i < $sz; $i++){
                $z = 1;
                $d = mysql_fetch_array($result);
                $query2 = "SELECT * FROM zinter_mp WHERE id_equipo=".$d['id']." AND folio='".$this->folio."' order by id";
                $result2 = mysql_query($query2);
                $sz2 = mysql_num_rows($result2);
                if($sz2 > 0){
                    $sel = ($sz2/2) == 8 ? 'Portasystem' : 'Versablock';
                    $tabla .= '<tr><td rowspan="'.($sz2/2).'">'.$d['nombre_equipo'].'</td><td rowspan="'.($sz2/2).'">'.$sel.'</td>';
                    for($j = 0; $j < $sz2; $j++){
                        $d2 = mysql_fetch_array($result2);
                        if($j%2 == 0 && $j == 0){
                            $tabla .= '<td class="c">'.$d2['nivel'].'</td>'
                                . '<td class="c">'.$d2['vertical'].'</td>'
                                . '<td  class="c">'.$d2['puertos'].'</td>';
                        }
                        else if($j%2 != 0 && $j == 0){
                            $tabla .= '<td class="c">'.$d2['nivel'].'</td>'
                                . '<td class="c">'.$d2['vertical'].'</td>'
                                . '<td class="c">'.$d2['puertos'].'</td></tr>';
                        }
                        else if($j%2 == 0 && $j != 0){
                            $tabla .= '<tr>'
                                . '<td class="c">'.$d2['nivel'].'</td>'
                                . '<td class="c">'.$d2['vertical'].'</td>'
                                . '<td class="c">'.$d2['puertos'].'</td>';
                        }
                        else if($j%2 != 0 && $j != 0){
                            $tabla .= '<td class="c">'.$d2['nivel'].'</td>'
                                . '<td class="c">'.$d2['vertical'].'</td>'
                                . '<td class="c">'.$d2['puertos'].'</td></tr>';
                        }
                    }
                }
                else{
                    $tabla .= '<tr><td class="c">'.$d['nombre_equipo'].'</td><td class="c"></td><td class="c"></td><td class="c"></td><td class="c"></td><td class="c"></td><td class="c"></td><td class="c"></td></tr>';
                }
            }
        }        
        return $tabla;
    }

	/**/
    function coaxial(){
        $cadena='';
        $arr = array();
		
		$total = mysql_query("SELECT count(ztecnologias.tipo_equipo) as total FROM ztecnologias,zss_equipos WHERE zss_equipos.folio='".$this->folio."' AND zss_equipos.id_tecnologia = ztecnologias.id");
		$total = mysql_fetch_array($total,MYSQL_BOTH);
		$total = $total[0];
		
        $query = "SELECT ztecnologias.id, ztecnologias.tipo_equipo FROM ztecnologias, zinter_cx WHERE zinter_cx.folio = '".$this->folio."' AND ztecnologias.id = zinter_cx.id_modelo";
        $result = mysql_query($query);
        $sz = mysql_num_rows($result);
        if($sz > 0){
            for($i = 0; $i < $sz; $i++){
                $d = mysql_fetch_array($result);
                $arr[$i][0] = $d['tipo_equipo'];
            }
        }
		else{
			$subquery = "SELECT ztecnologias.tipo_equipo as equipo FROM ztecnologias,zss_equipos WHERE zss_equipos.folio='".$this->folio."' AND zss_equipos.id_tecnologia = ztecnologias.id";
			$subresult = mysql_query($subquery);
			$subsz = mysql_num_rows($subresult);
			if($subsz > 0){
				for($i = 0; $i < $subsz; $i++){
					$subd = mysql_fetch_array($subresult);
					$arr[$i][0] = $subd['equipo'];
				}
			}
		}
        $query2 = "SELECT * FROM zinter_cx WHERE folio = '".$this->folio."'";
        $result2 = mysql_query($query2);
        $sz2 = mysql_num_rows($result2);
        if($sz2 > 0){
            for($i = 0; $i < $sz2; $i++){
                $d2 = mysql_fetch_array($result2);
                $arr[$i][1] = $d2['ubicacion'];
                $arr[$i][2] = $d2['pos_tablilla'];
                $arr[$i][3] = $d2['lado'];
                $arr[$i][4] = $d2['pos_contacto'];
                $arr[$i][5] = $d2['tipo_conector'];
                $arr[$i][6] = $d2['tipo_coaxial'];
                $arr[$i][7] = $d2['tx_rx'];
                $arr[$i][8] = $d2['long_cable'];
            }
        }
        
        for($i = 0; $i < $total; $i++){
            $cadena .='<tr>';
            for($j = 0; $j < 9; $j++){
                $cadena .= '<td class="c">'.$arr[$i][$j].'</td>';
            }
            $cadena .='</tr>';
        }
        return $cadena;
    }
    
	/**/	
    function gestionSincronia($gs){
        $arr = array();
		
		$total = mysql_query("SELECT count(ztecnologias.tipo_equipo) as total FROM ztecnologias,zss_equipos WHERE zss_equipos.folio='".$this->folio."' AND zss_equipos.id_tecnologia = ztecnologias.id");
		$total = mysql_fetch_array($total,MYSQL_BOTH);
		$total = $total[0];
		
        $query = "SELECT ztecnologias.id, ztecnologias.tipo_equipo FROM ztecnologias, zinter_gs WHERE zinter_gs.folio = '".$this->folio."'  AND zinter_gs.gestionSincronia = ".$gs." AND ztecnologias.id = zinter_gs.id_modelo";
        $result = mysql_query($query);
        $sz = mysql_num_rows($result);
        if($sz > 0){
            for($i = 0; $i < $sz; $i++){
                $d = mysql_fetch_array($result);
                $arr[$i][0] = $d['tipo_equipo'];
            }
        }
		else{
			$subquery = "SELECT ztecnologias.tipo_equipo as equipo FROM ztecnologias,zss_equipos WHERE zss_equipos.folio='".$this->folio."' AND zss_equipos.id_tecnologia = ztecnologias.id";
			$subresult = mysql_query($subquery);
			$subsz = mysql_num_rows($subresult);
			if($subsz > 0){
				for($i = 0; $i < $subsz; $i++){
					$subd = mysql_fetch_array($subresult);
					$arr[$i][0] = $subd['equipo'];
				}
			}
		}
		$query2 = "SELECT * FROM zinter_gs WHERE folio = '".$this->folio."' AND gestionSincronia = ".$gs."";
        $result2 = mysql_query($query2);
        $sz2 = mysql_num_rows($result2);
        if($sz2 > 0){
            for($i = 0; $i < $sz2; $i++){
                $d2 = mysql_fetch_array($result2);
                $arr[$i][1] = $d2['ubicacion_RCDT'];
                $arr[$i][2] = $d2['numero_switch'];
                $arr[$i][3] = $d2['puerto'];
                $arr[$i][4] = $d2['cat_cable'];
                $arr[$i][5] = $d2['long_cable'];
                $arr[$i][6] = $d2['tipo_conector'];
            }
        }
        
        for($i = 0; $i < $total; $i++){
            $cadena .='<tr>';
            for($j = 0; $j < 7; $j++){
                $cadena .= '<td class="c">'.$arr[$i][$j].'</td>';
            }
            $cadena .='</tr>';
        }
        return $cadena;
    }
    
	/**/
    function fuerza(){
        $cadena = '';
        $arr = array();
        $arr2 = array();
		
		$total = mysql_query("SELECT count(ztecnologias.tipo_equipo) as total FROM ztecnologias,zss_equipos WHERE zss_equipos.folio='".$this->folio."' AND zss_equipos.id_tecnologia = ztecnologias.id");
		$total = mysql_fetch_array($total,MYSQL_BOTH);
		$total = $total[0];
		
        $query = "SELECT ztecnologias.id, ztecnologias.tipo_equipo FROM ztecnologias, zss_equipos WHERE zss_equipos.folio = '".$this->folio."' AND zss_equipos.id_tecnologia = ztecnologias.id";
        $result = mysql_query($query);
        $sz = mysql_num_rows($result);
        if($sz > 0){
            for($i = 0; $i < $sz; $i++){
                $d = mysql_fetch_array($result);
                $arr[$i] = $d['tipo_equipo'];
            }
        }
		else{
			$subquery = "SELECT ztecnologias.tipo_equipo as equipo FROM ztecnologias,zss_equipos WHERE zss_equipos.folio='".$this->folio."' AND zss_equipos.id_tecnologia = ztecnologias.id";
			$subresult = mysql_query($subquery);
			$subsz = mysql_num_rows($subresult);
			if($subsz > 0){
				for($i = 0; $i < $total; $i++){
					$subd = mysql_fetch_array($subresult);
					$arr[$i] = $subd['equipo'];
				}
			}
		}
		
        $query2 = "SELECT id,folio,trabajo_respaldo,id_modelo,ub_alimen,pf_breaker,cap_fusible,calibre,l_cable,c_cable,t_zapata FROM zinter_fz WHERE folio = '".$this->folio."' ORDER BY id_modelo";
        $result2 = mysql_query($query2);
        $sz2 = mysql_num_rows($result2);
        if($sz2 > 0){
            for($i = 0; $i < $sz2; $i++){
                $d2 = mysql_fetch_array($result2);
                $arr2[$i][0] = $d2['ub_alimen'];
                $arr2[$i][1] = $d2['pf_breaker'];
                $arr2[$i][2] = $d2['cap_fusible'];
                $arr2[$i][3] = $d2['calibre'];
                $arr2[$i][4] = $d2['l_cable'];
                $arr2[$i][5] = $d2['c_cable'];
                $arr2[$i][6] = $d2['t_zapata'];
            }
        }
        for($i = 0; $i < count($arr); $i++){
                $cadena .= '<tr><td rowspan="2" class="c">'.$arr[$i].'</td>';
                $cadena .='<td class="c">Trabajo</td>';
                $cadena .='<td class="c">'.$arr2[$i][0].'</td>';
                $cadena .='<td class="c">'.$arr2[$i][1].'</td>';
                $cadena .='<td class="c">'.$arr2[$i][2].'</td>';
                $cadena .='<td class="c">'.$arr2[$i][3].'</td>';
                $cadena .='<td class="c">'.$arr2[$i][4].'</td>';
                $cadena .='<td class="c">'.$arr2[$i][5].'</td>';
                $cadena .='<td class="c">'.$arr2[$i][6].'</td>';
                $cadena .= '</tr>';
                $a = $total + $i;
                //$a++;
                $cadena .='<tr><td class="c">Respaldo</td>';
                $cadena .='<td class="c">'.$arr2[$a][0].'</td>';
                $cadena .='<td class="c">'.$arr2[$a][1].'</td>';
                $cadena .='<td class="c">'.$arr2[$a][2].'</td>';
                $cadena .='<td class="c">'.$arr2[$a][3].'</td>';
                $cadena .='<td class="c">'.$arr2[$a][4].'</td>';
                $cadena .='<td class="c">'.$arr2[$a][5].'</td>';
                $cadena .='<td class="c">'.$arr2[$a][6].'</td></tr>';
            
        }
        return $cadena;
    }
    
	function resumen(){
		$cadena='';
		return $cadena;
	}	
    function archivos(){
		$cadena='';
		return $cadena;
    }
	
	function imagenes(){
		$space = '<table height="10"><tr><td></td></tr></table>';
		$cadena = '<table border="1">';
        $query = "SELECT * FROM zarchivos where folio = '".$this->folio."' and tipo like 'image%' ORDER BY tipo";
        $result = mysql_query($query);
        $sz = mysql_num_rows($result);
        if($sz > 0){
			for($i=1;$i<=$sz;$i++){
				$d=mysql_fetch_array($result,MYSQL_ASSOC);
				$tri=$trf='';
				if($i%2!=0){$tri='<div width="210" border="1" style="display:block;">';} else {$trf='</div>';}
			    $cadena .= $tri.'<img width="200" height="150" src="../'.$d['ruta'].'"></img></div><div border="1"  style="display:block;">'.$d['descripcion'].$trf;
				//$cadena.=$tri.'<td><table border="1"><tr><td>'.$i.'</td></tr><tr><td>'.$i.' descripcion</td></tr></table></td>'.$trf;
			}
        }
        $cadena .= '</table>';
		//$cadena='A<div border="1" style="display:inline; "><img border="1" width="300" src="../'.$d['ruta'].'"/><br>B'.$d['descripcion'].'</div>';
        return $cadena;
	}
}
?>