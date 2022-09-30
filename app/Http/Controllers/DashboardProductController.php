<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Category;

use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Support\Str;
use App\ProductGallery;

class DashboardProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::with(['galleries', 'category'])
            ->where('users_id', Auth::user()->id)
            ->get();
        return view('pages.dashboard-products', [
            'products' => $products
        ]);
    }

    public function details(Request $request, $id)
    {
        $product = Product::with(['galleries', 'user', 'category'])->findOrFail($id);
        $categories = Category::all();

        return view('pages.dashboard-products-details', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();

        $data['photos'] = $request->file('photos')->store('assets/products', 'public');

        ProductGallery::create($data);

        return redirect()->route('dashboard-product-details', $request->products_id);
    }

    public function deleteGallery(Request $request, $id)
    {
        $item = ProductGallery::findOrFail($id);

        $item->delete();

        return redirect()->route('dashboard-product-details', $item->products_id);
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.dashboard-products-create', [
            "categories" => $categories
        ]);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        //Dimasukkan ke model Product
        $product = Product::create($data);
        $gallery = [
            'products_id' => $product->id,
            'photos' => $request->file('photo')->store('assets/product', 'public')
        ];

        ProductGallery::create($gallery);

        return redirect()->route('dashboard-product');
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();

        //Dimasukkan ke model Product
        $item = Product::findOrFail($id);
        $data['slug'] = Str::slug($request->name);
        $item->update($data);

        return redirect()->route('dashboard-product');
    }
}
