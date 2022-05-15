<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_models', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_type_id');
            $table->unsignedBigInteger('plan_id');
            $table->string('title');
            $table->boolean('status')->default(1);

            $table->foreign('car_type_id')
                ->references('id')
                ->on('car_types')
                ->onDelete('Cascade');

            $table->foreign('plan_id')
                ->references('id')
                ->on('plans')
                ->onDelete('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_models');
    }
}
