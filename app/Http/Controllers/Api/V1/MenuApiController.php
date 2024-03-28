<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\MenuResource;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Http\Request;

class MenuApiController extends BaseApiController
{
    public function getMenu()
    {
        try {
            $categories = ProductCategory::query()->with('products')->with('image')->with('products.image')->get();
            return $this->sendResponse($categories, 'Menu List');
        } catch (Exception $e) {
            return $this->sendError('Something went wrong');
        }
    }
}
