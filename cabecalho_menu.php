<?php
$docroot = $_SERVER["DOCUMENT_ROOT"]."/sigech";

$dominio= $_SERVER['HTTP_HOST'];
$url = "http://" . $dominio ."/sigech/dashboard/index.php";

$urlAtual = "http://" . $dominio. $_SERVER['REQUEST_URI'];
//error_reporting(0);

include_once("$docroot/classes/Acesso.php");
include_once("$docroot/permissao.php");
include_once("$docroot/rotinas_comuns.php");
//Session_start();


global $acesso;
if ($acesso->usuario->id == ''){
	alert("Você nâo está logado!");
	redirecionar('../login.php');
}




?>
 
<!DOCTYPE html>
<html lang="pt-br">
    <head>
            <meta charset="utf-8">
        
        <title>SIGECH - Sistema de Gestão de Credenciamento e Habilitação</title>
        
		<link rel="stylesheet" href="/sigech/assets/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="/sigech/assets/css/main.css" type="text/css">
        <link rel="stylesheet" href="/sigech/assets/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="/sigech/assets/chosen/style.css">
        <link rel="stylesheet" href="/sigech/assets/css/lembrete.css">
        <link rel="stylesheet" href="/sigech/assets/chosen/prism.css">
        <link rel="stylesheet" href="/sigech/assets/chosen/chosen.css">
        <link href="/sigech/assets/css/calendar-blue.css" rel="stylesheet" />

        

        
        
        
        <script type='text/javascript' src='/sigech/assets/js/bootstrap.min.js'></script>
        <script type='text/javascript' src='/sigech/assets/js/jquery-1.7.min.js'></script>
        
        
        <script type='text/javascript' src="/sigech/assets/js/main.js"></script>
        
        <script language="Javascript" src="/sigech/assets/js/funcao.js"></script>
        <script type='text/javascript' src='/sigech/assets/js/mask.js'></script>
        <script language="Javascript" src="/sigech/assets/js/isdate.js"></script>

        <script language="Javascript" src="/sigech/assets/js/calendar.js"></script>
        <script language="Javascript" src="/sigech/assets/js/calendar-setup.js"></script>
        <script language="Javascript" src="/sigech/assets/js/calendar-en.js"></script>
               
	</head>
	
	
