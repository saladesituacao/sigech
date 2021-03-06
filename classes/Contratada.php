<?php
//error_reporting(0);
include("Auditoria.php");
class Contratada{

	public $id;
	public $idEstabelecimento;
	public $txtObjetoContratacao;
	public $nrContrato;
	public $dtVigencia;
	public $nrProcesso;
	public $idUsuario;
	public $dtAtualizacao;
	public $indHabilitado;
	public $nmEstabelecimento;
	
	public $idServico;
	public $areaHabilitado;
	public $nrServico;
	public $nmServico;

 

	//Carrega os parametros com o nome do estabelecimento e nome do serviço com potencial de habilitação
	private function carregarParametros($rs){

		if ($linha = pg_fetch_row($rs)){
			// Carregar parametros
			
			$this-> id = $linha[0];;
			$this-> idEstabelecimento = $linha[1];
			$this-> txtObjetoContratacao = $linha[2];
			$this-> nrContrato = $linha[3];
			$this-> dtVigencia = $linha[4];
			$this-> nrProcesso = $linha[5];
			$this-> idUsuario = $linha[6];
			$this-> dtAtualizacao = $linha[7];
			$this-> indHabilitado = $linha[8];
			$this-> nmEstabelecimento = $linha[9];
			$this-> idServico = $linha[10];
			$this-> areaHabilitado = $linha[11];
			$this-> nrServico = $linha[12];
			$this-> nmServico = $linha[13];

			return true;
		}else{
			return false;
		}
	}

 
	 
//Carrega os parametros com o nome do estabelecimento e nome do serviço com potencial de habilitação
	function carregar($_id){
		global $acesso;

		$sql = "
		SELECT

		sc.cod_servico_contratada,
		sc.cod_estabelecimento,
		sc.txt_objeto_contratacao,
		sc.nr_contrato,
		sc.dt_vigencia,
		sc.nr_processo,
		sc.cod_usuario,
		sc.dt_atualizacao,
		sc.ind_habilitado,
			e.nm_estabelecimento,
			sc.cod_servico,
			ab.nr_area_habilitacao,
			s.nr_servico,
			s.nm_servico

FROM
	sigech.tb_servico_contratada sc
INNER JOIN sigech.tb_estabelecimento e
	ON sc.cod_estabelecimento = e.cod_estabelecimento
left join sigech.tb_servico s
	on sc.cod_servico = s.cod_servico
left join sigech.tb_area_habilitacao ab
	on s.cod_area_habilitacao   = ab.cod_area_habilitacao
WHERE 1 = 1
AND cod_servico_contratada = " . tratarStr($_id) ;


		$resultado = $acesso->getRs($sql);

		return $this->carregarParametros($resultado);

	}


	function alterarServicoContratada(){
  
		global $acesso;


		$sql = "UPDATE sigech.tb_servico_contratada SET ";
		$sql .= " txt_objeto_contratacao = " . tratarStr($this->txtObjetoContratacao);
		$sql .= ", nr_contrato = " . tratarStr($this->nrContrato);
		$sql .= ", dt_vigencia = " . tratarData($this->dtVigencia);
		$sql .= ", nr_processo = " . tratarStr($this->nrProcesso);
		$sql .= ", cod_usuario = " . tratarStr($acesso->usuario->id);
		$sql .= ", dt_atualizacao = " . dataAtual();
		$sql .= ", cod_servico = " . tratarStr($this->idServico);

				

		$sql .= " WHERE cod_servico_contratada = " . tratarStr($this->id);

		

		$qtLin = $acesso->exec($sql);
		Auditoria(60,'Serviço contratado alterado', $sql);

		

		//grava o historico
		$sql = "INSERT INTO sigech.tb_historico_servico_contratada (
					
			cod_servico_contratada, cod_estabelecimento, txt_objeto_contratacao, nr_contrato, dt_vigencia,
			nr_processo, cod_usuario, dt_atualizacao
		) VALUES (";
		$sql .= tratarStr($this->id);
		$sql .= ", " . tratarStr($this->idEstabelecimento );
		$sql .= ", " . tratarStr($this->txtObjetoContratacao );
		$sql .= ", " . tratarStr($this->nrContrato );
		$sql .= ", " . tratarData($this->dtVigencia );
		$sql .= ", " . tratarStr($this->nrProcesso );
		$sql .= ", " . tratarStr($acesso->usuario->id );
		$sql .= ", " . dataAtual();
	$sql .= ")";

	$qtLin = $acesso->exec($sql);

	return ($qtLin > 0);
		
	}



