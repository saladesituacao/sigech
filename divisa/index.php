<?php 

include("../cabecalho_menu.php"); 

include("../dashboard/dados/estabelecimento.php"); 
 
?>

    <div class="container">
        <header class="header-page">
            <center>
            <label for="field_titulo" class="label-control">SECRETARIA DE ESTADO DE SAÚDE</label>
                            <br>
            <h1 class="header-page__title">PAINEL DE MONITORAMENTO DAS NÃO CONFORMIDADES HOSPITALARES</h1>
        </header>
        <hr>
        
 

 <!--acesso ao monitoramento das não conformidades -->
 <?php if (permissao_acesso(16)){ ?>
<!-- NÃO CONFORMIDADES -->
<?php 
include("nao_conformidade/index.php"); 
?>
<?php } ?>

 </div><!-- /container -->

   
</body>
</html>
<?php include("../rodape.php"); ?>