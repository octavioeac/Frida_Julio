
function pop_up_dialog(pop_up,name_id,funcion_name,ref_sisa,punta,tabla){
	 var tag = jq2("<div id='pop_up_"+name_id+"'></div>");
	   jq.ajax(
	          {
   	   url:pop_up,
	   type:'post',
	  
	   beforeSend : function (){
		   },
        data: {
			   
						   },
	 success:function(respuesta)
	         {
	
		   tag.html(respuesta).dialog({
        appendTo: "form",
		autoOpen: false,
        resizable: false,
        draggable: false,
        modal: true,
      position: 'absolute',
		height:'auto',
		dialogClass: 'dialogStyle',
		open: function (event, ui) {
	
	  jq(this).attr('id', name_id);	
    	jq(this).css({background:'#D3D5D4',
		  	border: "1px solid #dddddd",
         	color: "#333333"});	
	  	     jq(this).parent().appendTo("formEditName");
     jq(this).css('overflow', 'hidden'); 
   },
	 buttons: {
	       "Actualiza" : function(){ 
					var a=jq("#suger_nodo").val();
					var b=jq("#observaciones1").val();
					 envia_ajax(funcion_name,ref_sisa,punta,tabla,b,a);
					 jq2( this ).dialog( "close" );
		              jq2(this).dialog('destroy').remove();
	     	 },
           Cancelar: function() {
          jq2( this ).dialog( "close" );
		  jq2(this).dialog('destroy').remove();
              }
	    },
		width:920,
		create: function() {
          
        }
		}
		).dialog('open');
   		     },
	complete:function()
		         {
			 
	 	     }	 
	 });  
	 

	}
	
	





function envia_ajax(funcion_name,ref_sisa,punta,tabla,texto,input_text){
     	   jq.ajax(
	          {
   	   url:"modulo_alta_fo_prov/Generic_querys_POST.php",
	   type:'post',
	  
	   beforeSend : function (){
		   },
        data: {
			"tabla":tabla,
			"ref_sisa":ref_sisa,
			"punta":punta,
			"funcion_name":funcion_name,
			"80":input_text,
			"81":texto
           				 },
	 success:function(respuesta)
	         {
  
  		     },
	complete:function()
	
	         {
		
		
		 
	 	     }	 
	 });  

	}	
	
	
	
	
	function eliminar(texto, valor) {
return texto.replace("\n" + valor, "");
}
	