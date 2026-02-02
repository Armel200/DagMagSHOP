<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::with('products');

        // Recherche par nom ou code
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
        }

        // Trier par défaut ou autres critères
        $sort = $request->get('sort', 'default');
        if ($sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($sort == 'name_desc') {
            $query->orderBy('name', 'desc');
        } else {
            $query->latest(); // default: ordre récent
        }

        // Pagination
        $categoriess = $query->paginate(4)->withQueryString();
    //      // Pagination
    // $products = $query->paginate(4)->appends($request->query());

        return view('Category.list', compact('categoriess'));
    }


    public function create()
    
    {
        
        $code = 'CAT-' . Str::upper(Str::random(6));

    return view('Category.create', compact('code'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:categories,code',
        ]);

        Category::create($validated);

        return redirect()->route('list.category')->with('success', 'Catégorie ajoutée avec succès !');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('Category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:categories,code,' . $category->id,
        ]);

        $category->update($validated);

        return redirect()->route('list.category')->with('success', 'Catégorie mise à jour avec succès !');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('list.category')->with('success', 'Catégorie supprimée avec succès !');
    }


    public function show($id)
{
    $category = Category::findOrFail($id);
    return view('Category.show', compact('category'));
}


}