<?php 

include("../../cabecalho_menu.php"); 
include ("../../classes/Auditoria.php"); 
include ("../../assets/lib/brTable.php");

if (empty($_REQUEST['log'])) {
	Auditoria(31, "Acessar Relatório de Auditoria", "");
}

$cod_usuario = $_REQUEST['cod_usuario'];
$cod_modulo_auditoria = $_REQUEST['cod_modulo_auditoria'];
$cod_acao_auditoria = $_REQUEST['cod_acao_auditoria'];
$dt_inicio = $_REQUEST['dt_inicio'];
$dt_fim = $_REQUEST['dt_fim'];
$acao = $_REQUEST['acao'];

?>



    <div class="container">
        
        
    <div class="well text-center">
		<h3 class="header-page__title">
		<b>RELATÓRIO DE AUDITORIA</b>
			<span role="button" data-toggle="print" class="fa fa-print pull-right" onclick="javascript:window.print();"></span>
		</h3>
	</div>
        
    
    <form id="frm1">
        <input type="hidden" name="log" id="log" value="1" />
        <div align="center">
            <div class="row">
                <div class="col-md-6">                                                           
                    <label for="exampleInputEmail1">Data Início:</label> 
                    <div class="form-group">
                        <div class='input-group date'>
                            <input type="text" class="form-control" id="dt_inicio" name='dt_inicio' autocomplete="off" value="<?=$dt_inicio?>" placeholder='DD/MM/AAAA' onkeydown="FormataData(this, event)" onkeypress="return isNumberKey(event)"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>  
                        </div>                                           
                    </div>                    
                </div>
                <div class="col-md-6">
                    <label for="exampleInputEmail1">Data Fim:</label>
                    <div class="form-group">
                        <div class='input-group date' >
                            <input type='text' class="form-control" id='dt_fim' name='dt_fim' autocomplete="off" value="<?=$dt_fim?>" placeholder='DD/MM/AAAA' onkeydown="FormataData(this, event)" onkeypress="return isNumberKey(event)"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div> 
            </div>                 
            <br />
            <div class="row">
                <div class="col-md-6">
                    <label for="exampleInputEmail1">Módulo:</label>
                    <select id="cod_modulo_auditoria" name="cod_modulo_auditoria" class="chosen-select" data-placeholder="Módulo" onchange="frm1.submit();">
                        <option></option>    
						<?php    
						       
                        $q = pg_query("SELECT cod_modulo_auditoria, txt_modulo_auditoria FROM sigech.tb_modulo_auditoria WHERE cod_ativo = 1 ORDER BY txt_modulo_auditoria");
                        while ($row = pg_fetch_array($q)) 
                        { ?>
                            <option value="<?=$row["cod_modulo_auditoria"]?>"<?php if ($cod_modulo_auditoria == $row["cod_modulo_auditoria"]) { echo("selected");}?>><?=$row["txt_modulo_auditoria"] ?></option>
                        <?php	
                        } ?>                    
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputEmail1">Ação:</label>
                    <select id="cod_acao_auditoria" name="cod_acao_auditoria" class="chosen-select" data-placeholder="Ação">
                        <option></option>   
                        <?php 
                        if (!empty($cod_modulo_auditoria)) {
                            $condicao_auditoria = " AND cod_modulo_auditoria = ". $cod_modulo_auditoria;
                        }
                        
                        $q = pg_query("SELECT cod_acao_auditoria, txt_acao_auditoria FROM sigech.tb_acao_auditoria WHERE cod_ativo = 1 ".$condicao_auditoria ." ORDER BY txt_acao_auditoria");
                        while ($row = pg_fetch_array($q)) 
                        { ?>
                            <option value="<?=$row["cod_acao_auditoria"]?>"<?php if ($cod_acao_auditoria == $row["cod_acao_auditoria"]) { echo("selected");}?>><?=$row["txt_acao_auditoria"] ?></option>
                        <?php	
                        } ?>                       
                    </select>
                </div>
            </div>  
            <br />
            <div class="row">
                <div class="col-md-6">
                    <label for="exampleInputEmail1">Usuário:</label>
                    <select id="cod_usuario" name="cod_usuario" class="chosen-select" data-placeholder="Usuário">
                        <option></option>    
                        <?php                        
                        $q = pg_query("SELECT cod_usuario, txt_nome FROM sigech.tb_usuario ORDER BY txt_nome");
                        while ($row = pg_fetch_array($q)) 
                        { ?>
                            <option value="<?=$row["cod_usuario"]?>"<?php if ($cod_usuario == $row["cod_usuario"]) { echo("selected");}?>><?=$row["txt_nome"] ?></option>
                        <?php	
                        } ?>                    
                    </select>
                </div>
            </div>             
            <br />
            <div class="row">
                <div class="col-md-12">
                <?php if (permissao_acesso(66)) {?>
                    <button type="submit" id="btn_pesquisar" name="acao" value="pesquisar" class="btn btn-primary">Pesquisar</button>
                    <?php }?>
                <?php if (permissao_acesso(67)) {?>
                    <a href="relAuditoria.php" class="btn btn-default">Limpar</a>
                    <?php }?>
                </div><!--col-md-12-->
            </div><!--row-->                        
        </div>












		<?php 
		
        if (strtolower($acao) == "pesquisar") { 
			
			
			?>
            <hr />	
            
                <?php          	
                $condicao = "1 = 1 ";

                if(!empty($cod_modulo_auditoria)) {
                    $condicao .= " AND sigech.tb_acao_auditoria.cod_modulo_auditoria = ".$cod_modulo_auditoria;
                }
                if(!empty($cod_acao_auditoria)) {
                    $condicao .= " AND sigech.tb_auditoria.cod_acao_auditoria = ".$cod_acao_auditoria;
                }
                if(!empty($dt_inicio)) {
                    $condicao .= " AND sigech.tb_auditoria.dt_auditoria >= '".DataBanco($dt_inicio)."'";
                }
                if(!empty($dt_fim)) {
                    $condicao .= " AND sigech.tb_auditoria.dt_auditoria <= '".DataBanco($dt_fim)." 23:59:59'";
                }
                if(!empty($cod_usuario)) {
                    $condicao .= " AND sigech.tb_auditoria.cod_usuario = ".$cod_usuario;
                }
                

                $sql = " SELECT tb_auditoria.txt_historico, tb_auditoria.txt_sql, TO_CHAR(tb_auditoria.dt_auditoria, 'DD/MM/YYYY HH24:MI:SS') AS dt_auditoria, ";
                $sql .= " txt_acao_auditoria, txt_nome, txt_modulo_auditoria, txt_sigla ";
                $sql .= " FROM sigech.tb_auditoria ";
                $sql .= " INNER JOIN sigech.tb_acao_auditoria ON sigech.tb_acao_auditoria.cod_acao_auditoria = sigech.tb_auditoria.cod_acao_auditoria ";
                $sql .= " INNER JOIN sigech.tb_modulo_auditoria ON sigech.tb_modulo_auditoria.cod_modulo_auditoria = sigech.tb_acao_auditoria.cod_modulo_auditoria ";
                $sql .= " INNER JOIN sigech.tb_usuario ON sigech.tb_usuario.cod_usuario = sigech.tb_auditoria.cod_usuario ";
                $sql .= " LEFT JOIN sigech.tb_orgao ON sigech.tb_orgao.cod_orgao = sigech.tb_usuario.cod_orgao ";
                $sql .= " WHERE ".$condicao." ORDER BY sigech.tb_auditoria.dt_auditoria DESC ";	
                	    
                $q1 = pg_query($sql);
                if (pg_num_rows($q1) > 0) {
                ?>

            
            
            
            
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
					<th data-field='txt_modulo_auditoria' data-sortable='true' data-filter-control='input'  width="10%">Módulo</th>
					<th data-field='txt_acao_auditoria' data-sortable='true' data-filter-control='input'  width="10%">Ação</th>
					<th data-field='txt_nome' data-sortable='true' data-filter-control='input'  width="20%">Usuário</th>
                    <th data-field='txt_sigla' data-sortable='true' data-filter-control='input'  width="20%">Unidade</th>
                    <th data-field='dt_auditoria' data-sortable='true' data-filter-control='input'  width="20%">Data</th>
                    <th  width="20%">Descrição</th>
                    <?php if(strval($acesso->usuario->perfil) == '1') { ?>
                                        <th>SQL</th>								
                                    <?php } ?>
				</tr>
			</thead>
			<tbody>


                            <?php												
                               if (permissao_acesso(65))
                               {
                               
                               while ($rs1 = pg_fetch_array($q1)) {
                                    $txt_acao_auditoria = $rs1['txt_acao_auditoria'];
                                    $txt_usuario = $rs1['txt_nome'];
                                    $txt_historico = $rs1['txt_historico'];
                                    $txt_sql = $rs1['txt_sql'];
                                    $txt_modulo_auditoria = $rs1['txt_modulo_auditoria'];
                                    $dt_auditoria = $rs1['dt_auditoria'];                                    
                                    $txt_sigla = $rs1['txt_sigla'];                                    
                                ?>
                                    <tr>
                                        <td><?php echo($txt_modulo_auditoria) ?></td>
                                        <td><?php echo($txt_acao_auditoria) ?></td>				
                                        <td><?php echo($txt_usuario) ?></td>					
                                        <td><?php echo($txt_sigla) ?></td>					
                                        <td><?php echo($dt_auditoria) ?></td>
                                        <td><?php echo($txt_historico) ?></td>
                                        <?php if(strval($acesso->usuario->perfil) == '1') { ?>
                                            <td><?php echo($txt_sql) ?></td>
                                        <?php } ?>
                                    </tr>		
                                <?php
                                }}
                                ?>											
                            </tbody>
                        </table>
                    				
                <?php
                }
                else {
                ?>
                    <hr>
                    <center><h4>NÃO EXISTEM REGISTROS CADASTRADOS.</h4></center>
                <?php
                }
                ?>	
            <?php
        } ?>        
    </form>
</div>
</div>
		
<script type="text/javascript">

	
$('#table').on('reset-view.bs.table', function () {
	var a = $('#table').bootstrapTable('getData',true).length;
	$('#totalFiltrado').text("Total da seleção " + a);
});
</script>
<?php include("../../rodape.php"); ?>

<script type="text/javascript">

	
  $( function() {
    $( "#dt_inicio" ).datepicker();
    $( "#dt_fim" ).datepicker();
  });
</script>