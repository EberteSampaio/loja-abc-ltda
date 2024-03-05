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
        for ($i = 0; $i < 2; $i++) {
            $newSale = Sale::create(['amount' => 0]);

            $products = Product::inRandomOrder()->get();
            $saleAmount = $products[0]->price;

            SaleProduct::create([
                'sale_id' => $newSale->id,
                'product_id' => $products[0]->id,
                'amount' => $products[0]->price
            ]);

            SaleProduct::create([
                'sale_id' => $newSale->id,
                'product_id' => $products[1]->id,
                'amount' => $products[1]->price
            ]);

            $newSale->update(['amount' => (double)$saleAmount]);
        }
    }
}
