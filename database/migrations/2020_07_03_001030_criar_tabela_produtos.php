<?php

use Illuminate\Support\Facades\Schema;          //Responsáveis pelos métodos UP [Criar] e Down [Drop]
use Illuminate\Database\Schema\Blueprint;       //Controla as colunas da tabela e chaves
use Illuminate\Database\Migrations\Migration;   //Define o Tipo da Classe

//descrição, valor, quantidade em estoque e data do cadastro

class CriarTabelaProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao', 50);
            $table->decimal('valor', 8,2);
            $table->integer('quantidade_est'); 
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
        Schema::dropIfExists('produtos');
    }
}
