<?php 
include("../../cabecalho_menu.php"); 
include ("../../assets/lib/brTable.php");
include("../../classes/HospitalPotencialHabilitacao.php");

$hospital = new HospitalPotencialHabilitacao();


$acao = 'ASPH';
if ($_REQUEST['cod_servico_potencial_habilitacao_estabelecimento'] != ''){

	

	if (!$hospital->carregar($_REQUEST['cod_servico_potencial_habilitacao_estabelecimento'],$_REQUEST['cod_estabelecimento'] )){
		alert('Erro ao carregar serviço com potencial de habilitação!');
		voltar();
		exit();
	}

}else{

	alert('Erro ao carregar dados do serviço com potencial de habilitação!');
	voltar();
	exit();
}
 


$sql_asph="

SELECT DISTINCT eph.cod_etapa_processo_habilitacao, eph.ds_etapa, TO_CHAR(aph.dt_inicio_andamento_processo, 'DD/MM/YYYY') as dt_inicio_andamento_processo , TO_CHAR(aph.dt_fim_andamento_processo, 'DD/MM/YYYY') as dt_fim_andamento_processo , aph.qtd_dias_andamento_processo,
eph.txt_nome_contato, eph.txt_email_contato, txt_telefone_contato, current_date - dt_inicio_andamento_processo as diascorridos,
aph.ind_finalizado,
TO_CHAR(
		aph.dt_finalizacao,
		'DD/MM/YYYY'
	) AS dt_finalizacao,
		aph.cod_andamento_processo_habilitacao
FROM sigech.tb_andamento_processo_habilitacao aph
INNER JOIN sigech.tb_etapa_processo_habilitacao eph
	ON aph.cod_etapa_processo_habilitacao = eph.cod_etapa_processo_habilitacao
WHERE aph.cod_servico_potencial_habilitacao_estabelecimento = " . $hospital->id . 
" ORDER BY eph.cod_etapa_processo_habilitacao ASC ";


//echo $sql_asph;

$rs_asph = $acesso->getRs($sql_asph);	

$q_asph=pg_query($sql_asph) or die ('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=./error.php">');

Auditoria(30,'Acompanhamento das etapas do serviço com potencial de habilitação hospitalar', $sql_asph);	

?>

<style>
.fixed-table-body {
    height: auto;
    overflow: auto;
}
</style>
 <div class="panel-body">
	<div class="container">
		
	<div class="well text-center">
	<h3 class="header-page__title">
		ACOMPANHAMENTO

            <br><strong  class="txt-success" style="font-size:100%;"><?PHP echo $hospital->nmEstabelecimento; ?></strong>
			<span role="button" data-toggle="print" class="fa fa-print pull-right" onclick="javascript:window.print();"></span>
		</h3>
	</div>
		<div class="clearfix"></div>
	   
				  <b  style="font-size:130%;">Serviço com potencial de habilitação:</b>
				  <strong  class="txt-error" style="font-size:130%;"><?php echo $hospital->areaHabilitacao . $hospital->nrServico . " - " . $hospital->nmServico; ?></strong>
 <P>
 <P>
 <P>
 
 <?php if ($acesso->usuario->perfil == 1) { ?>
	<button class='btn btn-default btn-xs' data-target='#modalGerarEPH' data-toggle='modal' onClick='gerarEPH(<?PHP echo $hospital->id ?>, <?PHP echo $hospital->idEstabelecimento ?>)' alt='Gerar'><i class='fa fa-address-card-o' style='font-size:16px;color:green'>Gerar Etapas do Processo de Habilitação</i></button>
 <?php }?>
 
 

