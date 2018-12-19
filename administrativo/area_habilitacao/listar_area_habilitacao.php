<?php 

include("../../cabecalho_menu.php"); 

include ("../../assets/lib/brTable.php");




	  $sqlAreaHabilitacao = "select 
	  cod_area_habilitacao, nr_area_habilitacao, nm_area_habilitacao
	  from sigech.tb_area_habilitacao  order by nr_area_habilitacao asc";


	  	  
		
		$rsAreaHabilitacao = $acesso->getRs($sqlAreaHabilitacao);	
		

?>

<style>
.fixed-table-body {
    height: auto;
    overflow: auto;
}
</style>
    <div class="container">
        <header class="header-page">
            <h3 class="header-page__title">ÀREA DE HABILITAÇÃO </h3><P>
        </header>
        <div class="clearfix"></div>
       
		<button id="adicionar" class="btn btn-default" onClick="adicionar();"><i class="fa fa-plus-square" style="font-size:24px;color:green"></i> Adicionar</button>
	<button id="voltar" class="btn btn-default" onClick="voltar();"><i class="fa fa-sitemap" style="font-size:24px;color:blue"></i> Tela Inicial</button>

<!-- PESQUISA DO ESTABELECIMENTO -->
<table id="table" class="table table-striped"
	        data-toggle="table"
			data-show-refresh="true"
			data-show-toggle="true"
			data-show-columns="false"
			data-show-export="false"
			data-export-types="['csv', 'txt', 'sql', 'excel']"
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

		>
			<thead>
				<tr>
					<th data-field='nr_area_habilitacao' data-sortable='true' data-filter-control='input'  width="10%">Número</th>
					<th data-field='nm_area_habilitacao' data-sortable='true' data-filter-control='input'  width="80%">Àrea</th>
				</tr>
			</thead>
			<tbody>

			<?php
      while ($linhaAreaHabilitacao = pg_fetch_row($rsAreaHabilitacao)){
		?>


            <tr>
			<td width="10%"><H6><?php echo $linhaAreaHabilitacao[1]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaAreaHabilitacao[2]; ?></H6></td>
    </tr>
	<?php  } ?>



    </tbody>
		</table>   
        
    </div><!-- /container -->




    <footer class="footer">
        <p>Todos os direitos reservados (c) <?php echo(date('Y')); ?></p>
    </footer>

	<script>
$('#table').on('reset-view.bs.table', function () {
	var a = $('#table').bootstrapTable('getData',true).length;
	$('#totalFiltrado').text("Total da seleção " + a);
});




function adicionar(){

	window.location='area_habilitacao.php';	
}

</script>


</body>
</html>
<?php include("../../rodape.php"); ?>