<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\TaskController;
use App\Actions\Task\ChangeTaskStatus;
use App\Actions\Task\CreateNewTask;
use App\Actions\Task\GetAllTask;
use App\Http\Requests\CreateNewTaskRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use Mockery;
use Illuminate\Http\JsonResponse;

class TaskControllerTest extends TestCase
{
    protected $changeTaskStatus;
    protected $createNewTask;
    protected $getAllTask;
    protected $controller;

    public function setUp(): void
    {
        parent::setUp();

        $this->changeTaskStatus = Mockery::mock(ChangeTaskStatus::class);
        $this->createNewTask = Mockery::mock(CreateNewTask::class);
        $this->getAllTask = Mockery::mock(GetAllTask::class);

        $this->controller = new TaskController(
            $this->changeTaskStatus,
            $this->createNewTask,
            $this->getAllTask
        );
    }

    public function testIndex()
    {
        $tasks = [['id' => 1, 'name' => 'Task 1'], ['id' => 2, 'name' => 'Task 2']];

        $this->getAllTask->shouldReceive('handle')->once()->andReturn($tasks);

        $response = $this->controller->index();

        $this->assertEquals(200, $response->status());
        $this->assertEquals(json_encode(['status' => 'success', 'data' => $tasks]), $response->getContent());
    }

    public function testStore()
    {
        $request = Mockery::mock(CreateNewTaskRequest::class);
        $validated = ['name' => 'New Task'];
        $request->shouldReceive('validated')->once()->andReturn($validated);

        $this->createNewTask->shouldReceive('handle')->with($validated)->once()->andReturn($validated);

        $response = $this->controller->store($request);

        $this->assertEquals(200, $response->status());
        $this->assertEquals(json_encode($validated), $response->getContent());
    }

    public function testUpdate()
    {
        $id = '1';
        $request = Mockery::mock(UpdateTaskStatusRequest::class);
        $validated = ['status' => 'Completed'];
        $request->shouldReceive('validated')->once()->andReturn($validated);

        $this->changeTaskStatus->shouldReceive('handle')->with($validated, $id)->once()->andReturn($validated);

        $response = $this->controller->update($request, $id);

        $this->assertEquals(200, $response->status());
        $this->assertEquals(json_encode(['status' => 'success', 'data' => $validated]), $response->getContent());
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
