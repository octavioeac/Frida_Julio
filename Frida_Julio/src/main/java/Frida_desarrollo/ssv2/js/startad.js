$(function(){		
    $( "#tabs" ).tabs();		
});
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
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;']
    });
});
function popup(url, ancho, alto){
    var posicion_x; 
    var posicion_y; 
    posicion_x=(screen.width/2)-(ancho/2); 
    posicion_y=(screen.height/2)-(alto/2); 
    window.open(url, "popup", "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+"");
}
var ct = 1; var unity = ''; var univid; var combo; var opn; var val;
var c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,c11,c12; var i;
function d(u){
    combo = '';
    $('#titulo').empty();
    $('#cantidad').hide();
    $('#cantidad').empty();
    opn = u.substring(0,1);
    var st = u.split('_');//SEPARA LA UNIDAD DE LA PROPIEDAD
    if(opn !== '|'){//SI NO ES | SIGNIFICA QUE ES DG O CANALETA
        if(opn === 'c' || opn === 'd'){//SI ES CANALETA O DG
            if(st[1] != '-'){
                $('#cantidad').show();
                if(opn === 'c'){
                    $('#titulo').append('Ancho');
                }
                else{
                    $('#titulo').append('Nivel');
                }
                $('#titulo').show();
                var num = st[1].split(',');
                for(var i = 0; i < num.length; i++){
                    /*alert('hola');*/
                    $('#cantidad').empty();                
                    combo = combo+'<option value="'+num[i]+'">'+num[i]+'</option>';
                    $('#cantidad').append(combo);
                }
            }
        }
    }
    unity = st[0].substring(1);
}
function sup(id){
    var hf = id.split('|');
    $.post('functions/adecuacion/borrar.php',{id:hf[1]},function(data){
        $('tr#'+hf[0]).remove();
    });              
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
    $('#dialog').dialog({
        autoOpen:false,
        modal:true,
        height:480,
        width:601,
        show:{effect:'blind',duration:1000},
        hide:{effect:'explode',duration:1000}
    });
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
    $('.ag').click(function(){
        var tp = new Array('ALIMENTACION','BDTD','CABLEADO','CANALETA/ESCALERILLA','DFO','DG','ETIQUETADO','INSTALACION/DESMONTAJE','OBRA CIVIL','RDA','TIERRA','OTROS');
        i = $(this).attr('id');
        i = parseInt(i);
        $.post('functions/adecuacion/cande.php',{categoria:tp[i]},function(data){
            $('.desc').append(data);
        });
        $('#dialog').dialog('open');
        $('input[name="unidad"]').val('');
        $('input[name="cantidad"]').val('');
    });
    $('#cerrar').click(function(){
        var indice = 0;
        var inx = new Array('a','b','m','d','e','f','g','h','i','j','k','l');
        var cantidad = $('input[name="cantidad"]').val();
        var folio = $('#folio').val();
        var codigo = $('input[name="op"]:checked').attr('id');
        var longdescrip = $('td#-'+codigo).attr('title');
        longdescrip = longdescrip.replace('"','')
        var descripcion = $('input[name="op"]:checked').val();
        if(opn === 'c'){
            val = $('#cantidad').val();
            if(val == null || val == 'null'){
                val = 'N/A';
            }
        }
        else if(opn === 'd'){
            val = $('#cantidad').val();
            if(val == null || val == 'null'){
                val = 'N/A';
            }
        }
        else{
            val = '-';
        }
        alert(folio+' '+codigo+' '+i+' '+val);
        $.post('functions/adecuacion/guardarNuevo.php',{folio:folio,codcat:codigo,seccion:i,cantidad:cantidad,tipo:val},function(data){
            switch(i){
                case 0:c1++;indice=c1;break;
                case 1:c2++;indice=c2;break;
                case 2:c3++;indice=c3;break;
                case 3:c4++;indice=c4;break;
                case 4:c5++;indice=c5;break;
                case 5:c6++;indice=c6;break;
                case 6:c7++;indice=c7;break;
                case 7:c8++;indice=c8;break;
                case 8:c9++;indice=c9;break;
                case 9:c10++;indice=c10;break;
                case 10:c11++;indice=c11;break;
                case 11:c12++;indice=c12;break;
                default:indice=0;break;
            }
            if(opn === 'c'){
                //val = $('#cantidad').val();
                $('table#'+inx[i]).append('<tr id="'+inx[i]+''+indice+'"><td>'+codigo+'</td><td title="'+longdescrip+'">'+descripcion+'</td><td>'+cantidad+'</td><td>'+unity+'</td><td>'+val+'</td><td><img class="del" src="img/erase.png" onclick="sup(\''+inx[i]+''+indice+'|'+data+'\')"/></td></tr>');
            }
            else if(opn === 'd'){
                //val = $('#cantidad').val();
                $('table#'+inx[i]).append('<tr id="'+inx[i]+''+indice+'"><td>'+codigo+'</td><td title="'+longdescrip+'">'+descripcion+'</td><td>'+cantidad+'</td><td>'+unity+'</td><td>'+val+'</td><td><img class="del" src="img/erase.png" onclick="sup(\''+inx[i]+''+indice+'|'+data+'\')"/></td></tr>');
            }
            else{
                val = '-';
                $('table#'+inx[i]).append('<tr id="'+inx[i]+''+indice+'"><td>'+codigo+'</td><td title="'+longdescrip+'">'+descripcion+'</td><td>'+cantidad+'</td><td>'+unity+'</td><td><img class="del" src="img/erase.png" onclick="sup(\''+inx[i]+''+indice+'|'+data+'\')"/></td></tr>');
            }
            delete(longdescrip);
            $('#titulo').empty();
            $('#cantidad').hide();
            $('#cantidad').empty();
            $('.desc').empty();
            $('#dialog').dialog('close');            
        });
    });
});
function quit(i){
    $('tr#'+i).remove();
}
$(document).ready(function(){
    //COMIENZA AGREGAR MÁS CORREOS
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
    //FINALIZA AGREGAR MÁS CORREOS
    c1 = $('input[name=ca]').val();c1--;
    c2 = $('input[name=cb]').val();c2--;
    c3 = $('input[name=cm]').val();c3--;
    c4 = $('input[name=cd]').val();c4--;
    c5 = $('input[name=ce]').val();c5--;
    c6 = $('input[name=cf]').val();c6--;
    c7 = $('input[name=cg]').val();c7--;
    c8 = $('input[name=ch]').val();c8--;
    c9 = $('input[name=ci]').val();c9--;
    c10 = $('input[name=cj]').val();c10--;
    c11 = $('input[name=ck]').val();c11--;
    c12 = $('input[name=cl]').val();c12--;
    $('#cantidad').hide();
    $('#titulo').hide();
    $('#adddscr').click(function(){
        var desc = $('#dscr').val();
        $.post('functions/addesc.php',{id:univid,descripcion:desc},function(data){
            $('#'+univid).attr('title',desc);
            $('#descripcion').dialog('close');
        });
    });
    //CARGADOR ZIP
    $('#ld').hide();
    $('#ld2').hide();
    var button = $('#upload_button'), interval;
    new AjaxUpload('#upload_button',{
        action: 'functions/upload.php',
        data:{folio:$('#folio').val(),tipo:0},
        onSubmit:function(file,ext){
            if(!(ext && /^(zip)$/.test(ext))){
                alert('Error: Solo se permiten archivos .zip');
                return false;
            }
            else{
                button.text('Espere un momento...');            
                this.disable();
                $('#ld').show();
            }
        },
        onComplete: function(file,response){
            button.text('Subir Archivo');
            this.enable();			
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
            boton.text('Subir Imagen');
            this.enable();			
            $('#ld2').hide();
            $('#image').show();
            $('#image').append(response);
            Shadowbox.clearCache();
            Shadowbox.setup();
        }	
    });
    
    $('textarea').focus(function(){
        $(this).addClass('f');
    });
    $('textarea').blur(function(){
        $(this).removeClass('f');
    });
    $('input[type=text]').click(function(){
        $(this).css('background-color', '#fff');
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
        else if((a.substring(0,1))==='_' && (a.substring(1,2))!='0'){
            var flag=0;var numbers=new Array(0,1,2,3,4,5,6,7,8,9);var or_rango=$(this).val();var search_rango=0;if(or_rango.length>2){search_rango=or_rango.indexOf('-');if(search_rango===-1){alert('Esta candena no tiene guion separador.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else{if(search_rango===0||search_rango===4){alert('El guion no puede ir en esa posición.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else{var subuno=or_rango.substring(0,search_rango);var subdos=or_rango.substring(search_rango+1,5);if(isNaN(subuno)===true){alert('Su cadena no es númerica.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else if(subuno==0||subuno==00||subuno>99){alert('Solo puede escribir numeros del 1 al 99.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else{if(isNaN(subdos)===true){alert('Su cadena no es númerica.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else if(subdos==0||subdos==00||subdos>99){alert('Solo puede escribir numeros del 1 al 99.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else{if(subuno.length===1){for(var i=0;i<=9;i++){if(numbers[i]==subuno){subuno='0'+subuno;break}}}if(subdos.length===1){for(var i=0;i<=9;i++){if(numbers[i]==subdos){subdos='0'+subdos;break}}}$(this).val(subuno+'-'+subdos);flag=1}}}}}else{if(or_rango===''||or_rango==0||or_rango==00){alert('Favor de ingresar un valor en el campo que no sea cero ni letra.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else{if(or_rango.length===1){if(isNaN(or_rango)==true)alert('Por favor digite un numero entre el  1 y el 99.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.');else{for(var i=0;i<=9;i++){if(numbers[i]==or_rango){$(this).val('0'+or_rango);break}}flag=1}}else{if(isNaN(or_rango)==true){alert('Por favor digite un numero entre el  1 y el 99.\nEscriba un solo número o intervalo de rangos. Por ejemplo: 45 o 5-12.')}else{flag=1}}}}if(flag===0){$(this).val('')}
        }
        else if((a.substring(0,2))==='_0'){
            var flag2=0;var letras=$(this).val();if(letras===''){alert('Dejo el campo vacio\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else{busca_guion=letras.indexOf('-');if(busca_guion===-1&&letras.length>1){alert('Su cadena esta mal formada\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else if(busca_guion===0||busca_guion===2){alert('El guion no puede ir en esa posición\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else if(letras.length==1){if(isNaN(letras)==false){alert('Introduzca solo letras por favor\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else{flag2=1}}else if(letras.length>1){var letrauno=letras.substring(0,busca_guion);var letrados=letras.substring(busca_guion+1,3);if(isNaN(letrauno)==false){alert('Solo puede ingresar letras\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}if(isNaN(letrados)==false){alert('Solo puede ingresar letras\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else if(letrados==''||letrados==' '){alert('Su rango no puede terminar en guion\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else if(letrauno==' '){alert('Su rango no puede empezar en blanco\nEscriba una sola letra o un intervalo de rangos. Por ejemplo: A o D-J.')}else{$(this).val(letrauno+'-'+letrados);flag2=1}}if(flag2===0){$(this).val('')}}
        }
        else{
            var c = $(this).val();
            if(c !== ''){
                $(this).css({'color':'#000','background-color':'#fff'});
            }
            else if(c === ''){
                $(this).css('background-color','#fcc');
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
        if(c == 'fo_bastidor_fibra'&&b=='Nuevo'){
            var w = 451, h = 370;
            var px = (screen.width/2)-(w/2);
            var py = (screen.height/2)-(h/2);
            window.open("mensaje.php", "popup", "width="+w+",height="+h+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+px+",top="+py+"");
        }
    });
//    $('#enviar').click(function(){
//        var jus = $('#justificacion').val();
//        if(jus == ''){
//            alert('El campo justificación es obligatorio.');
//            return false;
//        }
//        else{
//            $('#flag').val('1');
//        }
//    });
$('#enviar').click(function(){
        var jus = $('#justificacion_coment').val();
        var ejecucion = $('#fecha_ejecucion').val();
        if(ejecucion == ''){
            $('#ejecucion').dialog('open');
            return false;
        }
        else{
            if(jus == ''){
                alert('El campo justificación es obligatorio.');
                return false;
            }
            else{
                $('#flag').val('1'); 
            }
        }
    });
    $('#enviara').click(function(){
        var jus = $('#justificacion_coment').val();
        $('#ejecucion').dialog('close');
        var fecha = $('input[name=execute_date]').val();
        $('#fecha_ejecucion').val(fecha);
        if(jus == ''){
            alert('El campo justificación es obligatorio.');
            return false;
        }
        else{
            $('#flag').val('1');
            $('#guardado').submit();
        }
    });
    /*----------------------
     O B T E N E R   J S O N
     -----------------------*/
    $.post('functions/adecuacion/JSONad.php',{folio:$('#folio').val()},function(getjson){
        $.each(getjson, function(i){
            $.each(getjson[i], function(j, value){
                var expuno = /_coment/;
                var evuno = j.match(expuno);
                if(evuno === null){//En caso de que la cadena no contenga _coment
                    var expdos = /^Otro_/i;
                    var evdos = value.match(expdos);
                    if(evdos === null){//Si la cadena no comienza con Otro_
                        var exptres = /^_/i;
                        var evtres = j.match(exptres);
                        if(evtres != null){
                            var s = j.substring(1);
                            $("input[name='"+s+"']").val(value);
                        }
                        else{
                            $("input[name='"+j+"'][value='"+value+"']").prop("checked",true);                        
                        }
                    }
                    else{
                        var valor = value.substring(5);
                        var otro = value.substring(0,4);
                        $("input[name='"+j+"'][value='"+otro+"']").prop("checked",true);
                        $('#'+j+'_ot').val(valor);
                        $('#'+j+'_ot').removeAttr('disabled');
                        $('#'+j+'_ot').css({'background-color':'#fff','font-weight':'bold','color':'#000'});
                    }
                }
                else{
                    $('#'+j+'').val(value);
                }
            });
        });
    });
    $.post('functions/tipofolio.php',{folio:$('#folio').val()},function(data){
        if(data === 'POR VALIDAR'){
            $('#guardado :input').attr('disabled', true);
            $('.dt').hide();
            $('.dl').hide();
            $('.dsc').hide();
            $('#guardado').attr('action','cerrarss.php');
            $('#save').removeAttr('disabled');
            $('#save').val('Rechazar');
            $('#enviar').removeAttr('disabled');
            $('#enviar').val('Validar');
            $('#flag').removeAttr('disabled');
            $('#folio').removeAttr('disabled');
            $('img.del').hide();
            $('.ag').hide();
            $('table#email').hide();
        }
        else if(data === 'VALIDADO'){
            $('#guardado :input').attr('disabled', true);
            $('.estatus').css('background','#0c0');
            $('img.del').hide();
            $('.ag').hide();
            $('.dt').hide();
            $('.dl').hide();
            $('.dsc').hide();
            $('table#email').hide();
        }
        else if(data === 'RECHAZADO'){
            $('.estatus').css('background','#f00');
            $('table#email').hide();
        }
    });
    $('.estatus').click(function(){
        if(($(this).attr('id')) == 'RECHAZADO'){
            $.post('functions/rechazo.php',{folio:$('#folio').val()},function(data){
                alert(data);
            });
        }        
    });
});