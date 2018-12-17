<?php include("../../cabecalho_menu.php"); 

// Retornar nome do estabelecimento
//error_reporting(0);
include("../dados/hospital.php"); 
include("../../classes/Perfil.php");
include ("../../assets/lib/brTable.php");
$perfil = new Perfil();?>



<?php if (permissao_acesso(297)) { ?>



<style>
.fixed-table-body {
    height: auto;
    overflow: auto;
}
</style>


<div class="container">
<div class="well text-center">
	<h3 class="header-page__title">
	ESTABELECIMENTO

            <br><strong  class="txt-error" style="font-size:100%;"><?PHP echo ($estabelecimento); ?></strong>
			<span role="button" data-toggle="print" class="fa fa-print pull-right" onclick="javascript:window.print();"></span>
		</h3>
	</div>
        <div class="clearfix"></div>


<!-- HISTORICO DE MODIFICAÇÕES NO ITEM DA NÃO CNFORMIDADE  -->
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
					<th data-field='local' data-sortable='true' data-filter-control='input'  width="20%">local da vistoria</th>
					<th data-field='data' data-sortable='true' data-filter-control='input'  width="20%">Data de Cadastro</th>
                    <th data-field='item' data-sortable='true' data-filter-control='input'  width="20%">Nº do item</th>
                    <th data-field='nConformidade' data-sortable='true' data-filter-control='input'  width="30%">Não conformidade</th>
                    <th data-field='determminacao' data-sortable='true' data-filter-control='input'  width="30%">Determinação da Divisa</th>
					<th  width="20%">Prazo da Divisa</th>
                    <th  width="20%">Responsável</th>
                    <th  width="20%">Prazo do Responsável</th>
					<th  width="20%">Data de cumprimento</th>
                    <th  width="40%">Observação</th>
                    <th  width="20%">Dias corridos</th>
                    <th  width="20%">Data de Atualização</th>
                    <th  width="20%">usuário</th>
				</tr>
			</thead>
            <tbody>


<?php
	 
	 while ($linhaHPCH = pg_fetch_row($rsHPCH)){
		?>

         <tr>
		
        	<td width="10%"><H6><?php echo $linhaHPCH[3]; ?></H6></td>
            <td width="10%"><H6><?php echo $linhaHPCH[4]; ?></H6></td>
            <td width="10%"><H6><?php echo $linhaHPCH[5]; ?></H6></td>
            <td width="10%"><H6><?php echo $linhaHPCH[6]; ?></H6></td>
            <td width="10%"><H6><?php echo $linhaHPCH[7]; ?></H6></td>
            <td width="10%"><H6><?php echo $linhaHPCH[8]; ?></H6></td>
            <td width="10%"><H6><?php echo $linhaHPCH[9]; ?></H6></td>
            <td width="10%"><H6><?php echo $linhaHPCH[10]; ?></H6></td>
            <td width="10%"><H6><?php echo $linhaHPCH[11]; ?></H6></td>
            <td width="10%"><H6><?php echo $linhaHPCH[12]; ?></H6></td>
            <td width="10%"><H6><?php echo $linhaHPCH[13]; ?></H6></td>
            <td width="10%"><H6><?php echo $linhaHPCH[14]; ?></H6></td>
            <td width="10%"><H6><?php echo $linhaHPCH[15]; ?></H6></td>
        
        </tr>
	<?php  } ?>



    </tbody>
		</table>   



</div>


<script>
	$('#table').on('reset-view.bs.table', function () {
		var a = $('#table').bootstrapTable('getData',true).length;
		$('#totalFiltrado').text("Total da seleção " + a);
	});
</script>



<?php } ?>


<?php include("../../rodape.php"); ?>