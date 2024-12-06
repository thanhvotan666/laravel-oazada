<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductKeyAttribute;
use App\Models\ProductVariant;
use App\Models\Supplier;
use App\Models\VariantOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $perPage = $request->input('per_page', 5);
        $supplier = Supplier::where('user_id', Auth::id())->first();
        $query = Product::query()->where('supplier_id', $supplier->id);

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

        $products = $query->paginate($perPage);
        $categories = Category::all();

        return view('supplier.products.index', compact('products', 'categories', 'user'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $category_types = CategoryType::all();

        return view('supplier.products.create', compact('user', 'category_types'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'code' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image',

            'fragile' => 'nullable|boolean',
            'biodegradable' => 'nullable|boolean',
            'frozen' => 'nullable|boolean',
            'max_temp' => 'nullable|string',
            'expiry' => 'nullable|boolean',
            'expiry_date' => 'nullable|date',
            'key_attributes' => 'nullable|string',

            'price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|numeric|min:0',
            'weight' => 'nullable|numeric|min:0',

        ]);
        if ($request->hasFile('image')) {
            $imageName = '/product-' . time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('storage/image/product'), $imageName);
            $validatedData['image'] = 'storage/image/product' . $imageName;
        }
        $validatedData['supplier_id'] = $user->supplier->id;
        $validatedData['is_variant'] = false;

        $product = Product::create($validatedData);
        //create product
        if (!isset($validatedData['fragile'])) {
            $validatedData['fragile'] = false;
        }
        if (!isset($validatedData['biodegradable'])) {
            $validatedData['biodegradable'] = false;
        }
        if (!isset($validatedData['frozen'])) {
            $validatedData['frozen'] = false;
        }
        if (!isset($validatedData['expiry'])) {
            $validatedData['expiry'] = false;
        }

        $validatedData['product_id'] = $product->id;
        ProductAttribute::create($validatedData);
        //create ProductAttribute
        if ($request->input('key_attributes') != '') {
            $keyAtts = array_map(function ($keyAtt) {
                $arrKeyAtt = explode('[:]', $keyAtt);
                return [
                    'name' => $arrKeyAtt[0],
                    'value' => $arrKeyAtt[1],
                ];
            }, explode('[;]', $request->input('key_attributes')));

            //dd($validatedData, $keyAtts);
            foreach ($keyAtts as $KeyAtt) {
                $ProductKeyAttribute = ProductKeyAttribute::where('product_id', $product->id)
                    ->where('name', $KeyAtt['name'])
                    ->firstOr(
                        ['*'],
                        function () use ($product, $KeyAtt) {
                            return ProductKeyAttribute::create([
                                'product_id' => $product->id,
                                'name' => $KeyAtt['name'],
                                'value' => $KeyAtt['value'],
                            ]);
                        }
                    );
            }
        }


        if ($request->input('value') != '') {
            $types = explode(';', $request->input('type'));
            $values = array_map(function ($value) {
                $parts = explode(':', $value);
                $pristowei = explode(', ', $parts[1]);
                return [
                    'optionValues' => explode(', ', $parts[0]),
                    'price' => $pristowei[0],
                    'stock' => $pristowei[1],
                    'weight' => $pristowei[2],
                ];
            }, explode(';', $request->input('value')));

            //dd($validatedData, $types, $values);
            foreach ($values as $value) {
                $productVariant = ProductVariant::create([
                    'product_id' => $product->id,
                    'price' => $value['price'],
                    'stock' => $value['stock'],
                    'weight' => $value['weight'],
                ]);
                for ($i = 0; $i < count($types); $i++) {
                    VariantOption::create([
                        'product_variant_id' => $productVariant->id,
                        'name' => $types[$i],
                        'value' => $value['optionValues'][$i],
                    ]);
                }
            }
        }

        if (ProductVariant::where('product_id', $product->id)->count() > 1) {
            $product->update(['is_variant' => true]);
        }

        return redirect()->route('supplier.products.index')->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($id);
        return view('supplier.products.show', compact('product', 'user'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($id);
        $category_types = CategoryType::all();
        return view('supplier.products.edit', compact('product', 'category_types', 'user'));
    }

    public function update(Request $request, Product $product)
    {

        if ($request->has('edit_hidden')) {
            $product->update(['hidden' => !$product->hidden]);
            return back()->with('success', 'Product hidden updated successfully.');
        }
        //dd($request);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'code' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image',

            'fragile' => 'nullable|boolean',
            'biodegradable' => 'nullable|boolean',
            'frozen' => 'nullable|boolean',
            'max_temp' => 'nullable|string',
            'expiry' => 'nullable|boolean',
            'expiry_date' => 'nullable|date',
            'key_attributes' => 'nullable|string',

            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('image')) {
            $imageName = '/product-' . time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('storage/image/product'), $imageName);
            $validatedData['image'] = 'storage/image/product' . $imageName;
        }

        $productAttribute = ProductAttribute::where('product_id', $product->id)->first();


        $values = array_map(function ($value) {
            $parts = explode(':', $value);
            $pristowei = explode(', ', $parts[1]);
            return [
                'optionValues' => explode(', ', $parts[0]),
                'price' => $pristowei[0],
                'stock' => $pristowei[1],
                'weight' => $pristowei[2],
            ];
        }, explode(';', $request->input('value')));

        $keyAtts = array_map(function ($keyAtt) {
            $arrKeyAtt = explode('[:]', $keyAtt);
            return [
                'name' => $arrKeyAtt[0],
                'value' => $arrKeyAtt[1],
            ];
        }, explode('[;]', $request->input('key_attributes')));
        //dd($request, $values, $keyAtts);

        if ($product->is_variant) {
            foreach ($values as $value) {
                $query =  ProductVariant::query()->where('product_id', $product->id);
                foreach ($value['optionValues'] as $option) {
                    $query->whereHas('options', function ($q) use ($option) {
                        $q->where('value', $option);
                    });
                }
                $variant = $query->get()->first();

                $variant->update($value);
            }
        } else {
            $variant = ProductVariant::where('product_id', $product->id)->first();
            $variant->update([
                'price' => $validatedData['price'],
                'stock' => $validatedData['stock'],
                'weight' => $validatedData['weight'],
            ]);
        }
        foreach ($keyAtts as $KeyAtt) {
            $ProductKeyAttribute = ProductKeyAttribute::where('product_id', $product->id)
                ->where('name', $KeyAtt['name'])
                ->firstOr(
                    ['*'],
                    function () use ($product, $KeyAtt) {
                        return ProductKeyAttribute::create([
                            'product_id' => $product->id,
                            'name' => $KeyAtt['name'],
                            'value' => '',
                        ]);
                    }
                );
            if ($KeyAtt['value'] != '') {
                $ProductKeyAttribute->update(['value' => $KeyAtt['value']]);
            } else {
                $ProductKeyAttribute->delete();
            }
        }
        if (!isset($validatedData['fragile'])) {
            $validatedData['fragile'] = false;
        }
        if (!isset($validatedData['biodegradable'])) {
            $validatedData['biodegradable'] = false;
        }
        if (!isset($validatedData['frozen'])) {
            $validatedData['frozen'] = false;
        }
        if (!isset($validatedData['expiry'])) {
            $validatedData['expiry'] = false;
        }
        // dd($validatedData);

        $product->update($validatedData);
        $productAttribute->update($validatedData);
        return redirect()->route('supplier.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('supplier.products.index')->with('success', 'Product deleted successfully.');
    }
}
