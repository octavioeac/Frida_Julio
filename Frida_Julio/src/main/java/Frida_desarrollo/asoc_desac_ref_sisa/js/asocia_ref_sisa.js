function asocia_ref_sisa(ref_sisa){
	   jq.ajax(
	          {
   	   url:'asoc_desac_ref_sisa/querys_asoc.php',
	   type:'post',
	  
	   beforeSend : function (){
		   },
        data: {
			   "ref_vieja":jq("#ref_sisa_vieja").val(),
			   "ref_nueva":jq("#ref_sisa_nueva").val()
						   },
	 success:function(respuesta)
	         {
       	 alert(respuesta);
				 
  		     },
	complete:function()
	         {
		 
	 	     }	 
	 });  
	
	}
	
