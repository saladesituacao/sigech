<?php 

include("../../cabecalho_menu.php"); 
include ("../../classes/Auditoria.php"); 

// Retornar nome do estabelecimento
//error_reporting(0);
include("../../dashboard/dados/hospital.php");

Auditoria(18,'Listagem de itens do PCH', $sqlPCH);

include ("../../assets/lib/brTable.php");
  
	 
?>

<style>
.fixed-table-body {
    height: auto;
    overflow: auto;
}
</style>


	<form name="frmCadastro" action="" method="post">
		<input type='hidden' name='acao' value='M'>
		<input type='hidden' name='cod_pch_estabelecimento' value=''>

		
		<input type='hidden' name='cod_estabelecimento' value='<?PHP echo ($cod); ?>'>
	<div class="container">
	
	<div class="well text-center">
	<h3 class="header-page__title">
	ESTABELECIMENTO

            <br><strong  class="txt-error" style="font-size:100%;"><?PHP echo ($estabelecimento); ?></strong>
			<span role="button" data-toggle="print" class="fa fa-print pull-right" onclick="javascript:window.print();"></span>
		</h3>
	</div>
	
        <div class="clearfix"></div>
		<?php if (permissao_acesso(48))
                {?>
		<button class="btn btn-default" onClick="adicionar('<?php echo $cod; ?>');"><i class="fa fa-plus-square" style="font-size:24px;color:green"></i> Novo Item</button>
		<?php } ?>
		
<!-- LISTA DE ESTABELECIMENTOS -->
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
			data-pagination="true"
			data-side-pagination="client"
			data-page-size=10
			data-cache="false"
			data-page-list="[10, 20, 30, 40, All]"
			data-show-footer="true"

		>
			<thead>
				<tr>
				<th data-field='txt_local_vistoria' data-sortable='true' data-filter-control='input'  width="80%">Local da Vistória</th>
					<th data-field='nr_item' data-sortable='true' data-filter-control='input'  width="10%">N° Item</th>
					<th data-field='n_conformidade' data-sortable='true' data-filter-control='input'  width="10%">Não Conformidade</th>
					<th  width="20%">Determinação da divisa</th>
					<th  width="20%">Data Cadastro</th>
					<th  width="20%">Dias corridos</th>
					<th  width="20%">Prazo da divisa</th>
					<th  width="20%">Legenda</th>
					<th data-field='responsavel' data-sortable='true' data-filter-control='input'  width="10%">Responsável</th>
					<th  width="20%">Prazo do responsável</th>
					<th  width="20%">Legenda</th>
					<th  width="20%">Data cumprimento</th>
					<th  width="20%">Observação</th>
					<th  width="30%">Ações</th>
				</tr>
			</thead>
			<tbody>
 
			<?php
	 
	 if (permissao_acesso(46))
                {
	 while ($linhaPCH = pg_fetch_row($rsPCH)){


		$doisDias = $linhaPCH[13] - $linhaPCH[8];
		if (intval($linhaPCH[13]) > $linhaPCH[8]){

			$cor = 'red';	
			$legenda = 'Item fora do prazo';

		}else if (intval($linhaPCH[13]) == $linhaPCH[8] or $doisDias <= 2){

			$cor = 'yellow';
			$legenda = 'Item perto de estourar o prazo';

		}else if (intval($linhaPCH[13]) < $linhaPCH[8] ) {
			
			$cor = 'green';
			$legenda = 'Item dentro do prazo';

		}

		$doisDiasResp = $linhaPCH[13] - $linhaPCH[10];
		if (intval($linhaPCH[13]) > $linhaPCH[10]){

			$cor2 = 'red';	
			$legenda2 = 'Item fora do prazo';

		}else if (intval($linhaPCH[13]) == $linhaPCH[10] or $doisDias <= 2){

			$cor2 = 'yellow';
			$legenda2 = 'Item perto de estourar o prazo';

		}else if (intval($linhaPCH[13]) < $linhaPCH[10] ) {
			
			$cor2 = 'green';
			$legenda2 = 'Item dentro do prazo';

		}
		

		?>
 

            <tr>
			<td width="10%"><H6><?php echo $linhaPCH[3]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaPCH[5]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaPCH[6]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaPCH[7]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaPCH[4]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaPCH[13]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaPCH[8]; ?></H6></td>
			<td width="10%"><i class="fa fa-bullseye" title = "<?php echo $legenda; ?>" style="font-size:24px;color:<?php echo $cor; ?>"></i></td>
			<td width="10%"><H6><?php echo $linhaPCH[9]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaPCH[10]; ?></H6></td>
			<td width="10%"><i class="fa fa-bullseye" title = "<?php echo $legenda2; ?>" style="font-size:24px;color:<?php echo $cor2; ?>"></i></td>
			<td width="10%"><H6><?php echo $linhaPCH[11]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaPCH[12]; ?></H6></td>
			
			<td width="30%">
				
			<?php if (permissao_acesso(49))
                {?>
				<button class="btn btn-default btn-xs" onClick="alterar('<?php echo $linhaPCH[0]; ?>')"><i class="fa fa-edit" style="font-size:24px;color:green"></i> Alterar</button>
				<?php } ?>

				<?php if (permissao_acesso(50))
                {?>
				<button class="btn btn-default btn-xs" onClick="excluir('<?php echo $linhaPCH[0]; ?>')"><i class="fa fa-times-circle" style="font-size:24px;color:red"></i>  Excluir</button>
				<?php } ?>

				<?php if (permissao_acesso(51))
                {?>
				<input type="button" class='btn btn-default btn-xs' data-target='#modalFinalizarPCH' data-toggle='modal' onClick="finalizarFPCH('<?php echo $linhaPCH[0]; ?>','<?php echo $linhaPCH[1]; ?>')" alt='Finalizar' value="Finalizar"></input>
				<?php } ?>
			</td>

    </tr>
	<?php  }} ?>



    </tbody>
		</table>   
       
	</div><!-- /container -->
	</form>







