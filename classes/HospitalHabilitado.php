<?php
//error_reporting(0);
include("Auditoria.php");
class HospitalHabilitado{

	public $id;
	public $areaHabilitado;
	public $idServico;
	public $codServico;
	public $nrServico;
	public $nmServico;
	public $idEstabelecimento;
	public $nmEstabelecimento;
	public $valor;
	public $dsPortaria;
	public $numLeito;
	public $dsObservacao;
	public $dtHabilitacao;
	public $dtDesabilitacao;
	public $dsJustificativaDesabilitacao;
	public $urlPortaria;


	//Dados para cumprimento do PCH
	public $idPchEstabelecimento;
	public $dtCumprimento;
	public $obsPCHtemp;	
	public $obsPCH;			
	public $txtResponsavel;		
	public $nrDiasPrazoResponsavel;		
	


	private function carregarParametros($rs){

		if ($linha = pg_fetch_row($rs)){
			// Carregar parametros

			$this->id = $linha[0];
			$this->idEstabelecimento = $linha[1];
			$this->valor = $linha[2];
			$this->dsPortaria = $linha[3];
			$this->nrLeito = $linha[4];
			$this->dtHabilitacao = $linha[5];
			$this->dtDesabilitacao = $linha[6];
			$this->dsjustificativaDesabilitacao = $linha[7];
			$this->urlPportaria = $linha[8];

			return true;
		}else{
			return false;
		}
	}

	//Carrega os parametros com o nome do estabelecimento e nome do serviço
	private function carregarParametros2($rs){

		if ($linha = pg_fetch_row($rs)){
			// Carregar parametros
			
			$this-> id = $linha[0];;
			$this-> areaHabilitado = $linha[1];
			$this-> idServico = $linha[2];
			$this-> nrServico = $linha[3];
			$this-> nmServico = $linha[4];
			$this-> idEstabelecimento = $linha[5];
			$this-> nmEstabelecimento = $linha[6];
			$this-> valor = $linha[7];
			$this-> dsPortaria = $linha[8];
			$this-> nrLeitos = $linha[9];
			$this-> dsObservacao = $linha[10];
			$this-> dtHabilitacao = $linha[11];
			$this-> dtDesabilitacao = $linha[12];
			$this-> dsJustificativaDesabilitacao = $linha[13];
			$this-> urlPortaria = $linha[14];
			
			return true;
		}else{
			return false;
		}
	}


