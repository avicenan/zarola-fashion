<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // Tambahkan metode index() di sini jika belum ada
    public function index()
    {   
        if (Session::has('user')) {
            $user = session()->get('user');
            $dataFav = Favorite::getByUser($user->id);
            $favorites = $dataFav['favorites'];
            $aggFav = $dataFav['agg'];
            
            return view('user.show')->with([
                'user' => $user, 
                'favorites' => $favorites
            ]);
        } else {
            return redirect('/login')->with('message', 'Silahkan Login Terlebih Dahulu');
        }

    }

    // Metode lain yang mungkin ada
}
