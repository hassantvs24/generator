<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_transaction', function (Blueprint $table) {
            $table->increments('cusTransactionID');
            $table->integer('customerID')->unsigned()->index();
            $table->foreign('customerID')->references('customerID')->on('customer')->onDelete('cascade')->onUpdate('No Action');
            $table->double('amountIN')->default(0);
            $table->double('amountOut')->default(0);
            $table->string('transactionType',3)->default('IN');
            $table->string('descriptions')->nullable();
            $table->string('sector', 20)->nullable()->default('Dish');
            $table->integer('userID')->nullable()->unsigned()->index();
            $table->foreign('userID')->references('id')->on('users')->onDelete('No Action')->onUpdate('No Action');
            $table->softDeletes();
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
        Schema::dropIfExists('customer_transaction');
    }
}
