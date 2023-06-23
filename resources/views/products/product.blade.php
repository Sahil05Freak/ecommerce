@extends('layouts.app-master')

@section('content')
<br>

@foreach ($products as $product)
<div class="product-card">
    <!-- <img src="product-image.jpg" alt="Product Image" class="product-image"> -->
    <h3 class="product-title">{{ $product->name }}</h3>
    <p class="product-description">{{ $product->description }}</p>
    <p class="product-price">₹{{ $product->price }}</p>
    <form action="/products/{{ $product->id }}/add-to-cart" method="POST">
        @csrf
        <input type="number" class="form-control" name="quantity" value="1" min="1"><br>
        <button type="submit" class="add-to-cart-button">Add to Cart</button>
    </form>
    <!-- <button class="add-to-cart-button">Add to Cart</button> -->
</div>
@endforeach

@endsection