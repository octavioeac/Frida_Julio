<?php
/**
 *  Clase encargada de validar un Site Survey en sus distintas estapas 
 *
 * @author HP435
 */
class ValidarSS extends Conn{
    private $estatus;
    private $folio;
    private $flag;
    private $tpVal;
    private $emails;
    private $subject;
    private $rechazo;
    private $observacion;
    private $usr;
    const style = '*{font-family:\'Arial\'}.header{background-color:#4c5a77;background-image:-webkit-linear-gradient(top,#5e6985,#3e4d6c);background-image:-moz-linear-gradient(top,#5e6985,#3e4d6c);background-image:-ms-linear-gradient(top,#5e6985,#3e4d6c);background-image:-o-linear-gradient(top,#5e6985,#3e4d6c);background-image:linear-gradient(top,#5e6985,#3e4d6c);filter:progid:DXImageTransform.Microsoft.Gradient(startColorstr=\'#5e6985\',endColorstr=\'#3e4d6c\');-webkit-box-shadow:0 9px 9px 0 rgba(50,50,50,0.3);-moz-box-shadow:0 9px 9px 0 rgba(50,50,50,0.3);box-shadow:0 9px 9px 0 rgba(50,50,50,0.3);-ms-filter:"progid:DXImageTransform.Microsoft.Shadow(Strength=9,Direction=180,Color=\'#999999\')";filter:progid:DXImageTransform.Microsoft.Shadow(Strength=9,Direction=180,Color=\'#999999\');border-left:1px #3d4569 solid;border-bottom:1px #3d4569 solid;border-right:1px #3d4569 solid;height:92px;width:100%;margin:0 auto 30px;text-align:left;padding:18px 0 0}.header h1{color:#fff;font-weight:100;letter-spacing:-2px;text-decoration:none;padding:0 0 0 3%;margin:0}.header h2{color:#E1C70E;font-size:19px;font-weight:100;letter-spacing:-1px;padding:0 0 0 3%;margin:5px 0 0}p{font-size:12pt;color:#414141}a{color:#08f}.f{font-weight:700;color:red}.m{float:left;width:100%;height:1px;background:#888;margin:0 0 20px}';
    
    public function __construct($folio, $flag, $tpVal, $usr){
        parent::__construct();
        $this->folio = $folio;
        $this->flag = $flag;
        $this->tpVal = $tpVal;
        $this->usr = $usr;
        $this->getEMails();
        $this->getCausaRechazo();
        $this->validar();
        $this->enviarEMail();
    }
    
    private function validar(){
        if($this->flag == 1){
            $this->estatus = $this->tpVal == 1 ? 'VALIDADO OPERACION' : 'VALIDADO';
            $this->observacion = $this->tpVal == 1 ? 6 : 4;
            $this->subject = $this->tpVal == 1 ? 'Site Survey - Validado (OPERACION)' : 'Site Survey - Validado (PROYECTO)';
            
        }
        else{
            $this->estatus = $this->tpVal == 1 ? 'RECHAZADO OPERACION' : 'RECHAZADO';
            $this->observacion = $this->tpVal == 1 ? 7 : 5;
            $this->subject = $this->tpVal == 1 ? 'Site Survey - Rechazado (OPERACION)' : 'Site Survey - Rechazado (PROYECTO)';
        }
        $query = "UPDATE zsite_survey SET estatus='".$this->estatus."',fecha_validacion=NOW() WHERE folio='".$this->folio."'";
        mysql_query($query);
        $ob = new Observaciones($this->folio,$this->observacion,$this->usr);
    }
    
    private function getEMails(){
        $query = "select ctemail,cpemail,rsemail from zsite_survey where folio='".$this->folio."'";
        $this->emails = mysql_fetch_row(mysql_query($query));
        $query = "SELECT email FROM zccemails WHERE folio='".$this->folio."'";
        $result = mysql_query($query);
        while($d = mysql_fetch_row($result)){
            $this->emails[] = $d[0];
        }
    }
    
    private function getCausaRechazo(){
        $query = mysql_query("select causa_rechazo from zsite_survey where folio = '".$this->folio."'");
        $query = mysql_fetch_array($query, MYSQL_BOTH);
        $this->rechazo = $query[0];
    }
    
    private function enviarEMail(){
        if($this->tpVal == 2){
            $pdf = new MergePDF($this->folio);
            $mensaje = '<html><head><style>'.self::style.'</style></head><body><div class="header"><h1>F R I D A</h1><h2>Site Survey</h2></div><p>El Site Survey con el folio <span class="f">'.$this->folio.'</span> fue '.$this->estatus.' <i>'.$this->rechazo.'</i></p></body></html>';
            $mail = new Mail($this->emails,$this->subject,$mensaje,$pdf->destino,$pdf->archivo);
        }
        else{
            $mensaje = array(
                '<html><head><style>'.self::style.'</style></head><body><div class="header"><h1>F R I D A</h1><h2>Site Survey</h2></div><p>El Site Survey con el folio <span class="f">'.$this->folio.'</span> ya fue revisado por el responable en sitio y cambio su estatus a <b>'.$this->estatus.'</b>.</p><p>Para proceder con la validaci&oacute;n, siga el siguiente enlace.</p><a href="http://frida/infinitum/ssv2/formato.php?folio='.$this->folio.'&tv=2">http://frida/infinitum/ssv2/formato.php?folio='.$this->folio.'&tv=2</a><p> En caso de no contar con usuario para acceder al sistema <b>FRIDA</b>, ponganse en contacto con soporte t&eacute;cnico a <a href="mailto:sopfrida1@telmex.com">sopfrida1@telmex.com</a></p></body></html>',
                '<html><head><style>'.self::style.'</style></head><body><div class="header"><h1>F R I D A</h1><h2>Site Survey</h2></div><p>El Site Survey con el folio <span class="f">'.$this->folio.'</span> ya fue revisado por el responable en sitio y cambio su estatus a <b>'.$this->estatus.'</b>.</p></body></html>'
            );
            for($i = 1; $i < count($this->emails); $i++){
                $mail = new Mail(array($this->emails[$i]),$this->subject,$mensaje[1]);
                unset($mail);
            }
            $mail = new Mail(array($this->emails[0]),$this->subject,$mensaje[0]);
            
        }
    }

}