<?php
error_reporting(0);
include("../../classes/Acesso.php");
include("../../classes/EtapaProcessoHabilitacao.php");
include("../../rotinas_comuns.php");


$etapaProcessoHabilitacao = new EtapaProcessoHabilitacao();


// Verificar ação
switch ($_POST['acao']) {

	case "A":
		carregarParametros($etapaProcessoHabilitacao);

		if (!$etapaProcessoHabilitacao->alterar()){
			voltar();
		}else{
			alert("Etapa alterada com sucesso!");
			redirecionar('listar_etapa_processo_habilitacao.php?output=html');
		}
      	break;
	
	default:
		alert("Ação não esperada!");
		voltar();
		break;


}


function carregarParametros($etapaProcessoHabilitacao){

	$etapaProcessoHabilitacao->id 		               	= $_POST['cod_etapa_processo_habilitacao'];
	$etapaProcessoHabilitacao->descricao	               			= $_POST['ds_etapa'];
	$etapaProcessoHabilitacao->qtd		            			= $_POST['qtd_dias'];
	$etapaProcessoHabilitacao->nomeContato 		                = $_POST['txt_nome_contato'];
	$etapaProcessoHabilitacao->emailContato		                = $_POST['txt_email_contato'];
	$etapaProcessoHabilitacao->telefoneContato		                = retornarNumeros($_POST['txt_telefone_contato']);
}

include("../../classes/FechaAcesso.php");
?>
