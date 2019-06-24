<?php
//error_reporting(0);
include("../../classes/Acesso.php");
include("../../classes/HospitalHabilitado.php");
include("../../rotinas_comuns.php");

$hospital = new HospitalHabilitado();


// Verificar ação
switch ($_POST['acao']) {

	case "ASH":
		carregarParametros($hospital);

		if (!$hospital->alterarServicoHabilitado()){
			voltar();
		}else{
			alert("Serviço hospitalar alterado com sucesso!");
			redirecionar('detalhar.php?cod=' . $hospital->idEstabelecimento);
		}
		  break;




	case "ISH":
		  carregarParametros($hospital);
  
		  if (!$hospital->incluirServicoHabilitado()){
			  voltar();
		  }else{
			  alert("Serviço hospitalar incluído com sucesso!");
			  redirecionar('detalhar.php?cod=' . $hospital->idEstabelecimento);
		  }
			break;
		  


	case "DS":
	
	
		carregarParametros($hospital);
		
 
		if (!$hospital->desabilitarServico()){
			voltar();
		}else{
			alert("Serviço desabilitado com sucesso!");
			redirecionar('detalhar.php?cod=' . $hospital->idEstabelecimento );
		}
      	break;
	
		  
	case "RPCH":
	
			carregarParametros($hospital);
			
	
			if (!$hospital->cumprimentoNC()){
				voltar();
			}else{
				alert("Cumprimento da não conformidade realizado com sucesso!");
				redirecionar('detalhar.php?cod=' . $hospital->idEstabelecimento );
			}
			  break;

	case "RPCHC":
	
			  carregarParametros($hospital);
			  
	  
			  if (!$hospital->reabrirNC()){
				  voltar();
			  }else{
				  alert("Não conformidade reaberta com sucesso!");
				  redirecionar('../../divisa/nao_conformidade/detalhar.php?cod=' . $hospital->idEstabelecimento );
			  }
				break;


	case "FPCH":


	
			carregarParametros($hospital);
			
	
			if (!$hospital->finalizarNC()){
				voltar();
			}else{
				alert("Cumprimento da não conformidade realizado com sucesso!");
//echo $_REQUEST['adm'];
//exit();

				if ($_REQUEST['adm'] == 'S'){
					redirecionar('../../administrativo/plano_credenciamento_habilitacao/listar_plano_credenciamento_habilitacao_estabelecimento.php?cod=' . $hospital->idEstabelecimento );	
				}
				else{
				redirecionar('detalhar.php?cod=' . $hospital->idEstabelecimento );
			}
			}
			  break;


	case "FPCHD":


	
			  carregarParametros($hospital);
			  
	  
			  if (!$hospital->finalizarNCD()){
				  voltar();
			  }else{
				  alert("Não conformidade finalizada definitivamente com sucesso!");
				  redirecionar('../../divisa/nao_conformidade/detalhar.php?cod=' . $hospital->idEstabelecimento );
			  }
				break;






			  



	case "EPCH":


	
			  carregarParametros($hospital);
			  
	  
			  if (!$hospital->editarNC()){
				  voltar();
			  }else{
				  alert("Não conformidade atualizada com sucesso!");
				  redirecionar('detalhar.php?cod=' . $hospital->idEstabelecimento );
			  }
				break;
		
		default:
			alert("Ação não esperada!");
			voltar();
			break;


		


}


function carregarParametros($hospital){

	$hospital->id 		               			= $_POST['cod_servico_habilitado_estabelecimento'];
	$hospital->idEstabelecimento				= $_POST['cod_estabelecimento'];
	$hospital->codServico						= $_POST['cod_servico'];
	$hospital->valor 		               		= $_POST['vl_valor'];
	$hospital->dsPortaria            			= $_POST['ds_portaria'];
	$hospital->nrLeitos            				= $_POST['nr_leitos'];
	$hospital->dtHabilitacao 		            = $_POST['dt_habilitacao'];
	$hospital->dsObservacao 		            = $_POST['ds_observacao'];
	$hospital->dtDesabilitacao		            = $_POST['dt_desabilitacao'];
	$hospital->dsJustificativaDesabilitacao		= $_POST['ds_justificativa'];
	$hospital->urlPortaria						= $_POST['txt_url_portaria'];


	// Cumprimento das não conformidades 

	$hospital->idPchEstabelecimento				= $_POST['cod_pch_estabelecimento'];
	$hospital->dtCumprimento					= $_POST['dt_cumprimento'];
	$hospital->obsPCHtemp 						= $_POST['txt_observacao'];
	$hospital->txtResponsavel					= $_POST['txt_responsavel'];
	$hospital->nrDiasPrazoResponsavel			= $_POST['nr_dias_prazo_responsavel'];


	 
	// Cumprimento via modulo administrativo
	if ($_POST['adm'] == 'S'){
		$hospital->idPchEstabelecimento				= $_POST['cod_pch_estabelecimento1'];
		$hospital->idEstabelecimento				= $_POST['cod_estabelecimento1'];
	}
	



	
}

include("../../classes/FechaAcesso.php");
?>
