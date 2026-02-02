@extends('admin.admin')

@section('content')

<div class="p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Modifier la Catégorie</h1>

   <form action="{{ route('update.category', $category->id) }}" method="POST">
    @csrf
    @method('POST')

    <div class="mb-4">
        <label for="name" class="block text-gray-700">Nom</label>
        <input type="text" name="name" id="name" class="w-full p-2 border rounded  focus:ring-1 focus:ring-blue-400 focus:outline-none focus:border-none" value="{{ old('name', $category->name) }}" required>
    </div>

    <div class="mb-4">
        <label for="code" class="block text-gray-700">Code</label>
        <input type="text" name="code" id="code" class="w-full p-2 border rounded  focus:ring-1 focus:ring-blue-400 focus:outline-none focus:border-none" value="{{ old('code', $category->code) }}" readonly>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Mettre à jour</button>
</form>
</div>
    
@endsection