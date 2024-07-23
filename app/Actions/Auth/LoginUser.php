<?php
namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
class LoginUser
{
    public function handle($userCredentials)
    {
        $loggedIn = Auth::attempt($userCredentials);
        if($loggedIn) {
            return Auth::user();
        } else {
            return null;
        }
    }
}