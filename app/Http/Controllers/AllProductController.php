<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AllProductController extends Controller
{
    //
   // Affichage des produits du site (page d’accueil)
   public function homes()
{
    $products = Product::where('status', 'Active')->latest()->get();
    $cart = session()->get('cart', []);

    $cartCount = collect($cart)->sum('quantity');
    $cartTotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

    return view('Home.allproduct', compact('products','cart','cartCount','cartTotal'));
}
}
