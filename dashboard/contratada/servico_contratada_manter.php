<?php
error_reporting(0);
include("../../classes/Acesso.php");
include("../../classes/Contratada.php");
include("../../rotinas_comuns.php");


$contratada = new Contratada();

 
switch ($_POST['acao']) {

	case "A":
		carregarParametros($contratada);

		if (!$contratada->alterarServicoContratada()){
			voltar();
		}else{
			alert("Serviço alterado com sucesso!");
			redirecionar('detalhar.php?cod=' . $contratada->idEstabelecimento);
		}
		  break;



	case "D":
		carregarParametros($contratada);

		if (!$contratada->desativarServicoContratada()){
			voltar();
		}else{
			alert("Serviço desativado com sucesso!");
			redirecionar('detalhar.php?cod=' . $contratada->idEstabelecimento);
		}
		  break;
  
 

	case "I":
		carregarParametros($contratada);


		if (!$contratada->incluirServicoContratada()){
			voltar();
		}else{

			alert("Serviço incluído com sucesso!");
			redirecionar('detalhar.php?cod=' . $contratada->idEstabelecimento);
		}

		  break;

	default:
		alert("Ação não esperada!");
		voltar();
		break;


}


function carregarParametros($contratada){

	$contratada->id 		               			= $_POST['cod_servico_contratada'];
	$contratada->idEstabelecimento				= $_POST['cod_estabelecimento'];
	$contratada->txtObjetoContratacao        		= $_POST['txt_objeto_contratacao'];
	$contratada->nrContrato            			= $_POST['nr_contrato'];
	$contratada->dtVigencia          				= $_POST['dt_vigencia'];
	$contratada->nrProcesso            			= $_POST['nr_processo'];

	$contratada->idServico						= $_POST['cod_servico'];

}

include("../../classes/FechaAcesso.php");
?>
