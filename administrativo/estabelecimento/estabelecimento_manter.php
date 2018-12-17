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
}

include("../../classes/FechaAcesso.php");
?>
