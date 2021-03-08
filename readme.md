<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Prontomed

Prontomed é um sistema para facilitar o trabalho dos médicos nas suas respectivas rotinas, com as seguitnes funcionalidades:

- Cadastrar, alterar ou eliminar pacientes.
- Cadastrar, alterar ou eliminar consultas.
- Cadastrar, alterar ou eliminar agendamentos.

## Pré-requisitos e como rodar a aplicação

Inicialmente, faça a o download do projeto e confirme se Composer está instalado. Caso não esteja, recomendo a instalação.

Ao baixar o projeto, faça:
- 1 - Descompactar o projeto.
- 2 - Entre no diretório do projeto e rode o comando: composer install. 
- 3 - Crie o arquivo .env e especifique as diretivas de configuração do banco, conforme exemplo a seguir:
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=prontomed
    DB_USERNAME=postgres
    DB_PASSWORD=postgre
    
    Obs.: conforme exemplo, utilizei o postgree para rodar o projeto. 
- 4 - Crie o banco de dados, conforme exemplo: 
    CREATE DATABASE prontomed.
- 5 - Aplique as migrations 
    php artisan migrate    
- 7 - Caso deseje, aplique os Seeders para gerar e inserir dados de amostra 
    php artisan db:seed
- 6 - Rode o servidor
    php artisan serve
- 7 - Acesse o navegador e digite http://localhost:8000/
- 8 - Caso ocorra um erro de chave aleatória, rode o comando a seguir para criá-la
    php artisan key:generate

## Tecnologias utilizadas

- Laravel 
- Bootstrap 
- PostgreSql

## License

Não se aplica.
