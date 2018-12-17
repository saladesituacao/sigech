
<?php 

include("../../cabecalho_menu.php"); 
include("../../classes/LocalVistoria.php");
$localvistoria = new LocalVistoria();
if ($_POST['cod_local_vistoria'] != ''){



	if (!$localvistoria->carregar($_POST['cod_local_vistoria'])){
		alert('Erro ao carregar local de vistoria!');
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
            <h3 class="header-page__title">DETALHE DO LOCAL DE VISTORIA </h3><P>
        </header>
        <div class="clearfix"></div>
	   

<table id="table">
			
    <tr>
			<td width="10%"><H6>Nome do Local de VistoriaCompleto:</H6></td>
			<td width="10%"><H6><?php echo $localvistoria->localvistoria; ?></H6></td>
    </tr>

</table>   
       






		<div class="form-group">
		<center>
		<button class="btn btn-default" onclick="location.href='listar_local_vistoria.php?output=html'"><i class="fa fa-eraser" style="font-size:24px;color:red"></i> Voltar</button>  
		</div>
	
    </div><!-- /container -->
</div>
	
    <footer class="footer">
        <p>Todos os direitos reservados (c) <?php echo(date('Y')); ?></p>
    </footer>

</body>
</html>
<?php include("../../rodape.php"); ?>