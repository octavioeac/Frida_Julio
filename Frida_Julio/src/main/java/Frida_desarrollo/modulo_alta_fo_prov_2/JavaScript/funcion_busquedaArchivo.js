function busqueda_archivos(ref_sisa,envia_punta,usr){
   	if(usr=="CARSO"){
	 var tipo_proy="PROYECTO 9";
	 var combo="estatus_const_fo";
	 }
	if(usr=="KBTEL"){
	 var tipo_proy="PROYECTO DE FO";
 	 var combo="estatus_planificacion";
		}
  jq.ajax(
					{
					  url:"modulo_alta_fo_prov/imports.php"	,
					  type:'post',
					  data:
						  {
						  "ref_sisa_a":ref_sisa,
						  "punta":envia_punta,
						   "usr":usr
						  },
					  success:function(respuesta){
						    if(respuesta!=1){
    						jq("#"+combo+" option:eq(0)").attr("selected","selected");
							alert("PARA LIQUIDAR CARGUE ARCHIVO "+tipo_proy);
							 jq("#B_mod").attr("disabled","disabled");
							 
							  }
					       else{
							   jq("#B_mod").removeAttr("disabled");
							   //alert("PROYECTO 9 ENCONTRADO");
							   }		  
						   
						 }
						}
					);

	}
	
	
	
	
	
	