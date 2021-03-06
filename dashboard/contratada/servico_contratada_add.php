<?php 
include("../../cabecalho_menu.php"); 
include("../dados/contratada.php"); 
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



 
	if (frmCadastro.txt_objeto_contratacao.value == ''){
		alert('Informe o objeto!');
		frmCadastro.txt_objeto_contratacao.focus();
		return false;
	}
	
	
	if (frmCadastro.nr_contrato.value == ''){
		alert('Informe o número do contrato!');
		frmCadastro.nr_contrato.focus();
		return false;
	}


	if (frmCadastro.dt_vigencia.value == ''){
		alert('Informe a data da vigência!');
		frmCadastro.dt_vigencia.focus();
		return false;
	}

	if (frmCadastro.nr_processo.value == ''){
			alert('Informe o número do processo!');
			frmCadastro.nr_processo.focus();
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
<form name="frmCadastro" class="form-horizontal" action="servico_contratada_manter.php" method=post onSubmit="return validar()">
<input type="hidden" name="acao" value="I">
<input type="hidden" name="cod_estabelecimento" value="<?php echo $cod; ?>">
	<div class="container">
        <header class="header-page">
            <h3 class="header-page__title">INCLUIR SERVIÇO CONTRATADO </h3><P>
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
			      <label class="control-label col-sm-2" for="nome">Serviço habilitado:</label>
                   <div class="col-sm-6">
							<select id="cod_servico" name="cod_servico">
							</select>
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Objeto:</label>
                   <div class="col-sm-6">
				   <textarea rows="3" name="txt_objeto_contratacao" placeholder="Digite o objeto do contrato" style="width:99%"></textarea>
                    </div>
		</div>
		
		
		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Número do Contrato:</label>
                   <div class="col-sm-6">
						<input type="text" maxlength="100" size="20" class=" "   placeholder="Digite o número do contrato" name="nr_contrato" value=""/>
							<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Data de vigência:</label>
                   <div class="col-sm-6">
						<input type="text" size="14" maxLength="10" onKeyPress="mask(this,'00/00/0000',1, event)" onBlur="isDate(this);" name="dt_vigencia" id="dt_vigencia" />
						<img src="../../assets/img/calendario.gif" id="btnDtVigencia" style="cursor:hand" width="24" height="12" alt="Calendário">(dd/mm/aaaa)
						<script type="text/javascript">
							Calendar.setup({
								inputField: 'dt_vigencia',
								button: "btnDtVigencia",
								align: "Tr"
							});
						</script>	
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Número do processo:</label>
                   <div class="col-sm-6">
				   <input type="text" maxlength="100" size="20" class=" "   placeholder="Digite o valor" name="nr_processo" value=""/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
				   
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