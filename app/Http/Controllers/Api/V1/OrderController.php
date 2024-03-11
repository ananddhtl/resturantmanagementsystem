<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function __invoke(Request $request, string $id)
    {
        $product = Product::query()->find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|max:10000',
            'discount' => 'required|numeric|min:0|max:100',
            'price' => 'required|numeric|max:1000000',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => '', 'errors' => $validator->errors()], 422);
        }

        $order = Order::query()->create([
            'product_id' => $id,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'price' => $request->price,
            'user_id' => Auth::id(),
            'ordered_at' => now()
        ]);

        return response()->json(['message' => 'Ordered successfully!', 'order' => $order]);
    }
}
