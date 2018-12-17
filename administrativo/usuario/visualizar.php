
<?php 

include("../../cabecalho_menu.php"); 
include("../../classes/Usuario.php");
$usuario = new Usuario();
if ($_POST['cod_usuario'] != ''){



	if (!$usuario->carregar($_POST['cod_usuario'])){
		alert('Erro ao carregar usu�rio!');
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
            <h3 class="header-page__title">DETALHE DO USUÁRIOS </h3><P>
        </header>
        <div class="clearfix"></div>
	   

<table id="table">
			
    <tr>
			<td width="10%"><H6>Nome Completo:</H6></td>
			<td width="10%"><H6><?php echo $usuario->nome; ?></H6></td>
    </tr>

	    <tr>
			<td width="10%"><H6>Login:</H6></td>
			<td width="10%"><H6><?php echo $usuario->login; ?></H6></td>
    </tr>

	    <tr>
			<td width="10%"><H6>E-mail:</H6></td>
			<td width="10%"><H6><?php echo $usuario->email; ?></H6></td>
    </tr>

	 <tr>
			<td width="10%"><H6>Telefone:</H6></td>
			<td width="10%"><H6><?php echo mask($usuario->telefone,'(##)####-####'); ?></H6></td>
    </tr>

	 <tr>
			<td width="10%"><H6>Matricula:</H6></td>
			<td width="10%"><H6><?php echo $usuario->matricula; ?></H6></td>
    </tr>

</table>   
       






		<div class="form-group">
		<center>
		<button class="btn btn-default" onclick="location.href='listar_usuario.php?output=html'"><i class="fa fa-eraser" style="font-size:24px;color:red"></i> Voltar</button>  
		</div>
	
    </div><!-- /container -->
</div>
	
  
</body>
</html>
<?php include("../../rodape.php"); ?>