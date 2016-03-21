<?php
class Parametros_construccion_fo
{
    private $ref_sisa;
	private $punta;
	private $arrays=array();
	
	public function __construct(
	    $array_columna=array
		(
"columna_0"=>"id", 
"columna_1"=>"ref_sisa", 
"columna_2"=>"punta", 
"columna_3"=>"tabla", 
"columna_4"=>"fecha_solicitud", 
"columna_5"=>"sol_usuario", 
"columna_6"=>"division", 
"columna_7"=>"central_acceso", 
"columna_8"=>"sigcent", 
"columna_9"=>"cm", 
"columna_10"=>"clli_edif", 
"columna_11"=>"area", 
"columna_12"=>"cliente_sisa", 
"columna_13"=>"cliente_comun", 
"columna_14"=>"domicilio", 
"columna_15"=>"etapa_sisa", 
"columna_16"=>"tipo_req", 
"columna_17"=>"edo_acometida", 
"columna_18"=>"fecha_programada", 
"columna_19"=>"ipr_resp_fo", 
"columna_20"=>"sucope_fo", 
"columna_21"=>"supervisor_fo", 
"columna_22"=>"fecha_tramo_afe", 
"columna_23"=>"fecha_dd", 
"columna_24"=>"fecha_asignacion", 
"columna_25"=>"fecha_solicitud_fo", 
"columna_26"=>"planificador", 
"columna_27"=>"fecha_sol_planificacion", 
"columna_28"=>"fecha_rec_planificacion", 
"columna_29"=>"fecha_sol_permisossp", 
"columna_30"=>"fecha_rec_permiso", 
"columna_31"=>"fecha_entrega_esp_fo", 
"columna_32"=>"fecha_adecuaciones", 
"columna_33"=>"delegacion", 
"columna_34"=>"fecha_elab_ot", 
"columna_35"=>"fecha_ent_ot", 
"columna_36"=>"recibe_ot", 
"columna_37"=>"fo_proy_es", 
"columna_38"=>"fecha_ent_50", 
"columna_39"=>"pep", 
"columna_40"=>"pedido45", 
"columna_41"=>"dependencia_proyecto", 
"columna_42"=>"constructor", 
"columna_43"=>"fecha_proyecto", 
"columna_44"=>"estatus_const_fo", 
"columna_45"=>"dependencia_construccion", 
"columna_46"=>"prioridad", 
"columna_47"=>"nco", 
"columna_48"=>"paquete_cons", 
"columna_49"=>"anillo_rof", 
"columna_50"=>"pes", 
"columna_51"=>"atenuacion_trab", 
"columna_52"=>"longitud_trab", 
"columna_53"=>"atenuacion_resp", 
"columna_54"=>"longitud_resp", 
"columna_55"=>"fecha_remate_fo", 
"columna_56"=>"supervisor_const", 
"columna_57"=>"factibilidad", 
"columna_58"=>"observaciones", 
"columna_59"=>"fecha_en_fo", 
"columna_60"=>"validacion_ot", 
"columna_61"=>"ot_fo", 
"columna_62"=>"cons_ot_mes", 
"columna_63"=>"cons_ot", 
"columna_64"=>"nota", 
"columna_65"=>"observaciones_ot", 
"columna_66"=>"responsable_cliente", 
"columna_67"=>"telefono_cliente", 
"columna_68"=>"tipo", 
"columna_69"=>"es_traspasos", 
"columna_70"=>"tipo_fo", 
"columna_71"=>"dispersion", 
"columna_72"=>"estatus_planificacion", 
"columna_73"=>"cons_requerid", 
"columna_74"=>"planifi_requerid", 
"columna_75"=>"bandera_archivos", 
"columna_76"=>"atenuacion_trab2", 
"columna_77"=>"atenuacion_resp2", 
"columna_78"=>"ref_liquidada", 
"columna_79"=>"ref_validacion_Telmex",
"columna_80"=>"nodo_sugerido" ,
"columna_81"=>"observaciones_cambio"  
   ),
		$ref_sisa="ref_sisa",
		$punta="punta"	
	                             )
		{
		$this->arrays=$array_columna;
		$this->ref_sisa=$ref_sisa;
		$this->punta=$punta;
     	}
 
 
    public function __set($parametro,$valor)
	{
 	      if (property_exists($this, $parametro)) 
		  {
 		$this->$parametro = $valor;
 	      }
 	else{
 		echo "Imposible encotrar parametro";
 		 }
	}
 

    public function __get($parametro)
	{
 	 	if (property_exists($this, $parametro)) 
		{
 		return $this->$parametro;
 		}
	 	else
		{
 		echo "no existe propiedad";
 		}
 	}
 
 
 
}

?>