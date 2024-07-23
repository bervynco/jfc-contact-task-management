<?php
namespace App\Actions\Task;

use App\Models\Task;

class GetAllTask
{
    public function handle()
    {
        return Task::with(['business', 'people'])->get();
    }
}