<?php 

include("../../cabecalho_menu.php"); 
include("../../classes/Estabelecimento.php");
include("../../options/optEstabelecimento.php");



$estabelecimento = new Estabelecimento();

$acao = 'A';
if ($_POST['cod_estabelecimento'] != ''){

	

	if (!$estabelecimento->carregar($_POST['cod_estabelecimento'])){
		alert('Erro ao carregar estabelecimento!');
		voltar();
		exit();
	}

}else{

	alert('Erro ao carregar dados do estabelecimento!');
	voltar();
	exit();
}

?>

<script language="javascript">

function validar(){

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

	if (frmCadastro.cod_classificacao_estabelecimento.value == ''){
		alert('Informe a classificação do estabelecimento');
		frmCadastro.cod_classificacao_estabelecimento.focus();
		return false;
	}


	if (frmCadastro.txt_telefone_contato.value == ''){
		alert('Informe o telefone');
		frmCadastro.txt_telefone_contato.focus();
		return false;
	}
	return true;
}
</script>
 <div class="panel-body">
<form name="frmCadastro" class="form-horizontal" action="estabelecimento_manter.php" method=post onSubmit="return validar()">
<input type="hidden" name="acao" value="<?php echo $acao; ?>">
<input type="hidden" name="cod_estabelecimento" value="<?php echo $estabelecimento->id; ?>">
	<div class="container">
        <header class="header-page">
            <h3 class="header-page__title">CADASTRO DE ESTABELECIMENTOS </h3><P>
        </header>
        <div class="clearfix"></div>
	   
		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Estabelecimento:</label>
                   <div class="col-sm-6">
				   <?php echo $estabelecimento->nome; ?>
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Classificação:</label>
                   <div class="col-sm-6">
				   <select name="cod_classificacao_estabelecimento">
					<option>
					<?php optClassificacaoEstabelecimento($estabelecimento->classificacao)?>
				</select>
                    </div>
		</div>
		
		
		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Nome do Contato:</label>
                   <div class="col-sm-6">
			      	<input type="text" maxlength="100" size="80" class=" "   placeholder="Digite o nome completo" name="txt_nome_contato" value="<?php echo $estabelecimento->nomeContato; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>

		

		<div class="form-group">
			      <label class="control-label col-sm-2" for="senha">E-mail:</label>
                   <div class="col-sm-6">
				   <input type="text" maxlength="100" size="80" class=" "   placeholder="Digite o e-mail" name="txt_email_contato" value="<?php echo $estabelecimento->emailContato; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>

		<div class="form-group">
			      <label class="control-label col-sm-2" for="fone">Telefone:</label>
                   <div class="col-sm-6">
			      	<input type="text" maxlength="50" size="80" class=" "   placeholder="Digite o Telefone" onkeypress="mask(this,'(00)0000-0000', 1, event)" name="txt_telefone_contato" value="<?php echo mask($estabelecimento->telefoneContato,'(##)####-####'); ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>

		<div class="form-group">
		<center>
		<?php  if (permissao_acesso(35))               
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