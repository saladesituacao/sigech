<?php

function optClassificacaoEstabelecimento($id){
	global $acesso;

	$sql = "SELECT DISTINCT 
    cod_classificacao_estabelecimento,
    txt_classificacao_estabelecimento

    FROM sigech.tb_classificacao_estabelecimento order by 1 asc ";

	$resultado = $acesso->getRs($sql);

	while ($linha = pg_fetch_row($resultado)){
 		$selected = '';

		if ($linha[0] == $id){
  			$selected = 'selected';
        }
		echo "<option value='$linha[0]' $selected>$linha[1]";
	}

}




?>