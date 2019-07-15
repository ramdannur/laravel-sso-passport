<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery', function (Blueprint $table) {
            $table->increments('id');       
            $table->string('code' , 20)->unique();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->string('bill_to');
            $table->string('ship_to');
            $table->string('ship_address');
            $table->date('due_date')->nullable();
            $table->timestamps();

            $table->foreign('branch_id')
                ->references('id')
                ->on('branch')
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
        Schema::dropIfExists('delivery');
    }
}
