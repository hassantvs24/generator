<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary', function (Blueprint $table) {
            $table->increments('salaryID');
            $table->integer('salaryMonthID')->unsigned()->index();
            $table->foreign('salaryMonthID')->references('salaryMonthID')->on('salary_month')->onDelete('cascade')->onUpdate('No Action');
            $table->integer('employeeID')->unsigned()->index();
            $table->foreign('employeeID')->references('employeeID')->on('employee')->onDelete('cascade')->onUpdate('No Action');
            $table->double('amount')->default(0);
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
        Schema::dropIfExists('salary');
    }
}
