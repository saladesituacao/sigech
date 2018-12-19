<div class="panel-group" id="accordion">
<div class="panel panel-default">
      <div class="panel-heading" role="tab" id="headingOne">
    <h4 class="box__title">
      <a data-toggle="collapse" data-parent="#accordion" href="#unidSaude" aria-expanded="true" aria-controls="collapseOne">
          &nbsp;MÉDIA COMPLEXIDADE&nbsp;&nbsp;
      </a>
    </h4>
  </div>

  <div id="unidSaude" class="panel-collapse in" aria-labelledby="headingOne">
  <div class="row">
  
  
              <?php 
                  // executa a escrita dos valores referentes aos hospitais
                  while ($linhaUnidSaude = pg_fetch_row($rsUnidSaude)){
  
                          echo "<div class='col-md-4 col-sm-6'>";
  
                          echo "<a class='box-link' href='#'>";
  
                          echo "<div class='box box--default'>" ;
  
                          echo "<center><span class='fa fa-hospital-o' style='font-size:36px;'></span></center> <p>";
                          
                          echo "<h2 class='box__title' align='center'>$linhaUnidSaude[1]</h2>";    
  
                          echo "</div><!-- /box -->";
                          echo "</a>";
                          echo "</div><!-- /col -->";
                 }
            ?>     
          </div><!-- /row -->
</div>
</div>
</div>

