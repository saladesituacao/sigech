<?php
//error_reporting(0);
include("Auditoria.php");
class Estabelecimento{

	public $id;
	public $nome;
	public $classificacao;
	public $nomeContato;
	public $emailContato;
	public $telefoneContato;


	private function carregarParametros($rs){

		if ($linha = pg_fetch_row($rs)){
			// Carregar parametros

			$this->id = $linha[0];
			$this->nome = $linha[1];
			$this->classificacao = $linha[2];
			$this->nomeContato = $linha[3];
			$this->emailContato = $linha[4];
			$this->telefoneContato = $linha[5];

			return true;
		}else{
			return false;
		}
	}

	function carregar($_id){
		global $acesso;

		$sql = "SELECT cod_estabelecimento, nm_estabelecimento, cod_classificacao_estabelecimento,
						txt_nome_contato, txt_email_contato, txt_telefone_contato
				FROM sigech.tb_estabelecimento WHERE
				cod_estabelecimento=" . tratarStr($_id);

		$resultado = $acesso->getRs($sql);

		return $this->carregarParametros($resultado);

	}

	function alterar(){

		global $acesso;

		 

		$sql = "UPDATE sigech.tb_estabelecimento SET ";
			$sql .= " txt_nome_contato = "		. tratarStr($this->nomeContato);
			$sql .= ", txt_email_contato = "	. tratarStr($this->emailContato);
			$sql .= ", txt_telefone_contato = "	. tratarStr($this->telefoneContato);
			$sql .= ", cod_usuario = " . $acesso->usuario->id;
			$sql .= ", dt_atualizacao = " . dataAtual();
			

		$sql .= " WHERE cod_estabelecimento = " . tratarStr($this->id);

		$qtLin = $acesso->exec($sql);
		Auditoria(9,'Estabelecimento alterado', $sql);

		return ($qtLin > 0);
	}

	
}
?>
