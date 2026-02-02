<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Page Admin des avis
     */
    public function indexAdmin()
    {
        $reviews = Review::with('user', 'product')
            ->latest()
            ->paginate(10);

        return view('Comment.cm', compact('reviews'));
    }

    /**
     * Formulaire manuel
     */
    public function create()
    {
        return view('Comment.create');
    }

    /**
     * Sauvegarde manuelle d'un avis
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
            'rating'  => 'nullable|integer|min:1|max:5',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'rating'  => $request->rating ?? 5,
        ]);

        return redirect()->route('home')->with('success', 'Merci pour votre avis !');
    }

    /**
     * ⚡ Création automatique d’un avis lors du LIKE
     */
    public function storeFromLike(Product $product)
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        // Empêcher doublons : un avis par like du même produit
        $already = Review::where('user_id', $user->id)
                         ->where('product_id', $product->id)
                         ->where('comment', 'LIKE', '%like%')
                         ->first();

        if ($already) {
            return false;
        }

        Review::create([
            'user_id'    => $user->id,
            'product_id' => $product->id,
            'comment'    => "🩷 a liké le produit : {$product->name}",
            'rating'     => 5,
        ]);

        return true;
    }

    public function like($id)
{
    $review = Review::findOrFail($id);

    $review->likes += 1;             // ajoute un like
    $review->is_liked = true;        // visible côté admin

    $review->save();
    

    return back()->with('success', 'Merci pour votre like !');
}
}
