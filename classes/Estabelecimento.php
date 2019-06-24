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
	public $cnes;


	private function carregarParametros($rs){

		if ($linha = pg_fetch_row($rs)){
			// Carregar parametros

			$this->id = $linha[0];
			$this->nome = $linha[1];
			$this->classificacao = $linha[2];
			$this->nomeContato = $linha[3];
			$this->emailContato = $linha[4];
			$this->telefoneContato = $linha[5];
			$this->cnes = $linha[6];

			return true;
		}else{
			return false;
		}
	}

	function carregar($_id){
		global $acesso;

		$sql = "SELECT cod_estabelecimento, nm_estabelecimento, cod_classificacao_estabelecimento,
						txt_nome_contato, txt_email_contato, txt_telefone_contato, cod_cnes
				FROM sigech.tb_estabelecimento WHERE
				cod_estabelecimento=" . tratarStr($_id);

		$resultado = $acesso->getRs($sql);

		return $this->carregarParametros($resultado);

	}



	function estabelecimentoRepetido(){

		global $acesso;

		$sql = "SELECT cod_estabelecimento
				FROM sigech.tb_estabelecimento WHERE
				nm_estabelecimento=" . tratarStr($this->nome);


		if ($this->id != ''){
			$sql .= " AND cod_estabelecimento!=" . tratarStr($this->id);
		}

		$resultado = $acesso->getRs($sql);

		return pg_num_rows($resultado)>0;

	}

	function alterar(){

		global $acesso;

		if ($this->estabelecimentoRepetido()){
			alert('O estabelecimento n�o est� dispon�vel!');
			return false;
		}

		 

		$sql = "UPDATE sigech.tb_estabelecimento SET ";
			$sql .= " nm_estabelecimento = "	. tratarStr($this->nome);
			$sql .= ", cod_classificacao_estabelecimento = "		. tratarStr($this->classificacao);
			$sql .= ", txt_nome_contato = "		. tratarStr($this->nomeContato);
			$sql .= ", txt_email_contato = "	. tratarStr($this->emailContato);
			$sql .= ", txt_telefone_contato = "	. tratarStr($this->telefoneContato);
			$sql .= ", cod_cnes	 = "			. tratarStr($this->cnes);
			$sql .= ", cod_usuario = " . $acesso->usuario->id;
			$sql .= ", dt_atualizacao = " . dataAtual();
			

		$sql .= " WHERE cod_estabelecimento = " . tratarStr($this->id);

		$qtLin = $acesso->exec($sql);
		Auditoria(9,'Estabelecimento alterado', $sql);

		return ($qtLin > 0);
	}



	function incluir(){

		global $acesso;
  
		
		if ($this->estabelecimentoRepetido()){
			alert('O estabelecimento n�o est� dispon�vel!');
			return false;
		}

	

		$sql = "INSERT INTO sigech.tb_estabelecimento (
				nm_estabelecimento, cod_classificacao_estabelecimento, txt_nome_contato, txt_email_contato, txt_telefone_contato, cod_cnes,cod_usuario, dt_atualizacao
			) VALUES (";

			$sql .= tratarStr($this->nome);
			$sql .= ", " . tratarStr($this->classificacao);
			$sql .= ", " . tratarStr($this->nomeContato);
			$sql .= ", " . tratarStr($this->emailContato);
			$sql .= ", " . tratarStr($this->telefoneContato);
			$sql .= ", " . tratarStr($this->cnes);
			$sql .= ", " . $acesso->usuario->id;
			$sql .= ", " . dataAtual();

		$sql .= ")";


		$qtLin = $acesso->exec($sql);
		Auditoria(66,'Estabelecimento incluído', $sql);

		return ($qtLin > 0);
	}



	function reativar(){

		global $acesso;

		$sql = "UPDATE sigech.tb_estabelecimento SET ";
			$sql .= " ind_habilitado = 'S'";
		$sql .= " WHERE cod_estabelecimento = " . tratarStr($this->id);

		$qtLin = $acesso->exec($sql);
		Auditoria(64,'Estabelecimento reativado', $sql);

		return ($qtLin > 0);
	}

	function desativar(){

		global $acesso;

		$sql = "UPDATE sigech.tb_estabelecimento SET ";
			$sql .= " ind_habilitado = 'N'";
		$sql .= " WHERE cod_estabelecimento = " . tratarStr($this->id);

		$qtLin = $acesso->exec($sql);
		Auditoria(65,'Estabelecimento desativado', $sql);

		return ($qtLin > 0);
	}

}
?>
