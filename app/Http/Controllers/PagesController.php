<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Country;
use App\Models\Product;
use App\Models\ProductKeyword;
use App\Models\ProductReview;
use App\Models\ProductVariant;
use App\Models\Supplier;
use App\Models\SupplierContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        $newArrivals = Product::orderByDesc('id')->take(4)->get();
        $productInspirations = Product::inRandomOrder()->take(60)->get();
        $countries =  Country::take(10)->get();
        $categoryTypes = CategoryType::all();
        return view('index', compact(
            'countries',
            'productInspirations',
            'newArrivals',
            'categoryTypes'
        ));
    }

    public function product(Request $request, $id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        $categoryTypes = CategoryType::all();
        $supplierProducts = Product::where('supplier_id',  $product->supplier->id)
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->take(5)
            ->get();
        $popularProducts = Product::where('id', '!=', $id)
            ->inRandomOrder()
            ->take(20)
            ->get();
        $recommendations = Product::where('supplier_id',  $product->supplier->id)
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->take(3)
            ->get();
        $product_review_per_page = $request->input('product_review_per_page', 3);
        $productReviewsAll = ProductReview::where('product_id', $id)
            ->orderByDesc('id')->get();
        $productReviews = ProductReview::where('product_id', $id)
            ->orderByDesc('id')->paginate(3);
        $reviewsAll = ProductReview::wherehas(
            'product.supplier',
            function ($q) use ($product) {
                $q->where('id', $product->supplier->id);
            }
        )->orderByDesc('id')->get();
        $reviews = ProductReview::wherehas(
            'product.supplier',
            function ($q) use ($product) {
                $q->where('id', $product->supplier->id);
            }
        )->orderByDesc('id')->paginate(3);

        $product->update(['view' => $product->view + 1]);
        return view('pages.product', compact(
            'product',
            'categoryTypes',
            'supplierProducts',
            'popularProducts',
            'recommendations',
            'productReviews',
            'productReviewsAll',
            'reviews',
            'reviewsAll'

        ));
    }

    public function supplier(Request $request, $id)
    {
        $supplier = Supplier::where('id', $id)->firstOrFail();
        $categoryTypes = CategoryType::all();
        $categorySupplier = Category::whereHas('products', function ($q) use ($supplier) {
            $q->where('supplier_id', $supplier->id);
        })->take(5)->get();

        $newTrendingProducts = Product::where('supplier_id', $supplier->id)
            ->where('hidden', false)
            ->orderByDesc('updated_at')
            ->take(2)
            ->get();
        $topPicks = Product::with('variants')
            ->where('supplier_id', $supplier->id)
            ->where('hidden', false)
            ->withSum('variants as sold_stock', DB::raw('total_stock - stock'))
            ->orderByDesc('sold_stock')
            ->take(10)
            ->get();
        $newProducts = Product::where('supplier_id', $supplier->id)
            ->where('hidden', false)
            ->inRandomOrder()
            ->take(12)
            ->get();
        return view('pages.supplier', compact(
            'categoryTypes',
            'supplier',
            'categorySupplier',
            'newTrendingProducts',
            'topPicks',
            'newProducts'
        ));
    }

    public function supplierProducts(Request $request, $id)
    {
        $supplier = Supplier::where('id', $id)->firstOrFail();
        $categoryTypes = CategoryType::all();
        return view('pages.supplier', compact(
            'categoryTypes',
        ));
    }
    public function supplierContacts(Request $request, $id)
    {
        $supplier = Supplier::find($id);
        $categoryTypes = CategoryType::all();
        return view('pages.supplier.contact', compact(
            'categoryTypes',
            'supplier'
        ));
    }

    public function checkSupplierContacts(Request $request)
    {
        $supplier = Supplier::find($request->supplier_id);
        if (!$supplier) {
            return back()->with('error', "Supplier not found!");
        }
        $validateData = $request->validate([
            'requirement' => 'required|string|min:10',
            'recommend' => 'nullable|boolean',
            'business_card' => 'nullable|boolean'
        ]);
        $validateData['user_id'] = auth()->id();
        $validateData['supplier_id'] = $supplier->id;
        $validateData['requirement'] = trim($validateData['requirement']);
        //dd($validateData);
        SupplierContact::create($validateData);
        return redirect(route('supplier-contacts', $supplier->id))->with('success', "You have successfully submitted your request.");
    }

    public function category(Request $request, $id)
    {
        $category = Category::find($id);
        $keywords = ProductKeyword::whereHas('product', function ($q) use ($category) {
            $q->where('category_id', $category->id);
        })->inRandomOrder()->get()->unique('keyword');
        $categoryTypes = CategoryType::all();

        $keyProducts = Product::where('category_id', $category->id)->paginate(30);
        return view('pages.category', compact(
            'category',
            'keywords',
            'categoryTypes',
            'keyProducts',
        ));
    }
}
