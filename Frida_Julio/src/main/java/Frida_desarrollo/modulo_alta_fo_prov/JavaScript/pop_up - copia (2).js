
function pop_up_dialog(pop_up,name_id,funcion_name,json_stri,ref_sisa,punta,tabla){
	 var tag = jq2("<div id='pop_up_"+name_id+"'></div>");
	   jq.ajax(
	          {
   	   url:pop_up,
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
        appendTo: "form",
		autoOpen: false,
        resizable: false,
        draggable: false,
        modal: false,
      position: 'absolute',
		height:'auto',
		dialogClass: 'dialogStyle',
		open: function (event, ui) {
	  jq(this).attr('id', name_id);	
	     jq(this).parent().appendTo("formEditName");
     jq(this).css('overflow', 'hidden'); //this line does the actual hiding
  },
	 buttons: {
	       "Actualiza" : function(){ 
					var a=jq("#suger_nodo").val();
					var b=jq("#observaciones1").val();
					 envia_ajax(funcion_name,json_stri,ref_sisa,punta,tabla,b,a);
					alert(a);
					alert(b);
	     	 },
           Cancel: function() {
          jq2( this ).dialog( "close" );
		  jq2(this).dialog('destroy').remove();
              }
	    },
		width:920,
		create: function() {
          
        }
		}
		).dialog('open');
  /*  jq("#enviar_para").click(function(e) {
    var email = jq("#observaciones").val();
     var name = jq("#suger_nodo").val();
	 alert(email);
	   e.preventDefault();
		});    		*/
	
  		     },
	complete:function()
		         {
			 
	 	     }	 
	 });  
	 

	}
	
	





function envia_ajax(funcion_name,json_stri,ref_sisa,punta,tabla,texto,input_text){
/* var texto_tratado=texto.replace(/\\/g, '\\\\').
        replace(/\u0008/g, '\\b').
        replace(/\t/g, '\\t').
        replace(/\n/g, '\\n').
        replace(/\f/g, '\\f').
        replace(/\r/g, '\\r').
        replace(/'/g, '\\\'').
        replace(/"/g, '\\"');*/
/*var uft8=decodeURIComponent(texto_tratado);
alert(uft8);
var strSingleLineText = uft8.replace(new RegExp( "\\n", "g" ));
 
alert( strSingleLineText );*/
	    var string_json='valor_81-'+decodeURIComponent(texto)+',"valor_80-'+input_text+'';
     	   jq.ajax(
	          {
   	   url:"modulo_alta_fo_prov/Generic_querys_POST.php",
	   type:'post',
	  
	   beforeSend : function (){
		   },
        data: {
			"tabla":tabla,
			"json_stri": json_stri,
			"json_string": string_json,
			"ref_sisa":ref_sisa,
			"punta":punta,
			"funcion_name":funcion_name
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
	