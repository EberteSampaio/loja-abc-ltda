<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Response;

class ProductService
{
    public function listProduct(): string
    {
        try {

            $allProducts = Product::all(['id', 'name', 'price', 'description']);

            return response()
                ->json(
                    ['success' =>
                        ['message' => true]
                    ], Response::HTTP_OK,['data' =>$allProducts]);

        } catch (\Exception $e) {
            return response()->json(['error' =>['message' => $e->getMessage(),'code' => $e->getCode(),]], Response::HTTP_BAD_REQUEST);
        }
    }
}
