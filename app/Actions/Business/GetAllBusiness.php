<?php
namespace App\Actions\Business;

use App\Models\Business;

class GetAllBusiness
{
    public function handle()
    {
        return Business::with(['categories', 'tags'])->get();
    }
}