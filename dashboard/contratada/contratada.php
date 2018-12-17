
<?php if (permissao_acesso(103)) { ?>

            <div role="tabpanel" class="tab-pane " id="sph">
            <span role="button" data-toggle="print" class="fa fa-print pull-right" onclick="javascript:window.print();"></span>
            <div class="box box--default">
                    
            <?php if (((permissao_acesso(314) && $perfil->RetornaPerfil($acesso->usuario->perfil) == $estabelecimento) || $acesso->usuario->perfil == 1)){ ?>
                    <button id="Incluir" class="btn btn-default" onClick="adicionar(<?php echo tratarStr($_GET['cod']); ?>);"><i class="fa fa-plus-square" style="font-size:24px;color:green"></i> Adicionar</button>
            <?php } ?>        
                    
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
                                <th>Objeto</th>
                                <th>Contrato</th>
                                <th>Vigência</th>
                                <th>Processo</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?PHP                   
                        
                    // Varrer registros
    while ($linhaServicoContratado = pg_fetch_row($rsServicoContratado)){
        
        ?>
         
        <tr> 
                        <td> <?php echo $linhaServicoContratado[2];?></td>
                        <td> <?php echo $linhaServicoContratado[3];?> </td>
                        <td> <?php echo $linhaServicoContratado[4];?> </td>
                        <td> <?php echo $linhaServicoContratado[5];?> </td>
                        <td> 
                                
                        <?php if (((permissao_acesso(315) && $perfil->RetornaPerfil($acesso->usuario->perfil) == $estabelecimento) || $acesso->usuario->perfil == 1)){ ?>
                                <button class='btn btn-default btn-xs' onClick="editar('<?php echo $linhaServicoContratado[0];?>','<?php echo $linhaServicoContratado[1];?>')"><i class='fa fa-edit' style='font-size:24px;color:green'></i> Editar</button>
                        <?php } ?>
                        <?php if (((permissao_acesso(316) && $perfil->RetornaPerfil($acesso->usuario->perfil) == $estabelecimento) || $acesso->usuario->perfil == 1)){ ?>
                                <button class='btn btn-default btn-xs' onClick="desativar('<?php echo $linhaServicoContratado[0];?>','<?php echo $linhaServicoContratado[1];?>')"><i class='fa fa-times-circle' style='font-size:24px;color:red'></i> Desativar</button>
                        <?php } ?>
                        </td>

        </tr>
        
        
<?php }?>
                        </tbody>
                    </table>
                </div><!-- /box -->

            </div><!-- /tab -->
<?php } ?>