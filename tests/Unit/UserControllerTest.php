<?php
namespace Tests\Feature;

use Tests\TestCase;
use Mockery;
use App\Actions\User\CreateNewUser;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase; 

    protected $createNewUser;

    public function setUp(): void
    {
        parent::setUp();

        $this->createNewUser = Mockery::mock(CreateNewUser::class);

        $this->app->instance(CreateNewUser::class, $this->createNewUser);
    }

    public function testStoreSuccess()
    {
        $validatedData = [
            'name' => 'Jollibee',
            'email' => 'jollibee@gmail.com',
            'password' => 'BidaAngSaya2024'
        ];
        $user = [
            'id' => 1,
            'name' => 'Jollibee',
            'email' => 'jollibee@gmail.com'
        ];

        $this->createNewUser->shouldReceive('handle')
            ->with($validatedData)
            ->once()
            ->andReturn($user);

        $response = $this->postJson('/api/register', $validatedData);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'User created Successfully'
            ]);
    }

    public function testStoreExceptionHandling()
    {
        $validatedData = [
            'name' => 'Jollibee',
            'email' => 'jollibee@gmail.com',
            'password' => 'BidaAngSaya2024'
        ];

        $this->createNewUser->shouldReceive('handle')
            ->with($validatedData)
            ->once()
            ->andThrow(new \Exception('Exception'));

        $response = $this->postJson('/api/register', $validatedData);

        $response->assertStatus(500)
            ->assertJson([
                'status' => 'error',
                'message' => 'An error occurred while creating user'
            ]);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
