<?php 

include("../../cabecalho_menu.php"); 
include ("../../classes/Auditoria.php");
include ("../../assets/lib/brTable.php");


	  $sqlUsuario = "select 
	  sigech.tb_usuario.cod_usuario, txt_nome, txt_login, txt_email, dt_ativacao, dt_inativacao, txt_telefone, txt_matricula, txt_perfil, txt_cargo, txt_sigla
	  from sigech.tb_usuario  
	  LEFT JOIN sigech.tb_perfil ON sigech.tb_perfil.cod_perfil = sigech.tb_usuario.cod_perfil 
	  LEFT JOIN sigech.tb_orgao ON sigech.tb_orgao.cod_orgao = sigech.tb_usuario.cod_orgao
	  LEFT JOIN sigech.tb_cargo ON sigech.tb_cargo.cod_cargo = sigech.tb_usuario.cod_cargo
	  order by txt_nome asc";

		$rsUsuario = $acesso->getRs($sqlUsuario);	
		Auditoria(7,'Listagem de usuários', $sql);
?>

<style>
.fixed-table-body {
    height: auto;
    overflow: auto;
}
</style>


	<form name="frmCadastro" action="" method="post">
		<input type='hidden' name='acao' value='A'>
		<input type='hidden' name='cod_usuario' value=''>
	<div class="container">
	<div class="well text-center">
		<h3 class="header-page__title">
		<b>USUÁRIOS</b>
			<span role="button" data-toggle="print" class="fa fa-print pull-right" onclick="javascript:window.print();"></span>
		</h3>
	</div>
        <div class="clearfix"></div>
		<?php if (permissao_acesso(53)) { ?>
		<button class="btn btn-default" onClick="adicionar();"><i class="fa fa-plus-square" style="font-size:24px;color:green"></i> Adicionar</button>
		<?php } ?> 
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
					<th data-field='txt_nome' data-sortable='true' data-filter-control='input'  width="10%">Nome</th>
					<th data-field='txt_login' data-sortable='true' data-filter-control='input'  width="10%">Login</th>
					<th data-field='txt_email' data-sortable='true' data-filter-control='input'  width="10%">E-mail</th>
					<th data-field='txt_cargo' data-sortable='true' data-filter-control='input'  width="10%">Cargo</th>
					<th data-field='txt_orgao' data-sortable='true' data-filter-control='input'  width="10%">Lotação</th>
					<th data-field='txt_perfil' data-sortable='true' data-filter-control='input'  width="10%">Perfil</th>
					<th  width="10%"> Telefone</th>
					<th  width="10%"> Ativo</th>
					<th  width="30%"> Ações</th>
				</tr>
			</thead>
			<tbody>

			<?php
	  
	  if (permissao_acesso(58)) { 
	  while ($linhaUsuario = pg_fetch_row($rsUsuario)){
		?>


            <tr>
			<td width="10%"><H6><?php echo $linhaUsuario[1]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaUsuario[2]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaUsuario[3]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaUsuario[9]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaUsuario[10]; ?></H6></td>
			<td width="10%"><H6><?php echo $linhaUsuario[8]; ?></H6></td>
			<td width="10%"><H6><?php echo mask($linhaUsuario[6],'(##)####-####'); ?></H6></td>
			<td width="10%"><H6><?php 
				if ($linhaUsuario[5] != ''){
						echo ('NÃO');

				}else{
						echo ('SIM');
				}
				 ?>
				</H6>
			</td>
			<td width="30%">
			<?php if (permissao_acesso(55)) { ?>
				<button  class="btn btn-default btn-xs" onClick="visualizar('<?php echo $linhaUsuario[0]; ?>')"><i class="fa fa-eye" style="font-size:24px;color:blue"></i> Visualizar</button>
				<?php } ?> 

			<?php if (permissao_acesso(54)) { ?>
				<button class="btn btn-default btn-xs" onClick="editar('<?php echo $linhaUsuario[0]; ?>')"><i class="fa fa-edit" style="font-size:24px;color:green"></i> Editar</button>
			<?php } ?> 
				<?php 
				if ($linhaUsuario[5] != ''){?>
					
					<?php if (permissao_acesso(57)) { ?>
					<button class="btn btn-default btn-xs" onClick="reativar('<?php echo $linhaUsuario[0]; ?>')"><i class="fa  fa-compass" style="font-size:24px;color:yellow"></i> Reativar</button>
					<?php } ?> 
				<?php		
				}else{?>

				<?php if (permissao_acesso(56)) { ?>
					<button class="btn btn-default btn-xs" onClick="desativar('<?php echo $linhaUsuario[0]; ?>')"><i class="fa fa-compass" style="font-size:24px;color:red"></i> Desativar</button>
					<?php } ?> 
				<?php
				}
				 ?>
			</td>

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
	document.getElementsByName('cod_usuario')[0].value = '';
	document.getElementsByName('acao')[0].value = 'I';

	document.getElementsByName('frmCadastro')[0].action = 'usuario.php';
	document.getElementsByName('frmCadastro')[0].submit();
}


function editar(cod){

	document.getElementsByName('cod_usuario')[0].value = cod;
	document.getElementsByName('acao')[0].value = 'A';
	document.getElementsByName('frmCadastro')[0].action = 'usuario.php';
	document.getElementsByName('frmCadastro')[0].submit();
}

function desativar(cod){

	document.getElementsByName('cod_usuario')[0].value = cod;
	document.getElementsByName('acao')[0].value = 'D';
	document.getElementsByName('frmCadastro')[0].action = 'usuario_manter.php';
	document.getElementsByName('frmCadastro')[0].submit();
}

function reativar(cod){

	document.getElementsByName('cod_usuario')[0].value = cod;
	document.getElementsByName('acao')[0].value = 'R';
	document.getElementsByName('frmCadastro')[0].action = 'usuario_manter.php';
	document.getElementsByName('frmCadastro')[0].submit();
}


function visualizar(cod){
	
		document.getElementsByName('cod_usuario')[0].value = cod;
		document.getElementsByName('acao')[0].value = 'V';
		document.getElementsByName('frmCadastro')[0].action = 'visualizar.php';
		document.getElementsByName('frmCadastro')[0].submit();
	}


function perfil(cod){

	document.getElementsByName('cod_usuario')[0].value = cod;
	document.getElementsByName('acao')[0].value = '';
	document.getElementsByName('frmCadastro')[0].action = 'usuario_perfil.php';
	document.getElementsByName('frmCadastro')[0].submit();
}

function voltar(){

	window.location='../../index.php';	
}

</script>
</body>
</html>
<?php include("../../rodape.php"); ?>