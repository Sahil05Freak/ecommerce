@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <h1>Dashboard</h1>
        <p class="lead">Your welcome to E-basket.</p>
        @endauth

        @guest
        <h1>Welcome</h1>
        <p class="lead">Your welcome to E-basket. Please login or register.</p>
        @endguest
    </div>
@endsection