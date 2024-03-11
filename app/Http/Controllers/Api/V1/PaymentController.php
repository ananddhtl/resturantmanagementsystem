<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{

    public function __invoke(Request $request, string $id)
    {
        $order = Order::query()->find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'payment_method' => 'required|string|in:esewa,khalti',
            'transaction_code' => 'required|string|max:50',
            'amount' => 'required|numeric|max:100000',
            'product_code' => 'required|string|max:150',
            'payment_status' => 'required|string|in:completed,remaining',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => '', 'errors' => $validator->errors()], 422);
        }

        $payment = Payment::query()->create([
            'order_id' => $id,
            'amount' => $request->amount,
            'transaction_code' => $request->transaction_code,
            'product_code' => $request->product_code,
            'payment_status' => $request->payment_status,
            'payment_method' => $request->payment_method,
        ]);

        return response()->json(['message' => 'Payment added successfully!', 'payment' => $payment]);
    }
}
