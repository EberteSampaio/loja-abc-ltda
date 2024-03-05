<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory  as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for($i = 0; $i < 10; $i++){

            Product::create([
                'name' => 'Celular '.$faker->unique()->word,
                'price' =>$faker->randomFloat(2, 500, 5000),
                'description' => $faker->text,
            ]);
        }
    }
}
