<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function upsert(ProductRequest $request) 
    {
        return Product::upsertInstance($request);
    }

    public function delete(Product $product) 
    {
        return $product->deleteInstance();
    }
}