	function desativarServicoContratada(){
  
		global $acesso;
		

		$sql = "UPDATE sigech.tb_servico_contratada SET ";
		$sql .= " ind_habilitado = 'N'";
		$sql .= ", cod_usuario = " . tratarStr($acesso->usuario->id);
		$sql .= ", dt_atualizacao = " . dataAtual();

				

		$sql .= " WHERE cod_servico_contratada = " . tratarStr($this->id);


		$qtLin = $acesso->exec($sql);
		Auditoria(61,'Serviço contratado desativado', $sql);

		

		//grava o historico
		$sql = "
		
		
		INSERT INTO sigech.tb_historico_servico_contratada (cod_servico_contratada, cod_estabelecimento, txt_objeto_contratacao, nr_contrato, dt_vigencia,
			nr_processo, cod_usuario, dt_atualizacao, ind_habilitado)

		SELECT cod_servico_contratada, cod_estabelecimento, txt_objeto_contratacao, nr_contrato, dt_vigencia,
			nr_processo, cod_usuario, dt_atualizacao, ind_habilitado FROM sigech.tb_servico_contratada WHERE cod_servico_contratada =" . $this->id;

	$qtLin = $acesso->exec($sql);
	
	return ($qtLin > 0);
		
	}


	function incluirServicoContratada(){

		global $acesso;

		

		$sql = "INSERT INTO sigech.tb_servico_contratada (
				
				cod_estabelecimento, txt_objeto_contratacao, nr_contrato, dt_vigencia,
				nr_processo, cod_usuario, dt_atualizacao, cod_servico
			) VALUES (";
			$sql .= tratarStr($this->idEstabelecimento);
			$sql .= ", " . tratarStr($this->txtObjetoContratacao );
  			$sql .= ", " . tratarStr($this->nrContrato );
  			$sql .= ", " . tratarData($this->dtVigencia );
  			$sql .= ", " . tratarStr($this->nrProcesso );
  			$sql .= ", " . tratarStr($acesso->usuario->id );
			$sql .= ", " . dataAtual();
			$sql .= ", " . tratarStr($this->idServico );
		$sql .= ")";

		$qtLin = $acesso->exec($sql);
		
		Auditoria(62,'Serviço contratado incluído', $sql);

		if ($qtLin > 0){
			$this->carregarId();
		}


		//grava o historico
			$sql = "INSERT INTO sigech.tb_historico_servico_contratada (
					
				cod_servico_contratada, cod_estabelecimento, txt_objeto_contratacao, nr_contrato, dt_vigencia,
				nr_processo, cod_usuario, dt_atualizacao, cod_servico
			) VALUES (";
			$sql .= tratarStr($this->id);
			$sql .= ", " . tratarStr($this->idEstabelecimento );
			$sql .= ", " . tratarStr($this->txtObjetoContratacao );
			$sql .= ", " . tratarStr($this->nrContrato );
			$sql .= ", " . tratarData($this->dtVigencia );
			$sql .= ", " . tratarStr($this->nrProcesso );
			$sql .= ", " . tratarStr($acesso->usuario->id );
			$sql .= ", " . dataAtual();
			$sql .= ", " . tratarStr($this->idServico );
		$sql .= ")";

		$qtLin = $acesso->exec($sql);
	
		
		return ($qtLin > 0);
	}


	function carregarId(){
		global $acesso;

		$sql = "SELECT MAX(cod_servico_contratada) FROM sigech.tb_servico_contratada";
		$rs = $acesso->getRs($sql);

		if ($linha = pg_fetch_row($rs)){
			$this->id = $linha[0];
		}
	}


}
?>
