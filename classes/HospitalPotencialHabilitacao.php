<?php
//error_reporting(0);
include("Auditoria.php");
class HospitalPotencialHabilitacao{

	public $id;
	public $areaHabilitacao;
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
	public $dsNrProcesso;
	public $dsMeioProcesso;
	public $dsLocalizacaoProcesso;
	public $urlPortaria;
	public $nrProcessoSei;
 
//variavel para relacionamento das etapas do processo
	public $dtTemp;

//Variaveis para finalizar a etapa do processo de habilitação
public $dtFinalizacao;
public $idAndamento;

 

	//Carrega os parametros com o nome do estabelecimento e nome do serviço com potencial de habilitação
	private function carregarParametros($rs){

		if ($linha = pg_fetch_row($rs)){
			// Carregar parametros
			
			$this-> id = $linha[0];;
			$this-> areaHabilitacao = $linha[1];
			$this-> idServico = $linha[2];
			$this-> nrServico = $linha[3];
			$this-> nmServico = $linha[4];
			$this-> idEstabelecimento = $linha[5];
			$this-> nmEstabelecimento = $linha[6];
			$this-> valor = $linha[7];
			$this-> dsPortaria = $linha[8];
			$this-> nrLeitos = $linha[9];
			$this-> dsObservacao = $linha[10];
			$this-> dsNrProcesso = $linha[11];
			$this-> dsMeioProcesso = $linha[12];
			$this-> dsLocalizacaoProcesso = $linha[13];
			$this-> urlPortaria = $linha[14];
			$this-> nrProcessoSei = $linha[15];
			
			return true;
		}else{
			return false;
		}
	}


	 
//Carrega os parametros com o nome do estabelecimento e nome do serviço com potencial de habilitação
	function carregar($_id, $_idEstab){
		global $acesso;

		$sql = "
		SELECT
	sphe.cod_servico_potencial_habilitacao_estabelecimento,
	ab.nr_area_habilitacao,
	sphe.cod_servico,
	s.nr_servico,
	s.nm_servico,
	sphe.cod_estabelecimento,
	e.nm_estabelecimento,
	sphe.vl_valor,
	sphe.ds_portaria,
	sphe.nr_leitos,
	sphe.ds_observacao,
	sphe.ds_nr_processo,
	sphe.ds_meio_processo,
	sphe.ds_localizacao_processo,
	sphe.txt_url_portaria,
	sphe.txt_nr_processo_sei
FROM
	sigech.tb_servico_potencial_habilitacao_estabelecimento sphe
INNER JOIN sigech.tb_servico s ON sphe.cod_servico = s.cod_servico
INNER JOIN sigech.tb_estabelecimento e ON sphe.cod_estabelecimento = e.cod_estabelecimento
INNER JOIN sigech.tb_area_habilitacao ab ON s.cod_area_habilitacao = ab.cod_area_habilitacao
WHERE 1 = 1
AND sphe.cod_servico_potencial_habilitacao_estabelecimento = " . tratarStr($_id) .
" AND sphe.cod_estabelecimento = " . tratarStr($_idEstab) ;


		$resultado = $acesso->getRs($sql);

		return $this->carregarParametros($resultado);

	}


	function alterarServicoPotencialHabilitacao(){
  
		global $acesso;

		$sql = "UPDATE sigech.tb_servico_potencial_habilitacao_estabelecimento SET ";
		$sql .= " vl_valor = " . tratarStr(retornarNumeros($this->valor));
		
		if ($this->codServico != '0'){
			$sql .= ", cod_servico = " . tratarStr($this->codServico);	
		}
		
		$sql .= ", ds_portaria = " . tratarStr($this->dsPortaria);
		$sql .= ", nr_leitos = " . tratarStr($this->nrLeitos);
		$sql .= ", ds_observacao = " . tratarStr($this->dsObservacao);

		$sql .= ", ds_nr_processo = " . tratarStr($this->dsNrProcesso);
		$sql .= ", ds_meio_processo = " . tratarStr($this->dsMeioProcesso);
		$sql .= ", ds_localizacao_processo = " . tratarStr($this->dsLocalizacaoProcesso);

		$sql .= ", txt_url_portaria = " . tratarStr($this->urlPortaria);
		$sql .= ", txt_nr_processo_sei = " . tratarStr($this->nrProcessoSei);

		

		$sql .= " WHERE cod_servico_potencial_habilitacao_estabelecimento = " . tratarStr($this->id);

		//echo $sql;
		//exit();

		$qtLin = $acesso->exec($sql);
		Auditoria(27,'Serviço com potencial de habilitação hospitalar alterado', $sql);

		

		return ($qtLin > 0);
		
	}




