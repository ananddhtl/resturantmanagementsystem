<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartApiController extends BaseApiController
{
    public function getCart()
    {
        try {
            $carts = Cart::where('user_id', 1)->with('items', 'items.product')->withCount('items')->get();

            return $this->sendResponse($carts, "User's Cart.");
        } catch (Exception $e) {
            return $this->sendError('Something went wrong');
        }
    }

    public function addToCart(Request $request)
    {
        try {
            DB::beginTransaction();
            $product = Product::findOrFail($request->product_id);

            if ($product) {
                $existing_cart = Cart::where('user_id', 1)->first();

                if (!$existing_cart) {
                    $cart = Cart::create([
                        'user_id' => 1,
                        'cart_total' => 0,
                    ]);
                } else {
                    $cart = $existing_cart;
                }

                $data = [
                    'cart_id' => $cart->id,
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity
                ];

                CartItem::create($data);

                $new_cart_total = $cart->cart_total + ($request->quantity * $product->price);

                $cart->update(['cart_total' => $new_cart_total]);

                DB::commit();

                return $this->sendResponse([], 'Product added to cart');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage());
        }
    }

    public function updateCartItem(Request $request)
    {
        try {
            DB::beginTransaction();

            $item = CartItem::findOrFail($request->id);
            $old_quantity = $item->quantity;

            if ($request->quantity === "0") {
                $item->delete();
            } else {
                $item->quantity = $request->quantity;
                $item->save();
            }

            $cart = Cart::find($item->cart_id);
            $product = Product::find($item->product_id);

            $cart->cart_total = $cart->cart_total - ($old_quantity * $product->price) + ($item->quantity * $product->price);
            $cart->save();

            DB::commit();

            return $this->sendResponse($item, 'Cart Item Updated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage());
        }
    }

    public function deleteCartItem(Request $request)
    {
        try {
            $item = CartItem::findOrFail($request->id);
            $old_quantity = $item->quantity;

            $item->delete();

            $cart = Cart::find($item->cart_id);
            $product = Product::find($item->product_id);

            $cart->cart_total = $cart->cart_total - ($old_quantity * $product->price);
            $cart->save();

            return $this->sendResponse([], 'Cart Item Deleted successfully');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
}
