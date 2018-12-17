<?php
//não pode haver header neste arquivo.
class UsuarioLogado{

	public $id;
	public $login;
	public $nome;
    public $email;
    public $orgao;
    public $cargo;
    public $perfil;
	
	
	//m�todo construtor
	function __construct(){
      
       // Carregar dados do usu�rio logado
       Session_start();

       if ($_SESSION['USUARIO'] != ''){
          $lista = explode(";", $_SESSION['USUARIO']);		  

         

          $this->id = $lista[0];
          $this->login = $lista[1];
          $this->nome = $lista[2];
          $this->email = $lista[3];
          $this->orgao = $lista[4];
          $this->cargo = $lista[5];
          $this->perfil = $lista[6];
       }
    }
	
    public function carregarSession(){
        $_SESSION['USUARIO'] = $this->id . ";" 
							. str_replace(";", "", $this->login) . ";" 
                            . $this->nome . ";"
                            . $this->email . ";"
                            . $this->orgao . ";"
                            . $this->cargo . ";"
                            . $this->perfil;
		
        return $_SESSION['USUARIO'];
    }
    
    public function validarLogin($_login, $_senha){
        global $acesso;

       /* // temp
        if ($_login=='adm' && $_senha=='123'){
           $this->id = '1';
	       $this->login = 'adm';
	       
	       $this->carregarSession();
	       return true;
	       exit;
        }*/

		$sql = "SELECT cod_usuario, txt_login, txt_nome, txt_email, cod_orgao, cod_cargo, cod_perfil
				FROM sigech.tb_usuario
                WHERE dt_inativacao IS NULL
				AND txt_login=" . tratarStr($_login) .
                " AND txt_senha=" . tratarStr($_senha);

        $rs = $acesso->getRs($sql);


       

        if ($linha = pg_fetch_row($rs)){
			// Carregar parametros
			$this->id = $linha[0];
			$this->login = $linha[1];
			$this->nome = $linha[2];
            $this->email = $linha[3];
            $this->orgao = $linha[4];
            $this->cargo = $linha[5];
            $this->perfil = $linha[6];
			
			$this->carregarSession();
		
		
            
			return true;
		}else{
			return false;
		}
    }
	
	
    
    public function limparSession(){
           Session_start();
           $_SESSION['USUARIO']='';
           
    }
}


?>