	function incluirServicoPotencialHabilitacao(){

		global $acesso;


 
		if ($this->servicoRepetido()){
			alert('O serviço já foi adicionado!');
			submeter('hospital_servico_potencial_habilitacao_add.php', 'cod_estabelecimento', $this->idEstabelecimento);
			return false;
		}


 
		$sql = "INSERT INTO sigech.tb_servico_potencial_habilitacao_estabelecimento (
				
				cod_servico, cod_estabelecimento, vl_valor, ds_portaria, nr_leitos,
				ds_observacao, ds_nr_processo, ds_meio_processo, ds_localizacao_processo,
				txt_url_portaria, txt_nr_processo_sei
			) VALUES (";
			$sql .= tratarStr($this->idServico);
			$sql .= ", " . tratarStr($this->idEstabelecimento);
			$sql .= ", " . tratarStr(retornarNumeros($this->valor));
			$sql .= ", " . tratarStr($this->dsPortaria);
			$sql .= ", " . tratarStr(retornarNumeros($this->nrLeitos));
  			$sql .= ", " . tratarStr($this->dsObservacao );
  			$sql .= ", " . tratarStr($this->dsNrProcesso );
  			$sql .= ", " . tratarStr($this->dsMeioProcesso );
  			$sql .= ", " . tratarStr($this->dsLocalizacaoProcesso );
  			$sql .= ", " . tratarStr($this->urlPortaria );
  			$sql .= ", " . tratarStr($this->nrProcessoSei );
		$sql .= ")";

		$qtLin = $acesso->exec($sql);
		Auditoria(28,'Serviço com potencial de habilitação hospitalar incluído', $sql);

		if ($qtLin > 0){
			$this->carregarId();
		}


		//inclusão das etapas de monitoramento.

		$sql2 = "SELECT cod_etapa_processo_habilitacao, qtd_dias FROM sigech.tb_etapa_processo_habilitacao WHERE ind_habilitado = 'S' ORDER BY 1 ASC";
		$resultado = $acesso->getRs($sql2);

		while ($linha = pg_fetch_row($resultado)){
			
			$sqlTemp = "INSERT INTO sigech.tb_andamento_processo_habilitacao (
				cod_servico_potencial_habilitacao_estabelecimento, cod_etapa_processo_habilitacao,
				dt_inicio_andamento_processo, dt_fim_andamento_processo, qtd_dias_andamento_processo
				) VALUES (";
				$sqlTemp .= tratarStr($this->id);
				$sqlTemp .= ", " . tratarStr($linha[0]);
				$sqlTemp .= ", " . tratarData($this->dtTemp);
				
				//Adicionando dias a data inicial
				$this->dtTemp = date('d/m/Y', strtotime("+" . $linha[1] . " days",strtotime(tratarDataSemAspas($this->dtTemp))));
				$sqlTemp .= ", " . tratarData($this->dtTemp);
				$sqlTemp .= ", " . tratarStr($linha[1]);
				$sqlTemp .= ")";
				$acesso->exec($sqlTemp);
		}
		
		return ($qtLin > 0);
	}


	function carregarId(){
		global $acesso;

		$sql = "SELECT MAX(cod_servico_potencial_habilitacao_estabelecimento) FROM sigech.tb_servico_potencial_habilitacao_estabelecimento";
		$rs = $acesso->getRs($sql);

		if ($linha = pg_fetch_row($rs)){
			$this->id = $linha[0];
		}
	}



	function servicoRepetido(){

		global $acesso;

		$sql = "SELECT cod_servico_potencial_habilitacao_estabelecimento
				FROM sigech.tb_servico_potencial_habilitacao_estabelecimento WHERE
				
				cod_servico=" . tratarStr($this->idServico) . 
				
				" AND cod_estabelecimento=" . tratarStr($this->idEstabelecimento);
				;

		$resultado = $acesso->getRs($sql);

		return pg_num_rows($resultado)>0;

	}



	



	function gerarEtapasProcessoHabilitacao(){

		global $acesso;



		$sql = "DELETE FROM sigech.tb_andamento_processo_habilitacao ";
		$sql .= " WHERE cod_servico_potencial_habilitacao_estabelecimento = " . tratarStr($this->id);
 
		
		$qtLin = $acesso->exec($sql);

		
		//inclusão das etapas de monitoramento.

		$sql2 = "SELECT cod_etapa_processo_habilitacao, qtd_dias FROM sigech.tb_etapa_processo_habilitacao WHERE ind_habilitado = 'S' ORDER BY 1 ASC";
		$resultado = $acesso->getRs($sql2);

		while ($linha = pg_fetch_row($resultado)){
			
			$sqlTemp = "INSERT INTO sigech.tb_andamento_processo_habilitacao (
				cod_servico_potencial_habilitacao_estabelecimento, cod_etapa_processo_habilitacao,
				dt_inicio_andamento_processo, dt_fim_andamento_processo, qtd_dias_andamento_processo
				) VALUES (";
				$sqlTemp .= tratarStr($this->id);
				$sqlTemp .= ", " . tratarStr($linha[0]);
				$sqlTemp .= ", " . tratarData($this->dtTemp);
				
				//Adicionando dias a data inicial
				$this->dtTemp = date('d/m/Y', strtotime("+" . $linha[1] . " days",strtotime(tratarDataSemAspas($this->dtTemp))));
				$sqlTemp .= ", " . tratarData($this->dtTemp);
				$sqlTemp .= ", " . tratarStr($linha[1]);
				$sqlTemp .= ")";
				$acesso->exec($sqlTemp);
		}
		Auditoria(29,'Etapas do processo de habilitação de serviços hospitalares gerado', $sql);
		return ($qtLin > 0);
	}





	function finalizarEtapaProcessoHabilitacao(){
  
		global $acesso;

		$sql = "UPDATE sigech.tb_andamento_processo_habilitacao SET ";
		$sql .= " ind_finalizado = 'S'";
		$sql .= ", dt_finalizacao = " . tratarData($this->dtFinalizacao);
		$sql .= ", cod_usuario = " . $acesso->usuario->id;
		$sql .= ", dt_atualizacao = " . dataAtual();

		$sql .= " WHERE cod_andamento_processo_habilitacao = " . tratarStr($this->idAndamento);

		//echo $sql;
		//exit();

		$qtLin = $acesso->exec($sql);
		Auditoria(52,'Etapa do processo de habilitação do Serviço com potencial de habilitação hospitalar finalizado', $sql);

		

		return ($qtLin > 0);
		
	}

}
?>
