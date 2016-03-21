function check_box_no_requerido_plan(){
	    jq("#Correo_ele").attr("disabled","disabled");	
		jq("#tipo_req").attr("disabled",true);
		jq("#planificador").attr("disabled",true);
	    jq("#edo_acometida").attr("disabled",true);
        jq("#delegacion").attr("disabled",true);
        jq("#fecha_sol_planificacion").attr("disabled",true).removeAttr("isdatepicker");
        jq("#CALBUTTONfecha_sol_planificacion").hide();
		jq("#fecha_rec_planificacion").attr("disabled",true).removeAttr("isdatepicker");
		jq("#CALBUTTONfecha_rec_planificacion").hide();
		jq("#fecha_sol_permisossp").attr("disabled",true).removeAttr("isdatepicker");  
		jq("#CALBUTTONfecha_sol_permisossp").hide();
		jq("#fecha_rec_permiso").attr("disabled",true).removeAttr("isdatepicker");  
		jq("#CALBUTTONfecha_rec_permiso").hide();
		jq("#fecha_entrega_esp_fo").attr("disabled",true).removeAttr("isdatepicker");  
		jq("#CALBUTTONfecha_entrega_esp_fo").hide();
		jq("#fecha_adecuaciones").attr("disabled",true).removeAttr("isdatepicker");  
		jq("#CALBUTTONfecha_adecuaciones").hide();		   
		jq("#estatus_planificacion").attr("disabled",true);
		jq("#no_requerido_plan").attr("value","No_Requerido");
	     jq.ajax({
   	 url:'modulo_alta_fo_prov/requerido_alta_planifica_contru_fo_pro.php',
	 type:'post',
	 data: {'envio2':jq("#no_requerido_plan").val(),
	        'refere':refe=jq("#refere_si").val()
	 },
	 beforeSend:function(){
        var hola2=jq("#no_requerido_plan").val();
		//alert(hola2)
		 },
	success:function(respuesta){

   //alert(respuesta)
		 }
	 });      

	}
	
	
function check_box_no_requerido(){	
   jq("#CALBUTTONfecha_en_fo").hide();
 jq("#pes").attr("readonly",true);
jq("#nco").attr("readonly",true);
jq("#anillo_rof").attr("readonly",true);
jq("#longitud_trab").attr("readonly",true);
jq("#atenuacion_trab").attr("readonly",true);
jq("#longitud_resp").attr("readonly",true);
jq("#atenuacion_resp").attr("readonly",true);
jq("#estatus_const_fo").attr("disabled",true);
jq("#dependencia_construccion").attr("disabled",true);
jq("#supervisor_const").attr("disabled",true); 
jq("#fecha_remate_fo").attr("readonly",true); 
jq("#fecha_en_fo").removeAttr("datepicker").attr("readonly",true).removeAttr("datepicker_format"); 
jq("div").remove(".validation-advice");
jq("#no_requerido").attr("value","No_Requerido");	
}


function checbox_original_no_requerido_plan(){

jq("#Correo_ele").removeAttr("disabled");	
jq("#tipo_req").removeAttr("disabled");
jq("#planificador").removeAttr("disabled");
jq("#edo_acometida").removeAttr("disabled");
jq("#delegacion").removeAttr("disabled");
jq("#fecha_sol_planificacion").attr("datepicker",true).removeAttr("disabled").attr("isdatepicker",true); 
jq("#CALBUTTONfecha_sol_planificacion").show();
jq("#fecha_sol_planificacion").attr("datepicker",true).removeAttr("disabled").attr("isdatepicker",true); 
jq("#CALBUTTONfecha_sol_planificacion").show();
jq("#fecha_rec_planificacion").attr("datepicker",true).removeAttr("disabled").attr("isdatepicker",true); 
jq("#CALBUTTONfecha_rec_planificacion").show();
 jq("#fecha_sol_permisossp").attr("datepicker",true).removeAttr("disabled").attr("isdatepicker",true); 
 jq("#CALBUTTONfecha_sol_permisossp").show();	   
 jq("#fecha_rec_permiso").attr("datepicker",true).removeAttr("disabled").attr("isdatepicker",true); 
 jq("#CALBUTTONfecha_rec_permiso").show();	   
 jq("#fecha_entrega_esp_fo").attr("datepicker",true).removeAttr("disabled").attr("isdatepicker",true); 
 jq("#CALBUTTONfecha_entrega_esp_fo").show();	   
 jq("#fecha_adecuaciones").attr("datepicker",true).removeAttr("disabled").attr("isdatepicker",true); 
 jq("#CALBUTTONfecha_adecuaciones").show();	   
 jq("#estatus_planificacion").removeAttr("disabled");
 jq("#no_requerido_plan").attr("value",null);
     jq.ajax({
   	 url:'modulo_alta_fo_prov/requerido_alta_planifica_contru_fo_pro.php',
	 type:'post',
	 data: {'envio':jq("#no_requerido_plan").val(),
	        'refere':refe=jq("#refere_si").val()
	 },
	success:function(respuesta){
		 }
	 });   
	
	}