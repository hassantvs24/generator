<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmplyeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->increments('employeeID');
            $table->string('name', 80);
            $table->string('fatherName', 80)->nullable();
            $table->string('motherName', 80)->nullable();
            $table->string('contact', 15);
            $table->date('dob')->nullable();
            $table->string('nid',20)->nullable();
            $table->string('address')->nullable();
            $table->string('primaryPhoto',160)->nullable();
            $table->double('balance')->default(0);
            $table->double('salary')->default(0);
            $table->string('status',10)->nullable()->default('Active');
            $table->string('position', 100)->nullable();
            $table->string('sector', 20)->nullable()->default('Dish');
            $table->integer('userID')->nullable()->unsigned()->index();
            $table->foreign('userID')->references('id')->on('users')->onDelete('No Action')->onUpdate('No Action');
            $table->unique(['name', 'mobile', 'sector']);
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
        Schema::dropIfExists('employee');
    }
}
