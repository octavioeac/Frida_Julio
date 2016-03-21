function ubicacion(id){
    var nom = $('#'+id).val();
    if(nom !== ''){
		var regExpOb = /^[A-Z0-9]{1,2}\.[A-Z0-9]{1}[0-9]{3,4}[A|B|H|X][0-9]{1,2}$/i;
		var ax = regExpOb.test(nom);
		if(ax){
			if(/[A-Z]/i.test(nom.substring(1,2).toUpperCase())){
				if(parseInt(nom.substring(0,1))!==0){
					alert('No Valido/nUn ejemplo valido sigue el siguiente formato: Piso.SalaGrupoFilaLadoBastidor');
					$('#'+id).val('');
				}
			}
		}
		else{
			alert('No valido/nUn ejemplo valido sigue el siguiente formato: Piso.SalaGrupoFilaLadoBastidor');
			$('#'+id).val('');
		}
	}
}
function repisa(id){
    var nom = $('#'+id).val();
    if(nom !== ''){
		var regExpOb = /^[0-9][0-9][0-9][0-9]$/i;
		var rs = regExpOb.test(nom);
		if(!rs){
			alert('No valido.  Un ejemplo valido, por ejemplo, es: 0101');
			$('#'+id).val('');
		}
	}
}
function blurval(g){
    var flag = 0;
    var numbers = new Array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
	//var or_rango = $('input[name="' + g + '"]').val();
	var or_rango = $('#'+g+'').val();
	if(or_rango != ''){
		var search_rango = 0;
		if (or_rango.length > 2) {
			search_rango = or_rango.indexOf('.');
			if (search_rango === -1) {
				alert('Esta candena no tiene punto separador.\nEscriba un solo numero o intervalo de rangos. Por ejemplo: 45 o 5.12.')
			} else {
				if (search_rango === 0 || search_rango === 4) {
					alert('El punto no puede ir en esa posicion.\nEscriba un solo numero o intervalo de rangos. Por ejemplo: 45 o 5.12.')
				} else {
					var subuno = or_rango.substring(0, search_rango);
					var subdos = or_rango.substring(search_rango + 1, 5);
					if (isNaN(subuno) === true) {
						alert('Su cadena no es numerica.\nEscriba un solo numero o intervalo de rangos. Por ejemplo: 45 o 5.12.')
					} else if (subuno == 0 || subuno == 00 || subuno > 99) {
						alert('Solo puede escribir numeros del 1 al 99.\nEscriba un solo numero o intervalo de rangos. Por ejemplo: 45 o 5.12.')
					} else {
						if (isNaN(subdos) === true) {
							alert('Su cadena no es numerica.\nEscriba un solo numero o intervalo de rangos. Por ejemplo: 45 o 5.12.')
						} else if (subdos == 0 || subdos == 00 || subdos > 99) {
							alert('Solo puede escribir numeros del 1 al 99.\nEscriba un solo numero o intervalo de rangos. Por ejemplo: 45 o 5.12.')
						} else {
							if (subuno.length === 1) {
								for (var i = 0; i <= 9; i++) {
									if (numbers[i] == subuno) {
										subuno = '0' + subuno;
										break
									}
								}
							}
							if (subdos.length === 1) {
								for (var i = 0; i <= 9; i++) {
									if (numbers[i] == subdos) {
										subdos = '0' + subdos;
										break
									}
								}
							}
							$('#'+g+'').val(subuno + '.' + subdos);
							flag = 1
						}
					}
				}
			}
		} else {
			if (or_rango === '' || or_rango == 0 || or_rango == 00) {
				alert('Favor de ingresar un valor en el campo que no sea cero ni letra.\nEscriba un solo numero o intervalo de rangos. Por ejemplo: 45 o 5.12.')
			} else {
				if (or_rango.length === 1) {
					if (isNaN(or_rango) == true) alert('Por favor digite un numero entre el  1 y el 99.\nEscriba un solo numero o intervalo de rangos. Por ejemplo: 45 o 5.12.');
					else {
						for (var i = 0; i <= 9; i++) {
							if (numbers[i] == or_rango) {
								$('#'+g+'').val('0' + or_rango);
								break
							}
						}
						flag = 1
					}
				} else {
					if (isNaN(or_rango) == true) {
						alert('Por favor digite un numero entre el  1 y el 99.\nEscriba un solo numero o intervalo de rangos. Por ejemplo: 45 o 5.12.')
					} else {
						flag = 1
					}
				}
			}
		}
		if(flag === 0){
			$('#'+g+'').val('');
		}
	}
}

function verticalDg(id){
    var nom = $('#'+id).val();
    if(nom !== '')
	{
		var regExpOb = /^[0-9][0-9][A-Z]$/i;
		var ax = regExpOb.test(nom);
		if(!ax){
			alert('No valido.  Un ejemplo valido, por ejemplo, es: H=10,N=F ... 10F');
			$('#'+id).val('');
		}
	}
}

function refLong(id)
{
    var nom = $('#'+id).val();
    if(nom !== '')
	{
		if(nom.length<13)
		{
			alert('Referencia no Valida!!!');
			$('#'+id).val('');
		}
	}
}