<?php
namespace App\Actions\Business;

use App\Models\Business;

class UpdateBusiness
{
    public function handle($businessData, $id)
    {
        return Business::where('id', $id)->update($businessData);
    }
}