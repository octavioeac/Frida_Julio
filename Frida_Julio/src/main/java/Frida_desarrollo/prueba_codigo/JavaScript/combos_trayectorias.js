function combo_trayectoria (){
	 jq("#fo_clit_f").find('option').remove().end();
		var par_de_fibra_inicial=jq("#fo_clit_cap").val();
		var par_de_fibra_final=	(par_de_fibra_inicial/2);

				var cont_impar=1;
	            var cont_par=2;
	jq("#fo_clit_f").append("<option value=''>---</option>");			
      for(cont=1; cont<=par_de_fibra_final; cont++){
jq("#fo_clit_f").append("<option value='"+cont_impar+" , "+cont_par+" '> "+cont_impar+" , "+cont_par+" </option>");
	cont_impar=cont_impar+2;
	cont_par=cont_par+2;
	   }
	
	}
	
	function agrega_opciones(){
			jq("#fo_clir_f").find('option').remove().end();
			var par_de_fibra_inicial=jq("#fo_clir_cap").val();
			var par_de_fibra_final=	(par_de_fibra_inicial/2);
			var cont_impar=1;
			var cont_par=2;
			
			jq("#fo_clir_f").append("<option value=''>---</option>");
				
      for(cont=1; cont<=par_de_fibra_final; cont++){
			jq("#fo_clir_f").append("<option value='"+cont_impar+" , "+cont_par+" '> "+cont_impar+" , "+cont_par+" </option>");
			cont_impar=cont_impar+2;
			cont_par=cont_par+2;
	   }
}