	function carregar($_id){
		global $acesso;

		$sql = "SELECT cod_servico_habilitado_estabelecimento, cod_estabelecimento, vl_valor, ds_portaria,
						nr_leitos, dt_habilitacao, dt_desabilitacao, 
						ds_justificativa_desabilitacao, txt_url_portaria
				FROM sigech.tb_servico_habilitado_estabelecimento WHERE
				cod_servico_habilitado_estabelecimento=" . tratarStr($_id);

		$resultado = $acesso->getRs($sql);

		return $this->carregarParametros($resultado);

	}
 
//Carrega os parametros com o nome do estabelecimento e nome do serviço
	function carregar2($_id, $_idEstab){
		global $acesso;

		$sql = "select 
		she.cod_servico_habilitado_estabelecimento, ab.nr_area_habilitacao, she.cod_servico, s.nr_servico, s.nm_servico, she.cod_estabelecimento, e.nm_estabelecimento,
		she.vl_valor, she.ds_portaria, she.nr_leitos, she.ds_observacao, she.dt_habilitacao, she.dt_desabilitacao, she.ds_justificativa_desabilitacao, she.txt_url_portaria
		from sigech.tb_servico_habilitado_estabelecimento she
		inner join sigech.tb_servico s
		on she.cod_servico = s.cod_servico
		inner join sigech.tb_estabelecimento e
		on she.cod_estabelecimento = e.cod_estabelecimento
		inner join sigech.tb_area_habilitacao ab
		on s.cod_area_habilitacao   = ab.cod_area_habilitacao
		where she.ind_habilitado = 'S'
		and she.cod_servico_habilitado_estabelecimento=" . tratarStr($_id) . 
		"and she.cod_estabelecimento = " . tratarStr($_idEstab) ;


		$resultado = $acesso->getRs($sql);

		return $this->carregarParametros2($resultado);

	}

 
	function alterarServicoHabilitado(){

		global $acesso;

		$sql = "UPDATE sigech.tb_servico_habilitado_estabelecimento SET ";
		$sql .= " vl_valor = " . tratarStr(retornarNumeros($this->valor));

		if ($this->codServico != '0'){
			$sql .= ", cod_servico = " . tratarStr($this->codServico);	
		}

		$sql .= ", ds_portaria = " . tratarStr($this->dsPortaria);
		$sql .= ", nr_leitos = " . tratarStr(retornarNumeros($this->nrLeitos));
		$sql .= ", ds_observacao = " . tratarStr($this->dsObservacao);
		$sql .= ", txt_url_portaria = " . tratarStr($this->urlPortaria);

		$sql .= " WHERE cod_servico_habilitado_estabelecimento = " . tratarStr($this->id);


//echo $sql;
//exit();

		$qtLin = $acesso->exec($sql);
		Auditoria(24,'Serviço habilitado hospitalar alterado', $sql);

		

		return ($qtLin > 0);
		
	}

 
	function incluirServicoHabilitado(){

		global $acesso;


 
		if ($this->servicoRepetido()){
			alert('O serviço já foi adicionado!');
			submeter('hospital_servico_habilitado_add.php', 'cod_estabelecimento', $this->idEstabelecimento);
			return false;
		}


 
		$sql = "INSERT INTO sigech.tb_servico_habilitado_estabelecimento (
				
				cod_servico, cod_estabelecimento, vl_valor, ds_portaria, nr_leitos,
				ds_observacao, dt_habilitacao, txt_url_portaria
			) VALUES (";
			$sql .= tratarStr($this->codServico);
			$sql .= ", " . tratarStr($this->idEstabelecimento);
			$sql .= ", " . tratarStr(retornarNumeros($this->valor));
			$sql .= ", " . tratarStr($this->dsPortaria);
			$sql .= ", " . tratarStr(retornarNumeros($this->nrLeitos));
			$sql .= ", " . tratarStr($this->dsObservacao );
			$sql .= ", " . tratarData($this->dtHabilitacao );
  			$sql .= ", " . tratarStr($this->urlPortaria );

		$sql .= ")";



		//echo $sql; exit;

		$qtLin = $acesso->exec($sql);
		Auditoria(67,'Serviço Habilitado incluído', $sql);

		return ($qtLin > 0);
	}


	function servicoRepetido(){

		global $acesso;

		$sql = "SELECT cod_servico_habilitado_estabelecimento
				FROM sigech.tb_servico_habilitado_estabelecimento WHERE
				
				cod_servico=" . tratarStr($this->idServico) . 
				
				" AND cod_estabelecimento=" . tratarStr($this->idEstabelecimento);
				;

		$resultado = $acesso->getRs($sql);

		return pg_num_rows($resultado)>0;

	}


	function editarNC(){

		global $acesso;


		$sql = "UPDATE sigech.tb_pch_estabelecimento SET ";
		$sql .= " txt_responsavel = " . tratarStr($this->txtResponsavel);
		$sql .= ", nr_dias_prazo_responsavel = " . tratarStr($this->nrDiasPrazoResponsavel);
		$sql .= ", cod_usuario = " . $acesso->usuario->id;
		$sql .= ", dt_atualizacao = " . dataAtual();

		$sql .= " WHERE cod_pch_estabelecimento = " . tratarStr($this->idPchEstabelecimento);

		$qtLin = $acesso->exec($sql);
		Auditoria(19,'Item do PCH alterado', $sql);



		$sqlHist = "INSERT INTO sigech.tb_historico_pch_estabelecimento
		(cod_pch_estabelecimento, cod_estabelecimento, cod_local_vistoria, dt_cadastro, nr_item, txt_nao_conformidade, txt_determinacao,
		nr_dias_prazo_determinacao,txt_responsavel, nr_dias_prazo_responsavel, dt_cumprimento, txt_observacao, cod_usuario, dt_atualizacao)
		(SELECT  cod_pch_estabelecimento, cod_estabelecimento, cod_local_vistoria, dt_cadastro, nr_item, txt_nao_conformidade, txt_determinacao,
		nr_dias_prazo_determinacao,txt_responsavel, nr_dias_prazo_responsavel, dt_cumprimento, txt_observacao, cod_usuario, dt_atualizacao FROM sigech.tb_pch_estabelecimento WHERE cod_pch_estabelecimento = " . $this->idPchEstabelecimento . ")";
		$qtLin = $acesso->exec($sqlHist);



		return ($qtLin > 0);
		
	}