<body>
    <nav class="navbar navbar-default">
            
            
        <center><img src="/sigech/assets/img/sigech_bara_de_menu.png" Width ='40%'  Height='10%' ></center>
            
        <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" >
        
                <ul class="nav navbar-nav navbar-left">
                    
                <!--acesso ao menu Administrativo -->
                <?php 
                
                if (permissao_acesso(1))               
                { ?>
                <li class="dropdown">        
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">ADMINISTRATIVO<span <span class="caret"></span></a>
						<ul class="dropdown-menu">
                            
                        <?php if (permissao_acesso(2)) { ?>
                            <li><a href="/sigech/administrativo/estabelecimento/listar_estabelecimento.php?output=html"><span class="fa fa-hospital-o"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b> Estabelecimento</b></a></li>
                        <?php } ?>  
                        <?php if (permissao_acesso(3)) { ?>
                            <li><a href="/sigech/administrativo/etapa_processo_habilitacao/listar_etapa_processo_habilitacao.php?output=html"><span class="fa fa-bar-chart"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b> Etapa do Processo de Habilitação </b></a></li>
                        <?php } ?>  
                        <?php if (permissao_acesso(4)) { ?>
                            <li><a href="/sigech/administrativo/local_vistoria/listar_local_vistoria.php?output=html"><span class="fa fa-thumbs-up"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b> Local de vistoria </b></a></li>
                        <?php } ?>  
                        <?php if (permissao_acesso(5)) { ?>
                            <li><a href="/sigech/administrativo/plano_credenciamento_habilitacao/listar_plano_credenciamento_habilitacao.php?output=html"><span class="fa fa-tasks"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b> Plano de Credenciamento e Habilitação </b></a></li>
                        <?php } ?>  
                        <?php if (permissao_acesso(6)) { ?>
                            <li><a href="/sigech/administrativo/usuario/listar_usuario.php?output=html"><span class="fa fa-male"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b>Usuário</b></a></li>    
                        <?php } ?>  
						</ul>
					</li>
                    <?php
                            } ?>  




                        <!--acesso ao menu Consultas -->
                        <?php if (permissao_acesso(11)) 
                                        
                                        { ?>

                                        <li class="dropdown">        
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">CONSULTAS<span <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                        <?php if (permissao_acesso(322)) { ?>
                                            <li class=""><a href="/sigech/consulta/pesquisa_area_habilitacao.php?output=html"><span class="fa fa-search"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b>Pesquisa por Área de Habilitação</b></a></li>
                                        <?php } ?>  
                                        
                                        <?php if (permissao_acesso(12)) { ?>
                                            <li class=""><a href="/sigech/consulta/pesquisa_estabelecimento.php?output=html&cod_estabelecimento="><span class="fa fa-search"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b>Pesquisa por Estabelecimento</b></a></li>
                                        <?php } ?>  
                                        <?php if (permissao_acesso(13)) { ?>
                                            <li class=""><a href="/sigech/consulta/pesquisa_tipo_habilitacao.php?output=html"><span class="fa fa-search"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b>Pesquisa por Tipo de Habilitação</b></a></li>
                                        <?php } ?>  
                                            </ul>
                                        </li>       

                                    <?php
                                                } ?>

                            <!--acesso ao menu de não conformidades pela DIVISA -->
                            <?php if (permissao_acesso(300)) 
                                        
                                        { ?>

                                        <li class="dropdown">        
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">DIVISA<span <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                        <?php if (permissao_acesso(301)) { ?>
                                            <li class=""><a href="/sigech/divisa/index.php?output=html"><span class="fa fa-tag"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b>Não conformidades</b></a></li>
                                        <?php } ?>
                                            </ul>
                                        </li>       
                                    

                                        <?php
                                                } ?>


                        <!--acesso ao menu Reatórios -->
                        <?php if (permissao_acesso(14)) 

                                        { ?>

                                        <li class="dropdown">        
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">RELATÓRIOS<span <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                        <?php if (permissao_acesso(15)) { ?>
                                            <li class=""><a href="/sigech/Relatorios/Auditoria/relAuditoria.php?output=html"><span class="fa fa-street-view"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b>Auditoria</b></a></li>
                                        <?php } ?>

                                        <?php if (permissao_acesso(306)) { ?>
                                        <li class=""><a href="/sigech/Relatorios/Gerencial/relNCconcluidasEtotalNC.php?output=html"><span class="fa fa-tasks"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b>Nº de não conformidades concluídas x nº total de não conformidades</b></a></li>
                                        <?php } ?>
                                        <?php if (permissao_acesso(307)) { ?>
                                        <li class=""><a href="/sigech/Relatorios/Gerencial/relNCsolucionadasPeloEstabelecimento.php?output=html"><span class="fa fa-tasks"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b>Nº de não conformidades mês solucionadas pelas unidades (encaminhadas para a DIVISA)</b></a></li>
                                        <?php } ?>
                                        <?php if (permissao_acesso(308)) { ?>
                                        <li class=""><a href="/sigech/Relatorios/Gerencial/relNCpendentesDivisa.php?output=html"><span class="fa fa-tasks"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b>Nº de não conformidades pendentes na DIVISA (por mês) </b></a></li>
                                        <?php } ?>
                                        <?php if (permissao_acesso(309)) { ?>
                                        <li class=""><a href="/sigech/Relatorios/Gerencial/relNCconcluidasDivisa.php?output=html"><span class="fa fa-tasks"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b>Nº de não conformidades  concluídas pela DIVISA (por mês) </b></a></li>
                                        <?php } ?>

                                        <?php if (permissao_acesso(310)) { ?>
                                        <li class=""><a href="/sigech/Relatorios/Gerencial/relNCpendentesPorResponsavel.php?output=html"><span class="fa fa-tasks"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b>Nº de não conformidades pendentes (por responsável) </b></a></li>
                                        <?php } ?>

                                        <?php if (permissao_acesso(311)) { ?>
                                        <li class=""><a href="/sigech/Relatorios/Gerencial/relNCsolucionadasPorResponsavel.php?output=html"><span class="fa fa-tasks"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b>Nº de não conformidades concluídas e encaminhadas para DIVISA (por responsável) </b></a></li>
                                        <?php } ?>

                                        <?php if (permissao_acesso(323)) { ?>
                                        <li class=""><a href="/sigech/Relatorios/Gerencial/relQtdServicosPorEstabelecimento.php?output=html"><span class="fa fa-tasks"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b>Quantidade de serviços por estabelecimento </b></a></li>
                                        <?php } ?>
                                        
                                        
                                        <?php if (permissao_acesso(317)) { ?>
                                        <li class=""><a href="/sigech/Relatorios/Gerencial/relNCResumoGeral.php?output=html"><span class="fa fa-tasks"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b>Resumo das Não Conformidades </b></a></li>
                                        <?php } ?>

                                        

                                            </ul>
                                        </li>

                                        <?php
                                                } ?>

                <!--acesso ao menu Tabelas de apoio -->
                <?php if (permissao_acesso(7)) 
                
                { ?>
                <li class="dropdown">        
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">TABELAS DE APOIO<span <span class="caret"></span></a>
						<ul class="dropdown-menu">
                        <?php if (permissao_acesso(8)) { ?>
                            <li><a href="/sigech/tabelas_apoio/cargo/listar_cargo.php?output=html"><span class="fa fa-mortar-board"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b>Cargo</b></a></li>
                        <?php } ?>  

                        <?php if (permissao_acesso(331)) { ?>
                            <li><a href="/sigech/tabelas_apoio/classificacao_estabelecimento/listar_classificacao_estabelecimento.php?output=html"><span class="fa fa-hospital-o"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b>Classificar Estabelecimento</b></a></li>
                        <?php } ?>  


                        <?php if (permissao_acesso(9)) { ?>
                            <li><a href="/sigech/tabelas_apoio/orgao/listar_orgao.php?output=html"><span class="fa fa-sitemap"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b>Orgão</b></a></li>
                        <?php } ?>  
                        <?php if (permissao_acesso(10)) { ?>
                            <li><a href="/sigech/tabelas_apoio/perfil/listar_perfil.php?output=html"><span class="fa fa-vcard"  style="font-size:16px;color:blue">&nbsp;&nbsp;&nbsp; </span><b>Perfis de Usuário</b></a></li>
                        <?php } ?>  

                        
						</ul>
					</li>    
                         
                    <?php
                            } ?>
 
 </ul> 

               
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="fa fa-user">&nbsp;&nbsp;&nbsp;<?php echo $acesso->usuario->nome; ?></span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                        <li><a href="/sigech/administrativo/usuario/alterarsenha.php?cod_usuario=<?php echo $acesso->usuario->id; ?>"><span class="fas fa-street-view"> Trocar Senha</span></a></li>
                        <li><a href="/sigech/login.php"><span class="fa fa-user-times"> Sair</span></a></li>

                           
                        </ul>
                    </li>

                   
                </ul>    
               
                
            </div><!-- /navbar-collapse -->
            
       
    </nav>
    

<div style="float:right"> 
    <button id="voltar" class="btn btn-primary" onClick="javascript:window.location='<?php echo $url?>';"><i class="fa fa-laptop"></i> Tela Inicial</button>
    <?php
    //PERFIL DE ADMINISTRADOR
if ($acesso->usuario->perfil == 1 && $urlAtual == $url) {?>
    <a href="#addnote" role="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-edit"></span> Adicionar Lembrete</a>
<?php } ?>
    <a class="btn btn-danger logout" href="/sigech/login.php" ><span class="glyphicon glyphicon-log-out"></span> Sair</a></div><br/><br/> 
</div> 

<?php



?>
