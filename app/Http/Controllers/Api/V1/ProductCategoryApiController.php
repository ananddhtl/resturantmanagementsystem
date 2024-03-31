<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Http\Request;

class ProductCategoryApiController extends BaseApiController
{
    public function __invoke(Request $request)
    {
        try {
            $categories = ProductCategory::query()->with('image');
            if ($request->query('q')) {
                $categories->where('name', 'LIKE', "%$request->q%");
            }
            $categories = $categories->get();
            return $this->sendResponse($categories, 'All categories list');
        } catch (Exception $e) {
            return $this->sendError('Something went wrong');
        }
    }

    public function productsByCategory(Request $request)
    {
        try {
            $category = ProductCategory::where('id', $request->id)->with('image')->first();

            $products = $category->products()->with('image')->with('category')->with('category.image')->latest()->get();

            return $this->sendResponse($products, 'Products By Category');
        } catch (Exception $e) {
            return $this->sendError('Something went wrong');
        }
    }
}
