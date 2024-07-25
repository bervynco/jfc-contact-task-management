<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\CreateNewTaskRequest;
use App\Http\Requests\UpdateTaskStatusRequest;

use App\Actions\Task\ChangeTaskStatus;
use App\Actions\Task\CreateNewTask;
use App\Actions\Task\GetAllTask;


class TaskController extends Controller
{
    public function __construct(
        ChangeTaskStatus $changeTaskStatus,
        CreateNewTask $createNewTask,
        GetAllTask $getAllTask
        )
    {
        $this->changeTaskStatus = $changeTaskStatus;
        $this->createNewTask = $createNewTask;
        $this->getAllTask = $getAllTask;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $task = $this->getAllTask->handle();
            return response()->json(['status' => 'success', 'data' => $task], 200);
        } catch (HttpResponseException $e) {
            return $e->getResponse();
        } catch(\Exception $e) {
            report($e);
            return response()->json(['status' => 'error', 'message' => 'An error occurred while pulling all task'], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateNewTaskRequest $request)
    {
        try {
            return response()->json($this->createNewTask->handle($request->validated())); 
        } catch (HttpResponseException $e) {
            return $e->getResponse();
        } catch(\Exception $e) {
            report($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskStatusRequest $request, string $id)
    {
        try {
            return response()->json([
                'status' => 'success',
                'data' => $this->changeTaskStatus->handle($request->validated(), $id)
            ]);
        } catch (HttpResponseException $e) {
            return $e->getResponse();
        } catch(\Exception $e) {
            report($e);
        }
    }
}
