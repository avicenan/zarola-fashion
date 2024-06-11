<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function create(Request $request)
    {
        $user_id = session('user')['id'];
        
        $request['user_id'] = $user_id;

        $favorite = Favorite::postNewFavorite($request);

        return redirect()->back()->with('msgFav', 'Berhasil menambahkan produk ke favorit');

        // return dd($favorite);
    }

    public function delete(Request $request)
    {
        $user_id = session('user')['id'] ?? 1;
        
        $request['user_id'] = $user_id;

        $favorite = Favorite::deleteFavorite($request);

        return redirect()->back()->with('msgFav', 'Berhasil menghapus produk dari favorit');

        // return dd($favorite);
    }
}
