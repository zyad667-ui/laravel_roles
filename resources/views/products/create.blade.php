@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold mb-6">Add a Product</h2>
    <form method="POST" action="{{ route('products.store') }}" class="bg-white shadow rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Product Name</label>
            <div class="relative">
                <input id="name" name="name" type="text" class="w-full border-gray-300 rounded pr-16 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required value="{{ old('name') }}">
                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 bg-indigo-600 text-white rounded px-3 py-1 text-sm font-bold hover:bg-indigo-500 transition">Add +</button>
            </div>
            @error('name')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description</label>
            <textarea id="description" name="description" class="w-full border-gray-300 rounded focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description') }}</textarea>
            @error('description')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="price">Price</label>
            <input id="price" name="price" type="number" step="0.01" min="0" class="w-full border-gray-300 rounded focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required value="{{ old('price') }}">
            @error('price')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <!-- Remove the main submit button at the bottom -->
    </form>
</div>
@endsection 