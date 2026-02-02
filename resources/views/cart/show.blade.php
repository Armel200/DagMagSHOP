@extends('Home.master')
@section('title', 'DacMadSHOP-Mon Panier')

@section('content')
<div class="max-w-4xl mx-auto my-10 p-6 bg-white rounded-lg shadow mb-[150px]">
    <h2 class="text-2xl font-bold mb-6"> Mon Panier</h2>

    @if(count($cart) > 0)
        <div class="overflow-x-auto">
        <table class="w-full border-collapse mb-6 min-w-[600px]">
            <thead>
                <tr class="border-b text-left">
                    <th class="p-3">Produit</th>
                    <th class="p-3">Prix</th>
                    <th class="p-3">Quantité</th>
                    <th class="p-3">Total</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $id => $item)
                    @php $total += $item['price'] * $item['quantity']; @endphp
                    <tr class="border-b">
                        <td class="p-3 flex items-center gap-3">
                            <img src="{{ asset('storage/' . $item['image']) }}" class="w-12 h-12 object-cover rounded">
                            {{ $item['name'] }}
                        </td>
                        <td class="p-3">{{ number_format($item['price'], 0, ',', ' ') }} FCFA</td>
                        <td class="p-3">{{ $item['quantity'] }}</td>
                        <td class="p-3 font-semibold">{{ number_format($item['price'] * $item['quantity'], 0, ',', ' ') }} FCFA</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center mt-6 gap-4 md:gap-0">
            <p class="text-xl font-bold">Total : {{ number_format($total, 0, ',', ' ') }} FCFA</p>

            <div class="flex gap-4 flex-wrap">
                <form action="{{ route('cart.clear') }}" method="POST" id="clear-cart-form">
                    @csrf
                    <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
                        Annuler la commande
                    </button>
                </form>

                <button id="checkoutBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                   Passer la commande
                </button>
            </div>
        </div>

        <!-- Formulaire de paiement -->
        <form id="checkoutForm" class="bg-white p-6 rounded-xl shadow-md max-w-lg mx-auto mt-6 hidden">
            <h2 class="text-xl font-semibold mb-4">Mode de paiement</h2>

            <select name="payment_method" id="payment_method" class="border rounded w-full p-2 mb-4">
                <option value="">-- Choisir --</option>
                <option value="orange_money">Orange Money</option>
                <option value="mtn_money">MTN Mobile Money</option>
            </select>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Valider la commande
            </button>
            <p id="orderMessage" class="text-green-600 mt-4 hidden"></p>
        </form>
    @else
        <p class="text-gray-500 text-center">Votre panier est vide.</p>
    @endif
</div>

<script>
const checkoutBtn = document.getElementById('checkoutBtn');
const checkoutForm = document.getElementById('checkoutForm');
const cart = @json($cart);

checkoutBtn.addEventListener('click', () => {
    checkoutForm.classList.remove('hidden');
    checkoutBtn.disabled = true;
});

document.getElementById('clear-cart-form')?.addEventListener('submit', function(e) {
    e.preventDefault();
    fetch(this.action, {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
    }).then(res => res.json())
      .then(() => window.location.href = '/');
});

checkoutForm.addEventListener('submit', async function(e) {
    e.preventDefault();
    const payment = document.getElementById('payment_method').value;
    if (!payment) {
        alert("Veuillez choisir un mode de paiement");
        return;
    }

    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const res = await fetch('{{ route('orders.store') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
        },
        body: JSON.stringify({
            payment_method: payment,
            cart: cart
        })
    });

    const data = await res.json();
    const msgEl = document.getElementById('orderMessage');

if(data.success){
    msgEl.textContent = data.message;
    msgEl.classList.remove('hidden');
    checkoutForm.querySelector('button').disabled = true;
    setTimeout(() => window.location.href = '/', 3000);
} else {
    msgEl.textContent = "Erreur : " + data.message;
    msgEl.classList.remove('hidden');
    msgEl.classList.add('text-red-600');
}
// });
    // const data = await res.json();
    // if(data.success){
    //     alert(data.message);
    //     window.location.href = '/'; // redirection accueil
    // } else {
    //     alert("Erreur lors de la commande : " + data.message);
    // }
});
</script>
@endsection
