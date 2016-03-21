function Cerrar_Mail(){
  var Arhivo_cerrar= jq("#iframe_Carga").contents().find('#nombre_archivoAdjunto').html();
 		
	var cuerpo=jq("#cuerpo_correo").val();
	if(cuerpo!=""){
	 var entrar = confirm("Si sale de esta pagina se perdera su mail");
	if(entrar){
        jq("#mails").each(function(){
		jq(this).removeClass("ui-autocomplete-input").val('').addClass("ui-autocomplete-input");
		});
	jq("#cuerpo_correo").each(function(){
		jq(this).val('');
		});	
			if(Arhivo_cerrar!=null){

			jq.ajax(
			{
			  url:"modulo_alta_fo_prov_ajax/borrarArchivoServer.php"	,
			  type:'post',
	        data:{"Archivo_a_borrar":Arhivo_cerrar},
			 success:function(respuesta){
				
				 }
				}
			);
			}		
		jq("#iframe_Carga").contents().find('#informacion_archivo').html(function(){
	  jq("informacion_archivo").remove();

	  });	
		
			jq("#autoco").hide();
jq("#correo_electronico").hide();
	jq("#mail_plani").hide();
		 jq("#destinatarios").attr('checked',false);
	  jq("#CALBUTTONfecha_sol_planificacion").show();
      jq("#CALBUTTONfecha_rec_planificacion").show();
	  jq("#CALBUTTONfecha_sol_permisossp").show();
	  jq("#CALBUTTONfecha_rec_permiso").show();
	  jq("#CALBUTTONfecha_entrega_esp_fo").show();
	  jq("#CALBUTTONfecha_adecuaciones").show();
	  jq("#CALBUTTONfecha_ent_50").show();
  	  jq("#CALBUTTONfecha_en_fo").show();	
	
		
		}
	else{
		self.close();
		
		}
	  		}
	else{
//			alert("cuerpo vacio");	
	jq("#mails").each(function(){
		jq(this).removeClass("ui-autocomplete-input").val('').addClass("ui-autocomplete-input");
		});
	jq("#cuerpo_correo").each(function(){
		jq(this).val('');
		});	
	if(Arhivo_cerrar!=null){
//			alert("Agur");
			jq.ajax(
			{
			  url:"modulo_alta_fo_prov_ajax/borrarArchivoServer.php"	,
			  type:'post',
	        data:{"Archivo_a_borrar":Arhivo_cerrar},
			 success:function(respuesta){
				// alert(respuesta);
				 }
				}
			);
			}
		jq("#iframe_Carga").contents().find('#informacion_archivo').html(function(){
	  jq("informacion_archivo").remove();

	  });
			jq("#autoco").hide();
jq("#correo_electronico").hide();
	jq("#mail_plani").hide();
		 jq("#destinatarios").attr('checked',false);
	  jq("#CALBUTTONfecha_sol_planificacion").show();
      jq("#CALBUTTONfecha_rec_planificacion").show();
	  jq("#CALBUTTONfecha_sol_permisossp").show();
	  jq("#CALBUTTONfecha_rec_permiso").show();
	  jq("#CALBUTTONfecha_entrega_esp_fo").show();
	  jq("#CALBUTTONfecha_adecuaciones").show();
	  jq("#CALBUTTONfecha_ent_50").show();
  	  jq("#CALBUTTONfecha_en_fo").show();	
	 

	
		}
		
	} 		
