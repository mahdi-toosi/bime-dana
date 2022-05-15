<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer("phone");
            $table->text("address");
            $table->integer("car_id");
            $table->integer("plan_id");
            $table->integer("usage_id");
            $table->integer("insurance_id");
            $table->smallInteger("payment_type")->comment("0 >> cash 1 >> instatment");
            $table->string("insurance_date_expire");
            $table->bigInteger("price");
            $table->bigInteger("insurance_old_id");
            $table->smallInteger("insurance_old_type")->comment("0 >> 1 years. 1 >> lower");
            $table->string("insurance_old_date");
            $table->integer("insurance_old_off_percentage_third");
            $table->integer("insurance_old_off_percentage_driver");
            $table->integer("insurance_old_property_damage");
            $table->integer("insurance_old_life_damage");
            $table->string("image_front_card");
            $table->string("image_back_card");
            $table->string("image_personal_card");
            $table->integer("activation_code");
            $table->integer("state");
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
        Schema::dropIfExists('orders');
    }
}
