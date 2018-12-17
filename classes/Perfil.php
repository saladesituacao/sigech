<?php
//error_reporting(0);
include("Auditoria.php");
class Perfil{

	public $id;
	public $perfil;
	public $descricao;
	public $ativo;
	public $codPermissao;
	

	private function carregarParametros($rs){

		if ($linha = pg_fetch_row($rs)){
			// Carregar parametros

			$this->id = $linha[0];
			$this->perfil = $linha[1];
			$this->descricao = $linha[2];
			$this->ativo = $linha[3];
			
			return true;
		}else{
			return false;
		}
	}

	function carregar($_id){
		global $acesso;

		$sql = "SELECT cod_perfil, txt_perfil, txt_descricao, cod_ativo
				FROM sigech.tb_perfil WHERE
				cod_perfil=" . tratarStr($_id);

$resultado = $acesso->getRs($sql);

		return $this->carregarParametros($resultado);

	}

	function perfilRepetido(){

		global $acesso;

		$sql = "SELECT cod_perfil
				FROM sigech.tb_perfil WHERE
				txt_perfil=" . tratarStr($this->perfil);


		if ($this->id != ''){
			$sql .= " AND cod_perfil!=" . tratarStr($this->id);
		}

		$resultado = $acesso->getRs($sql);

		return pg_num_rows($resultado)>0;

	}

	function alterar(){

		global $acesso;

		if ($this->perfilRepetido()){
			alert('O caro não está disponível!');
			return false;
		}

		

		$sql = "UPDATE sigech.tb_perfil SET ";
			$sql .= " txt_perfil = "		. tratarStr($this->perfil);
			$sql .= ", txt_descricao = "	. tratarStr($this->descricao);
					

		$sql .= " WHERE cod_perfil = " . tratarStr($this->id);

		$qtLin = $acesso->exec($sql);
		Auditoria(40,'Perfil alterado', $sql);

		return ($qtLin > 0);
	}

	function incluir(){

		global $acesso;

		
		if ($this->perfilRepetido()){
			alert('O perfil não está disponível!');
			return false;
		}



		$sql = "INSERT INTO sigech.tb_perfil (
			txt_perfil, txt_descricao
		) VALUES (";

		$sql .= tratarStr($this->perfil);
		$sql .= ", " . tratarStr($this->descricao);
		

	$sql .= ")";

		$qtLin = $acesso->exec($sql);
		
		Auditoria(41,'Perfil incluído', $sql);
		return ($qtLin > 0);
	}




	function permissao() {
	   
		global $acesso;

		$sql = "DELETE FROM sigech.tb_permissao_perfil WHERE cod_perfil = ".$this->id;
		
        $acesso->exec($sql);          

        $a_cod_permissao = $this->codPermissao;

        for($i=0; $i < count($a_cod_permissao); $i++){
            $sql = "INSERT INTO sigech.tb_permissao_perfil(cod_permissao, cod_perfil) VALUES(".$a_cod_permissao[$i].", ".$this->id.")";
			
		
			$qtLin = $acesso->exec($sql);
			Auditoria(49, "Permissão concedida para o Perfil", $sql);      

            
		}   
		
		return ($qtLin > 0);               
    }



	function reativar(){

		global $acesso;

		$sql = "UPDATE sigech.tb_perfil SET ";
			$sql .= " cod_ativo = 1";
		$sql .= " WHERE cod_perfil = " . tratarStr($this->id);

		$qtLin = $acesso->exec($sql);
		Auditoria(42,'Perfil reativado', $sql);
		return ($qtLin > 0);
	}

	function desativar(){

		global $acesso;

		$sql = "UPDATE sigech.tb_perfil SET ";
		$sql .= " cod_ativo = 0";
	$sql .= " WHERE cod_perfil = " . tratarStr($this->id);

	$qtLin = $acesso->exec($sql);
	Auditoria(43,'Perfil desativado', $sql);
	return ($qtLin > 0);


	}


	public function RetornaPerfil($cod_perfil) {
        $sql = "SELECT txt_perfil FROM sigech.tb_perfil WHERE cod_perfil = ".$cod_perfil;
        $q1 = pg_query($sql);
        $rs1 = pg_fetch_array($q1);

        return $rs1['txt_perfil'];
    }

}
?>
