<?php
namespace App\Actions\Business;

use App\Models\Business;

class GetBusiness
{
    public function handle($id)
    {
        return Business::with(['categories', 'tags'])->where('id', $id)->get();
    }
}