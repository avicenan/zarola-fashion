<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

use function PHPSTORM_META\type;

class Favorite extends Model
{
    use HasFactory;
    protected static $key = 'pG7Rg21A7OGoEcfO4x5z8T0wwFatoiOSsgc7AXMgL2R2XtoIkmrXCq74e8T03mMO';

    public static function getByUser($user_id)
    {
        try {

            $response = Http::withHeaders([
                'x-hasura-admin-secret' => self::$key
            ])->get("https://wise-dove-46.hasura.app/api/rest/get-favorite-by-user/{$user_id}");

            $favorites = $response->json('favorite');
            $agg = $response->json('favorite_aggregate.aggregate.count');
            if ($agg !== 0) {
                $favorites = Favorite::hydrate($favorites)->flatten();

                foreach ($favorites as $f) {
                    $p = Product::getById($f->product_id);
                    $products[] = $p['product'];
                }
            } else {
                $products = [];
            }

            return array('favorites' => collect($products), 'agg' => $agg);
            
        } catch (\Exception $e) {
            return dd($e);
        }
    }

    public static function getByUserProduct($user_id, $product_id)
    {
        try {

            $response = Http::withHeaders([
                'x-hasura-admin-secret' => self::$key
            ])->get("https://wise-dove-46.hasura.app/api/rest/get-specific-favorite/{$user_id}/{$product_id}");

            $data = $response->json('favorite');

            if ($data) {
                $data = Favorite::hydrate($data)->flatten();
            }

            return $data;
            
        } catch (\Exception $e) {
            return dd($e);
        }
    }

    public static function postNewFavorite($data)
    {
        try {

            $response = Http::withHeaders([
                'x-hasura-admin-secret' => self::$key
            ])->post("https://wise-dove-46.hasura.app/api/rest/post-new-favorite/{$data['user_id']}/{$data['product_id']}");

            
            $data = $response->json('insert_favorite');

            return $data;

        } catch (\Exception $e) {
            return dd($e);
        }
    }

    public static function deleteFavorite($data)
    {
        $user_id = $data['user_id'];
        $product_id = $data['product_id'];
        settype($user_id, 'integer');
        settype($product_id, 'integer');

        try {

            $response = Http::withHeaders([
                'x-hasura-admin-secret' => self::$key
            ])->delete("https://wise-dove-46.hasura.app/api/rest/delete-favorite-by-id/{$user_id}/{$product_id}");
            
            $data = $response->json('delete_favorite');

            return $data;

        } catch (\Exception $e) {
            return dd($e);
        }
    }

    // public static function deleteFavoriteById($id)
    // {
    //     try {

    //         $response = Http::withHeaders([
    //             'x-hasura-admin-secret' => self::$key
    //         ])->delete("https://wise-dove-46.hasura.app/api/rest/delete-one-favorite/$id");
            
    //         $data = $response->json('delete_favorite_by_pk');

    //         return dd($data);

    //         return $data;

    //     } catch (\Exception $e) {
    //         return dd($e);
    //     }
    // }

}
