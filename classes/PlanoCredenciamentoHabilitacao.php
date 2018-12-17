<?php
//error_reporting(0);
include("Auditoria.php");
class PlanoCredenciamentoHabilitacao{

	public $id;
	public $idEstabelecimento;
	public $idLocalVistoria;
	public $dtCadastro;
	public $nrItem;
	public $txtNaoConformidade;
	public $txtDeterminacao;
	public $nrDiasPrazoDeterminacao;
	public $txtResponsavel;
	public $nrDiasResponsavel;
	public $dtCumprimento;
	public $txtObservacao;






	private function carregarParametros($rs){

		if ($linha = pg_fetch_row($rs)){
			// Carregar parametros

			
			$this->id = $linha[0];
			$this->idEstabelecimento = $linha[1];
			$this->idLocalVistoria = $linha[2];
			$this->dtCadastro = $linha[3];
			$this->nrItem = $linha[4];
			$this->txtNaoConformidade = $linha[5];
			$this->txtDeterminacao = $linha[6];
			$this->nrDiasPrazoDeterminacao = $linha[7];
			$this->txtResponsavel = $linha[8];
			$this->nrDiasResponsavel = $linha[9];
			$this->dtCumprimento = $linha[10];
			$this->txtObservacao = $linha[11];

			return true;
		}else{
			return false;
		}
	}

	function carregar($_id){
		global $acesso;

		$sql = "SELECT cod_pch_estabelecimento, cod_estabelecimento, cod_local_vistoria,
                  dt_cadastro, nr_item, txt_nao_conformidade, txt_determinacao,
				  nr_dias_prazo_determinacao, txt_responsavel, nr_dias_prazo_responsavel,
				  dt_cumprimento, txt_observacao
				FROM sigech.tb_pch_estabelecimento WHERE
				cod_pch_estabelecimento=" . tratarStr($_id);

		$resultado = $acesso->getRs($sql);

		return $this->carregarParametros($resultado);

	}
 
	
	function alterar(){

		global $acesso;


		$sql = "UPDATE sigech.tb_pch_estabelecimento SET ";
			$sql .= " cod_estabelecimento = "		. tratarStr($this->idEstabelecimento);
			$sql .= ", cod_local_vistoria = "	. tratarStr($this->idLocalVistoria);
			$sql .= ", dt_cadastro = "	. tratarData($this->dtCadastro);
			$sql .= ", nr_item = "	. tratarStr($this->nrItem);
			$sql .= ", txt_nao_conformidade = "	. tratarStr($this->txtNaoConformidade);
			$sql .= ", txt_determinacao = "	. tratarStr($this->txtDeterminacao);
			$sql .= ", nr_dias_prazo_determinacao = "	. tratarStr($this->nrDiasPrazoDeterminacao);
			$sql .= ", txt_responsavel = "	. tratarStr($this->txtResponsavel);
			$sql .= ", nr_dias_prazo_responsavel = "	. tratarStr($this->nrDiasResponsavel);
			$sql .= ", txt_observacao = "	. tratarStr($this->txtObservacao);
			$sql .= ", cod_usuario = " . $acesso->usuario->id;
			$sql .= ", dt_atualizacao = " . dataAtual();

		$sql .= " WHERE cod_pch_estabelecimento = " . tratarStr($this->id);

		$qtLin = $acesso->exec($sql);
		Auditoria(19,'Item do PCH alterado', $sql);

		//grava o historico do PCH

		$sql = "INSERT INTO sigech.tb_historico_pch_estabelecimento (
			cod_pch_estabelecimento, cod_estabelecimento, cod_local_vistoria, dt_cadastro, nr_item,
			txt_nao_conformidade, txt_determinacao, nr_dias_prazo_determinacao,
			txt_responsavel, nr_dias_prazo_responsavel, txt_observacao, cod_usuario, dt_atualizacao
		) VALUES (";

		$sql .= tratarStr($this->id);
		$sql .= ", " . tratarStr($this->idEstabelecimento);
		$sql .= ", " . tratarStr($this->idLocalVistoria);
		$sql .= ", " . tratarData($this->dtCadastro);
		$sql .= ", " . tratarStr($this->nrItem);
		
		$sql .= ", " . tratarStr($this->txtNaoConformidade);
		$sql .= ", " . tratarStr($this->txtDeterminacao);
		$sql .= ", " . tratarStr($this->nrDiasPrazoDeterminacao);
		$sql .= ", " . tratarStr($this->txtResponsavel);
		$sql .= ", " . tratarStr($this->nrDiasResponsavel);
		$sql .= ", " . tratarStr($this->txtObservacao);
		$sql .= ", " . $acesso->usuario->id;
		$sql .= ", " . dataAtual();
	$sql .= ")";

	$qtLin = $acesso->exec($sql);
		
		
		
		return ($qtLin > 0);
	}




