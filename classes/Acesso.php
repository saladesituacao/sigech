<?php
header("Content-Type: text/html; charset=utf-8",true);
$docroot = $_SERVER["DOCUMENT_ROOT"]."/sigech";
include_once("$docroot/classes/UsuarioLogado.php");


class Acesso{


// conexão no servidor
	protected $con = null;
	protected $con_string = null;
	
    //Usuário logado
    public $usuario;

	//método construtor
	function __construct(){

$this->con_string = "host= ".getenv('DBHOST')." port= ".getenv('DBPORT')." dbname= ".getenv('DBNAME')." user= ".getenv('DBUSER')." password= ".getenv('DBPASSWORD');
       $this->usuario = new UsuarioLogado();

    }
    
  
	//metodo que inicia conexao
	function conectar(){

		try{

			$this->con = @pg_connect($this->con_string) or die ("Não foi possível conectar ao servidor PostGreSQL");

 			return $this->con;

 		}catch(Exception $e){
 			echo "Erro ao conectar com banco de dados.<br>" . $e->getMessage();
			exit();
 		}
	}



	//metodo que encerra a conexao
	function fechar(){
 		@pg_close($this->con);
	}

	//metodo verifica status da conexao
	function status(){
		return $this->con;
 	}

 	public function beginTrans(){
 		return $this->exec("START TRANSACTION");
 	}

 	public function commitTrans(){
 		return $this->exec('COMMIT TRANSACTION');
 	}

 	public function rollbackTrans(){
 		return $this->exec("ROLLBACK TRANSACTION");
 	}

	public function getRs($sql){

 		$result = pg_query($this->con, $sql);

		return $result;
	}
	
	


	public function exec($sql){

		try{
			$result = pg_query($this->con, $sql);

			return pg_affected_rows($result);
		}catch (Exception $e) {
			echo "Erro na execu��o da query.<br>" . $e->getMessage();
			exit();
		}
	}

}

//-------------------------------------------------------------------
//-------------------------------------------------------------------

	// Criar objeto de acesso ao banco de dados
	$acesso = new Acesso();

	// Conectar no banco de dados
	$acesso->conectar();

//-------------------------------------------------------------------
//-------------------------------------------------------------------



?>
