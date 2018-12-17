<?php

function optClassificacaoEstabelecimento($id){
	global $acesso;

	$sql = "SELECT DISTINCT 
    cod_classificacao_estabelecimento,
    CASE        WHEN cod_classificacao_estabelecimento = 1 THEN 'Hospital'
                WHEN cod_classificacao_estabelecimento = 2 THEN 'Unidade de Saúde'
                WHEN cod_classificacao_estabelecimento = 3 THEN 'Contratada'
    END AS classificacao

    FROM sigech.tb_estabelecimento order by 1 asc ";

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