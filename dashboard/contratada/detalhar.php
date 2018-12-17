
<?php include("../../cabecalho_menu.php"); 

// Retornar nome do estabelecimento
//error_reporting(0);
include("../dados/contratada.php"); 
include("../../classes/Perfil.php");
include ("../../assets/lib/brTable.php");
$perfil = new Perfil();

Auditoria(59,'Detalhar contratada', $sqlEstab);	 
?>



<form name="frmContratada" action="" method="post">
		    <input type='hidden' name='acao' value=''>
            <input type='hidden' name='cod_servico_contratada' value=''>
            <input type='hidden' name='cod_estabelecimento' value=''>


</form>

 
    <div class="container">
        <header class="header-page">
            <h3 class="header-page__title">ESTABELECIMENTO </h3><P>

            <p><strong  class="txt-error" style="font-size:180%;"><?PHP echo ($estabelecimento); ?></strong></p>
        </header>
        <div class="clearfix"></div>
       
<!-- DETALHE DO ESTABELECIMENTO -->

        <ul class="nav nav-pills nav-justified space-mb-md" role="tablist">
<?php if (permissao_acesso(313)) { ?>
            <li class="active"><a href="#sh" data-toggle="tab">Contratado</a></li>
<?php } ?>

        </ul>

<?php 

if (permissao_acesso(313)) { 
include("contratada.php"); 
}

?>

</div><!-- /container -->
<script>

function adicionar(cod){

frmContratada.cod_estabelecimento.value =  cod;
frmContratada.acao.value =  'I';
document.getElementsByName('frmContratada')[0].action = 'servico_contratada_add.php';
document.getElementsByName('frmContratada')[0].submit();
}




function editar(cod, codEstabelecimento){

frmContratada.cod_servico_contratada.value =  cod;
frmContratada.cod_estabelecimento.value =  codEstabelecimento;
frmContratada.acao.value =  'I';
document.getElementsByName('frmContratada')[0].action = 'servico_contratada.php';
document.getElementsByName('frmContratada')[0].submit();
}


function desativar(cod, codEstabelecimento){

frmContratada.cod_servico_contratada.value =  cod;
frmContratada.cod_estabelecimento.value =  codEstabelecimento;
frmContratada.acao.value =  'D';
document.getElementsByName('frmContratada')[0].action = 'servico_contratada_manter.php';
document.getElementsByName('frmContratada')[0].submit();
}



</script>

<?php include("../../rodape.php"); ?>