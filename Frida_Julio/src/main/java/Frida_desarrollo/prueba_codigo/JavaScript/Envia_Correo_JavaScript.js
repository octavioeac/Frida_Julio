function Envia_Correo_JavaScript(
ref_sisa,
envia_punta,
cliente_comun,
domicilio,
anillo_ref1,
nodo_aceeso,
usuarios_default){
      
   jq.ajax(
	          {
   	   url:'modulo_alta_fo_prov/Envia_MAil_terminado.php',
	   type:'post',
        data: {
			   "referencia_sisa":ref_sisa,
			   "envia_punta":envia_punta,
			   "cliente_comun":cliente_comun,
               "domicilio":domicilio,
	           "anillo_ref1":anillo_ref1,
  			   "nodo_acceso":nodo_aceeso,
			   "usuarios_default":usuarios_default
			   },
	 success:function(respuesta)
	         {
  		     },
	complete:function()
	         {
	  // alert("Correo enviado");
	 	     }	 
	 });      

	
	}
	
	
	
	