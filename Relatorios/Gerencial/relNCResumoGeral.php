<?php 

include("../../cabecalho_menu.php"); 
include ("../../classes/Auditoria.php"); 
include ("../../assets/lib/brTable.php");

if (empty($_REQUEST['log'])) {
	Auditoria(63, "Acessar Relatório Resumido de Não Conformidades", "");
}

?>

 

    
        
        
    <div class="well text-center">
		<h3 class="header-page__title">
		RESUMO DAS NÃO CONFORMIDADES
			<span role="button" data-toggle="print" class="fa fa-print pull-right" onclick="javascript:window.print();"></span>
		</h3>
	</div>
        
    
    <form id="frm1">
        <input type="hidden" name="log" id="log" value="1" />
               
           
		
            
                <?php          	
                
                
                $sql = "
                
                SELECT DISTINCT
	est.nm_estabelecimento as Estabelecimento,
	(SELECT COUNT (
		pch1.cod_pch_estabelecimento)
	 FROM sigech.tb_pch_estabelecimento pch1
	 WHERE
			pch1.cod_estabelecimento = pch.cod_estabelecimento
	) AS TotNC,
	
	(SELECT COUNT (
		pch2.cod_pch_estabelecimento)
	 FROM sigech.tb_pch_estabelecimento pch2
	 WHERE
			pch2.cod_estabelecimento = pch.cod_estabelecimento
	 AND 	pch2.dt_cumprimento IS NULL
	) AS TotNCPendEstab,
	
	(SELECT COUNT (
		pch3.cod_pch_estabelecimento)
	 FROM sigech.tb_pch_estabelecimento pch3
	 WHERE
			pch3.cod_estabelecimento = pch.cod_estabelecimento
	AND 	pch3.dt_cumprimento IS NOT NULL
	AND 	pch3.ind_habilitado = 'S' 
	 
	) AS TotNCConcEstab,
	
	(SELECT COUNT (
		pch4.cod_pch_estabelecimento)
	 FROM sigech.tb_pch_estabelecimento pch4
	 WHERE
			pch4.cod_estabelecimento = pch.cod_estabelecimento
	AND 	pch4.dt_cumprimento IS NOT NULL
	AND 	pch4.ind_habilitado = 'N' 
	 
	) AS TotNCFinalDIVISA
	
FROM
	sigech.tb_pch_estabelecimento pch
INNER JOIN sigech.tb_estabelecimento est ON pch.cod_estabelecimento = est.cod_estabelecimento
ORDER BY 1 ASC
         
                ";	

                
                $q1 = pg_query($sql);
                if (pg_num_rows($q1) > 0) {
                ?>

            
            
            
            
<!-- Resumo das não conformidades  -->
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
					<th data-field='Estabelecimento' data-sortable='true' data-filter-control='input'  width="10%">Estabelecimento</th>
                    <th  width="15%">Total de Não Conformidades</th>
                    <th  width="15%">Total de NC Pendentes no Estabelecimento</th>
					<th  width="15%">Percentual de NC Pendentes no Estabelecimento</th>
                    <th  width="15%">Total de NC Concluídas pelo Estabelecimento</th>
					<th  width="15%">Percentual de NC Concluídas pelo Estabelecimento</th>
                    <th  width="15%">Total de NC Finalizadas pela DIVISA</th>
					<th  width="15%">Percentual de NC Finalizadas pela DIVISA</th>
				</tr>
			</thead>
			<tbody>


							<?php		
							
                               while ($rs1 = pg_fetch_array($q1)) {

                                ?>
                                    <tr>
                                        <td><?php echo($rs1[0]) ?></td>
										<td><?php echo($rs1[1]) ?></td>				
                                        <td><?php echo($rs1[2]) ?></td>
										<td><?php echo(number_format(($rs1[2]/$rs1[1])*100,2,',','.') . " %") ?></td>
                                        <td><?php echo($rs1[3]) ?></td>
										<td><?php echo(number_format(($rs1[3]/$rs1[1])*100,2,',','.') . " %") ?></td>
                                        <td><?php echo($rs1[4]) ?></td>
										<td><?php echo(number_format(($rs1[4]/$rs1[1])*100,2,',','.') . " %") ?></td>
                                    </tr>		
                            
                    				
                <?php
                }
            ?>
            </tbody>
                        </table>
                        <?php
            }else {
                ?>
                    <hr>
                    <center><h4>NÃO EXISTEM REGISTROS CADASTRADOS.</h4></center>
                <?php
                }
                ?>	
                
    </form>
</div>

		
<script type="text/javascript">

	
$('#table').on('reset-view.bs.table', function () {
	var a = $('#table').bootstrapTable('getData',true).length;
	$('#totalFiltrado').text("Total da seleção " + a);
});
</script>
<?php include("../../rodape.php"); ?>

