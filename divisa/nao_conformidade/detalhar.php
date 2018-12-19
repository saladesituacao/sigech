<?php include("../../cabecalho_menu.php"); 

// Retornar nome do estabelecimento
//error_reporting(0);
include("../../dashboard/dados/hospital.php"); 
include("../../classes/Perfil.php");
include ("../../assets/lib/brTable.php");
$perfil = new Perfil();

Auditoria(22,'Detalhamento hospitalar', $sqlEstab);	

?>
 
 <div class="container">
        
        
 <div class="well text-center">
	<h3 class="header-page__title">
	ESTABELECIMENTO

            <br><strong  class="txt-error" style="font-size:100%;"><?PHP echo ($estabelecimento); ?></strong>
			<span role="button" data-toggle="print" class="fa fa-print pull-right" onclick="javascript:window.print();"></span>
		</h3>
	</div>
        
        <div class="clearfix"></div>
       
<!-- LISTAGEM DE NÃO CONFORMIDADES -->
<ul class="nav nav-pills nav-justified space-mb-md" role="tablist">
<?php if (permissao_acesso(301)) { ?>
            <li class="active"><a href="#nc" data-toggle="tab">Não conformidade</a></li>
<?php } ?>
        </ul>

<?php 

if (permissao_acesso(301)) { 
include("listar_nao_conformidade.php"); 
}

?>
</div><!-- /container -->


<!-- JUSTIFICATIVA PARA CUMPRIMENTO DAS NÃO CONFORMIDADES-->

 <div class="row" style="margin-left: 0px; margin-right: 0px;">
			<div class="modal fade" id="modalReabrirPCHC">
			
            <form name="frmPCHC" action="" method="post">
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
							
							
                            <a class="btn btn-primary" onclick="enviarRPCHC();">Salvar</a> <a href="#" data-dismiss="modal" class="btn">Fechar</a>
                      </div>
                  </div>
                  <div class="col-xs-12">
                      <p><b>Nota</b></p>
                      <p class="text-justify">A não conformidade será reaberta.</p>
                  </div>
              </div>
          </div>
                        
                  
                          
						</div>
						
					</div>
</form>
				</div>
            </div>
 


<!-- Acesso ao histórico de ações realizadas no item da não conformidade -->
<form name="frmHPCH" action="../../dashboard/hospital/historico_plano_acao.php" method="post" target="_blank">
            <input type='hidden' name='cod_estabelecimento' value=''>
            <input type='hidden' name='cod_pch_estabelecimento' value=''>

</form>


<!-- Finalizar não conformidade definitivamente-->
<form name="frmFPCHD" action="../../dashboard/hospital/hospital_habilitado_manter.php" method="post">
            <input type='hidden' name='acao' value='FPCHD'>
            <input type='hidden' name='cod_estabelecimento' value=''>
            <input type='hidden' name='cod_pch_estabelecimento' value=''>

</form>


<script>


function reabrirPCHC(cod, codEstab){
//Reabrir PCH concluido
frmPCHC.cod_pch_estabelecimento.value =  cod;
frmPCHC.cod_estabelecimento.value =  codEstab;
frmPCHC.acao.value =  'RPCHC';
}


function enviarRPCHC(){
   
        document.getElementsByName('frmPCHC')[0].action = '../../dashboard/hospital/hospital_habilitado_manter.php';
        document.getElementsByName('frmPCHC')[0].submit();
}


function finalizarFPCHD(cod,codEstab){
//Finalizar iem do Plano de Ação (PCH) definitivamente
frmFPCHD.cod_pch_estabelecimento.value =  cod;
frmFPCHD.cod_estabelecimento.value =  codEstab;
document.getElementsByName('frmFPCHD')[0].submit();
}
 
function historicoItemPCH(cod,codEstab){
//abrir a tela de historico de modificações do iem do Plano de Ação (PCH)
frmHPCH.cod_pch_estabelecimento.value =  cod;
frmHPCH.cod_estabelecimento.value =  codEstab;
document.getElementsByName('frmHPCH')[0].submit();
}


</script>






<?php include("../../rodape.php"); ?>

