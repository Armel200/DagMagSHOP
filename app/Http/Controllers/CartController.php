<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Afficher le panier
    public function show()
    {
        $cart = session()->get('cart', []);
        return view('cart.show', compact('cart'));
    }

    // Ajouter un produit
    public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        return response()->json(['count' => count($cart)]);
    }

    // Vider le panier
    public function clear()
    {
        session()->forget('cart');
        return response()->json(['success' => true]);
    }

    // Passer la commande
    public function order()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Votre panier est vide.');
        }

        // (Ici, tu peux sauvegarder la commande en base avant de rediriger)
        // Exemple :
        // Order::create([...])

        session()->forget('cart');
        return redirect()->route('home')->with('success', 'Commande envoyée à l\'administrateur.');
    }
}
