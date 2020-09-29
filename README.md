# Teste para Empresa Argus em PHP

Para Realização do teste foi usado PHP7.3, Microframework Slim, Eloquent ORM e integração com Banco de Dados Mysql. 

## Como rodar a aplicação localmente

1. Primeiramente clone este repositório, com o comando **git clone https://github.com/pelif/teste-argus.git** . 

2. Após clonar o repositório acesse a raíz do projeto e digite: **composer install** . Óbviamente para isto é necessário ter o composer rodando na máquina. O composer irá instalar o core do Slim Framework, eloquent e suas dependências.

2. Após efetuar as instalações do composer, acessar o arquivo **dump.sql**. Pegue o conteúdo deste arquivo e rode no seu client Mysql, ex: (workbench, Dbeaver, Emma, etc...). Isto irá criar as tabelas e inserir um primeiro usuário no banco de dados. 

3. No arquivo **settings.php** que se encontra na raíz da pasta /src edite esta parte do array com suas configurações locais de banco de dados : 

 'db' => [
            'driver' => 'mysql',
            'host' => '172.17.0.3',
            'database' => 'teste-argus',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]

É necessário que o mysql esteja rodando adequadamente no seu ambiente local. 

4. Após terminar de configurar a conexão com o banco de dados, vá até a raíz do projeto e inicie o servidor local do PHP com o comando: **php -S localhost:8080 -t public** . No meu caso usei a porta 8080, fica a critério a necessidade de mudança de porta. Após isto é só ir no browser e digitar: **http://localhost:8080**, você será direcionado à url de login. Para efeturar o login digite o usuário **teste@argus.com.br** e para a senha digite: **123456**



