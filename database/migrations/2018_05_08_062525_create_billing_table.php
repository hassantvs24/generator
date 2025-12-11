<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing', function (Blueprint $table) {
            $table->increments('billingID');
            $table->integer('billMonthID')->unsigned()->index();
            $table->foreign('billMonthID')->references('billMonthID')->on('bill_month')->onDelete('cascade')->onUpdate('No Action');
            $table->integer('servicesID')->unsigned()->index();
            $table->foreign('servicesID')->references('servicesID')->on('services')->onDelete('cascade')->onUpdate('No Action');
            $table->double('amount')->default(0);
            $table->double('payment')->default(0);
            $table->string('status', 15)->default('DUE');
            $table->double('serviceCharge')->default(0);
            $table->string('sector', 20)->nullable()->default('Dish');
            $table->integer('userID')->nullable()->unsigned()->index();
            $table->foreign('userID')->references('id')->on('users')->onDelete('No Action')->onUpdate('No Action');
            $table->unique(['billMonthID', 'servicesID', 'sector']);
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
        Schema::dropIfExists('billing');
    }
}
