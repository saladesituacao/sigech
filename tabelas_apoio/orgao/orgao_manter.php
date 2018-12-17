<?php
error_reporting(0);
include("../../classes/Acesso.php");
include("../../classes/Orgao.php");
include("../../rotinas_comuns.php");


$orgao = new Orgao();


// Verificar ação
switch ($_POST['acao']) {

	case "A":
		carregarParametros($orgao);

		if (!$orgao->alterar()){
			alert("Erro ao alterar área. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Área alterada com sucesso!");
			
			redirecionar('listar_orgao.php?output=html');
		}
		  break;
		  
		  
	case "D":
		carregarParametros($orgao);

		if (!$orgao->desativar()){
			alert("Erro ao desativar área. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Área desativada com sucesso!");
			//exit();
			redirecionar('listar_orgao.php?output=html');
		}
      	break;

	case "R":
		carregarParametros($orgao);

		if (!$orgao->reativar()){
			alert("Erro ao reativar área. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Área ativado com sucesso!");
			redirecionar('listar_orgao.php?output=html');
		}
      	break;

	case "I":
		carregarParametros($orgao);

		if (!$orgao->incluir()){
			alert("Erro ao incluir área. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Área incluida com sucesso!");
			redirecionar('listar_orgao.php?output=html');
		}
      	break;
	default:
		alert("Ação não esperada!");
		voltar();
		break;


}

    
function carregarParametros($orgao){

	$orgao->id 		               = $_POST['cod_orgao'];
	$orgao->sigla		           = $_POST['txt_sigla'];
	$orgao->descricao	           = $_POST['txt_descricao'];
	$orgao->codOrgaoSuperior	   = $_POST['cod_orgao_superior'];

	

}

include("../../classes/FechaAcesso.php");
?>
