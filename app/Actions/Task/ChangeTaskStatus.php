<?php
namespace App\Actions\Task;

use App\Models\Task;

class ChangeTaskStatus
{
    public function handle($taskData, $id)
    {
        return Task::where('id', $id)->update(['status' => $taskData['status']]);
    }
}