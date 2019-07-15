<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('delivery_id')->unsigned()->nullable();
            $table->integer('qty')->nullable();
            $table->mediumText('description');
            $table->integer('price')->nullable();
            $table->timestamps();

            $table->foreign('delivery_id')
                ->references('id')
                ->on('delivery')
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
        Schema::dropIfExists('unit');
    }
}
