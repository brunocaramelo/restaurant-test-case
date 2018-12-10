<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills_itens', function (Blueprint $table) {
            $table->increments( 'id' );
            $table->integer( 'product_id')->foreign('product_id')
                                        ->references('id')
                                        ->on('products');
            $table->integer( 'bill_id')->foreign('bill_id')
                                        ->references('id')
                                        ->on('bills');
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
        Schema::dropIfExists('bills');
    }
}
