function 
update_LadaEnlace_tray(elementos,ref_sisa,punta)
{
for (x=0;x<elementos.length;x++)
    {
	   var valu=jq("#"+elementos[x]+"").val();
	  // alert(elementos[x] + valu);
	       
		     jq.ajax({
   	        url:'DAO_actualiza__ladaEnlaces.php',
	        type:'post',
	        data: {
				   "punta":punta,
				   "ref_sisa":ref_sisa,
				   "valor":jq("#"+elementos[x]+"").val(),
				   "id_elemento":elementos[x]		
				   },
	              success:function(respuesta)
				  {
                  		//alert(respuesta)
					
		          }
	            }); 	
	   
     }
	
}
