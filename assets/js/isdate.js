/*//////////////////////////////////////////////////////////////////////////
|| Fun��o para checagem de datas e convers�o de char para date
|| Autor Leonardo Marchini Loureiro
|| leonardo@loureiro.as
||
||   language="JavaScript"
|| last modified: february 06, 2003
/*//////////////////////////////////////////////////////////////////////////


anominimo = "1900" // Seta o menor ano possivel
var dias, mes, dia, ano;

function isDate(campo, msg){

	if (msg == undefined)
		msg = "Data invalida";

	data = campo.value;
	if (data){
		if ( (data.length == 10 && data.substring(2,3) == "/") && (data.substring(5,6) == "/") && (data.substring(6,10) >= anominimo) ){
			mes = data.substring(3,5);
			ano = data.substring(6,10);
			switch (mes){
				case "01": dias = "31"; break;
				case "02":
						if (ano % 4 == 0){
							dias = "29";
						}else{
							dias = "28";
						}
						break;
				case "03": dias = "31"; break;
				case "04": dias = "30"; break;
				case "05": dias = "31"; break;
				case "06": dias = "30"; break;
				case "07": dias = "31"; break;
				case "08": dias = "31"; break;
				case "09": dias = "30"; break;
				case "10": dias = "31"; break;
				case "11": dias = "30"; break;
				case "12": dias = "31"; break;
				default: dias = "00"; break;
			}
			if (data.substring(0,2) <= dias  && data.substring(0,2) > 0){
				return true;
			}else{
					alert(msg);					
					//campo.select();
					//campo.focus();
					return false;
			}
		}else{
			alert(msg);			
			//campo.select();
			//campo.focus();			
			return false;
		}
	}
	return true;
}


function cDate(campo){
	if (isdate(campo)){
		ano = campo.substring(6,10);
		mes = campo.substring(3,5);
		dia = campo.substring(0,2);
		data = new Date(ano, mes-1, dia);
		return data;
	}
}

function dateBra2Usa(data){
	data = data.substring(3,5)+'/'+data.substring(0,2)+'/'+data.substring(6,10);
	data = new Date(data);
	return data;
}

function now(){
	var data, dia, mes;
	data = new Date();

	dia = data.getDate().toString();
	mes = (parseInt(data.getMonth())+1).toString();

	if (dia.length < 2)
		dia = '0' + dia;
	if (mes.length < 2)
		mes = '0' + mes;

	return dia +'/'+ mes + '/' + data.getFullYear();
}

function dateDiff(date1,date2){
	date1 	= dateBra2Usa(date1);
	date2	= dateBra2Usa(date2);
	return ((date1-date2)/(1000*60*60*24));
}

function addDate(date,dias){
	var oData = dateBra2Usa(date);
	
	oData = new Date(oData.getTime() + (dias * 24 * 60 * 60 * 1000));
	
	var dia = oData.getDate().toString();
	var mes = (oData.getMonth()+1).toString();
	var ano = oData.getFullYear();		
	
	if (dia.length < 2){dia = '0' + dia;}
	if (mes.length < 2){mes = '0' + mes;}
	
	return dia + '/' + mes + '/' + ano;
}

function idade(dtNascimento) {
    //var ret = parseInt(dateDiff(now(), dtNascimento)/366);
	
	// Separar a data in�cio
	var diaN = dtNascimento.substring(0,2)
	var mesN = dtNascimento.substring(3,5)
	var anoN = dtNascimento.substring(6,10)
	// Separar a data fim
	var dtAtual = now();
	var diaA = dtAtual.substring(0,2)
	var mesA = dtAtual.substring(3,5)
	var anoA = dtAtual.substring(6,10)
	
	// Calcular diferen�a entre anos
	var qtAnos = parseInt(anoA - anoN)-1;
	
	// Verificar se mes de nascimento � menor que atual
	if (mesA > mesN){
		qtAnos = qtAnos + 1;
	}
	
	// Verificar se � mesmo mes de nascimento
	if (mesA == mesN){
		if (diaA >= diaN){
			qtAnos = qtAnos + 1;
		}		
	}
	
    return qtAnos;
}

function validarMesmoMes(dtIni, dtFim){
var diaIni, mesIni, anoIni;
var diaFim, mesFim, anoFim;

	if (dtIni == ''){
		alert('A data in�cio n�o foi informada!');
		return false;
	}
	if (dtFim == ''){
		alert('A data final n�o foi informada!');
		return false;
	}

	// Separar a data in�cio
	diaIni = dtIni.substring(0,2)
	mesIni = dtIni.substring(3,5)
	anoIni = dtIni.substring(6,10)
	// Separar a data fim
	diaFim = dtFim.substring(0,2)
	mesFim = dtFim.substring(3,5)
	anoFim = dtFim.substring(6,10)

	// Verificar se � o mesmo ano
	if (anoIni == anoFim && (mesFim - mesIni > 3)){
		alert('O per�odo de pesquisa deve ser de no maximo 3 meses!');
		return false;
	}		
	
	if (anoFim - anoIni > 1){
		alert('O per�odo de pesquisa deve ser de no maximo 3 meses!');
		return false;
	}	
	
	if (anoIni != anoFim && ((parseInt(mesFim) + 12) - mesIni) > 3) {
		alert('O per�odo de pesquisa deve ser de no maximo 3 meses!');
		return false;

	}
	
	return true;
	
}

function validarMesAno(data){
	
	if (data == ''){
		alert('Data invalida!\nO formato correto �: MM/AAAA');
		return false;
	}
	
	if (data.length != 7){
		alert('Data invalida!\nO formato correto �: MM/AAAA');
		return false
	} 
				
	if (isNaN(data.substr(0,2))){
		alert('Data invalida!\nO formato correto �: MM/AAAA');
		return false
	} 
					
	if (data.substr(0,2) > 12){
		alert('Data invalida!\nO formato correto �: MM/AAAA');
		return false
	} 

	if (data.substr(2,1) != '/'){
		alert('Data invalida!\nO formato correto �: MM/AAAA');
		return false
	} 

	if (isNaN(data.substr(3,4))){
		alert('Data invalida!\nO formato correto �: MM/AAAA');
		return false
	}

	if (data.substr(3,4) <= 1900 || data.substr(3,4) >= 2500){
		alert('Data invalida!\nO formato correto �: MM/AAAA');
		return false
	} 
	
	return true;

}