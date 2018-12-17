<?php
error_reporting(0);
include("../../classes/Acesso.php");
include("../../classes/PlanoCredenciamentoHabilitacao.php");
include("../../rotinas_comuns.php");


$planocredenciamentohabilitacao = new PlanoCredenciamentoHabilitacao();


// Verificar ação
switch ($_POST['acao']) {

	case "A":
		carregarParametros($planocredenciamentohabilitacao);

		if (!$planocredenciamentohabilitacao->alterar()){
			alert("Erro ao alterar Plano de Credenciamento. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Plano de Credenciamento alterado com sucesso!");
			redirecionar('listar_plano_credenciamento_habilitacao_estabelecimento.php?output=html&cod=' . $_POST['cod_estabelecimento']);
		}
      	break;

  case "E":
		  carregarParametros($planocredenciamentohabilitacao);
  
		  if (!$planocredenciamentohabilitacao->excluir()){
			  alert("Erro ao excluir Plano de Credenciamento. Favor contactar o administrador do sistema.");
			  voltar();
		  }else{
			  alert("Plano de Credenciamento excluído com sucesso!");
			  redirecionar('listar_plano_credenciamento_habilitacao_estabelecimento.php?output=html&cod=' . $_POST['cod_estabelecimento']);
		  }
			break;
  
		  




	case "I":
		carregarParametros($planocredenciamentohabilitacao);

		if (!$planocredenciamentohabilitacao->incluir()){
			alert("Erro ao incluir Plano de Credenciamento. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Plano de Credenciamento incluido com sucesso!");
			redirecionar('listar_plano_credenciamento_habilitacao_estabelecimento.php?output=html&cod='. $_POST['cod_estabelecimento']);
		}
      	break;
	default:
		alert("Ação não esperada!");
		voltar();
		break;


}

    
function carregarParametros($planocredenciamentohabilitacao){

	$planocredenciamentohabilitacao->id 		                = $_POST['cod_pch_estabelecimento'];
	$planocredenciamentohabilitacao->idEstabelecimento 		= $_POST['cod_estabelecimento'];
	$planocredenciamentohabilitacao->idLocalVistoria		    = $_POST['cod_local_vistoria'];
	$planocredenciamentohabilitacao->dtCadastro 	            = $_POST['dt_cadastro'];
	$planocredenciamentohabilitacao->nrItem 	                = $_POST['nr_item'];
	$planocredenciamentohabilitacao->txtNaoConformidade	    = $_POST['txt_nao_conformidade'];
	$planocredenciamentohabilitacao->txtDeterminacao	        = $_POST['txt_determinacao'];
	$planocredenciamentohabilitacao->nrDiasPrazoDeterminacao	= $_POST['nr_dias_prazo_determinacao'];
	$planocredenciamentohabilitacao->txtResponsavel	        = $_POST['txt_responsavel'];
	$planocredenciamentohabilitacao->nrDiasResponsavel	        = $_POST['nr_dias_prazo_responsavel'];
	$planocredenciamentohabilitacao->dtCumprimento	            = $_POST['dt_cumprimento'];
	$planocredenciamentohabilitacao->txtObservacao	            = $_POST['txt_observacao'];


}

include("../../classes/FechaAcesso.php");
?>
