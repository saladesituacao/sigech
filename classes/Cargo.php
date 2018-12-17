<?php
//error_reporting(0);
include("Auditoria.php");
class Cargo{

	public $id;
	public $cargo;
	public $descricao;
	public $ativo;
	

	private function carregarParametros($rs){

		if ($linha = pg_fetch_row($rs)){
			// Carregar parametros

			$this->id = $linha[0];
			$this->cargo = $linha[1];
			$this->descricao = $linha[2];
			$this->ativo = $linha[3];
			
			return true;
		}else{
			return false;
		}
	}

	function carregar($_id){
		global $acesso;

		$sql = "SELECT cod_cargo, txt_cargo, txt_descricao, cod_ativo
				FROM sigech.tb_cargo WHERE
				cod_cargo=" . tratarStr($_id);

		$resultado = $acesso->getRs($sql);

		return $this->carregarParametros($resultado);

	}

	function cargoRepetido(){

		global $acesso;

		$sql = "SELECT cod_cargo
				FROM sigech.tb_cargo WHERE
				txt_cargo=" . tratarStr($this->cargo);


		if ($this->id != ''){
			$sql .= " AND cod_cargo!=" . tratarStr($this->id);
		}

		$resultado = $acesso->getRs($sql);

		return pg_num_rows($resultado)>0;

	}

	function alterar(){

		global $acesso;

		if ($this->cargoRepetido()){
			alert('O caro n�o est� dispon�vel!');
			return false;
		}

		

		$sql = "UPDATE sigech.tb_cargo SET ";
			$sql .= " txt_cargo = "		. tratarStr($this->cargo);
			$sql .= ", txt_descricao = "	. tratarStr($this->descricao);
			$sql .= ", cod_usuario = " . $acesso->usuario->id;
			$sql .= ", dt_atualizacao = " . dataAtual();
					

		$sql .= " WHERE cod_cargo = " . tratarStr($this->id);

		$qtLin = $acesso->exec($sql);
		Auditoria(35,'Cargo alterado', $sql);

		return ($qtLin > 0);
	}

	function incluir(){

		global $acesso;

		
		if ($this->cargoRepetido()){
			alert('O cargo não está disponível!');
			return false;
		}



		$sql = "INSERT INTO sigech.tb_cargo (
			txt_cargo, txt_descricao, cod_usuario, dt_atualizacao
		) VALUES (";

		$sql .= tratarStr($this->cargo);
		$sql .= ", " . tratarStr($this->descricao);
		$sql .= ", " . $acesso->usuario->id;
		$sql .= ", " . dataAtual();
		

	$sql .= ")";


		$qtLin = $acesso->exec($sql);
		
		Auditoria(36,'Cargo incluído', $sql);
		return ($qtLin > 0);
	}


	function reativar(){

		global $acesso;

		$sql = "UPDATE sigech.tb_cargo SET ";
			$sql .= " cod_ativo = 1";
		$sql .= " WHERE cod_cargo = " . tratarStr($this->id);

		$qtLin = $acesso->exec($sql);
		Auditoria(37,'Cargo reativado', $sql);
		return ($qtLin > 0);
	}

	function desativar(){

		global $acesso;

		$sql = "UPDATE sigech.tb_cargo SET ";
		$sql .= " cod_ativo = 0";
	$sql .= " WHERE cod_cargo = " . tratarStr($this->id);

	$qtLin = $acesso->exec($sql);
	Auditoria(38,'Cargo desativado', $sql);
	return ($qtLin > 0);


	}
}
?>
