<?php 

include("../../cabecalho_menu.php"); 
include("../../classes/ClassificacaoEstabelecimento.php");
$classificacaoEstabelecimento = new ClassificacaoEstabelecimento();
if ($_POST['cod_classificacao_estabelecimento'] != ''){



	if (!$classificacaoEstabelecimento->carregar($_POST['cod_classificacao_estabelecimento'])){
		alert('Erro ao carregar a classificação do estabelecimento!');
		voltar();
		exit();
	}

}

?>

<script language="javascript">

</script>
 <div class="panel-body">

	<div class="container">
        <header class="header-page">
            <h3 class="header-page__title">DETALHE DA CLASSIFICAÇÃO DO ESTABELECIMENTO </h3><P>
        </header>
        <div class="clearfix"></div>
	   

<table id="table">
			
    <tr>
			<td width="10%"><H6>Descrição:</H6></td>
			<td width="10%"><H6><?php echo $classificacaoEstabelecimento->classificacaoEstabelecimento; ?></H6></td>
    </tr>

</table>   
       






		<div class="form-group">
		<center>
		<button class="btn btn-default" onclick="location.href='listar_classificacao_estabelecimento.php?output=html'"><i class="fa fa-eraser" style="font-size:24px;color:red"></i> Voltar</button>  
		</div>
	
    </div><!-- /container -->
</div>
	
  
</body>
</html>
<?php include("../../rodape.php"); ?>