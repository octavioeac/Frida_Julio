<?php
/**
 * Description of CapturaWDM
 *
 * @author HP435
 */
include 'ConnP.php';    //  PRODUCCION
//include 'ConnD.php';    //  DESARROLLO

class CapturaWDM extends Conn{
    private $proveedor;
    private $wdm;
    private $nodo;
    private $datosTarjetas;
    private $repisa;
    private $slot;
    private $clli;
            
    function __construct(){
        parent::__construct();
    }
		
    public function __get($object){
        if(property_exists($this, $object)){
            return $this->$object;
        }
    }

    public function __set($object,$value){
        if(property_exists($this, $object)){
            $this->$object = $value;
        }
    }
    
    function getProveedores(){
        $datos = array();
        $query = "select proveedor_tx from cat_wdm group by proveedor_tx";
        $result = mysql_query($query);
        while($d = mysql_fetch_row($result)){
            $datos[] = $d;
        }
        return json_encode($datos);
    }
    
    function getWDM(){
        $datos = array();
        $query = "select wdm from cat_wdm where proveedor_tx='".$this->proveedor."' group by wdm order by wdm";
        $result = mysql_query($query);
        while($d = mysql_fetch_row($result)){
            $datos[] = $d;
        }
        return json_encode($datos);
    }
    
    function getNodos(){
        $datos = array();
        $query = "select nodo_adm_conex_adsl from cat_wdm where proveedor_tx='".$this->proveedor."' and wdm='".$this->wdm."'";
        $result = mysql_query($query);
        while($d = mysql_fetch_row($result)){
            $datos[] = $d;
        }
        return json_encode($datos);
    }
    
    private function getDatosGenerales(){
        $query = "select repisa repisa,nodo_adm_conex_adsl nododos,clli_equipo clli,siglas_central siglas,id_nodo idnodo,repadm_conxadsl modelo,version_nodo 'release',ubi_nodo_adm ubicacion,if(ip_sistema='',ip_gestion,ip_sistema) ip,neid neid from cat_wdm where proveedor_tx='".$this->proveedor."' and wdm='".$this->wdm."' and nodo_adm_conex_adsl='".$this->nodo."'";
        $result = mysql_query($query);
        $this->datosTarjetas['gral'] = mysql_fetch_array($result);
        $querydos = mysql_query("SELECT estatus from ordenes where nombre_oficial_pisa='".$this->wdm."'");
        $querydos = mysql_fetch_array($querydos, MYSQL_BOTH);
        $this->datosTarjetas['gral']['estatuswdm'] = $querydos[0];
        $querytres = mysql_query("SELECT estatus from ordenes where nombre_oficial_pisa='".$this->wdm."_".$this->datosTarjetas['gral']['clli']."'");
        $querytres = mysql_fetch_array($querytres, MYSQL_BOTH);
        $this->datosTarjetas['gral']['estatusnodo'] = $querytres[0];
        return json_encode($this->datosTarjetas);
    }
    
    function getDatos(){
        $this->getDatosGenerales();
        //$query = "select repisat,modelo_tarjeta,posicion_tarjeta from inventario_tarjetas_wdm where id_nodo like '%".$this->datosTarjetas['gral']['idnodo']."%'";
        $query = "select repisa,tarjeta,slot from inventario_tarjetas_wdmv2 where clli_origen = '".$this->datosTarjetas['gral']['clli']."'";
        $result = mysql_query($query);
        while($d = mysql_fetch_row($result)){
            $this->datosTarjetas['tjt'][] = $d;
        }
        return json_encode($this->datosTarjetas);
    }
    
    function getPuertos(){
        $datos = array();
        $query = "select puerto_logico,puerto_fisico,frecuencia_lambda,capacidad_pto,IF(alcance_tipo_serv = '','N/A',alcance_tipo_serv) alcance from inventario_puertos_wdmv2 where tipo_tarjeta='MUX' and topologia_wdm_origen='".$this->wdm."' and clli_origen='".$this->clli."' and repisa=".$this->repisa." and slot=".$this->slot;
        $result = mysql_query($query);
        while($d = mysql_fetch_row($result)){
            $datos[] = $d;
        }
        return json_encode($datos);
    }
}