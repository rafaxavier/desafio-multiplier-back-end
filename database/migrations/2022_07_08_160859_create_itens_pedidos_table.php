<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItensPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::dropIfExists('itens_pedidos'); 
        Schema::create('itens_pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_id');
            $table->unsignedBigInteger('cardapio_id');
            $table->timestamps();
            
            /*transformando o campo pedido_id dessa tabela em FK e referenciando ele ao
            campo id PK da tabela pedidos*/
            $table->foreign('pedido_id')->references('id')->on('pedidos')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            /*transformando o campo cardapio_id dessa tabela em FK e referenciando ele ao
            campo id PK da tabela cardapios*/
            $table->foreign('cardapio_id')->references('id')->on('cardapios')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itens_pedidos');
    }
}
