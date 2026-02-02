@extends('admin.admin')

@section('title', 'Dashboard-DacMagSHOP')

@section('content')
<div class="p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Ajouter un Produit</h1>

    <form action="{{ route('store.product') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nom du Produit</label>
            <input type="text" name="name" id="name" class="w-full p-2 border rounded focus:outline-none focus:border-none focus:border-blue-500 focus:ring-1" required>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700">Prix (FCFA)</label>
            <input type="number" name="price" id="price" step="0.01" class="w-full p-2 border rounded focus:outline-none focus:border-none focus:border-blue-500 focus:ring-1" required>
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-gray-700">Quantité</label>
            <input type="number" name="quantity" id="quantity" class="w-full p-2 border rounded focus:outline-none focus:border-none focus:border-blue-500 focus:ring-1" required>
        </div>

        <div class="mb-4">
            <label for="views" class="block text-gray-700">Vues</label>
            <input type="number" name="views" id="views" step="0.01" class="w-full p-2 border rounded focus:outline-none focus:border-none focus:border-blue-500 focus:ring-1" required value="0">
        </div>

        <div class="mb-4">
            <label for="status" class="block text-gray-700">Statut</label>
            <select name="status" id="status" class="w-full p-2 border rounded focus:outline-none focus:border-none focus:border-blue-500 focus:ring-1" required>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700">Image du Produit</label>
            <input type="file" name="image" id="image" class="w-full p-2 border rounded focus:outline-none focus:border-none focus:border-blue-500 focus:ring-1">
        </div>
        <div class="mb-4">
    <label for="category_id" class="block text-gray-700">Catégorie</label>
    <select name="category_id" id="category_id" class="w-full p-2 border rounded focus:outline-none focus:border-none focus:border-blue-500 focus:ring-1" required>
        @foreach (\App\Models\Category::all() as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </select>
</div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter</button>
    </form>
</div>
    
@endsection