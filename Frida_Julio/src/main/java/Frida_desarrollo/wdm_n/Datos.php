<?php
include 'Conn.php';

/**
 * Estrae los datos necesarios para las funciones.
 *
 * @author HP435
 */
class Datos extends Conn{
    private $folio;
    public $datos = array();
    
    public function __construct($f){
        parent::__construct();
        $this->folio = $f;
        $this->nomof();
    }
    
    public function nomof(){
        //z_inter_abfo.alto_bajo: 0 bajo y 1 alto orden
        $query="SELECT d.dir_div,d.area,d.sigcent,d.edificio,d.edo,d.municipio,d.clli_edif,d.cm,e.proveedor as proveedor_infocentro,e.cat_infocentro,e.software,e.release_eq,b.tipo_equipo,b.tabla,b.clase_repisa,b.puertos_max,a.ubicacion,a.tarjetas,a.nombre_equipo,f.ubicacion as ubidfo_dsl,f.tipo_conector_equipo as ubidfo_puerto,c.prove as proveedor_sitesurvey,c.plan,right(a.ubicacion,4) as repisa,b.tecnologia,a.id as id_eq
                        FROM zss_equipos a,ztecnologias b,zsite_survey c,centrales d,cat_equipo e, zinter_abfo f 
                        WHERE a.folio='".$this->folio."' 
                        AND a.folio=c.folio 
                        AND  a.id_tecnologia=b.id 
                        AND a.tipo_trabajo='Repisa Nueva' 
                        AND c.id_central=d.id_ctl 
                        AND e.tipo_equipo=b.tipo_equipo 
                        AND f.id_equipo=a.id
                        and f.alto_bajo=1
                        ORDER BY a.id";
        $result = mysql_query($query);
        $sz = mysql_num_rows($result);
        if($sz > 0){
            for($i = 0; $i < $sz; $i++){
                $this->datos[$i] = mysql_fetch_row($result);
            }
        }
    }
    
    public function altaNomof($nomof,$usr,$index){
        $query = "INSERT INTO ".$this->datos[$index][13]."(id_dslam,tipo_equipo_oficial,clase_repisa,software,release_eq,ch_nom_of,division,estado,area,ciudad,nombre_central,siglas_central,clli_edificio,centro_mantenimiento,puerto_dsl,proveedor,nombre_oficial_pisa,fecha_alta,login,fecha_operacion,funcion,tipo_topologia,ubicacion,tipo_gestion,folio_ss,no_repisa,tecnol_eq_isam,ch_clli) VALUES(id_dslam,'".$this->datos[$index][9]."','".$this->datos[$index][14]."','".$this->datos[$index][10]."','".$this->datos[$index][11]."','OK','".$this->datos[$index][0]."','".$this->datos[$index][4]."','".$this->datos[$index][1]."','".$this->datos[$index][5]."','".$this->datos[$index][3]."','".$this->datos[$index][2]."','".$this->datos[$index][6]."','".$this->datos[$index][7]."','".$this->datos[$index][15]."','".$this->datos[$index][21]."','".$nomof."',NOW(),'".$usr."','0000-00-00','".$this->datos[$index][22].", ".$nomof."','PTO-PTO_','".$this->datos[$index][16]."','DENTRO DE BANDA','".$this->folio."','".$this->datos[$index][23]."','".$this->datos[$index][24]."','SOLICITAR')";
		mysql_query($query);
    }
    
    public function actualizaNombre($nomof,$id_eq){
        $update = "UPDATE zss_equipos SET nombre_equipo = '".$nomof."' WHERE id = '".$id_eq."' AND folio='".$this->folio."'";
        mysql_query($update);
    }
    
