<?php 
include("../../cabecalho_menu.php"); 
include("../dados/hospital.php"); 
include("../../options/optAreaHabilitacao.php");

?>

<script language="javascript">
 
function validar(){


if (frmCadastro.cod_area_habilitacao.value == '0'){
		alert('Informe a área de habilitação!');
		frmCadastro.cod_area_habilitacao.focus();
		return false;
	}


if (frmCadastro.cod_servico.value == '0'){
		alert('Informe o serviço de habilitação!');
		frmCadastro.cod_servico.focus();
		return false;
	}


	
	if (frmCadastro.vl_valor.value == ''){
		alert('Informe o valor!');
		frmCadastro.vl_valor.focus();
		return false;
	}
	
	
	if (frmCadastro.ds_portaria.value == ''){
		alert('Informe a portaria!');
		frmCadastro.ds_portaria.focus();
		return false;
	}


	if (frmCadastro.nr_leitos.value == ''){
		alert('Informe o número de leitos!');
		frmCadastro.nr_leitos.focus();
		return false;
	}

if (frmCadastro.ds_nr_processo.value == ''){
		alert('Informe o número do processo!');
		frmCadastro.ds_nr_processo.focus();
		return false;
	}

	if (frmCadastro.ds_meio_processo.value == ''){
		alert('Informe o meio do processo!');
		frmCadastro.ds_meio_processo.focus();
		return false;
	}

if (frmCadastro.ds_localizacao_processo.value == ''){
		alert('Informe a localização do processo!');
		frmCadastro.ds_localizacao_processo.focus();
		return false;
	}

	if (frmCadastro.txt_url_portaria.value == ''){
		alert('Informe a URL da portaria!');
		frmCadastro.txt_url_portaria.focus();
		return false;
	}


	if (frmCadastro.dtInicio.value == ''){
		alert('Informe a DATA de início do processo!');
		frmCadastro.dtInicio.focus();
		return false;
	}

	
	return true;
}




var Ajax = false;

function AjaxRequest() {
				Ajax = false;
				
		        if (window.XMLHttpRequest) { // Mozilla, Safari,...
		            Ajax= new XMLHttpRequest();
					
		        } else if (window.ActiveXObject) { // IE
		            try {
		                Ajax = new ActiveXObject("Msxml2.XMLHTTP");
		            } catch (e) {
		                try {
		                    Ajax = new ActiveXObject("Microsoft.XMLHTTP");
		                } catch (e) {}
		            }
		        }		
			}
			



function selecionarServico()
 { 
	
	
	var cod_area_habilitacao = document.getElementById('cod_area_habilitacao').value;
	
			
					AjaxRequest(); 
					if(!Ajax)
					 {
						alert('Não foi possível iniciar o AJAX');
						return;
					}
	        		Ajax.onreadystatechange = mostraServico;
					Ajax.open('GET', '../lista_servico.php?cod_area_habilitacao='+cod_area_habilitacao, true);
        			Ajax.send(null);
} 

function mostraServico() 
{ 



				if (Ajax.readyState == 4)
				 {
					
            		if (Ajax.status == 200)
					{
						
						var selp = document.frmCadastro.cod_servico;
						selp.options.length = 0;

						var xmldoc = Ajax.responseText.split(","); 
						if(xmldoc == 0) //retorna verdadeiro caso o elemento referenciado possua nós filhos e falso caso contrário
						 {
						   return false;
						 }
						 else
						 {
							 
							for(var i=0;i < xmldoc.length;i++)
							 {
								string = xmldoc[i].split( "|" );
								selp.options[i] = new Option(string[1], string[0]);
							}
								selp.options[i] = new Option('Selecione',0);
								selp.options.selectedIndex = i;
						}
            		}
					else
					 {
						alert('Erro no Retorno do Servidor ' + Ajax.statusText);
            		}
        		}
				
}    

 



</script>
 <div class="panel-body">
