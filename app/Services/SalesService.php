<?php

namespace App\Services;

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

}
