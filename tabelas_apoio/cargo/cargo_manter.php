<?php
error_reporting(0);
include("../../classes/Acesso.php");
include("../../classes/Cargo.php");
include("../../rotinas_comuns.php");


$cargo = new Cargo();


// Verificar ação
switch ($_POST['acao']) {

	case "A":
		carregarParametros($cargo);

		if (!$cargo->alterar()){
			alert("Erro ao alterar cargo. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Cargo alterado com sucesso!");
			
			redirecionar('listar_cargo.php?output=html');
		}
		  break;
		  
		  
	case "D":
		carregarParametros($cargo);

		if (!$cargo->desativar()){
			alert("Erro ao desativar cargo. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Cargo desativado com sucesso!");
			//exit();
			redirecionar('listar_cargo.php?output=html');
		}
      	break;

	case "R":
		carregarParametros($cargo);

		if (!$cargo->reativar()){
			alert("Erro ao reativar cargo. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Cargo ativado com sucesso!");
			redirecionar('listar_cargo.php?output=html');
		}
      	break;

	case "I":
		carregarParametros($cargo);

		if (!$cargo->incluir()){
			alert("Erro ao incluir cargo. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Cargo incluido com sucesso!");
			redirecionar('listar_cargo.php?output=html');
		}
      	break;
	default:
		alert("Ação não esperada!");
		voltar();
		break;


}

    
function carregarParametros($cargo){

	$cargo->id 		                = $_POST['cod_cargo'];
	$cargo->cargo		                = $_POST['txt_cargo'];
	$cargo->descricao	                = $_POST['txt_descricao'];
	

}

include("../../classes/FechaAcesso.php");
?>
