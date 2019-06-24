<?php 

include("../../cabecalho_menu.php"); 
include("../../classes/ClassificacaoEstabelecimento.php");


$acao = 'I';
$classificacaoEstabelecimento = new ClassificacaoEstabelecimento();

if ($_POST['cod_classificacao_estabelecimento'] != ''){

	$acao = 'A';

	if (!$classificacaoEstabelecimento->carregar($_POST['cod_classificacao_estabelecimento'])){
		alert('Erro ao carregar classificação do estabelecimento!');
		voltar();
		exit();
	}

}

?>

<script language="javascript">

function validar(){

	if (frmCadastro.txt_classificacao_estabelecimento.value == ''){
		alert('Informe o cargo!');
		frmCadastro.txt_classificacao_estabelecimento.focus();
		return false;
	}

	

		
	return true;
}
</script>
 <div class="panel-body">
<form name="frmCadastro" class="form-horizontal" action="classificacao_estabelecimento_manter.php" method=post onSubmit="return validar()">
<input type="hidden" name="acao" value="<?php echo $acao; ?>">
<input type="hidden" name="cod_classificacao_estabelecimento" value="<?php echo $classificacaoEstabelecimento->id; ?>">
	<div class="container">
        <header class="header-page">
            <h3 class="header-page__title">CLASSIFICAÇÃO DO ESTABELECIMENTO </h3><P>
        </header>
        <div class="clearfix"></div>
	   
	    <div class="form-group">
			      <label class="control-label col-sm-2" for="login">Descriçaõ:</label>
                   <div class="col-sm-6">
			      	<input type="text" maxlength="100" size="80" class=" "   placeholder="Digite a descrição" name="txt_classificacao_estabelecimento" value="<?php echo $classificacaoEstabelecimento->classificacaoEstabelecimento; ?>"/>
		          	
                    </div>
		</div>

		<div class="form-group">
		<center>
		<?php if (permissao_acesso(328)) {?>
		<button class="btn btn-default""><i class="fa fa-keyboard-o" style="font-size:24px;color:blue"></i> Salvar</button>  
		<?php }?>
		<button class="btn btn-default" onclick="history.go(-1)"><i class="fa fa-eraser" style="font-size:24px;color:red"></i> Voltar</button>  
		</div>
	</form>
    </div><!-- /container -->
</div>
	
  
</body>
</html>
<?php include("../../rodape.php"); ?>