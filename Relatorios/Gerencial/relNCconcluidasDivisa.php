<?php 

include("../../cabecalho_menu.php"); 
include ("../../classes/Auditoria.php"); 
include ("../../assets/lib/brTable.php");

if (empty($_REQUEST['log'])) {
	Auditoria(56, "Acessar Relatório de Concluídas pela DIVISA", "");
}

?>



    <div class="container">
        
        
    <div class="well text-center">
		<h3 class="header-page__title">
		<b>
		Nº DE NÃO CONFORMIDADES CONCLUÍDAS PELA DIVISA (por mês)</b>
			<span role="button" data-toggle="print" class="fa fa-print pull-right" onclick="javascript:window.print();"></span>
		</h3>
	</div>
        
    
    <form id="frm1">
        <input type="hidden" name="log" id="log" value="1" />
               
           
		
            
                <?php          	
                
                
                $sql = "
                
                SELECT
	est.nm_estabelecimento,
extract(year from pch.dt_cumprimento) as ano,
	extract(month from pch.dt_cumprimento) as mes,
		COUNT (
		pch.cod_pch_estabelecimento
	) AS total
FROM
	sigech.tb_pch_estabelecimento pch
INNER JOIN sigech.tb_estabelecimento est ON pch.cod_estabelecimento = est.cod_estabelecimento
WHERE pch.dt_cumprimento IS NOT NULL
AND pch.ind_habilitado = 'N'
GROUP BY
	est.nm_estabelecimento,
extract(year from pch.dt_cumprimento),
extract(month from pch.dt_cumprimento)
ORDER BY 2,3 ASC
         
                ";	
                	    
                $q1 = pg_query($sql);
                if (pg_num_rows($q1) > 0) {
                ?>

            
            
            
            
<!-- Nº DE NÃO CONFORMIDADES CONCLUÍDAS PELA DIVISA (por mês) -->
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
					<th data-field='ano' data-sortable='true' data-filter-control='input'  width="10%">Ano</th>
					<th data-field='mes' data-sortable='true' data-filter-control='input'  width="10%">Mês</th>
                    <th  width="20%">Total</th>
                   
				</tr>
			</thead>
			<tbody>


							<?php		
							$totalNC = 0;
                               while ($rs1 = pg_fetch_array($q1)) {


								switch ($rs1['mes']) {
									case "1":    $mes = "Janeiro";     break;
									case "2":    $mes = "Fevereiro";   break;
									case "3":    $mes = "Março";       break;
									case "4":    $mes = "Abril";       break;
									case "5":    $mes = "Maio";        break;
									case "6":    $mes = "Junho";       break;
									case "7":    $mes = "Julho";       break;
									case "8":    $mes = "Agosto";      break;
									case "9":    $mes = "Setembro";    break;
									case "10":    $mes =" Outubro";     break;
									case "11":    $mes =" Novembro";    break;
									case "12":    $mes =" Dezembro";    break; 
							 }

                                ?>
                                    <tr>
                                        <td><?php echo($rs1['nm_estabelecimento']) ?></td>
                                        <td><?php echo($rs1['ano']) ?></td>				
										<td><?php echo($mes) ?></td>				
                                        <td><?php echo($rs1['total']) ?></td>				
                                    </tr>		
                                <?php
								$totalNC = $totalNC + $rs1['total'];
                                }
                                ?>	
								<tr>
                                        <td><b>Total:</td>
                                        <td></td>				
										<td></td>				
                                        <td><b><?php echo($totalNC) ?></td>				
                                    </tr>											
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

