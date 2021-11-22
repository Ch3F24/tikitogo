<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTables extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table,true);

            $table->string('payment_id')->unique()->index();
            $table->string('order_number')->unique()->index();
            $table->integer('total_gross_price');
            $table->string('status');
            //shipping
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
        });

        Schema::create('order_slugs', function (Blueprint $table) {
            createDefaultSlugsTableFields($table, 'order');
        });

        Schema::create('order_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'order');
        });

        Schema::create('order_products',function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->index();
            $table->unsignedBigInteger('product_id')->index();
            $table->unsignedBigInteger('option_id')->index();
            $table->integer('position')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_revisions');
        Schema::dropIfExists('order_slugs');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_products');
    }
}
