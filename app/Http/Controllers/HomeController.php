<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = Product::getAll(3, 0);
        $products = $data['products'];
        $agg = $data['agg'];

        return view('home')->with([
            'products' => $products,
            'agg' => $agg,
            'location' => 'Home'
        ]);
    }
}
