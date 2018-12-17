<?php
//error_reporting(0);
include("Auditoria.php");
class Usuario{

	public $id;
	public $nome;
	public $login;
	public $senha;
	public $email;
	public $dataAtivacao;
	public $dataInativacao;
	public $telefone;
	public $matricula;
	public $codCargo;
	public $codOrgao;
	public $codPerfil;


	private function carregarParametros($rs){

		if ($linha = pg_fetch_row($rs)){
			// Carregar parametros

			$this->id = $linha[0];
			$this->nome = $linha[1];
			$this->login = $linha[2];
			$this->senha = $linha[3];
			$this->email = $linha[4];
			$this->dataAtivacao = $linha[5];
			$this->dataInativacao = $linha[6];
			$this->telefone		 = $linha[7];
			$this->matricula = $linha[8];
			$this->codCargo = $linha[9];
			$this->codOrgao = $linha[10];
			$this->codPerfil = $linha[11];

			return true;
		}else{
			return false;
		}
	}

	function carregar($_id){
		global $acesso;

		$sql = "SELECT cod_usuario, txt_nome, txt_login, txt_senha, txt_email,
                  dt_ativacao, dt_inativacao, txt_telefone, txt_matricula, cod_cargo, cod_orgao, cod_perfil 
				FROM sigech.tb_usuario WHERE
				cod_usuario=" . tratarStr($_id);

		$resultado = $acesso->getRs($sql);

		return $this->carregarParametros($resultado);

	}

	function loginRepetido(){

		global $acesso;

		$sql = "SELECT cod_usuario
				FROM sigech.tb_usuario WHERE
				login=" . tratarStr($this->login);


		if ($this->id != ''){
			$sql .= " AND cod_usuario!=" . tratarStr($this->id);
		}

		$resultado = $acesso->getRs($sql);

		return pg_num_rows($resultado)>0;

	}

	function alterar(){

		global $acesso;

		if ($this->loginRepetido()){
			alert('O login n�o est� dispon�vel!');
			return false;
		}

		

		$sql = "UPDATE sigech.tb_usuario SET ";
			$sql .= " txt_nome = "		. tratarStr($this->nome);
			$sql .= ", txt_login = "	. tratarStr($this->login);
			$sql .= ", txt_senha = "	. tratarStr($this->senha);
			$sql .= ", txt_email = "	. tratarStr($this->email);
			$sql .= ", txt_telefone = "	. tratarStr($this->telefone);
			$sql .= ", txt_matricula = "	. tratarStr($this->matricula);
			$sql .= ", cod_orgao = "	. tratarStr($this->codOrgao);
			$sql .= ", cod_cargo = "	. tratarStr($this->codCargo);
			$sql .= ", cod_perfil = "	. tratarStr($this->codPerfil);
			

		$sql .= " WHERE cod_usuario = " . tratarStr($this->id);

		$qtLin = $acesso->exec($sql);
		Auditoria(2,'Usuário alterado', $sql);

		return ($qtLin > 0);
	}

	function alterarsenha(){

		global $acesso;

		 

		$sql = "UPDATE sigech.tb_usuario SET ";
			
			$sql .= " txt_senha = "	. tratarStr($this->senha);
		$sql .= " WHERE cod_usuario = " . tratarStr($this->id);

		$qtLin = $acesso->exec($sql);

		Auditoria(3,'Senha Alterada', $sql);
		return ($qtLin > 0);
	}

	function incluir(){

		global $acesso;

		
		if ($this->loginRepetido()){
			alert('O login não está disponível!');
			return false;
		}

	

		$sql = "INSERT INTO sigech.tb_usuario (
				txt_nome, txt_login, txt_senha, txt_email,
                dt_ativacao, txt_telefone, txt_matricula, cod_orgao, cod_cargo, cod_perfil
			) VALUES (";

			$sql .= tratarStr($this->nome);
			$sql .= ", " . tratarStr($this->login);
			$sql .= ", " . tratarStr($this->senha);
			$sql .= ", " . tratarStr($this->email);
			$sql .= ", " . dataAtual();
			$sql .= ", " . tratarStr($this->telefone);
			$sql .= ", " . tratarStr($this->matricula);
			$sql .= ", " . tratarStr($this->codOrgao);
			$sql .= ", " . tratarStr($this->codCargo);
			$sql .= ", " . tratarStr($this->codPefil);

		$sql .= ")";


		$qtLin = $acesso->exec($sql);
		
		Auditoria(4,'Usuário incluído', $sql);
		return ($qtLin > 0);
	}


	function reativar(){

		global $acesso;

		$sql = "UPDATE sigech.tb_usuario SET ";
			$sql .= " dt_ativacao = " . dataAtual();
			$sql .= ", dt_inativacao = null";
		$sql .= " WHERE cod_usuario = " . tratarStr($this->id);

		$qtLin = $acesso->exec($sql);
		Auditoria(5,'Usuário reativado', $sql);
		return ($qtLin > 0);
	}

	function desativar(){

		global $acesso;

		$sql = "UPDATE sigech.tb_usuario SET ";
			$sql .= " dt_inativacao = " . dataAtual();
		$sql .= " WHERE cod_usuario = " . tratarStr($this->id);

		$qtLin = $acesso->exec($sql);
		Auditoria(6,'Usuário desativado', $sql);

		return ($qtLin > 0);
	}
}
?>
