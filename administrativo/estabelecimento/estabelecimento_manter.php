<?php
error_reporting(0);
include("../../classes/Acesso.php");
include("../../classes/Estabelecimento.php");
include("../../rotinas_comuns.php");
 

$estabelecimento = new Estabelecimento();


// Verificar ação
switch ($_POST['acao']) {

	case "A":
		carregarParametros($estabelecimento);

		if (!$estabelecimento->alterar()){
			voltar();
		}else{
			alert("Estabelecimento alterado com sucesso!");
			redirecionar('listar_estabelecimento.php?output=html');
		}
		  break;
		  
	case "D":
		  carregarParametros($estabelecimento);
  
		  if (!$estabelecimento->desativar()){
			  alert("Erro ao desativar estabelecimento. Favor contactar o administrador do sistema.");
			  voltar();
		  }else{
			  alert("Estabelecimento desativado com sucesso!");
			  //exit();
			  redirecionar('listar_estabelecimento.php?output=html');
		  }
			break;
  
	  case "R":
		  carregarParametros($estabelecimento);
  
		  if (!$estabelecimento->reativar()){
			  alert("Erro ao reativar estabelecimento. Favor contactar o administrador do sistema.");
			  voltar();
		  }else{
			  alert("Estabelecimento ativado com sucesso!");
			  redirecionar('listar_estabelecimento.php?output=html');
		  }
			break;

	case "I":
		carregarParametros($estabelecimento);

		if (!$estabelecimento->incluir()){
			alert("Erro ao incluir Estabelecimento. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Estabelecimento incluido com sucesso!");
			redirecionar('listar_estabelecimento.php?output=html');
		}
      	break;
	
	default:
		alert("Ação não esperada!");
		voltar();
		break;


}


function carregarParametros($estabelecimento){

	$estabelecimento->id 		               			= $_POST['cod_estabelecimento'];
	$estabelecimento->nome 		               			= $_POST['nm_estabelecimento'];
	$estabelecimento->classificacao            			= $_POST['cod_classificacao_estabelecimento'];
	$estabelecimento->nomeContato 		                = $_POST['txt_nome_contato'];
	$estabelecimento->emailContato		                = $_POST['txt_email_contato'];
	$estabelecimento->telefoneContato	                = retornarNumeros($_POST['txt_telefone_contato']);
	$estabelecimento->cnes				                = $_POST['cod_cnes'];
}

include("../../classes/FechaAcesso.php");
?>
