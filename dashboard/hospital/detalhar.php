<?php include("../../cabecalho_menu.php"); 

// Retornar nome do estabelecimento
//error_reporting(0);
include("../dados/hospital.php"); 
include("../../classes/Perfil.php");
include ("../../assets/lib/brTable.php");
$perfil = new Perfil();

Auditoria(22,'Detalhamento hospitalar', $sqlEstab);	 

?>
<form name="frmHospital" action="" method="post">
		    <input type='hidden' name='acao' value=''>
            <input type='hidden' name='cod_servico_habilitado_estabelecimento' value=''>
            <input type='hidden' name='cod_servico_potencial_habilitacao_estabelecimento' value=''>
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
<?php if (permissao_acesso(17)) { ?>
            <li class="active"><a href="#sh" data-toggle="tab">Habilitados</a></li>
<?php } ?>

<?php if (permissao_acesso(18)) { ?>
            <li><a href="#sph" data-toggle="tab">Potencial de Habilitação</a></li>
<?php } ?>

<?php if (permissao_acesso(19)) { ?>
            <li><a href="#sd" data-toggle="tab">Desabilitados</a></li>
<?php } ?>

<?php if (permissao_acesso(20)) { ?>
            <li><a href="#pa" data-toggle="tab">Plano de Ação</a></li>
<?php } ?>
        </ul>

 
<?php 

if (permissao_acesso(17)) { 
include("habilitado.php"); 
}

if (permissao_acesso(18)) { 
include("potencial_habilitacao.php"); 
}
if (permissao_acesso(19)) { 
include("desabilitado.php"); 
}
if (permissao_acesso(20)) { 
include("plano_acao.php"); 
}

?>

</div><!-- /container -->





<!-- JUSTIFICATIVA PARA DESABILITAR O SERVIÇO-->

 <div class="row" style="margin-left: 0px; margin-right: 0px;">
			<div class="modal fade" id="modalDesabilitar">
			
            <form name="frmCadastro" action="" method="post">
		    <input type='hidden' name='acao' value=''>
		    <input type='hidden' name='cod_servico_habilitado_estabelecimento' value=''>
            <input type='hidden' name='cod_estabelecimento' value=''>
            
            
            
            	<div class="modal-dialog" style="width: 500px">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">Desabilitar Serviço</h4>
						</div>
                        
                        
                        <div class="modal-body">
              <div class="row">
                  <div class="col-xs-12">
                      <div class="well">
                          <div class="form-group">
								<label for="justificativa">Justificativa</label> <span id="JustificativaAviso" class=""></span>
								<input class="form-control" id="ds_justificativa" name="ds_justificativa" placeholder="Digite a justificativa" type="text">
							</div>
							
							<div class="row">
								<span id="modalJustificativaError" class=""></span>
							</div>
                            <a class="btn btn-primary" onclick="desabilitarServico();">Salvar</a> <a href="#" data-dismiss="modal" class="btn">Fechar</a>
                      </div>
                  </div>
                  <div class="col-xs-12">
                      <p><b>Nota</b></p>
                      <p class="text-justify">O serviço será desabilitado.</p>
                      <p class="text-justify">Uma vez desabilitado, as informações serão registradas na base de dados.</p>
                  </div>
              </div>
          </div>
                        
                  
                          
						</div>
						
					</div>
</form>
				</div>
            </div>





<!-- EXCLUIR POTENCIAL DE HABILITAÇÃO-->

<div class="row" style="margin-left: 0px; margin-right: 0px;">
			<div class="modal fade" id="modalExcluirPotencial">
			
            <form name="frmExcluirPotencial" action="" method="post">
		    <input type='hidden' name='acao' value=''>
		    <input type='hidden' name='cod_servico_potencial_habilitacao_estabelecimento' value=''>
            <input type='hidden' name='cod_estabelecimento' value=''>
            
            
            
            	<div class="modal-dialog" style="width: 500px">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">Excluir Serviço</h4>
						</div>
                        
                        
                        <div class="modal-body">
              <div class="row">
                  <div class="col-xs-12">
                      <div class="well">
							
							<div class="row">
								<span id="modalJustificativaError" class=""></span>
							</div>
                            <a class="btn btn-primary" onclick="excluirServicoPH();">Sim</a> <a href="#" data-dismiss="modal" class="btn">Não</a>
                      </div>
                  </div>
                  <div class="col-xs-12">
                      <p><b>Nota</b></p>
                      <p class="text-justify">O serviço será excluído.</p>
                      <p class="text-justify">Uma vez excluído, as informações não poderão ser recuperadas.</p>
                  </div>
              </div>
          </div>
                        
                  
                          
						</div>
						
					</div>
</form>
				</div>
            </div>








