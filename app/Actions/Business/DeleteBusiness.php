<?php
namespace App\Actions\Business;

use App\Models\Business;

class DeleteBusiness
{
    public function handle($id)
    {
        return Business::where('id', $id)->delete();
    }
}