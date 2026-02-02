@extends('admin.admin')
@section('content')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6 bg-white p-4 rounded-lg shadow-sm">
            <form method="GET" action="{{ route('list.category') }}" class="flex space-x-2 ">
                <input type="text" name="search" placeholder="Search Category..." value="{{ request('search') }}"
                    class="p-2 border rounded-full w-full md:w-64 bg-gray-100 focus:ring-1 focus:ring-blue-400 focus:outline-none focus:border-none">

            </form>
            <div class="flex justify-between items-center gap-[10px]">
                <select name="sort"
                    class="p-2 border rounded  focus:ring-1 focus:ring-blue-400 focus:outline-none focus:border-none">
                    <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Sort by: Default</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name Asc</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name Desc</option>
                </select>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Filter</button>
                <a href="{{ route('list.category') }}"
                    class="text-gray-500 px-4 py-2 border rounded hover:bg-gray-100 transition">Reset</a>
                <a href="{{ route('create.category') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Add Category</a>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-md">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Code</th>
                        <th class="px-4 py-2 text-left">Products</th>
                        <th class="px-4 py-2 text-left">Quantity</th>
                        <th class="px-4 py-2 text-left">Date</th>
                        <th class="px-4 py-2 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categoriess as $category)
                        <tr>
                           <td class="border px-4 py-2 flex items-center">
    <input type="checkbox" class="mr-2">
    
    <img src="{{ $category->products->first() 
        ? asset('storage/' . $category->products->first()->image) 
        : 'https://via.placeholder.com/40' }}" 
        alt="{{ $category->name }}" 
        class="w-12 h-12 object-cover rounded-md mr-2 border border-gray-200 shadow-sm">

    <span class="font-medium text-gray-800">{{ $category->name }}</span>
</td>

                            <td class="border px-4 py-2">{{ $category->code }}</td>
                            <td class="border px-4 py-2">{{ $category->products->count() }}</td>
                            <td class="border px-4 py-2">{{ $category->products->sum('quantity') }}</td>
                            <td class="border px-4 py-2">{{ $category->created_at->format('d/m/y') }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('edit.category', $category->id) }}" class="text-blue-500 mr-2">Edit</a>
                                <form action="{{ route('destroy.category', $category->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="flex justify-between items-center mt-4">
                <p class="text-sm text-gray-600">
                    Showing {{ $categoriess->firstItem() }} to {{ $categoriess->lastItem() }} of {{ $categoriess->total() }}
                    entries
                </p>
                <div class="flex space-x-2">
                    {{ $categoriess->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
