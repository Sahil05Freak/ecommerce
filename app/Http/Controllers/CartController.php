<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            // Update the quantity if the item already exists in the cart
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Create a new cart item if it doesn't exist
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect('/cart')->with('success', 'Product added to cart successfully.');
    }

    public function index()
    {
        $user = Auth::user();

        $cartItems = Cart::where('user_id', $user->id)
            ->with('product')
            ->get();

        return view('cart.index', compact('cartItems'));
    }

    public function update(Request $request, Cart $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect('/cart')->with('success', 'Cart item updated successfully.');
    }

    public function remove(Cart $cartItem)
    {
        $cartItem->delete();

        return redirect('/cart')->with('success', 'Cart item removed successfully.');
    }
}
