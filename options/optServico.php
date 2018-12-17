<?php

class servico {
	/**
	 * Busca Servico
	 */
	public function buscarServico($cod_area) {


 

		global $acesso;

		$sql = "SELECT cod_servico, nr_servico, nm_servico  FROM sigech.tb_servico WHERE 1=1 ";

		if ($cod_area != ''){
			$sql .= " AND cod_area_habilitacao=" .tratarStr($cod_area) ;
		}
	
	
		$sql .= " ORDER BY cod_servico";
		$resultado = $acesso->getRs($sql);

 
		while ($linha = pg_fetch_row($resultado)){
			$dadosaida.= $linha[0] . "|" . $linha[1] . " - " . $linha[2] . ",";

		}
		
		$dadosaida = substr($dadosaida, 0, -1);
		return $dadosaida;


		
	}
	
	
}


 

function optServico($cod_area){
	global $acesso;

	$sql = "SELECT cod_servico, nr_servico, nm_servico  FROM sigech.tb_servico WHERE 1=1 ";

		if ($cod_area != ''){
			$sql .= " AND cod_area_habilitacao=" .tratarStr($cod_area) ;
		}
	
	
		$sql .= " ORDER BY cod_servico";
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