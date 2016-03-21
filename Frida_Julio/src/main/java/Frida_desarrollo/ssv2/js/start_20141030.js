var univid;
var multipar = [0,0,0];
var check = [];
var ant = [];
var nivel = function(nombre){
    var eval = $('input[name='+nombre+']').val();
    var regex = /^[A-Z]{1}$/i;
    if(!regex.test(eval)){
        alert('No valido');
        $('input[name='+nombre+']').val('');
    }
};
var vertical = function(nombre){
    var eval = $('input[name='+nombre+']').val();
    var regex = /^\b(0*(?:[1-9][0-9]?|300))\b$/i;
    if(!regex.test(eval)){
        alert('No valido');
        $('input[name='+nombre+']').val('');
    }
};
var puertos = function(nombre){
    var eval = $('input[name='+nombre+']').val();
    //var regex = /^(\b(0*(?:[1-9][0-9]?|768))\b){1,3}-(\b(0*(?:[1-9][0-9]?|768))\b){1,3}$/i;
    var regex = /^[0-9]{1,3}-[0-9]{1,3}$/i;
    if(!regex.test(eval)){
        alert('No valido');
        $('input[name='+nombre+']').val('');
    }
};
var conaletas = function(folio,tag){
    $.post('functions/VerCanaletas.php',{folio:folio,tag:tag},function(data){
        var rel = {2:'afo',3:'bfo',4:'mtp',5:'cxl',6:'gys',7:'fza'};
        $.each(data,function(i,v){
           if(v[0] == 1){
               $('input[name='+rel[tag]+'k'+i+']').prop('checked',true);
               $('select[name='+rel[tag]+'s'+i+'],input[name='+rel[tag]+'he'+i+'],input[name='+rel[tag]+'lg'+i+'],input[name='+rel[tag]+'in'+i+'],input[name='+rel[tag]+'dw'+i+']').removeAttr('disabled');
               $('select[name='+rel[tag]+'s'+i+'] option:eq('+v[1]+')').prop('selected',true);
               $('input[name='+rel[tag]+'he'+i+']').val(v[2]);
               $('input[name='+rel[tag]+'lg'+i+']').val(v[3]);
               $('input[name='+rel[tag]+'in'+i+']').val(v[4]);
               $('input[name='+rel[tag]+'dw'+i+']').val(v[5]);
               if(i == 0){
                   $('#'+rel[tag]+'cm').append(v[6]);
               }
           }
        });
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
/*function ubicacion(id){
    var nom = $('#'+id).val();
    var regExpOb = /^[A-Z0-9]{1,2}\.[A-Z]{1}[0-9]{3,4}[A|B|H|X][0-9]{1,2}$/i;
    //A1.R3456H34
    var ax = regExpOb.test(nom);
    if(ax){
        if(/[A-Z]/i.test(nom.substring(1,2).toUpperCase())){
            if(parseInt(nom.substring(0,1))!==0){
                alert('No Valido');
                $('#'+id).val('');
            }
        }
    }
    else{
        alert('no valido');
        $('#'+id).val('');
    }
}*/
//return popitup(\'ub_equipo.php?text=cx_ubeq'+count+'\');
/*function popitup(id){
    var nom = $('#'+id).val();
    var regExpOb = /^[A-Z0-9]{1,2}\.[A-Z]{1}[0-9]{3,4}[A|B|H|X][0-9]{1,2}$/i;
    var ax = regExpOb.test(nom);
    if(ax){
        if(/[A-Z]/i.test(nom.substring(1,2).toUpperCase())){
            if(parseInt(nom.substring(0,1))!==0){
                alert('No Valido');
                $('#'+id).val('');
            }
        }
        else{
            alert('valido');
            $('#'+id).val('');
        }
    }
    else{
        alert('no valido');
        $('#'+id).val('');
    }
}*/
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
$(function(){
    $( "#datepicker" ).datepicker({
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
});
$(function(){
    //$("#tabs").tabs();
    var ag = false;
    var t = [1,2,3,4,5,6,7,8];
    var r = [];
    var cntd = 0;
    $.post('functions/habilitada.php',{folio:$('#folio').val()},function(data){
        var tm = data.length;
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
        $("#tabs").tabs({disabled:r});
    });
    
    
//    $('#tabs-2').css('display','none');
//    $('#tabs-3').css('display','none');
});
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
    var flag=0;var numbers=new Array(0,1,2,3,4,5,6,7,8,9);var or_rango=$('input[name="_'+g+'"]').val();var search_rango=0;if(or_rango.length>2){search_rango=or_rango.indexOf('-');if(search_rango===-1){alert('Esta candena no tiene guion separador.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else{if(search_rango===0||search_rango===4){alert('El guion no puede ir en esa posición.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else{var subuno=or_rango.substring(0,search_rango);var subdos=or_rango.substring(search_rango+1,5);if(isNaN(subuno)===true){alert('Su cadena no es númerica.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else if(subuno==0||subuno==00||subuno>99){alert('Solo puede escribir numeros del 1 al 99.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else{if(isNaN(subdos)===true){alert('Su cadena no es númerica.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else if(subdos==0||subdos==00||subdos>99){alert('Solo puede escribir numeros del 1 al 99.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else{if(subuno.length===1){for(var i=0;i<=9;i++){if(numbers[i]==subuno){subuno='0'+subuno;break}}}if(subdos.length===1){for(var i=0;i<=9;i++){if(numbers[i]==subdos){subdos='0'+subdos;break}}}$('input[name="_'+g+'"]').val(subuno+'-'+subdos);flag=1}}}}}else{if(or_rango===''||or_rango==0||or_rango==00){alert('Favor de ingresar un valor en el campo que no sea cero ni letra.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else{if(or_rango.length===1){if(isNaN(or_rango)==true)alert('Por favor digite un numero entre el  1 y el 99.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.');else{for(var i=0;i<=9;i++){if(numbers[i]==or_rango){$('input[name="_'+g+'"]').val('0'+or_rango);break}}flag=1}}else{if(isNaN(or_rango)==true){alert('Por favor digite un numero entre el  1 y el 99.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else{flag=1}}}}
}
function blurletter(k){
    var flag2=0;var letras=$('input[name="_'+k+'"]').val();if(letras===''){alert('Dejo el campo vacio\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else{var busca_guion=letras.indexOf('-');if(busca_guion===-1&&letras.length>1){alert('Su cadena esta mal formada\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else if(busca_guion===0||busca_guion===2){alert('El guion no puede ir en esa posición\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else if(letras.length==1){if(isNaN(letras)==false){alert('Introduzca solo letras por favor\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else{flag2=1}}else if(letras.length>1){var letrauno=letras.substring(0,busca_guion);var letrados=letras.substring(busca_guion+1,3);if(isNaN(letrauno)==false){alert('Solo puede ingresar letras\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}if(isNaN(letrados)==false){alert('Solo puede ingresar letras\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else if(letrados==''||letrados==' '){alert('Su rango no puede terminar en guion\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else if(letrauno==' '){alert('Su rango no puede empezar en blanco\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else{$('input[name="_'+k+'"]').val(letrauno+'-'+letrados);flag2=1}}if(flag2===0){$('input[name="_'+k+'"]').val('')}}
}
function dt(ie){
    var id = ie.substring(1);
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
$(function(){
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
        height:200,
        width:350,
        show:{effect:'blind',duration:1000},
        hide:{effect:'explode',duration:1000}
    });
});
function quit(i){
    $('tr#'+i).remove();
}
$(document).ready(function(){
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
            $('select[name='+tp+'s'+no+'],input[name='+tp+'he'+no+'],input[name='+tp+'lg'+no+'],input[name='+tp+'in'+no+'],input[name='+tp+'dw'+no+']').removeAttr('disabled');
            $('input[name='+tp+'he'+no+'],input[name='+tp+'lg'+no+'],input[name='+tp+'in'+no+'],input[name='+tp+'dw'+no+']').css('background','#fff');
        }
        else{
            $('select[name='+tp+'s'+no+'],input[name='+tp+'he'+no+'],input[name='+tp+'lg'+no+'],input[name='+tp+'in'+no+'],input[name='+tp+'dw'+no+']').attr('disabled','disabled');
            $('input[name='+tp+'he'+no+'],input[name='+tp+'lg'+no+'],input[name='+tp+'in'+no+'],input[name='+tp+'dw'+no+']').css('background','#ccc');
            $('input[name='+tp+'he'+no+'],input[name='+tp+'lg'+no+'],input[name='+tp+'in'+no+'],input[name='+tp+'dw'+no+']').val('');
            $('select[name='+tp+'s'+no+'] option:first').prop('selected','selected');
        }
    });
    var oilof = $('#folio').val();
    conaletas(oilof,2);
    conaletas(oilof,3);
    conaletas(oilof,4);
    conaletas(oilof,5);
    conaletas(oilof,6);
    conaletas(oilof,7);
    /*$('#tabs-2').css('display','none');
    $('#tabs-3').css('display','none');
    $('#tabs-4').css('display','none');
    $('#tabs-5').css('display','none');
    $('#tabs-6').css('display','none');
    $('#tabs-7').css('display','none');*/
    //COMIENZA AGREGAR M�?S CORREOS
    $('#addmail').click(function(){
        var index = $('#copias').val();
        index++;
        $('table#email').append('<tr id="em'+index+'"><td class="t">Nombre</td>\n\
        <td style="width:246px"><input name="enombre'+index+'" class="enombre"/></td>\n\
        <td class="t" style="width:246px">Correo Electronico</td>\n\
        <td style="width:246px"><input name="ecorreo'+index+'" class="ecorreo"/>\n\
        <td style="width:16px" class="t"><img src="../../images/erase.png" alt="borrar" onclick="quit(\'em'+index+'\')"/></td></tr>');
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
    $('input[name^=puertos]').keyup(function(){
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
           pto = $(this).val();
           pto > 768 ? $('input[name=puertos'+index+'],input[name=tarjetas'+index+']').val('') : $('input[name=tarjetas'+index+']').val(Math.ceil(pto/48));
       }
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
//        if(c == 'fo_bastidor_fibra'&&b=='Nuevo'){
//            var w = 451, h = 370;
//            var px = (screen.width/2)-(w/2);
//            var py = (screen.height/2)-(h/2);
//            window.open("mensaje.php", "popup", "width="+w+",height="+h+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+px+",top="+py+"");
//        }
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
            $.post('functions/motivo.php',{folio:($('#folio').val()),razon:mot},function(data){
                $('#rechazo').dialog('close');
                $('#guardar').submit(); 
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
            $('#guardar').submit();
        }
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
        if(getjson.multipar.mp_disgral == '9 y 11.5 un lado versablock'){
            ant = [3,'9 y 11.5 un lado versablock','9mpd2'];
        }
        else if(getjson.multipar.mp_disgral == '7 y 9 un lado versablock'){
            ant = [3,'7 y 9 un lado versablock','9mpd1'];
        }
        else if(getjson.multipar.mp_disgral == '5 y 10 niveles portasystem'){
            ant = [8,'5 y 10 niveles portasystem','9mpd2'];
        }
        else{
            var rx = /^Otro_/i;
            if(rx.test(getjson.multipar.mp_disgral)){
                ant = [0,'Otro','9mpdo'];
            }
            else{
                ant = [1,'',''];
            }
        }
        
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
    $('button').click(function(){
        var options,n,v,x,ri,sv,sv2,count;
        v = $(this).val();
        x = /^x/i;
        ri = v.match(x);
        if(ri === null || ri === 'null'){
            var folio = $('#folio').val();
            $.post('functions/mdlbyfl.php',{folio:folio},function(op){
                options = op;
                if(v === 'tbfo' || v === 'tbdo'){
                    if(v === 'tbfo'){
                        count = $('input[name="'+v+'"]').val();//dwfo
                        sv = v.substring(2);
                    }
                    else{
                        count = $('input[name="tbdwfo"]').val();
                        sv = 'dwfo';
                    }
                    count++;
                    $("#"+v).append('<tr id="'+count+'"><td  style="width:100px"><select name="'+sv+'_mod'+count+'">'+options+'</select></td>\n\
                    <td class="t" style="width:120px"><input type="text" class="foc2" id="'+sv+'_ubeq'+count+'" name="'+sv+'_ubeq'+count+'" onblur="repisa(this.id)"/><div class="help" onclick="popitup(\'ub_equipo.php?text='+sv+'_ubeq'+count+'&ub_tipo=repisa\')"></div></td>\n\
                    <td class="t"><input type="text" name="_'+sv+'_ps_rmt'+count+'" class="foc3" maxlength="2" onblur="remate(this.id)"/></td>\n\
                    <td class="t"><select name="'+sv+'_tpcon_eq'+count+'"><option value="FC">FC</option><option value="SC">SC</option><option value="LC">LC</option><option value="Otro">Otro</option></select></td>\n\
                    <td class="t"><select name="'+sv+'_fibra'+count+'"><option value="MM-SX">MM-SX</option><option value="MM-SR">MM-SR</option><option value="SM-LR">SM-LR</option><option value="SM-ZR">SM-ZR</option><option value="SM-LX">SM-LX</option><option value="SM-ER">SM-ER</option></select></td>\n\
                    <td class="t"><select name="'+sv+'_tpconlado_eq'+count+'"><option value="FC">FC</option><option value="SC">SC</option><option value="LC">LC</option><option value="Otro">Otro</option></select></td>\n\
                    <td class="t"><input type="text" class="foc7_b" id="'+sv+'_TxRx'+count+'" name="'+sv+'_TxRx'+count+'" value="Tx/Rx" readonly /></td>\n\
                    <td class="t"><input type="text" class="foc4" name="'+sv+'_ljump'+count+'_1"/></td><td class="t"><input type="text" class="foc5" name="'+sv+'_ljump'+count+'_2"/></td>');
                    if(v === 'tbfo'){
                        $('input[name="'+v+'"]').val(count);
                    }
                    else{
                        $('input[name="tbdwfo"]').val(count);
                    }
                }
//                else if(v === 'tbmp'){
//                    count = $('input[name="tbmp"]').val();
//                    count++;
//                    $("#"+v).append('<tr id="'+count+'"><td><select name="mp_mod'+count+'" style="width:103%">'+op+'</select></td>\n\
//                    <td style="width:75px;background:#cae4ff"><input type="text" class="mp1" name="_mp_vtc'+count+'" onblur="blurval(\'mp_vtc'+count+'\')"/><input class="ck5" id="mp_vtc'+count+'" type="checkbox" name="mp_vtc'+count+'" onclick="check(\'mp_vtc'+count+'\')"/></td>\n\
//                    <td style="background:#cae4ff"><input type="text" class="mp3" name="_0mpnvl'+count+'" maxlength="3" onblur="blurletter(\'0mpnvl'+count+'\')"/><input type="checkbox" class="ck4" id="0mpnvl'+count+'" name="0mpnvl'+count+'" onclick="check(\'0mpnvl'+count+'\')"/></td>\n\
//                    <td><select name="mptptab'+count+'"><option value="Portasystem">Portasystem</option><option value="Versablock">Versablock</option></select></td>\n\
//                    <td><input type="text" class="mp4" name="mp_lcabl'+count+'"/></td></tr>');
//                    $('input[name="tbmp"]').val(count);
//                }
                else if(v === 'tbcx'){
                    var tr,tdeq,tdub,tdpt,tdld,tdpc,tdtc,tdtx,tdtr,tdlg;
                    var ops =[['','A','B'],['','BNC Hembra','BNC Macho'],['','Coaxial','Micro Coaxial'],['','Tx','Rx']];
                    count = $('input[name="tbcx"]').val();
                    count++;
                    tr = $('<tr>',{id:count});
                    tdeq = $('<td>').append($('<select>',{name:'cx_mod'+count,style:'width:97px'}).append(op));
                    tdub = $('<td>').append($('<input>',{type:'text',id:'cx_ubeq'+count,name:'cx_ubeq'+count,onblur:'ubicacion(this.id)'}).addClass('cx1'),$('<div>',{onclick:'popitup(\'ub_equipo.php?text=cx_ubeq'+count+'\')'}).addClass('help')).addClass('t');
                    tdpt = $('<td>').append($('<input>',{type:'text',name:'cxubeq'+count,maxlength:'4'}).addClass('cx2')).addClass('t');
                    tdld = $('<td>').append($('<select>',{name:'cx_lado'+count}).append($('<option>',{value:'',text:'-'}),$('<option>',{value:'A',text:'A'}),$('<option>',{value:'B',text:'B'})));
                    tdpc = $('<td>').append($('<input>',{type:'text',name:'_cxld'+count,maxlength:'5'}).addClass('cx4')).addClass('t');
                    tdtc = $('<td>').append($('<select>',{name:'cx_ld'+count}).append($('<option>',{value:'',text:'Seleccionar'}),$('<option>',{value:'BNC Hembra',text:'BNC Hembra'}),$('<option>',{value:'BNC Macho',text:'BNC Macho'})).addClass('cx3'));
                    tdtx = $('<td>').append($('<select>',{name:'cx_cx'+count}).append($('<option>',{value:'',text:'Seleccionar'}),$('<option>',{value:'Coaxial',text:'Coaxial'}),$('<option>',{value:'Micro Coaxial',text:'Micro Coaxial'})));
                    tdtr = $('<td>').append($('<select>',{name:'cx_TrRx'+count}).append($('<option>',{value:'',text:'Seleccionar'}),$('<option>',{value:'Tx',text:'Tx'}),$('<option>',{value:'Rx',text:'Rx'})));
                    tdlg = $('<td>').append($('<input>',{type:'text',name:'cx_lcable'+count}).addClass('cx6')).addClass('t');
                    tr.append(tdeq,tdub,tdpt,tdld,tdpc,tdtc,tdtx,tdtr,tdlg);
                    $('#'+v).append(tr);
                    $('input[name="tbcx"]').val(count);
                }
            });
            return false;
        }
        else{
            switch(v){
                case 'xbfo':
                    n = $('input[name="tbfo"]').val();
                    $('table#tbfo tr#'+n).remove();
                    n--;
                    $('input[name="tbfo"]').val(n);
                break;
                case 'xbdo':
                    n = $('input[name="tbdwfo"]').val();
                    $('table#tbdo tr#'+n).remove();
                    n--;
                    $('input[name="tbdwfo"]').val(n);
                break;
                case 'xbmp':
                    n = $('input[name="tbmp"]').val();
                    $('table#tbmp tr#'+n).remove();
                    n--;
                    $('input[name="tbmp"]').val(n);
                break;
                case 'xbcx':
                    n = $('input[name="tbcx"]').val();
                    $('table#tbcx tr#'+n).remove();
                    n--;
                    $('input[name="tbcx"]').val(n);
                break;
                default:
                    n = '';
                break;
            }
            
            return false;
        }
        return false;
    });
//    var str = 'eg_tt_coment';
//    var patron = /_coment/i;
//    var afir = str.match(patron);
//    alert(afir);
    //CARGADOR ZIP
    $('#ld').hide();
    $('#ld2').hide();
        var button = $('#upload_button'), interval;
        new AjaxUpload('#upload_button',{
            action: 'functions/upload.php',
            data:{folio:$('#folio').val(),tipo:0},
                onSubmit:function(file,ext){
                if(!(ext && /^(pdf|dwg)$/.test(ext))){
                    alert('Error: Solo se permiten archivos .pdf y .dwg');
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
            $.post('functions/addesc.php',{id:0,descripcion:check.join()+$('#dscript').val(),op:1},function(data){});
            button.text('Subir Archivo (unicamente .pdf y .dwg)');
            this.enable();	
            $('#dscript').val('');
            $('.check').hide();
            $('#ld').hide();
            $('#zip').show();
            $('#zip').append(response);
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
    $.post('functions/tipofolio.php',{folio:$('#folio').val()},function(data){
        if(data === 'POR VALIDAR'){
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
//            $('.estatus').removeAttr('style');
            $('.estatus').css('background','#f00');
            $('table#email').hide();
            $('#exportPDF').show();
            $('#exportPDF').removeAttr('disabled');
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
        if(valor == '9 y 11.5 un lado versablock'){
            cmp = [3,'9 y 11.5 un lado versablock','9mpd2'];
        }
        else if(valor == '7 y 9 un lado versablock'){
            cmp = [3,'7 y 9 un lado versablock','9mpd1'];
        }
        else if(valor == '5 y 10 niveles portasystem'){
            cmp = [8,'5 y 10 niveles portasystem','9mpd2'];
        }
        else{
            cmp = [0,'Otro','9mpdo'];
        }
        if(cmp[0] == ant[0]){
            return false;
        }
        else{
            var r = confirm('Al cambiar de opción, la tabla de remates será limpiada.');
            if(!r){
                $('#'+ant[2]).prop('checked',true);
                return false;
            }
            else{
                $.post('functions/borrarmp.php',{folio:$('#folio').val()},function(data){});
                t = parseInt($('input[name=tbmp]').val());
                //  VERIFICAR SI HAYQ UE BORRAR ALGO
                for(var a = 1; a <= t; a++){
                    var fila,def;
                    fila = parseInt($('input[name=inmp'+a+']').val());
                    def = $('tr#fl'+a+' td:eq(0)').attr('rowspan');
                    if(typeof(def) === 'string'){
                        if(fila === 3){
                            var pos = $('table#tbmp tr#fl'+a).index();
                            for(var b = 0; b < 2; b++){
                                $('table#tbmp tr:eq('+(pos + 1)+')').remove();
                            }
                            for(var c = 0; c < 6; c++){
                                $('table#tbmp tr#fl'+a+' td:eq(2)').remove();
                            }
                        }
                        else if(fila === 8){
                            var pos = $('table#tbmp tr#fl'+a).index();
                            for(var b = 0; b < 7; b++){
                                $('table#tbmp tr:eq('+(pos + 1)+')').remove();
                            }
                            for(var c = 0; c < 6; c++){
                                $('table#tbmp tr#fl'+a+' td:eq(2)').remove();
                            }
                        }
        //                $('tr#fl'+a+' td:eq(0)').removeAttr('rowspan');
        //                $('tr#fl'+a+' td:eq(1)').removeAttr('rowspan');
                        $('input[name=inmp'+a+']').val(0);
                        $('select[name=slcmp'+a+']').removeAttr('disabled');
                        $('select[name=slcmp'+a+'] option:first').prop('selected',true);
                    }            
                }
                //  AGREGAR DEPENDIENDO LO QUE SE SELECCIONE
                if(valor == '9 y 11.5 un lado versablock' || valor == '7 y 9 un lado versablock'){
                    var pto = 256;
                    for(var i = 1; i <= t; i++){
                        $('select[name=slcmp'+i+'] option:eq('+2+')').prop('selected',true);
                        $('select[name=slcmp'+i+']').attr('disabled','disabled');
                        $('tr#fl'+i+' td:eq(0)').attr('rowspan','3');
                        $('tr#fl'+i+' td:eq(1)').attr('rowspan','3');
                        $('tr#fl'+i).append(
                            $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'01',maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                            $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'01',maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                            $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'01',readonly:'readonly',value:'001-'+pto}).addClass('intmp3')).css('height','22px'),
                            $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'11',maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                            $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'11',maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                            $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'11',readonly:'readonly',value:'001-'+pto}).addClass('intmp3')).css('height','22px')
                        );
                        for(var j = 3; j > 1; j--){
                            pto = j == 3 ? 513 : 257;
                            $('tr#fl'+i).after(
                                $('<tr>').append(
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'0'+j,maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'0'+j,maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'0'+j,readonly:'readonly',value:pto+'-'+(pto+255)}).addClass('intmp3')).css('height','22px'),
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'1'+j,maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'1'+j,maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'1'+j,readonly:'readonly',value:pto+'-'+(pto+255)}).addClass('intmp3')).css('height','22px')
                                )
                            );
                        }
                        $('input[name=inmp'+i+']').val(3);
                    }
                }
                else if(valor == '5 y 10 niveles portasystem'){
                    for(var i = 1; i <= t; i++){
                        $('select[name=slcmp'+i+'] option:eq('+1+')').prop('selected',true);
                        $('select[name=slcmp'+i+']').attr('disabled','disabled');
                        $('tr#fl'+i+' td:eq(0)').attr('rowspan','8');
                        $('tr#fl'+i+' td:eq(1)').attr('rowspan','8');
                        $('tr#fl'+i).append(
                            $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'01',maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                            $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'01',maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                            $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'01',readonly:'readonly',value:'001-100'}).addClass('intmp3')).css('height','22px'),
                            $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'11',maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                            $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'11',maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                            $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'11',readonly:'readonly',value:'001-100'}).addClass('intmp3')).css('height','22px')
                        );
                        for(var j = 8; j > 1; j--){
                            pto = 100 * j;
                            $('tr#fl'+i).after(
                                $('<tr>').append(
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'0'+j,maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'0'+j,maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'0'+j,readonly:'readonly',value:(pto-99)+'-'+pto}).addClass('intmp3')).css('height','22px'),
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpNiv'+i+'1'+j,maxlength:'1',onblur:'nivel(this.name)'}).addClass('intmp1')).css('height','22px'),
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpVer'+i+'1'+j,maxlength:'3',onblur:'vertical(this.name)'}).addClass('intmp2')).css('height','22px'),
                                    $('<td>').append($('<input>',{type:'text',name:'IntMpPto'+i+'1'+j,readonly:'readonly',value:(pto-99)+'-'+pto}).addClass('intmp3')).css('height','22px')
                                )
                            );
                        }
                        $('input[name=inmp'+i+']').val(8);
                    }
                }
                if(valor == '9 y 11.5 un lado versablock'){
                    ant = [3,'9 y 11.5 un lado versablock','9mpd2'];
                }
                else if(valor == '7 y 9 un lado versablock'){
                    ant = [3,'7 y 9 un lado versablock','9mpd1'];
                }
                else if(valor == '5 y 10 niveles portasystem'){
                    ant = [8,'5 y 10 niveles portasystem','9mpd2'];
                }
                else{
                    ant = [0,'Otro','9mpdo'];
                }
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
                $('table#tbmp tr#fl'+a+' td:eq(2)').remove();
            }
        }
        else if(fila == 8){
            var pos = $('table#tbmp tr#fl'+a).index();
            for(var b = 0; b < 7; b++){
                $('table#tbmp tr:eq('+(pos + 1)+')').remove();
            }
            for(var c = 0; c < 6; c++){
                $('table#tbmp tr#fl'+a+' td:eq(2)').remove();
            }
        }
        //$('tr#fl'+a+' td:eq(0)').removeAttr('rowspan');
        //$('tr#fl'+a+' td:eq(1)').removeAttr('rowspan');
        $('input[name=inmp'+a+']').val(0);
        $('select[name=slcmp'+a+']').removeAttr('disabled');
        $('select[name=slcmp'+a+'] option:first').prop('selected',true);
        
        //  AGREGAR DEPENDIENDO LO QUE SE SELECCIONE
        i = a;
        if(valor == 'Versablock'){
            $('select[name=slcmp'+i+'] option:eq('+2+')').prop('selected',true);
            $('tr#fl'+i+' td:eq(0)').attr('rowspan','3');
            $('tr#fl'+i+' td:eq(1)').attr('rowspan','3');
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
       $('#bitacora').dialog('open');
        return false; 
    });
    $('#sendBit').click(function(){
        $.post('functions/bitacora.php',{folio:$('#folio').val(),obser:$('#txt_bitacora').val()},function(data){
            //  Por si acaso.
        });
        $('#txt_bitacora').val('');
        $('#bitacora').dialog('close');
       return false; 
    });
});