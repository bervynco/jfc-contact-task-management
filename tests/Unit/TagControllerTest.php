<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\TagController;
use App\Actions\Tag\CreateNewTag;
use App\Actions\Tag\UpdateTag;
use App\Actions\Tag\DeleteTag;
use App\Actions\Tag\GetAllTag;
use App\Actions\Tag\GetTag;
use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;
use Mockery;

class TagControllerTest extends TestCase
{
    protected $createNewTag;
    protected $updateTag;
    protected $deleteTag;
    protected $getAllTag;
    protected $getTag;
    protected $controller;

    public function setUp(): void
    {
        parent::setUp();

        $this->createNewTag = Mockery::mock(CreateNewTag::class);
        $this->updateTag = Mockery::mock(UpdateTag::class);
        $this->deleteTag = Mockery::mock(DeleteTag::class);
        $this->getAllTag = Mockery::mock(GetAllTag::class);
        $this->getTag = Mockery::mock(GetTag::class);

        $this->controller = new TagController(
            $this->createNewTag,
            $this->updateTag,
            $this->deleteTag,
            $this->getAllTag,
            $this->getTag
        );
    }

    public function testIndex()
    {
        $tags = [['id' => 1, 'name' => 'Tag 1'], ['id' => 2, 'name' => 'Tag 2']];

        $this->getAllTag->shouldReceive('handle')->once()->andReturn($tags);

        $response = $this->controller->index();

        $this->assertEquals(200, $response->status());
        $this->assertEquals(json_encode($tags), $response->getContent());
    }

    public function testStore()
    {
        $request = Mockery::mock(CreateTagRequest::class);
        $validated = ['name' => 'New Tag'];
        $request->shouldReceive('validated')->once()->andReturn($validated);

        $this->createNewTag->shouldReceive('handle')->with($validated)->once()->andReturn($validated);

        $response = $this->controller->store($request);

        $this->assertEquals(200, $response->status());
        $this->assertEquals(json_encode($validated), $response->getContent());
    }

    public function testShow()
    {
        $id = '1';
        $tag = ['id' => 1, 'name' => 'Tag 1'];

        $this->getTag->shouldReceive('handle')->with($id)->once()->andReturn($tag);

        $response = $this->controller->show($id);

        $this->assertEquals(200, $response->status());
        $this->assertEquals(json_encode($tag), $response->getContent());
    }

    public function testUpdate()
    {
        $id = '1';
        $request = Mockery::mock(UpdateTagRequest::class);
        $validated = ['name' => 'Updated Tag'];
        $request->shouldReceive('validated')->once()->andReturn($validated);

        $this->updateTag->shouldReceive('handle')->with($validated, $id)->once()->andReturn($validated);

        $response = $this->controller->update($request, $id);

        $this->assertEquals(200, $response->status());
        $this->assertEquals(json_encode(['status' => 'success', 'data' => $validated]), $response->getContent());
    }

    public function testDestroy()
    {
        $id = '1';

        $this->deleteTag->shouldReceive('handle')->with($id)->once()->andReturn(true);

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