	function excluir(){

		global $acesso;


		$sql = "DELETE FROM sigech.tb_pch_estabelecimento ";
		$sql .= " WHERE cod_pch_estabelecimento = " . tratarStr($this->id);

		$qtLin = $acesso->exec($sql);
		Auditoria(20,'Item do PCH excluído', $sql);

		return ($qtLin > 0);
	}

	function incluir(){

		global $acesso;

		
		$sql = "INSERT INTO sigech.tb_pch_estabelecimento (
				cod_estabelecimento, cod_local_vistoria, dt_cadastro, nr_item,
                txt_nao_conformidade, txt_determinacao, nr_dias_prazo_determinacao,
				txt_responsavel, nr_dias_prazo_responsavel, cod_usuario, dt_atualizacao
			) VALUES (";

			$sql .= tratarStr($this->idEstabelecimento);
			$sql .= ", " . tratarStr($this->idLocalVistoria);
			$sql .= ", " . tratarData($this->dtCadastro);
			$sql .= ", " . tratarStr($this->nrItem);
			
			$sql .= ", " . tratarStr($this->txtNaoConformidade);
			$sql .= ", " . tratarStr($this->txtDeterminacao);
			$sql .= ", " . tratarStr($this->nrDiasPrazoDeterminacao);
			$sql .= ", " . tratarStr($this->txtResponsavel);
			$sql .= ", " . tratarStr($this->nrDiasResponsavel);
			$sql .= ", " . $acesso->usuario->id;
			$sql .= ", " . dataAtual();
		$sql .= ")";

		$qtLin = $acesso->exec($sql);

		Auditoria(21,'Item do PCH cadastrado', $sql);


		//grava o historico do PCH

		if ($qtLin > 0){
			$this->carregarId();
		}

		$sql = "INSERT INTO sigech.tb_historico_pch_estabelecimento (
			cod_pch_estabelecimento, cod_estabelecimento, cod_local_vistoria, dt_cadastro, nr_item,
			txt_nao_conformidade, txt_determinacao, nr_dias_prazo_determinacao,
			txt_responsavel, nr_dias_prazo_responsavel, cod_usuario, dt_atualizacao
		) VALUES (";

		$sql .= tratarStr($this->id);
		$sql .= ", " . tratarStr($this->idEstabelecimento);
		$sql .= ", " . tratarStr($this->idLocalVistoria);
		$sql .= ", " . tratarData($this->dtCadastro);
		$sql .= ", " . tratarStr($this->nrItem);
		
		$sql .= ", " . tratarStr($this->txtNaoConformidade);
		$sql .= ", " . tratarStr($this->txtDeterminacao);
		$sql .= ", " . tratarStr($this->nrDiasPrazoDeterminacao);
		$sql .= ", " . tratarStr($this->txtResponsavel);
		$sql .= ", " . tratarStr($this->nrDiasResponsavel);
		$sql .= ", " . $acesso->usuario->id;
		$sql .= ", " . dataAtual();
	$sql .= ")";

	$qtLin = $acesso->exec($sql);

		return ($qtLin > 0);
	}

	function carregarId(){
		global $acesso;

		$sql = "SELECT MAX(cod_pch_estabelecimento) FROM sigech.tb_pch_estabelecimento";
		$rs = $acesso->getRs($sql);

		if ($linha = pg_fetch_row($rs)){
			$this->id = $linha[0];
		}
	}


	
}
?>
 