@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold mb-6">Product List</h2>
    @if(session('status'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
    @endif
    <div class="overflow-x-auto bg-white shadow rounded-lg p-6">
        @if($products->count())
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Seller</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $product)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->description }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($product->price, 2) }} dh</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->user->name ?? 'Unknown' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <div class="text-gray-500">No products found.</div>
        @endif
    </div>
</div>
@endsection 