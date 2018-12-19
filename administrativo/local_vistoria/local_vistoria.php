<?php 

include("../../cabecalho_menu.php"); 
include("../../classes/LocalVistoria.php");


$acao = 'I';
$localvistoria = new LocalVistoria();

if ($_POST['cod_local_vistoria'] != ''){

	$acao = 'A';

	if (!$localvistoria->carregar($_POST['cod_local_vistoria'])){
		alert('Erro ao carregar local de vistoria!');
		voltar();
		exit();
	}

}

?>

<script language="javascript">

function validar(){

	if (frmCadastro.txt_local_vistoria.value == ''){
		alert('Informe o nome do local da vistoria!');
		frmCadastro.txt_local_vistoria.focus();
		return false;
	}

	return true;
}
</script>
 <div class="panel-body">
<form name="frmCadastro" class="form-horizontal" action="local_vistoria_manter.php" method=post onSubmit="return validar()">
<input type="hidden" name="acao" value="<?php echo $acao; ?>">
<input type="hidden" name="cod_local_vistoria" value="<?php echo $localvistoria->id; ?>">
	<div class="container">
        <header class="header-page">
            <h3 class="header-page__title">CADASTRO DE LOCAL DE VISTORIA </h3><P>
        </header>
        <div class="clearfix"></div>
	   
	    <div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Nome do local de vistoria:</label>
                   <div class="col-sm-6">
			      	<input type="text" maxlength="100" size="80" class=" "   placeholder="Digite o nome completo" name="txt_local_vistoria" value="<?php echo $localvistoria->localvistoria; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>

		

		<div class="form-group">
		<center>
		<?php	
			if (permissao_acesso(41))
                {?>
		<button class="btn btn-default" onClick="voltar();"><i class="fa fa-keyboard-o" style="font-size:24px;color:blue"></i> Salvar</button>  
		<?php }?>
		<button class="btn btn-default" onclick="history.go(-1)"><i class="fa fa-eraser" style="font-size:24px;color:red"></i> Voltar</button>  
		</div>
	</form>
    </div><!-- /container -->
</div>
	

</body>
</html>
<?php include("../../rodape.php"); ?>