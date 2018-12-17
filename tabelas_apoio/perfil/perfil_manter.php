<?php
error_reporting(0);
include("../../classes/Acesso.php");
include("../../classes/Perfil.php");
include("../../rotinas_comuns.php");


$perfil = new Perfil();


// Verificar ação
switch ($_POST['acao']) {

	case "A":
		carregarParametros($perfil);

		if (!$perfil->alterar()){
			alert("Erro ao alterar perfil. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Perfil alterado com sucesso!");
			
			redirecionar('listar_perfil.php?output=html');
		}
		  break;
		  
		  
	case "D":
		carregarParametros($perfil);

		if (!$perfil->desativar()){
			alert("Erro ao desativar perfil. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Perfil desativado com sucesso!");
			//exit();
			redirecionar('listar_perfil.php?output=html');
		}
		  break;
		  

	case "P":
		  carregarParametros($perfil);
  
		  if (!$perfil->permissao()){
			  alert("Erro ao atribuir permissão para o perfil. Favor contactar o administrador do sistema.");
			  voltar();
		  }else{
			  alert("Perfil ativado com sucesso!");
			  redirecionar('listar_perfil.php?output=html');
		  }
			break;



	case "R":
		carregarParametros($perfil);

		if (!$perfil->reativar()){
			alert("Erro ao reativar perfil. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Perfil ativado com sucesso!");
			redirecionar('listar_perfil.php?output=html');
		}
      	break;

	case "I":
		carregarParametros($perfil);

		if (!$perfil->incluir()){
			alert("Erro ao incluir perfil. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Perfil incluido com sucesso!");
			redirecionar('listar_perfil.php?output=html');
		}
      	break;
	default:
		alert("Ação não esperada!");
		voltar();
		break;


}

    
function carregarParametros($perfil){

	$perfil->id 		                = $_POST['cod_perfil'];
	$perfil->perfil		                = $_POST['txt_perfil'];
	$perfil->descricao	                = $_POST['txt_descricao'];
	$perfil->codPermissao				= $_POST['cod_permissao'];
	

}

include("../../classes/FechaAcesso.php");
?>
