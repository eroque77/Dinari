<?php

use Illuminate\Support\Facades\Schema;          //Responsáveis pelos métodos UP [Criar] e Down [Drop]
use Illuminate\Database\Schema\Blueprint;       //Controla as colunas da tabela e chaves
use Illuminate\Database\Migrations\Migration;   //Define o Tipo da Classe

class CriarTabelaClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('cpf', 11);
            $table->string('cnpj', 14);
            $table->string('nome', 120);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
