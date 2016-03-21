
function pop_up_dialog(pop_pup,name){
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
        "Agregar campos": function() {
			envia_ajax()
          jq2( this ).dialog( "close" );
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
	
	





function envia_ajax(){
	
	alert("HOLA CANADA");

	}	
	
	
	