<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Country;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;



class SearchController extends Controller
{

    public function index(Request $request)
    {
        $query = Product::query()->orderByDesc('id');


        if ($request->has('code')) {
            $query->where('code', 'like', '%' . $request->input('code') . '%');
        }

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('is_variant')) {
            $query->where('is_variant', $request->input('is_variant'));
        }
        if ($request->has('category_type_id')) {
            if ($request->input('category_type_id') != 0) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('category_type_id', $request->input('category_type_id'));
                });
            }
        }
        if ($request->has('category_id')) {
            if ($request->input('category_id') != 0) {
                $query->where('category_id', $request->input('category_id'));
            }
        }

        if ($request->has('price_min') && $request->input('price_min') != 0 && $request->input('price_min') != '') {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('price', '>=', $request->input('price_min'));
            });
        }
        if ($request->has('price_max') && $request->input('price_max') != 0 && $request->input('price_max') != '') {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('price', '<=', $request->input('price_max'));
            });
        }
        if ($request->has('supplier_id')) {
            $query->where('supplier_id', $request->input('supplier_id'));
        }

        // edit
        if ($request->has('country_id')) {
            if ($request->input('country_id') != 0)
                $query->whereHas('supplier.user', function ($q) use ($request) {
                    $q->where('country_id', $request->input('country_id'));
                });
        }


        $query->where('hidden',  false);

        $products = $query->paginate(30);

        $categories = Category::all();
        $categoryTypes = CategoryType::all();
        $countries = Country::all();
        $filterCategories = $request->has('category_type_id') ?
            Category::where('category_type_id',  $request->input('category_type_id'))->get()
            :
            Category::all();

        return view('search.index', compact(
            'products',
            'categoryTypes',
            'categories',
            'countries',
            'filterCategories',
        ));
    }

    public function suppliers(Request $request)
    {
        $query = Supplier::query()->orderByDesc('id');

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->has('company_name')) {
            $query->where('company_name', 'like', '%' . $request->input('company_name') . '%');
        }
        if ($request->has('category_type_id')) {
            if ($request->input('category_type_id') != 0) {
                $query->whereHas('products.category', function ($q) use ($request) {
                    $q->where('category_type_id', $request->input('category_type_id'));
                });
            }
        }
        if ($request->has('category_id') && $request->input('category_id') != 0) {
            if ($request->input('category_id') != 0) {
                $query->whereHas('products', function ($q) use ($request) {
                    $q->where('category_id', $request->input('category_id'));
                });
            }
        }

        // edit
        if ($request->has('country_id')) {
            if ($request->input('country_id') != 0)
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('country_id', $request->input('country_id'));
                });
        }
        $suppliers = $query->paginate(30);
        $categoryTypes = CategoryType::all();
        $categories = Category::all();
        $countries = Country::all();
        $filterCategories =  $request->has('category_type_id') ?
            Category::where('category_type_id',  $request->input('category_type_id'))->get()
            :
            Category::all();
        return view('search.all-suppliers', compact(
            'suppliers',
            'categoryTypes',
            'categories',
            'countries',
            'filterCategories',
        ));
    }
}
