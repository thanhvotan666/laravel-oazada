<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryType;
use Illuminate\Http\Request;

class CategoryTypesController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);

        $query = CategoryType::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $categoryTypes = $query->paginate($perPage);

        return view('admin.category_types.index', compact('categoryTypes'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:category_types',
        ]);

        CategoryType::create($request->all());
        return redirect()->route('admin.category_types.index')->with('success', 'Category Type created successfully.');
    }

    public function update(Request $request, $id)
    {
        $categoryType = CategoryType::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255|unique:category_types',
        ]);

        $categoryType->update($request->all());
        return redirect()->route('admin.category_types.index')->with('success', 'Category Type updated successfully.');
    }

    public function destroy($id)
    {
        $categoryType = CategoryType::findOrFail($id);
        $categoryType->delete();
        return redirect()->route('admin.category_types.index')->with('success', 'Category Type deleted successfully.');
    }
}
