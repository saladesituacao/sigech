<?php
//USAR COLUNA TXT_SQL PARA COMANDOS DE BANCO
//USAR COLUNA TXT_HISTORICO PARA LOG TRATADO

function Auditoria($cod_acao_auditoria, $txt_historico, $txt_sql)
{
    global $acesso;
    
    if(!empty($txt_sql)) {
        $txt_sql = str_replace("'", "''", $txt_sql);
    }


    $sql = "INSERT INTO sigech.tb_auditoria(cod_acao_auditoria, cod_usuario, txt_historico, txt_sql) ";
    $sql .= " VALUES(".$cod_acao_auditoria.", ".$acesso->usuario->id.", '".trim($txt_historico)."', '".trim($txt_sql)."')";    

    //echo  $sql;
    //exit();
   
    $qtLin = $acesso->exec($sql);
    
}
 
?>