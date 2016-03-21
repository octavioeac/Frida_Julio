var univid;
var multipar = [0,0,0];
var check = [];
var ant = [];

var nivel = function(nombre){
    var eval = $('input[name='+nombre+']').val();
    var regex = /^[A-Z]{1}$/i;
    if((!regex.test(eval)) && eval !== ''){
        alert('No valido');
        $('input[name='+nombre+']').val('');
    }
    else{
        $('input[name='+nombre+']').val(eval.toUpperCase());
    }
};
var vertical = function(nombre){
    var eval = $('input[name='+nombre+']').val();
    var regex = /^\b(0*(?:[1-9][0-9]?|300))\b$/i;
    if((!regex.test(eval)) && eval !== ''){
        alert('No valido');
        $('input[name='+nombre+']').val('');
    }
};
var puertos = function(nombre){
    var eval = $('input[name='+nombre+']').val();
    //var regex = /^(\b(0*(?:[1-9][0-9]?|768))\b){1,3}-(\b(0*(?:[1-9][0-9]?|768))\b){1,3}$/i;
    var regex = /^[0-9]{1,3}-[0-9]{1,3}$/i;
    if((!regex.test(eval)) && eval !== ''){
        alert('No valido');
        $('input[name='+nombre+']').val('');
    }
};
var conaletas = function(folio){
        $.post('functions/VerCanaletas.php',{folio:folio},function(data){
            $.c = 0; $.d = 0;
            $.sup = ['sfo','mfo','mmp','mcx','mgs','mft'];
            $.sub = ['slc','nux','sat','hei','len','inc','dwn','adw'];
            $.each(data,function(i,v){
                $.v = 8 * $.d;
                $.v = i - $.v;
                if($.v < 3 || $.v === 5 || $.v === 7){
                    $('select[name='+$.sup[$.d]+$.sub[$.v]+'] option:eq('+v+')').prop('selected',true);
                }
                else{
                    $('input[name='+$.sup[$.d]+$.sub[$.v]+']').val(v);
                }
                $.c++;
                if($.c === 8){
                    $.d++;
                    $.c = 0;
                }
            });
        /*var rel = {2:'afo',3:'bfo',4:'mtp',5:'cxl',6:'gys',7:'fza'};
        var op = [
            {0:0,4:1,6:2,12:3,24:4,36:5},
            {0:0,16:1},
            {0:0,8:1,16:2},
            {0:0,2:1,6:2}
        ];
        $.each(data,function(i,v){
            if(i == 0){
                $('#'+rel[tag]+'cm').append(v[6]);
            }
           if(v[0] == 1){
               $('input[name='+rel[tag]+'k'+i+']').prop('checked',true);
               $('select[name='+rel[tag]+'s'+i+'],input[name='+rel[tag]+'he'+i+'],input[name='+rel[tag]+'lg'+i+'],select[name='+rel[tag]+'in'+i+'],select[name='+rel[tag]+'dw'+i+']').removeAttr('disabled');
               $('select[name='+rel[tag]+'s'+i+'] option:eq('+v[1]+')').prop('selected',true);
               $('input[name='+rel[tag]+'he'+i+']').val(v[2]);
               $('input[name='+rel[tag]+'lg'+i+']').val(v[3]);
               $('select[name='+rel[tag]+'in'+i+'] option:eq('+op[i][v[4]]+')').prop('selected','selected');
               $('select[name='+rel[tag]+'dw'+i+'] option:eq('+v[5]+')').prop('selected','selected');
           }
        });*/
    });
};
function popitup(url,tipo){
    newwindow=window.open(url,'name','height=150,width=1100'); 
    if (window.focus){
        newwindow.focus();
    }
    return false;
}
var pad = function(str, max) {
    str = str.toString();
    return str.length < max ? pad("0"+str,max) : str;
};
var remate = function(id){
    var elem,val,regexp,a_val;    
    elem = document.getElementById(id);    
    a_val = val = elem.value;
    regexp = /^\d{1,2}$/i;
    if(regexp.test(val)){
        a_val++;
        elem.value = pad(val,2)+'.'+pad(a_val,2);
    }
    else{
        regexp = /^\d{1,2}\.\d{1,2}$/i;
        if(!regexp.test(val)){
            elem.value = '';
            alert('Remate no valido');
        }
    }
};
var tipoFolio = function(data){
    if(data === 'POR VALIDAR' || data === 'VALIDADO OPERACION'){
        $('.help').css({opacity:'.3',cursor:'auto'});
        $('.help').removeAttr('onclick');
        $('input[type=text],input[type=radio],input[type=checkbox],select,textarea,button[name$=inter],button[name$=_loader],#fz_configplanta').attr('disabled','disabled');
        $('#fz_configplanta').attr('disabled');
        $('.dt').hide();
        $('.dl').hide();
        $('.dsc').hide();
        $('#guardar').attr('action','cerrarss.php');
        $('#save').removeAttr('disabled');
        $('#save').val('Rechazar');
        $('#enviar').removeAttr('disabled');
        $('#enviar').val('Validar');
        $('#flag').removeAttr('disabled');
        $('#folio').removeAttr('disabled');
        $('#causa_rechazo').removeAttr('disabled');
        $('#cr').removeAttr('disabled');
        $('table#email').hide();
        $('#exportPDF').show();
        $('#exportPDF').removeAttr('disabled');
    }
    else if(data === 'VALIDADO'){
        $('#guardar :input').attr('disabled', true);
        $('#fz_configplanta').attr('disabled');
        //$('.estatus').removeAttr('style');
        $('.estatus').css('background','#0c0');
        $('.dt').hide();
        $('.dl').hide();
        $('.dsc').hide();
        $('table#email').hide();
        $('#exportPDF').show();
        $('#exportPDF').removeAttr('disabled');
    }
    else if(data === 'RECHAZADO'){
        //$('.estatus').removeAttr('style');
        $('.estatus').css('background','#f00');
        $('table#email').hide();
        $('#exportPDF').show();
        $('#exportPDF').removeAttr('disabled');
    }
};

function textCounter(field,countfield,maxlimit){
    if (field.value.length > maxlimit) 
        field.value = field.value.substring(0, maxlimit);
    else 
    countfield.value = maxlimit - field.value.length;
}

