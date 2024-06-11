<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Http;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    protected static $key = 'OYD5qBvKTzW6C3UH1luLce5kwwSxnknMntTBh1zY2oRrbvXhhvnuSlKQJe7DUzMT';

    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function getUser()
    {
        try {

            $response = Http::withHeaders([
                'x-hasura-admin-secret' => self::$key
            ])->get('https://tubeseai-restaurant.hasura.app/api/rest/get-all-user');

            $data = $response->json('user');

            if ($data) {
                $data = User::hydrate($data)->flatten();
                return $data;
            }

            return $data;

        } catch (\Exception $e) {
            // Handle Error
            return dd($e);
        }
    }

    public static function getUserById($userId)
    {
        try {

            $response = Http::withHeaders([
                'x-hasura-admin-secret' => self::$key
            ])->get("https://tubeseai-restaurant.hasura.app/api/rest/get-user-by-id/{$userId}");

            $data = $response->json('User_Restaurant');


            if ($data) {
                $data = User::hydrate($data)->first();
                return $data;
            }

            return $data;

        } catch (\Exception $e) {
            // Handle Error
            return dd($e);
        }
    }

    public static function createUser($user)
    {   

        try {

            $response = Http::withHeaders([
                'x-hasura-admin-secret' => self::$key
            ])->post("https://tubeseai-restaurant.hasura.app/api/rest/post-new-user/{$user['username']}/{$user['email']}/{$user['password']}");

            $data = $response->json('insert_user.returning');

            return $data;

        } catch (\Exception $e) {
            // Handle Error
            return dd($e);
        }
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array<int, string>
    //  */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    // /**
    //  * The attributes that should be hidden for serialization.
    //  *
    //  * @var array<int, string>
    //  */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    // /**
    //  * Get the attributes that should be cast.
    //  *
    //  * @return array<string, string>
    //  */
    // protected function casts(): array
    // {
    //     return [
    //         'email_verified_at' => 'datetime',
    //         'password' => 'hashed',
    //     ];
    // }
}
