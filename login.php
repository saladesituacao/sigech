<?php
//error_reporting(0);

$docroot = $_SERVER["DOCUMENT_ROOT"]."/sigech";
include_once("$docroot/classes/Acesso.php");
include_once("$docroot/rotinas_comuns.php");
include_once("$docroot/classes/Auditoria.php");

//Session_start();
$_SESSION['LOGIN']='';
$_SESSION["CODPERFIL"] = '';
$_SESSION["PERFIL"] = '';
$_SESSION["CODORGAO"] = '';
$_SESSION["ORGAO"] = '';

$acesso->usuario->limparSession();
 
 
//echo ($_POST['txtLogin'] . "ola" . $_SERVER['REQUEST_METHOD']);
//exit();

If ($_POST['txtLogin'] != ''){
	global $acesso;

	if ($acesso->usuario->validarLogin($_POST['txtLogin'],$_POST['txtSenha'])){
       //header('Location: dashboard/index.php');
       Auditoria(2,'Usuário autenticado', '');
       redirecionar('dashboard/index.php');
	}else{
       alert('Senha incorreta');
	}
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    
    <title>DICS</title>
    
    <link rel="stylesheet" href="assets/css/main.css">
    
</head>
<body>
    <div class="overlay">

                <div class="col-md-6 col-md-offset-3">
                    <div class="box--shadow">
                        <div class="box box--body-auth">
                            <div class="box__logo">
                            <label for="field_titulo" class="label-control">SECRETARIA DE ESTADO DE SAÚDE</label>
                            <br>
                            <img src="/sigech/assets/img/logo_sigech.png" Width ='100%'  Height='10%' >
                            </div><!-- / LOGO -->
                            <form id="formLogin" data-toggle="validator"  method="POST">
                                <div class="form-group">
                                    <label for="txtLogin" class="label-control" >Login:</label>
                                    <input type="text" id="txtLogin" name="txtLogin" class="form-control" placeholder="Digite seu Login..." data-error="Por favor, informe um login." required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="txtSenha" class="label-control">Senha:</label>
                                    <input type="password" id="txtSenha" name="txtSenha" class="form-control" placeholder="Digite sua Senha..." data-error="Por favor, informe uma senha." required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn--theme">Entrar</button>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                        </div><!-- /box body -->
                    </div><!-- box shadow -->
                </div><!-- /col -->
    </div>
</body>
</html>
