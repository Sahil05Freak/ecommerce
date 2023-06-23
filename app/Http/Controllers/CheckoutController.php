<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)
            ->with('product')
            ->get();

        $totalAmount = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart.checkout', compact('cartItems', 'totalAmount'));
    }

    public function placeOrder(Request $request)
    {
        $user = Auth::user();

        // Process payment and store order details
        // Generate order number and save order information
        // Remove cart items

        $cartItems = Cart::where('user_id', $user->id)->get();
        $orderItems = [];

        foreach ($cartItems as $cartItem) {
            $orderItems[] = [
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ];


            $product = Product::where(['id' => $cartItem->product_id])->first();

            $updated_quantity = $product->quantity - $cartItem->quantity;

            Product::where(['id' => $cartItem->product_id])->update(['quantity' => $updated_quantity]);
        }

        Order::create([
            'user_id' => $user->id,
            'items' => $orderItems,
            'total_amount' => $request->total_amount,
            // Add any other relevant order information
        ]);

        Cart::where('user_id', $user->id)->delete();

        return redirect('/order/confirmation')->with('success', 'Order placed successfully.');
    }

    public function orderConfirmation()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();

        return view('order.confirmation', compact('orders'));
    }
}
