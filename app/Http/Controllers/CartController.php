<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {   
        if (Session::has('user')) {
            $user = session()->get('user');
            $dataCart = Cart::getByUser($user->id);
            $carts = $dataCart['carts'];
            $aggFav = $dataCart['agg'];
            
            return view('cart.index')->with([
                'user' => $user, 
                'carts' => $carts
            ]);
        } else {
            return redirect('/login')->with('message', 'Silahkan Login Terlebih Dahulu');
        }
    }

    public function create(Request $request)
    {
        $user_id = session('user')['id'] ?? 1;

        $request['user_id'] = $user_id;

        $cart = Cart::postNewCart($request);

        return redirect()->back()->with('msgCart', 'Berhasil menambahkan produk ke keranjang');
    }

    public function delete(Request $request)
    {
        $user_id = session('user')['id'] ?? 1;
        
        $request['user_id'] = $user_id;

        $cart = Cart::deleteCart($request);

        return redirect()->back()->with('msgCart', 'Berhasil menghapus produk dari keranjang');

        // return dd($favorite);
    }
}
