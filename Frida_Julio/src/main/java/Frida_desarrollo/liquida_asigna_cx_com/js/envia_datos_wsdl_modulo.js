function envia_datos_wsdl_modulo(ref_sisa){
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

   	    var referenciaSisa=obj.referenciaSisa;
		var bastRemate= obj.bastRemate;
		var clliEdificio= obj.clliEdificio;
        var clliSistema= obj.clliSistema;
		var contactoRemate= obj.contactoRemate;
		var descripcionEdificio= obj.descripcionEdificio;
		var descripcionSistema= obj.descripcionSistema;
		var dispositivo= obj.dispositivo;
		var fechaAsignacion= obj.fechaAsignacion;
		var filaRemate= obj.filaRemate;
		var imt= obj.imt;
		var ladoFilaRemate= obj.ladoFilaRemate;
		//var ladoFilaRemate= obj.ladoFilaRemate;
		var moduloDip= obj.moduloDip;
		var opc= obj.opc;
		var opertel= obj.opertel;
		var razonSocial= obj.razonSocial;
		var repisaRemate= obj.repisaRemate;
		var salaRemate= obj.salaRemate;
		var serie= obj.serie;
		var sestatus= obj.sestatus;
		var sigla= obj.sigla;
		var pisoRemate=obj.pisoRemate;

   var repisa1=repisaRemate;
if(sestatus!=null){  
if(filaRemate<=9)
fila =0+filaRemate;
if(bastRemate<=9)
bastidor =0+bastRemate;
var ubicacion=pisoRemate+"."+salaRemate+filaRemate+ladoFilaRemate+bastRemate+repisa1;
document.getElementById('a_posicion_central').value=ubicacion;
document.getElementById('a_num_modulo').value=moduloDip;
document.getElementById('a_remates').value=contactoRemate;
}
else
{
document.getElementById('a_posicion_central').value='';
document.getElementById('a_num_modulo').value='';
document.getElementById('a_remates').value='';
	
	}
   jq("#button").removeAttr("disabled");	
   
   
  
  		     },
	complete:function()
	         {
				 
		
		//alert("ADIOS");		 
		 
	 	     }	 
	 });  
	
	}
	
function limpia_input(){
	jq("#a_num_modulo").val('');
	jq("#a_posicion_central").val('');
	jq("#a_remates").val('');
	}	
	
	