<?php
namespace App\Actions\Task;

use App\Models\Task;

class CreateNewTask
{
    public function handle($taskData)
    {
        return Task::create($taskData)->id;
    }
}