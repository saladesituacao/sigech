<?php
//error_reporting(0);
include("Auditoria.php");
class ClassificacaoEstabelecimento{

	public $id;
	public $classificacaoEstabelecimento;
	public $ativo;
	

	private function carregarParametros($rs){

		if ($linha = pg_fetch_row($rs)){
			// Carregar parametros

			$this->id = $linha[0];
			$this->classificacaoEstabelecimento = $linha[1];
			$this->ativo = $linha[2];
			
			return true;
		}else{
			return false;
		}
	}

	function carregar($_id){
		global $acesso;

		$sql = "SELECT cod_classificacao_estabelecimento, txt_classificacao_estabelecimento, ind_habilitado
				FROM sigech.tb_classificacao_estabelecimento WHERE
				cod_classificacao_estabelecimento=" . tratarStr($_id);

		$resultado = $acesso->getRs($sql);

		return $this->carregarParametros($resultado);

	}

	function classificacaoRepetida(){

		global $acesso;

		$sql = "SELECT cod_classificacao_estabelecimento
				FROM sigech.tb_classificacao_estabelecimento WHERE
				txt_classificacao_estabelecimento=" . tratarStr($this->classificacaoEstabelecimento);


		if ($this->id != ''){
			$sql .= " AND cod_classificacao_estabelecimento!=" . tratarStr($this->id);
		}

		$resultado = $acesso->getRs($sql);

		return pg_num_rows($resultado)>0;

	}

	function alterar(){

		global $acesso;

		if ($this->classificacaoRepetida()){
			alert('A classificação para o estabelecimento não está disponível!');
			return false;
		}

		

		$sql = "UPDATE sigech.tb_classificacao_estabelecimento SET ";
			$sql .= " txt_classificacao_estabelecimento = "		. tratarStr($this->classificacaoEstabelecimento);

		$sql .= " WHERE cod_classificacao_estabelecimento = " . tratarStr($this->id);

		$qtLin = $acesso->exec($sql);
		Auditoria(72,'Classificação alterada', $sql);

		return ($qtLin > 0);
	}

	function incluir(){

		global $acesso;

		
		if ($this->classificacaoRepetida()){
			alert('O cargo não está disponível!');
			return false;
		}


		$rs=pg_fetch_array(pg_query("SELECT MAX(cod_classificacao_estabelecimento) FROM sigech.tb_classificacao_estabelecimento"));
        if (!isset($rs[0])) {
            $this->id = 1;
        } else {
            $this->id = intval($rs[0]) + 1;
		}
		


		$sql = "INSERT INTO sigech.tb_classificacao_estabelecimento(cod_classificacao_estabelecimento, txt_classificacao_estabelecimento, ind_habilitado) ";
        $sql .= " VALUES(".$this->id.", '".trim($this->classificacaoEstabelecimento)."', 'S')";

		$qtLin = $acesso->exec($sql);
		
		Auditoria(73,'Classificação incluída', $sql);
		return ($qtLin > 0);
	}


	function reativar(){

		global $acesso;

		$sql = "UPDATE sigech.tb_classificacao_estabelecimento SET ";
			$sql .= " ind_habilitado = 'S'";
		$sql .= " WHERE cod_classificacao_estabelecimento = " . tratarStr($this->id);

		$qtLin = $acesso->exec($sql);
		Auditoria(74,'Classificação reativada', $sql);
		return ($qtLin > 0);
	}

	function desativar(){

		global $acesso;

		$sql = "UPDATE sigech.tb_classificacao_estabelecimento SET ";
		$sql .= " ind_habilitado = 'N'";
	$sql .= " WHERE cod_classificacao_estabelecimento = " . tratarStr($this->id);


	$qtLin = $acesso->exec($sql);
	Auditoria(75,'Classificação desativada', $sql);
	return ($qtLin > 0);


	}
}
?>
