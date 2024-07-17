<?php
namespace App\Actions\Business;

use App\Models\Business;

class CreateNewBusiness
{
    public function handle($businessData)
    {
        return Business::create($businessData)->id;
    }
}