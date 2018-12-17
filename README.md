# SIGECH/SES-DF

Sistema de Gestão de Credenciamento e Habilitação

+ Liguagem de programação - PHP
+ Banco de dados relacional - PostgreSQL

## Instalação

O ambiente operacional para uso do SIGECH/SES-DF é construído com Docker e o código do software fica disponível no repositório Git.

Faça o clone do código existente no repositório Git em uma pasta em seu sistema local de arquivos.

Provisione com o arquivo Dockerfile disponível na raiz do projeto um container. Este será o servidor web (apache) base para suportar o código do SIGECH.

ATENÇÃO: É necessário mapear o volume onde foi feito o clone do projeto no seu sistema de arquivos para dentro de container no path /var/www/html para que o código fonte do projeto esteja disponível quando o container for iniciado.

## Configuração de acesso ao banco de dados

O comando docker run utiliza uma série de variáveis de ambiente que indicam os parâmetros de conexão com o banco de dados, REST API e controlador de domínio.

## Banco de dados

A pasta sigech/dbchange contém os arquivos Postgres dump, que permitem criar um banco de dados local para testes.

## Parâmetros do Banco de dados (variáveis de ambiente)

##### HOST
	Endereço IP do servidor de banco de dados.
##### PORT
	Porta de acesso.	
##### DBNAME
	Nome do banco de dados.
##### USER
	Usuário do banco de dados.
##### PASSWORD
	Senha do usuário do banco de dados.




Quando tudo estiver pronto acesse um navegador de sua preferência e insira o seguinte endereço:
http://localhost/sigech

Se por algum motivo estiver usando uma porta diferente de 80, coloque a porta de forma explícita na URL - Por exemplo:
http://localhost:8080/sigech

+ Dicas sobre Docker: https://www.digitalocean.com/community/tutorials/como-instalar-e-utilizar-o-docker-primeiros-passos-pt
	