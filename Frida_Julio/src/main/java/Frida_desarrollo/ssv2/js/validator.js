var ubicacion = function(id){
    var eva,regexp;
    eva = document.getElementById(id).value;
    regexp = /^([0-9]{2}|\+[A-Z0-9]{1}|0[A-Z]{1})\.(([^3CNY]{1})|CS[1-3]|N(|V)|Y[1-2])(10[1-9]|1[1-9][0-9]|[2-9][0-9]{2})(A|B)(0[1-9]|[1-9][0-9])$/i;
	//A1.CS3101B01
    if((!regexp.test(eva)) && eva !== ''){
        alert('Ubicación no válido');
        document.getElementById(id).value = '';
    }
};
var repisa = function(id){
    var eva,regexp;
    eva = document.getElementById(id).value;
    regexp = /^([0-9]{2}|\+[A-Z0-9]{1}|0[A-Z]{1})\.(([^3CNY]{1})|CS[1-3]|N(|V)|Y[1-2])(10[1-9]|1[1-9][0-9]|[2-9][0-9]{2})(A|B)(0[1-9]|[1-9][0-9]){3}$/i;
    if((!regexp.test(eva)) && eva !== ''){
        alert('Repisa no válida');
        document.getElementById(id).value = '';
    }
};
//var glt = function(id){
//    var eva,regexp;
//    eva = document.getElementById(id).value;
//    regexp = /^([0-9]{2}|\+[A-Z0-9]{1}|0[A-Z]{1})\.(([^3CNY]{1})|CS[1-3]|N(|V)|Y[1-2])(10[1-9]|1[1-9][0-9]|[2-9][0-9]{2})(D|I)$/i;
//    if((!regexp.test(eva)) && eva !== ''){
//        alert('GLT no válido');
//        document.getElementById(id).value = '';
//    }
//};

var piso = function(id){};

var changeValFza = function(tipo){
    tipo = tipo!=='Planta'&&tipo!=='Remoto en Bastidor'&&tipo!=='Distribuidor de Fuerza (GLT)' ? 'Otro' : tipo;
    var tp,func = ['repisa(this.id)','glt(this.id)','piso(this.id)',''],functwo = ['repisa','glt','piso'],a = 0,b = 1,i;
    var num = {'Planta':0,'Remoto en Bastidor':0,'Distribuidor de Fuerza (GLT)':1,'Otro':3};
    tp = num[tipo];
    $('.fz2').attr('onblur',func[tp]);
    tp = tp === 3 ? 0 : tp;
    for(i = 1; i <= $('input[name=tbfz]').val();i++){
        $('#tabs-7 table .help:eq('+(a)+')').attr('onclick','popitup(\'ub_equipo.php?text=fzt_ubal'+i+'&ub_tipo='+functwo[tp]+'\')');
        $('#tabs-7 table .help:eq('+(b)+')').attr('onclick','popitup(\'ub_equipo.php?text=fzr_ubal'+i+'&ub_tipo='+functwo[tp]+'\')');
        a +=2;
        b +=2;
    }    
};

var rematev2 = function(id){
    var elem,val,regexp,a_val,arr,rst,regexp2;    
    elem = document.getElementById(id);    
    a_val = val = elem.value;
    regexp = /^\d{1,2}$/i;
    if(regexp.test(val)){
        elem.value = pad(val,2);
    }
    else{
        regexp = /^\d{1,2}\.\d{1,2}$/i;
        if(!regexp.test(val)){
            regexp2 = /^\d{1,2}\-\d{1,2}$/i;
            if(!regexp2.test(val)){
                alert('Remate no valido. Rango no valido');
                elem.value = '';
            }
            else{
                arr = val.split('-');
                if(arr[0] < arr[1]){
                    elem.value = pad(arr[0],2)+'-'+pad(arr[1],2);
                }
                else if(arr[0] === arr[1]){
                    elem.value = pad(arr[0],2);
                }
                else{
                    alert('Remate no valido. Rango no valido');
                    elem.value = '';
                }
            }
        }
        else{
            arr = val.split('.');
            rst = arr[1]-arr[0];
            if(rst !== 1){
                alert('Remate no valido.');
                elem.value = '';
            }
            else{
                elem.value = pad(arr[0],2)+'.'+pad(arr[1],2);
            }
        }
    }
};