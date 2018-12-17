
<?php 

include("../../cabecalho_menu.php"); 
include("../../classes/Cargo.php");
$cargo = new Cargo();
if ($_POST['cod_cargo'] != ''){



	if (!$cargo->carregar($_POST['cod_cargo'])){
		alert('Erro ao carregar cargo!');
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
            <h3 class="header-page__title">DETALHE DO CARGO </h3><P>
        </header>
        <div class="clearfix"></div>
	   

<table id="table">
			
    <tr>
			<td width="10%"><H6>Nome do Cargo:</H6></td>
			<td width="10%"><H6><?php echo $cargo->cargo; ?></H6></td>
    </tr>

	    <tr>
			<td width="10%"><H6>Descrição:</H6></td>
			<td width="10%"><H6><?php echo $cargo->descricao; ?></H6></td>
    </tr>

</table>   
       






		<div class="form-group">
		<center>
		<button class="btn btn-default" onclick="location.href='listar_cargo.php?output=html'"><i class="fa fa-eraser" style="font-size:24px;color:red"></i> Voltar</button>  
		</div>
	
    </div><!-- /container -->
</div>
	
  
</body>
</html>
<?php include("../../rodape.php"); ?>