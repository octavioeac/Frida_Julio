function Comprueba_finalizacion_envioMail(ref_sisa,envia_punta,cliente_comun,domicilio,anillo_ref1,nodo_aceeso,usuarios_default){
   //alert(ref_sisa+envia_punta);
    jq.ajax(
					{
					  url:"modulo_alta_fo_prov/imports_terminado_and.php"	,
					  type:'post',
					  data:
						  {
						  "ref_sisa_a":ref_sisa,
						  "punta":envia_punta
						   },
					  success:function(respuesta){
						    if(respuesta==1){
    						//alert("No se envio mail");
							  }
					       else{
							//   alert("SE envio mail");
Envia_Correo_JavaScript(ref_sisa,envia_punta,cliente_comun,domicilio,anillo_ref1,nodo_aceeso,usuarios_default);
							   }		  
						   
						 }
						}
					);

	}
	
	
	
	
	
	