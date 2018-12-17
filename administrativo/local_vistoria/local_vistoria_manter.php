<?php
error_reporting(0);
include("../../classes/Acesso.php");
include("../../classes/LocalVistoria.php");
include("../../rotinas_comuns.php");


$localvistoria = new LocalVistoria();


// Verificar ação
switch ($_POST['acao']) {

	case "A":
		carregarParametros($localvistoria);

		if (!$localvistoria->alterar()){
			alert("Erro ao alterar local de vistoria. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Local de vistoria alterado com sucesso!");
			redirecionar('listar_local_vistoria.php?output=html');
		}
      	break;

	case "D":
		carregarParametros($localvistoria);

		if (!$localvistoria->desativar()){
			alert("Erro ao desativar local de vistoria. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Local de vistoria desativado com sucesso!");
			//exit();
			redirecionar('listar_local_vistoria.php?output=html');
		}
      	break;

	case "R":
		carregarParametros($localvistoria);

		if (!$localvistoria->reativar()){
			alert("Erro ao reativar local de vistoria. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Local de vistoria ativado com sucesso!");
			redirecionar('listar_local_vistoria.php?output=html');
		}
      	break;

	case "I":
		carregarParametros($localvistoria);

		if (!$localvistoria->incluir()){
			alert("Erro ao incluir Local de vistoria. Favor contactar o administrador do sistema.");
			voltar();
		}else{
			alert("Local de vistoria incluido com sucesso!");
			redirecionar('listar_local_vistoria.php?output=html');
		}
      	break;
	default:
		alert("Ação não esperada!");
		voltar();
		break;


}

    
function carregarParametros($usuario){

	$usuario->id 		                = $_POST['cod_local_vistoria'];
	$usuario->localvistoria             = $_POST['txt_local_vistoria'];
	$usuario->habilitado                = $_POST['ind_habilitado'];

}

include("../../classes/FechaAcesso.php");
?>
