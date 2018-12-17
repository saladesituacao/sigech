
<?php 

include("../../cabecalho_menu.php"); 
include ("../../classes/Auditoria.php");
include ("../../assets/lib/brTable.php");


	  $sqlCargo = "select 
	  cod_cargo, txt_cargo, txt_descricao, cod_ativo
	  from sigech.tb_cargo  order by txt_cargo asc";

		$rsCargo = $acesso->getRs($sqlCargo);	
		Auditoria(34,'Listagem de cargos', $sql);
?>

<style>
.fixed-table-body {
    height: auto;
    overflow: auto;
}
</style>


	<form name="frmCadastro" action="" method="post">
		<input type='hidden' name='acao' value='A'>
		<input type='hidden' name='cod_cargo' value=''>
	<div class="container">
	<div class="well text-center">
		<h3 class="header-page__title">
		<b>CARGOS</b>
			<span role="button" data-toggle="print" class="fa fa-print pull-right" onclick="javascript:window.print();"></span>
		</h3>
	</div>
        <div class="clearfix"></div>
		<?php	
			if (permissao_acesso(68))
                {?>
		<button class="btn btn-default" onClick="adicionar();"><i class="fa fa-plus-square" style="font-size:24px;color:green"></i> Adicionar</button>
		<?php }?>
<!-- LISTA DE USUÁRIO -->
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
					<th data-field='txt_cargo' data-sortable='true' data-filter-control='input'  width="10%">Cargo</th>
					<th data-field='txt_descricao' data-sortable='true' data-filter-control='input'  width="80%">Descrição</th>
					<th  width="20%"> Ativo</th>
					<th  width="20%"> Ações</th>
				</tr>
			</thead>
			<tbody>

			<?php
	  
	  if (permissao_acesso(292))
	  {
	  while ($linhaCargo = pg_fetch_row($rsCargo)){
		?>


            <tr>
			<td width="10%"><H6><?php echo $linhaCargo[1]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaCargo[2]; ?></H6></td>
			<td width="10%"><H6><?php 
				if ($linhaCargo[3] == 0){
						echo ('NÃO');

				}else{
						echo ('SIM');
				}
				 ?>
				</H6>
			</td>
			<td width="10%">
			<?php if (permissao_acesso(70)) {?>
				<button  class="btn btn-default btn-xs" onClick="visualizar('<?php echo $linhaCargo[0]; ?>')"><i class="fa fa-eye" style="font-size:24px;color:blue"></i> Visualizar</button>
				<?php }?>
				<?php if (permissao_acesso(69)) {?>
				<button class="btn btn-default btn-xs" onClick="editar('<?php echo $linhaCargo[0]; ?>')"><i class="fa fa-edit" style="font-size:24px;color:green"></i> Editar</button>
				<?php }?>
				<?php 
				if ($linhaCargo[3] == 0){?>
					<?php if (permissao_acesso(72)) {?>
					<button class="btn btn-default btn-xs" onClick="reativar('<?php echo $linhaCargo[0]; ?>')"><i class="fa  fa-compass" style="font-size:24px;color:yellow"></i> Reativar</button>
					<?php }?>
				<?php		
				}else{?>
					<?php if (permissao_acesso(71)) {?>
					<button class="btn btn-default btn-xs" onClick="desativar('<?php echo $linhaCargo[0]; ?>')"><i class="fa fa-compass" style="font-size:24px;color:red"></i> Desativar</button>
					<?php }?>
				<?php
				}
				 ?>
			</td>

    </tr>
	<?php  } }?>



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
	document.getElementsByName('cod_cargo')[0].value = '';
	document.getElementsByName('acao')[0].value = 'I';

	document.getElementsByName('frmCadastro')[0].action = 'cargo.php';
	document.getElementsByName('frmCadastro')[0].submit();
}


function editar(cod){

	document.getElementsByName('cod_cargo')[0].value = cod;
	document.getElementsByName('acao')[0].value = 'A';
	document.getElementsByName('frmCadastro')[0].action = 'cargo.php';
	document.getElementsByName('frmCadastro')[0].submit();
}

function desativar(cod){

	document.getElementsByName('cod_cargo')[0].value = cod;
	document.getElementsByName('acao')[0].value = 'D';
	document.getElementsByName('frmCadastro')[0].action = 'cargo_manter.php';
	document.getElementsByName('frmCadastro')[0].submit();
}

function reativar(cod){

	document.getElementsByName('cod_cargo')[0].value = cod;
	document.getElementsByName('acao')[0].value = 'R';
	document.getElementsByName('frmCadastro')[0].action = 'cargo_manter.php';
	document.getElementsByName('frmCadastro')[0].submit();
}


function visualizar(cod){
	
		document.getElementsByName('cod_cargo')[0].value = cod;
		document.getElementsByName('acao')[0].value = 'V';
		document.getElementsByName('frmCadastro')[0].action = 'visualizar.php';
		document.getElementsByName('frmCadastro')[0].submit();
	}


function voltar(){

	window.location='../../index.php';	
}

</script>
</body>
</html>
<?php include("../../rodape.php"); ?>