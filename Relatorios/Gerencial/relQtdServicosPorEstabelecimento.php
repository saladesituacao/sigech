<?php 

include("../../cabecalho_menu.php"); 
include ("../../classes/Auditoria.php"); 
include ("../../assets/lib/brTable.php");

if (empty($_REQUEST['log'])) {
	Auditoria(69, "Acessar Relatório Quantitativo de Serviços por Estabelecimento", "");
}

?>

 

    
        
        
    <div class="well text-center">
		<h3 class="header-page__title">
		QUANTIDADE DE SERVIÇOS POR ESTABELECIMENTO
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
		she.cod_servico_habilitado_estabelecimento)
	 FROM sigech.tb_servico_habilitado_estabelecimento she
	 WHERE
			she.cod_estabelecimento = est.cod_estabelecimento
		AND she.ind_habilitado = 'S'
	) AS TotServHabilitado,


	(SELECT COUNT (
		she.cod_servico_habilitado_estabelecimento)
	 FROM sigech.tb_servico_habilitado_estabelecimento she
	 WHERE
			she.cod_estabelecimento = est.cod_estabelecimento
		AND she.ind_habilitado = 'N'
	) AS TotServDesabilitado,

(SELECT COUNT (
		sphe.cod_servico_potencial_habilitacao_estabelecimento)
	 FROM sigech.tb_servico_potencial_habilitacao_estabelecimento sphe
	 WHERE
			sphe.cod_estabelecimento = est.cod_estabelecimento
	) AS TotServPotencialHabilitacao
	
FROM
	sigech.tb_estabelecimento est 
ORDER BY 1 ASC
         
                ";	

                
                $q1 = pg_query($sql);
                if (pg_num_rows($q1) > 0) {
                ?>

            
            
            
            
<!-- QUANTIDADE DE SERVIÇOS POR ESTABELECIMENTOS  -->
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
                    <th  width="15%">Total de serviços habilitados</th>
                    <th  width="15%">Total de serviços desabilitados</th>
					<th  width="15%">Percentual de serviços com potencial de habilitação</th>
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
										<td><?php echo($rs1[3]) ?></td>
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

