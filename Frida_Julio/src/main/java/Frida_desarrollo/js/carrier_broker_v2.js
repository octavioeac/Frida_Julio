var validador = function(id, ix) {
    var regex = [
        /^[A-Z\d]{3}-\d{4}-\d{4}$/i,
        /^[A-Z\d\_]{3}$/i,
        /^[A-Z\d]{11}-[A-Z\d]{5}-([A-Z\d]{2}|[A-Z\d]{4})$/i,
        /^[A-Z\d]{11}(|-[A-Z\d]{5}-([A-Z\d]{2}))$/i
    ];
    var mensaje = [
        'Ref-Sisa no valida.',
        'Central no valida.',
        'Identificador de nodo no valido.',
        'Identificador de nodo no valido.'
    ];
    var ids = [
        'serviceName',
        'centralName',
        'nombreDispositivo',
        'nombreDispositivo'
    ]
    if (ix == 2) {
        var tp = document.getElementById('cbPtoTp').value;
        ix = tp == 'NDE' ? 3 : 2;
    }
    eva = (document.getElementById(id).value).toUpperCase();
    if (!regex[ix].test(eva)) {
        alert(mensaje[ix]);
        document.getElementById(id).value = '';
    }
    else {
        document.getElementById(ids[ix]).value = eva;
    }
};

