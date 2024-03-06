<?php

namespace App\Http\Controllers;

use App\Services\SalesService;
use Illuminate\Http\Request;


class SalesController extends Controller
{
    protected SalesService $salesService;
    public function __construct()
    {
       $this->salesService = new SalesService();
    }

    public function index()
    {
        return $this->salesService->salesMade();
    }
    public function show(Request $request)
    {
        return $this->salesService->specificSale($request);
    }

    public function destroy(Request $request)
    {
        return $this->salesService->cancelSale($request);
    }
}
