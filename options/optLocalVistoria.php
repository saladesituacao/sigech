<?php

function optLocalVistoria($id){
	global $acesso;

	$sql = "SELECT DISTINCT 
    cod_local_vistoria, txt_local_vistoria
    
    FROM sigech.tb_local_vistoria order by 1 asc ";

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