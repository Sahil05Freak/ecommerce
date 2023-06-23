@extends('layouts.app-master')

@section('content')
<br>
<h1>Order Confirmation</h1>

@if ($orders->isEmpty())
    <p>No orders found.</p>
@else
    <p>Thank you for your order! Below are your recent orders:</p>

    <ul>
        @foreach ($orders as $order)
            <li>Order Number: {{ $order->id }}</li>
            <li>Order Total: {{ $order->total_amount }}</li>
            <!-- Display any other relevant order information -->
        @endforeach
    </ul>
@endif
@endsection
