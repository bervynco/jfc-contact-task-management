<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\PeopleController;
use App\Actions\People\CreateNewPeople;
use App\Actions\People\UpdatePeople;
use App\Actions\People\DeletePeople;
use App\Actions\People\GetAllPeople;
use App\Actions\People\GetPeople;
use App\Actions\TagMapping\CreateTagMapping;
use App\Actions\TagMapping\DeleteTagMappingPerPeopleId;
use App\Http\Requests\CreateNewPeopleRequest;
use App\Http\Requests\UpdatePeopleRequest;
use Mockery;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeopleControllerTest extends TestCase
{
    protected $createTagMapping;
    protected $createNewPeople;
    protected $updatePeople;
    protected $getAllPeople;
    protected $getPeople;
    protected $deletePeople;
    protected $deleteTagMappingPerPeopleId;
    protected $controller;

    public function setUp(): void
    {
        parent::setUp();

        $this->createTagMapping = Mockery::mock(CreateTagMapping::class);
        $this->createNewPeople = Mockery::mock(CreateNewPeople::class);
        $this->updatePeople = Mockery::mock(UpdatePeople::class);
        $this->getAllPeople = Mockery::mock(GetAllPeople::class);
        $this->getPeople = Mockery::mock(GetPeople::class);
        $this->deletePeople = Mockery::mock(DeletePeople::class);
        $this->deleteTagMappingPerPeopleId = Mockery::mock(DeleteTagMappingPerPeopleId::class);

        $this->controller = new PeopleController(
            $this->createTagMapping,
            $this->createNewPeople,
            $this->updatePeople,
            $this->getAllPeople,
            $this->getPeople,
            $this->deletePeople,
            $this->deleteTagMappingPerPeopleId
        );

        // Mock DB facade methods
        DB::shouldReceive('beginTransaction')->andReturn(true);
        DB::shouldReceive('commit')->andReturn(true);
        DB::shouldReceive('rollBack')->andReturn(true);
    }

    public function testIndex()
    {
        $people = [['id' => 1, 'name' => 'John Doe'], ['id' => 2, 'name' => 'Jane Doe']];

        $this->getAllPeople->shouldReceive('handle')->once()->andReturn($people);

        $response = $this->controller->index();

        $this->assertEquals(200, $response->status());
        $this->assertJsonStringEqualsJsonString(
            json_encode(['status' => 'success', 'data' => $people]),
            $response->getContent()
        );
    }

    public function testShow()
    {
        $id = '1';
        $people = ['id' => 1, 'name' => 'John Doe'];

        $this->getPeople->shouldReceive('handle')->with($id)->once()->andReturn($people);

        $response = $this->controller->show($id);

        $this->assertEquals(200, $response->status());
        $this->assertJsonStringEqualsJsonString(
            json_encode(['status' => 'success', 'data' => $people]),
            $response->getContent()
        );
    }

    public function testDestroy()
    {
        $id = '1';

        $this->deletePeople->shouldReceive('handle')->with($id)->once()->andReturn(true);

        $response = $this->controller->destroy($id);

        $this->assertEquals(200, $response->status());
        $this->assertJsonStringEqualsJsonString(
            json_encode(['status' => 'success', 'data' => true]),
            $response->getContent()
        );
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
