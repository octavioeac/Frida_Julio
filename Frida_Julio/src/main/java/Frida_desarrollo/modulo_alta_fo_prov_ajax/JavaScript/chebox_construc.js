function checkbox_construccion_inhabilita(){
	 jq("#pes").attr("readonly",true).removeClass("validation-failed").removeClass("required");
jq("#nco").attr("readonly",true).removeClass("validation-failed").removeClass("required");
jq("#anillo_rof").attr("readonly",true).removeClass("validation-failed").removeClass("required");
jq("#longitud_trab").attr("readonly",true).removeClass("validation-failed").removeClass("required");
jq("#atenuacion_trab").attr("readonly",true).removeClass("validation-failed").removeClass("required");
jq("#longitud_resp").attr("readonly",true).removeClass("validation-failed").removeClass("required");
jq("#atenuacion_resp").attr("readonly",true).removeClass("validation-failed").removeClass("required");
jq("#estatus_const_fo").attr("disabled",true);
jq("#dependencia_construccion").attr("disabled",true);
jq("#supervisor_const").attr("disabled",true); 
jq("#fecha_remate_fo").attr("readonly",true); 
jq("#fecha_en_fo").removeAttr("datepicker").attr("readonly",true).removeAttr("datepicker_format"); 


jq("div").remove(".validation-advice");
jq("#no_requerido").attr("value","No_Requerido");
 jq.ajax({
   	 url:'modulo_alta_fo_prov/requerido_alata_constru_fo_pro.php',
	 type:'post',
	 data: {'envio':jq("#no_requerido").val(),
	        'refere':refe=jq("#refere_si").val()
	 },
	success:function(respuesta){
//   alert(respuesta)
		 }
	 });      


	}
	
	
function checkbox_construccion_habilita(){
		  jq("#CALBUTTONfecha_en_fo").show();		
		   jq("#pes").removeAttr("readonly").addClass("Estilo1 required");
jq("#nco").removeAttr("readonly").addClass("Estilo1 required");
jq("#anillo_rof").removeAttr("readonly").addClass("Estilo1 required");
jq("#longitud_trab").removeAttr("readonly").addClass("Estilo1 required");
jq("#atenuacion_trab").removeAttr("readonly").addClass("Estilo1 required");
jq("#longitud_resp").removeAttr("readonly").addClass("Estilo1 required");
jq("#atenuacion_resp").removeAttr("readonly").addClass("Estilo1 required");
jq("#estatus_const_fo").removeAttr("disabled");
jq("#dependencia_construccion").attr("disabled",true);
jq("#supervisor_const").attr("disabled",true); 
jq("#fecha_remate_fo").removeAttr("readonly");
jq("#fecha_en_fo").removeAttr("readonly").attr("datepicker",true).attr("datepicker_format","YYYY-MM-DD");		
jq("div").remove(".validation-advice");
jq("#no_requerido").attr("value",null);
     jq.ajax({
   	 url:'modulo_alta_fo_prov/requerido_alata_constru_fo_pro.php',
	 type:'post',
	 data: {'envio':jq("#no_requerido").val(),
	        'refere':refe=jq("#refere_si").val()
	 },
	success:function(respuesta){
//   alert(respuesta)
		 }
	 });      
	
	}	
	
	