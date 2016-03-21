function mandar_mail_nodo_acceso(valor){
	alert("hola cambio nodo acceso");
	var x;
	var valor_email = new Array();
    for(x=0;x<=7;x++){
          valor_email[x]=jq("#email_"+x+"").val();
		  
         }
var cadena_limpia=limpiar_email_arreglos(valor_email);
   alert(cadena_limpia+valor);

   
   
   
   
   
	}
	
	function actualizar_estatus_nodo(estatus){
				
		}


function limpiar_email_arreglos(valor_email){
var newArray = new Array();
  for( var i = 0, j = valor_email.length; i < j; i++ ){
      if ( valor_email[ i ] ){
        newArray.push( valor_email[ i ] );
    }
  }
  return newArray;
	}	
	
	

	