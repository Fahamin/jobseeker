@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-4">Welcome to Dashboard</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white shadow rounded p-4">
                <h3 class="font-semibold">Total Users</h3>
                <p class="text-3xl">150</p>
            </div>
            <div class="bg-white shadow rounded p-4">
                <h3 class="font-semibold">Total Orders</h3>
                <p class="text-3xl">320</p>
            </div>
            <div class="bg-white shadow rounded p-4">
                <h3 class="font-semibold">Revenue</h3>
                <p class="text-3xl">$12,500</p>
            </div>
        </div>
    </div>
@endsection
