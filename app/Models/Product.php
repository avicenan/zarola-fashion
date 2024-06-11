<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Product extends Model
{
    use HasFactory;
    protected static $key = 'UWvfnLJO0V03eIgCQ05QewyJYDicfBNn2j1d7pc2SDGgPdDgiSZLKzcrv70x41ab';

    public static function getAll($limit, $offset)
    {
        try {

            $response = Http::withHeaders([
                'x-hasura-admin-secret' => self::$key
            ])->get("https://latihangraphiql.hasura.app/api/rest/get-product/{$limit}/{$offset}");
            
            $products = $response->json('product');
            $agg = $response->json('product_aggregate.aggregate.count');

            if ($products) {
                $products = Product::hydrate($products)->flatten();
            }

            return array("products" => $products, "agg" => $agg);
            
        } catch (\Exception $e) {
            return dd($e);
        }
    }

    public static function getByName($name)
    {
        try {

            $response = Http::withHeaders([
                'x-hasura-admin-secret' => self::$key
            ])->get("https://latihangraphiql.hasura.app/api/rest/get-product-by-name/{$name}");
            
            $products = $response->json('product');
            $agg = $response->json('product_aggregate.aggregate.count');

            if ($products) {
                $products = Product::hydrate($products)->flatten();
            }
            

            return array("products" => $products, "agg" => $agg);
            
        } catch (\Exception $e) {
            return dd($e);
        }
    }

    public static function getByCategory($category, $limit, $offset)
    {
        try {

            $response = Http::withHeaders([
                'x-hasura-admin-secret' => self::$key
            ])->get("https://latihangraphiql.hasura.app/api/rest/get-product-by-category/{$category}/{$limit}/{$offset}");
            
            $products = $response->json('product');
            $agg = $response->json('product_aggregate.aggregate.count');

            if ($products) {
                $products = Product::hydrate($products)->flatten();
            }

            return array("products" => $products, "agg" => $agg);
            
        } catch (\Exception $e) {
            return dd($e);
        }
    }

    public static function getByBrand($brand, $limit, $offset)
    {
        try {

            $response = Http::withHeaders([
                'x-hasura-admin-secret' => self::$key
            ])->get("https://latihangraphiql.hasura.app/api/rest/get-product-by-brand/{$brand}/{$limit}/{$offset}");
            
            $products = $response->json('product');
            $agg = $response->json('product_aggregate.aggregate.count');

            if ($products) {
                $products = Product::hydrate($products)->flatten();
            }

            return array("products" => $products, "agg" => $agg);
            
        } catch (\Exception $e) {
            return dd($e);
        }
    }

    public static function getById($id)
    {
        try {

            $response = Http::withHeaders([
                'x-hasura-admin-secret' => self::$key
            ])->get("https://latihangraphiql.hasura.app/api/rest/get-product-by-id/{$id}/1/0");
            
            $product = $response->json('product');
            $stock = $response->json('product_stock');

            if ($product) {
                $product = Product::hydrate($product)->flatten()->first();
            }

            if ($stock) {
                $stock = ProductStock::hydrate($stock)->flatten();
            }

            return array("product" => $product, "stock" => $stock);
            
        } catch (\Exception $e) {
            return dd($e);
        }
    }
}
