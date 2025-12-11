<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('servicesID');
            $table->string('dishType', 15)->nullable()->default('Analog');
            $table->string('dishCard', 15)->nullable();
            $table->string('dishBox', 15)->nullable();
            $table->string('dishP', 15)->nullable();
            $table->string('ispPackage', 20)->nullable();
            $table->tinyInteger('light',3)->default(0);//generator
            $table->tinyInteger('fan',3)->default(0);//generator
            $table->tinyInteger('printer',3)->default(0);//generator
            $table->tinyInteger('computer',3)->default(0);//generator
            $table->tinyInteger('stabilizer',3)->default(0);//generator
            $table->tinyInteger('other',3)->default(0);//generator
            $table->integer('packageID')->nullable()->unsigned()->index();
            $table->foreign('packageID')->references('packageID')->on('package')->onDelete('No Action')->onUpdate('No Action');
            $table->integer('customerID')->unsigned()->index();
            $table->foreign('customerID')->references('customerID')->on('customer')->onDelete('cascade')->onUpdate('No Action');
            $table->double('billingAmount')->default(0);
            $table->string('status',10)->nullable()->default('Active');
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
        Schema::dropIfExists('services');
    }
}
