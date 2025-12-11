<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->increments('bankID');
            $table->string('name', 160);
            $table->string('accountNo', 40);
            $table->string('branch', 160)->nullable();
            $table->string('contactPerson', 80)->nullable();
            $table->string('contact', 15)->nullable();
            $table->double('openingBalance')->default(0);
            $table->double('balance')->default(0);
            $table->string('sector', 20)->nullable()->default('Dish');
            $table->integer('userID')->nullable()->unsigned()->index();
            $table->foreign('userID')->references('id')->on('users')->onDelete('No Action')->onUpdate('No Action');
            $table->unique(['name', 'accountNo', 'sector']);
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
        Schema::dropIfExists('banks');
    }
}
