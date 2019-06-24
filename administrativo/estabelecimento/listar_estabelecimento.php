<?php 
 
include("../../cabecalho_menu.php"); 
include ("../../classes/Auditoria.php"); 
include ("../../assets/lib/brTable.php");

	  $sqlEstabelecimento = "select 
	  cod_estabelecimento, nm_estabelecimento, cod_classificacao_estabelecimento, 
	  case when cod_classificacao_estabelecimento = 1 then 'Hospital'
			  when cod_classificacao_estabelecimento = 2 then 'Unidade de Saúde'
				when cod_classificacao_estabelecimento = 3 then 'Contratada'
					else 'Não Classificada'
		end as classificacao,
		txt_nome_contato,
		txt_email_contato,
		txt_telefone_contato,
		cod_cnes,
		ind_habilitado
	  from sigech.tb_estabelecimento  order by nm_estabelecimento asc";

		$rsEstabelecimento = $acesso->getRs($sqlEstabelecimento);
		Auditoria(8,'Listagem de estabelecimentos', $sql);	
?>

<style>
.fixed-table-body {
    height: auto;
    overflow: auto;
}
</style>


	<form name="frmCadastro" action="" method="post">
		<input type='hidden' name='acao' value='A'>
		<input type='hidden' name='cod_estabelecimento' value=''>
	<div class="container">
       

		<div class="well text-center">
		<h3 class="header-page__title">
		<b>ESTABELECIMENTOS</b>
			<span role="button" data-toggle="print" class="fa fa-print pull-right" onclick="javascript:window.print();"></span>
		</h3>
	</div>
	<div class="clearfix"></div>
	<?php	
			if (permissao_acesso(318))
                {?>
		<button class="btn btn-default" onClick="adicionar();"><i class="fa fa-plus-square" style="font-size:24px;color:green"></i> Adicionar</button>
		<?php }?>
	   
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
					<th data-field='nm_estabelecimento' data-sortable='true' data-filter-control='input'  width="10%">Estabelecimento</th>
					<th data-field='classificacao' data-sortable='true' data-filter-control='input'  width="80%">Classificacao</th>
					<th data-field='cnes' data-sortable='true' data-filter-control='input'  width="80%">Cnes</th>
					<th data-field='nome' data-sortable='true' data-filter-control='input'  width="80%">Nome Contato</th>
					<th  width="20%"> E-mail Contato</th>
					<th  width="20%"> Telefone</th>
					<th  width="20%"> Ativo</th>
					<th  width="20%"> Ações</th>
				</tr>
			</thead>
			<tbody>

			<?php
	 
	 if (permissao_acesso(36))               
                {
	 
	 while ($linhaEstabelecimento = pg_fetch_row($rsEstabelecimento)){
		?>


            <tr>
			<td width="10%"><H6><?php echo $linhaEstabelecimento[1]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaEstabelecimento[3]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaEstabelecimento[7]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaEstabelecimento[4]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaEstabelecimento[5]; ?></H6></td>
			<td width="10%"><H6><?php echo mask($linhaEstabelecimento[6],'(##)####-####'); ?></H6></td>
			<td width="10%"><H6>
			<?php 
			if ($linhaEstabelecimento[8] == 'S'){
						echo ('SIM');

				}else{
						echo ('NÃO');
				}
				 ?>
			</H6></td>
			<?php  if (permissao_acesso(34))               
                {?>
			
			<td width="10%">
				<button class="btn btn-default btn-xs" onClick="editar('<?php echo $linhaEstabelecimento[0]; ?>')"><i class="fa fa-edit" style="font-size:24px;color:green"></i> Editar</button>
				<?php 
				if ($linhaEstabelecimento[8] == 'N'){?>
				<?php  if (permissao_acesso(320))               
                {?>
					<button class="btn btn-default btn-xs" onClick="reativar('<?php echo $linhaEstabelecimento[0]; ?>')"><i class="fa  fa-compass" style="font-size:24px;color:yellow"></i> Reativar</button>
					<?php }?>
					<?php		
				}else{?>
				<?php  if (permissao_acesso(319))               
                {?>
					<button class="btn btn-default btn-xs" onClick="desativar('<?php echo $linhaEstabelecimento[0]; ?>')"><i class="fa fa-compass" style="font-size:24px;color:red"></i> Desativar</button>
					<?php }?>
				<?php }?>
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


function adicionar(){

document.getElementsByName('cod_estabelecimento')[0].value = '';
document.getElementsByName('acao')[0].value = 'I';
document.getElementsByName('frmCadastro')[0].action = 'estabelecimento.php';
document.getElementsByName('frmCadastro')[0].submit();
}




function editar(cod){

	document.getElementsByName('cod_estabelecimento')[0].value = cod;
	document.getElementsByName('acao')[0].value = 'A';
	document.getElementsByName('frmCadastro')[0].action = 'estabelecimento.php';
	document.getElementsByName('frmCadastro')[0].submit();
}

function desativar(cod){

document.getElementsByName('cod_estabelecimento')[0].value = cod;
document.getElementsByName('acao')[0].value = 'D';
document.getElementsByName('frmCadastro')[0].action = 'estabelecimento_manter.php';
document.getElementsByName('frmCadastro')[0].submit();
}

function reativar(cod){

document.getElementsByName('cod_estabelecimento')[0].value = cod;
document.getElementsByName('acao')[0].value = 'R';
document.getElementsByName('frmCadastro')[0].action = 'estabelecimento_manter.php';
document.getElementsByName('frmCadastro')[0].submit();
}


</script>
</body>
</html>
<?php include("../../rodape.php"); ?>