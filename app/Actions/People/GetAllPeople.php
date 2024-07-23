<?php
namespace App\Actions\People;

use App\Models\People;

class GetAllPeople
{
    public function handle()
    {
        return People::with(['business','tags'])->get();
    }
}