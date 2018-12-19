<?php 
include("../../cabecalho_menu.php"); 
include("../../classes/Contratada.php");




$contratada = new Contratada();
 


 
$acao = 'A';
if ($_POST['cod_servico_contratada'] != ''){

	

	if (!$contratada->carregar($_POST['cod_servico_contratada'] )){
		alert('Erro ao carregar serviço da contratada!');
		voltar();
		exit();
	}

}else{

	alert('Erro ao carregar dados do serviço da contratada!');
	voltar();
	exit();
}


?>
 
<script language="javascript">
 
function validar(){


	if (frmCadastro.txt_objeto_contratacao.value == ''){
		alert('Informe o objeto!');
		frmCadastro.txt_objeto_contratacao.focus();
		return false;
	}
	
	
	if (frmCadastro.nr_contrato.value == ''){
		alert('Informe o número do contrato!');
		frmCadastro.nr_contrato.focus();
		return false;
	}


	if (frmCadastro.dt_vigencia.value == ''){
		alert('Informe a data da vigência!');
		frmCadastro.dt_vigencia.focus();
		return false;
	}

	if (frmCadastro.nr_processo.value == ''){
			alert('Informe o número do processo!');
			frmCadastro.nr_processo.focus();
			return false;
		}


		return true;
	}


</script>
 <div class="panel-body">
<form name="frmCadastro" class="form-horizontal" action="servico_contratada_manter.php" method=post onSubmit="return validar()">
<input type="hidden" name="acao" value="A">
<input type="hidden" name="cod_servico_contratada" value=" <?php echo $contratada->id; ?>">
<input type="hidden" name="cod_estabelecimento" value=" <?php echo $contratada->idEstabelecimento; ?>">

	<div class="container">
        <header class="header-page">
            <h3 class="header-page__title">ALTERAR SERVIÇO CONTRATADO </h3><P>
        </header>
        <div class="clearfix"></div>
	   
		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Estabelecimento:</label>
                   <div class="col-sm-6">
				   <?php echo $contratada->nmEstabelecimento; ?>
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Objeto:</label>
                   <div class="col-sm-6">
				   <textarea rows="3" name="txt_objeto_contratacao" value= "<?php echo $contratada->txtObjetoContratacao; ?>" placeholder="Digite o objeto do contrato" style="width:99%"><?php echo $contratada->txtObjetoContratacao; ?></textarea>
                    </div>
		</div>
		
		
		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Número do Contrato:</label>
                   <div class="col-sm-6">
						<input type="text" maxlength="100" size="20" class=" "   placeholder="Digite o número do contrato" name="nr_contrato" value="<?php echo $contratada->nrContrato; ?>"/>
							<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Data de vigência:</label>
                   <div class="col-sm-6">
						<input type="text" size="14" maxLength="10" onKeyPress="mask(this,'00/00/0000',1, event)" onBlur="isDate(this);" name="dt_vigencia" id="dt_vigencia" value="<?php echo formatarDataBrasil($contratada->dtVigencia); ?>"/>
						<img src="../../assets/img/calendario.gif" id="btnDtVigencia" style="cursor:hand" width="24" height="12" alt="Calendário">(dd/mm/aaaa)
						<script type="text/javascript">
							Calendar.setup({
								inputField: 'dt_vigencia',
								button: "btnDtVigencia",
								align: "Tr"
							});
						</script>	
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Número do processo:</label>
                   <div class="col-sm-6">
				   <input type="text" maxlength="100" size="20" class=" "   placeholder="Digite o valor" name="nr_processo" value="<?php echo $contratada->nrProcesso; ?>"/>
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