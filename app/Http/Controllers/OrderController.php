<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{

  public function index()
{
    // Charger les commandes + items + product + user
    $orders = Order::with(['items.product', 'user'])
                    ->latest()
                    ->get();

    return view('Order.list', compact('orders'));
}



  public function store(Request $request)
{
    if(!Auth::check()){
        return response()->json([
            'success' => false,
            'message' => 'Vous devez être connecté pour passer une commande.'
        ]);
    }

    $request->validate([
        'payment_method' => 'required|in:orange_money,mtn_money',
        'cart' => 'required|array|min:1'
    ]);

    $user = Auth::user();
    $total = collect($request->cart)->sum(fn($item) => $item['price'] * $item['quantity']);

    $order = Order::create([
        'user_id' => $user->id,
        'order_number' => 'CMD-' . strtoupper(Str::random(6)),
        'payment_method' => $request->payment_method,
        'status' => 'pending',
        'total_amount' => $total,

    ]);

    foreach ($request->cart as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item['id'],
            'quantity' => $item['quantity'],
            'price' => $item['price']
        ]);
    }

    return response()->json([
        'success' => true,
        'message' => 'Commande envoyée avec succès !'
    ]);
}


public function userOrders()

{
    $user = Auth::user();
    $orders = Order::with('items.product')
                   ->where('user_id', Auth::id())
                   ->latest()
                   ->get();

    return view('users.mesCom', compact('orders','user'));
}

public function deleteAll()
{
    Order::where('user_id', Auth::id())->delete();

    return back()->with('success', 'Toutes vos commandes ont été supprimées.');
}


public function updateStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);
    $order->status = $request->status;
    $order->save();

    return back()->with('success', 'Statut mis à jour !');
}


}

