<?php if (permissao_acesso(303)) { ?>


             <div role="tabpanel" class="tab-pane " id="pa">
            <div class="box box--default">
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
                                <th>Local da Vistoria</th>
                                <th>N° do Item</th>
                                <th>Não Conformidade</th>
                                <th>Determinação da divisa</th>
                                <th>Data de Cadastro</th>
                                <th>Prazo da divisa</th>
                                <th>Responsável</th>
                                <th>Prazo do responsável</th>
                                <th>Data Cumprimento</th>
                                <th>Observações</th>
                                <th>Dias corridos</th>
                                <th>Usuário</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?PHP                   
                         
                    // Varrer registros
                    while ($linhaPCHC = pg_fetch_row($rsPCHC)){
                                ?>
            <tr>
                      <td> <?php echo $linhaPCHC[3]; ?>
                      </td>
                            <td> <?php echo $linhaPCHC[5]; ?>
                      </td>
                            <td> <?php echo $linhaPCHC[6]; ?>
                    </td>
                            <td> <?php echo $linhaPCHC[7]; ?>
                    </td>

                            <td> <?php echo $linhaPCHC[4]; ?>
                    </td>

                    <td> <?php echo $linhaPCHC[8]; ?>
                    </td>

                    <td> <?php echo $linhaPCHC[9]; ?>
                    </td>

                    <td> <?php echo $linhaPCHC[10]; ?>
                    </td>
                    <td> <?php echo $linhaPCHC[11]; ?>
                    </td>
                    <td> <?php echo $linhaPCHC[12]; ?>
                    </td>
                    <td> <?php echo $linhaPCHC[13]; ?>
                    </td>
                    <td> <?php echo $linhaPCHC[14]; ?>
                    </td>

                    <td>
                      
                    
                    <?php if (permissao_acesso(305) || $acesso->usuario->perfil == 1){ ?>
                        <button class='btn btn-default btn-xs' data-target='#modalReabrirPCHC' data-toggle='modal' onClick='reabrirPCHC(<?php echo $linhaPCHC[0];?>,<?php echo $linhaPCHC[1]; ?>)'><i class='fa fa-folder-o' style='font-size:12px;color:green'></i> Reabrir</button>
                    <?php } ?>
                     
                    <?php if (permissao_acesso(304) || $acesso->usuario->perfil == 1){ ?>
                    <button class='btn btn-default btn-xs' onClick='finalizarFPCHD(<?php echo $linhaPCHC[0]; ?>,<?php echo $linhaPCHC[1];?>)' alt='Finalizar'><i class='fa fa-check-square-o' style='font-size:12px;color:green'></i>Encerrar</button>
                    <?php } ?>

                    <?php if (permissao_acesso(302) || $acesso->usuario->perfil == 1){ ?>
                        <button class='btn btn-default btn-xs' onClick='historicoItemPCH(<?php echo $linhaPCHC[0];?>,<?php echo $linhaPCHC[1]; ?>)'><i class='fa fa-newspaper-o' style='font-size:12px;color:green'></i> Histórico</button>
                    <?php } ?>

                </tr>
   <?php
    }
    ?>
                        </tbody>
                    </table>
                </div><!-- /box -->

            </div><!-- /tab -->


        </div><!-- /tab -->
<?php } ?>