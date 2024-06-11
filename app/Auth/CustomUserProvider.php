<?php 
namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CustomUserProvider extends EloquentUserProvider implements UserProvider
{
    public function retrieveByCredentials(array $credentials)
    {
        // Retrieve the user from API
        $users = User::getUser();

        if ($users) {
            foreach ($users as $user) {
                if ($user->email === $credentials['email']) {
                    return $user;
                }
            }
        }

        return null;
    }

    public function validateCredentials(UserContract $user, array $credentials)
    {
        // Validate the password using Hash facade
        return $credentials['password'] === $user->password;
    }
}
