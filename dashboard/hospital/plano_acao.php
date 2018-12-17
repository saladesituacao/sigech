
<?php if (permissao_acesso(297)) { ?>


             <div role="tabpanel" class="tab-pane " id="pa">
             <span role="button" data-toggle="print" class="fa fa-print pull-right" onclick="javascript:window.print();"></span>
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
			data-pagination="false"
			data-side-pagination="client"
			data-page-size=12
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
                                <th>Observações</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?PHP                   
                         
                    // Varrer registros
                    while ($linhaPCH = pg_fetch_row($rsPCH)){
                            if ($linhaPCH[11] == ''){

                                ?>
            <tr>
                      <td> <?php echo $linhaPCH[3]; ?>
                      </td>
                            <td> <?php echo $linhaPCH[5]; ?>
                      </td>
                            <td> <?php echo $linhaPCH[6]; ?>
                    </td>
                            <td> <?php echo $linhaPCH[7]; ?>
                    </td>

                            <td> <?php echo $linhaPCH[4]; ?>
                    </td>

                    <td> <?php echo $linhaPCH[8]; ?>
                    </td>

                    <td> <?php echo $linhaPCH[9]; ?>
                    </td>

                    <td> <?php echo $linhaPCH[10]; ?>
                    </td>
                    <td> <?php echo $linhaPCH[12]; ?>
                    </td> 
                    <td>
                      
                    
                    <?php if (((permissao_acesso(298) && $perfil->RetornaPerfil($acesso->usuario->perfil) == $estabelecimento) || $acesso->usuario->perfil == 1)){ ?>
                        <button class='btn btn-default btn-xs' data-target='#modalEditarPCH' data-toggle='modal' onClick='editarPCH(<?php echo $linhaPCH[0];?>,<?php echo $linhaPCH[1]; ?>)'><i class='fa fa-edit' style='font-size:12px;color:green'></i> Editar</button>
                    <?php } ?>

                    <?php if (((permissao_acesso(236) && $perfil->RetornaPerfil($acesso->usuario->perfil) == $estabelecimento) || $acesso->usuario->perfil == 1)){ ?>
                        <button class='btn btn-default btn-xs' data-target='#modalObservacaoPCH' data-toggle='modal' onClick='informarRPCH(<?php echo $linhaPCH[0];?>,<?php echo $linhaPCH[1]; ?>)'><i class='fa fa-folder-o' style='font-size:12px;color:green'></i> Observações</button>
                    <?php } ?>
                     
                    <?php if (((permissao_acesso(237) && $perfil->RetornaPerfil($acesso->usuario->perfil) == $estabelecimento) || $acesso->usuario->perfil == 1)){ ?>
                    <button class='btn btn-default btn-xs' data-target='#modalFinalizarPCH' data-toggle='modal' onClick='finalizarFPCH(<?php echo $linhaPCH[0]; ?>,<?php echo $linhaPCH[1];?>)' alt='Finalizar'><i class='fa fa-check-square-o' style='font-size:12px;color:green'></i>Finalizar</button>
                    <?php } ?>

                    <?php if (((permissao_acesso(299) && $perfil->RetornaPerfil($acesso->usuario->perfil) == $estabelecimento) || $acesso->usuario->perfil == 1)){ ?>
                        <button class='btn btn-default btn-xs' onClick='historicoItemPCH(<?php echo $linhaPCH[0];?>,<?php echo $linhaPCH[1]; ?>)'><i class='fa fa-newspaper-o' style='font-size:12px;color:green'></i> Histórico</button>
                    <?php } ?>
 
 
                    
                </tr>
   <?php
            } 
    }
    ?>
                        </tbody>
                    </table>
                </div><!-- /box -->

            </div><!-- /tab -->


        </div><!-- /tab -->
<?php } ?>