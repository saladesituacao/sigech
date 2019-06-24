<?php include("../cabecalho_menu.php"); 
include ("../classes/Auditoria.php"); 

include ("../assets/lib/brTable.php");



$sql_area_habilitacao="select distinct 
ab.cod_area_habilitacao, ab.nr_area_habilitacao || '  ' || ab.nm_area_habilitacao as area_habilitacao
from sigech.tb_servico_habilitado_estabelecimento she
inner join sigech.tb_servico s
on she.cod_servico = s.cod_servico
inner join sigech.tb_estabelecimento e
on she.cod_estabelecimento = e.cod_estabelecimento
inner join sigech.tb_area_habilitacao ab
on s.cod_area_habilitacao   = ab.cod_area_habilitacao
where 1 = 1 order by 2 asc ";





	  $q_area_habilitacao=pg_query($sql_area_habilitacao) or die ('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=./error.php">');
	  






	  $sqlEstabAreaHabilitacao = "select DISTINCT 
	  she.cod_estabelecimento, e.nm_estabelecimento
	  from sigech.tb_servico_habilitado_estabelecimento she
	  inner join sigech.tb_servico s
	  on she.cod_servico = s.cod_servico
	  inner join sigech.tb_estabelecimento e
	  on she.cod_estabelecimento = e.cod_estabelecimento
	  inner join sigech.tb_area_habilitacao ab
	  on s.cod_area_habilitacao   = ab.cod_area_habilitacao
	  where 1 = 1 ";

	  $cod_area_habilitacao = isset( $_GET[ 'cod_area_habilitacao' ] ) ? $_GET[ 'cod_area_habilitacao' ] : null ;


	  if ($cod_area_habilitacao != ''){
		
		$sqlEstabAreaHabilitacao = $sqlEstabAreaHabilitacao . " AND  ab.cod_area_habilitacao = " . $cod_area_habilitacao;

		
		}
	  
		$sqlEstabAreaHabilitacao = $sqlEstabAreaHabilitacao . " order by nm_estabelecimento asc ";



		$rsEstabAreaHabilitacao = $acesso->getRs($sqlEstabAreaHabilitacao);	

		Auditoria(68,'Pesquisa por área de habilitação', $sqlEstabAreaHabilitacao);	




?>

<style>
.fixed-table-body {
    height: auto;
    overflow: auto;
}
</style>
    <div class="container">
        
	<div class="well text-center">
		<h3 class="header-page__title">
		<b>ESTABELECIMENTOS HABILITADOS POR ÁREA DE HABILITAÇÃO</b>
			<span role="button" data-toggle="print" class="fa fa-print pull-right" onclick="javascript:window.print();"></span>
		</h3>
	</div>
		
        <div class="clearfix"></div>
		<?php if (permissao_acesso(223)) { ?>
       
		<label class="" for="Habilitação">Área de Habilitação:</label>
		
                             <select id="cod_area_habilitacao" name="cod_area_habilitacao">
                                    <option value="">Selecione</option>
									
									<?php
									   while($info_area_habilitacao=pg_fetch_array($q_area_habilitacao)){
										?>
								  <option value="<?php  echo $info_area_habilitacao['cod_area_habilitacao'];?>">
									<?php  echo $info_area_habilitacao['area_habilitacao'];?>
									</option>
								  <?php  } ?>
                                 </select>
<?php if (permissao_acesso(224)) { ?>
	<button type="submit" class="btn btn-default" onClick="pesquisar();"><i class="fa fa-search" style="font-size:24px;color:blue"></i> Pesquiar</button>
<?php } ?>
<?php if (permissao_acesso(225)) { ?>
    <button type="submit" class="btn btn-default" onClick="limpar();"><i class="fa fa-eraser" style="font-size:24px;color:red"></i> Limpar</button>
<?php } ?>

 
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
			data-pagination="true"
			data-side-pagination="client"
			data-page-size=10
			data-cache="false"
			data-page-list="[10, 20, 30, 40, All]"
			data-show-footer="true"

		>
			<thead>
				<tr>
					
					<th data-field='nm_estabelecimento' data-sortable='true' data-filter-control='input'  width="80%">Estabelecimento</th>
				</tr>
			</thead>
			<tbody>

			<?php
      while ($linhaEstabAreaHabilitacao = pg_fetch_row($rsEstabAreaHabilitacao)){
		?>


            <tr>
			<td width="80%"><H6><?php echo $linhaEstabAreaHabilitacao[1]; ?></H6></td>
    
    </tr>
	<?php  } ?>



    </tbody>
		</table> 

		<?php  } ?>  
        
    </div><!-- /container -->


	<script>
$('#table').on('reset-view.bs.table', function () {
	var a = $('#table').bootstrapTable('getData',true).length;
	$('#totalFiltrado').text("Total da seleção " + a);
});



function pesquisar(){

	if (document.getElementById('cod_area_habilitacao').value == ''){

		alert('Favor informar a área de habilitação para efetuar a pesquisa!');
		return;
	}else{

		window.location='./pesquisa_area_habilitacao.php?output=html&cod_area_habilitacao=' + document.getElementById('cod_area_habilitacao').value;		
	}

}


function limpar(){

	document.getElementById('cod_area_habilitacao').value = '';
	window.location='./pesquisa_area_habilitacao.php?output=html&cod_area_habilitacao=';	
}


if ('<?php  echo $_REQUEST["cod_area_habilitacao"];?>' != ''){

		document.getElementById('cod_area_habilitacao').value = '<?php  echo $_REQUEST["cod_area_habilitacao"];?>';
}


</script>
</body>
</html>
<?php include("../rodape.php"); ?>