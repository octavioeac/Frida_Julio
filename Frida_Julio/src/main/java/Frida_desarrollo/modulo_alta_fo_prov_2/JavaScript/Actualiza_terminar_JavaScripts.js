function actualiza_terminar_refSisa(ref_sisa,envia_punta,termina,valor){
	//alert(ref_sisa+envia_punta+termina+valor);
	 jq.ajax(
					{
					  url:"modulo_alta_fo_prov/imports_update_terminar.php"	,
					  type:'post',
					  data:
						  {
						  "ref_sisa_a":ref_sisa,
						  "envia_punta":envia_punta,
						   "termina":termina,
						   "valor":valor
						  },
					  success:function(respuesta){
//						    alert(respuesta);
						}
						
					}
			);

	}
	
	
	
	
	
	