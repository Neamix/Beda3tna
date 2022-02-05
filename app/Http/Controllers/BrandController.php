<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function upsert(Request $request) {
        return Brand::upsertInstance($request);
    }

    public function delete(Brand $brand) {
        return $brand->deleteInstance();
    }

    public function getBrandProductWithCategories(Brand $brand) {
        return $brand->products()->categories();
    }
}
