<?php
namespace Tests\Feature;

use Tests\TestCase;
use Mockery;
use App\Actions\Auth\LoginUser;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $loginUser;

    public function setUp(): void
    {
        parent::setUp();

        $this->loginUser = Mockery::mock(LoginUser::class);

        $this->app->instance(LoginUser::class, $this->loginUser);
    }

    public function testLoginSuccess()
    {
        $validatedData = ['email' => 'jollibee@gmail.com', 'password' => 'bidaangsaya'];
        $token = 'sample-token';

        $this->loginUser->shouldReceive('handle')
            ->with($validatedData)
            ->once()
            ->andReturn($token);

        $response = $this->postJson('/api/login', $validatedData);

        $response->assertStatus(200)
            ->assertJson(['token' => $token]);
    }

    public function testLoginFailure()
    {
        $validatedData = ['email' => 'jollibee@gmail.com', 'password' => 'bidaangsaya'];

        $this->loginUser->shouldReceive('handle')
            ->with($validatedData)
            ->once()
            ->andReturn(null);

        $response = $this->postJson('/api/login', $validatedData);

        $response->assertStatus(401)
            ->assertJson(['message' => 'Invalid credentials']);
    }

    public function testLoginExceptionHandling()
    {
        $validatedData = ['email' => 'jollibee@gmail.com', 'password' => 'bidaangsaya'];

        $this->loginUser->shouldReceive('handle')
            ->with($validatedData)
            ->once()
            ->andThrow(new \Exception('Test Exception'));

        $response = $this->postJson('/api/login', $validatedData);

        $response->assertStatus(500)
            ->assertJson(['status' => 'error', 'message' => 'An error occurred while logging in user']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
