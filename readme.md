## Prontomed

Prontomed é um sistema para facilitar o trabalho dos médicos nas suas respectivas rotinas, com as seguitnes funcionalidades:

- Cadastrar, alterar ou eliminar pacientes.
- Cadastrar, alterar ou eliminar consultas.
- Cadastrar, alterar ou eliminar agendamentos.

## Pré-requisitos e como rodar a aplicação

Inicialmente, faça a o download do projeto e confirme se Composer está instalado. Caso não esteja, recomendo a instalação.

Ao término do download, faça:
- 1 - Descompacte o projeto.
- 2 - Entre no diretório do projeto e rode o comando: composer install. 
- 3 - Crie o arquivo .env e especifique as diretivas de configuração do banco
- 4 - Crie o banco de dados, conforme exemplo: 
    CREATE DATABASE prontomed.
- 5 - Aplique as migrations: php artisan migrate    
- 7 - Caso deseje, aplique os Seeders para gerar e inserir dados de amostra: php artisan db:seed
- 6 - Rode o servidor: php artisan serve
- 7 - Acesse o navegador: http://localhost:8000/
- 8 - Caso ocorra um erro de chave aleatória, rode o comando a seguir para criá-la: php artisan key:generate

## Tecnologias utilizadas

- Laravel 
- Bootstrap 
- PostgreSql

## License

Não se aplica.
