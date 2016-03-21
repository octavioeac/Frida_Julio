$(document).ready(function(){
	
	$.ajaxSetup({
		dataType:"json",
		type:"POST",
		url:"cw_datos.php"
	});

	$("#provee").append($('<option>',{text:'HUAWEI'}));
	$("#provee").append($('<option>',{text:'NEC'}));
	$("#provee").append($('<option>',{text:'CIENA'}));
	$("#provee").append($('<option>',{text:'CISCO'}));
	$("#provee").append($('<option>',{text:'ALCATEL LUCENT'}));
	$("#provee").append($('<option>',{text:'ALCATEL'}));

	$("#provee").on('change',function(){
		$("#wdmt").empty();
		var proveWdm = $("#provee").val();
		$.ajax({
			data:{proveWdm:proveWdm},
			success:function(wdm){
				var wdm = wdm;
				$.each(wdm,function(val,key){
					$("#wdmt").append($('<option>',{text:key}));
				});
			}
		})
	});

	$("#wdmt").on('change',function(){
		var catWdm = $("#wdmt").val();
		$()
		$.ajax({
			data:{catWdm:catWdm},
			success:function(mapaWdm){
				var datosWdm = mapaWdm;
			}
		})
	})
});