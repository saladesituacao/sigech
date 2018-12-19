 <div class="panel-group" id="accordion">
  <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="box__title">
        <a data-toggle="collapse" data-parent="#accordion" href="#hospitais" aria-expanded="true" aria-controls="collapseOne">
            &nbsp;Hospitais&nbsp;&nbsp;
        </a>
      </h4>
    </div>

    <div id="hospitais" class="panel-collapse in" aria-labelledby="headingOne">
        <div class="row">

 
            <?php 
                // executa a escrita dos valores referentes aos hospitais
                while ($linhaHospital = pg_fetch_row($rsHospital)){


                     //Verificar se existem itens de planos de ações finalizados pela unidade para ser validado pela DIVISA

                     $sqlplano = "SELECT
                     COUNT (cod_pch_estabelecimento)
                 FROM
                     sigech.tb_pch_estabelecimento
                 WHERE dt_cumprimento IS NOT NULL
                 AND ind_habilitado = 'S' 
                 AND cod_estabelecimento = " . $linhaHospital[0];

                 $rsplano = $acesso->getRs($sqlplano);
                 $linhaplano = pg_fetch_row($rsplano);

                 if ($linhaplano[0] == "0"){
                     $cor = "blue";
                 }else{
                     $cor = "red";
                     $qtd = $linhaplano[0] . " - Não conformidades aguardando análise";
                 }
                     
                    

                        echo "<div class='col-md-4 col-sm-6'>";

                        echo "<a class='box-link' href='nao_conformidade/detalhar.php?cod=$linhaHospital[0]' title='$qtd'>";

                        echo "<div class='box box--default'>" ;

                        echo "<center><span class='fa fa-hospital-o' style='font-size:36px;color:$cor''></span></center> <p>";
                        
                        echo "<h2 class='box__title' align='center'>$linhaHospital[1]</h2>";    

                        echo "</div><!-- /box -->";
                        echo "</a>";
                        echo "</div><!-- /col -->";

               }
          ?>     
        </div><!-- /row -->
      </div>
  </div>
</div>