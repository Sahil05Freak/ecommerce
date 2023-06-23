@extends('layouts.app-master')

@section('content')
<br>
<h1>Cart</h1>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartItems as $cartItem)
                <tr>
                    <td>{{ $cartItem->product->name }}</td>
                    <td>{{ $cartItem->product->price }}</td>
                    <td>
                        <form action="/cart/{{ $cartItem->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </td>
                    <td>{{ $cartItem->product->price * $cartItem->quantity }}</td>
                    <td>
                        <form action="/cart/{{ $cartItem->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"></td>
                <td><strong>Total:</strong></td>
                <td>{{ $cartItems->sum(function ($item) {
                    return $item->product->price * $item->quantity;
                }) }}</td>
            </tr>
        </tbody>
    </table>

    <form action="/cart/checkout" method="GET">
        <button type="submit" class="btn btn-success">Checkout</button>
    </form>
@endif
@endsection
