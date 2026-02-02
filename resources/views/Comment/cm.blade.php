@extends('admin.admin')

@section('title', 'Avis Utilisateurs')

@section('content')
<div class="p-6 bg-white rounded-xl shadow">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Avis des utilisateurs</h2>

    <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
                <th class="text-left p-3 font-semibold text-gray-600">Utilisateur</th>
                <th class="text-left p-3 font-semibold text-gray-600">Commentaire</th>
                <th class="text-center p-3 font-semibold text-gray-600">Likes</th>
                <th class="text-left p-3 font-semibold text-gray-600">Note</th>
                <th class="text-left p-3 font-semibold text-gray-600">Date</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($reviews as $review)
                <tr class="border-b hover:bg-gray-50 transition">

                    {{-- Utilisateur --}}
                    <td class="p-3 font-medium text-gray-800">
                        {{ $review->user->name ?? 'Utilisateur inconnu' }}
                    </td>

                    {{-- Commentaire --}}
                    <td class="p-3 text-gray-700">
                        “{{ $review->comment }}”
                    </td>

                    {{-- LIKE + Notification --}}
                    <td class="p-3 text-center">
                        <form action="{{ route('reviews.like', $review->id) }}" method="POST">
                            @csrf
                            <button class="text-blue-600 font-semibold hover:underline">
                                 Like ({{ $review->likes }})
                            </button>
                        </form>

                        @if($review->is_liked)
                            <span class="text-green-600 font-bold block mt-1">★ Liké</span>
                        @endif
                    </td>

                    {{-- Note --}}
                    <td class="p-3 text-yellow-500">
                        @for ($i = 0; $i < $review->rating; $i++)
                            ★
                        @endfor
                    </td>

                    {{-- Date --}}
                    <td class="p-3 text-gray-500">
                        {{ $review->created_at->format('d/m/Y à H:i') }}
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">
                        Aucun avis n’a encore été laissé.
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>

    <div class="mt-6">
        {{ $reviews->links() }}
    </div>
</div>
@endsection
