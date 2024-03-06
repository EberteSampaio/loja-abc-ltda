<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $saleAmount = 0;

        $newSale = Sale::create(['amount' => 0]);

        $products = Product::inRandomOrder()->get();

        for ($i = 0; $i < 2; $i++) {

            $saleAmount += $products[$i]->price;


            SaleProduct::create([
                'sale_id' => $newSale->id,
                'product_id' => $products[$i]->id,
                'amount' => $products[$i]->price
            ]);

            $newSale->update(['amount' => $saleAmount]);
        }
    }
}
