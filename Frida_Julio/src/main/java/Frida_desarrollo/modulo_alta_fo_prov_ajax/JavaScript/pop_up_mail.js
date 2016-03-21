
function pop_up_dialog_mail(pop_up,name_id,funcion_name,ref_sisa,punta,tabla){
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
					/*var a=jq("#suger_nodo").val();
					var b=jq("#observaciones1").val();
					 envia_ajax(funcion_name,ref_sisa,punta,tabla,b,a);
					*/ jq2( this ).dialog( "close" );
		              jq2(this).dialog('destroy').remove();
	     	 },
           Cancelar: function() {
			   Cerrar_Mail();
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
	
	





	