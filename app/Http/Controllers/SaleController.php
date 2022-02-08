<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function upsert(SaleRequest $request)
    {
        return Sale::upsertInstance($request);
    }

    public function delete(Sale $sale) 
    {
        return $sale->deleteInstance();
    }
}