    public function equipos(){
        $this->datos = array();
        $query = "SELECT centrales.dir_div,centrales.area,centrales.sigcent,centrales.edificio,centrales.edo,centrales.municipio,centrales.clli_edif,centrales.cm,cat_equipo.proveedor,cat_equipo.cat_infocentro,cat_equipo.software,cat_equipo.release_eq,ztecnologias.tipo_equipo,ztecnologias.tabla,ztecnologias.clase_repisa,ztecnologias.puertos_tarjeta,zss_equipos.ubicacion,zss_equipos.tarjetas,zsite_survey.plan,ztecnologias.tipo_tarjeta,ztecnologias.cod_tarjeta,zss_equipos.nombre_equipo,zss_equipos.tipo_trabajo,ztecnologias.tarjetas_max,RIGHT(zss_equipos.ubicacion,4) rs,zsite_survey.prove as proveedor_sitesurvey FROM zss_equipos,ztecnologias,zsite_survey,centrales,cat_equipo WHERE zss_equipos.folio='".$this->folio."' AND zss_equipos.folio=zsite_survey.folio AND zss_equipos.id_tecnologia=ztecnologias.id AND zsite_survey.id_central=centrales.id_ctl AND cat_equipo.tipo_equipo=ztecnologias.tipo_equipo ORDER BY zss_equipos.id";
        $result = mysql_query($query);
        $sz = mysql_num_rows($result);
        if($sz > 0){
            for($i = 0; $i < $sz; $i++){
                $this->datos[$i] = mysql_fetch_row($result);
            }
        }
    }
    
    public function genIdTarjeta($usr){
        $max = mysql_query("SELECT MAX(id) FROM inventario_tarjetas_acceso");
        $max = mysql_fetch_array($max, MYSQLI_BOTH);
        $max = $max[0];
        $max++;
        return 'TJ-'.date('Ymd').'-'.$usr.'-'.$max;
    }
    
    public function altaRanuras(){
        for($i = 0; $i < count($this->datos); $i++){
			if($this->datos[$i][22]=="Repisa Nueva")
			{
				for($j = 0; $j < $this->datos[$i][23]; $j++){
					$insert = "INSERT INTO inventario_tarjetas_acceso(id,id_tarjetas,nombre_oficial_pisa,estatus,tipo_equipo,plan_bb,tabla,proveedor,division,area,siglas_central,nombre_central,slot,tipo_movimiento) VALUES (id,'','".$this->datos[$i][21]."','DISPONIBLE','".$this->datos[$i][12]."','','".$this->datos[$i][13]."','".$this->datos[$i][21]."','".$this->datos[$i][0]."','".$this->datos[$i][1]."','".$this->datos[$i][2]."','".$this->datos[$i][3]."','".sprintf("%02s",($j + 1))."','')";
					mysql_query($insert);
				}
			}
        }
    }
    
    public function altaTarjetas(){
        for($i = 0; $i < count($this->datos); $i++){
            $tp = array('Repisa Nueva'=>'PLANEADA NUEVA','Tarjetas Nuevas'=>'PLANEADA NUEVA','Remplazo de tarjetas'=>'PLANEADA SUSTITUCION');
            $tipo_movimiento = $tp[$this->datos[$i][22]];
            for($j = 0; $j < $this->datos[$i][17]; $j++){
				$id_tarjeta = $this->genIdTarjeta('admin');
                //$slot = $this->datos[$i][22] == 'Repisa Nueva' ? ($j + 1) : null;
                $insert = "INSERT INTO inventario_tarjetas_acceso(id,id_tarjetas,nombre_oficial_pisa,estatus,tipo_movimiento,tipo_equipo,plan_bb,tipo_tarjeta,codigo_tarjeta,puertos_tarjeta,tabla,proveedor,division,siglas_central,nombre_central,fecha_alta,clase_repisa,login_movimiento,area,repisa) VALUES(id,'".$id_tarjeta."','".$this->datos[$i][21]."','PLANEADO','".$tipo_movimiento."','".$this->datos[$i][12]."','".$this->datos[$i][18]."','".$this->datos[$i][19]."','".$this->datos[$i][20]."','".$this->datos[$i][15]."','".$this->datos[$i][13]."','".$this->datos[$i][25]."','".$this->datos[$i][0]."','".$this->datos[$i][2]."','".$this->datos[$i][3]."',NOW(),'".$this->datos[$i][14]."','admin','".$this->datos[$i][1]."','".$this->datos[$i][24]."')";
                mysql_query($insert);
				if($this->datos[$i][22]=='Tarjetas Nuevas' or $this->datos[$i][22]=='Reemplazo de tarjetas'){
					$update="update isam_unica set proceso_tarjetas=1 where nombre_oficial_pisa='".$this->datos[$i][21]."'";
					mysql_query($update);
				}
            }
        }
    }
}

//$data = new Datos('SS4520140929001');
//$data->equipos();
//$data->altaRepisas();
//$arr = $data->nomof();
//echo '<pre>';
//print_r($arr);
//echo '</pre>';
