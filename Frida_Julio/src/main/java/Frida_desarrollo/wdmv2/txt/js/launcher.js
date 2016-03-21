$(function(){
    $('#accordion').accordion();
	
    var proveedor,wdm,nodo;
    
    $.ajaxSetup({type:"POST", url:"datosWDM.php", cache:false, dataType:"json"});
    
    $.ajax({
        success:function(data){
            $.each(data,function(i,v){
                $('#proveedor').append($('<option>',{value:v,text:v}));
            });
        }
    });
    
    //  PROVEEDOR
    $('#proveedor').change(function(){
        proveedor = $(this).val();
        if(proveedor !== '-'){
            $('#repisa,#nododos,#clli,#siglas,#idnodo,#modelo,#release,#ubicacion,#ip,#neid').val('');
            $('#wdm,#nodo').empty();
            $('#wdm,#nodo').attr('disabled','disabled');
            $('.tarjetas,.puertos').empty();
            $.ajax({
                data:{proveedor:proveedor},
                success:function(data){
                    $('#wdm').append($('<option>',{value:'-',text:'Seleccionar'}));
                    $('#wdm').removeAttr('disabled');
                    $.each(data,function(i,v){
                        $('#wdm').append($('<option>',{value:v,text:v}));
                    });
                }
            });
        }
    });
    
    //  WDM
    $('#wdm').change(function(){
        wdm = $(this).val();
        if(wdm !== '-'){
            $('#repisa,#nododos,#clli,#siglas,#idnodo,#modelo,#release,#ubicacion,#ip,#neid').val('');
            $('#nodo').empty();
            $('#nodo').attr('disabled','disabled');
            $('.tarjetas,.puertos').empty();
            $.ajax({
                data:{wdm:wdm,prov:proveedor},
                success:function(data){
                    $('#nodo').append($('<option>',{value:'-',text:'Seleccionar'}));
                    $('#nodo').removeAttr('disabled');
                    $.each(data,function(i,v){
                        $('#nodo').append($('<option>',{value:v,text:v}));
                    });
                }
            });
        }
    });
    
    //  NODO
    $('#nodo').change(function(){
        nodo = $(this).val();
        if(nodo !== '-'){
            $('#repisa,#nododos,#clli,#siglas,#idnodo,#modelo,#release,#ubicacion,#ip,#neid').val('');
            $('.tarjetas,.puertos').empty();
            $.ajax({
                data:{nodo:nodo,nwdm:wdm,pro:proveedor},
                success:function(data){
                    $.each(data.gral,function(i,v){
                       $('#'+i).val(v);
                    });
                    if(typeof(data.tjt) !== 'undefined'){
                        $.each(data.tjt,function(i,v){
                            $.each(v,function(si,sv){
                               $('.tarjetas').append($('<div>',{class:'four',text:sv}));
                            });
                            $('.tarjetas').append($('<div>',{class:'four erase'}));
                        });
                    }
                    else{
                        $('.tarjetas').append($('<div>',{class:'one',text:'Sin tarjetas'}));
                    }
                }
            });
        }
    });
    
    //  PARA CAMBIAR COLOR DE FONDO MIENTRAS SE COLOCA EL MOUSE.
    $('.tarjetas').on('mouseenter','div',function(){
        var inx,ini,i;
        inx = $(this).index();
        ini = Math.floor(inx/4);
        ini *= 4;
        for(i = ini; i < (4 + ini); i++){
            $('.tarjetas div').eq(i).addClass('yellow');
        }
    });
    $('.tarjetas').on('mouseleave','div',function(){
        $('.tarjetas div').removeClass('yellow');
    });
    
    //  RECUPERAR PUERTOS POR TARJETAS
    $('.tarjetas').on('click','div',function(){
        if(!($(this).hasClass('erase'))){
            var ini,repisa,slot;
            ini = Math.floor(($(this).index())/4);
            ini *= 4;
            repisa = $('.tarjetas div').eq(ini).text();
            slot = $('.tarjetas div').eq(ini+2).text();
            $('.puertos').empty();
            $.ajax({
                data:{repisa:repisa,slot:slot,twdm:wdm,clli:$('#clli').val()},
                success:function(data){
                    if(data.length > 0){
                        $.each(data,function(i,v){
                            $.each(v,function(si,sv){
                                $('.puertos').append($('<div>',{class:'six',text:sv}));
                            });
                            $('.puertos').append($('<div>',{class:'six erase'}));
                        });
                    }
                    else{
                        $('.puertos').append($('<div>',{class:'one',text:'Sin puertos'}));
                    }
                }
            });
        }
    });
});