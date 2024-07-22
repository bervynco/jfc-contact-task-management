<?php
namespace App\Actions\People;

use App\Models\People;

class GetPeople
{
    public function handle($id)
    {
        return People::with(['categories', 'tags'])->where('id', $id)->first();
    }
}