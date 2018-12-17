
<?php 

include("../../cabecalho_menu.php"); 
include ("../../classes/Auditoria.php"); 
include ("../../assets/lib/brTable.php");

if (empty($_REQUEST['log'])) {
	Auditoria(53, "Acessar Relatório de Concluídas e Total de não Conformidades", "");
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
		<b>Nº DE NÃO CONFORMIDADES CONCLUÍDAS x Nº TOTAL DE NÃO CONFORMIDADES (por unidade)</b>
			<span role="button" data-toggle="print" class="fa fa-print pull-right" onclick="javascript:window.print();"></span>
		</h3>
	</div>
        
    
    <form id="frm1">
        <input type="hidden" name="log" id="log" value="1" />
               
           
		
            
                <?php          	
                
                
                $sql = "
                
                SELECT
	est.nm_estabelecimento,
		COUNT (
		pch.cod_pch_estabelecimento
	) AS total,
(
		SELECT
			COUNT (
				pch1.cod_pch_estabelecimento
			)
		FROM
			sigech.tb_pch_estabelecimento pch1
		WHERE
			pch1.cod_pch_estabelecimento = pch.cod_pch_estabelecimento
		AND pch1.ind_habilitado = 'N' AND pch1.cod_estabelecimento = pch.cod_estabelecimento
	) AS totalConcluidas
FROM
	sigech.tb_pch_estabelecimento pch
INNER JOIN sigech.tb_estabelecimento est ON pch.cod_estabelecimento = est.cod_estabelecimento
GROUP BY
	est.nm_estabelecimento,
totalConcluidas          
                ";	
                	    
                $q1 = pg_query($sql);
                if (pg_num_rows($q1) > 0) {
                ?>

            
            
            
            
<!-- Nº DE NÃO CONFORMIDADES CONCLUÍDAS x Nº TOTAL DE NÃO CONFORMIDADES (por unidade) -->
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
			data-pagination="false"
			data-side-pagination="client"
			data-page-size=10
			data-cache="false"
			data-page-list="[10, 20, 30, 40, All]"
			data-show-footer="true"

		>
            
            
            <thead>
				<tr>
					<th data-field='nm_estabelecimento' data-sortable='true' data-filter-control='input'  width="10%">Estabelecimento</th>
                    <th  width="20%">Número de não conformidades concluídas</th>
                    <th  width="20%">Número total de não conformidades</th>
                   
				</tr>
			</thead>
			<tbody>


                            <?php												
                              
                               while ($rs1 = pg_fetch_array($q1)) {
                                                      
                                ?>
                                    <tr>
                                        <td><?php echo($rs1['nm_estabelecimento']) ?></td>
                                        <td><?php echo($rs1['totalconcluidas']) ?></td>				
                                        <td><?php echo($rs1['total']) ?></td>				
                                    </tr>		
                                <?php
                                }
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

