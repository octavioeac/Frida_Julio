function envia_datos_wsdl(ref_sisa){
	   jq.ajax(
	          {
   	   url:'liquida_asigna_cx_com/datos_wsdl.php',
	   type:'post',
	  
	   beforeSend : function (){
		  // alert("HOLA");
		   },
        data: {
			   "referencia_sisa":ref_sisa
						   },
	 success:function(respuesta)
	         {
       var res=respuesta;
	   var obj = jq2.parseJSON(res);
	   
	     if(obj.ladoFilaRemate==null){
			 alert("Numero de PEP no se encuentre registrado");
			 }
		 	 
   		 
		
		 document.getElementById("bastRemate").value = obj.bastRemate;
		 document.getElementById("clliEdificio").value = obj.clliEdificio;
         document.getElementById("clliSistema").value = obj.clliSistema;
		 document.getElementById("contactoRemate").value = obj.contactoRemate;
		 document.getElementById("descripcionEdificio").value = obj.descripcionEdificio;
		 document.getElementById("descripcionSistema").value = obj.descripcionSistema;
		 document.getElementById("dispositivo").value = obj.dispositivo;
		 document.getElementById("fechaAsignacion").value = obj.fechaAsignacion;
		 document.getElementById("filaRemate").value = obj.filaRemate;
		 document.getElementById("imt").value = obj.imt;
		 document.getElementById("ladoFilaRemate").value = obj.ladoFilaRemate;
		 document.getElementById("ladoFilaRemate").value = obj.ladoFilaRemate;
		 // document.getElementById("lserrores").value = obj.lserrores;
		 document.getElementById("moduloDip").value = obj.moduloDip;
		 document.getElementById("opc").value = obj.opc;
		 document.getElementById("opertel").value = obj.opertel;
		 document.getElementById("razonSocial").value = obj.razonSocial;
		 document.getElementById("repisaRemate").value = obj.repisaRemate;
		 document.getElementById("salaRemate").value = obj.salaRemate;
		 document.getElementById("serie").value = obj.serie;
		 document.getElementById("sestatus").value = obj.sestatus;
		 document.getElementById("sigla").value = obj.sigla;
  
  		     },
	complete:function()
	         {
		
		//alert("ADIOS");		 
		 
	 	     }	 
	 });  
	
	}
	
function clearInputs(){
jq("#bastRemate").val('');
jq("#clliEdificio").val('');
jq("#clliSistema").val('');
jq("#contactoRemate").val('');
jq("#descripcionEdificio").val('');
jq("#descripcionSistema").val('');
jq("#dispositivo").val('');
jq("#fechaAsignacion").val('');
jq("#filaRemate").val('');
jq("#imt").val('');
jq("#ladoFilaRemate").val('');
jq("#refere_si").val('');
jq("#moduloDip").val('');
jq("#opc").val('');
jq("#opertel").val('');
jq("#razonSocial").val('');
jq("#repisaRemate").val('');
jq("#salaRemate").val('');
jq("#serie").val('');
jq("#sestatus").val('');
jq("#sigla").val('');

}
	