<form name="frmCadastro" class="form-horizontal" action="hospital_potencial_habilitacao_manter.php" method=post onSubmit="return validar()">
<input type="hidden" name="acao" value="ISPH">
<input type="hidden" name="cod_estabelecimento" value="<?php echo $cod; ?>">
	<div class="container">
        <header class="header-page">
            <h3 class="header-page__title">INCLUIR SERVIÇO COM POTENCIAL DE HABILITAÇÃO </h3><P>
        </header>
        <div class="clearfix"></div>
	   
		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Estabelecimento:</label>
                   <div class="col-sm-6">
				   <?PHP echo ($estabelecimento); ?>
                    </div>
		</div>
		
<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Área de habilitação:</label>
                   <div class="col-sm-6">
				   <select id="cod_area_habilitacao" name="cod_area_habilitacao" onChange="selecionarServico();">
				   <option value="0">Selecione</option>
						<?php optAreaHabilitacao("")?>
                                 </select>
								 <i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Serviço com potencial de habilitação:</label>
                   <div class="col-sm-6">
							<select id="cod_servico" name="cod_servico">
							</select>
                    </div>
		</div>
		
		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Valor:</label>
                   <div class="col-sm-6">
				   <input type="text" maxlength="50" size="20" class=" "   placeholder="Digite o valor" name="vl_valor" value="<?php echo $hospital->valor; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
				   
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Portaria:</label>
                   <div class="col-sm-6">
				   <input type="text" maxlength="50" size="50" class=" "   placeholder="Digite a portaria " name="ds_portaria" value="<?php echo $hospital->dsPortaria; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Número de leitos:</label>
                   <div class="col-sm-6">
				   <input type="text" maxlength="50" size="20" class=" "   placeholder="Digite o valor" name="nr_leitos" value="<?php echo $hospital->nrLeitos; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
				   
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Observação:</label>
                   <div class="col-sm-6">
				   <textarea rows="3" name="ds_observacao" style="width:99%"></textarea>
                    </div>
		</div>
		

		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Número do processo:</label>
                   <div class="col-sm-6">
			      	<input type="text" maxlength="50" size="20" class=" "   placeholder="Digite número do processo" name="ds_nr_processo" value="<?php echo $hospital->dsNrProcesso; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>

		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Meio do processo:</label>
                   <div class="col-sm-6">
			      	<input type="text" maxlength="50" size="20" class=" "   placeholder="Digite meio do processo" name="ds_meio_processo" value="<?php echo $hospital->dsMeioProcesso; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>

		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Localização do processo:</label>
                   <div class="col-sm-6">
			      	<input type="text" maxlength="50" size="20" class=" "   placeholder="Digite a localização do processo" name="ds_localizacao_processo" value="<?php echo $hospital->dsLocalizacaoProcesso; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">URL Portaria:</label>
                   <div class="col-sm-6">
			      	<input type="text" maxlength="200" size="80" class=" "   placeholder="Digite a URL" name="txt_url_portaria" value="<?php echo $hospital->urlPortaria; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Número do processo no SEI:</label>
                   <div class="col-sm-6">
			      	<input type="text" maxlength="200" size="80" class=" "   placeholder="Digite o número do processo no SEI" name="txt_nr_processo_sei" value="<?php echo $hospital->nrProcessoSei; ?>"/>
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Data de início do processo:</label>
                   <div class="col-sm-6">
				   <input type="text" size="14" maxLength="10" onKeyPress="mask(this,'00/00/0000',1, event)" onBlur="isDate(this);" name="dtInicio" id="dtInicio" />
				   <img src="../../assets/img/calendario.gif" id="btnDtInicio" style="cursor:hand" width="24" height="12" alt="Calendário">(dd/mm/aaaa)
				<script type="text/javascript">
				    Calendar.setup({
					    inputField: 'dtInicio',
					    button: "btnDtInicio",
					    align: "Tr"
					});
				</script>	



                    </div>
		</div>

		
		<div class="form-group">
		<center>
		<button class="btn btn-default"><i class="fa fa-keyboard-o" style="font-size:24px;color:blue"></i> Salvar</button>  
		<button class="btn btn-default" onclick="history.go(-1)"><i class="fa fa-eraser" style="font-size:24px;color:red"></i> Voltar</button>  
		</div>
	</form>
    </div><!-- /container -->
</div>
</body>
</html>
<?php include("../../rodape.php"); ?>