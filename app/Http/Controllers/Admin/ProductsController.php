<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);

        $query = Product::query();

        if ($request->has('code')) {
            $query->where('code', 'like', '%' . $request->input('code') . '%');
        }

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('description')) {
            $query->where('description', 'like', '%' . $request->input('description') . '%');
        }

        if ($request->has('is_variant')) {
            $query->where('is_variant', $request->input('is_variant'));
        }

        if ($request->has('hidden')) {
            $query->where('hidden', $request->input('hidden'));
        }

        if ($request->has('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }
        if ($request->has('supplier_id')) {
            $query->where('supplier_id', $request->input('supplier_id'));
        }

        $products = $query->paginate($perPage);
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('admin.products.index', compact('products', 'categories', 'suppliers'));
    }

    // public function show($id)
    // {
    //     $product = Product::findOrFail($id);
    //     return view('admin.products.show', compact('product'));
    // }

    public function update(Request $request, Product $product)
    {
        if ($request->has('edit_hidden')) {
            $product->update(['hidden' => !$product->hidden]);
            return redirect()->back()->with('success', 'Product hidden updated successfully.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|min:8',
            'image' => 'required|file',
        ]);
        if ($request->hasFile('image')) {
            $imageName = '/product' . $product->id . '-' . time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('storage/image/product'), $imageName);
            $validatedData['image'] = 'storage/image/product' . $imageName;
            $product->update($validatedData);
            return redirect()->back()->with('success', 'Product image updated successfully.');
        }
        return redirect()->back()->with('error', 'No action!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
