<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Cart extends Model
{
    use HasFactory;
    protected static $key = 'LMcBp1qoSDNS5unTGpjJHngz3fJiQN6YstlZIqXoXEl5VofUhQruBWDHeIDv9AWN';

    public static function getByUser($userId)
    {
        try {

            $response = Http::withHeaders([
                'x-hasura-admin-secret' => self::$key
            ])->get("https://merry-tortoise-92.hasura.app/api/rest/get-cart-by-user/{$userId}/10/0");

            $carts = $response->json('cart');
            $agg = $response->json('cart_aggregate.aggregate.count');
            if ($agg !== 0) {
                $carts = Favorite::hydrate($carts)->flatten();

                foreach ($carts as $f) {
                    $p = Product::getById($f->product_id);
                    $products[] = $p['product'];
                }
            } else {
                $products = [];
            }

            return array('carts' => collect($products), 'agg' => $agg);
            
        } catch (\Exception $e) {
            return dd($e);
        }
    }

    public static function postNewCart($data)
    {
        try {

            $response = Http::withHeaders([
                'x-hasura-admin-secret' => self::$key
            ])->post("https://merry-tortoise-92.hasura.app/api/rest/post-new-product-to-cart/{$data['user_id']}/{$data['product_id']}/{$data['size']}/{$data['qty']}");

            
            $data = $response->json('insert_cart');
            $data = Cart::hydrate($data)->flatten();

            return $data;

        } catch (\Exception $e) {
            return dd($e);
        }
    }

    public static function deleteCart($data)
    {
        $user_id = $data['user_id'];
        $product_id = $data['product_id'];
        settype($user_id, 'integer');
        settype($product_id, 'integer');

        try {

            $response = Http::withHeaders([
                'x-hasura-admin-secret' => self::$key
            ])->delete("https://merry-tortoise-92.hasura.app/api/rest/delete-cart-by-id/{$user_id}/{$product_id}");
            
            $data = $response->json('delete_cart');

            return $data;

        } catch (\Exception $e) {
            return dd($e);
        }
    }
}
