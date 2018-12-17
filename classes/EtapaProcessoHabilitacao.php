<?php
//error_reporting(0);
include("Auditoria.php");
class EtapaProcessoHabilitacao{

	public $id;
	public $descricao;
	public $qtd;
	public $nomeContato;
	public $emailContato;
	public $telefoneContato;


	private function carregarParametros($rs){

		if ($linha = pg_fetch_row($rs)){
			// Carregar parametros

			$this->id = $linha[0];
			$this->descricao = $linha[1];
			$this->qtd = $linha[2];
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

		$sql = "SELECT cod_etapa_processo_habilitacao, ds_etapa, qtd_dias,
						txt_nome_contato, txt_email_contato, txt_telefone_contato
				FROM sigech.tb_etapa_processo_habilitacao WHERE ind_habilitado = 'S'
				AND cod_etapa_processo_habilitacao=" . tratarStr($_id);

		$resultado = $acesso->getRs($sql);

		return $this->carregarParametros($resultado);

	}

	function alterar(){

		global $acesso;

		

		$sql = "UPDATE sigech.tb_etapa_processo_habilitacao SET ";
		$sql .= " ds_etapa = "				. tratarStr($this->descricao);
			$sql .= ", qtd_dias = "				. tratarStr($this->qtd);
			$sql .= ", txt_nome_contato = "		. tratarStr($this->nomeContato);
			$sql .= ", txt_email_contato = "	. tratarStr($this->emailContato);
			$sql .= ", txt_telefone_contato = "	. tratarStr($this->telefoneContato);
			$sql .= ", cod_usuario = " . $acesso->usuario->id;
			$sql .= ", dt_atualizacao = " . dataAtual();
			

		$sql .= " WHERE cod_etapa_processo_habilitacao = " . tratarStr($this->id);


		$qtLin = $acesso->exec($sql);

		Auditoria(11,'Etapa do processo de habilitação alterada', $sql);

		return ($qtLin > 0);
	}

	
}
?>
