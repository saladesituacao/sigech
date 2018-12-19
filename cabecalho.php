<?php

$docroot = $_SERVER["DOCUMENT_ROOT"]."/sigech";
error_reporting(0);

include_once("$docroot/classes/Acesso.php");

include_once("$docroot/rotinas_comuns.php");

Session_start();
global $acesso;




if ($acesso->usuario->id == ''){
	alert("Você nâo está logado!");
	redirecionar('login.php');
}else{
	redirecionar('dashboard/index.php');
	
}

?>
