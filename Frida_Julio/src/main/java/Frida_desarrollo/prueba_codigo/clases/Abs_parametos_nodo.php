<?php
class Abs_parametros_nodo {
    private $cadena_mail;
    private $usuario;
    private $ref_sisa;
    private $punta;
    private $cliente_comun;
    private $nodo_acceso;
    private $estatus_plan;
    private $domicilio;
    private $anillo_ref1;

    public function __get($propiedad) {
            if (property_exists($this, $propiedad)) {
                return $this->$propiedad;
            }
            else{
            echo "no existe propiedad";	
            }
    }

    public function __set($propiedad, $valor) {
        if (property_exists($this, $propiedad)) {
            $this->$propiedad = $valor;
        }
        else{
        echo "Imposible encotrar parametro";	
        	
        }
    }
}



?>

