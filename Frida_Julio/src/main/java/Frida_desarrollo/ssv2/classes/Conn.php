<?php
/**
 * Description of Conn
 *
 * @author HP435
 */
class Conn{
    private $host = '10.94.143.194';
    private $user = 'infinitum';
    private $pass = 'infinitum2008';
    private $db = 'infinitum_unica';
    public $connect;
    
    public function __construct(){
        $this->connect= mysql_connect($this->host,$this->user,$this->pass);
        mysql_select_db($this->db);
    }
    public function closeConn(){
        mysql_close($this->connect);
    }
}
