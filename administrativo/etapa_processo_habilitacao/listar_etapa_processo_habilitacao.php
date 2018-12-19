<?php 

include("../../cabecalho_menu.php"); 
include ("../../classes/Auditoria.php");
include ("../../assets/lib/brTable.php");

	  $sqlEtapaProcessoHabilitacao = "select 
	  cod_etapa_processo_habilitacao, ds_etapa, qtd_dias, txt_nome_contato, txt_email_contato, txt_telefone_contato
	  from sigech.tb_etapa_processo_habilitacao  where ind_habilitado = 'S'order by cod_etapa_processo_habilitacao asc";

		$rsEtapaProcessoHabilitacao = $acesso->getRs($sqlEtapaProcessoHabilitacao);
		Auditoria(10,'Listagem das etapas do processo de habilitação', $sql);
?>

<style>
.fixed-table-body {
    height: auto;
    overflow: auto;
}
</style>


	<form name="frmCadastro" action="" method="post">
		<input type='hidden' name='acao' value='A'>
		<input type='hidden' name='cod_etapa_processo_habilitacao' value=''>
	<div class="container">
	<div class="well text-center">
		<h3 class="header-page__title">
		<b>ETAPAS PARA O PROCESSO DE HABILITAÇÃO</b>
			<span role="button" data-toggle="print" class="fa fa-print pull-right" onclick="javascript:window.print();"></span>
		</h3>
	</div>
        <div class="clearfix"></div>
	   
<!-- LISTA DE ETAPAS PARA O PROCESSO DE HABILITAÇÃO -->
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
			data-page-size=12
			data-cache="false"
			data-page-list="[10, 20, 30, 40, All]"
			data-show-footer="true"

		>
			<thead>
				<tr>
				<th data-field='cod_etapa_processo_habilitacao' data-sortable='true' data-filter-control='input'  width="10%">N° da Etapa</th>
					<th data-field='ds_etapa' data-sortable='true' data-filter-control='input'  width="10%">Etapa</th>
					<th data-field='qtd_dias' data-sortable='true' data-filter-control='input'  width="80%">Quantidade de dias</th>
					<th  width="20%"> Nome Contato</th>
					<th  width="20%"> E-mail Contato</th>
					<th  width="20%"> Telefone</th>
					<th  width="20%"> Ações</th>
				</tr>
			</thead>
			<tbody>

			<?php
	  if (permissao_acesso(39))               
	  { 
	 
	  while ($linhaEtapaProcessoHabilitacao = pg_fetch_row($rsEtapaProcessoHabilitacao)){
		?>


            <tr>
			<td width="10%"><H6><?php echo $linhaEtapaProcessoHabilitacao[0]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaEtapaProcessoHabilitacao[1]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaEtapaProcessoHabilitacao[2]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaEtapaProcessoHabilitacao[3]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaEtapaProcessoHabilitacao[4]; ?></H6></td>
			<td width="10%"><H6><?php echo mask($linhaEtapaProcessoHabilitacao[5],'(##)####-####'); ?></H6></td>
			
			<?php  if (permissao_acesso(37))               
                {?>
			<td width="10%">
				<button class="btn btn-default btn-xs" onClick="editar('<?php echo $linhaEtapaProcessoHabilitacao[0]; ?>')"><i class="fa fa-edit" style="font-size:24px;color:green"></i> Editar</button>
			</td>
			<?php  } ?>

    </tr>
	<?php  }} ?>



    </tbody>
		</table>   
       
	</div><!-- /container -->
	</form>



<script>
	$('#table').on('reset-view.bs.table', function () {
		var a = $('#table').bootstrapTable('getData',true).length;
		$('#totalFiltrado').text("Total da seleção " + a);
	});
</script>


<script language ="javascript"> 


function editar(cod){

	document.getElementsByName('cod_etapa_processo_habilitacao')[0].value = cod;
	document.getElementsByName('acao')[0].value = 'A';
	document.getElementsByName('frmCadastro')[0].action = 'etapa_processo_habilitacao.php';
	document.getElementsByName('frmCadastro')[0].submit();
}


</script>
</body>
</html>
<?php include("../../rodape.php"); ?>