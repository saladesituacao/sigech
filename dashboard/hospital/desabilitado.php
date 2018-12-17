
<?php if (permissao_acesso(166)) { ?>

            <div role="tabpanel" class="tab-pane " id="sd">
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
                                <th>Serviços Desabilitados</th>
                                <th>Valor</th>
                                <th>Portaria</th>
                                <th>Leitos</th>
                                <th>Justificativa</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?PHP                   
                        
                    // Varrer registros
    while ($linhaEstabServDesHabilitado = pg_fetch_row($rsEstabServDesHabilitado)){
         
            echo " <tr>
                      <td> $linhaEstabServDesHabilitado[1] $linhaEstabServDesHabilitado[3] .  $linhaEstabServDesHabilitado[4]
                      </td>
                            <td> $linhaEstabServDesHabilitado[7] 
                      </td>
                            <td> $linhaEstabServDesHabilitado[8]  
                    </td>
                            <td> $linhaEstabServDesHabilitado[9]
                    </td>

                            <td> $linhaEstabServDesHabilitado[11]
                    </td>
                </tr>";
    }
    ?>
                        </tbody>
                    </table>
                </div><!-- /box -->

            </div><!-- /tab -->
<?php } ?>