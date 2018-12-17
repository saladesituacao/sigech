function js_alert(titulo, mensagem)
{
    $.alert({
        title: titulo,
        content: mensagem,
    });
}

function js_go(txt_pagina)
{
    self.location.href=txt_pagina;
}

function somenteNumeros(num) {
    var er = /[^0-9.]/;
    er.lastIndex = 0;
    var campo = num;
    if (er.test(campo.value)) {
      campo.value = "";
    }
}


function FormataData(campo, teclapres) {
	var tecla = teclapres.keyCode;
	vr = campo.value;
	vr = vr.replace( ".", "" );
	vr = vr.replace( "/", "" );
	vr = vr.replace( "/", "" );
	tam = vr.length + 1;
	
	if ( tecla != 9 && tecla != 8 ){
		if ( tam > 2 && tam < 5 )
			campo.value = vr.substr( 0, tam - 2  ) + '/' + vr.substr( tam - 2, tam );
		if ( tam >= 5 && tam <= 10 )
			campo.value = vr.substr( 0, 2 ) + '/' + vr.substr( 2, 2 ) + '/' + vr.substr( 4, 4 );
	}
}

function isNumberKey(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	if ((charCode > 47 && charCode < 58) || (charCode > 92 && charCode < 106) || charCode == 8 || charCode == 9 || charCode == 13 || charCode == 17 || charCode == 35 || charCode == 36 || charCode == 37 || charCode == 39 || charCode == 46)
		return true;
	return false;
}

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

function validateDate(dataentrada) {
    var patternData = /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/;

    if(!patternData.test(dataentrada)) {        
        return false;
    } else {
        return true;
    }
}

function go(obj) {
	var txt_pagina = obj.value;
	obj.selectedIndex = 0;
	obj.disabled = true;

	self.location.href = txt_pagina;

	obj.disabled = false;
}