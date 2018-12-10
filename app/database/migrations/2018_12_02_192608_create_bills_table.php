<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments( 'id' );
            $table->decimal( 'balance', 15 , 2 );
            $table->decimal( 'partial_balance' , 15 , 2 );
            $table->integer( 'board_id')->foreign('board_id')
                                        ->references('id')
                                        ->on('boards');
            $table->enum('status', [ 'active', 'closed' ])->default('active');
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