	function cumprimentoNC(){

		global $acesso;


		$this->obsPCH = $this->obsPCHtemp;

		$sql = "UPDATE sigech.tb_pch_estabelecimento SET ";
		$sql .= " txt_observacao = " . tratarStr($this->obsPCH);
		$sql .= ", cod_usuario = " . $acesso->usuario->id;
		$sql .= ", dt_atualizacao = " . dataAtual();

		$sql .= " WHERE cod_pch_estabelecimento = " . tratarStr($this->idPchEstabelecimento);



		$qtLin = $acesso->exec($sql);
		Auditoria(26,'Observação da NC hospitalar informada', $sql);



		$sqlHist = "INSERT INTO sigech.tb_historico_pch_estabelecimento
		(cod_pch_estabelecimento, cod_estabelecimento, cod_local_vistoria, dt_cadastro, nr_item, txt_nao_conformidade, txt_determinacao,
		nr_dias_prazo_determinacao,txt_responsavel, nr_dias_prazo_responsavel, dt_cumprimento, txt_observacao, cod_usuario, dt_atualizacao)
		(SELECT  cod_pch_estabelecimento, cod_estabelecimento, cod_local_vistoria, dt_cadastro, nr_item, txt_nao_conformidade, txt_determinacao,
		nr_dias_prazo_determinacao,txt_responsavel, nr_dias_prazo_responsavel, dt_cumprimento, txt_observacao, cod_usuario, dt_atualizacao FROM sigech.tb_pch_estabelecimento WHERE cod_pch_estabelecimento = " . $this->idPchEstabelecimento . ")";
		$qtLin = $acesso->exec($sqlHist);



		return ($qtLin > 0);
		
	}


	function reabrirNC(){

		global $acesso;


		$this->obsPCH = $this->obsPCHtemp;

		$sql = "UPDATE sigech.tb_pch_estabelecimento SET ";
		$sql .= " dt_cumprimento = NULL ";
		$sql .= ", txt_observacao = " . tratarStr($this->obsPCH);
		$sql .= ", cod_usuario = " . $acesso->usuario->id;
		$sql .= ", dt_atualizacao = " . dataAtual();
		$sql .= ", ind_habilitado = 'S' ";

		$sql .= " WHERE cod_pch_estabelecimento = " . tratarStr($this->idPchEstabelecimento);

		$qtLin = $acesso->exec($sql);
		Auditoria(51,'NC hospitalar reaberta', $sql);



		$sqlHist = "INSERT INTO sigech.tb_historico_pch_estabelecimento
		(cod_pch_estabelecimento, cod_estabelecimento, cod_local_vistoria, dt_cadastro, nr_item, txt_nao_conformidade, txt_determinacao,
		nr_dias_prazo_determinacao,txt_responsavel, nr_dias_prazo_responsavel, dt_cumprimento, txt_observacao, cod_usuario, dt_atualizacao)
		(SELECT  cod_pch_estabelecimento, cod_estabelecimento, cod_local_vistoria, dt_cadastro, nr_item, txt_nao_conformidade, txt_determinacao,
		nr_dias_prazo_determinacao,txt_responsavel, nr_dias_prazo_responsavel, dt_cumprimento, txt_observacao, cod_usuario, dt_atualizacao FROM sigech.tb_pch_estabelecimento WHERE cod_pch_estabelecimento = " . $this->idPchEstabelecimento . ")";
		$qtLin = $acesso->exec($sqlHist);



		return ($qtLin > 0);
		
	}



