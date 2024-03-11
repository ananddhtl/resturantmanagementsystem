<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function __invoke(Request $request)
    {
        $categories = ProductCategory::query()->with('products')->with('image')->with('products.image');
        if ($request->query('q')) {
            $categories->where('name', 'LIKE', "%$request->q%");
        }
        $categories = $categories->get();
        return response()->json(['message' => '', 'categories' => $categories]);
    }
}
