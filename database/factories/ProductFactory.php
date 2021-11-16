<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{

    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'published' => 1,
            'title' => $this->faker->word(),
            'description'=> $this->faker->text(100),
//            'position',
//            'allergens',
            'quantity' => 1,
            'net_price' => 1000,
            'gross_price' => 1270,
            'type' => 'food',
        ];
    }
}
