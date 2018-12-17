<?php
error_reporting(0);
include("../../classes/Acesso.php");
include("../../classes/Usuario.php");
include("../../rotinas_comuns.php");


$usuario = new Usuario();


// Verificar ação
switch ($_POST['acao']) {

	case "A":
		carregarParametros($usuario);

		if (!$usuario->alterar()){
			alert("Erro ao alterar usuário. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Usuário alterado com sucesso!");
			
			redirecionar('listar_usuario.php?output=html');
		}
		  break;
		  
		  case "AS":
		  carregarParametros($usuario);
  
		  if (!$usuario->alterarsenha()){
			  alert("Erro ao alterar senha. Favor contactar o administrador do sistema.");
			  voltar();
		  }else{
			  alert("Senha alterada com sucesso!");
			  redirecionar('../../dashboard/index.php?output=html');
		  }
			break;

	case "D":
		carregarParametros($usuario);

		if (!$usuario->desativar()){
			alert("Erro ao desativar usuário. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Usuário desativado com sucesso!");
			//exit();
			redirecionar('listar_usuario.php?output=html');
		}
      	break;

	case "R":
		carregarParametros($usuario);

		if (!$usuario->reativar()){
			alert("Erro ao reativar usuário. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Usuário ativado com sucesso!");
			redirecionar('listar_usuario.php?output=html');
		}
      	break;

	case "I":
		carregarParametros($usuario);

		if (!$usuario->incluir()){
			alert("Erro ao incluir usuário. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Usuário incluido com sucesso!");
			redirecionar('listar_usuario.php?output=html');
		}
      	break;
	default:
		alert("Ação não esperada!");
		voltar();
		break;


}

    
function carregarParametros($usuario){

	$usuario->id 		                = $_POST['cod_usuario'];
	$usuario->nome 		                = $_POST['txt_nome'];
	$usuario->email		                = $_POST['txt_email'];
	$usuario->login 	                = $_POST['txt_login'];
	$usuario->senha 	                = $_POST['txt_senha'];
	$usuario->telefone	                = retornarNumeros($_POST['txt_telefone']);
	$usuario->matricula	                = $_POST['txt_matricula'];
	$usuario->codCargo	                = $_POST['cod_cargo'];
	$usuario->codOrgao	                = $_POST['cod_orgao'];
	$usuario->codPerfil	                = $_POST['cod_perfil'];

}

include("../../classes/FechaAcesso.php");
?>
