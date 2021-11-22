<?php

namespace Database\Seeders;

use Database\Factories\AdminFactory;
use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        AdminFactory::new()->count(1)->create();
//        ProductFactory::new()->count(5)->create();
    }
}
