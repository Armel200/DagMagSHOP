<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Page d'accueil principale
   public function index(Request $request)
    {
        // Catégories avec produits actifs
        $query = Category::with(['products' => function ($q) {
            $q->where('status', 'Active');
        }]);

        // Recherche
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
        }

        $categories = $query->get();

        // 👉 30 produits actifs seulement
        $products = Product::with('likes')
            ->where('status', 'Active')
            ->latest()
            ->take(30)
            ->get();

        // Avis récents
        $reviews = Review::with('user')
            ->latest()
            ->take(10)
            ->get();

        return view('Home.home', compact('categories', 'products', 'reviews'));
    }


    // Une autre page (si tu veux séparer)
    public function indexs()
    {
         $categories = Category::orderBy('name')->get();
        $categories = Category::with('products')->get();
        $products = Product::with('likes')->get();

        return view('Home.home', compact('categories', 'products','categories'));
    }
}
