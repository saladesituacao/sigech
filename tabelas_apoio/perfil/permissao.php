<?php 

include("../../cabecalho_menu.php"); 
include("../../classes/Perfil.php");


$acao = 'P';
$perfil = new Perfil();
$id = $_REQUEST['cod_perfil'];


?>


 <div class="panel-body">
<form name="frmCadastro" class="form-horizontal" action="perfil_manter.php" method=post>
<input type="hidden" name="acao" value="<?php echo $acao; ?>">
<input type="hidden" name="cod_perfil" value="<?php echo $id; ?>">
	<div class="container">
        <header class="header-page">
            <h3 class="header-page__title">PERMISSÕES</h3><P>
        </header>
        <div class="clearfix"></div>
	   
	    <div class="row">
            <div class="form-group col-md-12">
                <center><h3><?php echo($perfil->RetornaPerfil($id)) ?></h3></center>
            </div><!--form-group-->
        </div><!--row--> 

		<div class="row">
            <?php
            $sql = "SELECT * FROM sigech.tb_modulo_sistema WHERE cod_ativo = 1 AND cod_modulo_superior IS NULL ORDER BY txt_modulo_sistema";
            $q = pg_query($sql);
            while ($rs = pg_fetch_array($q)) 
            { 
                $cod_modulo_sistema = $rs['cod_modulo_sistema'];
                $cod_tipo = $rs['cod_tipo'];
            ?>
                <div class="row">
                    <div class="form-group col-md-12">
                        <h3>Módulo: <strong><?php echo($rs['txt_modulo_sistema']) ?></strong></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12"> 
                        <?php
                        $sql = "SELECT sigech.tb_sistema_modulo_acao.*, txt_modulo_sistema_acao FROM sigech.tb_sistema_modulo_acao ";
                        $sql .= " INNER JOIN sigech.tb_modulo_sistema_acao ON sigech.tb_modulo_sistema_acao.cod_modulo_sistema_acao = sigech.tb_sistema_modulo_acao.cod_modulo_sistema_acao";
                        $sql .= " WHERE sigech.tb_sistema_modulo_acao.cod_modulo_sistema = ".$cod_modulo_sistema." ORDER BY sigech.tb_sistema_modulo_acao.cod_chave";
                        $q1 = pg_query($sql);
                        while ($rs1 = pg_fetch_array($q1)) 
                        { 
                            $txt_modulo_sistema_acao = $rs1['txt_modulo_sistema_acao'];
                            $cod_modulo_sistema = $rs1['cod_modulo_sistema'];   
                            $cod_chave = $rs1['cod_chave'];

                            if (empty($cod_modulo_sistema_old)) {
                                $cod_modulo_sistema_old = 0;
                            }

                            $sql = "SELECT * FROM sigech.tb_permissao_perfil WHERE cod_perfil = ".$id." AND cod_permissao = ".$cod_chave;
                            $q2 = pg_query($sql);
                            if (pg_num_rows($q2) > 0) {
                                $rs2 = pg_fetch_array($q2);
                                $cod_permissao_perfil = $rs2['cod_permissao'];
                                $checked = "checked";
                            } else {
                                $cod_permissao_perfil = '';
                                $checked = '';                                
                            }
                        
                            if (intval($cod_tipo == 1)) { ?>                                
                                <div class="form-group col-md-2">
                                    <div class="checkbox">
                                        <label><input type="checkbox" id="cod_permissao" name="cod_permissao[]" value="<?php echo($cod_chave) ?>"<?=$checked?>><strong><?php echo($txt_modulo_sistema_acao); ?></strong></label>
                                    </div>                                                                        
                                </div> <?php                                      
                            } else if (intval($cod_tipo == 2)) { ?> 
                                <div class="form-group col-md-2">
                                    <div class="checkbox">
                                        <label><input type="checkbox" id="cod_permissao" name="cod_permissao[]" value="<?php echo($cod_chave) ?>"<?=$checked?>><strong><?php echo($txt_modulo_sistema_acao); ?></strong></label>
                                    </div>                                                                        
                                </div> <?php   
                                $sql = "SELECT * FROM sigech.tb_modulo_sistema WHERE cod_ativo = 1 AND cod_modulo_superior = ".$cod_modulo_sistema." ORDER BY txt_modulo_sistema";
                                $q3 = pg_query($sql);                                
                                while ($rs3 = pg_fetch_array($q3)) { 
                                    $cod_modulo_sistema = $rs3['cod_modulo_sistema']; ?>
                                    <div class="table-responsive col-md-12">
                                        <table class="table table-striped" cellspacing="0" cellpadding="0">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <h4>Funcionalidade: <strong><?php echo($rs3['txt_modulo_sistema']) ?></strong></h4>
                                                            </div>
                                                        </div> 
                                                        <?php
                                                        $sql = "SELECT sigech.tb_sistema_modulo_acao.*, txt_modulo_sistema_acao FROM sigech.tb_sistema_modulo_acao ";
                                                        $sql .= " INNER JOIN sigech.tb_modulo_sistema_acao ON sigech.tb_modulo_sistema_acao.cod_modulo_sistema_acao = sigech.tb_sistema_modulo_acao.cod_modulo_sistema_acao";
                                                        $sql .= " WHERE sigech.tb_sistema_modulo_acao.cod_modulo_sistema = ".$cod_modulo_sistema." ORDER BY sigech.tb_sistema_modulo_acao.cod_chave";
                                                        $q4 = pg_query($sql);
                                                        $ct = 1;
                                                        while ($rs4 = pg_fetch_array($q4)) {
                                                            $txt_modulo_sistema_acao = $rs4['txt_modulo_sistema_acao'];
                                                            $cod_modulo_sistema = $rs4['cod_modulo_sistema'];   
                                                            $cod_chave = $rs4['cod_chave'];                                        

                                                            $sql = "SELECT * FROM sigech.tb_permissao_perfil WHERE cod_perfil = ".$id." AND cod_permissao = ".$cod_chave;
                                                            $q5 = pg_query($sql);
                                                            if (pg_num_rows($q5) > 0) {
                                                                $rs5 = pg_fetch_array($q5);
                                                                $cod_permissao_perfil = $rs5['cod_permissao'];
                                                                $checked = "checked";
                                                            } else {
                                                                $cod_permissao_perfil = '';
                                                                $checked = '';                                
                                                            } 
                                                            
                                                            if ($ct <= 4) { ?>
                                                                <div class="form-group col-md-2">
                                                                    <div class="checkbox">
                                                                        <label><input type="checkbox" id="cod_permissao" name="cod_permissao[]" value="<?php echo($cod_chave) ?>"<?=$checked?>><strong><?php echo($txt_modulo_sistema_acao); ?></strong></label>
                                                                    </div>                                                                        
                                                                </div> <?php

                                                                $ct += 1;
                                                            } 
                                                            else { ?>
                                                                <div class="row">
                                                                    <div class="form-group col-md-2">
                                                                        <div class="checkbox">
                                                                            <label><input type="checkbox" id="cod_permissao" name="cod_permissao[]" value="<?php echo($cod_chave) ?>"<?=$checked?>><strong><?php echo($txt_modulo_sistema_acao); ?></strong></label>
                                                                        </div>                                                                        
                                                                    </div> 
                                                                </div> <?php
                                        
                                                                $ct = 0;
                                                            }                                                                                                                                                                               
                                                        }  ?>
                                                    </th>
                                                </tr>
                                            <thead>
                                        </table>
                                    </div> <?php                                  
                                }
                            }                                                   
                        }
                    ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div> <br />
        <div class="row">
            <div class="col-md-12">
                <center>
				<button class="btn btn-default" ><i class="fa fa-keyboard-o" style="font-size:24px;color:blue"></i> Salvar</button>  
		<button class="btn btn-default" onclick="history.go(-1)"><i class="fa fa-eraser" style="font-size:24px;color:red"></i> Voltar</button>  
                </center>
            </div><!--col-md-12-->
        </div><!--row-->

		
	</form>
    </div><!-- /container -->
</div>
	
  
</body>
</html>
<?php include("../../rodape.php"); ?>