<?php
namespace App\Actions\User;

use App\Models\User;

class CreateNewUser
{
    public function handle($user)
    {
        return User::create($user);
    }
}