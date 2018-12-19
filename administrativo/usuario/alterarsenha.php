<?php 

include("../../cabecalho_menu.php"); 
include("../../classes/Usuario.php");


$usuario = new Usuario();

if ($_GET['cod_usuario'] != ''){

	$acao = 'AS';

	if (!$usuario->carregar($_GET['cod_usuario'])){
		alert('Erro ao carregar usu�rio!');
		voltar();
		exit();
	}

}

?>

<script language="javascript">

function validar(){

	


	if (frmCadastro.txt_senha.value == ''){
		alert('Informe a senha!');
		frmCadastro.txt_senha.focus();
		return false;
	}else{

		if (frmCadastro.txt_senha.value.length < 4){
			alert('A senha deve ter 4 ou mais caracteres!');
			frmCadastro.txt_senha.focus();
			return false;
		}
	}



	
	return true;
}
</script>
 <div class="panel-body">
<form name="frmCadastro" class="form-horizontal" action="usuario_manter.php" method=post onSubmit="return validar()">
<input type="hidden" name="acao" value="<?php echo $acao; ?>">
<input type="hidden" name="cod_usuario" value="<?php echo $usuario->id; ?>">
	<div class="container">
        <header class="header-page">
            <h3 class="header-page__title">ALTERAR SENHA </h3><P>
        </header>
        <div class="clearfix"></div>
	   
	   

		
		<div class="form-group">
			      <label class="control-label col-sm-2" for="senha">Senha:</label>
                   <div class="col-sm-6">
			      	<input type="password" maxlength="50" size="80" class=" "   placeholder="Digite a senha" name="txt_senha" value="<?php echo $usuario->senha; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>

		

		
 
	


		<div class="form-group">
		<center>
		<button class="btn btn-default" onClick="voltar();"><i class="fa fa-keyboard-o" style="font-size:24px;color:blue"></i> Salvar</button>  
		<button class="btn btn-default" onclick="history.go(-1)"><i class="fa fa-eraser" style="font-size:24px;color:red"></i> Voltar</button>  
		</div>
	</form>
    </div><!-- /container -->
</div>
	
  
</body>
</html>
<?php include("../../rodape.php"); ?>