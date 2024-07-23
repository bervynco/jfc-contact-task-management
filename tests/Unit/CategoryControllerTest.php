<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\CategoryController;
use App\Actions\Category\CreateNewCategory;
use App\Actions\Category\UpdateCategory;
use App\Actions\Category\DeleteCategory;
use App\Actions\Category\GetAllCategory;
use App\Actions\Category\GetCategory;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Mockery;

class CategoryControllerTest extends TestCase
{
    protected $createNewCategory;
    protected $updateCategory;
    protected $deleteCategory;
    protected $getAllCategory;
    protected $getCategory;
    protected $controller;

    public function setUp(): void
    {
        parent::setUp();

        $this->createNewCategory = Mockery::mock(CreateNewCategory::class);
        $this->updateCategory = Mockery::mock(UpdateCategory::class);
        $this->deleteCategory = Mockery::mock(DeleteCategory::class);
        $this->getAllCategory = Mockery::mock(GetAllCategory::class);
        $this->getCategory = Mockery::mock(GetCategory::class);

        $this->controller = new CategoryController(
            $this->createNewCategory,
            $this->updateCategory,
            $this->deleteCategory,
            $this->getAllCategory,
            $this->getCategory
        );
    }

    public function testIndex()
    {
        $categories = [['id' => 1, 'name' => 'Category 1'], ['id' => 2, 'name' => 'Category 2']];

        $this->getAllCategory->shouldReceive('handle')->once()->andReturn($categories);

        $response = $this->controller->index();

        $this->assertEquals(200, $response->status());
        $this->assertEquals(json_encode($categories), $response->getContent());
    }

    public function testStore()
    {
        $request = Mockery::mock(CreateCategoryRequest::class);
        $validated = ['name' => 'New Category'];
        $request->shouldReceive('validated')->once()->andReturn($validated);

        $this->createNewCategory->shouldReceive('handle')->with($validated)->once()->andReturn($validated);

        $response = $this->controller->store($request);

        $this->assertEquals(200, $response->status());
        $this->assertEquals(json_encode($validated), $response->getContent());
    }

    public function testShow()
    {
        $id = '1';
        $category = ['id' => 1, 'name' => 'Category 1'];

        $this->getCategory->shouldReceive('handle')->with($id)->once()->andReturn($category);

        $response = $this->controller->show($id);

        $this->assertEquals(200, $response->status());
        $this->assertEquals(json_encode($category), $response->getContent());
    }

    public function testUpdate()
    {
        $id = '1';
        $request = Mockery::mock(UpdateCategoryRequest::class);
        $validated = ['name' => 'Updated Category'];
        $request->shouldReceive('validated')->once()->andReturn($validated);

        $this->updateCategory->shouldReceive('handle')->with($validated, $id)->once()->andReturn($validated);

        $response = $this->controller->update($request, $id);

        $this->assertEquals(200, $response->status());
        $this->assertEquals(json_encode(['status' => 'success', 'data' => $validated]), $response->getContent());
    }

    public function testDestroy()
    {
        $id = '1';

        $this->deleteCategory->shouldReceive('handle')->with($id)->once()->andReturn(true);

        $response = $this->controller->destroy($id);

        $this->assertEquals(200, $response->status());
        $this->assertEquals(json_encode(['status' => 'success', 'data' => true]), $response->getContent());
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
