
<?php 

include("../../cabecalho_menu.php"); 
include("../../options/optLocalVistoria.php");
include("../../classes/PlanoCredenciamentoHabilitacao.php");
// Retornar nome do estabelecimento
//error_reporting(0);
include("../../dashboard/dados/hospital.php");

//Como para local de vistoria

$sql_localvistoria="SELECT cod_local_vistoria, txt_local_vistoria FROM sigech.tb_local_vistoria WHERE ind_habilitado = 'S' ORDER BY txt_local_vistoria ASC ";
 	 $q_localvistoria=pg_query($sql_localvistoria) or die ('<META HTTP-EQUIV="Refresh" CONTENT="0;URL=./error.php">');

$acao = 'I';
$planocredenciamentohabilitacao = new PlanoCredenciamentoHabilitacao();


if ($_POST['cod_pch_estabelecimento'] != ''){
	$acao = 'A';
	
	if (!$planocredenciamentohabilitacao->carregar($_POST['cod_pch_estabelecimento'])){
		alert('Erro ao carregar Plano de Credenciamento e Habilitação!');
		voltar();
		exit();
	}

}



?>

<script language="javascript">

function validar(){

	
	if (frmCadastro.cod_local_vistoria.value == ''){
		alert('Informe local da vistoria!');
		frmCadastro.cod_local_vistoria.focus();
		return false;
	}
	
	
	if (frmCadastro.dt_cadastro.value == ''){
		alert('Informe a data de cadastro!');
		frmCadastro.dt_cadastro.focus();
		return false;
	}


	if (frmCadastro.nr_item.value == ''){
		alert('Informe o número do item!');
		frmCadastro.nr_item.focus();
		return false;
	}

	if (frmCadastro.txt_nao_conformidade.value == ''){
		alert('Informe a não conformidade!');
		frmCadastro.txt_nao_conformidade.focus();
		return false;
	}


	if (frmCadastro.txt_determinacao.value == ''){
		alert('Informe a determinação!');
		frmCadastro.txt_determinacao.focus();
		return false;
	}



	if (frmCadastro.nr_dias_prazo_determinacao.value == ''){
		alert('Informe o número de dias determinado!');
		frmCadastro.nr_dias_prazo_determinacao.focus();
		return false;
	}
	

	if (frmCadastro.txt_responsavel.value == ''){
		alert('Informe o responsável!');
		frmCadastro.txt_responsavel.focus();
		return false;
	}



	if (frmCadastro.nr_dias_prazo_responsavel.value == ''){
		alert('Informe o número de dias para o responsável!');
		frmCadastro.nr_dias_prazo_responsavel.focus();
		return false;
	}

	


	
	return true;
}
</script>
 <div class="panel-body">
<form name="frmCadastro" class="form-horizontal" action="plano_credenciamento_habilitacao_manter.php" method=post onSubmit="return validar()">
<input type="hidden" name="acao" value="<?php echo $acao; ?>">
<input type="hidden" name="cod_pch_estabelecimento" value="<?php echo $planocredenciamentohabilitacao->id; ?>">
<input type="hidden" name="cod_estabelecimento" value="<?php echo $cod; ?>">


	<div class="container">
	<header class="header-page">
            <h3 class="header-page__title">ESTABELECIMENTO </h3><P>

            <p><strong  class="txt-error" style="font-size:180%;"><?PHP echo ($estabelecimento); ?></strong></p>
        </header>
        <div class="clearfix"></div>
	   
		
		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Local da Vistoria:</label>
                   <div class="col-sm-6">
				   
				   <select name="cod_local_vistoria">
					<option>
					<?php optLocalVistoria($planocredenciamentohabilitacao->idLocalVistoria)?>
				</select>

		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
				   
                    </div>
		</div>


		
 

		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Número do Item:</label>
                   <div class="col-sm-6">
				   <input type="text" maxlength="3" size="3" class=" "   placeholder="Digite a quantidade de dias " name="nr_item" value="<?php echo $planocredenciamentohabilitacao->nrItem; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Não Conformidade:</label>
                   <div class="col-sm-6">
				   <textarea rows="3" name="txt_nao_conformidade" style="width:99%"><?php echo $planocredenciamentohabilitacao->txtNaoConformidade; ?></textarea>
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Determinação:</label>
                   <div class="col-sm-6">
				   <textarea rows="3" name="txt_determinacao" style="width:99%"><?php echo $planocredenciamentohabilitacao->txtDeterminacao; ?></textarea>
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Número de dias:</label>
                   <div class="col-sm-6">
				   <input type="text" maxlength="50" size="20" class=" "   placeholder="Digite o valor" name="nr_dias_prazo_determinacao" value="<?php echo $planocredenciamentohabilitacao->nrDiasPrazoDeterminacao; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
				   
                    </div>
		</div>
	
		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Responsável:</label>
                   <div class="col-sm-6">
				   <input type="text" maxlength="300" size="80" class=" "   placeholder="Digite o nome do responsável" name="txt_responsavel" value="<?php echo $planocredenciamentohabilitacao->txtResponsavel; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
				   
                    </div>
		</div>

 
		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Número de Dias:</label>
                   <div class="col-sm-6">
				   <input type="text" maxlength="3" size="3" class=" "   placeholder="Digite a quantidade de dias " name="nr_dias_prazo_responsavel" value="<?php echo $planocredenciamentohabilitacao->nrDiasResponsavel; ?>"/>
		          	<i class="fa fa-question-circle" style="color:red" title="Campo obrigatório"></i>
                    </div>
		</div>


		<div class="form-group">
			      <label class="control-label col-sm-2" for="nome">Observação:</label>
                   <div class="col-sm-6">
				   <textarea rows="3" name="txt_observacao" style="width:99%"><?php echo $planocredenciamentohabilitacao->txtObservacao; ?></textarea>
                    </div>
		</div>


		<div class="form-group">
			<label class="control-label col-sm-2" for="nome">Data de Cadastro:</label>
					<div class="col-sm-6">
					<input type="text" size="14" maxLength="10" onKeyPress="mask(this,'00/00/0000',1, event)" onBlur="isDate(this);" name="dt_cadastro" id="dt_cadastro" value="<?php echo formatarDataBrasil($planocredenciamentohabilitacao->dtCadastro); ?>"/>
					<img src="../../assets/img/calendario.gif" id="btndt_cadastro" style="cursor:hand" width="24" height="12" alt="Calendário">(dd/mm/aaaa)
					<script type="text/javascript">
						Calendar.setup({
							inputField: 'dt_cadastro',
							button: "btndt_cadastro",
							align: "Tr"
						});
					</script>	



						</div>
		</div>
		
		<div class="form-group">
		<center>
		<?php if (permissao_acesso(52))
                {?>
		<button class="btn btn-default"><i class="fa fa-keyboard-o" style="font-size:24px;color:blue"></i> Salvar</button>  
		<?php } ?>
		<button class="btn btn-default" onclick="history.go(-1)"><i class="fa fa-eraser" style="font-size:24px;color:red"></i> Voltar</button>  
		</div>
	</form>
    </div><!-- /container -->
</div>
	
   

</body>
</html>
<?php include("../../rodape.php"); ?>