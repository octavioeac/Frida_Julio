<?php
class Observaciones extends Conn{
    private $observaciones = array(
        'Se ha propuesto una realizaci&oacute;n de Site Survey.',
        'La fecha de realizaci&oacute;n del Site Survey fue validada correctamente.',
        'El Site Survey ha comenzado a ser capturado.',
        'El Site survey ha sido mandado a validaci&oacute;n.',
        'El Site Survey fue validado exitosamente.',
        'El Site Survey fue rechazado.',
        'El Site Survey fue validado exitosamente por operaci&oacute;n.',
        'El Site Survey fue rechazado por operaci&oacute;n.'
    );
    private $folio;
    private $user;
            
    function __construct($f,$o,$u){
        parent::__construct();
        $this->folio = $f;
        $this->user = $u;
        $this->observacion($o);
    }
    
    private function observacion($ob){
        $insert = "INSERT INTO zbitacora VALUES(id,'".$this->folio."',NOW(),'".$this->user."',(SELECT version FROM zsite_survey WHERE folio='".$this->folio."'),'".$this->observaciones[$ob]."')";
        mysql_query($insert);
    }
}
class NuObser extends Conn{
    private $folio;
    private $user;
    function __construct($observ,$folio,$user){
        parent::__construct();
        $this->folio = $folio;
        $this->user = $user;
        $this->observacion($observ);
    }
    private function observacion($ob){
        $ob = trim(preg_replace('/[^a-zA-Z 0-9.\náéíóúÁÉÍÓÚñÑüÜ,;\/\.\&]+/', '', $ob));
        $insert = "INSERT INTO zbitacora VALUES(id,'".$this->folio."',NOW(),'".$this->user."',(SELECT version FROM zsite_survey WHERE folio='".$this->folio."'),'".$ob."')";
        mysql_query($insert);
    }
}