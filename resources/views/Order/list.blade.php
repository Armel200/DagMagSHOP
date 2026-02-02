@extends('admin.admin')
@section('title', 'Commandes')

@section('content')
    <div class="p-6">

        <h1 class="text-3xl font-bold mb-6 text-gray-800">Commandes Clients</h1>

        @forelse($orders as $order)
            <div class="bg-white shadow-lg rounded-xl mb-6 p-6 border border-gray-200">

                {{-- Bouton imprimer --}}
                <div class="flex justify-end mb-4">
                    <button onclick="printInvoice('invoice-{{ $order->id }}')"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                         Imprimer la facture
                    </button>
                </div>
                


                {{-- FACTURE --}}
                <div id="invoice-{{ $order->id }}" class="p-4">

                    <div class="flex justify-between mb-3">
                        <p class="text-lg font-semibold">
                            Commande : <span class="text-blue-600">{{ $order->order_number }}</span>
                        </p>
                        <p class="text-gray-500 text-sm">
                            {{ $order->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    <p><strong>Client :</strong> {{ $order->user->name }}</p>
                    <p><strong>Email :</strong> {{ $order->user->email }}</p>
                    <p><strong>Adresse :</strong> {{ $order->user->address ?? 'Non spécifiée' }}</p>

                    <div class="mt-4">
                        <table class="w-full border border-gray-300 rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="p-3 text-left font-semibold">Produit</th>
                                    <th class="p-3 text-center font-semibold">Quantité</th>
                                    <th class="p-3 text-right font-semibold">Prix unitaire</th>
                                    <th class="p-3 text-right font-semibold">Total</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr class="border-t">
                                        <td class="p-3">{{ $item->product->name }}</td>
                                        <td class="p-3 text-center">{{ $item->quantity }}</td>
                                        <td class="p-3 text-right">
                                            {{ number_format($item->price, 0, ',', '.') }} FCFA
                                        </td>
                                        <td class="p-3 text-right font-semibold">
                                            {{ number_format($item->price * $item->quantity, 0, ',', '.') }} FCFA
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot class="bg-gray-100 border-t">
                                <tr>
                                    <td class="p-3 font-bold">TOTAL</td>
                                    <td></td>
                                    <td></td>
                                    <td class="p-3 text-right font-bold text-blue-700">
                                        {{ number_format($order->total_amount, 0, ',', '.') }} FCFA
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>

                <div class="flex space-x-3 mt-3 justify-end">
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="delivered">
                        <button class="px-4 py-1 bg-green-600 text-white rounded-md text-sm">livrée</button>
                    </form>

                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="pending">
                        <button class="px-4 py-1 bg-yellow-500 text-white rounded-md text-sm">En attente</button>
                    </form>

                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="cancelled">
                        <button class="px-4 py-1 bg-red-600 text-white rounded-md text-sm">Annuler</button>
                    </form>
                </div>

            </div>
        @empty
            <p class="text-gray-500 text-lg">Aucune commande pour l'instant.</p>
        @endforelse
    </div>

    {{-- Script impression --}}
    <script>
        function printInvoice(id) {
            let contents = document.getElementById(id).innerHTML;
            let frame = window.open('', '', 'height=800,width=600');
            frame.document.write('<html><head><title>Facture</title>');
            frame.document.write(
                '<style>body{font-family:Arial;padding:20px;} table{width:100%;border-collapse:collapse;} td,th{border:1px solid #ccc;padding:8px;}</style>'
                );
            frame.document.write('</head><body>');
            frame.document.write(contents);
            frame.document.write('</body></html>');
            frame.document.close();
            frame.print();
        }
    </script>

@endsection
