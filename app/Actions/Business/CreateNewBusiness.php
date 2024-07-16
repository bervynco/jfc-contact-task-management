<?php
namespace App\Actions;

use App\Models\Business;

class CreateNewBusiness
{
    public function handle($businessData)
    {
        return Business::create($businessData);
    }
}