	function finalizarNC(){

		global $acesso;

		$sql = "UPDATE sigech.tb_pch_estabelecimento SET ";
		$sql .= " dt_cumprimento = " . tratarData($this->dtCumprimento);
		$sql .= ", cod_usuario = " . $acesso->usuario->id;
		$sql .= ", dt_atualizacao = " . dataAtual();
		$sql .= " WHERE cod_pch_estabelecimento = " . tratarStr($this->idPchEstabelecimento);

		$qtLin = $acesso->exec($sql);
		Auditoria(22,'Item do PCH finalizado', $sql);

		$sqlHist = "INSERT INTO sigech.tb_historico_pch_estabelecimento
		(cod_pch_estabelecimento, cod_estabelecimento, cod_local_vistoria, dt_cadastro, nr_item, txt_nao_conformidade, txt_determinacao,
		nr_dias_prazo_determinacao,txt_responsavel, nr_dias_prazo_responsavel, dt_cumprimento, txt_observacao, cod_usuario, dt_atualizacao)
		(SELECT  cod_pch_estabelecimento, cod_estabelecimento, cod_local_vistoria, dt_cadastro, nr_item, txt_nao_conformidade, txt_determinacao,
		nr_dias_prazo_determinacao,txt_responsavel, nr_dias_prazo_responsavel, dt_cumprimento, txt_observacao, cod_usuario, dt_atualizacao FROM sigech.tb_pch_estabelecimento WHERE cod_pch_estabelecimento = " . $this->idPchEstabelecimento . ")";
		$qtLin = $acesso->exec($sqlHist);

		return ($qtLin > 0);
		
	}




	function finalizarNCD(){

		global $acesso;

		$sql = "UPDATE sigech.tb_pch_estabelecimento SET ";
		$sql .= " ind_habilitado = 'N'";
		$sql .= ", cod_usuario = " . $acesso->usuario->id;
		$sql .= ", dt_atualizacao = " . dataAtual();
		$sql .= " WHERE cod_pch_estabelecimento = " . tratarStr($this->idPchEstabelecimento);



		$qtLin = $acesso->exec($sql);
		Auditoria(50,'NC finalizada definitivamente', $sql);

		$sqlHist = "INSERT INTO sigech.tb_historico_pch_estabelecimento
		(cod_pch_estabelecimento, cod_estabelecimento, cod_local_vistoria, dt_cadastro, nr_item, txt_nao_conformidade, txt_determinacao,
		nr_dias_prazo_determinacao,txt_responsavel, nr_dias_prazo_responsavel, dt_cumprimento, txt_observacao, cod_usuario, dt_atualizacao)
		(SELECT  cod_pch_estabelecimento, cod_estabelecimento, cod_local_vistoria, dt_cadastro, nr_item, txt_nao_conformidade, txt_determinacao,
		nr_dias_prazo_determinacao,txt_responsavel, nr_dias_prazo_responsavel, dt_cumprimento, txt_observacao, cod_usuario, dt_atualizacao FROM sigech.tb_pch_estabelecimento WHERE cod_pch_estabelecimento = " . $this->idPchEstabelecimento . ")";
		$qtLin = $acesso->exec($sqlHist);

		return ($qtLin > 0);
		
	}


	function desabilitarServico(){

		global $acesso;

		$sql = "UPDATE sigech.tb_servico_habilitado_estabelecimento SET ";
		$sql .= " dt_desabilitacao = " . dataAtual();	
		$sql .= ", ds_justificativa_desabilitacao = " . tratarStr($this->dsJustificativaDesabilitacao);
		$sql .= ", ind_habilitado = 'N'";

		$sql .= " WHERE cod_servico_habilitado_estabelecimento = " . tratarStr($this->id);

		$qtLin = $acesso->exec($sql);
		Auditoria(25,'Serviço hospitalar desabilitado', $sql);

		

		return ($qtLin > 0);
		
	}





	
	
}
?>
