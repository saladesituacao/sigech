<?php 

include("../../cabecalho_menu.php"); 
include("../../classes/EtapaProcessoHabilitacao.php");



$etapaProcessoHabilitacao = new EtapaProcessoHabilitacao();

$acao = 'A';
if ($_POST['cod_etapa_processo_habilitacao'] != ''){

	

	if (!$etapaProcessoHabilitacao->carregar($_POST['cod_etapa_processo_habilitacao'])){
		alert('Erro ao carregar etapa!');
		voltar();
		exit();
	}

}else{

	alert('Erro ao carregar dados da etapa!');
	voltar();
	exit();
}

?>

<script language="javascript">

function validar(){

	
	if (frmCadastro.ds_etapa.value == ''){
		alert('Informe a etapa!');
		frmCadastro.ds_etapa.focus();
		return false;
	}
	
	
	if (frmCadastro.qtd_dias.value == ''){
		alert('Informe a quantidade de dias!');
		frmCadastro.qtd_dias.focus();
		return false;
	}


	if (frmCadastro.txt_nome_contato.value == ''){
		alert('Informe o nome!');
		frmCadastro.txt_nome_contato.focus();
		return false;
	}

	if (frmCadastro.txt_email_contato.value == ''){
		alert('Informe o e-mail!');
		frmCadastro.txt_email_contato.focus();
		return false;
	}


	if (frmCadastro.txt_telefone_contato.value == ''){
		alert('Informe o telefone!');
		frmCadastro.txt_telefone_contato.focus();
		return false;
	}

	
	return true;
}
</script>
 <div class="panel-body">
<form name="frmCadastro" class="form-horizontal" action="etapa_processo_habilitacao_manter.php" method=post onSubmit="return validar()">
<input type="hidden" name="acao" value="<?php echo $acao; ?>">
<input type="hidden" name="cod_etapa_processo_habilitacao" value="<?php echo $etapaProcessoHabilitacao->id; ?>">
	<div class="container">
        <header class="header-page">
            <h3 class="header-page__title">CADASTRO DE ETAPAS PARA O PROCESSO DE HABILITAÇÃO </h3><P>
        </header>
        <div class="clearfix"></div>
	   
		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Etapa:</label>
                   <div class="col-sm-6">
				   <input type="text" maxlength="300" size="80" class=" "   placeholder="Digite o nome da etapao" name="ds_etapa" value="<?php echo $etapaProcessoHabilitacao->descricao; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
				   
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Quantidade de Dias:</label>
                   <div class="col-sm-6">
				   <input type="text" maxlength="3" size="3" class=" "   placeholder="Digite a quantidade de dias " name="qtd_dias" value="<?php echo $etapaProcessoHabilitacao->qtd; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>
		
		
		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Nome do Contato:</label>
                   <div class="col-sm-6">
			      	<input type="text" maxlength="100" size="80" class=" "   placeholder="Digite o nome completo" name="txt_nome_contato" value="<?php echo $etapaProcessoHabilitacao->nomeContato; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>

		

		<div class="form-group">
			      <label class="control-label col-sm-2" for="senha">E-mail:</label>
                   <div class="col-sm-6">
				   <input type="text" maxlength="100" size="80" class=" "   placeholder="Digite o e-mail" name="txt_email_contato" value="<?php echo $etapaProcessoHabilitacao->emailContato; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>

		<div class="form-group">
			      <label class="control-label col-sm-2" for="fone">Telefone:</label>
                   <div class="col-sm-6">
			      	<input type="text" maxlength="50" size="80" class=" "   placeholder="Digite o Telefone" onkeypress="mask(this,'(00)0000-0000', 1, event)" name="txt_telefone_contato" value="<?php echo mask($etapaProcessoHabilitacao->telefoneContato,'(##)####-####'); ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>

		<div class="form-group">
		<center>
		
		<?php  if (permissao_acesso(38))               
                {?>
		<button class="btn btn-default"><i class="fa fa-keyboard-o" style="font-size:24px;color:blue"></i> Salvar</button>  
		<?php  } ?>
		<button class="btn btn-default" onclick="history.go(-1)"><i class="fa fa-eraser" style="font-size:24px;color:red"></i> Voltar</button>  
		</div>
	</form>
    </div><!-- /container -->
</div>


</body>
</html>
<?php include("../../rodape.php"); ?>