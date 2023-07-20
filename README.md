# Projeto Pastelaria

## Instalação
Para instalar o projeto, tenha em sua máquina o composer instalado.
Para instalar o composer, caso não tenha, acesse o site [composer](https://getcomposer.org/) e siga as instruções para o seu sistema operacional.

Após a instalação do composer, baixe o projeto e salve no diretório de sua preferência.

Acesse o diretório onde baixou o projeto e em seguida digite o comando para baixar as dependências do projeto.

`composer install`

Renomeie o arquivo .env.example para .env

Substitua as informações do banco de dados para as seguintes abaixo:

DB_CONNECTION=mysql <br>
DB_HOST=mysql <br>
DB_PORT=3306 <br>
DB_DATABASE=pastelaria <br>
DB_USERNAME=sail <br>
DB_PASSWORD=password <br>

Logo após a conclusão da instalação das dependências, digite o seguinte comando para subir os containers do projeto.

`./vendor/bin/sail up -d`

## Configurações e Migrations

Para instalar as tabelas no banco de dados e algumas configurações adicionais, digite o camando ainda no terminal para acessar o container da aplicação.

`docker exec -it pastelaria-laravel.test-1 bash`

Agora voce está dentro do container da aplicação, basta agora rodar os seguintes comandos.

`php artisan key:generate`

`php artisan migrate`

`php artisan db:seed`


## Email

Crie uma conta fake para enviar e receber email utilizando o [mailtrap](https://mailtrap.io/).
Apoś a criação da conta, crie sua caixa de entrada e pegue as configurações para utilizar no .env do projeto.

MAIL_MAILER=smtp <br>
MAIL_HOST=sandbox.smtp.mailtrap.io <br>
MAIL_PORT=2525 <br>
MAIL_USERNAME= <br>
MAIL_PASSWORD= <br>
MAIL_ENCRYPTION=tls <br>

Troque as informações acima pelas suas credenciais do MailTrap.

## Endpoints

Na pasta do projeto existe um arquivo chamado collection.json, para utilizá-lo, baixe o [insomnia](https://insomnia.rest/download) e instale na sua maquina.
Em seguida importe o arquivo collection.json para criar os endpoints para utilizar a api.