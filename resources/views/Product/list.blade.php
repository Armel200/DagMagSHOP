@extends('admin.admin')

@section('title', 'Dashboard-DacMagSHOP')

@section('content')

    <div class="p-6">

        {{-- Barre de recherche et tri --}}
        <form method="GET" action="{{ route('list.product') }}"
            class="flex flex-wrap justify-between items-center mb-6 bg-white p-4 rounded-lg shadow-sm">
            <div class="flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Products & Category ..."
                    class="p-2 border rounded-full w-full md:w-64 bg-gray-100 focus:ring-1 focus:ring-blue-400 focus:outline-none focus:border-none">
            </div>

            <div class="flex flex-wrap gap-2">
                <select name="status" class="p-2 border rounded bg-gray-100 ">
                    <option value="All" {{ request('status') == 'All' ? 'selected' : '' }}>All Status</option>
                    <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>

                <div class="flex gap-2 items-center">
                    <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min"
                        class="p-2 border rounded w-20 bg-gray-100 focus:outline-none focus:border-none focus:border-blue-500 focus:ring-1">
                    <span>-</span>
                    <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max"
                        class="p-2 border rounded w-20 bg-gray-100 focus:outline-none focus:border-none focus:border-blue-500 focus:ring-1">
                </div>

                <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition">Filter</button>
                <a href="{{ route('list.product') }}"
                    class="text-gray-500 px-4 py-2 border rounded hover:bg-gray-100 transition">Reset</a>

                <a href="{{ route('create.product') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">+ Add Product</a>
            </div>
        </form>

        {{-- Tableau Produits --}}
        <div class="bg-white p-4 rounded-lg shadow-md">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-4 py-2">Product name</th>
                        <th class="px-4 py-2">Purchase Unit Price</th>
                        <th class="px-4 py-2">Products</th>
                        <th class="px-4 py-2">Views</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productss as $product)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-4 py-2 flex items-center">
                                <input type="checkbox" class="mr-2">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-10 h-10 mr-2 object-cover rounded">
                                @else
                                    <img src="https://via.placeholder.com/40" alt="{{ $product->name }}"
                                        class="w-10 h-10 mr-2 rounded">
                                @endif
                                {{ $product->name }}
                            </td>
                            <td class="px-4 py-2">{{ $product->price }} FCFA</td>
                            <td class="px-4 py-2">{{ $product->quantity }}</td>
                            <td class="px-4 py-2">{{ $product->views }}</td>
                            <td class="px-4 py-2">
                                <span
                                    class="px-3 py-1 rounded text-sm font-medium 
                                {{ $product->status == 'Active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $product->status }}
                                </span>
                            </td>
                            <td class="px-4 py-2 flex items-center gap-2">
                                <a href="{{ route('edit.product', $product->id) }}"
                                    class="text-blue-500 hover:text-blue-700">Edit</a>
                                <form action="{{ route('destroy.product', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>


             <div class="flex justify-between items-center mt-4">
                <p class="text-sm text-gray-600">
                    Showing {{ $productss->firstItem() }} to {{ $productss->lastItem() }} of {{ $productss->total() }}
                    entries
                </p>
                <div class="flex space-x-2">
                    {{ $productss->links() }}
                </div>
            </div>

            {{-- Pagination dynamique --}}
            {{-- <div class="flex justify-between items-center mt-4 pagination -ml-[300px]">
                <p class="text-sm text-gray-600">
                    Showing {{ $productss->firstItem() ?? 0 }} to {{ $productss->lastItem() ?? 0 }} of
                    {{ $productss->total() }} entries
                </p>
                <div>
                    {{ $productss->links('pagination::tailwind') }}
                </div>
                <style>
                    .pagination .flex a,
                    .pagination .flex span {
                        padding: 8px 12px;
                        border-radius: 8px;
                        border: 1px solid #e5e7eb;
                        transition: 0.2s;
                    }

                    .pagination .flex a:hover {
                        background-color: #2563eb;
                        color: white;
                    }

                    .pagination .flex span[aria-current='page'] {
                        background-color: #2563eb;
                        color: white;
                    }
                </style> --}}
            </div>
        </div>

    </div>

@endsection