<!-- PESQUISA DO ESTABELECIMENTO -->
<table id="table" class="table table-striped"
	        data-toggle="table"
			data-show-refresh="true"
			data-show-toggle="true"
			data-show-columns="true"
			data-show-export="true"
			data-export-types="['csv', 'txt', 'sql', 'excel', 'doc']"
			data-sortable="true"
			data-search="true"
            data-icon-size="sm"
			data-unique-id="uid"
			data-filter-control="true"
			data-filter-showClear="true"
			data-pagination-v-align="top" 
			data-show-pagination-switch="true"
			data-pagination="false"
			data-side-pagination="client"
			data-page-size=12
			data-cache="false"
			data-page-list="[10, 20, 30, 40, All]"
			data-show-footer="true"

		>
			<thead>
				<tr>
					<th>Etapa</th>
					<th data-field='ds_etapa' data-sortable='true' data-filter-control='input'  width="10%">Descrição</th>
					<th>Data Inicial</th>
					<th>Data Final Prevista</th>
					<th>Dias corridos</th>
					<th>Dias previstos</th>
					<th data-sortable='true'>Contato</th>
					<th>Telefone</th>
					<th>E-mail</th>
					<th>Etapa finalizda</th>
					<th>Data de finalização</th>
					<th>Legenda</th>
					<?php if ($acesso->usuario->perfil == 1) { ?>
					<th>Ação</th>
					<?php }?>
					
				</tr>
			</thead>
			<tbody>

			<?php
     while($info_asph=pg_fetch_array($q_asph)){
		$doisDias = $info_asph['diascorridos'] - $info_asph['qtd_dias_andamento_processo'];


		if (intval($info_asph['diascorridos']) > $info_asph['qtd_dias_andamento_processo']){

			$cor = 'red';	
			$legenda = 'Etapa fora do prazo';

		}else if (intval($info_asph['diascorridos']) == $info_asph['qtd_dias_andamento_processo'] or $doisDias <= 2){

			$cor = 'yellow';
			$legenda = 'Etapa perto de estourar o prazo';

		}else if (intval($info_asph['diascorridos']) < $info_asph['qtd_dias_andamento_processo'] ) {
			
			$cor = 'green';
			$legenda = 'Processo dentro do prazo';

		}

			if ($info_asph['ind_finalizado'] == 'S'){

				$finalizado = 'SIM';
			}else{
				$finalizado = 'NÃO';
			}


		?>


            <tr>
			<td width="10%"><H6><?php echo $info_asph['cod_etapa_processo_habilitacao']; ?></H6></td>
			<td width="10%"><H6><?php echo $info_asph['ds_etapa']; ?></H6></td>
			<td width="10%"><H6><?php echo $info_asph['dt_inicio_andamento_processo']; ?></H6></td>
			<td width="10%"><H6><?php echo $info_asph['dt_fim_andamento_processo']; ?></H6></td>
			<td width="10%"><H6><?php echo $info_asph['diascorridos']; ?></H6></td>
			<td width="10%"><H6><?php echo $info_asph['qtd_dias_andamento_processo']; ?></H6></td>
			<td width="10%"><H6><?php echo $info_asph['txt_nome_contato']; ?></H6></td>
			<td width="10%"><H6><?php echo $info_asph['txt_telefone_contato']; ?></H6></td>
			<td width="10%"><H6><?php echo $info_asph['txt_email_contato']; ?></H6></td>
			<td width="10%"><H6><?php echo $finalizado; ?></H6></td>
			<td width="10%"><H6><?php echo $info_asph['dt_finalizacao']; ?></H6></td>

			<td width="20%"><i class="fa fa-bullseye" title = "<?php echo $legenda; ?>" style="font-size:24px;color:<?php echo $cor; ?>"></i></td>
			<?php if ($acesso->usuario->perfil == 1) { ?>
			<td>
			<button class='btn btn-default btn-xs' data-target='#modalfinalizarEPH' data-toggle='modal' onClick='finalizarEPH(<?PHP echo $hospital->id ?>, <?PHP echo $hospital->idEstabelecimento ?>, <?php echo $info_asph['cod_andamento_processo_habilitacao']; ?>)' alt='Gerar'><i class='fa fa-check-square-o' style='font-size:16px;color:green'>Finalizar Etapa</i></button>
			
			
			</td>
			<?php }?>
    
    </tr>
	<?php  } ?>



    </tbody>
		</table>   





