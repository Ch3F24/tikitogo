<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaysTables extends Migration
{
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);

            $table->date('date')->unique();
        });

        Schema::create('day_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'day');
        });

        Schema::create('day_product', function (Blueprint $table) {
            createDefaultRelationshipTableFields($table, 'day', 'product');
            $table->integer('position')->unsigned()->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('day_revisions');
        Schema::dropIfExists('days');
    }
}
