# Teste para Empresa Argus em PHP

Para Realização do teste foi usado PHP7.3, Microframework Slim, Eloquent ORM e integração com Banco de Dados Mysql. 

## Como rodar a aplicação localmente

1. Primeiramente clone este repositório, com o comando **git clone https://github.com/pelif/teste-argus.git** . 

2. Após clonar o repositório acesse a raíz do projeto e digite: **composer install** . Óbviamente para isto é necessário ter o composer rodando na máquina. O composer irá instalar o core do Slim Framework, eloquent e suas dependências.

3. Após efetuar as instalações do composer, acessar o arquivo **dump.sql**. Pegue o conteúdo deste arquivo e rode no seu client Mysql, ex: (workbench, Dbeaver, Emma, etc...). Isto irá criar as tabelas e inserir um primeiro usuário no banco de dados. Segue coteúdo do arquivo: 
```
CREATE DATABASE `teste-argus`; 
use `teste-argus`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,  
  `created_at` timestamp NULL DEFAULT NOW(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `patients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `age` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,  
  `registration` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NOW(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `users` VALUES (1,'teste','teste@argus.com','123456', NOW(), NULL);

```
4. No arquivo **settings.php** que se encontra na raíz da pasta /src edite esta parte do array com suas configurações locais de banco de dados : 

```
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
```		

É necessário que o mysql esteja rodando adequadamente no seu ambiente local. 

5. Após terminar de configurar a conexão com o banco de dados, vá até a raíz do projeto e inicie o servidor local do PHP com o comando: **php -S localhost:8080 -t public** . No meu caso usei a porta 8080, fica a critério a necessidade de mudança de porta. Após isto é só ir no browser e digitar: **http://localhost:8080**, você será direcionado à url de login. Para efeturar o login digite o usuário **teste@argus.com** e para a senha digite: **123456**

### Instruões para importação de pacientes via .txt

Na raíz do projeto há um arquivo chamado patients.txt, a parte de importação de arquivo vai seguir este padrão de arquivo para importação. O arquivo segue o seguinte padrão: Após o nome, por exemplo, há dois espaços, após a idade há também dois espaços, ou seja, os dados estão separados por dois espaços. É bom também evitar linhas em branco. 
