
<?php if (permissao_acesso(103)) { ?>

            <div role="tabpanel" class="tab-pane " id="sph">
            <span role="button" data-toggle="print" class="fa fa-print pull-right" onclick="javascript:window.print();"></span>
            <div class="box box--default">
                    
            <?php if (((permissao_acesso(100) && $perfil->RetornaPerfil($acesso->usuario->perfil) == $estabelecimento) || $acesso->usuario->perfil == 1)){ ?>
                    <button id="Incluir" class="btn btn-default" onClick="adicionarSPH(<?php echo tratarStr($_GET['cod']); ?>);"><i class="fa fa-plus-square" style="font-size:24px;color:green"></i> Adicionar</button>
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
                                <th>Serviços A Habilitar</th>
                                <th>Valor</th>
                                <th>Portaria</th>
                                <th>Leitos</th>
                                <th>Observações</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?PHP                   
                        
                    // Varrer registros
    while ($linhaEstabServPotHabilitacao = pg_fetch_row($rsEstabServPotHabilitacao)){
        
        ?>
         
        <tr> 
                        <td> <?php echo $linhaEstabServPotHabilitacao[1] . $linhaEstabServPotHabilitacao[3] .  " - " . limitarTexto($linhaEstabServPotHabilitacao[4],'60');?></td>
                        <td> <?php echo 'R$' . number_format($linhaEstabServPotHabilitacao[7], 2, ',', '.');?> </td>



                        <td> 
                        <?php if    ($linhaEstabServPotHabilitacao[14] != '' ){

echo ("<a href='$linhaEstabServPotHabilitacao[14]' target='_blank'>" . $linhaEstabServPotHabilitacao[8] . "</a>");
}else{
echo $linhaEstabServPotHabilitacao[8];

}?>
                        </td>
                        
                        
                        
                        <td> <?php echo $linhaEstabServPotHabilitacao[9];?></td>
                        <td> <?php echo $linhaEstabServPotHabilitacao[10];?></td>
                        <td> 
                                
                        <?php if (((permissao_acesso(101) && $perfil->RetornaPerfil($acesso->usuario->perfil) == $estabelecimento) || $acesso->usuario->perfil == 1)){ ?>
                                <button class='btn btn-default btn-xs' onClick="editarHSPH('<?php echo $linhaEstabServPotHabilitacao[0];?>','<?php echo $linhaEstabServPotHabilitacao[5];?>')"><i class='fa fa-edit' style='font-size:24px;color:green'></i> Editar</button>
                        <?php } ?>
                        
                        <?php if (((permissao_acesso(102) && $perfil->RetornaPerfil($acesso->usuario->perfil) == $estabelecimento) || $acesso->usuario->perfil == 1)){ ?>
                                <button class='btn btn-default btn-xs' onClick="acompanharEPH('<?php echo $linhaEstabServPotHabilitacao[0];?>','<?php echo $linhaEstabServPotHabilitacao[5];?>')"><i class='fa fa-line-chart' style='font-size:24px;color:blue'></i>Acompanhar</button>
                        </td>
                        <?php } ?>
        </tr>
        
        
<?php }?>
                        </tbody>
                    </table>
                </div><!-- /box -->

            </div><!-- /tab -->
<?php } ?>