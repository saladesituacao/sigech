<?php include("../cabecalho_menu.php"); 
include ("../classes/Auditoria.php"); 

include ("../assets/lib/brTable.php");



$sql_servico="select distinct 
s.cod_servico, ab.nr_area_habilitacao || s.nr_servico || '  ' || s.nm_servico as servico


from sigech.tb_servico_habilitado_estabelecimento she
inner join sigech.tb_servico s
on she.cod_servico = s.cod_servico
inner join sigech.tb_estabelecimento e
on she.cod_estabelecimento = e.cod_estabelecimento
inner join sigech.tb_area_habilitacao ab
on s.cod_area_habilitacao   = ab.cod_area_habilitacao
where 1 = 1 order by 2 asc ";
 	 $q_servico=pg_query($sql_servico) or die ('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=./error.php">');



	  $sqlEstabServHabilitado = "select DISTINCT 
	  she.cod_estabelecimento, e.nm_estabelecimento
	  from sigech.tb_servico_habilitado_estabelecimento she
	  inner join sigech.tb_servico s
	  on she.cod_servico = s.cod_servico
	  inner join sigech.tb_estabelecimento e
	  on she.cod_estabelecimento = e.cod_estabelecimento
	  inner join sigech.tb_area_habilitacao ab
	  on s.cod_area_habilitacao   = ab.cod_area_habilitacao
	  where 1 = 1 ";

	  $cod_servico = isset( $_GET[ 'cod_servico' ] ) ? $_GET[ 'cod_servico' ] : null ;


	  if ($cod_servico != ''){
		
		$sqlEstabServHabilitado = $sqlEstabServHabilitado . " AND  s.cod_servico = " . $cod_servico;

		
		}
	  
		$sqlEstabServHabilitado = $sqlEstabServHabilitado . " order by nm_estabelecimento asc ";
		$rsEstabServHabilitado = $acesso->getRs($sqlEstabServHabilitado);	

		Auditoria(33,'Pesquisa por tipo de habilitação', $sqlEstabServHabilitado);	
		

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
		<b>SERVIÇOS HABILITADOS POR CÓDIGO DE HABILITAÇÃO</b>
			<span role="button" data-toggle="print" class="fa fa-print pull-right" onclick="javascript:window.print();"></span>
		</h3>
	</div>
		
        <div class="clearfix"></div>
		<?php if (permissao_acesso(60)) { ?>
       
		<label class="" for="Habilitação">Serviço Habilitado:</label>
		
                             <select id="cod_servico" name="cod_servico">
                                    <option value="">Selecione</option>
									
									<?php
									   while($info_servico=pg_fetch_array($q_servico)){
										?>
								  <option value="<?php  echo $info_servico['cod_servico'];?>">
									<?php  echo $info_servico['servico'];?>
									</option>
								  <?php  } ?>
                                 </select>
<?php if (permissao_acesso(63)) { ?>
	<button type="submit" class="btn btn-default" onClick="pesquisar();"><i class="fa fa-search" style="font-size:24px;color:blue"></i> Pesquiar</button>
<?php } ?>
<?php if (permissao_acesso(64)) { ?>
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
      while ($linhaEstabServHabilitado = pg_fetch_row($rsEstabServHabilitado)){
		?>


            <tr>
			<td width="80%"><H6><?php echo $linhaEstabServHabilitado[1]; ?></H6></td>
    
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

	if (document.getElementById('cod_servico').value == ''){

		alert('Favor informar o serviço para efetuar a pesquisa!');
		return;
	}else{

		window.location='./pesquisa_tipo_habilitacao.php?output=html&cod_servico=' + document.getElementById('cod_servico').value;		
	}

}


function limpar(){

	document.getElementById('cod_servico').value = '';
	window.location='./pesquisa_tipo_habilitacao.php?output=html&cod_servico=';	
}


if ('<?php  echo $_REQUEST["cod_servico"];?>' != ''){

		document.getElementById('cod_servico').value = '<?php  echo $_REQUEST["cod_servico"];?>';
}


</script>


</body>
</html>
<?php include("../rodape.php"); ?>