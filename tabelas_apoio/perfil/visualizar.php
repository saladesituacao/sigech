<?php 

include("../../cabecalho_menu.php"); 
include("../../classes/Perfil.php");
$perfil = new Perfil();
if ($_POST['cod_perfil'] != ''){



	if (!$perfil->carregar($_POST['cod_perfil'])){
		alert('Erro ao carregar perfil!');
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
            <h3 class="header-page__title">DETALHE DO PERFIL </h3><P>
        </header>
        <div class="clearfix"></div>
	   

<table id="table">
			
    <tr>
			<td width="10%"><H6>Nome do Perfil:</H6></td>
			<td width="10%"><H6><?php echo $perfil->perfil; ?></H6></td>
    </tr>

	    <tr>
			<td width="10%"><H6>Descrição:</H6></td>
			<td width="10%"><H6><?php echo $perfil->descricao; ?></H6></td>
    </tr>

</table>   
       






		<div class="form-group">
		<center>
		<button class="btn btn-default" onclick="location.href='listar_perfil.php?output=html'"><i class="fa fa-eraser" style="font-size:24px;color:red"></i> Voltar</button>  
		</div>
	
    </div><!-- /container -->
</div>
	
  
</body>
</html>
<?php include("../../rodape.php"); ?>