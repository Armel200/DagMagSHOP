<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Like;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /*** -------------------------------
     *  🔹 PARTIE ADMIN (inchangée)
     * -------------------------------*/
    
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        $query = Product::query();

        // Recherche par nom
        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        // Filtre par statut
        if (!empty($status) && $status !== 'All') {
            $query->where('status', $status);
        }

        // Filtre par prix
        if (!empty($minPrice) && !empty($maxPrice)) {
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        $productss = $query->paginate(10)->appends($request->query());

        return view('Product.list', compact('productss', 'search', 'status', 'minPrice', 'maxPrice'));
    }

    public function create()
    {
        return view('Product.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'views' => 'required|numeric',
            'status' => 'required|string|in:Active,Inactive',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('list.product')->with('success', 'Produit ajouté avec succès !');
    }

    public function edit($id)
    {
        $productss = Product::findOrFail($id);
        return view('Product.edit', compact('productss'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'views' => 'required|numeric',
            'status' => 'required|string|in:Active,Inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('list.product')->with('success', 'Produit mis à jour avec succès !');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        $product->delete();

        return redirect()->route('list.product')->with('success', 'Produit supprimé avec succès !');
    }

    /*** -------------------------------
     *   PARTIE FRONT UTILISATEUR
     * -------------------------------*/

    // Affichage des produits du site (page d’accueil)
   public function home(Request $request)
{
    // Construire la requête (filtrée et ordonnée)
    $query = Product::where('status', 'Active')->latest();

    // Paginer 30 produits par page et conserver les paramètres de la requête
    $products = $query->paginate(30)->appends($request->query());

     $reviews = Review::with('user')
        ->latest()
        ->take(10) // les 10 plus récents
        ->get();

    return view('Home.home', compact('products', 'reviews'));
}

    // Like / Unlike
    public function like(Request $request, Product $product)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $existing = $product->likes()->where('user_id', $user->id)->first();

        if ($existing) {
            $existing->delete();
            $liked = false;
        } else {
            $product->likes()->create(['user_id' => $user->id]);
            $liked = true;
        }

        $count = $product->likes()->count();

        return response()->json([
            'liked' => $liked,
            'count' => $count
        ]);
    }

    // Ajouter un produit au panier
    public function addToCart(Request $request, Product $product)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();

        $item = CartItem::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $item->quantity += 1;
            $item->save();
        } else {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        $cartCount = CartItem::where('user_id', $user->id)->sum('quantity');

        return response()->json([
            'success' => true,
            'cartCount' => $cartCount
        ]);
    }


    public function suggestions(Request $request)
{
    $query = $request->q;

    $results = Product::where('name', 'LIKE', "%$query%")
                      ->limit(6)
                      ->get(['id', 'name']);

    return response()->json($results);
}

public function show($id)
{
    $product = Product::findOrFail($id);
    
    return view('Product.show', compact('product'));
}

   
}
