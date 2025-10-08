@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Welcome to Dashboard</h2>

    <div class="flex flex-wrap justify-between gap-6">
        
        <div class="bg-white shadow rounded-lg p-6 flex-1 min-w-[250px]">
            <h3 class="font-semibold text-lg text-gray-700 mb-2">Total Users</h3>
            <p class="text-4xl font-bold text-blue-600 mb-2">{{ 250 ?? 0 }}</p>
            <p class="text-sm text-gray-500">Active users in the system</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6 flex-1 min-w-[250px]">
            <h3 class="font-semibold text-lg text-gray-700 mb-2">Total Orders</h3>
            <p class="text-4xl font-bold text-green-600 mb-2">{{ 44 ?? 0 }}</p>
            <p class="text-sm text-gray-500">Completed orders this month</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6 flex-1 min-w-[250px]">
            <h3 class="font-semibold text-lg text-gray-700 mb-2">Revenue</h3>
            <p class="text-4xl font-bold text-purple-600 mb-2">${{ number_format(477 ?? 0, 2) }}</p>
            <p class="text-sm text-gray-500">Total revenue generated</p>
        </div>

    </div>
</div>
@endsection