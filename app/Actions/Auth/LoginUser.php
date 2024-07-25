<?php
namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Models\User;
class LoginUser
{
    public function handle($userCredentials)
    {
        return JWTAuth::attempt($userCredentials);
    }
}