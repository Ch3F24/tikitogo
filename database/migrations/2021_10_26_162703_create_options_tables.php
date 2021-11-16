<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTables extends Migration
{
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
            $table->integer('tax')->default(27);
            $table->integer('net_price')->nullable();
            $table->integer('gross_price')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('options');
    }
}
