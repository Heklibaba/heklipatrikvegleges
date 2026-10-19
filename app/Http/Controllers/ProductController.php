<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $categoryId = $request->category_id;

        $products = Product::with('category')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($categoryId, function ($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->get();

        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'alcohol_percent' => 'required|numeric|min:0|max:100',
            'price' => 'required|integer|min:0|max:4294967295'
        ]);

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'alcohol_percent' => $request->alcohol_percent,
            'price' => $request->price
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Termék sikeresen hozzáadva!');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'alcohol_percent' => 'required|numeric|min:0|max:100',
            'price' => 'required|integer|min:0|max:4294967295'
        ]);

        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'alcohol_percent' => $request->alcohol_percent,
            'price' => $request->price
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Termék módosítva!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Termék törölve!');
    }
}
