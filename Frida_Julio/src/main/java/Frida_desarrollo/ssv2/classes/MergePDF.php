<?php
/**
 * Description of MergePDF
 *
 * @author HP435
 */
//error_reporting(0);
class MergePDF {
    private $folio;
    private $archivo;
    private $destino;
    public function __construct($f){
        $this->folio = $f;
        $a = file_get_contents('http://frida/infinitum/ssv2/pdf/reporte_tmp.php?folio='.$this->folio);
        $this->archivo = file_get_contents('http://10.94.143.193:8082/pdfmerge/servletPDF?file='.$this->folio);
        if($this->archivo != 'Nulo' & $this->archivo != 'Archivo inexistente'){
            $this->lastPDF();
        }
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
    
    private function lastPDF(){
        $origen = '../Archivos/'.$this->archivo;
        $tmp = 'G:\\Archivos\\SiteSurvey\\ReporteSiteSurvey_'.$this->folio.'_tem.pdf';
        $this->destino = 'G:\\Archivos\\SiteSurvey\\'.$this->archivo;
        if(rename($origen,$this->destino)){
            unlink($origen);
            unlink($tmp);
        }
    }
}//$pdf = new MergePDF('SS4520150309001');