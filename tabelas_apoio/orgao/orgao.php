
<?php 

include("../../cabecalho_menu.php"); 
include("../../classes/Orgao.php");


$acao = 'I';
$orgao = new Orgao();

if ($_POST['cod_orgao'] != ''){

	$acao = 'A';

	if (!$orgao->carregar($_POST['cod_orgao'])){
		alert('Erro ao carregar área!');
		voltar();
		exit();
	}

}

?>

<script language="javascript">

function validar(){

	if (frmCadastro.txt_sigla.value == ''){
		alert('Informe a sigla!');
		frmCadastro.txt_sigla.focus();
		return false;
	}

	

		
	return true;
}
</script>
 <div class="panel-body">
<form name="frmCadastro" class="form-horizontal" action="orgao_manter.php" method=post onSubmit="return validar()">
<input type="hidden" name="acao" value="<?php echo $acao; ?>">
<input type="hidden" name="cod_orgao" value="<?php echo $orgao->id; ?>">
	<div class="container">
        <header class="header-page">
            <h3 class="header-page__title">CADASTRO DE ÁREAS </h3><P>
        </header>
        <div class="clearfix"></div>
	   
	    <div class="row">
            <div class="form-group col-md-12">
                <label for="exampleInputEmail1">Sigla:</label>
                <input type="text" class="form-control" id="txt_sigla" name="txt_sigla" value="<?=$orgao->sigla?>" placeholder="Obrigatório">
            </div><!--form-group-->
        </div><!--row-->   
        <div class="row">
            <div class="form-group col-md-12">
                <label for="exampleInputEmail1">Descrição:</label>			
                <textarea class="form-control" rows="5" id="txt_descricao" name="txt_descricao"><?=$orgao->descricao?></textarea>
            </div><!--form-group-->	 
        </div><!--row--> 
        <div class="row">
            <div class="form-group col-md-12">
                <label for="exampleInputEmail1">Área Superior:</label>			
                <select id="cod_orgao_superior" name="cod_orgao_superior" class="chosen-select" data-placeholder="Área Superior">
                    <option></option>
                    <?php                        
                        $q = pg_query("SELECT cod_orgao, txt_sigla FROM sigech.tb_orgao WHERE cod_ativo = 1 ORDER BY txt_sigla");
                        while ($row = pg_fetch_array($q)) 
                        { ?>
                            <option value="<?=$row["cod_orgao"]?>"<?php if ($orgao->codOrgaoSuperior == $row["cod_orgao"]) { echo("selected");}?>><?=$row["txt_sigla"] ?></option>
                        <?php	
                        } ?>		                   
                </select>
            </div><!--form-group-->	 
        </div><!--row-->   
                  	
        

		<div class="form-group">
		<center>
		<?php if (permissao_acesso(293)) {?>
        <button class="btn btn-default" onClick="voltar();"><i class="fa fa-keyboard-o" style="font-size:24px;color:blue"></i> Salvar</button>  
        <?php }?>
		<button class="btn btn-default" onclick="history.go(-1)"><i class="fa fa-eraser" style="font-size:24px;color:red"></i> Voltar</button>  
		</div>
	</form>
    </div><!-- /container -->
</div>
	
  
</body>
</html>
<?php include("../../rodape.php"); ?>