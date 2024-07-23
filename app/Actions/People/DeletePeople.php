<?php
namespace App\Actions\People;

use App\Models\People;

class DeletePeople
{
    public function handle($id)
    {
        return People::where('id', $id)->delete();
    }
}