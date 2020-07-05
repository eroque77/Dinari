<?php

use Illuminate\Support\Facades\Schema;          //Responsáveis pelos métodos UP [Criar] e Down [Drop]
use Illuminate\Database\Schema\Blueprint;       //Controla as colunas da tabela e chaves
use Illuminate\Database\Migrations\Migration;   //Define o Tipo da Classe

class CriarTabelaItensDaVenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_da_venda', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_produto')->unsigned();  //Para a migração funcionar você deve acrescentar ->unsigned() a chave estrangeira [Pois o id não é assinado]
            $table->foreign('id_produto')->references('id')->on('produtos'); 
            $table->decimal('valor_produto', 8,2);
            $table->integer('qtde_vendida');
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
        Schema::dropIfExists('itens_da_venda');
    }
}
