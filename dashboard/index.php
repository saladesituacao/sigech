<?php 
include("../cabecalho_menu.php"); 

include("dados/estabelecimento.php"); 
 
?>
1
  <?php 
 //PERFIL DE ADMINISTRADOR
 //Modulo de lembretes (post-It)
if ($acesso->usuario->perfil == 1) {
    include_once("../lembrete.php");
}  
?>

    <div class="container">
        <header class="header-page">
            <center>
            <label for="field_titulo" class="label-control">SECRETARIA DE ESTADO DE SAÚDE</label>
                            <br>
            <h1 class="header-page__title">PAINEL DE MONITORAMENTO DAS HABILITAÇÕES DOS SERVIÇOS DE SAÚDE</h1>
        </header>
        <hr>
        
      

                    <!--acesso ao monitoramento dos hospitais -->
                    <?php if (permissao_acesso(16)){ ?>
                    <!-- HOSPITAIS -->
                    <?php 
                    include("hospital/index.php"); 
                    ?>
                    <?php } ?>
                    <!-- UNIDADE DE SAÚDE -->

                    <?php 
                    //include("unidade_saude/index.php"); 
                    ?>


                    <!--acesso ao monitoramento das contratadas -->
                    <?php if (permissao_acesso(312)){ ?>
                    <!-- CONTRATADAS -->
                    <?php 
                    include("contratada/index.php"); 
                    ?>
                    <?php } ?>

    </div><!-- /container -->

</body>
</html>
<?php include("../rodape.php"); ?>