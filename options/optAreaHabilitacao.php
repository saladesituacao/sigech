<?php

function optAreaHabilitacao($id){
	global $acesso;

	$sql = "SELECT DISTINCT 
    cod_area_habilitacao, nr_area_habilitacao, nm_area_habilitacao
    
       FROM sigech.tb_area_habilitacao order by 1 asc ";

	$resultado = $acesso->getRs($sql);

	while ($linha = pg_fetch_row($resultado)){
 		$selected = '';

		if ($linha[0] == $id){
  			$selected = 'selected';
        }
		echo "<option value='$linha[0]' $selected>$linha[1] -  $linha[2] ";
	}

}




?>