<?php
namespace App\Actions\People;

use App\Models\People;

class UpdatePeople
{
    public function handle($peopleData, $id)
    {
        return People::where('id', $id)->update($peopleData);
    }
}