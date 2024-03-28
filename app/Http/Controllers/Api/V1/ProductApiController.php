<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductApiController extends BaseApiController
{
    public function __invoke(Request $request)
    {
        try {
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
            return $this->sendResponse($products, 'All Product List');
        } catch (Exception $e) {
            return $this->sendError('Something went wrong');
        }
    }
}
