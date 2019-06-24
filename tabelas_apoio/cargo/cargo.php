<?php 

include("../../cabecalho_menu.php"); 
include("../../classes/Cargo.php");


$acao = 'I';
$cargo = new Cargo();

if ($_POST['cod_cargo'] != ''){

	$acao = 'A';

	if (!$cargo->carregar($_POST['cod_cargo'])){
		alert('Erro ao carregar cargo!');
		voltar();
		exit();
	}

}

?>

<script language="javascript">

function validar(){

	if (frmCadastro.txt_cargo.value == ''){
		alert('Informe o cargo!');
		frmCadastro.txt_cargo.focus();
		return false;
	}

	

		
	return true;
}
</script>
 <div class="panel-body">
<form name="frmCadastro" class="form-horizontal" action="cargo_manter.php" method=post onSubmit="return validar()">
<input type="hidden" name="acao" value="<?php echo $acao; ?>">
<input type="hidden" name="cod_cargo" value="<?php echo $cargo->id; ?>">
	<div class="container">
        <header class="header-page">
            <h3 class="header-page__title">CADASTRO DE CARGOS </h3><P>
        </header>
        <div class="clearfix"></div>
	   
	    <div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Nome do cargo:</label>
                   <div class="col-sm-6">
			      	<input type="text" maxlength="100" size="80" class=" "   placeholder="Digite o nome do cargo" name="txt_cargo" value="<?php echo $cargo->cargo; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>

		<div class="form-group">
			      <label class="control-label col-sm-2" for="login">Descriçaõ:</label>
                   <div class="col-sm-6">
			      	<input type="text" maxlength="50" size="80" class=" "   placeholder="Digite a descrição" name="txt_descricao" value="<?php echo $cargo->descricao; ?>"/>
		          	
                    </div>
		</div>

		<div class="form-group">
		<center>
		<?php if (permissao_acesso(291)) {?>
		<button class="btn btn-default"><i class="fa fa-keyboard-o" style="font-size:24px;color:blue"></i> Salvar</button>  
		<?php }?>
		<button class="btn btn-default" onclick="history.go(-1)"><i class="fa fa-eraser" style="font-size:24px;color:red"></i> Voltar</button>  
		</div>
	</form>
    </div><!-- /container -->
</div>
	
  
</body>
</html>
<?php include("../../rodape.php"); ?>