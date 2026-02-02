@extends('users.layout')

@section('content')
    <div class="max-w-5xl mx-auto mt-10">

        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold ">Mes Commandes</h3>

            @if ($orders->count() > 0)
                <form action="{{ route('user.orders.deleteAll') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                        Tout supprimer
                    </button>
                </form>
            @endif
        </div>

        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-4 text-left font-semibold">ID</th>
                        <th class="p-4 text-left font-semibold">Montant</th>
                        <th class="p-4 text-left font-semibold">Statut</th>
                        <th class="p-4 text-left font-semibold">Date</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($orders as $order)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-4 font-semibold text-gray-800">
                                #{{ $order->order_number }}
                            </td>

                            <td class="p-4 text-gray-700">
                                <span class="font-bold text-blue-600">
                                    {{ number_format($order->total_amount, 0, '.', ' ') }} FCFA
                                </span>
                            </td>

                            <td class="p-4">
                                @if ($order->status === 'pending')
                                    <span class="px-3 py-1 bg-yellow-200 text-yellow-800 rounded-full text-sm">En
                                        attente</span>
                                @elseif ($order->status === 'delivered')
                                    <span class="px-3 py-1 bg-green-200 text-green-800 rounded-full text-sm">Livrée</span>
                                @elseif ($order->status === 'cancelled')
                                    <span class="px-3 py-1 bg-red-200 text-red-800 rounded-full text-sm">Annulée</span>
                                @endif
                            </td>

                            <td class="p-4 text-gray-500">
                                {{ $order->created_at->format('d/m/Y à H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-6 text-center text-gray-500">
                                Vous n’avez encore passé aucune commande.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
