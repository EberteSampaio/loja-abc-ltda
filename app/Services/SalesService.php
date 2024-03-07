<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SalesService
{
    public function salesMade()
    {
        try {
            $sales = Sale::all();

            if(empty($sales)){
                throw new \Exception("Unable to list sales. Please contact IT!");
            }

            return \response()->json($sales,Response::HTTP_OK);
        }catch (\Exception $e){
            return response()->json(['error'=>['message'=> $e->getMessage()]],Response::HTTP_NOT_FOUND);
        }
    }

    public function newSale()
    {
        try {

            if(!($newSale = Sale::create(['amount' => 0]))){
                throw new \Exception("It was not possible to register a new sale in the system.");
            }

            return response()->json(['success'=>['message'=>"Purchase registered successfully. Purchase ID: $newSale->id"]],Response::HTTP_OK);

        }catch (\Exception $e){
            return response()->json(['error' => ['error' => $e->getMessage()]]);
        }
    }
    public function specificSale(Request $request)
    {
        try {

            $sales = Sale::with('products')->find($request->id);

            if(empty($sales)){
                throw new \Exception("No sales were found with id {$request->id}. Check for a valid sale.");
            }

            return \response()->json($sales,Response::HTTP_OK);
        }catch (\Exception $e){
            return response()->json(['error'=>['message'=> $e->getMessage()]],Response::HTTP_NOT_FOUND);
        }
    }

    public function cancelSale(Request $request)
    {
        try {
            if(!(Sale::where('id',$request->id)->first())){

                throw new \Exception("This sale does not exist or has already been deleted.");
            }

            if(!(Sale::destroy($request->id))){

                throw new \Exception("This sale could not be deleted. contact IT.");

            }

            return response()->json(['success' => ['message' => 'Sale successfully canceled!']],Response::HTTP_OK);

        }catch (\Exception $e){

            return response()->json(['error'=>['message'=> $e->getMessage()]], Response::HTTP_BAD_REQUEST);
        }
    }

    public function insertProductsInSale(Request $request)
    {
        try{


            if(!($sale = Sale::where('id', $request->id_sale)->first())){
                throw new \Exception("Unable to find sale with id {$request->id_sale}. Try again!");
            }

            if(!($product = Product::where('id',$request->id_product)->first())){
                throw new \Exception("Could not find product with id {$request->id_product}. Try a correct product!");
            }


            $amountSale = $sale->amount;

            $amountSale += (double) $product->price;


            if(!($sale->update(['amount' => $amountSale]))){
                throw new \Exception("Unable to register {$product->name} when purchasing with id {$sale->id}.");
            }

            return response()->json(['success'=>['message' => 'Product inserted successfully!']],Response::HTTP_OK);

        } catch (\Exception $e){
            return response()->json(['error'=>['message' => $e->getMessage()]],Response::HTTP_NOT_FOUND);
        }
    }
}
