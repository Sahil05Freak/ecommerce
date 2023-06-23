@extends('layouts.app-master')

@section('content')
<br>
<h1>{{ $product->name }}</h1>

<p><strong>Description:</strong> {{ $product->description }}</p>
<p><strong>Price:</strong> ₹{{ $product->price }}</p>
<p><strong>Quantity:</strong> {{ $product->quantity }}</p>

<a href="/products/{{ $product->id }}/edit" class="btn btn-primary">Edit</a>

<form action="/products/{{ $product->id }}" method="POST" style="display: inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
</form>

@endsection
