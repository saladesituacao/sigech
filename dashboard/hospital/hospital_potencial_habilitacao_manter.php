<?php
error_reporting(0);
include("../../classes/Acesso.php");
include("../../classes/HospitalPotencialHabilitacao.php");
include("../../rotinas_comuns.php");


$hospital = new HospitalPotencialHabilitacao();


switch ($_POST['acao']) {

	case "ASPH":
		carregarParametros($hospital);

		if (!$hospital->alterarServicoPotencialHabilitacao()){
			voltar();
		}else{
			alert("Serviço hospitalar alterado com sucesso!");
			redirecionar('detalhar.php?cod=' . $hospital->idEstabelecimento);
		}
		  break;
  
 

	case "ISPH":
		carregarParametros($hospital);

		if (!$hospital->incluirServicoPotencialHabilitacao()){
			voltar();
		}else{

			alert("Serviço hospitalar incluído com sucesso!");
			redirecionar('detalhar.php?cod=' . $hospital->idEstabelecimento);
		}

		  break;

	case "EPH":
		  carregarParametros($hospital);
  
		  if (!$hospital->gerarEtapasProcessoHabilitacao()){
			  voltar();
		  }else{
  
			  alert("Etapas do Processo de Habilitaçao gerados com sucesso!");
			  redirecionar('detalhar.php?cod=' . $hospital->idEstabelecimento);
		  }
  
			break;


	case "FEPH":
		  carregarParametros($hospital);
  
		  if (!$hospital->finalizarEtapaProcessoHabilitacao()){
			  voltar();
		  }else{
  
			  alert("Etapa do Processo de Habilitaçao finalizado com sucesso!");
			  redirecionar('acompanhar_servico_potencial_habilitacao.php?cod_servico_potencial_habilitacao_estabelecimento=' . $hospital->id . '&cod_estabelecimento=' . $hospital->idEstabelecimento);
		  }
  
			break;

	default:
		alert("Ação não esperada!");
		voltar();
		break;


}


function carregarParametros($hospital){

	$hospital->id 		               			= $_POST['cod_servico_potencial_habilitacao_estabelecimento'];
	$hospital->idServico               			= $_POST['cod_servico'];
	$hospital->idEstabelecimento				= $_POST['cod_estabelecimento'];
	$hospital->codServico						= $_POST['cod_servico'];
	$hospital->valor 		               		= $_POST['vl_valor'];
	$hospital->dsPortaria            			= $_POST['ds_portaria'];
	$hospital->nrLeitos            				= $_POST['nr_leitos'];

	$hospital->dsObservacao            			= $_POST['ds_observacao'];
	
	$hospital->dsNrProcesso						= $_POST['ds_nr_processo'];
	$hospital->dsMeioProcesso					= $_POST['ds_meio_processo'];
	$hospital->dsLocalizacaoProcesso			= $_POST['ds_localizacao_processo'];


	$hospital->urlPortaria						= $_POST['txt_url_portaria'];

	$hospital->nrProcessoSei					= $_POST['txt_nr_processo_sei'];

	$hospital->dtTemp							= $_POST['dtInicio'];

	//informações para finalizar um etapa do processo de habilitação
	$hospital->dtFinalizacao							= $_POST['dtFim'];
	$hospital->idAndamento								= $_POST['cod_andamento_processo_habilitacao'];

	
}

include("../../classes/FechaAcesso.php");
?>
