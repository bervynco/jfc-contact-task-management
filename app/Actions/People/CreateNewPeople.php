<?php
namespace App\Actions\People;

use App\Models\People;

class CreateNewPeople
{
    public function handle($peopleData)
    {
        return People::create($peopleData)->id;
    }
}