function popup(url, ancho, alto){
    var posicion_x; 
    var posicion_y; 
    posicion_x=(screen.width/2)-(ancho/2); 
    posicion_y=(screen.height/2)-(alto/2); 
    window.open(url, "popup", "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+"");
}

function check(a){
    var c = document.getElementById(a).checked;
    if(c === true){
        $('input[name="_'+a+'"]').val('PEND.');
        $('input[name="_'+a+'"]').attr('disabled','disabled');
        $('input[name="_'+a+'"]').css({'color':'#555','background-color':'#eee'});
    }
    else{
        $('input[name="_'+a+'"]').val('');
        $('input[name="_'+a+'"]').removeAttr('disabled');
        $('input[name="_'+a+'"]').css({'color':'#000','background-color':'#fff'});
    }
}
function blurval(g){
    var flag=0;var numbers=new Array(0,1,2,3,4,5,6,7,8,9);/*var or_rango=$('input[name="_'+g+'"]').val();*/var search_rango=0;if(or_rango.length>2){search_rango=or_rango.indexOf('-');if(search_rango===-1){alert('Esta candena no tiene guion separador.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else{if(search_rango===0||search_rango===4){alert('El guion no puede ir en esa posición.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else{var subuno=or_rango.substring(0,search_rango);var subdos=or_rango.substring(search_rango+1,5);if(isNaN(subuno)===true){alert('Su cadena no es númerica.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else if(subuno==0||subuno==00||subuno>99){alert('Solo puede escribir numeros del 1 al 99.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else{if(isNaN(subdos)===true){alert('Su cadena no es númerica.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else if(subdos==0||subdos==00||subdos>99){alert('Solo puede escribir numeros del 1 al 99.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else{if(subuno.length===1){for(var i=0;i<=9;i++){if(numbers[i]==subuno){subuno='0'+subuno;break}}}if(subdos.length===1){for(var i=0;i<=9;i++){if(numbers[i]==subdos){subdos='0'+subdos;break}}}$('input[name="_'+g+'"]').val(subuno+'-'+subdos);flag=1}}}}}else{if(or_rango===''||or_rango==0||or_rango==00){alert('Favor de ingresar un valor en el campo que no sea cero ni letra.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else{if(or_rango.length===1){if(isNaN(or_rango)==true)alert('Por favor digite un numero entre el  1 y el 99.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.');else{for(var i=0;i<=9;i++){if(numbers[i]==or_rango){$('input[name="_'+g+'"]').val('0'+or_rango);break}}flag=1}}else{if(isNaN(or_rango)==true){alert('Por favor digite un numero entre el  1 y el 99.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else{flag=1}}}}
}
function blurletter(k){
    var flag2=0;var letras=$('input[name="_'+k+'"]').val();if(letras===''){alert('Dejo el campo vacio\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else{var busca_guion=letras.indexOf('-');if(busca_guion===-1&&letras.length>1){alert('Su cadena esta mal formada\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else if(busca_guion===0||busca_guion===2){alert('El guion no puede ir en esa posición\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else if(letras.length==1){if(isNaN(letras)==false){alert('Introduzca solo letras por favor\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else{flag2=1}}else if(letras.length>1){var letrauno=letras.substring(0,busca_guion);var letrados=letras.substring(busca_guion+1,3);if(isNaN(letrauno)==false){alert('Solo puede ingresar letras\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}if(isNaN(letrados)==false){alert('Solo puede ingresar letras\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else if(letrados==''||letrados==' '){alert('Su rango no puede terminar en guion\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else if(letrauno==' '){alert('Su rango no puede empezar en blanco\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else{$('input[name="_'+k+'"]').val(letrauno+'-'+letrados);flag2=1}}if(flag2===0){$('input[name="_'+k+'"]').val('')}}
}
function dt(ie){
    var reg = /^i|f/i;
    var id = reg.test(ie) ? ie.substring(1) : ie;
    id = parseInt(id);
    $.post('functions/eliminar.php',{id:id},function(data){
        $('li#'+ie).remove();
        Shadowbox.clearCache();
        Shadowbox.setup();
    });
 }
 function addesc(id){
     $('#descripcion').dialog('open');
     univid = id;     
 }

function quit(i){
    $('tr#'+i).remove();
}
$(document).ready(function(){
    //  REMUEVE CARACTERES RAROS DE PUNTO DE REUNIÓN
    $('textarea').blur(function(){
        var texto = $(this).val();
        texto = texto.replace(/[^a-zA-Z 0-9.\náéíóúÁÉÍÓÚñÑüÜ,;\/\.\&]+/g,'');
        $(this).val(texto);
    });
    $('input[class^=kz]').blur(function(){
        var val = $(this).val();
        var name = $(this).attr('name');
        var decimal = /^\d|\d+(\.\d)$/;
        if((!(decimal.test(val))) && val !== ''){
            $('input[name='+name+']').val('');
            alert('Solo admite numeros');
        }
    });
    /*  --- INICIALIZA TABS --- */
    var ag = false;
    var t = [1,2,3,4,5,6,7,8];
    var r = [];
    var cntd = 0;
    $.post('functions/habilitada.php',{folio:$('#folio').val()},function(data){
        var tm = data.length;
        var can = {1:'sfo',2:'mfo',3:'mmp',4:'mcx',5:'mgs',6:'mft'};
        for(var i = 0; i < 8; i++){
            var asd = 0;
            for(var j = 0; j < tm; j++){
                if(t[i] == data[j]){
                    break;
                }
                else{
                    asd++;
                }
            }
            if(asd == tm){
                var tmpn = t[i];
                tmpn--;
                r[cntd] = tmpn;
                cntd++;
            }
        }
        for(var i = 0; i < r.length; i++){
            $('.'+can[r[i]]).hide();
        }
        $("#tabs").tabs({disabled:r});
    });
    /*  --- INICIALIZA DATEPICKER   --- */
    $('#datepicker').datepicker({
        inline:true,
        dateFormat:'yy-mm-dd',
        closeText: 'Cerrar',
        prevText: '&#x3c;Ant',
        nextText: 'Sig&#x3e;',
        currentText: 'Hoy',
        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
        dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
        dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
        maxDate:0
    });
    /*  --- INICIALIZA DIALOG   --- */
    $('#descripcion').dialog({
        autoOpen:false,
        modal:true,
        height:200,
        width:350,
        show:{effect:'blind',duration:1000},
        hide:{effect:'explode',duration:1000}
    });
    $('#ejecucion').dialog({
        autoOpen:false,
        modal:true,
        height:200,
        width:350,
        show:{effect:'blind',duration:1000},
        hide:{effect:'explode',duration:1000}
    });
    $('#rechazo').dialog({
        autoOpen:false,
        modal:true,
        height:200,
        width:350,
        show:{effect:'blind',duration:1000},
        hide:{effect:'explode',duration:1000}
    });
    $('#bitacora').dialog({
        autoOpen:false,
        modal:true,
        height:300,
        width:500,
        show:{effect:'blind',duration:1000},
        hide:{effect:'explode',duration:1000}
    });
    
    tipoFolio($('#estatus_ss').val());
    
    var f = $('#folio').val();
    var patron = /_coment/i;
    $.post('functions/genJSON.php',{folio:f},function(getjson){
        //alert(getjson.opticoBajoOrden['dwfo_tipo_bastidor_fibra']);
        if(getjson.opticoAltoOrden.fo_bastidor_fibra == 'Nuevo'){
            $('#tpesfo').show();
        }
        if(getjson.opticoBajoOrden.dwfo_bastidor_fibra == 'Nuevo'){
            $('#tpesdwfo').show();
        }
        if(getjson.multipar.mp_ampvertical == 'Si'){
            $('#spdsp').show();
        }
        if(getjson.coaxial.cx_escalerilla_bdtd == 'Nuevo'){
            $('#tpescx').show();
        }
        if(getjson.multipar.mp_disgral == '9 y 11.5 dos lados versablock'){
            ant = [3,'9 y 11.5 dos lados versablock','9mpd2',256];
        }
        else if(getjson.multipar.mp_disgral == '7 y 9 un lado versablock'){
            ant = [3,'7 y 9 un lado versablock','9mpd1',256];
        }
        else if(getjson.multipar.mp_disgral == '5 y 10 niveles portasystem'){
            ant = [8,'5 y 10 niveles portasystem','9mpd2',100];
        }
        else{
            var rx = /^Otro_/i;
            if(rx.test(getjson.multipar.mp_disgral)){
                ant = [0,'Otro','9mpdo'];
            }
            else{
                ant = [1,'','',0];
            }
        }
        changeValFza(getjson.fuerza.fz_tp_alimen);
        $.each(getjson, function(i){
            $.each(getjson[i], function(j, value){
            var eva;
            eva = j.match(patron);
            if(eva === 'null' || eva === null){
                var patron2 = /^Otro_/i;
                if(value != null){
                    var eva2 = value.match(patron2);
                if(eva2 == 'Otro_'){
                    var valor = value.substring(5);
                    var otro = value.substring(0,4);
                    $("input[name='"+j+"'][value='"+otro+"']").prop("checked",true);
                    $('#'+j+'_ot').val(valor);
                    $('#'+j+'_ot').removeAttr('disabled');
                    $('#'+j+'_ot').css({'background-color':'#fff','font-weight':'bold','color':'#000'});
                }
                else{
                    var patron3 = /^-/;
                    var eva3 = j.match(patron3);
                    if(eva3 == '-'){
                        var tm = j.length;
                        if(tm === 5 || tm === 6 ){
                            $("input[name='"+j+"']").removeAttr('disabled');
                            $("input[name='"+j+"']").val(value);
                            $("input[name='"+j+"']").css({'background-color':'#fff','color':'#000'});
                        }
                        else{
                            var tm2 = j.length;
                            var eva4 = j.substring(1,tm2);
                            $("input[name='"+eva4+"']").val(value);
                            $("input[name='"+eva4+"']").removeAttr('disabled');
                            $("input[name='"+eva4+"']").css({'background-color':'#fff','color':'#000'});
                        }
                    }
                    else{
                        $("input[name='"+j+"'][value='"+value+"']").prop("checked",true);
                    }
                }
                }
            }
            else if(eva == '_coment'){
                $('#'+j+'').val(value);
            }
            if(j == 'fz_cact'){
                $("input[name='"+j+"']").val(value);
            }
            });
        });
    });
    
    $('#tpesfo,#tpesdwfo,#spdsp,#tpescx').hide();
    if(($('.estatus').attr('id') == 'EN CAPTURA') && $('#fecha_ejecucion').val() == ''){
        $('#ejecucion').dialog('open');
    }
    $('.check,.checkimg').hide();
    $('input[type=checkbox]').click(function(){
        var check,nam,tp,no;
        check = $(this).is(':checked');
        nam = $(this).attr('name');
        tp = nam.substring(0,3);
        no = nam.substring(4,5);
        if(check){
            $('select[name='+tp+'s'+no+'],input[name='+tp+'he'+no+'],input[name='+tp+'lg'+no+'],select[name='+tp+'in'+no+'],select[name='+tp+'dw'+no+']').removeAttr('disabled');
            $('input[name='+tp+'he'+no+'],input[name='+tp+'lg'+no+'],select[name='+tp+'in'+no+'],select[name='+tp+'dw'+no+']').css('background','#fff');
        }
        else{
            $('select[name='+tp+'s'+no+'],input[name='+tp+'he'+no+'],input[name='+tp+'lg'+no+'],select[name='+tp+'in'+no+'],select[name='+tp+'dw'+no+']').attr('disabled','disabled');
            $('input[name='+tp+'he'+no+'],input[name='+tp+'lg'+no+'],select[name='+tp+'in'+no+'],select[name='+tp+'dw'+no+']').css('background','#ccc');
            $('input[name='+tp+'he'+no+'],input[name='+tp+'lg'+no+'],select[name='+tp+'in'+no+'],select[name='+tp+'dw'+no+']').val('');
            $('select[name='+tp+'s'+no+'] option:first').prop('selected','selected');
        }
    });
    var oilof = $('#folio').val();
    conaletas(oilof);
//    conaletas(oilof,2);
//    conaletas(oilof,3);
//    conaletas(oilof,4);
//    conaletas(oilof,5);
//    conaletas(oilof,6);
//    conaletas(oilof,7);
 
    //COMIENZA AGREGAR MÁS CORREOS
    $('#addmail').click(function(){
        var index = $('#copias').val();
        index++;
        $('table#email').append('<tr id="em'+index+'"><td class="t">Nombre</td>\n\
        <td style="width:246px"><input name="enombre'+index+'" class="enombre"/></td>\n\
        <td class="t" style="width:246px">Correo Electronico</td>\n\
        <td style="width:246px"><input name="ecorreo'+index+'" class="ecorreo"/>\n\
        <td style="width:16px" class="t"><img src="../images/erase.png" alt="borrar" onclick="quit(\'em'+index+'\')"/></td></tr>');
        $('#copias').val(index);
    });
    //FINALIZA AGREGAR M�?S CORREOS
    $('#adddscr').click(function(){
        var desc = $('#dscr').val();
        $.post('functions/addesc.php',{id:univid,descripcion:desc,op:0},function(data){
            $('#'+univid).attr('title',desc);
            $('#dscr').val('');
            $('#descripcion').dialog('close');
        });
    });
    /*-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+
     * P A R T E   D E   C O M P L E T A R   P U E R T O S   Y   T A R J E T A S
     -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-*/
    $('input[name^=puertos]').keyup(function(){
       var pto,regx,n,index,puertos_tarjeta,tarjetas_max;
       var pyt = ($(this).attr('id')).split('|');
       puertos_tarjeta = parseInt(pyt[0]);
       tarjetas_max = parseInt(pyt[1]);
       pto = $(this).val();
       regx = /^[\d]{1,4}$/;
       n = regx.test(pto);
       index = ($(this).attr('name')).substring(7);
       if(!n){
           $(this).val('');
           $('input[name=tarjetas'+index+']').val('');
       }
       else{
           pto = $(this).val();
           pto > (puertos_tarjeta*tarjetas_max) ? $('input[name=puertos'+index+'],input[name=tarjetas'+index+']').val('') : $('input[name=tarjetas'+index+']').val(Math.ceil(pto/puertos_tarjeta));
       }
    });
    //  LO MISMO DE PUERTOS, PERO CON TARJETAS
    $('input[name^=tarjetas]').keyup(function(){
        var pto,regx,n,index,puertos_tarjeta,tarjetas_max;
        
        var pyt = ($(this).attr('id')).split('|');
        puertos_tarjeta = parseInt(pyt[0]);
        tarjetas_max = parseInt(pyt[1]);
        
        pto = parseInt($(this).val());
        regx = /^[\d]{1,3}$/;
        n = regx.test(pto);
        index = ($(this).attr('name')).substring(8);
        if(!n){
            $(this).val('');
            $('input[name=tarjetas'+index+']').val('');
        }
        else{
            pto > tarjetas_max ? $('input[name=puertos'+index+'],input[name=tarjetas'+index+']').val('') : $('input[name=puertos'+index+']').val(Math.ceil(pto * puertos_tarjeta));
        }
    });
    //  REDONDEAR PUERTOS
    $('input[name^=puertos]').blur(function(){
        var puertos_tarjeta,tarjetas_max;
        var pyt = ($(this).attr('id')).split('|');
        puertos_tarjeta = parseInt(pyt[0]);
        tarjetas_max = parseInt(pyt[1]);
        
        var c = $(this).val();
        var m = Math.ceil(c/puertos_tarjeta);
        c = puertos_tarjeta * m;
        $(this).val(c);
    });
    var edograln = new Array();
    var edogralv = new Array();
    var aofibra = new Array();
    var bofibra = new Array();
    var cont1 = 0, cont2 = 0;
    $('input[name$="ot_tipo_central"]').css('color','#999');
    $('input[name$="ot_espacio"]').css('color','#999');
    $('input[name$="ot_tipo_piso"]').css('color','#999');
    $('input[name$="ot_obra_civil"]').css('color','#999');
    $('textarea').focus(function(){
        $(this).addClass('f');
    });
    $('textarea').blur(function(){
        $(this).removeClass('f');
    });
    $('input[type=checkbox]').click(function(){
        var nam = $(this).attr('name');
        if(($(this).is(':checked'))===true){
            $('input[name=_'+nam+']').val('PEND.');
            $('input[name=_'+nam+']').attr('disabled','disabled');
            $('input[name=_'+nam+']').css({'color':'#555','background-color':'#eee'});
        }
        else{
            $('input[name=_'+nam+']').val('');
            $('input[name=_'+nam+']').removeAttr('disabled');
            $('input[name=_'+nam+']').css({'color':'#000','background-color':'#fff'});
        }
    });
    $('input[type=text]').click(function(){
        $(this).css('background-color','#fff');
        var a = $(this).attr('name');
        if(a==='9tceo'||a==='9tpso'||a==='9espo'||a==='9obco'||a==='9fobo'||a==='9dobo'||a==='9mpdo'||a==='9cxdo'||a==='9fzao'||a==='9fzeo'||a ==='fo_canaleta_tipo_otro_name'||a==='do_canaleta_tipo_otro_name'||a==='mp_canaleta_tipo_otro_name'||a==='cx_canaleta_tipo_otro_name'||a==='gs_canaleta_tipo_otro_name'||a==='fz_canaleta_tipo_otro_name'){
            var b = $(this).val();
            if(b === 'Especificar...' || b === ''){
                $(this).val('');
                $(this).css({'color':'#000','font-weight':'bold'});
            }
        }
    });  
    $('input[type=text]').blur(function(){
        var a = $(this).attr('name');
        if(a==='9tceo'||a==='9tpso'||a==='9espo'||a==='9obco'||a==='9fobo'||a==='9dobo'||a==='9mpdo'||a==='9cxdo'||a==='9fzao'||a==='9fzeo'||a==='fo_canaleta_tipo_otro_name'||a==='do_canaleta_tipo_otro_name'||a==='mp_canaleta_tipo_otro_name'||a==='cx_canaleta_tipo_otro_name'||a==='gs_canaleta_tipo_otro_name'||a==='fz_canaleta_tipo_otro_name'){
            $(this).css('background-color', '#fff');
            var b = $(this).val();
            if(b === 'Especificar...' || b === ''){
                $(this).val('Especificar...');
                $(this).css({'color':'#999','font-weight':'normal','background-color':'#fff'});
            }
        }
//        else if((a.substring(0,1))==='_' && (a.substring(1,2))!='0'){
//            remate($(this).attr('id'));
//        }
        else if((a.substring(0,2))==='_0'){
            var flag2=0;var letras=$(this).val();if(letras===''){alert('Dejo el campo vacio\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else{busca_guion=letras.indexOf('-');if(busca_guion===-1&&letras.length>1){alert('Su cadena esta mal formada\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else if(busca_guion===0||busca_guion===2){alert('El guion no puede ir en esa posición\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else if(letras.length==1){if(isNaN(letras)==false){alert('Introduzca solo letras por favor\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else{flag2=1}}else if(letras.length>1){var letrauno=letras.substring(0,busca_guion);var letrados=letras.substring(busca_guion+1,3);if(isNaN(letrauno)==false){alert('Solo puede ingresar letras\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}if(isNaN(letrados)==false){alert('Solo puede ingresar letras\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else if(letrados==''||letrados==' '){alert('Su rango no puede terminar en guion\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else if(letrauno==' '){alert('Su rango no puede empezar en blanco\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else{$(this).val(letrauno+'-'+letrados);flag2=1}}if(flag2===0){$(this).val('')}}
        }
        else{
            var c = $(this).val();
            if(c !== ''){
                $(this).removeClass('novalid');
                if(!($(this).hasClass('valid'))){
                    $(this).addClass('valid');
                }
            }
            else if(c === ''){
                $(this).addClass('novalid');
            }
        }
    });
    $('input[type=radio]').click(function(){
        var escs = new Array('canaleta_tipo_al','canaleta_tipo_fec','canaleta_tipo_cuzn','canaleta_tipo_cho','canaleta_tipo_otro');
        var a = $(this).attr('id');//id del radio        
        if(a != null){
            var id = a.substring(0,1);
            if(id === '-'){
                var tp = a.substring(3,5);//ex = existente | nu = nuevo
                var nm = a.substring(0,3);//indice de la pestaña
                if(tp === 'ex'){
                    $('input[name='+a+']').val('');
                    $('input[name='+a+']').removeAttr('disabled');
                    $('input[name='+a+']').css({'color':'#000','background-color':'#ff9'});
                    $('input[name='+a+'l]').val('');
                    $('input[name='+a+'l]').removeAttr('disabled');
                    $('input[name='+a+'l]').css({'color':'#000','background-color':'#ff9'});
                    $('input[name='+nm+'nu]').val('');
                    $('input[name='+nm+'nu]').attr('disabled','disabled');
                    $('input[name='+nm+'nu]').css('background-color','#cae4ff');
                    $('input[name='+nm+'nul]').val('');
                    $('input[name='+nm+'nul]').attr('disabled','disabled');
                    $('input[name='+nm+'nul]').css('background-color','#cae4ff');
                }
                else{
                    $('input[name='+a+']').val('');
                    $('input[name='+a+']').removeAttr('disabled');
                    $('input[name='+a+']').css({'color':'#000','background-color':'#ff9'});
                    $('input[name='+a+'l]').val('');
                    $('input[name='+a+'l]').removeAttr('disabled');
                    $('input[name='+a+'l]').css({'color':'#000','background-color':'#ff9'});
                    $('input[name='+nm+'ex]').val('');
                    $('input[name='+nm+'ex]').attr('disabled','disabled');
                    $('input[name='+nm+'ex]').css('background-color','#cae4ff');
                    $('input[name='+nm+'exl]').val('');
                    $('input[name='+nm+'exl]').attr('disabled','disabled');
                    $('input[name='+nm+'exl]').css('background-color','#cae4ff');
                }
            }
            else if(id==='9'){
                var lst = a.substring(4,5);
                var index = a.substring(0,4);
                if(lst === 'o'){
                  $('input[name='+a+']').val('');
                  $('input[name='+a+']').removeAttr('disabled');
                  $('input[name='+a+']').css({'background-color':'#ff9','font-weight':'bold','color':'#000'});                    
                }
                else{
                    $('input[name='+index+'o]').val('Especificar...');
                    $('input[name='+index+'o]').attr('disabled','disabled');
                    $('input[name='+index+'o]').css({'background-color':'#fff','font-weight':'normal','color':'#555'});
                }
            }
            else{
                var sc = a.substring(0,2);
                for(var c = 0; c <= 4; c++){
                    if(a === sc+'_'+escs[c]){
                        //$('input[name='+sc+'_'+escs[c]+'_mt]').val('');
                        $('input[name='+sc+'_'+escs[c]+'_mt]').removeAttr('disabled');
                        $('input[name='+sc+'_'+escs[c]+'_mt]').css({'color':'#000','background-color':'#ff9'});
                        $('input[name='+sc+'_'+escs[c]+'_in]').val('');
                        $('input[name='+sc+'_'+escs[c]+'_in]').removeAttr('disabled');
                        $('input[name='+sc+'_'+escs[c]+'_in]').css({'color':'#000','background-color':'#ff9'});
                        if(a === sc+'_'+escs[4]){
                            $('input[name='+sc+'_'+escs[c]+'_name]').val('');
                            $('input[name='+sc+'_'+escs[c]+'_name]').removeAttr('disabled');
                            $('input[name='+sc+'_'+escs[c]+'_name]').css({'color':'#000','font-weight':'bold','background-color':'#ff9'});
                        }
                    }
                    else{
                        $('input[name='+sc+'_'+escs[c]+'_mt]').val('');
                        $('input[name='+sc+'_'+escs[c]+'_mt]').attr('disabled','disabled');
                        $('input[name='+sc+'_'+escs[c]+'_mt]').css('background-color','#cae4ff');
                        $('input[name='+sc+'_'+escs[c]+'_in]').val('');
                        $('input[name='+sc+'_'+escs[c]+'_in]').attr('disabled','disabled');
                        $('input[name='+sc+'_'+escs[c]+'_in]').css({'color':'#555','background-color':'#cae4ff'});
                        if(a !== sc+'_'+escs[4]){
                            $('input[name='+sc+'_'+escs[c]+'_name]').val('Especificar...');
                            $('input[name='+sc+'_'+escs[c]+'_name]').attr('disabled', 'disabled');
                            $('input[name='+sc+'_'+escs[c]+'_name]').css({'color':'#999','font-weight':'normal','background-color':'#fff'});
                        }

                    }
                } 
            }
        }
        var c = $(this).attr('name');
        var b = $(this).val();
    });
    $('#save').click(function(){
       var vl = $(this).val();
       if(vl === 'Rechazar'){
           $('#rechazo').dialog('open');
            return false;
       }
	   alert('Guardado');
    });
    $('#send').click(function(){
        var mot = $('#causa_rechazo').val();
        $('#flag').val('0');
        if(mot != ''){
            $.post('functions/motivo.php',{folio:($('#folio').val()),razon:mot,tpval:$('#tpval').val()},function(data){
                $('#rechazo').dialog('close');
                // TEMPORAL
                location.href='grid_surveys.php';
                //$('#guardar').submit(); 
            });
        }
        else{
            alert('Debe de proporcionar el mótivo de rechazo');
            return false;
        }
    });
    $('#enviar').click(function(){
        var estatus = $('.estatus').attr('id');
        $('#flag').val('1');
        if($('.novalid').length > 1){
            alert('Datos incorrectos. Revise los campos en rojo');
            return false;
        }
        else{
            if(($('#bandera').val()) == 2){
//                var folioPDFSS = $('#folio').val();
//                $.ajax({
//                    type:'GET',
//                    url:'pdf/reporte_tmp.php',
//                    data:{folio:folioPDFSS},
//                    success:function(data){
//                        $.get('functions/mergePDF.php',{folio:folioPDFSS},function(data){
//                            if(data === 'ERROR En archivo PDF'){
//                                return false;
//                            }
//                            else{
//                                alert('Enviando a validacion.');
//                                $('#guardar').submit();
//                            }
//                        });
//                    },error:function(){
//                        return false;
//                    }
//                });
                alert('Enviando a validacion.');
                $('#guardar').submit();
            }
            else if(($('#bandera').val()) != 2){
                alert('Enviando a validacion.');
                $('#guardar').submit();
            }       
        }
        return false;
    });
    $('#enviara').click(function(){
        $('#ejecucion').dialog('close');
        var fecha = $('input[name=execute_date]').val();
        $('#fecha_ejecucion').val(fecha);
        $('table:eq(1) tr:eq(1) td:eq(3)').text(fecha);
        $('#datepicker').removeClass('novalid');
        return false;
//        $('#flag').val('1');
//        $('#guardar').submit();
    });
    $('button').click(function(){
        if(($(this).attr('id')) !== 'openBit'){
        /*
         *v  = valor del boton
         *x  = regex que indica que debe de empezar con x 
         *ri = nos dice si hay o no coincidencia [si es NULL agrega de lo contario borra]
         *options = devuelve un combo con los nombres de los equipos
         */
         console.log('prueba');
        var options,n,v,x,ri,sv,sv2,count;
        v = $(this).val();
        x = /^x/i;
        ri = v.match(x);
        var ultimosid;
        if(ri === null || ri === 'null'){
            var folio = $('#folio').val();
            var onblur;
            $.getJSON('functions/getLastId.php',{folio:folio,tipo:v},function(data){
                ultimosid = data;
            
            
            $.post('functions/mdlbyfl.php',{folio:folio},function(op){
                options = op;
                // ALTO/BAJO ORDEN FO
                if(v === 'tbfo' || v === 'tbdo'){
                    if(v === 'tbfo'){
                        count = $('input[name="'+v+'"]').val();//dwfo
                        sv = v.substring(2);
                        onblur = 'remate(this.id)';
                    }
                    else{
                        count = $('input[name="tbdwfo"]').val();
                        sv = 'dwfo';
                        onblur = $('#tecnologia').val() === 'GPON' ? 'rematev2(this.id)' : 'remate(this.id)';
                    }
                    count++;
                    $.tr = $('<tr>',{id:count});
                    $.id = $('<input>',{type:'hidden',name:sv+'_id'+count,value:ultimosid[0]});
                    $.eq = $('<td>').css('width','100px');
                    $.seleq = $('<select>',{name:sv+'_mod'+count}).addClass('xix').append(options);
                    $.eq.append($.seleq);
                    $.ub = $('<td>').addClass('t').css('width','120px');
                    $.ub.append($('<input>',{type:'text',id:sv+'_ubeq'+count,name:sv+'_ubeq'+count,onblur:'repisa(this.id)'}).addClass('foc2'));
                    $.ub.append($('<div>',{onclick:'popitup(\'ub_equipo.php?text='+sv+'_ubeq'+count+'&ub_tipo=repisa\')'}).addClass('help'));
                    $.rm = $('<td>').addClass('t');
                    $.rm.append($('<input>',{type:'text',id:'_'+sv+'_ps_rmt'+count,name:'_'+sv+'_ps_rmt'+count,onblur:onblur}).addClass('foc3'));
                    $.cn = $('<td>');
                    $.cn.append($('<select>',{name:sv+'_tpcon_eq'+count}));
                    $.cn.children('select').append($('<option>',{value:'',text:'Seleccionar',selected:'selected'}));
                    $.cn.children('select').append($('<option>',{value:'FC',text:'FC'}));
                    $.cn.children('select').append($('<option>',{value:'SC',text:'SC'}));
                    $.cn.children('select').append($('<option>',{value:'LC',text:'LC'}));
                    $.cn.children('select').append($('<option>',{value:'Otro',text:'Otro'}));
                    $.tf = $('<td>');
                    $.tf.append($('<select>',{name:sv+'_fibra'+count}));
                    $.tf.children('select').append($('<option>',{value:'',text:'Seleccionar',selected:'selected'}));
                    $.tf.children('select').append($('<option>',{value:'MM-SX',text:'MM-SX'}));
                    $.tf.children('select').append($('<option>',{value:'SM-LR',text:'SM-LR'}));
                    $.tf.children('select').append($('<option>',{value:'SM-ZR',text:'SM-ZR'}));
                    $.tf.children('select').append($('<option>',{value:'SM-LX',text:'SM-LX'}));
                    $.tf.children('select').append($('<option>',{value:'SM-ER',text:'SM-ER'}));
                    $.td = $('<td>');
                    $.td.append($('<select>',{name:sv+'_tpconlado_eq'+count}));
                    $.td.children('select').append($('<option>',{value:'',text:'Seleccionar',selected:'selected'}));
                    $.td.children('select').append($('<option>',{value:'FC',text:'FC'}));
                    $.td.children('select').append($('<option>',{value:'SC',text:'SC'}));
                    $.td.children('select').append($('<option>',{value:'LC',text:'LC'}));
                    $.td.children('select').append($('<option>',{value:'Otro',text:'Otro'}));
                    $.dfo = $('<td>');
                    $.dfo.append($('<select>',{name:sv+'_fo_bloque_dfo'+count}));
                    $.dfo.children('select').append($('<option>',{value:'',text:'Seleccionar',selected:'selected'}));
                    $.dfo.children('select').append($('<option>',{value:'Nuevo',text:'Nuevo'}));
                    $.dfo.children('select').append($('<option>',{value:'Existente',text:'Existente'}));
                    $.l1 = $('<td>').addClass('t').css('width','80px');
                    $.l1.append($('<input>',{name:sv+'_ljump'+count+'_1'}).addClass('foc4'));
                    $.l2 = $('<td>').addClass('t').css('width','80px');
                    $.l2.append($('<input>',{name:sv+'_ljump'+count+'_1'}).addClass('foc5'));
                    $.tr.append($.id,$.eq,$.ub,$.rm,$.cn,$.tf,$.td,$.dfo,$.l1,$.l2);
                    $("#"+v).append($.tr);
                    if(v === 'tbfo'){
                        $('input[name="'+v+'"]').val(count);
                    }
                    else{
                        $('input[name="tbdwfo"]').val(count);
                    }
                }
                // COAXIAL
                else if(v === 'tbcx'){
                    var tr,tdeq,tdub,tdpt,tdld,tdpc,tdtc,tdtx,tdtr,tdlg;
                    var ops =[['','A','B'],['','BNC Hembra','BNC Macho'],['','Coaxial','Micro Coaxial'],['','Tx','Rx']];
                    count = $('input[name="tbcx"]').val();
                    count++;
                    tr = $('<tr>',{id:count});
                    $.id = $('<input>',{type:'hidden',name:'cx_id'+count,value:ultimosid[0]});
                    tdeq = $('<td>').append($('<select>',{name:'cx_mod'+count,style:'width:97px'}).addClass('xix').append(op));
                    tdub = $('<td>').append($('<input>',{type:'text',id:'cx_ubeq'+count,name:'cx_ubeq'+count,onblur:'ubicacion(this.id)'}).addClass('cx1'),$('<div>',{onclick:'popitup(\'ub_equipo.php?text=cx_ubeq'+count+'\')'}).addClass('help')).addClass('t');
                    tdpt = $('<td>').append($('<input>',{type:'text',name:'cxubeq'+count,maxlength:'4'}).addClass('cx2')).addClass('t');
                    tdld = $('<td>').append($('<select>',{name:'cx_lado'+count}).append($('<option>',{value:'',text:'-'}),$('<option>',{value:'A',text:'A'}),$('<option>',{value:'B',text:'B'})));
                    tdpc = $('<td>').append($('<input>',{type:'text',name:'_cxld'+count,maxlength:'5'}).addClass('cx4')).addClass('t');
                    tdtc = $('<td>').append($('<select>',{name:'cx_ld'+count}).append($('<option>',{value:'',text:'Seleccionar'}),$('<option>',{value:'BNC Hembra',text:'BNC Hembra'}),$('<option>',{value:'BNC Macho',text:'BNC Macho'})).addClass('cx3'));
                    tdtx = $('<td>').append($('<select>',{name:'cx_cx'+count}).append($('<option>',{value:'',text:'Seleccionar'}),$('<option>',{value:'Coaxial',text:'Coaxial'}),$('<option>',{value:'Micro Coaxial',text:'Micro Coaxial'})));
                    tdtr = $('<td>').append($('<select>',{name:'cx_TrRx'+count}).append($('<option>',{value:'',text:'Seleccionar'}),$('<option>',{value:'Tx',text:'Tx'}),$('<option>',{value:'Rx',text:'Rx'})));
                    tdlg = $('<td>').append($('<input>',{type:'text',name:'cx_lcable'+count}).addClass('cx6')).addClass('t');
                    tr.append($.id,tdeq,tdub,tdpt,tdld,tdpc,tdtc,tdtx,tdtr,tdlg);
                    $('#'+v).append(tr);
                    $('input[name="tbcx"]').val(count);
                }
                else if(v === 'tbfz'){
                    var func = ['repisa(this.id)','glt(this.id)','piso(this.id)',''];
                    var num = {'Planta':0,'Remoto en Bastidor':0,'Distribuidor de Fuerza (GLT)':1,'Otro':3};
                    var functwo = {'Planta':'repisa','Remoto en Bastidor':'repisa','Distribuidor de Fuerza (GLT)':'glt','Otro':'repisa'};
                    var fz_tp_alimen = $('input[type=radio][name=fz_tp_alimen]').val();
                    var blur = func[num[fz_tp_alimen]];
                    var Ttr,Rtr,Teq,Tnm,Rnm,Tub,Rub,Tne,Rne,Tpf,Rpf,Tcf,Rcf,Tcc,Rcc,Tlc,Rlc,Tca,Rca,Ttz,Rtz;
                    count = $('input[name="tbfz"]').val();
                    count++;
                    //  OPCIONES DE REMATES
                    //  Trabajo
                    Ttr = $('<tr>',{'class':'aov'+count});
                    $.id = $('<input>',{type:'hidden',name:'fz_id'+count,value:ultimosid[0]+'_'+ultimosid[1]});
                    Teq = $('<td>',{rowspan:'2'}).append($('<select>',{name:'fz_mod'+count}).css('width','94px').addClass('xix').append(op));
                    Tnm = $('<td>',{text:'Trabajo'}).css('width','70px');
                    Tub = $('<td>').css('height','22px').addClass('t');
                    //Tub.append($('<input>',{type:'text',id:'fzt_ubal'+count,name:'fzt_ubal'+count,onblur:'piso(this.id)'}).addClass('fz2'));
                    Tub.append($('<input>',{type:'text',id:'fzt_ubal'+count,name:'fzt_ubal'+count,onblur:blur}).addClass('fz2'));
                    Tub.append($('<div>',{onclick:'popitup(\'ub_equipo.php?text=fzt_ubal'+count+'&ub_tipo='+functwo[fz_tp_alimen]+'\')'}).addClass('help'));
                    Tne = $('<td>').append($('<select>',{name:'fzt_nuex'+count}).append($('<option>',{value:'',text:'Seleccionar',selected:'selected'}),$('<option>',{value:'Nuevo',text:'Nuevo'}),$('<option>',{value:'Existente',text:'Existente'})));
                    Tpf = $('<td>').css('height','22px').addClass('t');
                    Tpf.append($('<input>',{type:'text',name:'fzt_break'+count}).addClass('fz3'));
                    Tcf = $('<td>').append($('<select>',{name:'fzt_capfus'+count}));
                    Tcf.children('select').append($('<option>',{value:'Seleccionar',text:'Seleccionar',selected:'selected'}));
                    Tcf.children('select').append($('<option>',{value:'3 AMP',text:'3 AMP'}));
                    Tcf.children('select').append($('<option>',{value:'4 AMP',text:'4 AMP'}));
                    Tcf.children('select').append($('<option>',{value:'5 AMP',text:'5 AMP'}));
                    Tcf.children('select').append($('<option>',{value:'6 AMP',text:'6 AMP'}));
                    Tcf.children('select').append($('<option>',{value:'8 AMP',text:'8 AMP'}));
                    Tcf.children('select').append($('<option>',{value:'10 AMP',text:'10 AMP'}));
                    Tcf.children('select').append($('<option>',{value:'15 AMP',text:'15 AMP'}));
                    Tcf.children('select').append($('<option>',{value:'30 AMP',text:'30 AMP'}));
                    Tcf.children('select').append($('<option>',{value:'32 AMP',text:'32 AMP'}));
                    Tcf.children('select').append($('<option>',{value:'40 AMP',text:'40 AMP'}));
                    Tcf.children('select').append($('<option>',{value:'60 AMP',text:'60 AMP'}));
                    Tcf.children('select').append($('<option>',{value:'100 AMP',text:'100 AMP'}));
                    Tcc = $('<td>').append($('<select>',{name:'fzt_calibre'+count}));
                    Tcc.children('select').append($('<option>',{value:'Seleccionar',text:'Seleccionar',selected:'selected'}));
                    Tcc.children('select').append($('<option>',{value:'1/0 AWG',text:'1/0 AWG'}));
                    Tcc.children('select').append($('<option>',{value:'2 AWG',text:'2 AWG'}));
                    Tcc.children('select').append($('<option>',{value:'4 AWG',text:'4 AWG'}));
                    Tcc.children('select').append($('<option>',{value:'6 AWG',text:'6 AWG'}));
                    Tcc.children('select').append($('<option>',{value:'8 AWG',text:'8 AWG'}));
                    Tcc.children('select').append($('<option>',{value:'10 AWG',text:'10 AWG'}));
                    Tlc = $('<td>').addClass('t').append($('<input>',{type:'text',name:'fzt_lcbl'+count}).addClass('fz6'));
                    Tca = $('<td>').addClass('t').append($('<input>',{type:'text',name:'fzt_cntcb'+count}).addClass('fz7'));
                    Ttz = $('<td>').append($('<select>',{name:'fzt_tzapt'+count}));
                    Ttz.children('select').append($('<option>',{value:'Seleccionar',text:'Seleccionar',selected:'selected'}));
                    Ttz.children('select').append($('<option>',{value:'Tornillo Opresor',text:'Tornillo Opresor'}));
                    Ttz.children('select').append($('<option>',{value:'Zapata de un ojillo',text:'Zapata de un ojillo'}));
                    Ttz.children('select').append($('<option>',{value:'Zapata de dos ojillos',text:'Zapata de dos ojillos'}));
                    Ttr.append($.id,Teq,Tnm,Tub,Tne,Tpf,Tcf,Tcc,Tlc,Tca,Ttz);
                    //  Respaldo
                    Rtr = $('<tr>',{'class':'aov'+count});
                    Rnm = $('<td>',{text:'Respaldo'}).css('width','70px');
                    Rub = $('<td>').css('height','22px').addClass('t');
                    //Rub.append($('<input>',{type:'text',id:'fzr_ubal'+count,name:'fzr_ubal'+count,onblur:'piso(this.id)'}).addClass('fz2'));
                    Rub.append($('<input>',{type:'text',id:'fzr_ubal'+count,name:'fzr_ubal'+count}).addClass('fz2'));
                    //Rub.append($('<div>',{onclick:'popitup(\'ub_equipo.php?text=fzr_ubal'+count+'&ub_tipo=piso\')'}).addClass('help'));
                    Rne = $('<td>').append($('<select>',{name:'fzr_nuex'+count}).append($('<option>',{value:'',text:'Seleccionar',selected:'selected'}),$('<option>',{value:'Nuevo',text:'Nuevo'}),$('<option>',{value:'Existente',text:'Existente'})));
                    Rpf = $('<td>').css('height','22px').addClass('t');
                    Rpf.append($('<input>',{type:'text',name:'fzr_break'+count}).addClass('fz3'));
                    Rcf = $('<td>').append($('<select>',{name:'fzr_capfus'+count}));
                    Rcf.children('select').append($('<option>',{value:'Seleccionar',text:'Seleccionar',selected:'selected'}));
                    Rcf.children('select').append($('<option>',{value:'3 AMP',text:'3 AMP'}));
                    Rcf.children('select').append($('<option>',{value:'4 AMP',text:'4 AMP'}));
                    Rcf.children('select').append($('<option>',{value:'5 AMP',text:'5 AMP'}));
                    Rcf.children('select').append($('<option>',{value:'6 AMP',text:'6 AMP'}));
                    Rcf.children('select').append($('<option>',{value:'8 AMP',text:'8 AMP'}));
                    Rcf.children('select').append($('<option>',{value:'10 AMP',text:'10 AMP'}));
                    Rcf.children('select').append($('<option>',{value:'15 AMP',text:'15 AMP'}));
                    Rcf.children('select').append($('<option>',{value:'30 AMP',text:'30 AMP'}));
                    Rcf.children('select').append($('<option>',{value:'32 AMP',text:'32 AMP'}));
                    Rcf.children('select').append($('<option>',{value:'40 AMP',text:'40 AMP'}));
                    Rcf.children('select').append($('<option>',{value:'60 AMP',text:'60 AMP'}));
                    Rcf.children('select').append($('<option>',{value:'100 AMP',text:'100 AMP'}));
                    Rcc = $('<td>').append($('<select>',{name:'fzr_calibre'+count}));
                    Rcc.children('select').append($('<option>',{value:'Seleccionar',text:'Seleccionar',selected:'selected'}));
                    Rcc.children('select').append($('<option>',{value:'1/0 AWG',text:'1/0 AWG'}));
                    Rcc.children('select').append($('<option>',{value:'2 AWG',text:'2 AWG'}));
                    Rcc.children('select').append($('<option>',{value:'4 AWG',text:'4 AWG'}));
                    Rcc.children('select').append($('<option>',{value:'6 AWG',text:'6 AWG'}));
                    Rcc.children('select').append($('<option>',{value:'8 AWG',text:'8 AWG'}));
                    Rcc.children('select').append($('<option>',{value:'10 AWG',text:'10 AWG'}));
                    Rlc = $('<td>').addClass('t').append($('<input>',{type:'text',name:'fzr_lcbl'+count}).addClass('fz6'));
                    Rca = $('<td>').addClass('t').append($('<input>',{type:'text',name:'fzr_cntcb'+count}).addClass('fz7'));
                    Rtz = $('<td>').append($('<select>',{name:'fzr_tzapt'+count}));
                    Rtz.children('select').append($('<option>',{value:'Seleccionar',text:'Seleccionar',selected:'selected'}));
                    Rtz.children('select').append($('<option>',{value:'Tornillo Opresor',text:'Tornillo Opresor'}));
                    Rtz.children('select').append($('<option>',{value:'Zapata de un ojillo',text:'Zapata de un ojillo'}));
                    Rtz.children('select').append($('<option>',{value:'Zapata de dos ojillos',text:'Zapata de dos ojillos'}));
                    Rtr.append(Rnm,Rub,Rne,Rpf,Rcf,Rcc,Rlc,Rca,Rtz);
                    $('#'+v).append(Ttr,Rtr);
                    $('input[name="tbfz"]').val(count);
                }
            });
            return false;
        });
            }
        
        else{
            switch(v){
                case 'xbfo':
                    n = $('input[name="tbfo"]').val();
                    if(n > 0){
                        sv = 'fo';
                        var id = $('input[name='+sv+'_id'+n+']').val();
                        $.getJSON('functions/getLastId.php',{id:id,type:v});
                        $('table#tbfo tr#'+n).remove();
                        n--;
                        $('input[name="tbfo"]').val(n);
                    }
                break;
                case 'xbdo':
                    n = $('input[name="tbdwfo"]').val();
                    if(n > 0){
                        sv = 'dwfo';
                        var id = $('input[name='+sv+'_id'+n+']').val();
                        $.getJSON('functions/getLastId.php',{id:id,type:v});
                        $('table#tbdo tr#'+n).remove();
                        n--;
                        $('input[name="tbdwfo"]').val(n);
//                        return false;
                    }
                break;
//                case 'xbmp':
//                    n = $('input[name="tbmp"]').val();
//                    $('table#tbmp tr#'+n).remove();
//                    n--;
//                    $('input[name="tbmp"]').val(n);
//                break;
                case 'xbcx':
                    n = $('input[name="tbcx"]').val();
                    if(n > 0){
                        sv = 'cx';
                        var id = $('input[name='+sv+'_id'+n+']').val();
                        $.getJSON('functions/getLastId.php',{id:id,type:v});
                        $('table#tbcx tr#'+n).remove();
                        n--;
                        $('input[name="tbcx"]').val(n);
                    }
                break;
                case 'xbfz':
                    n = $('input[name="tbfz"]').val();
                    if(n > 0){
                        sv = 'fz';
                        var id = $('input[name='+sv+'_id'+n+']').val();
                        $.getJSON('functions/getLastId.php',{id:id,type:v});
                        $('table#tbfz tr.aov'+n).remove();
                        n--;
                        $('input[name="tbfz"]').val(n);
                    }
                break;
                default:
                    n = '';
                break;
            }
            
            return false;
        }
        return false;}
    });
    $('#main').on('change','.xix',function(){
        var name,id,id_eq;
        name = $(this).attr('name');
        id_eq = $(this).val();
        if(id_eq != ''){
            id = name.replace('mod','id');
            id = $('input[name='+id+']').val();
            $.getJSON('functions/getLastId.php',{id:id,tabla:$(this).attr('name'),id_eq:id_eq});
        }
    });
    //CARGADOR ZIP
    $('#ld').hide();
    $('#ld2').hide();
        var button = $('#upload_button'), interval;
        new AjaxUpload('#upload_button',{
            action: 'functions/upload.php',
            data:{folio:$('#folio').val(),tipo:0},
                onSubmit:function(file,ext){
                if(!(ext && /^(pdf)$/.test(ext))){
                    alert('Error: Solo se permiten archivos .pdf');
                    return false;
                }
                else if($('#dscript').val() == ''){
                    alert('Debe de proporcionar una descripción.');
                    return false;
                }
                else{
                    button.text('Espere un momento...');            
                    this.disable();
                    $('#ld').show();
                }
        },
        onComplete: function(file,response){
            $.post('functions/addesc.php',{id:0,descripcion:check.join()+' '+$('#dscript').val(),op:1},function(data){
                $('a#'+data[0]).attr('title',data[1]);
            });
            button.text('Subir Archivo (unicamente .pdf)');
            this.enable();	
            $('#dscript').val('');
            $('.check').hide();
            $('#ld').hide();
            $('#zip').show();
            $('#zip').append(response);
			$('input[type=checkbox][name=tplan1]').prop('checked',false);
            $('input[type=checkbox][name=tplan2]').prop('checked',false);
        }	
    });
    
    //CARGADOR IMAGENES
    var boton = $('#upload_image'), interval;
    new AjaxUpload('#upload_image',{
        action: 'functions/upload.php',
        data:{folio:$('#folio').val(),tipo:1},
        onSubmit:function(file,ext){
            if(!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
                alert('Error: Solo se permiten imagenes');
                return false;
            }
            else{
                boton.text('Espere un momento...');            
                this.disable();
                $('#ld2').show();
            }
        },
        onComplete: function(file,response){
            $.post('functions/addesc.php',{id:0,descripcion:'Evidencia fotografica. '+$('#dscriptimg').val(),op:1},function(data){});
            boton.text('Cargar Imagen');
            $('#dscriptimg').val('');
            this.enable();
            $('.checkimg').hide();
            $('#ld2').hide();
            $('#image').show();
            $('#image').append(response);
            Shadowbox.clearCache();
            Shadowbox.setup();
        }	
    });
    $('.estatus').click(function(){
        if(($(this).attr('id')) == 'RECHAZADO'){
            $.post('functions/rechazo.php',{folio:$('#folio').val()},function(data){
                alert(data);
            });
        }        
    });
    
    $('input[type=radio][name=mp_disgral]').change(function(){
        var valor,t,cmp;
        valor = $(this).val();
        
        var indice;
        
        
        if(valor == '9 y 11.5 dos lados versablock'){
            cmp = [3,'9 y 11.5 dos lados versablock','9mpd2',256];
        }
        else if(valor == '7 y 9 un lado versablock'){
            cmp = [3,'7 y 9 un lado versablock','9mpd1',256];
        }
        else if(valor == '5 y 10 niveles portasystem'){
            cmp = [8,'5 y 10 niveles portasystem','9mpd2',100];
        }
        else{
            cmp = [0,'Otro','9mpdo'];
        }
        if(cmp[0] == ant[0]){
            return false;
        }
        else{
            $.getJSON('functions/puerto_max_repisa.php',{folio:$('#folio').val(),divisor:cmp[3]},function(data){
                cmp[0] = data[0];                        
            var r = confirm('Al cambiar de opción, la tabla de remates será limpiada.');
            if(!r){
                $('#'+ant[2]).prop('checked',true);
                return false;
            }
            else{
                $.post('functions/borrarmp.php',{folio:$('#folio').val(),iden:0,idEquipo:0},function(data){});
                t = parseInt($('input[name=tbmp]').val());
                //  VERIFICAR SI HAYQ UE BORRAR ALGO
                for(var a = 1; a <= t; a++){
                    var fila,def;
                    fila = parseInt($('input[name=inmp'+a+']').val());
                    def = $('tr#fl'+a+' td:eq(0)').attr('rowspan');
                    if(typeof(def) === 'string'){
//                        if(fila === 3){
                            var pos = $('table#tbmp tr#fl'+a).index();
                            for(var b = 0; b < (fila-1); b++){
                                $('table#tbmp tr:eq('+(pos + 1)+')').remove();
                            }
                            for(var c = 0; c < 6; c++){
                                $('table#tbmp tr#fl'+a+' td:eq(3)').remove();
                            }
//                        }
//                        else if(fila === 8){
//                            var pos = $('table#tbmp tr#fl'+a).index();
//                            for(var b = 0; b < (fila-1); b++){
//                                $('table#tbmp tr:eq('+(pos + 1)+')').remove();
//                            }
//                            for(var c = 0; c < 6; c++){
//                                $('table#tbmp tr#fl'+a+' td:eq(3)').remove();
//                            }
//                        }
                        $('input[name=inmp'+a+']').val(0);
                        $('select[name=slcmp'+a+']').removeAttr('disabled');
                        $('select[name=slcmp'+a+'] option:first').prop('selected',true);
                    }            
                }
                //  AGREGAR DEPENDIENDO LO QUE SE SELECCIONE
                if(valor === '9 y 11.5 dos lados versablock' || valor === '7 y 9 un lado versablock'){
                    var pto = 256;
                    for(var i = 1; i <= t; i++){
                        $('select[name=slcmp'+i+'] option:eq('+2+')').prop('selected',true);
                        $('select[name=slcmp'+i+']').attr('disabled','disabled');
                        $('tr#fl'+i+' td:eq(0)').attr('rowspan',cmp[0]);
                        $('tr#fl'+i+' td:eq(1)').attr('rowspan',cmp[0]);
                        $('tr#fl'+i+' td:eq(2)').attr('rowspan',cmp[0]);
                        $('tr#fl'+i).append(
                            $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'01',maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1 upper')).css('height','22px'),
                            $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'01',maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                            $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'01',readonly:'readonly',value:'001-'+(pto-1)}).addClass('intmp3')).css('height','22px'),
                            $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'11',maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1 upper')).css('height','22px'),
                            $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'11',maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                            $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'11',readonly:'readonly',value:'001-'+(pto-1)}).addClass('intmp3')).css('height','22px')
                        );
                        for(var j = cmp[0]; j > 1; j--){
                            var npto = (pto * j) - 256;
                            var spto = npto+256 >= data[1] ? data[1] : npto + 255;
                            $('tr#fl'+i).after(
                                $('<tr>').append(
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'0'+j,maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'0'+j,maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'0'+j,readonly:'readonly',value:npto+'-'+(spto)}).addClass('intmp3')).css('height','22px'),
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'1'+j,maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'1'+j,maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'1'+j,readonly:'readonly',value:npto+'-'+(spto)}).addClass('intmp3')).css('height','22px')
                                )
                            );
                            pto = 256;
                        }
                        $('input[name=inmp'+i+']').val(cmp[0]);
                        pto = 256;
                    }
                }
                else if(valor === '5 y 10 niveles portasystem'){
                    for(var i = 1; i <= t; i++){
                        $('select[name=slcmp'+i+'] option:eq('+1+')').prop('selected',true);
                        $('select[name=slcmp'+i+']').attr('disabled','disabled');
                        $('tr#fl'+i+' td:eq(0)').attr('rowspan',cmp[0]);
                        $('tr#fl'+i+' td:eq(1)').attr('rowspan',cmp[0]);
                        $('tr#fl'+i+' td:eq(2)').attr('rowspan',cmp[0]);
                        $('tr#fl'+i).append(
                            $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'01',maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                            $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'01',maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                            $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'01',readonly:'readonly',value:'001-100'}).addClass('intmp3')).css('height','22px'),
                            $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'11',maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                            $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'11',maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                            $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'11',readonly:'readonly',value:'001-100'}).addClass('intmp3')).css('height','22px')
                        );
                        for(var j = cmp[0]; j > 1; j--){
                            pto = 100 * j;
                            var apto = pto > data[1] ? data[1] : pto;
                            var bpto = pto - 99;
                            $('tr#fl'+i).after(
                                $('<tr>').append(
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'0'+j,maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'0'+j,maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'0'+j,readonly:'readonly',value:bpto+'-'+apto}).addClass('intmp3')).css('height','22px'),
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'1'+j,maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'1'+j,maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'1'+j,readonly:'readonly',value:bpto+'-'+apto}).addClass('intmp3')).css('height','22px')
                                )
                            );
                        }
                        $('input[name=inmp'+i+']').val(cmp[0]);
                    }
                }
                if(valor == '9 y 11.5 dos lados versablock'){
                    ant = [3,'9 y 11.5 dos lados versablock','9mpd2',256];
                }
                else if(valor == '7 y 9 un lado versablock'){
                    ant = [3,'7 y 9 un lado versablock','9mpd1',256];
                }
                else if(valor == '5 y 10 niveles portasystem'){
                    ant = [8,'5 y 10 niveles portasystem','9mpd2',100];
                }
                else{
                    ant = [0,'Otro','9mpdo'];
                }
            }
        });
    }
        
    });
    
    $('select[name^=hf_mtp_slcmp]').change(function(){
        var dts = {Portasystem:[8,800,1,0],Versablock:[3,768,0,1]};
        var vlr = $(this).val();
        var id = $(this).attr('id');
        if(vlr != 0){
            var thislc = parseInt(($(this).attr('name')).slice(-1));
            $.post('functions/borrarmp.php',{folio:$('#folio').val(),iden:1,idEquipo:id},function(data){
                //$('table#tbmpex tr td input[name=hf_mp_lgcbl'+thislc+']').val('');
                $('table#tbmpex tr td input[name=hf_mtp_nivel'+thislc+'01]').val('');
                $('table#tbmpex tr td input[name=hf_mtp_vertical'+thislc+'01]').val('');
                $('table#tbmpex tr td input[name=hf_mtp_nivel'+thislc+'11]').val('');
                $('table#tbmpex tr td input[name=hf_mtp_vertical'+thislc+'11]').val('');
            });
            var td_izq = $(this).closest('td').index();
            var tr_cnt = $(this).closest('tr').index();
            td_izq-=2;
            //  B O R R A R
            var trEnd = $('select[name=hf_mtp_slcmp'+(thislc + 1)+']').closest('tr').index();
            if(trEnd > -1){
                for(var a = tr_cnt; a < trEnd - 1; a++){
                    $('table#tbmpex tr').eq((tr_cnt + 1)).remove();
                }
            }
            else{
                while($('table#tbmpex tr').eq((tr_cnt + 1)).length > 0){
                    $('table#tbmpex tr').eq((tr_cnt + 1)).remove();
                }
            }
            
            for(var i = td_izq; i < td_izq + 3; i++){
                $('table#tbmpex tr:eq('+tr_cnt+') td:eq('+i+')').removeAttr('rowspan');
            }
            $('table#tbmpex tr td input[name=hf_mtp_puerto'+thislc+'01]').val('001-'+((dts[vlr][1]/dts[vlr][0])-dts[vlr][3]));
            $('table#tbmpex tr td input[name=hf_mtp_puerto'+thislc+'11]').val('001-'+((dts[vlr][1]/dts[vlr][0])-dts[vlr][3]));
            //  C O L O C A R
            for(var i = td_izq + 1; i < td_izq + 4; i++){
                $('table#tbmpex tr:eq('+tr_cnt+') td:eq('+i+')').attr('rowspan',dts[vlr][0]);
            }
            var c = tr_cnt;
            var pto = dts[vlr][1], pr,sc;
            for(var i = dts[vlr][0]; i >= 2; i--){
                var rst = dts[vlr][0] === i ? 0 : 1;
                pr = pto;
                pr-=rst;
                sc = pto - ((dts[vlr][1]/dts[vlr][0]));
                pr += i !== 8 ? dts[vlr][2] : 0;
                var change = (sc+dts[vlr][2])+'-'+pr;
                $('table#tbmpex tr').eq(tr_cnt).after(
                    $('<tr>').append(
                        $('<td>').append($('<input>',{
                            type:'text',
                            name:'hf_mtp_nivel'+thislc+'0'+i,
                            onblur:'nivel(this.name)',
                            maxlength:'1'
                        }).addClass('intmp1')).css('height','22px'),
                        $('<td>').append($('<input>',{
                            type:'text',
                            name:'hf_mtp_vertical'+thislc+'0'+i,
                            onblur:'vertical(this.name)',
                            maxlength:'3'
                        }).addClass('intmp2')).css('height','22px'),
                        $('<td>').append($('<input>',{
                            type:'text',
                            name:'hf_mtp_puerto'+thislc+'0'+i,
                            onblur:'puertos(this.name)',
                            maxlength:'3',
                            readonly:'readonly',
                            value:change
                        }).addClass('intmp3')).css('height','22px'),
                        $('<td>').append($('<input>',{
                            type:'text',
                            name:'hf_mtp_nivel'+thislc+'1'+i,
                            onblur:'nivel(this.name)',
                            maxlength:'1'
                        }).addClass('intmp1')).css('height','22px'),
                        $('<td>').append($('<input>',{
                            type:'text',
                            name:'hf_mtp_vertical'+thislc+'1'+i,
                            onblur:'vertical(this.name)',
                            maxlength:'3'
                        }).addClass('intmp2')).css('height','22px'),
                        $('<td>').append($('<input>',{
                            type:'text',
                            name:'hf_mtp_puerto'+thislc+'1'+i,
                            onblur:'puertos(this.name)',
                            maxlength:'3',
                            readonly:'readonly',
                            value:change
                        }).addClass('intmp3')).css('height','22px')
                    )
                );
                c++;
                pto=sc;
            }
        }
    });
    
        $('select[name^=slcmp]').change(function(){
        var valor,t,a,i;
        valor = $(this).val();
        t = parseInt($('input[name=tbmp]').val());
        a = ($(this).attr('name')).substring(5);
        a = parseInt(a);
        var fila = $('input[name=inmp'+a+']').val();
        if(fila == 3){
            var pos = $('table#tbmp tr#fl'+a).index();
            for(var b = 0; b < 2; b++){
                $('table#tbmp tr:eq('+(pos + 1)+')').remove();
            }
            for(var c = 0; c < 6; c++){
                $('table#tbmp tr#fl'+a+' td:eq(3)').remove();
            }
        }
        else if(fila == 8){
            var pos = $('table#tbmp tr#fl'+a).index();
            for(var b = 0; b < 7; b++){
                $('table#tbmp tr:eq('+(pos + 1)+')').remove();
            }
            for(var c = 0; c < 6; c++){
                $('table#tbmp tr#fl'+a+' td:eq(3)').remove();
            }
        }
        $('input[name=inmp'+a+']').val(0);
        $('select[name=slcmp'+a+']').removeAttr('disabled');
        $('select[name=slcmp'+a+'] option:first').prop('selected',true);
        
        //  AGREGAR DEPENDIENDO LO QUE SE SELECCIONE
        i = a;
        if(valor == 'Versablock'){
            $('select[name=slcmp'+i+'] option:eq('+2+')').prop('selected',true);
            $('tr#fl'+i+' td:eq(0)').attr('rowspan','3');
            $('tr#fl'+i+' td:eq(1)').attr('rowspan','3');
            $('tr#fl'+i+' td:eq(2)').attr('rowspan','3');
            $('tr#fl'+i).append(
                $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'01',maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'01',maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'01',onblur:'puertos(this.name)'}).addClass('intmp3')).css('height','22px'),
                $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'11',maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'11',maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'11',onblur:'puertos(this.name)'}).addClass('intmp3')).css('height','22px')
            );
            for(var j = 3; j > 1; j--){
                $('tr#fl'+i).after(
                    $('<tr>').append(
                        $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'0'+j,maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                        $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'0'+j,maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                        $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'0'+j,onblur:'puertos(this.name)'}).addClass('intmp3')).css('height','22px'),
                        $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'1'+j,maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                        $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'1'+j,maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                        $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'1'+j,onblur:'puertos(this.name)'}).addClass('intmp3')).css('height','22px')
                    )
                );
            }
            $('input[name=inmp'+i+']').val(3);
        }
        else if(valor == 'Portasystem'){
            $('select[name=slcmp'+i+'] option:eq('+1+')').prop('selected',true);
            $('tr#fl'+i+' td:eq(0)').attr('rowspan','8');
            $('tr#fl'+i+' td:eq(1)').attr('rowspan','8');
            $('tr#fl'+i+' td:eq(2)').attr('rowspan','8');
            $('tr#fl'+i).append(
                $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'01',maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'01',maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'01',onblur:'puertos(this.name)'}).addClass('intmp3')).css('height','22px'),
                $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'11',maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'11',maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'11',onblur:'puertos(this.name)'}).addClass('intmp3')).css('height','22px')
            );
            for(var j = 8; j > 1; j--){
                $('tr#fl'+i).after(
                    $('<tr>').append(
                        $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'0'+j,maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                        $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'0'+j,maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                        $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'0'+j,onblur:'puertos(this.name)'}).addClass('intmp3')).css('height','22px'),
                        $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'1'+j,maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                        $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'1'+j,maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                        $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'1'+j,onblur:'puertos(this.name)'}).addClass('intmp3')).css('height','22px')
                    )
                );
            }
            $('input[name=inmp'+i+']').val(8);
        }
    });
