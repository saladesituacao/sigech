
<?php 

include("../../cabecalho_menu.php"); 
include("../../classes/Usuario.php");



$acao = 'I';
$usuario = new Usuario();

if ($_POST['cod_usuario'] != ''){

	$acao = 'A';

	if (!$usuario->carregar($_POST['cod_usuario'])){
		alert('Erro ao carregar usu�rio!');
		voltar();
		exit();
	}

}

?>

<script language="javascript">

function validar(){

	if (frmCadastro.txt_nome.value == ''){
		alert('Informe o nome!');
		frmCadastro.txt_nome.focus();
		return false;
	}

	if (frmCadastro.txt_login.value == ''){
		alert('Informe o login!');
		frmCadastro.txt_login.focus();
		return false;
	}


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


	
	if (frmCadastro.txt_email.value == ''){
		alert('Informe o e-mail!');
		frmCadastro.txt_email.focus();
		return false;
	}

	if (frmCadastro.cod_cargo.value == ''){
		alert('Informe o cargo!');
		frmCadastro.cod_cargo.focus();
		return false;
	}

	if (frmCadastro.cod_orgao.value == ''){
		alert('Informe a lotação!');
		frmCadastro.cod_orgao.focus();
		return false;
	}

	if (frmCadastro.cod_perfil.value == ''){
		alert('Informe o perfil!');
		frmCadastro.cod_perfil.focus();
		return false;
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
            <h3 class="header-page__title">CADASTRO DE USUÁRIOS </h3><P>
        </header>
        <div class="clearfix"></div>
		<div class="row">
            <div class="form-group col-md-6">
			      <label for="exampleInputEmail1">Nome completo:</label>
			      	<input type="text" maxlength="100" size="80" class="form-control"   placeholder="Obrigatório" name="txt_nome" value="<?php echo $usuario->nome; ?>"/>
					  </div><!--form-group-->	 
        </div><!--row-->
		 <div class="row">
            <div class="form-group col-md-6">
			      <label for="exampleInputEmail1">Login:</label>
				  <input type="text" maxlength="100" size="80" class="form-control"   placeholder="Obrigatório" name="txt_login" value="<?php echo $usuario->login; ?>"/>
					  </div><!--form-group-->	 
        </div><!--row-->
		 <div class="row">
            <div class="form-group col-md-6">
			      <label for="exampleInputEmail1">Senha:</label>
			      	<input type="password" maxlength="50" size="80" class="form-control"   placeholder="Digite a senha" name="txt_senha" value="<?php echo $usuario->senha; ?>"/>
					  </div><!--form-group-->	 
        </div><!--row-->
		 <div class="row">
            <div class="form-group col-md-6">
				  <label for="exampleInputEmail1">E-mail:</label>
			      	<input type="text" maxlength="50" size="80" class="form-control"  placeholder="Digite o E-mail" name="txt_email" value="<?php echo $usuario->email; ?>"/>
					  </div><!--form-group-->	 
        </div><!--row-->
			 <div class="row">
            <div class="form-group col-md-6">
			      <label for="exampleInputEmail1">Telefone:</label>
			      	<input type="text" maxlength="50" size="80" class="form-control"   placeholder="Digite o Telefone" onkeypress="mask(this,'(00)0000-0000', 1, event)" name="txt_telefone" value="<?php echo mask($usuario->telefone,'(##)####-####'); ?>"/>
					  </div><!--form-group-->	 
        </div><!--row-->
		<div class="row">
            <div class="form-group col-md-6">
			      <label for="matricula">Matricula:</label>
			      	<input type="text" maxlength="50" size="80" class="form-control"  placeholder="Digite a Matricula" name="txt_matricula" value="<?php echo $usuario->matricula; ?>"/>
					  </div><!--form-group-->	 
        </div><!--row-->

		 <div class="row">
            <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Cargo:</label>			
                <select id="cod_cargo" name="cod_cargo" class="chosen-select" data-placeholder="Obrigatório">
                    <option></option>
                    <?php                        
                        $q = pg_query("SELECT cod_cargo, txt_cargo FROM sigech.tb_cargo WHERE cod_ativo = 1 ORDER BY txt_cargo");
                        while ($row = pg_fetch_array($q)) 
                        { ?>
                            <option value="<?=$row["cod_cargo"]?>"<?php if ($usuario->codCargo == $row["cod_cargo"]) { echo("selected");}?>><?=$row["txt_cargo"] ?></option>
                        <?php	
                        } ?>
                </select>
            </div><!--form-group-->	 
        </div><!--row-->
        <div class="row">
            <div class="form-group col-md-6">   
                <label for="exampleInputEmail1">Lotação:</label>                            
                <select id="cod_orgao" name="cod_orgao" class="chosen-select" data-placeholder="Obrigatório">
                    <option></option>                            
                    <?php                                                    
                    $q = pg_query("SELECT cod_orgao, txt_sigla FROM sigech.tb_orgao WHERE cod_ativo = 1 ORDER BY txt_sigla");
                    while ($row = pg_fetch_array($q)) 
                    { ?>
                        <option value="<?=$row["cod_orgao"]?>"<?php if ($usuario->codOrgao == $row["cod_orgao"]) { echo("selected");}?>><?=$row["txt_sigla"] ?></option>
                    <?php	
                    } ?>
                </select>
            </div><!--form-group-->
        </div><!--row-->
        <div class="row">
            <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Perfil:</label>			
                <select id="cod_perfil" name="cod_perfil" class="chosen-select" data-placeholder="Obrigatório">
                    <option></option>
                    <?php                        
                        $q = pg_query("SELECT cod_perfil, txt_perfil FROM sigech.tb_perfil WHERE cod_ativo = 1 ORDER BY txt_perfil");
                        while ($row = pg_fetch_array($q)) 
                        { ?>
                            <option value="<?=$row["cod_perfil"]?>"<?php if ($usuario->codPerfil == $row["cod_perfil"]) { echo("selected");}?>><?=$row["txt_perfil"] ?></option>
                        <?php	
                        } ?>
                </select>
            </div><!--form-group-->	 
        </div><!--row-->    

		<div class="form-group">
		<center>
		<?php if (permissao_acesso(290)) { ?>
		<button class="btn btn-default" onClick="voltar();"><i class="fa fa-keyboard-o" style="font-size:24px;color:blue"></i> Salvar</button>  
		<?php } ?> 
		<button class="btn btn-default" onclick="history.go(-1)"><i class="fa fa-eraser" style="font-size:24px;color:red"></i> Voltar</button>  
		</div>
	</form>
    </div><!-- /container -->
</div>
	
  
</body>
</html>
<?php include("../../rodape.php"); ?>