<div class="row" style="margin-left: 0px; margin-right: 0px;">
			<div class="modal fade" id="modalGerarEPH">
            <form name="frmEPH" action="" method="post">
		    <input type='hidden' name='acao' value=''>
            <input type='hidden' name='cod_estabelecimento' value=''>
			<input type='hidden' name='cod_servico_potencial_habilitacao_estabelecimento' value=''>
			

            
            
            
            
            	<div class="modal-dialog" style="width: 500px">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">Informar Data de Início da Etapa</h4>
						</div>
                        
                        
                        <div class="modal-body">
              <div class="row">
                  <div class="col-xs-12">
                      <div class="well">
                          <div class="form-group">
								<label for="justificativa">Data de início</label>
								<input type="text" size="14" maxLength="10" onKeyPress="mask(this,'00/00/0000',1, event)" onBlur="isDate(this);" name="dtInicio" id="dtInicio" />
				   (dd/mm/aaaa)
				
							</div>
							
							
                            <a class="btn btn-primary" onclick="enviarEPH();">Salvar</a> <a href="#" data-dismiss="modal" class="btn">Fechar</a>
                      </div>
                  </div>
                  <div class="col-xs-12">
                      <p><b>Nota</b></p>
                      <p class="text-justify">Será gerada as etapas para a habilitação do serviço.</p>
                  </div>
              </div>
          </div>
  
						</div>
						
					</div>
</form>
				</div>
            </div>








<div class="row" style="margin-left: 0px; margin-right: 0px;">
			<div class="modal fade" id="modalfinalizarEPH">
			GerarEPH
            <form name="frmFEPH" action="" method="post">
		    <input type='hidden' name='acao' value=''>
            <input type='hidden' name='cod_estabelecimento' value=''>
			<input type='hidden' name='cod_servico_potencial_habilitacao_estabelecimento' value=''>
			<input type='hidden' name='cod_andamento_processo_habilitacao' value=''>
			

            
            
            
            
            	<div class="modal-dialog" style="width: 500px">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">Informar Data de Finalização da Etapa</h4>
						</div>
                        
                        
                        <div class="modal-body">
              <div class="row">
                  <div class="col-xs-12">
                      <div class="well">
                          <div class="form-group">
								<label for="justificativa">Data de início</label>
								<input type="text" size="14" maxLength="10" onKeyPress="mask(this,'00/00/0000',1, event)" onBlur="isDate(this);" name="dtFim" id="dtFim" />
				   (dd/mm/aaaa)
				
							</div>
							
							
                            <a class="btn btn-primary" onclick="enviarFEPH();">Salvar</a> <a href="#" data-dismiss="modal" class="btn">Fechar</a>
                      </div>
                  </div>
                  <div class="col-xs-12">
                      <p><b>Nota</b></p>
                      <p class="text-justify">Será finalziada a etapa .</p>
                  </div>
              </div>
          </div>
  
						</div>
						
					</div>
</form>
				</div>
            </div>



			



<script language="javascript">
function gerarEPH(codPotencial,codEstab ){
frmEPH.cod_servico_potencial_habilitacao_estabelecimento.value =  codPotencial;
frmEPH.cod_estabelecimento.value =  codEstab;
frmEPH.acao.value =  'EPH';
}

function enviarEPH(){
    
    if (document.getElementsByName('dtInicio')[0].value == ''){
		alert('Informe a DATA de Início do processo!');
		document.getElementsByName('dtInicio')[0].focus();
		return false;
	}
    
    
    document.getElementsByName('frmEPH')[0].action = 'hospital_potencial_habilitacao_manter.php';
	document.getElementsByName('frmEPH')[0].submit();
}







function finalizarEPH(codPotencial,codEstab,codAndamento ){
frmFEPH.cod_servico_potencial_habilitacao_estabelecimento.value =  codPotencial;
frmFEPH.cod_estabelecimento.value =  codEstab;
frmFEPH.cod_andamento_processo_habilitacao.value =  codAndamento;
frmFEPH.acao.value =  'FEPH';
}

function enviarFEPH(){
    
    if (document.getElementsByName('dtFim')[0].value == ''){
		alert('Informe a DATA de finalização da etapa!');
		document.getElementsByName('dtFim')[0].focus();
		return false;
	}
    
    
    document.getElementsByName('frmFEPH')[0].action = 'hospital_potencial_habilitacao_manter.php';
	document.getElementsByName('frmFEPH')[0].submit();
}







</script>
</body>
</html>
<?php include("../../rodape.php"); ?>