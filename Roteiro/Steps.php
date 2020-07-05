<?php

/*
    * Criar BD
    * User e Senha padrão
    * Bd: dinari

    * composer create-project --prefer-dist laravel/laravel blog "5.4.*" [Para cópia]

    * Hash base64:cAK5XtS5aTApRfaRFSoedS6RkgTeXNV3K7AaBsAezuU=

    * Migrations --------------------------------------------------------------------------------------------------------------------------------------------------
        php artisan make:migration criar_tabela_clientes --create=clientes
            | Criação de uma tabela no banco
              É que uma classe que irá tornar possível a manipulação da tabela de CLIENTES que será criada na base de dados.
              Em: C:\xampp\htdocs\Dinari\database\migrations foi criado: 2020_07_02_234650_criar_tabela_clientes
              Estrutura: Ex: string e inteiro
                         $table->string('email', 80);
                         $table->integer('registro');

        php artisan migrate - Executa a Migration
            Executa as classes que estiverem localizadas no pacote migration/database/migrations

        Todas desse projeto:
            - php artisan make:migration criar_tabela_clientes --create=clientes
            - php artisan make:migration criar_tabela_produtos --create=produtos
            - php artisan make:migration criar_tabela_venda --create=venda
            - php artisan make:migration criar_tabela_itens_da_venda --create=itens_da_venda

        Na raiz: BD
        DB_DATABASE=dinari
        DB_USERNAME=root
        DB_PASSWORD=''
        
        ||| Erro ao executar a migrate: Ok, porém erro:
            Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes
            Laravel usa o conjunto de caracteres utf8mb4 por padrão, que inclui suporte para armazenar "emojis" no banco de dados.
            Se você estiver executando uma versão do MySQL mais antiga do que a versão 5.7.7 ou MariaDB anterior à versão 10.2.2, 
            talvez seja necessário configurar manualmente o comprimento da string padrão gerado pelas migrações para que o MySQL crie índices para elas.
            Você pode configurar isso chamando o método Schema::defaultStringLength no AppServiceProvider:

            Para resolver isso siga os passos abaixo:

            Edite o arquivo app\Providers\AppServiceProvider.php
            Adicione o namespace use Illuminate\Support\Facades\Schema;
            Dentro do método boot adicione Schema::defaultStringLength(191);
            Resultado final do arquivo:

            use Illuminate\Support\Facades\Schema;

            public function boot()
            {
                Schema::defaultStringLength(191);
            }
        |||

        Reverter uma migração: php artisan migrate:rollback

        Reverter todas as migrações: php artisan migrate:reset

        Chave Estrangeira:
            $table->integer('id_cliente')->unsigned();
            $table->foreign('id_cliente')->references('id')->on('clientes'); Pois oi increment gera um inteiro não assinado                              


    * Controller
            php artisan make:controller api
            php artisan make:controller api --resource
            CONTROLLER PRINCIPAL: php artisan make:controller Api_DinariController --resource


    * Model
            php artisan make:model clientes
            php artisan make:model clientes -m [Já cria uma migration]

    * POSTMAN
            Erro ao usar POST
            Edite este arquivo:

            vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/VerifyCsrfToken.php
            adicione 'POST'
            protected function isReading($request)
                {
                    return in_array($request->method(), ['HEAD', 'GET', 'OPTIONS', 'POST']);
                }

            PUT - POSTMAN: Usar x-www-form-urlencoded

    * ERRO 404 
            Incluir em app \ exceptions \ handler.php, adicione-o no método render

            //Para página não encontrada
            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                return response()->view('index', [], 404);
            }

*/