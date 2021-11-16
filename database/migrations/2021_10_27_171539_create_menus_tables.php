<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenusTables extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);

            $table->date('date')->unique();

            // add those 2 columns to enable publication timeframe fields (you can use publish_start_date only if you don't need to provide the ability to specify an end date)
            // $table->timestamp('publish_start_date')->nullable();
            // $table->timestamp('publish_end_date')->nullable();
        });

        Schema::create('menu_slugs', function (Blueprint $table) {
            createDefaultSlugsTableFields($table, 'menu');
        });

        Schema::create('menu_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'menu');
        });

        Schema::create('menu_day', function (Blueprint $table) {
            createDefaultRelationshipTableFields($table, 'menu', 'day');
            $table->integer('position')->unsigned()->nullable();
        });

    }

    public function down()
    {
        Schema::dropIfExists('menu_day');
        Schema::dropIfExists('menu_revisions');
        Schema::dropIfExists('menu_slugs');
        Schema::dropIfExists('menus');
    }
}
