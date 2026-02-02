@extends('admin.admin')

@section('content')
<div class="p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Ajouter une Catégorie</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

   <form action="{{ route('store.category') }}" method="POST">
    @csrf

    <div class="mb-4">
        <label for="name" class="block text-gray-700">Nom</label>
        <input type="text" name="name" id="name" class="w-full p-2 border rounded  focus:ring-1 focus:ring-blue-400 focus:outline-none focus:border-none" value="{{ old('name') }}" required>
    </div>

    <div class="mb-4">
        <label for="code" class="block text-gray-700">Code</label>
        <input type="text" name="code" id="code" class="w-full p-2 border rounded  focus:ring-1 focus:ring-blue-400 focus:outline-none focus:border-none" value="{{ $code }}" readonly>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter</button>
</form>

</div>
    
@endsection