/*  --- CARGA DE ARCHIVOS .ZIP  --- */
    $('#check_loader').click(function(){
        $('.check').fadeToggle('slow','linear');
        
    });
    $('#image_loader').click(function(){
        $('.checkimg').fadeToggle('slow','linear');
        
    });
    $('input[type=checkbox][name^=tplan]').click(function(){
        var me,bro,meid,broid;
        meid = parseInt(($(this).attr('name')).substring(5));
        broid = meid === 1 ? 2 : 1;
        me = $(this).is(':checked');
        bro = $('input[name=tplan'+broid+']').is(':checked');
        if(me | bro){
            $('#upload_button').removeAttr('disabled');
            check[0] = me ? $('input[name=tplan'+meid+']').val() : '';
            check[1] = bro ? $('input[name=tplan'+broid+']').val() : '';
        }
        else if(!me && !bro){
            $('#upload_button').attr('disabled','disabled');
        }
        
    });
    $('input[type=radio][class^=bastidor]').change(function(){
        var obj = {bastidorfo:['Nuevo','tpesfo'],bastidordwfo:['Nuevo','tpesdwfo'],bastidormp:['Si','spdsp'],bastidorcx:['Nuevo','tpescx']};
        var clase = $(this).attr('class');
        $(this).val() === obj[clase][0] ? $('#'+obj[clase][1]).show() : $('#'+obj[clase][1]).hide();
    });
    $('#exportPDF').click(function(){
        var estatus = $('.estatus').text();
        if(estatus != 'VALIDADO'){
            alert('Recuerde que el estatus actual del site survey es: '+estatus);
        }
       location.href='pdf/reporte.php?folio='+$('#folio').val(); 
    });
    $('input[type="radio"][name="mp_ampvertical"]').change(function(){
        $(this).val() == 'Si' ? $('#spdsp').show() : $('#spdsp').hide();
    });
    $('#openBit').click(function(){
        $.getJSON('functions/historicoBitacora.php',{folio:$('#folio').val()},function(data){
            $('#bitacora .ctable').empty();
            $.th1 = $('<th>',{text:'Fecha'});
            $.th2 = $('<th>',{text:'Hora'});
            $.th3 = $('<th>',{text:'Usuario'});
            $.th4 = $('<th>',{text:'Version'});
            $.th5 = $('<th>',{text:'Observaciones'});
            $.trh = $('<tr>').append($.th1,$.th2,$.th3,$.th4,$.th5);
            $.t = $('<table>').append($.trh);
            $.each(data,function(i,v){
                $.tr = $('<tr>');
                $.each(v,function(si,sv){
                   $.tr.append($('<td>',{text:sv}));
                });
                $.t.append($.tr);
            });
            $('#bitacora .ctable').append($.t);
        });
       $('#bitacora').dialog('open');
        return false; 
    });
    $('#sendBit').click(function(){
        $.post('functions/bitacora.php',{folio:$('#folio').val(),obser:$('#txt_bitacora').val(),usr:$('#usr').val()},function(data){
            //  Por si acaso.
        });
        $('#txt_bitacora').val('');
        $('#bitacora').dialog('close');
       return false; 
    });
    $('input[type=radio][name=fz_tp_alimen]').change(function(){
        changeValFza($(this).val());
    });
	
});