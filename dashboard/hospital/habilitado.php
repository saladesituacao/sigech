<?php if (permissao_acesso(252)) { ?>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="sh">
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
					<th data-field='servicohabilitado' data-sortable='true' data-filter-control='input'  width="40%">Serviços Habilitados</th>
					<th>Valor</th>
                    <th>Portaria</th>
                    <th>Leitos</th>
                    <th>Observações</th>
                    <th>Ação</th>
				</tr>
			</thead>
			<tbody>
                    
         <?php                   
                              
                        // Varrer registros
        while ($linhaEstabServHabilitado = pg_fetch_row($rsEstabServHabilitado)){
			
               ?>
               
               <tr>
                          <td> <?php echo $linhaEstabServHabilitado[1] . $linhaEstabServHabilitado[3] . "  -  " . $linhaEstabServHabilitado[4];?></td>
                          <td> <?php echo 'R$' . number_format($linhaEstabServHabilitado[7], 2, ',', '.');?></td>
                          <td> 
                          <?php if    ($linhaEstabServHabilitado[11] != '' ){

                                echo ("<a href='$linhaEstabServHabilitado[11]' target='_blank'>" . $linhaEstabServHabilitado[8] . "</a>");
                          }else{
                                echo $linhaEstabServHabilitado[8];

                          }?>
                          
                          </td>
                          <td> <?php echo $linhaEstabServHabilitado[9];?></td>
                          <td> <?php echo $linhaEstabServHabilitado[10];?></td>
                          <td> 
                                
                        <?php if (((permissao_acesso(257) && $perfil->RetornaPerfil($acesso->usuario->perfil) == $estabelecimento) || $acesso->usuario->perfil == 1)){ ?>
                                <button class='btn btn-default btn-xs' onClick="editarHSH('<?php echo $linhaEstabServHabilitado[0];?>','<?php echo $linhaEstabServHabilitado[5];?>')"><i class='fa fa-edit' style='font-size:24px;color:green'></i> Editar</button>
                        <?php } ?>

                        <?php if (((permissao_acesso(263) && $perfil->RetornaPerfil($acesso->usuario->perfil) == $estabelecimento) || $acesso->usuario->perfil == 1)){ ?>
                                <button class='btn btn-default btn-xs' data-target='#modalDesabilitar' data-toggle='modal' onClick="desabilitar('<?php echo $linhaEstabServHabilitado[0];?>','<?php echo $linhaEstabServHabilitado[5] ;?>')"><i class='fa fa-times-circle' style='font-size:24px;color:red'></i> Desabilitar</button>
                        </td>
                        <?php } ?>
                         
                        
                    </tr>
                    <?php  } ?>
                        </tbody>
                    </table>
                </div><!-- /box -->

            </div><!-- /tab -->
            
<?php } ?>