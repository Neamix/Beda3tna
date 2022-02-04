<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function upsert(CategoryRequest $request) 
    {
        return Category::upsertInstance($request);
    }

    public function delete(Category $category) {
        return $category->deleteInstance();
    } 
}
