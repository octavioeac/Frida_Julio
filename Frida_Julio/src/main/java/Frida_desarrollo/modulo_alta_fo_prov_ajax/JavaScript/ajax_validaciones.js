function comprobar_campos_pes_pep_etc(tabla,ref_sisa,punta,funcion_name,array_type,pos6){
   jq.ajax(
	          {
   	   url:"modulo_alta_fo_prov_ajax/components/Genericos_querys_mapper_POST.php",
	   type:'post',
	  
	   beforeSend : function (){
		   },
        data: {
			"tabla":tabla,
			"ref_sisa":ref_sisa,
			"punta":punta,
			"funcion_name":funcion_name,
			"tipo_array":array_type,
			"6":pos6
			},
	 success:function(respuesta)
	         {

       var res=respuesta;
	   var obj = jq2.parseJSON(res);
	   if(obj!=false)
	   {
	jq2("#hola_span").css( {"display":"inline", "color":"#F00000"} ).html("N&uacute;mero PEP valido").fadeOut( 8000 );	   
	   }
	   else{
	jq2("#hola_span").css( {"display":"inline", "color":"#3300CC"} ).html("N&uacute;mero PEP no valido").fadeOut( 8000 );	   
		   }
	 	     },
	complete:function()
	
	         {
	 
	 	     }	 
	 });  
/*	  if(campo=="PEP"){
	   var ajaxData = {                        
            "tabla":tabla,
			"ref_sisa":ref_sisa,
			"punta":punta,
			"funcion_name":funcion_name,
			"tipo_array":array_type,
			"6":array['6']
			 };
	  }
*/  
	}
	
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function comprobar_campos_pedido45_a(tabla,ref_sisa,punta,funcion_name,array_type,pos7){
    	   jq.ajax(
	          {
   	   url:"modulo_alta_fo_prov_ajax/components/Genericos_querys_mapper_POST.php",
	   type:'post',
	  
	   beforeSend : function (){
		   },
        data:{
			"tabla":tabla,
			"ref_sisa":ref_sisa,
			"punta":punta,
			"funcion_name":funcion_name,
			"tipo_array":array_type,
			"7":pos7
			},
	 success:function(respuesta)
	         {

       var res=respuesta;
	   var obj = jq2.parseJSON(res);
	   
	   if(obj!=false)
	   {
	jq2("#hola_span2").css( {"display":"inline", "color":"#F00000"} ).html("Pedido 45 valido").fadeOut( 8000 );	   
	   }
	   else{
	jq2("#hola_span2").css( {"display":"inline", "color":"#3300CC"} ).html("Pedido 45 no valido").fadeOut( 8000 );	   
		   }
	       },
	complete:function()
	         {
	 	     }	 
	 });  


	
	}