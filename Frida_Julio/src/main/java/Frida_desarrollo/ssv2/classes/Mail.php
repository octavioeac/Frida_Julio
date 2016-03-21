<?php
include 'nomad_mimemail.inc.php';

class Mail extends nomad_mimemail{
    const host = '10.192.10.25';
    const user = null;
    const pass = 'Fridainfinitum';
    
    public function __construct($to,$subject,$message,$file,$name){
        parent::__construct();
        $this->set_smtp_host(self::host);
        $this->set_smtp_auth(self::user,self::pass);
        $this->set_from('frida@telmexomsasi.com','FRIDA');
        for($i = 0; $i < count($to); $i++){
            $this->set_to($to[$i]);
            $this->set_subject($subject);
            $this->set_html($message);
            if(isset($file) && isset($name)){
                $this->add_attachment($file, $name);
            }
            $this->send();
           //echo $this->send() == TRUE ? 'Sent' : 'Error';
        }
    }
}

//$mail = new Mail(array('juliocvm243@gmail.com'),'hola','hola','G:\\Archivos\\SiteSurvey\\ReporteSiteSurvey_SS4520150309001.pdf','ReporteSiteSurvey_SS4520150309001.pdf');