<div class="row" style="margin-left: 0px; margin-right: 0px;">
			<div class="modal fade" id="modalFinalizarPCH">
			
            <form name="frmFPCH" action="" method="post">
		    <input type='hidden' name='acao' value='FPCH'>
			<input type='hidden' name='adm' value='S'>
		    <input type='hidden' name='cod_servico_habilitado_estabelecimento' value=''>
            <input type='hidden' name='cod_estabelecimento1' value=''>
            <input type='hidden' name='cod_pch_estabelecimento1' value=''>

            
            
            
            
            	<div class="modal-dialog" style="width: 500px">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">Informar Data de Fechamento</h4>
						</div>
                        
                        
                        <div class="modal-body">
              <div class="row">
                  <div class="col-xs-12">
                      <div class="well">
                          <div class="form-group">
								<label for="justificativa">Data de Fechamento</label>
								<input type="text" size="14" maxLength="10" onKeyPress="mask(this,'00/00/0000',1, event)" onBlur="isDate(this);" name="dt_cumprimento" id="dt_cumprimento" />
				   (dd/mm/aaaa)
				
							</div>
							
							
                            <a class="btn btn-primary" onclick="enviarFPCH();">Salvar</a> <a href="#" data-dismiss="modal" class="btn">Fechar</a>
                      </div>
                  </div>
                  <div class="col-xs-12">
                      <p><b>Nota</b></p>
                      <p class="text-justify">O cumprimento da não conformidade será finalizado.</p>
                  </div>
              </div>
          </div>
                        
                   
                          
						</div>
						
					</div>
</form>
				</div>
            </div>


<script>
	$('#table').on('reset-view.bs.table', function () {
		var a = $('#table').bootstrapTable('getData',true).length;
		$('#totalFiltrado').text("Total da seleção " + a);
	});
</script>







<script language ="javascript"> 


function adicionar(cod){

document.getElementsByName('cod_estabelecimento')[0].value = cod;
document.getElementsByName('acao')[0].value = 'I';
document.getElementsByName('frmCadastro')[0].action = 'plano_credenciamento_habilitacao.php';
document.getElementsByName('frmCadastro')[0].submit();
}

 
function alterar(cod){

	document.getElementsByName('cod_pch_estabelecimento')[0].value = cod;
	document.getElementsByName('acao')[0].value = 'A';
	document.getElementsByName('frmCadastro')[0].action = 'plano_credenciamento_habilitacao.php';
	document.getElementsByName('frmCadastro')[0].submit();
}

function excluir(cod){

document.getElementsByName('cod_pch_estabelecimento')[0].value = cod;
document.getElementsByName('acao')[0].value = 'E';
document.getElementsByName('frmCadastro')[0].action = 'plano_credenciamento_habilitacao_manter.php';
document.getElementsByName('frmCadastro')[0].submit();
}


function finalizarFPCH(cod, codEstab){
	frmFPCH.cod_pch_estabelecimento1.value = cod;
	frmFPCH.cod_estabelecimento1.value = codEstab;
	

}


function enviarFPCH(){

    if (document.getElementsByName('dt_cumprimento')[0].value == ''){
		alert('Informe a DATA de finalização do processo!');
		document.getElementsByName('dt_cumprimento')[0].focus();
		return false;
	}
    
    
    document.getElementsByName('frmFPCH')[0].action = '../../dashboard/hospital/hospital_habilitado_manter.php';
	document.getElementsByName('frmFPCH')[0].submit();
}

function voltar(){

	window.location='../../index.php';	
}

</script>
</body>
</html>
<?php include("../../rodape.php"); ?>