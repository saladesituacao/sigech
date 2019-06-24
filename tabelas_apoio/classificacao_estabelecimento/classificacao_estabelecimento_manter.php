<?php
error_reporting(0);
include("../../classes/Acesso.php");
include("../../classes/ClassificacaoEstabelecimento.php");
include("../../rotinas_comuns.php");


$classificacaoEstabelecimento = new ClassificacaoEstabelecimento();


// Verificar ação
switch ($_POST['acao']) {

	case "A":
		carregarParametros($classificacaoEstabelecimento);

		if (!$classificacaoEstabelecimento->alterar()){
			alert("Erro ao alterar classificação. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Classificação alterada com sucesso!");
			
			redirecionar('listar_classificacao_estabelecimento.php?output=html');
		}
		  break;
		  
		  
	case "D":
		carregarParametros($classificacaoEstabelecimento);

		if (!$classificacaoEstabelecimento->desativar()){
			alert("Erro ao desativar classificação. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Classificação desativada com sucesso!");
			//exit();
			redirecionar('listar_classificacao_estabelecimento.php?output=html');
		}
      	break;

	case "R":
		carregarParametros($classificacaoEstabelecimento);

		if (!$classificacaoEstabelecimento->reativar()){
			alert("Erro ao reativar classificação. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Classificação ativada com sucesso!");
			redirecionar('listar_classificacao_estabelecimento.php?output=html');
		}
      	break;

	case "I":
		carregarParametros($classificacaoEstabelecimento);

		if (!$classificacaoEstabelecimento->incluir()){
			alert("Erro ao incluir classificação. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Classificação incluida com sucesso!");
			redirecionar('listar_classificacao_estabelecimento.php?output=html');
		}
      	break;
	default:
		alert("Ação não esperada!");
		voltar();
		break;


}

    
function carregarParametros($classificacaoEstabelecimento){

	$classificacaoEstabelecimento->id 						 		                = $_POST['cod_classificacao_estabelecimento'];
	$classificacaoEstabelecimento->classificacaoEstabelecimento		            = $_POST['txt_classificacao_estabelecimento'];
}

include("../../classes/FechaAcesso.php");
?>
