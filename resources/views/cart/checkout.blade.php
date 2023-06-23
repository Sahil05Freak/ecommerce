@extends('layouts.app-master')

@section('content')
<br>
<h1>Checkout</h1>

@if ($cartItems->isEmpty())
    <p>Your cart is empty.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartItems as $cartItem)
                <tr>
                    <td>{{ $cartItem->product->name }}</td>
                    <td>{{ $cartItem->product->price }}</td>
                    <td>{{ $cartItem->quantity }}</td>
                    <td>{{ $cartItem->product->price * $cartItem->quantity }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"></td>
                <td><strong>Total: {{ $totalAmount }}</strong></td>
            </tr>
        </tbody>
    </table>

    <form action="/cart/place-order" method="POST">
        @csrf
        <input type="hidden" name="total_amount" value="{{ $totalAmount }}">
        <button type="submit" class="btn btn-success">Place Order</button>
    </form>
@endif
@endsection
