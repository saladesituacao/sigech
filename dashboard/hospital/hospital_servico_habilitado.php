<?php 
include("../../cabecalho_menu.php"); 
include("../../classes/HospitalHabilitado.php");
include("../../options/optServico.php");



$hospital = new HospitalHabilitado();


 

$acao = 'ASH';
if ($_POST['cod_servico_habilitado_estabelecimento'] != ''){

	

	if (!$hospital->carregar2($_POST['cod_servico_habilitado_estabelecimento'],$_POST['cod_estabelecimento'] )){
		alert('Erro ao carregar serviço habilitado!');
		voltar();
		exit();
	}

}else{

	alert('Erro ao carregar dados do serviço habilitado!');
	voltar();
	exit();
}

?>

<script language="javascript">

function validar(){

	
	if (frmCadastro.vl_valor.value == ''){
		alert('Informe o valor!');
		frmCadastro.vl_valor.focus();
		return false;
	}
	
	
	if (frmCadastro.ds_portaria.value == ''){
		alert('Informe a portaria!');
		frmCadastro.ds_portaria.focus();
		return false;
	}


	if (frmCadastro.nr_leitos.value == ''){
		alert('Informe o número de leitos!');
		frmCadastro.nr_leitos.focus();
		return false;
	}

	if (frmCadastro.txt_url_portaria.value == ''){
		alert('Informe a URL da portaria!');
		frmCadastro.txt_url_portaria.focus();
		return false;
	}

	
	return true;
}
</script>
 <div class="panel-body">
<form name="frmCadastro" class="form-horizontal" action="hospital_habilitado_manter.php" method=post onSubmit="return validar()">
<input type="hidden" name="acao" value="<?php echo $acao; ?>">
<input type="hidden" name="cod_servico_habilitado_estabelecimento" value="<?php echo $hospital->id; ?>">
<input type="hidden" name="cod_estabelecimento" value="<?php echo $hospital->idEstabelecimento; ?>">
	<div class="container">
        <header class="header-page">
            <h3 class="header-page__title">ALTERAÇÃO DO SERVIÇO HABILITADO </h3><P>
        </header>
        <div class="clearfix"></div>
	   
		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Estabelecimento:</label>
                   <div class="col-sm-6">
				   <?php echo $hospital->nmEstabelecimento; ?>
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Serviço habilitado:</label>
                   <div class="col-sm-6">
				   <?php echo $hospital->areaHabilitado . $hospital->nrServico . " - " . $hospital->nmServico; ?>
                    </div>
		</div>

<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Modificar serviço:</label>
                   <div class="col-sm-6">
				   <select id="cod_servico" name="cod_servico" ">
				   <option value="0">Selecione</option>
						<?php optServico($hospital->areaHabilitado)?>
                                 </select>
								 
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Valor:</label>
                   <div class="col-sm-6">
				   <input type="text" maxlength="50" size="20" class=" "   placeholder="Digite o valor" name="vl_valor" value="<?php echo $hospital->valor; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
				   
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Portaria:</label>
                   <div class="col-sm-6">
				   <input type="text" maxlength="50" size="50" class=" "   placeholder="Digite a portaria " name="ds_portaria" value="<?php echo $hospital->dsPortaria; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Número de leitos:</label>
                   <div class="col-sm-6">
				   <input type="text" maxlength="50" size="20" class=" "   placeholder="Digite o valor" name="nr_leitos" value="<?php echo $hospital->nrLeitos; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
				   
                    </div>
		</div>
		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Observação:</label>
                   <div class="col-sm-6">
				   <textarea rows="3" name="ds_observacao" style="width:99%" ><?php echo $hospital->dsObservacao; ?></textarea>
                    </div>
		</div>
		
		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">URL Portaria:</label>
                   <div class="col-sm-6">
			      	<input type="text" maxlength="200" size="80" class=" "   placeholder="Digite a URL" name="txt_url_portaria" value="<?php echo $hospital->urlPortaria; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>

		
		<div class="form-group">
		<center>
		<button class="btn btn-default"><i class="fa fa-keyboard-o" style="font-size:24px;color:blue"></i> Salvar</button>  
		<button class="btn btn-default" onclick="history.go(-1)"><i class="fa fa-eraser" style="font-size:24px;color:red"></i> Voltar</button>  
		</div>
	</form>
    </div><!-- /container -->
</div>


</body>
</html>
<?php include("../../rodape.php"); ?>