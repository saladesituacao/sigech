<?php
//error_reporting(0);
include("Auditoria.php");
class LocalVistoria{

	public $id;
	public $localvistoria;
	public $habilitado;


	private function carregarParametros($rs){

		if ($linha = pg_fetch_row($rs)){
			// Carregar parametros

			$this->id = $linha[0];
			$this->localvistoria = $linha[1];
			$this->habilitado = $linha[2];

			return true;
		}else{
			return false;
		}
	}

	function carregar($_id){
		global $acesso;

		$sql = "SELECT cod_local_vistoria, txt_local_vistoria, ind_habilitado
				FROM sigech.tb_local_vistoria WHERE
				cod_local_vistoria=" . tratarStr($_id);

		$resultado = $acesso->getRs($sql);

		return $this->carregarParametros($resultado);

	}

	function localRepetido(){

		global $acesso;

		$sql = "SELECT cod_local_vistoria
				FROM sigech.tb_local_vistoria WHERE
				txt_local_vistoria=" . tratarStr($this->localvistoria);


		if ($this->id != ''){
			$sql .= " AND cod_local_vistoria!=" . tratarStr($this->id);
		}

		$resultado = $acesso->getRs($sql);

		return pg_num_rows($resultado)>0;

	}

	function alterar(){

		global $acesso;

		if ($this->localRepetido()){
			alert('O local de vistoria n�o est� dispon�vel!');
			return false;
		}

		

		$sql = "UPDATE sigech.tb_local_vistoria SET ";
			$sql .= " txt_local_vistoria = "		. tratarStr($this->localvistoria);
			$sql .= ", cod_usuario = " . $acesso->usuario->id;
			$sql .= ", dt_atualizacao = " . dataAtual();

		$sql .= " WHERE cod_local_vistoria = " . tratarStr($this->id);

		$qtLin = $acesso->exec($sql);
		Auditoria(16,'Local de vistoria alterado', $sql);

		return ($qtLin > 0);
	}

	function incluir(){

		global $acesso;
  
		
		if ($this->localRepetido()){
			alert('O local de vistoria n�o est� dispon�vel!');
			return false;
		}

	

		$sql = "INSERT INTO sigech.tb_local_vistoria (
				txt_local_vistoria,cod_usuario, dt_atualizacao
			) VALUES (";

			$sql .= tratarStr($this->localvistoria);
			$sql .= ", " . $acesso->usuario->id;
			$sql .= ", " . dataAtual();

		$sql .= ")";


		$qtLin = $acesso->exec($sql);
		Auditoria(13,'Local de vistoria incluído', $sql);

		return ($qtLin > 0);
	}


	function reativar(){

		global $acesso;

		$sql = "UPDATE sigech.tb_local_vistoria SET ";
			$sql .= " ind_habilitado = 'S'";
		$sql .= " WHERE cod_local_vistoria = " . tratarStr($this->id);

		$qtLin = $acesso->exec($sql);
		Auditoria(14,'Local de vistoria reativado', $sql);

		return ($qtLin > 0);
	}

	function desativar(){

		global $acesso;

		$sql = "UPDATE sigech.tb_local_vistoria SET ";
			$sql .= " ind_habilitado = 'N'";
		$sql .= " WHERE cod_local_vistoria = " . tratarStr($this->id);

		$qtLin = $acesso->exec($sql);
		Auditoria(15,'Local de vistoria desativado', $sql);

		return ($qtLin > 0);
	}
}
?>
