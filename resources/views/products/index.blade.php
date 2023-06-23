@extends('layouts.app-master')

@section('content')
<br>
<!-- <h1>Products</h1> -->

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Products</h1>
    </div>
    <div class="col-sm-6">
        <div class="float-sm-right">
            <a href="{{ url('/products/create') }}"><button class="btn btn-primary">Add Product</button></a>
        </div>
    </div>
</div>

<!-- <a href="/products/create" class="btn btn-primary">Add Product</a> -->

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->quantity }}</td>
            <td>
                <a href="/products/{{ $product->id }}" style="color:green;"><i class="fa-sharp fa-solid fa-eye"></i></a>
                <a href="/products/{{ $product->id }}/edit" style="color:blue;"><i class="fas fa-edit"></i></a>
                <form action="/products/{{ $product->id }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <a type="submit" style='color:red;'><i class="fas fa-trash-alt"></i></a>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection