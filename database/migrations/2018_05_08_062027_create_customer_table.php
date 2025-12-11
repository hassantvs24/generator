<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->increments('customerID');
            $table->string('name', 80);
            $table->string('fatherName', 80)->nullable();
            $table->string('motherName', 80)->nullable();
            $table->string('contact', 15);
            $table->date('dob')->nullable();
            $table->string('nid',20)->nullable();
            $table->string('wordNo',80)->nullable();
            $table->string('address')->nullable();
            $table->string('primaryPhoto',160)->nullable();
            $table->double('balance')->default(0);
            $table->integer('areaID')->unsigned()->index();
            $table->foreign('areaID')->references('areaID')->on('area')->onDelete('cascade')->onUpdate('No Action');
            $table->integer('customerCatID')->unsigned()->index();
            $table->foreign('customerCatID')->references('customerCatID')->on('customer_category')->onDelete('cascade')->onUpdate('No Action');
            $table->string('sector', 20)->nullable()->default('Dish');
            $table->integer('userID')->nullable()->unsigned()->index();
            $table->foreign('userID')->references('id')->on('users')->onDelete('No Action')->onUpdate('No Action');
            $table->unique(['name', 'contact', 'sector']);
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
        Schema::dropIfExists('customer');
    }
}
