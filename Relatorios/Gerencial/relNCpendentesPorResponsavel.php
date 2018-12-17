
<?php 

include("../../cabecalho_menu.php"); 
include ("../../classes/Auditoria.php"); 
include ("../../assets/lib/brTable.php");

if (empty($_REQUEST['log'])) {
	Auditoria(57, "Acessar Relatório de Conformidades Solucionadas pelas Unidades", "");
}

?>



    <div class="container">
        
        
    <div class="well text-center">
		<h3 class="header-page__title">
		<b>
		Nº 
		</b>DE NÃO CONFORMIDADES PENDENTES (por responsável)
			<span role="button" data-toggle="print" class="fa fa-print pull-right" onclick="javascript:window.print();"></span>
		</h3>
	</div>
        
    
    <form id="frm1">
        <input type="hidden" name="log" id="log" value="1" />
               
           
		
            
                <?php          	
                
                
                $sql = "
                
                SELECT
est.nm_estabelecimento,
pch.txt_responsavel,
COUNT (
pch.cod_pch_estabelecimento
) AS total
FROM
sigech.tb_pch_estabelecimento pch
INNER JOIN sigech.tb_estabelecimento est ON pch.cod_estabelecimento = est.cod_estabelecimento
WHERE pch.dt_cumprimento IS NULL
AND pch.ind_habilitado = 'S'
GROUP BY
est.nm_estabelecimento,
pch.txt_responsavel
ORDER BY 1,2 ASC
         
                ";	
                	    
                $q1 = pg_query($sql);
                if (pg_num_rows($q1) > 0) {
                ?>

            
            
            
            
<!-- Nº de não conformidades mês solucionadas pelas unidades (encaminhadas para a DIVISA) -->
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
					<th data-field='txt_responsavel' data-sortable='true' data-filter-control='input'  width="10%">Responsável</th>
                    <th  width="20%">Total</th>
				</tr>
			</thead>
			<tbody>


							<?php		
							
							
                               while ($rs1 = pg_fetch_array($q1)) {

                                ?>
                                    <tr>
                                        <td><?php echo($rs1['nm_estabelecimento']) ?></td>
                                        <td><?php echo($rs1['txt_responsavel']) ?></td>				
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

