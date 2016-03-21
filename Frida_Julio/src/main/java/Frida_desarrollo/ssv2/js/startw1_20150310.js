var limparAcceso = function(r){
    typeof(r) != 'undefined' ? $('#rubro option:eq(0)').prop('selected',true) : null;
    for(var i = 0; i < 3; i++){
        $('fieldset.nu:eq(0) .two:eq(4)').remove();
    }
    $('fieldset.nu:eq(0) ul,fieldset.nu:eq(0) .two:eq(4),fieldset.nu:eq(1),fieldset.nu:eq(2)').remove();
    $('#noequipos option:eq(0)').prop('selected',true);
    $('#noequipos').attr('disabled','disabled');
    $('#tecnologia,#proveedor').empty();
};
var limparTransporte = function(noequipos,r){
    typeof(r) != 'undefined' ? $('#rubro option:eq(0)').prop('selected',true) : null;
    var f = parseInt(noequipos);
    f = f * 2;
    for(var i = 0; i < f; i++){
        $('fieldset.nu:eq(0) .two:eq(4)').remove();
    }
    $('#noequipos option:eq(0)').prop('selected',true);
    $('#noequipos').attr('disabled','disabled');
    $('#tecnologia,#proveedor').empty();
};
var types = function(i,j){
    var t = [
        $('<input>',{type:'text',name:'nombreEq'+i,value:'Equipo '+i}),
        $('<input>',{type:'text',name:'claseRep'+i,readonly:'readonly'}),
        $('<input>',{type:'text',name:'modelo'+i,readonly:'readonly'}),
        $('<input>',{type:'text',name:'puertos'+i,maxlength:'3',placeholder:'Puertos'}),
        $('<input>',{type:'text',name:'tarjetas'+i,readonly:'readonly'}),
        $('<input>',{type:'text',name:'cdgTarjeta'+i,readonly:'readonly'})
    ];
    return t[j];
};
var LiCreator = function(clase,i,j){
    return $('<li>').append(types(i,j)).addClass(clase);
};
var startSecondUl = function(clase){
    var titulos,ul;
    titulos = ['Nombre','Clase Repisa','Modelo','Puertos','Tarjetas','Código Tarjeta'];
    var clases = ['my ','','','mn ','mn ',''];
    ul = $('<ul>').addClass(clase);
    for(var i = 0; i < 1; i++){
        for(var j = 0; j < 6; j++){
            ul.append($('<li>',{text:titulos[j]}).addClass(clases[j]+'zero'));
        }
    }
    return ul;
};
var AddRemove = function(nom){
    var add,del,hid,ret;
    add = $('<div>',{text:'Agregar'}).addClass('nuevo');
    del = $('<div>',{text:'Remover Último'}).addClass('quitar');
    hid = $('<input>',{type:'hidden',name:nom,value:0});
    return ret = [add,del,hid];
};
var del = function(id){
    $('li#rut'+id+'').remove();
    var no = $('#noemalis').val();
    var numr = id;
    numr = numr.toString();
    if(no === ''){
        no = numr;
    }
    else{
        no = no+'|'+numr;
    }
    $('#noemalis').val(no);
};
var addTransporte = function(noequipos){
    for(var i = 1; i <= noequipos; i++){
        $('fieldset.nu').append(
            $('<div>').append($('<label>',{text:'Equipo '+i}),$('<select>',{name:'modelo'+i,disabled:'disabled'})).addClass('two'),
            $('<div>').addClass('two')
        );
    }
};
$(function(){
    $('#timepicker').timepicker({scrollDefault:'now',timeFormat:'H:i:s'});
    $('#datepicker').datepicker({
        minDate:0,
        inline:true,
        dateFormat:'yy-mm-dd',
        closeText:'Cerrar',
        prevText:'&#x3c;Ant',
        nextText:'Sig&#x3e;',
        currentText:'Hoy',
        monthNames:['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        monthNamesShort:['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
        dayNames:['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
        dayNamesShort:['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
        dayNamesMin:['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;']
    });
    $.ajaxSetup({type:'POST',url:'functions/AjaxLauncher.php',cache:false,dataType:'json'});
    //  VARIABLES GENERALES
        var plan,division,central,rubro,proveedor,tecnologia,modelo,claseRepisa,codTjt,noequipos=0,xobj;
        var d, a, p, v, r, t, nextinput = 0, campo;
        
    //  LLENADO DE COMBO #NOEQUIPOS
    for(var i = 0; i <= 20; i++){
        $('#noequipos').append($('<option>',{value:i,text:i}));
    }
        
    //  LLENADO DE DIVISIÓN DE ACUERDO AL PLAN
    $('#plan').change(function(){
        plan = $(this).val();
        if(plan != ''){
            $('#rubro').val() != '' ? $('#rubro').val() == 'ACCESO' ? limparAcceso(1) : limparTransporte($('#noequipos').val(),1) : null;
            $('#division,#central').empty();
            $('.des').val('');
            $.ajax({
                data:{division:$('input[name=noisivid]').val(),plan:plan},
                success:function(data){
                    $('#division').append($('<option>',{value:'',text:'Seleccionar'}));
                    $.each(data,function(i,v){
                        $('#division').append($('<option>',{value:v,text:v}));
                    });
                }
            });
        }
    });
    
    //  LLENADO DE COMBO CENTRAL
    $('#division').change(function(){
        division = $(this).val();
        if(division != ''){
            $('#central').empty();
            $('.des').val('');
            $('#rubro').val() != '' ? $('#rubro').val() == 'ACCESO' ? limparAcceso(1) : limparTransporte($('#noequipos').val(),1) : null;
            $.ajax({
                data:{div:division,plan:plan},
                success:function(data){
                    $('#central').append($('<option>',{value:'',text:'Seleccionar'}));
                    $.each(data,function(i,v) {
                        $('#central').append($('<option>',{value:v,text:i}));
                    });
                }
            });
        }
    });
    
    //  LLENADO DE DATOS DEL SITIO
    $('#central').change(function(){
        central = $(this).val();
        if(central != ''){
            $('#rubro,#proveedor').removeAttr('disabled');
            $('.des').val('');
            $('#rubro').val() != '' ? $('#rubro').val() == 'ACCESO' ? limparAcceso(1) : limparTransporte($('#noequipos').val(),1) : null;
            $.ajax({
                data:{central:central},
                success:function(data){
                    $.each(data,function(i,v){
                        $('#'+i).val(v);
                    });
                }
            });
        }
    });
    
    //  LLENADO DE TECNOLOGIA
    $('#proveedor').change(function(){
        proveedor = $(this).val();
        if(proveedor != ''){
            $('#tecnologia').empty();
            $('#tecnologia').removeAttr('disabled');
            $.ajax({
                data:{proveedor:proveedor,rbr:rubro,plan:plan},
                success:function(data){
                    $('#tecnologia').append($('<option>',{value:'',text:'Seleccionar'}));
                    $.each(data,function(i,v){
                        $('#tecnologia').append($('<option>',{value:v,text:v}));
                    });
                }
            });
        }
    });
    
    //  LLENADO DE MODELOS
    $('#tecnologia').change(function(){
        tecnologia = $(this).val();
        if(tecnologia != ''){
            var indice = rubro == 'ACCESO' ? '#modelo' : 'select[name^=modelo]';
            $(indice).empty();
            $(indice).removeAttr('disabled');
            $.ajax({
                data:{r:rubro,prov:proveedor,tecnologia:tecnologia,plan:plan},
                success:function(data){
                    $(indice).append($('<option>',{value:'',text:'Seleccionar'}));
                    $.each(data,function(i,v){
                        $(indice).append($('<option>',{value:i,text:v}));
                    });
                }
            });
        }
    });
    
    //  LLENADO DE CLASE DE REPISA
    $('fieldset.nu').on('change','#modelo',function(){
        modelo = $(this).children('option:selected').text();
        if(modelo != ''){
            $('#claseRepisa').empty();
            $('#claseRepisa').removeAttr('disabled');
            $.ajax({
                data:{rb:rubro,prove:proveedor,tec:tecnologia,modelo:modelo,plan:plan},
                success:function(data){
                    $('#claseRepisa').append($('<option>',{value:'',text:'Seleccionar'}));
                    $.each(data,function(i,v){
                        $('#claseRepisa').append($('<option>',{value:v,text:v}));
                    });
                }
            });
        }
    });
    
    //  LLENADO DE CODIGO DE EQUIPO
    $('fieldset.nu').on('change','#claseRepisa',function(){
        claseRepisa = $(this).val();
        if(claseRepisa != ''){
            $('#codigoTarjeta,#tipoTarjeta').empty();
            $('#codigoTarjeta').removeAttr('disabled');
            $.ajax({
                data:{gaan:rubro,verskaffer:proveedor,tegnologie:tecnologia,model:modelo,claseRepisa:claseRepisa,plan:plan},
                success:function(data){
                    codTjt = data;
                    $('#codigoTarjeta').append($('<option>',{value:'',text:'Seleccionar'}));
                    $.each(data,function(i,v){
                        $('#codigoTarjeta').append($('<option>',{value:i,text:i}));
                    });
                }
            });
            //  CREA SEGUNDO Y TERCER FIELDSET
            $.ajax({
                data:{SiglasCentral:$('#siglas').val(),cr:claseRepisa},
                success:function(data){
                    var sf,tf,add,del,hid,agr,bor,ocl,msj;
                    sf = $('<fieldset>').append($('<legend>',{text:'Tarjetas Nuevas'})).addClass('nu'),
                    tf = $('<fieldset>').append($('<legend>',{text:'Remplazo de Tarjetas'})).addClass('nu');
                    if(data.length > 0){
                        add = $('<div>',{text:'Agregar'}).addClass('nuevo');
                        del = $('<div>',{text:'Remover Último'}).addClass('quitar');
                        hid = $('<input>',{type:'hidden',name:'ttlex',value:0});
                        agr = $('<div>',{text:'Agregar'}).addClass('nuevo');
                        bor = $('<div>',{text:'Remover Último'}).addClass('quitar');
                        ocl = $('<input>',{type:'hidden',name:'ttlrt',value:0});
                
                        sf.append(startSecondUl('ex'));
                        sf.append(add,del,hid);
                
                        tf.append(startSecondUl('rt'));
                        tf.append(agr,bor,ocl);
                    }
                    else{
                        sf.append($('<div>').append($('<label>',{text:'No hay equipos disponibles.'}).addClass('hnd')).addClass('one'));
                        tf.append($('<div>').append($('<label>',{text:'No hay equipos disponibles.'}).addClass('hnd')).addClass('one'));
                    }
                    $('fieldset.nu:eq(0)').after(sf,tf);
                }
            });          
        }
    });
    
    //  CARGA DE DATOS EN "TABLA".
    $('fieldset.nu').on('change','#codigoTarjeta',function(){
        var code = $(this).val();
        if(code != ''){
            $('#tipoTarjeta').empty();
            $('#tipoTarjeta').append(codTjt[code]);
            for(var i = 1; i <= noequipos; i++){
                $('input[name=claseRep'+i+']').val(claseRepisa);
                $('input[name=modelo'+i+']').val(modelo);
                $('input[name=cdgTarjeta'+i+']').val(code);
            }
        }
    });
    
    //  CARGA DE DE CLASE REPISA Y MODELO[TIPO_EQUIPO_OFICIAL] EN TARJETAS NUEVAS
    $('form#winone').on('change','select[name^=nom]',function(){
        var idx = ($(this).attr('name')).substring(3);
        var id = $(this).children('option:selected').attr('id');
        $('input[name=claseRep'+idx+']').val(xobj[id][1]);
        $('input[name=modelo'+idx+']').val(xobj[id][2]);
        $.ajax({
            data:{clRps:xobj[id][1],mdl:xobj[id][2]},
            success:function(data){
                $('select[name=cdgTarjeta'+idx+']').empty();
                $('select[name=cdgTarjeta'+idx+']').append($('<option>',{value:'',text:'Seleccionar'}));
                $.each(data,function(i,v){
                    $('select[name=cdgTarjeta'+idx+']').append($('<option>',{value:v,text:v}));
                });
            }
        })
        
    });
    
    
    //  GENERACIÓN DE CAMPOS NECESARIOS PARA ACCESO Y TRANSPORTE
    $('#rubro').change(function(){
        rubro = $(this).val();
        if(rubro != ''){
            //  CONSULTAR Y LLENAR PROVEEDORES COMBO DE PROVEEDORES.
                $.ajax({
                    data:{rubro:rubro,plan:plan},
                    success:function(data){
                        $('#proveedor').append($('<option>',{value:'',text:'Seleccionar'}));
                        $.each(data,function(i,v){
                            $('#proveedor').append($('<option>',{value:v,text:v}));
                        });
                    }
                });
            if(rubro == 'ACCESO'){
                //  ELIMINAR LO QUE EXISTA DE TRANSPORTE
                limparTransporte(noequipos);
                /*  AGREGAR NUEVOS ELEMENTOS    */
                $('#noequipos').removeAttr('disabled');
                $('fieldset.nu:eq(0)').append(
                    $('<div>').append(
                        $('<label>',{text:'Modelo:'}),
                        $('<select>',{name:'modelo',id:'modelo',disabled:'disabled'})
                    ).addClass('two'),
                    $('<div>').append(
                        $('<label>',{text:'Clase de Repisa:'}),
                        $('<select>',{name:'claseRepisa',id:'claseRepisa',disabled:'disabled'})
                    ).addClass('two'),
                    $('<div>').append(
                        $('<label>',{text:'Código de Tarjeta:'}),
                        $('<select>',{name:'codigoTarjeta',id:'codigoTarjeta',disabled:'disabled'})
                    ).addClass('two'),
                    $('<div>').append(
                        $('<label>',{text:'Tipo de Tarjeta:'}),
                        $('<label>',{id:'tipoTarjeta'})
                    ).addClass('two')
                );           
            }
            else if(rubro == 'TRANSPORTE'){
                //  ELIMINAR LO QUE EXISTA DE ACCESO
                limparAcceso();
                $('#noequipos').removeAttr('disabled');
            }
        }
    });
    
    //  AGREGAR "TABLA" DE REPISAS NUEVAS
    $('#noequipos').change(function(){
        var titulos,ul,ttl;
        noequipos = parseInt($(this).val());
        if(rubro == 'ACCESO'){
            titulos = ['Nombre','Clase Repisa','Modelo','Puertos','Tarjetas','Código Tarjeta'];
            $('fieldset.nu:eq(0) ul').remove();
            $('#proveedor option:eq(0)').prop('selected',true);
            $('#tecnologia,#modelo,#claseRepisa,#codigoTarjeta,#tipoTarjeta').empty();
            $('#modelo,#claseRepisa,#codigoTarjeta').attr('disabled','disabled');
            
            ul = $('<ul>');
			if(noequipos > 0){
				for(var i = 0; i <= noequipos; i++){
					var clase = i === 0 ? 'zero' : i % 2 === 0 ? 'blui' : 'blux';
					for(var j = 0; j < 6; j++){
						i === 0 ? ul.append($('<li>',{text:titulos[j]}).addClass(clase)) : ul.append(LiCreator(clase,i,j));
					}
				}
			}
            ttl = $('<input>',{type:'hidden',name:'ttl',value:noequipos});
            $('fieldset.nu:eq(0)').append(ul);
        }
        else if(rubro == 'TRANSPORTE'){
            addTransporte(noequipos);
        }
    });
    
    //  AGREGAR ELEMENTOS A "TABLAS" DE TARJETAS
    $('form#winone').on('click','.nuevo',function(){
        var obj = {ex:['Eq'],rt:['Qe']};
        var prevul = $(this).prev().attr('class');
            var op,optwo,total,clase;
            total = $('input[name=ttl'+prevul+']').val();
            total++;
            clase = total%2 === 0 ? 'i' : 'x';
            op = $('<select>',{name:'nom'+obj[prevul][0]+total});
            optwo = $('<select>',{name:'cdgTarjeta'+obj[prevul][0]+total});
            op.append($('<option>',{value:'',text:'Seleccionar'}));
            $.ajax({
                data:{SiglasCentral:$('#siglas').val(),cr:claseRepisa},
                success:function(data){
                    xobj = data;
                    $.each(data,function(i,v){
                        op.append($('<option>',{value:v[0],text:v[0],id:i}));
                    });
                    $('ul.'+prevul).append(
                        $('<li>').append(op).addClass('my blu'+clase),
                        $('<li>').append($('<input>',{type:'text',name:'claseRep'+obj[prevul][0]+total,readonly:'readonly'})).addClass('blu'+clase),
                        $('<li>').append($('<input>',{type:'text',name:'modelo'+obj[prevul][0]+total,readonly:'readonly'})).addClass('blu'+clase),
                        $('<li>').append($('<input>',{type:'text',name:'puertos'+obj[prevul][0]+total,readonly:'readonly'})).addClass('mn blu'+clase),
                        $('<li>').append($('<input>',{type:'text',name:'tarjetas'+obj[prevul][0]+total,maxlength:'3',placeholder:'Tarjetas'})).addClass('mn blu'+clase),
                        $('<li>').append(optwo).addClass('blu'+clase)
                    );
                }
            });
            $('input[name=ttl'+prevul+']').val(total);
    });
    
    //  ELIMINAR ELEMENTOS A "TABLAS" DE TARJETAS
    $('form#winone').on('click','.quitar',function(){
        var prevul = $(this).prev().prev().attr('class');
        var total = $('input[name=ttl'+prevul+']').val();
        var ini,fin;
        fin = (total * 6) + 6;
        if(total > 0){
            for(var i = 0; i < 7; i++){
                $('ul.'+prevul+' li').eq(fin).remove();
                fin--;
            }
            total--;
            $('input[name=ttl'+prevul+']').val(total);
        }
    });
    
    //  AGREGAR COPIAS DE EMAIL
    $('#agregar').click(function(){
        nextinput++;
        campo = '<li id="rut'+nextinput+'"><label>Nombre </label><input type="text" id="nombre'+nextinput+'" name="nombre'+nextinput+'" /><label class="large">Correo Electr&oacute;nico</label><input type="text" size="20" id="campo' + nextinput + '" name="campo' + nextinput + '"/><div class="close" onclick="del('+nextinput+');"></div></li>';
        $("#campos ul").append(campo);
        $('#emalis').val(nextinput);
        return false;
    });
    
    // VALIDAR PUERTOS CON TARJETAS
    $('fieldset.nu:eq(0)').on('keyup','input[name^=puertos]',function(){
        var pto,regx,n,index;
        pto = $(this).val();
        regx = /^[\d]{1,3}$/;
        n = regx.test(pto);
        index = ($(this).attr('name')).substring(7);
        if(!n){
            $(this).val('');
            $('input[name=tarjetas'+index+']').val('');
        }
        else{
            pto > 768 ? $('input[name=puertos'+index+'],input[name=tarjetas'+index+']').val('') : $('input[name=tarjetas'+index+']').val(Math.ceil(pto/48));
        }
    });
    
    //  REDONDEAR PUERTOS
    $('fieldset.nu:eq(0)').on('blur','input[name^=puertos]',function(){
        var c = $(this).val();
        var m = Math.ceil(c/48);
        c = 48 * m;
        $(this).val(c);
    });
    
    //  REMUEVE CARACTERES RAROS DE PUNTO DE REUNIÓN
    $('#lugar').blur(function(){
        var texto = $(this).val();
        texto = texto.replace(/[^a-zA-Z 0-9.]+/g,'');
        $(this).val(texto);
    });
    
    //  VALIDACIÓN DE TARJETAS Y PUERTOS EN TARJETAS NUEVAS Y REMPLAZO DE TARJETAS
    $('form#winone').on('keyup','input[name^=tarjetas]',function(){
        var id,ind,regx,eva,tjt,integ;
        tjt = $(this).val();
        integ = parseInt(tjt);
        ind = ($(this).attr('name')).substring(8);
        id = $('select[name=nom'+ind+'] option:selected').attr('id');
        regx = /^[\d]{1,3}$/i;
        eva = regx.test(integ);
        if(!eva){
            $(this).val('');
            $('input[name=puertos'+ind+']').val('');
        }
        else{
            integ > xobj[id][4] ? $('input[name=puertos'+ind+'],input[name=tarjetas'+ind+']').val('') : $('input[name=puertos'+ind+']').val(xobj[id][3]*integ);
        }
    });
});