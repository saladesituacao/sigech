<?php
 
function verifica_seguranca()
{
    global $application;
    if ($_SESSION["cod_usuario"] == "") {
        js_go($_SESSION["txt_pagina_login"]);
        flush();
        exit();
    }
}

function permissao_acesso($cod_permissao) 
{
    
     global $acesso;
     
    //PERFIL DE ADMINISTRADOR
    if ($acesso->usuario->perfil == 1) {
        return true;
    }
   $qPermissao = pg_query("SELECT * FROM sigech.tb_permissao_perfil WHERE cod_permissao = " .$cod_permissao. " AND cod_perfil = ".$acesso->usuario->perfil);
    if (pg_num_rows($qPermissao) > 0) {
        return true;
    } else {
        return false;
    }
}
 
?>