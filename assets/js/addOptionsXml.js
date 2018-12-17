//----------------------------------------------------------------------
var optInicialTx = '';// Texto da opção inicial
var optInicialVl = '';// Texto da opção inicial


// Adicionar valores no combo
function addOptionsXml(oXmlList, colValor, colNome, nomeCmb){

	try {			
		// Adicionar option 'Todos'		
		var Op = document.createElement("OPTION");
        	Op.text = optInicialTx;
        	Op.value = optInicialVl;
		
        	document.getElementsByName(nomeCmb)[0].options.add(Op);
        
		// Variáveis para carregar combo
		var valor  = '';
		var texto  = '';
		var tagAux = '';
		var tagAux2= '';

		for (var i = 0; i < oXmlList.length; i++){
			
			valor = oXmlList[i].getElementsByTagName(colValor)[0].firstChild.nodeValue;
			texto = oXmlList[i].getElementsByTagName(colNome)[0].firstChild.nodeValue;
				
			// Add option
			Op = document.createElement("OPTION");
                	Op.text = texto;
                	Op.value = valor;

			document.getElementsByName(nomeCmb)[0].options.add(Op);
						
		}
	}catch(e){
		this.msgErro = 'Erro inesperado. Contacte o Administrador';
	}
	
}
