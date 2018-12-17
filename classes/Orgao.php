<?php
//error_reporting(0);
include("Auditoria.php");
class Orgao{

	public $id;
	public $sigla;
	public $descricao;
	public $ativo;
	public $codOrgaoSuperior;

	

	private function carregarParametros($rs){

		if ($linha = pg_fetch_row($rs)){
			// Carregar parametros

			$this->id = $linha[0];
			$this->sigla = $linha[1];
			$this->descricao = $linha[2];
			$this->ativo = $linha[3];
			$this->codOrgaoSuperior = $linha[4];
			
			
			return true;
		}else{
			return false;
		}
	}

	function carregar($_id){
		global $acesso;

		$sql = "SELECT cod_orgao, txt_sigla, txt_descricao, cod_ativo, cod_orgao_superior
				FROM sigech.tb_orgao WHERE
				cod_orgao=" . tratarStr($_id);

$resultado = $acesso->getRs($sql);

		return $this->carregarParametros($resultado);

	}

	function orgaoRepetido(){

		global $acesso;

		$sql = "SELECT cod_orgao
				FROM sigech.tb_orgao WHERE
				txt_sigla=" . tratarStr($this->sigla);


		if ($this->id != ''){
			$sql .= " AND cod_orgao!=" . tratarStr($this->id);
		}

		$resultado = $acesso->getRs($sql);

		return pg_num_rows($resultado)>0;

	}

	

	function incluir(){

		global $acesso;

		
		if ($this->orgaoRepetido()){
			alert('A área não está disponível!');
			return false;
		}

		$rs=pg_fetch_array(pg_query("SELECT MAX(cod_orgao) FROM sigech.tb_orgao"));
        if (!isset($rs[0])) {
            $this->id = 1;
        } else {
            $this->id = intval($rs[0]) + 1;
		}
		
		if (empty($this->codOrgaoSuperior) && strval($this->codOrgaoSuperior) != '0') {
            $this->codOrgaoSuperior = "NULL";
        }


		$sql = "INSERT INTO sigech.tb_orgao(cod_orgao, txt_sigla, txt_descricao, cod_orgao_superior, cod_usuario, dt_atualizacao) ";
        $sql .= " VALUES(".$this->id.", '".trim($this->sigla)."', '".trim($this->descricao)."', ".$this->codOrgaoSuperior.", " . $acesso->usuario->id . ", '".trim($this->sigla)."')";

	
		$qtLin = $acesso->exec($sql);
		
		Auditoria(45,'Área incluída', $sql);
		return ($qtLin > 0);
	}

	function alterar(){

		global $acesso;

		if ($this->orgaoRepetido()){
			alert('A área não está disponível!');
			return false;
		}


		if (empty($this->codOrgaoSuperior) && strval($this->codOrgaoSuperior) != '0') {
            $this->codOrgaoSuperior = "";
		}
		
		$sql = "UPDATE sigech.tb_orgao SET ";
		$sql .= " txt_sigla = "		. tratarStr($this->sigla);
		$sql .= ", txt_descricao = "	. tratarStr($this->descricao);
		$sql .= ", cod_orgao_superior = "	. tratarStr($this->codOrgaoSuperior);
		$sql .= ", cod_usuario = " . $acesso->usuario->id;
		$sql .= ", dt_atualizacao = " . dataAtual();
				

	$sql .= " WHERE cod_Orgao = " . tratarStr($this->id);


	$qtLin = $acesso->exec($sql);

		Auditoria(46,'Área alterada', $sql);

		return ($qtLin > 0);
	}


	function reativar(){

		global $acesso;

		$sql = "UPDATE sigech.tb_orgao SET ";
			$sql .= " cod_ativo = 1";
		$sql .= " WHERE cod_orgao = " . tratarStr($this->id);

		$qtLin = $acesso->exec($sql);
		Auditoria(47,'Área reativada', $sql);
		return ($qtLin > 0);
	}

	function desativar(){

		global $acesso;

		$sql = "UPDATE sigech.tb_orgao SET ";
		$sql .= " cod_ativo = 0";
	$sql .= " WHERE cod_orgao = " . tratarStr($this->id);

	$qtLin = $acesso->exec($sql);
	Auditoria(48,'Área desativada', $sql);
	return ($qtLin > 0);


	}

	public function RetornaSigla($cod_orgao) {
        if (!empty($cod_orgao)) {
            $sql = "SELECT txt_sigla FROM sigech.tb_orgao WHERE cod_orgao = ".$cod_orgao;
            $q1 = pg_query($sql);
            $rs1 = pg_fetch_array($q1);
    
            return $rs1['txt_sigla'];
        } else {
            return '';
        }        
    }


}
?>
