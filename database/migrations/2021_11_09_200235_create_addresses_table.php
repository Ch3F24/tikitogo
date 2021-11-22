<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();

            //Shipping
            $table->string('name');
            $table->integer('shipping_postal_code');
            $table->string('shipping_address');

            //Billing
            $table->string('billing_name');
            $table->string('vat_number')->nullable();
            $table->integer('billing_postal_code');
            $table->string('billing_address');
            $table->string('billing_city');
            $table->string('phone');

            $table->unsignedInteger('user_id');
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
        Schema::dropIfExists('addresses');
    }
}
