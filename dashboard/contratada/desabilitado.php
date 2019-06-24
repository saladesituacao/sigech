<?php if (permissao_acesso(333)) { ?>

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
                                <th>Objeto</th>
                                <th>Nr.º Contrato</th>
                                <th>Data Vigência</th>
                                <th>Data Desabilitacao</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?PHP                   
                        
                    // Varrer registros
    while ($linhaServDesHabilitado = pg_fetch_row($rsServDesHabilitado)){
         
            echo " <tr>
                      <td> $linhaServDesHabilitado[1] $linhaServDesHabilitado[3] .  $linhaServDesHabilitado[4]
                      </td>
                            <td> $linhaEstabServDesHabilitado[7] 
                      </td>
                            <td> $linhaEstabServDesHabilitado[8]  
                    </td>
                            <td> $linhaEstabServDesHabilitado[9]
                    </td>

                            <td> $linhaEstabServDesHabilitado[10]
                    </td>
                </tr>";
    }
    ?>
                        </tbody>
                    </table>
                </div><!-- /box -->

            </div><!-- /tab -->
            </div><!-- /tab -->
<?php } ?>