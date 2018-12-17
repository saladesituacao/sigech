
<?php include("../cabecalho_menu.php"); 
include ("../classes/Auditoria.php"); 

include ("../assets/lib/brTable.php");




$sql_estabelecimento="SELECT cod_estabelecimento, nm_estabelecimento FROM sigech.tb_estabelecimento ORDER BY cod_classificacao_estabelecimento ASC ";
 	 $q_estabelecimento=pg_query($sql_estabelecimento) or die ('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=./error.php">');



	  $sqlEstabServHabilitado = "select 
	  she.cod_servico_habilitado_estabelecimento, ab.nr_area_habilitacao, she.cod_servico, s.nr_servico, s.nm_servico, she.cod_estabelecimento, e.nm_estabelecimento,
	  
	  she.vl_valor, she.ds_portaria, she.nr_leitos, she.ds_observacao
	  from sigech.tb_servico_habilitado_estabelecimento she
	  inner join sigech.tb_servico s
	  on she.cod_servico = s.cod_servico
	  inner join sigech.tb_estabelecimento e
	  on she.cod_estabelecimento = e.cod_estabelecimento
	  inner join sigech.tb_area_habilitacao ab
	  on s.cod_area_habilitacao   = ab.cod_area_habilitacao
	  where 1 = 1";

	  $cod_estabelecimento = isset( $_GET[ 'cod_estabelecimento' ] ) ? $_GET[ 'cod_estabelecimento' ] : null ;


	  if ($cod_estabelecimento != ''){
		
		$sqlEstabServHabilitado = $sqlEstabServHabilitado . " AND  e.cod_estabelecimento = " . $cod_estabelecimento;
		
		}
	  
		 
		$rsEstabServHabilitado = $acesso->getRs($sqlEstabServHabilitado);	

		Auditoria(32,'Pesquisa por estabelecimento', $sqlEstabServHabilitado);	
		

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
		<b>SERVIÇOS HABILITADOS POR ESTABELECIMENTO DE SAÚDE NO DF</b>
			<span role="button" data-toggle="print" class="fa fa-print pull-right" onclick="javascript:window.print();"></span>
		</h3>
	</div>
		
		
        <div class="clearfix"></div>
       
		<?php if (permissao_acesso(59)) { ?>

		<label class="" for="Estabelecimento">Estabelecimento:</label>
		
                             <select id="cod_estabelecimento" name="cod_estabelecimento">
                                    <option value="">Selecione</option>
									
									<?php
									   while($info_estabelecimento=pg_fetch_array($q_estabelecimento)){
										?>
								  <option value="<?php  echo $info_estabelecimento['cod_estabelecimento'];?>">
									<?php  echo $info_estabelecimento['nm_estabelecimento'];?>
									</option>
								  <?php  } ?>
                                 </select>
	 
<?php if (permissao_acesso(61)) { ?>
	<button type="submit" class="btn btn-default" onClick="pesquisar();"><i class="fa fa-search" style="font-size:24px;color:blue"></i> Pesquiar</button>
<?php } ?>
<?php if (permissao_acesso(62)) { ?>
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
					<th data-field='nr_area_habilitacao' data-sortable='true' data-filter-control='input'  width="10%">Àrea de Habilitação</th>
					<th data-field='nr_servico' data-sortable='true' data-filter-control='input'  width="10%">Código do Serviço Habilitado</th>
					<th data-field='nm_servico' data-sortable='true' data-filter-control='input'  width="80%">Serviço Habilitado</th>
				</tr>
			</thead>
			<tbody>

			<?php
	 
	 
	 
	 while ($linhaEstabServHabilitado = pg_fetch_row($rsEstabServHabilitado)){
		?>


            <tr>
			<td width="10%"><H6><?php echo $linhaEstabServHabilitado[1]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaEstabServHabilitado[3]; ?></H6></td>
			<td width="80%"><H6><?php echo $linhaEstabServHabilitado[4]; ?></H6></td>
    
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

	if (document.getElementById('cod_estabelecimento').value == ''){

		alert('Favor informar o estabelecimento para efetuar a pesquisa!');
		return;
	}else{

		window.location='./pesquisa_estabelecimento.php?output=html&cod_estabelecimento=' + document.getElementById('cod_estabelecimento').value;		
	}

}


function limpar(){

	document.getElementById('cod_estabelecimento').value = '';
	window.location='./pesquisa_estabelecimento.php?output=html&cod_estabelecimento=';	
}


if ('<?php  echo $_REQUEST["cod_estabelecimento"];?>' != ''){

		document.getElementById('cod_estabelecimento').value = '<?php  echo $_REQUEST["cod_estabelecimento"];?>';
}


</script>


</body>
</html>
<?php include("../rodape.php"); ?>