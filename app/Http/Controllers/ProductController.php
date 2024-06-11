<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $request->validate(['page' => 'string|max:255']);

        $limit = 5;
        $currentPage = $request->page ?? 1;
        $offset = $limit * ($currentPage-1);

        $data = Product::getAll($limit, $offset);
        $products = $data['products'];
        $agg = $data['agg'];

        $countPage = round($agg / $limit, 0);
        $availPage = [];
        for ($i = 1; $i <= $countPage; $i++) {
            $availPage[] = $i;
        }

        return view('product.index')->with([
            'location' => 'Home',
            'products' => $products,
            'agg' => $agg,
            'availPage' => $availPage,
            'emptyResult' => false
        ]);
    }

    public function indexSearch(Request $request)
    {
        $request->validate(['q' => 'string|max:255']);

        $limit = 5;
        $currentPage = $request->page ?? 1;
        $offset = $limit * ($currentPage-1);
        
        $data = Product::getAll($limit, $offset);
        $products = $data['products'];
        $agg = $data['agg'];

        $searchQuery = $request->input('q');
        $products = $products->filter(function ($product) use ($searchQuery) {
            return false !== stristr($product->name, $searchQuery);
        });
        $agg = $products->count();

        if($products->isEmpty()) {
            $products = $data['products'];
            $agg = $data['agg'];
            $emptyResult = true;
        }

        $countPage = round($agg / $limit, 0);
        $availPage = [];
        for ($i = 1; $i <= $countPage; $i++) {
            $availPage[] = $i;
        }

        return view('product.index')->with([
            'location' => 'Pencarian untuk ' . "'$searchQuery'",
            'path' => $searchQuery,
            'products' => $products,
            'agg' => $agg,
            'availPage' => $availPage,
            'emptyResult' => $emptyResult ?? false
        ]);
    }

    public function indexCategory($category, Request $request)
    {
        $request->validate(['page' => 'string|max:255']);

        $limit = 5;
        $currentPage = $request->page ?? 1;
        $offset = $limit * ($currentPage-1);

        $data = Product::getByCategory($category, $limit, $offset);
        $products = $data['products'];
        $agg = $data['agg'];

        if($products->isEmpty()) {
            $emptyResult = true;
        }

        $countPage = round($agg / $limit, 0);
        $availPage = [];
        for ($i = 1; $i <= $countPage; $i++) {
            $availPage[] = $i;
        }

        return view('product.index')->with([
            'location' => $category,
            'products' => $products,
            'agg' => $agg,
            'emptyResult' => $emptyResult ?? false,
            'availPage' => $availPage,
            'category' => $category
        ]);
    }

    public function indexBrand($brand, Request $request)
    {
        $request->validate(['page' => 'string|max:255']);

        $limit = 5;
        $currentPage = $request->page ?? 1;
        $offset = $limit * ($currentPage-1);

        $data = Product::getByBrand($brand, 5, 0);
        $products = $data['products'];
        $agg = $data['agg'];

        if($products->isEmpty()) {
            $emptyResult = true;
        }

        $countPage = round($agg / $limit, 0);
        $availPage = [];
        for ($i = 1; $i <= $countPage; $i++) {
            $availPage[] = $i;
        }

        return view('product.index')->with([
            'location' => $brand,
            'products' => $products,
            'agg' => $agg,
            'emptyResult' => $emptyResult ?? false,
            'availPage' => $availPage,
            'category' => $brand
        ]);
    }

    public function show(Request $request, $slug, $id)
    {
        $userId = session('user')['id'] ?? 1;

        $request->validate(['size' => 'string|max:255']);

        $data = Product::getById($id);
        $product = $data['product'];
        $stock = $data['stock'];
        
        $dataVariant = Product::getByName($product->name);
        $variant = $dataVariant['products'];
        $variantAgg = $dataVariant['agg'];

        $sku = $stock->where('size', $request->size)->first();

        $isFav = Favorite::getByUserProduct($userId, $product->id);
    
        return view('product.show')->with([
            'product' => $product,
            'stock' => $stock,
            'variant' => $variant,
            'variantAgg' => $variantAgg,
            'sku' => $sku,
            'isFav' => $isFav
        ]);
    }
}