<!-- EDITAR NÃO CONFORMIDADES / PRAZO E RESPONSÁVEL-->

 <div class="row" style="margin-left: 0px; margin-right: 0px;">
			<div class="modal fade" id="modalEditarPCH">
			
            <form name="frmEPCH" action="" method="post">
		    <input type='hidden' name='acao' value=''>
		    <input type='hidden' name='cod_servico_habilitado_estabelecimento' value=''>
            <input type='hidden' name='cod_estabelecimento' value=''>
            <input type='hidden' name='cod_pch_estabelecimento' value=''>

            
            
            
            
            	<div class="modal-dialog" style="width: 500px">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">Informar responsável e prazo</h4>
						</div>
                         
                        
                        <div class="modal-body">
              <div class="row">
                  <div class="col-xs-12">
                      <div class="well">
                          <div class="form-group">
								<label for="justificativa">Responsável</label><BR>
								<input type="text" maxlength="300" size="50" class=" "   placeholder="Digite o nome do responsável" name="txt_responsavel" value=""/>
                            </div> 


                         <div class="form-group">
								<label for="justificativa">Prazo</label><BR>
								<input type="text" maxlength="3" size="3" size="5" class=" "   placeholder="Digite a quantidade de dias " name="nr_dias_prazo_responsavel" value=""/>
                         </div> 
						
							
							
                            <a class="btn btn-primary" onclick="enviarEPCH();">Salvar</a> <a href="#" data-dismiss="modal" class="btn">Fechar</a>
                      </div>
                  </div>
                  <div class="col-xs-12">
                      <p><b>Nota</b></p>
                      <p class="text-justify">O cumprimento da nãoconformidade será finalizado.</p>
                      <p class="text-justify">Uma vez registrado, as informações serão registradas na base de dados.</p>
                  </div>
              </div>
          </div>
                        
                  
                          
						</div>
						
					</div>
</form>
				</div>
            </div>








<!-- JUSTIFICATIVA PARA CUMPRIMENTO DAS NÃO CONFORMIDADES-->

 <div class="row" style="margin-left: 0px; margin-right: 0px;">
			<div class="modal fade" id="modalObservacaoPCH">
			
            <form name="frmPCH" action="" method="post">
		    <input type='hidden' name='acao' value=''>
		    <input type='hidden' name='cod_servico_habilitado_estabelecimento' value=''>
            <input type='hidden' name='cod_estabelecimento' value=''>
            <input type='hidden' name='cod_pch_estabelecimento' value=''>

            
            
            
            
            	<div class="modal-dialog" style="width: 500px">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">Informar parecer</h4>
						</div>
                        
                        
                        <div class="modal-body">
              <div class="row">
                  <div class="col-xs-12">
                      <div class="well">
                          <div class="form-group">
								<label for="justificativa">Observações</label> <span id="ObservacaoAviso" class=""></span>
								<input class="form-control" id="txt_observacao" name="txt_observacao" placeholder="Digite a observação" type="text">
							</div>
							
							
                            <a class="btn btn-primary" onclick="enviarPCH();">Salvar</a> <a href="#" data-dismiss="modal" class="btn">Fechar</a>
                      </div>
                  </div>
                  <div class="col-xs-12">
                      <p><b>Nota</b></p>
                      <p class="text-justify">O cumprimento da nãoconformidade será finalizado.</p>
                      <p class="text-justify">Uma vez registrado, as informações serão registradas na base de dados.</p>
                  </div>
              </div>
          </div>
                        
                  
                          
						</div>
						
					</div>
</form>
				</div>
            </div>






            <!-- FINALIZAR CUMPRIMENTO DAS NÃO CONFORMIDADES-->

 <div class="row" style="margin-left: 0px; margin-right: 0px;">
			<div class="modal fade" id="modalFinalizarPCH">
			
            <form name="frmFPCH" action="" method="post">
		    <input type='hidden' name='acao' value=''>
		    <input type='hidden' name='cod_servico_habilitado_estabelecimento' value=''>
            <input type='hidden' name='cod_estabelecimento' value=''>
            <input type='hidden' name='cod_pch_estabelecimento' value=''>

            
            
            
            
            	<div class="modal-dialog" style="width: 500px">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">Informar Data de Fechamento</h4>
						</div>
                        
                        
                        <div class="modal-body">
              <div class="row">
                  <div class="col-xs-12">
                      <div class="well">
                          <div class="form-group">
								<label for="justificativa">Data de Fechamento</label>
								<input type="text" size="14" maxLength="10" onKeyPress="mask(this,'00/00/0000',1, event)" onBlur="isDate(this);" name="dt_cumprimento" id="dt_cumprimento" />
				   (dd/mm/aaaa)
				
							</div>
							
							
                            <a class="btn btn-primary" onclick="enviarFPCH();">Salvar</a> <a href="#" data-dismiss="modal" class="btn">Fechar</a>
                      </div>
                  </div>
                  <div class="col-xs-12">
                      <p><b>Nota</b></p>
                      <p class="text-justify">O cumprimento da não conformidade será finalizado.</p>
                  </div>
              </div>
          </div>
                        
                   
                          
						</div>
						
					</div>
</form>
				</div>
            </div>




<form name="frmHPCH" action="historico_plano_acao.php" method="post" target="_blank">
            <input type='hidden' name='cod_estabelecimento' value=''>
            <input type='hidden' name='cod_pch_estabelecimento' value=''>

