<?php

use Illuminate\Support\Facades\Schema;          //Responsáveis pelos métodos UP [Criar] e Down [Drop]
use Illuminate\Database\Schema\Blueprint;       //Controla as colunas da tabela e chaves
use Illuminate\Database\Migrations\Migration;   //Define o Tipo da Classe

class CriarTabelaVenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venda', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('soma_produtos', 8,2); //Soma de todos os produtos vendidos          
            $table->integer('id_cliente')->unsigned();
            $table->foreign('id_cliente')->references('id')->on('clientes');
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
        Schema::dropIfExists('venda');
    }
}