$(function() {
    $.ajax({
        type:'POST',
        url:'datosCarrierBroker.php',
        dataType:'json',
        success:function(data){
            $.each(data,function(i,v){
               $('#cluster').append($('<option>',{value:v,text:v}));
            });
        }
    });
    
    $('#cluster').change(function(){
       var cl = $(this).val();
       if(cl != ''){
           $('#id_nodo').removeAttr('disabled');
           $.ajax({
                type:'POST',
                url:'datosCarrierBroker.php',
                dataType:'json',
                data:{cluster:cl},
                success:function(data){
                    $('#central,#nodo,#proveedor,#modelo').val('');
                    $('#id_nodo').empty();
                    $('#id_nodo').append($('<option>',{value:'',text:'Seleccionar'}));
                    $.each(data,function(i,v){
                       $('#id_nodo').append($('<option>',{value:v,text:v}));
                    });
                }
            });
       }
    });
    
    $('body').on('change','#id_nodo',function(){
        if(($('#tipoNodo').val()) == 'Agregador'){
        var id = $(this).val();
       if(id != ''){
           $.ajax({
                type:'POST',
                url:'datosCarrierBroker.php',
                dataType:'json',
                data:{id_nodo:id},
                success:function(data){
                    $('#tp_pto_req,#no_pto_req,#pto_req').attr('disabled','disabled');
                    $('#tp_pto_req option:eq(0)').prop('selected','selected');
                    $('#no_pto_req option:eq(0)').prop('selected','selected');
                    $('#pto_req option:eq(0)').prop('selected','selected');
                    $('#central').val(data[0]);
                    $('#nodo').val(data[2]);
                    $('#proveedor').val(data[1]);
                    $('#modelo').val(data[3]);
                    if(typeof(data[2]) == 'string'){
                        $.ajax({
                            type:'POST',
                            url:'datosCarrierBroker.php',
                            dataType:'json',
                            data:{tipoNodo:$('#tipoNodo').val(),proveedor:data[1],equipo:data[3]},
                            success:function(data){
                                if(data.length > 0){
                                    $('#cbPtoTp').empty();
                                    $('#cbPtoTp').append($('<option>',{value:'-',text:'Seleccionar'}));
                                    $.each(data,function(i,v){
                                        $('#cbPtoTp').append($('<option>',{value:v,text:v}));
                                    });
                                    $('#cbPtoTp').removeAttr('disabled');
                                }
                                else{
                                    alert('No hay puertos disponibles.');
                                }
                            }

                        });
                    }
                }
            });
       }
   }
    });
    
    $('#tipoNodo').change(function(){
        var vl = $(this).val();
        if(vl != '-'){
            $('#id_nodo').remove();
            $('#tp_pto_req').empty();
            $('#cbPtoTp').empty();
            $('#cbPtoTp').attr('disabled','disabled');
            $('#cluster').removeAttr('disabled');
            //  Limpiar
            $('#cluster option:eq(0)').prop('selected','selected');
            $('#id_nodo').empty();
            $('#central,#nodo,#proveedor,#modelo').val('');
            $('#tp_pto_req,#no_pto_req,#pto_req').attr('disabled','disabled');
            $('#tp_pto_req option:eq(0)').prop('selected','selected');
            $('#no_pto_req option:eq(0)').prop('selected','selected');
            $('#pto_req option:eq(0)').prop('selected','selected');
            
            var xna = vl == 'Agregador' ? 'Nombre Oficial Pisa' : 'Referencia SISA';
            var py = vl == 'Agregador' ? 'Identificador de Nodo' : 'Id Nodo / CLLI';
            $('#xna').html(xna);
            $('#py').html(py);
            if(vl == 'Agregador'){
                $('#tp_pto_req').append(
                    $('<option>',{value:'-',text:'Seleccionar'}),
                    $('<option>',{value:'HSI',text:'HSI'}),
                    $('<option>',{value:'GPON',text:'GPON'})
                );
                $('#cluster').show();
                $('.row50:eq(3)').append($('<select>',{name:'id_nodo',id:'id_nodo',disabled:'disabled'}));
            }
            else if(vl == 'NDE'){
                $('#tp_pto_req').append(
                    $('<option>',{value:'-',text:'Seleccionar'}),
                    $('<option>',{value:'SDH',text:'SDH'})
                );
                $('.row50:eq(2) > *').hide();
                $('.row50:eq(3)').append($('<input>',{type:'text',name:'id_nodo',id:'id_nodo'}));
            }
        }
    });
    
    $('.row50:eq(3)').on('keyup','#id_nodo',function(){
        var clli_adva = $(this).val();
        clli_adva = clli_adva.toUpperCase();
        $(this).autocomplete({
            source:function(request, response) {
                $.ajax({
                    type:'POST',
                    url:'datosCarrierBroker.php',
                    dataType:'json',
                    data: {clli_adva:clli_adva},
                    success:function(data){
                        response(data);
                    }
                });
            }
            });
    });
    
    $('.row50:eq(3)').on('blur','#id_nodo',function(){
       if(($('#tipoNodo').val()) == 'NDE'){
        if(($(this).val()) != ''){
           $.ajax({
                type:'POST',
                 url:'datosCarrierBroker.php',
                 dataType:'json',
                 data:{clli:$(this).val()},
                 success:function(data){
                     $('#tp_pto_req,#no_pto_req,#pto_req').attr('disabled','disabled');
                     $('#tp_pto_req option:eq(0)').prop('selected','selected');
                     $('#no_pto_req option:eq(0)').prop('selected','selected');
                     $('#pto_req option:eq(0)').prop('selected','selected');
                     $('#central').val(data[0]);
                     $('#nodo').val(data[1]);
                     $('#proveedor').val(data[2]);
                     $('#modelo').val(data[3]);
                     if(typeof(data[2]) == 'string'){
                         $.ajax({
                             type:'POST',
                             url:'datosCarrierBroker.php',
                             dataType:'json',
                             data:{tipoNodo:$('#tipoNodo').val(),proveedor:data[2],equipo:data[3]},
                             success:function(data){
                                 $('#cbPtoTp').empty();
                                 $('#cbPtoTp').append($('<option>',{value:'-',text:'Seleccionar'}));
                                 $.each(data,function(i,v){
                                     $('#cbPtoTp').append($('<option>',{value:v,text:v}));
                                 });
                                 $('#cbPtoTp').removeAttr('disabled');
                             }

                         });
                     }
                 }
            });
       }
   }
    });
    
    $('#cbPtoTp').change(function() {
        var vl = $(this).val();
        if (vl != '-') {
            $('#portType').val(vl);
            if(($('#tipoNodo').val()) == 'NDE'){
                $('#tp_pto_req option:eq(1)').prop('selected','selected');
            }
            else{
                $('#tp_pto_req,#no_pto_req,#pto_req').removeAttr('disabled');
            }
        }
    });

    $('#tp_pto_req').change(function() {
        var tp = $(this).val();
        if(tp != '-'){
            if(tp == 'HSI' || tp == 'SDH'){
                $('#pto_req,#no_pto_req').attr('disabled','disabled');
                $('#no_pto_req option:eq(0)').attr('selected','selected');
            }
            else{
                $('#pto_req,#no_pto_req').removeAttr('disabled');
            }
        }
    });
    
    

    $('#solicitar').click(function(){
        /*arreglo de validaciones*/
        var val = [];
        var mos = true;
        var faltantes = 'Faltan los sigientes datos:\n';
        var msj = [
            '\tReferencia SISA',
            '\tTipo de puerto',
            '\tCluster',
            '\tCentral',
            '\tNodo',
            '\tId Nodo',
            '\tProveedor',
            '\tModelo',
            '\tTipo Servicio',
            '\tNo de puertos',
            '\tPuertos'
        ];
        var regex = [/^[A-Z\d]{3}-\d{4}-\d{4}$/i, /^[A-Z\d\_]{3}$/i];
        var _refsisa = $('#ref_sisa').val();
        var _cbPtoTp = $('#cbPtoTp').val();
        var _cluster = $('#cluster').val();
        var _central = $('#central').val();
        var _id_nodo = $('#id_nodo').val();
        var _nodo = $('#nodo').val();
        var _proveedor = $('#proveedor').val();
        var _modelo = $('#modelo').val();
        var _tp_pto_req = $('#tp_pto_req').val();
        var _no_pto_req = $('#no_pto_req').val();
        var _pto_req = $('#pto_req').val();

        /*Validación ref-sisa*/
        val[0] = regex[0].test(_refsisa) ? true : false;
        /*Validación tipo de puerto*/
        val[1] = _cbPtoTp == '-' ? false : true;
        /*Validación cluster*/
        //val[2] = _cluster == '' ? false : true;
		val[2] = true;
        /*Validación central*/
        val[3] = regex[1].test(_central) ? true : false;
        /*Validación nodo*/
        val[4] = _nodo == '' ? false : true;
        /*Validación id nodo*/
        val[5] = _id_nodo == '' ? false : true;
        /*Validación proveedor*/
        val[6] = _proveedor == '' ? false : true;
        /*Validación modelo*/
        val[7] = _modelo == '' ? false : true;
        /*Validación tipo servicio*/
        val[8] = _tp_pto_req == '-' ? false : true;
        /*Validación no. de puertos*/
        if (_tp_pto_req == 'HSI' || _tp_pto_req == 'SDH') {
            _no_pto_req = 1;
            _pto_req = '';
            val[9] = true;
            val[10] = true;
        }
        else if (_tp_pto_req == 'GPON') {
            if (_no_pto_req == 1) {
                val[9] = _tp_pto_req == '-' ? false : true;
                val[10] = _pto_req == '-' ? false : true;
            }
            else if (_no_pto_req == 2) {
                _pto_req = 2;
                val[9] = true;
                val[10] = true;
            }
        }
        else {
            val[9] = false;
            val[10] = false;
        }

        $.each(val, function(i, v) {
            if (!v) {
                mos = false;
                faltantes += msj[i] + '\n'
            }
        });
        if (mos) {
            $.ajax({
                type: 'GET',
                url: 'urlbroker.php',
                dataType: 'text',
                data: {
                    deviceName: _id_nodo,
                    distributorDevice: '',
                    centralName: _central,
                    portType: _cbPtoTp,
                    serviceName: _refsisa,
                    serviceType: _tp_pto_req,
                    serviceClass: _pto_req,
                    noOfPort: _no_pto_req
                },
                success:function(data){
                    if(data != null){
                        alert('Solicitud de puerto enviada.');
                    }
                }
            });
        }
        else {
            alert(faltantes);
        }
    });



    $('#no_pto_req').change(function() {
        var nom = $(this).val();
        if(nom == 1){
            $('#pto_req').removeAttr('disabled');            
        }
        else{
            $('#pto_req').attr('disabled','disabled');
        }
    });

    $('select[name=pto_req]').change(function() {
        val = $(this).val();
        if (val != '-') {
            $('#serviceClass').val(val);
        }
    });
});