</form>





<script>


 
function historicoItemPCH(cod,codEstab){
//abrir a tela de historico de modificações do iem do Plano de Ação (PCH)
frmHPCH.cod_pch_estabelecimento.value =  cod;
frmHPCH.cod_estabelecimento.value =  codEstab;
document.getElementsByName('frmHPCH')[0].submit();
}


 
function desabilitar(cod, codEstab){


   frmCadastro.cod_servico_habilitado_estabelecimento.value =  cod;
    frmCadastro.cod_estabelecimento.value =  codEstab;
    frmCadastro.acao.value =  'DS';
}

function desabilitarServico(){
    
   
    if (document.getElementsByName('ds_justificativa')[0].value == ''){
		alert('Informe a justificativa para desabilitar o serviço!');
		document.getElementsByName('ds_justificativa')[0].focus();
		return false;
	}
    
    document.getElementsByName('frmCadastro')[0].action = 'hospital_habilitado_manter.php';
	document.getElementsByName('frmCadastro')[0].submit();
}

 
function informarRPCH(cod, codEstab){

frmPCH.cod_pch_estabelecimento.value =  cod;
frmPCH.cod_estabelecimento.value =  codEstab;
frmPCH.acao.value =  'RPCH';
}


function editarPCH(cod, codEstab){

frmEPCH.cod_pch_estabelecimento.value =  cod;
frmEPCH.cod_estabelecimento.value =  codEstab;
frmEPCH.acao.value =  'EPCH';
}


function finalizarFPCH(cod, codEstab){

frmFPCH.cod_pch_estabelecimento.value =  cod;
frmFPCH.cod_estabelecimento.value =  codEstab;
frmFPCH.acao.value =  'FPCH';
}
 

function editarHSH(cod,codEstab){

frmHospital.cod_servico_habilitado_estabelecimento.value =  cod;
frmHospital.cod_estabelecimento.value =  codEstab;
frmHospital.acao.value =  'ASH';
document.getElementsByName('frmHospital')[0].action = 'hospital_servico_habilitado.php';
document.getElementsByName('frmHospital')[0].submit();
}

 

function adicionarSH(cod){

frmHospital.cod_estabelecimento.value =  cod;
frmHospital.acao.value =  'ISH';
document.getElementsByName('frmHospital')[0].action = 'hospital_servico_habilitado_add.php';
document.getElementsByName('frmHospital')[0].submit();
}


function adicionarSPH(cod){

frmHospital.cod_estabelecimento.value =  cod;
frmHospital.acao.value =  'ISPH';
document.getElementsByName('frmHospital')[0].action = 'hospital_servico_potencial_habilitacao_add.php';
document.getElementsByName('frmHospital')[0].submit();
}



 
function acompanharEPH(cod,codEstab){

frmHospital.cod_servico_potencial_habilitacao_estabelecimento.value =  cod;
frmHospital.cod_estabelecimento.value =  codEstab;
frmHospital.acao.value =  'EPH';
document.getElementsByName('frmHospital')[0].action = 'acompanhar_servico_potencial_habilitacao.php?output=html';
document.getElementsByName('frmHospital')[0].submit();
}


function editarHSPH(cod,codEstab){

frmHospital.cod_servico_potencial_habilitacao_estabelecimento.value =  cod;
frmHospital.cod_estabelecimento.value =  codEstab;
frmHospital.acao.value =  'ASPH';
document.getElementsByName('frmHospital')[0].action = 'hospital_servico_potencial_habilitacao.php';
document.getElementsByName('frmHospital')[0].submit();
}


function excluirPotencial(cod,codEstab){

frmExcluirPotencial.cod_servico_potencial_habilitacao_estabelecimento.value =  cod;
frmExcluirPotencial.cod_estabelecimento.value =  codEstab;
frmExcluirPotencial.acao.value =  'EPH';

}


function excluirServicoPH(){

document.getElementsByName('frmExcluirPotencial')[0].action = 'hospital_potencial_habilitacao_manter.php';
document.getElementsByName('frmExcluirPotencial')[0].submit();    

}


function enviarPCH(){
   
    document.getElementsByName('frmPCH')[0].action = 'hospital_habilitado_manter.php';
	document.getElementsByName('frmPCH')[0].submit();
}

//Editar PCH
function enviarEPCH(){
   
   document.getElementsByName('frmEPCH')[0].action = 'hospital_habilitado_manter.php';
   document.getElementsByName('frmEPCH')[0].submit();
}






function enviarFPCH(){
    
    if (document.getElementsByName('dt_cumprimento')[0].value == ''){
		alert('Informe a DATA de finalização do processo!');
		document.getElementsByName('dt_cumprimento')[0].focus();
		return false;
	}
    
    
    document.getElementsByName('frmFPCH')[0].action = 'hospital_habilitado_manter.php';
	document.getElementsByName('frmFPCH')[0].submit();
}




</script>





    
<?php include("../../rodape.php"); ?>

