@extends('layouts.app-master')

@section('content')
<br>
<h1>Edit Product</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/products/{{ $product->id }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" required>{{ $product->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" name="price" step="0.01" class="form-control" value="{{ $product->price }}" required>
    </div>
    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection