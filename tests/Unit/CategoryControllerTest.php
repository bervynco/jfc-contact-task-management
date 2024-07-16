<?php

namespace Tests\Unit;

use Tests\TestCase;
use Mockery;
use App\Http\Controllers\CategoryController;
use App\Actions\Category\CreateNewCategory;
use App\Actions\Category\UpdateCategory;
use App\Actions\Category\DeleteCategory;
use App\Actions\Category\GetAllCategory;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryControllerTest extends TestCase
{
    protected $getAllCategory;
    protected $createNewCategory;
    protected $updateCategory;
    protected $deleteCategory;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->getAllCategory = Mockery::mock(GetAllCategory::class);
        $this->createNewCategory = Mockery::mock(CreateNewCategory::class);
        $this->updateCategory = Mockery::mock(UpdateCategory::class);
        $this->deleteCategory = Mockery::mock(DeleteCategory::class);
    }

    public function testIndex()
    {
        $this->getAllCategory->shouldReceive('handle')->once()->andReturn(['data']);

        $controller = new CategoryController(
            $this->createNewCategory,
            $this->updateCategory,
            $this->deleteCategory,
            $this->getAllCategory
        );

        $response = $controller->index();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->status());
        $this->assertEquals(json_encode(['data']), $response->getContent());
    }

    public function testStore()
    {
        $request = Mockery::mock(CreateCategoryRequest::class);
        $request->shouldReceive('validated')->once()->andReturn(['name' => 'New Category']);

        $this->createNewCategory->shouldReceive('handle')->once()->with(['name' => 'New Category'])->andReturn(['id' => 1, 'name' => 'New Category']);

        $controller = new CategoryController(
            $this->createNewCategory,
            $this->updateCategory,
            $this->deleteCategory,
            $this->getAllCategory
        );

        $response = $controller->store($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->status());
        $this->assertEquals(json_encode(['id' => 1, 'name' => 'New Category']), $response->getContent());
    }

    public function testUpdate()
    {
        $request = Mockery::mock(UpdateCategoryRequest::class);
        $request->shouldReceive('validated')->once()->andReturn(['name' => 'Updated Category']);

        $this->updateCategory->shouldReceive('handle')->once()->with(['name' => 'Updated Category'], '1')->andReturn(['id' => 1, 'name' => 'Updated Category']);

        $controller = new CategoryController(
            $this->createNewCategory,
            $this->updateCategory,
            $this->deleteCategory,
            $this->getAllCategory
        );

        $response = $controller->update($request, '1');

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->status());
        $this->assertEquals(json_encode(['status' => 'success', 'data' => ['id' => 1, 'name' => 'Updated Category']]), $response->getContent());
    }


    public function testDestroy()
    {
        $this->deleteCategory->shouldReceive('handle')->once()->with('1')->andReturn(true);

        $controller = new CategoryController(
            $this->createNewCategory,
            $this->updateCategory,
            $this->deleteCategory,
            $this->getAllCategory
        );

        $response = $controller->destroy('1');

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->status());
        $this->assertEquals(json_encode(['status' => 'success', 'data' => true]), $response->getContent());
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
