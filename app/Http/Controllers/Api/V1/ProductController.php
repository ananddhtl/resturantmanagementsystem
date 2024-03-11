<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __invoke(Request $request)
    {
        $products = Product::query()->with('image')->with('category')->with('category.image');
        if ($request->query('q')) {
            $products->where('name', 'LIKE', "%$request->q%");
        }
        if ($request->query('category')) {
            if ($request->query('category')) {
                $categoryId = $request->query('category');
                $products->whereHas('category', function ($query) use ($categoryId) {
                    $query->where('id', $categoryId);
                });
            }
        }
        $products = $products->get();

        return response()->json(['message' => '', 'products' => $products]);
    }
}
