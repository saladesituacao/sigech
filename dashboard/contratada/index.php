<div class="panel-group" id="accordionc">
<div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOnec">
    <h4 class="box__title">
      <a data-toggle="collapse" data-parent="#accordionc" href="#contratada" aria-expanded="true" aria-controls="collapseOne">
          &nbsp;CONTRATADAS&nbsp;&nbsp;
      </a>
    </h4>
  </div>

  <div id="contratada" class="panel-collapse in" aria-labelledby="headingOnec">
  <div class="row">
  
   
              <?php 
                  // executa a escrita dos valores referentes as contratadas
                  while ($linhaContratada = pg_fetch_row($rsContratada)){

                //Verificar se existem contrato vencido
                      $sqlServicoContratada = "
                      
                      SELECT COUNT(cod_servico_contratada)
                      FROM sigech.tb_servico_contratada
                      WHERE TO_CHAR(dt_vigencia, 'DD/MM/YYYY') < TO_CHAR(CURRENT_DATE, 'DD/MM/AAAA')
                      AND cod_estabelecimento =  " . $linhaContratada[0];

  

                        $rsServicoContratada = $acesso->getRs($sqlServicoContratada);
                        $linhaServicoContratada = pg_fetch_row($rsServicoContratada);

                        if ($linhaServicoContratada[0] == "0"){
                          $corC = "blue";
                          }else{
                              $corC = "red";
                              $qtdC = $linhaServicoContratada[0] . " - Contrato vencido";
                        }

  
                          echo "<div class='col-md-4 col-sm-6'>";
  
                          echo "<a class='box-link' href='contratada/detalhar.php?cod=$linhaContratada[0]' title='$qtdC'>";
  
                          echo "<div class='box box--default'>" ;
  
                          echo "<center><span class='fa fa-hospital-o' style='font-size:36px;color:$corC'></span></center> <p>";
                          
                          echo "<h2 class='box__title' align='center'>$linhaContratada[1]</h2>";    
  
                          echo "</div><!-- /box -->";
                          echo "</a>";
                          echo "</div><!-- /col -->";
  
                 }
            ?>     
          </div><!-- /row -->



</div>
</div>
</div>
