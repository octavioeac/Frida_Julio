/*function ArmEquipo(){
	alert("HOLA")
 $('#cnc').submit(function(e){
    e.preventDefault(); // otherwise the form will submit even with errors
    
    // blah blah blah error checking


    $(this).unbind('submit').submit()
});
 
 
 	/*	var id_nodo=$('#clusterId option:selected').val()
var n = id_nodo.indexOf("|");
var m = id_nodo.length
var id_cluste_limpio=id_nodo.slice(0, n-1) 
 var JsonObject={"idEquipo": id_cluste_limpio,
                     "movimiento":"ALTA"
                    };
					 var JsonData=JSON.stringify(JsonObject);
					  $.ajax({
			beforeSend: function(){
				document.cluster.solcns.value=1;submit();
				},			  
          url:'http://10.105.59.73:8082/fridaSendARM/equipo',
          type: "POST",
         dataType:"json",
		 data:JsonData,
         contentType:"application/json",
           success: function(data){
             console.log(data);
     
              
           }
		       });
 

	}*/
	
$("#cns").click(
     function(){
	alert("hola");
	
	});
	
	