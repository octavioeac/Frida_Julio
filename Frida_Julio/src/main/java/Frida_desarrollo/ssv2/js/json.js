//var datos = new Array();
var cont = 0;
var nombres = new Array();
$(document).ready(function(){
    $.getJSON('json/areas.json',function(result){
      $.each(result, function(i,field){
        $("div").append(field + "<br/>");
        nombres[cont] = field;
        cont++;
      });
      alert(nombres.length);
    });
//    	$.getJSON('json/areas.json',function(source){
//			data = source;
//			showInfo();
//		});
//        function showInfo(){
//	$("#data").append(data['data1']['value']);
// 
//	$.each(data['data2'], function(index, value) {
//		$("#data").append('<p>index: ' + index + ' value1: ' + data['data2'][index]['value1']  + ' value2: ' + data['data2'][index]['value2'] + '</p>');
//	});
//}
});