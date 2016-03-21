
function pop_up_dialog(pop_pup,name){
		var ref_sisa="TKS-1211-0295";
	 var tag = jq2("<div id='pop_up_'"+name+"></div>");
	   jq.ajax(
	          {
   	   url:pop_pup,
	   type:'post',
	  
	   beforeSend : function (){
		  // alert("HOLA");
		   },
        data: {
			   
						   },
	 success:function(respuesta)
	         {
   /* var x=window.open('', '', 'titlebar=no,scrollbars=no,,location =no,menubar=no,height='+100+',width='+100+',resizable=no,toolbar=no,location=no,status=no,left='+100+',top='+100+'');
        x.document.open();
        x.focus();
        x.document.write(respuesta);*/
		   tag.html(respuesta).dialog({
        autoOpen: false,
        resizable: false,
       draggable: false,
        modal: true,
		height:'auto',
		dialogClass: 'dialogStyle',
		open: function (event, ui) {
     jq(this).css('overflow', 'hidden'); //this line does the actual hiding
  },
	 buttons: {
        "Consulta": function() {
		
		envia_datos_wsdl(ref_sisa);
   //       jq2( this ).dialog( "close" );
        },
        Cancel: function() {
          jq2( this ).dialog( "close" );
        }
	    },
		width:920
		}
		).dialog('open');
		   

  		     },
	complete:function()
	
	         {
		
		
		 
	 	     }	 
	 });  
	
	}
	
	



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
			 alert("La referencia sisa :"+ref_sisa+"no se localizo");
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
	
	
	